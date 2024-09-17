<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--            <h2 style="text-align:center; ">Material Receive Requisition</h2>
            <hr>-->
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Material Receive Register</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('general_store/details_material_receive_requisition/' . $mrr[0]['mrr_id'] . '/true'); ?>" class="btn btn-sm btn-warning">PRINT</a>
            </div>
        </div>
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
            <form class="form-horizontal" method="post" action="<?php echo site_url('general_store/edit_action_material_receive_requisition/'.$mrr[0]['mrr_id']) ?>">
               
                <div class="row" style="margin-left:0px;margin-top:5px;">        
                        <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                           Purchase Order :
                        </label> 
                              <div class="col-sm-6 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <select disabled required id="po_id" class="form-control e1" name="po_id">
                                    <option value="">Select Order</option>
                                    <?php foreach($purchase_orders as $purchase_order){ ?>
                                        <option <?php if($mrr[0]['po_id']==$purchase_order['o_id']) echo 'selected'; ?> value="<?php echo $purchase_order['o_id'];  ?>"><?php if(!empty($purchase_order['order_no'])) echo $purchase_order['SUP_NAME'].'('.$purchase_order['order_no'].')'.'('.date("d-m-Y",strtotime($purchase_order['purchase_order_date'])).')'; ?></option>
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
                                  
                              
                                <input disabled class="form-control" id="" name="mrr_no1" type="text" value="<?php if(!empty($mrr[0]['mrr_no'])) echo $mrr[0]['mrr_no']; ?>">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            MRR Date :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input required disabled id="mrr_date" class="form-control datepicker"  name="mrr_date" type="text" value="<?php if(!empty($mrr[0]['mrr_date'])) echo date('d-m-Y',strtotime($mrr[0]['mrr_date'])); ?>">
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
                                            <input disabled class="form-control" id="mrr_challan" name="mrr_challan" type="text" value="<?php if(!empty($mrr[0]['mrr_challan'])) echo $mrr[0]['mrr_challan']; ?>">
                              </div>
                             <label for="title" class="col-sm-2 control-label">
                                Date :
                            </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input disabled required id="mrr_challan_date" class="form-control datepicker"  name="mrr_challan_date" type="text" value="<?php if(!empty($mrr[0]['mrr_challan_date'])) echo date('d-m-Y',strtotime($mrr[0]['mrr_challan_date'])); ?>" >
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
                                              <input disabled  class="form-control" name="mrr_remark" type="text" value="<?php if(!empty($mrr[0]['mrr_remark'])) echo $mrr[0]['mrr_remark']; ?>">
                                    </div>


                               </div>
                   </div>         
                
            
                
            <h2 style="text-align:center; ">Item List & information</h2>
              <div class="separator-shadow row"></div>
          
            
            
              <table class="table table-bordered" id="myTable">
    <thead class="thead-color">
      <tr class="">
        <th>Department</th>
        <th>Indent No.</th>
        <th>Item Name</th> 
        <th>Unit</th> 
       
         
        <th>Challan Qnty</th>
        <th>Receive Qnty</th>
        <th>Wastage Qnty</th>
        <th>Remark</th>
       
      </tr>
    </thead>
    <tbody>
    <?php $i=0; foreach($receive_items as $receive_item){ $i++;?>
    <tr class="" id="row_1">
        <td><input disabled  style="width:140px;"  type="text"  name="dept_name[]" id="measurement_unit_" value="<?php echo $receive_item['dept_name']  ?>"></td>
        <td><input disabled  style="width:140px;"  type="text"  name="ipo_number[]" id="measurement_unit_" value="<?php echo $receive_item['ipo_number']  ?>"></td>
        <td><input type="hidden"  name="item_id[]" id="item_des_c1_" class="issue" value="<?php echo $receive_item['item_id']  ?>"><input disabled style="width:220px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="<?php echo $receive_item['item_name']  ?>"></td>
        <td><input type="hidden"   style="width:140px;"  type="text"  name="unit_price[]" id="unit_price_<?php echo $receive_item['item_id']  ?>" class="unit_price_" value="<?php echo $receive_item['unit_price']  ?>"><input disabled  style="width:140px;"  type="text"  name="measurement_unit[]" id="measurement_unit_" value="<?php echo $receive_item['meas_unit']  ?>"></td>
        <td><input disabled style="width:100px;text-align:right;"  type="text"  name="size[]" id="size_<?php echo $receive_item['item_id']; ?>" class="issue" value="<?php echo $receive_item['item_size']  ?>"></td>
        <td><input disabled  style="width:140px;"  type="text"  name="measurement_unit[]" id="measurement_unit_" value="<?php echo $receive_item['unit_name']  ?>"></td>
        <td><input style="width:100px;text-align:right;"  type="text"  name="challan_qty[]" id="quantity_<?php echo $receive_item['item_id']; ?>" class="issue" value="<?php echo $receive_item['challan_qty']  ?>"></td>
        <td><input  disabled onkeyup="calculateSubtotal(<?php echo $receive_item['item_id']; ?>)" onchange="calculateSubtotal(<?php echo $receive_item['item_id']; ?>)" onblur="calculateSubtotal(<?php echo $receive_item['item_id']; ?>)"  style="width:100px;text-align:right;"  type="text"  name="receive_qty[]" id="quantity_<?php echo $receive_item['item_id']; ?>" class="issue" value="<?php echo $receive_item['receive_qty']  ?>"></td>
        <td><input disabled style="width:100px;text-align:right;"  type="text"  name="wastage_qty[]" id="quantity_<?php echo $receive_item['item_id']; ?>" class="issue" value="<?php echo $receive_item['wastage_qty']  ?>"></td>
        <td><input type="hidden" style="width:140px;"  type="text" name="amount[]" id="amount_<?php echo $receive_item['item_id']; ?>" class="amount_<?php echo $i; ?>"  value="<?php echo $receive_item['amount']  ?>"><input  disabled  style="width:140px;text-align:left;"  type="text" name="remark[]" value="<?php echo $receive_item['remark']  ?>"></td>
       
        
        
      </tr>
  <?php } ?>   
      </tbody>
  </table>
      
            
          
  <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-10">
                    <!--
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">UPDATE</button>
                    </div>
                    -->
                     <div class="col-md-2">
                        <a href="<?php echo site_url('backend/general_store/material_receive_requisition') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
                   
                    
                </div>
                <div class="col-md-2">
                    
                    <div class="row">
                <div class="col-md-12">
                    <!--    <button type="button" class="btn btn-success button">EXIT</button> -->
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
//                $('#item_des_'+id).val(msg.item_info[0].item_name);
//                $('#unit_'+id).val(msg.item_info[0].meas_unit);
//                $('#stock_qty_'+id).val(msg.item_info[0].stock_amount);
                   
                $('#item_des_'+id).val(msg[0].item_name);
                $('#unit_'+id).val(msg[0].meas_unit);
          //      $('#stock_qty_'+id).val(msg[0].stock_amount);
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
                      str +='<input type="hidden"  name="department_id[]" id="department_id_'+j+'" class="issue" value="'+v.department_id+'" >';
                      
                      str +='<td><input type="hidden"  name="b_id[]" id="b_id_'+j+'" class="issue" value="'+v.b_id+'" ><input type="hidden"  name="b_no[]" id="b_no_'+j+'" class="issue" value="'+v.b_no+'" ><input disabled type="text"  name="b_no1[]" id="b_no1_'+j+'"  class="issue" value="'+v.b_no+'"></td>';
                      str +=' <td><input type="hidden"  name="indent_id[]" id="indent_id_'+j+'" class="issue" value="'+v.indent_id+'" ><input type="hidden"  name="indent_no[]" id="indent_no_'+j+'" class="issue" value="'+v.indent_no+'" ><input disabled type="text"  name="indent_no1[]" id="indent_no1_'+j+'"  class="issue" value="'+v.indent_no+'"></td>';
                      str +='<td><input type="hidden" name="item_id[]" id="item_id_'+j+'" class="issue" value="'+v.item_id+'"><input type="hidden" name="item_code[]" id="item_code_'+j+'" class="issue" value="'+v.item_code+'"><input disabled type="text" name="item_code1[]" id="item_code1_'+j+'" class="issue" value="'+v.item_code+'"></td>';
                      str +='<td><input type="hidden" name="item_description[]" id="item_description_'+j+'" class="issue" value="'+v.item_description+'"><input disabled type="text" name="item_description1[]" id="item_description1_'+j+'" class="issue" value="'+v.item_description+'"></td>';
                      str +='<td><input type="hidden" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.measurement_unit+'"><input disabled type="text" name="measurement_unit[]" id="unit1_'+j+'" class="issue" value="'+v.measurement_unit+'"></td>';
                      str +='  <td><input type="hidden" name="budget_qty[]" id="budget_qty_'+j+'"  class="issue" value="'+v.budget_qty+'"><input disabled type="text" name="budget_qty1[]" id="budget_qty1_'+j+'"  class="issue" value="'+v.budget_qty+'"></td>';
                      str +='<td><input type="text" name="receive_qty[]" id="receive_qty_'+j+'" onkeyup="calculateTotal('+j+')" class="issue" ></td>';
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
    
    
//     function cash_credit_or_lc(){
//       
//        var procurement=$('#mrr_procurement').val();
//        if(procurement=="cash"){
//            $('#cash').show();
//            $('#credit').hide();
//            $('#lc').hide();
//        }else if(procurement=="credit"){
//            $('#cash').hide();
//            $('#credit').show();
//            $('#lc').hide();
//        }else{
//            $('#cash').hide();
//            $('#credit').hide();
//            $('#lc').show();
//        }
//        
//    }
    
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
                    //   str +='<td><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="text" name="item_description[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_description+'"></td><td><input type="text" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.unit+'"></td><td><input type="text" name="indent_qty[]" id="indent_qty_'+j+'" class="issue" value="'+v.indent_qty+'"></td><td><input type="text" name="receive_qty[]" id="receive_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input type="text" name="cf_cost[]" id="others_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input type="text" name="total_cost[]" id="total_cost_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="item_remark_'+j+'" class="issue"  value=""></td> ';
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
   
   

    $('#button1').live('click',function (){
       // alert('test');
        var count = $('#item_count').val();
        var indent_no= $('#mrr_ipo_no').val();
        var data = {'indent_no': indent_no};
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
                         
                       //str +='<td><input type="hidden" value="'+v.item_id+'" name="item_id[]" id="item_'+j+'" class="issue"><input  type="hidden" value="'+ v.item_code+'" name="item_code[]" id="item_code_'+j+'" class="issue"><input disabled type="text" value="'+ v.item_code+'" name="item_name_code[]" id="item_name_code_'+j+'" class="issue"></td><td><input type="text" name="item_description[]" id="item_des_'+j+'" class="issue" value="'+v.item_name_description+'"></td><td><input type="text" name="measurement_unit[]" id="unit_'+j+'" class="issue" value="'+v.unit+'"></td><td><input type="text" name="indent_qty[]" id="indent_qty_'+j+'" class="issue" value="'+v.indent_qty+'"></td><td><input type="text" name="receive_qty[]" id="receive_qty_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value="" ></td><td><input type="text" name="unit_price[]" id="unit_price_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input type="text" name="cf_cost[]" id="others_'+j+'" class="issue" onkeyup="calculateTotal('+j+')" value=""></td><td><input type="text" name="total_cost[]" id="total_cost_'+j+'" class="issue"  value=""></td><td><input type="text" name="remark[]" id="item_remark_'+j+'" class="issue"  value=""></td> ';
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

</script>