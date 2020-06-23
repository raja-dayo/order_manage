<!DOCTYPE html>

<html lang="en">

<!-- Mirrored from www.saerox-design.com/elisyam/pages-forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 12 Apr 2020 01:17:08 GMT -->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Elisyam - Forgot Password</title>
		<meta name="description" content="Elisyam is a Web App and Admin Dashboard Template built with Bootstrap 4">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<script src="../../ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="1b1775c7b0930e5f968be672-text/javascript"></script>
		<script type="1b1775c7b0930e5f968be672-text/javascript">
          WebFont.load({
            google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url().'assets/img/apple-touch-icon.png'?>">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url().'assets/img/favicon-32x32.png'?>">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo  base_url().'assets/img/favicon-16x16.png'?>">

		<link rel="stylesheet" href="<?php echo base_url().'assets/vendors/css/base/bootstrap.min.css'?>">
		<link rel="stylesheet" href="<?php echo base_url().'assets/vendors/css/base/elisyam-1.5.min.css'?>">
		<!--[if lt IE 9]>
        	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	</head>
	
	<body class="bg-fixed-02">

		<div id="preloader">
			<div class="canvas">
				<img src="<?php echo base_url().'assets/img/logo.png'?>" alt="logo" class="loader-logo">
				<div class="spinner"></div>
			</div>
		</div>
		
		<div class="container-fluid h-100 overflow-y">
			<div class="row flex-row h-100">
				<div class="col-12 my-auto">
					<div class="password-form mx-auto">
						<div class="logo-centered">
							<a href="db-default.html">
								<img src="<?php echo base_url().'assets/img/logo.png'?>" alt="logo">
							</a>
						</div>
						<h3>Password Recovery</h3>
						<?php
							if($this->session->flashdata('msg'))
							{
								?>
									<p style="color: red;"><?php echo $this->session->flashdata('msg'); ?></p>
								<?php
							}
						?>
						<form method="POST" action="<?php echo site_url('login/pass_reset');?>">
							<div class="group material-input">
								<input type="email" required name="email">
								<span class="highlight"></span>
								<span class="bar"></span>
								<label>Email</label>
							</div>
						
							<div class="button text-center">
								<input type="submit" name="submit" value="Submit" class="btn btn-lg btn-gradient-01">
							</div>
						</form>
						<div class="back">
							<a href="<?php echo base_url().'login'?>">Sign In</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script src="assets/vendors/js/base/jquery.min.js" type="-text/javascript"></script>
		<script src="assets/vendors/js/base/core.min.js" type="text/javascript"></script>
		<script src="assets/vendors/js/app/app.min.js" type="text/javascript"></script>
		<script src="../../ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="1b1775c7b0930e5f968be672-|49" defer=""></script>
	</body>
	<!-- Mirrored from www.saerox-design.com/elisyam/pages-forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 12 Apr 2020 01:17:08 GMT -->
</html>