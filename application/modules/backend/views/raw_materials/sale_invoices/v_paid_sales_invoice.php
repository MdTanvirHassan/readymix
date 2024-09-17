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
                <h3>Paid Invoice  List</h3>
            </div>
        </div>
        
         
        
        
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        
                        
                        <div class="row">
                        <div id="remover" class="col-md-6 col-md-offset-3">
                            <form id="item-form" action="<?php site_url('backend/sales_invoice/paidInvoice'); ?>" method="post">
                            <div class="row">
                                    <div style="margin-top: 15px;" class="col-md-10 col-md-offset-1">
                                      <select  class="form-control e1" placeholder="Select Customer" id="customer_id" name="customer_id" onchange="javascript:project_info();" >
                                          <option value="all" >Select customer</option>
                                          
                                        <?php foreach($customers as $customer){ ?>
                                           <option <?php if($customer_id==$customer['id']) echo 'selected'; ?>  value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option> 
                                        <?php } ?>    
                                         

                                     </select>

                                 </div>
                            </div><!--End Row-->  
                                                    
                          
                            <div class="clearfix"></div>
                            <div style="margin-top: 15px;" class="col-md-12">

                                <div class="col-md-8 col-md-offset-3">
<!--                                    <input style="padding: 6px 40px;" type="submit" class="btn btn-primary" value="SEARCH"/>
                                    <input style="padding: 6px 40px;" type="button" id="print_div" class="btn btn-primary" value="PRINT"/>-->
                                     <input id="form-submit" style="padding: 6px 40px;" type="submit" class="btn btn-primary" value="SEARCH"/>
                                   <!--  <a  href="javascript:" class="btn btn-info" onclick="submitForm('excel')">EXCEL</a>-->
                                    
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                        
                        
                    <div style="text-align:center;">
        <label style="margin-right:10px" for="readymix"><input type="radio" onchange="changeProduct()" name="prod" id="readymix" value="Readymix">Readymix</label>
        <label style="margin-right:10px" for="asphalt"><input type="radio" onchange="changeProduct()" name="prod" id="asphalt" value="Asphalt">Asphalt</label>
        <label for="all"><input type="radio" onchange="changeProduct()" name="prod" id="all" value="all">All</label>
    </div>
                <!--    <table id="datatable" class="table table-striped table-binvoiceed table-hover dataTable no-footer">-->
                        <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr>
                                    <th class="col-md-1">Date</th>
                                    <th class="col-md-1"> Invoice No.</th>
                                    <th class="col-md-1"> Sales Order No.</th>
                                    <th class="col-md-1">Customer Name</th>
                                    <th class="col-md-1">Project Name</th>
                                    <th class="col-md-1">Product Type</th>
                                    <th class="col-md-1">Unit</th>
                                    <th class="col-md-1" style="text-align: right;">Quantity</th>
                                    <th class="col-md-1" style="text-align: right;">Amount</th>
                                    
                                    <th class="col-md-1">Status</th>
                                    <th class="col-md-1">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($invoices)) {
                                    foreach ($invoices as $invoice) {
                                        ?>
                                        <tr>
                                            <td class="col-md-2">
        <?php if (!empty($invoice['sale_invoice_date'])) echo date('d-m-Y', strtotime($invoice['sale_invoice_date'])); ?>
                                            </td>
                                            <td>
        <?php if (!empty($invoice['inv_no'])) echo $invoice['inv_no']; ?>
                                            </td>
                                            <td>
        <?php if (!empty($invoice['order_no'])) echo $invoice['order_no']; ?>
                                            </td>
                                            <td>
        <?php if (!empty($invoice['c_name'])) echo $invoice['c_name']; ?>
                                            </td>
                                            <td>
        <?php 
       // if (!empty($invoice['project_name'])) echo $invoice['project_name']; else echo $invoice['tp_project_name']; 
           echo $invoice['tp_project_name'];
        ?>
                                            </td>
                                             <td>
        <?php if (!empty($invoice['category_name'])) echo $invoice['category_name']; ?>
                                            </td>
                                            <td>
        <?php if (!empty($invoice['mu_name'])) echo $invoice['mu_name']; ?>
                                            </td>
                                            <td style="text-align: right;">
        <?php if (!empty($invoice['total_qty'])) echo number_format($invoice['total_qty'],2); ?>
                                            </td>
                                            
                                            <td style="text-align: right;">
        <?php if (!empty($invoice['total_amount'])) echo number_format($invoice['total_amount'],2); ?>
                                            </td>
                                            <td>
        <?php if (!empty($invoice['status'])) echo $invoice['status']; ?>
                                            </td>


                                            <td class="col-md-1">
                                                 
                                                <?php if (in_array(4, $this->role)) { ?>  
                                                    <?php if($invoice['status']!=='Received'){ ?>
                                                       
                                                    <?php } ?>
                                                    <?php if($invoice['invoice_type']=="Pump"){ ?>      
                                                        <a href="<?php echo site_url('sale_invoices/details_pump_bill/' . $invoice['inv_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                                                    <?php }else{ ?>
                                                        <a href="<?php echo site_url('sale_invoices/details_sale_invoice/' . $invoice['inv_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                                                    <?php } ?>  
                                                <?php } ?>     
                                                <?php if ($invoice['status']) { ?>
                                                    <?php if (in_array(3, $this->role)) { ?>
                                                           
                                                    <?php } ?>
                                                    <?php if (in_array(5, $this->role)) { ?>    
                                                      
                                                    <?php } ?> 
                                                    <?php if (in_array(6,$this->role)){?>
                                                                
                                                    <?php } ?>        
                                                          
                                                <?php } else { ?>
                                                
                                                        
                                                     
                                                
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
        if(Number($('#customer_balance').val()) < Number($('#payment_amt').val())){
            alert('Payment amount is bigger that your balance.');
            return false;
        } else {
            if(Number($('#payment_amt').val())>Number($('#due_amt').val())){
                alert('Payment amount is bigger than due amount.');
                return false;
            }else{
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
    }
    function pay_now(id,customer_id, total, rcv,inv_type) {
     //   alert(customer_id);
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
                url: '<?php echo site_url('sale_invoices/get_customer_balance'); ?>',
                data:{'customer_id':customer_id},
                method:'POST',
                dataType:'json',
                success: function (msg){ 
                    //alert(msg.customer_balance);
                    $('#customer_balance').val(msg.customer_balance);
                    
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

<script>
function changeProduct(){
    var prod = $("input[name='prod']:checked").val();
    if(prod!='all')
        $('#datatable_filter').find('input').val(prod).keyup()
        else    
        $('#datatable_filter').find('input').val('').keyup();    
}
</script>