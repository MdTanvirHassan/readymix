<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(3, 9, $userData);
              
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">

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
                                <i class="fa fa-cc"></i><br><span>Consumption</span></a>
                        </li>
                <?php } ?>
                        
               <?php $this->role = checkUserPermission(3,47, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'transfer') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/transfer'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Transfer</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'from_transfer') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/fromTransfer'); ?>">
                        <i class="fa fa-cc"></i><br><span>Received Transfer Item </span></a>
                </li>
                <?php } ?> 
                
               <?php $this->role = checkUserPermission(3, 9, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>   
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'current_stock') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/currentStock'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Current Stock</span>
                    </a>
                </li>
             <?php } ?>    
               
                        
               
            </ul>
        </div>
    </div>
    
    <div class="right_content">
    <?php $this->role = checkUserPermission(3, 9, $userData);  if (in_array(2, $this->role)) {  ?> 
        <a href="<?php echo site_url('general_store/add_material_receive_requisition'); ?>" class="btn btn-sm btn-primary">ADD MRR</a>
    <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">MRR No</th>
                <th class="col-lg-1">MRR Date</th>
           
                <th class="col-lg-1">Status</th>
               
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($mrrs)) {
                foreach ($mrrs as $mrr) { ?>
                    <tr>
                        <td>
                            <?php echo $mrr['mrr_no']; ?>
                        </td>
                        <td>
                            <?php echo $mrr['mrr_date']; ?>
                        </td>
                     
                        
                          <td>
                              <?php if($mrr['mrr_status']=="applied"){ ?>
                                    <span style="color:#CE9208;"> <?php echo $mrr['mrr_status']; ?></span>
                              <?php }else{ ?>
                                    <span style=""> <?php echo $mrr['mrr_status']; ?></span>
                              <?php } ?>
                        </td>

                        <td>
                            <?php  if (in_array(3, $this->role)) {  ?> 
                                <?php if($mrr['mrr_status']=="Pending" ){ ?>
                                    <a href="<?php echo site_url('general_store/edit_material_receive_requisition/'.$mrr['mrr_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php }else{ ?>  
                                        <button class="btn btn-sm btn-info">Edit</button>
                                <?php } ?>
                            <?php } ?>
                           <?php  if (in_array(4, $this->role)) {  ?>              
                                <a href="<?php echo site_url('general_store/details_material_receive_requisition/'.$mrr['mrr_id']); ?>"><button class="btn btn-sm btn-primary">Details</button></a>
                           <?php } ?> 
                            <?php  if (in_array(5, $this->role)) {  ?>     
                                <?php if($mrr['mrr_status']=="Pending" ){ ?>
                                     <button onclick="delete_row('<?php echo site_url('general_store/delete_material_receive_requisition/'.$mrr['mrr_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                 <?php }else{ ?>  
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                <?php } ?>
                            <?php } ?>             
                            <?php //if($mrr['mrr_status']=="applied" || $mrr['mrr_status']=="rejected" ){ ?>
                            <?php  if (in_array(2, $this->role)){  ?>             
                                <?php if($mrr['mrr_status']=="Pending" ){ ?>
                                   <a href="<?php echo site_url('general_store/receive_material_receive_requisition/'.$mrr['mrr_id']); ?>"><button class="btn btn-sm btn-success">Receive</button></a>
                               <?php }else{ ?>
                                 <!--   <a href="<?php echo site_url('general_store/reject_material_receive_requisition/'.$mrr['mrr_id']); ?>"><button class="btn btn-sm btn-warning">Reject</button></a> -->
                               <?php } ?>
                            <?php }  ?>        
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>


