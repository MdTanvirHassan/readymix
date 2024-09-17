<style>
    .btn-sm {
        padding: 2px 5px !important;
    }

    .table-input {
        width: 100%;
        text-align: right;
    }

    th {
        text-align: center;
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

                        <?php if (!empty($team_id) && !empty($sales_team)) {
                            echo '<h1 style="text-align:center;">' . $sales_team[0]['team_name'] . '</h1>';
                        } ?>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Employee Name</th>
                                <?php if (empty($team_id)) { ?>
                                    <th>Team Name</th>
                                <?php } ?>
                                <th>Target</th>
                                <th>Achive</th>
                                <th>Incentiveable Amount</th>
                                <th>Incentive (%)</th>
                                <th>Collection</th>
                                <th>Incentive Amount</th>
                                <th>Paid</th>
                                <th>Pay</th>
                            </tr>
                            <?php
                            $total = 0;
                            foreach ($sales_team as $row) { ?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <?php if (empty($team_id)) { ?>
                                        <td><?php echo $row['team_name']; ?></td>
                                    <?php } ?>
                                    <td style="text-align:right"><?php echo $row['target'][0]['total']; ?></td>
                                    <td style="text-align:right"><?php echo $row['achive'][0]['total']; ?></td>
                                    <td style="text-align:right"><?php echo $row['incentiable_amount']; ?></td>
                                    <td style="text-align:right"><?php echo $row['incentive_percent']; ?>%</td>
                                    <td style="text-align:right"><?php echo $row['collection'][0]['total']; ?></td>
                                    <td style="text-align:right">
                                        <?php
                                        if ($row['target'][0]['total'] <= $row['collection'][0]['total']) {
                                            $ins = $row['collection'][0]['total'] - $row['target'][0]['total'];
                                            $total += round(($ins * $row['incentive_percent']) / 100, 2);
                                            echo round(($ins * $row['incentive_percent']) / 100, 2);
                                        } else {
                                            echo '0.00';
                                        } ?>
                                    </td>
                                    <td>
                                    <?php echo $row['paid']; ?>
                                    </td>
                                    <td>
                                        <?php if ((($ins * $row['incentive_percent']) / 100) > 0 && ($row['paid']<(($ins * $row['incentive_percent']) / 100))) { ?>
                                            <a class="btn btn-sm btn-primary" href="javascript:" onclick="pay_now(<?php echo $row['employee_id']; ?>,'<?php echo round(($ins * $row['incentive_percent']) / 100, 2); ?>')">Pay Now</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th style="text-align:right" colspan=" <?php if (empty($team_id)) {
                                                                            echo '7';
                                                                        } else {
                                                                            echo '6';
                                                                        } ?>">Total</th>
                                <th style="text-align:right"><?php echo $total; ?></th>
                            </tr>
                        </table>
                        <!-- <button class="btn btn-primary pull-right" onclick="confirmIncentive()">Confirm Incentive</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo site_url('sale_target/add_sales_team'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Sales Team</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Team Name</label>
                        <input type="text" class="form-control" require name="team_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Team</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function pay_now(employee_id, amount) {
        var amt = prompt("Are you sure you want to pay ", amount);
        if (amt == null || amt == "") {
            return false
        } else {
            $.ajax({
                url: '<?php echo site_url('sale_target/confim_payment'); ?>',
                type: 'POST',
                dataType: "text",
                data: {
                    'id': employee_id,
                    'amount': amt,
                    'month': '<?php echo $month; ?>'
                },
                success: function(data) {
                    alert(data)
                }
            })
        }
    }

    function confirmIncentive() {
        var ids = new Array();
        $('.incentive').each(function() {
            if ($(this).is(':checked')) {
                ids.push($(this).val());
            }
        })
        if (ids.length > 0) {
            $.ajax({
                url: '<?php echo site_url('sale_target/confirm_incentive'); ?>',
                type: 'POST',
                dataType: "text",
                data: {
                    'ids': ids,
                    'month': '<?php echo $month; ?>'
                },
                success: function(data) {
                    alert(data)
                }
            })
        }
    }

    var aa = 0;

    function changeGroupContribution(id) {
        var aa = 0;
        var tt = 0;
        $('.teamGroup_' + id).each(function(i, v) {
            var contribution = Number($(v).val());
            var team_con = $('#actual_' + id).attr('rel')
            var team_con_now = $('#actual_' + id).val()
            var mem_con = $('#team_' + id + '_' + mem).attr('rel')
            var mem_con_now = $('#team_' + id + '_' + mem).val()

            var mem = $(v).attr('id').split('_')[2];
            $('.qty_' + id + '_' + mem).each(function(j, k) {
                $(this).val((((Number($(k).val()) * 100) / team_con) * team_con_now) / 100);
            })

            $('.value_' + id + '_' + mem).each(function(j, k) {

                $(this).val((((Number($(k).val()) * 100) / team_con) * team_con_now) / 100);
                var as = (((Number($(k).val()) * 100) / team_con) * team_con_now) / 100;
                aa = as;
                console.log('Total:' + aa)
            })
            tt += aa;
            $('#total_' + id + '_' + mem).val(aa);
        })
        $('#group_total_' + id).val(tt);
    }
</script>