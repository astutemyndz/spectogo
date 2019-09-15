<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="section-subtitle"><b>ADD PRODUCT ATTRIBUTE</b></h4>
                        <form class="form-horizontal" method="post" action="<?=base_url('admin/save-product-attribute-details')?>" enctype="multipart/form-data">
                            <input type="hidden" name="product_edit_id" value="<?php if(isset($products)){ print $products[0]['id'];}?>">
                            <input type="hidden" name="product_attribute_id" id="product_attribute_id" value="">
                            <?php if(!empty($attribute)){ ?>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Choose From Existing </label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <select class="form-control" id="oldAttributes">
                                            <option value=""> SELECT COLOR </option>
                                            <?php foreach($attribute as $atr){ ?>
                                            <option value="<?=$atr->id?>"><?=$atr->color_name.' - '.$atr->color?></option>
                                            <?php } ?>
                                        </select>

                                    </span>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Name *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" value="<?php if(isset($products)){ print $products[0]['name'];}?>" readonly aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Product Color *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control jscolor" name="productColor" id="productColor" required aria-required="true">
                                        <input type="hidden" name="old_productColor" id="old_productColor" value="">
                                    </span>
                                </div>
                            </div>
                            <div class="atrDetDiv">
                                <div class="form-group">
                                    <label for="lefticon" class="col-sm-2 control-label">Product Color Name *</label>
                                    <div class="col-sm-10">
                                        <span class="input-with-icon">
                                            <input type="text" class="form-control" name="productColorName" id="productColorName" required aria-required="true">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lefticon" class="col-sm-2 control-label">Product Price *</label>
                                    <div class="col-sm-10">
                                        <span class="input-with-icon">
                                            <input type="text" class="form-control chkPrice" onkeypress="return isNumber(this.event)" name="productPrice" id="productPrice" required aria-required="true">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lefticon" class="col-sm-2 control-label">Product Sell Price *</label>
                                    <div class="col-sm-10">
                                        <span class="input-with-icon">
                                            <input type="text" class="form-control chkPrice" onkeypress="return isNumber(this.event)" name="productSellPrice" id="productSellPrice" required aria-required="true">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lefticon" class="col-sm-2 control-label">Product Discount *</label>
                                    <div class="col-sm-10">
                                        <span class="input-with-icon">
                                            <input type="text" class="form-control" onkeypress="return isNumber(this.event)" name="productDiscount" id="productDiscount" required aria-required="true" readonly>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lefticon" class="col-sm-2 control-label">Product Stock *</label>
                                    <div class="col-sm-10">
                                        <span class="input-with-icon">
                                            <input type="text" class="form-control" onkeypress="return isNumber(this.event)" name="productStock" id="productStock" required aria-required="true">
                                        </span>
                                    </div>
                                </div>
                                <div class="moreImgDiv">
                                    <div class="form-group">
                                        <label for="lefticon" class="col-sm-2 control-label">Product Related Image </label>
                                        <div class="col-sm-10">
                                            <span class="input-with-icon">
                                                <input type="file" class="form-control" name="moreImage[]" aria-required="true" required>
                                                <p>SIZE 250 X 70</p>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="button" onclick="addImageRow()" class="btn">Add More Image</button>
                                    <input type="hidden" id="imgCount" value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <input type="submit" class="btn btn-danger" <?php if($this->uri->segment(3) != '') { ?> value="UPDATE PRODUCT ATTRIBUTE" <?php }else{ ?> value="ADD PRODUCT" <?php } ?>>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
