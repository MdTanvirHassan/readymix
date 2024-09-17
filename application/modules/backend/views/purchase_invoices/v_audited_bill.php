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
       require_once(__DIR__ .'/../accounts_header.php');
       ?>
    </div>
    <div class="right_content">
        
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Invoice No.</th>
                <th class="col-lg-1">Supplier Bill No.</th>
                <th class="col-lg-1">Supplier Name</th>
                
                <th class="col-lg-1">Amount</th>
                <th class="col-lg-1">Audit Status</th>
                <th class="col-lg-1">Payment Status</th>
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
                             <?php if(!empty($invoice['payment_status'])) echo $invoice['payment_status']; ?>
                        </td>

                        <td>
                           
                                    <a href="<?php echo site_url('purchase_invoices/auditedBillDetails/'.$invoice['inv_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                                               
                                    
                                <?php if($invoice['payment_status']!="Paid"){ ?>
                                    <button class="btn btn-sm btn-success" onclick="pay_now(<?php echo !empty($invoice['inv_id']) ? $invoice['inv_id'] : ''; ?>,<?php echo !empty($invoice['supplier_id']) ? $invoice['supplier_id'] : '0.00'; ?>,<?php echo $invoice['net_payable_amount'] ? $invoice['net_payable_amount'] : '0.00'; ?>,<?php echo $invoice['paid_amount'] ?  $invoice['paid_amount'] : '0.00'; ?>,<?php echo "'".$invoice['invoice_type']."'"; ?>)">Pay Now</button>
                                <?php } ?>    
                                    
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
    
    
        
        
        
    <div class="modal fade" id="paymetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Supplier Balance</label>
                        <input type="text" readonly class="form-control" id="supplier_balance">
                        <label>Total Amount</label>
                        <input type="text" readonly class="form-control" id="total_amt">
                        <label>Paid Amount</label>
                        <input type="text" readonly class="form-control" id="rcv_amt">
                        <label>Due Amount</label>
                        <input type="text" readonly class="form-control" id="due_amt">
                        <label>Payment Amount</label>
                        <input type="text" class="form-control" id="payment_amt">
                        <input type="hidden" class="form-control" id="inv_id">
                        <input type="hidden" class="form-control" id="inv_type">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary pull-right" onclick="confirmPayment()">Confirm Payment</button>
                </div>

            </div>
        </div>
    </div>    
        
        
</div>
</div>

<script type="text/javascript">
     function pay_now(id,supplier_id,total,rcv,inv_type) {
       // alert(supplier_id);
        if(!rcv){
            rcv=0;
        }
        $('#inv_id').val(id);
        $('#inv_type').val(inv_type);
       // $('#customer_balance').val(balance);
        $('#total_amt').val(total);
        $('#rcv_amt').val(rcv);
        $('#due_amt').val((total - rcv).toFixed(2));
        $.ajax({
                url: '<?php echo site_url('purchase_invoices/get_supplier_balance'); ?>',
                data:{'supplier_id':supplier_id},
                method:'POST',
                dataType:'json',
                success: function (msg){ 
                    //alert(msg.customer_balance);
                    $('#supplier_balance').val(msg.supplier_balance);
                    
                    $('#paymetModal').modal('show');
                    
                }

        })
        
    }
    
     function confirmPayment() {
        if(Number($('#supplier_balance').val()) < Number($('#payment_amt').val())){
            alert('Payment amount is bigger that your balance.');
            return false;
        }else{
            if(Number($('#payment_amt').val())>Number($('#due_amt').val())){
                alert('Payment amount is bigger than due amount.');
                return false;
            }else{
                $.ajax({
                    url: '<?php echo site_url('purchase_invoices/confirm_payment'); ?>',
                    data: {'id':$('#inv_id').val(),'amt':$('#payment_amt').val(),'inv_type':$('#inv_type').val()},
                    method: 'POST',
                    dataType: 'text',
                    success: function (msg) {
                        $('#payment_amt').val('');
                        location.reload();
                    }

                })
            }
        }
    }
    
    
    
</script>