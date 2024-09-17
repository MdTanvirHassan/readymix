<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(18, 108, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
        <?php 
      
       require_once(__DIR__ .'/../../imports_header.php');
       ?>
    </div>
    <div class="right_content">
      
    <?php  if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('imports/sales_contact/add_sales_contact'); ?>" class="btn btn-sm btn-primary">ADD SALES CONTRACT</a>
    <?php } ?> 
  
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-2">Contract Date</th>
                <th class="col-lg-1">Contract No.</th>
                <th class="col-lg-1">LC Dead Line</th>
                
                <th class="col-lg-1">Shipment Port</th>
                <th class="col-lg-1">Discharge Rate</th>
                <th class="col-lg-1">Status</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($sales_contact)) {
                foreach ($sales_contact as $contact) { ?>
                    <tr>
                      
                        
                        <td>
                            <?php if(!empty($contact['contact_date'])) echo date('d-m-Y',strtotime($contact['contact_date'])); ?>
                        </td>
                        
                        <td>
                            <?php if(!empty($contact['contact_no'])) echo $contact['contact_no']; ?>
                        </td>
                         
                                          
                       <td>
                            <?php if(!empty($contact['lc_deadline'])) echo date('d-m-Y',strtotime($contact['lc_deadline'])); ?>
                       </td>
                        
                      
                       
                       <td>
                            <?php if(!empty($contact['shipment_port'])) echo $contact['shipment_port']; ?>
                       </td>
                        
                       
                       <td>
                            <?php if(!empty($contact['discharge_rate'])) echo $contact['discharge_rate']; ?>
                       </td> 
                       
                        <td>
                            <?php if(!empty($contact['status'])) echo $contact['status']; ?>
                       </td> 
                        <td>
                           
                            <?php  if (in_array(4, $this->role)) { ?>
                                <a href="<?php echo site_url('imports/sales_contact/details_sales_contact/'.$contact['id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                            <?php } ?>
                         
                                
                             
                            
                           <?php  if (in_array(3, $this->role)) { ?>    
                                <a href="<?php echo site_url('imports/sales_contact/edit_sales_contact/'.$contact['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                           <?php } ?>
                                
                           <?php  if (in_array(5, $this->role)) { ?>      
                                <button onclick="delete_row('<?php echo site_url('imports/sales_contact/delete_sales_contact/'.$contact['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                           <?php } ?> 
                           
                        
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>

