
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
    <div class="row flex-row">
      <div class="col-12">
        <div class="widget has-shadow">
          <div class="widget-header bordered no-actions d-flex align-items-center">
            <h4>Add Product Form</h4>
          </div>
          <div class="widget-body">
            <?php  echo form_open_multipart("admin/updateProduct", 'class="form"'); ?>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Product Name</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="productName" id="product" value="<?php echo $product[0]['product'];?>">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="product_msg" style="display: none;"></p>
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
                        <option value="<?php echo $category['id'];?>"<?=$product[0]['category_id']==$category['id'] ?'selected="selected"' : '';?>><?php echo $category['name']; ?></option>
                      <?php
                    }
                  ?>
                  </select>
                </div>
              </div>
               <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Image</label>
                <div class="col-lg-9">
                  <input type="file" class="form-control" name="image" id="image_file">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="image_msg" style="display: none;"></p>
                </div>

              </div>
              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                <img src="<?php echo base_url()."assets/img/".$product[0]['image'];?>" style="height: 150px; width: 250px;" alt="wait">
              </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Description</label>
                <div class="col-lg-9">
                  <textarea class="form-control"  name="productDescription"><?php echo $product[0]['description']?></textarea>
                </div>
              </div>
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Unit Price</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="prize" id="prise" value="<?php echo $product[0]['prize'];?>">
                  <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="prise_msg" style="display: none;"></p>
                </div>
              </div>
             
              <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-2">
                  <input type="hidden" name="product_id" value="<?php echo $product[0]['id'];?>">
                   <input type="hidden" name="product_img" value="<?php echo $product[0]['image'];?>">
                  <button type="Submit" class="btn btn-gradient-01">UPDATE</button>
                  
                </div>
                <div class="col-sm-2"><button type="Submit" class="btn btn-gradient-01" name="cancel">CANCEL</button></div>
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
      if($("#product").val()==="" || $("#prise").val()==="")
      {
        if($("#product").val()==="")
        {
          $("#product_msg").html("Please Enter Product");  
        }
        if($("#prise").val()==="")
        {
          $("#prise_msg").html("Please Enter product Prise");  
        }
        return false;
      }
      
    });
  });
</script>
<?php

  require_once("include/footer.php");

?>