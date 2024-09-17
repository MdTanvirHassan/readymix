<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <!--    <h2 style="text-align:center; ">Invoice</h2>
        <a target="_blank" style="float:right;margin-top:-30px;" href="<?php echo site_url('sale_target/details_sale_commission/' . $sale_invoice_info[0]['id'] . '/true'); ?>" class="btn btn-sm btn-info">PRINT</a>
        <hr>-->
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3 style="float:left;">Sales Commission Invoice</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('sale_target/details_sale_commission/' . $sale_commission[0]['id'] . '/true'); ?>" class="btn btn-sm btn-warning">PRINT</a>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <div class="row">     
                            <table class="table table-bordered" id="myTable">

                                <tr>
                                    <th  style="width:12%;">Invoice Number:</th>
                                    <td>
                                        <?php echo $sale_commission[0]['commission_no']; ?>
                                    </td>
                                    <th  style="width:12%;">Date:</th>
                                    <td>
                                        <?php if (!empty($sale_commission[0]['date'])) echo $sale_commission[0]['date']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th  style="width:12%;">Client Name:</th>
                                    <td>
                                        <?php echo $sale_commission[0]['c_name']; ?>
                                    </td>
                                    <th  style="width:12%;">Beneficiary:</th>
                                    <td>
                                        <?php if (!empty($sale_commission[0]['beneficiary'])) echo $sale_commission[0]['beneficiary']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th  style="width:12%;">Project Name:</th>
                                    <td>
                                        <?php echo $sale_commission[0]['project']; ?>
                                    </td>
                                    <th  style="width:12%;">Designation:</th>
                                    <td>
                                        <?php if (!empty($sale_commission[0]['designation'])) echo $sale_commission[0]['designation']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th  style="width:12%;">KMIX R.M.:</th>
                                    <td>
                                        <?php echo $sale_commission[0]['name']; ?>
                                    </td>
                                    
                                </tr>
                                

                            </table>

                        </div>










                        <div class="separator-shadow"></div>
                        <div class="row">

                            <table class="table table-bordered" >
                                <thead class="thead-color">
                                    <tr>
                                        <th style="text-align:center;vertical-align: middle;">S/N</th>
                                        <th style="text-align:center;vertical-align: middle;">Invoice NO</th>
                                        <th style="text-align:center;vertical-align: middle;">Invoice Qty</th>
                                        <th style="text-align:center;vertical-align: middle;">Invoice Value</th>
                                   
                                        <th style="text-align:right;vertical-align: middle;">Commission Rate</th>  
                                        <th style="text-align:right;vertical-align: middle;">Commission Value</th>
                                        <th style="text-align:right;vertical-align: middle;">Remarks</th> 


                                    </tr>
                                </thead>
                                <tbody id="sale_items">
                                    <?php
                                    $i = 0;
                                    $totalqty = 0;
                                    foreach ($sale_commission_details as $sale_invoice_details) {
                                         $totalqty+=$sale_invoice_details['comm_value'];
                                        $i++;
                                        ?>
                                        <tr class="" id="row_<?php echo $i; ?>">
                                            <td style="text-align:center;vertical-align: middle;"><?php echo  ($i+1); ?></td>
                                            <td style="text-align:center;vertical-align: middle;"><?php echo $sale_invoice_details['inv_no'] ?></td>
                                            <td style="text-align:center;vertical-align: middle;"><?php echo $sale_invoice_details['inv_qty'] ?></td>
                                            <td style="text-align:right;"><?php echo $sale_invoice_details['inv_value'] ?></td>
                                            <td style="text-align:right;"><?php echo $sale_invoice_details['comm_qty'] ?></td>
                                            <td style="text-align:right;"><?php echo $sale_invoice_details['comm_value'] ?></td>
                                            <td style="text-align:right;"><?php echo $sale_invoice_details['remarks'] ?></td>


                                        </tr>
                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" style="text-align:right;"><b>Total</b></td>
                                        <td style="text-align:right"><?php echo $totalqty; ?> <br> </td>
                                    </tr>
                                   
                                </tfoot>
                            </table>




                        </div>



                        <div class="row">

                            
                            
                            <div class="col-md-2">
                                <a href="<?php echo site_url('backend/sale_target/sales_commission') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                            </div>

                            <div class="col-md-2">
                                <a target="_blank"  href="<?php echo site_url('sale_target/details_sale_commission/' . $sale_commission[0]['id'] . '/true'); ?>" <button type="button" class="btn btn-primary button">PRINT</button> </a>

                            </div> 
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


