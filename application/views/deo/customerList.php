
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
    <div class="widget has-shadow">
      <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Customers</h4>
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
                        <?php
                          $encryptId = urldecode($this->encrypt->encode($customer['customer_id']))                              
                        ?>
                        <a href="<?php echo site_url("deo/updateCustomerForm/?customerId=$encryptId");?>" id="abc"><i class="la la-edit edit"></i></a>
                        <a href="<?php echo site_url("deo/deleteCustomer/?customerId=$customer[customer_id]")?>"><i class="la la-close delete"></i></a>
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

