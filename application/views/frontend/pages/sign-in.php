<div id="main" class="content_section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 pr-0 pl-0">
                <img src="<?=base_url('assets/images/sign-banner.png')?>" class="w-100" />
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 bg-secondary">
                <div class="row d-flex flex-column flex-md-row h-100 justify-content-center align-items-center">
                    <div class="col-lg-7 col-md-8 col-sm-10 mx-auto pl-4 pr-4 pl-md-0 pr-md-0">
                        <h4 class="text-center mb-4 mt-3"><span class="font-weight-bold">Sign</span> in to your account</h4>
                        <form autocomplete="off" id="loginForm">
                            <div class="form-row mb-4">
                                <div class="col-12 border-bottom pl-1 pr-3 pt-2 pb-2">
                                    <input type="text" name="loginEmail" class="border-0 bg-transparent w-75 requiredCheck" placeholder="Your email address" data-check="Email" />
                                    <span class="float-right"><img src="<?=base_url('assets/images/email_ico.png')?>" /></span>
                                </div>
                            </div>
                            <div class="form-row mb-5">
                                <div class="col-12 border-bottom pl-1 pr-3 pt-2 pb-2">
                                    <input type="password" name="loginPassword" class="border-0 bg-transparent w-75 requiredCheck" placeholder="Your Password" data-check="Password" />
                                    <span class="float-right"><img src="<?=base_url('assets/images/password_ico.png')?>" /></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary text-uppercase pt-2 pb-2 logInBtn">Login Your Account</button>
                                </div>
                            </div>
                        </form>
                        <p class="text-center mt-5 text-primary">
                            <a href="javascript:void(0);">Forgot Password?</a>
                        </p>
                        <p class="text-center mb-5 text-color-3">You don't have any account?
                            <a href="<?=base_url('sign-up')?>" class="text-primary"> Register</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
