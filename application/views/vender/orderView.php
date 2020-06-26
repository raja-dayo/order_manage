
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
                <th>Order No</th>
                <td><?php echo $order[0]['orderNo'];?></td>
                <td rowspan="13"><img src="<?php echo base_url()."assets/img/".$order[0]['image']?>" alt="..." style="width: 250px; height: 400px;"></td> 
              </tr>
              <tr>
                <th>Customer Name</th>
                <td><?php echo strtoupper($order[0]['firstName']." ".$order[0]['lastName'] );?></td>
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
                <td><?php echo strtoupper($order[0]['o_street_address']);?></td>
              </tr>
              <tr>
                <th>Postal Code</th>
                <td><?php echo strtoupper($order[0]['o_postal_code']);?></td>
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
                <th>Selling Product</th>
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
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <form action="<?php echo site_url("vender/order")?>">
      <button type="submit" class="btn btn-gradient-01 my_button" style="float: right; margin-top: -25px;">Back Orders</button>
    </form>
  </div>

<?php

  require_once("include/footer.php");

?>

