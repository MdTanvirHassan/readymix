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
     <?php $this->role = checkUserPermission(13,59, $userData);  if (in_array(2, $this->role)) {  ?>
        <a href="<?php echo site_url('productions/add_production_statement'); ?>" class="btn btn-sm btn-primary">ADD PRODUCTION STATEMENT</a>
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Production Number</th>
                <th class="col-lg-1">DO Number</th>
                <th class="col-lg-1">Schedule No</th>
                <th class="col-lg-1">Project Name</th>
                <th class="col-lg-1">Party Name</th> 
                <th class="col-lg-1">Status</th>
                <th class="col-lg-1">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($production_statements)) {
                foreach ($production_statements as $statement) { 
                    ?>
                    <tr>
                        <td>
                            <?php echo date('d-m-Y',strtotime($statement['date'])); ?>
                        </td>
                        <td>
                            <?php echo $statement['production_no']; ?>
                        </td>
                        <td>
                            <?php echo $statement['delivery_no']; ?>
                        </td>
                       
                        <td>
                             <?php echo $statement['schedule_no']; ?>
                             <?php if($statement['status']=="Pending"){ ?>
                                    <!--<span style="color:#CE9208;"> <?php echo $statement['status']; ?></span>-->
                              <?php }else{ ?>
                                    <!--<span style=""> <?php echo $statement['status']; ?></span>-->
                              <?php } ?>
                            
                            <?php //echo $statement['b_status']; ?>
                        </td>
                        <td>
                            <?php echo $statement['project_name']; ?>
                        </td>
                        <td>
                            <?php echo $statement['c_name']; ?>
                        </td>
                      <td>
                            <?php echo $statement['status']; ?>
                        </td>

                        <td>
                             <?php if($statement['status']=="Pending"){ ?>
                                <?php  if (in_array(3, $this->role)) {  ?>    
                                    <a href="<?php echo site_url('productions/edit_production_statement/'.$statement['pst_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php } ?>   
                             <?php }else{?>
                               <?php  if (in_array(3, $this->role)) {  ?>     
                                    <button class="btn btn-sm btn-info">Edit</button>
                               <?php } ?>      
                            <?php } ?>
                           <?php  if (in_array(4, $this->role)) {  ?>         
                                <a href="<?php echo site_url('productions/details_production_statement/'.$statement['pst_id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                           <?php } ?>
                           <?php  if(in_array(5, $this->role)){  ?>        
                                <?php if($statement['status']=="Pending"){ ?>
                                    <button onclick="delete_row('<?php echo site_url('productions/delete_production_statement/'.$statement['pst_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                <?php }else{?>
                                    <button class="btn btn-sm btn-danger">Delete</button>
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
