<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Supplier/Customer's Information Entry/Edit Session</h2>
    <hr>
    <form action="<?php echo site_url('general_store/add_supplier_action'); ?>" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Local/Foreign :</label></div>
                    <div class="col-sm-8 col-md-7 ">
                        <select class="form-control" name="LOCAL">
                            <option class="form-control">Local</option>
                            <option class="form-control">Foreign</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Supplier Code :</label></div>
                    <div class="col-sm-8 col-md-7 ">
                         <input type="hidden" name="supplier_code" value="<?php if(!empty($supplier_code)) echo $supplier_code; ?>" >
                         <input class="form-control" name="CODE" type="hidden" value="<?php if(!empty($supplier_auto_code)) echo 'SP'.$supplier_auto_code; ?>">
                         <input disabled class="form-control" name="CODE1" type="text" value="<?php if(!empty($supplier_auto_code)) echo 'SP'.$supplier_auto_code; ?>">
                    </div>
                </div>
            </div>
        </div>
        
          <div class="row">
              
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Supplier Name  :</label></div>
                        <div class="col-sm-8 col-md-7 "><input required class="form-control" name="SUP_NAME" type="text"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Status :</label></div>
                        <div class="col-sm-8 col-md-7 ">
                            <select class="form-control" name="STATUS">
                                <option class="form-control">Active</option>
                                <option class="form-control">Inactive</option>
                            </select>
                        </div>
                    </div>
            </div>
          </div>     

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Contact person  :</label></div>
                    <div class="col-sm-8 col-md-7 "><input required class="form-control" name="NAME" type="text"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Contact Address :</label></div>
                    <div class="col-sm-8 col-md-7 "><input required class="form-control" name="ADDRESS" type="text"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Land Phone :</label></div>
                    <div class="col-sm-8 col-md-7 "><input class="form-control" name="LAND_PHONE" type="text"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Mobile Phone :</label></div>
                    <div class="col-sm-8 col-md-7 "><input required class="form-control" name="MOBILE" type="text"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">EMAIL :</label></div>
                    <div class="col-sm-8 col-md-7 "><input required class="form-control" name="EMAIL" type="text"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Fax Number:</label></div>
                    <div class="col-sm-8 col-md-7 "><input class="form-control" name="FAX" type="text"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <!--
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Status :</label></div>
                    <div class="col-sm-8 col-md-7 ">
                        <select class="form-control" name="STATUS">
                            <option class="form-control">Active</option>
                            <option class="form-control">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            -->
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">WEBSITE :</label></div>
                    <div class="col-sm-8 col-md-7 "><input class="form-control"  name="WEBSITE" type="text"></div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary button">SAVE</button>
            </div>
             <div class="col-md-2">
                <a href="<?php echo site_url('backend/general_store') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

            </div>
        </div> 
            <!--
            <div class="col-md-2">
                <button type="button" class="btn btn-primary button">FIND</button>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-success button">VIEW</button>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-info button">CLEAR</button>
            </div>
            
            <div class="col-md-2">
                <button type="button" class="btn btn-warning button">SAVE</button>
            </div>
            
            <div class="col-md-2">
                <button type="button" class="btn  btn-danger button">EXIT</button>
            </div>-->
        </div>
    </form>
</div>
