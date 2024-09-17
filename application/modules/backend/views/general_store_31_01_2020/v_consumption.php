<?php
$user_id = $this->session->userdata('user_id');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(3, 43, $userData);
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
                                <i class="fa fa-cc"></i><br><span>Consume</span></a>
                        </li>
                <?php } ?>
                        
                <?php $this->role = checkUserPermission(3,47, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'transfer') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/transfer'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Transfer </span>
                    </a>
                </li>
                <?php } ?> 
                
               
            </ul>
        </div>
    </div>   
    
    

<div class="right_content" style="margin-top:65px;">
        <!--         <h2 style="text-align:center; ">Supplier/Customer's Information List</h2>
            <hr>-->
        <?php if (in_array(2, $this->role)) { ?>
            <a href="<?php echo site_url('general_store/add_consumption'); ?>" class="btn btn-sm btn-primary">ADD CONSUMPTION</a>
        <?php } ?>    
        <table id="datatable" class="table table-striped table-bordered table-hover no-footer">
            <thead>
                <tr>
                    <th class="col-lg-1">Sl.</th>
                    <th class="col-lg-1">Item Name</th>
                    <th class="col-lg-1">Cost Center</th>
                    <th class="col-lg-1">Consumption Quantity</th>
                    <th class="col-lg-1">Total Quantity</th>
                    <th class="col-lg-1">Create Date</th>
                    <th class="col-lg-1">Consumption date</th>
                    <th class="col-lg-1">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($item_consumption)) {
                    $i=1;
                    foreach ($item_consumption as $row) {
                        ?>
                        <tr>
                            <td>
        <?php echo $i; ?>
                            </td>
                            <td>
        <?php if (!empty($row['item_name'])) echo $row['item_name']; ?>
                            </td>
                            <td>
        <?php if (!empty($row['c_c_name'])) echo $row['c_c_name']; ?>
                            </td>
                            <td>
        <?php if (!empty($row['consumption_quantity'])) echo $row['consumption_quantity']; ?>
                            </td>
                            <td>
        <?php if (!empty($row['total_quantity'])) echo $row['total_quantity']; ?>
                            </td>
                            <td>
        <?php if (!empty($row['created_date'])) echo date('d-m-Y',strtotime($row['created_date'])); ?>
                            </td>
                            <td>
        <?php if (!empty($row['consumption_date']))echo date('d-m-Y',strtotime($row['consumption_date'])); ?>
                            </td>

                            <td>
                                
                                <?php if (in_array(3, $this->role)) { ?>
<!--                                <a href="<?php echo site_url('general_store/edit_consumption/' . $row['consumption_id']); ?>"><button class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></button></a>-->
                                <?php } ?>
                                <?php if (in_array(5, $this->role)) { ?>   
<!--                                <button onclick="delete_row('<?php echo site_url('general_store/delete_supplier/' . $supplier['ID']); ?>')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>-->
        <?php } ?>    
                            </td>
                        </tr>
                        
                    <?php  $i++; }
                    
                }
                ?>
            </tbody>
        </table>   
    </div>
</div>
