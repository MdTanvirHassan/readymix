
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
                <h3>Add Invoice</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" action="<?php echo site_url('raw_materials/sale_invoices/add_sale_invoice_action'); ?>" method="post" onsubmit="javascript: return validation()">

                             <div class='form-group' style="margin-bottom:15px;" >
                                <label for="title" class="col-sm-2 control-label">
                                     Select customer<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  class="form-control e1" placeholder="Select Customer" id="customer_id" name="customer_id" onchange="javascript:customerWiseChallan();" >
                                          <option value="" >Select customer</option>
                                        <?php foreach($customers as $customer){ ?>
                                           <option <?php if($customer_id==$customer['id']) echo 'selected'; ?>  value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option> 
                                        <?php } ?>    
                                         

                                     </select> 
                                    <span id="do_id_error" style="color:red"></span>
                                </div>


                            </div>
                            
                            
                            
                            
                            
                        
                            <div class='form-group' style="margin-bottom:15px;" >
                                <label for="title" class="col-sm-2 control-label">
                                    Select Delivery Order<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select id="do_id" class="form-control e1" name="do_id">
                                        <option class="form-control" value="">Delivery Order</option>
                                        <?php foreach ($orders as $order) { ?>
                                            <option class="form-control" value="<?php echo $order['do_id'] ?>"><?php echo $order['c_short_name'].'('.$order['delivery_no'].')' ?></option>
                                        <?php } ?>
                                    </select>
                                    <span id="do_id_error" style="color:red"></span>
                                </div>


                            </div>
                       
                       
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Invoice No<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    
                                    <input class="form-control" id="inv_code" name="inv_code" type="hidden" value="">
                                    <input  readonly class="form-control" id="inv_no" name="inv_no" type="text" value="">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control datepicker" id="sale_invoice_date" name="sale_invoice_date" type="text" value="<?php echo date('d-m-Y') ?>">
                                    <span id="sale_invoice_date_error" style="color:red"></span>
                                </div>

                            </div>

                            

                            <div class='form-group' >
                                
                                <label for="title" class="col-sm-2 control-label">
                                    B. Address<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control" id="billing_address" name="billing_address" type="text" placeholder="Billing Address">
                                    <span id="billing_address_error" style="color:red"></span>
                                </div>
                                
                                <label for="title" class="col-sm-2 control-label">
                                    B. Email :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="billing_email" name="billing_email" type="text" placeholder="Billing Email">
                                    <span id="billing_email_error" style="color:red"></span>
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
                                            <th>Do No.</th>
                                            <th>Challan Date</th>
                                            <th>Challan No.</th>
                                            <th>Product Name <sup style='color:red'>*</sup></th>
                                            <th>M. Unit</th> 
                                            
                                            <th>Quantity</th>      
                                            <th>Unit Price</th>          
                                            <th>Amount</th>
                                            <th><input type="checkbox" id="allselect" ></th>

                                        </tr>
                                    </thead>
                                    <tbody id="sale_items">


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" style="text-align:right;">Subtotal:</td>
                                            <td><input readonly style="width:140px;text-align: right;" id="sub_total_qty"  name="" type="text"></td>
                                            <td>
                                            <!--    <input readonly style="width:140px;text-align: right;" id=""  name="" type="text">-->
                                            </td>
                                            <td><input readonly style="width:140px;text-align: right;" id="sub_total"  name="sub_total_amount" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" style="text-align:right;">Discount:</td>
                                            <td><input onkeyup="calculateSubtotal()" style="width:140px;text-align: right;" id="discount"  name="discount" type="text"></td>
                                            <td>
                                            <!--    <input readonly style="width:140px;text-align: right;" id=""  name="" type="text">-->
                                            </td>
                                            <td><input readonly style="width:140px;text-align: right;" id="final_total"  name="total_amount" type="text"></td>
                                        </tr>
                                    </tfoot>
                                </table>




                            </div>



                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/raw_materials/sale_invoices') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px">GO BACK</button> </a>
                                </div>
                                <div class="col-md-2 ">
                                    <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">SAVE</button>
                                </div>


                            </div> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 


</form>
</div>

<script type="text/javascript">
    
    function customerWiseChallan(){
        var customer_id = $('#customer_id').val();
       
        if (customer_id != '') {
            $('#sale_items tr').remove();
            
            
            $('#billing_address').val('');
            $('#billing_email').val('');
            

            var d = new Date();
            var n = d.getFullYear();
            var final = n.toString().substring(2);

            var data = {'customer_id': customer_id}
            $.ajax({
                url: '<?php echo site_url('raw_materials/sale_invoices/customerWiseChallan'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {


                    $('#do_id').html();
                    var str1='';
                    str1 += '<option class="form-controll" value="">Select Delivery Order</option>';
                    
                    $(msg.do_order_info).each(function (row1,v) {                       
                        str1 += '<option class="form-controll" value="' + v.do_id + '">' + v.delivery_no + '</option>';
                    })
                    
                    $('#do_id').html(str1);




                    var branch=msg.branch_info[0].short_name;
                    
                    if (msg.invoice_code != "") {
                        var item_id = Number(msg.invoice_code)+1;
                    } else {
                        item_id = "";
                    }

                    var item_sl_no;
                    if (item_id != '') {
                        if (item_id > 999) {
                           // item_sl_no = item_id;
                           item_sl_no ="YARD/INV/" + msg.customer_info[0].c_short_name + '/' + final + '/'+ item_id;
                        } else if (item_id > 99) {
                            item_sl_no ="YARD/INV/" + msg.customer_info[0].c_short_name + '/' + final + '/' + "0" + item_id;
                        } else if (item_id > 9) {
                            item_sl_no ="YARD/INV/" + msg.customer_info[0].c_short_name + '/' + final + '/' + "00" + item_id;
                        } else {
                            item_sl_no ="YARD/INV/" + msg.customer_info[0].c_short_name + '/' + final + '/' + "000" + item_id;
                        }
                    } else {
                        item_id = 1;
                        item_sl_no ="YARD/INV/" + msg.customer_info[0].c_short_name + '/' + final + '/' + '0001';
                    }
                    
                   
                   
                    $('#inv_code').val(item_id);
                    $('#inv_no').val(item_sl_no);
                    
                    
                   
                    
                    $('#billing_address').val(msg.customer_info[0].c_contact_address);
                    $('#billing_email').val(msg.customer_info[0].head_office_email);
                    

                    var str = '';
                    var total = 0;
                    if(msg.item_list!=''){
                        $(msg.item_list).each(function (i, v) {
                            var amount='';
                            total = total + Number(v.amount);
                            amount=v.quantity*v.unit_price;
                            amount=amount.toFixed(2);
                            
                            str += '<tr>';
                            str += '<td><input readonly style="width:200px;text-align: left;"  type="text"  name="do_no[]" id="do_no_' + (Number(i) + 1) + '" class="issue" value="'+v.delivery_no+'"></td>';
                            str += '<td>';                           
                            str +='<input readonly  style="width:80px;"  type="text"   id="dc_date" class="issue" value="' + v.delivery_challan_date + '">';
                            str +='</td>';
                            str += '<td>';
                            str +='<input type="hidden"  name="dc_details_id[]" id="dc_details_id_" class="issue" value="' + v.dc_details_id + '">';
                            str +='<input type="hidden"  name="dc_id[]" id="dc_id_" class="issue" value="' + v.dc_id + '">';
                            str +='<input readonly  style="width:200px;"  type="text"  id="dc_no" class="issue" value="' + v.dc_no + '">';
                            str +='</td>';
                            str += '<td><input type="hidden"  name="s_item_id[]" id="item_des_c1_" class="issue" value="' + v.s_item_id + '"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="' + v.item_name + '"></td>';
                            str += '<td><input readonly  style="width:80px;"  type="text"  name="mu_name[]" id="dc_no" class="issue" value="' + v.meas_unit + '"></td>';
                            
                            str += '<td><input readonly onkeyup="" onchange="" onblur=""  style="width:80px;text-align: right;"  type="text"  name="quantity[]" id="quantity_' + (Number(i) + 1) + '" class="issue" value="' + v.quantity + '"></td>';
                            str += '<td><input readonly  style="width:100px;text-align: right;"  type="text"  name="unit_price[]" id="unit_price_' + (Number(i) + 1) + '" class="issue" value="' + v.unit_price + '"></td>';
                            str += '<td><input readonly  style="width:100px;text-align: right;"  type="text" class="amount_"  name="amount[]" id="amount_' + (Number(i) + 1) + '" class="issue" value="' +amount+ '"></td>';
                            str += '<td><input  onclick="calculateSubtotal(' + (Number(i) + 1) + ')" style="width:40px;"  type="checkbox"  name="select_product[]" id="select_product_' + (Number(i) + 1) + '" class="each_select select_product_' + (Number(i) + 1) + '" value="' + i + '"></td>';
                            str += '</tr>';
                        });
                    }else{

                    }

                    
                    $('#sale_items').append(str);


                }

            })
        } else {
            $('#sale_items tr').remove();
            $('#sub_total').val('');
            
            
            $('#billing_address').val('');
            $('#billing_email').val('');
            
        }
    }
    
    
    
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
        
       

       
       
        var billing_address = $('#billing_address').val();
        var billing_email = $('#billing_email').val();
        

        var error = false;
        
        

        if (sale_invoice_date == '') {
            $('#sale_invoice_date').css('border', '1px solid red');
            $('#sale_invoice_date_error').html('Please fill date field');
            error = true;

        } else {
            $('#sale_invoice_date').css('border', '1px solid #ccc');
            $('#sale_invoice_date_error').html('');

        }
        

        

        
        if(billing_address == '') {
            $('#billing_address_error').html('Please fill billing address field');
            $('#billing_address').css('border', '1px solid red');
            error = true;
        } else {
            $('#billing_address_error').html('');
            $('#billing_address').css('border', '1px solid #ccc');

        }

        if (billing_email == '') {
//            $('#billing_email_error').html('Please fill billing email field');
//            $('#billing_email').css('border', '1px solid red');
//            error = true;
        } else {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(billing_email)) {
                $('#billing_email_error').html('Invalid email address');
                $('#billing_email').css('border', '1px solid red');
                error = true;
                $('#billing_email').focus();
            } else {
                $('#billing_email_error').html('');
                $('#billing_email').css('border', '1px solid #ccc');
            }

        }

        



        if (error == true) {
            return false;
        }
    }




    $('#do_id').change(function () {
        var do_id = $('#do_id').val();
        if (do_id != '') {
            
           $('#sale_items tr').remove();

            var data = {'do_id': do_id}
            $.ajax({
                url: '<?php echo site_url('raw_materials/sale_invoices/get_order_item'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {

                    var str = '';
                    var total = 0;
                    
                    if(msg.item_list!=''){
                        $(msg.item_list).each(function (i, v) {
                            var amount='';
                            total = total + Number(v.amount);
                            amount=v.quantity*v.unit_price;
                            amount=amount.toFixed(2);
                            
                            str += '<tr>';
                            str += '<td><input readonly style="width:200px;text-align: left;"  type="text"  name="do_no[]" id="do_no_' + (Number(i) + 1) + '" class="issue" value="'+v.delivery_no+'"></td>';
                            str += '<td>';                           
                            str +='<input readonly  style="width:80px;"  type="text"   id="dc_date" class="issue" value="' + v.delivery_challan_date + '">';
                            str +='</td>';
                            str += '<td>';
                            str +='<input type="hidden"  name="dc_details_id[]" id="dc_details_id_" class="issue" value="' + v.dc_details_id + '">';
                            str +='<input type="hidden"  name="dc_id[]" id="dc_id_" class="issue" value="' + v.dc_id + '">';
                            str +='<input readonly  style="width:200px;"  type="text"  id="dc_no" class="issue" value="' + v.dc_no + '">';
                            str +='</td>';
                            str += '<td><input type="hidden"  name="s_item_id[]" id="item_des_c1_" class="issue" value="' + v.s_item_id + '"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="' + v.item_name + '"></td>';
                            str += '<td><input readonly  style="width:80px;"  type="text"  name="mu_name[]" id="dc_no" class="issue" value="' + v.meas_unit + '"></td>';
                            
                            str += '<td><input readonly onkeyup="" onchange="" onblur=""  style="width:80px;text-align: right;"  type="text"  name="quantity[]" id="quantity_' + (Number(i) + 1) + '" class="issue" value="' + v.quantity + '"></td>';
                            str += '<td><input readonly  style="width:100px;text-align: right;"  type="text"  name="unit_price[]" id="unit_price_' + (Number(i) + 1) + '" class="issue" value="' + v.unit_price + '"></td>';
                            str += '<td><input readonly  style="width:100px;text-align: right;"  type="text" class="amount_"  name="amount[]" id="amount_' + (Number(i) + 1) + '" class="issue" value="' +amount+ '"></td>';
                            str += '<td><input  onclick="calculateSubtotal(' + (Number(i) + 1) + ')" style="width:40px;"  type="checkbox"  name="select_product[]" id="select_product_' + (Number(i) + 1) + '" class="each_select select_product_' + (Number(i) + 1) + '" value="' + i + '"></td>';
                            str += '</tr>';
                        });
                    }else{

                    }

                    $('#sale_items').append(str);
                }

            })
        } else {
            $('#sale_items tr').remove();
            $('#sub_total').val('');
           

        }
    });


    function calculateSubtotal(id) {
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
    }
    
    
    

    
    function delivery_order_info(){
               
            var customer_id=$('#customer_id').val();
            $('#do_id').html(str1);     
            if(customer_id!=''){
                    $.ajax({
                        type: "POST",
                        url: "backend/raw_materials/sale_invoices/deliveryOrderInfoCustomerWise",
                        data: "customer_id="+customer_id,
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
      



</script>

