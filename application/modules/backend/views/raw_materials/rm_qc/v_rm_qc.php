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
            require_once(__DIR__ .'/../../rm_receive_header.php');
        ?>
    </div>
    <div class="right_content">
      
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">QC. NO.</th>
                <th class="col-lg-1">QC. Date</th>
                
                <th class="col-lg-1">Qc Status</th>
               
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($mrrs)) {
                foreach ($mrrs as $mrr) { ?>
                    <tr>
                        <td>
                            <?php echo $mrr['qc_no']; ?>
                        </td>
                        
                        <td>
                            <?php echo $mrr['mrr_date']; ?>
                        </td>
                     
                        <td>                             
                            <?php echo $mrr['qc_status']; ?>                             
                        </td>
                          

                        <td>
                            
                                <?php if($mrr['qc_status']=="Pending" ){ ?>
                                    <a href="<?php echo site_url('raw_materials/rm_qc/edit_rm_qc/'.$mrr['mrr_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php }else{ ?>  
                                       
                                <?php } ?>
                           
                                      
                                <a href="<?php echo site_url('raw_materials/rm_qc/details_rm_qc/'.$mrr['mrr_id']); ?>"><button class="btn btn-sm btn-primary">Details</button></a>
                         
                            
                                
                               
                                <?php if($mrr['qc_status']=="Pending"){ ?>                           
                                    <a href="<?php echo site_url('raw_materials/rm_qc/approveQc/'.$mrr['mrr_id']); ?>"><button class="btn btn-sm btn-success">Approve</button></a>
                                <?php } ?> 
                               
                                
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>

