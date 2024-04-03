<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content') ?>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Marka Ekle</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">caseProject</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url("brands") ?>">Markalar</a></li>
                        <li class="breadcrumb-item active">Marka Ekle</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php if(!empty(session()->getFlashdata('brand_add_failed'))) :   ?>
                        <div class="alert alert-danger my-2 small"><?=session()->getFlashdata('brand_add_failed');?></div>
                    <?php
                    endif;
                    if(!empty(session()->getFlashdata('brand_add_success'))) :
                        ?>
                        <div class="alert alert-success my-2 small"><?=session()->getFlashdata('brand_add_success');?></div>
                        <script>
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        </script>
                    <?php endif; ?>
                    <div class="card card-info">
                        <form class="form-horizontal" action="<?= base_url("create_brand") ?>" method="post">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Marka Adı</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Marka Adı">
                                        <div class="text-danger my-2 small"><?= isset($validation) ? display_error($validation, 'name') : '' ?></div>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">Açıklama</label>
                                    <div class="col-sm-10">
                                        <textarea id="description" name="description" class="form-control" rows="3"
                                                  placeholder="Açıklama"></textarea>
                                        <div class="text-danger my-2 small"><?= isset($validation) ? display_error($validation, 'description') : '' ?></div>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" class="form-control" id="category_id">
                                            <option value="">Kategori Seçiniz</option>
                                            <?php if (!empty($categories) && count($categories) > 0) { ?>
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?=$category["id"]?>"><?=ucwords($category["name"])?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <div class="text-danger my-2 small"><?= isset($validation) ? display_error($validation, 'category_id') : '' ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center" style="gap: 1rem">
                                <button type="submit" class="btn btn-info">Ekle</button>
                                <a href="<?= base_url("brands") ?>" class="btn btn-default">İptal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

