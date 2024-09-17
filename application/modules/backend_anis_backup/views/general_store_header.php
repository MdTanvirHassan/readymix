<div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                  <?php $this->role = checkUserPermission(1, 5, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'department') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/department'); ?>">
                        <i class="fa fa-cubes"></i><br><span>Branch</span></a>
                </li>
                <?php }?>
                
                <?php $this->role = checkUserPermission(1, 4, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>           
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'cost_center') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/cost_center'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Cost Center</span></a>
                    </li>
                <?php } ?>
                
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
                
              <?php $this->role = checkUserPermission(1, 72, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'brand') echo 'active'; ?>" href="<?php echo site_url('backend/brand'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>MATERIAL BRAND</span>
                        </a>
                    </li>
                <?php } ?>        
                    
               <?php $this->role = checkUserPermission(1, 73, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'measurement_unit') echo 'active'; ?>" href="<?php echo site_url('backend/measurement_unit'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>QUANTITY UNIT</span>
                        </a>
                    </li>
                <?php } ?>       
                    
                 <?php $this->role = checkUserPermission(1, 74, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'size_unit') echo 'active'; ?>" href="<?php echo site_url('backend/size_unit'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>MATERIAL SIZE UNIT</span>
                        </a>
                    </li>
                <?php } ?>            
                
                 <?php $this->role = checkUserPermission(1, 33, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'service_info') echo 'active'; ?>" href="<?php echo site_url('backend/services'); ?>">
                            <i class="fa fa-wrench"></i><br><span>SERVICE</span>
                        </a>
                    </li>
                <?php } ?>     
                    
                <?php $this->role = checkUserPermission(1, 75, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'service_group') echo 'active'; ?>" href="<?php echo site_url('backend/service_group'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>SERVICE CATEGORY</span>
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
                    
                <?php $this->role = checkUserPermission(1,96, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'dept_info') echo 'active'; ?>" href="<?php echo site_url('backend/department'); ?>">
                           <i class="fa fa-align-justify"></i><br><span>DEPARTMENT INFO  </span>
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
                
                <?php $this->role = checkUserPermission(1,76, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'purchase_condition') echo 'active'; ?>" href="<?php echo site_url('backend/purchase_condition'); ?>">
                        <i class="fa fa-user"></i><br><span>Purchase Condition</span></a>
                </li>
                <?php } ?>
                
                <?php $this->role = checkUserPermission(1,76, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'term_condition') echo 'active'; ?>" href="<?php echo site_url('backend/termcondition_template'); ?>">
                        <i class="fa fa-user"></i><br><span>Terms & Conditions</span></a>
                </li>
                <?php } ?>
                
                
                <?php $this->role = checkUserPermission(1,76, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'copy_to') echo 'active'; ?>" href="<?php echo site_url('backend/copy_to'); ?>">
                        <i class="fa fa-user"></i><br><span>COPY TO</span></a>
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