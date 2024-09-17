<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Bank</h2>
    <hr>
    <form action="<?php echo site_url('bank/add_bank_action'); ?>" method="post">
        <div class="row">
            <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Name<sup style="color:red;">*</sup>  :</label></div>
                        <div class="col-sm-8 col-md-5 "><input required class="form-control" name="b_name" type="text"></div>
                    </div>
            </div>
             <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Short Name<sup style="color:red;">*</sup>  :</label></div>
                        <div class="col-sm-8 col-md-5 "><input required class="form-control" name="b_short_name" type="text"></div>
                    </div>
            </div>
            
        </div>
        
          

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Code<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                         <input type="hidden" name="bank_code" value="<?php if(!empty($bank_code)) echo $bank_code; ?>" >
                         <input class="form-control" name="b_code" type="hidden" value="<?php if(!empty($bank_auto_code)) echo 'B'.$bank_auto_code; ?>">
                         <input disabled class="form-control" name="b_code1" type="text" value="<?php if(!empty($bank_auto_code)) echo 'B'.$bank_auto_code; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Branch Name<sup style="color:red;">*</sup>  :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="branch_name" type="text"></div>
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Address :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="b_address" type="text"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Land Phone :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" name="b_land_phone" type="text"></div>
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Mobile Phone<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="b_mobile_no" type="text"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">EMAIL<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="b_email" type="text"></div>
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Swift Code:</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" name="b_swift_code" type="text"></div>
                </div>
            </div>
            
        </div>
        
        
        
        
        
        
        <hr>
        <div class="row">
           
            <div class="col-md-2 col-md-offset-3">
                <button type="submit" class="btn btn-primary button">SAVE</button>
            </div>
             <div class="col-md-2">
                <a href="<?php echo site_url('backend/bank') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
            </div>
        </div> 
            
        </div>
    </form>
</div>
