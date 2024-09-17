<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Asset Category List</h2>
    <hr>
    <a href="<?php echo site_url('asset_category/add_asset_category'); ?>" class="btn btn-sm btn-primary">Add Category</a>
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-2">Name</th>
                <th class="col-lg-2">Description</th>
                <th class="col-lg-2">Created</th>
                
                <th class="col-lg-1">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($asset_categories)) {
                foreach ($asset_categories as $category) { ?>
                    <tr>
                        <td>
        <?php echo $category['category_name']; ?>
                        </td>
                        <td>
                            <?php echo $category['description']; ?>
                        </td>
                      
                       <td>
                            <?php echo $category['created']; ?>
                        </td>

                        <td>
                            <a href="<?php echo site_url('asset_category/edit_asset_category/'.$category['category_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            
                            <button onclick="delete_row('<?php echo site_url('asset_category/delete_single_asset_category/'.$category['category_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
