<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(1,74, $userData);
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
        <?php $this->role = checkUserPermission(1,74, $userData); if (in_array(2, $this->role)) { ?>
            <a href="<?php echo site_url('size_unit/add_size_unit'); ?>" class="btn btn-sm btn-primary">ADD SIZE UNIT</a>
        <?php } ?>    
        <table id="datatable" class="table table-striped table-bordered table-hover no-footer">
            <thead>
                <tr>
                    <th class="col-lg-2">Name</th>
                    <th class="col-lg-2">Description</th>    
                    <th class="col-lg-1">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($size_units)) {
                    foreach ($size_units as $s_unit){
                        ?>
                        <tr>
                            <td>
                                  <?php echo $s_unit['unit_name']; ?>
                            </td>
                         
                            <td>
                                   <?php if (!empty($s_unit['description'])) echo $s_unit['description']; ?>
                            </td>
                          
                            
                            
                            <td>
                                
                                <?php if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('size_unit/edit_size_unit/' . $s_unit['size_unit_id']); ?>"><button class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></button></a>
                                <?php } ?>
                                <?php if (in_array(5, $this->role)) { ?>   
                                <button onclick="delete_row('<?php echo site_url('size_unit/delete_size_unit/' . $s_unit['size_unit_id']); ?>')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
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
