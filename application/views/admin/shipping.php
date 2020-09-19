
<?php 
  
  require_once("include/header.php");
  
?>


<div class="content-inner">
  
  <div class="container-fluid">
    <div class="row">
      <div class="page-header">
        
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
        <h4>Shipping Charges List</h4>
      </div>
      <div class="widget-body">
        <div class="table-responsive">
          <table id="export-table" class="table mb-0">
            <thead>
            <tr>
                 <th>No</th>
                <th>Shipping Method</th>
                <th>Currency</th>
                <th>Charges</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              
              <?php 
                foreach ($shipping as $key => $ship) {
                  
                  ?>
                    <tr>
                      <td><?php echo $ship['id']; ?></td>

                      <td><?php echo $ship['d_name']; ?></td>
                      
                      <td><?php echo strtoupper($ship['d_currency']); ?></td>

                      <td><?php echo $ship['d_shipping_charges']?></td>
                     
                      <td class="td-actions">
                       
                          <form method="post" action="<?php echo site_url("admin/shipping_action");?>">
                            <div class="btn-group" role="group">
                              <button type="submit" class="btn btn-gradient-01" name="edit" value="<?php echo $ship['id'];?>">Edit</button>
                              <button type="submit" class="btn btn-secondary ripple1" name="delete" onClick="return confirm('Are you sure want to delete this customer!')" value="<?php echo $ship['id'];?>">Delete</button>
                            </div>
                          </form>
                        
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

