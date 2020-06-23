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
							<img src="<?php echo base_url()."assets/img/".$vendor[0]['image'];?> " alt="..." style="width: 120px;" class="avatar rounded-circle d-block mx-auto">
						</div>
						<h3 class="text-center mt-3 mb-1"><?php echo ucwords($vendor[0]['name']);?></h3>
						<p class="text-center"><?php echo $vendor[0]['email'];?></p>
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
						<?php  echo form_open_multipart("vender/updateVendor"); ?>
						<!--<form class="form-horizontal" method="post" action="<?php //echo site_url("vender/updateVendor");?>" enctype="multipart/form-data">-->
							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">First Name</label>
								<div class="col-lg-6">
									<input type="text" class="form-control" placeholder="Enter First Name" name="firstname" value="<?php echo $vendor[0]['name'];?>">
								</div>
							</div>
							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Last Name</label>
								<div class="col-lg-6">
									<input type="text" class="form-control" placeholder="Enter Last Name" name="lastname" value="<?php echo $vendor[0]['last_name'];?>">
								</div>
							</div>
							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Email</label>
								<div class="col-lg-6">
									<input type="text" class="form-control" placeholder="Enter Your Email" name="email" value="<?php echo $vendor[0]['email'];?>" disabled="true">
								</div>
							</div>

							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Password</label>
								<div class="col-lg-6">
									<span>
										<?php
											$decrypt_password = rawurldecode($this->encrypt->decode($vendor[0]['password']));
										?>
										<input type="password" class="form-control" placeholder="Enter Your Password" name="password" id="myInput" value="<?php echo $decrypt_password;?>">
									</span>
									<input type="checkbox" name="show" id="show" onclick="myFunction()"> <label>Show password</label>
								</div>
							</div>
							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Phone</label>
								<div class="col-lg-6">
									<input type="text" class="form-control" placeholder="Enter Your Phone Number" name="number" value="<?php echo $vendor[0]['phone_number'];?>">
								</div>
							</div>

							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Website</label>
								<div class="col-lg-6">
									<input type="text" class="form-control" placeholder="Enter Your Website" name="site" value="<?php echo $vendor[0]['site'];?>">
								</div>
							</div>

							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Upload</label>
								<div class="col-lg-6">
									<input type="file" class="form-control" name="image">
								</div>
							</div>
							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Country</label>
								    <div class="col-lg-6">
                  					<div class="select">
								 <select class="custom-select form-control" id="country" name="country" required>
				                      <option value="">Select an option</option>
				                      <?php
				                        foreach ($countries as $key => $country) {
				                          ?>
											<option value="<?php echo $country['country_id'];?>"<?=$country['country_id']==$vendor[0]['country_id'] ? 'selected="selected"' : ''; ?>><?php echo strtoupper($country['country_name']);?></option>
				                          <?php
				                        }
				                      ?>
				                    </select>
				         			</div>
				         		</div>
				                    <div class="invalid-feedback">
				                      Please select an option
				                    </div>
				            </div>
							
							<!--<div class="col-10 ml-auto">
								<div class="section-title mt-3 mb-3">
									<h4>02. Address Informations</h4>
								</div>
							</div>
							
							<div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Address</label>
								<div class="col-lg-6">
									<input type="text" class="form-control" placeholder="Enter Your Address" value="<?php //echo $_SESSION['data']['vender']['address'];?>">
								</div>
							</div>-->
						
							<div class="em-separator separator-dashed"></div>
							<div class="text-right">
								<input type="hidden" name="file_name" value="<?php echo $vendor[0]['image'];?>">	
								<button class="btn btn-gradient-01" type="submit">Save Changes</button>
								<button class="btn btn-shadow" type="reset">Cancel</button>
							</div>
						<!--</form>-->
						<?php  echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
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