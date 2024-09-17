<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>MRR Return Receive</h3>
            </div>
        </div>
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    
    

            <form class="form-horizontal" method="post" action="<?php echo site_url('general_store/add_action_mrr_return_receive') ?>">
               <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                           MRR-RR No.:
                        </label> 
                              <div class="col-sm-4 input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input  class="form-control" id="inputdefault" name="mrr_rr_code" type="hidden" value="<?php if(!empty($mrr_rr_code)) echo $mrr_rr_code;  ?>">
                                <input class="form-control" id="inputdefault" name="mrr_rr_no" type="hidden" value="<?php if(!empty($mrr_rr_auto_code)) echo $branch_info[0]['short_name'].'/RR'.$mrr_rr_auto_code;  ?>">
                                <input disabled class="form-control" id="inputdefault" name="ir_no" type="text" value="<?php if(!empty($mrr_rr_auto_code)) echo  $branch_info[0]['short_name'].'/RR'.$mrr_rr_auto_code;  ?>">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Receive Date :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input required class="form-control datepicker" name="receive_date"  type="text" value="<?php echo date('d-m-Y') ?>">
                        </div>
                             
                         </div> 
                
                <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                           Return No. :
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <select required id="rr_id" class="form-control e1" name="rr_id" onchange="javascript:return_item_info()">
                                    <option value="">Select Return No</option>
                                    <?php foreach($mrr_return_numbers as $mrr_return_number){ ?>
                                        <option value="<?php echo $mrr_return_number['rr_id'];  ?>"><?php if(!empty($mrr_return_number['rr_no'])) echo $mrr_return_number['rr_no']; ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Date :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input required id="rr_date" class="form-control datepicker" name="rr_date" type="text">
                        </div>
                             
                         </div>
                
                
                <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                           Remarks :
                        </label> 
                              <div class="col-sm-4 input-group">
                                   <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input class="form-control" name="remarks" type="text">
                        </div>
                             
                             
                             
                         </div>
                
                
                 
                
                
                
                
                <br> 
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
        <th>Returned Qty</th>
        <th>Receive Qty</th>
       <!--
        <th>Unit Price</th>
        <th>Receive Value</th>   
       -->
       
        <th>Remark</th>
      </tr>
    </thead>
    <tbody>
       <tr class="row" id="row_1">
        <td></td>
        <td> <select id="item_1" name="item_id[]" onchange="javascript:item_info(1);">
                   
        </select></td>
        <td><input type="text" name="item_description[]" id="item_des_1" class="issue"></td>
        <td><input type="text" name="measurement_unit[]" id="unit_1" class="issue"></td>
        
        <td><input type="text" name="return_qty[]" id="return_qty_1" onkeyup="calculateTotal(1)" class="issue"></td>
        <td><input required type="text" name="receive_qty[]" id="receive_qty_1" onkeyup="calculateTotal(1)" class="issue"></td>
      <!--  
        <td><input type="text" name="unit_price[]" id="unit_price_1" onkeyup="calculateTotal(1)" class="issue"></td>       
        <td><input type="text" name="receive_value[]" id="receive_value_1" class="issue"></td>
      -->
        <td><input type="text" name="remark[]" class="issue"></td>
        
      </tr>
      </tbody>
  </table>
  <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-10">
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/general_store/mrr_return_receive') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
                    
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">SAVE</button>
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
        
        $('.number').on('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);  
        });
        

        var net_price;
        var retrun_quantity =Number($('#return_qty_'+id).val());
        var r_quantity = Number($('#receive_qty_'+id).val());
       
        var unit_price = $('#unit_price_'+id).val();
      
        
        if(r_quantity<=retrun_quantity){
            if(r_quantity!='' && unit_price!=''){
                net_price=(Number(r_quantity)*Number(unit_price));
            }else{
                net_price='';
            }
           $('#receive_value_'+id).val(net_price);
           $('#receive_value1_'+id).val(net_price);
        }else{
           $('#receive_qty_'+id).val('');
           $('#receive_value_'+id).val(''); 
           $('#receive_value1_'+id).val('');
        }    
    }
    
    
      
    
    
   function return_item_info(){
        //  alert('test');
       var return_no= $('#rr_id').val();
       if(return_no!=''){
        $('#myTable').html('');   
        var data = {'return_no': return_no}
        $.ajax({
            url: '<?php echo site_url('general_store/return_info_details'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
            //    alert('test');
             var j=0;
                $('#rr_date').val(msg.return[0].date);
                
                 var str = '<thead> <tr class="row"><th><button style="margin-left:5px;display:none"  type="button" id="button1" class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span></button>   </th><th>Item Code</th><th>Item Description</th>  <th>MU</th><th>Return Qty</th><th>Receive Qty</th><th>Remark</th></tr></thead><tbody>';
                 $(msg.return_details).each(function (i, v) {
                  //   alert('test');
                       var r_qty;
                       if(v.return_receive_qty!=null){
                          r_qty=v.return_qty-v.return_receive_qty;
                       }else{
                          r_qty=v.return_qty; 
                       }
                       
                       j++;
                       str +='<tr class="row" id="row_'+j+'" >';
//                       if(j==1){
//                            str +='<td></td>';
//                       }else{
                            str +='<td><button id="button2" onclick="removeRow(' + j + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
//                       }    
                       str +='<td>';
                       str +='<input type="hidden" value="'+v.rr_d_id+'" name="rr_d_id[]" id="rr_d_id_'+j+'" class="issue">';
                       str +='<input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue">';
                       str +='<input type="hidden" value="'+v.c_c_id+'" name="c_c_id[]" id="c_c_id_'+j+'" class="issue">';
                       str +='<input type="hidden" value="'+v.asset_id+'" name="asset_id[]" id="asset_id_'+j+'" class="issue">';
                       str +='<input type="hidden" value="'+v.brand_id+'" name="brand_id[]" id="brand_id_'+j+'" class="issue">';
                       str +='<input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue">';
                       str +='<input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue">';
                       str +='<input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue">';
                       str +='</td>';
                       str +='<td>';
                       str +='<input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_description+'">';
                       str +='<input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_description+'">';
                       str +='</td>';
                       str +='<td>';
                       str +='<input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.measurement_unit+'">';
                       str +='<input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.measurement_unit+'">';
                       str +='</td>';
                       str +='<td>';
//                       str +='<input type="hidden" name="return_qty[]" id="return_qty_'+j+'" class="issue" value="'+v.return_qty+'">';
//                       str +='<input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+v.return_qty+'">';
                       str +='<input type="hidden" name="return_qty[]" id="return_qty_'+j+'" class="issue" value="'+r_qty+'">';
                       str +='<input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+r_qty+'">';
                       str +='</td>';
                       str +='<td>';
                       str +='<input required type="text" name="receive_qty[]" id="receive_qty_'+j+'" class="issue number" onblur="calculateTotal('+j+')" onchange="calculateTotal('+j+')" onkeyup="calculateTotal('+j+')" value="" >';
                       str +='<input type="hidden" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.unit_price+'">';                     
                       str +='<input hidden type="text" name="receive_value[]" id="receive_value_'+j+'" class="issue"  value="">';
                       str +='</td>';
                       
                    //   str +='<td>';
                       
                    //   str +='<input disabled type="text" name="receive_value1[]" id="receive_value1_'+j+'" class="issue"  value="">'
                    //   str +='</td>';
                       str +='<td>';
                       str +='<input type="text" name="remark[]" id="remark_'+j+'" class="issue"  value="">';
                       str +='</td>';
                       
                     
                       str +="</tr>";
                 });
                 str +="</tbody>";
                 $('#myTable').html(str);
                 $("#item_count").val(j);
                // $('#item_1').html(str);
                // $('.selectpicker').selectpicker('refresh');
             }
                
               
            
        })
      }else{
        $('#myTable').html('');
      }
    }  
    
    

   $('#button1').live('click',function (){
       // alert('test');
        var count = $('#item_count').val();
       var return_no= $('#rr_id').val();
       var data = {'return_no': return_no}
          $.ajax({
            url: '<?php echo site_url('general_store/return_info_details'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
              //  alert('test');
              var count = Number($('#item_count').val());
              var add_item_number=count+1;
              var j=0;
               
                 $(msg.return_details).each(function (i, v) {
                     j++;
                     if(j==add_item_number){
                       var str='<tr class="row" id="row_'+j+'" >';
                       
                       str +='<td><button id="button2" onclick="removeRow(' + j + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
                         
                   //   str +='<td><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_description+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_description+'"></td><td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.measurement_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.measurement_unit+'"></td><td><input type="hidden" name="return_qty[]" id="return_qty_'+j+'" class="issue" value="'+v.return_qty+'"><input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+v.return_qty+'"></td><td><input type="text" name="receive_qty[]" id="receive_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="hidden" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.unit_price+'"><input disabled type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.unit_price+'"></td><td><input hidden type="text" name="receive_value[]" id="receive_value_'+j+'" class="issue"  value=""><input disabled type="text" name="receive_value1[]" id="receive_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="remark_'+j+'" class="issue"  value=""></td> ';
                     str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.c_c_id+'" name="c_c_id[]" id="c_c_id_'+j+'" class="issue"><input type="hidden" value="'+v.asset_id+'" name="asset_id[]" id="asset_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_description+'"><input disabled type="text" name="item_name_des1[]" id="item_des1_'+j+'" class="issue" value="'+v.item_description+'"></td><td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.measurement_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.measurement_unit+'"></td><td><input type="hidden" name="return_qty[]" id="return_qty_'+j+'" class="issue" value="'+v.return_qty+'"><input disabled type="text" name="issued_qty1[]" id="issued_qty1_'+j+'" class="issue" value="'+v.return_qty+'"></td><td><input required type="text" name="receive_qty[]" id="receive_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="hidden" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.unit_price+'"><input disabled type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue"  value="'+v.unit_price+'"></td><td><input hidden type="text" name="receive_value[]" id="receive_value_'+j+'" class="issue"  value=""><input disabled type="text" name="receive_value1[]" id="receive_value1_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="remark_'+j+'" class="issue"  value=""></td> ';
                     
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