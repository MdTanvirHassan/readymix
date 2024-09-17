<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
  <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3 style="float:left;"> Offer Letter</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('backend/sale_quotations/offer_quotation/'.$quotation_info[0]['q_id'].'/print') ?>" class="btn btn-sm btn-warning">PRINT</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">  
    
<!--    <div style="text-align: right">
                <a href="<?php echo site_url('backend/sale_quotations/offer_quotation/'.$quotation_info[0]['q_id'].'/print') ?>" > <button type="button" class="btn btn-success button">Print</button> </a>

    </div>-->
        <h2 style="text-align: center;">Karim Asphalt & Ready Mix Ltd. </h2>
        
        <table class="table" id="">
            <tr>
               <td style="width:200px;border-top:0px;padding:0px;">Ref:&nbsp;<?php echo $quotation_info[0]['reference_no']; ?></td>
               <td style="border-top:0px;padding-left:0px;"></td>
            </tr>
             <tr>
               <td style="width:200px;border-top:0px;padding:0px;">Date:&nbsp;<?php echo date("d-m-Y"); ?></td>
               <td style="border-top:0px;padding-left:0px;"></td>
            </tr> 
            <tr>
                <td style="width:200px;border-top:0px;padding:0px;"></td>
                <td style="border-top:0px;padding-left:0px;"></td>
            </tr>
                 <tr>
                     
                     
                    <td style="width:200px;border-top:0px;padding:0px;">To,</td>
                    <td style="border-top:0px;padding:0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delivery Place:</td>
                </tr>
                 <tr>
                    <td style="width:200px;border-top:0px;padding:0px;">Managing Director</td>
                    <td style="border-top:0px;padding:0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Project Name:&nbsp;<?php echo $quotation_info[0]['project_name']; ?></td>
                </tr>
                <tr>
                    <td style="width:200px;border-top:0px;padding:0px;"><?php echo $quotation_info[0]['c_name']; ?></td>
                    <td style="border-top:0px;padding:0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Address:&nbsp;<?php echo $quotation_info[0]['shipping_address']; ?></td>
                </tr>
                <tr>
                    <td style="width:200px;border-top:0px;padding:0px;"><?php echo $quotation_info[0]['c_contact_address']; ?></td>
                    <td style="border-top:0px;padding:0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact Name:&nbsp;<?php echo $quotation_info[0]['attention']; ?></td>
                </tr>
               <tr>
                    <td style="width:200px;border-top:0px;padding:0px;"></td>
                    <td style="border-top:0px;padding:0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone:&nbsp;<?php echo $quotation_info[0]['phone']; ?></td>
                </tr>
            </table>       
       
        
       
        <p style="margin-bottom:0px;margin-top:-15px;"><b>Attention:</b>&nbsp;<?php echo $quotation_info[0]['attention']; ?></p>
        <br>
        <p style="margin-bottom:0px;margin-top:5px;"><b>Sub:&nbsp;Offer Letter for <?php echo $quotation_info[0]['category_name']; ?></b></p>
      
        <p style="margin-bottom:0px;margin-top:5px;">Dear Sir,</p>
        <p style="margin-top:0px;">We are very much pleased to submit our best offer for <?php echo $quotation_info[0]['short_name']; ?> which are detailed below:</p>
        <div >
           
                <table class="table table-bordered" id="myTable">
                    <thead>
                     <tr >
                        
                         <th>Product </th> 
                         <th>Performance</th>
                         <th>Mu.</th>
                         <th>Qnty</th>
                         <th>Rate</th>
                         <th>Value</th>
                         <th>Remark</th>


                      </tr>
                    </thead>
                    <tbody id="quotation_item">
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
                                        <?php if(!empty($quotation_detail['measurement_unit'])) echo $quotation_detail['measurement_unit']; ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <?php if(!empty($quotation_detail['quantity'])) echo $quotation_detail['quantity']; ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <?php if(!empty($quotation_detail['unit_price'])) echo $quotation_detail['unit_price']; ?>
                                    </td>
                                    
                                    <td style="text-align: right;">
                                        <?php if(!empty($quotation_detail['amount'])) echo $quotation_detail['amount']; ?>
                                    </td>
                                    
                                     <td>
                                        <?php if(!empty($quotation_detail['remark'])) echo $quotation_detail['remark']; ?>
                                    </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                       <tfoot>
                            <tr>
                                <td colspan="5" style="text-align:right;">Total:</td>

                                <td style="text-align: right;"><?php if(!empty($quotation_info[0]['total_amount'])) echo $quotation_info[0]['total_amount']; ?></td>
                            </tr>
                        </tfoot>
                  </table>
           
          <!--  <p style="margin-bottom:0px"><b>***Water Proofing Chemical 5.00 TK. will be added per cft***</b></p>-->
            <table class="table" id="myTable1">
                
                
                <tr>
                    <td style="width:200px;border-top:0px;padding:0px;"><span style="border-bottom:1px solid;"><b>Special Note</b></span></td>
                    <td style="border-top:0px;padding:0px;">:&nbsp;<?php if(!empty($quotation_info[0]['special_note'])) echo $quotation_info[0]['special_note']; ?></td>
                </tr>
                <tr>
                    <td colspan="2" style="border-top:0px;padding:0px;">
                        <span style="border-bottom:1px solid;"> <b>Specification of Raw Materials.</b></span>
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
           
          <p style="margin-top:-10px;"><span style="border-bottom:1px solid;"><b>Mode of Payment</b></span></p>
          <p style="margin-top:-10px;">
             <?php if(!empty($advance) && !empty($due)){ ?>
              a. Along with a work order 
                     <?php if(!empty($advance)) echo $advance.'% in advance through '; ?>
                     <?php if(!empty($payment_info[0]['b_cash_percent'])) echo $payment_info[0]['b_cash'].' '.$payment_info[0]['b_cash_percent']."% Taka ".$payment_info[0]['b_cash_amount'].';'; ?>
                     <?php if(!empty($payment_info[0]['b_bg_percent'])) echo strtoupper($payment_info[0]['b_bg']).' '.$payment_info[0]['b_bg_percent']."% Taka ".$payment_info[0]['b_bg_amount'].';'; ?>
                     <?php if(!empty($payment_info[0]['b_lc_percent'])) echo strtoupper($payment_info[0]['b_lc']).' '.$payment_info[0]['b_lc_percent']."% Taka ".$payment_info[0]['b_lc_amount'].';'; ?> 
                     <?php if(!empty($payment_info[0]['b_pdc_percent'])) echo 'Cheque'.' '.$payment_info[0]['b_pdc_percent']."% Taka ".$payment_info[0]['b_pdc_amount'].';'; ?> 
              <br/>
              <?php if(!empty($due)) echo 'b. After Delivery  '.$due.'% through: '; ?>
              <?php if(!empty($payment_info[0]['a_cash_percent'])) echo $payment_info[0]['a_cash'].' '.$payment_info[0]['a_cash_percent']."% Taka ".$payment_info[0]['a_cash_amount'].';'; ?>
              <?php if(!empty($payment_info[0]['a_bg_percent'])) echo strtoupper($payment_info[0]['a_bg']).' '.$payment_info[0]['a_bg_percent']."% Taka ".$payment_info[0]['a_bg_amount'].';'; ?>
              <?php if(!empty($payment_info[0]['a_lc_percent'])) echo strtoupper($payment_info[0]['a_lc']).' '.$payment_info[0]['a_lc_percent']."% Taka ".$payment_info[0]['a_lc_amount'].';'; ?> 
              <?php if(!empty($payment_info[0]['a_pdc_percent'])) echo 'Cheque'.' '.$payment_info[0]['a_pdc_percent']."% Taka ".$payment_info[0]['a_pdc_amount'].';'; ?> 
              favoring <b>"Karim Asphalt & Ready Mix Ltd."</b> 
              <?php }else if(!empty($advance)){ ?>
                      a. Along with a work order 
                     <?php if(!empty($advance)) echo $advance.'% in advance through: '; ?>
                     <?php if(!empty($payment_info[0]['b_cash_percent'])) echo $payment_info[0]['b_cash'].' '.$payment_info[0]['b_cash_percent']."% Taka ".$payment_info[0]['b_cash_amount'].';'; ?>
                     <?php if(!empty($payment_info[0]['b_bg_percent'])) echo strtoupper($payment_info[0]['b_bg']).' '.$payment_info[0]['b_bg_percent']."% Taka ".$payment_info[0]['b_bg_amount'].';'; ?>
                     <?php if(!empty($payment_info[0]['b_lc_percent'])) echo strtoupper($payment_info[0]['b_lc']).' '.$payment_info[0]['b_lc_percent']."% Taka ".$payment_info[0]['b_lc_amount'].';'; ?> 
                     <?php if(!empty($payment_info[0]['b_pdc_percent'])) echo 'Cheque'.' '.$payment_info[0]['b_pdc_percent']."% Taka ".$payment_info[0]['b_pdc_amount'].';'; ?> 
                       favoring <b>"Karim Asphalt & Ready Mix Ltd."</b>
              <?php }else if(!empty($due)){ ?>
                        <?php if(!empty($due)) echo 'a. After Delivery  '.$due.'% through: '; ?>
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
       
      
        
     
            
        <div class="row"style="margin-top:20px;">
           
            
             <div class="col-md-2">
                <a style="float:left;" href="<?php echo site_url('backend/sale_quotations') ?>" > <button type="button" class="btn btn-success button">GO BACK</button>  </a>
<!--                <a style="float:right;" href="<?php echo site_url('backend/sale_quotations/offer_quotation/'.$quotation_info[0]['q_id'].'/print') ?>" > <button type="button" class="btn btn-success button">Print</button> </a>-->

            </div>
        </div> 
   
</div>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
    
</script>
