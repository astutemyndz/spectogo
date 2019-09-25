<div id="main" class="content_section">
    <div class="tab-content px-0">
        <div class="tab-pane setup-content" id="prescription" role="tabpanel" aria-labelledby="nav-prescription-tab">
            <!--Add Your Prescription -->
             <!--Add Your Prescription -->
             <div class="container border-bottom pt-4 pb-4 addPresDiv d-none">
                <div class="row pt-4 pb-4 d-flex justify-content-md-center">
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 text-center">
                <h4 class="font-weight-bold">Add your prescription</h4>
                <p class="text-center text-color-1">Receive a recommendation for the best lens for you.<br>
                    Our dispensing opticians will verify your prescription. They may contact you if required.</p>
                <button type="button" class="btn text-uppercase font-weight-bold mt-2 bg-danger text-red">Ensure correct + / - values on SPH &amp; CYL powers are used!</button>
                <form class="prescription_form">
                    <div class="row pt-5">
                    <div class="col-md-8 col-sm-8 pr-4">
                    <div class="form-row">
                                <div class="form-group col-md-2 col-sm-2"></div>
                                <div class="form-group col-md-5 col-sm-5"><span class="font-weight-bold text-color-8">RE </span><span class="text-color-5">(Right Eye)</span></div>
                                <div class="form-group col-md-5 col-sm-5"><span class="font-weight-bold text-color-8">LE </span><span class="text-color-5">(Left Eye)</span></div>
                            </div>
                    <div class="form-row">
                                        <div class="form-group col-md-2 col-sm-2"><span class="font-weight-bold text-color-8">SPH</span><br />
                                            <span class="text-color-5">(Sphere)</span></div>
                                        <div class="form-group col-md-5 col-sm-5">
                                            <select class="form-control">
                                                <option value="">NONE</option>
                                                <?php for($i = -20; $i<= 12 ; $i = $i+0.25 ){ ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-5 col-sm-5">
                                            <select class="form-control">
                                                <option value="">NONE</option>
                                                <?php for($i = -20; $i<= 12 ; $i = $i+0.25 ){ ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2 col-sm-2"> <span class="font-weight-bold text-color-8">CYL</span><br />
                                            <span class="text-color-5">(Cylinder)</span></div>
                                        <div class="form-group col-md-5 col-sm-5">
                                            <select class="form-control">
                                                <option value="">NONE</option>
                                                <?php for($i = -6; $i<= 6 ; $i = $i+0.25 ){ ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-5 col-sm-5">
                                            <select class="form-control">
                                                <option value="">NONE</option>
                                                <?php for($i = -6; $i<= 6 ; $i = $i+0.25 ){ ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2 col-sm-2"><span class="font-weight-bold text-color-8">Axis</span><br />
                                            <span class="text-color-5">(Axis)</span></div>
                                        <div class="form-group col-md-5 col-sm-5">
                                            <select class="form-control">
                                                <option value="">NONE</option>
                                                <?php for($i = 1; $i<= 180 ; $i++ ){ ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-5 col-sm-5">
                                            <select class="form-control">
                                                <option value="">NONE</option>
                                                <?php for($i = 1; $i<= 180 ; $i++ ){ ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                        <div class="form-row">
                        <div class="form-group col-md-2 col-sm-2"></div>
                        <div class="form-group form-check col-md-8 col-sm-8 text-left mb-0 mb-sm-4">
                            <div class="custom-control custom-checkbox">
                                <input id="addPrism" type="checkbox" class="custom-control-input addPrism">
                                <label class="custom-control-label" for="addPrism">Add a prism <span class="text-red-1 font-weight-bold">(£17.34)</span></label>
                            </div>
                            </div>
                        </div>
                        <div class="copy-prescription-form copyPrescriptionForm d-none" id="copyPrescriptionForm">
                                        <p>Select the prism values shown in your prescription - additional charge: £16.67.</p>
                            <div class="form-row">
                                <div class="form-group col-md-2 col-sm-2"></div>
                                <div class="form-group col-md-5 col-sm-5"><span class="font-weight-bold text-color-8">RE </span><span class="text-color-5">(Right Eye)</span></div>
                                <div class="form-group col-md-5 col-sm-5"><span class="font-weight-bold text-color-8">LE </span><span class="text-color-5">(Left Eye)</span></div>
                            </div>
                            
                            <div class="form-row">
                                        <div class="form-group col-md-2 col-sm-2"><span class="font-weight-bold text-color-8">Horizontal Prism</span><br />
                                            <!-- <span class="text-color-5">(Sphere)</span> -->
                                        </div>
                                        <div class="form-group col-md-5 col-sm-5">
                                            <select class="form-control">
                                                <option value="">NONE</option>
                                                <?php for($i = -20; $i<= 12 ; $i = $i+0.25 ){ ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-5 col-sm-5">
                                            <select class="form-control">
                                                <option value="">NONE</option>
                                                <?php for($i = -20; $i<= 12 ; $i = $i+0.25 ){ ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2 col-sm-2"> <span class="font-weight-bold text-color-8">Base Direction</span><br />
                                            <!-- <span class="text-color-5">(Cylinder)</span> -->
                                        </div>
                                        <div class="form-group col-md-5 col-sm-5">
                                            <select class="form-control">
                                                <option value="">NONE</option>
                                                <?php for($i = -6; $i<= 6 ; $i = $i+0.25 ){ ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-5 col-sm-5">
                                            <select class="form-control">
                                                <option value="">NONE</option>
                                                <?php for($i = -6; $i<= 6 ; $i = $i+0.25 ){ ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2 col-sm-2"><span class="font-weight-bold text-color-8">Vertical Prism</span><br />
                                            <!-- <span class="text-color-5">(Axis)</span> -->
                                        </div>
                                        <div class="form-group col-md-5 col-sm-5">
                                            <select class="form-control">
                                                <option value="">NONE</option>
                                                <?php for($i = 1; $i<= 180 ; $i++ ){ ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-5 col-sm-5">
                                            <select class="form-control">
                                                <option value="">NONE</option>
                                                <?php for($i = 1; $i<= 180 ; $i++ ){ ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2 col-sm-2"><span class="font-weight-bold text-color-8">Base Direction</span><br />
                                            <!-- <span class="text-color-5">(Axis)</span> -->
                                        </div>
                                        <div class="form-group col-md-5 col-sm-5">
                                            <select class="form-control">
                                                <option value="">NONE</option>
                                                <?php for($i = 1; $i<= 180 ; $i++ ){ ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-5 col-sm-5">
                                            <select class="form-control">
                                                <option value="">NONE</option>
                                                <?php for($i = 1; $i<= 180 ; $i++ ){ ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-2 col-sm-2"></div>
                        <div class="form-group col-md-10 col-sm-10 text-left">
                        <div class="upload-btn-wrapper">
                            <button class="upload_btn border-0 pr-3 mr-2"> <i class="fa fa-paperclip" aria-hidden="true"></i> Attach prescription</button> Want us to verify your prescription?
                            <input type="file" name="attachment">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 border-left">
                        <div class="form-row">
                        <div class="form-group col-md-12 text-left"><span class="font-weight-bold text-color-8">PD </span><span class="text-color-5">(Pupillary Distance)</span></div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-12 text-left">
                            <select name="pupillaryDistance" id="pupillaryDistance" class="form-control mb-2">
                                <option id="pupillaryDistanceNotFound">select option</option>
                            </select>
                            <span><a href="#" class="text-blue">What's this?	Dual PD (ie 32/32)</a></span> </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-12 text-left"> <span class="font-weight-bold text-color-8">PRESCRIPTION NAME </span>
                            <input type="text" class="form-control mt-3 mb-2">
                            <span><a href="#" class="text-blue">What's this?</a></span> </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group form-check col-md-12 text-left mb-4 mb-md-0">
                            <div class="custom-control custom-checkbox">
                                <input id="addAdditionalInfoCheckBox" type="checkbox" class="custom-control-input addAdditionalInfoCheckBox">
                                <label class="custom-control-label" for="addAdditionalInfoCheckBox">Add Additional Information</label>
                            </div>
                        </div>
                        </div>
                        <div class="form-row addAdditionalInfoTextArea d-none" id="addAdditionalInfoTextArea">
                            <div class="form-group col-md-12 text-left"> 
                            <input type="text" class="form-control mt-3 mb-2">
                            </div>
                        </div>

                    </div>
                    </div>
                    <div class="form-row border pt-3 margin_border mt-4" style="margin-left:11%;">
                    <div class="form-group col-md-12 col-sm-12 pl-0 pl-4">
                    <input type="checkbox" class="form-check-input mr-2" id="exampleCheck1" style="margin-left:0px;">
                            <label class="form-check-label ml-4 text-left" for="exampleCheck1">I confirm that my prescription is correct with the correct  '+' and '-' SPH and CYL values selected, my prescription is not over 2 years old, I am over 
                        16 years old, and that I'm neither registered blind or partially blind. I have read and agree to the <a href="#" class="font-weight-bold">Terms of Sale</a>.</label>
                    </div>
                    </div>          
                    <div class="row mt-5">
                    <div class="col-12">
                        <button type="button" class="text-white btn btn-primary text-uppercase pt-2 pb-2 pl-4 pr-4">Next step - Choose lenses <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                    </div>
                    </div>
                </form>
                </div>
      	        </div>
            </div>
            <!--Add Your Prescription -->
            <!--Add Your Prescription -->
        </div>
    </div>
</div>
