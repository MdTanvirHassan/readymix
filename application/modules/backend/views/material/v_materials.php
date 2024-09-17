<style>
    .btn-sm{
        padding:5px 5px !important;
    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Material's  List</h2>
    <hr>
    <a href="<?php echo site_url('materials/add_material'); ?>" class="btn btn-sm btn-primary">ADD MATERIAL</a>
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>

                <th class="col-lg-1">Name</th>
                <th class="col-lg-1">Description</th>
                
                <th class="col-lg-1">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($materials)) {
                foreach ($materials as $material) { ?>
                    <tr>
                      
                        <td>
                            <?php if(!empty($material['m_name'])) echo $material['m_name']; ?>
                        </td>
                         
                        <td>
                            <?php if(!empty($material['m_description'])) echo $material['m_description']; ?>
                        </td>
                        
                       

                        <td>
                            <a href="<?php echo site_url('materials/edit_material/'.$material['m_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <button onclick="delete_row('<?php echo site_url('materials/delete_material/'.$material['m_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>

