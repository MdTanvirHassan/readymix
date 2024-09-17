 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; ">Add Product Information </h2>
            <hr>
            <form action="<?php echo site_url('sale_products/add_sale_product_action'); ?>" method="post">
                
                
                <div class="row">
                
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Name <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="product_name" type="text"></div>
                        </div>
                    </div>
                    
                     <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Category<sup style="color:red;">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                <select required id="category_id" class="form-control" name="category_id" onchange="javascript:group_item_id();">
                                    <option class="form-control" value="">Select Category</option>
                                    <?php foreach($categories as $category){ ?>
                                        <option class="form-control" value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                                    <?php } ?>    
                                    
                                    
                               </select>
                            </div>
                        </div>
                   </div>
                   
                </div>
                 <div class="row">      
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Code <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                              <!--  <input required class="form-control" id="inputdefault" name="p_code" type="text">-->
                                <input id="item_c" type="hidden" name="item_c" value="" >
                                <input id="item_code" class="form-control"  name="p_code" type="hidden" value="">
                                <input id="item_code1" disabled  class="form-control"  name="item_code1" type="text" value="">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3   labeltext" style="text-align: right"><label for="inputdefault">PSI <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="p_psi" type="text"></div>
                        </div>
                    </div>
                   
                </div>
                
                 <div class="row">      
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">M. Unit <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="measurement_unit" type="text"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3   labeltext" style="text-align: right"><label for="inputdefault">Specification <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="specification" type="text"></div>
                        </div>
                    </div>
                    
                   
                </div>
                <div class="row">      
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Performance: <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="performance" type="text"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3   labeltext" style="text-align: right"><label for="inputdefault">Remarks  :</label></div>
                            <div class="col-sm-8 col-md-5 "><input  class="form-control" id="inputdefault" name="remark" type="text"></div>
                        </div>
                    </div>
                    
                     
                   
                </div>
                
                <hr>
               
     
              
                
                
                <div class="row">
                   
                        <div class="row">
                            <div class="col-md-2 col-md-offset-3">
                                <button type="submit" class="btn btn-primary button" >SAVE</button>
                            </div>
                            <div class="col-md-2">
                                <a href="<?php echo site_url('backend/sale_products') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                          </div>       
                 
                </div>
                   
                    <div class="col-md-2">
                        <div class="row">
                  <!--          
                    <div class="col-md-12">
                        <button type="button" class="btn btn-default button">SIMILAR LIST</button>
                    </div>-->
                        </div>
                    </div>
                </div>
                
            </form>
        </div>

    <script type="text/javascript">
        
        function validation(){
        var name=$('#customer_name').val();
        var c_short_name=$('#c_short_name').val();
        var key_person=$('#key_person').val();
        var tin_no=$('#tin_no').val();
        var vat_reg=$('#vat_reg').val();
        var c_mobile_no=$('#c_mobile_no').val();
        var c_email=$('#c_email').val();
        var c_contact_address=$('#c_contact_address').val();
        var c_contact_person=$('#c_contact_person').val();
        var head_office_mobile_no=$('#head_office_mobile_no').val();
        var head_office_email=$('#head_office_email').val();
        var error=false;
        
        if(name==''){
            $('#customer_name').css('border','1px solid red');
            $('#customer_name_error').html('Please fill name field');
            error=true;
           
        }else{
            $('#customer_name').css('border','1px solid #ccc');
            $('#customer_name_error').html('');
            
        }
        if(c_short_name==''){
            $('#c_short_name_error').html('Please fill short name field');
            $('#c_short_name').css('border','1px solid red');
             error=true;
        }else{
            $('#c_short_name_error').html('');
            $('#c_short_name').css('border','1px solid #ccc');   
            
        }
        
         if(key_person==''){
            $('#key_person_error').html('Please fill key person field');
            $('#key_person').css('border','1px solid red');
             error=true;
        }else{
            $('#key_person_error').html('');
            $('#key_person').css('border','1px solid #ccc');  
             
        }
        
         if(key_person==''){
            $('#tin_no_error').html('Please fill tin number field');
            $('#tin_no').css('border','1px solid red'); 
            error=true;
        }else{
            $('#tin_no_error').html('');
            $('#tin_no').css('border','1px solid #ccc');   
             
        }
        
        if(vat_reg==''){
            $('#vat_reg_error').html('Please fill  vat registration number field');
            $('#vat_reg').css('border','1px solid red'); 
             error=true;
        }else{
            $('#vat_reg_error').html('');
            $('#vat_reg').css('border','1px solid #ccc');  
             
        }
        
        if(c_mobile_no==''){
            $('#c_mobile_no_error').html('Please fill mobile number field');
            $('#c_mobile_no').css('border','1px solid red'); 
             error=true;
        }else{
            $('#c_mobile_no_error').html('');
            $('#c_mobile_no').css('border','1px solid #ccc');  
             
        }
        
        if(c_email==''){
            $('#c_email_error').html('Please fill email field');
            $('#c_email').css('border','1px solid red'); 
             error=true;
        }else{
            $('#c_email_error').html('');
            $('#c_email').css('border','1px solid #ccc');  
             
        }
        
         if(c_contact_address==''){
            $('#c_contact_address_error').html('Please fill address field');
            $('#c_contact_address').css('border','1px solid red'); 
             error=true;
        }else{
            $('#c_contact_address_error').html('');
            $('#c_contact_address').css('border','1px solid #ccc');  
             
        }
        
        if(c_contact_person==''){
            $('#c_contact_person_error').html('Please fill contact person field');
            $('#c_contact_person').css('border','1px solid red'); 
            error=true;
        }else{
            $('#c_contact_person_error').html('');
            $('#c_contact_person').css('border','1px solid #ccc');  
             
        }
        
        if(head_office_mobile_no==''){
            $('#head_office_mobile_no_error').html('Please fill head office phone field');
            $('#head_office_mobile_no').css('border','1px solid red'); 
            error=true;
        }else{
            $('#head_office_mobile_no_error').html('');
            $('#head_office_mobile_no').css('border','1px solid #ccc');  
             
        }
        
        if(head_office_email==''){
            $('#head_office_email_error').html('Please fill head office email field');
            $('#head_office_email').css('border','1px solid red'); 
            error=true;
        }else{
            $('#head_office_email_error').html('');
            $('#head_office_email').css('border','1px solid #ccc');  
             
        }
        
        if(error==true){
            return false;
        }
    }
        
        
        
      function group_item_id(){
                       var category_id= $('#category_id').val();
                    //   alert(group_id);
                       var data = {'category_id': category_id}
                        $.ajax({
                            url: '<?php echo site_url('sale_products/group_item_id'); ?>',
                            data: data,
                            method: 'POST',
                            dataType: 'json',
                            success: function (msg) {
                                if(msg.category_id!=""){
                                    var item_id=Number(msg.category_id[0].product_code)+1;
                                }else{
                                   item_id=""; 
                                }
                              
                                var item_sl_no;
                                if(item_id!=''){
                                     if(item_id>999){
                                        item_sl_no=item_id;
                                    }else if(item_id>99){
                                        item_sl_no=msg.category_info[0].short_name+"0"+item_id;
                                    }else if(item_id>9){
                                        item_sl_no=msg.category_info[0].short_name+"00"+item_id;
                                    }else{
                                        item_sl_no=msg.category_info[0].short_name+"000"+item_id;
                                    }
                                }else{
                                    item_id=1;
                                    item_sl_no=msg.category_info[0].short_name+'0001';
                                }
                               
                                $('#item_c').val(item_id);
                                $('#item_code').val(item_sl_no);
                                $('#item_code1').val(item_sl_no);
                            }

                       })
                    }
      
    </script>
                    