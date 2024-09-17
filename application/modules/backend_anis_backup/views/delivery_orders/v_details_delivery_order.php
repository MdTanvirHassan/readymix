<style>
   .common-from table tr td, .common-from table tr th{
        text-align: center;
        vertical-align: middle;
    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; ">Delivery Order</h2>
    <a target="_blank" style="float:right;margin-top:-30px;" href="<?php echo site_url('delivery_orders/details_delivery_order/'.$delivery_order_info[0]['do_id'].'/true'); ?>" class="btn btn-sm btn-info">PRINT</a>
    <hr>-->
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3 style="float:left;">Details Delivery Order</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('delivery_orders/details_delivery_order/'.$delivery_order_info[0]['do_id'].'/true'); ?>" class="btn btn-sm btn-warning">PRINT</a>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        
                        <div class="row">     
                        <table class="table table-bordered" id="myTable">
            <tr>
                <th>Sales Order:</th>
                <td colspan="2">
                    <?php foreach($sale_orders as $order){ ?>
                          <?php if($order['o_id']==$delivery_order_info[0]['o_id']) echo $order['c_short_name'].'('.$order['project_name'].')'.'('.$order['order_no'].')' ?>
                            <?php } ?>
                </td>
                <th>Customer Name:</th>
                <td colspan="2">
                    <?php if(!empty($delivery_order_info[0]['c_name'])) echo $delivery_order_info[0]['c_name']; ?>
                </td>
                
            
            </tr>
            <tr>
                <th style="width:12%;">Do. Number:</th>
                <td>
                 <?php if(!empty($delivery_order_info[0]['delivery_no'])) echo $delivery_order_info[0]['delivery_no']; ?>
                </td>
                <th style="width:12%;">Delivery Date</th>
                <td>
                    <?php if(!empty($delivery_order_info[0]['delivery_order_date'])) echo date('d-m-Y',strtotime($delivery_order_info[0]['delivery_order_date'])); ?>
                </td>
                <th style="width:12%;">Project Name:</th>
                <td>
                    <?php if(!empty($delivery_order_info[0]['project_name'])) echo $delivery_order_info[0]['project_name']; ?>
                </td>
            
            </tr>
            <tr>
                
                <th>Attention:</th>
                <td>
                    <?php if(!empty($delivery_order_info[0]['attention'])) echo $delivery_order_info[0]['attention']; ?>
                </td>
                <th>Phone:</th>
                <td>
                    <?php if(!empty($delivery_order_info[0]['phone'])) echo $delivery_order_info[0]['phone']; ?>
                </td>
                <th>Contact Person:</th>
                <td>
                    <?php if(!empty($delivery_order_info[0]['contact_person'])) echo $delivery_order_info[0]['contact_person']; ?>
               
            </td>
            </tr>
            
            
            
            
            <tr>
                
                 <th>Contact No:</th>
                 <td>
                    <?php if(!empty($delivery_order_info[0]['contact_no'])) echo $delivery_order_info[0]['contact_no']; ?>               
                </td>
               
                <th>B. Address:</th>
                <td>
                    <?php if(!empty($delivery_order_info[0]['billing_address'])) echo $delivery_order_info[0]['billing_address']; ?>
                </td>
                    
              <th>B. Email:</th>
                <td>
                    <?php if(!empty($delivery_order_info[0]['billing_email'])) echo $delivery_order_info[0]['billing_email']; ?>
                </td>
            
            </tr>
            
             <tr>
                  
            
                <th>D. Address:</th>
                <td>
                    <?php if(!empty($delivery_order_info[0]['shipping_address'])) echo $delivery_order_info[0]['shipping_address']; ?>
                    
                </td>
                
                <th>D. Time:</th>
                <td>
                  <?php if(!empty($delivery_order_info[0]['delivery_time'])) echo $delivery_order_info[0]['delivery_time']; ?>
                </td>
               
                <th>Remark:</th>
                <td>
                  <?php if(!empty($delivery_order_info[0]['remark'])) echo $delivery_order_info[0]['remark']; ?>
                </td>
               
            
            </tr>
            
                      
                  </table>
    
                    </div>
                        <form  action="<?php echo site_url('delivery_orders/edit_delivery_order_action/'.$delivery_order_info[0]['do_id']); ?>" method="post">
      
        
        
        
       
         
        
        
         
    
        
        
        
         
      
        
      
       
      <div class="separator-shadow"></div>
        <div class="row common-from">
           
                <table class="table table-bordered" >
                    <thead class="thead-color">
                     <tr>
                         <th>Product Name <sup style='color:red'>*</sup></th>
                        
                         <th>Quantity</th>              
                         <th>Measurement Unit</th>
                         <th>Remarks</th>


                      </tr>
                    </thead>
                    <tbody id="delivery_items">
                          <?php $i=0; foreach($delivery_order_details_info as $delivery_order_details){ 
                            $i++;
                            ?>
                         <tr class="" id="row_<?php echo $quotation_details['s_item_id'] ?>">
                             <td><?php echo $delivery_order_details['product_name'] ?></td>
                            
                             <td><?php echo $delivery_order_details['quantity'] ?></td>
                             <td><?php echo $delivery_order_details['mu_name'] ?></td>
                             <td><?php echo $delivery_order_details['remark'] ?></td>
                             
                               
                          </tr>
                        <?php } ?>
                      
                      </tbody>
                       <tfoot>
                           <!--
                            <tr>
                                <td colspan="3" style="text-align:right;"><b>Total</b></td>

                                <td style="text-align: right;"><b><?php if(!empty($delivery_order_info[0]['total_amount'])) echo $delivery_order_info[0]['total_amount']; ?></b></td>
                            </tr>
                           -->
                        </tfoot>
                  </table>
           
            
            
            
        </div>
        
       
      <div class="separator-shadow"></div>
                         <div class="row common-from">
                                <h2 style="text-align:center; ">Status of Order</h2>
                                <table class="table table-bordered" id="orderTable" >
                                    <thead class="thead-color">
                                        <tr >
                                            <th>Product Name </th>
                                            <th>Total Sales Order Qty</th>
                                            <th>Total Delivery Ordered Qty</th>              
                                            <th>Due Qty</th>
                                            <th>Mu</th>


                                        </tr>
                                    </thead>
                                    <tbody id="order_items">
                                        <?php $i=0; foreach($sales_order_details_info as $order_product){ 
                                        $due_quantity=$order_product['quantity']-$order_product['do_qty'];
                                        $i++;
                                        ?>
                                        <tr class="" id="row_">
                                        <td><?php echo $order_product['product_name']; ?></td>
                                        <td><?php echo $order_product['quantity']; ?></td>
                                        <td><?php echo $order_product['do_qty']; ?></td>
                                        <td><?php echo $due_quantity; ?></td>
                                        <td><?php echo $order_product['mu_name']; ?></td>
                                     </tr>
                                   <?php } ?>

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>




     </div>
       
       
       
       <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Payment condition and status</h3>
                                          
                                        </div>
                                        <div class="panel-body">
                                            <div class="main-details" style="">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <table class="table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                                                        <thead class="thead-color">
                                                            <tr >
                                                                <th colspan="4" style="text-align: center;vertical-align: middle;">Before Delivery</th>
                                                                <th colspan="4" style="text-align: center;vertical-align: middle;">After Delivery</th>
                                                            </tr>
                                                            <tr>
                                                                <th style="text-align: center;vertical-align: middle;">Payment Mode</th>
                                                                <th style="text-align: center;vertical-align: middle;">Tenor Day</th>
                                                                <th style="text-align: center;vertical-align: middle;">Percent</th>
                                                                <th style="text-align: center;vertical-align: middle;">Amount</th>
                                                                <th style="text-align: center;vertical-align: middle;">Payment Mode</th>
                                                                <th style="text-align: center;vertical-align: middle;">Tenor Day</th>
                                                                <th style="text-align: center;vertical-align: middle;">Percent</th>
                                                                <th style="text-align: center;vertical-align: middle;">Amount</th>
                                                            </tr>
                                                        </thead> 
                                                       <tbody id="paymentConditionBody">
                                                                    <?php if(!empty($payment_mode[0]['b_cash']) || !empty($payment_mode[0]['a_cash'])){ ?>
                                                                            <tr>
                                                                                <td><?php echo $payment_mode[0]['b_cash'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['b_cash_tenor'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['b_cash_percent'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['b_cash_amount'];  ?></td>
                                                                                <td><?php echo $payment_mode[0]['a_cash'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['a_cash_tenor'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['a_cash_percent'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['a_cash_amount'];  ?></td>
                                                                            </tr>
                                                                    <?php } ?>
                                                                    <?php if(!empty($payment_mode[0]['b_bg']) || !empty($payment_mode[0]['a_bg'])){ ?>
                                                                            <tr>
                                                                                <td><?php echo $payment_mode[0]['b_bg'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['b_bg_tenor'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['b_bg_percent'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['b_bg_amount'];  ?></td>
                                                                                <td><?php echo $payment_mode[0]['a_bg'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['a_bg_tenor'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['a_bg_percent'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['a_bg_amount'];  ?></td>
                                                                            </tr>
                                                                    <?php } ?> 

                                                                    <?php if(!empty($payment_mode[0]['b_lc']) || !empty($payment_mode[0]['a_lc'])){ ?>
                                                                            <tr>
                                                                                <td><?php echo $payment_mode[0]['b_lc'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['b_lc_tenor'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['b_lc_percent'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['b_lc_amount'];  ?></td>
                                                                                <td><?php echo $payment_mode[0]['a_lc'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['a_lc_tenor'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['a_lc_percent'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['a_lc_amount'];  ?></td>
                                                                            </tr>
                                                                    <?php } ?> 
                                                                   <?php if(!empty($payment_mode[0]['b_pdc']) || !empty($payment_mode[0]['a_pdc'])){ ?>
                                                                            <tr>
                                                                                <td><?php echo $payment_mode[0]['b_pdc'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['b_pdc_check'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['b_pdc_percent'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['b_pdc_amount'];  ?></td>
                                                                                <td><?php echo $payment_mode[0]['a_pdc'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['a_pdc_check'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['a_pdc_percent'];  ?></td>
                                                                                <td style="text-align: right;"><?php echo $payment_mode[0]['a_pdc_amount'];  ?></td>
                                                                            </tr>
                                                                 <?php } ?> 
                                                                            <tr>
                                                                                <td><b>Total</b></td>
                                                                                <td colspan="7"><b><?php echo $total_amount; ?></b></td>
                                                                            </tr>
                                                                            
                                                                            <tr>
                                                                                <td><b>Received</b></td>
                                                                                <td colspan="7"><b><?php echo $total_paid; ?></b></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Collection(Not Realized)</b></td>
                                                                                <td colspan="7"><b><?php echo $total_collection_amount; ?></b></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Due</b></td>
                                                                                <td colspan="7"><b><?php echo $total_due; ?></b></td>
                                                                            </tr>


                                                                </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-4">
                                                    <table class="table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                                                        <thead class="thead-color">

                                                            <tr>
                                                                <th style="text-align: center;">Payment Mode</th>
                                                              <!--  <th>Amount</th>-->
                                                                <th style="text-align: center;">Receive Amount</th>
                                                              <!--  <th>Due</th> -->

                                                            </tr>
                                                        </thead> 
                                                        <tbody id="paymentBalanceBody">
                                                                    
                                                                            <tr>
                                                                               <td>Cash</td
                                                                               <td style="text-align: right;"><?php if(!empty($paid_cash_amount[0]['total'])) echo $paid_cash_amount[0]['total']; ?></td>
                                                                              
                                                                           </tr>
                                                                     
                                                                       
                                                                            <tr>
                                                                               <td>Pdc</td>
                                                                               <td style="text-align: right;"><?php if(!empty($paid_pdc_amount[0]['total'])) echo $paid_pdc_amount[0]['total']; ?></td>
                                                                           </tr>
                                                                      
                                                                    
                                                                            <tr>
                                                                               <td>Lc</td>
                                                                               <td style="text-align: right;"><?php if(!empty($paid_lc_amount[0]['total'])) echo $paid_lc_amount[0]['total']; ?></td>
                                                                             
                                                                           </tr>
                                                                     
                                                                            <tr>
                                                                               <td>Bg</td>
                                                                               <td style="text-align: right;"><?php if(!empty($paid_bg_amount[0]['total'])) echo $paid_bg_amount[0]['total']; ?></td>
                                                                              
                                                                           </tr>
                                                                           <tr>
                                                                                <td><b>Total</b></td>
                                                                                <td ><b><?php echo $total_paid; ?></b></td>
                                                                            </tr>
                                                                      
                                                        </tbody>
                                                    </table>
                                                </div>







                                            </div> 

                                        </div>
                                    </div>
          </div>
      
      
      
        
        <div class="row">
           
            <div class="col-md-2">
                <a href="<?php echo site_url('backend/delivery_orders') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
            </div>
            
            <div class="col-md-2">
                <a target="_blank"  href="<?php echo site_url('delivery_orders/details_delivery_order/'.$delivery_order_info[0]['do_id'].'/true'); ?>" <button type="button" class="btn btn-primary button">PRINT</button> </a>

            </div>
            
             
        </div> 
            
        
    </form>
</div>
</div>
</div>
</div>
</div>
</div>





