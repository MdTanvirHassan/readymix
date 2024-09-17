<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(1, 2, $userData);
?>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
 <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <?php require_once(__DIR__ .'/../general_store_header.php'); ?>
        </div>
</div>

    <div class="right_content">
        <!--         <h2 style="text-align:center; ">Supplier/Customer's Information List</h2>
            <hr>-->
        <?php $this->role = checkUserPermission(1, 33, $userData); if (in_array(2, $this->role)) { ?>
            <a href="<?php echo site_url('services/add_service'); ?>" class="btn btn-sm btn-primary">ADD SERVICE</a>
        <?php } ?>    
        <table id="datatable" class="table table-striped table-bordered table-hover no-footer">
            <thead>
                <tr>
                    <th class="col-lg-2">Service Name</th>
                    <th class="col-lg-1">Service Type</th>
                    <th class="col-lg-1">Service ID</th>
                    <th class="col-lg-2">Description</th>
                    <th class="col-lg-2">Service Unit</th>
                    <th class="col-lg-2">Remarks</th>
                    <th class="col-lg-1">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($services)) {
                    foreach ($services as $service) {
                        ?>
                        <tr>
                            <td>
                                    <?php echo $service['service_name']; ?>
                            </td>
                              <td>
                                    <?php if (!empty($service['group_name'])) echo $service['group_name']; ?>
                            </td>
                            <td>
                                    <?php if (!empty($service['service_id'])) echo $service['service_id']; ?>
                            </td>
                            <td>
                                    <?php if (!empty($service['description'])) echo $service['description']; ?>
                            </td>
                            
                            <td>
                                    <?php echo $service['service_unit']; ?>
                            </td>
                          
                            <td>
                                    <?php if (!empty($service['remark'])) echo $service['remark']; ?>
                            </td>
                            
                            <td>
                                
                                <?php if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('services/edit_service/' . $service['id']); ?>"><button class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></button></a>
                                <?php } ?>
                                <?php if (in_array(5, $this->role)) { ?>   
                                <button onclick="delete_row('<?php echo site_url('services/delete_service/' . $service['id']); ?>')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
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
