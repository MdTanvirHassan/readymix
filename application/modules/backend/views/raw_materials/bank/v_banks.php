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
        <a href="<?php echo site_url('raw_materials/bank/add_bank'); ?>" class="btn btn-sm btn-primary">ADD BANK</a>
    <?php } ?>     
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Code</th>
                <th class="col-lg-1">Name</th>
                <th class="col-lg-1">Short Name</th>
                <th class="col-lg-1">Branch Name</th>
                <th class="col-lg-1">Mobile</th>
                <th class="col-lg-1">Email</th>
                <th class="col-lg-1">Bank Type</th>
                <th class="col-lg-1">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($banks)) {
                foreach ($banks as $bank) { ?>
                    <tr>
                        <td>
                            <?php echo $bank['b_code']; ?>
                        </td>
                        <td>
                            <?php if(!empty($bank['b_name'])) echo $bank['b_name']; ?>
                        </td>
                         
                        <td>
                            <?php if(!empty($bank['b_short_name'])) echo $bank['b_short_name']; ?>
                        </td>
                        <td>
                            <?php if(!empty($bank['branch_name'])) echo $bank['branch_name']; ?>
                        </td>
                        <td>
                            <?php if(!empty($bank['b_mobile_no'])) echo $bank['b_mobile_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($bank['b_email'])) echo $bank['b_email']; ?>
                        </td>
                       
                        <td>
                            <?php if(!empty($bank['b_identification'])) echo $bank['b_identification']; ?>
                        </td>
                        <td>
                            <?php  if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('raw_materials/bank/edit_bank/'.$bank['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php } ?>
                                
                            <?php  if (in_array(5, $this->role)) { ?>    
                                <button onclick="delete_row('<?php echo site_url('raw_materials/bank/delete_bank/'.$bank['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                            <?php } ?>     
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>

