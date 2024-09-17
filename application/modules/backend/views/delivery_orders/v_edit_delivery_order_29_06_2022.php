<style type="text/css">
    .form-control{
        height:30px;
    }
    table tr td, table tr th{
        text-align: center;
        vertical-align: middle;
           
    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
   <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Delivery Order</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <form class="form-horizontal" action="<?php echo site_url('delivery_orders/edit_delivery_order_action/'.$delivery_order_info[0]['do_id']); ?>" method="post" onsubmit="javascript: return validation()">
        <div class='form-group' style="margin-bottom:30px;" >
                                <label for="title" class="col-sm-2 control-label">
                                    Sales Order<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-5 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select  id="o_id" class="form-control e1" name="o_id">
                            <option class="form-control" value="">Select Order</option>
                            <?php foreach($sale_orders as $order){ ?>
                                <?php 
                                if($order['o_id']!=$delivery_order_info[0]['o_id']) {
                                    continue;
                                }
                                ?>
                                
                                <option <?php if($order['o_id']==$delivery_order_info[0]['o_id']) echo "selected"; ?> class="form-control" value="<?php echo $order['o_id'] ?>"><?php echo $order['c_short_name'].'('.$order['project_name'].')'.'('.$order['order_no'].')' ?></option>
                            <?php } ?>
                       </select>
                        <span id="o_id_error" style="color:red"></span>
                                </div>
                                

                            </div>
        
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Do. Number<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input required class="form-control" readonly name="delivery_no" type="text" value="<?php if(!empty($delivery_order_info[0]['delivery_no'])) echo $delivery_order_info[0]['delivery_no']; ?>">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    D.Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control datepicker" id="delivery_order_date" name="delivery_order_date" type="text" value="<?php if(!empty($delivery_order_info[0]['delivery_order_date'])) echo date('d-m-Y',strtotime($delivery_order_info[0]['delivery_order_date'])); ?>">
                       <span id="delivery_order_date_error" style="color:red"></span>
                                </div>

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Project Name<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input   class="form-control" id="project_id" name="project_id" type="hidden" value="<?php if(!empty($delivery_order_info[0]['project_id'])) echo $delivery_order_info[0]['project_id']; ?>">
                               <input  readonly class="form-control" id="project_name" name="project_name" type="text" value="<?php if(!empty($delivery_order_info[0]['project_name'])) echo $delivery_order_info[0]['project_name']; ?>">
                               <span id="project_name_error" style="color:red"></span>
                                </div>
            
            
            <label for="title" class="col-sm-2 control-label">
                                    D. Time<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <input  class="form-control" id="delivery_time" name="delivery_time" type="text" placeholder="Delivery Time" value="<?php if(!empty($delivery_order_info[0]['delivery_time'])) echo $delivery_order_info[0]['delivery_time']; ?>">
                        <span id="delivery_time_error" style="color:red"></span>
                                </div> 
            
                                
                             

                            </div>
        
         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Phone<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="phone" name="phone" type="text" placeholder="Phone Number" value="<?php if(!empty($delivery_order_info[0]['phone'])) echo $delivery_order_info[0]['phone']; ?>">
                                <span id="phone_error" style="color:red"></span>
                                </div>
              <label for="title" class="col-sm-2 control-label">
                                    Attention<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                     <input  class="form-control" id="attention" name="attention" type="text" placeholder="Attention Person Name" value="<?php if(!empty($delivery_order_info[0]['attention'])) echo $delivery_order_info[0]['attention']; ?>">
                                <span id="attention_error" style="color:red"></span>
                                </div>
                                

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Contact No<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                    <input  class="form-control" id="contact_no" name="contact_no" type="text" placeholder="Contact No" value="<?php if(!empty($delivery_order_info[0]['contact_no'])) echo $delivery_order_info[0]['contact_no']; ?>">
                                <span id="contact_no" style="color:red"></span>
                        
                                </div>
                               <label for="title" class="col-sm-2 control-label">
                                  Contact Person :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input  class="form-control" id="contact_person" name="contact_person" type="text" placeholder="Contact Person" value="<?php if(!empty($delivery_order_info[0]['contact_person'])) echo $delivery_order_info[0]['contact_person']; ?>">
                                 <span id="contact_person" style="color:red"></span>
                                </div> 
            

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    B. Email<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <input  class="form-control" id="billing_email" name="billing_email" type="text" placeholder="Billing Email" value="<?php if(!empty($delivery_order_info[0]['billing_email'])) echo $delivery_order_info[0]['billing_email']; ?>">
                        <span id="billing_email_error" style="color:red"></span>
                                </div>
                               <label for="title" class="col-sm-2 control-label">
                                    B. Address<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                      <input  class="form-control" id="billing_address" name="billing_address" type="text" placeholder="Billing Address" value="<?php if(!empty($delivery_order_info[0]['billing_address'])) echo $delivery_order_info[0]['billing_address']; ?>">
                        <span id="billing_address_error" style="color:red"></span>
                                </div>
            
            
            

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    D. Email<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <input  class="form-control" id="shipping_email" name="shipping_email" type="text" placeholder="Delivery Email" value="<?php if(!empty($delivery_order_info[0]['shipping_email'])) echo $delivery_order_info[0]['shipping_email']; ?>">
                        <span id="billing_email_error" style="color:red"></span>
                                </div>
            <label for="title" class="col-sm-2 control-label">
                                    D. Address<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                     <input  class="form-control" id="shipping_address" name="shipping_address" type="text" placeholder="Delivery Address" value="<?php if(!empty($delivery_order_info[0]['shipping_address'])) echo $delivery_order_info[0]['shipping_address']; ?>">
                        <span id="shipping_address_error" style="color:red"></span>
                                </div>
                                    
                                

         </div>
        
        <div class='form-group' >
                <label for="title" class="col-sm-2 control-label">
                    Special Note  :
                </label> 
                <div class="col-sm-4 input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <!--
                     <input  class="form-control" id="special_note" name="special_note" type="text" placeholder="Special Note" value="<?php if(!empty($delivery_order_info[0]['special_note'])) echo $delivery_order_info[0]['special_note']; ?>">
                    -->
                    <textarea  rowspan="7" class="form-control" id="special_note" name="special_note"  placeholder="Special Note"><?php if(!empty($delivery_order_info[0]['special_note'])) echo $delivery_order_info[0]['special_note']; ?></textarea>  

                </div>

            <label for="title" class="col-sm-2 control-label">
                Remark:
            </label> 
            <div class="col-sm-4 input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
               <!--  <input  class="form-control" id="special_note" name="special_note" type="text" placeholder="Special Note">-->
                <textarea  rowspan="7" class="form-control" id="special_note" name="do_remark"  placeholder="Remark"><?php if(!empty($delivery_order_info[0]['remark'])) echo $delivery_order_info[0]['remark']; ?></textarea>  
            </div>


            </div>

       
       <div class="separator-shadow"></div>
        <div class="row">
           
                <table class="table table-bordered" >
                    <thead class="thead-color">
                     <tr>
                         <th>Product Name <sup style='color:red'>*</sup></th>
                        <!-- <th>Unit Price</th>-->
                         <th>Sales Order Quantity</th> 
                         <th>Delivery Order Quantity</th>              
                         <th>Measurement Unit</th>
                         <th>Remark</th>

                      </tr>
                    </thead>
                    <tbody id="delivery_items">
                          <?php $i=0; foreach($delivery_order_details_info as $delivery_order_details){ 
                            $i++;
                            ?>
                         <tr class="" id="row_<?php echo $quotation_details['s_item_id'] ?>">
                             <td>
                                 <input  type="hidden"  name="o_details_id[]" id="o_details_id_<?php echo $i; ?>" class="issue" value="<?php echo $delivery_order_details['o_details_id'] ?>">
                                 <input  type="hidden"  name="s_item_id[]" id="item_des_c1_" class="issue" value="<?php echo $delivery_order_details['s_item_id'] ?>">
                                 <input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="<?php echo $delivery_order_details['product_name'] ?>">
                             </td>
                             
                             <td>                               
                                 <input  readonly  style="width:140px;text-align:left;"  type="text"  name="so_qty[]" id="so_quantity_<?php echo $i; ?>" class="issue" value="<?php echo $delivery_order_details['so_qty'] ?>">
                             </td>
                             
                             <td>
                                 <input type="hidden"  style="width:140px;text-align:right;"  type="text"  name="unit_price[]" id="unit_price_<?php echo $i; ?>" class="issue" value="<?php echo $delivery_order_details['unit_price'] ?>">
                                 <input type="hidden"  style="width:140px;text-align: right;"  type="text" class="amount_<?php echo $i; ?>"  name="amount[]" id="amount_<?php echo $i; ?>" class="issue" value="<?php echo $delivery_order_details['amount'] ?>">
                                 <input type="hidden"  name="pre_quantity[]" id="item_quantity_pre_<?php echo $delivery_order_details['s_item_id'] ?>" class="issue" value="<?php echo $delivery_order_details['quantity'] ?>">
                                 <input  required onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"  style="width:140px;text-align:left;"  type="text"  name="quantity[]" id="quantity_<?php echo $i; ?>" class="issue" value="<?php echo $delivery_order_details['quantity'] ?>">
                             </td>
                            
                            <td><input readonly  style="width:140px;text-align: left;"  type="text" class="mu_<?php echo $i; ?>"  name="mu_name[]" id="mu_<?php echo $i; ?>" class="issue" value="<?php echo $delivery_order_details['mu_name'] ?>"></td>
                            <td><input readonly  style="width:140px;text-align: left;"  type="text" class="remark_<?php echo $i; ?>"  name="remark[]" id="remark_<?php echo $i; ?>" class="issue" value="<?php echo $delivery_order_details['remark'] ?>"></td>

                          </tr>
                        <?php } ?>
                      
                      </tbody>
                       <tfoot>
                            <tr>
                                <td  style="text-align:right;"></td>
                                <td  style="text-align:right;"></td>
                                <td><input type="hidden" style="width:140px;text-align: right;" id="sub_total"  name="total_amount" type="text" value="<?php if(!empty($delivery_order_info[0]['total_amount'])) echo $delivery_order_info[0]['total_amount']; ?>"></td>
                            </tr>
                        </tfoot>
                  </table>
           
            
            
            
        </div>
        
       
       <div class="separator-shadow"></div>
                         <div class="row">
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
                                        <td><input readonly style="width:140px;"  type="text"  name="product_name[]" id="product_name_" class="issue" value="<?php echo $order_product['product_name']; ?>"></td>
                                        <td><input readonly  style="width:140px;text-align: right;"  type="text"  name="order_quantity[]" id="order_quantity_<?php echo $i; ?>" class="issue" value="<?php echo $order_product['quantity']; ?>"></td>
                                        <td><input readonly   style="width:140px;text-align: right;"  type="text"  name="delivery_quantity[]" id="delivery_quantity_<?php echo $i; ?>" class="issue" value="<?php echo $order_product['do_qty']; ?>"></td>
                                        <td><input readonly  style="width:140px;text-align: right;"  type="text"   name="due_quantity[]" id="due_quantity_<?php echo $order_product['s_item_id']; ?>" class="issue" value="<?php echo $due_quantity; ?>"></td>
                                        <td><input readonly  style="width:140px;text-align: right;"  type="text"   name="due_quantity[]" id="due_quantity_<?php echo $order_product['s_item_id']; ?>" class="issue" value="<?php echo $order_product['mu_name']; ?>"></td>
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
                                                    <table class="table table-striped responsive">
                                                        <thead class="thead-color">
                                                            <tr >
                                                                <th colspan="4" style="text-align: center;">Before Delivery</th>
                                                                <th colspan="4" style="text-align: center;">After Delivery</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Payment Mode</th>
                                                                <th>Tenor Day</th>
                                                                <th>Percent</th>
                                                                <th>Amount</th>
                                                                <th>Payment Mode</th>
                                                                <th>Tenor Day</th>
                                                                <th>Percent</th>
                                                                <th>Amount</th>
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
                                                                                <td colspan="7" style="text-align:left;"><b><?php echo $total_amount; ?></b></td>
                                                                            </tr>
                                                                            
                                                                            <tr>
                                                                                <td><b>Received</b></td>
                                                                                <td colspan="7" style="text-align:left;"><b><?php echo $total_paid; ?></b></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Collection(Not Realized)</b></td>
                                                                                <td colspan="7" style="text-align:left;"><b><?php echo $total_collection_amount; ?></b></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Due</b></td>
                                                                                <td colspan="7" style="text-align:left;"><b><?php echo $total_due; ?></b></td>
                                                                            </tr>


                                                                </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-4">
                                                    <table class="table table-striped responsive">
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
                <a href="<?php echo site_url('backend/delivery_orders') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px">GO BACK</button> </a>
            </div>
            <div class="col-md-2 ">
                <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">UPDATE</button>
            </div>
             
        </div> 
            
        
    </form>
</div>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
    
     var datePickerOptions = {
                dateFormat: 'dd-mm-yy',
                firstDay: 1,
                changeMonth: true,
                changeYear: true,
                // ...
            }
    $('.datepicker').datepicker(datePickerOptions);
    
    
    function validation(){
        var delivery_order_date=$('#delivery_order_date').val();
        var o_id=$('#o_id').val();
      
        var project_name=$('#project_name').val();
        var attention=$('#attention').val();
        var phone=$('#phone').val();
        var billing_address=$('#billing_address').val();
        var billing_email=$('#billing_email').val();
        var shipping_address=$('#shipping_address').val();
        var shipping_email=$('#shipping_email').val();
        
        var error=false;
        
        if(delivery_order_date==''){
            $('#delivery_order_date').css('border','1px solid red');
            $('#delivery_order_date_error').html('Please fill date field');
            error=true;
           
        }else{
            $('#delivery_order_date').css('border','1px solid #ccc');
            $('#delivery_order_date_error').html('');
            
        }
        if(o_id==''){
            $('#o_id_error').html('Please select quotation');
            $('#o_id').css('border','1px solid red');
             error=true;
        }else{
            $('#o_id_error').html('');
            $('#o_id').css('border','1px solid #ccc');   
            
        }
      
         if(project_name==''){
            $('#project_name_error').html('Please fill  project name field');
            $('#project_name').css('border','1px solid red'); 
            error=true;
        }else{
            $('#project_name_error').html('');
            $('#project_name').css('border','1px solid #ccc');   
             
        }
        
        if(attention==''){
            $('#attention_error').html('Please fill  attention field');
            $('#attention').css('border','1px solid red'); 
            error=true;
        }else{
            $('#attention_error').html('');
            $('#attention').css('border','1px solid #ccc');  
             
        }
        
        if(phone==''){
//            $('#phone_error').html('Please fill phone number field');
//            $('#phone').css('border','1px solid red'); 
//             error=true;
        }else{
            $('#phone_error').html('');
            $('#phone').css('border','1px solid #ccc');  
             
        }
        
        if(billing_address==''){
            $('#billing_address_error').html('Please fill billing address field');
            $('#billing_address').css('border','1px solid red'); 
            error=true;
        }else{
            $('#billing_address_error').html('');
            $('#billing_address').css('border','1px solid #ccc');  
             
        }
        
         if(billing_email==''){
//            $('#billing_email_error').html('Please fill billing email field');
//            $('#billing_email').css('border','1px solid red'); 
//             error=true;
        }else{
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(billing_email)) {
                $('#billing_email_error').html('Invalid email address');
                $('#billing_email').css('border','1px solid red');  
                error=true;
                $('#billing_email').focus();
            }else{
               $('#billing_email_error').html('');
               $('#billing_email').css('border','1px solid #ccc');  
            }
             
        }
        
        if(shipping_address==''){
            $('#shipping_address_error').html('Please fill delivery address field');
            $('#shipping_address').css('border','1px solid red'); 
            error=true;
        }else{
            $('#shipping_address_error').html('');
            $('#shipping_address').css('border','1px solid #ccc');  
             
        }
        
        if(shipping_email==''){
//            $('#shipping_email_error').html('Please fill delivery email field');
//            $('#shipping_email').css('border','1px solid red'); 
//            error=true;
        }else{
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(shipping_email)) {
                $('#shipping_email_error').html('Invalid email address');
                $('#shipping_email').css('border','1px solid red');  
                error=true;
                $('#shipping_email').focus();
            }else{
               $('#shipping_email_error').html('');
               $('#shipping_email').css('border','1px solid #ccc');  
            } 
             
        }
        
       
        
        if(error==true){
            return false;
        }
    }
    
    
    $('#do_id').change(function () {
        var do_id = $('#do_id').val();
        if (do_id != '') {

            $('#challan_items tr').remove();
            $('#order_items tr').remove();
            $('#production_items tr').remove();

            $('#sub_total').val('');
            $('#challan_code').val('');
            $('#dc_no').val('');
            $('#customer_id').val('');
            $('#attention').val('');
            $('#phone').val('');
            $('#project_id').val('');
            $('#project_name').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            
            $('#contact_person').val('');
            $('#contact_no').val('');

            var d = new Date();
            var n = d.getFullYear();
            var final = n.toString().substring(2);


            var data = {'do_id': do_id}
            $.ajax({
                url: '<?php echo site_url('delivery_challans/get_delivery_order_item'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {

                    if (msg.order_code != "") {
                        var item_id = Number(msg.order_code[0].challan_code)+1;
                    } else {
                        item_id = "";
                    }

                    var item_sl_no;
                    if (item_id != '') {
                        if (item_id > 999) {
                            item_sl_no = item_id;
                        } else if (item_id > 99) {
                            item_sl_no = 'CH/' + msg.delivery_info[0].c_short_name + '/' + final + '/' + "0" + item_id;
                        } else if (item_id > 9) {
                            item_sl_no = 'CH/' + msg.delivery_info[0].c_short_name + '/' + final + '/' + "00" + item_id;
                        } else {
                            item_sl_no = 'CH/' + msg.delivery_info[0].c_short_name + '/' + final + '/' + "000" + item_id;
                        }
                    } else {
                        item_id = 1;
                        item_sl_no = 'CH/' + msg.delivery_info[0].c_short_name + '/' + final + '/' + '0001';
                    }

                    $('#challan_code').val(item_id);
                    $('#dc_no').val(item_sl_no);
                    $('#customer_id').val(msg.delivery_info[0].id);

                    $('#attention').val(msg.delivery_info[0].attention);
                    $('#phone').val(msg.delivery_info[0].phone);
                    $('#project_id').val(msg.delivery_info[0].project_id);
                    $('#project_name').val(msg.delivery_info[0].project_name);
                    $('#billing_address').val(msg.delivery_info[0].billing_address);
                    $('#billing_email').val(msg.delivery_info[0].billing_email);
                    $('#shipping_address').val(msg.delivery_info[0].shipping_address);
                    $('#shipping_email').val(msg.delivery_info[0].shipping_email);
                    
                    $('#contact_person').val(msg.delivery_info[0].contact_person);
                    $('#contact_no').val(msg.delivery_info[0].contact_no);

                    var str = '';
                    var total = 0;
                    var net_qty;
                    var amount;
                    $(msg.item_list).each(function (i, v) {
                        if (v.delivery_quantity != '') {
                            net_qty = Number(v.quantity) - Number(v.delivery_quantity);
                        } else {
                            net_qty = Number(v.quantity);
                        }
                        amount = Number(v.unit_price) * Number(net_qty);
                        total = total + Number(v.amount);
                        str += '<tr>';
                        str += '<td><input type="hidden"  name="s_item_id[]" id="item_des_c1_" class="issue" value="' + v.s_item_id + '"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="' + v.product_name + '"></td>';
                        str += '<td>';
                        str +='<input type="hidden"  style="width:140px;"  type="text"  name="unit_price[]" id="unit_price_' +(Number(i) + 1)+ '" class="unit_price_' + (Number(i) + 1) + '" value="' + v.unit_price + '">';
                        str +='<input type="hidden"   style="width:140px;text-align:right;"  type="text" name="amount[]" id="amount_' + v.s_item_id + '" class="amount_' + (Number(i) + 1) + '"  value="' + amount + '">';
                       // str +='<input  readonly  onkeyup="calculateSubtotal(' + v.s_item_id + ')" onchange="calculateSubtotal(' + v.s_item_id + ')" onblur="calculateSubtotal(' + v.s_item_id + ')"  style="width:140px;text-align:right;"  type="text"  name="quantity[]" id="quantity_' + v.s_item_id + '" class="issue number" value="' + net_qty + '">';
                        str +='<input  readonly  onkeyup="calculateSubtotal(' +(Number(i) + 1)+ ')" onchange="calculateSubtotal(' +(Number(i) + 1)+')" onblur="calculateSubtotal(' +(Number(i) + 1)+')"  style="width:140px;text-align:right;"  type="text"  name="quantity[]" id="quantity_'+(Number(i)+1)+ '" class="issue number" value="' +''+ '">';
                        str +='</td>';
                        str += '<td><input readonly   style="width:140px;text-align:left;"  type="text" name="mu_name[]" id="mu_' + v.s_item_id + '" class="amount_' + (Number(i) + 1) + '"  value="' + v.mu_name + '"></td>';
                      //  str += '<td><input onclick="calculateSubtotal(' + v.s_item_id + ')" style="width:40px;text-align:right;"  type="checkbox" name="select_product[]"    id="select_product_' + v.s_item_id + '" class="select_product_' + (Number(i) + 1) + '" value="' + v.s_item_id + '"></td>';
                        str += '<td><input onclick="calculateSubtotal('+(Number(i) + 1)+')" style="width:40px;text-align:right;"  type="checkbox" name="select_product[]"    id="select_product_' +(Number(i) + 1)+ '" class="select_product_' + (Number(i) + 1) + '" value="' + v.s_item_id + '"></td>';
                        str += '</tr>';
                    });

                    //  $('#sub_total').val(total);       
                    $('#challan_items').append(str);

                    var str1 = '';
                    var due_qty;
                    
                    var stock_qty='';
                    var str2='';

                    $(msg.order_products).each(function (j, w) {
                        if (w.delivery_quantity != null) {
                            due_qty = Number(w.quantity) - Number(w.delivery_quantity);
                            stock_qty = Number(w.production_qty) - Number(w.delivery_quantity);
                        } else {
                            due_qty = Number(w.quantity);
                            stock_qty = Number(w.production_qty) - Number(w.delivery_quantity);
                        }
                        //alert(w.delivery_quantity);
                        str1 += '<tr>';
                        str1 += '<td><input readonly style="width:140px;"  type="text"  name="product_name[]" id="product_name_" class="issue" value="' + w.product_name + '"></td>';
                        //str1 += '<td><input readonly  style="width:140px;text-align:right;"  type="text"  name="order_quantity[]" id="order_quantity_' + (Number(j) + 1) + '" class="issue" value="' + w.quantity + '"></td>';
                        str1 += '<td><input readonly  style="width:140px;text-align:right;"  type="text"  name="order_quantity[]" id="order_quantity_' + (Number(j) + 1) + '" class="issue" value="' +w.quantity+ '"></td>';
                        if (w.delivery_quantity == null) {
                            str1 += '<td><input readonly   style="width:140px;text-align:right;"  type="text"  name="delivery_quantity[]" id="delivery_quantity_' + (Number(j) + 1) + '" class="issue" value="' + '' + '"></td>';
                        } else {
                            str1 += '<td><input readonly   style="width:140px;text-align:right;"  type="text"  name="delivery_quantity[]" id="delivery_quantity_' + (Number(j) + 1) + '" class="issue" value="' + w.delivery_quantity + '"></td>';

                        }
                        str1 += '<td><input readonly  style="width:140px;text-align:right;"  type="text" class="amount_"  name="due_quantity[]" id="due_quantity_' + w.s_item_id + '" class="issue" value="' + due_qty + '"></td>';
                        str1 += '</tr>';
                        
                        
                        str2 += '<tr>';
                        str2 += '<td><input readonly style="width:140px;"  type="text"  name="product_name[]" id="product_name_" class="issue" value="' + w.product_name + '"></td>';
                        if (w.production_qty == null) {
                            str2 += '<td><input readonly  style="width:140px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' +''+ '"></td>';
                        }else{
                            str2 += '<td><input readonly  style="width:140px;text-align:right;"  type="text"  name="prduction_quantity[]" id="production_quantity_' + (Number(j) + 1) + '" class="issue" value="' + w.production_qty + '"></td>';
                        }    
                        
                        if(w.delivery_quantity == null) {
                            str2 += '<td><input readonly   style="width:140px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_'+(Number(j)+ 1)+'" class="issue" value="' + '' + '"></td>';
                        } else {
                            str2 += '<td><input readonly   style="width:140px;text-align:right;"  type="text"  name="d_quantity[]" id="d_quantity_' +(Number(j)+1)+'" class="issue" value="' + w.delivery_quantity + '"></td>';

                        }
                        str2 += '<td><input readonly  style="width:140px;text-align:right;"  type="text" class="stock_quantity_'+(Number(j)+1)+'"  name="stock_quantity[]" id="stock_quantity_' +(Number(j)+1)+'" class="issue" value="'+stock_qty+'"></td>';
                        str2 += '</tr>';
                        
                        
                    });

                    $('#order_items').append(str1);
                    $('#production_items').append(str2);


                }

            })
        } else {
            $('#challan_items tr').remove();
            $('#order_items tr').remove();
            $('#production_items tr').remove();
            
            $('#sub_total').val('');
            $('#challan_code').val('');
            $('#dc_no').val('');
            $('#customer_id').val('');
            $('#attention').val('');
            $('#phone').val('');
            $('#project_name').val('');
            $('#project_id').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            
            $('#contact_person').val('');
            $('#contact_no').val('');
        }
    });
    
    
    function calculateSubtotal(id) {

        $('.number').on('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);
        });

        var so_quantity = Number($('#so_quantity_' + id).val());
        var sub_total = 0;
        var unit_price = $('#unit_price_' + id).val();
        var quantity = Number($('#quantity_' + id).val());
        var amount = Number(unit_price) * Number(quantity);

     


        var rowCount = $('#myTable tr').length;
        var table_row = Number(rowCount) - 2;

        if (quantity != '' || quantity != 0) {
            if (quantity <= so_quantity) {
                $('#amount_' + id).val(amount);

                for (var i = 1; i <= table_row; i++) {
                        var amt = $('.amount_' + i).val();
                        sub_total = sub_total + Number(amt);                 
               }

            } else {
                $('#amount_' + id).val('');
                $('#quantity_' + id).val('');
                for (var i = 1; i <= table_row; i++) {
                  
                        var amt = $('.amount_' + i).val();
                        sub_total = sub_total + Number(amt);
                    

                }
            }
        } else {
            $('#amount_' + id).val('');
            $('#quantity_' + id).val('');
            for (var i = 1; i <= table_row; i++) {          
                    var amt = $('.amount_' + i).val();
                    sub_total = sub_total + Number(amt);
                
            }
        }

        $('#sub_total').val(sub_total);



    }
    
   
</script>


