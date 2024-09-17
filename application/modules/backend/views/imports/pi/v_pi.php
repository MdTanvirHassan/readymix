<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(18, 109, $userData);
        
       
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
     $this->role = checkUserPermission(18,109, $userData);  
     if (in_array(2, $this->role)) {  ?>
           <a href="<?php echo site_url('imports/pi/add_pi'); ?>" class="btn btn-sm btn-primary">Add PI</a>
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-2">Date</th>
                <th class="col-lg-2">PI No</th>      
                <th class="col-lg-2">Supplier Name</th> 
                <th class="col-lg-2">Benificiary  Bank</th>
               
                <th class="col-lg-1">Amount</th>
                <th class="col-lg-1">Status</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($pis)) {
                foreach ($pis as $pi) { 
                    
                    
                    ?>
                    <tr>
                        
                        <td>
                            <?php echo date('d-m-Y',strtotime($pi['pi_date'])); ?>
                        </td>
                        
                        <td>
                            <?php echo $pi['pi_no']; ?>
                        </td>
                       
                        <td>
                            <?php echo $pi['SUP_NAME']; ?>
                        </td>
                      
                        <td>
                            <?php echo $pi['buyer_bank']; ?>
                        </td>
                        
                        
                        <td>
                            <?php echo $pi['amount']; ?>
                        </td>
                        
                        
                        <td>
                             <?php if($pi['status']=="Pending"){ ?>
                                    <span style="color:#CE9208;"> <?php echo $pi['status']; ?></span>
                              <?php }else{ ?>
                                    <span style=""> <?php echo $pi['status']; ?></span>
                              <?php } ?>
                            <?php 
                            
                            ?>
                        </td>

                        <td>
                          
                                  
                        <?php if (in_array(4, $this->role)) {  ?>    
                                    <a href="<?php echo site_url('imports/pi/detailspi/'.$pi['id']); ?>"><button class="btn btn-sm btn-success" title="Details">Details</button></a>
                                    <a href="<?php echo site_url('imports/pi/edit_pi/'.$pi['id']); ?>"><button class="btn btn-sm btn-primary" title="Edit">Edit</button></a>
                                    <a href="javascript:" onclick="deleteRow('<?php echo site_url('imports/pi/delete/'.$pi['id']); ?>')"><button class="btn btn-sm btn-danger" title="Edit">Delete</button></a>
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
