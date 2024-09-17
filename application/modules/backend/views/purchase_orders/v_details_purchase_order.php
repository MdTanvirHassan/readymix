<?php

        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(2,41, $userData);
        
       
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Details Order</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('purchase_orders/purchase_order_letter/'.$purchase_order_info[0]['o_id'].'/print'); ?>" class="btn btn-sm btn-warning">PRINT</a>
            </div>
        </div>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        
                        <?php if($user_type==1){ ?>
                                    <?php if($purchase_order_info[0]['approve_status']=="Approved"){ ?>                             
                                        <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                  <?php }else if($purchase_order_info[0]['approve_status']=="Rejected"){ ?>
                                        <button onclick="approve('<?php echo site_url('purchase_orders/approve_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                   <?php }else{ ?>
                                        <button onclick="approve('<?php echo site_url('purchase_orders/approve_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                        <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                   <?php } ?>
                            
                        <?php }else{ ?>
                             <?php if ($employee_id == $approvers_info[0]) { ?>
                                    <?php  if(!empty($approvers_info[1])){ ?>
                                            <?php if($purchase_order_info[0]['approve_status']=="Pending"){ ?>
                                                    <button onclick="approve('<?php echo site_url('purchase_orders/forward_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-success">Forward</button>&nbsp;&nbsp;
                                                     <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-warning">Reject</button>
                                            <?php } ?>

                                     <?php }else{ ?>
                                               <?php if($purchase_order_info[0]['approve_status']=="Pending"){ ?>
                                                     <button onclick="approve('<?php echo site_url('purchase_orders/approve_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-primary">Approve</button>&nbsp;&nbsp;
                                                      <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-warning">Reject</button>
                                               <?php } ?>
                                     <?php } ?>           
                            <?php } ?>

                           <?php if ($employee_id == $approvers_info[1]) { ?>
                                    <?php  if(!empty($approvers_info[2])){ ?>
                                            <?php if($purchase_order_info[0]['approve_status']=="Forward-By-First-Approver"){ ?>
                                                    <button onclick="approve('<?php echo site_url('purchase_orders/forward_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-success">Forward</button>&nbsp;&nbsp;
                                                    <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-warning">Reject</button>
                                            <?php } ?>

                                     <?php }else{ ?>
                                               <?php if($purchase_order_info[0]['approve_status']=="Forward-By-First-Approver"){ ?>
                                                     <button onclick="approve('<?php echo site_url('purchase_orders/approve_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-primary">Approve</button>&nbsp;&nbsp;
                                                     <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-warning">Reject</button>
                                               <?php } ?>
                                     <?php } ?>           
                            <?php } ?>


                            <?php if ($employee_id == $approvers_info[2]) { ?>
                                    <?php  if(!empty($approvers_info[3])){ ?>
                                            <?php if($purchase_order_info[0]['approve_status']=="Forward-By-Second-Approver"){ ?>  
                                                     <button onclick="approve('<?php echo site_url('purchase_orders/forward_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-success">Forward</button>&nbsp;&nbsp;
                                                     <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-warning">Reject</button>
                                            <?php } ?>

                                     <?php }else{ ?>
                                               <?php if($purchase_order_info[0]['approve_status']=="Forward-By-Second-Approver"){ ?>
                                                     <button onclick="approve('<?php echo site_url('purchase_orders/approve_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-primary">Approve</button>&nbsp;&nbsp;
                                                     <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-warning">Reject</button>
                                               <?php } ?>
                                     <?php } ?>           
                            <?php } ?>


                           <?php if ($employee_id == $approvers_info[3]) { ?>

                                         <?php if($purchase_order_info[0]['approve_status']=="Forward-By-Third-Approver"){ ?>       
                                                <button onclick="approve('<?php echo site_url('purchase_orders/approve_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-primary">Approve</button>&nbsp;&nbsp;
                                                <button onclick="reject('<?php echo site_url('purchase_orders/reject_purchase_order/'.$purchase_order_info[0]['o_id']); ?>')" class="btn btn-warning">Reject</button>
                                         <?php } ?>      

                            <?php } ?>                        



                    <?php } ?>      
                        
                        
                      <form action="<?php echo site_url('purchase_orders/edit_purchase_order_action/'.$purchase_order_info[0]['o_id']); ?>" method="post" onsubmit="javascript: return validation()" >
                        <div class="row" style="margin-left:0px;">   
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                     Order From:
                                </label> 
                    
                                <div class="col-sm-4 input-group">             
                                    <b><?php if(!empty($purchase_order_info[0]['order_from'])) echo $purchase_order_info[0]['order_from']; ?></b>        
                                </div>
                                
                               <label for="title" class="col-sm-2 control-label">
                                  Order For:      
                              </label>
                              <div class="col-sm-4 input-group">
                                  <?php foreach ($indent_types as $indent_type) { ?>
                                    <b><?php if($indent_type['id']==$purchase_order_info[0]['order_type']) echo $indent_type['type_name']; ?></b>
                                 <?php } ?>
                                   
                              </div>
                             
                         </div>
                        </div>  
                          
                         <div class="row" style="margin-left:0px;margin-top:5px;"> 
                                <div class='form-group' >
                                    
                                      <label for="title" class="col-sm-2 control-label">
                                                Project :
                                     </label> 
                                     <div class="col-sm-4 input-group">     
                                        <?php foreach($projects as $project){ ?>
                                         <b> <?php if($project['d_id']==$purchase_order_info[0]['unit_id']) echo $project['dep_description']; ?></b>
                                       <?php } ?>
                                    </div>
                                    
                                    <label for="title" class="col-sm-2 control-label">
                                           Supplier/Contractor:
                                     </label> 
                                     <div class="col-sm-4 input-group">     
                                        <?php foreach($suppliers as $supplier){ ?>
                                           <b><?php if($supplier['ID']==$purchase_order_info[0]['supplier_id']) echo $supplier['SUP_NAME'];?></b>
                                        <?php } ?>
                                    </div>
                                    
                                </div>
                         </div>    
                          
                          
                          
                         <div class="row" style="margin-left:0px;margin-top:5px;"> 
                                <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label">
                                        Order No <sup class="required">*</sup>:
                                    </label> 
                                    <div class="col-sm-4 input-group">     
                                        <b> <?php if(!empty($purchase_order_info[0]['order_no'])) echo $purchase_order_info[0]['order_no']; ?></b>
                                   </div>
                                 <label for="title" class="col-sm-2 control-label">
                                    Date :
                                 </label>
                                <div class="col-sm-4 input-group">
                                       
                                    <b> <?php if(!empty($purchase_order_info[0]['purchase_order_date'])) echo date('d-m-Y',strtotime($purchase_order_info[0]['purchase_order_date'])); ?></b>
                                      
                               </div>
                             
                         </div>
                             
                         </div>    
                          <div class="row" style="margin-left:0px;margin-top:5px;">
                                <div class='form-group' >
                                    
                               <label for="title" class="col-sm-2 control-label">
                                    Billing Address :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    
                                    <b>   <?php if(!empty($purchase_order_info[0]['billing_address'])) echo $purchase_order_info[0]['billing_address']; ?></b>
                                    

                                </div>
                                    
                                <label for="title" class="col-sm-2 control-label">
                                    Billing Email :
                                </label> 
                                <div class="col-sm-4 input-group">       
                                    <b> <?php if(!empty($purchase_order_info[0]['billing_email'])) echo $purchase_order_info[0]['billing_email']; ?></b>
                                </div>
                             
                               
                         </div>
                          </div> 
                          
                          <div class="row" style="margin-left:0px;margin-top:5px;">
                              
                               <label for="title" class="col-sm-2 control-label">
                                    Delivery Address :
                                </label> 
                                <div class="col-sm-4 input-group"> 
                                    <b><?php if(!empty($purchase_order_info[0]['shipping_address'])) echo $purchase_order_info[0]['shipping_address']; ?></b>
                                </div>
                             
                              
                                <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Delivery Email :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    
                                    <b><?php if(!empty($purchase_order_info[0]['shipping_email'])) echo $purchase_order_info[0]['shipping_email']; ?></b>
                                   

                                </div>
                             
                             
                             
                         </div> 
                          </div>    
                          <div class="row" style="margin-left:0px;margin-top:5px;">
                                <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Attention :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    
                                    <b> <?php if(!empty($purchase_order_info[0]['attention'])) echo $purchase_order_info[0]['attention']; ?></b>
                                    

                                </div>
                             
                             <label for="title" class="col-sm-2 control-label">
                                    Contact No. :
                                </label> 
                                <div class="col-sm-4 input-group">          
                                    <b><?php if(!empty($purchase_order_info[0]['phone'])) echo $purchase_order_info[0]['phone']; ?> </b>  
                                </div>
                             
                         </div> 
                          </div>
                          <div class="row" style="margin-left:0px;margin-top:5px;">
                                <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            Prepared By :
                                        </label> 
                                        <div class="col-sm-4 input-group">
                                         
                                                <?php foreach($employees as $employee){ ?>
                                            <b> <?php if($employee['id']==$purchase_order_info[0]['employee_id']) echo $employee['name'].'('.$employee['designation_short_name'].')' ?></b>
                                                <?php } ?>
                                          
                                         

                                        </div>
                             
                                       <label for="title" class="col-sm-2 control-label">
                                            Purchase Type:
                                       </label> 

                                       <div class="col-sm-4 input-group">             
                                           <b><?php if(!empty($purchase_order_info[0]['purchase_type'])) echo $purchase_order_info[0]['purchase_type']; ?></b>        
                                       </div>
                             
                                </div> 
                        </div>     
                          
             
             
                          <div class="row" style="margin-top:20px;">
                    <input type="hidden" value="1" id="count" />
                             <table class="table table-bordered" id="myTable" style="display:<?php if($order_type_info[0]['type_name'] != "Material") echo 'none'; ?>">
                                 
                             <thead class="thead-color">
                             <tr>
                                 <th style="width:10%;text-align: center;vertical-align: middle;">Indent No. <sup style='color:red'>*</sup></th>
                                 <th style="width:10%;text-align: center;vertical-align: middle;">Item Name <sup style='color:red'>*</sup></th>
                                 <th style="width:10%;text-align: center;vertical-align: middle;">Unit</th>
                                 <th style="width:10%;text-align: center;vertical-align: middle;">Size</th>
                                 <th style="width:10%;text-align: center;vertical-align: middle;">Size Unit</th>
                                 <th style="width:20%;text-align: center;vertical-align: middle;">P. Qnty<sup style='color:red'>*</sup></th>
                                 <th style="width:20%;text-align: center;vertical-align: middle;">Unit Price<sup style='color:red'>*</sup></th>
                                 <th style="width:20%;text-align: center;vertical-align: middle;">Value<sup style='color:red'>*</sup></th>
                                 <th style="width:20%;text-align: center;vertical-align: middle;">Remark</th>

                                 
                              </tr>
                            </thead>
                            <tbody id="purchase_items">
                                 <?php $i=0; foreach($purchase_order_details_info as $purchase_order_details){ 
                                        $i++;
                                        ?>
                                     <tr class="" id="row_<?php echo $i; ?>">
                                         <td><?php echo $purchase_order_details['indent_no'] ?></td>
                                        <td><?php echo $purchase_order_details['item_name'] ?></td>
                                        <td><?php echo $purchase_order_details['meas_unit'] ?></td>
                                         <td><?php echo $purchase_order_details['item_size'] ?></td>
                                         <td><?php echo $purchase_order_details['unit_name'] ?></td>
                                        <td style="text-align: right;"><b><?php echo $purchase_order_details['quantity'] ?></b></td>
                                        <td style="text-align: right;"><b><?php echo number_format($purchase_order_details['unit_price'],3); ?></b></td>    
                                        <td style="text-align: right;"><b><?php echo number_format($purchase_order_details['amount'],3); ?></b></td>
                                        <td><?php echo $purchase_order_details['remark'] ?></td>

                                      </tr>
                                <?php } ?>
                                
                            </tbody>
                               <tfoot>
                                    <tr>
                                        <td colspan="5" style="text-align:right;">Subtotal:</td>

                                        <td  style="text-align: right;"><b><?php if(!empty($purchase_order_info[0]['total_amount'])) echo number_format($purchase_order_info[0]['total_amount'],3); ?></b></td>
                                    </tr>
                                </tfoot>
                          </table>

                    
                        
                        <div class='form-group' >
                               <label for="title" class="col-sm-2 control-label">
                                     Uploaded Documents:
                                </label>
                                <div class="col-sm-10 input-group" >
                                    <div id="imageDiv">
                                       <?php foreach($purchase_order_document as $row){?>  
                                      <!--  <i onclick="closeImage(<?php echo $row['po_id']?>)" style="color:red;font-size: 16px;" class="fa fa-minus-circle"></i> -->
                                        <img style="width:80px;" src="<?php echo site_url('images/purchase_order_documents/'.$row['file_name']); ?>">
                                    
                                      <?php }?> 
                                    </div>
          
                                    <br>
                                    
                                   
	 
                                </div>
                                
                                
                            </div>              
                    
                          
                    
                    
                    
                          <table class="table table-bordered" id="serviceTable" style="display:<?php if($order_type_info[0]['type_name']!="Sub Contractor Job") echo 'none' ?>">
                              <thead class="thead-color">
                             <tr>

                                 <th>Service Name <sup style='color:red'>*</sup></th>
                                 <th>Value<sup style='color:red'>*</sup></th>
                                 <th>Remark</th>

                                 
                              </tr>
                            </thead>
                            <tbody id="service_items">
                                 <?php $i=0; foreach($purchase_order_details_info as $purchase_order_details){ 
                                        $i++;
                                        ?>
                                     <tr class="" id="row_<?php echo $i; ?>">
                                        <td><?php echo $purchase_order_details['service_name'] ?></td>
                                        <td style="text-align: right;"><b><?php echo number_format($purchase_order_details['amount']); ?></b></td>
                                        <td><?php echo $purchase_order_details['remark'] ?></td>

                                      </tr>
                                <?php } ?>
                                
                            </tbody>
                               <tfoot>
                                    <tr>
                                        <td  style="text-align:right;">Subtotal:</td>
                                        <td style="text-align: right;"><b><?php if(!empty($purchase_order_info[0]['total_amount'])) echo number_format($purchase_order_info[0]['total_amount']); ?></b></td>
                                    </tr>
                                </tfoot>
                          </table>

                    
                            
                    

                </div>
           
                          
                          
                
                          
                          
                          
                          
                          
                          
                <div class="separator-shadow row"></div>
        
        
        
       <h2 style="text-align:center; ">Terms & Conditions</h2>
        <button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="specification_hide_button"  class="btn btn-primary "><span class="glyphicon glyphicon-minus"></span></button>
        <button  type="button" style="display:none;padding-left:6px;padding-right:6px;font-size:8px;" id="specification_show_button"  class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span></button>
        <div id="specification_raw_material">
            <div class="row">
                
            <?php if(!empty($purchase_conditions)){ ?> 
                <input type="hidden" value="<?php echo count($purchase_conditions) ?>" id="material_count" />
           <?php }else{ ?>
                <input type="hidden" value="1" id="material_count" />
           <?php } ?>  
                <table class="table table-bordered" id="specificationTable">
                    <thead>
                     <tr >
                       
                        <th>Term or Condition Name </th>
                        <th>Description</th>
                        

                      </tr>
                    </thead>
                    <tbody id="material_specification">
                     <?php $i=0; foreach($purchase_conditions as $purchase_condition){ 
                         $i++;
                         ?>
                        <tr id="row_<?php echo $i; ?>">
                            
                            <td><?php echo $purchase_condition['t_or_c_name']  ?></td>
                            <td><?php echo $purchase_condition['t_or_c_description']  ?></td>
                           
                        </tr>
                     <?php } ?> 
                    </tbody>
                     
                  </table> 
                
           
             
        </div> 
        </div> 
        
        <h2 style="text-align:center; ">Copy To</h2>
        <button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="copy_hide_button"  class="btn btn-primary "><span class="glyphicon glyphicon-minus"></span></button>
        <button  type="button" style="display:none;padding-left:6px;padding-right:6px;font-size:8px;" id="copy_show_button"  class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span></button>
        <div id="copy_div">
            <?php if(!empty($copy_to)){ ?>     
                <input type="hidden" value="<?php echo count($copy_to) ?>" id="copy_count" />
            <?php }else{ ?> 
                <input type="hidden" value="1" id="copy_count" />
            <?php } ?>   
                <table class="table table-bordered" id="specificationTable">
                    <thead>
                     <tr >
                  
                         <th>Description</th>
                         
                      </tr>
                    </thead>
                    <tbody id="copyTable">
                         <?php $i=0; foreach($copy_to as $copy){ 
                         $i++;
                         ?>
                        <tr id="row_<?php echo $i; ?>">
                            <td><?php echo $copy['name'];  ?></td>
                           
                        </tr>
                     <?php } ?> 
                      
                    </tbody>
                     
                  </table>
             
        </div> 
        </div>  
        
         <div class="clearfix"></div>
        <div class="separator-shadow"></div>
                
                <div class="row">
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/purchase_orders') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
                    
                    
                    
                </div>
            
                <div class="row">
               
                    
                </div>
            
            </form>  
                    </div>
                    </div>
                    </div>
                    </div>
          
            
        </div>
        </div>

<script>
    var viewModel = {};
    viewModel.fileData = ko.observable({
        dataURL: ko.observable(),
        // can add "fileTypes" observable here, and it will override the "accept" attribute on the file input
        // fileTypes: ko.observable('.xlsx,image/png,audio/*')
    });
    viewModel.multiFileData = ko.observable({ dataURLArray: ko.observableArray() });
    viewModel.onClear = function (fileData) {
        if (confirm('Are you sure?')) {
            fileData.clear && fileData.clear();
        }
    };
    viewModel.debug = function () {
        window.viewModel = viewModel;
        console.log(ko.toJSON(viewModel));
        debugger;
    };
    viewModel.onInvalidFileDrop = function(failedFiles) {
        var fileNames = [];
        for (var i = 0; i < failedFiles.length; i++) {
            fileNames.push(failedFiles[i].name);
        }
        var message = 'Invalid file type: ' + fileNames.join(', ');
        alert(message)
        console.error(message);
    };
    ko.applyBindings(viewModel);
</script>