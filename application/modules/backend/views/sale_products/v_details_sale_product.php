 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(7, 18, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) { ?> 
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'customers') echo 'active'; ?>" href="<?php echo site_url('backend/customers'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Customers</span>
                        </a>
                    </li>
                <?php } ?> 
<?php $this->role = checkUserPermission(7, 19, $userData);
if (empty($this->role) || !in_array(11, $this->role)) { ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'bank') echo 'active'; ?>" href="<?php echo site_url('backend/bank'); ?>">
                            <i class="fa fa-university"></i><br><span>Bank</span></a>
                    </li>
<?php } ?>
<?php $this->role = checkUserPermission(7, 20, $userData);
if (empty($this->role) || !in_array(11, $this->role)) { ?>          
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'product_category') echo 'active'; ?>" href="<?php echo site_url('backend/product_categories'); ?>">
                            <i class="fa fa-object-group"></i><br><span>Categories</span></a>
                    </li>
<?php } ?>
<?php $this->role = checkUserPermission(7, 21, $userData);
if (empty($this->role) || !in_array(11, $this->role)) { ?>    
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'sales_product') echo 'active'; ?>" href="<?php echo site_url('backend/sale_products'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Products</span></a>
                    </li>
<?php } ?>
                <?php $this->role = checkUserPermission(7, 22, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) { ?>       
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'product_mixing') echo 'active'; ?>" href="<?php echo site_url('backend/products_mixing'); ?>">
                            <i class="fa fa-cubes"></i><br><span>Products Mixing</span></a>
                    </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(7, 23, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) { ?>          
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'project') echo 'active'; ?>" href="<?php echo site_url('backend/projects'); ?>">
                            <i class="fa fa-home"></i><br><span>Projects</span></a>
                    </li>
<?php } ?>

            </ul>
        </div>
    </div>
            <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Details Product</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        
                        <table  class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>code</th>
                                    <th>PSI</th>
                                    <th>MPA</th>
                                    <th>M. Unit</th>
                                    <th>Specification </th>
                                    <th>Performance</th>
                                    <th>Remarks </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php if(!empty($sale_product_info[0]['product_name'])) echo $sale_product_info[0]['product_name']; ?></td>          
                                    <td>
                                        <?php foreach($categories as $category){ ?>
                                        <?php if($sale_product_info[0]['category_id']==$category['category_id']) echo $category['category_name'] ?>
                                    <?php } ?> 
                                    </td>          
                                    <td><?php if(!empty($sale_product_info[0]['p_code'])) echo $sale_product_info[0]['p_code']; ?></td>          
                                    <td><?php if(!empty($sale_product_info[0]['p_psi'])) echo $sale_product_info[0]['p_psi']; ?></td>     
                                    <td><?php if(!empty($sale_product_info[0]['mpa'])) echo $sale_product_info[0]['mpa']; ?></td> 
                                    <td><?php if(!empty($sale_product_info[0]['measurement_unit'])) echo $sale_product_info[0]['measurement_unit']; ?></td>          
                                    <td><?php if(!empty($sale_product_info[0]['specification'])) echo $sale_product_info[0]['specification']; ?></td>          
                                    <td><?php if(!empty($sale_product_info[0]['performance'])) echo $sale_product_info[0]['performance']; ?></td>          
                                    <td><?php if(!empty($sale_product_info[0]['remark'])) echo $sale_product_info[0]['remark']; ?></td>          




                                </tr>

                            </tbody>
                        </table>
                
                
                
                 
                
                 
                
                
               
               
     
              
                
                
                <div class="form-group" style="margin-top: 40px;">
                                
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/sale_products') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
                                </div>
                            </div>
                   
<!--                        <div class="row">
                            
                            <div class="col-md-2 col-md-offset-3">
                                <a href="<?php echo site_url('backend/sale_products') ?>" > <button type="button" class="btn btn-success button">REGISTER</button> </a>

                          </div>       
                 
                </div>-->
                   
                    
               
                
           
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

    <script type="text/javascript">
      

    </script>
                    
