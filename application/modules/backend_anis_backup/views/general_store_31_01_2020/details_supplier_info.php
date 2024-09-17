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
                <h3>Supplier/Contractor Details</h3>
            </div>
        </div>


        <?php
        $suppplier_services = unserialize($supplier[0]['services']);
        ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <ul class="nav nav-tabs" >
                            <li class="active"><a href="#basic" data-toggle="tab">Basic Info</a></li>
                            <li><a href="#order" style="color:#000000" data-toggle="tab">Purchase Orders</a></li>
                            <!--
                            <li><a href="#" style="color:#000000" data-toggle="tab">Payments</a></li>
                            <li><a href="#" style="color:#000000" data-toggle="tab">Due</a></li>
                            -->
                        </ul>

                        <div class="tab-content clearfix">    
                            <div class="tab-pane active" id="basic">
                                <br>
                                <div class="row" style="margin-bottom: 5px;">
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            Local/Foreign :
                                        </label> 
                                        <div class="col-sm-4 input-group">


                                            <?php
                                            if ($supplier[0]['LOCAL'] == 'Local') {
                                                echo 'Local';
                                            } else {
                                                echo 'Foreign';
                                            }
                                            ?> 


                                        </div>
                                        <label for="title" class="col-sm-2 control-label">
                                            Supplier Code :
                                        </label>
                                        <div class="col-sm-4 input-group"> 
                                            <?php echo $supplier[0]['CODE']; ?>
                                        </div>

                                    </div> 

                                </div>    
                                <div class="row" style="margin-bottom: 5px;">
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            Supplier Name  :
                                        </label> 
                                        <div class="col-sm-4 input-group">  
                                            <?php echo $supplier[0]['SUP_NAME']; ?>
                                        </div>
                                        <label for="title" class="col-sm-2 control-label">
                                            Status :
                                        </label>
                                        <div class="col-sm-4 input-group">


                                            <?php
                                            if ($supplier[0]['STATUS'] == 'Active') {
                                                echo 'Active';
                                            } else {
                                                echo 'Inactive';
                                            }
                                            ?>


                                        </div>

                                    </div>
                                </div> 
                                <div class="row" style="margin-bottom: 5px;">
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            Contact Person :
                                        </label> 
                                        <div class="col-sm-4 input-group">
                                            <?php echo $supplier[0]['NAME']; ?>
                                        </div>
                                        <label for="title" class="col-sm-2 control-label">
                                            Contact Address :
                                        </label>
                                        <div class="col-sm-4 input-group">   
                                            <?php echo $supplier[0]['ADDRESS']; ?>
                                        </div>

                                    </div>
                                </div>    

                                <div class="row" style="margin-bottom: 5px;">
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            Land Phone :
                                        </label> 
                                        <div class="col-sm-4 input-group">
                                            <?php echo $supplier[0]['LAND_PHONE']; ?>
                                        </div>
                                        <label for="title" class="col-sm-2 control-label">
                                            Mobile Phone:
                                        </label>
                                        <div class="col-sm-4 input-group">

                                            <?php echo $supplier[0]['MOBILE']; ?>
                                        </div>

                                    </div>
                                </div>    
                                <div class="row" style="margin-bottom: 5px;">
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            Email :
                                        </label> 
                                        <div class="col-sm-4 input-group">
                                            <?php echo $supplier[0]['EMAIL']; ?>
                                        </div>
                                        <label for="title" class="col-sm-2 control-label">
                                            Fax Number:
                                        </label>
                                        <div class="col-sm-4 input-group"> 
                                            <?php echo $supplier[0]['FAX']; ?>
                                        </div>

                                    </div>
                                </div>    
                                <div class="row" style="margin-bottom: 5px;">
                                    <div class='form-group' >

                                        <label for="title" class="col-sm-2 control-label">
                                            Website :
                                        </label> 
                                        <div class="col-sm-4 input-group">
                                            <?php echo $supplier[0]['WEBSITE']; ?>
                                        </div>
                                    </div>
                                </div>   

                                <div class="row" style="">
                                    <h2 style="margin-left:10px;">Services</h2>
                                    <?php foreach ($services as $service) { ?>
                                        <div class="col-md-3">
                                            <label class="checkbox-inline">
                                                <?php if (in_array($service['id'], $suppplier_services)) echo $service['service_name']; ?>
                                            </label>
                                        </div>   
                                    <?php } ?>


                                </div>

                            </div><!--Basic Info End-->  

                            <div class="tab-pane" id="order">
                                <br>
                                <div class="row" id="removeRow" style="width: 100%;overflow-x: scroll;overflow-y: hidden;">

                                    <table style="width:100%;font-size: 14px;" id="player_table" class="table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                                        <thead>

                                            <tr>  
                                                <th>SL</th>
                                                <th>Purchase Order Date.</th>
                                                <th>Purchase Order No.</th>
                                                <th>Quotation No.</th>
                                                <th>Value</th>

                                            </tr>

                                        </thead> 
                                        <tbody>
                                            <?php
                                            if (!empty($purchase_orders)) {
                                                $total = 0;
                                                $i = 0;
                                                foreach ($purchase_orders as $order) {
                                                    $i++;
                                                    $total = $total + $order['total_amount'];
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php if (!empty($order['purchase_order_date'])) echo date('d-m-Y', strtotime($order['purchase_order_date'])); ?></td>
                                                        <td><?php if (!empty($order['order_no'])) echo $order['order_no']; ?></td>
                                                        <td><?php if (!empty($order['reference_no'])) echo $order['reference_no']; ?></td>
                                                        <td style="text-align: right;"><?php if (!empty($order['total_amount'])) echo $order['total_amount']; ?></td>
                                                    </tr>
                                                 <?php } ?>
                                                <tr>
                                                    <td colspan="4" style="text-align: right;">Total</td>
                                                    <td style="text-align: right;"><?php echo $total; ?></td>
                                                </tr>
                                            <?php }else { ?>  
                                                <tr>
                                                    <td colspan="5" style="text-align: center;">No Data Found</td>
                                                </tr>
                                            <?php } ?>    
                                        </tbody>
                                    </table>
                                </div>
                            </div><!--Purchase order end-->
                        </div>    

                    </div>
                    <br>

                    <div class="row">
                        <!--
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary button">UPDATE</button>
                        </div>
                        -->
                        <div class="col-md-2">
                            <a href="<?php echo site_url('backend/general_store') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>


