
<?php 
  
  require_once("include/header.php");
  
?>


<div class="content-inner">
	<div class="container-fluid">
    <div class="row">
      <div class="page-header">
        <div class="d-flex align-items-center">
          <h2 class="page-header-title">New Order</h2>
        </div>

        <div class="row">
          <div class="col-sm-12 col-md-3"></div>
          <div class="col-sm-12 col-md-3"></div>
          <div class="col-sm-12 col-md-3"></div>
          <div class="col-sm-12 col-md-3">
           
          </div>
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
            <h4>Order Form</h4>
          </div>
          <div class="widget-body">
            <form class="form-horizontal" method="POST" id="form" action="<?php echo site_url("vender/orderSave");?>">
                <div class="form-group row d-flex align-items-center mb-5">
                  <label class="col-lg-3 form-control-label">Customer</label>
                    <div class="col-lg-9">
                      <input type="text" class="form-control" name="customer" id="customer"
                        value="<?php
                            if(isset($_GET['customer_name']))
                            {
                              echo $_GET['customer_name'];
                            }
                            if($this->session->flashdata('alpha'))
                            {
                                echo $this->session->flashdata('alpha');
                            }
                         ?>">
                         <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="name_msg" style="display: none;"></p>
                         <div id="ajax_response"></div>
                    </div>
                
                </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Order No</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="orderNo" id="orderNo">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="order_msg" style="display: none;"></p>
                </div>
              </div>
           
              <div class="form-group row mb-5">
                <label class="col-lg-3 form-control-label">Product</label>
                <div class="col-lg-9 select mb-3">
                  <select class="custom-select form-control" name="product_id" id="product">
                    <option>Select Here</option>
                    <?php
                      foreach ($products as $key => $product) {
                        
                        ?>
                          <option value="<?php echo $product['id'];?>"><?php echo $product['product']; ?></option>
                        <?php
                      }
                    ?>
                  </select>
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="product_msg" style="display: none;"></p>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Product Cost</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="pro_cost" id="pro_cost" disabled="true">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="pro_cost_msg" style="display: none;"></p>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Selling Prise</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="sell_pro" id="sell_pro">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="sell_pro_msg" style="display: none;"></p>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Quantity</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="quantity" id="quantity">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="quantity_msg" style="display: none;"></p>
                </div>
              </div>
              <div class="form-group row mb-5">
                <label class="col-lg-3 form-control-label">Payment Method</label>
                <div class="col-lg-9 select mb-3">
                  <select class="custom-select form-control" name="p_method" id="p_method">
                    <option value="">Select Here</option>
                    <option value="bank">Bank</option>
                    <option value="cradit card">Cradit Card</option>
                    <option value="pay pal">Pay Pal</option>
                    <option value="cash app">Cash App</option>
                    <option value="vemo">Vemo</option>
                    <option value="zell">Zelle</option>
                  </select>
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="p_method_msg" style="display: none;"></p>
                </div>
              </div>

              <div class="form-group row mb-5">
                <label class="col-lg-3 form-control-label">Agent</label>
                <div class="col-lg-9 select mb-3">
                  <select class="custom-select form-control" name="agent" id="agent" disabled="true">
                    <option value="">Select Here</option>
                     <?php
                      foreach ($agents as $key => $agent) {
                        
                        ?>
                          <option value="<?php echo $agent['a_id'];?>"><?php echo $agent['a_first_name']; ?></option>
                        <?php
                      }
                    ?>
                  </select>
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="agent_msg" style="display: none;"></p>
                </div>
              </div>
              <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4>Card And Details</h4>
              </div>
              <div class="widget-body" id="cards">
                 <div class="form-group row d-flex align-items-center mb-5">
                  <label class="col-lg-3 form-control-label">Card Type</label>
                  <div class="col-lg-9">
                    <select class="custom-select form-control" name="cardType" id="cardType" disabled="true">
                      <option value="">Select Here</option>
                      <option value="visa">Visa</option>
                      <option value="master card">Master Card</option>
                       <option value="discover">Discover</option>

                    </select>
                    <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="cardType_msg" style="display: none;"></p>
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
              <input type="hidden" name="customer_id" value="<?php
                if(isset($_GET['customer_id']))
                {
                  echo $_GET['customer_id'];
                }
               
              ?>">
              <input type="hidden" name="hidden_customer_id" value="<?php
                if($this->session->flashdata('bita'))
                {
                  echo $this->session->flashdata('bita');
                }
              ?>">
              <div class="text-center">
                <button type="submit" class="btn btn-primary ripple mr-1 mb-2">Save</button>
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
  
  $("#customer").keyup(function(){

    var pattern= $("#customer").val();

    function ajax_success(responseText, statusText, XMLHttpRequest)
    {
      if(statusText == "success" && XMLHttpRequest.status == 200 && XMLHttpRequest.statusText == "OK")
      {
        //alert(responseText);

        $("#ajax_response").html(responseText);
      }
    }

    $.ajax({
      url: "<?php echo site_url("vender/search");?>",
      type: "POST",
      data: {pattern:pattern},
      success: ajax_success,
    });

  });

  $("#orderNo").keyup(function(){
    var orderNo = $("#orderNo").val();
  });

  $("#form").submit(function(){

    var abc= $("#orderNo").val();
    if(isNaN(Number(abc)))
    {
      $("#order_msg").html("Please enter only number");

      return false;
    }
    
    var payment_method =$("#p_method").val();
    if(payment_method=="cradit card")
    {
      if($("#cardType").val()==="" || $("#c_number").val()==="" || $("#cvv_code").val()==="" || $("#ex_date").val()==="")
      {
        if($("#cardType").val()==="")
        {
          $("#cardType_msg").html("Please enter card type");  
        }
        if($("#c_number").val()==="")
        {
          $("#c_num_msg").html("Please enter card number");  
        }    
        if($("#cvv_code").val()==="")
        {
          $("#cvv_code_msg").html("Please enter cvv code");  
        }
        if($("#ex_date").val()==="")
        {
          $("#date_msg").html("Please enter card expirey date");  
        }

        return false;
      }
    }
    else if(payment_method=="cash app" || payment_method=="pay pal" || payment_method=="zelle" || payment_method=="vemo")
    {
     if($("#agent").val()==="")
      {
        $("#agent_msg").html("Please enter agent name");  
        return false;
      }
      else
      {
        return true;
      }
      
    }
    else if($("#customer").val()==="" || $("#orderNo").val()==="" || $("#product").val()==="" || $("#quantity").val()==="" || $("#sell_pro").val()==="" || $("#p_method").val()==="")
    {
      if($("#sell_pro").val()==="")
      {
        $("#sell_pro_msg").html("Please enter selling prise");  
      }
      if ($("#p_method").val()==="")
      {
        $("#p_method_msg").html("Please enter payment method");  
      }
      if($("#customer").val()==="")
      {
        $("#name_msg").html("Please enter your name");  
      }
      if($("#orderNo").val()==="")
      {
        var abc= $("#orderNo").val();
        //alert(abc);
        $("#order_msg").html("Please enter order number"); 
        
      }
      else
      {
        var abc= $("#orderNo").val();
        if(isNaN(Number(abc)))
        {
          $("#order_msg").html("Please enter only number");

          return false;
        }
      }
      if($("#product").val()==="Select Here")
      {
        $("#product_msg").html("Please enter product"); 
      }
      if($("#quantity").val()==="")
      {
        $("#quantity_msg").html("Please enter quantity"); 
      }
      
      return false;
    }
    else
    {
      return true;
    }   
  });
  
  $("#customer").keyup(function(){
    $("#name_msg").html("");
  });
   $("#orderNo").keyup(function(){
    $("#order_msg").html("");
  });
    $("#product").keyup(function(){
    $("#product_msg").html("");
  });
     $("#quantity").keyup(function(){
    $("#quantity_msg").html("");
  });

  $("#product").change(function(){
    
    var product_id= $("#product").val();
    
    function ajax_success(responseText, statusText, XMLHttpRequest)
    {
      if(statusText == "success" && XMLHttpRequest.status == 200 && XMLHttpRequest.statusText == "OK")
      {
        $("#pro_cost").val(responseText+'$');
      }
    }

    $.ajax({
      url: "<?php echo site_url("vender/get_product_cost");?>",
      type: "POST",
      data: {product_id:product_id},
      success: ajax_success,
    });
  });

  //form pament method validate
  $("#p_method").change(function(){
    
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
      
      $("#cardType_msg").html("");
      $("#cvv_code_msg").html("");
      $("#c_num_msg").html("");
      $("#date_msg").html("");
    }
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
</script>