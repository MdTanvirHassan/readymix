<?php
    $user_id = $this->session->userdata('user_id');
    $user_type = $this->session->userdata('user_type');
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
        <?php $this->role = checkUserPermission(1,96, $userData); if (in_array(2, $this->role)) { ?>
            <a href="<?php echo site_url('department/add_department'); ?>" class="btn btn-sm btn-primary">ADD DEPARTMENT</a>
        <?php } ?>    
        <table id="datatable" class="table table-striped table-bordered table-hover no-footer">
            <thead>
                <tr>
                    <th class="col-lg-2">Name</th>
                    <th class="col-lg-2">Description</th>
                    <th class="col-lg-1">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($departments)) {
                    foreach ($departments as $department) {
                        ?>
                        <tr>
                            <td>
                                    <?php echo $department['dept_name']; ?>
                            </td>
                            <td>
                                    <?php if (!empty($department['description'])) echo $department['description']; ?>
                            </td>
                          

                            <td>
                                
                                <?php if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('department/edit_department/' . $department['id']); ?>"><button class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></button></a>
                                <?php } ?>
                                <?php if (in_array(5, $this->role)) { ?>   
                                <button onclick="delete_row('<?php echo site_url('department/delete_department/' . $department['id']); ?>')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
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
