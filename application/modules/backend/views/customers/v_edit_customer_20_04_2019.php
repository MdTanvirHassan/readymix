<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Customer</h2>
    <hr>
    <form action="<?php echo site_url('customers/edit_customer_action/'.$customer_info[0]['id']); ?>" method="post">
        <div class="row">
            <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Name<sup style="color:red;">*</sup>  :</label></div>
                        <div class="col-sm-8 col-md-5 "><input required class="form-control" name="c_name" type="text" value="<?php if(!empty($customer_info[0]['c_name'])) echo $customer_info[0]['c_name']; ?>"></div>
                    </div>
            </div>
             <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Short Name<sup style="color:red;">*</sup>  :</label></div>
                        <div class="col-sm-8 col-md-5 "><input required class="form-control" name="c_short_name" type="text" value="<?php if(!empty($customer_info[0]['c_short_name'])) echo $customer_info[0]['c_short_name']; ?>"></div>
                    </div>
            </div>
            
        </div>
        
          

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Customer Code<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">        
                         <input disabled class="form-control" name="c_code1" type="text" value="<?php if(!empty($customer_info[0]['c_code'])) echo $customer_info[0]['c_code']; ?>"">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Contact person<sup style="color:red;">*</sup>  :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="c_contact_person" type="text" value="<?php if(!empty($customer_info[0]['c_contact_person'])) echo $customer_info[0]['c_contact_person']; ?>"></div>
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Contact Address<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="c_contact_address" type="text" value="<?php if(!empty($customer_info[0]['c_contact_address'])) echo $customer_info[0]['c_contact_address']; ?>"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Land Phone :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" name="c_land_phone" type="text" value="<?php if(!empty($customer_info[0]['c_land_phone'])) echo $customer_info[0]['c_land_phone']; ?>"></div>
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Mobile Phone<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="c_mobile_no" type="text" value="<?php if(!empty($customer_info[0]['c_mobile_no'])) echo $customer_info[0]['c_mobile_no']; ?>"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">EMAIL<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="c_email" type="text" value="<?php if(!empty($customer_info[0]['c_email'])) echo $customer_info[0]['c_email']; ?>"></div>
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Fax Number:</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" name="c_fax_no" type="text" value="<?php if(!empty($customer_info[0]['c_fax_no'])) echo $customer_info[0]['c_fax_no']; ?>"></div>
                </div>
            </div>
            
        </div>
        <hr>
        <div class="row">
           
            <div class="col-md-2 col-md-offset-3">
                <button type="submit" class="btn btn-primary button">UPDATE</button>
            </div>
             <div class="col-md-2">
                <a href="<?php echo site_url('backend/customers') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

            </div>
        </div> 
            
        </div>
    </form>
</div>
