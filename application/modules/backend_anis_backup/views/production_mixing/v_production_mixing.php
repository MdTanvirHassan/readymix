<?php
$employee_id = $this->session->userdata('employeeId');
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(13, 58, $userData);
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <!--    <h2 style="text-align:center; "> Budget List</h2>
        <hr>-->
    <div class="os-tabs-w menu-shad">
        <?php require_once(__DIR__ .'/../production_header.php'); ?>
    </div>
    <div class="right_content">
<?php $this->role = checkUserPermission(13, 57, $userData);
if (in_array(2, $this->role)) { ?>
            <a href="<?php echo site_url('production_mixing/add_production_mixing'); ?>" class="btn btn-sm btn-primary">ADD MIXING</a>
<?php } ?> 
        <select id="search_by" style="width: 200px;margin:0 auto;margin-top: -30px" class="form-control">
            <option value="">Search by Status</option>
            <option>Pending</option>
            <option>Approved</option>
            <option value=''>All</option>
        </select>
        <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
            <thead>
                <tr>
                    <th class="col-lg-1">Date</th>
                    <th class="col-lg-1">Mixing Number</th>
                    <th class="col-lg-1">Order Number</th>
                    <th class="col-lg-1">Product Name</th>
                    <th class="col-lg-1">Project Name</th>
                    <th class="col-lg-1">Party Name</th>
                    <th class="col-lg-1">Status</th> 
                    <th class="col-lg-2">Action</th>
                </tr>
            </thead>
            <tbody>
<?php
$user_info = $this->m_common->get_row_array("users", array('employeeId' => $employee_id), "*");
$approver = fetch_approver(13, 58, $user_info);
if (count($production_mixing)) {
    foreach ($production_mixing as $mixing) {
        ?>
                        <tr>
                            <td>
                                <?php echo date('d-m-Y', strtotime($mixing['created_date'])); ?>
                            </td>
                            <td>
                                <?php echo $mixing['pm_no']; ?>
                            </td>
                            <td>
                                <?php echo $mixing['delivery_no']; ?>
                            </td>
                            <td>
                                <?php echo $mixing['product_name']; ?>
                            </td>
                            <td>
                                <?php echo $mixing['project_name']; ?>
                            </td>
                            <td>
                                <?php echo $mixing['c_name']; ?>
                            </td>
                            <td>
                                <?php if ($mixing['status'] == "Pending") { ?>
                                    <span style="color:#CE9208;"> <?php echo $mixing['status']; ?></span>
        <?php } else { ?>
                                    <span style=""> <?php echo $mixing['status']; ?></span>
        <?php } ?>

                                <?php //echo $mixing['b_status']; ?>
                            </td>


                            <td>
                                <a href="<?php echo site_url('production_mixing/details_production_mixing/' . $mixing['pm_id'] . '/print'); ?>"><button class="btn btn-sm btn-success">Print Preview</button></a>
                                <?php if ($mixing['status'] == "Pending") { ?>
                                    <?php if (in_array(3, $this->role)) { ?>    
                                        <a href="<?php echo site_url('production_mixing/edit_production_mixing/' . $mixing['pm_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                    <?php } ?>   
                                <?php } else { ?>
                                    <?php if (in_array(3, $this->role)) { ?>     
                                        <button class="btn btn-sm btn-info">Edit</button>
                                    <?php } ?>      
                                <?php } ?>
                                <?php if (in_array(4, $this->role)) { ?>         
                                    <a href="<?php echo site_url('production_mixing/details_production_mixing/' . $mixing['pm_id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                                <?php } ?>
                                <?php if (in_array(5, $this->role)) { ?>        
                                    <?php if ($mixing['status'] == "Pending") { ?>
                                        <button onclick="delete_row('<?php echo site_url('production_mixing/delete_production_mixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                    <?php } else { ?>
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    <?php } ?> 
                                <?php } ?>  

        <?php if ($user_type == 1) { ?>  
                                    <?php if ($mixing['status'] == "Approved") { ?>                             
                                        <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
            <?php } else if ($mixing['status'] == "Rejected") { ?>
                                        <button onclick="approve('<?php echo site_url('production_mixing/approveProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                    <?php } else { ?>
                                        <button onclick="approve('<?php echo site_url('production_mixing/approveProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                        <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                    <?php } ?>


                                <?php } else { ?>   

                                    <?php if ($employee_id == $approver[0]) { ?>
                                        <?php if (!empty($approver[1])) { ?>   
                    <?php if ($mixing['status'] == "Approved") { ?>                             
                                                <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            <?php } else if ($mixing['status'] == "Rejected") { ?>
                                                <button onclick="approve('<?php echo site_url('production_mixing/forwardProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                            <?php } else { ?>
                                                <button onclick="approve('<?php echo site_url('production_mixing/forwardProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                                <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            <?php } ?>
                                        <?php } else { ?> 
                    <?php if ($mixing['status'] == "Approved") { ?>                             
                                                <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            <?php } else if ($mixing['status'] == "Rejected") { ?>
                                                <button onclick="approve('<?php echo site_url('production_mixing/approveProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                            <?php } else { ?>
                                                <button onclick="approve('<?php echo site_url('production_mixing/approveProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            <?php } ?>
                                        <?php } ?>              

                                    <?php } ?>  

            <?php if ($employee_id == $approver[1]) { ?>
                                          <?php if (!empty($approver[2])) { ?>   
                    <?php if ($mixing['status'] == "Approved") { ?>                             
                                                <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            <?php } else if ($mixing['status'] == "Rejected") { ?>
                                                <button onclick="approve('<?php echo site_url('production_mixing/forwardProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                            <?php } else { ?>
                                                <button onclick="approve('<?php echo site_url('production_mixing/forwardProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                                <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            <?php } ?>
                                        <?php } else { ?> 
                    <?php if ($mixing['status'] == "Approved") { ?>                             
                                                <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            <?php } else if ($mixing['status'] == "Rejected") { ?>
                                                <button onclick="approve('<?php echo site_url('production_mixing/approveProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                            <?php } else { ?>
                                                <button onclick="approve('<?php echo site_url('production_mixing/approveProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            <?php } ?>
                                        <?php } ?>            

                                    <?php } ?>  

            <?php if ($employee_id == $approver[2]) { ?>
                                         <?php if (!empty($approver[3])) { ?>   
                    <?php if ($mixing['status'] == "Approved") { ?>                             
                                                <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            <?php } else if ($mixing['status'] == "Rejected") { ?>
                                                <button onclick="approve('<?php echo site_url('production_mixing/forwardProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                            <?php } else { ?>
                                                <button onclick="approve('<?php echo site_url('production_mixing/forwardProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                                <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            <?php } ?>
                                        <?php } else { ?> 
                    <?php if ($mixing['status'] == "Approved") { ?>                             
                                                <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            <?php } else if ($mixing['status'] == "Rejected") { ?>
                                                <button onclick="approve('<?php echo site_url('production_mixing/approveProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                            <?php } else { ?>
                                                <button onclick="approve('<?php echo site_url('production_mixing/approveProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            <?php } ?>
                                        <?php } ?>   

            <?php } ?>     

                                    <?php if ($employee_id == $approver[3]) { ?>

                                              <?php if ($mixing['status'] == "Approved") { ?>                             
                                        <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
            <?php } else if ($mixing['status'] == "Rejected") { ?>
                                        <button onclick="approve('<?php echo site_url('production_mixing/approveProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                    <?php } else { ?>
                                        <button onclick="approve('<?php echo site_url('production_mixing/approveProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                        <button onclick="reject('<?php echo site_url('production_mixing/rejectProductionMixing/' . $mixing['pm_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                    <?php } ?>


            <?php } ?>              

        <?php } ?>              





                            </td>
                        </tr>
    <?php }
}
?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('#search_by').change(function () {
        $('#datatable_filter :input').focus().val($(this).val()).keyup();
    })
</script>