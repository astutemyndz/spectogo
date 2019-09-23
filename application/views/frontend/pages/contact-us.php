<?php

?>
<div id="main" class="contact_section">
    <div class="bg-secondary">
        <div class="container">
            <div class="row d-flex justify-content-md-center pt-5 pb-md-5 pb-0">
                <div class="col-lg-3 col-md-3">
                    <p class="mb-0 text-color-3">CONTACT</p>
                    <h4 class="font-weight-bold">Get In touch with us</h4>
                    <p class="mt-3">
                        <a href="javascript:void(0);" target="_blank" class="mr-1">
                            <i class="fa fa-facebook text-center rounded-circle" aria-hidden="true"></i>
                        </a>
                        <a href="javascript:void(0);" target="_blank" class="mr-1">
                            <i class="fa fa-twitter text-center rounded-circle" aria-hidden="true"></i>
                        </a>
                        <a href="javascript:void(0);" target="_blank" class="mr-1">
                            <i class="fa fa-instagram text-center rounded-circle" aria-hidden="true"></i>
                        </a>
                    </p>
                    <p class="text-left text-color-3">
                        <?=$webManage['contact_desc']?>
                    </p>
                    <button type="button" class="btn btn-primary text-uppercase float-left pt-2 pb-2 pl-4 pr-4 mb-3">Know More</button>
                </div>
                <div class="col-lg-7 col-md-9">
                    <div class="row d-flex">
                        <div class="col-md-6 col-sm-6 col-12 mb-4">
                            <div class="bg-white clearfix d-flex align-content-center flex-wrap pl-3 pr-3" style="height:120px;">
                                <div class="float-left w-25 mr-2 text-center">
                                    <img src="<?=base_url('assets/images/location_icon.png')?>" />
                                </div>
                                <div class="float-left w-50">
                                    <h5 class="text-primary text-uppercase font-weight-bold">Address</h5>
                                    <span class="text-color-2"><?=$webManage['contact_address']?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12 mb-4">
                            <div class="bg-white clearfix d-flex align-content-center flex-wrap pl-3 pr-3" style="height:120px;">
                                <div class="float-left w-25 mr-2 text-center">
                                    <img src="<?=base_url('assets/images/telephone_icon.png')?>" />
                                </div>
                                <div class="float-left w-50">
                                    <h5 class="text-primary text-uppercase font-weight-bold">Phone</h5>
                                    <span class="text-color-2"><?=$webManage['contact_phone']?></span>
                                    <?php if($webManage['contact_phone_alt'] != ''){ ?>
                                        <br/><span class="text-color-2"><?=$webManage['contact_phone_alt']?></span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12 mb-4">
                            <div class="bg-white clearfix d-flex align-content-center flex-wrap pl-3 pr-3" style="height:120px;">
                                <div class="float-left w-25 mr-2 text-center">
                                    <img src="<?=base_url('assets/images/email_icon.png')?>" />
                                </div>
                                <div class="float-left w-50">
                                    <h5 class="text-primary text-uppercase font-weight-bold">Email Address</h5>
                                    <span class="text-color-2"><?=$webManage['contact_email']?></span>
                                    <?php if($webManage['contact_email_alt'] != ''){ ?>
                                        <br/><span class="text-color-2"><?=$webManage['contact_email_alt']?></span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12 mb-4">
                            <div class="bg-white clearfix d-flex align-content-center flex-wrap pl-3 pr-3" style="height:120px;">
                                <div class="float-left w-25 mr-2 text-center">
                                    <img src="<?=base_url('assets/images/clock_icon.png')?>" />
                                </div>
                                <div class="float-left w-50">
                                    <h5 class="text-primary text-uppercase font-weight-bold">Timing</h5>
                                    <span class="text-color-2"><?=$webManage['contact_timing']?></span>
                                    <?php if($webManage['contact_timing_alt'] != ''){ ?>
                                        <br/><span class="text-color-2"><?=$webManage['contact_timing_alt']?></span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white border-bottom pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-12">
                    <h4 class="font-weight-bold text-center mb-5">Have any questions? Get in touch!</h4>
                    <form id="contactusForm">
                        <div class="form-row d-flex justify-content-between">
                            <div class="col-md-6 col-sm-6 mb-2 pb-1">
                                <input type="text" name="contactFormFirstName" class="form-control requiredCheck bg-transparent w-100" data-check="First Name" onkeypress="return isChar(this.event)" placeholder="FIRST NAME">
                            </div>
                            <div class="col-md-6 col-sm-6 mb-2 pb-1">
                                <input type="text" name="contactFormLastName" class="form-control requiredCheck bg-transparent w-100" data-check="Last Name" onkeypress="return isChar(this.event)" placeholder="LAST NAME">
                            </div>
                        </div>
                        <div class="form-row d-flex justify-content-between">
                            <div class="col-md-6 col-sm-6 mb-2 pb-1">
                                <input type="text" name="contactFormEmail" class="form-control requiredCheck bg-transparent w-100" data-check="Email" placeholder="EMAIL ADDRESS">
                            </div>
                            <div class="col-md-6 col-sm-6 mb-2 pb-1">
                                <input type="text" name="contactFormPhone" class="form-control requiredCheck bg-transparent w-100" data-check="Phone" onkeypress="return isNumber(this.event)" placeholder="PHONE">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 text-right">
                                <div class="pt-2 pl-3 pr-3 pb-3 mb-4 border rounded">
                                    <textarea name="contactFormMessage" class="form-control requiredCheck bg-transparent border-0 p-0 mb-2" data-check="Message" placeholder="MESSAGE"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-2 text-center">
                                <button type="submit" class="btn btn-primary text-uppercase pt-2 pb-2 contactUsBtn">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    page = 'contact-us';

</script>