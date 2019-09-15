<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Specs2Go</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="<?=base_url('assets/images/icon.png')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url('assets/css/normalize.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/owl.carousel.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/vendor/revolution/settings.css')?>" />
    <link rel="stylesheet" href="<?=base_url('assets/css/main.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/sweetalert.min.css')?>">
    <meta name="theme-color" content="#fafafa">
    <script>
        var page = '';

    </script>
</head>

<body id="home">
    <header class="home-header">
        <div class="container">
            <div class="row align-items-md-center">
                <div class="col-12 col-sm-6 col-md-8 col-lg-8">
                    <nav class="navbar navbar-expand-md navbar-light justify-content-between justify-content-sm-start">
                        <a class="navbar-brand mr-sm-5 mr-0 w-50 w-md-100 w-sm-75" href="<?=base_url()?>">
                            <img src="<?=base_url('assets/images/logo.png')?>" class="w-100" />
                        </a>
                        <button class="navbar-toggler p-0 border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-0 text-uppercase text-spacing">
                                <?php
                                if(!empty($banners)){
                                for($i = 0; $i < count($banners); $i++){ ?>
                                <li class="nav-item nav-<?=strtoupper($banners[$i]['cat_name'])?>">
                                    <a class="nav-link" href="<?=base_url('products/categories/'.strtoupper($banners[$i]['cat_name']))?>">
                                        <?=$banners[$i]['cat_name']?>
                                    </a>
                                </li>
                                <?php } } ?>
                                <li class="nav-item"> <a class="nav-link" href="reglaze.html">Reglaze</a></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url('contact-us')?>">Contact</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url('testimonial')?>">Testimonial</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-8 col-sm-6 col-md-4 col-lg-4 text-right d-none d-sm-block">
                    <ul class="list-inline mb-0 pt-4 pt-md-0">
                        <li class="list-inline-item mr-4 d-none d-lg-inline-block">
                            <div class="d-flex flex-row justify-content-center align-items-center"><i class="fa fa-phone" aria-hidden="true"></i>
                                <h5 class="text-primary ml-2 mb-0 font-weight-bold">020 8064 0960</h5>
                            </div>
                        </li>
                        <li class="list-inline-item mr-4 d-none d-sm-inline-block">
                            <a href="javascript:void(0);" onclick="return searchpopup()">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="list-inline-item mr-4 d-none d-sm-inline-block">
                            <a href="<?=base_url('cart')?>">
                                <img src="<?=base_url('assets/images/cart.png')?>" />
                                <span class="badge badge-success rounded-pill">0</span>
                            </a>
                        </li>
                        <li class="list-inline-item mr-4 d-none d-sm-inline-block wishlist-link">
                            <a href="#">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="list-inline-item d-none d-sm-inline-block">
                            <?php if(!$this->session->userdata('UserId')){ ?>
                            <a href="<?=base_url('sign-in')?>" class="btn btn-primary text-uppercase">Sign In</a>
                            <?php }else{ ?>
                            <a href="<?=base_url('sign-out')?>" class="btn btn-primary text-uppercase">Sign Out</a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!--<div id="header"></div>-->