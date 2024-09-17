 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; ">Add Item Information </h2>
            <hr>
            <form action="<?php echo site_url('general_store/add_action_item_information'); ?>" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right">
                                <label for="inputdefault">Item Type :</label>
                            </div>
                            <!-- <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="item_type" type="text"></div>-->
                              <div class="col-sm-8 col-md-5 "> 
                                <select id="item_type" class="form-control" name="item_type" onchange="javascript:item_type_info();">
                                   
                                    
                                            <option class="form-control" value="Consumable">Consumable</option>
                                            <option class="form-control" value="Asset">Asset</option>
                                  
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext" style="text-align: right">
                                <label for="inputdefault">Item Group :</label>
                            </div>
                            <div class="col-sm-8 col-md-5 "> 
                                <select required id="group_id" class="form-control" name="item_group" onchange="javascript:group_item_id();">
                                    <option class="form-control" value="">Select Item Group</option>
                                    <?php foreach($item_groups as $item_group){ ?>
                                            <option class="form-control" value="<?php echo $item_group['id']; ?>"><?php echo $item_group['item_group']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right">
                                <label for="inputdefault">Item Code :</label>
                            </div>
                            <div class="col-sm-8 col-md-5 ">
                                <!--
                                <input id="item_c" type="hidden" name="item_c" value="<?php if(!empty($item_code)) echo $item_code; ?>" >
                                <input id="item_code" class="form-control"  name="item_code" type="hidden" value="<?php if(!empty($item_auto_code)) echo 'IT'.$item_auto_code; ?>">
                                <input id="item_cod1" disabled class="form-control"  name="item_code1" type="text" value="<?php if(!empty($item_auto_code)) echo 'IT'.$item_auto_code; ?>">
                                -->
                                 <input id="item_c" type="hidden" name="item_c" value="" >
                                <input id="item_code" class="form-control"  name="item_code" type="hidden" value="">
                                <input id="item_code1" disabled  class="form-control"  name="item_code1" type="text" value="">
                        </div>
                    </div>
                  </div>     
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext" style="text-align: right">
                                <label for="inputdefault">Item Name  :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                <input required class="form-control" id="inputdefault" name="item_name" type="text">
                            </div>
                        </div>
                    </div>
                   
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right">
                                <label for="inputdefault">Brand :</label>
                            </div>
                            <div class="col-sm-8 col-md-5 ">
                                <input class="form-control" id="inputdefault" name="brand" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext" style="text-align: right">
                                <label for="inputdefault">Origin :</label>
                            </div>
                            <div class="col-sm-8 col-md-5 ">
                                <input required class="form-control" id="inputdefault" name="origin" type="text">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right">
                                <label for="inputdefault">M.unit :</label>
                            </div>
                            <div class="col-sm-8 col-md-5 ">
                                <input required class="form-control" id="inputdefault" name="meas_unit" type="text">
                            </div>
                        </div>
                    </div>
                      <!--
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Unit Price:</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="unit_price" type="text"></div>
                        </div>
                        -->
                       <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-4 col-md-3  labeltext" style="text-align: right">
                                    <label for="inputdefault">Part No. :</label>
                                </div>
                                <div class="col-sm-8 col-md-5 ">
                                    <input class="form-control" id="inputdefault" name="port_no" type="text" value="">
                                </div>
                            </div>
                        </div>
                       
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right">
                                <label for="inputdefault">Opening Stock :</label>
                            </div>
                            <div class="col-sm-8 col-md-5 ">
                                <input class="form-control" id="opening_stock" name="opening_stock" type="text" onkeyup="javascript:calculate_opeing_value();">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext" style="text-align: right">
                                <label for="inputdefault">Unit Price. :</label>
                            </div>
                            <div class="col-sm-8 col-md-5 ">
                                <input onkeyup="javascript:calculate_opeing_value();" class="form-control" id="unit_price" name="unit_price" type="text" value="">
                            </div>
                        </div>
                    </div>
                </div>
                
               
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right">
                                <label for="inputdefault">Opening Value :</label>
                            </div>
                            <div class="col-sm-8 col-md-5 ">
                                <input class="form-control" id="item_value" name="opening_value" type="hidden">
                                <input disabled class="form-control" id="item_value1" name="item_value" type="text">
                            </div>
                        </div>
                    </div>
                   <div class="col-md-6">
                        <div class="form-group row">
                                <div class="col-sm-4 col-md-3  labeltext" style="text-align: right">
                                    <label for="inputdefault">Store Location :</label>
                                </div>
                                <div class="col-sm-8 col-md-5 ">
                                    <input class="form-control" id="inputdefault" name="store_location" type="text">
                                </div>
                        </div>
                    </div>
                   
         </div>
                
                
                <div class="row">
                    <!--
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Cons.Sub.Group:</label></div>
                                <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="cons_sub_group" type="text"></div>
                        </div>
                 
                    </div>
                       -->
                    <div class="col-md-6">
                        <!--
                        <div class="form-group row" id="max_level">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Max level :</label></div>
                            <div class="col-sm-8 col-md-7 "><input required class="form-control" id="max_lebel" name="max_level" type="text"></div>
                        </div>
                        -->
                        <div class="form-group row" id="" style="">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right">
                                <label for="inputdefault">Item Category :</label>
                            </div>
                             <div class="col-sm-8 col-md-5 ">
                                 <select required id="item_category" class="form-control" name="item_category" >
                                    <option class="form-control" value="">Select Item Category</option>
                                    <?php foreach($categories as $category){ ?>
                                            <option class="form-control" value="<?php echo $category['c_id']; ?>"><?php echo $category['c_name']; ?></option>
                                    <?php } ?>
                                </select>
                                 
                             </div>
                        </div>
                       
                     </div>
                       <div class="col-md-6">
                            <div class="form-group row" id="purchase_date" style="display:none;">
                                <div class="col-sm-4 col-md-3  labeltext" style="text-align: right">
                                    <label for="inputdefault">Purchase Date :</label>
                                </div>
                                <div class="col-sm-8 col-md-5 ">
                                    <input class="form-control datepicker" id="pur_date" name="purchase_date" type="text">
                                </div>
                            </div>
                       </div>
                       
                </div><!--End Row-->
               <!-- 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row" id="min_level">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Min Level :</label></div>
                             <div class="col-sm-8 col-md-7 "><input required class="form-control" id="min_lebel" name="min_level" type="text"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row" id="order_level">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Order Level :</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control" id="order_lebel" name="order_level" type="text"></div>
                        </div>
                    </div>
                </div>
               -->
                
                <div class="row">
                      <!--
                    <div class="col-md-6">
                     
                        <div class="form-group row" id="item_head">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Item Head :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" id="item_lebel" name="item_head" type="text"></div>
                        </div>
             
                        <div class="form-group row" id="purchase_date" style="display:none;">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Purchase Date :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control datepicker" id="pur_date" name="purchase_date" type="text"></div>
                        </div>
                     
                    </div>
               -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right">
                                <label for="inputdefault">Status :</label>
                            </div>
                             <div class="col-sm-8 col-md-5 "> 
                                 <select class="form-control" name="item_status">
                            <option class="form-control" value="Active">Active</option>
                            <option class="form-control" value="Inactive">Inactive</option>
                        </select>
                             </div>
                        </div>
                    </div>
                </div><!--End Row-->
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
                            <div class="col-md-2 col-md-offset-3">
                                <button type="submit" class="btn btn-primary button">SAVE</button>
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
                        <button type="button" class="btn  btn-default button">SIMILAR LIST</button>
                    </div>-->
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
                   $('.select2').select2(); 
                    function group_info(){
               
                        var reportformat=$('#report_format').val();
                        $.ajax({
                            type: "POST",
                            url: "backend/report/group_info",
                            data: "reportformat="+reportformat,
                            dataType: "json",
                            success: function (data) {

                                        var str = '';
                                              str += '<option class="form-controll" value="">Select group</option>';
                                         $(data.data).each(function (row, val) {
                                             str += '<option class="form-controll" value="' + val.id + '">' + val.item_group + '</option>';
                                         })
                                         $('#item').html(str);
                            }         
                        })
                    }
                    
                    
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
                            
                            //$('#item_cat').val('');
                            $('#pur_date').val('');
                            //$('#item_category').hide();
                            $('#purchase_date').hide();
                        }
                        
                         $.ajax({
                            type: "POST",
                            url: "backend/report/group_info",
                            data: "reportformat="+item_type,
                            dataType: "json",
                            success: function (data) {

                                        var str = '';
                                              str += '<option class="form-controll" value="">Select item group</option>';
                                         $(data.data).each(function (row, val) {
                                             str += '<option class="form-controll" value="' + val.id + '">' + val.item_group + '</option>';
                                         })
                                         $('#group_id').html(str);
                                         
                                         var str1 = '';
                                              str1 += '<option class="form-controll" value="">Select item Category</option>';
                                         $(data.data1).each(function (row, val1) {
                                             str1 += '<option class="form-controll" value="' + val1.c_id + '">' + val1.c_name + '</option>';
                                         })
                                         $('#item_category').html(str1);
                            }         
                        })
                        
                        
                    }
                    function group_item_id(){
                       var group_id= $('#group_id').val();
                    //   alert(group_id);
                       var data = {'group_id': group_id}
                        $.ajax({
                            url: '<?php echo site_url('general_store/group_item_id'); ?>',
                            data: data,
                            method: 'POST',
                            dataType: 'json',
                            success: function (msg) {
                                if(msg.group_id!=""){
                                    var item_id=Number(msg.group_id[0].item_code)+1;
                                }else{
                                   item_id=""; 
                                }
                              
                                var item_sl_no;
                                if(item_id!=''){
                                     if(item_id>999){
                                        item_sl_no=item_id;
                                    }else if(item_id>99){
                                        item_sl_no=msg.group_info[0].group_short_name+"0"+item_id;
                                    }else if(item_id>9){
                                        item_sl_no=msg.group_info[0].group_short_name+"00"+item_id;
                                    }else{
                                        item_sl_no=msg.group_info[0].group_short_name+"000"+item_id;
                                    }
                                }else{
                                    item_id=1;
                                    item_sl_no=msg.group_info[0].group_short_name+'0001';
                                }
                               
                                $('#item_c').val(item_id);
                                $('#item_code').val(item_sl_no);
                                $('#item_code1').val(item_sl_no);
                            }

                       })
                    }
                </script>
                    