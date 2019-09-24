<div id="main" class="content_section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 pr-0 pl-0">
                <img src="<?=base_url('assets/images/testimonial-banner.png')?>" class="w-100"/>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 bg-secondary pt-lg-0 pt-5">
                <div class="row d-flex flex-column flex-md-row h-100 justify-content-center align-items-center pl-2 pl-lg-0">
                    <div class="col-lg-8 col-md-7 col-sm-12 mx-auto pl-4 pr-4 pr-md-0 pb-5 testimonial_section">
                        <div class="owl-carousel owl-theme owl-carousel pl-2">
                            <?php
                            if(!empty($testimonials)){
                                foreach($testimonials as $testimonial){
                            ?>
                                <div class="item">
                                    <h5 class="text-left mb-3 mt-0" style="line-height:28px;">
                                        <?=$testimonial->description?>
                                    </h5>
                                    <p class="text-color-3">
                                        <?=$testimonial->for_spectogo?>
                                    </p>
                                    <p>
                                        <span class="text-primary font-weight-bold"><?=$testimonial->name?></span>
                                        <span class="ml-2 mr-2">|</span><?=$testimonial->city?>
                                    </p>
                                </div>
                            <?php } }else{ ?>
                                <div class="text-center">
                                    <h3>No Testimonial Found !!!</h3>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script> page = 'testimonial'</script>