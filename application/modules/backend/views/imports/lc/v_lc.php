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
           <a href="<?php echo site_url('imports/lc/add_lc'); ?>" class="btn btn-sm btn-primary">Add L/C</a>
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-2">Date</th>
                <th class="col-lg-2">LC No</th>      
                <th class="col-lg-2">Supplier Name</th> 
                <th class="col-lg-2">Party Bank</th>
                <th class="col-lg-2">Our Bank</th>
                <th class="col-lg-1">Amount</th>
                <th class="col-lg-1">Status</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($lcs)) {
                foreach ($lcs as $lc) { 
                    $adder_id = $lc['created_by'];
                    $user_info = $this->m_common->get_row_array("users", array('employeeId' => $adder_id), "*");
                    $approver =fetch_approver(2, 7, $user_info);
                    
                    ?>
                    <tr>
                        
                        <td>
                            <?php echo date('d-m-Y',strtotime($lc['date'])); ?>
                        </td>
                        
                        <td>
                            <?php echo $lc['lc_no']; ?>
                        </td>
                       
                        <td>
                            <?php echo $lc['SUP_NAME']; ?>
                        </td>
                      
                        <td>
                            <?php echo $lc['buyer_bank']; ?>
                        </td>
                        <td>
                            <?php echo $lc['our_bank']; ?>
                        </td>
                        
                        <td>
                            <?php echo $lc['amount']; ?>
                        </td>
                        
                        
                        <td>
                             <?php if($lc['received_status']=="Pending"){ ?>
                                    <span style="color:#CE9208;"> <?php echo $lc['received_status']; ?></span>
                              <?php }else{ ?>
                                    <span style=""> <?php echo $lc['received_status']; ?></span>
                              <?php } ?>
                            <?php 
                            
                            ?>
                        </td>

                        <td>
                          
                                  
                        <?php if (in_array(4, $this->role)) {  ?>    
                                    <a href="<?php echo site_url('imports/lc/detailsLc/'.$lc['lc_id']); ?>"><button class="btn btn-sm btn-success" title="Details">Details</button></a>
                                    <a href="<?php echo site_url('imports/lc/edit_lc/'.$lc['lc_id']); ?>"><button class="btn btn-sm btn-primary" title="Edit">Edit</button></a>
                                    <a href="javascript:" onclick="deleteRow('<?php echo site_url('imports/lc/delete/'.$lc['lc_id']); ?>')"><button class="btn btn-sm btn-danger" title="Edit">Delete</button></a>
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
