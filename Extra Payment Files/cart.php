<style>
    .bottom-menu-fixed {
        border-top: 1px solid var(--bs-gray-300);
        box-shadow: unset;
    }

    #loadingPayFrame {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    #loadingPayFrame .spinner {
        border: 4px solid var(--bs-dark);
        border-radius: 50%;
        border-top: 4px solid #ff2800;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
        margin-bottom: 2rem;
    }

    #modalAreaSpinner {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    #loadingPayScreen .spinner {
        border: 4px solid var(--bs-dark);
        border-radius: 50%;
        border-top: 4px solid #ff2800;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
    }

    #paytriframe {
        height: 100% !important;
        min-height: 650px !important;
        max-height: 1000px !important;
    }

</style>
<main class="main pb-lg-5">
    <div class="pt-1" style="zoom:.9;">
        <nav class="w-100" aria-label="breadcrumb">
            <ol class="breadcrumb w-100 my-0 pb-0 breadcrumb-light flex-lg-nowrap justify-content-start">
                <li class="breadcrumb-item">
                    <a class="text-muted" href="<?= base_url() ?>"><?= companyName() ?></a>
                </li>
                <li class="breadcrumb-item active text-capitalize" aria-current="page">
                    <a class="text-muted" href="<?= base_url("sepetim") ?>">Alışveriş Sepetim</a>
                </li>
            </ol>
        </nav>
    </div>
    <hr>
    <div class="container-4xl pb-5 mb-2 mb-md-4 px-1 px-lg-5">
        <?php if (isset($getCarts) && $getCarts != NULL) { ?>
            <div class="row cart-content-box">
                <div class="col-12 col-lg-8 p-2" id="cart-page-main">
                    <div class="bg-white px-1 px-lg-0 d-flex-item-justify-center justify-content-between align-items-center shadow rounded-lg overflow-hidden mb-2 mb-lg-0">
                        <h6 class="h-16 fs-9 fs-lg-7 border-bottom border-secondary flex-1 mb-0 p-1 p-lg-2 cursor-pointer step-title fw-bold d-flex align-items-center justify-content-center  flex-column flex-lg-row text-center text-lg-start gap-1 gap-lg-2 step-active"
                            data-step="1">
                            <?= getLucideIcon("shirt", "w-5 h-5") ?>Ürün Bilgileri
                        </h6>
                        <h6 class="h-16 fs-9 fs-lg-7 border-bottom border-secondary flex-1 mb-0 p-1 p-lg-2 cursor-pointer step-title fw-bold d-flex align-items-center justify-content-center  flex-column flex-lg-row text-center text-lg-start gap-1 gap-lg-2"
                            data-step="2">
                            <?= getLucideIcon("truck", "w-5 h-5") ?>Teslimat ve Fatura Bilgileri
                        </h6>
                        <!--<h6 class="h-16 fs-9 fs-lg-7 border-bottom border-secondary flex-1 mb-0 p-1 p-lg-2 cursor-pointer step-title fw-bold d-flex align-items-center justify-content-center  flex-column flex-lg-row text-center text-lg-start gap-1 gap-lg-2"
                            data-step="3">
                            <?php /*= getLucideIcon("credit-card", "w-5 h-5") */ ?>Ödeme Seçenekleri
                        </h6>-->
                    </div>
                    <div class="step p-1 p-lg-2-5 active" data-step="1">
                        <?php foreach ($getCarts as $cartKey => $cartItems) {
                            $getProductInfo = getProductInfo($cartItems["product_id"]);
                            $getCategoryInfo = getCategoryInfo($getProductInfo["category_id"]);
                            $product_url = "urunler/" . $getCategoryInfo["url"] . "/" . $getProductInfo["url"];
                            $sale_price = $cartItems["price"];
                            $total_price_product = $cartItems["total_price"];
                            $discount_price = $cartItems["discount"];
                            $bonus_reward = $cartItems["bonus"];
                            ?>
                            <div class="row shadow bg-white p-1 p-lg-3 rounded-lg product-row mb-3"
                                 data-product-id="<?= $cartItems["product_id"] ?>" data-product-key="<?= $cartKey ?>">
                                <div class="col-12 col-lg-3 col-xxl-2">
                                    <div class="d-flex d-lg-none flex-column gap-2 align-items-center justify-content-center align-items-start mb-2">
                                        <a href="<?= base_url("$product_url") ?>"
                                           class="fw-bold text-dark fs-7 fs-lg-5 text-center text-lg-start">
                                            <?= $getProductInfo["name"] ?>
                                        </a>
                                        <div class="fw-bold text-orange text-center fs-7 fs-lg-5 text-uppercase mb-0 d-flex-item-justify-center w-100 w-lg-auto gap-2">
                                            <?= getLucideIcon("check-circle") . ($cartItems["print_type"] == "digitalOppression" ? "Dijital Baskı" : "Nakışlı") ?>
                                        </div>
                                    </div>
                                    <div class='gallery__container mb-2 mb-lg-0'>
                                        <div class='gallery__container__imgs'>
                                            <img data-gallery-img src="<?= $cartItems["FrontPhoto"] ?>"
                                                 style="width: 48%" alt="FrontPhoto"
                                                 class="h-32 rounded-lg shadow mb-2">
                                            <?php if ($cartItems["BackPhoto"] != "") { ?>
                                                <img data-gallery-img src="<?= $cartItems["BackPhoto"] ?>"
                                                     style="width: 48%" alt="BackPhoto"
                                                     class="h-32 rounded-lg shadow mb-2">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-9 col-xxl-10 px-1 px-lg-3">
                                    <div class="d-none d-lg-flex flex-column flex-lg-row gap-2 justify-content-lg-between justify-content-center align-items-start mb-2">
                                        <a href="<?= base_url("$product_url") ?>"
                                           class="fw-bold text-dark fs-5 text-center text-lg-start">
                                            <?= $getProductInfo["name"] ?>
                                        </a>
                                        <h6 class="fw-bold text-orange text-center text-uppercase mb-0 d-flex-item-justify-center w-100 w-lg-auto gap-2">
                                            <?= getLucideIcon("check-circle") . ($cartItems["print_type"] == "digitalOppression" ? "Dijital Baskı" : "Nakışlı") ?>
                                        </h6>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap flex-md-nowrap justify-content-center"
                                         style="gap: .65rem">
                                        <div class="d-flex align-items-center mb-1 shadow rounded-lg flex-column gap-1 position-relative h-10 quantity-box-cart">
                                            <div class="qty-input-box d-flex">
                                                <button class="btn btn-sm btn-gray-soft decrease-btn"><?= getLucideIcon("minus") ?></button>
                                                <input class="form-control text-center text-muted text-end bodies-input bodies-s p-0 fs-9 h-10"
                                                       value="<?= $cartItems["S"] ?>" min="0" data-body-value="s"
                                                       type="text">
                                                <button class="btn btn-sm btn-gray-soft increase-btn"><?= getLucideIcon("plus") ?></button>
                                            </div>
                                            <span class="fw-bold fs-9 px-1 shadow rounded-sm"
                                                  style="position: absolute; top: -5px;left: -5px;background: white">S</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-1 shadow rounded-lg flex-column gap-1 position-relative h-10 quantity-box-cart">
                                            <div class="qty-input-box d-flex">
                                                <button class="btn btn-sm btn-gray-soft decrease-btn"><?= getLucideIcon("minus") ?></button>
                                                <input class="form-control text-center text-muted text-end bodies-input bodies-m p-0 fs-9 h-10"
                                                       value="<?= $cartItems["M"] ?>" min="0" data-body-value="m"
                                                       type="text">
                                                <button class="btn btn-sm btn-gray-soft increase-btn"><?= getLucideIcon("plus") ?></button>
                                            </div>
                                            <span class="fw-bold fs-9 px-1 shadow rounded-sm"
                                                  style="position: absolute; top: -5px;left: -5px;background: white">M</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-1 shadow rounded-lg flex-column gap-1 position-relative h-10 quantity-box-cart">
                                            <div class="qty-input-box d-flex">
                                                <button class="btn btn-sm btn-gray-soft decrease-btn"><?= getLucideIcon("minus") ?></button>
                                                <input class="form-control text-center text-muted text-end bodies-input bodies-l p-0 fs-9 h-10"
                                                       value="<?= $cartItems["L"] ?>" min="0" data-body-value="l"
                                                       type="text">
                                                <button class="btn btn-sm btn-gray-soft increase-btn"><?= getLucideIcon("plus") ?></button>
                                            </div>
                                            <span class="fw-bold fs-9 px-1 shadow rounded-sm"
                                                  style="position: absolute; top: -5px;left: -5px;background: white">L</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-1 shadow rounded-lg flex-column gap-1 position-relative h-10 quantity-box-cart">
                                            <div class="qty-input-box d-flex">
                                                <button class="btn btn-sm btn-gray-soft decrease-btn"><?= getLucideIcon("minus") ?></button>
                                                <input class="form-control text-center text-muted text-end bodies-input bodies-xl p-0 fs-9 h-10"
                                                       value="<?= $cartItems["XL"] ?>" min="0" data-body-value="xl"
                                                       type="text">
                                                <button class="btn btn-sm btn-gray-soft increase-btn"><?= getLucideIcon("plus") ?></button>
                                            </div>
                                            <span class="fw-bold fs-9 px-1 shadow rounded-sm"
                                                  style="position: absolute; top: -5px;left: -5px;background: white">XL</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-1 shadow rounded-lg flex-column gap-1 position-relative h-10 quantity-box-cart">
                                            <div class="qty-input-box d-flex">
                                                <button class="btn btn-sm btn-gray-soft decrease-btn"><?= getLucideIcon("minus") ?></button>
                                                <input class="form-control text-center text-muted text-end bodies-input bodies-xxl p-0 fs-9 h-10"
                                                       value="<?= $cartItems["2XL"] ?>" min="0" data-body-value="2xl"
                                                       type="text">
                                                <button class="btn btn-sm btn-gray-soft increase-btn"><?= getLucideIcon("plus") ?></button>
                                            </div>
                                            <span class="fw-bold fs-9 px-1 shadow rounded-sm"
                                                  style="position: absolute; top: -5px;left: -5px;background: white">2XL</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-1 shadow rounded-lg flex-column gap-1 position-relative h-10 quantity-box-cart">
                                            <div class="qty-input-box d-flex">
                                                <button class="btn btn-sm btn-gray-soft decrease-btn"><?= getLucideIcon("minus") ?></button>
                                                <input class="form-control text-center text-muted text-end bodies-input bodies-xxxl p-0 fs-9 h-10"
                                                       value="<?= $cartItems["3XL"] ?>" min="0" data-body-value="3xl"
                                                       type="text">
                                                <button class="btn btn-sm btn-gray-soft increase-btn"><?= getLucideIcon("plus") ?></button>
                                            </div>
                                            <span class="fw-bold fs-9 px-1 shadow rounded-sm"
                                                  style="position: absolute; top: -5px;left: -5px;background: white">3XL</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mt-1 mt-lg-1 justify-content-lg-start gap-2 w-100">
                                        <button class="btn-remove btn btn-danger-soft mb-3 ms-2 mt-2 mb-lg-0 d-flex-item-justify-center gap-2"
                                                onclick='deleteCartItem(<?= $cartItems["product_id"] ?>,<?= $cartKey ?>)'
                                                title='Sepetten Çıkart' data-bs-toggle="tooltip"
                                                data-bs-placement="top">
                                            <?= getLucideIcon("trash-2", "w-4 h-4 text-danger") ?>
                                            <span class="fs-8 fw-bold text-danger">Sepetten Çıkart</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="step step-2 p-1 p-lg-2-5" data-step="2">
                        <form id="deliveryAndBillingForm" method="post" class="row mb-3 w-100"
                              style="color: #00000052;">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="user_type_hidden" class="d-none user_type_hidden"
                                   value="individual">
                            <h4 class="fw-bold text-muted col-md-12 mb-2 px-2">Teslimat ve Fatura Bilgileri</h4>
                            <hr>
                            <h6 class="fw-bold col-md-12 mb-2 px-2">Kullanıcı Türü</h6>
                            <div class="col-12 col-md-2 mb-2 px-2">
                                <div class="d-flex align-items-start justify-content-start gap-2">
                                    <input type="radio" class="form-check-input" onclick="showHideBoxes('individual')"
                                           id="user-type-individual" name="user-type" checked required>
                                    <label class="fw-sm-bold" for="user-type-individual">
                                        Bireysel
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 mb-2 px-2">
                                <div class="d-flex align-items-start justify-content-start gap-2">
                                    <input type="radio" class="form-check-input"
                                           onclick="showHideBoxes('institutional')"
                                           id="user-type-institutional" name="user-type" required>
                                    <label class="fw-sm-bold" for="user-type-institutional">
                                        Kurumsal
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 row mt-3">
                                <div class="col-12 col-md-4 mb-2 px-2 invoice-title-box d-none">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        Fatura Ünvanı
                                        <span class="text-theme-orange ms-auto fs-8">(Zorunlu Alan)</span>
                                    </label>
                                    <input class="mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control invoice-title-input"
                                           type="text" placeholder="Fatura Ünvanı"
                                           name="invoice_title"
                                           value="<?= $billingAndDeliveryData != [] && isset($billingAndDeliveryData["invoice_title"]) ? $billingAndDeliveryData["invoice_title"] : set_value('invoice_title') ?>">
                                    <span class="no-wrap error-span" id="invoice_title_error"></span>
                                </div>
                                <div class="col-12 col-md-4 mb-2 px-2 ">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        <div class="invoice-name-text me-2 d-none">Fatura</div>
                                        Ad Soyad
                                        <span class="text-theme-orange ms-auto fs-8">(Zorunlu Alan)</span>
                                    </label>
                                    <input class="mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control invoice-name-input"
                                           type="text" placeholder="Ad Soyad" name="name"
                                           value="<?= $billingAndDeliveryData != [] && isset($billingAndDeliveryData["name"]) ? $billingAndDeliveryData["name"] : set_value('name') ?>">
                                    <span class="no-wrap error-span" id="name_error"></span>
                                </div>
                                <div class="col-12 col-md-4 mb-2 px-2 invoice-tax-administration-box d-none">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        Vergi Dairesi
                                        <span class="text-theme-orange ms-auto fs-8">(Zorunlu Alan)</span>
                                    </label>
                                    <select name="invoice_tax_administration" id="invoice_tax_administration"
                                            class="mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control">
                                        <option value="">Seçiniz</option>
                                        <option value="19 MAYIS">19 MAYIS VERGİ DAİRESİ</option>
                                        <option value="23 TEMMUZ">23 TEMMUZ VERGİ DAİRESİ</option>
                                        <option value="30 AGUSTOS">30 AGUSTOS VERGİ DAİRESİ</option>
                                        <option value="ABANA">ABANA VERGİ DAİRESİ</option>
                                        <option value="ACIGOL">ACIGOL VERGİ DAİRESİ</option>
                                        <option value="ACIPAYAM">ACIPAYAM VERGİ DAİRESİ</option>
                                        <option value="ACISU">ACISU VERGİ DAİRESİ</option>
                                        <option value="ADALAR">ADALAR VERGİ DAİRESİ</option>
                                        <option value="ADANA">ADANA VERGİ DAİRESİ</option>
                                        <option value="ADIL CEVAZ">ADIL CEVAZ VERGİ DAİRESİ</option>
                                        <option value="ADIL ORAL">ADIL ORAL VERGİ DAİRESİ</option>
                                        <option value="ADIYAMAN">ADIYAMAN VERGİ DAİRESİ</option>
                                        <option value="AFŞİN">AFŞİN VERGİ DAİRESİ</option>
                                        <option value="AGRI">AGRI VERGİ DAİRESİ</option>
                                        <option value="AHMETLI">AHMETLI VERGİ DAİRESİ</option>
                                        <option value="AKCAABAT">AKCAABAT VERGİ DAİRESİ</option>
                                        <option value="AKCAKOCA">AKCAKOCA VERGİ DAİRESİ</option>
                                        <option value="AKÇAKOCA">AKÇAKOCA VERGİ DAİRESİ</option>
                                        <option value="AKDAGMADENI">AKDAGMADENI VERGİ DAİRESİ</option>
                                        <option value="AKDENIZ">AKDENIZ VERGİ DAİRESİ</option>
                                        <option value="AKHISAR">AKHISAR VERGİ DAİRESİ</option>
                                        <option value="AKSARAY">AKSARAY VERGİ DAİRESİ</option>
                                        <option value="AKSEHIR">AKSEHIR VERGİ DAİRESİ</option>
                                        <option value="AKSEKI">AKSEKI VERGİ DAİRESİ</option>
                                        <option value="AKSU">AKSU VERGİ DAİRESİ</option>
                                        <option value="AKYAZI">AKYAZI VERGİ DAİRESİ</option>
                                        <option value="AKYURT">AKYURT VERGİ DAİRESİ</option>
                                        <option value="ALANYA">ALANYA VERGİ DAİRESİ</option>
                                        <option value="ALAP">ALAP VERGİ DAİRESİ</option>
                                        <option value="ALAPLI">ALAPLI VERGİ DAİRESİ</option>
                                        <option value="ALASEHIR">ALASEHIR VERGİ DAİRESİ</option>
                                        <option value="ALEMDAG">ALEMDAG VERGİ DAİRESİ</option>
                                        <option value="ALEMDAR">ALEMDAR VERGİ DAİRESİ</option>
                                        <option value="ALI FUAT CEBESOY">ALI FUAT CEBESOY VERGİ DAİRESİ</option>
                                        <option value="ALIAGA">ALIAGA VERGİ DAİRESİ</option>
                                        <option value="ALIAGA MAL MUD">ALIAGA MAL MUD VERGİ DAİRESİ</option>
                                        <option value="ALMANYA">ALMANYA VERGİ DAİRESİ</option>
                                        <option value="ALMUS">ALMUS VERGİ DAİRESİ</option>
                                        <option value="ALOPLI">ALOPLI VERGİ DAİRESİ</option>
                                        <option value="ALTINOVA">ALTINOVA VERGİ DAİRESİ</option>
                                        <option value="ALTINTAS">ALTINTAS VERGİ DAİRESİ</option>
                                        <option value="ALTINYAYLA">ALTINYAYLA VERGİ DAİRESİ</option>
                                        <option value="ALTUNHISAR">ALTUNHISAR VERGİ DAİRESİ</option>
                                        <option value="ALUCRA">ALUCRA VERGİ DAİRESİ</option>
                                        <option value="AMASRA">AMASRA VERGİ DAİRESİ</option>
                                        <option value="AMASYA">AMASYA VERGİ DAİRESİ</option>
                                        <option value="ANADOLU KURUMLAR">ANADOLU KURUMLAR VERGİ DAİRESİ</option>
                                        <option value="ANAMUR">ANAMUR VERGİ DAİRESİ</option>
                                        <option value="ANDIRIN">ANDIRIN VERGİ DAİRESİ</option>
                                        <option value="ANKARA KURUMLAR">ANKARA KURUMLAR VERGİ DAİRESİ</option>
                                        <option value="ANKARA MALTEPE">ANKARA MALTEPE VERGİ DAİRESİ</option>
                                        <option value="ANTALYA KURUMLAR">ANTALYA KURUMLAR VERGİ DAİRESİ</option>
                                        <option value="ARAKLI">ARAKLI VERGİ DAİRESİ</option>
                                        <option value="ARAPGİR">ARAPGİR VERGİ DAİRESİ</option>
                                        <option value="ARDA">ARDA VERGİ DAİRESİ</option>
                                        <option value="ARDAHAN">ARDAHAN VERGİ DAİRESİ</option>
                                        <option value="ARDEŞEN">ARDEŞEN VERGİ DAİRESİ</option>
                                        <option value="ARHAVI">ARHAVI VERGİ DAİRESİ</option>
                                        <option value="ARHAVI MAL MUD">ARHAVI MAL MUD VERGİ DAİRESİ</option>
                                        <option value="ARMUTLU">ARMUTLU VERGİ DAİRESİ</option>
                                        <option value="ARSIN">ARSIN VERGİ DAİRESİ</option>
                                        <option value="ARTUKLU">ARTUKLU VERGİ DAİRESİ</option>
                                        <option value="ARTVIN">ARTVIN VERGİ DAİRESİ</option>
                                        <option value="ASIM GUNDUZ">ASIM GUNDUZ VERGİ DAİRESİ</option>
                                        <option value="ASKALE MAL.MUD.">ASKALE MAL.MUD. VERGİ DAİRESİ</option>
                                        <option value="ASLANBEY">ASLANBEY VERGİ DAİRESİ</option>
                                        <option value="ATAKOY">ATAKOY VERGİ DAİRESİ</option>
                                        <option value="ATASEHIR">ATASEHIR VERGİ DAİRESİ</option>
                                        <option value="ATIŞALANI">ATIŞALANI VERGİ DAİRESİ</option>
                                        <option value="ATU">ATU VERGİ DAİRESİ</option>
                                        <option value="AVANOS">AVANOS VERGİ DAİRESİ</option>
                                        <option value="AVCILAR">AVCILAR VERGİ DAİRESİ</option>
                                        <option value="AYANCIK">AYANCIK VERGİ DAİRESİ</option>
                                        <option value="AYBASTI">AYBASTI VERGİ DAİRESİ</option>
                                        <option value="AYDINCIK">AYDINCIK VERGİ DAİRESİ</option>
                                        <option value="AYRANCILAR">AYRANCILAR VERGİ DAİRESİ</option>
                                        <option value="AYVACIK">AYVACIK VERGİ DAİRESİ</option>
                                        <option value="AYVALIK">AYVALIK VERGİ DAİRESİ</option>
                                        <option value="AZIZIYE">AZIZIYE VERGİ DAİRESİ</option>
                                        <option value="B.MUKELLEFLER">B.MUKELLEFLER VERGİ DAİRESİ</option>
                                        <option value="BABAESKI">BABAESKI VERGİ DAİRESİ</option>
                                        <option value="BAFRA">BAFRA VERGİ DAİRESİ</option>
                                        <option value="BAGCILAR">BAGCILAR VERGİ DAİRESİ</option>
                                        <option value="BAHCELIEVLER">BAHCELIEVLER VERGİ DAİRESİ</option>
                                        <option value="BAKI">BAKI VERGİ DAİRESİ</option>
                                        <option value="BAKIRKOY">BAKIRKOY VERGİ DAİRESİ</option>
                                        <option value="BAKU">BAKU VERGİ DAİRESİ</option>
                                        <option value="BALCOVA">BALCOVA VERGİ DAİRESİ</option>
                                        <option value="BALÇOVA">BALÇOVA VERGİ DAİRESİ</option>
                                        <option value="BALIKESIR">BALIKESIR VERGİ DAİRESİ</option>
                                        <option value="BANAZ">BANAZ VERGİ DAİRESİ</option>
                                        <option value="BANDIRMA">BANDIRMA VERGİ DAİRESİ</option>
                                        <option value="BARTIN">BARTIN VERGİ DAİRESİ</option>
                                        <option value="BASKENT">BASKENT VERGİ DAİRESİ</option>
                                        <option value="BASMANE">BASMANE VERGİ DAİRESİ</option>
                                        <option value="BAŞKENT">BAŞKENT VERGİ DAİRESİ</option>
                                        <option value="BATMAN">BATMAN VERGİ DAİRESİ</option>
                                        <option value="BATTALGAZI">BATTALGAZI VERGİ DAİRESİ</option>
                                        <option value="BAYBURT">BAYBURT VERGİ DAİRESİ</option>
                                        <option value="BAYINDIR">BAYINDIR VERGİ DAİRESİ</option>
                                        <option value="BAYRAMIC">BAYRAMIC VERGİ DAİRESİ</option>
                                        <option value="BAYRAMPASA">BAYRAMPASA VERGİ DAİRESİ</option>
                                        <option value="BE">BE VERGİ DAİRESİ</option>
                                        <option value="BELEN MAL MUD.">BELEN MAL MUD. VERGİ DAİRESİ</option>
                                        <option value="BERGAMA">BERGAMA VERGİ DAİRESİ</option>
                                        <option value="BESIKDUZU">BESIKDUZU VERGİ DAİRESİ</option>
                                        <option value="BESIKTAS">BESIKTAS VERGİ DAİRESİ</option>
                                        <option value="BESOCAK">BESOCAK VERGİ DAİRESİ</option>
                                        <option value="BEYAZIT">BEYAZIT VERGİ DAİRESİ</option>
                                        <option value="BEYDAGI">BEYDAGI VERGİ DAİRESİ</option>
                                        <option value="BEYKOZ">BEYKOZ VERGİ DAİRESİ</option>
                                        <option value="BEYLIKDUZU">BEYLIKDUZU VERGİ DAİRESİ</option>
                                        <option value="BEYLIKOVA">BEYLIKOVA VERGİ DAİRESİ</option>
                                        <option value="BEYLİKDÜZÜ">BEYLİKDÜZÜ VERGİ DAİRESİ</option>
                                        <option value="BEYOGLU">BEYOGLU VERGİ DAİRESİ</option>
                                        <option value="BEYOGLU KURUMLAR">BEYOGLU KURUMLAR VERGİ DAİRESİ</option>
                                        <option value="BEYPAZARI">BEYPAZARI VERGİ DAİRESİ</option>
                                        <option value="BEYSEHIR">BEYSEHIR VERGİ DAİRESİ</option>
                                        <option value="BIGA">BIGA VERGİ DAİRESİ</option>
                                        <option value="BIGADIC">BIGADIC VERGİ DAİRESİ</option>
                                        <option value="BILECIK">BILECIK VERGİ DAİRESİ</option>
                                        <option value="BINGOL">BINGOL VERGİ DAİRESİ</option>
                                        <option value="BIRECIK">BIRECIK VERGİ DAİRESİ</option>
                                        <option value="BİSMİL">BİSMİL VERGİ DAİRESİ</option>
                                        <option value="BITLIS">BITLIS VERGİ DAİRESİ</option>
                                        <option value="BODRUM">BODRUM VERGİ DAİRESİ</option>
                                        <option value="BOGAZICI KURUMLAR">BOGAZICI KURUMLAR VERGİ DAİRESİ</option>
                                        <option value="BOLU">BOLU VERGİ DAİRESİ</option>
                                        <option value="BOLVADIN">BOLVADIN VERGİ DAİRESİ</option>
                                        <option value="BOR">BOR VERGİ DAİRESİ</option>
                                        <option value="BORCKA">BORCKA VERGİ DAİRESİ</option>
                                        <option value="BORNOVA">BORNOVA VERGİ DAİRESİ</option>
                                        <option value="BOYABAT">BOYABAT VERGİ DAİRESİ</option>
                                        <option value="BOZCAADA">BOZCAADA VERGİ DAİRESİ</option>
                                        <option value="BOZDOGAN">BOZDOGAN VERGİ DAİRESİ</option>
                                        <option value="BOZKURT">BOZKURT VERGİ DAİRESİ</option>
                                        <option value="BOZTEPE">BOZTEPE VERGİ DAİRESİ</option>
                                        <option value="BOZUYUK">BOZUYUK VERGİ DAİRESİ</option>
                                        <option value="BOZÜYÜK">BOZÜYÜK VERGİ DAİRESİ</option>
                                        <option value="BTW BE">BTW BE VERGİ DAİRESİ</option>
                                        <option value="BUCA">BUCA VERGİ DAİRESİ</option>
                                        <option value="BUCAK">BUCAK VERGİ DAİRESİ</option>
                                        <option value="BUHARKENT">BUHARKENT VERGİ DAİRESİ</option>
                                        <option value="BULANCAK">BULANCAK VERGİ DAİRESİ</option>
                                        <option value="BULDAN">BULDAN VERGİ DAİRESİ</option>
                                        <option value="BULVAR">BULVAR VERGİ DAİRESİ</option>
                                        <option value="BUNYAN">BUNYAN VERGİ DAİRESİ</option>
                                        <option value="BURDUR">BURDUR VERGİ DAİRESİ</option>
                                        <option value="BURDUR AGASUN MAL">BURDUR AGASUN MAL VERGİ DAİRESİ</option>
                                        <option value="BURHANIYE">BURHANIYE VERGİ DAİRESİ</option>
                                        <option value="BURSA">BURSA VERGİ DAİRESİ</option>
                                        <option value="BUYUK MUKELLEFLER">BUYUK MUKELLEFLER VERGİ DAİRESİ</option>
                                        <option value="BUYUKCEKMECE">BUYUKCEKMECE VERGİ DAİRESİ</option>
                                        <option value="BÜYÜKORHAN">BÜYÜKORHAN VERGİ DAİRESİ</option>
                                        <option value="CAKABEY">CAKABEY VERGİ DAİRESİ</option>
                                        <option value="CALAU">CALAU VERGİ DAİRESİ</option>
                                        <option value="CAMLICA İHTİSAS">CAMLICA İHTİSAS VERGİ DAİRESİ</option>
                                        <option value="CAN">CAN VERGİ DAİRESİ</option>
                                        <option value="CANAKKALE">CANAKKALE VERGİ DAİRESİ</option>
                                        <option value="CANKAYA">CANKAYA VERGİ DAİRESİ</option>
                                        <option value="CANKIRI">CANKIRI VERGİ DAİRESİ</option>
                                        <option value="CAPA">CAPA VERGİ DAİRESİ</option>
                                        <option value="CARSAMBA">CARSAMBA VERGİ DAİRESİ</option>
                                        <option value="CAT">CAT VERGİ DAİRESİ</option>
                                        <option value="CATALCA">CATALCA VERGİ DAİRESİ</option>
                                        <option value="CAVDIR">CAVDIR VERGİ DAİRESİ</option>
                                        <option value="CAYBASI">CAYBASI VERGİ DAİRESİ</option>
                                        <option value="CAYCUMA">CAYCUMA VERGİ DAİRESİ</option>
                                        <option value="CAYELI">CAYELI VERGİ DAİRESİ</option>
                                        <option value="CEBESOY">CEBESOY VERGİ DAİRESİ</option>
                                        <option value="CEKIRGE">CEKIRGE VERGİ DAİRESİ</option>
                                        <option value="CELTIKCI">CELTIKCI VERGİ DAİRESİ</option>
                                        <option value="CERKES">CERKES VERGİ DAİRESİ</option>
                                        <option value="CERKEZKOY">CERKEZKOY VERGİ DAİRESİ</option>
                                        <option value="CESME">CESME VERGİ DAİRESİ</option>
                                        <option value="CEYHAN">CEYHAN VERGİ DAİRESİ</option>
                                        <option value="CH">CH VERGİ DAİRESİ</option>
                                        <option value="CIDE">CIDE VERGİ DAİRESİ</option>
                                        <option value="CIFTELER">CIFTELER VERGİ DAİRESİ</option>
                                        <option value="CIGLI">CIGLI VERGİ DAİRESİ</option>
                                        <option value="CIHANBEYLIGI">CIHANBEYLIGI VERGİ DAİRESİ</option>
                                        <option value="CILIMLI">CILIMLI VERGİ DAİRESİ</option>
                                        <option value="CINAR">CINAR VERGİ DAİRESİ</option>
                                        <option value="CINARCIK">CINARCIK VERGİ DAİRESİ</option>
                                        <option value="CINE">CINE VERGİ DAİRESİ</option>
                                        <option value="CINILI">CINILI VERGİ DAİRESİ</option>
                                        <option value="CIVRIL">CIVRIL VERGİ DAİRESİ</option>
                                        <option value="CIZRE">CIZRE VERGİ DAİRESİ</option>
                                        <option value="CORLU">CORLU VERGİ DAİRESİ</option>
                                        <option value="CORUM">CORUM VERGİ DAİRESİ</option>
                                        <option value="CUBUK">CUBUK VERGİ DAİRESİ</option>
                                        <option value="CUKUROVA">CUKUROVA VERGİ DAİRESİ</option>
                                        <option value="CUMAYERI">CUMAYERI VERGİ DAİRESİ</option>
                                        <option value="CUMHURIYET">CUMHURIYET VERGİ DAİRESİ</option>
                                        <option value="CUMRA">CUMRA VERGİ DAİRESİ</option>
                                        <option value="ÇAKABEY">ÇAKABEY VERGİ DAİRESİ</option>
                                        <option value="ÇANKAYA">ÇANKAYA VERGİ DAİRESİ</option>
                                        <option value="ÇARŞIBAŞI">ÇARŞIBAŞI VERGİ DAİRESİ</option>
                                        <option value="ÇAY">ÇAY VERGİ DAİRESİ</option>
                                        <option value="ÇERKEZKÖY">ÇERKEZKÖY VERGİ DAİRESİ</option>
                                        <option value="ÇERMİK">ÇERMİK VERGİ DAİRESİ</option>
                                        <option value="DALAMAN">DALAMAN VERGİ DAİRESİ</option>
                                        <option value="DARENDE">DARENDE VERGİ DAİRESİ</option>
                                        <option value="DATCA">DATCA VERGİ DAİRESİ</option>
                                        <option value="DAVRAZ">DAVRAZ VERGİ DAİRESİ</option>
                                        <option value="DAVUTPASA">DAVUTPASA VERGİ DAİRESİ</option>
                                        <option value="DAZKIRI">DAZKIRI VERGİ DAİRESİ</option>
                                        <option value="DE">DE VERGİ DAİRESİ</option>
                                        <option value="DELICE">DELICE VERGİ DAİRESİ</option>
                                        <option value="DEMİRCİ">DEMİRCİ VERGİ DAİRESİ</option>
                                        <option value="DEMRE">DEMRE VERGİ DAİRESİ</option>
                                        <option value="DERINCE">DERINCE VERGİ DAİRESİ</option>
                                        <option value="DERINKUYU">DERINKUYU VERGİ DAİRESİ</option>
                                        <option value="DEUTSCHLAND">DEUTSCHLAND VERGİ DAİRESİ</option>
                                        <option value="DEVELI">DEVELI VERGİ DAİRESİ</option>
                                        <option value="DEVREK">DEVREK VERGİ DAİRESİ</option>
                                        <option value="DIDIM">DIDIM VERGİ DAİRESİ</option>
                                        <option value="DIKILI">DIKILI VERGİ DAİRESİ</option>
                                        <option value="DIKILI MAL MUD">DIKILI MAL MUD VERGİ DAİRESİ</option>
                                        <option value="DIKIMEVI">DIKIMEVI VERGİ DAİRESİ</option>
                                        <option value="DINAR">DINAR VERGİ DAİRESİ</option>
                                        <option value="DIS TICARET">DIS TICARET VERGİ DAİRESİ</option>
                                        <option value="DISKAPI">DISKAPI VERGİ DAİRESİ</option>
                                        <option value="DIVRIGI">DIVRIGI VERGİ DAİRESİ</option>
                                        <option value="DIYADIN">DIYADIN VERGİ DAİRESİ</option>
                                        <option value="DOGANBEY">DOGANBEY VERGİ DAİRESİ</option>
                                        <option value="DOGU BEYAZIT">DOGU BEYAZIT VERGİ DAİRESİ</option>
                                        <option value="DOMANIC">DOMANIC VERGİ DAİRESİ</option>
                                        <option value="DORTYOL">DORTYOL VERGİ DAİRESİ</option>
                                        <option value="DUDEN">DUDEN VERGİ DAİRESİ</option>
                                        <option value="DURSUNBEY">DURSUNBEY VERGİ DAİRESİ</option>
                                        <option value="DUVEN">DUVEN VERGİ DAİRESİ</option>
                                        <option value="DUZCE">DUZCE VERGİ DAİRESİ</option>
                                        <option value="DUZICI">DUZICI VERGİ DAİRESİ</option>
                                        <option value="DÜDEN">DÜDEN VERGİ DAİRESİ</option>
                                        <option value="ECEABAT">ECEABAT VERGİ DAİRESİ</option>
                                        <option value="EDREMIT">EDREMIT VERGİ DAİRESİ</option>
                                        <option value="EFELER">EFELER VERGİ DAİRESİ</option>
                                        <option value="EFLANE">EFLANE VERGİ DAİRESİ</option>
                                        <option value="EFLANİ">EFLANİ VERGİ DAİRESİ</option>
                                        <option value="EGE">EGE VERGİ DAİRESİ</option>
                                        <option value="EGIRDIR">EGIRDIR VERGİ DAİRESİ</option>
                                        <option value="ELBISTAN">ELBISTAN VERGİ DAİRESİ</option>
                                        <option value="ELMADAG">ELMADAG VERGİ DAİRESİ</option>
                                        <option value="ELMALI">ELMALI VERGİ DAİRESİ</option>
                                        <option value="EMET">EMET VERGİ DAİRESİ</option>
                                        <option value="EMIRDAG">EMIRDAG VERGİ DAİRESİ</option>
                                        <option value="ENEZ">ENEZ VERGİ DAİRESİ</option>
                                        <option value="ERBAA">ERBAA VERGİ DAİRESİ</option>
                                        <option value="ERCIS">ERCİŞ VERGİ DAİRESİ</option>
                                        <option value="ERCIYES">ERCIYES VERGİ DAİRESİ</option>
                                        <option value="ERDEK">ERDEK VERGİ DAİRESİ</option>
                                        <option value="ERDEMLI">ERDEMLI VERGİ DAİRESİ</option>
                                        <option value="EREGLI">EREGLI VERGİ DAİRESİ</option>
                                        <option value="ERENKOY">ERENKOY VERGİ DAİRESİ</option>
                                        <option value="ERENLER VERGİ DAİRES">ERENLER VERGİ DAİRES VERGİ DAİRESİ</option>
                                        <option value="ERGANI">ERGANI VERGİ DAİRESİ</option>
                                        <option value="ERTUGRULGAZI">ERTUGRULGAZI VERGİ DAİRESİ</option>
                                        <option value="ERTUĞRULGAZİ">ERTUĞRULGAZİ VERGİ DAİRESİ</option>
                                        <option value="ERZIN">ERZIN VERGİ DAİRESİ</option>
                                        <option value="ERZINCAN">ERZINCAN VERGİ DAİRESİ</option>
                                        <option value="ERZURUM">ERZURUM VERGİ DAİRESİ</option>
                                        <option value="ESENLER">ESENLER VERGİ DAİRESİ</option>
                                        <option value="ESENYURT">ESENYURT VERGİ DAİRESİ</option>
                                        <option value="ESIL">ESIL VERGİ DAİRESİ</option>
                                        <option value="ESKIFOCA">ESKIFOCA VERGİ DAİRESİ</option>
                                        <option value="ESKISEHIR">ESKISEHIR VERGİ DAİRESİ</option>
                                        <option value="ESKİŞEHİR">ESKİŞEHİR VERGİ DAİRESİ</option>
                                        <option value="ESME">ESME VERGİ DAİRESİ</option>
                                        <option value="ESPIYE">ESPIYE VERGİ DAİRESİ</option>
                                        <option value="ETIMESGUT">ETIMESGUT VERGİ DAİRESİ</option>
                                        <option value="EZINE">EZINE VERGİ DAİRESİ</option>
                                        <option value="FATIH">FATIH VERGİ DAİRESİ</option>
                                        <option value="FATSA">FATSA VERGİ DAİRESİ</option>
                                        <option value="FETHIYE">FETHIYE VERGİ DAİRESİ</option>
                                        <option value="FEVZI PASA">FEVZI PASA VERGİ DAİRESİ</option>
                                        <option value="FINIKE MAL MUD.">FINIKE MAL MUD. VERGİ DAİRESİ</option>
                                        <option value="FIRAT">FIRAT VERGİ DAİRESİ</option>
                                        <option value="FOCA">FOCA VERGİ DAİRESİ</option>
                                        <option value="FR">FR VERGİ DAİRESİ</option>
                                        <option value="GALATA">GALATA VERGİ DAİRESİ</option>
                                        <option value="GAYRETTEPE">GAYRETTEPE VERGİ DAİRESİ</option>
                                        <option value="GAZIANTEP">GAZIANTEP VERGİ DAİRESİ</option>
                                        <option value="GAZIEMIR">GAZIEMIR VERGİ DAİRESİ</option>
                                        <option value="GAZIKENT">GAZIKENT VERGİ DAİRESİ</option>
                                        <option value="GAZILER">GAZILER VERGİ DAİRESİ</option>
                                        <option value="GAZIOSMANPASA">GAZIOSMANPASA VERGİ DAİRESİ</option>
                                        <option value="GAZIPASA">GAZIPASA VERGİ DAİRESİ</option>
                                        <option value="GAZİANTEP">GAZİANTEP VERGİ DAİRESİ</option>
                                        <option value="GB">GB VERGİ DAİRESİ</option>
                                        <option value="GEDIZ">GEDIZ VERGİ DAİRESİ</option>
                                        <option value="GELENDOST">GELENDOST VERGİ DAİRESİ</option>
                                        <option value="GELIBOLU">GELIBOLU VERGİ DAİRESİ</option>
                                        <option value="GEMEREK">GEMEREK VERGİ DAİRESİ</option>
                                        <option value="GEMLIK">GEMLIK VERGİ DAİRESİ</option>
                                        <option value="GEREDE">GEREDE VERGİ DAİRESİ</option>
                                        <option value="GERMENCIK">GERMENCIK VERGİ DAİRESİ</option>
                                        <option value="GERZE">GERZE VERGİ DAİRESİ</option>
                                        <option value="GEVAŞ">GEVAŞ VERGİ DAİRESİ</option>
                                        <option value="GEVHER NESIBE">GEVHER NESIBE VERGİ DAİRESİ</option>
                                        <option value="GEYVE">GEYVE VERGİ DAİRESİ</option>
                                        <option value="GIRESUN">GIRESUN VERGİ DAİRESİ</option>
                                        <option value="GIRNE">GIRNE VERGİ DAİRESİ</option>
                                        <option value="GOKALP">GOKALP VERGİ DAİRESİ</option>
                                        <option value="GOKCEADA">GOKCEADA VERGİ DAİRESİ</option>
                                        <option value="GOKDERE">GOKDERE VERGİ DAİRESİ</option>
                                        <option value="GOKPINAR">GOKPINAR VERGİ DAİRESİ</option>
                                        <option value="GOLBASI">GOLBASI VERGİ DAİRESİ</option>
                                        <option value="GOLCUK">GOLCUK VERGİ DAİRESİ</option>
                                        <option value="GOLE">GOLE VERGİ DAİRESİ</option>
                                        <option value="GOLKAYA">GOLKAYA VERGİ DAİRESİ</option>
                                        <option value="GOLKOY">GOLKOY VERGİ DAİRESİ</option>
                                        <option value="GOLOVA">GOLOVA VERGİ DAİRESİ</option>
                                        <option value="GOLPAZARI">GOLPAZARI VERGİ DAİRESİ</option>
                                        <option value="GONEN">GONEN VERGİ DAİRESİ</option>
                                        <option value="GORELE MAL MUD">GORELE MAL MUD VERGİ DAİRESİ</option>
                                        <option value="GOYNUK">GOYNUK VERGİ DAİRESİ</option>
                                        <option value="GOZTEPE">GOZTEPE VERGİ DAİRESİ</option>
                                        <option value="GÖKDERE">GÖKDERE VERGİ DAİRESİ</option>
                                        <option value="GÖLHİSAR">GÖLHİSAR VERGİ DAİRESİ</option>
                                        <option value="GÖLYAKA">GÖLYAKA VERGİ DAİRESİ</option>
                                        <option value="GÖRDES">GÖRDES VERGİ DAİRESİ</option>
                                        <option value="GÖKSUN">GÖKSUN VERGİ DAİRESİ</option>
                                        <option value="GULNAR">GULNAR VERGİ DAİRESİ</option>
                                        <option value="GULSEHIR">GULSEHIR VERGİ DAİRESİ</option>
                                        <option value="GULTEPE">GULTEPE VERGİ DAİRESİ</option>
                                        <option value="GULYALI">GULYALI VERGİ DAİRESİ</option>
                                        <option value="GUMRUKONU">GUMRUKONU VERGİ DAİRESİ</option>
                                        <option value="GUMUSHACIKOY">GUMUSHACIKOY VERGİ DAİRESİ</option>
                                        <option value="GUMUSHANE">GUMUSHANE VERGİ DAİRESİ</option>
                                        <option value="GUMUSOVA">GUMUSOVA VERGİ DAİRESİ</option>
                                        <option value="GUNESLI">GUNESLI VERGİ DAİRESİ</option>
                                        <option value="GUNEYSU">GUNEYSU VERGİ DAİRESİ</option>
                                        <option value="GUNGOREN">GUNGOREN VERGİ DAİRESİ</option>
                                        <option value="GURPINAR">GURPINAR VERGİ DAİRESİ</option>
                                        <option value="GUZELHISAR">GUZELHISAR VERGİ DAİRESİ</option>
                                        <option value="GUZELYURT">GUZELYURT VERGİ DAİRESİ</option>
                                        <option value="GÜLNAR">GÜLNAR VERGİ DAİRESİ</option>
                                        <option value="GÜNDOĞMUŞ">GÜNDOĞMUŞ VERGİ DAİRESİ</option>
                                        <option value="GÜRCİSTAN">GÜRCİSTAN VERGİ DAİRESİ</option>
                                        <option value="GÜROYMAK">GÜROYMAK VERGİ DAİRESİ</option>
                                        <option value="GÜRÜN">GÜRÜN VERGİ DAİRESİ</option>
                                        <option value="HACIBEKTAS">HACIBEKTAS VERGİ DAİRESİ</option>
                                        <option value="HACILAR">HACILAR VERGİ DAİRESİ</option>
                                        <option value="HADIM MAL MUD.">HADIM MAL MUD. VERGİ DAİRESİ</option>
                                        <option value="HAKKARI">HAKKARI VERGİ DAİRESİ</option>
                                        <option value="HALİÇ">HALİÇ VERGİ DAİRESİ</option>
                                        <option value="HALİÇ KURUMLAR">HALİÇ KURUMLAR VERGİ DAİRESİ</option>
                                        <option value="HALKALI">HALKALI VERGİ DAİRESİ</option>
                                        <option value="HAMIDIYE">HAMIDIYE VERGİ DAİRESİ</option>
                                        <option value="HANONU">HANONU VERGİ DAİRESİ</option>
                                        <option value="HARPUT">HARPUT VERGİ DAİRESİ</option>
                                        <option value="HASAN TAHSIN">HASAN TAHSIN VERGİ DAİRESİ</option>
                                        <option value="HATAY">HATAY VERGİ DAİRESİ</option>
                                        <option value="HAVRAN">HAVRAN VERGİ DAİRESİ</option>
                                        <option value="HAVZA">HAVZA VERGİ DAİRESİ</option>
                                        <option value="HAYRABOLU">HAYRABOLU VERGİ DAİRESİ</option>
                                        <option value="HAZAR">HAZAR VERGİ DAİRESİ</option>
                                        <option value="HEKIMHAN">HEKIMHAN VERGİ DAİRESİ</option>
                                        <option value="HENDEK">HENDEK VERGİ DAİRESİ</option>
                                        <option value="HINIS">HINIS VERGİ DAİRESİ</option>
                                        <option value="HITIT">HITIT VERGİ DAİRESİ</option>
                                        <option value="HIZIRBEY">HIZIRBEY VERGİ DAİRESİ</option>
                                        <option value="HKR">HKR VERGİ DAİRESİ</option>
                                        <option value="HOCAPASA">HOCAPASA VERGİ DAİRESİ</option>
                                        <option value="HOCAPAŞA">HOCAPAŞA VERGİ DAİRESİ</option>
                                        <option value="HOLAND">HOLAND VERGİ DAİRESİ</option>
                                        <option value="HONAZ">HONAZ VERGİ DAİRESİ</option>
                                        <option value="HOPA">HOPA VERGİ DAİRESİ</option>
                                        <option value="HORASAN MAL MUD">HORASAN MAL MUD VERGİ DAİRESİ</option>
                                        <option value="HUYUK">HUYUK VERGİ DAİRESİ</option>
                                        <option value="IDIL">IDIL VERGİ DAİRESİ</option>
                                        <option value="IGDIR">IGDIR VERGİ DAİRESİ</option>
                                        <option value="IGDIT">IGDIT VERGİ DAİRESİ</option>
                                        <option value="IHSAN BEY">IHSAN BEY VERGİ DAİRESİ</option>
                                        <option value="IHSANIYE">IHSANIYE VERGİ DAİRESİ</option>
                                        <option value="IKITELLI">IKITELLI VERGİ DAİRESİ</option>
                                        <option value="ILGIN">ILGIN VERGİ DAİRESİ</option>
                                        <option value="ILIC">ILIC VERGİ DAİRESİ</option>
                                        <option value="ILYASBEY">ILYASBEY VERGİ DAİRESİ</option>
                                        <option value="INCESU">INCESU VERGİ DAİRESİ</option>
                                        <option value="INEBOLU">INEBOLU VERGİ DAİRESİ</option>
                                        <option value="INEGOL">INEGOL VERGİ DAİRESİ</option>
                                        <option value="IPSALA">IPSALA VERGİ DAİRESİ</option>
                                        <option value="IRMAK">IRMAK VERGİ DAİRESİ</option>
                                        <option value="ISLAHIYE">ISLAHIYE VERGİ DAİRESİ</option>
                                        <option value="ISTIKLAL">ISTIKLAL VERGİ DAİRESİ</option>
                                        <option value="ITALYA">ITALYA VERGİ DAİRESİ</option>
                                        <option value="IVEDIK">IVEDIK VERGİ DAİRESİ</option>
                                        <option value="IVRINDI">IVRINDI VERGİ DAİRESİ</option>
                                        <option value="IZMIR">IZMIR VERGİ DAİRESİ</option>
                                        <option value="IZMIT">IZMIT VERGİ DAİRESİ</option>
                                        <option value="IZNIK">IZNIK VERGİ DAİRESİ</option>
                                        <option value="İHTİSAS">İHTİSAS VERGİ DAİRESİ</option>
                                        <option value="İLYAS BEY">İLYAS BEY VERGİ DAİRESİ</option>
                                        <option value="İLYASBEY">İLYASBEY VERGİ DAİRESİ</option>
                                        <option value="İMRANLI">İMRANLI VERGİ DAİRESİ</option>
                                        <option value="İNCİRLİOVA">İNCİRLİOVA VERGİ DAİRESİ</option>
                                        <option value="İSTANBUL">İSTANBUL VERGİ DAİRESİ</option>
                                        <option value="KACKAR">KACKAR VERGİ DAİRESİ</option>
                                        <option value="KADIFEKALE">KADIFEKALE VERGİ DAİRESİ</option>
                                        <option value="KADIKOY">KADIKOY VERGİ DAİRESİ</option>
                                        <option value="KADIRLI">KADIRLI VERGİ DAİRESİ</option>
                                        <option value="KAGITHANE">KAGITHANE VERGİ DAİRESİ</option>
                                        <option value="KAĞIZMAN">KAĞIZMAN VERGİ DAİRESİ</option>
                                        <option value="KAHRAMAN KAZAN">KAHRAMAN KAZAN VERGİ DAİRESİ</option>
                                        <option value="KAHTA">KAHTA VERGİ DAİRESİ</option>
                                        <option value="KALE">KALE VERGİ DAİRESİ</option>
                                        <option value="KALEDERE">KALEDERE VERGİ DAİRESİ</option>
                                        <option value="KALEKAPI">KALEKAPI VERGİ DAİRESİ</option>
                                        <option value="KALETEPE">KALETEPE VERGİ DAİRESİ</option>
                                        <option value="KANATLI">KANATLI VERGİ DAİRESİ</option>
                                        <option value="KANDIRA">KANDIRA VERGİ DAİRESİ</option>
                                        <option value="KANDIRA  MAL MUD">KANDIRA MAL MUD VERGİ DAİRESİ</option>
                                        <option value="KANGAL">KANGAL VERGİ DAİRESİ</option>
                                        <option value="KARABUK">KARABUK VERGİ DAİRESİ</option>
                                        <option value="KARABURUN">KARABURUN VERGİ DAİRESİ</option>
                                        <option value="KARACABEY">KARACABEY VERGİ DAİRESİ</option>
                                        <option value="KARAÇOBAN">KARAÇOBAN VERGİ DAİRESİ</option>
                                        <option value="KARADENIZ">KARADENIZ VERGİ DAİRESİ</option>
                                        <option value="KARADENIZ EREGLI">KARADENIZ EREGLI VERGİ DAİRESİ</option>
                                        <option value="KARAELMAS">KARAELMAS VERGİ DAİRESİ</option>
                                        <option value="KARAGUZEL">KARAGUZEL VERGİ DAİRESİ</option>
                                        <option value="KARAHALI">KARAHALI VERGİ DAİRESİ</option>
                                        <option value="KARAKOÇAN">KARAKOÇAN VERGİ DAİRESİ</option>
                                        <option value="KARAKOYUNLU">KARAKOYUNLU VERGİ DAİRESİ</option>
                                        <option value="KARAMAN">KARAMAN VERGİ DAİRESİ</option>
                                        <option value="KARAMANLI">KARAMANLI VERGİ DAİRESİ</option>
                                        <option value="KARAMURSEL">KARAMURSEL VERGİ DAİRESİ</option>
                                        <option value="KARAMÜRSEL">KARAMÜRSEL VERGİ DAİRESİ</option>
                                        <option value="KARAPÜRÇEK">KARAPÜRÇEK VERGİ DAİRESİ</option>
                                        <option value="KARASU">KARASU VERGİ DAİRESİ</option>
                                        <option value="KARATAS">KARATAS VERGİ DAİRESİ</option>
                                        <option value="KARESI">KARESI VERGİ DAİRESİ</option>
                                        <option value="KARINCALAR">KARINCALAR VERGİ DAİRESİ</option>
                                        <option value="KARS">KARS VERGİ DAİRESİ</option>
                                        <option value="KARSIYAKA">KARSIYAKA VERGİ DAİRESİ</option>
                                        <option value="KARTAL">KARTAL VERGİ DAİRESİ</option>
                                        <option value="KASIMPASA">KASIMPASA VERGİ DAİRESİ</option>
                                        <option value="KASKAR">KASKAR VERGİ DAİRESİ</option>
                                        <option value="KASTAMONU">KASTAMONU VERGİ DAİRESİ</option>
                                        <option value="KAŞ">KAŞ VERGİ DAİRESİ</option>
                                        <option value="KAVAKLIDERE">KAVAKLIDERE VERGİ DAİRESİ</option>
                                        <option value="KAYMAKKAPI">KAYMAKKAPI VERGİ DAİRESİ</option>
                                        <option value="KAYNARCA">KAYNARCA VERGİ DAİRESİ</option>
                                        <option value="KAYNAŞLI">KAYNAŞLI VERGİ DAİRESİ</option>
                                        <option value="KAYNAŞLI MAL MUD">KAYNAŞLI MAL MUD VERGİ DAİRESİ</option>
                                        <option value="KAYULHİSAL">KAYULHİSAL VERGİ DAİRESİ</option>
                                        <option value="KAZAN MAL MUD">KAZAN MAL MUD VERGİ DAİRESİ</option>
                                        <option value="KAZIM KARABEKIR">KAZIM KARABEKIR VERGİ DAİRESİ</option>
                                        <option value="KECIBORLU">KECIBORLU VERGİ DAİRESİ</option>
                                        <option value="KECIOREN">KECIOREN VERGİ DAİRESİ</option>
                                        <option value="KELKIT">KELKIT VERGİ DAİRESİ</option>
                                        <option value="KEMALPASA">KEMALPASA VERGİ DAİRESİ</option>
                                        <option value="KEMER">KEMER VERGİ DAİRESİ</option>
                                        <option value="KEMER MAL MUD">KEMER MAL MUD VERGİ DAİRESİ</option>
                                        <option value="KEMERALTI">KEMERALTI VERGİ DAİRESİ</option>
                                        <option value="KEPSUT">KEPSUT VERGİ DAİRESİ</option>
                                        <option value="KESAN">KESAN VERGİ DAİRESİ</option>
                                        <option value="KIBRIS">KIBRIS VERGİ DAİRESİ</option>
                                        <option value="KILIS">KILIS VERGİ DAİRESİ</option>
                                        <option value="KINIK">KINIK VERGİ DAİRESİ</option>
                                        <option value="KIRAZ">KIRAZ VERGİ DAİRESİ</option>
                                        <option value="KIRIKHAN">KIRIKHAN VERGİ DAİRESİ</option>
                                        <option value="KIRKAGAC">KIRKAGAC VERGİ DAİRESİ</option>
                                        <option value="KIRKLARELI">KIRKLARELI VERGİ DAİRESİ</option>
                                        <option value="KIRKPINAR">KIRKPINAR VERGİ DAİRESİ</option>
                                        <option value="KIRSEHIR">KIRSEHIR VERGİ DAİRESİ</option>
                                        <option value="KIZILAY">KIZILAY VERGİ DAİRESİ</option>
                                        <option value="KIZILBEY">KIZILBEY VERGİ DAİRESİ</option>
                                        <option value="KIZILMURAT">KIZILMURAT VERGİ DAİRESİ</option>
                                        <option value="KIZILTEPE">KIZILTEPE VERGİ DAİRESİ</option>
                                        <option value="KOCAALI">KOCAALI VERGİ DAİRESİ</option>
                                        <option value="KOCAMUSTAFA">KOCAMUSTAFA VERGİ DAİRESİ</option>
                                        <option value="KOCAMUSTAFAPASA">KOCAMUSTAFAPASA VERGİ DAİRESİ</option>
                                        <option value="KOCAPASA">KOCAPASA VERGİ DAİRESİ</option>
                                        <option value="KOCASINAN">KOCASINAN VERGİ DAİRESİ</option>
                                        <option value="KOCATEPE">KOCATEPE VERGİ DAİRESİ</option>
                                        <option value="KOCHISAR">KOCHISAR VERGİ DAİRESİ</option>
                                        <option value="KONAK">KONAK VERGİ DAİRESİ</option>
                                        <option value="KONYA BEYSEHIR">KONYA BEYSEHIR VERGİ DAİRESİ</option>
                                        <option value="KONYA EREGLI">KONYA EREGLI VERGİ DAİRESİ</option>
                                        <option value="KONYA SELCUK">KONYA SELCUK VERGİ DAİRESİ</option>
                                        <option value="KOPRUBASI">KOPRUBASI VERGİ DAİRESİ</option>
                                        <option value="KORDON">KORDON VERGİ DAİRESİ</option>
                                        <option value="KORFEZ">KORFEZ VERGİ DAİRESİ</option>
                                        <option value="KORKUTELI">KORKUTELI VERGİ DAİRESİ</option>
                                        <option value="KOSK MAL MUD">KOSK MAL MUD VERGİ DAİRESİ</option>
                                        <option value="KOVANCILAR">KOVANCILAR VERGİ DAİRESİ</option>
                                        <option value="KOYCEGIZ">KOYCEGIZ VERGİ DAİRESİ</option>
                                        <option value="KOYULHISAR">KOYULHISAR VERGİ DAİRESİ</option>
                                        <option value="KOZAN">KOZAN VERGİ DAİRESİ</option>
                                        <option value="KOZYATAGI">KOZYATAGI VERGİ DAİRESİ</option>
                                        <option value="KÖLN-MITTE">KÖLN-MITTE VERGİ DAİRESİ</option>
                                        <option value="KÖPETDAG">KÖPETDAG VERGİ DAİRESİ</option>
                                        <option value="KÖPRÜBAŞI">KÖPRÜBAŞI VERGİ DAİRESİ</option>
                                        <option value="KROATIEN">KROATIEN VERGİ DAİRESİ</option>
                                        <option value="KUCUKCEKMECE">KUCUKCEKMECE VERGİ DAİRESİ</option>
                                        <option value="KUCUKKOY">KUCUKKOY VERGİ DAİRESİ</option>
                                        <option value="KUCUKYALI">KUCUKYALI VERGİ DAİRESİ</option>
                                        <option value="KULA">KULA VERGİ DAİRESİ</option>
                                        <option value="KUMLUCA">KUMLUCA VERGİ DAİRESİ</option>
                                        <option value="KUMRU">KUMRU VERGİ DAİRESİ</option>
                                        <option value="KURTALAN">KURTALAN VERGİ DAİRESİ</option>
                                        <option value="KURTDERELI">KURTDERELI VERGİ DAİRESİ</option>
                                        <option value="KURUCASILE">KURUCASILE VERGİ DAİRESİ</option>
                                        <option value="KURULUM">KURULUM VERGİ DAİRESİ</option>
                                        <option value="KURUMLAR">KURUMLAR VERGİ DAİRESİ</option>
                                        <option value="KUSADASI">KUSADASI VERGİ DAİRESİ</option>
                                        <option value="KUTAHYA">KUTAHYA VERGİ DAİRESİ</option>
                                        <option value="KÜCÜKYALI">KÜCÜKYALI VERGİ DAİRESİ</option>
                                        <option value="LALELI">LALELI VERGİ DAİRESİ</option>
                                        <option value="LAPSEKI">LAPSEKI VERGİ DAİRESİ</option>
                                        <option value="LEFKOSE">LEFKOSE VERGİ DAİRESİ</option>
                                        <option value="LIMAN">LIMAN VERGİ DAİRESİ</option>
                                        <option value="LU">LU VERGİ DAİRESİ</option>
                                        <option value="LULEBURGAZ">LULEBURGAZ VERGİ DAİRESİ</option>
                                        <option value="LUXEMBOURG">LUXEMBOURG VERGİ DAİRESİ</option>
                                        <option value="LÜKSEMBURG">LÜKSEMBURG VERGİ DAİRESİ</option>
                                        <option value="MACKA MAL MUD">MACKA MAL MUD VERGİ DAİRESİ</option>
                                        <option value="MAGOSA">MAGOSA VERGİ DAİRESİ</option>
                                        <option value="MAHMUT BEY">MAHMUT BEY VERGİ DAİRESİ</option>
                                        <option value="MAL MUDURLUGU">MAL MUDURLUGU VERGİ DAİRESİ</option>
                                        <option value="MALATYA">MALATYA VERGİ DAİRESİ</option>
                                        <option value="MALAZGİRT">MALAZGİRT VERGİ DAİRESİ</option>
                                        <option value="MALKAR">MALKAR VERGİ DAİRESİ</option>
                                        <option value="MALKARA">MALKARA VERGİ DAİRESİ</option>
                                        <option value="MALMÜDÜRLÜĞÜ">MALMÜDÜRLÜĞÜ VERGİ DAİRESİ</option>
                                        <option value="MALTA">MALTA VERGİ DAİRESİ</option>
                                        <option value="MALTEPE">MALTEPE VERGİ DAİRESİ</option>
                                        <option value="MANAVGAT">MANAVGAT VERGİ DAİRESİ</option>
                                        <option value="MANISA">MANISA VERGİ DAİRESİ</option>
                                        <option value="MANYAS">MANYAS VERGİ DAİRESİ</option>
                                        <option value="MARDIN">MARDIN VERGİ DAİRESİ</option>
                                        <option value="MARMARA">MARMARA VERGİ DAİRESİ</option>
                                        <option value="MARMARA EREGLISI">MARMARA EREGLISI VERGİ DAİRESİ</option>
                                        <option value="MARMARA KURUMLAR">MARMARA KURUMLAR VERGİ DAİRESİ</option>
                                        <option value="MARMARIS">MARMARIS VERGİ DAİRESİ</option>
                                        <option value="MASLAK">MASLAK VERGİ DAİRESİ</option>
                                        <option value="MAZIDAĞI MAL MD.">MAZIDAĞI MAL MD. VERGİ DAİRESİ</option>
                                        <option value="MECIDIYEKOY">MECIDIYEKOY VERGİ DAİRESİ</option>
                                        <option value="MENDERES">MENDERES VERGİ DAİRESİ</option>
                                        <option value="MENEMEN">MENEMEN VERGİ DAİRESİ</option>
                                        <option value="MENGEN">MENGEN VERGİ DAİRESİ</option>
                                        <option value="MERAM">MERAM VERGİ DAİRESİ</option>
                                        <option value="MERCAN">MERCAN VERGİ DAİRESİ</option>
                                        <option value="MERSIN LIMAN">MERSIN LIMAN VERGİ DAİRESİ</option>
                                        <option value="MERTER">MERTER VERGİ DAİRESİ</option>
                                        <option value="MERZIFON">MERZIFON VERGİ DAİRESİ</option>
                                        <option value="MESIR">MESIR VERGİ DAİRESİ</option>
                                        <option value="MEVLANA">MEVLANA VERGİ DAİRESİ</option>
                                        <option value="MEVLANAKAPI">MEVLANAKAPI VERGİ DAİRESİ</option>
                                        <option value="MIDYAT">MIDYAT VERGİ DAİRESİ</option>
                                        <option value="MILAS">MILAS VERGİ DAİRESİ</option>
                                        <option value="MIMAR SINAN">MIMAR SINAN VERGİ DAİRESİ</option>
                                        <option value="MITHATPASA">MITHATPASA VERGİ DAİRESİ</option>
                                        <option value="MİMAR SİNAN">MİMAR SİNAN VERGİ DAİRESİ</option>
                                        <option value="MŞ.">MŞ. VERGİ DAİRESİ</option>
                                        <option value="MUAF">MUAF VERGİ DAİRESİ</option>
                                        <option value="MUDANYA">MUDANYA VERGİ DAİRESİ</option>
                                        <option value="MUDURNU">MUDURNU VERGİ DAİRESİ</option>
                                        <option value="MUGLA">MUGLA VERGİ DAİRESİ</option>
                                        <option value="MUHAMMET KARAGUZEL">MUHAMMET KARAGUZEL VERGİ DAİRESİ</option>
                                        <option value="MURATLI">MURATLI VERGİ DAİRESİ</option>
                                        <option value="MURGUL">MURGUL VERGİ DAİRESİ</option>
                                        <option value="MUS">MUS VERGİ DAİRESİ</option>
                                        <option value="MUSTAFAKEMALPASA">MUSTAFAKEMALPASA VERGİ DAİRESİ</option>
                                        <option value="MUT">MUT VERGİ DAİRESİ</option>
                                        <option value="NAKIL VASITALARI">NAKIL VASITALARI VERGİ DAİRESİ</option>
                                        <option value="NALLIHAN">NALLIHAN VERGİ DAİRESİ</option>
                                        <option value="NAMIK KEMAL">NAMIK KEMAL VERGİ DAİRESİ</option>
                                        <option value="NAZILLI">NAZILLI VERGİ DAİRESİ</option>
                                        <option value="NECATIBEY">NECATIBEY VERGİ DAİRESİ</option>
                                        <option value="NERIMANOV">NERIMANOV VERGİ DAİRESİ</option>
                                        <option value="NEVSEHIR">NEVSEHIR VERGİ DAİRESİ</option>
                                        <option value="NIGDE">NIGDE VERGİ DAİRESİ</option>
                                        <option value="NIKSAR">NIKSAR VERGİ DAİRESİ</option>
                                        <option value="NILUFER">NILUFER VERGİ DAİRESİ</option>
                                        <option value="NISANTASI">NISANTASI VERGİ DAİRESİ</option>
                                        <option value="NIZIP">NIZIP VERGİ DAİRESİ</option>
                                        <option value="NURA">NURA VERGİ DAİRESİ</option>
                                        <option value="NURAY">NURAY VERGİ DAİRESİ</option>
                                        <option value="NURUOSMANIYE">NURUOSMANIYE VERGİ DAİRESİ</option>
                                        <option value="NUSAYBİN">NUSAYBİN VERGİ DAİRESİ</option>
                                        <option value="ODEMIS">ODEMIS VERGİ DAİRESİ</option>
                                        <option value="OF">OF VERGİ DAİRESİ</option>
                                        <option value="OLTU">OLTU VERGİ DAİRESİ</option>
                                        <option value="ONDOKUZMAYIS">ONDOKUZMAYIS VERGİ DAİRESİ</option>
                                        <option value="ORDU">ORDU VERGİ DAİRESİ</option>
                                        <option value="ORHANGAZI">ORHANGAZI VERGİ DAİRESİ</option>
                                        <option value="ORTA">ORTA VERGİ DAİRESİ</option>
                                        <option value="ORTACA">ORTACA VERGİ DAİRESİ</option>
                                        <option value="ORTAKOY">ORTAKOY VERGİ DAİRESİ</option>
                                        <option value="OSMANCIK">OSMANCIK VERGİ DAİRESİ</option>
                                        <option value="OSMANELI">OSMANELI VERGİ DAİRESİ</option>
                                        <option value="OSMANGAZI">OSMANGAZI VERGİ DAİRESİ</option>
                                        <option value="OSMANIYE">OSMANIYE VERGİ DAİRESİ</option>
                                        <option value="OSTIM">OSTIM VERGİ DAİRESİ</option>
                                        <option value="PAMUKKALE">PAMUKKALE VERGİ DAİRESİ</option>
                                        <option value="PAMUKOVA">PAMUKOVA VERGİ DAİRESİ</option>
                                        <option value="PASINLER MAL MUD">PASINLER MAL MUD VERGİ DAİRESİ</option>
                                        <option value="PATNOS">PATNOS VERGİ DAİRESİ</option>
                                        <option value="PAZAR">PAZAR VERGİ DAİRESİ</option>
                                        <option value="PENDIK">PENDIK VERGİ DAİRESİ</option>
                                        <option value="PERSEMBE">PERSEMBE VERGİ DAİRESİ</option>
                                        <option value="PINARHISAR">PINARHISAR VERGİ DAİRESİ</option>
                                        <option value="PIRAZIZ">PIRAZIZ VERGİ DAİRESİ</option>
                                        <option value="POLATLI">POLATLI VERGİ DAİRESİ</option>
                                        <option value="POZANTI">POZANTI VERGİ DAİRESİ</option>
                                        <option value="RAMI">RAMI VERGİ DAİRESİ</option>
                                        <option value="REFAHIYE">REFAHIYE VERGİ DAİRESİ</option>
                                        <option value="RESMİ">RESMİ VERGİ DAİRESİ</option>
                                        <option value="REŞADİYE">REŞADİYE VERGİ DAİRESİ</option>
                                        <option value="REYHANLI">REYHANLI VERGİ DAİRESİ</option>
                                        <option value="RIHTIM">RIHTIM VERGİ DAİRESİ</option>
                                        <option value="ROMA">ROMA VERGİ DAİRESİ</option>
                                        <option value="SAFRANBOLU">SAFRANBOLU VERGİ DAİRESİ</option>
                                        <option value="SAHINBEY">SAHINBEY VERGİ DAİRESİ</option>
                                        <option value="SAKARYA">SAKARYA VERGİ DAİRESİ</option>
                                        <option value="SALIHLI">SALIHLI VERGİ DAİRESİ</option>
                                        <option value="SALIHLI ADIL ORAL">SALIHLI ADIL ORAL VERGİ DAİRESİ</option>
                                        <option value="SAMANDAG">SAMANDAG VERGİ DAİRESİ</option>
                                        <option value="SAMSUN">SAMSUN VERGİ DAİRESİ</option>
                                        <option value="SANDIKLI">SANDIKLI VERGİ DAİRESİ</option>
                                        <option value="SAPANCA">SAPANCA VERGİ DAİRESİ</option>
                                        <option value="SAPHANE">SAPHANE VERGİ DAİRESİ</option>
                                        <option value="SARAY">SARAY VERGİ DAİRESİ</option>
                                        <option value="SARAYKOY">SARAYKOY VERGİ DAİRESİ</option>
                                        <option value="SARAYLAR">SARAYLAR VERGİ DAİRESİ</option>
                                        <option value="SARIGAZI">SARIGAZI VERGİ DAİRESİ</option>
                                        <option value="SARIGOL">SARIGOL VERGİ DAİRESİ</option>
                                        <option value="SARIVELILER">SARIVELILER VERGİ DAİRESİ</option>
                                        <option value="SARIYER">SARIYER VERGİ DAİRESİ</option>
                                        <option value="SARKISLA">SARKISLA VERGİ DAİRESİ</option>
                                        <option value="SARKOY">SARKOY VERGİ DAİRESİ</option>
                                        <option value="SARUHANLI">SARUHANLI VERGİ DAİRESİ</option>
                                        <option value="SAVASLI">SAVASLI VERGİ DAİRESİ</option>
                                        <option value="SAVSAT">SAVSAT VERGİ DAİRESİ</option>
                                        <option value="SEBEN">SEBEN VERGİ DAİRESİ</option>
                                        <option value="SEBINKARAHISAR">SEBINKARAHISAR VERGİ DAİRESİ</option>
                                        <option value="SEFAKOY">SEFAKOY VERGİ DAİRESİ</option>
                                        <option value="SEFERIHISAR">SEFERIHISAR VERGİ DAİRESİ</option>
                                        <option value="SEFERIHISAR MAL MUD.">SEFERIHISAR MAL MUD. VERGİ DAİRESİ</option>
                                        <option value="SEGMENLER">SEGMENLER VERGİ DAİRESİ</option>
                                        <option value="SEHIRLIK">SEHIRLIK VERGİ DAİRESİ</option>
                                        <option value="SEHIT KERIM">SEHIT KERIM VERGİ DAİRESİ</option>
                                        <option value="SEHITKAMIL">SEHITKAMIL VERGİ DAİRESİ</option>
                                        <option value="SEHITLIK">SEHITLIK VERGİ DAİRESİ</option>
                                        <option value="SELCUK">SELCUK VERGİ DAİRESİ</option>
                                        <option value="SELENDI">SELENDI VERGİ DAİRESİ</option>
                                        <option value="SELINHISAR">SELINHISAR VERGİ DAİRESİ</option>
                                        <option value="SELİM MAL MÜDÜRLÜĞÜ">SELİM MAL MÜDÜRLÜĞÜ VERGİ DAİRESİ</option>
                                        <option value="SEMDINLI">SEMDINLI VERGİ DAİRESİ</option>
                                        <option value="SENİRKENT">SENİRKENT VERGİ DAİRESİ</option>
                                        <option value="SEREFLIKOCHISAR">SEREFLIKOCHISAR VERGİ DAİRESİ</option>
                                        <option value="SERIK">SERIK VERGİ DAİRESİ</option>
                                        <option value="SERINHISAR">SERINHISAR VERGİ DAİRESİ</option>
                                        <option value="SETBASI">SETBASI VERGİ DAİRESİ</option>
                                        <option value="SEYDILER">SEYDILER VERGİ DAİRESİ</option>
                                        <option value="SEYDISEHIR">SEYDISEHIR VERGİ DAİRESİ</option>
                                        <option value="SEYDİKEMER">SEYDİKEMER VERGİ DAİRESİ</option>
                                        <option value="SEYHAN">SEYHAN VERGİ DAİRESİ</option>
                                        <option value="SEYITGAZI">SEYITGAZI VERGİ DAİRESİ</option>
                                        <option value="SEYMENLER">SEYMENLER VERGİ DAİRESİ</option>
                                        <option value="SIIRT">SIIRT VERGİ DAİRESİ</option>
                                        <option value="SILE">SILE VERGİ DAİRESİ</option>
                                        <option value="SILIFKE">SILIFKE VERGİ DAİRESİ</option>
                                        <option value="SILIVRI">SILIVRI VERGİ DAİRESİ</option>
                                        <option value="SILOPI">SILOPI VERGİ DAİRESİ</option>
                                        <option value="SIMAV">SIMAV VERGİ DAİRESİ</option>
                                        <option value="SINANPASA">SINANPASA VERGİ DAİRESİ</option>
                                        <option value="SINCAN">SINCAN VERGİ DAİRESİ</option>
                                        <option value="SINDIRGI">SINDIRGI VERGİ DAİRESİ</option>
                                        <option value="SINOP">SINOP VERGİ DAİRESİ</option>
                                        <option value="SIRINYER">SIRINYER VERGİ DAİRESİ</option>
                                        <option value="SIRNAK">SIRNAK VERGİ DAİRESİ</option>
                                        <option value="SISLI">SISLI VERGİ DAİRESİ</option>
                                        <option value="SITE">SITE VERGİ DAİRESİ</option>
                                        <option value="SIVAS">SIVAS VERGİ DAİRESİ</option>
                                        <option value="SIVASLI">SIVASLI VERGİ DAİRESİ</option>
                                        <option value="Sİ">Sİ VERGİ DAİRESİ</option>
                                        <option value="SİVEREK">SİVEREK VERGİ DAİRESİ</option>
                                        <option value="SK">SK VERGİ DAİRESİ</option>
                                        <option value="SLOBOZİ">SLOBOZİ VERGİ DAİRESİ</option>
                                        <option value="SOKE">SOKE VERGİ DAİRESİ</option>
                                        <option value="SOMA">SOMA VERGİ DAİRESİ</option>
                                        <option value="SORGUN">SORGUN VERGİ DAİRESİ</option>
                                        <option value="SOUTH AFRİCA">SOUTH AFRİCA VERGİ DAİRESİ</option>
                                        <option value="SÖĞÜT">SÖĞÜT VERGİ DAİRESİ</option>
                                        <option value="STEUER NR">STEUER NR VERGİ DAİRESİ</option>
                                        <option value="SUBURCU">SUBURCU VERGİ DAİRESİ</option>
                                        <option value="SUHUT MAL MUDURLUGU">SUHUT MAL MUDURLUGU VERGİ DAİRESİ</option>
                                        <option value="SUKRU KANATLI">SUKRU KANATLI VERGİ DAİRESİ</option>
                                        <option value="SULEYMAN NAZIF">SULEYMAN NAZIF VERGİ DAİRESİ</option>
                                        <option value="SULEYMANIYE">SULEYMANIYE VERGİ DAİRESİ</option>
                                        <option value="SULEYMANPASA">SULEYMANPASA VERGİ DAİRESİ</option>
                                        <option value="SULOGLU">SULOGLU VERGİ DAİRESİ</option>
                                        <option value="SULTANAHMET">SULTANAHMET VERGİ DAİRESİ</option>
                                        <option value="SULTANBEYLI">SULTANBEYLI VERGİ DAİRESİ</option>
                                        <option value="SULTANGAZİ">SULTANGAZİ VERGİ DAİRESİ</option>
                                        <option value="SULTANHISAR">SULTANHISAR VERGİ DAİRESİ</option>
                                        <option value="SULUOVA">SULUOVA VERGİ DAİRESİ</option>
                                        <option value="SUNGURLU">SUNGURLU VERGİ DAİRESİ</option>
                                        <option value="SURMENE">SURMENE VERGİ DAİRESİ</option>
                                        <option value="SURUC">SURUC VERGİ DAİRESİ</option>
                                        <option value="SUSEHRI">SUSEHRI VERGİ DAİRESİ</option>
                                        <option value="SUSURLUK">SUSURLUK VERGİ DAİRESİ</option>
                                        <option value="ŞARKİKARAAĞAÇ">ŞARKİKARAAĞAÇ VERGİ DAİRESİ</option>
                                        <option value="ŞEHİTKERİM">ŞEHİTKERİM VERGİ DAİRESİ</option>
                                        <option value="ŞİŞLİ">ŞİŞLİ VERGİ DAİRESİ</option>
                                        <option value="T.C">T.C VERGİ DAİRESİ</option>
                                        <option value="TASBASI">TASBASI VERGİ DAİRESİ</option>
                                        <option value="TASKOPRU">TASKOPRU VERGİ DAİRESİ</option>
                                        <option value="TAŞOVA">TAŞOVA VERGİ DAİRESİ</option>
                                        <option value="TATVAN">TATVAN VERGİ DAİRESİ</option>
                                        <option value="TAVSANLI">TAVSANLI VERGİ DAİRESİ</option>
                                        <option value="TCNO">TCNO VERGİ DAİRESİ</option>
                                        <option value="TEFENNİ">TEFENNİ VERGİ DAİRESİ</option>
                                        <option value="TEKCEKOY">TEKCEKOY VERGİ DAİRESİ</option>
                                        <option value="TEKIRDAG">TEKIRDAG VERGİ DAİRESİ</option>
                                        <option value="TEKKEKOY">TEKKEKOY VERGİ DAİRESİ</option>
                                        <option value="TEM">TEM VERGİ DAİRESİ</option>
                                        <option value="TEPECIK">TEPECIK VERGİ DAİRESİ</option>
                                        <option value="TERME">TERME VERGİ DAİRESİ</option>
                                        <option value="TINAZTEPE">TINAZTEPE VERGİ DAİRESİ</option>
                                        <option value="TIRE">TIRE VERGİ DAİRESİ</option>
                                        <option value="TIREBOLU">TIREBOLU VERGİ DAİRESİ</option>
                                        <option value="TOKAT">TOKAT VERGİ DAİRESİ</option>
                                        <option value="TOPCU MEYDANI">TOPCU MEYDANI VERGİ DAİRESİ</option>
                                        <option value="TORBALI">TORBALI VERGİ DAİRESİ</option>
                                        <option value="TORTUM">TORTUM VERGİ DAİRESİ</option>
                                        <option value="TOSYA">TOSYA VERGİ DAİRESİ</option>
                                        <option value="TRABZON">TRABZON VERGİ DAİRESİ</option>
                                        <option value="TUFANBEYLİ">TUFANBEYLİ VERGİ DAİRESİ</option>
                                        <option value="TUNA">TUNA VERGİ DAİRESİ</option>
                                        <option value="TUNCELI">TUNCELI VERGİ DAİRESİ</option>
                                        <option value="TURGUTLU">TURGUTLU VERGİ DAİRESİ</option>
                                        <option value="TURHAL">TURHAL VERGİ DAİRESİ</option>
                                        <option value="TURKOĞLU">TURKOĞLU VERGİ DAİRESİ</option>
                                        <option value="TUZLA">TUZLA VERGİ DAİRESİ</option>
                                        <option value="UCKAPILAR">UCKAPILAR VERGİ DAİRESİ</option>
                                        <option value="UCKUYULAR">UCKUYULAR VERGİ DAİRESİ</option>
                                        <option value="UK">UK VERGİ DAİRESİ</option>
                                        <option value="ULA">ULA VERGİ DAİRESİ</option>
                                        <option value="ULASTIRMA">ULASTIRMA VERGİ DAİRESİ</option>
                                        <option value="ULUBORLU">ULUBORLU VERGİ DAİRESİ</option>
                                        <option value="ULUCINAR">ULUCINAR VERGİ DAİRESİ</option>
                                        <option value="ULUDAG">ULUDAG VERGİ DAİRESİ</option>
                                        <option value="ULUKISLA">ULUKISLA VERGİ DAİRESİ</option>
                                        <option value="ULUS">ULUS VERGİ DAİRESİ</option>
                                        <option value="ULUSITE">ULUSITE VERGİ DAİRESİ</option>
                                        <option value="UMRANIYE">UMRANIYE VERGİ DAİRESİ</option>
                                        <option value="UNYE">UNYE VERGİ DAİRESİ</option>
                                        <option value="URAY">URAY VERGİ DAİRESİ</option>
                                        <option value="URGUP">URGUP VERGİ DAİRESİ</option>
                                        <option value="URGUP MAL MUD">URGUP MAL MUD VERGİ DAİRESİ</option>
                                        <option value="URLA">URLA VERGİ DAİRESİ</option>
                                        <option value="USAK">USAK VERGİ DAİRESİ</option>
                                        <option value="USKUDAR">USKUDAR VERGİ DAİRESİ</option>
                                        <option value="USKUDAR KURUMLAR">USKUDAR KURUMLAR VERGİ DAİRESİ</option>
                                        <option value="UZUNDERE">UZUNDERE VERGİ DAİRESİ</option>
                                        <option value="UZUNKOPRU">UZUNKOPRU VERGİ DAİRESİ</option>
                                        <option value="UZUNMEHMET">UZUNMEHMET VERGİ DAİRESİ</option>
                                        <option value="ÜÇKAPILAR">ÜÇKAPILAR VERGİ DAİRESİ</option>
                                        <option value="ÜMRANİYE">ÜMRANİYE VERGİ DAİRESİ</option>
                                        <option value="VAKFIKEBIR">VAKFIKEBIR VERGİ DAİRESİ</option>
                                        <option value="VAN">VAN VERGİ DAİRESİ</option>
                                        <option value="VATAN İHTİSAS">VATAN İHTİSAS VERGİ DAİRESİ</option>
                                        <option value="VIRANSEHIR">VIRANSEHIR VERGİ DAİRESİ</option>
                                        <option value="VIZE">VIZE VERGİ DAİRESİ</option>
                                        <option value="WEİNMARKT">WEİNMARKT VERGİ DAİRESİ</option>
                                        <option value="YAHYAGALIP">YAHYAGALIP VERGİ DAİRESİ</option>
                                        <option value="YAHYALI">YAHYALI VERGİ DAİRESİ</option>
                                        <option value="YAKACIK">YAKACIK VERGİ DAİRESİ</option>
                                        <option value="YAKAKENT">YAKAKENT VERGİ DAİRESİ</option>
                                        <option value="YALOVA">YALOVA VERGİ DAİRESİ</option>
                                        <option value="YALVAC">YALVAC VERGİ DAİRESİ</option>
                                        <option value="YAMANLAR">YAMANLAR VERGİ DAİRESİ</option>
                                        <option value="YATAGAN">YATAGAN VERGİ DAİRESİ</option>
                                        <option value="YATAĞAN">YATAĞAN VERGİ DAİRESİ</option>
                                        <option value="YEGENBEY">YEGENBEY VERGİ DAİRESİ</option>
                                        <option value="YENERCIK">YENERCIK VERGİ DAİRESİ</option>
                                        <option value="YENIBOSNA">YENIBOSNA VERGİ DAİRESİ</option>
                                        <option value="YENICAGA">YENICAGA VERGİ DAİRESİ</option>
                                        <option value="YENICE">YENICE VERGİ DAİRESİ</option>
                                        <option value="YENIFOCA">YENIFOCA VERGİ DAİRESİ</option>
                                        <option value="YENIKAPI">YENIKAPI VERGİ DAİRESİ</option>
                                        <option value="YENIMAHALLE">YENIMAHALLE VERGİ DAİRESİ</option>
                                        <option value="YENIPAZAR">YENIPAZAR VERGİ DAİRESİ</option>
                                        <option value="YENISEHIR">YENISEHIR VERGİ DAİRESİ</option>
                                        <option value="YERKOY">YERKOY VERGİ DAİRESİ</option>
                                        <option value="YESILCAY">YESILCAY VERGİ DAİRESİ</option>
                                        <option value="YESILOVA">YESILOVA VERGİ DAİRESİ</option>
                                        <option value="YESILYURT">YESILYURT VERGİ DAİRESİ</option>
                                        <option value="YILDIRIM">YILDIRIM VERGİ DAİRESİ</option>
                                        <option value="YILDIRIM BEYAZIT">YILDIRIM BEYAZIT VERGİ DAİRESİ</option>
                                        <option value="YOMRA">YOMRA VERGİ DAİRESİ</option>
                                        <option value="YOZGAT">YOZGAT VERGİ DAİRESİ</option>
                                        <option value="YUNUS EMRE">YUNUS EMRE VERGİ DAİRESİ</option>
                                        <option value="YUREGIR">YUREGIR VERGİ DAİRESİ</option>
                                        <option value="YUSUFELI">YUSUFELI VERGİ DAİRESİ</option>
                                        <option value="YÜKSEKOVA">YÜKSEKOVA VERGİ DAİRESİ</option>
                                        <option value="ZARA">ZARA VERGİ DAİRESİ</option>
                                        <option value="ZEYTINBURNU">ZEYTINBURNU VERGİ DAİRESİ</option>
                                        <option value="ZILE">ZILE VERGİ DAİRESİ</option>
                                        <option value="ZINCIRLIKUYU">ZINCIRLIKUYU VERGİ DAİRESİ</option>
                                        <option value="ZIYA PAŞA">ZIYA PAŞA VERGİ DAİRESİ</option>
                                        <option value="ZİYAGÖKALP">ZİYAGÖKALP VERGİ DAİRESİ</option>
                                    </select>
                                    <span class="no-wrap error-span" id="invoice_tax_administration_error"></span>
                                </div>
                                <div class="col-12 col-md-4 mb-2 px-2 cart-tc-number-box">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        T.C. Kimlik No
                                        <span class="text-theme-orange ms-auto fs-8">(Zorunlu Alan)</span>
                                    </label>
                                    <input class="mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control"
                                           type="text" placeholder="T.C. Kimlik No" maxlength="11"
                                           onkeypress="return isNumberKey(event)" name="tc_number"
                                           value="<?= $billingAndDeliveryData != [] && isset($billingAndDeliveryData["tc_number"]) ? $billingAndDeliveryData["tc_number"] : set_value('tc_number') ?>">
                                    <span class="no-wrap error-span" id="tc_number_error"></span>
                                </div>
                                <div class="col-12 col-md-4 mb-2 px-2 cart-tax-number-box d-none">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        Vergi Numarası
                                        <span class="text-theme-orange ms-auto fs-8">(Zorunlu Alan)</span>
                                    </label>
                                    <input class="mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control"
                                           type="text" placeholder="Vergi Numarası" name="tax_number"
                                           value="<?= $billingAndDeliveryData != [] && isset($billingAndDeliveryData["tax_number"]) ? $billingAndDeliveryData["tax_number"] : set_value('tax_number') ?>">
                                    <span class="no-wrap error-span" id="tax_number_error"></span>
                                </div>
                                <div class="col-12 col-md-4 mb-2 px-2 ">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        E-Posta Adresi
                                        <span class="text-theme-orange ms-auto fs-8">(Zorunlu Alan)</span>
                                    </label>
                                    <input class="mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control"
                                           type="text" placeholder="E-Posta Adresi" name="e_mail"
                                           value="<?= $billingAndDeliveryData != [] && isset($billingAndDeliveryData["e_mail"]) ? $billingAndDeliveryData["e_mail"] : set_value('e_mail') ?>">
                                    <span class="no-wrap error-span" id="e_mail_error"></span>
                                </div>
                                <div class="col-12 col-md-4 mb-2 px-2 ">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        Telefon Numarası
                                        <span class="text-theme-orange ms-auto fs-8">(Zorunlu Alan)</span>
                                    </label>
                                    <input class="phone-input mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control"
                                           type="text" placeholder="Telefon Numarası" name="phone"
                                           value="<?= $billingAndDeliveryData != [] && isset($billingAndDeliveryData["phone"]) ? $billingAndDeliveryData["phone"] : set_value('phone') ?>">
                                    <span class="no-wrap error-span" id="phone_error"></span>
                                </div>
                                <div class="col-12 mb-2 px-2">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        Açık Adres
                                        <span class="text-theme-orange ms-auto fs-8">(Zorunlu Alan)</span>
                                    </label>
                                    <textarea name="invoice_adress"
                                              class="mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control"
                                              cols="30" rows="5"
                                              placeholder="Açık Adres"><?= $billingAndDeliveryData != [] && isset($billingAndDeliveryData["invoice_adress"]) ? $billingAndDeliveryData["invoice_adress"] : set_value('invoice_adress') ?></textarea>
                                    <span class="no-wrap error-span" id="invoice_adress_error"></span>
                                </div>
                                <div class="col-12 col-md-4 mb-2 px-2">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        Şehir
                                        <span class="text-theme-orange ms-auto fs-8">(Zorunlu Alan)</span>
                                    </label>
                                    <select name="city" id="city_select"
                                            class="mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control turkey-city-select">
                                        <option value="">Lütfen Seçiniz ...</option>
                                    </select>
                                    <span class="no-wrap error-span" id="city_error"></span>
                                </div>
                                <div class="col-12 col-md-4 mb-2 px-2">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        İlçe
                                        <span class="text-theme-orange ms-auto fs-8">(Zorunlu Alan)</span>
                                    </label>
                                    <select disabled="disabled" name="district" id="district"
                                            class="mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control turkey-district-select">
                                        <option value="0">Lütfen Seçiniz ...</option>
                                    </select>
                                    <span class="no-wrap error-span" id="district_error"></span>
                                </div>
                                <div class="col-12 col-md-4 mb-2 px-2">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        Posta Kodu
                                        <span class="text-theme-orange ms-auto fs-8">(Zorunlu Alan)</span>
                                    </label>
                                    <input class="mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control"
                                           type="text" placeholder="Posta Kodu" name="post_code"
                                           value="<?= $billingAndDeliveryData != [] && isset($billingAndDeliveryData["post_code"]) ? $billingAndDeliveryData["post_code"] : set_value('post_code') ?>">
                                    <span class="no-wrap error-span" id="post_code_error"></span>
                                </div>
                                <hr class="mt-3">

                                <div class="col-12 mb-2 px-2">
                                    <div class="d-flex align-items-start justify-content-start gap-2">
                                        <input type="checkbox" class="form-check-input"
                                               id="shipping_and_billing_address" name="shipping_and_billing_address"
                                               checked required>
                                        <label class="fw-sm-bold" for="shipping_and_billing_address">
                                            Teslimat adresi ve Fatura adreslerini aynı kullanacağım.
                                        </label>
                                    </div>
                                </div>
                                <hr class="mt-3">
                                <div class="col-12 mb-2 px-2 deliveryNameBox d-none">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        Ad Soyad
                                        <span class="text-theme-orange ms-auto fs-8">(Zorunlu Alan)</span>
                                    </label>
                                    <input class="mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control"
                                           type="text" placeholder="Ad Soyad" name="delivery_name"
                                           value="<?= $billingAndDeliveryData != [] && isset($billingAndDeliveryData["delivery_name"]) ? $billingAndDeliveryData["delivery_name"] : set_value('delivery_name') ?>">
                                    <span class="no-wrap error-span" id="delivery_name_error"></span>
                                </div>
                                <div class="col-12 mb-2 px-2 deliveryAdressBox d-none">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        Teslimat Adresi
                                        <span class="text-theme-orange ms-auto fs-8">(Zorunlu Alan)</span>
                                    </label>
                                    <textarea name="delivery_address"
                                              class="mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control"
                                              cols="30" rows="5"
                                              placeholder="Teslimat Adresi"><?= $billingAndDeliveryData != [] && isset($billingAndDeliveryData["delivery_address"]) ? $billingAndDeliveryData["delivery_address"] : set_value('delivery_address') ?></textarea>
                                    <span class="no-wrap error-span" id="delivery_adress_error"></span>
                                </div>
                                <div class="col-12 col-md-4 mb-2 px-2 deliveryCityBox d-none">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        Şehir
                                        <span class="text-theme-orange ms-auto fs-8">(Zorunlu Alan)</span>
                                    </label>
                                    <select name="delivery_city" id="delivery_city"
                                            class="mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control turkey-city-select">
                                        <option value="">Lütfen Seçiniz ...</option>
                                    </select>
                                    <span class="no-wrap error-span" id="delivery_city_error"></span>
                                </div>
                                <div class="col-12 col-md-4 mb-2 px-2 deliveryDistrictBox d-none">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        İlçe
                                        <span class="text-theme-orange ms-auto fs-8">(Zorunlu Alan)</span>
                                    </label>
                                    <select disabled="disabled" name="delivery_district" id="delivery_district"
                                            class="mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control turkey-district-select">
                                        <option value="0">Lütfen Seçiniz ...</option>
                                    </select>
                                    <span class="no-wrap error-span" id="delivery_district_error"></span>
                                </div>
                                <div class="col-12 col-md-4 mb-2 px-2 deliveryPostalCodeBox d-none">
                                    <label class="mb-1 fw-sm-bold d-flex align-items-center">
                                        Posta Kodu
                                        <span class="text-gray-00 ms-auto">(Zorunlu Alan)</span>
                                    </label>
                                    <input class="mb-0 rounded-lg shadow-text-theme-md border border-secondary form-control"
                                           type="text" placeholder="Posta Kodu"
                                           name="delivery_post_code"
                                           value="<?= $billingAndDeliveryData != [] && isset($billingAndDeliveryData["delivery_post_code"]) ? $billingAndDeliveryData["delivery_post_code"] : set_value('delivery_post_code') ?>">
                                    <span class="no-wrap error-span" id="delivery_post_code_error"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-4 p-2">
                    <div class="bg-white rounded-xl shadow-text-theme mb-5 mb-lg-2 mt-5 mt-md-0 p-4">
                        <div class="bg-transparent">
                            <h3 class="text-orange fw-bold shadow-bottom mb-4 pb-2">Ürünleriniz</h3>
                            <div class="w-100 overflow-scroll">
                                <?php
                                $total_price = 0;
                                $total_discount = 0;
                                foreach ($getCarts as $cartKey => $cartItems) {
                                    $total_price += $cartItems["total_price"];
                                    $total_discount += $cartItems["discount"];
                                    ?>
                                    <div class="summary-product-row d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-2 <?= $cartKey >= count($getCarts) ? "border-0" : "" ?>"
                                         data-product-id="<?= $cartItems["product_id"] ?>"
                                         data-product-key="<?= $cartKey ?>">
                                        <div class="d-flex align-items-center fs-7 fs-lg-6 fw-bold mb-0">
                                            <?= getProductNameInCart($cartItems["product_id"]) ?>
                                        </div>
                                        <div class="ms-auto d-flex align-items-center justify-content-between gap-2">
                                            <div class="d-flex align-items-center fs-7 fs-lg-6 mb-0">
                                                <?= $cartItems["total_price"] / $cartItems["product_qty"] ?>
                                                <?= getLucideIcon("tl_icon", "w-3 h-3") ?>
                                            </div>
                                            <div class="d-flex align-items-center fs-7 fs-lg-6 mb-0 whitespace-nowrap gap-1 summary-product-qty"
                                                 data-product-key="<?= $cartKey ?>">
                                                <?= $cartItems["product_qty"] ?> adet
                                            </div>
                                            <div class="d-flex align-items-center fs-7 fs-lg-6 mb-0 summary-product-total-price"
                                                 data-product-key="<?= $cartKey ?>">
                                                <?= number_format($cartItems["total_price"], 2) ?> <?= getLucideIcon("tl_icon", "w-3 h-3") ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <h3 class="text-orange fw-bold shadow-bottom mb-4 mt-3 pb-2">Sipariş Tutarı</h3>
                                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between">
                                    <div class="fs-6 fw-bold text-black">Toplam Tutar</div>
                                    <div class="ms-auto d-flex gap-1 text-theme fw-bold align-items-center justify-content-between">
                                        <?php if ($total_discount) { ?>
                                            <del class="summary-cart-discount-and-total-price fw-bold fs-6 d-flex align-items-center justify-content-center gap-1"
                                                 style="color: #ff6100">
                                                <?= number_format($total_discount + $total_price, 2) . getLucideIcon("tl_icon", "w-3 h-3") ?>
                                            </del>
                                        <?php } ?>
                                        <span class="summary-cart-total-price d-flex gap-1 text-theme fw-bold align-items-center justify-content-between"
                                              data-price="<?= $total_price ?>"><?= number_format($total_price, 2) . getLucideIcon("tl_icon", "w-3 h-3") ?></span>
                                    </div>
                                </div>
                                <?php if ($total_discount) { ?>
                                    <hr class="my-2">
                                    <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between">
                                        <div class="fs-6 fw-bold text-black">Kazanılan İndirim</div>
                                        <div class="ms-auto d-flex gap-1 text-success fw-bold align-items-center justify-content-between summary-cart-discount-price">
                                            <?= number_format($total_discount, 2) . getLucideIcon("tl_icon", "w-3 h-3") ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <hr class="my-2">
                                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between">
                                    <div class="fs-6 fw-bold text-black d-flex flex-column">
                                        Tahsil Edilecek Tutar
                                        <span class="fs-8 text-muted fw-light ps-1 all_total_price_detail">
                                            %10 KDV Dahil Tutar
                                        </span>
                                    </div>
                                    <div class="ms-auto d-flex gap-1 text-theme fw-bold align-items-center justify-content-between summary-all-total-price">
                                        <?= number_format($total_price + ($total_price * 0.10), 2) . getLucideIcon("tl_icon", "w-3 h-3") ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--onclick="CreateOrder()"-->
                    </div>
                    <div>
                        <h5 class="fw-bold text-success text-center">
                            <?= getLucideIcon("shield-check", "w-6 h-5 me-1") ?>
                            %100 Güvenli Alışveriş
                        </h5>
                        <h6 class="text-center text-muted fs-7">
                            <?= getLucideIcon("lock", "w-4 h-4 me-1") ?>256bit SSL sertifikası ile internet sitemizden
                            güvenli alışveriş yapabilirsiniz.
                        </h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-start gap-2 p-3 rounded-xl contract-box">
                        <input type="checkbox" class="form-check-input w-12 h-6"
                               id="orders-contracts-accepted" name="orders-contracts" required>
                        <label class="fw-sm-bold text-muted fs-7" for="register-policy">
                            <a target="_blank"
                               href="<?= base_url("icerik/kisisel-verilere-iliskin-aydinlatma-metni") ?>"
                               class="text-primary">
                                Kişisel Verilere İlişkin Aydınlatma Metni,
                            </a>
                            <a target="_blank" href="<?= base_url("icerik/guvenlik-ve-cerez-politikasi") ?>"
                               class="text-primary">
                                Gizlilik ve Güvenlik,
                            </a>
                            <a target="_blank"
                               href="<?= base_url("icerik/kisisel-verilere-iliskin-beyan-ve-riza-onay-metni") ?>"
                               class="text-primary">
                                Kişisel Verilere İlişkin Beyan ve Rıza Onay Metni
                            </a> ve
                            <a target="_blank" href="<?= base_url("icerik/mesafeli-satis-sozlesmesi") ?>"
                               class="text-primary">
                                Mesafeli Satış Sözleşme'sini
                            </a>
                            okudum, onaylıyorum.
                        </label>
                    </div>
                    <div class="px-2 my-2 w-100 text-center cursor-pointer">
                        <img src="<?= base_url("/assets/images/payments/guvenli_paytr.png") ?>" class="h-10" alt="">
                    </div>
                    <div class="px-2">
                        <a href="<?= base_url("/urunler") ?>"
                           class="w-75 mx-auto btn btn-orange-soft d-flex-item-justify-center gap-1 rounded-lg mt-3">
                            <?= getLucideIcon("rotate-ccw", "w-3 h-3") ?>
                            <span class="fs-9 fs-lg-6 mobile-zoom-08">Alışverişe Devam Et</span>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="d-flex flex-column align-items-center justify-content-center gap-2 mb-1 cart-empty-box <?= isset($getCarts) && $getCarts == NULL ? "" : "d-none" ?>"
             style="min-height: 100vh">
            <h5 class="text-center mt-0 mt-lg-4">Sepetinizde hiç ürün bulunmamaktadır !</h5>
            <div class="d-flex flex-lg-row flex-column justify-content-center text-center m-auto mt-3 gap-2">
                <a href="<?= base_url("/urunler") ?>" class="btn btn-success-soft-hover rounded-lg p-3 px-3">
                    <?= getLucideIcon("rotate-ccw", "me-2") ?>ALIŞVERİŞE DEVAM ET
                </a>
                <a href="<?= base_url() ?>" class="btn btn-theme-soft rounded-lg p-3 px-3">
                    <?= getLucideIcon("link", "me-2") ?>ANASAYFAYA DÖN
                </a>
            </div>
        </div>
    </div>
</main>
<?php if (isset($getCarts) && $getCarts != NULL) { ?>
    <div class="w-100 bg-white cart-content-box fixed-bottom-complete-to-cart px-3 py-2">
        <div class="row gap-0 gap-lg-3 justify-content-center pt-0 pt-lg-1">
            <div class="col-6 col-lg-3 px-2 prev-step-form-div" style="display: none">
                <button class="w-100 btn btn-primary-soft prev-step-form-btn d-flex-item-justify-center gap-1 rounded-lg">
                    <?= getLucideIcon("rotate-ccw", "w-3 h-3") ?>
                    <span class="prev-step-title fs-9 fs-lg-6 mobile-zoom-08">Ürünlere Geri Dön</span>
                </button>
            </div>
            <div class="col-6 col-lg-3 px-2">
                <button class="w-100 btn btn-success-soft next-step-form-btn d-flex-item-justify-center gap-1 rounded-lg">
                    <?= getLucideIcon("check-circle", "w-3 h-3") ?>
                    <span class="next-step-title fs-9 fs-lg-6 mobile-zoom-08 whitespace-nowrap">Alışverişi Tamamla</span>
                </button>
            </div>
        </div>
    </div>
<?php } ?>
<div class="modal fade" id="loadingPayScreen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     style="z-index: 10002;">
    <div class="modal-dialog modal-dialog-scrollable" role="document" style="max-width: 1250px">
        <div class="modal-content border-0 rounded-lg">
            <div class="modal-header px-4 pt-2 pb-0125 border-bottom mb-2">
                <h5 class="text-dark fw-bold d-flex-item-justify-center gap-2"><?= getLucideIcon("credit-card", "w-5 h-5") ?>
                    Ödeme Ekranı</h5>
            </div>
            <div class="modal-body p-0">
                <div class="step" data-step="3">
                    <div id="loadingPayFrame"
                         class="spinner-box bg-white rounded-bottom-lg shadow-sm w-100 w-sm-75 w-lg-100"
                         style="display: none;">
                        <div class="spinner"></div>
                        <p>
                            Ödeme Ekranı Yükleniyor ...
                            <br>
                            Lütfen Bekleyiniz...
                        </p>
                    </div>
                    <div id="payFrameArea" class="overflow-auto">
                        <script src="https://www.paytr.com/js/iframeResizer.min.js"></script>
                        <iframe src="" id="paytriframe"
                                frameborder="0" scrolling="no" style="width: 100%;"></iframe>
                        <script>iFrameResize({}, '#paytriframe');</script>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" id="close-pay-screen-btn" data-bs-dismiss="modal" aria-label="Close"
                        class="w-100 w-md-75 mx-auto mt-2 btn btn-primary-soft text-uppercase shadow-text-theme-md rounded-l d-flex-item-justify-center gap-1">
                    <?= getLucideIcon("x-circle", "w-3 h-3") ?>
                    <span class="fw-normal fs-9 fs-lg-6 mobile-zoom-08 prev-step-form-btn close-pay-screen-btn-title">İptal Et</span>
                </button>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).off("change", "#shipping_and_billing_address").on("change", "#shipping_and_billing_address", function (event) {
        event.preventDefault();
        event.stopPropagation();
        const isChecked = $(this).prop("checked");
        if (isChecked) {
            $(".deliveryNameBox, .deliveryAdressBox, .deliveryCityBox, .deliveryDistrictBox, .deliveryPostalCodeBox").slideUp();
        } else {
            $(".deliveryNameBox").hasClass("d-none") ? $(".deliveryNameBox").removeClass("d-none") : "";
            $(".deliveryAdressBox").hasClass("d-none") ? $(".deliveryAdressBox").removeClass("d-none") : "";
            $(".deliveryCityBox").hasClass("d-none") ? $(".deliveryCityBox").removeClass("d-none") : "";
            $(".deliveryDistrictBox").hasClass("d-none") ? $(".deliveryDistrictBox").removeClass("d-none") : "";
            $(".deliveryPostalCodeBox").hasClass("d-none") ? $(".deliveryPostalCodeBox").removeClass("d-none") : "";
            $(".deliveryNameBox, .deliveryAdressBox, .deliveryCityBox, .deliveryDistrictBox, .deliveryPostalCodeBox").slideDown();
        }
    });

    function showHideBoxes(param) {
        $(".user_type_hidden").val(param);
        const totalPriceCart = $(".summary-cart-total-price").attr("data-price");
        //$(".all_total_price_detail").html("%10 KDV Dahil Tutar");
        let  newAllTotalPrice = parseInt(totalPriceCart) + parseInt(totalPriceCart * 0.1)
        $(".error-span").hide();
        $(".error-span").html("");
        if (param === "individual") {
            !$(".invoice-name-text").hasClass("d-none") ? $(".invoice-name-text").addClass("d-none") : "";
            $(".invoice-name-input").attr("placeholder", "Ad Soyad");
            !$(".invoice-title-box").hasClass("d-none") ? $(".invoice-title-box").addClass("d-none") : "";
            !$(".invoice-tax-administration-box").hasClass("d-none") ? $(".invoice-tax-administration-box").addClass("d-none") : "";
            !$(".cart-tax-number-box").hasClass("d-none") ? $(".cart-tax-number-box").addClass("d-none") : "";
            $(".cart-tc-number-box").hasClass("d-none") ? $(".cart-tc-number-box").removeClass("d-none") : "";
        } else if (param === "institutional") {
            $(".invoice-name-input").attr("placeholder", "Fatura Ad Soyad");
            $(".invoice-name-text").hasClass("d-none") ? $(".invoice-name-text").removeClass("d-none") : "";
            $(".invoice-title-box").hasClass("d-none") ? $(".invoice-title-box").removeClass("d-none") : "";
            $(".invoice-tax-administration-box").hasClass("d-none") ? $(".invoice-tax-administration-box").removeClass("d-none") : "";
            $(".cart-tax-number-box").hasClass("d-none") ? $(".cart-tax-number-box").removeClass("d-none") : "";
            !$(".cart-tc-number-box").hasClass("d-none") ? $(".cart-tc-number-box").addClass("d-none") : "";
        }
        const newAllPriceFormat = formatNumber(newAllTotalPrice, 2, ',', '.');
        $(".summary-all-total-price").html(newAllPriceFormat + '<?=getLucideIcon("tl_icon", "w-3 h-3")?>')
    }

    $(".prev-step-form-div").css("display", "none")

    let currentStep = 1, nextStep = currentStep, prevStep = currentStep;

    $(document).off("click", ".next-step-form-btn").on("click", ".next-step-form-btn", async function () {
        $('html, body').animate({'scrollTop': 0}, 10);
        nextStep = currentStep + 1;
        const orders_contracts_accepted = document.getElementById("orders-contracts-accepted");
        await $(".contract-box").css("box-shadow", "unset")
        if (nextStep < 4 && nextStep > 0) {
            if (orders_contracts_accepted.checked) {
                if (nextStep === 2) {
                    await $.post(window.location.origin + '/checkCartItemCount', {}, async function (response) {
                        response = JSON.parse(response);
                        if (response.error) {
                            showNotification("danger", cancel_icon_danger, "Ürün Sayısı Hatası", response.msg, 3, "top", "right");
                        } else {
                            await $(".prev-step-form-div").removeClass("col-12").addClass("col-6")
                            await $(".prev-step-form-div").css("display", "block")
                            await $('.step-title[data-step="' + currentStep + '"]').removeClass("step-active");
                            await $('.step[data-step="' + currentStep + '"]').hide();
                            await $('.step-title[data-step="' + nextStep + '"]').addClass("step-active")
                            await $('.step[data-step="' + nextStep + '"]').show();
                            $(".next-step-title").html("Kaydet ve Devam Et")
                            $(".prev-step-title").html("Ürünlere Geri Dön")
                            currentStep = nextStep;
                        }
                    });
                } else if (nextStep === 3) {
                    const dialCode = $("#deliveryAndBillingForm").find(".iti__active").data("dial-code") != "undefined" ? $("#deliveryAndBillingForm").find(".iti__active").attr("data-dial-code") : "90";
                    const phoneInputVal = $("#deliveryAndBillingForm").find(".phone-input").val();
                    const editedPhone = phoneInputVal.replace(/\s/g, '');
                    await $.post(window.location.origin + '/saveBillingAndDelivery', $("#deliveryAndBillingForm").serialize() + "&dial_code=" + dialCode + "&full_phone=" + (dialCode + editedPhone).slice(-11), async function (response) {
                        const response_billing_form = JSON.parse(response)
                        $(".error-span").hide();
                        $(".error-span").html("");
                        if (response_billing_form.error) {
                            showNotification("danger", cancel_icon_danger, "Teslimat ve Fatura Bilgileri Hatalı", "Teslimat ve Fatura Bilgilerini Eksik veya Hatalı doldurdunuz..", 1.5, "top", "right");
                            $.each(response_billing_form.errors, function (span, message) {
                                displayDeliveryPostCodeError(span, message)
                            });
                        } else {
                            await $(".prev-step-form-div").css("display", "none")
                            await $('.step-title[data-step="' + currentStep + '"]').removeClass("step-active");
                            await $('.step[data-step="' + currentStep + '"]').hide();
                            await $('.step-title[data-step="' + nextStep + '"]').addClass("step-active")
                            await $('.step[data-step="' + nextStep + '"]').show();
                            $("#loadingPayScreen").modal("show");
                            $(".next-step-title").html("Alışverişi Tamamla")
                            $(".close-pay-screen-btn-title").html("Teslimat ve Fatura Bilgilerine Geri Dön")
                            !$(".next-step-form-btn").closest(".col-6").hide() ? $(".next-step-form-btn").closest(".col-6").hide() : "";
                            await payAreaLoadingShow();
                            await $.post(window.location.origin + '/paytrPayment', {}, async function (response) {
                                const result = JSON.parse(response)
                                if (result.error) {
                                    showNotification("danger", cancel_icon_danger, "Hata", "Ödeme Ekranı yüklenirken bir hata oluştu ...", 1.5, "top", "right");
                                } else {
                                    await $("#paytriframe").attr("src", "https://www.paytr.com/odeme/guvenli/" + result.token)
                                }
                                document.getElementById("paytriframe").scrollTop = 0;
                                await payAreaLoadingHide();
                            });
                            currentStep = nextStep;
                        }
                    });
                }
            } else {
                await $(".contract-box").css("box-shadow", "0px 0px 10px 5px red")
                showNotification("danger", cancel_icon_danger, "Sözleşme Onayı Hatası", "Lütfen Sözleşmeleri Okuyup, onaylayınız", 3, "top", "right");
            }
        }
    });

    $(document).off("click", ".prev-step-form-btn").on("click", ".prev-step-form-btn", async function () {
        prevStep = currentStep - 1;
        if (prevStep > 0) {

            await $('.step-title[data-step="' + currentStep + '"]').removeClass("step-active");
            await $('.step[data-step="' + currentStep + '"]').hide();
            await $('.step-title[data-step="' + prevStep + '"]').addClass("step-active");
            await $('.step[data-step="' + prevStep + '"]').show();
            currentStep = prevStep;
            if (prevStep === 1) {
                $(".prev-step-form-div").css("display", "none")
                $(".next-step-title").html("Alışverişi Tamamla")
            } else if (prevStep === 2) {
                await $(".prev-step-form-div").removeClass("col-12").addClass("col-6")
                await $(".prev-step-form-div").css("display", "block")
                $(".next-step-title").html("Kaydet ve Devam Et")
                $(".prev-step-title").html("Ürünlere Geri Dön")
                !$(".next-step-form-btn").closest(".col-6").show() ? $(".next-step-form-btn").closest(".col-6").show() : "";
            }
        }
    });

    $(document).off("click", ".step-title").on("click", ".step-title", async function () {
        const newStep = parseInt($(this).attr("data-step"));
        if (newStep > 0 && currentStep > newStep) {
            await $('.step-title[data-step="' + currentStep + '"]').removeClass("step-active");
            await $('.step[data-step="' + currentStep + '"]').hide();
            await $('.step-title[data-step="' + newStep + '"]').addClass("step-active");
            await $('.step[data-step="' + newStep + '"]').show();
            currentStep = newStep;
            if (newStep === 1) {
                $(".prev-step-form-div").css("display", "none")
                $(".next-step-title").html("Alışverişi Tamamla")
            } else if (newStep === 2) {
                await $(".prev-step-form-div").removeClass("col-12").addClass("col-6")
                await $(".prev-step-form-div").css("display", "block")
                $(".next-step-title").html("Kaydet ve Devam Et")
                $(".prev-step-title").html("Ürünlere Geri Dön")
            }
            !$(".next-step-form-btn").closest(".col-6").show() ? $(".next-step-form-btn").closest(".col-6").show() : "";
        }
    });

    function displayDeliveryPostCodeError(element, error) {
        element = element + "_error"
        $("#" + element).show();
        $("#" + element).html(error);
    }

    function payAreaLoadingShow() {
        $('#loadingPayFrame').show();
        $('#payFrameArea').hide();
    }

    function payAreaLoadingHide() {
        $('#loadingPayFrame').hide();
        $('#payFrameArea').show();
    }

</script>