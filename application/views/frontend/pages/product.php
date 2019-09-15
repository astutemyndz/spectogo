<?php 
print_r($this->session->userdata());
//exit;
?>
<div id="main" class="content_section product-wrap">
    <div class="product_banner_section">
        <?php if(!empty($product)){ ?>
        <img src="<?=base_url('assets/images/bannerImage/'.$product[0]['banner_image'])?>" class="w-100" />
        <?php }else{ ?>
        <img src="<?=base_url('assets/images/product-banner.png')?>" class="w-100" />
        <?php } ?>
    </div>
    <div class="bg-white border-bottom pt-4 pb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-11 col-12">
                    <form class="search-form mt-0 mt-sm-n5 mb-4 ml-2 mr-2">
                        <div class="row">
                            <div class="border-0 border-sm-right col-lg-4 col-md-4 col-sm-4 pl-4 pr-4 pt-3 pb-3 bg-white radius_left text-center">Showing 1–16 of 133 results</div>
                            <div class="border-0 border-sm-right col-lg-3 col-md-3 col-sm-3 pl-4 pr-4 pt-3 pb-3 bg-white border-bottom border-sm-0 ml-3 mr-3 ml-sm-0 mr-sm-0">
                                <select class="bg-transparent border-0 bg-white text-uppercase w-100">
                                    <option>brands</option>
                                    <option>brands</option>
                                    <option>brands</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pl-4 pr-4 pt-3 pb-3 bg-white border-bottom border-sm-0 mb-3 mb-sm-0 ml-3 mr-3 ml-sm-0 mr-sm-0">
                                <input type="text" class="border-0" placeholder="Search frames" />
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 ml-3 mr-3 ml-sm-0 mr-sm-0 pt-3 pb-3 bg-primary radius_right text-center">
                                <button type="button" class="btn-primary text-uppercase text-white border-0"><i class="fa fa-search mr-1" aria-hidden="true"></i>Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-9 col-md-11 col-sm-12">
                    <div class="row">
                        <?php
                        $id_prodcuts = null;
                        if(!empty($product)){
                            foreach($product as $prod){            
                                //print_r($prod);  
                                $id_prodcuts = ($prod['id']) ? $prod['id'] : null;
                                $id_users = ($this->session->userdata('UserId')) ? $this->session->userdata('UserId') : '';
                                          
                        ?>
                        <div class="col-md-4 col-sm-6 text-center mb-5 product_box position-relative">
                            <a href="<?=base_url('product-details/'.$prod['slug'])?>">
                                <div class="product">
                                    <img src="<?=base_url('assets/images/productImage/'.$prod['primary_image'])?>" class="w-50 w-sm-75 w-lg-100" />
                                    <h6 class="mb-0 text-color-9 pt-2 pb-1 text-uppercase"><?=strtoupper($prod['brand_name'])?></h6>
                                    <h5 class="mb-0 font-weight-bold pb-1"><?=strtoupper($prod['name'])?></h5>
                                    <h5 class="mb-0 text-primary font-weight-semibold pb-2">£<?=explode(',', $prod['sell_price'])[0]?></h5>
                                </div>
                            </a>
                            <ul class="choose-glass-color">
                                <?php if($prod['color'] != ''){ for($i = 0; $i < count(explode(',', $prod['color'])); $i++){ ?>
                                <li style="background-color : #<?=explode(',', $prod['color'])[$i]?>"></li>
                                <?php } } ?>
                            </ul>
                            <div class="d-flex flex-row justify-content-center position-absolute w-100 top_position">
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 pr-0 pl-0 text-right">
    <button tyoe="button" class="text-uppercase btn btn-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Add to Cart</button>
</div>-->                       
                                <div class="col-lg-6 col-md-6 col-sm-6 pr-md-0 pr-4 text-left">
                                    <button data-id_products="<?php echo $id_prodcuts;?>" data-id_users="<?php echo $id_users;?>" tyoe="button" class="text-uppercase btn btn-primary wislist"><i class="fa fa-heart" aria-hidden="true"></i> wishlist</button>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
