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
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(2, 7, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'ipo_material_indent') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/ipo_material_indent'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>MATERIAL INDENT  </span>
                    </a>
                </li>
                <?php } ?> 
                <?php $this->role = checkUserPermission(2, 8, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'budget') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/budget'); ?>">
                        <i class="fa fa-cc"></i><br><span>BUDGET</span></a>
                </li>
                <?php } ?>
                
               <?php $this->role = checkUserPermission(2, 39, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'money_indent') echo 'active'; ?>" href="<?php echo site_url('backend/money_indent'); ?>">
                        <i class="fa fa-cc"></i><br><span>MONEY INDENT</span></a>
                </li>
                <?php } ?>
                <!--
                <?php $this->role = checkUserPermission(2, 40, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'purchase_quotation') echo 'active'; ?>" href="<?php echo site_url('backend/purchase_quotations'); ?>">
                            <i class="fa fa-cc"></i><br><span>PURCHASE QUOTATION</span></a>
                    </li>
                <?php } ?>
                -->
                <?php $this->role = checkUserPermission(2, 41, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'purchase_order') echo 'active'; ?>" href="<?php echo site_url('backend/purchase_orders'); ?>">
                            <i class="fa fa-cc"></i><br><span>PURCHASE ORDER</span></a>
                    </li>
                <?php } ?>     
                    
               
            </ul>
        </div>
    </div>
<div class="right_content">
     <?php $this->role = checkUserPermission(2, 8, $userData);  if (in_array(2, $this->role)) {  ?>
        <a href="<?php echo site_url('general_store/add_budget'); ?>" class="btn btn-sm btn-primary">ADD BUDGET</a>
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                 <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Budget Number</th>
               
              <!--  <th class="col-lg-1">Budget Type</th>-->
               
              
               
                <th class="col-lg-1">Status</th>
                
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($budgets)) {
                foreach ($budgets as $budget) { 
                    $adder_id = $budget['employeeId'];
                    $user_info = $this->m_common->get_row_array("users", array('employeeId' =>$adder_id), "*");
                    $approver =fetch_approver(2, 8, $user_info);
                    ?>
                    <tr>
                        <td>
                            <?php echo date('d-m-Y',strtotime($budget['b_date'])); ?>
                        </td>
                        <td>
                            <?php echo $budget['b_no']; ?>
                        </td>
                       <!--
                        <td>
                            <?php //echo $budget['b_type']; ?>
                        </td>
                       -->
                         
                        
                        
                        <td>
                             <?php if($budget['b_approve_status']=="pending"){ ?>
                                    <span style="color:#CE9208;"> <?php echo $budget['b_approve_status']; ?></span>
                              <?php }else{ ?>
                                    <span style=""> <?php echo $budget['b_approve_status']; ?></span>
                              <?php } ?>
                            
                            <?php //echo $budget['b_status']; ?>
                        </td>
                      

                        <td>
                             <?php if($budget['b_approve_status']=="Pending"){ ?>
                                <?php  if (in_array(3, $this->role)) {  ?>    
                                    <a href="<?php echo site_url('general_store/edit_budget/'.$budget['b_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php } ?>   
                             <?php }else{?>
                               <?php  if (in_array(3, $this->role)) {  ?>     
                                    <button class="btn btn-sm btn-info">Edit</button>
                               <?php } ?>      
                            <?php } ?>
                           <?php  if (in_array(4, $this->role)) {  ?>         
                                <a href="<?php echo site_url('general_store/details_budget/'.$budget['b_id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                           <?php } ?>
                           <?php  if(in_array(5, $this->role)){  ?>        
                                <?php if($budget['b_approve_status']=="Pending"){ ?>
                                    <button onclick="delete_row('<?php echo site_url('general_store/delete_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                <?php }else{?>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                <?php } ?> 
                           <?php } ?>    
                                    
                           <?php  if($user_type == 1){ ?>  
                                  <?php if($budget['b_approve_status']=="Approved"){ ?>                             
                                        <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                  <?php }else if($budget['b_status']=="Rejected"){ ?>
                                        <button onclick="approve('<?php echo site_url('general_store/approve_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                   <?php }else{ ?>
                                        <button onclick="approve('<?php echo site_url('general_store/approve_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                        <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                   <?php } ?>
                               
                                 
                          <?php }else{ ?>   
                                 
                                    <?php  if($employee_id == $approver[0]) {  ?>
                                         <?php  if(!empty($approver[1]) ) { ?>   
                                                 <button onclick="approve('<?php echo site_url('general_store/forward_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                                 <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php }else{ ?> 
                                                <button onclick="approve('<?php echo site_url('general_store/approve_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php } ?>              

                                   <?php } ?>  
                                                
                                    <?php  if($employee_id == $approver[1]) {  ?>
                                         <?php  if(!empty($approver[2]) ) { ?>
                                                 <button onclick="approve('<?php echo site_url('general_store/forward_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                                 <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php }else{ ?> 
                                                <button onclick="approve('<?php echo site_url('general_store/approve_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php } ?>              

                                   <?php } ?>  
                                                
                                    <?php  if($employee_id == $approver[2]) {  ?>
                                         <?php  if(!empty($approver[3]) ) { ?>
                                                <button onclick="approve('<?php echo site_url('general_store/forward_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                                <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>       
                                         <?php }else{ ?> 
                                                <button onclick="approve('<?php echo site_url('general_store/approve_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php } ?>              

                                   <?php } ?>     
                                                
                                     <?php  if($employee_id == $approver[3]) {  ?>
                                         
                                             <button onclick="approve('<?php echo site_url('general_store/approve_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                             <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget['b_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            

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
