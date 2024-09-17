<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
             <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(1, 1, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'supplier_information') echo 'active'; ?>" href="<?php echo site_url('backend/general_store'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Supplier Info</span>
                    </a>
                </li>
                <?php } ?> 
                <?php $this->role = checkUserPermission(1, 33, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'service_info') echo 'active'; ?>" href="<?php echo site_url('backend/services'); ?>">
                        <i class="fa fa-wrench"></i><br><span>Service Info  </span>
                    </a>
                </li>
                <?php } ?> 
                
                 <?php $this->role = checkUserPermission(1, 34, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'indent_type') echo 'active'; ?>" href="<?php echo site_url('backend/indent_type'); ?>">
                            <i class="fa fa-align-justify"></i><br><span>Indent Type  </span>
                        </a>
                    </li>
                <?php } ?> 
                    
               <?php $this->role = checkUserPermission(1, 35, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'payment_mode') echo 'active'; ?>" href="<?php echo site_url('backend/payment_mode'); ?>">
                           <i class="fa fa-align-justify"></i><br><span>Payment Mode  </span>
                        </a>
                    </li>
                <?php } ?>      
                
                <?php $this->role = checkUserPermission(1, 2, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>      
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'item_category') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/item_category'); ?>">
                        <i class="fa fa-cc"></i><br><span>ITEM CATEGORY</span></a>
                </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(1, 3, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'item_group_information') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/item_group_information'); ?>">
                        <i class="fa fa-object-group"></i><br><span>ITEM GROUP</span></a>
                </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(1, 4, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>           
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'item_information') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/item_information'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>ITEM Info</span></a>
                </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(1, 5, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'department') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/department'); ?>">
                        <i class="fa fa-cubes"></i><br><span>UNIT</span></a>
                </li>
                <?php }?>
                <?php $this->role = checkUserPermission(1, 6, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'cost_center') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/cost_center'); ?>">
                        <i class="fa fa-home"></i><br><span>COST CENTER</span></a>
                </li>
                <?php }?>
                <?php $this->role = checkUserPermission(1, 36, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'designation') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/designation'); ?>">
                        <i class="fa fa-certificate"></i><br><span>DESIGNATION</span></a>
                </li>
                <?php }?>
                <?php $this->role = checkUserPermission(1, 37, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'employee') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/employee'); ?>">
                        <i class="fa fa-user"></i><br><span>USERS</span></a>
                </li>
                <?php } ?>
                <?php //$this->role = checkUserPermission(1, 38, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>   
                <?php if($user_type==1){ ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->sub_inner_menu == 'acl') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/acl'); ?>">
                                <i class="fa fa-user-times"></i><br><span>ACL ROLE</span></a>
                        </li>
                <?php } ?>    
                <?php //}?>
            </ul>
        </div>
    </div>
    
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Item Information</h3>
            </div>
        </div>
    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 <div class="x_content">
                     <form class="form-horizontal" action="<?php echo site_url('general_store/add_action_item_information'); ?>" method="post" enctype="multipart/form-data">
                         
                         
                         <div class='form-group' >
                         <label for="title" class="col-sm-2 control-label">
                           Consumable Or Asset :
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <select id="item_type" class="form-control" name="item_type" onchange="javascript:item_type_info();">
                                   
                                    
                                            <option class="form-control" value="Consumable">Consumable</option>
                                            <option class="form-control" value="Asset">Asset</option>
                                  
                                </select>
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Item Group :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                             <select required id="group_id" class="form-control" name="item_group" onchange="javascript:group_item_id();">
                                    <option class="form-control" value="">Select Item Group</option>
                                    <?php foreach($item_groups as $item_group){ ?>
                                            <option class="form-control" value="<?php echo $item_group['id']; ?>"><?php echo $item_group['item_group']; ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                             
                         </div>
                         
                         <div class='form-group' >
                             <label for="title" class="col-sm-2 control-label">
                            Item Category:
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                             <select required id="item_category" class="form-control" name="item_category" >
                                    <option class="form-control" value="">Select Item Category</option>
                                    <?php foreach($categories as $category){ ?>
                                            <option class="form-control" value="<?php echo $category['c_id']; ?>"><?php echo $category['c_name']; ?></option>
                                    <?php } ?>
                                </select>
                        </div> 
                             
                             
                         <label for="title" class="col-sm-2 control-label">
                            Item Code :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                             <input id="item_c" type="hidden" name="item_c" value="" >
                                <input id="item_code" class="form-control"  name="item_code" type="hidden" value="">
                                <input id="item_code1" disabled  class="form-control"  name="item_code1" type="text" value="">
                        </div>
                            
                         </div>
                         
                         <div class='form-group' >
                                 <label for="title" class="col-sm-2 control-label">
                                    Item Name :
                                </label>
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                       <input required class="form-control" id="inputdefault" name="item_name" type="text">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Item Grade :
                                </label>
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                       <input  class="form-control" id="inputdefault" name="item_grade" type="text">
                                </div>
                         </div>
                         
                         
                       <div class='form-group' >
                                 <label for="title" class="col-sm-2 control-label">
                                   Type1 :
                                </label>
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                       <input  class="form-control" id="inputdefault" name="type1" type="text">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Type2 :
                                </label>
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                       <input  class="form-control" id="inputdefault" name="type2" type="text">
                                </div>
                         </div>   
                         
                         
                         
                         <div class='form-group' >
                             <label for="title" class="col-sm-2 control-label">
                            Brand :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                             <input class="form-control" id="inputdefault" name="brand" type="text">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Origin :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                               <input required class="form-control" id="inputdefault" name="origin" type="text">
                        </div>
                         </div>
                         
                         <div class='form-group' >
                             <label for="title" class="col-sm-2 control-label">
                            M.unit :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                             <input required class="form-control" id="inputdefault" name="meas_unit" type="text">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Part No. :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                               <input class="form-control" id="inputdefault" name="port_no" type="text" value="">
                        </div>
                         </div>
                         
                         <div class='form-group' >
                             <label for="title" class="col-sm-2 control-label">
                            Opening Stock:
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                             <input class="form-control" id="opening_stock" name="opening_stock" type="text" onkeyup="javascript:calculate_opeing_value();">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                           Unit Price.. :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                               <input onkeyup="javascript:calculate_opeing_value();" class="form-control" id="unit_price" name="unit_price" type="text" value="">
                        </div>
                         </div>
                         
                         
                         <div class='form-group' >
                             <label for="title" class="col-sm-2 control-label">
                            Opening Value:
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                             <input class="form-control" id="item_value" name="opening_value" type="hidden">
                                <input disabled class="form-control" id="item_value1" name="item_value" type="text">
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
                                    Size :
                                </label>
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                       <input  class="form-control" id="inputdefault" name="size" type="text">
                                </div>
                                
                         </div>
                         
                     <!--    
                         <div class='form-group' >
                             <label for="title" class="col-sm-2 control-label">
                            Item Category:
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                             <select required id="item_category" class="form-control" name="item_category" >
                                    <option class="form-control" value="">Select Item Category</option>
                                    <?php foreach($categories as $category){ ?>
                                            <option class="form-control" value="<?php echo $category['c_id']; ?>"><?php echo $category['c_name']; ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                           Status :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                               <select class="form-control" name="item_status">
                            <option class="form-control" value="Active">Active</option>
                            <option class="form-control" value="Inactive">Inactive</option>
                        </select>
                        </div>
                         </div>
                         -->
                         
                         <div class='form-group' style="display: none;">
                           <label for="title" class="col-sm-2 control-label">
                           Purchase Date :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                               <input class="form-control datepicker" id="pur_date" name="purchase_date" type="text">
                        </div>
                         </div>
                         
                         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Image Upload :
                                </label>
                                <div class="col-sm-10 input-group">

                                    <div class="well" data-bind="fileDrag: multiFileData">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <!-- ko foreach: {data: multiFileData().dataURLArray, as: 'dataURL'} -->
                                                <img style="height: 100px; margin: 5px;" class="img-rounded  thumb" data-bind="attr: { src: dataURL }, visible: dataURL">
                                                <!-- /ko -->
                                                <div data-bind="ifnot: fileData().dataURL">
                                                    <label class="drag-label">Drag files here</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input name="e_image[]" type="file" multiple data-bind="fileInput: multiFileData, customFileInput: {
	              buttonClass: 'btn btn-success',
	              fileNameClass: 'disabled form-control',
	              onClear: onClear,
	              onInvalidFileDrop: onInvalidFileDrop
	            }" accept="image/*">
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                         
                         
                         <div class="form-group" style="margin-top: 40px;">
                        <div class=" col-sm-2">
                            <button type="submit" class="btn btn-primary button">SAVE</button>
                        </div>
                        <div class="col-sm-2">
                           <a href="<?php echo site_url('backend/general_store/item_information') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
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