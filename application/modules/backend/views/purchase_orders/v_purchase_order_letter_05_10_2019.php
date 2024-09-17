<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    
    <div class="right_content" style="margin-top:60px;margin-bottom:50px;">
        <div style="text-align: right">
                    <a href="<?php echo site_url('backend/purchase_orders/purchase_order_letter/'.$purchase_order_info[0]['o_id'].'/print') ?>" > <button type="button" class="btn btn-success button">Print</button> </a>

        </div>
            <h2 style="text-align: center;">WAHID CONSTRUCTION LTD </h2>

            <table class="table" id="">
                <tr>
                   <td style="width:270px;border-top:0px;padding:0px;">Memo No.:&nbsp;<?php echo $purchase_order_info[0]['order_no']; ?></td>
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
                        <td style="border-top:0px;padding:0px;"></td>
                    </tr>
                     <tr>
                        <td style="width:200px;border-top:0px;padding:0px;">General Manager</td>
                        <td style="border-top:0px;padding:0px;"></td>
                    </tr>
                    <tr>
                        <td style="width:200px;border-top:0px;padding:0px;">Marketing & Sales</td>
                        <td style="border-top:0px;padding:0px;"></td>
                    </tr>
                    <tr>
                        <td style="width:200px;border-top:0px;padding:0px;"><?php echo $quotation_info[0]['SUP_NAME']; ?></td>
                        <td style="border-top:0px;padding:0px;"></td>
                    </tr>
                    <tr>
                        <td style="width:200px;border-top:0px;padding:0px;"><?php echo $quotation_info[0]['ADDRESS']; ?></td>
                        <td style="border-top:0px;padding:0px;"></td>
                    </tr>
                   <tr>
                        <td style="width:200px;border-top:0px;padding:0px;"></td>
                        <td style="border-top:0px;padding:0px;"></td>
                    </tr>
                </table>       



            

            <p style="margin-bottom:0px;margin-top:5px;"><b>Sub:&nbsp;Purchase order for <?php echo $purchase_order_info[0]['dep_description']; ?> project</b></p>

            <br/>
            <p style="margin-top:0px;">As per your submitted offer dated <?php echo date('d-m-Y',strtotime($quotation_info[0]['quotation_date'])); ?> and subsequent discussion with you,we are pleased to place the Purchase Order of the following item as per terms and conditions below: </p>
            <div >

                    <table class="table table-bordered" id="myTable" style="display:<?php if($order_type_info[0]['type_name']!="Material") echo 'none'; ?>">
                        <thead>
                         <tr >

                             <th>Item </th> 
                             
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
                               foreach($purchase_order_details_info as $purchase_order_details){ 
                                     $i++;
                                ?>
                                    <tr>

                                        <td>
                                            <?php echo $purchase_order_details['item_name']; ?>
                                        </td> 

                                        
                                         <td>
                                            <?php if(!empty($purchase_order_details['meas_unit'])) echo $purchase_order_details['meas_unit']; ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php if(!empty($purchase_order_details['quantity'])) echo $purchase_order_details['quantity']; ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php if(!empty($purchase_order_details['unit_price'])) echo $purchase_order_details['unit_price']; ?>
                                        </td>

                                        <td style="text-align: right;">
                                            <?php if(!empty($purchase_order_details['amount'])) echo $purchase_order_details['amount']; ?>
                                        </td>

                                         <td>
                                            <?php if(!empty($purchase_order_details['remark'])) echo $purchase_order_details['remark']; ?>
                                        </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                           <tfoot>
                                <tr>
                                    <td colspan="4" style="text-align:right;">Total:</td>

                                    <td style="text-align: right;"><?php if(!empty($purchase_order_info[0]['total_amount'])) echo $purchase_order_info[0]['total_amount']; ?></td>
                                </tr>
                            </tfoot>
                      </table>
                   <table class="table table-bordered" id="serviceTable" style="display:<?php if($order_type_info[0]['type_name']!="Service") echo 'none'; ?>">
                        <thead>
                         <tr >

                             <th>Service </th> 
                             <th>Value</th>
                             <th>Remark</th>


                          </tr>
                        </thead>
                        <tbody id="quotation_item">
                            <?php 
                                $i=0;
                               foreach($purchase_order_details_info as $purchase_order_details){ 
                                     $i++;
                                ?>
                                    <tr>

                                        <td>
                                            <?php echo $purchase_order_details['service_name']; ?>
                                        </td> 

                                        
                                        <td style="text-align: right;">
                                            <?php if(!empty($purchase_order_details['amount'])) echo $purchase_order_details['amount']; ?>
                                        </td>

                                         <td>
                                            <?php if(!empty($purchase_order_details['remark'])) echo $purchase_order_details['remark']; ?>
                                        </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                           <tfoot>
                                <tr>
                                    <td style="text-align:right;">Total:</td>

                                    <td style="text-align: right;"><?php if(!empty($purchase_order_info[0]['total_amount'])) echo $purchase_order_info[0]['total_amount']; ?></td>
                                </tr>
                            </tfoot>
                      </table>

              <!--  <p style="margin-bottom:0px"><b>***Water Proofing Chemical 5.00 TK. will be added per cft***</b></p>-->
               
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
                         <?php if(!empty($payment_info[0]['b_bg_percent'])) echo $payment_info[0]['b_bg'].' '.$payment_info[0]['b_bg_percent']."% Taka ".$payment_info[0]['b_bg_amount'].';'; ?>
                         <?php if(!empty($payment_info[0]['b_lc_percent'])) echo $payment_info[0]['b_lc'].' '.$payment_info[0]['b_lc_percent']."% Taka ".$payment_info[0]['b_lc_amount'].';'; ?> 
                         <?php if(!empty($payment_info[0]['b_pdc_percent'])) echo $payment_info[0]['b_pdc'].' '.$payment_info[0]['b_pdc_percent']."% Taka ".$payment_info[0]['b_pdc_amount'].';'; ?> 
                  <br/>
                  <?php if(!empty($due)) echo 'b. After Delivery  '.$due.'% through'; ?>
                  <?php if(!empty($payment_info[0]['a_cash_percent'])) echo $payment_info[0]['a_cash'].' '.$payment_info[0]['a_cash_percent']."% Taka ".$payment_info[0]['a_cash_amount'].';'; ?>
                  <?php if(!empty($payment_info[0]['a_bg_percent'])) echo $payment_info[0]['a_bg'].' '.$payment_info[0]['a_bg_percent']."% Taka ".$payment_info[0]['a_bg_amount'].';'; ?>
                  <?php if(!empty($payment_info[0]['a_lc_percent'])) echo $payment_info[0]['a_lc'].' '.$payment_info[0]['a_lc_percent']."% Taka ".$payment_info[0]['a_lc_amount'].';'; ?> 
                  <?php if(!empty($payment_info[0]['a_pdc_percent'])) echo $payment_info[0]['a_pdc'].' '.$payment_info[0]['a_pdc_percent']."% Taka ".$payment_info[0]['a_pdc_amount'].';'; ?> 
                  favoring of <b>"<?php echo $quotation_info[0]['SUP_NAME']; ?>"</b> 
                  <?php }else if(!empty($advance)){ ?>
                          a. Along with a work order 
                         <?php if(!empty($advance)) echo $advance.'% in advance through '; ?>
                         <?php if(!empty($payment_info[0]['b_cash_percent'])) echo $payment_info[0]['b_cash'].' '.$payment_info[0]['b_cash_percent']."% Taka ".$payment_info[0]['b_cash_amount'].';'; ?>
                         <?php if(!empty($payment_info[0]['b_bg_percent'])) echo $payment_info[0]['b_bg'].' '.$payment_info[0]['b_bg_percent']."% Taka ".$payment_info[0]['b_bg_amount'].';'; ?>
                         <?php if(!empty($payment_info[0]['b_lc_percent'])) echo $payment_info[0]['b_lc'].' '.$payment_info[0]['b_lc_percent']."% Taka ".$payment_info[0]['b_lc_amount'].';'; ?> 
                         <?php if(!empty($payment_info[0]['b_pdc_percent'])) echo $payment_info[0]['b_pdc'].' '.$payment_info[0]['b_pdc_percent']."% Taka ".$payment_info[0]['b_pdc_amount'].';'; ?> 
                           favoring of <b>"<?php echo $quotation_info[0]['SUP_NAME']; ?>"</b> 
                  <?php }else if(!empty($due)){ ?>
                            <?php if(!empty($due)) echo 'a. After Delivery  '.$due.'% through'; ?>
                            <?php if(!empty($payment_info[0]['a_cash_percent'])) echo $payment_info[0]['a_cash'].' '.$payment_info[0]['a_cash_percent']."% Taka ".$payment_info[0]['a_cash_amount'].';'; ?>
                            <?php if(!empty($payment_info[0]['a_bg_percent'])) echo $payment_info[0]['a_bg'].' '.$payment_info[0]['a_bg_percent']."% Taka ".$payment_info[0]['a_bg_amount'].';'; ?>
                            <?php if(!empty($payment_info[0]['a_lc_percent'])) echo $payment_info[0]['a_lc'].' '.$payment_info[0]['a_lc_percent']."% Taka ".$payment_info[0]['a_lc_amount'].';'; ?> 
                            <?php if(!empty($payment_info[0]['a_pdc_percent'])) echo $payment_info[0]['a_pdc'].' '.$payment_info[0]['a_pdc_percent']."% Taka ".$payment_info[0]['a_pdc_amount'].';'; ?> 
                            favoring of <b>"<?php echo $quotation_info[0]['SUP_NAME']; ?>"</b> 
                  <?php } ?>
              </p>
              
               <table class="table" id="myTable1">


                    
                    <tr>
                        <td colspan="2" style="border-top:0px;padding:0px;">
                            <span style="border-bottom:1px solid;"> <b>Terms & Conditions</b></span>
                        </td>
                    </tr>
                    <?php $i=0; foreach($purchase_conditions as $purchase_condition){ 
                        $i++;
                        ?>
                        <tr>
                            <td style="width:200px;border-top:0px;padding:5px;"><?php echo $i.'. '.$purchase_condition['t_or_c_name']  ?></td>
                            <td style="border-top:0px;padding:0px;">:&nbsp;<?php echo $purchase_condition['t_or_c_description']  ?></td>
                        </tr>
                 <?php } ?>
                </table>   
              
              <br>

              
              <br>
              <br>
              <p style="margin-top:-10px;"><span style="border-top:1px solid #000000;"><b><?php if(!empty($purchase_order_info[0]['name'])) echo $purchase_order_info[0]['name']; ?></b></span></p>
              <p style="margin-top:-10px;"><?php if(!empty($purchase_order_info[0]['designation_name'])) echo $purchase_order_info[0]['designation_name']; ?></p>
              <p style="margin-top:-10px;">Cell : <?php if(!empty($purchase_order_info[0]['mobile'])) echo $purchase_order_info[0]['mobile']; ?></p>
             
              <br/>
              
                <table class="table" id="myTable1">


                    
                    <tr>
                        <td colspan="2" style="border-top:0px;padding:0px;">
                            <span style="border-bottom:1px solid;border-bottom:1px solid #000000;"> <b>Copy to:</b></span>
                        </td>
                    </tr>
                    <?php $j=0; foreach($copy_to as $copy){ 
                        $j++;
                        ?>
                        <tr>
                            <td style="width:200px;border-top:0px;padding:5px;"><?php echo $j.'. '. $copy['copy_description']  ?></td>
                            <td style="border-top:0px;padding:0px;"></td>
                        </tr>
                 <?php } ?>
                </table>   
            </div>





            <div class="row">


                 <div class="col-md-2">
                    <a style="float:left;" href="<?php echo site_url('backend/purchase_orders') ?>" > <button type="button" class="btn btn-success button">REGISTER</button> </a>
                    <a style="float:right;" href="<?php echo site_url('backend/purchase_orders/purchase_order_letter/'.$purchase_order_info[0]['o_id'].'/print') ?>" > <button type="button" class="btn btn-success button">Print</button> </a>

                </div>
            </div> 
    </div>
</div>

<script type="text/javascript">
    
</script>
