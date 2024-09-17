<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div style="text-align: right">
                <a href="<?php echo site_url('backend/sale_quotations/offer_quotation/'.$quotation_info[0]['q_id'].'/print') ?>" > <button type="button" class="btn btn-success button">Print</button> </a>

    </div>
        <h2 style="text-align: center;">Karim Asphalt & Ready Mix Ltd. </h2>
        <p style="margin-bottom:0px">Ref:&nbsp;<?php echo $quotation_info[0]['reference_no']; ?></p>
        <p style="margin-bottom:0px">Date:&nbsp;<?php echo date("d-m-Y"); ?></p>
                   
        <p style="margin-bottom:0px">To,</p>			
        <p style="margin-bottom:0px">Managing Director</p>
        <p style="margin-bottom:0px"><?php echo $quotation_info[0]['c_name']; ?></p>
        <p style="margin-bottom:0px"><?php echo $quotation_info[0]['c_contact_address']; ?></p>	
        
       
        <p style="margin-bottom:0px;margin-top:5px;"><b>Attention:</b>&nbsp;<?php echo $quotation_info[0]['attention']; ?></p>
       
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
                         <th>Amount</th>
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
           
            <p style="margin-bottom:0px"><b>***Water Proofing Chemical 5.00 TK. will be added per cft***</b></p>
            <table class="table" id="myTable1">
                
                
                <tr>
                    <td style="width:200px;border-top:0px;padding:0px;"><span style="border-bottom:1px solid;"><b>Special Note</b></span></td>
                    <td style="border-top:0px;padding:0px;">:&nbsp;Strength will be maintained as per standard Specification.</td>
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
          
           
            <p style="margin-top:-10px;"><span style="border-bottom:1px solid;"><b>Mode of Payment</b></span></p>
          <p style="margin-top:-10px;">Along with a work order 95% in advance & Other 5% Covered by Post Dated Cheque  in favoring of <b>"Karim Asphalt & Ready Mix Ltd."</b> </p>
          <br>
       
          <p style="margin-top:-10px;">Thanking with best regards</p>
          <br>
          <br>
          <p style="margin-top:-10px;"><span style="border-top:1px solid #000000;"><b>Engr. Samir Uddin Ahmed</b></span></p>
          <p style="margin-top:-10px;">General Manager</p>
          <p style="margin-top:-10px;">Cell : 01712-294628</p>
        </div>
       
      
        
     
            
        <div class="row">
           
            
             <div class="col-md-2">
                <a href="<?php echo site_url('backend/sale_quotations') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

            </div>
        </div> 
   
</div>

<script type="text/javascript">
    
</script>
