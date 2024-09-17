<style>
    .btn-sm{
        padding:5px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(2, 40, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <!--
    <h2 style="text-align:center; ">Quotation  List</h2>
    <hr>
    -->
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
                
                 <?php $this->role = checkUserPermission(2, 40, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'purchase_quotation') echo 'active'; ?>" href="<?php echo site_url('backend/purchase_quotations'); ?>">
                            <i class="fa fa-cc"></i><br><span>PURCHASE QUOTATION</span></a>
                    </li>
                <?php } ?>
                
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
     <?php $this->role = checkUserPermission(2, 40, $userData);  if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('purchase_quotations/add_quotation'); ?>" class="btn btn-sm btn-primary">ADD QUOTATION</a>
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1"> Quotation No.</th>
                <th class="col-lg-1">Supplier Name</th>
                <th class="col-lg-1">Project Name</th>
                <th class="col-lg-1">Amount</th>
                <th class="col-lg-1">Status</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($quotations)) {
                foreach ($quotations as $quotation) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($quotation['quotation_date'])) echo date('d-m-Y',strtotime($quotation['quotation_date'])); ?>
                        </td>
                        <td>
        <?php if(!empty($quotation['reference_no'])) echo $quotation['reference_no']; ?>
                        </td>
                        <td>
                             <?php if(!empty($quotation['SUP_NAME'])) echo $quotation['SUP_NAME']; ?>
                        </td>
                        <td>
                             <?php if(!empty($quotation['dep_description'])) echo $quotation['dep_description']; ?>
                        </td>
                        <td>
        <?php if(!empty($quotation['total_amount'])) echo $quotation['total_amount']; ?>
                        </td>
                        <td>
                            <?php if(!empty($quotation['status'])) echo $quotation['status']; ?>
                            
                        </td>
                       

                        <td>
                            <?php  if (in_array(4, $this->role)) { ?>
                                <a href="<?php echo site_url('purchase_quotations/details_quotation/'.$quotation['q_id']); ?>"><button class="btn btn-sm btn-success">View</button></a>
                                
                            <?php } ?>
                            <?php if($quotation['status']=="Pending"){ ?>
                                <?php  if (in_array(3, $this->role)) { ?>
                                    <a href="<?php echo site_url('purchase_quotations/edit_quotation/'.$quotation['q_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php } ?>
                                <?php  if (in_array(5, $this->role)) { ?>    
                                    <button onclick="delete_row('<?php echo site_url('purchase_quotations/delete_quotation/'.$quotation['q_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                <?php } ?>
                            <?php }else{ ?>
                                <?php  if (in_array(3, $this->role)) { ?>    
                                    <button class="btn btn-sm btn-info">Edit</button>
                                <?php } ?>
                                <?php  if (in_array(5, $this->role)) { ?>    
                                    <button  class="btn btn-sm btn-danger">Delete</button>
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
