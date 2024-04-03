<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content') ?>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Anasayfa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">caseProject</a></li>
                        <li class="breadcrumb-item active">Anasayfa</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1">
                            <i class="fas fa-users"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Kullanıcılar</span>
                            <span class="info-box-number"><?= $usersCount ?? "0" ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-th"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Kategoriler</span>
                            <span class="info-box-number"><?= $categoriesCount ?? "0" ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Markalar</span>
                            <span class="info-box-number"><?= $brandsCount ?? "0" ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Son Eklenen Kategoriler</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <?php if (isset($categoriesCount) && $categoriesCount > 0) { ?>
                                    <?php if (isset($lastCategories)) { ?>
                                        <?php foreach ($lastCategories as $category) { ?>
                                            <li class="item">
                                                <div class="product-img">
                                                    <img src="<?= base_url("public/images/category/" . $category["image"]) ?>"
                                                         alt="Product Image" class="img-size-50">
                                                </div>
                                                <div class="product-info">
                                                    <a href="javascript:void(0)"
                                                       class="product-title"><?= $category["name"]; ?></a>
                                                    <span class="product-description">
                                                        <?= (strlen($category["description"]) > 50) ? substr($category["description"], 0, 50) . "..." : $category["description"]; ?>
                                                    </span>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="p-2 text-muted text-center">
                                        Kayıtlı kategori bulunamıyor
                                    </div>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php if (isset($categoriesCount) && $categoriesCount > 0) { ?>
                            <div class="card-footer text-center">
                                <a href="<?= base_url("categories") ?>" target="_blank"
                                   class="uppercase btn btn-primary mb-2 rounded-lg ">Tüm Kategorileri Gör</a>
                                <br>
                                <small class="text-danger">
                                    Son 5 kayıt gösterilmektedir.
                                    Tümünü Görmek için lütfen yukarıdaki butona tıklayınız.
                                </small>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Son Eklenen Markalar</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <?php if (isset($brandsCount) && $brandsCount > 0) { ?>
                                    <?php if (isset($lastBrands)) { ?>
                                        <?php foreach ($lastBrands as $brand) { ?>
                                            <li class="item px-2">
                                                <a href="javascript:void(0)" class="product-title">
                                                    <?= $brand["name"]; ?>
                                                </a>
                                                <span class="product-description">
                                                    <?= (strlen($brand["description"]) > 50) ? substr($brand["description"], 0, 50) . "..." : $brand["description"]; ?>
                                                </span>
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="p-2 text-muted text-center">
                                        Kayıtlı marka bulunamıyor
                                    </div>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php if (isset($brandsCount) && $brandsCount > 0) { ?>
                            <div class="card-footer text-center">
                                <a href="<?= base_url("brands") ?>" target="_blank"
                                   class="uppercase btn btn-primary mb-2 rounded-lg ">Tüm Markaları Gör</a>
                                <br>
                                <small class="text-danger">
                                    Son 5 kayıt gösterilmektedir.
                                    Tümünü Görmek için lütfen yukarıdaki butona tıklayınız.
                                </small>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

