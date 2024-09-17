<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; ">Details Asset Issue Return Receive</h2>
            <hr>
            <a href="<?php echo site_url('general_store/add_asset_issue_receive'); ?>" class="btn btn-sm btn-primary">ADD ISSUE RECEIVE</a>
            <?php if($issue_return[0]['a_ir_status']=="pending"){ ?>
                 <a href="<?php echo site_url('general_store/edit_asset_issue_receive/'.$issue_return[0]['a_ir_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
            <?php }else { ?>
                  <button class="btn btn-sm btn-info">Edit</button>
            <?php } ?>
             <?php if($issue_return[0]['a_ir_status']=="pending"){ ?>
                <a href="<?php echo site_url('general_store/receive_asset_issue_receive/'.$issue_return[0]['a_ir_id']); ?>"><button class="btn btn-sm btn-success">Receive</button></a>
            <?php } ?>
             
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
            <form method="post" action="<?php echo site_url('general_store/edit_action_issue_return/'.$issue_return[0]['ir_id']) ?>">
                  <input  class="form-control" id="inputdefault" name="ir_status" value="<?php if(!empty($issue_return[0]['ir_status'])) echo $issue_return[0]['ir_status']; ?>" type="hidden">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">AIR No.:</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                
                                <input disabled class="form-control" id="inputdefault" name="ir_no" type="text" value="<?php if(!empty($issue_return[0]['a_ir_no'])) echo $issue_return[0]['a_ir_no']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Receive Date :</label></div>
                            <div class="col-sm-8 col-md-5 "><input disabled required class="form-control datepicker" name="a_ir_date"  type="text" value="<?php if(!empty($issue_return[0]['a_ir_date'])) echo date('d-m-Y',strtotime($issue_return[0]['a_ir_date'])); ?>"></div>
                        </div>
                    </div>
                </div>
                
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Issue No. :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                               
                                <select disabled required id="issue_no" class="form-control" name="issue_no" onchange="javascript:issue_item_info()">
                                    <option value="">Select Issue No</option>
                                    <?php foreach($issue_numbers as $issue_number){ ?>
                                        <option <?php if(!empty($issue_return[0]['a_issue_id']) && $issue_return[0]['a_issue_id']== $issue_number['a_issue_id'] ) echo "selected"; ?> value="<?php echo $issue_number['a_issue_id'];  ?>"><?php if(!empty($issue_number['a_issue_no'])) echo $issue_number['a_issue_no']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Issue Date :</label></div>
                            <div class="col-sm-8 col-md-5 "><input disabled required id="issue_date" class="form-control datepicker" name="a_issue_date" type="text" value="<?php if(!empty($issue_return[0]['a_issue_date'])) echo date('d-m-Y',strtotime($issue_return[0]['a_issue_date'])); ?>"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                  
                    <div class="col-md-6">
                        <div class="form-group row">
                                <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Remarks :</label></div>
                                <div class="col-sm-8 col-md-5 "><input disabled class="form-control" name="remarks" type="text" value="<?php if(!empty($issue_return[0]['remarks'])) echo $issue_return[0]['remarks']; ?>"></div>
                        </div>       
                    </div>
                </div>
                
                
                
                
            <h2 style="text-align:center; ">Item List & information</h2>
             <hr>
              <?php
                $material_issue=count($items);
                $material_issue_return=count($issue_return_details);
             ?>
      <?php if (!empty($issue_return_details)) { ?> 
              
             <input type="hidden" id="item_count" value="<?php echo count($issue_return_details); ?>"/>
            <input type="hidden" id="count" value="<?php echo count($issue_return_details); ?>"/>
             <table class="table table-bordered" id="myTable">
                <thead>
           
                  <tr class="row">
                     
                    <th>Item Code</th>
                    <th>Item Description</th>
                    <th>MU</th>
                    <th>Issued Qty</th>
                    <th>Receive Qty</th>
                   
                    <th>Remark</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i = 0;
                        foreach ($issue_return_details as $issue_return_detail) {
                            $i++; ?> 
                   <tr class="row" id="row_<?php echo $i; ?>">
                    
                       <td> 
                        
                           <input type="hidden" value="<?php if(!empty($issue_return_detail['department_id'])) echo $issue_return_detail['department_id']; ?>" name="department_id[]" id="department_id_<?php echo $i; ?>" class="issue">
                           <input type="hidden" value="<?php if(!empty($issue_return_detail['c_c_id'])) echo $issue_return_detail['c_c_id']; ?>" name="asset_id[]" id="asset_id_<?php echo $i; ?>" class="issue">
                           <input type="hidden" value="<?php if(!empty($issue_return_detail['item_id'])) echo $issue_return_detail['item_id']; ?>" name="item_id[]" id="item_<?php echo $i; ?>" class="issue">
                           <input  type="hidden" value="<?php if(!empty($issue_return_detail['item_code'])) echo $issue_return_detail['item_code']; ?>" name="item_code[]" id="item_code_<?php echo $i; ?>" class="issue">
                           <input disabled type="text" value="<?php if(!empty($issue_return_detail['item_code'])) echo $issue_return_detail['item_code']; ?>" name="item_name_code[]" id="item_name_code_<?php echo $i; ?>" class="issue">
                       </td>
                   <td><input id="item_des_<?php echo $i; ?>" type="hidden" name="item_name_des[]" value="<?php if (!empty($issue_return_detail['item_name_des'])) echo $issue_return_detail['item_name_des']; ?>" class="issue"><input disabled id="item_des1_<?php echo $i; ?>" type="text" name="item_name_des1[]" value="<?php if (!empty($issue_return_detail['item_name_des'])) echo $issue_return_detail['item_name_des']; ?>" class="issue"></td>
                   <td><input id="unit_<?php echo $i; ?>" type="hidden" name="m_unit[]" value="<?php if (!empty($issue_return_detail['m_unit'])) echo $issue_return_detail['m_unit']; ?>" class="issue"><input disabled id="unit1_<?php echo $i; ?>" type="text" name="issue_m_unit1[]" value="<?php if (!empty($issue_return_detail['m_unit'])) echo $issue_return_detail['m_unit']; ?>" class="issue"></td>
                   <td><input id="issued_qty<?php echo $i; ?>" type="hidden" name="issued_qty[]" value="<?php if (!empty($issue_return_detail['issued_qty'])) echo $issue_return_detail['issued_qty']; ?>" class="issue"><input disabled id="indent_qty1_<?php echo $i; ?>" type="text" name="indent_qty1[]" value="<?php if (!empty($issue_return_detail['issued_qty'])) echo $issue_return_detail['issued_qty']; ?>" class="issue"></td>
                   <td><input disabled required id="return_qty_<?php echo $i; ?>" type="text" name="receive_qty[]" value="<?php if (!empty($issue_return_detail['receive_qty'])) echo $issue_return_detail['receive_qty']; ?>" onkeyup="calculateTotal(<?php echo $i; ?>)" class="issue"></td>
                   
              
                   <td><input disabled type="text" name="remark[]" value="<?php if (!empty($issue_return_detail['remark'])) echo $issue_return_detail['remark']; ?>" class="issue"></td>

                  </tr>
            <?php } ?>
                  </tbody>
              </table>
<?php } ?>            
  <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-10">
                    
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
    
    
      
    
    
   function issue_item_info(){
        //  alert('test');
       var issue_no= $('#issue_no').val();
       var data = {'issue_no': issue_no}
        $.ajax({
            url: '<?php echo site_url('general_store/issue_info_details'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
            //    alert('test');
             var j=0;
                $('#issue_date').val(msg.indent[0].date);
                
                 var str = '<thead> <tr class="row"><th><button style="margin-left:5px;display:none"  type="button" id="button1" class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span></button>   </th><th>Item Code</th><th>Item Description</th>  <th>MU</th><th>Issued Qty</th><th>Receive Qty</th><th>Unit Price</th><th>Receive Value </th><th>Remark</th></tr></thead><tbody>';
                 $(msg.issue_details).each(function (i, v) {
                     j++;
                       str +='<tr class="row" id="row_'+j+'" >';
                       if(j==1){
                            str +='<td></td>';
                       }else{
                            str +='<td><button id="button2" onclick="removeRow(' + j + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
                       }    
                   //    str +='<td><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_name_des+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_des+'"></td><td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.issue_m_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.issue_m_unit+'"></td><td><input type="hidden" name="issued_qty[]" id="issued_qty_'+j+'" class="issue" value="'+v.issue_quality+'"><input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+v.issue_quality+'"></td><td><input type="text" name="return_qty[]" id="return_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="hidden" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"><input disabled type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"></td><td><input hidden type="text" name="return_value[]" id="return_value_'+j+'" class="issue"  value=""><input disabled type="text" name="return_value1[]" id="return_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="remark_'+j+'" class="issue"  value=""></td> ';
                      str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.asset_id+'" name="asset_id[]" id="asset_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_name_des+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_des+'"></td><td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.issue_m_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.issue_m_unit+'"></td><td><input type="hidden" name="issued_qty[]" id="issued_qty_'+j+'" class="issue" value="'+v.issue_quality+'"><input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+v.issue_quality+'"></td><td><input required type="text" name="return_qty[]" id="return_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="hidden" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"><input disabled type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"></td><td><input hidden type="text" name="return_value[]" id="return_value_'+j+'" class="issue"  value=""><input disabled type="text" name="return_value1[]" id="return_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="remark_'+j+'" class="issue"  value=""></td> ';
                     
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
        
        var data = {'issue_no': issue_no};
          $.ajax({
            url: '<?php echo site_url('general_store/issue_info_details'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
              //  alert('test');
              var count = Number($('#item_count').val());
              var add_item_number=count+1;
              var j=0;
             //  alert(add_item_number);
                 $(msg.issue_details).each(function (i, v) {
                    
                     j++;
                     if(j==add_item_number){
                       
                       var str='<tr class="row" id="row_'+j+'" >';
                       
                       str +='<td><button id="button2" onclick="removeRow(' + j + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
                         
                    //  str +='<td><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_name_des+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_des+'"></td><td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.issue_m_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.issue_m_unit+'"></td><td><input type="hidden" name="issued_qty[]" id="issued_qty_'+j+'" class="issue" value="'+v.issue_quality+'"><input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+v.issue_quality+'"></td><td><input type="text" name="return_qty[]" id="return_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="hidden" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"><input disabled type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"></td><td><input hidden type="text" name="return_value[]" id="return_value_'+j+'" class="issue"  value=""><input disabled type="text" name="return_value1[]" id="return_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="remark_'+j+'" class="issue"  value=""></td> ';
                      str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.asset_id+'" name="asset_id[]" id="asset_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_name_des+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_name_des+'"></td><td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.issue_m_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.issue_m_unit+'"></td><td><input type="hidden" name="issued_qty[]" id="issued_qty_'+j+'" class="issue" value="'+v.issue_quality+'"><input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+v.issue_quality+'"></td><td><input required type="text" name="return_qty[]" id="return_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="hidden" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"><input disabled type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.issue_unit_price+'"></td><td><input hidden type="text" name="return_value[]" id="return_value_'+j+'" class="issue"  value=""><input disabled type="text" name="return_value1[]" id="return_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="remark_'+j+'" class="issue"  value=""></td> ';
                     
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
