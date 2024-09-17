<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin-top: 0px;  /* this affects the margin in the printer settings */
    margin-bottom: 0;
}
</style>
<div>     
<h2 style="text-align: center;">Karim Asphalt & Ready Mix Ltd. </h2>
        <p style="margin-bottom: 0px;">Ref:&nbsp;<?php echo $quotation_info[0]['reference_no']; ?></p>
        <p style="margin-bottom: 5px;margin-top:0px;">Date:&nbsp;<?php echo date("d-m-Y"); ?></p>
                   
       <table class="table" id="">
                
                
                <tr>
                    <td style="border-top:0px;padding:0px;width:68%;">To,</td>
                    
                    <td style="border-top:0px;padding-left:0px;text-align: right;width:25%;" ><span style="border-bottom:1px solid;">Delivery Place:</span></td>
                </tr>
                 <tr>
                    <td style="border-top:0px;padding:0px;width:72%;" >Managing Director</td>
                    <td style="border-top:0px;padding:0px;text-align: right;width:25%;" >Project Name:&nbsp;<?php echo $quotation_info[0]['project_name']; ?></td>
                </tr>
                <tr>
                    <td style="border-top:0px;padding:0px;width:72%;"><?php echo $quotation_info[0]['c_name']; ?></td>
                    <td style="border-top:0px;padding:0px;text-align: right;width:25%;">Address:&nbsp;<?php echo $quotation_info[0]['shipping_address']; ?></td>
                </tr>
                <tr>
                    <td style="border-top:0px;padding:0px;width:72%;"><?php echo $quotation_info[0]['c_contact_address']; ?></td>
                    <td style="border-top:0px;padding:0px;text-align: right;width:25%;">Contact Name:&nbsp;<?php echo $quotation_info[0]['attention']; ?></td>
                </tr>
               <tr>
                    <td style="border-top:0px;padding:0px;width:72%;"></td>
                    <td style="border-top:0px;padding:0px;text-align: right;width:25%;">Phone:&nbsp;<?php echo $quotation_info[0]['phone']; ?></td>
                </tr>
            </table>           
       
        
        
        <p style="margin-bottom:0px;margin-top:5px;"><b>Attention:</b>&nbsp;<?php echo $quotation_info[0]['attention']; ?></p>
        <br>
        <p style="margin-bottom:0px;margin-top:5px;"><b>Sub:&nbsp;Offer Letter for <?php echo $quotation_info[0]['category_name']; ?></b></p>
       
        <p style="margin-bottom:0px">Dear Sir,</p>
        <p style="margin-top:0px;">We are very much pleased to submit our best offer for <?php echo $quotation_info[0]['short_name']; ?> which are detailed below:</p>
        <div >
           
                <table class="table table-bordered" id="myTable">
                    <thead>
                     <tr >
                        
                         <th style="text-align:center;border-left:1px solid;border-top:1px solid;width:150px;">Product </th>            
                         <th style="text-align:center;border-left:1px solid;border-top:1px solid;">Performance</th>
                         <th style="text-align:center;border-left:1px solid;border-top:1px solid;">Mu.</th>
                         <th style="text-align:center;border-left:1px solid;border-top:1px solid;">Qnty</th>
                         <th style="text-align:center;border-left:1px solid;border-top:1px solid;">Rate</th>
                         <th style="text-align:center;border-left:1px solid;border-top:1px solid;width:200px;">Value</th>
                         <th style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;width:200px;">Remark</th>


                      </tr>
                    </thead>
                    <tbody id="quotation_item">
                        <?php 
                            $i=0;
                           foreach($quotation_details_info as $quotation_detail){ 
                                 $i++;
                            ?>
                                <tr>
                                  
                                       
                                        
                                   
                                    <td style="border-left:1px solid;border-top:1px solid;">
                                     <?php echo $quotation_detail['product_name']; ?>
                                    </td> 
                                   
                                    <td style="border-left:1px solid;border-top:1px solid;">
                                        <?php if(!empty($quotation_detail['performance'])) echo $quotation_detail['performance']; ?>
                                    </td>
                                    <td style="border-left:1px solid;border-top:1px solid;">
                                        <?php if(!empty($quotation_detail['measurement_unit'])) echo $quotation_detail['measurement_unit']; ?>
                                    </td>
                                    <td style="text-align: right;border-left:1px solid;border-top:1px solid;">
                                        <?php if(!empty($quotation_detail['quantity'])) echo $quotation_detail['quantity']; ?>
                                    </td>
                                    <td style="text-align: right;border-left:1px solid;border-top:1px solid;">
                                        <?php if(!empty($quotation_detail['unit_price'])) echo $quotation_detail['unit_price']; ?>
                                    </td>

                                    <td style="text-align: right;border-left:1px solid;border-top:1px solid;">
                                        <?php if(!empty($quotation_detail['amount'])) echo $quotation_detail['amount']; ?>
                                    </td>
                                     <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">
                                        <?php if(!empty($quotation_detail['remark'])) echo $quotation_detail['remark']; ?>
                                    </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                       <tfoot>
                            <tr>
                                <td colspan="5" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total:</td>

                                <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($quotation_info[0]['total_amount'])) echo $quotation_info[0]['total_amount']; ?></td>
                                <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"></td>
                            </tr>
                        </tfoot>
                  </table>
           
            
            <table class="table" id="myTable1">
                
                
                <tr>
                    <td style="width:200px;border-top:0px;padding:0px;"><span style="border-bottom:1px solid;"><b>Special Note</b></span></td>
                    <td style="border-top:0px;padding:0px;">:&nbsp;<?php if(!empty($quotation_info[0]['special_note'])) echo $quotation_info[0]['special_note']; ?></td>
                </tr>
                <tr>
                    <td colspan="2" style="border-top:0px;padding:0px;">
                        <span style="border-bottom:1px solid;"><b>Specification of Raw Materials.</b></span>
                    </td>
                </tr>
                <?php foreach($raw_material_specification as $raw_material){ ?>
                    <tr>
                        <td style="width:200px;border-top:0px;padding:0px;"><?php echo $raw_material['material_name']  ?></td>
                        <td style="border-top:0px;padding:0px;">:&nbsp;<?php echo $raw_material['m_description']  ?></td>
                    </tr>
             <?php } ?>
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
          <p style=""><span style="border-bottom:1px solid;"><b>Mode of Payment</b></span></p>
          <p style="margin-top:-10px;">
               <?php if(!empty($advance) && !empty($due)){ ?>
              a. Along with a work order 
                     <?php if(!empty($advance)) echo $advance.'% in advance through '; ?>
                     <?php if(!empty($payment_info[0]['b_cash_percent'])) echo $payment_info[0]['b_cash'].' '.$payment_info[0]['b_cash_percent']."% Taka ".$payment_info[0]['b_cash_amount'].';'; ?>
                     <?php if(!empty($payment_info[0]['b_bg_percent'])) echo strtoupper($payment_info[0]['b_bg']).' '.$payment_info[0]['b_bg_percent']."% Taka ".$payment_info[0]['b_bg_amount'].';'; ?>
                     <?php if(!empty($payment_info[0]['b_lc_percent'])) echo strtoupper($payment_info[0]['b_lc']).' '.$payment_info[0]['b_lc_percent']."% Taka ".$payment_info[0]['b_lc_amount'].';'; ?> 
                     <?php if(!empty($payment_info[0]['b_pdc_percent'])) echo 'Cheque'.' '.$payment_info[0]['b_pdc_percent']."% Taka ".$payment_info[0]['b_pdc_amount'].';'; ?> 
              <br/>
              <?php if(!empty($due)) echo 'b. After Delivery  '.$due.'% through'; ?>
              <?php if(!empty($payment_info[0]['a_cash_percent'])) echo $payment_info[0]['a_cash'].' '.$payment_info[0]['a_cash_percent']."% Taka ".$payment_info[0]['a_cash_amount'].';'; ?>
              <?php if(!empty($payment_info[0]['a_bg_percent'])) echo strtoupper($payment_info[0]['a_bg']).' '.$payment_info[0]['a_bg_percent']."% Taka ".$payment_info[0]['a_bg_amount'].';'; ?>
              <?php if(!empty($payment_info[0]['a_lc_percent'])) echo strtoupper($payment_info[0]['a_lc']).' '.$payment_info[0]['a_lc_percent']."% Taka ".$payment_info[0]['a_lc_amount'].';'; ?> 
              <?php if(!empty($payment_info[0]['a_pdc_percent'])) echo 'Cheque'.' '.$payment_info[0]['a_pdc_percent']."% Taka ".$payment_info[0]['a_pdc_amount'].';'; ?> 
              favoring <b>"Karim Asphalt & Ready Mix Ltd."</b> 
              <?php }else if(!empty($advance)){ ?>
                      a. Along with a work order 
                     <?php if(!empty($advance)) echo $advance.'% in advance through '; ?>
                     <?php if(!empty($payment_info[0]['b_cash_percent'])) echo $payment_info[0]['b_cash'].' '.$payment_info[0]['b_cash_percent']."% Taka ".$payment_info[0]['b_cash_amount'].';'; ?>
                     <?php if(!empty($payment_info[0]['b_bg_percent'])) echo strtoupper($payment_info[0]['b_bg']).' '.$payment_info[0]['b_bg_percent']."% Taka ".$payment_info[0]['b_bg_amount'].';'; ?>
                     <?php if(!empty($payment_info[0]['b_lc_percent'])) echo strtoupper($payment_info[0]['b_lc']).' '.$payment_info[0]['b_lc_percent']."% Taka ".$payment_info[0]['b_lc_amount'].';'; ?> 
                     <?php if(!empty($payment_info[0]['b_pdc_percent'])) echo 'Cheque'.' '.$payment_info[0]['b_pdc_percent']."% Taka ".$payment_info[0]['b_pdc_amount'].';'; ?> 
                      favoring <b>"Karim Asphalt & Ready Mix Ltd."</b> 
              <?php }else if(!empty($due)){ ?>
                        <?php if(!empty($due)) echo 'a. After Delivery  '.$due.'% through'; ?>
                        <?php if(!empty($payment_info[0]['a_cash_percent'])) echo $payment_info[0]['a_cash'].' '.$payment_info[0]['a_cash_percent']."% Taka ".$payment_info[0]['a_cash_amount'].';'; ?>
                        <?php if(!empty($payment_info[0]['a_bg_percent'])) echo strtoupper($payment_info[0]['a_bg']).' '.$payment_info[0]['a_bg_percent']."% Taka ".$payment_info[0]['a_bg_amount'].';'; ?>
                        <?php if(!empty($payment_info[0]['a_lc_percent'])) echo strtoupper($payment_info[0]['a_lc']).' '.$payment_info[0]['a_lc_percent']."% Taka ".$payment_info[0]['a_lc_amount'].';'; ?> 
                        <?php if(!empty($payment_info[0]['a_pdc_percent'])) echo 'Cheque'.' '.$payment_info[0]['a_pdc_percent']."% Taka ".$payment_info[0]['a_pdc_amount'].';'; ?> 
                        favoring <b>"Karim Asphalt & Ready Mix Ltd."</b> 
              <?php } ?>
          </p>
          <br>
       
          <p style="margin-top:-10px;">Thanking with best regards</p>
          <br>
          <br>
          <br>
          <p style="margin-top:-10px;"><span style="border-top:1px solid #000000;"><b><?php if(!empty($quotation_info[0]['name'])) echo $quotation_info[0]['name']; ?></b></span></p>
          <p style="margin-top:-10px;"><?php if(!empty($quotation_info[0]['designation_name'])) echo $quotation_info[0]['designation_name']; ?></p>
          <p style="margin-top:-10px;">Cell : <?php if(!empty($quotation_info[0]['mobile'])) echo $quotation_info[0]['mobile']; ?></p>
        </div>
       
</div>  
        
     
            
        
   


