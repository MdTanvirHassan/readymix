<?php
$user_id = $this->session->userdata('user_id');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(1, 2, $userData);
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
                        <i class="fa fa-info-circle"></i><br><span>Transfer</span>
                    </a>
                </li>
                <?php } ?> 
                
               
                
                
                
                
            </ul>
        </div>
    </div>

<div class="right_content">
        <!--         <h2 style="text-align:center; ">Supplier/Customer's Information List</h2>
            <hr>-->
        <?php if (in_array(2, $this->role)) { ?>
            <a href="<?php echo site_url('general_store/add_transfer'); ?>" class="btn btn-sm btn-primary">ADD TRANSFER</a>
        <?php } ?>    
        <table id="datatable" class="table table-striped table-bordered table-hover no-footer">
            <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Item Name</th>
                   <th>Transfer Quantity</th>
                   <th>From Project</th>
                   <th>TO Project</th>
                    <th>Transfer date</th>
                    <th>Create Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($transfer)) {
                    $i=1;
                    foreach ($transfer as $row) {
                        ?>
                        <tr>
                            <td>
        <?php echo $i; ?>
                            </td>
                            <td>
        <?php if (!empty($row['item_name'])) echo $row['item_name']; ?>
                            </td>
                            <td>
        <?php if (!empty($row['transfer_quantity'])) echo $row['transfer_quantity']; ?>
                            </td>
                            <td>
        <?php if (!empty($department[0]['short_name'])) echo $department[0]['short_name']; ?>
                            </td>
                            <td>
        <?php if (!empty($row['short_name'])) echo $row['short_name']; ?>
                            </td>
                            <td>
        <?php if (!empty($row['create_date'])) echo date('d-m-Y',strtotime($row['create_date'])); ?>
                            </td>
                            <td>
        <?php if (!empty($row['transfer_date']))echo date('d-m-Y',strtotime($row['transfer_date'])); ?>
                            </td>

                            <td>
                                
                                <?php if ($row['status']== '1') { ?>
                                <a href="<?php echo site_url('general_store/edit_transfer/' . $row['transfer_id']); ?>"><button class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></button></a>
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
