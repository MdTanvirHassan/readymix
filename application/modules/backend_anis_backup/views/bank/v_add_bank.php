
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(7, 18, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) { ?> 
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'customers') echo 'active'; ?>" href="<?php echo site_url('backend/customers'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Customers</span>
                        </a>
                    </li>
                <?php } ?> 
<?php $this->role = checkUserPermission(7, 19, $userData);
if (empty($this->role) || !in_array(11, $this->role)) { ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'bank') echo 'active'; ?>" href="<?php echo site_url('backend/bank'); ?>">
                            <i class="fa fa-university"></i><br><span>Bank</span></a>
                    </li>
<?php } ?>
<?php $this->role = checkUserPermission(7, 20, $userData);
if (empty($this->role) || !in_array(11, $this->role)) { ?>          
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'product_category') echo 'active'; ?>" href="<?php echo site_url('backend/product_categories'); ?>">
                            <i class="fa fa-object-group"></i><br><span>Categories</span></a>
                    </li>
<?php } ?>
<?php $this->role = checkUserPermission(7, 21, $userData);
if (empty($this->role) || !in_array(11, $this->role)) { ?>    
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'sales_product') echo 'active'; ?>" href="<?php echo site_url('backend/sale_products'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Products</span></a>
                    </li>
<?php } ?>
                <?php $this->role = checkUserPermission(7, 22, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) { ?>       
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'product_mixing') echo 'active'; ?>" href="<?php echo site_url('backend/products_mixing'); ?>">
                            <i class="fa fa-cubes"></i><br><span>Products Mixing</span></a>
                    </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(7, 23, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) { ?>          
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'project') echo 'active'; ?>" href="<?php echo site_url('backend/projects'); ?>">
                            <i class="fa fa-home"></i><br><span>Projects</span></a>
                    </li>
<?php } ?>

            </ul>
        </div>
    </div>

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Bank</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <form class="form-horizontal"  action="<?php echo site_url('bank/add_bank_action'); ?>" method="post" onsubmit="javascript: return validation()">
      
         <div class='form-group' >
            <label for="title" class="col-sm-2 control-label">
                Bank Type<sup class="required">*</sup>  :
            </label> 
            <div class="col-sm-4 input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select  class="form-control" name="b_identification" id="bank_type">
                    <option value="">Select Bank Type</option>
                    <option value="Self">Self</option>
                    <option value="Customer">Customer</option>
                    <option value="Supplier">Supplier</option>
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
                                    <input type="hidden" name="bank_code" value="<?php if(!empty($bank_code)) echo $bank_code; ?>" >
                         <input class="form-control" name="b_code" type="hidden" value="<?php if(!empty($bank_auto_code)) echo 'B'.$bank_auto_code; ?>">
                         <input disabled class="form-control" name="b_code1" type="text" value="<?php if(!empty($bank_auto_code)) echo 'B'.$bank_auto_code; ?>">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Name<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="b_name" name="b_name" type="text" placeholder="Full Name">
                         <span id="b_name_error" style="color:red"></span>
                                </div>

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    S. Name<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="b_short_name" name="b_short_name" type="text" placeholder="Short Name">
                        <span id="b_short_name_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Branch Name :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input   class="form-control" id="branch_name" name="branch_name" type="text" placeholder="Branch Name">
                         <span id="branch_name_error" style="color:red"></span>
                                </div>

                            </div>
        
         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Swift Code<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control" id="b_swift_code" name="b_swift_code" type="text" placeholder="Swift Code">
                         <span id="b_swift_code_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Routing No<sup class="required"></sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="b_rounting_no" name="b_rounting_no" type="text" placeholder="Routing Number">
                        <span id="b_rounting_no_error" style="color:red"></span>
                                </div>

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Account Type<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="b_account_type" name="b_account_type" type="text" placeholder="Account Type">
                            <span id="b_account_type_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Account No<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="b_account_no" name="b_account_no" type="text" placeholder="Account Number">
                             <span id="b_account_no_error" style="color:red"></span>
                                </div>

                            </div>
        
        
         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Mobile No:
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="b_mobile_no" name="b_mobile_no" type="text" placeholder="Mobile Number">
                            <span id="b_mobile_no_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Land Phone<sup class="required"></sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control" id="b_land_phone" name="b_land_phone" type="text" placeholder="Land Phone">
                        <span id="b_land_phone_error" style="color:red"></span>
                                </div>

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Email:
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="b_email" name="b_email" type="text">
                      <span id="b_email_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Address:
                                </label>
                                <div class="col-sm-4 input-group">
                                   <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <textarea rows="3" class="form-control" id="b_address" name="b_address" placeholder="Address"></textarea>
                      <span id="b_address_error" style="color:red"></span>
                                </div>

                            </div>
        
        
        
<!--            <div class="row">
           
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;">
                        <label for="inputdefault">Code<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-8  ">
                         <input type="hidden" name="bank_code" value="<?php if(!empty($bank_code)) echo $bank_code; ?>" >
                         <input class="form-control" name="b_code" type="hidden" value="<?php if(!empty($bank_auto_code)) echo 'B'.$bank_auto_code; ?>">
                         <input disabled class="form-control" name="b_code1" type="text" value="<?php if(!empty($bank_auto_code)) echo 'B'.$bank_auto_code; ?>">
                        
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 ">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;">
                        <label for="c_name">Name<sup style="color:red;">*</sup>  :</label></div>
                    <div class="col-sm-8 col-md-8  "> 
                        <input  class="form-control" id="b_name" name="b_name" type="text" placeholder="Full Name">
                         <span id="b_name_error" style="color:red"></span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;">
                        <label for="c_short_name">S. Name<sup style="color:red;">*</sup>  :</label></div>
                    <div class="col-sm-8 col-md-8  ">
                        <input  class="form-control" id="b_short_name" name="b_short_name" type="text" placeholder="Short Name">
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
                        <input  class="form-control" id="branch_name" name="branch_name" type="text" placeholder="Branch Name">
                         <span id="branch_name_error" style="color:red"></span>
                        
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 ">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="c_name">Swift Code :</label></div>
                    <div class="col-sm-8 col-md-8  "> 
                        <input class="form-control" id="b_swift_code" name="b_swift_code" type="text" placeholder="Swift Code">
                         <span id="b_swift_code_error" style="color:red"></span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;">
                        <label for="c_short_name">Routing No.  :</label></div>
                    <div class="col-sm-8 col-md-8  ">
                        <input  class="form-control" id="b_rounting_no" name="b_rounting_no" type="text" placeholder="Routing Number">
                        <span id="b_rounting_no_error" style="color:red"></span>
                    </div>
                </div>
            </div>
            
                
            
        </div>-->
        
<!--         <div class="row">
           
                <div class="col-md-4">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"> <label for="inputdefault">Account Type:</label></div>
                        <div class="col-sm-8 col-md-8  ">
                            <input  class="form-control" id="b_account_type" name="b_account_type" type="text" placeholder="Account Type">
                            <span id="b_account_type_error" style="color:red"></span>

                        </div>
                    </div>
                </div>
            
                <div class="col-md-4 ">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="c_name">Account No. :</label></div>
                        <div class="col-sm-8 col-md-8  "> 
                            <input class="form-control" id="b_account_no" name="b_account_no" type="text" placeholder="Account Number">
                             <span id="b_account_no_error" style="color:red"></span>
                        </div>
                    </div>
                </div>
            
                <div class="col-md-4">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="c_short_name">Mobile No.<sup style="color:red;">*</sup>  :</label></div>
                        <div class="col-sm-8 col-md-8  ">
                            <input  class="form-control" id="b_mobile_no" name="b_mobile_no" type="text" placeholder="Mobile Number">
                            <span id="b_mobile_no_error" style="color:red"></span>
                        </div>
                    </div>
                </div>
            
                
            
        </div>-->
        
<!--            <div class="row">
           
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;">
                        <label for="inputdefault">Land Phone :</label></div>
                    <div class="col-sm-8 col-md-8  ">
                        <input class="form-control" id="b_land_phone" name="b_land_phone" type="text" placeholder="Land Phone">
                        <span id="b_land_phone_error" style="color:red"></span>
                        
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 ">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="c_name">Email<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-8  "> 
                      <input  class="form-control" id="b_email" name="b_email" type="text">
                      <span id="b_email_error" style="color:red"></span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="">Address<sup style="color:red;">*</sup>  :</label></div>
                    <div class="col-sm-8 col-md-8  ">
                        <textarea rows="3" class="form-control" id="b_address" name="b_address" placeholder="Address"></textarea>
                      <span id="b_address_error" style="color:red"></span>
                    </div>
                </div>
            </div>
            
                
            
        </div> -->
            
        <div class="form-group" style="margin-top: 40px;">
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/bank') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
                                </div>
            
                                <div class=" col-sm-2">
                                    <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">SAVE</button>
                                </div>
                                
                            </div>
<!--        <div class="row">
           <div class="col-md-1 col-md-offset-3">
                <a href="<?php echo site_url('backend/bank') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">REGISTER</button> </a>
            </div>
            <div class="col-md-2 ">
                <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">SAVE</button>
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