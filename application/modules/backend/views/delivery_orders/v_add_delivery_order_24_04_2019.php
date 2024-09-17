<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Delivery Order</h2>
    <hr>
    <form action="<?php echo site_url('delivery_orders/add_delivery_order_action'); ?>" method="post">
        <div class="row">
            <div class="col-md-6">
                    <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Sales Order<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <select required id="o_id" class="form-control" name="o_id">
                            <option class="form-control" value="">Select Order</option>
                            <?php foreach($sale_orders as $order){ ?>
                                <option class="form-control" value="<?php echo $order['o_id'] ?>"><?php echo $order['c_name'].'('.$order['order_no'].')' ?></option>
                            <?php } ?>
                       </select>
                    </div>
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Do. Number<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                         <input class="form-control" id="customer_id" name="customer_id" type="hidden" value="">
                         <input class="form-control" id="d_code" name="d_code" type="hidden" value="">
                         <input required class="form-control" readonly id="delivery_no" name="delivery_no" type="text" value="">
                    </div>
                </div>
            </div>
            
        </div>
          
         <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Date<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control datepicker" name="delivery_order_date" type="text" value="<?php echo date('d-m-Y') ?>"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Attention<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required id="attention" class="form-control" name="attention" type="text"></div>
                </div>
            </div>
            
        </div>
        
        
         <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Project Name<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required id="project_name" class="form-control" name="project_name" type="text"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Phone<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" id="phone" name="phone" type="text"></div>
                </div>
            </div>
            
        </div>
        
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Billing Address<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required id="billing_address" class="form-control" name="billing_address" type="text"></div>
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
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">D. Address<sup style="color:red;">*</sup> :</label></div>
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
        
      
        
      
       
        <hr>
        <div class="row">
            <input type="hidden" value="1" id="count" />
                <table class="table table-bordered" >
                    <thead>
                     <tr >
                         <th>Product Name <sup style='color:red'>*</sup></th>
                          <th>Unit Price</th>
                         <th>Quantity</th>              
                         <th>Amount</th>


                      </tr>
                    </thead>
                    <tbody id="delivery_items">

                      
                      </tbody>
                       <tfoot>
                            <tr>
                                <td colspan="3" style="text-align:right;">Subtotal:</td>

                                <td><input readonly style="width:140px;" id="sub_total"  name="total_amount" type="text"></td>
                            </tr>
                        </tfoot>
                  </table>
           
            
            
            
        </div>
        
       
        
        <div class="row">
           
            <div class="col-md-2 col-md-offset-3">
                <button type="submit" class="btn btn-primary button">SAVE</button>
            </div>
            <div class="col-md-2">
                <a href="<?php echo site_url('backend/delivery_orders') ?>" > <button type="button" class="btn btn-success button">REGISTER</button> </a>

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
            $('#d_code').val('');
            $('#delivery_no').val('');
            $('#customer_id').val('');  

            $('#attention').val('');
            $('#project_name').val('');
            $('#phone').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            
            var d = new Date();
            var n = d.getFullYear();
            var final = n.toString().substring(2);
            
            var data = {'o_id': o_id}
            $.ajax({
                    url: '<?php echo site_url('delivery_orders/get_sales_order_item'); ?>',
                    data: data,
                    method: 'POST',
                    dataType: 'json',
                    success: function (msg) { 
                       
                       
                        if(msg.order_code!=""){
                               var item_id=Number(msg.order_code[0].d_code)+1;
                         }else{
                              item_id=""; 
                         }

                        var item_sl_no;
                        if(item_id!=''){
                             if(item_id>999){
                                item_sl_no=item_id;
                            }else if(item_id>99){
                                item_sl_no='DO/'+msg.sales_order_info[0].c_short_name+'/'+final+'/'+"0"+item_id;
                            }else if(item_id>9){
                                item_sl_no='DO/'+msg.sales_order_info[0].c_short_name+'/'+final+'/'+"00"+item_id;
                            }else{
                                item_sl_no='DO/'+msg.sales_order_info[0].c_short_name+'/'+final+'/'+"000"+item_id;
                            }
                        }else{
                            item_id=1;
                            item_sl_no='DO/'+msg.sales_order_info[0].c_short_name+'/'+final+'/'+'0001';
                        }
                        
                        $('#d_code').val(item_id);
                        $('#delivery_no').val(item_sl_no);
                        $('#customer_id').val(msg.sales_order_info[0].id);  
                       
                        $('#attention').val(msg.sales_order_info[0].attention);
                        $('#project_name').val(msg.sales_order_info[0].project_name);
                        $('#phone').val(msg.sales_order_info[0].phone);
                        $('#billing_address').val(msg.sales_order_info[0].billing_address);
                        $('#billing_email').val(msg.sales_order_info[0].billing_email);
                        $('#shipping_address').val(msg.sales_order_info[0].shipping_address);
                        $('#shipping_email').val(msg.sales_order_info[0].shipping_email);
                   
                        var str='';
                        var total=0;

                         
                         $(msg.item_list).each(function (i, v) {
                           
                             total=total+Number(v.amount);
                             str+='<tr>';
                             str +='<td><input type="hidden"  name="s_item_id[]" id="item_des_c1_" class="issue" value="'+v.product_id+'"><input readonly style="width:140px;"  type="text"  name="name[]" id="item_des_c1_" class="issue" value="'+v.product_name+'"></td>';
                             str +='<td><input readonly  style="width:140px;"  type="text"  name="unit_price[]" id="item_unit_price_" class="issue" value="'+v.unit_price+'"></td>';
                             str +='<td><input required readonly onkeyup="" onchange="" onblur=""  style="width:140px;"  type="text"  name="quantity[]" id="item_quantity_" class="issue" value="'+v.quantity+'"></td>';
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
            
            $('#d_code').val('');
            $('#delivery_no').val('');
            $('#customer_id').val('');  
            
            $('#attention').val('');
            $('#project_name').val('');
            $('#phone').val('');
            $('#billing_address').val('');
            $('#billing_email').val('');
            $('#shipping_address').val('');
            $('#shipping_email').val('');
            
        }
    });
    
    
    
    
   
</script>

