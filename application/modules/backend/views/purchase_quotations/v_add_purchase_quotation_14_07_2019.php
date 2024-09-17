<?php

        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        
       
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Quotation</h3>
            </div>
        </div>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                      <form action="<?php echo site_url('purchase_quotations/add_quotation_action'); ?>" method="post" onsubmit="javascript: return validation()" >
                       <div class="row" style="margin-left:0px;margin-top:5px;"> 
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Q.No.:
                                </label> 
                    
                                <div class="col-sm-4 input-group">
                                       <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                       <input class="form-control" id="q_code" name="q_code" type="hidden" value="">
                                       <input readonly  class="form-control" id="reference_no" name="reference_no" type="text" value="">
                                </div>
                                    <label for="title" class="col-sm-2 control-label">
                                        Date <sup class="required">*</sup>
                               </label>
                              <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control datepicker" id="quotation_date" name="quotation_date" type="text" value="<?php echo date('d-m-Y') ?>">
                            </div>
                             
                         </div>
                       </div> 
                          
                     <div class="row" style="margin-left:0px;margin-top:5px;"> 
                          <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label">
                                        Project <sup class="required">*</sup>:
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                      <select  id="unit_id" class="form-control e1" name="unit_id">
                                                <option class="form-control" value="">Select Unit</option>
                                                <?php foreach($projects as $project){ ?>
                                                    <option class="form-control" value="<?php echo $project['d_id'] ?>"><?php echo $project['dep_description']; ?></option>
                                                <?php } ?>
                                    </select>
                        <span id="category_id_error" style="color:red"></span>
                                 </div>
                                 <label for="title" class="col-sm-2 control-label">
                                     Billing Address :
                                 </label>
                                <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                        <input  class="form-control" id="billing_address" name="billing_address" type="text" placeholder="Billing Address">
                                        <span id="billing_address_error" style="color:red"></span>
                               </div>
                             
                         </div>
                      </div>    
                       <div class="row" style="margin-left:0px;margin-top:5px;">     
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Billing Email :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="billing_email" name="billing_email" type="text" placeholder="Billing Email">
                                    <span id="billing_email_error" style="color:red"></span>

                                </div>
                             
                                <label for="title" class="col-sm-2 control-label">
                                    Delivery Address :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="shipping_address" name="shipping_address" type="text" placeholder="Delivery Address">
                                    <span id="shipping_address_error" style="color:red"></span>

                                </div>
                             
                         </div>
                       </div>   
                          
                     <div class="row" style="margin-left:0px;margin-top:5px;"> 
                         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Delivery Email :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="shipping_email" name="shipping_email" type="text" placeholder="Delivery Email">
                                    <span id="shipping_email_error" style="color:red"></span>

                                </div>
                             
                             <label for="title" class="col-sm-2 control-label">
                                    Supplier :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  id="supplier_id" class="form-control e1" name="supplier_id">
                                        <option class="form-control" value="">Select Supplier</option>
                                        <?php foreach($suppliers as $supplier){ ?>
                                            <option class="form-control" value="<?php echo $supplier['ID'] ?>"><?php echo $supplier['SUP_NAME'] ?></option>
                                        <?php } ?>
                                   </select>
                                    <span id="customer_id_error" style="color:red"></span>

                                </div>
                             
                         </div> 
                     </div>
                          
                      <div class="row" style="margin-left:0px;margin-top:5px;">      
                           <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Attention :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="attention" name="attention" type="text" placeholder="Attention Person Name">
                                    <span id="attention_error" style="color:red"></span>

                                </div>
                             
                             <label for="title" class="col-sm-2 control-label">
                                    Contact No. :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="phone" name="phone" type="text" placeholder="Phone">
                                    <span id="phone_error" style="color:red"></span>

                                </div>
                             
                         </div> 
                      </div>    
                    
                          
                <hr>
             
                    <div class="row">
                    <input type="hidden" value="1" id="count" />
                             <table class="table table-bordered" id="myTable">
                             <thead>
                             <tr>

                                 <th>Item Name <sup style='color:red'>*</sup></th>
                                 <th>M. Unit</th>
                                 <th>Qnty<sup style='color:red'>*</sup></th>
                                 <th>Unit Price<sup style='color:red'>*</sup></th>
                                 <th>Value<sup style='color:red'>*</sup></th>
                                 <th>Remark</th>

                                 <th>
                                     <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" id="button1" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                                 </th>
                              </tr>
                            </thead>
                            <tbody id="quotation_item">
                                <tr  id="row_1">

                                  <td> <select style="width:200px;" class="e1" style="width:100px;" id="item_1" name="item_id[]" onchange="javascript:item_info(1);">
                                            <option value="">Select Item</option>
                                            <?php foreach($items as $item){ ?>
                                                <option value="<?php echo $item['id'];  ?>"><?php if(!empty($item['item_code'])) echo $item['item_code']."(". $item['item_name'].")"; ?></option>
                                            <?php } ?>
                                     </select></td>
                                    <td><input style="width:80px;" disabled type="text"  name="item_name_description[]" id="m_unit_1" class="issue"></td>
                                    <td><input style="width:80px;"  type="text" onkeyup="calculateSubtotal(1)" onchange="calculateSubtotal(1)" onblur="calculateSubtotal(1)"  name="quantity[]" id="quantity_1" class="number issue"></td>
                                    <td><input style="width:80px;"  type="text" onkeyup="calculateSubtotal(1)" onchange="calculateSubtotal(1)" onblur="calculateSubtotal(1)"  name="unit_price[]" id="unit_price_1" class="number issue"></td>
                                    <td><input style="width:140px;"  type="text"  name="amount[]" id="amount_1" class="issue"></td>
                                    <td><input style="width:140px;"  type="text"  name="remark[]" id="unit_price_a1_1" class="issue"></td>
                                    <td></td>


                              </tr>

                            </tbody>
                               <tfoot>
                                    <tr>
                                        <td colspan="4" style="text-align:right;">Subtotal:</td>

                                        <td colspan="3"><input readonly style="width:140px;text-align: right;" id="sub_total"  name="total_amount" type="text"></td>
                                    </tr>
                                </tfoot>
                          </table>




                </div>
           
                
                <hr>
         <h2 style="text-align:center; ">Payment Conditions</h2>
        <button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="payment_hide_button"  class="btn btn-primary "><span class="glyphicon glyphicon-minus"></span></button>
        <button  type="button" style="display:none;padding-left:6px;padding-right:6px;font-size:8px;" id="payment_show_button"  class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span></button>
        <div id="payment_condition">
               
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-8   " style="text-align:center"><b><span style="color:green;padding:5px;">Before Delivery</span></b></div>
                           
                         <div class="col-sm-8 col-md-4 " style="text-align:center">
                                <input type="hidden" id="remaining_balance" value="" />
                                <b style="color:green">Balance:<span id="balance"></span></b>
                        </div>
                        </div>
                         <div class="form-group row">
                            <div class="col-sm-4 col-md-2   labeltext" style="">
                                <label for="b_cash"><input id="b_cash" onclick="enablePaymentCondition('b_cash')"  type="checkbox" name="b_cash" value="Cash">&nbsp;Cash</label>
                            </div>
                             <div class="col-sm-4 col-md-2 ">
                               <input readonly  style="text-align: right;" class="number form-control" id="b_cash_tenor" name="b_cash_tenor" type="text" placeholder="T. Day">
                            </div>
                            <div class="col-sm-4 col-md-2 ">
                               <input readonly style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('b_cash_percent')" onchange="calculatePercentAmount('b_cash_percent')" onblur="calculatePercentAmount('b_cash_percent')" id="b_cash_percent" name="b_cash_percent" type="text" placeholder="Percent">
                            </div>
                             <div class="col-sm-4 col-md-3 ">
                               <input readonly  style="text-align: right;" class="number form-control" id="b_cash_amount" name="b_cash_amount" type="text" placeholder="Amount">
                            </div>
                            
                        </div>
                         <div class="form-group row">
                            <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_bg"><input onclick="enablePaymentCondition('b_bg')"  id="b_bg"  type="checkbox" name="b_bg" value="Bg">&nbsp;BG</label></div>
                            <div class="col-sm-4 col-md-2 ">
                               <input readonly style="text-align: right;" class="number form-control" id="b_bg_tenor" name="b_bg_tenor" type="text" placeholder="T. Day">
                            </div>
                            <div class="col-sm-4 col-md-2 ">
                               <input readonly style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('b_bg_percent')" onchange="calculatePercentAmount('b_bg_percent')" onblur="calculatePercentAmount('b_bg_percent')" id="b_bg_percent" name="b_bg_percent" type="text" placeholder="Percent">
                            </div>
                             <div class="col-sm-4 col-md-3 ">
                               <input readonly style="text-align: right;" class="number form-control" id="b_bg_amount" name="b_bg_amount" type="text" placeholder="Amount">
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_lc"><input onclick="enablePaymentCondition('b_lc')"  id="b_lc" name="b_lc" type="checkbox" value="Lc">&nbsp;LC</label></div>
                            <div class="col-sm-4 col-md-2 ">
                               <input readonly style="text-align: right;" class="number form-control" id="b_lc_tenor" name="b_lc_tenor" type="text" placeholder="T.Day">
                            </div>
                             <div class="col-sm-4 col-md-2 ">
                               <input readonly style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('b_lc_percent')" onchange="calculatePercentAmount('b_lc_percent')" onblur="calculatePercentAmount('b_lc_percent')" id="b_lc_percent" name="b_lc_percent" type="text" placeholder="Percent">
                            </div>
                             <div class="col-sm-4 col-md-3 ">
                               <input readonly style="text-align: right;" class="number form-control" id="b_lc_amount" name="b_lc_amount" type="text" placeholder="Amount">
                            </div>
                            
                        </div>

                         <div class="form-group row">
                            <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_pdc"><input onclick="enablePaymentCondition('b_pdc')"  id="b_pdc" type="checkbox" name="b_pdc" value="Pdc">&nbsp;PDC</label></div>
                            <div class="col-sm-4 col-md-2 ">
                               <input readonly style="text-align: right;" class="number form-control"  id="b_pdc_check" name="b_pdc_check" type="text" placeholder="T.Ch.">
                            </div>
                            <div class="col-sm-4 col-md-2 ">
                               <input readonly style="text-align: right;"class="number form-control" onkeyup="calculatePercentAmount('b_pdc_percent')" onchange="calculatePercentAmount('b_pdc_percent')" onblur="calculatePercentAmount('b_pdc_percent')" id="b_pdc_percent" name="b_pdc_percent" type="text" placeholder="Percent">
                            </div>
                             <div class="col-sm-4 col-md-3 ">
                               <input readonly style="text-align: right;" class="form-control" id="b_pdc_amount" name="b_pdc_amount" type="text" placeholder="Amount">
                            </div>
                            
                        </div>

                    </div><!--End Col-md-6-->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-8" style="text-align:center"><b><span style="color:green;padding:5px;">After Delivery</span></b></div>
                            
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-2   labeltext" style=""><label for="a_cash"><input onclick="enablePaymentCondition('a_cash')"  id="a_cash" type="checkbox" name="a_cash" value="Cash">&nbsp;Cash</label></div>

                            <div class="col-sm-4 col-md-2 ">
                               <input readonly style="text-align: right;" class="number form-control" id="a_cash_tenor" name="a_cash_tenor" type="text" placeholder="T. Day">
                            </div>

                            <div class="col-sm-4 col-md-2 ">
                                <input readonly style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('a_cash_percent')" onchange="calculatePercentAmount('a_cash_percent')" onblur="calculatePercentAmount('a_cash_percent')" id="a_cash_percent" name="a_cash_percent" type="text" placeholder="Percent">
                            </div>

                             <div class="col-sm-4 col-md-3 ">
                               <input readonly style="text-align: right;" class="form-control"  id="a_cash_amount" name="a_cash_amount" type="text" placeholder="Amount">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4 col-md-2   labeltext" style=""><label for="a_bg"><input onclick="enablePaymentCondition('a_bg')" id="a_bg" type="checkbox" name="a_bg" value="Bg">&nbsp;BG</label></div>
                            <div class="col-sm-4 col-md-2 ">
                               <input readonly style="text-align: right;" class="number form-control" id="a_bg_tenor" name="a_bg_tenor" type="text" placeholder="T.Day">
                            </div>
                            <div class="col-sm-4 col-md-2 ">
                               <input readonly style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('a_bg_percent')" onchange="calculatePercentAmount('a_bg_percent')" onblur="calculatePercentAmount('a_bg_percent')" id="a_bg_percent" name="a_bg_percent" type="text" placeholder="Percent">
                            </div>
                             <div class="col-sm-4 col-md-3 ">
                               <input readonly style="text-align: right;" class="form-control" id="a_bg_amount" name="a_bg_amount" type="text" placeholder="Amount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-2 labeltext" style=""><label for="a_lc"><input onclick="enablePaymentCondition('a_lc')" id="a_lc" type="checkbox" name="a_lc" value="Lc">&nbsp;LC</label></div>
                            <div class="col-sm-4 col-md-2 ">
                               <input readonly style="text-align: right;" class="form-control number" id="a_lc_tenor" name="a_lc_tenor" type="text" placeholder="T.Day">
                            </div>
                             <div class="col-sm-4 col-md-2 ">
                               <input readonly style="text-align: right;" class="form-control number" onkeyup="calculatePercentAmount('a_lc_percent')" onchange="calculatePercentAmount('a_lc_percent')" onblur="calculatePercentAmount('a_lc_percent')" id="a_lc_percent" name="a_lc_percent" type="text" placeholder="Percent">
                            </div>
                             <div class="col-sm-4 col-md-3 ">
                               <input readonly style="text-align: right;" class="form-control number"  id="a_lc_amount" name="a_lc_amount" type="text" placeholder="Amount">
                            </div>
                        </div>


                         <div class="form-group row">
                            <div class="col-sm-4 col-md-2   labeltext" style=""><label for="a_pdc"><input onclick="enablePaymentCondition('a_pdc')" id="a_pdc" type="checkbox" name="a_pdc" value="Pdc">&nbsp;PDC</label></div>
                            <div class="col-sm-4 col-md-2 ">
                               <input readonly style="text-align: right;" class="form-control number"  id="a_pdc_check" name="a_pdc_check" type="text" placeholder="T.Ch.">
                            </div>
                            <div class="col-sm-4 col-md-2 ">
                               <input readonly style="text-align: right;" class="form-control number" onkeyup="calculatePercentAmount('a_pdc_percent')" onchange="calculatePercentAmount('a_pdc_percent')" onblur="calculatePercentAmount('a_pdc_percent')" id="a_pdc_percent" name="a_pdc_percent" type="text" placeholder="Percent">
                            </div>
                             <div class="col-sm-4 col-md-3 ">
                               <input readonly style="text-align: right;" class="form-control" id="a_pdc_amount" name="a_pdc_amount" type="text" placeholder="Amount">
                            </div>
                        </div>

                    </div><!--End Col-md-6-->

                </div>
        </div>  
        
        <hr>
                
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/purchase_quotations') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
                    
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">SAVE</button>
                    </div>
                  
                    
                </div>
            
                <div class="row">
               
                    
                </div>
            
            </form>  
                    </div>
                    </div>
                    </div>
                    </div>
          
            
        </div>
        </div>

<script type="text/javascript">
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
    
    
    
  //HIde Show End  
    
    function validation(){
        var quotation_date=$('#quotation_date').val();
        var category_id=$('#category_id').val();
        var customer_id=$('#customer_id').val();
        var project_name=$('#project_name').val();
        var attention=$('#attention').val();
        var phone=$('#phone').val();
        var billing_address=$('#billing_address').val();
        var billing_email=$('#billing_email').val();
        var shipping_address=$('#shipping_address').val();
        var shipping_email=$('#shipping_email').val();
        var thanks_employee_id=$('#thanks_employee_id').val();
        var followup_employee_id=$('#followup_employee_id').val();
        var error=false;
        
        if(quotation_date==''){
            $('#quotation_date').css('border','1px solid red');
            $('#quotation_date_error').html('Please fill date field');
            error=true;
            $('#quotation_date').focus();
        }else{
            $('#quotation_date').css('border','1px solid #ccc');
            $('#quotation_date_error').html('');
            
        }
        if(category_id==''){
            $('#category_id_error').html('Please select product type');
            $('#category_id').css('border','1px solid red');
            error=true;
            $('#category_id').focus();
        }else{
            $('#category_id_error').html('');
            $('#category_id').css('border','1px solid #ccc');   
            
        }
        
         if(customer_id==''){
            $('#customer_id_error').html('Please select customer');
            $('#customer_id').css('border','1px solid red');
            error=true;
            $('#customer_id').focus();
        }else{
            $('#customer_id_error').html('');
            $('#customer_id').css('border','1px solid #ccc');  
             
        }
        
         if(project_name==''){
            $('#project_name_error').html('Please fill  project name field');
            $('#project_name').css('border','1px solid red'); 
            error=true;
            $('#project_name').focus();
        }else{
            $('#project_name_error').html('');
            $('#project_name').css('border','1px solid #ccc');   
             
        }
        
        if(attention==''){
            $('#attention_error').html('Please fill  attention field');
            $('#attention').css('border','1px solid red'); 
            error=true;
            $('#attention').focus();
        }else{
            $('#attention_error').html('');
            $('#attention').css('border','1px solid #ccc');  
             
        }
        
        if(phone==''){
            $('#phone_error').html('Please fill phone number field');
            $('#phone').css('border','1px solid red'); 
            error=true;
            $('#phone').focus();
        }else{
            $('#phone_error').html('');
            $('#phone').css('border','1px solid #ccc');  
             
        }
        
        if(billing_address==''){
            $('#billing_address_error').html('Please fill billing address field');
            $('#billing_address').css('border','1px solid red'); 
            error=true;
            $('#billing_address').focus();
        }else{
            $('#billing_address_error').html('');
            $('#billing_address').css('border','1px solid #ccc');  
             
        }
        
         if(billing_email==''){
            $('#billing_email_error').html('Please fill billing email field');
            $('#billing_email').css('border','1px solid red'); 
            error=true;
            $('#billing_email').focus();
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
            $('#shipping_address').focus();
        }else{
            $('#shipping_address_error').html('');
            $('#shipping_address').css('border','1px solid #ccc');  
             
        }
        
        if(shipping_email==''){
            $('#shipping_email_error').html('Please fill delivery email field');
            $('#shipping_email').css('border','1px solid red'); 
            error=true;
            $('#shipping_email').focus();
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
        
        if(thanks_employee_id==''){
            $('#thanks_employee_id_error').html('Please select prepared  employee');
            $('#thanks_employee_id').css('border','1px solid red'); 
            error=true;
            $('#thanks_employee_id').focus();
        }else{
            $('#thanks_employee_id_error').html('');
            $('#thanks_employee_id').css('border','1px solid #ccc');  
             
        }
         if(followup_employee_id==''){
            $('#followup_employee_id_error').html('Please select followup employee');
            $('#followup_employee_id').css('border','1px solid red'); 
            error=true;
            $('#followup_employee_id').focus();
        }else{
            $('#followup_employee_id_error').html('');
            $('#thanks_employee_id').css('border','1px solid #ccc');  
             
        }
        
        if(error==true){
            return false;
        }
    }
    
    
    
    
    function enablePaymentCondition(paymode){
        var subtotal=$('#sub_total').val();
        if(paymode=="b_cash"){
            if(subtotal>0){
                if($('#b_cash').prop('checked')){
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    if($('#a_cash').prop('checked')  || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')){
                        if($('#a_cash').prop('checked') && a_cash_percent==''){
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
                    $('#b_cash_percent').prop('required',false);
                }
            }else{
                $('#b_cash').prop('checked',false);
                alert('Please select product first');
            }
        }else if(paymode=="a_cash"){
             if(subtotal>0){
                 if($('#a_cash').prop('checked')){
                var b_cash_percent=Number($('#b_cash_percent').val());
                var a_cash_percent=Number($('#a_cash_percent').val());
                var b_bg_percent=Number($('#b_bg_percent').val());
                var a_bg_percent=Number($('#a_bg_percent').val());
                var b_lc_percent=Number($('#b_lc_percent').val());
                var a_lc_percent=Number($('#a_lc_percent').val());
                var b_pdc_percent=Number($('#b_pdc_percent').val());
                var a_pdc_percent=Number($('#a_pdc_percent').val());
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
                        }else{
                           $('#a_cash').prop('checked',false); 
                        }
                    }
                    
                }else{
                        if(total_percent<100){
                           $('#a_cash_tenor').prop('readonly',false);
                           $('#a_cash_percent').prop('readonly',false);
                           $('#a_cash_percent').prop('required',true);
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
            }
             }else{
                 $('#a_cash').prop('checked',false);
                 alert('Please select product first');
             }
        }else if(paymode=="b_bg"){
            if(subtotal>0){
                if($('#b_bg').prop('checked')){
                var b_cash_percent=Number($('#b_cash_percent').val());
                var a_cash_percent=Number($('#a_cash_percent').val());
                var b_bg_percent=Number($('#b_bg_percent').val());
                var a_bg_percent=Number($('#a_bg_percent').val());
                var b_lc_percent=Number($('#b_lc_percent').val());
                var a_lc_percent=Number($('#a_lc_percent').val());
                var b_pdc_percent=Number($('#b_pdc_percent').val());
                var a_pdc_percent=Number($('#a_pdc_percent').val());
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
            }
            }else{
                $('#b_bg').prop('checked',false);
                alert('Please select product first');
            }
        }else if(paymode=="a_bg"){
            if(subtotal>0){
              if($('#a_bg').prop('checked')){
                var b_cash_percent=Number($('#b_cash_percent').val());
                var a_cash_percent=Number($('#a_cash_percent').val());
                var b_bg_percent=Number($('#b_bg_percent').val());
                var a_bg_percent=Number($('#a_bg_percent').val());
                var b_lc_percent=Number($('#b_lc_percent').val());
                var a_lc_percent=Number($('#a_lc_percent').val());
                var b_pdc_percent=Number($('#b_pdc_percent').val());
                var a_pdc_percent=Number($('#a_pdc_percent').val());
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
            }
            }else{
               $('#a_bg').prop('checked',false);
               alert('Please select product first'); 
            }
        }else if(paymode=="b_lc"){
            if(subtotal>0){
                if($('#b_lc').prop('checked')){
                var b_cash_percent=Number($('#b_cash_percent').val());
                var a_cash_percent=Number($('#a_cash_percent').val());
                var b_bg_percent=Number($('#b_bg_percent').val());
                var a_bg_percent=Number($('#a_bg_percent').val());
                var b_lc_percent=Number($('#b_lc_percent').val());
                var a_lc_percent=Number($('#a_lc_percent').val());
                var b_pdc_percent=Number($('#b_pdc_percent').val());
                var a_pdc_percent=Number($('#a_pdc_percent').val());
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
            }
            }else{
                $('#b_lc').prop('checked',false);
                alert('Please select product first'); 
            }
        }else if(paymode=="a_lc"){
            if(subtotal>0){
                if($('#a_lc').prop('checked')){
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
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
                }
            }else{
                $('#a_lc').prop('checked',false);
                alert('Please select product first'); 
            }
        }else if(paymode=="b_pdc"){
             if(subtotal>0){
                if($('#b_pdc').prop('checked')){
                var b_cash_percent=Number($('#b_cash_percent').val());
                var a_cash_percent=Number($('#a_cash_percent').val());
                var b_bg_percent=Number($('#b_bg_percent').val());
                var a_bg_percent=Number($('#a_bg_percent').val());
                var b_lc_percent=Number($('#b_lc_percent').val());
                var a_lc_percent=Number($('#a_lc_percent').val());
                var b_pdc_percent=Number($('#b_pdc_percent').val());
                var a_pdc_percent=Number($('#a_pdc_percent').val());
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
            }
             }else{
                $('#b_pdc').prop('checked',false);
                alert('Please select product first'); 
            }
        }else if(paymode=="a_pdc"){
             if(subtotal>0){
                if($('#a_pdc').prop('checked')){
                var b_cash_percent=Number($('#b_cash_percent').val());
                var a_cash_percent=Number($('#a_cash_percent').val());
                var b_bg_percent=Number($('#b_bg_percent').val());
                var a_bg_percent=Number($('#a_bg_percent').val());
                var b_lc_percent=Number($('#b_lc_percent').val());
                var a_lc_percent=Number($('#a_lc_percent').val());
                var b_pdc_percent=Number($('#b_pdc_percent').val());
                var a_pdc_percent=Number($('#a_pdc_percent').val());
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
            }
             }else{
                $('#a_pdc').prop('checked',false);
                alert('Please select product first'); 
            }
        }
        
    }
    
    
    
    $('#unit_id').change(function(){
        //var category_id = $('#category_id').val();
      
        var id = $('#unit_id').val();
        if(id!=''){
          //  $('#phone').val('');
         //   $('#project_name').val('');
            $('#billing_address').val('');
            $('#shipping_address').val('');
            $('#billing_email').val('');
            $('#shipping_email').val('');
        //    $('#attention').val('');
            $('#q_code').val('');
            $('#reference_no').val('');
            
            var d = new Date();
            var n = d.getFullYear();
            var final = n.toString().substring(2);
            
            var data = {'id': id}
            $.ajax({
                url: '<?php echo site_url('purchase_quotations/unit_info'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {  
                     if(msg.products!=''){
                            //$('#phone').val(msg.customer_info[0].c_mobile_no);
                           //$('#attention').val(msg.customer_info[0].c_contact_person);
                            $('#billing_address').val(msg.unit_info[0].address);
                            $('#shipping_address').val(msg.unit_info[0].address);
                            $('#billing_email').val(msg.unit_info[0].email);
                            $('#shipping_email').val(msg.unit_info[0].email);

                             if(msg.quotaion!=""){
                                    var q_no=Number(msg.quotaion[0].q_code)+1;
                              }else{
                                   q_no=""; 
                              }

                            var item_sl_no;
                            if(q_no!=''){
                                 if(q_no>999){
                                    item_sl_no=q_no;
                                }else if(q_no>99){
                                    item_sl_no='QN/'+msg.unit_info[0].short_name+'/'+final+'/'+"0"+q_no;
                                }else if(q_no>9){
                                    item_sl_no='QN/'+msg.unit_info[0].short_name+'/'+final+'/'+"00"+q_no;
                                }else{
                                    item_sl_no='QN/'+msg.unit_info[0].short_name+'/'+final+'/'+"000"+q_no;
                                }
                            }else{
                                q_no=1;
                                item_sl_no='QN/'+msg.unit_info[0].short_name+'/'+final+'/'+'0001';
                            }

                            $('#q_code').val(q_no);
                            $('#reference_no').val(item_sl_no);
//                            var str='';
//                            var total=0;
//                             $(msg.products).each(function (i, v) {
//                                str+= '<tr  id="row_' + (Number(i) + 1) + '">';
//                                str +='<td><input type="hidden"  name="product_id[]" id="product_id_'+(Number(i) + 1) + '" class="issue" value="'+v.product_id+'"><input readonly  style="width:140px;"  type="text"  name="product_name[]" id="product_name_'+(Number(i) + 1) + '" class="issue" value="'+v.product_name+'"></td>';
//                                str +='<td><input type="hidden"  name="product_cost_id[]" id="product_cost_id_'+(Number(i) + 1) + '" class="issue" value="'+v.product_cost_id+'"><input readonly  style="width:100px;"  type="text"  name="cost_number[]" id="cost_number_'+(Number(i) + 1) + '" class="issue" value="'+v.cost_number+'"></td>';
//                                str +='<td><input style="width:140px;"  type="hidden"  name="project_id_[]" id="project_id_'+(Number(i) + 1)+ '" class="issue" value="'+v.project_id+'"><input readonly  style="width:140px;"  type="text"  name="description[]" id="project_name_'+(Number(i) + 1)+ '" class="issue" value="'+v.project_name+'"></td>';
//                                str +='<td><input   style="width:80px;"  type="text"  name="m_unit[]" id="m_unit_'+(Number(i) + 1) + '" class="issue" value="'+v.measurement_unit+'"></td>';
//                                str +='<td><input readonly onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:40px;text-align: right;"  type="text"  name="quantity[]" id="quantity_'+(Number(i) + 1)+ '" class="issue number" value="1"></td>';
//                                str +='<td><input readonly onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:80px;text-align: right;"  type="text"  name="unit_price[]" id="unit_price_'+(Number(i) + 1)+ '" class="issue number" value="'+v.quote_price+'"></td>';
//
//                                str +='<td><input readonly  style="width:140px;text-align: right;"  type="text"  name="amount[]" id="amount_'+(Number(i) + 1) + '" class="amount_'+(Number(i) + 1)+'" value="'+v.quote_price+'"></td>';
//                                str +='<td><input   style="width:140px;"  type="text"  name="remark[]" id="remark_'+(Number(i) + 1) + '" class="issue"></td>';
//                                str +='<td><input  onclick="calculateSubtotal('+(Number(i) + 1)+')" style="width:40px;"  type="checkbox"  name="select_product[]" id="select_product_'+(Number(i) + 1)+ '" class="select_product_'+(Number(i) + 1)+ '" value="'+i+'"></td>';
//                                str +='</tr>'
//                             });
//                             $('#quotation_item').html(str);
                      }else{
                         $('#quotation_item').html('');
                         $('#sub_total').val(''); 
                         //alert('Please prepare product cost  for this customer');
                      }    
                    
                   }

                      
            })
        }else{
            $('#billing_address').val('');
            $('#shipping_address').val('');
            $('#billing_email').val('');
            $('#shipping_email').val('');
        
            $('#q_code').val('');
            $('#reference_no').val('');
        }
    });
    
    
    $('#supplier_id').change(function(){
       
        var id = $('#supplier_id').val();
        if(id!=''){
           
            var data = {'id': id}
            $.ajax({
                url: '<?php echo site_url('purchase_quotations/supplier_info'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {  
                    if(msg.suppplier_info!=''){
                            $('#phone').val(msg.suppplier_info[0].MOBILE);
                            $('#attention').val(msg.suppplier_info[0].NAME);
                            $('#billing_address').val(msg.suppplier_info[0].ADDRESS);
                            $('#billing_email').val(msg.suppplier_info[0].EMAIL);
                            $('#shipping_address').val(msg.suppplier_info[0].ADDRESS);
                            $('#shipping_email').val(msg.suppplier_info[0].EMAIL);
                    
                    }else{
                       
                        $('#phone').val('');    
                        $('#attention').val('');
                        
                    }
                }

                      
            })
        }else{
            $('#phone').val('');    
            $('#attention').val('');
        }
    });
    
    
    $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr=$('#item_1').html();
        
        var str= '<tr  id="row_' + (Number(count) + 1) + '">';
        
        str +='<td><select required class="e1" style="width:200px;"  onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_'+(Number(count) + 1) + '" class="">'+itemstr+'</select></td>';
        str +='<td><input   style="width:80px;" disabled  type="text"  name="description[]" id="m_unit_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><input required onkeyup="calculateSubtotal('+(Number(count) + 1)+')" onchange="calculateSubtotal('+(Number(count) + 1)+')" onblur="calculateSubtotal('+(Number(count) + 1)+')"  style="width:80px;"  type="text"  name="quantity[]" id="quantity_'+(Number(count) + 1) + '" class="issue number"></td>';
        str +='<td><input required onkeyup="calculateSubtotal('+(Number(count) + 1)+')" onchange="calculateSubtotal('+(Number(count) + 1)+')" onblur="calculateSubtotal('+(Number(count) + 1)+')"  style="width:80px;"  type="text"  name="unit_price[]" id="unit_price_'+(Number(count) + 1) + '" class="issue number"></td>';
        
        str +='<td><input readonly  style="width:140px;"  type="text"  name="amount[]" id="amount_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><input   style="width:140px;"  type="text"  name="remark[]" id="remark_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>'; 
        
        str +='</tr>';
       
        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
        $('select.e1').select2();
        $('.chzn-container').remove();
    });
    
    function removeRow(row) {
        var count = $('#count').val();
        $('#count').val(Number(count)-1);
        $('#row_' + row).remove();
        var sub_total=0;
        var rowCount = $('#myTable tr').length;
        var table_row=Number(rowCount)-2;
        for(var i=1;i<=table_row;i++){
           var amt=$('#amount_'+i).val();
           sub_total=sub_total+Number(amt)

        }    
        $('#sub_total').val(sub_total);
        $('#remaining_balance').val(sub_total);
        $('#balance').html(sub_total);
    }
    
     function item_info(id) {
        var itemId = $('#item_'+id).val();
        if(itemId!=''){
            var data = {'itemId': itemId}
            $.ajax({
                url: '<?php echo site_url('purchase_quotations/item_info'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {  

                    $('#m_unit_'+id).val(msg.item_info[0].meas_unit);


                  }


            })
       }else{
            $('#m_unit_'+id).val('');
       }

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
    
    //alert('test');
         var k=0;
         var sub_total=0;
         var unit_price=Number($('#unit_price_'+id).val());
         var quantity=Number($('#quantity_'+id).val());
         if(quantity>0 && unit_price>0){
            var amount=Number(unit_price)*Number(quantity);
         }else{
             var amount='';
         }    
         
       
         
         var rowCount = $('#myTable tr').length;
         var table_row=Number(rowCount)-2;
         
         if(quantity>0){
              
               $('#amount_'+id).val(amount);
               
               if(unit_price>0){
                 
               }else{
                   $('#unit_price_'+id).val('');   
               }    
               
               for(var i=1;i<=table_row;i++){
                   
                  
                        var amt=$('#amount_'+i).val();
                        if(amt!=''){
                            sub_total=sub_total+Number(amt)
                        }
                   

               }    
               
            
           
       }else{
          $('#amount_'+id).val('');
          $('#quantity_'+id).val(''); 
          for(var i=1;i<=table_row;i++){
             
                   var amt=$('.amount_'+i).val();
                   if(amt!=''){
                        sub_total=sub_total+Number(amt);
                    }
                   

         }    
       }
       
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
         
       
       
    }  
    
    
    
    function calculateSubtotal_(id){
         var sub_total=0;
         var unit_price=$('#unit_price_'+id).val();
         var quantity=$('#quantity_'+id).val();
         var amount=Number(unit_price)*Number(quantity);
         
         $('#amount_'+id).val(amount);
         var rowCount = $('#myTable tr').length;
         var table_row=Number(rowCount)-2;
         for(var i=1;i<=table_row;i++){
             var amt=$('#amount_'+i).val();
             sub_total=sub_total+Number(amt)
             
         }    
         $('#sub_total').val(sub_total);
         $('#remaining_balance').val(sub_total);
         $('#balance').html(sub_total);
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
    
    
    
    
</script>