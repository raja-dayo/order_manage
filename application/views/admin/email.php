<table border="1px solid">
            <thead>
              <tr>
                <th>No</th>
                <th>Order No</th>
                <th>Customer Name</th>
                <th>Vender</th>
                
                 <th>Delivery Method</th>
                <th><span style="width:100px;">Status</span></th>
                <th>Order Date</th>
                
              </tr>
            </thead>
            <tbody>
              
              <?php 
                foreach ($data as $key => $orders) {
                  
                  ?>
                    <tr>
                    	<td><?php echo $key+1; ?></td>
                      <td><span class="text-primary"><?php echo $orders['orderNo']; ?></span></td>
                      <td><?php echo $orders['firstName']." ".$orders['lastName']; ?></td>
                      <td><?php echo $orders['name']." ".$orders['last_name']; ?></td>
                      <td>
                        <span style="width:100px;">
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
                      	<span style="width:100px;">
                        		<span class="badge-text badge-text-small info"><?php echo "Pending"; ?></span>
                        </span>
                     	</td>
                      <td style="width: 100px;"><?php echo  date('d-M-y',$orders['o_create_on']);?></td>  	
                    </tr>
                  <?php
                }
              ?>              
            </tbody>
          </table>