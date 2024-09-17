
<?php
$employee_id = $this->session->userdata('employeeId');
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(2, 8, $userData);
?>
<style>
    table { table-layout: fixed; margin-top: 20px}
    table th, table td { overflow: hidden; }
    .table > thead > tr > th {
        padding: 3px;

    }
    .table > tbody > tr > td{
        padding: 7px;

    }
    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 5px;

    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
        <?php require_once(__DIR__ . '/../production_header.php'); ?>
    </div>

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Details Schedule</h3>
            </div>
        </div>
        <!--            <div class="row">
                         <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                    </div>-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal" method="post" action="<?php echo site_url('productions/edit_production_schedule_action/' . $schedule_info[0]['id']) ?>">



                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                    Schedule Number:
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <?php if (!empty($schedule_info[0]['schedule_no'])) echo $schedule_info[0]['schedule_no']; ?>
                                </div>
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                    Date <sup class="required">*</sup>
                                </label>
                                <div class="col-sm-4 input-group">
                                    <?php if (!empty($schedule_info[0]['date'])) echo date('d-m-Y', strtotime($schedule_info[0]['date'])); ?>
                                </div>  

                            </div>


                            <input type="hidden" id="count" value="1"/>
                            <table class="table table-bordered" id="myTable" style="margin-top:20px;">
                                <thead class="thead-color">
                                    <tr>
                                        <th style="vertical-align: middle;width: 7%;text-align: center;">Do. Date</th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Do. No.</th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Customer</th>
                                        <th style="vertical-align: middle;width: 15%;text-align: center;"> Project</th>
                                        <th style="vertical-align: middle;width: 15%;text-align: center;">Item name & Description</th>
                                        <th style="vertical-align: middle;width: 5%;text-align: center;">MU</th>
                                        <th style="vertical-align: middle;width: 5%;text-align: center;">Do. Qty</th>
                                        <th style="vertical-align: middle;width: 5%;text-align: center;">Schedule Qty</th>
                                        <th style="vertical-align: middle;width: 5%;text-align: center;">Qty (CUM)</th>
                                        <th style="vertical-align: middle;width: 5%;text-align: center;">Mixing Status</th>
                                        <th style="vertical-align: middle;width: 5%;text-align: center;">Extra Qty</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;
                                    foreach ($sd_details as $sd_detail) {
                                        $i++; ?>

                                        <tr id="row_1">      
                                            <td><?php echo $sd_detail['delivery_order_date']; ?></td>
                                            <td><?php echo $sd_detail['delivery_no']; ?></td>
                                            <td><?php echo $sd_detail['c_name']; ?></td>
                                            <td><?php echo $sd_detail['project_name']; ?></td>
                                            <td><?php echo $sd_detail['product_name']; ?></td>
                                            <td><?php echo $sd_detail['measurement_unit']; ?></td>
                                            <td><?php echo $sd_detail['do_qty']; ?></td>

                                            <td><?php echo $sd_detail['schedule_qty']; ?></td>
                                            <td><?php
                                                if ($sd_detail['measurement_unit'] == 'CFT') {
                                                    echo round($sd_detail['schedule_qty'] / 35.31, 2);
                                                } else {
                                                    echo round($sd_detail['schedule_qty'] / 2.41, 2);
                                                }
                                                ?></td>
                                            <td><b><?php echo $sd_detail['mixing_status']; ?></b></td>
                                            <td style="padding:7px 0px;"><button type="button" class="btn btn-sm btn-primary" onclick="addExtra(<?php echo $sd_detail['id']; ?>,<?php echo $sd_detail['extra_qty']; ?>)">Extra Qty</button></td>

                                        </tr>
<?php } ?>  
                                </tbody>
                            </table>



                            <div class="row" style="margin-bottom: 20px">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/productions/') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                                </div>




                            </div>

                            <div class="row">


                            </div>

                        </form>
                        <div class="modal fade" id="extraModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Extra Payment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Previous Extra Qty</label>
                                            <input type="text" readonly class="form-control" id="prev_extra">
                                            <label>New Extra Qty</label>
                                            <input type="text" class="form-control" id="extra_amt">
                                            <input type="hidden" class="form-control" id="extra_id">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary pull-right" onclick="confirmExtra()">Confirm Extra Quantity</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function addExtra(id, qty) {
        if(!qty){
            qty = '0.00';
        }
        $('#extra_id').val(id);
        $('#prev_extra').val(qty);
        $('#extraModal').modal('show');
    }
    
        function confirmExtra() {
        if (!$('#extra_amt').val()) {
            alert('Please enter extra amount.');
            return false;
        } else {
            $.ajax({
                url: '<?php echo site_url('productions/addExtra'); ?>',
                data: {'id':$('#extra_id').val(),'qty':$('#extra_amt').val()},
                method: 'POST',
                dataType: 'text',
                success: function (msg) {
                    $('#extra_amt').val('');
                    location.reload();
                }

            })
        }
    }
    
    function addRequired(id) {

        if ($('#item_select_' + id).prop('checked')) {
            // alert(id);
            $('#payment_mode_' + id).prop('readonly', false);
            $('#payment_mode_' + id).prop('required', true);
            $('#budget_qty_' + id).prop('readonly', false);
            $('#budget_qty_' + id).prop('required', true);
            $('#unit_price_' + id).prop('readonly', false);
            $('#unit_price_' + id).prop('required', true);

        } else {
            // alert(id);
            $('#payment_mode_' + id).prop('readonly', true);
            $('#payment_mode_' + id).prop('required', false);
            $('#budget_qty_' + id).prop('readonly', true);
            $('#budget_qty_' + id).prop('required', false);
            $('#unit_price_' + id).prop('readonly', true);
            $('#unit_price_' + id).prop('required', false);
        }


    }



    function calculateEstvalueConsume(id) {
        var unit_price = Number($('#unit_price_' + id).val());
        var budget_quantity = Number($('#budget_qty_' + id).val());
        var indent_quantity = Number($('#indent_qty_' + id).val());
        if (budget_quantity > indent_quantity) {
            $('#budget_qty_' + id).val('');
        }
        var est_value = unit_price * budget_quantity;
        $('#budget_value_' + id).val(est_value);
        $('#budget_value_c1_' + id).val(est_value);



    }


    function budget_no() {
        var budget_type = $('#b_type').val();
        if (budget_type == "cash") {
            var budget_type_sn = "CA";
        } else if (budget_type == "credit") {
            var budget_type_sn = "CR";
        } else {
            var budget_type_sn = "LC";
        }
        //   alert(group_id);
        var data = {'budget_type': budget_type}
        $.ajax({
            url: '<?php echo site_url('general_store/budget_no'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
                if (msg.budget_no != "") {
                    var item_id = Number(msg.budget_no[0].budget_code) + 1;
                } else {
                    item_id = "";
                }

                var item_sl_no;
                if (item_id != '') {
                    if (item_id > 999) {
                        item_sl_no = item_id;
                    } else if (item_id > 99) {
                        item_sl_no = budget_type_sn + "0" + item_id;
                    } else if (item_id > 9) {
                        item_sl_no = budget_type_sn + "00" + item_id;
                    } else {
                        item_sl_no = budget_type_sn + "000" + item_id;
                    }
                } else {
                    item_id = 1;
                    item_sl_no = budget_type_sn + '0001';
                }

                $('#budget_code').val(item_id);
                $('#b_no').val(item_sl_no);
                $('#b_no1').val(item_sl_no);
            }

        })
    }





    function item_info(id) {
//   alert('test');
        var item_type = $('#ipo_item_type').val();
//        if(id==1 && item_type=="Consumable" ){
//            var itemId = $('#item_c_'+id).val();
//        }else if(id==1 && item_type=="Asset" ){
//            var itemId = $('#item_a_'+id).val();
//        }else{
//            var itemId = $('#item_'+id).val();
//        }

        if (item_type == "Consumable") {
            var itemId = $('#item_c_' + id).val();
        } else {
            var itemId = $('#item_a_' + id).val();
        }

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
                var item_type = $('#ipo_item_type').val();


                if (item_type == "Consumable") {
                    $('#item_des_c_' + id).val(msg.item_info[0].item_name);
                    $('#item_des_c1_' + id).val(msg.item_info[0].item_name);
                    $('#unit_c_' + id).val(msg.item_info[0].meas_unit);
                    $('#unit_c1_' + id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_c_' + id).val(msg.item_info[0].stock_amount);
                    $('#stock_qty_c1_' + id).val(msg.item_info[0].stock_amount);

                    if (msg.item_previous_info != '') {
                        $('#last_unit_price_c_' + id).val(msg.item_previous_info[0].unit_price);
                        $('#last_unit_price_c1_' + id).val(msg.item_previous_info[0].unit_price);
                        var supplier = msg.item_previous_info[0].NAME + "(" + msg.item_previous_info[0].CODE + ")";
                    } else {
                        $('#last_unit_price_c_' + id).val('');
                        $('#last_unit_price_c1_' + id).val('');
                        var supplier = '';
                    }

                    $('#last_supllier_c_' + id).val(supplier);
                    $('#last_supllier_c1_' + id).val(supplier);
                } else {
                    $('#item_des_a_' + id).val(msg.item_info[0].item_name);
                    $('#item_des_a1_' + id).val(msg.item_info[0].item_name);
                    $('#unit_a_' + id).val(msg.item_info[0].meas_unit);
                    $('#unit_a1_' + id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_a_' + id).val(msg.item_info[0].stock_amount);
                    $('#stock_qty_a1_' + id).val(msg.item_info[0].stock_amount);

                    if (msg.item_previous_info != '') {
                        $('#last_unit_price_a_' + id).val(msg.item_previous_info[0].unit_price);
                        $('#last_unit_price_a1_' + id).val(msg.item_previous_info[0].unit_price);
                        var supplier = msg.item_previous_info[0].NAME + "(" + msg.item_previous_info[0].CODE + ")";
                    } else {
                        $('#last_unit_price_a_' + id).val('');
                        $('#last_unit_price_a1_' + id).val('');
                        var supplier = '';
                    }

                    $('#last_supllier_a_' + id).val(supplier);
                    $('#last_supllier_a1_' + id).val(supplier);


                }

            }
        })

    }




    $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr = $('#item_c_1').html();
        var assetstr = $('#asset_c_1').html();

        var str = '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str += '<td><button id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        str += '<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_' + (Number(count) + 1) + '" class="form-control">' + itemstr + '</select></td><td><input type="hidden"  name="item_name_description[]" id="item_des_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description[]" id="item_des_c1_' + (Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit[]" id="unit_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit[]" id="unit_c1_' + (Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price[]" id="last_unit_price_c1_' + (Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supplier[]" id="last_supllier_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supplier[]" id="last_supllier_c1_' + (Number(count) + 1) + '" class="issue"></td>  <td><input type="hidden"  name="stock_qty[]" id="stock_qty_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty[]" id="stock_qty_c1_' + (Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_' + (Number(count) + 1) + '" onkeyup="calculateEstvalueConsume(' + (Number(count) + 1) + ')" class="issue"></td><td><input type="hidden"  name="unit_price[]" id="unit_price_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price[]" id="unit_price_c1_' + (Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_c_' + (Number(count) + 1) + '" class="form-control">' + assetstr + '</select></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
        $('.datepicker').datepicker({
            format: 'DD-MM-YYYY'
        });
//        $('.time').datetimepicker();
//        $('.datepicker').datetimepicker({
//            format: 'DD-MM-YYYY'
//        });                                     
//        $('.monthpicker').datetimepicker({
//            format: 'YYYY-MM'
//        });
        //  $('select.e1').select2();
        $('.chzn-container').remove();
    });

    $('#button3').click(function () {
        var count = $('#count').val();
        var itemstr = $('#item_a_1').html();
        var assetstr = $('#asset_1').html();

        var str = '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str += '<td><button id="button4" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        str += '<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_' + (Number(count) + 1) + '" class="form-control">' + itemstr + '</select></td><td><input type="hidden"  name="item_name_description_a[]" id="item_des_a_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description_a[]" id="item_des_a1_' + (Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit_a[]" id="unit_a_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_a[]" id="unit_a1_' + (Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price_a[]" id="last_unit_price_a1_' + (Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supllier_a[]" id="last_supllier_a1_' + (Number(count) + 1) + '" class="issue"></td>   <td><input type="hidden"  name="stock_qty_a[]" id="stock_qty_a_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty_a[]" id="stock_qty_a1_' + (Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_' + (Number(count) + 1) + '" onkeyup="calculateEstvalueAsset(' + (Number(count) + 1) + ')" class="issue"></td><td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price_a[]" id="unit_price_a1_' + (Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
        $('#count').val(Number(count) + 1);
        $('#myTable1').append(str);
        $('.datepicker').datepicker({
            format: 'DD-MM-YYYY'
        });
//        $('.time').datetimepicker();
//        $('.datepicker').datetimepicker({
//            format: 'DD-MM-YYYY'
//        });                                     
//        $('.monthpicker').datetimepicker({
//            format: 'YYYY-MM'
//        });
        //  $('select.e1').select2();
        $('.chzn-container').remove();
    });

    function removeRow(row) {
        $('#row_' + row).remove();
    }

    $(document).ready(function () {

        //    $('select.e1').select2();
    });

</script>