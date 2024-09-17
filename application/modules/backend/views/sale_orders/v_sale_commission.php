<style>
    .btn-sm {
        padding: 2px 5px !important;
    }
</style>
<?php
$user_id = $this->session->userdata('user_id');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(7, 26, $userData);
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Sale Commission List</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <!-- <?php if (in_array(2, $this->role)) { ?>
                            <a href="<?php echo site_url('sale_orders/add_sale_order'); ?>" class="btn btn-sm btn-primary">ADD ORDER</a>
                        <?php } ?>
                        <a href="<?php echo site_url('sales_report/allSalesOrder'); ?>" class="btn btn-sm btn-success">REPORT</a> -->
                        <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>Invoice. Date.</th>
                                    <th>Invoice. No.</th>
                                    <th>So. No.</th>
                                    <th>C.Name</th>
                                    <th>Project</th>
                                    <th>Product Name</th>
                                    <th>Comm.</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Status</th>
                                    <th>Sales Person</th>
                                    <th class="col-lg-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($sale_commission)) {
                                    $total = 0;
                                    $total_qty = 0;
                                    $total_received = 0;
                                    $total_due = 0;
                                    $total_commission = 0;
                                    $i = 0;
                                    foreach ($sale_commission as $invoice) {
                                        $due = 0;
                                        $due = $invoice['total_amount'] - $invoice['received_amount'];
                                        $due_qty = $due / $invoice['unit_price'];
                                        $c = round(abs($invoice['commission'] * ($invoice['total_qty'] - $due_qty)));
                                        if ($c > 0) {

                                            $total_qty = $total_qty + $invoice['total_qty'];
                                            $total = $total + $invoice['total_amount'];
                                            $total_received = $total_received + $invoice['received_amount'];
                                            $total_commission += abs($invoice['commission'] * ($invoice['total_qty'] - $due_qty));
                                            $i++;

                                ?>
                                            <tr>
                                                <td style="white-space:nowrap"><?php if (!empty($invoice['sale_invoice_date'])) echo date('d-m-Y', strtotime($invoice['sale_invoice_date'])); ?></td>
                                                <td><a target="_blank" href="<?php echo site_url('sale_invoices/details_sale_invoice/') . '/' . $invoice['inv_id']; ?>"><?php echo $invoice['inv_no']; ?></a></td>
                                                <td><a target="_blank" href="<?php echo site_url('sale_orders/details_sale_order/') . '/' . $invoice['o_id']; ?>"><?php echo $invoice['order_no']; ?></a></td>
                                                <td><a target="_blank" href="<?php echo site_url('customers/details_customer/') . '/' . $invoice['customer_id']; ?>"><?php echo $invoice['c_name']; ?></a></td>
                                                <td><a target="_blank" href="<?php echo site_url('projects/details_project/') . '/' . $invoice['project_id']; ?>"><?php echo $invoice['project_name']; ?></a></td>
                                                <td><?php echo $invoice['product_name']; ?></td>
                                                <td style="text-align: right;"><?php echo round(abs($invoice['commission'] * ($invoice['total_qty'] - $due_qty)), 2); ?></td>
                                                <td style="text-align: right;"><?php echo round($invoice['com_paid'], 2); ?></td>
                                                <td style="text-align: right;"><?php echo round($c-$invoice['com_paid'], 2); ?></td>
                                                <td style="text-align: right;"><?php echo $invoice['com_status']; ?></td>
                                                <td style="text-align: right;"><?php echo $invoice['name']; ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-success" onclick="pay_now(<?php echo !empty($invoice['o_details_id']) ? $invoice['o_details_id'] : ''; ?>,<?php echo $c ? $c : '0'; ?>,<?php echo $invoice['com_paid'] ?  $invoice['com_paid'] : '0'; ?>)">Pay Now</button>
                                                    <a class="btn btn-sm btn-success" href="<?php echo site_url('sale_orders/commission_payment_hostory') . '/' . $invoice['o_details_id']; ?>">Payment History</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
                    <label>Commission Amount</label>
                    <input type="text" readonly class="form-control" id="commission_amount">
                    <label>Paid Amount</label>
                    <input type="text" readonly class="form-control" id="paid_amt">
                    <label>Due Amount</label>
                    <input type="text" readonly class="form-control" id="due_amt">
                    <label>Payment Amount</label>
                    <input type="text" class="form-control" id="payment_amt">
                    <label>Payment Date</label>
                    <input type="date" class="form-control" id="payment_date">
                    <input type="hidden" class="form-control" id="o_details_id">
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
    function pay_now(id, total, paid) {
        if (!paid) {
            paid = 0;
        }
        $('#o_details_id').val(id);
        $('#commission_amount').val(total);
        $('#paid_amt').val(paid);
        $('#due_amt').val((total - paid).toFixed(2));
        $('#paymetModal').modal('show');

    }

    function confirmPayment() {

        if (Number($('#payment_amt').val()) > Number($('#due_amt').val())) {
            alert('Payment amount is bigger than due amount.');
            return false;
        } else {
            $.ajax({
                url: '<?php echo site_url('sale_orders/confirm_commission_payment'); ?>',
                data: {
                    'id': $('#o_details_id').val(),
                    'amt': $('#payment_amt').val(),
                    'payment_date': $('#payment_date').val(),
                    'commission_amount': $('#commission_amount').val()
                },
                method: 'POST',
                dataType: 'text',
                success: function(msg) {
                    $('#payment_amt').val('');
                    location.reload();
                }

            })
        }

    }
</script>