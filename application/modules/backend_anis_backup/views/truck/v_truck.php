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
     <?php $this->role = checkUserPermission(13,61,$userData);  if (in_array(2, $this->role)) {  ?>
            <a href="<?php echo site_url('trucks/add_truck'); ?>" class="btn btn-sm btn-primary">ADD TRUCK</a>
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Truck No</th>
                <th class="col-lg-1">License No.</th>
                <th class="col-lg-1">Insurance No.</th> 
                <th class="col-lg-1">Road Permit</th> 
                <th class="col-lg-1">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($trucks)) {
                foreach ($trucks as $truck) { 
                   
                    ?>
                    <tr>
                        <td>
                              <?php if(!empty($truck['truck_no'])) echo $truck['truck_no']; ?>
                        </td>
                        <td>
                              <?php if(!empty($truck['license_no'])) echo $truck['license_no']; ?>
                        </td>
                       
                        <td>
                              <?php if(!empty($truck['insurance_no'])) echo $truck['insurance_no']; ?>
                        </td>
                      
                        <td>
                              <?php if(!empty($truck['road_permit'])) echo $truck['road_permit']; ?>
                        </td>

                        <td>
                           
                                <?php  if (in_array(3, $this->role)) {  ?>    
                                    <a href="<?php echo site_url('trucks/edit_truck/'.$truck['truck_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php } ?>   
                            
                           <?php  if (in_array(4, $this->role)) {  ?>         
                                <a href="<?php echo site_url('trucks/details_truck/'.$truck['truck_id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                           <?php } ?>
                           <?php  if(in_array(5, $this->role)){  ?>        
                               
                                    <button onclick="delete_row('<?php echo site_url('trucks/delete_truck/'.$truck['truck_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                
                           <?php } ?>    
                                    
                         
                                             
                                    
                                    
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>
