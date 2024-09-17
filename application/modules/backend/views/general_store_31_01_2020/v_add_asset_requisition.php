<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; ">Asset Requisition<br></h2>
             
            <hr>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
          
            <form method="post" action="<?php echo site_url('general_store/add_action_asset_requisition') ?>">
                <div class="row">
                    <div class="col-md-6" style="">
                        <h4 style="text-align: center;text-decoration: underline;"></h4>
                       
                            <div class="form-group row">
                                <div class="col-sm-4 col-md-4 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Requisition Number:</label></div>
                                <div class="col-sm-8 col-md-5 ">
                                    <input class="form-control" id="inputdefault" name="requisition_code" type="hidden" value="<?php if(!empty($requisition_number)) echo $requisition_number;  ?>">
                                    <input class="form-control" id="inputdefault" name="requisition_no" type="hidden" value="<?php if(!empty($requisition_auto_number)) echo "ARQ".$requisition_auto_number;  ?>">
                                    <input disabled class="form-control" id="inputdefault" name="requisition_number1" type="text" value="<?php if(!empty($requisition_auto_number)) echo "ARQ".$requisition_auto_number;  ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-md-4 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Date :</label></div>
                                 <div class="col-sm-8 col-md-5 "><input required class="form-control datepicker"  name="date" type="text" value="<?php echo date('d-m-Y') ?>"></div>
                            </div>
                        
                  
                   </div> <!--End Col-6 -->
                     
                       
                        
                        
                        
                        
                    
                    <div class="col-md-6" style="">
                        <h4 style="text-align: center;text-decoration: underline;"></h4>
                       
                       <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Project :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                <select required class="form-control" name="department_id">
                                    <option value="">Select Project</option>
                                    <?php foreach($departments as $department){ ?>
                                        <option value="<?php echo $department['d_id'];  ?>"><?php if(!empty($department['dep_code'])) echo $department['dep_description']."(".  $department['dep_code'].")"; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                 
                        <div class="form-group row">
                            <div class=" col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Remarks :</label></div>
                            <div class=" col-sm-8 col-md-5 "><input class="form-control" id="inputdefault" name="remarks" type="text"></div>
                        </div>
      
                   </div><!--End Col-6 -->
                   
               </div><!--End Row-->
                <hr>
             
             <input type="hidden" id="count" value="1"/>
            <table class="table table-bordered" id="myTable">
                    <thead>
                     <tr class="row">
                         <th style="width:30px;padding:4px;">
                             <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" id="button1" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                         </th>
                        <th>Item.Code</th>
                        <th>Item name & Description</th>
                        <th>MU</th>
                        <th>Stock Qnt</th>
                        <th>Indent Qnt</th>
                        <th>Expected Date</th>
                        <th>Cost Center</th>
                      
                       

                        


                      </tr>
                    </thead>
                    <tbody>

                      <tr class="row" id="row_1">
                          <td></td>
                          <td> <select style="width:100px;" id="item_c_1" name="item_id[]" onchange="javascript:item_info(1);">
                                    <option value="">Select Item</option>
                                    <?php foreach($items as $item){ ?>
                                        <option value="<?php echo $item['id'];  ?>"><?php if(!empty($item['item_code'])) echo $item['item_code']."(". $item['item_name'].")"; ?></option>
                                    <?php } ?>
                                </select></td>
                        <td><input type="hidden"  name="item_name_description[]" id="item_des_c_1" class="issue"><input style="width:240px;" disabled type="text"  name="item_name_description[]" id="item_des_c1_1" class="issue"></td>
                        <td><input type="hidden"  name="unit[]" id="unit_c_1" class="issue"><input style="width:60px;" disabled type="text"  name="unit[]" id="unit_c1_1" class="issue"></td>
                        <td><input type="hidden" name="stock_qty[]" id="stock_qty_c_1" class="issue"><input style="width:40px;" disabled type="text" name="stock_qty[]" id="stock_qty_c1_1" class="issue"></td>
                        <td><input  style="width:40px;" type="text"  name="indent_qty[]" id="indent_qty_c_1"  class="issue"></td>
                   
                         <td><input style="width:100px;"  type="text"  name="expected_date[]" class="issue datepicker1"></td>
                         <td><select style="width:110px;" id="asset_c_1" name="c_c_id[]" >
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
                        <a href="<?php echo site_url('backend/general_store/asset_requisition') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
                    
                </div>
            
                <div class="row">
               
                    
                </div>
            
            </form>
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
        var itemId = $('#item_c_'+id).val(); 
        var data = {'itemId': itemId}
        $.ajax({
            url: '<?php echo site_url('general_store/item_info'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {

            var item_type=$('#ipo_item_type').val();
            
            var item_description=msg.item_info[0].item_name+","+msg.item_info[0].port_no+","+msg.item_info[0].brand;
            $('#item_des_c_'+id).val(item_description);
            $('#item_des_c1_'+id).val(item_description);
            $('#unit_c_'+id).val(msg.item_info[0].meas_unit);
            $('#unit_c1_'+id).val(msg.item_info[0].meas_unit);
            $('#stock_qty_c_'+id).val(msg.item_info[0].stock_amount);
            $('#stock_qty_c1_'+id).val(msg.item_info[0].stock_amount);
                    
                  
               
                
            }
        })

    }
   
   
   

    $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr=$('#item_c_1').html();
        var assetstr=$('#asset_c_1').html();
        
        var str= '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str +='<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        str +='<td><select style="width:100px;" onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="">'+itemstr+'</select></td>';
        str +='<td><input type="hidden"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"><input style="width:240px;" disabled type="text"  name="item_name_description[]" id="item_des_c1_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><input type="hidden"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"><input style="width:60px;" disabled type="text"  name="unit[]" id="unit_c1_'+(Number(count) + 1) + '" class="issue"></td> ';
        
        str +='<td><input type="hidden"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"><input style="width:40px;" disabled type="text"  name="stock_qty[]" id="stock_qty_c1_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><input required style="width:40px;" type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueConsume('+(Number(count) + 1)+')" class="issue"></td>';
       
        str +='<td><input style="width:100px;"  type="text"  name="expected_date[]" class="issue datepicker1"></td>';
        str +='<td><select style="width:100px;" name="asset_id[]" id="asset_c_'+(Number(count) + 1) + '" class="">'+assetstr+'</select></td>';
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
      //  $('select.e1').select2();
        $('.chzn-container').remove();
    });
    
     $('#button3').click(function () {
        var count = $('#count').val();
        var itemstr=$('#item_a_1').html();
        var assetstr=$('#asset_1').html();
        
        var str= '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str +='<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button4" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
     //  str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="hidden"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description_a[]" id="item_des_a1_'+(Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_a[]" id="unit_a1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price_a[]" id="last_unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supllier_a[]" id="last_supllier_a1_'+(Number(count) + 1) + '" class="issue"></td>   <td><input type="hidden"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty_a[]" id="stock_qty_a1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueAsset('+(Number(count) + 1)+')" class="issue"></td><td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price_a[]" id="unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
       str +='<td><select style="width:100px;" onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td>';
       str +='<td><input type="hidden"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"><input style="width:140px;" disabled type="text"  name="item_name_description_a[]" id="item_des_a1_'+(Number(count) + 1) + '" class="issue"></td>';
       str +='<td><input type="hidden"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"><input style="width:60px;" disabled type="text"  name="unit_a[]" id="unit_a1_'+(Number(count) + 1) + '" class="issue"></td>';
       str +='<td><input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_'+(Number(count) + 1) + '" class="issue"><input style="width:60px;" disabled type="text"  name="last_unit_price_a[]" id="last_unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td>';
       str +='<td><input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_'+(Number(count) + 1) + '" class="issue"><input style="width:100px;" disabled type="text"  name="last_supllier_a[]" id="last_supllier_a1_'+(Number(count) + 1) + '" class="issue"></td>';
       str +=' <td><input type="hidden"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"><input style="width:40px;" disabled type="text"  name="stock_qty_a[]" id="stock_qty_a1_'+(Number(count) + 1) + '" class="issue"></td>';
       str +='<td><input required style="width:40px;" type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueAsset('+(Number(count) + 1)+')" class="issue"></td>';
       str +=' <td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"><input style="width:80px;" disabled type="text"  name="unit_price_a[]" id="unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td>';
       str +='<td><input style="width:100px;"  type="text"  name="expected_date_a[]" class="issue datepicker1"></td>';
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
      //  $('select.e1').select2();
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

