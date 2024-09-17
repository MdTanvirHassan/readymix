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
                <h3>Sale Commission Payment List</h3>
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
                                    <th>Date.</th>
                                    <th>Amount</th>
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
                                            $i++;
                                ?>
                                            <tr>
                                                <td style="white-space:nowrap"><?php if (!empty($invoice['date'])) echo date('d-m-Y', strtotime($invoice['date'])); ?></td>
                                               
                                                <td style="text-align: right;"><?php echo $invoice['amount']; ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-success" href="javascript:" onclick="pay_now(<?php echo !empty($invoice['id']) ? $invoice['id'] : ''; ?>,<?php echo $invoice['amount'] ?  $invoice['amount'] : '0'; ?>)">Edit</a>
                                                    <a class="btn btn-sm btn-info" href="<?php echo site_url('sale_orders/view_commission_payment_hostory') . '/' . $invoice['id']; ?>">View</a>
                                                    <button onclick="delete_row('<?php echo site_url('sale_orders/delete_commission_payment_hostory/'.$invoice['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                                </td>
                                            </tr>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Payment Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Paid Amount</label>
                    <input type="text" class="form-control" id="payment_amt">
                    <label>Payment Date</label>
                    <input type="date" class="form-control" id="payment_date">
                    <input type="hidden" class="form-control" id="id">
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
    function pay_now(id, total) {
        if (!total) {
            total = 0;
        }
        $('#id').val(id);
        $('#payment_amt').val(total);
        $('#paymetModal').modal('show');

    }

    function confirmPayment() {

        if (Number($('#payment_amt').val()) <= 0) {
            alert('Please Enter Any Payment.');
            return false;
        } else {
            $.ajax({
                url: '<?php echo site_url('sale_orders/update_confirm_commission_payment'); ?>',
                data: {
                    'id': $('#id').val(),
                    'payment_date': $('#payment_date').val(),
                    'amt': $('#payment_amt').val()
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