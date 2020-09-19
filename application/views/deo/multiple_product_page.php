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
            <form class="form-horizontal" method="POST" id="form" action="<?php echo site_url("deo/add_multiple_product");?>">
              
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
                <label class="col-lg-3 form-control-label">Selling Price</label>
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
	
	$(document).ready(function(){
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
			url: "<?php echo site_url("deo/get_product_cost");?>",
			type: "POST",
			data: {product_id:product_id},
			success: ajax_success,
			});
		});

		$("#form").submit(function(){

			if($("#orderNo").val()==="" || $("#product").val()==="" || $("#quantity").val()==="" || $("#sell_pro").val()==="")
			{
				if($("#orderNo").val()==="")
      			{
        			$("#order_msg").html("Please enter order number"); 
      			}
      
				if($("#sell_pro").val()==="")
			    {
			       $("#sell_pro_msg").html("Please enter selling price");  
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
	});
</script>