<style>
    .btn-sm{
        padding:5px 5px !important;
    }
</style>
<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(2,41, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <!--
    <h2 style="text-align:center; ">Quotation  List</h2>
    <hr>
    -->
    <div class="os-tabs-w menu-shad">
         <?php require_once(__DIR__ .'/../procurement_header.php'); ?>
    </div>
    
  <div class="right_content">
     <?php $this->role = checkUserPermission(2, 41, $userData);  if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('purchase_orders/add_purchase_order'); ?>" class="btn btn-sm btn-primary">ADD ORDER</a>
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Purchase Order No.</th>
                <th class="col-lg-1">Purchase Type</th>
                <th class="col-lg-1"> Purchase Order For</th>
                <th class="col-lg-1">Supplier Name</th>
                <th class="col-lg-1">Project Name</th>
                <th class="col-lg-1">Amount</th>
                <th class="col-lg-1">MRR Status</th>
                <th class="col-lg-1">Approve Status</th>
                <th class="col-lg-1">Force Closing Status</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($purchase_orders)) {
                foreach ($purchase_orders as $purchase_order) { 
                    $adder_id = $purchase_order['employee_id'];
                    $user_info = $this->m_common->get_row_array("users", array('employeeId' => $adder_id), "*");
                    $approver =fetch_approver(2,41, $user_info);
                    ?>
                    <tr>
                        <td>
                              <?php if(!empty($purchase_order['purchase_order_date'])) echo date('d-m-Y',strtotime($purchase_order['purchase_order_date'])); ?>
                        </td>
                        <td>
                               <?php if(!empty($purchase_order['order_no'])) echo $purchase_order['order_no']; ?>
                        </td>
                        <td>
                               <?php 
                               if(!empty($purchase_order['order_from'])){
                                   if($purchase_order['order_from']=="Money Indent"){
                                        echo 'Cash'; 
                                   }else{
                                       echo 'Credit'; 
                                   }
                               }
                               ?>
                        </td>
                        <td>
                               <?php if(!empty($purchase_order['type_name'])) echo $purchase_order['type_name']; ?>
                        </td>
                        
                        <td>
                               <?php if(!empty($purchase_order['SUP_NAME'])) echo $purchase_order['SUP_NAME']; ?>
                        </td>
                        <td>
                                <?php if(!empty($purchase_order['dep_description'])) echo $purchase_order['dep_description']; ?>
                        </td>
                        <td>
                                <?php if(!empty($purchase_order['total_amount'])) echo number_format($purchase_order['total_amount']); ?>
                        </td>
                        <td>
                                <?php if(!empty($purchase_order['status'])) echo $purchase_order['status']; ?>
                            
                        </td>
                       
                        <td>
                                <?php if(!empty($purchase_order['approve_status'])) echo $purchase_order['approve_status']; ?>
                            
                        </td>

                        
                        <td>
                                <?php if(!empty($purchase_order['closing_status'])) echo $purchase_order['closing_status']; ?>
                            
                        </td>
                        
                        
                        <td>
                            <?php  if (in_array(4, $this->role)) { ?>
                            <?php if($purchase_order['approve_status']=="Approved"){ ?>
                               <?php if($purchase_order['purchase_type']!="Direct"){ ?>
                                    <a href="<?php echo site_url('purchase_orders/purchase_order_letter/'.$purchase_order['o_id']); ?>"><button class="btn btn-sm btn-primary">Order Letter</button></a>
                               <?php } ?>    
                            <?php } ?>     
                                <a href="<?php echo site_url('purchase_orders/details_purchase_order/'.$purchase_order['o_id']); ?>"><button class="btn btn-sm btn-success">View</button></a>
                                
                                
                            <?php } ?>
                            <?php if($purchase_order['approve_status']=="Pending"){ ?>
                                <?php  if (in_array(3, $this->role)) { ?>
                                    <a href="<?php echo site_url('purchase_orders/edit_purchase_order/'.$purchase_order['o_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php } ?>
                                <?php  if (in_array(5, $this->role)) { ?>    
                                    <button onclick="delete_row('<?php echo site_url('purchase_orders/delete_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                <?php } ?>
                            <?php }else{ ?>
                                <?php  if (in_array(3, $this->role)) { ?>    
                                    <button class="btn btn-sm btn-info">Edit</button>
                                <?php } ?>
                                <?php  if (in_array(5, $this->role)) { ?>    
                                    <button  class="btn btn-sm btn-danger">Delete</button>
                                <?php } ?>
                            <?php } ?>    
                                    
                           <?php  if($user_type == 1){ ?>  
                                  <?php if($purchase_order['approve_status']=="Approved"){ ?>                             
                                        <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                  <?php }else if($purchase_order['approve_status']=="Rejected"){ ?>
                                        <button onclick="approve('<?php echo site_url('purchase_orders/approve_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                   <?php }else{ ?>
                                        <button onclick="approve('<?php echo site_url('purchase_orders/approve_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                        <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                   <?php } ?>
                               
                                 
                          <?php }else{ ?>   
                                 
                                    <?php  if($employee_id == $approver[0]) {  ?>
                                         <?php  if(!empty($approver[1]) ) { ?>   
                                                 <button onclick="approve('<?php echo site_url('purchase_orders/forward_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                                 <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php }else{ ?> 
                                                <button onclick="approve('<?php echo site_url('purchase_orders/approve_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php } ?>              

                                   <?php } ?>  
                                                
                                    <?php  if($employee_id == $approver[1]) {  ?>
                                         <?php  if(!empty($approver[2]) ) { ?>
                                                 <button onclick="approve('<?php echo site_url('purchase_orders/forward_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                                 <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php }else{ ?> 
                                                <button onclick="approve('<?php echo site_url('purchase_orders/approve_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php } ?>              

                                   <?php } ?>  
                                                
                                    <?php  if($employee_id == $approver[2]) {  ?>
                                         <?php  if(!empty($approver[3]) ) { ?>
                                                <button onclick="approve('<?php echo site_url('purchase_orders/forward_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-success">Forward</button>
                                                <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>       
                                         <?php }else{ ?> 
                                                <button onclick="approve('<?php echo site_url('purchase_orders/approve_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                         <?php } ?>              

                                   <?php } ?>     
                                                
                                     <?php  if($employee_id == $approver[3]) {  ?>
                                         
                                             <button onclick="approve('<?php echo site_url('purchase_orders/approve_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                             <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                            

                                   <?php } ?>  
                                             
                                             
                                            
                                             
                                                
                          <?php } ?>                    
                                    
                           <?php if(in_array(6,$this->role)){?>   
                                    <?php if($purchase_order['closing_status']!="Closed"){ ?>       
                                         <button onclick="close_po('<?php echo site_url('purchase_orders/close_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-danger" style="background-color: yellow;color:black;">Close</button>
                                    <?php }else if($purchase_order['closing_status']=="Closed"){ ?>  
                                         <button onclick="open_po('<?php echo site_url('purchase_orders/open_purchase_order/'.$purchase_order['o_id']); ?>')" class="btn btn-sm btn-success">Open</button>
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
<script type="text/javascript">
    function close_po(url){
    bootbox.confirm({
        message: "<div class='boot-header'>YOU ARE ABOUT TO CLOSE A PURCHASE ODER ! ARE YOU SURE ?</div><div class='boot-text'></div>",
        buttons: {
            confirm: {
                label: 'YES',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'CANCEL',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true)
                location.href = url;

        }
    });
}


function open_po(url){
    bootbox.confirm({
        message: "<div class='boot-header'>YOU ARE ABOUT TO OPEN A CLOSED PURCHASE ODER ! ARE YOU SURE ?</div><div class='boot-text'></div>",
        buttons: {
            confirm: {
                label: 'YES',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'CANCEL',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true)
                location.href = url;

        }
    });
}
</script>