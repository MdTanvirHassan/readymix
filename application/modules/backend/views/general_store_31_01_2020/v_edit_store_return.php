<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--            <h2 style="text-align:center; "> Return</h2>
            <hr>-->
<div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Return</h3>
            </div>
        </div>
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
            <form class="form-horizontal" method="post" action="<?php echo site_url('general_store/edit_action_store_return/'.$return_receive[0]['rr_id']) ?>">
                
              <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                           Return No.:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input  class="form-control" id="inputdefault" name="rr_status" value="<?php if(!empty($return_receive[0]['rr_status'])) echo $return_receive[0]['rr_status']; ?>" type="hidden">
                                <input disabled class="form-control" id="inputdefault" name="ir_no" type="text" value="<?php if(!empty($return_receive[0]['rr_no'])) echo $return_receive[0]['rr_no']; ?>">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                               Return Date<span class="required">*</span> :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input required class="form-control datepicker" name="rr_date"  type="text" value="<?php if(!empty($return_receive[0]['rr_date'])) echo date('d-m-Y',strtotime($return_receive[0]['rr_date'])); ?>">
                        </div>
                             
                         </div>  
                
                <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                           Receive No.:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <select required id="receive_no" class="form-control" name="receive_no" onchange="javascript:receive_item_info()">
                                    <option value="">Select Receive No</option>
                                    <?php foreach($receive_numbers as $receive_number){ ?>
                                        <option <?php if(!empty($return_receive[0]['receive_no']) && $return_receive[0]['receive_no']==$receive_number['mrr_id'] ) echo 'selected'; ?> value="<?php echo $receive_number['mrr_id'];  ?>"><?php if(!empty($receive_number['mrr_no'])) echo $receive_number['mrr_no']; ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                               Date<span class="required">*</span> :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input required id="receive_date" class="form-control datepicker" name="receive_date" type="text" value="<?php if(!empty($return_receive[0]['receive_date'])) echo date('d-m-Y',strtotime($return_receive[0]['receive_date'])); ?>">
                        </div>
                             
                         </div>
                
                <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                           Remarks:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input class="form-control" name="remarks" type="text" value="<?php if(!empty($return_receive[0]['remarks'])) echo $return_receive[0]['remarks']; ?>">
                        </div>
                             
                             
                         </div>
                
                
<!--                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Return No.:</label></div>
                            <div class="col-sm-8 col-md-5 ">
                               
                                <input disabled class="form-control" id="inputdefault" name="ir_no" type="text" value="<?php if(!empty($return_receive[0]['rr_no'])) echo $return_receive[0]['rr_no']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Return Date :</label></div>
                             <div class="col-sm-8 col-md-5 "><input required class="form-control datepicker" name="rr_date"  type="text" value="<?php if(!empty($return_receive[0]['rr_date'])) echo date('d-m-Y',strtotime($return_receive[0]['rr_date'])); ?>"></div>
                        </div>
                    </div>
                </div>-->
                
<!--                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Receive No. :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                               
                                <select required id="receive_no" class="form-control" name="receive_no" onchange="javascript:receive_item_info()">
                                    <option value="">Select Receive No</option>
                                    <?php foreach($receive_numbers as $receive_number){ ?>
                                        <option <?php if(!empty($return_receive[0]['receive_no']) && $return_receive[0]['receive_no']==$receive_number['mrr_id'] ) echo 'selected'; ?> value="<?php echo $receive_number['mrr_id'];  ?>"><?php if(!empty($receive_number['mrr_no'])) echo $receive_number['mrr_no']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"<label for="inputdefault">Date :</label></div>
                             <div class="col-sm-8 col-md-5 "><input required id="receive_date" class="form-control datepicker" name="receive_date" type="text" value="<?php if(!empty($return_receive[0]['receive_date'])) echo date('d-m-Y',strtotime($return_receive[0]['receive_date'])); ?>"></div>
                        </div>
                    </div>
                </div>-->

<!--                <div class="row">
                  
                    <div class="col-md-6">
                          <div class="form-group row">
                                <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Remarks :</label></div>
                                <div class="col-sm-8 col-md-5 "><input class="form-control" name="remarks" type="text" value="<?php if(!empty($return_receive[0]['remarks'])) echo $return_receive[0]['remarks']; ?>"></div>
                          </div>     
                    </div>
                </div>-->
                
                
                
<br>  
            <h2 style="text-align:center; ">Item List & information</h2>
             <hr>
             <?php
                $material_receive=count($items);
                $material_receive_return=count($return_receive_details);
             ?>
      <?php if (!empty($return_receive_details)) { ?> 
              
             <input type="hidden" id="item_count" value="<?php echo count($return_receive_details); ?>"/>
            <input type="hidden" id="count" value="<?php echo count($return_receive_details); ?>"/>
             <table class="table table-bordered" id="myTable">
                <thead>
           
                  <tr class="row">
                      <th><button style="margin-left:5px;display:<?php if($material_receive==$material_receive_return) echo "none"; ?>" type="button" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   </th>
                    <th>Item Code</th>
                    <th>Item Description</th>
                    <th>MU</th>
                    <th>Received Qty</th>
                    <th>Return Qty</th>
                    <th>Unit Price</th>
                    <th>Return Value</th>       
                    <th>Remark</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i = 0;
                        foreach ($return_receive_details as $return_receive_detail) {
                            $i++; ?> 
                   <tr class="row" id="row_<?php echo $i; ?>">
                       <?php if ($i > 1) { ?>
                                <td><button id="button2" onclick="removeRow('<?php echo $i; ?>')" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-minus"></span></button></td>
                            <?php } else { ?>
                                <td></td>
                                    <?php } ?>
                       <td> 
                           <input type="hidden" value="<?php if(!empty($return_receive_detail['c_c_id'])) echo $return_receive_detail['c_c_id']; ?>" name="c_c_id[]" id="c_c_id_<?php echo $i; ?>" class="issue">
                           <input type="hidden" value="<?php if(!empty($return_receive_detail['department_id'])) echo $return_receive_detail['department_id']; ?>" name="department_id[]" id="department_id_<?php echo $i; ?>" class="issue">
                           <input type="hidden" value="<?php if(!empty($return_receive_detail['asset_id'])) echo $return_receive_detail['asset_id']; ?>" name="asset_id[]" id="asset_id_<?php echo $i; ?>" class="issue">
                           <input type="hidden" value="<?php if(!empty($return_receive_detail['item_id'])) echo $return_receive_detail['item_id']; ?>" name="item_id[]" id="item_<?php echo $i; ?>" class="issue">
                           <input  type="hidden" value="<?php if(!empty($return_receive_detail['item_code'])) echo $return_receive_detail['item_code']; ?>" name="item_code[]" id="item_code_<?php echo $i; ?>" class="issue">
                           <input disabled type="text" value="<?php if(!empty($return_receive_detail['item_code'])) echo $return_receive_detail['item_code']; ?>" name="item_name_code[]" id="item_name_code_<?php echo $i; ?>" class="issue">
                       </td>
                    <td><input id="item_des_<?php echo $i; ?>" type="hidden" name="item_description[]" value="<?php if (!empty($return_receive_detail['item_description'])) echo $return_receive_detail['item_description']; ?>" class="issue"><input disabled id="item_des1_<?php echo $i; ?>" type="text" name="item_name_des1[]" value="<?php if (!empty($return_receive_detail['item_description'])) echo $return_receive_detail['item_description']; ?>" class="issue"></td>
                   <td><input id="unit_<?php echo $i; ?>" type="hidden" name="measurement_unit[]" value="<?php if (!empty($return_receive_detail['measurement_unit'])) echo $return_receive_detail['measurement_unit']; ?>" class="issue"><input disabled id="unit1_<?php echo $i; ?>" type="text" name="issue_m_unit1[]" value="<?php if (!empty($return_receive_detail['measurement_unit'])) echo $return_receive_detail['measurement_unit']; ?>" class="issue"></td>
                   <td><input id="issued_qty<?php echo $i; ?>" type="hidden" name="receive_qty[]" value="<?php if (!empty($return_receive_detail['receive_qty'])) echo $return_receive_detail['receive_qty']; ?>" class="issue"><input disabled id="indent_qty1_<?php echo $i; ?>" type="text" name="indent_qty1[]" value="<?php if (!empty($return_receive_detail['receive_qty'])) echo $return_receive_detail['receive_qty']; ?>" class="issue"></td>
                   <td><input required id="return_qty_<?php echo $i; ?>" type="text" name="return_qty[]" value="<?php if (!empty($return_receive_detail['return_qty'])) echo $return_receive_detail['return_qty']; ?>" onkeyup="calculateTotal(<?php echo $i; ?>)" class="issue"></td>
                   <td><input id="unit_price_<?php echo $i; ?>" type="hidden" name="unit_price[]" value="<?php if (!empty($return_receive_detail['unit_price'])) echo $return_receive_detail['unit_price']; ?>"  class="issue"><input disabled id="unit_price_<?php echo $i; ?>" type="text" name="unit_price[]" value="<?php if (!empty($return_receive_detail['unit_price'])) echo $return_receive_detail['unit_price']; ?>"  class="issue"></td>
                 
                   <td><input id="return_value_<?php echo $i; ?>"  type="hidden" name="return_value[]" value="<?php if (!empty($return_receive_detail['return_value'])) echo $return_receive_detail['return_value']; ?>" class="issue"><input disabled id="return_value1_<?php echo $i; ?>"  type="text" name="issue_value1[]" value="<?php if (!empty($return_receive_detail['return_value'])) echo $return_receive_detail['return_value']; ?>" class="issue"></td>
              
                   <td><input type="text" name="remark[]" value="<?php if (!empty($return_receive_detail['remark'])) echo $return_receive_detail['remark']; ?>" class="issue"></td>

                  </tr>
            <?php } ?>
                  </tbody>
              </table>
<?php } ?>            
  <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-10">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">UPDATE</button>
                    </div>
                     <div class="col-md-2">
                        <a href="<?php echo site_url('backend/general_store/store_return') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
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
        </div>
        </div>
        </div>
        </div>
        </div>

<script>
   
    function calculateTotal(id){

        var net_price;
        var r_quantity = $('#return_qty_'+id).val();
       
        var unit_price = $('#unit_price_'+id).val();
      
        
       
        if(r_quantity!='' && unit_price!=''){
            net_price=(Number(r_quantity)*Number(unit_price));
        }else{
            net_price='';
        }
       $('#return_value_'+id).val(net_price);
       $('#return_value1_'+id).val(net_price);
    }
    
    
      
    
    
   function receive_item_info(){
        //  alert('test');
       var receive_no= $('#receive_no').val();
       var data = {'receive_no': receive_no}
        $.ajax({
            url: '<?php echo site_url('general_store/receive_info_details'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
            //    alert('test');
             var j=0;
                $('#receive_date').val(msg.receive[0].date);
                
                 var str = '<thead> <tr class="row"><th><button style="margin-left:5px;display:none"  type="button" id="button1" class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span></button>   </th><th>Item Code</th><th>Item Description</th>  <th>MU</th><th>Received Qty</th><th>Return Qty</th><th>Unit Price</th><th>Return Value </th><th>Remark</th></tr></thead><tbody>';
                 $(msg.receive_details).each(function (i, v) {
                  //   alert('test');
                     j++;
                       str +='<tr class="row" id="row_'+j+'" >';
                       if(j==1){
                            str +='<td></td>';
                       }else{
                            str +='<td><button id="button2" onclick="removeRow(' + j + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
                       }    
                     //  str +='<td><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_description+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_description+'"></td><td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.measurement_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.measurement_unit+'"></td><td><input type="hidden" name="receive_qty[]" id="receive_qty_'+j+'" class="issue" value="'+v.receive_qty+'"><input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+v.receive_qty+'"></td><td><input type="text" name="return_qty[]" id="return_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="hidden" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.unit_price+'"><input disabled type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.unit_price+'"></td><td><input hidden type="text" name="return_value[]" id="return_value_'+j+'" class="issue"  value=""><input disabled type="text" name="return_value1[]" id="return_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="remark_'+j+'" class="issue"  value=""></td> ';
                      str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.c_c_id+'" name="c_c_id[]" id="c_c_id_'+j+'" class="issue"><input type="hidden" value="'+v.asset_id+'" name="asset_id[]" id="asset_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_description+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_description+'"></td><td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.measurement_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.measurement_unit+'"></td><td><input type="hidden" name="receive_qty[]" id="receive_qty_'+j+'" class="issue" value="'+v.receive_qty+'"><input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+v.receive_qty+'"></td><td><input required type="text" name="return_qty[]" id="return_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="hidden" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.unit_price+'"><input disabled type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.unit_price+'"></td><td><input hidden type="text" name="return_value[]" id="return_value_'+j+'" class="issue"  value=""><input disabled type="text" name="return_value1[]" id="return_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="remark_'+j+'" class="issue"  value=""></td> ';
                     
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
        var receive_no= $('#receive_no').val();
        var data = {'receive_no': receive_no}
          $.ajax({
            url: '<?php echo site_url('general_store/receive_info_details'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
              //  alert('test');
              var count = Number($('#item_count').val());
              var add_item_number=count+1;
              var j=0;
               
                 $(msg.receive_details).each(function (i, v) {
                     j++;
                     if(j==add_item_number){
                       var str='<tr class="row" id="row_'+j+'" >';
                       
                       str +='<td><button id="button2" onclick="removeRow(' + j + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
                         
                 //     str +='<td><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_description+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_description+'"></td><td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.measurement_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.measurement_unit+'"></td><td><input type="hidden" name="receive_qty[]" id="receive_qty_'+j+'" class="issue" value="'+v.receive_qty+'"><input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+v.receive_qty+'"></td><td><input type="text" name="return_qty[]" id="return_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="hidden" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.unit_price+'"><input disabled type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.unit_price+'"></td><td><input hidden type="text" name="return_value[]" id="return_value_'+j+'" class="issue"  value=""><input disabled type="text" name="return_value1[]" id="return_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="remark_'+j+'" class="issue"  value=""></td> ';
                      str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.c_c_id+'" name="c_c_id[]" id="c_c_id_'+j+'" class="issue"><input type="hidden" value="'+v.asset_id+'" name="asset_id[]" id="asset_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_description+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_description+'"></td><td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.measurement_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.measurement_unit+'"></td><td><input type="hidden" name="receive_qty[]" id="receive_qty_'+j+'" class="issue" value="'+v.receive_qty+'"><input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+v.receive_qty+'"></td><td><input required type="text" name="return_qty[]" id="return_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="hidden" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.unit_price+'"><input disabled type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.unit_price+'"></td><td><input hidden type="text" name="return_value[]" id="return_value_'+j+'" class="issue"  value=""><input disabled type="text" name="return_value1[]" id="return_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="remark_'+j+'" class="issue"  value=""></td> ';
                     
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