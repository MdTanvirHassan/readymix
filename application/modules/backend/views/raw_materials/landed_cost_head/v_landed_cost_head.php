<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(18,136, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
        <?php       
            require_once(__DIR__ .'/../../rm_setup_header.php');
        ?>
    </div>
    <div class="right_content">
    <?php  
    $this->role = checkUserPermission(7, 19, $userData);
    if (in_array(2, $this->role)){ 
        ?>
        <a href="<?php echo site_url('raw_materials/landed_cost_head/add_landed_cost_head'); ?>" class="btn btn-sm btn-primary">ADD COST HEAD</a>
    <?php } ?>     
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Name</th>
                <th class="col-lg-1">Description</th>
                
                <th class="col-lg-1">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($cost_heads)) {
                foreach ($cost_heads as $head) { ?>
                    <tr>
                        <td>
                            <?php echo $head['name']; ?>
                        </td>
                        <td>
                            <?php if(!empty($head['description'])) echo $head['description']; ?>
                        </td>
                         
                        
                        <td>
                            <?php  if(in_array(3,$this->role)){ ?>
                                <a href="<?php echo site_url('raw_materials/landed_cost_head/edit_landed_cost_head/'.$head['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php } ?>
                                
                            <?php  if(in_array(5, $this->role)){ ?>    
                                <button onclick="delete_row('<?php echo site_url('raw_materials/landed_cost_head/delete_landed_cost_head/'.$head['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                            <?php } ?>     
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>

