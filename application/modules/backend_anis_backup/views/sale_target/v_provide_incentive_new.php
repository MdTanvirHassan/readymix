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
                            <div class="col-sm-4 input-group">

                                <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                <input class="form-control monthpicker pull-left" style="width:200px" id="month" name="month" type="text" value="<?php echo $month; ?>">
                                <span id="month_error" style="color:red"></span>
                                <input type="submit" value="Search" class="btn btn-primary pull-left" style="z-index:99;margin:0px;margin-left:-1px;">

                            </div>
                            <a target="_blank" href="<?php echo site_url('backend/sale_target/employee_taarget_achivement_report_print/'.$month) ?>"><input type="button" value="Print" class="btn btn-primary pull-left" style="z-index:99;margin:0px;margin-left:-1px;"></a>
                            <!-- <a target="_blank" href="<?php echo site_url('backend/sale_target/employee_achievement/'.$month) ?>"><input type="button" value="Employee Achievement" class="btn btn-info pull-left" style="z-index:99;margin:0px;margin-left:-1px;"></a> -->
                        </form>
                        
                        <table class="table table-striped table-bordered" style="width:100%">

                            <tr>
                                <th rowspan="2">SN</th>
                                <th rowspan="2">EMPLOYEE</th>
                                <th rowspan="2">DESIGNATION</th>
                                <th rowspan="2">PRODUCT</th>
                                <th rowspan="2">MU</th>
                                <th colspan="2">TARGET</th>
                                <th colspan="3">ACHIVE</th>
                                <th colspan="3">VARIANCE</th>
                            </tr>
                            <tr>
                                <th>QNTY</th>
                                <th>VALUE</th>
                                <th>QNTY</th>
                                <th>VALUE</th>
                                <th>%</th>
                                <th>QNTY</th>
                                <th>VALUE</th>
                                <th>%</th>
                            </tr>
                            <?php
                            $total = 0;
                            $achive_total = 0;
                            $dtotal = 0;
                            $i = 0;
                            foreach ($targets as $key => $target) {
                                $i++;
                                $total += $target['target_value'];
                                if ($target['achive_quantity'] == 0)
                                    $percent = 0;
                                elseif ($target['target_value'] == 0)
                                    $percent = $target['achive_quantity'];
                                else
                                    $percent = ($target['achive_quantity'] * 100) / $target['target_qty'];

                                 $diff_total = $target['achive_total'] - $target['target_value'];    
                                 $diff_qty = $target['achive_quantity'] - $target['target_qty']; 
                                 $v_percent = $percent-100;
                                 $achive_total += $target['achive_total'];
                                 $dtotal += $diff_total;
                                if ($i == 1) {
                            ?>

                                    <tr>
                                        <td rowspan="2"><?php echo ($key + 1); ?></td>
                                        <td rowspan="2"><a title="Click Here for Details Report" target="_blank" href="<?php echo site_url('backend/sale_target/employee_achievement/'.$month.'/'.$target['employee_id']) ?>"><?php echo $target['name']; ?></a></td>
                                        <td rowspan="2"><?php echo $target['designation_name']; ?></td>
                                        <td><?php echo $target['category_name']; ?></td>
                                        <td><?php echo $target['measurement_unit']; ?></td>
                                        <td style="text-align:right;"><?php echo number_format($target['target_qty'], 2); ?></td>
                                        <td style="text-align:right;"><?php echo number_format($target['target_value'], 2); ?></td>
                                        <td style="text-align:right;"><?php echo number_format($target['achive_quantity'], 2); ?></td>
                                        <td style="text-align:right;"><?php echo number_format($target['achive_total'], 2); ?></td>
                                        <td style="text-align:right;"><?php echo number_format(($target['target_qty']>0) ? $percent : '0', 2); ?></td>
                                        <td style="text-align:right;"><?php echo number_format(($target['target_qty']>0) ? $diff_qty:0, 2); ?></td>
                                        <td style="text-align:right;"><?php echo number_format(($target['target_qty']>0) ? $diff_total:0, 2); ?></td>
                                        <?php if($v_percent>0){ ?>
                                        <td style="text-align:right;"><?php echo number_format(($target['target_qty']>0) ? $v_percent : 0, 2); ?></td>
                                        <?php }else{ ?>
                                        <td style="text-align:right;">(<?php echo number_format(($target['target_qty']>0) ? abs($v_percent) : 0, 2); ?>)</td>
                                        <?php } ?>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td><?php echo $target['category_name']; ?></td>
                                        <td><?php echo $target['measurement_unit']; ?></td>
                                        <td style="text-align:right;"><?php echo number_format($target['target_qty'], 2); ?></td>
                                        <td style="text-align:right;"><?php echo number_format($target['target_value'], 2); ?></td>
                                        <td style="text-align:right;"><?php echo number_format($target['achive_quantity'], 2); ?></td>
                                        <td style="text-align:right;"><?php echo number_format($target['achive_total'], 2); ?></td>
                                        <td style="text-align:right;"><?php echo number_format(($target['target_qty']>0) ? $percent:0, 2); ?></td>
                                        <td style="text-align:right;"><?php echo number_format(($target['target_qty']>0) ? $diff_qty:0, 2); ?></td>
                                        <td style="text-align:right;"><?php echo number_format(($target['target_qty']>0) ? $diff_total:0, 2); ?></td>
                                        <?php if($v_percent>0){ ?>
                                        <td style="text-align:right;"><?php echo number_format(($target['target_qty']>0) ? $v_percent : 0, 2); ?></td>
                                        <?php }else{ ?>
                                        <td style="text-align:right;">(<?php echo number_format(($target['target_qty']>0) ? abs($v_percent) : 0, 2); ?>)</td>
                                        <?php } ?>
                                    </tr>
                                <?php $i = 0;
                                } ?>
                            <?php
                            } ?>
                            <tr>
                                <td style="text-align:right;" colspan="6">Total</td>
                                <td style="text-align:right;"><?php echo number_format($total, 2); ?></td>
                                <td></td>
                                <td style="text-align:right;"><?php echo number_format($achive_total, 2); ?></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:right;"><?php echo number_format($dtotal, 2); ?></td>

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