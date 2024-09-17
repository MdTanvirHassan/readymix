<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(7, 18, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) {
                    ?> 
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'customers') echo 'active'; ?>" href="<?php echo site_url('backend/customers'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Customers</span>
                        </a>
                    </li>
                <?php } ?> 
                <?php $this->role = checkUserPermission(7, 19, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) {
                    ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'bank') echo 'active'; ?>" href="<?php echo site_url('backend/bank'); ?>">
                            <i class="fa fa-university"></i><br><span>Bank</span></a>
                    </li>
                <?php } ?>
<?php $this->role = checkUserPermission(7, 20, $userData);
if (empty($this->role) || !in_array(11, $this->role)) {
    ?>          
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'product_category') echo 'active'; ?>" href="<?php echo site_url('backend/product_categories'); ?>">
                            <i class="fa fa-object-group"></i><br><span>Categories</span></a>
                    </li>
<?php } ?>
<?php $this->role = checkUserPermission(7, 21, $userData);
if (empty($this->role) || !in_array(11, $this->role)) {
    ?>    
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'sales_product') echo 'active'; ?>" href="<?php echo site_url('backend/sale_products'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Products</span></a>
                    </li>
<?php } ?>
<?php $this->role = checkUserPermission(7, 22, $userData);
if (empty($this->role) || !in_array(11, $this->role)) {
    ?>       
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'product_mixing') echo 'active'; ?>" href="<?php echo site_url('backend/products_mixing'); ?>">
                            <i class="fa fa-cubes"></i><br><span>Products Mixing</span></a>
                    </li>
<?php } ?>
                <?php $this->role = checkUserPermission(7, 23, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) {
                    ?>          
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
                <h3>Edit Customer</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" action="<?php echo site_url('customers/edit_customer_action/' . $customer_info[0]['id']); ?>" method="post" onsubmit="javascript: return validation()" >
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    C. ID<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input disabled class="form-control" name="c_code1" type="text" value="<?php if (!empty($customer_info[0]['c_code'])) echo $customer_info[0]['c_code']; ?>"">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Name<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control" id="customer_name" name="c_name" type="text" placeholder="Full Name" value="<?php if (!empty($customer_info[0]['c_name'])) echo $customer_info[0]['c_name']; ?>">
                                    <span id="customer_name_error" style="color:red"></span>
                                </div>

                            </div>

                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    S. Name<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="c_short_name" name="c_short_name" type="text" placeholder="Short Name" value="<?php if (!empty($customer_info[0]['c_short_name'])) echo $customer_info[0]['c_short_name']; ?>">
                                    <span id="c_short_name_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Key. P<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control" id="key_person" name="key_person" type="text" placeholder="Key Person" value="<?php if (!empty($customer_info[0]['key_person'])) echo $customer_info[0]['key_person']; ?>">
                                    <span id="key_person_error" style="color:red"></span>
                                </div>

                            </div>

                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Tin No.<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="tin_no" name="tin_no" type="text" placeholder="Tin Number" value="<?php if (!empty($customer_info[0]['tin_no'])) echo $customer_info[0]['tin_no']; ?>">
                                    <span id="tin_no_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Vat Reg.<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control" id="vat_reg" name="vat_reg" type="text" placeholder="Vat Reg." value="<?php if (!empty($customer_info[0]['vat_reg'])) echo $customer_info[0]['vat_reg']; ?>">
                                    <span id="vat_reg_error" style="color:red"></span>
                                </div>

                            </div>

                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Phone<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="c_mobile_no" name="c_mobile_no" type="text" placeholder="Mobile Phone Number" value="<?php if (!empty($customer_info[0]['c_mobile_no'])) echo $customer_info[0]['c_mobile_no']; ?>">
                                    <span id="c_mobile_no_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Email<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control" id="c_email" name="c_email" type="text" placeholder="Email" value="<?php if (!empty($customer_info[0]['c_email'])) echo $customer_info[0]['c_email']; ?>">
                                    <span id="c_email_error" style="color:red"></span>
                                </div>

                            </div>

                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Address<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="c_contact_address" name="c_contact_address" type="text" placeholder="Head Office Address" value="<?php if (!empty($customer_info[0]['c_contact_address'])) echo $customer_info[0]['c_contact_address']; ?>">
                                    <span id="c_contact_address_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    C. person<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control" id="c_contact_person" name="c_contact_person" type="text" placeholder="Contact Person" value="<?php if (!empty($customer_info[0]['c_contact_person'])) echo $customer_info[0]['c_contact_person']; ?>">
                                    <span id="c_contact_person_error" style="color:red"></span>
                                </div>

                            </div>

                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    H. O. Phone<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="head_office_mobile_no" name="head_office_mobile_no" type="text" placeholder="Head Office Phone No." value="<?php if (!empty($customer_info[0]['head_office_mobile_no'])) echo $customer_info[0]['head_office_mobile_no']; ?>">
                                    <span id="head_office_mobile_no_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    H.O. Email<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control" id="head_office_email" name="head_office_email" type="text" placeholder="Head Office Email" value="<?php if (!empty($customer_info[0]['head_office_email'])) echo $customer_info[0]['head_office_email']; ?>">
                                    <span id="head_office_email_error" style="color:red"></span>
                                </div>

                            </div>

                            <!--         <div class="row">
                                       
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;">
                                                    <label for="inputdefault">C. ID<sup style="color:red;">*</sup> :</label></div>
                                                <div class="col-sm-8 col-md-8  ">
                                                    <input disabled class="form-control" name="c_code1" type="text" value="<?php if (!empty($customer_info[0]['c_code'])) echo $customer_info[0]['c_code']; ?>"">
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 ">
                                            <div class="form-group row">
                                                <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="c_name">Name<sup style="color:red;">*</sup>  :</label></div>
                                                <div class="col-sm-8 col-md-8  "> 
                                                    <input  class="form-control" id="customer_name" name="c_name" type="text" placeholder="Full Name" value="<?php if (!empty($customer_info[0]['c_name'])) echo $customer_info[0]['c_name']; ?>">
                                                     <span id="customer_name_error" style="color:red"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="c_short_name">S. Name<sup style="color:red;">*</sup>  :</label></div>
                                                <div class="col-sm-8 col-md-8  ">
                                                    <input  class="form-control" id="c_short_name" name="c_short_name" type="text" placeholder="Short Name" value="<?php if (!empty($customer_info[0]['c_short_name'])) echo $customer_info[0]['c_short_name']; ?>">
                                                    <span id="c_short_name_error" style="color:red"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                            
                                        
                                    </div>-->

                            <!--        <div class="row">
                                         <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="inputdefault">Key P.<sup style="color:red;">*</sup>  :</label></div>
                                                <div class="col-sm-8 col-md-8  ">
                                                    <input  class="form-control" id="key_person" name="key_person" type="text" placeholder="Key Person" value="<?php if (!empty($customer_info[0]['key_person'])) echo $customer_info[0]['key_person']; ?>">
                                                    <span id="key_person_error" style="color:red"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="inputdefault">Tin No.<sup style="color:red;">*</sup>  :</label></div>
                                                <div class="col-sm-8 col-md-8  ">
                                                    <input  class="form-control" id="tin_no" name="tin_no" type="text" placeholder="Tin Number" value="<?php if (!empty($customer_info[0]['tin_no'])) echo $customer_info[0]['tin_no']; ?>">
                                                     <span id="tin_no_error" style="color:red"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="vat_reg">Vat Reg.<sup style="color:red;">*</sup>  :</label></div>
                                                <div class="col-sm-8 col-md-8  ">
                                                    <input  class="form-control" id="vat_reg" name="vat_reg" type="text" placeholder="Vat Reg." value="<?php if (!empty($customer_info[0]['vat_reg'])) echo $customer_info[0]['vat_reg']; ?>">
                                                     <span id="vat_reg_error" style="color:red"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>-->

                            <!--        <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"> <label for="inputdefault">Phone<sup style="color:red;">*</sup> :</label></div>
                                                <div class="col-sm-8 col-md-8  ">
                                                    <input  class="form-control" id="c_mobile_no" name="c_mobile_no" type="text" placeholder="Mobile Phone Number" value="<?php if (!empty($customer_info[0]['c_mobile_no'])) echo $customer_info[0]['c_mobile_no']; ?>">
                                                     <span id="c_mobile_no_error" style="color:red"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="inputdefault">Email<sup style="color:red;">*</sup> :</label></div>
                                                <div class="col-sm-8 col-md-8  ">
                                                    <input  class="form-control" id="c_email" name="c_email" type="text" placeholder="Email" value="<?php if (!empty($customer_info[0]['c_email'])) echo $customer_info[0]['c_email']; ?>">
                                                    <span id="c_email_error" style="color:red"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"> <label for="inputdefault">Address<sup style="color:red;">*</sup> :</label></div>
                                                <div class="col-sm-8 col-md-8  ">
                                                    <input  class="form-control" id="c_contact_address" name="c_contact_address" type="text" placeholder="Head Office Address" value="<?php if (!empty($customer_info[0]['c_contact_address'])) echo $customer_info[0]['c_contact_address']; ?>">
                                                     <span id="c_contact_address_error" style="color:red"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>-->

                            <!--        <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="inputdefault">C. Person<sup style="color:red;">*</sup>  :</label></div>
                                                <div class="col-sm-8 col-md-8  ">
                                                    <input  class="form-control" id="c_contact_person" name="c_contact_person" type="text" placeholder="Contact Person" value="<?php if (!empty($customer_info[0]['c_contact_person'])) echo $customer_info[0]['c_contact_person']; ?>">
                                                    <span id="c_contact_person_error" style="color:red"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="inputdefault">Phone<sup style="color:red;">*</sup> :</label></div>
                                                <div class="col-sm-8 col-md-8  ">
                                                    <input  class="form-control" id="head_office_mobile_no" name="head_office_mobile_no" type="text" placeholder="Head Office Phone No." value="<?php if (!empty($customer_info[0]['head_office_mobile_no'])) echo $customer_info[0]['head_office_mobile_no']; ?>">
                                                     <span id="head_office_mobile_no_error" style="color:red"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="inputdefault">Email<sup style="color:red;">*</sup> :</label></div>
                                                <div class="col-sm-8 col-md-8  ">
                                                    <input  class="form-control" id="head_office_email" name="head_office_email" type="text" placeholder="Head Office Email" value="<?php if (!empty($customer_info[0]['head_office_email'])) echo $customer_info[0]['head_office_email']; ?>">
                                                    <span id="head_office_email_error" style="color:red"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div> -->



                            <div class="form-group" style="margin-top: 40px;">
                                <div class=" col-sm-2">
                                    <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">UPDATE</button>
                                </div>
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/customers') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
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
        var key_person = $('#key_person').val();
        var tin_no = $('#tin_no').val();
        var vat_reg = $('#vat_reg').val();
        var c_mobile_no = $('#c_mobile_no').val();
        var c_email = $('#c_email').val();
        var c_contact_address = $('#c_contact_address').val();
        var c_contact_person = $('#c_contact_person').val();
        var head_office_mobile_no = $('#head_office_mobile_no').val();
        var head_office_email = $('#head_office_email').val();
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

        if (key_person == '') {
            $('#key_person_error').html('Please fill key person field');
            $('#key_person').css('border', '1px solid red');
            error = true;
        } else {
            $('#key_person_error').html('');
            $('#key_person').css('border', '1px solid #ccc');

        }

        if (key_person == '') {
            $('#tin_no_error').html('Please fill tin number field');
            $('#tin_no').css('border', '1px solid red');
            error = true;
        } else {
            $('#tin_no_error').html('');
            $('#tin_no').css('border', '1px solid #ccc');

        }

        if (vat_reg == '') {
            $('#vat_reg_error').html('Please fill  vat registration number field');
            $('#vat_reg').css('border', '1px solid red');
            error = true;
        } else {
            $('#vat_reg_error').html('');
            $('#vat_reg').css('border', '1px solid #ccc');

        }

        if (c_mobile_no == '') {
            $('#c_mobile_no_error').html('Please fill mobile number field');
            $('#c_mobile_no').css('border', '1px solid red');
            error = true;
        } else {
            $('#c_mobile_no_error').html('');
            $('#c_mobile_no').css('border', '1px solid #ccc');

        }

        if (c_email == '') {
            $('#c_email_error').html('Please fill email field');
            $('#c_email').css('border', '1px solid red');
            error = true;
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

        if (c_contact_address == '') {
            $('#c_contact_address_error').html('Please fill address field');
            $('#c_contact_address').css('border', '1px solid red');
            error = true;
        } else {
            $('#c_contact_address_error').html('');
            $('#c_contact_address').css('border', '1px solid #ccc');

        }

        if (c_contact_person == '') {
            $('#c_contact_person_error').html('Please fill contact person field');
            $('#c_contact_person').css('border', '1px solid red');
            error = true;
        } else {
            $('#c_contact_person_error').html('');
            $('#c_contact_person').css('border', '1px solid #ccc');

        }

        if (head_office_mobile_no == '') {
            $('#head_office_mobile_no_error').html('Please fill head office phone field');
            $('#head_office_mobile_no').css('border', '1px solid red');
            error = true;
        } else {
            $('#head_office_mobile_no_error').html('');
            $('#head_office_mobile_no').css('border', '1px solid #ccc');

        }

        if (head_office_email == '') {
            $('#head_office_email_error').html('Please fill head office email field');
            $('#head_office_email').css('border', '1px solid red');
            error = true;
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