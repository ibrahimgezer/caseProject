<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel<?= isset($title) ? " | " . $title : '' ?></title>
        <link rel="stylesheet" href="<?= base_url("public/css/") ?>all.min.css">
        <link rel="stylesheet" href="<?= base_url("public/css/") ?>OverlayScrollbars.min.css">
        <link rel="stylesheet" href="<?= base_url("public/css/") ?>adminlte.min.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?=base_url()?>"><b>Admin</b>LTE</a>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg font-weight-bold">Merhaba <br> Hoşgeldiniz</p>
                    <form action="<?=base_url("login_process")?>" method="post">
                        <?php if(!empty(session()->getFlashdata('login_failed'))) :   ?>
                            <div class="alert alert-danger text-center small"><?=session()->getFlashdata('login_failed');?></div>
                        <?php
                        endif;
                        if(!empty(session()->getFlashdata('login_successful'))) :
                            ?>
                            <div class="alert alert-success text-center small"><?=session()->getFlashdata('login_successful');?></div>
                        <?php   endif;   ?>
                        <div class="input-group mb-1">
                            <input type="email" name="email" class="form-control" placeholder="E-Posta" value="<?= set_value('email') ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="text-danger mb-3"><?= isset($validation) ? display_error($validation, 'email') : '' ?></div>
                        <div class="input-group mb-1">
                            <input type="password" name="password" class="form-control" placeholder="Şifre" value="<?= set_value('password') ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="text-danger mb-3"><?= isset($validation) ? display_error($validation, 'password') : '' ?></div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="<?= base_url("public/js/") ?>jquery.min.js"></script>
        <script src="<?= base_url("public/js/") ?>bootstrap.bundle.min.js"></script>
        <script src="<?= base_url("public/js/") ?>adminlte.js"></script>
    </body>
</html>