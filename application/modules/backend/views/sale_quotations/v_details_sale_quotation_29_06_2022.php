<style type="text/css">
    .form-control{
        height:30px;
    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
   <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Details Quotation</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    
        <table class="table table-bordered" id="myTable">
            <tr>
                <th>Q.No:</th>
                <td><?php if(!empty($quotation_info[0]['reference_no'])) echo $quotation_info[0]['reference_no']; ?></td>
                <th>Date:</th>
                <td><?php if(!empty($quotation_info[0]['quotation_date'])) echo date('d-m-Y',strtotime($quotation_info[0]['quotation_date'])); ?></td>
                <th>Product Type:</th>
                <td>
                    <?php foreach($categories as $category){ ?>
                                <?php if($category['category_id']==$quotation_info[0]['category_id']) echo $category['short_name']; ?>
                            <?php } ?>
                </td>
            
            </tr>
            <tr>
                <th>Customer:</th>
                <td>
                    <?php foreach($customers as $customer){ ?>
                                    <?php if($customer['id']==$quotation_info[0]['customer_id']) echo $customer['c_name'] ?>
                            <?php } ?>
                </td>
                <th>Project Name:</th>
                <td><?php if(!empty($quotation_info[0]['project_name'])) echo $quotation_info[0]['project_name']; ?></td>
                <th>Attention:</th>
                <td>
                   <?php if(!empty($quotation_info[0]['attention'])) echo $quotation_info[0]['attention']; ?>
                </td>
            
            </tr>
            <tr>
                <th>Phone:</th>
                <td>
                    <?php if(!empty($quotation_info[0]['phone'])) echo $quotation_info[0]['phone']; ?>
                </td>
                <th>B. Address:</th>
                <td>
                    <?php if(!empty($quotation_info[0]['billing_address'])) echo $quotation_info[0]['billing_address']; ?>
                </td>
                <th>B. Email:</th>
                <td>
                   <?php if(!empty($quotation_info[0]['billing_email'])) echo $quotation_info[0]['billing_email']; ?>
                </td>
            
            </tr>
            <tr>
                <th>D. Address:</th>
                <td>
                    <?php if(!empty($quotation_info[0]['shipping_address'])) echo $quotation_info[0]['shipping_address']; ?>
                </td>
                <th>D. Email:</th>
                <td>
                    <?php if(!empty($quotation_info[0]['shipping_email'])) echo $quotation_info[0]['shipping_email']; ?>
                </td>
                <th>Sales Person:</th>
                <td>
                   <?php foreach($employees as $employee){ ?>
                              <?php if($employee['id']==$quotation_info[0]['employee_id']) echo $employee['name'].'('.$employee['designation_short_name'].')' ?>
                            <?php } ?>
                </td>
            
            </tr>
            <tr>
                <th>Prepared By:</th>
                <td>
                     <?php foreach($employees as $employee){ ?>
                                <?php if($employee['id']==$quotation_info[0]['thanks_employee_id']) echo $employee['name'].'('.$employee['designation_short_name'].')' ?>
                            <?php } ?>
                </td>
                <th>Followup By:</th>
                <td>
                    <?php foreach($employees as $employee){ ?>
                                <?php if($employee['id']==$quotation_info[0]['followup_employee_id']) echo $employee['name'].'('.$employee['designation_short_name'].')' ?>
                            <?php } ?>
                </td>
                
                <th>Bank:</th>
                <td>
                    <?php foreach($banks as $bank){ ?>
                             <?php if($bank['id']==$quotation_info[0]['bank_id']) echo $bank['b_short_name'].'('.$bank['branch_name'].')'.'('.$bank['b_account_no'].')' ?>
                    <?php } ?>
                </td>
            
            </tr>
                      
                  </table>
        
        <div class="separator-shadow"></div>
        
     
        <div class="row">
            <input type="hidden" value="<?php echo count($quotation_details_info) ?>" id="count" />
                <table class="table table-bordered" id="myTable">
                    <thead class="thead-color">
                     <tr >
                         
                         <th>Product Name <sup style='color:red'>*</sup></th>
                         <th>Costing No.</th>
                         <th>Project Name</th>
                         <th>Quantity</th>
                         <th>Unit Price</th>
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
                                       <?php echo $quotation_detail['cost_number']; ?>
                                    </td> 
                                     <td>
                                       <?php if(!empty($quotation_info[0]['project_name'])) echo $quotation_info[0]['project_name']; ?>
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
                                <td colspan="5" style="text-align:right;"><b>Total</b></td>

                                <td style="text-align: right;"><b><?php if(!empty($quotation_info[0]['total_amount'])) echo $quotation_info[0]['total_amount']; ?></b></td>
                            </tr>
                        </tfoot>
                  </table>
           
            
            
            
        </div>
        
        <div class="separator-shadow"></div>
         <h2 style="text-align:center; ">Payment Conditions</h2>
     
         <div class="row">
            <table class="table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                <thead class="thead-color">
                           <tr>
                               <th colspan="5" style="text-align: center;">Before Delivery</th>
                               <th colspan="5" style="text-align: center;">After Delivery</th>
                           </tr>
                           <tr>
                               <th>Payment Mode</th>
                               <th>Tenor Day</th>
                               <th>Percent</th>
                               <th>Amount</th>
                               <th>Delivery Condition</th>
                               <th>Payment Mode</th>
                               <th>Tenor Day</th>
                               <th>Percent</th>
                               <th>Amount</th>
                               <th>Delivery Condition</th>
                           </tr>
                    </thead> 
                    <tbody id="paymentConditionBody">
                        <?php if(!empty($payment_mode[0]['b_cash']) || !empty($payment_mode[0]['a_cash'])){ ?>
                                <tr>
                                    <td><?php echo $payment_mode[0]['b_cash'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_cash_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_cash_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_cash_amount'];  ?></td>
                                    <td style="text-align: left;"><?php echo $payment_mode[0]['b_cash_condition'];  ?></td>
                                    <td><?php echo $payment_mode[0]['a_cash'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_cash_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_cash_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_cash_amount'];  ?></td>
                                    <td></td>
                                </tr>
                        <?php } ?>
                        <?php if(!empty($payment_mode[0]['b_bg']) || !empty($payment_mode[0]['a_bg'])){ ?>
                                <tr>
                                    <td><?php echo $payment_mode[0]['b_bg'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_bg_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_bg_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_bg_amount'];  ?></td>
                                    <td style="text-align: left;"><?php echo $payment_mode[0]['b_bg_condition'];  ?></td>
                                    <td><?php echo $payment_mode[0]['a_bg'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_bg_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_bg_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_bg_amount'];  ?></td>
                                    <td></td>
                                </tr>
                        <?php } ?> 
                         
                        <?php if(!empty($payment_mode[0]['b_lc']) || !empty($payment_mode[0]['a_lc'])){ ?>
                                <tr>
                                    <td><?php echo $payment_mode[0]['b_lc'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_lc_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_lc_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_lc_amount'];  ?></td>
                                    <td style="text-align: left;"><?php echo $payment_mode[0]['b_lc_condition'];  ?></td>
                                    <td><?php echo $payment_mode[0]['a_lc'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_lc_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_lc_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_lc_amount'];  ?></td>
                                    <td></td>
                                </tr>
                        <?php } ?> 
                       <?php if(!empty($payment_mode[0]['b_pdc']) || !empty($payment_mode[0]['a_pdc'])){ ?>
                                <tr>
                                    <td><?php echo $payment_mode[0]['b_pdc'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_pdc_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_pdc_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_pdc_amount'];  ?></td>
                                    <td style="text-align: left;"><?php echo $payment_mode[0]['b_pdc_condition'];  ?></td>
                                    <td><?php echo $payment_mode[0]['a_pdc'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_pdc_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_pdc_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_pdc_amount'];  ?></td>
                                    <td></td>
                                </tr>
                     <?php } ?>          
                                
                                
                    </tbody>
                 </table>  
         </div> 
         <div class="separator-shadow"></div>
         <div class="row">
             
             <div class="col-md-8">
                 <h2 style="text-align:center; ">Specification of Raw Materials</h2>
        
           <?php if(!empty($raw_material_specification)){ ?> 
            <input type="hidden" value="<?php echo count($raw_material_specification) ?>" id="material_count" />
           <?php }else{ ?>
            <input type="hidden" value="1" id="material_count" />
           <?php } ?>  
                <table class="table table-bordered" id="specificationTable">
                    <thead class="thead-color">
                     <tr >
                         <th></th>
                         <th>Material Name </th>
                         <th>Description</th>
                         

                      </tr>
                    </thead>
                    <tbody id="material_specification">
                     <?php $i=0; foreach($raw_material_specification as $raw_material){ 
                         $i++;
                         ?>
                        <tr id="row_<?php echo $i; ?>">
                            <td></td>
                            <td><?php echo $raw_material['material_name']  ?></td>
                            <td><?php echo $raw_material['m_description']  ?></td>
                        </tr>
                     <?php } ?> 
                    </tbody>
                     
                  </table>
             
        
             </div>
             <div class="col-md-4">
                 <h2 style="text-align:center; ">Special Note :</h2>
                 <p style="text-align:center;"> <?php if(!empty($quotation_info[0]['special_note'])){ echo $quotation_info[0]['special_note'];}else{ echo 'No note available for this quotation';} ?> </p>
             </div>
         </div>
         
         
         
        
        
        <div class="row">
           
            
             <div class="col-md-2">
                <a href="<?php echo site_url('backend/sale_quotations') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

            </div>
        </div> 
            
        
    
</div>
</div>
</div>
</div>
</div>
</div>

