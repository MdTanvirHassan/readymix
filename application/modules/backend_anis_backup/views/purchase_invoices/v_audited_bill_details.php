<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(2, 8, $userData);
              
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Details Invoice</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        
                        
                        
                        
                        
                        <form class="form-horizontal" action="<?php echo site_url('purchase_invoices/edit_purchase_invoice_action/'.$purchase_invoice_info[0]['inv_id']); ?>" method="post" onsubmit="javascript: return validation()">
                                

                            
                            <div class="row" style="margin-top:5px;">  
                                <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                    Invoice No<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                   
                                    <b> <?php if(!empty($purchase_invoice_info[0]['inv_no'])) echo $purchase_invoice_info[0]['inv_no'];  ?></b>
                                </div>
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                    Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                   
                                    <b><?php if(!empty($purchase_invoice_info[0]['invoice_date'])) echo date('d-m-Y',strtotime($purchase_invoice_info[0]['invoice_date'])); ?></b>
                                   
                                </div>

                            </div>
                            </div>
                            <div class="row" style="margin-top:5px;">
                                <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                        Customer Bill No.<sup class="required">*</sup>  :
                                    </label> 
                                    <div class="col-sm-4 input-group">

                                        <b><?php if(!empty($purchase_invoice_info[0]['supplier_bill_no'])) echo $purchase_invoice_info[0]['supplier_bill_no'];  ?></b>

                                    </div>

                                    <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                        Remark<sup class="required"></sup>  :
                                    </label> 
                                    <div class="col-sm-4 input-group">

                                        <b><?php if(!empty($purchase_invoice_info[0]['remark'])) echo $purchase_invoice_info[0]['remark'];  ?></b>

                                    </div>

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
                                            <th>P. Order No.</th>
                                            <th>Mrr. No.</th>
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
                                        <?php if(!empty($invoice_details_info)){ ?>
                                            <?php 
                                            $total=0;
                                            foreach($invoice_details_info as $invoice_detail){ 
                                                $total=$total+$invoice_detail['amount'];
                                                ?>
                                                <tr>
                                                    
                                                    <td>   
                                                       <?php echo $invoice_detail['order_no']; ?>
                                                    </td>
                                                    
                                                    <td>   
                                                       <?php echo $invoice_detail['mrr_no']; ?>
                                                    </td>
                                                    
                                                    <td>   
                                                       <?php echo $invoice_detail['mrr_challan']; ?>
                                                    </td>
                                                    <td>
                                                        
                                                        <?php echo $invoice_detail['item_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $invoice_detail['meas_unit']; ?>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <b><?php echo number_format($invoice_detail['quantity'],2); ?></b>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <b><?php echo number_format($invoice_detail['unit_price'],2); ?></b>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <b><?php echo number_format($invoice_detail['amount'],2); ?></b>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7" style="text-align:right;">Subtotal:</td>
                                            <td style="text-align: right;"><b><?php echo number_format($total,2); ?></b></td>
                                        </tr>
                                       
                                        
                                        <tr>
                                            <td colspan="7" style="text-align:right;">Discount:</td>
                                            <td style="text-align: right;"><b><?php if(!empty($purchase_invoice_info[0]['discount'])) echo number_format($purchase_invoice_info[0]['discount'],2);  ?></b></td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="7" style="text-align:right;">Vat:</td>
                                            <td style="text-align: right;"><b><?php if(!empty($purchase_invoice_info[0]['vat'])) echo number_format($purchase_invoice_info[0]['vat'],2);  ?></b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" style="text-align:right;">Tax:</td>
                                            <td style="text-align: right;"><b><?php if(!empty($purchase_invoice_info[0]['tax'])) echo number_format($purchase_invoice_info[0]['tax'],2);  ?></b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" style="text-align:right;">Ait:</td>
                                            <td style="text-align: right;"><b><?php if(!empty($purchase_invoice_info[0]['ait'])) echo number_format($purchase_invoice_info[0]['ait'],2);  ?></b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" style="text-align:right;">Net Payable Amount:</td>
                                            <td style="text-align: right;"><b><?php if(!empty($purchase_invoice_info[0]['net_payable_amount'])) echo number_format($purchase_invoice_info[0]['net_payable_amount'],2);  ?></b></td>
                                        </tr>
                                    </tfoot>
                                </table>




                            </div>



                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/purchase_invoices/auditedBill') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px">GO BACK</button> </a>
                                </div>
                                <div class="col-md-2 ">
                                 <!--   <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">UPDATE</button>-->
                                </div>

                            </div> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 


</form>
</div>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-header">
          <button id="close1" type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="h__status">Remark</h4>
        </div>
        <div class="modal-body">
            
            
            <br />
            
            <div class="row"> 
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">
                        Remark <sup class="required"></sup>:
                    </label> 
                    <div class="col-sm-4 input-group">
                        <input style="width:300px;"  class="form-control"  id="inv_id" name="inv_id" type="hidden">
                        <input style="width:300px;"  class="form-control" placeholder="Remark" id="remark" name="remark" type="text">
                    </div>   
                </div>
            </div>
            
            
            
            
        </div>
        <div class="modal-footer">
            <button onclick="addRemarkAction()" class="btn btn-sm btn-primary">Submit</button>
            <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>



<script type="text/javascript">



    function addRemark(id){
       
       $('#inv_id').val(id);
       $('#myModal').modal('show');
   }

   function addRemarkAction(){
       
       var remark=$('#remark').val();
       var inv_id=$('#inv_id').val();
       
       $.ajax({
            url:'<?php echo site_url('purchase_invoices/addRemark') ?>',
            data:{'inv_id':inv_id,'remark':remark},
            method:'POST',
            dataType:'JSON',
            success:function(msg){
               
                
                  if(msg.status=='success'){   
                        $('#remark').val('');
                        $('#myModal').modal('hide'); 
                        location.reload();
                  }else{ 
                      $('#remark').val('');
                      $('#myModal').modal('hide'); 
                       
                  }
                

                

            }    
       });
   }



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
            $('#supplier_bill_no_error').html('Please fill reference no field');
            $('#supplier_bill_no').css('border', '1px solid red');
            error = true;
        } else {
            $('#supplier_bill_no_error').html('');
            $('#supplier_bill_no').css('border', '1px solid #ccc');

        }
        
        if (billing_address == '') {
            $('#billing_address_error').html('Please fill billing address  field');
            $('#billing_address').css('border', '1px solid red');
            error = true;
        } else {
            $('#billing_address_error').html('');
            $('#billing_address').css('border', '1px solid #ccc');

        }

        if (billing_email == '') {
            $('#billing_email_error').html('Please fill billing email field');
            $('#billing_email').css('border', '1px solid red');
            error = true;
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
                        str += '<td><input type="hidden"  name="mrr_id[]" id="dc_id_" class="issue" value="' + v.mrr_id + '"><input readonly  style="width:140px;"  type="text"  name="dc_no[]" id="dc_no" class="issue" value="' + v.mrr_challan + '"></td>';
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

