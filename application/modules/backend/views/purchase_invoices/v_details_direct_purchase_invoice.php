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
                <h3>Details Direct/Opening Invoice</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" action="<?php echo site_url('purchase_invoices/edit_direct_purchase_invoice_action/'.$purchase_invoice_info[0]['inv_id']); ?>" method="post" onsubmit="javascript: return validation()">

                             
                            
                                                 
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                   Customer Bill No.<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select disabled id="bill_id" class="form-control e1" name="bill_id">
                                        <option class="form-control" value="">Select Bill</option>
                                     
                                        <?php foreach ($bills as $bill) { ?>
                                            <option <?php if($bill['id']==$purchase_invoice_info[0]['bill_id']) echo "selected"; ?> class="form-control" value="<?php echo $bill['id'] ?>"><?php echo $bill['SUP_NAME'] . '(' . $bill['supplier_bill_no'] . ')' . '(' . number_format($bill['amount'],2) . ')' ?></option>
                                        <?php } ?>
                                    </select>
                                    <span id="bill_id_error" style="color:red"></span>
                                </div>

                                 
                                 
                               

                            </div>
                            
                            
                          <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Invoice No<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   
                                  
                                    <input  readonly class="form-control" id="inv_no" name="inv_no" type="text" value="<?php if(!empty($purchase_invoice_info[0]['inv_no'])) echo $purchase_invoice_info[0]['inv_no'];  ?>">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control datepicker" id="purchase_invoice_date" name="invoice_date" type="text" value="<?php if(!empty($purchase_invoice_info[0]['invoice_date'])) echo date('d-m-Y',strtotime($purchase_invoice_info[0]['invoice_date'])); ?>">
                                    <span id="purchase_invoice_date_error" style="color:red"></span>
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
                                             <th>Material Name <sup style='color:red'>*</sup></th>
                                             <th>M. Unit</th>
                                             <th>Quantity</th>              
                                             <th>Unit Price</th>
                                             <th>Amount</th>
                                             <th>Remark</th>
                                             <th><a href="javascript:" class="btn btn-sm btn-primary" onclick="addRow()">+</a></th>
                                          </tr>
                                        </thead>
                                        <tbody id="sale_items">
                                             <?php if(!empty($invoice_details_info)){ ?>
                                                <?php 
                                                $total=0;
                                                $i=0;
                                                foreach($invoice_details_info as $invoice_detail){ 
                                                    $total=$total+$invoice_detail['amount'];
                                                    $i++;
                                                    ?>
                                                    <tr>

                                                       

                                                       
                                                        <td>
                                                           
                                                            <?php echo $invoice_detail['item_name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $invoice_detail['meas_unit']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $invoice_detail['quantity']; ?>
                                                        </td>
                                                        <td>
                                                          <?php echo $invoice_detail['unit_price']; ?>
                                                        </td>
                                                        <td style="text-align:right;">
                                                            <?php echo number_format($invoice_detail['amount'],2); ?>
                                                        </td>
                                                        <td>
                                                           <?php echo $invoice_detail['remark']; ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>

                                        </tbody>
                                           <tfoot>
                                               
                                                <tr>
                                                    <td colspan="4" style="text-align:right;">Subtotal:</td>
                                                    
                                                    <td style="text-align:right;"><?php echo number_format($total,2); ?></td>
                                                </tr>
                                                
                                                 <tr>
                                                    <td colspan="4" style="text-align:right;">Discount:</td>

                                                    <td style="text-align:right;"><?php if(!empty($purchase_invoice_info[0]['discount'])) echo number_format($purchase_invoice_info[0]['discount'],2);  ?></td>
                                                </tr>
                                        
                                                <tr>
                                                    <td colspan="4" style="text-align:right;">Vat:</td>

                                                    <td style="text-align:right;"><?php if(!empty($purchase_invoice_info[0]['vat'])) echo number_format($purchase_invoice_info[0]['vat'],2);  ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="text-align:right;">Tax:</td>

                                                    <td style="text-align:right;"><?php if(!empty($purchase_invoice_info[0]['tax'])) echo number_format($purchase_invoice_info[0]['tax'],2);  ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="text-align:right;">Ait:</td>

                                                    <td style="text-align:right;"><?php if(!empty($purchase_invoice_info[0]['ait'])) echo number_format($purchase_invoice_info[0]['ait'],2);  ?></td>
                                                </tr>
                                        
                                                <tr>
                                                    <td colspan="4" style="text-align:right;">Net Payable Amount:</td>

                                                    <td style="text-align:right;"><b><?php if(!empty($purchase_invoice_info[0]['net_payable_amount'])) echo number_format($purchase_invoice_info[0]['net_payable_amount'],2);  ?></b></td>
                                                </tr>
                                                
                                                
                                                
                                            </tfoot>
                                      </table>




                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/purchase_invoices') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px">GO BACK</button> </a>
                                </div>
                                <!--
                                <div class="col-md-2 ">
                                    <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">SAVE</button>
                                </div>
                                -->
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
    
    
    $('#bill_id').change(function () {
        var bill_id = $('#bill_id').val();
         
        if (bill_id != '') {
            
           

            var d = new Date();
            var n = d.getFullYear();
            var final = n.toString().substring(2);

            var data = {'bill_id': bill_id}
            $.ajax({
                url: '<?php echo site_url('purchase_invoices/get_challan_item'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {

            
                    if(msg.invoice_code != ""){
                        var item_id = Number(msg.invoice_code[0].inv_code) + 1;
                    }else{
                        item_id = "";
                    }

                    var item_sl_no;
                    if (item_id != '') {
                        if (item_id > 999) {
                            item_sl_no = item_id;
                        } else if (item_id > 99) {
                            item_sl_no = "INV/" + msg.supplier_info[0].SUP_NAME + '/' + final + '/' + "0" + item_id;
                        } else if (item_id > 9) {
                            item_sl_no = "INV/" + msg.supplier_info[0].SUP_NAME + '/' + final + '/' + "00" + item_id;
                        } else {
                            item_sl_no = "INV/" + msg.supplier_info[0].SUP_NAME + '/' + final + '/' + "000" + item_id;
                        }
                    } else {
                        item_id = 1;
                        item_sl_no = "INV/" + msg.supplier_info[0].SUP_NAME + '/' + final + '/' + '0001';
                    }

                    $('#inv_code').val(item_id);
                    $('#inv_no').val(item_sl_no);
                    $('#supplier_id').val(msg.supplier_info[0].ID);




                    


                }

            })
        } else {
            $('#purchase_items tr').remove();
            $('#sub_total').val('');
            $('#net_payable_amount').val('');

            $('#inv_no').val('');
            $('#supplier_id').val('');
            $('#inv_code').val('');



        }
    });
    
    
    
    
    
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
    

    function validation() {
        var purchase_invoice_date = $('#purchase_invoice_date').val();
      
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

        if(purchase_invoice_date == ''){
            $('#purchase_invoice_date').css('border', '1px solid red');
            $('#purchase_invoice_date_error').html('Please fill date field');
            error = true;

        } else {
            $('#purchase_invoice_date').css('border', '1px solid #ccc');
            $('#purchase_invoice_date_error').html('');

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




  
   

    



    function addRow(){
        var str = '';
        var i = $('#sale_items').find('tr').length;
        str+='<tr id="row_'+(Number(i) + 1)+'">';
        str +='<td><select name="item_id[]" id="prod_'+(Number(i) + 1)+'" class="form-control" onchange="changeProduct('+(Number(i) + 1)+')"><option value="">Select Product</option>';
        <?php foreach($items as $r){?>
            
          //  var item_name="<?php echo $r['item_name'];?>";
            //alert(item_name);        
            str+='<option rel="<?php echo $r['meas_unit']; ?>" value="<?php echo $r['id']; ?>"><?php echo $r['id']; ?></option>';
        <?php } ?>
        str +='</select></td>';

        str +='<td><input required  style="width:140px;"  type="text"  name="mu_name[]" id="mu_name_'+(Number(i) + 1) + '" class="issue" value=""></td>';
        str +='<td><input required onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:140px;text-align:right;"  type="text"  name="quantity[]" id="quantity_'+(Number(i) + 1)+'" class="issue number" value=""></td>';
        str +='<td><input required onkeyup="calculateQuantityAmount('+(Number(i) + 1)+')" onchange="calculateQuantityAmount('+(Number(i) + 1)+')" onblur="calculateQuantityAmount('+(Number(i) + 1)+')"  style="width:140px;text-align:right;"  type="text"  name="unit_price[]" id="unit_price_'+(Number(i) + 1)+'" class="issue number" value=""></td>';
        str +='<td><input style="width:140px;text-align:right;"  type="text" class="amount_"  name="amount[]" id="amount_'+(Number(i) + 1)+'" onkeyup="calculateQuantity('+(Number(i)+1)+')" onchange="calculateQuantity('+(Number(i)+1)+')" onblur="calculateQuantity('+(Number(i)+1)+')" class="issue" value=""></td>'; 
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
         var table_row=Number(rowCount)-7;
         for(var i=1;i<=table_row;i++){
             var amt=$('#amount_'+i).val();
             sub_total=sub_total+Number(amt)
         }
       //  sub_total=sub_total+Number($('#pump').val())
        sub_total=sub_total.toFixed(2);
        var discount=Number($('#discount').val());
        var vat=Number($('#vat').val());
        var tax=Number($('#tax').val());
        var ait=Number($('#ait').val());
        var net_payable=sub_total-(vat+tax+ait+discount);
        $('#net_payable_amount').val(net_payable);
         $('#sub_total').val(sub_total);
         
        
       
    }

     function calculateNetPayableAmount(){
         $('.number').on('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);  
        });
        
        var subtotal=Number($('#sub_total').val());
        var discount=Number($('#discount').val());
        var vat=Number($('#vat').val());
        var tax=Number($('#tax').val());
        var ait=Number($('#ait').val());
        var net_payable=subtotal-(vat+tax+ait+discount);
        $('#net_payable_amount').val(net_payable);
        
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
         var table_row=Number(rowCount)-7;
         for(var i=1;i<=table_row;i++){
             var amt=$('#amount_'+i).val();
             sub_total=sub_total+Number(amt)
         }
       //  sub_total=sub_total+Number($('#pump').val())
        sub_total=sub_total.toFixed(2);
        var discount=Number($('#discount').val());
        var vat=Number($('#vat').val());
        var tax=Number($('#tax').val());
        var ait=Number($('#ait').val());
        var net_payable=sub_total-(vat+tax+ait+discount);
        $('#net_payable_amount').val(net_payable);
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
         var table_row=Number(rowCount)-7;
         for(var i=1;i<=table_row;i++){
             var amt=$('#amount_'+i).val();
             sub_total=sub_total+Number(amt)
         }
       //  sub_total=sub_total+Number($('#pump').val())
        sub_total=sub_total.toFixed(2);
        var discount=Number($('#discount').val());
        var vat=Number($('#vat').val());
        var tax=Number($('#tax').val());
        var ait=Number($('#ait').val());
        var net_payable=sub_total-(vat+tax+ait+discount);
        $('#net_payable_amount').val(net_payable);
        $('#sub_total').val(sub_total);
         
        
       
    }

</script>

