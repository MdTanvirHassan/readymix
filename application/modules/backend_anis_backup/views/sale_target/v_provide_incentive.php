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
                        <label for="title" class="col-sm-2 control-label">
                            Search by Month<sup class="required">*</sup> :
                        </label>
                        <form action="<?php echo site_url('backend/sale_target/provide_incentive') ?>" method="post">
                            <div class="col-sm-3 input-group">

                                <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                <input class="form-control monthpicker pull-left" style="width:200px" id="month" name="month" type="text" value="<?php echo $month; ?>">
                                <span id="month_error" style="color:red"></span>

                            </div>
                            <div class="col-sm-3 input-group">
                                <select name="category" class="form-control">
                                    <?php foreach ($cat as $c) { ?>
                                        <option <?php if ($cat_name[0]['category_id'] == $c['category_id']) echo 'selected'; ?> value="<?php echo $c['category_id']; ?>"><?php echo $c['category_name']; ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                            <input type="submit" value="Search" class="btn btn-primary pull-left" style="z-index:99;margin:0px;margin-left:-1px;">
                            <a target="_blank" href="<?php echo site_url('backend/sale_target/print_provide_incentive/' . $cat_name[0]['category_id'] . '/' . $month) ?>"><input type="button" value="Print" class="btn btn-primary pull-left" style="z-index:99;margin:0px;margin-left:10px;"></a>
                        </form>
                        <h3 style="text-align: center;">COMPANY TARGET INCENTIVE REPORT</h3>
                        <h6 style="text-align: center;">Product : <?php echo $cat_name[0]['category_name']; ?></h6>
                        <table class="table table-striped table-bordered" style="width:100%">
                            <tr>
                                <th>Target Qty</th>
                                <td><?php echo $company_target[0]['quantity']; ?></td>

                                <th>BEP Qty</th>
                                <td><?php echo $company_target[0]['bep_qty']; ?></td>

                                <th>Achievement Qty</th>
                                <td><?php echo $company_achive[0]['quantity']; ?></td>

                                <th>Status</th>
                            </tr>
                            <tr>

                                <th>Target Value</th>
                                <td><?php echo $company_target[0]['amount']; ?></td>

                                <th>BEP Value</th>
                                <td><?php echo $company_target[0]['bep_amount']; ?></td>

                                <th>Achievement Value</th>
                                <td><?php echo $company_achive[0]['total']; ?></td>
                                <th>
                                    <?php if ($company_achive[0]['quantity'] > $company_target[0]['quantity']) { ?>
                                        <span class="glyphicon glyphicon-ok text-success"></span>
                                    <?php } else { ?>
                                        <span class="glyphicon glyphicon-remove text-danger"></span>
                                    <?php } ?>
                                </th>
                            </tr>
                        </table>
                        <table class="table table-striped table-bordered" style="width:100%">

                            <tr>
                                <!-- <th>SN</th> -->
                                <th style="width:80px;">TEAM</th>
                                <th>EMPLOYEE</th>
                                <th>TARGET UNIT</th>
                                <th>ACHIVE UNIT</th>
                                <th>ACHIEVE (%)</th>
                                <th>STATUS</th>
                                <th>Amount</th>
                                <th>Realized</th>
                                <th>Realized (%)</th>
                                <th>Incentiveable Qty</th>
                                <th>Incentive Amount</th>
                            </tr>
                            <?php
                            $total = 0;
                            $achive_total = 0;
                            $dtotal = 0;
                            $target_total = 0;
                            $realize_total = 0;
                            $incentive_total = 0;
                            $diff_qty_total = 0;
                            $i = 0;
                            $j = 0;
                            foreach ($teams as $k => $targets) {
                                $j++;
                                foreach ($targets as $key => $target) {
                                    $i++;

                                    $total += $target['target_qty'];
                                    if ($target['achive_quantity'] == 0)
                                        $percent = 0;
                                    elseif ($target['target_value'] == 0)
                                        $percent = $target['achive_quantity'];
                                    else
                                        $percent = ($target['achive_quantity'] * 100) / $target['target_qty'];

                                    $diff_total = $target['achive_total'] - $target['target_value'];
                                    $diff_qty = $target['achive_quantity'] - (($target['target_qty']*$ins[0]['start_amount'])/100);
                                    $v_percent = $percent - 100;
                                    if ($v_percent > 0) {
                                        $incentive = calculate_incentive($target);
                                        $incentive_total += $incentive;
                                    } else {
                                        $incentive = 0;
                                    }
                                    $achive_total += $target['achive_quantity'];
                                    $target_total += $target['target_value'];
                                    $realize_total += $target['paid'];
                                    $dtotal += $target['achive_total'];
                                    if ($v_percent > 0)
                                        $diff_qty_total += $diff_qty;
                            ?>

                                    <tr>

                                        <?php if ($key == 0) { ?>
                                            <td style="vertical-align: middle;" rowspan="<?php echo count($targets); ?>"><?php echo $target['team_name']; ?></td>
                                        <?php } ?>
                                        <td style="vertical-align: middle;"><a title="Click Here for Details Report" target="_blank" href="<?php echo site_url('backend/sale_target/employee_achievement/' . $month . '/' . $target['employee_id']) ?>"><?php echo $target['name']; ?></a></td>

                                        <td style="text-align:right;"><?php echo number_format($target['target_qty'], 2); ?></td>
                                        <td style="text-align:right;"><?php echo number_format($target['achive_quantity'], 2); ?></td>
                                        <?php if ($v_percent > 0) { ?>
                                            <td style="text-align:right;"><?php echo number_format(($target['target_qty'] > 0) ? $v_percent : 0, 2); ?></td>
                                        <?php } else { ?>
                                            <td style="text-align:right;">(<?php echo number_format(($target['target_qty'] > 0) ? abs($v_percent) : 0, 2); ?>)</td>
                                        <?php } ?>
                                        <td>
                                            <?php if ($v_percent > 0) { ?>
                                                <span class="glyphicon glyphicon-ok text-success"></span>
                                            <?php } else { ?>
                                                <span class="glyphicon glyphicon-remove text-danger"></span>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: right;"><?php echo number_format($target['achive_total'], 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($target['paid'], 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format((((($target['paid'] * 100) / $target['achive_total']) > 0) ? (($target['paid'] * 100) / $target['achive_total']) : 0), 2); ?></td>
                                        <td style="text-align: right;"><?php
                                                                        if ($v_percent > 0)
                                                                            echo number_format($diff_qty, 2);
                                                                        else
                                                                            echo '0.00';
                                                                        ?></td>
                                        <td style="text-align: right;"><?php echo number_format($incentive, 2); ?></td>
                                    </tr>

                            <?php
                                }
                            }
                            ?>
                            <tr>
                                <td style="text-align:right;" colspan="2">Total</td>
                                <td style="text-align:right;"><?php echo number_format($total, 2); ?></td>
                                <td style="text-align:right;"><?php echo number_format($achive_total, 2); ?></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:right;"><?php echo number_format($dtotal, 2); ?></td>

                                <td style="text-align:right;"><?php echo number_format($realize_total, 2); ?></td>
                                <td style="text-align:right;"></td>
                                <td style="text-align:right;"><?php echo number_format($diff_qty_total, 2); ?></td>
                                <td style="text-align:right;"><?php echo number_format($incentive_total, 2); ?></td>

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