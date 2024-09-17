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
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
            <!--   <th>Item ID</th>-->
                <th>Item Name</th>
                <th>Category</th>
                <th>Group</th>
                <th>Brand Name</th>
            <!--    <th>Consumable/Asset</th>-->
                <th>Unit of Measurement</th>
                <th>Maximum Level</th> 
                <th>Order Level</th>
                <th>Minimum Level</th>
                <th>Stock Qty</th>
                
            </tr>
        </thead>
        <tbody>
            <?php if (count($items)) {
                foreach ($items as $item) { ?>
                    <tr>
                        <!--
                         <td>
                               <?php echo $item['item_code']; ?>
                        </td>
                       --> 
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
                                 <?php echo $item['item_brands']; ?>
                        </td>
                        <!--
                        <td>
                                 <?php echo $item['item_type']; ?>
                        </td>
                        -->
                        <td>
                                 <?php echo $item['meas_unit']; ?>
                        </td>
                        
                        <td>
                                 <?php echo $item['max_level']; ?>
                        </td>
                        
                         <td>
                                 <?php echo $item['order_level']; ?>
                        </td>
                        
                         <td>
                                 <?php echo $item['min_level']; ?>
                        </td>

                        <?php if($item['stock_amount']<=$item['min_level']){ ?>
                      
                            <td style="background-color:red;color:#000000;">
                                       <?php echo $item['stock_amount']; ?>
                            </td>
                        <?php }else if($item['stock_amount']<=$item['order_level']){ ?>
                  
                            <td style="background-color: yellow;color:#000000;">
                                       <?php echo $item['stock_amount']; ?>
                            </td>
                        <?php }else{ ?>
                  
                            <td style="background-color: green;color:#000000;">
                                       <?php echo $item['stock_amount']; ?>
                            </td>
                        <?php } ?>   

                      
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>


