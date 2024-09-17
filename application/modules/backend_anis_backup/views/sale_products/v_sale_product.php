<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(7, 21, $userData);
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
        <a href="<?php echo site_url('sale_products/add_sale_product'); ?>" class="btn btn-sm btn-primary">ADD PRODUCT</a>
    <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-2">Code</th>
                 <th class="col-lg-2">Name</th>
                 <th class="col-lg-2">Measurement Unit</th>
                 <th class="col-lg-2">PSI</th>
                 <th class="col-lg-2">MPA</th>
                  <th class="col-lg-2">Performance</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($sale_products)) {
                foreach ($sale_products as $sale_product) { ?>
                    <tr>
                      
                        <td>
                            <?php if(!empty($sale_product['p_code'])) echo $sale_product['p_code']; ?>
                        </td>
                         
                        <td>
                            <?php if(!empty($sale_product['product_name'])) echo $sale_product['product_name']; ?>
                        </td>
                        
                       <td>
                            <?php if(!empty($sale_product['measurement_unit'])) echo $sale_product['measurement_unit']; ?>
                        </td>
                        <td>
                            <?php if(!empty($sale_product['p_psi'])) echo $sale_product['p_psi']; ?>
                        </td>
                         <td>
                            <?php if(!empty($sale_product['mpa'])) echo $sale_product['mpa']; ?>
                        </td>
                        
                        <td>
                            <?php if(!empty($sale_product['performance'])) echo $sale_product['performance']; ?>
                        </td>
                        <td>
                             <?php  if (in_array(4, $this->role)) { ?>
                                <a href="<?php echo site_url('sale_products/details_sale_product/'.$sale_product['product_id']); ?>"><button class="btn btn-sm btn-primary">Details</button></a>
                             <?php } ?>
                             <?php  if (in_array(3, $this->role)) { ?>    
                                <a href="<?php echo site_url('sale_products/edit_sale_product/'.$sale_product['product_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                             <?php } ?>
                           <?php  if (in_array(5, $this->role)) { ?>      
                                <button onclick="delete_row('<?php echo site_url('sale_products/delete_sale_product/'.$sale_product['product_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                           <?php } ?>     
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>

