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
    $this->role = checkUserPermission(14,66, $userData);
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
                <th class="col-lg-1">Action</th>
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
                       
                    
                        <td>
                              <?php if (in_array(4, $this->role)) { ?>  
                                    <?php if($invoice['status']!=='Paid'){ ?>
                                        <button class="btn btn-sm btn-success" onclick="pay_now(<?php echo !empty($invoice['inv_id']) ? $invoice['inv_id'] : ''; ?>,<?php echo !empty($invoice['supplier_id']) ? $invoice['supplier_id'] : '0.00'; ?>,<?php echo $invoice['total_amount'] ? $invoice['total_amount'] : '0.00'; ?>,<?php echo $invoice['paid_amount'] ?  $invoice['paid_amount'] : '0.00'; ?>,<?php echo "'".$invoice['invoice_type']."'"; ?>)">Pay Now</button>
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


 <div class="modal fade" id="paymetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Payment Confirmation</h5>
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
                                            <input type="text" readonly class="form-control" id="paid_amt">
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



<script>
    
    
  function cancel_invoice(url){
    bootbox.confirm({
        message: "<div class='boot-header'>YOU ARE ABOUT TO CANCEL A INVOICE ODER ! ARE YOU SURE ?</div><div class='boot-text'></div>",
        buttons: {
            confirm: {
                label: 'YES',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'CANCEL',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true)
                location.href = url;

        }
    });
}
    
    
    function confirmPayment() {
        if(Number($('#supplier_balance').val()) < Number($('#payment_amt').val())){
            alert('Payment amount is bigger than your balance.');
            return false;
        } else {
            if(Number($('#payment_amt').val())>Number($('#due_amt').val())){
                alert('Payment amount is bigger than due amount.');
                return false;
            }else{
                $.ajax({
                    url: '<?php echo site_url('accounts/confirm_payment'); ?>',
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
    
    
    function pay_now(id,supplier_id,total,paid,inv_type) {
     //   alert(customer_id);
        if(!paid){
            paid=0;
        }
        $('#inv_id').val(id);
        $('#inv_type').val(inv_type);
       // $('#customer_balance').val(balance);
        $('#total_amt').val(total);
        $('#paid_amt').val(paid);
        $('#due_amt').val((total - paid).toFixed(2));
        $.ajax({
                url: '<?php echo site_url('accounts/get_supplier_balance'); ?>',
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
    
    function pay_now_04_07_2020(id, balance, total, rcv) {
        if (!rcv) {
            rcv = 0;
        }
        $('#inv_id').val(id)
        $('#customer_balance').val(balance)
        $('#total_amt').val(total)
        $('#rcv_amt').val(rcv)
        $('#due_amt').val((total - rcv).toFixed(2))
        $('#paymetModal').modal('show');
    }
    
    
    function confirmDirectInvocePayment() {
        if(Number($('#customer_balance').val())<Number($('#payment_amt').val())){
            alert('Payment amount is bigger than your balance.');
            return false;
        } else {
            if(Number($('#payment_amt').val())>Number($('#due_amt').val())){
                alert('Payment amount is bigger than due amount.');
                return false;
            }else{    
                
                $.ajax({
                    url: '<?php echo site_url('sale_invoices/confirm_direct_invoice_payment'); ?>',
                    data: {'id':$('#inv_id').val(),'amt':$('#payment_amt').val()},
                    method: 'POST',
                    dataType: 'text',
                    success: function(msg){
                        $('#payment_amt').val('');
                        location.reload();
                    }

                })
            }
        }
    }
    function direct_invoice_pay_now(id, balance, total, rcv) {
        if(!rcv){
            rcv = 0;
        }
        $('#inv_id').val(id)
        $('#customer_balance').val(balance)
        $('#total_amt').val(total)
        $('#rcv_amt').val(rcv)
        $('#due_amt').val((total - rcv).toFixed(2))
        $('#paymetModal').modal('show');
    }
    
    
    
</script>