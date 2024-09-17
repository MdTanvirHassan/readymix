<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(7, 21, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
       <?php       
            require_once(__DIR__ .'/../../rm_setup_header.php');
        ?>
    </div>
    <div class="right_content">
    <?php  //if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('raw_materials/rm_lot/add_rm_lot'); ?>" class="btn btn-sm btn-primary">ADD LOT</a>
    <?php //} ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                 <th class="col-lg-2">Lot No.</th>
                 <th class="col-lg-1">Lot Type</th>
                 <th class="col-lg-2">Lc No.</th>
                 <th class="col-lg-1">Lc Date</th>
                 <th class="col-lg-1">Receive Status</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($rm_lots)) {
                foreach ($rm_lots as $rm_lot) { ?>
                    <tr>
                      
                        <td>
                            <?php if(!empty($rm_lot['lot_number'])) echo $rm_lot['lot_number']; ?>
                        </td>
                         
                        <td>
                            <?php if(!empty($rm_lot['lot_type'])) echo $rm_lot['lot_type']; ?>
                        </td>
                        
                       <td>
                            <?php if(!empty($rm_lot['lc_no'])) echo $rm_lot['lc_no']; ?>
                       </td>
                        
                       <td>
                            <?php if(!empty($rm_lot['date'])) echo date('d-m-Y',strtotime($rm_lot['date'])); ?>
                       </td>
                        
                        <td>
                            <?php if(!empty($rm_lot['status'])) echo $rm_lot['status']; ?>
                       </td>
                        <td>
                             <?php  //if (in_array(4, $this->role)) { ?>
                                <a href="<?php echo site_url('raw_materials/rm_lot/details_rm_lot/'.$rm_lot['id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                             <?php //} ?>
                             <?php  //if (in_array(3, $this->role)) { ?>    
                                <a href="<?php echo site_url('raw_materials/rm_lot/edit_rm_lot/'.$rm_lot['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                             <?php //} ?>
                           <?php  //if (in_array(5, $this->role)) { ?>      
                                <button onclick="delete_row('<?php echo site_url('raw_materials/rm_lot/delete_rm_lot/'.$rm_lot['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                           <?php //} ?>     
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>

