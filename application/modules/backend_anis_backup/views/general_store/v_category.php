<?php
    $user_id = $this->session->userdata('user_id');
    $user_type = $this->session->userdata('user_type');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(1, 1, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; ">Category List</h2>
    <hr>-->
<div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <?php require_once(__DIR__ .'/../general_store_header.php'); ?>
        </div>
</div>
<div class="right_content">
    <?php $this->role = checkUserPermission(1, 2, $userData); if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('general_store/add_item_category'); ?>" class="btn btn-sm btn-primary">ADD GROUP</a>
    <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-2">Group Name</th>
                <th class="col-lg-2">Short Name</th>
                <th class="col-lg-2">Category Name</th>
                
                
                
                <th class="col-lg-1">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($categories)) {
                foreach ($categories as $category) { ?>
                    <tr>
                        <td>
        <?php echo $category['c_name']; ?>
                        </td>
                         <td>
        <?php echo $category['c_description']; ?>
                        </td>
                        <td>
        <?php echo $category['item_group']; ?>
                        </td>
                      
                      

                        <td>
                          <?php  if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('general_store/edit_item_category/'.$category['c_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                          <?php } ?>   
                          <?php  if (in_array(5, $this->role)) { ?>  
                                <button onclick="delete_row('<?php echo site_url('general_store/delete_item_category/'.$category['c_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                          <?php } ?>  
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>
