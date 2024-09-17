<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $employee_id = $this->session->userdata('employeeId');
    $user_type = $this->session->userdata('user_type');
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(9, 59, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
     <div class="os-tabs-w menu-shad">
       <?php 
      // require_once(__DIR__ .'/../accounts_header.php'); 
       require_once(__DIR__ .'/../procurement_header.php');
       ?>
    </div>
    <div class="right_content">
    <?php  
    $this->role = checkUserPermission(2,99, $userData);
    if (in_array(2, $this->role)) { 
        ?>
        <a href="<?php echo site_url('accounts/add_bill'); ?>" class="btn btn-sm btn-primary">ADD BILL</a>
    <?php } ?>     
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Serial No.</th>
                <th class="col-lg-1">Receive Date</th>  
                <th class="col-lg-1">Supplier Bill No.</th>
                <th class="col-lg-1">Supplier Name</th>
               
                <th class="col-lg-1">Amount</th> 
                <th class="col-lg-1">Status</th> 
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($bills)) {
                foreach ($bills as $bill) { ?>
                    <tr>
                        
                        <td>
                             <?php if(!empty($bill['id'])) echo '000'.$bill['id']; ?>
                        </td>
                        
                        
                        <td>
                            <?php if(!empty($bill['date'])) echo date('d-m-Y',strtotime($bill['date'])); ?>
                        </td>
                        
                         <td>
                            <?php if(!empty($bill['supplier_bill_no'])) echo $bill['supplier_bill_no']; ?>
                        </td>
                        
                        
                         <td>
                             <?php if(!empty($bill['SUP_NAME'])) echo $bill['SUP_NAME']; ?>
                        </td>
                       
                        
                        <td>
                            <?php if(!empty($bill['amount'])) echo $bill['amount']; ?>
                        </td>
                       
                       <td>
                            <?php if(!empty($bill['verify_status'])) echo $bill['verify_status']; ?>
                        </td>

                        <td>
                            <?php  if (in_array(4, $this->role)) { ?>
                                 <a href="<?php echo site_url('accounts/details_bill/'.$bill['id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                            <?php } ?>    
                           
                         <?php if($bill['verify_status']=="Pending"){ ?>     
                               <?php  if (in_array(3, $this->role)) { ?>     
                                    <a href="<?php echo site_url('accounts/edit_bill/'.$bill['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                               <?php } ?>    
                            
                           
                           
                                <?php  if (in_array(5, $this->role)) { ?>    
                                    <button onclick="delete_row('<?php echo site_url('accounts/delete_bill/'.$bill['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                <?php } ?>  
                         <?php } ?>        
                           
                        </td>
                    </tr>
            <?php } 
} ?>
        </tbody>
    </table>
</div>
</div>

