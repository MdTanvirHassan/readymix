 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; "></h2>
            <hr>
            <form action="<?php echo site_url('asset_category/add_asset_category_action'); ?>" method="post">
               
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Category Name:</label></div>
                             <div class="col-sm-8 col-md-7 ">
                                
                                 <input  class="form-control" id="inputdefault" name="category_name" type="text" value="">
                             </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault"> Description :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="description" type="text"></div>
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

