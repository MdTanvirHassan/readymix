<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; ">Asset Issue Return Receive</h2>
            <hr>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
            <form method="post" action="<?php echo site_url('general_store/add_action_asset_issue_receive') ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">AIR No.:</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                <input  class="form-control" id="inputdefault" name="a_ir_code" type="hidden" value="<?php if(!empty($air_code)) echo $air_code;  ?>">
                                <input class="form-control" id="inputdefault" name="a_ir_no" type="hidden" value="<?php if(!empty($air_auto_code)) echo 'AIRR'.$air_auto_code;  ?>">
                                <input disabled class="form-control" id="inputdefault" name="a_ir_no" type="text" value="<?php if(!empty($air_auto_code)) echo  'AIRR'.$air_auto_code;  ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Receive Date :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control datepicker" name="a_ir_date"  type="text" value="<?php echo date('d-m-Y') ?>"></div>
                        </div>
                    </div>
                </div>
                
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Issue No. :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                               
                                <select required id="issue_no" class="form-control" name="a_issue_id" onchange="javascript:issue_item_info()">
                                    <option value="">Select Issue No</option>
                                    <?php foreach($issue_numbers as $issue_number){ ?>
                                        <option value="<?php echo $issue_number['a_issue_id'];  ?>"><?php if(!empty($issue_number['a_issue_no'])) echo $issue_number['a_issue_no']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Issue Date :</label></div>
                            <div class="col-sm-8 col-md-5 "><input id="issue_date" class="form-control datepicker" name="a_issue_date" type="text"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                  
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Remarks :</label></div>
                            <div class="col-sm-8 col-md-5 "><input class="form-control" name="remarks" type="text"></div>
                        </div>   
                    </div>
                </div>
                
                
                
                
            <h2 style="text-align:center; ">Item List & information</h2>
             <hr>
              <input type="hidden" id="count" value="1"/>
              <input type="hidden" id="item_count" value=""/>
             <table class="table table-bordered" id="myTable">
    <thead>
      <tr class="row">
          <th><button style="margin-left:5px" type="button" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   </th>
        <th>Item Code</th>
        <th>Item Description</th>
        <th>MU</th>
        <th>Issued Qnt</th>
        <th>Receive Qnt</th>
        <th>Remark</th>
      </tr>
    </thead>
    <tbody>
       <tr class="row" id="row_1">
          <td></td>
           <td> <select id="item_1" name="item_id[]" onchange="javascript:item_info(1);">
                    <option value="">Select Item</option>
                    <?php foreach($items as $item){ ?>
                        <option value="<?php echo $item['id'];  ?>"><?php if(!empty($item['item_code'])) echo $item['item_name']."(". $item['item_code'].")"; ?></option>
                    <?php } ?>
                </select></td>
        <td><input type="text" name="item_description[]" id="item_des_1" class="issue"></td>
        <td><input type="text" name="measurement_unit[]" id="unit_1" class="issue"></td>
        <td><input type="text" name="issued_qty[]" id="receive_qty_1" onkeyup="calculateTotal(1)" class="issue"></td>
        <td><input required type="text" name="return_qty[]" id="receive_qty_1" onkeyup="calculateTotal(1)" class="issue"></td>
        <td><input type="text" name="remark[]" class="issue"></td>
        
      </tr>
      </tbody>
  </table>
  <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-10">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">SAVE</button>
                    </div>
                     <div class="col-md-2">
                        <a href="<?php echo site_url('backend/general_store/asset_issue_receive') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
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
                   <!--     <button type="button" class="btn btn-success button">EXIT</button> -->
                    </div>
            </div>
                </div>
                   
                    
                    
                </div>
            
            
            
            </form>
        </div>

<script>
   
    function calculateTotal(id){

      
        var issue_quantity = $('#issue_qty_'+id).val();
       
        var receive_qty = $('#receive_qty_'+id).val();
      
        if(receive_qty > issue_quantity || receive_qty<=0){
           $('#receive_qty_'+id).val('');
        }
      
    }
    
    
      
    
    
   function issue_item_info(){
        //  alert('test');
       var issue_no= $('#issue_no').val();
       var data = {'a_issue_id': issue_no}
        $.ajax({
            url: '<?php echo site_url('general_store/asset_issue_info_details'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
            //    alert('test');
             var j=0;
                $('#issue_date').val(msg.indent[0].date);
                
                 var str = '<thead> <tr class="row"><th><button style="margin-left:5px;display:none"  type="button" id="button1" class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span></button>   </th><th>Item Code</th><th>Item Description</th>  <th>MU</th><th>Issued Qty</th><th>Receive Qty</th><th>Remark</th></tr></thead><tbody>';
                 $(msg.issue_details).each(function (i, v) {
                     var issue_qty=Number(v.issue_qty)-Number(v.receive_qty);
                     j++;
                       str +='<tr class="row" id="row_'+j+'" >';
//                       if(j==1){
//                            str +='<td></td>';
//                       }else{
                            str +='<td><button id="button2" onclick="removeRow(' + j + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
//                       }    
                     //  str +='<td><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_name_des+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_des+'"></td><td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.issue_m_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.issue_m_unit+'"></td><td><input type="hidden" name="issued_qty[]" id="issued_qty_'+j+'" class="issue" value="'+v.issue_quality+'"><input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+v.issue_quality+'"></td><td><input type="text" name="return_qty[]" id="return_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="hidden" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"><input disabled type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"></td><td><input hidden type="text" name="return_value[]" id="return_value_'+j+'" class="issue"  value=""><input disabled type="text" name="return_value1[]" id="return_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="remark_'+j+'" class="issue"  value=""></td> ';
                   //  str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.asset_id+'" name="asset_id[]" id="asset_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_name_des+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_des+'"></td><td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.issue_m_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.issue_m_unit+'"></td><td><input type="hidden" name="issued_qty[]" id="issued_qty_'+j+'" class="issue" value="'+v.issue_quality+'"><input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+v.issue_quality+'"></td><td><input required type="text" name="return_qty[]" id="return_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="hidden" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"><input disabled type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"></td><td><input hidden type="text" name="return_value[]" id="return_value_'+j+'" class="issue"  value=""><input disabled type="text" name="return_value1[]" id="return_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="remark_'+j+'" class="issue"  value=""></td> ';
                     str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.c_c_id+'" name="c_c_id[]" id="c_c_id'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input style="width:80px;" disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td>';
                     str +='<td><input type="hidden" name="item_name_des[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_des+'"><input style="width:150px;" disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_des+'"></td>';
                     str +='<td><input type="hidden" name="m_unit[]" id="unit_'+j+'" class="issue" value="'+v.m_unit+'"><input style="width:100px;" disabled type="text" name="issue_m_unit1[]" id="unit1_'+j+'" class="issue" value="'+v.m_unit+'"></td>';
                     str +='<td><input type="hidden" required style="width:40px;" type="text" name="issued_qty[]" id="issue_qty_'+j+'" class="issue"  value="'+issue_qty+'"><input disabled style="width:40px;" type="text" name="issued_qty1[]" id="issue_qty1_'+j+'" class="issue"  value="'+issue_qty+'"></td>';
                     str +='<td><input required style="width:40px;" type="text" name="receive_qty[]" id="receive_qty_'+j+'" class="issue"  value="" onkeyup="calculateTotal('+j+')" ></td>'; 
                     str +='<td><input style="width:100px;" type="text" name="remark[]" id="item_remark_'+j+'" class="issue"  value=""></td> ';
                     
                     str +="</tr>";
                       
                 });
                 str +="</tbody>";
                 $('#myTable').html(str);
                 $("#item_count").val(j);
                // $('#item_1').html(str);
                // $('.selectpicker').selectpicker('refresh');
             }
                
               
            
        })
    }  
    
    

   $('#button1').live('click',function (){
       // alert('test');
        var count = $('#item_count').val();
          var issue_no= $('#issue_no').val();
        var data = {'a_issue_id': issue_no};
          $.ajax({
            url: '<?php echo site_url('general_store/asset_issue_info_details'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
              //  alert('test');
              var count = Number($('#item_count').val());
              var add_item_number=count+1;
              var j=0;
               
                 $(msg.issue_details).each(function (i, v) {
                     var issue_qty=Number(v.issue_qty)-Number(v.receive_qty);
                     j++;
                     if(j==add_item_number){
                       var str='<tr class="row" id="row_'+j+'" >';
                       
                       str +='<td><button id="button2" onclick="removeRow(' + j + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
                         
                  //    str +='<td><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_name_des+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_des+'"></td><td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.issue_m_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.issue_m_unit+'"></td><td><input type="hidden" name="issued_qty[]" id="issued_qty_'+j+'" class="issue" value="'+v.issue_quality+'"><input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+v.issue_quality+'"></td><td><input type="text" name="return_qty[]" id="return_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="hidden" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"><input disabled type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"></td><td><input hidden type="text" name="return_value[]" id="return_value_'+j+'" class="issue"  value=""><input disabled type="text" name="return_value1[]" id="return_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="remark_'+j+'" class="issue"  value=""></td> ';
                   //   str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.asset_id+'" name="asset_id[]" id="asset_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_name_des+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_des+'"></td><td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.issue_m_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.issue_m_unit+'"></td><td><input type="hidden" name="issued_qty[]" id="issued_qty_'+j+'" class="issue" value="'+v.issue_quality+'"><input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+v.issue_quality+'"></td><td><input required type="text" name="return_qty[]" id="return_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="hidden" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"><input disabled type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"></td><td><input hidden type="text" name="return_value[]" id="return_value_'+j+'" class="issue"  value=""><input disabled type="text" name="return_value1[]" id="return_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="remark_'+j+'" class="issue"  value=""></td> ';
                      str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.c_c_id+'" name="c_c_id[]" id="c_c_id'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input style="width:80px;" disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td>';
                     str +='<td><input type="hidden" name="item_name_des[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_des+'"><input style="width:150px;" disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_des+'"></td>';
                     str +='<td><input type="hidden" name="m_unit[]" id="unit_'+j+'" class="issue" value="'+v.m_unit+'"><input style="width:100px;" disabled type="text" name="issue_m_unit1[]" id="unit1_'+j+'" class="issue" value="'+v.m_unit+'"></td>';
                     str +='<td><input type="hidden" required style="width:40px;" type="text" name="issued_qty[]" id="issue_qty_'+j+'" class="issue"  value="'+issue_qty+'"><input disabled style="width:40px;" type="text" name="issued_qty[]" id="issue_qty_'+j+'" class="issue"  value="'+issue_qty+'"></td>';
                     str +='<td><input required style="width:40px;" type="text" name="receive_qty[]" id="receive_qty_'+j+'" class="issue"  value="" onkeyup="calculateTotal('+j+')"  ></td>'; 
                     str +='<td><input style="width:100px;" type="text" name="remark[]" id="item_remark_'+j+'" class="issue"  value=""></td> ';
                     
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