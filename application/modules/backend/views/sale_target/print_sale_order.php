<style>
    @page {
        size: auto;   /* auto is the initial value */
        margin-top: 0px;  /* this affects the margin in the printer settings */
        margin-bottom: 0;
    }
    #content-table{
        line-height: 18px !important;
    }
    table tr td, table tr th{
    padding: 1px 5px;
    vertical-align: initial;
}
    
</style>



 
<div style="padding:30" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">KARIM ASPHALT & READY MIX LTD.</h>
    <p style=" text-align: center;margin-top:-3px;">(A Unit of Karim Group)</p>
    <p style=" text-align: center;text-decoration: underline;margin-top:-7px;">SALES ORDER</p>
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
           <tr>
               <td colspan="6" style="text-align:left;font-size:18px;">S.O. No.: <?php echo ucfirst($sale_order_info[0]['order_no']); ?></td>
               <td colspan="2" style="text-align:left;font-size:18px;"><span style="text-decoration: underline;">Project Name:</span> <b><?php  echo $sale_order_info[0]['project_name']; ?></b></td>
           </tr>
           
            <tr>
               <td colspan="6" style="text-align:left;font-size:18px;">Date: <?php  echo date('d-m-Y',strtotime($sale_order_info[0]['sale_order_date'])); ?></td>
               <td colspan="2" style="text-align:left;font-size:18px;"><span style="text-decoration: underline;">Project Address:</span> <?php  echo $sale_order_info[0]['shipping_address']; ?></td>
           </tr>
           
            <tr>
               <td colspan="6" style="text-align:left;font-size:18px;">Q.No.: <?php echo !empty($sale_order_info[0]['reference_no']) ? ucfirst($sale_order_info[0]['reference_no']) : 'None'; ?></td>
               <td colspan="2" style="text-align:left;font-size:18px;">Delivery Date: <?php if(!empty($sale_order_info[0]['delivery_date']))  echo date('d-m-Y',strtotime($sale_order_info[0]['delivery_date'])); ?></td>
           </tr>
           
           <tr>
               <td colspan="6" style="text-align:left;font-size:18px;">Date: <?php  echo !empty($sale_order_info[0]['quotation_date']) ? date('d-m-Y',strtotime($sale_order_info[0]['quotation_date'])) : ''; ?></td>
               <td colspan="2" style="text-align:left;font-size:18px;">Contact No.: <?php  echo $sale_order_info[0]['phone']; ?></td>
           </tr>
           
           <tr>
               <td colspan="6" style="text-align:left;font-size:18px;"><span style="text-decoration: underline;">Customer Name:</span><b> <?php echo ucfirst($sale_order_info[0]['c_name']); ?></b></td>
               <td colspan="2" style="text-align:left;font-size:18px;"></td>
           </tr>
           <tr>
               <td colspan="6" style="text-align:left;font-size:18px;"><span style="text-decoration: underline;">Customer Address:</span> <?php echo ucfirst($sale_order_info[0]['billing_address']); ?></td>
               <td colspan="2" style="text-align:left;font-size:18px;"></td>
           </tr>
           <tr>
               <td colspan="6" style="text-align:left;font-size:18px;">Contact Person: <?php echo ucfirst($sale_order_info[0]['attention']); ?></td>
               <td colspan="2" style="text-align:left;font-size:18px;"></td>
           </tr>
           
          
          
           <tr><td colspan="8"></td></tr>
           <tr><td colspan="8"></td></tr>
               <tr >
                        
                         <th style="text-align:center;border-left:1px solid;border-top:1px solid;width:150px;" rowspan="2">Product </th>            
                         <th style="text-align:center;border-left:1px solid;border-top:1px solid;" rowspan="2">Performance</th>
                      <!--   <th style="text-align:center;border-left:1px solid;border-top:1px solid;">MU.</th>-->
                         <th style="text-align:center;border-left:1px solid;border-top:1px solid;" colspan="2">Qnty</th>
                         <th style="text-align:center;border-left:1px solid;border-top:1px solid;" colspan="2">Rate</th>
                         <th style="text-align:center;border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">Value(BDT)</th>
                         <th style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;width:200px;" rowspan="2">Remark</th>


                      </tr>
                      <tr>
                            <th style="border-left:1px solid;border-top:1px solid;" >CFT</th>
                            <th style="border-left:1px solid;border-top:1px solid;" >CUM</th>
                            <th style="border-left:1px solid;border-top:1px solid;" >CFT</th>
                            <th style="border-left:1px solid;border-top:1px solid;" >CUM</th>
                           
                      </tr>
                <?php $count=count($sale_order_details_info); $total_value=0; ?>
               <?php $i=0; foreach($sale_order_details_info as $sale_order_details){ $i++;
                        $total_value=$total_value+$sale_order_details['amount'];
                     ?>
                    
                           <tr id="row_1">
                            
                                <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($sale_order_details['product_name'])) echo $sale_order_details['product_name'];  ?></td>
                                <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($sale_order_details['performance'])) echo $sale_order_details['performance'];  ?></td>
                                <td style="text-align: right;border-left:1px solid;border-top:1px solid;">
                                    <?php if(!empty($sale_order_details['quantity'])) echo $sale_order_details['quantity']; ?>
                                </td>
                                 <td style="text-align: right;border-left:1px solid;border-top:1px solid;">
                                    <?php if(!empty($sale_order_details['quantity'])) echo round(($sale_order_details['quantity']/35.31),2); ?>
                                </td>
                                <td style="text-align: right;border-left:1px solid;border-top:1px solid;">
                                    <?php if(!empty($sale_order_details['unit_price'])) echo $sale_order_details['unit_price']; ?>
                                </td>

                                <td style="text-align: right;border-left:1px solid;border-top:1px solid;">
                                    <?php if(!empty($sale_order_details['unit_price'])) echo round(($sale_order_details['unit_price']*35.31),2); ?>
                                </td>

                                <td style="text-align: right;border-left:1px solid;border-top:1px solid;">
                                    <?php if(!empty($sale_order_details['amount'])) echo $sale_order_details['amount']; ?>
                                </td>



                                 <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">
                                    <?php if(!empty($sale_order_details['remark'])) echo $sale_order_details['remark']; ?>
                                </td>

                         
                        </tr>  
                  <?php // } ?>      
                               
               <?php } ?>
                        <tr id="row_0">
                            
                            <td colspan="6" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total:</td>
                            
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($sale_order_info[0]['pump'])) echo number_format($sale_order_info[0]['pump'],2);  ?></b></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;text-align:right;"></td>
                        </tr>  
                        <tr id="row_1">
                            
                            <td colspan="6" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total:</td>
                            
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_value)) echo $total_value;  ?></b></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;text-align:right;"></td>
                        </tr>  
                        <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td colspan="8"><b>Taka In Words=&nbsp;&nbsp;<?php $taka_in_word=convert_number_to_words($total_value); echo ucwords($taka_in_word);  ?>&nbsp; Only</b></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                          <?php 
             if(!empty($payment_mode)){
                $advance=$payment_mode[0]['b_cash_percent']+$payment_mode[0]['b_bg_percent']+$payment_mode[0]['b_pdc_percent']+$payment_mode[0]['b_lc_percent'];
                $due=$payment_mode[0]['a_cash_percent']+$payment_mode[0]['a_bg_percent']+$payment_mode[0]['a_pdc_percent']+$payment_mode[0]['a_lc_percent'];
             }else{
                 $advance='';
                 $due='';
             }
          ?> 
                         <tr><td colspan="7">  <p style=""><span style="border-bottom:1px solid;"><b>Mode of Payment</b></span></p>
          <p style="margin-top:-10px;">
               <?php if(!empty($advance) && !empty($due)){ ?>
              a. Along with work order 
                     <?php if(!empty($advance)) echo $advance.'% in advance through '; ?>
                     <?php if(!empty($payment_mode[0]['b_cash_percent'])) echo $payment_mode[0]['b_cash']." Taka ".$payment_mode[0]['b_cash_amount'].';'; ?>
                     <?php if(!empty($payment_mode[0]['b_bg_percent'])) echo $payment_mode[0]['b_bg']." Taka ".$payment_mode[0]['b_bg_amount'].';'; ?>
                     <?php if(!empty($payment_mode[0]['b_lc_percent'])) echo $payment_mode[0]['b_lc']." Taka ".$payment_mode[0]['b_lc_amount'].';'; ?> 
                     <?php if(!empty($payment_mode[0]['b_pdc_percent'])) echo $payment_mode[0]['b_pdc']." Taka ".$payment_mode[0]['b_pdc_amount'].';'; ?> 
              <br/>
              <?php if(!empty($due)) echo 'b. After Delivery  '.$due.'% through'; ?>
              <?php if(!empty($payment_mode[0]['a_cash_percent'])) echo $payment_mode[0]['a_cash']." Taka ".$payment_mode[0]['a_cash_amount'].';'; ?>
              <?php if(!empty($payment_mode[0]['a_bg_percent'])) echo $payment_mode[0]['a_bg']." Taka ".$payment_mode[0]['a_bg_amount'].';'; ?>
              <?php if(!empty($payment_mode[0]['a_lc_percent'])) echo $payment_mode[0]['a_lc'].$payment_mode[0]['a_lc_percent']." Taka ".$payment_mode[0]['a_lc_amount'].';'; ?> 
              <?php if(!empty($payment_mode[0]['a_pdc_percent'])) echo $payment_mode[0]['a_pdc']." Taka ".$payment_mode[0]['a_pdc_amount'].';'; ?> 
              favoring of <b>"Karim Asphalt & Ready Mix Ltd."</b> 
              <?php }else if(!empty($advance)){ ?>
                      a. Along with work order 
                     <?php if(!empty($advance)) echo $advance.'% in advance through '; ?>
                     <?php if(!empty($payment_mode[0]['b_cash_percent'])) echo $payment_mode[0]['b_cash']." Taka ".$payment_mode[0]['b_cash_amount'].';'; ?>
                     <?php if(!empty($payment_mode[0]['b_bg_percent'])) echo $payment_mode[0]['b_bg']." Taka ".$payment_mode[0]['b_bg_amount'].';'; ?>
                     <?php if(!empty($payment_mode[0]['b_lc_percent'])) echo $payment_mode[0]['b_lc']." Taka ".$payment_mode[0]['b_lc_amount'].';'; ?> 
                     <?php if(!empty($payment_mode[0]['b_pdc_percent'])) echo $payment_mode[0]['b_pdc']." Taka ".$payment_mode[0]['b_pdc_amount'].';'; ?> 
              <?php }else if(!empty($due)){ ?>
                        <?php if(!empty($due)) echo 'a. After Delivery  '.$due.'% through'; ?>
                        <?php if(!empty($payment_mode[0]['a_cash_percent'])) echo $payment_mode[0]['a_cash']." Taka ".$payment_mode[0]['a_cash_amount'].';'; ?>
                        <?php if(!empty($payment_mode[0]['a_bg_percent'])) echo $payment_mode[0]['a_bg']." Taka ".$payment_mode[0]['a_bg_amount'].';'; ?>
                        <?php if(!empty($payment_mode[0]['a_lc_percent'])) echo $payment_mode[0]['a_lc']." Taka ".$payment_mode[0]['a_lc_amount'].';'; ?> 
                        <?php if(!empty($payment_mode[0]['a_pdc_percent'])) echo $payment_mode[0]['a_pdc']." Taka ".$payment_mode[0]['a_pdc_amount'].';'; ?> 
                        favoring of <b>"Karim Asphalt & Ready Mix Ltd."</b> 
              <?php } ?>
          </p></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         
                       
              
        </table>
    <div style="position: fixed;bottom: 80px;text-align: center;width: 100%;">
        <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
           <tr><td style="width:190px;font-size:15px;"><span style="border-top:1px solid;">PREPARED BY</span></td><td style="width:30px;"></td><td style="width:200px;text-align: center;"><span style="border-top:1px solid;">CHECKED BY</span></td><td style="width:30px;"></td><td  style="width:200px;text-align: center;"><span style="border-top:1px solid;">AUTHORIZED BY</span></td></tr>
        </table>
    </div>    
    
</div>
<div class="clearfix"></div>
 