<?php
    $user_id = $this->session->userdata('user_id');
    $user_type = $this->session->userdata('user_type');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(1, 4, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
        <?php       
            require_once(__DIR__ .'/../../rm_setup_header.php');
        ?>
    </div>
    
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Material Information</h3>
            </div>
        </div>
    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 <div class="x_content">
                     <form class="form-horizontal" action="<?php echo site_url('raw_materials/rm_setup/add_rm_action'); ?>" method="post" enctype="multipart/form-data">
                         
                         
                         
                         
                         <div class='form-group' >
                             
                        <label for="title" class="col-sm-2 control-label">
                            Material Group<sup style="color:red;">*</sup> :
                        </label>
                             <div class="col-sm-10 input-group">
                                 <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                             <select required id="item_category" class="form-control e1" name="item_category" >
                                    <option class="form-control" value="">Select Item Group</option>
                                    <?php foreach($categories as $category){ ?>
                                            <option class="form-control" value="<?php echo $category['c_id']; ?>"><?php echo $category['c_name'].'('.$category['c_description'].")"."(".$category['start_code']."-".$category['end_code'].")"; ?></option>
                                    <?php } ?>
                                </select>
                        </div>  
                             
                             
                        
                        <!--     
                             <label for="title" class="col-sm-2 control-label">
                            Item Group<sup style="color:red;">*</sup> :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                             <select required id="group_id" class="form-control" name="item_group" onchange="javascript:group_item_id();">
                                    <option class="form-control" value="">Select Item Category</option>
                                    <?php foreach($item_groups as $item_group){ ?>
                                            <option class="form-control" value="<?php echo $item_group['id']; ?>"><?php echo $item_group['item_group']; ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        -->
                             
                         </div>
                         
                         <div class='form-group' >
                             
                             
                             
                         <label for="title" class="col-sm-2 control-label">
                            Material Code<sup style="color:red;">*</sup> :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                             <input id="item_c" type="hidden" name="item_c" value="" >
                                <input id="item_number" class="form-control"  name="item_number" type="hidden" value="">
                                <input id="item_code" class="form-control"  name="item_code" type="hidden" value="">
                                <input id="item_code1" readonly  class="form-control"  name="item_code" type="text" value="">
                        </div>
                             
                             
                             
                         <label for="title" class="col-sm-2 control-label">
                                    Material Name<sup style="color:red;">*</sup> :
                                </label>
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                       <input required class="form-control" id="inputdefault" name="item_name" type="text">
                                </div>   
                             
                             
                             
                             
                            
                         </div>
                         
                         <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                                Type/Grade :
                            </label>
                                 <div class="col-sm-4 input-group">
                                     <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                   <input  class="form-control" id="item_grade" name="item_grade" type="text">
                            </div>
                             
                            <label for="title" class="col-sm-2 control-label">
                                Origin :
                            </label>
                            <div class="col-sm-4 input-group">
                                   <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                   <input  class="form-control" id="inputdefault" name="origin" type="text">
                            </div>
                             
                                
                             
                             
                               
                         </div>
                         
                       
                      
                         
                         
                         
                         <div class='form-group' >
                             
                            <label for="title" class="col-sm-2 control-label">
                                    Measurement Unit<sup style="color:red;">*</sup> :
                            </label>
                            <div class="col-sm-4 input-group">
                                       <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                       <select required id="group_id" class="form-control e1" name="mu_id" >
                                                <option class="form-control" value="">Select</option>
                                                <?php foreach($measurement_units as $measurement_unit){ ?>
                                                        <option class="form-control" value="<?php echo $measurement_unit['id']; ?>"><?php echo $measurement_unit['meas_unit']; ?></option>
                                                <?php } ?>
                                       </select>
                            </div> 
                             
                            <label for="title" class="col-sm-2 control-label">
                                Store Location :
                            </label>
                                  <div class="col-sm-4 input-group">
                                      <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input class="form-control" id="inputdefault" name="store_location" type="text">
                             </div> 
                              
                             
                        </div>
                            
                       
                         
                        <div class='form-group' >
                                 
                            <label for="title" class="col-sm-2 control-label">
                                 Minimum Level :
                            </label>
                            <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();" class="form-control number" id="inputdefault" name="min_level" type="text">
                             </div> 
                              
                              
                            <label for="title" class="col-sm-2 control-label">
                                 Maximum Level :
                            </label>
                            <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();"  class="form-control number" id="inputdefault" name="max_level" type="text">
                            </div>
                                
                         </div>
                         
                         
                        <div class='form-group' >
                                 
                             <label for="title" class="col-sm-2 control-label">
                                 Order Level :
                             </label>
                                  <div class="col-sm-4 input-group">
                                      <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();" class="form-control number" id="inputdefault" name="order_level" type="text">
                             </div> 
                              
                              
                               <label for="title" class="col-sm-2 control-label">
                                    Moving Type :
                                </label>
                                     <div class="col-sm-4 input-group">
                                       <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                       <select  id="moving_type" class="form-control" name="moving_type">
                                   
                                            <option class="form-control" value="">Select</option>
                                            <option class="form-control" value="fast">Fast</option>
                                            <option class="form-control" value="medium">Medium</option>
                                            <option class="form-control" value="slow">Slow</option>

                                        </select>
                                </div>
                                
                         </div>  
                         
                         
                         
                          <div class='form-group' >
                                 
                            
                              
                               <label for="title" class="col-sm-2 control-label">
                                    Remark :
                                </label>
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                       <input  class="form-control" id="inputdefault" name="remark" type="text">
                                </div>
                                
                         </div>
                         
                    
                        
                         
                         
                         
                       
                         
                         
                         <div class="form-group" style="margin-top: 40px;">
                              <div class="col-sm-2">
                                <a href="<?php echo site_url('backend/raw_materials/rm_setup') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                             </div>
                             
                            <div class=" col-sm-2">
                                <button type="submit" class="btn btn-primary button">SAVE</button>
                            </div>
                             
                            <div class=" col-sm-2">
                                <button type="reset" class="btn btn-success button">CLEAR</button>
                            </div>  
                      
                    </div>
                     </form>     
                    </div>
                    </div>
                    </div>
                    </div>

</div>
</div>

<script type="text/javascript">
                   $('.select2').select2(); 
                   
                   
                   function checkNumeric(){
                        $('.number').on('input', function (event) {
                           var val = $(this).val();
                           if (isNaN(val)) {
                               val = val.replace(/[^0-9\.]/g, '');
                               if (val.split('.').length > 2)
                                   val = val.replace(/\.+$/, "");
                           }
                           $(this).val(val);  
                       });
                   }                  
                   
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
                        if(item_type=="ASSET"){
                            
//                            $('#max_lebel').val('');
//                            $('#min_lebel').val('');
//                            $('#item_lebel').val('');
//                            $('#order_lebel').val('');
//                            
//                            $('#min_level').hide();
//                            $('#max_level').hide();
//                            $('#order_level').hide();
//                            $('#item_head').hide();
                            
                            $('#item_category').show();
                            $('#purchase_date').show();
                            

                        }else{
//                            $('#min_level').show();
//                            $('#max_level').show();
//                            $('#order_level').show();
//                            $('#item_head').show();   
//                            
//                            //$('#item_cat').val('');
//                            $('#pur_date').val('');
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
                                              str += '<option class="form-controll" value="">Select item category</option>';
                                         $(data.data).each(function (row, val) {
                                             str += '<option class="form-controll" value="' + val.id + '">' + val.item_group + '</option>';
                                         })
                                         $('#group_id').html(str);
                                         $('#item_category').html('');
//                                         var str1 = '';
//                                              str1 += '<option class="form-controll" value="">Select item Category</option>';
//                                         $(data.data1).each(function (row, val1) {
//                                             str1 += '<option class="form-controll" value="' + val1.c_id + '">' + val1.c_name + '</option>';
//                                         })
//                                         $('#item_category').html(str1);
                            }         
                        })
                        
                        
                    }
                    function group_item_id(){
                       var group_id= $('#group_id').val();
                    //   alert(group_id);
                            if(group_id!=''){
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

                                    //    var item_sl_no;
                                    //    if(item_id!=''){
                                    //         if(item_id>999){
                                    //            item_sl_no=item_id;
                                    //        }else if(item_id>99){
                                    //            item_sl_no=msg.group_info[0].group_short_name+"0"+item_id;
                                    //        }else if(item_id>9){
                                    //            item_sl_no=msg.group_info[0].group_short_name+"00"+item_id;
                                    //        }else{
                                    //            item_sl_no=msg.group_info[0].group_short_name+"000"+item_id;
                                    //        }
                                    //    }else{
                                    //        item_id=1;
                                    //        item_sl_no=msg.group_info[0].group_short_name+'0001';
                                    //    }

                                    //    $('#item_c').val(item_id);
                                    //    $('#item_code').val(item_sl_no);
                                    //    $('#item_code1').val(item_sl_no);
                                       var str = '';
                                       str += '<option class="form-controll" value="">Select item group</option>';
                                       $(msg.groups).each(function (row, val) {
                                           str += '<option class="form-controll" value="'+val.c_id+'">'+val.c_name+'</option>';
                                       })
                                       $('#item_category').html(str);
                                   }

                              })
                            }else{
                                $('#item_category').html('');
                            }
                    }

                    $('#item_category').change(function(){
                        var group_id = $('#group_id').val();
                        var subgroup = $(this).val();
                        if(subgroup!=''){
                            
                           $('#item_code').val('');
                           $('#item_code1').val('');
                           $('#item_number').val(''); 
                            
                            
                        var data = {'group_id': group_id,'subgroup':subgroup}
                        $.ajax({
                           
                        url: '<?php echo site_url('raw_materials/rm_setup/subgroup_item_id'); ?>',
                                   data: data,
                                   method: 'POST',
                                   dataType: 'json',
                                   success: function (msg) {
                                       
                                       if(msg.item!=""){
                                        var items_number = Number(msg.item[0].item_number)+1;
                                       }else{
                                        items_number=""; 
                                       }
                                       
                                      
                                      var groupcode = msg.group_info[0].group_short_name;
                                    //  var subgroupcode = msg.groups[0].c_description;
                                    var subgroupcode = msg.groups[0].c_name;  //added by alauddin
                                     // alert(items_number);

                                           var item_sl_no;
                                       if(items_number!=''){
                                            if(items_number>999){
                                               item_sl_no=items_number;
                                           }else if(items_number>99){
                                               item_sl_no="0"+items_number;
                                           }else if(items_number>9){
                                            
                                               item_sl_no="00"+items_number;
                                           }else{
                                               item_sl_no="000"+items_number;
                                           }
                                       }else{
                                        items_number=1;
                                           item_sl_no='0001';
                                       }
                                       var codestr = groupcode+'-'+subgroupcode+''+item_sl_no;
                                      // alert(codestr);

                                    //    $('#item_c').val(item_id);
                                       $('#item_code').val(codestr);
                                       $('#item_code1').val(codestr);
                                       $('#item_number').val(item_sl_no);
                                       
                                   }

                              })
                          }else{
                             $('#item_code').val('');
                             $('#item_code1').val('');
                             $('#item_number').val('');
                          }
                    })
                </script>
                
                <script>
    var viewModel = {};
    viewModel.fileData = ko.observable({
        dataURL: ko.observable(),
        // can add "fileTypes" observable here, and it will override the "accept" attribute on the file input
        // fileTypes: ko.observable('.xlsx,image/png,audio/*')
    });
    viewModel.multiFileData = ko.observable({dataURLArray: ko.observableArray()});
    viewModel.onClear = function (fileData) {
        if (confirm('Are you sure?')) {
            fileData.clear && fileData.clear();
        }
    };
    viewModel.debug = function () {
        window.viewModel = viewModel;
        console.log(ko.toJSON(viewModel));
        debugger;
    };
    viewModel.onInvalidFileDrop = function (failedFiles) {
        var fileNames = [];
        for (var i = 0; i < failedFiles.length; i++) {
            fileNames.push(failedFiles[i].name);
        }
        var message = 'Invalid file type: ' + fileNames.join(', ');
        alert(message)
        console.error(message);
    };
    ko.applyBindings(viewModel);
</script>