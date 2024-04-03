<?php
$router = service('router');
$controllerName = explode("\\", $router->controllerName());
$controllerName = $controllerName[count($controllerName) - 1];
$userNameSurname = getUserData(session()->get('loggedUser')["id"])["name_surname"];
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="javascript:void(0)" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url() ?>" class="nav-link">caseProject</a>
        </li>
    </ul>
    <a href="<?= base_url("logout") ?>" class="btn btn-sm btn-danger px-2 ml-auto d-flex align-items-center">
        <i class="nav-icon fa fa-times mr-2 mb-0"></i>
        <p class="mb-0">Çıkış Yap</p>
    </a>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= base_url() ?>" class="brand-link">
        <img src="<?= base_url("public/images/") ?>AdminLTELogo.png" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url("public/images/") ?>avatar5.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="javascript:void(0)"
                   class="d-block"><?= ucwords($userNameSurname); ?></a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url() ?>"
                       class="nav-link <?= $controllerName == "HomeController" ? "active" : "" ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Anasayfa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url("users") ?>"
                       class="nav-link <?= $controllerName == "UserController" ? "active" : "" ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Kullanıcılar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url("categories") ?>"
                       class="nav-link <?= $controllerName == "CategoryController" ? "active" : "" ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Kategoriler</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url("brands") ?>"
                       class="nav-link <?= $controllerName == "BrandController" ? "active" : "" ?>">
                        <i class=" nav-icon fas fa-tag"></i>
                        <p>Markalar</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>