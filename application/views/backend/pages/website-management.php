<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                    <div style="color:red; font-size: 22px;" id="flashdata">
                            <?php
                            if($this->session->flashdata('msg')){
                                print $this->session->flashdata('msg');
                                $this->session->set_flashdata('msg', '');
                            }
                            ?>
                        </div>
                        <h4 class="section-subtitle"><b>EDIT DETAILS</b></h4>
                        <form class="form-horizontal" method="post" action="<?=base_url('admin/website-management')?>">
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Contact Phone *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" onkeypress="return isNumber(this.event)" name="contactPhone" value="<?=$webManage['contact_phone']?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">ALt Contact Phone</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" onkeypress="return isNumber(this.event)" name="contactPhoneAlt" value="<?=$webManage['contact_phone_alt']?>">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Contact Email *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="contactEmail" value="<?=$webManage['contact_email']?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Alt Contact Email</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="contactEmailAlt" value="<?=$webManage['contact_email_alt']?>">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Contact Timing *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="contactTiming" value="<?=$webManage['contact_timing']?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Alt Contact Timing</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="contactTimingAlt" value="<?=$webManage['contact_timing_alt']?>">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Contact Address *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="contactAddress" value="<?=$webManage['contact_address']?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Contact Description *</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <textarea class="form-control" name="contactDescription" required aria-required="true" rows="10"><?=$webManage['contact_desc']?></textarea>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <input type="submit" class="btn btn-danger" value="UPDATE DETAILS">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
