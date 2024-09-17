<?php

        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        
       
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Order</h3>
            </div>
        </div>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                      <form action="<?php echo site_url('purchase_orders/add_purchase_order_action'); ?>" method="post" onsubmit="javascript: return validation()" enctype="multipart/form-data">
                        <div class="row" style="margin-left:0px;">   
                                <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label">
                                       Order From<sup class="required">*</sup>:
                                    </label> 

                                    <div class="col-sm-4 input-group">
                                           <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <select  id="order_from" class="form-control e1" name="order_from">
                                                    <option  value="">Select option</option>
                                                    <option  value="Direct">Direct</option>
                                                    <option  value="Budget">Budget</option>
                                                    <option  value="Money Indent">Money Indent</option>
                                             </select>
                                    </div>
                                  <label for="title" class="col-sm-2 control-label">
                                      Order For<sup class="required">*</sup>
                                   </label>
                                  <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <select  id="order_for" class="form-control e1" name="order_type">
                                                    <option value="">Select option</option>
                                                     <?php foreach ($indent_types as $indent_type) { ?>
                                                        <option value="<?php echo $indent_type['id']; ?>"><?php if (!empty($indent_type['type_name'])) echo $indent_type['type_name']; ?></option>
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
                                                      <option class="form-control" value="<?php echo $project['d_id'] ?>"><?php echo $project['dep_description']; ?></option>
                                                  <?php } ?>
                                       </select>
                                       <span id="category_id_error" style="color:red"></span> 
                                </div> 
                             
                                 <label for="title" class="col-sm-2 control-label">
                                    Supplier/Contractor<sup class="required">*</sup> :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select   id="supplier_id" class="form-control e1" name="supplier_id">
                                        <option class="form-control" value="">Select Supplier Or Contractor</option>
                                        
                                   </select>
                                    <span id="supplier_error" style="color:red"></span>

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
                                      <!-- <input class="form-control" id="supplier_id" name="supplier_id" type="hidden" value="">-->
                                       <input class="form-control" id="o_code" name="o_code" type="hidden" value="">
                                       <input  required class="form-control" readonly id="order_no" name="order_no" type="text" value="">
                                 </div>
                                 <label for="title" class="col-sm-2 control-label">
                                    Date :
                                 </label>
                                <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                        <input required class="form-control datepicker" id="purchase_order_date" name="purchase_order_date" type="text" value="<?php echo date('d-m-Y') ?>">
                                        <span id="purchase_order_date_error" style="color:red"></span>
                               </div>
                             
                         </div>
                             
                         </div>    
                          <div class="row" style="margin-left:0px;margin-top:5px;">
                                <div class='form-group'  style="display:none;">
                                    
                               <label for="title" class="col-sm-2 control-label">
                                    Billing Address :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="billing_address" name="billing_address" type="text" placeholder="Billing Address">
                                    <span id="billing_address_error" style="color:red"></span>

                                </div>
                                    
                                <label for="title" class="col-sm-2 control-label">
                                    Billing Email :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="billing_email" name="billing_email" type="text" placeholder="Billing Email">
                                    <span id="billing_email_error" style="color:red"></span>

                                </div>
                             
                               
                         </div>
                          </div> 
                          
                          <div class="row" style="margin-left:0px;margin-top:5px;">
                              
                               <label for="title" class="col-sm-2 control-label">
                                    Delivery Address<sup class="required">*</sup> :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="shipping_address" name="shipping_address" type="text" placeholder="Delivery Address">
                                    <span id="shipping_address_error" style="color:red"></span>

                                </div>
                             
                               <label for="title" class="col-sm-2 control-label">
                                    Attention :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="attention" name="attention" type="text" placeholder="Attention Person Name">
                                    <span id="attention_error" style="color:red"></span>

                                </div>
                              
                                <div class='form-group'  style="display:none;">
                                <label for="title" class="col-sm-2 control-label">
                                    Delivery Email :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="shipping_email" name="shipping_email" type="text" placeholder="Delivery Email">
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
                                    <input  class="form-control" id="phone" name="phone" type="text" placeholder="Phone">
                                    <span id="phone_error" style="color:red"></span>

                                </div>
                                    
                                <label for="title" class="col-sm-2 control-label">
                                    Prepared By :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select id="employee_id" class="form-control e1" name="employee_id">
                                        <option class="form-control" value="">Select Employee</option>
                                        <?php foreach($employees as $employee){ ?>
                                            <option class="form-control" value="<?php echo $employee['id'] ?>"><?php echo $employee['name'].'('.$employee['designation_short_name'].')' ?></option>
                                        <?php } ?>
                                    </select>
                                    <span id="employee_id_error" style="color:red"></span>

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
                                    <input readonly class="form-control" id="order_type" name="order_type" type="text" placeholder="Order Type">
                                    

                              </div>
                             -->
                             
                         </div> 
                          </div>
                    
                          
                          
                         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Image Upload :
                                </label>
                                <div class="col-sm-10 input-group">

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
                     <table class="table table-bordered" id="myTable">
                             <thead class="thead-color">
                                 
                                 <tr>
                                 <th  style="text-align: center;"><input type="text" placeholder="Search by Indent No." id="row0" onkeyup="mySearch(0, 0)"> <sup style='color:red'>*</sup></th>
                                 <th  style="text-align: center;">Item Name <sup style='color:red'>*</sup></th>
                                 <th  style="text-align: center;" >Unit</th>
                                 <th  style="text-align: center;" >Size</th>
                                 <th  style="text-align: center;">Qnty<sup style='color:red'>*</sup></th>
                                 <th  style="text-align: center;">Unit Price<sup style='color:red'>*</sup></th>
                                 <th  style="text-align: center;">Value<sup style='color:red'>*</sup></th>
                                 <th  style="text-align: center;">Remark</th>
                                 <th  style="text-align: center;">Select</th>

                                 
                              </tr>
                            </thead>
                            <tbody id="purchase_items">
                                <tr>
                                    <td colspan="5">.</td>
                                </tr>

                            </tbody>
                               <tfoot class="tfoot-color">
                                    <tr>
                                        <td colspan="6" style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;">Subtotal:</td>

                                        <td colspan="3"><input class="form-control" readonly style="width:140px;text-align: right;" id="sub_total"  name="total_amount" type="text"></td>
                                    </tr>
                                </tfoot>
                          </table>

                     <table class="table table-bordered" id="serviceTable" style="display:none">
                             <thead class="thead-color">
                             <tr>
                                 <th style="width:10%;text-align: center;">Indent No</th>
                                 <th style="width:40%;text-align: center;">Service Name <sup style='color:red'>*</sup></th>  
                                 <th style="width:20%;text-align: center;">Value<sup style='color:red'>*</sup></th>
                                 <th style="width:30%;text-align: center;">Remark</th>
                                 <th style="width:10%;text-align: center;">Select</th>

                                 
                              </tr>
                            </thead>
                            <tbody id="service_items">
                               

                            </tbody>
                               <tfoot class="tfoot-color">
                                    <tr>
                                        <td style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;" colspan="2">Subtotal:</td>
                                        <td colspan="3"><input readonly style="width:42%;text-align: right;" class="form-control" id="service_sub_total"  name="s_total_amount" type="text"></td>
                                    </tr>
                                </tfoot>
                          </table>


                </div>
           
                
               <div class="separator-shadow row"></div>
        <h2 style="text-align:center; ">Payment Conditions</h2>
        <button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="payment_hide_button"  class="btn btn-primary "><span class="glyphicon glyphicon-minus"></span></button>
        <button  type="button" style="display:none;padding-left:6px;padding-right:6px;font-size:8px;" id="payment_show_button"  class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span></button>
        <div id="payment_condition">
               
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-8   " style="text-align:center"><b><span style="color:green;padding:5px;">Payment Mode</span></b></div>
                           
                        
                        </div>
                        <?php foreach($payment_modes as $modes){ ?>
                            <label class="radio-inline"><input type="radio" name="pm_id" value="<?php echo $modes['id']; ?>"><?php echo $modes['mode_name']; ?></label>
                        <?php } ?>    
                       
                       

                    </div><!--End Col-md-6-->
                    <div class="col-md-6">
                         <div class="form-group row">
                            <div class="col-sm-4 col-md-8   " style="text-align:center"><b><span style="color:green;padding:5px;">Payment Security</span></b></div>
                           
                        
                        </div>
                        <?php foreach($payment_securities as $security){ ?>
                            <label class="radio-inline"><input type="radio" name="security_id" value="<?php echo $security['id']; ?>"><?php echo $security['security_name']; ?></label>
                        <?php } ?>    
                       
                    </div><!--End Col-md-6-->

                </div>
        </div> 
        
        
        <h2 style="text-align:center; ">Terms & Conditions</h2>
        <button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="specification_hide_button"  class="btn btn-primary "><span class="glyphicon glyphicon-minus"></span></button>
        <button  type="button" style="display:none;padding-left:6px;padding-right:6px;font-size:8px;" id="specification_show_button"  class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span></button>
        <div id="specification_raw_material">
            <div class="row">
            <input type="hidden" value="1" id="material_count" />
                <table class="table table-bordered" id="specificationTable">
                    <thead>
                     <tr >
                        
                         <th>Term or Condition Name </th>
                         <th>Description</th>
                         <th><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="m_specification"  class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span></button></th>
                      </tr>
                    </thead>
                    <tbody id="material_specification">
                        
                      
                    </tbody>
                     
                  </table>
             
        </div> 
        </div> 
        
        <h2 style="text-align:center; ">Copy To</h2>
        <button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="copy_hide_button"  class="btn btn-primary "><span class="glyphicon glyphicon-minus"></span></button>
        <button  type="button" style="display:none;padding-left:6px;padding-right:6px;font-size:8px;" id="copy_show_button"  class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span></button>
        <div id="copy_div">
            <div class="row">
                <?php 
                    $count=count($copy_to);
                ?>
            <input type="hidden" value="<?php echo $count;  ?>" id="copy_count" />
                <table class="table table-bordered" id="specificationTable">
                    <thead>
                     <tr >
                  
                         <th>Description</th>
                         <th><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="copy_to"  class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span></button></th>
                      </tr>
                    </thead>
                    <tbody id="copyTable">
                      <?php
                      if($count>0){ 
                            $i=0;
                           foreach($copy_to as $copy){
                               $i++;
                          ?>  
                        
                            <tr  id="row_<?php echo $i; ?>">
                                 <td><input required  style="width:350px"  type="text"  name="copy_description[]"  class="issue form-control" value="<?php echo $copy['name']; ?>"></td>
                                <td><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="c_button" onclick="removeCopy(<?php echo $i; ?>)" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>'; 
                            </tr> 
                           <?php } } ?>   
                      
                    </tbody>
                     
                  </table>
             
        </div> 
        </div> 
        
       
        
        
        <div class="separator-shadow"></div>
                
                <div class="row">
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/purchase_orders') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>                 
                   </div>
                    
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">SAVE</button>
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

<script type="text/javascript">
    function mySearch(col = 0, strict = 0) {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("row" + col);
        if (strict)
            filter = input.value;
        else
            filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        var rr = 0;
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[col];
            
            if (td) {
                td = td.getElementsByTagName("input")[0];
                txtValue = td.value;
                if (!strict)
                    txtValue = txtValue.toUpperCase();
                if (txtValue.indexOf(filter) > -1) {
                    rr++;
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

    }
    
    $('#order_from').change(function(){
        var unit_id=$('#unit_id').val();
        var order_for=$('#order_for').val();
        var order_from=$('#order_from').val();
        
        
        
        if(unit_id!='' && order_for!='' && order_from!=''){
            
            $.ajax({
                url:'<?php echo site_url('purchase_orders/get_purchase_items') ?>',
                data:{'unit_id':unit_id,'order_from':order_from,'order_for':order_for},
                method:'POST',
                dataType:'JSON',
                success:function(msg){
                    
                   
                    
                     var str='';
                        var total=0;
                        if(msg.quotation_info[0].type_name=="Material" || msg.quotation_info[0].type_name=="Asset"){
                            $('#purchase_items tr').remove();
                            $('#service_items tr').remove();
                            $('#myTable').html('');
                            $('#myTable').show();
                            $('#serviceTabe').hide();
                            
                            
                             if(order_from=="Direct"){
                                str +='<thead class="thead-color"><tr>';
                                str +='<th style="text-align: center;"><input type="text" placeholder="Search by Indent No." id="row0" onkeyup="mySearch(0, 0)"><sup style="color:red">*</sup></th>';
                                str +='<th style="text-align: center;">Item Name<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;" >Unit</th>';
                                str +='<th  style="text-align: center;" >Size</th>';
                                str +='<th  style="text-align: center;" >Size Unit</th>';
                                str +='<th  style="text-align: center;" >Indent Qnty</th>';
                                str +='<th  style="text-align: center;">P. Qnty<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;">Unit Price<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;">Value<sup style="color:red">*</sup></th>';
                                str +=' <th  style="text-align: center;">Remark</th>';
                                str +='<th  style="text-align: center;">Select</th>';
                                str +='</tr></thead>';
                                
                                str +='<tbody id="purchase_items">';
                                    
                             }else if(order_from=="Budget"){
                                str +='<thead class="thead-color"><tr>';
                                str +='<th style="text-align: center;">Indent No.<sup style="color:red">*</sup></th>';
                                str +='<th style="text-align: center;">Item Name<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;" >Unit</th>';
                                str +='<th  style="text-align: center;" >Size</th>';
                                str +='<th  style="text-align: center;" >Size Unit</th>';
                                str +='<th  style="text-align: center;" >Budget Qnty</th>';
                                str +='<th  style="text-align: center;">P. Qnty<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;">Unit Price<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;">Value<sup style="color:red">*</sup></th>';
                                str +=' <th  style="text-align: center;">Remark</th>';
                                str +='<th  style="text-align: center;">Select</th>';
                                str +='</tr></thead>';
                                
                                str +='<tbody id="purchase_items">';
                                 
                             }else if(order_from=="Money Indent"){
                                str +='<thead class="thead-color"><tr>';
                                str +='<th style="text-align: center;">Indent No.<sup style="color:red">*</sup></th>';
                                str +='<th style="text-align: center;">Item Name<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;" >Unit</th>';
                                str +='<th  style="text-align: center;" >Size</th>';
                                str +='<th  style="text-align: center;" >Size Unit</th>';
                                str +='<th  style="text-align: center;" >M.I. Qnty</th>';
                                str +='<th  style="text-align: center;">P. Qnty<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;">Unit Price<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;">Value<sup style="color:red">*</sup></th>';
                                str +=' <th  style="text-align: center;">Remark</th>';
                                str +='<th  style="text-align: center;">Select</th>';
                                str +='</tr></thead>';
                                str +='<tbody id="purchase_items">';
                             }        
                            
                            
                            $(msg.item_list).each(function (i, v){       
                               // total=total+Number(v.amount);
                                
                                if(order_from=="Direct"){
                                    
                                    
                                   
                                    str+='<tr id="row_'+(i+1)+'">';
                                    str +='<td><input type="hidden" name="indent_d_id[]"  value="'+v.id+'" ><input readonly  style="width:100%;"  type="text"  name="indent_no[]" id="indent_no_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.indent_no+'"></td>';
                                   // str +='<td><input type="hidden"  name="item_id[]" id="item_id_" class="issue" value="'+v.item_id+'"><input readonly style="width:100%;"  type="text"  name="name[]" id="item_des_c1_" class="issue form-control" value="'+v.item_name+'"></td>';
                                    str +='<td>';
                                    str +='<input type="hidden"  name="item_id[]" id="item_id_" class="issue" value="'+v.item_id+'">';
                                    str +='<textarea disabled class="form-control" style="width:100%;" rows="3" name="name[]">'+v.item_name+'</textarea>';
                                    str +='</td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="m_unit[]" id="description_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.meas_unit+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="item_size[]" id="item_size_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.item_size+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="unit_name[]" id="unit_name_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.unit_name+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="indent_qnty[]" id="indent_qnty_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.indent_qty+'"></td>';
                                    str +='<td><input readonly  onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:100%;text-align:right;"  type="text"  name="quantity[]" id="quantity_'+(Number(i) + 1)+'" class="issue number form-control" value="'+v.indent_qty+'"></td>';
                                    str +='<td><input readonly  onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:100%;text-align:right;"  type="text"  name="unit_price[]" id="unit_price_'+(Number(i) + 1)+'" class="issue number form-control" value="'+''+'"></td>';
                                    str +='<td><input readonly  style="width:100%;text-align:right;"  type="text" class="form-control amount_"  name="amount[]" id="amount_'+(Number(i) + 1)+'" class="issue" value="'+''+'"></td>'; 
                                    str +='<td><textarea class="form-control" style="width:100%;" rows="3" name="remark[]">'+''+'</textarea></td>';
                                    str +='<td style="text-align: center;"><input type="checkbox" name="select_item[]" onclick="calculateSubtotal('+(Number(i)+1)+')"  id="select_item_' +(Number(i) +1)+ '" class="select_item_' +(Number(i) + 1)+'" value="'+Number(i)+'" ></td>';
                                    str+='</tr>';
                                    
                                }else if(order_from=="Budget"){
                                    
                                     var remain_qty=v.budget_qty-(Number(v.direct_p_order_qty)+Number(v.mon_indent_qnt));
                                   // var remain_qty=v.budget_qty-v.mon_indent_qnt;
                                    var remain_price=v.unit_price*remain_qty;
                                    var n_remain_price=remain_price.toFixed(2);
                                    if(remain_qty<=0){  
                                        return;
                                    }    
                                                                  
                                    str+='<tr>';
                                    str +='<td><input type="hidden" name="bu_d_id[]"  value="'+v.bu_d_id+'" ><input type="hidden" name="indent_d_id[]"  value="'+v.indent_d_id+'" ><input readonly  style="width:100%;"  type="text"  name="indent_no[]" id="indent_no_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.indent_no+'"></td>';
                                   // str +='<td><input type="hidden"  name="item_id[]" id="item_id_" class="issue" value="'+v.item_id+'"><input readonly style="width:100%;"  type="text"  name="name[]" id="item_des_c1_" class="issue form-control" value="'+v.item_name+'"></td>';
                                    str +='<td>';
                                    str +='<input type="hidden"  name="item_id[]" id="item_id_" class="issue" value="'+v.item_id+'">';
                                    str +='<textarea disabled class="form-control" style="width:100%;" rows="3" name="name[]">'+v.item_name+'</textarea>';
                                    str +='</td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="m_unit[]" id="description_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.meas_unit+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="item_size[]" id="item_size_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.item_size+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="unit_name[]" id="unit_name_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.unit_name+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="budget_qnty[]" id="budget_qnty_'+(Number(i) + 1) + '" class="issue form-control" value="'+remain_qty+'"></td>';
                                    str +='<td><input readonly onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:100%;text-align:right;"  type="text"  name="quantity[]" id="quantity_'+(Number(i) + 1)+'" class="issue number form-control" value="'+remain_qty+'"></td>';
                                    str +='<td><input readonly onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:100%;text-align:right;"  type="text"  name="unit_price[]" id="unit_price_'+(Number(i) + 1)+'" class="issue number form-control" value="'+v.unit_price+'"></td>';
                                    str +='<td><input readonly  style="width:100%;text-align:right;"  type="text" class="form-control amount_"  name="amount[]" id="amount_'+(Number(i) + 1)+'" class="issue" value="'+n_remain_price+'"></td>'; 
                                    str +='<td><textarea class="form-control" style="width:100%;" rows="3" name="remark[]">'+''+'</textarea></td>';
                                    str +='<td style="text-align: center;"><input type="checkbox" name="select_item[]" onclick="calculateSubtotal('+(Number(i)+1)+')"  id="select_item_' +(Number(i) +1)+ '" class="select_item_' +(Number(i) + 1)+'" value="'+Number(i)+'" ></td>';
                                    str+='</tr>';
                                    
                                }else if(order_from=="Money Indent"){
                                    var remain_qty=v.quantity-v.purchase_order_qty;
                                    var remain_price=v.unit_price*remain_qty;
                                    var n_remain_price=remain_price.toFixed(2);
                                    if(remain_qty<=0){  
                                        return;
                                    }    
                                    str+='<tr>';
                                    str +='<td><input type="hidden" name="mi_d_id[]"  value="'+v.mi_d_id+'" ><input type="hidden" name="indent_d_id[]"  value="'+v.indent_d_id+'" ><input readonly  style="width:100%;"  type="text"  name="indent_no[]" id="indent_no_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.indent_no+'"></td>';
                                    //str +='<td><input type="hidden"  name="item_id[]" id="item_id_" class="issue" value="'+v.item_id+'"><input readonly style="width:100%;"  type="text"  name="name[]" id="item_des_c1_" class="issue form-control" value="'+v.item_name+'"></td>';
                                    str +='<td>';
                                    str +='<input type="hidden"  name="item_id[]" id="item_id_" class="issue" value="'+v.item_id+'">';
                                    str +='<textarea disabled class="form-control" style="width:100%;" rows="3" name="name[]">'+v.item_name+'</textarea>';
                                    str +='</td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="m_unit[]" id="description_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.meas_unit+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="item_size[]" id="item_size_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.item_size+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="unit_name[]" id="unit_name_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.unit_name+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="m_indent_qnty[]" id="m_indent_qnty_'+(Number(i) + 1) + '" class="issue form-control" value="'+remain_qty+'"></td>';
                                    str +='<td><input readonly onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:100%;text-align:right;"  type="text"  name="quantity[]" id="quantity_'+(Number(i) + 1)+'" class="issue number form-control" value="'+remain_qty+'"></td>';
                                    str +='<td><input readonly onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:100%;text-align:right;"  type="text"  name="unit_price[]" id="unit_price_'+(Number(i) + 1)+'" class="issue number form-control" value="'+v.unit_price+'"></td>';
                                    str +='<td><input readonly  style="width:100%;text-align:right;"  type="text" class="form-control amount_"  name="amount[]" id="amount_'+(Number(i) + 1)+'" class="issue" value="'+n_remain_price+'"></td>'; 
                                    str +='<td><textarea class="form-control" style="width:100%;" rows="3" name="remark[]">'+''+'</textarea></td>';
                                    str +='<td style="text-align: center;"><input type="checkbox" name="select_item[]" onclick="calculateSubtotal('+(Number(i)+1)+')"  id="select_item_' +(Number(i) +1)+ '" class="select_item_' +(Number(i) + 1)+'" value="'+Number(i)+'" ></td>';
                                    str+='</tr>';
                                }    
                                
                                
                            });
                            
                            
                           
                            str +=' </tbody>';
                            str +=' <tfoot class="tfoot-color"><tr>';
                            str +='<td colspan="6" style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;">Subtotal:</td>';
                            str +='<td colspan="3"><input class="form-control" readonly style="width:140px;text-align: right;" id="sub_total"  name="total_amount" type="text"></td>';
                            str +='</tr></tfoot>'

                          //  $('#sub_total').val(total);       
                            $('#myTable').html(str);
                         }else{
                               $('#purchase_items tr').remove();
                               $('#service_items tr').remove();
                               
                                $('#myTable').hide();
                                $('#serviceTable').show();
                                $(msg.item_list).each(function (i, v) {       
                                 //   total=total+Number(v.amount);
                                    str+='<tr>';
                                    str +='<td><input type="hidden" name="indent_d_id[]"  value="'+v.id+'" ><input readonly  style="width:100%;"  type="text"  name="indent_no[]" id="indent_no_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.indent_no+'"></td>';
                                    str +='<td><input type="hidden"  name="service_id[]" id="service_id_" class="issue" value="'+v.id+'"><input readonly style="width:100%;"  type="text"  name="name[]" id="item_des_c1_" class="issue form-control" value="'+v.service_name+'"></td>';
                                    str +='<td><input required  style="width:100%;text-align:right;"  type="text" class="form-control amount_" onkeyup="calculateServiceSubtotal('+(Number(i) + 1)+')" onchange="calculateServiceSubtotal('+(Number(i) + 1)+')"  name="s_amount[]" id="s_amount_'+(Number(i) + 1)+'" class="issue" value="'+v.amount+'"></td>'; 
                                    str +='<td><textarea rows="1" class="form-control" style="width:100%;height: 34px;" name="s_remark[]">'+''+'</textarea></td>';
                                    str +='<td style="text-align: center;"><input type="checkbox" name="select_item[]" onclick="calculateSubtotal('+(Number(i)+1)+')"  id="select_item_' +(Number(i) +1)+ '" class="select_item_' +(Number(i) + 1)+'" value="'+Number(i)+'" ></td>';
                                    str+='</tr>';
                                });

                              //  $('#service_sub_total').val(total);       
                                $('#service_items').append(str);
                         }
                }    
            });
        }else{
            $('#purchase_items tr').remove();
            $('#service_items tr').remove();
            
            
        }
    });
    
    
    
    
    $('#order_for').change(function(){
        var order_for=$('#order_for').val();
        if(order_for!=''){
            $('#supplier_id').html('');
            var o_f=$('#order_for option:selected').text();
            $.ajax({
                url:'<?php echo site_url('purchase_orders/get_supplier') ?>',
                data:{'order_for':o_f},
                method:'POST',
                dataType:'json',
                success:function(msg){
                    var option='<option value="">Select Supplier Or Contractor</option>';
                    $(msg.suppliers).each(function (i, v){ 
                         option +='<option value="'+v.ID+'">'+v.SUP_NAME+'</option>';
                    });    
                    
                    $('#supplier_id').html(option);
                }    
                
            });
            
        }else{
            $('#supplier_id').html('');
        }    
    });
    
    
    $('#unit_id').change(function(){
        var unit_id=$('#unit_id').val();
        var order_for=$('#order_for').val();
        var order_from=$('#order_from').val();
        
        $('#billing_address').val('');
        $('#billing_email').val('');
        $('#shipping_address').val('');
        $('#shipping_email').val('');
        
        if(unit_id!=''){
            if(order_from==''){
                alert('Please fill the order from field');
                $('#unit_id').val('');
                $('#unit_id select.e1').select2();
                $('#order_from').focus();
                return false;
            }    
            if(order_for==''){
                 alert('Please fill the order for field');
                 $('#unit_id').val('');
                 $('#order_for').focus();
                 return false;
            }
            
             var indent_type=$('#order_for :selected').text();
            
            $.ajax({
                url:'<?php echo site_url('purchase_orders/get_purchase_items') ?>',
                data:{'unit_id':unit_id,'order_from':order_from,'order_for':order_for},
                method:'POST',
                dataType:'JSON',
                success:function(msg){
                     
                    $('#billing_address').val(msg.project_info[0].address);
                    $('#billing_email').val(msg.project_info[0].email);
                    $('#shipping_address').val(msg.project_info[0].address);
                    $('#shipping_email').val(msg.project_info[0].email);
                    
                         var str='';
                        var total=0;
                        if(msg.quotation_info[0].type_name=="Material" || msg.quotation_info[0].type_name=="Asset"){
                           // alert(order_from);
                         
                            $('#purchase_items tr').remove();
                            $('#service_items tr').remove();
                            $('#myTable').html('');
                            $('#myTable').show();
                            $('#serviceTable').hide();
                            
                            
                             if(order_from=="Direct"){
                                str +='<thead class="thead-color"><tr>';
                                str +='<th style="text-align: center;">Indent No.<sup style="color:red">*</sup></th>';
                                str +='<th style="text-align: center;">Item Name<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;" >Unit</th>';
                                str +='<th  style="text-align: center;" >Size</th>';
                                str +='<th  style="text-align: center;" >Size Unit</th>';
                                str +='<th  style="text-align: center;" >Indent Qnty</th>';
                                str +='<th  style="text-align: center;">P. Qnty<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;">Unit Price<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;">Value<sup style="color:red">*</sup></th>';
                                str +=' <th  style="text-align: center;">Remark</th>';
                                str +='<th  style="text-align: center;">Select</th>';
                                str +='</tr></thead>';
                                
                                str +='<tbody id="purchase_items">';
                                    
                             }else if(order_from=="Budget"){
                               
                                str +='<thead class="thead-color"><tr>';
                                str +='<th style="text-align: center;">Indent No.<sup style="color:red">*</sup></th>';
                                str +='<th style="text-align: center;">Item Name<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;" >Unit</th>';
                                 str +='<th  style="text-align: center;" >Size</th>';
                                 str +='<th  style="text-align: center;" >Size Unit</th>';
                                str +='<th  style="text-align: center;" >Budget Qnty</th>';
                                str +='<th  style="text-align: center;">P. Qnty<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;">Unit Price<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;">Value<sup style="color:red">*</sup></th>';
                                str +=' <th  style="text-align: center;">Remark</th>';
                                str +='<th  style="text-align: center;">Select</th>';
                                str +='</tr></thead>';
                                
                                str +='<tbody id="purchase_items">';
                                 
                             }else if(order_from=="Money Indent"){
                                str +='<thead class="thead-color"><tr>';
                                str +='<th style="text-align: center;">Indent No.<sup style="color:red">*</sup></th>';
                                str +='<th style="text-align: center;">Item Name<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;" >Unit</th>';
                                str +='<th  style="text-align: center;" >Size</th>';
                                str +='<th  style="text-align: center;" >Size Unit</th>';
                                str +='<th  style="text-align: center;" >M.I. Qnty</th>';
                                str +='<th  style="text-align: center;">P. Qnty<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;">Unit Price<sup style="color:red">*</sup></th>';
                                str +='<th  style="text-align: center;">Value<sup style="color:red">*</sup></th>';
                                str +=' <th  style="text-align: center;">Remark</th>';
                                str +='<th  style="text-align: center;">Select</th>';
                                str +='</tr></thead>';
                                str +='<tbody id="purchase_items">';
                             }        
                            
                            
                            $(msg.item_list).each(function (i, v){       
                               // total=total+Number(v.amount);
                               // alert(order_from);
                                if(order_from=="Direct"){
                                    
                                   
                                    str+='<tr>';
                                    str +='<td><input type="hidden" name="indent_d_id[]"  value="'+v.id+'" ><input readonly  style="width:100%;"  type="text"  name="indent_no[]" id="indent_no_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.indent_no+'"></td>';
                                    str +='<td>';
                                    str +='<input type="hidden"  name="item_id[]" id="item_id_" class="issue" value="'+v.item_id+'">';
                                    //str +='<input readonly style="width:100%;"  type="text"  name="name[]" id="item_des_c1_" class="issue form-control" value="'+v.item_name+'">';
                                    str +='<textarea disabled class="form-control" style="width:100%;" rows="3" name="name[]">'+v.item_name+'</textarea>';
                                    str +='</td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="m_unit[]" id="description_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.meas_unit+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="item_size[]" id="item_size_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.item_size+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="unit_name[]" id="unit_name_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.unit_name+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="indent_qnty[]" id="indent_qnty_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.indent_qty+'"></td>';
                                    str +='<td><input readonly  onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:100%;text-align:right;"  type="text"  name="quantity[]" id="quantity_'+(Number(i) + 1)+'" class="issue number form-control" value="'+v.indent_qty+'"></td>';
                                    str +='<td><input readonly  onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:100%;text-align:right;"  type="text"  name="unit_price[]" id="unit_price_'+(Number(i) + 1)+'" class="issue number form-control" value="'+''+'"></td>';
                                    str +='<td><input readonly  style="width:100%;text-align:right;"  type="text" class="form-control amount_"  name="amount[]" id="amount_'+(Number(i) + 1)+'" class="issue" value="'+''+'"></td>'; 
                                    str +='<td><textarea class="form-control" style="width:100%;" rows="3" name="remark[]">'+''+'</textarea></td>';
                                    str +='<td style="text-align: center;"><input type="checkbox" name="select_item[]" onclick="calculateSubtotal('+(Number(i)+1)+')"  id="select_item_' +(Number(i) +1)+ '" class="select_item_' +(Number(i) + 1)+'" value="'+Number(i)+'" ></td>';
                                    str+='</tr>';
                                    
                                }else if(order_from=="Budget"){
                                   
                                    
                                    var remain_qty=v.budget_qty-(Number(v.direct_p_order_qty)+Number(v.mon_indent_qnt));
                                   // var remain_qty=v.budget_qty-v.mon_indent_qnt;
                                    var remain_price=v.unit_price*remain_qty;
                                    var n_remain_price=remain_price.toFixed(2);
                                    if(remain_qty<=0){  
                                        return;
                                    }    
                                                                  
                                    str+='<tr>';
                                    str +='<td><input type="hidden" name="bu_d_id[]"  value="'+v.bu_d_id+'" ><input type="hidden" name="indent_d_id[]"  value="'+v.indent_d_id+'" ><input readonly  style="width:100%;"  type="text"  name="indent_no[]" id="indent_no_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.indent_no+'"></td>';
                                   // str +='<td><input type="hidden"  name="item_id[]" id="item_id_" class="issue" value="'+v.item_id+'"><input readonly style="width:100%;"  type="text"  name="name[]" id="item_des_c1_" class="issue form-control" value="'+v.item_name+'"></td>';
                                    str +='<td>';
                                    str +='<input type="hidden"  name="item_id[]" id="item_id_" class="issue" value="'+v.item_id+'">';
                                    str +='<textarea disabled class="form-control" style="width:100%;" rows="3" name="name[]">'+v.item_name+'</textarea>';
                                    str +='</td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="m_unit[]" id="description_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.meas_unit+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="item_size[]" id="item_size_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.item_size+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="unit_name[]" id="unit_name_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.unit_name+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="budget_qnty[]" id="budget_qnty_'+(Number(i) + 1) + '" class="issue form-control" value="'+remain_qty+'"></td>';
                                    str +='<td><input readonly onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:100%;text-align:right;"  type="text"  name="quantity[]" id="quantity_'+(Number(i) + 1)+'" class="issue number form-control" value="'+remain_qty+'"></td>';
                                    str +='<td><input readonly onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:100%;text-align:right;"  type="text"  name="unit_price[]" id="unit_price_'+(Number(i) + 1)+'" class="issue number form-control" value="'+v.unit_price+'"></td>';
                                    str +='<td><input readonly  style="width:100%;text-align:right;"  type="text" class="form-control amount_"  name="amount[]" id="amount_'+(Number(i) + 1)+'" class="issue" value="'+n_remain_price+'"></td>'; 
                                    str +='<td><textarea class="form-control" style="width:100%;" rows="3" name="remark[]">'+''+'</textarea></td>';
                                    str +='<td style="text-align: center;"><input type="checkbox" name="select_item[]" onclick="calculateSubtotal('+(Number(i)+1)+')"  id="select_item_' +(Number(i) +1)+ '" class="select_item_' +(Number(i) + 1)+'" value="'+Number(i)+'" ></td>';
                                    str+='</tr>';
                                    
                                }else if(order_from=="Money Indent"){
                                    var remain_qty=v.quantity-v.purchase_order_qty;
                                    var remain_price=v.unit_price*remain_qty;
                                    var n_remain_price=remain_price.toFixed(2);
                                    if(remain_qty<=0){  
                                        return;
                                    }    
                                    str+='<tr>';
                                    str +='<td><input type="hidden" name="mi_d_id[]"  value="'+v.mi_d_id+'" ><input type="hidden" name="indent_d_id[]"  value="'+v.indent_d_id+'" ><input readonly  style="width:100%;"  type="text"  name="indent_no[]" id="indent_no_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.indent_no+'"></td>';
                                    //str +='<td><input type="hidden"  name="item_id[]" id="item_id_" class="issue" value="'+v.item_id+'"><input readonly style="width:100%;"  type="text"  name="name[]" id="item_des_c1_" class="issue form-control" value="'+v.item_name+'"></td>';
                                    str +='<td>';
                                    str +='<input type="hidden"  name="item_id[]" id="item_id_" class="issue" value="'+v.item_id+'">';
                                    str +='<textarea disabled class="form-control" style="width:100%;" rows="3" name="name[]">'+v.item_name+'</textarea>';
                                    str +='</td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="m_unit[]" id="description_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.meas_unit+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="item_size[]" id="item_size_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.item_size+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="unit_name[]" id="unit_name_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.unit_name+'"></td>';
                                    str +='<td><input readonly style="width:100%;"  type="text"  name="m_indent_qnty[]" id="m_indent_qnty_'+(Number(i) + 1) + '" class="issue form-control" value="'+remain_qty+'"></td>';
                                    str +='<td><input readonly onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:100%;text-align:right;"  type="text"  name="quantity[]" id="quantity_'+(Number(i) + 1)+'" class="issue number form-control" value="'+remain_qty+'"></td>';
                                    str +='<td><input readonly onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:100%;text-align:right;"  type="text"  name="unit_price[]" id="unit_price_'+(Number(i) + 1)+'" class="issue number form-control" value="'+v.unit_price+'"></td>';
                                    str +='<td><input readonly  style="width:100%;text-align:right;"  type="text" class="form-control amount_"  name="amount[]" id="amount_'+(Number(i) + 1)+'" class="issue" value="'+n_remain_price+'"></td>'; 
                                    str +='<td><textarea class="form-control" style="width:100%;" rows="3" name="remark[]">'+''+'</textarea></td>';
                                    str +='<td style="text-align: center;"><input type="checkbox" name="select_item[]" onclick="calculateSubtotal('+(Number(i)+1)+')"  id="select_item_' +(Number(i) +1)+ '" class="select_item_' +(Number(i) + 1)+'" value="'+Number(i)+'" ></td>';
                                    str+='</tr>';
                                }    
                                
                                
                            });
                            
                            
                           
                            str +=' </tbody>';
                            str +=' <tfoot class="tfoot-color"><tr>';
                            str +='<td colspan="6" style="text-align:right;vertical-align: middle;font-weight: bold;font-size: 20px;">Subtotal:</td>';
                            str +='<td colspan="3"><input class="form-control" readonly style="width:140px;text-align: right;" id="sub_total"  name="total_amount" type="text"></td>';
                            str +='</tr></tfoot>'

                          //  $('#sub_total').val(total);       
                            $('#myTable').html(str);
                         }else{
                               $('#purchase_items tr').remove();
                               $('#service_items tr').remove();
                              
                               
                                $('#myTable').hide();
                                $('#serviceTable').show();
                                $(msg.item_list).each(function (i, v) {    
                                   
                                 //   total=total+Number(v.amount);
                                    str+='<tr>';
                                    str +='<td><input type="hidden" name="indent_d_id[]"  value="'+v.id+'" ><input readonly  style="width:100%;"  type="text"  name="indent_no[]" id="indent_no_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.indent_no+'"></td>';
                                    str +='<td><input type="hidden"  name="service_id[]" id="service_id_" class="issue" value="'+v.id+'"><input readonly style="width:100%;"  type="text"  name="name[]" id="item_des_c1_" class="issue form-control" value="'+v.service_name+'"></td>';
                                    str +='<td><input  readonly  style="width:100%;text-align:right;"  type="text" class="form-control amount_" onkeyup="calculateServiceSubtotal('+(Number(i) + 1)+')" onchange="calculateServiceSubtotal('+(Number(i) + 1)+')"  name="s_amount[]" id="s_amount_'+(Number(i) + 1)+'" class="issue" value=""></td>'; 
                                    str +='<td><textarea readonly id="s_remark_'+(Number(i) + 1)+'" rows="1" class="form-control" style="width:100%;height: 34px;" name="s_remark[]">'+''+'</textarea></td>';
                                    str +='<td style="text-align: center;"><input type="checkbox" name="select_item[]" onclick="calculateServiceSubtotal('+(Number(i)+1)+')"  id="select_item_' +(Number(i) +1)+ '" class="select_item_' +(Number(i) + 1)+'" value="'+Number(i)+'" ></td>';
                                    str+='</tr>';
                                });

                              //  $('#service_sub_total').val(total);       
                                $('#service_items').append(str);
                         }
                }    
            });
        }else{
            $('#purchase_items tr').remove();
            $('#service_items tr').remove();
            
            
        }
    });
    
    
    
    
    
     $('#supplier_id').change(function(){
        var supplier_id=$('#supplier_id').val();
        
         $('#attention').val('');
         $('#phone').val('');
        
        if(supplier_id!=''){
            var d = new Date();
            var n = d.getFullYear();
            var final =n.toString().substring(2);
            $.ajax({
                url:'<?php echo site_url('purchase_orders/get_order_info'); ?>',
                data:{'supplier_id':supplier_id},
                method:'POST',
                dataType:'JSON',
                success:function(msg){
                    
                    $('#attention').val(msg.supplier_info[0].NAME);
                    $('#phone').val(msg.supplier_info[0].MOBILE);
                    
                     if(msg.order_code!=""){
                            var order_no=Number(msg.order_code[0].o_code)+1;
                      }else{
                           var order_no=""; 
                      }

                    var order_sl_no;
                    if(order_no!=''){
                         if(order_no>999){
                            order_sl_no=order_no;
                        }else if(order_no>99){
                            order_sl_no='PO/'+msg.supplier_info[0].SUP_NAME+'/'+final+'/'+"0"+order_no;
                        }else if(order_no>9){
                            order_sl_no='PO/'+msg.supplier_info[0].SUP_NAME+'/'+final+'/'+"00"+order_no;
                        }else{
                            order_sl_no='PO/'+msg.supplier_info[0].SUP_NAME+'/'+final+'/'+"000"+order_no;
                        }
                    }else{
                        order_no=1;
                        order_sl_no='PO/'+msg.supplier_info[0].SUP_NAME+'/'+final+'/'+'0001';
                    }
                    $('#o_code').val(order_no);
                    $('#order_no').val(order_sl_no);
                }    
            });
        }else{
            $('#order_no').val('');
            $('#o_code').val('');
            //$('#order_no').val('');
        }    
     });
    
    
    
    
    
   
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
    
    $('#copy_hide_button').click(function (){
        $('#copy_div').hide();
        $('#copy_show_button').show();
        $('#copy_hide_button').hide();
    });
    
    $('#copy_show_button').click(function (){
        $('#copy_div').show();
        $('#copy_hide_button').show();
        $('#copy_show_button').hide();
        
    });
    
    
    
  //HIde Show End  
   
   
   
   function validation(){
        var purchase_order_date=$('#purchase_order_date').val();
        var q_id=$('#q_id').val();
      
        var supplier=$('#supplier_id').val();
        var attention=$('#attention').val();
        var phone=$('#phone').val();
        var billing_address=$('#billing_address').val();
        var billing_email=$('#billing_email').val();
        var shipping_address=$('#shipping_address').val();
        var shipping_email=$('#shipping_email').val();
        
        var error=false;
        
        if(supplier==''){
            $('#supplier_id').css('border','1px solid red');
            $('#supplier_error').html('Please select supplier');
            error=true;
            $('#supplier_id').focus();
        }else{
            $('#supplier_id').css('border','1px solid #ccc');
            $('#supplier_error').html('');
            
        }
        
        if(purchase_order_date==''){
            $('#purchase_order_date').css('border','1px solid red');
            $('#purchase_order_date_error').html('Please fill date field');
            error=true;
            $('#purchase_order_date').focus();
        }else{
            $('#purchase_order_date').css('border','1px solid #ccc');
            $('#purchase_order_date_error').html('');
            
        }
        if(q_id==''){
            $('#q_id_error').html('Please select quotation');
            $('#q_id').css('border','1px solid red');
            error=true;
            $('#q_id').focus();
        }else{
            $('#q_id_error').html('');
            $('#q_id').css('border','1px solid #ccc');   
            
        }
      
        
        
        if(attention==''){
//            $('#attention_error').html('Please fill  attention field');
//            $('#attention').css('border','1px solid red'); 
//            error=true;
//            $('#attention').focus();
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
        
       
        
        if(error==true){
            return false;
        }
    }
   
   
    $('#q_id').change(function(){
      //  alert('test');
        var q_id=$('#q_id').val();
        if(q_id!=''){
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
            
            $('#b_cash').prop('checked',false);
            $('#b_cash_tenor').val('');
            $('#b_cash_percent').val('');
            $('#b_cash_amount').val('');
            $('#b_cash_tenor').prop('readonly',true);
            $('#b_cash_percent').prop('readonly',true);
            $('#b_cash_percent').prop('required',false);
            $('#a_cash').prop('checked',false);
            $('#b_cash_tenor').val('');
            $('#a_cash_percent').val('');
            $('#a_cash_amount').val('');
            $('#a_cash_tenor').prop('readonly',true);
            $('#a_cash_percent').prop('readonly',true);
            $('#a_cash_percent').prop('required',false);
            
            $('#b_bg').prop('checked',false);
            $('#b_bg_tenor').val('');
            $('#b_bg_percent').val('');
            $('#b_bg_amount').val('');
            $('#b_bg_tenor').prop('readonly',true);
            $('#b_bg_percent').prop('readonly',true);
            $('#b_bg_tenor').prop('required',false);
            $('#b_bg_percent').prop('required',false);
            $('#a_bg').prop('checked',false);
            $('#a_bg_tenor').val('');
            $('#a_bg_percent').val('');
            $('#a_bg_amount').val('');
            $('#a_bg_tenor').prop('readonly',true);
            $('#a_bg_percent').prop('readonly',true);
            $('#a_bg_tenor').prop('required',false);
            $('#a_bg_percent').prop('required',false);
            
            $('#b_lc').prop('checked',false);
            $('#b_lc_tenor').val('');
            $('#b_lc_percent').val('');
            $('#b_lc_amount').val('');
            $('#b_lc_tenor').prop('readonly',true);
            $('#b_lc_percent').prop('readonly',true);
            $('#b_lc_tenor').prop('required',false);
            $('#b_lc_percent').prop('required',false);
            $('#a_lc').prop('checked',false);
            $('#a_lc_tenor').val('');
            $('#a_lc_percent').val('');
            $('#a_lc_amount').val('');
            $('#a_lc_tenor').prop('readonly',true);
            $('#a_lc_percent').prop('readonly',true);
            $('#a_lc_tenor').prop('required',false);
            $('#a_lc_percent').prop('required',false);
            
            $('#b_pdc').prop('checked',false);
            $('#b_pdc_check').val('');
            $('#b_pdc_percent').val('');
            $('#b_pdc_amount').val('');
            $('#b_pdc_check').prop('readonly',true);
            $('#b_pdc_percent').prop('readonly',true);
            $('#b_pdc_check').prop('required',false);
            $('#b_pdc_percent').prop('required',false);
            $('#a_pdc').prop('checked',false);
            $('#a_pdc_check').val('');
            $('#a_pdc_percent').val('');
            $('#a_pdc_amount').val('');
            $('#a_pdc_check').prop('readonly',true);
            $('#a_pdc_percent').prop('readonly',true);
            $('#a_pdc_check').prop('required',false);
            $('#a_pdc_percent').prop('required',false);
            
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
                       
                       if(msg.order_code!=""){
                            var item_id=Number(msg.order_code[0].o_code)+1;
                      }else{
                           item_id=""; 
                      }

                    var item_sl_no;
                    if(item_id!=''){
                         if(item_id>999){
                            item_sl_no=item_id;
                        }else if(item_id>99){
                            item_sl_no='PO/'+msg.supplier_info[0].SUP_NAME+'/'+final+'/'+"0"+item_id;
                        }else if(item_id>9){
                            item_sl_no='PO/'+msg.supplier_info[0].SUP_NAME+'/'+final+'/'+"00"+item_id;
                        }else{
                            item_sl_no='PO/'+msg.supplier_info[0].SUP_NAME+'/'+final+'/'+"000"+item_id;
                        }
                    }else{
                        item_id=1;
                        item_sl_no='PO/'+msg.supplier_info[0].SUP_NAME+'/'+final+'/'+'0001';
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
                        if(msg.quotation_payment_info[0].b_cash=='Cash'){
                            $('#b_cash').prop('checked',true);
                            $('#b_cash_tenor').val(msg.quotation_payment_info[0].b_cash_tenor);
                            $('#b_cash_percent').val(msg.quotation_payment_info[0].b_cash_percent);
                            $('#b_cash_amount').val(msg.quotation_payment_info[0].b_cash_amount);
                            
                            $('#b_cash_tenor').prop('readonly',false);
                            $('#b_cash_percent').prop('readonly',false);
                            $('#b_cash_percent').prop('required',true);
                        }  
                        
                        if(msg.quotation_payment_info[0].a_cash=='Cash'){
                            $('#a_cash').prop('checked',true);
                            $('#a_cash_tenor').val(msg.quotation_payment_info[0].a_cash_tenor);
                            $('#a_cash_percent').val(msg.quotation_payment_info[0].a_cash_percent);
                            $('#a_cash_amount').val(msg.quotation_payment_info[0].a_cash_amount);
                            
                            $('#a_cash_tenor').prop('readonly',false);
                            $('#a_cash_percent').prop('readonly',false);
                            $('#a_cash_percent').prop('required',true);
                        }    
                        
                        if(msg.quotation_payment_info[0].b_bg=='Bg'){
                            $('#b_bg').prop('checked',true);
                            $('#b_bg_tenor').val(msg.quotation_payment_info[0].b_bg_tenor);
                            $('#b_bg_percent').val(msg.quotation_payment_info[0].b_bg_percent);
                            $('#b_bg_amount').val(msg.quotation_payment_info[0].b_bg_amount);
                            
                            $('#b_bg_tenor').prop('readonly',false);
                            $('#b_bg_percent').prop('readonly',false);
                            $('#b_bg_tenor').prop('required',true);
                            $('#b_bg_percent').prop('required',true);
                        }  
                        
                       if(msg.quotation_payment_info[0].a_bg=='Bg'){
                            $('#a_bg').prop('checked',true);
                            $('#a_bg_tenor').val(msg.quotation_payment_info[0].a_bg_tenor);
                            $('#a_bg_percent').val(msg.quotation_payment_info[0].a_bg_percent);
                            $('#a_bg_amount').val(msg.quotation_payment_info[0].a_bg_amount);
                            
                            $('#a_bg_tenor').prop('readonly',false);
                            $('#a_bg_percent').prop('readonly',false);
                            $('#a_bg_tenor').prop('required',true);
                            $('#a_bg_percent').prop('required',true);
                        }  
                        
                        if(msg.quotation_payment_info[0].b_lc=='Lc'){
                            $('#b_lc').prop('checked',true);
                            if(msg.quotation_payment_info[0].b_lc_condition=="Realization"){
                                $("#b_lc_condition").val("Realization");
                            }else{
                                $("#b_lc_condition").val("Collection");
                            }    
                            $('#b_lc_tenor').val(msg.quotation_payment_info[0].b_lc_tenor);
                            $('#b_lc_percent').val(msg.quotation_payment_info[0].b_lc_percent);
                            $('#b_lc_amount').val(msg.quotation_payment_info[0].b_lc_amount);
                            
                            $('#b_lc_tenor').prop('readonly',false);
                            $('#b_lc_percent').prop('readonly',false);
                            $('#b_lc_tenor').prop('required',true);
                            $('#b_lc_percent').prop('required',true);
                        }  
                        
                       if(msg.quotation_payment_info[0].a_lc=='Lc'){
                            $('#a_lc').prop('checked',true);
                            $('#a_lc_tenor').val(msg.quotation_payment_info[0].a_lc_tenor);
                            $('#a_lc_percent').val(msg.quotation_payment_info[0].a_lc_percent);
                            $('#a_lc_amount').val(msg.quotation_payment_info[0].a_lc_amount);
                            
                            $('#a_lc_tenor').prop('readonly',false);
                            $('#a_lc_percent').prop('readonly',false);
                            $('#a_lc_tenor').prop('required',true);
                            $('#a_lc_percent').prop('required',true);
                        }  
                        
                         if(msg.quotation_payment_info[0].b_pdc=='Pdc'){
                            $('#b_pdc').prop('checked',true);
                            if(msg.quotation_payment_info[0].b_pdc_condition=="Realization"){
                                $("#b_pdc_condition").val("Realization");
                            }else{
                                $("#b_pdc_condition").val("Collection");
                            }    
                            $('#b_pdc_check').val(msg.quotation_payment_info[0].b_pdc_check);
                            $('#b_pdc_percent').val(msg.quotation_payment_info[0].b_pdc_percent);
                            $('#b_pdc_amount').val(msg.quotation_payment_info[0].b_pdc_amount);
                            
                            $('#b_pdc_check').prop('readonly',false);
                            $('#b_pdc_percent').prop('readonly',false);
                            $('#b_pdc_check').prop('required',true);
                            $('#b_pdc_percent').prop('required',true);
                        }  
                        
                       if(msg.quotation_payment_info[0].a_pdc=='Pdc'){
                            $('#a_pdc').prop('checked',true);
                            $('#a_pdc_check').val(msg.quotation_payment_info[0].a_pdc_check);
                            $('#a_pdc_percent').val(msg.quotation_payment_info[0].a_pdc_percent);
                            $('#a_pdc_amount').val(msg.quotation_payment_info[0].a_pdc_amount);
                            
                            $('#a_pdc_check').prop('readonly',false);
                            $('#a_pdc_percent').prop('readonly',false);
                            $('#a_pdc_check').prop('required',true);
                            $('#a_pdc_percent').prop('required',true);
                        }  
                        
                        
                        
                        var str='';
                        var total=0;
                        if(msg.quotation_info[0].type_name=="Material"){
                            $('#purchase_items tr').remove();
                            $('#service_items tr').remove();
                            
                            $('myTable').show();
                            $('#serviceTabe').hide();
                            $(msg.item_list).each(function (i, v) {       
                                total=total+Number(v.amount);
                                str+='<tr>';
                                str +='<td><input type="hidden"  name="item_id[]" id="item_id_" class="issue" value="'+v.item_id+'"><input readonly style="width:100%;"  type="text"  name="name[]" id="item_des_c1_" class="issue form-control" value="'+v.item_name+'"></td>';
                                str +='<td><input   style="width:100%;"  type="text"  name="m_unit[]" id="description_'+(Number(i) + 1) + '" class="issue form-control" value="'+v.meas_unit+'"></td>';
                                str +='<td><input required onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:100%;text-align:right;"  type="text"  name="quantity[]" id="quantity_'+(Number(i) + 1)+'" class="issue number form-control" value="'+v.quantity+'"></td>';
                                str +='<td><input required onkeyup="calculateSubtotal('+(Number(i) + 1)+')" onchange="calculateSubtotal('+(Number(i) + 1)+')" onblur="calculateSubtotal('+(Number(i) + 1)+')"  style="width:100%;text-align:right;"  type="text"  name="unit_price[]" id="unit_price_'+(Number(i) + 1)+'" class="issue number form-control" value="'+v.unit_price+'"></td>';
                                str +='<td><input readonly  style="width:100%;text-align:right;"  type="text" class="form-control amount_"  name="amount[]" id="amount_'+(Number(i) + 1)+'" class="issue" value="'+v.amount+'"></td>'; 
                                str +='<td><textarea class="form-control" style="width:100%;height:34px" name="remark[]">'+v.remark+'</textarea></td>';
                                str+='</tr>';
                            });

                            $('#sub_total').val(total);       
                            $('#purchase_items').append(str);
                         }else if(msg.quotation_info[0].type_name=="Service"){
                               $('#purchase_items tr').remove();
                               $('#service_items tr').remove();
                               
                                $('#myTable').hide();
                                $('#serviceTable').show();
                                $(msg.item_list).each(function (i, v) {       
                                    total=total+Number(v.amount);
                                    str+='<tr>';
                                    str +='<td><input type="hidden"  name="service_id[]" id="service_id_" class="issue" value="'+v.id+'"><input readonly style="width:100%;"  type="text"  name="name[]" id="item_des_c1_" class="issue form-control" value="'+v.service_name+'"></td>';
                                    str +='<td><input required  style="width:100%;text-align:right;"  type="text" class="form-control amount_" onkeyup="calculateServiceSubtotal('+(Number(i) + 1)+')" onchange="calculateServiceSubtotal('+(Number(i) + 1)+')"  name="s_amount[]" id="s_amount_'+(Number(i) + 1)+'" class="issue" value="'+v.amount+'"></td>'; 
                                    str +='<td><textarea rows="1" class="form-control" style="width:100%;height: 34px;" name="s_remark[]">'+v.remark+'</textarea></td>';
                                    str+='</tr>';
                                });

                                $('#service_sub_total').val(total);       
                                $('#service_items').append(str);
                         }
                         
                        
                    }

                })
        }else{
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
             
            $('#b_cash').prop('checked',false);
            $('#b_cash_tenor').val('');
            $('#b_cash_percent').val('');
            $('#b_cash_amount').val('');
            $('#b_cash_tenor').prop('readonly',true);
            $('#b_cash_percent').prop('readonly',true);
            $('#b_cash_percent').prop('required',false);
            $('#a_cash').prop('checked',false);
            $('#a_cash_tenor').val('');
            $('#a_cash_percent').val('');
            $('#a_cash_amount').val('');
            $('#a_cash_tenor').prop('readonly',true);
            $('#a_cash_percent').prop('readonly',true);
            $('#a_cash_percent').prop('required',false);
            
            $('#b_bg').prop('checked',false);
            $('#b_bg_tenor').val('');
            $('#b_bg_percent').val('');
            $('#b_bg_amount').val('');
            $('#b_bg_tenor').prop('readonly',true);
            $('#b_bg_percent').prop('readonly',true);
            $('#b_bg_tenor').prop('required',false);
            $('#b_bg_percent').prop('required',false);
            $('#a_bg').prop('checked',false);
            $('#a_bg_tenor').val('');
            $('#a_bg_percent').val('');
            $('#a_bg_amount').val('');
            $('#a_bg_tenor').prop('readonly',true);
            $('#a_bg_percent').prop('readonly',true);
            $('#a_bg_tenor').prop('required',false);
            $('#a_bg_percent').prop('required',false);
            
            $('#b_lc').prop('checked',false);
            $('#b_lc_tenor').val('');
            $('#b_lc_percent').val('');
            $('#b_lc_amount').val('');
            $('#b_lc_tenor').prop('readonly',true);
            $('#b_lc_percent').prop('readonly',true);
            $('#b_lc_tenor').prop('required',false);
            $('#b_lc_percent').prop('required',false);
            $('#a_lc').prop('checked',false);
            $('#a_lc_tenor').val('');
            $('#a_lc_percent').val('');
            $('#a_lc_amount').val('');
            $('#a_lc_tenor').prop('readonly',true);
            $('#a_lc_percent').prop('readonly',true);
            $('#a_lc_tenor').prop('required',false);
            $('#a_lc_percent').prop('required',false);
            
            $('#b_pdc').prop('checked',false);
            $('#b_pdc_check').val('');
            $('#b_pdc_percent').val('');
            $('#b_pdc_amount').val('');
            $('#b_pdc_check').prop('readonly',true);
            $('#b_pdc_percent').prop('readonly',true);
            $('#b_pdc_check').prop('required',false);
            $('#b_pdc_percent').prop('required',false);
            $('#a_pdc').prop('checked',false);
            $('#a_pdc_check').val('');
            $('#a_pdc_percent').val('');
            $('#a_pdc_amount').val('');
            $('#a_pdc_check').prop('readonly',true);
            $('#a_pdc_percent').prop('readonly',true);
            $('#a_pdc_check').prop('required',false);
            $('#a_pdc_percent').prop('required',false);
           
        }
    });
   
    function calculateServiceSubtotal(id){   
        //alert('test');
        $('.number').on('input', function (event) {
                var val = $(this).val();
                if(isNaN(val)) {
                    val = val.replace(/[^0-9\.]/g, '');
                    if (val.split('.').length>2)
                        val = val.replace(/\.+$/, "");
                }
                $(this).val(val);  
          });
   
         var k=0;
         var sub_total=0;
         var amount=Number($('#s_amount_'+id).val());  
         var rowCount = $('#serviceTable tr').length;
         var table_row=Number(rowCount)-2;
         
        
         if($('#select_item_'+id).prop('checked')) {
             
            $('#s_amount_'+id).prop('readonly', false);
            $('#s_amount_'+id).prop('required', true);
            
            $('#s_remark_' + id).prop('readonly', false);
       
            
        }else{
            
            $('#s_amount_'+id).val('');
            $('#s_amount_'+id).prop('readonly', true);
            $('#s_amount_'+id).prop('required', false);
            
            $('#s_remark_' + id).prop('readonly', true);
           
        }
         
         
         if(amount>0){  
         //    alert('test');
           //    $('#amount_'+id).val(amount);  
               for(var i=1;i<=table_row;i++){     
                    if($('.select_item_'+i).prop('checked')){
                        var amt=$('#s_amount_'+i).val();
                        if(amt!=''){
                            sub_total=sub_total+Number(amt)
                        } 
                    }      

               }    
                 
       }else{
          $('#s_amount_'+id).val('');     
          for(var i=1;i<=table_row;i++){ 
                   var amt=$('#s_amount_'+i).val();
                   if(amt!=''){
                        sub_total=sub_total+Number(amt);
                    }
                   
         }    
       }
       
       $('#service_sub_total').val(sub_total);
      
         
       
       
    }  
    function calculateSubtotal(id){
        //alert(id);
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
         
         $('#amount_'+id).val(amount);
         
         if($('#select_item_'+id).prop('checked')) {
             
            $('#quantity_'+id).prop('readonly', false);
            $('#quantity_'+id).prop('required', true);
            
            $('#unit_price_' + id).prop('readonly', false);
            $('#unit_price_' + id).prop('required', true);
            
        }else{
           
            $('#quantity_' + id).prop('readonly', true);
            $('#quantity_' + id).prop('required', false);
            
            $('#unit_price_' + id).prop('readonly', true);
            $('#unit_price_' + id).prop('required', false);
        }
         
         var rowCount = $('#myTable tr').length;
         var table_row=Number(rowCount)-2;
         for(var i=1;i<=table_row;i++){
             if($('.select_item_'+i).prop('checked')){
                var amt=$('#amount_'+i).val();
                sub_total=sub_total+Number(amt);
            }
             
         }    
         $('#sub_total').val(sub_total);
         
      
        
    }
    
   
    
    
    $('#m_specification').click(function () {
        var count = $('#material_count').val();
        var str= '<tr  id="row_' + (Number(count) + 1) + '">';
        
        str +='<td><input required  style="width:250px"  type="text"  name="t_or_c_name[]"  class="issue form-control"></td>';
        str +='<td><input required  style="width:350px"  type="text"  name="t_or_c_description[]"  class="issue form-control"></td>';
        str +='<td><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeTerms(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>'; 
        str +='</tr>';      
        $('#material_count').val(Number(count) + 1);
        $('#specificationTable').append(str);
        
    });
    
     function removeTerms(row) {
        var count = $('#material_count').val();
        $('#material_count').val(Number(count)-1);
        $('#row_' + row).remove();
       
    }
    
    $('#copy_to').click(function () {
        var count = $('#copy_count').val();
        var str= '<tr  id="row_' + (Number(count) + 1) + '">';
        
       
        str +='<td><input required  style="width:350px"  type="text"  name="copy_description[]"  class="issue form-control"></td>';
        str +='<td><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="c_button" onclick="removeCopy(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>'; 
        str +='</tr>';      
        $('#copy_count').val(Number(count) + 1);
        $('#copyTable').append(str);
        
    });
    
     function removeCopy(row) {
        var count = $('#copy_count').val();
        $('#copy_count').val(Number(count)-1);
        $('#row_' + row).remove();
       
    }
    
//    $(document).ready(function () {
//        $('select.e1').select2();
//        $('.select2-input').focus();
//    });
   
</script>

<script>
    var viewModel = {};
    viewModel.fileData = ko.observable({
        dataURL: ko.observable(),
        // can add "fileTypes" observable here, and it will override the "accept" attribute on the file input
        // fileTypes: ko.observable('.xlsx,image/png,audio/*')
    });
    viewModel.multiFileData = ko.observable({dataURLArray: ko.observableArray()});
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
    viewModel.onInvalidFileDrop = function (failedFiles) {
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