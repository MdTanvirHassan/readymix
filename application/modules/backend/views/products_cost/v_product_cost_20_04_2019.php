<style>
    .btn-sm{
        padding:5px 5px !important;
    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Costing Product List</h2>
    <hr>
    <a href="<?php echo site_url('products_cost/add_product_cost'); ?>" class="btn btn-sm btn-primary">ADD COST</a>
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
                                <?php if(!empty($cost['status'])) echo $cost['status']; ?>
                        </td>   
                        <td>
                            <a href="<?php echo site_url('products_cost/details_product_cost/'.$cost['product_cost_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                            <?php if($cost['status']=="Pending"){ ?>
                                <a href="<?php echo site_url('products_cost/edit_product_cost/'.$cost['product_cost_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <button onclick="delete_row('<?php echo site_url('products_cost/delete_product_cost/'.$cost['product_cost_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                            <?php }else{ ?>
                                    <button class="btn btn-sm btn-info">Edit</button>
                                    <button  class="btn btn-sm btn-danger">Delete</button>
                            <?php } ?>    
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
