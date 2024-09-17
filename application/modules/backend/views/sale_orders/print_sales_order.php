<style>
     @page {
        size: auto;   /* auto is the initial value */
        margin-top: 20px;  /* this affects the margin in the printer settings */
        margin-bottom: 0;
    }
    #content-table{
        line-height: 18px !important;
    }
    table{
  border-collapse: collapse;
  
}
table tr th{
    background: #eee;
}
table tr td, table tr th{
    padding: 1px 5px;
    vertical-align: initial;
}
    
</style>




<!--<div style="padding:50px; width:60%; margin: 0 auto">-->
<div>
   
           
    <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;"><img style="width: 120px;margin-top: -12px;position: absolute;margin-left: -140px;" src="<?php echo site_url('images/kmix.jpg')?>"> <span>KARIM ASPHALT & READY MIX LTD.</span> </h2>
    <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">(A Unit Of Karim Group)</p>
    <hr>
    <p style=" text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 30px;margin-bottom: 4px;">Sales order</p>
    
    <p style="width:70%;float:left">
        <?php if(!empty($sale_order_info[0]['reference_no'])){ ?>
        <b>Q. No.: <?php echo !empty($sale_order_info[0]['reference_no']) ? ucfirst($sale_order_info[0]['reference_no']) : 'None'; ?></b><br><br>
        <?php } ?>
    S.O. No.: <?php if(!empty($sale_order_info[0]['c_order_no'])) echo ucfirst($sale_order_info[0]['c_order_no']);else echo ucfirst($sale_order_info[0]['order_no']);  ?><br>
Date: <?php  echo date('d-m-Y',strtotime($sale_order_info[0]['sale_order_date'])); ?>
    </p>
     <div style="float:right;width:30%;">
                 <?php if(!empty($sale_order_info[0]['quotation_date'])){ ?>
         <b style="position: absolute;right: 13px;">Date: <?php  echo !empty($sale_order_info[0]['quotation_date']) ? date('d-m-Y',strtotime($sale_order_info[0]['quotation_date'])) : ''; ?></b><br><br>
                 <?php } ?>
     <div style="border:1px solid;padding: 10px">
         <b>Delivery Date : <?php if(!empty($sale_order_info[0]['delivery_date']))  echo date('d-m-Y',strtotime($sale_order_info[0]['delivery_date'])); ?></b><br>
         <b>Delivery Time : <?php if(!empty($sale_order_info[0]['delivery_time'])) echo $sale_order_info[0]['delivery_time']; ?></b>
     </div>
     </div>
     <div style="clear: both;"></div>
     <div style="float: left;width: 48%;border:1px solid;">
       
        <h3 style="background:#eee; border-bottom: 1px solid;text-align: center;margin: 0;">CUSTOMER INFORMATION</h3>
        <table class="table table-bordered table-hover table-striped" style="width:100%">
            
            <tr>
                <td style="width:40%;"><b>Name</b></td>
                <td>: <b><?php echo ucfirst($sale_order_info[0]['c_name']); ?></b></td>
            </tr>
            <tr>
                <td style="width:40%;"><b>Address</b> </td>
                <td>: <?php echo ucfirst($sale_order_info[0]['billing_address']); ?></td>
            </tr>
            <tr>
                <td style="width:40%;"><b>Contact Person</b></td>
                <td>: <?php if(!empty($sale_order_info[0]['attention'])) echo ucfirst($sale_order_info[0]['attention']); ?></td>
            </tr>
            <tr>
                <td style="width:40%;"><b>Contact Number</b></td>
                <td>: <?php if(!empty($sale_order_info[0]['phone'])) echo $sale_order_info[0]['phone']; ?></td>
            </tr>
            
        </table>  
    </div>
    
    <div style="float: right;width: 48%;border:1px solid; margin-bottom: 100px;">
        
        <h3 style="background:#eee; border-bottom: 1px solid;text-align: center;margin: 0;">PROJECT INFORMATION</h3>
        <table class="table table-bordered table-hover table-striped" style="width:100%">
            
            <tr>
                <td style="width:40%;"><b>Name</b></td>
                <td>: <b><?php  echo $sale_order_info[0]['project_name']; ?></b></td>
            </tr>
            <tr>
                <td style="width:40%;"><b>Address</b> </td>
                <td>: <?php  echo $sale_order_info[0]['shipping_address']; ?></td>
            </tr>
            <tr>
                <td style="width:40%;"><b>Contact Person</b></td>
                <td>: <?php echo ucfirst($sale_order_info[0]['contact_person']); ?></td>
            </tr>
            <tr>
                <td style="width:40%;"><b>Contact Number</b></td>
                <td>: <?php  echo $sale_order_info[0]['contact_no']; ?></td>
            </tr>
            
        </table>  
    </div>
     
     <table class="table table-bordered table-hover table-striped" border="1" style="width:100%;text-align: center;margin-bottom: 20px;">
           
           
         
          
          
           
               <tr>
                       
                    <th>PRODUCT NAME</th>
                    <th>PERFORMANCE</th>
                    <th>MU</th>
                    <th >QUANTITY</th>
                    <th >RATE</th>
                    <th>VALUE (BDT)</th>
                    <th>Supply Mode</th>
                        
                        
                        
                        
                   
                </tr>
              <?php 
                           $i=0;
                           $total_value=0;
                           foreach($sale_order_details_info as $sale_order_details){ 
                                 $total_value=$total_value+$sale_order_details['amount'];
                                 $i++;
                            ?>
                <tr>
                   <td> 
                        <?php echo $sale_order_details['product_name']; ?>
                   </td>
                   <td>
                        <?php if(!empty($sale_order_details['performance'])) echo $sale_order_details['performance']; ?>
                   </td>
                   <td>
                        <?php if(!empty($sale_order_details['measurement_unit'])) echo $sale_order_details['measurement_unit']; ?>
                   </td>
                 
                   <td style="text-align:right;">
                        <?php if(!empty($sale_order_details['quantity'])) echo $sale_order_details['quantity']; ?>
                   </td>
                   
                   <td style="text-align:right;">
                        <?php if(!empty($sale_order_details['unit_price'])) echo $sale_order_details['unit_price']; ?>
                   </td>
                   
                   <td style="text-align:right;">
                        <?php if(!empty($sale_order_details['amount'])) echo $sale_order_details['amount']; ?>
                   </td>
                   
                   <td style="text-align:right;">
                        <?php if(!empty($sale_order_details['remark'])) echo $sale_order_details['remark']; ?>
                   </td>
                   
                        
                 </tr>
          <?php } ?>
                <tr>
                     <td colspan="5" style="text-align:right">TOTAL: </td>
                    <td style="text-align:right;"><?php 
                    $total_value +=$sale_order_info[0]['pump'];
                    if(!empty($sale_order_info[0]['pump'])) echo number_format($sale_order_info[0]['pump'],2);  ?></td>
                    <td></td>
                   
                        
                 </tr>
                <tr>
                     <td colspan="5" style="text-align:right">TOTAL: </td>
                    <td style="text-align:right;"><?php if(!empty($total_value)) echo number_format($total_value,2); ?></td>
                    <td></td>
                   
                        
                 </tr>
                <tr>
                    <td colspan="7" style="text-align:right">
                        <b>Taka In Words=&nbsp;<?php $taka_in_word=convert_number_to_words($total_value); echo ucwords($taka_in_word);  ?>&nbsp;Only </b> 
                    </td>
                    
                   
                        
                 </tr>
                        
           </table>
    
    
    <div style="clear: both;"></div>
    <?php 
             if(!empty($payment_mode)){
                $advance=$payment_mode[0]['b_cash_percent']+$payment_mode[0]['b_bg_percent']+$payment_mode[0]['b_pdc_percent']+$payment_mode[0]['b_lc_percent'];
                $due=$payment_mode[0]['a_cash_percent']+$payment_mode[0]['a_bg_percent']+$payment_mode[0]['a_pdc_percent']+$payment_mode[0]['a_lc_percent'];
             }else{
                 $advance='';
                 $due='';
             }
          ?> 
     <b style="margin-top:20px;text-decoration: underline;">Mode of Payment</b><br>
    <?php if(!empty($advance) && !empty($due)){ ?>
              a. Along with work order 
                     <?php if(!empty($advance)) echo $advance.'% in advance through '; ?>
                     <?php if(!empty($payment_mode[0]['b_cash_percent']) && $payment_mode[0]['b_cash_percent']!='0.00') echo $payment_mode[0]['b_cash']." Taka ".$payment_mode[0]['b_cash_amount'].';'; ?>
                     <?php if(!empty($payment_mode[0]['b_bg_percent']) && $payment_mode[0]['b_bg_percent']!='0.00') echo $payment_mode[0]['b_bg']." Taka ".$payment_mode[0]['b_bg_amount'].';'; ?>
                     <?php if(!empty($payment_mode[0]['b_lc_percent']) && $payment_mode[0]['b_lc_percent']!='0.00') echo $payment_mode[0]['b_lc']." Taka ".$payment_mode[0]['b_lc_amount'].';'; ?> 
                     <?php if(!empty($payment_mode[0]['b_pdc_percent']) && $payment_mode[0]['b_pdc_percent']!='0.00') echo $payment_mode[0]['b_pdc']." Taka ".$payment_mode[0]['b_pdc_amount'].';'; ?> 
              <br/>
              <?php if(!empty($due)) echo 'b. After Delivery  '.$due.'% through'; ?>
              <?php if(!empty($payment_mode[0]['a_cash_percent']) && $payment_mode[0]['a_cash_percent']!='0.00') echo $payment_mode[0]['a_cash']." Taka ".$payment_mode[0]['a_cash_amount'].';'; ?>
              <?php if(!empty($payment_mode[0]['a_bg_percent']) && $payment_mode[0]['a_bg_percent']!='0.00') echo $payment_mode[0]['a_bg']." Taka ".$payment_mode[0]['a_bg_amount'].';'; ?>
              <?php if(!empty($payment_mode[0]['a_lc_percent']) && $payment_mode[0]['a_lc_percent']!='0.00') echo $payment_mode[0]['a_lc'].$payment_mode[0]['a_lc_percent']." Taka ".$payment_mode[0]['a_lc_amount'].';'; ?> 
              <?php if(!empty($payment_mode[0]['a_pdc_percent']) && $payment_mode[0]['a_pdc_percent']!='0.00') echo $payment_mode[0]['a_pdc']." Taka ".$payment_mode[0]['a_pdc_amount'].';'; ?> 
              favoring of <b>"Karim Asphalt & Ready Mix Ltd."</b> 
              <br><br>  
              <?php }else if(!empty($advance)){ ?>
                      a. Along with work order 
                     <?php if(!empty($advance)) echo $advance.'% in advance through '; ?>
                     <?php if(!empty($payment_mode[0]['b_cash_percent']) && $payment_mode[0]['b_cash_percent']!='0.00') echo $payment_mode[0]['b_cash']." Taka ".$payment_mode[0]['b_cash_amount'].';'; ?>
                     <?php if(!empty($payment_mode[0]['b_bg_percent']) && $payment_mode[0]['b_bg_percent']!='0.00') echo $payment_mode[0]['b_bg']." Taka ".$payment_mode[0]['b_bg_amount'].';'; ?>
                     <?php if(!empty($payment_mode[0]['b_lc_percent']) && $payment_mode[0]['b_lc_percent']!='0.00') echo $payment_mode[0]['b_lc']." Taka ".$payment_mode[0]['b_lc_amount'].';'; ?> 
                     <?php if(!empty($payment_mode[0]['b_pdc_percent']) && $payment_mode[0]['b_pdc_percent']!='0.00') echo $payment_mode[0]['b_pdc']." Taka ".$payment_mode[0]['b_pdc_amount'].';'; ?> 
                      <br><br>  
              <?php }else if(!empty($due)){ ?>
                        <?php if(!empty($due)) echo 'a. After Delivery  '.$due.'% through'; ?>
                        <?php if(!empty($payment_mode[0]['a_cash_percent']) && $payment_mode[0]['a_cash_percent']!='0.00') echo $payment_mode[0]['a_cash']." Taka ".$payment_mode[0]['a_cash_amount'].';'; ?>
                        <?php if(!empty($payment_mode[0]['a_bg_percent']) && $payment_mode[0]['a_bg_percent']!='0.00') echo $payment_mode[0]['a_bg']." Taka ".$payment_mode[0]['a_bg_amount'].';'; ?>
                        <?php if(!empty($payment_mode[0]['a_lc_percent']) && $payment_mode[0]['a_lc_percent']!='0.00') echo $payment_mode[0]['a_lc']." Taka ".$payment_mode[0]['a_lc_amount'].';'; ?> 
                        <?php if(!empty($payment_mode[0]['a_pdc_percent']) && $payment_mode[0]['a_pdc_percent']!='0.00') echo $payment_mode[0]['a_pdc']." Taka ".$payment_mode[0]['a_pdc_amount'].';'; ?> 
                        favoring of <b>"Karim Asphalt & Ready Mix Ltd."</b> <br><br>  
              <?php } ?>
    <div style="clear: both;"></div>
    <div style="position: fixed;bottom: 30px;text-align: center;width:100%">
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
       <tr>
           <td style="width:20%;font-size:15px;"><span style="border-top:1px solid;">PREPARED BY</span></td>
           
           <td style="width:20%;text-align: center;"><span style="border-top:1px solid;"></span></td>
           
           <td  style="width:10%;text-align: right;"><span style="border-top:1px solid;">VETTED BY</span></td></tr>
    </table>
        
         
    </div>
    <div style="clear: both;"></div>
   
    
</div>

 