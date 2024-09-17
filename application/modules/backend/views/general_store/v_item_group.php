<?php
    $user_id = $this->session->userdata('user_id');
    $user_type = $this->session->userdata('user_type');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(1, 3, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; ">Item Group Information List</h2>
    <hr>-->
  <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <?php require_once(__DIR__ .'/../general_store_header.php'); ?>
        </div>
</div>

<div class="right_content">
    <?php $this->role = checkUserPermission(1, 3, $userData);  if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('general_store/add_item_group_information'); ?>" class="btn btn-sm btn-primary">ADD ITEM CATEGORY</a>
    <?php } ?>     
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-2"> Category Name</th>
                <th class="col-lg-2">Category Short Name</th>
                <th class="col-lg-2"> Category Type</th>
                <th class="col-lg-2"> Description</th>
               
                
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($item_groups)) {
                foreach ($item_groups as $item_group) { ?>
                    <tr>
                        <td>
                               <?php if(!empty($item_group['item_group'])) echo $item_group['item_group']; ?>
                        </td>
                        <td>
                            <?php if(!empty($item_group['group_short_name'])) echo $item_group['group_short_name']; ?>
        
                        </td>
                        
                         <td>
       
                            <?php if(!empty($item_group['group_type'])) echo $item_group['group_type']; ?>
                        </td>
                        
                        <td>
       
                            <?php if(!empty($item_group['item_group_description'])) echo $item_group['item_group_description']; ?>
                        </td>
                       
                      

                        <td>
                            <?php  if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('general_store/edit_item_group_information/'.$item_group['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php } ?>
                           <?php  if (in_array(2, $this->role)) { ?>     
                                <button onclick="delete_row('<?php echo site_url('general_store/delete_item_group_information/'.$item_group['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                           <?php } ?>     
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>
