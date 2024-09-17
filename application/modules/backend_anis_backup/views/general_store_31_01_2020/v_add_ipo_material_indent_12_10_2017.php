<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; ">Al HAJ KARIM TEXTILES LTD.<br>Indent Session </h2>
             
            <hr>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
          
            <form method="post" action="<?php echo site_url('general_store/add_action_ipo_material_indent') ?>">
                <div class="row">
                    <div class="col-md-6" style="">
                        <h4 style="text-align: center;text-decoration: underline;"></h4>
                       
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Indent Number:</label></div>
                            <div class="col-sm-8 col-md-7 ">
                                <input class="form-control" id="inputdefault" name="indent_code" type="hidden" value="<?php if(!empty($indent_number)) echo $indent_number;  ?>">
                                 <input class="form-control" id="inputdefault" name="ipo_number" type="hidden" value="<?php if(!empty($indent_auto_number)) echo "IN".$indent_auto_number;  ?>">
                                 <input disabled class="form-control" id="inputdefault" name="ipo_number1" type="text" value="<?php if(!empty($indent_auto_number)) echo "IN".$indent_auto_number;  ?>">
                            </div>
                        </div>
                    <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Date :</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control datepicker"  name="date" type="text" value="<?php echo date('d-m-Y') ?>"></div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Project :</label></div>
                            <div class="col-sm-8 col-md-7 ">
                                <select class="form-control" name="department_id">
                                    <option value="">Select Project</option>
                                    <?php foreach($departments as $department){ ?>
                                        <option value="<?php echo $department['d_id'];  ?>"><?php if(!empty($department['dep_code'])) echo $department['dep_description']."(".  $department['dep_code'].")"; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        
                     
                   </div> 
                     
                       
                        
                        
                        
                        
                    
                    <div class="col-md-6" style="">
                        <h4 style="text-align: center;text-decoration: underline;"></h4>
                       
                      <div class="form-group row">
                          <!--
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Indent Memo :</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="indent_memo" type="text"></div>
                          -->
                          <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Item Type :</label></div>
                          <div class="col-sm-8 col-md-7 ">
                              <select id="ipo_item_type" class="form-control" name="ipo_item_type" onchange="javascript:consumable_or_asset();">
                                    
                                    
                                            <option class="form-control" value="Consumable">Consumable</option>
                                            <option class="form-control" value="Asset">Asset</option>
                                  
                                </select>
                          </div>
                        </div>
                 
                        <div class="form-group row">
                            <div class=" col-sm-4 col-md-5  labeltext"><label for="inputdefault">Remarks :</label></div>
                             <div class=" col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="remarks" type="text"></div>
                        </div>
                        
                          <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Status :</label></div>
                            <div class="col-sm-8 col-md-7 ">
                                <select class="form-control" name="status">
                                    <option class="form-control" value="Yes">Yes</option>
                                    <option class="form-control" value="No">No</option>
                                </select>
                            </div>
                        </div>
                        
                        
                        
                    
                </div>
                </div>
                <hr>
             
             <input type="hidden" id="count" value="1"/>
            <table class="table table-bordered" id="myTable">
                    <thead>
                     <tr class="row">
                         <th>
                             <button style="margin-left:5px" id="button1" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                         </th>
                        <th>Item.Code</th>
                        <th>Item name & Description</th>
                        <th>Measurement Unit</th>
                        
                        <th>Last Unit Price</th>
                        <th>Last Supplier</th>
                        
                        <th>Stock Qty</th>
                        <th>Indent Qty</th>
                      
                        <th>Unit Price</th>

                        <th>Expected Date</th>


                      </tr>
                    </thead>
                    <tbody>

                      <tr class="row" id="row_1">
                          <td></td>
                          <td> <select id="item_c_1" name="item_id[]" onchange="javascript:item_info(1);">
                                    <option value="">Select Item</option>
                                    <?php foreach($items as $item){ ?>
                                        <option value="<?php echo $item['id'];  ?>"><?php if(!empty($item['item_code'])) echo $item['item_name']."(". $item['item_code'].")"; ?></option>
                                    <?php } ?>
                                </select></td>
                        <td><input type="text"  name="item_name_description[]" id="item_des_c_1" class="issue"></td>
                        <td><input type="text"  name="unit[]" id="unit_c_1" class="issue"></td>
                        
                        <td><input type="text"  name="last_unit_price[]" id="last_unit_price_c_1" class="issue"></td>
                        <td><input type="text"  name="last_supplier[]" id="last_supllier_c_1" class="issue"></td>
                        
                        <td><input type="text" name="stock_qty[]" id="stock_qty_c_1" class="issue"></td>
                        <td><input type="text"  name="indent_qty[]" id="indent_qty_c_1" class="issue"></td>
                        
                        <td><input type="text"  name="unit_price[]" id="unit_price_c_1" class="issue"></td>

                        <td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td>


                      </tr>
                      </tbody>
                  </table>
             
                 <table class="table table-bordered" id="myTable1" style="display:none;">
                    <thead>
                     <tr class="row">
                         <th>
                             <button style="margin-left:5px" id="button3" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                         </th>
                        <th>Item.Code</th>
                        <th>Item name & Description</th>
                        <th>Measurement Unit</th>
                        
                        <th>Last Unit Price</th>
                        <th>Last Supplier</th>
                        
                        <th>Stock Qty</th>
                        <th>Indent Qty</th>
                        
                        <th>Unit Price</th>
                        <th>Asset</th>
                        <th>Expected Date</th>


                      </tr>
                    </thead>
                    <tbody>

                      <tr class="row" id="row_1">
                          <td></td>
                          <td> <select id="item_a_1" name="item_id_a[]" onchange="javascript:item_info(1);">
                                    <option value="">Select Item</option>
                                    <?php foreach($items as $item){ ?>
                                        <option value="<?php echo $item['id'];  ?>"><?php if(!empty($item['item_code'])) echo $item['item_name']."(". $item['item_code'].")"; ?></option>
                                    <?php } ?>
                                </select></td>
                        <td><input type="text"  name="item_name_description_a[]" id="item_des_a_1" class="issue"></td>
                        <td><input type="text"  name="unit_a[]" id="unit_a_1" class="issue"></td>
                        
                        <td><input type="text"  name="last_unit_price_a[]" id="last_unit_price_a_1" class="issue"></td>
                        <td><input type="text"  name="last_supllier_a[]" id="last_supllier_a_1" class="issue"></td>
                        
                        <td><input type="text" name="stock_qty_a[]" id="stock_qty_a_1" class="issue"></td>
                        <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_1" class="issue"></td>
                        
                        <td><input type="text"  name="unit_price_a[]" id="unit_price_a_1" class="issue"></td>
                        
                           <td> <select id="asset_1" name="asset_id[]" >
                                    <option value="">Select Asset</option>
                                    <?php foreach($assets as $asset){ ?>
                                        <option value="<?php echo $asset['a_id'];  ?>"><?php if(!empty($asset['product_id'])) echo $asset['product_name']."(". $asset['product_id'].")"; ?></option>
                                    <?php } ?>
                                </select></td>

                        <td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td>


                      </tr>
                      </tbody>
                  </table>
                
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">SAVE</button>
                    </div>
                    <!--
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary button">FIND</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success button">VIEW</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn  btn-danger button">DELETE</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-info button">CLEAR</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-warning button">SAVE</button>
                    </div>
                    -->
                    
                </div>
            
                <div class="row">
                <!--    
                    <div class="col-md-4">
                        <button type="button" class="btn  btn-danger button">EXIT</button>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-info button">PRINT PREVIEW</button>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-warning button">RECEIVE FOR QUALITY</button>
                    </div>
                -->
                    
                </div>
            
            </form>
        </div>

<script>
    
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
        var itemstr=$('#item_c_1').html();

        
        var str= '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str +='<td><button id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_unit_price[]" id="last_unit_price_c_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_supplier[]" id="last_supllier_c_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
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
        str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_unit_price_a[]" id="last_unit_price_a_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_supllier_a[]" id="last_supllier_a_'+(Number(count) + 1) + '" class="issue"></td>   <td><input type="text"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_'+(Number(count) + 1) + '" class="form-control">'+assetstr+'</select></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
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