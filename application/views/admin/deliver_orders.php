
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
          <table id="export-table" class="table table-bordered mb-0">
            <thead>
              <tr>
                <th>No</th>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Vender</th>
                <th>Product</th>
                <th>Quantity</th>
                <th><span style="width:100px;">Status</span></th>
                <th>Order Date</th>
                <th>Delivery Date</th>
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
                      <td><?php echo $orders['product']?></td>
                      <td><?php echo $orders['order_quantity']?></td>
                      <td><span class="badge-text badge-text-small success"><?php echo "Deliver"; ?></span></td>
                      <td style="width: 100px;"><?php echo date('d-M-y', $orders['o_create_on']); ?></td>
                      <td style="width: 100px;"><?php echo date('d-M-y', $orders['o_update_on']); ?></td>
                      <td><?php echo $orders['tracking_id']?></td>
                      <td>
                        <form method="post" action="<?php //echo site_url("admin/order_view");?>">
                          <button type="submit" value="<?php //echo $orders['order_id']; ?>" name="order_id" class="btn btn-gradient-01 my_button">Refund</button>
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