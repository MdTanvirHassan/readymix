<?php
$user_id = $this->session->userdata('user_id');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(3, 43, $userData);
?>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">

 <div class="os-tabs-w menu-shad">
       <?php require_once(__DIR__ .'/../../rm_issue_header.php'); ?>   
 </div>   
    
    

<div class="right_content">
        <!--         <h2 style="text-align:center; ">Supplier/Customer's Information List</h2>
            <hr>-->
        <?php //if (in_array(2, $this->role)) { ?>
            <a href="<?php echo site_url('raw_materials/rm_transfers/add_rm_transfer'); ?>" class="btn btn-sm btn-primary">ADD TRANSFER</a>
        <?php //} ?>    
        <table id="datatable" class="table table-striped table-bordered table-hover no-footer">
            <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Issue NO.</th>
                    <th>Issue Date</th>
                    <th>Transfer NO.</th>
                    <th>Transfer Date</th>
                    <th>Item Code</th>
                    <th>Item Name</th>
                   
                    
                    
                    <th>Issue Qty</th>
                    <th>Status</th>
                    
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($transfers)) {
                    $i=1;
                    foreach ($transfers as $row) {
                       //echo '<pre>'; print_r($row);exit;
                        ?>
                        <tr>
                            <td>
        <?php echo $i; ?>
                            </td>
                            
                            
                            <td>
                                <?php if (!empty($row['issue_no'])) echo $row['issue_no']; ?>
                            </td>
                            
                             <td>
                                <?php if (!empty($row['issue_date']))echo date('d-m-Y',strtotime($row['issue_date'])); ?>
                            </td>
                             <td>
                                <?php if (!empty($row['tr_no'])) echo $row['tr_no']; ?>
                            </td>
                            
                            <td>
                                <?php if (!empty($row['tr_date']))echo date('d-m-Y',strtotime($row['tr_date'])); ?>
                            </td>
                            
                             <td>
                                <?php if (!empty($row['item_code'])) echo $row['item_code']; ?>
                            </td>
                            
                            <td>
                                <?php if (!empty($row['item_name'])) echo $row['item_name']; ?>
                            </td>
                            
                                                    
                                                    
                            <td>
                                <?php if (!empty($row['issue_qty'])) echo $row['issue_qty']; ?>
                            </td>
                    
                           <td>
                                <?php if (!empty($row['status'])) echo $row['status']; ?>
                           </td>

                            <td>
                                <?php if($row['status'] == 'Pending'){ ?>
                                <?php //if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('raw_materials/rm_transfers/edit_rm_transfer/' . $row['issue_id']); ?>"><button class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></button></a>
                                <?php //} ?>
                                
                                <?php //if (in_array(4, $this->role)) { ?>
                                    <a href="<?php echo site_url('raw_materials/rm_transfers/details_rm_transfer/' . $row['issue_id']); ?>"><button class="btn btn-sm btn-info" title="Details"><i class="fa fa-eye"></i></button></a>
                                <?php //} ?>
                                
                                <?php //if (in_array(5, $this->role)) { ?>   
                                <button onclick="delete_row('<?php echo site_url('raw_materials/rm_transfers/delete_rm_transfer/' . $row['issue_id']); ?>')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
                                <?php //} ?>              
                                <a href="<?php echo site_url('raw_materials/rm_transfers/approved_transfer/' . $row['issue_id']); ?>"><button class="btn btn-sm btn-info" title="Edit">Approve</button></a>
                                <?php }else{?>
                                    <a href="<?php echo site_url('raw_materials/rm_transfers/details_rm_transfer/' . $row['issue_id']); ?>"><button class="btn btn-sm btn-info" title="Details"><i class="fa fa-eye"></i></button></a>
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
