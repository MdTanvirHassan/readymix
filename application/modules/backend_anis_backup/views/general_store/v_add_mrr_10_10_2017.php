<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; ">Material Receive Requisition</h2>
            <hr>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
            <form method="post" action="<?php echo site_url('general_store/add_action_material_receive_requisition') ?>">
               
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">MRR NO.:</label></div>
                            <div class="col-sm-8 col-md-7 ">
                                <input class="form-control" id="" name="mrr_code" type="hidden" value="<?php if(!empty($mrr_code)) echo $mrr_code; ?>">
                                <input class="form-control" id="" name="mrr_no" type="hidden" value="<?php if(!empty($mrr_auto_code)) echo "MRR".$mrr_auto_code; ?>">
                                <input disabled class="form-control" id="" name="mrr_no1" type="text" value="<?php if(!empty($mrr_auto_code)) echo "MRR".$mrr_auto_code; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">MRR Date :</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control datepicker"  name="mrr_date" type="text" value="<?php echo date('d-m-Y'); ?>"></div>
                        </div>
                    </div>
                </div>
                
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Invoice/Challan :</label></div>
                            <div class="col-sm-8 col-md-7 ">
                                <select id="invoice_challan" class="form-control" name="mrr_type" onchange="javascript:invoice_or_challan();">
                                    <option value="challan">Challan</option>
                                    <option value="invoice">Invoice</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">DAte :</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control datepicker"  name="mrr_challan_date" type="text"></div>
                        </div>
                    </div>
                </div>
                
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row" id="challan">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Challan No :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="mrr_challan" type="text"></div>
                        </div>
                        
                          <div class="form-group row" id="invoice" style="display:none">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Invoice No :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="mrr_invoice" type="text"></div>
                        </div>
                    </div>
                   <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Suppliers :</label></div>
                            <div class="col-sm-8 col-md-7 "> <select class="form-control" name="mrr_supplier_id">
                                    <option value="">Select Supplier</option>
                                    <?php foreach($suppliers as $supplier){ ?>
                                        <option value="<?php echo $supplier['ID'];  ?>"><?php if(!empty($supplier['NAME'])) echo $supplier['NAME']; ?></option>
                                    <?php } ?>
                                </select></div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Procurement :</label></div>
                            <div class="col-sm-8 col-md-7 ">
                            <!--    <input class="form-control" id="inputdefault" name="mrr_procurement" type="text">-->
                                <select class="form-control" name="mrr_procurement" id="mrr_procurement">
                                    <option value="cash">Cash</option>
                                     <option value="credit">Credit</option>
                                     <option value="lc">Lc</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Date :</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control datepicker"  name="mrr_procurement_date" type="text"></div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">QC NO. :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control"  name="mrr_qc_no" type="text"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">QC Date :</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control datepicker" name="mrr_qc_date" type="text"></div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Indent NO. :</label></div>
                            <div class="col-sm-8 col-md-7 ">
                             <!--   <input class="form-control" name="mrr_ipo_no" type="text"> -->
                                <select class="form-control" name="mrr_ipo_no" id="mrr_ipo_no" onchange="javascript:indent_info();">
                                    <option value="">Select Indent</option>
                                    <?php foreach($indents as $indent){ ?>
                                        <option value="<?php echo $indent['ipo_m_id'];  ?>"><?php if(!empty($indent['ipo_number'])) echo $indent['ipo_number']; ?></option>
                                    <?php } ?>
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Indent Date:</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control datepicker" name="mrr_ipo_date" id="mrr_ipo_date" type="text"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-6">
                         <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">REmarks :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" name="mrr_remark" type="text"></div>
                    </div>
                </div>
                
                
                
            <h2 style="text-align:center; ">Item List & information</h2>
             <hr>
              <input type="hidden" id="count" value="1"/>
             <table class="table table-bordered" id="myTable">
    <thead>
      <tr class="row">
          <th><button style="margin-left:5px" type="button" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   </th>
        <th>Item Code</th>
        <th>Item Description</th>
        <th>M.unit</th>
        <th>Receive Qty</th>
        <th>Unit Price</th>
        <th>Others Cost</th>
        <th>Total Cost </th>
        <th>Remark</th>
      </tr>
    </thead>
    <tbody>
       <tr class="row" id="row_1">
          <td></td>
           <td> <select id="item_1" name="item_id[]" onchange="javascript:item_info(1);">
                    <option value="">Select Item</option>
                 <!--   <?php foreach($items as $item){ ?>
                        <option value="<?php echo $item['id'];  ?>"><?php if(!empty($item['item_code'])) echo $item['item_code']; ?></option>
                    <?php } ?>-->
                </select></td>
        <td><input type="text" name="item_description[]" id="item_des_1" class="issue"></td>
        <td><input type="text" name="measurement_unit[]" id="unit_1" class="issue"></td>
        <td><input type="text" name="receive_qty[]" id="receive_qty_1" onkeyup="calculateTotal(1)" class="issue"></td>
        <td><input type="text" name="unit_price[]" id="unit_price_1" onkeyup="calculateTotal(1)" class="issue"></td>
        <td><input type="text" name="cf_cost[]" id="others_1" onkeyup="calculateTotal(1)" class="issue"></td>
        <td><input type="text" name="total_cost[]" id="total_cost_1"  class="issue"></td>
        <td><input type="text" name="remark[]" id="remark_1" class="issue"></td>
        
      </tr>
      </tbody>
  </table>
  <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-10">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-default button">SAVE</button>
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
                       <!-- <button type="button" class="btn btn-success button">EXIT</button>-->
                    </div>
            </div>
                </div>
                   
                    
                    
                </div>
            
            
            
            </form>
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
    
    
    
     function indent_info_pre(){
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
        str +='<td><select onchange="item_info(' + (Number(count) + 1) + ')" name="item_id[]" id="item_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td> <td><input type="text" name="item_description[]" id="item_des_'+(Number(count) + 1) + '" class="issue"></td><td><input type="text" name="measurement_unit[]" id="unit_'+(Number(count) + 1) + '" class="issue"></td> <td><input type="text" name="receive_qty[]" id="receive_qty_'+(Number(count) + 1) + '" onkeyup="calculateTotal(' + (Number(count) + 1) + ')" class="issue"></td> <td><input type="text" name="unit_price[]" id="unit_price_'+(Number(count) + 1) + '" onkeyup="calculateTotal(' + (Number(count) + 1) + ')" class="issue"></td> <td><input type="text" name="cf_cost[]" id="others_'+(Number(count) + 1) + '" onkeyup="calculateTotal(' + (Number(count) + 1) + ')" class="issue"></td><td><input type="text" name="total_cost[]" id="total_cost_'+(Number(count) + 1) + '"  class="issue"></td> <td><input type="text" name="remark[]" class="issue"></td></tr>';
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