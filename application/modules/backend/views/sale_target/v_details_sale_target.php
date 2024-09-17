<style type="text/css">
    .form-control{
        height:30px;
    }
    table tr td, table tr th{
        text-align: center;
        vertical-align: middle !important;
    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3> Details Sale Target</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <form class="form-horizontal" action="<?php echo site_url('sale_target/edit_sale_target_action/'.$sale_target_info[0]['st_id']); ?>" method="post" onsubmit="javascript: return validation()">
       <div class='form-group'  style="margin-bottom:30px;">
           
                <label for="title" class="col-sm-2 control-label">
                                     Sales Person<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                   
                                        <?php foreach($employees as $em){ ?>
                                            <?php if($em['id']==$sale_target_info[0]['employee_id']) echo $em['name']; ?> 
                                        <?php } ?>
                                  
                        <span id="c_id_error" style="color:red"></span>
                                </div>
           
                               <label for="title" class="col-sm-2 control-label">
                                    Month<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    
                                   <?php echo $sale_target_info[0]['month'] ?>
                      
                                </div>
                                

                            </div>  
        
       
        
       
        
        
      
       
        <div class="separator-shadow"></div>
     
        <div class="row">
           
                <table class="table table-bordered" id="myTable" >
                    <thead class="thead-color">
                     <tr>
                         <th>Product Name <sup style='color:red'>*</sup></th>
                         <th>M. Unit</th>
                         <th>Quantity</th>   
                         <th>Unit Price</th>          
                         <th>BEP Qty</th>          
                         <th>Amount</th>
                         <th>BEP Amount</th>
                         <th>Remark</th>
                        

                      </tr>
                    </thead>
                    <tbody id="sale_items">
                          <?php $i=0; foreach($sale_order_details_info as $sale_order_details){ 
                            $i++;
                            ?>
                         <tr class="" id="row_<?php echo $i; ?>">
                            <td><?php echo $sale_order_details['category_name'] ?></td>
                            <td><?php echo $sale_order_details['mu_name'] ?></td>
                            <td><?php echo $sale_order_details['quantity'] ?></td>
                            <td><?php echo $sale_order_details['unit_price'] ?></td>    
                            <td><?php echo $sale_order_details['bep_qty'] ?></td>    
                            <td><?php echo $sale_order_details['amount'] ?></td>
                            <td><?php echo $sale_order_details['bep_amount'] ?></td>
                            <td><?php echo $sale_order_details['remark'] ?></td>
                           
                          </tr>
                        <?php } ?>
                      
                      </tbody>
                       <tfoot>
                           <!--
                            <tr>
                                <td colspan="4" style="text-align:right;">Pumping Cost:</td>

                                <td><input style="width:140px;text-align:right;" onkeyup="changePump()" id="pump"  name="pump" type="text"value="<?php if(!empty($sale_order_info[0]['pump'])) echo $sale_order_info[0]['pump']; ?>"></td>
                            </tr>
                           -->
                            <tr>
                                <td colspan="5" style="text-align:right;">Subtotal:</td>

                                <td><?php if(!empty($sale_target_info[0]['total_amount'])) echo $sale_target_info[0]['total_amount']; ?></td>
                            

                                <td><?php if(!empty($sale_target_info[0]['bep_total'])) echo $sale_target_info[0]['bep_total']; ?></td>
                            </tr>
                        </tfoot>
                  </table>
           
            
            
            
        </div>
       
        <div class="row">
           <div class="col-md-2">
                <a href="<?php echo site_url('backend/sale_target') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>

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
    
//     function changePump(){
//       var sub_total = 0;
//        var rowCount = $('#myTable tr').length;
//         var table_row=Number(rowCount)-3;
//         for(var i=1;i<=table_row;i++){
//             var amt=$('#amount_'+i).val();
//             sub_total=sub_total+Number(amt)
//         }
//         sub_total=sub_total+Number($('#pump').val())
//         sub_total=sub_total.toFixed(2);
//         $('#sub_total').val(sub_total);
//   }
    
       function addRow(){
        var str = '';
var i = $('#sale_items').find('tr').length;
                             str+='<tr id="row_'+(Number(i) + 1)+'">';
                             str +='<td><select name="category_id[]" id="prod_'+(Number(i) + 1)+'" class="form-control" onchange="changeProduct('+(Number(i) + 1)+')"><option value="">Select Product</option>';
                             <?php foreach($categories as $r){?>
                                 str+='<option rel="<?php echo $r['measurement_unit']; ?>" value="<?php echo $r['category_id']; ?>"><?php echo $r['category_name']; ?></option>';
                             <?php } ?>
                             str +='</select></td>';
                                                      
                             str +='<td><input required  style="width:140px;"  type="text"  name="mu_name[]" id="mu_name_'+(Number(i) + 1) + '" class="issue" value=""></td>';
                             str +='<td><input required onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:140px;text-align:right;"  type="text"  name="quantity[]" id="quantity_'+(Number(i) + 1)+'" class="issue number" value=""></td>';
                             str +='<td><input required onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:140px;text-align:right;"  type="text"  name="unit_price[]" id="unit_price_'+(Number(i) + 1)+'" class="issue number" value=""></td>';
                             str +='<td><input readonly  style="width:140px;text-align:right;"  type="text" class="amount_"  name="amount[]" id="amount_'+(Number(i) + 1)+'" class="issue" value=""></td>'; 
                             str +='<td><input   style="width:140px;"  type="text"  name="remark[]" id="remark_'+(Number(i) + 1) + '" class="issue" value=""></td>';
                             str +='<td><a href="javascript:" class="btn btn-sm btn-danger" onclick="deleteRow('+(Number(i) + 1)+')">-</a></td>';
                             str+='</tr>';
                         
        $('#sale_items').append(str);
   }
       function changeProduct(row){
       $('#mu_name_'+row).val($('#prod_'+row).find('option:selected').attr('rel'));
   }
   
   function deleteRow(row){
       if(confirm('Are you sure to remove ?')==true)
       $('#row_'+row).remove();
   calculateSubtotal(row)
   }
   
   
   $('#project_name').change(function(){
         $.ajax({
                    url: '<?php echo site_url('sale_orders/get_project_info'); ?>',
                    data: {'id':$(this).val()},
                    method: 'POST',
                    dataType: 'json',
                    success: function (msg) { 
                      $('#shipping_address').val(msg.project.address);
                      $('#contact_person').val(msg.project.contact_person)
                      $('#contact_no').val(msg.project.contact_no)
                    }
        })
   })
   
    var datePickerOptions = {
                dateFormat: 'dd-mm-yy',
                firstDay: 1,
                changeMonth: true,
                changeYear: true,
                // ...
            }
    $('.datepicker1').datepicker(datePickerOptions);
    
   //Hide Show Start  
    $('#payment_hide_button').click(function (){
        $('#payment_condition').hide();
        $('#payment_show_button').show();
        $('#payment_hide_button').hide();
    });
    
    $('#payment_show_button').click(function (){
        $('#payment_condition').show();
        $('#payment_hide_button').show();
        $('#payment_show_button').hide();
        
    });
    
    
   $('#special_hide_button').click(function (){
        $('#special_note').hide();
        $('#special_show_button').show();
        $('#special_hide_button').hide();
    });
    
    $('#special_show_button').click(function (){
        $('#special_note').show();
        $('#special_hide_button').show();
        $('#special_show_button').hide();
        
    });
   
   
   
    
    $('#specification_hide_button').click(function (){
        $('#specification_raw_material').hide();
        $('#specification_show_button').show();
        $('#specification_hide_button').hide();
    });
    
    $('#specification_show_button').click(function (){
        $('#specification_raw_material').show();
        $('#specification_hide_button').show();
        $('#specification_show_button').hide();
        
    });
    
  //HIde Show End  
   
   
   
    function validation(){
        
        var c_id=$('#c_id').val();
      
       
        
        var error=false;
        
//        if(sale_order_date==''){
//            $('#sale_order_date').css('border','1px solid red');
//            $('#sale_order_date_error').html('Please fill date field');
//            error=true;
//            $('#sale_order_date').focus();
//        }else{
//            $('#sale_order_date').css('border','1px solid #ccc');
//            $('#sale_order_date_error').html('');
//            
//        }
        if(c_id==''){
            $('#c_id_error').html('Please select customer');
            $('#c_id').css('border','1px solid red');
            error=true;
            $('#c_id').focus();
        }else{
            $('#c_id_error').html('');
            $('#c_id').css('border','1px solid #ccc');   
            
        }
      
//         if(project_name==''){
//            $('#project_name_error').html('Please fill  project name field');
//            $('#project_name').css('border','1px solid red'); 
//            error=true;
//            $('#project_name').focus();
//        }else{
//            $('#project_name_error').html('');
//            $('#project_name').css('border','1px solid #ccc');   
//             
//        }
//        
//        if(attention==''){
//            $('#attention_error').html('Please fill  attention field');
//            $('#attention').css('border','1px solid red'); 
//            error=true;
//            $('#attention').focus();
//        }else{
//            $('#attention_error').html('');
//            $('#attention').css('border','1px solid #ccc');  
//             
//        }
//        
//        if(phone==''){
//            $('#phone_error').html('Please fill phone number field');
//            $('#phone').css('border','1px solid red'); 
//            error=true;
//            $('#phone').focus();
//        }else{
//            $('#phone_error').html('');
//            $('#phone').css('border','1px solid #ccc');  
//             
//        }
//        
//        if(billing_address==''){
//            $('#billing_address_error').html('Please fill billing address field');
//            $('#billing_address').css('border','1px solid red'); 
//            error=true;
//            $('#billing_address').focus();
//        }else{
//            $('#billing_address_error').html('');
//            $('#billing_address').css('border','1px solid #ccc');  
//             
//        }
//        
//         if(billing_email==''){
////            $('#billing_email_error').html('Please fill billing email field');
////            $('#billing_email').css('border','1px solid red'); 
////            error=true;
////            $('#billing_email').focus();
//        }else{
//           var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
//            if(!regex.test(billing_email)) {
//                $('#billing_email_error').html('Invalid email address');
//                $('#billing_email').css('border','1px solid red');  
//                error=true;
//                $('#billing_email').focus();
//            }else{
//               $('#billing_email_error').html('');
//               $('#billing_email').css('border','1px solid #ccc');  
//            }
//             
//        }
//        
//        if(shipping_address==''){
//            $('#shipping_address_error').html('Please fill delivery address field');
//            $('#shipping_address').css('border','1px solid red'); 
//            error=true;
//            $('#shipping_address').focus();
//        }else{
//            $('#shipping_address_error').html('');
//            $('#shipping_address').css('border','1px solid #ccc');  
//             
//        }
//        
//        if(shipping_email==''){
////            $('#shipping_email_error').html('Please fill delivery email field');
////            $('#shipping_email').css('border','1px solid red'); 
////            error=true;
////            $('#shipping_email').focus();
//        }else{
//            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
//            if(!regex.test(shipping_email)) {
//                $('#shipping_email_error').html('Invalid email address');
//                $('#shipping_email').css('border','1px solid red');  
//                error=true;
//                $('#shipping_email').focus();
//            }else{
//               $('#shipping_email_error').html('');
//               $('#shipping_email').css('border','1px solid #ccc');  
//            } 
//             
//        }
//        
//        if(delivery_date==''){
//            $('#delivery_date').css('border','1px solid red');
//            $('#delivery_date_error').html('Please fill delivery date field');
//            error=true;
//            $('#delivery_date').focus();
//        }else{
//            $('#delivery_date').css('border','1px solid #ccc');
//            $('#delivery_date_error').html('');
//            
//        }
//       
        
        if(error==true){
            return false;
        }
    }
   
    
    
     $('#c_id').change(function(){
        var c_id=$('#c_id').val();
        $('#q_id').html('');
         var data = {'id': c_id}
         
         $('#sale_items tr').remove();
          
          
           
    });
   
   
    
    
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
         //alert('test');
         var sub_total=0;
         var unit_price=$('#unit_price_'+id).val();
         var quantity=$('#quantity_'+id).val();
         var amount=Number(unit_price)*Number(quantity);
         amount=amount.toFixed(2);
         $('#amount_'+id).val(amount);
         var rowCount = $('#myTable tr').length;
         var table_row=Number(rowCount)-2;
         for(var i=1;i<=table_row;i++){
             var amt=$('#amount_'+i).val();
             sub_total=sub_total+Number(amt)
             
         }
       //  sub_total=sub_total+Number($('#pump').val())
       //  alert(sub_total)
         sub_total=sub_total.toFixed(2);
         $('#sub_total').val(sub_total);
         
        if($('#b_cash').prop('checked')){
            var b_cash_percent=Number($('#b_cash_percent').val());
            var amount=(Number(b_cash_percent)*sub_total)/100;      
            var net_amount=amount.toFixed(2);
            
            $('#b_cash_amount').val(net_amount);
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
            var remaining_balance=sub_total-total_amount;
            var remaining=remaining_balance.toFixed(2);
            if(remaining<0){
                remaining=0;
            }    
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
           
       }
        if($('#a_cash').prop('checked')){
             var a_cash_percent=Number($('#a_cash_percent').val());
             var amount=(Number(a_cash_percent)*sub_total)/100;      
             var net_amount=amount.toFixed(2);

             $('#a_cash_amount').val(net_amount);
             var b_cash_amount=$('#b_cash_amount').val();
             var a_cash_amount=$('#a_cash_amount').val();
             var b_bg_amount=$('#b_bg_amount').val();
             var a_bg_amount=$('#a_bg_amount').val();
             var b_lc_amount=$('#b_lc_amount').val();
             var a_lc_amount=$('#a_lc_amount').val();
             var b_pdc_amount=$('#b_pdc_amount').val();
             var a_pdc_amount=$('#a_pdc_amount').val();
             var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
             var remaining_balance=sub_total-total_amount;
             var remaining=remaining_balance.toFixed(2);
             if(remaining<0){
                 remaining=0;
             }    
             $('#remaining_balance').val(remaining);
             $('#balance').html(remaining);
        }
        if($('#b_bg').prop('checked')){
             var b_bg_percent=Number($('#b_bg_percent').val());
             var amount=(Number(b_bg_percent)*sub_total)/100;      
             var net_amount=amount.toFixed(2);

             $('#b_bg_amount').val(net_amount);
             var b_cash_amount=$('#b_cash_amount').val();
             var a_cash_amount=$('#a_cash_amount').val();
             var b_bg_amount=$('#b_bg_amount').val();
             var a_bg_amount=$('#a_bg_amount').val();
             var b_lc_amount=$('#b_lc_amount').val();
             var a_lc_amount=$('#a_lc_amount').val();
             var b_pdc_amount=$('#b_pdc_amount').val();
             var a_pdc_amount=$('#a_pdc_amount').val();
             var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
             var remaining_balance=sub_total-total_amount;
             var remaining=remaining_balance.toFixed(2);
             if(remaining<0){
                 remaining=0;
             }    
             $('#remaining_balance').val(remaining);
             $('#balance').html(remaining);
        }
        if($('#a_bg').prop('checked')){
             var a_bg_percent=Number($('#a_bg_percent').val());
             var amount=(Number(a_bg_percent)*sub_total)/100;      
             var net_amount=amount.toFixed(2);

             $('#a_bg_amount').val(net_amount);
             var b_cash_amount=$('#b_cash_amount').val();
             var a_cash_amount=$('#a_cash_amount').val();
             var b_bg_amount=$('#b_bg_amount').val();
             var a_bg_amount=$('#a_bg_amount').val();
             var b_lc_amount=$('#b_lc_amount').val();
             var a_lc_amount=$('#a_lc_amount').val();
             var b_pdc_amount=$('#b_pdc_amount').val();
             var a_pdc_amount=$('#a_pdc_amount').val();
             var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
             var remaining_balance=sub_total-total_amount;
             var remaining=remaining_balance.toFixed(2);
             if(remaining<0){
                 remaining=0;
             }    
             $('#remaining_balance').val(remaining);
             $('#balance').html(remaining);
        }
        if($('#b_lc').prop('checked')){
             var b_lc_percent=Number($('#b_lc_percent').val());
              var amount=(Number(b_lc_percent)*sub_total)/100;      
             var net_amount=amount.toFixed(2);

             $('#b_lc_amount').val(net_amount);
             var b_cash_amount=$('#b_cash_amount').val();
             var a_cash_amount=$('#a_cash_amount').val();
             var b_bg_amount=$('#b_bg_amount').val();
             var a_bg_amount=$('#a_bg_amount').val();
             var b_lc_amount=$('#b_lc_amount').val();
             var a_lc_amount=$('#a_lc_amount').val();
             var b_pdc_amount=$('#b_pdc_amount').val();
             var a_pdc_amount=$('#a_pdc_amount').val();
             var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
             var remaining_balance=sub_total-total_amount;
             var remaining=remaining_balance.toFixed(2);
             if(remaining<0){
                 remaining=0;
             }    
             $('#remaining_balance').val(remaining);
             $('#balance').html(remaining);
        }
        if($('#a_lc').prop('checked')){
             var a_lc_percent=Number($('#a_lc_percent').val());
              var amount=(Number(a_lc_percent)*sub_total)/100;      
             var net_amount=amount.toFixed(2);

             $('#a_lc_amount').val(net_amount);
             var b_cash_amount=$('#b_cash_amount').val();
             var a_cash_amount=$('#a_cash_amount').val();
             var b_bg_amount=$('#b_bg_amount').val();
             var a_bg_amount=$('#a_bg_amount').val();
             var b_lc_amount=$('#b_lc_amount').val();
             var a_lc_amount=$('#a_lc_amount').val();
             var b_pdc_amount=$('#b_pdc_amount').val();
             var a_pdc_amount=$('#a_pdc_amount').val();
             var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
             var remaining_balance=sub_total-total_amount;
             var remaining=remaining_balance.toFixed(2);
             if(remaining<0){
                 remaining=0;
             }    
             $('#remaining_balance').val(remaining);
             $('#balance').html(remaining);
        }

        if($('#b_pdc').prop('checked')){
             var b_pdc_percent=Number($('#b_pdc_percent').val());
             var amount=(Number(b_pdc_percent)*sub_total)/100;      
             var net_amount=amount.toFixed(2);

             $('#b_pdc_amount').val(net_amount);
             var b_cash_amount=$('#b_cash_amount').val();
             var a_cash_amount=$('#a_cash_amount').val();
             var b_bg_amount=$('#b_bg_amount').val();
             var a_bg_amount=$('#a_bg_amount').val();
             var b_lc_amount=$('#b_lc_amount').val();
             var a_lc_amount=$('#a_lc_amount').val();
             var b_pdc_amount=$('#b_pdc_amount').val();
             var a_pdc_amount=$('#a_pdc_amount').val();
             var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
             var remaining_balance=sub_total-total_amount;
             var remaining=remaining_balance.toFixed(2);
             if(remaining<0){
                 remaining=0;
             }    
             $('#remaining_balance').val(remaining);
             $('#balance').html(remaining);
        }
        if($('#a_pdc').prop('checked')){
             var a_pdc_percent=Number($('#a_pdc_percent').val());
             var amount=(Number(a_pdc_percent)*sub_total)/100;      
             var net_amount=amount.toFixed(2);

             $('#a_pdc_amount').val(net_amount);
             var b_cash_amount=$('#b_cash_amount').val();
             var a_cash_amount=$('#a_cash_amount').val();
             var b_bg_amount=$('#b_bg_amount').val();
             var a_bg_amount=$('#a_bg_amount').val();
             var b_lc_amount=$('#b_lc_amount').val();
             var a_lc_amount=$('#a_lc_amount').val();
             var b_pdc_amount=$('#b_pdc_amount').val();
             var a_pdc_amount=$('#a_pdc_amount').val();
             var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
             var remaining_balance=sub_total-total_amount;
             var remaining=remaining_balance.toFixed(2);
             if(remaining<0){
                 remaining=0;
             }    
             $('#remaining_balance').val(remaining);
             $('#balance').html(remaining);
        }
    }
    
    
   function calculatePercentAmount(id){
        if(id=='b_cash_percent'){
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
            
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#b_cash_percent').val('');
                $('#b_cash_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
                if(balance!=''){
                    var amount=(Number(b_cash_percent)*balance)/100;
                   
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#b_cash_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }else  if(id=='a_cash_percent'){
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#a_cash_percent').val('');
                $('#a_cash_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
               
                if(balance!=''){
                    var amount=(Number(a_cash_percent)*balance)/100;
                   
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#a_cash_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }else  if(id=='b_bg_percent'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#b_bg_percent').val('');
                $('#b_bg_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
               
                if(balance!=''){
                    var amount=(Number(b_bg_percent)*balance)/100;
                   
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#b_bg_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }else  if(id=='a_bg_percent'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#a_bg_percent').val('');
                $('#a_bg_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
               
                if(balance!=''){
                    var amount=(Number(a_bg_percent)*balance)/100;
                   
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#a_bg_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }else  if(id=='b_lc_percent'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#b_lc_percent').val('');
                $('#b_lc_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
               
                if(balance!=''){
                    var amount=(Number(b_lc_percent)*balance)/100;
                   
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#b_lc_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }else  if(id=='a_lc_percent'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#a_lc_percent').val('');
                $('#a_lc_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
               
                if(balance!=''){
                    var amount=(Number(a_lc_percent)*balance)/100;
                   
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#a_lc_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }else  if(id=='b_pdc_percent'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(a_pdc_amount);
          
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#b_pdc_percent').val('');
                $('#b_pdc_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
               
                if(balance!=''){
                    var amount=(Number(b_pdc_percent)*balance)/100;
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#b_pdc_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }else  if(id=='a_pdc_percent'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount);
          
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#a_pdc_percent').val('');
                $('#a_pdc_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
               
                if(balance!=''){
                    var amount=(Number(a_pdc_percent)*balance)/100;
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#a_pdc_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }
        
        
        
    } 
    
   function enablePaymentCondition(paymode){
        var subtotal=$('#sub_total').val();
        if(paymode=="b_cash"){
            if(subtotal>0){
                if($('#b_cash').prop('checked')){
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                    
                    
                    
                    if($('#a_cash').prop('checked')  || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')){
                        if($('#a_cash').prop('checked') && a_cash_percent=='' && a_cash_amount==''){
                            $('#b_cash').prop('checked',false);
                        }else if($('#b_bg').prop('checked') && b_bg_percent==''){
                            $('#b_cash').prop('checked',false);
                        }else if($('#a_bg').prop('checked') && a_bg_percent==''){
                            $('#b_cash').prop('checked',false);
                        }else if($('#b_lc').prop('checked') && b_lc_percent==''){
                            $('#b_cash').prop('checked',false);
                        }else if($('#a_lc').prop('checked') && a_lc_percent==''){
                            $('#b_cash').prop('checked',false);
                        }else if($('#b_pdc').prop('checked') && b_pdc_percent==''){
                            $('#b_cash').prop('checked',false);
                        }else if($('#a_pdc').prop('checked') && a_pdc_percent==''){
                            $('#b_cash').prop('checked',false);
                        }else{
                            var total_percent=a_cash_percent+b_bg_percent+a_bg_percent+b_lc_percent+a_lc_percent+b_pdc_percent+a_pdc_percent;
                            if(total_percent<100){
                                $('#b_cash_tenor').prop('readonly',false);
                                $('#b_cash_percent').prop('readonly',false);
                                $('#b_cash_percent').prop('required',true);
                                
                                $('#b_cash_amount').prop('readonly',false);
                                $('#b_cash_amount').prop('required',true);
                               
                            }else{
                               $('#b_cash').prop('checked',false); 
                            }
                        }

                    }else{

                        var total_percent=a_cash_percent+b_bg_percent+a_bg_percent+b_lc_percent+a_lc_percent+b_pdc_percent+a_pdc_percent;
                        if(total_percent<100){
                            $('#b_cash_tenor').prop('readonly',false);
                            $('#b_cash_percent').prop('readonly',false);
                            $('#b_cash_percent').prop('required',true);
                            $('#b_cash_amount').prop('readonly',false);
                            $('#b_cash_amount').prop('required',true);
                        }else{
                           $('#b_cash').prop('checked',false); 
                        }
                    }

                }else{
                    var b_cash_amount=$('#b_cash_amount').val();
                    var a_cash_amount=$('#a_cash_amount').val();
                    var b_bg_amount=$('#b_bg_amount').val();
                    var a_bg_amount=$('#a_bg_amount').val();
                    var b_lc_amount=$('#b_lc_amount').val();
                    var a_lc_amount=$('#a_lc_amount').val();
                    var b_pdc_amount=$('#b_pdc_amount').val();
                    var a_pdc_amount=$('#a_pdc_amount').val();

                    var total_amount=Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
                    if(total_amount>0){
                        var net_total=Number($('#sub_total').val())-total_amount;
                    }else{
                        var net_total=Number($('#sub_total').val());
                    }
                    $('#balance').html(net_total);
                    $('#b_cash_amount').val('');
                    $('#b_cash_tenor').val('');
                    $('#b_cash_percent').val('');

                    $('#b_cash_tenor').prop('readonly',true);
                    $('#b_cash_percent').prop('readonly',true);
                    $('#b_cash_amount').prop('readonly',true);
                    $('#b_cash_percent').prop('required',false);
                    $('#b_cash_amount').prop('required',false);
                    
                }
            }else{
                $('#b_cash').prop('checked',false);
                alert('Please select product first');
            }
        }else if(paymode=="a_cash"){
             if(subtotal>0){
                 if($('#a_cash').prop('checked')){
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                    
                    
                var total_percent=b_cash_percent+b_bg_percent+a_bg_percent+b_lc_percent+a_lc_percent+b_pdc_percent+a_pdc_percent;
                 if($('#b_cash').prop('checked')  || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')){
                    if($('#b_cash').prop('checked') && b_cash_percent==''){
                        $('#a_cash').prop('checked',false);
                    }else if($('#b_bg').prop('checked') && b_bg_percent==''){
                        $('#a_cash').prop('checked',false);
                    }else if($('#a_bg').prop('checked') && a_bg_percent==''){
                        $('#a_cash').prop('checked',false);
                    }else if($('#b_lc').prop('checked') && b_lc_percent==''){
                        $('#a_cash').prop('checked',false);
                    }else if($('#a_lc').prop('checked') && a_lc_percent==''){
                        $('#a_cash').prop('checked',false);
                    }else if($('#b_pdc').prop('checked') && b_pdc_percent==''){
                        $('#a_cash').prop('checked',false);
                    }else if($('#a_pdc').prop('checked') && a_pdc_percent==''){
                        $('#a_cash').prop('checked',false);
                    }else{
                        
                        if(total_percent<100){
                            $('#a_cash_tenor').prop('readonly',false);
                            $('#a_cash_percent').prop('readonly',false);
                            $('#a_cash_percent').prop('required',true);
                            
                            $('#a_cash_amount').prop('readonly',false);
                            $('#a_cash_amount').prop('required',true);
                        }else{
                           $('#a_cash').prop('checked',false); 
                        }
                    }
                    
                }else{
                        if(total_percent<100){
                           $('#a_cash_tenor').prop('readonly',false);
                           $('#a_cash_percent').prop('readonly',false);
                           $('#a_cash_percent').prop('required',true);
                           
                           $('#a_cash_amount').prop('readonly',false);
                           $('#a_cash_amount').prop('required',true);
                       }else{
                           $('#a_cash').prop('checked',false);
                       }
              }
               
            }else{
                var b_cash_amount=$('#b_cash_amount').val();
                var a_cash_amount=$('#a_cash_amount').val();
                var b_bg_amount=$('#b_bg_amount').val();
                var a_bg_amount=$('#a_bg_amount').val();
                var b_lc_amount=$('#b_lc_amount').val();
                var a_lc_amount=$('#a_lc_amount').val();
                var b_pdc_amount=$('#b_pdc_amount').val();
                var a_pdc_amount=$('#a_pdc_amount').val();
               
                var total_amount=Number(b_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
                if(total_amount>0){
                    var net_total=Number($('#sub_total').val())-total_amount;
                }else{
                    var net_total=Number($('#sub_total').val());
                }
                $('#balance').html(net_total);
                $('#a_cash_amount').val('');
                $('#a_cash_tenor').val('');
                $('#a_cash_percent').val('');
                
                $('#a_cash_tenor').prop('readonly',true);
                $('#a_cash_percent').prop('readonly',true);

                $('#a_cash_percent').prop('required',false);
                
                $('#a_cash_amount').prop('readonly',true);
                $('#a_cash_amount').prop('required',false);
            }
             }else{
                 $('#a_cash').prop('checked',false);
                 alert('Please select product first');
             }
        }else if(paymode=="b_bg"){
            if(subtotal>0){
                if($('#b_bg').prop('checked')){
                var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                    
                    
                    
                var total_percent=b_cash_percent+a_cash_percent+a_bg_percent+b_lc_percent+a_lc_percent+b_pdc_percent+a_pdc_percent;
                if($('#b_cash').prop('checked')  || $('#a_cash').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')){
                    if($('#b_cash').prop('checked') && b_cash_percent==''){
                        $('#b_bg').prop('checked',false);
                    }else if($('#a_cash').prop('checked') && a_cash_percent==''){
                        $('#b_bg').prop('checked',false);
                    }else if($('#a_bg').prop('checked') && a_bg_percent==''){
                        $('#b_bg').prop('checked',false);
                    }else if($('#b_lc').prop('checked') && b_lc_percent==''){
                        $('#b_bg').prop('checked',false);
                    }else if($('#a_lc').prop('checked') && a_lc_percent==''){
                        $('#b_bg').prop('checked',false);
                    }else if($('#b_pdc').prop('checked') && b_pdc_percent==''){
                        $('#b_bg').prop('checked',false);
                    }else if($('#a_pdc').prop('checked') && a_pdc_percent==''){
                        $('#b_bg').prop('checked',false);
                    }else{
                        
                        if(total_percent<100){
                            $('#b_bg_tenor').prop('readonly',false);
                            $('#b_bg_percent').prop('readonly',false);
                            $('#b_bg_tenor').prop('required',true);
                            $('#b_bg_percent').prop('required',true);
                            
                            $('#b_bg_amount').prop('readonly',false);   
                            $('#b_bg_amount').prop('required',true);
                        }else{
                           $('#b_bg').prop('checked',false); 
                        }
                    }
                    
                }else{
                    if(total_percent<100){
                        $('#b_bg_tenor').prop('readonly',false);
                        $('#b_bg_percent').prop('readonly',false);
                        $('#b_bg_tenor').prop('required',true);
                        $('#b_bg_percent').prop('required',true);
                        
                        $('#b_bg_amount').prop('readonly',false);   
                        $('#b_bg_amount').prop('required',true);
                    }else{
                        $('#b_bg').prop('checked',false);
                    }
                }
               
            }else{
                var b_cash_amount=$('#b_cash_amount').val();
                var a_cash_amount=$('#a_cash_amount').val();
                var b_bg_amount=$('#b_bg_amount').val();
                var a_bg_amount=$('#a_bg_amount').val();
                var b_lc_amount=$('#b_lc_amount').val();
                var a_lc_amount=$('#a_lc_amount').val();
                var b_pdc_amount=$('#b_pdc_amount').val();
                var a_pdc_amount=$('#a_pdc_amount').val();
               
                var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
                if(total_amount>0){
                    var net_total=Number($('#sub_total').val())-total_amount;
                }else{
                    var net_total=Number($('#sub_total').val());
                }
                $('#balance').html(net_total);
                $('#b_bg_amount').val('');
                $('#b_bg_tenor').val('');
                $('#b_bg_percent').val('');
                
                $('#b_bg_tenor').prop('readonly',true);
                $('#b_bg_percent').prop('readonly',true);
                
                $('#b_bg_tenor').prop('required',false);
                $('#b_bg_percent').prop('required',false);
                
                $('#b_bg_amount').prop('readonly',true);   
                $('#b_bg_amount').prop('required',false);
            }
            }else{
                $('#b_bg').prop('checked',false);
                alert('Please select product first');
            }
        }else if(paymode=="a_bg"){
            if(subtotal>0){
              if($('#a_bg').prop('checked')){
                  
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                
                
                
                
                var total_percent=b_cash_percent+a_cash_percent+b_bg_percent+b_lc_percent+a_lc_percent+b_pdc_percent+a_pdc_percent;
                 if($('#b_cash').prop('checked')  || $('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')){
                    if($('#b_cash').prop('checked') && b_cash_percent==''){
                        $('#a_bg').prop('checked',false);
                    }else if($('#a_cash').prop('checked') && a_cash_percent==''){
                        $('#a_bg').prop('checked',false);
                    }else if($('#b_bg').prop('checked') && b_bg_percent==''){
                        $('#a_bg').prop('checked',false);
                    }else if($('#b_lc').prop('checked') && b_lc_percent==''){
                        $('#a_bg').prop('checked',false);
                    }else if($('#a_lc').prop('checked') && a_lc_percent==''){
                        $('#a_bg').prop('checked',false);
                    }else if($('#b_pdc').prop('checked') && b_pdc_percent==''){
                        $('#a_bg').prop('checked',false);
                    }else if($('#a_pdc').prop('checked') && a_pdc_percent==''){
                        $('#a_bg').prop('checked',false);
                    }else{
                        
                        if(total_percent<100){
                            $('#a_bg_tenor').prop('readonly',false);
                            $('#a_bg_percent').prop('readonly',false);
                            $('#a_bg_tenor').prop('required',true);
                            $('#a_bg_percent').prop('required',true);
                            
                            $('#a_bg_amount').prop('readonly',false);   
                            $('#a_bg_amount').prop('required',true);
                        }else{
                           $('#a_bg').prop('checked',false); 
                        }
                    }
                    
                }else{
                    if(total_percent<100){ 
                        $('#a_bg_tenor').prop('readonly',false);
                        $('#a_bg_percent').prop('readonly',false);
                        $('#a_bg_tenor').prop('required',true);
                        $('#a_bg_percent').prop('required',true);
                        
                        $('#a_bg_amount').prop('readonly',false);   
                        $('#a_bg_amount').prop('required',true);
                    }else{
                       $('#a_bg').prop('checked',false); 
                    }
                }
               
            }else{
                var b_cash_amount=$('#b_cash_amount').val();
                var a_cash_amount=$('#a_cash_amount').val();
                var b_bg_amount=$('#b_bg_amount').val();
                var a_bg_amount=$('#a_bg_amount').val();
                var b_lc_amount=$('#b_lc_amount').val();
                var a_lc_amount=$('#a_lc_amount').val();
                var b_pdc_amount=$('#b_pdc_amount').val();
                var a_pdc_amount=$('#a_pdc_amount').val();
               
                var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
                if(total_amount>0){
                    var net_total=Number($('#sub_total').val())-total_amount;
                }else{
                    var net_total=Number($('#sub_total').val());
                }
                $('#balance').html(net_total);
                $('#a_bg_amount').val('');
                $('#a_bg_tenor').val('');
                $('#a_bg_percent').val('');
                
                $('#a_bg_tenor').prop('readonly',true);
                $('#a_bg_percent').prop('readonly',true);
                $('#a_bg_tenor').prop('required',false);
                $('#a_bg_percent').prop('required',false);
                
                $('#a_bg_amount').prop('readonly',true);   
                $('#a_bg_amount').prop('required',false);
            }
            }else{
               $('#a_bg').prop('checked',false);
               alert('Please select product first'); 
            }
        }else if(paymode=="b_lc"){
            if(subtotal>0){
                if($('#b_lc').prop('checked')){
                
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                
                
                var total_percent=b_cash_percent+a_cash_percent+b_bg_percent+a_bg_percent+a_lc_percent+b_pdc_percent+a_pdc_percent;
                if($('#b_cash').prop('checked')  || $('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')){
                    if($('#b_cash').prop('checked') && b_cash_percent==''){
                        $('#b_lc').prop('checked',false);
                    }else if($('#a_cash').prop('checked') && a_cash_percent==''){
                        $('#b_lc').prop('checked',false);
                    }else if($('#b_bg').prop('checked') && b_bg_percent==''){
                        $('#b_lc').prop('checked',false);
                    }else if($('#a_bg').prop('checked') && a_bg_percent==''){
                        $('#b_lc').prop('checked',false);
                    }else if($('#a_lc').prop('checked') && a_lc_percent==''){
                        $('#b_lc').prop('checked',false);
                    }else if($('#b_pdc').prop('checked') && b_pdc_percent==''){
                        $('#b_lc').prop('checked',false);
                    }else if($('#a_pdc').prop('checked') && a_pdc_percent==''){
                        $('#b_lc').prop('checked',false);
                    }else{
                        
                        if(total_percent<100){
                            $('#b_lc_tenor').prop('readonly',false);
                            $('#b_lc_percent').prop('readonly',false);
                            $('#b_lc_tenor').prop('required',true);
                            $('#b_lc_percent').prop('required',true);
                            
                            $('#b_lc_amount').prop('readonly',false);   
                            $('#b_lc_amount').prop('required',true);
                        }else{
                           $('#b_lc').prop('checked',false); 
                        }
                    }
                    
                }else{
                    if(total_percent<100){ 
                        $('#b_lc_tenor').prop('readonly',false);
                        $('#b_lc_percent').prop('readonly',false);
                        $('#b_lc_tenor').prop('required',true);
                        $('#b_lc_percent').prop('required',true);
                        
                        $('#b_lc_amount').prop('readonly',false);   
                        $('#b_lc_amount').prop('required',true);
                    }else{
                        $('#b_lc').prop('checked',false);
                    }
                } 
            }else{
                var b_cash_amount=$('#b_cash_amount').val();
                var a_cash_amount=$('#a_cash_amount').val();
                var b_bg_amount=$('#b_bg_amount').val();
                var a_bg_amount=$('#a_bg_amount').val();
                var b_lc_amount=$('#b_lc_amount').val();
                var a_lc_amount=$('#a_lc_amount').val();
                var b_pdc_amount=$('#b_pdc_amount').val();
                var a_pdc_amount=$('#a_pdc_amount').val();
               
                var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
                if(total_amount>0){
                    var net_total=Number($('#sub_total').val())-total_amount;
                }else{
                    var net_total=Number($('#sub_total').val());
                }
                
                $('#balance').html(net_total);
                $('#b_lc_amount').val('');
                $('#b_lc_tenor').val('');
                $('#b_lc_percent').val('');
                
                $('#b_lc_tenor').prop('readonly',true);
                $('#b_lc_percent').prop('readonly',true);
                $('#b_lc_tenor').prop('required',false);
                $('#b_lc_percent').prop('required',false);
                
                $('#b_lc_amount').prop('readonly',true);   
                $('#b_lc_amount').prop('required',false);
            }
            }else{
                $('#b_lc').prop('checked',false);
                alert('Please select product first'); 
            }
        }else if(paymode=="a_lc"){
            if(subtotal>0){
                if($('#a_lc').prop('checked')){
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                    
                    
                    
                    
                    
                    var total_percent=b_cash_percent+a_cash_percent+b_bg_percent+a_bg_percent+b_lc_percent+b_pdc_percent+a_pdc_percent;
                    if($('#b_cash').prop('checked')  || $('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')){
                        if($('#b_cash').prop('checked') && b_cash_percent==''){
                            $('#a_lc').prop('checked',false);
                        }else if($('#a_cash').prop('checked') && a_cash_percent==''){
                            $('#a_lc').prop('checked',false);
                        }else if($('#b_bg').prop('checked') && b_bg_percent==''){
                            $('#a_lc').prop('checked',false);
                        }else if($('#a_bg').prop('checked') && a_bg_percent==''){
                            $('#a_lc').prop('checked',false);
                        }else if($('#b_lc').prop('checked') && b_lc_percent==''){
                            $('#a_lc').prop('checked',false);
                        }else if($('#b_pdc').prop('checked') && b_pdc_percent==''){
                            $('#a_lc').prop('checked',false);
                        }else if($('#a_pdc').prop('checked') && a_pdc_percent==''){
                            $('#a_lc').prop('checked',false);
                        }else{

                            if(total_percent<100){
                                $('#a_lc_tenor').prop('readonly',false);
                                $('#a_lc_percent').prop('readonly',false);
                                $('#a_lc_tenor').prop('required',true);
                                $('#a_lc_percent').prop('required',true);
                                
                                $('#a_lc_amount').prop('readonly',false);   
                                $('#a_lc_amount').prop('required',true);
                            }else{
                               $('#a_lc').prop('checked',false); 
                            }
                        }

                    }else{
                        if(total_percent<100){ 
                            $('#a_lc_tenor').prop('readonly',false);
                            $('#a_lc_percent').prop('readonly',false);
                            $('#a_lc_tenor').prop('required',true);
                            $('#a_lc_percent').prop('required',true);
                            
                            $('#a_lc_amount').prop('readonly',false);   
                            $('#a_lc_amount').prop('required',true);
                        }else{
                            $('#a_lc').prop('checked',false);
                        }
                    }

                }else{
                    var b_cash_amount=$('#b_cash_amount').val();
                    var a_cash_amount=$('#a_cash_amount').val();
                    var b_bg_amount=$('#b_bg_amount').val();
                    var a_bg_amount=$('#a_bg_amount').val();
                    var b_lc_amount=$('#b_lc_amount').val();
                    var a_lc_amount=$('#a_lc_amount').val();
                    var b_pdc_amount=$('#b_pdc_amount').val();
                    var a_pdc_amount=$('#a_pdc_amount').val();

                    var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
                    if(total_amount>0){
                        var net_total=Number($('#sub_total').val())-total_amount;
                    }else{
                        var net_total=Number($('#sub_total').val());
                    }

                    $('#balance').html(net_total);
                    $('#a_lc_amount').val('');
                    $('#a_lc_tenor').val('');
                    $('#a_lc_percent').val('');

                    $('#a_lc_tenor').prop('readonly',true);
                    $('#a_lc_percent').prop('readonly',true); 
                    $('#a_lc_tenor').prop('required',false);
                    $('#a_lc_percent').prop('required',false);
                    
                    $('#a_lc_amount').prop('readonly',true);   
                    $('#a_lc_amount').prop('required',false);
                }
            }else{
                $('#a_lc').prop('checked',false);
                alert('Please select product first'); 
            }
        }else if(paymode=="b_pdc"){
             if(subtotal>0){
                if($('#b_pdc').prop('checked')){
                
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                
                
                
                
                
                var total_percent=b_cash_percent+a_cash_percent+b_bg_percent+a_bg_percent+b_lc_percent+a_lc_percent+a_pdc_percent;
                if($('#b_cash').prop('checked')  || $('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#a_pdc').prop('checked')){
                    if($('#b_cash').prop('checked') && b_cash_percent==''){
                        $('#b_pdc').prop('checked',false);
                    }else if($('#a_cash').prop('checked') && a_cash_percent==''){
                        $('#b_pdc').prop('checked',false);
                    }else if($('#b_bg').prop('checked') && b_bg_percent==''){
                        $('#b_pdc').prop('checked',false);
                    }else if($('#a_bg').prop('checked') && a_bg_percent==''){
                        $('#b_pdc').prop('checked',false);
                    }else if($('#b_lc').prop('checked') && b_lc_percent==''){
                        $('#b_pdc').prop('checked',false);
                    }else if($('#a_lc').prop('checked') && a_lc_percent==''){
                        $('#b_pdc').prop('checked',false);
                    }else if($('#a_pdc').prop('checked') && a_pdc_percent==''){
                        $('#b_pdc').prop('checked',false);
                    }else{
                        
                        if(total_percent<100){
                            $('#b_pdc_check').prop('readonly',false);
                            $('#b_pdc_percent').prop('readonly',false);
                            $('#b_pdc_check').prop('required',true);
                            $('#b_pdc_percent').prop('required',true);
                            
                            $('#b_pdc_amount').prop('readonly',false);   
                            $('#b_pdc_amount').prop('required',true);
                        }else{
                           $('#b_pdc').prop('checked',false); 
                        }
                    }
                    
                }else{
                    if(total_percent<100){  
                        $('#b_pdc_check').prop('readonly',false);
                        $('#b_pdc_percent').prop('readonly',false);
                        $('#b_pdc_check').prop('required',true);
                        $('#b_pdc_percent').prop('required',true);
                        
                        $('#b_pdc_amount').prop('readonly',false);   
                        $('#b_pdc_amount').prop('required',true);
                    }else{
                       $('#b_pdc').prop('checked',false); 
                    }
                }
               
            }else{
                var b_cash_amount=$('#b_cash_amount').val();
                var a_cash_amount=$('#a_cash_amount').val();
                var b_bg_amount=$('#b_bg_amount').val();
                var a_bg_amount=$('#a_bg_amount').val();
                var b_lc_amount=$('#b_lc_amount').val();
                var a_lc_amount=$('#a_lc_amount').val();
                var b_pdc_amount=$('#b_pdc_amount').val();
                var a_pdc_amount=$('#a_pdc_amount').val();
               
                var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(a_pdc_amount);
                if(total_amount>0){
                    var net_total=Number($('#sub_total').val())-total_amount;
                }else{
                    var net_total=Number($('#sub_total').val());
                }
               
                $('#balance').html(net_total);
                $('#b_pdc_amount').val('');
                $('#b_pdc_check').val('');
                $('#b_pdc_percent').val('');
                
                $('#b_pdc_check').prop('readonly',true);
                $('#b_pdc_percent').prop('readonly',true);
                $('#b_pdc_check').prop('required',false);
                $('#b_pdc_percent').prop('required',false);
                
                $('#b_pdc_amount').prop('readonly',true);   
                $('#b_pdc_amount').prop('required',false);
            }
             }else{
                $('#b_pdc').prop('checked',false);
                alert('Please select product first'); 
            }
        }else if(paymode=="a_pdc"){
             if(subtotal>0){
                if($('#a_pdc').prop('checked')){
               
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                
                
                
                
                
                
                var total_percent=b_cash_percent+a_cash_percent+b_bg_percent+a_bg_percent+b_lc_percent+a_lc_percent+b_pdc_percent;
                if($('#b_cash').prop('checked')  || $('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked')){
                    if($('#b_cash').prop('checked') && b_cash_percent==''){
                        $('#a_pdc').prop('checked',false);
                    }else if($('#a_cash').prop('checked') && a_cash_percent==''){
                        $('#a_pdc').prop('checked',false);
                    }else if($('#b_bg').prop('checked') && b_bg_percent==''){
                        $('#a_pdc').prop('checked',false);
                    }else if($('#a_bg').prop('checked') && a_bg_percent==''){
                        $('#a_pdc').prop('checked',false);
                    }else if($('#b_lc').prop('checked') && b_lc_percent==''){
                        $('#a_pdc').prop('checked',false);
                    }else if($('#a_lc').prop('checked') && a_lc_percent==''){
                        $('#a_pdc').prop('checked',false);
                    }else if($('#b_pdc').prop('checked') && b_pdc_percent==''){
                        $('#a_pdc').prop('checked',false);
                    }else{
                        
                        if(total_percent<100){
                             $('#a_pdc_check').prop('readonly',false);
                             $('#a_pdc_percent').prop('readonly',false);
                             $('#a_pdc_check').prop('required',true);
                             $('#a_pdc_percent').prop('required',true);
                             
                             $('#a_pdc_amount').prop('readonly',false);   
                             $('#a_pdc_amount').prop('required',true);
                        }else{
                           $('#a_pdc').prop('checked',false); 
                        }
                    }
                    
                }else{
                    if(total_percent<100){   
                        $('#a_pdc_check').prop('readonly',false);
                        $('#a_pdc_percent').prop('readonly',false);
                        $('#a_pdc_check').prop('required',true);
                        $('#a_pdc_percent').prop('required',true);
                        
                        $('#a_pdc_amount').prop('readonly',false);   
                        $('#a_pdc_amount').prop('required',true);
                    }else{
                        $('#a_pdc').prop('checked',false);
                    }
                }
               
            }else{
                var b_cash_amount=$('#b_cash_amount').val();
                var a_cash_amount=$('#a_cash_amount').val();
                var b_bg_amount=$('#b_bg_amount').val();
                var a_bg_amount=$('#a_bg_amount').val();
                var b_lc_amount=$('#b_lc_amount').val();
                var a_lc_amount=$('#a_lc_amount').val();
                var b_pdc_amount=$('#b_pdc_amount').val();
                var a_pdc_amount=$('#a_pdc_amount').val();
               
                var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount);
                if(total_amount>0){
                    var net_total=Number($('#sub_total').val())-total_amount;
                }else{
                    var net_total=Number($('#sub_total').val());
                }
               
                $('#balance').html(net_total);
                $('#a_pdc_amount').val('');
                $('#a_pdc_check').val('');
                $('#a_pdc_percent').val('');
                
                $('#a_pdc_check').prop('readonly',true);
                $('#a_pdc_percent').prop('readonly',true);
                $('#a_pdc_check').prop('required',false);
                $('#a_pdc_percent').prop('required',false);
                
                $('#a_pdc_amount').prop('readonly',true);   
                $('#a_pdc_amount').prop('required',false);
            }
             }else{
                $('#a_pdc').prop('checked',false);
                alert('Please select product first'); 
            }
        }
        
    }
    
    
     function calculateAmountToPercent(id){
        var balance=Number($('#sub_total').val());
        if(id=='b_cash_amount'){
           
           
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
            
            if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#b_cash_percent').val('');
                $('#b_cash_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(b_cash_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#b_cash_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }    
        }else  if(id=='a_cash_amount'){
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#a_cash_percent').val('');
                $('#a_cash_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(a_cash_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#a_cash_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }    
        }else  if(id=='b_bg_amount'){
          
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#b_bg_percent').val('');
                $('#b_bg_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(b_bg_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#b_bg_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }    
        }else  if(id=='a_bg_amount'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#a_bg_percent').val('');
                $('#a_bg_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(a_bg_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#a_bg_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }    
        }else  if(id=='b_lc_amount'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#b_lc_percent').val('');
                $('#b_lc_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(b_lc_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#b_lc_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }    
        }else  if(id=='a_lc_amount'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#a_lc_percent').val('');
                $('#a_lc_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(a_lc_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#a_lc_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }      
        }else  if(id=='b_pdc_amount'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
           if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#b_pdc_percent').val('');
                $('#b_pdc_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(b_pdc_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#b_pdc_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }    
        }else  if(id=='a_pdc_amount'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
             if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#a_pdc_percent').val('');
                $('#a_pdc_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(a_pdc_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#a_pdc_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }    
        }
        
        
        
    }
    
   $('#m_specification').click(function () {
        var count = $('#material_count').val();
        var str= '<tr  id="row_' + (Number(count) + 1) + '">';
       
        str +='<td><input required  style="width:250px"  type="text"  name="material_name[]"  class="issue form-control"></td>';
        str +='<td><input required  style="width:350px"  type="text"  name="m_description[]"  class="issue form-control"></td>';
        str +='<td><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeMaterial(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>'; 
        str +='</tr>';      
        $('#material_count').val(Number(count) + 1);
        $('#specificationTable').append(str);
        
    });
    
     function removeMaterial(row) {
        var count = $('#material_count').val();
        $('#material_count').val(Number(count)-1);
        $('#row_' + row).remove();
       
    }   
   
</script>


