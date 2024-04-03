<?php

namespace App\Controllers;

use Config\Database;

class PaymentController extends BaseController
{
    public function initPaymanetPaytr()
    {
        $db = Database::connect();
        $orderModel = model("OrderModel");
        $cartDatas = session()->get('cartData') ?? [];
        $billingAndDeliveryData = session()->get('billingAndDeliveryData') ?? [];

        try {
            $totalPrice = 0;
            $totalDiscount = 0;
            $totalBonus = 0;
            $cartPost = [];
            foreach ($cartDatas as $key => $cartData) {
                $totalPrice += $cartData["total_price"];
                $totalDiscount += $cartData["discount"];
                $totalBonus += $cartData["bonus"];
                $cartPost[$key]["product_name"] = $cartData["product_name"];
                $cartPost[$key]["unit_price"] = $cartData["price"];
                $cartPost[$key]["quantity"] = $cartData["product_qty"];
            }

            $totalPrice = $totalPrice + ($totalPrice * 0.1);
            // $totalPrice = 1;

            $merchant_id = 'id';
            $merchant_key = 'key';
            $merchant_salt = 'salt';

            $email = $billingAndDeliveryData["e_mail"];
            $payment_amount = $totalPrice * 100;
            $date = date("YmdHis", time());
            $time = mb_strimwidth($date, 2, 12);
            $sessionID = session_id();
            $merchant_oid = "SP" . $time . "RN" . rand(1, 100000);
            $user_name = $billingAndDeliveryData["name"];
            $user_address = $billingAndDeliveryData["invoice_adress"] . "  <br>" . $billingAndDeliveryData["district"] . " / " . $billingAndDeliveryData["city"];
            $user_phone = $billingAndDeliveryData["full_phone"];
            $merchant_ok_url = base_url("odeme-basarili/" . $merchant_oid);
            $merchant_fail_url = base_url("odeme-basarisiz/" . $merchant_oid);
            $user_basket = base64_encode(json_encode($cartPost));
            if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $user_ip = $_SERVER["HTTP_CLIENT_IP"];
            } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $user_ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else {
                $user_ip = $_SERVER["REMOTE_ADDR"];
            }
            $timeout_limit = "30";
            $debug_on = 0;
            $test_mode = 0;
            $no_installment = 0;
            $max_installment = 0;
            $currency = "TL";
            $hash_str = $merchant_id . $user_ip . $merchant_oid . $email . $payment_amount . $user_basket . $no_installment . $max_installment . $currency . $test_mode;
            $paytr_token = base64_encode(hash_hmac('sha256', $hash_str . $merchant_salt, $merchant_key, true));
            $post_vals = array(
                'merchant_id' => $merchant_id,
                'user_ip' => $user_ip,
                'merchant_oid' => $merchant_oid,
                'email' => $email,
                'payment_amount' => $payment_amount,
                'paytr_token' => $paytr_token,
                'user_basket' => $user_basket,
                'debug_on' => $debug_on,
                'no_installment' => $no_installment,
                'max_installment' => $max_installment,
                'user_name' => $user_name,
                'user_address' => $user_address,
                'user_phone' => $user_phone,
                'merchant_ok_url' => $merchant_ok_url,
                'merchant_fail_url' => $merchant_fail_url,
                'timeout_limit' => $timeout_limit,
                'currency' => $currency,
                'test_mode' => $test_mode
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/get-token");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);

            $result = @curl_exec($ch);

            if (curl_errno($ch))
                die("PAYTR IFRAME connection error. err:" . curl_error($ch));

            curl_close($ch);

            $result = json_decode($result, 1);

            if ($result['status'] == 'success') {

                $billingAndDeliveryData["process_no"] = $merchant_oid;
                session()->set('billingAndDeliveryData', $billingAndDeliveryData);

                $userMail = $billingAndDeliveryData["e_mail"];
                $userData = $db->query("SELECT * FROM users WHERE email = '$userMail'")->getRow();
                $orderModel->where(['status' => 0, 'session_id' => $sessionID])->delete();
                $values = [
                    'process_no' => $merchant_oid,
                    'cart_json' => json_encode($cartDatas),
                    'billing_and_delivery_json' => json_encode($billingAndDeliveryData),
                    'price' => $totalPrice,
                    'discount' => $totalDiscount,
                    'bonus' => $totalBonus,
                    'user_id' => $userData !== null ? $userData->id : null,
                    'session_id' => $sessionID,
                    'status' => 0,
                    'show_status' => 0,
                    'payment_status' => 0,
                ];

                $orderModel->insert($values);

            } else {
                die("PAYTR IFRAME failed. reason:" . $result['reason']);
            }

            return json_encode($result);
        } catch (\Exception $e) {
            echo 'Exception: ', $e->getMessage(), "\n";
            echo 'Exception: ', $e->getFile(), "\n";
            var_dump($e->getTrace());
            echo 'Exception: ', $e->getLine(), "\n";
            echo 'Exception: ', $e->getCode(), "\n";
        }
    }

    public function handlePaymentResponse()
    {
        try {
            $db = Database::connect();
            $post = $_POST;
            $orderModel = model("OrderModel");
            date_default_timezone_set('Europe/Istanbul'); // Türkiye saati için

            $merchant_key = 'key';
            $merchant_salt = 'salt';

            $hash = base64_encode(hash_hmac('sha256', $post['merchant_oid'] . $merchant_salt . $post['status'] . $post['total_amount'], $merchant_key, true));
            if ($hash != $post['hash'])
                die('PAYTR notification failed: bad hash');

            $processNumber = $post['merchant_oid'];

            $orderData = $orderModel->where('process_no', $processNumber)->first();
            if (!empty($orderData) && $orderData["status"] == "1") {
                echo "OK";
                exit;
            }

            if ($post['status'] == 'success') {
                $updateOrderData = [
                    'status' => 1,
                    'payment_status' => 1,
                    'updated_at' => date("Y-m-d H:i:s", time())
                ];
                $db->table('orders_list')->where('process_no', $processNumber)->update($updateOrderData);
            } else {
                $orderModel->where(['status' => 0, 'process_no' => $processNumber])->delete();
            }
            echo "OK";
            exit;
        } catch (\Exception $e) {
            echo 'Exception: ', $e->getMessage(), "\n";
        }
    }

    public function success_page($processNumber)
    {
        $data["title"] = ' | Sipariş Başarılı';
        session()->set('cartData', []);
        $db = Database::connect();
        $viewData["userLogin"] = !empty($this->userInfo) ? true : false;
        $viewData["getOrder"] = $db->query("SELECT * FROM orders_list WHERE process_no = '$processNumber'")->getRow();
        $this->head_render('template_parts/head', $data);
        $this->header_render('template_parts/header');
        echo view('theme/cart/success_order', $viewData);
        $this->footer_render('template_parts/footer');
        echo view('template_parts/script');
    }

    public function fail_page($processNumber)
    {
        $data["title"] = ' | Sipariş Hatalı';
        $db = Database::connect();
        $viewData["getOrder"] = $db->query("SELECT * FROM orders_list WHERE process_no = '$processNumber'")->getRow();
        $this->head_render('template_parts/head', $data);
        $this->header_render('template_parts/header');
        echo view('theme/cart/fail_order', $viewData);
        $this->footer_render('template_parts/footer');
        echo view('template_parts/script');
    }

}
