
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
                <div class="title text-facebook">
                  <a href="<?php echo site_url("");?>">Pending Orders</a> <!--deo/pending_orders-->
                </div>
                <div class="number"><?php echo $pending_order[0]['num']; ?></div>
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
                <div class="title text-linkedin">
                  <a href="<?php echo site_url("");?>">Order In Process</a> <!--deo/in_process_orders-->
                </div>
                <div class="number"><?php echo $order_process[0]['num']; ?></div>
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
                <div class="title text-twitter">
                  <a href="<?php echo site_url("");?>">Deliver Orders</a> <!--deo/deliver_orders-->
                </div>
                <div class="number"><?php echo $order_deliver[0]['num']; ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>
     <!-- <div class="col-xl-4 col-md-6 col-sm-6">
        <div class="widget widget-12 has-shadow">
          <div class="widget-body">
            <div class="media">
              <div class="align-self-center ml-5 mr-5">
                <i class="la la-user"></i>
              </div>
              <div class="media-body align-self-center">  
                <div class="title text-twitter">
                  <a href="<?php echo site_url("deo/agent_list");?>">Our Agent</a>
                </div>
                <div class="number"><?php echo $agents[0]['num']; ?></div>
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
                <div class="title text-twitter">
                  <a href="<?php echo site_url("deo/customer");?>">Our Customers</a>
                </div>
                <div class="number"><?php echo $customers[0]['num']; ?></div>
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
                <i class="la ti-user"></i>
              </div>
              <div class="media-body align-self-center">  
                <div class="title text-twitter">
                  <a href="<?php echo site_url("deo/vendor");?>">Our Vendors</a>
                </div>
                <div class="number"><?php echo $venders[0]['num']; ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>-->
      <div class="col-xl-4 col-md-6 col-sm-6">
        <div class="widget widget-12 has-shadow">
          <div class="widget-body">
            <div class="media">
              <div class="align-self-center ml-5 mr-5">
                <img src="<?php echo base_url()."assets/img/images.png"?>" style="width: 100px;">
              </div>
              <div class="media-body align-self-center">  
                <div class="title text-twitter">
                  <a href="<?php echo site_url("deo/refund_orders");?>">Refund Orders</a>
                </div>
                <div class="number"><?php echo $refund_orders[0]['num']; ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>    
    </div>
    <div id="ajax"></div>
  </div>
<?php

  require_once("include/footer.php");

?>