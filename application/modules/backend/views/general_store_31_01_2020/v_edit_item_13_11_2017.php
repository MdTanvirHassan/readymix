 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; "></h2>
            <hr>
            <form action="<?php echo site_url('general_store/edit_action_item_information/'.$item[0]['id']); ?>" method="post">
                <div class="row">
                    
                    <div class="col-md-6">
                        
                            <div class="form-group row">
                                   <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Item Type :</label></div>
                            <!--    <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="item_type" value="<?php if(!empty($item[0]['item_type'])) echo $item[0]['item_type']; ?>" type="text"></div>-->

                                   <div class="col-sm-8 col-md-7 "> 
                                       <select id="item_type" class="form-control" name="item_type" onchange="javascript:item_type_info();">
                                           <option class="form-control">Select Item Type</option>

                                                   <option <?php if(!empty($item[0]['item_type']) && $item[0]['item_type']=="Consumable" ) echo "selected"; ?> class="form-control" value="Consumable">Consumable</option>
                                                   <option <?php if(!empty($item[0]['item_type']) && $item[0]['item_type']=="Asset" ) echo "selected"; ?> class="form-control" value="Asset">Asset</option>

                                       </select>
                                   </div>
                           </div>
                
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Item Group :</label></div>
                            <div class="col-sm-8 col-md-7 "> 
                                <select required class="form-control" name="item_group">
                                    <option class="form-control">Select Item Group</option>
                                    <?php foreach($item_groups as $item_group){ ?>
                                            <option <?php if(!empty($item[0]['item_group']) && ($item[0]['item_group']== $item_group['id'])) echo "selected"; ?> class="form-control" value="<?php echo $item_group['id']; ?>"><?php echo $item_group['item_group']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Item Code :</label></div>
                            <div class="col-sm-8 col-md-7 "><input disabled class="form-control" id="inputdefault" name="item_code" value="<?php if(!empty($item[0]['item_code'])) echo $item[0]['item_code']; ?>" type="text"></div>
                        </div>
                       
                    </div>
                    <div class="col-md-6">
                        
                         <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Item Name  :</label></div>
                            <div class="col-sm-8 col-md-7 "><input required class="form-control" id="inputdefault" name="item_name" value="<?php if(!empty($item[0]['item_name'])) echo $item[0]['item_name']; ?>" type="text"></div>
                        </div>
                    </div>  
                        
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Brand :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="brand" value="<?php if(!empty($item[0]['brand'])) echo $item[0]['brand']; ?>" type="text"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Origin :</label></div>
                            <div class="col-sm-8 col-md-7 "><input required class="form-control" id="inputdefault" name="origin" value="<?php if(!empty($item[0]['origin'])) echo $item[0]['origin']; ?>" type="text"></div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">M.unit :</label></div>
                            <div class="col-sm-8 col-md-7 "><input required class="form-control" id="inputdefault" name="meas_unit" value="<?php if(!empty($item[0]['meas_unit'])) echo $item[0]['meas_unit']; ?>" type="text"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!--
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Unit Price:</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="unit_price" value="<?php if(!empty($item[0]['unit_price'])) echo $item[0]['unit_price']; ?>" type="text"></div>
                        </div>
                        -->
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Store Location :</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="store_location" value="<?php if(!empty($item[0]['store_location'])) echo $item[0]['store_location']; ?>" type="text"></div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Opening Stock :</label></div>
                             <div class="col-sm-8 col-md-7 "><input onkeyup="javascript:calculate_opeing_value();" class="form-control" id="opening_stock" name="opening_stock" type="text" value="<?php if(!empty($item[0]['opening_stock'])) echo $item[0]['opening_stock']; ?>"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                       <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Unit Price. :</label></div>
                            <div class="col-sm-8 col-md-7 "><input onkeyup="javascript:calculate_opeing_value();" class="form-control" id="unit_price" name="unit_price" value="<?php if(!empty($item[0]['unit_price'])) echo $item[0]['unit_price']; ?>" type="text"></div>
                        </div>
                    </div>
                    
                    
                </div>
                
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Item Value/Opening Value :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" id="item_value" name="item_value" type="hidden" value="<?php if(!empty($item[0]['item_value'])) echo $item[0]['item_value']; ?>"><input disabled class="form-control" id="item_value1" name="item_value" type="text" value="<?php if(!empty($item[0]['item_value'])) echo $item[0]['item_value']; ?>"></div>
                        </div>
                    </div>
                      <div class="col-md-6">
                       <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Part No. :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="port_no" value="<?php if(!empty($item[0]['port_no'])) echo $item[0]['port_no']; ?>" type="text"></div>
                        </div>
                    </div>
         </div>
                
                
                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Cons.Sub.Group:</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="cons_sub_group" value="<?php if(!empty($item[0]['cons_sub_group'])) echo $item[0]['cons_sub_group']; ?>" type="text"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        
                       <?php if(!empty($item[0]['item_type']) && $item[0]['item_type']=="Consumable" ){ ?> 
                            <div class="form-group row" id="max_level">
                                <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Max level :</label></div>
                                 <div class="col-sm-8 col-md-7 "><input required class="form-control" id="inputdefault" name="max_level" value="<?php if(!empty($item[0]['max_level'])) echo $item[0]['max_level']; ?>" type="text"></div>
                            </div>
                            <div class="form-group row" id="item_category" style="display:none;">
                                <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Item Category :</label></div>
                                 <div class="col-sm-8 col-md-7 "><input class="form-control" id="item_cat" name="item_category" type="text"></div>
                            </div>
                       <?php }else{ ?>
                            <div class="form-group row" id="max_level" style="display:none;">
                                <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Max level :</label></div>
                                <div class="col-sm-8 col-md-7 "><input required class="form-control" id="inputdefault" name="max_level" value="<?php if(!empty($item[0]['max_level'])) echo $item[0]['max_level']; ?>" type="text"></div>
                            </div>
                            <div class="form-group row" id="item_category" >
                                <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Item Category :</label></div>
                                <div class="col-sm-8 col-md-7 "><input class="form-control" id="item_cat" name="item_category" type="text" value="<?php if(!empty($item[0]['item_category'])) echo $item[0]['item_category']; ?>"></div>
                            </div>     
                            
                     <?php } ?>
                        
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php if(!empty($item[0]['item_type']) && $item[0]['item_type']=="Consumable" ){ ?>
                                <div class="form-group row" id="min_level">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Min Level :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input required class="form-control" id="min_lebel" name="min_level" value="<?php if(!empty($item[0]['min_level'])) echo $item[0]['min_level']; ?>" type="text"></div>
                                </div>
                        <?php }else{ ?>
                             <div class="form-group row" id="min_level" style="display:none;">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Min Level :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input required class="form-control" id="min_lebel" name="min_level" value="<?php if(!empty($item[0]['min_level'])) echo $item[0]['min_level']; ?>" type="text"></div>
                                </div>
                        <?php } ?>
                    </div>
                    
                    <div class="col-md-6">
                         <?php if(!empty($item[0]['item_type']) && $item[0]['item_type']=="Consumable" ){ ?>
                            <div class="form-group row" id="order_level">
                                <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Order Level :</label></div>
                                <div class="col-sm-8 col-md-7 "><input class="form-control" id="order_lebel" name="order_level" value="<?php if(!empty($item[0]['order_level'])) echo $item[0]['order_level']; ?>" type="text"></div>
                            </div>
                         <?php }else{ ?>
                            <div class="form-group row" id="order_level" style="display:none;">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Order Level :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input class="form-control" id="order_lebel" name="order_level" value="<?php if(!empty($item[0]['order_level'])) echo $item[0]['order_level']; ?>" type="text"></div>
                              </div>
                         <?php } ?>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-6">
                        <?php if(!empty($item[0]['item_type']) && $item[0]['item_type']=="Consumable" ){ ?>
                            <div class="form-group row" id="item_head">
                                <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Item Head :</label></div>
                                <div class="col-sm-8 col-md-7 "><input class="form-control" id="item_lebel" name="item_head" value="<?php if(!empty($item[0]['item_head'])) echo $item[0]['item_head']; ?>" type="text"></div>
                            </div>
                             <div class="form-group row" id="purchase_date" style="display:none;">
                                <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Purchase Date :</label></div>
                                <div class="col-sm-8 col-md-7 "><input class="form-control datepicker" id="pur_date" name="purchase_date" type="text" value="<?php if(!empty($item[0]['purchase_date'])) echo $item[0]['purchase_date']; ?>"></div>
                            </div>
                        <?php }else{ ?>
                         <div class="form-group row" id="item_head" style="display:none;">
                                <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Item Head :</label></div>
                                <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="item_head" value="<?php if(!empty($item[0]['item_head'])) echo $item[0]['item_head']; ?>" type="text"></div>
                            </div>
                             <div class="form-group row" id="purchase_date" >
                                <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Purchase Date :</label></div>
                                <div class="col-sm-8 col-md-7 "><input class="form-control datepicker" id="pur_date" name="purchase_date" type="text" value="<?php if(!empty($item[0]['purchase_date'])) echo date('d-m-Y',strtotime($item[0]['purchase_date'])); ?>"></div>
                            </div>
                        <?php } ?>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Status :</label></div>
                             <div class="col-sm-8 col-md-7 "> <select class="form-control" name="item_status">
                            <option <?php if(!empty($item[0]['item_status']) && $item[0]['item_status']=="Active" ) echo "selected"; ?> class="form-control" value="Active">Active</option>
                            <option <?php if(!empty($item[0]['item_status']) && $item[0]['item_status']=="Inactive" ) echo "selected"; ?> class="form-control" value="Inactive">Inactive</option>
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
                    <div class="col-md-10">
                        <div class="row">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-default button">Update</button>
                    </div>
                   <div class="col-md-2">
                        <a href="<?php echo site_url('backend/general_store/item_information') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                  </div>             
                            <!--
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary button">SEARCH</button>
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
                    </div>
                      <div class="col-md-2">
                         <button type="button" class="btn btn-default button">SIMILAR LIST</button>
                    </div>
                            -->
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
                
            </form>
        </div>


<script type="text/javascript">
    
      function calculate_opeing_value(){
                        
        var unit_price= $('#unit_price').val();
        var opeing_qty= $('#opening_stock').val();
        if(unit_price!='' && opeing_qty!=''){
            var opening_value=Number(unit_price)*Number(opeing_qty);
            $('#item_value').val(opening_value);
            $('#item_value1').val(opening_value);
        }else{
             $('#item_value').val();
             $('#item_value1').val();
        }

    }
    
        function item_type_info(){
       //  alert('test');
         var item_type= $('#item_type').val();
         if(item_type=="Asset"){
           
             $('#max_lebel').val('');
             $('#min_lebel').val('');
             $('#item_lebel').val('');
             $('#order_lebel').val('');

             $('#min_level').hide();
             $('#max_level').hide();
             $('#order_level').hide();
             $('#item_head').hide();

             $('#item_category').show();
             $('#purchase_date').show();


         }else{
             $('#min_level').show();
             $('#max_level').show();
             $('#order_level').show();
             $('#item_head').show();   

             $('#item_cat').val('');
             $('#pur_date').val('');
             $('#item_category').hide();
             $('#purchase_date').hide();
         }

     }
</script>