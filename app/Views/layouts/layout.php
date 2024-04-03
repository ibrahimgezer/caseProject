<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Panel<?= isset($title) ? " | " . $title : '' ?></title>
    <link rel="stylesheet" href="<?= base_url("public/css/") ?>all.min.css">
    <link rel="stylesheet" href="<?= base_url("public/css/") ?>OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url("public/css/") ?>adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url("public/css/") ?>dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url("public/css/") ?>custom.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <?php include(APPPATH . 'Views/sections/header.php'); ?>
    <div class="content-wrapper">
        <?php if (!empty(session()->getFlashdata('permission_failed'))) : ?>
            <div class="p-2">
                <h4 class="alert alert-danger my-2 text-center">
                    <?= session()->getFlashdata('permission_failed'); ?>
                </h4>
            </div>
            <script>
                setTimeout(function () {
                    location.reload();
                }, 3000);
            </script>
        <?php endif; ?>
        <?= $this->renderSection('content') ?>
    </div>
    <?php include(APPPATH . 'Views/sections/footer.php'); ?>
</div>
<script src="<?= base_url("public/js/") ?>jquery.min.js"></script>
<script src="<?= base_url("public/js/") ?>bootstrap.bundle.min.js"></script>
<script src="<?= base_url("public/js/") ?>jquery.dataTables.min.js"></script>
<script src="<?= base_url("public/js/") ?>dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url("public/js/") ?>dataTables.responsive.min.js"></script>
<script src="<?= base_url("public/js/") ?>responsive.bootstrap4.min.js"></script>
<script src="<?= base_url("public/js/") ?>jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url("public/js/") ?>adminlte.js"></script>
<script src="<?= base_url("public/js/") ?>demo.js"></script>
<script src="<?= base_url("public/js/") ?>jquery.mousewheel.js"></script>
<script src="<?= base_url("public/js/") ?>raphael.min.js"></script>
<script src="<?= base_url("public/js/") ?>jquery.mapael.min.js"></script>
<script src="<?= base_url("public/js/") ?>usa_states.min.js"></script>
<script src="<?= base_url("public/js/") ?>Chart.min.js"></script>
<script src="<?= base_url("public/js/") ?>dashboard2.js"></script>
<script src="<?= base_url("public/js/") ?>custom.js"></script>
</body>
</html>