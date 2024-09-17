<style>
    table tr td, table tr th{
        text-align: center;
        vertical-align: middle;
		}
</style>


<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<div class="os-tabs-w menu-shad">
       <?php require_once(__DIR__ .'/../../trading_challan_header.php'); ?>
    </div>
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Hook Delivery Challan</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" action="<?php echo site_url('raw_materials/delivery_challans/add_hook_delivery_challan_action'); ?>" method="post" onsubmit="javascript: return validation()">

                            
                            
                            <div class='form-group' style="margin-bottom: 30px;">
                                <label for="title" class="col-sm-2 control-label">
                                   Customer<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select required id="customer_id" class="form-control e1" name="customer_id">
                                                <option class="form-control" value="">Select Customer</option>
                                                <?php foreach ($customers as $cust) {
                                                   ?>
                                                    <option class="form-control" value="<?php echo $cust['id']; ?>"><?php echo $cust['c_name'] . '(' . $cust['c_short_name'] . ')'; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span id="do_id_error" style="color:red"></span>
                                </div>
                                

                            </div>
                            
                           
                            
                            <div class='form-group' >
                               
                                
                                <label for="title" class="col-sm-2 control-label">
                                    Transport Type<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <select required id="transport_type" class="form-control e1" name="transport_type" onchange="javascript:transportInfo();">
                                        <option value="Self">Kmix Transport</option>
                                        <option value="Third Party">Third Party</option>
                                        <option value="Customer">Customer</option>
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
                                    <input  class="form-control datepicker" id="delivery_challan_date" name="delivery_challan_date" type="text" value="<?php echo date('d-m-Y') ?>">
                                            <span id="delivery_challan_date_error" style="color:red"></span>
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
                                    D. Email<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <input  class="form-control" id="shipping_email" name="shipping_email" type="text" placeholder="Delivery Email">
                                            <span id="shipping_email_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Lighter<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <div id="truck_block">
                                         <select required id="truck_id" class="form-control e1" name="truck_id">
                                                    <option class="form-control" value="">Select</option>
                                                    <?php foreach ($trucks as $truck) { ?>
                                                        <option class="form-control" value="<?php echo $truck['truck_id'] ?>"><?php echo $truck['truck_no']; ?></option>
                                                    <?php } ?>
                                                </select>
                                        </div>    
                                    
                                            <input style="display:none;"  class="form-control" id="truck_no" name="truck_no" type="text" placeholder="Truck No.">
                                            <span id="truck_id_error" style="color:red"></span>
                                </div>

                            </div>
                            
                             <div class='form-group' >
                               
                                <label for="title" class="col-sm-2 control-label">
                                    Master<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <div id="driver_block">
                                         <select required id="driver_id" class="form-control e1" name="driver_id">
                                                    <option class="form-control" value="">Select</option>
                                                    <?php foreach ($drivers as $driver) { ?>
                                                        <option class="form-control" value="<?php echo $driver['driver_id'] ?>"><?php echo $driver['driver_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                        </div>   
                                            <input style="display:none;"  class="form-control" id="driver_name" name="driver_name" type="text" placeholder="Driver Name">
                                    
                                            <span id="driver_id_error" style="color:red"></span>
                                </div>
                                 <!--
                                <label for="title" class="col-sm-2 control-label">
                                   Helper<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <div id="helper_block">
                                         <select required id="helper_id" class="form-control e1" name="helper_id">
                                                    <option class="form-control" value="">Select</option>
                                                    <?php foreach ($helpers as $driver) { ?>
                                                        <option class="form-control" value="<?php echo $driver['helper_id'] ?>"><?php echo $driver['helper_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                        </div>        
                                    
                                            <input style="display:none;"  class="form-control" id="helper_name" name="helper_name" type="text" placeholder="Helper Name">
                                            <span id="driver_id_error" style="color:red"></span>
                                </div>
                                 -->
                                 

                            </div>
                             <div class='form-group' >
                               
                               
                                 
                                <label for="title" class="col-sm-2 control-label">
                                    Challan Time<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control " id="challan_time" name="challan_time" type="text" placeholder="Challan Time">
                                    <span id="challan_time_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Transport Company<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  id="t_company_id" class="form-control " name="t_company_id">
                                                <option class="form-control" value="">Select</option>
                                                <?php foreach ($transport_companies as $company) { ?>
                                                    <option class="form-control" value="<?php echo $company['id'] ?>"><?php echo $company['c_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span id="t_company_id_error" style="color:red"></span>
                                </div> 

                            </div>
                            


                            

                           <div class="separator-shadow"></div>

                           
                       <div class="row">
                            <input type="hidden" value="1" id="count" />
                                <table class="table table-bordered" >
                                    <thead class="thead-color">
                                        <thead class="thead-color">
                                                    <tr>
                                                        <th style="vertical-align: middle;text-align: center;width:200px;">Mother Vessel Name</th>
                                                        <th style="vertical-align: middle;text-align: center;width:200px;">Do.No.</th>
                                                        <th style="vertical-align: middle;text-align: center;width:200px;">Item Name</th>
                                                        <th style="vertical-align: middle;text-align: center;width:90px;">Origin</th>
                                                       <!-- <th style="vertical-align: middle;text-align: center;">Grade</th> -->

                                                        <th style="vertical-align: middle;text-align: center;width:80px;">MU.</th>
                                                        <th style="vertical-align: middle;text-align: center;width:90px;">Do. Qty<sup style="color:red;"></sup></th>
                                                        <th style="vertical-align: middle;text-align: center;width:90px;">Challan Qty<sup style="color:red;">*</sup></th>
                                                        
                                                        <th style="width:90px;">Select</th>


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
                       

                         

                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/raw_materials/delivery_challans/hook_challans') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>

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
    
    
   function transportInfo(){
        var transport_typ=$('#transport_type').val();
        
        if(transport_typ=="Self"){
            $('#driver_block').show();
            $('#driver_id').show();
            
            $('#helper_block').show();
            $('#helper_id').show();
            
            
            $('#truck_block').show();
            $('#truck_id').show();
            
            
            $('#helper_name').val('');
            $('#driver_name').val('');
            $('#truck_no').val('');
            
            $('#helper_name').hide();
            $('#driver_name').hide();
            $('#truck_no').hide();
            
            //$('#helper_name').prop('required',false);
            $('#driver_name').prop('required',false);
            $('#truck_no').prop('required',false);
            
            
            $('#driver_id').prop('required',true);
            $('#helper_id').prop('required',true);
            $('#truck_id').prop('required',true);
            
            
        }else{
            $('#helper_name').show();
            $('#driver_name').show();
            $('#truck_no').show();
            
            
            $('#driver_id').val('');
            $('#helper_id').val('');
            $('#truck_id').val('');
            
            $('#driver_block').hide();
            $('#driver_id').hide();
            
            $('#helper_block').hide();
            $('#helper_id').hide();
            
            $('#truck_block').hide();
            $('#truck_id').hide();
            
            //$('#helper_name').prop('required',true);
            $('#driver_name').prop('required',true);
            $('#truck_no').prop('required',true);
            
            $('#driver_id').prop('required',false);
            $('#helper_id').prop('required',false);
            $('#truck_id').prop('required',false);
        }
        
        
        if(transport_typ=="Third Party"){
            $('#t_company_id').prop('required',true);
        }else{
            $('#t_company_id').prop('required',false);
            $('#t_company_id').val('');
        }
    }
    
    
   
    
    
    $('#customer_id').change(function(){
        
        
        var customer_id=$('#customer_id').val();
        //alert(customer_id);
        if(customer_id!=''){
            
           
            
           
           

            $('#attention').val('');
           
            $('#phone').val('');
            
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            $('#contact_person').val('');
            $('#contact_no').val('');
            
           
           
            
           
            
           
            var data = {'customer_id': customer_id}
            $.ajax({
                    url: '<?php echo site_url('raw_materials/delivery_challans/getHookDoDetails'); ?>',
                    data: data,
                    method: 'POST',
                    dataType: 'json',
                    success: function (msg) { 
                      
                        
                        
                        $('#shipping_address').val(msg.customer_info[0].c_contact_address);
                        
                        var str='';
                   
                    $(msg.do_details).each(function(i, v) {
                       
                        var remaining_qty
                        if(v.delivery_quantity!=null){
                            //alert(v.delivery_quantity);
                            remaining_qty=Number(v.quantity)-Number(v.delivery_quantity);
                            remaining_qty=remaining_qty.toFixed(2);
                        }else{
                            //alert(v.quantity);
                            remaining_qty=Number(v.quantity);
                            remaining_qty=remaining_qty.toFixed(2);
                        }    
                       
                        i++;
                        str +='<tr>';
                        
                        str +='<td>';
                       
                        str +='<input style="width:100%;" readonly type="text" id="mother_vessel_name_'+i+'" name="mother_vessel_name[]" class="issue form-control" value="'+v.mother_vessel_name+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;"  type="hidden" id="do_id_'+i+'" name="do_id[]" class="issue form-control" value="'+v.do_id+'">';
                        str +='<input style="width:100%;"  type="hidden" id="do_details_id_'+i+'" name="do_details_id[]" class="issue form-control" value="'+v.do_details_id+'">';
                        str +='<input style="width:100%;" readonly type="text" id="do_no_'+i+'" name="do_no[]" class="issue form-control" value="'+v.delivery_no+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;"  type="hidden" id="lc_details_id_'+i+'" name="lc_details_id[]" class="issue form-control" value="'+v.lc_details_id+'">';
                        str +='<input style="width:100%;" readonly type="hidden" id="item_id_'+i+'" name="s_item_id[]" class="issue form-control" value="'+v.s_item_id+'">';
                        str +='<input style="width:100%;" readonly type="text" id="item_name_'+i+'" name="item_name[]" class="issue form-control" value="'+v.item_name+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="text" id="origin_'+i+'" name="origin[]" class="issue form-control" value="'+v.origin+'">';
                        str +='</td>';
                        
                        
//                        str +='<td>';                
//                        str +='<input style="width:100%;" readonly type="text" id="grade_'+i+'" name="grade[]" class="issue form-control" value="'+v.item_grade+'">';
//                        str +='</td>';
                        
                        
                        
                        
                        
                        str +='<td>';  
                        str +='<input style="width:100%;"  type="hidden"  id="unit_price_'+i+'" name="unit_price[]" class="issue form-control" value="'+v.unit_price+'">';
                        str +='<input style="width:100%;" readonly type="text" id="mu_'+i+'" name="mu[]" class="issue form-control" value="'+v.meas_unit+'">';
                        str +='</td>';
                        
                        
                        str +='<td>';
                        str +='<input readonly style="width:100%;"  type="text"  id="do_qty_'+i+'" name="do_qty[]" class="issue form-control" value="'+remaining_qty+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        
                        str +='<input style="width:100%;"  type="text" onchange="checkChallanQuantity()" onkeyup="checkChallanQuantity()"  id="receive_qty_'+i+'" name="quantity[]" class="issue form-control" value="">';
                        str +='</td>';
                        
                       
                        
                        str +='<td><input style="width:100%;text-align:right;" onclick="getDoInfo('+v.do_id+','+i+')"  type="checkbox" name="select_product[]"    id="select_product_'+v.s_item_id+'" class="select_product_'+i+'" value="'+i+'"></td>'; 
                        str +='</tr>';
                       
                      //  calculateTotal();
                        
                    })
                    
                    $('#mytableBody').html(str);
                        
                         
                                          

                    }

                })
        }else{
            
            
                                  
            $('#attention').val('');    
            $('#phone').val('');
           
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            
                        
            $('#contact_person').val('');
            $('#contact_no').val('');
            
           
            
            
        }
    });
    
    
    
    function getDoInfo(do_id,id){
    
        if ($('.select_product_'+id).prop('checked')) {
            var do_id=$('#do_id_'+id).val();
            
            $.ajax({
                url: '<?php echo site_url('raw_materials/delivery_challans/getDoInfo'); ?>',
                data: {
                    'do_id': do_id
                },
                method: 'POST',
                dataType: 'json',
                success: function(msg) {
                   
                    $('#attention').val(msg.do_info[0].attention);
                    $('#phone').val(msg.do_info[0].phone);
                    $('#contact_person').val(msg.do_info[0].contact_person);
                    $('#contact_no').val(msg.do_info[0].contact_no);
                    $('#shipping_address').val(msg.do_info[0].shipping_address);
                    $('#shipping_email').val(msg.do_info[0].shipping_email);
                    
                }
            })
            
        }else{
                $('#attention').val('');
                $('#phone').val('');
                $('#contact_person').val('');
                $('#contact_no').val('');
                $('#shipping_address').val('');
                $('#shipping_email').val('');
        }
    }
    
    function getLcDetails() {
        var lc_id=$('#lc_id').val();
        if(lc_id != ''){
            $.ajax({
                url: '<?php echo site_url('raw_materials/delivery_challans/getDoDetails'); ?>',
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
                        str +='<input style="width:100%;" readonly type="hidden" id="item_id_'+i+'" name="s_item_id[]" class="issue form-control" value="'+v.s_item_id+'">';
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
                        str +='<input readonly style="width:100%;"  type="text"  id="stock_qty_'+i+'" name="stock_qty[]" class="issue form-control" value="'+v.qty+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;"  type="text"  id="receive_qty_'+i+'" name="quantity[]" class="issue form-control" value="">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;"  type="text" onchange="calculateTotal()" onkeyup="calculateTotal()" id="price_'+i+'" name="unit_price[]" class="issue form-control" value="">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="text" id="amount_'+i+'" name="amount[]" class="issue form-control" value="">';
                        str +='</td>';
                        
                        str +='<td><input style="width:40px;text-align:right;"  type="checkbox" name="item_select[]"    id="select_product_'+v.item_id+'" class="select_product_'+i+'" value="'+i+'"></td>'; 
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
        
        
  function checkChallanQuantity() {
        
        $('#mytableBody').find('tr').each(function(i, v) {
            
            var do_qty = Number($(this).find('td').eq('5').find('input').val());
            var qty = Number($(this).find('td').eq('6').find('input').val());
            
            if(qty>do_qty){
                $(this).find('td').eq('6').find('input').val('');
                qty=0;
            }  
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
        
       
        
       
        
        if(error==true){
            return false;
        }
    } 
    
 
   
    
    
   
    
    
    
    
    
    
    
    
    
   
</script>

