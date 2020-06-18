
<?php 
  
  require_once("include/header.php");
  
?>
 
<script type="text/javascript">
 
    

      $(document).ready(function(event) { 
        $('#form').submit(function() {
          if($("#name").val()==="" || $("#lname").val()==="" || $("#number").val()==="" || $("#site").val()==="" || $("#country").val()==="" || $("#email").val()==="")
          {
            if($("#name").val()==="")
            {
              $("#name_msg").html("Please Enter Your Name");  
            }
            if($("#lname").val()==="")
            {
              $("#lname_msg").html("Please Enter Your Last Name");   
            }
            if($("#email").val()==="")
            {
              $("#email_msg").html("Please Enter Your Email");   
            }
            if($("#number").val()==="")
            {
              $("#number_msg").html("Please Enter Your Number");  
            }
            if($("#country").val()==="")
            {
              $("#country_msg").html("Please Enter Your Country");   
            }

            if($("#site").val()==="")
            {
              $("#site_msg").html("Please Enter Your Site");   
            }
            return false;
          }
        });

        $("#name").keyup(function(){
          $("#name_msg").html("");
        });
         
        $("#lname").keyup(function(){
          $("#lname_msg").html("");
        });

        $("#email").keyup(function(){
          $("#email_msg").html("");
        });
         
        $("#number").keyup(function(){
          $("#number_msg").html("");
        });
         
        $("#country").click(function(){
          $("#country_msg").html("");
        });
         
        $("#site").keyup(function(){
          $("#site_msg").html("");
        });
      });
      
</script>


<div class="content-inner">
  <div class="container-fluid">
    <div class="row flex-row">
      <div class="col-xl-12">
        <?php
          if($this->session->flashdata('msg'))
          {
            ?>
            <div class="row">
              <div class="col-sm-4"></div>
              <div class="col-sm-4">
                <div class="alert alert-success alert-dissmissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                  <?php echo $this->session->flashdata('msg');?>
                </div>
              </div>
            </div>
            <?php
          }
        ?>
        <div class="widget has-shadow">
          <div class="widget-header bordered no-actions d-flex align-items-center">
            <h4>Add Vendor</h4>
          </div>
          <div class="widget-body">
            <form class="needs-validation" novalidate id="form" onsubmit="return myForm()" method="post" action="<?php echo site_url("admin/addVender");?>">
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Name *</label>
                <div class="col-lg-5">
                  <input type="text" class="form-control" placeholder="Enter your name" id="name" name="name">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="name_msg" style="display: none;"></p>
                </div>
              </div>
               <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Last Name *</label>
                <div class="col-lg-5">
                  <input type="text" class="form-control" placeholder="Enter your name" id="lname" name="lname">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="lname_msg" style="display: none;"></p>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Email Address *</label>
                <div class="col-lg-5">
                  <div class="input-group">
                    <input type="email" class="form-control" placeholder="Enter your email" id="email" name="email" required>
                    
                    <span class="input-group-addon addon-orange">.com</span>
                    <div class="invalid-feedback">
                      Please enter a valid email
                    </div>
                  </div>
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="email_msg" style="display: none;"></p>
                </div>
              </div>
             <!-- <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Password *</label>
                <div class="col-lg-5">
                  <input type="password" class="form-control" placeholder="Password" required>
                  <div class="invalid-feedback">
                    Please enter a valid password
                  </div>
                </div>
              </div>-->
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Phone Number *</label>
                <div class="col-lg-5">
                  <div class="input-group">
                    <span class="input-group-addon addon-primary">
                      <i class="la la-phone"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Phone number" id="number" name="number">
                  </div>
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="number_msg" style="display: none;"></p>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Country *</label>
                <div class="col-lg-5">
                  <div class="select">
                    <select class="custom-select form-control" id="country" name="country" required>
                      <option value="">Select an option</option>
                      <?php
                        foreach ($countries as $key => $country) {
                          ?>
                            <option value="<?php echo $country['country_id'];?>"><?php echo strtoupper($country['country_name']);?></option>
                          <?php
                        }
                      ?>
                    </select>
                    <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="country_msg" style="display: none;"></p>
                    <div class="invalid-feedback">
                      Please select an option
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Website *</label>
                <div class="col-lg-5">
                  <input type="url" class="form-control" id="site" name="site">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="site_msg" style="display: none;"></p>
                </div>
              </div>
              
              
             <!-- <div class="form-group row mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Radios *</label>
                <div class="col-lg-1">
                  <div class="custom-control custom-radio styled-radio mb-3">
                    <input class="custom-control-input" type="radio" name="options" id="opt-01" required>
                    <label class="custom-control-descfeedback" for="opt-01">Option 1</label>
                    <div class="invalid-feedback">
                      Toggle this custom radio
                    </div>
                  </div>
                </div>
                <div class="col-lg-1">
                  <div class="custom-control custom-radio styled-radio mb-3">
                    <input class="custom-control-input" type="radio" name="options" id="opt-02" required>
                    <label class="custom-control-descfeedback" for="opt-02">Option 2</label>
                    <div class="invalid-feedback">
                      Or toggle this other custom radio
                    </div>
                  </div>
                </div>
              </div>-->
              <div class="text-center">
                <button class="btn btn-gradient-01" type="submit" id="ok">Add</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



<?php

  require_once("include/footer.php");

?>