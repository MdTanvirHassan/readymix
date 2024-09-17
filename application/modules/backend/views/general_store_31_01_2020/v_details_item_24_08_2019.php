<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3 style="float:left;">Details Item Information</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('general_store/add_item_information'); ?>" class="btn btn-sm btn-warning">Add Item</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">    





                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group row">
                                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Item Type :</label></div>
                             <!--    <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="item_type" value="<?php if (!empty($item[0]['item_type'])) echo $item[0]['item_type']; ?>" type="text"></div>-->

                                    <div class="col-sm-8 col-md-5 "> 
                                        <select disabled id="item_type" class="form-control" name="item_type" onchange="javascript:item_type_info();">
                                            <option class="form-control">Select Item Type</option>

                                            <option <?php if (!empty($item[0]['item_type']) && $item[0]['item_type'] == "Consumable") echo "selected"; ?> class="form-control" value="Consumable">Consumable</option>
                                            <option <?php if (!empty($item[0]['item_type']) && $item[0]['item_type'] == "Asset") echo "selected"; ?> class="form-control" value="Asset">Asset</option>

                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right"><label for="inputdefault">Item Group :</label></div>
                                    <div class="col-sm-8 col-md-5 "> 
                                        <select disabled required class="form-control" name="item_group">
                                            <option class="form-control">Select Item Group</option>
                                            <?php foreach ($item_groups as $item_group) { ?>
                                                <option <?php if (!empty($item[0]['item_group']) && ($item[0]['item_group'] == $item_group['id'])) echo "selected"; ?> class="form-control" value="<?php echo $item_group['id']; ?>"><?php echo $item_group['item_group']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group row">
                                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Item Code :</label></div>
                                    <div class="col-sm-8 col-md-5 "><input disabled class="form-control" id="inputdefault" name="item_code" value="<?php if (!empty($item[0]['item_code'])) echo $item[0]['item_code']; ?>" type="text"></div>
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group row">
                                    <div class="col-sm-4 col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Item Name  :</label></div>
                                    <div class="col-sm-8 col-md-5 "><input disabled required class="form-control" id="inputdefault" name="item_name" value="<?php if (!empty($item[0]['item_name'])) echo $item[0]['item_name']; ?>" type="text"></div>
                                </div>
                            </div>  

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Brand :</label></div>
                                    <div class="col-sm-8 col-md-5 "><input disabled class="form-control" id="inputdefault" name="brand" value="<?php if (!empty($item[0]['brand'])) echo $item[0]['brand']; ?>" type="text"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4 col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Origin :</label></div>
                                    <div class="col-sm-8 col-md-5 "><input disabled required class="form-control" id="inputdefault" name="origin" value="<?php if (!empty($item[0]['origin'])) echo $item[0]['origin']; ?>" type="text"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">M.unit :</label></div>
                                    <div class="col-sm-8 col-md-5 "><input disabled required class="form-control" id="inputdefault" name="meas_unit" value="<?php if (!empty($item[0]['meas_unit'])) echo $item[0]['meas_unit']; ?>" type="text"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!--
                                <div class="form-group row">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Unit Price:</label></div>
                                     <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="unit_price" value="<?php if (!empty($item[0]['unit_price'])) echo $item[0]['unit_price']; ?>" type="text"></div>
                                </div>
                                -->
                                <div class="form-group row">
                                    <div class="col-sm-4 col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Part No. :</label></div>
                                    <div class="col-sm-8 col-md-5 "><input disabled class="form-control" id="inputdefault" name="port_no" value="<?php if (!empty($item[0]['port_no'])) echo $item[0]['port_no']; ?>" type="text"></div>
                                </div>

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Opening Stock :</label></div>
                                    <div class="col-sm-8 col-md-5 "><input disabled onkeyup="javascript:calculate_opeing_value();" class="form-control" id="opening_stock" name="opening_stock" type="text" value="<?php if (!empty($item[0]['opening_stock'])) echo $item[0]['opening_stock']; ?>"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right"><label for="inputdefault">Unit Price. :</label></div>
                                    <div class="col-sm-8 col-md-5 "><input disabled onkeyup="javascript:calculate_opeing_value();" class="form-control" id="unit_price" name="unit_price" value="<?php if (!empty($item[0]['unit_price'])) echo $item[0]['unit_price']; ?>" type="text"></div>
                                </div>
                            </div>


                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Opening Value :</label></div>
                                    <div class="col-sm-8 col-md-5 "><input disabled class="form-control" id="item_value" name="opening_value" type="hidden" value="<?php if (!empty($item[0]['opening_value'])) echo $item[0]['opening_value']; ?>"><input disabled class="form-control" id="item_value1" name="opening_value" type="text" value="<?php if (!empty($item[0]['opening_value'])) echo $item[0]['opening_value']; ?>"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4 col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Store Location :</label></div>
                                    <div class="col-sm-8 col-md-5 "><input disabled class="form-control" id="inputdefault" name="store_location" value="<?php if (!empty($item[0]['store_location'])) echo $item[0]['store_location']; ?>" type="text"></div>
                                </div>
                            </div>
                        </div>



                        <div class="row">



                            <div class="col-md-6">

                                <div class="form-group row" id="" style="">
                                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Item Category :</label></div>
                                    <div class="col-sm-8 col-md-5 ">
                                        <select disabled id="item_category" required class="form-control" name="item_category">
                                            <option class="form-control">Select Item Category</option>
                                            <?php foreach ($categories as $category) { ?>
                                                <option <?php if (!empty($item[0]['item_category']) && ($item[0]['item_category'] == $category['c_id'])) echo "selected"; ?> class="form-control" value="<?php echo $category['c_id']; ?>"><?php echo $category['c_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <?php if (!empty($item[0]['item_type']) && $item[0]['item_type'] == "Consumable") { ?>

                                    <div class="form-group row" id="purchase_date" style="display:none;">
                                        <div class="col-sm-4 col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Purchase Date :</label></div>
                                        <div class="col-sm-8 col-md-5 "><input disabled class="form-control datepicker" id="pur_date" name="purchase_date" type="text" value="<?php if (!empty($item[0]['purchase_date'])) echo $item[0]['purchase_date']; ?>"></div>
                                    </div>
                                <?php }else { ?>

                                    <div class="form-group row" id="purchase_date" >
                                        <div class="col-sm-4 col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Purchase Date :</label></div>
                                        <div class="col-sm-8 col-md-5 "><input disabled class="form-control datepicker" id="pur_date" name="purchase_date" type="text" value="<?php if (!empty($item[0]['purchase_date'])) echo date('d-m-Y', strtotime($item[0]['purchase_date'])); ?>"></div>
                                    </div>
                                <?php } ?>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-6">

                            </div>

                            <div class="col-md-6">

                            </div>
                        </div><!--End Row-->

                        <div class="row">



                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Status :</label></div>
                                    <div class="col-sm-8 col-md-5 "> <select disabled class="form-control" name="item_status">
                                            <option <?php if (!empty($item[0]['item_status']) && $item[0]['item_status'] == "Active") echo "selected"; ?> class="form-control" value="Active">Active</option>
                                            <option <?php if (!empty($item[0]['item_status']) && $item[0]['item_status'] == "Inactive") echo "selected"; ?> class="form-control" value="Inactive">Inactive</option>
                                        </select></div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">

                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/general_store/item_information') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

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



