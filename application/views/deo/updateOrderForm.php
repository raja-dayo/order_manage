
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
            <form class="form-horizontal" method="POST" action="<?php echo site_url("deo/orderUpdate");?>">
                <div class="form-group row d-flex align-items-center mb-5">
                  <label class="col-lg-3 form-control-label">Customer</label>
                    <div class="col-lg-9">
                      <input type="text" class="form-control" name="customer" id="customer" value="<?php echo $result[0]['firstName']." ".$result[0]['lastName']?>">
                        
                         <div id="ajax_response"></div>
                    </div>
                
                </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Order No</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="orderNo" value="<?php echo $result[0]['orderNo']?>">
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


                        <option value="<?php echo $product['id'];?>"<?=$result[0]['product_id']==$product['id'] ? ' selected="selected"' : '';?>><?php echo strtoupper($product['product']);?></option>

                        <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Product Cost</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="pro_cost" id="pro_cost" value="<?php echo $result[0]['prize'].'$';?>">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="pro_cost_msg" style="display: none;"></p>
                </div>
              </div>
             <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Selling Price</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="sell_pro" id="sell_pro" value="<?php echo $result[0]['sell_product_cost']?>">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="sell_pro_msg" style="display: none;"></p>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Quatity</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="quantity" value="<?php echo $result[0]['order_quantity']?>">
                </div>
              </div>
              <input type="hidden" name="order_id" value="<?php echo $result[0]['order_id']?>">
              <input type="hidden" name="customer_id" value="<?php echo $result[0]['customer_id']?>">
              <div class="text-center">
                <button type="submit" class="btn btn-primary ripple mr-1 mb-2">UPDATE</button>
                <button type="submit" class="btn btn-primary ripple mr-1 mb-2" name="cancel">CANCEL</button>
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
  
  /*$("#customer").keyup(function(){

    var pattern= $("#customer").val();

    //alert(pattern);

    function ajax_success(responseText, statusText, XMLHttpRequest)
    {
      if(statusText == "success" && XMLHttpRequest.status == 200 && XMLHttpRequest.statusText == "OK")
      {
        //alert(responseText);

        $("#ajax_response").html(responseText);
      }
    }

    $.ajax({
      url: "<?php //echo site_url("vender/search");?>",
      type: "POST",
      data: {pattern:pattern},
      success: ajax_success,
    });

    
  });*/
  $("#product").change(function(){
      
      var product_id= $("#product").val();
     
     //alert(product_id); 
    function ajax_success(responseText, statusText, XMLHttpRequest)
    {
      if(statusText == "success" && XMLHttpRequest.status == 200 && XMLHttpRequest.statusText == "OK")
      {
        $("#pro_cost").val(responseText+'$');
      }
    }

    $.ajax({
      url: "<?php echo site_url("deo/get_product_cost");?>",
      type: "POST",
      data: {product_id:product_id},
      success: ajax_success,
    });
      
    });
</script>