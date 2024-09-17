<?php
    $user_id = $this->session->userdata('user_id');
    $user_type = $this->session->userdata('user_type');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(18,105, $userData);
?>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
         <?php       
                require_once(__DIR__ .'/../../rm_setup_header.php');
            ?>
    </div>

    <div class="right_content">
        <!--         <h2 style="text-align:center; ">Supplier/Customer's Information List</h2>
            <hr>-->
        <?php $this->role = checkUserPermission(18, 105, $userData); if (in_array(2, $this->role)) { ?>
                <a href="<?php echo site_url('raw_materials/suppliers/add_supplier'); ?>" class="btn btn-sm btn-primary">ADD SUPPLIER</a>
                
        <?php } ?>    
        <table id="datatable" class="table table-striped table-bordered table-hover no-footer">
            <thead>
                <tr>
                    <th class="col-lg-1">Supplier Id</th>
                    <th class="col-lg-2">Supplier Name</th>
                    <th class="col-lg-1">Contact Person</th>
                    <th class="col-lg-1">Mobile</th>
                    <th class="col-lg-1">Email</th>
                    <th class="col-lg-1">Address</th>
                    
                    <th class="col-lg-1">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($suppliers)) {
                    foreach ($suppliers as $supplier) {
                        ?>
                        <tr>
                            <td>
                                   <?php echo $supplier['CODE']; ?>
                            </td>
                            <td>
                                   <?php if (!empty($supplier['SUP_NAME'])) echo $supplier['SUP_NAME']; ?>
                            </td>
                            <td>
                                    <?php if (!empty($supplier['NAME'])) echo $supplier['NAME']; ?>
                            </td>
                            <td>
                                    <?php if (!empty($supplier['MOBILE'])) echo $supplier['MOBILE']; ?>
                            </td>
                            <td>
                                    <?php if (!empty($supplier['EMAIL'])) echo $supplier['EMAIL']; ?>
                            </td>
                             
                            <td>
                                    <?php if (!empty($supplier['ADDRESS'])) echo $supplier['ADDRESS']; ?>
                            </td>
                            

                            <td>
                                
                                <?php if (in_array(3, $this->role)) { ?>
                                        <a href="<?php echo site_url('raw_materials/suppliers/edit_supplier/' . $supplier['ID']); ?>"><button class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></button></a>
                                <?php } ?>
                                <?php if (in_array(4, $this->role)) { ?>        
                                        <a href="<?php echo site_url('raw_materials/suppliers/details_supplier/' . $supplier['ID']); ?>"><button class="btn btn-sm btn-success" title="Details"><i class="fa fa-server"></i></button></a>
                                <?php } ?>        
                                <?php if (in_array(5, $this->role)) { ?>   
                                <button onclick="delete_row('<?php echo site_url('raw_materials/suppliers/delete_supplier/' . $supplier['ID']); ?>')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
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
