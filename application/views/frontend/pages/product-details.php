<?php 
// echo "<pre>";
// print_r($product);
$productId = (!empty($product)) ? $product[0]['id'] : '';
$defaultProductHexColorCode = (!empty($product)) ? $product[0]['main_color'] : '';
?>
<div id="main" class="content_section product-inner">
    <div class="bg-secondary pt-5 pb-5">
        <div class="container">
            <h4 class="font-weight-bold text-left text-sm-center"><?=$product[0]['name']?></h4>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-10 col-md-11 col-sm-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 mt-4 mt-sm-0 position-relative">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="color_option">
                                        <h6 class="text-uppercase font-weight-bold mb-3" style="letter-spacing:2px;">Colors</h6>
                                        <?php $hex = ''; if($product[0]['color'] != ''){ for($i=0; $i<count(explode(',', $product[0]['color'])); $i++){ if($i == 0){ $hex = explode(',', $product[0]['color'])[$i]; } ?>
                                        <a href="javascript:void(0);" onclick="chooseColor('<?=$product[0]['id']?>', '<?=explode(',', $product[0]['color'])[$i]?>')" class="text-primary pt-1 pb-1 d-block <?php if($i == 0){ print 'active'; } ?> ">
                                            <i class="fa fa-circle" style="color: #<?=explode(',', $product[0]['color'])[$i]?>"></i>
                                            <?=explode(',', $product[0]['color_name'])[$i]?> - $<?=explode(',', $product[0]['sell_price'])[$i]?>
                                        </a>
                                        <?php } } ?>
                                        <input type="hidden" id="choosenColor" value="<?=$hex?>">
                                        <!--<a href="javascript:void(0)" class="pt-1 pb-1 d-block">C2 Black and Gold - $51.28</a>
<a href="javascript:void(0)" class="pt-1 pb-1 d-block">C3 Black and Gun - $51.28</a>-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 rating_section">
                                    <!--<p class="mb-1 mt-3"><span class="font-weight-bold">Savannah 6162</span></p>
<p class="d-flex align-items-center mb-1">
    <img src="<?=base_url('assets/images/rating.png')?>" />
    <span class="pl-2">5/5</span>
</p>
<p class="text-color-7 mb-3" style="font-size:0.75rem">100% of customers recommend this product</p>-->
                                    <button type="button" class="text-uppercase btn pt-3 pb-3" style="background:#dbdbdb;margin-top:5px;">
                                        <i class="fa fa-heart pr-2" aria-hidden="true"></i> wishlist
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-6 mt-4 mt-sm-0">
                            <div class="row">
                                <div class="col-lg-9 col-md-9 order-md-1 order-2">
                                    <div id="big" class="owl-carousel owl-theme mb-3 commomProduct">
                                        <?php
                                        if($product[0]['product_images'] != ''){
                                            for($j = 0; $j < count(explode(',', $product[0]['product_images'])); $j++){
                                        ?>
                                        <div class="item">
                                            <img src="<?=base_url('assets/images/productImage/'.explode(',', $product[0]['product_images'])[$j])?>" class="w-75 w-sm-100 mx-auto" />
                                        </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 order-md-2 order-1 mb-3">
                                    <h6 class="text-uppercase font-weight-bold mb-3 pr-4" style="letter-spacing:2px;">Quantity</h6>
                                    <div class="quantity pt-3">
                                        <a href="javascript:void(0)" class="bg-transparent border-0 pr-2 pl-2 text-color-1">-</a>
                                        <span class="border-left border-right pl-4 pr-4">1</span>
                                        <a href="javascript:void(0);" class="bg-transparent border-0 pl-2 pr-2 text-color-1">+</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-8">
                                    <div id="thumbs" class="owl-carousel owl-theme mt-5 commomProduct">
                                        <?php
                                        if($product[0]['product_images'] != ''){
                                            for($k = 0; $k < count(explode(',', $product[0]['product_images'])); $k++){
                                        ?>
                                        <div class="item">
                                            <img src="<?=base_url('assets/images/productImage/'.explode(',', $product[0]['product_images'])[$k])?>" />
                                        </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4 col-md-4">
                                    <div class="choose_lense_button">
                                        <h4 class="font-weight-bold text-color-1 d-block mt-4 mt-md-0 mb-4 text-center ">$<span class="sellPrice"><?=explode(',', $product[0]['sell_price'])[0]?></span></h4>
                                        <a id="gtToCartLnk" <?php if(explode(',', $product[0]['sell_price'])[0] != 0){ ?> href="<?=base_url('choose-your-lens')?>" <?php }else{ ?> href="javascript:void(0);" <?php } ?>>
                                            <button type="button" class="btn btn-primary text-uppercase text-white pt-3 pb-3 w-100 gtToCart <?php if(explode(',', $product[0]['sell_price'])[0] == 0){ print 'disabled'; } ?>"><?php if(explode(',', $product[0]['sell_price'])[0] != 0){ print 'Choose Your Lenses'; }else{ print 'Not Available'; }?></button>
                                        </a>
                                    </div>
                                </div> -->
                                <div class="col-lg-4 col-md-4">
                                    <div class="choose_lense_button">
                                        <h4 class="font-weight-bold text-color-1 d-block mt-4 mt-md-0 mb-4 text-center ">$<span class="sellPrice"><?=explode(',', $product[0]['sell_price'])[0]?></span></h4>
                                        <form id="frmChooseYourLense">
                                            <input type="hidden" id="productId" value="<?php echo ($productId) ? $productId : '';?>">
                                            <input type="hidden" id="hexColorCode" value="<?php echo ($defaultProductHexColorCode) ? $defaultProductHexColorCode : '';?>">
                                            <input type="hidden" id="chooseLense" value="1">
                                            <button type="button" class="btn btn-primary text-uppercase text-white pt-3 pb-3 w-100 gtToCart <?php if(explode(',', $product[0]['sell_price'])[0] == 0){ print 'disabled'; } ?>"><?php if(explode(',', $product[0]['sell_price'])[0] != 0){ print 'Choose Your Lenses'; }else{ print 'Not Available'; }?></button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center align-items-center mt-5">
                        <label class="radio_container">
                            <input type="radio" checked>
                            <span class="checkmark"></span> </label>
                        <div class="mb-2">
                            <button type="button" class="btn bg-transparent text-color-1 font-weight-bold text-uppercase text-center mb-2">arm</button>
                            <div class="text-center border-top pt-2"><?=$product[0]['arm']?></div>
                        </div>
                        <div class="mb-2">
                            <button type="button" class="btn bg-transparent text-color-1 font-weight-bold text-uppercase text-center mb-2">bridge</button>
                            <div class="text-center border-top pt-2"><?=$product[0]['bridge']?></div>
                        </div>
                        <div class="mb-2">
                            <button type="button" class="btn bg-transparent text-color-1 font-weight-bold text-uppercase text-center mb-2">lens</button>
                            <div class="text-center border-top pt-2"><?=$product[0]['lens']?></div>
                        </div>
                        <div class="mb-2">
                            <button type="button" class="btn bg-transparent text-color-1 font-weight-bold text-uppercase text-center mb-2">height</button>
                            <div class="text-center border-top pt-2"><?=$product[0]['height']?></div>
                        </div>
                        <div class="mb-2">
                            <button type="button" class="btn btn-primary text-white text-color-1 font-weight-bold text-uppercase text-center mb-2">size help</button>
                            <div class="text-center border-top text-uppercase text-primary pt-2">fit most</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container border-bottom pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <h6 class="text-uppercase text-left font-weight-bold mb-4" style="letter-spacing:2px;">Description</h6>
                        <p class="text-color-4" style="line-height:27px;"><?=$product[0]['description']?></p>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-4 mb-sm-0">
                        <h6 class="text-uppercase text-left font-weight-bold mb-4" style="letter-spacing:2px;">Customer Reviews</h6>
                        <p class="d-flex align-items-center mb-2"><img src="<?=base_url('assets/images/rating.png')?>" /><span class="pl-2">5 / 5 - 2 Review(s)</span></p>
                        <p class="text-color-7 mb-2">100% of customers recommend this product (2 of 2)</p>
                        <button type="button" class="text-color-8 btn btn-primary text-uppercase text-white pl-3 pr-3 pt-1 pb-1">Add your review</button>
                        <p class="mb-2 mt-3"><span class="font-weight-bold">I Callaghan, GB</span><span class="pl-2 text-color-7">2nd June 2019</span></p>
                        <p class="d-flex align-items-center mb-2"><img src="<?=base_url('assets/images/rating.png')?>" /><span class="pl-2">Great Glasses</span></p>
                        <p class="text-color-7">Great value. Delivery was fast and glasses are excellent</p>
                        <span class="text-color-8 bg-dark text-uppercase pl-3 pr-3 pt-1 pb-1">Fit - As expected</span><span class="ml-2">I'd recommend this product</span>
                        <p class="mb-2 mt-4"><span class="font-weight-bold">I Callaghan, GB</span><span class="pl-2 text-color-7">15th May 2019</span></p>
                        <p class="d-flex align-items-center mb-2"><img src="<?=base_url('assets/images/rating.png')?>" /><span class="pl-2">Definitely recommend</span></p>
                        <p class="text-color-7">Stylish glasses at low cost price, definitely recommend and wouldn't pay expensive prices again.</p>
                        <span class="text-color-8 bg-dark text-uppercase pl-3 pr-3 pt-1 pb-1">Fit - As expected</span><span class="ml-2">I'd recommend this product</span>
                    </div>
                    <div class="col-md-4 col-sm-12 pl-4 pr-3 pr-md-0">
                        <h6 class="text-uppercase text-left font-weight-bold mb-4" style="letter-spacing:2px;">Properties</h6>
                        <div class="d-flex flex-row justify-content-left">
                            <div class="d-flex border-right w-50 w-md-25 pb-2 text-color-10">Product</div>
                            <div class="d-flex w-50 pl-4 pb-2 text-primary font-weight-bold"><?=$product[0]['name']?></div>
                        </div>
                        <div class="d-flex flex-row justify-content-left">
                            <div class="d-flex border-right w-50 pb-2 text-color-10">Product SKU</div>
                            <div class="d-flex w-50 pl-4 pb-2 text-primary font-weight-bold"><?=$product[0]['sku']?></div>
                        </div>
                        <div class="d-flex flex-row justify-content-left">
                            <div class="d-flex border-right w-50 pb-2 text-color-10">Suitable for</div>
                            <div class="d-flex w-50 pl-4 pb-2 text-primary font-weight-bold"><?=$product[0]['cat_name']?></div>
                        </div>
                        <div class="d-flex flex-row justify-content-left">
                            <div class="d-flex border-right w-50 pb-2 text-color-10">Single Vision</div>
                            <div class="d-flex w-50 pl-4 pb-2 text-primary font-weight-bold">
                                <?php print ($product[0]['single_vision'] == 1) ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : '< i class="fa fa-times text-red-1" aria-hidden="true"></i>' ?>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-left">
                            <div class="d-flex border-right w-50 pb-2 text-color-10">Progressives</div>
                            <div class="d-flex w-50 pl-4 pb-2 text-primary font-weight-bold"><?=$product[0]['progressives']?></div>
                        </div>
                        <div class="d-flex flex-row justify-content-left">
                            <div class="d-flex border-right w-50 pb-2 text-color-10">Spring Hinge</div>
                            <div class="d-flex w-50 pl-4 pb-2 text-primary font-weight-bold">
                                <?php print ($product[0]['spring_hinge'] == 1) ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : '<i class="fa fa-times text-red-1" aria-hidden="true"></i>' ?>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-left">
                            <div class="d-flex border-right w-50 pb-2 text-color-10">Suitable for Tints</div>
                            <div class="d-flex w-50 pl-4 pb-2 text-primary font-weight-bold">
                                <?php print ($product[0]['suitable_for_tints'] == 1) ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : '< i class="fa fa-times text-red-1" aria-hidden="true"></i>' ?>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-left">
                            <div class="d-flex border-right w-50 pb-2 text-color-10">Includes</div>
                            <div class="d-flex w-50 pl-4 pb-2 text-primary font-weight-bold"><?=$product[0]['includes']?></div>
                        </div>
                        <div class="d-flex flex-row justify-content-left">
                            <div class="d-flex border-right w-50 pb-2 text-color-10">Item Warranty</div>
                            <div class="d-flex w-50 pl-4 pb-2 text-primary font-weight-bold"><?=$product[0]['warranty']?> Months Warranty</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    page = 'product-details';

</script>
