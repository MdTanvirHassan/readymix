<style>
    .btn-sm {
        padding: 2px 5px !important;
    }

    .table-input {
        width: 100%;
        text-align: right;
    }
    th{
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
                        <form action="<?php echo site_url('backend/sale_target/achivement') ?>" method="post">
                            <div class="col-sm-4 input-group">

                                <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                <input class="form-control monthpicker pull-left" style="width:200px" id="month" name="month" type="text" value="<?php echo $month; ?>">
                                <span id="month_error" style="color:red"></span>
                                <input type="submit" value="Search" class="btn btn-primary pull-left" style="z-index:99;margin:0px;margin-left:-1px;">

                            </div>
                        </form>
                        <table class="table table-striped table-bordered">
                            <tr style="background:#e5e5e5">
                                <th colspan="5" style="text-align: center;;">Company Target</th>
                            </tr>
                            <tr>
                                <th>Actual Target</th>
                                <th>Break Even Point</th>
                                <th>Achive</th>
                                <th>Status</th>
                                <th>Employee Report</th>
                            </tr>
                            <tr>
                                <td><?php echo $company_target[0]['total_amount']; ?></td>
                                <td><?php echo $company_target[0]['bep_total']; ?></td>
                                <td><?php echo $company_achive[0]['total']; ?></td>
                                <td>
                                    <?php if ($company_target[0]['bep_total'] < $company_achive[0]['total']) { ?>
                                        <span class="glyphicon glyphicon-ok text-success"></span>
                                    <?php } else { ?>
                                        <span class="glyphicon glyphicon-remove text-danger"></span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a target="_blank" class="btn btn-sm btn-primary" href="<?php echo site_url('sale_target/provide_incentive_employee'); ?>">All Employee Report</a>
                                    </td>
                            </tr>
                        </table>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Team Name</th>
                                <th>Target</th>
                                <th>Achive</th>
                                <th>Incentiveable Amount</th>
                                <th>Incentive (%)</th>
                                <th>Collection</th>
                                <th>Incentive Amount</th>
                                <th>Employee Reort</th>
                            </tr>
                            <?php foreach ($sales_team as $row) { ?>
                                <tr>
                                    <td><?php echo $row['team_name']; ?></td>
                                    <td><?php echo $row['target'][0]['total']; ?></td>
                                    <td><?php echo $row['achive'][0]['total']; ?></td>
                                    <td><?php 
                                    if($row['achive'][0]['total'] - $row['target'][0]['total']>0)
                                    echo $row['achive'][0]['total'] - $row['target'][0]['total']; 
                                    else 
                                    echo '0.00';
                                    ?></td>
                                    <td><?php echo $row['incentive_percent']; ?>%</td>
                                    <td><?php echo $row['collection'][0]['total']; ?></td>
                                    <td>
                                        <?php
                                        if ($row['target'][0]['total'] <= $row['collection'][0]['total']) {
                                            $ins = $row['collection'][0]['total'] - $row['target'][0]['total'];
                                            echo round(($ins * $row['incentive_percent']) / 100, 2);
                                        } else {
                                            echo '0.00';
                                        } ?>
                                    </td>
                                    <td>
                                    <a target="_blank" class="btn btn-sm btn-primary" href="<?php echo site_url('sale_target/provide_incentive_employee/'.$row['team_id']); ?>">Employee Report</a>
                                    </td>
                                </tr>
                            <?php } ?>
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