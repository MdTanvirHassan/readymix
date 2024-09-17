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

                        <div class="page-title" style="padding:0px;margin:0px">
                            <div class="title_center" style="padding:0px;margin:0px;margin-bottom:10px">

                                <div class="col-md-12">
                                    <?php if (in_array(2, $this->role)) { ?>
                                        <a href="javascript:" style="margin-top:10px" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-success pull-left">ADD TEAM MEMBER</a>
                                    <?php } ?>
                                    <h3 style="text-align:center;margin-right:200px;"><?php echo $sale_team[0]['team_name']; ?></h3>
                                </div>

                            </div>
                        </div>
                        <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr>

                                    <th class="col-lg-2">Employee Name</th>
                                    <th class="col-lg-2">Designation</th>
                                    <th class="col-lg-2">Email</th>
                                    <th class="col-lg-1">Phone</th>
                                    <th class="col-lg-1">Salary</th>
                                    <th class="col-lg-1">Contribution(%)</th>

                                    <th class="col-lg-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($team_members)) {
                                    foreach ($team_members as $order) { ?>
                                        <tr>
                                            <td>
                                                <?php if (!empty($order['name'])) echo $order['name']; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($order['designation_name'])) echo $order['designation_name']; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($order['email'])) echo $order['email']; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($order['mobile'])) echo $order['mobile']; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($order['salary'])) echo $order['salary']; ?>
                                            </td>
                                            <td class="contribution" id="contribution_<?php echo $order['team_member_id']; ?>">
                                                <?php
                                                $sl = !empty($order['salary']) ? $order['salary'] : 0;
                                                $cont = $total_salary[0]['total'] / $sl;
                                                if (!empty($order['contribution'])) echo $order['contribution'];
                                                else echo round($cont, 2) ?>
                                            </td>
                                            <td>

                                                <?php if (in_array(5, $this->role)) { ?>
                                                    <button onclick="delete_row('<?php echo site_url('sale_target/delete_sale_team_member/' . $order['team_member_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
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
        <form action="<?php echo site_url('sale_target/add_sales_team_member'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Sales Team</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                            <label>Select Designation</label>
                            <select class="form-control" name="designation" id="designation">
                                <option value="">Choose Any Designation</option>\
                                <option value="">Show All Employee</option>\
                                <?php foreach ($designations as $des) { ?>
                                    <option value="<?php echo $des['id']; ?>"><?php echo $des['designation_name']; ?></option>
                                <?php } ?>
                            </select>           
                        <input type="hidden" id="team_id" name="team_id" value="<?php echo $team_id; ?>">
                    </div>
                    <div id="employee_area" style="display: none;">
                        <div class="page-title">
                            <div class="title_center">
                                <h4 style="text-align:center;">Employee List</h4>
                            </div>
                        </div>

                        <div id="data_list">

                        </div>
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
    $('.contribution').click(function() {
        var ids = $(this).attr('id');
        var id = ids.split('_')[1];
        if ($(this).find('input').length == 0)
            $(this).html('<input type="text" class="form-control" onkeyup="calculateTotal(' + id + ')" id="input_' + id + '" value="' + $(this).html().trim() + '" onblur="removeInput(' + id + ')" placeholder="Enter Contribution">');
    })

    function calculateTotal(id) {
        var total = Number($('#input_' + id).val())
        $('.contribution').each(function(i, v) {
            if (isNaN(Number($(v).html())) == false) {
                total += Number($(v).html());
            }

        })
        console.log(total)
        if (total > 100) {
            alert('You can provide maximum 100%');
            $('#input_' + id).val('');
            return false;
        }
    }

    function removeInput(id) {

        $.ajax({
            url: '<?php echo site_url('sale_target/add_contribution'); ?>',
            type: 'POST',
            dataType: "json",
            data: {
                'id': id,
                'contribution': $('#input_' + id).val()
            },
            success: function(data) {
                $('#contribution_' + id).html($('#input_' + id).val());
            }
        })

    }

    $('#designation').change(function() {
        var id = $(this).val();

            $.ajax({
                url: '<?php echo site_url('sale_target/get_employee_list'); ?>',
                type: 'POST',
                dataType: "json",
                data: {
                    'id': id,
                    'team_id': <?php echo $team_id; ?>
                },
                success: function(data) {
                    if (data.msg == 'success') {
                        var str = '<table class="table">';
                        str += '<tr><th>Name</th><th>Phone</th><th>Action</th></tr>';
                        $(data.employees).each(function(i, v) {
                            str += '<tr><td>' + v.name + '</td><td>' + v.mobile + '</td><td><input type="checkbox" name="employee_id[' + v.id + ']"></td></tr>';
                        })
                        str += '</table>';
                        $('#data_list').html(str);
                        $('#employee_area').show();
                    } else {
                        var str = '<table class="table">';
                        str += '<tr><th style="text-align:center;">No Employee Found</th></tr></table>';
                        $('#data_list').html(str);
                        $('#employee_area').show();
                    }
                }
            })
    })
  
</script>