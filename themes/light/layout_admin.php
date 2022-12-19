<?php
/** @var string $title */
/** @var string $content */
/** @var string $siteName */

use models\Image;
use models\User;
if (User::isUserAuthenticated())
{
    $currentUser = User::getCurrentAuthenticatedUser();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $siteName ?> — <?= $title ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/themes/admin-lte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/themes/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="/themes/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="/themes/admin-lte/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="/themes/admin-lte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/themes/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/themes/admin-lte/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/themes/admin-lte/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="/themes/light/css/style.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper wrapper-admin-layout">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light pt-1 pb-1">
        <ul class="navbar-nav d-flex align-items-center">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Головна</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link"  href="/user/logout" >
                    Вийти
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/" class="brand-link">
            <img src="/themes/admin-lte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Адмін панель</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <?php if(!User::hasUserImage()):?>
                        <img src="/themes/images/default_avatar.svg" class="img-circle elevation-2" alt="Аватар користувача">
                    <?php else: ?>
                        <img src="/files/user/<?=Image::getImageById($currentUser['image_id'])['name']?>" class="img-circle elevation-2" alt="Аватар користувача">
                    <?php endif;?>
                </div>
                <div class="info">
                    <a href="/" class="d-block"><?=$currentUser["name"]." ".$currentUser["surname"]?></a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="/" class="nav-link">
                            <i style="width: 30px"  class="fa-solid fa-house px-1"></i>
                            <p>
                                Головна
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i style="width: 30px"  class="fa-solid fa-users px-1"></i>
                            <p>
                                Користувачі
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Всі користувачі</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Додати користувача</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i style="width: 30px" class="fa-solid fa-pager px-1"></i>
                            <p>
                                Оголошення
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Всі оголошення</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Додати оголошення</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i style="width: 30px"  class="fa-solid fa-car px-1"></i>
                            <p>
                                Автомобілі
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Всі автомобілі</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Марки
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Всі марки</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Додати марку</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Моделі
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Всі моделі</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Додати модель</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i style="width: 30px" class="fa-solid fa-screwdriver-wrench px-1"></i>
                            <p>
                                Характеристики авто
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Види палива
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Всі види палива</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Додати вид палива</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Трансмісії
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Всі трансмісії</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Додати трансмісію</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Приводи
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Всі приводи</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Додати привід</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i style="width: 30px" class="fa-solid fa-map-location-dot px-1"></i>
                            <p>
                                Області України
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Всі області</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Додати область</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <?= $content ?>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>

<script src="/themes/admin-lte/plugins/jquery/jquery.min.js"></script>
<script src="/themes/admin-lte/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="/themes/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/themes/admin-lte/plugins/chart.js/Chart.min.js"></script>
<script src="/themes/admin-lte/plugins/sparklines/sparkline.js"></script>
<script src="/themes/admin-lte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/themes/admin-lte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="/themes/admin-lte/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="/themes/admin-lte/plugins/moment/moment.min.js"></script>
<script src="/themes/admin-lte/plugins/daterangepicker/daterangepicker.js"></script>
<script src="/themes/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="/themes/admin-lte/plugins/summernote/summernote-bs4.min.js"></script>
<script src="/themes/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="/themes/admin-lte/dist/js/adminlte.js"></script>
<script src="https://kit.fontawesome.com/8a5dbfaed5.js" crossorigin="anonymous"></script>
<!--<script src="/themes/admin/dist/js/demo.js"></script>-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/themes/admin-lte/dist/js/pages/dashboard.js"></script>
<script src="/themes/js/admin.js"></script>
</body>
</html>
