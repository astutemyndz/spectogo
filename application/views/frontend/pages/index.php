<div class="rev_slider_wrapper fullwidthbanner-container">
    <div id="elegant_home_banner" class="rev_slider fullwidthbanner" data-version="5.4.6.3" style="display:none">
        <ul>
            <?php
            if(!empty($banners)){
                for($i = 0; $i < count($banners); $i++){
            ?>
            <li data-transition="crossfade" data-param1="<?=$i?>">
                <a href="<?=base_url('products/categories/'.str_replace(' ', '_', strtoupper($banners[$i]['cat_name'])))?>">
                    <img src="<?=base_url('assets/images/bannerImage/'.$banners[$i]['image'])?>" class="w-100 rev-slidebg" alt="<?=$banners[$i]['cat_name']?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" />
                </a>
            </li>
            <?php    
                }  
            }
            ?>
        </ul>
    </div>
</div>
<div id="main"></div>
