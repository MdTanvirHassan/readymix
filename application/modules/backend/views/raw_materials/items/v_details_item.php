<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
        <?php       
            require_once(__DIR__ .'/../../rm_setup_header.php');
        ?>
    </div>
    
    
    
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3 style="float:left;">Material Details Information</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('raw_materials/rm_setup/add_rm'); ?>" class="btn btn-sm btn-warning">Add Item</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">    





                        <div class="row">

                           

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3   labeltext" style="text-align: right"><label for="inputdefault">Category :</label></div>
                                    <div class="col-sm-8 col-md-8 "> 
                                        
                                        <b>  <?php foreach ($item_groups as $item_group) { ?>
                                                <?php if (!empty($item[0]['item_group']) && ($item[0]['item_group'] == $item_group['id'])) echo $item_group['item_group']; ?>
                                            <?php } ?>
                                        </b>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                              <div class="col-md-6">

                                <div class="form-group row" id="" style="">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Group :</label></div>
                                    <div class="col-sm-8 col-md-8 ">
                                        
                                            <b><?php foreach ($categories as $category) { ?>
                                              <?php if (!empty($item[0]['item_category']) && ($item[0]['item_category'] == $category['c_id'])) echo $category['c_name']; ?>
                                            <?php } ?>
                                            </b>
                                        
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group row">
                                    <div class="col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Material Code :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['item_code'])) echo $item[0]['item_code']; ?></b></div>
                                </div>

                            </div>
                           

                        </div>
                        
                        <div class="row">
                                <div class="col-md-6">

                                   <div class="form-group row">
                                       <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Material Name  :</label></div>
                                       <div class="col-sm-8 col-md-8 "> <b><?php if (!empty($item[0]['item_name'])) echo $item[0]['item_name']; ?></b></div>
                                   </div>
                               </div>  
                            
                               <div class="col-md-6">
                                <div class="form-group row">
                                    <div class=" col-md-3  labeltext" style="text-align: right"><label for="inputdefault">M. Unit :</label></div>
                                    <div class="col-sm-8 col-md-8 ">
                                        <b>  
                                    <?php foreach($measurement_units as $measurement_unit){ ?>
                                           <?php if($item[0]['mu_id']==$measurement_unit['id'])  echo $measurement_unit['meas_unit']; ?>
                                    <?php } ?>
                                       </b>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                       
                         

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3 labeltext" style="text-align: right"><label for="inputdefault">Type/Grade :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['item_grade'])) echo $item[0]['item_grade']; ?></b></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-3  labeltext" style="text-align: right"><label for="inputdefault">Origin :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['origin'])) echo $item[0]['origin']; ?></b></div>
                                </div>
                            </div>
                        </div>

                       
                     


                      
                        
                        <div class="row">

                           <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Minimum Level :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['min_level'])) echo $item[0]['min_level']; ?></b></div>
                                </div>
                            </div>

                           <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Maximum Level :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['max_level'])) echo $item[0]['max_level']; ?></b></div>
                                </div>
                            </div>
                        </div>
                        
                        
                         <div class="row">

                           <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Order Level :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['order_level'])) echo $item[0]['order_level']; ?></b></div>
                                </div>
                            </div>

                           <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Moving Type :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['moving_type'])) echo $item[0]['moving_type']; ?></b></div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row">

                           <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Store Location :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['store_location'])) echo $item[0]['store_location']; ?></b></div>
                                </div>
                            </div>

                           <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Remark :</label></div>
                                    <div class="col-sm-8 col-md-8 "><b><?php if (!empty($item[0]['remark'])) echo $item[0]['remark']; ?></b></div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">

                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/raw_materials/rm_setup/') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                                </div>       

                            </div>

                            <div class="col-md-2">
                                <div class="row">
                                    <!--
                            <div class="col-md-12">
                                <button type="button" class="btn btn-default button">SIMILAR LIST</button>
                            </div>-->
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



