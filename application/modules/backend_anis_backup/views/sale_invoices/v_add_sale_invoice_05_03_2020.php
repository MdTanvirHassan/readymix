
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
                        <form class="form-horizontal" action="<?php echo site_url('sale_invoices/add_sale_invoice_action'); ?>" method="post" onsubmit="javascript: return validation()">

                           
                            
                            
                            
                            
                            
                  
                            <div class='form-group' style="margin-bottom:30px;" >
                                <label for="title" class="col-sm-2 control-label">
                                    Select Order<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select id="do_id" class="form-control e1" name="do_id">
                                        <option class="form-control" value="">Delivery Order</option>
                                        <?php foreach ($orders as $order) { ?>
                                            <option class="form-control" value="<?php echo $order['do_id'] ?>"><?php echo $order['c_short_name'] . '(' . $order['project_name'] . ')' . '(' . $order['delivery_no'] . ')' ?></option>
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
                                    <input type="hidden" id="customer_id" name="customer_id" value="" >
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
                                    Project Name <sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  readonly class="form-control" id="project_name" name="project_name" type="text">
                                    <span id="project_name_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Attention<sup class="required"></sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control" id="attention" name="attention" type="text" placeholder="Attention Person Name">
                                    <span id="attention_error" style="color:red"></span>
                                </div>

                            </div>

                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Phone<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="phone" name="phone" type="text" placeholder="Phone Number">
                                    <span id="phone_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    B. Address<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control" id="billing_address" name="billing_address" type="text" placeholder="Billing Address">
                                    <span id="billing_address_error" style="color:red"></span>
                                </div>

                            </div>

                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    B. Email :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="billing_email" name="billing_email" type="text" placeholder="Billing Email">
                                    <span id="billing_email_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    D. Address<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control" id="shipping_address" name="shipping_address" type="text" placeholder="Delivery Address">
                                    <span id="shipping_address_error" style="color:red"></span>
                                </div>

                            </div>

                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    D. Email<sup class="required"></sup> :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="shipping_email" name="shipping_email" type="text" placeholder="Delivery Email">
                                    <span id="shipping_email_error" style="color:red"></span>
                                </div>
                                
                                
                                <label for="title" class="col-sm-2 control-label">
                                    Advance Received Amount :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input readonly  class="form-control" id="advance_received_amount" name="advance_received_amount" type="text" placeholder="Received Amount">
                                    <span id="received_amount_error" style="color:red"></span>
                                </div>


                            </div>

                            <div class='form-group' >
                                
                                
                                
                                <label for="title" class="col-sm-2 control-label">
                                    Advance Adjusted Amount :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" onkeyup="javascript:adjustValidation();" onchange="javascript:adjustValidation();" id="advance_adjusted_amount" name="advance_adjusted_amount" type="text" placeholder="Adjusted Amount">
                                    <span id="received_amount_error" style="color:red"></span>
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
                                            <th>Challan Date</th>
                                            <th>Challan No.</th>
                                            <th>Product Name <sup style='color:red'>*</sup></th>
                                            <th>M. Unit</th> 
                                            <th>S.O Qty</th>      
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
        var do_id = $('#do_id').val();

        var project_name = $('#project_name').val();
        var attention = $('#attention').val();
        var phone = $('#phone').val();
        var billing_address = $('#billing_address').val();
        var billing_email = $('#billing_email').val();
        var shipping_address = $('#shipping_address').val();
        var shipping_email = $('#shipping_email').val();

        var error = false;

        if (sale_invoice_date == '') {
            $('#sale_invoice_date').css('border', '1px solid red');
            $('#sale_invoice_date_error').html('Please fill date field');
            error = true;

        } else {
            $('#sale_invoice_date').css('border', '1px solid #ccc');
            $('#sale_invoice_date_error').html('');

        }
        if (do_id == '') {
            $('#do_id_error').html('Please select quotation');
            $('#do_id').css('border', '1px solid red');
            error = true;
        } else {
            $('#do_id_error').html('');
            $('#do_id').css('border', '1px solid #ccc');

        }

        if (project_name == '') {
            $('#project_name_error').html('Please fill  project name field');
            $('#project_name').css('border', '1px solid red');
            error = true;
        } else {
            $('#project_name_error').html('');
            $('#project_name').css('border', '1px solid #ccc');

        }

        if (attention == '') {
//            $('#attention_error').html('Please fill  attention field');
//            $('#attention').css('border', '1px solid red');
//            error = true;
        } else {
            $('#attention_error').html('');
            $('#attention').css('border', '1px solid #ccc');

        }

        if (phone == '') {
//            $('#phone_error').html('Please fill phone number field');
//            $('#phone').css('border', '1px solid red');
//            error = true;
        } else {
            $('#phone_error').html('');
            $('#phone').css('border', '1px solid #ccc');

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

        if(shipping_address == '') {
            $('#shipping_address_error').html('Please fill delivery address field');
            $('#shipping_address').css('border', '1px solid red');
            error = true;
        } else {
            $('#shipping_address_error').html('');
            $('#shipping_address').css('border', '1px solid #ccc');

        }

        if (shipping_email == '') {
//            $('#shipping_email_error').html('Please fill delivery email field');
//            $('#shipping_email').css('border', '1px solid red');
//            error = true;
        } else {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(shipping_email)) {
                $('#shipping_email_error').html('Invalid email address');
                $('#shipping_email').css('border', '1px solid red');
                error = true;
                $('#shipping_email').focus();
            } else {
                $('#shipping_email_error').html('');
                $('#shipping_email').css('border', '1px solid #ccc');
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


                    if (msg.invoice_code != "") {
                        var item_id = Number(msg.invoice_code[0].inv_code) + 1;
                    } else {
                        item_id = "";
                    }

                    var item_sl_no;
                    if (item_id != '') {
                        if (item_id > 999) {
                            item_sl_no = item_id;
                        } else if (item_id > 99) {
                            item_sl_no = "INV/" + msg.order_info[0].c_short_name + '/' + final + '/' + "0" + item_id;
                        } else if (item_id > 9) {
                            item_sl_no = "INV/" + msg.order_info[0].c_short_name + '/' + final + '/' + "00" + item_id;
                        } else {
                            item_sl_no = "INV/" + msg.order_info[0].c_short_name + '/' + final + '/' + "000" + item_id;
                        }
                    } else {
                        item_id = 1;
                        item_sl_no = "INV/" + msg.order_info[0].c_short_name + '/' + final + '/' + '0001';
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
                    $('#customer_id').val(msg.order_info[0].id);

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


</script>

