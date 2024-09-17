<?php
$user_id = $this->session->userdata('user_id');
$user_type = $this->session->userdata('user_type');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(1, 37, $userData);
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; ">User List</h2>
    <hr>-->
    <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <?php require_once(__DIR__ .'/../general_store_header.php'); ?>
        </div>
    </div>

    <div class="right_content">
    <?php $this->role = checkUserPermission(1,37, $userData); if (in_array(2, $this->role)) { ?>    
        <a href="<?php echo site_url('general_store/add_employee'); ?>" class="btn btn-sm btn-primary">ADD USER</a>
    <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                
                <th class="col-lg-2">Name</th>
                <th class="col-lg-2">Designation</th>
                <th class="col-lg-2">Email</th>
                <th class="col-lg-2">Mobile</th>
                <th class="col-lg-2">Project/Branch</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($employees)) {
                foreach ($employees as $employee) { ?>
                    <tr>
                       
                        <td>
                            <?php if(!empty($employee['name'])) echo $employee['name']; ?>
                        </td>
                      
                       <td>
                            <?php if(!empty($employee['designation_name'])) echo $employee['designation_name']; ?>
                        </td>
                        
                         <td>
                            <?php if(!empty($employee['email'])) echo $employee['email']; ?>
                        </td>
                        <td>
                            <?php if(!empty($employee['mobile'])) echo $employee['mobile']; ?>
                        </td>
                         <td>
                            <?php if(!empty($employee['dep_description'])) echo $employee['dep_description']; ?>
                        </td>

                        <td>
                            <?php  if (in_array(3, $this->role)) {  ?>
                            <a href="<?php echo site_url('general_store/edit_employee/'.$employee['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php } ?>
                            <?php  if (in_array(5, $this->role)) {  ?>
                             <button onclick="delete_row('<?php echo site_url('general_store/delete_employee/'.$employee['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                            <?php } ?>
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>

