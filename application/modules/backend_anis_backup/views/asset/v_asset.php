<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Asset  List</h2>
    <hr>
    <a href="<?php echo site_url('asset/add_asset'); ?>" class="btn btn-sm btn-primary">Add Asset</a>
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-2">Asset Id</th>
                <th class="col-lg-2">Name</th>
                <th class="col-lg-2">Quatity</th>
                
                <th class="col-lg-1">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($assets)) {
                foreach ($assets as $asset) { ?>
                    <tr>
                        <td>
        <?php echo $asset['product_id']; ?>
                        </td>
                        <td>
                            <?php echo $asset['product_name']; ?>
                        </td>
                      
                       <td>
                            <?php echo $asset['a_quantity']; ?>
                        </td>

                        <td>
                            <a href="<?php echo site_url('asset/edit_asset/'.$asset['a_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            
                            <button onclick="delete_row('<?php echo site_url('asset/delete_single_asset/'.$asset['a_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
