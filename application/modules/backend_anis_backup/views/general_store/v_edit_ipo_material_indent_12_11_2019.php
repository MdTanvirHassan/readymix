<?php
$employee_id = $this->session->userdata('employeeId');
$user_type = $this->session->userdata('user_type');
?>
<style>
 table { table-layout: fixed;margin-top: 20px; }
 table th, table td { overflow: hidden; }
 .table > thead > tr > th {
    padding: 3px;
   
}
 .table > tbody > tr > td{
    padding: 3px;
   
}
 .table > thead > tr > td {
    padding: 3px;
   
}
textarea.form-control {
	height: 34px;
}
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
   <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(2, 7, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'ipo_material_indent') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/ipo_material_indent'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>MATERIAL INDENT  </span>
                    </a>
                </li>
                <?php } ?> 
                <?php $this->role = checkUserPermission(2, 8, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'budget') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/budget'); ?>">
                        <i class="fa fa-cc"></i><br><span>BUDGET</span></a>
                </li>
                
                 <?php $this->role = checkUserPermission(2, 39, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'money_indent') echo 'active'; ?>" href="<?php echo site_url('backend/money_indent'); ?>">
                        <i class="fa fa-cc"></i><br><span>MONEY INDENT</span></a>
                </li>
                <?php } ?>
                
                <?php } ?>
                 <?php $this->role = checkUserPermission(2, 40, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'purchase_quotation') echo 'active'; ?>" href="<?php echo site_url('backend/purchase_quotations'); ?>">
                        <i class="fa fa-cc"></i><br><span>PURCHASE QUOTATION</span></a>
                </li>
                <?php } ?>
                
               
                
                 <?php $this->role = checkUserPermission(2, 41, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'purchase_order') echo 'active'; ?>" href="<?php echo site_url('backend/purchase_orders'); ?>">
                            <i class="fa fa-cc"></i><br><span>PURCHASE ORDER</span></a>
                    </li>
                <?php } ?>
               
            </ul>
        </div>
    </div>
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Materials Indent</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal" method="post" action="<?php echo site_url('general_store/edit_action_ipo_material_indent/' . $ipo_material_indent[0]['ipo_m_id']) ?>">
                            <div class="row"> 
                                <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label">
                                        Indent Number:
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input  class="form-control" id="ipo_number" name="ipo_number" value="<?php if (!empty($ipo_material_indent[0]['ipo_number'])) echo $ipo_material_indent[0]['ipo_number']; ?>" type="hidden">
                                        <input disabled class="form-control" id="inputdefault" name="ipo_number1" value="<?php if (!empty($ipo_material_indent[0]['ipo_number'])) echo $ipo_material_indent[0]['ipo_number']; ?>" type="text">
                                    </div>
                                    
                                    <label for="title" class="col-sm-2 control-label">
                                        Indent Type<sup class="required">*</sup>:
                                    </label> 
                                    <div class="col-sm-4 input-group">

                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <select required class="form-control" id="indent_type" name="indent_type">
                                            <?php foreach ($indent_types as $indent_type) { ?>
                                                <option <?php if($indent_type['id']==$ipo_material_indent[0]['indent_type']) echo 'selected'; ?> value="<?php echo $indent_type['id']; ?>"><?php if (!empty($indent_type['type_name'])) echo $indent_type['type_name']; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                    
                                </div>
                            </div> 


                            <div class="row">
                                <div class='form-group' >

                                    <label for="title" class="col-sm-2 control-label">
                                        Date<span class="required">*</span> :
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                        <input required class="form-control datepicker"  name="date" value="<?php if (!empty($ipo_material_indent[0]['date'])) echo $ipo_material_indent[0]['date']; ?>" type="text">
                                    </div>

                                    <label for="title" class="col-sm-2 control-label">
                                        Project <span class="required">*</span>:
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <?php if ($user_type == 1) { ?>
                                                <select  required class="form-control" name="department_id">
                                                        <option value="">Select Project</option>
                                                        <?php foreach ($departments as $department) { ?>
                                                            <option <?php if (!empty($ipo_material_indent[0]['department_id']) && $ipo_material_indent[0]['department_id'] == $department['d_id']) echo "selected"; ?> value="<?php echo $department['d_id']; ?>"><?php if (!empty($department['dep_code'])) echo $department['dep_description'] . "(" . $department['dep_code'] . ")"; ?></option>
                                                        <?php } ?>
                                                </select>
                                            <?php }else { ?>
                                            <select  required class="form-control" name="department_id">

                                                <?php foreach ($departments as $department) { ?>
                                                    <option <?php if (!empty($ipo_material_indent[0]['department_id']) && $ipo_material_indent[0]['department_id'] == $department['d_id']) echo "selected"; ?> value="<?php echo $department['d_id']; ?>"><?php if (!empty($department['dep_code'])) echo $department['dep_description'] . "(" . $department['dep_code'] . ")"; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php } ?>
                                    </div>
                                    

                                </div>
                            </div>   
                            <div class="row">
                                    <div class='form-group' >
                                        
                                        <div id="item_type" style="display:<?php if($ipo_material_indent[0]['type_name']!="Material") echo 'none'; ?>">
                                                <label for="title" class="col-sm-2 control-label">
                                                    Item Type :
                                                </label>
                                                <div class="col-sm-4 input-group">
                                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                                    <select id="ipo_item_type" class="form-control" name="ipo_item_type" onchange="javascript:consumable_or_asset();"> 
                                                        <option <?php if (!empty($ipo_material_indent[0]['ipo_item_type']) && $ipo_material_indent[0]['ipo_item_type'] == "Consumable") echo "selected"; ?> class="form-control" value="Consumable">Consumable</option>
                                                        <option <?php if (!empty($ipo_material_indent[0]['ipo_item_type']) && $ipo_material_indent[0]['ipo_item_type'] == "Asset") echo "selected"; ?> class="form-control" value="Asset">Asset</option>          
                                                    </select>
                                                </div>
                                        </div>    

                                        <label for="title" class="col-sm-2 control-label">
                                            Remarks :
                                        </label> 
                                        <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input class="form-control" id="inputdefault" name="remarks" value="<?php if (!empty($ipo_material_indent[0]['remarks'])) echo $ipo_material_indent[0]['remarks']; ?>" type="text">
                                            <input class="form-control" id="indent_process_status" name="indent_process_status" type="hidden" value="<?php if (!empty($ipo_material_indent[0]['indent_process_status'])) echo $ipo_material_indent[0]['indent_process_status']; ?>">
                                        </div>


                                    </div>
                            </div>     
                            
                            
                            <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:12px;" id="addItem" type="button" class="btn btn-primary pull-left">Add Item</button>    
                            <?php if($ipo_material_indent[0]['type_name'] == "Material"){ ?>
                                   <?php if ($ipo_material_indent[0]['ipo_item_type'] == "Consumable") { ?>
                                   <?php if (!empty($ipo_material_indent_details)) { ?> 
                                    <input type="hidden" id="count" value="<?php echo count($ipo_material_indent_details); ?>"/>

                                    <table class="table table-bordered" id="myTable">
                                        <thead class="thead-color">
                                            <tr>
                                                <th style="vertical-align: middle;width:4%;text-align: center;">
                                                 <!--   <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" type="button" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   -->
                                                </th>
                                                
                                                
                                      <!-- <th style="vertical-align: middle;width: 19%;text-align: center;">Item.Code <sup>*</sup></th>-->
                                       <th style="vertical-align: middle;width: 20%;text-align: center;">Item name & Description</th>
                                       <th style="vertical-align: middle;width:10%;text-align: center;">Unit</th>
                                       <th style="vertical-align: middle;width:10%;text-align: center;">Size</th>
                                       <th style="vertical-align: middle;width:10%;text-align: center;">Brand</th>
                                       <th style="vertical-align: middle;width: 8%;text-align: center;">Stock Qty</th>
                                       <th style="vertical-align: middle;width:8%;text-align: center;">Indent Qty <sup>*</sup></th>
                                       <th style="vertical-align: middle;width: 10%;text-align: center;">Expected Date <sup>*</sup></th>
                                       <th style="vertical-align: middle;width: 15%;text-align: center;">Asset</th>
                                       <th style="vertical-align: middle;width: 10%;text-align: center;">Cost Center</th>
                                       <th style="vertical-align: middle;width:15%;text-align: center;">Remark</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($ipo_material_indent_details as $ipo_material_indent_detail) {
                                        $i++;
                                        ?>  
                                                <tr id="row_<?php echo $i; ?>">
                                                    <?php if ($i > 1) { ?>
                                                        <td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow('<?php echo $i; ?>')" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-minus"></span></button></td>
                                                    <?php } else { ?>
                                                        <td></td>
                                                    <?php } ?>
                                                  <!--      
                                                    <td> <select class="e1 form-control"  onchange="javascript:item_info(<?php echo $i; ?>);" id="item_c_<?php echo $i; ?>" name="item_id[]">
                                                            <option value="">Select Item</option>
                                                            <?php foreach ($items as $item) { ?>
                                                                <option <?php //if (!empty($ipo_material_indent_detail['item_id']) && $ipo_material_indent_detail['item_id'] == $item['id']) echo "selected"; ?> value="<?php echo $item['id']; ?>"><?php if (!empty($item['item_code'])) echo $item['item_code'] . "(" . $item['item_name'] . ")"; ?></option>
                                                            <?php } ?>
                                                        </select></td>
                                                  -->
                                                    <td>
                                                        <input type="hidden" id="item_id_<?php echo $ipo_material_indent_detail['item_id']; ?>"  name="item_id[]" value="<?php if (!empty($ipo_material_indent_detail['item_id'])) echo $ipo_material_indent_detail['item_id']; ?>" class="issue">
                                                        <input type="hidden" id="item_des_c_<?php echo $ipo_material_indent_detail['item_id']; ?>"  name="item_name_description[]" value="<?php if (!empty($ipo_material_indent_detail['item_name_description'])) echo $ipo_material_indent_detail['item_name_description']; ?>" class="issue">
                                                        <input  disabled type="text" id="item_des_c1_<?php echo $i; ?>"  name="item_name_description[]" value="<?php if (!empty($ipo_material_indent_detail['item_name_description'])) echo $ipo_material_indent_detail['item_name_description']; ?>" class="issue form-control">
                                                    </td>
                                                    <td><input type="hidden" id="unit_c_<?php echo $ipo_material_indent_detail['item_id']; ?>"  name="unit[]" value="<?php if (!empty($ipo_material_indent_detail['unit'])) echo $ipo_material_indent_detail['unit']; ?>" class="issue"><input  disabled type="text" id="unit_c1_<?php echo $i; ?>"  name="unit[]" value="<?php if (!empty($ipo_material_indent_detail['unit'])) echo $ipo_material_indent_detail['unit']; ?>" class="issue form-control"></td>
                                                    <td><input  disabled type="text" id="unit_c1_<?php echo $ipo_material_indent_detail['item_id']; ?>"  name="size[]" value="<?php if (!empty($ipo_material_indent_detail['size'])) echo $ipo_material_indent_detail['size']; ?>" class="issue form-control"></td>
                                                   <td> 
                                                        <select class="e1 form-control"  id="brand_<?php echo $ipo_material_indent_detail['item_id']; ?>" name="brand_id[]" >
                                                            <option value="">Select </option>
                                                            <?php foreach ($ipo_material_indent_detail['item_brands'] as $brand) { ?>
                                                                <option <?php if (!empty($brand['id']) && $ipo_material_indent_detail['brand_id'] == $brand['id']) echo "selected"; ?> value="<?php echo $brand['id']; ?>"><?php if (!empty($brand['brand_name'])) echo $brand['brand_name']; ?></option>
                                                            <?php } ?>
                                                        </select>

                                                    </td>
                                                    <td>
                                                        <input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_<?php echo $i; ?>" value="<?php if (!empty($ipo_material_indent_detail['last_unit_price'])) echo $ipo_material_indent_detail['last_unit_price']; ?>" class="issue">
                                                        <input type="hidden"  name="last_supplier[]" id="last_supllier_c_<?php echo $i; ?>" value="<?php if (!empty($ipo_material_indent_detail['last_supplier'])) echo $ipo_material_indent_detail['last_supplier']; ?>" class="issue">
                                                        <input type="hidden" id="stock_qty_c_<?php echo $i; ?>" name="stock_qty[]" value="<?php if (!empty($ipo_material_indent_detail['stock_qty'])) echo $ipo_material_indent_detail['stock_qty']; ?>" class="issue"><input  disabled type="text" id="stock_qty_c1_<?php echo $i; ?>" name="stock_qty[]" value="<?php if (!empty($ipo_material_indent_detail['stock_qty'])) echo $ipo_material_indent_detail['stock_qty']; ?>" class="issue form-control">
                                                    </td>
                                                    <td>
                                                        <input  type="text" id="indent_qty_c_<?php echo $i; ?>"  name="indent_qty[]" value="<?php if (!empty($ipo_material_indent_detail['indent_qty'])) echo $ipo_material_indent_detail['indent_qty']; ?>" onkeyup="calculateEstvalueConsume(<?php echo $i; ?>)" class="issue form-control">
                                                    </td>

                                                    
                                                    <td>
                                                        <input type="hidden" id="unit_price_c_<?php echo $i; ?>"  name="unit_price[]" value="<?php if (!empty($ipo_material_indent_detail['unit_price'])) echo $ipo_material_indent_detail['unit_price']; ?>" class="issue">
                                                        <input   type="text"  name="expected_date[]" value="<?php if (!empty($ipo_material_indent_detail['expected_date'])) echo date('d-m-Y', strtotime($ipo_material_indent_detail['expected_date'])); ?>" class="issue datepicker1 form-control">
                                                    </td>
                                                    <td> 
                                                        <select class="e1 form-control"  id="asset_c_<?php echo $i; ?>" name="asset_id[]" >
                                                            <option value="">Select Asset</option>
                                                            <?php foreach ($assets as $asset) { ?>
                                                                <option <?php if (!empty($ipo_material_indent_detail['asset_id']) && $ipo_material_indent_detail['asset_id'] == $asset['id']) echo "selected"; ?> value="<?php echo $asset['id']; ?>"><?php if (!empty($asset['item_name'])) echo $asset['item_name'] . "(" . $asset['item_code'] . ")"; ?></option>
                                                            <?php } ?>
                                                        </select>

                                                    </td>
                                                    <td><select class="e1 form-control" id="c_c_id_<?php echo $i; ?>" name="c_c_id[]" >
                                                            <option value="">Select Cost Center</option>
                                                            <?php foreach ($cost_centers as $cost_center) { ?>
                                                                <option <?php if (!empty($ipo_material_indent_detail['c_c_id']) && $ipo_material_indent_detail['c_c_id'] == $cost_center['c_c_id']) echo "selected"; ?> value="<?php echo $cost_center['c_c_id']; ?>"><?php if (!empty($cost_center['c_c_name'])) echo $cost_center['c_c_name']; ?></option>
                                                            <?php } ?>
                                                        </select></td> 

                                                <td>
                                                    <textarea class="form-control" name="remark[]"><?php if (!empty($ipo_material_indent_detail['remark'])) echo $ipo_material_indent_detail['remark']; ?></textarea>
                                                </td>


                                                </tr>
                                            <?php } ?>        
                                        </tbody>
                                    </table>
                                <?php } ?>

                                <table class="table table-bordered" id="myTable1" style="display:none;">
                                    <input type="hidden" id="a_count" value="1"/>
                                    <thead class="thead-color">
                                        <tr>
                                            <th style="vertical-align: middle;width:4%;text-align: center;">
                                                <button style="margin-left:px;padding-left:6px;padding-right:6px;font-size:8px;" type="button" id="button3" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                                            </th>
                                            
                                       <th style="vertical-align: middle;width: 19%;text-align: center;">Item.Code <sup>*</sup></th>
                                       <th style="vertical-align: middle;width: 10%;text-align: center;">Item name & Description</th>
                                       <th style="vertical-align: middle;width:10%;text-align: center;">Unit</th>
                                       <th style="vertical-align: middle;width: 8%;text-align: center;">Stock Qty</th>
                                        <th style="vertical-align: middle;width:8%;text-align: center;">Indent Qty <sup>*</sup></th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Expected Date <sup>*</sup></th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Cost Center</th>
                                        <th style="vertical-align: middle;width:15%;text-align: center;">Remark</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr id="row_1">
                                            <td></td>
                                            <td> <select class="e1 form-control"  onchange="javascript:item_info(1);" id="item_a_1" name="item_id_a[]">
                                                    <option value="">Select Item</option>
                                                    <?php foreach ($items as $item) { ?>
                                                        <option value="<?php echo $item['id']; ?>"><?php if (!empty($item['item_code'])) echo $item['item_code'] . "(" . $item['item_name'] . ")"; ?></option>
                                                    <?php } ?>
                                                </select></td>
                                            <td><input type="text" id="item_des_a_1"  name="item_name_description_a[]" class="issue form-control"></td>
                                            <td><input type="text" id="unit_a_1"  name="unit_a[]" class="issue form-control"></td>

                                           
                                           
                                            <td>
                                                <input  type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_1" class="issue">
                                                <input style="width:100px;" type="hidden"  name="last_supllier_a[]" id="last_supllier_a_1" class="issue">
                                                <input  type="text" id="stock_qty_a_1" name="stock_qty_a[]" class="issue form-control">
                                            </td>
                                            <td><input type="text" id="indent_qty_a_1"  name="indent_qty_a[]" onkeyup="calculateEstvalueAsset(1)" class="issue form-control"></td>

                                           
                                            <td>
                                                <input type="hidden" id="unit_price_a_1"  name="unit_price_a[]" class="issue">
                                                <input  type="text"  name="expected_date_a[]" class="issue datepicker1 form-control">
                                            </td>
                                            <td> <select class="e1 form-control"  id="c_c_id" name="c_c_id[]" >
                                                    <option value="">Select Cost Center</option>
                                                    <?php foreach ($cost_centers as $cost_center) { ?>
                                                        <option value="<?php echo $cost_center['c_c_id']; ?>"><?php if (!empty($cost_center['c_c_name'])) echo $cost_center['c_c_name']; ?></option>
                                                    <?php } ?>
                                                </select></td> 
                                                
                                             <td>
                                                 <textarea class="form-control" name="a_remark[]"></textarea>
                                             </td>   
                                        </tr>
                                    </tbody>
                                </table>



                            <?php }else { ?>  

                                <table class="table table-bordered" id="myTable" style="display:none;">
                                    <input type="hidden" id="count" value="1"/>
                                    <thead class="thead-color">
                                        
                                        <tr>
                                            <th style="vertical-align: middle;width:4%;text-align: center;">
                                                <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" type="button" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                                            </th>
                                            
                                       <th style="vertical-align: middle;width: 19%;text-align: center;">Item.Code <sup>*</sup></th>
                                       <th style="vertical-align: middle;width: 10%;text-align: center;">Item name & Description</th>
                                       <th style="vertical-align: middle;width:10%;text-align: center;">Unit</th>
                                       <th style="vertical-align: middle;width: 8%;text-align: center;">Stock Qty</th>
                                        <th style="vertical-align: middle;width:8%;text-align: center;">Indent Qty <sup>*</sup></th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Expected Date <sup>*</sup></th>
                                        <th style="vertical-align: middle;width: 15%;text-align: center;">Asset</th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Cost Center</th>
                                        <th style="vertical-align: middle;width:15%;text-align: center;">Remark</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr  id="row_1">
                                            <td></td>
                                            <td> <select class="e1 form-control"  onchange="javascript:item_info(1);" id="item_c_1" name="item_id[]">
                                                    <option value="">Select Item</option>
                                                    <?php foreach ($items as $item) { ?>
                                                        <option value="<?php echo $item['id']; ?>"><?php if (!empty($item['item_code'])) echo $item['item_code'] . "(" . $item['item_name'] . ")"; ?></option>
                                                    <?php } ?>
                                                </select></td>
                                            <td><input  type="text" id="item_des_c_1"  name="item_name_description[]" class="issue form-control"></td>
                                            <td><input  type="text" id="unit_c_1"  name="unit[]" class="issue form-control"></td>

                                            
                                         

                                            <td>
                                                <input  type="hidden"  name="last_unit_price[]" id="last_unit_price_c_1" class="issue form-control">
                                                <input  type="hidden"  name="last_supllier[]" id="last_supllier_c_1" class="issue form-control">
                                                <input  type="text" id="stock_qty_c_1" name="stock_qty[]" class="issue form-control">
                                            </td>
                                            <td><input   type="text" id="indent_qty_c_1"  name="indent_qty[]" onkeyup="calculateEstvalueConsume(1)" class="issue form-control"></td>

                                         
                                            <td>
                                                <input type="hidden" id="unit_price_c_1"  name="unit_price[]" class="issue">
                                                <input   type="text"  name="expected_date[]" class="issue datepicker1 form-control">
                                            </td>
                                            <td>
                                                <select class="e1 form-control"  id="asset_c_1" name="asset_id[]" >
                                                            <option value="">Select Asset</option>
                                                            <?php foreach ($assets as $asset) { ?>
                                                                <option <?php if (!empty($ipo_material_indent_detail['asset_id']) && $ipo_material_indent_detail['asset_id'] == $asset['id']) echo "selected"; ?> value="<?php echo $asset['id']; ?>"><?php if (!empty($asset['item_name'])) echo $asset['item_name'] . "(" . $asset['item_code'] . ")"; ?></option>
                                                            <?php } ?>
                                                        </select>
                                            </td>
                                            <td> <select class="e1 form-control"  id="c_c_id" name="c_c_id[]" >
                                                    <option value="">Select Cost Center</option>
                                                    <?php foreach ($cost_centers as $cost_center) { ?>
                                                        <option value="<?php echo $cost_center['c_c_id']; ?>"><?php if (!empty($cost_center['c_c_name'])) echo $cost_center['c_c_name']; ?></option>
                                                    <?php } ?>
                                                </select></td> 

                                        
                                        <td>
                                            <textarea class="form-control" name="remark[]"></textarea>
                                         </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <?php if (!empty($ipo_material_indent_details)) { ?> 
                                    <input type="hidden" id="a_count" value="<?php echo count($ipo_material_indent_details); ?>"/>

                                    <table class="table table-bordered" id="myTable1">
                                        <thead class="thead-color">
                                            <tr>
                                                <th style="vertical-align: middle;width: 4%;text-align: center;">
                                                    <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;"  type="button" id="button3" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                                                </th>
                                                
                                                <th style="vertical-align: middle;width: 19%;text-align: center;">Item.Code <sup>*</sup></th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Item name & Description</th>
                                        <th style="vertical-align: middle;width:10%;text-align: center;">Unit</th>
                                       <th style="vertical-align: middle;width: 8%;text-align: center;">Stock Qty</th>
                                        <th style="vertical-align: middle;width:8%;text-align: center;">Indent Qty <sup>*</sup></th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Expected Date <sup>*</sup></th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Cost Center</th>
                                        <th style="vertical-align: middle;width:15%;text-align: center;">Remark</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($ipo_material_indent_details as $ipo_material_indent_detail) {
                                                $i++;
                                                ?>  
                                                <tr id="row_<?php echo $i; ?>">
                                                    <?php if ($i > 1) { ?>
                                                        <td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button4" onclick="removeRow('<?php echo $i; ?>')" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-minus"></span></button></td>
                                                    <?php } else { ?>
                                                        <td></td>
                                                            <?php } ?>
                                                        <td> <select class="form-control" onchange="javascript:item_info(<?php echo $i; ?>);" id="item_a_<?php echo $i; ?>" name="item_id_a[]">
                                                            <option value="">Select Item</option>
                                                            <?php foreach ($items as $item) { ?>
                                                                <option <?php if (!empty($ipo_material_indent_detail['item_id']) && $ipo_material_indent_detail['item_id'] == $item['id']) echo "selected"; ?> value="<?php echo $item['id']; ?>"><?php if (!empty($item['item_code'])) echo $item['item_code'] . "(" . $item['item_name'] . ")"; ?></option>
                                                            <?php } ?>
                                                        </select></td>
                                                    <td><input type="text" id="item_des_a_<?php echo $i; ?>"  name="item_name_description_a[]" value="<?php if (!empty($ipo_material_indent_detail['item_name_description'])) echo $ipo_material_indent_detail['item_name_description']; ?>" class="issue form-control"></td>
                                                    <td><input style="width:60px;"  type="text" id="unit_a_<?php echo $i; ?>"  name="unit_a[]" value="<?php if (!empty($ipo_material_indent_detail['unit'])) echo $ipo_material_indent_detail['unit']; ?>" class="issue form-control"></td>

                                                   
                                                    <td>
                                                        <input  type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_<?php echo $i; ?>" value="<?php if (!empty($ipo_material_indent_detail['last_unit_price'])) echo $ipo_material_indent_detail['last_unit_price']; ?>" class="issue form-control">
                                                        <input  type="hidden"  name="last_supllier_a[]" id="last_supllier_a_<?php echo $i; ?>" value="<?php if (!empty($ipo_material_indent_detail['last_supplier'])) echo $ipo_material_indent_detail['last_supplier']; ?>" class="issue form-control">
                                                        <input  type="text" id="stock_qty_a_<?php echo $i; ?>" name="stock_qty_a[]" value="<?php if (!empty($ipo_material_indent_detail['stock_qty'])) echo $ipo_material_indent_detail['stock_qty']; ?>" class="issue form-control">
                                                    </td>
                                                    <td><input   type="text" id="indent_qty_a_<?php echo $i; ?>"  name="indent_qty_a[]" value="<?php if (!empty($ipo_material_indent_detail['indent_qty'])) echo $ipo_material_indent_detail['indent_qty']; ?>" onkeyup="calculateEstvalueAsset(<?php echo $i; ?>)" class="issue form-control"></td>

                                                    <td>
                                                        <input type="hidden" id="unit_price_a_<?php echo $i; ?>"  name="unit_price_a[]" value="<?php if (!empty($ipo_material_indent_detail['unit_price'])) echo $ipo_material_indent_detail['unit_price']; ?>" class="issue form-control">
                                                        <input   type="text"  name="expected_date_a[]" value="<?php if (!empty($ipo_material_indent_detail['expected_date'])) echo date('d-m-Y', strtotime($ipo_material_indent_detail['expected_date'])); ?>" class="issue datepicker1 form-control">
                                                    </td>
                                                    <td><select class="form-control" id="c_c_id_<?php echo $i; ?>" name="c_c_id[]" >
                                                            <option value="">Select Cost Center</option>
                                                            <?php foreach ($cost_centers as $cost_center) { ?>
                                                                <option <?php if (!empty($ipo_material_indent_detail['c_c_id']) && $ipo_material_indent_detail['c_c_id'] == $cost_center['c_c_id']) echo "selected"; ?> value="<?php echo $cost_center['c_c_id']; ?>"><?php if (!empty($cost_center['c_c_name'])) echo $cost_center['c_c_name']; ?></option>
                                                            <?php } ?>
                                                        </select></td> 
                                                <td>
                                                    <textarea class="form-control" name="a_remark[]"><?php if (!empty($ipo_material_indent_detail['remark'])) echo $ipo_material_indent_detail['remark']; ?></textarea>
                                                </td>

                                                </tr>
                                    <?php } ?>        
                                        </tbody>
                                    </table>
    <?php } ?>





<?php } ?>
          <?php }else{ ?> 
                                     <table class="table table-bordered" id="serviceTable" style="">
                                        <thead>
                                            <tr class="thead-color">
                                                <th>
                                                    <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" id="serviceButton" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                                                </th>
                                                <th>Service<sup>*</sup></th>
                                                <th>Expected Date<sup>*</sup></th>
                                                <th>Remark</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($ipo_material_indent_details as $ipo_material_indent_detail) {
                                        $i++;
                                        ?>  
                                            <tr class="" id="row_<?php echo $i; ?>">
                                                <td></td>
                                                <td> <select style="width:200px;" class="e1" id="service" name="service_id[]" >
                                                        <option value="">Select Service</option>
                                                        <?php foreach ($services as $service) { ?>
                                                            <option <?php if($service['id']==$ipo_material_indent_detail['service_id']) echo 'selected'; ?> value="<?php echo $service['id']; ?>"><?php if (!empty($service['service_name'])) echo $service['service_name']; ?></option>
                                                        <?php } ?>
                                                    </select></td>

                                                <td><input style="width:200px;"  type="text"  name="expected_date_s[]" class="issue datepicker1" value="<?php if (!empty($ipo_material_indent_detail['expected_date'])) echo $ipo_material_indent_detail['expected_date']; ?>"></td>
                                                <td>
                                                    <textarea style="width:200px;" name="s_remark[]"><?php if (!empty($ipo_material_indent_detail['remark'])) echo $ipo_material_indent_detail['remark']; ?></textarea>
                                                </td>


                                            </tr>
                                    <?php } ?>        
                                        </tbody>
                                    </table>
                  <?php } ?>        
                            <div class="row" style="margin-bottom: 20px">
                                
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/general_store/ipo_material_indent') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                                </div>
                                
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary button">UPDATE</button>
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
    
    <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add Item</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12 M-row">
                                        <div class="col-md-6">
                                            <label>Select Category</label>
                                            <select required="" name="category" id="category" onchange="getGroup()"class=" form-control" required="">
                                                <option value="">Select Category</option>
                                                <?php foreach($categories as $category){ ?>
                                                    <option value="<?php echo $category['id'] ?>"><?php echo $category['item_group'] ?></option>
                                                <?php } ?>
                                                
                                             </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Select Group</label>

                                            <select required="" name="group" id="group" class=" form-control" onchange="getItem()" required="">
                                                <option value="">Select Group</option>
                                              
                                            </select>
                                        </div>
                                        
                                        
                                      <table class="table table-bordered"  style="margin-top:75px;">
                                            <thead class="thead-color">
                                                <tr>
                                                    
                                                    <th style="vertical-align: middle;text-align: center">Item Name</th>
                                                    <th style="vertical-align: middle;text-align: center">Unit</th>
                                                    <th style="vertical-align: middle;text-align: center">Grade</th>
                                                    <th style="vertical-align: middle;text-align: center">Size</th>
                                                    <th style="vertical-align: middle;text-align: center">Select</th>

                                                </tr>
                                            </thead>
                                            <tbody id="item">

                                           
                                            </tbody>
                                        </table>  
                                        
                                        
                                    </div>
                                    
                                   
                                   
                                    
                                    <div class="clearfix"></div>
                                    
                                   
                                   
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>                              
                                </div>
                            </div>
                            
                        </div>
                    </div>  
    
    
</div>

<script>

 $('#addItem').click(function (){
      $('#myModal').modal('show');
 });
    
    
 function getGroup(){
        var category_id=$('#category').val();
        if(category_id!=''){
            $.ajax({
                url: '<?php echo site_url('general_store/getGroup'); ?>',
                data: {'category_id':category_id},
                method: 'POST',
                dataType: 'json',
                success: function (msg) {
                    var str = '<option value="">Select Group</option>';
                    $(msg.group_list).each(function (i, v) {
                        //   alert('test');
                        str += '<option value="'+v.c_id+'">'+v.c_name+'</option>';
                    });
                    $('#group').html(str);
                   
                }
            } )
        }else{
            $('#group').html('');
        }    
    }
    
    
      function getItem(){
        var group_id=$('#group').val();
        if(group_id!=''){
            $.ajax({
                url: '<?php echo site_url('general_store/group_item_list'); ?>',
                data: {'group_id':group_id},
                method: 'POST',
                dataType: 'json',
                success: function (msg) {
                    var str ='';
                    $(msg.item_list).each(function (i, v) {  
                        str += '<tr>';
                        str +='<td><input id="item_id_'+v.id+'"  type="hidden" value="'+v.id+'"  /><input id="code_'+v.id+'"  type="hidden" value="'+v.item_code+'"  /><input id="stock_'+v.id+'"  type="hidden" value="'+v.stock_qty+'"  /><input id="item_description_'+v.id+'"  type="hidden" value="'+v.item_description+'"  />'+v.item_name+'</td>';
                        str +='<td><input id="mu_'+v.id+'"  type="hidden" value="'+v.meas_unit+'"  />'+v.meas_unit+'</td>';
                        str +='<td><input id="grade_'+v.id+'"  type="hidden" value="'+v.item_grade+'"  />'+v.item_grade+'</td>';
                        str +='<td><input id="size_'+v.id+'"  type="hidden" value="'+v.size+'"  />'+v.size+'</td>';
                        str +='<td><input id="select_'+v.id+'" onclick="addItem(' + v.id + ')" style="text-align:center;" type="checkbox" /></td>'
                        str +='</tr>';
                    });
                    $('#item').html(str);
                   
                }
            } )
        }else{
            $('#item').html('');
        }    
    }
    
    
    function addItem(item_id){
        var count = $('#count').val();
//        var itemstr = $('#item_c_1').html();
//        var assetstr = $('#asset_c_1').html();
//        var costcentertstr = $('#c_c_id').html();
         
        if($('#select_'+item_id).prop('checked')){
            var code=$('#code_'+item_id).val();
            var item_description=$('#item_description_'+item_id).val();
            var mu=$('#mu_'+item_id).val();
            var size=$('#size_'+item_id).val();
            var stock=$('#stock_'+item_id).val();
             $.ajax({
                url: '<?php echo site_url('general_store/get_brand'); ?>',
                data: {'item_id':item_id},
                method: 'POST',
                dataType: 'json',
                success: function (msg) {
                    var br=''
                    br +='<option value="">Select</option>';
                    $.each( msg.brands, function( key, v ) {
                        br +='<option value="'+v.id+'">'+v.brand_name+'</option>';
                    });
                 
                    var assetstr=''
                    assetstr +='<option value="">Select</option>';
                    $(msg.assets).each(function (j, w) {
                        assetstr +='<option value="'+w.id+'">'+w.item_name+'('+w.item_code+')'+'</option>';
                    });
                    
                    var costcentertstr=''
                    costcentertstr +='<option value="">Select</option>';
                    $(msg.costcenters).each(function (k,x) {
                        costcentertstr +='<option value="'+x.c_c_id+'">'+x.c_c_name+'</option>';
                    });
                    
                    var str ='';
                    var str = '<tr id="row_'+item_id+'">';
                    str += '<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' +item_id+ ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
                    //  str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="hidden"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description[]" id="item_des_c1_'+(Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit[]" id="unit_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price[]" id="last_unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supplier[]" id="last_supllier_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supplier[]" id="last_supllier_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="hidden"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty[]" id="stock_qty_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueConsume('+(Number(count) + 1)+')" class="issue"></td><td><input type="hidden"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price[]" id="unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_c_'+(Number(count) + 1) + '" class="form-control">'+assetstr+'</select></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
                  //  str += '<td><input disabled type="text"  name="item_name_description[]" id="item_des_c1_' +item_id+ '" class="issue form-control" value="'+code+'"></td>';   
                    str += '<td><input type="hidden"  name="item_id[]" id="item_c_' +item_id+ '" class="issue" value="'+item_id+'"><input type="hidden"  name="item_name_description[]" id="item_des_c_' +item_id+ '" class="issue" value="'+item_description+'"><input disabled type="text"  name="item_name_description[]" id="item_des_c1_' +item_id+ '" class="issue form-control" value="'+item_description+'"></td>';
                    str += '<td><input type="hidden"  name="unit[]" id="unit_c_' +item_id+ '" class="issue" value="'+mu+'"><input style="width:100%;" disabled type="text"  name="unit[]" id="unit_c1_' +item_id+ '" class="issue form-control" value="'+mu+'"></td> ';
                    str += '<td><input type="hidden"  name="size[]" id="unit_c_' +item_id+ '" class="issue" value="'+size+'"><input style="width:100%;" disabled type="text"  name="size[]" id="unit_c1_' +item_id+ '" class="issue form-control" value="'+size+'"></td> ';
                    str += '<td><select required class="e1 form-control" style="width:100%;" name="brand_id[]" id="brand_' +item_id+ '" class="">'+br+'</select></td>';
                    str += '<td>';
                    str += '<input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_' +item_id+ '" class="issue">';
                    str += '<input type="hidden"  name="last_supplier[]" id="last_supllier_c_' +item_id+ '" class="issue">';
                    str += '<input type="hidden"  name="stock_qty[]" id="stock_qty_c_' +item_id+ '" class="issue" value="'+stock+'" ><input style="width:100%;" disabled type="text"  name="stock_qty[]" id="stock_qty_c1_' +item_id+ '" class="issue form-control" value="'+stock+'" >';
                    str += '</td>';
                    str += '<td><input  type="hidden"  name="unit_price[]" id="unit_price_c_' +item_id+ '" class="issue"><input required style="width:100%;" type="text"  name="indent_qty[]" id="indent_qty_c_' +item_id+ '" onkeyup="calculateEstvalueConsume(' +item_id+ ')" class="issue form-control"></td>';
                    str += '<td><input style="width:100%;"  type="text"  name="expected_date[]" class="issue datepicker1 form-control"></td>';
                    str += '<td><select class="e1 form-control" style="width:100%;" name="asset_id[]" id="asset_c_' +item_id+ '" class="">' + assetstr + '</select></td>';
                    str += '<td><select class="e1 form-control" style="width:100%;" name="c_c_id[]" id="c_c_id_' +item_id+ '" class="">' + costcentertstr + '</select></td>';
                     str += '<td><textarea class="form-control" style="width:100%;height:34px;" name="remark[]"></textarea></td>';
                    str += '</tr>';



                    $('#count').val(Number(count) + 1);
                    $('#myTable').append(str);
                    $('.datepicker1').datepicker({
                        dateFormat: 'dd-mm-yy',

                    });

                    $('select.e1').select2();
                    $('.chzn-container').remove();
                   
                }
            } )
            
            

            
       }else{
          $('#row_'+item_id).remove(); 
       }    
    }






$('#indent_type').change(function(){
        //alert('test');
        var indent_type=$('#indent_type :selected').text();
       // alert(indent_type);
        if(indent_type=="Service"){
             $('#item_type').hide();
            $('#serviceTable').show();
            $('#myTable').hide();
            $('#myTable1').hide();
            
        }else{
           $('#item_type').show();
            $('#myTable').show();
            $('#myTable1').hide();
            $('#serviceTable').hide();
        }
       
    });


    function calculateEstvalueConsume(id) {
        var last_rate = Number($('#last_unit_price_c_' + id).val());
        var indent_quantity = Number($('#indent_qty_c_' + id).val());
        var stock_quantity = Number($('#stock_qty_c_' + id).val());
        var est_value = last_rate * indent_quantity;
        $('#unit_price_c_' + id).val(est_value);
        $('#unit_price_c1_' + id).val(est_value);
//        if(indent_quantity>stock_quantity){
//             $('#indent_process_status').val('applied');
//        }else{
//            $('#indent_process_status').val('processed');
//        }

    }

    function calculateEstvalueAsset(id) {
        var last_rate = Number($('#last_unit_price_a_' + id).val());
        var indent_quantity = Number($('#indent_qty_a_' + id).val());
        var est_value = last_rate * indent_quantity;
        $('#unit_price_a_' + id).val(est_value);
        $('#unit_price_a1_' + id).val(est_value);


    }


    function consumable_or_asset() {
//       var item_type=$('#ipo_item_type').val();
//       if(item_type=="Consumable"){
//           $('#myTable').show();
//           $('#myTable1').hide();
//       }else{
//           $('#myTable').hide();
//           $('#myTable1').show();
//       }

        var item_type = $('#ipo_item_type').val();
        var data = {'item_type': item_type}
        if (item_type == "Consumable") {
            $.ajax({
                url: '<?php echo site_url('general_store/item_list'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {
                    var str = '<option value="0">Select Item</option>';
                    $(msg.item_list).each(function (i, v) {
                        //   alert('test');
                        str += '<option value="' + v.id + '">' + v.item_name + "(" + v.item_code + ")" + '</option>';
                    });
                    $('#item_c_1').html(str);
                    // $('.selectpicker').selectpicker('refresh');
                }

            })
            $('#myTable').show();
            $('#myTable1').hide();
        } else {
            $.ajax({
                url: '<?php echo site_url('general_store/item_list'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {
                    var str = '<option value="0">Select Item</option>';
                    $(msg.item_list).each(function (i, v) {
                        //   alert('test');
                        str += '<option value="' + v.id + '">' + v.item_name + "(" + v.item_code + ")" + '</option>';
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
        var item_type = $('#ipo_item_type').val();
//        if(id==1 && item_type=="Consumable" ){
//            var itemId = $('#item_c_'+id).val();
//        }else if(id==1 && item_type=="Asset" ){
//            var itemId = $('#item_a_'+id).val();
//        }else{
//            var itemId = $('#item_'+id).val();
//        }

        if (item_type == "Consumable") {
            var itemId = $('#item_c_' + id).val();
        } else {
            var itemId = $('#item_a_' + id).val();
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
                var item_type = $('#ipo_item_type').val();
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

                if (item_type == "Consumable") {
                    var item_description = msg.item_info[0].item_name + "," + msg.item_info[0].port_no + "," + msg.item_info[0].brand;
                    $('#item_des_c_' + id).val(item_description);
                    $('#item_des_c1_' + id).val(item_description);
                    $('#unit_c_' + id).val(msg.item_info[0].meas_unit);
                    $('#unit_c1_' + id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_c_' + id).val(msg.item_info[0].stock_amount);
                    $('#stock_qty_c1_' + id).val(msg.item_info[0].stock_amount);

                    if (msg.item_previous_info != '') {
                        $('#last_unit_price_c_' + id).val(msg.item_previous_info[0].unit_price);
                        $('#last_unit_price_c1_' + id).val(msg.item_previous_info[0].unit_price);
                        var supplier = msg.item_previous_info[0].SUP_NAME + "(" + msg.item_previous_info[0].CODE + ")";
                    } else {
                        $('#last_unit_price_c_' + id).val('');
                        $('#last_unit_price_c1_' + id).val('');
                        var supplier = '';
                    }

                    $('#last_supllier_c_' + id).val(supplier);
                    $('#last_supllier_c1_' + id).val(supplier);
                } else {
                    var item_description = msg.item_info[0].item_name + "," + msg.item_info[0].port_no + "," + msg.item_info[0].brand;
                    $('#item_des_a_' + id).val(item_description);
                    $('#item_des_a1_' + id).val(item_description);
                    $('#unit_a_' + id).val(msg.item_info[0].meas_unit);
                    $('#unit_a1_' + id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_a_' + id).val(msg.item_info[0].stock_amount);
                    $('#stock_qty_a1_' + id).val(msg.item_info[0].stock_amount);

                    if (msg.item_previous_info != '') {
                        $('#last_unit_price_a_' + id).val(msg.item_previous_info[0].unit_price);
                        $('#last_unit_price_a1_' + id).val(msg.item_previous_info[0].unit_price);
                        var supplier = msg.item_previous_info[0].SUP_NAME + "(" + msg.item_previous_info[0].CODE + ")";
                    } else {
                        $('#last_unit_price_a_' + id).val('');
                        $('#last_unit_price_a1_' + id).val('');
                        var supplier = '';
                    }

                    $('#last_supllier_a_' + id).val(supplier);
                    $('#last_supllier_a1_' + id).val(supplier);


                }

            }
        })

    }




    function item_info_pre(id) {
        // var itemId = $('#item_'+id).val();
        var item_type = $('#ipo_item_type').val();
        if (item_type == "Consumable") {
            var itemId = $('#item_c_' + id).val();
        } else {
            var itemId = $('#item_a_' + id).val();
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
                var item_type = $('#ipo_item_type').val();
//                 if(item_type=="Consumable" ){
//                    $('#item_des_c_'+id).val(msg[0].item_name);
//                    $('#unit_c_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_c_'+id).val(msg[0].stock_amount);
//                }else{        
//                    $('#item_des_a_'+id).val(msg[0].item_name);
//                    $('#unit_a_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_a_'+id).val(msg[0].stock_amount);
//                }

                if (item_type == "Consumable") {
                    $('#item_des_c_' + id).val(msg.item_info[0].item_name);
                    $('#unit_c_' + id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_c_' + id).val(msg.item_info[0].stock_amount);

                    if (msg.item_previous_info != '') {
                        $('#last_unit_price_c_' + id).val(msg.item_previous_info[0].unit_price);
                        var supplier = msg.item_previous_info[0].NAME + "(" + msg.item_previous_info[0].CODE + ")";
                    } else {
                        $('#last_unit_price_c_' + id).val('');
                        var supplier = '';
                    }

                    $('#last_supllier_c_' + id).val(supplier);
                } else {
                    $('#item_des_a_' + id).val(msg.item_info[0].item_name);
                    $('#unit_a_' + id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_a_' + id).val(msg.item_info[0].stock_amount);

                    if (msg.item_previous_info != '') {
                        $('#last_unit_price_a_' + id).val(msg.item_previous_info[0].unit_price);
                        var supplier = msg.item_previous_info[0].NAME + "(" + msg.item_previous_info[0].CODE + ")";
                    } else {
                        $('#last_unit_price_a_' + id).val('');
                        var supplier = '';
                    }

                    $('#last_supllier_a_' + id).val(supplier);


                }



            }
        })

    }


    $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr = $('#item_c_1').html();
        var assetstr = $('#asset_c_1').html();
        var costcentertstr = $('#c_c_id').html();
        var str = '<tr  id="row_' + (Number(count) + 1) + '">';
        str += '<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        // str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"></td>    <td><input type="text"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
        //  str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_unit_price[]" id="last_unit_price_c_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_supplier[]" id="last_supllier_c_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
        //     str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="hidden"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description[]" id="item_des_c1_'+(Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit[]" id="unit_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price[]" id="last_unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supplier[]" id="last_supllier_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supplier[]" id="last_supllier_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="hidden"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty[]" id="stock_qty_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueConsume('+(Number(count) + 1)+')" class="issue"></td><td><input type="hidden"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price[]" id="unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_c_'+(Number(count) + 1) + '" class="form-control">'+assetstr+'</select></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
        str += '<td><select class="e1 form-control" style="width:100%;" onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_' + (Number(count) + 1) + '" class="form-control">' + itemstr + '</select></td>';
        str += '<td><input type="hidden"  name="item_name_description[]" id="item_des_c_' + (Number(count) + 1) + '" class="issue"><input  disabled type="text"  name="item_name_description[]" id="item_des_c1_' + (Number(count) + 1) + '" class="issue form-control"></td>';
        str += '<td><input type="hidden"  name="unit[]" id="unit_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit[]" id="unit_c1_' + (Number(count) + 1) + '" class="issue form-control"></td> ';
        //str += '<td><input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price[]" id="last_unit_price_c1_' + (Number(count) + 1) + '" class="issue form-control"></td>';
        //str += '<td><input type="hidden"  name="last_supplier[]" id="last_supllier_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supplier[]" id="last_supllier_c1_' + (Number(count) + 1) + '" class="issue form-control"></td>';
        str += '<td><input type="hidden"  name="stock_qty[]" id="stock_qty_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty[]" id="stock_qty_c1_' + (Number(count) + 1) + '" class="issue form-control"></td>';
        str += '<td><input required  type="text"  name="indent_qty[]" id="indent_qty_c_' + (Number(count) + 1) + '" onkeyup="calculateEstvalueConsume(' + (Number(count) + 1) + ')" class="issue form-control"></td>';
        //str += '<td><input  type="hidden"  name="unit_price[]" id="unit_price_c_' + (Number(count) + 1) + '" class="issue"><input style="width:80px;" disabled type="text"  name="unit_price[]" id="unit_price_c1_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input style="width:100px;"  type="text"  name="expected_date[]" class="issue datepicker1 form-control hasDatepicker"></td>';
        str += '<td><select class="e1 form-control" style="width:100%;" name="asset_id[]" id="asset_c_' + (Number(count) + 1) + '" class="form-control">' + assetstr + '</select></td>';
        str += '<td><select class="e1 form-control" style="width:100%;" name="c_c_id[]" id="c_c_id_' + (Number(count) + 1) + '" class="form-control">' + costcentertstr + '</select></td>';
        str += '<td><textarea class="form-control" name="remark[]"></textarea></td>';
        str += '</tr>';
        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
        $('.datepicker1').datepicker({
            //  format: 'DD-MM-YYYY'
            dateFormat: 'dd-mm-yy',
            //maxDate: new Date
        });
//        $('.time').datetimepicker();
//        $('.datepicker').datetimepicker({
//            format: 'DD-MM-YYYY'
//        });                                     
//        $('.monthpicker').datetimepicker({
//            format: 'YYYY-MM'
//        });
        $('select.e1').select2();
        $('.chzn-container').remove();
    });


    $('#button3').click(function () {
        var count = $('#a_count').val();
        var itemstr = $('#item_a_1').html();
        // var assetstr=$('#asset_1').html();
        var assetstr = $('#asset_1').html();
     var costcentertstr = $('#c_c_id').html();
        var str = '<tr id="row_' + (Number(count) + 1) + '">';
        str += '<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button4" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        // str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"></td>    <td><input type="text"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_'+(Number(count) + 1) + '" class="form-control">'+assetstr+'</select></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
        //  str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_unit_price_a[]" id="last_unit_price_a_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_supllier_a[]" id="last_supllier_a_'+(Number(count) + 1) + '" class="issue"></td>   <td><input type="text"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_'+(Number(count) + 1) + '" class="form-control">'+assetstr+'</select></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
        //   str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="hidden"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description_a[]" id="item_des_a1_'+(Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_a[]" id="unit_a1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price_a[]" id="last_unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supllier_a[]" id="last_supllier_a1_'+(Number(count) + 1) + '" class="issue"></td>   <td><input type="hidden"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty_a[]" id="stock_qty_a1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueAsset('+(Number(count) + 1)+')" class="issue"></td><td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price_a[]" id="unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
        str += '<td><select class="e1 form-control" style="width:100%;" onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_' + (Number(count) + 1) + '" class="form-control">' + itemstr + '</select></td>';
        str += '<td><input type="hidden"  name="item_name_description_a[]" id="item_des_a_' + (Number(count) + 1) + '" class="issue"><input  disabled type="text"  name="item_name_description_a[]" id="item_des_a1_' + (Number(count) + 1) + '" class="issue form-control"></td>';
        str += '<td><input type="hidden"  name="unit_a[]" id="unit_a_' + (Number(count) + 1) + '" class="issue"><input  disabled type="text"  name="unit_a[]" id="unit_a1_' + (Number(count) + 1) + '" class="issue form-control"></td>';
        //str += '<td><input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_' + (Number(count) + 1) + '" class="issue"><input  disabled type="text"  name="last_unit_price_a[]" id="last_unit_price_a1_' + (Number(count) + 1) + '" class="issue form-control"></td>';
        //str += '<td><input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_' + (Number(count) + 1) + '" class="issue"><input  disabled type="text"  name="last_supllier_a[]" id="last_supllier_a1_' + (Number(count) + 1) + '" class="issue form-control"></td>';
        str += ' <td><input type="hidden"  name="stock_qty_a[]" id="stock_qty_a_' + (Number(count) + 1) + '" class="issue"><input  disabled type="text"  name="stock_qty_a[]" id="stock_qty_a1_' + (Number(count) + 1) + '" class="issue form-control"></td>';
        str += '<td><input required  type="text"  name="indent_qty_a[]" id="indent_qty_a_' + (Number(count) + 1) + '" onkeyup="calculateEstvalueAsset(' + (Number(count) + 1) + ')" class="issue form-control"></td>';
        //str += ' <td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_' + (Number(count) + 1) + '" class="issue"><input style="width:80px;" disabled type="text"  name="unit_price_a[]" id="unit_price_a1_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input style="width:100px;"  type="text"  name="expected_date_a[]" class="issue datepicker1 form-control hasDatepicker"></td>';
        str += '<td><select class="e1 form-control" style="width:100%;" name="c_c_id[]" id="c_c_id_' + (Number(count) + 1) + '" class="form-control">' + costcentertstr + '</select></td>';
    str += '<td><textarea class="form-control" name="a_remark[]"></textarea></td>';
        str += '</tr>';
        $('#a_count').val(Number(count) + 1);
        $('#myTable1').append(str);
        $('.datepicker1').datepicker({
            // format: 'DD-MM-YYYY'
            dateFormat: 'dd-mm-yy',
            //maxDate: new Date
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

    $('#serviceButton').click(function () {
        var count = $('#count').val();
        var serviceStr = $('#service').html();
        var str = '<tr class="" id="row_' + (Number(count) + 1) + '">';
        str += '<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button4" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        str += '<td><select class="e1" style="width:200px;" name="service_id[]" id="service_id_' + (Number(count) + 1) + '" class="">' + serviceStr + '</select></td>';
        str += '<td><input style="width:200px;"  type="text"  name="expected_date_s[]" class="issue datepicker1"></td>';
        str += '<td><textarea style="width:200px;" name="s_remark[]"></textarea></td>';
        str += '</tr>';

        $('#count').val(Number(count) + 1);
        $('#serviceTable').append(str);
        $('.datepicker1').datepicker({
            dateFormat: 'dd-mm-yy',
        });

        $('select.e1').select2();
        $('.chzn-container').remove();
    });


    function removeRow(row) {
        $('#row_' + row).remove();
    }

    $(document).ready(function () {
        $('.datepicker1').datepicker({
            // format: 'DD-MM-YYYY'
            dateFormat: 'dd-mm-yy',
            //maxDate: new Date
        });
        //    $('select.e1').select2();
    });

</script>

