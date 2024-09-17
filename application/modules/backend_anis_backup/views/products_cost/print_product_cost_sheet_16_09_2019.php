<style type="text/css">
    @page {
        size: auto;   /* auto is the initial value */
        margin-top: 0px;  /* this affects the margin in the printer settings */
        margin-bottom: 0;
    }
    .table-bordered {
        border: 0px;
    }
    td{
        padding:3px !important;
    }
    input{
        margin:0px !important;
    }
</style>
<div class="right_col" style="padding-bottom:20px;padding-top:30px;">
         <!--   <h2 style="text-align:center; ">Cost Sheet</h2>-->
           
         <div class="">
        <div class="page-title">
            
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
               
                
                
              
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <h2 style="text-align:center">Karim Asphalt & Ready Mix Ltd.</h2>
                        <h2 style="text-align:center">Cost Sheet</h2>
                      
                    </div>
                </div>
              
                
                <input type="hidden" id="count" value="1"/>
            <table class="table table-bordered" id="myTable" style="border:none;margin:0 auto;">
                                <thead>
                                    <tr >
                                        <th colspan="10" style="border:none;text-align: left;"><?php echo $product_quote_price[0]['product_name'];?></th>
                                       
                                        <th colspan="2" style="border:none;;text-align: left;">Client: <?php echo $product_quote_price[0]['casting_size'];?></th>
                                    </tr>
                                     <tr >
                                       
                                        <th colspan="10" style="border:none;text-align: left;">Strength: <?php echo $product_quote_price[0]['p_psi'];?> PSI</th>
                                        <th colspan="2" style="border:none;text-align: left;">Project: <?php echo $product_quote_price[0]['project_name'];?> </th>
                                    </tr>
                                     <tr >
                                        <th colspan="10" style="border:none;text-align: left;">Casting Size: <?php echo $product_quote_price[0]['casting_size'];?>  <?php echo $product_quote_price[0]['measurement_unit'];?></th>
                                        <th colspan="2" style="border:none;text-align: left;">Date: <?php echo date('d-m-Y',strtotime($product_quote_price[0]['created_date']));?></th>
                                        
                                    </tr>
                                    <tr>

                                        <th style="text-align: center;border-left:1px solid;border-top:1px solid;">Material <sup style='color:red'>*</sup></th>
                                        <th style="text-align: center;border-left:1px solid;border-top:1px solid;">Specification</th>
                                        <th style="text-align: center;border-left:1px solid;border-top:1px solid;">For 01 <?php echo $product_quote_price[0]['measurement_unit'];?></th> 
                                        <th style="text-align: center;border-left:1px solid;border-top:1px solid;">MU</th>
                                        <th style="text-align: center;border-left:1px solid;border-top:1px solid;">For Order</th> 
                                        <th style="text-align: center;border-left:1px solid;border-top:1px solid;">C. Factor</th>   
                                        <th style="text-align: center;border-left:1px solid;border-top:1px solid;">C. Qnty</th>
                                        <th style="text-align: center;border-left:1px solid;border-top:1px solid;">MU</th>
                                        <th style="text-align: center;border-left:1px solid;border-top:1px solid;">Rate</th>
                                        <th style="text-align: center;border-left:1px solid;border-top:1px solid;">Mat. Cost</th>
                                        <th style="text-align: center;border-left:1px solid;border-top:1px solid;">Cost/CUM</th>
                                        <th style="text-align: center;border-left:1px solid;border-top:1px solid;border-right:1px solid;">Cost/CFT</th>

                                    </tr>
                                </thead>
                                <tbody id="material_body">
                                    <?php
                                    $i = 0;
                                    $total = 0;
                                    $total_qnty = 0;
                                    $total_order_qnty=0;
                                    $total_other_expense = $product_other_cost[0]['transport_cost'] + $product_other_cost[0]['overhead_expense'] + $product_other_cost[0]['sales_commission'] + $product_other_cost[0]['foh'] + $product_other_cost[0]['aoh'] + $product_other_cost[0]['soh'] + $product_other_cost[0]['final_expense'];
                                    $total_vat_ait = $product_other_cost[0]['vat'] + $product_other_cost[0]['ait'];
                                    $total_per_cum=0;
                                    $total_per_cft=0;
                                    foreach ($material_costs as $material_cost) {
                                        $total = $total + round($material_cost['value']*$product_quote_price[0]['casting_size'],2);
                                        $total_qnty = $total_qnty + $material_cost['quantity'];
                                        $total_order_qnty=$total_order_qnty+round($material_cost['quantity']*$product_quote_price[0]['casting_size'],2);
                                        $total_per_cum=$total_per_cum+$material_cost['value'];
                                        $total_per_cft=$total_per_cft+round(($material_cost['value']/35.31),2);
                                        $i++;
                                        ?>
                                        <tr>
                                            <td style="text-align: left;border-left:1px solid;border-top:1px solid;"><?php echo $material_cost['item_name']; ?></td>
                                            <td style="text-align: left;border-left:1px solid;border-top:1px solid;"><?php echo $material_cost['brand']; ?></td>
                                            <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><?php echo $material_cost['quantity']; ?></td>
                                            <td style="text-align: left;border-left:1px solid;border-top:1px solid;"><?php echo $material_cost['meas_unit']; ?></td>
                                            <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><?php echo round($material_cost['quantity']*$product_quote_price[0]['casting_size'],2); ?></td>
                                            <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><?php echo $material_cost['conversion_factor']; ?></td>
                                            <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><?php echo round($material_cost['c_quantity']*$product_quote_price[0]['casting_size'],2); ?></td>
                                            <td style="text-align: left;border-left:1px solid;border-top:1px solid;"><?php echo $material_cost['c_mu']; ?></td>
                                            <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><?php echo $material_cost['rate']; ?></td>
                                            <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><?php echo round($material_cost['value']*$product_quote_price[0]['casting_size'],2); ?></td>
                                            <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><?php echo $material_cost['value']; ?></td>
                                            <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;"><?php echo round(($material_cost['value']/35.31),2); ?></td>
                                        </tr>
                                        <?php
                                    }
                                    $total_with_other_expense_vat = $total + $total_other_expense + $total_vat_ait;
                                    ?>

                                </tbody>
                                <tfoot id="foot" >
                                    <tr>
                                        <td colspan="2" style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b>Total</b></td>
                                        <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">
                                            <input readonly style="width:140px;margin:0px;text-align:right;" type="hidden" id="total_quantity" name="total_quantity" value="<?php echo $total_qnty; ?>" />
                                            <b> <span style="width:140px;margin-right:0px;"  id="total_material_quantity"><?php echo $total_qnty; ?></span></b>
                                        </td>
                                        <td  style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                                        <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">
                                            <b> <span style="width:140px;margin-right:0px;"  id=""><?php echo $total_order_qnty; ?></span></b>
                                        </td>
                                        
                                        <td  style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                                        <td  style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                                        <td  style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                                        <td  style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                                        <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">
                                          
                                            <b> <span style="width:140px;margin-right:0px;"  id="total_material_cost_amount"><?php echo $total; ?></span></b>
                                        </td>
                                        <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">
                                          
                                            <b> <span style="width:140px;margin-right:0px;"  id="total_material_cost_amount"><?php echo $total_per_cum; ?></span></b>
                                        </td>
                                        <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;">
                                          
                                            <b> <span style="width:140px;margin-right:0px;"  id="total_material_cost_amount"><?php echo $total_per_cft; ?></span></b>
                                        </td>
                                    </tr>
                                   
                                </tfoot>
                            </table>
            
            
        </div>
        </div>
        </div>
        </div>
        </div>
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
                    