<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="section-subtitle"><b>ADD BRAND</b></h4>
                        <form class="form-horizontal" method="post" action="<?=base_url('admin/brand-management')?>" enctype="multipart/form-data">
                            <input type="hidden" name="brand_edit_id" value="<?php if(isset($brands)){ print $brands[0]->id;}?>">
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Brand Name</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control restrictSpecial" name="brandName" value="<?php if(isset($brands)){ print $brands[0]->name;}?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <?php if(isset($brands)){ ?>
                            <input type="hidden" class="form-control" name="old_brand_image" value="<?=$brands[0]->image?>">
                            <?php if($brands[0]->image != ''){ ?>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <img src="<?=base_url('assets/images/brandImage/'.$brands[0]->image)?>">
                                </div>
                            </div>
                            <?php } } ?>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Brand Image</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="file" class="form-control" name="file" aria-required="true">
                                        <p>SIZE 153 X 60</p>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <input type="submit" class="btn btn-danger" <?php if($this->uri->segment(3) != '') { ?> value="UPDATE BRAND" <?php }else{ ?> value="ADD BRAND" <?php } ?>>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
