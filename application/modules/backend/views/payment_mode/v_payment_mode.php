<?php
    $user_id = $this->session->userdata('user_id');
    $user_type = $this->session->userdata('user_type');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(1, 2, $userData);
?>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
   <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <?php require_once(__DIR__ .'/../general_store_header.php'); ?>
        </div>
 </div>

    <div class="right_content">
        <!--         <h2 style="text-align:center; ">Supplier/Customer's Information List</h2>
            <hr>-->
        <?php $this->role = checkUserPermission(1, 35, $userData); if (in_array(2, $this->role)) { ?>
            <a href="<?php echo site_url('payment_mode/add_payment_mode'); ?>" class="btn btn-sm btn-primary">ADD PAYMENT MODE</a>
        <?php } ?>    
        <table id="datatable" class="table table-striped table-bordered table-hover no-footer">
            <thead>
                <tr>
                    <th class="col-lg-2">Payment Mode</th>
                    <th class="col-lg-2">Payment Security</th>
                    <th class="col-lg-2">Description</th>
                    <th class="col-lg-2">Remark</th>
                    <th class="col-lg-1">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($payment_modes)) {
                    foreach ($payment_modes as $payment_mode) {
                        ?>
                        <tr>
                            <td>
                                    <?php echo $payment_mode['mode_name']; ?>
                            </td>
                             <td>
                                    <?php echo $payment_mode['security_name']; ?>
                            </td>
                             <td>
                                    <?php echo $payment_mode['description']; ?>
                            </td>
                            
                            <td>
                                    <?php if (!empty($payment_mode['remark'])) echo $payment_mode['remark']; ?>
                            </td>
                          

                            <td>
                                
                                <?php if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('payment_mode/edit_payment_mode/' . $payment_mode['id']); ?>"><button class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></button></a>
                                <?php } ?>
                                <?php if (in_array(5, $this->role)) { ?>   
                                <button onclick="delete_row('<?php echo site_url('payment_mode/delete_payment_mode/' . $payment_mode['id']); ?>')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
        <?php } ?>    
                            </td>
                        </tr>
                    <?php }
                }
                ?>
            </tbody>
        </table>   
    </div>
</div>
