<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
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
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3 style="float:left;">Details Item Information</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('general_store/add_item_information'); ?>" class="btn btn-sm btn-warning">Add Item</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">    





                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group row">
                                    <div class="col-sm-3  labeltext" style="text-align: right;"><label for="inputdefault">Consumable/Asset :</label></div>
                             

                                    <div class="col-sm-8 col-md-8 "> 
                                        <b><?php if (!empty($item[0]['item_type']) && $item[0]['item_type'] == "CONSUMABLE") echo "CONSUMABLE"; ?>
                                        <?php if (!empty($item[0]['item_type']) && $item[0]['item_type'] == "ASSET") echo "ASSET"; ?> </b> 

                                        
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3   labeltext" style="text-align: right"><label for="inputdefault">Item Category :</label></div>
                                    <div class="col-sm-8 col-md-8 "> 
                                        
                                        <b>  <?php foreach ($item_groups as $item_group) { ?>
                                                <?php if (!empty($item[0]['item_group']) && ($item[0]['item_group'] == $item_group['id'])) echo $item_group['item_group']; ?>
                                            <?php } ?>
                                        </b>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                              <div class="col-md-6">

                                <div class="form-group row" id="" style="">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Item Group :</label></div>
                                    <div class="col-sm-8 col-md-8 ">
                                        
                                            <b><?php foreach ($categories as $category) { ?>
                                              <?php if (!empty($item[0]['item_category']) && ($item[0]['item_category'] == $category['c_id'])) echo $category['c_name']; ?>
                                            <?php } ?>
                                            </b>
                                        
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group row">
                                    <div class="col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Item ID :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['item_code'])) echo $item[0]['item_code']; ?></b></div>
                                </div>

                            </div>
                           

                        </div>
                        
                        <div class="row">
                                <div class="col-md-6">

                                   <div class="form-group row">
                                       <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Item Name  :</label></div>
                                       <div class="col-sm-8 col-md-8 "> <b><?php if (!empty($item[0]['item_name'])) echo $item[0]['item_name']; ?></b></div>
                                   </div>
                               </div>  
                            
                               <div class="col-md-6">
                                <div class="form-group row">
                                    <div class=" col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Unit of Quantity :</label></div>
                                    <div class="col-sm-8 col-md-8 ">
                                        <b>  
                                    <?php foreach($measurement_units as $measurement_unit){ ?>
                                           <?php if($item[0]['mu_id']==$measurement_unit['id'])  echo $measurement_unit['meas_unit']; ?>
                                    <?php } ?>
                                       </b>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                       
                         

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3 labeltext" style="text-align: right"><label for="inputdefault">Brand :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['brand'])) echo $item[0]['brand']; ?></b></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-3  labeltext" style="text-align: right"><label for="inputdefault">Origin :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['origin'])) echo $item[0]['origin']; ?></b></div>
                                </div>
                            </div>
                        </div>

                       
                     


                      
                        

                        <div class="row">

                           <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Store Location :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['store_location'])) echo $item[0]['store_location']; ?></b></div>
                                </div>
                            </div>

                           <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Remark :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['remark'])) echo $item[0]['remark']; ?></b></div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">

                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/general_store/item_information') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                                </div>       

                            </div>

                            <div class="col-md-2">
                                <div class="row">
                                    <!--
                            <div class="col-md-12">
                                <button type="button" class="btn btn-default button">SIMILAR LIST</button>
                            </div>-->
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



