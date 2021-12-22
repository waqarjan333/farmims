<!doctype html>
<html lang="en">

<head>

	<!-- Light layout Bootstrap Css -->
	<link href="<?= base_url() ?>assets/css/bootstrap-dark.min.css" id="bootstrap-dark-style" disabled="disabled" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<!-- Icons Css -->
	<link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<!-- App Css-->
	<link href="<?= base_url() ?>assets/css/app-dark.min.css" id="app-dark-style" disabled="disabled" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/css/app-rtl.min.css" id="app-rtl-style" disabled="disabled" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

	<style>
		.authentication-bg {
			background-image: url(<?= base_url('assets/images/login-bg.jpg') ?>);
			/* Full height */
			height: 100%;

			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}

		.card {
			background-color: rgba(255, 255, 255, .8);
			border: 0 solid #f6f6f6;
			border-radius: .45rem;
		}
	</style>
</head>

<body class="authentication-bg">

	<div class="home-btn d-none d-sm-block">
            <a href="/" class="text-dark"><i class="mdi mdi-home-variant h2"></i></a>
        </div>
        <div class="account-pages my-5  pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div>
                            
                            <a href="javascript:void(0)" class="mb-2 d-block auth-logo">
									<img src="<?= base_url('assets/images/logo.png') ?>" alt="" height="70" class="logo logo-dark ">
									<img src="<?= base_url('assets/images/logo.png') ?>" alt="" height="70" class="logo logo-light ">
									
								</a>
                            <div class="card">
                               
                                <div class="card-body p-4"> 
    
                                    <div class="text-center mt-2">
                                        <h5 class="text-primary">Reset Password</h5>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <div class="alert alert-success text-center mb-4" role="alert">
                                            Enter your Email and instructions will be sent to you!
                                        </div>
                                        <?php echo form_open('forget_password/index') ?>
            
                                            <div class="form-group">
                                                <label for="useremail">Email</label>
                                                <input type="email" class="form-control" id="useremail" name="email" placeholder="Enter email">
                                            </div>
                                            
                                            <div class="mt-3 text-right">
                                                <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Reset</button>
                                            </div>
                
    
                                            <div class="mt-4 text-center">
                                                <p class="mb-0">Remember It ? <a href="login" class="font-weight-medium text-primary"> Signin </a></p>
                                            </div>
                                       <?php echo form_close() ?>
                                    </div>
                
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <p>© 2020 Minible. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

	<!-- JAVASCRIPT -->
	<script src="<?= base_url() ?>assets/libs/jquery/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>assets/libs/metismenu/metisMenu.min.js"></script>
	<script src="<?= base_url() ?>assets/libs/simplebar/simplebar.min.js"></script>
	<script src="<?= base_url() ?>assets/libs/node-waves/waves.min.js"></script>
	<script src="<?= base_url() ?>assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="<?= base_url() ?>assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

	<script src="<?= base_url() ?>assets/js/app.js"></script>

</body>

</html>