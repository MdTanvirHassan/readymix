<style type="text/css">
    td{
        padding:3px !important;
    }
    input{
        margin:0px !important;
    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; ">View Material Cost </h2>
            <hr>
            <form action="<?php echo site_url('products_cost/edit_product_cost_action/'.$product_quote_price[0]['product_cost_id']); ?>" method="post">
                
                
                <div class="row">
                 <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Costing Number  :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                
                                <input readonly  class="form-control" id="cost_number" name="cost_number" type="text" value="<?php echo $product_quote_price[0]['cost_number'];  ?>">
                            </div>
                        </div>
                    </div> 
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-2 col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Product<sup style="color:red">*</sup>  :</label></div>
                            <div disabled class="col-sm-8 col-md-5 "><select required style="width:200px;" class="e1" style="width:100px;" id="product" name="product_id" >
                                    <option value="">Select Product</option>
                                    <?php foreach($products as $product){ ?>
                                        <option <?php if($product_quote_price[0]['product_id']==$product['product_id']) echo 'selected'; ?> value="<?php echo $product['product_id'];  ?>"><?php if(!empty($product['product_name'])) echo $product['product_name']; ?></option>
                                    <?php } ?>
                                </select></div>
                            <div class="col-sm-2 col-md-2 ">
                                <span id="m_unit" ><?php echo 'Per '.$product_quote_price[0]['measurement_unit']; ?></span>
                           </div>
                        </div>
                    </div>
                    
                    
                   
                </div>
                
                  <div class="row">
                
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right"><label for="inputdefault">Customer<sup style="color:red">*</sup>  :</label></div>
                            <div class="col-sm-8 col-md-5 "><select disabled required style="width:200px;" class="e1" style="width:100px;" id="customer_id" name="customer_id" >
                                    <option value="">Select Customer</option>
                                    <?php foreach($customers as $customer){ ?>
                                        <option <?php if($product_quote_price[0]['customer_id']==$customer['id']) echo 'selected'; ?> value="<?php echo $customer['id'];  ?>"><?php if(!empty($customer['c_name'])) echo $customer['c_name']; ?></option>
                                    <?php } ?>
                                </select></div>
                        </div>
                    </div>
                   
                     <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3   labeltext" style="text-align: right"><label for="inputdefault">Project Name<sup style="color:red">*</sup>  :</label></div>
                            <div class="col-sm-8 col-md-5 ">  
                               <select disabled  style="width:200px;" class="e1"  id="project_id" name="project_id" >
                                     <option value="">Select Project</option>
                                     <?php foreach($projects as $project){ ?>
                                            <option <?php if($project['project_id']==$product_quote_price[0]['project_id']) echo 'selected'; ?> value="<?php echo $project['project_id'];  ?>"><?php echo $project['project_name'];  ?></option>
                                     <?php } ?>
                                   
                                </select>
                            </div>
                        </div>
                    </div> 
                      
                      
                </div>
                
               
     
              
                
                <input type="hidden" id="count" value="1"/>
            <table class="table table-bordered" id="myTable">
                    <thead>
                     <tr>
                         
                         <th>Material <sup style='color:red'>*</sup></th>
                         <th>Brand</th>
                         <th>MU</th>
                         <th>Quantity</th>       
                         <th>Rate</th>
                         <th>Value</th>


                      </tr>
                    </thead>
                     <tbody id="material_body">
                         <?php 
                         $i=0;
                         $total=0;
                         $total_qnty=0;
                         $total_other_expense=$product_other_cost[0]['transport_cost']+$product_other_cost[0]['overhead_expense']+$product_other_cost[0]['sales_commission']+$product_other_cost[0]['foh']+$product_other_cost[0]['aoh']+$product_other_cost[0]['soh']+$product_other_cost[0]['final_expense'];
                         $total_vat_ait=$product_other_cost[0]['vat']+$product_other_cost[0]['ait'];
                         
                         foreach($material_costs as $material_cost){ 
                             $total=$total+$material_cost['value'];
                             $total_qnty=$total_qnty+$material_cost['quantity'];
                             $i++;
                             ?>
                                <tr>
                                        <td><input type="hidden"  style="width:140px;"  name="m_id[]" id="m_id_<?php echo $i; ?>" class="issue" value="<?php echo $material_cost['m_id']; ?>"><input disabled  style="width:140px;"  type="text"  name="item[]" id="item_<?php echo $i; ?>" class="issue" value="<?php echo $material_cost['item_name']; ?>"></td>
                                        <td><input readonly  style="width:140px;"  type="text"  name="brand[]" id="brand_<?php echo $i; ?>" class="issue" value="<?php echo $material_cost['brand']; ?>"></td>
                                        <td><input readonly style="width:140px;"  type="text"  name="meas_unit[]" id="meas_unit_<?php echo $i; ?>" class="issue" value="<?php echo $material_cost['meas_unit']; ?>"></td>
                                        <td><input readonly required onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"  style="width:140px;text-align:right;"  type="text"  name="quantity[]" id="quantity_<?php echo $i; ?>" class="issue" value="<?php echo $material_cost['quantity']; ?>"></td>
                                        <td><input readonly required onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"  style="width:140px;text-align:right;"  type="text"  name="rate[]" id="rate_<?php echo $i; ?>" class="issue" value="<?php echo $material_cost['rate']; ?>"></td>
                                        <td><input readonly style="width:140px;text-align:right;"  type="text"  name="value[]" id="value_<?php echo $i; ?>" class="issue" value="<?php echo $material_cost['value']; ?>"></td>
                                </tr>
                         <?php } 
                            $total_with_other_expense_vat=$total+$total_other_expense+$total_vat_ait;
                         ?>
                      
                     </tbody>
                      <tfoot id="foot" >
                          <tr>
                              <td colspan="3" style="text-align: right;"><b>Total</b></td>
                              <td style="text-align: right;">
                                  <input readonly style="width:140px;margin:0px;text-align:right;" type="hidden" id="total_quantity" name="total_quantity" value="<?php echo $total_qnty; ?>" />
                                  <b> <span style="width:140px;margin-right:32px;"  id="total_material_quantity"><?php echo $total_qnty; ?></span></b>
                              </td>
                              <td  style="text-align: right;"><b>Total</b></td>
                              <td style="text-align: right;">
                                  <input readonly style="width:140px;margin:0px;text-align:right;" type="hidden" id="total" name="total_material_cost" value="<?php echo $total; ?>" />
                                  <b> <span style="width:140px;margin-right:32px;"  id="total_material_cost_amount"><?php echo $total; ?></span></b>
                              </td>
                          </tr>
                          <tr>
                              <td colspan="4" style="text-align: right;">Transport Cost</td>
                              <td><input readonly class="number" onkeyup="javascript:calculateOtherExpense();" onchange="javascript:calculateOtherExpense();" onblur="javascript:calculateOtherExpense();" style="width:140px;text-align:right;" type="text" id="transport_cost" name="transport_cost" value="<?php if(!empty($product_other_cost[0]['transport_cost'])) echo $product_other_cost[0]['transport_cost'];  ?>" /></td>
                          </tr>
                           <tr>
                              <td colspan="4" style="text-align: right;">Overhead Expense</td>
                              <td><input readonly class="number" onkeyup="javascript:calculateOtherExpense();" onchange="javascript:calculateOtherExpense();" onblur="javascript:calculateOtherExpense();" style="width:140px;text-align:right;" type="text" id="overhead_expense" name="overhead_expense" value="<?php if(!empty($product_other_cost[0]['overhead_expense'])) echo $product_other_cost[0]['overhead_expense'];  ?>" /></td>
                          </tr>
                          <tr>
                              <td colspan="4" style="text-align: right;">Sales Commission</td>
                              <td><input readonly class="number" onkeyup="javascript:calculateOtherExpense();" onchange="javascript:calculateOtherExpense();" onblur="javascript:calculateOtherExpense();" style="width:140px;text-align:right;" type="text" id="sales_commission" name="sales_commission" value="<?php if(!empty($product_other_cost[0]['sales_commission'])) echo $product_other_cost[0]['sales_commission'];  ?>" /></td>
                          </tr>
                           <tr>
                              <td colspan="4" style="text-align: right;">FOH</td>
                              <td><input readonly onkeyup="javascript:calculateOtherExpense();" onchange="javascript:calculateOtherExpense();" onblur="javascript:calculateOtherExpense();" style="width:140px;text-align:right;" type="text" id="foh" name="foh" value="<?php if(!empty($product_other_cost[0]['foh'])) echo $product_other_cost[0]['foh'];  ?>" /></td>
                          </tr>
                           <tr>
                              <td colspan="4" style="text-align: right;">AOH</td>
                              <td><input readonly onkeyup="javascript:calculateOtherExpense();" onchange="javascript:calculateOtherExpense();" onblur="javascript:calculateOtherExpense();" style="width:140px;text-align:right;" type="text" id="aoh" name="aoh" value="<?php if(!empty($product_other_cost[0]['aoh'])) echo $product_other_cost[0]['aoh'];  ?>" /></td>
                          </tr>
                           <tr>
                              <td colspan="4" style="text-align: right;">SOH</td>
                              <td><input readonly onkeyup="javascript:calculateOtherExpense();" onchange="javascript:calculateOtherExpense();" onblur="javascript:calculateOtherExpense();" style="width:140px;text-align:right;" type="text" id="soh" name="soh" value="<?php if(!empty($product_other_cost[0]['soh'])) echo $product_other_cost[0]['soh'];  ?>" /></td>
                          </tr>
                           <tr>
                              <td colspan="4" style="text-align: right;">Fin. Exp</td>
                              <td><input readonly onkeyup="javascript:calculateOtherExpense();" onchange="javascript:calculateOtherExpense();" onblur="javascript:calculateOtherExpense();" style="width:140px;text-align:right;" type="text" id="final_expense" name="final_expense" value="<?php if(!empty($product_other_cost[0]['final_expense'])) echo $product_other_cost[0]['final_expense'];  ?>" /></td>
                              <td><input readonly style="width:140px;text-align:right;" type="text" id="total_other_expense" value="<?php echo $total_other_expense; ?>" /></td>
                          </tr>
                          <tr>
                              <td colspan="4" style="text-align: right;">VAT</td>
                              <td><input readonly onkeyup="javascript:calculateVatAit();" onchange="javascript:calculateVatAit();" onblur="javascript:calculateVatAit();" style="width:140px;text-align:right;" type="text" id="vat" name="vat" value="<?php if(!empty($product_other_cost[0]['vat'])) echo $product_other_cost[0]['vat'];  ?>" /></td>
                          </tr>
                           <tr>
                              <td colspan="4" style="text-align: right;">AIT</td>
                              <td><input readonly onkeyup="javascript:calculateVatAit();" onchange="javascript:calculateVatAit();" onblur="javascript:calculateVatAit();" style="width:140px;text-align:right;" type="text" id="ait" name="ait" value="<?php if(!empty($product_other_cost[0]['ait'])) echo $product_other_cost[0]['ait'];  ?>" /></td>
                              <td><input readonly style="width:140px;text-align:right;" type="text" id="total_vat_ait" name="t_ait_vat" value="<?php echo $total_vat_ait; ?>" /></td>
                          </tr>
                           <tr>
                              <td colspan="5" style="text-align: right;"></td>
                              <td><input readonly style="width:140px;text-align:right;" type="text" id="total_with_other_expense_vat" name="" value="<?php echo $total_with_other_expense_vat; ?>" /></td>
                             
                          </tr>
                          <tr>
                              <td colspan="4" style="text-align: right;">Profit</td>
                              <td><input readonly onkeyup="javascript:calculateProfit();" onchange="javascript:calculateProfit();" onblur="javascript:calculateProfit();" style="width:140px;text-align:right;" type="text" id="profit_percentage" name="profit_percentage" value="<?php if(!empty($product_other_cost[0]['profit_percentage'])) echo $product_other_cost[0]['profit_percentage'];  ?>" />%</td>
                              <td><input readonly style="width:140px;text-align:right;" type="text" id="total_profit" name="profit_amount" value="<?php if(!empty($product_other_cost[0]['profit_amount'])) echo $product_other_cost[0]['profit_amount'];  ?>" /></td>
                          </tr>
                          <tr>
                              <td colspan="5" style="text-align: right;">Quote Price</td>
                              <td><input readonly style="width:140px;text-align:right;" type="text" id="quote_price" name="quote_price" value="<?php if(!empty($product_quote_price[0]['quote_price'])) echo $product_quote_price[0]['quote_price'];  ?>" /></td>
                             
                          </tr>
                      </tfoot>
                  </table>
                <div class="row">
                   
                        <div class="row">
                           
                            <div class="col-md-2">
                                <a href="<?php echo site_url('backend/products_cost') ?>" > <button type="button" class="btn btn-success button">REGISTER</button> </a>

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
        $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr=$('#item_c_1').html();
        
        var str= '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str +='<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>'; 
        str +='<td><select required class="e1" style="width:200px;"  name="m_id[]" id="item_c_'+(Number(count) + 1) + '" class="">'+itemstr+'</select></td>';
        str +='<td><input  style="width:140px;"  type="text"  name="mu[]" id="mu_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><input required style="width:140px;"  type="text"  name="quantity[]" id="quantity_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><input required style="width:140px;"  type="text"  name="rate[]" id="rate_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><input  style="width:140px;"  type="text"  name="value[]" id="value_'+(Number(count) + 1) + '" class="issue"></td>';
       
        str +='</tr>';
       
        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
        $('select.e1').select2();
        $('.chzn-container').remove();
    });
    
    function removeRow(row) {
        $('#row_' + row).remove();
    }
    
    $('#product').change(function () {
        var product_id=  $('#product').val();
        var data = {'product_id': product_id}
        if(product_id!=''){
            $.ajax({
                url: '<?php echo site_url('products_cost/get_item_material'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {   
                  
                  var str='';
                   if(msg.item_list!=''){
                        $(msg.item_list).each(function(i,v){

                            str+= '<tr  id="row_' + (Number(i) + 1) + '">';  
                            str +='<td><input type="hidden"  style="width:140px;"  name="m_id[]" id="m_id_'+(Number(i) + 1) + '" class="issue" value="'+v.m_id+'"><input  style="width:140px;"  type="text"  name="item[]" id="item_'+(Number(i) + 1) + '" class="issue" value="'+v.item_name+'"></td>';
                            str +='<td><input  style="width:140px;"  type="text"  name="brand[]" id="mu_'+(Number(i) + 1) + '" class="issue" value=""></td>';
                            str +='<td><input  style="width:140px;"  type="text"  name="mu[]" id="mu_'+(Number(i) + 1) + '" class="issue" value="'+v.meas_unit+'"></td>';
                            str +='<td><input required onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:140px;"  type="text"  name="quantity[]" id="quantity_'+(Number(i) + 1) + '" class="issue" value="'+v.quantity+'"></td>';
                            str +='<td><input required onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:140px;"  type="text"  name="rate[]" id="rate_'+(Number(i) + 1) + '" class="issue"></td>';
                            str +='<td><input  style="width:140px;"  type="text"  name="value[]" id="value_'+(Number(i) + 1) + '" class="issue"></td>';
                            str +='</tr>';
                        }); 
                        $('#foot').show();
                   }else{
                        $('#foot').hide();
                   }
                   $('#material_body').html(str);
                   
                }


            })
        }else{
            $('#material_body').html('');
            $('#foot').hide();
        }
    });
    
    function calculateSubtotal(id){
        
         var sub_total=0;
         var unit_price=$('#rate_'+id).val();
         var quantity=$('#quantity_'+id).val();
         if(unit_price!='' && quantity!=''){
            var amount=Number(unit_price)*Number(quantity);
        }else{
             var amount=0;
        }    
       
         $('#value_'+id).val(amount);
         var rowCount = $('#myTable tr').length;
         var table_row=Number(rowCount)-11;
         
         for(var i=1;i<=table_row;i++){
             var amt=$('#value_'+i).val();
             if(amt!=''){
                sub_total=sub_total+Number(amt);
            }
             
             
         }    
         
       $('#total').val(sub_total);
       var total_vat_ait=$('#total_vat_ait').val();
       var total_other_expense=$('#total_other_expense').val();
       var total_with_other_expense_vat=Number(sub_total)+Number(total_vat_ait)+Number(total_other_expense);
       $('#total_with_other_expense_vat').val(total_with_other_expense_vat);
       var percentage=Number($('#profit_percentage').val());
       if(percentage!=''){
            var total_profit=(total_with_other_expense_vat*percentage/100);
       }else{
           var total_profit='';
       }    
       $('#total_profit').val(total_profit);
       if(total_profit!=''){
            var quote_price=Number(total_with_other_expense_vat)+Number(total_profit);
       }else{
           var quote_price=Number(total_with_other_expense_vat);
       }    
       $('#quote_price').val(quote_price);
    }


   function calculateOtherExpense(){
       var foh=$('#foh').val();
       var aoh=$('#aoh').val();
       var soh=$('#soh').val();
       var final_expense=$('#final_expense').val();
       var total_other_expense=Number(foh)+Number(aoh)+Number(soh)+Number(final_expense);
       $('#total_other_expense').val(total_other_expense);
       var total=$('#total').val();
       var total_vat_ait=$('#total_vat_ait').val();
       var total_with_other_expense_vat=Number(total)+Number(total_vat_ait)+total_other_expense;
       $('#total_with_other_expense_vat').val(total_with_other_expense_vat);
       
       var percentage=Number($('#profit_percentage').val());
       if(percentage!=''){
            var total_profit=(total_with_other_expense_vat*percentage/100);
       }else{
           var total_profit='';
       }    
       $('#total_profit').val(total_profit);
       if(total_profit!=''){
            var quote_price=Number(total_with_other_expense_vat)+Number(total_profit);
       }else{
           var quote_price=Number(total_with_other_expense_vat);
       }    
       $('#quote_price').val(quote_price);
   }
  
  function calculateVatAit(){
       var vat=$('#vat').val();
       var ait=$('#ait').val();

       var total=$('#total').val();
       var total_other_expense=$('#total_other_expense').val();
       var total_vat_ait=Number(vat)+Number(ait);
       $('#total_vat_ait').val(total_vat_ait);
       var total_with_other_expense_vat=Number(total)+Number(total_vat_ait)+Number(total_other_expense);
       $('#total_with_other_expense_vat').val(total_with_other_expense_vat);
       
       var percentage=Number($('#profit_percentage').val());
       if(percentage!=''){
            var total_profit=(total_with_other_expense_vat*percentage/100);
       }else{
           var total_profit='';
       }    
       $('#total_profit').val(total_profit);
       if(total_profit!=''){
            var quote_price=Number(total_with_other_expense_vat)+Number(total_profit);
       }else{
           var quote_price=Number(total_with_other_expense_vat);
       }    
       $('#quote_price').val(quote_price);
   }
   
   function calculateProfit(){
      var percentage=Number($('#profit_percentage').val());
      var total_with_other_expense_vat=Number($('#total_with_other_expense_vat').val());
      var total_profit=(total_with_other_expense_vat*percentage/100);
      $('#total_profit').val(total_profit);
      var quote_price=Number(total_with_other_expense_vat)+Number(total_profit);
      $('#quote_price').val(quote_price);
   }    

    </script>
                    