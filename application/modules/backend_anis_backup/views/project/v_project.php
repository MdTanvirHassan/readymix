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
    <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(7, 18, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?> 
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'customers') echo 'active'; ?>" href="<?php echo site_url('backend/customers'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Customers</span>
                    </a>
                </li>
                <?php } ?> 
                <?php $this->role = checkUserPermission(7, 19, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'bank') echo 'active'; ?>" href="<?php echo site_url('backend/bank'); ?>">
                        <i class="fa fa-university"></i><br><span>Bank</span></a>
                </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(7, 20, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>          
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'product_category') echo 'active'; ?>" href="<?php echo site_url('backend/product_categories'); ?>">
                        <i class="fa fa-object-group"></i><br><span>Categories</span></a>
                </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(7, 21, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'sales_product') echo 'active'; ?>" href="<?php echo site_url('backend/sale_products'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Products</span></a>
                </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(7, 22, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'product_mixing') echo 'active'; ?>" href="<?php echo site_url('backend/products_mixing'); ?>">
                        <i class="fa fa-cubes"></i><br><span>Products Mixing</span></a>
                </li>
                <?php }?>
                <?php $this->role = checkUserPermission(7, 23, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>          
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'project') echo 'active'; ?>" href="<?php echo site_url('backend/projects'); ?>">
                        <i class="fa fa-home"></i><br><span>Projects</span></a>
                </li>
                <?php }?>
                
            </ul>
        </div>
    </div>
    <div class="right_content">
    <?php  if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('projects/add_project'); ?>" class="btn btn-sm btn-primary">ADD PROJECT</a>
    <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-2">Project Name</th>
                <th class="col-lg-2">Customer</th>
                <th class="col-lg-1">Con. Person</th>
                <th class="col-lg-2">Con. Number</th>
                <th class="col-lg-2">Address</th>
                <th class="col-lg-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($projects)) {
                foreach ($projects as $project) { ?>
                    <tr>
                      
                        <td>
                            <?php if(!empty($project['project_name'])) echo $project['project_name']; ?>
                        </td>
                         
                        <td>
                            <?php if(!empty($project['c_name'])) echo $project['c_name']; ?>
                        </td>
                        
                        <td>
                            <?php if(!empty($project['contact_person'])) echo $project['contact_person']; ?>
                        </td>
                         
                        <td>
                            <?php if(!empty($project['contact_no'])) echo $project['contact_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($project['address'])) echo $project['address']; ?>
                        </td>

                        <td>
                            <?php  if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('projects/edit_project/'.$project['project_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php } ?>
                            <?php  if (in_array(5, $this->role)) { ?>    
                                <button onclick="delete_row('<?php echo site_url('projects/delete_project/'.$project['project_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                            <?php } ?>
                                <a href="<?php echo site_url('projects/details_project/'.$project['project_id']); ?>"><button class="btn btn-sm btn-info">Details</button></a>
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>

