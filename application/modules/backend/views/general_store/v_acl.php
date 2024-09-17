<?php
$user_id = $this->session->userdata('user_id');
$user_type = $this->session->userdata('user_type');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(1, 38, $userData);
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; ">Acl List</h2>
    <hr>-->
    <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <?php require_once(__DIR__ .'/../general_store_header.php'); ?>
        </div>
    </div>

    <div class="right_content">
        <?php $this->role = checkUserPermission(1,38, $userData); if (in_array(2, $this->role)) { ?>
            <a href="<?php echo site_url('general_store/add_acl'); ?>" class="btn btn-sm btn-primary">ADD ACL</a>
        <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                
                <th class="col-lg-2">User Name</th>
                <th class="col-lg-2">Designation</th>
                <th class="col-lg-2">Email</th>
                <th class="col-lg-2">Project/Branch</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($users)) {
                foreach ($users as $user) { ?>
                    <tr>
                       
                        <td>
                            <?php if(!empty($user['username'])) echo $user['username']; ?>
                        </td>
                      
                       <td>
                            <?php if(!empty($user['designation_name'])) echo $user['designation_name']; ?>
                        </td>
                        
                         <td>
                            <?php if(!empty($user['email'])) echo $user['email']; ?>
                        </td>
                        
                         <td>
                            <?php if(!empty($user['dep_description'])) echo $user['dep_description']; ?>
                        </td>

                        <td>
                            <a href="<?php echo site_url('general_store/edit_acl/'.$user['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            
                            <button onclick="delete_row('<?php echo site_url('general_store/delete_acl/'.$user['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>
