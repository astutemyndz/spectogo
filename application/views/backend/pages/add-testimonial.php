<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="section-subtitle"><b><?php if($this->uri->segment(3) != ''){ print 'EDIT'; }else{ print 'ADD'; }?> TESTIMONIAL</b></h4>
                        <form class="form-horizontal" method="post" action="<?=base_url('admin/testimonial-management')?>">
                            <input type="hidden" name="testimonial_id" value="<?php if(isset($testimonial)){ print $testimonial->id;}?>">
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Name *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control restrictSpecial" name="testiName" value="<?php if(isset($testimonial)){ print $testimonial->name;}?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">City *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control restrictSpecial" name="testiCity" value="<?php if(isset($testimonial)){ print $testimonial->city;}?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Decription *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <textarea rows="10" class="form-control" name="testiDesc" required aria-required="true"><?php if(isset($testimonial)){ print $testimonial->description;}?></textarea>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Thanksgiving to Specs2Go</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                    <textarea rows="10" class="form-control" name="testiThanksGiving"><?php if(isset($testimonial)){ print $testimonial->for_spectogo;}?></textarea>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <input type="submit" class="btn btn-danger" <?php if($this->uri->segment(3) != '') { ?> value="UPDATE TESTIMONIAL" <?php }else{ ?> value="ADD TESTIMONIAL" <?php } ?>>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
