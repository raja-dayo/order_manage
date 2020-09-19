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
            <form class="form-horizontal" method="POST" id="form" action="<?php echo site_url("admin/order_update_product");?>">
              
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Order No</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="orderNo" id="orderNo" value="<?php echo $_REQUEST['orderNo'];?>">
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
                            <option value="<?php echo $product['id']?>"<?=$pro[0]['id']==$product['id'] ?'selected="selected"' : '';?>><?php echo $product['product']?></option>
                         
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
                  <input type="text" class="form-control" name="pro_cost" id="pro_cost" value="<?php echo $_REQUEST['product_price'];?>">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="pro_cost_msg" style="display: none;"></p>
                </div>
              </div>
            
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Quantity</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="quantity" id="quantity" value="<?php echo $_REQUEST['product_qun'];?>">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="quantity_msg" style="display: none;"></p>
                </div>
              </div>
             
                <div class="text-center">
                  <input type="hidden" name="od_id" value="<?php echo $_REQUEST['od_id'];?>">
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

			$.ajax({
			    url: "<?php echo site_url("admin/get_product_cost");?>",
			    type: "POST",
			    data: {product_id:product_id},
			    success:function(responce)
                {
                    var data =$.parseJSON(responce);

                    $.each(data, function(index, value){

                        $("#pro_cost").val(value.prize);
          
                    });


                }
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