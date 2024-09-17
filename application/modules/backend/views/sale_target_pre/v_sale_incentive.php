<style>
    .btn-sm {
        padding: 2px 5px !important;
    }
</style>
<?php
$user_id = $this->session->userdata('user_id');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(7, 97, $userData);
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <?php require_once(__DIR__ . '/../sales_target_header.php'); ?>
        </div>
    </div>
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <?php if (in_array(2, $this->role)) { ?>
                            <a href="javascript:" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-primary">ADD SALES INCENTIVE</a>
                        <?php } ?>
                        <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr>

                                    <th class="col-lg-2">Incetive Title</th>
                                    <th class="col-lg-1">Start From</th>
                                    <th class="col-lg-1">End To</th>
                                    <th class="col-lg-1">Start Date</th>
                                    <th class="col-lg-1">End Date</th>
                                    <th class="col-lg-1">Type</th>
                                    <th class="col-lg-1">Incetive Value</th>

                                    <th class="col-lg-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($sale_incentive)) {
                                    foreach ($sale_incentive as $order) { ?>
                                        <tr id="item_<?php echo $order['id']; ?>">
                                            <td>
                                                <?php if (!empty($order['title'])) echo $order['title']; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($order['start_amount'])) echo $order['start_amount']; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($order['end_amount'])) echo $order['end_amount']; ?>
                                            </td>
                                            <td>
                                                <?php if ($order['start_date'] !== '1970-01-01 00:00:00') echo date('d-m-Y', strtotime($order['start_date'])); ?>
                                            </td>
                                            <td>
                                                <?php if ($order['end_date'] !== '1970-01-01 00:00:00') echo date('d-m-Y', strtotime($order['end_date'])); ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($order['type'])) echo $order['type']; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($order['incentive'])) echo $order['incentive']; ?>
                                            </td>
                                            <td>

                                                <?php if (in_array(3, $this->role)) { ?>
                                                    <a href="javascript:" onclick="EditItem(<?php echo $order['id']; ?>)"><button class="btn btn-sm btn-info">Edit</button></a>
                                                <?php } ?>


                                                <?php if (in_array(5, $this->role)) { ?>
                                                    <button onclick="delete_row('<?php echo site_url('sale_target/delete_sale_incentive/' . $order['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo site_url('sale_target/add_sales_incentive'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Sales Incentive</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Incentive Title <span class="required">*</span></label>
                            <input type="text" class="form-control" require name="title">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Incentive Type</label>
                            <select class="form-control" name="type">
                                <option value="percent">Percent(%)</option>
                                <option value="amount">Amount</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Incentive Value <span class="required">*</span></label>
                            <input type="number" class="form-control" require name="incentive" step="any">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Amount From</label>
                            <input type="number" class="form-control" name="start_amount">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>End Amount To</label>
                            <input type="number" class="form-control" name="end_amount">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="text" class="form-control datetimepicker" name="start_date">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="text" class="form-control datetimepicker" name="end_date">
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Incentive</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo site_url('sale_target/update_sales_incentive'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Sales Incentive</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Incentive Title <span class="required">*</span></label>
                            <input type="text" class="form-control" require id="title" name="title">
                            <input type="hidden" class="form-control" id="incentive_id" name="incentive_id">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Incentive Type</label>
                            <select class="form-control" id="type" name="type">
                                <option value="percent">Percent(%)</option>
                                <option value="amount">Amount</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Incentive Value <span class="required">*</span></label>
                            <input type="number" class="form-control" require id="incentive" name="incentive" step="any">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Amount From</label>
                            <input type="number" class="form-control" id="start_amount" name="start_amount">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>End Amount To</label>
                            <input type="number" class="form-control" id="end_amount" name="end_amount">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="text" class="form-control datetimepicker" id="start_date" name="start_date">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="text" class="form-control datetimepicker" id="end_date" name="end_date">
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Incentive</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function EditItem(id) {
        $('#exampleModal1').find('form').trigger("reset");
        $('#title').val($('#item_' + id).find('td').eq(0).html().trim());
        $('#type').val($('#item_' + id).find('td').eq(5).html().trim());
        $('#incentive').val($('#item_' + id).find('td').eq(6).html().trim());
        $('#start_amount').val($('#item_' + id).find('td').eq(1).html().trim());
        $('#end_amount').val($('#item_' + id).find('td').eq(2).html().trim());
        $('#start_date').val($('#item_' + id).find('td').eq(3).html().trim());
        $('#end_date').val($('#item_' + id).find('td').eq(4).html().trim());
        $('#incentive_id').val(id);
        $('#exampleModal1').modal('show');
    }
</script>