<style>
    .btn-sm{
        padding:3px 3px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $user_type = $this->session->userdata('user_type');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(1, 4, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; ">Item  Information List</h2>
    <hr>-->
<div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                  <?php $this->role = checkUserPermission(1, 5, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'department') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/department'); ?>">
                        <i class="fa fa-cubes"></i><br><span>PROJECT</span></a>
                </li>
                <?php }?>
                
                <?php $this->role = checkUserPermission(1, 4, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>           
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'item_information') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/item_information'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>MATERIAL</span></a>
                </li>
                <?php } ?>
                
                <?php $this->role = checkUserPermission(1, 2, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>      
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'item_category') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/item_category'); ?>">
                            <i class="fa fa-cc"></i><br><span>MATERIAL GROUP</span></a>
                    </li>
                <?php } ?>
                    
                 <?php $this->role = checkUserPermission(1, 3, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'item_group_information') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/item_group_information'); ?>">
                            <i class="fa fa-object-group"></i><br><span>MATERIAL CATEGORY</span></a>
                    </li>
                <?php } ?>
                
              <?php $this->role = checkUserPermission(1, 1, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'brand') echo 'active'; ?>" href="<?php echo site_url('backend/brand'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>MATERIAL BRAND</span>
                        </a>
                    </li>
                <?php } ?>        
                    
               <?php $this->role = checkUserPermission(1, 1, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'measurement_unit') echo 'active'; ?>" href="<?php echo site_url('backend/measurement_unit'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>QUANTITY UNIT</span>
                        </a>
                    </li>
                <?php } ?>   
                    
                 <?php $this->role = checkUserPermission(1, 1, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'size_unit') echo 'active'; ?>" href="<?php echo site_url('backend/size_unit'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>MATERIAL SIZE UNIT</span>
                        </a>
                    </li>
                <?php } ?>        
                
                 <?php $this->role = checkUserPermission(1, 33, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'service_info') echo 'active'; ?>" href="<?php echo site_url('backend/services'); ?>">
                            <i class="fa fa-wrench"></i><br><span>SUBCON JOB</span>
                        </a>
                    </li>
                <?php } ?>     
                    
                <?php $this->role = checkUserPermission(1, 1, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'service_group') echo 'active'; ?>" href="<?php echo site_url('backend/service_group'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>SUBCON JOB CATEGORY</span>
                        </a>
                    </li>
                <?php } ?>      
                
                <?php $this->role = checkUserPermission(1, 1, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'supplier_information') echo 'active'; ?>" href="<?php echo site_url('backend/general_store'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>SUPPLIERS/SUBCONTRACTORS</span>
                    </a>
                </li>
                <?php } ?> 
                
                <?php $this->role = checkUserPermission(1, 35, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'payment_mode') echo 'active'; ?>" href="<?php echo site_url('backend/payment_mode'); ?>">
                           <i class="fa fa-align-justify"></i><br><span>PAYMENT INFO  </span>
                        </a>
                    </li>
                <?php } ?>     
                    
                <?php $this->role = checkUserPermission(1, 35, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'payment_security') echo 'active'; ?>" href="<?php echo site_url('backend/payment_security'); ?>">
                           <i class="fa fa-align-justify"></i><br><span>PAYMENT SECURITY INFO  </span>
                        </a>
                    </li>
                <?php } ?>     
                    
              
                 
               
                
                 <?php $this->role = checkUserPermission(1, 34, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'indent_type') echo 'active'; ?>" href="<?php echo site_url('backend/indent_type'); ?>">
                            <i class="fa fa-align-justify"></i><br><span>INDENT TYPE  </span>
                        </a>
                    </li>
                <?php } ?> 
                
              <!--
                <?php $this->role = checkUserPermission(1, 6, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'cost_center') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/cost_center'); ?>">
                        <i class="fa fa-home"></i><br><span>COST CENTER</span></a>
                </li>
                <?php }?>
              -->
                <?php $this->role = checkUserPermission(1, 36, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'designation') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/designation'); ?>">
                        <i class="fa fa-certificate"></i><br><span>DESIGNATION</span></a>
                </li>
                <?php }?>
                <?php $this->role = checkUserPermission(1, 37, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'employee') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/employee'); ?>">
                        <i class="fa fa-user"></i><br><span>WCL USERS</span></a>
                </li>
                <?php } ?>
                <?php //$this->role = checkUserPermission(1, 38, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>   
                <?php if($user_type==1){ ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->sub_inner_menu == 'acl') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/acl'); ?>">
                                <i class="fa fa-user-times"></i><br><span>ACL ROLE</span></a>
                        </li>
                <?php } ?>    
                <?php //}?>
            </ul>
        </div>
    </div>
<div class="right_content">
     <?php $this->role = checkUserPermission(1, 4, $userData);  if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('general_store/add_item_information'); ?>" class="btn btn-sm btn-primary">ADD ITEM</a><a href="<?php echo site_url('bulk_import'); ?>" style="float:right;" class="btn btn-sm btn-primary">BULK IMPORT</a>
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Item ID</th>
                <th>Type1</th>
                <th>Type2</th>
                <th>Brand Name</th>
                <th>Origin</th>
                <th>Grade</th>
                <th>Code</th>
                <th>Size</th>
                <th>Unit</th>
                <th>Consumable/Asset</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($items)) {
                foreach ($items as $item) { ?>
                    <tr>
                        <td>
                               <?php echo $item['item_name']; ?>
                        </td>
                        
                        <td>
                               <?php echo $item['item_code']; ?>
                        </td>
                        <td>
                                <?php echo $item['type1']; ?>
                        </td>
                                           
                        <td>
                                 <?php echo $item['type2']; ?>
                        </td>
                        
                         <td>
                                 <?php echo $item['item_brands']; ?>
                        </td>
                        <td>
                                 <?php echo $item['origin']; ?>
                        </td>
                        <td>
                                 <?php echo $item['item_grade']; ?>
                        </td>
                        <td>
                                  <?php echo $item['item_own_code']; ?>
                        </td>
                        <td>
                                  <?php echo $item['size']; ?>
                        </td>
                        <td>
                                  <?php echo $item['meas_unit']; ?>
                        </td>
                        <td>
                                  <?php echo $item['item_type']; ?>
                        </td>
                        <td>
                                   <?php echo $item['remark']; ?>
                        </td>
                  
                       
                  

                        <td>
                            <?php  if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('general_store/edit_item_information/'.$item['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php } ?>
                            <?php  if (in_array(4, $this->role)) { ?>    
                                <a href="<?php echo site_url('general_store/details_item_information/'.$item['id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                            <?php } ?> 
                            <?php  if (in_array(5, $this->role)) { ?>    
                                <button onclick="delete_row('<?php echo site_url('general_store/delete_item_information/'.$item['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                            <?php } ?>    
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>
