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
       <?php 
      // require_once(__DIR__ .'/../accounts_header.php'); 
       require_once(__DIR__ .'/../procurement_header.php');
       ?>
    </div>
    <div class="right_content">
      <?php  
      $this->role = checkUserPermission(2,100, $userData);
      if (in_array(2, $this->role)) { ?>
                       
        <a href="<?php echo site_url('purchase_invoices/add_purchase_invoice'); ?>" class="btn btn-sm btn-primary">ADD INVOICE</a>
        <a href="<?php echo site_url('purchase_invoices/add_direct_purchase_invoice'); ?>" class="btn btn-sm btn-primary">ADD OPENING INVOICE</a>
      
    <?php } ?>   
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Invoice No.</th>
                <th class="col-lg-1">Supplier Bill No.</th>
                <th class="col-lg-1">Supplier Name</th>
                
                <th class="col-lg-1">Amount</th>
                <th class="col-lg-1">Audit Status</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($invoices)) {
                foreach ($invoices as $invoice) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($invoice['invoice_date'])) echo date('d-m-Y',strtotime($invoice['invoice_date'])); ?>
                        </td>
                        <td>
                            <?php if(!empty($invoice['inv_no'])) echo $invoice['inv_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($invoice['supplier_bill_no'])) echo $invoice['supplier_bill_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($invoice['SUP_NAME'])) echo $invoice['SUP_NAME']; ?>
                        </td>
                         
                        <td>
                             <?php if(!empty($invoice['net_payable_amount'])) echo $invoice['net_payable_amount']; ?>
                        </td>
                        <td>
                             <?php if(!empty($invoice['audit_status'])) echo $invoice['audit_status']; ?>
                        </td>
                       

                        <td>
                           
                             <?php  if($user_type == 1){ ?>
                                <?php if($invoice['invoice_type']=="Direct"){ ?> 
                                    <a href="<?php echo site_url('purchase_invoices/details_direct_purchase_invoice/'.$invoice['inv_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                                <?php }else{ ?> 
                                    <a href="<?php echo site_url('purchase_invoices/details_purchase_invoice/'.$invoice['inv_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                                <?php } ?>    
                                 <?php if($invoice['invoice_type']=="Direct"){ ?>  
                                    <a href="<?php echo site_url('purchase_invoices/edit_direct_purchase_invoice/'.$invoice['inv_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                    <button onclick="delete_row('<?php echo site_url('purchase_invoices/delete_direct_purchase_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                 <?php }else{ ?>  
                                    <a href="<?php echo site_url('purchase_invoices/edit_purchase_invoice/'.$invoice['inv_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                    <button onclick="delete_row('<?php echo site_url('purchase_invoices/delete_purchase_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                 <?php } ?>   
                                    
                            <?php }else{ ?>   
                                       <?php  if (in_array(4, $this->role)) { ?>  
                                            <?php if($invoice['invoice_type']=="Direct"){ ?> 
                                                <a href="<?php echo site_url('purchase_invoices/details_direct_purchase_invoice/'.$invoice['inv_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                                            <?php }else{ ?> 
                                                <a href="<?php echo site_url('purchase_invoices/details_purchase_invoice/'.$invoice['inv_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                                            <?php } ?>    
                                    <?php } ?>     
                                     <?php if($invoice['audit_status']=="Pending"){ ?>
                                         <?php  if (in_array(3, $this->role)) { ?>
                                         
                                                <?php if($invoice['invoice_type']=="Direct"){ ?>  
                                                    <a href="<?php echo site_url('purchase_invoices/edit_direct_purchase_invoice/'.$invoice['inv_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                                <?php }else{ ?>
                                                    <a href="<?php echo site_url('purchase_invoices/edit_purchase_invoice/'.$invoice['inv_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                                <?php } ?> 
                                                    
                                         <?php } ?>
                                          <?php  if (in_array(5, $this->role)) { ?>  
                                              <?php if($invoice['invoice_type']=="Direct"){ ?>         
                                                 <button onclick="delete_row('<?php echo site_url('purchase_invoices/delete_direct_purchase_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                              <?php }else{ ?>
                                                 <button onclick="delete_row('<?php echo site_url('purchase_invoices/delete_purchase_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                              <?php } ?>   
                                          <?php } ?>     
                                     <?php }else{ ?>
                                         <?php  if (in_array(3, $this->role)) { ?>     
                                             <button class="btn btn-sm btn-info">Edit</button>
                                         <?php } ?>
                                         <?php  if (in_array(5, $this->role)) { ?>     
                                             <button  class="btn btn-sm btn-danger">Delete</button>
                                         <?php } ?>
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

