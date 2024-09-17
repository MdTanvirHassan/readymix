<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(2, 7, $userData);
        
       
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; "> Material Indent List</h2>
    <hr>-->

<div class="os-tabs-w menu-shad">
       <?php require_once(__DIR__ .'/../procurement_header.php'); ?>
 </div>
<div class="right_content">
    
   <form id="item-form" action="<?php site_url('backend/general_store/indentList'); ?>" method="post"> 
    <div class="row">  
                            
    <div style="margin-top: 15px;" class="col-md-4">
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
     $this->role = checkUserPermission(2, 7, $userData);  
     if (in_array(2, $this->role)) {  ?>
           <!-- <a href="<?php echo site_url('general_store/add_ipo_material_indent'); ?>" class="btn btn-sm btn-primary">ADD INDENT MATERIAL</a>-->
     <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Indent Number</th>               
                <th class="col-lg-1">Item Name</th>  
                <th class="col-lg-1">Indent Qty</th> 
                <th class="col-lg-1">Budget Qty</th>
                <th class="col-lg-1">Approve Status</th>
                <th class="col-lg-1">Budget Status</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($ipo_materials)) {
                foreach ($ipo_materials as $ipo_material) { 
                    $adder_id = $ipo_material['employeeId'];
                    $user_info = $this->m_common->get_row_array("users", array('employeeId' => $adder_id), "*");
                    $approver =fetch_approver(2, 7, $user_info);
                    
                    ?>
                    <tr>
                        
                        <td>
                            <?php echo date('d-m-Y',strtotime($ipo_material['indent_date'])); ?>
                        </td>
                        
                        <td>
                            <?php echo $ipo_material['indent_no']; ?>
                        </td>
                       
                        <td>
                            <?php echo $ipo_material['item_name']; ?>
                        </td>
                      
                        <td>
                            <?php echo $ipo_material['indent_qty']; ?>
                        </td>
                        
                        <td>
                            <?php echo $ipo_material['net_budgeted_qty']; ?>
                        </td>
                        
                        
                        <td>
                             <?php if($ipo_material['indent_approve_status']=="Pending"){ ?>
                                    <span style="color:#CE9208;"> <?php echo $ipo_material['indent_approve_status']; ?></span>
                              <?php }else{ ?>
                                    <span style=""> <?php echo $ipo_material['indent_approve_status']; ?></span>
                              <?php } ?>
                            <?php 
                            
                            ?>
                        </td>
                        
                        <td>
                            <?php echo $ipo_material['budgeted_status']; ?>
                        </td>

                        <td>
                          
                                  
                        <?php if (in_array(4, $this->role)) {  ?>    
                            <a href="<?php echo site_url('general_store/detailsIndent/'.$ipo_material['ipo_m_id']); ?>" target="_blank"><button class="btn btn-sm btn-success" title="Details">Details</button></a>
                                    <a href="<?php echo site_url('general_store/indentAllPuchaseOrder/'.$ipo_material['id']); ?>" target="_blank"><button class="btn btn-sm btn-primary" title="Details">P.O. Details</button></a>
                        <?php } ?>
                            
                                                                                   
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
            </div>
</div>
