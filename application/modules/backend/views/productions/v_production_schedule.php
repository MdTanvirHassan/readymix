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
     <?php $this->role = checkUserPermission(13,57, $userData);  if (in_array(2, $this->role)) {  ?>
        <a href="<?php echo site_url('productions/add_production_schedule'); ?>" class="btn btn-sm btn-primary">ADD SCHEDULE</a>
     <?php } ?>   
          <select id="search_by" style="width: 200px;margin:0 auto;margin-top: -30px" class="form-control">
                            <option value="">Search by Status</option>
                            <option>Pending</option>
                            <option>Done</option>
                            <option value=''>All</option>
                        </select>
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Schedule Number</th>
                <th class="col-lg-1">DO No</th>
                <th class="col-lg-1">Status</th> 
                <th class="col-lg-1">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($production_schedules)) {
                foreach ($production_schedules as $schedule) { 
                   
                    ?>
                    <tr>
                        <td>
                            <?php echo date('d-m-Y',strtotime($schedule['date'])); ?>
                        </td>
                        <td>
                            <?php echo $schedule['schedule_no']; ?>
                        </td>
                        <td>
                            <?php echo $schedule['delivery_no']; ?>
                        </td>
                       
                        <td>
                             <?php if($schedule['status']=="Pending"){ ?>
                                    <span style="color:#CE9208;"> <?php echo $schedule['status']; ?></span>
                              <?php }else{ ?>
                                    <span style=""> <?php echo $schedule['status']; ?></span>
                              <?php } ?>
                            
                            <?php //echo $schedule['b_status']; ?>
                        </td>
                      

                        <td>
                             <?php if($schedule['status']=="Pending"){ ?>
                                <?php  if (in_array(3, $this->role)) {  ?>    
                                    <a href="<?php echo site_url('productions/edit_production_schedule/'.$schedule['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php } ?>   
                             <?php } ?>
                           <?php  if (in_array(4, $this->role)) {  ?>         
                                <a href="<?php echo site_url('productions/details_production_schedule/'.$schedule['id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                           <?php } ?>
                           <?php  if(in_array(5, $this->role)){  ?>        
                                <?php if($schedule['status']=="Pending"){ ?>
                                    <button onclick="delete_row('<?php echo site_url('productions/delete_production_schedule/'.$schedule['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
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
<script>
$('#search_by').change(function(){
    $('#datatable_filter :input').focus().val($(this).val()).keyup();
})
</script>