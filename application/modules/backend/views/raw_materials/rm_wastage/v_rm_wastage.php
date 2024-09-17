<?php
$user_id = $this->session->userdata('user_id');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(3, 43, $userData);
?>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">

 <div class="os-tabs-w menu-shad">
       <?php require_once(__DIR__ .'/../../rm_wastage_header.php'); ?>   
 </div>   
    
    

<div class="right_content">
        <!--         <h2 style="text-align:center; ">Supplier/Customer's Information List</h2>
            <hr>-->
        <?php //if (in_array(2, $this->role)) { ?>
            <a href="<?php echo site_url('raw_materials/rm_wastage/add_rm_wastage'); ?>" class="btn btn-sm btn-primary">ADD RECEIVE</a>
        <?php //} ?>    
        <table id="datatable" class="table table-striped table-bordered table-hover no-footer">
            <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Receive NO.</th>
                    <th>Receive Date</th>
                    <th>Memo NO.</th>
                    <th>Memo Date</th>
                    <th>Item Code</th>
                    <th>Item Name</th>                    
                    <th>Qty</th>
                    <th>Status</th>
                    
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($wastages)) {
                    $i=1;
                    foreach ($wastages as $row) {
                       //echo '<pre>'; print_r($row);exit;
                        ?>
                        <tr>
                            <td>
        <?php echo $i; ?>
                            </td>
                            
                            
                            <td>
                                <?php if (!empty($row['receive_no'])) echo $row['receive_no']; ?>
                            </td>
                            
                             <td>
                                <?php if (!empty($row['receive_date']))echo date('d-m-Y',strtotime($row['receive_date'])); ?>
                            </td>
                             <td>
                                <?php if (!empty($row['memo_no'])) echo $row['memo_no']; ?>
                            </td>
                            
                            <td>
                                <?php if (!empty($row['memo_date']))echo date('d-m-Y',strtotime($row['memo_date'])); ?>
                            </td>
                            
                             <td>
                                <?php if (!empty($row['item_code'])) echo $row['item_code']; ?>
                            </td>
                            
                            <td>
                                <?php if (!empty($row['item_name'])) echo $row['item_name']; ?>
                            </td>
                            
                                                    
                                                    
                            <td>
                                <?php if (!empty($row['qty'])) echo $row['qty']; ?>
                            </td>
                    
                           <td>
                                <?php if (!empty($row['status'])) echo $row['status']; ?>
                           </td>

                            <td>
                                <?php if($row['status'] == 'Pending'){ ?>
                                <?php //if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('raw_materials/rm_wastage/edit_rm_transfer/' . $row['w_id']); ?>"><button class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></button></a>
                                <?php //} ?>
                                
                                <?php //if (in_array(4, $this->role)) { ?>
                                    <a href="<?php echo site_url('raw_materials/rm_wastage/details_rm_wastage/' . $row['w_id']); ?>"><button class="btn btn-sm btn-info" title="Details"><i class="fa fa-eye"></i></button></a>
                                <?php //} ?>
                                
                                <?php //if (in_array(5, $this->role)) { ?>   
                                <button onclick="delete_row('<?php echo site_url('raw_materials/rm_wastage/delete_rm_wastage/' . $row['w_id']); ?>')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
                                <?php //} ?>              
                                <a href="<?php echo site_url('raw_materials/rm_wastage/confirm_receive/' . $row['w_id']); ?>"><button class="btn btn-sm btn-info" title="Edit">Approve</button></a>
                                <?php }else{?>
                                    <a href="<?php echo site_url('raw_materials/rm_wastage/details_rm_wastage/' . $row['w_id']); ?>"><button class="btn btn-sm btn-info" title="Details"><i class="fa fa-eye"></i></button></a>
                                <?php } ?>
                            </td>
                        </tr>
                        
                    <?php  $i++; }
                    
                }
                ?>
            </tbody>
        </table>   
    </div>
</div>
