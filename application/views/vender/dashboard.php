
<?php 
  
  require_once("include/header.php");
  
?>

<div class="content-inner">
  <div class="container-fluid">
    <div class="row">
      <div class="page-header">
        <div class="d-flex align-items-center">
          <h2 class="page-header-title">Dashboard</h2>
        </div>
      </div>
    </div>
    <div class="row flex-row">
      <div class="col-xl-4 col-md-6 col-sm-6">
        <div class="widget widget-12 has-shadow">
          <div class="widget-body">
            <div class="media">
              <div class="align-self-center ml-5 mr-5">
                <i class="ti ti-shopping-cart"></i>
              </div>
              <div class="media-body align-self-center">
                <div class="title text-facebook"><a href="<?php echo site_url("")?>">Pending Orders</a></div><!--."vender/pending_orders"-->
                <div class="number"><?php echo $result[0]['num']; ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6 col-sm-6">
        <div class="widget widget-12 has-shadow">
          <div class="widget-body">
            <div class="media">
              <div class="align-self-center ml-5 mr-5">
                <i class="la la-truck"></i>
              </div>
              <div class="media-body align-self-center">  
                <div class="title text-twitter"><a href="<?php echo site_url("");?>">Order In Process</a></div><!--."vender/process_order"-->
                <div class="number"><?php echo $pro_ord[0]['num']; ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6 col-sm-6">
        <div class="widget widget-12 has-shadow">
          <div class="widget-body">
            <div class="media">
              <div class="align-self-center ml-5 mr-5">
                <i class="la la-bank"></i>
              </div>
              <div class="media-body align-self-center">
                <div class="title text-linkedin"><a href="<?php echo site_url("")?>">Order Deliver</a></div><!--."vender/deliver_orders-->
                <div class="number"><?php echo $deliver_ord[0]['num']; ?></div>
              </div>
            </div>
          </div>  
        </div>
      </div>
       <div class="col-xl-4 col-md-6 col-sm-6">
        <div class="widget widget-12 has-shadow">
          <div class="widget-body">
            <div class="media">
              <div class="align-self-center ml-5 mr-5">
                <img src="<?php echo base_url()."assets/img/images.png"?>" style="width: 100px;">
              </div>
              <div class="media-body align-self-center">
                <div class="title text-linkedin"><a href="<?php echo site_url()."vender/refund_orders";?>">Refund Order</a></div>
                <div class="number"><?php echo $refund_orders[0]['num']; ?></div>
              </div>
            </div>
          </div>  
        </div>
      </div>
      <div class="col-xl-4 col-md-6 col-sm-6">
        <div class="widget widget-12 has-shadow">
          <div class="widget-body">
            <div class="media">
              <div class="align-self-center ml-5 mr-5">
                <i class="la la-users"></i>
              </div>
              <div class="media-body align-self-center">
                <div class="title text-linkedin"><a href="<?php echo site_url()."vender/customerList";?>">Our Customers</a></div>
                <div class="number"><?php echo $customers[0]['num']; ?></div>
              </div>
            </div>
          </div>  
        </div>
      </div>
    </div>
  </div>

<?php

  require_once("include/footer.php");

?>