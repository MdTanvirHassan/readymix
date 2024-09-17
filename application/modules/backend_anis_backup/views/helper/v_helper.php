<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(2, 8, $userData);
              
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; "> Budget List</h2>
    <hr>-->
<div class="os-tabs-w menu-shad">
        <?php require_once(__DIR__ .'/../production_header.php'); ?>
    </div>
<div class="right_content">
     <?php $this->role = checkUserPermission(13, 61, $userData);  if (in_array(2, $this->role)) {  ?>
            <a href="<?php echo site_url('helpers/add_helper'); ?>" class="btn btn-sm btn-primary">ADD HELPER</a>
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Name</th>
                <th class="col-lg-1">Contact No.</th>
                <th class="col-lg-1">E. Contact No.</th>
                <th class="col-lg-1">Present Address</th> 
                <th class="col-lg-1">Permanent Address</th> 
                <th class="col-lg-1">Blood Group</th> 
                <th class="col-lg-1">License No.</th> 
               
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($helpers)) {
                foreach ($helpers as $helper) { 
                   
                    ?>
                    <tr>
                        <td>
                             <?php if(!empty($helper['helper_name'])) echo $helper['helper_name']; ?>
                        </td>
                        <td>
                              <?php if(!empty($helper['contact_no'])) echo $helper['contact_no']; ?>
                        </td>
                       
                        <td>
                              <?php if(!empty($helper['emergency_contact_no'])) echo $helper['emergency_contact_no']; ?>
                        </td>
                        
                         <td>
                              <?php if(!empty($helper['present_address'])) echo $helper['present_address']; ?>
                        </td>
                      
                        <td>
                              <?php if(!empty($helper['permanent_address'])) echo $helper['permanent_address']; ?>
                        </td>
                        
                        <td>
                              <?php if(!empty($helper['blood_group'])) echo $helper['blood_group']; ?>
                        </td>
                        
                        <td>
                              <?php if(!empty($helper['license_no'])) echo $helper['license_no']; ?>
                        </td>

                        <td>
                           
                                <?php  if (in_array(3, $this->role)) {  ?>    
                                    <a href="<?php echo site_url('helpers/edit_helper/'.$helper['helper_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php } ?>   
                            
                           <?php  if (in_array(4, $this->role)) {  ?>         
                                <a href="<?php echo site_url('helpers/details_helper/'.$helper['helper_id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                           <?php } ?>
                           <?php  if(in_array(5, $this->role)){  ?>        
                               
                                    <button onclick="delete_row('<?php echo site_url('helpers/delete_helper/'.$helper['helper_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                
                           <?php } ?>    
                                    
                         
                                             
                                    
                                    
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>
