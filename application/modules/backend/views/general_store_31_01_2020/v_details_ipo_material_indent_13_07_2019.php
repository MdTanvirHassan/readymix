<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(2, 7, $userData);
       
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3 style="float:left;">Material Indent Details</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('general_store/details_ipo_material_indent/'.$ipo_material_indent[0]['ipo_m_id'].'/true'); ?>" class="btn btn-sm btn-warning">PRINT</a>
            </div>
        </div>
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <!--
    <h2 style="text-align:center; ">Materials Indent<br></h2>
    <a href="<?php echo site_url('general_store/add_ipo_material_indent'); ?>" class="btn btn-sm btn-primary">ADD INDENT MATERIAL</a>
        <?php if($ipo_material_indent[0]['status']=="pending"){ ?> <a href="<?php echo site_url('general_store/edit_ipo_material_indent/'.$ipo_material_indent[0]['ipo_m_id']); ?>" class="btn btn-sm btn-success">EDIT INDENT MATERIAL</a>
     <?php }else{?>
        <button class="btn btn-sm btn-success">EDIT INDENT MATERIAL</button>
    <?php } ?>
     -->   
        
        
      
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Indent Number</th>
                <th>Item Type</th>
                <th>Date</th>
                <th>projects</th>
                <th>Remark</th>
                <th>Status</th>
                <th>Action</th>
            </tr>   
        </thead>
        <tbody>
            <tr>
                <td><?php echo $ipo_material_indent[0]['ipo_number']?></td>
                <td><?php echo $ipo_material_indent[0]['ipo_item_type']?></td>
                <td><?php echo $ipo_material_indent[0]['date']?></td>
                <td><?php
               foreach ($departments as $department) { 
                   if (!empty($ipo_material_indent[0]['department_id']) && $ipo_material_indent[0]['department_id'] == $department['d_id']){
                echo $department['dep_description']."(".  $department['dep_code'].")";
                   }
               }
                ?></td>
                <td><?php echo $ipo_material_indent[0]['remarks']?></td>
                <td><?php echo $ipo_material_indent[0]['status']?></td>
                <td>
                  <?php if($user_type==1){ ?>
        <a href="<?php echo site_url('general_store/approve_ipo_material_indent/'.$ipo_material_indent[0]['ipo_m_id']) ?>"><button class="btn btn-primary">Approve</button></a>&nbsp;&nbsp;<a href="<?php echo site_url('general_store/reject_ipo_material_indent/'.$ipo_material_indent[0]['ipo_m_id']) ?>"><button class="btn btn-warning">Reject</button></a>
    <?php }else{ ?>
             <?php if ($employee_id == $approvers_info[0]) { ?>
                    <?php  if(!empty($approvers_info[1])){ ?>
                            <?php if($ipo_material_indent[0]['status']=="Pending"){ ?>
                                    <a href="<?php echo site_url("general_store/forward_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-success">Forward</button></a>&nbsp;&nbsp;
                                    <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                            <?php } ?>

                     <?php }else{ ?>
                               <?php if($ipo_material_indent[0]['status']=="Pending"){ ?>
                                    <a href="<?php echo site_url("general_store/approve_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-primary">Approve</button></a>&nbsp;&nbsp;
                                    <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                               <?php } ?>
                     <?php } ?>           
            <?php } ?>
             
           <?php if ($employee_id == $approvers_info[1]) { ?>
                    <?php  if(!empty($approvers_info[2])){ ?>
                            <?php if($ipo_material_indent[0]['status']=="Forward-By-First-Approver"){ ?>
                                    <a href="<?php echo site_url("general_store/forward_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-success">Forward</button></a>&nbsp;&nbsp;
                                    <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                            <?php } ?>

                     <?php }else{ ?>
                               <?php if($ipo_material_indent[0]['status']=="Forward-By-First-Approver"){ ?>
                                    <a href="<?php echo site_url("general_store/approve_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-primary">Approve</button></a>&nbsp;&nbsp;
                                    <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                               <?php } ?>
                     <?php } ?>           
            <?php } ?>
                                  
                                  
            <?php if ($employee_id == $approvers_info[2]) { ?>
                    <?php  if(!empty($approvers_info[3])){ ?>
                            <?php if($ipo_material_indent[0]['status']=="Forward-By-Second-Approver"){ ?>
                                    <a href="<?php echo site_url("general_store/forward_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-success">Forward</button></a>&nbsp;&nbsp;
                                    <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                            <?php } ?>

                     <?php }else{ ?>
                               <?php if($ipo_material_indent[0]['status']=="Forward-By-Second-Approver"){ ?>
                                    <a href="<?php echo site_url("general_store/approve_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-primary">Approve</button></a>&nbsp;&nbsp;
                                    <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                               <?php } ?>
                     <?php } ?>           
            <?php } ?>
                                  
                                  
           <?php if ($employee_id == $approvers_info[3]) { ?>
                    
                         <?php if($ipo_material_indent[0]['status']=="Forward-By-Third-Approver"){ ?>       
                            <a href="<?php echo site_url("general_store/approve_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-primary">Approve</button></a>&nbsp;&nbsp;
                            <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                         <?php } ?>      
                        
            <?php } ?>                        
                                  
                                  
                                  
    <?php } ?>   
        
  
                    
                </td>
            </tr>
        </tbody>
    </table>

<!--    <form method="post" action="<?php echo site_url('general_store/edit_action_ipo_material_indent/'.$ipo_material_indent[0]['ipo_m_id']) ?>">-->
<!--        <div class="row">
            <div class="col-md-6" style="">
                <h4 style="text-align: center;text-decoration: underline;"></h4>

                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Indent Number:</label></div>
                    <div class="col-sm-8 col-md-5 "><input disabled class="form-control" id="inputdefault" name="ipo_number" value="<?php if (!empty($ipo_material_indent[0]['ipo_number'])) echo $ipo_material_indent[0]['ipo_number']; ?>" type="text"></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Date :</label></div>
                    <div class="col-sm-8 col-md-5 "><input disabled class="form-control datepicker"  name="date" value="<?php if (!empty($ipo_material_indent[0]['date'])) echo $ipo_material_indent[0]['date']; ?>" type="text"></div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Project :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <select disabled class="form-control" name="department_id">
                            <option value="">Select Project</option>
                            <?php foreach ($departments as $department) { ?>
                                <option <?php if (!empty($ipo_material_indent[0]['department_id']) && $ipo_material_indent[0]['department_id'] == $department['d_id']) echo "selected"; ?> value="<?php echo $department['d_id']; ?>"><?php if(!empty($department['dep_code'])) echo $department['dep_description']."(".  $department['dep_code'].")"; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
              

               
            </div> 







            <div class="col-md-6" style="">
                <h4 style="text-align: center;text-decoration: underline;"></h4>
                  <div class="form-group row">
                      
                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Indent Memo :</label></div>
                    <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="indent_memo" value="<?php if (!empty($ipo_material_indent[0]['indent_memo'])) echo $ipo_material_indent[0]['indent_memo']; ?>" type="text"></div>
                   
                   <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Item Type :</label></div>
                          <div class="col-sm-8 col-md-5 ">
                              <select disabled id="ipo_item_type" class="form-control" name="ipo_item_type" onchange="javascript:consumable_or_asset();">
                                    
                                    
                                            <option <?php if (!empty($ipo_material_indent[0]['ipo_item_type']) && $ipo_material_indent[0]['ipo_item_type']=="Consumable") echo "selected"; ?> class="form-control" value="Consumable">Consumable</option>
                                            <option <?php if (!empty($ipo_material_indent[0]['ipo_item_type']) && $ipo_material_indent[0]['ipo_item_type']=="Asset") echo "selected"; ?> class="form-control" value="Asset">Asset</option>
                                  
                                </select>
                          </div>
                </div>
               
                <div class="form-group row">
                    <div class=" col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Remarks :</label></div>
                    <div class=" col-sm-8 col-md-5 "><input disabled class="form-control" id="inputdefault" name="remarks" value="<?php if (!empty($ipo_material_indent[0]['remarks'])) echo $ipo_material_indent[0]['remarks']; ?>" type="text"></div>
                </div>


                 <div class="form-group row">
                    <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Status :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <select disabled class="form-control" name="status">
                            <option <?php if (!empty($ipo_material_indent[0]['status']) && $ipo_material_indent[0]['status'] == "Yes") echo "selected"; ?>  class="form-control" value="Yes">Yes</option>
                            <option <?php if (!empty($ipo_material_indent[0]['status']) && $ipo_material_indent[0]['status'] == "No") echo "selected"; ?> class="form-control" value="No">No</option>
                        </select>
                    </div>
                </div>



            </div>
        </div>-->
        <hr>
        <?php if($ipo_material_indent[0]['ipo_item_type']=="Consumable"){ ?>
                <?php if (!empty($ipo_material_indent_details)) { ?> 
                    <input type="hidden" id="count" value="<?php echo count($ipo_material_indent_details); ?>"/>

                    <table class="table table-bordered" id="myTable">
                    <thead>
                    <tr class="row">
                        
                        <th>Item.Code</th>
                        <th>Item name & Description</th>
                        <th>MU</th>
                        
                         <th>Last Rate</th>
                        <th>Last Supplier</th>
                        
                        <th>Stock Qty</th>
                        <th>Indent Qty</th>
                       
                        <th>Est. Value</th>
                        <th>Asset</th>
                        <th>Expected Date</th>
                        <th>Cost Center</th>


                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;
                    foreach ($ipo_material_indent_details as $ipo_material_indent_detail) {
                        $i++; ?>  
                        <tr class="row" id="row_<?php echo $i; ?>">
                          
                            <td> 
                                    
                                    <?php foreach ($items as $item) { ?>
                                        <?php if (!empty($ipo_material_indent_detail['item_id']) && $ipo_material_indent_detail['item_id'] == $item['id']){ ?>
                                            <?php if(!empty($item['item_code'])) echo $item['item_code']."(". $item['item_name'].")"; ?>
                                
                                    <?php } } ?>
                                </td>
                            <td><?php if (!empty($ipo_material_indent_detail['item_name_description'])) echo $ipo_material_indent_detail['item_name_description']; ?></td>
                            <td><?php if (!empty($ipo_material_indent_detail['unit'])) echo $ipo_material_indent_detail['unit']; ?></td>
                            
                             <td><?php if (!empty($ipo_material_indent_detail['last_unit_price'])) echo $ipo_material_indent_detail['last_unit_price']; ?></td>
                             <td><?php if (!empty($ipo_material_indent_detail['last_supplier'])) echo $ipo_material_indent_detail['last_supplier']; ?></td>
                            
                            
                            <td><?php if (!empty($ipo_material_indent_detail['stock_qty'])) echo $ipo_material_indent_detail['stock_qty']; ?></td>
                            <td><?php if (!empty($ipo_material_indent_detail['indent_qty'])) echo $ipo_material_indent_detail['indent_qty']; ?></td>
                            
                            <td><?php if (!empty($ipo_material_indent_detail['unit_price'])) echo $ipo_material_indent_detail['unit_price']; ?></td>
                            
                            <td> 
                                
                                                <?php foreach($assets as $asset){ ?>
                                                    <?php if (!empty($ipo_material_indent_detail['asset_id']) && $ipo_material_indent_detail['asset_id']==$asset['id'] ){?> ?>
                                                        <?php if(!empty($asset['item_name'])) echo $asset['item_name']."(". $asset['item_code'].")"; ?>
                                                <?php } }?>
                                
                                      
                            </td>
                            
                            <td><?php if (!empty($ipo_material_indent_detail['expected_date'])) echo date('d-m-Y', strtotime($ipo_material_indent_detail['expected_date'])); ?></td>
                            <td>
                                    <?php
                                    foreach($cost_centers as $cost_center){ 
                                      if (!empty($ipo_material_indent_detail['c_c_id']) && $ipo_material_indent_detail['c_c_id']==$cost_center['c_c_id'] ){ 
                                           if(!empty($cost_center['c_c_name'])) echo $cost_center['c_c_name'];
                                    } 
                                    
                                      } 
                                    ?>
                      </td> 
                            
                        </tr>
                    <?php } ?>        
                </tbody>
                </table>
            <?php } ?>
                 
            <table class="table table-bordered" id="myTable1" style="display:none;">
                <input type="hidden" id="a_count" value="1"/>
                        <thead>
                            <tr class="row">
                               
                                <th>Item.Code</th>
                                <th>Item name & Description</th>
                                <th>MU</th>
                                
                                 <th>Last Rate</th>
                                 <th>Last Supplier</th>
                                
                                <th>Stock Qty</th>
                                <th>Indent Qty</th>
                                <th>Est. Value</th>
                             <!--   <th>Asset</th> -->
                                <th>Expected Date</th>
                                <th>Cost Center</th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr class="row" id="row_1">
                               
                                <td> <select style="width:100px;" onchange="javascript:item_info(1);" id="item_a_1" name="item_id_a[]">
                                        <option value="">Select Item</option>
                                        <?php foreach ($items as $item) { ?>
                                            <option value="<?php echo $item['id']; ?>"><?php if(!empty($item['item_code'])) echo $item['item_code']."(". $item['item_name'].")"; ?></option>
                                        <?php } ?>
                                    </select></td>
                                <td><input style="width:140px;" type="text" id="item_des_a_1"  name="item_name_description_a[]" class="issue"></td>
                                <td><input style="width:60px;" type="text" id="unit_a_1"  name="unit_a[]" class="issue"></td>
                                
                                 <td><input style="width:60px;" type="text"  name="last_unit_price_a[]" id="last_unit_price_a_1" class="issue"></td>
                                  <td><input type="text"  name="last_supllier_a[]" id="last_supllier_a_1" class="issue"></td>
                                
                                
                                <td><input style="width:40px;" type="text" id="stock_qty_a_1" name="stock_qty_a[]" class="issue"></td>
                                <td><input style="width:40px;" type="text" id="indent_qty_a_1"  name="indent_qty_a[]" onkeyup="calculateEstvalueAsset(1)" class="issue"></td>

                                <td><input type="hidden" id="unit_price_a_1"  name="unit_price_a[]" class="issue"><input style="width:80px;" disabled type="text" id="unit_price_a1_1"  name="unit_price_a[]" class="issue"></td>
                                <!--
                                <td> <select id="asset_1" name="asset_id[]" >
                                    <option value="">Select Asset</option>
                                    <?php foreach($assets as $asset){ ?>
                                        <option value="<?php echo $asset['a_id'];  ?>"><?php if(!empty($asset['product_id'])) echo $asset['product_name']."(". $asset['product_id'].")"; ?></option>
                                    <?php } ?>
                                </select>
                                </td>
                                -->
                                <td><input style="width:100px;" class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td>
                                 <td> <select disabled style="width:110px;" id="c_c_id" name="c_c_id[]" >
                                    <option value="">Select Cost Center</option>
                                    <?php foreach($cost_centers as $cost_center){ ?>
                                        <option value="<?php echo $cost_center['c_c_id'];  ?>"><?php if(!empty($cost_center['c_c_name'])) echo $cost_center['c_c_name']; ?></option>
                                    <?php } ?>
                                </select></td> 

                            </tr>
                        </tbody>
               </table>
                

               
       <?php }else{ ?>  
                 
                  <table class="table table-bordered" id="myTable" style="display:none;">
                      <input type="hidden" id="count" value="1"/>
                        <thead>
                            <tr class="row">
                              
                                <th>Item.Code</th>
                                <th>Item name & Description</th>
                                <th>MU</th>
                                
                                 <th>Last Rate</th>
                                 <th>Last Supplier</th>
                                
                                <th>Stock Qty</th>
                                <th>Indent Qty</th>

                                <th>Est. Value</th>
                                
                                <th>Expected Date</th>
                                <th>Cost Center</th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr class="row" id="row_1">
                                
                                <td> 
                                        
                                        <?php foreach ($items as $item) { ?>
                                            <?php echo $item['id']; ?>"><?php if(!empty($item['item_code'])) echo $item['item_code']."(". $item['item_name'].")"; ?>
                                        <?php } ?>
                                    </td>
                                <td>
<!--                                    <input style="width:140px;" disabled type="text" id="item_des_c_1"  name="item_name_description[]" class="issue">-->
                                </td>
                                <td><input style="width:60px;" disabled type="text" id="unit_c_1"  name="unit[]" class="issue"></td>
                                
                                 <td><input style="width:60px;" disabled type="text"  name="last_unit_price[]" id="last_unit_price_c_1" class="issue"></td>
                                 <td><input disabled type="text"  name="last_supllier[]" id="last_supllier_c_1" class="issue"></td>
                                
                                <td><input style="width:40px;" disabled type="text" id="stock_qty_c_1" name="stock_qty[]" class="issue"></td>
                                <td><input style="width:40px;" disabled type="text" id="indent_qty_c_1"  name="indent_qty[]" onkeyup="calculateEstvalueConsume(1)" class="issue"></td>

                                <td><input disabled type="hidden" id="unit_price_c_1"  name="unit_price[]" class="issue"><input style="width:80px;" disabled type="text" id="unit_price_c1_1"  name="unit_price[]" class="issue"></td>

                                <td><input style="width:100px;" disabled class="datepicker" type="text"  name="expected_date[]" class="issue"></td>
                                <td> <select disabled style="width:110px;" id="c_c_id" name="c_c_id[]" >
                                    <option value="">Select Cost Center</option>
                                    <?php foreach($cost_centers as $cost_center){ ?>
                                        <option value="<?php echo $cost_center['c_c_id'];  ?>"><?php if(!empty($cost_center['c_c_name'])) echo $cost_center['c_c_name']; ?></option>
                                    <?php } ?>
                                </select></td> 

                            </tr>
                        </tbody>
                    </table>
                 
                        <?php if (!empty($ipo_material_indent_details)) { ?> 
                            <input type="hidden" id="a_count" value="<?php echo count($ipo_material_indent_details); ?>"/>

                            <table class="table table-bordered" id="myTable1">
                                <thead>
                                    <tr class="row">
                                        
                                        <th>Item.Code</th>
                                        <th>Item name & Description</th>
                                        <th>Measurement Unit</th>
                                        
                                        <th>Last Unit Price</th>
                                        <th>Last Supplier</th>
                                        
                                        <th>Stock Qty</th>
                                        <th>Indent Qty</th>
                                        <th>unit Price</th>
                                    <!--    <th>Asset</th>-->
                                        <th>Expected Date</th>
                                        <th>Cost Center</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;
                                    foreach ($ipo_material_indent_details as $ipo_material_indent_detail) {
                                        $i++; ?>  
                                        <tr class="row" id="row_<?php echo $i; ?>">
                                            
                                            <td> <select style="width:100px;" disabled onchange="javascript:item_info(<?php echo $i; ?>);" id="item_a_<?php echo $i; ?>" name="item_id_a[]">
                                                    <option value="">Select Item</option>
                                                    <?php foreach ($items as $item) { ?>
                                                        <option <?php if (!empty($ipo_material_indent_detail['item_id']) && $ipo_material_indent_detail['item_id'] == $item['id']) echo "selected"; ?> value="<?php echo $item['id']; ?>"><?php if(!empty($item['item_code'])) echo $item['item_code']."(". $item['item_name'].")"; ?></option>
                                                     <?php } ?>
                                                </select></td>
                                            <td><input style="width:140px;" disabled type="text" id="item_des_a_<?php echo $i; ?>"  name="item_name_description_a[]" value="<?php if (!empty($ipo_material_indent_detail['item_name_description'])) echo $ipo_material_indent_detail['item_name_description']; ?>" class="issue"></td>
                                            <td><input style="width:60px;" disabled type="text" id="unit_a_<?php echo $i; ?>"  name="unit_a[]" value="<?php if (!empty($ipo_material_indent_detail['unit'])) echo $ipo_material_indent_detail['unit']; ?>" class="issue"></td>
                                            
                                             <td><input style="width:60px;" disabled type="text"  name="last_unit_price_a[]" id="last_unit_price_a_<?php echo $i; ?>" value="<?php if (!empty($ipo_material_indent_detail['last_unit_price'])) echo $ipo_material_indent_detail['last_unit_price']; ?>" class="issue"></td>
                                             <td><input style="width:100px;" disabled type="text"  name="last_supllier_a[]" id="last_supllier_a_<?php echo $i; ?>" value="<?php if (!empty($ipo_material_indent_detail['last_supplier'])) echo $ipo_material_indent_detail['last_supplier']; ?>" class="issue"></td>
                                            
                                            <td><input style="width:40px;" disabled type="text" id="stock_qty_a_<?php echo $i; ?>" name="stock_qty_a[]" value="<?php if (!empty($ipo_material_indent_detail['stock_qty'])) echo $ipo_material_indent_detail['stock_qty']; ?>" class="issue"></td>
                                            <td><input style="width:40px;" disabled type="text" id="indent_qty_a_<?php echo $i; ?>"  name="indent_qty_a[]" value="<?php if (!empty($ipo_material_indent_detail['indent_qty'])) echo $ipo_material_indent_detail['indent_qty']; ?>" onkeyup="calculateEstvalueAsset(<?php echo $i; ?>)" class="issue"></td>

                                            <td><input disabled type="hidden" id="unit_price_a_<?php echo $i; ?>"  name="unit_price_a[]" value="<?php if (!empty($ipo_material_indent_detail['unit_price'])) echo $ipo_material_indent_detail['unit_price']; ?>" class="issue"><input style="width:80px;" disabled type="text" id="unit_price_a1_<?php echo $i; ?>"  name="unit_price_a[]" value="<?php if (!empty($ipo_material_indent_detail['unit_price'])) echo $ipo_material_indent_detail['unit_price']; ?>" class="issue"></td>
                                          <!--
                                            <td> <select id="asset_<?php echo $i; ?>" name="asset_id[]" >
                                                <option value="">Select Asset</option>
                                                <?php foreach($assets as $asset){ ?>
                                                    <option <?php if (!empty($ipo_material_indent_detail['asset_id']) && $ipo_material_indent_detail['asset_id']==$asset['a_id'] ) echo "selected"; ?> value="<?php echo $asset['a_id'];  ?>"><?php if(!empty($asset['product_id'])) echo $asset['product_name']."(". $asset['product_id'].")"; ?></option>
                                                <?php } ?>
                                                </select>
                                            </td>
                                          -->
                                            <td><input style="width:100px;" disabled class="datepicker" type="text"  name="expected_date_a[]" value="<?php if (!empty($ipo_material_indent_detail['expected_date'])) echo date('d-m-Y', strtotime($ipo_material_indent_detail['expected_date'])); ?>" class="issue"></td>
                                            <td><select disabled style="width:110px;" id="c_c_id_<?php echo $i; ?>" name="c_c_id[]" >
                                                        <option value="">Select Cost Center</option>
                                                        <?php foreach($cost_centers as $cost_center){ ?>
                                                            <option <?php if (!empty($ipo_material_indent_detail['c_c_id']) && $ipo_material_indent_detail['c_c_id']==$cost_center['c_c_id'] ) echo "selected"; ?> value="<?php echo $cost_center['c_c_id'];  ?>"><?php if(!empty($cost_center['c_c_name'])) echo $cost_center['c_c_name']; ?></option>
                                                        <?php } ?>
                                           </select></td> 

                                        </tr>
                            <?php } ?>        
                                </tbody>
                            </table>
                        <?php } ?>
                            

                            

                       
     <?php } ?>
        <div class="row" style="margin-bottom: 20px">
  
              <div class="col-md-2">
                        <a href="<?php echo site_url('backend/general_store/ipo_material_indent') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
   
           

        </div>

        <div class="row">
           
        </div>

<!--    </form>-->
</div>
</div>
</div>
</div>
</div>
</div>

<script>
    
    
   function calculateEstvalueConsume(id){
        var last_rate = Number($('#last_unit_price_c_'+id).val());
        var indent_quantity = Number($('#indent_qty_c_'+id).val());
        var est_value=last_rate*indent_quantity;
        $('#unit_price_c_'+id).val(est_value);
        $('#unit_price_c1_'+id).val(est_value);
        
        
    }
    
     function calculateEstvalueAsset(id){
        var last_rate = Number($('#last_unit_price_a_'+id).val());
        var indent_quantity = Number($('#indent_qty_a_'+id).val());
        var est_value=last_rate*indent_quantity;
        $('#unit_price_a_'+id).val(est_value);
        $('#unit_price_a1_'+id).val(est_value);
        
        
    }  
    
    
 function consumable_or_asset(){
//       var item_type=$('#ipo_item_type').val();
//       if(item_type=="Consumable"){
//           $('#myTable').show();
//           $('#myTable1').hide();
//       }else{
//           $('#myTable').hide();
//           $('#myTable1').show();
//       }

    var item_type=$('#ipo_item_type').val();
       var data = {'item_type': item_type}
       if(item_type=="Consumable"){
            $.ajax({
                url: '<?php echo site_url('general_store/item_list'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) { 
                var str = '<option value="0">Select Item</option>';
                 $(msg.item_list).each(function (i, v) {
                  //   alert('test');
                     str += '<option value="' + v.id + '">'+ v.item_name+"("+ v.item_code+")"+ '</option>';
                 });
                 $('#item_c_1').html(str);
                // $('.selectpicker').selectpicker('refresh');
                }
             
            })
           $('#myTable').show();
           $('#myTable1').hide();
       }else{
            $.ajax({
                url: '<?php echo site_url('general_store/item_list'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {
                     var str = '<option value="0">Select Item</option>';
                    $(msg.item_list).each(function (i, v) {
                     //   alert('test');
                        str += '<option value="' + v.id + '">'+ v.item_name+"("+ v.item_code+")"+ '</option>';
                    });
                    $('#item_a_1').html(str);
                   // $('.selectpicker').selectpicker('refresh');
                   }
             
            })
           $('#myTable').hide();
           $('#myTable1').show();
       }

   }     





 function item_info(id) { 
//   alert('test');
       var item_type=$('#ipo_item_type').val();
//        if(id==1 && item_type=="Consumable" ){
//            var itemId = $('#item_c_'+id).val();
//        }else if(id==1 && item_type=="Asset" ){
//            var itemId = $('#item_a_'+id).val();
//        }else{
//            var itemId = $('#item_'+id).val();
//        }

        if(item_type=="Consumable" ){
            var itemId = $('#item_c_'+id).val();
        }else{
            var itemId = $('#item_a_'+id).val();
        }
        
        var data = {'itemId': itemId}
        $.ajax({
            url: '<?php echo site_url('general_store/item_info'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
//                $('#item_des_'+id).val(msg.item_info[0].item_name);
//                $('#unit_'+id).val(msg.item_info[0].meas_unit);
//                $('#stock_qty_'+id).val(msg.item_info[0].stock_amount);
            var item_type=$('#ipo_item_type').val();
            //alert(item_type);

//                if(id==1 && item_type=="Consumable" ){
//                    $('#item_des_c_'+id).val(msg[0].item_name);
//                    $('#unit_c_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_c_'+id).val(msg[0].stock_amount);
//                }else if(id==1 && item_type=="Asset" ){
//                 //   alert(item_type);
//                    $('#item_des_a_'+id).val(msg[0].item_name);
//                    $('#unit_a_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_a_'+id).val(msg[0].stock_amount);
//                }else{    
//                    $('#item_des_'+id).val(msg[0].item_name);
//                    $('#unit_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_'+id).val(msg[0].stock_amount);
//                }
//               if(item_type=="Consumable" ){
//                    $('#item_des_c_'+id).val(msg[0].item_name);
//                    $('#unit_c_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_c_'+id).val(msg[0].stock_amount);
//                }else{        
//                    $('#item_des_a_'+id).val(msg[0].item_name);
//                    $('#unit_a_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_a_'+id).val(msg[0].stock_amount);
//                }

                 if(item_type=="Consumable" ){
                    $('#item_des_c_'+id).val(msg.item_info[0].item_name);
                    $('#item_des_c1_'+id).val(msg.item_info[0].item_name);
                    $('#unit_c_'+id).val(msg.item_info[0].meas_unit);
                    $('#unit_c1_'+id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_c_'+id).val(msg.item_info[0].stock_amount);
                    $('#stock_qty_c1_'+id).val(msg.item_info[0].stock_amount);
                    
                    if(msg.item_previous_info!=''){
                        $('#last_unit_price_c_'+id).val(msg.item_previous_info[0].unit_price);
                        $('#last_unit_price_c1_'+id).val(msg.item_previous_info[0].unit_price);
                        var supplier=msg.item_previous_info[0].NAME+"("+msg.item_previous_info[0].CODE+")";
                    }else{
                        $('#last_unit_price_c_'+id).val('');
                        $('#last_unit_price_c1_'+id).val('');
                        var supplier='';
                    }
                   
                    $('#last_supllier_c_'+id).val(supplier);
                    $('#last_supllier_c1_'+id).val(supplier);
                }else{        
                    $('#item_des_a_'+id).val(msg.item_info[0].item_name);
                    $('#item_des_a1_'+id).val(msg.item_info[0].item_name);
                    $('#unit_a_'+id).val(msg.item_info[0].meas_unit);
                    $('#unit_a1_'+id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_a_'+id).val(msg.item_info[0].stock_amount);
                    $('#stock_qty_a1_'+id).val(msg.item_info[0].stock_amount);
                    
                     if(msg.item_previous_info!=''){
                        $('#last_unit_price_a_'+id).val(msg.item_previous_info[0].unit_price);
                        $('#last_unit_price_a1_'+id).val(msg.item_previous_info[0].unit_price);
                        var supplier=msg.item_previous_info[0].NAME+"("+msg.item_previous_info[0].CODE+")";
                    }else{
                        $('#last_unit_price_a_'+id).val('');
                        $('#last_unit_price_a1_'+id).val('');
                        var supplier='';
                    }
                    
                     $('#last_supllier_a_'+id).val(supplier);
                     $('#last_supllier_a1_'+id).val(supplier);
                
                    
                }
                
            }
        })

    }




function item_info_pre(id) { 
       // var itemId = $('#item_'+id).val();
       var item_type=$('#ipo_item_type').val();
       if(item_type=="Consumable" ){
            var itemId = $('#item_c_'+id).val();
        }else{
            var itemId = $('#item_a_'+id).val();
        }
        var data = {'itemId': itemId}
        $.ajax({
            url: '<?php echo site_url('general_store/item_info'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {          
//                $('#item_des_'+id).val(msg[0].item_name);
//                $('#unit_'+id).val(msg[0].meas_unit);
//                $('#stock_qty_'+id).val(msg[0].stock_amount);
                 var item_type=$('#ipo_item_type').val();
//                 if(item_type=="Consumable" ){
//                    $('#item_des_c_'+id).val(msg[0].item_name);
//                    $('#unit_c_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_c_'+id).val(msg[0].stock_amount);
//                }else{        
//                    $('#item_des_a_'+id).val(msg[0].item_name);
//                    $('#unit_a_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_a_'+id).val(msg[0].stock_amount);
//                }
                
                 if(item_type=="Consumable" ){
                    $('#item_des_c_'+id).val(msg.item_info[0].item_name);
                    $('#unit_c_'+id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_c_'+id).val(msg.item_info[0].stock_amount);
                    
                    if(msg.item_previous_info!=''){
                        $('#last_unit_price_c_'+id).val(msg.item_previous_info[0].unit_price);
                        var supplier=msg.item_previous_info[0].NAME+"("+msg.item_previous_info[0].CODE+")";
                    }else{
                        $('#last_unit_price_c_'+id).val('');
                        var supplier='';
                    }
                   
                    $('#last_supllier_c_'+id).val(supplier);
                }else{        
                    $('#item_des_a_'+id).val(msg.item_info[0].item_name);
                    $('#unit_a_'+id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_a_'+id).val(msg.item_info[0].stock_amount);
                    
                     if(msg.item_previous_info!=''){
                        $('#last_unit_price_a_'+id).val(msg.item_previous_info[0].unit_price);
                        var supplier=msg.item_previous_info[0].NAME+"("+msg.item_previous_info[0].CODE+")";
                    }else{
                        $('#last_unit_price_a_'+id).val('');
                        var supplier='';
                    }
                    
                     $('#last_supllier_a_'+id).val(supplier);
                
                    
                }
                
                
                
            }
        })

    }


    $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr = $('#item_c_1').html();
         var assetstr=$('#asset_c_1').html();
       var str = '<tr class="row" id="row_' + (Number(count) + 1) + '">';
       str += '<td><button id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
      // str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"></td>    <td><input type="text"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
    //  str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_unit_price[]" id="last_unit_price_c_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_supplier[]" id="last_supllier_c_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
        str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="hidden"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description[]" id="item_des_c1_'+(Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit[]" id="unit_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price[]" id="last_unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supplier[]" id="last_supllier_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supplier[]" id="last_supllier_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="hidden"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty[]" id="stock_qty_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueConsume('+(Number(count) + 1)+')" class="issue"></td><td><input type="hidden"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price[]" id="unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_c_'+(Number(count) + 1) + '" class="form-control">'+assetstr+'</select></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
        $('.datepicker').datepicker({
            format: 'DD-MM-YYYY'
        });
//        $('.time').datetimepicker();
//        $('.datepicker').datetimepicker({
//            format: 'DD-MM-YYYY'
//        });                                     
//        $('.monthpicker').datetimepicker({
//            format: 'YYYY-MM'
//        });
        //  $('select.e1').select2();
        $('.chzn-container').remove();
    });
    
    
     $('#button3').click(function () {
        var count = $('#a_count').val();
        var itemstr=$('#item_a_1').html();
       // var assetstr=$('#asset_1').html();
        var assetstr=$('#asset_1').html();
        
        var str= '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str +='<td><button id="button4" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
       // str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"></td>    <td><input type="text"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_'+(Number(count) + 1) + '" class="form-control">'+assetstr+'</select></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
      //  str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_unit_price_a[]" id="last_unit_price_a_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_supllier_a[]" id="last_supllier_a_'+(Number(count) + 1) + '" class="issue"></td>   <td><input type="text"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_'+(Number(count) + 1) + '" class="form-control">'+assetstr+'</select></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
        str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="hidden"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description_a[]" id="item_des_a1_'+(Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_a[]" id="unit_a1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price_a[]" id="last_unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supllier_a[]" id="last_supllier_a1_'+(Number(count) + 1) + '" class="issue"></td>   <td><input type="hidden"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty_a[]" id="stock_qty_a1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueAsset('+(Number(count) + 1)+')" class="issue"></td><td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price_a[]" id="unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
        $('#a_count').val(Number(count) + 1);
        $('#myTable1').append(str);
        $('.datepicker').datepicker({
            format: 'DD-MM-YYYY'
        });    
//        $('.time').datetimepicker();
//        $('.datepicker').datetimepicker({
//            format: 'DD-MM-YYYY'
//        });                                     
//        $('.monthpicker').datetimepicker({
//            format: 'YYYY-MM'
//        });
      //  $('select.e1').select2();
        $('.chzn-container').remove();
    });
    

    function removeRow(row) {
        $('#row_' + row).remove();
    }

    $(document).ready(function () {

        //    $('select.e1').select2();
    });

</script>

