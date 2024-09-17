<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
             <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(1, 1, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'supplier_information') echo 'active'; ?>" href="<?php echo site_url('backend/general_store'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Supplier Info</span>
                    </a>
                </li>
                <?php } ?> 
                <?php $this->role = checkUserPermission(1, 33, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'service_info') echo 'active'; ?>" href="<?php echo site_url('backend/services'); ?>">
                        <i class="fa fa-wrench"></i><br><span>Service Info  </span>
                    </a>
                </li>
                <?php } ?> 
                
                 <?php $this->role = checkUserPermission(1, 34, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'indent_type') echo 'active'; ?>" href="<?php echo site_url('backend/indent_type'); ?>">
                            <i class="fa fa-align-justify"></i><br><span>Indent Type  </span>
                        </a>
                    </li>
                <?php } ?> 
                    
               <?php $this->role = checkUserPermission(1, 35, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'payment_mode') echo 'active'; ?>" href="<?php echo site_url('backend/payment_mode'); ?>">
                           <i class="fa fa-align-justify"></i><br><span>Payment Mode  </span>
                        </a>
                    </li>
                <?php } ?>      
                
                <?php $this->role = checkUserPermission(1, 2, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>      
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'item_category') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/item_category'); ?>">
                        <i class="fa fa-cc"></i><br><span>ITEM CATEGORY</span></a>
                </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(1, 3, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'item_group_information') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/item_group_information'); ?>">
                        <i class="fa fa-object-group"></i><br><span>ITEM GROUP</span></a>
                </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(1, 4, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>           
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'item_information') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/item_information'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>ITEM Info</span></a>
                </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(1, 5, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'department') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/department'); ?>">
                        <i class="fa fa-cubes"></i><br><span>UNIT</span></a>
                </li>
                <?php }?>
                <?php $this->role = checkUserPermission(1, 6, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'cost_center') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/cost_center'); ?>">
                        <i class="fa fa-home"></i><br><span>COST CENTER</span></a>
                </li>
                <?php }?>
                <?php $this->role = checkUserPermission(1, 36, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'designation') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/designation'); ?>">
                        <i class="fa fa-certificate"></i><br><span>DESIGNATION</span></a>
                </li>
                <?php }?>
                <?php $this->role = checkUserPermission(1, 37, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'employee') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/employee'); ?>">
                        <i class="fa fa-user"></i><br><span>USERS</span></a>
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
                                    <div class="col-sm-3  labeltext" style="text-align: right;"><label for="inputdefault">Item Type :</label></div>
                             

                                    <div class="col-sm-8 col-md-8 "> 
                                        <b><?php if (!empty($item[0]['item_type']) && $item[0]['item_type'] == "Consumable") echo "Consumable"; ?>
                                         <?php if (!empty($item[0]['item_type']) && $item[0]['item_type'] == "Asset") echo "Asset"; ?> </b> 

                                        
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3   labeltext" style="text-align: right"><label for="inputdefault">Item Group :</label></div>
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

                                <div class="form-group row">
                                    <div class="col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Item Code :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['item_code'])) echo $item[0]['item_code']; ?></b></div>
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group row">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Item Name  :</label></div>
                                    <div class="col-sm-8 col-md-8 "> <b><?php if (!empty($item[0]['item_name'])) echo $item[0]['item_name']; ?></b></div>
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
                                    <div class=" col-md-3  labeltext" style="text-align: right"><label for="inputdefault">M.unit :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['meas_unit'])) echo $item[0]['meas_unit']; ?></b></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!--
                                <div class="form-group row">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Unit Price:</label></div>
                                     <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="unit_price" value="<?php if (!empty($item[0]['unit_price'])) echo $item[0]['unit_price']; ?>" type="text"></div>
                                </div>
                                -->
                                <div class="form-group row">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Part No. :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['port_no'])) echo $item[0]['port_no']; ?></b></div>
                                </div>

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3 labeltext" style="text-align: right"><label for="inputdefault">Opening Stock :</label></div>
                                    <div class="col-sm-8 col-md-5 "><b><?php if (!empty($item[0]['opening_stock'])) echo $item[0]['opening_stock']; ?></b></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class=" col-md-3   labeltext" style="text-align: right"><label for="inputdefault">Unit Price. :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['unit_price'])) echo $item[0]['unit_price']; ?></b></div>
                                </div>
                            </div>


                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Opening Value :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['opening_value'])) echo $item[0]['opening_value']; ?></b></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Store Location :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['store_location'])) echo $item[0]['store_location']; ?></b></div>
                                </div>
                            </div>
                        </div>



                        <div class="row">



                            <div class="col-md-6">

                                <div class="form-group row" id="" style="">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Item Category :</label></div>
                                    <div class="col-sm-8 col-md-8 ">
                                        
                                            <b><?php foreach ($categories as $category) { ?>
                                              <?php if (!empty($item[0]['item_category']) && ($item[0]['item_category'] == $category['c_id'])) echo $category['c_name']; ?>
                                            <?php } ?>
                                            </b>
                                        
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <?php if (!empty($item[0]['item_type']) && $item[0]['item_type'] == "Consumable") { ?>

                                    <div class="form-group row" id="purchase_date" style="display:none;">
                                        <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Purchase Date :</label></div>
                                        <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['purchase_date'])) echo $item[0]['purchase_date']; ?></b></div>
                                    </div>
                                <?php }else { ?>

                                    <div class="form-group row" id="purchase_date" >
                                        <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Purchase Date :</label></div>
                                        <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['purchase_date'])) echo date('d-m-Y', strtotime($item[0]['purchase_date'])); ?></b></div>
                                    </div>
                                <?php } ?>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-6">

                            </div>

                            <div class="col-md-6">

                            </div>
                        </div><!--End Row-->

                        <div class="row">



                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Status :</label></div>
                                    <div class="col-sm-8 col-md-8 ">
                                        <b>   <?php if (!empty($item[0]['item_status']) && $item[0]['item_status'] == "Active") echo "Active"; ?>
                                           <?php if (!empty($item[0]['item_status']) && $item[0]['item_status'] == "Inactive") echo "Inactive"; ?>
                                        </b>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">

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



