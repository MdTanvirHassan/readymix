<style type="text/css">
    
    table tr td, table tr th{
        text-align: center;
        vertical-align:middle;padding: 4px !important;
           
    }
</style>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Pump Bill</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" action="<?php echo site_url('sale_invoices/edit_pump_bill_action/'.$sale_invoice_info[0]['inv_id']); ?>" method="post" onsubmit="javascript: return validation()">

                             <div class='form-group' style="margin-bottom:15px;" >
                                <label for="title" class="col-sm-2 control-label">
                                     Select customer<sup class="required">*</sup>:
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  class="form-control e1" placeholder="Select Customer" id="customer_id" name="customer_id" onchange="javascript:project_info();" >
                                          <option value="" >Select customer</option>
                                        <?php foreach($customers as $customer){ ?>
                                            <option <?php if($customer['id']==$sale_invoice_info[0]['customer_id']) echo "selected"; ?> class="form-control" value="<?php echo $customer['id'] ?>"><?php echo $customer['c_short_name'].'-'.$customer['c_name']; ?></option>
                                        <?php } ?>
                                         

                                     </select> 
                                    <span id="do_id_error" style="color:red"></span>
                                </div>


                            </div>
                            
                            
                             <div class='form-group' style="margin-bottom:15px;" >
                                <label for="title" class="col-sm-2 control-label">
                                     Select Project<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  class="form-control e1" placeholder="Select Project" id="project_id" name="project_id" onchange="javascript:sales_order_info();" >
                                          <option value="">Select Project</option>
                                          <?php foreach($projects as $project){ ?>
                                             <option <?php if($project['project_id']==$sale_invoice_info[0]['project_id']) echo "selected"; ?> class="form-control" value="<?php echo $project['project_id'] ?>"><?php echo $project['project_name']; ?></option>
                                          <?php } ?>
                                       

                                     </select> 
                                    <span id="do_id_error" style="color:red"></span>
                                </div>


                            </div>
                            
                                                 
                            
                  
                            <div class='form-group' style="margin-bottom:15px;" >
                                <label for="title" class="col-sm-2 control-label">
                                   Product Type<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  class="form-control e1" placeholder="Select Type" id="category_id" name="category_id" >
                                          <option value="" >Product Type</option>
                                          <?php foreach($product_categories as $product_category){ ?>
                                            <option <?php if($product_category['category_id']==$sale_invoice_info[0]['category_id']) echo "selected"; ?>   value="<?php echo $product_category['category_id'] ?>"><?php echo $product_category['category_name'] ?></option> 
                                          <?php } ?>    
                                         

                                     </select>
                                    <span id="category_id_error" style="color:red"></span>
                                </div>


                            </div>    
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Invoice No<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>                            
                                    <input class="form-control" id="inv_no" name="inv_no" type="text" value="<?php echo $sale_invoice_info[0]['inv_no']; ?>">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control datepicker" id="sale_invoice_date" name="sale_invoice_date" type="text" value="<?php echo $sale_invoice_info[0]['sale_invoice_date']; ?>">
                                    <span id="sale_invoice_date_error" style="color:red"></span>
                                </div>

                            </div>

                            
                           

                           

                          
                        

                            <div class="row">




                            </div>  

                            <div class="separator-shadow"></div>
                             <div class="row">
                                <input type="hidden" value="1" id="count" />
                                    <table class="table table-bordered" id="myTable" >
                                        <thead class="thead-color">
                                         <tr >
                                             <th>Service Name <sup style='color:red'>*</sup></th>
                                             <th>M. Unit</th>
                                             <th>Quantity</th>              
                                             <th>Unit Price</th>
                                             <th>Amount</th>
                                             <th>Remark</th>
                                          <!--   <th><a href="javascript:" class="btn btn-sm btn-primary" onclick="addRow()">+</a></th>-->
                                          </tr>
                                        </thead>
                                        <tbody id="sale_items">
                                            <?php $i=0; foreach($sale_invoice_details_info as $sale_order_details){ 
                                                    $i++;
                                                    ?>
                                                 <tr class="" id="row_<?php echo $i; ?>">
                                                    <td><input readonly style="width:140px;"  type="text"  name="service_name[]" id="item_des_c_<?php echo $i; ?>" class="issue" value="<?php echo $sale_order_details['service_name'] ?>"></td>
                                                    <td><input required  style="width:140px;"  type="text" class=""  name="mu_name[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $sale_order_details['mu_name'] ?>"></td>
                                                    <td><input onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"   style="width:140px;text-align: right;"  type="text"  name="quantity[]" id="quantity_<?php echo $i; ?>" class="issue number" value="<?php echo $sale_order_details['quantity'] ?>"></td>
                                                    <td><input onkeyup="calculateQuantityAmount(<?php echo $i; ?>)" onchange="calculateQuantityAmount(<?php echo $i; ?>)" onblur="calculateQuantityAmount(<?php echo $i; ?>)"  style="width:140px;text-align: right;"  type="text"  name="unit_price[]" id="unit_price_<?php echo $i; ?>" class="issue number" value="<?php echo $sale_order_details['unit_price'] ?>"></td>    
                                                    <td><input style="width:140px;text-align: right;" onkeyup="calculateQuantity(<?php echo $i; ?>)" onchange="calculateQuantity(<?php echo $i; ?>)" onblur="calculateQuantity(<?php echo $i; ?>)"  type="text" class=""  name="amount[]" id="amount_<?php echo $i; ?>" class="issue" value="<?php echo $sale_order_details['amount'] ?>"></td>
                                                    <td><input   style="width:140px;"  type="text" class=""  name="remark[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $sale_order_details['remark'] ?>"></td>
                                                <!--    <td><a href="javascript:" class="btn btn-sm btn-danger" onclick="deleteRow(<?php echo $i; ?>)">-</a></td>-->
                                                  </tr>
                                               <?php } ?>
                                            
                                          </tbody>
                                           <tfoot>
                                               <!--
                                                <tr>
                                                    <td colspan="4" style="text-align:right;">Pumping Cost:</td>

                                                    <td><input style="width:140px;text-align:right;" onkeyup="changePump()" id="pump"  name="pump" type="text"></td>
                                                </tr>
                                               -->
                                                <tr>
                                                    <td colspan="4" style="text-align:right;">Subtotal:</td>

                                                    <td><input readonly style="width:140px;text-align:right;" id="sub_total"  name="total_amount" type="text" value="<?php echo $sale_invoice_info[0]['total_amount']; ?>"></td>
                                                </tr>
                                            </tfoot>
                                      </table>




                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/sale_invoices') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px">GO BACK</button> </a>
                                </div>
                                <div class="col-md-2 ">
                                    <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">SAVE</button>
                                </div>
<!--                                <div class="col-md-2 ">
                                    <button class="btn btn-info button" onclick="javascript:paymentvalidation();">SAVE & PAY</button>
                                </div>-->

                            </div> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 


</form>
</div>

<script type="text/javascript">
    $('#allselect').click(function(){
        if($(this).is(':checked')==true){
            $('.each_select').prop('checked',true);
            
            var sub_total = 0;
            var sub_total_qty = 0;
            var rowCount = $('#myTable tr').length;
            var table_row = Number(rowCount) - 2;
            for (var i = 1; i <= table_row; i++) {
                if ($('.select_product_' + i).prop('checked')) {
                    var amt = $('#amount_' + i).val();
                    sub_total = sub_total + Number(amt);
                    var qty = $('#quantity_' + i).val();
                    sub_total_qty = sub_total_qty + Number(qty);

                }

            }
            var discount = Number($('#discount').val());
            sub_total=sub_total.toFixed(2);
            sub_total_qty=sub_total_qty.toFixed(2);
            $('#sub_total').val(sub_total);
            $('#final_total').val(sub_total-discount);
            $('#sub_total_qty').val(sub_total_qty);
            
            
        }else{
            var discount = Number($('#discount').val());
            $('.each_select').prop('checked',false);
            var sub_total = 0;
            $('#sub_total').val(sub_total);
            $('#final_total').val(sub_total-discount);
            var sub_total_qty = 0;
            $('#sub_total_qty').val(sub_total_qty);
            
        }
    })
    function adjustValidation(){
        //alert('test');
    }
function paymentvalidation(){
    if(validation()==true){
        
    }
}
    function validation() {
        var sale_invoice_date = $('#sale_invoice_date').val();
      
        var category_id = $('#category_id').val();

        var project_name = $('#project_name').val();
        
        var error = false;
        
        if (category_id == '') {
            $('#category_id').css('border', '1px solid red');
            $('#category_id_error').html('Please select product type');
            error = true;

        } else {
            $('#category_id').css('border', '1px solid #ccc');
            $('#category_id_error').html('');

        }

        if(sale_invoice_date == ''){
            $('#sale_invoice_date').css('border', '1px solid red');
            $('#sale_invoice_date_error').html('Please fill date field');
            error = true;

        } else {
            $('#sale_invoice_date').css('border', '1px solid #ccc');
            $('#sale_invoice_date_error').html('');

        }
       

        if(project_name == ''){
            $('#project_name_error').html('Please fill  project name field');
            $('#project_name').css('border', '1px solid red');
            error = true;
        } else {
            $('#project_name_error').html('');
            $('#project_name').css('border', '1px solid #ccc');

        }

              
        if (error == true) {
            return false;
        }
    }




    $('#do_id').change(function () {
        var do_id = $('#do_id').val();
        if(do_id != ''){
            $('#sale_items tr').remove();
            $('#attention').val('');
            $('#phone').val('');
            $('#project_id').val('');
            $('#project_name').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');

            var d = new Date();
            var n = d.getFullYear();
            var final = n.toString().substring(2);

            var data = {'do_id': do_id}
            $.ajax({
                url: '<?php echo site_url('sale_invoices/get_order_item'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {

                    var branch=msg.branch_info[0].short_name;
                    
                    if (msg.invoice_code != "") {
                        var item_id = Number(msg.invoice_code[0].inv_code) + 1;
                    } else {
                        item_id = "";
                    }

                    var item_sl_no;
                    if (item_id != '') {
                        if (item_id > 999) {
                           // item_sl_no = item_id;
                           item_sl_no = branch+"/INV/" + msg.order_info[0].c_short_name + '/' + final + '/'+ item_id;
                        } else if (item_id > 99) {
                            item_sl_no = branch+"/INV/" + msg.order_info[0].c_short_name + '/' + final + '/' + "0" + item_id;
                        } else if (item_id > 9) {
                            item_sl_no = branch+"/INV/" + msg.order_info[0].c_short_name + '/' + final + '/' + "00" + item_id;
                        } else {
                            item_sl_no = branch+"/INV/" + msg.order_info[0].c_short_name + '/' + final + '/' + "000" + item_id;
                        }
                    } else {
                        item_id = 1;
                        item_sl_no = branch+"/INV/" + msg.order_info[0].c_short_name + '/' + final + '/' + '0001';
                    }
                    
                   
                   if(msg.order_info[0].adjusted_advance_to_bill>0){ 
                        var net_advance=Number(msg.order_info[0].advance_received)-Number(msg.order_info[0].adjusted_advance_to_bill);
                   }else{
                       var net_advance=msg.order_info[0].advance_received;
                   }    
//                    $('#advance_received_amount').val(msg.order_info[0].advance_received);
//                    $('#advance_adjusted_amount').val(msg.order_info[0].advance_received);
                     
                    $('#advance_received_amount').val(net_advance);
                    $('#advance_adjusted_amount').val(net_advance);

                    $('#inv_code').val(item_id);
                    $('#inv_no').val(item_sl_no);
                    $('#h_customer_id').val(msg.order_info[0].id);
                    
                    $('#attention').val(msg.order_info[0].attention);
                    $('#phone').val(msg.order_info[0].phone);
                    $('#project_id').val(msg.order_info[0].project_id);
                    $('#project_name').val(msg.order_info[0].project_name);
                    $('#billing_address').val(msg.order_info[0].billing_address);
                    $('#billing_email').val(msg.order_info[0].billing_email);
                    $('#shipping_address').val(msg.order_info[0].shipping_address);
                    $('#shipping_email').val(msg.order_info[0].shipping_email);

                    var str = '';
                    var total = 0;
                    if(msg.item_list!=''){
                        $(msg.item_list).each(function (i, v) {
                            var amount='';
                            total = total + Number(v.amount);
                            amount=v.quantity*v.unit_price;
                            amount=amount.toFixed(2);
                            
                            str += '<tr>';
                            str += '<td>';                           
                            str +='<input readonly  style="width:80px;"  type="text"   id="dc_date" class="issue" value="' + v.delivery_challan_date + '">';
                            str +='</td>';
                            str += '<td>';
                            str +='<input type="hidden"  name="dc_details_id[]" id="dc_details_id_" class="issue" value="' + v.dc_details_id + '">';
                            str +='<input type="hidden"  name="dc_id[]" id="dc_id_" class="issue" value="' + v.dc_id + '">';
                            str +='<input readonly  style="width:140px;"  type="text"  id="dc_no" class="issue" value="' + v.dc_no + '">';
                            str +='</td>';
                            str += '<td><input type="hidden"  name="s_item_id[]" id="item_des_c1_" class="issue" value="' + v.s_item_id + '"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="' + v.product_name + '"></td>';
                            str += '<td><input readonly  style="width:80px;"  type="text"  name="mu_name[]" id="dc_no" class="issue" value="' + v.mu_name + '"></td>';
                            str += '<td><input readonly style="width:80px;text-align: right;"  type="text"  name="so_quantity[]" id="so_quantity_' + (Number(i) + 1) + '" class="issue" value="' + v.so_qty + '"></td>';
                            str += '<td><input readonly onkeyup="" onchange="" onblur=""  style="width:80px;text-align: right;"  type="text"  name="quantity[]" id="quantity_' + (Number(i) + 1) + '" class="issue" value="' + v.quantity + '"></td>';
                            str += '<td><input readonly  style="width:100px;text-align: right;"  type="text"  name="unit_price[]" id="unit_price_' + (Number(i) + 1) + '" class="issue" value="' + v.unit_price + '"></td>';
                            str += '<td><input readonly  style="width:100px;text-align: right;"  type="text" class="amount_"  name="amount[]" id="amount_' + (Number(i) + 1) + '" class="issue" value="' +amount+ '"></td>';
                            str += '<td><input  onclick="calculateSubtotal(' + (Number(i) + 1) + ')" style="width:40px;"  type="checkbox"  name="select_product[]" id="select_product_' + (Number(i) + 1) + '" class="each_select select_product_' + (Number(i) + 1) + '" value="' + i + '"></td>';
                            str += '</tr>';
                        });
                    }else{
//                         str += '<tr>';
//                         str += '<td colspan="7">No Data Found</td>';
//                         str +='</tr>';
                    }

                    //   $('#sub_total').val(total);       
                    $('#sale_items').append(str);


                }

            })
        } else {
            $('#sale_items tr').remove();
            $('#sub_total').val('');
            $('#attention').val('');
            $('#phone').val('');
            $('#project_name').val('');
            $('#project_id').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');

        }
    });


//    function calculateSubtotal(id) {
//        var sub_total = 0;
//        var sub_total_qty = 0;
//        var rowCount = $('#myTable tr').length;
//        var table_row = Number(rowCount) - 2;
//        for (var i = 1; i <= table_row; i++) {
//            if ($('.select_product_' + i).prop('checked')) {
//                var amt = $('#amount_' + i).val();
//                sub_total = sub_total + Number(amt);
//                var qty = $('#quantity_' + i).val();
//                sub_total_qty = sub_total_qty + Number(qty);
//                
//            }
//
//        }
//        var discount = Number($('#discount').val());
//        sub_total=sub_total.toFixed(2);
//        sub_total_qty=sub_total_qty.toFixed(2);
//        $('#sub_total').val(sub_total);
//        $('#final_total').val(sub_total-discount);
//        $('#sub_total_qty').val(sub_total_qty);
//    }
    
    
    
    
    
    
    
    function project_info(){
               
            var customer_id=$('#customer_id').val();
            if(customer_id!=''){
                $.ajax({
                    type: "POST",
                    url: "backend/sale_invoices/customer_project_info",
                    data: "customer_id="+customer_id,
                    dataType: "json",
                    success: function (data) {
                       
                                
                                 var str = '';
                                 str += '<option class="form-controll" value="">Select Project</option>';
                                 $(data.project).each(function (row, val) {
                                     
                                     str += '<option class="form-controll" value="' + val.project_id + '">' + val.project_name + '</option>';
                                 })
                                 $('#project_id').html(str);

//                                 var str1='';
//                                 str1 += '<option class="form-controll" value="">Select Sales Order</option>';
//                                 $(data.order_info).each(function (row1, v) {
//                                     str1 += '<option class="form-controll" value="' + v.o_id + '">' + v.order_no + '</option>';
//                                 })
//                                 $('#o_id').html(str1);
                    }         
                })
          }else{
              
           $('#project_id').html(''); 
           $('#o_id').html('');  
              
              
            var str;
            str += '<option class="form-controll" value="">Select Project</option>';  
            $('#project_id').html(str); 

            var str1;
            str1 += '<option class="form-controll" value="">Select Sales Order</option>';  
            $('#o_id').html(str1);  
          }  
      }

    function sales_order_info(){
               
                var project_id=$('#project_id').val();
            //    alert(project_id);
                if(project_id!=''){
                //    alert(project_id);
                    $.ajax({
                        type: "POST",
                        url: "backend/sale_invoices/salesOrderInfoProjectWise",
                        data: "project_id="+project_id,
                        dataType: "json",
                        success: function (data){
                            var str1='';
                            str1 += '<option class="form-controll" value="">Select Sales Order</option>';
                            $(data.so_order_info).each(function (row1, v) {
                                str1 += '<option class="form-controll" value="' + v.o_id + '">' + v.order_no + '</option>';
                            })
                            $('#o_id').html(str1);
                        }         
                    })
              }else{

                var str1;
                str1 += '<option class="form-controll" value="">Select Sales Order</option>';  
                $('#o_id').html(str1);  
              }  
      }
    function delivery_order_info(){
               
            var o_id=$('#o_id').val();
            $('#do_id').html(str1);     
            if(o_id!=''){
                    $.ajax({
                        type: "POST",
                        url: "backend/sale_invoices/deliveryOrderInfoSaleOrderWise",
                        data: "o_id="+o_id,
                        dataType: "json",
                        success: function (data){
                            var str1='';
                            str1 += '<option class="form-controll" value="">Select Delivery Order</option>';
                            $(data.do_order_info).each(function (row1, v) {
                                str1 += '<option class="form-controll" value="' + v.do_id + '">' + v.delivery_no + '</option>';
                            })
                            $('#do_id').html(str1);
                        }         
                    })
            }else{

                var str1;
                str1 += '<option class="form-controll" value="">Select Delivery Order</option>';  
                $('#do_id').html(str1);  
            }  
      }
      



    function addRow(){
        var str = '';
        var i = $('#sale_items').find('tr').length;
        str+='<tr id="row_'+(Number(i) + 1)+'">';
        str +='<td><select name="s_item_id[]" id="prod_'+(Number(i) + 1)+'" class="form-control" onchange="changeProduct('+(Number(i) + 1)+')"><option value="">Select Product</option>';
        <?php foreach($products as $r){?>
            str+='<option rel="<?php echo $r['measurement_unit']; ?>" value="<?php echo $r['product_id']; ?>"><?php echo $r['product_name']; ?></option>';
        <?php } ?>
        str +='</select></td>';

         str +='<td><input required  style="width:140px;"  type="text"  name="mu_name[]" id="mu_name_'+(Number(i) + 1) + '" class="issue" value=""></td>';
        str +='<td><input required onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:140px;text-align:right;"  type="text"  name="quantity[]" id="quantity_'+(Number(i) + 1)+'" class="issue number" value=""></td>';
        str +='<td><input required onkeyup="calculateQuantityAmount('+(Number(i) + 1)+')" onchange="calculateQuantityAmount('+(Number(i) + 1)+')" onblur="calculateQuantityAmount('+(Number(i) + 1)+')"  style="width:140px;text-align:right;"  type="text"  name="unit_price[]" id="unit_price_'+(Number(i) + 1)+'" class="issue number" value=""></td>';
        str +='<td><input onkeyup="calculateQuantity('+(Number(i) + 1)+')" onchange="calculateQuantity('+(Number(i) + 1)+')" onblur="calculateQuantity('+(Number(i) + 1)+')" style="width:140px;text-align:right;"  type="text" class="amount_"  name="amount[]" id="amount_'+(Number(i) + 1)+'" class="issue" value=""></td>'; 
        str +='<td><input   style="width:140px;"  type="text"  name="remark[]" id="remark_'+(Number(i) + 1) + '" class="issue" value=""></td>';
        str +='<td><a href="javascript:" class="btn btn-sm btn-danger" onclick="deleteRow('+(Number(i) + 1)+')">-</a></td>';
        str+='</tr>';
        $('#sale_items').append(str);
    }

     function deleteRow(row){
        if(confirm('Are you sure to remove ?')==true)
        $('#row_'+row).remove();
        calculateSubtotal(row);
   }

   function changeProduct(row){
       $('#mu_name_'+row).val($('#prod_'+row).find('option:selected').attr('rel'));
   }
   
   function changePump(){
        var sub_total = 0;
        var rowCount = $('#myTable tr').length;
        var table_row=Number(rowCount)-3;
        for(var i=1;i<=table_row;i++){
            var amt=$('#amount_'+i).val();
            sub_total=sub_total+Number(amt)
        }
        sub_total=sub_total+Number($('#pump').val())
        sub_total=sub_total.toFixed(2);
        $('#sub_total').val(sub_total);
   }
   
   function calculateSubtotal(id){
        $('.number').on('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);  
        });
    
         var sub_total=0;
         var unit_price=$('#unit_price_'+id).val();
         var quantity=$('#quantity_'+id).val();
         var amount=Number(unit_price)*Number(quantity);
         amount=amount.toFixed(2);
         $('#amount_'+id).val(amount);
         var rowCount = $('#myTable tr').length;
        // var table_row=Number(rowCount)-3;
         var table_row=Number(rowCount)-2;
         for(var i=1;i<=table_row;i++){
             var amt=$('#amount_'+i).val();
             sub_total=sub_total+Number(amt)
         }
       //  sub_total=sub_total+Number($('#pump').val())
         sub_total=sub_total.toFixed(2);
         $('#sub_total').val(sub_total);
         
        
       
    }


function calculateQuantityAmount(id){
        $('.number').on('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);  
        });
    
         var sub_total=0;
         var unit_price=$('#unit_price_'+id).val();
         var quantity=$('#quantity_'+id).val();
         if(quantity!=''){
            var amount=Number(unit_price)*Number(quantity);
            amount=amount.toFixed(2);
             $('#amount_'+id).val(amount);
         }else{
             var amount=$('#amount_'+id).val('');
             if(amount!=''){
                 quantity=Number(amount)/Number(unit_price);
                 quantity=quantity.toFixed(2);
                 $('#quantity_'+id).val(quantity);
             }    
         }    
        
         var rowCount = $('#myTable tr').length;
        // var table_row=Number(rowCount)-3;
         var table_row=Number(rowCount)-2;
         for(var i=1;i<=table_row;i++){
             var amt=$('#amount_'+i).val();
             sub_total=sub_total+Number(amt)
         }
       //  sub_total=sub_total+Number($('#pump').val())
         sub_total=sub_total.toFixed(2);
         $('#sub_total').val(sub_total);
         
        
       
    }

    function calculateQuantity(id){
        $('.number').on('input', function (event){
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);  
        });
    
         var sub_total=0;
         var unit_price=Number($('#unit_price_'+id).val());         
         var amount=Number($('#amount_'+id).val());
         var quantity=amount/unit_price;
         quantity=quantity.toFixed(2);
         $('#quantity_'+id).val(quantity);
         var rowCount = $('#myTable tr').length;
        // var table_row=Number(rowCount)-3;
         var table_row=Number(rowCount)-2;
         for(var i=1;i<=table_row;i++){
             var amt=$('#amount_'+i).val();
             sub_total=sub_total+Number(amt)
         }
       //  sub_total=sub_total+Number($('#pump').val())
         sub_total=sub_total.toFixed(2);
         $('#sub_total').val(sub_total);
         
        
       
    }



</script>

