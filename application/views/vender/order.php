
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
        <h4>Export</h4>
      </div>
      <div class="widget-body">
        <div class="table-responsive">
          <table id="export-table" class="table mb-0">
            <thead>
            <tr>
                <th>No</th>
                <th>Order No</th>
                <th>Customer Name</th>
                <th>product</th>
                <th><span style="width:100px;">Status</span></th>
                <th>Date</th>
                <th>Order</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              
              <?php 
                foreach ($records as $key => $orders) {
                  
                  ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo $orders['orderNo']; ?></td>
                      <td id="fname"><?php echo $orders['firstName']." ".$orders['lastName']; ?></td>
                      <td><?php echo $orders['product']?></td>
                      <td>
                        <span style="width:100px;">
                          <?php 
                            if($orders['order_status']==1)
                            {
                              //echo "Pending";
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
                                <span class="badge-text badge-text-small" style="background-color: purple"><?php echo "Refund"; ?></span>
                              <?php
                            }
                          ?>
                        </span>
                      </td>
                      <td style="width: 100px;"><?php echo date('d-M-y', $orders['o_create_on']);?></td>
                      <td>
                        <form method="post" action="<?php echo site_url("vender/order_view");?>">
                       <button type="submit" value="<?php echo $orders['order_id']; ?>" name="order_id" class="btn btn-gradient-01 my_button">View</button>
                      </td>
                    </form>
                      <td class="td-actions">
                      
                      <?php
                        if($orders['order_status']==1) 
                        {
                          ?>
                            <a href="<?php echo site_url("vender/updateOrderForm?orderId=$orders[orderNo]");?>" id="update"><i class="la la-edit edit"></i></a>
                            <a id="delete" href="<?php echo site_url("vender/deleteOrder?orderId=$orders[order_id]")?>" onClick="return confirm('Are you sure want to delete this order!')"><i class="la la-close delete"></i></a>
                          <?php
                        } 
                      ?> 
                       
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


<script type="text/javascript">
  $(document).ready(function(){
    
   /* $('.my_button').click(function() {
     
      var order_id  = $(this).val();
      
      function ajax_success(responseText, statusText, XMLHttpRequest)
      {
        if(statusText=="success" && XMLHttpRequest.status==200 && XMLHttpRequest.statusText=="OK")
        {
          alert(responseText);
        }
      }
      $.ajax({
        url:   "<?php //echo site_url("vender/order_view");?>",
        type:  "POST",
        data:  {order_id:order_id} ,
        success:ajax_success
      });
    });*/
  });
</script>
<?php

  require_once("include/footer.php");

?>

