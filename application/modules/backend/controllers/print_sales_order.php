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
}
    
</style>




<!--<div style="padding:50px; width:60%; margin: 0 auto">-->
<div>
   
           
    <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;"><img style="width: 120px;margin-top: -12px;position: absolute;margin-left: -160px;" src="<?php echo site_url('images/kmix.jpg')?>"> <span>KARIM ASPHALT & READY MIX LTD.</span> </h2>
    <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">(A Unit Of Karim Group)</p>
    <hr>
    <p style=" text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 30px;">Sales order</p>
    
    <p style="width:70%;float:left"><b>Q. No.: <?php echo ucfirst($sale_order_info[0]['reference_no']); ?></b><br><br>
    S.O. No.: <?php echo ucfirst($sale_order_info[0]['order_no']); ?><br>
Date: <?php  echo date('d-m-Y',strtotime($sale_order_info[0]['sale_order_date'])); ?>
    </p>
     <div style="float:right;width:30%;">
         <b style="position: absolute;right: 13px;">Date: <?php  echo date('d-m-Y',strtotime($sale_order_info[0]['quotation_date'])); ?></b><br><br>
     <div style="border:1px solid;padding: 10px">
         <b>Delivery Date : <?php if(!empty($sale_order_info[0]['delivery_date']))  echo date('d-m-Y',strtotime($sale_order_info[0]['delivery_date'])); ?></b><br>
         <b>Delivery Time : </b>
     </div>
     </div>
     <div style="clear: both;"></div>
     <div style="float: left;width: 48%;border:1px solid;">
       
        <h3 style="background:#eee; border-bottom: 1px solid;text-align: center;margin: 0;">CUSTOMER INFORMATION</h3>
        <table class="table table-bordered table-hover table-striped" style="width:100%">
            
            <tr>
                <td style="width:30%;"><b>Name</b></td>
                <td>: <?php echo ucfirst($sale_order_info[0]['c_name']); ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Address</b> </td>
                <td>: <?php echo ucfirst($sale_order_info[0]['billing_address']); ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Contact Person</b></td>
                <td>: <?php if(!empty($sale_order_info[0]['c_contact_person'])) echo ucfirst($sale_order_info[0]['c_contact_person']); ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Contact Number</b></td>
                <td>: <?php if(!empty($sale_order_info[0]['c_mobile_no'])) echo $sale_order_info[0]['c_mobile_no']; ?></td>
            </tr>
            
        </table>  
    </div>
    
    <div style="float: right;width: 48%;border:1px solid; margin-bottom: 30px;">
        
        <h3 style="background:#eee; border-bottom: 1px solid;text-align: center;margin: 0;">PROJECT INFORMATION</h3>
        <table class="table table-bordered table-hover table-striped" style="width:100%">
            
            <tr>
                <td style="width:30%;"><b>Name</b></td>
                <td>: <?php  echo $sale_order_info[0]['project_name']; ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Address</b> </td>
                <td>: <?php  echo $sale_order_info[0]['shipping_address']; ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Contact Person</b></td>
                <td>: <?php echo ucfirst($sale_order_info[0]['contact_person']); ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Contact Number</b></td>
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
                    <th>REMARK</th>
                        
                        
                        
                        
                   
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
                        <?php if(!empty($sale_order_details['mu_name'])) echo $sale_order_details['mu_name']; ?>
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
                    <td style="text-align:right;"><?php if(!empty($total_value)) echo $total_value; ?></td>
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
              <br><br>  
              <?php }else if(!empty($advance)){ ?>
                      a. Along with work order 
                     <?php if(!empty($advance)) echo $advance.'% in advance through '; ?>
                     <?php if(!empty($payment_mode[0]['b_cash_percent'])) echo $payment_mode[0]['b_cash']." Taka ".$payment_mode[0]['b_cash_amount'].';'; ?>
                     <?php if(!empty($payment_mode[0]['b_bg_percent'])) echo $payment_mode[0]['b_bg']." Taka ".$payment_mode[0]['b_bg_amount'].';'; ?>
                     <?php if(!empty($payment_mode[0]['b_lc_percent'])) echo $payment_mode[0]['b_lc']." Taka ".$payment_mode[0]['b_lc_amount'].';'; ?> 
                     <?php if(!empty($payment_mode[0]['b_pdc_percent'])) echo $payment_mode[0]['b_pdc']." Taka ".$payment_mode[0]['b_pdc_amount'].';'; ?> 
                      <br><br>  
              <?php }else if(!empty($due)){ ?>
                        <?php if(!empty($due)) echo 'a. After Delivery  '.$due.'% through'; ?>
                        <?php if(!empty($payment_mode[0]['a_cash_percent'])) echo $payment_mode[0]['a_cash']." Taka ".$payment_mode[0]['a_cash_amount'].';'; ?>
                        <?php if(!empty($payment_mode[0]['a_bg_percent'])) echo $payment_mode[0]['a_bg']." Taka ".$payment_mode[0]['a_bg_amount'].';'; ?>
                        <?php if(!empty($payment_mode[0]['a_lc_percent'])) echo $payment_mode[0]['a_lc']." Taka ".$payment_mode[0]['a_lc_amount'].';'; ?> 
                        <?php if(!empty($payment_mode[0]['a_pdc_percent'])) echo $payment_mode[0]['a_pdc']." Taka ".$payment_mode[0]['a_pdc_amount'].';'; ?> 
                        favoring of <b>"Karim Asphalt & Ready Mix Ltd."</b> <br><br>  
              <?php } ?>
    <div style="clear: both;"></div>
    <div style="position: fixed;bottom: 30px;text-align: center;width:100%">
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
       <tr>
           <td style="width:20%;font-size:15px;"><span style="border-top:1px solid;">PREPARED BY</span></td>
           
           <td style="width:20%;text-align: center;"><span style="border-top:1px solid;">CHECKED BY</span></td>
           
           <td  style="width:20%;text-align: right;"><span style="border-top:1px solid;">STORE IN-CHARGE</span></td></tr>
    </table>
        
         
    </div>
    <div style="clear: both;"></div>
   
    
</div>

 