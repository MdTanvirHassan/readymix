<style type="text/css">
    .form-control{
        height:30px;
    }
    .common-table table tr td, .common-table  table tr th{
        text-align: center;
        vertical-align: middle !important;
    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3 style="float:left;">Sales Order Details</h3>
                <a onclick="javascript: if(confirm('Are you sure to place to archive. Did you get all payment and complete delevery ?')==true) return true; else return false;" style="float:right;margin-top:10px;" href="<?php echo site_url('sale_orders/make_archive/'.$sale_order_info[0]['o_id']); ?>" class="btn btn-sm btn-danger">Make it Archive</a>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('sale_orders/details_sale_order/'.$sale_order_info[0]['o_id'].'/true'); ?>" class="btn btn-sm btn-warning">PRINT</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                    <div class="row">     
                        <table class="table table-bordered" id="myTable">
            <tr>
                <th>Quotation:</th>
                <td colspan="2">
                    <?php foreach($quotations as $quotation){ ?>
                          <?php if($quotation['q_id']==$sale_order_info[0]['q_id']) echo $quotation['c_short_name'].'('.$quotation['project_name'].')'.'('.$quotation['reference_no'].')' ?>
                            <?php } ?>
                </td>
                
                <th>Customer Name:</th>
                <td colspan="2">
                    <?php if(!empty($sale_order_info[0]['c_name'])) echo $sale_order_info[0]['c_name']; ?>
                </td>
                
            
            </tr>
            <tr>

                <th>Customer Order No:</th>
                <td>
                 <?php if(!empty($sale_order_info[0]['c_order_no'])) echo $sale_order_info[0]['c_order_no']; ?>
                </td>   

                <th>Order No:</th>
                <td>
                 <?php if(!empty($sale_order_info[0]['order_no'])) echo $sale_order_info[0]['order_no']; ?>
                </td>
                <th>Date</th>
                <td>
                    <?php if(!empty($sale_order_info[0]['sale_order_date'])) echo date('d-m-Y',strtotime($sale_order_info[0]['sale_order_date'])); ?>
                </td>
                
            
            </tr>
            <tr>

                <th>Project Name:</th>
                <td>
                   <?php if(!empty($sale_order_info[0]['project_name'])) echo $sale_order_info[0]['project_name']; ?>
                </td>        

                <th>Attention:</th>
                <td>
                    <?php if(!empty($sale_order_info[0]['attention'])) echo $sale_order_info[0]['attention']; ?>
                </td>
                <th>Phone:</th>
                <td>
                    <?php if(!empty($sale_order_info[0]['phone'])) echo $sale_order_info[0]['phone']; ?>
                </td>
                
            </tr>
            
            
            
            
            <tr>
                <th>Contact Person:</th>
                <td>
                    <?php if(!empty($sale_order_info[0]['contact_person'])) echo $sale_order_info[0]['contact_person']; ?>
               
                </td>

                 <th>Contact No:</th>
                 <td>
                    <?php if(!empty($sale_order_info[0]['contact_no'])) echo $sale_order_info[0]['contact_no']; ?>               
                </td>
               
                <th>B. Address:</th>
                <td>
                    <?php if(!empty($sale_order_info[0]['billing_address'])) echo $sale_order_info[0]['billing_address']; ?>
                </td>
                 
              
            
            </tr>
            
             <tr>
                 
                <th>B. Email:</th>
                <td>
                    <?php if(!empty($sale_order_info[0]['billing_email'])) echo $sale_order_info[0]['billing_email']; ?>
                </td>    

                <th>D. Address:</th>
                <td>
                    <?php if(!empty($sale_order_info[0]['shipping_address'])) echo $sale_order_info[0]['shipping_address']; ?>
                    
                </td>
                <th>D. Email:</th>
                <td>
                  <?php if(!empty($sale_order_info[0]['shipping_email'])) echo $sale_order_info[0]['shipping_email']; ?>
                </td>
               
                
               
            
            </tr>
            <tr>

                <th>Delivery Date</th>
                <td>
                    <?php if(!empty($sale_order_info[0]['delivery_date'])) echo date('d-m-Y',strtotime($sale_order_info[0]['delivery_date'])); ?>
                </td>        

                 <th>D. Time:</th>
                <td>
                  <?php if(!empty($sale_order_info[0]['delivery_time'])) echo $sale_order_info[0]['delivery_time']; ?>
                </td>
                
                <th>Sales Person:</th>
                <td>
                  <?php foreach($employees as $employee){ ?>
                           <?php if($employee['id']==$sale_order_info[0]['sale_person_id']) echo $employee['name']; ?>
                  <?php } ?>
                </td>
            </tr>
                      
                  </table>
    
                    </div>
        <div class="separator-shadow"></div>
        <?php 
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(7, 98, $userData); ?>
 <div class="row common-table">
           
                <table class="table table-bordered" >
                    <thead class="thead-color">
                     <tr>
                         <th>Product Name <sup style='color:red'>*</sup></th>
                         <th>M. Unit</th>
                         <th>Quantity</th>   
                         <th>Base Price</th>  
                         <th>Vat</th>  
                         <th>Unit Price</th>          
                         <th>Amount</th>
                         <?php if(!empty($this->role) && !in_array(11,$this->role)){  ?>
                         <th>Commission</th>
                         <?php } ?>
                         <th>Remark</th>


                      </tr>
                    </thead>
                    <tbody id="sale_items">
                          <?php $i=0; foreach($sale_order_details_info as $sale_order_details){ 
                            $i++;
                            ?>
                         <tr class="" id="row_<?php echo $i; ?>">
                            <td><?php echo $sale_order_details['product_name'] ?></td>
                            <td><?php echo $sale_order_details['mu_name'] ?></td>
                            <td style="text-align: right;"><?php echo $sale_order_details['quantity'] ?></td>
                            <td style="text-align: right;"><?php echo $sale_order_details['base_price'] ?></td>  
                            <td style="text-align: right;"><?php echo $sale_order_details['vat'] ?></td>  
                            <td style="text-align: right;"><?php echo $sale_order_details['unit_price'] ?></td>    
                            <td style="text-align: right;"><?php echo $sale_order_details['amount'] ?></td>
                            <?php if(!empty($this->role) && !in_array(11,$this->role)){  ?>
                            <td style="text-align: right;"><?php echo $sale_order_details['commission'] ?></td>
                            <?php } ?>
                            <td ><?php echo $sale_order_details['remark'] ?></td>

                          </tr>
                        <?php } ?>
                      
                      </tbody>
                       <tfoot>
                            <tr>
                                <td colspan="6" style="text-align:right;">Pumping Cost:</td>
                                <td style="text-align: right;"><?php if(!empty($sale_order_info[0]['pump'])) echo number_format($sale_order_info[0]['pump'],2); ?></td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align:right;">Total:</td>
                                <td style="text-align: right;"><?php if(!empty($sale_order_info[0]['total_amount'])) echo $sale_order_info[0]['total_amount']; ?></td>
                            </tr>
                        </tfoot>
                  </table>
           
            
            
            
        </div>
 <div class="row common-table">
           <h2 style="text-align:center; ">Payment Collection</h2>
                <table class="table table-bordered" >
                    <thead class="thead-color">
                     <tr>
                         <th>Received Date</th>
                         <th>Collection Mode</th>
                         <th>Payment Status</th>         
                         <th>Amount</th>
                         <th>Remark</th>


                      </tr>
                    </thead>
                    <tbody id="collection_items">
                          <?php $i=0;
                          $total = 0;
                          foreach($collections as $collection){ 
                            $i++;
                            $total+=$collection['amount'];
                            ?>
                         <tr>
                            <td><?php echo date('d-M-Y',strtotime($collection['receive_date'])); ?></td>
                            <td><?php echo $collection['collection_method'] ?></td>
                            <td style="text-align: right;"><?php echo $collection['payment_status'] ?></td>
                            <td style="text-align: right;"><?php echo number_format($collection['amount'],2) ?></td>
                            <td ><?php echo $collection['remark'] ?></td>

                          </tr>
                        <?php } ?>
                          <tr>
                              <th colspan="3" style="text-align:right">Total Collection : </th>
                              <th style="text-align:right"><?php echo number_format($total,2) ?> </th>
                              <th style="text-align:right"></th>
                          </tr>
                          <tr>
                              <th colspan="3" style="text-align:right">Due : </th>
                              <th style="text-align:right"><?php echo number_format($sale_order_info[0]['total_amount']-$total,2) ?> </th>
                              <th style="text-align:right"></th>
                          </tr>
                      </tbody>
                     
                  </table>
           
            
            
            
        </div>
        
      <div class="separator-shadow"></div>
         <h2 style="text-align:center; ">Payment Conditions</h2>
         <div class="row common-table">
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
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_pdc_check'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_pdc_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_pdc_amount'];  ?></td>
                                    <td style="text-align: left;"><?php echo $payment_mode[0]['b_pdc_condition'];  ?></td>
                                    <td><?php echo $payment_mode[0]['a_pdc'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_pdc_check'];  ?></td>
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
             <div class="col-md-8" >
                <h2 style="text-align:center; ">Specification of Raw Materials</h2>
                <div class="row">
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
             </div>  
             
               <div class="col-md-4">
                    <h2 style="text-align:center; ">Special Note</h2>
                    
        
                    <div class="form-group">

                        <div id="special_note">
                            <b>  <?php if(!empty($sale_order_info[0]['special_note'])) echo $sale_order_info[0]['special_note']; ?></b>

                          </div>
                    </div>
           </div>
         </div>
     
        <div class="row">
           
          
             <div class="col-md-2">
                <a href="<?php echo site_url('backend/sale_orders') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

            </div>
            
            <div class="col-md-2">
                <a target="_blank"  href="<?php echo site_url('sale_orders/details_sale_order/'.$sale_order_info[0]['o_id'].'/true'); ?>" <button type="button" class="btn btn-primary button">PRINT</button> </a>

            </div>
<!--            <div class="col-md-2 ">
               <a target="_blank"  href="<?php echo site_url('sale_orders/details_sale_order/'.$sale_order_info[0]['o_id'].'/true'); ?>" > <button type="button" class="btn btn-primary button">PRINT</button> </a>

            </div>-->
        </div> 
            
        
    
</div>
</div>
</div>
</div>
</div>
</div>




