<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; ">Add Asset Issue Info</h2>
            <hr>
            <div class="row">
             <!--    <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   -->
            </div>
            <form method="post" action="<?php echo site_url('general_store/add_action_asset_issue') ?>">
               
             <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Issue NO.:</label></div>
                            <div class="col-sm-8 col-md-5 ">
                             <!--
                                <input class="form-control" name="issue_no" type="text" value="<?php if(!empty($issue_no)) echo $issue_no; ?>">
                             -->
                                
                                <input class="form-control" id="" name="issue_code" type="hidden" value="<?php if(!empty($issue_code)) echo $issue_code; ?>">
                                <input class="form-control" id="" name="a_issue_no" type="hidden" value="<?php if(!empty($issue_auto_code)) echo "AIS".$issue_auto_code; ?>">
                                <input disabled class="form-control" id="" name="issue_no1" type="text" value="<?php if(!empty($issue_auto_code)) echo "AIS".$issue_auto_code; ?>">
                               
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Date :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control datepicker" name="a_issue_date" type="text" value="<?php echo date('d-m-Y'); ?>"></div>
                        </div>
                    </div>
                </div>
                
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Requisition:</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                <!--
                                <input class="form-control" name="issue_note" type="text">
                                -->
                                 <select required id="mrr_ipo_no" class="form-control" name="requisition_id"  onchange="javascript:indent_info();">
                                    <option value="">Select Requisition</option>
                                    <?php foreach($requisitions as $requisition){ ?>
                                        <option value="<?php echo $requisition['requisition_id'];  ?>"><?php if(!empty($requisition['requisition_no'])) echo $requisition['dep_description'].'('.$requisition['requisition_no'].')'; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                       <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Remarks :</label></div>
                            <div class="col-sm-8 col-md-5 "><input class="form-control" name="a_isssue_remark" type="text"></div>
                        </div>    
                    </div>
                 
                </div>
               
                
                <div class="row">
                   
                    <!--
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Cur Stock :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" name="cur_strock" type="text"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Cur Value :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" name="cur_value" type="text"></div>
                    </div>
                    -->
                </div>
                
                
            <h2 style="text-align:center; ">Item List & information</h2>
             <hr>
              <input type="hidden" id="count" value="1"/>
               <input type="hidden" id="item_count" value=""/>
             <table class="table table-bordered" id="myTable">
    <thead>
      <tr class="row">
        <th> <button style="margin-left:5px" id="button1" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   </th>
        <th>Item Code</th>
        <th>Item Description</th>
        <th>MU</th>
        <th>Status</th>
        <th>Requisition Qnt</th>
        <th>Stock Qnt</th>
        <th>Issue Qnt</th>
        <th>Remark</th>
      </tr>
    </thead>
    <tbody>
       <tr class="row" id="row_1">
          <td></td>
           <td> <select id="item_1" name="item_id[]" onchange="javascript:item_info(1);">
                    <option value="">Select Item</option>
                    <!--
                    <?php foreach($items as $item){ ?>
                        <option value="<?php echo $item['id'];  ?>"><?php if(!empty($item['item_code'])) echo $item['item_name']."(". $item['item_code'].")"; ?></option>
                    <?php } ?>
                    -->
                </select></td>
        <td><input style="width:100px;" type="text" name="item_name_des[]" id="item_des_1" class="issue"></td>
        <td><input style="width:100px;" type="text" name="m_unit[]" id="unit_1" class="issue"></td>
        <td><input style="width:40px;" type="text" name="status[]" class="issue"></td>
        <td><input style="width:40px;" type="text" name="indent_qty[]" class="issue"></td>
        <td><input style="width:40px;" type="text" name="stock_qty[]" class="issue"></td>
        <td><input required style="width:40px;" type="text" name="issue_qty[]" class="issue"></td>
       
       
        <td><input style="width:100px;" type="text" name="remark[]" class="issue"></td>
        
      </tr>
      </tbody>
  </table>
  <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-10">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">SAVE</button>
                    </div>
                     <div class="col-md-2">
                        <a href="<?php echo site_url('backend/general_store/asset_issue') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
                    <!--
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success button">FIND</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary button">VIEW</button>
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
                <div class="col-md-2">
                    
                    <div class="row">
                <div class="col-md-12">
                      <!--  <button type="button" class="btn btn-success button">EXIT</button>-->
                    </div>
            </div>
                </div>
                   
                    
                    
                </div>
            
            
            
            </form>
        </div>

<script>
    
    function issue_type_info(){
        var issue_type=$('#issue_type').val();
        if(issue_type=='delivery'){
            $('#delivey').show();
        }else{
             $('#delivery_no').val('');
             $('#delivey').hide();
        }
    }
    
    
    function calculateTotal(id){
    //    alert('test');
        var net_price;
        var issue_quantity = Number($('#issue_qty_'+id).val());
        var indent_quantity = Number($('#indent_qty_'+id).val());
        var stock_quantity = Number($('#stock_qty_'+id).val());
       

     //  alert(mrr_quantity);
         if(issue_quantity>stock_quantity || issue_quantity>indent_quantity || issue_quantity<=0){
           
             $('#issue_qty_'+id).val('');
        }
        var issue_quantity = Number($('#issue_qty_'+id).val());
        
      
    }
    
   
    function item_info(id) { 
        var itemId = $('#item_'+id).val();
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
                   
                $('#item_des_'+id).val(msg[0].item_name);
                $('#unit_'+id).val(msg[0].meas_unit);
          //      $('#stock_qty_'+id).val(msg[0].stock_amount);
            }
        })

    }
    
    
     function indent_info(){
        //  alert('test');
       var requisition_id= $('#mrr_ipo_no').val();
       var data = {'requisition_id': requisition_id}
        $.ajax({
            url: '<?php echo site_url('general_store/requisition_info_details'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
            //    alert('test');
             var j=0;
//                $('#issue_ipo_date').val(msg.indent[0].date);
//                $('#dep_name').val(msg.indent[0].dep_description);
                
              
                 var str='<thead> <tr class="row"> <th> <button style="margin-left:5px;display:none;" id="button1" type="button" class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span></button></th><th>Item Code</th><th>Item Description</th><th>MU</th><th>Status</th><th style="width:40px;">Requisition Qnt</th><th>Stock Qnt</th><th>Issue Qnt</th><th>Remark</th></tr></thead><tbody>';
              
                 $(msg.indent_details).each(function (i, v) {
                     var indent_qty=Number(v.indent_qty)-Number(v.issue_qty);
                     j++;
                     str +='<tr class="row" id="row_'+j+'" >'; 
              //       if(j>1){
                        str +='<td><button id="button2" onclick="removeRow(' + j + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
             //       }else{
             //           str +="<td></td>";
             //       }
                     str +='<td><input type="hidden" value="'+v.c_c_id+'" name="c_c_id[]" id="c_c_id_'+j+'" class="issue"><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input style="width:80px;" disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td>';
                     str +='<td><input type="hidden" name="item_name_des[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_description+'"><input style="width:150px;" disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_description+'"></td>';
                     str +='<td><input type="hidden" name="m_unit[]" id="unit_'+j+'" class="issue" value="'+v.m_unit+'"><input style="width:100px;" disabled type="text" name="issue_m_unit1[]" id="unit1_'+j+'" class="issue" value="'+v.m_unit+'"></td>';
                     str +='<td><input style="width:100px;" disabled type="text" name="status[]" id="unit1_'+j+'" class="issue" value="'+v.status+'"></td>';
                     str +='<td><input type="hidden" name="indent_qty[]" id="indent_qty_'+j+'" class="issue" value="'+indent_qty+'"><input style="width:40px;" disabled type="text" name="indent_qty1[]" id="indent_qty1_'+j+'" class="issue" value="'+indent_qty+'"></td>';
                     str +='<td><input type="hidden" name="stock_qty[]" id="stock_qty_'+j+'" class="issue" value="'+v.stock_qty+'"><input style="width:40px;" disabled type="text" name="stock_qty1[]" id="stock_qty1_'+j+'" class="issue" value="'+v.stock_qty+'"></td>';
                     str +='<td><input required style="width:40px;" type="text" name="issue_qty[]" id="issue_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td>';
                     str +='<td><input style="width:100px;" type="text" name="remark[]" id="remark_'+j+'" class="issue"  value=""></td> ';                  
                     str +="</tr>";
                 });
                 str +="</tbody>";
                 $('#myTable').html(str);
                 $("#item_count").val(j);
         
             }
                
               
            
        })
    }
    

  $('#button1').live('click',function (){
       // alert('test');
        var count = $('#item_count').val();
        var requisition_id= $('#mrr_ipo_no').val();
        var data = {'requisition_id': requisition_id}
          $.ajax({
            url: '<?php echo site_url('general_store/requisition_info_details'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
              //  alert('test');
              var count = Number($('#item_count').val());
              var add_item_number=count+1;
              var j=0;
               
                 $(msg.indent_details).each(function (i, v) {
                     j++;
                     if(j==add_item_number){
                     var str='<tr class="row" id="row_'+j+'" >';
                    // str +="<td></td>";  
                     str +='<td><button id="button2" onclick="removeRow(' + j + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';            
                     str +='<td><input type="hidden" value="'+v.c_c_id+'" name="c_c_id[]" id="c_c_id_'+j+'" class="issue"><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input style="width:80px;" disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td>';
                     str +='<td><input type="hidden" name="item_name_des[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_description+'"><input style="width:150px;" disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_description+'"></td>';
                     str +='<td><input type="hidden" name="m_unit[]" id="unit_'+j+'" class="issue" value="'+v.m_unit+'"><input style="width:100px;" disabled type="text" name="issue_m_unit1[]" id="unit1_'+j+'" class="issue" value="'+v.m_unit+'"></td>';
                     str +='<td><input style="width:100px;" disabled type="text" name="status[]" id="unit1_'+j+'" class="issue" value="'+v.status+'"></td>';
                     str +='<td><input type="hidden" name="indent_qty[]" id="indent_qty_'+j+'" class="issue" value="'+v.indent_qty+'"><input style="width:40px;" disabled type="text" name="indent_qty1[]" id="indent_qty1_'+j+'" class="issue" value="'+v.indent_qty+'"></td>';
                     str +='<td><input type="hidden" name="stock_qty[]" id="stock_qty_'+j+'" class="issue" value="'+v.stock_qty+'"><input style="width:40px;" disabled type="text" name="stock_qty1[]" id="stock_qty1_'+j+'" class="issue" value="'+v.stock_qty+'"></td>';
                     str +='<td><input required style="width:40px;" type="text" name="issue_qty[]" id="issue_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td>';
                     str +='<td><input style="width:100px;" type="text" name="issue_d_remark[]" id="item_remark_'+j+'" class="issue"  value=""></td> ';                  
                       
                    // str +='<td><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_name_des[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_description+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_description+'"></td><td><input type="hidden" name="issue_m_unit[]" id="unit_'+j+'" class="issue" value="'+v.unit+'"><input disabled type="text" name="issue_m_unit1[]" id="unit1_'+j+'" class="issue" value="'+v.unit+'"></td><td><input type="hidden" name="indent_qty[]" id="indent_qty_'+j+'" class="issue" value="'+v.indent_qty+'"><input disabled type="text" name="indent_qty1[]" id="indent_qty1_'+j+'" class="issue" value="'+v.indent_qty+'"></td><td><input type="hidden" name="stock_qty[]" id="stock_qty_'+j+'" class="issue" value="'+v.stock_qty+'"><input disabled type="text" name="stock_qty1[]" id="stock_qty1_'+j+'" class="issue" value="'+v.stock_qty+'"></td><td><input type="text" name="issue_qty[]" id="issue_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="text" name="issue_unit_price[]" id="unit_price_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input hidden type="text" name="issue_value[]" id="issue_value_'+j+'" class="issue"  value=""><input disabled type="text" name="issue_value1[]" id="issue_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="issue_d_remark[]" id="item_remark_'+j+'" class="issue"  value=""></td> ';
                    //   str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_name_des[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_description+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_description+'"></td><td><input type="hidden" name="issue_m_unit[]" id="unit_'+j+'" class="issue" value="'+v.unit+'"><input disabled type="text" name="issue_m_unit1[]" id="unit1_'+j+'" class="issue" value="'+v.unit+'"></td><td><input type="hidden" name="indent_qty[]" id="indent_qty_'+j+'" class="issue" value="'+v.indent_qty+'"><input disabled type="text" name="indent_qty1[]" id="indent_qty1_'+j+'" class="issue" value="'+v.indent_qty+'"></td><td><input type="hidden" name="stock_qty[]" id="stock_qty_'+j+'" class="issue" value="'+v.stock_qty+'"><input disabled type="text" name="stock_qty1[]" id="stock_qty1_'+j+'" class="issue" value="'+v.stock_qty+'"></td><td><input required type="text" name="issue_qty[]" id="issue_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input required type="text" name="issue_unit_price[]" id="unit_price_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input hidden type="text" name="issue_value[]" id="issue_value_'+j+'" class="issue"  value=""><input disabled type="text" name="issue_value1[]" id="issue_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="issue_d_remark[]" id="item_remark_'+j+'" class="issue"  value=""></td> ';
                     
                     
                       str +="</tr>";
                       $('#myTable').append(str);
                       var current_item_count=count+1;
                       $('#item_count').val(current_item_count);
                    }
                 });
                 //alert(j);
                 var new_count = Number($('#item_count').val());
                 if(new_count>=j){
                    $('#button1').hide();
                 }else{
                    $('#button1').show();
                 }
                
                // $('#item_1').html(str);
                // $('.selectpicker').selectpicker('refresh');
             }
                
               
            
        });
        
    });




   

//    $('#button1').click(function () {
//        var count = $('#count').val();
//        var itemstr=$('#item_1').html();
//
//        
//        
//        var str= '<tr class="row" id="row_' + (Number(count) + 1) + '">';
//        str +='<td><button id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
//         str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text" name="item_name_des[]" id="item_des_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text" name="issue_m_unit[]" id="unit_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text" name="issue_quality[]" class="issue"></td> <td><input type="text" name="issue_unit_price[]" class="issue"></td> <td><input type="text" name="issue_value[]" class="issue"></td><td><input type="text" name="issue_d_remark[]" class="issue"></td></tr>';
//        $('#count').val(Number(count) + 1);
//        $('#myTable').append(str);
//        $('.datepicker').datepicker({
//            format: 'DD-MM-YYYY'
//        });    
////        $('.time').datetimepicker();
////        $('.datepicker').datetimepicker({
////            format: 'DD-MM-YYYY'
////        });                                     
////        $('.monthpicker').datetimepicker({
////            format: 'YYYY-MM'
////        });
//      //  $('select.e1').select2();
//        $('.chzn-container').remove();
//    });
    
    
    
    
    

    function removeRow(row) {
       var item_count=Number($("#item_count").val());
       var net_count=item_count-1;
       $("#item_count").val(net_count);
       $('#button1').show();
       $('#row_'+row).remove();
    }

    $(document).ready(function () {

    //    $('select.e1').select2();
    });

</script>