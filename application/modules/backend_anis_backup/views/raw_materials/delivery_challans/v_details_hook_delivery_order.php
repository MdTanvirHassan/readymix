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
                <h3>Details Delivery Order</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <form class="form-horizontal" action="<?php echo site_url('raw_materials/rm_sales/edit_delivery_order_action/'.$delivery_order_info[0]['do_id']); ?>" method="post" onsubmit="javascript: return validation()">
        <div class='form-group' style="margin-bottom:30px;" >
            
              <label for="title" class="col-sm-2 control-label">
                    Select customer<sup class="required">*</sup>  :
              </label> 
            
               <div class="col-sm-6 input-group">
                   <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <select  class="form-control e1" placeholder="Select Customer" id="customer_id" name="customer_id"  >
                         <option value="" >Select customer</option>
                       <?php foreach($customers as $customer){ ?>
                          <option <?php if($delivery_order_info[0]['customer_id']==$customer['id']) echo 'selected'; ?>  value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option> 
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
                            <option <?php if($delivery_order_info[0]['lc_id']==$lc['lc_id']) echo 'selected'; ?> class="form-control" value="<?php echo $lc['lc_id']; ?>"><?php echo $lc['SUP_NAME'].'('.$lc['lc_no'].')'; ?></option>
                        <?php } ?>    


                   </select>
                    <span id="category_id_error" style="color:red"></span>
                </div>
        </div>
        
        
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Do. Number<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input required class="form-control" readonly name="delivery_no" type="text" value="<?php if(!empty($delivery_order_info[0]['delivery_no'])) echo $delivery_order_info[0]['delivery_no']; ?>">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    D.Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control datepicker" id="delivery_order_date" name="delivery_order_date" type="text" value="<?php if(!empty($delivery_order_info[0]['delivery_order_date'])) echo date('d-m-Y',strtotime($delivery_order_info[0]['delivery_order_date'])); ?>">
                       <span id="delivery_order_date_error" style="color:red"></span>
                                </div>

                            </div>
        
                            <div class='form-group' >
                                
            
                                
                             

                            </div>
        
         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Phone<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input readonly class="form-control" id="phone" name="phone" type="text" placeholder="Phone Number" value="<?php if(!empty($delivery_order_info[0]['phone_no'])) echo $delivery_order_info[0]['phone_no']; ?>">
                                <span id="phone_error" style="color:red"></span>
                                </div>
              <label for="title" class="col-sm-2 control-label">
                                    Attention<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                     <input readonly class="form-control" id="attention" name="attention" type="text" placeholder="Attention Person Name" value="<?php if(!empty($delivery_order_info[0]['attention'])) echo $delivery_order_info[0]['attention']; ?>">
                                <span id="attention_error" style="color:red"></span>
                                </div>
                                

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Contact No<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                    <input readonly class="form-control" id="contact_no" name="contact_no" type="text" placeholder="Contact No" value="<?php if(!empty($delivery_order_info[0]['contact_no'])) echo $delivery_order_info[0]['contact_no']; ?>">
                                <span id="contact_no" style="color:red"></span>
                        
                                </div>
                               <label for="title" class="col-sm-2 control-label">
                                  Contact Person :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input readonly class="form-control" id="contact_person" name="contact_person" type="text" placeholder="Contact Person" value="<?php if(!empty($delivery_order_info[0]['contact_person'])) echo $delivery_order_info[0]['contact_person']; ?>">
                                 <span id="contact_person" style="color:red"></span>
                                </div> 
            

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    B. Email<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <input readonly class="form-control" id="billing_email" name="billing_email" type="text" placeholder="Billing Email" value="<?php if(!empty($delivery_order_info[0]['billing_email'])) echo $delivery_order_info[0]['billing_email']; ?>">
                        <span id="billing_email_error" style="color:red"></span>
                                </div>
                               <label for="title" class="col-sm-2 control-label">
                                    B. Address<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                      <input readonly class="form-control" id="billing_address" name="billing_address" type="text" placeholder="Billing Address" value="<?php if(!empty($delivery_order_info[0]['billing_address'])) echo $delivery_order_info[0]['billing_address']; ?>">
                        <span id="billing_address_error" style="color:red"></span>
                                </div>
            
            
            

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    D. Email<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <input readonly class="form-control" id="shipping_email" name="shipping_email" type="text" placeholder="Delivery Email" value="<?php if(!empty($delivery_order_info[0]['shipping_email'])) echo $delivery_order_info[0]['shipping_email']; ?>">
                        <span id="billing_email_error" style="color:red"></span>
                                </div>
            <label for="title" class="col-sm-2 control-label">
                                    D. Address<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                     <input readonly class="form-control" id="shipping_address" name="shipping_address" type="text" placeholder="Delivery Address" value="<?php if(!empty($delivery_order_info[0]['shipping_address'])) echo $delivery_order_info[0]['shipping_address']; ?>">
                        <span id="shipping_address_error" style="color:red"></span>
                                </div>
                                    
                                

         </div>
        
        <div class='form-group' >
                <label for="title" class="col-sm-2 control-label">
                    Special Note  :
                </label> 
                <div class="col-sm-4 input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <!--
                     <input  class="form-control" id="special_note" name="special_note" type="text" placeholder="Special Note" value="<?php if(!empty($delivery_order_info[0]['special_note'])) echo $delivery_order_info[0]['special_note']; ?>">
                    -->
                    <textarea  rowspan="7" class="form-control" id="special_note" name="special_note"  placeholder="Special Note"><?php if(!empty($delivery_order_info[0]['special_note'])) echo $delivery_order_info[0]['special_note']; ?></textarea>  

                </div>

            <label for="title" class="col-sm-2 control-label">
                Remark:
            </label> 
            <div class="col-sm-4 input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
               <!--  <input  class="form-control" id="special_note" name="special_note" type="text" placeholder="Special Note">-->
                <textarea  rowspan="7" class="form-control" id="special_note" name="do_remark"  placeholder="Remark"><?php if(!empty($delivery_order_info[0]['remark'])) echo $delivery_order_info[0]['remark']; ?></textarea>  
            </div>


            </div>

       
       <div class="separator-shadow"></div>
        <div class="row">
           
                <table class="table table-bordered" >
                    <thead class="thead-color">
                     <tr>
                        <th style="vertical-align: middle;text-align: center;width:150px;">Item Name</th>
                        <th style="vertical-align: middle;text-align: center;">Origin</th>
                        <th style="vertical-align: middle;text-align: center;">Grade</th>

                        <th style="vertical-align: middle;text-align: center;">MU.</th>
                       
                        <th style="vertical-align: middle;text-align: center;">Do. Qty<sup style="color:red;">*</sup></th>
                        
                        

                      </tr>
                    </thead>
                    <tbody id="mytableBody">
                          <?php $i=0; foreach($delivery_order_details_info as $delivery_order_details){ 
                            $i++;
                            ?>
                         <tr class="" id="row_<?php echo $quotation_details['s_item_id'] ?>">
                            <td>
                                 <input  type="hidden"  name="lc_details_id[]" id="o_details_id_<?php echo $i; ?>" class="issue" value="<?php echo $delivery_order_details['lc_details_id'] ?>">
                                 <input  type="hidden"  name="s_item_id[]" id="item_des_c1_" class="issue" value="<?php echo $delivery_order_details['s_item_id'] ?>">
                                 <input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="<?php echo $delivery_order_details['item_name'] ?>">
                             </td>
                             
                             <td><input readonly  style="width:100%;text-align: left;"  type="text" class="mu_<?php echo $i; ?>"  name="mu_name[]" id="mu_<?php echo $i; ?>" class="issue" value="<?php echo $delivery_order_details['origin'] ?>"></td>
                             <td><input readonly  style="width:100%;text-align: left;"  type="text" class="mu_<?php echo $i; ?>"  name="mu_name[]" id="mu_<?php echo $i; ?>" class="issue" value="<?php echo $delivery_order_details['item_grade'] ?>"></td>
                             <td><input readonly  style="width:100%;text-align: left;"  type="text" class="mu_<?php echo $i; ?>"  name="mu_name[]" id="mu_<?php echo $i; ?>" class="issue" value="<?php echo $delivery_order_details['meas_unit'] ?>"></td>
                             
                             
                             
                             
                             <td>
                                 
                                
                                 
                                 <input  readonly onkeyup="calculateTotal(<?php echo $i; ?>)" onchange="calculateTotal(<?php echo $i; ?>)" onblur="calculateTotal(<?php echo $i; ?>)"  style="width:140px;text-align:left;"  type="text"  name="quantity[]" id="quantity_<?php echo $i; ?>" class="issue" value="<?php echo $delivery_order_details['quantity'] ?>">
                             </td>
                             
                           
                            
                            
                         <!--   <td><input readonly  style="width:140px;text-align: left;"  type="text" class="remark_<?php echo $i; ?>"  name="remark[]" id="remark_<?php echo $i; ?>" class="issue" value="<?php //echo $delivery_order_details['remark'] ?>"></td> -->

                          </tr>
                        <?php } ?>
                      
                      </tbody>
                       <tfoot>
                            <tr>
                                <td  style="text-align:right;"></td>
                                <td  style="text-align:right;"></td>
                                <td><input type="hidden" style="width:140px;text-align: right;" id="sub_total"  name="total_amount" type="text" value="<?php //if(!empty($delivery_order_info[0]['total_amount'])) echo $delivery_order_info[0]['total_amount']; ?>"></td>
                            </tr>
                        </tfoot>
                  </table>
           
            
            
            
        </div>
        
       
      
       <div id="specification_raw_material">
                                <div class="row">

                                    <?php if (!empty($purchase_conditions)) { ?> 
                                        <input type="hidden" value="<?php echo count($purchase_conditions) ?>" id="material_count" />
                                    <?php } else { ?>
                                        <input type="hidden" value="1" id="material_count" />
<?php } ?>  
                                    <table class="table table-bordered" id="specificationTable">
                                        <thead>
                                            <tr >

                                                <th>Term or Condition Name </th>
                                                <th>Description</th>
                                               

                                            </tr>
                                        </thead>
                                        <tbody id="material_specification">
                                            <?php
                                            $i = 0;
                                            foreach ($purchase_conditions as $purchase_condition) {
                                                $i++;
                                                ?>
                                                <tr id="row_<?php echo $i; ?>">

                                                    <td><input readonly  style="width:200px"  type="text"  name="name[]"  class="issue form-control" value="<?php echo $purchase_condition['name'] ?>"></td>
                                                    <td><textarea readonly  style="width:700px"  type="text"  name="description[]"  class="issue form-control"><?php echo $purchase_condition['description'] ?></textarea></td>
                                                    
                                                </tr>
                                            <?php } ?> 
                                        </tbody>

                                    </table> 



                                </div> 
                            </div> 
       
       
        
        <div class="row">
           <div class="col-md-2">
                <a href="<?php echo site_url('raw_materials/delivery_challans/deliveryOrder/Hook') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px">GO BACK</button> </a>
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
//            $('#phone_error').html('Please fill phone number field');
//            $('#phone').css('border','1px solid red'); 
//             error=true;
        }else{
            $('#phone_error').html('');
            $('#phone').css('border','1px solid #ccc');  
             
        }
        
        if(billing_address==''){
            $('#billing_address_error').html('Please fill billing address field');
            $('#billing_address').css('border','1px solid red'); 
            error=true;
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
    
    
    
    
     function calculateTotal() {
        var total = 0;
        $('#mytableBody').find('tr').each(function(i, v) {
            
            //if(i>0){
            var qty = Number($(this).find('td').eq('5').find('input').val());
           // alert(qty);
            var price = Number($(this).find('td').eq('6').find('input').val());
            
            var tot = qty * price;
            $(this).find('td').eq('7').find('input').val(tot.toFixed(2));
            total += tot;
           // }
        })
        
       // $('#amount').val(total.toFixed(2))
    }
   
    
   
</script>


