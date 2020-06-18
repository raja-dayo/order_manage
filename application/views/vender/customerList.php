
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
                <th><span style="width:100px;">Status</span></th>
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
                      <td><span style="width:100px;">
                        <?php 
                          if($customer['status']==1)
                          {
                            //echo "Pending";
                            ?>
                              <span class="badge-text badge-text-small info"><?php echo "Active"; ?></span>
                            <?php
                          }
                          else
                          {
                            ?>
                              <span class="badge-text badge-text-small danger"><?php echo "Inactive"; ?></span>
                            <?php
                          }
                        ?></span></span></td>
                      <td class="td-actions">
                        <?php
                          
                         // $customerId =$customer['id'];

                           // $encryptId=urldecode($this->encrypt->encode($emails['id']));

                            $encryptId = urldecode($this->encrypt->encode($customer['customer_id']))
                          
                          //$encryptId=$this->encryption->encrypt($customerId);
                        
                                                      
                        ?>
                        <a href="<?php echo site_url("vender/updateForm/?customerId=$encryptId");?>" id="abc"><i class="la la-edit edit"></i></a>
                        <a href="<?php echo site_url("vender/deleteCustomer/?customerId=$customer[customer_id]")?>"><i class="la la-close delete"></i></a>
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

