<?php
$employee_id = $this->session->userdata('employeeId');
$user_type = $this->session->userdata('user_type');
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Order</h3>
            </div>
        </div>
        <!--            <div class="row">
                         <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                    </div>-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form action="<?php echo site_url('purchase_orders/edit_purchase_order_action/' . $purchase_order_info[0]['o_id']); ?>" method="post" onsubmit="javascript: return validation()" >
                            <div class="row" style="margin-left:0px;">   
                                <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label">
                                       Order From<sup class="required">*</sup>:
                                    </label> 

                                    <div class="col-sm-4 input-group">
                                           <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <select   id="order_from" class="form-control e1" name="order_from">
                                                    <option  value="">Select option</option>
                                                    <option <?php if($purchase_order_info[0]['order_from']=="Direct") echo 'selected'; ?>  value="Direct">Direct</option>
                                                    <option <?php if($purchase_order_info[0]['order_from']=="Budget") echo 'selected'; ?>  value="Budget">Budget</option>
                                                    <option <?php if($purchase_order_info[0]['order_from']=="Money Indent") echo 'selected'; ?> value="Money Indent">Money Indent</option>
                                             </select>
                                    </div>
                                  <label for="title" class="col-sm-2 control-label">
                                      Order For<sup class="required">*</sup>
                                   </label>
                                  <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <select   id="order_for" class="form-control e1" name="order_type">
                                                    <option value="">Select option</option>
                                                    <?php foreach ($indent_types as $indent_type) { ?>
                                                        <option <?php if($indent_type['id']==$purchase_order_info[0]['order_type']) echo 'selected'; ?> value="<?php echo $indent_type['id']; ?>"><?php if (!empty($indent_type['type_name'])) echo $indent_type['type_name']; ?></option>
                                                   <?php } ?>
                                                    
                                             </select>
                                      
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
                                                  <option class="form-control" value="">Select project</option>
                                                  <?php foreach($projects as $project){ ?>
                                                      <option <?php if($project['d_id']==$purchase_order_info[0]['unit_id']) echo 'selected'; ?> class="form-control" value="<?php echo $project['d_id'] ?>"><?php echo $project['dep_description']; ?></option>
                                                  <?php } ?>
                                       </select>
                                       <span id="category_id_error" style="color:red"></span> 
                                </div> 
                             
                               <label for="title" class="col-sm-2 control-label">
                                    Supplier/Contractor<sup class="required">*</sup> :
                               </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  id="supplier_id" class="form-control e1" name="supplier_id">
                                        <option class="form-control" value="">Select Supplier Or Contractor</option>
                                        <?php foreach($suppliers as $supplier){ ?>
                                            <option <?php if($supplier['ID']==$purchase_order_info[0]['supplier_id']) echo 'selected'; ?> class="form-control" value="<?php echo $supplier['ID'];  ?>"><?php echo $supplier['SUP_NAME'];  ?></option>
                                        <?php } ?>
                                        
                                   </select>
                                    <span id="supplier_id_error" style="color:red"></span>

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
                                        <input  required class="form-control" readonly id="order_no" name="order_no" type="text" value="<?php if (!empty($purchase_order_info[0]['order_no'])) echo $purchase_order_info[0]['order_no']; ?>">
                                    </div>
                                    <label for="title" class="col-sm-2 control-label">
                                        Date :
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                        <input required class="form-control datepicker" id="purchase_order_date" name="purchase_order_date" type="text" value="<?php if (!empty($purchase_order_info[0]['purchase_order_date'])) echo date('d-m-Y', strtotime($purchase_order_info[0]['purchase_order_date'])); ?>">
                                        <span id="purchase_order_date_error" style="color:red"></span>
                                    </div>

                                </div>

                            </div>    
                            <div class="row" style="margin-left:0px;margin-top:5px;">
                                <div class='form-group' style="display:none;" >

                                    <label for="title" class="col-sm-2 control-label">
                                        Billing Address :
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input  class="form-control" id="billing_address" name="billing_address" type="text" placeholder="Billing Address" value="<?php if (!empty($purchase_order_info[0]['billing_address'])) echo $purchase_order_info[0]['billing_address']; ?>">
                                        <span id="billing_address_error" style="color:red"></span>

                                    </div>

                                    <label for="title" class="col-sm-2 control-label">
                                        Billing Email :
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input  class="form-control" id="billing_email" name="billing_email" type="text" placeholder="Billing Email" value="<?php if (!empty($purchase_order_info[0]['billing_email'])) echo $purchase_order_info[0]['billing_email']; ?>">
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
                                    <input  class="form-control" id="shipping_address" name="shipping_address" type="text" placeholder="Delivery Address" value="<?php if (!empty($purchase_order_info[0]['shipping_address'])) echo $purchase_order_info[0]['shipping_address']; ?>">
                                    <span id="shipping_address_error" style="color:red"></span>

                                </div>
                                
                                  <label for="title" class="col-sm-2 control-label">
                                        Attention :
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input  class="form-control" id="attention" name="attention" type="text" placeholder="Attention Person Name" value="<?php if (!empty($purchase_order_info[0]['attention'])) echo $purchase_order_info[0]['attention']; ?>">
                                        <span id="attention_error" style="color:red"></span>

                                    </div>

                                <div class='form-group'  style="display:none;">
                                    <label for="title" class="col-sm-2 control-label">
                                        Delivery Email :
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input  class="form-control" id="shipping_email" name="shipping_email" type="text" placeholder="Delivery Email" value="<?php if (!empty($purchase_order_info[0]['shipping_email'])) echo $purchase_order_info[0]['shipping_email']; ?>">
                                        <span id="shipping_email_error" style="color:red"></span>

                                    </div>



                                </div> 
                            </div>    
                            <div class="row" style="margin-left:0px;margin-top:5px;">
                                <div class='form-group' >
                                  

                                    <label for="title" class="col-sm-2 control-label">
                                        Contact No. :
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input  class="form-control" id="phone" name="phone" type="text" placeholder="Phone" value="<?php if (!empty($purchase_order_info[0]['phone'])) echo $purchase_order_info[0]['phone']; ?>">
                                        <span id="phone_error" style="color:red"></span>

                                    </div>
                                    
                                    
                                    
                                    <label for="title" class="col-sm-2 control-label">
                                       Purchase Type<sup class="required">*</sup>:
                                    </label> 

                                    <div class="col-sm-4 input-group">
                                           <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <select  id="purchase_type" class="form-control e1" name="purchase_type">
                                                    <option  value="">Select option</option>
                                                    <option <?php if($purchase_order_info[0]['purchase_type']=="Direct") echo 'selected'; ?>  value="Direct">Direct</option>
                                                    <option <?php if($purchase_order_info[0]['purchase_type']=="By Order") echo 'selected'; ?>  value="By Order">By Order</option>
                                                    
                                             </select>
                                           <span id="purchase_type_error" style="color:red"></span>
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                  <!--  
                                    <label for="title" class="col-sm-2 control-label">
                                        Prepared By :
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <select  id="employee_id" class="form-control e1" name="employee_id">
                                                <option class="form-control" value="">Select Employee</option>
                                                <?php foreach ($employees as $employee) { ?>
                                                    <option <?php if ($employee['id'] == $purchase_order_info[0]['employee_id']) echo 'selected'; ?> class="form-control" value="<?php echo $employee['id'] ?>"><?php echo $employee['name'] . '(' . $employee['designation_short_name'] . ')' ?></option>
                                                <?php } ?>
                                        </select>
                                        <span id="employee_id_error" style="color:red"></span>

                                    </div>
                                  -->

                                </div> 
                            </div>    

                            <div class="row" style="margin-left:0px;margin-top:5px;">
                                <div class='form-group' >
                                   
                                    <!--
                                    <label for="title" class="col-sm-2 control-label">
                                        Order Type :
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input readonly class="form-control" id="order_type" name="order_type" type="text" placeholder="Order Type" value="<?php //if (!empty($purchase_order_info[0]['order_type'])) echo $purchase_order_info[0]['order_type']; ?>">


                                    </div>
                                    -->

                                </div> 
                            </div>     



                            
                            
                           <div class='form-group' >
                               <label for="title" class="col-sm-2 control-label">
                                    Image Upload :
                                </label>
                                <div class="col-sm-10 input-group" >
                                    <div id="imageDiv">
                                       <?php foreach($purchase_order_document as $row){?>  
                                        <i onclick="closeImage(<?php echo $row['po_id']?>)" style="color:red;font-size: 16px;" class="fa fa-minus-circle"></i>
                                        <img style="width:80px;" src="<?php echo site_url('images/purchase_order_documents/'.$row['file_name']); ?>">
                                    
                                      <?php }?> 
                                    </div>
          
                                    <br>
                                    
                                    <div class="well" data-bind="fileDrag: multiFileData">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <!-- ko foreach: {data: multiFileData().dataURLArray, as: 'dataURL'} -->
                                                <img style="height: 100px; margin: 5px;" class="img-rounded  thumb" data-bind="attr: { src: dataURL }, visible: dataURL">
                                                <!-- /ko -->
                                                <div data-bind="ifnot: fileData().dataURL">
                                                    <label class="drag-label">Drag files here</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input name="order_image[]" type="file" multiple data-bind="fileInput: multiFileData, customFileInput: {
                                                  buttonClass: 'btn btn-success',
                                                  fileNameClass: 'disabled form-control',
                                                  onClear: onClear,
                                                  onInvalidFileDrop: onInvalidFileDrop
                                                }" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
	 
                                </div>
                                
                                
                            </div> 
                            
                            
                            
                            
                            
                            
                            
                            
                            



                            <div class="row" style="margin-top: 20px;">
                                <input type="hidden" value="1" id="count" />
                                <table class="table table-bordered" id="myTable" style="display:<?php if ($order_type_info[0]['type_name'] != "Material") echo 'none'; ?>">
                                <?php  if($purchase_order_info[0]['order_from']=="Direct"){ ?>  
                                    <thead class="thead-color">
                                        <tr>
                                            <th style="text-align: center;">Indent No. <sup style='color:red'>*</sup></th>
                                            <th style="text-align: center;">Item Name <sup style='color:red'>*</sup></th>
                                            <th style="text-align: center;">Unit</th>
                                            <th style="text-align: center;">Size</th>
                                            <th style="text-align: center;">Indent Qnty</th>
                                            <th style="text-align: center;">P. Qnty<sup style='color:red'>*</sup></th>
                                            <th style="text-align: center;">Unit Price<sup style='color:red'>*</sup></th>
                                            <th style="text-align: center;">Value<sup style='color:red'>*</sup></th>
                                            <th style="text-align: center;">Remark</th>


                                        </tr>
                                    </thead>
                                    <tbody id="purchase_items">
                                          <?php
                                            $i = 0;
                                            foreach ($purchase_order_details_info as $purchase_order_details) {
                                                $i++;
                                                ?>
                                            <tr class="" id="row_<?php echo $i; ?>">
                                                <td><input type="hidden" name="indent_d_id[]"  value="<?php echo $purchase_order_details['indent_d_id'] ?>"><input readonly style="width:100%"  type="text"  name="indent_no[]" id="item_des_c1_" class="issue form-control" value="<?php echo $purchase_order_details['indent_no'] ?>"></td>
                                                <td>
                                                    <input  type="hidden"  name="item_id[]" id="product_id_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['item_id'] ?>">
                                                    <input  type="hidden"  name="brand_id[]" id="brand_id_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['brand_id'] ?>">
                                                   <!-- <input readonly style="width:100%"  type="text"  name="name[]" id="item_des_c1_" class="issue form-control" value="<?php echo $purchase_order_details['item_name'] ?>">-->
                                                    <textarea disabled class="form-control" rowspan="3" name="name[]"><?php if(!empty($purchase_order_details['item_name'])) echo $purchase_order_details['item_name'];  ?></textarea>
                                                </td>
                                                <td><input   style="width:100%;"  type="text" class="form-control"  name="m_unit[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['meas_unit'] ?>"></td>
                                                <td><input   style="width:100%;"  type="text" class="form-control"  name="item_size[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['item_size'] ?>"></td>
                                                <td><input readonly style="width:100%"  type="text"  name="indent_qnty[]" id="indent_qnty_" class="issue form-control" value="<?php echo $purchase_order_details['indent_qnty'] ?>"></td>
                                                <td>
                                                    <input style="width:100%;text-align: right;"  type="hidden"  name="pre_quantity[]" id="quantity_<?php echo $i; ?>" class="issue form-control" value="<?php echo $purchase_order_details['quantity'] ?>">
                                                    <input onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"   style="width:100%;text-align: right;"  type="text"  name="quantity[]" id="quantity_<?php echo $i; ?>" class="issue form-control" value="<?php echo $purchase_order_details['quantity'] ?>">
                                                </td>
                                                <td><input onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"  style="width:100%;text-align: right;"  type="text"  name="unit_price[]" id="unit_price_<?php echo $i; ?>" class="issue form-control" value="<?php echo $purchase_order_details['unit_price'] ?>"></td>    
                                                <td><input readonly  style="width:100%;text-align: right;"  type="text" class="form-control"  name="amount[]" id="amount_<?php echo $i; ?>" class="issue" value="<?php echo number_format($purchase_order_details['amount']); ?>"></td>
                                                <td><input   style="width:100%;" rows="3"  type="text" class="form-control"  name="remark[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['remark'] ?>"></td>

                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                    <tfoot class="tfoot-color">
                                        <tr>
                                            <td colspan="6" style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;">Subtotal:</td>

                                            <td colspan="3"><input class="form-control" readonly style="width:140px;text-align: right;" id="sub_total"  name="total_amount" type="text" value="<?php if (!empty($purchase_order_info[0]['total_amount'])) echo $purchase_order_info[0]['total_amount']; ?>"></td>
                                        </tr>
                                    </tfoot>
                                    
                                <?php }else if($purchase_order_info[0]['order_from']=="Budget"){ ?>
                                    <thead class="thead-color">
                                        <tr>
                                            <th style="text-align: center;">Indent No. <sup style='color:red'>*</sup></th>
                                            <th style="text-align: center;">Item Name <sup style='color:red'>*</sup></th>
                                            <th style="text-align: center;">Unit</th>
                                            <th style="text-align: center;">Size</th>
                                            <th style="text-align: center;">Budget Qnty</th>
                                            <th style="text-align: center;">P. Qnty<sup style='color:red'>*</sup></th>
                                            <th style="text-align: center;">Unit Price<sup style='color:red'>*</sup></th>
                                            <th style="text-align: center;">Value<sup style='color:red'>*</sup></th>
                                            <th style="text-align: center;">Remark</th>


                                        </tr>
                                    </thead>
                                    <tbody id="purchase_items">
                                          <?php
                                            $i = 0;
                                            foreach ($purchase_order_details_info as $purchase_order_details) {
                                                $i++;
                                                ?>
                                            <tr class="" id="row_<?php echo $i; ?>">
                                                <td><input type="hidden" name="bu_d_id[]"  value="<?php echo $purchase_order_details['bu_d_id'] ?>"><input type="hidden" name="indent_d_id[]"  value="<?php echo $purchase_order_details['indent_d_id'] ?>"><input readonly style="width:100%"  type="text"  name="indent_no[]" id="item_des_c1_" class="issue form-control" value="<?php echo $purchase_order_details['indent_no'] ?>"></td>
                                                <td>
                                                    <input  type="hidden"  name="item_id[]" id="product_id_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['item_id'] ?>">
                                                    <input  type="hidden"  name="brand_id[]" id="brand_id_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['brand_id'] ?>">
                                                    <textarea disabled class="form-control" rowspan="3" name="name[]"><?php if(!empty($purchase_order_details['item_name'])) echo $purchase_order_details['item_name'];  ?></textarea>
                                                </td>
                                                <td><input   style="width:100%;"  type="text" class="form-control"  name="m_unit[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['meas_unit'] ?>"></td>
                                                <td><input   style="width:100%;"  type="text" class="form-control"  name="item_size[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['item_size'] ?>"></td>
                                                <td><input readonly style="width:100%"  type="text"  name="budget_qnty[]" id="indent_qnty_" class="issue form-control" value="<?php echo $purchase_order_details['budget_qnty'] ?>"></td>
                                                <td>
                                                    <input style="width:100%;text-align: right;"  type="hidden"  name="pre_quantity[]" id="quantity_<?php echo $i; ?>" class="issue form-control" value="<?php echo $purchase_order_details['quantity'] ?>">
                                                    <input onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"   style="width:100%;text-align: right;"  type="text"  name="quantity[]" id="quantity_<?php echo $i; ?>" class="issue form-control" value="<?php echo $purchase_order_details['quantity'] ?>">
                                                </td>
                                                <td><input onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"  style="width:100%;text-align: right;"  type="text"  name="unit_price[]" id="unit_price_<?php echo $i; ?>" class="issue form-control" value="<?php echo $purchase_order_details['unit_price'] ?>"></td>    
                                                <td><input readonly  style="width:100%;text-align: right;"  type="text" class="form-control"  name="amount[]" id="amount_<?php echo $i; ?>" class="issue" value="<?php echo number_format($purchase_order_details['amount']); ?>"></td>
                                                <td><input   style="width:100%;" rows="3"  type="text" class="form-control"  name="remark[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['remark'] ?>"></td>

                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                    <tfoot class="tfoot-color">
                                        <tr>
                                            <td colspan="5" style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;">Subtotal:</td>

                                            <td colspan="3"><input class="form-control" readonly style="width:140px;text-align: right;" id="sub_total"  name="total_amount" type="text" value="<?php if (!empty($purchase_order_info[0]['total_amount'])) echo $purchase_order_info[0]['total_amount']; ?>"></td>
                                        </tr>
                                    </tfoot>
                                <?php }else if($purchase_order_info[0]['order_from']=="Money Indent"){ ?>
                                    <thead class="thead-color">
                                        <tr>
                                            <th style="text-align: center;">Indent No. <sup style='color:red'>*</sup></th>
                                            <th style="text-align: center;">Item Name <sup style='color:red'>*</sup></th>
                                            <th style="text-align: center;">Unit</th>
                                            <th style="text-align: center;">Size</th>
                                            <th style="text-align: center;">M.I. Qnty</th>
                                            <th style="text-align: center;">P. Qnty<sup style='color:red'>*</sup></th>
                                            <th style="text-align: center;">Unit Price<sup style='color:red'>*</sup></th>
                                            <th style="text-align: center;">Value<sup style='color:red'>*</sup></th>
                                            <th style="text-align: center;">Remark</th>


                                        </tr>
                                    </thead>
                                    <tbody id="purchase_items">
                                          <?php
                                            $i = 0;
                                            foreach ($purchase_order_details_info as $purchase_order_details) {
                                                $i++;
                                                ?>
                                            <tr class="" id="row_<?php echo $i; ?>">
                                                <td><input type="hidden" name="mi_d_id[]"  value="<?php echo $purchase_order_details['mi_d_id'] ?>"><input type="hidden" name="indent_d_id[]"  value="<?php echo $purchase_order_details['indent_d_id'] ?>"><input readonly style="width:100%"  type="text"  name="indent_no[]" id="item_des_c1_" class="issue form-control" value="<?php echo $purchase_order_details['indent_no'] ?>"></td>
                                                <td>
                                                    <input  type="hidden"  name="item_id[]" id="product_id_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['item_id'] ?>">
                                                    <input  type="hidden"  name="brand_id[]" id="brand_id_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['brand_id'] ?>">
                                                    <textarea disabled class="form-control" rowspan="3" name="name[]"><?php if(!empty($purchase_order_details['item_name'])) echo $purchase_order_details['item_name'];  ?></textarea>
                                                </td>
                                                <td><input   style="width:100%;"  type="text" class="form-control"  name="m_unit[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['meas_unit'] ?>"></td>
                                                <td><input   style="width:100%;"  type="text" class="form-control"  name="item_size[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['item_size'] ?>"></td>
                                                <td><input readonly style="width:100%"  type="text"  name="m_indent_qnty[]" id="indent_qnty_" class="issue form-control" value="<?php echo $purchase_order_details['m_indent_qnty'] ?>"></td>
                                                <td>
                                                    <input style="width:100%;text-align: right;"  type="hidden"  name="pre_quantity[]" id="quantity_<?php echo $i; ?>" class="issue form-control" value="<?php echo $purchase_order_details['quantity'] ?>">
                                                    <input onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"   style="width:100%;text-align: right;"  type="text"  name="quantity[]" id="quantity_<?php echo $i; ?>" class="issue form-control" value="<?php echo $purchase_order_details['quantity'] ?>">
                                                </td>
                                                <td><input onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"  style="width:100%;text-align: right;"  type="text"  name="unit_price[]" id="unit_price_<?php echo $i; ?>" class="issue form-control" value="<?php echo $purchase_order_details['unit_price'] ?>"></td>    
                                                <td><input readonly  style="width:100%;text-align: right;"  type="text" class="form-control"  name="amount[]" id="amount_<?php echo $i; ?>" class="issue" value="<?php echo number_format($purchase_order_details['amount']); ?>"></td>
                                                <td><input   style="width:100%;" rows="3"  type="text" class="form-control"  name="remark[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['remark'] ?>"></td>

                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                    <tfoot class="tfoot-color">
                                        <tr>
                                            <td colspan="5" style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;">Subtotal:</td>

                                            <td colspan="3"><input class="form-control" readonly style="width:140px;text-align: right;" id="sub_total"  name="total_amount" type="text" value="<?php if (!empty($purchase_order_info[0]['total_amount'])) echo $purchase_order_info[0]['total_amount']; ?>"></td>
                                        </tr>
                                    </tfoot>
                                <?php } ?>    
                                    
                                </table>

                                <table class="table table-bordered" id="serviceTable" style="display:<?php if ($order_type_info[0]['type_name'] != "Sub Contractor Job") echo 'none' ?>">
                                    <thead class="thead-color">
                                        <tr>

                                            <th style="width:30%;text-align: center;">Service Name <sup style='color:red'>*</sup></th>
                                            <th style="width:30%;text-align: center;">Value<sup style='color:red'>*</sup></th>
                                            <th style="width:40%;text-align: center;">Remark</th>


                                        </tr>
                                    </thead>
                                    <tbody id="service_items">
                                        <?php
                                        $i = 0;
                                        foreach ($purchase_order_details_info as $purchase_order_details) {
                                            $i++;
                                            ?>
                                            <tr class="" id="row_<?php echo $i; ?>">
                                                <td><input  type="hidden"  name="service_id[]" id="product_id_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['service_id'] ?>"><input readonly style="width:100%"  type="text"  name="name[]" id="item_des_c1_" class="issue form-control" value="<?php echo $purchase_order_details['service_name'] ?>"></td>
                                                <td><input required  style="width:100%;text-align: right;"  type="text" class="form-control" onkeyup="calculateServiceSubtotal(<?php echo $i; ?>)" onchange="calculateServiceSubtotal(<?php echo $i; ?>)"  name="s_amount[]" id="s_amount_<?php echo $i; ?>" class="issue form-control" value="<?php echo $purchase_order_details['amount'] ?>"></td>
                                                <td><input   style="width:100%"  type="text" class="form-control"  name="s_remark[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['remark'] ?>"></td>

                                            </tr>
<?php } ?>

                                    </tbody>
                                    <tfoot class="tfoot-color">
                                        <tr>
                                            <td  style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;">Subtotal:</td>
                                            <td  colspan="2"><input class="form-control" readonly style="width:42%;text-align: right;" id="service_sub_total"  name="s_total_amount" type="text" value="<?php if (!empty($purchase_order_info[0]['total_amount'])) echo $purchase_order_info[0]['total_amount']; ?>"></td>
                                        </tr>
                                    </tfoot>
                                </table>


                            </div>


                            <div class="separator-shadow"></div>
                            
                            <br />
                            <h2 style="text-align:center; ">Terms & Conditions</h2>
                            <button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="specification_hide_button"  class="btn btn-primary "><span class="glyphicon glyphicon-minus"></span></button>
                            <button  type="button" style="display:none;padding-left:6px;padding-right:6px;font-size:8px;" id="specification_show_button"  class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span></button>
                            <div id="specification_raw_material">
                                <div class="row">

                                    <?php if (!empty($purchase_conditions)) { ?> 
                                        <input type="hidden" value="<?php echo count($purchase_conditions) ?>" id="material_count" />
                                    <?php } else { ?>
                                        <input type="hidden" value="1" id="material_count" />
<?php } ?>  
                                    <table class="table table-bordered" id="specificationTable">
                                        <thead>
                                            <tr >

                                                <th>Term or Condition Name </th>
                                                <th>Description</th>
                                                <th><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="m_specification"  class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span></button></th>

                                            </tr>
                                        </thead>
                                        <tbody id="material_specification">
                                            <?php
                                            $i = 0;
                                            foreach ($purchase_conditions as $purchase_condition) {
                                                $i++;
                                                ?>
                                                <tr id="row_<?php echo $i; ?>">

                                                    <td><input required  style="width:200px"  type="text"  name="t_or_c_name[]"  class="issue form-control" value="<?php echo $purchase_condition['t_or_c_name'] ?>"></td>
                                                    <td><textarea required  style="width:700px"  type="text"  name="t_or_c_description[]"  class="issue form-control"><?php echo $purchase_condition['t_or_c_description'] ?></textarea></td>
                                                    <td><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeTerms(<?php echo $i; ?>)" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>
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
                                <?php if (!empty($copy_to)) { ?>     
                                    <input type="hidden" value="<?php echo count($copy_to) ?>" id="copy_count" />
<?php } else { ?> 
                                    <input type="hidden" value="1" id="copy_count" />
<?php } ?>   
                                <table class="table table-bordered" id="specificationTable">
                                    <thead>
                                        <tr >

                                            <th>Description</th>
                                            <th><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="copy_to"  class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span></button></th>
                                        </tr>
                                    </thead>
                                    <tbody id="copyTable">
<?php
$i = 0;
foreach ($copy_to as $copy) {
    $i++;
    ?>
                                            <tr id="row_<?php echo $i; ?>">
                                                <td><input required  style="width:350px"  type="text"  name="copy_description[]"  class="issue form-control" value="<?php echo $copy['copy_description'] ?>"></td>
                                                <td><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeCopy(<?php echo $i; ?>)" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>
                                            </tr>
<?php } ?> 

                                    </tbody>

                                </table>

                            </div> 



                            <div class="separator-shadow"></div>
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/purchase_orders') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary button">UPDATE</button>
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
    $('#payment_hide_button').click(function () {
        $('#payment_condition').hide();
        $('#payment_show_button').show();
        $('#payment_hide_button').hide();
    });

    $('#payment_show_button').click(function () {
        $('#payment_condition').show();
        $('#payment_hide_button').show();
        $('#payment_show_button').hide();

    });






    //HIde Show End  



    function validation() {
        var purchase_order_date = $('#purchase_order_date').val();
        var q_id = $('#q_id').val();


        var attention = $('#attention').val();
        var phone = $('#phone').val();
        var billing_address = $('#billing_address').val();
        var billing_email = $('#billing_email').val();
        var shipping_address = $('#shipping_address').val();
        var shipping_email = $('#shipping_email').val();
        var purchase_type=$('#purchase_type').val();

        var error = false;

        if (purchase_order_date == '') {
            $('#purchase_order_date').css('border', '1px solid red');
            $('#purchase_order_date_error').html('Please fill date field');
            error = true;
            $('#purchase_order_date').focus();
        } else {
            $('#purchase_order_date').css('border', '1px solid #ccc');
            $('#purchase_order_date_error').html('');

        }
        if (q_id == '') {
            $('#q_id_error').html('Please select quotation');
            $('#q_id').css('border', '1px solid red');
            error = true;
            $('#q_id').focus();
        } else {
            $('#q_id_error').html('');
            $('#q_id').css('border', '1px solid #ccc');

        }



        if (attention == '') {
            $('#attention_error').html('Please fill  attention field');
            $('#attention').css('border', '1px solid red');
            error = true;
            $('#attention').focus();
        } else {
            $('#attention_error').html('');
            $('#attention').css('border', '1px solid #ccc');

        }

        if (phone == '') {
            $('#phone_error').html('Please fill phone number field');
            $('#phone').css('border', '1px solid red');
            error = true;
            $('#phone').focus();
        } else {
            $('#phone_error').html('');
            $('#phone').css('border', '1px solid #ccc');

        }

        if (billing_address == '') {
//            $('#billing_address_error').html('Please fill billing address field');
//            $('#billing_address').css('border', '1px solid red');
//            error = true;
//            $('#billing_address').focus();
        } else {
            $('#billing_address_error').html('');
            $('#billing_address').css('border', '1px solid #ccc');

        }

        if (billing_email == '') {
//            $('#billing_email_error').html('Please fill billing email field');
//            $('#billing_email').css('border', '1px solid red');
//            error = true;
//            $('#billing_email').focus();
        } else {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(billing_email)) {
                $('#billing_email_error').html('Invalid email address');
                $('#billing_email').css('border', '1px solid red');
                error = true;
                $('#billing_email').focus();
            } else {
                $('#billing_email_error').html('');
                $('#billing_email').css('border', '1px solid #ccc');
            }

        }

        if (shipping_address == '') {
            $('#shipping_address_error').html('Please fill delivery address field');
            $('#shipping_address').css('border', '1px solid red');
            error = true;
            $('#shipping_address').focus();
        } else {
            $('#shipping_address_error').html('');
            $('#shipping_address').css('border', '1px solid #ccc');

        }

        if (shipping_email == '') {
//            $('#shipping_email_error').html('Please fill delivery email field');
//            $('#shipping_email').css('border', '1px solid red');
//            error = true;
//            $('#shipping_email').focus();
        } else {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(shipping_email)) {
                $('#shipping_email_error').html('Invalid email address');
                $('#shipping_email').css('border', '1px solid red');
                error = true;
                $('#shipping_email').focus();
            } else {
                $('#shipping_email_error').html('');
                $('#shipping_email').css('border', '1px solid #ccc');
            }

        }

        if(purchase_type==''){
            $('#purchase_type').css('border','1px solid red');
            $('#purchase_type_error').html('Please select purchase type');
            error=true;
            $('#purchase_type').focus();
        }else{
            $('#purchase_typepurchase_type').css('border','1px solid #ccc');
            $('#purchase_type_error').html('');
            
        }

        if (error == true) {
            return false;
        }
    }


    $('#q_id').change(function () {
        //  alert('test');
        var q_id = $('#q_id').val();
        if (q_id != '') {
            $('#purchase_items tr').remove();
            $('#sub_total').val('');
            $('#o_code').val('');
            $('#order_no').val('');
            $('#customer_id').val('');
            $('#attention').val('');
            $('#phone').val('');

            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            $('#order_type').val('');

            $('#b_cash').prop('checked', false);
            $('#b_cash_tenor').val('');
            $('#b_cash_percent').val('');
            $('#b_cash_amount').val('');
            $('#b_cash_tenor').prop('readonly', true);
            $('#b_cash_percent').prop('readonly', true);
            $('#b_cash_percent').prop('required', false);
            $('#a_cash').prop('checked', false);
            $('#b_cash_tenor').val('');
            $('#a_cash_percent').val('');
            $('#a_cash_amount').val('');
            $('#a_cash_tenor').prop('readonly', true);
            $('#a_cash_percent').prop('readonly', true);
            $('#a_cash_percent').prop('required', false);

            $('#b_bg').prop('checked', false);
            $('#b_bg_tenor').val('');
            $('#b_bg_percent').val('');
            $('#b_bg_amount').val('');
            $('#b_bg_tenor').prop('readonly', true);
            $('#b_bg_percent').prop('readonly', true);
            $('#b_bg_tenor').prop('required', false);
            $('#b_bg_percent').prop('required', false);
            $('#a_bg').prop('checked', false);
            $('#a_bg_tenor').val('');
            $('#a_bg_percent').val('');
            $('#a_bg_amount').val('');
            $('#a_bg_tenor').prop('readonly', true);
            $('#a_bg_percent').prop('readonly', true);
            $('#a_bg_tenor').prop('required', false);
            $('#a_bg_percent').prop('required', false);

            $('#b_lc').prop('checked', false);
            $('#b_lc_tenor').val('');
            $('#b_lc_percent').val('');
            $('#b_lc_amount').val('');
            $('#b_lc_tenor').prop('readonly', true);
            $('#b_lc_percent').prop('readonly', true);
            $('#b_lc_tenor').prop('required', false);
            $('#b_lc_percent').prop('required', false);
            $('#a_lc').prop('checked', false);
            $('#a_lc_tenor').val('');
            $('#a_lc_percent').val('');
            $('#a_lc_amount').val('');
            $('#a_lc_tenor').prop('readonly', true);
            $('#a_lc_percent').prop('readonly', true);
            $('#a_lc_tenor').prop('required', false);
            $('#a_lc_percent').prop('required', false);

            $('#b_pdc').prop('checked', false);
            $('#b_pdc_check').val('');
            $('#b_pdc_percent').val('');
            $('#b_pdc_amount').val('');
            $('#b_pdc_check').prop('readonly', true);
            $('#b_pdc_percent').prop('readonly', true);
            $('#b_pdc_check').prop('required', false);
            $('#b_pdc_percent').prop('required', false);
            $('#a_pdc').prop('checked', false);
            $('#a_pdc_check').val('');
            $('#a_pdc_percent').val('');
            $('#a_pdc_amount').val('');
            $('#a_pdc_check').prop('readonly', true);
            $('#a_pdc_percent').prop('readonly', true);
            $('#a_pdc_check').prop('required', false);
            $('#a_pdc_percent').prop('required', false);

            var d = new Date();
            var n = d.getFullYear();
            var final = n.toString().substring(2);

            var data = {'q_id': q_id}
            $.ajax({
                url: '<?php echo site_url('purchase_orders/get_quotation_item'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {

                    if (msg.order_code != "") {
                        var item_id = Number(msg.order_code[0].o_code) + 1;
                    } else {
                        item_id = "";
                    }

                    var item_sl_no;
                    if (item_id != '') {
                        if (item_id > 999) {
                            item_sl_no = item_id;
                        } else if (item_id > 99) {
                            item_sl_no = 'PO/' + msg.supplier_info[0].SUP_NAME + '/' + final + '/' + "0" + item_id;
                        } else if (item_id > 9) {
                            item_sl_no = 'PO/' + msg.supplier_info[0].SUP_NAME + '/' + final + '/' + "00" + item_id;
                        } else {
                            item_sl_no = 'PO/' + msg.supplier_info[0].SUP_NAME + '/' + final + '/' + "000" + item_id;
                        }
                    } else {
                        item_id = 1;
                        item_sl_no = 'PO/' + msg.supplier_info[0].SUP_NAME + '/' + final + '/' + '0001';
                    }

                    $('#o_code').val(item_id);
                    $('#order_no').val(item_sl_no);
                    $('#supplier_id').val(msg.supplier_info[0].ID);


                    $('#attention').val(msg.quotation_info[0].attention);
                    $('#phone').val(msg.quotation_info[0].phone);

                    $('#billing_address').val(msg.quotation_info[0].billing_address);
                    $('#billing_email').val(msg.quotation_info[0].billing_email);
                    $('#shipping_address').val(msg.quotation_info[0].shipping_address);
                    $('#shipping_email').val(msg.quotation_info[0].shipping_email);
                    $('#order_type').val(msg.quotation_info[0].type_name);
                    if (msg.quotation_payment_info[0].b_cash == 'Cash') {
                        $('#b_cash').prop('checked', true);
                        $('#b_cash_tenor').val(msg.quotation_payment_info[0].b_cash_tenor);
                        $('#b_cash_percent').val(msg.quotation_payment_info[0].b_cash_percent);
                        $('#b_cash_amount').val(msg.quotation_payment_info[0].b_cash_amount);

                        $('#b_cash_tenor').prop('readonly', false);
                        $('#b_cash_percent').prop('readonly', false);
                        $('#b_cash_percent').prop('required', true);
                    }

                    if (msg.quotation_payment_info[0].a_cash == 'Cash') {
                        $('#a_cash').prop('checked', true);
                        $('#a_cash_tenor').val(msg.quotation_payment_info[0].a_cash_tenor);
                        $('#a_cash_percent').val(msg.quotation_payment_info[0].a_cash_percent);
                        $('#a_cash_amount').val(msg.quotation_payment_info[0].a_cash_amount);

                        $('#a_cash_tenor').prop('readonly', false);
                        $('#a_cash_percent').prop('readonly', false);
                        $('#a_cash_percent').prop('required', true);
                    }

                    if (msg.quotation_payment_info[0].b_bg == 'Bg') {
                        $('#b_bg').prop('checked', true);
                        $('#b_bg_tenor').val(msg.quotation_payment_info[0].b_bg_tenor);
                        $('#b_bg_percent').val(msg.quotation_payment_info[0].b_bg_percent);
                        $('#b_bg_amount').val(msg.quotation_payment_info[0].b_bg_amount);

                        $('#b_bg_tenor').prop('readonly', false);
                        $('#b_bg_percent').prop('readonly', false);
                        $('#b_bg_tenor').prop('required', true);
                        $('#b_bg_percent').prop('required', true);
                    }

                    if (msg.quotation_payment_info[0].a_bg == 'Bg') {
                        $('#a_bg').prop('checked', true);
                        $('#a_bg_tenor').val(msg.quotation_payment_info[0].a_bg_tenor);
                        $('#a_bg_percent').val(msg.quotation_payment_info[0].a_bg_percent);
                        $('#a_bg_amount').val(msg.quotation_payment_info[0].a_bg_amount);

                        $('#a_bg_tenor').prop('readonly', false);
                        $('#a_bg_percent').prop('readonly', false);
                        $('#a_bg_tenor').prop('required', true);
                        $('#a_bg_percent').prop('required', true);
                    }

                    if (msg.quotation_payment_info[0].b_lc == 'Lc') {
                        $('#b_lc').prop('checked', true);
                        if (msg.quotation_payment_info[0].b_lc_condition == "Realization") {
                            $("#b_lc_condition").val("Realization");
                        } else {
                            $("#b_lc_condition").val("Collection");
                        }
                        $('#b_lc_tenor').val(msg.quotation_payment_info[0].b_lc_tenor);
                        $('#b_lc_percent').val(msg.quotation_payment_info[0].b_lc_percent);
                        $('#b_lc_amount').val(msg.quotation_payment_info[0].b_lc_amount);

                        $('#b_lc_tenor').prop('readonly', false);
                        $('#b_lc_percent').prop('readonly', false);
                        $('#b_lc_tenor').prop('required', true);
                        $('#b_lc_percent').prop('required', true);
                    }

                    if (msg.quotation_payment_info[0].a_lc == 'Lc') {
                        $('#a_lc').prop('checked', true);
                        $('#a_lc_tenor').val(msg.quotation_payment_info[0].a_lc_tenor);
                        $('#a_lc_percent').val(msg.quotation_payment_info[0].a_lc_percent);
                        $('#a_lc_amount').val(msg.quotation_payment_info[0].a_lc_amount);

                        $('#a_lc_tenor').prop('readonly', false);
                        $('#a_lc_percent').prop('readonly', false);
                        $('#a_lc_tenor').prop('required', true);
                        $('#a_lc_percent').prop('required', true);
                    }

                    if (msg.quotation_payment_info[0].b_pdc == 'Pdc') {
                        $('#b_pdc').prop('checked', true);
                        if (msg.quotation_payment_info[0].b_pdc_condition == "Realization") {
                            $("#b_pdc_condition").val("Realization");
                        } else {
                            $("#b_pdc_condition").val("Collection");
                        }
                        $('#b_pdc_check').val(msg.quotation_payment_info[0].b_pdc_check);
                        $('#b_pdc_percent').val(msg.quotation_payment_info[0].b_pdc_percent);
                        $('#b_pdc_amount').val(msg.quotation_payment_info[0].b_pdc_amount);

                        $('#b_pdc_check').prop('readonly', false);
                        $('#b_pdc_percent').prop('readonly', false);
                        $('#b_pdc_check').prop('required', true);
                        $('#b_pdc_percent').prop('required', true);
                    }

                    if (msg.quotation_payment_info[0].a_pdc == 'Pdc') {
                        $('#a_pdc').prop('checked', true);
                        $('#a_pdc_check').val(msg.quotation_payment_info[0].a_pdc_check);
                        $('#a_pdc_percent').val(msg.quotation_payment_info[0].a_pdc_percent);
                        $('#a_pdc_amount').val(msg.quotation_payment_info[0].a_pdc_amount);

                        $('#a_pdc_check').prop('readonly', false);
                        $('#a_pdc_percent').prop('readonly', false);
                        $('#a_pdc_check').prop('required', true);
                        $('#a_pdc_percent').prop('required', true);
                    }



                    var str = '';
                    var total = 0;
                    if (msg.quotation_info[0].type_name == "Material") {
                        $('#purchase_items tr').remove();
                        $('#service_items tr').remove();

                        $('myTable').show();
                        $('#serviceTabe').hide();
                        $(msg.item_list).each(function (i, v) {
                            total = total + Number(v.amount);
                            str += '<tr>';
                            str += '<td><input type="hidden"  name="item_id[]" id="item_id_" class="issue" value="' + v.item_id + '"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="' + v.item_name + '"></td>';
                            str += '<td><input   style="width:140px;"  type="text"  name="m_unit[]" id="description_' + (Number(i) + 1) + '" class="issue" value="' + v.meas_unit + '"></td>';
                            str += '<td><input required onkeyup="calculateSubtotal(' + (Number(i) + 1) + ')" onchange="calculateSubtotal(' + (Number(i) + 1) + ')" onblur="calculateSubtotal(' + (Number(i) + 1) + ')"  style="width:140px;text-align:right;"  type="text"  name="quantity[]" id="quantity_' + (Number(i) + 1) + '" class="issue number" value="' + v.quantity + '"></td>';
                            str += '<td><input required onkeyup="calculateSubtotal(' + (Number(i) + 1) + ')" onchange="calculateSubtotal(' + (Number(i) + 1) + ')" onblur="calculateSubtotal(' + (Number(i) + 1) + ')"  style="width:140px;text-align:right;"  type="text"  name="unit_price[]" id="unit_price_' + (Number(i) + 1) + '" class="issue number" value="' + v.unit_price + '"></td>';
                            str += '<td><input readonly  style="width:140px;text-align:right;"  type="text" class="amount_"  name="amount[]" id="amount_' + (Number(i) + 1) + '" class="issue" value="' + v.amount + '"></td>';
                            str += '<td><textarea style="width:200px;" name="remark[]">' + v.remark + '</textarea></td>';
                            str += '</tr>';
                        });

                        $('#sub_total').val(total);
                        $('#purchase_items').append(str);
                    } else if (msg.quotation_info[0].type_name == "Service") {
                        $('#purchase_items tr').remove();
                        $('#service_items tr').remove();

                        $('#myTable').hide();
                        $('#serviceTable').show();
                        $(msg.item_list).each(function (i, v) {
                            total = total + Number(v.amount);
                            str += '<tr>';
                            str += '<td><input type="hidden"  name="service_id[]" id="service_id_" class="issue" value="' + v.id + '"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="' + v.service_name + '"></td>';
                            str += '<td><input required  style="width:140px;text-align:right;"  type="text" class="amount_" onkeyup="calculateServiceSubtotal(' + (Number(i) + 1) + ')" onchange="calculateServiceSubtotal(' + (Number(i) + 1) + ')"  name="s_amount[]" id="s_amount_' + (Number(i) + 1) + '" class="issue" value="' + v.amount + '"></td>';
                            str += '<td><textarea style="width:200px;" name="s_remark[]">' + v.remark + '</textarea></td>';
                            str += '</tr>';
                        });

                        $('#service_sub_total').val(total);
                        $('#service_items').append(str);
                    }


                }

            })
        } else {
            $('#purchase_items tr').remove();
            $('#service_items tr').remove();

            $('#service_sub_total').val('');
            $('#sub_total').val('');

            $('#o_code').val('');
            $('#order_no').val('');
            $('#supplier_id').val('');

            $('#attention').val('');
            $('#phone').val('');

            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            $('#order_type').val('');

            $('#b_cash').prop('checked', false);
            $('#b_cash_tenor').val('');
            $('#b_cash_percent').val('');
            $('#b_cash_amount').val('');
            $('#b_cash_tenor').prop('readonly', true);
            $('#b_cash_percent').prop('readonly', true);
            $('#b_cash_percent').prop('required', false);
            $('#a_cash').prop('checked', false);
            $('#a_cash_tenor').val('');
            $('#a_cash_percent').val('');
            $('#a_cash_amount').val('');
            $('#a_cash_tenor').prop('readonly', true);
            $('#a_cash_percent').prop('readonly', true);
            $('#a_cash_percent').prop('required', false);

            $('#b_bg').prop('checked', false);
            $('#b_bg_tenor').val('');
            $('#b_bg_percent').val('');
            $('#b_bg_amount').val('');
            $('#b_bg_tenor').prop('readonly', true);
            $('#b_bg_percent').prop('readonly', true);
            $('#b_bg_tenor').prop('required', false);
            $('#b_bg_percent').prop('required', false);
            $('#a_bg').prop('checked', false);
            $('#a_bg_tenor').val('');
            $('#a_bg_percent').val('');
            $('#a_bg_amount').val('');
            $('#a_bg_tenor').prop('readonly', true);
            $('#a_bg_percent').prop('readonly', true);
            $('#a_bg_tenor').prop('required', false);
            $('#a_bg_percent').prop('required', false);

            $('#b_lc').prop('checked', false);
            $('#b_lc_tenor').val('');
            $('#b_lc_percent').val('');
            $('#b_lc_amount').val('');
            $('#b_lc_tenor').prop('readonly', true);
            $('#b_lc_percent').prop('readonly', true);
            $('#b_lc_tenor').prop('required', false);
            $('#b_lc_percent').prop('required', false);
            $('#a_lc').prop('checked', false);
            $('#a_lc_tenor').val('');
            $('#a_lc_percent').val('');
            $('#a_lc_amount').val('');
            $('#a_lc_tenor').prop('readonly', true);
            $('#a_lc_percent').prop('readonly', true);
            $('#a_lc_tenor').prop('required', false);
            $('#a_lc_percent').prop('required', false);

            $('#b_pdc').prop('checked', false);
            $('#b_pdc_check').val('');
            $('#b_pdc_percent').val('');
            $('#b_pdc_amount').val('');
            $('#b_pdc_check').prop('readonly', true);
            $('#b_pdc_percent').prop('readonly', true);
            $('#b_pdc_check').prop('required', false);
            $('#b_pdc_percent').prop('required', false);
            $('#a_pdc').prop('checked', false);
            $('#a_pdc_check').val('');
            $('#a_pdc_percent').val('');
            $('#a_pdc_amount').val('');
            $('#a_pdc_check').prop('readonly', true);
            $('#a_pdc_percent').prop('readonly', true);
            $('#a_pdc_check').prop('required', false);
            $('#a_pdc_percent').prop('required', false);

        }
    });

    function calculateServiceSubtotal(id) {
        //alert('test');
        $('.number').on('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);
        });

        var k = 0;
        var sub_total = 0;
        var amount = Number($('#s_amount_' + id).val());
        var rowCount = $('#serviceTable tr').length;
        var table_row = Number(rowCount) - 2;

        if (amount > 0) {
            //    alert('test');
            //    $('#amount_'+id).val(amount);  
            for (var i = 1; i <= table_row; i++) {
                var amt = $('#s_amount_' + i).val();
                if (amt != '') {
                    sub_total = sub_total + Number(amt)
                }

            }

        } else {
            $('#s_amount_' + id).val('');
            for (var i = 1; i <= table_row; i++) {
                var amt = $('#s_amount_' + i).val();
                if (amt != '') {
                    sub_total = sub_total + Number(amt);
                }

            }
        }

        $('#service_sub_total').val(sub_total);
        if ($('#b_cash').prop('checked')) {
            var b_cash_percent = Number($('#b_cash_percent').val());
            var amount = (Number(b_cash_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#b_cash_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);

        }
        if ($('#a_cash').prop('checked')) {
            var a_cash_percent = Number($('#a_cash_percent').val());
            var amount = (Number(a_cash_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#a_cash_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
        }
        if ($('#b_bg').prop('checked')) {
            var b_bg_percent = Number($('#b_bg_percent').val());
            var amount = (Number(b_bg_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#b_bg_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
        }
        if ($('#a_bg').prop('checked')) {
            var a_bg_percent = Number($('#a_bg_percent').val());
            var amount = (Number(a_bg_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#a_bg_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
        }
        if ($('#b_lc').prop('checked')) {
            var b_lc_percent = Number($('#b_lc_percent').val());
            var amount = (Number(b_lc_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#b_lc_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
        }
        if ($('#a_lc').prop('checked')) {
            var a_lc_percent = Number($('#a_lc_percent').val());
            var amount = (Number(a_lc_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#a_lc_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
        }

        if ($('#b_pdc').prop('checked')) {
            var b_pdc_percent = Number($('#b_pdc_percent').val());
            var amount = (Number(b_pdc_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#b_pdc_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
        }
        if ($('#a_pdc').prop('checked')) {
            var a_pdc_percent = Number($('#a_pdc_percent').val());
            var amount = (Number(a_pdc_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#a_bg_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
        }



    }
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

        var sub_total = 0;
        var unit_price = $('#unit_price_' + id).val();
        var quantity = $('#quantity_' + id).val();
        var amount = Number(unit_price) * Number(quantity);

        $('#amount_' + id).val(amount);
        var rowCount = $('#myTable tr').length;
        var table_row = Number(rowCount) - 2;
        for (var i = 1; i <= table_row; i++) {
            var amt = $('#amount_' + i).val();
            sub_total = sub_total + Number(amt)

        }
        $('#sub_total').val(sub_total);

        if ($('#b_cash').prop('checked')) {
            var b_cash_percent = Number($('#b_cash_percent').val());
            var amount = (Number(b_cash_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#b_cash_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);

        }
        if ($('#a_cash').prop('checked')) {
            var a_cash_percent = Number($('#a_cash_percent').val());
            var amount = (Number(a_cash_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#a_cash_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
        }
        if ($('#b_bg').prop('checked')) {
            var b_bg_percent = Number($('#b_bg_percent').val());
            var amount = (Number(b_bg_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#b_bg_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
        }
        if ($('#a_bg').prop('checked')) {
            var a_bg_percent = Number($('#a_bg_percent').val());
            var amount = (Number(a_bg_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#a_bg_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
        }
        if ($('#b_lc').prop('checked')) {
            var b_lc_percent = Number($('#b_lc_percent').val());
            var amount = (Number(b_lc_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#b_lc_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
        }
        if ($('#a_lc').prop('checked')) {
            var a_lc_percent = Number($('#a_lc_percent').val());
            var amount = (Number(a_lc_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#a_lc_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
        }

        if ($('#b_pdc').prop('checked')) {
            var b_pdc_percent = Number($('#b_pdc_percent').val());
            var amount = (Number(b_pdc_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#b_pdc_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
        }
        if ($('#a_pdc').prop('checked')) {
            var a_pdc_percent = Number($('#a_pdc_percent').val());
            var amount = (Number(a_pdc_percent) * sub_total) / 100;
            var net_amount = amount.toFixed(2);

            $('#a_bg_amount').val(net_amount);
            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();
            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
            var remaining_balance = sub_total - total_amount;
            var remaining = remaining_balance.toFixed(2);
            if (remaining < 0) {
                remaining = 0;
            }
            $('#remaining_balance').val(remaining);
            $('#balance').html(remaining);
        }
    }

    function calculatePercentAmount(id) {
        var order_type = $('#order_type').val();
        if (order_type == "Service") {
            var balance = Number($('#service_sub_total').val());
        } else {
            var balance = Number($('#sub_total').val());
        }
        if (id == 'b_cash_percent') {
            var b_cash_percent = $('#b_cash_percent').val();
            var a_cash_percent = $('#a_cash_percent').val();
            var b_bg_percent = $('#b_bg_percent').val();
            var a_bg_percent = $('#a_bg_percent').val();
            var b_lc_percent = $('#b_lc_percent').val();
            var a_lc_percent = $('#a_lc_percent').val();
            var b_pdc_percent = $('#b_pdc_percent').val();
            var a_pdc_percent = $('#a_pdc_percent').val();
            var total_percent = Number(b_cash_percent) + Number(a_cash_percent) + Number(b_bg_percent) + Number(a_bg_percent) + Number(b_lc_percent) + Number(a_lc_percent) + Number(b_pdc_percent) + Number(a_pdc_percent);

            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();

            var total_amount = Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);

            if (total_percent > 100) {
                alert('Percentage should not be more than 100%');
                $('#b_cash_percent').val('');
                $('#b_cash_amount').val('');
            } else {
                var balance = Number($('#sub_total').val());
                if (balance != '') {
                    var amount = (Number(b_cash_percent) * balance) / 100;

                    var net_amount = amount.toFixed(2);
                    var remaining_balance = balance - total_amount - net_amount;
                    var remaining = remaining_balance.toFixed(2);
                    if (remaining < 0) {
                        remaining = 0;
                    }
                    $('#b_cash_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }
            }
        } else if (id == 'a_cash_percent') {
            var b_cash_percent = $('#b_cash_percent').val();
            var a_cash_percent = $('#a_cash_percent').val();
            var b_bg_percent = $('#b_bg_percent').val();
            var a_bg_percent = $('#a_bg_percent').val();
            var b_lc_percent = $('#b_lc_percent').val();
            var a_lc_percent = $('#a_lc_percent').val();
            var b_pdc_percent = $('#b_pdc_percent').val();
            var a_pdc_percent = $('#a_pdc_percent').val();
            var total_percent = Number(b_cash_percent) + Number(a_cash_percent) + Number(b_bg_percent) + Number(a_bg_percent) + Number(b_lc_percent) + Number(a_lc_percent) + Number(b_pdc_percent) + Number(a_pdc_percent);


            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();

            var total_amount = Number(b_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);

            if (total_percent > 100) {
                alert('Percentage should not be more than 100%');
                $('#a_cash_percent').val('');
                $('#a_cash_amount').val('');
            } else {
                var balance = Number($('#sub_total').val());

                if (balance != '') {
                    var amount = (Number(a_cash_percent) * balance) / 100;

                    var net_amount = amount.toFixed(2);
                    var remaining_balance = balance - total_amount - net_amount;
                    var remaining = remaining_balance.toFixed(2);
                    if (remaining < 0) {
                        remaining = 0;
                    }
                    $('#a_cash_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }
            }
        } else if (id == 'b_bg_percent') {

            var b_cash_percent = $('#b_cash_percent').val();
            var a_cash_percent = $('#a_cash_percent').val();
            var b_bg_percent = $('#b_bg_percent').val();
            var a_bg_percent = $('#a_bg_percent').val();
            var b_lc_percent = $('#b_lc_percent').val();
            var a_lc_percent = $('#a_lc_percent').val();
            var b_pdc_percent = $('#b_pdc_percent').val();
            var a_pdc_percent = $('#a_pdc_percent').val();
            var total_percent = Number(b_cash_percent) + Number(a_cash_percent) + Number(b_bg_percent) + Number(a_bg_percent) + Number(b_lc_percent) + Number(a_lc_percent) + Number(b_pdc_percent) + Number(a_pdc_percent);


            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();

            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);

            if (total_percent > 100) {
                alert('Percentage should not be more than 100%');
                $('#b_bg_percent').val('');
                $('#b_bg_amount').val('');
            } else {
                var balance = Number($('#sub_total').val());

                if (balance != '') {
                    var amount = (Number(b_bg_percent) * balance) / 100;

                    var net_amount = amount.toFixed(2);
                    var remaining_balance = balance - total_amount - net_amount;
                    var remaining = remaining_balance.toFixed(2);
                    if (remaining < 0) {
                        remaining = 0;
                    }
                    $('#b_bg_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }
            }
        } else if (id == 'a_bg_percent') {

            var b_cash_percent = $('#b_cash_percent').val();
            var a_cash_percent = $('#a_cash_percent').val();
            var b_bg_percent = $('#b_bg_percent').val();
            var a_bg_percent = $('#a_bg_percent').val();
            var b_lc_percent = $('#b_lc_percent').val();
            var a_lc_percent = $('#a_lc_percent').val();
            var b_pdc_percent = $('#b_pdc_percent').val();
            var a_pdc_percent = $('#a_pdc_percent').val();
            var total_percent = Number(b_cash_percent) + Number(a_cash_percent) + Number(b_bg_percent) + Number(a_bg_percent) + Number(b_lc_percent) + Number(a_lc_percent) + Number(b_pdc_percent) + Number(a_pdc_percent);


            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();

            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);

            if (total_percent > 100) {
                alert('Percentage should not be more than 100%');
                $('#a_bg_percent').val('');
                $('#a_bg_amount').val('');
            } else {
                var balance = Number($('#sub_total').val());

                if (balance != '') {
                    var amount = (Number(a_bg_percent) * balance) / 100;

                    var net_amount = amount.toFixed(2);
                    var remaining_balance = balance - total_amount - net_amount;
                    var remaining = remaining_balance.toFixed(2);
                    if (remaining < 0) {
                        remaining = 0;
                    }
                    $('#a_bg_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }
            }
        } else if (id == 'b_lc_percent') {

            var b_cash_percent = $('#b_cash_percent').val();
            var a_cash_percent = $('#a_cash_percent').val();
            var b_bg_percent = $('#b_bg_percent').val();
            var a_bg_percent = $('#a_bg_percent').val();
            var b_lc_percent = $('#b_lc_percent').val();
            var a_lc_percent = $('#a_lc_percent').val();
            var b_pdc_percent = $('#b_pdc_percent').val();
            var a_pdc_percent = $('#a_pdc_percent').val();
            var total_percent = Number(b_cash_percent) + Number(a_cash_percent) + Number(b_bg_percent) + Number(a_bg_percent) + Number(b_lc_percent) + Number(a_lc_percent) + Number(b_pdc_percent) + Number(a_pdc_percent);


            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();

            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);

            if (total_percent > 100) {
                alert('Percentage should not be more than 100%');
                $('#b_lc_percent').val('');
                $('#b_lc_amount').val('');
            } else {
                var balance = Number($('#sub_total').val());

                if (balance != '') {
                    var amount = (Number(b_lc_percent) * balance) / 100;

                    var net_amount = amount.toFixed(2);
                    var remaining_balance = balance - total_amount - net_amount;
                    var remaining = remaining_balance.toFixed(2);
                    if (remaining < 0) {
                        remaining = 0;
                    }
                    $('#b_lc_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }
            }
        } else if (id == 'a_lc_percent') {

            var b_cash_percent = $('#b_cash_percent').val();
            var a_cash_percent = $('#a_cash_percent').val();
            var b_bg_percent = $('#b_bg_percent').val();
            var a_bg_percent = $('#a_bg_percent').val();
            var b_lc_percent = $('#b_lc_percent').val();
            var a_lc_percent = $('#a_lc_percent').val();
            var b_pdc_percent = $('#b_pdc_percent').val();
            var a_pdc_percent = $('#a_pdc_percent').val();
            var total_percent = Number(b_cash_percent) + Number(a_cash_percent) + Number(b_bg_percent) + Number(a_bg_percent) + Number(b_lc_percent) + Number(a_lc_percent) + Number(b_pdc_percent) + Number(a_pdc_percent);


            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();

            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);

            if (total_percent > 100) {
                alert('Percentage should not be more than 100%');
                $('#a_lc_percent').val('');
                $('#a_lc_amount').val('');
            } else {
                var balance = Number($('#sub_total').val());

                if (balance != '') {
                    var amount = (Number(a_lc_percent) * balance) / 100;

                    var net_amount = amount.toFixed(2);
                    var remaining_balance = balance - total_amount - net_amount;
                    var remaining = remaining_balance.toFixed(2);
                    if (remaining < 0) {
                        remaining = 0;
                    }
                    $('#a_lc_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }
            }
        } else if (id == 'b_pdc_percent') {

            var b_cash_percent = $('#b_cash_percent').val();
            var a_cash_percent = $('#a_cash_percent').val();
            var b_bg_percent = $('#b_bg_percent').val();
            var a_bg_percent = $('#a_bg_percent').val();
            var b_lc_percent = $('#b_lc_percent').val();
            var a_lc_percent = $('#a_lc_percent').val();
            var b_pdc_percent = $('#b_pdc_percent').val();
            var a_pdc_percent = $('#a_pdc_percent').val();
            var total_percent = Number(b_cash_percent) + Number(a_cash_percent) + Number(b_bg_percent) + Number(a_bg_percent) + Number(b_lc_percent) + Number(a_lc_percent) + Number(b_pdc_percent) + Number(a_pdc_percent);


            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();

            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(a_pdc_amount);

            if (total_percent > 100) {
                alert('Percentage should not be more than 100%');
                $('#b_pdc_percent').val('');
                $('#b_pdc_amount').val('');
            } else {
                var balance = Number($('#sub_total').val());

                if (balance != '') {
                    var amount = (Number(b_pdc_percent) * balance) / 100;
                    var net_amount = amount.toFixed(2);
                    var remaining_balance = balance - total_amount - net_amount;
                    var remaining = remaining_balance.toFixed(2);
                    if (remaining < 0) {
                        remaining = 0;
                    }
                    $('#b_pdc_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }
            }
        } else if (id == 'a_pdc_percent') {

            var b_cash_percent = $('#b_cash_percent').val();
            var a_cash_percent = $('#a_cash_percent').val();
            var b_bg_percent = $('#b_bg_percent').val();
            var a_bg_percent = $('#a_bg_percent').val();
            var b_lc_percent = $('#b_lc_percent').val();
            var a_lc_percent = $('#a_lc_percent').val();
            var b_pdc_percent = $('#b_pdc_percent').val();
            var a_pdc_percent = $('#a_pdc_percent').val();
            var total_percent = Number(b_cash_percent) + Number(a_cash_percent) + Number(b_bg_percent) + Number(a_bg_percent) + Number(b_lc_percent) + Number(a_lc_percent) + Number(b_pdc_percent) + Number(a_pdc_percent);


            var b_cash_amount = $('#b_cash_amount').val();
            var a_cash_amount = $('#a_cash_amount').val();
            var b_bg_amount = $('#b_bg_amount').val();
            var a_bg_amount = $('#a_bg_amount').val();
            var b_lc_amount = $('#b_lc_amount').val();
            var a_lc_amount = $('#a_lc_amount').val();
            var b_pdc_amount = $('#b_pdc_amount').val();
            var a_pdc_amount = $('#a_pdc_amount').val();

            var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount);

            if (total_percent > 100) {
                alert('Percentage should not be more than 100%');
                $('#a_pdc_percent').val('');
                $('#a_pdc_amount').val('');
            } else {
                var balance = Number($('#sub_total').val());

                if (balance != '') {
                    var amount = (Number(a_pdc_percent) * balance) / 100;
                    var net_amount = amount.toFixed(2);
                    var remaining_balance = balance - total_amount - net_amount;
                    var remaining = remaining_balance.toFixed(2);
                    if (remaining < 0) {
                        remaining = 0;
                    }
                    $('#a_pdc_amount').val(net_amount);
                    $('#remaining_balance').val(remaining);
                    $('#balance').html(remaining);
                }
            }
        }



    }

    function enablePaymentCondition(paymode) {
        var order_type = $('#order_type').val();
        if (order_type == "Service") {
            var subtotal = $('#service_sub_total').val();
        } else {
            var subtotal = $('#sub_total').val();
        }
        if (paymode == "b_cash") {
            if ($('#b_cash').prop('checked')) {
                var b_cash_percent = Number($('#b_cash_percent').val());
                var a_cash_percent = Number($('#a_cash_percent').val());
                var b_bg_percent = Number($('#b_bg_percent').val());
                var a_bg_percent = Number($('#a_bg_percent').val());
                var b_lc_percent = Number($('#b_lc_percent').val());
                var a_lc_percent = Number($('#a_lc_percent').val());
                var b_pdc_percent = Number($('#b_pdc_percent').val());
                var a_pdc_percent = Number($('#a_pdc_percent').val());
                if ($('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')) {
                    if ($('#a_cash').prop('checked') && a_cash_percent == '') {
                        $('#b_cash').prop('checked', false);
                    } else if ($('#b_bg').prop('checked') && b_bg_percent == '') {
                        $('#b_cash').prop('checked', false);
                    } else if ($('#a_bg').prop('checked') && a_bg_percent == '') {
                        $('#b_cash').prop('checked', false);
                    } else if ($('#b_lc').prop('checked') && b_lc_percent == '') {
                        $('#b_cash').prop('checked', false);
                    } else if ($('#a_lc').prop('checked') && a_lc_percent == '') {
                        $('#b_cash').prop('checked', false);
                    } else if ($('#b_pdc').prop('checked') && b_pdc_percent == '') {
                        $('#b_cash').prop('checked', false);
                    } else if ($('#a_pdc').prop('checked') && a_pdc_percent == '') {
                        $('#b_cash').prop('checked', false);
                    } else {
                        var total_percent = a_cash_percent + b_bg_percent + a_bg_percent + b_lc_percent + a_lc_percent + b_pdc_percent + a_pdc_percent;
                        if (total_percent < 100) {
                            $('#b_cash_tenor').prop('readonly', false);
                            $('#b_cash_percent').prop('readonly', false);
                            $('#b_cash_percent').prop('required', true);
                        } else {
                            $('#b_cash').prop('checked', false);
                        }
                    }

                } else {

                    var total_percent = a_cash_percent + b_bg_percent + a_bg_percent + b_lc_percent + a_lc_percent + b_pdc_percent + a_pdc_percent;
                    if (total_percent < 100) {
                        $('#b_cash_tenor').prop('readonly', false);
                        $('#b_cash_percent').prop('readonly', false);
                        $('#b_cash_percent').prop('required', true);
                    } else {
                        $('#b_cash').prop('checked', false);
                    }
                }

            } else {
                var b_cash_amount = $('#b_cash_amount').val();
                var a_cash_amount = $('#a_cash_amount').val();
                var b_bg_amount = $('#b_bg_amount').val();
                var a_bg_amount = $('#a_bg_amount').val();
                var b_lc_amount = $('#b_lc_amount').val();
                var a_lc_amount = $('#a_lc_amount').val();
                var b_pdc_amount = $('#b_pdc_amount').val();
                var a_pdc_amount = $('#a_pdc_amount').val();

                var total_amount = Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
                if (total_amount > 0) {
                    var net_total = Number($('#sub_total').val()) - total_amount;
                } else {
                    var net_total = Number($('#sub_total').val());
                }
                $('#balance').html(net_total);
                $('#b_cash_amount').val('');
                $('#b_cash_tenor').val('');
                $('#b_cash_percent').val('');

                $('#b_cash_tenor').prop('readonly', true);
                $('#b_cash_percent').prop('readonly', true);
                $('#b_cash_percent').prop('required', false);
            }
        } else if (paymode == "a_cash") {
            if ($('#a_cash').prop('checked')) {
                var b_cash_percent = Number($('#b_cash_percent').val());
                var a_cash_percent = Number($('#a_cash_percent').val());
                var b_bg_percent = Number($('#b_bg_percent').val());
                var a_bg_percent = Number($('#a_bg_percent').val());
                var b_lc_percent = Number($('#b_lc_percent').val());
                var a_lc_percent = Number($('#a_lc_percent').val());
                var b_pdc_percent = Number($('#b_pdc_percent').val());
                var a_pdc_percent = Number($('#a_pdc_percent').val());
                var total_percent = b_cash_percent + b_bg_percent + a_bg_percent + b_lc_percent + a_lc_percent + b_pdc_percent + a_pdc_percent;
                if ($('#b_cash').prop('checked') || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')) {
                    if ($('#b_cash').prop('checked') && b_cash_percent == '') {
                        $('#a_cash').prop('checked', false);
                    } else if ($('#b_bg').prop('checked') && b_bg_percent == '') {
                        $('#a_cash').prop('checked', false);
                    } else if ($('#a_bg').prop('checked') && a_bg_percent == '') {
                        $('#a_cash').prop('checked', false);
                    } else if ($('#b_lc').prop('checked') && b_lc_percent == '') {
                        $('#a_cash').prop('checked', false);
                    } else if ($('#a_lc').prop('checked') && a_lc_percent == '') {
                        $('#a_cash').prop('checked', false);
                    } else if ($('#b_pdc').prop('checked') && b_pdc_percent == '') {
                        $('#a_cash').prop('checked', false);
                    } else if ($('#a_pdc').prop('checked') && a_pdc_percent == '') {
                        $('#a_cash').prop('checked', false);
                    } else {

                        if (total_percent < 100) {
                            $('#a_cash_tenor').prop('readonly', false);
                            $('#a_cash_percent').prop('readonly', false);
                            $('#a_cash_percent').prop('required', true);
                        } else {
                            $('#a_cash').prop('checked', false);
                        }
                    }

                } else {
                    if (total_percent < 100) {
                        $('#a_cash_tenor').prop('readonly', false);
                        $('#a_cash_percent').prop('readonly', false);
                        $('#a_cash_percent').prop('required', true);
                    } else {
                        $('#a_cash').prop('checked', false);
                    }
                }

            } else {
                var b_cash_amount = $('#b_cash_amount').val();
                var a_cash_amount = $('#a_cash_amount').val();
                var b_bg_amount = $('#b_bg_amount').val();
                var a_bg_amount = $('#a_bg_amount').val();
                var b_lc_amount = $('#b_lc_amount').val();
                var a_lc_amount = $('#a_lc_amount').val();
                var b_pdc_amount = $('#b_pdc_amount').val();
                var a_pdc_amount = $('#a_pdc_amount').val();

                var total_amount = Number(b_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
                if (total_amount > 0) {
                    var net_total = Number($('#sub_total').val()) - total_amount;
                } else {
                    var net_total = Number($('#sub_total').val());
                }
                $('#balance').html(net_total);
                $('#a_cash_amount').val('');
                $('#a_cash_tenor').val('');
                $('#a_cash_percent').val('');

                $('#a_cash_tenor').prop('readonly', true);
                $('#a_cash_percent').prop('readonly', true);

                $('#a_cash_percent').prop('required', false);
            }
        } else if (paymode == "b_bg") {
            if ($('#b_bg').prop('checked')) {
                var b_cash_percent = Number($('#b_cash_percent').val());
                var a_cash_percent = Number($('#a_cash_percent').val());
                var b_bg_percent = Number($('#b_bg_percent').val());
                var a_bg_percent = Number($('#a_bg_percent').val());
                var b_lc_percent = Number($('#b_lc_percent').val());
                var a_lc_percent = Number($('#a_lc_percent').val());
                var b_pdc_percent = Number($('#b_pdc_percent').val());
                var a_pdc_percent = Number($('#a_pdc_percent').val());
                var total_percent = b_cash_percent + a_cash_percent + a_bg_percent + b_lc_percent + a_lc_percent + b_pdc_percent + a_pdc_percent;
                if ($('#b_cash').prop('checked') || $('#a_cash').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')) {
                    if ($('#b_cash').prop('checked') && b_cash_percent == '') {
                        $('#b_bg').prop('checked', false);
                    } else if ($('#a_cash').prop('checked') && a_cash_percent == '') {
                        $('#b_bg').prop('checked', false);
                    } else if ($('#a_bg').prop('checked') && a_bg_percent == '') {
                        $('#b_bg').prop('checked', false);
                    } else if ($('#b_lc').prop('checked') && b_lc_percent == '') {
                        $('#b_bg').prop('checked', false);
                    } else if ($('#a_lc').prop('checked') && a_lc_percent == '') {
                        $('#b_bg').prop('checked', false);
                    } else if ($('#b_pdc').prop('checked') && b_pdc_percent == '') {
                        $('#b_bg').prop('checked', false);
                    } else if ($('#a_pdc').prop('checked') && a_pdc_percent == '') {
                        $('#b_bg').prop('checked', false);
                    } else {

                        if (total_percent < 100) {
                            $('#b_bg_tenor').prop('readonly', false);
                            $('#b_bg_percent').prop('readonly', false);
                            $('#b_bg_tenor').prop('required', true);
                            $('#b_bg_percent').prop('required', true);
                        } else {
                            $('#b_bg').prop('checked', false);
                        }
                    }

                } else {
                    if (total_percent < 100) {
                        $('#b_bg_tenor').prop('readonly', false);
                        $('#b_bg_percent').prop('readonly', false);
                        $('#b_bg_tenor').prop('required', true);
                        $('#b_bg_percent').prop('required', true);
                    } else {
                        $('#b_bg').prop('checked', false);
                    }
                }

            } else {
                var b_cash_amount = $('#b_cash_amount').val();
                var a_cash_amount = $('#a_cash_amount').val();
                var b_bg_amount = $('#b_bg_amount').val();
                var a_bg_amount = $('#a_bg_amount').val();
                var b_lc_amount = $('#b_lc_amount').val();
                var a_lc_amount = $('#a_lc_amount').val();
                var b_pdc_amount = $('#b_pdc_amount').val();
                var a_pdc_amount = $('#a_pdc_amount').val();

                var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
                if (total_amount > 0) {
                    var net_total = Number($('#sub_total').val()) - total_amount;
                } else {
                    var net_total = Number($('#sub_total').val());
                }
                $('#balance').html(net_total);
                $('#b_bg_amount').val('');
                $('#b_bg_tenor').val('');
                $('#b_bg_percent').val('');

                $('#b_bg_tenor').prop('readonly', true);
                $('#b_bg_percent').prop('readonly', true);

                $('#b_bg_tenor').prop('required', false);
                $('#b_bg_percent').prop('required', false);
            }
        } else if (paymode == "a_bg") {
            if ($('#a_bg').prop('checked')) {
                var b_cash_percent = Number($('#b_cash_percent').val());
                var a_cash_percent = Number($('#a_cash_percent').val());
                var b_bg_percent = Number($('#b_bg_percent').val());
                var a_bg_percent = Number($('#a_bg_percent').val());
                var b_lc_percent = Number($('#b_lc_percent').val());
                var a_lc_percent = Number($('#a_lc_percent').val());
                var b_pdc_percent = Number($('#b_pdc_percent').val());
                var a_pdc_percent = Number($('#a_pdc_percent').val());
                var total_percent = b_cash_percent + a_cash_percent + b_bg_percent + b_lc_percent + a_lc_percent + b_pdc_percent + a_pdc_percent;
                if ($('#b_cash').prop('checked') || $('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')) {
                    if ($('#b_cash').prop('checked') && b_cash_percent == '') {
                        $('#a_bg').prop('checked', false);
                    } else if ($('#a_cash').prop('checked') && a_cash_percent == '') {
                        $('#a_bg').prop('checked', false);
                    } else if ($('#b_bg').prop('checked') && b_bg_percent == '') {
                        $('#a_bg').prop('checked', false);
                    } else if ($('#b_lc').prop('checked') && b_lc_percent == '') {
                        $('#a_bg').prop('checked', false);
                    } else if ($('#a_lc').prop('checked') && a_lc_percent == '') {
                        $('#a_bg').prop('checked', false);
                    } else if ($('#b_pdc').prop('checked') && b_pdc_percent == '') {
                        $('#a_bg').prop('checked', false);
                    } else if ($('#a_pdc').prop('checked') && a_pdc_percent == '') {
                        $('#a_bg').prop('checked', false);
                    } else {

                        if (total_percent < 100) {
                            $('#a_bg_tenor').prop('readonly', false);
                            $('#a_bg_percent').prop('readonly', false);
                            $('#a_bg_tenor').prop('required', true);
                            $('#a_bg_percent').prop('required', true);
                        } else {
                            $('#a_bg').prop('checked', false);
                        }
                    }

                } else {
                    if (total_percent < 100) {
                        $('#a_bg_tenor').prop('readonly', false);
                        $('#a_bg_percent').prop('readonly', false);
                        $('#a_bg_tenor').prop('required', true);
                        $('#a_bg_percent').prop('required', true);
                    } else {
                        $('#a_bg').prop('checked', false);
                    }
                }

            } else {
                var b_cash_amount = $('#b_cash_amount').val();
                var a_cash_amount = $('#a_cash_amount').val();
                var b_bg_amount = $('#b_bg_amount').val();
                var a_bg_amount = $('#a_bg_amount').val();
                var b_lc_amount = $('#b_lc_amount').val();
                var a_lc_amount = $('#a_lc_amount').val();
                var b_pdc_amount = $('#b_pdc_amount').val();
                var a_pdc_amount = $('#a_pdc_amount').val();

                var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
                if (total_amount > 0) {
                    var net_total = Number($('#sub_total').val()) - total_amount;
                } else {
                    var net_total = Number($('#sub_total').val());
                }
                $('#balance').html(net_total);
                $('#a_bg_amount').val('');
                $('#a_bg_tenor').val('');
                $('#a_bg_percent').val('');

                $('#a_bg_tenor').prop('readonly', true);
                $('#a_bg_percent').prop('readonly', true);
                $('#a_bg_tenor').prop('required', false);
                $('#a_bg_percent').prop('required', false);
            }
        } else if (paymode == "b_lc") {
            if ($('#b_lc').prop('checked')) {
                var b_cash_percent = Number($('#b_cash_percent').val());
                var a_cash_percent = Number($('#a_cash_percent').val());
                var b_bg_percent = Number($('#b_bg_percent').val());
                var a_bg_percent = Number($('#a_bg_percent').val());
                var b_lc_percent = Number($('#b_lc_percent').val());
                var a_lc_percent = Number($('#a_lc_percent').val());
                var b_pdc_percent = Number($('#b_pdc_percent').val());
                var a_pdc_percent = Number($('#a_pdc_percent').val());
                var total_percent = b_cash_percent + a_cash_percent + b_bg_percent + a_bg_percent + a_lc_percent + b_pdc_percent + a_pdc_percent;
                if ($('#b_cash').prop('checked') || $('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')) {
                    if ($('#b_cash').prop('checked') && b_cash_percent == '') {
                        $('#b_lc').prop('checked', false);
                    } else if ($('#a_cash').prop('checked') && a_cash_percent == '') {
                        $('#b_lc').prop('checked', false);
                    } else if ($('#b_bg').prop('checked') && b_bg_percent == '') {
                        $('#b_lc').prop('checked', false);
                    } else if ($('#a_bg').prop('checked') && a_bg_percent == '') {
                        $('#b_lc').prop('checked', false);
                    } else if ($('#a_lc').prop('checked') && a_lc_percent == '') {
                        $('#b_lc').prop('checked', false);
                    } else if ($('#b_pdc').prop('checked') && b_pdc_percent == '') {
                        $('#b_lc').prop('checked', false);
                    } else if ($('#a_pdc').prop('checked') && a_pdc_percent == '') {
                        $('#b_lc').prop('checked', false);
                    } else {

                        if (total_percent < 100) {
                            $('#b_lc_tenor').prop('readonly', false);
                            $('#b_lc_percent').prop('readonly', false);
                            $('#b_lc_tenor').prop('required', true);
                            $('#b_lc_percent').prop('required', true);
                        } else {
                            $('#b_lc').prop('checked', false);
                        }
                    }

                } else {
                    if (total_percent < 100) {
                        $('#b_lc_tenor').prop('readonly', false);
                        $('#b_lc_percent').prop('readonly', false);
                        $('#b_lc_tenor').prop('required', true);
                        $('#b_lc_percent').prop('required', true);
                    } else {
                        $('#b_lc').prop('checked', false);
                    }
                }
            } else {
                var b_cash_amount = $('#b_cash_amount').val();
                var a_cash_amount = $('#a_cash_amount').val();
                var b_bg_amount = $('#b_bg_amount').val();
                var a_bg_amount = $('#a_bg_amount').val();
                var b_lc_amount = $('#b_lc_amount').val();
                var a_lc_amount = $('#a_lc_amount').val();
                var b_pdc_amount = $('#b_pdc_amount').val();
                var a_pdc_amount = $('#a_pdc_amount').val();

                var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(a_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
                if (total_amount > 0) {
                    var net_total = Number($('#sub_total').val()) - total_amount;
                } else {
                    var net_total = Number($('#sub_total').val());
                }

                $('#balance').html(net_total);
                $('#b_lc_amount').val('');
                $('#b_lc_tenor').val('');
                $('#b_lc_percent').val('');

                $('#b_lc_tenor').prop('readonly', true);
                $('#b_lc_percent').prop('readonly', true);
                $('#b_lc_tenor').prop('required', false);
                $('#b_lc_percent').prop('required', false);
            }
        } else if (paymode == "a_lc") {
            if ($('#a_lc').prop('checked')) {
                var b_cash_percent = Number($('#b_cash_percent').val());
                var a_cash_percent = Number($('#a_cash_percent').val());
                var b_bg_percent = Number($('#b_bg_percent').val());
                var a_bg_percent = Number($('#a_bg_percent').val());
                var b_lc_percent = Number($('#b_lc_percent').val());
                var a_lc_percent = Number($('#a_lc_percent').val());
                var b_pdc_percent = Number($('#b_pdc_percent').val());
                var a_pdc_percent = Number($('#a_pdc_percent').val());
                var total_percent = b_cash_percent + a_cash_percent + b_bg_percent + a_bg_percent + b_lc_percent + b_pdc_percent + a_pdc_percent;
                if ($('#b_cash').prop('checked') || $('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#b_pdc').prop('checked') || $('#a_pdc').prop('checked')) {
                    if ($('#b_cash').prop('checked') && b_cash_percent == '') {
                        $('#a_lc').prop('checked', false);
                    } else if ($('#a_cash').prop('checked') && a_cash_percent == '') {
                        $('#a_lc').prop('checked', false);
                    } else if ($('#b_bg').prop('checked') && b_bg_percent == '') {
                        $('#a_lc').prop('checked', false);
                    } else if ($('#a_bg').prop('checked') && a_bg_percent == '') {
                        $('#a_lc').prop('checked', false);
                    } else if ($('#b_lc').prop('checked') && b_lc_percent == '') {
                        $('#a_lc').prop('checked', false);
                    } else if ($('#b_pdc').prop('checked') && b_pdc_percent == '') {
                        $('#a_lc').prop('checked', false);
                    } else if ($('#a_pdc').prop('checked') && a_pdc_percent == '') {
                        $('#a_lc').prop('checked', false);
                    } else {

                        if (total_percent < 100) {
                            $('#a_lc_tenor').prop('readonly', false);
                            $('#a_lc_percent').prop('readonly', false);
                            $('#a_lc_tenor').prop('required', true);
                            $('#a_lc_percent').prop('required', true);
                        } else {
                            $('#a_lc').prop('checked', false);
                        }
                    }

                } else {
                    if (total_percent < 100) {
                        $('#a_lc_tenor').prop('readonly', false);
                        $('#a_lc_percent').prop('readonly', false);
                        $('#a_lc_tenor').prop('required', true);
                        $('#a_lc_percent').prop('required', true);
                    } else {
                        $('#a_lc').prop('checked', false);
                    }
                }

            } else {
                var b_cash_amount = $('#b_cash_amount').val();
                var a_cash_amount = $('#a_cash_amount').val();
                var b_bg_amount = $('#b_bg_amount').val();
                var a_bg_amount = $('#a_bg_amount').val();
                var b_lc_amount = $('#b_lc_amount').val();
                var a_lc_amount = $('#a_lc_amount').val();
                var b_pdc_amount = $('#b_pdc_amount').val();
                var a_pdc_amount = $('#a_pdc_amount').val();

                var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(b_pdc_amount) + Number(a_pdc_amount);
                if (total_amount > 0) {
                    var net_total = Number($('#sub_total').val()) - total_amount;
                } else {
                    var net_total = Number($('#sub_total').val());
                }

                $('#balance').html(net_total);
                $('#a_lc_amount').val('');
                $('#a_lc_tenor').val('');
                $('#a_lc_percent').val('');

                $('#a_lc_tenor').prop('readonly', true);
                $('#a_lc_percent').prop('readonly', true);
                $('#a_lc_tenor').prop('required', false);
                $('#a_lc_percent').prop('required', false);
            }
        } else if (paymode == "b_pdc") {
            if ($('#b_pdc').prop('checked')) {
                var b_cash_percent = Number($('#b_cash_percent').val());
                var a_cash_percent = Number($('#a_cash_percent').val());
                var b_bg_percent = Number($('#b_bg_percent').val());
                var a_bg_percent = Number($('#a_bg_percent').val());
                var b_lc_percent = Number($('#b_lc_percent').val());
                var a_lc_percent = Number($('#a_lc_percent').val());
                var b_pdc_percent = Number($('#b_pdc_percent').val());
                var a_pdc_percent = Number($('#a_pdc_percent').val());
                var total_percent = b_cash_percent + a_cash_percent + b_bg_percent + a_bg_percent + b_lc_percent + a_lc_percent + a_pdc_percent;
                if ($('#b_cash').prop('checked') || $('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#a_pdc').prop('checked')) {
                    if ($('#b_cash').prop('checked') && b_cash_percent == '') {
                        $('#b_pdc').prop('checked', false);
                    } else if ($('#a_cash').prop('checked') && a_cash_percent == '') {
                        $('#b_pdc').prop('checked', false);
                    } else if ($('#b_bg').prop('checked') && b_bg_percent == '') {
                        $('#b_pdc').prop('checked', false);
                    } else if ($('#a_bg').prop('checked') && a_bg_percent == '') {
                        $('#b_pdc').prop('checked', false);
                    } else if ($('#b_lc').prop('checked') && b_lc_percent == '') {
                        $('#b_pdc').prop('checked', false);
                    } else if ($('#a_lc').prop('checked') && a_lc_percent == '') {
                        $('#b_pdc').prop('checked', false);
                    } else if ($('#a_pdc').prop('checked') && a_pdc_percent == '') {
                        $('#b_pdc').prop('checked', false);
                    } else {

                        if (total_percent < 100) {
                            $('#b_pdc_check').prop('readonly', false);
                            $('#b_pdc_percent').prop('readonly', false);
                            $('#b_pdc_check').prop('required', true);
                            $('#b_pdc_percent').prop('required', true);
                        } else {
                            $('#b_pdc').prop('checked', false);
                        }
                    }

                } else {
                    if (total_percent < 100) {
                        $('#b_pdc_check').prop('readonly', false);
                        $('#b_pdc_percent').prop('readonly', false);
                        $('#b_pdc_check').prop('required', true);
                        $('#b_pdc_percent').prop('required', true);
                    } else {
                        $('#b_pdc').prop('checked', false);
                    }
                }

            } else {
                var b_cash_amount = $('#b_cash_amount').val();
                var a_cash_amount = $('#a_cash_amount').val();
                var b_bg_amount = $('#b_bg_amount').val();
                var a_bg_amount = $('#a_bg_amount').val();
                var b_lc_amount = $('#b_lc_amount').val();
                var a_lc_amount = $('#a_lc_amount').val();
                var b_pdc_amount = $('#b_pdc_amount').val();
                var a_pdc_amount = $('#a_pdc_amount').val();

                var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(a_pdc_amount);
                if (total_amount > 0) {
                    var net_total = Number($('#sub_total').val()) - total_amount;
                } else {
                    var net_total = Number($('#sub_total').val());
                }

                $('#balance').html(net_total);
                $('#b_pdc_amount').val('');
                $('#b_pdc_check').val('');
                $('#b_pdc_percent').val('');

                $('#b_pdc_check').prop('readonly', true);
                $('#b_pdc_percent').prop('readonly', true);
                $('#b_pdc_check').prop('required', false);
                $('#b_pdc_percent').prop('required', false);
            }
        } else if (paymode == "a_pdc") {
            if ($('#a_pdc').prop('checked')) {
                var b_cash_percent = Number($('#b_cash_percent').val());
                var a_cash_percent = Number($('#a_cash_percent').val());
                var b_bg_percent = Number($('#b_bg_percent').val());
                var a_bg_percent = Number($('#a_bg_percent').val());
                var b_lc_percent = Number($('#b_lc_percent').val());
                var a_lc_percent = Number($('#a_lc_percent').val());
                var b_pdc_percent = Number($('#b_pdc_percent').val());
                var a_pdc_percent = Number($('#a_pdc_percent').val());
                var total_percent = b_cash_percent + a_cash_percent + b_bg_percent + a_bg_percent + b_lc_percent + a_lc_percent + b_pdc_percent;
                if ($('#b_cash').prop('checked') || $('#a_cash').prop('checked') || $('#b_bg').prop('checked') || $('#a_bg').prop('checked') || $('#b_lc').prop('checked') || $('#a_lc').prop('checked') || $('#b_pdc').prop('checked')) {
                    if ($('#b_cash').prop('checked') && b_cash_percent == '') {
                        $('#a_pdc').prop('checked', false);
                    } else if ($('#a_cash').prop('checked') && a_cash_percent == '') {
                        $('#a_pdc').prop('checked', false);
                    } else if ($('#b_bg').prop('checked') && b_bg_percent == '') {
                        $('#a_pdc').prop('checked', false);
                    } else if ($('#a_bg').prop('checked') && a_bg_percent == '') {
                        $('#a_pdc').prop('checked', false);
                    } else if ($('#b_lc').prop('checked') && b_lc_percent == '') {
                        $('#a_pdc').prop('checked', false);
                    } else if ($('#a_lc').prop('checked') && a_lc_percent == '') {
                        $('#a_pdc').prop('checked', false);
                    } else if ($('#b_pdc').prop('checked') && b_pdc_percent == '') {
                        $('#a_pdc').prop('checked', false);
                    } else {

                        if (total_percent < 100) {
                            $('#a_pdc_check').prop('readonly', false);
                            $('#a_pdc_percent').prop('readonly', false);
                            $('#a_pdc_check').prop('required', true);
                            $('#a_pdc_percent').prop('required', true);
                        } else {
                            $('#a_pdc').prop('checked', false);
                        }
                    }

                } else {
                    if (total_percent < 100) {
                        $('#a_pdc_check').prop('readonly', false);
                        $('#a_pdc_percent').prop('readonly', false);
                        $('#a_pdc_check').prop('required', true);
                        $('#a_pdc_percent').prop('required', true);
                    } else {
                        $('#a_pdc').prop('checked', false);
                    }
                }

            } else {
                var b_cash_amount = $('#b_cash_amount').val();
                var a_cash_amount = $('#a_cash_amount').val();
                var b_bg_amount = $('#b_bg_amount').val();
                var a_bg_amount = $('#a_bg_amount').val();
                var b_lc_amount = $('#b_lc_amount').val();
                var a_lc_amount = $('#a_lc_amount').val();
                var b_pdc_amount = $('#b_pdc_amount').val();
                var a_pdc_amount = $('#a_pdc_amount').val();

                var total_amount = Number(b_cash_amount) + Number(a_cash_amount) + Number(b_bg_amount) + Number(a_bg_amount) + Number(b_lc_amount) + Number(a_lc_amount) + Number(b_pdc_amount);
                if (total_amount > 0) {
                    var net_total = Number($('#sub_total').val()) - total_amount;
                } else {
                    var net_total = Number($('#sub_total').val());
                }

                $('#balance').html(net_total);
                $('#a_pdc_amount').val('');
                $('#a_pdc_check').val('');
                $('#a_pdc_percent').val('');

                $('#a_pdc_check').prop('readonly', true);
                $('#a_pdc_percent').prop('readonly', true);
                $('#a_pdc_check').prop('required', false);
                $('#a_pdc_percent').prop('required', false);
            }
        }

    }

    //Terms And Conditions
    $('#specification_hide_button').click(function () {
        $('#specification_raw_material').hide();
        $('#specification_show_button').show();
        $('#specification_hide_button').hide();
    });

    $('#specification_show_button').click(function () {
        $('#specification_raw_material').show();
        $('#specification_hide_button').show();
        $('#specification_show_button').hide();

    });

    $('#copy_hide_button').click(function () {
        $('#copy_div').hide();
        $('#copy_show_button').show();
        $('#copy_hide_button').hide();
    });

    $('#copy_show_button').click(function () {
        $('#copy_div').show();
        $('#copy_hide_button').show();
        $('#copy_show_button').hide();

    });




    $('#m_specification').click(function () {
        var count = $('#material_count').val();
        var str = '<tr  id="row_' + (Number(count) + 1) + '">';

        str +='<td><input required  style="width:350px"  type="text"  name="t_or_c_name[]"  class="issue form-control"></td>';
        str +='<td><textarea required  style="width:600px" name="t_or_c_description[]"  class="issue form-control"></textarea></td>';
        str +='<td><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeTerms(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        str +='</tr>';
        $('#material_count').val(Number(count) + 1);
        $('#specificationTable').append(str);

    });

    function removeTerms(row) {
        var count = $('#material_count').val();
        $('#material_count').val(Number(count) - 1);
        $('#row_' + row).remove();

    }

    $('#copy_to').click(function () {
        var count = $('#copy_count').val();
        var str = '<tr  id="row_' + (Number(count) + 1) + '">';


        str += '<td><input required  style="width:350px"  type="text"  name="copy_description[]"  class="issue form-control"></td>';
        str += '<td><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="c_button" onclick="removeCopy(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        str += '</tr>';
        $('#copy_count').val(Number(count) + 1);
        $('#copyTable').append(str);

    });

    function removeCopy(row) {
        var count = $('#copy_count').val();
        $('#copy_count').val(Number(count) - 1);
        $('#row_' + row).remove();

    }



    function closeImage(d_id){
        //var expenseID = $('#expenseID').(val);  
      
      
        var data = {'d_id': d_id}

           $.ajax({
               url: '<?php echo site_url('purchase_orders/delete_iamge'); ?>',
               data: data,
               method: 'POST',
               dataType: 'json',
               success: function (msg) {
                   $("#imageDiv").load(location.href+" #imageDiv>");
              }
         })
   }




</script>

<script>
    var viewModel = {};
    viewModel.fileData = ko.observable({
        dataURL: ko.observable(),
        // can add "fileTypes" observable here, and it will override the "accept" attribute on the file input
        // fileTypes: ko.observable('.xlsx,image/png,audio/*')
    });
    viewModel.multiFileData = ko.observable({ dataURLArray: ko.observableArray() });
    viewModel.onClear = function (fileData) {
        if (confirm('Are you sure?')) {
            fileData.clear && fileData.clear();
        }
    };
    viewModel.debug = function () {
        window.viewModel = viewModel;
        console.log(ko.toJSON(viewModel));
        debugger;
    };
    viewModel.onInvalidFileDrop = function(failedFiles) {
        var fileNames = [];
        for (var i = 0; i < failedFiles.length; i++) {
            fileNames.push(failedFiles[i].name);
        }
        var message = 'Invalid file type: ' + fileNames.join(', ');
        alert(message)
        console.error(message);
    };
    ko.applyBindings(viewModel);
</script>