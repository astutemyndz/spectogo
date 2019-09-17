<script src="<?=base_url('assets/js/ckeditor/ckeditor.js')?>"></script>
<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="section-subtitle"><b><?php if($this->uri->segment(3) != ''){ print 'EDIT'; }else{ print 'ADD'; }?> REGLAZE</b></h4>
                        <form class="form-horizontal" method="post" action="<?=base_url('admin/reglaze-management')?>" enctype="multipart/form-data">
                            <input type="hidden" name="reglaze_edit_id" value="<?php if(isset($reglaze)){ print $reglaze[0]['id'];}?>">
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Frame Name</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <select class="form-control" name="frameId" required aria-required="true">
                                            <option value="">Select Frame Name</option>
                                            <?php
                                            if(!empty($frames)){
                                                foreach($frames as $frame){
                                            ?>
                                            <option value="<?=$frame->id?>" <?php if(isset($reglaze)){ if($frame->id == $reglaze[0]['frame_id']){ print 'selected'; }}?>><?=$frame->name?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Reglaze Price</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="reglazePrice" value="<?php if(isset($reglaze)){ print $reglaze[0]['price'];}?>" required aria-required="true" onkeypress="return isNumber(this.event)">
                                    </span>
                                </div>
                            </div>
                            <?php if(isset($reglaze)){ ?>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon" style="background-color: #000000;">
                                        <img src="<?=base_url('assets/images/reglazeImage/'.$reglaze[0]['image'])?>">
                                        <input type="hidden" name="old_reglazeImage" value="<?=$reglaze[0]['image']?>">
                                    </span>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Reglaze Image</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="file" class="form-control" name="reglazeImage" <?php if(!isset($reglaze)){ ?> required aria-required="true" <?php } ?>>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <input type="submit" class="btn btn-danger" <?php if($this->uri->segment(3) != '') { ?> value="UPDATE REGLAZE" <?php }else{ ?> value="ADD REGLAZE" <?php } ?>>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
