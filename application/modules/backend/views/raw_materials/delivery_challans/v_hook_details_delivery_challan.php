<style>
    table tr td, table tr th{
        text-align: center;
        vertical-align: middle;
    }
</style>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
        <?php //require_once(__DIR__ .'/../production_header.php'); ?>
    </div>
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Detais Hook Delivery Challan</h3>
                <?php if($delivery_challan_info[0]['status']=="Approved"){ ?>
                    <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('raw_materials/delivery_challans/details_hook_delivery_challan/'.$delivery_challan_info[0]['dc_id'].'/true'); ?>" class="btn btn-sm btn-warning">PRINT</a>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" action="<?php echo site_url('raw_materials/delivery_challans/edit_delivery_challan_action/'.$delivery_challan_info[0]['dc_id']); ?>" method="post" onsubmit="javascript: return validation()" >
                           
                            <div class='form-group' style="margin-bottom: 30px;">
                                <label for="title" class="col-sm-2 control-label">
                                   Customer<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select disabled id="customer_id" class="form-control e1" name="customer_id">
                                               
                                                <?php foreach ($customers as $cust) {
                                                   ?>
                                                    <?php if($cust['id']==$delivery_challan_info[0]['customer_id']){ ?>
                                                        <option class="form-control" value="<?php echo $cust['id']; ?>"><?php echo $cust['c_name'] . '(' . $cust['c_short_name'] . ')'; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <span id="do_id_error" style="color:red"></span>
                                </div>
                                

                            </div>
                            
                           
                            
                            <div class='form-group' >
                               <label for="title" class="col-sm-2 control-label">
                                    DC.No.<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                        <input readonly class="form-control" id="attention" name="attention" type="text" placeholder="Attention Person Name" value="<?php if(!empty($delivery_challan_info[0]['dc_no'])) echo $delivery_challan_info[0]['dc_no']; ?>">
                                    <span id="delivery_challan_date_error" style="color:red"></span>
                                </div>
                                
                                <label for="title" class="col-sm-2 control-label">
                                    Transport Type<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <select disabled id="transport_type" class="form-control e1" name="transport_type" onchange="javascript:transportInfo();">
                                        <option <?php if($delivery_challan_info[0]['transport_type']=="Self") echo "selected"; ?> value="Self">Kmix Transport</option>
                                        <option <?php if($delivery_challan_info[0]['transport_type']=="Third Party") echo "selected"; ?> value="Third Party">Third Party</option>
                                        <option <?php if($delivery_challan_info[0]['transport_type']=="Customer") echo "selected"; ?> value="Customer">Customer</option>
                                    </select>
                                            <span id="delivery_challan_date_error" style="color:red"></span>
                                </div>
                                
                                

                            </div>
                            
                           
                            
                            <div class='form-group' >
                                 <label for="title" class="col-sm-2 control-label">
                                    Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input readonly class="form-control datepicker" id="delivery_challan_date" name="delivery_challan_date" type="text" value="<?php if(!empty($delivery_challan_info[0]['delivery_challan_date'])) echo date('d-m-Y',strtotime($delivery_challan_info[0]['delivery_challan_date'])); ?>">
                       <span id="delivery_challan_date_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Attention<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                     <input readonly class="form-control" id="attention" name="attention" type="text" placeholder="Attention Person Name" value="<?php if(!empty($delivery_challan_info[0]['attention'])) echo $delivery_challan_info[0]['attention']; ?>">
                                <span id="attention_error" style="color:red"></span>
                                </div>

                            </div>
                            
                              <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Phone<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input readonly class="form-control" id="phone" name="phone" type="text" placeholder="Phone Number" value="<?php if(!empty($delivery_challan_info[0]['phone'])) echo $delivery_challan_info[0]['phone']; ?>">
                                <span id="phone_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                  Contact Person :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input readonly class="form-control" id="contact_person" name="contact_person" type="text" placeholder="Contact Person" value="<?php if(!empty($delivery_challan_info[0]['contact_person'])) echo $delivery_challan_info[0]['contact_person']; ?>">
                                 <span id="contact_person" style="color:red"></span>
                                </div>

                            </div>
                            
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Contact No<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                    <input readonly class="form-control" id="contact_no" name="contact_no" type="text" placeholder="Contact No" value="<?php if(!empty($delivery_challan_info[0]['contact_no'])) echo $delivery_challan_info[0]['contact_no']; ?>">
                                <span id="contact_no" style="color:red"></span>
                        
                                </div>
                                
                                <label for="title" class="col-sm-2 control-label">
                                    D. Address<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                     <input readonly class="form-control" id="shipping_address" name="shipping_address" type="text" placeholder="Delivery Address" value="<?php if(!empty($delivery_challan_info[0]['shipping_address'])) echo $delivery_challan_info[0]['shipping_address']; ?>">
                        <span id="shipping_address_error" style="color:red"></span>
                                </div>


                            </div>
                            
                           
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    D. Email<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                      <input readonly class="form-control" id="shipping_email" name="shipping_email" type="text" placeholder="Delivery Email" value="<?php if(!empty($delivery_challan_info[0]['shipping_email'])) echo $delivery_challan_info[0]['shipping_email']; ?>">
                                    <span id="shipping_email_error" style="color:red"></span>
                                </div>
                                
                                <label for="title" class="col-sm-2 control-label">
                                   Ship<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     
                                    
                                     <input readonly   class="form-control" id="truck_no" name="truck_no" type="text" placeholder="Truck No." value="<?php echo $delivery_challan_info[0]['truck_no'];  ?>">
                                     <span id="truck_id_error" style="color:red"></span>
                                </div>
                                

                            </div>
                            
                              <div class='form-group' >
                               
                                <label for="title" class="col-sm-2 control-label">
                                   Master<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     
                                    
                                            <input readonly   class="form-control" id="driver_name" name="driver_name" type="text" placeholder="Driver Name" value="<?php echo $delivery_challan_info[0]['driver_name'];  ?>">
                                            <span id="driver_id_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Helper<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    
                                            <input readonly style=""  class="form-control" id="helper_name" name="helper_name" type="text" placeholder="Helper Name" value="<?php echo $delivery_challan_info[0]['helper_name'];  ?>">
                                            <span id="helper_id_error" style="color:red"></span>
                                </div>
                                
                                  

                            </div>
                              <div class='form-group' >
                               
                                
                                  
                                <label for="title" class="col-sm-2 control-label">
                                    Challan Time<sup class="required">*</sup>  :
                                </label> 
                                  
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input readonly class="form-control" id="challan_time" name="challan_time" type="text" placeholder="Challan Time" value="<?php if(!empty($delivery_challan_info[0]['challan_time'])) echo $delivery_challan_info[0]['challan_time']; ?>">
                                    <span id="challan_time_error" style="color:red"></span>
                                </div>  
                               
                                <label for="title" class="col-sm-2 control-label">
                                   Transport Company<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select disabled id="t_company_id" class="form-control " name="t_company_id">
                                                <option class="form-control" value="">Select</option>
                                                <?php foreach ($transport_companies as $company) { ?>
                                                    <option <?php if($company['id']==$delivery_challan_info[0]['t_company_id']) echo 'selected' ?> class="form-control" value="<?php echo $company['id'] ?>"><?php echo $company['c_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span id="t_company_id_error" style="color:red"></span>
                                </div>   

                            </div>
                            

                            <div class='form-group' >
                               
                               
                                 
                                <label for="title" class="col-sm-2 control-label">
                                   Manual Challan No.<sup class="required"></sup>  :
                                </label> 
                                
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input readonly  class="form-control " id="manual_dc_no" name="manual_dc_no" type="text" placeholder="Manual Challan No." value="<?php if(!empty($delivery_challan_info[0]['manual_dc_no'])) echo $delivery_challan_info[0]['manual_dc_no']; ?>">
                                    <span id="challan_time_error" style="color:red"></span>
                                </div>
                                

                            </div>
          
        <div class="separator-shadow"></div>
        <div class="row">
           
                <table class="table table-bordered" id="myTable" >
                    <thead class="thead-color">
                     <tr>
                        <th style="vertical-align: middle;text-align: center;width:150px;">Do.No.</th>
                        <th style="vertical-align: middle;text-align: center;width:150px;">Item Name</th>
                        <th style="vertical-align: middle;text-align: center;">Origin</th>
                        <th style="vertical-align: middle;text-align: center;">Grade</th>

                        <th style="vertical-align: middle;text-align: center;">MU.</th>
                        <th style="vertical-align: middle;text-align: center;">Do. Qty<sup style="color:red;"></sup></th>
                        <th style="vertical-align: middle;text-align: center;">Challan Qty<sup style="color:red;">*</sup></th>
                       

                      </tr>
                    </thead>
                    <tbody id="challan_items">
                          <?php $i=0; foreach($delivery_challan_details_info as $delivery_challan_details){ 
                            $i++;
                            ?>
                         <tr class="" id="row_">
                             <td>
                                 <input style="width:140px;text-align: left;"  type="hidden"   name="dc_details_id[]" id="dc_details_id_<?php echo $i; ?>" class="dc_details_id_<?php echo $i; ?>" value="<?php echo $delivery_challan_details['dc_details_id'] ?>">
                                 <input style="width:140px;text-align: left;"  type="hidden"   name="do_details_id[]" id="do_details_id_<?php echo $i; ?>" class="do_details_id_<?php echo $i; ?>" value="<?php echo $delivery_challan_details['do_details_id'] ?>">
                                 <input readonly  style="width:140px;text-align: left;"  type="text"   name="do_no[]" id="do_no_<?php echo $i; ?>" class="do_no_<?php echo $i; ?>" value="<?php echo $delivery_challan_details['delivery_no'] ?>">
                             </td>   
                             <td><input  type="hidden"  name="s_item_id[]" id="item_des_c1_" class="issue" value="<?php echo $delivery_challan_details['s_item_id'] ?>"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="<?php echo $delivery_challan_details['item_name']; ?>"></td>                             
                             <td><input readonly  style="width:140px;text-align: left;"  type="text"   name="origin[]" id="origin_<?php echo $i; ?>" class="origin_<?php echo $i; ?>" value="<?php echo $delivery_challan_details['origin'] ?>"></td>                             
                             <td><input readonly  style="width:140px;text-align: left;"  type="text"   name="item_grade[]" id="item_grade_<?php echo $i; ?>" class="item_grade_<?php echo $i; ?>" value="<?php echo $delivery_challan_details['item_grade'] ?>"></td>                             
                             <td><input readonly  style="width:140px;text-align: left;"  type="text"   name="mu_name[]" id="mu_<?php echo $i; ?>" class="mu_<?php echo $i; ?>" value="<?php echo $delivery_challan_details['meas_unit'] ?>"></td>
                             <td><input readonly  style="width:140px;text-align: left;"  type="text"   name="do_qty[]" id="remaining_qty_<?php echo $i; ?>" class="do_qty_<?php echo $i; ?>" value="<?php echo $delivery_challan_details['do_qty'] ?>"></td>
                             <td>
                                 <input style="width:140px;text-align: right;" type="hidden"  name="unit_price[]" id="quantity_<?php echo $i; ?>" class="unit_price_<?php echo $i; ?>" value="<?php echo $delivery_challan_details['unit_price'] ?>">
                                 <input readonly    style="width:140px;text-align: right;"  type="text"  name="quantity[]" id="quantity_<?php echo $i; ?>" class="quantity_<?php echo $i; ?>" value="<?php echo $delivery_challan_details['quantity'] ?>">
                             </td>
                             
                          </tr>
                        <?php } ?>
                      
                      </tbody>
                       <tfoot>
                            <tr>
                                <td  style="text-align:right;"></td>
                                <td  style="text-align:right;"></td>
                                <td><input type="hidden" style="width:140px;text-align: right;" id="sub_total"  name="total_amount" type="text" value="<?php if(!empty($delivery_challan_info[0]['total_amount'])) echo $delivery_challan_info[0]['total_amount']; ?>"></td>
                            </tr>
                        </tfoot>
                  </table>
           
            
            
            
        </div>
        
       
       
     
        
        <div class="row">
           <div class="col-md-2">
                <a href="<?php echo site_url('raw_materials/delivery_challans/hook_challans') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
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
    
    
    function transportInfo(){
        var transport_typ=$('#transport_type').val();
        
        if(transport_typ=="Self"){
            $('#driver_id').show();
            $('#helper_id').show();
            $('#truck_id').show();
            
            
            $('#helper_name').val('');
            $('#driver_name').val('');
            $('#truck_no').val('');
            
            $('#helper_name').hide();
            $('#driver_name').hide();
            $('#truck_no').hide();
            
            $('#helper_name').prop('required',false);
            $('#driver_name').prop('required',false);
            $('#truck_no').prop('required',false);
            
            
        }else{
            $('#helper_name').show();
            $('#driver_name').show();
            $('#truck_no').show();
            
            
            $('#driver_id').val('');
            $('#helper_id').val('');
            $('#truck_id').val('');
            
            $('#driver_id').hide();
            $('#helper_id').hide();
            $('#truck_id').hide();
            
            $('#helper_name').prop('required',true);
            $('#driver_name').prop('required',true);
            $('#truck_no').prop('required',true);
        }
        
        
        if(transport_typ=="Third Party"){
            $('#t_company_id').prop('required',true);
        }else{
            $('#t_company_id').prop('required',false);
            $('#t_company_id').val('');
        }
    }
    
    
    
    
     function validation(){
        var delivery_challan_date=$('#delivery_challan_date').val();
        var do_id=$('#do_id').val();
      
        var project_name=$('#project_name').val();
        var attention=$('#attention').val();
        var phone=$('#phone').val();
        var billing_address=$('#billing_address').val();
        var billing_email=$('#billing_email').val();
        var shipping_address=$('#shipping_address').val();
        var shipping_email=$('#shipping_email').val();
        
        var driver_id = $('#driver_id').val();
        var truck_id = $('#truck_id').val();
        
        var error=false;
        
        if(delivery_challan_date==''){
            $('#delivery_challan_date').css('border','1px solid red');
            $('#delivery_challan_date_error').html('Please fill date field');
            error=true;
           
        }else{
            $('#delivery_challan_date').css('border','1px solid #ccc');
            $('#delivery_challan_date_error').html('');
            
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
            if(!regex.test(shipping_email)){
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
    
    
   



   
    
    
    
    
   
</script>


