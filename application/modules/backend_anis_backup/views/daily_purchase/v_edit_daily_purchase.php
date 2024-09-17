<?php
$employee_id = $this->session->userdata('employeeId');
$user_type = $this->session->userdata('user_type');
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Daily Purchase</h3>
            </div>
        </div>
        <!--            <div class="row">
                         <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                    </div>-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form action="<?php echo site_url('daily_purchase/edit_purchase_order_action/' . $purchase_order_info[0]['o_id']); ?>" method="post" onsubmit="javascript: return validation()" >
                            <div class="row" style="margin-left:0px;">   
                                <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label">
                                       Purchase Type<sup class="required">*</sup>:
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
                                      Purchase<sup class="required">*</sup>
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
                                        Purchase No <sup class="required">*</sup>:
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
                                                <td><input readonly  style="width:100%;text-align: right;"  type="text" class="form-control"  name="amount[]" id="amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['amount']; //echo number_format($purchase_order_details['amount']); ?>"></td>
                                                <td><input   style="width:100%;" rows="3"  type="text" class="form-control"  name="remark[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['remark'] ?>"></td>

                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                    <tfoot class="tfoot-color">
                                        <tr>
                                            <td colspan="8" style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;">Subtotal:</td>

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
                                                <td><input readonly  style="width:100%;text-align: right;"  type="text" class="form-control"  name="amount[]" id="amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['amount'];  //echo number_format($purchase_order_details['amount']); ?>"></td>
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
                                                    <input style="width:100%;text-align: right;"  type="hidden"  name="pre_quantity[]" id="pre_quantity_<?php echo $i; ?>" class="issue form-control" value="<?php echo $purchase_order_details['quantity'] ?>">
                                                    <input onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"   style="width:100%;text-align: right;"  type="text"  name="quantity[]" id="quantity_<?php echo $i; ?>" class="issue form-control" value="<?php echo $purchase_order_details['quantity'] ?>">
                                                </td>
                                                <td><input onkeyup="calculateSubtotal(<?php echo $i; ?>)" onchange="calculateSubtotal(<?php echo $i; ?>)" onblur="calculateSubtotal(<?php echo $i; ?>)"  style="width:100%;text-align: right;"  type="text"  name="unit_price[]" id="unit_price_<?php echo $i; ?>" class="issue form-control" value="<?php echo $purchase_order_details['unit_price'] ?>"></td>    
                                                <td><input readonly  style="width:100%;text-align: right;"  type="text" class="form-control"  name="amount[]" id="amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['amount']; //echo number_format($purchase_order_details['amount']); ?>"></td>
                                                <td><input   style="width:100%;" rows="3"  type="text" class="form-control"  name="remark[]" id="item_amount_<?php echo $i; ?>" class="issue" value="<?php echo $purchase_order_details['remark'] ?>"></td>

                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                    <tfoot class="">
                                        <tr>
                                            <td colspan="7" style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;">Subtotal:</td>

                                            <td colspan="2"><input class="form-control" readonly style="width:140px;text-align: right;" id="sub_total"  name="sub_total_amount" type="text" value="<?php if (!empty($purchase_order_info[0]['sub_total_amount'])) echo $purchase_order_info[0]['sub_total_amount']; ?>"></td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="7" style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;">Transport Cost:</td>

                                            <td colspan="2"><input onblur="javascript:calculateNetPayableAmount();" onkeyup="javascript:calculateNetPayableAmount();" onchange="javascript:calculateNetPayableAmount();" class="number form-control"  style="width:140px;text-align: right;" id="transport_cost"  name="transport_cost" type="text" value="<?php if (!empty($purchase_order_info[0]['transport_cost'])) echo $purchase_order_info[0]['transport_cost']; ?>"></td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="7" style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;">Cutting Cost:</td>

                                            <td colspan="2"><input onblur="javascript:calculateNetPayableAmount();" onkeyup="javascript:calculateNetPayableAmount();" onchange="javascript:calculateNetPayableAmount();" class="number form-control"  style="width:140px;text-align: right;" id="cutting_cost"  name="cutting_cost" type="text" value="<?php if (!empty($purchase_order_info[0]['cutting_cost'])) echo $purchase_order_info[0]['cutting_cost']; ?>"></td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="7" style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;">Labour Cost:</td>

                                            <td colspan="2"><input onblur="javascript:calculateNetPayableAmount();" onkeyup="javascript:calculateNetPayableAmount();" onchange="javascript:calculateNetPayableAmount();" class="number form-control"  style="width:140px;text-align: right;" id="labour_cost"  name="labour_cost" type="text" value="<?php if (!empty($purchase_order_info[0]['labour_cost'])) echo $purchase_order_info[0]['labour_cost']; ?>"></td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="7" style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;">Other Cost:</td>

                                            <td colspan="2"><input onblur="javascript:calculateNetPayableAmount();" onkeyup="javascript:calculateNetPayableAmount();" onchange="javascript:calculateNetPayableAmount();" class="number form-control"  style="width:140px;text-align: right;" id="other_cost"  name="other_cost" type="text" value="<?php if (!empty($purchase_order_info[0]['other_cost'])) echo $purchase_order_info[0]['other_cost']; ?>"></td>
                                        </tr>
                                        
                                        
                                         <tr>
                                            <td colspan="7" style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;">Discount:</td>

                                            <td colspan="2"><input onblur="javascript:calculateNetPayableAmount();" onkeyup="javascript:calculateNetPayableAmount();" onchange="javascript:calculateNetPayableAmount();" class="number form-control"  style="width:140px;text-align: right;" id="discount"  name="discount" type="text" value="<?php if (!empty($purchase_order_info[0]['discount'])) echo $purchase_order_info[0]['discount']; ?>"></td>
                                        </tr>
                                        
                                         <tr>
                                            <td colspan="7" style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;">Net Total:</td>

                                            <td colspan="2"><input class="form-control" readonly style="width:140px;text-align: right;" id="total_amount"  name="total_amount" type="text" value="<?php if (!empty($purchase_order_info[0]['total_amount'])) echo $purchase_order_info[0]['total_amount']; ?>"></td>
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
                            



                            <div class="separator-shadow"></div>
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/daily_purchase') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

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
        var table_row = Number(rowCount) - 8;
        for (var i = 1; i <= table_row; i++) {
            var amt = $('#amount_' + i).val();
            sub_total = sub_total + Number(amt)

        }
        $('#sub_total').val(sub_total);
        
        var discount=Number($('#discount').val());
        var transport_cost=Number($('#transport_cost').val());
        var cutting_cost=Number($('#cutting_cost').val());
        var labour_cost=Number($('#labour_cost').val());
        var other_cost=Number($('#other_cost').val());
        
        var net_payable=sub_total+transport_cost+cutting_cost+labour_cost+other_cost-discount;
        $('#total_amount').val(net_payable);

    }

    
     function calculateNetPayableAmount(){
        
         $('.number').on('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);  
        });
        
        
        var subtotal=Number($('#sub_total').val());
        var discount=Number($('#discount').val());
        var transport_cost=Number($('#transport_cost').val());
        var cutting_cost=Number($('#cutting_cost').val());
        var labour_cost=Number($('#labour_cost').val());
        var other_cost=Number($('#other_cost').val());
        
        var net_payable=subtotal+transport_cost+cutting_cost+labour_cost+other_cost-discount;
        $('#total_amount').val(net_payable);
        
    }
   



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