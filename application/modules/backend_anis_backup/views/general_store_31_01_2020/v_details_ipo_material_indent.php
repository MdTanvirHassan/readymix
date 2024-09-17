<style type="text/css">
    .input-group{
        padding-top:7px;
    }
    table{
        margin-top: 20px;
    }
</style>
<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(2, 7, $userData);
       
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(2, 7, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'ipo_material_indent') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/ipo_material_indent'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>MATERIAL INDENT  </span>
                    </a>
                </li>
                <?php } ?> 
                <?php $this->role = checkUserPermission(2, 8, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'budget') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/budget'); ?>">
                        <i class="fa fa-cc"></i><br><span>BUDGET</span></a>
                </li>
                
                 <?php $this->role = checkUserPermission(2, 39, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'money_indent') echo 'active'; ?>" href="<?php echo site_url('backend/money_indent'); ?>">
                        <i class="fa fa-cc"></i><br><span>MONEY INDENT</span></a>
                </li>
                <?php } ?>
                
                <?php } ?>
                 <?php $this->role = checkUserPermission(2, 40, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'purchase_quotation') echo 'active'; ?>" href="<?php echo site_url('backend/purchase_quotations'); ?>">
                        <i class="fa fa-cc"></i><br><span>PURCHASE QUOTATION</span></a>
                </li>
                <?php } ?>
                
               
                
                 <?php $this->role = checkUserPermission(2, 41, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'purchase_order') echo 'active'; ?>" href="<?php echo site_url('backend/purchase_orders'); ?>">
                            <i class="fa fa-cc"></i><br><span>PURCHASE ORDER</span></a>
                    </li>
                <?php } ?>
               
            </ul>
        </div>
    </div>
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3 style="float:left;">Materials Indent</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('general_store/details_ipo_material_indent/'.$ipo_material_indent[0]['ipo_m_id'].'/true'); ?>" class="btn btn-sm btn-warning">PRINT</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                         <?php if($user_type==1){ ?>
        <a href="<?php echo site_url('general_store/approve_ipo_material_indent/'.$ipo_material_indent[0]['ipo_m_id']) ?>"><button class="btn btn-primary">Approve</button></a>&nbsp;&nbsp;
        <a href="<?php echo site_url('general_store/reject_ipo_material_indent/'.$ipo_material_indent[0]['ipo_m_id']) ?>"><button class="btn btn-warning">Reject</button></a>
    <?php }else{ ?>
             <?php if ($employee_id == $approvers_info[0]) { ?>
                    <?php  if(!empty($approvers_info[1])){ ?>
                            <?php if($ipo_material_indent[0]['status']=="Pending"){ ?>
                                    <a href="<?php echo site_url("general_store/forward_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-success">Forward</button></a>&nbsp;&nbsp;
                                    <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                            <?php } ?>

                     <?php }else{ ?>
                               <?php if($ipo_material_indent[0]['status']=="Pending"){ ?>
                                    <a href="<?php echo site_url("general_store/approve_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-primary">Approve</button></a>&nbsp;&nbsp;
                                    <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                               <?php } ?>
                     <?php } ?>           
            <?php } ?>
             
           <?php if ($employee_id == $approvers_info[1]) { ?>
                    <?php  if(!empty($approvers_info[2])){ ?>
                            <?php if($ipo_material_indent[0]['status']=="Forward-By-First-Approver"){ ?>
                                    <a href="<?php echo site_url("general_store/forward_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-success">Forward</button></a>&nbsp;&nbsp;
                                    <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                            <?php } ?>

                     <?php }else{ ?>
                               <?php if($ipo_material_indent[0]['status']=="Forward-By-First-Approver"){ ?>
                                    <a href="<?php echo site_url("general_store/approve_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-primary">Approve</button></a>&nbsp;&nbsp;
                                    <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                               <?php } ?>
                     <?php } ?>           
            <?php } ?>
                                  
                                  
            <?php if ($employee_id == $approvers_info[2]) { ?>
                    <?php  if(!empty($approvers_info[3])){ ?>
                            <?php if($ipo_material_indent[0]['status']=="Forward-By-Second-Approver"){ ?>
                                    <a href="<?php echo site_url("general_store/forward_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-success">Forward</button></a>&nbsp;&nbsp;
                                    <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                            <?php } ?>

                     <?php }else{ ?>
                               <?php if($ipo_material_indent[0]['status']=="Forward-By-Second-Approver"){ ?>
                                    <a href="<?php echo site_url("general_store/approve_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-primary">Approve</button></a>&nbsp;&nbsp;
                                    <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                               <?php } ?>
                     <?php } ?>           
            <?php } ?>
                                  
                                  
           <?php if ($employee_id == $approvers_info[3]) { ?>
                    
                         <?php if($ipo_material_indent[0]['status']=="Forward-By-Third-Approver"){ ?>       
                            <a href="<?php echo site_url("general_store/approve_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-primary">Approve</button></a>&nbsp;&nbsp;
                            <a href="<?php echo site_url("general_store/reject_ipo_material_indent/".$ipo_material_indent[0]['ipo_m_id']); ?>"><button class="btn btn-warning">Reject</button></a>
                         <?php } ?>      
                        
            <?php } ?>                        
                                  
                                  
                                  
    <?php } ?>   
        

                        <form class="form-horizontal" method="post" action="<?php echo site_url('general_store/edit_action_ipo_material_indent/' . $ipo_material_indent[0]['ipo_m_id']) ?>">
                            <div class="row"> 
                                <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label">
                                        Indent Number:
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                       
                                        <b> <?php if (!empty($ipo_material_indent[0]['ipo_number'])) echo $ipo_material_indent[0]['ipo_number']; ?></b>
                                       
                                    </div>
                                    
                                    <label for="title" class="col-sm-2 control-label">
                                        Indent Type<sup class="required">*</sup>:
                                    </label> 
                                    <div class="col-sm-4 input-group">

                                        <b>
                                        <?php foreach ($indent_types as $indent_type) { ?>
                                            <?php if($indent_type['id']==$ipo_material_indent[0]['indent_type']) echo $indent_type['type_name']; ?>
                                        <?php } ?>
                                     
                                        </b>    
                                    </div>
                                    
                                </div>
                            </div> 


                            <div class="row">
                                <div class='form-group' >

                                    <label for="title" class="col-sm-2 control-label">
                                        Date<span class="required">*</span> :
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        
                                        <b>  <?php if (!empty($ipo_material_indent[0]['date'])) echo date('d-m-Y',strtotime($ipo_material_indent[0]['date'])); ?></b>
                                    </div>

                                    <label for="title" class="col-sm-2 control-label">
                                        Project <span class="required">*</span>:
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                        <b>
                                        <?php if ($user_type == 1) { ?>
                                              
                                                <?php foreach ($departments as $department) { ?>
                                                   <?php if (!empty($ipo_material_indent[0]['department_id']) && $ipo_material_indent[0]['department_id'] == $department['d_id']) echo $department['dep_description'] . "(" . $department['dep_code'] . ")"; ?>
                                                <?php } ?>
                                              
                                            <?php }else { ?>
                                         
                                                <?php foreach ($departments as $department) { ?>
                                                     <?php if (!empty($ipo_material_indent[0]['department_id']) && $ipo_material_indent[0]['department_id'] == $department['d_id']) echo $department['dep_description'] . "(" . $department['dep_code'] . ")"; ?>
                                                <?php } ?>
                                           
                                            <?php } ?>
                                        </b>
                                    </div>
                                    

                                </div>
                            </div>   
                            <div class="row">
                                    <div class='form-group' >
                                        
                                        <div id="item_type" style="display:<?php if($ipo_material_indent[0]['type_name']!="Material") echo 'none'; ?>">
                                                <label for="title" class="col-sm-2 control-label">
                                                    Item Type :
                                                </label>
                                                <div class="col-sm-4 input-group">  
                                                    <b>   <?php if (!empty($ipo_material_indent[0]['ipo_item_type']) && $ipo_material_indent[0]['ipo_item_type'] == "Consumable") echo "Cosumbable";else echo 'Asset'; ?>  </b>     
                                                </div>
                                        </div>    

                                        <label for="title" class="col-sm-2 control-label">
                                            Remarks :
                                        </label> 
                                        <div class="col-sm-4 input-group">       
                                            <b><?php if (!empty($ipo_material_indent[0]['remarks'])) echo $ipo_material_indent[0]['remarks']; ?></b>                                          
                                        </div>


                                    </div>
                            </div>     
                            
                            
                            
                            <?php if($ipo_material_indent[0]['type_name'] == "Material"){ ?>
                                   <?php if ($ipo_material_indent[0]['ipo_item_type'] == "Consumable") { ?>
                                   <?php if (!empty($ipo_material_indent_details)) { ?> 
                                    <input type="hidden" id="count" value="<?php echo count($ipo_material_indent_details); ?>"/>

                                    <table class="table table-bordered" id="myTable">
                                        <thead class="thead-color">
                                            <tr>
                                               
                                                <th>Item.Code <sup>*</sup></th>
                                                <th>Item name & Description</th>
                                                <th>MU</th>

                                                <th>Stock Qty</th>
                                                <th>Indent Qty <sup>*</sup></th>
  
                                                <th>Expected Date <sup>*</sup></th>
                                                <th>Asset</th>
                                                <th>Cost Center</th>
                                                <th>Remark</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($ipo_material_indent_details as $ipo_material_indent_detail) {
                                        $i++;
                                        ?>  
                                                <tr id="row_<?php echo $i; ?>">
                                                    
                                                    <td>
                                                            
                                                        <?php foreach ($items as $item) { ?>
                                                           <?php if (!empty($ipo_material_indent_detail['item_id']) && $ipo_material_indent_detail['item_id'] == $item['id']) echo $item['item_code'] . "(" . $item['item_name'] . ")"; ?>
                                                        <?php } ?>
                                                       </td>
                                                    <td><?php if (!empty($ipo_material_indent_detail['item_name_description'])) echo $ipo_material_indent_detail['item_name_description']; ?></td>
                                                    <td><?php if (!empty($ipo_material_indent_detail['unit'])) echo $ipo_material_indent_detail['unit']; ?></td>

                                                   
                                                    <td><?php if (!empty($ipo_material_indent_detail['stock_qty'])) echo $ipo_material_indent_detail['stock_qty']; ?></td>
                                                    <td><?php if (!empty($ipo_material_indent_detail['indent_qty'])) echo $ipo_material_indent_detail['indent_qty']; ?></td>

                                                   
                                                    <td><?php if (!empty($ipo_material_indent_detail['expected_date'])) echo date('d-m-Y', strtotime($ipo_material_indent_detail['expected_date'])); ?></td>
                                                    <td> 
                                                       
                                                            <?php foreach ($assets as $asset) { ?>
                                                                <?php if (!empty($ipo_material_indent_detail['asset_id']) && $ipo_material_indent_detail['asset_id'] == $asset['id']) echo $asset['item_name'] . "(" . $asset['item_code'] . ")"; ?>
                                                            <?php } ?>
                                                     

                                                    </td>
                                                    <td>
                                                            <?php foreach ($cost_centers as $cost_center) { ?>
                                                               <?php if (!empty($ipo_material_indent_detail['c_c_id']) && $ipo_material_indent_detail['c_c_id'] == $cost_center['c_c_id']) echo $cost_center['c_c_name']; ?>
                                                            <?php } ?>
                                                    </td> 

                                                <td>
                                                   <?php if (!empty($ipo_material_indent_detail['remark'])) echo $ipo_material_indent_detail['remark']; ?>
                                                </td>


                                                </tr>
                                            <?php } ?>        
                                        </tbody>
                                    </table>
                                <?php } ?>

                             



                            <?php }else { ?>  

                             

                                <?php if (!empty($ipo_material_indent_details)) { ?> 
                                    <input type="hidden" id="a_count" value="<?php echo count($ipo_material_indent_details); ?>"/>

                                    <table class="table table-bordered" id="myTable1">
                                        <thead class="thead-color">
                                            <tr class="row">
                                               
                                                <th>Item.Code <sup>*</sup></th>
                                                <th>Item name & Description</th>
                                                <th>Measurement Unit</th>

                                                <th>Last Unit Price</th>
                                                <th>Last Supplier</th>

                                                <th>Stock Qty</th>
                                                <th>Indent Qty <sup>*</sup></th>
                                                <th>unit Price</th>
                                            <!--    <th>Asset</th>-->
                                                <th>Expected Date <sup>*</sup></th>
                                                <th>Cost Center</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($ipo_material_indent_details as $ipo_material_indent_detail) {
                                                $i++;
                                                ?>  
                                                <tr class="row" id="row_<?php echo $i; ?>">
                                                   
                                                    <td> 
                                                            <?php foreach ($items as $item) { ?>
                                                               <?php if (!empty($ipo_material_indent_detail['item_id']) && $ipo_material_indent_detail['item_id'] == $item['id']) echo $item['item_code'] . "(" . $item['item_name'] . ")"; ?>
                                                            <?php } ?>
                                                        </td>
                                                    <td><?php if (!empty($ipo_material_indent_detail['item_name_description'])) echo $ipo_material_indent_detail['item_name_description']; ?></td>
                                                    <td><?php if (!empty($ipo_material_indent_detail['unit'])) echo $ipo_material_indent_detail['unit']; ?></td>

                                                 
                                                    <td><?php if (!empty($ipo_material_indent_detail['stock_qty'])) echo $ipo_material_indent_detail['stock_qty']; ?></td>
                                                    <td><?php if (!empty($ipo_material_indent_detail['indent_qty'])) echo $ipo_material_indent_detail['indent_qty']; ?></td>

                                                 
                                                    <td><?php if (!empty($ipo_material_indent_detail['expected_date'])) echo date('d-m-Y', strtotime($ipo_material_indent_detail['expected_date'])); ?></td>
                                                    <td>
                                                            <?php foreach ($cost_centers as $cost_center) { ?>
                                                               <?php if (!empty($ipo_material_indent_detail['c_c_id']) && $ipo_material_indent_detail['c_c_id'] == $cost_center['c_c_id']) echo $cost_center['c_c_name']; ?>
                                                            <?php } ?>
                                                       </td> 
                                                <td>
                                                  <?php if (!empty($ipo_material_indent_detail['remark'])) echo $ipo_material_indent_detail['remark']; ?>
                                                </td>

                                                </tr>
                                    <?php } ?>        
                                        </tbody>
                                    </table>
    <?php } ?>





<?php } ?>
          <?php }else{ ?> 
                                     <table class="table table-bordered" id="serviceTable" style="">
                                        <thead class="thead-color">
                                            <tr>
                                              
                                                <th>Service<sup>*</sup></th>
                                                <th>Expected Date<sup>*</sup></th>
                                                <th>Remark</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($ipo_material_indent_details as $ipo_material_indent_detail) {
                                        $i++;
                                        ?>  
                                            <tr class="" id="row_<?php echo $i; ?>">
                                                
                                                <td> 
                                                        <?php foreach ($services as $service) { ?>
                                                            <?php if($service['id']==$ipo_material_indent_detail['service_id']) echo $service['service_name']; ?>
                                                        <?php } ?>
                                               </td>

                                                <td><?php if (!empty($ipo_material_indent_detail['expected_date'])) echo $ipo_material_indent_detail['expected_date']; ?></td>
                                                <td>
                                                   <?php if (!empty($ipo_material_indent_detail['remark'])) echo $ipo_material_indent_detail['remark']; ?>
                                                </td>


                                            </tr>
                                    <?php } ?>        
                                        </tbody>
                                    </table>
                  <?php } ?>        
                            <div class="row" style="margin-bottom: 20px">
                                
                                <!--
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary button">UPDATE</button>
                                </div>
                                -->
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/general_store/ipo_material_indent') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                                </div>

                            </div>

                            <div class="row">

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


    function calculateEstvalueConsume(id) {
        var last_rate = Number($('#last_unit_price_c_' + id).val());
        var indent_quantity = Number($('#indent_qty_c_' + id).val());
        var stock_quantity = Number($('#stock_qty_c_' + id).val());
        var est_value = last_rate * indent_quantity;
        $('#unit_price_c_' + id).val(est_value);
        $('#unit_price_c1_' + id).val(est_value);
//        if(indent_quantity>stock_quantity){
//             $('#indent_process_status').val('applied');
//        }else{
//            $('#indent_process_status').val('processed');
//        }

    }

    function calculateEstvalueAsset(id) {
        var last_rate = Number($('#last_unit_price_a_' + id).val());
        var indent_quantity = Number($('#indent_qty_a_' + id).val());
        var est_value = last_rate * indent_quantity;
        $('#unit_price_a_' + id).val(est_value);
        $('#unit_price_a1_' + id).val(est_value);


    }


    function consumable_or_asset() {
//       var item_type=$('#ipo_item_type').val();
//       if(item_type=="Consumable"){
//           $('#myTable').show();
//           $('#myTable1').hide();
//       }else{
//           $('#myTable').hide();
//           $('#myTable1').show();
//       }

        var item_type = $('#ipo_item_type').val();
        var data = {'item_type': item_type}
        if (item_type == "Consumable") {
            $.ajax({
                url: '<?php echo site_url('general_store/item_list'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {
                    var str = '<option value="0">Select Item</option>';
                    $(msg.item_list).each(function (i, v) {
                        //   alert('test');
                        str += '<option value="' + v.id + '">' + v.item_name + "(" + v.item_code + ")" + '</option>';
                    });
                    $('#item_c_1').html(str);
                    // $('.selectpicker').selectpicker('refresh');
                }

            })
            $('#myTable').show();
            $('#myTable1').hide();
        } else {
            $.ajax({
                url: '<?php echo site_url('general_store/item_list'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {
                    var str = '<option value="0">Select Item</option>';
                    $(msg.item_list).each(function (i, v) {
                        //   alert('test');
                        str += '<option value="' + v.id + '">' + v.item_name + "(" + v.item_code + ")" + '</option>';
                    });
                    $('#item_a_1').html(str);
                    // $('.selectpicker').selectpicker('refresh');
                }

            })
            $('#myTable').hide();
            $('#myTable1').show();
        }

    }





    function item_info(id) {
//   alert('test');
        var item_type = $('#ipo_item_type').val();
//        if(id==1 && item_type=="Consumable" ){
//            var itemId = $('#item_c_'+id).val();
//        }else if(id==1 && item_type=="Asset" ){
//            var itemId = $('#item_a_'+id).val();
//        }else{
//            var itemId = $('#item_'+id).val();
//        }

        if (item_type == "Consumable") {
            var itemId = $('#item_c_' + id).val();
        } else {
            var itemId = $('#item_a_' + id).val();
        }

        var data = {'itemId': itemId}
        $.ajax({
            url: '<?php echo site_url('general_store/item_info'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
//                $('#item_des_'+id).val(msg.item_info[0].item_name);
//                $('#unit_'+id).val(msg.item_info[0].meas_unit);
//                $('#stock_qty_'+id).val(msg.item_info[0].stock_amount);
                var item_type = $('#ipo_item_type').val();
                //alert(item_type);

//                if(id==1 && item_type=="Consumable" ){
//                    $('#item_des_c_'+id).val(msg[0].item_name);
//                    $('#unit_c_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_c_'+id).val(msg[0].stock_amount);
//                }else if(id==1 && item_type=="Asset" ){
//                 //   alert(item_type);
//                    $('#item_des_a_'+id).val(msg[0].item_name);
//                    $('#unit_a_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_a_'+id).val(msg[0].stock_amount);
//                }else{    
//                    $('#item_des_'+id).val(msg[0].item_name);
//                    $('#unit_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_'+id).val(msg[0].stock_amount);
//                }
//               if(item_type=="Consumable" ){
//                    $('#item_des_c_'+id).val(msg[0].item_name);
//                    $('#unit_c_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_c_'+id).val(msg[0].stock_amount);
//                }else{        
//                    $('#item_des_a_'+id).val(msg[0].item_name);
//                    $('#unit_a_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_a_'+id).val(msg[0].stock_amount);
//                }

                if (item_type == "Consumable") {
                    var item_description = msg.item_info[0].item_name + "," + msg.item_info[0].port_no + "," + msg.item_info[0].brand;
                    $('#item_des_c_' + id).val(item_description);
                    $('#item_des_c1_' + id).val(item_description);
                    $('#unit_c_' + id).val(msg.item_info[0].meas_unit);
                    $('#unit_c1_' + id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_c_' + id).val(msg.item_info[0].stock_amount);
                    $('#stock_qty_c1_' + id).val(msg.item_info[0].stock_amount);

                    if (msg.item_previous_info != '') {
                        $('#last_unit_price_c_' + id).val(msg.item_previous_info[0].unit_price);
                        $('#last_unit_price_c1_' + id).val(msg.item_previous_info[0].unit_price);
                        var supplier = msg.item_previous_info[0].SUP_NAME + "(" + msg.item_previous_info[0].CODE + ")";
                    } else {
                        $('#last_unit_price_c_' + id).val('');
                        $('#last_unit_price_c1_' + id).val('');
                        var supplier = '';
                    }

                    $('#last_supllier_c_' + id).val(supplier);
                    $('#last_supllier_c1_' + id).val(supplier);
                } else {
                    var item_description = msg.item_info[0].item_name + "," + msg.item_info[0].port_no + "," + msg.item_info[0].brand;
                    $('#item_des_a_' + id).val(item_description);
                    $('#item_des_a1_' + id).val(item_description);
                    $('#unit_a_' + id).val(msg.item_info[0].meas_unit);
                    $('#unit_a1_' + id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_a_' + id).val(msg.item_info[0].stock_amount);
                    $('#stock_qty_a1_' + id).val(msg.item_info[0].stock_amount);

                    if (msg.item_previous_info != '') {
                        $('#last_unit_price_a_' + id).val(msg.item_previous_info[0].unit_price);
                        $('#last_unit_price_a1_' + id).val(msg.item_previous_info[0].unit_price);
                        var supplier = msg.item_previous_info[0].SUP_NAME + "(" + msg.item_previous_info[0].CODE + ")";
                    } else {
                        $('#last_unit_price_a_' + id).val('');
                        $('#last_unit_price_a1_' + id).val('');
                        var supplier = '';
                    }

                    $('#last_supllier_a_' + id).val(supplier);
                    $('#last_supllier_a1_' + id).val(supplier);


                }

            }
        })

    }




    function item_info_pre(id) {
        // var itemId = $('#item_'+id).val();
        var item_type = $('#ipo_item_type').val();
        if (item_type == "Consumable") {
            var itemId = $('#item_c_' + id).val();
        } else {
            var itemId = $('#item_a_' + id).val();
        }
        var data = {'itemId': itemId}
        $.ajax({
            url: '<?php echo site_url('general_store/item_info'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
//                $('#item_des_'+id).val(msg[0].item_name);
//                $('#unit_'+id).val(msg[0].meas_unit);
//                $('#stock_qty_'+id).val(msg[0].stock_amount);
                var item_type = $('#ipo_item_type').val();
//                 if(item_type=="Consumable" ){
//                    $('#item_des_c_'+id).val(msg[0].item_name);
//                    $('#unit_c_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_c_'+id).val(msg[0].stock_amount);
//                }else{        
//                    $('#item_des_a_'+id).val(msg[0].item_name);
//                    $('#unit_a_'+id).val(msg[0].meas_unit);
//                    $('#stock_qty_a_'+id).val(msg[0].stock_amount);
//                }

                if (item_type == "Consumable") {
                    $('#item_des_c_' + id).val(msg.item_info[0].item_name);
                    $('#unit_c_' + id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_c_' + id).val(msg.item_info[0].stock_amount);

                    if (msg.item_previous_info != '') {
                        $('#last_unit_price_c_' + id).val(msg.item_previous_info[0].unit_price);
                        var supplier = msg.item_previous_info[0].NAME + "(" + msg.item_previous_info[0].CODE + ")";
                    } else {
                        $('#last_unit_price_c_' + id).val('');
                        var supplier = '';
                    }

                    $('#last_supllier_c_' + id).val(supplier);
                } else {
                    $('#item_des_a_' + id).val(msg.item_info[0].item_name);
                    $('#unit_a_' + id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_a_' + id).val(msg.item_info[0].stock_amount);

                    if (msg.item_previous_info != '') {
                        $('#last_unit_price_a_' + id).val(msg.item_previous_info[0].unit_price);
                        var supplier = msg.item_previous_info[0].NAME + "(" + msg.item_previous_info[0].CODE + ")";
                    } else {
                        $('#last_unit_price_a_' + id).val('');
                        var supplier = '';
                    }

                    $('#last_supllier_a_' + id).val(supplier);


                }



            }
        })

    }


    $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr = $('#item_c_1').html();
        var assetstr = $('#asset_c_1').html();
        var str = '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str += '<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        // str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"></td>    <td><input type="text"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
        //  str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_unit_price[]" id="last_unit_price_c_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_supplier[]" id="last_supllier_c_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
        //     str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="hidden"  name="item_name_description[]" id="item_des_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description[]" id="item_des_c1_'+(Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit[]" id="unit_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit[]" id="unit_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price[]" id="last_unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supplier[]" id="last_supllier_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supplier[]" id="last_supllier_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="hidden"  name="stock_qty[]" id="stock_qty_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty[]" id="stock_qty_c1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueConsume('+(Number(count) + 1)+')" class="issue"></td><td><input type="hidden"  name="unit_price[]" id="unit_price_c_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price[]" id="unit_price_c1_'+(Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_c_'+(Number(count) + 1) + '" class="form-control">'+assetstr+'</select></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
        str += '<td><select class="e1" style="width:200px;" onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_' + (Number(count) + 1) + '" class="form-control">' + itemstr + '</select></td>';
        str += '<td><input type="hidden"  name="item_name_description[]" id="item_des_c_' + (Number(count) + 1) + '" class="issue"><input style="width:140px;" disabled type="text"  name="item_name_description[]" id="item_des_c1_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input type="hidden"  name="unit[]" id="unit_c_' + (Number(count) + 1) + '" class="issue"><input style="width:60px;" disabled type="text"  name="unit[]" id="unit_c1_' + (Number(count) + 1) + '" class="issue"></td> ';
        str += '<td><input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_' + (Number(count) + 1) + '" class="issue"><input style="width:60px;" disabled type="text"  name="last_unit_price[]" id="last_unit_price_c1_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input type="hidden"  name="last_supplier[]" id="last_supllier_c_' + (Number(count) + 1) + '" class="issue"><input style="width:100px;" disabled type="text"  name="last_supplier[]" id="last_supllier_c1_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input type="hidden"  name="stock_qty[]" id="stock_qty_c_' + (Number(count) + 1) + '" class="issue"><input style="width:40px;" disabled type="text"  name="stock_qty[]" id="stock_qty_c1_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input required style="width:40px;" type="text"  name="indent_qty[]" id="indent_qty_c_' + (Number(count) + 1) + '" onkeyup="calculateEstvalueConsume(' + (Number(count) + 1) + ')" class="issue"></td>';
        str += '<td><input  type="hidden"  name="unit_price[]" id="unit_price_c_' + (Number(count) + 1) + '" class="issue"><input style="width:80px;" disabled type="text"  name="unit_price[]" id="unit_price_c1_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input style="width:100px;" class="datepicker" type="text"  name="expected_date[]" class="issue"></td>';
        str += '<td><select class="e1" style="width:200px;" name="asset_id[]" id="asset_c_' + (Number(count) + 1) + '" class="form-control">' + assetstr + '</select></td>';
        str += '<td><textarea style="width:200px;" name="remark[]"></textarea></td>';
        str += '</tr>';
        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
        $('.datepicker1').datepicker({
            //  format: 'DD-MM-YYYY'
            dateFormat: 'dd-mm-yy',
            //maxDate: new Date
        });
//        $('.time').datetimepicker();
//        $('.datepicker').datetimepicker({
//            format: 'DD-MM-YYYY'
//        });                                     
//        $('.monthpicker').datetimepicker({
//            format: 'YYYY-MM'
//        });
        $('select.e1').select2();
        $('.chzn-container').remove();
    });


    $('#button3').click(function () {
        var count = $('#a_count').val();
        var itemstr = $('#item_a_1').html();
        // var assetstr=$('#asset_1').html();
        var assetstr = $('#asset_1').html();

        var str = '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str += '<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button4" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        // str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"></td>    <td><input type="text"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_'+(Number(count) + 1) + '" class="form-control">'+assetstr+'</select></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
        //  str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_unit_price_a[]" id="last_unit_price_a_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text"  name="last_supllier_a[]" id="last_supllier_a_'+(Number(count) + 1) + '" class="issue"></td>   <td><input type="text"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_'+(Number(count) + 1) + '" class="form-control">'+assetstr+'</select></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
        //   str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="hidden"  name="item_name_description_a[]" id="item_des_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description_a[]" id="item_des_a1_'+(Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit_a[]" id="unit_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_a[]" id="unit_a1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price_a[]" id="last_unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supllier_a[]" id="last_supllier_a1_'+(Number(count) + 1) + '" class="issue"></td>   <td><input type="hidden"  name="stock_qty_a[]" id="stock_qty_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty_a[]" id="stock_qty_a1_'+(Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_'+(Number(count) + 1) + '" onkeyup="calculateEstvalueAsset('+(Number(count) + 1)+')" class="issue"></td><td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_'+(Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price_a[]" id="unit_price_a1_'+(Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
        str += '<td><select class="e1" style="width:200px;" onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_' + (Number(count) + 1) + '" class="form-control">' + itemstr + '</select></td>';
        str += '<td><input type="hidden"  name="item_name_description_a[]" id="item_des_a_' + (Number(count) + 1) + '" class="issue"><input style="width:140px;" disabled type="text"  name="item_name_description_a[]" id="item_des_a1_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input type="hidden"  name="unit_a[]" id="unit_a_' + (Number(count) + 1) + '" class="issue"><input style="width:60px;" disabled type="text"  name="unit_a[]" id="unit_a1_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_' + (Number(count) + 1) + '" class="issue"><input style="width:60px;" disabled type="text"  name="last_unit_price_a[]" id="last_unit_price_a1_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_' + (Number(count) + 1) + '" class="issue"><input style="width:100px;" disabled type="text"  name="last_supllier_a[]" id="last_supllier_a1_' + (Number(count) + 1) + '" class="issue"></td>';
        str += ' <td><input type="hidden"  name="stock_qty_a[]" id="stock_qty_a_' + (Number(count) + 1) + '" class="issue"><input style="width:40px;" disabled type="text"  name="stock_qty_a[]" id="stock_qty_a1_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input required style="width:40px;" type="text"  name="indent_qty_a[]" id="indent_qty_a_' + (Number(count) + 1) + '" onkeyup="calculateEstvalueAsset(' + (Number(count) + 1) + ')" class="issue"></td>';
        str += ' <td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_' + (Number(count) + 1) + '" class="issue"><input style="width:80px;" disabled type="text"  name="unit_price_a[]" id="unit_price_a1_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input style="width:100px;" class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td>';
        str += '<td><textarea style="width:200px;" name="a_remark[]"></textarea></td>';
        str += '</tr>';
        $('#a_count').val(Number(count) + 1);
        $('#myTable1').append(str);
        $('.datepicker1').datepicker({
            // format: 'DD-MM-YYYY'
            dateFormat: 'dd-mm-yy',
            //maxDate: new Date
        });
//        $('.time').datetimepicker();
//        $('.datepicker').datetimepicker({
//            format: 'DD-MM-YYYY'
//        });                                     
//        $('.monthpicker').datetimepicker({
//            format: 'YYYY-MM'
//        });
        //  $('select.e1').select2();
        $('.chzn-container').remove();
    });

    $('#serviceButton').click(function () {
        var count = $('#count').val();
        var serviceStr = $('#service').html();
        var str = '<tr class="" id="row_' + (Number(count) + 1) + '">';
        str += '<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button4" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        str += '<td><select class="e1" style="width:200px;" name="service_id[]" id="service_id_' + (Number(count) + 1) + '" class="">' + serviceStr + '</select></td>';
        str += '<td><input style="width:200px;"  type="text"  name="expected_date_s[]" class="issue datepicker1"></td>';
        str += '<td><textarea style="width:200px;" name="s_remark[]"></textarea></td>';
        str += '</tr>';

        $('#count').val(Number(count) + 1);
        $('#serviceTable').append(str);
        $('.datepicker1').datepicker({
            dateFormat: 'dd-mm-yy',
        });

        $('select.e1').select2();
        $('.chzn-container').remove();
    });


    function removeRow(row) {
        $('#row_' + row).remove();
    }

    $(document).ready(function () {
        $('.datepicker1').datepicker({
            // format: 'DD-MM-YYYY'
            dateFormat: 'dd-mm-yy',
            //maxDate: new Date
        });
        //    $('select.e1').select2();
    });

</script>

