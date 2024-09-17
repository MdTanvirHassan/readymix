<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(3, 13, $userData);
              
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; "> Return  List</h2>
    <hr>-->
<div class="os-tabs-w menu-shad">
       <?php require_once(__DIR__ .'/../logistics_ware_house_header.php'); ?>   
 </div>

<div class="right_content">
    <?php $this->role = checkUserPermission(3, 10, $userData); if (in_array(2, $this->role)) {  ?> 
        <a href="<?php echo site_url('general_store/add_store_return'); ?>" class="btn btn-sm btn-primary">ADD RETURN</a>
    <?php } ?>     
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                
                <th class="col-lg-2">Return No</th>
                <th class="col-lg-2">Return Date</th>
                <th class="col-lg-2">Status</th>
               
               
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($store_returns)) {
                foreach ($store_returns as $store_return) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($store_return['rr_no'])) echo $store_return['rr_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($store_return['rr_date'])) echo $store_return['rr_date']; ?>
                        </td>
                        <td>
                            <?php if(!empty($store_return['rr_status'])) echo $store_return['rr_status']; ?>
                        </td>
                        
                        

                        <td>
                           <?php  if (in_array(3, $this->role)) {  ?> 
                             <?php if($store_return['rr_status']=="pending" || $store_return['rr_status']=="not returned" ){ ?>
                                <a href="<?php echo site_url('general_store/edit_store_return/'.$store_return['rr_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                             <?php }else{ ?>
                                <button class="btn btn-sm btn-info">Edit</button>
                             <?php } ?>   
                          <?php } ?> 
                          <?php  if (in_array(4, $this->role)) {  ?>       
                                <a href="<?php echo site_url('general_store/details_store_return/'.$store_return['rr_id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                          <?php } ?>
                           <?php  if (in_array(5, $this->role)) {  ?>        
                                 <?php if($store_return['rr_status']=="pending" || $store_return['rr_status']=="not returned" ){ ?>
                                        <button onclick="delete_row('<?php echo site_url('general_store/delete_store_return/'.$store_return['rr_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                 <?php }else{ ?>    
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                 <?php } ?>      
                           <?php } ?>  
                          <?php  if (in_array(2, $this->role)) {  ?>      
                                <?php if($store_return['rr_status']=="pending" || $store_return['rr_status']=="not returned" ){ ?>
                                   <a href="<?php echo site_url('general_store/receive_return_receive/'.$store_return['rr_id']); ?>"><button class="btn btn-sm btn-success">Return</button></a>
                               <?php }else{ ?>
                              <!--      <a href="<?php echo site_url('general_store/reject_return_receive/'.$store_return['rr_id']); ?>"><button class="btn btn-sm btn-warning">Reject</button></a>-->
                               <?php } ?>
                          <?php } ?>          
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>
