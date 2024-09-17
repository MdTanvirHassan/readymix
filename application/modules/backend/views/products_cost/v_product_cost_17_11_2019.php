<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(7, 24, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="right_content" style="margin-top: 70px;">
     <?php  if (in_array(2, $this->role)) { ?>
            <a href="<?php echo site_url('products_cost/add_product_cost'); ?>" class="btn btn-sm btn-primary">ADD COST</a>
     <?php } ?>
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Costing No.</th>
                <th class="col-lg-1">Product Name</th>
                <th class="col-lg-1"> PSI</th>
                <th class="col-lg-1">M. Unit</th>
                <th class="col-lg-1">Quote Price</th>
                <th class="col-lg-1">Customer</th>
                <th class="col-lg-1">Project Name</th>
                <th class="col-lg-1">Status</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($costs)) {
                foreach ($costs as $cost) { ?>
                    <tr>
                        <td>
                                <?php if(!empty($cost['cost_number'])) echo $cost['cost_number']; ?>
                        </td>
                        <td>
                                <?php if(!empty($cost['product_name'])) echo $cost['product_name']; ?>
                        </td>
                         
                        <td>
                                <?php if(!empty($cost['p_psi'])) echo $cost['p_psi']; ?>
                        </td>
                        <td>
                                <?php if(!empty($cost['measurement_unit'])) echo $cost['measurement_unit']; ?>
                        </td>
                       
                        <td>
                                <?php if(!empty($cost['quote_price'])) echo $cost['quote_price']; ?>
                        </td>
                        <td>
                                <?php if(!empty($cost['c_short_name'])) echo $cost['c_short_name']; ?>
                        </td>   
                        <td>
                                <?php if(!empty($cost['project_name'])) echo $cost['project_name']; ?>
                        </td>   
                         <td>
                              <?php if($cost['status']=='Pending'){ ?> 
                                    <span style="background:yellow;padding:2px 5px;border-radius: 5px;color:#ooooo"> <?php echo $cost['status']; ?> </span>
                               <?php }else{ ?>  
                                    <span style="background:green;padding:2px 5px;border-radius: 5px;color:#ffffff"> <?php  echo $cost['status']; ?> </span>
                               <?php } ?>     
                        </td>   
                        <td>
                         <?php  if (in_array(4, $this->role)) { ?>
                            <a href="<?php echo site_url('products_cost/details_product_cost/'.$cost['product_cost_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                            <a href="<?php echo site_url('products_cost/productCostSheet/'.$cost['product_cost_id']); ?>"><button class="btn btn-sm btn-primary">Cost Sheet</button></a>
                         <?php } ?>   
                            <?php if($cost['status']=="Pending"){ ?>
                                <?php  if (in_array(3, $this->role)) { ?>
                                    <a href="<?php echo site_url('products_cost/edit_product_cost/'.$cost['product_cost_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php } ?>
                                <?php  if (in_array(5, $this->role)) { ?>    
                                    <button onclick="delete_row('<?php echo site_url('products_cost/delete_product_cost/'.$cost['product_cost_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                <?php } ?>
                            <?php }else{ ?>
                                 <?php  if (in_array(3, $this->role)) { ?>
                                    <button class="btn btn-sm btn-info">Edit</button>
                                 <?php } ?>
                                 <?php  if (in_array(5, $this->role)) { ?>
                                    <button  class="btn btn-sm btn-danger">Delete</button>
                                 <?php } ?>   
                            <?php } ?>    
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>
