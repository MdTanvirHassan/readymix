<style type="text/css">
    table tr td,
    table tr th {
        text-align: center;
        vertical-align: middle;
        padding: 4px !important;

    }
</style>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Sales Commission Invoice</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" action="<?php echo site_url('sale_target/add_sale_commission_action'); ?>" method="post" onsubmit="javascript: return validation()">

                            <div class='form-group' style="margin-bottom:15px;">
                                <label for="title" class="col-sm-2 control-label">
                                    Select customer<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select class="form-control e1" placeholder="Select Customer" id="customer_id" name="customer_id" onchange="javascript:project_info();">
                                        <option value="">Select customer</option>
                                        <?php foreach ($customers as $customer) { ?>
                                            <option <?php if ($sale_commission[0]['customer_id'] == $customer['id']) echo 'selected'; ?> value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option>
                                        <?php } ?>


                                    </select>
                                    <input type="hidden" name="comm_id" value="<?php echo $sale_commission[0]['id']; ?>">
                                    <span id="do_id_error" style="color:red"></span>
                                </div>


                            </div>


                            <div class='form-group' style="margin-bottom:15px;">
                                <label for="title" class="col-sm-2 control-label">
                                    Select Project<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select class="form-control e1" placeholder="Select Project" id="project_id" name="project_id" onchange="javascript:sales_order_info();">
                                        <option value="">Select Project</option>
                                        <?php foreach ($projects as $customer) { ?>
                                            <option <?php if ($sale_commission[0]['project_id'] == $customer['project_id']) echo 'selected'; ?> value="<?php echo $customer['project_id'] ?>"><?php echo $customer['project_name'] ?></option>
                                        <?php } ?>

                                    </select>
                                    <span id="do_id_error" style="color:red"></span>
                                </div>


                            </div>




                            <div class='form-group'>
                                <label for="title" class="col-sm-2 control-label">
                                    Commission No<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input readonly class="form-control" id="commission_no" name="inv_no" type="text" value="<?php echo $sale_commission[0]['commission_no']; ?>">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input class="form-control datepicker" id="sale_invoice_date" name="sale_invoice_date" type="text" value="<?php echo date('d-m-Y',strtotime($sale_commission[0]['date'])) ?>">
                                    <span id="sale_invoice_date_error" style="color:red"></span>
                                </div>

                            </div>
                            <div class='form-group'>
                                <label for="title" class="col-sm-2 control-label">
                                    Beneficiary<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control" id="beneficiary" name="beneficiary" type="text" value="<?php echo $sale_commission[0]['beneficiary']; ?>">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Designation<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input class="form-control" id="designation" name="designation" type="text" value="<?php echo $sale_commission[0]['designation']; ?>">
                                    <span id="sale_invoice_date_error" style="color:red"></span>
                                </div>

                            </div>
                            <div class='form-group'>
                                <label for="title" class="col-sm-2 control-label">
                                    Employee<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select class="form-control e1" placeholder="Select Employee" id="employee_id" name="employee_id">
                                        <option value="">Select Employee</option>
                                        <?php foreach ($employees as $customer) { ?>
                                            <option <?php if ($sale_commission[0]['employee_id'] == $customer['id']) echo 'selected'; ?> value="<?php echo $customer['id'] ?>"><?php echo $customer['name'] ?></option>
                                        <?php } ?>


                                    </select>
                                </div>

                            </div>




                            <div class="row">




                            </div>

                            <div class="separator-shadow"></div>
                            <div class="row">
                                <input type="hidden" value="1" id="count" />
                                <table class="table table-bordered" id="myTable">
                                    <thead class="thead-color">
                                        <tr>
                                            <th>Invoice No.</th>
                                            <th>Invoice Qty</th>
                                            <th>Invoice Value</th>
                                            <th>Commission Rate</th>
                                            <th>Commission Value</th>
                                            <th>Remarks</th>
                                            <th><input type="checkbox" id="allselect"></th>

                                        </tr>
                                    </thead>
                                    <tbody id="sale_items">
                                    <?php
              $totalqty = 0;
              foreach ($sale_commission_details as $i=>$sale_invoice_details) {
                  $key = $i+1;
                $totalqty += $sale_invoice_details['comm_value'];
                $i++;
              ?>
                <tr>
                            <td>
                            <input type="hidden"  name="inv_id[]" id="inv_id_" class="issue" value="<?php  echo $sale_invoice_details['inv_id']; ?>">
                            <input readonly  style="width:140px;"  type="text"  id="inv_no" class="issue" value="<?php  echo $sale_invoice_details['inv_no']; ?>">
                           </td>
                            <td><input readonly style="width:140px;"  type="text"  name="total_qty[]" id="total_qty_<?php  echo $key; ?>" class="issue" value="<?php  echo $sale_invoice_details['inv_qty']; ?>"></td>
                            <td><input readonly  style="width:80px;"  type="text"  name="total_amount[]" id="total_amount_<?php  echo $key; ?>" class="issue" value="<?php  echo $sale_invoice_details['inv_value']; ?>"></td>
                            <td><input style="width:80px;text-align: right;"  type="text"  name="invoice_rate[]" onkeyup="changeRate(<?php  echo $key; ?>)" id="invoice_rate_<?php  echo $key; ?>" class="issue" value="<?php  echo $sale_invoice_details['comm_qty']; ?>"></td>
                            <td><input onkeyup="" onchange="" onblur=""  style="width:80px;text-align: right;"  type="text"  name="invoice_value[]" id="invoice_value_<?php  echo $key; ?>" class="issue" value="<?php  echo $sale_invoice_details['comm_value']; ?>"></td>
                            <td><input  style="width:100px;text-align: right;"  type="text" class="amount_"  name="remarks[]" id="remarks_<?php  echo $key; ?>" class="issue" value="<?php  echo $sale_invoice_details['remarks']; ?>"></td>
                            <td><input  onclick="calculateSubtotal(<?php  echo $key; ?>)" style="width:40px;"  type="checkbox"  name="select_product[]" checked id="select_product_<?php  echo $key; ?>" class="each_select select_product_<?php  echo $key; ?>" value="<?php  echo $key; ?>"></td>
                            </tr>
              <?php } ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" style="text-align:right;">Total:</td>
                                            <td><input readonly style="width:140px;text-align: right;" id="sub_total_qty" name="sub_total_amount" type="text" value="<?php  echo $sale_commission[0]['total_amount']; ?>"></td>

                                        </tr>

                                    </tfoot>
                                </table>




                            </div>



                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/sale_target/sales_commission') ?>"> <button type="button" class="btn btn-success button" style="padding:6px 4px">GO BACK</button> </a>
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
    $('#allselect').click(function() {
        if ($(this).is(':checked') == true) {
            $('.each_select').prop('checked', true);

            var sub_total = 0;
            var sub_total_qty = 0;
            var rowCount = $('#myTable tr').length;
            var table_row = Number(rowCount) - 2;
            for (var i = 1; i <= table_row; i++) {
                if ($('.select_product_' + i).prop('checked')) {
                    var amt = $('#invoice_value_' + i).val();
                    sub_total = sub_total + Number(amt);

                }

            }
            sub_total = sub_total.toFixed(2);
            $('#sub_total_qty').val(sub_total);


        } else {
            $('.each_select').prop('checked', false);
            var sub_total = 0;
            $('#sub_total_qty').val(sub_total);

        }
    })





    $('#project_id').change(function() {
        var project_id = $('#project_id').val();
        if (project_id != '') {
            $('#sale_items tr').remove();

            var d = new Date();
            var n = d.getFullYear();
            var final = n.toString().substring(2);

            var data = {
                'project_id': project_id
            }
            $.ajax({
                url: '<?php echo site_url('sale_target/paidInvoice'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function(msg) {

                    var str = '';
                    var total = 0;
                    if (msg.invoices != '') {
                        $(msg.invoices).each(function(i, v) {
                            var amount = '';
                            total = total + Number(v.amount);
                            amount = v.quantity * v.unit_price;
                            amount = amount.toFixed(2);

                            str += '<tr>';
                            str += '<td>';
                            str += '<input type="hidden"  name="inv_id[]" id="inv_id_" class="issue" value="' + v.inv_id + '">';
                            str += '<input readonly  style="width:140px;"  type="text"  id="inv_no" class="issue" value="' + v.inv_no + '">';
                            str += '</td>';
                            str += '<td><input readonly style="width:140px;"  type="text"  name="total_qty[]" id="total_qty_' + (Number(i) + 1) + '" class="issue" value="' + v.total_qty + '"></td>';
                            str += '<td><input readonly  style="width:80px;"  type="text"  name="total_amount[]" id="total_amount_' + (Number(i) + 1) + '" class="issue" value="' + v.total_amount + '"></td>';
                            str += '<td><input style="width:80px;text-align: right;"  type="text"  name="invoice_rate[]" onkeyup="changeRate(' + (Number(i) + 1) + ')" id="invoice_rate_' + (Number(i) + 1) + '" class="issue" value=""></td>';
                            str += '<td><input onkeyup="" onchange="" onblur=""  style="width:80px;text-align: right;"  type="text"  name="invoice_value[]" id="invoice_value_' + (Number(i) + 1) + '" class="issue" value=""></td>';
                            str += '<td><input  style="width:100px;text-align: right;"  type="text" class="amount_"  name="remarks[]" id="remarks_' + (Number(i) + 1) + '" class="issue" value=""></td>';
                            str += '<td><input  onclick="calculateSubtotal(' + (Number(i) + 1) + ')" style="width:40px;"  type="checkbox"  name="select_product[]" id="select_product_' + (Number(i) + 1) + '" class="each_select select_product_' + (Number(i) + 1) + '" value="' + i + '"></td>';
                            str += '</tr>';
                        });
                    } else {
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

    function changeRate(id) {
        var qty = Number($('#total_qty_' + id).val());
        var rate = Number($('#invoice_rate_' + id).val());
        $('#invoice_value_' + id).val(qty * rate);
        calculateSubtotal(id)
    }

    function calculateSubtotal(id) {
        var sub_total = 0;
        var sub_total_qty = 0;
        var rowCount = $('#myTable tr').length;
        var table_row = Number(rowCount) - 2;

        for (var i = 1; i <= table_row; i++) {
            if ($('.select_product_' + i).prop('checked')) {
                var amt = $('#invoice_value_' + i).val();
                sub_total = sub_total + Number(amt);

            }

        }
        sub_total = sub_total.toFixed(2);
        $('#sub_total_qty').val(sub_total);
    }


    function project_info() {

        var customer_id = $('#customer_id').val();
        if (customer_id != '') {
            $.ajax({
                type: "POST",
                url: "backend/sale_invoices/customer_project_info",
                data: "customer_id=" + customer_id,
                dataType: "json",
                success: function(data) {


                    var str = '';
                    str += '<option class="form-controll" value="">Select Project</option>';
                    $(data.project).each(function(row, val) {

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
        } else {

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

    function sales_order_info() {

        var project_id = $('#project_id').val();
        //    alert(project_id);
        if (project_id != '') {
            //    alert(project_id);
            $.ajax({
                type: "POST",
                url: "backend/sale_invoices/salesOrderInfoProjectWise",
                data: "project_id=" + project_id,
                dataType: "json",
                success: function(data) {
                    var str1 = '';
                    str1 += '<option class="form-controll" value="">Select Sales Order</option>';
                    $(data.so_order_info).each(function(row1, v) {
                        str1 += '<option class="form-controll" value="' + v.o_id + '">' + v.order_no + '</option>';
                    })
                    $('#o_id').html(str1);
                }
            })
        } else {

            var str1;
            str1 += '<option class="form-controll" value="">Select Sales Order</option>';
            $('#o_id').html(str1);
        }
    }

    function delivery_order_info() {

        var o_id = $('#o_id').val();
        $('#do_id').html(str1);
        if (o_id != '') {
            $.ajax({
                type: "POST",
                url: "backend/sale_invoices/deliveryOrderInfoSaleOrderWise",
                data: "o_id=" + o_id,
                dataType: "json",
                success: function(data) {
                    var str1 = '';
                    str1 += '<option class="form-controll" value="">Select Delivery Order</option>';
                    $(data.do_order_info).each(function(row1, v) {
                        str1 += '<option class="form-controll" value="' + v.do_id + '">' + v.delivery_no + '</option>';
                    })
                    $('#do_id').html(str1);
                }
            })
        } else {

            var str1;
            str1 += '<option class="form-controll" value="">Select Delivery Order</option>';
            $('#do_id').html(str1);
        }
    }
</script>