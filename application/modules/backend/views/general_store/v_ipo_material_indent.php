<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(17,101, $userData);
        
       
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; "> Material Indent List</h2>
    <hr>-->
<!--
<div class="os-tabs-w menu-shad">
       <?php //require_once(__DIR__ .'/../procurement_header.php'); ?>
    </div>
-->
<div class="right_content">
    
    
    <form id="item-form" action="<?php site_url('backend/general_store/ipo_material_indent'); ?>" method="post"> 
    <div class="row">  
                            
    <div style="margin-top: 15px;" class="col-md-4 ">
              <input  type="text" name="from_date" class="form-control datepicker" value="<?php if(!empty($f_date)) echo $f_date; ?>" placeholder="From Date"/>
          </div>

           <div style="margin-top: 15px;" class="col-md-4 ">
              <input  type="text" name="to_date" class="form-control datepicker" value="<?php if(!empty($to_date)) echo $to_date; ?>" placeholder="To Date"/>
          </div>
        
            <div style="margin-top: 15px;" class="col-md-4 ">
              <input  type="text" name="indent_no" class="form-control " value="<?php if(!empty($indent_no)) echo $indent_no; ?>" placeholder="Indent Number"/>
          </div>
    </div><!--End Row-->    



      <div class="clearfix"></div>
      <div style="margin-top: 15px;" class="col-md-12">

          <div class="col-md-8 col-md-offset-3">
    
               <input id="form-submit" style="padding: 6px 40px;background-color: #337ab7 !important;" type="submit" class="btn btn-primary" value="SEARCH"/>
             

          </div>
      </div>
   </form>   
      <div class="clearfix"></div>
    
    
    
     <?php 
     $this->role =array();
     $this->role = checkUserPermission(17,101, $userData);  
     if (in_array(2, $this->role)) {  ?>
            <a href="<?php echo site_url('general_store/add_ipo_material_indent'); ?>" class="btn btn-sm btn-primary">ADD INDENT MATERIAL</a>
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Indent Number</th>
               
                <th class="col-lg-1">Project</th>
               
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Indent Type</th>
                <th class="col-lg-1">Status</th>
                <th class="col-lg-1">Approver Name</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($ipo_materials)) {
                foreach ($ipo_materials as $ipo_material) { 
                    $adder_id = $ipo_material['employeeId'];
                    $user_info = $this->m_common->get_row_array("users", array('employeeId' => $adder_id), "*");
                    $approver =fetch_approver(17,101, $user_info);
                    
                    ?>
                    <tr>
                        <td>
                            <?php echo $ipo_material['ipo_number']; ?>
                        </td>
                       
                        <td>
                            <?php echo $ipo_material['dep_description']; ?>
                        </td>
                      
                        <td>
                            <?php echo date('d-m-Y',strtotime($ipo_material['date'])); ?>
                        </td>
                         <td>
                            <?php if(!empty($ipo_material['type_name']))  echo $ipo_material['type_name']; ?>
                        </td>
                        <td>
                             <?php if($ipo_material['status']=="Pending"){ ?>
                                    <span style="color:#CE9208;"> <?php echo $ipo_material['status']; ?></span>
                              <?php }else{ ?>
                                    <span style=""> <?php echo $ipo_material['status']; ?></span>
                              <?php } ?>
                            <?php 
                            //echo $ipo_material['indent_process_status'];
                            //echo $ipo_material['budgeted_status'];
                            ?>
                        </td>
                        
                        <td>
                            <?php echo $ipo_material['approver_name']; ?>
                        </td>

                        <td>
                           <?php  if($user_type != 1){ ?>
                                        <?php  if (in_array(3, $this->role)) {  ?>  
                                                <?php if($ipo_material['status']=="Pending"){ ?>
                            <a href="<?php echo site_url('general_store/edit_ipo_material_indent/'.$ipo_material['ipo_m_id']); ?>"><button class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></button></a>
                                                <?php }else{?>
                                                    <button class="btn btn-sm btn-info">Edit</button>
                                                <?php } ?> 
                                        <?php } ?>       
                                    
                           <?php }else{ ?>
                                  <?php  if (in_array(3, $this->role)) {  ?>                     
                                        <a href="<?php echo site_url('general_store/edit_ipo_material_indent/'.$ipo_material['ipo_m_id']); ?>"><button class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></button></a>
                                  <?php } ?>      
                           <?php } ?>
                                  
                            <?php  if (in_array(4, $this->role)) {  ?>    
                                        <a href="<?php echo site_url('general_store/details_ipo_material_indent/'.$ipo_material['ipo_m_id']); ?>" target="_blank"><button class="btn btn-sm btn-success" title="Details"><i class="fa fa-server"></i></button></a>
                            <?php } ?>
                            
                                
                           <?php  if(in_array(5, $this->role)) {  ?>       
                                    <?php if($ipo_material['status']=="Pending"){ ?>
                                        <button onclick="delete_row('<?php echo site_url('general_store/delete_ipo_material_indent/'.$ipo_material['ipo_m_id']); ?>')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
                                    <?php }else{ ?>
                                        <button class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
                                    <?php } ?>
                           <?php } ?> 
                                           
                                           
                                           
                                           
                          <?php  if($user_type == 1){ ?>
                                  <?php if($ipo_material['status']=="Approved"){ ?>
                                       
                                        <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                                  <?php }else if($ipo_material['status']=="Rejected"){ ?>
                                          <a href="<?php echo site_url('general_store/approve_ipo_material_indent/'.$ipo_material['ipo_m_id']) ?>"><button class="btn btn-primary">Approve</button></a>
                                  <?php }else{ ?>  
                                            <a href="<?php echo site_url('general_store/approve_ipo_material_indent/'.$ipo_material['ipo_m_id']) ?>"><button class="btn btn-primary">Approve</button></a>
                                            <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                                  <?php } ?>       
                          <?php }else{ ?>     
                                 
                                    <?php  if($employee_id == $approver[0]) {  ?>
                                         <?php  if(!empty($approver[1]) ) { ?>
                                                       <a href="<?php echo site_url('general_store/forward_ipo_material_indent/'.$ipo_material['ipo_m_id']) ?>"><button class="btn btn-success">Forward</button></a>
                                                       <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                                         <?php }else{ ?> 
                                                <a href="<?php echo site_url('general_store/approve_ipo_material_indent/'.$ipo_material['ipo_m_id']) ?>"><button class="btn btn-primary">Approve</button></a>
                                                <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>       
                                         <?php } ?>              

                                    <?php } ?>
                                                
                                    <?php  if($employee_id == $approver[1]) {  ?>
                                         <?php  if(!empty($approver[2]) ) { ?>
                                                       <a href="<?php echo site_url('general_store/forward_ipo_material_indent/'.$ipo_material['ipo_m_id']) ?>"><button class="btn btn-success">Forward</button></a>
                                                       <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                                         <?php }else{ ?> 
                                                <a href="<?php echo site_url('general_store/approve_ipo_material_indent/'.$ipo_material['ipo_m_id']) ?>"><button class="btn btn-primary">Approve</button></a>
                                                <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>       
                                         <?php } ?>              

                                    <?php } ?>
                                                
                                   <?php  if($employee_id == $approver[2]) {  ?>
                                         <?php  if(!empty($approver[3]) ) { ?>
                                                       <a href="<?php echo site_url('general_store/forward_ipo_material_indent/'.$ipo_material['ipo_m_id']) ?>"><button class="btn btn-success">Forward</button></a>
                                                       <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                                         <?php }else{ ?> 
                                                <a href="<?php echo site_url('general_store/approve_ipo_material_indent/'.$ipo_material['ipo_m_id']) ?>"><button class="btn btn-primary">Approve</button></a>
                                                <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>       
                                         <?php } ?>              

                                    <?php } ?>
                                                
                                                
                                   <?php  if($employee_id == $approver[3]) {  ?>
                                         
                                                <a href="<?php echo site_url('general_store/approve_ipo_material_indent/'.$ipo_material['ipo_m_id']) ?>"><button class="btn btn-primary">Approve</button></a>
                                                <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>       
                                               

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
