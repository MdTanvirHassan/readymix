<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Delivery Order</h2>
    <hr>
    <form action="<?php echo site_url('delivery_orders/edit_delivery_order_action/'.$delivery_order_info[0]['do_id']); ?>" method="post">
        <div class="row">
            <div class="col-md-6">
                    <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Sales Order<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <select id="o_id" class="form-control" name="o_id">
                            <option class="form-control" value="">Select Order</option>
                            <?php foreach($delivery_orders as $order){ ?>
                                <option <?php if($order['o_id']==$delivery_order_info[0]['o_id']) echo "selected"; ?> class="form-control" value="<?php echo $order['o_id'] ?>"><?php echo $order['c_name'].'('.$order['order_no'].')' ?></option>
                            <?php } ?>
                       </select>
                    </div>
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Do. No.<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                       
                         <input required class="form-control" name="delivery_no" type="text" value="<?php if(!empty($delivery_order_info[0]['delivery_no'])) echo $delivery_order_info[0]['delivery_no']; ?>">
                    </div>
                </div>
            </div>
            
        </div>
          
         <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Date:</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control datepicker" name="delivery_order_date" type="text" value="<?php if(!empty($delivery_order_info[0]['delivery_order_date'])) echo date('d-m-Y',strtotime($delivery_order_info[0]['delivery_order_date'])); ?>"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Attention :</label></div>
                    <div class="col-sm-8 col-md-5 "><input id="attention" class="form-control" name="attention" type="text" value="<?php if(!empty($delivery_order_info[0]['attention'])) echo $delivery_order_info[0]['attention']; ?>"></div>
                </div>
            </div>
            
        </div>
        
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Billing Address :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required id="billing_address" class="form-control" name="billing_address" type="text" value="<?php if(!empty($delivery_order_info[0]['billing_address'])) echo $delivery_order_info[0]['billing_address']; ?>"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Billing Email :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" id="billing_email" name="billing_email" type="text" value="<?php if(!empty($delivery_order_info[0]['billing_email'])) echo $delivery_order_info[0]['billing_email']; ?>"></div>
                </div>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Delivery Address :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" id="shipping_address" name="shipping_address" type="text" value="<?php if(!empty($delivery_order_info[0]['shipping_address'])) echo $delivery_order_info[0]['shipping_address']; ?>"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Delivery Email :</label></div>
                    <div class="col-sm-8 col-md-5 "><input class="form-control" id="shipping_email" name="shipping_email" type="text" value="<?php if(!empty($delivery_order_info[0]['shipping_email'])) echo $delivery_order_info[0]['shipping_email']; ?>"></div>
                </div>
            </div>
            
        </div>
        
       
        
        
      
       
        <hr>
        <div class="row">
           
                <table class="table table-bordered" >
                    <thead>
                     <tr>
                         <th>Product Name <sup style='color:red'>*</sup></th>
                         <th>Unit Price</th>
                         <th>Quantity</th>              
                         <th>Amount</th>


                      </tr>
                    </thead>
                    <tbody id="delivery_items">
                          <?php $i=0; foreach($delivery_order_details_info as $delivery_order_details){ 
                            $i++;
                            ?>
                         <tr class="" id="row_<?php echo $quotation_details['s_item_id'] ?>">
                             <td><input  type="hidden"  name="s_item_id[]" id="item_des_c1_" class="issue" value="<?php echo $delivery_order_details['s_item_id'] ?>"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="<?php echo $delivery_order_details['product_name'] ?>"></td>
                             <td><input readonly  style="width:140px;"  type="text"  name="unit_price[]" id="item_unit_price_<?php echo $delivery_order_details['s_item_id'] ?>" class="issue" value="<?php echo $delivery_order_details['unit_price'] ?>"></td>
                             <td><input   style="width:140px;"  type="text"  name="quantity[]" id="item_quantity_<?php echo $delivery_order_details['s_item_id'] ?>" class="issue" value="<?php echo $delivery_order_details['quantity'] ?>"></td>
                            <td><input readonly  style="width:140px;"  type="text" class="amount_<?php echo $i; ?>"  name="amount[]" id="item_amount_<?php echo $delivery_order_details['s_item_id'] ?>" class="issue" value="<?php echo $delivery_order_details['amount'] ?>"></td>

                          </tr>
                        <?php } ?>
                      
                      </tbody>
                       <tfoot>
                            <tr>
                                <td colspan="3" style="text-align:right;">Subtotal:</td>

                                <td><input readonly style="width:140px;" id="sub_total"  name="total_amount" type="text" value="<?php if(!empty($delivery_order_info[0]['total_amount'])) echo $delivery_order_info[0]['total_amount']; ?>"></td>
                            </tr>
                        </tfoot>
                  </table>
           
            
            
            
        </div>
        
       
        
        <div class="row">
           
            <div class="col-md-2 col-md-offset-3">
                <button type="submit" class="btn btn-primary button">SAVE</button>
            </div>
             <div class="col-md-2">
                <a href="<?php echo site_url('backend/delivery_orders') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

            </div>
        </div> 
            
        </div>
    </form>
</div>

<script type="text/javascript">
    
    
    
    
    $('#o_id').change(function(){
        var o_id=$('#o_id').val();
        if(o_id!=''){
            $('#delivery_items tr').remove();
            $('#sub_total').val('');  
            $('#attention').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            $('#advance').val('');
            $('#due').val('');
            
            var data = {'o_id': o_id}
            $.ajax({
                    url: '<?php echo site_url('delivery_orders/get_sales_order_item'); ?>',
                    data: data,
                    method: 'POST',
                    dataType: 'json',
                    success: function (msg) { 
                       
                        $('#attention').val(msg.sales_order_info[0].attention);
                        $('#billing_address').val(msg.sales_order_info[0].billing_address);
                        $('#billing_email').val(msg.sales_order_info[0].billing_email);
                        $('#shipping_address').val(msg.sales_order_info[0].shipping_address);
                        $('#shipping_email').val(msg.sales_order_info[0].shipping_email);
                        
                        
                      
                        var str='';
                        var total=0;
                         $(msg.item_list).each(function (i, v) {
                           
                             total=total+Number(v.amount);
                             str+='<tr>';
                             str +='<td><input type="hidden"  name="s_item_id[]" id="item_des_c1_" class="issue" value="'+v.s_item_id+'"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="'+v.product_name+'"></td>';
                             str +='<td><input readonly  style="width:140px;"  type="text"  name="unit_price[]" id="item_unit_price_" class="issue" value="'+v.unit_price+'"></td>';
                             str +='<td><input readonly onkeyup="" onchange="" onblur=""  style="width:140px;"  type="text"  name="quantity[]" id="item_quantity_" class="issue" value="'+v.quantity+'"></td>';
                             str +='<td><input readonly  style="width:140px;"  type="text" class="amount_"  name="amount[]" id="item_amount_" class="issue" value="'+v.amount+'"></td>';                     
                             str+='</tr>';
                         });

                         $('#sub_total').val(total);       
                         $('#delivery_items').append(str);
                    

                    }

                })
        }else{
            $('#delivery_items tr').remove();
            $('#sub_total').val('');  
            $('#attention').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            $('#advance').val('');
            $('#due').val('');
        }
    });
    
    
    
    
   
</script>


