<!doctype html>
<html lang="en" class="fixed accounts sign-in">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Spec2Go</title>
    <link rel="icon" type="image/png" sizes="192x192" href="<?=base_url('assets/images/icon.png')?>">
    <link rel="stylesheet" href="<?=base_url('assets/admin/')?>vendor/bootstrap/css/bootstrap-3.4.0.min.css">
    <link rel="stylesheet" href="<?=base_url('assets/admin/')?>vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?=base_url('assets/admin/')?>vendor/animate.css/animate.css">
    <link rel="stylesheet" href="<?=base_url('assets/admin/')?>stylesheets/css/style.css">
</head>

<body style="background-color: #fff;">
    <div class="wrap">
        <div class="page-body animated slideInDown">
            <div class="logo">
                <img alt="logo" src="<?=base_url('assets/images/logo.png')?>" />
                <h1 class="text-center"> Admin </h1>
            </div>
            <div class="box">
                <!--SIGN IN FORM-->
                <div class="panel mb-none">
                    <div class="panel-content bg-scale-0">
                        <form method="post" action="<?=base_url('admin/do-login')?>">
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <span class="input-with-icon">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <i class="fa fa-key"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Sign in" class="btn btn-primary btn-block">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?=base_url('assets/admin/')?>vendor/jquery/jquery-3.4.0.min.js"></script>
    <script src="<?=base_url('assets/admin/')?>vendor/bootstrap/js/bootstrap-3.4.0.min.js"></script>
    <script src="<?=base_url('assets/admin/')?>vendor/nano-scroller/nano-scroller.js"></script>
    <script src="<?=base_url('assets/admin/')?>javascripts/template-script.min.js"></script>
    <script src="<?=base_url('assets/admin/')?>javascripts/template-init.min.js"></script>
</body>

</html>
