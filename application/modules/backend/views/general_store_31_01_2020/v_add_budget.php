
<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(2, 8, $userData);
              
?>
<style>
 table { table-layout: fixed; margin-top: 20px}
 table th, table td { overflow: hidden; }
 .table > thead > tr > th {
    padding: 3px;
   
}
 .table > tbody > tr > td{
    padding: 7px;
   
}
.form-control {
	display: block;
	width: 100%;
	height: 34px;
	padding: 6px 5px;
	
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
                <?php } ?>
                
               <?php $this->role = checkUserPermission(2, 39, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'money_indent') echo 'active'; ?>" href="<?php echo site_url('backend/money_indent'); ?>">
                        <i class="fa fa-cc"></i><br><span>MONEY INDENT</span></a>
                </li>
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
                <h3>Add Budget</h3>
            </div>
        </div>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
          
            <form class="form-horizontal" method="post" action="<?php echo site_url('general_store/add_action_budget') ?>">
                
                        <!--
                        <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                            Budget Type:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <select id="b_type" class="form-control" name="b_type" onchange="javascript:budget_no();">
                                    
                                    
                                            <option class="form-control" value="cash">Cash</option>
                                            <option class="form-control" value="credit">Credit</option>
                                            <option class="form-control" value="lc">LC</option>
                                  
                                </select>
                        </div>
                         
                             
                         </div>
                        -->
                
                        <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                               Budget Number:
                           </label> 
                                 <div class="col-sm-4 input-group">
                                     <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                      <input class="form-control" id="budget_code" name="budget_code" type="hidden" value="<?php if(!empty($budget_code)) echo $budget_code;  ?>">
                                   <input class="form-control" id="b_no" name="b_no" type="hidden" value="<?php if(!empty($budget_auto_code)) echo "BUD".$budget_auto_code;  ?>">
                                   <input disabled class="form-control" id="b_no1" name="b_no1" type="text" value="<?php if(!empty($budget_auto_code)) echo "BUD".$budget_auto_code;  ?>">
                           </div>
                           <label for="title" class="col-sm-2 control-label">
                                 Date <sup class="required">*</sup>
                          </label>
                          <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input class="form-control datepicker"  name="b_date" type="text" value="<?php echo date('d-m-Y') ?>">
                        </div>  
                             
                         </div>
                        
                        
<!--                           <div class="form-group row">
                          
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Indent Memo :</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="indent_memo" type="text"></div>
                          
                          <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Budget Type :</label></div>
                          <div class="col-sm-8 col-md-4 ">
                              <select id="b_type" class="form-control" name="b_type" onchange="javascript:budget_no();">
                                    
                                    
                                            <option class="form-control" value="cash">Cash</option>
                                            <option class="form-control" value="credit">Credit</option>
                                            <option class="form-control" value="lc">LC</option>
                                  
                                </select>
                          </div>
                        </div>-->
                        
                        
                      
<!--                    <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Date :</label></div>
                             <div class="col-sm-8 col-md-4 "><input class="form-control datepicker"  name="b_date" type="text" value="<?php echo date('d-m-Y') ?>"></div>
                        </div>-->
                        
                        
                        
                   
                 
                     
                  
                     
                       
                        
                        
                        
                        
                    
<!--                    <div class="col-md-6" style="">
                        <h4 style="text-align: center;text-decoration: underline;"></h4>
                       
                   
                 
                     
                       
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Budget Number:</label></div>
                            <div class="col-sm-8 col-md-4 ">
                                <input class="form-control" id="budget_code" name="budget_code" type="hidden" value="<?php if(!empty($budget_code)) echo $budget_code;  ?>">
                                <input class="form-control" id="b_no" name="b_no" type="hidden" value="<?php if(!empty($budget_auto_code)) echo "CA".$budget_auto_code;  ?>">
                                <input disabled class="form-control" id="b_no1" name="b_no1" type="text" value="<?php if(!empty($budget_auto_code)) echo "CA".$budget_auto_code;  ?>">
                            </div>
                        </div>  
                     
                        
                       
                        
                    
                </div>
                </div>-->
               
             
             <input type="hidden" id="count" value="1"/>
             <table class="table table-bordered" id="myTable" style="margin-top:20px;">
                 <thead class="thead-color">
                     <tr>
                        <th style="vertical-align: middle;width: 10%;text-align: center;">Indent No.</th>
                        <th style="vertical-align: middle;width: 20%;text-align: center;"> Project</th>
                        <th style="vertical-align: middle;width: 15%;text-align: center;">Item name & Description</th>
                        <th style="vertical-align: middle;width: 5%;text-align: center;">MU</th>
                        <th style="vertical-align: middle;width: 5%;text-align: center;">Indent Qty</th>
                        <th style="vertical-align: middle;width: 10%;text-align: center;">Status</th>
                        <th style="vertical-align: middle;width: 5%;text-align: center;">Budget Qty</th>
                        <th style="vertical-align: middle;width: 5%;text-align: center;">Unit Price</th>
                        <th style="vertical-align: middle;width: 10%;text-align: center;">Budget Value</th>
                        <th style="vertical-align: middle;width: 10%;text-align: center;">Payment Mode</th>
                        <th style="vertical-align: middle;width: 5%;text-align: center;">Select</th>
                      

                      


                      </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach($budget_items as $budget_item){ $i++;?>

                      <tr id="row_1">
                        <input type="hidden"  name="indent_date[]" id="indent_date_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['indent_date'])) echo $budget_item['indent_date'];  ?>" >
                        <input type="hidden"  name="asset_id[]" id="asset_id_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['asset_id'])) echo $budget_item['asset_id'];  ?>" >
                        <input type="hidden"  name="c_c_id[]" id="c_c_id_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['c_c_id'])) echo $budget_item['c_c_id'];  ?>" >
                        <input type="hidden"  name="department_id[]" id="department_id_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['department_id'])) echo $budget_item['department_id'];  ?>" >
                        <td><input type="hidden"  name="indent_id[]" id="indent_id_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['ipo_m_id'])) echo $budget_item['ipo_m_id'];  ?>" ><input type="hidden"  name="indent_no[]" id="indent_no_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['indent_no'])) echo $budget_item['indent_no'];  ?>" ><input  disabled type="text"  name="indent_no1[]" id="indent_no1_<?php echo $i; ?>"  class="issue form-control" value="<?php if(!empty($budget_item['indent_no'])) echo $budget_item['indent_no'];  ?>"></td>
                        <td><input type="hidden"  name="indent_d_id[]" id="indent_d_id_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['id'])) echo $budget_item['id'];  ?>"><input type="hidden"  name="item_id[]" id="item_id_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['item_id'])) echo $budget_item['item_id'];  ?>"><input type="hidden"  name="item_code[]" id="item_des_<?php echo $i; ?>" class="issue form-control" value="<?php if(!empty($budget_item['item_code'])) echo $budget_item['item_code'];  ?>"><input  type="hidden"  name="department_name[]" id="department_name_<?php echo $i; ?>" value="<?php if(!empty($budget_item['dep_description'])) echo $budget_item['dep_description'];  ?>" ><input  disabled type="text"  name="department_name1[]" id="department_name1_<?php echo $i; ?>" class="issue form-control" value="<?php if(!empty($budget_item['dep_description'])) echo $budget_item['dep_description'];  ?>"></td>
                        <td><input type="hidden"  name="item_name_description[]" id="item_des_c_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['item_name_description'])) echo $budget_item['item_name_description'];  ?>"><input disabled type="text"  name="item_name_description[]" id="item_des_c1_<?php echo $i; ?>" class="issue form-control" value="<?php if(!empty($budget_item['item_name_description'])) echo $budget_item['item_name_description'];  ?>"></td>
                        <td><input type="hidden"  name="unit[]" id="unit_c_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['unit'])) echo $budget_item['unit'];  ?>"><input  disabled type="text"  name="unit[]" id="unit_c1_<?php echo $i; ?>" class="issue form-control" value="<?php if(!empty($budget_item['unit'])) echo $budget_item['unit'];  ?>"></td>                
                        <td><input type="hidden"  name="indent_qty[]" id="indent_qty_<?php echo $i; ?>"  class="issue" value="<?php if(!empty($budget_item['indent_qty'])) echo $budget_item['indent_qty'];  ?>"><input  disabled  type="text"  name="indent_qty[]" id="indent_qty_c_<?php echo $i; ?>"  class="issue form-control" value="<?php if(!empty($budget_item['indent_qty'])) echo $budget_item['indent_qty'];  ?>"></td>
                        <td><input disabled  type="text"  name="budgeted_status[]" id="budgeted_status_<?php echo $i; ?>"  class="issue form-control" value="<?php if(!empty($budget_item['budgeted_status'])) echo $budget_item['budgeted_status'];  ?>"></td>
                        <td><input type="hidden"  name="net_budgeted_qty[]" id="net_budgeted_qty_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['net_budgeted_qty'])) echo $budget_item['net_budgeted_qty'];  ?>" ><input  type="text" readonly   name="budget_qty[]" id="budget_qty_<?php echo $i; ?>" onkeyup="calculateEstvalueConsume(<?php echo $i; ?>)" class="issue form-control" value="<?php if(!empty($budget_item['indent_qty'])) echo $budget_item['indent_qty'];  ?>" ></td>
                        <td><input   type="text" readonly  name="unit_price[]" id="unit_price_<?php echo $i; ?>" class="issue form-control" onkeyup="calculateEstvalueConsume(<?php echo $i; ?>)" value="<?php if(!empty($budget_item['last_unit_price'])) echo $budget_item['last_unit_price'];  ?>" ></td>
                        <td><input type="hidden"  name="budget_value[]" id="budget_value_<?php echo $i; ?>" class="issue" value="<?php $budget_value=$budget_item['last_unit_price']*$budget_item['indent_qty']; echo $budget_value;  ?>" ><input  disabled type="text"  name="budget_value1[]" id="budget_value_c1_<?php echo $i; ?>"  class="issue form-control" value="<?php $budget_value=$budget_item['last_unit_price']*$budget_item['indent_qty']; echo $budget_value;  ?>" ></td>
                        <td>
                            <select class="form-control"  id="payment_mode_<?php echo $i; ?>" name="payment_mode" >
                                <option value=''>Select Mode</option>
                                <?php foreach($payment_modes as $payment_mode){ ?>
                                    <option value="<?php echo $payment_mode['id'] ?>" ><?php echo $payment_mode['mode_name'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td style="text-align: center;"><input type="checkbox" class="form-control" onclick="addRequired(<?php echo $i; ?>);" id="item_select_<?php echo $i; ?>" name="item_select[]" value="<?php echo $i-1; ?>" ></td>
                        
                   
                      </tr>
                  <?php } ?>  
                      </tbody>
                  </table>
             
              
                
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">SAVE</button>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/general_store/budget') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
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
    
    function addRequired(id){
        
        if($('#item_select_'+id).prop('checked')){
           // alert(id);
            $('#payment_mode_'+id).prop('readonly',false);
            $('#payment_mode_'+id).prop('required',true);
            $('#budget_qty_'+id).prop('readonly',false);
            $('#budget_qty_'+id).prop('required',true);
            $('#unit_price_'+id).prop('readonly',false);
            $('#unit_price_'+id).prop('required',true);
        
        }else{
           // alert(id);
           $('#payment_mode_'+id).prop('readonly',true); 
           $('#payment_mode_'+id).prop('required',false); 
           $('#budget_qty_'+id).prop('readonly',true);
           $('#budget_qty_'+id).prop('required',false); 
           $('#unit_price_'+id).prop('readonly',true);
           $('#unit_price_'+id).prop('required',false); 
        }
            
        
    }
    
    
    
    function calculateEstvalueConsume(id){
        var unit_price = Number($('#unit_price_'+id).val());
        var budget_quantity = Number($('#budget_qty_'+id).val());
        var indent_quantity = Number($('#indent_qty_'+id).val());
        if(budget_quantity>indent_quantity){
            $('#budget_qty_'+id).val('');
        }
        var est_value=unit_price*budget_quantity;
        $('#budget_value_'+id).val(est_value);
        $('#budget_value_c1_'+id).val(est_value);
       
        
        
    }
    
   
     function budget_no(){
            var budget_type= $('#b_type').val();
            if(budget_type=="cash"){
                 var budget_type_sn="CA";
            }else if(budget_type=="credit"){
                var budget_type_sn="CR";
            }else{
               var budget_type_sn="LC"; 
            }
         //   alert(group_id);
            var data = {'budget_type': budget_type}
             $.ajax({
                 url: '<?php echo site_url('general_store/budget_no'); ?>',
                 data: data,
                 method: 'POST',
                 dataType: 'json',
                 success: function (msg) {
                     if(msg.budget_no!=""){
                         var item_id=Number(msg.budget_no[0].budget_code)+1;
                     }else{
                        item_id=""; 
                     }

                     var item_sl_no;
                     if(item_id!=''){
                          if(item_id>999){
                             item_sl_no=item_id;
                         }else if(item_id>99){
                             item_sl_no=budget_type_sn+"0"+item_id;
                         }else if(item_id>9){
                             item_sl_no=budget_type_sn+"00"+item_id;
                         }else{
                             item_sl_no=budget_type_sn+"000"+item_id;
                         }
                     }else{
                         item_id=1;
                         item_sl_no=budget_type_sn+'0001';
                     }

                     $('#budget_code').val(item_id);
                     $('#b_no').val(item_sl_no);
                     $('#b_no1').val(item_sl_no);
                 }

            })
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
   
   
   

    $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr=$('#item_c_1').html();
         var assetstr=$('#asset_c_1').html();
        
        var str= '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str +='<td><button id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
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
        var count = $('#count').val();
        var itemstr=$('#item_a_1').html();
        var assetstr=$('#asset_1').html();
        
        var str= '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str +='<td><button id="button4" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="hidden"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description_a[]" id="item_des_a1_'+(Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_a[]" id="unit_a1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price_a[]" id="last_unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supllier_a[]" id="last_supllier_a1_'+(Number(count) + 1) + '" class="issue"></td>   <td><input type="hidden"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty_a[]" id="stock_qty_a1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueAsset('+(Number(count) + 1)+')" class="issue"></td><td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price_a[]" id="unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
        $('#count').val(Number(count) + 1);
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