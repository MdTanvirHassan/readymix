<?php
    $user_id = $this->session->userdata('user_id');
    $user_type = $this->session->userdata('user_type');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(1, 1, $userData);
?>

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
                
                <?php $this->role = checkUserPermission(1, 1, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'service_group') echo 'active'; ?>" href="<?php echo site_url('backend/service_group'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Service Group</span>
                        </a>
                    </li>
                <?php } ?> 
                    
                <?php $this->role = checkUserPermission(1, 1, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'measurement_unit') echo 'active'; ?>" href="<?php echo site_url('backend/measurement_unit'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Measurement Unit</span>
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
                <h3>Add Supplier</h3>
            </div>
        </div>
    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 <div class="x_content">
                     <form class="form-horizontal" action="<?php echo site_url('general_store/add_supplier_action'); ?>" method="post" enctype="multipart/form-data">
                         <div class="row">   
                                <div class='form-group' >
                             <label for="title" class="col-sm-2 col-md-2 control-label">
                                 Supplier/Contractor <span class="required">*</span> :
                             </label>
                             <div class="col-sm-4 col-md-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-university"></i></span>
                             <select required class="form-control" name="s_type" >
                            <option class="form-control" value="">Select</option>     
                            <option class="form-control" value="Supplier">Supplier</option>
                            <option class="form-control" value="Contractor">Contractor</option>
                        </select>
                                
                        </div>
                        <label for="title" class="col-sm-2 col-md-2 control-label">
                            Supplier/Contractor Id<span class="required">*</span> :
                        </label>
                             <div class="col-sm-4 col-md-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-file-code-o"></i></span>
                             <input type="hidden" name="supplier_code" value="<?php if(!empty($supplier_code)) echo $supplier_code; ?>" >
                         <input class="form-control" name="CODE" type="hidden" value="<?php if(!empty($supplier_auto_code)) echo 'SP'.$supplier_auto_code; ?>">
                         <input disabled class="form-control" name="CODE1" type="text" value="<?php if(!empty($supplier_auto_code)) echo 'SP'.$supplier_auto_code; ?>">
                        </div>
                         </div>
                         </div>
                         
                         <div class="row">  
                                <div class='form-group' >
                                       <label for="title" class="col-sm-2 control-label">
                                           Supplier/Contractor Name<span class="required">*</span> :
                                       </label> 
                                       <div class="col-sm-4 input-group">
                                                   <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                   <input required class="form-control" name="SUP_NAME" type="text" >
                                        </div>
                                        <label for="title" class="col-sm-2 control-label">
                                           Key Person :
                                       </label>
                                        <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                            <input  class="form-control" name="key_person" type="text" >
                                       </div>

                                </div>
                         </div>
                         <div class="row">
                                <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label">
                                        Contact person :
                                    </label>
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input  class="form-control" name="NAME" type="text">
                                    </div>
                                     <label for="title" class="col-sm-2 control-label">
                                        Address :
                                    </label>
                                     <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-adn"></i></span>
                                            <input class="form-control" name="ADDRESS" type="text">
                                     </div>

                                </div>
                         </div>
                         
                         <div class="row">
                                <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            Land Phone :
                                        </label>
                                         <div class="col-sm-4 input-group">
                                             <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                              <input class="form-control" name="LAND_PHONE" type="text">
                                           </div>
                                         <label for="title" class="col-sm-2 control-label">
                                            Mobile Phone :
                                        </label>
                                         <div class="col-sm-4 input-group">
                                             <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                                             <input  class="form-control" name="MOBILE" type="text">
                                         </div>
                                </div>
                         </div>     
                         
                         <div class="row">
                                <div class='form-group' >
                                       <label for="title" class="col-sm-2 control-label">
                                           Email :
                                       </label>
                                       <div class="col-sm-4 input-group">
                                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                              <input  class="form-control" name="EMAIL" type="text">
                                        </div>
                                       <label for="title" class="col-sm-2 control-label">
                                          Fax Number :
                                      </label>
                                       <div class="col-sm-4 input-group">
                                           <span class="input-group-addon"><i class="fa fa-fax"></i></span>
                                           <input class="form-control" name="FAX" type="text">
                                      </div>

                                </div>
                         </div>
                         
                         <div class="row">
                                <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                           Bank Account Name :
                                        </label>
                                        <div class="col-sm-4 input-group">
                                              <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                              <input class="form-control"  name="b_account_name" type="text">
                                        </div>
                                    
                                        <label for="title" class="col-sm-2 control-label">
                                           Bank Account Number :
                                        </label>
                                        <div class="col-sm-4 input-group">
                                              <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                              <input class="form-control"  name="b_account_number" type="text">
                                        </div>
                                </div>
                         </div>
                         
                          <div class="row">
                                <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                           Remarks :
                                        </label>
                                        <div class="col-sm-4 input-group">
                                              <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                              <input class="form-control"  name="remarks" type="text">
                                        </div>
                                    
                                       
                                </div>
                         </div>
                         
                         <div class="row" style="">
                             <h2 style="margin-left:10px;">Services</h2>
                             <?php foreach($services as $service){ ?>
                                    <div class="col-md-3">
                                           <label class="checkbox-inline">
                                              <input type="checkbox" value="<?php echo $service['id']; ?>" name="services[]"><?php echo $service['service_name']; ?>
                                            </label>
                                    </div>   
                             <?php } ?>
                             
                              
                         </div>
                         
                         
                         <div class="form-group" style="margin-top: 40px;">
                                <div class="col-sm-2">
                                   <a href="<?php echo site_url('backend/general_store') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                               </div>
                             
                                <div class=" col-sm-2">
                                    <button type="submit" class="btn btn-primary button">SAVE</button>
                                </div>
                        
                    </div>
                     </form>     
                    </div>
                    </div>
                    </div>
                    </div>
<!--    <h2 style="text-align:center; ">Supplier/Customer's Information Entry/Edit Session</h2>
    <hr>
    <form action="<?php echo site_url('general_store/add_supplier_action'); ?>" method="post">-->
<!--        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Local/Foreign :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <select class="form-control" name="LOCAL">
                            <option class="form-control">Local</option>
                            <option class="form-control">Foreign</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Supplier Code :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <input type="hidden" name="supplier_code" value="<?php if(!empty($supplier_code)) echo $supplier_code; ?>" >
                         <input class="form-control" name="CODE" type="hidden" value="<?php if(!empty($supplier_auto_code)) echo 'SP'.$supplier_auto_code; ?>">
                         <input disabled class="form-control" name="CODE1" type="text" value="<?php if(!empty($supplier_auto_code)) echo 'SP'.$supplier_auto_code; ?>">
                    </div>
                </div>
            </div>
        </div>-->
        
<!--          <div class="row">
              
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Supplier Name  :</label></div>
                        <div class="col-sm-8 col-md-5 "><input required class="form-control" name="SUP_NAME" type="text"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Status :</label></div>
                        <div class="col-sm-8 col-md-5 ">
                            <select class="form-control" name="STATUS">
                                <option class="form-control">Active</option>
                                <option class="form-control">Inactive</option>
                            </select>
                        </div>
                    </div>
            </div>
          </div>     -->

<!--        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Contact person  :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="NAME" type="text"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Contact Address :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="ADDRESS" type="text"></div>
                </div>
            </div>
        </div>-->

<!--        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Land Phone :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" name="LAND_PHONE" type="text"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Mobile Phone :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="MOBILE" type="text"></div>
                </div>
            </div>
        </div>-->

<!--        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">EMAIL :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="EMAIL" type="text"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Fax Number:</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" name="FAX" type="text"></div>
                </div>
            </div>
        </div>-->

<!--        <div class="row">
            
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Status :</label></div>
                    <div class="col-sm-8 col-md-7 ">
                        <select class="form-control" name="STATUS">
                            <option class="form-control">Active</option>
                            <option class="form-control">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">WEBSITE :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control"  name="WEBSITE" type="text"></div>
                </div>
            </div>
        </div>-->
<!--        <hr>
        <div class="row">
           
            <div class="col-md-2 col-md-offset-3">
                <button type="submit" class="btn btn-primary button">SAVE</button>
            </div>
             <div class="col-md-2">
                <a href="<?php echo site_url('backend/general_store') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

            </div>
        </div> -->
            
<!--            <div class="col-md-2">
                <button type="button" class="btn btn-primary button">FIND</button>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-success button">VIEW</button>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-info button">CLEAR</button>
            </div>
            
            <div class="col-md-2">
                <button type="button" class="btn btn-warning button">SAVE</button>
            </div>
            
            <div class="col-md-2">
                <button type="button" class="btn  btn-danger button">EXIT</button>
            </div>-->
<!--        </div>
    </form>-->
</div>
</div>

<script>
$('.select2').select2();
</script>
