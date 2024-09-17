<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Bank</h2>
    <hr>
    <form action="<?php echo site_url('bank/edit_bank_action/'.$bank_info[0]['id']); ?>" method="post">
        <div class="row">
            <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Name<sup style="color:red;">*</sup>  :</label></div>
                        <div class="col-sm-8 col-md-5 "><input required class="form-control" name="b_name" type="text" value="<?php if(!empty($bank_info[0]['b_name'])) echo $bank_info[0]['b_name']  ?>"></div>
                    </div>
            </div>
             <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Short Name<sup style="color:red;">*</sup>  :</label></div>
                        <div class="col-sm-8 col-md-5 "><input required class="form-control" name="b_short_name" type="text" value="<?php if(!empty($bank_info[0]['b_short_name'])) echo $bank_info[0]['b_short_name']  ?>"></div>
                    </div>
            </div>
            
        </div>
        
          

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Code<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                         
                         <input disabled class="form-control" name="b_code1" type="text" value="<?php if(!empty($bank_info[0]['b_code'])) echo $bank_info[0]['b_code']  ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Branch Name<sup style="color:red;">*</sup>  :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="branch_name" type="text" value="<?php if(!empty($bank_info[0]['branch_name'])) echo $bank_info[0]['branch_name']  ?>"></div>
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Address :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="b_address" type="text" value="<?php if(!empty($bank_info[0]['b_address'])) echo $bank_info[0]['b_address']  ?>"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Land Phone :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" name="b_land_phone" type="text" value="<?php if(!empty($bank_info[0]['b_land_phone'])) echo $bank_info[0]['b_land_phone']  ?>"></div>
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Mobile Phone<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="b_mobile_no" type="text" value="<?php if(!empty($bank_info[0]['b_mobile_no'])) echo $bank_info[0]['b_mobile_no']  ?>"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">EMAIL<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="b_email" type="text" value="<?php if(!empty($bank_info[0]['b_email'])) echo $bank_info[0]['b_email']  ?>"></div>
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Swift Code:</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" name="b_swift_code" type="text" value="<?php if(!empty($bank_info[0]['b_swift_code'])) echo $bank_info[0]['b_swift_code']  ?>"></div>
                </div>
            </div>
            
        </div>
        <hr>
        <div class="row">
           
            <div class="col-md-2 col-md-offset-3">
                <button type="submit" class="btn btn-primary button">UPDATE</button>
            </div>
             <div class="col-md-2">
                <a href="<?php echo site_url('backend/bank') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
            </div>
        </div> 
            
        </div>
    </form>
</div>
