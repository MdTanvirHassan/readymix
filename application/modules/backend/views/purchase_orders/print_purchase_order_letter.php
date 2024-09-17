<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin-top: 0px;  /* this affects the margin in the printer settings */
    margin-bottom: 0;
    
}
</style>
<div class="right_col" style="padding-bottom:20px;">
    
    <div class="right_content" style="margin-top:105px;margin-bottom:50px;margin-left:50px;">
        
       <!--     <h2 style="text-align: center;">WAHID CONSTRUCTION LTD</h2>-->

            <table class="table" id="">
                <tr>
                   <td style="width:80%;border-top:0px;padding:0px;margin-bottom:20px;">Memo No.:&nbsp;<?php echo $purchase_order_info[0]['order_no']; ?></td>
                   <td style="width:20%;border-top:0px;padding-left:0px;text-align:right;">Date:&nbsp;<?php echo date("d-m-Y",strtotime($purchase_order_info[0]['purchase_order_date'])); ?></td>
                </tr>
                
               <tr>
                    <td style="width:200px;border-top:0px;padding:0px;"></td>
                    <td style="border-top:0px;padding-left:0px;"></td>
                </tr>
                
                 <tr>
                    <td style="width:200px;border-top:0px;padding:0px;"></td>
                    <td style="border-top:0px;padding-left:0px;"></td>
                </tr>
                
                 <tr>
                   <td style="width:200px;border-top:0px;padding:0px;margin-bottom:20px;"></td>
                   <td style="border-top:0px;padding-left:0px;"></td>
                </tr> 
                <tr>
                    <td style="width:200px;border-top:0px;padding:0px;"></td>
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
                        <td style="width:200px;border-top:0px;padding:0px;"><?php echo $purchase_order_info[0]['SUP_NAME']; ?></td>
                        <td style="border-top:0px;padding:0px;"></td>
                    </tr>
                    <tr>
                        <td style="width:200px;border-top:0px;padding:0px;"><?php echo $purchase_order_info[0]['ADDRESS']; ?></td>
                        <td style="border-top:0px;padding:0px;"></td>
                    </tr>
                   <tr>
                        <td style="width:200px;border-top:0px;padding:0px;">Attn: <?php echo $purchase_order_info[0]['attention']."-".$purchase_order_info[0]['phone']; ?></td>
                        <td style="border-top:0px;padding:0px;"></td>
                    </tr>
                </table>       


                
            

            <p style="margin-bottom:0px;margin-top:5px;"><b>Sub:&nbsp;Purchase order for Karim Asphalt & Ready Mix Ltd.</b></p>

            <br/>
            
            <p style="margin-top:0px;">As per your subsequent quotation and discussion with you,we are pleased to place the Purchase Order of the following item as per terms and conditions below: </p>
            <div >

                    <table class="table table-bordered" id="myTable">
                        <thead>
                         <tr >

                             <th style="text-align:center;border-left:1px solid;border-top:1px solid;width:150px;">Item name & Description </th>                             
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
                                            <?php if(!empty($purchase_order_details['unit_price'])) echo number_format($purchase_order_details['unit_price'],3); ?>
                                        </td>

                                        <td style="border-left:1px solid;border-top:1px solid;text-align: right;">
                                            <?php if(!empty($purchase_order_details['amount'])) echo number_format($purchase_order_details['amount'],3)." BDT"; ?>
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

                                    <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($purchase_order_info[0]['total_amount'])) echo number_format($purchase_order_info[0]['total_amount'],3)." BDT"; ?></td>
                                     <td style="text-align: right;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"></td>
                                </tr>
                                <tr>
                                    <td colspan="6"><b>Taka In Words = <?php $taka_in_word = convert_number_to_words($purchase_order_info[0]['total_amount']);
                                                                                          echo ucwords($taka_in_word);  ?>&nbsp;Taka Only
                </b></td>
                                </tr>
                            </tfoot>
                      </table>
<br/>
              <!--  <p style="margin-bottom:0px"><b>***Water Proofing Chemical 5.00 TK. will be added per cft***</b></p>-->
               
              
            
              
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
                            <td style="width:200px;border-top:0px;padding-left:5px;padding-top:0px;"><?php echo '* '.$purchase_condition['t_or_c_name']  ?></td>
                            <td style="border-top:0px;padding:0px;">:&nbsp;<?php echo $purchase_condition['t_or_c_description']  ?></td>
                        </tr>
                 <?php } ?>
                </table>   
              
             

              <p style="">Please make sure of the consistency of quality supply on time in full quality and service.</p>
             
              
              <p style="">Kind regards</p>
              <br>
              <br>
             
              <p style="margin-top:-10px;"><span style="border-top:1px solid #000000;"><b>Authorized Signatory</b></span></p>
              <p style="margin-top:-10px;">Purchase Department</p>
             
              
             
             
                <table class="table" id="myTable1" style="margin-top:-10px;">


                    
                    <tr>
                        <td colspan="2" style="border-top:0px;padding:0px;">
                            <span style="border-bottom:1px solid;border-bottom:1px solid #000000;"> <b>Copy to:</b></span>
                        </td>
                    </tr>
                    <?php $j=0; foreach($copy_to as $copy){ 
                        $j++;
                        ?>
                        <tr>
                            <td style="width:500px;border-top:0px;padding:1px;"><?php echo $j.'. '. $copy['name'];  ?></td>
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
