<style type="text/css">
    .form-control{
        height:30px;
    }
    table tr td, table tr th{
        text-align: center;
        vertical-align: middle;
    }
    table { table-layout: fixed; }
 table th, table td { overflow: hidden; }
</style>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Sale Quotation</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <form class="form-horizontal" action="<?php echo site_url('sale_quotations/edit_quotation_action/'.$quotation_info[0]['q_id']); ?>" method="post" onsubmit="javascript: return validation()" >
         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Q. No<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-neuter"></i></span>
                                    <input class="form-control" id="q_code" name="q_code" type="hidden" value="">
                       <input readonly  class="form-control" id="reference_no" name="reference_no" type="text" value="<?php if(!empty($quotation_info[0]['reference_no'])) echo $quotation_info[0]['reference_no']; ?>">
                        
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                    <input  class="form-control datepicker" id="quotation_date" name="quotation_date" type="text" value="<?php if(!empty($quotation_info[0]['quotation_date'])) echo date('d-m-Y',strtotime($quotation_info[0]['quotation_date'])); ?>">
                       <span id="quotation_date_error" style="color:red"></span>
                                </div>

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Product Type<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                    <select  id="category_id" class="form-control e1" name="category_id">
                            <option class="form-control" value="">Select Product Type</option>
                            <?php foreach($categories as $category){ ?>
                                <option <?php if($category['category_id']==$quotation_info[0]['category_id']) echo 'selected'; ?> class="form-control" value="<?php echo $category['category_id'] ?>"><?php echo $category['short_name']; ?></option>
                            <?php } ?>
                       </select>
                        <span id="category_id_error" style="color:red"></span>
                        
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Customer<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select  id="customer_id" class="form-control e1" name="customer_id">
                            <option class="form-control" value="">Select Customer</option>
                            <?php foreach($customers as $customer){ ?>
                                <option <?php if($customer['id']==$quotation_info[0]['customer_id']) echo 'selected'; ?> class="form-control" value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option>
                            <?php } ?>
                       </select>
                        <span id="customer_id_error" style="color:red"></span>
                                </div>

                            </div>
        
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Project Name<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                    <input   class="form-control" id="project_id" name="project_id" type="hidden">
                       <input  readonly class="form-control" id="project_name" name="project_name" type="text" value="<?php if(!empty($quotation_info[0]['project_name'])) echo $quotation_info[0]['project_name']; ?>">
                       <span id="project_name_error" style="color:red"></span>
                        
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Attention<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="attention" name="attention" type="text" placeholder="Attention Person Name" value="<?php if(!empty($quotation_info[0]['attention'])) echo $quotation_info[0]['attention']; ?>">
                        <span id="attention_error" style="color:red"></span>
                                </div>

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Phone<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                    <input  class="form-control" id="phone" name="phone" type="text" placeholder="Phone" value="<?php if(!empty($quotation_info[0]['phone'])) echo $quotation_info[0]['phone']; ?>">
                        <span id="phone_error" style="color:red"></span>
                        
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Billing Address :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input  class="form-control" id="billing_address" name="billing_address" type="text" placeholder="Billing Address" value="<?php if(!empty($quotation_info[0]['billing_address'])) echo $quotation_info[0]['billing_address']; ?>">
                        <span id="billing_address_error" style="color:red"></span>
                                </div>

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                  B. Email  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                    <input  class="form-control" id="billing_email" name="billing_email" type="text" placeholder="Billing Email" value="<?php if(!empty($quotation_info[0]['billing_email'])) echo $quotation_info[0]['billing_email']; ?>">
                        <span id="billing_email_error" style="color:red"></span>
                        
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    D. Address<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input  class="form-control" id="shipping_address" name="shipping_address" type="text" placeholder="Delivery Address" value="<?php if(!empty($quotation_info[0]['shipping_address'])) echo $quotation_info[0]['shipping_address']; ?>">
                        <span id="shipping_address_error" style="color:red"></span>
                                </div>

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                  D. Email  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                    <input  class="form-control" id="shipping_email" name="shipping_email" type="text" placeholder="Delivery Email" value="<?php if(!empty($quotation_info[0]['shipping_email'])) echo $quotation_info[0]['shipping_email']; ?>">
                        <span id="shipping_email_error" style="color:red"></span>
                        
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Sales Person :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <select id="employee_id" class="form-control e1" name="employee_id">
                           <option class="form-control" value="">Select Employee</option>
                            <?php foreach($employees as $employee){ ?>
                                <option <?php if($employee['id']==$quotation_info[0]['employee_id']) echo 'selected'; ?> class="form-control" value="<?php echo $employee['id'] ?>"><?php echo $employee['name'].'('.$employee['designation_short_name'].')' ?></option>
                            <?php } ?>
                        </select>
                        <span id="employee_id_error" style="color:red"></span>
                                </div>

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                  Thanks By<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                   <select  id="thanks_employee_id" class="form-control e1" name="thanks_employee_id">
                            <option class="form-control" value="">Select Employee</option>
                            <?php foreach($employees as $employee){ ?>
                                <option <?php if($employee['id']==$quotation_info[0]['thanks_employee_id']) echo 'selected'; ?> class="form-control" value="<?php echo $employee['id'] ?>"><?php echo $employee['name'].'('.$employee['designation_short_name'].')' ?></option>
                            <?php } ?>
                        </select>
                        <span id="thanks_employee_id_error" style="color:red"></span>
                        
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Followup By<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <select  id="followup_employee_id" class="form-control e1" name="followup_employee_id">
                            <option class="form-control" value="">Select Employee</option>
                            <?php foreach($employees as $employee){ ?>
                                <option <?php if($employee['id']==$quotation_info[0]['followup_employee_id']) echo 'selected'; ?> class="form-control" value="<?php echo $employee['id'] ?>"><?php echo $employee['name'].'('.$employee['designation_short_name'].')' ?></option>
                            <?php } ?>
                        </select>
                        <span id="followup_employee_id_error" style="color:red"></span>
                                </div>

                            </div>
        
                       <div class='form-group' >
                              
                                <label for="title" class="col-sm-2 control-label">
                                    Bank :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select  id="customer_id" class="form-control e1" name="bank_id">
                                        <option class="form-control" value="">Select Bank</option>
                                        <?php foreach($banks as $bank){ ?>
                                            <option <?php if($bank['id']==$quotation_info[0]['bank_id']) echo 'selected'; ?> class="form-control" value="<?php echo $bank['id'] ?>"><?php echo $bank['b_short_name'].'('.$bank['branch_name'].')'.'('.$bank['b_account_no'].')' ?></option>
                                        <?php } ?>
                                   </select>
                                     <span id="bank_id_error" style="color:red"></span>
                               </div>
                           
                                <label for="title" class="col-sm-2 control-label">
                                    Bank Show :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select  id="customer_id" class="form-control e1" name="bank_show">
                                        <option <?php if($quotation_info[0]['bank_show']=="No") echo 'selected'; ?> class="form-control" value="No">No</option>
                                        <option <?php if($quotation_info[0]['bank_show']=='Yes') echo 'selected'; ?> class="form-control" value="Yes">Yes</option>
                                        
                                   </select>
                                   <span id="bank_id_error" style="color:red"></span>
                                </div>     
                           

                 </div>                       
        


     
        
        
       <div class="separator-shadow"></div>
        
     
        <div class="row">
            <input type="hidden" value="<?php echo count($quotation_details_info) ?>" id="count" />
                <table class="table table-bordered" id="myTable">
                    <thead class="thead-color">
                     <tr >
                         
                         <th>Product Name <sup style='color:red'>*</sup></th>
                         <th>Costing No.</th>
                         <th>Project Name</th>
                         <th>M. Unit</th>
                         <th>Quantity</th>
                         <th>Base Price</th>
                         <th>Vat</th>
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
                                       <input type="hidden"  name="product_id[]" id="product_id_<?php echo $i; ?>" class="issue" value="<?php echo $quotation_detail['product_id']; ?>"><input readonly  style="width:140px;"  type="text"  name="product_name[]" id="product_name_<?php echo $i; ?>" class="issue" value="'<?php echo $quotation_detail['product_name']; ?>">
                                    </td> 
                                    <td>
                                       <input type="hidden"  name="product_cost_id[]" id="product_cost_id_<?php echo $i; ?>" class="issue" value="<?php if(!empty($quotation_detail['product_cost_id'])) echo $quotation_detail['product_cost_id']; ?>"><input readonly  style="width:140px;"  type="text"  name="cost_number[]" id="cost_number_<?php echo $i; ?>" class="issue" value="<?php echo $quotation_detail['cost_number']; ?>">
                                    </td> 
                                     <td>
                                        <input  style="width:140px;"  type="text"  name="description[]" id="description_<?php echo $i; ?>" class="issue" value="<?php if(!empty($quotation_info[0]['project_name'])) echo $quotation_info[0]['project_name']; ?>">
                                    </td>
                                    
                                      <td>
                                        <input  style="width:140px;" required  type="text"  name="mu_name[]" id="mu_name_<?php echo $i; ?>" class="issue" value="<?php if(!empty($quotation_detail['mu_name'])) echo $quotation_detail['mu_name']; ?>">
                                    </td>

                                     <td>
                                        <input required onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"  style="width:140px;text-align: right;"  type="text"  name="quantity[]" id="quantity_<?php echo $i; ?>" class="issue number" value="<?php if(!empty($quotation_detail['quantity'])) echo $quotation_detail['quantity']; ?>">
                                    </td>
                                    
                                    
                                    <td>
                                        <input required onkeyup="calculateUnitPrice(<?php echo $i; ?>)" onchange="calculateUnitPrice(<?php echo $i; ?>)" onblur="calculateUnitPrice(<?php echo $i; ?>)"  style="width:140px;text-align: right;"  type="text"  name="base_price[]" id="base_price_<?php echo $i; ?>" class="issue number" value="<?php if(!empty($quotation_detail['base_price'])) echo $quotation_detail['base_price']; ?>">
                                    </td>
                                    
                                    <td>
                                        <input required onkeyup="calculateUnitPrice(<?php echo $i; ?>)" onchange="calculateUnitPrice(<?php echo $i; ?>)" onblur="calculateUnitPrice(<?php echo $i; ?>)"  style="width:140px;text-align: right;"  type="text"  name="vat[]" id="vat_<?php echo $i; ?>" class="issue number" value="<?php if(!empty($quotation_detail['vat'])) echo $quotation_detail['vat']; ?>">
                                    </td>
                                    
                                    <td>
                                        <input required onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"  style="width:140px;text-align: right;"  type="text"  name="unit_price[]" id="unit_price_<?php echo $i; ?>" class="issue number" value="<?php if(!empty($quotation_detail['unit_price'])) echo $quotation_detail['unit_price']; ?>">
                                    </td>

                                    <td>
                                        <input readonly  style="width:140px;text-align: right;"  type="text"  name="amount[]" id="amount_<?php echo $i; ?>" class="issue" value="<?php if(!empty($quotation_detail['amount'])) echo $quotation_detail['amount']; ?>">
                                    </td>
                                     <td>
                                        <input  style="width:140px;"  type="text"  name="remark[]" id="remark_<?php echo $i; ?>" class="issue" value="<?php if(!empty($quotation_detail['remark'])) echo $quotation_detail['remark']; ?>">
                                    </td>
                                    
                        </tr>
                        <?php } ?>
                    </tbody>
                       <tfoot>
                            <tr>
                                <td colspan="8" style="text-align:right;">Subtotal:</td>

                                <td><input readonly style="width:140px;text-align: right;" id="sub_total"  name="total_amount" type="text" value="<?php if(!empty($quotation_info[0]['total_amount'])) echo $quotation_info[0]['total_amount']; ?>"></td>
                            </tr>
                        </tfoot>
                  </table>
           
            
            
            
        </div>
        
        <div class="separator-shadow"></div>
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
                           <input  style="text-align: right;" onkeyup="calculateAmountToPercent('b_cash_amount')" onchange="calculateAmountToPercent('b_cash_amount')" onblur="calculateAmountToPercent('b_cash_amount')" class="number form-control" id="b_cash_amount" name="b_cash_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_cash_amount'])) echo $payment_info[0]['b_cash_amount']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-3 ">
                            <select class="form-control" name="b_cash_condition">
                                     <option value="Collection">Collection</option>             
                           </select>
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
                          <input readonly style="text-align: right;" onkeyup="calculateAmountToPercent('b_cash_amount')" onchange="calculateAmountToPercent('b_cash_amount')" onblur="calculateAmountToPercent('b_cash_amount')" class="number form-control" id="b_cash_amount" name="b_cash_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_cash_amount'])) echo $payment_info[0]['b_cash_amount']; ?>">
                       </div>
                        <div class="col-sm-4 col-md-3 ">
                            <select class="form-control" name="b_cash_condition">
                                     <option value="Collection">Collection</option>             
                           </select>
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
                           <input  style="text-align: right;" onkeyup="calculateAmountToPercent('b_bg_amount')" onchange="calculateAmountToPercent('b_bg_amount')" onblur="calculateAmountToPercent('b_bg_amount')" class="number form-control" id="b_bg_amount" name="b_bg_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_bg_amount'])) echo $payment_info[0]['b_bg_amount']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-3 ">
                            <select class="form-control" name="b_bg_condition">
                                     <option value="Collection">Collection</option>             
                           </select>
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
                           <input readonly style="text-align: right;" onkeyup="calculateAmountToPercent('b_bg_amount')" onchange="calculateAmountToPercent('b_bg_amount')" onblur="calculateAmountToPercent('b_bg_amount')" class="number form-control" id="b_bg_amount" name="b_bg_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_bg_amount'])) echo $payment_info[0]['b_bg_amount']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-3 ">
                            <select class="form-control" name="b_bg_condition">
                                     <option value="Collection">Collection</option>             
                           </select>
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
                           <input readonly style="text-align: right;" onkeyup="calculateAmountToPercent('b_lc_amount')" onchange="calculateAmountToPercent('b_lc_amount')" onblur="calculateAmountToPercent('b_lc_amount')" class="number form-control" id="b_lc_amount" name="b_lc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_lc_amount'])) echo $payment_info[0]['b_lc_amount']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-3 ">
                                <select class="form-control" name="b_lc_condition">
                                    <option <?php if($payment_info[0]['b_lc_condition']=="Collection") echo 'selected'; ?>  value="Collection">Collection</option>
                                    <option <?php if($payment_info[0]['b_lc_condition']=="Realization") echo 'selected'; ?> value="Realization">Realization</option>
                                </select>
                         </div>
                  <?php }else{ ?>
                        <div class="col-sm-4 col-md-2   labeltext" style=""><label for="b_lc"><input onclick="enablePaymentCondition('b_lc')" id="b_lc" name="b_lc" type="checkbox"  value="Lc">&nbsp;LC</label></div>
                        <div class="col-sm-4 col-md-2 ">
                           <input readonly style="text-align: right;" class="number form-control" id="b_lc_tenor" name="b_lc_tenor" type="text" placeholder="T.Day" value="<?php if(!empty($payment_info[0]['b_lc_tenor'])) echo $payment_info[0]['b_lc_tenor']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-2 ">
                           <input  style="text-align: right;" class="number form-control" onkeyup="calculatePercentAmount('b_lc_percent')" onchange="calculatePercentAmount('b_lc_percent')" onblur="calculatePercentAmount('b_lc_percent')" id="b_lc_percent" name="b_lc_percent" type="text" placeholder="Percent" value="<?php if(!empty($payment_info[0]['b_lc_percent'])) echo $payment_info[0]['b_lc_percent']; ?>">
                        </div>
                         <div class="col-sm-4 col-md-3 ">
                           <input readonly style="text-align: right;" onkeyup="calculateAmountToPercent('b_lc_amount')" onchange="calculateAmountToPercent('b_lc_amount')" onblur="calculateAmountToPercent('b_lc_amount')" class="number form-control" id="b_lc_amount" name="b_lc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_lc_amount'])) echo $payment_info[0]['b_lc_amount']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-3 ">
                                <select class="form-control" name="b_lc_condition">
                                    <option  value="Collection">Collection</option>
                                    <option value="Realization">Realization</option>
                                </select>
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
                           <input  style="text-align: right;" onkeyup="calculateAmountToPercent('b_pdc_amount')" onchange="calculateAmountToPercent('b_pdc_amount')" onblur="calculateAmountToPercent('b_pdc_amount')" class="number form-control" id="b_pdc_amount" name="b_pdc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_pdc_amount'])) echo $payment_info[0]['b_pdc_amount']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-3 ">
                                <select class="form-control" name="b_pdc_condition">
                                    <option <?php if($payment_info[0]['b_pdc_condition']=="Collection") echo 'selected'; ?>  value="Collection">Collection</option>
                                    <option <?php if($payment_info[0]['b_pdc_condition']=="Realization") echo 'selected'; ?> value="Realization">Realization</option>
                                </select>
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
                           <input readonly style="text-align: right;" onkeyup="calculateAmountToPercent('b_pdc_amount')" onchange="calculateAmountToPercent('b_pdc_amount')" onblur="calculateAmountToPercent('b_pdc_amount')" class="number form-control" id="b_pdc_amount" name="b_pdc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['b_pdc_amount'])) echo $payment_info[0]['b_pdc_amount']; ?>">
                        </div>
                        <div class="col-sm-4 col-md-3 ">
                                <select class="form-control" name="b_pdc_condition">
                                    <option  value="Collection">Collection</option>
                                    <option value="Realization">Realization</option>
                                </select>
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
                           <input  style="text-align: right;" onkeyup="calculateAmountToPercent('a_cash_amount')" onchange="calculateAmountToPercent('a_cash_amount')" onblur="calculateAmountToPercent('a_cash_amount')" class="number form-control"  id="a_cash_amount" name="a_cash_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_cash_amount'])) echo $payment_info[0]['a_cash_amount']; ?>">
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
                           <input readonly style="text-align: right;" onkeyup="calculateAmountToPercent('a_cash_amount')" onchange="calculateAmountToPercent('a_cash_amount')" onblur="calculateAmountToPercent('a_cash_amount')" class="number form-control"  id="a_cash_amount" name="a_cash_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_cash_amount'])) echo $payment_info[0]['a_cash_amount']; ?>">
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
                           <input  style="text-align: right;" onkeyup="calculateAmountToPercent('a_bg_amount')" onchange="calculateAmountToPercent('a_bg_amount')" onblur="calculateAmountToPercent('a_bg_amount')" class="number form-control" id="a_bg_amount" name="a_bg_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_bg_amount'])) echo $payment_info[0]['a_bg_amount']; ?>">
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
                           <input readonly style="text-align: right;" onkeyup="calculateAmountToPercent('a_bg_amount')" onchange="calculateAmountToPercent('a_bg_amount')" onblur="calculateAmountToPercent('a_bg_amount')" class="number form-control" id="a_bg_amount" name="a_bg_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_bg_amount'])) echo $payment_info[0]['a_bg_amount']; ?>">
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
                           <input  style="text-align: right;" onkeyup="calculateAmountToPercent('a_lc_amount')" onchange="calculateAmountToPercent('a_lc_amount')" onblur="calculateAmountToPercent('a_lc_amount')" class="number form-control" id="a_lc_amount" name="a_lc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_lc_amount'])) echo $payment_info[0]['a_lc_amount']; ?>">
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
                           <input readonly style="text-align: right;" onkeyup="calculateAmountToPercent('a_lc_amount')" onchange="calculateAmountToPercent('a_lc_amount')" onblur="calculateAmountToPercent('a_lc_amount')" class="number form-control" id="a_lc_amount" name="a_lc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_lc_amount'])) echo $payment_info[0]['a_lc_amount']; ?>">
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
                           <input  style="text-align: right;" onkeyup="calculateAmountToPercent('a_pdc_amount')" onchange="calculateAmountToPercent('a_pdc_amount')" onblur="calculateAmountToPercent('a_pdc_amount')" class="number form-control" id="a_pdc_amount" name="a_pdc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_pdc_amount'])) echo $payment_info[0]['a_pdc_amount']; ?>">
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
                           <input readonly style="text-align: right;" onkeyup="calculateAmountToPercent('a_pdc_amount')" onchange="calculateAmountToPercent('a_pdc_amount')" onblur="calculateAmountToPercent('a_pdc_amount')" class="number form-control" id="a_pdc_amount" name="a_pdc_amount" type="text" placeholder="Amount" value="<?php if(!empty($payment_info[0]['a_pdc_amount'])) echo $payment_info[0]['a_pdc_amount']; ?>">
                        </div>
                    <?php } ?> 
                </div>
                
            </div><!--End Col-md-6-->
            
        </div>
         </div>   
          <div class="separator-shadow"></div>
          <div class="row">
              
              <div class="col-md-8">
                 <h2 style="text-align:center; ">Specification of Raw Materials</h2>
        <button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="specification_hide_button"  class="btn btn-primary "><span class="glyphicon glyphicon-minus"></span></button>
        <button  type="button" style="display:none;padding-left:6px;padding-right:6px;font-size:8px;" id="specification_show_button"  class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span></button>
        <div id="specification_raw_material">
            <div class="row">
           <?php if(!empty($raw_material_specification)){ ?> 
            <input type="hidden" value="<?php echo count($raw_material_specification) ?>" id="material_count" />
           <?php }else{ ?>
            <input type="hidden" value="1" id="material_count" />
           <?php } ?>  
                <table class="table table-bordered" id="specificationTable">
                    <thead class="thead-color">
                     <tr >
                       
                         <th>Material Name </th>
                         <th>Description</th>
                         <th><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="m_specification"  class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span></button></th>

                      </tr>
                    </thead>
                    <tbody id="material_specification">
                     <?php $i=0; foreach($raw_material_specification as $raw_material){ 
                         $i++;
                         ?>
                        <tr id="row_<?php echo $i; ?>">
                            
                            <td><input required  style="width:250px"  type="text"  name="material_name[]"  class="issue form-control" value="<?php echo $raw_material['material_name']  ?>"></td>
                            <td><input required  style="width:350px"  type="text"  name="m_description[]"  class="issue form-control" value="<?php echo $raw_material['m_description']  ?>"></td>
                            <td><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeMaterial(<?php echo $i; ?>)" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>
                        </tr>
                     <?php } ?> 
                    </tbody>
                     
                  </table>
             
        </div> 
        </div> 
              </div>
              <div class="col-md-4">
                  <h2 style="text-align:center; ">Special Note</h2>
                  <button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="special_hide_button"  class="btn btn-primary "><span class="glyphicon glyphicon-minus"></span></button>
            <button  type="button" style="display:none;padding-left:6px;padding-right:6px;font-size:8px;" id="special_show_button"  class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span></button>
           <div class="form-group">
                <div id="special_note">
                 <textarea rows="" class="form-control" name="special_note"><?php if(!empty($quotation_info[0]['special_note'])) echo $quotation_info[0]['special_note']; ?></textarea>
                   
                </div>    
           </div>
              </div>
          </div>
            
         
        
        
        <div class="row">
            <div class="col-md-2">
                <a href="<?php echo site_url('backend/sale_quotations') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>

            </div>
            <div class="col-md-2 ">
                <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">Update</button>
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
    
    //Hide Show Start  
    $('#payment_hide_button').click(function (){
        $('#payment_condition').hide();
        $('#payment_show_button').show();
        $('#payment_hide_button').hide();
    });
    
    $('#payment_show_button').click(function (){
        $('#payment_condition').show();
        $('#payment_hide_button').show();
        $('#payment_show_button').hide();
        
    });
    
    $('#special_hide_button').click(function (){
        $('#special_note').hide();
        $('#special_show_button').show();
        $('#special_hide_button').hide();
    });
    
    $('#special_show_button').click(function (){
        $('#special_note').show();
        $('#special_hide_button').show();
        $('#special_show_button').hide();
        
    });
    
    
    $('#specification_hide_button').click(function (){
        $('#specification_raw_material').hide();
        $('#specification_show_button').show();
        $('#specification_hide_button').hide();
    });
    
    $('#specification_show_button').click(function (){
        $('#specification_raw_material').show();
        $('#specification_hide_button').show();
        $('#specification_show_button').hide();
        
    });
    
  //HIde Show End  
    
  function validation(){
        var quotation_date=$('#quotation_date').val();
        var category_id=$('#category_id').val();
        var customer_id=$('#customer_id').val();
        var project_name=$('#project_name').val();
        var attention=$('#attention').val();
        var phone=$('#phone').val();
        var billing_address=$('#billing_address').val();
        var billing_email=$('#billing_email').val();
        var shipping_address=$('#shipping_address').val();
        var shipping_email=$('#shipping_email').val();
        var thanks_employee_id=$('#thanks_employee_id').val();
        var followup_employee_id=$('#followup_employee_id').val();
        var error=false;
        
        if(quotation_date==''){
            $('#quotation_date').css('border','1px solid red');
            $('#quotation_date_error').html('Please fill date field');
            error=true;
            $('#quotation_date').focus();
        }else{
            $('#quotation_date').css('border','1px solid #ccc');
            $('#quotation_date_error').html('');
            
        }
        if(category_id==''){
            $('#category_id_error').html('Please select product type');
            $('#category_id').css('border','1px solid red');
            error=true;
            $('#category_id').focus();
        }else{
            $('#category_id_error').html('');
            $('#category_id').css('border','1px solid #ccc');   
            
        }
        
         if(customer_id==''){
            $('#customer_id_error').html('Please select customer');
            $('#customer_id').css('border','1px solid red');
            error=true;
            $('#customer_id').focus();
        }else{
            $('#customer_id_error').html('');
            $('#customer_id').css('border','1px solid #ccc');  
             
        }
        
         if(project_name==''){
            $('#project_name_error').html('Please fill  project name field');
            $('#project_name').css('border','1px solid red'); 
            error=true;
            $('#project_name').focus();
        }else{
            $('#project_name_error').html('');
            $('#project_name').css('border','1px solid #ccc');   
             
        }
        
        if(attention==''){
            $('#attention_error').html('Please fill  attention field');
            $('#attention').css('border','1px solid red'); 
            error=true;
            $('#attention').focus();
        }else{
            $('#attention_error').html('');
            $('#attention').css('border','1px solid #ccc');  
             
        }
        
        if(phone==''){
            $('#phone_error').html('Please fill phone number field');
            $('#phone').css('border','1px solid red'); 
            error=true;
            $('#phone').focus();
        }else{
            $('#phone_error').html('');
            $('#phone').css('border','1px solid #ccc');  
             
        }
        
        if(billing_address==''){
//            $('#billing_address_error').html('Please fill billing address field');
//            $('#billing_address').css('border','1px solid red'); 
//            error=true;
//            $('#billing_address').focus();
        }else{
            $('#billing_address_error').html('');
            $('#billing_address').css('border','1px solid #ccc');  
             
        }
        
         if(billing_email==''){
//            $('#billing_email_error').html('Please fill billing email field');
//            $('#billing_email').css('border','1px solid red'); 
//            error=true;
//            $('#billing_email').focus();
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
            $('#shipping_address').focus();
        }else{
            $('#shipping_address_error').html('');
            $('#shipping_address').css('border','1px solid #ccc');  
             
        }
        
        if(shipping_email==''){
//            $('#shipping_email_error').html('Please fill delivery email field');
//            $('#shipping_email').css('border','1px solid red'); 
//            error=true;
//            $('#shipping_email').focus();
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
        
//        if(thanks_employee_id==''){
//            $('#thanks_employee_id_error').html('Please select prepared  employee');
//            $('#thanks_employee_id').css('border','1px solid red'); 
//            error=true;
//            $('#thanks_employee_id').focus();
//        }else{
//            $('#thanks_employee_id_error').html('');
//            $('#thanks_employee_id').css('border','1px solid #ccc');  
//             
//        }
//         if(followup_employee_id==''){
//            $('#followup_employee_id_error').html('Please select followup employee');
//            $('#followup_employee_id').css('border','1px solid red'); 
//            error=true;
//            $('#followup_employee_id').focus();
//        }else{
//            $('#followup_employee_id_error').html('');
//            $('#thanks_employee_id').css('border','1px solid #ccc');  
//             
//        }
        
        if(error==true){
            return false;
        }
    }
    
    
    
     function enablePaymentCondition(paymode){
        var subtotal=$('#sub_total').val();
        if(paymode=="b_cash"){
            if(subtotal>0){
                if($('#b_cash').prop('checked')){
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                    
                    
                    
                    if($('#a_cash').prop('checked')  || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')){
                        if($('#a_cash').prop('checked') && a_cash_percent=='' && a_cash_amount==''){
                            $('#b_cash').prop('checked',false);
                        }else if($('#b_bg').prop('checked') && b_bg_percent==''){
                            $('#b_cash').prop('checked',false);
                        }else if($('#a_bg').prop('checked') && a_bg_percent==''){
                            $('#b_cash').prop('checked',false);
                        }else if($('#b_lc').prop('checked') && b_lc_percent==''){
                            $('#b_cash').prop('checked',false);
                        }else if($('#a_lc').prop('checked') && a_lc_percent==''){
                            $('#b_cash').prop('checked',false);
                        }else if($('#b_pdc').prop('checked') && b_pdc_percent==''){
                            $('#b_cash').prop('checked',false);
                        }else if($('#a_pdc').prop('checked') && a_pdc_percent==''){
                            $('#b_cash').prop('checked',false);
                        }else{
                            var total_percent=a_cash_percent+b_bg_percent+a_bg_percent+b_lc_percent+a_lc_percent+b_pdc_percent+a_pdc_percent;
                            if(total_percent<100){
                                $('#b_cash_tenor').prop('readonly',false);
                                $('#b_cash_percent').prop('readonly',false);
                                $('#b_cash_percent').prop('required',true);
                                
                                $('#b_cash_amount').prop('readonly',false);
                                $('#b_cash_amount').prop('required',true);
                               
                            }else{
                               $('#b_cash').prop('checked',false); 
                            }
                        }

                    }else{

                        var total_percent=a_cash_percent+b_bg_percent+a_bg_percent+b_lc_percent+a_lc_percent+b_pdc_percent+a_pdc_percent;
                        if(total_percent<100){
                            $('#b_cash_tenor').prop('readonly',false);
                            $('#b_cash_percent').prop('readonly',false);
                            $('#b_cash_percent').prop('required',true);
                            $('#b_cash_amount').prop('readonly',false);
                            $('#b_cash_amount').prop('required',true);
                        }else{
                           $('#b_cash').prop('checked',false); 
                        }
                    }

                }else{
                    var b_cash_amount=$('#b_cash_amount').val();
                    var a_cash_amount=$('#a_cash_amount').val();
                    var b_bg_amount=$('#b_bg_amount').val();
                    var a_bg_amount=$('#a_bg_amount').val();
                    var b_lc_amount=$('#b_lc_amount').val();
                    var a_lc_amount=$('#a_lc_amount').val();
                    var b_pdc_amount=$('#b_pdc_amount').val();
                    var a_pdc_amount=$('#a_pdc_amount').val();

                    var total_amount=Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
                    if(total_amount>0){
                        var net_total=Number($('#sub_total').val())-total_amount;
                    }else{
                        var net_total=Number($('#sub_total').val());
                    }
                    $('#balance').html(net_total);
                    $('#b_cash_amount').val('');
                    $('#b_cash_tenor').val('');
                    $('#b_cash_percent').val('');

                    $('#b_cash_tenor').prop('readonly',true);
                    $('#b_cash_percent').prop('readonly',true);
                    $('#b_cash_amount').prop('readonly',true);
                    $('#b_cash_percent').prop('required',false);
                    $('#b_cash_amount').prop('required',false);
                    
                }
            }else{
                $('#b_cash').prop('checked',false);
                alert('Please select product first');
            }
        }else if(paymode=="a_cash"){
             if(subtotal>0){
                 if($('#a_cash').prop('checked')){
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                    
                    
                var total_percent=b_cash_percent+b_bg_percent+a_bg_percent+b_lc_percent+a_lc_percent+b_pdc_percent+a_pdc_percent;
                 if($('#b_cash').prop('checked')  || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')){
                    if($('#b_cash').prop('checked') && b_cash_percent==''){
                        $('#a_cash').prop('checked',false);
                    }else if($('#b_bg').prop('checked') && b_bg_percent==''){
                        $('#a_cash').prop('checked',false);
                    }else if($('#a_bg').prop('checked') && a_bg_percent==''){
                        $('#a_cash').prop('checked',false);
                    }else if($('#b_lc').prop('checked') && b_lc_percent==''){
                        $('#a_cash').prop('checked',false);
                    }else if($('#a_lc').prop('checked') && a_lc_percent==''){
                        $('#a_cash').prop('checked',false);
                    }else if($('#b_pdc').prop('checked') && b_pdc_percent==''){
                        $('#a_cash').prop('checked',false);
                    }else if($('#a_pdc').prop('checked') && a_pdc_percent==''){
                        $('#a_cash').prop('checked',false);
                    }else{
                        
                        if(total_percent<100){
                            $('#a_cash_tenor').prop('readonly',false);
                            $('#a_cash_percent').prop('readonly',false);
                            $('#a_cash_percent').prop('required',true);
                            
                            $('#a_cash_amount').prop('readonly',false);
                            $('#a_cash_amount').prop('required',true);
                        }else{
                           $('#a_cash').prop('checked',false); 
                        }
                    }
                    
                }else{
                        if(total_percent<100){
                           $('#a_cash_tenor').prop('readonly',false);
                           $('#a_cash_percent').prop('readonly',false);
                           $('#a_cash_percent').prop('required',true);
                           
                           $('#a_cash_amount').prop('readonly',false);
                           $('#a_cash_amount').prop('required',true);
                       }else{
                           $('#a_cash').prop('checked',false);
                       }
              }
               
            }else{
                var b_cash_amount=$('#b_cash_amount').val();
                var a_cash_amount=$('#a_cash_amount').val();
                var b_bg_amount=$('#b_bg_amount').val();
                var a_bg_amount=$('#a_bg_amount').val();
                var b_lc_amount=$('#b_lc_amount').val();
                var a_lc_amount=$('#a_lc_amount').val();
                var b_pdc_amount=$('#b_pdc_amount').val();
                var a_pdc_amount=$('#a_pdc_amount').val();
               
                var total_amount=Number(b_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
                if(total_amount>0){
                    var net_total=Number($('#sub_total').val())-total_amount;
                }else{
                    var net_total=Number($('#sub_total').val());
                }
                $('#balance').html(net_total);
                $('#a_cash_amount').val('');
                $('#a_cash_tenor').val('');
                $('#a_cash_percent').val('');
                
                $('#a_cash_tenor').prop('readonly',true);
                $('#a_cash_percent').prop('readonly',true);

                $('#a_cash_percent').prop('required',false);
                
                $('#a_cash_amount').prop('readonly',true);
                $('#a_cash_amount').prop('required',false);
            }
             }else{
                 $('#a_cash').prop('checked',false);
                 alert('Please select product first');
             }
        }else if(paymode=="b_bg"){
            if(subtotal>0){
                if($('#b_bg').prop('checked')){
                var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                    
                    
                    
                var total_percent=b_cash_percent+a_cash_percent+a_bg_percent+b_lc_percent+a_lc_percent+b_pdc_percent+a_pdc_percent;
                if($('#b_cash').prop('checked')  || $('#a_cash').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')){
                    if($('#b_cash').prop('checked') && b_cash_percent==''){
                        $('#b_bg').prop('checked',false);
                    }else if($('#a_cash').prop('checked') && a_cash_percent==''){
                        $('#b_bg').prop('checked',false);
                    }else if($('#a_bg').prop('checked') && a_bg_percent==''){
                        $('#b_bg').prop('checked',false);
                    }else if($('#b_lc').prop('checked') && b_lc_percent==''){
                        $('#b_bg').prop('checked',false);
                    }else if($('#a_lc').prop('checked') && a_lc_percent==''){
                        $('#b_bg').prop('checked',false);
                    }else if($('#b_pdc').prop('checked') && b_pdc_percent==''){
                        $('#b_bg').prop('checked',false);
                    }else if($('#a_pdc').prop('checked') && a_pdc_percent==''){
                        $('#b_bg').prop('checked',false);
                    }else{
                        
                        if(total_percent<100){
                            $('#b_bg_tenor').prop('readonly',false);
                            $('#b_bg_percent').prop('readonly',false);
                            $('#b_bg_tenor').prop('required',true);
                            $('#b_bg_percent').prop('required',true);
                            
                            $('#b_bg_amount').prop('readonly',false);   
                            $('#b_bg_amount').prop('required',true);
                        }else{
                           $('#b_bg').prop('checked',false); 
                        }
                    }
                    
                }else{
                    if(total_percent<100){
                        $('#b_bg_tenor').prop('readonly',false);
                        $('#b_bg_percent').prop('readonly',false);
                        $('#b_bg_tenor').prop('required',true);
                        $('#b_bg_percent').prop('required',true);
                        
                        $('#b_bg_amount').prop('readonly',false);   
                        $('#b_bg_amount').prop('required',true);
                    }else{
                        $('#b_bg').prop('checked',false);
                    }
                }
               
            }else{
                var b_cash_amount=$('#b_cash_amount').val();
                var a_cash_amount=$('#a_cash_amount').val();
                var b_bg_amount=$('#b_bg_amount').val();
                var a_bg_amount=$('#a_bg_amount').val();
                var b_lc_amount=$('#b_lc_amount').val();
                var a_lc_amount=$('#a_lc_amount').val();
                var b_pdc_amount=$('#b_pdc_amount').val();
                var a_pdc_amount=$('#a_pdc_amount').val();
               
                var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
                if(total_amount>0){
                    var net_total=Number($('#sub_total').val())-total_amount;
                }else{
                    var net_total=Number($('#sub_total').val());
                }
                $('#balance').html(net_total);
                $('#b_bg_amount').val('');
                $('#b_bg_tenor').val('');
                $('#b_bg_percent').val('');
                
                $('#b_bg_tenor').prop('readonly',true);
                $('#b_bg_percent').prop('readonly',true);
                
                $('#b_bg_tenor').prop('required',false);
                $('#b_bg_percent').prop('required',false);
                
                $('#b_bg_amount').prop('readonly',true);   
                $('#b_bg_amount').prop('required',false);
            }
            }else{
                $('#b_bg').prop('checked',false);
                alert('Please select product first');
            }
        }else if(paymode=="a_bg"){
            if(subtotal>0){
              if($('#a_bg').prop('checked')){
                  
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                
                
                
                
                var total_percent=b_cash_percent+a_cash_percent+b_bg_percent+b_lc_percent+a_lc_percent+b_pdc_percent+a_pdc_percent;
                 if($('#b_cash').prop('checked')  || $('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')){
                    if($('#b_cash').prop('checked') && b_cash_percent==''){
                        $('#a_bg').prop('checked',false);
                    }else if($('#a_cash').prop('checked') && a_cash_percent==''){
                        $('#a_bg').prop('checked',false);
                    }else if($('#b_bg').prop('checked') && b_bg_percent==''){
                        $('#a_bg').prop('checked',false);
                    }else if($('#b_lc').prop('checked') && b_lc_percent==''){
                        $('#a_bg').prop('checked',false);
                    }else if($('#a_lc').prop('checked') && a_lc_percent==''){
                        $('#a_bg').prop('checked',false);
                    }else if($('#b_pdc').prop('checked') && b_pdc_percent==''){
                        $('#a_bg').prop('checked',false);
                    }else if($('#a_pdc').prop('checked') && a_pdc_percent==''){
                        $('#a_bg').prop('checked',false);
                    }else{
                        
                        if(total_percent<100){
                            $('#a_bg_tenor').prop('readonly',false);
                            $('#a_bg_percent').prop('readonly',false);
                            $('#a_bg_tenor').prop('required',true);
                            $('#a_bg_percent').prop('required',true);
                            
                            $('#a_bg_amount').prop('readonly',false);   
                            $('#a_bg_amount').prop('required',true);
                        }else{
                           $('#a_bg').prop('checked',false); 
                        }
                    }
                    
                }else{
                    if(total_percent<100){ 
                        $('#a_bg_tenor').prop('readonly',false);
                        $('#a_bg_percent').prop('readonly',false);
                        $('#a_bg_tenor').prop('required',true);
                        $('#a_bg_percent').prop('required',true);
                        
                        $('#a_bg_amount').prop('readonly',false);   
                        $('#a_bg_amount').prop('required',true);
                    }else{
                       $('#a_bg').prop('checked',false); 
                    }
                }
               
            }else{
                var b_cash_amount=$('#b_cash_amount').val();
                var a_cash_amount=$('#a_cash_amount').val();
                var b_bg_amount=$('#b_bg_amount').val();
                var a_bg_amount=$('#a_bg_amount').val();
                var b_lc_amount=$('#b_lc_amount').val();
                var a_lc_amount=$('#a_lc_amount').val();
                var b_pdc_amount=$('#b_pdc_amount').val();
                var a_pdc_amount=$('#a_pdc_amount').val();
               
                var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
                if(total_amount>0){
                    var net_total=Number($('#sub_total').val())-total_amount;
                }else{
                    var net_total=Number($('#sub_total').val());
                }
                $('#balance').html(net_total);
                $('#a_bg_amount').val('');
                $('#a_bg_tenor').val('');
                $('#a_bg_percent').val('');
                
                $('#a_bg_tenor').prop('readonly',true);
                $('#a_bg_percent').prop('readonly',true);
                $('#a_bg_tenor').prop('required',false);
                $('#a_bg_percent').prop('required',false);
                
                $('#a_bg_amount').prop('readonly',true);   
                $('#a_bg_amount').prop('required',false);
            }
            }else{
               $('#a_bg').prop('checked',false);
               alert('Please select product first'); 
            }
        }else if(paymode=="b_lc"){
            if(subtotal>0){
                if($('#b_lc').prop('checked')){
                
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                
                
                var total_percent=b_cash_percent+a_cash_percent+b_bg_percent+a_bg_percent+a_lc_percent+b_pdc_percent+a_pdc_percent;
                if($('#b_cash').prop('checked')  || $('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')){
                    if($('#b_cash').prop('checked') && b_cash_percent==''){
                        $('#b_lc').prop('checked',false);
                    }else if($('#a_cash').prop('checked') && a_cash_percent==''){
                        $('#b_lc').prop('checked',false);
                    }else if($('#b_bg').prop('checked') && b_bg_percent==''){
                        $('#b_lc').prop('checked',false);
                    }else if($('#a_bg').prop('checked') && a_bg_percent==''){
                        $('#b_lc').prop('checked',false);
                    }else if($('#a_lc').prop('checked') && a_lc_percent==''){
                        $('#b_lc').prop('checked',false);
                    }else if($('#b_pdc').prop('checked') && b_pdc_percent==''){
                        $('#b_lc').prop('checked',false);
                    }else if($('#a_pdc').prop('checked') && a_pdc_percent==''){
                        $('#b_lc').prop('checked',false);
                    }else{
                        
                        if(total_percent<100){
                            $('#b_lc_tenor').prop('readonly',false);
                            $('#b_lc_percent').prop('readonly',false);
                            $('#b_lc_tenor').prop('required',true);
                            $('#b_lc_percent').prop('required',true);
                            
                            $('#b_lc_amount').prop('readonly',false);   
                            $('#b_lc_amount').prop('required',true);
                        }else{
                           $('#b_lc').prop('checked',false); 
                        }
                    }
                    
                }else{
                    if(total_percent<100){ 
                        $('#b_lc_tenor').prop('readonly',false);
                        $('#b_lc_percent').prop('readonly',false);
                        $('#b_lc_tenor').prop('required',true);
                        $('#b_lc_percent').prop('required',true);
                        
                        $('#b_lc_amount').prop('readonly',false);   
                        $('#b_lc_amount').prop('required',true);
                    }else{
                        $('#b_lc').prop('checked',false);
                    }
                } 
            }else{
                var b_cash_amount=$('#b_cash_amount').val();
                var a_cash_amount=$('#a_cash_amount').val();
                var b_bg_amount=$('#b_bg_amount').val();
                var a_bg_amount=$('#a_bg_amount').val();
                var b_lc_amount=$('#b_lc_amount').val();
                var a_lc_amount=$('#a_lc_amount').val();
                var b_pdc_amount=$('#b_pdc_amount').val();
                var a_pdc_amount=$('#a_pdc_amount').val();
               
                var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
                if(total_amount>0){
                    var net_total=Number($('#sub_total').val())-total_amount;
                }else{
                    var net_total=Number($('#sub_total').val());
                }
                
                $('#balance').html(net_total);
                $('#b_lc_amount').val('');
                $('#b_lc_tenor').val('');
                $('#b_lc_percent').val('');
                
                $('#b_lc_tenor').prop('readonly',true);
                $('#b_lc_percent').prop('readonly',true);
                $('#b_lc_tenor').prop('required',false);
                $('#b_lc_percent').prop('required',false);
                
                $('#b_lc_amount').prop('readonly',true);   
                $('#b_lc_amount').prop('required',false);
            }
            }else{
                $('#b_lc').prop('checked',false);
                alert('Please select product first'); 
            }
        }else if(paymode=="a_lc"){
            if(subtotal>0){
                if($('#a_lc').prop('checked')){
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                    
                    
                    
                    
                    
                    var total_percent=b_cash_percent+a_cash_percent+b_bg_percent+a_bg_percent+b_lc_percent+b_pdc_percent+a_pdc_percent;
                    if($('#b_cash').prop('checked')  || $('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')){
                        if($('#b_cash').prop('checked') && b_cash_percent==''){
                            $('#a_lc').prop('checked',false);
                        }else if($('#a_cash').prop('checked') && a_cash_percent==''){
                            $('#a_lc').prop('checked',false);
                        }else if($('#b_bg').prop('checked') && b_bg_percent==''){
                            $('#a_lc').prop('checked',false);
                        }else if($('#a_bg').prop('checked') && a_bg_percent==''){
                            $('#a_lc').prop('checked',false);
                        }else if($('#b_lc').prop('checked') && b_lc_percent==''){
                            $('#a_lc').prop('checked',false);
                        }else if($('#b_pdc').prop('checked') && b_pdc_percent==''){
                            $('#a_lc').prop('checked',false);
                        }else if($('#a_pdc').prop('checked') && a_pdc_percent==''){
                            $('#a_lc').prop('checked',false);
                        }else{

                            if(total_percent<100){
                                $('#a_lc_tenor').prop('readonly',false);
                                $('#a_lc_percent').prop('readonly',false);
                                $('#a_lc_tenor').prop('required',true);
                                $('#a_lc_percent').prop('required',true);
                                
                                $('#a_lc_amount').prop('readonly',false);   
                                $('#a_lc_amount').prop('required',true);
                            }else{
                               $('#a_lc').prop('checked',false); 
                            }
                        }

                    }else{
                        if(total_percent<100){ 
                            $('#a_lc_tenor').prop('readonly',false);
                            $('#a_lc_percent').prop('readonly',false);
                            $('#a_lc_tenor').prop('required',true);
                            $('#a_lc_percent').prop('required',true);
                            
                            $('#a_lc_amount').prop('readonly',false);   
                            $('#a_lc_amount').prop('required',true);
                        }else{
                            $('#a_lc').prop('checked',false);
                        }
                    }

                }else{
                    var b_cash_amount=$('#b_cash_amount').val();
                    var a_cash_amount=$('#a_cash_amount').val();
                    var b_bg_amount=$('#b_bg_amount').val();
                    var a_bg_amount=$('#a_bg_amount').val();
                    var b_lc_amount=$('#b_lc_amount').val();
                    var a_lc_amount=$('#a_lc_amount').val();
                    var b_pdc_amount=$('#b_pdc_amount').val();
                    var a_pdc_amount=$('#a_pdc_amount').val();

                    var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
                    if(total_amount>0){
                        var net_total=Number($('#sub_total').val())-total_amount;
                    }else{
                        var net_total=Number($('#sub_total').val());
                    }

                    $('#balance').html(net_total);
                    $('#a_lc_amount').val('');
                    $('#a_lc_tenor').val('');
                    $('#a_lc_percent').val('');

                    $('#a_lc_tenor').prop('readonly',true);
                    $('#a_lc_percent').prop('readonly',true); 
                    $('#a_lc_tenor').prop('required',false);
                    $('#a_lc_percent').prop('required',false);
                    
                    $('#a_lc_amount').prop('readonly',true);   
                    $('#a_lc_amount').prop('required',false);
                }
            }else{
                $('#a_lc').prop('checked',false);
                alert('Please select product first'); 
            }
        }else if(paymode=="b_pdc"){
             if(subtotal>0){
                if($('#b_pdc').prop('checked')){
                
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                
                
                
                
                
                var total_percent=b_cash_percent+a_cash_percent+b_bg_percent+a_bg_percent+b_lc_percent+a_lc_percent+a_pdc_percent;
                if($('#b_cash').prop('checked')  || $('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#a_pdc').prop('checked')){
                    if($('#b_cash').prop('checked') && b_cash_percent==''){
                        $('#b_pdc').prop('checked',false);
                    }else if($('#a_cash').prop('checked') && a_cash_percent==''){
                        $('#b_pdc').prop('checked',false);
                    }else if($('#b_bg').prop('checked') && b_bg_percent==''){
                        $('#b_pdc').prop('checked',false);
                    }else if($('#a_bg').prop('checked') && a_bg_percent==''){
                        $('#b_pdc').prop('checked',false);
                    }else if($('#b_lc').prop('checked') && b_lc_percent==''){
                        $('#b_pdc').prop('checked',false);
                    }else if($('#a_lc').prop('checked') && a_lc_percent==''){
                        $('#b_pdc').prop('checked',false);
                    }else if($('#a_pdc').prop('checked') && a_pdc_percent==''){
                        $('#b_pdc').prop('checked',false);
                    }else{
                        
                        if(total_percent<100){
                            $('#b_pdc_check').prop('readonly',false);
                            $('#b_pdc_percent').prop('readonly',false);
                            $('#b_pdc_check').prop('required',true);
                            $('#b_pdc_percent').prop('required',true);
                            
                            $('#b_pdc_amount').prop('readonly',false);   
                            $('#b_pdc_amount').prop('required',true);
                        }else{
                           $('#b_pdc').prop('checked',false); 
                        }
                    }
                    
                }else{
                    if(total_percent<100){  
                        $('#b_pdc_check').prop('readonly',false);
                        $('#b_pdc_percent').prop('readonly',false);
                        $('#b_pdc_check').prop('required',true);
                        $('#b_pdc_percent').prop('required',true);
                        
                        $('#b_pdc_amount').prop('readonly',false);   
                        $('#b_pdc_amount').prop('required',true);
                    }else{
                       $('#b_pdc').prop('checked',false); 
                    }
                }
               
            }else{
                var b_cash_amount=$('#b_cash_amount').val();
                var a_cash_amount=$('#a_cash_amount').val();
                var b_bg_amount=$('#b_bg_amount').val();
                var a_bg_amount=$('#a_bg_amount').val();
                var b_lc_amount=$('#b_lc_amount').val();
                var a_lc_amount=$('#a_lc_amount').val();
                var b_pdc_amount=$('#b_pdc_amount').val();
                var a_pdc_amount=$('#a_pdc_amount').val();
               
                var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(a_pdc_amount);
                if(total_amount>0){
                    var net_total=Number($('#sub_total').val())-total_amount;
                }else{
                    var net_total=Number($('#sub_total').val());
                }
               
                $('#balance').html(net_total);
                $('#b_pdc_amount').val('');
                $('#b_pdc_check').val('');
                $('#b_pdc_percent').val('');
                
                $('#b_pdc_check').prop('readonly',true);
                $('#b_pdc_percent').prop('readonly',true);
                $('#b_pdc_check').prop('required',false);
                $('#b_pdc_percent').prop('required',false);
                
                $('#b_pdc_amount').prop('readonly',true);   
                $('#b_pdc_amount').prop('required',false);
            }
             }else{
                $('#b_pdc').prop('checked',false);
                alert('Please select product first'); 
            }
        }else if(paymode=="a_pdc"){
             if(subtotal>0){
                if($('#a_pdc').prop('checked')){
               
                    var b_cash_percent=Number($('#b_cash_percent').val());
                    var b_cash_amount=Number($('#b_cash_amount').val());
                    
                    var a_cash_percent=Number($('#a_cash_percent').val());
                    var a_cash_amount=Number($('#a_cash_amount').val());
                    
                    var b_bg_percent=Number($('#b_bg_percent').val());
                    var b_bg_amount=Number($('#b_bg_amount').val());
                              
                    var a_bg_percent=Number($('#a_bg_percent').val());
                    var a_bg_amount=Number($('#a_bg_amount').val());
                    
                    var b_lc_percent=Number($('#b_lc_percent').val());
                    var b_lc_amount=Number($('#b_lc_amount').val());
                    
                    var a_lc_percent=Number($('#a_lc_percent').val());
                    var a_lc_amount=Number($('#a_lc_amount').val());
                                    
                    var b_pdc_percent=Number($('#b_pdc_percent').val());
                    var b_pdc_amount=Number($('#b_pdc_amount').val());
                    
                    var a_pdc_percent=Number($('#a_pdc_percent').val());
                    var a_pdc_amount=Number($('#a_pdc_amount').val());
                
                
                
                
                
                
                var total_percent=b_cash_percent+a_cash_percent+b_bg_percent+a_bg_percent+b_lc_percent+a_lc_percent+b_pdc_percent;
                if($('#b_cash').prop('checked')  || $('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked')){
                    if($('#b_cash').prop('checked') && b_cash_percent==''){
                        $('#a_pdc').prop('checked',false);
                    }else if($('#a_cash').prop('checked') && a_cash_percent==''){
                        $('#a_pdc').prop('checked',false);
                    }else if($('#b_bg').prop('checked') && b_bg_percent==''){
                        $('#a_pdc').prop('checked',false);
                    }else if($('#a_bg').prop('checked') && a_bg_percent==''){
                        $('#a_pdc').prop('checked',false);
                    }else if($('#b_lc').prop('checked') && b_lc_percent==''){
                        $('#a_pdc').prop('checked',false);
                    }else if($('#a_lc').prop('checked') && a_lc_percent==''){
                        $('#a_pdc').prop('checked',false);
                    }else if($('#b_pdc').prop('checked') && b_pdc_percent==''){
                        $('#a_pdc').prop('checked',false);
                    }else{
                        
                        if(total_percent<100){
                             $('#a_pdc_check').prop('readonly',false);
                             $('#a_pdc_percent').prop('readonly',false);
                             $('#a_pdc_check').prop('required',true);
                             $('#a_pdc_percent').prop('required',true);
                             
                             $('#a_pdc_amount').prop('readonly',false);   
                             $('#a_pdc_amount').prop('required',true);
                        }else{
                           $('#a_pdc').prop('checked',false); 
                        }
                    }
                    
                }else{
                    if(total_percent<100){   
                        $('#a_pdc_check').prop('readonly',false);
                        $('#a_pdc_percent').prop('readonly',false);
                        $('#a_pdc_check').prop('required',true);
                        $('#a_pdc_percent').prop('required',true);
                        
                        $('#a_pdc_amount').prop('readonly',false);   
                        $('#a_pdc_amount').prop('required',true);
                    }else{
                        $('#a_pdc').prop('checked',false);
                    }
                }
               
            }else{
                var b_cash_amount=$('#b_cash_amount').val();
                var a_cash_amount=$('#a_cash_amount').val();
                var b_bg_amount=$('#b_bg_amount').val();
                var a_bg_amount=$('#a_bg_amount').val();
                var b_lc_amount=$('#b_lc_amount').val();
                var a_lc_amount=$('#a_lc_amount').val();
                var b_pdc_amount=$('#b_pdc_amount').val();
                var a_pdc_amount=$('#a_pdc_amount').val();
               
                var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount);
                if(total_amount>0){
                    var net_total=Number($('#sub_total').val())-total_amount;
                }else{
                    var net_total=Number($('#sub_total').val());
                }
               
                $('#balance').html(net_total);
                $('#a_pdc_amount').val('');
                $('#a_pdc_check').val('');
                $('#a_pdc_percent').val('');
                
                $('#a_pdc_check').prop('readonly',true);
                $('#a_pdc_percent').prop('readonly',true);
                $('#a_pdc_check').prop('required',false);
                $('#a_pdc_percent').prop('required',false);
                
                $('#a_pdc_amount').prop('readonly',true);   
                $('#a_pdc_amount').prop('required',false);
            }
             }else{
                $('#a_pdc').prop('checked',false);
                alert('Please select product first'); 
            }
        }
        
    }
   
   
   
    function calculateAmountToPercent(id){
        var balance=Number($('#sub_total').val());
        if(id=='b_cash_amount'){
           
           
           
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
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
            
            if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#b_cash_percent').val('');
                $('#b_cash_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(b_cash_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#b_cash_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }    
        }else  if(id=='a_cash_amount'){
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
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#a_cash_percent').val('');
                $('#a_cash_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(a_cash_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#a_cash_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }    
        }else  if(id=='b_bg_amount'){
          
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
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#b_bg_percent').val('');
                $('#b_bg_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(b_bg_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#b_bg_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }    
        }else  if(id=='a_bg_amount'){
           
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
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#a_bg_percent').val('');
                $('#a_bg_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(a_bg_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#a_bg_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }    
        }else  if(id=='b_lc_amount'){
           
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
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#b_lc_percent').val('');
                $('#b_lc_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(b_lc_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#b_lc_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }    
        }else  if(id=='a_lc_amount'){
           
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
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
            if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#a_lc_percent').val('');
                $('#a_lc_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(a_lc_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#a_lc_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }      
        }else  if(id=='b_pdc_amount'){
           
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
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
           if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#b_pdc_percent').val('');
                $('#b_pdc_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(b_pdc_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#b_pdc_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }    
        }else  if(id=='a_pdc_amount'){
           
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
            
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
          
             if(total_amount>balance){
                alert('Payment condition amount should not be more than sub total amount');
                $('#a_pdc_percent').val('');
                $('#a_pdc_amount').val('');
            }else{
               
                        var balance=Number($('#sub_total').val());
                        if(balance!=''){
                             //alert('test');
                            var percent=(Number(a_pdc_amount)*100)/balance;

                            var net_percent=percent.toFixed(2);
                            var remaining_balance=balance-total_amount;
                            var remaining=remaining_balance.toFixed(2);
                            if(remaining<0){
                                remaining=0;
                            }    
                            $('#a_pdc_percent').val(net_percent);
                            $('#remaining_balance').val(remaining);
                            $('#balance').html(remaining);
                        }     
               
            }    
        }
        
        
        
    }
    
    
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
    
    
    function calculateUnitPrice(id){
     $('.number').live('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);  
      });
      
      var base_price=Number($('#base_price_'+id).val());
      var vat=Number($('#vat_'+id).val());
      var unit_price=base_price+vat;
      $('#unit_price_'+id).val(unit_price);
      
      calculateSubtotal(id);
      
  }
    
    function calculateSubtotal(id){
          $('.number').on('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);  
        });
    
         var sub_total=0;
         var unit_price=$('#unit_price_'+id).val();
         var quantity=$('#quantity_'+id).val();
         var amount=Number(unit_price)*Number(quantity);
         amount=amount.toFixed(2);
         $('#amount_'+id).val(amount);
         var rowCount = $('#myTable tr').length;
         var table_row=Number(rowCount)-2;
         for(var i=1;i<=table_row;i++){
             var amt=$('#amount_'+i).val();
             sub_total=sub_total+Number(amt)
             
         }    
         sub_total=sub_total.toFixed(2);
         $('#sub_total').val(sub_total);
         
        if($('#b_cash').prop('checked')){
            var b_cash_percent=Number($('#b_cash_percent').val());
            var amount=(Number(b_cash_percent)*sub_total)/100;      
            var net_amount=amount.toFixed(2);
            
            $('#b_cash_amount').val(net_amount);
            var b_cash_amount=$('#b_cash_amount').val();
            var a_cash_amount=$('#a_cash_amount').val();
            var b_bg_amount=$('#b_bg_amount').val();
            var a_bg_amount=$('#a_bg_amount').val();
            var b_lc_amount=$('#b_lc_amount').val();
            var a_lc_amount=$('#a_lc_amount').val();
            var b_pdc_amount=$('#b_pdc_amount').val();
            var a_pdc_amount=$('#a_pdc_amount').val();
            var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
            var remaining_balance=sub_total-total_amount;
            var remaining=remaining_balance.toFixed(2);
            if(remaining<0){
                remaining=0;
            }    
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
           
       }
        if($('#a_cash').prop('checked')){
             var a_cash_percent=Number($('#a_cash_percent').val());
             var amount=(Number(a_cash_percent)*sub_total)/100;      
             var net_amount=amount.toFixed(2);

             $('#a_cash_amount').val(net_amount);
             var b_cash_amount=$('#b_cash_amount').val();
             var a_cash_amount=$('#a_cash_amount').val();
             var b_bg_amount=$('#b_bg_amount').val();
             var a_bg_amount=$('#a_bg_amount').val();
             var b_lc_amount=$('#b_lc_amount').val();
             var a_lc_amount=$('#a_lc_amount').val();
             var b_pdc_amount=$('#b_pdc_amount').val();
             var a_pdc_amount=$('#a_pdc_amount').val();
             var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
             var remaining_balance=sub_total-total_amount;
             var remaining=remaining_balance.toFixed(2);
             if(remaining<0){
                 remaining=0;
             }    
             $('#remaining_balance').val(remaining);
             $('#balance').html(remaining);
        }
        if($('#b_bg').prop('checked')){
             var b_bg_percent=Number($('#b_bg_percent').val());
             var amount=(Number(b_bg_percent)*sub_total)/100;      
             var net_amount=amount.toFixed(2);

             $('#b_bg_amount').val(net_amount);
             var b_cash_amount=$('#b_cash_amount').val();
             var a_cash_amount=$('#a_cash_amount').val();
             var b_bg_amount=$('#b_bg_amount').val();
             var a_bg_amount=$('#a_bg_amount').val();
             var b_lc_amount=$('#b_lc_amount').val();
             var a_lc_amount=$('#a_lc_amount').val();
             var b_pdc_amount=$('#b_pdc_amount').val();
             var a_pdc_amount=$('#a_pdc_amount').val();
             var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
             var remaining_balance=sub_total-total_amount;
             var remaining=remaining_balance.toFixed(2);
             if(remaining<0){
                 remaining=0;
             }    
             $('#remaining_balance').val(remaining);
             $('#balance').html(remaining);
        }
        if($('#a_bg').prop('checked')){
             var a_bg_percent=Number($('#a_bg_percent').val());
             var amount=(Number(a_bg_percent)*sub_total)/100;      
             var net_amount=amount.toFixed(2);

             $('#a_bg_amount').val(net_amount);
             var b_cash_amount=$('#b_cash_amount').val();
             var a_cash_amount=$('#a_cash_amount').val();
             var b_bg_amount=$('#b_bg_amount').val();
             var a_bg_amount=$('#a_bg_amount').val();
             var b_lc_amount=$('#b_lc_amount').val();
             var a_lc_amount=$('#a_lc_amount').val();
             var b_pdc_amount=$('#b_pdc_amount').val();
             var a_pdc_amount=$('#a_pdc_amount').val();
             var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
             var remaining_balance=sub_total-total_amount;
             var remaining=remaining_balance.toFixed(2);
             if(remaining<0){
                 remaining=0;
             }    
             $('#remaining_balance').val(remaining);
             $('#balance').html(remaining);
        }
        if($('#b_lc').prop('checked')){
             var b_lc_percent=Number($('#b_lc_percent').val());
              var amount=(Number(b_lc_percent)*sub_total)/100;      
             var net_amount=amount.toFixed(2);

             $('#b_lc_amount').val(net_amount);
             var b_cash_amount=$('#b_cash_amount').val();
             var a_cash_amount=$('#a_cash_amount').val();
             var b_bg_amount=$('#b_bg_amount').val();
             var a_bg_amount=$('#a_bg_amount').val();
             var b_lc_amount=$('#b_lc_amount').val();
             var a_lc_amount=$('#a_lc_amount').val();
             var b_pdc_amount=$('#b_pdc_amount').val();
             var a_pdc_amount=$('#a_pdc_amount').val();
             var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
             var remaining_balance=sub_total-total_amount;
             var remaining=remaining_balance.toFixed(2);
             if(remaining<0){
                 remaining=0;
             }    
             $('#remaining_balance').val(remaining);
             $('#balance').html(remaining);
        }
        if($('#a_lc').prop('checked')){
             var a_lc_percent=Number($('#a_lc_percent').val());
              var amount=(Number(a_lc_percent)*sub_total)/100;      
             var net_amount=amount.toFixed(2);

             $('#a_lc_amount').val(net_amount);
             var b_cash_amount=$('#b_cash_amount').val();
             var a_cash_amount=$('#a_cash_amount').val();
             var b_bg_amount=$('#b_bg_amount').val();
             var a_bg_amount=$('#a_bg_amount').val();
             var b_lc_amount=$('#b_lc_amount').val();
             var a_lc_amount=$('#a_lc_amount').val();
             var b_pdc_amount=$('#b_pdc_amount').val();
             var a_pdc_amount=$('#a_pdc_amount').val();
             var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
             var remaining_balance=sub_total-total_amount;
             var remaining=remaining_balance.toFixed(2);
             if(remaining<0){
                 remaining=0;
             }    
             $('#remaining_balance').val(remaining);
             $('#balance').html(remaining);
        }

        if($('#b_pdc').prop('checked')){
             var b_pdc_percent=Number($('#b_pdc_percent').val());
             var amount=(Number(b_pdc_percent)*sub_total)/100;      
             var net_amount=amount.toFixed(2);

             $('#b_pdc_amount').val(net_amount);
             var b_cash_amount=$('#b_cash_amount').val();
             var a_cash_amount=$('#a_cash_amount').val();
             var b_bg_amount=$('#b_bg_amount').val();
             var a_bg_amount=$('#a_bg_amount').val();
             var b_lc_amount=$('#b_lc_amount').val();
             var a_lc_amount=$('#a_lc_amount').val();
             var b_pdc_amount=$('#b_pdc_amount').val();
             var a_pdc_amount=$('#a_pdc_amount').val();
             var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
             var remaining_balance=sub_total-total_amount;
             var remaining=remaining_balance.toFixed(2);
             if(remaining<0){
                 remaining=0;
             }    
             $('#remaining_balance').val(remaining);
             $('#balance').html(remaining);
        }
        if($('#a_pdc').prop('checked')){
             var a_pdc_percent=Number($('#a_pdc_percent').val());
             var amount=(Number(a_pdc_percent)*sub_total)/100;      
             var net_amount=amount.toFixed(2);

             $('#a_pdc_amount').val(net_amount);
             var b_cash_amount=$('#b_cash_amount').val();
             var a_cash_amount=$('#a_cash_amount').val();
             var b_bg_amount=$('#b_bg_amount').val();
             var a_bg_amount=$('#a_bg_amount').val();
             var b_lc_amount=$('#b_lc_amount').val();
             var a_lc_amount=$('#a_lc_amount').val();
             var b_pdc_amount=$('#b_pdc_amount').val();
             var a_pdc_amount=$('#a_pdc_amount').val();
             var total_amount=Number(b_cash_amount)+Number(a_cash_amount)+Number(b_bg_amount)+Number(a_bg_amount)+Number(b_lc_amount)+Number(a_lc_amount)+Number(b_pdc_amount)+Number(a_pdc_amount);
             var remaining_balance=sub_total-total_amount;
             var remaining=remaining_balance.toFixed(2);
             if(remaining<0){
                 remaining=0;
             }    
             $('#remaining_balance').val(remaining);
             $('#balance').html(remaining);
        }
         
         
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
    
    
    $('#m_specification').click(function () {
        var count = $('#material_count').val();
        var str= '<tr  id="row_' + (Number(count) + 1) + '">';
        
        str +='<td><input required   style="width:250px"  type="text"  name="material_name[]"  class="issue form-control"></td>';
        str +='<td><input required  style="width:350px"  type="text"  name="m_description[]"  class="issue form-control"></td>';
        str +='<td><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeMaterial(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>'; 
        str +='</tr>';      
        $('#material_count').val(Number(count) + 1);
        $('#specificationTable').append(str);
        
    });
    
     function removeMaterial(row) {
        var count = $('#material_count').val();
        $('#material_count').val(Number(count)-1);
        $('#row_' + row).remove();
       
    } 
    
    
    
    
</script>