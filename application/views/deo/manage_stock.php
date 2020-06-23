
<?php 
  
  require_once("include/header.php");
  
?>
	<script type="text/javascript">
		// form validation
		$(document).ready(function(event){

			$('#form').submit(function() {
				var quantity= $("#quantity").val();
		        if(isNaN(Number(quantity)))
		        {
		        	$("#quantity_msg").html("Please enter only number");

		          	return false;
		        }
		        
		    	if($("#product").val()==="" || $("#quantity").val()==="")
		      	{
		      		if($("#product").val()==="")
		        	{
		          		$("#product_msg").html("Please Select Product");  
		        	}
		        	if($("#quantity").val()==="")
		        	{
			          	$("#quantity_msg").html("Please Enter Product Quantity");   
		        	}
		      
		        	return false;
		      	}
		      	else
		      	{
		      		return true;
		      	}
    		});
    		$("#product").click(function(){
      			$("#product_msg").html("");
    		});
    		$("#quantity").keyup(function(){
      			$("#quantity_msg").html("");
    		});
    		$("#quantity").keyup(function(){
    			var quantity = $("#quantity").val();
    			if(isNaN(Number(quantity)))
    			{
      				$("#quantity_msg").html("Please enter only number");

      				//return false;
    			}
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
            <h4>Manage Stock</h4>
          </div>
          <div class="widget-body">
            <form class="needs-validation" novalidate id="form" onsubmit="return myForm()" method="post" action="<?php echo site_url("deo/save_stock");?>">
              
               
             
               
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Product <span style="color: red;">*</span></label>
                <div class="col-lg-5">
                  <div class="select">
                    <select class="custom-select form-control" name="product" id="product"  required>
                      <option value="">Select Here</option>
                      <?php
                        foreach ($products as $key => $product) {
                          ?>
                            <option value="<?php echo $product['id'];?>"><?php echo strtoupper($product['product']);?></option>
                          <?php
                        }
                      ?>
                    </select>
                    <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="product_msg" style="display: none;"></p>
                    <div class="invalid-feedback">
                      Please select an option
                    </div>
                  </div>
                </div>
              </div>
            	<div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Quantity<span style="color: red;">*</span></label>
                <div class="col-lg-5">
                  <input type="text" class="form-control" placeholder="Enter Product Quantity" id="quantity" name="quantity">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="quantity_msg" style="display: none;"></p>
                </div>
              </div>
              <div class="text-center">
                <button class="btn btn-gradient-01" type="submit" id="ok">Save</button>
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