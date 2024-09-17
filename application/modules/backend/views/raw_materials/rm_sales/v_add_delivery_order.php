<style type="text/css">
    .form-control{
        height:30px;
    }
    table tr td, table tr th{
        text-align: center;
        vertical-align: middle;
           
    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
   
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Delivery Order</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal" action="<?php echo site_url('raw_materials/rm_sales/add_delivery_order_action'); ?>" method="post" onsubmit="javascript: return validation()">
        
        
                            
                             <div class='form-group' style="margin-bottom:15px;" >
                                <label for="title" class="col-sm-2 control-label">
                                     Select customer<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select required class="form-control e1" placeholder="Select Customer" id="customer_id" name="customer_id"  >
                                          <option value="" >Select customer</option>
                                        <?php foreach($customers as $customer){ ?>
                                           <option <?php //if($customer_id==$customer['id']) echo 'selected'; ?>  value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option> 
                                        <?php } ?>    
                                         

                                     </select> 
                                    <span id="do_id_error" style="color:red"></span>
                                </div>
                                
                                 


                            </div>
                            
                            
                            
                            
                            
                            
                            
                            
                           
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    LC<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select required id="lc_id" class="form-control e1" name="lc_id" onchange="javascript:getLcDetails();">
                                        <option class="form-control" value="">Select LC</option>
                                        <?php foreach($lcs as $lc){ ?>
                                            <option class="form-control" value="<?php echo $lc['lc_id']; ?>"><?php echo $lc['SUP_NAME'].'('.$lc['lc_no'].')'; ?></option>
                                        <?php } ?>    


                                   </select>
                                    <span id="category_id_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   D.Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control datepicker" id="delivery_order_date" name="delivery_order_date" type="text" value="<?php echo date('d-m-Y') ?>">
                                    <span id="delivery_order_date_error" style="color:red"></span>
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
                                    Contact No<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                    <input  class="form-control" id="contact_no" name="contact_no" type="text" placeholder="Contact No">
                                <span id="contact_no" style="color:red"></span>
                        
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
                                    B. Email  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <input  class="form-control" id="billing_email" name="billing_email" type="text" placeholder="Billing Email">
                        <span id="billing_email_error" style="color:red"></span>
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
                                    D. Address<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control" id="shipping_address" name="shipping_address" type="text" placeholder="Delivery Address">
                        <span id="shipping_address_error" style="color:red"></span>
                                </div>
                                 
                                <label for="title" class="col-sm-2 control-label">
                                          Location<sup style="color:red">*</sup> :
                                       </label> 
                                        <div class="col-sm-4 input-group">
                                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                  <select required  id="do_location" class="form-control" name="do_location">
                                                      <option value="">Select</option>
                                                      
                                                      <option value="Hook">Hook</option>
                                                      <option value="Yard">Yard</option>
                                                  </select>
                                        </div>

                            </div>
                            
                            
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Special Note  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <!--  <input  class="form-control" id="special_note" name="special_note" type="text" placeholder="Special Note">-->
                                    <textarea  rowspan="7" class="form-control" id="special_note" name="special_note"  placeholder="Special Note"></textarea>  
                                </div>
                                
                                
                                 <label for="title" class="col-sm-2 control-label">
                                    Remark  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <!--  <input  class="form-control" id="special_note" name="special_note" type="text" placeholder="Special Note">-->
                                    <textarea  rowspan="7" class="form-control" id="special_note" name="do_remark"  placeholder="Remark"></textarea>  
                                </div>
                                

                            </div>
                            
                            
                             
                                    <div class='form-group' >
                                      


                                  
                                
                                    
                                   


                                   </div>
                       
        
      
        
      
       
        <div class="separator-shadow"></div>
        <div class="row">
            <input type="hidden" value="1" id="count" />
                <table class="table table-bordered" >
                    <thead class="thead-color">
                        <thead class="thead-color">
                                    <tr>
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Item Name</th>
                                        <th style="vertical-align: middle;text-align: center;">Origin</th>
                                        <th style="vertical-align: middle;text-align: center;">Grade</th>
                                       
                                        <th style="vertical-align: middle;text-align: center;">MU.</th>
                                        <th style="vertical-align: middle;text-align: center;">Stock Qty<sup style="color:red;"></sup></th>
                                        <th style="vertical-align: middle;text-align: center;">Do. Qty<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;text-align: center;">B.Price<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;text-align: center;">Commission<sup style="color:red;"></sup></th>
                                        <th style="vertical-align: middle;text-align: center;">T.Cost<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;text-align: center;">Price<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;text-align: center;">Total</th>
                                        <th>Select</th>


                                    </tr>
                                </thead>
                                <tbody id="mytableBody">
                                    
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
        
        
       <div id="specification_raw_material">
            <div class="row">
                  
            <input type="hidden" value="1" id="material_count">
                <table class="table table-bordered" id="specificationTable">
                    <thead>
                     <tr >
                        
                         <th>Term or Condition Name</th>
                         <th>Description</th>
                         <th><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="m_specification"  class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span></button></th>
                      </tr>
                    </thead>
                    <tbody id="material_specification">
                            
                      
                    </tbody>
                     
                  </table>
             
        </div> 
        </div> 
        
       
        
        <div class="row">
            <div class="col-md-2">
                <a href="<?php echo site_url('raw_materials/rm_sales') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px">GO BACK</button> </a>
            </div>
            
            <div class="col-md-2 ">
                <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">SAVE</button>
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
    
    
    $('#m_specification').click(function () {
        var count = $('#material_count').val();
        var str= '<tr  id="term_row_' + (Number(count) + 1) + '">';
        
        str +='<td><input required  style="width:200px"  type="text"  name="name[]"  class="issue form-control"></td>';
        str +='<td><textarea required  style="width:700px" name="description[]"  class="issue form-control"></textarea></td>';
        str +='<td><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeTerms(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>'; 
        str +='</tr>';      
        $('#material_count').val(Number(count) + 1);
        $('#specificationTable').append(str);
        
    });
    
    function removeTerms(row) {
        var count = $('#material_count').val();
        $('#material_count').val(Number(count)-1);
        $('#term_row_' + row).remove();
       
    }
    
    
    
    
    $('#customer_id').change(function(){
        
        
        var customer_id=$('#customer_id').val();
        //alert(customer_id);
        if(customer_id!=''){
            
           
            
           
           

            $('#attention').val('');
           
            $('#phone').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            $('#contact_person').val('');
            $('#contact_no').val('');
            
           
            $('#delivery_order_date').val('');
            
            $('#special_note').val('');
            
           
            
           
            var data = {'customer_id': customer_id}
            $.ajax({
                    url: '<?php echo site_url('raw_materials/rm_sales/get_customer_info'); ?>',
                    data: data,
                    method: 'POST',
                    dataType: 'json',
                    success: function (msg) { 
                      
                        
                        $('#billing_address').val(msg.customer_info[0].c_contact_address);
                        $('#billing_email').val(msg.customer_info[0].head_office_email);
                        //$('#shipping_address').val(msg.customer_info[0].c_contact_address);
                        
                   
                        
                         
                                          

                    }

                })
        }else{
            
            
                                  
            $('#attention').val('');    
            $('#phone').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            
            
            $('#delivery_order_date').val('');
            
            $('#special_note').val('');
            
            $('#contact_person').val('');
            $('#contact_no').val('');
            
           
            
            
        }
    });
    
    
    
     function getLcDetails() {
        var lc_id=$('#lc_id').val();
        if(lc_id != ''){
            $.ajax({
                url: '<?php echo site_url('raw_materials/rm_sales/getLcLotDetails'); ?>',
                data: {
                    'lc_id': lc_id
                },
                method: 'POST',
                dataType: 'json',
                success: function(msg) {
                   // $('#lc_date').val(msg.lot_info[0].date);
                    var str='';
                   
                    $(msg.lc_details).each(function(i, v) {
                       
                        //var amount=v.price*v.qty;
                       
                        i++;
                        str +='<tr>';
                        
                        
                        
                        str +='<td>';
                        str +='<input style="width:100%;"  type="hidden" id="lc_details_id_'+i+'" name="lc_details_id[]" class="issue form-control" value="'+v.id+'">';
                        str +='<input style="width:100%;" readonly type="hidden" id="item_id_'+i+'" name="s_item_id[]" class="issue form-control" value="'+v.item_id+'">';
                        str +='<input style="width:100%;" readonly type="text" id="item_name_'+i+'" name="item_name[]" class="issue form-control" value="'+v.item_name+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="text" id="origin_'+i+'" name="origin[]" class="issue form-control" value="'+v.origin+'">';
                        str +='</td>';
                        
                        
                        str +='<td>';                
                        str +='<input style="width:100%;" readonly type="text" id="grade_'+i+'" name="grade[]" class="issue form-control" value="'+v.item_grade+'">';
                        str +='</td>';
                        
                        
                        
                        
                        
                        str +='<td>';                
                        str +='<input style="width:100%;" readonly type="text" id="mu_'+i+'" name="mu[]" class="issue form-control" value="'+v.meas_unit+'">';
                        str +='</td>';
                        
                        
                        str +='<td>';
                        str +='<input readonly style="width:100%;"  type="text"  id="stock_qty_'+i+'" name="stock_qty[]" class="issue form-control" value="'+v.remaining_qty+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input  style="width:100%;"  type="text" onchange="calculateTotal()" onkeyup="calculateTotal()" id="receive_qty_'+i+'" name="quantity[]" class="issue form-control" value="">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input  style="width:100%;"  type="text" onchange="calculatePrice()" onkeyup="calculatePrice()"  id="base_price_'+i+'" name="base_price[]" class="issue form-control" value="">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;"  type="text" onchange="calculatePrice()" onkeyup="calculatePrice()"  id="commission_'+i+'" name="commission[]" class="issue form-control" value="">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;"  type="text" onchange="calculatePrice()" onkeyup="calculatePrice()"  id="transport_cost_'+i+'" name="transport_cost[]" class="issue form-control" value="">';
                        str +='</td>';
                        
                        
                        
                        str +='<td>';
                        str +='<input readonly style="width:100%;"  type="text" onchange="calculateTotal()" onkeyup="calculateTotal()" id="price_'+i+'" name="unit_price[]" class="issue form-control" value="">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="text" id="amount_'+i+'" name="amount[]" class="issue form-control" value="">';
                        str +='</td>';
                        
                        str +='<td><input style="width:40px;text-align:right;"  type="checkbox" name="item_select[]" onclick="addRequiredProperty('+i+')"    id="select_product_'+i+'" class="select_product_'+i+'" value="'+i+'"></td>'; 
                        str +='</tr>';
                       
                      //  calculateTotal();
                        
                    })
                    
                    $('#mytableBody').html(str);
                    
                }
            })
        } else {
            $('#mytableBody').html('');
           // $('#lc_date').val('');
        }
    }  
      
     
    function addRequiredProperty(id){
        //alert(id);
        if($('#select_product_'+id).prop('checked')){
            $('#receive_qty_'+id).prop('required',true);
            $('#base_price_'+id).prop('required',true);
        }else{
            $('#receive_qty_'+id).prop('required',false);
            $('#base_price_'+id).prop('required',false);
        }    
    }
     
     
  function calculatePrice() {
        var total = 0;
        $('#mytableBody').find('tr').each(function(i, v) {
            var qty = Number($(this).find('td').eq('5').find('input').val());
           
            var base_price = Number($(this).find('td').eq('6').find('input').val());
            var commission = Number($(this).find('td').eq('7').find('input').val());
            var transport_cost = Number($(this).find('td').eq('8').find('input').val());
            var price=Number(base_price)+Number(commission)+Number(transport_cost);
            
            $(this).find('td').eq('9').find('input').val(price.toFixed(2));
            
            var tot = qty * price;
            $(this).find('td').eq('10').find('input').val(tot.toFixed(2));
            total += tot;
           // }
        })
        
       // $('#amount').val(total.toFixed(2))
    }    
      
        
   function calculateTotal() {
       //alert('test');
        var total = 0;
        $('#mytableBody').find('tr').each(function(i, v) {
            
            //if(i>0){
            var stock_qty = Number($(this).find('td').eq('4').find('input').val());
            var qty = Number($(this).find('td').eq('5').find('input').val());
            
            if(qty>stock_qty){
                //$(this).find('td').eq('5').find('input').val('');
                //qty=0;
            }  
            
           // alert(qty);
            var price = Number($(this).find('td').eq('9').find('input').val());
            
            var tot = qty * price;
            $(this).find('td').eq('10').find('input').val(tot.toFixed(2));
            total += tot;
           // }
        })
        
       // $('#amount').val(total.toFixed(2))
    }
    
    
    
    function customerBillAndCollectionInfo(){
        alert('test');
    }
    
     var datePickerOptions = {
                dateFormat: 'dd-mm-yy',
                firstDay: 1,
                changeMonth: true,
                changeYear: true,
                // ...
            }
    $('.datepicker').datepicker(datePickerOptions);
    
    
    
     function validation(){
        var delivery_order_date=$('#delivery_order_date').val();
        //var o_id=$('#o_id').val();
      
        //var project_name=$('#project_name').val();
        var attention=$('#attention').val();
        var phone=$('#phone').val();
        var billing_address=$('#billing_address').val();
        var billing_email=$('#billing_email').val();
        var shipping_address=$('#shipping_address').val();
       // var shipping_email=$('#shipping_email').val();
        
        var error=false;
        
        if(delivery_order_date==''){
            $('#delivery_order_date').css('border','1px solid red');
            $('#delivery_order_date_error').html('Please fill date field');
            error=true;
           
        }else{
            $('#delivery_order_date').css('border','1px solid #ccc');
            $('#delivery_order_date_error').html('');
            
        }
        
      
        
        
        if(attention==''){
            $('#attention_error').html('Please fill  attention field');
            $('#attention').css('border','1px solid red'); 
            error=true;
        }else{
            $('#attention_error').html('');
            $('#attention').css('border','1px solid #ccc');  
             
        }
        
        if(phone==''){
            $('#phone_error').html('Please fill phone number field');
            $('#phone').css('border','1px solid red'); 
             error=true;
        }else{
            $('#phone_error').html('');
            $('#phone').css('border','1px solid #ccc');  
             
        }
        
        if(billing_address==''){
//            $('#billing_address_error').html('Please fill billing address field');
//            $('#billing_address').css('border','1px solid red'); 
//            error=true;
        }else{
            $('#billing_address_error').html('');
            $('#billing_address').css('border','1px solid #ccc');  
             
        }
        
         if(billing_email==''){
//            $('#billing_email_error').html('Please fill billing email field');
//            $('#billing_email').css('border','1px solid red'); 
//             error=true;
        }else{
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(billing_email)) {
                $('#billing_email_error').html('Invalid email address');
                $('#billing_email').css('border','1px solid red');  
                error=true;
                $('#billing_email').focus();
            }else{
               $('#billing_email_error').html('');
               $('#billing_email').css('border','1px solid #ccc');  
            }
             
        }
        
        if(shipping_address==''){
            $('#shipping_address_error').html('Please fill delivery address field');
            $('#shipping_address').css('border','1px solid red'); 
            error=true;
        }else{
            $('#shipping_address_error').html('');
            $('#shipping_address').css('border','1px solid #ccc');  
             
        }
        
        
        
       
        
        if(error==true){
            return false;
        }
    }
    
 
    $('#o_id').change(function(){
        $('.main-details').show();
        var o_id=$('#o_id').val();
        if(o_id!=''){
            
            $('#paymentConditionBody').html('');
            $('#paymentBalanceBody').html('');
            
            $('#delivery_items tr').remove();
            $('#d_code').val('');
            $('#delivery_no').val('');
           // $('#customer_id').val('');  

            $('#attention').val('');
            $('#project_id').val('');
            $('#project_name').val('');
            $('#phone').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            $('#contact_person').val('');
            $('#contact_no').val('');
            
            $('#delivery_time').val('');
            $('#delivery_order_date').val('');
            
            $('#special_note').val('');
            
            $('#order_items tr').remove();
            $('#delivery_items tr').remove();
            
            var d = new Date();
            var n = d.getFullYear();
            var final = n.toString().substring(2);
            
            var data = {'o_id': o_id}
            $.ajax({
                    url: '<?php echo site_url('delivery_orders/get_sales_order_item'); ?>',
                    data: data,
                    method: 'POST',
                    dataType: 'json',
                    success: function (msg) { 
                       var branch=msg.branch_info[0].short_name;
                       
                        if(msg.order_code!=""){
                               var item_id=Number(msg.order_code[0].d_code)+1;
                         }else{
                              item_id=""; 
                         }

                        var item_sl_no;
                        if(item_id!=''){
                             if(item_id>999){
                               // item_sl_no=item_id;
                                item_sl_no=branch+'/DO/'+msg.sales_order_info[0].c_short_name+'/'+final+'/'+item_id;
                            }else if(item_id>99){
                                item_sl_no=branch+'/DO/'+msg.sales_order_info[0].c_short_name+'/'+final+'/'+"0"+item_id;
                            }else if(item_id>9){
                                item_sl_no=branch+'/DO/'+msg.sales_order_info[0].c_short_name+'/'+final+'/'+"00"+item_id;
                            }else{
                                item_sl_no=branch+'/DO/'+msg.sales_order_info[0].c_short_name+'/'+final+'/'+"000"+item_id;
                            }
                        }else{
                              item_id=1;
                          //  item_sl_no='DO/'+msg.sales_order_info[0].c_short_name+'/'+final+'/'+'0001';
                              item_sl_no=branch+'/DO/'+msg.sales_order_info[0].c_short_name+'/'+final+'/'+'0001';
                        }
                        
                        $('#d_code').val(item_id);
                        $('#delivery_no').val(item_sl_no);
                      //  $('#customer_id').val(msg.sales_order_info[0].id);  
                        $('#customer_id1').val(msg.sales_order_info[0].id);
                       
                        $('#attention').val(msg.sales_order_info[0].attention);
                        $('#project_name').val(msg.sales_order_info[0].project_name);
                        $('#project_id').val(msg.sales_order_info[0].project_id);
                        $('#phone').val(msg.sales_order_info[0].phone);
                        $('#billing_address').val(msg.sales_order_info[0].billing_address);
                        $('#billing_email').val(msg.sales_order_info[0].billing_email);
                        $('#shipping_address').val(msg.sales_order_info[0].shipping_address);
                        $('#shipping_email').val(msg.sales_order_info[0].shipping_email);
                        $('#delivery_time').val(msg.sales_order_info[0].delivery_time);
                        $('#delivery_order_date').val(msg.sales_order_info[0].delivery_date);
                        $('#special_note').val(msg.sales_order_info[0].special_note);
                        
                        $('#contact_person').val(msg.sales_order_info[0].contact_person);
                        $('#contact_no').val(msg.sales_order_info[0].contact_no);
                   
                        var str='';
                        var total=0;
                        var sstr='';

                         
                         $(msg.item_list).each(function (i, v) {
                             
                             if(v.do_qty!='' && v.do_qty!=null){
                                   var remain_qty=Number(v.quantity)-Number(v.do_qty);
                                   var do_qty=v.do_qty;
                                   
                                   
                             }else{
                                   var remain_qty=Number(v.quantity);
                                   var do_qty='';
                                   
                             }
                             var amount=(remain_qty*v.unit_price);
                                //   amount=amount.toFixed(2);
                           
                        //     total=total+Number(v.amount);
                            
                             total=total+amount;
                        
                             str+='<tr>';
                             str +='<td>';
                             str +='<input type="hidden"  name="o_details_id[]" id="item_des_c1_'+Number(i+1)+'" class="issue" value="'+v.o_details_id+'">';
                             str +='<input type="hidden"  name="s_item_id[]" id="item_des_c1_'+Number(i+1)+'" class="issue" value="'+v.product_id+'">';
                             str +='<input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_'+Number(i+1)+'" class="issue" value="'+v.product_name+'">';
                             str +='</td>';
                             str +='<td>';
                             str +='<input readonly  onkeyup="" onchange="" onblur=""  style="width:140px;text-align:right;"  type="text"  name="so_qty[]" id="so_quantity_'+Number(i+1)+'" class="issue number" value="'+remain_qty+'">';
                             str +='</td>';
                             str +='<td>';
                             str +='<input hidden  style="width:140px;text-align:right;"  type="text"  name="unit_price[]" id="unit_price_'+Number(i+1)+'" class="issue number" value="'+v.unit_price+'">';
                             str +='<input hidden  style="width:140px;text-align:right;"  type="text" class="amount_'+Number(i+1)+'" name="amount[]" id="amount_'+Number(i+1)+'" class="issue" value="'+amount+'">';
                             
                             str +='<input required  onkeyup="calculateSubtotal('+Number(i+1)+')" onchange="calculateSubtotal('+Number(i+1)+')" onblur="calculateSubtotal('+Number(i+1)+')"  style="width:140px;text-align:right;"  type="text"  name="quantity[]" id="quantity_'+Number(i+1)+'" class="issue number" value="'+remain_qty+'">';
                             str +='</td>';
                             str +='<td><input required readonly onkeyup="" onchange="" onblur=""  style="width:140px;text-align:left;"  type="text"  name="mu_name[]" id="mu_'+Number(i+1)+'" class="issue number" value="'+v.mu_name+'"></td>';
                             str +='<td><input style="width:140px;text-align:left;"  type="text"  name="remark[]" id="remark_'+Number(i+1)+'" class="form-control" value="'+v.remark+'"></td>';                     
                             str+='</tr>';
                             
                             
                             sstr+='<tr>';
                             sstr +='<td>';                   
                             sstr +='<input readonly style="width:140px;"  type="text"  name="sp_name[]" id="item_des_c1_'+Number(i+1)+'" class="issue" value="'+v.product_name+'">';
                             sstr +='</td>';
                             sstr +='<td>';
                             sstr +='<input readonly style="width:140px;text-align:right;"  type="text"  name="sor_qty[]" id="sor_quantity_'+Number(i+1)+'" class="issue number" value="'+v.quantity+'">';
                             sstr +='</td>';
                             sstr +='<td>';
                             sstr +='<input readonly style="width:140px;text-align:right;"  type="text"  name="dor_qty[]" id="dor_quantity_'+Number(i+1)+'" class="issue number" value="'+do_qty+'">'; 
                             sstr +='</td>';
                             sstr +='<td>';
                           
                             sstr +='<input readonly style="width:140px;text-align:right;"  type="text"  name="re_quantity[]" id="re_quantity_'+Number(i+1)+'" class="issue number" value="'+remain_qty+'">';
                             sstr +='</td>';
                             sstr +='<td><input  readonly onkeyup="" onchange="" onblur=""  style="width:140px;text-align:left;"  type="text"  name="smu_name[]" id="smu_'+Number(i+1)+'" class="issue number" value="'+v.mu_name+'"></td>';
                             
                             sstr+='</tr>'; 
                             
                             
                         });

                         $('#sub_total').val(total);       
                         $('#delivery_items').append(str);
                         $('#order_items').append(sstr);
                         
                         
                         
                       var tbl_row='';
                       if(msg.payment_mode[0].b_cash_percent>0 || msg.payment_mode[0].a_cash_percent>0){
                           tbl_row +='<tr>';
                           tbl_row +='<td>'+msg.payment_mode[0].b_cash+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_cash_tenor+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_cash_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_cash_amount+'</td>';
                           tbl_row +='<td>'+msg.payment_mode[0].a_cash+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_cash_tenor+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_cash_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_cash_amount+'</td>';
                           tbl_row +='</tr>';
                       }
                       if(msg.payment_mode[0].b_bg_percent>0 || msg.payment_mode[0].a_bg_percent>0){
                           tbl_row +='<tr>';
                           tbl_row +='<td>'+msg.payment_mode[0].b_bg+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_bg_tenor+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_bg_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_bg_amount+'</td>';
                           tbl_row +='<td>'+msg.payment_mode[0].a_bg+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_bg_tenor+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_bg_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_bg_amount+'</td>';
                           tbl_row +='</tr>';
                       }
                       
                       if(msg.payment_mode[0].b_lc_percent>0 || msg.payment_mode[0].a_lc_percent>0){
                           tbl_row +='<tr>';
                           tbl_row +='<td>'+msg.payment_mode[0].b_lc+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_lc_tenor+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_lc_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_lc_amount+'</td>';
                           tbl_row +='<td>'+msg.payment_mode[0].a_lc+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_lc_tenor+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_lc_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_lc_amount+'</td>';
                           tbl_row +='</tr>';
                      }
                      
                      if(msg.payment_mode[0].b_pdc_percent>0 || msg.payment_mode[0].a_pdc_percent>0){
                           tbl_row +='<tr>';
                           tbl_row +='<td>'+msg.payment_mode[0].b_pdc+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_pdc_check+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_pdc_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_pdc_amount+'</td>';
                           tbl_row +='<td>'+msg.payment_mode[0].a_pdc+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_pdc_check+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_pdc_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_pdc_amount+'</td>';
                           tbl_row +='</tr>';
                      }  
                      
                     tbl_row +='<tr>';
                     tbl_row +='<td><b>Total</b></td>';
                     tbl_row +='<td colspan="7" style="text-align:left;">'+msg.total_amount+'</td>';                   
                     tbl_row +='</tr>';
                     
                     tbl_row +='<tr>';
                     tbl_row +='<td><b>Recieved</b></td>';
                     tbl_row +='<td colspan="7" style="text-align:left;">'+msg.total_paid+'</td>';                   
                     tbl_row +='</tr>'; 
                     
                     tbl_row +='<tr>';
                     tbl_row +='<td><b>Collection(Not Realized)</b></td>';
                     if(msg.total_collection_amount!=null){
                      tbl_row +='<td colspan="7" style="text-align:left;">'+msg.total_collection_amount+'</td>';  
                     }else{
                          tbl_row +='<td colspan="7"></td>'; 
                     }    
                     tbl_row +='</tr>'; 
                      
                     tbl_row +='<tr>';
                     tbl_row +='<td><b>Due</b></td>';
                     tbl_row +='<td colspan="7" style="text-align:left;">'+msg.total_due+'</td>';                   
                     tbl_row +='</tr>'; 
                      
                      $('#paymentConditionBody').html(tbl_row);
                      
                      var tbl_row2 = '';
                        //Cash Start
                        tbl_row2 += '<tr>';
                        tbl_row2 += '<td style="">Cash</td>';
                        if (msg.paid_cash_amount[0].total == null || msg.paid_cash_amount[0].total == '') {
                            tbl_row2 += '<td style="text-align:right;">' + '' + '</td>';
                        } else {
                            tbl_row2 += '<td style="text-align:right;">' + msg.paid_cash_amount[0].total + '</td>';
                        }     
                        tbl_row2 += '</tr>';

                    //Pdc Start               
                        tbl_row2 += '<tr>';
                        tbl_row2 += '<td style="">Pdc</td>';
                        if (msg.paid_pdc_amount[0].total == null || msg.paid_pdc_amount[0].total == '') {
                            tbl_row2 += '<td style="text-align:right;">' + '' + '</td>';
                        } else {
                            tbl_row2 += '<td style="text-align:right;">' + msg.paid_pdc_amount[0].total + '</td>';
                        }                
                        tbl_row2 += '</tr>';

              

                        //Lc Start
                        
                        tbl_row2 += '<tr>';
                        tbl_row2 += '<td style="">Lc</td>';
                        if (msg.paid_lc_amount[0].total == null || msg.paid_lc_amount[0].total == '') {
                            tbl_row2 += '<td style="text-align:right;">' + '' + '</td>';
                        } else {
                            tbl_row2 += '<td style="text-align:right;">' + msg.paid_lc_amount[0].total + '</td>';
                        }                      
                        tbl_row2 += '</tr>';

                        //Bg Start
                   
                        tbl_row2 += '<tr>';
                        tbl_row2 += '<td style="">Bg</td>';
                        if (msg.paid_bg_amount[0].total == null || msg.paid_bg_amount[0].total == '') {
                            tbl_row2 += '<td style="text-align:right;">' + '' + '</td>';
                        } else {
                            tbl_row2 += '<td style="text-align:right;">' + msg.paid_bg_amount[0].total + '</td>';
                        }
                        tbl_row2 += '</tr>';
                      
                      $('#paymentBalanceBody').html(tbl_row2); 
                      
                      
                         
                         
                    

                    }

                })
        }else{
            $('#delivery_items tr').remove();
            $('#sub_total').val('');  
            
            $('#order_items tr').remove();
            
            $('#d_code').val('');
            $('#delivery_no').val('');
            $('#customer_id').val('');  
            
            $('#attention').val('');
            $('#project_name').val('');
            $('#project_id').val('');
            $('#phone').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            
            $('#delivery_time').val('');
            $('#delivery_order_date').val('');
            
            $('#special_note').val('');
            
            $('#contact_person').val('');
            $('#contact_no').val('');
            
            $('#paymentConditionBody').html('');
            $('#paymentBalanceBody').html('');
            
        }
    });
    
    
    function calculateSubtotal(id) {

        $('.number').on('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);
        });

        var so_quantity = Number($('#so_quantity_' + id).val());
        var sub_total = 0;
        var unit_price = $('#unit_price_' + id).val();
        var quantity = Number($('#quantity_' + id).val());
        var amount = Number(unit_price) * Number(quantity);

     


        var rowCount = $('#myTable tr').length;
        var table_row = Number(rowCount) - 2;

        if (quantity != '' || quantity != 0) {
            if (quantity <= so_quantity) {
                $('#amount_' + id).val(amount);

                for (var i = 1; i <= table_row; i++) {
                        var amt = $('.amount_' + i).val();
                        sub_total = sub_total + Number(amt);                 
               }

            } else {
                $('#amount_' + id).val('');
                $('#quantity_' + id).val('');
                for (var i = 1; i <= table_row; i++) {
                  
                        var amt = $('.amount_' + i).val();
                        sub_total = sub_total + Number(amt);
                    

                }
            }
        } else {
            $('#amount_' + id).val('');
            $('#quantity_' + id).val('');
            for (var i = 1; i <= table_row; i++) {          
                    var amt = $('.amount_' + i).val();
                    sub_total = sub_total + Number(amt);
                
            }
        }

        $('#sub_total').val(sub_total);



    }
    
    
    
    function project_info(){
               
            var customer_id=$('#customer_id').val();
            if(customer_id!=''){
                $.ajax({
                    type: "POST",
                    url: "backend/delivery_orders/project_info",
                    data: "customer_id="+customer_id,
                    dataType: "json",
                    success: function (data) {

                                 var str = '';
                                 str += '<option class="form-controll" value="">Select Project</option>';
                                 $(data.data).each(function (row, val) {
                                     str += '<option class="form-controll" value="' + val.project_id + '">' + val.project_name + '</option>';
                                 })
                                 $('#project_id').html(str);

                                 var str1='';
                                 str1 += '<option class="form-controll" value="">Select Sales Order</option>';
                                 $(data.order_info).each(function (row1, v) {
                                     str1 += '<option class="form-controll" value="' + v.o_id + '">' + v.order_no + '</option>';
                                 })
                                 $('#o_id').html(str1);
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

    function sales_order_info(){
               
                var project_id=$('#project_id').val();
            //    alert(project_id);
                if(project_id!=''){
                //    alert(project_id);
                    $.ajax({
                        type: "POST",
                        url: "backend/delivery_orders/salesOrderInfoProjectWise",
                        data: "project_id="+project_id,
                        dataType: "json",
                        success: function (data){
                            var str1='';
                            str1 += '<option class="form-controll" value="">Select Sales Order</option>';
                            $(data.order_info).each(function (row1, v) {
                                str1 += '<option class="form-controll" value="' + v.o_id + '">' + v.order_no + '</option>';
                            })
                            $('#o_id').html(str1);
                        }         
                    })
              }else{

                var str1;
                str1 += '<option class="form-controll" value="">Select Sales Order</option>';  
                $('#o_id').html(str1);  
              }  
      }
    
    
    
    
    
    
    
    
    
   
</script>

