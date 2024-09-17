<?php

        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        
       
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
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
                <div class='form-group' >
                              <label for="title" class="col-sm-2 control-label">
                                    Indent Number:
                              </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input class="form-control" id="inputdefault" name="indent_code" type="hidden" value="<?php if(!empty($indent_number)) echo $indent_number;  ?>">
                                <input class="form-control" id="inputdefault" name="ipo_number" type="hidden" value="<?php if(!empty($indent_auto_number)) echo "IN".$indent_auto_number;  ?>">
                                <input disabled class="form-control" id="inputdefault" name="ipo_number1" type="text" value="<?php if(!empty($indent_auto_number)) echo "IN".$indent_auto_number;  ?>">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                                 Date <sup class="required">*</sup>
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input required class="form-control datepicker"  name="date" type="text" value="<?php echo date('d-m-Y') ?>">
                        </div>
                             
                         </div>
                          
                          <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                                Project <sup class="required">*</sup>:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <?php if($user_type==1){ ?>
                                    <select required class="form-control" name="department_id">
                                        <option value="">Select Project</option>
                                        <?php foreach($departments as $department){ ?>
                                            <option value="<?php echo $department['d_id'];  ?>"><?php if(!empty($department['dep_code'])) echo $department['dep_description']."(".  $department['dep_code'].")"; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php }else{ ?>
                                        <select required class="form-control" name="department_id">
                                        
                                        <?php foreach($departments as $department){ ?>
                                            <option value="<?php echo $department['d_id'];  ?>"><?php if(!empty($department['dep_code'])) echo $department['dep_description']."(".  $department['dep_code'].")"; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } ?>
                        </div>
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
                          
                          
                          <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                                Remarks :
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <input class="form-control" id="inputdefault" name="remarks" type="text">
                                   
                        </div>
                             
                             
                             
                         </div>
                          
                          
                <hr>
             
             <input type="hidden" id="count" value="1"/>
            <table class="table table-bordered" id="myTable">
                    <thead>
                     <tr class="row">
                         <th style="width:30px;padding:4px;">
                             <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" id="button1" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                         </th>
                         <th>Item.Code <sup>*</sup></th>
                        <th>Item name & Description</th>
                        <th>MU</th>
                        <!--
                        <th>Last Rate</th>
                        <th>Last Supplier</th>
                        -->
                        
                        <th>Stock Qnt</th>
                        <th>Indent Qnt <sup>*</sup></th>
                      <!--
                        <th>Est Value</th>
                      -->
                        <th>Expected Date <sup>*</sup></th>
                        <th>Asset</th>
                        <th>Cost Center</th>
                        


                      </tr>
                    </thead>
                    <tbody>

                      <tr class="row" id="row_1">
                          <td></td>
                          <td> <select style="width:200px;" class="e1" style="width:100px;" id="item_c_1" name="item_id[]" onchange="javascript:item_info(1);">
                                    <option value="">Select Item</option>
                                    <?php foreach($items as $item){ ?>
                                        <option value="<?php echo $item['id'];  ?>"><?php if(!empty($item['item_code'])) echo $item['item_code']."(". $item['item_name'].")"; ?></option>
                                    <?php } ?>
                                </select></td>
                        <td><input type="hidden"  name="item_name_description[]" id="item_des_c_1" class="issue"><input style="width:140px;" disabled type="text"  name="item_name_description[]" id="item_des_c1_1" class="issue"></td>
                        <td><input type="hidden"  name="unit[]" id="unit_c_1" class="issue"><input style="width:60px;" disabled type="text"  name="unit[]" id="unit_c1_1" class="issue"></td>
                        
                        <!--
                        <td><input  type="hidden"  name="last_unit_price[]" id="last_unit_price_c_1" class="issue"><input style="width:60px;" disabled disabled type="text"  name="last_unit_price[]" id="last_unit_price_c1_1" class="issue"></td>
                        <td><input type="hidden"  name="last_supplier[]" id="last_supllier_c_1" class="issue"><input style="width:100px;" disabled type="text"  name="last_supplier[]" id="last_supllier_c1_1" class="issue"></td>
                        -->
                        <td>
                             <input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_1" class="issue">
                             <input type="hidden"  name="last_supplier[]" id="last_supllier_c_1" class="issue">
                             <input type="hidden" name="stock_qty[]" id="stock_qty_c_1" class="issue">
                             <input style="width:40px;" disabled type="text" name="stock_qty[]" id="stock_qty_c1_1" class="issue">
                        </td>
                        <td>
                            <input type="hidden"  name="unit_price[]" id="unit_price_c_1" class="issue">
                            <input  style="width:40px;" type="text"  name="indent_qty[]" id="indent_qty_c_1" onkeyup="calculateEstvalueConsume(1)" class="issue">
                        </td>
                       <!-- 
                        <td>
                            <input type="hidden"  name="unit_price[]" id="unit_price_c_1" class="issue">
                            <input style="width:80px;" disabled type="text"  name="unit_price[]" id="unit_price_c1_1" class="issue">
                        </td>
                       -->
                         <td><input style="width:100px;"  type="text"  name="expected_date[]" class="issue datepicker1"></td>
                         <td> <select  style="width:200px;" id="asset_c_1" class="e1" name="asset_id[]" >
                                    <option value="">Select Asset</option>
                                    <?php foreach($assets as $asset){ ?>
                                        <option value="<?php echo $asset['id'];  ?>"><?php if(!empty($asset['item_name'])) echo $asset['item_name']."(". $asset['item_code'].")"; ?></option>
                                    <?php } ?>
                       </select></td> 

                       <td> <select style="width:200px;" class="e1" style="width:110px;" id="c_c_id" name="c_c_id[]" >
                                    <option value="">Select Cost Center</option>
                                    <?php foreach($cost_centers as $cost_center){ ?>
                                        <option value="<?php echo $cost_center['c_c_id'];  ?>"><?php if(!empty($cost_center['c_c_name'])) echo $cost_center['c_c_name']; ?></option>
                                    <?php } ?>
                       </select></td> 


                      </tr>
                      </tbody>
                  </table>
             
                 <table class="table table-bordered" id="myTable1" style="display:none;">
                    <thead>
                     <tr class="row">
                         <th>
                             <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" id="button3" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                         </th>
                         <th>Item.Code <sup>*</sup></th>
                        <th>Item name & Description</th>
                        <th>MU</th>
                        <!--
                        <th>Last Rate</th>
                        <th>Last Supplier</th>
                        -->
                        <th>Stock Qty</th>
                        <th>Indent Qty <sup>*</sup></th>
                        <!--
                        <th>Est. Value</th>
                        -->
                      <!--  <th>Asset</th>-->
                        <th>Expected Date <sup>*</sup></th>
                        <th>Cost Center</th>

                      </tr>
                    </thead>
                    <tbody>

                      <tr class="row" id="row_1">
                          <td></td>
                          <td> <select style="width:200px;" class="e1" id="item_a_1" name="item_id_a[]" onchange="javascript:item_info(1);">
                                    <option value="">Select Item</option>
                                    <?php foreach($items as $item){ ?>
                                        <option value="<?php echo $item['id'];  ?>"><?php if(!empty($item['item_code'])) echo $item['item_code']."(". $item['item_name'].")"; ?></option>
                                    <?php } ?>
                                </select></td>
                        <td><input type="hidden"  name="item_name_description_a[]" id="item_des_a_1" class="issue"><input style="width:140px;" disabled type="text"  name="item_name_description_a[]" id="item_des_a1_1" class="issue"></td>
                        <td><input type="hidden"  name="unit_a[]" id="unit_a_1" class="issue"><input style="width:60px;" disabled type="text"  name="unit_a[]" id="unit_a1_1" class="issue"></td>
                        <!--
                        <td><input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_1" class="issue"><input style="width:60px;" disabled type="text"  name="last_unit_price_a[]" id="last_unit_price_a1_1" class="issue"></td>
                        <td><input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_1" class="issue"><input style="width:100px;" disabled type="text"  name="last_supllier_a[]" id="last_supllier_a1_1" class="issue"></td>
                        -->
                        <td>
                            <input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_1" class="issue">
                            <input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_1" class="issue">
                            <input type="hidden" name="stock_qty_a[]" id="stock_qty_a_1" class="issue"><input style="width:40px;" disabled type="text" name="stock_qty_a[]" id="stock_qty_a1_1" class="issue">
                        </td>
                        <td>
                            <input type="hidden"  name="unit_price_a[]" id="unit_price_a_1" class="issue">
                            <input  style="width:40px;" type="text"  name="indent_qty_a[]" id="indent_qty_a_1" onkeyup="calculateEstvalueAsset(1)" class="issue">
                        </td>
                        
                     <!--   <td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_1" class="issue"><input style="width:80px;" disabled type="text"  name="unit_price_a[]" id="unit_price_a1_1" class="issue"></td>-->
                        <!--
                           <td> <select id="asset_1" name="asset_id[]" >
                                    <option value="">Select Asset</option>
                                    <?php foreach($assets as $asset){ ?>
                                        <option value="<?php echo $asset['a_id'];  ?>"><?php if(!empty($asset['product_id'])) echo $asset['product_name']."(". $asset['product_id'].")"; ?></option>
                                    <?php } ?>
                                </select></td>
                        -->

                        <td><input style="width:100px;"  type="text"  name="expected_date_a[]" class="issue datepicker1"></td>
                         <td> <select style="width:200px;" class="e1" id="c_c_id" name="c_c_id[]" >
                                    <option value="">Select Cost Center</option>
                                    <?php foreach($cost_centers as $cost_center){ ?>
                                        <option value="<?php echo $cost_center['c_c_id'];  ?>"><?php if(!empty($cost_center['c_c_name'])) echo $cost_center['c_c_name']; ?></option>
                                    <?php } ?>
                       </select></td> 

                      </tr>
                      </tbody>
                  </table>
                
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">SAVE</button>
                    </div>
                  <div class="col-md-2">
                        <a href="<?php echo site_url('backend/general_store/ipo_material_indent') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
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
    
    
    function calculateEstvalueConsume(id){
        var last_rate = Number($('#last_unit_price_c_'+id).val());
        var indent_quantity = Number($('#indent_qty_c_'+id).val());
        var stock_quantity = Number($('#stock_qty_c_'+id).val());
        var est_value=last_rate*indent_quantity;
        $('#unit_price_c_'+id).val(est_value);
        $('#unit_price_c1_'+id).val(est_value);
//        if(indent_quantity>stock_quantity){
//             $('#indent_process_status').val('applied');
//        }else{
//            $('#indent_process_status').val('processed');
//        }
        
        
    }
    
     function calculateEstvalueAsset(id){
        var last_rate = Number($('#last_unit_price_a_'+id).val());
        var indent_quantity = Number($('#indent_qty_a_'+id).val());
        var est_value=last_rate*indent_quantity;
        $('#unit_price_a_'+id).val(est_value);
        $('#unit_price_a1_'+id).val(est_value);
        
        
    }
    
   function consumable_or_asset(){
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
                     var item_description=msg.item_info[0].item_name+","+msg.item_info[0].port_no+","+msg.item_info[0].brand;
                    $('#item_des_c_'+id).val(item_description);
                    $('#item_des_c1_'+id).val(item_description);
                    $('#unit_c_'+id).val(msg.item_info[0].meas_unit);
                    $('#unit_c1_'+id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_c_'+id).val(msg.item_info[0].stock_amount);
                    $('#stock_qty_c1_'+id).val(msg.item_info[0].stock_amount);
                    
                    if(msg.item_previous_info!=''){
                        $('#last_unit_price_c_'+id).val(msg.item_previous_info[0].unit_price);
                        $('#last_unit_price_c1_'+id).val(msg.item_previous_info[0].unit_price);
                        var supplier=msg.item_previous_info[0].SUP_NAME+"("+msg.item_previous_info[0].CODE+")";
                    }else{
                        $('#last_unit_price_c_'+id).val('');
                        $('#last_unit_price_c1_'+id).val('');
                        var supplier='';
                    }
                   
                    $('#last_supllier_c_'+id).val(supplier);
                    $('#last_supllier_c1_'+id).val(supplier);
                }else{     
                    var item_description=msg.item_info[0].item_name+","+msg.item_info[0].port_no+","+msg.item_info[0].brand;
                    $('#item_des_a_'+id).val(item_description);
                    $('#item_des_a1_'+id).val(item_description);
                    $('#unit_a_'+id).val(msg.item_info[0].meas_unit);
                    $('#unit_a1_'+id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_a_'+id).val(msg.item_info[0].stock_amount);
                    $('#stock_qty_a1_'+id).val(msg.item_info[0].stock_amount);
                    
                     if(msg.item_previous_info!=''){
                        $('#last_unit_price_a_'+id).val(msg.item_previous_info[0].unit_price);
                        $('#last_unit_price_a1_'+id).val(msg.item_previous_info[0].unit_price);
                        var supplier=msg.item_previous_info[0].SUP_NAME+"("+msg.item_previous_info[0].CODE+")";
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
        var costcentertstr=$('#c_c_id').html();
        
        var str= '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str +='<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
      //  str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="hidden"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description[]" id="item_des_c1_'+(Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit[]" id="unit_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price[]" id="last_unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supplier[]" id="last_supllier_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supplier[]" id="last_supllier_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="hidden"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty[]" id="stock_qty_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueConsume('+(Number(count) + 1)+')" class="issue"></td><td><input type="hidden"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price[]" id="unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_c_'+(Number(count) + 1) + '" class="form-control">'+assetstr+'</select></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
        str +='<td><select class="e1" style="width:200px;" onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="">'+itemstr+'</select></td>';
        str +='<td><input type="hidden"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"><input style="width:140px;" disabled type="text"  name="item_name_description[]" id="item_des_c1_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><input type="hidden"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"><input style="width:60px;" disabled type="text"  name="unit[]" id="unit_c1_'+(Number(count) + 1) + '" class="issue"></td> ';
        str+='<td>';
        str+='<input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_'+(Number(count) + 1) + '" class="issue">';
        str+='<input type="hidden"  name="last_supplier[]" id="last_supllier_c_'+(Number(count) + 1) + '" class="issue">';
        str +='<input type="hidden"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"><input style="width:40px;" disabled type="text"  name="stock_qty[]" id="stock_qty_c1_'+(Number(count) + 1) + '" class="issue">';
        str+='</td>';
        str +='<td><input  type="hidden"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"><input required style="width:40px;" type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueConsume('+(Number(count) + 1)+')" class="issue"></td>';
        str +='<td><input style="width:100px;"  type="text"  name="expected_date[]" class="issue datepicker1"></td>';
        str +='<td><select class="e1" style="width:200px;" name="asset_id[]" id="asset_c_'+(Number(count) + 1) + '" class="">'+assetstr+'</select></td>';
        str +='<td><select class="e1" style="width:200px;" name="c_c_id[]" id="c_c_id_'+(Number(count) + 1) + '" class="">'+costcentertstr+'</select></td>';
        str +='</tr>';
        
         
      
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
        var itemstr=$('#item_a_1').html();
        var assetstr=$('#asset_1').html();
        var costcentertstr=$('#c_c_id').html();
        var str= '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str +='<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button4" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
     //  str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="hidden"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description_a[]" id="item_des_a1_'+(Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_a[]" id="unit_a1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price_a[]" id="last_unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supllier_a[]" id="last_supllier_a1_'+(Number(count) + 1) + '" class="issue"></td>   <td><input type="hidden"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty_a[]" id="stock_qty_a1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueAsset('+(Number(count) + 1)+')" class="issue"></td><td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price_a[]" id="unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
       str +='<td><select class="e1" style="width:200px;" onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="">'+itemstr+'</select></td>';
       str +='<td><input type="hidden"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"><input style="width:140px;" disabled type="text"  name="item_name_description_a[]" id="item_des_a1_'+(Number(count) + 1) + '" class="issue"></td>';
       str +='<td><input type="hidden"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"><input style="width:60px;" disabled type="text"  name="unit_a[]" id="unit_a1_'+(Number(count) + 1) + '" class="issue"></td>';
       str+='<td>';
       str+='<input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_'+(Number(count) + 1) + '" class="issue">';
       str+='<input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_'+(Number(count) + 1) + '" class="issue">';
       str +='<input type="hidden"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"><input style="width:40px;" disabled type="text"  name="stock_qty_a[]" id="stock_qty_a1_'+(Number(count) + 1) + '" class="issue">';
       str+='</td>';
       str +='<td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"><input required style="width:40px;" type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueAsset('+(Number(count) + 1)+')" class="issue"></td>';
       str +='<td><input style="width:100px;"  type="text"  name="expected_date_a[]" class="issue datepicker1"></td>';
       str +='<td><select class="e1" style="width:200px;" name="c_c_id[]" id="c_c_id_'+(Number(count) + 1) + '" class="">'+costcentertstr+'</select></td>';
       str +='</tr>';
       
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