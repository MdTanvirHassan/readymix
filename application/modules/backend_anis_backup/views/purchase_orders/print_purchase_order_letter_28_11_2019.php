<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin-top: 0px;  /* this affects the margin in the printer settings */
    margin-bottom: 0;
}
</style>
<div class="right_col" style="padding-bottom:20px;">
    
    <div class="right_content" style="margin-top:70px;margin-bottom:50px;margin-left:50px;">
        
       <!--     <h2 style="text-align: center;">WAHID CONSTRUCTION LTD</h2>-->

            <table class="table" id="">
                <tr>
                   <td style="width:270px;border-top:0px;padding:0px;margin-bottom:20px;">Memo No.:&nbsp;<?php echo $purchase_order_info[0]['order_no']; ?></td>
                   <td style="border-top:0px;padding-left:0px;"></td>
                </tr>
                <br/>
                 <tr>
                   <td style="width:200px;border-top:0px;padding:0px;margin-bottom:20px;">Date:&nbsp;<?php echo date("d-m-Y"); ?></td>
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

                    <table class="table table-bordered" id="myTable">
                        <thead>
                         <tr >

                             <th style="text-align:center;border-left:1px solid;border-top:1px solid;width:150px;">Item </th>                             
                             <th style="text-align:center;border-left:1px solid;border-top:1px solid;">Unit</th>
                             <th style="text-align:center;border-left:1px solid;border-top:1px solid;">Qnty</th>
                             <th style="text-align:center;border-left:1px solid;border-top:1px solid;">Rate</th>
                             <th style="text-align:center;border-left:1px solid;border-top:1px solid;width:150px;">Value</th>
                             <th style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;width:200px;">Remark</th>


                          </tr>
                        </thead>
                        <tbody id="quotation_item">
                            <?php 
                                $i=0;
                               foreach($purchase_order_details_info as $purchase_order_details){ 
                                     $i++;
                                ?>
                                    <tr>

                                        <td style="border-left:1px solid;border-top:1px solid;padding:5px;">
                                            <?php echo $purchase_order_details['item_name']; ?>
                                        </td> 

                                        
                                         <td style="border-left:1px solid;border-top:1px solid;padding:5px;">
                                            <?php if(!empty($purchase_order_details['meas_unit'])) echo $purchase_order_details['meas_unit']; ?>
                                        </td>
                                        <td style="border-left:1px solid;border-top:1px solid;text-align: right;">
                                            <?php if(!empty($purchase_order_details['quantity'])) echo $purchase_order_details['quantity']; ?>
                                        </td>
                                        <td style="border-left:1px solid;border-top:1px solid;text-align: right;">
                                            <?php if(!empty($purchase_order_details['unit_price'])) echo number_format($purchase_order_details['unit_price']); ?>
                                        </td>

                                        <td style="border-left:1px solid;border-top:1px solid;text-align: right;">
                                            <?php if(!empty($purchase_order_details['amount'])) echo number_format($purchase_order_details['amount']); ?>
                                        </td>

                                         <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">
                                            <?php if(!empty($purchase_order_details['remark'])) echo $purchase_order_details['remark']; ?>
                                        </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                           <tfoot>
                                <tr>
                                    <td colspan="4" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total:</td>

                                    <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($purchase_order_info[0]['total_amount'])) echo number_format($purchase_order_info[0]['total_amount']); ?></td>
                                     <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"></td>
                                </tr>
                            </tfoot>
                      </table>
<br/>
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

              <p style="margin-top:-10px;"><span style="border-bottom:1px solid;"><b>Payment Condition</b></span></p>
              <p style="margin-top:-10px;">
                  <b>a.Mode Of Payment: <?php if(!empty($payment_info)) echo $payment_info[0]['mode_name']; ?> </b>
                  <br/>
                  <b>b.Payment Security: <?php if(!empty($security_info)) echo $security_info[0]['security_name']; ?> </b>
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
              <br>
              <br>
              <p style="margin-top:-10px;"><span style="border-top:1px solid #000000;"><b><?php if(!empty($purchase_order_info[0]['name'])) echo $purchase_order_info[0]['name']; ?></b></span></p>
              <p style="margin-top:-10px;"><?php if(!empty($purchase_order_info[0]['designation_name'])) echo $purchase_order_info[0]['designation_name']; ?></p>
              <p style="margin-top:-10px;">Cell : <?php if(!empty($purchase_order_info[0]['mobile'])) echo $purchase_order_info[0]['mobile']; ?></p>
             
              <br/>
              <br/>
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


                
            </div> 
    </div>
</div>

<script type="text/javascript">
    
</script>
