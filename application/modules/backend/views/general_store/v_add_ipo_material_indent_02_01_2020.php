<?php
    $employee_id = $this->session->userdata('employeeId');
    $user_type = $this->session->userdata('user_type');
?>
<style>
 table { table-layout: fixed; }
 table th, table td { overflow: hidden; }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
           <ul class="nav nav-tabs upper">
                <?php 
                $this->role = checkUserPermission(2, 7, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){  
                    ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'ipo_material_indent') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/ipo_material_indent'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>MATERIAL INDENT  </span>
                    </a>
                </li>
                <?php } ?> 
                <?php $this->role = checkUserPermission(2, 8, $userData); 
                
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                
                ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'budget') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/budget'); ?>">
                        <i class="fa fa-cc"></i><br><span>BUDGET</span></a>
                </li>
                 <?php } ?>
                
                 <?php $this->role = checkUserPermission(2, 39, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ ?>
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'money_indent') echo 'active'; ?>" href="<?php echo site_url('backend/money_indent'); ?>">
                        <i class="fa fa-cc"></i><br><span>MONEY INDENT</span></a>
                </li>
                <?php } ?>
                
               
                <!--
                 <?php $this->role = checkUserPermission(2, 40, $userData); 
                 if(empty($this->role) || !array_key_exists(11,$this->role)){ ?>
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'purchase_quotation') echo 'active'; ?>" href="<?php echo site_url('backend/purchase_quotations'); ?>">
                        <i class="fa fa-cc"></i><br><span>PURCHASE QUOTATION</span></a>
                </li>
                <?php } ?>
                -->
                
               
                
                 <?php $this->role = checkUserPermission(2, 41, $userData); 
                 if(empty($this->role) || !array_key_exists(11,$this->role)){ ?> 
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
                <h3>Add Material Indent</h3>
            </div>
        </div>
        <!--            <div class="row">
                         <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                    </div>-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" method="post" action="<?php echo site_url('general_store/add_action_ipo_material_indent') ?>">
                            <div class="row">
                                <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label">
                                        Indent Number:
                                    </label> 

                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" id="inputdefault" name="indent_code" type="hidden" value="<?php if (!empty($indent_number)) echo $indent_number; ?>">
                                        <input class="form-control" id="inputdefault" name="ipo_number" type="hidden" value="<?php if (!empty($indent_auto_number)) echo "IN" . $indent_auto_number; ?>">
                                        <input disabled class="form-control" id="inputdefault" name="ipo_number1" type="text" value="<?php if (!empty($indent_auto_number)) echo "IN" . $indent_auto_number; ?>">
                                    </div>

                                    <label for="title" class="col-sm-2 control-label">
                                        Indent Type<sup class="required">*</sup>:
                                    </label> 
                                    <div class="col-sm-4 input-group">

                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <select required class="form-control" id="indent_type" name="indent_type">
                                            <?php foreach ($indent_types as $indent_type) { ?>
                                                <option value="<?php echo $indent_type['id']; ?>"><?php if (!empty($indent_type['type_name'])) echo $indent_type['type_name']; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>


                                </div>
                            </div>    
                            <div class="row">  
                                <div class='form-group' >

                                    <label for="title" class="col-sm-2 control-label">
                                        Date <sup class="required">*</sup>
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                        <input required class="form-control datepicker"  name="date" type="text" value="<?php echo date('d-m-Y') ?>">
                                    </div>


                                    <label for="title" class="col-sm-2 control-label">
                                        Project <sup class="required">*</sup>:
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <?php if ($user_type == 1) { ?>
                                                <select required class="form-control" name="department_id">
                                                        <option value="">Select Project</option>
                                                <?php foreach ($departments as $department) { ?>
                                                        <option value="<?php echo $department['d_id']; ?>"><?php if (!empty($department['dep_code'])) echo $department['dep_description'] . "(" . $department['dep_code'] . ")"; ?></option>
                                                    <?php } ?>
                                                </select>
                                            <?php }else { ?>
                                                <select required class="form-control" name="department_id">

                                            <?php foreach ($departments as $department) { ?>
                                                    <option value="<?php echo $department['d_id']; ?>"><?php if (!empty($department['dep_code'])) echo $department['dep_description'] . "(" . $department['dep_code'] . ")"; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php } ?>
                                    </div>


                                </div>

                            </div>

                            <div class="row">
                               <div class='form-group'  >
                                   <!--
                                   <div id="item_type">
                                        <label for="title" class="col-sm-2 control-label">
                                            Item Type :
                                        </label>
                                        <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                            <select id="ipo_item_type" class="form-control" name="ipo_item_type" onchange="javascript:consumable_or_asset();">

                                                <option class="form-control" value="Consumable">Consumable</option>
                                                <option class="form-control" value="Asset">Asset</option>

                                            </select>
                                        </div>
                                   </div>   
                                   -->
                                
                                    <label for="title" class="col-sm-2 control-label">
                                        Remarks :
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" id="inputdefault" name="remarks" type="text">

                                    </div>



                                </div>
                            </div>

                            
                            <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:12px;" id="addItem" type="button" class="btn btn-primary pull-left">Add Material Or Asset</button>
                            
                          <!--  <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:12px;display:none" id="addService" type="button" class="btn btn-primary pull-left">Add Subcon Job</button>    -->
                            <input type="hidden" id="count" value="1"/>
                            <table class="table table-bordered" id="myTable">
                                <thead class="thead-color">
                                    <tr>
                                        <th style="width:5%;padding:4px;">
                                       <!--     <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" id="button1" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   -->
                                        </th>
                                     <!--   <th style="vertical-align: middle;width: 10%;text-align: center;">Item.Code <sup>*</sup></th>-->
                                        <th style="vertical-align: middle;width: 20%;text-align: center;">Item name & Description</th>
                                        <th style="vertical-align: middle;width:10%;text-align: center;">Unit of Qnty</th>                                 
                                        <th style="vertical-align: middle;width:10%;text-align: center;">Brand<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;width: 8%;text-align: center;">Stock Qty</th>
                                        <th style="vertical-align: middle;width:8%;text-align: center;">Indent Qty<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;width:10%;text-align: center;">Size</th>
                                        <th style="vertical-align: middle;width:10%;text-align: center;">Unit of Size</th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Expected Date<sup style="color:red;">*</sup></th>
                                        <!--
                                        <th style="vertical-align: middle;width: 15%;text-align: center;">Asset</th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Cost Center</th>
                                        -->
                                        <th style="vertical-align: middle;width:15%;text-align: center;">Remark</th>



                                    </tr>
                                </thead>
                                <tbody id="mytableBody">
                                   
                                </tbody>
                                
                            </table>

                            <table class="table table-bordered" id="myTable1" style="display:none;">
                                <thead class="thead-color">
                                    <tr>
                                        <th style="vertical-align: middle;width: 5%;text-align: center;">
                                            <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" id="button3" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                                        </th>
                                        <th style="vertical-align: middle;width: 5%;text-align: center;">Item.Code <sup>*</sup></th>
                                        <th style="vertical-align: middle;width: 20%;text-align: center;">Item name & Description</th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Unit</th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Brand</th>
                                        <!--
                                        <th>Last Rate</th>
                                        <th>Last Supplier</th>
                                        -->
                                        <th style="vertical-align: middle;width: 5%;text-align: center;">Stock Qty</th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Indent Qty <sup>*</sup></th>
                                        
                                        <th style="vertical-align: middle;width: 15%;text-align: center;">Expected Date <sup>*</sup></th>
                                        <th style="vertical-align: middle;width: 15%;text-align: center;">Cost Center</th>
                                        <th style="vertical-align: middle;width: 15%;text-align: center;"   >Remark</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <tr id="row_1">
                                        <td></td>
                                        <td> <select style="width:100%;" class="e1 form-control" id="item_a_1" name="item_id_a[]" onchange="javascript:item_info(1);">
                                                <option value="">Select Item</option>
<?php foreach ($items as $item) { ?>
                                                    <option value="<?php echo $item['id']; ?>"><?php if (!empty($item['item_code'])) echo $item['item_code'] . "(" . $item['item_name'] . ")"; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="hidden"  name="item_name_description_a[]" id="item_des_a_1" class="issue">
                                            <input style="width:100%;" disabled type="text"  name="item_name_description_a[]" id="item_des_a1_1" class="issue form-control"></td>
                                        <td>
                                            <input type="hidden"  name="unit_a[]" id="unit_a_1" class="issue">
                                            <input style="width:100%;" disabled type="text"  name="unit_a[]" id="unit_a1_1" class="issue form-control">
                                        </td>
                                        <!--
                                        <td><input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_1" class="issue"><input style="width:60px;" disabled type="text"  name="last_unit_price_a[]" id="last_unit_price_a1_1" class="issue"></td>
                                        <td><input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_1" class="issue"><input style="width:100px;" disabled type="text"  name="last_supllier_a[]" id="last_supllier_a1_1" class="issue"></td>
                                        -->
                                        <td>
                                            <input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_1" class="issue">
                                            <input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_1" class="issue">
                                            <input type="hidden" name="stock_qty_a[]" id="stock_qty_a_1" class="issue">
                                            <input style="width:100%;" disabled type="text" name="stock_qty_a[]" id="stock_qty_a1_1" class="issue form-control">
                                        </td>
                                        <td>
                                            <input type="hidden"  name="unit_price_a[]" id="unit_price_a_1" class="issue">
                                            <input  style="width:100%;" type="text"  name="indent_qty_a[]" id="indent_qty_a_1" onkeyup="calculateEstvalueAsset(1)" class="issue form-control">
                                        </td>

<!--   <td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_1" class="issue"><input style="width:80px;" disabled type="text"  name="unit_price_a[]" id="unit_price_a1_1" class="issue"></td>-->
                                        <!--
                                           <td> <select id="asset_1" name="asset_id[]" >
                                                    <option value="">Select Asset</option>
<?php foreach ($assets as $asset) { ?>
                                                            <option value="<?php echo $asset['a_id']; ?>"><?php if (!empty($asset['product_id'])) echo $asset['product_name'] . "(" . $asset['product_id'] . ")"; ?></option>
                                        <?php } ?>
                                                </select></td>
                                        -->

                                        <td>
                                            <input style="width:100%;"  type="text"  name="expected_date_a[]" class="issue datepicker1 form-control"></td>
                                        <td> <select style="width:100%;" class="e1 form-control" id="c_c_id" name="c_c_id[]" >
                                                <option value="">Select Cost Center</option>
<?php foreach ($cost_centers as $cost_center) { ?>
                                                    <option value="<?php echo $cost_center['c_c_id']; ?>"><?php if (!empty($cost_center['c_c_name'])) echo $cost_center['c_c_name']; ?></option>
                                                <?php } ?>
                                            </select></td> 
                                         <td>
                                             <textarea class="form-contrl" style="width:100%;height: 34px;" name="a_remark[]"></textarea>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered" id="serviceTable" style="display:none;">
                                <thead class="thead-color">
                                    <tr>
                                        <th style="width:10%;">
                                            <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" id="serviceButton" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                                        </th>
                                        <th style="width:30%; vertical-align: middle;text-align: center">Service <sup>*</sup></th>
                                         <th style="width:30%; vertical-align: middle;text-align: center">Expected Date <sup>*</sup></th>
                                        <th style="width:30%; vertical-align: middle;text-align: center">Remark</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="" id="row_1">
                                        <td></td>
                                        <td> <select style="width:100%;" class="e1 form-contrl" id="service" name="service_id[]" >
                                                <option value="">Select Service</option>
                                                <?php foreach ($services as $service) { ?>
                                                    <option value="<?php echo $service['id']; ?>"><?php if (!empty($service['service_name'])) echo $service['service_name']; ?></option>
                                                <?php } ?>
                                            </select></td>

                                        <td><input style="width:100%;"  type="text"  name="expected_date_s[]" class="issue datepicker1 form-control"></td>
                                        <td>
                                            <textarea class="form-control" style="width:100%;height: 34px;" name="s_remark[]"></textarea>
                                        </td>


                                    </tr>
                                </tbody>
                            </table>

                            <div class="separator-shadow"></div>
                            <div class="row" style="margin-bottom: 20px">
                                  <div class="col-md-2">
                                      <a href="<?php echo site_url('backend/general_store/ipo_material_indent') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                                  </div>
                                
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary button">SAVE</button>
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
                                                    <th style="vertical-align: middle;text-align: center">Size Unit</th>
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
    
    <div id="serviceModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add Job</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12 M-row">
                                        <div class="col-md-6">
                                            <label>Select Category</label>
                                            <select required="" name="category" id="s_category" onchange="getJobGroup()"class=" form-control" required="">
                                                <option value="">Select Category</option>
                                                <?php foreach($s_categories as $s_category){ ?>
                                                    <option value="<?php echo $s_category['s_c_id'] ?>"><?php echo $s_category['category_name'] ?></option>
                                                <?php } ?>
                                                
                                             </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Select Group</label>

                                            <select required="" name="group" id="s_group" class=" form-control" onchange="getJobList()" required="">
                                                <option value="">Select Group</option>
                                              
                                            </select>
                                        </div>
                                        
                                        
                                      <table class="table table-bordered"  style="margin-top:75px;">
                                            <thead class="thead-color">
                                                <tr>
                                                    
                                                    <th style="vertical-align: middle;text-align: center">Item Name</th>
                                                    <th style="vertical-align: middle;text-align: center">Unit</th>                                                    
                                                    <th style="vertical-align: middle;text-align: center">Size Unit</th>
                                                    <th style="vertical-align: middle;text-align: center">Select</th>

                                                </tr>
                                            </thead>
                                            <tbody id="joblist">

                                           
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
        var indent_type=$('#indent_type :selected').text();
        if(group_id!=''){
            $.ajax({
                url: '<?php echo site_url('general_store/group_item_list'); ?>',
                data: {'group_id':group_id,'indent_type':indent_type},
                method: 'POST',
                dataType: 'json',
                success: function (msg) {
                    var str ='';
                    $(msg.item_list).each(function (i, v) {  
                        str += '<tr>';
                        str +='<td><input id="item_id_'+v.id+'"  type="hidden" value="'+v.id+'"  /><input id="code_'+v.id+'"  type="hidden" value="'+v.item_code+'"  /><input id="stock_'+v.id+'"  type="hidden" value="'+v.stock_qty+'"  /><input id="item_description_'+v.id+'"  type="hidden" value="'+v.item_description+'"  />'+v.item_name+'</td>';
                        str +='<td><input id="mu_'+v.id+'"  type="hidden" value="'+v.mu_unit+'"  />'+v.mu_unit+'</td>';
                        str +='<td><input id="grade_'+v.id+'"  type="hidden" value="'+v.item_grade+'"  />'+v.item_grade+'</td>';
                        str +='<td><input id="size_'+v.id+'"  type="hidden" value="'+v.size+'"  />'+v.size+'</td>';
                        str +='<td><input id="size_unit_'+v.id+'"  type="hidden" value="'+v.unit_name+'"  />'+v.unit_name+'</td>';
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
    
      //  if($('#select_'+item_id).prop('checked')){
            $('#select_'+item_id).prop('checked',true);
            var code=$('#code_'+item_id).val();
            var item_description=$('#item_description_'+item_id).val();
            var mu=$('#mu_'+item_id).val();
            var size=$('#size_'+item_id).val();
            var size_unit=$('#size_unit_'+item_id).val();
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
                 

                    
                    var str ='';
                    var str = '<tr id="row_'+item_id+'">';
                    str += '<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' +item_id+ ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
                    //  str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="hidden"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description[]" id="item_des_c1_'+(Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit[]" id="unit_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price[]" id="last_unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supplier[]" id="last_supllier_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supplier[]" id="last_supllier_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="hidden"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty[]" id="stock_qty_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueConsume('+(Number(count) + 1)+')" class="issue"></td><td><input type="hidden"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price[]" id="unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_c_'+(Number(count) + 1) + '" class="form-control">'+assetstr+'</select></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
                  //  str += '<td><input disabled type="text"  name="item_name_description[]" id="item_des_c1_' +item_id+ '" class="issue form-control" value="'+code+'"></td>';   
                    str += '<td><input type="hidden"  name="item_id[]" id="item_c_' +item_id+ '" class="issue" value="'+item_id+'"><input type="hidden"  name="item_name_description[]" id="item_des_c_' +item_id+ '" class="issue" value="'+item_description+'"><input disabled type="text"  name="item_name_description[]" id="item_des_c1_' +item_id+ '" class="issue form-control" value="'+item_description+'"></td>';
                    str += '<td><input type="hidden"  name="unit[]" id="unit_c_' +item_id+ '" class="issue" value="'+mu+'"><input style="width:100%;" disabled type="text"  name="unit[]" id="unit_c1_' +item_id+ '" class="issue form-control" value="'+mu+'"></td> ';
                   
                   
                    str += '<td><select  class="e1 form-control" style="width:100%;" name="brand_id[]" id="brand_' +item_id+ '" class="">'+br+'</select></td>';
                    str += '<td>';
                    str += '<input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_' +item_id+ '" class="issue">';
                    str += '<input type="hidden"  name="last_supplier[]" id="last_supllier_c_' +item_id+ '" class="issue">';
                    str += '<input type="hidden"  name="stock_qty[]" id="stock_qty_c_' +item_id+ '" class="issue" value="'+stock+'" ><input style="width:100%;" disabled type="text"  name="stock_qty[]" id="stock_qty_c1_' +item_id+ '" class="issue form-control" value="'+stock+'" >';
                    str += '</td>';
                    str += '<td><input  type="hidden"  name="unit_price[]" id="unit_price_c_' +item_id+ '" class="issue"><input required style="width:100%;" type="text"  name="indent_qty[]" id="indent_qty_c_' +item_id+ '" onkeyup="calculateEstvalueConsume(' +item_id+ ')" class="issue form-control"></td>';
                    str += '<td><input style="width:100%;"  type="text"  name="item_size[]" id="unit_c1_' +item_id+ '" class="issue form-control" value=""></td> ';
                    str += '<td><input style="width:100%;" disabled type="text"  name="size_unit[]" id="size_unit_c1_' +item_id+ '" class="issue form-control" value="'+size_unit+'"></td>';
                    str += '<td><input style="width:100%;"  type="text"  name="expected_date[]" class="issue datepicker1 form-control"></td>';
                 //   str += '<td><select class="e1 form-control" style="width:100%;" name="asset_id[]" id="asset_c_' +item_id+ '" class="">' + assetstr + '</select></td>';
                   // str += '<td><select class="e1 form-control" style="width:100%;" name="c_c_id[]" id="c_c_id_' +item_id+ '" class="">' + costcentertstr + '</select></td>';
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
            
            

            
//       }else{
//          $('#row_'+item_id).remove(); 
//       }    
    }
    
    function getJobGroup(){
        var category_id=$('#s_category').val();
        if(category_id!=''){
            $.ajax({
                url: '<?php echo site_url('general_store/getJobGroup'); ?>',
                data: {'category_id':category_id},
                method: 'POST',
                dataType: 'json',
                success: function (msg) {
                    var str = '<option value="">Select Group</option>';
                    $(msg.group_list).each(function (i, v) {
                        //   alert('test');
                        str += '<option value="'+v.id+'">'+v.group_name+'</option>';
                    });
                    $('#s_group').html(str);
                   
                }
            } )
        }else{
            $('#s_group').html('');
        }    
    }
    
    
     function getJobList(){
        var group_id=$('#s_group').val();
       
        if(group_id!=''){
            $.ajax({
                url: '<?php echo site_url('general_store/group_job_list'); ?>',
                data: {'group_id':group_id},
                method: 'POST',
                dataType: 'json',
                success: function (msg) {
                    var str ='';
                    $(msg.job_list).each(function (i, v) {  
                        str += '<tr>';
                        str +='<td><input id="item_id_'+v.id+'"  type="hidden" value="'+v.id+'"  /><input id="code_'+v.id+'"  type="hidden" value="'+v.service_id_no+'"  /><input id="stock_'+v.id+'"  type="hidden" value="'+v.stock_qty+'"  /><input id="item_description_'+v.id+'"  type="hidden" value="'+v.item_description+'"  />'+v.service_name+'</td>';
                        str +='<td><input id="mu_'+v.id+'"  type="hidden" value="'+v.mu_unit+'"  />'+v.mu_unit+'</td>';
                        str +='<td><input id="size_unit_'+v.id+'"  type="hidden" value="'+v.unit_name+'"  />'+v.unit_name+'</td>';
                        str +='<td><input id="select_'+v.id+'" onclick="addItem(' + v.id + ')" style="text-align:center;" type="checkbox" /></td>'
                        str +='</tr>';
                    });
                    $('#joblist').html(str);
                   
                }
            } )
        }else{
            $('#joblist').html('');
        }    
    }
    
    
    
     function addService(item_id){
        var count = $('#count').val();
    
      //  if($('#select_'+item_id).prop('checked')){
            $('#select_'+item_id).prop('checked',true);
            var code=$('#code_'+item_id).val();
            var item_description=$('#item_description_'+item_id).val();
            var mu=$('#mu_'+item_id).val();
            var size=$('#size_'+item_id).val();
            var size_unit=$('#size_unit_'+item_id).val();
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
                 

                    
                    var str ='';
                    var str = '<tr id="row_'+item_id+'">';
                    str += '<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' +item_id+ ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
                    //  str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="hidden"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description[]" id="item_des_c1_'+(Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit[]" id="unit_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price[]" id="last_unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supplier[]" id="last_supllier_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supplier[]" id="last_supllier_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="hidden"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty[]" id="stock_qty_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueConsume('+(Number(count) + 1)+')" class="issue"></td><td><input type="hidden"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price[]" id="unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_c_'+(Number(count) + 1) + '" class="form-control">'+assetstr+'</select></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
                  //  str += '<td><input disabled type="text"  name="item_name_description[]" id="item_des_c1_' +item_id+ '" class="issue form-control" value="'+code+'"></td>';   
                    str += '<td><input type="hidden"  name="item_id[]" id="item_c_' +item_id+ '" class="issue" value="'+item_id+'"><input type="hidden"  name="item_name_description[]" id="item_des_c_' +item_id+ '" class="issue" value="'+item_description+'"><input disabled type="text"  name="item_name_description[]" id="item_des_c1_' +item_id+ '" class="issue form-control" value="'+item_description+'"></td>';
                    str += '<td><input type="hidden"  name="unit[]" id="unit_c_' +item_id+ '" class="issue" value="'+mu+'"><input style="width:100%;" disabled type="text"  name="unit[]" id="unit_c1_' +item_id+ '" class="issue form-control" value="'+mu+'"></td> ';
                   
                   
                    str += '<td><select  class="e1 form-control" style="width:100%;" name="brand_id[]" id="brand_' +item_id+ '" class="">'+br+'</select></td>';
                    str += '<td>';
                    str += '<input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_' +item_id+ '" class="issue">';
                    str += '<input type="hidden"  name="last_supplier[]" id="last_supllier_c_' +item_id+ '" class="issue">';
                    str += '<input type="hidden"  name="stock_qty[]" id="stock_qty_c_' +item_id+ '" class="issue" value="'+stock+'" ><input style="width:100%;" disabled type="text"  name="stock_qty[]" id="stock_qty_c1_' +item_id+ '" class="issue form-control" value="'+stock+'" >';
                    str += '</td>';
                    str += '<td><input  type="hidden"  name="unit_price[]" id="unit_price_c_' +item_id+ '" class="issue"><input required style="width:100%;" type="text"  name="indent_qty[]" id="indent_qty_c_' +item_id+ '" onkeyup="calculateEstvalueConsume(' +item_id+ ')" class="issue form-control"></td>';
                    str += '<td><input style="width:100%;"  type="text"  name="item_size[]" id="unit_c1_' +item_id+ '" class="issue form-control" value=""></td> ';
                    str += '<td><input style="width:100%;" disabled type="text"  name="size_unit[]" id="size_unit_c1_' +item_id+ '" class="issue form-control" value="'+size_unit+'"></td>';
                    str += '<td><input style="width:100%;"  type="text"  name="expected_date[]" class="issue datepicker1 form-control"></td>';
                 //   str += '<td><select class="e1 form-control" style="width:100%;" name="asset_id[]" id="asset_c_' +item_id+ '" class="">' + assetstr + '</select></td>';
                   // str += '<td><select class="e1 form-control" style="width:100%;" name="c_c_id[]" id="c_c_id_' +item_id+ '" class="">' + costcentertstr + '</select></td>';
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
            
            

            
//       }else{
//          $('#row_'+item_id).remove(); 
//       }    
    }
    
    
    $('#addItem').click(function (){
        $('#myModal').modal('show');
         
    });
    
    $('#addService').click(function (){
        $('#serviceModal').modal('show');
    });

    $('#indent_type').change(function(){
        //alert('test');
        var indent_type=$('#indent_type :selected').text();
      
            if(indent_type=="Matrial" || indent_type=="Asset" ){
              
                $('#mytableBody').html('');
             //   $('#item_type').show();
                $('#myTable').show();
                $('#myTable1').hide();
                $('#serviceTable').hide();
              //  $('#addService').hide();
                $('#addItem').show();

            }else{
              
                 //   $('#item_type').hide();
                $('#serviceTable').show();
                $('#myTable').hide();
                $('#myTable1').hide();
                $('#mytableBody').html('');
               // $('#addService').show();
                $('#addItem').hide();
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

                var item_type = $('#ipo_item_type').val();
              

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




    $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr = $('#item_c_1').html();
        var assetstr = $('#asset_c_1').html();
        var costcentertstr = $('#c_c_id').html();

        var str = '<tr id="row_' + (Number(count) + 1) + '">';
        str += '<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        //  str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="hidden"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description[]" id="item_des_c1_'+(Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit[]" id="unit_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price[]" id="last_unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supplier[]" id="last_supllier_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supplier[]" id="last_supllier_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="hidden"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty[]" id="stock_qty_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueConsume('+(Number(count) + 1)+')" class="issue"></td><td><input type="hidden"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price[]" id="unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_c_'+(Number(count) + 1) + '" class="form-control">'+assetstr+'</select></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
        str += '<td><select class="e1 form-control" style="width:100%;" onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_' + (Number(count) + 1) + '" class="">' + itemstr + '</select></td>';
        str += '<td><input type="hidden"  name="item_name_description[]" id="item_des_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description[]" id="item_des_c1_' + (Number(count) + 1) + '" class="issue form-control"></td>';
        str += '<td><input type="hidden"  name="unit[]" id="unit_c_' + (Number(count) + 1) + '" class="issue"><input style="width:100%;" disabled type="text"  name="unit[]" id="unit_c1_' + (Number(count) + 1) + '" class="issue form-control"></td> ';
        str += '<td>';
        str += '<input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_' + (Number(count) + 1) + '" class="issue">';
        str += '<input type="hidden"  name="last_supplier[]" id="last_supllier_c_' + (Number(count) + 1) + '" class="issue">';
        str += '<input type="hidden"  name="stock_qty[]" id="stock_qty_c_' + (Number(count) + 1) + '" class="issue"><input style="width:100%;" disabled type="text"  name="stock_qty[]" id="stock_qty_c1_' + (Number(count) + 1) + '" class="issue form-control">';
        str += '</td>';
        str += '<td><input  type="hidden"  name="unit_price[]" id="unit_price_c_' + (Number(count) + 1) + '" class="issue"><input required style="width:100%;" type="text"  name="indent_qty[]" id="indent_qty_c_' + (Number(count) + 1) + '" onkeyup="calculateEstvalueConsume(' + (Number(count) + 1) + ')" class="issue form-control"></td>';
        str += '<td><input style="width:100%;"  type="text"  name="expected_date[]" class="issue datepicker1 form-control"></td>';
        str += '<td><select class="e1 form-control" style="width:100%;" name="asset_id[]" id="asset_c_' + (Number(count) + 1) + '" class="">' + assetstr + '</select></td>';
        str += '<td><select class="e1 form-control" style="width:100%;" name="c_c_id[]" id="c_c_id_' + (Number(count) + 1) + '" class="">' + costcentertstr + '</select></td>';
         str += '<td><textarea class="form-control" style="width:100%;height:34px;" name="remark[]"></textarea></td>';
        str += '</tr>';



        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
        $('.datepicker1').datepicker({
            // format: 'DD-MM-YYYY'
            dateFormat: 'dd-mm-yy',
            //  maxDate: new Date
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
        var count = $('#count').val();
        var itemstr = $('#item_a_1').html();
        var assetstr = $('#asset_1').html();
        var costcentertstr = $('#c_c_id').html();
        var str = '<tr id="row_' + (Number(count) + 1) + '">';
        str += '<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button4" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        //  str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="hidden"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description_a[]" id="item_des_a1_'+(Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_a[]" id="unit_a1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price_a[]" id="last_unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supllier_a[]" id="last_supllier_a1_'+(Number(count) + 1) + '" class="issue"></td>   <td><input type="hidden"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty_a[]" id="stock_qty_a1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueAsset('+(Number(count) + 1)+')" class="issue"></td><td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price_a[]" id="unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
        str += '<td><select class="e1 form-control" style="width:100%;" onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_' + (Number(count) + 1) + '" class="">' + itemstr + '</select></td>';
        str += '<td><input type="hidden"  name="item_name_description_a[]" id="item_des_a_' + (Number(count) + 1) + '" class="issue"><input style="width:100%;" disabled type="text"  name="item_name_description_a[]" id="item_des_a1_' + (Number(count) + 1) + '" class="issue form-control"></td>';
        str += '<td><input type="hidden"  name="unit_a[]" id="unit_a_' + (Number(count) + 1) + '" class="issue"><input style="width:100%;" disabled type="text"  name="unit_a[]" id="unit_a1_' + (Number(count) + 1) + '" class="issue form-control"></td>';
        str += '<td>';
        str += '<input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_' + (Number(count) + 1) + '" class="issue">';
        str += '<input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_' + (Number(count) + 1) + '" class="issue">';
        str += '<input type="hidden"  name="stock_qty_a[]" id="stock_qty_a_' + (Number(count) + 1) + '" class="issue"><input style="width:100%;" disabled type="text"  name="stock_qty_a[]" id="stock_qty_a1_' + (Number(count) + 1) + '" class="issue form-control">';
        str += '</td>';
        str += '<td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_' + (Number(count) + 1) + '" class="issue"><input required style="width:100%;" type="text"  name="indent_qty_a[]" id="indent_qty_a_' + (Number(count) + 1) + '" onkeyup="calculateEstvalueAsset(' + (Number(count) + 1) + ')" class="issue form-control"></td>';
        str += '<td><input style="width:100%;"  type="text"  name="expected_date_a[]" class="issue datepicker1 form-control"></td>';
        str += '<td><select class="e1 form-control" style="width:100%;" name="c_c_id[]" id="c_c_id_' + (Number(count) + 1) + '" class="">' + costcentertstr + '</select></td>';
        str += '<td><textarea class="form-control" style="width:100%;height:34px" name="a_remark[]"></textarea></td>';
        str += '</tr>';

        $('#count').val(Number(count) + 1);
        $('#myTable1').append(str);
        $('.datepicker1').datepicker({
            // format: 'DD-MM-YYYY'
            dateFormat: 'dd-mm-yy',
            // maxDate: new Date
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
    
    
     $('#serviceButton').click(function () {
        var count = $('#count').val();
        var serviceStr = $('#service').html(); 
        var str = '<tr id="row_' + (Number(count) + 1) + '">';
        str += '<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button4" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        str += '<td><select class="e1 from-control" style="width:100%;" name="service_id[]" id="service_id_' + (Number(count) + 1) + '" class="">' + serviceStr + '</select></td>'; 
        str += '<td><input style="width:100%;"  type="text"  name="expected_date_s[]" class="form-control issue datepicker1"></td>';  
        str += '<td><textarea class="form-control" style="width:100%;height:34px;" name="s_remark[]"></textarea></td>';
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
            //  maxDate: new Date
        });
        //    $('select.e1').select2();
    });

</script>