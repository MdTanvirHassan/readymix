<style>
    table tr td, table tr th{
        text-align: center;
        vertical-align: middle;
		}
</style>


<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<div class="os-tabs-w menu-shad">
        <?php require_once(__DIR__ .'/../production_header.php'); ?>
    </div>
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Delivery Challan</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" action="<?php echo site_url('delivery_challans/add_delivery_challan_action'); ?>" method="post" onsubmit="javascript: return validation()">

                            
                            
                            <div class='form-group' style="margin-bottom: 30px;">
                                <label for="title" class="col-sm-2 control-label">
                                   Customer<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select  id="c_id" class="form-control e1" name="c_id">
                                                <option class="form-control" value="">Select Customer</option>
                                                <?php foreach ($customers as $cust) {
                                                    if(empty($cust['c_id']))
                                                        continue;
                                                    ?>
                                                    <option class="form-control" value="<?php echo $cust['c_id']; ?>"><?php echo $cust['c_name'] . '(' . $cust['c_short_name'] . ')'; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span id="do_id_error" style="color:red"></span>
                                </div>
                                

                            </div>
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Challan No.<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control" id="customer_id" name="customer_id" type="hidden" value="">
                                            <input class="form-control" id="challan_code" name="challan_code" type="hidden" value="">
                                            <input  readonly class="form-control" id="dc_no" name="dc_no" type="text" value="">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control datepicker" id="delivery_challan_date" name="delivery_challan_date" type="text" value="<?php echo date('d-m-Y') ?>">
                                            <span id="delivery_challan_date_error" style="color:red"></span>
                                </div>

                            </div>
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Project Name<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   
                                            <input   class="form-control" id="project_id" name="project_id" type="hidden">
                                            <input  readonly class="form-control" id="project_name" name="project_name" type="text">
                                            <span id="project_name_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Attention<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                     <input  class="form-control" id="attention" name="attention" type="text" placeholder="Attention Person Name">
                                            <span id="attention_error" style="color:red"></span>
                                </div>

                            </div>
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Phone<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="phone" name="phone" type="text" placeholder="Phone Number">
                                            <span id="phone_error" style="color:red"></span>
                                </div>
                                  <label for="title" class="col-sm-2 control-label">
                                  Contact Person :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input  class="form-control" id="contact_person" name="contact_person" type="text" placeholder="Contact Person">
                                 <span id="contact_person" style="color:red"></span>
                                </div>

                            </div>
                            
                            <div class='form-group' >
                               <label for="title" class="col-sm-2 control-label">
                                    Contact No<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                    <input  class="form-control" id="contact_no" name="contact_no" type="text" placeholder="Contact No">
                                <span id="contact_no" style="color:red"></span>
                        
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
                                    D. Email<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <input  class="form-control" id="shipping_email" name="shipping_email" type="text" placeholder="Delivery Email">
                                            <span id="shipping_email_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Truck<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  id="truck_id" class="form-control e1" name="truck_id">
                                                <option class="form-control" value="">Select</option>
                                                <?php foreach ($trucks as $truck) { ?>
                                                    <option class="form-control" value="<?php echo $truck['truck_id'] ?>"><?php echo $truck['truck_no']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span id="truck_id_error" style="color:red"></span>
                                </div>

                            </div>
                            
                             <div class='form-group' >
                               
                                <label for="title" class="col-sm-2 control-label">
                                    Driver<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  id="driver_id" class="form-control e1" name="driver_id">
                                                <option class="form-control" value="">Select</option>
                                                <?php foreach ($drivers as $driver) { ?>
                                                    <option class="form-control" value="<?php echo $driver['driver_id'] ?>"><?php echo $driver['driver_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span id="driver_id_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Helper<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  id="driver_id" class="form-control e1" name="helper_id">
                                                <option class="form-control" value="">Select</option>
                                                <?php foreach ($helpers as $driver) { ?>
                                                    <option class="form-control" value="<?php echo $driver['helper_id'] ?>"><?php echo $driver['helper_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span id="driver_id_error" style="color:red"></span>
                                </div>
                                 

                            </div>
                             <div class='form-group' >
                               
                               
                                 
                                <label for="title" class="col-sm-2 control-label">
                                    Challan Time<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control " id="challan_time" name="challan_time" type="text" placeholder="Challan Time">
                                    <span id="challan_time_error" style="color:red"></span>
                                </div>
                                  <label for="title" class="col-sm-2 control-label">
                                    Slump :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="distance" name="distance" type="text" placeholder="Slump">
                                    <span id="challan_time_error" style="color:red"></span>
                                </div>

                            </div>
                            


                            

                           <div class="separator-shadow"></div>

                            <div class="row">
                                <input type="hidden" value="1" id="count" />
                                <table class="table table-bordered" id="myTable" >
                                    <thead class="thead-color">
                                        <tr >
                                            <th>Do No <sup style='color:red'>*</sup></th>  
                                            <th>Product Name <sup style='color:red'>*</sup></th>  
                                            <th>Quantity (<span id="mu">CFT</span>)</th>              
                                            <th>Quantity(<span id="othermu">CUM</span>)</th>              
                                            <th>Measurement Unit</th>
                                            <th>Remark</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody id="challan_items">


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td  style="text-align:right;"></td>
                                            <td  style="text-align:right;"></td>
                                            <td><input type="hidden" style="width:140px;text-align:right;" id="sub_total"  name="total_amount" type="text"></td>
                                        </tr>
                                    </tfoot>
                                </table>




                            </div>
                         <div class="separator-shadow"></div>
                         <div class="row">
                                <h2 style="text-align:center; ">Status of Order</h2>
                                <table class="table table-bordered" id="orderTable" >
                                    <thead class="thead-color">
                                        <tr >
                                            <th>DO NO </th>
                                            <th>Product Name </th>
                                            <th>Ordered Qnty</th>
                                            <th>Delivered Qnty</th>              
                                            <th>Due Qnty</th>


                                        </tr>
                                    </thead>
                                    <tbody id="order_items">


                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>




                            </div>
                         
                         
                          <div class="separator-shadow"></div>
                         <div class="row">
                                <h2 style="text-align:center; ">Status of Production</h2>
                                <table class="table table-bordered" id="productionTable" >
                                    <thead class="thead-color">
                                        <tr >
                                            <th rowspan="2" style="vertical-align: middle;text-align: center;">DO NO </th>
                                            <th rowspan="2" style="vertical-align: middle;text-align: center;">Product Name </th>
                                            <th colspan="2">Production Qnty</th>
                                            <th colspan="2">Delivered Qnty</th>                   
                                            <th colspan="2">Stock Qnty</th>
                                        </tr>
                                        <tr >
                                            
                                            <th>CFT</th>
                                            <th>CUM</th>
                                            <th>CFT</th>              
                                            <th>CUM</th>              
                                            <th>CFT</th>
                                            <th>CUM</th>


                                        </tr>
                                    </thead>
                                    <tbody id="production_items">


                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>




                            </div>

                         

                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/delivery_challans') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>

                                </div>
                                <div class="col-md-2 ">
                                    <button type="submit" id="submit_btn" class="btn btn-primary button" onclick="javascript:validation();">SAVE</button>
                                </div>

                            </div> 


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function validation() {
        var delivery_challan_date = $('#delivery_challan_date').val();
        var do_id = $('#do_id').val();

        var project_name = $('#project_name').val();
        var attention = $('#attention').val();
        var phone = $('#phone').val();
        var billing_address = $('#billing_address').val();
        var billing_email = $('#billing_email').val();
        var shipping_address = $('#shipping_address').val();
        var shipping_email = $('#shipping_email').val();
        
         var driver_id = $('#driver_id').val();
         var truck_id = $('#truck_id').val();

        var error = false;
        
         

        if (delivery_challan_date == '') {
            $('#delivery_challan_date').css('border', '1px solid red');
            $('#delivery_challan_date_error').html('Please fill date field');
            error = true;

        } else {
            $('#delivery_challan_date').css('border', '1px solid #ccc');
            $('#delivery_challan_date_error').html('');

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
            $('#attention_error').html('Please fill  attention field');
            $('#attention').css('border', '1px solid red');
            error = true;
        } else {
            $('#attention_error').html('');
            $('#attention').css('border', '1px solid #ccc');

        }

        if (phone == '') {
            $('#phone_error').html('Please fill phone number field');
            $('#phone').css('border', '1px solid red');
            error = true;
        } else {
            $('#phone_error').html('');
            $('#phone').css('border', '1px solid #ccc');

        }

        if (billing_address == '') {
//            $('#billing_address_error').html('Please fill billing address field');
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

        if (shipping_address == '') {
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


        if (driver_id=='') {
            $('#driver_id').css('border', '1px solid red');
            $('#driver_id_error').html('Please select driver');
            error = true;

        } else {
            $('#driver_id').css('border', '1px solid #ccc');
            $('#driver_id_error').html('');

        }
        
         if (truck_id == '') {
            $('#truck_id').css('border', '1px solid red');
            $('#truck_id_error').html('Please select truck');
            error = true;

        } else {
            $('#truck_id').css('border', '1px solid #ccc');
            $('#truck_id_error').html('');

        }

       
        if (error == true) {
            return false;
        }
         $('#submit_btn').hide()
    }




    $('#do_id').change(function () {
        var do_id = $('#do_id').val();
        if (do_id != '') {

            $('#challan_items tr').remove();
            $('#order_items tr').remove();
            $('#production_items tr').remove();

            $('#sub_total').val('');
            $('#challan_code').val('');
            $('#dc_no').val('');
            $('#customer_id').val('');
            $('#attention').val('');
            $('#phone').val('');
            $('#project_id').val('');
            $('#project_name').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            
            $('#contact_person').val('');
            $('#contact_no').val('');

            var d = new Date();
            var n = d.getFullYear();
            var final = n.toString().substring(2);


            var data = {'do_id': do_id}
            $.ajax({
                url: '<?php echo site_url('delivery_challans/get_delivery_order_item'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {
                    var branch=msg.branch_info[0].short_name;
                    
                    if (msg.order_code != "") {
                        var item_id = Number(msg.order_code[0].challan_code)+1;
                    } else {
                        item_id = "";
                    }

                    var item_sl_no;
                    if (item_id != '') {
                        if (item_id > 999) {
                           // item_sl_no = item_id;
                            item_sl_no =branch+'/CH/'+ msg.delivery_info[0].c_short_name + '/' + final + '/'+ item_id;
                        } else if (item_id > 99) {
                            item_sl_no =branch+'/CH/'+ msg.delivery_info[0].c_short_name + '/' + final + '/' + "0" + item_id;
                        } else if (item_id > 9) {
                            item_sl_no =branch+'/CH/'+ msg.delivery_info[0].c_short_name + '/' + final + '/' + "00" + item_id;
                        } else {
                            item_sl_no =branch+'/CH/'+ msg.delivery_info[0].c_short_name + '/' + final + '/' + "000" + item_id;
                        }
                    } else {
                        item_id = 1;
                        item_sl_no = branch+'/CH/' + msg.delivery_info[0].c_short_name + '/' + final + '/' + '0001';
                    }

                    $('#challan_code').val(item_id);
                    $('#dc_no').val(item_sl_no);
                    $('#customer_id').val(msg.delivery_info[0].id);

                    $('#attention').val(msg.delivery_info[0].attention);
                    $('#phone').val(msg.delivery_info[0].phone);
                    $('#project_id').val(msg.delivery_info[0].project_id);
                    $('#project_name').val(msg.delivery_info[0].project_name);
                    $('#billing_address').val(msg.delivery_info[0].billing_address);
                    $('#billing_email').val(msg.delivery_info[0].billing_email);
                    $('#shipping_address').val(msg.delivery_info[0].shipping_address);
                    $('#shipping_email').val(msg.delivery_info[0].shipping_email);
                    
                    $('#contact_person').val(msg.delivery_info[0].contact_person);
                    $('#contact_no').val(msg.delivery_info[0].contact_no);

                    var str = '';
                    var total = 0;
                    var net_qty;
                    var amount;
                    $(msg.item_list).each(function (i, v) {
                        if (v.delivery_quantity != '') {
                            net_qty = Number(v.quantity) - Number(v.delivery_quantity);
                        } else {
                            net_qty = Number(v.quantity);
                        }
                        amount = Number(v.unit_price) * Number(net_qty);
                        total = total + Number(v.amount);
                        str += '<tr>';
                        str += '<td><input type="hidden"  name="s_item_id[]" id="item_des_c1_" class="issue" value="' + v.s_item_id + '"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="' + v.product_name + '"></td>';
                        str += '<td>';
                        str +='<input type="hidden"  style="width:140px;"  type="text"  name="unit_price[]" id="unit_price_' +(Number(i) + 1)+ '" class="unit_price_' + (Number(i) + 1) + '" value="' + v.unit_price + '">';
                        str +='<input type="hidden"   style="width:140px;text-align:right;"  type="text" name="amount[]" id="amount_' + v.s_item_id + '" class="amount_' + (Number(i) + 1) + '"  value="' + amount + '">';
                       // str +='<input  readonly  onkeyup="calculateSubtotal(' + v.s_item_id + ')" onchange="calculateSubtotal(' + v.s_item_id + ')" onblur="calculateSubtotal(' + v.s_item_id + ')"  style="width:140px;text-align:right;"  type="text"  name="quantity[]" id="quantity_' + v.s_item_id + '" class="issue number" value="' + net_qty + '">';
                        str +='<input  readonly  onkeyup="calculateSubtotal(' +(Number(i) + 1)+ ',false)" style="width:140px;text-align:right;"  type="text"  name="quantity[]" id="quantity_'+(Number(i)+1)+ '" class="issue number" value="' +''+ '">';
                        str +='</td><td><input  readonly  onkeyup="calculateSubtotal(' +(Number(i) + 1)+ ',true)" style="width:140px;text-align:right;"  type="text"  name="quantity_cum[]" id="quantity_cum_'+(Number(i)+1)+ '" class="issue number" value="' +''+ '">';
                        str +='</td>';
                        str += '<td><input readonly   style="width:140px;text-align:left;"  type="text" name="mu_name[]" id="mu_' + (Number(i) + 1) + '" class="amount_' + (Number(i) + 1) + '"  value="' + v.mu_name + '"></td>';
                        str += '<td>'+v.remark+'</td>';
                      //  str += '<td><input onclick="calculateSubtotal(' + v.s_item_id + ')" style="width:40px;text-align:right;"  type="checkbox" name="select_product[]"    id="select_product_' + v.s_item_id + '" class="select_product_' + (Number(i) + 1) + '" value="' + v.s_item_id + '"></td>';
                        str += '<td><input onclick="calculateSubtotal('+(Number(i) + 1)+',false)" style="width:40px;text-align:right;"  type="checkbox" name="select_product[]"    id="select_product_' +(Number(i) + 1)+ '" class="select_product_' + (Number(i) + 1) + '" value="' + v.s_item_id + '"></td>';
                        str += '</tr>';
                    });

                    //  $('#sub_total').val(total);       
                    $('#challan_items').append(str);

                    var str1 = '';
                    var due_qty;
                    
                    var stock_qty='';
                    var str2='';

                    $(msg.order_products).each(function (j, w) {
                        if (w.delivery_quantity != null) {
                            due_qty = Number(w.quantity) - Number(w.delivery_quantity);
                            stock_qty = Number(w.production_qty) - Number(w.delivery_quantity);
                        } else {
                            due_qty = Number(w.quantity);
                            stock_qty = Number(w.production_qty) - Number(w.delivery_quantity);
                        }
                        //alert(w.delivery_quantity);
                        str1 += '<tr>';
                        str1 += '<td><input readonly style="width:120px;"  type="text"  name="product_name[]" id="product_name_" class="issue" value="' + w.product_name + '"></td>';
                        //str1 += '<td><input readonly  style="width:140px;text-align:right;"  type="text"  name="order_quantity[]" id="order_quantity_' + (Number(j) + 1) + '" class="issue" value="' + w.quantity + '"></td>';
                        str1 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="order_quantity[]" id="order_quantity_' + (Number(j) + 1) + '" class="issue" value="' +w.quantity+ '"></td>';
                        if (w.delivery_quantity == null) {
                            str1 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="delivery_quantity[]" id="delivery_quantity_' + (Number(j) + 1) + '" class="issue" value="' + '' + '"></td>';
                        } else {
                            str1 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="delivery_quantity[]" id="delivery_quantity_' + (Number(j) + 1) + '" class="issue" value="' + w.delivery_quantity + '"></td>';

                        }
                        str1 += '<td><input readonly  style="width:120px;text-align:right;"  type="text" class="amount_"  name="due_quantity[]" id="due_quantity_' + (Number(j) + 1) + '" class="issue" value="' + due_qty.toFixed(2) + '"></td>';
                        str1 += '</tr>';
                        
                        
                        str2 += '<tr>';
                        str2 += '<td><input readonly style="width:120px;"  type="text"  name="product_name[]" id="product_name_" class="issue" value="' + w.product_name + '"></td>';
                        if (w.production_qty == null) {
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' +''+ '"></td>';
                        }else{
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' + w.production_qty + '"></td>';
                        }
                        
                                           if(w.mu_name=='CFT'){
                             
             if (w.production_qty == null) {
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' +''+ '"></td>';
                        }else{
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' + (w.production_qty/35.31).toFixed(2) + '"></td>';
                        }
        }else if(w.mu_name=='MT'){
                if (w.production_qty == null) {
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' +''+ '"></td>';
                        }else{
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' + (w.production_qty/2.41).toFixed(2) + '"></td>';
                        }
        }else{
                if (w.production_qty == null) {
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' +''+ '"></td>';
                        }else{
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' + (w.production_qty) + '"></td>';
                        }
        }
                        
                        
                        if(w.delivery_quantity == null) {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_'+(Number(j)+ 1)+'" class="issue" value="' + '' + '"></td>';
                        } else {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_' +(Number(j)+1)+'" class="issue" value="' + w.delivery_quantity + '"></td>';

                        }
                                         if(w.mu_name=='CFT'){
             if(w.delivery_quantity == null) {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_'+(Number(j)+ 1)+'" class="issue" value="' + '' + '"></td>';
                        } else {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_' +(Number(j)+1)+'" class="issue" value="' + (w.delivery_quantity/35.31).toFixed(2) + '"></td>';

                        }
        }else if(w.mu_name=='MT'){
             if(w.delivery_quantity == null) {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_'+(Number(j)+ 1)+'" class="issue" value="' + '' + '"></td>';
                        } else {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_' +(Number(j)+1)+'" class="issue" value="' + (w.delivery_quantity/2.41).toFixed(2) + '"></td>';

                        }
        }else{
             if(w.delivery_quantity == null) {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_'+(Number(j)+ 1)+'" class="issue" value="' + '' + '"></td>';
                        } else {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_' +(Number(j)+1)+'" class="issue" value="' + (w.delivery_quantity) + '"></td>';

                        }
        }
                        str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text" class="stock_quantity_'+(Number(j)+1)+'"  name="stock_quantity[]" id="stock_quantity_' +(Number(j)+1)+'" class="issue" value="'+stock_qty.toFixed(2)+'"></td>';
                         if(w.mu_name=='CFT'){
                             str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text" class="stock_quantity_cum_'+(Number(j)+1)+'"  name="stock_quantity_cum[]" id="stock_quantity_cum_' +(Number(j)+1)+'" class="issue" value="'+(stock_qty/35.31).toFixed(2)+'"></td>';
            
        }else if(w.mu_name=='MT'){
            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text" class="stock_quantity_cum_'+(Number(j)+1)+'"  name="stock_quantity_cum[]" id="stock_quantity_cum_' +(Number(j)+1)+'" class="issue" value="'+(stock_qty/2.41).toFixed(2)+'"></td>';
        }else{
            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text" class="stock_quantity_cum_'+(Number(j)+1)+'"  name="stock_quantity_cum[]" id="stock_quantity_cum_' +(Number(j)+1)+'" class="issue" value="'+(stock_qty)+'"></td>';
        }

                        str2 += '</tr>';
                       $('#mu').html(w.mu_name)
                       if(w.mu_name=='CFT')
                       $('#othermu').html('CUM') 
                   else if (w.mu_name=='MT')
                       $('#othermu').html('CUM')
                   else if (w.mu_name=='SQ.M')
                       $('#othermu').html('MT')
                   else
                       $('#othermu').html('CUM')
                    });
                    
                    $('#order_items').append(str1);
                    $('#production_items').append(str2);


                }

            })
        } else {
            $('#challan_items tr').remove();
            $('#order_items tr').remove();
            $('#production_items tr').remove();
            
            $('#sub_total').val('');
            $('#challan_code').val('');
            $('#dc_no').val('');
            $('#customer_id').val('');
            $('#attention').val('');
            $('#phone').val('');
            $('#project_name').val('');
            $('#project_id').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            
            $('#contact_person').val('');
            $('#contact_no').val('');
        }
    });
    $('#c_id').change(function () {
        var c_id = $('#c_id').val();
        if (c_id != '') {

            $('#challan_items tr').remove();
            $('#order_items tr').remove();
            $('#production_items tr').remove();

            $('#sub_total').val('');
            $('#challan_code').val('');
            $('#dc_no').val('');
            $('#customer_id').val('');
            $('#attention').val('');
            $('#phone').val('');
            $('#project_id').val('');
            $('#project_name').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            
            $('#contact_person').val('');
            $('#contact_no').val('');

            var d = new Date();
            var n = d.getFullYear();
            var final = n.toString().substring(2);


            var data = {'c_id': c_id}
            $.ajax({
                url: '<?php echo site_url('delivery_challans/get_delivery_order_item'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {

                    if (msg.order_code != "") {
                        var item_id = Number(msg.order_code[0].challan_code)+1;
                    } else {
                        item_id = "";
                    }

                    var item_sl_no;
                    if (item_id != '') {
                        if (item_id > 999) {
                            item_sl_no = item_id;
                        } else if (item_id > 99) {
                            item_sl_no = 'CH/' + msg.delivery_info[0].c_short_name + '/' + final + '/' + "0" + item_id;
                        } else if (item_id > 9) {
                            item_sl_no = 'CH/' + msg.delivery_info[0].c_short_name + '/' + final + '/' + "00" + item_id;
                        } else {
                            item_sl_no = 'CH/' + msg.delivery_info[0].c_short_name + '/' + final + '/' + "000" + item_id;
                        }
                    } else {
                        item_id = 1;
                        item_sl_no = 'CH/' + msg.delivery_info[0].c_short_name + '/' + final + '/' + '0001';
                    }

                    $('#challan_code').val(item_id);
                    $('#dc_no').val(item_sl_no);
                    $('#customer_id').val(msg.delivery_info[0].id);

                    $('#attention').val(msg.delivery_info[0].attention);
                    $('#phone').val(msg.delivery_info[0].phone);
                    $('#project_id').val(msg.delivery_info[0].project_id);
                    $('#project_name').val(msg.delivery_info[0].project_name);
                    $('#billing_address').val(msg.delivery_info[0].billing_address);
                    $('#billing_email').val(msg.delivery_info[0].billing_email);
                    $('#shipping_address').val(msg.delivery_info[0].shipping_address);
                    $('#shipping_email').val(msg.delivery_info[0].shipping_email);
                    
                    $('#contact_person').val(msg.delivery_info[0].contact_person);
                    $('#contact_no').val(msg.delivery_info[0].contact_no);

                    var str = '';
                    var total = 0;
                    var net_qty;
                    var amount;
                    $(msg.item_list).each(function (i, v) {
                        if (v.delivery_quantity != '') {
                            net_qty = Number(v.quantity) - Number(v.delivery_quantity);
                        } else {
                            net_qty = Number(v.quantity);
                        }
                        amount = Number(v.unit_price) * Number(net_qty);
                        total = total + Number(v.amount);
                        str += '<tr>';
                        str += '<td><input type="hidden"  name="do_id[]" id="do_id_'+(Number(i) + 1)+'" class="issue" value="' + v.do_id + '"><input readonly style="width:140px;"  type="text"  name="do[]" id="do_'+(Number(i) + 1)+'" class="issue" value="' + v.delivery_no + '"></td>';
                        
                        str += '<td><input type="hidden"  name="s_item_id[]" id="item_des_c1_" class="issue" value="' + v.s_item_id + '"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="' + v.product_name + '"></td>';
                        str += '<td>';
                        str +='<input type="hidden"  style="width:140px;"  type="text"  name="unit_price[]" id="unit_price_' +(Number(i) + 1)+ '" class="unit_price_' + (Number(i) + 1) + '" value="' + v.unit_price + '">';
                        str +='<input type="hidden"   style="width:140px;text-align:right;"  type="text" name="amount[]" id="amount_' + v.s_item_id + '" class="amount_' + (Number(i) + 1) + '"  value="' + amount + '">';
                       // str +='<input  readonly  onkeyup="calculateSubtotal(' + v.s_item_id + ')" onchange="calculateSubtotal(' + v.s_item_id + ')" onblur="calculateSubtotal(' + v.s_item_id + ')"  style="width:140px;text-align:right;"  type="text"  name="quantity[]" id="quantity_' + v.s_item_id + '" class="issue number" value="' + net_qty + '">';
                        str +='<input  readonly  onkeyup="calculateSubtotal(' +(Number(i) + 1)+ ',false)" style="width:140px;text-align:right;"  type="text"  name="quantity[]" id="quantity_'+(Number(i)+1)+ '" class="issue number" value="' +''+ '">';
                        str +='</td><td><input  readonly  onkeyup="calculateSubtotal(' +(Number(i) + 1)+ ',true)" style="width:140px;text-align:right;"  type="text"  name="quantity_cum[]" id="quantity_cum_'+(Number(i)+1)+ '" class="issue number" value="' +''+ '">';
                        str +='</td>';
                        str += '<td><input readonly   style="width:140px;text-align:left;"  type="text" name="mu_name[]" id="mu_' + (Number(i) + 1) + '" class="amount_' + (Number(i) + 1) + '"  value="' + v.mu_name + '"></td>';
                        str += '<td>'+v.remark+'</td>';
                      //  str += '<td><input onclick="calculateSubtotal(' + v.s_item_id + ')" style="width:40px;text-align:right;"  type="checkbox" name="select_product[]"    id="select_product_' + v.s_item_id + '" class="select_product_' + (Number(i) + 1) + '" value="' + v.s_item_id + '"></td>';
                        str += '<td><input onclick="calculateSubtotal('+(Number(i) + 1)+',false)" style="width:40px;text-align:right;"  type="checkbox" name="select_product[]"    id="select_product_' +(Number(i) + 1)+ '" class="select_product_' + (Number(i) + 1) + '" value="' + v.s_item_id + '"></td>';
                        str += '</tr>';
                    });

                    //  $('#sub_total').val(total);       
                    $('#challan_items').append(str);

                    var str1 = '';
                    var due_qty;
                    
                    var stock_qty='';
                    var str2='';

                    $(msg.order_products).each(function (j, w) {
                        if (w.delivery_quantity != null) {
                            due_qty = Number(w.quantity) - Number(w.delivery_quantity);
                            stock_qty = Number(w.production_qty) - Number(w.delivery_quantity);
                        } else {
                            due_qty = Number(w.quantity);
                            stock_qty = Number(w.production_qty) - Number(w.delivery_quantity);
                        }
                        //alert(w.delivery_quantity);
                        str1 += '<tr>';
                        str1 += '<td><input readonly style="width:120px;"  type="text" class="issue" value="' + w.delivery_no + '"></td>';
                        str1 += '<td><input readonly style="width:120px;"  type="text"  name="product_name[]" id="product_name_" class="issue" value="' + w.product_name + '"></td>';
                        //str1 += '<td><input readonly  style="width:140px;text-align:right;"  type="text"  name="order_quantity[]" id="order_quantity_' + (Number(j) + 1) + '" class="issue" value="' + w.quantity + '"></td>';
                        str1 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="order_quantity[]" id="order_quantity_' + (Number(j) + 1) + '" class="issue" value="' +w.quantity+ '"></td>';
                        if (w.delivery_quantity == null) {
                            str1 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="delivery_quantity[]" id="delivery_quantity_' + (Number(j) + 1) + '" class="issue" value="' + '' + '"></td>';
                        } else {
                            str1 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="delivery_quantity[]" id="delivery_quantity_' + (Number(j) + 1) + '" class="issue" value="' + w.delivery_quantity + '"></td>';

                        }
                        str1 += '<td><input readonly  style="width:120px;text-align:right;"  type="text" class="amount_"  name="due_quantity[]" id="due_quantity_' + (Number(j) + 1) + '" class="issue" value="' + due_qty.toFixed(2) + '"></td>';
                        str1 += '</tr>';
                        
                        
                        str2 += '<tr>';
                        str2 += '<td><input readonly style="width:120px;"  type="text"  class="issue" value="' + w.delivery_no + '"></td>';
                        str2 += '<td><input readonly style="width:120px;"  type="text"  name="product_name[]" id="product_name_" class="issue" value="' + w.product_name + '"></td>';
                        if (w.production_qty == null) {
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' +''+ '"></td>';
                        }else{
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' + w.production_qty + '"></td>';
                        }
                        
                                           if(w.mu_name=='CFT'){
                             
             if (w.production_qty == null) {
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' +''+ '"></td>';
                        }else{
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' + (w.production_qty/35.31).toFixed(2) + '"></td>';
                        }
        }else if(w.mu_name=='MT'){
                if (w.production_qty == null) {
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' +''+ '"></td>';
                        }else{
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' + (w.production_qty/2.41).toFixed(2) + '"></td>';
                        }
        }else{
                if (w.production_qty == null) {
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' +''+ '"></td>';
                        }else{
                            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' + (w.production_qty) + '"></td>';
                        }
        }
                        
                        
                        if(w.delivery_quantity == null) {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_'+(Number(j)+ 1)+'" class="issue" value="' + '' + '"></td>';
                        } else {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_' +(Number(j)+1)+'" class="issue" value="' + w.delivery_quantity + '"></td>';

                        }
                                         if(w.mu_name=='CFT'){
             if(w.delivery_quantity == null) {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_'+(Number(j)+ 1)+'" class="issue" value="' + '' + '"></td>';
                        } else {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_' +(Number(j)+1)+'" class="issue" value="' + (w.delivery_quantity/35.31).toFixed(2) + '"></td>';

                        }
        }else if(w.mu_name=='MT'){
             if(w.delivery_quantity == null) {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_'+(Number(j)+ 1)+'" class="issue" value="' + '' + '"></td>';
                        } else {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_' +(Number(j)+1)+'" class="issue" value="' + (w.delivery_quantity/2.41).toFixed(2) + '"></td>';

                        }
        }else{
             if(w.delivery_quantity == null) {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_'+(Number(j)+ 1)+'" class="issue" value="' + '' + '"></td>';
                        } else {
                            str2 += '<td><input readonly   style="width:120px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_' +(Number(j)+1)+'" class="issue" value="' + (w.delivery_quantity) + '"></td>';

                        }
        }
                        str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text" class="stock_quantity_'+(Number(j)+1)+'"  name="stock_quantity[]" id="stock_quantity_' +(Number(j)+1)+'" class="issue" value="'+stock_qty.toFixed(2)+'"></td>';
                         if(w.mu_name=='CFT'){
                             str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text" class="stock_quantity_cum_'+(Number(j)+1)+'"  name="stock_quantity_cum[]" id="stock_quantity_cum_' +(Number(j)+1)+'" class="issue" value="'+(stock_qty/35.31).toFixed(2)+'"></td>';
            
        }else if(w.mu_name=='MT'){
            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text" class="stock_quantity_cum_'+(Number(j)+1)+'"  name="stock_quantity_cum[]" id="stock_quantity_cum_' +(Number(j)+1)+'" class="issue" value="'+(stock_qty/2.41).toFixed(2)+'"></td>';
        }else{
            str2 += '<td><input readonly  style="width:120px;text-align:right;"  type="text" class="stock_quantity_cum_'+(Number(j)+1)+'"  name="stock_quantity_cum[]" id="stock_quantity_cum_' +(Number(j)+1)+'" class="issue" value="'+(stock_qty)+'"></td>';
        }

                        str2 += '</tr>';
                        
                       $('#mu').html(w.mu_name) 
                    });
                    
                    $('#order_items').append(str1);
                    $('#production_items').append(str2);


                }

            })
        } else {
            $('#challan_items tr').remove();
            $('#order_items tr').remove();
            $('#production_items tr').remove();
            
            $('#sub_total').val('');
            $('#challan_code').val('');
            $('#dc_no').val('');
            $('#customer_id').val('');
            $('#attention').val('');
            $('#phone').val('');
            $('#project_name').val('');
            $('#project_id').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            
            $('#contact_person').val('');
            $('#contact_no').val('');
        }
    });



    function calculateSubtotal(id,chk){

        $('.number').on('input', function (event) {
            var val=$(this).val();
            if(isNaN(val)) {
                val =val.replace(/[^0-9\.]/g, '');
                if(val.split('.').length>2)
                    val =val.replace(/\.+$/, "");
            }
            $(this).val(val);
        });

        var due_quantity = Number($('#due_quantity_'+id).val());
        var sub_total = 0;
        var unit_price = $('#unit_price_' + id).val();
        var quantity = Number($('#quantity_' + id).val());
        var amount = Number(unit_price) * Number(quantity);
      //  alert(quantity)
        var stock_quantity = Number($('#stock_quantity_' + id).val());
        var stock_quantity_cum = Number($('#stock_quantity_cum_' + id).val());

        if ($('#select_product_' + id).prop('checked')) {
            $('#quantity_' + id).prop('readonly', false);
            $('#quantity_cum_' + id).prop('readonly', false);
            $('#quantity_' + id).prop('required', true);
        } else {
            $('#quantity_' + id).prop('readonly', true);
            $('#quantity_cum_' + id).prop('readonly', true);
            $('#quantity_' + id).prop('required', false);
        }
        
        var sd_qty=quantity;
        var mu=$('#mu_'+id).val();
        var r = 1;
        //$('#quantity_cum_'+id).val((sd_qty/35.31).toFixed(2));
        if(mu=='CFT')
            r = 35.31
        else if (mu=='MT')
            r = 2.41;
        else
            r = 1;
       // alert()
            if(chk){
                if(stock_quantity_cum<$('#quantity_cum_'+id).val()){
                    $('#quantity_cum_'+id).val('0');
                    return false;
                }
            $('#quantity_'+id).val((Number($('#quantity_cum_'+id).val())*r).toFixed(2));
            }else{
                if(sd_qty/r!=0)
            $('#quantity_cum_'+id).val((sd_qty/r).toFixed(2));
        }
var quantity = Number($('#quantity_' + id).val());
        var rowCount = $('#myTable tr').length;
        var table_row = Number(rowCount) - 2;
var stk = Number($('#stock_quantity_'+id).val());
var tollarance = 0.50;
if(quantity!=stk){
if((quantity-stk)>=tollarance){
    $('#quantity_'+id).val(stk.toFixed(2));
}else if((stk-quantity)<=tollarance){
 $('#quantity_'+id).val(stk.toFixed(2));   
}
}
var quantity = Number($('#quantity_' + id).val());
        if (quantity != '' || quantity != 0){
            if (quantity <= due_quantity){
                  if (quantity <= stock_quantity) {
                        $('#amount_' + id).val(amount);

                        for (var i = 1; i <= table_row; i++) {

                            if ($('.select_product_' + i).prop('checked')) {

                                var amt = $('.amount_' + i).val();
                                sub_total = sub_total + Number(amt)
                            }

                        }
                   }else{
          
                        for(var i = 1;i<= table_row;i++){
                            if ($('.select_product_'+i).prop('checked')) {
                                var amt = $('.amount_' + i).val();
                                sub_total = sub_total + Number(amt);
                            }

                        }
                   }    

            } else {
       
                for (var i = 1; i <= table_row; i++) {
                    if ($('.select_product_' + i).prop('checked')) {
                        var amt = $('.amount_' + i).val();
                        sub_total = sub_total + Number(amt);
                    }

                }
            }
        } else {
//            $('#amount_' + id).val('');
//            $('#quantity_' + id).val('');
            for (var i = 1; i <= table_row; i++) {
                if ($('.select_product_' + i).prop('checked')) {
                    var amt = $('.amount_' + i).val();
                    sub_total = sub_total + Number(amt);
                }

            }
        }

        $('#sub_total').val(sub_total);



    }






</script>

