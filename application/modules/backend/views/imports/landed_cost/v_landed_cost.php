<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(18, 110, $userData);
        
       
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; "> Material Indent List</h2>
    <hr>-->

<div class="os-tabs-w menu-shad">
      <?php 
      
             require_once(__DIR__ .'/../../imports_header.php');
        ?>
 </div>
<div class="right_content">
     <?php 
     $this->role =array();
     $this->role = checkUserPermission(18, 110, $userData);  
     if (in_array(2, $this->role)) {  ?>
           <a href="<?php echo site_url('imports/landed_cost/add_landed_cost'); ?>" class="btn btn-sm btn-primary">Add Landed Cost</a>
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                
                <th class="col-lg-2">LC No</th>      
                <th class="col-lg-2">Mother Vessel Name</th> 
                <th class="col-lg-2">BDT Rate</th>  
                <th class="col-lg-1">Lc Qty</th>
                <th class="col-lg-1">Hook Costing Amount</th>
                <th class="col-lg-1">Hook Rate</th>
                <th class="col-lg-1">Yard Costing Amount</th>
                <th class="col-lg-1">Yard Rate</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($lcs)) {
                foreach ($lcs as $lc) { 
                    
                    
                    ?>
                    <tr>
                        
                       
                        
                        <td>
                            <?php echo $lc['lc_no']; ?>
                        </td>
                       
                        <td>
                            <?php echo $lc['mother_vessel_name']; ?>
                        </td>
                      
                        <td>
                            <?php echo $lc['bdt_rate']; ?>
                        </td>
                       <td>
                            <?php echo $lc['lc_qty']; ?>
                        </td>
                        
                        <td>
                            <?php echo $lc['hook_total_amount']; ?>
                        </td>
                        
                        <td>
                            <?php echo round($lc['hook_total_amount']/$lc['lc_qty'],2); ?>
                        </td>
                        
                        <td>
                            <?php echo $lc['yard_total_amount']; ?>
                        </td>
                        
                        <td>
                            <?php echo round($lc['yard_total_amount']/$lc['lc_qty'],2); ?>
                        </td>
                        
                        
                        

                        <td>
                          
                                  
                        <?php if (in_array(4, $this->role)) {  ?>    
                                    <a href="<?php echo site_url('imports/landed_cost/detailsLandedCost/'.$lc['id']); ?>"><button class="btn btn-sm btn-success" title="Details">Details</button></a>
                                    <a href="<?php echo site_url('imports/landed_cost/edit_landed_cost/'.$lc['id']); ?>"><button class="btn btn-sm btn-primary" title="Edit">Edit</button></a>
                                    <a href="javascript:" onclick="deleteRow('<?php echo site_url('imports/landed_cost/delete/'.$lc['id']); ?>')"><button class="btn btn-sm btn-danger" title="Edit">Delete</button></a>
                        <?php } ?>
                            
                                                                                   
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
            </div>
</div>
<script>
function deleteRow(url){
    if(confirm('Are you sure to delete ?')==true){
        window.location.href=url;
    }
}
</script>
