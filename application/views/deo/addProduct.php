
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
            <?php  echo form_open_multipart("deo/insertProduct", 'class="form"'); ?>
            <!--<form class="form-horizontal" enctype="" method="POST" action="<?php //echo site_url("admin/insertProduct");?>">-->  
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Product Name <span style="color: red;">*</span></label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="productName" id="product" value="<?php echo set_value('productName'); ?>">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="product_msg" style="display: none;"></p>
                  <?php echo form_error('productName','<p style="color:red;">','</p>'); ?>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Category</label>
                <div class="col-lg-9 select mb-3">
                  <select name="category_id" class="custom-select form-control">
                  <option>Select Here</option>
                  <?php
                    foreach ($categories as $key => $category) {
                      ?>
                        <option value="<?php echo $category['id'];?>"><?php echo $category['name']; ?></option>
                      <?php
                    }
                  ?>
                  </select>
                </div>
              </div>
               <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Image <span style="color: red;">*</span></label>
                <div class="col-lg-9">
                  <input type="file" class="form-control" name="image" id="image_file" value="<?php echo set_value('image'); ?>">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="image_msg" style="display: none;"></p>
                   <?php echo form_error('image','<p style="color:red;">','</p>'); ?>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Description</label>
                <div class="col-lg-9">
                  <textarea class="form-control" name="productDescription"></textarea>
                </div>
              </div>
              <!--<div class="form-group row mb-5">
              <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Currency <span style="color: red;">*</span></label>
              <div class="col-lg-1">
                <div class="custom-control custom-radio styled-radio mb-3">
                  <input class="custom-control-input" type="radio" name="currency[]" id="opt-01" value="usd">
                  <label class="custom-control-descfeedback" for="opt-01">USD</label>
                  <div class="invalid-feedback">Toggle this custom radio</div>
                </div>
              </div>
              <div class="col-lg-1">
                <div class="custom-control custom-radio styled-radio mb-3">
                  <input class="custom-control-input" type="radio" name="currency[]" id="opt-02" value="gbp">
                  <label class="custom-control-descfeedback" for="opt-02">GBP</label>
                  <div class="invalid-feedback">Or toggle this other custom radio</div>
                </div>
              </div>
            </div>-->
             <!-- <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Unit Price <span style="color: red;">*</span></label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="prize" id="prise" value="<?php echo set_value('prize'); ?>">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="prise_msg" style="display: none;"></p>
                  <?php //echo form_error('prize','<p style="color:red;">','</p>'); ?>
                </div>
              </div>-->
             
              <div class="row">
                <div class="col-sm-5"></div>
                <div class="col-sm-2">
                  <button type="Submit" class="btn btn-gradient-01">ADD</button>
                </div>
              </div>
            <!--</form>-->
            <?php  echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>


<script type="text/javascript">
  $(document).ready(function(){
    $(".form").submit(function(){
        //alert($("#image_file").val());
      if($("#product").val()==="" || $("#prise").val()==="" || $("#image_file").val()=="")
      {
        if($("#product").val()==="")
        {
          $("#product_msg").html("Please Enter Product");  
        }
        else
        {
          var abc= $("#product").val();
          if(!isNaN(Number(abc)))
          {
            $("#product_msg").html("Please enter only Caracter");
          }
        }
        if($("#prise").val()==="")
        {
          $("#prise_msg").html("Please Enter product Prise");  
        }
        else
        {
          var abc= $("#prise").val();
          if(isNaN(Number(abc)))
          {
            $("#prise_msg").html("Please enter only Number");
          }
        }
        if($("#image_file").val()=="")
        {
          $("#image_msg").html("Please Enter product image");  
        }
        return false;
      }
    });
    $("#product").keyup(function(){
      $("#product_msg").html("");
    });

    $("#prise").keyup(function(){
      $("#prise_msg").html("");
    });

    $("#image_file").click(function(){
      $("#image_msg").html("");
    });
  });
</script>
<?php

  require_once("include/footer.php");

?>