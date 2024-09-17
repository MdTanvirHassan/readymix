<script>
    $(document).ready(fuction(){
        
    });
</script>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Material Receive Requisition</h3>
            </div>
        </div>
            
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                      <form class="form-horizontal" id="mrr_form" method="post" action="<?php echo site_url('general_store/add_action_material_receive_requisition') ?>">
             
                          <div class="row" style="margin-left:0px;margin-top:5px;">        
                        <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                           Purchase Order :
                        </label> 
                              <div class="col-sm-6 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <select required id="po_id" class="form-control e1" name="po_id">
                                    <option value="">Select Order</option>
                                    <?php foreach($purchase_orders as $purchase_order){ ?>
                                        <option value="<?php echo $purchase_order['o_id'];  ?>"><?php if(!empty($purchase_order['order_no'])) echo $purchase_order['order_no']; ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            
                        </label>
                             <div class="col-sm-4 input-group">
                                 
                             </div>
                             
                         </div>
                     </div>        
                          
                        <div class="row" style="margin-left:0px;margin-top:5px;">   
                            <div class='form-group' >
                               <label for="title" class="col-sm-2 control-label">
                                    MRR NO.:
                              </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input class="form-control" id="" name="mrr_code" type="hidden" value="<?php if(!empty($mrr_code)) echo $mrr_code; ?>">
                                <input class="form-control" id="" name="mrr_no" type="hidden" value="<?php if(!empty($mrr_auto_code)) echo "MRR".$mrr_auto_code; ?>">
                                <input disabled class="form-control" id="" name="mrr_no1" type="text" value="<?php if(!empty($mrr_auto_code)) echo "MRR".$mrr_auto_code; ?>">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            MRR Date :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input required id="mrr_date" class="form-control datepicker"  name="mrr_date" type="text" value="<?php echo date('d-m-Y'); ?>">
                        </div>
                             
                         </div>
                        </div> 
                          
                     <div class="row" style="margin-left:0px;margin-top:5px;">        
                        <div class='form-group' >
                             <label for="title" class="col-sm-2 control-label">
                                Challan NO. :
                             </label> 
                              <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input class="form-control" id="mrr_challan" name="mrr_challan" type="text">
                              </div>
                             <label for="title" class="col-sm-2 control-label">
                                Date :
                            </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input required id="mrr_challan_date" class="form-control datepicker"  name="mrr_challan_date" type="text">
                        </div>
                             
                         </div>
                     </div>      
                          
                   <div class="row" style="margin-left:0px;margin-top:5px;">           
                                <div class='form-group' >
                                  <label for="title" class="col-sm-2 control-label">
                                      Remarks :
                                   </label> 
                                    <div class="col-sm-4 input-group">
                                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                               <input class="form-control" name="mrr_remark" type="text">
                                    </div>


                               </div>
                   </div>         
                
                
                 
                
                  
                
                
             
                <div class="row">
                    
                    <div class="col-md-6">
                        <!--
                         <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">REmarks :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" name="mrr_remark" type="text"></div>
                        -->
                    </div>
                </div>
                
                
                
            <h2 style="text-align:center; ">Item List & information</h2>
              <div class="separator-shadow row"></div>
              <input type="hidden" id="count" value="1"/>
               <input type="hidden" id="item_count" value=""/>
             <table class="table table-bordered" id="myTable">
    <thead class="thead-color">
      <tr >
        <th>Item Name</th>
        <th>Unit</th> 
        <th>Challan Qnty</th>
        <th>Receive Qnty</th>
        <th>Wastage Qnty</th>
        <th>Remark</th>
        <th>Select</th>
      </tr>
    </thead>
    <tbody id="purchae_order_items">
    
    </tbody>
  </table>
  <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-10">
                     <div class="col-md-2">
                        <a href="<?php echo site_url('backend/general_store/material_receive_requisition') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
                    
                    <div class="col-md-2">
                        <button onclick="javascript:validateSignup()" type="button" class="btn btn-primary button">SAVE</button>
                    </div>
                   
                    
                </div>
                <div class="col-md-2">
                    
                    <div class="row">
                <div class="col-md-12">
                       <!-- <button type="button" class="btn btn-success button">EXIT</button>-->
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
    
     $('#po_id').change(function(){
        var po_id=$('#po_id').val();
        if(po_id!=''){
            
            var data = {'po_id': po_id}
            $.ajax({
                    url: '<?php echo site_url('purchase_orders/get_purchase_order_item'); ?>',
                    data: data,
                    method: 'POST',
                    dataType: 'json',
                    success: function (msg) { 
             
                        var str='';
                        var total=0;
                        var net_qty;
                        var amount;
                         $(msg.item_list).each(function (i, v) {
                             if(v.receive_quantity!=''){  
                                 net_qty=Number(v.quantity)-Number(v.receive_quantity);
                             }else{
                                 net_qty=Number(v.quantity);
                             }  
                             amount=Number(v.unit_price)*Number(net_qty);
                             total=total+Number(v.amount);
                             str+='<tr>';
                             str +='<td><input type="hidden"  name="item_id[]" id="item_des_c1_" class="issue" value="'+v.item_id+'"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="'+v.item_name+'"></td>';
                             str +='<td><input type="hidden"   style="width:140px;"  type="text"  name="unit_price[]" id="unit_price_'+v.item_id+'" class="unit_price_'+(Number(i) + 1)+'" value="'+v.unit_price+'"><input readonly  style="width:140px;"  type="text"  name="measurement_unit[]" id="measurement_unit_'+v.item_id+'" value="'+v.meas_unit+'"></td>';
                             str +='<td><input style="width:100px;text-align:right;"  type="text"  name="challan_qty[]" id="quantity_'+v.item_id+'" class="issue" value="'+net_qty+'"></td>';
                             str +='<td><input   onkeyup="calculateSubtotal('+v.item_id+')" onchange="calculateSubtotal('+v.s_item_id+')" onblur="calculateSubtotal('+v.item_id+')"  style="width:100px;text-align:right;"  type="text"  name="receive_qty[]" id="quantity_'+v.item_id+'" class="issue" value="'+net_qty+'"></td>';
                             str +='<td><input style="width:100px;text-align:right;"  type="text"  name="wastage_qty[]" id="quantity_'+v.item_id+'" class="issue" value=""></td>';
                             str +='<td><input type="hidden" style="width:140px;"  type="text" name="amount[]" id="amount_'+v.item_id+'" class="amount_'+(Number(i) + 1)+'"  value="'+amount+'"><input    style="width:140px;text-align:right;"  type="text" name="remark[]" id="amount_'+v.item_id+'" class="remark_'+(Number(i) + 1)+'" ></td>'; 
                             str +='<td><input style="width:40px;text-align:right;"  type="checkbox" name="item_select[]"    id="select_product_'+v.item_id+'" class="select_product_'+(Number(i) + 1)+'" value="'+v.item_id+'"></td>'; 
                             str+='</tr>';
                         });

                       //  $('#sub_total').val(total);       
                         $('#purchae_order_items').append(str);
                         
//                         var str1='';
//                         var due_qty;
//                        
//                         $(msg.order_products).each(function (j, w) {
//                             if(w.delivery_quantity!=null){  
//                                 due_qty=Number(w.quantity)-Number(w.delivery_quantity);
//                             }else{ 
//                                 due_qty=Number(w.quantity);
//                             }    
//                             //alert(w.delivery_quantity);
//                             str1+='<tr>';
//                             str1 +='<td><input readonly style="width:140px;"  type="text"  name="product_name[]" id="product_name_" class="issue" value="'+w.product_name+'"></td>';
//                             str1 +='<td><input readonly  style="width:140px;text-align:right;"  type="text"  name="order_quantity[]" id="order_quantity_'+(Number(j) + 1)+'" class="issue" value="'+w.quantity+'"></td>';
//                             if(w.delivery_quantity==null){
//                                str1 +='<td><input readonly   style="width:140px;text-align:right;"  type="text"  name="delivery_quantity[]" id="delivery_quantity_'+(Number(j) + 1)+'" class="issue" value="'+''+'"></td>';
//                             }else{
//                                 str1 +='<td><input readonly   style="width:140px;text-align:right;"  type="text"  name="delivery_quantity[]" id="delivery_quantity_'+(Number(j) + 1)+'" class="issue" value="'+w.delivery_quantity+'"></td>';
//                                 
//                             }    
//                             str1 +='<td><input readonly  style="width:140px;text-align:right;"  type="text" class="amount_"  name="due_quantity[]" id="due_quantity_'+w.s_item_id+'" class="issue" value="'+due_qty+'"></td>';                     
//                             str1 +='</tr>';
//                         });
//                         
//                         $('#order_items').append(str1);
                    

                    }

                })
        }else{
            $('#purchae_order_items tr').remove();
           // $('#order_items tr').remove();
            
           
        }
    });
    
    function calculateTotal(id){
    //    alert('test');
        var net_price;
        var r_quantity = Number($('#receive_qty_'+id).val());
        var b_quantity = Number($('#budget_qty_'+id).val());
        var indent_quantity = Number($('#indent_qty_'+id).val());
        var excess_amount=Number(r_quantity)-Number(indent_quantity)
        if(r_quantity >indent_quantity){ 
            $('#item_remark_'+id).val('Extra '+excess_amount+' qty received');
        }else{
            $('#item_remark_'+id).val('');
        }
        
        if(r_quantity >b_quantity || r_quantity<=0 ){ 
            $('#receive_qty_'+id).val('');
        }
        var unit_price = $('#unit_price_'+id).val();
      
        var others = $('#others_'+id).val();
       
        if(r_quantity!='' && unit_price!='' && others!='' ){
            net_price=(Number(r_quantity)*Number(unit_price))+Number(others);
        }else  if(r_quantity!='' && unit_price!=''){
            net_price=Number(r_quantity)*Number(unit_price);
           
        }else if(others!=''){
            net_price=Number(others);
        }else{
            net_price='';
        }
       $('#total_cost_'+id).val(net_price);
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
          
                $('#item_des_'+id).val(msg[0].item_name);
                $('#unit_'+id).val(msg[0].meas_unit);
       
            }
        })

    }
    
    function invoice_or_challan(){
       
        var in_or_challan=$('#invoice_challan').val();
        if(in_or_challan=="invoice"){
            $('#invoice').show();
            $('#challan').hide();
        }else{
            $('#invoice').hide();
            $('#challan').show();
        }
        
    }
    
    function cash_credit_or_lc(){
       
        var procurement=$('#mrr_procurement').val();
      //  var data = {'procurement': procurement};
           $.ajax({
            url: '<?php echo site_url('general_store/budget_info_details'); ?>',
            data:{'procurement': procurement},
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
            //    alert('test');
             var j=0;
              
                
                 var str = '<thead><tr class="row"><th>Budget No</th><th>Indent No</th><th>Item Code</th><th>Item Description</th> <th>M.unit</th><th>Budget Qty</th><th>Receive Qty</th><th>Unit Price</th><th>Others Cost</th> <th>Total Cost </th><th>Remark</th><th>Select</th> </tr></thead><tbody>';
                 $(msg.budget_details).each(function (i, v) {
                   //  alert('test');
                     j++;
                        str +='<tr class="row" id="row_" >';
                    //   str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="department_id_'+j+'" class="issue"><input type="hidden" value="'+v.asset_id+'" name="asset_id[]" id="asset_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_description+'"><input disabled type="text" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_description+'"></td><td><input  type="hidden" name="measurement_unit[]" id="measurement_unit_'+j+'" class="issue" value="'+v.measurement_unit+'"><input disabled type="text" name="measurement_unit1[]" id="measurement_unit1_'+j+'" class="issue" value="'+v.measurement_unit+'"></td><td><input type="text" name="indent_id[]" id="indent_id_'+j+'" class="issue" value="'+v.indent_id+'"></td><td><input type="text" name="receive_qty[]" id="receive_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input type="text" name="cf_cost[]" id="others_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input type="text" name="total_cost[]" id="total_cost_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="item_remark_'+j+'" class="issue"  value=""> <td style="text-align: center;"><input type="checkbox" name="item_select[]" value="" ></td></td> ';
                     
                      str +='<input type="hidden"  name="asset_id[]" id="asset_id_'+j+'" class="issue" value="'+v.asset_id+'" >';
                      str +='<input type="hidden"  name="c_c_id[]" id="c_c_id_'+j+'" class="issue" value="'+v.asset_id+'" >';
                      str +='<input type="hidden"  name="department_id[]" id="department_id_'+j+'" class="issue" value="'+v.department_id+'" >';
                      
                      str +='<td><input type="hidden"  name="b_id[]" id="b_id_'+j+'" class="issue" value="'+v.b_id+'" ><input type="hidden"  name="b_no[]" id="b_no_'+j+'" class="issue" value="'+v.b_no+'" ><input disabled type="text"  name="b_no1[]" id="b_no1_'+j+'"  class="issue" value="'+v.b_no+'"></td>';
                      str +=' <td><input type="hidden"  name="indent_id[]" id="indent_id_'+j+'" class="issue" value="'+v.indent_id+'" ><input type="hidden"  name="indent_no[]" id="indent_no_'+j+'" class="issue" value="'+v.indent_no+'" ><input disabled type="text"  name="indent_no1[]" id="indent_no1_'+j+'"  class="issue" value="'+v.indent_no+'"></td>';
                      str +='<td><input type="hidden" name="item_id[]" id="item_id_'+j+'" class="issue" value="'+v.item_id+'"><input type="hidden" name="item_code[]" id="item_code_'+j+'" class="issue" value="'+v.item_code+'"><input disabled type="text" name="item_code1[]" id="item_code1_'+j+'" class="issue" value="'+v.item_code+'"></td>';
                      str +='<td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_description+'"><input disabled type="text" name="item_description1[]" id="item_description1_'+j+'" class="issue" value="'+v.item_description+'"></td>';
                      str +='<td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.measurement_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.measurement_unit+'"></td>';
                      str +='  <td><input type="hidden" name="budget_qty[]" id="budget_qty_'+j+'"  class="issue" value="'+v.budget_qty+'"><input disabled type="text" name="budget_qty1[]" id="budget_qty1_'+j+'"  class="issue" value="'+v.budget_qty+'"></td>';
                      str +='<td><input  type="text" name="receive_qty[]" id="receive_qty_'+j+'" onkeyup="calculateTotal('+j+')" class="issue" ></td>';
                      str +=' <td><input type="text" name="unit_price[]" id="unit_price_'+j+'" onkeyup="calculateTotal('+j+')" class="issue" value="'+v.unit_price+'"></td>';
                      str +='<td><input type="text" name="cf_cost[]" id="others_'+j+'" onkeyup="calculateTotal('+j+')" class="issue" ></td>';
                      str +=' <td><input type="text" name="total_cost[]" id="total_cost_'+j+'"  class="issue"></td>';
                      str +=' <td><input type="text" name="remark[]" id="remark_'+j+'" class="issue"></td>';
                      str +=' <td style="text-align: center;"><input type="checkbox" name="item_select[]" value="" ></td>';
        
  
                 str +="</tr>";
                 });
                 str +="</tbody>";
                 $('#myTable').html(str);
               
             }
                
               
            
        })
        
        
    }
  
    function indent_info(){
        //  alert('test');
       var mrr_indent_no= $('#mrr_ipo_no').val();
       var data = {'mrr_indent_no': mrr_indent_no}
        $.ajax({
            url: '<?php echo site_url('general_store/indent_info_details'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
            //    alert('test');
             var j=0;
                $('#mrr_ipo_date').val(msg.indent[0].date);
                
                 var str = '<thead> <tr class="row"><th><button style="margin-left:5px;display:none"  type="button" id="button1" class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span></button>   </th><th>Item Code</th><th>Item Description</th>  <th>M.unit</th><th>Indent Qty</th><th>Receive Qty</th><th>Unit Price</th><th>Others Cost</th><th>Total Cost </th><th>Remark</th></tr></thead><tbody>';
                 $(msg.indent_details).each(function (i, v) {
                     j++;
                       str +='<tr class="row" id="row_'+j+'" >';
                       if(j==1){
                            str +='<td></td>';
                       }else{
                            str +='<td><button id="button2" onclick="removeRow(' + j + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
                            
                       }
                    
                       str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.asset_id+'" name="asset_id[]" id="asset_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="text" name="item_description[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_description+'"></td><td><input type="text" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.unit+'"></td><td><input type="text" name="indent_qty[]" id="indent_qty_'+j+'" class="issue" value="'+v.indent_qty+'"></td><td><input type="text" name="receive_qty[]" id="receive_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input type="text" name="cf_cost[]" id="others_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input type="text" name="total_cost[]" id="total_cost_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="item_remark_'+j+'" class="issue"  value=""></td> ';
                     
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
  
    function indent_info_pre(){
        //  alert('test');
       var mrr_indent_no= $('#mrr_ipo_no').val();
       var data = {'mrr_indent_no': mrr_indent_no}
        $.ajax({
            url: '<?php echo site_url('general_store/indent_info_details'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
            //    alert('test');
                $('#mrr_ipo_date').val(msg.indent[0].date);
                
                 var str = '<option value="0">Select Item</option>';
                 $(msg.indent_details).each(function (i, v) {
                  //   alert('test');
                     str += '<option value="' + v.item_id + '">'+ v.item_name+"("+ v.item_code+")"+ '</option>';
                    // alert(v.user_id);
                 });
                 $('#item_1').html(str);
                
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
                         
                    //   str +='<td><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="text" name="item_description[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_description+'"></td><td><input type="text" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.unit+'"></td><td><input type="text" name="indent_qty[]" id="indent_qty_'+j+'" class="issue" value="'+v.indent_qty+'"></td><td><input type="text" name="receive_qty[]" id="receive_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input type="text" name="cf_cost[]" id="others_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input type="text" name="total_cost[]" id="total_cost_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="item_remark_'+j+'" class="issue"  value=""></td> ';
                      str +='<td><input type="hidden" value="'+v.department_id+'" name="department_id[]" id="dept_id_'+j+'" class="issue"><input type="hidden" value="'+v.asset_id+'" name="asset_id[]" id="asset_id_'+j+'" class="issue"><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="text" name="item_description[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_description+'"></td><td><input type="text" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.unit+'"></td><td><input type="text" name="indent_qty[]" id="indent_qty_'+j+'" class="issue" value="'+v.indent_qty+'"></td><td><input type="text" name="receive_qty[]" id="receive_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input type="text" name="cf_cost[]" id="others_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input type="text" name="total_cost[]" id="total_cost_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="item_remark_'+j+'" class="issue"  value=""></td> ';
                     
                     
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
    
    
    function validateSignup() {
        if ($('#mrr_date').val() =='') {
            alert('Please fill the MRR field');
            $('#mrr_date').focus();
            return false;
        }
        var invoice_challan=$('#invoice_challan').val();
        if ($('#invoice_challan').val() == '') {
            alert('Please fill the Invoice Or Challlan field');
            $('#invoice_challan').focus();
            return false;
        }
        if(invoice_challan=="challan"){
            if($('#mrr_challan').val() == ''){
                alert('Please fill the  Challlan No field');
                $('#mrr_challan').focus();
                return false;
            }
        }else{
            if($('#mrr_invoice').val() == ''){
                alert('Please fill the Invoice No field');
                $('#mrr_invoice').focus();
                return false;
            }
        }
       
        if ($('#mrr_challan_date').val() == '') {
             alert('Please fill the Invoice Or Challan Date field');
            $('#mrr_challan_date').focus();
            return false;
        }
        
      
       
        
        
        
        
        $("#mrr_form").submit();
       

             
      
    }
    
    
    

</script>