
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
        <h4>Order View</h4>
      </div>
      <div class="widget-body">
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <tbody>
              <tr>
                <th>Order NO</th>
                <td><?php echo $order[0]['orderNo'];?></td>
                <td rowspan="18"><img src="<?php echo base_url()."assets/img/".$order[0]['image']?>" alt="..." style="width: 250px; height: 400px;"></td> 
              </tr>
              <tr>
                <th>Order Date</th>
                <td><?php echo date('d-M-y',$order[0]['o_create_on']);?></td>
              </tr>
              <tr>
                <th>Customer Name</th>
                <td><?php echo strtoupper($order[0]['firstName']." ".$order[0]['lastName']);?></td>
              </tr>
               <tr>
                <th>Vender Name</th>
                <td><?php echo strtoupper($order[0]['name']." ".$order[0]['last_name']);?></td>
              </tr>
               <tr>
                <th>Contact Number</th>
                <td><?php echo $order[0]['number'];?></td>
              </tr>
              <tr>
                <th>Product</th>
                <td><?php echo strtoupper($order[0]['product']);?></td>
              </tr>
              <tr>
                <th>Country</th>
                <td><?php echo strtoupper($order[0]['country_name']);?></td>
              </tr>
              <tr>
                <th>State</th>
                <td><?php echo strtoupper($order[0]['state_name']);?></td>
              </tr>
              <tr>
                <th>Address</th>
                <td><?php echo strtoupper($order[0]['address']);?></td>
              </tr>
              <tr>
                <th>Postal Code</th>
                <td><?php echo strtoupper($order[0]['postalCode']);?></td>
              </tr>
              <tr>
                <tr>
                <th>Payment Method</th>
                <td><?php echo strtoupper($order[0]['payment_method']);?></td>
              </tr>
              <?php
                if($order[0]['payment_method']=="zell" || $order[0]['payment_method']=="pay pal" || $order[0]['payment_method']=="cash app" || $order[0]['payment_method']=="vemo")
                {
                  ?>
                    <tr>
                      <th>Agent Name</th>
                      <td><?php echo strtoupper($order[0]['a_first_name']);?></td>
                    </tr>
                    <tr>
                      <th>Agent Percentage</th>
                      <td>
                        <?php $total =$order[0]['sell_product_cost']*$order[0]['order_quantity']; ?>
                        <?php echo ($total/100)*$order[0]['a_percentage']."$";?></td>
                    </tr>
                  <?php
                }
              ?>
              <tr>
                <th>Product Cost</th>
                <td><?php echo $order[0]['prize']."$";?></td>
              </tr>
              <tr>
                <th>Sell Product</th>
                <td><?php echo $order[0]['sell_product_cost']."$";?></td>
              </tr>
              <tr>
                <th>Quantity</th>
                <td><?php echo $order[0]['order_quantity'];?></td>
              </tr>
              <tr>
                <th>Total Amount</th>
                <td><?php echo $order[0]['sell_product_cost']*$order[0]['order_quantity']."$";?></td>
              </tr>
              <form method="post" action="<?php echo site_url("deo/orderTracking")?>">
                 <tr>
                <td colspan="2" class="text-center">
                  <div class="row">
                    <div class="col-sm-3">
                    <label class="form-control-label">Order Status</label>
                    </div>
                    <div class="col-sm-9">
                      <select class="custom-select form-control" name="status" id="cardType" >
                        <option>Select Here</option>

                        <option value="1"<?=$order[0]['order_status']==1?'selected="selected"' : '';?>>Pending</option>
                        <option value="2"<?=$order[0]['order_status']==2?'selected="selected"' : '';?>>In Process</option>
                        <option value="3"<?=$order[0]['order_status']==3?'selected="selected"' : '';?>>Deliver</option>
                        <?php
                          if($order[0]['order_status']==2 || $order[0]['order_status']==3 || $order[0]['order_status']==4)
                          {
                            ?>
                              <!--<option value="4">Refund</option>-->
                              <option value="4"<?=$order[0]['order_status']==4?'selected="selected"' : '';?>>Refund</option>
                            <?php
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2" class="text-center">
                  <div class="row">
                    <div class="col-sm-3">
                    <label class="form-control-label">Tracking ID</label>
                    </div>
                    <div class="col-sm-9">
                      <input type="text" name="tracking" class="form-control" id="track" value="<?php echo $order[0]['tracking_id'];?>">
                      <p style="margin-left: 3px; margin-top: 3px; color:red; font-size:12px;" id="tracking_msg" style="display: none;"></p>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2" class="text-center">
                  <input type="hidden" name="amount" value="<?php echo $order[0]['sell_product_cost']*$order[0]['order_quantity']?>">
                  <input type="hidden" name="o_quantity" value="<?php echo $order[0]['order_quantity'];?>">
                  <input type="hidden" name="orderId" value="<?php echo $order[0]['order_id'];?>">
                  <button type="submit" class="btn btn-gradient-03 my_button" >UPDATE ORDER</button>

                </td>
              </tr>
              </form>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <form action="<?php echo site_url("admin/orders")?>">
      <!--<button type="submit" class="btn btn-gradient-01 my_button" style="float: right; margin-top: -25px;">Back Orders</button>-->
      <a href="<?php echo site_url("deo/orders");?>" class="btn btn-gradient-01 my_button" style="float: right; margin-top: -25px;">Back Orders</a>
    </form>
  </div>

  <script type="text/javascript">
   $("form").submit(function(){
    
     
      //var tracking_id=$("#track").val();
      
      

      var tracking_id= $("#track").val();
      if(isNaN(Number(tracking_id)))
      {
        $("#tracking_msg").html("Please Enter Only Number");

        return false;
      }
      else if(tracking_id=="")
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

