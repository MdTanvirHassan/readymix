<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(7, 18, $userData);
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
                <?php $this->role = checkUserPermission(7, 18, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?> 
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'opening_balance') echo 'active'; ?>" href="<?php echo site_url('backend/customers/opening_balance'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Customers Opening Balance</span>
                    </a>
                </li>
                <?php } ?> 
                
            </ul>
        </div>
    </div>
    <div class="right_content">
        
        
        <div class="row">
                        <div id="remover" class="col-md-6 col-md-offset-3">
                            <form id="item-form" action="<?php site_url('customers/customer_search'); ?>" method="post">
                            <div class="row">
                                    <div style="margin-top: 15px;" class="col-md-10 col-md-offset-1">
                                      <select  class="form-control e1" placeholder="Select Customer" id="customer_id" name="customer_id" onchange="javascript:project_info();" >
                                          <option value="all" >Select customer</option>
                                          
                                        <?php foreach($all_customers as $cust){ ?>
                                           <option <?php if($customer_id==$cust['id']) echo 'selected'; ?>  value="<?php echo $cust['id'] ?>"><?php echo $cust['c_name'] ?></option> 
                                        <?php } ?>    
                                         

                                     </select>

                                 </div>
                            </div><!--End Row-->  
                                                    
                          
                            <div class="clearfix"></div>
                            <div style="margin-top: 15px;" class="col-md-12">

                                <div class="col-md-8 col-md-offset-3">
<!--                                    <input style="padding: 6px 40px;" type="submit" class="btn btn-primary" value="SEARCH"/>
                                    <input style="padding: 6px 40px;" type="button" id="print_div" class="btn btn-primary" value="PRINT"/>-->
                                    <button type="submit" class="btn btn-success pull-right">Search</button>
                                   <!--  <a  href="javascript:" class="btn btn-info" onclick="submitForm('excel')">EXCEL</a>-->
                                    
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
        
        
        
        
        
        
        
        <form action="<?php echo site_url('customers/opening_balance'); ?>" method="post"> 
    <table class="table table-striped table-bordered table-hover no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Code</th>
                <th class="col-lg-1"> Name</th>
                <th class="col-lg-1">Short Name</th>
                <th class="col-lg-1">Mobile</th>
                <th class="col-lg-1">Email</th>
                <th class="col-lg-2">Opening Balnce</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($customers)) {
                foreach ($customers as $customer) { ?>
                    <tr>
                        <td>
        <?php echo $customer['c_code']; ?>
                        </td>
                        <td>
        <?php if(!empty($customer['c_name'])) echo $customer['c_name']; ?>
                        </td>
                        <td>
        <?php if(!empty($customer['c_short_name'])) echo $customer['c_short_name']; ?>
                        </td>
                        <td>
        <?php if(!empty($customer['head_office_mobile_no'])) echo $customer['head_office_mobile_no']; ?>
                        </td>
                        <td>
        <?php if(!empty($customer['head_office_email'])) echo $customer['head_office_email']; ?>
                        </td>
                       

                        <td>
                            <input type="number" class="form-control" name="customer[<?php echo $customer['id']; ?>]" value="<?php echo $customer['opening_balance']; ?>" placeholder=" Enter Opening Balance">    
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
            <button type="submit" class="btn btn-success pull-right">Save </button>
        </form>
</div>
</div>
