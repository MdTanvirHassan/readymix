<style type="text/css">
    td{
        padding:3px !important;
    }
    input{
        margin:0px !important;
    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
         <!--   <h2 style="text-align:center; ">Cost Sheet</h2>-->
           
         <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Cost Sheet </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
               
                
                
              
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <h4 style="text-align:center">Karim Asphalt & Ready Mix Ltd.</h4>
                        <h4 style="text-align:center">Cost Analysis of <?php echo $product_quote_price[0]['product_name'];?></h4>
                        <p style="text-align:center;font-weight: bold;">Project: <?php echo $product_quote_price[0]['project_name'];?></p>
                        
                        <p style="text-align:center;font-weight: bold;">Strength: <?php echo $product_quote_price[0]['p_psi'];?> PSI</p>
                       
                        <p style="text-align:center;font-weight: bold;">Period: </p>
                    </div>
                </div>
              
                
                <input type="hidden" id="count" value="1"/>
            <table class="table table-bordered" id="myTable" >
                    <thead>
                        
                        
                            
                       
                     <tr>
                         
                         <th style="text-align: center;">Material </th>
                         <th style="text-align: center;">Brand</th>
                         <th style="text-align: center;">MU</th>
                         <th style="text-align: center;">Quantity</th>       
                         <th style="text-align: center;">Rate</th>
                         <th style="text-align: center;">Cost per Cu.M</th>
                         <th style="text-align: center;">Cost per Cft</th>

                      </tr>
                    </thead>
                     <tbody id="material_body">
                         <?php 
                         $i=0;
                         $total=0;
                         $total_value_in_cft=0;
                         $total_other_expense_in_cft=0;
                         $total_qnty=0;
                         $total_other_expense=$product_other_cost[0]['transport_cost']+$product_other_cost[0]['overhead_expense']+$product_other_cost[0]['sales_commission']+$product_other_cost[0]['foh']+$product_other_cost[0]['aoh']+$product_other_cost[0]['soh']+$product_other_cost[0]['final_expense'];
                         if(!empty($product_other_cost[0]['transport_cost'])){
                             $total_other_expense_in_cft=$total_other_expense_in_cft+round(($product_other_cost[0]['transport_cost']/35.31),2);
                         }
                         if(!empty($product_other_cost[0]['overhead_expense'])){
                             $total_other_expense_in_cft=$total_other_expense_in_cft+round(($product_other_cost[0]['overhead_expense']/35.31),2);
                         }
                         if(!empty($product_other_cost[0]['sales_commission'])){
                             $total_other_expense_in_cft=$total_other_expense_in_cft+round(($product_other_cost[0]['sales_commission']/35.31),2);
                         }
                         if(!empty($product_other_cost[0]['foh'])){
                             $total_other_expense_in_cft=$total_other_expense_in_cft+round(($product_other_cost[0]['foh']/35.31),2);
                         }
                         if(!empty($product_other_cost[0]['aoh'])){
                             $total_other_expense_in_cft=$total_other_expense_in_cft+round(($product_other_cost[0]['aoh']/35.31),2);
                         }
                         if(!empty($product_other_cost[0]['soh'])){
                             $total_other_expense_in_cft=$total_other_expense_in_cft+round(($product_other_cost[0]['soh']/35.31),2);
                         }
                         if(!empty($product_other_cost[0]['final_expense'])){
                             $total_other_expense_in_cft=$total_other_expense_in_cft+round(($product_other_cost[0]['final_expense']/35.31),2);
                         }
                         $total_vat_ait=$product_other_cost[0]['vat']+$product_other_cost[0]['ait'];
                         if(!empty($product_other_cost[0]['vat'])){
                             $total_other_expense_in_cft=$total_other_expense_in_cft+round(($product_other_cost[0]['vat']/35.31),2);
                         }
                         if(!empty($product_other_cost[0]['ait'])){
                             $total_other_expense_in_cft=$total_other_expense_in_cft+round(($product_other_cost[0]['ait']/35.31),2);
                         }
                         if(!empty($product_other_cost[0]['profit_amount'])){
                             $total_other_expense_in_cft=$total_other_expense_in_cft+round(($product_other_cost[0]['profit_amount']/35.31),2);
                         }
                         foreach($material_costs as $material_cost){ 
                             $total_value_in_cft=$total_value_in_cft+round(($material_cost['value']/35.31),2);
                             $total=$total+$material_cost['value'];
                             $total_qnty=$total_qnty+$material_cost['quantity'];
                             $i++;
                             ?>
                                <tr>
                                        <td><?php echo $material_cost['item_name']; ?></td>
                                        <td><?php echo $material_cost['brand']; ?></td>
                                        <td><?php echo $material_cost['meas_unit']; ?></td>
                                        <td style="text-align: right;"><?php echo $material_cost['quantity']; ?></td>
                                        <td style="text-align: right;"><?php echo $material_cost['rate']; ?></td>
                                        <td style="text-align: right;"><?php echo $material_cost['value']; ?></td>
                                        <td style="text-align: right;"><?php echo round(($material_cost['value']/35.31),2); ?></td>
                                </tr>
                         <?php } 
                            $total_with_other_expense_vat=$total+$total_other_expense+$total_vat_ait;
                            $cell_value_in_cft=$total_other_expense_in_cft+$total_value_in_cft;
                         ?>
                      
                     </tbody>
                      <tfoot id="foot" >
                          <tr>
                              <td colspan="3" style="text-align: left;"><b>Total</b></td>
                              <td style="text-align: right;">
                                  
                                  <b> <?php echo $total_qnty; ?></b>
                              </td>
                              <td  style="text-align: right;"></td>
                              <td style="text-align: right;">
                                  <b> <?php echo $total; ?></b>
                                 
                              </td>
                              <td style="text-align: right;">
                                  <b><?php echo $total_value_in_cft; ?></b>
                                 
                              </td>
                          </tr>
                          <tr>
                              <td colspan="5" style="text-align: left;">Transport Cost</td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['transport_cost'])) echo $product_other_cost[0]['transport_cost'];  ?></b></td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['transport_cost'])) echo round(($product_other_cost[0]['transport_cost']/35.31),2);  ?></b></td>
                          </tr>
                           <tr>
                              <td colspan="5" style="text-align: left;">Overhead Expense</td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['overhead_expense'])) echo $product_other_cost[0]['overhead_expense'];  ?></b></td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['overhead_expense'])) echo round(($product_other_cost[0]['overhead_expense']/35.31),2);  ?></b></td>
                          </tr>
                          <tr>
                              <td colspan="5" style="text-align: left;">Sales Commission</td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['sales_commission'])) echo $product_other_cost[0]['sales_commission'];  ?></b></td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['sales_commission'])) echo round(($product_other_cost[0]['sales_commission']/35.31),2);  ?></b></td>
                          </tr>
                           <tr>
                              <td colspan="5" style="text-align: left;">FOH</td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['foh'])) echo $product_other_cost[0]['foh'];  ?></b></td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['foh'])) echo round(($product_other_cost[0]['foh']/35.31),2);  ?></b></td>
                          </tr>
                           <tr>
                              <td colspan="5" style="text-align: left;">AOH</td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['aoh'])) echo $product_other_cost[0]['aoh'];  ?></b></td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['transport_cost'])) echo round(($product_other_cost[0]['transport_cost']/35.31),2);  ?></b></td>
                          </tr>
                           <tr>
                              <td colspan="5" style="text-align: left;">SOH</td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['soh'])) echo $product_other_cost[0]['soh'];  ?></b></td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['soh'])) echo round(($product_other_cost[0]['soh']/35.31),2);  ?></b></td>
                          </tr>
                           <tr>
                              <td colspan="5" style="text-align: left;">Fin. Exp</td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['final_expense'])) echo $product_other_cost[0]['final_expense'];  ?></b></td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['final_expense'])) echo round(($product_other_cost[0]['final_expense']/35.31),2);  ?></b></td>
                              
                          </tr>
                          <tr>
                              <td colspan="5" style="text-align: left;">VAT</td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['vat'])) echo $product_other_cost[0]['vat'];  ?></b></td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['vat'])) echo round(($product_other_cost[0]['vat']/35.31),2);  ?></b></td>
                          </tr>
                           <tr>
                              <td colspan="5" style="text-align: left;">AIT</td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['ait'])) echo $product_other_cost[0]['ait'];  ?></b></td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['ait'])) echo round(($product_other_cost[0]['ait']/35.31),2);  ?></b></td>
                             
                          </tr>
                          
                          <tr>
                              <td colspan="5" style="text-align: left;">Profit</td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['profit_amount'])) echo $product_other_cost[0]['profit_amount'];  ?></b></td>
                              <td style="text-align: right;"><b><?php if(!empty($product_other_cost[0]['profit_amount'])) echo round(($product_other_cost[0]['profit_amount']/35.31),2);  ?></b></td>
                              
                          </tr>
                          <tr>
                              <td colspan="5" style="text-align: left;">Selling Price</td>
                              <td style="text-align: right;"><b><?php if(!empty($product_quote_price[0]['quote_price'])) echo $product_quote_price[0]['quote_price'];  ?></b></td>
                              <td style="text-align: right;"><b><?php echo $cell_value_in_cft;  ?></b></td>
                             
                          </tr>
                      </tfoot>
                  </table>
                <div class="row">
                   
                        <div class="row">
                           
                            <div class="col-md-2">
                                <a href="<?php echo site_url('backend/products_cost') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                          </div>    
                            <div class="col-md-2">
                                <a href="<?php echo site_url('backend/products_cost/productCostSheet/'.$product_quote_price[0]['product_cost_id'].'/true') ?>" > <button type="button" class="btn btn-primary button">PRINT</button> </a>

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
                    