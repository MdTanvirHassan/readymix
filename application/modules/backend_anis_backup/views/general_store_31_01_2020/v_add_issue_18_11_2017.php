<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; ">Add Issue Info</h2>
            <hr>
            <div class="row">
             <!--    <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   -->
            </div>
            <form method="post" action="<?php echo site_url('general_store/add_action_issue_session') ?>">
               
             <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Issue NO.:</label></div>
                            <div class="col-sm-8 col-md-7 ">
                             <!--
                                <input class="form-control" name="issue_no" type="text" value="<?php if(!empty($issue_no)) echo $issue_no; ?>">
                             -->
                                
                                <input class="form-control" id="" name="issue_code" type="hidden" value="<?php if(!empty($issue_code)) echo $issue_code; ?>">
                                <input class="form-control" id="" name="issue_no" type="hidden" value="<?php if(!empty($issue_auto_code)) echo "ISS".$issue_auto_code; ?>">
                                <input disabled class="form-control" id="" name="issue_no1" type="text" value="<?php if(!empty($issue_auto_code)) echo "ISS".$issue_auto_code; ?>">
                               
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Date :</label></div>
                            <div class="col-sm-8 col-md-7 "><input required class="form-control datepicker" name="issue_date" type="text" value="<?php echo date('d-m-Y'); ?>"></div>
                        </div>
                    </div>
                </div>
                
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">SR/Indent:</label></div>
                            <div class="col-sm-8 col-md-7 ">
                                <!--
                                <input class="form-control" name="issue_note" type="text">
                                -->
                                 <select required id="mrr_ipo_no" class="form-control" name="issue_ipo_no"  onchange="javascript:indent_info();">
                                    <option value="">Select Indent</option>
                                    <?php foreach($indents as $indent){ ?>
                                        <option value="<?php echo $indent['ipo_m_id'];  ?>"><?php if(!empty($indent['ipo_number'])) echo $indent['ipo_number']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Project :</label></div>
                             <div class="col-sm-8 col-md-7 "><input required id="dep_name" class="form-control " name="dep_name" type="text"></div>
                        </div>
                    </div>
                 
                </div>
                <div class="row">
                    <!--
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">DEPT/Section :</label></div>
                            <div class="col-sm-8 col-md-7 "> <select class="form-control" name="dep_id">
                                    <option value="">Select Department</option>
                                    <?php foreach($departments as $department){ ?>
                                        <option value="<?php echo $department['d_id'];  ?>"><?php if(!empty($department['dep_code'])) echo $department['dep_code']; ?></option>
                                    <?php } ?>
                                </select></div>
                        </div>
                    </div>
                    -->
                      <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Date :</label></div>
                             <div class="col-sm-8 col-md-7 "><input required id="issue_ipo_date" class="form-control datepicker" name="issue_ipo_date" type="text"></div>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Issue Type:</label></div>
                            <div class="col-sm-8 col-md-7 ">
                                <!--
                                <input class="form-control" name="issue_note" type="text">
                                -->
                                 <select id="issue_type" class="form-control" name="issue_type"  onchange="javascript:issue_type_info();">
                                  
                                        <option value="general">General</option>
                                        <!--  <option value="returnable">Returnable</option> -->
                                        <option value="delivery">Delivery</option>
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    
                  
                    
                    
                </div>
               
                <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Remarks :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" name="isssue_remark" type="text"></div>
                        </div>    
                    </div>
                    
                      <div class="col-md-6">
                        <div class="form-group row" id="delivey" style="display:none;">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Delivery No :</label></div>
                            <div class="col-sm-8 col-md-7 "><input id="delivery_no" class="form-control" name="delivery_no" type="text"></div>
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
        <th>Indent Qnt</th>
        <th>Stock Qnt</th>
        <th>MRR Qnt</th>
        <th>Issue Qnt</th>
        <th>Unit Price</th>
        <th>Issue value</th>
      
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
        <td><input style="width:100px;" type="text" name="issue_m_unit[]" id="unit_1" class="issue"></td>
        <td><input style="width:40px;" type="text" name="indent_qty[]" class="issue"></td>
        <td><input style="width:40px;" type="text" name="stock_qty[]" class="issue"></td>
        <td><input style="width:40px;" type="text" name="mrr_qty[]" class="issue"></td>
        <td><input required style="width:40px;" type="text" name="issue_quality[]" class="issue"></td>
        <td><input required style="width:60px;" type="text" name="issue_unit_price[]" class="issue"></td>
        <td><input style="width:80px;" type="text" name="issue_value[]" class="issue"></td>
       
        <td><input style="width:100px;" type="text" name="issue_d_remark[]" class="issue"></td>
        
      </tr>
      </tbody>
  </table>
  <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-10">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">SAVE</button>
                    </div>
                     <div class="col-md-2">
                        <a href="<?php echo site_url('backend/general_store/issue_session') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
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
        var mrr_quantity = Number($('#mrr_qty_'+id).val());
        var unit_price = $('#unit_price_'+id).val(); 
//        if(issue_quantity>stock_quantity || issue_quantity>indent_quantity || issue_quantity>mrr_quantity ){
//           
//             $('#issue_qty_'+id).val('');
//        }
         if(issue_quantity>stock_quantity || issue_quantity>indent_quantity){
           
             $('#issue_qty_'+id).val('');
        }
        var issue_quantity = Number($('#issue_qty_'+id).val());
        if(issue_quantity!='' && unit_price!='' ){
           
            net_price=Number(issue_quantity)*Number(unit_price);
        }else{
            net_price='';
        }
       $('#issue_value_'+id).val(net_price);
       $('#issue_value1_'+id).val(net_price);
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
       var mrr_indent_no= $('#mrr_ipo_no').val();
       var data = {'mrr_indent_no': mrr_indent_no}
        $.ajax({
            url: '<?php echo site_url('general_store/issue_indent_info_details'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
            //    alert('test');
             var j=0;
                $('#issue_ipo_date').val(msg.indent[0].date);
                $('#dep_name').val(msg.indent[0].dep_description);
                
               //  var str = '<thead> <tr class="row"><th><button style="margin-left:5px;display:none"  type="button" id="button1" class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span></button>   </th><th>Item Code</th><th>Item Description</th>  <th>MU</th><th>Indent Qty</th><th>Stock Qty</th><th>Mrr Qty</th><th>Issue Qty</th><th>Unit Price</th><th>Issue Value </th><th>Remark</th></tr></thead><tbody>';
                 var str = '<thead> <tr class="row"><th>Item Code</th><th>Item Description</th>  <th>MU</th><th>Indent Qnt</th><th>Stock Qnt</th><th>MRR Qnt</th><th>Issue Qnt</th><th>Unit Price</th><th>Issue Value </th><th>Remark</th></tr></thead><tbody>';
              
                 $(msg.indent_details).each(function (i, v) {
                     var indent_qty=Number(v.indent_qty)-Number(v.issued_qty);
                     j++;
                       str +='<tr class="row" id="row_'+j+'" >';
//                       if(j==1){
//                            str +='<td></td>';
//                       }else{
//                            str +='<td><button id="button2" onclick="removeRow(' + j + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
//                       }    
                   //    str +='<td><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_name_des[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_description+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_description+'"></td><td><input type="hidden" name="issue_m_unit[]" id="unit_'+j+'" class="issue" value="'+v.unit+'"><input disabled type="text" name="issue_m_unit1[]" id="unit1_'+j+'" class="issue" value="'+v.unit+'"></td><td><input type="hidden" name="indent_qty[]" id="indent_qty_'+j+'" class="issue" value="'+v.indent_qty+'"><input disabled type="text" name="indent_qty1[]" id="indent_qty1_'+j+'" class="issue" value="'+v.indent_qty+'"></td><td><input type="hidden" name="stock_qty[]" id="stock_qty_'+j+'" class="issue" value="'+v.stock_qty+'"><input disabled type="text" name="stock_qty1[]" id="stock_qty1_'+j+'" class="issue" value="'+v.stock_qty+'"></td><td><input type="text" name="issue_qty[]" id="issue_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="text" name="issue_unit_price[]" id="unit_price_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input hidden type="text" name="issue_value[]" id="issue_value_'+j+'" class="issue"  value=""><input disabled type="text" name="issue_value1[]" id="issue_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="issue_d_remark[]" id="item_remark_'+j+'" class="issue"  value=""></td> ';
                   //   str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.asset_id+'" name="asset_id[]" id="asset_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_name_des[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_description+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_description+'"></td><td><input type="hidden" name="issue_m_unit[]" id="unit_'+j+'" class="issue" value="'+v.unit+'"><input disabled type="text" name="issue_m_unit1[]" id="unit1_'+j+'" class="issue" value="'+v.unit+'"></td><td><input type="hidden" name="indent_qty[]" id="indent_qty_'+j+'" class="issue" value="'+v.indent_qty+'"><input disabled type="text" name="indent_qty1[]" id="indent_qty1_'+j+'" class="issue" value="'+v.indent_qty+'"></td><td><input type="hidden" name="stock_qty[]" id="stock_qty_'+j+'" class="issue" value="'+v.stock_qty+'"><input disabled type="text" name="stock_qty1[]" id="stock_qty1_'+j+'" class="issue" value="'+v.stock_qty+'"></td><td><input type="text" name="issue_qty[]" id="issue_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="text" name="issue_unit_price[]" id="unit_price_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input hidden type="text" name="issue_value[]" id="issue_value_'+j+'" class="issue"  value=""><input disabled type="text" name="issue_value1[]" id="issue_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="issue_d_remark[]" id="item_remark_'+j+'" class="issue"  value=""></td> ';
                     str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.asset_id+'" name="asset_id[]" id="asset_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input style="width:80px;" disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td>';
                     str +='<td><input type="hidden" name="item_name_des[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_description+'"><input style="width:100px;" disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_description+'"></td>';
                     str +='<td><input type="hidden" name="issue_m_unit[]" id="unit_'+j+'" class="issue" value="'+v.unit+'"><input style="width:100px;" disabled type="text" name="issue_m_unit1[]" id="unit1_'+j+'" class="issue" value="'+v.unit+'"></td>';
                     str +='<td><input type="hidden" name="indent_qty[]" id="indent_qty_'+j+'" class="issue" value="'+indent_qty+'"><input style="width:40px;" disabled type="text" name="indent_qty1[]" id="indent_qty1_'+j+'" class="issue" value="'+indent_qty+'"></td>';
                     str +='<td><input type="hidden" name="stock_qty[]" id="stock_qty_'+j+'" class="issue" value="'+v.stock_qty+'"><input style="width:40px;" disabled type="text" name="stock_qty1[]" id="stock_qty1_'+j+'" class="issue" value="'+v.stock_qty+'"></td>';
                     str +='<td><input type="hidden" name="mrr_qty[]" id="mrr_qty_'+j+'" class="issue" value="'+v.receive_qty+'"><input style="width:40px;" disabled type="text" name="mrr_qty1[]" id="mrr_qty1_'+j+'" class="issue" value="'+v.receive_qty+'"></td>';
                     str +='<td><input required style="width:40px;" type="text" name="issue_qty[]" id="issue_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td>';
                     str +=' <td><input required style="width:60px;" type="text" name="issue_unit_price[]" id="unit_price_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="'+v.current_rate+'"></td>';
                     str +='<td><input hidden type="text" name="issue_value[]" id="issue_value_'+j+'" class="issue"  value=""><input style="width:100px;" disabled type="text" name="issue_value1[]" id="issue_value1_'+j+'" class="issue"  value=""></td>';
                     str +='<td><input style="width:100px;" type="text" name="issue_d_remark[]" id="item_remark_'+j+'" class="issue"  value=""></td> ';
                     
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
        var mrr_indent_no= $('#mrr_ipo_no').val();
        var data = {'mrr_indent_no': mrr_indent_no};
          $.ajax({
            url: '<?php echo site_url('general_store/indent_info_details'); ?>',
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
                       
                       str +='<td><button id="button2" onclick="removeRow(' + j + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
                         
                    // str +='<td><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_name_des[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_description+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_description+'"></td><td><input type="hidden" name="issue_m_unit[]" id="unit_'+j+'" class="issue" value="'+v.unit+'"><input disabled type="text" name="issue_m_unit1[]" id="unit1_'+j+'" class="issue" value="'+v.unit+'"></td><td><input type="hidden" name="indent_qty[]" id="indent_qty_'+j+'" class="issue" value="'+v.indent_qty+'"><input disabled type="text" name="indent_qty1[]" id="indent_qty1_'+j+'" class="issue" value="'+v.indent_qty+'"></td><td><input type="hidden" name="stock_qty[]" id="stock_qty_'+j+'" class="issue" value="'+v.stock_qty+'"><input disabled type="text" name="stock_qty1[]" id="stock_qty1_'+j+'" class="issue" value="'+v.stock_qty+'"></td><td><input type="text" name="issue_qty[]" id="issue_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="text" name="issue_unit_price[]" id="unit_price_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input hidden type="text" name="issue_value[]" id="issue_value_'+j+'" class="issue"  value=""><input disabled type="text" name="issue_value1[]" id="issue_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="issue_d_remark[]" id="item_remark_'+j+'" class="issue"  value=""></td> ';
                       str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.asset_id+'" name="asset_id[]" id="asset_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_name_des[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_description+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_description+'"></td><td><input type="hidden" name="issue_m_unit[]" id="unit_'+j+'" class="issue" value="'+v.unit+'"><input disabled type="text" name="issue_m_unit1[]" id="unit1_'+j+'" class="issue" value="'+v.unit+'"></td><td><input type="hidden" name="indent_qty[]" id="indent_qty_'+j+'" class="issue" value="'+v.indent_qty+'"><input disabled type="text" name="indent_qty1[]" id="indent_qty1_'+j+'" class="issue" value="'+v.indent_qty+'"></td><td><input type="hidden" name="stock_qty[]" id="stock_qty_'+j+'" class="issue" value="'+v.stock_qty+'"><input disabled type="text" name="stock_qty1[]" id="stock_qty1_'+j+'" class="issue" value="'+v.stock_qty+'"></td><td><input required type="text" name="issue_qty[]" id="issue_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input required type="text" name="issue_unit_price[]" id="unit_price_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input hidden type="text" name="issue_value[]" id="issue_value_'+j+'" class="issue"  value=""><input disabled type="text" name="issue_value1[]" id="issue_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="issue_d_remark[]" id="item_remark_'+j+'" class="issue"  value=""></td> ';
                     
                     
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

