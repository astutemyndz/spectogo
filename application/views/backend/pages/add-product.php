<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="section-subtitle"><b>ADD PRODUCT</b></h4>
                        <form class="form-horizontal" method="post" action="<?=base_url('admin/product-management')?>" enctype="multipart/form-data">
                            <input type="hidden" name="product_edit_id" value="<?php if(isset($products)){ print $products[0]['id'];}?>">
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Name *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control restrictSpecial" name="productName" value="<?php if(isset($products)){ print $products[0]['name'];}?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Category *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <select class="form-control" name="productCat" required>
                                            <option value=""> SELECT CATEGORY </option>
                                            <?php if(!empty($options['categories'])){ foreach($options['categories'] as $cats){ ?>
                                            <option value="<?=$cats->id?>" <?php if(isset($products)){ if($products[0]['cat_id'] == $cats->id){ print 'selected';}}?>> <?=$cats->name?> </option>
                                            <?php } } ?>
                                        </select>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Speactacle Type *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <select class="form-control" name="productSpec" required>
                                            <option value=""> SELECT SPECTACLE TYPE </option>
                                            <?php if(!empty($options['specs'])){ foreach($options['specs'] as $spec){ ?>
                                            <option value="<?=$spec->id?>" <?php if(isset($products)){ if($products[0]['spec_id'] == $spec->id){ print 'selected';}}?>> <?=$spec->name?> </option>
                                            <?php } } ?>
                                        </select>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Frame Type *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <select class="form-control" name="productFrame" required>
                                            <option value=""> SELECT FRAME TYPE </option>
                                            <?php if(!empty($options['frames'])){ foreach($options['frames'] as $frame){ ?>
                                            <option value="<?=$frame->id?>" <?php if(isset($products)){ if($products[0]['frame_id'] == $frame->id){ print 'selected';}}?>> <?=$frame->name?> </option>
                                            <?php } } ?>
                                        </select>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Brand Type *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <select class="form-control" name="productBrand" required>
                                            <option value=""> SELECT BRAND </option>
                                            <?php if(!empty($options['brands'])){ foreach($options['brands'] as $brand){ ?>
                                            <option value="<?=$brand->id?>" <?php if(isset($products)){ if($products[0]['brand_id'] == $brand->id){ print 'selected';}}?>> <?=$brand->name?> </option>
                                            <?php } } ?>
                                        </select>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Description *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <textarea name="productDesc" class="form-control ckeditor" required><?php if(isset($products)){ print $products[0]['description'];}?></textarea>
                                    </span>
                                </div>
                            </div>
                            <!--<div class="form-group">
    <label for="lefticon" class="col-sm-2 control-label">Product Properties *</label>
    <div class="col-sm-10">
        <span class="input-with-icon">
            <textarea name="productProp" class="form-control ckeditor" required><?php if(isset($products)){ print $products[0]['properties'];}?></textarea>
        </span>
    </div>
</div>-->
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product ARM *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" onkeypress="return isNumber(this.event)" name="productArm" value="<?php if(isset($products)){ print $products[0]['arm'];}?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product BRIDGE *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" onkeypress="return isNumber(this.event)" name="productBridge" value="<?php if(isset($products)){ print $products[0]['bridge'];}?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product LENS *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" onkeypress="return isNumber(this.event)" name="productLens" value="<?php if(isset($products)){ print $products[0]['lens'];}?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product HEIGHT *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" onkeypress="return isNumber(this.event)" name="productHeight" value="<?php if(isset($products)){ print $products[0]['height'];}?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product SKU *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="productSKU" value="<?php if(isset($products)){ print $products[0]['sku'];}?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Warranty (Months) * </label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="productWarranty" onkeypress="return isNumber(this.event)" value="<?php if(isset($products)){ print $products[0]['warranty'];}?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Progressives </label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="productProgressives" value="<?php if(isset($products)){ print $products[0]['progressives'];}?>" aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Includes </label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="productIncludes" value="<?php if(isset($products)){ print $products[0]['includes'];}?>" aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Single Vision *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <select class="form-control" name="productSingleVision" required>
                                            <option value="">SELECT SINGLE VISION</option>
                                            <option value="1" <?php if(isset($products)){ if($products[0]['single_vision'] == '1'){ print 'selected';}} ?>>Yes</option>
                                            <option value="0" <?php if(isset($products)){ if($products[0]['single_vision'] == '0'){ print 'selected';}} ?>>No</option>
                                        </select>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Spring Hinge *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <select class="form-control" name="productSpringHinge" required>
                                            <option value="">SELECT Spring Hinge</option>
                                            <option value="1" <?php if(isset($products)){ if($products[0]['spring_hinge'] == '1'){ print 'selected';}} ?>>Yes</option>
                                            <option value="0" <?php if(isset($products)){ if($products[0]['spring_hinge'] == '0'){ print 'selected';}} ?>>No</option>
                                        </select>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Suitable for Tints *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <select class="form-control" name="productSuitableforTints" required>
                                            <option value="">SELECT SUITABLE FOR TINTS</option>
                                            <option value="1" <?php if(isset($products)){ if($products[0]['suitable_for_tints'] == '1'){ print 'selected';}} ?>>Yes</option>
                                            <option value="0" <?php if(isset($products)){ if($products[0]['suitable_for_tints'] == '0'){ print 'selected';}} ?>>No</option>
                                        </select>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Main Color *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control jscolor" name="productColor" id="productColor" required aria-required="true" value="<?php if(isset($products)){ print $products[0]['main_color'];}?>">
                                        <input type="hidden" name="old_productColor" value="<?php if(isset($products)){ print $products[0]['main_color'];}?>">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Main Color Name *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="productColorName" required aria-required="true" value="<?php if(isset($products)){ print $products[0]['main_color_name'];}?>">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Price *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control chkPrice" onkeypress="return isNumber(this.event)" name="productPrice" id="productPrice" required aria-required="true" value="<?php if(isset($products)){ print $products[0]['price'];}?>">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Sell Price *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control chkPrice" onkeypress="return isNumber(this.event)" name="productSellPrice" id="productSellPrice" required aria-required="true" value="<?php if(isset($products)){ print $products[0]['sell_price'];}?>">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Discount *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" onkeypress="return isNumber(this.event)" name="productDiscount" id="productDiscount" required aria-required="true" readonly value="<?php if(isset($products)){ print $products[0]['discount'];}?>">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Stock *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" onkeypress="return isNumber(this.event)" name="productStock" id="productStock" required aria-required="true" value="<?php if(isset($products)){ print $products[0]['stock'];}?>">
                                        <input type="hidden" name="old_productStock" value="<?php if(isset($products)){ print $products[0]['stock'];}?>">
                                    </span>
                                </div>
                            </div>

                            <?php if(isset($products)){ $cnt = 0; ?>
                            <input type="hidden" class="form-control" name="old_primary_image" id="old_primary_image" value="<?=$products[0]['primary_image']?>">
                            <input type="hidden" class="form-control" name="old_primary_image_one" id="old_primary_image_one" value="<?=$products[0]['primary_image_one']?>">
                            <input type="hidden" class="form-control" name="old_primary_image_two" id="old_primary_image_two" value="<?=$products[0]['primary_image_two']?>">
                            <input type="hidden" class="form-control" name="old_primary_image_three" id="old_primary_image_three" value="<?=$products[0]['primary_image_three']?>">
                            <?php if($products[0]['primary_image'] != ''){ ?>
                            <div class="form-group dispImg<?=$cnt?>">
                                <label for="lefticon" class="col-sm-2 control-label">Primary Image</label>
                                <div class="col-sm-9">
                                    <img src="<?=base_url('assets/images/productImage/'.$products[0]['primary_image'])?>" style="height: 100px;">
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" onclick="delPrimImage('<?=$products[0]['id']?>','<?=$products[0]['primary_image']?>', 'primary_image', '<?=$cnt?>')">Remove Image</button>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if($products[0]['primary_image_one'] != ''){ $cnt++; ?>
                            <div class="form-group dispImg<?=$cnt?>">
                                <label for="lefticon" class="col-sm-2 control-label">Relative Primary Image</label>
                                <div class="col-sm-9">
                                    <img src="<?=base_url('assets/images/productImage/'.$products[0]['primary_image_one'])?>" style="height: 100px;">
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" onclick="delPrimImage('<?=$products[0]['id']?>','<?=$products[0]['primary_image']?>', 'primary_image_one', '<?=$cnt?>')">Remove Image</button>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if($products[0]['primary_image_two'] != ''){ $cnt++; ?>
                            <div class="form-group dispImg<?=$cnt?>">
                                <label for="lefticon" class="col-sm-2 control-label">Relative Primary Image</label>
                                <div class="col-sm-9">
                                    <img src="<?=base_url('assets/images/productImage/'.$products[0]['primary_image_two'])?>" style="height: 100px;">
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" onclick="delPrimImage('<?=$products[0]['id']?>','<?=$products[0]['primary_image']?>', 'primary_image_two', '<?=$cnt?>')">Remove Image</button>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if($products[0]['primary_image_three'] != ''){ $cnt++; ?>
                            <div class="form-group dispImg<?=$cnt?>">
                                <label for="lefticon" class="col-sm-2 control-label">Relative Primary Image</label>
                                <div class="col-sm-9">
                                    <img src="<?=base_url('assets/images/productImage/'.$products[0]['primary_image_three'])?>" style="height: 100px;">
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" onclick="delPrimImage('<?=$products[0]['id']?>','<?=$products[0]['primary_image']?>', 'primary_image_three', '<?=$cnt?>')">Remove Image</button>
                                </div>
                            </div>
                            <?php } ?>
                            <?php } ?>
                            <div class="form-group primMainImgDiv <?php if(isset($products)){ if($products[0]['primary_image'] != ''){ print 'hide'; } } ?>">
                                <label for="lefticon" class="col-sm-2 control-label">Product Main Image *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="file" class="form-control" name="moreImage[]" id="primImg" aria-required="true" <?php if(isset($products)){ if($products[0]['primary_image'] == ''){ print 'required'; } } else{ print 'required'; }?>>
                                        <p>SIZE 250 X 70</p>
                                    </span>
                                </div>
                            </div>
                            <div class="morePrimImgDiv"></div>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="button" onclick="addPrimaryImageRow()" class="btn">Add More Image</button>
                                    <input type="hidden" id="primImgCount" value="0">
                                    <input type="hidden" id="primCount" value="<?php if(isset($products)){ print $cnt; }else{ print '0'; }?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <input type="submit" class="btn btn-danger" <?php if($this->uri->segment(3) != '') { ?> value="UPDATE PRODUCT" <?php }else{ ?> value="ADD PRODUCT" <?php } ?>>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
