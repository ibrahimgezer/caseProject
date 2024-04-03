<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content') ?>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">caseProject</a></li>
                        <li class="breadcrumb-item active font-weight-bold">Kullanıcılar</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <a href="<?= base_url("user_add") ?>"
                       class="btn btn-sm btn-success px-2 rounded-lg ml-auto w-36 d-flex align-items-center">
                        <i class="nav-icon fa fa-plus mr-2 mb-0"></i>
                        <p class="mb-0">Kullanıcı Ekle</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php if (!empty(session()->getFlashdata('user_delete_failed'))) : ?>
                        <div class="alert alert-danger my-2 small">
                            <?= session()->getFlashdata('user_delete_failed'); ?>
                        </div>
                    <?php
                    endif;
                    if (!empty(session()->getFlashdata('user_delete_success'))) :
                        ?>
                        <div class="alert alert-success my-2 small">
                            <?= session()->getFlashdata('user_delete_success'); ?>
                        </div>
                        <script>
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        </script>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Ad Soyad</th>
                                        <th>E-Posta Adresi</th>
                                        <th>Kayıt Tarihi</th>
                                        <th>Güncelleme Tarihi</th>
                                        <th>İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($usersCount) && $usersCount > 0) { ?>
                                    <?php if (isset($users)) { ?>
                                        <?php foreach ($users as $user) { ?>
                                            <tr>
                                                <td class="p-2 text-muted text-center"><?= $user["name_surname"]; ?></td>
                                                <td class="p-2 text-muted text-center"><?= $user["email"]; ?></td>
                                                <td class="p-2 text-muted text-center">
                                                    <?= date("d.m.Y H:i", strtotime($user["created_at"])); ?>
                                                </td>
                                                <td class="p-2 text-muted text-center">
                                                    <?= date("d.m.Y H:i", strtotime($user["updated_at"])); ?>
                                                </td>
                                                <td class="p-2 text-muted text-center d-flex justify-content-center align-items-center" style="gap:1rem">
                                                    <a href="<?= base_url("user_edit/" . $user["id"]) ?>"
                                                       class="btn btn-sm btn-outline-success px-2 d-flex align-items-center">
                                                        <i class="nav-icon fa fa-save mr-2 mb-0"></i>
                                                        <p class="mb-0">Düzenle</p>
                                                    </a>
                                                    <form method="post"
                                                          action="<?= base_url("delete_user/" . $user["id"]) ?>">
                                                        <button type="submit"
                                                                class="btn btn-sm btn-outline-danger px-2 d-flex align-items-center"
                                                                onclick="return confirm('Bu kullanıcıyı silmek istediğinizden emin misiniz?')">
                                                            <i class="nav-icon fa fa-trash mr-2 mb-0"></i>
                                                            <p class="mb-0">Sil</p>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="5" class="p-2 text-muted text-center">
                                            Kayıtlı kullanıcı bulunamıyor
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

