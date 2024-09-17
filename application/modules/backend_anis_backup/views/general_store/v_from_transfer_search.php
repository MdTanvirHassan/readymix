<?php
$user_id = $this->session->userdata('user_id');
$user_type = $this->session->userdata('user_type');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(1, 2, $userData);
?>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(1, 1, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'transfer') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/transfer'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Transfer List  </span>
                    </a>
                </li>
                <?php } ?> 
                <?php $this->role = checkUserPermission(1, 2, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>      
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'from_transfer') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/fromTransfer'); ?>">
                        <i class="fa fa-cc"></i><br><span>Received from other project</span></a>
                </li>
                <?php } ?>
               
                
                
                
                
            </ul>
        </div>
    </div>

<div class="right_content">
    <?php if($user_type == 1){?>
    <div class="col-md-4 col-md-offset-4">
        <select id="project" class="form-control">
        <option value="All">All</option>
        <?php foreach($projects as $row){?>
        <option <?php if($row['d_id']== $branch_id) echo 'selected';?> value="<?php echo $row['d_id']?>"><?php echo $row['short_name']?></option>
        <?php }?>
    </select> 
    </div>
    <?php }?>
    
        <table id="datatable" class="table table-striped table-bordered table-hover no-footer">
            <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Item Name</th>
                   <th>Transfer Quantity</th>
                   <th>From Project</th>
                   <th>TO Project</th>
                    <th>Transfer date</th>
                    <th>Create Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($transfer)) {
                    $i=1;
                    foreach ($transfer as $row) {
                        ?>
                        <tr>
                            <td>
        <?php echo $i; ?>
                            </td>
                            <td>
        <?php if (!empty($row['item_name'])) echo $row['item_name']; ?>
                            </td>
                            <td>
        <?php if (!empty($row['transfer_quantity'])) echo $row['transfer_quantity']; ?>
                            </td>
                            <td>
        <?php if (!empty($row['short_name'])) echo $row['short_name']; ?>
        
                            </td>
                            <td>
        <?php if (!empty($department[0]['short_name'])) echo $department[0]['short_name']; ?>
                            </td>
                            <td>
        <?php if (!empty($row['create_date'])) echo date('d-m-Y',strtotime($row['create_date'])); ?>
                            </td>
                            <td>
        <?php if (!empty($row['transfer_date']))echo date('d-m-Y',strtotime($row['transfer_date'])); ?>
                            </td>

                            <td>
                                
                                <?php if ($row['status']== '2') { ?>
                                <a href=""><button class="btn btn-sm btn-info" title="Receive">Receive</button></a>
                                <?php } ?>
                                <?php if (in_array(5, $this->role)) { ?>   
<!--                                <button onclick="delete_row('<?php echo site_url('general_store/delete_supplier/' . $supplier['ID']); ?>')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>-->
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
<script>
$('#project').change(function(){
    
    var branchID = $(this).val();
    
    var data = {'branchID': branchID}
    $.ajax({
            url: '<?php echo site_url('backend/general_store/fromTransferSearch'); ?>',
            data: data,
            method: 'POST',
            dataType: 'html',
              success: function(data) {
                    
                    window.location.href = data;
                }
            });
})

</script>