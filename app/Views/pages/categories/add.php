<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content') ?>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kategori Ekle</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">caseProject</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url("categories") ?>">Kategoriler</a></li>
                        <li class="breadcrumb-item active">Kategori Ekle</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php if (!empty(session()->getFlashdata('category_add_failed'))) : ?>
                        <div class="alert alert-danger my-2 small">
                            <?= session()->getFlashdata('category_add_failed'); ?>
                        </div>
                    <?php
                    endif;
                    if (!empty(session()->getFlashdata('category_add_success'))) :
                        ?>
                        <div class="alert alert-success my-2 small">
                            <?= session()->getFlashdata('category_add_success'); ?>
                        </div>
                        <script>
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        </script>
                    <?php endif; ?>
                    <div class="card card-info">
                        <form action="<?= base_url('create_category') ?>" method="post" class="form-horizontal"
                              enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Kategori Adı</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Kategori Adı">
                                        <div class="text-danger my-2 small"><?= isset($validation) ? display_error($validation, 'name') : '' ?></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">Kategori Açıklaması</label>
                                    <div class="col-sm-10">
                                        <textarea id="description" name="description" class="form-control small" rows="3"
                                                  placeholder="Kategori Açıklaması"></textarea>
                                        <div class="text-danger my-2 small"><?= isset($validation) ? display_error($validation, 'description') : '' ?></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">Kategori Resmi</label>
                                    <div class="col-sm-10">
                                        <div class="card" style="width: 350px">
                                            <div class="card-body">
                                                <div class="center">
                                                    <div class="form-input text-center d-flex flex-column align-items-center justify-content-center">
                                                        <div class="preview">
                                                            <img id="file-preview" alt="" src="">
                                                        </div>
                                                        <label for="file">Görsel Seç</label>
                                                        <input type="file" id="file" class="mx-auto w-auto" name="image"
                                                               accept="image/*"
                                                               value="<?= set_value('image') ?>"
                                                               onchange="showPreview(event);">
                                                        <small>Resim Formatı .png, .jpg, .jpeg, .webp, .gif olmalıdır
                                                            !</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center" style="gap: 1rem">
                                <button type="submit" class="btn btn-info" onclick="submitButtonClick();">Ekle</button>
                                <a href="<?= base_url("categories") ?>" class="btn btn-default">İptal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

