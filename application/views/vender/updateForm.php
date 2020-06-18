
<?php 
  
  require_once("include/header.php");
  
?>
<body onload="myFunction()"> 
<div class="content-inner">
	<div class="container-fluid">
    <div class="row">
      <div class="page-header">
        <div class="d-flex align-items-center">
          <h2 class="page-header-title">Add New Customer</h2>
        </div>
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
      </div>
    </div>

    <div class="row flex-row">
      <div class="col-12">
        <div class="widget has-shadow">
          <div class="widget-header bordered no-actions d-flex align-items-center">
            <h4>Add Customer Form</h4>
          </div>
          <div class="widget-body">
            <form class="form-horizontal" method="POST" action="<?php echo site_url("vender/updateCustomer");?>">
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">First Name</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="firstName" id="firstname" placeholder="Enter Your First Name" value="<?php echo $customer[0]['firstName']; ?>">
                   <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="fname_msg" style="display: none;"></p>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Last Name</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="lastName" id="lastname" placeholder="Enter Your Last Name" value="<?php echo $customer[0]['lastName']; ?>">
                   <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="lastname_msg" style="display: none;"></p>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Email</label>
                <div class="col-lg-9">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email" value="<?php echo $customer[0]['email']; ?>">
                  
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="email_msg" style="display: none;"></p>
                </div>     
              </div>

              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Phone Number</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="phoneNumber" id="p_number" placeholder="Enter Your Phone Number" value="<?php echo $customer[0]['number']; ?>">
                   <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="p_number_msg" style="display: none;"></p>
                </div>
              </div>
              
               <div class="form-group row mb-5">
                <label class="col-lg-3 form-control-label">Country</label>
                <div class="col-lg-9 select mb-3">
                  <select class="custom-select form-control" name="country_id" id="country">
                    <option>Select Here</option>
                    <?php
                      foreach ($countries as $key => $country) {
                        ?>
                           


                          <option value="<?php echo $country['country_id'];?>"<?=$customer[0]['country_id']==$country['country_id'] ? ' selected="selected"' : '';?>><?php echo strtoupper($country['country_name']);?></option>
                        <?php
                      }
                    ?>
                  </select>
                   <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="country_msg" style="display: none;"></p>
                </div>
              </div>

               <div class="form-group row mb-5">
                <label class="col-lg-3 form-control-label">State</label>
                <div class="col-lg-9 select mb-3">
                  <select class="custom-select form-control" name="state_id" id="select_states">
                    <option value="<?php echo $states[0]['state_id'];?>"><?php echo $states[0]['state_name'];?></option>
                  </select>
                   <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="state_msg" style="display: none;"></p>
                </div>
              </div>
             
               <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Address</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="address" id="address" value="<?php echo $customer[0]['address']; ?>">
                   <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="address_msg" style="display: none;"></p>
                </div>
              </div>

              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Postal Code</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="postalCode" id="postalcode" value="<?php echo $customer[0]['postalCode']; ?>">
                   <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="p_code_msg" style="display: none;"></p>
                </div>
              </div>

              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Customer Notes</label>
                <div class="col-lg-9">
                  <textarea class="form-control" name="customer_notes">
                    <?php echo $customer[0]['customer_notes']; ?>
                  </textarea>
                </div>
              </div>
              
               
            
                  <input type="hidden" name="customer_id" value="<?php echo $_REQUEST['customerId']; ?>">
                <div class="text-center">
                  <button type="submit" class="btn btn-primary ripple mr-1 mb-2" name="cancel">Cancel</a>
                  <button type="submit" class="btn btn-primary ripple mr-1 mb-2">Update</button>
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
<script type="text/javascript">
    function myFunction()
    {

      var country_id = $("#country").val();

      function ajax_success(responseText, statusText, XMLHttpRequest)
      {
        if(statusText == "success" && XMLHttpRequest.status == 200 && XMLHttpRequest.statusText == "OK")
        {
          //alert(responseText);
          if(responseText)
          {
            $("#select_state").html(responseText);
          }
        }
      }

      $.ajax({
        url: "<?php echo site_url("vender/getStates"); ?>",
        type: "POST",
        data: {country_id:country_id},
        success: ajax_success,
      });
    }

  $(document).ready(function()
  {
    $("#email").blur(function(){

      var email = $("#email").val();

      function ajax_success(responseText, statusText, XMLHttpRequest)
      {
        if(statusText == "success" && XMLHttpRequest.status == 200 && XMLHttpRequest.statusText == "OK")
        {
          if(responseText!="")
          {
            $("#email_msg").html(responseText);
            
            $("#email_msg").css({"color":"red"});

            $("#email").focus();

            $("#email").val("");
          }
          else
          {
            $("#email_msg").html("");
          }
        }
      }

      $.ajax({
        url: "<?php echo site_url("vender/checkEmail"); ?>",
        type: "POST",
        data: {email:email},
        success: ajax_success,
      });
    });

    $("#country").blur(function(){

      var country_id = $("#country").val();
      
      function ajax_success(responseText, statusText, XMLHttpRequest)
      {
        if(statusText == "success" && XMLHttpRequest.status == 200 && XMLHttpRequest.statusText == "OK")
        {
          if(responseText)
          {
            $("#select_states").html(responseText);
          }
        }
      }

      $.ajax({
        url: "<?php echo site_url("vender/getStates"); ?>",
        type: "POST",
        data: {country_id:country_id},
        success: ajax_success,
      });  
    });

     $("#firstname").keyup(function(){
      $("#fname_msg").html("");
      var fname = $("#firstname").val();
        
      if($.isNumeric(fname))
      {
        $("#fname_msg").html("Please Enter only chracters");
      }
      else
      {
        $("#fname_msg").html("");
      }
    });

    $("#lastname").keyup(function(){
      $("#lname_msg").html("");
      var lname = $("#lastname").val();
      if($.isNumeric(lname))
      {
        $("#lname_msg").html("Please Enter only chracters");
      }
      else
      {
        $("#lname_msg").html("");
      }
    });

    $("#email").keyup(function(){
      $("#email_msg").html("");
    });

    $("#p_number").keyup(function(){
      
      $("#p_number_msg").html("");
      
      var number = $("#p_number").val();

      if($.isNumeric(number) || number=="")
      {
        $("#p_number_msg").html("");
      }
      else
      {
        $("#p_number_msg").html("Please Enter only numbers");
      }
    });

    $("#country").click(function(){
      $("#country_msg").html("");
    });

    $("#select_state").click(function(){
      $("#state_msg").html("");
    });

     $("#address").keyup(function(){
      $("#address_msg").html("");
    });

    $("#postalcode").keyup(function(){
      $("#p_code_msg").html("");
    });

    
    $("form").submit(function(event){
      if($("#firstname").val()==="" || $("#lastname").val()==="" || $("#email").val()==="" || $("#p_number").val()===""|| $("#country").val()==="" || $("#select_state").val()==="" || $("#postalcode").val()==="" || $("#address").val()==="")
        {
          if($("#firstname").val()==="")
          {
            $("#fname_msg").html("Please enter your first name");  
          }
          if($("#lastname").val()==="")
          {
            $("#lname_msg").html("Please enter your last name");  
          }    
          if($("#email").val()==="")
          {
            $("#email_msg").html("Please enter your email");  
          }
          if($("#p_number").val()==="")
          {
            $("#p_number_msg").html("Please enter your phone number");  
          }
          if($("#country").val()==="")
          {
            $("#country_msg").html("Please enter your country name");  
          }    
          if($("#select_state").val()==="")
          {
            $("#state_msg").html("Please select your state");  
          }
          if($("#postalcode").val()==="")
          {
            $("#p_code_msg").html("Please enter your postal code");  
          }
          if($("#address").val()==="")
          {
            $("#address_msg").html("Please enter your address");  
          }
          return false;
        }
        else
        {
          return true;
        }
      });
  });
</script>


