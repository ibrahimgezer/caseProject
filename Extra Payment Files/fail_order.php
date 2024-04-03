<?php
if(isset($getOrder) && $getOrder !=NULL){
$billingAndDeliveryData = json_decode($getOrder->billing_and_delivery_json);
$orderContentData = json_decode($getOrder->cart_json);
?>
<main class="main pb-5">
    <div class="pt-1" style="zoom:.9;">
        <nav class="w-100" aria-label="breadcrumb">
            <ol class="breadcrumb w-100 my-0 pb-0 breadcrumb-light flex-lg-nowrap justify-content-start">
                <li class="breadcrumb-item active text-capitalize" aria-current="page">
                    <a class="text-muted" href="<?= base_url() ?>"><?= companyName() ?></a>
                </li>
                <li class="breadcrumb-item active text-uppercase">
                    <a class="text-danger"
                       href="javascript:;">
                        <?= $billingAndDeliveryData->process_no ?> Numaralı Sipariş Detayları
                    </a>
                </li>
            </ol>
        </nav>
    </div>
    <hr class="my-2 my-lg-4">
    <div class="container-3xl bg-white">
        <div class="row py-2 bg-white">
            <div class="col-12 p-4 bg-white text-center">
                <?= getLucideIcon("x-circle", "w-20 h-20 mb-3 text-danger") ?>
                <div class="fs-6 mb-0 text-center text-uppercase fw-bold d-flex-item-justify-center text-theme mb-2">
                    <span class="fw-light me-2">Merhaba</span><?= $billingAndDeliveryData->name ?>,
                </div>
                "<?= $billingAndDeliveryData->process_no ?>" Numaralı Siparişiniz Oluşturulurken Hata Oluştu.
                <br>
                <h5 class="text-success mt-2">Yardım almak istiyorsanız,<br> Sağ tarafta bulunan <br>"<b>Whatsapp Destek Hattı</b>"<br> butonuna tıklayınız...</h5>
                <hr class="border-purple">
                <?php $getOrderData = getOrderData($billingAndDeliveryData->process_no); ?>
                <?php if ($getOrderData->payment_status == "0") { ?>
                    <span class="text-danger text-capitalize">NOT : Siparişiniz ödeme yapılmadığı için oluşturulamamıştır.</span>
                <?php } ?>
                 </div>
        </div>
    </div>
</main>
<?php }else{?>
    <script>
        window.location.href = window.location.origin;
    </script>
<?php }?>