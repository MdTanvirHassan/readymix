<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <!--    <h2 style="text-align:center; ">Invoice</h2>
        <a target="_blank" style="float:right;margin-top:-30px;" href="<?php echo site_url('sale_invoices/details_sale_invoice/' . $sale_invoice_info[0]['inv_id'] . '/true'); ?>" class="btn btn-sm btn-info">PRINT</a>
        <hr>-->
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3 style="float:left;">Details Invoice</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('sale_invoices/details_pump_bill/'.$sale_invoice_info[0]['inv_id'] . '/true'); ?>" class="btn btn-sm btn-warning">PRINT</a>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <div class="row">     
                            <table class="table table-bordered" id="myTable">

                                <tr>
                                    <th  style="width:12%;">Delivery Order:</th>
                                    <td>
                                        <?php foreach ($orders as $order) { ?>
                                            <?php if ($order['do_id'] == $sale_invoice_info[0]['do_id']) echo $order['c_short_name'] . '(' . $order['project_name'] . ')' . '(' . $order['delivery_no'] . ')' ?>
                                        <?php } ?>
                                    </td>
                                    <th  style="width:12%;">Sales Order:</th>
                                    <td>
                                        <?php if (!empty($sale_invoice_info[0]['order_no'])) echo $sale_invoice_info[0]['order_no']; ?>
                                    </td>
                                    <th  style="width:12%;">C. Name:</th>
                                    <td>
                                        <?php if (!empty($sale_invoice_info[0]['c_name'])) echo $sale_invoice_info[0]['c_name']; ?>
                                    </td>


                                </tr>
                                <tr>
                                    <th >Invoice No.:</th>
                                    <td>
                                        <?php if (!empty($sale_invoice_info[0]['inv_no'])) echo $sale_invoice_info[0]['inv_no']; ?>
                                    </td>
                                    <th >Date</th>
                                    <td>
                                        <?php if (!empty($sale_invoice_info[0]['sale_invoice_date'])) echo date('d-m-Y', strtotime($sale_invoice_info[0]['sale_invoice_date'])); ?>
                                    </td>
                                    <th >Project Name:</th>
                                    <td>
                                        <?php if (!empty($sale_invoice_info[0]['project_name'])) echo $sale_invoice_info[0]['project_name']; ?>
                                    </td>

                                </tr>
                                <tr>

                                    <th>Attention:</th>
                                    <td>
                                        <?php if (!empty($sale_invoice_info[0]['attention'])) echo $sale_invoice_info[0]['attention']; ?>
                                    </td>
                                    <th>Phone:</th>
                                    <td>
                                        <?php if (!empty($sale_invoice_info[0]['phone'])) echo $sale_invoice_info[0]['phone']; ?>
                                    </td>
                                    <!--
                                    <th>Contact Person:</th>
                                    <td>
                                        <?php if (!empty($sale_invoice_info[0]['contact_person'])) echo $sale_invoice_info[0]['contact_person']; ?>

                                    </td>
                                    -->
                                </tr>




                                <tr>
                                <!--    
                                    <th>Contact No:</th>
                                    <td>
                                        <?php if (!empty($sale_invoice_info[0]['contact_no'])) echo $sale_invoice_info[0]['contact_no']; ?>               
                                    </td>
                                -->

                                    <th>B. Address:</th>
                                    <td>
                                        <?php if (!empty($sale_invoice_info[0]['billing_address'])) echo $sale_invoice_info[0]['billing_address']; ?>
                                    </td>

                                    <th>B. Email:</th>
                                    <td>
                                        <?php if (!empty($sale_invoice_info[0]['billing_email'])) echo $sale_invoice_info[0]['billing_email']; ?>
                                    </td>

                                </tr>
                           <!--     
                                <tr>


                                    <th>D. Address:</th>
                                    <td>
                                        <?php if (!empty($sale_invoice_info[0]['shipping_address'])) echo $sale_invoice_info[0]['shipping_address']; ?>

                                    </td>
                                    <th>Delivery Date</th>
                                    <td>
                                        <?php if (!empty($sale_invoice_info[0]['delivery_date'])) echo date('d-m-Y', strtotime($sale_invoice_info[0]['delivery_date'])); ?>
                                    </td>
                                    <th>D. Time:</th>
                                    <td>
                                        <?php if (!empty($sale_invoice_info[0]['delivery_time'])) echo $sale_invoice_info[0]['delivery_time']; ?>
                                    </td>




                                </tr>
                           -->


                            </table>

                        </div>










                        <div class="separator-shadow"></div>
                        <div class="row">

                            <table class="table table-bordered" >
                                <thead class="thead-color">
                                    <tr>
                                        <th>Service Name <sup style='color:red'>*</sup></th>
                                        <th>M. Unit</th>
                                        <th>Quantity</th>              
                                        <th>Unit Price</th>
                                        <th>Amount</th>
                                        <th>Remark</th>

                                    </tr>
                                </thead>
                                <tbody id="sale_items">
                                     <?php $i=0; foreach($sale_invoice_details_info as $sale_order_details){ 
                                                    $i++;
                                                    ?>
                                                    <tr class="" id="row_<?php echo $i; ?>">
                                                       <td><?php echo $sale_order_details['service_name'] ?></td>
                                                       <td><?php echo $sale_order_details['mu_name'] ?></td>
                                                       <td style="text-align:right;"><?php echo $sale_order_details['quantity'] ?></td>
                                                       <td style="text-align:right;"><?php echo $sale_order_details['unit_price'] ?></td>    
                                                       <td style="text-align:right;"><?php echo $sale_order_details['amount'] ?></td>
                                                       <td><?php echo $sale_order_details['remark'] ?></td>

                                                    </tr>
                                               <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" style="text-align:right;"><b>Sub Total</b></td>
                                        
                                        <td style="text-align:right;"><b><?php if (!empty($sale_invoice_info[0]['total_amount'])) echo number_format($sale_invoice_info[0]['total_amount'],2); ?></b></td>
                                    </tr>
                                   
                                    <tr>
                                        <td colspan="4" style="text-align:right;"><b>Paid</b></td>

                                        <td style="text-align:right;"><b><?php if (!empty($sale_invoice_info[0]['received_amount'])) echo number_format($sale_invoice_info[0]['received_amount'],2); ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align:right;"><b>Due</b></td>

                                        <td style="text-align:right;"><b><?php echo number_format(($sale_invoice_info[0]['total_amount'] - $sale_invoice_info[0]['received_amount']),2); ?></b></td>
                                    </tr>
                                </tfoot>
                            </table>




                        </div>



                        <div class="row">

                            <div class="col-md-2">
                                <a href="<?php echo site_url('backend/sale_invoices') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                            </div>

                            <div class="col-md-2">
                                <a target="_blank"  href="<?php echo site_url('sale_invoices/details_sale_invoice/' . $sale_invoice_info[0]['inv_id'] . '/true'); ?>" <button type="button" class="btn btn-primary button">PRINT</button> </a>

                            </div> 

                            <!--            <div class="col-md-2 ">
                                           <a target="_blank"  href="<?php echo site_url('sale_invoices/details_sale_invoice/' . $sale_invoice_info[0]['inv_id'] . '/true'); ?>" > <button type="button" class="btn btn-primary button">PRINT</button> </a>
                                        </div>-->
                        </div> 


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">




    $('#do_id').change(function () {
        var do_id = $('#do_id').val();
        if (do_id != '') {
            $('#sale_items tr').remove();
            $('#sub_total').val('');
            $('#attention').val('');
            $('#phone').val('');
            $('#project_name').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');

            var data = {'do_id': do_id}
            $.ajax({
                url: '<?php echo site_url('sale_invoices/get_order_item'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {

                    $('#attention').val(msg.order_info[0].attention);
                    $('#billing_address').val(msg.order_info[0].billing_address);
                    $('#billing_email').val(msg.order_info[0].billing_email);
                    $('#shipping_address').val(msg.order_info[0].shipping_address);
                    $('#shipping_email').val(msg.order_info[0].shipping_email);

                    var str = '';
                    var total = 0;
                    $(msg.item_list).each(function (i, v) {

                        total = total + Number(v.amount);
                        str += '<tr>';
                        str += '<td><input type="hidden"  name="dc_id[]" id="dc_id_" class="issue" value="' + v.dc_id + '"><input readonly  style="width:140px;"  type="text"  name="dc_no[]" id="dc_no" class="issue" value="' + v.dc_no + '"></td>';
                        str += '<td><input type="hidden"  name="s_item_id[]" id="item_des_c1_" class="issue" value="' + v.s_item_id + '"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="' + v.product_name + '"></td>';
                        str += '<td><input readonly  style="width:140px;"  type="text"  name="measurement_unit[]" id="dc_no" class="issue" value="' + v.measurement_unit + '"></td>';
                        str += '<td><input readonly onkeyup="" onchange="" onblur=""  style="width:140px;"  type="text"  name="quantity[]" id="quantity_' + (Number(i) + 1) + '" class="issue" value="' + v.quantity + '"></td>';
                        str += '<td><input readonly  style="width:140px;"  type="text"  name="unit_price[]" id="unit_price_' + (Number(i) + 1) + '" class="issue" value="' + v.unit_price + '"></td>';
                        str += '<td><input readonly  style="width:140px;"  type="text" class="amount_"  name="amount[]" id="amount_' + (Number(i) + 1) + '" class="issue" value="' + v.amount + '"></td>';
                        str += '<td><input  onclick="calculateSubtotal(' + (Number(i) + 1) + ')" style="width:40px;"  type="checkbox"  name="select_product[]" id="select_product_' + (Number(i) + 1) + '" class="select_product_' + (Number(i) + 1) + '" value="' + i + '"></td>';
                        str += '</tr>';
                    });

                    //$('#sub_total').val(total);       
                    $('#sale_items').append(str);


                }

            })
        } else {
            $('#sale_items tr').remove();
            $('#sub_total').val('');
            $('#attention').val('');
            $('#phone').val('');
            $('#project_name').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');

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


