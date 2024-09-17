<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(3, 9, $userData);
              
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">

    <div class="os-tabs-w menu-shad">
        <?php require_once(__DIR__ .'/../logistics_ware_house_header.php'); ?>   
    </div>
    
    <div class="right_content">
        
        
       <div class="row">
            <div id="remover" class="col-md-6 col-md-offset-3">
                <form id="item-form" action="<?php site_url('backend/general_store/material_receive_requisition'); ?>" method="post" autocomplete="off">
                
                

              <div class="row">  

                    <div style="margin-top: 15px;" class="col-md-5 col-md-offset-1">
                        <input  type="text" name="from_date" class="form-control datepicker" value="<?php if(!empty($f_date)) echo date('d-m-Y',strtotime($f_date)); ?>" placeholder="From Date"/>
                    </div>

                     <div style="margin-top: 15px;" class="col-md-5 ">
                        <input  type="text" name="to_date" class="form-control datepicker" value="<?php if(!empty($to_date)) echo date('d-m-Y',strtotime($to_date)); ?>" placeholder="To Date"/>
                    </div>
              </div><!--End Row-->    



                <div class="clearfix"></div>
                <div style="margin-top: 15px;" class="col-md-12">

                    <div class="col-md-8 col-md-offset-3">
                                  
                         <input id="form-submit" style="padding: 6px 40px;background-color:#337ab7 !important;" type="submit" class="btn btn-primary" value="SEARCH"/>
                      

                    </div>
                </div>
                <div class="clearfix"></div>
                </form>
            </div>
        </div>  
        
        
    <?php if($user_type==1){ ?>
     <!--   <a href="<?php //echo site_url('general_store/updateMrrDetails'); ?>" class="btn btn-sm btn-primary">UPDATE MRR</a>-->
    <?php } ?>    
    <?php $this->role = checkUserPermission(3, 9, $userData);  if (in_array(2, $this->role)) {  ?> 
        <a href="<?php echo site_url('general_store/add_material_receive_requisition'); ?>" class="btn btn-sm btn-primary">ADD MRR</a>
    <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">MRR No</th>
                <th class="col-lg-1">Challan No</th>
                <th class="col-lg-1">MRR Date</th>
           
                <th class="col-lg-1">Status</th>
               
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($mrrs)) {
                foreach ($mrrs as $mrr) { ?>
                    <tr>
                        <td>
                            <?php echo $mrr['mrr_no']; ?>
                        </td>
                        <td>
                            <?php echo $mrr['mrr_challan']; ?>
                        </td>
                        <td>
                            <?php echo $mrr['mrr_date']; ?>
                        </td>
                     
                        
                          <td>
                              <?php if($mrr['mrr_status']=="applied"){ ?>
                                    <span style="color:#CE9208;"> <?php echo $mrr['mrr_status']; ?></span>
                              <?php }else{ ?>
                                    <span style=""> <?php echo $mrr['mrr_status']; ?></span>
                              <?php } ?>
                        </td>

                        <td>
                            <?php  if (in_array(3, $this->role)) {  ?> 
                                <?php if($mrr['mrr_status']=="Pending" ){ ?>
                                    <a href="<?php echo site_url('general_store/edit_material_receive_requisition/'.$mrr['mrr_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php }else{ ?>  
                                        <button class="btn btn-sm btn-info">Edit</button>
                                <?php } ?>
                            <?php } ?>
                           <?php  if (in_array(4, $this->role)) {  ?>              
                                <a href="<?php echo site_url('general_store/details_material_receive_requisition/'.$mrr['mrr_id']); ?>"><button class="btn btn-sm btn-primary">Details</button></a>
                           <?php } ?> 
                            <?php  if (in_array(5, $this->role)) {  ?>     
                                <?php if($mrr['mrr_status']=="Pending" ){ ?>
                                     <button onclick="delete_row('<?php echo site_url('general_store/delete_material_receive_requisition/'.$mrr['mrr_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                 <?php }else{ ?>  
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                <?php } ?>
                            <?php } ?>             
                            <?php //if($mrr['mrr_status']=="applied" || $mrr['mrr_status']=="rejected" ){ ?>
                            <?php  if (in_array(2, $this->role)){  ?>             
                                <?php if($mrr['mrr_status']=="Pending" ){ ?>
                                   <a href="<?php echo site_url('general_store/receive_material_receive_requisition/'.$mrr['mrr_id']); ?>"><button class="btn btn-sm btn-success">Receive</button></a>
                               <?php }else{ ?>
                                 <!--   <a href="<?php echo site_url('general_store/reject_material_receive_requisition/'.$mrr['mrr_id']); ?>"><button class="btn btn-sm btn-warning">Reject</button></a> -->
                               <?php } ?>
                            <?php }  ?>        
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>


