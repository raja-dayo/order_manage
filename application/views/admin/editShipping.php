
<?php 
  
  require_once("include/header.php");
  
?>
 
<div class="content-inner">
  <div class="container-fluid">
    <div class="row">
      <div class="page-header">
        <div class="d-flex align-items-center">
          <h2 class="page-header-title"></h2>
        </div>
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
         <p><?php //echo validation_errors("<p class='text-center' style='color:red;'>","</p>");?></p>
    <div class="row flex-row">
      <div class="col-12">
        <div class="widget has-shadow">
          <div class="widget-header bordered no-actions d-flex align-items-center">
            <h4>Add Product Form</h4>
          </div>
          <div class="widget-body">
            <?php  echo form_open_multipart("admin/updateShip", 'class="form"'); ?>
            <!--<form class="form-horizontal" enctype="" method="POST" action="<?php //echo site_url("admin/insertProduct");?>">-->  
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Shipping Name <span style="color: red;">*</span></label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="ship_name" id="ship_name" value="<?php echo $ship[0]['d_name']; ?>">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="product_msg" style="display: none;"></p>
                  <?php echo form_error('productName','<p style="color:red;">','</p>'); ?>
                </div>
              </div>
  
           
              <div class="form-group row mb-5">
              <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Currency <span style="color: red;">*</span></label>
              <div class="col-lg-1">
                <div class="custom-control custom-radio styled-radio mb-3">
                 

                  <input class="custom-control-input" type="radio" name="currency" id="opt-01" value="usd" <?php if ($ship[0]['d_currency'] == 'usd') echo 'checked="checked"'; ?> />


                  <label class="custom-control-descfeedback" for="opt-01">USD</label>
                  <div class="invalid-feedback">Toggle this custom radio</div>
                </div>
              </div>
              <div class="col-lg-1">
                <div class="custom-control custom-radio styled-radio mb-3">
                  
                  <input class="custom-control-input" type="radio" name="currency" id="opt-02" value="gbp" <?php if ($ship[0]['d_currency'] == 'gbp') echo 'checked="checked"'; ?> />
                  <label class="custom-control-descfeedback" for="opt-02">GBP</label>
                  <div class="invalid-feedback">Or toggle this other custom radio</div>
                </div>
              </div>
            </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Charge <span style="color: red;">*</span></label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="charge" id="charge" value="<?php echo $ship[0]['d_shipping_charges']; ?>">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="prise_msg" style="display: none;"></p>
                  <?php echo form_error('prize','<p style="color:red;">','</p>'); ?>
                </div>
              </div>
             
              <div class="row">
                <div class="col-sm-5"></div>
                <div class="col-sm-2">
                  <button type="Submit" class="btn btn-gradient-01">Update</button>
                </div>
              </div>
            <!--</form>-->
            <input type="hidden" name="id" value="<?php echo $ship[0]['id'];?>">
            <?php  echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>


<script type="text/javascript">
  $(document).ready(function(){
   
  });
</script>
<?php

  require_once("include/footer.php");

?>