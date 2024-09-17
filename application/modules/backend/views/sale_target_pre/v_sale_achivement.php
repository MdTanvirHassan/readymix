<style>
    .btn-sm {
        padding: 2px 5px !important;
    }

    .table-input {
        width: 100%;
        text-align: right;
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
                                <th colspan="4" style="text-align: center;;">Company Target</th>
                            </tr>
                            <tr>
                                <th>Actual Target</th>
                                <th>Break Even Point</th>
                                <th>Achive</th>
                                <th>Status</th>
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
                            </tr>
                        </table>
                        <table class="table table-striped table-bordered">
                            <tr style="background:#e5e5e5">
                                <th rowspan="2">Team Name</th>
                                <th rowspan="2">Employee Name</th>
                                <?php foreach ($cat as $c) { ?>
                                    <th style="text-align:center;" colspan="2"> <?php echo $c['category_name']; ?></th>
                                <?php } ?>
                                <th style="text-align:center;" colspan="4">Team</th>
                            </tr>
                            <tr style="background:#e5e5e5">
                                <?php foreach ($cat as $c) { ?>
                                    <th style="text-align:center;">Target</th>
                                    <th style="text-align:center;">Achive</th>
                                <?php } ?>
                                <th style="text-align:center;">Target</th>
                                <th style="text-align:center;">Achive</th>
                                <th style="text-align:center;">Status</th>
                                <th style="text-align:center;">Incentive</th>
                            </tr>
                            <?php foreach ($targets as $team) { ?>

                                <?php
                                $key = 0;
                                $team_total_target = 0;
                                $team_total_achive = 0;
                                foreach ($team['employee'] as $tema_id => $target) { ?>
                                    <tr>
                                        <?php if ($key == 0) { ?>
                                            <td rowspan="<?php echo count($team['employee']); ?>"><?php echo $team['team_name']; ?></td>
                                        <?php } ?>
                                        <td><?php echo $target['name']; ?></td>
                                        <?php
                                        $total_target = 0;
                                        $total_achive = 0;
                                        foreach ($cat as $c) {
                                            $team_total_target += $target['achive'][$c['category_id']]['target_value'];
                                            $total_target += $target['achive'][$c['category_id']]['target_value'];
                                            $total_achive += $target['achive'][$c['category_id']]['total'];
                                            $team_total_achive += $target['achive'][$c['category_id']]['total'];
                                        ?>
                                            <!-- <td><?php echo $target['achive'][$c['category_id']]['target_qty']; ?></td>
                                        <td><?php echo $target['achive'][$c['category_id']]['quantity']; ?></td> -->
                                            <td style="text-align:right;"><?php echo $target['achive'][$c['category_id']]['target_value']; ?></td>
                                            <td style="text-align:right;"><?php echo $target['achive'][$c['category_id']]['total']; ?></td>
                                        <?php } ?>
                                        <?php if (($key == 0)) { ?>
                                            <td rowspan="<?php echo count($team['employee']); ?>" style="text-align:center;">
                                                <?php echo $team['target']; ?>
                                            </td>
                                            <td rowspan="<?php echo count($team['employee']); ?>" style="text-align:center;">
                                                <?php echo $team['achive']; ?>
                                            </td>
                                            <td rowspan="<?php echo count($team['employee']); ?>" style="text-align:center;">
                                                <?php if ($team['target'] < $team['achive']) { ?>
                                                    <span class="glyphicon glyphicon-ok text-success"></span>
                                                <?php } else { ?>
                                                    <span class="glyphicon glyphicon-remove text-danger"></span>
                                                <?php } ?>
                                            </td>
                                            <td rowspan="<?php echo count($team['employee']); ?>" ><input class="incentive" id="incentive_<?php echo $team['id']; ?>" <?php if($team['exists_acive']==1) echo 'checked'; ?> value="<?php echo $team['id']; ?>" type="checkbox"></td>
                                        <?php } ?>
                                    </tr>
                                <?php
                                    $key++;
                                } ?>
                            <?php } ?>
                        </table>
                        <button class="btn btn-primary pull-right" onclick="confirmIncentive()">Confirm Incentive</button>
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

function confirmIncentive(){
    var ids = new Array();
    $('.incentive').each(function(){
        if($(this).is(':checked')){
            ids.push($(this).val());
        }
    })
    if(ids.length>0){
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