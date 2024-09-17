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
                        <form action="<?php echo site_url('backend/sale_target/distribution') ?>" method="post">
                            <div class="col-sm-4 input-group">

                                <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                <input class="form-control monthpicker pull-left" style="width:200px" id="month" name="month" type="text" value="<?php echo $month; ?>">
                                <span id="month_error" style="color:red"></span>
                                <input type="submit" value="Search" class="btn btn-primary pull-left" style="z-index:99;margin:0px;margin-left:-1px;">


                            </div>
                        </form>
                        <form action="<?php echo site_url('backend/sale_target/save_distribution') ?>" method="post">
                            <input type="hidden" name="sales_month" value="<?php echo $month; ?>">
                            <table class="table table-striped table-bordered table-hover no-footer">
                                <thead>
                                    <tr>

                                        <th class="col-lg-1" rowspan="2">Group Name</th>
                                        <th class="col-lg-1" rowspan="2">Group Contribution(%)</th>
                                        <th class="col-lg-2" rowspan="2">Member</th>
                                        <th class="col-lg-1" rowspan="2">Contribution(%)</th>
                                        <th class="col-lg-3" style="text-align:center;" colspan="<?php echo count($target_details); ?>">Quantity</th>
                                        <th class="col-lg-3" style="text-align:center;" colspan="<?php echo count($target_details); ?>">Value</th>
                                        <th class="col-lg-1" style="text-align:center;" rowspan="2">Total</th>
                                        <th class="col-lg-1" style="text-align:center;" rowspan="2">Group Total</th>
                                    </tr>
                                    <tr>
                                        <?php foreach ($target_details as $item) { ?>
                                            <th class="col-lg-1"><?php echo $item['short_name']; ?></th>
                                        <?php } ?>
                                        <?php foreach ($target_details as $item) { ?>
                                            <th class="col-lg-1"><?php echo $item['short_name']; ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $Finaltotal = 0;
                                    foreach ($teams as $t => $team) {

                                    ?>
                                        <tr>
                                            <td style="vertical-align: middle;" rowspan="<?php echo count($team['members']); ?>"><?php echo $team['team_name']; ?>
                                                <input class="table-input" type="hidden" name="team_id[]" value="<?php echo $team['id']; ?>">
                                            </td>
                                            <td style="vertical-align: middle;" rowspan="<?php echo count($team['members']); ?>">
                                                <?php if (!empty($team['existing'])) { ?>
                                                    <input class="table-input" type="text" id="actual_<?php echo $team['id']; ?>" rel="<?php echo $team['existing'][0]['contribution']; ?>" onchange="changeGroupContribution(<?php echo $team['id']; ?>)" name="team_contribution[]" value="<?php echo $team['existing'][0]['contribution']; ?>">
                                                <?php } else { ?>
                                                    <input class="table-input" type="text" id="actual_<?php echo $team['id']; ?>" rel="<?php echo (100 / count($teams)); ?>" onchange="changeGroupContribution(<?php echo $team['id']; ?>)" name="team_contribution[]" value="<?php echo (100 / count($teams)); ?>">
                                                <?php } ?>
                                            </td>

                                            <?php
                                            $group_total = 0;
                                            foreach ($team['members'] as $key => $member) {
                                                $total = 0;

                                            ?>

                                                <td><?php echo $member['name']; ?>
                                                    <input class="table-input" type="hidden" name="employee[<?php echo $team['id']; ?>][]" value="<?php echo $member['id']; ?>">
                                                </td>
                                                <td>
                                                    <?php if (!empty($member['existing'])) { ?>
                                                        <input type="text" name="contribution[<?php echo $team['id']; ?>][]" rel="<?php echo $member['existing'][0]['contribution']; ?>" id="team_<?php echo $member['team_id']; ?>_<?php echo $member['id']; ?>" class="table-input teamGroup_<?php echo $member['team_id']; ?>" value="<?php echo $member['existing'][0]['contribution']; ?>">
                                                    <?php } else { ?>
                                                        <input type="text" name="contribution[<?php echo $team['id']; ?>][]" rel="<?php echo $member['contribution']; ?>" id="team_<?php echo $member['team_id']; ?>_<?php echo $member['id']; ?>" class="table-input teamGroup_<?php echo $member['team_id']; ?>" value="<?php echo $member['contribution']; ?>">
                                                    <?php } ?>
                                                </td>
                                                <?php foreach ($target_details as $item) { ?>
                                                    <?php if (!empty($member['cat'][$item['category_id']])) { ?>
                                                        <th class="col-lg-1"><input type="text" class="table-input qty_<?php echo $member['team_id']; ?>_<?php echo $member['id']; ?>" class="table-input" name="qty[<?php echo $team['id']; ?>][<?php echo $member['id']; ?>][<?php echo $item['category_id']; ?>]" value="<?php echo round($member['cat'][$item['category_id']][0]['target_category'], 2); ?>"></th>
                                                    <?php } else { ?>
                                                        <th class="col-lg-1"><input type="text" class="table-input qty_<?php echo $member['team_id']; ?>_<?php echo $member['id']; ?>" class="table-input" name="qty[<?php echo $team['id']; ?>][<?php echo $member['id']; ?>][<?php echo $item['category_id']; ?>]" value="<?php echo round((($item['quantity'] / count($teams)) * $member['contribution']) / 100, 2); ?>"></th>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php foreach ($target_details as $item) {
                                                    $total += round((($item['amount'] / count($teams)) * $member['contribution']) / 100, 2);
                                                ?>
                                                    <th class="col-lg-1"><input type="text" class="table-input value_<?php echo $member['team_id']; ?>_<?php echo $member['id']; ?>" name="value[<?php echo $team['id']; ?>][<?php echo $member['id']; ?>][<?php echo $item['category_id']; ?>]" value="<?php echo round((($item['amount'] / count($teams)) * $member['contribution']) / 100, 2); ?>"></th>
                                                <?php } ?>
                                                <th class="col-lg-1">
                                                    <input type="text" class=" table-input" id="total_<?php echo $member['team_id']; ?>_<?php echo $member['id']; ?>" name="total[<?php echo $member['id']; ?>]" value="<?php echo $total; ?>">
                                                    <?php
                                                    $Finaltotal += $total;
                                                    $group_total += $total;
                                                    ?>
                                                </th>
                                                <?php if ($key == 0) { ?>
                                                    <th style="vertical-align: middle;" rowspan="<?php echo count($team['members']); ?>">
                                                        <input type="text" class="table-input" id="group_total_<?php echo $member['team_id']; ?>" name="group_total[<?php echo $team['id']; ?>]" value="<?php echo ($targets[0]['total_amount'] / count($teams)); ?>">
                                                    </th>
                                                <?php } ?>
                                        </tr>
                                <?php }
                                        } ?>
                                <tr>
                                    <th colspan="9" style="text-align: right;">Total</th>
                                    <th style="text-align: right;"><?php echo $Finaltotal; ?></th>
                                </tr>
                                <tr>
                                    <th colspan="10" style="text-align: right;"><input type="submit" class="btn btn-primary" value="Save Distribution"></th>
                                </tr>
                                </tbody>
                            </table>
                        </form>
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