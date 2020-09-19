
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
                        
                          <form method="post" action="<?php echo site_url("");?>">
                            <div class="btn-group" role="group">
                              <button type="submit" class="btn btn-gradient-01" name="edit_id" value="<?php echo $order['order_id'];?>">Edit</button>
                              <button type="submit" class="btn btn-secondary ripple1" name="delete" onClick="return confirm('Are you sure want to delete this agent!')" value="<?php echo $order['order_id'];?>">Delete</button>
                            </div>
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
    ?>
   
    </br>
    </br>
    <form action="<?php echo site_url("admin/orders")?>">
      <!--<button type="submit" class="btn btn-gradient-01 my_button" style="float: right; margin-top: -25px;">Back Orders</button>-->
      <a href="<?php echo site_url("vender/order");?>" class="btn btn-gradient-01 my_button" style="float: right; margin-top: -25px;">Back Orders</a>
    </form>
    </br>
  </div>
  <script type="text/javascript">
   $("form").submit(function(){
    
     
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

