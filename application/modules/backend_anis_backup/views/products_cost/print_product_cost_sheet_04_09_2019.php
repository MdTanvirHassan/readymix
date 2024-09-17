<style type="text/css">
    @page {
        size: auto;   /* auto is the initial value */
        margin-top: 0px;  /* this affects the margin in the printer settings */
        margin-bottom: 0;
    }
    td{
        padding:3px !important;
    }
    input{
        margin:0px !important;
    }
</style>
<div class="right_col" style="padding-bottom:20px;padding-top:50px;">
         <!--   <h2 style="text-align:center; ">Cost Sheet</h2>-->
           
            <form action="<?php echo site_url('products_cost/edit_product_cost_action/'.$product_quote_price[0]['product_cost_id']); ?>" method="post">
                
                
              
     
              
                
                <input type="hidden" id="count" value="1"/>
            <table class="table table-bordered" id="myTable" style="border:none;margin:0 auto;">
                    <thead>
                        <tr>
                            <th style="border:none;"></th>
                            <th style="border:none;text-align: left;" colspan="4">Karim Asphalt & Ready Mix Ltd.</th>
                            <th style="border:none;text-align: left;" colspan="2">Project: <?php echo $product_quote_price[0]['project_name'];?></th>
                        </tr>
                        <tr>
                            <th style="border:none;"></th>
                            <th style="border:none;text-align: left;" colspan="4">Cost Analysis of</th>
                            <th style="border:none;text-align: left;" colspan="2">Strength: <?php echo $product_quote_price[0]['p_psi'];?> PSI</th>
                        </tr>
                        <tr>
                            <th style="border:none;"></th>
                            <th style="border:none;text-align: left;" colspan="4"><?php echo $product_quote_price[0]['product_name'];?></th>
                            <th style="border:none;text-align: left;" colspan="2">Period:</th>
                        </tr>    
                       
                     <tr>
                         
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;">Material </th>
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;width:200px;">Brand</th>
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;">MU</th>
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;">Quantity</th>       
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;">Rate</th>
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;">Cost per Cu.M</th>
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;border-right:1px solid;">Cost per Cft</th>

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
                                        <td style="border-left:1px solid;border-top:1px solid;"><?php echo $material_cost['item_name']; ?></td>
                                        <td style="border-left:1px solid;border-top:1px solid;"><?php echo $material_cost['brand']; ?></td>
                                        <td style="border-left:1px solid;border-top:1px solid;"><?php echo $material_cost['meas_unit']; ?></td>
                                        <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><?php echo $material_cost['quantity']; ?></td>
                                        <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><?php echo $material_cost['rate']; ?></td>
                                        <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><?php echo $material_cost['value']; ?></td>
                                        <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;"><?php echo round(($material_cost['value']/35.31),2); ?></td>
                                </tr>
                         <?php } 
                            $total_with_other_expense_vat=$total+$total_other_expense+$total_vat_ait;
                            $cell_value_in_cft=$total_other_expense_in_cft+$total_value_in_cft;
                         ?>
                      
                     </tbody>
                      <tfoot id="foot" >
                          <tr>
                              <td colspan="3" style="text-align: left;border-left:1px solid;border-top:1px solid;"><b>Total</b></td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;">
                                  
                                  <b> <?php echo $total_qnty; ?></b>
                              </td>
                              <td  style="text-align: right;border-left:1px solid;border-top:1px solid;"></td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;">
                                  <b> <?php echo $total; ?></b>
                                 
                              </td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;">
                                  <b> <?php echo $total_value_in_cft; ?></b>
                                 
                              </td>
                          </tr>
                          <tr>
                              <td colspan="5" style="text-align: left;border-left:1px solid;border-top:1px solid;">Transport Cost</td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><b><?php if(!empty($product_other_cost[0]['transport_cost'])) echo $product_other_cost[0]['transport_cost'];  ?></b></td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;"><b><?php if(!empty($product_other_cost[0]['transport_cost'])) echo round(($product_other_cost[0]['transport_cost']/35.31),2);  ?></b></td>
                          </tr>
                           <tr>
                              <td colspan="5" style="text-align: left;border-left:1px solid;border-top:1px solid;">Overhead Expense</td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><b><?php if(!empty($product_other_cost[0]['overhead_expense'])) echo $product_other_cost[0]['overhead_expense'];  ?></b></td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;"><b><?php if(!empty($product_other_cost[0]['overhead_expense'])) echo round(($product_other_cost[0]['overhead_expense']/35.31),2);  ?></b></td>
                          </tr>
                          <tr>
                              <td colspan="5" style="text-align: left;border-left:1px solid;border-top:1px solid;">Sales Commission</td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><b><?php if(!empty($product_other_cost[0]['sales_commission'])) echo $product_other_cost[0]['sales_commission'];  ?></b></td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;"><b><?php if(!empty($product_other_cost[0]['sales_commission'])) echo round(($product_other_cost[0]['sales_commission']/35.31),2);  ?></b></td>
                          </tr>
                           <tr>
                              <td colspan="5" style="text-align: left;border-left:1px solid;border-top:1px solid;">FOH</td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><b><?php if(!empty($product_other_cost[0]['foh'])) echo $product_other_cost[0]['foh'];  ?></b></td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;"><b><?php if(!empty($product_other_cost[0]['foh'])) echo round(($product_other_cost[0]['foh']/35.31),2);  ?></b></td>
                          </tr>
                           <tr>
                              <td colspan="5" style="text-align: left;border-left:1px solid;border-top:1px solid;">AOH</td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><b><?php if(!empty($product_other_cost[0]['aoh'])) echo $product_other_cost[0]['aoh'];  ?></b></td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;"><b><?php if(!empty($product_other_cost[0]['transport_cost'])) echo round(($product_other_cost[0]['transport_cost']/35.31),2);  ?></b></td>
                          </tr>
                           <tr>
                              <td colspan="5" style="text-align: left;border-left:1px solid;border-top:1px solid;">SOH</td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><b><?php if(!empty($product_other_cost[0]['soh'])) echo $product_other_cost[0]['soh'];  ?></b></td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;"><b><?php if(!empty($product_other_cost[0]['soh'])) echo round(($product_other_cost[0]['soh']/35.31),2);  ?></b></td>
                          </tr>
                           <tr>
                              <td colspan="5" style="text-align: left;border-left:1px solid;border-top:1px solid;">Fin. Exp</td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><b><?php if(!empty($product_other_cost[0]['final_expense'])) echo $product_other_cost[0]['final_expense'];  ?></b></td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;"><b><?php if(!empty($product_other_cost[0]['final_expense'])) echo round(($product_other_cost[0]['final_expense']/35.31),2);  ?></b></td>
                              
                          </tr>
                          <tr>
                              <td colspan="5" style="text-align: left;border-left:1px solid;border-top:1px solid;">VAT</td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><b><?php if(!empty($product_other_cost[0]['vat'])) echo $product_other_cost[0]['vat'];  ?></b></td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;"><b><?php if(!empty($product_other_cost[0]['vat'])) echo round(($product_other_cost[0]['vat']/35.31),2);  ?></b></td>
                          </tr>
                           <tr>
                              <td colspan="5" style="text-align: left;border-left:1px solid;border-top:1px solid;">AIT</td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><b><?php if(!empty($product_other_cost[0]['ait'])) echo $product_other_cost[0]['ait'];  ?></b></td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;"><b><?php if(!empty($product_other_cost[0]['ait'])) echo round(($product_other_cost[0]['ait']/35.31),2);  ?></b></td>
                             
                          </tr>
                          
                          <tr>
                              <td colspan="5" style="text-align: left;border-left:1px solid;border-top:1px solid;">Profit</td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;"><b><?php if(!empty($product_other_cost[0]['profit_amount'])) echo $product_other_cost[0]['profit_amount'];  ?></b></td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;"><b><?php if(!empty($product_other_cost[0]['profit_amount'])) echo round(($product_other_cost[0]['profit_amount']/35.31),2);  ?></b></td>
                              
                          </tr>
                          <tr>
                              <td colspan="5" style="text-align: left;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Selling Price</td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php if(!empty($product_quote_price[0]['quote_price'])) echo $product_quote_price[0]['quote_price'];  ?></b></td>
                              <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"><b><?php echo $cell_value_in_cft;  ?></b></td>
                             
                          </tr>
                          
                         <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                           <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                           <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                           <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                           <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                           <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                           <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                           <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                           <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                           <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                          
                              
                          
                          <tr>
                              <td colspan="2" style="text-align: left;">GM(RMC)</td>
                              <td colspan="2" style="text-align: left;">GM(Accounts)</td>
                              <td colspan="3" style="text-align: right;">Managing Director</td>
                             
                          </tr>
                      </tfoot>
                  </table>
              
                
            </form>
        </div>

    
                    