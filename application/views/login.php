<!DOCTYPE html>

<html lang="en">

<!-- Mirrored from www.saerox-design.com/elisyam/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 12 Apr 2020 01:16:04 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Elisyam - Login</title>
<meta name="description" content="Elisyam is a Web App and Admin Dashboard Template built with Bootstrap 4">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<script src="../../ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="32aabf6d46fe8f30abef9de6-text/javascript"></script>
<script type="32aabf6d46fe8f30abef9de6-text/javascript">
          WebFont.load({
            google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url().'assets/img/apple-touch-icon.png'?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url().'assets/img/favicon-32x32.png'?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url().'assets/img/favicon-16x16.png'?>">

<link rel="stylesheet" href="<?php echo base_url().'assets/vendors/css/base/bootstrap.min.css'?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/vendors/css/base/elisyam-1.5.min.css'?>">
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body class="bg-white">
	<div id="preloader">
		<div class="canvas">
			<img src="assets/img/logo.png" alt="logo" class="loader-logo">
			<div class="spinner"></div>
		</div>
	</div>	
	<div class="container-fluid no-padding h-100">
		<div class="row flex-row h-100 bg-white">
			<div class="col-xl-8 col-lg-6 col-md-5 no-padding">
				<div class="elisyam-bg background-01">
					<div class="elisyam-overlay overlay-01"></div>
					<div class="authentication-col-content mx-auto">
						<h1 class="gradient-text-01">Welcome To Order Management</h1>
						<span class="description">
							
						</span>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-6 col-md-7 my-auto no-padding">
				<div class="authentication-form mx-auto">
					<div class="logo-centered">
						
						<img src="<?php echo base_url()."assets/img/logo.png"?>" alt="logo">
					</div>
					
					<h3>Sign In To OMS</h3>
					<?php
						if($this->session->flashdata('msg'))
						{
							?>
								<p style="color: red;"><?php echo $this->session->flashdata('msg'); ?></p>
							<?php 
						}
					?>	
					<form method="POST" action="<?php echo site_url("login/login_process")?>">
						
						<div class="group material-input">
							<input type="text" required name="email">
							<span class="highlight"></span>
							<span class="bar"></span>
							<label>Email</label>
						</div>
						<div class="group material-input">
							<input type="password" name="password" required>
							<span class="highlight"></span>
							<span class="bar"></span>
							<label>Password</label>
						</div>
						<div class="row">
							<div class="col text-left">
								<div class="styled-checkbox">
									<input type="checkbox" name="checkbox" id="remeber">
									<label for="remeber">Remember me</label>
								</div>
							</div>
							<div class="col text-right">
								<a href="<?php echo site_url('login/forgot_password');?>">Forgot Password ?</a>
							</div>
						</div>
						<div class="sign-btn text-center">
							<input type="submit" name="login" class="btn btn-lg btn-gradient-01" value="Sign in">
						</div>
						
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
	
	<script src="<?php echo base_url().'assets/vendors/js/base/jquery.min.js'?>" type="32aabf6d46fe8f30abef9de6-text/javascript"></script>
	<script src="<?php echo base_url().'assets/vendors/js/base/core.min.js'?>" type="32aabf6d46fe8f30abef9de6-text/javascript"></script>
	<script src="<?php echo base_url().'assets/vendors/js/app/app.min.js'?>" type="32aabf6d46fe8f30abef9de6-text/javascript"></script>
	<script src="<?php echo base_url().'assets/ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js'?>" data-cf-settings="32aabf6d46fe8f30abef9de6-|49" defer=""></script></body>
	<!-- Mirrored from www.saerox-design.com/elisyam/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 12 Apr 2020 01:16:04 GMT -->
</html>