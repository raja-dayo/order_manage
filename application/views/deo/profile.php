<?php

	require_once("include/header.php");

?>

<div class="content-inner profile">
	<div class="container-fluid">
		<div class="row">
			<div class="page-header">
				<div class="d-flex align-items-center">
					<h2 class="page-header-title">Profile</h2>
					<div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="db-default.html"><i class="ti ti-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#">Pages</a></li>
							<li class="breadcrumb-item active">Profile</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row flex-row">
			<div class="col-xl-3">
				<div class="widget has-shadow">
					<div class="widget-body">
						<div class="mt-5">
							<img src="<?php echo base_url()."assets/img/".$_SESSION['data']['deo']['image'];?> " alt="..." style="width: 120px;" class="avatar rounded-circle d-block mx-auto">
						</div>
						<h3 class="text-center mt-3 mb-1"><?php echo ucwords($_SESSION['data']['deo']['name']);?></h3>
						<p class="text-center"><?php echo $_SESSION['data']['deo']['email'];?></p>
						<div class="em-separator separator-dashed"></div>
					</div>
				</div>
			</div>
			<div class="col-xl-9">
				<div class="widget has-shadow">
					<div class="widget-header bordered no-actions d-flex align-items-center">
						<h4>Update Profile</h4>
					</div>
					<div class="widget-body">
						<div class="col-10 ml-auto">
							<div class="section-title mt-3 mb-3">
								<h4>01. Personnal Informations</h4>
							</div>
						</div>
						<?php  echo form_open_multipart("deo/update_profile"); ?>
						<!--<form class="form-horizontal">-->
							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">First Name</label>
								<div class="col-lg-6">
									<input type="text" class="form-control" placeholder="Enter First Name" name="firstname" value="<?php echo $deo[0]['name'];?>">
								</div>
							</div>
							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Last Name</label>
								<div class="col-lg-6">
									<input type="text" class="form-control" placeholder="Enter Last Name" name="lastname" value="<?php echo $deo[0]['last_name']; ?>">
								</div>
							</div>
							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Email</label>
								<div class="col-lg-6">
									<input type="text" class="form-control" placeholder="Enter Your Email" name="email" value="<?php echo $deo[0]['email'];?>" disabled="true">
								</div>
							</div>

							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Password</label>
								<div class="col-lg-6">
									<span>
										<?php
											$decrypt_password = rawurldecode($this->encrypt->decode($deo[0]['password']));
										?>
										<input type="password" class="form-control" placeholder="Enter Your Password" name="password" id="myInput" value="<?php echo $decrypt_password;?>">
									</span>
									<input type="checkbox" name="show" id="show" onclick="myFunction()"> <label>Show password</label>
								</div>
							</div>
							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Phone</label>
								<div class="col-lg-6">
									<input type="text" class="form-control" placeholder="Enter Your Phone Number" name="number" value="<?php echo $deo[0]['phone_number'];?>">
								</div>
							</div>
							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Upload</label>
								<div class="col-lg-6">
									<input type="file" class="form-control" name="image" placeholder="Enter Your Phone Number">
								</div>
							</div>
						
							<div class="col-10 ml-auto">
								<div class="section-title mt-3 mb-3">
									<h4>02. Address Informations</h4>
								</div>
							</div>
							
							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Address</label>
								<div class="col-lg-6">
									<input type="text" class="form-control" placeholder="Enter Your Address" name="address" value="<?php echo $deo[0]['address'];?>">
								</div>
							</div>
						<!--</form>-->
						<div class="em-separator separator-dashed"></div>
						<div class="text-right">	
							<input type="hidden" name="file_name" value="<?php echo $deo[0]['image'];?>">
							<button class="btn btn-gradient-01" type="submit">Save Changes</button>
							<button class="btn btn-shadow" type="reset">Cancel</button>
						</div>
						<?php  echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){

			$("#show").click(function(){

				//alert();
			});
		});

		function myFunction() {
  			var x = document.getElementById("myInput");
  			if (x.type === "password") {
    			x.type = "text";
  			} else {
    			x.type = "password";
  			}
		}
	</script>
<?php

	require_once("include/footer.php");

?>