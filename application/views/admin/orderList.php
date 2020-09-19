
<?php 
  
  require_once("include/header.php");

?>

<div class="content-inner">
	
  <div class="container-fluid">
    <div class="row">
      <div class="page-header">
       <!-- <div class="d-flex align-items-center">
          <h2 class="page-header-title">Orders</h2>
          <a href="<?php echo site_url('admin/add_another_product_page')?>" class="btn btn-gradient-01 my_button">Add Product</a>
        </div>-->
      </div>
    </div>
    <div class="widget has-shadow">
      <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Orders List</h4>
      </div>
     <div class="widget-body">
        <div class="table-responsive">
          <table id="export-table" class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Order No</th>
                <th>Customer Name</th>
                <th>Vendor</th>
                <th>Payment Method</th>
                <th>Devliery Method</th>
                 <th>Amount</th>
                <th><span style="width:100px;">Status</span></th>
                <th>Order Date</th>
                <th>Order</th>
                <th>Tracking</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              
              <?php 
                foreach ($records as $key => $orders) {
                  
                  ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><span class="text-primary"><?php echo $orders['orderNo']; ?></span></td>
                      <td><?php echo $orders['firstName']." ".$orders['lastName']; ?></td>
                       <td><?php echo $orders['name']." ".$orders['last_name']; ?></td>
                      <td><?php echo $orders['payment_method']?></td>
                        <td><span style="width:100px;">
                        <?php 
                          if($orders['delivery_method_id']==1)
                          {
                            ?>
                              <span class="badge-text badge-text-small info"><?php echo "ND" ?></span>
                            <?php
                          }
                          else if($orders['delivery_method_id']==2)
                          {
                            ?>
                              <span class="badge-text badge-text-small danger"><?php echo "NDD"; ?></span>
                            <?php
                          }
                          else if($orders['delivery_method_id']==3)
                          {
                            ?>
                              <span class="badge-text badge-text-small success"><?php echo "ID"; ?></span>
                            <?php
                          }
                         
                        ?>
                      </td>
                       <td>
                         <?php
                          //if($orders['delivery_method_id']==3){
                            //echo '$'.$orders['o_total_amount'];
                          //}
                          //else{

                            echo '£'.$orders['o_total_amount'];
                          //}
                        ?>
                       </td>
                      <td><span style="width:100px;">
                        <?php 
                          if($orders['order_status']==1)
                          {
                            ?>
                              <span class="badge-text badge-text-small info"><?php echo "Pending"; ?></span>
                            <?php
                          }
                          else if($orders['order_status']==2)
                          {
                            ?>
                              <span class="badge-text badge-text-small danger"><?php echo "In Process"; ?></span>
                            <?php
                          }
                          else if($orders['order_status']==3)
                          {
                            ?>
                              <span class="badge-text badge-text-small success"><?php echo "Deliver"; ?></span>
                            <?php
                          }
                          else if($orders['order_status']==4)
                          {
                            ?>
                              <span class="badge-text badge-text-small" style="background-color: purple;"><?php echo "Refund"; ?></span>
                            <?php
                          }
                        ?>
                      </td>
                        <td style="width: 100px;"><?php echo  $orders['order_date']; //date('d-M-y',$orders['o_create_on']);?></td>
                         <td>
                        <form method="post" action="<?php echo site_url("admin/order_view");?>">
                          <button type="submit" value="<?php echo $orders['orderNo']; ?>" name="order_id" class="btn btn-gradient-01 my_button">View</button>
                        </form>
                      </td>
                      <td><?php echo $orders['tracking_id']?></td>
                      <td>
                        <form method="POST" action="<?php echo site_url('admin/order_delete');?>">
                          <button class="btn btn-gradient-03 my_button" name="delete_order" onClick="return confirm('Are you sure want to delete this product!')" value="<?php echo $orders['orderNo']; ?>">Delete</button>
                          
                          
                           
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