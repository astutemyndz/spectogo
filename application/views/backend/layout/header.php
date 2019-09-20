<!doctype html>
<html lang="en" class="fixed left-sidebar-top">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Spec2Go</title>
    <link rel="icon" type="image/png" sizes="192x192" href="<?=base_url('assets/images/icon.png')?>">
    <script src="<?=base_url('assets/admin/vendor/pace/pace.min.js')?>"></script>
    <link href="<?=base_url('assets/admin/vendor/pace/pace-theme-minimal.css')?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?=base_url('assets/admin/vendor/bootstrap/css/bootstrap-3.4.0.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/admin/vendor/font-awesome/css/font-awesome.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/admin/vendor/animate.css/animate.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/admin/vendor/toastr/toastr.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/admin/vendor/magnific-popup/magnific-popup.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/admin/stylesheets/css/style.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/sweetalert.min.css')?>">

</head>

<body>
    <div class="wrap">
        <div class="page-header">
            <div class="leftside-header">
                <div class="logo">
                    <a href="<?=base_url('admin/dashboard')?>" class="on-click">
                        <img alt="logo" src="<?=base_url('assets/images/logo.png')?>" style="height:55px; width: 200px;" />
                    </a>
                </div>
                <div id="menu-toggle" class="visible-xs toggle-left-sidebar" data-toggle-class="left-sidebar-open" data-target="html">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>
            <!-- RIGHTSIDE header -->
            <div class="rightside-header">
                <div class="header-middle"></div>
                <!--NOCITE HEADERBOX-->
                <div class="header-section hidden-xs" id="notice-headerbox">
                    <div class="header-separator"></div>
                </div>
                <!--USER HEADERBOX -->
                <div class="header-section" id="user-headerbox">
                    <div class="user-header-wrap">
                        <div class="user-info">
                            <span class="user-name"><?=$this->session->userdata('adminName')?></span>
                            <span class="user-profile">Admin</span>
                        </div>
                        <i class="fa fa-plus icon-open" aria-hidden="true"></i>
                        <i class="fa fa-minus icon-close" aria-hidden="true"></i>
                    </div>
                    <div class="user-options dropdown-box">
                        <div class="drop-content basic">
                            <ul>
                                <li> <a href="<?=base_url('admin/profile')?>"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="header-separator"></div>
                <!--Log out -->
                <div class="header-section">
                    <a href="<?=base_url('admin/logout')?>" data-toggle="tooltip" data-placement="left" title="Logout"><i class="fa fa-sign-out log-out" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="page-body">
