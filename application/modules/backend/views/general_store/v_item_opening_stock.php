<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(3, 9, $userData);
              
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">

    <div class="os-tabs-w menu-shad">
       <?php require_once(__DIR__ .'/../logistics_ware_house_header.php'); ?>   
    </div>
    
    <div class="right_content">
        
    <?php $this->role = checkUserPermission(3, 9, $userData);  if (in_array(2, $this->role)) {  ?> 
        <a href="<?php echo site_url('general_store/addOpeningStock'); ?>" class="btn btn-sm btn-primary">ADD OPENING STOCK</a>
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
               
                <th>Stock Qty</th>
                <th>Action</th>
                
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
                                 <?php echo $item['opening_stock']; ?>
                        </td>
                  
                       <td class="col-md-2">
                            <?php  if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('general_store/editOpeningStock/'.$item['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                
                            <?php } ?>
                            
                        </td>
                  

                      
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>


