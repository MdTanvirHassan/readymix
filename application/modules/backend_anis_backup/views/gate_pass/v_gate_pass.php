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
     <?php $this->role = checkUserPermission(13, 64, $userData);  if (in_array(2, $this->role)) {  ?>
            <a href="<?php echo site_url('gate_pass/add_gate_pass'); ?>" class="btn btn-sm btn-primary">ADD GATE PASS</a>
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">SL.</th>
                <th class="col-lg-1">Pass No.</th>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Delivery Challan</th> 
                <th class="col-lg-1">Truck No.</th> 
                <th class="col-lg-1">Created By</th> 
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($gate_pass)) {
                $i=1;
                foreach ($gate_pass as $row) { 
                   
                    ?>
                    <tr>
                        <td>
                             <?php echo $i;; ?>
                        </td>
                        <td>
                              <?php if(!empty($row['pass_no'])) echo $row['pass_no']; ?>
                        </td>
                       
                        <td>
                              <?php if(!empty($row['date'])) echo $row['date']; ?>
                        </td>
                        
                         <td>
                              <?php if(!empty($row['dc_no'])) echo $row['dc_no']; ?>
                        </td>
                      
                        <td>
                              <?php if(!empty($row['truck_no'])) echo $row['truck_no']; ?>
                        </td>
                        
                        <td>
                              <?php if(!empty($row['name'])) echo $row['name']; ?>
                        </td>
                        

                        <td>
                           
                                <?php  if (in_array(3, $this->role)) {  ?>    
                                    <a href="<?php echo site_url('gate_pass/edit_gate_pass/'.$row['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php } ?>   
                            
                           <?php  if (in_array(4, $this->role)) {  ?>         
                                <a href="<?php echo site_url('gate_pass/details_gate_pass/'.$row['id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                           <?php } ?>
                           <?php  if(in_array(5, $this->role)){  ?>        
                               
                                    <button onclick="delete_row('<?php echo site_url('gate_pass/delete_gate_pass/'.$row['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                
                           <?php } ?>    
                                    
                         
                                             
                                    
                                    
                        </td>
                    </tr>
    <?php  $i++; }
} ?>
        </tbody>
    </table>
</div>
</div>
