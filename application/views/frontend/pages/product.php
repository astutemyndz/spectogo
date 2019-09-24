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
                            <div class="border-0 border-sm-right col-lg-4 col-md-4 col-sm-4 pl-4 pr-4 pt-3 pb-3 bg-white radius_left text-center">Showing <span id="prodListCount"></span> result(s)</div>
                            <div class="border-0 border-sm-right col-lg-3 col-md-3 col-sm-3 pl-4 pr-4 pt-3 pb-3 bg-white border-bottom border-sm-0 ml-3 mr-3 ml-sm-0 mr-sm-0">
                                <select class="bg-transparent border-0 bg-white text-uppercase w-100" id="filterBrand">
                                <option value="">brands</option>    
                                    <?php
                                    if(!empty($partner)){
                                        foreach($partner as $brand){    
                                    ?>
                                        <option value="<?=$brand->id?>"><?=$brand->name?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pl-4 pr-4 pt-3 pb-3 bg-white border-bottom border-sm-0 mb-3 mb-sm-0 ml-3 mr-3 ml-sm-0 mr-sm-0">
                                <input type="text" class="border-0" id="filterFrame" placeholder="Search frames" />
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 ml-3 mr-3 ml-sm-0 mr-sm-0 pt-3 pb-3 bg-primary radius_right text-center">
                                <button type="button" class="btn-primary text-uppercase text-white border-0" onclick="filterProductByBrandAndName()">
                                    <i class="fa fa-search mr-1" aria-hidden="true"></i>Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-9 col-md-11 col-sm-12">
                    <div class="row" id="productListFragment">
                        <input type="hidden" data-categoryName="<?php echo ($this->uri->segment(3)) ? $this->uri->segment(3) : '';?>" id="categoryName">
                       <!-- Single Product start of code -->
                    </div>
                        <!-- Single Product end of code -->
                </div>
            </div>
        </div>
    </div>
</div>
