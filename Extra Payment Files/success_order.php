<?php
if (isset($getOrder) && $getOrder != NULL) {
    $billingAndDeliveryData = json_decode($getOrder->billing_and_delivery_json);
    $orderContentData = json_decode($getOrder->cart_json);
    ?>
    <style>
        .product-slider-image {
            zoom: .85;
        }
    </style>
    <main class="main pb-5">
        <div class="pt-1" style="zoom:.9;">
            <nav class="w-100" aria-label="breadcrumb">
                <ol class="breadcrumb w-100 my-0 pb-0 breadcrumb-light flex-lg-nowrap justify-content-start">
                    <li class="breadcrumb-item active text-capitalize" aria-current="page">
                        <a class="text-muted" href="<?= base_url() ?>"><?= companyName() ?></a>
                    </li>
                    <li class="breadcrumb-item active text-uppercase">
                        <a class="text-success"
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
                <div class="col-12 p-4 flex-column gap-1 gap-lg-0 bg-white text-center">
                    <?= getLucideIcon("check-circle", "w-20 h-20 mb-3 text-success") ?>
                    <div class="fs-6 text-center text-uppercase fw-bold d-flex-item-justify-center text-theme mb-4 mb-lg-2">
                        <span class="fw-light me-2">Merhaba</span><?= $billingAndDeliveryData->name ?>,
                    </div>
                    <span class="text-success"><b><?= $billingAndDeliveryData->process_no ?></b> Numaralı Siparişiniz Başarıyla Oluşturulmuştur.</span>
                    <br>
                    <br>
                    Sipariş detaylarınız <b><?= $billingAndDeliveryData->e_mail ?></b> adlı eposta adresinize
                    iletilecektir.
                    <br>
                    <br>
                    <?php if (isset($userLogin) && $userLogin) { ?>
                        <div class="d-flex-item-justify-center flex-lg-row flex-column gap-1 gap-lg-2">
                            Sipariş detaylarına
                            <a target="_blank" href="<?= base_url() ?>/siparislerim" class="text-primary">
                                buraya tıklayarak
                            </a>
                            ulaşabilirsin.
                        </div>
                    <?php } ?>
                    <br>
                    <br>
                    <hr class="border-purple">
                    <br>
                    <h3 class="text-dark fw-bold">Bu ürünlere de göz atmak ister misiniz ?</h3>
                    <div class="px-0 px-md-2 px-xxl-2">
                        <div class="owl-carousel owl-carousel-products-others owl-full owl-loaded px-1 owl-theme d-flex">
                            <?php $getSameProducts = [] ?>
                            <?php foreach ($orderContentData as $cart) { ?>
                                <?php $getSameProducts = getSameProductWithID($cart->product_id); ?>
                            <?php } ?>
                            <?php $getSameProducts = array_unique($getSameProducts, SORT_REGULAR); ?>
                            <?php foreach ($getSameProducts as $product) {
                                $product_url = "urunler/" . $product["category_url"] . "/" . $product["url"];
                                $category_url = "urunler/" . $product["category_url"];
                                date_default_timezone_set('Europe/Istanbul');
                                $data_date = date("d.m.Y", strtotime($product["created_at"]));
                                $nowDate = date("d.m.Y", strtotime('-3 days', strtotime(date("d.m.Y"))));
                                $sale_price = $product["sale_price"];
                                $discount_price = $sale_price - ($sale_price * ($product["discount_rate"] / 100));
                                $bonus_reward = $sale_price * ($product["bonus_rate"] / 100);
                                ?>
                                <div class="px-2 mb-4 pt-3">
                                    <div class="card product-card border-0 rounded-bottom-lg rounded-top-xl shadow position-relative">
                                        <a class="card-img-top d-block" href="<?= base_url("$product_url") ?>">
                                            <img src="<?= !empty($product["images"]) ? base_url() . "/assets/images/product/" . (getFileTypeFromExtension($product["images"][0]) == "image" ? $product["images"][0] : $product["images"][1]) : "#" ?>"
                                                 class="watermark product-slider-image" alt="<?= $product["name"] ?>">
                                        </a>
                                        <div class="card-body p-2">
                                            <h6 class="product-title fw-bold px-2 fs-6 mt-2 mb-0 w-100">
                                                <a href="<?= base_url($product_url) ?>"
                                                   class="text-theme fs-8 w-100 text-center d-block"><?= $product["name"] ?></a>
                                            </h6>
                                            <h6 class="d-flex align-items-center justify-content-center gap-2 pb-1 px-2">
                                                <?php if ($discount_price != $sale_price) { ?>
                                                    <del class="text-danger fw-bold fs-5 d-flex align-items-center justify-content-center "><?= number_format($sale_price, 2) . getLucideIcon("tl_icon", "w-4 h-4 ms-1") ?></del>
                                                <?php } ?>
                                                <span class="text-success fw-bold fs-5 d-flex align-items-center justify-content-center"><?= number_format($discount_price, 2) . getLucideIcon("tl_icon", "w-4 h-4 ms-1") ?></span>
                                            </h6>
                                            <a class="btn btn-theme-soft d-flex align-items-center justify-content-center rounded-lg shadow-text-theme w-100 mt-2"
                                               href="<?= base_url($product_url) ?>">
                                                <?= getLucideIcon("eye", "w-4 h-4 me-2") ?>İncele
                                            </a>
                                        </div>
                                    </div>
                                    <hr class="d-sm-none">
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <br>
                    <div class="px-2">
                        <a href="<?= base_url("/urunler") ?>"
                           class=" w-100 w-lg-25 mx-auto btn btn-success-soft d-flex-item-justify-center gap-1 rounded-xl mt-3">
                            <?= getLucideIcon("eye", "w-3 h-3") ?>
                            <span class="fs-9 fs-lg-6 mobile-zoom-08">Tüm ürünlere göz at</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(".owl-carousel-products-others").owlCarousel({
            items: 6,
            margin: 8,
            stagePadding: 5,
            dots: false,
            nav: false,
            loop: true,
            autoplay: true,
            pagination: true,
            autoplayTimeout: 6000,
            navText: [left_icon, right_icon],

            responsive: {
                "0": {
                    "items": 1,
                },
                "480": {
                    "items": 2,
                },
                "768": {
                    "items": 3
                },
                "1280": {
                    "items": 4,
                },
                "1400": {
                    "items": 8,
                }
            }
        });
    </script>
<?php } else {
    ?>
    <script>
        window.location.href = window.location.origin;
    </script>
<?php } ?>