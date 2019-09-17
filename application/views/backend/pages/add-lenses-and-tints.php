<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="section-subtitle"><b><?php if($this->uri->segment(3) != ''){ print 'EDIT'; }else{ print 'ADD'; }?> LENSES AND TINTS</b></h4>
                        <form class="form-horizontal" method="post" action="<?=base_url('admin/lenses-and-tints')?>">
                            <input type="hidden" name="lenscategory_edit_id" value="<?php if(isset($lens)){ print $lens[0]->id;}?>">
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Lenses & Tints Category Name</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="lensCatName" value="<?php if(isset($lens)){ print $lens[0]->name;}?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <input type="submit" class="btn btn-danger" <?php if($this->uri->segment(3) != '') { ?> value="UPDATE LENSES AND TINTS CATEGORY" <?php }else{ ?> value="ADD LENSES AND TINTS CATEGORY" <?php } ?>>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
