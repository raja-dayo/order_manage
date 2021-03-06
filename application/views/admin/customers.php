
<?php 
  
  require_once("include/header.php");
  
?>


<div class="content-inner">
  
  <div class="container-fluid">
    <div class="row">
      <div class="page-header">
        <div class="d-flex align-items-center">
          <h2 class="page-header-title">Customers List</h2>
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
        <h4>Export</h4>
      </div>
      <div class="widget-body">
        <div class="table-responsive">
          <table id="export-table" class="table mb-0">
            <thead>
            <tr>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Contact Number</th>
               
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              
              <?php 
                foreach ($records as $key => $customer) {
                  
                  ?>
                    <tr>
                      <td><?php echo $customer['firstName']." ".$customer['lastName']; ?></td>
                      <td><span class="text-primary"><?php echo $customer['email']; ?></span></td>
                      <td><?php echo $customer['number']?></td>
                     
                      <td class="td-actions">
                        <div class="text-center">
                          <form method="post" action="<?php echo site_url("admin/customers_action");?>">
                            <div class="btn-group" role="group">
                              <button type="submit" class="btn btn-gradient-01" name="edit" value="<?php echo $customer['customer_id'];?>">Edit</button>
                              <button type="submit" class="btn btn-secondary ripple1" name="delete" onClick="return confirm('Are you sure want to delete this customer!')" value="<?php echo $customer['customer_id'];?>">Delete</button>
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

