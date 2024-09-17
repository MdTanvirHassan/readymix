<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
            <?php       
                require_once(__DIR__ .'/../../rm_setup_header.php');
            ?>
    </div>

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Company</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal"  action="<?php echo site_url('raw_materials/transport_companies/add_transport_company_action'); ?>" method="post" onsubmit="javascript: return validation()"  >
                            <div class="row">
                                <h2><b>Company Info</b></h2>
                                    <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label">
                                        C. ID<sup class="required">*</sup>  :
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="hidden" name="customer_code" value="<?php if (!empty($customer_code)) echo $customer_code; ?>" >
                                        <input class="form-control" name="c_code" type="hidden" value="<?php if (!empty($customer_auto_code)) echo 'C' . $customer_auto_code; ?>">
                                        <input disabled class="form-control" name="c_code1" type="text" value="<?php if (!empty($customer_auto_code)) echo 'C' . $customer_auto_code; ?>">
                                    </div>
                                    <label for="title" class="col-sm-2 control-label">
                                        Company Name<sup class="required">*</sup> :
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input  class="form-control" id="customer_name" name="c_name" type="text" placeholder="Company Name">
                                        <span id="customer_name_error" style="color:red"></span>
                                    </div>

                                </div>
                            </div> 
                            
                            <div class="row">
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            S. Name<sup class="required">*</sup>  :
                                        </label> 
                                        <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input  class="form-control" id="c_short_name" name="c_short_name" type="text" placeholder="Company Short Name">
                                            <span id="c_short_name_error" style="color:red"></span>
                                        </div>
                                         <label for="title" class="col-sm-2 control-label">
                                            Address<sup class="required">*</sup>  :
                                        </label> 
                                        <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input  class="form-control" id="c_contact_address" name="c_contact_address" type="text" placeholder="Head Office Address">
                                            <span id="c_contact_address_error" style="color:red"></span>
                                        </div>
                                        

                                    </div>

                            </div>
                            
                            <div class="row">
                                    <div class='form-group' >
                                     <label for="title" class="col-sm-2 control-label">
                                         H. O. Mobile<sup class="required"></sup>  :
                                     </label> 
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <input  class="form-control" id="head_office_mobile_no" name="head_office_mobile_no" type="text" placeholder="Head Mobile Phone No.">
                                         <span id="head_office_mobile_no_error" style="color:red"></span>
                                     </div>
                                        
                                       <label for="title" class="col-sm-2 control-label">
                                         H. O. Phone  :
                                     </label> 
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <input  class="form-control" id="head_office_phone_no" name="head_office_phone_no" type="text" placeholder="Head Office Phone No.">
                                         <span id="head_office_mobile_no_error" style="color:red"></span>
                                     </div>  
                                     

                                 </div> 
                            </div>
                            
                            
                            <div class="row">
                                <div class='form-group' >
                                    
                                    <label for="title" class="col-sm-2 control-label">
                                         H.O. Email<sup class="required"></sup> :
                                     </label>
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <input  class="form-control" id="head_office_email" name="head_office_email" type="text" placeholder="Head Office Email">
                                         <span id="head_office_email_error" style="color:red"></span>
                                     </div>
                                    
                                    <label for="title" class="col-sm-2 control-label">
                                       Tin No.<sup class="required"></sup>  :
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input  class="form-control" id="tin_no" name="tin_no" type="text" placeholder="Tin Number">
                                        <span id="tin_no_error" style="color:red"></span>
                                    </div>
                                    

                                </div>
                            </div>     
                            
                            <div class="row">
                                <label for="title" class="col-sm-2 control-label">
                                        Vat Reg.<sup class="required"></sup> :
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input  class="form-control" id="vat_reg" name="vat_reg" type="text" placeholder="Vat Reg.">
                                        <span id="vat_reg_error" style="color:red"></span>
                                    </div>
                            </div>
                            
                            <div class="row">
                                
                                <h2><b>Key Person Info</b></h2>
                                <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            Key. P<sup class="required"></sup> :
                                        </label>
                                        <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input  class="form-control" id="key_person" name="key_person" type="text" placeholder="Key Person Name">
                                            <span id="key_person_error" style="color:red"></span>
                                       </div>
                                        <label for="title" class="col-sm-2 control-label">
                                            Phone<sup class="required"></sup> :
                                        </label>
                                        <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input  class="form-control" id="key_person_phone" name="key_person_phone" type="text" placeholder="Mobile Phone Number">
                                            <span id="key_person_phone_error" style="color:red"></span>
                                       </div>
                                      
                                    </div>
                                
                               </div> 
                            
                            
                            <div class="row">
                                
                               <div class='form-group' >  
                                   
                                    <label for="title" class="col-sm-2 control-label">
                                            Email<sup class="required"></sup>  :
                                        </label> 
                                        <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input  class="form-control" id="key_person_email" name="key_person_email" type="text" placeholder="Keyperson Email">
                                            <span id="key_person_email_error" style="color:red"></span>
                                        </div> 
                                 
                               </div>  
                                
                            </div>  
                            
                            <div class="row">
                                    <h2><b>Contact Person Info</b></h2>
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            C. person<sup class="required"></sup> :
                                        </label>
                                        <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input  class="form-control" id="c_contact_person" name="c_contact_person" type="text" placeholder="Contact Person Name">
                                            <span id="c_contact_person_error" style="color:red"></span>
                                        </div>
                                        
                                        <label for="title" class="col-sm-2 control-label">
                                            Phone<sup class="required"></sup>  :
                                        </label> 
                                        <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input  class="form-control" id="c_mobile_no" name="c_mobile_no" type="text" placeholder="Mobile Phone Number">
                                            <span id="c_mobile_no_error" style="color:red"></span>
                                        </div>

                                        
                                        

                                    </div>
                            </div> 
                            <div class="row">
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            Email<sup class="required"></sup> :
                                        </label>
                                        <div class="col-sm-4 input-group">
                                           <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input  class="form-control" id="c_email" name="c_email" type="text" placeholder="Contact Person Email">
                                            <span id="c_email_error" style="color:red"></span>
                                        </div>
                                        
                                        
                                        <label for="title" class="col-sm-2 control-label">
                                            Transport Type<sup class="required">*</sup> :
                                        </label>
                                        <div class="col-sm-4 input-group">
                                           <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                           <select required id="transport_type" class="form-control" name="transport_type">
                                               <option value="">Select Type</option>
                                               <option value="Truck">Truck</option>
                                               <option value="Ship">Ship</option>
                                           </select>
                                            <span id="transport_type_error" style="color:red"></span>
                                        </div>
                                        
                                    </div>
                            </div>     
                            

                            


                            <div class="form-group" style="margin-top: 40px;">
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/raw_materials/transport_companies') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
                                </div>
                                
                                <div class=" col-sm-2">
                                    <button type="submit" class="btn btn-primary button" onclick="javascript:validation();" >SAVE</button>
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
    function validation() {
        var name = $('#customer_name').val();
        var c_short_name = $('#c_short_name').val();
        var c_contact_address = $('#c_contact_address').val();
        var head_office_mobile_no = $('#head_office_mobile_no').val();
        var head_office_email = $('#head_office_email').val();
        var tin_no = $('#tin_no').val();
        var vat_reg = $('#vat_reg').val();
        
        var key_person = $('#key_person').val();
        var key_person_email = $('#key_person_email').val();
        
       
        var c_contact_person = $('#c_contact_person').val();
        var c_mobile_no = $('#c_mobile_no').val();
        var c_email = $('#c_email').val();
        
        var error = false;

        if (name == '') {
            $('#customer_name').css('border', '1px solid red');
            $('#customer_name_error').html('Please fill name field');
            error = true;

        } else {
            $('#customer_name').css('border', '1px solid #ccc');
            $('#customer_name_error').html('');

        }
        if (c_short_name == '') {
            $('#c_short_name_error').html('Please fill short name field');
            $('#c_short_name').css('border', '1px solid red');
            error = true;
        } else {
            $('#c_short_name_error').html('');
            $('#c_short_name').css('border', '1px solid #ccc');

        }
        
        if (c_contact_address == '') {
            $('#c_contact_address_error').html('Please fill address field');
            $('#c_contact_address').css('border', '1px solid red');
            error = true;
        } else {
            $('#c_contact_address_error').html('');
            $('#c_contact_address').css('border', '1px solid #ccc');

        }
        
        
        if (head_office_mobile_no == '') {
//            $('#head_office_mobile_no_error').html('Please fill head office phone field');
//            $('#head_office_mobile_no').css('border', '1px solid red');
//            error = true;
        } else {
            $('#head_office_mobile_no_error').html('');
            $('#head_office_mobile_no').css('border', '1px solid #ccc');

        }

        
        
        
        if (head_office_email == '') {
//            $('#head_office_email_error').html('Please fill head office email field');
//            $('#head_office_email').css('border', '1px solid red');
//            error = true;
        } else {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(head_office_email)) {
                $('#head_office_email_error').html('Invalid email address');
                $('#head_office_email').css('border', '1px solid red');
                error = true;
            } else {
                $('#head_office_email_error').html('');
                $('#head_office_email').css('border', '1px solid #ccc');
            }


        }
        
//         if (tin_no == '') {
//            $('#tin_no_error').html('Please fill tin number field');
//            $('#tin_no').css('border', '1px solid red');
//            error = true;
//        } else {
//            $('#tin_no_error').html('');
//            $('#tin_no').css('border', '1px solid #ccc');
//
//        }
//        
//        
//        if (vat_reg == '') {
//            $('#vat_reg_error').html('Please fill  vat registration number field');
//            $('#vat_reg').css('border', '1px solid red');
//            error = true;
//        } else {
//            $('#vat_reg_error').html('');
//            $('#vat_reg').css('border', '1px solid #ccc');
//
//        }

//        if (key_person == '') {
//            $('#key_person_error').html('Please fill key person field');
//            $('#key_person').css('border', '1px solid red');
//            error = true;
//        } else {
//            $('#key_person_error').html('');
//            $('#key_person').css('border', '1px solid #ccc');
//
//        }

        if (key_person_email == '') {
//            $('#c_email_error').html('Please fill email field');
//            $('#c_email').css('border', '1px solid red');
//            error = true;
        } else {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(key_person_email)) {
                $('#key_person_email_error').html('Invalid email address');
                $('#key_person_email').css('border', '1px solid red');
                error = true;
            } else {
                $('#key_person_email_error').html('');
                $('#key_person_email').css('border', '1px solid #ccc');
            }


        }

       
       if(c_contact_person == '') {
//            $('#c_contact_person_error').html('Please fill contact person field');
//            $('#c_contact_person').css('border', '1px solid red');
//            error = true;
        } else {
            $('#c_contact_person_error').html('');
            $('#c_contact_person').css('border', '1px solid #ccc');

        }

       
       
        if (c_mobile_no == '') {
//            $('#c_mobile_no_error').html('Please fill mobile number field');
//            $('#c_mobile_no').css('border', '1px solid red');
//            error = true;
        } else {

            $('#c_mobile_no_error').html('');
            $('#c_mobile_no').css('border', '1px solid #ccc');


        }

        if (c_email == '') {
//            $('#c_email_error').html('Please fill email field');
//            $('#c_email').css('border', '1px solid red');
//            error = true;
        } else {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(c_email)) {
                $('#c_email_error').html('Invalid email address');
                $('#c_email').css('border', '1px solid red');
                error = true;
            } else {
                $('#c_email_error').html('');
                $('#c_email').css('border', '1px solid #ccc');
            }


        }

        if (error == true) {
            return false;
        }
    }

//    $('#save').onClick(function(){
//          alert('test');
//        var name=$('#customer_name').val();
//        if(name==''){
//            $('#customer_name_error').html('Please fill name field');
//            return false;
//        }
////        $('#task_name').css('border','1px solid #ccc');
//    }
</script>    