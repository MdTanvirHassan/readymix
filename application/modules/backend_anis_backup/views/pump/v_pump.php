<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
$user_id = $this->session->userdata('user_id');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(7, 23, $userData);
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">

    <div class="right_content">
        <?php if (in_array(2, $this->role)) { ?>
            <a href="<?php echo site_url('pump/add_pump'); ?>" class="btn btn-sm btn-primary">ADD PUMP</a>
        <?php } ?>    
        <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
            <thead>
                <tr>
                    <th class="col-lg-2">Project</th>
                    <th class="col-lg-2">Customer</th>
                    <th class="col-lg-2">Pump No</th>
                    <th class="col-lg-2">Date</th>
                    <th class="col-lg-1">Total Bill</th>
                    <th class="col-lg-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($pumps)) {
                    foreach ($pumps as $pump) {
                        ?>
                        <tr>

                            <td>
        <?php if (!empty($pump['project_name'])) echo $pump['project_name']; ?>
                            </td>

                            <td>
        <?php if (!empty($pump['c_name'])) echo $pump['c_name']; ?>
                            </td>

                            <td>
        <?php if (!empty($pump['pump_no'])) echo $pump['pump_no']; ?>
                            </td>

                            <td>
        <?php if (!empty($pump['date'])) echo $pump['date']; ?>
                            </td>
                            <td>
        <?php if (!empty($pump['total_bill'])) echo $pump['total_bill']; ?>
                            </td>

                            <td>
                                <?php if (in_array(3, $this->role)) { ?>
                                    <a href="<?php echo site_url('pump/edit_pump/' . $pump['pump_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php } ?>
                                <?php if (in_array(5, $this->role)) { ?>    
                                    <button onclick="delete_row('<?php echo site_url('pump/delete_pump/' . $pump['pump_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
        <?php } ?>
                                <a href="<?php echo site_url('pump/details_pump/' . $pump['pump_id']); ?>"><button class="btn btn-sm btn-info">Details</button></a>
                            </td>
                        </tr>
                    <?php }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

