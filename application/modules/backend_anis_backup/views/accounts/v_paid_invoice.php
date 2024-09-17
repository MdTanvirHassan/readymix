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
    $this->role = checkUserPermission(14, 66, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    
    <div class="os-tabs-w menu-shad">
       <?php require_once(__DIR__ .'/../accounts_header.php'); ?>
    </div>
    <div class="right_content">
   
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
                <th class="col-lg-1">Payment Status</th>
          <!--      <th class="col-lg-1">Action</th>-->
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
                             <?php if(!empty($invoice['payment_status'])) echo $invoice['payment_status']; ?>
                        </td>
                       
                      <!--  
                        <td>
                            <?php  if($user_type == 1){ ?>  
                                    <a href="<?php echo site_url('purchase_invoices/details_purchase_invoice/'.$invoice['inv_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>  
                            <?php }else{ ?>   
                                       <?php  if (in_array(4, $this->role)) { ?>  
                                         <a href="<?php echo site_url('purchase_invoices/details_purchase_invoice/'.$invoice['inv_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                                    <?php } ?>     
                                    
                            <?php } ?>                    
                                    
                           
                                    
                        </td>
                      -->
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>

