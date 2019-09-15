<?php
if(isset($atrDetails)){
?>
<div class="form-group">
    <label for="lefticon" class="col-sm-2 control-label">Product Color Name *</label>
    <div class="col-sm-10">
        <span class="input-with-icon">
            <input type="text" class="form-control" name="productColorName" value="<?=$atrDetails[0]['color_name']?>" required aria-required="true">
        </span>
    </div>
</div>
<div class="form-group">
    <label for="lefticon" class="col-sm-2 control-label">Product Price *</label>
    <div class="col-sm-10">
        <span class="input-with-icon">
            <input type="text" class="form-control chkPrice" onkeypress="return isNumber(this.event)" value="<?=$atrDetails[0]['price']?>" name="productPrice" id="productPrice" required aria-required="true">
        </span>
    </div>
</div>
<div class="form-group">
    <label for="lefticon" class="col-sm-2 control-label">Product Sell Price *</label>
    <div class="col-sm-10">
        <span class="input-with-icon">
            <input type="text" class="form-control chkPrice" onkeypress="return isNumber(this.event)" value="<?=$atrDetails[0]['sell_price']?>" name="productSellPrice" id="productSellPrice" required aria-required="true">
        </span>
    </div>
</div>
<div class="form-group">
    <label for="lefticon" class="col-sm-2 control-label">Product Discount *</label>
    <div class="col-sm-10">
        <span class="input-with-icon">
            <input type="text" class="form-control" onkeypress="return isNumber(this.event)" value="<?=$atrDetails[0]['discount']?>" name="productDiscount" id="productDiscount" required aria-required="true" readonly>
        </span>
    </div>
</div>
<div class="form-group">
    <label for="lefticon" class="col-sm-2 control-label">Product Stock *</label>
    <div class="col-sm-10">
        <span class="input-with-icon">
            <input type="text" class="form-control" onkeypress="return isNumber(this.event)" value="<?=$atrDetails[0]['stock']?>" name="productStock" required aria-required="true">
            <input type="hidden" name="old_productStock" value="<?=$atrDetails[0]['stock']?>">
        </span>
    </div>
</div>
<?php if($atrDetails[0]['images'] != ''){ for($i = 0; $i<count(explode(',', $atrDetails[0]['images'])); $i++ ){ ?>
<div class="form-group imgCnt relImg<?=explode(',', $atrDetails[0]['images_id'])[$i]?>">
    <label for="lefticon" class="col-sm-2 control-label">Related Image</label>
    <div class="col-sm-9">
        <img src="<?=base_url('assets/images/productImage/'.explode(',', $atrDetails[0]['images'])[$i])?>" style="height: 100px;">
    </div>
    <div class="col-sm-1">
        <button type="button" onclick="removeImage('<?=explode(',', $atrDetails[0]['images_id'])[$i]?>', '<?=explode(',', $atrDetails[0]['images'])[$i]?>')" class="btn">Remove</button>
    </div>
</div>
<?php } } ?>
<div class="moreImgDiv"></div>
<?php
}
?>
