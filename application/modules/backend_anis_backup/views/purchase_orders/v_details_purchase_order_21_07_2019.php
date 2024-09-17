<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');      
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Details Order</h3>
            </div>
        </div>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                      <form action="<?php echo site_url('purchase_orders/edit_purchase_order_action/'.$purchase_order_info[0]['o_id']); ?>" method="post" onsubmit="javascript: return validation()" >
                        <div class="row" style="margin-left:0px;">   
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Q.No.:
                                </label> 
                    
                                <div class="col-sm-6 input-group">
                                       <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <select disabled  id="q_id" class="form-control e1" name="q_id">
                                                <option class="form-control" value="">Select Quotation</option>
                                                <?php foreach($quotations as $quotation){ ?>
                                                    <option <?php if($quotation['q_id']==$purchase_order_info[0]['q_id']) echo "selected"; ?> class="form-control" value="<?php echo $quotation['q_id'] ?>"><?php echo $quotation['reference_no'].'('.$quotation['dep_description'].')('.$quotation['SUP_NAME'].')'; ?></option>
                                                <?php } ?>
                                    </select>
                                </div>
                                    <label for="title" class="col-sm-2 control-label">
                                        
                               </label>
                              <div class="col-sm-2 input-group">
                                  
                                   
                            </div>
                             
                         </div>
                        </div>  
                          
                         <div class="row" style="margin-left:0px;margin-top:5px;"> 
                                <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label">
                                        Order No <sup class="required">*</sup>:
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                       <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                       <input disabled  required class="form-control" readonly id="order_no" name="order_no" type="text" value="<?php if(!empty($purchase_order_info[0]['order_no'])) echo $purchase_order_info[0]['order_no']; ?>">
                                 </div>
                                 <label for="title" class="col-sm-2 control-label">
                                    Date :
                                 </label>
                                <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                        <input disabled required class="form-control datepicker" id="purchase_order_date" name="purchase_order_date" type="text" value="<?php if(!empty($purchase_order_info[0]['purchase_order_date'])) echo date('d-m-Y',strtotime($purchase_order_info[0]['purchase_order_date'])); ?>">
                                        <span id="purchase_order_date_error" style="color:red"></span>
                               </div>
                             
                         </div>
                             
                         </div>    
                          <div class="row" style="margin-left:0px;margin-top:5px;">
                                <div class='form-group' >
                                    
                               <label for="title" class="col-sm-2 control-label">
                                    Billing Address :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input disabled  class="form-control" id="billing_address" name="billing_address" type="text" placeholder="Billing Address" value="<?php if(!empty($purchase_order_info[0]['billing_address'])) echo $purchase_order_info[0]['billing_address']; ?>">
                                    <span id="billing_address_error" style="color:red"></span>

                                </div>
                                    
                                <label for="title" class="col-sm-2 control-label">
                                    Billing Email :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input disabled  class="form-control" id="billing_email" name="billing_email" type="text" placeholder="Billing Email" value="<?php if(!empty($purchase_order_info[0]['billing_email'])) echo $purchase_order_info[0]['billing_email']; ?>">
                                    <span id="billing_email_error" style="color:red"></span>

                                </div>
                             
                               
                         </div>
                          </div> 
                          
                          <div class="row" style="margin-left:0px;margin-top:5px;">
                              
                               <label for="title" class="col-sm-2 control-label">
                                    Delivery Address :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input disabled  class="form-control" id="shipping_address" name="shipping_address" type="text" placeholder="Delivery Address" value="<?php if(!empty($purchase_order_info[0]['shipping_address'])) echo $purchase_order_info[0]['shipping_address']; ?>">
                                    <span id="shipping_address_error" style="color:red"></span>

                                </div>
                             
                              
                                <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Delivery Email :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input disabled  class="form-control" id="shipping_email" name="shipping_email" type="text" placeholder="Delivery Email" value="<?php if(!empty($purchase_order_info[0]['shipping_email'])) echo $purchase_order_info[0]['shipping_email']; ?>">
                                    <span id="shipping_email_error" style="color:red"></span>

                                </div>
                             
                             
                             
                         </div> 
                          </div>    
                          <div class="row" style="margin-left:0px;margin-top:5px;">
                                <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Attention :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input disabled  class="form-control" id="attention" name="attention" type="text" placeholder="Attention Person Name" value="<?php if(!empty($purchase_order_info[0]['attention'])) echo $purchase_order_info[0]['attention']; ?>">
                                    <span id="attention_error" style="color:red"></span>

                                </div>
                             
                             <label for="title" class="col-sm-2 control-label">
                                    Contact No. :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input disabled  class="form-control" id="phone" name="phone" type="text" placeholder="Phone" value="<?php if(!empty($purchase_order_info[0]['phone'])) echo $purchase_order_info[0]['phone']; ?>">
                                    <span id="phone_error" style="color:red"></span>

                                </div>
                             
                         </div> 
                          </div>
                          <div class="row" style="margin-left:0px;margin-top:5px;">
                                <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            Prepared By :
                                        </label> 
                                        <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                             <select disabled id="employee_id" class="form-control e1" name="employee_id">
                                                <option class="form-control" value="">Select Employee</option>
                                                <?php foreach($employees as $employee){ ?>
                                                    <option <?php if($employee['id']==$purchase_order_info[0]['employee_id']) echo 'selected'; ?> class="form-control" value="<?php echo $employee['id'] ?>"><?php echo $employee['name'].'('.$employee['designation_short_name'].')' ?></option>
                                                <?php } ?>
                                            </select>
                                            <span id="employee_id_error" style="color:red"></span>

                                        </div>
                             
                                        <label for="title" class="col-sm-2 control-label">

                                           </label> 
                                           <div class="col-sm-4 input-group">


                                           </div>
                             
                                </div> 
                                </div>     
                          
                <hr>
             
                    <div class="row">
                    <input type="hidden" value="1" id="count" />
                             <table class="table table-bordered" id="myTable">
                             <thead>
                             <tr>

                                 <th>Item Name <sup style='color:red'>*</sup></th>
                                 <th>M. Unit</th>
                                 <th>Qnty<sup style='color:red'>*</sup></th>
                                 <th>Unit Price<sup style='color:red'>*</sup></th>
                                 <th>Value<sup style='color:red'>*</sup></th>
                                 <th>Remark</th>

                                 
                              </tr>
                            </thead>
                            <tbody id="purchase_items">
                                 <?php $i=0; foreach($purchase_order_details_info as $purchase_order_details){ 
                                        $i++;
                                        ?>
                                     <tr class="" id="row_<?php echo $i; ?>">
                                        <td><input  type="hidden"  name="item_id[]" id="product_id_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['item_id'] ?>"><input disabled style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="<?php echo $purchase_order_details['item_name'] ?>"></td>
                                        <td><input disabled   style="width:140px;"  type="text" class=""  name="m_unit[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['meas_unit'] ?>"></td>
                                        <td><input disabled  style="width:140px;text-align: right;"  type="text"  name="quantity[]" id="quantity_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['quantity'] ?>"></td>
                                        <td><input disabled  style="width:140px;text-align: right;"  type="text"  name="unit_price[]" id="unit_price_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['unit_price'] ?>"></td>    
                                        <td><input disabled   style="width:140px;text-align: right;"  type="text" class=""  name="amount[]" id="amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['amount'] ?>"></td>
                                        <td><input disabled  style="width:140px;"  type="text" class=""  name="remark[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['remark'] ?>"></td>

                                      </tr>
                                <?php } ?>
                                
                            </tbody>
                               <tfoot>
                                    <tr>
                                        <td colspan="4" style="text-align:right;">Subtotal:</td>

                                        <td colspan="3"><input disabled style="width:140px;text-align: right;" id="sub_total"  name="total_amount" type="text" value="<?php if(!empty($purchase_order_info[0]['total_amount'])) echo $purchase_order_info[0]['total_amount']; ?>"></td>
                                    </tr>
                                </tfoot>
                          </table>




                </div>
           
                
                <hr>
         <h2 style="text-align:center; ">Payment Conditions</h2>
        <button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="payment_hide_button"  class="btn btn-primary "><span class="glyphicon glyphicon-minus"></span></button>
        <button  type="button" style="display:none;padding-left:6px;padding-right:6px;font-size:8px;" id="payment_show_button"  class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span></button>
        <div id="payment_condition">  
            <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                         <div class="col-sm-4 col-md-8   " style="text-align:center"><b><span style="color:green;padding:5px;">Before Delivery</span></b></div>
                           
                         <div class="col-sm-8 col-md-4 " style="text-align:center">
                                <input type="hidden" id="remaining_balance" value="" />
                                <b style="color:green">Balance:<span id="balance"></span></b>
                        </div>
                </div>

                 <div class="form-group row">
                     <?php if(!empty($payment_info[0]['b_cash'])){ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_cash"><input disabled id="b_cash" type="checkbox" <?php if($payment_info[0]['b_cash']=="Cash") echo 'checked'; ?> name="b_cash" value="Cash">&nbsp;Cash</label></div>
                         <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control" id="b_cash_tenor" name="b_cash_tenor" type="text" placeholder="T. Day" value="<?php if(!empty($payment_info[0]['b_cash_tenor'])) echo $payment_info[0]['b_cash_tenor']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control" onkeyup="calculatePercentAmount('b_cash_percent')" onchange="calculatePercentAmount('b_cash_percent')" onblur="calculatePercentAmount('b_cash_percent')" id="b_cash_percent" name="b_cash_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_cash_percent'])) echo $payment_info[0]['b_cash_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input disabled style="text-align: right;" class="form-control" id="b_cash_amount" name="b_cash_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_cash_amount'])) echo $payment_info[0]['b_cash_amount']; ?>">
                        </div>
                       
                     <?php }else{ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_cash"><input disabled id="b_cash" type="checkbox"  name="b_cash" value="Cash">&nbsp;Cash</label></div>
                        <div class="col-sm-4 col-md-2 ">
                          <input disabled style="text-align: right;" class="form-control" id="b_cash_tenor" name="b_cash_tenor" type="text" placeholder="T. Day">
                       </div>
                       <div class="col-sm-4 col-md-2 ">
                          <input disabled style="text-align: right;" class="form-control" onkeyup="calculatePercentAmount('b_cash_percent')" onchange="calculatePercentAmount('b_cash_percent')" onblur="calculatePercentAmount('b_cash_percent')" id="b_cash_percent" name="b_cash_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_cash_percent'])) echo $payment_info[0]['b_cash_percent']; ?>">
                       </div>
                        <div class="col-sm-4 col-md-3 ">
                          <input disabled style="text-align: right;" class="form-control" id="b_cash_amount" name="b_cash_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_cash_amount'])) echo $payment_info[0]['b_cash_amount']; ?>">
                       </div>
                        
                     <?php } ?>
                </div>
                 <div class="form-group row">
                   <?php if(!empty($payment_info[0]['b_bg'])){ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_bg"><input disabled id="b_bg" type="checkbox" <?php if($payment_info[0]['b_bg']=="Bg") echo 'checked'; ?> name="b_bg" value="Bg">&nbsp;BG</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control" id="b_bg_tenor" name="b_bg_tenor" type="text" placeholder="T. Day" value="<?php if(!empty($payment_info[0]['b_bg_tenor'])) echo $payment_info[0]['b_bg_tenor']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control"  id="b_bg_percent" name="b_bg_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_bg_percent'])) echo $payment_info[0]['b_bg_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input disabled style="text-align: right;" class="form-control" id="b_bg_amount" name="b_bg_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_bg_amount'])) echo $payment_info[0]['b_bg_amount']; ?>">
                        </div>
                        
                  <?php }else{ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_bg"><input disabled id="b_bg" type="checkbox"  name="b_bg" value="Bg">&nbsp;BG</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control" id="b_bg_tenor" name="b_bg_tenor" type="text" placeholder="T. Day" value="<?php if(!empty($payment_info[0]['b_bg_tenor'])) echo $payment_info[0]['b_bg_tenor']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control"  id="b_bg_percent" name="b_bg_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_bg_percent'])) echo $payment_info[0]['b_bg_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input disabled style="text-align: right;" class="form-control" id="b_bg_amount" name="b_bg_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_bg_amount'])) echo $payment_info[0]['b_bg_amount']; ?>">
                        </div>
                        
                  <?php } ?>
                </div>

                <div class="form-group row">
                  <?php if(!empty($payment_info[0]['b_lc'])){ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_lc"><input disabled id="b_lc" name="b_lc" type="checkbox" <?php if($payment_info[0]['b_lc']=="Lc") echo 'checked'; ?> value="Lc">&nbsp;LC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control" id="b_lc_tenor" name="b_lc_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['b_lc_tenor'])) echo $payment_info[0]['b_lc_tenor']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control"  id="b_lc_percent" name="b_lc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_lc_percent'])) echo $payment_info[0]['b_lc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input disabled style="text-align: right;" class="form-control" id="b_lc_amount" name="b_lc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_lc_amount'])) echo $payment_info[0]['b_lc_amount']; ?>">
                        </div>
                        
                  <?php }else{ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_lc"><input  id="b_lc" name="b_lc" type="checkbox"  value="Lc">&nbsp;LC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control" id="b_lc_tenor" name="b_lc_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['b_lc_tenor'])) echo $payment_info[0]['b_lc_tenor']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control"  id="b_lc_percent" name="b_lc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_lc_percent'])) echo $payment_info[0]['b_lc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input disabled style="text-align: right;" class="form-control" id="b_lc_amount" name="b_lc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_lc_amount'])) echo $payment_info[0]['b_lc_amount']; ?>">
                        </div>
                        
                   <?php } ?>  
                </div>

                 <div class="form-group row">
                     <?php if(!empty($payment_info[0]['b_pdc'])){ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_pdc"><input  id="b_pdc" type="checkbox" <?php if($payment_info[0]['b_pdc']=="Pdc") echo 'checked'; ?> name="b_pdc" value="Pdc">&nbsp;PDC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control" id="b_pdc_check" name="b_pdc_check" type="text" placeholder="T.Ch." value="<?php if(!empty($payment_info[0]['b_pdc_check'])) echo $payment_info[0]['b_pdc_check']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control"  id="b_pdc_percent" name="b_pdc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_pdc_percent'])) echo $payment_info[0]['b_pdc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input disabled style="text-align: right;" class="form-control" id="b_pdc_amount" name="b_pdc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_pdc_amount'])) echo $payment_info[0]['b_pdc_amount']; ?>">
                        </div>
                       
                   <?php }else{ ?>
                            <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_pdc"><input  id="b_pdc" type="checkbox"  name="b_pdc" value="Pdc">&nbsp;PDC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control" id="b_pdc_check" name="b_pdc_check" type="text" placeholder="T.Ch." value="<?php if(!empty($payment_info[0]['b_pdc_check'])) echo $payment_info[0]['b_pdc_check']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control"  id="b_pdc_percent" name="b_pdc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_pdc_percent'])) echo $payment_info[0]['b_pdc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input disabled style="text-align: right;" class="form-control" id="b_pdc_amount" name="b_pdc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_pdc_amount'])) echo $payment_info[0]['b_pdc_amount']; ?>">
                        </div>
                        
                   <?php } ?>  
                </div>

            </div><!--End Col-md-6-->
            <div class="col-md-6">


                 <div class="form-group row">
                     <div class="col-sm-4 col-md-8" style="text-align:center"><b><span style="color:green;padding:5px;">After Delivery</span></b></div>
                </div>

                <div class="form-group row">
                    <?php if(!empty($payment_info[0]['a_cash'])){ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="a_cash"><input disabled id="a_cash" type="checkbox" <?php if($payment_info[0]['a_cash']=="Cash") echo 'checked'; ?> name="a_cash" value="Cash">&nbsp;Cash</label></div>
                         <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control" id="a_cash_tenor" name="a_cash_tenor" type="text" placeholder="T. Day" value="<?php if(!empty($payment_info[0]['a_cash_tenor'])) echo $payment_info[0]['a_cash_tenor']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                            <input disabled style="text-align: right;" class="form-control"  id="a_cash_percent" name="a_cash_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_cash_percent'])) echo $payment_info[0]['a_cash_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input disabled style="text-align: right;" class="form-control"  id="a_cash_amount" name="a_cash_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_cash_amount'])) echo $payment_info[0]['a_cash_amount']; ?>">
                        </div>
                <?php }else{ ?>
                         <div class="col-sm-4 col-md-2   labeltext" style=""><label for="a_cash"><input  id="a_cash" type="checkbox"  name="a_cash" value="Cash">&nbsp;Cash</label></div>
                         <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control" id="a_cash_tenor" name="a_cash_tenor" type="text" placeholder="T. Day">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                            <input disabled style="text-align: right;" class="form-control"  id="a_cash_percent" name="a_cash_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_cash_percent'])) echo $payment_info[0]['a_cash_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input disabled style="text-align: right;" class="form-control"  id="a_cash_amount" name="a_cash_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_cash_amount'])) echo $payment_info[0]['a_cash_amount']; ?>">
                        </div>
                <?php } ?> 
                </div>

                <div class="form-group row">
                    <?php if(!empty($payment_info[0]['a_bg'])){ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="a_bg"><input disabled id="a_bg" type="checkbox" <?php if($payment_info[0]['a_bg']=="Bg") echo 'checked'; ?> name="a_bg" value="Bg">&nbsp;BG</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control" id="a_bg_tenor" name="a_bg_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['a_bg_tenor'])) echo $payment_info[0]['a_bg_tenor']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control"  id="a_bg_percent" name="a_bg_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_bg_percent'])) echo $payment_info[0]['a_bg_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input disabled style="text-align: right;" class="form-control" id="a_bg_amount" name="a_bg_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_bg_amount'])) echo $payment_info[0]['a_bg_amount']; ?>">
                        </div>
                    <?php }else{ ?>
                         <div class="col-sm-4 col-md-2   labeltext" style=""><label for="a_bg"><input disabled id="a_bg" type="checkbox"  name="a_bg" value="Bg">&nbsp;BG</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control" id="a_bg_tenor" name="a_bg_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['a_bg_tenor'])) echo $payment_info[0]['a_bg_tenor']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control"  id="a_bg_percent" name="a_bg_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_bg_percent'])) echo $payment_info[0]['a_bg_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input disabled style="text-align: right;" class="form-control" id="a_bg_amount" name="a_bg_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_bg_amount'])) echo $payment_info[0]['a_bg_amount']; ?>">
                        </div>
                    <?php } ?>      
                </div>
                <div class="form-group row">
                    <?php if(!empty($payment_info[0]['a_lc'])){ ?>
                        <div class="col-sm-4 col-md-2 labeltext" style=""><label for="a_lc"><input disabled id="a_lc" type="checkbox" <?php if($payment_info[0]['a_lc']=="Lc") echo 'checked'; ?> name="a_lc" value="Lc">&nbsp;LC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled  style="text-align: right;" class="form-control" id="a_lc_tenor" name="a_lc_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['a_lc_tenor'])) echo $payment_info[0]['a_lc_tenor']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control"  id="a_lc_percent" name="a_lc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_lc_percent'])) echo $payment_info[0]['a_lc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input disabled style="text-align: right;" class="form-control" id="a_lc_amount" name="a_lc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_lc_amount'])) echo $payment_info[0]['a_lc_amount']; ?>">
                        </div>
                    <?php }else{ ?>
                        <div class="col-sm-4 col-md-2 labeltext" style=""><label for="a_lc"><input disabled id="a_lc" type="checkbox"  name="a_lc" value="Lc">&nbsp;LC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control" id="a_lc_tenor" name="a_lc_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['a_lc_tenor'])) echo $payment_info[0]['a_lc_tenor']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control"  id="a_lc_percent" name="a_lc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_lc_percent'])) echo $payment_info[0]['a_lc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input disabled style="text-align: right;" class="form-control" id="a_lc_amount" name="a_lc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_lc_amount'])) echo $payment_info[0]['a_lc_amount']; ?>">
                        </div>
                    <?php } ?>      
                </div>


                 <div class="form-group row">
                     <?php if(!empty($payment_info[0]['a_pdc'])){ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="a_pdc"><input disabled id="a_pdc" type="checkbox" <?php if($payment_info[0]['a_pdc']=="Pdc") echo 'checked'; ?> name="a_pdc" value="Pdc">&nbsp;PDC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control" id="a_pdc_check" name="a_pdc_check" type="text" placeholder="T.Ch." value="<?php if(!empty($payment_info[0]['a_pdc_check'])) echo $payment_info[0]['a_pdc_check']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control"  id="a_pdc_percent" name="a_pdc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_pdc_percent'])) echo $payment_info[0]['a_pdc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input disabled style="text-align: right;" class="form-control" id="a_pdc_amount" name="a_pdc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_pdc_amount'])) echo $payment_info[0]['a_pdc_amount']; ?>">
                        </div>
                     <?php }else{ ?>  
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="a_pdc"><input disabled id="a_pdc" type="checkbox"  name="a_pdc" value="Pdc">&nbsp;PDC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control" id="a_pdc_check" name="a_pdc_check" type="text" placeholder="T.Ch." value="<?php if(!empty($payment_info[0]['a_pdc_check'])) echo $payment_info[0]['a_pdc_check']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input disabled style="text-align: right;" class="form-control"  id="a_pdc_percent" name="a_pdc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_pdc_percent'])) echo $payment_info[0]['a_pdc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input disabled style="text-align: right;" class="form-control" id="a_pdc_amount" name="a_pdc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_pdc_amount'])) echo $payment_info[0]['a_pdc_amount']; ?>">
                        </div>
                    <?php } ?> 
                </div>

            </div><!--End Col-md-6-->

        </div>
        </div>
        
        
       <h2 style="text-align:center; ">Terms & Conditions</h2>
        <button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="specification_hide_button"  class="btn btn-primary "><span class="glyphicon glyphicon-minus"></span></button>
        <button  type="button" style="display:none;padding-left:6px;padding-right:6px;font-size:8px;" id="specification_show_button"  class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span></button>
        <div id="specification_raw_material">
            <div class="row">
                
            <?php if(!empty($purchase_conditions)){ ?> 
                <input type="hidden" value="<?php echo count($purchase_conditions) ?>" id="material_count" />
           <?php }else{ ?>
                <input type="hidden" value="1" id="material_count" />
           <?php } ?>  
                <table class="table table-bordered" id="specificationTable">
                    <thead>
                     <tr >
                       
                        <th>Term or Condition Name </th>
                        <th>Description</th>
                        

                      </tr>
                    </thead>
                    <tbody id="material_specification">
                     <?php $i=0; foreach($purchase_conditions as $purchase_condition){ 
                         $i++;
                         ?>
                        <tr id="row_<?php echo $i; ?>">
                            
                            <td><input disabled  style="width:250px"  type="text"  name="t_or_c_name[]"  class="issue form-control" value="<?php echo $purchase_condition['t_or_c_name']  ?>"></td>
                            <td><input disabled  style="width:350px"  type="text"  name="t_or_c_description[]"  class="issue form-control" value="<?php echo $purchase_condition['t_or_c_description']  ?>"></td>
                           
                        </tr>
                     <?php } ?> 
                    </tbody>
                     
                  </table> 
                
           
             
        </div> 
        </div> 
        
        <h2 style="text-align:center; ">Copy To</h2>
        <button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="copy_hide_button"  class="btn btn-primary "><span class="glyphicon glyphicon-minus"></span></button>
        <button  type="button" style="display:none;padding-left:6px;padding-right:6px;font-size:8px;" id="copy_show_button"  class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span></button>
        <div id="copy_div">
            <?php if(!empty($copy_to)){ ?>     
                <input type="hidden" value="<?php echo count($copy_to) ?>" id="copy_count" />
            <?php }else{ ?> 
                <input type="hidden" value="1" id="copy_count" />
            <?php } ?>   
                <table class="table table-bordered" id="specificationTable">
                    <thead>
                     <tr >
                  
                         <th>Description</th>
                         
                      </tr>
                    </thead>
                    <tbody id="copyTable">
                         <?php $i=0; foreach($copy_to as $copy){ 
                         $i++;
                         ?>
                        <tr id="row_<?php echo $i; ?>">
                            <td><input disabled  style="width:350px"  type="text"  name="copy_description[]"  class="issue form-control" value="<?php echo $copy['copy_description']  ?>"></td>
                           
                        </tr>
                     <?php } ?> 
                      
                    </tbody>
                     
                  </table>
             
        </div> 
        </div>  
        
        
        <hr>
                
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/purchase_orders') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
                    
                    
                    
                </div>
            
                <div class="row">
               
                    
                </div>
            
            </form>  
                    </div>
                    </div>
                    </div>
                    </div>
          
            
        </div>
        </div>

