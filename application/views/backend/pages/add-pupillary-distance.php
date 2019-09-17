<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="section-subtitle"><b><?php if($this->uri->segment(3) != ''){ print 'EDIT'; }else{ print 'ADD'; }?> PUPILLARY DISTANCE</b></h4>
                        <form class="form-horizontal" method="post" action="<?=base_url('admin/pupillary-distance')?>">
                            <input type="hidden" name="pd_edit_id" value="<?php if(isset($pd)){ print $pd[0]->id;}?>">
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Pupillary Distance Name</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="pdName" value="<?php if(isset($pd)){ print $pd[0]->name;}?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <input type="submit" class="btn btn-danger" <?php if($this->uri->segment(3) != '') { ?> value="UPDATE PUPILLARY DISTANCE" <?php }else{ ?> value="ADD PUPILLARY DISTANCE" <?php } ?>>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
