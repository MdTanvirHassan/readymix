<style type="text/css">
    td{
        padding:3px !important;
    }
    input{
        margin:0px !important;
    }
    td > label {
    color: blue;
    font-weight: 600;
    text-align: center;
}
tr{
    text-align:center;
}
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Product Costing Per Unit</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" action="<?php echo site_url('products_cost/edit_product_cost_action/'.$product_quote_price[0]['product_cost_id']); ?>" method="post" onsubmit="javascript: return validation()">


                            <div class="row">
                                <div class="col-md-6">
                                    <div class='form-group row' >
                                        <label for="title" class="col-sm-4 col-md-4 control-label">
                                            Costing Number <span class="required">*</span> :
                                        </label>
                                        <div class="col-sm-8 col-md-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                            <input readonly  class="form-control" id="cost_number" name="cost_number" type="text" value="<?php echo $product_quote_price[0]['cost_number']; ?>"> 
                                        </div>
                                    </div> 
                                </div> 

                                <div class="col-md-6">
                                    <div class='form-group row' >
                                        <label for="title" class="col-sm-4 col-md-4 control-label">
                                            Customer <span class="required">*</span> :
                                        </label>
                                        <div class="col-sm-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <select   class="e1 form-control"  id="customer_id" name="customer_id" >
                                                <option value="">Select Customer</option>
                                                <?php foreach ($customers as $customer) { ?>
                                                    <option <?php if ($product_quote_price[0]['customer_id'] == $customer['id']) echo 'selected'; ?> value="<?php echo $customer['id']; ?>"><?php if (!empty($customer['c_name'])) echo $customer['c_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span id="customer_id_error" style="color:red;"></span>
                                        </div>
                                    </div> 
                                </div>  
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class='form-group row' >
                                        <label for="title" class="col-sm-4 col-md-4 control-label">
                                            Project <span class="required">*</span> :
                                        </label>
                                        <div class="col-sm-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                            <select   class="e1 form-control"  id="project_id" name="project_id" >
                                                <option value="">Select Customer</option>
                                                <?php foreach ($projects as $project) { ?>
                                                    <option <?php if ($project['project_id'] == $product_quote_price[0]['project_id']) echo 'selected'; ?> value="<?php echo $project['project_id']; ?>"><?php echo $project['project_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span id="customer_id_error" style="color:red;"></span>
                                        </div>
                                    </div> 
                                   </div> 

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-4 control-label">
                                            Product <span class="required">*</span> :
                                        </label>
                                        
                                        <div class="col-sm-8 col-md-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                            <select  style="" class="e1 form-control" style="width:100px;" id="product" name="product_id" >
                                                <option value="">Select Product</option>
                                                <?php foreach ($products as $product) { ?>
                                                    <option rel="<?php echo $product['measurement_unit']; ?>" <?php if ($product_quote_price[0]['product_id'] == $product['product_id']) echo 'selected'; ?> value="<?php echo $product['product_id']; ?>"><?php if (!empty($product['product_name'])) echo $product['product_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            
                                            
                                        </div>
                                        
                                    </div>
                                </div>

                            </div>
                            
                            

                              <div class="row">
                                <div class="col-md-6">
                                    <div class='form-group row' >
                                        <label for="title" class="col-sm-4 col-md-4 control-label">
                                            Costing Size(In Cum) <span class="required">*</span> :
                                        </label>
                                        <div class="col-sm-8 col-md-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                            <input   class="form-control" onkeyup="javascript:calculateCft()" onchange="javascript:calculateCft()"  id="casting_size_cum" name="casting_size_cum" type="text" value="<?php echo $product_quote_price[0]['casting_size_cum']; ?>">
                                        </div>
                                        <!--
                                         <div class="col-sm-2 col-md-2 input-group">
                                             <b><span style="margin-left:0px" id="m_unit" ><?php echo $product_quote_price[0]['measurement_unit']; ?></span></b>
                                        </div>
                                        -->
                                      
                                            
                                    </div> 
                                </div> 
                                  
                               <div class="col-md-6">
                                    <div class='form-group row' >
                                        
                                       <label for="title" class="col-sm-4 col-md-4 control-label">
                                           Costing Size(In <span id="p_mu"><?php echo $product_quote_price[0]['measurement_unit']; ?></span>) <span class="required">*</span> :
                                        </label>
                                        <div class="col-sm-8 col-md-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                            <input   class="form-control" onkeyup="javascript:calculateCum()" onchange="javascript:calculateCum()"  id="casting_size_cft" name="casting_size_cft" type="text" value="<?php echo $product_quote_price[0]['casting_size_cft']; ?>">
                                        </div>   
                                            
                                    </div> 
                                </div>    
                              
                            </div>


                            <input type="hidden" id="count" value="1"/>
                            <table class="table table-bordered" id="myTable">
                                <thead class="thead-color">
                                    <tr>

                                        <th>Material <sup style='color:red'>*</sup></th>
                                        <th>Brand</th>
                                        <?php if($product_quote_price[0]['measurement_unit']=='MT'){ ?>
                                        <th class="mu_cls">% of Materials</th>
                                        <?php }else{ ?>
                                            <th class="mu_cls" style='display: none'>% of Materials</th>
                                        <?php } ?>
                                        <th>Req. Qnty</th> 
                                        <th>MU</th>
                                        <th>C. Factor</th>   
                                        <th>C. Qnty</th>
                                        <th>MU</th>
                                        <th>Rate</th>
                                        <th>Value</th>

                                    </tr>
                                </thead>
                                <tbody id="material_body">
                                    <?php
                                    $i = 0;
                                    $total = 0;
                                    $total_qnty = 0;
                                 //   $total_other_expense = $product_other_cost[0]['transport_cost'] + $product_other_cost[0]['overhead_expense'] + $product_other_cost[0]['sales_commission'] + $product_other_cost[0]['foh'] + $product_other_cost[0]['aoh'] + $product_other_cost[0]['soh'] + $product_other_cost[0]['final_expense'];
                                    $total_other_expense = $product_other_cost[0]['transport_cost'] +$product_other_cost[0]['pumping_cost'] +$product_other_cost[0]['overhead_expense'] + $product_other_cost[0]['sales_commission'] + $product_other_cost[0]['final_expense'];
                                    $total_vat_ait = $product_other_cost[0]['vat'] + $product_other_cost[0]['ait'];

                                    foreach ($material_costs as $material_cost) {
                                        $total = $total + $material_cost['value'];
                                        $total_qnty = $total_qnty + $material_cost['quantity'];
                                        $i++;
                                        ?>
                                        <tr>
                                            <td><input type="hidden"  style="width:140px;"  name="m_id[]" id="m_id_<?php echo $i; ?>" class="issue" value="<?php echo $material_cost['m_id']; ?>"><input  style="width:140px;"  type="text"  name="item[]" id="item_<?php echo $i; ?>" class="issue" value="<?php echo $material_cost['item_name']; ?>"></td>
                                            <td><input  style="width:80px;"  type="text"  name="brand[]" id="brand_<?php echo $i; ?>" class="issue" value="<?php echo $material_cost['brand']; ?>"></td>
                                            <?php 
                                            if($product_quote_price[0]['measurement_unit']=='MT'){
                                                ?>
                                            <td><input class="number mu_cls" onkeyup="calculatePercent(<?php echo $i; ?>,0)" style="width:80px;text-align:right;"  type="text"  name="percent[]" id="percent_<?php echo $i; ?>"  value="<?php echo round($material_cost['quantity']/100),2 ?>"></td>
                                            <?php }else{ ?>
                                            <td><input class="number mu_cls" onkeyup="calculatePercent(<?php echo $i; ?>,0)" style="width:80px;text-align:right;display:none"  type="text"  name="percent[]" id="percent_<?php echo $i; ?>"  value="<?php echo round($material_cost['quantity']/100),2 ?>"></td>
                                            <?php } ?>
                                            <td><input required onkeyup="calculateConvertQnty(<?php echo $i; ?>)" onchange="calculateConvertQnty(<?php echo $i; ?>)"   style="width:80px;text-align:right;"  type="text"  name="quantity[]" id="quantity_<?php echo $i; ?>" class="issue number" value="<?php echo $material_cost['quantity']; ?>"></td>
                                            <td><input  style="width:80px;"  type="text"  name="mu[]" id="mu_<?php echo $i; ?>" class="issue" value="<?php echo $material_cost['mu']; ?>"></td>
                                            <td><input required onkeyup="calculateConvertQnty(<?php echo $i; ?>)" onchange="calculateConvertQnty(<?php echo $i; ?>)"   style="width:80px;text-align:right;"  type="text"  name="conversion_factor[]" id="conversion_factor_<?php echo $i; ?>" class="issue number" value="<?php echo $material_cost['conversion_factor']; ?>"></td>
                                            <td><input required onkeyup="calculateRequireQnty(<?php echo $i; ?>)" onchange="calculateRequireQnty(<?php echo $i; ?>)"   style="width:80px;text-align:right;"  type="text"  name="c_quantity[]" id="c_quantity_<?php echo $i; ?>" class="issue number" value="<?php echo $material_cost['c_quantity']; ?>"></td>
                                            <td><input  style="width:80px;"  type="text"  name="c_mu[]" id="c_mu_<?php echo $i; ?>" class="issue" value="<?php echo $material_cost['c_mu']; ?>"></td>
                                            <td><input required onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)"   style="width:80px;text-align:right;"  type="text"  name="rate[]" id="rate_<?php echo $i; ?>" class="issue number" value="<?php echo $material_cost['rate']; ?>"></td>
                                            <td><input readonly style="width:80px;text-align:right;"  type="text"  name="value[]" id="value_<?php echo $i; ?>" class="issue" value="<?php echo $material_cost['value']; ?>"></td>
                                        </tr>
                                        <?php
                                    }
                                    $total_with_other_expense_vat = $total + $total_other_expense + $total_vat_ait;
                                    ?>

                                </tbody>
                                
                                <tfoot id="foot">
                                    <tr>
                                        <?php if($product_quote_price[0]['measurement_unit']=='MT'){ ?>
                                        <td colspan="3" style="text-align: right;"><b>Total</b></td>
                                        <?php }else{ ?>
                                        <td colspan="2" style="text-align: right;"><b>Total</b></td>
                                        <?php } ?>
                                        <td style="text-align: right;">
                                            <input readonly style="width:140px;margin:0px;text-align:right;" type="hidden" id="total_quantity" name="total_material_quantity" value="<?php echo $total_qnty; ?>" />
                                            <b> <span style="width:140px;margin-right:3px;"  id="total_material_quantity"><?php echo $total_qnty; ?></span></b>
                                        </td>
                                        <td  style="text-align: right;"></td>
                                        <td  style="text-align: right;"></td>
                                        <td  style="text-align: right;"></td>
                                        <td  style="text-align: right;"></td>
                                        <td  style="text-align: right;"></td>

                                        <td style="text-align: right;">
                                            <input readonly style="width:80px;margin:0px;text-align:right;" type="hidden" id="total" name="total_material_cost" value="<?php echo $total; ?>" />
                                            <b> <span style="width:80px;margin-right:3px;"  id="total_material_cost_amount"><?php echo $total; ?></span></b>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td><label>Transport Cost</label><br><input class="number" onkeyup="javascript:calculateOtherExpense();" onchange="javascript:calculateOtherExpense();" onblur="javascript:calculateOtherExpense();" style="width:80px;text-align:right;" type="text" id="transport_cost" name="transport_cost" value="<?php if (!empty($product_other_cost[0]['transport_cost'])) echo $product_other_cost[0]['transport_cost']; ?>" /></td>
                                    
                                        <td><label>Pump. Cost</label><br><input class="number" onkeyup="javascript:calculateOtherExpense();" onchange="javascript:calculateOtherExpense();" onblur="javascript:calculateOtherExpense();" style="width:80px;text-align:right;" type="text" id="pumping_cost" name="pumping_cost" value="<?php if (!empty($product_other_cost[0]['pumping_cost'])) echo $product_other_cost[0]['pumping_cost']; ?>" /></td>
                                    
                                        <td><label>Over h. Exp</label><br><input class="number" onkeyup="javascript:calculateOtherExpense();" onchange="javascript:calculateOtherExpense();" onblur="javascript:calculateOtherExpense();" style="width:80px;text-align:right;" type="text" id="overhead_expense" name="overhead_expense" value="<?php if (!empty($product_other_cost[0]['overhead_expense'])) echo $product_other_cost[0]['overhead_expense']; ?>" /></td>
                                    
                                        <td><label>Sales Comm.</label><br><input class="number" onkeyup="javascript:calculateOtherExpense();" onchange="javascript:calculateOtherExpense();" onblur="javascript:calculateOtherExpense();" style="width:80px;text-align:right;" type="text" id="sales_commission" name="sales_commission" value="<?php if (!empty($product_other_cost[0]['sales_commission'])) echo $product_other_cost[0]['sales_commission']; ?>" /></td>
                                    <td><label>Admin. Exp</label><br><input class="number" onkeyup="javascript:calculateOtherExpense();" onchange="javascript:calculateOtherExpense();" onblur="javascript:calculateOtherExpense();" style="width:80px;text-align:right;" type="text" id="admin_exp" name="admin_exp" value="<?php if (!empty($product_other_cost[0]['admin_exp'])) echo $product_other_cost[0]['admin_exp']; ?>" /></td>
                                    <td><label>Dep. Exp</label><br><input class="number" onkeyup="javascript:calculateOtherExpense();" onchange="javascript:calculateOtherExpense();" onblur="javascript:calculateOtherExpense();" style="width:80px;text-align:right;" type="text" id="dep_exp" name="dep_exp" value="<?php if (!empty($product_other_cost[0]['dep_exp'])) echo $product_other_cost[0]['dep_exp']; ?>" /></td>
                                    <td><label>Fin. Exp</label><br><input class="number" onkeyup="javascript:calculateOtherExpense();" onchange="javascript:calculateOtherExpense();" onblur="javascript:calculateOtherExpense();" style="width:80px;text-align:right;" type="text" id="final_expense" name="final_expense" value="<?php if (!empty($product_other_cost[0]['final_expense'])) echo $product_other_cost[0]['final_expense']; ?>" /></td>
                                    <td><label>Sub. Total</label><br><input readonly style="width:80px;text-align:right;" type="text" id="total_other_expense" value="<?php echo $total_other_expense; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    <td><label>VAT</label><br><input class="number" onkeyup="javascript:calculateVatAit();" onchange="javascript:calculateVatAit();" onblur="javascript:calculateVatAit();" style="width:80px;text-align:right;" type="text" id="vat" name="vat" value="<?php if (!empty($product_other_cost[0]['vat'])) echo $product_other_cost[0]['vat']; ?>" /></td>
                                    <td><label>AIT</label><br><input class="number" onkeyup="javascript:calculateVatAit();" onchange="javascript:calculateVatAit();" onblur="javascript:calculateVatAit();" style="width:80px;text-align:right;" type="text" id="ait" name="ait" value="<?php if (!empty($product_other_cost[0]['ait'])) echo $product_other_cost[0]['ait']; ?>" /></td>
                                    <td><label>VAT+AIT</label><br><input style="width:80px;text-align:right;" type="text" id="total_vat_ait" name="t_vat_ait" value="<?php echo $total_vat_ait; ?>" /></td>
                                    <td><label>Net Total</label><br><input readonly style="width:80px;text-align:right;" type="text" id="total_with_other_expense_vat" value="<?php echo $total_with_other_expense_vat; ?>" /></td>
                                    <td><label>Profit</label><br><input class="number" onkeyup="javascript:calculateProfit();" onchange="javascript:calculateProfit();" onblur="javascript:calculateProfit();" style="width:80px;text-align:right;" type="text" id="profit_percentage" name="profit_percentage" value="<?php if (!empty($product_other_cost[0]['profit_percentage'])) echo $product_other_cost[0]['profit_percentage']; ?>" /></td>
                                    <td><label>%</label><br><input class="number" onkeyup="javascript:calculateProfitPercentage();" onchange="javascript:calculateProfitPercentage();" onblur="javascript:calculateProfitPercentage();" style="width:80px;text-align:right;" type="text" id="total_profit" name="profit_amount" value="<?php if (!empty($product_other_cost[0]['profit_amount'])) echo $product_other_cost[0]['profit_amount']; ?>" /></td>
                                   
                                    <td style="text-align: right;"><label><b>U.Price(Cum)</b></label><br><input readonly style="width:80px;text-align:right;font-weight:bold;" type="text" id="quote_price" name="quote_price" value="<?php if (!empty($product_quote_price[0]['quote_price'])) echo $product_quote_price[0]['quote_price']; ?>" /></td>
                                    <?php if($product_quote_price[0]['measurement_unit']=='MT'){ ?>
                                    <td><label><b id='m_unit2'>U. Price(<?php echo $product_quote_price[0]['measurement_unit']; ?>)</b></label><br><input readonly style="width:80px;text-align:right;font-weight:bold;" type="text" id="price_in_cft" name="price_in_cft" value="<?php if (!empty($product_quote_price[0]['quote_price'])) echo round($product_quote_price[0]['quote_price']/2.41,2); ?>" /></td>
                                    <?php }else if($product_quote_price[0]['measurement_unit']=='CFT'){?>
                                    <td><label><b id='m_unit2'>U. Price(<?php echo $product_quote_price[0]['measurement_unit']; ?>)</b></label><br><input readonly style="width:80px;text-align:right;font-weight:bold;" type="text" id="price_in_cft" name="price_in_cft" value="<?php if (!empty($product_quote_price[0]['quote_price'])) echo round($product_quote_price[0]['quote_price']/35.31,2); ?>" /></td>
                                    <?php }else{ ?>
                                    <td><label><b id='m_unit2'>U. Price(<?php echo $product_quote_price[0]['measurement_unit']; ?>)</b></label><br><input readonly style="width:80px;text-align:right;font-weight:bold;" type="text" id="price_in_cft" name="price_in_cft" value="<?php if (!empty($product_quote_price[0]['quote_price'])) echo round($product_quote_price[0]['quote_price'],2); ?>" /></td>
                                    <?php } ?>
                                    </tr>
                                </tfoot>
                                
                                
                            </table>
                            <div class="row">

                                <div class="row">

                                    <div class="col-md-1">
                                        <a href="<?php echo site_url('backend/products_cost') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>

                                    </div>     
                                    <div class="col-md-2 ">
                                        <button type="submit" class="btn btn-primary button">UPDATE</button>
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
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

 function calculateCft() {
        var pd = $('#product').find('option:selected').attr('rel');
        if (!pd)
            pd = 'CFT';
        var cum = Number($('#casting_size_cum').val());
        $('#actual_casting_size_cum').val(cum);
        //  alert(cum);
        if(pd=='CFT')
        var cft = cum * 35.31;
    else
        var cft = cum * 2.41;
        var n_cft = cft.toFixed(2);
        //    alert(cft);
        $('#actual_casting_size_cft').val(cft);
        $('#casting_size_cft').val(n_cft);
    }


    function calculateCum() {
        var pd = $('#product').find('option:selected').attr('rel');
        if (!pd)
            pd = 'CFT';
        var cft = Number($('#casting_size_cft').val());
        $('#actual_casting_size_cft').val(cft);
        if(pd=='CFT')
        var cum = cft / 35.31;
    else
        var cum = cft / 2.41;
        var n_cum = cum.toFixed(2);
        $('#actual_casting_size_cum').val(cum);
        $('#casting_size_cum').val(n_cum);
    }
function calculatePercent(id,flag){
    var total = 0;
    if(flag == 1){
        $('#percent_'+id).val((0.10*Number($('#quantity_'+id).val())).toFixed(2))
    }else{
      $('#quantity_'+id).val((10*Number($('#percent_'+id).val())).toFixed(2))
    }
            $("input[id*='quantity_']").each(function(r,v){
            if($(this).attr('id').split('_').length==2){
                var id = $(this).attr('id').split('_')[1];
                var val = $(this).val();
                if(!isNaN(val))
                total =total+Number(val);
                
            }
        })
        
    
    $('#total_quantity').val(total);
    $('#total_material_quantity').html(total);
    
}
    function calculateConvertQnty(id) {
        calculatePercent(id,1);
        var item_m_unit = $('#mu_' + id).val();
        var r_qty = $('#quantity_' + id).val();
        
        var c_factor = $('#conversion_factor_' + id).val();
        var c_qty = $('#c_quantity_' + id).val();

        if (c_factor != '' && r_qty != '') {
            var c_qty = Number(r_qty) / Number(c_factor);
            var n_c_qty = c_qty.toFixed(2);
            $('#c_quantity_' + id).val(n_c_qty);
            if (Number(c_factor) > 1) {
                $('#c_mu_' + id).val('Cft');
            } else {
                $('#c_mu_' + id).val(item_m_unit);
            }
        } else {
            $('#c_quantity_' + id).val('');
        }


        var price = $('#rate_id').val();
        if (price != '') {

            var total_quantity = 0;
            var sub_total = 0;
            var unit_price = $('#rate_' + id).val();
            var quantity = $('#c_quantity_' + id).val();
            if (unit_price != '' && quantity != '') {
                var amount = Number(unit_price) * Number(quantity);
                amount = amount.toFixed(2);
            } else {
                var amount = 0;
            }

            $('#value_' + id).val(amount);
            var rowCount = $('#myTable tr').length;
            //  var table_row=Number(rowCount)-14;
            var table_row = Number(rowCount) - 13;
$("input[id*='value_']").each(function(i,r){
          var amt = $('#value_' + (i+1)).val();
            if (!isNaN(amt)) {
                sub_total = sub_total + Number(amt);
            }
            var quantity = $('#c_quantity_' + (i+1)).val();
            total_quantity = total_quantity + Number(quantity);
})
//            for (var i = 1; i <= table_row; i++) {
//                var amt = $('#value_' + i).val();
//                if (!isNaN(amt)) {
//                    sub_total = sub_total + Number(amt);
//                }
//                var quantity = $('#c_quantity_' + i).val();
//                total_quantity = total_quantity + Number(quantity);
//
//            }
            sub_total = sub_total.toFixed(2);
          //  alert(sub_total)
            //  $('#total_material_quantity').html(total_quantity);  
            $('#total').val(sub_total);
            $('#total_material_cost_amount').html(sub_total);
            var total_vat_ait = $('#total_vat_ait').val();
            var total_other_expense = $('#total_other_expense').val();
            var total_with_other_expense_vat = Number(sub_total) + Number(total_vat_ait) + Number(total_other_expense);
            total_with_other_expense_vat = total_with_other_expense_vat.toFixed(2);
            $('#total_with_other_expense_vat').val(total_with_other_expense_vat);
            var percentage = Number($('#profit_percentage').val());
            if (percentage != '') {
                var total_profit = (total_with_other_expense_vat * percentage / 100);
                total_profit = total_profit.toFixed(2);

            } else {
                var total_profit = '';
            }
            $('#total_profit').val(total_profit);
            if (total_profit != '') {
                var quote_price = Number(total_with_other_expense_vat) + Number(total_profit);
            } else {
                var quote_price = Number(total_with_other_expense_vat);
            }
            var net_quote_price = quote_price.toFixed(2);
            $('#quote_price').val(net_quote_price);
var mu = $('#product').find('option:selected').attr('rel');
if(mu=='CFT')
        var price_in_cft = net_quote_price / 35.31;
    else if(mu=='MT')
    var price_in_cft = net_quote_price / 2.41;
    else
        var price_in_cft = net_quote_price / 35.31;
            var price_in_cft = net_quote_price / 35.31;
            var price_in_cft = price_in_cft.toFixed(2);

            $('#price_in_cft').val(price_in_cft);


        }


    }

    function calculateRequireQnty(id) {
        //  var item=$('#material_'+id).val();
        var item_m_unit = $('#mu_' + id).val();
        var r_qty = $('#quantity_' + id).val();
        var c_factor = $('#conversion_factor_' + id).val();
        var c_qty = $('#c_quantity_' + id).val();

        if (c_factor != '' && c_qty != '') {
            var r_qty = Number(c_qty) * Number(c_factor);
            var n_r_qty = r_qty.toFixed(2);
            // alert(n_r_qty);
            $('#quantity_' + id).val(n_r_qty);
            if (Number(c_factor) > 1) {
                $('#c_mu_' + id).val('Cft');
            } else {
                $('#c_mu_' + id).val(item_m_unit);
            }
        } else {
            $('#quantity_' + id).val('');
        }

        var price = $('#rate_id').val();
        if (price != '') {

            var total_quantity = 0;
            var sub_total = 0;
            var unit_price = $('#rate_' + id).val();
            var quantity = $('#c_quantity_' + id).val();
            if (unit_price != '' && quantity != '') {
                var amount = Number(unit_price) * Number(quantity);
                amount = amount.toFixed(2);
            } else {
                var amount = 0;
            }

            $('#value_' + id).val(amount);
            var rowCount = $('#myTable tr').length;
            //  var table_row=Number(rowCount)-14;
            var table_row = Number(rowCount) - 13;
$("input[id*='value_']").each(function(i,r){
          var amt = $('#value_' + (i+1)).val();
            if (!isNaN(amt)) {
                sub_total = sub_total + Number(amt);
            }
            var quantity = $('#c_quantity_' + (i+1)).val();
            total_quantity = total_quantity + Number(quantity);
})
//            for (var i = 1; i <= table_row; i++) {
//                var amt = $('#value_' + i).val();
//                if (!isNaN(amt)) {
//                    sub_total = sub_total + Number(amt);
//                }
//                var quantity = $('#c_quantity_' + i).val();
//                total_quantity = total_quantity + Number(quantity);
//
//            }
            sub_total = sub_total.toFixed(2);
         //   alert(sub_total)
            //  $('#total_material_quantity').html(total_quantity);  
            $('#total').val(sub_total);
            $('#total_material_cost_amount').html(sub_total);
            var total_vat_ait = $('#total_vat_ait').val();
            var total_other_expense = $('#total_other_expense').val();
            var total_with_other_expense_vat = Number(sub_total) + Number(total_vat_ait) + Number(total_other_expense);
            total_with_other_expense_vat = total_with_other_expense_vat.toFixed(2);
            $('#total_with_other_expense_vat').val(total_with_other_expense_vat);
            var percentage = Number($('#profit_percentage').val());
            if (percentage != '') {
                var total_profit = (total_with_other_expense_vat * percentage / 100);
                total_profit = total_profit.toFixed(2);

            } else {
                var total_profit = '';
            }
            $('#total_profit').val(total_profit);
            if (total_profit != '') {
                var quote_price = Number(total_with_other_expense_vat) + Number(total_profit);
            } else {
                var quote_price = Number(total_with_other_expense_vat);
            }
            var net_quote_price = quote_price.toFixed(2);
            $('#quote_price').val(net_quote_price);
var mu = $('#product').find('option:selected').attr('rel');
if(mu=='CFT')
        var price_in_cft = net_quote_price / 35.31;
    else if(mu=='MT')
    var price_in_cft = net_quote_price / 2.41;
    else
        var price_in_cft = net_quote_price / 35.31;
            
            var price_in_cft = price_in_cft.toFixed(2);

            $('#price_in_cft').val(price_in_cft);


        }


    }


    function validation() {
       
        var product = $('#product').val();
        var customer_id = $('#customer_id').val();
        var project_name = $('#project_name').val();

        var error = false;

        if (product == '') {
            $('#product').css('border', '1px solid red');
            $('#product_error').html('Please select product');
            error = true;

        } else {
            $('#product').css('border', '1px solid #ccc');
            $('#product_error').html('');

        }
        if (customer_id == '') {
            $('#customer_id_error').html('Please select customer');
            $('#customer_id').css('border', '1px solid red');
            error = true;
        } else {
            $('#customer_id_error').html('');
            $('#customer_id').css('border', '1px solid #ccc');

        }

        if (project_name == '') {
            $('#project_name_error').html('Please fill project name field');
            $('#project_name').css('border', '1px solid red');
            error = true;
        } else {
            $('#project_name_error').html('');
            $('#project_name').css('border', '1px solid #ccc');

        }


        if (error == true) {
            return false;
        }
    }









    $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr = $('#item_c_1').html();

        var str = '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str += '<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        str += '<td><select required class="e1" style="width:200px;"  name="m_id[]" id="item_c_' + (Number(count) + 1) + '" class="">' + itemstr + '</select></td>';
        str += '<td><input  style="width:140px;"  type="text"  name="mu[]" id="mu_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input required style="width:140px;"  type="text"  name="quantity[]" id="quantity_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input required style="width:140px;"  type="text"  name="rate[]" id="rate_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input  style="width:140px;"  type="text"  name="value[]" id="value_' + (Number(count) + 1) + '" class="issue"></td>';

        str += '</tr>';

        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
        $('select.e1').select2();
        $('.chzn-container').remove();
    });

    function removeRow(row) {
        $('#row_' + row).remove();
    }

     $('#product').change(function () {
        //alert('test');
        $('#total_material_cost_amount').html('');
        $('#total').val('');
        $('#foh').val('');
        $('#aoh').val('');
        $('#soh').val('');
        $('#final_expense').val('');
        $('#total_other_expense').val('');
        $('#vat').val('');
        $('#ait').val('');
        $('#total_vat_ait').val('');
        $('#total_with_other_expense_vat').val('');
        $('#profit_percentage').val('')
        $('#total_profit').val('');
        $('#quote_price').val('');
        $('#price_in_cft').val('');

        var product_id = $('#product').val();
        var data = {'product_id': product_id}
        if (product_id != '') {
            $.ajax({
                url: '<?php echo site_url('products_cost/get_item_material'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {

                    $('#p_mu').html(msg.product_info[0].measurement_unit);
                    $('#m_unit').html('Per ' + msg.product_info[0].measurement_unit);
                    $('#m_unit2').html('U. Price('+msg.product_info[0].measurement_unit+')');
                    $('#casting_size_cum').val(1).change()
                    if(msg.product_info[0].measurement_unit=='CFT'){
                    calculateCft();
                    $('.mu_cls').hide();
                    }else{
                        $('.mu_cls').show();
                    calculateCum();
                    }
                    var str = '';
                    if (msg.item_list != '') {

                        var total = 0;

                        $(msg.item_list).each(function (i, v) {
                            total = total + Number(v.quantity);
                            str += '<tr  id="row_' + (Number(i) + 1) + '">';
                            str += '<td><input type="hidden"  style="width:140px;"  name="m_id[]" id="m_id_' + (Number(i) + 1) + '" class="issue" value="' + v.m_id + '"><input  style="width:200px;"  type="text"  name="item[]" id="item_' + (Number(i) + 1) + '" class="issue" value="' + v.item_name + '"></td>';
                            str += '<td><input  style="width:100px;"  type="text"  name="brand[]" id="brand_' + (Number(i) + 1) + '" class="issue" value=""></td>';
                            if(msg.product_info[0].measurement_unit=='MT')
                            str += '<td><input class="number mu_cls" onkeyup="calculatePercent(' + (Number(i) + 1) + ',0)" style="width:80px;text-align:right;"  type="text"  name="percent[]" id="percent_' + (Number(i) + 1) + '"  value=""></td>';
                            str += '<td><input required class="number" onkeyup="calculateConvertQnty(' + (Number(i) + 1) + ')" style="width:80px;text-align:right;"  type="text"  name="quantity[]" id="quantity_' + (Number(i) + 1) + '"  value="' + v.quantity + '"></td>';
                            str += '<td><input  style="width:80px;"  type="text"  name="mu[]" id="mu_' + (Number(i) + 1) + '" class="issue" value="' + v.meas_unit + '"></td>';
                            str += '<td><input required class="number" onkeyup="calculateConvertQnty(' + (Number(i) + 1) + ')" style="width:80px;text-align:right;"  type="text"  name="conversion_factor[]" id="conversion_factor_' + (Number(i) + 1) + '"  value="' + v.conversion_factor + '"></td>';
                            str += '<td><input required class="number" onkeyup="calculateRequireQnty(' + (Number(i) + 1) + ')" style="width:80px;text-align:right;"  type="text"  name="c_quantity[]" id="c_quantity_' + (Number(i) + 1) + '"  value="' + v.c_quantity + '"></td>';
                            str += '<td><input  style="width:80px;"  type="text"  name="c_mu[]" id="c_mu_' + (Number(i) + 1) + '" class="issue" value="' + v.c_mu + '"></td>';
                            str += '<td><input required class="number" onkeyup="calculateSubtotal(' + (Number(i) + 1) + ')" style="width:80px;text-align:right"  type="text"  name="rate[]" id="rate_' + (Number(i) + 1) + '" ></td>';
                            str += '<td><input readonly style="width:140px;text-align:right;"  type="text"  name="value[]" id="value_' + (Number(i) + 1) + '" class="issue"></td>';
                            str += '</tr>';



                        });
                        if(msg.product_info[0].measurement_unit=='CFT')
                        $('td[colspan=3]').attr('colspan','2')
                    else
                        $('td[colspan=2]').attr('colspan','3')
                        $('#total_quantity').val(total);
                        $('#total_material_quantity').html(total);
                        $('#foot').show();



                    } else {
                        $('#foot').hide();
                    }
                    $('#material_body').html(str);

                }


            })
        } else {
            $('#material_body').html('');
            $('#foot').hide();
            $('#m_unit').html('');
        }
    });
    
   function calculateSubtotal(id) {

        $('.number').live('input', function (event) {
            var val = $(this).val();

            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);
        });
        //alert('test');
        var total_quantity = 0;
        var sub_total = 0;
        var unit_price = $('#rate_' + id).val();
        var quantity = $('#c_quantity_' + id).val();
        if (unit_price != '' && quantity != '') {
            var amount = Number(unit_price) * Number(quantity);
            amount = amount.toFixed(2);
        } else {
            var amount = 0;
        }

        $('#value_' + id).val(amount);
        var rowCount = $('#myTable tr').length;
        //  var table_row=Number(rowCount)-14;
        
        var table_row = Number(rowCount) - 13;
$("input[id*='value_']").each(function(i,r){
          var amt = $('#value_' + (i+1)).val();
            if (!isNaN(amt)) {
                sub_total = sub_total + Number(amt);
            }
            var quantity = $('#c_quantity_' + (i+1)).val();
            total_quantity = total_quantity + Number(quantity);
})
        //for (var i = 1; i <= table_row; i++) {
      

      //  }
        sub_total = sub_total.toFixed(2);
      //  alert(sub_total)
        //  $('#total_material_quantity').html(total_quantity);  
        $('#total').val(sub_total);
        $('#total_material_cost_amount').html(sub_total);
        var total_vat_ait = $('#total_vat_ait').val();
        var total_other_expense = $('#total_other_expense').val();
        var total_with_other_expense_vat = Number(sub_total) + Number(total_vat_ait) + Number(total_other_expense);
        total_with_other_expense_vat = total_with_other_expense_vat.toFixed(2);
        $('#total_with_other_expense_vat').val(total_with_other_expense_vat);
        var percentage = Number($('#profit_percentage').val());
        if (percentage != '') {
            var total_profit = (total_with_other_expense_vat * percentage / 100);
            total_profit = total_profit.toFixed(2);

        } else {
            var total_profit = '';
        }
        $('#total_profit').val(total_profit);
        if (total_profit != '') {
            var quote_price = Number(total_with_other_expense_vat) + Number(total_profit);
        } else {
            var quote_price = Number(total_with_other_expense_vat);
        }
        var net_quote_price = quote_price.toFixed(2);
        $('#quote_price').val(net_quote_price);

        var mu = $('#product').find('option:selected').attr('rel');

if(mu=='CFT')
        var price_in_cft = net_quote_price / 35.31;
    else if(mu=='MT')
    var price_in_cft = net_quote_price / 2.41;
    else
        var price_in_cft = net_quote_price / 35.31;
    
        var price_in_cft = price_in_cft.toFixed(2);
        $('#price_in_cft').val(price_in_cft);
    }


    function calculateOtherExpense() {
        var transport_cost = $('#transport_cost').val();
        var pumping_cost = $('#pumping_cost').val();
        var overhead_expense = $('#overhead_expense').val();
        var sales_commission = $('#sales_commission').val();
        var admin_exp = $('#admin_exp').val();
        var dep_exp = $('#dep_exp').val();
//       var foh=$('#foh').val();
//       var aoh=$('#aoh').val();
//       var soh=$('#soh').val();
        var final_expense = $('#final_expense').val();
        //     var total_other_expense=Number(transport_cost)+Number(overhead_expense)+Number(sales_commission)+Number(foh)+Number(aoh)+Number(soh)+Number(final_expense);
        var total_other_expense = Number(transport_cost) + Number(overhead_expense) + Number(sales_commission) + Number(admin_exp) + Number(dep_exp) + Number(final_expense) + Number(pumping_cost);
//       var total_other_expense=Number(foh)+Number(aoh)+Number(soh)+Number(final_expense);
        $('#total_other_expense').val(total_other_expense.toFixed(2));

        var total = $('#total').val();
        var total_vat_ait = $('#total_vat_ait').val();
        var total_with_other_expense_vat = Number(total) + Number(total_vat_ait) + total_other_expense;
        total_with_other_expense_vat = total_with_other_expense_vat.toFixed(2);
        $('#total_with_other_expense_vat').val(total_with_other_expense_vat);

        var percentage = Number($('#profit_percentage').val());
        if (percentage != '') {
            var total_profit = (total_with_other_expense_vat * percentage / 100);
            total_profit = total_profit.toFixed(2);
        } else {
            var total_profit = '';
        }
        $('#total_profit').val(total_profit);
        if (total_profit != '') {
            var quote_price = Number(total_with_other_expense_vat) + Number(total_profit);
        } else {
            var quote_price = Number(total_with_other_expense_vat);
        }
        var net_quote_price = quote_price.toFixed(2);
        $('#quote_price').val(net_quote_price);

        var mu = $('#product').find('option:selected').attr('rel');

if(mu=='CFT')
        var price_in_cft = net_quote_price / 35.31;
    else if(mu=='MT')
    var price_in_cft = net_quote_price / 2.41;
    else
        var price_in_cft = net_quote_price / 35.31;
    
    
        var price_in_cft = price_in_cft.toFixed(2);
        $('#price_in_cft').val(price_in_cft);
    }

    function calculateVatAit() {
        var vat = $('#vat').val();
        var ait = $('#ait').val();

        var total = $('#total').val();
        var total_other_expense = $('#total_other_expense').val();
        var total_vat_ait = Number(vat) + Number(ait);
        $('#total_vat_ait').val(total_vat_ait);
        var total_with_other_expense_vat = Number(total) + Number(total_vat_ait) + Number(total_other_expense);
        $('#total_with_other_expense_vat').val(total_with_other_expense_vat);

        var percentage = Number($('#profit_percentage').val());
        if (percentage != '') {
            var total_profit = (total_with_other_expense_vat * percentage / 100);
            total_profit = total_profit.toFixed(2);
        } else {
            var total_profit = '';
        }
        $('#total_profit').val(total_profit);
        if (total_profit != '') {
            var quote_price = Number(total_with_other_expense_vat) + Number(total_profit);
        } else {
            var quote_price = Number(total_with_other_expense_vat);
        }
        var net_quote_price = quote_price.toFixed(2);
        $('#quote_price').val(net_quote_price);
var mu = $('#product').find('option:selected').attr('rel');
if(mu=='CFT')
        var price_in_cft = net_quote_price / 35.31;
    else if(mu=='MT')
    var price_in_cft = net_quote_price / 2.41;
    else
        var price_in_cft = net_quote_price / 35.31;
    
        var price_in_cft = price_in_cft.toFixed(2);
        $('#price_in_cft').val(price_in_cft);
    }

    function calculateProfit() {
        var percentage = Number($('#profit_percentage').val());
        var total_with_other_expense_vat = Number($('#total_with_other_expense_vat').val());
        var total_profit = (total_with_other_expense_vat * percentage / 100);
        total_profit = total_profit.toFixed(2);
        $('#total_profit').val(total_profit);
        var quote_price = Number(total_with_other_expense_vat) + Number(total_profit);
        var net_quote_price = quote_price.toFixed(2);
        $('#quote_price').val(net_quote_price);
var mu = $('#product').find('option:selected').attr('rel');

if(mu=='CFT')
        var price_in_cft = net_quote_price / 35.31;
    else if(mu=='MT')
    var price_in_cft = net_quote_price / 2.41;
    else
        var price_in_cft = net_quote_price / 35.31;
        
        var price_in_cft = price_in_cft.toFixed(2);
        $('#price_in_cft').val(price_in_cft);

    }


    function calculateProfitPercentage() {
        //alert('test');
        var profit_amount = $('#total_profit').val();
//     // var percentage=Number($('#profit_percentage').val());
        var total_with_other_expense_vat = Number($('#total_with_other_expense_vat').val());
        // var total_profit=(total_with_other_expense_vat*percentage/100);
        var profit_percentage = (profit_amount * 100) / total_with_other_expense_vat;
        var profit_percentage = profit_percentage.toFixed(2);

        $('#profit_percentage').val(profit_percentage);
        var quote_price = Number(total_with_other_expense_vat) + Number(profit_amount);
        var net_quote_price = quote_price.toFixed(2);
        $('#quote_price').val(net_quote_price);
var mu = $('#product').find('option:selected').attr('rel');

if(mu=='CFT')
        var price_in_cft = net_quote_price / 35.31;
    else if(mu=='MT')
    var price_in_cft = net_quote_price / 2.41;
    else
        var price_in_cft = net_quote_price / 35.31;
        
        var price_in_cft = price_in_cft.toFixed(2);
        $('#price_in_cft').val(price_in_cft);

    }


</script>
