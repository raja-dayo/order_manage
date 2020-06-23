
<?php 
  
  require_once("include/header.php");
  
?>
 
<script type="text/javascript">
  
  $(document).ready(function(event) { 
    
    // ajaxr responce for get states
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
        url: "<?php echo site_url("vender/getStates"); ?>",
        type: "POST",
        data: {country_id:country_id},
        success: ajax_success,
      });  
    });

    $('#form').submit(function() {
      if($("#name").val()==="" || $("#lname").val()==="" || $("#number").val()==="" || $("#select_state").val()==="" || $("#country").val()==="" || $("#agent_per").val()==="")
      {
        if($("#name").val()==="")
        {
          $("#name_msg").html("Please Enter Your Name");  
        }
        if($("#lname").val()==="")
        {
          $("#lname_msg").html("Please Enter Your Last Name");   
        }
        if($("#agent_per").val()==="")
        {
          $("#agent_per_msg").html("Please Enter Agent Percentage");   
        }
        if($("#number").val()==="")
        {
          $("#number_msg").html("Please Enter Your Number");  
        }
        if($("#country").val()==="")
        {
          $("#country_msg").html("Please Enter Your Country");   
        }

        if($("#select_state").val()==="")
        {
          $("#state_msg").html("Please Enter Your State");   
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

    $("#agent_per").keyup(function(){
      $("#agent_per_msg").html("");
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
            <h4>Add Agent</h4>
          </div>
          <div class="widget-body">
            <form class="needs-validation" novalidate id="form" onsubmit="return myForm()" method="post" action="<?php echo site_url("vender/add_agent");?>">
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Name<span style="color: red;">*</span></label>
                <div class="col-lg-5">
                  <input type="text" class="form-control" placeholder="Enter your name" id="name" name="name">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="name_msg" style="display: none;"></p>
                </div>
              </div>
               <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Last Name <span style="color: red;">*</span></label>
                <div class="col-lg-5">
                  <input type="text" class="form-control" placeholder="Enter your name" id="lname" name="lname">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="lname_msg" style="display: none;"></p>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Phone Number<span style="color: red;">*</span></label>
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
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Percentage<span style="color: red;">*</span></label>
                <div class="col-lg-5">
                  <input type="text" class="form-control" placeholder="Enter agent percentage" id="agent_per" name="agent_per">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="agent_per_msg" style="display: none;"></p>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Country <span style="color: red;">*</span></label>
                <div class="col-lg-5">
                  <div class="select">
                    <select class="custom-select form-control" name="country_id" id="country"  required>
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
                    <div class="invalid-feedback">
                      Please select an option
                    </div>
                  </div>
                </div>
              </div>
             <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">State <span style="color: red;">*</span></label>
                <div class="col-lg-5">
                  <div class="select">
                    <select class="custom-select form-control"  name="state_id" id="select_state"required>
                      <option value="">Select Here</option>
                      
                    </select>
                    <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="state_msg" style="display: none;"></p>
                    <div class="invalid-feedback">
                      Please select an option
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button class="btn btn-gradient-01" type="submit" id="ok">Add Agent</button>
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