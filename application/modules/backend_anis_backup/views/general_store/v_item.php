<style>
    .btn-sm{
        padding:3px 3px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $user_type = $this->session->userdata('user_type');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(1,4, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    
<div class="os-tabs-w menu-shad">
    <?php require_once(__DIR__ .'/../general_store_header.php'); ?>
</div>
    
<div class="right_content">
     <?php $this->role = checkUserPermission(1, 4, $userData);  if (in_array(2, $this->role)) { ?>
      <!--  <a href="<?php echo site_url('general_store/separteItem'); ?>" class="btn btn-sm btn-primary">ADD SEPARATE ITEM</a>-->
        <a href="<?php echo site_url('general_store/add_item_information'); ?>" class="btn btn-sm btn-primary">ADD ITEM</a>
        <a href="<?php echo site_url('bulk_import'); ?>" style="float:right;" class="btn btn-sm btn-primary">BULK IMPORT</a>
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Group</th>
                <th>Brand Name</th>
                <th>Consumable/Asset</th>
                <th>Unit of Measurement</th> 
                <th>Store Location</th>
                <th class="col-md-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($items)) {
                foreach ($items as $item) { ?>
                    <tr>
                         <td>
                               <?php echo $item['item_code']; ?>
                        </td>
                        
                        <td>
                               <?php echo $item['item_name']; ?>
                        </td>
                        
                       
                        <td>
                                <?php echo $item['item_category']; ?>
                        </td>
                                           
                        <td>
                                 <?php echo $item['c_name']; ?>
                        </td>
                        
                         <td>
                                 <?php echo $item['brand_name']; ?>
                        </td>
                        <td>
                                 <?php echo $item['item_type']; ?>
                        </td>
                        <td>
                                 <?php echo $item['meas_unit']; ?>
                        </td>
                        
                        <td>
                                 <?php echo $item['store_location']; ?>
                        </td>
                       

                        <td class="col-md-2">
                            <?php  if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('general_store/edit_item_information/'.$item['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php } ?>
                            <?php  if (in_array(4, $this->role)) { ?>    
                                <a href="<?php echo site_url('general_store/details_item_information/'.$item['id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                            <?php } ?> 
                            <?php  if (in_array(5, $this->role)) { ?>    
                                <button onclick="delete_row('<?php echo site_url('general_store/delete_item_information/'.$item['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                            <?php } ?>    
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>
