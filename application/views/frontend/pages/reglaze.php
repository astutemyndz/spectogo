<div id="main" class="content_section">
    <div class="bg-secondary pb-5">
        <div class="container">
            <div class="row pt-5 pb-5">
                <div class="col-12 text-center">
                    <h4 class="font-weight-bold">
                        Replace your old lenses, keep your<br/>favourite frames
                    </h4>
                    <button type="button" class="btn text-uppercase font-weight-bold mt-2 bg-danger text-red">Reglaze your own glasses</button>
                </div>
            </div>
            <div class="row d-flex justify-content-md-center pb-md-4 pb-0">
                <div class="col-md-4">
                    <img src="<?=base_url('assets/images/frame.png')?>" class="w-100"/>
                </div>
                <div class="col-md-4 mt-md-0 mt-4 text-color-4">
                    <p>Are you happy with your current glasses but need them reglazed to fit a new prescription or to fix a broken lens?</p>
                    <p>No problem. Our reglaze service starts from just £12, and it couldn't be easier to get your new glasses reglazed with us. Get new lenses in your frame today!</p>
                    <p>You will receive an email once we have received your glasses. For single vision orders we ask to allow 5 working days for dispatch. For varifocals, bifocals and rimless frames, we ask to allow up to 21 working days for dispatch.</p>
                    <p>So, if you love your current frame but need to:</p>
                </div>
            </div>
            <ul class="nav d-flex justify-content-center row">
                <li class="pt-1 pb-3">
                    <div class="d-flex justify-content-center align-items-center"><i class="fa fa-check text-success" aria-hidden="true"></i>
                        <h6 class="mb-0 pr-4 font-weight-bold">REPLACE YOUR SCRATCHED LENSES?</h6>
                    </div>
                </li>
                <li class="pt-1 pb-3">
                    <div class="d-flex justify-content-center align-items-center"><i class="fa fa-check text-success" aria-hidden="true"></i>
                        <h6 class="mb-0 pr-2 font-weight-bold">REPLACE YOUR BROKEN LENSES?</h6>
                    </div>
                </li>
                <li class="col-lg-auto col-md-12 col-sm-auto pt-1 pb-3">
                    <div class="d-flex justify-content-center align-items-center"><i class="fa fa-check text-success" aria-hidden="true"></i>
                        <h6 class="mb-0 font-weight-bold">UPDATE YOUR PRESCRIPTION?</h6>
                    </div>
                </li>
            </ul>
            <ul class="nav d-flex justify-content-center row">
                <li class="pt-1 pb-3">
                    <div class="d-flex justify-content-center align-items-center">
                        <h6 class="mb-0 pr-4 font-weight-bold text-primary">We can help you.</h6>
                    </div>
                </li>
                <li class="pt-1 pb-3">
                    <div class="d-flex justify-content-center align-items-center">
                        <h6 class="mb-0 pr-2 text-color-4">Start by first selecting your frame (style) type below.</h6>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="container pt-5 pb-5 border-bottom">
        <h4 class="font-weight-bold text-center">Here's what to do & how it works</h4>
        <div class="row d-flex justify-content-md-center text-color-4 pt-5 pb-5">
            <div class="col-lg-7 col-12 p-lg-0">
                <div class="row text-center">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <h5 class="mx-auto bg-dark rounded-circle" style="width:55px;height:55px;line-height:55px;">01</h5>
                    <p>Select your frame type from those below</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <h5 class="mx-auto bg-dark rounded-circle" style="width:55px;height:55px;line-height:55px;">02</h5>
                    <p>Choose your lens package, add your required lenses and any tints</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <h5 class="mx-auto bg-dark rounded-circle" style="width:55px;height:55px;line-height:55px;">03</h5>
                    <p>Proceed to checkout and pay for your reglaze order</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <h5 class="mx-auto bg-dark rounded-circle" style="width:55px;height:55px;line-height:55px;">04</h5>
                    <p>Send your glasses to us at: <?=$webManage['contact_address']?> with reference to your order number.</p>
                </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-md-center pb-3">
            <div class="col-lg-8 col-12">
                <div class="row d-flex align-content-center flex-row align-item-center">
                    <?php
                    if(!empty($reglazes)){
                        foreach($reglazes as $reglaze){
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 mb-3 text-center">
                        <div class="bg-primary h-100 pt-5 pb-5">
                            <div class="d-block mb-3">
                                <img src="<?=base_url('assets/images/reglazeImage/'.$reglaze['image'])?>" />
                                <h6 class="text-white font-weight-bold text-uppercase mt-4"><?=$reglaze['frame_name']?></h6>
                                <h6 class="text-white font-weight-bold text-uppercase mt-4">$ <?=$reglaze['price']?></h6>
                            </div>
                            <a href="javascript:void(0);" onclick="set_reglaze('<?=$reglaze['frame_id']?>')" class="btn btn-primary text-uppercase bg-light">Select</a>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>page = 'reglaze';</script>