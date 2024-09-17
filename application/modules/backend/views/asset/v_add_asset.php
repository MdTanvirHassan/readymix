 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; "></h2>
            <hr>
            <form action="<?php echo site_url('asset/add_asset_action'); ?>" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Asset Category :</label></div>
                            <div class="col-sm-8 col-md-7 "> 
                                <select class="form-control" name="a_category">
                                    <option class="form-control">Select Asset Category</option>
                                    <?php foreach($asset_categories as $asset_category){ ?>
                                            <option class="form-control" value="<?php echo $asset_category['category_id']; ?>"><?php echo $asset_category['category_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault"> Asset Code :</label></div>
                            <div class="col-sm-8 col-md-7 ">
                                <input type="hidden" name="asset_code" value="<?php if(!empty($asset_code)) echo $asset_code; ?>" >
                                <input class="form-control"  name="product_id" type="hidden" value="<?php if(!empty($asset_auto_number)) echo 'AS'.$asset_auto_number; ?>">
                                <input disabled class="form-control"  name="item_code1" type="text" value="<?php if(!empty($asset_auto_number)) echo 'AS'.$asset_auto_number; ?>">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Asset Name  :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="product_name" type="text"></div>
                        </div>
                    </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Brand :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="a_band" type="text"></div>
                        </div>
                    </div>
                </div>
                
                
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Model :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="a_model" type="text"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Quantity:</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="a_quantity" type="text"></div>
                        </div>
                    </div>
                </div>
                
                
                
                <hr>
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">SAVE</button>
                    </div>
                
                </div>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                
                        </div>
                    </div>
                </div>
                
            </form>
        </div>



