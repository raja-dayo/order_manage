
<?php 
  
  require_once("include/header.php");

?>
<div class="content-inner">
	<div class="container-fluid">
    <div class="row">
      <div class="page-header">
        <div class="d-flex align-items-center">
          <h2 class="page-header-title">Order View</h2>
        </div>
      </div>
    </div>
    <div class="widget has-shadow">
      <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Order NO # <?php echo $orders[0]['orderNo']?></h4>
      </div>
      <div class="widget-body">
        <div class="table-responsive">
          <table id="export-table" class="table mb-0">
            <thead>
            <tr>
                <!--<th>No</th>-->
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              
              <?php 
                foreach ($orders as $key => $order) {
                   
                  ?>
                    <tr>
                      <!--<td><?php echo $key+1; ?></td>-->
                      <td><?php echo ucwords($order['product']); ?></td>
                      <td><?php echo $order['od_product_quantity']; ?></td>
                      <td><?php echo $order['od_product_price'] ?></td>
                      <td><?php echo $amount[]=$order['od_product_quantity']*$order['od_product_price']?></td>
                       <td class="td-actions">
                        
                          <form method="post" action="<?php echo site_url("admin/update_order_product_page");?>">
                            <div class="btn-group" role="group">
                              <button type="submit" class="btn btn-gradient-01" name="od_id" value="<?php echo $order['od_id'];?>">Edit</button>
                              <button type="submit" class="btn btn-secondary ripple1" name="delete" onClick="return confirm('Are you sure want to delete this agent!')" value="<?php echo $order['od_id'];?>">Delete</button>
                            </div>
                            
                              
                              <input type="hidden" name="orderNo" value="<?php echo $order['orderNo']?>">
                              <input type="hidden" name="product" value="<?php echo $order['product']?>">
                              <input type="hidden" name="product_qun" value="<?php echo $order['od_product_quantity']?>">
                              <input type="hidden" name="product_price" value="<?php echo $order['od_product_price']?>">
                              
                          </form>
                        
                      </td>
                    </tr>
                  <?php
                }
              ?>   
              <tr>      
            </tbody>
            <tr>
              <td colspan="3">Total</td>
              <td colspan="2"><?php echo array_sum($amount);?></td>
            </tr>
            <tr>
              
              <td colspan="3">Delivery Charge</td>
              <td colspan="2"><?php echo $orders[0]['d_shipping_charges'];?></td>
            </tr>
           <tr>
              <td colspan="3">SubTotal</td>
              <td colspan="2"><?php echo $orders[0]['d_shipping_charges']+array_sum($amount);?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <?php
     /* foreach ($orders as $key => $order)
      {
        ?>
          <div class="alert alert-primary" role="alert">
            <h4 class="alert-heading">Order # <?php echo $order['orderNo']?></h4>
            <p class="alert-heading">Order Date <?php echo $order['order_date']?></p>
            <hr>
            <div class="row">
              
              <div class="col-sm-4"><?php echo $order['product']?></div>
              <div class="col-sm-4">Qty:<?php echo $order['od_product_quantity']?></div>
              <div class="col-sm-4"><?php echo $order['od_product_price']?></div>
            </div>
          </div>
        <?php
      }*/
      echo "<pre>";
      print_r($orders);
    ?>
    <form id="tracking" method="post" action="<?php echo site_url('admin/updateOrderTracking')?>">
      <div class="row">
        <div class="col-sm-3">
        <label class="form-control-label">Order Status</label>
        </div>
        <div class="col-sm-9">
          <select class="custom-select form-control" name="status" id="cardType" >
            <option>Select Here</option>

            <option value="1"<?=$order['order_status']==1?'selected="selected"' : '';?>>Pending</option>
            <option value="2"<?=$order['order_status']==2?'selected="selected"' : '';?>>In Process</option>
            <option value="3"<?=$order['order_status']==3?'selected="selected"' : '';?>>Deliver</option>
            <?php
              if($order[0]['order_status']==2 || $order[0]['order_status']==3 || $order[0]['order_status']==4)
              {
                ?>
                  <!--<option value="4">Refund</option>-->
                  <option value="4"<?=$order['order_status']==4?'selected="selected"' : '';?>>Refund</option>
                <?php
              }
            ?>
          </select>
        </div>
      </div>
      </br>
      <div class="row">
        <div class="col-sm-3">
        <label class="form-control-label">Tracking ID</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="tracking" class="form-control" id="track" value="<?php echo $order['tracking_id'];?>">
          <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="tracking_msg" style="display: none;"></p>
        </div>
      </div>
      <div class="row" style="text-align: center">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
          <?php
            foreach ($orders as $key => $order) {
              ?>
                <input type="hidden" name="amount[]" value="<?php echo $order['od_product_price']*$order['od_product_quantity']?>">
                <input type="hidden" name="o_quantity[]" value="<?php echo $order['od_product_quantity'];?>">
                <input type="hidden" name="order_product[]" value="<?php echo $order['od_product_id'];?>">      
              <?php
            }
          ?>
          <input type="hidden" name="orderId" value="<?php echo $order['order_id'];?>">
          <button type="submit" class="btn btn-gradient-03 my_button">UPDATE ORDER</button>
        </div>
        <div class="col-sm-4"></div>
      </div>
    </form>
    </br>
    </br>
    <form action="<?php echo site_url("admin/orders")?>">
      <!--<button type="submit" class="btn btn-gradient-01 my_button" style="float: right; margin-top: -25px;">Back Orders</button>-->
      <a href="<?php echo site_url("admin/orders");?>" class="btn btn-gradient-01 my_button" style="float: right; margin-top: -25px;">Back Orders</a>
    </form>
    </br>
  </div>
  <script type="text/javascript">
   $("#tracking").submit(function(){
    
     
      //var tracking_id=$("#track").val();
      
      

      var tracking_id= $("#track").val();
      /*if(isNaN(Number(tracking_id)))
      {
        $("#tracking_msg").html("Please Enter Only Number");

        return false;
      }
      else*/ if(tracking_id=="")
      {
        $("#tracking_msg").html("Please Enter Tracking Id");

        return false; 
      }
      else
      {
        return true;
      }
      
    });

    //return false;
   
  </script>
<?php

  require_once("include/footer.php");

?>

