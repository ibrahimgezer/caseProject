<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content') ?>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kullanıcı Düzenle</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">caseProject</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url("users") ?>">Kullanıcılar</a></li>
                        <li class="breadcrumb-item active">Kullanıcı Düzenle</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php if (!empty(session()->getFlashdata('user_edit_failed'))) : ?>
                        <div class="alert alert-danger my-2 small">
                            <?= session()->getFlashdata('user_edit_failed'); ?>
                        </div>
                    <?php
                    endif;
                    if (!empty(session()->getFlashdata('user_edit_success'))) :
                        ?>
                        <div class="alert alert-success my-2 small">
                            <?= session()->getFlashdata('user_edit_success'); ?>
                        </div>
                        <script>
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        </script>
                    <?php endif; ?>
                    <div class="card card-info">
                        <?php if (isset($userData)) : ?>
                            <?php $userAuths = json_decode($userData["auths"]); ?>
                            <form class="form-horizontal" action="<?= base_url("update_user/" . $userData["id"]) ?>"
                                  method="post">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name_surname" class="col-sm-2 col-form-label">Ad Soyad</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name_surname"
                                                   name="name_surname"
                                                   value="<?= isset($userData) ? $userData["name_surname"] : "" ?>"
                                                   placeholder="Ad Soyad">
                                            <div class="text-danger my-2 small"><?= isset($validation) ? display_error($validation, 'name_surname') : '' ?></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">E-Posta</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" name="email"
                                                   value="<?= isset($userData) ? $userData["email"] : "" ?>"
                                                   placeholder="E-Posta">
                                            <div class="text-danger my-2 small"><?= isset($validation) ? display_error($validation, 'email') : '' ?></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-2 col-form-label">Şifre</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="password"
                                                   value="<?= isset($userData) ? base64_decode($userData["password"]) : "" ?>"
                                                   name="password"
                                                   placeholder="Şifre">
                                            <div class="text-danger my-2 small"><?= isset($validation) ? display_error($validation, 'password') : '' ?></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-2 col-form-label">Yetkiler</label>
                                        <div class="col-sm-10">
                                            <h6 class="font-weight-bold text-primary">Kategoriler</h6>
                                            <hr>
                                            <div class=" d-flex align-items-center" style="gap:1rem">
                                                <div class="form-check">
                                                    <input type="hidden" name="category_add" value="0">
                                                    <input type="checkbox" <?= isset($userAuths->category_create) && $userAuths->category_create == 1 ? "checked" : "" ?>
                                                           name="category_add" value="1"
                                                           class="form-check-input" id="authCategoryAdd">
                                                    <label class="form-check-label" for="authCategoryAdd">Ekle</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="hidden" name="category_edit" value="0">
                                                    <input type="checkbox" <?= isset($userAuths->category_update) && $userAuths->category_update == 1 ? "checked" : "" ?>
                                                           name="category_edit" value="1"
                                                           class="form-check-input" id="authCategoryEdit">
                                                    <label class="form-check-label"
                                                           for="authCategoryEdit">Düzenle</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="hidden" name="category_delete" value="0">
                                                    <input type="checkbox" <?= isset($userAuths->category_delete) && $userAuths->category_delete == 1 ? "checked" : "" ?>
                                                           name="category_delete" value="1"
                                                           class="form-check-input" id="authCategoryDelete">
                                                    <label class="form-check-label" for="authCategoryDelete">Sil</label>
                                                </div>
                                            </div>
                                            <h6 class="font-weight-bold mt-5 text-primary">Markalar</h6>
                                            <hr>
                                            <div class=" d-flex align-items-center" style="gap:1rem">
                                                <div class="form-check">
                                                    <input type="hidden" name="brand_add" value="0">
                                                    <input type="checkbox" <?= isset($userAuths->brand_create) && $userAuths->brand_create == 1 ? "checked" : "" ?>
                                                           name="brand_add" value="1"
                                                           class="form-check-input" id="authBrandAdd">
                                                    <label class="form-check-label" for="authBrandAdd">Ekle</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="hidden" name="brand_edit" value="0">
                                                    <input type="checkbox" <?= isset($userAuths->brand_update) && $userAuths->brand_update == 1 ? "checked" : "" ?>
                                                           name="brand_edit" value="1"
                                                           class="form-check-input" id="authBrandEdit">
                                                    <label class="form-check-label" for="authBrandEdit">Düzenle</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="hidden" name="brand_delete" value="0">
                                                    <input type="checkbox" <?= isset($userAuths->brand_delete) && $userAuths->brand_delete == 1 ? "checked" : "" ?>
                                                           name="brand_delete" value="1"
                                                           class="form-check-input" id="authBrandDelete">
                                                    <label class="form-check-label" for="authBrandDelete">Sil</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-center" style="gap: 1rem">
                                    <button type="submit" class="btn btn-success">Kaydet</button>
                                    <a href="<?= base_url("users") ?>" class="btn btn-default">İptal</a>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

