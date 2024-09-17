<style>
    hr{
        margin-top:9px;
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
                <?php $this->role = checkUserPermission(2, 7, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'ipo_material_indent') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/ipo_material_indent'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>MATERIAL INDENT  </span>
                    </a>
                </li>
                <?php } ?> 
                <?php $this->role = checkUserPermission(2, 8, $userData); 
                
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                
                ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'budget') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/budget'); ?>">
                        <i class="fa fa-cc"></i><br><span>BUDGET</span></a>
                </li>
                 <?php } ?>
                
                 <?php $this->role = checkUserPermission(2, 39, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ ?>
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'general_store') echo 'active'; ?>" href="<?php echo site_url('backend/general_store'); ?>">
                        <i class="fa fa-cc"></i><br><span>MONEY INDENT</span></a>
                </li>
                <?php } ?>
                
               
                <!--
                 <?php $this->role = checkUserPermission(2, 40, $userData); 
                 if(empty($this->role) || !array_key_exists(11,$this->role)){ ?>
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'purchase_quotation') echo 'active'; ?>" href="<?php echo site_url('backend/purchase_quotations'); ?>">
                        <i class="fa fa-cc"></i><br><span>PURCHASE QUOTATION</span></a>
                </li>
                <?php } ?>
                -->
                
               
                
                 <?php $this->role = checkUserPermission(2, 41, $userData); 
                 if(empty($this->role) || !array_key_exists(11,$this->role)){ ?> 
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
                <h3 style="float:left;">Budget Details</h3>
                <?php if($budget_info[0]['b_approve_status']=="Approved"){ ?>
                    <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('general_store/details_budget/' . $budget_info[0]['b_id'] . '/true/final'); ?>" class="btn btn-sm btn-warning">PRINT</a>
                <?php }else{ ?> 
                    <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('general_store/details_budget/' . $budget_info[0]['b_id'] . '/true/draft'); ?>" class="btn btn-sm btn-warning">PRINT DRAFT</a>
                <?php } ?>       
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">         






                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Budget Number</th>
                                    <th>Budget Type</th>
                                    <th>Project</th>
                                    <th>Status</th>
                                   <!-- <th>Budget Type</th>-->
                                   
                                    <th>Action</th>

                                </tr>   
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php if (!empty($budget_info[0]['b_date'])) echo date('d-m-Y', strtotime($budget_info[0]['b_date'])); ?></td>
                                    <td><?php if (!empty($budget_info[0]['b_no'])) echo $budget_info[0]['b_no']; ?></td>
                                    <td><?php if (!empty($budget_info[0]['b_type'])) echo $budget_info[0]['b_type']; ?></td>
                                    <td><?php if (!empty($budget_info[0]['dep_description'])) echo $budget_info[0]['dep_description']; ?></td>
                                    <td><?php if (!empty($budget_info[0]['b_approve_status'])) echo $budget_info[0]['b_approve_status']; ?></td>
                                   
                                    

                                    <td>
                                        
                                        
                                        
                                       <?php if($user_type==1){ ?>
                                              <?php if($budget_info[0]['b_approve_status']=="Approved"){ ?>                             
                                                    <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                              <?php }else if($budget_info[0]['b_approve_status']=="Rejected"){ ?>
                                                    <button onclick="approve('<?php echo site_url('general_store/approve_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                               <?php }else{ ?>
                                                    <button onclick="approve('<?php echo site_url('general_store/approve_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                                    <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                               <?php } ?>

                                                <?php }else{ ?>
                                                     <?php if ($employee_id == $approvers_info[0]) { ?>
                                                            <?php  if(!empty($approvers_info[1])){ ?>
                                                                    <?php if($budget_info[0]['b_approve_status']=="Pending"){ ?>
                                                                            <button onclick="approve('<?php echo site_url('general_store/forward_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-success">Forward</button>&nbsp;&nbsp;
                                                                             <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-warning">Reject</button>
                                                                    <?php } ?>

                                                             <?php }else{ ?>
                                                                       <?php if($budget_info[0]['b_approve_status']=="Pending"){ ?>
                                                                             <button onclick="approve('<?php echo site_url('general_store/approve_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-primary">Approve</button>&nbsp;&nbsp;
                                                                              <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-warning">Reject</button>
                                                                       <?php } ?>
                                                             <?php } ?>           
                                                    <?php } ?>

                                                   <?php if ($employee_id == $approvers_info[1]) { ?>
                                                            <?php  if(!empty($approvers_info[2])){ ?>
                                                                    <?php if($budget_info[0]['b_approve_status']=="Forward-By-First-Approver"){ ?>
                                                                            <button onclick="approve('<?php echo site_url('general_store/forward_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-success">Forward</button>&nbsp;&nbsp;
                                                                            <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-warning">Reject</button>
                                                                    <?php } ?>

                                                             <?php }else{ ?>
                                                                       <?php if($budget_info[0]['b_approve_status']=="Forward-By-First-Approver"){ ?>
                                                                             <button onclick="approve('<?php echo site_url('general_store/approve_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-primary">Approve</button>&nbsp;&nbsp;
                                                                             <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-warning">Reject</button>
                                                                       <?php } ?>
                                                             <?php } ?>           
                                                    <?php } ?>


                                                    <?php if ($employee_id == $approvers_info[2]) { ?>
                                                            <?php  if(!empty($approvers_info[3])){ ?>
                                                                    <?php if($budget_info[0]['b_approve_status']=="Forward-By-Second-Approver"){ ?>  
                                                                             <button onclick="approve('<?php echo site_url('general_store/forward_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-success">Forward</button>&nbsp;&nbsp;
                                                                             <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-warning">Reject</button>
                                                                    <?php } ?>

                                                             <?php }else{ ?>
                                                                       <?php if($budget_info[0]['b_approve_status']=="Forward-By-Second-Approver"){ ?>
                                                                             <button onclick="approve('<?php echo site_url('general_store/approve_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-primary">Approve</button>&nbsp;&nbsp;
                                                                             <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-warning">Reject</button>
                                                                       <?php } ?>
                                                             <?php } ?>           
                                                    <?php } ?>


                                                   <?php if ($employee_id == $approvers_info[3]) { ?>

                                                                 <?php if($budget_info[0]['b_approve_status']=="Forward-By-Third-Approver"){ ?>       
                                                                        <button onclick="approve('<?php echo site_url('general_store/approve_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-primary">Approve</button>&nbsp;&nbsp;
                                                                        <button onclick="reject('<?php echo site_url('general_store/reject_budget/'.$budget_info[0]['b_id']); ?>')" class="btn btn-warning">Reject</button>
                                                                 <?php } ?>      

                                                    <?php } ?>                        



                                            <?php } ?>  
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <a href="<?php echo site_url('general_store/add_budget'); ?>" class="btn btn-sm btn-primary">ADD BUDGET</a> 
                                        <?php if ($budget['b_b_approve_status'] == "pending") { ?>
                                            <a href="<?php echo site_url('general_store/edit_budget/' . $budget_info[0]['b_id']); ?>" class="btn btn-sm btn-info">EDIT BUDGET</a>
                                        <?php } else { ?>
                                            <button class="btn btn-sm btn-info">EDIT BUDGET</button>
                                        <?php } ?>    
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <form method="post" action="<?php echo site_url('general_store/edit_action_budget/' . $budget_info[0]['b_id']) ?>">

                            

                            <input type="hidden" id="count" value="1"/>
                            <table class="table table-bordered" id="myTable" style="margin-top:20px;">
                                <thead class="thead-color">
                                    <tr class="row">
                                        <th>Indent Date</th>
                                        <th>Material Indent No.</th>
                                        <th>Project</th>
                                        <th>Item name & Description</th>
                                        <th>Unit</th>
                                        <th>Indent Qty</th>
                                        <th>Size</th>
                                        <th>Size Unit</th>
                                        <th>Budget Qty</th>
                                        <th>Unit Price</th>
                                        <th>Budget Value</th>
                                        <th>Payment Mode</th>
                <!--                        <th>Select</th>-->





                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;
                                    foreach ($budgeted_items as $budgeted_item) {
                                        $i++; ?>

                                        <tr class="row" id="row_1">
                                            <td><?php if (!empty($budgeted_item['indent_date'])) echo date('d-m-Y',strtotime($budgeted_item['indent_date'])); ?></td>
                                            <td><?php if (!empty($budgeted_item['indent_no'])) echo $budgeted_item['indent_no']; ?></td>
                                            <td><?php if (!empty($budgeted_item['department_name'])) echo $budgeted_item['department_name']; ?></td>
                                            <td><?php if (!empty($budgeted_item['item_description'])) echo $budgeted_item['item_description']; ?></td>
                                            <td><?php if (!empty($budgeted_item['measurement_unit'])) echo $budgeted_item['measurement_unit']; ?></td>                
                                            <td><?php if (!empty($budgeted_item['indent_qty'])) echo $budgeted_item['indent_qty']; ?></td>
                                            <td><?php if (!empty($budgeted_item['item_size'])) echo $budgeted_item['item_size']; ?></td>
                                            <td><?php if (!empty($budgeted_item['unit_name'])) echo $budgeted_item['unit_name']; ?></td>
                                            <td><?php if (!empty($budgeted_item['budget_qty'])) echo $budgeted_item['budget_qty']; ?></td>
                                            <td><?php if (!empty($budgeted_item['unit_price'])) echo $budgeted_item['unit_price']; ?></td>
                                            <td><?php if (!empty($budgeted_item['budget_value'])) echo number_format($budgeted_item['budget_value']); ?></td>
                                            <td><?php if (!empty($budgeted_item['mode_name'])) echo $budgeted_item['mode_name']; ?></td>
                    <!--                        <td  style="text-align: center;"><?php echo $i - 1; ?></td>-->


                                        </tr>
<?php } ?>  





                                </tbody>
                            </table>



                            <div class="row" style="margin-bottom: 20px">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/general_store/budget') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                                </div>
                                <div class="col-md-2">

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
        var unit_price = Number($('#unit_price_' + id).val());
        var budget_quantity = Number($('#budget_qty_' + id).val());
        var est_value = unit_price * budget_quantity;
        $('#budget_value_' + id).val(est_value);
        $('#budget_value_c1_' + id).val(est_value);



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
                    $('#item_des_c_' + id).val(msg.item_info[0].item_name);
                    $('#item_des_c1_' + id).val(msg.item_info[0].item_name);
                    $('#unit_c_' + id).val(msg.item_info[0].meas_unit);
                    $('#unit_c1_' + id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_c_' + id).val(msg.item_info[0].stock_amount);
                    $('#stock_qty_c1_' + id).val(msg.item_info[0].stock_amount);

                    if (msg.item_previous_info != '') {
                        $('#last_unit_price_c_' + id).val(msg.item_previous_info[0].unit_price);
                        $('#last_unit_price_c1_' + id).val(msg.item_previous_info[0].unit_price);
                        var supplier = msg.item_previous_info[0].NAME + "(" + msg.item_previous_info[0].CODE + ")";
                    } else {
                        $('#last_unit_price_c_' + id).val('');
                        $('#last_unit_price_c1_' + id).val('');
                        var supplier = '';
                    }

                    $('#last_supllier_c_' + id).val(supplier);
                    $('#last_supllier_c1_' + id).val(supplier);
                } else {
                    $('#item_des_a_' + id).val(msg.item_info[0].item_name);
                    $('#item_des_a1_' + id).val(msg.item_info[0].item_name);
                    $('#unit_a_' + id).val(msg.item_info[0].meas_unit);
                    $('#unit_a1_' + id).val(msg.item_info[0].meas_unit);
                    $('#stock_qty_a_' + id).val(msg.item_info[0].stock_amount);
                    $('#stock_qty_a1_' + id).val(msg.item_info[0].stock_amount);

                    if (msg.item_previous_info != '') {
                        $('#last_unit_price_a_' + id).val(msg.item_previous_info[0].unit_price);
                        $('#last_unit_price_a1_' + id).val(msg.item_previous_info[0].unit_price);
                        var supplier = msg.item_previous_info[0].NAME + "(" + msg.item_previous_info[0].CODE + ")";
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




    $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr = $('#item_c_1').html();
        var assetstr = $('#asset_c_1').html();

        var str = '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str += '<td><button id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        str += '<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_c_' + (Number(count) + 1) + '" class="form-control">' + itemstr + '</select></td><td><input type="hidden"  name="item_name_description[]" id="item_des_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description[]" id="item_des_c1_' + (Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit[]" id="unit_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit[]" id="unit_c1_' + (Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price[]" id="last_unit_price_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price[]" id="last_unit_price_c1_' + (Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supplier[]" id="last_supllier_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supplier[]" id="last_supllier_c1_' + (Number(count) + 1) + '" class="issue"></td>  <td><input type="hidden"  name="stock_qty[]" id="stock_qty_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty[]" id="stock_qty_c1_' + (Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty[]" id="indent_qty_c_' + (Number(count) + 1) + '" onkeyup="calculateEstvalueConsume(' + (Number(count) + 1) + ')" class="issue"></td><td><input type="hidden"  name="unit_price[]" id="unit_price_c_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price[]" id="unit_price_c1_' + (Number(count) + 1) + '" class="issue"></td><td><select  name="asset_id[]" id="asset_c_' + (Number(count) + 1) + '" class="form-control">' + assetstr + '</select></td><td><input class="datepicker" type="text"  name="expected_date[]" class="issue"></td></tr>';
        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
        $('.datepicker').datepicker({
            format: 'DD-MM-YYYY'
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

    $('#button3').click(function () {
        var count = $('#count').val();
        var itemstr = $('#item_a_1').html();
        var assetstr = $('#asset_1').html();

        var str = '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str += '<td><button id="button4" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        str += '<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id_a[]" id="item_a_' + (Number(count) + 1) + '" class="form-control">' + itemstr + '</select></td><td><input type="hidden"  name="item_name_description_a[]" id="item_des_a_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="item_name_description_a[]" id="item_des_a1_' + (Number(count) + 1) + '" class="issue"></td><td><input type="hidden"  name="unit_a[]" id="unit_a_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_a[]" id="unit_a1_' + (Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_unit_price_a[]" id="last_unit_price_a_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_unit_price_a[]" id="last_unit_price_a1_' + (Number(count) + 1) + '" class="issue"></td> <td><input type="hidden"  name="last_supllier_a[]" id="last_supllier_a_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="last_supllier_a[]" id="last_supllier_a1_' + (Number(count) + 1) + '" class="issue"></td>   <td><input type="hidden"  name="stock_qty_a[]" id="stock_qty_a_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="stock_qty_a[]" id="stock_qty_a1_' + (Number(count) + 1) + '" class="issue"></td>  <td><input type="text"  name="indent_qty_a[]" id="indent_qty_a_' + (Number(count) + 1) + '" onkeyup="calculateEstvalueAsset(' + (Number(count) + 1) + ')" class="issue"></td><td><input type="hidden"  name="unit_price_a[]" id="unit_price_a_' + (Number(count) + 1) + '" class="issue"><input disabled type="text"  name="unit_price_a[]" id="unit_price_a1_' + (Number(count) + 1) + '" class="issue"></td><td><input class="datepicker" type="text"  name="expected_date_a[]" class="issue"></td></tr>';
        $('#count').val(Number(count) + 1);
        $('#myTable1').append(str);
        $('.datepicker').datepicker({
            format: 'DD-MM-YYYY'
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

    function removeRow(row) {
        $('#row_' + row).remove();
    }

    $(document).ready(function () {

        //    $('select.e1').select2();
    });

</script>

