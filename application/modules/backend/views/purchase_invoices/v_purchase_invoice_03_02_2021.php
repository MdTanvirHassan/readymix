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
    $this->role = checkUserPermission(8,42, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; ">Invoice  List</h2>
    <hr>-->
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Invoice  List</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <?php  if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('purchase_invoices/add_purchase_invoice'); ?>" class="btn btn-sm btn-primary">ADD INVOICE</a>
        <a href="<?php echo site_url('purchase_invoices/add_direct_purchase_invoice'); ?>" class="btn btn-sm btn-primary">ADD PREVIOUS INVOICE</a>
    <?php } ?>    
<!--    <table id="datatable" class="table table-striped table-binvoiceed table-hover dataTable no-footer">-->
        <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Invoice No.</th>
                <th class="col-lg-1">Work Order No.</th>
                <th class="col-lg-1">Supplier Name</th>
                <th class="col-lg-1">Project Name</th>
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
                            <?php if(!empty($invoice['order_no'])) echo $invoice['order_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($invoice['SUP_NAME'])) echo $invoice['SUP_NAME']; ?>
                        </td>
                         <td>
                            <?php if(!empty($invoice['dep_description'])) echo $invoice['dep_description']; ?>
                        </td>
                        <td>
                             <?php if(!empty($invoice['total_amount'])) echo $invoice['total_amount']; ?>
                        </td>
                        <td>
                             <?php if(!empty($invoice['audit_status'])) echo $invoice['audit_status']; ?>
                        </td>
                       

                        <td>
                            <?php  if($user_type == 1){ ?>  
                                    <a href="<?php echo site_url('purchase_invoices/details_purchase_invoice/'.$invoice['inv_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                                    <a href="<?php echo site_url('purchase_invoices/edit_purchase_invoice/'.$invoice['inv_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                    <button onclick="delete_row('<?php echo site_url('purchase_invoices/delete_purchase_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                            <?php }else{ ?>   
                                       <?php  if (in_array(4, $this->role)) { ?>  
                                         <a href="<?php echo site_url('purchase_invoices/details_purchase_invoice/'.$invoice['inv_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                                    <?php } ?>     
                                     <?php if($invoice['audit_status']=="Pending"){ ?>
                                         <?php  if (in_array(3, $this->role)) { ?>
                                             <a href="<?php echo site_url('purchase_invoices/edit_purchase_invoice/'.$invoice['inv_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                         <?php } ?>
                                          <?php  if (in_array(5, $this->role)) { ?>    
                                             <button onclick="delete_row('<?php echo site_url('purchase_invoices/delete_purchase_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
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
                                    
                           <?php  if($user_type == 1){ ?>  
                                 <?php if($invoice['audit_status']=="Approved"){ ?>
                                    
                                    <button onclick="reject('<?php echo site_url('purchase_invoices/reject_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                 <?php }else if($invoice['audit_status']=="Rejected"){ ?>
                                        <button onclick="approve('<?php echo site_url('purchase_invoices/approve_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                        
                                 <?php }else{  ?> 
                                        <button onclick="approve('<?php echo site_url('purchase_invoices/approve_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                        <button onclick="reject('<?php echo site_url('purchase_invoices/reject_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                 <?php } ?>   
                          <?php }else{ ?>   
                                 
                                    <?php  if($employee_id == $approver[0]) {  ?>
                                         <?php  if(!empty($approver[1]) ) { ?>   
                                                 <button onclick="approve('<?php echo site_url('purchase_invoices/forward_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                                 <button onclick="reject('<?php echo site_url('purchase_invoices/reject_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php }else{ ?> 
                                                <button onclick="approve('<?php echo site_url('purchase_invoices/approve_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                <button onclick="reject('<?php echo site_url('purchase_invoices/reject_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php } ?>              

                                   <?php } ?>  
                                                
                                    <?php  if($employee_id == $approver[1]) {  ?>
                                         <?php  if(!empty($approver[2]) ) { ?>
                                                 <button onclick="approve('<?php echo site_url('purchase_invoices/forward_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                                 <button onclick="reject('<?php echo site_url('purchase_invoices/reject_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php }else{ ?> 
                                                <button onclick="approve('<?php echo site_url('purchase_invoices/approve_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                <button onclick="reject('<?php echo site_url('purchase_invoices/reject_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php } ?>              

                                   <?php } ?>  
                                                
                                    <?php  if($employee_id == $approver[2]) {  ?>
                                         <?php  if(!empty($approver[3]) ) { ?>
                                                <button onclick="approve('<?php echo site_url('purchase_invoices/forward_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                                <button onclick="reject('<?php echo site_url('purchase_invoices/reject_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>       
                                         <?php }else{ ?> 
                                                <button onclick="approve('<?php echo site_url('purchase_invoices/approve_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                <button onclick="reject('<?php echo site_url('purchase_invoices/reject_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php } ?>              

                                   <?php } ?>     
                                                
                                     <?php  if($employee_id == $approver[3]) {  ?>
                                         
                                             <button onclick="approve('<?php echo site_url('purchase_invoices/approve_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                             <button onclick="reject('<?php echo site_url('purchase_invoices/reject_invoice/'.$invoice['inv_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            

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
</div>
</div>
</div>
</div>
