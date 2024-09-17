<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Quotation</h2>
    <hr>
    <form action="<?php echo site_url('sale_quotations/edit_quotation_action/'.$quotation_info[0]['q_id']); ?>" method="post">
        <div class="row">
            
             <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Quotation Number<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                         
                         <input readonly  class="form-control" name="reference_no" type="text" value="<?php if(!empty($quotation_info[0]['reference_no'])) echo $quotation_info[0]['reference_no']; ?>">
                    </div>
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Date:</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control datepicker" name="quotation_date" type="text" value="<?php if(!empty($quotation_info[0]['quotation_date'])) echo date('d-m-Y',strtotime($quotation_info[0]['quotation_date'])); ?>"></div>
                </div>
            </div>
            
            
            
        </div>
          
         <div class="row">
               <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3   labeltext" style="text-align: right;"><label for="inputdefault">Product Type<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                         <select id="category_id" class="form-control e1" name="category_id">
                            <option class="form-control" value="">Select Product Type</option>
                            <?php foreach($categories as $category){ ?>
                                <option <?php if($category['category_id']==$quotation_info[0]['category_id']) echo 'selected'; ?> class="form-control" value="<?php echo $category['category_id'] ?>"><?php echo $category['short_name']; ?></option>
                            <?php } ?>
                       </select>
                    </div>
                </div>
            </div>
           <div class="col-md-6">
                    <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Customer<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <select id="customer_id" class="form-control" name="customer_id">
                            <option class="form-control" value="">Select Customer</option>
                            <?php foreach($customers as $customer){ ?>
                                <option <?php if($customer['id']==$quotation_info[0]['customer_id']) echo 'selected'; ?> class="form-control" value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option>
                            <?php } ?>
                       </select>
                    </div>
                </div>
            </div>
            
            
        </div>
        
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Billing Address :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="billing_address" type="text" value="<?php if(!empty($quotation_info[0]['billing_address'])) echo $quotation_info[0]['billing_address']; ?>"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Billing Email :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" name="billing_email" type="text" value="<?php if(!empty($quotation_info[0]['billing_email'])) echo $quotation_info[0]['billing_email']; ?>"></div>
                </div>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Delivery Address :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="shipping_address" type="text" value="<?php if(!empty($quotation_info[0]['shipping_address'])) echo $quotation_info[0]['shipping_address']; ?>"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Delivery Email :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" name="shipping_email" type="text" value="<?php if(!empty($quotation_info[0]['shipping_email'])) echo $quotation_info[0]['shipping_email']; ?>"></div>
                </div>
            </div>
            
        </div>
        
       
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Project Name :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" id="project_name" name="project_name" type="text" value="<?php if(!empty($quotation_info[0]['project_name'])) echo $quotation_info[0]['project_name']; ?>"></div>
                </div>
            </div>
            <div class="col-md-6">
                    <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Employee<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <select id="employee_id" class="form-control e1" name="employee_id">
                            <option class="form-control" value="">Select Employee</option>
                            <?php foreach($employees as $employee){ ?>
                                <option <?php if($employee['id']==$quotation_info[0]['employee_id']) echo 'selected'; ?> class="form-control" value="<?php echo $employee['id'] ?>"><?php echo $employee['name'].'('.$employee['designation_short_name'].')' ?></option>
                            <?php } ?>
                       </select>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row">
              
          <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3   labeltext" style="text-align: right;"><label for="inputdefault">Attention :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" name="attention" type="text" value="<?php if(!empty($quotation_info[0]['attention'])) echo $quotation_info[0]['attention']; ?>"></div>
                </div>
            </div>
            
        </div>
        
        
        
        
        <hr>
        
     
        <div class="row">
            <input type="hidden" value="<?php echo count($quotation_details_info) ?>" id="count" />
                <table class="table table-bordered" id="myTable">
                    <thead>
                     <tr >
                         <th style="width:30px;padding:4px;">
                             <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" id="button1" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                         </th>
                         <th>Item Name <sup style='color:red'>*</sup></th>
                         <th>Description</th>
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
                                    <?php if($i>1){ ?>
                                        <td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button4" onclick="removeRow('<?php echo $i; ?>')" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-minus"></span></button></td>
                                    <?php }else{ ?>
                                        <td></td>
                                        
                                    <?php } ?>    
                                    <td>
                                        <select style="width:200px;" id="product_<?php echo $i; ?>" class="form-control e1" name="product_id[]" onchange="javascript:item_info(<?php echo $i; ?>);">

                                            <option class="form-control" value="">Select Product</option>
                                            <?php foreach($products as $product){ ?>
                                                <option <?php if (!empty($quotation_detail['product_id']) && $quotation_detail['product_id'] == $product['product_id']) echo "selected"; ?>  class="form-control" value="<?php echo $product['product_id']; ?>"><?php echo $product['product_name']; ?></option>
                                            <?php } ?>
                                       </select>
                                    </td> 

                                     <td>
                                        <input  style="width:140px;"  type="text"  name="description[]" id="description_<?php echo $i; ?>" class="issue" value="<?php if(!empty($quotation_detail['description'])) echo $quotation_detail['description']; ?>">
                                    </td>

                                     <td>
                                        <input onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"  style="width:140px;"  type="text"  name="quantity[]" id="quantity_<?php echo $i; ?>" class="issue" value="<?php if(!empty($quotation_detail['quantity'])) echo $quotation_detail['quantity']; ?>">
                                    </td>
                                    <td>
                                        <input onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"  style="width:140px;"  type="text"  name="unit_price[]" id="unit_price_<?php echo $i; ?>" class="issue" value="<?php if(!empty($quotation_detail['unit_price'])) echo $quotation_detail['unit_price']; ?>">
                                    </td>

                                    <td>
                                        <input  style="width:140px;"  type="text"  name="amount[]" id="amount_<?php echo $i; ?>" class="issue" value="<?php if(!empty($quotation_detail['amount'])) echo $quotation_detail['amount']; ?>">
                                    </td>
                                     <td>
                                        <input  style="width:140px;"  type="text"  name="remark[]" id="remark_<?php echo $i; ?>" class="issue" value="<?php if(!empty($quotation_detail['remark'])) echo $quotation_detail['remark']; ?>">
                                    </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                       <tfoot>
                            <tr>
                                <td colspan="5" style="text-align:right;">Subtotal:</td>

                                <td><input readonly style="width:140px;" id="sub_total"  name="total_amount" type="text" value="<?php if(!empty($quotation_info[0]['total_amount'])) echo $quotation_info[0]['total_amount']; ?>"></td>
                            </tr>
                        </tfoot>
                  </table>
           
            
            
            
        </div>
        
        <hr>
         <h2 style="text-align:center; ">Payment Conditions</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align:center;"><label for="inputdefault">Before Delivery</label></div>
                    <div class="col-sm-8 col-md-5 ">
                       
                    </div>
                </div>
                 <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style=""><label for="inputdefault"><input  type="checkbox" <?php if($payment_info[0]['b_cash']=="Cash") echo 'checked'; ?> name="b_cash" value="Cash">Cash</label></div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" onkeyup="calculatePercentAmount('b_cash_percent')" onchange="calculatePercentAmount('b_cash_percent')" onblur="calculatePercentAmount('b_cash_percent')" id="b_cash_percent" name="b_cash_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_cash_percent'])) echo $payment_info[0]['b_cash_percent']; ?>">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input class="form-control" id="b_cash_amount" name="b_cash_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_cash_amount'])) echo $payment_info[0]['b_cash_amount']; ?>">
                    </div>
                </div>
                 <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style=""><label for="inputdefault"><input type="checkbox" <?php if($payment_info[0]['b_bg']=="Bg") echo 'checked'; ?> name="b_bg" value="Bg">BG</label></div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" id="b_bg_tenor" name="b_bg_tenor" type="text" placeholder="T. Day" value="<?php if(!empty($payment_info[0]['b_bg_tenor'])) echo $payment_info[0]['b_bg_tenor']; ?>">
                    </div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" onkeyup="calculatePercentAmount('b_bg_percent')" onchange="calculatePercentAmount('b_bg_percent')" onblur="calculatePercentAmount('b_bg_percent')" id="b_bg_percent" name="b_bg_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_bg_percent'])) echo $payment_info[0]['b_bg_percent']; ?>">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input class="form-control" id="b_bg_amount" name="b_bg_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_bg_amount'])) echo $payment_info[0]['b_bg_amount']; ?>">
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style=""><label for="inputdefault"><input name="b_lc" type="checkbox" <?php if($payment_info[0]['b_lc']=="Lc") echo 'checked'; ?> value="Lc">LC</label></div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" id="b_lc_tenor" name="b_lc_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['b_lc_tenor'])) echo $payment_info[0]['b_lc_tenor']; ?>">
                    </div>
                     <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" onkeyup="calculatePercentAmount('b_lc_percent')" onchange="calculatePercentAmount('b_lc_percent')" onblur="calculatePercentAmount('b_lc_percent')" id="b_lc_percent" name="b_lc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_lc_percent'])) echo $payment_info[0]['b_lc_percent']; ?>">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input class="form-control" id="b_lc_amount" name="b_lc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_lc_amount'])) echo $payment_info[0]['b_lc_amount']; ?>">
                    </div>
                </div>
                
                 <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style=""><label for="inputdefault"><input type="checkbox" <?php if($payment_info[0]['b_pdc']=="Pdc") echo 'checked'; ?> name="b_pdc" value="Pdc">PDC</label></div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" id="b_pdc_check" name="b_pdc_check" type="text" placeholder="T.Ch." value="<?php if(!empty($payment_info[0]['b_pdc_check'])) echo $payment_info[0]['b_pdc_check']; ?>">
                    </div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" onkeyup="calculatePercentAmount('b_pdc_percent')" onchange="calculatePercentAmount('b_pdc_percent')" onblur="calculatePercentAmount('b_pdc_percent')" id="b_pdc_percent" name="b_pdc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_pdc_percent'])) echo $payment_info[0]['b_pdc_percent']; ?>">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input class="form-control" id="b_pdc_amount" name="b_pdc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_pdc_amount'])) echo $payment_info[0]['b_pdc_amount']; ?>">
                    </div>
                </div>
                
            </div><!--End Col-md-6-->
            <div class="col-md-6">
               
                
                 <div class="form-group row">
                    <div class="col-sm-4 col-md-3   " style="text-align:center;margin-left:-15px"><b>After Delivery</b></div>
                    <div class="col-sm-8 col-md-5 " style="text-align: right">
                        <input type="hidden" id="remaining_balance" value="" />
                        <b>Balance:<span id="balance"></span></b>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style=""><label for="inputdefault"><input type="checkbox" <?php if($payment_info[0]['a_cash']=="Cash") echo 'checked'; ?> name="a_cash" value="Cash">Cash</label></div>
                    <div class="col-sm-4 col-md-2 ">
                        <input class="form-control" onkeyup="calculatePercentAmount('a_cash_percent')" onchange="calculatePercentAmount('a_cash_percent')" onblur="calculatePercentAmount('a_cash_percent')" id="a_cash_percent" name="a_cash_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_cash_percent'])) echo $payment_info[0]['a_cash_percent']; ?>">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input class="form-control"  id="a_cash_amount" name="a_cash_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_cash_amount'])) echo $payment_info[0]['a_cash_amount']; ?>">
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style=""><label for="inputdefault"><input type="checkbox" <?php if($payment_info[0]['a_bg']=="Bg") echo 'checked'; ?> name="a_bg" value="Bg">BG</label></div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" id="a_bg_tenor" name="a_bg_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['a_bg_tenor'])) echo $payment_info[0]['a_bg_tenor']; ?>">
                    </div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" onkeyup="calculatePercentAmount('a_bg_percent')" onchange="calculatePercentAmount('a_bg_percent')" onblur="calculatePercentAmount('a_bg_percent')" id="a_bg_percent" name="a_bg_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_bg_percent'])) echo $payment_info[0]['a_bg_percent']; ?>">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input class="form-control" id="a_bg_amount" name="a_bg_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_bg_amount'])) echo $payment_info[0]['a_bg_amount']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 labeltext" style=""><label for="inputdefault"><input type="checkbox" <?php if($payment_info[0]['a_lc']=="Lc") echo 'checked'; ?> name="a_lc" value="Lc">LC</label></div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" id="a_lc_tenor" name="a_lc_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['a_lc_tenor'])) echo $payment_info[0]['a_lc_tenor']; ?>">
                    </div>
                     <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" onkeyup="calculatePercentAmount('a_lc_percent')" onchange="calculatePercentAmount('a_lc_percent')" onblur="calculatePercentAmount('a_lc_percent')" id="a_lc_percent" name="a_lc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_lc_percent'])) echo $payment_info[0]['a_lc_percent']; ?>">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input class="form-control" id="a_lc_amount" name="a_lc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_lc_amount'])) echo $payment_info[0]['a_lc_amount']; ?>">
                    </div>
                </div>
                
                
                 <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style=""><label for="inputdefault"><input type="checkbox" <?php if($payment_info[0]['a_pdc']=="Pdc") echo 'checked'; ?> name="a_pdc" value="Pdc">PDC</label></div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" id="a_pdc_check" name="a_pdc_check" type="text" placeholder="T.Ch." value="<?php if(!empty($payment_info[0]['a_pdc_check'])) echo $payment_info[0]['a_pdc_check']; ?>">
                    </div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" onkeyup="calculatePercentAmount('a_pdc_percent')" onchange="calculatePercentAmount('a_pdc_percent')" onblur="calculatePercentAmount('a_pdc_percent')" id="a_pdc_percent" name="a_pdc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['a_pdc_percent'])) echo $payment_info[0]['a_pdc_percent']; ?>">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input class="form-control" id="a_pdc_amount" name="a_pdc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_pdc_amount'])) echo $payment_info[0]['a_pdc_amount']; ?>">
                    </div>
                </div>
                
            </div><!--End Col-md-6-->
            
        </div>
        
        <h2 style="text-align:center; ">Specification of Raw Materials</h2>
        <?php foreach($raw_material_specification as $raw_material){ ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Material Name :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="" name="material_name[]" type="text" value="<?php echo $raw_material['material_name']  ?>"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Description :</label></div>
                            <div class="col-sm-8 col-md-5 "><input class="form-control" id="" name="m_description[]" type="text" value="<?php echo $raw_material['m_description']  ?>"></div>
                        </div>
                    </div>

                </div>
        <?php } ?>
        
        <div class="row">
           
            <div class="col-md-2 col-md-offset-3">
                <button type="submit" class="btn btn-primary button">Update</button>
            </div>
             <div class="col-md-2">
                <a href="<?php echo site_url('backend/sale_quotations') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

            </div>
        </div> 
            
        </div>
    </form>
</div>

<script type="text/javascript">
    
    $('#payment_condition').change(function(){
        var condition=$('#payment_condition').val();
        if(condition=='Before Delivery'){
            $('#advance').val('');
            $('#due').val('');
            $('#payment_advance').show('');
            $('#payment_due').hide('');
           
        }else if(condition=='After Delivery'){
            $('#advance').val('');
            $('#due').val('');
            $('#payment_advance').hide('');
            $('#payment_due').show('');
            
        }else if(condition=='Before And After Delivery'){
            $('#advance').val('');
            $('#due').val('');
            $('#payment_advance').show('');
            $('#payment_due').show('');
        }else{
            $('#advance').val('');
            $('#due').val('');
            $('#payment_advance').hide('');
            $('#payment_due').hide('');
        }
    });
    
    
    $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr=$('#product_1').html();
        
        var str= '<tr  id="row_' + (Number(count) + 1) + '">';
        str +='<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>'; 
        str +='<td><select required class="e1" style="width:200px;" onchange="item_info(' + (Number(count) + 1) + ')" name="product_id[]" id="product_'+(Number(count) + 1) + '" class="">'+itemstr+'</select></td>';
        str +='<td><input   style="width:140px;"  type="text"  name="description[]" id="description_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><input onkeyup="calculateSubtotal('+(Number(count) + 1)+')" onchange="calculateSubtotal('+(Number(count) + 1)+')" onblur="calculateSubtotal('+(Number(count) + 1)+')"  style="width:140px;"  type="text"  name="quantity[]" id="quantity_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><input onkeyup="calculateSubtotal('+(Number(count) + 1)+')" onchange="calculateSubtotal('+(Number(count) + 1)+')" onblur="calculateSubtotal('+(Number(count) + 1)+')"  style="width:140px;"  type="text"  name="unit_price[]" id="unit_price_'+(Number(count) + 1) + '" class="issue"></td>';
        
        str +='<td><input readonly  style="width:140px;"  type="text"  name="amount[]" id="amount_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><input   style="width:140px;"  type="text"  name="remark[]" id="remark_'+(Number(count) + 1) + '" class="issue"></td>';
        
        str +='</tr>';
       
        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
        $('select.e1').select2();
        $('.chzn-container').remove();
    });
    
    function removeRow(row) {
        var count = $('#count').val();
        $('#count').val(Number(count)-1);
        $('#row_' + row).remove();
        var sub_total=0;
        var rowCount = $('#myTable tr').length;
        var table_row=Number(rowCount)-2;
        for(var i=1;i<=table_row;i++){
           var amt=$('#amount_'+i).val();
           sub_total=sub_total+Number(amt)

        }    
        $('#sub_total').val(sub_total);
    }
    
     function item_info(id) {
        var product_id = $('#product_'+id).val();
        var data = {'product_id': product_id}
        $.ajax({
            url: '<?php echo site_url('sale_quotations/item_info'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {  
                var quote_price=msg.product_info[0].quote_price;
                $('#unit_price_'+id).val(msg.product_info[0].quote_price);
                $('#quantity_'+id).val('1');
                $('#amount_'+id).val(Number(quote_price*1));

                var sub_total=0;
                var rowCount = $('#myTable tr').length;
                var table_row=Number(rowCount)-2;
                for(var i=1;i<=table_row;i++){
                   var amt=$('#amount_'+i).val();
                   sub_total=sub_total+Number(amt)

                }    
                $('#sub_total').val(sub_total);
              }
                
            
        })

    }
    
    
    
    
    function calculateSubtotal(id){
         var sub_total=0;
         var unit_price=$('#unit_price_'+id).val();
         var quantity=$('#quantity_'+id).val();
         var amount=Number(unit_price)*Number(quantity);
         
         $('#amount_'+id).val(amount);
         var rowCount = $('#myTable tr').length;
         var table_row=Number(rowCount)-2;
         for(var i=1;i<=table_row;i++){
             var amt=$('#amount_'+i).val();
             sub_total=sub_total+Number(amt)
             
         }    
         $('#sub_total').val(sub_total);
    }
    
     function calculatePercentAmount(id){
        if(id=='b_cash_percent'){
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
            
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#b_cash_percent').val('');
                $('#b_cash_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
                if(balance!=''){
                    var amount=(Number(b_cash_percent)*balance)/100;
                   
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#b_cash_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }else  if(id=='a_cash_percent'){
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#a_cash_percent').val('');
                $('#a_cash_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
               
                if(balance!=''){
                    var amount=(Number(a_cash_percent)*balance)/100;
                   
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#a_cash_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }else  if(id=='b_bg_percent'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#b_bg_percent').val('');
                $('#b_bg_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
               
                if(balance!=''){
                    var amount=(Number(b_bg_percent)*balance)/100;
                   
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#b_bg_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }else  if(id=='a_bg_percent'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#a_bg_percent').val('');
                $('#a_bg_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
               
                if(balance!=''){
                    var amount=(Number(a_bg_percent)*balance)/100;
                   
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#a_bg_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }else  if(id=='b_lc_percent'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#b_lc_percent').val('');
                $('#b_lc_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
               
                if(balance!=''){
                    var amount=(Number(b_lc_percent)*balance)/100;
                   
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#b_lc_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }else  if(id=='a_lc_percent'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#a_lc_percent').val('');
                $('#a_lc_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
               
                if(balance!=''){
                    var amount=(Number(a_lc_percent)*balance)/100;
                   
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#a_lc_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }else  if(id=='b_pdc_percent'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(a_pdc_amount);
          
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#b_pdc_percent').val('');
                $('#b_pdc_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
               
                if(balance!=''){
                    var amount=(Number(b_pdc_percent)*balance)/100;
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#b_pdc_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }else  if(id=='a_pdc_percent'){
           
            var b_cash_percent=$('#b_cash_percent').val();
            var a_cash_percent=$('#a_cash_percent').val();
            var b_bg_percent=$('#b_bg_percent').val();
            var a_bg_percent=$('#a_bg_percent').val();
            var b_lc_percent=$('#b_lc_percent').val();
            var a_lc_percent=$('#a_lc_percent').val();
            var b_pdc_percent=$('#b_pdc_percent').val();
            var a_pdc_percent=$('#a_pdc_percent').val();
            var total_percent=Number(b_cash_percent)+Number(a_cash_percent)+Number(b_bg_percent)+Number(a_bg_percent)+Number(b_lc_percent)+Number(a_lc_percent)+Number(b_pdc_percent)+Number(a_pdc_percent);
            
            
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount);
          
            if(total_percent>100){
                alert('Percentage should not be more than 100%');
                $('#a_pdc_percent').val('');
                $('#a_pdc_amount').val('');
            }else{
                var balance=Number($('#sub_total').val());
               
                if(balance!=''){
                    var amount=(Number(a_pdc_percent)*balance)/100;
                    var net_amount=amount.toFixed(2);
                    var remaining_balance=balance-total_amount-net_amount;
                    var remaining=remaining_balance.toFixed(2);
                    if(remaining<0){
                        remaining=0;
                    }    
                    $('#a_pdc_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }        
            }    
        }
        
        
        
    }
    
    
    
    
</script>