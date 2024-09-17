<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
$user_id = $this->session->userdata('user_id');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(7, 31, $userData);
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
                        <?php if (in_array(2, $this->role)) { ?>
                            <a href="<?php echo site_url('sale_invoices/add_sale_invoice'); ?>" class="btn btn-sm btn-primary">ADD INVOICE</a>
                            <a href="<?php echo site_url('sale_invoices/add_direct_sale_invoice'); ?>" class="btn btn-sm btn-primary">ADD PREVIOUS INVOICE</a>
                        <?php } ?>    
                <!--    <table id="datatable" class="table table-striped table-binvoiceed table-hover dataTable no-footer">-->
                        <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr>
                                    <th class="col-lg-1">Date</th>
                                    <th class="col-lg-1"> Invoice No.</th>
                                    <th class="col-lg-1"> Delivery No.</th>
                                    <th class="col-lg-1">Customer Name</th>
                                    <th class="col-lg-1">Project Name</th>
                                    <th class="col-lg-1">Product Type</th>
                                    <th class="col-lg-1">Amount</th>
                                    <th class="col-lg-1">Status</th>
                                    <th class="col-lg-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($invoices)) {
                                    foreach ($invoices as $invoice) {
                                        ?>
                                        <tr>
                                            <td>
        <?php if (!empty($invoice['sale_invoice_date'])) echo date('d-m-Y', strtotime($invoice['sale_invoice_date'])); ?>
                                            </td>
                                            <td>
        <?php if (!empty($invoice['inv_no'])) echo $invoice['inv_no']; ?>
                                            </td>
                                            <td>
        <?php if (!empty($invoice['delivery_no'])) echo $invoice['delivery_no']; ?>
                                            </td>
                                            <td>
        <?php if (!empty($invoice['c_name'])) echo $invoice['c_name']; ?>
                                            </td>
                                            <td>
        <?php 
        if (!empty($invoice['project_name'])) echo $invoice['project_name']; else echo $invoice['tp_project_name']; 
        ?>
                                            </td>
                                             <td>
        <?php if (!empty($invoice['category_name'])) echo $invoice['category_name']; ?>
                                            </td>
                                            
                                            <td>
        <?php if (!empty($invoice['total_amount'])) echo number_format($invoice['total_amount'],2); ?>
                                            </td>
                                            <td>
        <?php if (!empty($invoice['status'])) echo $invoice['status']; ?>
                                            </td>


                                            <td>
                                                 <?php if(empty($invoice['customer_id']) || empty($invoice['project_id'])){ ?>        
                                                    <a href="<?php echo site_url('sale_invoices/update_customer_project_ifo/' . $invoice['inv_id']); ?>"><button class="btn btn-sm btn-info">Update Customer</button></a>  
                                                 <?php } ?>   
        <?php if (in_array(4, $this->role)) { ?>  
                                                <?php if($invoice['status']!=='Received'){ ?>
                                                    <button class="btn btn-sm btn-success" onclick="pay_now(<?php echo !empty($invoice['inv_id']) ? $invoice['inv_id'] : ''; ?>,<?php echo !empty($invoice['deposit']) ? $invoice['deposit'] : '0.00'; ?>,<?php echo $invoice['total_amount'] ? $invoice['total_amount'] : '0.00'; ?>,<?php echo $invoice['received_amount'] ?  $invoice['received_amount'] : '0.00'; ?>,<?php echo "'".$invoice['invoice_type']."'"; ?>)">Pay Now</button>
                                                <?php } ?>
                                                    <a href="<?php echo site_url('sale_invoices/details_sale_invoice/' . $invoice['inv_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>

                                                <?php } ?>     
                                                <?php if ($invoice['status']) { ?>
                                                    <?php if (in_array(3, $this->role)) { ?>
                                                          <?php if($invoice['invoice_type']=="Direct"){ ?>
                                                             <a href="<?php echo site_url('sale_invoices/edit_direct_sale_invoice/' . $invoice['inv_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                                          <?php }else{ ?>
                                                             <a href="<?php echo site_url('sale_invoices/edit_sale_invoice/' . $invoice['inv_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                                          <?php } ?>   
                                                    <?php } ?>
                                                    <?php if (in_array(5, $this->role)) { ?>    
                                                       <?php if($invoice['invoice_type']=="Direct"){ ?>       
                                                          <button onclick="delete_row('<?php echo site_url('sale_invoices/delete_direct_sale_invoice/' . $invoice['inv_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                                       <?php }else{ ?> 
                                                          <button onclick="delete_row('<?php echo site_url('sale_invoices/delete_sale_invoice/' . $invoice['inv_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                                       <?php } ?>  
                                                    <?php } ?>     
                                                <?php } else { ?>
                                                    <?php if (in_array(3, $this->role)) { ?>     
                                                        <button class="btn btn-sm btn-info">Edit</button>
                                                    <?php } ?>
                                                    <?php if (in_array(5, $this->role)) { ?>     
                                                        <button  class="btn btn-sm btn-danger">Delete</button>
                                                    <?php } ?>
                                                
        <?php } ?>      
                                            </td>
                                        </tr>
                                    <?php }
                                }
                                ?>
                            </tbody>
                        </table>

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
                                            <label>Customer Balance</label>
                                            <input type="text" readonly class="form-control" id="customer_balance">
                                            <label>Total Amount</label>
                                            <input type="text" readonly class="form-control" id="total_amt">
                                            <label>Received Amount</label>
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
            </div>
        </div>
    </div>
</div>
<script>
    function confirmPayment() {
        if(Number($('#customer_balance').val()) < Number($('#payment_amt').val())){
            alert('Payment amount is bigger that your balance.');
            return false;
        } else {
            $.ajax({
                url: '<?php echo site_url('sale_invoices/confirm_payment'); ?>',
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
    function pay_now(id, balance, total, rcv,inv_type) {
        if (!rcv) {
            rcv = 0;
        }
        $('#inv_id').val(id);
        $('#inv_type').val(inv_type);
        $('#customer_balance').val(balance);
        $('#total_amt').val(total);
        $('#rcv_amt').val(rcv);
        $('#due_amt').val((total - rcv).toFixed(2));
        $('#paymetModal').modal('show');
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
            alert('Payment amount is bigger that your balance.');
            return false;
        } else {
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