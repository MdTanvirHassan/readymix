<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(4, 12, $userData);
              
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; ">Issue Info List</h2>
    <hr>-->
<div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(4, 12, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>  
                
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'issue_session') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/issue_session'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>MATERIAL ISSUE  </span>
                    </a>
                </li>
                <?php } ?> 
                <?php $this->role = checkUserPermission(4, 13, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>        
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'store_return') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/store_return'); ?>">
                        <i class="fa fa-cc"></i><br><span>RETURN</span></a>
                </li>
                <?php } ?>
               
            </ul>
        </div>
    </div>

<div class="right_content">
    <?php  if (in_array(2, $this->role)) {  ?> 
        <a href="<?php echo site_url('general_store/add_issue_session'); ?>" class="btn btn-sm btn-primary">ADD ISSUE</a>
    <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-2">Issue No</th>
                <th class="col-lg-2">Issue Date</th>
                <th class="col-lg-2">Status</th>
                
               
               
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($issue_sessions)) {
                foreach ($issue_sessions as $issue_session) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($issue_session['issue_no'])) echo $issue_session['issue_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($issue_session['issue_date'])) echo date('d-m-Y',strtotime($issue_session['issue_date'])); ?>
                        </td>
                        <td>
                            <?php if(!empty($issue_session['issue_status'])) echo $issue_session['issue_status']; ?>
                        </td>
                       
                        
                        

                        <td>
                         <?php  if (in_array(3, $this->role)) {  ?>    
                             <a href="<?php echo site_url('general_store/edit_issue_session/'.$issue_session['issue_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                         <?php } ?>  
                         <?php  if (in_array(4, $this->role)) {  ?>    
                             <a href="<?php echo site_url('general_store/details_issue_session/'.$issue_session['issue_id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                         <?php } ?>
                         <?php  if (in_array(5, $this->role)) {  ?>     
                             <button onclick="delete_row('<?php echo site_url('general_store/delete_issue_session/'.$issue_session['issue_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                         <?php } ?>   
                          
                            <!--
                            <?php  if (in_array(2, $this->role)) {  ?>    
                                <?php if($issue_session['issue_status']=="applied" || $issue_session['issue_status']=="rejected" ){ ?>
                                    <a href="<?php echo site_url('general_store/issued_material_indent/'.$issue_session['issue_id']); ?>"><button class="btn btn-sm btn-success">Issue</button></a>
                                <?php }else{ ?>
                                     <a href="<?php echo site_url('general_store/reject_material_indent/'.$issue_session['issue_id']); ?>"><button class="btn btn-sm btn-warning">Reject</button></a>
                                <?php } ?>
                            <?php } ?>
                            -->
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>


