<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="section-subtitle"><b><?php if($this->uri->segment(3) != ''){ print 'EDIT'; }else{ print 'ADD'; }?> LENS SUB CATEGORY</b></h4>
                        <form class="form-horizontal" method="post" action="<?=base_url('admin/lens-sub-category-management')?>" enctype="multipart/form-data">
                            <input type="hidden" name="lenssubcategory_edit_id" value="<?php if(isset($lens)){ print $lens[0]['id'];}?>">
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Lens Category Name</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <select class="form-control" name="lensCatId" required aria-required="true">
                                            <option value="">Select Lens Category</option>
                                            <?php
                                            if(!empty($lensCat)){
                                                foreach($lensCat as $lenscat){
                                            ?>
                                            <option value="<?=$lenscat->id?>" <?php if(isset($lens)){ if($lenscat->id == $lens[0]['lens_cat_id']){ print 'selected'; }}?>><?=$lenscat->name?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Lens Sub Category Name</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="lensSubCatName" value="<?php if(isset($lens)){ print $lens[0]['lens_sub_cat_name'];}?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Lens Sub Category Description</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <textarea class="form-control" name="lensSubCatDescription" required aria-required="true"><?php if(isset($lens)){ print $lens[0]['description'];}?></textarea>
                                    </span>
                                </div>
                            </div>
                            <?php if(isset($lens)){ ?>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <img src="<?=base_url('assets/images/lensSubCatImage/'.$lens[0]['image'])?>">
                                        <input type="hidden" name="old_lensSubCatImage" value="<?=$lens[0]['image']?>">
                                    </span>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Lens Sub Category Image</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="file" class="form-control" name="lensSubCatImage" <?php if(!isset($lens)){ ?> required aria-required="true" <?php } ?>>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <input type="submit" class="btn btn-danger" <?php if($this->uri->segment(3) != '') { ?> value="UPDATE LENS SUB CATEGORY" <?php }else{ ?> value="ADD LENS SUB CATEGORY" <?php } ?>>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
