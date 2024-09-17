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
        <a href="<?php echo site_url('service_group/add_service_group'); ?>" class="btn btn-sm btn-primary">ADD SERVICE TYPE</a>
    <?php } ?>     
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-2"> Service Type</th>
                <th class="col-lg-2"> Short Name</th>
                <th class="col-lg-2"> Description</th>           
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($service_groups)) {
                foreach ($service_groups as $service_group) { ?>
                    <tr>
                        <td>
                             <?php if(!empty($service_group['group_name'])) echo $service_group['group_name']; ?>
                        </td>
                        
                        <td>
                            <?php if(!empty($service_group['short_name'])) echo $service_group['short_name']; ?>
                        </td>
                                 
                        <td>
                            <?php if(!empty($service_group['description'])) echo $service_group['description']; ?>
                        </td>
                       
              
                        <td>
                            <?php  if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('service_group/edit_service_group/'.$service_group['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php } ?>
                           <?php  if (in_array(2, $this->role)) { ?>     
                                <button onclick="delete_row('<?php echo site_url('service_group/delete_service_group/'.$service_group['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                           <?php } ?>     
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>
