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

                        <form class="form-horizontal" action="<?php echo site_url('delivery_orders/add_delivery_order_action'); ?>" method="post" onsubmit="javascript: return validation()">
        
        
                            
                             <div class='form-group' style="margin-bottom:15px;" >
                                <label for="title" class="col-sm-2 control-label">
                                     Select customer<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  class="form-control e1" placeholder="Select Customer" id="customer_id" name="customer_id" onchange="javascript:project_info();" >
                                          <option value="" >Select customer</option>
                                        <?php foreach($customers as $customer){ ?>
                                           <option <?php //if($customer_id==$customer['id']) echo 'selected'; ?>  value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option> 
                                        <?php } ?>    
                                         

                                     </select> 
                                    <span id="do_id_error" style="color:red"></span>
                                </div>
                                 <!--
                                 <div class="col-sm-2 input-group">
                                     <a class="btn btn-primary" onclick="javascript:customerBillAndCollectionInfo();">Bill and Collection Info</a>
                                 </div>
                                 -->


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
                            
                            
                            
                            
                            
                            <div class='form-group' style="margin-bottom:30px;" >
                                <label for="title" class="col-sm-2 control-label">
                                    Sales Order<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-5 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select  id="o_id" class="form-control e1" name="o_id">
                            <option class="form-control" value="">Select Order</option>
                            <?php foreach($sale_orders as $order){ ?>
                                <option class="form-control" value="<?php echo $order['o_id'] ?>"><?php echo $order['c_short_name'].'('.$order['project_name'].')'.'('.$order['order_no'].')' ?></option>
                            <?php } ?>
                       </select>
                        <span id="o_id_error" style="color:red"></span>
                                </div>
                                

                            </div>
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Do. Number<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control" id="customer_id1" name="customer_id1" type="hidden" value="">
                                    <input class="form-control" id="d_code" name="d_code" type="hidden" value="">
                                    <input  class="form-control" readonly id="delivery_no" name="delivery_no" type="text" value="">
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
                                    Project Name<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  readonly class="form-control" id="project_name" name="project_name" type="text">
                               <span id="project_name_error" style="color:red"></span>
                                </div>
                                
                                <label for="title" class="col-sm-2 control-label">
                                    D. Time  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <input  class="form-control" id="delivery_time" name="delivery_time" type="text" placeholder="Delivery Time">
                                     <span id="delivery_time_error" style="color:red"></span>
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
                                    D. Email<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <input  class="form-control" id="shipping_email" name="shipping_email" type="text" placeholder="Delivery Email">
                        <span id="shipping_email_error" style="color:red"></span>
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
                            
                            

        
      
        
      
       
        <div class="separator-shadow"></div>
        <div class="row">
            <input type="hidden" value="1" id="count" />
                <table class="table table-bordered" >
                    <thead class="thead-color">
                     <tr >
                         <th>Product Name <sup style='color:red'>*</sup></th>
                         <th>Sales Order Qty</th>     
                         <th>Delivery Order Quantity</th>               
                         <th>Mu</th>
                         <th>Remark</th>

                      </tr>
                    </thead>
                    <tbody id="delivery_items">

                      
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
                                            <th>Product Name </th>
                                            <th>Total Sales Order Qty</th>
                                            <th>Total Delivery Ordered Qty</th>              
                                            <th>Due Qty</th>
                                            <th>Mu</th>
                                            


                                        </tr>
                                    </thead>
                                    <tbody id="order_items">


                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>




     </div>
        
        
       <div class="separator-shadow"></div>   

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 style="text-align:center;" class="panel-title">Payment condition and status</h3>
                                            
                                        </div>
                                        <div class="panel-body">
                                            <div class="main-details" style="display:none;">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <table class="table table-striped responsive">
                                                        <thead class="thead-color">
                                                            <tr >
                                                                <th colspan="4" style="text-align: center;">Before Delivery</th>
                                                                <th colspan="4" style="text-align: center;">After Delivery</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Payment Mode</th>
                                                                <th>Tenor Day</th>
                                                                <th>Percent</th>
                                                                <th>Amount</th>
                                                                <th>Payment Mode</th>
                                                                <th>Tenor Day</th>
                                                                <th>Percent</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        </thead> 
                                                        <tbody id="paymentConditionBody">

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-4">
                                                    <table class="table table-striped responsive">
                                                        <thead class="thead-color">

                                                            <tr>
                                                                <th style="text-align: center;">Payment Mode</th>
                                                              <!--  <th>Amount</th>-->
                                                                <th style="text-align: center;">Receive Amount</th>
                                                              <!--  <th>Due</th> -->

                                                            </tr>
                                                        </thead> 
                                                        <tbody id="paymentBalanceBody">

                                                        </tbody>
                                                    </table>
                                                </div>







                                            </div> 

                                        </div>
                                    </div>
                                    </div>
        
       
        
        <div class="row">
            <div class="col-md-2">
                <a href="<?php echo site_url('backend/delivery_orders') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px">GO BACK</button> </a>
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
        var o_id=$('#o_id').val();
      
        var project_name=$('#project_name').val();
        var attention=$('#attention').val();
        var phone=$('#phone').val();
        var billing_address=$('#billing_address').val();
        var billing_email=$('#billing_email').val();
        var shipping_address=$('#shipping_address').val();
        var shipping_email=$('#shipping_email').val();
        
        var error=false;
        
        if(delivery_order_date==''){
            $('#delivery_order_date').css('border','1px solid red');
            $('#delivery_order_date_error').html('Please fill date field');
            error=true;
           
        }else{
            $('#delivery_order_date').css('border','1px solid #ccc');
            $('#delivery_order_date_error').html('');
            
        }
        if(o_id==''){
            $('#o_id_error').html('Please select quotation');
            $('#o_id').css('border','1px solid red');
             error=true;
        }else{
            $('#o_id_error').html('');
            $('#o_id').css('border','1px solid #ccc');   
            
        }
      
         if(project_name==''){
            $('#project_name_error').html('Please fill  project name field');
            $('#project_name').css('border','1px solid red'); 
            error=true;
        }else{
            $('#project_name_error').html('');
            $('#project_name').css('border','1px solid #ccc');   
             
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
        
        if(shipping_email==''){
//            $('#shipping_email_error').html('Please fill delivery email field');
//            $('#shipping_email').css('border','1px solid red'); 
//            error=true;
        }else{
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(shipping_email)) {
                $('#shipping_email_error').html('Invalid email address');
                $('#shipping_email').css('border','1px solid red');  
                error=true;
                $('#shipping_email').focus();
            }else{
               $('#shipping_email_error').html('');
               $('#shipping_email').css('border','1px solid #ccc');  
            } 
             
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

