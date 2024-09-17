<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
        <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3 style="float:left;">Material Receive Requisition Details</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('general_store/details_material_receive_requisition/'.$mrr[0]['mrr_id'].'/true'); ?>" class="btn btn-sm btn-warning">PRINT</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">     
    
    <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>MRR Number</th>
                                    <th>Invoice/Challan</th>
                                    <th>MRR Date</th>
                                    <th>Date</th>
                                    <th>Challan No</th>
                                    <th>Suppliers </th>
                                    <th>Procurement</th>
                                    <th>Remarks</th>
                                    <th>Action</th>

                                </tr>   
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php if(!empty($mrr[0]['mrr_no'])) echo $mrr[0]['mrr_no']; ?></td>
                                    <td><?php if(!empty($mrr[0]['mrr_type'])) echo $mrr[0]['mrr_type'];  ?></td>
                                    <td><?php if(!empty($mrr[0]['mrr_date'])) echo date('d-m-Y',strtotime($mrr[0]['mrr_date'])); ?></td>
                                    <td><?php if(!empty($mrr[0]['mrr_challan_date'])) echo date('d-m-Y',strtotime($mrr[0]['mrr_challan_date'])); ?></td>
                                    <td><?php if(!empty($mrr[0]['mrr_type']) && $mrr[0]['mrr_type']=="challan" ){   echo $mrr[0]['mrr_challan']; }else{ echo $mrr[0]['mrr_invoice']; }?></td>
                                    <td>
                                        <?php foreach($suppliers as $supplier){ ?>
                                        <?php if(!empty($mrr[0]['mrr_supplier_id']) && $mrr[0]['mrr_supplier_id']==$supplier['ID']){echo $supplier['SUP_NAME'];} ?></option>
                                    <?php } ?>
                                    </td>
                                    <td> <?php echo $mrr[0]['mrr_procurement'];?></td>
                                    <td><?php if(!empty($mrr[0]['mrr_remark'])) echo $mrr[0]['mrr_remark']; ?></td>

                                    <td>
                                        <a href="<?php echo site_url('general_store/add_material_receive_requisition'); ?>" class="btn btn-sm btn-primary">ADD MRR</a>
            <?php if($mrr[0]['mrr_status']=="applied" ){ ?>
                <a href="<?php echo site_url('general_store/edit_material_receive_requisition/'.$mrr[0]['mrr_id']); ?>" class="btn btn-sm btn-info">EDIT MRR</a>
            <?php }else{ ?>
                <button class="btn btn-sm btn-info">Edit</button>
            <?php } ?>    
        <?php if($mrr[0]['mrr_status']=="applied"){ ?>
            <a href="<?php echo site_url('general_store/receive_material_receive_requisition/'.$mrr[0]['mrr_id']); ?>"><button class="btn btn-sm btn-success">Receive</button></a>
        <?php }else{ ?>
           <!--  <a href="<?php echo site_url('general_store/reject_material_receive_requisition/'.$mrr[0]['mrr_id']); ?>"><button class="btn btn-sm btn-warning">Reject</button></a> -->
        <?php } ?>   
                                    </td>
                                </tr>
                            </tbody>
                        </table>
   
            
         
          
           

       <div id="remover">
       
       </div>      
             
           
               
               
               
                
                 
                
                 
                
                
                
                 <div class="row">
                     
                     <!--
                    <div class="col-md-6">
                         <?php if(!empty($mrr[0]['mrr_procurement']) && $mrr[0]['mrr_procurement']=="cash" ){ ?>
                                <div class="form-group row" id="cash">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Cash NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input id="cash_no" class="form-control" id="mrr_cash" name="mrr_cash" type="text" value="<?php if(!empty($mrr[0]['mrr_cash'])) echo $mrr[0]['mrr_cash']; ?>"></div>
                                </div>
                                 <div class="form-group row" id="lc" style="display:none;">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">LC NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input id="cash_no" class="form-control" id="mrr_lc" name="mrr_lc" type="text" value="" ></div>
                                </div>
                                 <div class="form-group row" id="credit" style="display:none;">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Credit NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input id="cash_no" class="form-control" id="mrr_credit" name="mrr_credit" type="text" value="" ></div>
                                </div>
                         <?php }else if(!empty($mrr[0]['mrr_procurement']) && $mrr[0]['mrr_procurement']=="credit" ){ ?>
                             <div class="form-group row" id="cash" style="display:none;">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Cash NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input  class="form-control" id="mrr_cash" name="mrr_cash" type="text" value=""></div>
                                </div>
                                 <div class="form-group row" id="lc" style="display:none;">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">LC NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input  class="form-control" id="mrr_lc" name="mrr_lc" type="text" value="" ></div>
                                </div>
                                 <div class="form-group row" id="credit">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Credit NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input  class="form-control" id="mrr_credit" name="mrr_credit" type="text" value="<?php if(!empty($mrr[0]['mrr_credit'])) echo $mrr[0]['mrr_credit']; ?>" ></div>
                                </div>
                         <?php }else{ ?>
                             <div class="form-group row" id="cash" style="display:none;">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Cash NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input  class="form-control" id="mrr_cash" name="mrr_cash" type="text" value=""></div>
                                </div>
                                 <div class="form-group row" id="lc" >
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">LC NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input  class="form-control" id="mrr_lc" name="mrr_lc" type="text" value="<?php if(!empty($mrr[0]['mrr_lc'])) echo $mrr[0]['mrr_lc']; ?>" ></div>
                                </div>
                                 <div class="form-group row" id="credit" style="display:none;">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Credit NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input  class="form-control" id="mrr_credit" name="mrr_credit" type="text" value="" ></div>
                                </div>
                         <?php } ?>
                        
                    </div>
                     
                     -->
                     
                    
                </div>
                
                 <div class="row">
                     <!--
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">QC NO. :</label></div>
                            <div class="col-sm-8 col-md-7 "><input disabled class="form-control" id="inputdefault" name="mrr_qc_no" value="<?php if(!empty($mrr[0]['mrr_qc_no'])) echo $mrr[0]['mrr_qc_no']; ?>" type="text"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">QC Date :</label></div>
                             <div class="col-sm-8 col-md-7 "><input disabled class="form-control datepicker" name="mrr_qc_date" value="<?php if(!empty($mrr[0]['mrr_qc_date'])) echo date('d-m-Y',strtotime($mrr[0]['mrr_qc_date'])); ?>" type="text"></div>
                        </div>
                    </div>
                     -->
                </div>
               
               
                 <div class="row">
                     
                     <!--
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Indent NO. :</label></div>
                            <div class="col-sm-8 col-md-7 ">
                            
                                <select class="form-control" name="mrr_ipo_no" id="mrr_ipo_no" onchange="javascript:indent_info();">
                                    <option value="">Select Indent</option>
                                    <?php foreach($indents as $indent){ ?>
                                        <option <?php if(!empty($mrr[0]['mrr_ipo_no']) && $mrr[0]['mrr_ipo_no']==$indent['ipo_m_id'] ) echo "selected"; ?> value="<?php echo $indent['ipo_m_id'];  ?>"><?php if(!empty($indent['ipo_number'])) echo $indent['ipo_number']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Indent Date:</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control datepicker" name="mrr_ipo_date" value="<?php if(!empty($mrr[0]['mrr_ipo_date'])) echo date('d-m-Y',strtotime($mrr[0]['mrr_ipo_date'])); ?>" type="text" id="mrr_ipo_date"></div>
                        </div>
                    </div>
                    
                    -->
                    
                </div>
                <div class="row">
                    <!--
                    <div class="col-md-6">
                         <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">REmarks :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" name="mrr_remark" value="<?php if(!empty($mrr[0]['mrr_remark'])) echo $mrr[0]['mrr_remark']; ?>" type="text"></div>
                    </div>
                    -->
                </div>
                
                
            <h2 style="text-align:center; ">Item List & information</h2>
             <hr>
          
            
            
              <table class="table table-bordered" id="myTable">
    <thead>
      <tr class="row">
        <th>Budget No</th>
        <th>Indent No</th>
        <th>Item Code</th>
        <th>Item Description</th>
        <th>M.unit</th>

        <th>Budget Qty</th>
     
        <th>Receive Qnt</th>
        <th>Unit Price</th>
        <th>Others Cost</th>
        <th>Total Cost </th>
        <th>Remark</th>
<!--        <th>Select</th>-->
      </tr>
    </thead>
    <tbody>
    <?php $i=0; foreach($budgeted_items as $budget_item){ $i++;?>
       <tr class="row" id="row_1">
        
        <td><?php if(!empty($budget_item['b_no'])) echo $budget_item['b_no'];  ?></td>
        <td><?php if(!empty($budget_item['indent_no'])) echo $budget_item['indent_no'];  ?></td>
        <td><?php if(!empty($budget_item['item_code'])) echo $budget_item['item_code'];  ?></td>
        <td><?php if(!empty($budget_item['item_description'])) echo $budget_item['item_description'];  ?></td>
        <td><?php if(!empty($budget_item['measurement_unit'])) echo $budget_item['measurement_unit'];  ?></td>
        <td><?php if(!empty($budget_item['budget_qty'])) echo $budget_item['budget_qty'];  ?></td>
        <td><?php if(!empty($budget_item['receive_qty'])) echo $budget_item['receive_qty'];  ?></td>
        <td><?php if(!empty($budget_item['unit_price'])) echo $budget_item['unit_price'];  ?></td>
        <td><?php if(!empty($budget_item['cf_cost'])) echo $budget_item['cf_cost'];  ?></td>
        <td><?php if(!empty($budget_item['total_cost'])) echo $budget_item['total_cost'];  ?></td>
        <td><?php if(!empty($budget_item['remark'])) echo $budget_item['remark'];  ?></td>
<!--         <td style="text-align: center;"><input disabled checked type="checkbox" name="item_select[]" value="<?php echo $i-1; ?>" ></td>-->
        
      </tr>
  <?php } ?>   
      </tbody>
  </table>
      
            
          
  <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-10">
                   
                     <div class="col-md-2">
                        <a href="<?php echo site_url('backend/general_store/material_receive_requisition') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
                    <!--
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success button">FIND</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary button">VIEW</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn  btn-danger button">DELETE</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-info button">CLEAR</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-warning button">SAVE</button>
                    </div>
                -->
                    
                </div>
                <div class="col-md-2">
                    
                    <div class="row">
                <div class="col-md-12">
                    <!--    <button type="button" class="btn btn-success button">EXIT</button> -->
                    </div>
            </div>
                </div>
                   
                    
                    
                </div>
            
            
            
            
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

<script>
   
   function calculateTotal(id){
    //    alert('test');
        var net_price;
        var r_quantity = $('#receive_qty_'+id).val();
       
        var unit_price = $('#unit_price_'+id).val();
      
        var others = $('#others_'+id).val();
       
        if(r_quantity!='' && unit_price!='' && others!='' ){
            net_price=(Number(r_quantity)*Number(unit_price))+Number(others);
        }else  if(r_quantity!='' && unit_price!=''){
            net_price=Number(r_quantity)*Number(unit_price);
        }else if(others!=''){
            net_price=Number(others);
        }else{
            net_price='';
        }
       $('#total_cost_'+id).val(net_price);
    }
    
    
      function item_info(id) { 
        var itemId = $('#item_'+id).val();
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
                   
                $('#item_des_'+id).val(msg[0].item_name);
                $('#unit_'+id).val(msg[0].meas_unit);
          //      $('#stock_qty_'+id).val(msg[0].stock_amount);
            }
        })

    }
    
    function invoice_or_challan(){
       
        var in_or_challan=$('#invoice_challan').val();
        if(in_or_challan=="invoice"){
            $('#invoice').show();
            $('#challan').hide();
        }else{
            $('#invoice').hide();
            $('#challan').show();
        }
        
    }
    
    
    function indent_info(){
        //  alert('test');
       var mrr_indent_no= $('#mrr_ipo_no').val();
       var data = {'mrr_indent_no': mrr_indent_no}
        $.ajax({
            url: '<?php echo site_url('general_store/indent_info_details'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
            //    alert('test');
                $('#mrr_ipo_date').val(msg.indent[0].date);
                
                 var str = '<option value="0">Select Item</option>';
                 $(msg.indent_details).each(function (i, v) {
                  //   alert('test');
                     str += '<option value="' + v.item_id + '">'+ v.item_name+"("+ v.item_code+")"+ '</option>';
                    // alert(v.user_id);
                 });
                 $('#item_1').html(str);
                // $('.selectpicker').selectpicker('refresh');
             }
                
               
            
        })
    } 
   
   

    $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr=$('#item_1').html();

        
        
        var str= '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str +='<td><button id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
         str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td> <td><input type="text" name="item_description[]" id="item_des_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text" name="measurement_unit[]" id="unit_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text" name="receive_qty[]" id="receive_qty_'+(Number(count) + 1) + '" onkeyup="calculateTotal(' + (Number(count) + 1) + ')" class="issue"></td> <td><input type="text" name="unit_price[]" id="unit_price_'+(Number(count) + 1) + '" onkeyup="calculateTotal(' + (Number(count) + 1) + ')" class="issue"></td> <td><input type="text" name="cf_cost[]" id="others_'+(Number(count) + 1) + '" onkeyup="calculateTotal(' + (Number(count) + 1) + ')" class="issue"></td><td><input type="text" name="total_cost[]" id="total_cost_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text" name="remark[]" class="issue"></td></tr>';
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

    function removeRow(row) {
        $('#row_' + row).remove();
    }

    $(document).ready(function () {

    //    $('select.e1').select2();
    });

</script>