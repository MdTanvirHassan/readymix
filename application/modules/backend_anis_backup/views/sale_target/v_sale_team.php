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
                            <a href="javascript:" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-primary">ADD SALES TEAM</a>
                        <?php } ?>
                        <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr>

                                    <th class="col-lg-1">Team Name</th>

                                    <th class="col-lg-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($sale_teams)) {
                                    foreach ($sale_teams as $order) { ?>
                                        <tr>
                                            <td id="team_<?php echo $order['id']; ?>">
                                                <?php if (!empty($order['team_name'])) echo $order['team_name']; ?>
                                            </td>
                                            <td>

                                                <?php if (in_array(3, $this->role)) { ?>
                                                    <a href="javascript:" onclick="editTeam(<?php echo $order['id']; ?>)"><button class="btn btn-sm btn-info">Edit</button></a>
                                                <?php } ?>


                                                <?php if (in_array(4, $this->role)) { ?>
                                                    <a href="<?php echo site_url('sale_target/team_member/' . $order['id']); ?>"><button class="btn btn-sm btn-primary">Team Members</button></a>
                                                <?php } ?>

                                                <?php if (in_array(5, $this->role)) { ?>
                                                    <button onclick="delete_row('<?php echo site_url('sale_target/delete_sale_team/' . $order['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
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
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo site_url('sale_target/edit_sales_team'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Sales Team</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Team Name</label>
                        <input type="text" class="form-control" require id="edit_name" name="team_name">
                        <input type="hidden" class="form-control" require id="edit_id" name="edit_id">
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
    function editTeam(id) {
        $('#edit_id').val(id);
        $('#edit_name').val($('#team_' + id).html().trim())
        $('#editModal').modal('show')
    }
</script>