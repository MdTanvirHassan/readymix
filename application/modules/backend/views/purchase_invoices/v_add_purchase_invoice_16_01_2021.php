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
                        <form class="form-horizontal" action="<?php echo site_url('purchase_invoices/add_purchase_invoice_action'); ?>" method="post" onsubmit="javascript: return validation()">

                            <div class='form-group' style="" >
                                <label for="title" class="col-sm-2 control-label">
                                    Select Order<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select id="po_id" class="form-control e1" name="po_id">
                                        <option class="form-control" value="">Select Order</option>
                                     
                                        <?php foreach ($orders as $order) { ?>
                                            <option class="form-control" value="<?php echo $order['o_id'] ?>"><?php echo $order['SUP_NAME'] . '(' . $order['short_name'] . ')' . '(' . $order['order_no'] . ')' ?></option>
                                        <?php } ?>
                                    </select>
                                    <span id="po_id_error" style="color:red"></span>
                                </div>


                            </div>


                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Invoice No<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="hidden" id="supplier_id" name="supplier_id" value="" >
                                    <input class="form-control" id="inv_code" name="inv_code" type="hidden" value="">
                                    <input  readonly class="form-control" id="inv_no" name="inv_no" type="text" value="">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control datepicker" id="purchase_invoice_date" name="invoice_date" type="text" value="<?php echo date('d-m-Y') ?>">
                                    <span id="purchase_invoice_date_error" style="color:red"></span>
                                </div>

                            </div>

                           <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                   Customer Bill No.<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="supplier_bill_no" name="supplier_bill_no" type="text" placeholder="Reference Number">
                                    <span id="supplier_bill_no_error" style="color:red"></span>
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
                                    B. Email<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="billing_email" name="billing_email" type="text" placeholder="BIlling Email">
                                    <span id="billing_email_error" style="color:red"></span>
                                </div>

                               

                            </div>

                            <div class='form-group' >
                                

                            </div>



                            <div class="row">




                            </div>  

                           <div class="separator-shadow row"></div>
                            <div class="row">
                                <input type="hidden" value="1" id="count" />
                                <table class="table table-bordered" id="myTable" >
                                    <thead class="thead-color">
                                        <tr >
                                            <th>Challan No.</th>
                                            <th>Item Name <sup style='color:red'>*</sup></th>
                                            <th>Unit</th> 
                                            <th>Quantity</th>      
                                            <th>Unit Price</th>          
                                            <th>Amount</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody id="purchase_items">


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" style="text-align:right;">Subtotal:</td>

                                            <td><input readonly style="width:140px;text-align: right;" id="sub_total"  name="total_amount" type="text"></td>
                                        </tr>
                                    </tfoot>
                                </table>




                            </div>



                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/purchase_invoices') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px">GO BACK</button> </a>
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

    function validation() {
        var purchase_invoice_date = $('#purchase_invoice_date').val();
        var po_id = $('#po_id').val();

//        var project_name = $('#project_name').val();
//        var attention = $('#attention').val();
//        var phone = $('#phone').val();
        var billing_address = $('#billing_address').val();
        var billing_email = $('#billing_email').val();
        var supplier_bill_no=$('#supplier_bill_no').val();
//        var shipping_address = $('#shipping_address').val();
//        var shipping_email = $('#shipping_email').val();

        var error = false;

        if (purchase_invoice_date == '') {
            $('#purchase_invoice_date').css('border', '1px solid red');
            $('#purchase_invoice_date_error').html('Please fill date field');
            error = true;

        } else {
            $('#purchase_invoice_date').css('border', '1px solid #ccc');
            $('#purchase_invoice_date_error').html('');

        }
        if (po_id == '') {
            $('#po_id_error').html('Please select order');
            $('#po_id').css('border', '1px solid red');
            error = true;
        } else {
            $('#po_id_error').html('');
            $('#po_id').css('border', '1px solid #ccc');

        }

//        if (project_name == '') {
//            $('#project_name_error').html('Please fill  project name field');
//            $('#project_name').css('border', '1px solid red');
//            error = true;
//        } else {
//            $('#project_name_error').html('');
//            $('#project_name').css('border', '1px solid #ccc');
//
//        }
//
//        if (attention == '') {
//            $('#attention_error').html('Please fill  attention field');
//            $('#attention').css('border', '1px solid red');
//            error = true;
//        } else {
//            $('#attention_error').html('');
//            $('#attention').css('border', '1px solid #ccc');
//
//        }
//
//        if (phone == '') {
//            $('#phone_error').html('Please fill phone number field');
//            $('#phone').css('border', '1px solid red');
//            error = true;
//        } else {
//            $('#phone_error').html('');
//            $('#phone').css('border', '1px solid #ccc');
//
//        }

        if (supplier_bill_no == '') {
//            $('#supplier_bill_no_error').html('Please fill reference no field');
//            $('#supplier_bill_no').css('border', '1px solid red');
//            error = true;
        } else {
            $('#supplier_bill_no_error').html('');
            $('#supplier_bill_no').css('border', '1px solid #ccc');

        }
        
        if (billing_address == '') {
//            $('#billing_address_error').html('Please fill billing address  field');
//            $('#billing_address').css('border', '1px solid red');
//            error = true;
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

//        if (shipping_address == '') {
//            $('#shipping_address_error').html('Please fill delivery address field');
//            $('#shipping_address').css('border', '1px solid red');
//            error = true;
//        } else {
//            $('#shipping_address_error').html('');
//            $('#shipping_address').css('border', '1px solid #ccc');
//
//        }
//
//        if (shipping_email == '') {
//            $('#shipping_email_error').html('Please fill delivery email field');
//            $('#shipping_email').css('border', '1px solid red');
//            error = true;
//        } else {
//            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
//            if (!regex.test(shipping_email)) {
//                $('#shipping_email_error').html('Invalid email address');
//                $('#shipping_email').css('border', '1px solid red');
//                error = true;
//                $('#shipping_email').focus();
//            } else {
//                $('#shipping_email_error').html('');
//                $('#shipping_email').css('border', '1px solid #ccc');
//            }
//
//        }



        if (error == true) {
            return false;
        }
    }




    $('#po_id').change(function () {
        var po_id = $('#po_id').val();
        if (po_id != '') {
            $('#purchase_items tr').remove();
//            $('#attention').val('');
//            $('#phone').val('');
//            $('#project_id').val('');
//            $('#project_name').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
//            $('#shipping_address').val('');
//            $('#shipping_email').val('');

            var d = new Date();
            var n = d.getFullYear();
            var final = n.toString().substring(2);

            var data = {'po_id': po_id}
            $.ajax({
                url: '<?php echo site_url('purchase_invoices/get_order_item'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {

             //    alert('test');
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
                            item_sl_no = "INV/" + msg.order_info[0].SUP_NAME + '/' + final + '/' + "0" + item_id;
                        } else if (item_id > 9) {
                            item_sl_no = "INV/" + msg.order_info[0].SUP_NAME + '/' + final + '/' + "00" + item_id;
                        } else {
                            item_sl_no = "INV/" + msg.order_info[0].SUP_NAME + '/' + final + '/' + "000" + item_id;
                        }
                    } else {
                        item_id = 1;
                        item_sl_no = "INV/" + msg.order_info[0].SUP_NAME + '/' + final + '/' + '0001';
                    }

                    $('#inv_code').val(item_id);
                    $('#inv_no').val(item_sl_no);
                    $('#supplier_id').val(msg.order_info[0].ID);

//                    $('#attention').val(msg.order_info[0].attention);
//                    $('#phone').val(msg.order_info[0].phone);
//                    $('#project_id').val(msg.order_info[0].project_id);
//                    $('#project_name').val(msg.order_info[0].project_name);
                    $('#billing_address').val(msg.order_info[0].billing_address);
                    $('#billing_email').val(msg.order_info[0].billing_email);
//                    $('#shipping_address').val(msg.order_info[0].shipping_address);
//                    $('#shipping_email').val(msg.order_info[0].shipping_email);
                  
                    var str = '';
                    var total = 0;
                    $(msg.item_list).each(function (i, v) {
                        total = total + Number(v.amount);
                        str += '<tr>';
                        str += '<td><input type="hidden"  name="mrrd_id[]" id="mrrd_id_" class="issue" value="' + v.mrrd_id + '"><input type="hidden"  name="mrr_id[]" id="dc_id_" class="issue" value="' + v.mrr_id + '"><input readonly  style="width:140px;"  type="text"  name="dc_no[]" id="dc_no" class="issue" value="' + v.mrr_challan + '"></td>';
                        str += '<td><input type="hidden"  name="item_id[]" id="item_des_c1_" class="issue" value="' + v.item_id + '"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="' + v.item_name + '"></td>';
                        str += '<td><input readonly  style="width:140px;"  type="text"  name="measurement_unit[]" id="dc_no" class="issue" value="' + v.meas_unit + '"></td>';
                        str += '<td><input readonly onkeyup="" onchange="" onblur=""  style="width:140px;text-align: right;"  type="text"  name="quantity[]" id="quantity_' + (Number(i) + 1) + '" class="issue" value="' + v.receive_qty + '"></td>';
                        str += '<td><input readonly  style="width:140px;text-align: right;"  type="text"  name="unit_price[]" id="unit_price_' + (Number(i) + 1) + '" class="issue" value="' + v.unit_price + '"></td>';
                        str += '<td><input readonly  style="width:140px;text-align: right;"  type="text" class="amount_"  name="amount[]" id="amount_' + (Number(i) + 1) + '" class="issue" value="' + v.amount + '"></td>';
                        str += '<td><input  onclick="calculateSubtotal(' + (Number(i) + 1) + ')" style="width:40px;"  type="checkbox"  name="select_product[]" id="select_product_' + (Number(i) + 1) + '" class="select_product_' + (Number(i) + 1) + '" value="' + i + '"></td>';
                        str += '</tr>';
                    });

                    //   $('#sub_total').val(total);       
                    $('#purchase_items').append(str);


                }

            })
        } else {
            $('#purchase_items tr').remove();
            $('#sub_total').val('');
//            $('#attention').val('');
//            $('#phone').val('');
//            $('#project_name').val('');
//            $('#project_id').val('');
            $('#inv_no').val('');
            $('#supplier_id').val('');
            $('#inv_code').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
//            $('#shipping_address').val('');
//            $('#shipping_email').val('');

        }
    });


    function calculateSubtotal(id) {
        var sub_total = 0;

        var rowCount = $('#myTable tr').length;
        var table_row = Number(rowCount) - 2;
        for (var i = 1; i <= table_row; i++) {
            if ($('.select_product_' + i).prop('checked')) {
                var amt = $('#amount_' + i).val();
                sub_total = sub_total + Number(amt);
            }

        }
        $('#sub_total').val(sub_total);
    }


</script>

