<footer>
    <?php if(!empty($partner)){ ?>
    <div class="container-fluid bg-white">
        <div class="container">
            <div class="owl-carousel owl-theme partner-slide">
                <?php
                foreach($partner as $partners){
                    if($partners->image != ''){ ?>
                <div class="item">
                    <img src="<?=base_url('assets/images/brandImage/'.$partners->image)?>" />
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="container">
        <div class="row pt-5 pb-5">
            <div class="col-md-7 col-12">
                <div class="row">
                    <div class="col-sm-3 col-12 mb-2">
                        <h6 class="text-uppercase font-weight-bold">Spectacle</h6>
                        <ul class="nav footer-nav flex-column pt-2 pb-3 FooterCategoryComponent">
                            <!-- <li class="nav-item"><a class="nav-link" href="javascript:void(0)">Spectacle On Sale</a></li> -->
                        </ul>
                    </div>
                    <div class="col-sm-3 col-12 mb-2">
                        <h6 class="text-uppercase font-weight-bold">Rim Glasses</h6>
                        <?php if(!empty($frames)){ ?>
                        <ul class="nav footer-nav flex-column pt-2 pb-3">
                            <?php foreach($frames as $frame){ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('products/frames/'.str_replace(' ', '_', $frame->name))?>">
                                    <?=$frame->name?>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </div>
                    <div class="col-sm-3 col-12 mb-2">
                        <h6 class="text-uppercase font-weight-bold">About Us</h6>
                        <ul class="nav footer-nav flex-column pt-2 pb-3">
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('info/our-story')?>">Our Story</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('info/support')?>">Support</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('blogs')?>">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('info/billing-and-shipping')?>">Billing and Shipping</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('info/return-policy')?>">Return Policy</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-3 col-12 mb-2">
                        <h6 class="text-uppercase font-weight-bold">Others</h6>
                        <ul class="nav footer-nav flex-column pt-2 pb-3">
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('testimonial')?>">Testimonial</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('contact-us')?>">Contact Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('info/site-map')?>">Site Map</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('info/faq')?>">FAQ</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-5">
                        <a href="javascript:void(0);" target="_blank" class="mr-3">
                            <img src="<?=base_url('assets/images/footer_facebook_icon.png')?>" />
                        </a>
                        <a href="javascript:void(0);" target="_blank" class="mr-3">
                            <img src="<?=base_url('assets/images/footer_twitter_icon.png')?>" />
                        </a>
                        <a href="javascript:void(0);" target="_blank" class="mr-3">
                            <img src="<?=base_url('assets/images/footer_youtube_icon.png')?>" />
                        </a>
                        <a href="javascript:void(0);" target="_blank" class="mr-3">
                            <img src="<?=base_url('assets/images/footer_vimeo_icon.png')?>" />
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-12 border-md-left pl-md-5">
                <div class="row">
                    <div class="col-12">
                        <div class="footer_contact_info">
                            <h5 class="text-uppercase text-primary text-center font-weight-bold pb-3">Contact Us</h5>
                            <ul class="nav d-flex justify-content-center row">
                                <li class="pt-1 pb-3">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa fa-phone pr-2" aria-hidden="true"></i>
                                        <h6 class="mb-0 pr-4 font-weight-bold"><?=$webManage['contact_phone']?></h6>
                                    </div>
                                </li>
                                <li class="pt-1 pb-3">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa fa-clock-o pr-2" aria-hidden="true"></i>
                                        <h6 class="mb-0 pr-2 font-weight-bold"><?=$webManage['contact_timing']?></h6>
                                    </div>
                                </li>
                                <li class="col-lg-auto col-md-12 col-sm-auto pt-1 pb-3">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa fa-map-marker pr-2" aria-hidden="true"></i>
                                        <h6 class="mb-0 font-weight-bold"><?=$webManage['contact_address']?></h6>
                                    </div>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-center text-center pb-4">
                                <h6><?=$webManage['contact_timing']?><?php if($webManage['contact_timing_alt'] != ''){ print ', '.$webManage['contact_timing_alt']; }?></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form class="footer_contact_form" id="footerContactForm">
                            <div class="form-row d-flex justify-content-between">
                                <div class="col-md-6 mb-2 pb-1">
                                    <input type="text" class="form-control bg-transparent w-100 requiredCheckFooter restrictSpecial" name="contactFormName" onkeypress="return isChar(this.event)" data-check="Name" placeholder="Name">
                                </div>
                                <div class="col-md-6 mb-2 pb-1">
                                    <input type="text" class="form-control bg-transparent w-100 requiredCheckFooter" name="contactFormEmail" data-check="Email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 text-right">
                                    <div class="pt-2 pl-3 pr-3 pb-3 border rounded">
                                        <textarea class="form-control bg-transparent border-0 p-0 mb-2 requiredCheckFooter"name="contactFormMessage" data-check="Message" placeholder="Message"></textarea>
                                        <button type="submit" class="btn btn-primary text-uppercase text-spacing footerContactBtn">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid border-top pt-3 pb-3 bg-gray">
        <div class="container p-0">
            <div class="row copyright">
                <div class="col-12 col-md-6 text-center text-md-left">
                    <ul class="nav w-auto d-flex justify-content-center justify-content-md-start">
                        <li class="nav-item pr-4">
                            <a class="nav-link active" href="<?=base_url('info/terms-and-conditions')?>">Terms and conditions</a>
                        </li>
                        <li class="nav-item pr-4">
                            <a class="nav-link" href="<?=base_url('info/privacy-policy')?>">Privacy Policy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url('info/customer-service')?>">Customer Service</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-6 text-center text-md-right">
                    <ul class="list-inline mt-2 mb-0">
                        <li class="list-inline-item pr-3">
                            <a href="javascript:void(0);"><?=$webManage['contact_phone']?></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="mailto:<?=$webManage['contact_email']?>"><?=$webManage['contact_email']?></a>
                        </li>
                    </ul>
                    <p class="footer-p">Design & Developement by <a href="https://astutemyndz.com" target="_blank">astutemyndz.com</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Search Product -->
<div class="Search js-search" id="show_search">
    <a href="javascript:void(0);" class="Search-close Icon Icon--close js-search-close" onclick="return closesearch()">
        <i class="fa fa-times" aria-hidden="true"></i>
    </a>
    <div class="Search-content">
        <div class="Form-group Form-group--center">
            <label for="search" class="Form-label">What are you looking for?</label>
            <input type="text" id="searchProduct" class="Form-input">
            <ul class="search-ul"></ul>
        </div>
    </div>
</div>
<!-- Search Product -->
<!--<div id="footer"></div>-->
<script src="<?=base_url('assets/js/vendor/modernizr-3.7.1.min.js')?>"></script>
<script src="<?=base_url('assets/js/jquery-3.4.1.min.js')?>"></script>
<script src="<?=base_url('assets/js/jquery.loading.js')?>"></script>
<script>
    //window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')

</script>
<script src="<?=base_url('assets/js/vendor/bootstrap.js')?>"></script>
<script src="<?=base_url('assets/js/owl.carousel.min.js')?>"></script>
<script src="<?=base_url('assets/js/vendor/revolution/jquery.themepunch.tools.min.js')?>"></script>
<script src="<?=base_url('assets/js/vendor/revolution/jquery.themepunch.revolution.min.js')?>"></script>
<script src="<?=base_url('assets/js/vendor/revolution/extensions/revolution.extension.actions.min.js')?>"></script>
<script src="<?=base_url('assets/js/vendor/revolution/extensions/revolution.extension.carousel.min.js')?>"></script>
<script src="<?=base_url('assets/js/vendor/revolution/extensions/revolution.extension.kenburn.min.js')?>"></script>
<script src="<?=base_url('assets/js/vendor/revolution/extensions/revolution.extension.layeranimation.min.js')?>"></script>
<script src="<?=base_url('assets/js/vendor/revolution/extensions/revolution.extension.migration.min.js')?>"></script>
<script src="<?=base_url('assets/js/vendor/revolution/extensions/revolution.extension.navigation.min.js')?>"></script>
<script src="<?=base_url('assets/js/vendor/revolution/extensions/revolution.extension.parallax.min.js')?>"></script>
<script src="<?=base_url('assets/js/vendor/revolution/extensions/revolution.extension.slideanims.min.js')?>"></script>
<script src="<?=base_url('assets/js/vendor/revolution/extensions/revolution.extension.video.min.js')?>"></script>
<script src="<?=base_url('assets/js/owl.carousel.min.js')?>"></script>
<script src="<?=base_url('assets/js/plugins.js')?>"></script>
<script src="<?=base_url('assets/js/main.js')?>"></script>
<script src="<?=base_url('assets/js/sweetalert.min.js')?>"></script>
<script type="text/javascript">
    var base_url = '<?=base_url()?>';
    var API_URL = '<?=base_url()?>';
    var UserId = '<?=userId()?>';

</script>
<script src="<?=base_url('assets/js/vendor/jquery.ui.widget.js');?>"></script>
<script src="<?=base_url('assets/js/jquery.iframe-transport.js');?>"></script>
<script src="<?=base_url('assets/js/jquery.fileupload.js');?>"></script>
<script src="<?=base_url('assets/js/spectogo.js')?>"></script>
</body>
</html>
