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
     <?php $this->role = checkUserPermission(2, 39, $userData); if (in_array(2, $this->role)) {  ?>
        <a href="<?php echo site_url('money_indent/add_money_indent'); ?>" class="btn btn-sm btn-primary">ADD MONEY INDENT</a>
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Indent Number</th>   
              <!--  <th class="col-lg-1">Total Amount</th>  -->
                <th class="col-lg-1">Status</th>    
                <th class="col-lg-1">Approver Name</th>    
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($money_indents)) {
                foreach ($money_indents as $money_indent) { 
                    $adder_id = $money_indent['applicant_id'];
                    $user_info = $this->m_common->get_row_array("users", array('employeeId' => $adder_id), "*");
                    $approver =fetch_approver(2, 39, $user_info);
                    ?>
                    <tr>
                        <td>
                            <?php echo date('d-m-Y',strtotime($money_indent['date'])); ?>
                        </td>
                       
                        <td>
                            <?php echo $money_indent['mo_indent_no']; ?>
                        </td>
                        <!--
                        <td>
                            <?php echo $money_indent['total_amount']; ?>
                        </td>
                        -->
                        <td>
                             <?php if($money_indent['status']=="pending"){ ?>
                                    <span style="color:#CE9208;"> <?php echo $money_indent['status']; ?></span>
                              <?php }else{ ?>
                                    <span style=""> <?php echo $money_indent['status']; ?></span>
                              <?php } ?>
                            
                            <?php //echo $money_indent['b_status']; ?>
                        </td>
                        <td>
                            <?php echo $money_indent['approver_name']; ?>
                        </td>

                        <td>
                             <?php if($money_indent['status']=="Pending"){ ?>
                                    <?php  if (in_array(3, $this->role)) {  ?>    
                                        <a href="<?php echo site_url('money_indent/edit_money_indent/'.$money_indent['mi_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                    <?php } ?>   
                             <?php }else{?>
                                <?php  if (in_array(3, $this->role)) {  ?>     
                                     <button class="btn btn-sm btn-info">Edit</button>
                                <?php } ?>      
                            <?php } ?>
                           <?php  if (in_array(4, $this->role)) {  ?>         
                                <a href="<?php echo site_url('money_indent/details_money_indent/'.$money_indent['mi_id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                           <?php } ?>
                           <?php  if(in_array(5, $this->role)){  ?>        
                                <?php if($money_indent['status']=="Pending"){ ?>
                                    <button onclick="delete_row('<?php echo site_url('money_indent/delete_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                <?php }else{?>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                <?php } ?> 
                           <?php } ?>  
                                    
                          
                          <?php  if($user_type == 1){ ?>  
                                  <?php if($money_indent['status']=="Approved"){ ?>                             
                                        <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                  <?php }else if($money_indent['status']=="Rejected"){ ?>
                                        <button onclick="approve('<?php echo site_url('money_indent/approve_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                   <?php }else{ ?>
                                        <button onclick="approve('<?php echo site_url('money_indent/approve_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                        <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                   <?php } ?>
                               
                                 
                          <?php }else{ ?>   
                                 
                                    <?php  if($employee_id == $approver[0]) {  ?>
                                         <?php  if(!empty($approver[1]) ) { ?>   
                                                 <button onclick="approve('<?php echo site_url('money_indent/forward_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                                 <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php }else{ ?> 
                                                <button onclick="approve('<?php echo site_url('money_indent/approve_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php } ?>              

                                   <?php } ?>  
                                                
                                    <?php  if($employee_id == $approver[1]) {  ?>
                                         <?php  if(!empty($approver[2]) ) { ?>
                                                 <button onclick="approve('<?php echo site_url('money_indent/forward_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                                 <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php }else{ ?> 
                                                <button onclick="approve('<?php echo site_url('money_indent/approve_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php } ?>              

                                   <?php } ?>  
                                                
                                    <?php  if($employee_id == $approver[2]) {  ?>
                                         <?php  if(!empty($approver[3]) ) { ?>
                                                <button onclick="approve('<?php echo site_url('money_indent/forward_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                                <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>       
                                         <?php }else{ ?> 
                                                <button onclick="approve('<?php echo site_url('money_indent/approve_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php } ?>              

                                   <?php } ?>     
                                                
                                     <?php  if($employee_id == $approver[3]) {  ?>
                                         
                                             <button onclick="approve('<?php echo site_url('money_indent/approve_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                             <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent['mi_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            

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
