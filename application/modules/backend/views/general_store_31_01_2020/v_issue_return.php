<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(3, 10, $userData);
              
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; "> Return Receive  List</h2>
    <hr>-->
<div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(3, 9, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>   
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'material_receive_requisition') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/material_receive_requisition'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>MATERIAL RECEIVE  </span>
                    </a>
                </li>
                <?php } ?> 
                
                <?php $this->role = checkUserPermission(3, 10, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'issue_return') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/issue_return'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>MATERIAL RECEIVE  </span>
                    </a>
                </li>
                <?php } ?> 
                <?php $this->role = checkUserPermission(3, 11, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'mrr_return_receive') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/mrr_return_receive'); ?>">
                        <i class="fa fa-cc"></i><br><span>MRR RETURN RECEIVE</span></a>
                </li>
                <?php } ?>
               
            </ul>
        </div>
    </div>
    
    <div class="right_content">
    <?php  if (in_array(2, $this->role)) {  ?> 
        <a href="<?php echo site_url('general_store/add_issue_return'); ?>" class="btn btn-sm btn-primary">ADD RETURN RECEIVE</a>
    <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Issue Return No</th>
                <th class="col-lg-1">Return Date</th>
                <th class="col-lg-1">Status</th>
               
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($issue_returns)) {
                foreach ($issue_returns as $issue_return) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($issue_return['ir_no'])) echo $issue_return['ir_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($issue_return['ir_date'])) echo date('d-m-Y',strtotime($issue_return['ir_date'])); ?>
                        </td>
                        <td>
                            <?php if(!empty($issue_return['ir_status'])) echo $issue_return['ir_status']; ?>
                        </td>
                      
                        

                        <td>
                            <?php  if (in_array(3, $this->role)) {  ?> 
                                <a href="<?php echo site_url('general_store/edit_issue_return/'.$issue_return['ir_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php } ?> 
                            <?php  if (in_array(4, $this->role)) {  ?>     
                                <a href="<?php echo site_url('general_store/details_issue_return/'.$issue_return['ir_id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                            <?php } ?> 
                            <?php  if (in_array(5, $this->role)) {  ?>     
                                <button onclick="delete_row('<?php echo site_url('general_store/delete_issue_return/'.$issue_return['ir_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                            <?php } ?>
                            <?php  if (in_array(2, $this->role)) {  ?>      
                                <?php if($issue_return['ir_status']=="applied" || $issue_return['ir_status']=="not received" ){ ?>
                                   <a href="<?php echo site_url('general_store/receive_issue_return/'.$issue_return['ir_id']); ?>"><button class="btn btn-sm btn-success">Receive</button></a>
                               <?php }else{ ?>
                                   <a href="<?php echo site_url('general_store/reject_issue_return/'.$issue_return['ir_id']); ?>"><button class="btn btn-sm btn-warning">Reject</button></a>
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
