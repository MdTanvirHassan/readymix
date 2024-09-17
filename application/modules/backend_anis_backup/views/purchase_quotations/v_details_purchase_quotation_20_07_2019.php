<?php

        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        
       
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>View Quotation</h3>
            </div>
        </div>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                      <form action="<?php echo site_url('purchase_quotations/edit_quotation_action/'.$quotation_info[0]['q_id']); ?>" method="post" onsubmit="javascript: return validation()" >
                       <div class="row" style="margin-left:0px;margin-top:5px;">       
                          <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Q.No.:
                                </label> 
                    
                                <div class="col-sm-4 input-group">
                                       <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                       <input class="form-control" id="q_code" name="q_code" type="hidden" value="">
                                       <input readonly  class="form-control" id="reference_no" name="reference_no" type="text" value="<?php if(!empty($quotation_info[0]['reference_no'])) echo $quotation_info[0]['reference_no']; ?>">
                                </div>
                                    <label for="title" class="col-sm-2 control-label">
                                        Date <sup class="required">*</sup>
                               </label>
                              <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control datepicker" id="quotation_date" name="quotation_date" type="text" value="<?php if(!empty($quotation_info[0]['quotation_date'])) echo date('d-m-Y',strtotime($quotation_info[0]['quotation_date'])); ?>">
                            </div>
                             
                         </div>
                       </div>
                        <div class="row" style="margin-left:0px;margin-top:5px;">    
                            <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label">
                                        Project <sup class="required">*</sup>:
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                      <select  id="unit_id" class="form-control e1" name="unit_id">
                                                <option class="form-control" value="">Select Unit</option>
                                                <?php foreach($projects as $project){ ?>
                                                    <option <?php if($project['d_id']==$quotation_info[0]['unit_id']) echo 'selected'; ?> class="form-control" value="<?php echo $project['d_id'] ?>"><?php echo $project['dep_description']; ?></option>
                                                <?php } ?>
                                    </select>
                        <span id="category_id_error" style="color:red"></span>
                                 </div>
                                 <label for="title" class="col-sm-2 control-label">
                                     Billing Address :
                                 </label>
                                <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                        <input  class="form-control" id="billing_address" name="billing_address" type="text" placeholder="Billing Address" value="<?php if(!empty($quotation_info[0]['billing_address'])) echo $quotation_info[0]['billing_address']; ?>">
                                        <span id="billing_address_error" style="color:red"></span>
                               </div>
                             
                         </div>
                        </div>  
                         <div class="row" style="margin-left:0px;margin-top:5px;">   
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Billing Email :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="billing_email" name="billing_email" type="text" placeholder="Billing Email" value="<?php if(!empty($quotation_info[0]['billing_email'])) echo $quotation_info[0]['billing_email']; ?>">
                                    <span id="billing_email_error" style="color:red"></span>

                                </div>
                             
                                <label for="title" class="col-sm-2 control-label">
                                    Delivery Address :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="shipping_address" name="shipping_address" type="text" placeholder="Delivery Address" value="<?php if(!empty($quotation_info[0]['shipping_address'])) echo $quotation_info[0]['shipping_address']; ?>">
                                    <span id="shipping_address_error" style="color:red"></span>

                                </div>
                             
                         </div>
                         </div> 
                         <div class="row" style="margin-left:0px;margin-top:5px;">   
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Delivery Email :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="shipping_email" name="shipping_email" type="text" placeholder="Delivery Email" value="<?php if(!empty($quotation_info[0]['shipping_email'])) echo $quotation_info[0]['shipping_email']; ?>">
                                    <span id="shipping_email_error" style="color:red"></span>

                                </div>
                             
                             <label for="title" class="col-sm-2 control-label">
                                    Supplier :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  id="supplier_id" class="form-control e1" name="supplier_id">
                                        <option class="form-control" value="">Select Supplier</option>
                                        <?php foreach($suppliers as $supplier){ ?>
                                            <option <?php if($supplier['ID']==$quotation_info[0]['supplier_id']) echo 'selected'; ?> class="form-control" value="<?php echo $supplier['ID'] ?>"><?php echo $supplier['SUP_NAME'] ?></option>
                                        <?php } ?>
                                   </select>
                                    <span id="customer_id_error" style="color:red"></span>

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
                                    <input  class="form-control" id="attention" name="attention" type="text" placeholder="Attention Person Name" value="<?php if(!empty($quotation_info[0]['attention'])) echo $quotation_info[0]['attention']; ?>">
                                    <span id="attention_error" style="color:red"></span>

                                </div>
                             
                             <label for="title" class="col-sm-2 control-label">
                                    Contact No. :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="phone" name="phone" type="text" placeholder="Phone" value="<?php if(!empty($quotation_info[0]['phone'])) echo $quotation_info[0]['phone']; ?>">
                                    <span id="phone_error" style="color:red"></span>

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

                                 <th>
                                     <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" id="button1" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                                 </th>
                              </tr>
                            </thead>
                            <tbody id="quotation_item">
                                <?php 
                            $i=0;
                           foreach($quotation_details_info as $quotation_detail){ 
                                 $i++;
                            ?>
                            <tr  id="row_<?php echo $i; ?>">

                                <td> <select style="width:200px;" class="e1" style="width:100px;" id="item_<?php echo $i; ?>" name="item_id[]" onchange="javascript:item_info(<?php echo $i; ?>);">
                                        <option value="">Select Item</option>
                                        <?php foreach($items as $item){ ?>
                                            <option <?php if($item['id']==$quotation_detail['item_id']) echo 'selected'; ?> value="<?php echo $item['id'];  ?>"><?php if(!empty($item['item_code'])) echo $item['item_code']."(". $item['item_name'].")"; ?></option>
                                        <?php } ?>
                                </select></td>
                                <td><input style="width:80px;" disabled type="text"  name="m_unit[]" id="m_unit_<?php echo $i; ?>" class="issue" value="<?php echo $quotation_detail['meas_unit']; ?>"></td>
                                <td><input required style="width:80px;"  type="text" onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"  name="quantity[]" id="quantity_<?php echo $i; ?>" class="number issue" value="<?php echo $quotation_detail['quantity']; ?>"></td>
                                <td><input required style="width:80px;"  type="text" onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"  name="unit_price[]" id="unit_price_<?php echo $i; ?>" class="number issue" value="<?php echo $quotation_detail['unit_price']; ?>"></td>
                                <td><input required style="width:140px;" readonly  type="text"  name="amount[]" id="amount_<?php echo $i; ?>" class="issue" value="<?php echo $quotation_detail['amount']; ?>"></td>
                                <td><input style="width:140px;"  type="text"  name="remark[]" id="remark_<?php echo $i; ?>" class="issue" value="<?php echo $quotation_detail['remark']; ?>"></td>
                                <?php if ($i > 1) { ?>
                                <td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow('<?php echo $i; ?>')" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-minus"></span></button></td>
                            <?php } else { ?>
                                <td></td>
                                    <?php } ?>


                          </tr>
                   <?php } ?>

                            </tbody>
                               <tfoot>
                                    <tr>
                                        <td colspan="4" style="text-align:right;">Subtotal:</td>

                                        <td colspan="3"><input readonly style="width:140px;text-align: right;" id="sub_total"  name="total_amount" type="text" value="<?php if(!empty($quotation_info[0]['total_amount'])) echo $quotation_info[0]['total_amount']; ?>"></td>
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
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_cash"><input onclick="enablePaymentCondition('b_cash')" id="b_cash" type="checkbox" <?php if($payment_info[0]['b_cash']=="Cash") echo 'checked'; ?> name="b_cash" value="Cash">&nbsp;Cash</label></div>
                         <div class="col-sm-4 col-md-2 ">
                           <input style="text-align: right;" class="number form-control" id="b_cash_tenor" name="b_cash_tenor" type="text" placeholder="T. Day" value="<?php if(!empty($payment_info[0]['b_cash_tenor'])) echo $payment_info[0]['b_cash_tenor']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input required style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('b_cash_percent')" onchange="calculatePercentAmount('b_cash_percent')" onblur="calculatePercentAmount('b_cash_percent')" id="b_cash_percent" name="b_cash_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_cash_percent'])) echo $payment_info[0]['b_cash_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" class="number form-control" id="b_cash_amount" name="b_cash_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_cash_amount'])) echo $payment_info[0]['b_cash_amount']; ?>">
                        </div>
                       
                     <?php }else{ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_cash"><input onclick="enablePaymentCondition('b_cash')" id="b_cash" type="checkbox"  name="b_cash" value="Cash">&nbsp;Cash</label></div>
                        <div class="col-sm-4 col-md-2 ">
                          <input readonly style="text-align: right;" class="number form-control" id="b_cash_tenor" name="b_cash_tenor" type="text" placeholder="T. Day">
                       </div>
                       <div class="col-sm-4 col-md-2 ">
                          <input readonly style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('b_cash_percent')" onchange="calculatePercentAmount('b_cash_percent')" onblur="calculatePercentAmount('b_cash_percent')" id="b_cash_percent" name="b_cash_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_cash_percent'])) echo $payment_info[0]['b_cash_percent']; ?>">
                       </div>
                        <div class="col-sm-4 col-md-3 ">
                          <input readonly style="text-align: right;" class="number form-control" id="b_cash_amount" name="b_cash_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_cash_amount'])) echo $payment_info[0]['b_cash_amount']; ?>">
                       </div>
                        
                     <?php } ?>
                </div>
                 <div class="form-group row">
                   <?php if(!empty($payment_info[0]['b_bg'])){ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_bg"><input onclick="enablePaymentCondition('b_bg')" id="b_bg" type="checkbox" <?php if($payment_info[0]['b_bg']=="Bg") echo 'checked'; ?> name="b_bg" value="Bg">&nbsp;BG</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input required style="text-align: right;" class="number form-control" id="b_bg_tenor" name="b_bg_tenor" type="text" placeholder="T. Day" value="<?php if(!empty($payment_info[0]['b_bg_tenor'])) echo $payment_info[0]['b_bg_tenor']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input required style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('b_bg_percent')" onchange="calculatePercentAmount('b_bg_percent')" onblur="calculatePercentAmount('b_bg_percent')" id="b_bg_percent" name="b_bg_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_bg_percent'])) echo $payment_info[0]['b_bg_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" class="number form-control" id="b_bg_amount" name="b_bg_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_bg_amount'])) echo $payment_info[0]['b_bg_amount']; ?>">
                        </div>
                        
                  <?php }else{ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_bg"><input onclick="enablePaymentCondition('b_bg')" id="b_bg" type="checkbox"  name="b_bg" value="Bg">&nbsp;BG</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input readonly style="text-align: right;" class="number form-control" id="b_bg_tenor" name="b_bg_tenor" type="text" placeholder="T. Day" value="<?php if(!empty($payment_info[0]['b_bg_tenor'])) echo $payment_info[0]['b_bg_tenor']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input readonly style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('b_bg_percent')" onchange="calculatePercentAmount('b_bg_percent')" onblur="calculatePercentAmount('b_bg_percent')" id="b_bg_percent" name="b_bg_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_bg_percent'])) echo $payment_info[0]['b_bg_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" class="number form-control" id="b_bg_amount" name="b_bg_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_bg_amount'])) echo $payment_info[0]['b_bg_amount']; ?>">
                        </div>
                        
                  <?php } ?>
                </div>
                
                <div class="form-group row">
                  <?php if(!empty($payment_info[0]['b_lc'])){ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_lc"><input onclick="enablePaymentCondition('b_lc')" id="b_lc" name="b_lc" type="checkbox" <?php if($payment_info[0]['b_lc']=="Lc") echo 'checked'; ?> value="Lc">&nbsp;LC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input required style="text-align: right;" class="number form-control" id="b_lc_tenor" name="b_lc_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['b_lc_tenor'])) echo $payment_info[0]['b_lc_tenor']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-2 ">
                           <input required style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('b_lc_percent')" onchange="calculatePercentAmount('b_lc_percent')" onblur="calculatePercentAmount('b_lc_percent')" id="b_lc_percent" name="b_lc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_lc_percent'])) echo $payment_info[0]['b_lc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" class="number form-control" id="b_lc_amount" name="b_lc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_lc_amount'])) echo $payment_info[0]['b_lc_amount']; ?>">
                        </div>
                       
                  <?php }else{ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_lc"><input onclick="enablePaymentCondition('b_lc')" id="b_lc" name="b_lc" type="checkbox"  value="Lc">&nbsp;LC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input readonly style="text-align: right;" class="number form-control" id="b_lc_tenor" name="b_lc_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['b_lc_tenor'])) echo $payment_info[0]['b_lc_tenor']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-2 ">
                           <input readonly style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('b_lc_percent')" onchange="calculatePercentAmount('b_lc_percent')" onblur="calculatePercentAmount('b_lc_percent')" id="b_lc_percent" name="b_lc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_lc_percent'])) echo $payment_info[0]['b_lc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" class="number form-control" id="b_lc_amount" name="b_lc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_lc_amount'])) echo $payment_info[0]['b_lc_amount']; ?>">
                        </div>
                        
                   <?php } ?>  
                </div>
                
                 <div class="form-group row">
                     <?php if(!empty($payment_info[0]['b_pdc'])){ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_pdc"><input onclick="enablePaymentCondition('b_pdc')" id="b_pdc" type="checkbox" <?php if($payment_info[0]['b_pdc']=="Pdc") echo 'checked'; ?> name="b_pdc" value="Pdc">&nbsp;PDC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input required style="text-align: right;" class="number form-control" id="b_pdc_check" name="b_pdc_check" type="text" placeholder="T.Ch." value="<?php if(!empty($payment_info[0]['b_pdc_check'])) echo $payment_info[0]['b_pdc_check']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input required style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('b_pdc_percent')" onchange="calculatePercentAmount('b_pdc_percent')" onblur="calculatePercentAmount('b_pdc_percent')" id="b_pdc_percent" name="b_pdc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_pdc_percent'])) echo $payment_info[0]['b_pdc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" class="number form-control" id="b_pdc_amount" name="b_pdc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_pdc_amount'])) echo $payment_info[0]['b_pdc_amount']; ?>">
                        </div>
                       
                   <?php }else{ ?>
                            <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_pdc"><input onclick="enablePaymentCondition('b_pdc')" id="b_pdc" type="checkbox"  name="b_pdc" value="Pdc">&nbsp;PDC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input readonly class="form-control" id="b_pdc_check" name="b_pdc_check" type="text" placeholder="T.Ch." value="<?php if(!empty($payment_info[0]['b_pdc_check'])) echo $payment_info[0]['b_pdc_check']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input readonly style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('b_pdc_percent')" onchange="calculatePercentAmount('b_pdc_percent')" onblur="calculatePercentAmount('b_pdc_percent')" id="b_pdc_percent" name="b_pdc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_pdc_percent'])) echo $payment_info[0]['b_pdc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" class="number form-control" id="b_pdc_amount" name="b_pdc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_pdc_amount'])) echo $payment_info[0]['b_pdc_amount']; ?>">
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
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="a_cash"><input onclick="enablePaymentCondition('a_cash')" id="a_cash" type="checkbox" <?php if($payment_info[0]['a_cash']=="Cash") echo 'checked'; ?> name="a_cash" value="Cash">&nbsp;Cash</label></div>
                         <div class="col-sm-4 col-md-2 ">
                           <input style="text-align: right;" class="number form-control" id="a_cash_tenor" name="a_cash_tenor" type="text" placeholder="T. Day" value="<?php if(!empty($payment_info[0]['a_cash_tenor'])) echo $payment_info[0]['a_cash_tenor']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                            <input required style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('a_cash_percent')" onchange="calculatePercentAmount('a_cash_percent')" onblur="calculatePercentAmount('a_cash_percent')" id="a_cash_percent" name="a_cash_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_cash_percent'])) echo $payment_info[0]['a_cash_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" class="number form-control"  id="a_cash_amount" name="a_cash_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_cash_amount'])) echo $payment_info[0]['a_cash_amount']; ?>">
                        </div>
                <?php }else{ ?>
                         <div class="col-sm-4 col-md-2   labeltext" style=""><label for="a_cash"><input onclick="enablePaymentCondition('a_cash')" id="a_cash" type="checkbox"  name="a_cash" value="Cash">&nbsp;Cash</label></div>
                         <div class="col-sm-4 col-md-2 ">
                           <input readonly style="text-align: right;" class="number form-control" id="a_cash_tenor" name="a_cash_tenor" type="text" placeholder="T. Day">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                            <input readonly style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('a_cash_percent')" onchange="calculatePercentAmount('a_cash_percent')" onblur="calculatePercentAmount('a_cash_percent')" id="a_cash_percent" name="a_cash_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_cash_percent'])) echo $payment_info[0]['a_cash_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" class="number form-control"  id="a_cash_amount" name="a_cash_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_cash_amount'])) echo $payment_info[0]['a_cash_amount']; ?>">
                        </div>
                <?php } ?> 
                </div>
                
                <div class="form-group row">
                    <?php if(!empty($payment_info[0]['a_bg'])){ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="a_bg"><input onclick="enablePaymentCondition('a_bg')" id="a_bg" type="checkbox" <?php if($payment_info[0]['a_bg']=="Bg") echo 'checked'; ?> name="a_bg" value="Bg">&nbsp;BG</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input required style="text-align: right;" class="number form-control" id="a_bg_tenor" name="a_bg_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['a_bg_tenor'])) echo $payment_info[0]['a_bg_tenor']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input required style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('a_bg_percent')" onchange="calculatePercentAmount('a_bg_percent')" onblur="calculatePercentAmount('a_bg_percent')" id="a_bg_percent" name="a_bg_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_bg_percent'])) echo $payment_info[0]['a_bg_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" class="number form-control" id="a_bg_amount" name="a_bg_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_bg_amount'])) echo $payment_info[0]['a_bg_amount']; ?>">
                        </div>
                    <?php }else{ ?>
                         <div class="col-sm-4 col-md-2   labeltext" style=""><label for="a_bg"><input onclick="enablePaymentCondition('a_bg')" id="a_bg" type="checkbox"  name="a_bg" value="Bg">&nbsp;BG</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input readonly style="text-align: right;" class="number form-control" id="a_bg_tenor" name="a_bg_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['a_bg_tenor'])) echo $payment_info[0]['a_bg_tenor']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input readonly style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('a_bg_percent')" onchange="calculatePercentAmount('a_bg_percent')" onblur="calculatePercentAmount('a_bg_percent')" id="a_bg_percent" name="a_bg_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_bg_percent'])) echo $payment_info[0]['a_bg_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" class="number form-control" id="a_bg_amount" name="a_bg_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_bg_amount'])) echo $payment_info[0]['a_bg_amount']; ?>">
                        </div>
                    <?php } ?>      
                </div>
                <div class="form-group row">
                    <?php if(!empty($payment_info[0]['a_lc'])){ ?>
                        <div class="col-sm-4 col-md-2 labeltext" style=""><label for="a_lc"><input onclick="enablePaymentCondition('a_lc')" id="a_lc" type="checkbox" <?php if($payment_info[0]['a_lc']=="Lc") echo 'checked'; ?> name="a_lc" value="Lc">&nbsp;LC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input required  style="text-align: right;" class="number form-control" id="a_lc_tenor" name="a_lc_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['a_lc_tenor'])) echo $payment_info[0]['a_lc_tenor']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-2 ">
                           <input required style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('a_lc_percent')" onchange="calculatePercentAmount('a_lc_percent')" onblur="calculatePercentAmount('a_lc_percent')" id="a_lc_percent" name="a_lc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_lc_percent'])) echo $payment_info[0]['a_lc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" class="number form-control" id="a_lc_amount" name="a_lc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_lc_amount'])) echo $payment_info[0]['a_lc_amount']; ?>">
                        </div>
                    <?php }else{ ?>
                        <div class="col-sm-4 col-md-2 labeltext" style=""><label for="a_lc"><input onclick="enablePaymentCondition('a_lc')" id="a_lc" type="checkbox"  name="a_lc" value="Lc">&nbsp;LC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input readonly style="text-align: right;" class="number form-control" id="a_lc_tenor" name="a_lc_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['a_lc_tenor'])) echo $payment_info[0]['a_lc_tenor']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-2 ">
                           <input readonly style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('a_lc_percent')" onchange="calculatePercentAmount('a_lc_percent')" onblur="calculatePercentAmount('a_lc_percent')" id="a_lc_percent" name="a_lc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_lc_percent'])) echo $payment_info[0]['a_lc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" class="number form-control" id="a_lc_amount" name="a_lc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_lc_amount'])) echo $payment_info[0]['a_lc_amount']; ?>">
                        </div>
                    <?php } ?>      
                </div>
                
                
                 <div class="form-group row">
                     <?php if(!empty($payment_info[0]['a_pdc'])){ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="a_pdc"><input onclick="enablePaymentCondition('a_pdc')" id="a_pdc" type="checkbox" <?php if($payment_info[0]['a_pdc']=="Pdc") echo 'checked'; ?> name="a_pdc" value="Pdc">&nbsp;PDC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input required style="text-align: right;" class="number form-control" id="a_pdc_check" name="a_pdc_check" type="text" placeholder="T.Ch." value="<?php if(!empty($payment_info[0]['a_pdc_check'])) echo $payment_info[0]['a_pdc_check']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input required style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('a_pdc_percent')" onchange="calculatePercentAmount('a_pdc_percent')" onblur="calculatePercentAmount('a_pdc_percent')" id="a_pdc_percent" name="a_pdc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_pdc_percent'])) echo $payment_info[0]['a_pdc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" class="number form-control" id="a_pdc_amount" name="a_pdc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_pdc_amount'])) echo $payment_info[0]['a_pdc_amount']; ?>">
                        </div>
                     <?php }else{ ?>  
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="a_pdc"><input onclick="enablePaymentCondition('a_pdc')" id="a_pdc" type="checkbox"  name="a_pdc" value="Pdc">&nbsp;PDC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input readonly style="text-align: right;" class="number form-control" id="a_pdc_check" name="a_pdc_check" type="text" placeholder="T.Ch." value="<?php if(!empty($payment_info[0]['a_pdc_check'])) echo $payment_info[0]['a_pdc_check']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-2 ">
                           <input readonly style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('a_pdc_percent')" onchange="calculatePercentAmount('a_pdc_percent')" onblur="calculatePercentAmount('a_pdc_percent')" id="a_pdc_percent" name="a_pdc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_pdc_percent'])) echo $payment_info[0]['a_pdc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" class="number form-control" id="a_pdc_amount" name="a_pdc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_pdc_amount'])) echo $payment_info[0]['a_pdc_amount']; ?>">
                        </div>
                    <?php } ?> 
                </div>
                
            </div><!--End Col-md-6-->
            
        </div>
         </div>   
        
        <hr>
                
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/purchase_quotations') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
                    <!--
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">SAVE</button>
                    </div>
                  -->
                    
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

