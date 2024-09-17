 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; "></h2>
            <hr>
            <form action="<?php echo site_url('asset/edit_asset_action/'.$asset[0]['a_id']); ?>" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Asset Category :</label></div>
                            <div class="col-sm-8 col-md-7 "> 
                                <select class="form-control" name="a_category">
                                    <option class="form-control">Select Asset Category</option>
                                    <?php foreach($asset_categories as $asset_category){ ?>
                                            <option <?php if(!empty($asset[0]['a_category']) && $asset[0]['a_category']==$asset_category['category_id'] ) echo "selected"; ?> class="form-control" value="<?php echo $asset_category['category_id']; ?>"><?php echo $asset_category['category_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault"> Asset Code :</label></div>
                            <div class="col-sm-8 col-md-7 ">
                                
                                <input disabled class="form-control"  name="product_id" type="text" value="<?php if(!empty($asset[0]['product_id'])) echo $asset[0]['product_id']; ?>">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Asset Name  :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="product_name" type="text" value="<?php if(!empty($asset[0]['product_name'])) echo $asset[0]['product_name']; ?>" ></div>
                        </div>
                    </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Brand :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="a_band" type="text" value="<?php if(!empty($asset[0]['a_band'])) echo $asset[0]['a_band']; ?>"></div>
                        </div>
                    </div>
                </div>
                
                
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Model :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="a_model" type="text" value="<?php if(!empty($asset[0]['a_model'])) echo $asset[0]['a_model']; ?>"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Quantity:</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="a_quantity" type="text" value="<?php if(!empty($asset[0]['a_quantity'])) echo $asset[0]['a_quantity']; ?>"></div>
                        </div>
                    </div>
                </div>
                
                
                
                <hr>
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">UPDATE</button>
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



