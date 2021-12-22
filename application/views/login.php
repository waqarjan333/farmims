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
		<a href="#" class="text-dark"><i class="mdi mdi-home-variant h2"></i></a>
	</div>
	<div class="account-pages my-5 pt-sm-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-center mt-2">
						<h3 class="text-primary">Welcome!</h3>
						
					</div>
				</div>
			</div>
			<div class="row align-items-center justify-content-center">
				<div class="col-md-8 col-lg-6 col-xl-5">
					<div class="card">

						<div class="card-body p-4">
							<div class="text-center">
								<a href="javascript:void(0)" class="mb-2 d-block auth-logo">
									<img src="<?= base_url('assets/images/logo.png') ?>" alt="" height="70" class="logo logo-dark ">
									<img src="<?= base_url('assets/images/logo.png') ?>" alt="" height="70" class="logo logo-light ">
									
								</a>
							</div>

							<div class="p-2 mt-4">
								<?php echo form_open('login/index') ?>
								<?php if ($this->session->flashdata('error')) { ?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<i class="uil uil-exclamation-octagon mr-2"></i>
										<?= $this->session->flashdata('error') ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
								<?php } ?>
								<?php if ($this->session->flashdata('success')) { ?>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										<i class="uil uil-exclamation-octagon mr-2"></i>
										<?= $this->session->flashdata('success') ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
								<?php } ?>
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" class="form-control" name="email" id="username" placeholder="Enter username">
									<span class="text-danger"><?php echo form_error('email'); ?></span>
								</div>

								<div class="form-group">
									<div class="float-right">
										<a href="forget_password" class="text-muted">Forgot password?</a>
									</div>
									<label for="userpassword">Password</label>
									<input type="password" name="password" class="form-control" id="userpassword" placeholder="Enter password">
									<span class="text-danger"><?php echo form_error('password'); ?></span>
								</div>

								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="auth-remember-check">
									<label class="custom-control-label" for="auth-remember-check">Remember me</label>
								</div>

								<div class="mt-3 text-right">
									<button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Log In</button>
								</div>



								<!-- <div class="mt-4 text-center">
									<div class="signin-other-title">
										<h5 class="font-size-14 mb-3 title">Sign in with</h5>
									</div> 
									<ul class="list-inline">
										<li class="list-inline-item">
											<a href="javascript:void()" class="social-list-item bg-primary text-white border-primary">
												<i class="mdi mdi-facebook"></i>
											</a>
										</li>
										<li class="list-inline-item">
											<a href="javascript:void()" class="social-list-item bg-info text-white border-info">
												<i class="mdi mdi-twitter"></i>
											</a>
										</li>
										<li class="list-inline-item">
											<a href="javascript:void()" class="social-list-item bg-danger text-white border-danger">
												<i class="mdi mdi-google"></i>
											</a>
										</li>
									</ul>
								</div> -->

								<div class="mt-4 text-center">
									<p class="mb-0">Don't have an account ? <a href="auth-register" class="font-weight-medium text-primary"> Signup now </a> </p>
								</div>
								<?php echo form_close() ?>
							</div>

						</div>
					</div>

					<div class="mt-5 text-center">
						<p>© 2021 farmims <i class="mdi mdi-heart text-danger"></i> </p>
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