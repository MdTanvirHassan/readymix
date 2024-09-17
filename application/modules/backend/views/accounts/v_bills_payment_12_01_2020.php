<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $employee_id = $this->session->userdata('employeeId');
    $user_type = $this->session->userdata('user_type');
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(9, 59, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
     <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
               <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(14,66, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'unpaid_invoice') echo 'active'; ?>" href="<?php echo site_url('backend/accounts'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Unpaid Bill</span>
                    </a>
                </li>
                <?php } ?> 
                <?php $this->role = checkUserPermission(14,67, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'payment') echo 'active'; ?>" href="<?php echo site_url('backend/accounts/payment'); ?>">
                            <i class="fa fa-cc"></i><br><span>Bill Payment</span></a>
                    </li>
                <?php } ?>
                    
                 <?php $this->role = checkUserPermission(14, 68, $userData); 
                 if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                     ?>
                        <li class="nav-item">
                            <a   class="nav-link <?php if ($this->sub_inner_menu == 'paid_invoice') echo 'active'; ?>" href="<?php echo site_url('backend/accounts/paid_invoice'); ?>">
                                <i class="fa fa-info-circle"></i><br><span>Paid Bill</span>
                            </a>
                        </li>
                <?php } ?> 
               
            </ul>
        </div>
    </div>
    <div class="right_content">
    <?php  
    $this->role = checkUserPermission(14, 68, $userData);
    if (in_array(2, $this->role)) { 
        ?>
        <a href="<?php echo site_url('accounts/add_payment'); ?>" class="btn btn-sm btn-primary">ADD BILL  PAYMENT</a>
    <?php } ?>     
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Payment Date</th>
                <th class="col-lg-1">Invoice No.</th>
                <th class="col-lg-1">Supplier Name</th>
                <th class="col-lg-1">Mode of Payment</th>
             <!--   <th class="col-lg-1">Pdc/Lc/Bg No</th>-->
                <th class="col-lg-1">Amount</th> 
                <th class="col-lg-1">P. Status</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($payments)) {
                foreach ($payments as $payment) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($payment['payment_date'])) echo date('d-m-Y',strtotime($payment['payment_date'])); ?>
                        </td>
                        <td>
                            <?php if(!empty($payment['inv_no'])) echo $payment['inv_no']; ?>
                        </td>
                         <td>
                             <?php if(!empty($payment['SUP_NAME'])) echo $payment['SUP_NAME']; ?>
                        </td>
                        <td>
                            <?php if(!empty($payment['mode_name'])) echo $payment['mode_name']; ?>
                        </td>
                        <!--
                       <td>
                            <?php if(!empty($payment['no'])) echo $payment['no']; ?>
                        </td>
                        -->
                        
                        <td>
                            <?php if(!empty($payment['amount'])) echo $payment['amount']; ?>
                        </td>
                       
                        <td>
                            <?php if(!empty($payment['payment_status'])) echo $payment['payment_status']; ?>
                        </td>

                        <td>
                            <?php  if (in_array(4, $this->role)) { ?>
                                <a href="<?php echo site_url('accounts/details_payment/'.$payment['id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                            <?php } ?>    
                            <?php if($payment['payment_status']!="Paid" ){ ?>
                                <?php  if (in_array(2, $this->role)) { ?>    
                                    <a href="<?php echo site_url('accounts/billPayment/'.$payment['id']); ?>"><button class="btn btn-sm btn-primary">Confirm</button></a>
                                <?php } ?>    
                            <?php } ?>
                            <?php if($payment['payment_status']!="Paid"){ ?>
                               <?php  if (in_array(3, $this->role)) { ?>     
                                    <a href="<?php echo site_url('accounts/edit_payment/'.$payment['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                               <?php } ?>    
                            <?php }else{ ?>
                                <?php  if (in_array(3, $this->role)) { ?>    
                                    <button class="btn btn-sm btn-info">Edit</button>
                                <?php } ?>
                            <?php } ?>    
                            <?php if($payment['payment_status']!="Paid"){ ?>
                                <?php  if (in_array(5, $this->role)) { ?>    
                                    <button onclick="delete_row('<?php echo site_url('accounts/delete_payment/'.$payment['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
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

