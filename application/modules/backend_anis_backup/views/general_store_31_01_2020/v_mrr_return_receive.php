<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(3, 11, $userData);
              
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; "> Mrr Return Receive  List</h2>
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
                <!--
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'issue_return') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/issue_return'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>MATERIAL RECEIVE  </span>
                    </a>
                </li>
                -->
                <?php } ?> 
                
                 <?php $this->role = checkUserPermission(3, 13, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>        
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->sub_inner_menu == 'store_return') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/store_return'); ?>">
                                <i class="fa fa-cc"></i><br><span>RETURN</span></a>
                        </li>
                <?php } ?>
                
                <?php $this->role = checkUserPermission(3, 11, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'mrr_return_receive') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/mrr_return_receive'); ?>">
                        <i class="fa fa-cc"></i><br><span>MRR RETURN RECEIVE</span></a>
                </li>
                <?php } ?>
                
                <?php $this->role = checkUserPermission(3,43, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->sub_inner_menu == 'consumption') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/consumption'); ?>">
                                <i class="fa fa-cc"></i><br><span>Consume</span></a>
                        </li>
                <?php } ?>
               <?php $this->role = checkUserPermission(3,47, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'transfer') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/transfer'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Transfer</span>
                    </a>
                </li>
                <?php } ?> 
                    
                        
               
            </ul>
        </div>
    </div>
    
    <div class="right_content">
     <?php $this->role = checkUserPermission(3, 11, $userData); if (in_array(2, $this->role)) {  ?> 
        <a href="<?php echo site_url('general_store/add_mrr_return_receive'); ?>" class="btn btn-sm btn-primary">ADD MRR RETURN RECEIVE</a>
     <?php } ?>   
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                
                <th class="col-lg-2">Mrr Return Receive No</th>
                <th class="col-lg-2">Receive Date</th>
                <th class="col-lg-2">Status</th>
               
               
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($mrr_return_receives)) {
                foreach ($mrr_return_receives as $mrr_return_receive) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($mrr_return_receive['mrr_rr_no'])) echo $mrr_return_receive['mrr_rr_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($mrr_return_receive['receive_date'])) echo $mrr_return_receive['receive_date']; ?>
                        </td>
                        <td>
                            <?php if(!empty($mrr_return_receive['mrr_rr_status'])) echo $mrr_return_receive['mrr_rr_status']; ?>
                        </td>
                        
                        

                        <td>
                            <?php  if (in_array(3, $this->role)) {  ?> 
                                <a href="<?php echo site_url('general_store/edit_mrr_return_receive/'.$mrr_return_receive['mrr_rr_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php } ?>  
                           <?php  if (in_array(4, $this->role)) {  ?>      
                                <a href="<?php echo site_url('general_store/details_mrr_return_receive/'.$mrr_return_receive['mrr_rr_id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                           <?php } ?>
                           <?php  if (in_array(5, $this->role)) {  ?> 
                                <button onclick="delete_row('<?php echo site_url('general_store/delete_mrr_return_receive/'.$mrr_return_receive['mrr_rr_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                           <?php } ?> 
                           <?php  if (in_array(2, $this->role)) {  ?>     
                                <?php if($mrr_return_receive['mrr_rr_status']=="applied" || $mrr_return_receive['mrr_rr_status']=="not received" ){ ?>
                                   <a href="<?php echo site_url('general_store/receive_mrr_return_receive/'.$mrr_return_receive['mrr_rr_id']); ?>"><button class="btn btn-sm btn-success">Receive</button></a>
                               <?php }else{ ?>
                                    <a href="<?php echo site_url('general_store/reject_mrr_return_receive/'.$mrr_return_receive['mrr_rr_id']); ?>"><button class="btn btn-sm btn-warning">Reject</button></a>
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
