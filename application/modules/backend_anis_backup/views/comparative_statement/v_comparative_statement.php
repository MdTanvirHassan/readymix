<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(2, 39, $userData);
              
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; "> Budget List</h2>
    <hr>-->
<div class="os-tabs-w menu-shad">
        <?php require_once(__DIR__ .'/../procurement_header.php'); ?>
  </div>
<div class="right_content">
    <?php $this->role = checkUserPermission(2, 39, $userData); if (in_array(2, $this->role)) {  ?>
        <a href="<?php echo site_url('comparative_statement/add_comparative_statement'); ?>" class="btn btn-sm btn-primary">ADD COMPARATIVE STATEMENT</a>
    <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Item Name</th>
                <th class="col-lg-1">Payment Mode</th>
                <th class="col-lg-1">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($comparative_statements)) {
                foreach ($comparative_statements as $comparative_statement) { 
                    
                    ?>
                    <tr>
                        <td>
                            <?php echo date('d-m-Y',strtotime($comparative_statement['date'])); ?>
                        </td>
                       
                        <td>
                            <?php echo $comparative_statement['item_name']; ?>
                        </td>
                       
                        <td>
                            <?php echo $comparative_statement['mode_name']; ?>
                        </td>

                        <td>
                             
                            <?php  if (in_array(3, $this->role)) {  ?>    
                                <a href="<?php echo site_url('comparative_statement/edit_comparative_statement/'.$comparative_statement['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php } ?>   
                            
                           <?php  if (in_array(4, $this->role)) {  ?>         
                                <a href="<?php echo site_url('comparative_statement/details_comparative_statement/'.$comparative_statement['id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                           <?php } ?>
                           <?php if(in_array(5, $this->role)){?>                                        
                                    <button onclick="delete_row('<?php echo site_url('comparative_statement/delete_comparative_statement/'.$comparative_statement['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>                              
                           <?php } ?>  
                                    
                          
                                         
                                    
                                    
                                    
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>
