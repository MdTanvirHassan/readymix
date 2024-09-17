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
        <a href="<?php echo site_url('item_adjustment/addAdjustment'); ?>" class="btn btn-sm btn-primary">ADD ADJUSTMENT</a>
    <?php } ?> 
        
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th>Date</th>
               <!-- <th>Item ID</th>-->
                <th>Item Name</th>
                <th>Category</th>
                <th>Group</th>
                <th>Brand Name</th>
                <th>Consumable/Asset</th>
                <th>Unit of Measurement</th>               
                <th>Qty</th>
                <th>Remark</th>
                <th>Status</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            <?php if (count($items)) {
                foreach ($items as $item) { ?>
                    <tr>
                        <td>
                               <?php echo date('d-m-Y',strtotime($item['date'])); ?>
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
                                 <?php echo $item['qty']; ?>
                        </td>
                        <td>
                               <?php echo $item['remark']; ?>
                        </td>
                        <td>
                                 <?php echo $item['status']; ?>
                        </td>
                  
                       <td class="col-md-2">
                            <?php  if (in_array(3, $this->role)) { ?>
                              <?php if($item['status']=="Pending"){ ?>
                                    <a href="<?php echo site_url('item_adjustment/confirmAdjustment/'.$item['id']); ?>"><button class="btn btn-sm btn-primary" title="Edit">Confirm</button></a>
                                    <a href="<?php echo site_url('item_adjustment/editAdjustment/'.$item['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <!--    <button onclick="delete_row('<?php echo site_url('item_adjustment/deleteAdjustment/' . $item['id']); ?>')" class="btn btn-sm btn-danger" title="Delete">Delete</i></button>-->
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


