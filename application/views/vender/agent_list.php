
<?php 
  
  require_once("include/header.php");
  
?>


<div class="content-inner">
  
  <div class="container-fluid">
    <div class="row">
      <div class="page-header">
        <div class="d-flex align-items-center">
          <h2 class="page-header-title">Agents</h2>
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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Precentage</th>
                <th>Contact Number</th>
                <th>State</th>
                <th>Country</th>
                <th><span style="width:100px;">Status</span></th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              
              <?php 
                foreach ($records as $key => $agent) {
                  
                  ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo ucwords($agent['a_first_name']); ?></td>
                      <td><?php echo ucwords($agent['a_last_name']); ?></td>
                      <td><?php echo ucwords($agent['a_percentage'])."%"; ?></td>
                      <td><?php echo $agent['a_contact_number']; ?></td>
                      <td><?php echo ucwords($agent['state_name']); ?></td>
                      <td><?php echo ucwords($agent['country_name']); ?></td>

                      <td><span style="width:100px;">
                        <?php 
                          if($agent['status']==1)
                          {
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
                        <div class="text-center">
                          <form method="post" action="<?php echo site_url("vender/agents_action");?>">
                            <div class="btn-group" role="group">
                              <button type="submit" class="btn btn-gradient-01" name="edit_id" value="<?php echo $agent['a_id'];?>">Edit</button>
                              <button type="submit" class="btn btn-secondary ripple1" name="delete" onClick="return confirm('Are you sure want to delete this agent!')" value="<?php echo $agent['a_id'];?>">Delete</button>
                            </div>
                          </form>
                        </div>
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

