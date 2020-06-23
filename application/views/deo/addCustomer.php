
<?php 
  
  require_once("include/header.php");
  
?>
<script type="text/javascript">
  $(document).ready(function(){
   
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

   /* $("#p_method").change(function(){
      
      var p_method= $("#p_method").val();
      
      if(p_method=="pay pal" || p_method=="cash app" || p_method=="vemo" || p_method=="zelle")
      {
        $("#agent").prop("disabled", false);
      }
    });

    $("#p_method").change(function(){
      
      var p_method= $("#p_method").val();
      
      if(p_method=="bank" || p_method=="cradit card")
      {
        $("#agent").prop("disabled", true);
        $("#agent").val("");
      }
    });

    $("#p_method").change(function(){
      
      var p_method= $("#p_method").val();
      
      if(p_method=="cradit card")
      {
        $("#cardType").prop("disabled", false);
        $("#c_number").prop("disabled", false);
        $("#cvv_code").prop("disabled", false);
        $("#ex_date").prop("disabled", false);
      }
    });

    $("#p_method").change(function(){
      
      var p_method= $("#p_method").val();
      
      if(p_method=="bank" || p_method=="pay pal" || p_method=="cash app" || p_method=="vemo" || p_method=="zelle")
      {
        $("#cardType").prop("disabled", true);
        $("#c_number").prop("disabled", true);
        $("#cvv_code").prop("disabled", true);
        $("#ex_date").prop("disabled", true);
      }
    });*/
    $("form").submit(function(event){
      var fname               =$("#firstname").val()
      var lname               =$("#lastname").val()
      var email               =$("#email").val()
      var p_number            =$("#p_number").val()
      var country             =$("#country").val()
      var state               =$("#select_state").val()
      var postalcode          =$("#postalcode").val()
      var p_method            =$("#p_method").val()    
     
       
      /*if(fname && lname && email && p_number && country && state && address && postalcode && p_method)
      {
        return true;
      }
      else
      {
        $("#fname_msg").html("Please enter first name");
        $("#lname_msg").html("Please enter last name");
        $("#email_msg").html("Please enter email");
        $("#p_number_msg").html("Please enter phone number");
        $("#country_msg").html("Please select country");
        $("#state_msg").html("Please select state");
        $("#address_msg").html("Please enter address");
        $("#p_code_msg").html("Please enter postal code");
        $("#p_method_msg").html("Please enter Payment Method");

        return false;
      }*/

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

   /* $("#opt-02").click(function()
    {  
      $("#cardType").prop("disabled", false);
      $("#c_number").prop("disabled", false);
      $("#cvv_code").prop("disabled", false);
      $("#ex_date").prop("disabled", false);
    });
    $("#opt-01").click(function()
    {  
      $("#cardType").prop("disabled", true);
      $("#c_number").prop("disabled", true);
      $("#cvv_code").prop("disabled", true);
      $("#ex_date").prop("disabled", true);
    });
    $("#opt-03").click(function()
    {  
      $("#cardType").prop("disabled", true);
      $("#c_number").prop("disabled", true);
      $("#cvv_code").prop("disabled", true);
      $("#ex_date").prop("disabled", true);
    });*/
  });   
</script>

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
            <form class="form-horizontal" method="POST" action="<?php echo site_url("deo/add_customer");?>">
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">First Name</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="firstName" id="firstname" placeholder="Enter Your First Name">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="fname_msg" style="display: none;"></p>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Last Name</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="lastName" id="lastname" placeholder="Enter Your Last Name">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="lname_msg" style="display: none;"></p>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Email</label>
                <div class="col-lg-9">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email">
                  
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="email_msg" style="display: none;"></p>
                </div>     
              </div>

              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Phone Number</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="phoneNumber" id="p_number" placeholder="Enter Your Phone Number">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="p_number_msg" style="display: none;"></p>
                </div>
              </div>
              
               <div class="form-group row mb-5">
                <label class="col-lg-3 form-control-label">Country</label>
                <div class="col-lg-9 select mb-3">
                  <select class="custom-select form-control" name="country_id" id="country">
                    <option value="">Select Here</option>
                    <?php
                      foreach ($countries as $key => $country) {
                        ?>
                          <option value="<?php echo $country['country_id'];?>"><?php echo strtoupper($country['country_name']);?></option> 
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
                  <select class="custom-select form-control" name="state_id" id="select_state">
                    <option value="">Select Here</option>
                  </select>
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="state_msg" style="display: none;"></p>
                </div>
              </div>
             
               <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Address</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="address" id="address">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="address_msg" style="display: none;"></p>
                </div>
              </div>

              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Postal Code</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="postalCode" id="postalcode">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="p_code_msg" style="display: none;"></p>
                </div>
              </div>

              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Customer Notes</label>
                <div class="col-lg-9">
                  <textarea class="form-control" name="customer_notes"></textarea>
                </div>
              </div>

             
              </div><!--
              <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4>Card And Details</h4>
              </div>
              <div class="widget-body" id="cards">
                 <div class="form-group row d-flex align-items-center mb-5">
                  <label class="col-lg-3 form-control-label">Card Type</label>
                  <div class="col-lg-9">
                    <select class="custom-select form-control" name="cardType" id="cardType" disabled="true">
                      <option>Select Here</option>
                      <option value="1">Visa</option>
                      <option value="2">Master Card</option>
                       <option value="3">Discover</option>

                    </select>
                  </div>
                </div>
                <div class="form-group row d-flex align-items-center mb-5">
                  <label class="col-lg-3 form-control-label">Card Number</label>
                  <div class="col-lg-9">
                    <input type="text" class="form-control" name="cardNumber" id="c_number" placeholder="Enter Your Card Number" disabled="true">
                    <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="c_num_msg" style="display: none;"></p>
                  </div>
                </div>
                <div class="form-group row d-flex align-items-center mb-5">
                  <label class="col-lg-3 form-control-label">CVV Code</label>
                  <div class="col-lg-9">
                    <input type="text" class="form-control" name="cvvCode" id="cvv_code" placeholder="Enter Your CVV Code" disabled="true">
                    <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="cvv_code_msg" style="display: none;"></p>
                  </div>
                </div>
                <div class="form-group row d-flex align-items-center mb-5">
                  <label class="col-lg-3 form-control-label">Expiry Date</label>
                  <div class="col-lg-9">
                    <input type="text" class="form-control" name="expiryDate" id="ex_date" placeholder="Enter expiry Date like mm/dd" disabled="true">
                     <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="date_msg" style="display: none;"></p>
                  </div>
                </div>
              </div>-->
             
                <div class="text-center">
                  <button type="submit" class="btn btn-primary ripple mr-1 mb-2">Add</button>
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
        url: "<?php echo site_url("deo/checkEmail"); ?>",
        type: "POST",
        data: {email:email},
        success: ajax_success,
      });
    });

    $("#country").change(function(){

      var country_id = $("#country").val();
      
      function ajax_success(responseText, statusText, XMLHttpRequest)
      {
        if(statusText == "success" && XMLHttpRequest.status == 200 && XMLHttpRequest.statusText == "OK")
        {
          if(responseText)
          {
            $("#select_state").html(responseText);
          }
        }
      }

      $.ajax({
        url: "<?php echo site_url("deo/getStates"); ?>",
        type: "POST",
        data: {country_id:country_id},
        success: ajax_success,
      });  
    });

    $("#c_number").keyup(function(){

      var c_number = $("#c_number").val();  

      if(!$.isNumeric(c_number)&& c_number!="")
      {
        $("#c_num_msg").html("Please enter only number");  
      }
      else if(c_number=="")
      {
        $("#c_num_msg").html("");
      }
      else
      {
        $("#c_num_msg").html("");
      }
    });

    $("#cvv_code").keyup(function(){

      var cvv_code = $("#cvv_code").val();  

      if(!$.isNumeric(cvv_code)&& cvv_code!="")
      {
        $("#cvv_code_msg").html("Please enter only number");  
      }
      else if(cvv_code=="")
      {
        $("#cvv_code_msg").html("");
      }
      else
      {
        $("#cvv_code_msg").html("");
      }
    });

    $("#ex_date").keyup(function(){
      
      var ex_date = $("#ex_date").val();

      var patt2 =/(0[1-9]\/2\d+|1[0-2]\/[2-9]{0,2})/;
      
      var result = ex_date.match(patt2);

      if(result)
      {
       
        $("#date_msg").html("");
      }
      else if(ex_date=="")
      {
        $("#date_msg").html("");
      }
      else
      {
        $("#date_msg").html("Please enter valid formate date 02/25");
      }
    });
  });
</script>