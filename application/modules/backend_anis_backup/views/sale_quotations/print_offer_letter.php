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
    <p style=" text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 30px;margin-bottom: 4px;">OFFER LETTER</p>
    
    <p style="width:50%;float:left"><b>Ref:&nbsp;<?php echo $quotation_info[0]['reference_no']; ?></b></p>
    <p style="float:right;width:50%;text-align: right;"><b>Date:&nbsp;<?php echo date("d-m-Y"); ?></b></p>
     <div style="float: left;width: 60%;">
         To<br>
Managing Director<br>
<?php echo $quotation_info[0]['c_name']; ?><br>
<?php echo $quotation_info[0]['c_contact_address']; ?><br>
<br>
<b>Attention: <?php echo $quotation_info[0]['attention']; ?></b><br><br>
<b>Subject: Offer Letter for <?php echo $quotation_info[0]['category_name']; ?></b><br><br>

  
    </div>
    
    <div style="float: right;width: 38%;border:1px solid;">
        
        <h3 style="background:#eee; border-bottom: 1px solid;text-align: center;margin: 0;">PROJECT INFORMATION</h3>
        <table class="table table-bordered table-hover table-striped" style="width:100%">
            
            <tr>
                <td style="width:30%;"><b>Name</b></td>
                <td>: <b><?php echo $quotation_info[0]['project_name']; ?></b></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Address</b> </td>
                <td>: <?php echo $quotation_info[0]['shipping_address']; ?></td>
            </tr>
            <tr>
                <td style="width:50%;"><b>Contact Person</b></td>
                <td>: <?php echo $quotation_info[0]['contact_person']; ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Contact Number</b></td>
                <td>: <?php echo $quotation_info[0]['contact_no']; ?></td>
            </tr>
            
        </table>  
    </div>
    
    
    
    <div style="clear: both;"></div>
    
 Dear Sir,<br>
 We are very much pleased to submit our best offer for RM which are detailed below: 
 <br>
 <br>
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
                           foreach($quotation_details_info as $quotation_detail){ 
                                 $i++;
                            ?>
                <tr>
                   <td> 
                        <?php echo $quotation_detail['product_name']; ?>
                   </td>
                   <td>
                        <?php if(!empty($quotation_detail['performance'])) echo $quotation_detail['performance']; ?>
                   </td>
                   <td>
                        <?php if(!empty($quotation_detail['mu_name'])) echo $quotation_detail['mu_name']; ?>
                   </td>
                   
                  
                 
                   <td style="text-align:right;">
                        <?php if(!empty($quotation_detail['quantity'])) echo $quotation_detail['quantity']; ?>
                   </td>
                   
                   <td style="text-align:right;">
                        <?php if(!empty($quotation_detail['unit_price'])) echo $quotation_detail['unit_price']; ?>
                   </td>
                   
                   <td style="text-align:right;">
                        <?php if(!empty($quotation_detail['amount'])) echo $quotation_detail['amount']; ?>
                   </td>
                   
                   <td style="text-align:right;">
                        <?php if(!empty($quotation_detail['remark'])) echo $quotation_detail['remark']; ?>
                   </td>
                   
                        
                 </tr>
          <?php } ?>
                <tr>
                    <td colspan="5" style="text-align:right">TOTAL: </td>
                    <td style="text-align:right;"><?php if(!empty($quotation_info[0]['total_amount'])) echo $quotation_info[0]['total_amount']; ?></td>
                    <td></td>
                        
                 </tr>
                <tr>
                    <td colspan="7" style="text-align:right">
                        <b>Taka In Words=&nbsp;<?php $taka_in_word=convert_number_to_words($quotation_info[0]['total_amount']); echo ucwords($taka_in_word);  ?>&nbsp;Only </b> 
                    </td>
                    
                   
                        
                 </tr>
                     
           </table>
    <div style="clear: both;"></div>
    
    <table class="table table-bordered table-hover table-striped" border="1" style="width:100%;text-align: center;margin-bottom: 20px;">
        <tr>
            <th style="width:50%;"><b>Specification of Raw Materials</b></th>
            <th style="width:50%;"><b>Special Note</b></tt>
        </tr>
        <tr>
            <td style="width:50%;">
                <table>
                   
              <?php foreach($raw_material_specification as $raw_material){ ?>
                    <tr>
                      <td style="width:50%;"><?php echo $raw_material['material_name']  ?></td>
                      <td>:&nbsp;<?php echo $raw_material['m_description']  ?></td>
                    </tr>
             <?php } ?>
            
            </table>
            </td>
            <td style="width:50%;"><?php if(!empty($quotation_info[0]['special_note'])) echo $quotation_info[0]['special_note']; ?></td>
        </tr>
    </table>
      <?php 
             if(!empty($payment_info)){
                $advance=$payment_info[0]['b_cash_percent']+$payment_info[0]['b_bg_percent']+$payment_info[0]['b_pdc_percent']+$payment_info[0]['b_lc_percent'];
                $due=$payment_info[0]['a_cash_percent']+$payment_info[0]['a_bg_percent']+$payment_info[0]['a_pdc_percent']+$payment_info[0]['a_lc_percent'];
             }else{
                 $advance='';
                 $due='';
             }
   ?> 
    
    
    
    
    <b style="margin-top:20px;text-decoration: underline;">Mode of Payment</b><br>
    <?php if(!empty($advance) && !empty($due)){ ?>
              a. Along with work order 
                     <?php if(!empty($advance)) echo $advance.'% in advance through '; ?>
                     <?php if(!empty($payment_info[0]['b_cash_percent'])) echo $payment_info[0]['b_cash']." Taka ".$payment_info[0]['b_cash_amount'].';'; ?>
                     <?php if(!empty($payment_info[0]['b_bg_percent'])) echo strtoupper($payment_info[0]['b_bg'])." Taka ".$payment_info[0]['b_bg_amount'].';'; ?>
                     <?php if(!empty($payment_info[0]['b_lc_percent'])) echo strtoupper($payment_info[0]['b_lc'])." Taka ".$payment_info[0]['b_lc_amount'].';'; ?> 
                     <?php if(!empty($payment_info[0]['b_pdc_percent'])) echo 'Cheque'." Taka ".$payment_info[0]['b_pdc_amount'].';'; ?> 
              <br/>
              <?php if(!empty($due)) echo 'b. After Delivery  '.$due.'% through'; ?>
              <?php if(!empty($payment_info[0]['a_cash_percent'])) echo $payment_info[0]['a_cash']." Taka ".$payment_info[0]['a_cash_amount'].';'; ?>
              <?php if(!empty($payment_info[0]['a_bg_percent'])) echo strtoupper($payment_info[0]['a_bg'])." Taka ".$payment_info[0]['a_bg_amount'].';'; ?>
              <?php if(!empty($payment_info[0]['a_lc_percent'])) echo strtoupper($payment_info[0]['a_lc'])." Taka ".$payment_info[0]['a_lc_amount'].';'; ?> 
              <?php if(!empty($payment_info[0]['a_pdc_percent'])) echo 'Cheque'." Taka ".$payment_info[0]['a_pdc_amount'].';'; ?> 
              favoring <b>"Karim Asphalt & Ready Mix Ltd."</b> 
              <br>
              
              <?php }else if(!empty($advance)){ ?>
                      a. Along with work order 
                     <?php if(!empty($advance)) echo $advance.'% in advance through '; ?>
                     <?php if(!empty($payment_info[0]['b_cash_percent'])) echo $payment_info[0]['b_cash']." Taka ".$payment_info[0]['b_cash_amount'].';'; ?>
                     <?php if(!empty($payment_info[0]['b_bg_percent'])) echo strtoupper($payment_info[0]['b_bg'])." Taka ".$payment_info[0]['b_bg_amount'].';'; ?>
                     <?php if(!empty($payment_info[0]['b_lc_percent'])) echo strtoupper($payment_info[0]['b_lc'])." Taka ".$payment_info[0]['b_lc_amount'].';'; ?> 
                     <?php if(!empty($payment_info[0]['b_pdc_percent'])) echo 'Cheque'." Taka ".$payment_info[0]['b_pdc_amount'].';'; ?> 
                      favoring <b>"Karim Asphalt & Ready Mix Ltd."</b> <br><br>
              <?php }else if(!empty($due)){ ?>
                        <?php if(!empty($due)) echo 'a. After Delivery  '.$due.'% through'; ?>
                        <?php if(!empty($payment_info[0]['a_cash_percent'])) echo $payment_info[0]['a_cash']." Taka ".$payment_info[0]['a_cash_amount'].';'; ?>
                        <?php if(!empty($payment_info[0]['a_bg_percent'])) echo strtoupper($payment_info[0]['a_bg'])." Taka ".$payment_info[0]['a_bg_amount'].';'; ?>
                        <?php if(!empty($payment_info[0]['a_lc_percent'])) echo strtoupper($payment_info[0]['a_lc'])." Taka ".$payment_info[0]['a_lc_amount'].';'; ?> 
                        <?php if(!empty($payment_info[0]['a_pdc_percent'])) echo 'Cheque'." Taka ".$payment_info[0]['a_pdc_amount'].';'; ?> 
                      favoring <b>"Karim Asphalt & Ready Mix Ltd."</b> <br><br>
              <?php } ?>
<?php if($quotation_info[0]['bank_show']=="Yes"){ ?>                     
        <b style="margin-top:20px;text-decoration: underline;">Bank Info</b><br> 
        <table>

            <tr>
                <td><b>Bank Name</b> : <?php echo $quotation_info[0]['b_name'];  ?></td>
                <td><b>Branch</b> : <?php echo $quotation_info[0]['branch_name'];  ?></td>
            </tr>
            <tr>
                <td><b>Account No</b>:&nbsp;<?php echo $quotation_info[0]['b_account_no']  ?></td>
                <td><b>Routing</b>:&nbsp;<?php echo $quotation_info[0]['b_rounting_no']  ?></td>
            </tr>
        </table>
<?php } ?>        
<br>
 Thanking with best regards.<br> <br><br><br><br><br>
 <span style="border-top:1px solid;"><?php if(!empty($quotation_info[0]['name'])) echo $quotation_info[0]['name']; ?> <br>
     </span>
 <?php if(!empty($quotation_info[0]['designation_name'])) echo $quotation_info[0]['designation_name']; ?><br>
Cell :  <?php if(!empty($quotation_info[0]['mobile'])) echo $quotation_info[0]['mobile']; ?>
</div>

 