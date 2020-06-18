<?php 
  
  require_once("include/header.php");
  
?>
<div class="content-inner">
	<div class="container-fluid">
    <div class="row">
      <div class="page-header">
        <div class="d-flex align-items-center">
          <h2 class="page-header-title">Order</h2>
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
    <div class="widget has-shadow">
      <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Stock</h4>
      </div>
      <div class="widget-body">
        <div class="table-responsive">
          <table id="export-table" class="table table-bordered mb-0">
            <thead>
              <tr>
                <th>No</th> 
                <th>Product</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              
              <?php 
                foreach ($stock_list as $key => $s_list) 
                { 
                  ?>
                    <tr>
                      <td><?php echo $key+1;?></td>
                      <td><span class="text-primary"><?php echo $s_list['product']; ?></span></td>
                      
                      <td><?php echo $s_list['description']?></td>
                      <td><?php echo $s_list['s_product_qunatity']?></td>
                      
                      <td class="td-actions">
                        <div class="text-center">
                          <form method="post" action="<?php echo site_url("admin/edit_stock");?>">
                          <div class="btn-group" role="group">
                            
                            <button type="submit" class="btn btn-gradient-01" name="stock_id" value="<?php echo $s_list['s_id']?>">Edit</button>
                       </div>
                        </form>
                        </div>
                      </td>
                    </tr>
                  <?php
                }
              ?>              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php

  require_once("include/footer.php");

?>