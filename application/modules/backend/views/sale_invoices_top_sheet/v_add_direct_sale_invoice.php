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
                        <form class="form-horizontal" action="<?php echo site_url('sale_invoices/add_direct_sale_invoice_action'); ?>" method="post" onsubmit="javascript: return validation()">

                             <div class='form-group' style="margin-bottom:15px;" >
                                <label for="title" class="col-sm-2 control-label">
                                     Select customer<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  class="form-control e1" placeholder="Select Customer" id="customer_id" name="customer_id" onchange="javascript:project_info();" >
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
                                     Select Project<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  class="form-control e1" placeholder="Select Project" id="project_id" name="project_id" onchange="javascript:sales_order_info();" >
                                          <option value="" >Select Project</option>
                                       

                                     </select> 
                                    <span id="do_id_error" style="color:red"></span>
                                </div>


                            </div>
                            
                                                 
                            
                  
                            <div class='form-group' style="margin-bottom:15px;" >
                                <label for="title" class="col-sm-2 control-label">
                                   Product Type<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  class="form-control e1" placeholder="Select Type" id="category_id" name="category_id" >
                                          <option value="" >Product Type</option>
                                        <?php foreach($product_categories as $product_category){ ?>
                                           <option   value="<?php echo $product_category['category_id'] ?>"><?php echo $product_category['category_name'] ?></option> 
                                        <?php } ?>    
                                         

                                     </select>
                                    <span id="category_id_error" style="color:red"></span>
                                </div>


                            </div>    
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Invoice No<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>                            
                                    <input class="form-control" id="inv_no" name="inv_no" type="text" value="">
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

                            
                           

                           

                          
                        

                            <div class="row">




                            </div>  

                            <div class="separator-shadow"></div>
                             <div class="row">
                                <input type="hidden" value="1" id="count" />
                                    <table class="table table-bordered" id="myTable" >
                                        <thead class="thead-color">
                                         <tr >
                                             <th>Product Name <sup style='color:red'>*</sup></th>
                                             <th>M. Unit</th>
                                             <th>Quantity</th>              
                                             <th>Unit Price</th>
                                             <th>Amount</th>
                                             <th>Remark</th>
                                             <th><a href="javascript:" class="btn btn-sm btn-primary" onclick="addRow()">+</a></th>
                                          </tr>
                                        </thead>
                                        <tbody id="sale_items">


                                          </tbody>
                                           <tfoot>
                                               <!--
                                                <tr>
                                                    <td colspan="4" style="text-align:right;">Pumping Cost:</td>

                                                    <td><input style="width:140px;text-align:right;" onkeyup="changePump()" id="pump"  name="pump" type="text"></td>
                                                </tr>
                                               -->
                                                <tr>
                                                    <td colspan="4" style="text-align:right;">Subtotal:</td>

                                                    <td><input readonly style="width:140px;text-align:right;" id="sub_total"  name="total_amount" type="text"></td>
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
    

    function validation() {
        var sale_invoice_date = $('#sale_invoice_date').val();
      
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

        if(sale_invoice_date == ''){
            $('#sale_invoice_date').css('border', '1px solid red');
            $('#sale_invoice_date_error').html('Please fill date field');
            error = true;

        } else {
            $('#sale_invoice_date').css('border', '1px solid #ccc');
            $('#sale_invoice_date_error').html('');

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




  
    function project_info(){
               
            var customer_id=$('#customer_id').val();
            if(customer_id!=''){
                $.ajax({
                    type: "POST",
                    url: "backend/sale_invoices/customer_project_info",
                    data: "customer_id="+customer_id,
                    dataType: "json",
                    success: function (data) {
                       
                                
                                 var str = '';
                                 str += '<option class="form-controll" value="">Select Project</option>';
                                 $(data.project).each(function (row, val) {
                                     
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
          }else{
              
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

    



    function addRow(){
        var str = '';
        var i = $('#sale_items').find('tr').length;
        str+='<tr id="row_'+(Number(i) + 1)+'">';
        str +='<td><select name="s_item_id[]" id="prod_'+(Number(i) + 1)+'" class="form-control" onchange="changeProduct('+(Number(i) + 1)+')"><option value="">Select Product</option>';
        <?php foreach($products as $r){?>
            str+='<option rel="<?php echo $r['measurement_unit']; ?>" value="<?php echo $r['product_id']; ?>"><?php echo $r['product_name']; ?></option>';
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
         var table_row=Number(rowCount)-2;
         for(var i=1;i<=table_row;i++){
             var amt=$('#amount_'+i).val();
             sub_total=sub_total+Number(amt)
         }
       //  sub_total=sub_total+Number($('#pump').val())
         sub_total=sub_total.toFixed(2);
         $('#sub_total').val(sub_total);
         
        
       
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
         var table_row=Number(rowCount)-2;
         for(var i=1;i<=table_row;i++){
             var amt=$('#amount_'+i).val();
             sub_total=sub_total+Number(amt)
         }
       //  sub_total=sub_total+Number($('#pump').val())
         sub_total=sub_total.toFixed(2);
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
         var table_row=Number(rowCount)-2;
         for(var i=1;i<=table_row;i++){
             var amt=$('#amount_'+i).val();
             sub_total=sub_total+Number(amt)
         }
       //  sub_total=sub_total+Number($('#pump').val())
         sub_total=sub_total.toFixed(2);
         $('#sub_total').val(sub_total);
         
        
       
    }

</script>

