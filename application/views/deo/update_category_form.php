
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
            <h4>Add Category Form</h4>
          </div>
          <div class="widget-body">
            <?php  echo form_open_multipart("deo/updateCategory", 'class="form"'); ?>
            <!--<form class="form-horizontal" enctype="" method="POST" action="<?php //echo site_url("admin/insertProduct");?>">-->  
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Category Name</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="category" id="category" value="<?php echo $category[0]['name']?>">
                   <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="category_msg" style="display: none;"></p>
                </div>
              </div>
          
              <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Description</label>
                <div class="col-lg-9">
                  <textarea class="form-control" name="description"><?php echo $category[0]['description']?></textarea>
                </div>
              </div>
             
             
              <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-2">
                  <input type="hidden" name="id" value="<?php echo $category[0]['id']?>">
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
        if($("#category").val()==="")
        {
          $("#category_msg").html("Please Enter Category name");  
          return false;
        }else
        {
          var abc= $("#category").val();
          if(!isNaN(Number(abc)))
          {
            $("#category_msg").html("Please enter only Caracter");

            return false;
          }
        }
      });
       $("#category").keyup(function(){
          $("#category_msg").html("");
        });
    });
  </script>
<?php

  require_once("include/footer.php");

?>