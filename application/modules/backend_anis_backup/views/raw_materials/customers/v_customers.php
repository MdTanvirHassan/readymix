<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(18, 104, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    
    <div class="os-tabs-w menu-shad">
            <?php       
                require_once(__DIR__ .'/../../rm_setup_header.php');
            ?>
    </div>
    
    <div class="right_content">
    
     <?php  
     $this->role = checkUserPermission(18, 104, $userData);
     if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('raw_materials/customers/add_customer'); ?>" class="btn btn-sm btn-primary">ADD CUSTOMER</a>
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Code</th>
                <th class="col-lg-1"> Name</th>
                <th class="col-lg-1">Short Name</th>
                <th class="col-lg-1">Mobile</th>
                <th class="col-lg-1">Email</th>
                <th class="col-lg-1">Address</th>
                <th class="col-lg-2">Action</th>
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
        <?php if(!empty($customer['c_contact_address'])) echo $customer['c_contact_address']; ?>
                        </td>

                        <td>
                            <?php  if (in_array(4, $this->role)) { ?>
                                <a href="<?php echo site_url('raw_materials/customers/details_customer/'.$customer['id']); ?>"><button class="btn btn-sm btn-primary">Details</button></a>
                            <?php } ?>    
                            <?php  if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('raw_materials/customers/edit_customer/'.$customer['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php } ?>
                           <?php  if (in_array(5, $this->role)) { ?>      
                                <button onclick="delete_row('<?php echo site_url('raw_materials/customers/delete_customer/'.$customer['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                           <?php } ?>      
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>
