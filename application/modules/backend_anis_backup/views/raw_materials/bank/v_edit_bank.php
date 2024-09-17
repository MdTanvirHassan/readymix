<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
         <?php       
            require_once(__DIR__ .'/../../rm_setup_header.php');
        ?>
    </div>

    <div class="right_content">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Bank</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <form class="form-horizontal" action="<?php echo site_url('raw_materials/bank/edit_bank_action/'.$bank_info[0]['id']); ?>" method="post" onsubmit="javascript: return validation()">
        <div class='form-group' >
            <label for="title" class="col-sm-2 control-label">
                Bank Type<sup class="required">*</sup>  :
            </label> 
            <div class="col-sm-4 input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select  class="form-control" name="b_identification" id="bank_type">
                    <option value="">Select Bank Type</option>
                    <option <?php if(!empty($bank_info[0]['b_identification'] =='Self')) echo 'selected';  ?> value="Self">Self</option>
                    <option <?php if(!empty($bank_info[0]['b_identification'] =='Customer')) echo 'selected';  ?> value="Customer">Customer</option>
                   
                </select>
                <span id="bank_type_error" style="color:red"></span>
            </div>
           

        </div>
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Code<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input disabled class="form-control" name="b_code1" type="text" value="<?php if(!empty($bank_info[0]['b_code'])) echo $bank_info[0]['b_code']  ?>">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Name<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="b_name" name="b_name" type="text" placeholder="Full Name" value="<?php if(!empty($bank_info[0]['b_name'])) echo $bank_info[0]['b_name']  ?>">
                         <span id="b_name_error" style="color:red"></span>
                                </div>

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    S. Name<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="b_short_name" name="b_short_name" type="text" placeholder="Short Name" value="<?php if(!empty($bank_info[0]['b_short_name'])) echo $bank_info[0]['b_short_name']  ?>">
                        <span id="b_short_name_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Branch Name :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input required="" class="form-control" id="branch_name" name="branch_name" type="text" placeholder="Branch Name" value="<?php if(!empty($bank_info[0]['branch_name'])) echo $bank_info[0]['branch_name']  ?>">
                         <span id="branch_name_error" style="color:red"></span>
                                </div>

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Swift Code<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control" id="b_swift_code" name="b_swift_code" type="text" placeholder="Swift Code" value="<?php if(!empty($bank_info[0]['b_swift_code'])) echo $bank_info[0]['b_swift_code']  ?>">
                         <span id="b_swift_code_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Routing No<sup class="required"></sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                   <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="b_rounting_no" name="b_rounting_no" type="text" placeholder="Routing Number" value="<?php if(!empty($bank_info[0]['b_rounting_no'])) echo $bank_info[0]['b_rounting_no']  ?>">
                        <span id="b_rounting_no_error" style="color:red"></span>
                                </div>

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Account Type<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="b_account_type" name="b_account_type" type="text" placeholder="Account Type" value="<?php if(!empty($bank_info[0]['b_account_type'])) echo $bank_info[0]['b_account_type']  ?>">
                            <span id="b_account_type_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Account No<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                   <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input  class="form-control" id="b_account_no" name="b_account_no" type="text" placeholder="Account Number" value="<?php if(!empty($bank_info[0]['b_account_no'])) echo $bank_info[0]['b_account_no']  ?>">
                            <span id="b_account_no_error" style="color:red"></span>
                                </div>

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Mobile No:
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="b_mobile_no" name="b_mobile_no" type="text" placeholder="Mobile Number" value="<?php if(!empty($bank_info[0]['b_mobile_no'])) echo $bank_info[0]['b_mobile_no']  ?>">
                            <span id="b_mobile_no_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Land Phone<sup class="required"></sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control" id="b_land_phone" name="b_land_phone" type="text" placeholder="Land Phone" value="<?php if(!empty($bank_info[0]['b_land_phone'])) echo $bank_info[0]['b_land_phone']  ?>">
                        <span id="b_land_phone_error" style="color:red"></span>
                                </div>

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Email :
                                </label> 
                                <div class="col-sm-4 input-group">
                                   <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="b_email" name="b_email" type="text" value="<?php if(!empty($bank_info[0]['b_email'])) echo $bank_info[0]['b_email']  ?>">
                      <span id="b_email_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Address:
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <textarea rows="3" class="form-control" id="b_address" name="b_address" placeholder="Address"><?php if(!empty($bank_info[0]['b_address'])) echo $bank_info[0]['b_address']  ?></textarea>
                      <span id="b_address_error" style="color:red"></span>
                                </div>

                            </div>
        
        
<!--        <div class="row">
           
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"> <label for="inputdefault">Code<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-8  ">
                         <input disabled class="form-control" name="b_code1" type="text" value="<?php if(!empty($bank_info[0]['b_code'])) echo $bank_info[0]['b_code']  ?>">
                        
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 ">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="c_name">Name<sup style="color:red;">*</sup>  :</label></div>
                    <div class="col-sm-8 col-md-8  "> 
                        <input  class="form-control" id="b_name" name="b_name" type="text" placeholder="Full Name" value="<?php if(!empty($bank_info[0]['b_name'])) echo $bank_info[0]['b_name']  ?>">
                         <span id="b_name_error" style="color:red"></span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="c_short_name">S. Name<sup style="color:red;">*</sup>  :</label></div>
                    <div class="col-sm-8 col-md-8  ">
                        <input  class="form-control" id="b_short_name" name="b_short_name" type="text" placeholder="Short Name" value="<?php if(!empty($bank_info[0]['b_short_name'])) echo $bank_info[0]['b_short_name']  ?>">
                        <span id="b_short_name_error" style="color:red"></span>
                    </div>
                </div>
            </div>
            
                
            
        </div>-->
<!--            <div class="row">
           
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"> <label for="inputdefault">Branch Name<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-8  ">
                        <input  class="form-control" id="branch_name" name="branch_name" type="text" placeholder="Branch Name" value="<?php if(!empty($bank_info[0]['branch_name'])) echo $bank_info[0]['branch_name']  ?>">
                         <span id="branch_name_error" style="color:red"></span>
                        
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 ">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="c_name">Swift Code :</label></div>
                    <div class="col-sm-8 col-md-8  "> 
                        <input class="form-control" id="b_swift_code" name="b_swift_code" type="text" placeholder="Swift Code" value="<?php if(!empty($bank_info[0]['b_swift_code'])) echo $bank_info[0]['b_swift_code']  ?>">
                         <span id="b_swift_code_error" style="color:red"></span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="c_short_name">Routing No.<sup style="color:red;">*</sup>  :</label></div>
                    <div class="col-sm-8 col-md-8  ">
                        <input  class="form-control" id="b_rounting_no" name="b_rounting_no" type="text" placeholder="Routing Number" value="<?php if(!empty($bank_info[0]['b_rounting_no'])) echo $bank_info[0]['b_rounting_no']  ?>">
                        <span id="b_rounting_no_error" style="color:red"></span>
                    </div>
                </div>
            </div>
            
                
            
        </div>-->
        
<!--        <div class="row">
           
                <div class="col-md-4">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"> <label for="inputdefault">Account Type:</label></div>
                        <div class="col-sm-8 col-md-8  ">
                            <input  class="form-control" id="b_account_type" name="b_account_type" type="text" placeholder="Account Type" value="<?php if(!empty($bank_info[0]['b_account_type'])) echo $bank_info[0]['b_account_type']  ?>">
                            <span id="b_account_type_error" style="color:red"></span>

                        </div>
                    </div>
                </div>
            
                <div class="col-md-4 ">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="c_name">Account No. :</label></div>
                        <div class="col-sm-8 col-md-8  "> 
                            <input class="form-control" id="b_account_no" name="b_account_no" type="text" placeholder="Account Number" value="<?php if(!empty($bank_info[0]['b_account_no'])) echo $bank_info[0]['b_account_no']  ?>">
                            <span id="b_account_no_error" style="color:red"></span>
                        </div>
                    </div>
                </div>
            
                <div class="col-md-4">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="c_short_name">Mobile No.<sup style="color:red;">*</sup>  :</label></div>
                        <div class="col-sm-8 col-md-8  ">
                            <input  class="form-control" id="b_mobile_no" name="b_mobile_no" type="text" placeholder="Mobile Number" value="<?php if(!empty($bank_info[0]['b_mobile_no'])) echo $bank_info[0]['b_mobile_no']  ?>">
                            <span id="b_mobile_no_error" style="color:red"></span>
                        </div>
                    </div>
                </div>
            
                
            
        </div>-->
        
<!--            <div class="row">
           
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"> <label for="inputdefault">Land Phone :</label></div>
                    <div class="col-sm-8 col-md-8  ">
                        <input class="form-control" id="b_land_phone" name="b_land_phone" type="text" placeholder="Land Phone" value="<?php if(!empty($bank_info[0]['b_land_phone'])) echo $bank_info[0]['b_land_phone']  ?>">
                        <span id="b_land_phone_error" style="color:red"></span>
                        
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 ">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="c_name">Email<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-8  "> 
                      <input  class="form-control" id="b_email" name="b_email" type="text" value="<?php if(!empty($bank_info[0]['b_email'])) echo $bank_info[0]['b_email']  ?>">
                      <span id="b_email_error" style="color:red"></span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="">Address<sup style="color:red;">*</sup>  :</label></div>
                    <div class="col-sm-8 col-md-8  ">
                        <textarea rows="3" class="form-control" id="b_address" name="b_address" placeholder="Address"><?php if(!empty($bank_info[0]['b_address'])) echo $bank_info[0]['b_address']  ?></textarea>
                      <span id="b_address_error" style="color:red"></span>
                    </div>
                </div>
            </div>
            
                
            
        </div> -->
        <div class="form-group" style="margin-top: 40px;">
            
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/raw_materials/bank') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
                                </div>
            
                                <div class=" col-sm-2">
                                    <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">UPDATE</button>
                                </div>
                               
                            </div>
<!--        <div class="row">
           <div class="col-md-1 col-md-offset-3">
                <a href="<?php echo site_url('backend/bank') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">REGISTER</button> </a>
           </div>
           <div class="col-md-2 ">
                <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">UPDATE</button>
           </div>
             
        </div> -->
            
        
    </form>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
     function validation(){
        var bank_type=$('#bank_type').val();
        var b_name=$('#b_name').val();
        var b_short_name=$('#b_short_name').val();
        var branch_name=$('#branch_name').val();
        var b_mobile_no=$('#b_mobile_no').val();
        var b_email=$('#b_email').val();
        var b_address=$('#b_address').val();
        var b_account_no=$('#b_account_no').val();
        
        var error=false;
        
        if(bank_type==''){
            $('#bank_type').css('border','1px solid red');
            $('#bank_type_error').html('Please select bank type');
            error=true;
           
        }else{
            $('#bank_type').css('border','1px solid #ccc');
            $('#bank_type_error').html('');
            if(bank_type=='Self'){
                if(b_account_no==''){
                    $('#b_account_no').css('border','1px solid red');
                    $('#b_account_no_error').html('Please fill bank accont no');
                    error=true;
                }else{
                    $('#b_account_no').css('border','1px solid #ccc');
                    $('#b_account_no_error').html(''); 
                }
           }else{
               $('#b_account_no').css('border','1px solid #ccc');
               $('#b_account_no_error').html(''); 
           }
            
        }
        
        if(b_name==''){
            $('#b_name').css('border','1px solid red');
            $('#b_name_error').html('Please fill name field');
            error=true;
           
        }else{
            $('#b_name').css('border','1px solid #ccc');
            $('#b_name_error').html('');
            
        }
        if(b_short_name==''){
            $('#b_short_name_error').html('Please fill short name field');
            $('#b_short_name').css('border','1px solid red');
             error=true;
        }else{
            $('#b_short_name_error').html('');
            $('#b_short_name').css('border','1px solid #ccc');   
            
        }
        
        if(bank_type!='Customer'){
            if(branch_name==''){
               $('#branch_name_error').html('Please fill branch name field');
               $('#branch_name').css('border','1px solid red');
               error=true;
           }else{
               $('#branch_name_error').html('');
               $('#branch_name').css('border','1px solid #ccc');  

           }
       }else{
           $('#branch_name_error').html('');
           $('#branch_name').css('border','1px solid #ccc');  
       }
        
         if(b_mobile_no==''){
//            $('#b_mobile_no_error').html('Please fill mobile number field');
//            $('#b_mobile_no').css('border','1px solid red'); 
//            error=true;
        }else{
            $('#b_mobile_no_error').html('');
            $('#b_mobile_no').css('border','1px solid #ccc');   
             
        }
        
        if(b_email==''){
//            $('#b_email_error').html('Please fill email field');
//            $('#b_email').css('border','1px solid red'); 
//             error=true;
        }else{
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(b_email)) {
                $('#b_email_error').html('Invalid email address');
                $('#b_email').css('border','1px solid red');  
                error=true;
            }else{
                $('#b_email_error').html('');
                $('#b_email').css('border','1px solid #ccc');  
            }
            
             
        }
        
        if(b_address==''){
//            $('#b_address_error').html('Please fill address field');
//            $('#b_address').css('border','1px solid red'); 
//            error=true;
        }else{
            $('#b_address_error').html('');
            $('#b_address').css('border','1px solid #ccc');  
             
        }
        
       
        if(error==true){
            return false;
        }
    }

</script>    