<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Invoice</h2>
    <hr>
    <form action="<?php echo site_url('sale_invoices/edit_sale_invoice_action/'.$sale_invoice_info[0]['inv_id']); ?>" method="post">
        <div class="row">
            <div class="col-md-6">
                    <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Delivery Orders<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <select id="do_id" class="form-control" name="do_id">
                            <option class="form-control" value="">Select Order</option>
                            <?php foreach($orders as $order){ ?>
                                <option <?php if($order['do_id']==$sale_invoice_info[0]['do_id']) echo "selected"; ?> class="form-control" value="<?php echo $order['do_id'] ?>"><?php echo $order['c_short_name'].'('.$order['delivery_no'].')' ?></option>
                            <?php } ?>
                       </select>
                    </div>
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Invoice Number<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                         
                         <input readonly required class="form-control" id="inv_no" name="inv_no" type="text" value="<?php if(!empty($sale_invoice_info[0]['inv_no'])) echo $sale_invoice_info[0]['inv_no']; ?>">
                    </div>
                </div>
            </div>
            
        </div>
          
         <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Date:</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control datepicker" name="sale_invoice_date" type="text" value="<?php if(!empty($sale_invoice_info[0]['sale_invoice_date'])) echo date('d-m-Y',strtotime($sale_invoice_info[0]['sale_invoice_date'])); ?>"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Attention :</label></div>
                    <div class="col-sm-8 col-md-5 "><input id="attention" class="form-control" name="attention" type="text" value="<?php if(!empty($sale_invoice_info[0]['attention'])) echo $sale_invoice_info[0]['attention']; ?>"></div>
                </div>
            </div>
            
        </div>
        
         <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Project Name<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required id="project_name" class="form-control" name="project_name" type="text" value="<?php if(!empty($sale_invoice_info[0]['project_name'])) echo $sale_invoice_info[0]['project_name']; ?>"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Phone<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" id="phone" name="phone" type="text" value="<?php if(!empty($sale_invoice_info[0]['phone'])) echo $sale_invoice_info[0]['phone']; ?>"></div>
                </div>
            </div>
            
        </div>
        
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Billing Address :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required id="billing_address" class="form-control" name="billing_address" type="text" value="<?php if(!empty($sale_invoice_info[0]['billing_address'])) echo $sale_invoice_info[0]['billing_address']; ?>"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Billing Email :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" id="billing_email" name="billing_email" type="text" value="<?php if(!empty($sale_invoice_info[0]['billing_email'])) echo $sale_invoice_info[0]['billing_email']; ?>"></div>
                </div>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">D. Address :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" id="shipping_address" name="shipping_address" type="text" value="<?php if(!empty($sale_invoice_info[0]['shipping_address'])) echo $sale_invoice_info[0]['shipping_address']; ?>"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Shipping Email :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" id="shipping_email" name="shipping_email" type="text" value="<?php if(!empty($sale_invoice_info[0]['shipping_email'])) echo $sale_invoice_info[0]['shipping_email']; ?>"></div>
                </div>
            </div>
            
        </div>
        
      
        
        
      
       
        <hr>
        <div class="row">
           
                <table class="table table-bordered" >
                    <thead>
                     <tr>
                         <th>Challan No.</th>
                         <th>Product Name <sup style='color:red'>*</sup></th>
                         <th>Unit Price</th>
                         <th>Quantity</th>              
                         <th>Amount</th>


                      </tr>
                    </thead>
                    <tbody id="sale_items">
                          <?php $i=0; foreach($sale_invoice_details_info as $sale_invoice_details){ 
                            $i++;
                            ?>
                         <tr class="" id="row_<?php echo $i; ?>">
                             <td><input type="hidden"  name="dc_id[]" id="dc_id_" class="issue" value="<?php echo $sale_invoice_details['dc_id'] ?>"><input readonly  style="width:140px;"  type="text"  name="dc_no[]" id="dc_no" class="issue" value="<?php echo $sale_invoice_details['dc_no'] ?>"></td>
                             <td><input  type="hidden"  name="s_item_id[]" id="item_des_c1_" class="issue" value="<?php echo $sale_invoice_details['s_item_id'] ?>"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="<?php echo $sale_invoice_details['product_name'] ?>"></td>
                             <td><input readonly  style="width:140px;"  type="text"  name="unit_price[]" id="unit_price_<?php echo $i; ?>" class="issue" value="<?php echo $sale_invoice_details['unit_price'] ?>"></td>
                             <td><input   style="width:140px;"  type="text"  name="quantity[]" id="quantity_<?php echo $i; ?>" class="issue" value="<?php echo $sale_invoice_details['quantity'] ?>"></td>
                             <td><input readonly  style="width:140px;"  type="text" class="amount_<?php echo $i; ?>"  name="amount[]" id="amount_<?php echo $i; ?>" class="issue" value="<?php echo $sale_invoice_details['amount'] ?>"></td>

                          </tr>
                        <?php } ?>
                      
                      </tbody>
                       <tfoot>
                            <tr>
                                <td colspan="3" style="text-align:right;">Subtotal:</td>

                                <td><input readonly style="width:140px;" id="sub_total"  name="total_amount" type="text" value="<?php if(!empty($sale_invoice_info[0]['total_amount'])) echo $sale_invoice_info[0]['total_amount']; ?>"></td>
                            </tr>
                        </tfoot>
                  </table>
           
            
            
            
        </div>
        
       
        
        <div class="row">
           
            <div class="col-md-2 col-md-offset-3">
                <button type="submit" class="btn btn-primary button">UPDATE</button>
            </div>
             <div class="col-md-2">
                <a href="<?php echo site_url('backend/sale_invoices') ?>" > <button type="button" class="btn btn-success button">REGISTER</button> </a>

            </div>
        </div> 
            
        </div>
    </form>
</div>

<script type="text/javascript">
    
    
    
    
   $('#do_id').change(function(){
        var do_id=$('#do_id').val();
        if(do_id!=''){
            $('#sale_items tr').remove();
            $('#sub_total').val('');  
            $('#attention').val('');
            $('#phone').val('');
            $('#project_name').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            
            var data = {'do_id': do_id}
            $.ajax({
                    url: '<?php echo site_url('sale_invoices/get_order_item'); ?>',
                    data: data,
                    method: 'POST',
                    dataType: 'json',
                    success: function (msg) { 
                       
                        $('#attention').val(msg.order_info[0].attention);
                        $('#billing_address').val(msg.order_info[0].billing_address);
                        $('#billing_email').val(msg.order_info[0].billing_email);
                        $('#shipping_address').val(msg.order_info[0].shipping_address);
                        $('#shipping_email').val(msg.order_info[0].shipping_email);
                       
                        var str='';
                        var total=0;
                         $(msg.item_list).each(function (i, v) {
                           
                             total=total+Number(v.amount);
                             str+='<tr>';
                             str +='<td><input type="hidden"  name="dc_id[]" id="dc_id_" class="issue" value="'+v.dc_id+'"><input readonly  style="width:140px;"  type="text"  name="dc_no[]" id="dc_no" class="issue" value="'+v.dc_no+'"></td>';
                             str +='<td><input type="hidden"  name="s_item_id[]" id="item_des_c1_" class="issue" value="'+v.s_item_id+'"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="'+v.product_name+'"></td>';
                             str +='<td><input readonly  style="width:140px;"  type="text"  name="measurement_unit[]" id="dc_no" class="issue" value="'+v.measurement_unit+'"></td>';
                             str +='<td><input readonly onkeyup="" onchange="" onblur=""  style="width:140px;"  type="text"  name="quantity[]" id="quantity_'+(Number(i) + 1)+'" class="issue" value="'+v.quantity+'"></td>';
                             str +='<td><input readonly  style="width:140px;"  type="text"  name="unit_price[]" id="unit_price_'+(Number(i) + 1)+'" class="issue" value="'+v.unit_price+'"></td>';  
                             str +='<td><input readonly  style="width:140px;"  type="text" class="amount_"  name="amount[]" id="amount_'+(Number(i)+1)+'" class="issue" value="'+v.amount+'"></td>';
                             str +='<td><input  onclick="calculateSubtotal('+(Number(i) + 1)+')" style="width:40px;"  type="checkbox"  name="select_product[]" id="select_product_'+(Number(i) + 1)+ '" class="select_product_'+(Number(i) + 1)+ '" value="'+i+'"></td>';
                             str+='</tr>';
                         });

                         //$('#sub_total').val(total);       
                         $('#sale_items').append(str);
                    

                    }

                })
        }else{
            $('#sale_items tr').remove();
            $('#sub_total').val('');  
            $('#attention').val('');
            $('#phone').val('');
            $('#project_name').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
           
        }
    });
    
    
    
function calculateSubtotal(id){
         var sub_total=0;   
         var rowCount = $('#myTable tr').length;
         var table_row=Number(rowCount)-2;
         for(var i=1;i<=table_row;i++){
             if($('.select_product_'+i).prop('checked')){
                var amt=$('#amount_'+i).val();
                sub_total=sub_total+Number(amt);
            }
             
         }    
         $('#sub_total').val(sub_total);
    }
    
    
   
</script>


