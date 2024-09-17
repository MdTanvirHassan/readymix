<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; ">Material Receive Requisition</h2>
            <hr>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
        

            <form method="post" action="<?php echo site_url('general_store/edit_action_material_receive_requisition/'.$mrr[0]['mrr_id']) ?>">
               
                
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">MRR NO.:</label></div>
                            <div class="col-sm-8 col-md-7 "><input disabled class="form-control" id="inputdefault" name="mrr_no" value="<?php if(!empty($mrr[0]['mrr_no'])) echo $mrr[0]['mrr_no']; ?>" type="text"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">MRR Date :</label></div>
                             <div class="col-sm-8 col-md-7 "><input disabled class="form-control datepicker"  name="mrr_date" value="<?php if(!empty($mrr[0]['mrr_date'])) echo $mrr[0]['mrr_date']; ?>" type="text"></div>
                        </div>
                    </div>
                </div>
                
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Invoice/Challan :</label></div>
                            <div class="col-sm-8 col-md-7 ">
                               <!-- <input class="form-control"  name="mrr_challan" value="<?php if(!empty($mrr[0]['mrr_challan'])) echo $mrr[0]['mrr_challan']; ?>" type="text"> -->
                                 <select disabled id="invoice_challan" class="form-control" name="mrr_type" onchange="javascript:invoice_or_challan();">
                                    <option <?php if(!empty($mrr[0]['mrr_type']) && $mrr[0]['mrr_type']=="challan" ) echo "selected";  ?> value="challan">Challan</option>
                                    <option <?php if(!empty($mrr[0]['mrr_type']) && $mrr[0]['mrr_type']=="invoice" ) echo "selected";  ?> value="invoice">Invoice</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">DAte :</label></div>
                             <div class="col-sm-8 col-md-7 "><input disabled class="form-control datepicker"  name="mrr_challan_date" value="<?php if(!empty($mrr[0]['mrr_challan_date'])) echo $mrr[0]['mrr_challan_date']; ?>" type="text"></div>
                        </div>
                    </div>
                </div>
                
                 <div class="row">
                    <div class="col-md-6">
                       <?php if(!empty($mrr[0]['mrr_type']) && $mrr[0]['mrr_type']=="challan" ){ ?>
                        <div class="form-group row" id="challan">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Challan No :</label></div>
                            <div class="col-sm-8 col-md-7 "><input disabled class="form-control"  name="mrr_challan" value="<?php if(!empty($mrr[0]['mrr_challan'])) echo $mrr[0]['mrr_challan']; ?>" type="text"></div>
                        </div>
                        <div class="form-group row" style="display:none" id="invoice">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Invoice No :</label></div>
                            <div class="col-sm-8 col-md-7 "><input disabled class="form-control"  name="mrr_invoice" value="<?php if(!empty($mrr[0]['mrr_invoice'])) echo $mrr[0]['mrr_invoice']; ?>" type="text"></div>
                        </div>
                       <?php }else{ ?>
                                <div class="form-group row" style="display:none" id="challan">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Challan No :</label></div>
                            <div class="col-sm-8 col-md-7 "><input disabled class="form-control"  name="mrr_challan" value="<?php if(!empty($mrr[0]['mrr_challan'])) echo $mrr[0]['mrr_challan']; ?>" type="text"></div>
                        </div>
                        <div class="form-group row" id="invoice" >
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Invoice No :</label></div>
                            <div class="col-sm-8 col-md-7 "><input disabled class="form-control"  name="mrr_invoice" value="<?php if(!empty($mrr[0]['mrr_invoice'])) echo $mrr[0]['mrr_invoice']; ?>" type="text"></div>
                        </div>
                       <?php } ?>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Suppliers :</label></div>
                            <div class="col-sm-8 col-md-7 "> <select disabled class="form-control" name="mrr_supplier_id">
                                    <option value="">Select Supplier</option>
                                    <?php foreach($suppliers as $supplier){ ?>
                                        <option <?php if(!empty($mrr[0]['mrr_supplier_id']) && $mrr[0]['mrr_supplier_id']==$supplier['ID']) echo "selected"; ?> value="<?php echo $supplier['ID'];  ?>"><?php if(!empty($supplier['NAME'])) echo $supplier['NAME']; ?></option>
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
                               <!-- <input class="form-control" id="inputdefault" name="mrr_procurement" value="<?php if(!empty($mrr[0]['mrr_procurement'])) echo $mrr[0]['mrr_procurement']; ?>" type="text">-->
                                 <select disabled class="form-control" name="mrr_procurement" id="mrr_procurement">
                                    <option <?php if(!empty($mrr[0]['mrr_procurement']) && $mrr[0]['mrr_procurement']=="cash" ) echo "selected"; ?> value="cash">Cash</option>
                                     <option <?php if(!empty($mrr[0]['mrr_procurement']) && $mrr[0]['mrr_procurement']=="credit" ) echo "selected"; ?> value="credit">Credit</option>
                                     <option <?php if(!empty($mrr[0]['mrr_procurement']) && $mrr[0]['mrr_procurement']=="lc" ) echo "selected"; ?> value="lc">Lc</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Date :</label></div>
                             <div class="col-sm-8 col-md-7 "><input disabled class="form-control datepicker"  name="mrr_procurement_date" value="<?php if(!empty($mrr[0]['mrr_procurement_date'])) echo $mrr[0]['mrr_procurement_date']; ?>" type="text"></div>
                        </div>
                    </div>
                </div>
                
                
                 <div class="row">
                    <div class="col-md-6">
                         <?php if(!empty($mrr[0]['mrr_procurement']) && $mrr[0]['mrr_procurement']=="cash" ){ ?>
                                <div class="form-group row" id="cash">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Cash NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input disabled id="cash_no" class="form-control" id="mrr_cash" name="mrr_cash" type="text" value="<?php if(!empty($mrr[0]['mrr_cash'])) echo $mrr[0]['mrr_cash']; ?>"></div>
                                </div>
                                 <div class="form-group row" id="lc" style="display:none;">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">LC NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input disabled id="cash_no" class="form-control" id="mrr_lc" name="mrr_lc" type="text" value="" ></div>
                                </div>
                                 <div class="form-group row" id="credit" style="display:none;">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Credit NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input disabled id="cash_no" class="form-control" id="mrr_credit" name="mrr_credit" type="text" value="" ></div>
                                </div>
                         <?php }else if(!empty($mrr[0]['mrr_procurement']) && $mrr[0]['mrr_procurement']=="credit" ){ ?>
                             <div class="form-group row" id="cash" style="display:none;">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Cash NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input disabled  class="form-control" id="mrr_cash" name="mrr_cash" type="text" value=""></div>
                                </div>
                                 <div class="form-group row" id="lc" style="display:none;">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">LC NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input disabled  class="form-control" id="mrr_lc" name="mrr_lc" type="text" value="" ></div>
                                </div>
                                 <div class="form-group row" id="credit">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Credit NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input disabled class="form-control" id="mrr_credit" name="mrr_credit" type="text" value="<?php if(!empty($mrr[0]['mrr_credit'])) echo $mrr[0]['mrr_credit']; ?>" ></div>
                                </div>
                         <?php }else{ ?>
                             <div class="form-group row" id="cash" style="display:none;">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Cash NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input disabled  class="form-control" id="mrr_cash" name="mrr_cash" type="text" value=""></div>
                                </div>
                                 <div class="form-group row" id="lc" >
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">LC NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input disabled  class="form-control" id="mrr_lc" name="mrr_lc" type="text" value="<?php if(!empty($mrr[0]['mrr_lc'])) echo $mrr[0]['mrr_lc']; ?>" ></div>
                                </div>
                                 <div class="form-group row" id="credit" style="display:none;">
                                    <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Credit NO. :</label></div>
                                    <div class="col-sm-8 col-md-7 "><input disabled  class="form-control" id="mrr_credit" name="mrr_credit" type="text" value="" ></div>
                                </div>
                         <?php } ?>
                        
                    </div>
                     
                     <div class="col-md-6">
                         <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">REmarks :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" name="mrr_remark" value="<?php if(!empty($mrr[0]['mrr_remark'])) echo $mrr[0]['mrr_remark']; ?>" type="text"></div>
                    </div>
                </div>
                
                
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">QC NO. :</label></div>
                            <div class="col-sm-8 col-md-7 "><input disabled class="form-control" id="inputdefault" name="mrr_qc_no" value="<?php if(!empty($mrr[0]['mrr_qc_no'])) echo $mrr[0]['mrr_qc_no']; ?>" type="text"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">QC Date :</label></div>
                             <div class="col-sm-8 col-md-7 "><input disabled class="form-control datepicker" name="mrr_qc_date" value="<?php if(!empty($mrr[0]['mrr_qc_date'])) echo $mrr[0]['mrr_qc_date']; ?>" type="text"></div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Indent NO. :</label></div>
                            <div class="col-sm-8 col-md-7 ">
                              <!--  <input class="form-control" name="mrr_ipo_no" value="<?php if(!empty($mrr[0]['mrr_ipo_no'])) echo $mrr[0]['mrr_ipo_no']; ?>" type="text">-->
                                <select disabled class="form-control" name="mrr_ipo_no" id="mrr_ipo_no" onchange="javascript:indent_info();">
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
                             <div class="col-sm-8 col-md-7 "><input disabled class="form-control datepicker" name="mrr_ipo_date" value="<?php if(!empty($mrr[0]['mrr_ipo_date'])) echo $mrr[0]['mrr_ipo_date']; ?>" type="text" id="mrr_ipo_date"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                   <!-- 
                    <div class="col-md-6">
                         <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">REmarks :</label></div>
                            <div class="col-sm-8 col-md-7 "><input disabled class="form-control" name="mrr_remark" value="<?php if(!empty($mrr[0]['mrr_remark'])) echo $mrr[0]['mrr_remark']; ?>" type="text"></div>
                    </div>
                   -->
                </div>
                
                
            <h2 style="text-align:center; ">Item List & information</h2>
             <hr>
             <?php if(!empty($mrr_details)){ ?> 
             <input type="hidden" id="count" value="<?php echo count($mrr_details); ?>"/>
             <table class="table table-bordered" id="myTable">
                <thead>
                  <tr class="row">
                      
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
                 <?php $i=0; foreach($mrr_details as $mrr_detail){ $i++; ?>  
                    <tr class="row" id="row_<?php echo $i; ?>">
                  
                    <td> <select disabled id="item_<?php echo $i; ?>" name="item_id[]" onchange="javascript:item_info(<?php echo $i; ?>);">
                              <option value="">Select Item</option>
                              <?php foreach($items as $item){ ?>
                                  <option <?php  if(!empty($mrr_detail['item_id']) && $mrr_detail['item_id']==$item['item_id'] ) echo "selected"; ?> value="<?php echo $item['item_id'];  ?>"><?php if(!empty($item['item_code'])) echo $item['item_name']."(".  $item['item_code'].")"; ?></option>
                              <?php } ?>
                          </select></td>
                    <td><input disabled id="item_des_<?php echo $i; ?>" type="text" name="item_description[]" value="<?php if(!empty($mrr_detail['item_description'])) echo $mrr_detail['item_description']; ?>" class="issue"></td>
                    <td><input disabled id="unit_<?php echo $i; ?>" type="text" name="measurement_unit[]" value="<?php if(!empty($mrr_detail['measurement_unit'])) echo $mrr_detail['measurement_unit']; ?>" class="issue"></td>
                    <td><input disabled id="receive_qty_<?php echo $i; ?>" type="text" name="receive_qty[]" value="<?php if(!empty($mrr_detail['receive_qty'])) echo $mrr_detail['receive_qty']; ?>" onkeyup="calculateTotal(<?php echo $i; ?>)" class="issue"></td>
                    <td><input disabled id="unit_price_<?php echo $i; ?>" type="text" name="unit_price[]" value="<?php if(!empty($mrr_detail['unit_price'])) echo $mrr_detail['unit_price']; ?>" onkeyup="calculateTotal(<?php echo $i; ?>)" class="issue"></td>
                    <td><input disabled id="others_<?php echo $i; ?>" type="text" name="cf_cost[]" value="<?php if(!empty($mrr_detail['cf_cost'])) echo $mrr_detail['cf_cost']; ?>" onkeyup="calculateTotal(<?php echo $i; ?>)" class="issue"></td>
                    <td><input disabled id="total_cost_<?php echo $i; ?>" type="text" name="total_cost[]" value="<?php if(!empty($mrr_detail['total_cost'])) echo $mrr_detail['total_cost']; ?>" class="issue"></td>
                    <td><input disabled id="remark_<?php echo $i; ?>" type="text" name="remark[]" value="<?php if(!empty($mrr_detail['remark'])) echo $mrr_detail['remark']; ?>"  class="issue"></td>

                  </tr>
         <?php } ?>   
                  </tbody>
          </table>
       <?php }else{ ?>  
            <input type="hidden" id="count" value="1"/>
             <table class="table table-bordered" id="myTable">
                <thead>
                  <tr class="row">
                   
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
                      
                       <td> <select disabled id="item_1" name="item_id[]" onchange="javascript:item_info(1);">
                                <option value="">Select Item</option>
                                <?php foreach($items as $item){ ?>
                                    <option value="<?php echo $item['mrr_ipo_no'];  ?>"><?php if(!empty($item['item_code'])) echo $item['item_code']; ?></option>
                                <?php } ?>
                            </select></td>
                    <td><input disabled type="text" name="item_description[]" id="item_des_1" class="issue"></td>
                    <td><input disabled type="text" name="measurement_unit[]" id="unit_1" class="issue"></td>
                    <td><input disabled type="text" name="receive_qty[]" id="receive_qty_1" onkeyup="calculateTotal(1)" class="issue"></td>
                    <td><input disabled type="text" name="unit_price[]" id="unit_price_1" onkeyup="calculateTotal(1)" class="issue"></td>
                    <td><input disabled type="text" name="cf_cost[]" id="others_1" onkeyup="calculateTotal(1)" class="issue"></td>
                    <td><input disabled type="text" name="total_cost[]" id="total_cost_1"  class="issue"></td>
                    <td><input disabled type="text" name="remark[]" id="remark_1" class="issue"></td>

                  </tr>
                  </tbody>
          </table>
       <?php } ?>     
  <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-10">
                    <div class="col-md-2">
                     <!--   <button type="submit" class="btn btn-default button">UPDATE</button>-->
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