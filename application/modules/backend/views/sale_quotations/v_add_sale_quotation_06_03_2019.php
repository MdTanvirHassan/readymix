<style type="text/css">
    .form-control{
        height:30px;
    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Quotation</h2>
    <hr>
    <form action="<?php echo site_url('sale_quotations/add_quotation_action'); ?>" method="post">
        <div class="row">
          
             <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Q. No.<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                         
                         <input class="form-control" id="q_code" name="q_code" type="hidden" value="">
                         <input readonly  class="form-control" id="reference_no" name="reference_no" type="text" value="">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Date:</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control datepicker" name="quotation_date" type="text" value="<?php echo date('d-m-Y') ?>"></div>
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
                                <option class="form-control" value="<?php echo $category['category_id'] ?>"><?php echo $category['short_name']; ?></option>
                            <?php } ?>
                       </select>
                    </div>
                </div>
            </div>
              <div class="col-md-6">
                    <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Customer<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <select id="customer_id" class="form-control e1" name="customer_id">
                            <option class="form-control" value="">Select Customer</option>
                            <?php foreach($customers as $customer){ ?>
                                <option class="form-control" value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option>
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
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" id="billing_address" name="billing_address" type="text"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Billing Email :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" id="billing_email" name="billing_email" type="text"></div>
                </div>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Delivery Address :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" id="shipping_address" name="shipping_address" type="text"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Delivery Email :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" id="shipping_email" name="shipping_email" type="text"></div>
                </div>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Project Name :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" id="project_name" name="project_name" type="text"></div>
                </div>
            </div>
            <div class="col-md-6">
                    <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Employee<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <select id="employee_id" class="form-control e1" name="employee_id">
                            <option class="form-control" value="">Select Employee</option>
                            <?php foreach($employees as $employee){ ?>
                                <option class="form-control" value="<?php echo $employee['id'] ?>"><?php echo $employee['name'].'('.$employee['designation_short_name'].')' ?></option>
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
                    <div class="col-sm-8 col-md-5 "><input class="form-control" id="attention" name="attention" type="text"></div>
                </div>
            </div>
            
        </div>
        
        
        
        
        <hr>
        
     
        <div class="row">
            <input type="hidden" value="1" id="count" />
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
                        <tr>
                            <td></td>
                            <td>
                                <select style="width:200px;" id="product_1" class="form-control e1" name="product_id[]" onchange="javascript:item_info(1);">
                                    
                                    <option class="form-control" value="">Select Product</option>
                                    <?php foreach($products as $product){ ?>
                                        <option  class="form-control" value="<?php echo $product['product_id']; ?>"><?php echo $product['product_name']; ?></option>
                                    <?php } ?>
                               </select>
                            </td> 
                            
                             <td>
                                <input  style="width:140px;"  type="text"  name="description[]" id="description_1" class="issue" value="">
                            </td>
                            
                             <td>
                                <input onkeyup="calculateSubtotal('1')" onchange="calculateSubtotal('1')" onblur="calculateSubtotal('1')"  style="width:140px;"  type="text"  name="quantity[]" id="quantity_1" class="issue" value="">
                            </td>
                            <td>
                                <input onkeyup="calculateSubtotal('1')" onchange="calculateSubtotal('1')" onblur="calculateSubtotal('1')"  style="width:140px;"  type="text"  name="unit_price[]" id="unit_price_1" class="issue" value="">
                            </td>
                           
                            <td>
                                <input  style="width:140px;"  type="text"  name="amount[]" id="amount_1" class="issue" value="">
                            </td>
                             <td>
                                <input  style="width:140px;"  type="text"  name="remark[]" id="remark_1" class="issue" value="">
                            </td>
                        </tr>
                      
                    </tbody>
                       <tfoot>
                            <tr>
                                <td colspan="5" style="text-align:right;">Subtotal:</td>

                                <td><input readonly style="width:140px;" id="sub_total"  name="total_amount" type="text"></td>
                            </tr>
                        </tfoot>
                  </table>
           
            
            
            
        </div>
        
        <hr>
        <h2 style="text-align:center; ">Payment Conditions</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   " style="text-align:center;margin-left:-15px"><b>Before Delivery</b></div>
                    <div class="col-sm-8 col-md-5 ">
                       
                    </div>
                </div>
                 <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="">
                        <label for="inputdefault"><input  type="checkbox" name="b_cash" value="Cash">Cash</label>
                    </div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" onkeyup="calculatePercentAmount('b_cash_percent')" onchange="calculatePercentAmount('b_cash_percent')" onblur="calculatePercentAmount('b_cash_percent')" id="b_cash_percent" name="b_cash_percent" type="text" placeholder="Percent">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input readonly class="form-control" id="b_cash_amount" name="b_cash_amount" type="text" placeholder="Amount">
                    </div>
                </div>
                 <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style=""><label for="inputdefault"><input type="checkbox" name="b_bg" value="Bg">BG</label></div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" id="b_bg_tenor" name="b_bg_tenor" type="text" placeholder="T. Day">
                    </div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" onkeyup="calculatePercentAmount('b_bg_percent')" onchange="calculatePercentAmount('b_bg_percent')" onblur="calculatePercentAmount('b_bg_percent')" id="b_bg_percent" name="b_bg_percent" type="text" placeholder="Percent">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input readonly class="form-control" id="b_bg_amount" name="b_bg_amount" type="text" placeholder="Amount">
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style=""><label for="inputdefault"><input name="b_lc" type="checkbox" value="Lc">LC</label></div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" id="b_lc_tenor" name="b_lc_tenor" type="text" placeholder="T.Day">
                    </div>
                     <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" onkeyup="calculatePercentAmount('b_lc_percent')" onchange="calculatePercentAmount('b_lc_percent')" onblur="calculatePercentAmount('b_lc_percent')" id="b_lc_percent" name="b_lc_percent" type="text" placeholder="Percent">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input readonly class="form-control" id="b_lc_amount" name="b_lc_amount" type="text" placeholder="Amount">
                    </div>
                </div>
                
                 <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style=""><label for="inputdefault"><input type="checkbox" name="b_pdc" value="Pdc">PDC</label></div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control"  id="b_pdc_check" name="b_pdc_check" type="text" placeholder="T.Ch.">
                    </div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" onkeyup="calculatePercentAmount('b_pdc_percent')" onchange="calculatePercentAmount('b_pdc_percent')" onblur="calculatePercentAmount('b_pdc_percent')" id="b_pdc_percent" name="b_pdc_percent" type="text" placeholder="Percent">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input readonly class="form-control" id="b_pdc_amount" name="b_pdc_amount" type="text" placeholder="Amount">
                    </div>
                </div>
                
            </div><!--End Col-md-6-->
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   " style="text-align:center;margin-left:-15px"><b>After Delivery</b></div>
                    <div class="col-sm-8 col-md-5 " style="text-align: right">
                        <input type="hidden" id="remaining_balance" value="" />
                        <b >Balance:<span id="balance"></span></b>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style=""><label for="inputdefault"><input type="checkbox" name="a_cash" value="Cash">Cash</label></div>
                    <div class="col-sm-4 col-md-2 ">
                        <input class="form-control" onkeyup="calculatePercentAmount('a_cash_percent')" onchange="calculatePercentAmount('a_cash_percent')" onblur="calculatePercentAmount('a_cash_percent')" id="a_cash_percent" name="a_cash_percent" type="text" placeholder="Percent">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input readonly class="form-control"  id="a_cash_amount" name="a_cash_amount" type="text" placeholder="Amount">
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style=""><label for="inputdefault"><input type="checkbox" name="a_bg" value="Bg">BG</label></div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" id="a_bg_tenor" name="a_bg_tenor" type="text" placeholder="T.Day">
                    </div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" onkeyup="calculatePercentAmount('a_bg_percent')" onchange="calculatePercentAmount('a_bg_percent')" onblur="calculatePercentAmount('a_bg_percent')" id="a_bg_percent" name="a_bg_percent" type="text" placeholder="Percent">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input readonly class="form-control" id="a_bg_amount" name="a_bg_amount" type="text" placeholder="Amount">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 labeltext" style=""><label for="inputdefault"><input type="checkbox" name="a_lc" value="Lc">LC</label></div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" id="a_lc_tenor" name="a_lc_tenor" type="text" placeholder="T.Day">
                    </div>
                     <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" onkeyup="calculatePercentAmount('a_lc_percent')" onchange="calculatePercentAmount('a_lc_percent')" onblur="calculatePercentAmount('a_lc_percent')" id="a_lc_percent" name="a_lc_percent" type="text" placeholder="Percent">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input readonly class="form-control"  id="a_lc_amount" name="a_lc_amount" type="text" placeholder="Amount">
                    </div>
                </div>
                
                
                 <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style=""><label for="inputdefault"><input type="checkbox" name="a_pdc" value="Pdc">PDC</label></div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control"  id="a_pdc_check" name="a_pdc_check" type="text" placeholder="T.Ch.">
                    </div>
                    <div class="col-sm-4 col-md-2 ">
                       <input class="form-control" onkeyup="calculatePercentAmount('a_pdc_percent')" onchange="calculatePercentAmount('a_pdc_percent')" onblur="calculatePercentAmount('a_pdc_percent')" id="a_pdc_percent" name="a_pdc_percent" type="text" placeholder="Percent">
                    </div>
                     <div class="col-sm-4 col-md-3 ">
                       <input readonly class="form-control" id="a_pdc_amount" name="a_pdc_amount" type="text" placeholder="Amount">
                    </div>
                </div>
                
            </div><!--End Col-md-6-->
            
        </div>
        
        <hr>
       <h2 style="text-align:center; ">Specification of Raw Materials</h2>
         <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Material Name :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" id="" name="material_name[]" type="text" value="Cement (PCC)"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Description :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" id="" name="m_description[]" type="text"></div>
                </div>
            </div>
            
        </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Material Name :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" id="" name="material_name[]" type="text" value="Coarse Aggregate"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Description :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" id="" name="m_description[]" type="text"></div>
                </div>
            </div>
            
        </div>
       <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Material Name :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" id="" name="material_name[]" type="text" value="Fine Aggregate"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Description :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" id="" name="m_description[]" type="text"></div>
                </div>
            </div>
            
        </div>
       <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Material Name :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" id="" name="material_name[]" type="text" value="Admixture"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Description :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" id="" name="m_description[]" type="text"></div>
                </div>
            </div>
            
        </div>
        
        <div class="row">
           
            <div class="col-md-2 col-md-offset-3">
                <button type="submit" class="btn btn-primary button">SAVE</button>
            </div>
             <div class="col-md-2">
                <a href="<?php echo site_url('backend/sale_quotations') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

            </div>
        </div> 
            
        </div>
    </form>
</div>

<script type="text/javascript">
    
    $('#category_id').change(function(){
        var category_id = $('#category_id').val();
      
        var id = $('#customer_id').val();
        if(id!='' && category_id!=''){
            
            $('#billing_address').val('');
            $('#shipping_address').val('');
            $('#billing_email').val('');
            $('#shipping_email').val('');
            $('#attention').val('');
            $('#q_code').val('');
            $('#reference_no').val('');
            
            var d = new Date();
            var n = d.getFullYear();
            var final = n.toString().substring(2);
            
            var data = {'id': id,'category_id':category_id}
            $.ajax({
                url: '<?php echo site_url('sale_quotations/customer_info'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {  
                    $('#attention').val(msg.customer_info[0].c_contact_person);
                    $('#billing_address').val(msg.customer_info[0].c_contact_address);
                    $('#shipping_address').val(msg.customer_info[0].c_contact_address);
                    $('#billing_email').val(msg.customer_info[0].c_email);
                    $('#shipping_email').val(msg.customer_info[0].c_email);
                    
                     if(msg.quotaion!=""){
                            var item_id=Number(msg.quotaion[0].q_code)+1;
                      }else{
                           item_id=""; 
                      }

                    var item_sl_no;
                    if(item_id!=''){
                         if(item_id>999){
                            item_sl_no=item_id;
                        }else if(item_id>99){
                            item_sl_no=msg.category[0].short_name+'/'+msg.customer_info[0].c_short_name+'/'+final+'/'+"0"+item_id;
                        }else if(item_id>9){
                            item_sl_no=msg.category[0].short_name+'/'+msg.customer_info[0].c_short_name+'/'+final+'/'+"00"+item_id;
                        }else{
                            item_sl_no=msg.category[0].short_name+'/'+msg.customer_info[0].c_short_name+'/'+final+'/'+"000"+item_id;
                        }
                    }else{
                        item_id=1;
                        item_sl_no=msg.category[0].short_name+'/'+msg.customer_info[0].c_short_name+'/'+final+'/'+'0001';
                    }

                    $('#q_code').val(item_id);
                    $('#reference_no').val(item_sl_no);
                    
                }

                      
            })
        }else{
           
        }
    });
    
    
    $('#customer_id').change(function(){
        var category_id = $('#category_id').val();
        if(category_id==''){
            
            alert('Please select product type');
            return false;
           
        }
        var id = $('#customer_id').val();
        if(id!=''){
            
            $('#billing_address').val('');
            $('#shipping_address').val('');
            $('#billing_email').val('');
            $('#shipping_email').val('');
            $('#attention').val('');
            $('#q_code').val('');
            $('#reference_no').val('');
            
            var d = new Date();
            var n = d.getFullYear();
            var final = n.toString().substring(2);
            
            var data = {'id': id,'category_id':category_id}
            $.ajax({
                url: '<?php echo site_url('sale_quotations/customer_info'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {  
                    $('#attention').val(msg.customer_info[0].c_contact_person);
                    $('#billing_address').val(msg.customer_info[0].c_contact_address);
                    $('#shipping_address').val(msg.customer_info[0].c_contact_address);
                    $('#billing_email').val(msg.customer_info[0].c_email);
                    $('#shipping_email').val(msg.customer_info[0].c_email);
                    
                     if(msg.quotaion!=""){
                            var item_id=Number(msg.quotaion[0].q_code)+1;
                      }else{
                           item_id=""; 
                      }

                    var item_sl_no;
                    if(item_id!=''){
                         if(item_id>999){
                            item_sl_no=item_id;
                        }else if(item_id>99){
                            item_sl_no=msg.category[0].short_name+'/'+msg.customer_info[0].c_short_name+'/'+final+'/'+"0"+item_id;
                        }else if(item_id>9){
                            item_sl_no=msg.category[0].short_name+'/'+msg.customer_info[0].c_short_name+'/'+final+'/'+"00"+item_id;
                        }else{
                            item_sl_no=msg.category[0].short_name+'/'+msg.customer_info[0].c_short_name+'/'+final+'/'+"000"+item_id;
                        }
                    }else{
                        item_id=1;
                        item_sl_no=msg.category[0].short_name+'/'+msg.customer_info[0].c_short_name+'/'+final+'/'+'0001';
                    }

                    $('#q_code').val(item_id);
                    $('#reference_no').val(item_sl_no);
                    
                }

                      
            })
        }else{
            $('#billing_address').val('');
            $('#shipping_address').val('');
            $('#billing_email').val('');
            $('#shipping_email').val('');
            $('#attention').val('');
            $('#q_code').val('');
            $('#reference_no').val('');
        }
    });
    
    
    $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr=$('#product_1').html();
        
        var str= '<tr  id="row_' + (Number(count) + 1) + '">';
        str +='<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>'; 
        str +='<td><select required class="e1" style="width:200px;"  onchange="item_info(' + (Number(count) + 1) + ')" name="product_id[]" id="product_'+(Number(count) + 1) + '" class="">'+itemstr+'</select></td>';
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
        $('#remaining_balance').val(sub_total);
        $('#balance').html(sub_total);
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
                $('#remaining_balance').val(sub_total);
                $('#balance').html(sub_total);
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
         $('#remaining_balance').val(sub_total);
         $('#balance').html(sub_total);
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
