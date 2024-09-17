 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(7, 18, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) { ?> 
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'customers') echo 'active'; ?>" href="<?php echo site_url('backend/customers'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Customers</span>
                        </a>
                    </li>
                <?php } ?> 
<?php $this->role = checkUserPermission(7, 19, $userData);
if (empty($this->role) || !in_array(11, $this->role)) { ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'bank') echo 'active'; ?>" href="<?php echo site_url('backend/bank'); ?>">
                            <i class="fa fa-university"></i><br><span>Bank</span></a>
                    </li>
<?php } ?>
<?php $this->role = checkUserPermission(7, 20, $userData);
if (empty($this->role) || !in_array(11, $this->role)) { ?>          
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'product_category') echo 'active'; ?>" href="<?php echo site_url('backend/product_categories'); ?>">
                            <i class="fa fa-object-group"></i><br><span>Categories</span></a>
                    </li>
<?php } ?>
<?php $this->role = checkUserPermission(7, 21, $userData);
if (empty($this->role) || !in_array(11, $this->role)) { ?>    
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'sales_product') echo 'active'; ?>" href="<?php echo site_url('backend/sale_products'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Products</span></a>
                    </li>
<?php } ?>
                <?php $this->role = checkUserPermission(7, 22, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) { ?>       
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'product_mixing') echo 'active'; ?>" href="<?php echo site_url('backend/products_mixing'); ?>">
                            <i class="fa fa-cubes"></i><br><span>Products Mixing</span></a>
                    </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(7, 23, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) { ?>          
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'project') echo 'active'; ?>" href="<?php echo site_url('backend/projects'); ?>">
                            <i class="fa fa-home"></i><br><span>Projects</span></a>
                    </li>
<?php } ?>

            </ul>
        </div>
    </div>

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Product Mixing</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal" action="<?php echo site_url('products_mixing/edit_product_mixing_action/'.$mixing_info[0]['mixing_id']); ?>" method="post" onsubmit="javascript: return validation()">
                <div class='form-group' style="margin-bottom:20px;">
                                <label for="title" class="col-sm-2 control-label">
                                    <b>PRODUCT</b><sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select   class="e1 form-control"  id="product_id" name="product_id" >
                                    <option value="">Select Product</option>
                                    <?php foreach($products as $product){ ?>
                                        <option <?php if($mixing_info[0]['product_id']==$product['product_id']) echo 'selected'; ?> value="<?php echo $product['product_id'];  ?>"><?php if(!empty($product['product_name'])) echo $product['product_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <span id="product_id_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                  <!-- <span id="m_unit" ><?php echo 'Per '.$mixing_info[0]['measurement_unit']; ?></span>-->
                                </label>
                                

                            </div>
                
<!--                <div class="row">
                
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-2 col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Product  :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                <select  style="width:200px;" class="e1" style="width:100px;" id="product_id" name="product_id" >
                                    <option value="">Select Product</option>
                                    <?php foreach($products as $product){ ?>
                                        <option <?php if($mixing_info[0]['product_id']==$product['product_id']) echo 'selected'; ?> value="<?php echo $product['product_id'];  ?>"><?php if(!empty($product['product_name'])) echo $product['product_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <span id="product_id_error" style="color:red"></span>
                            </div>
                            <div class="col-sm-2 col-md-2 ">
                                <span id="m_unit" ><?php echo 'Per '.$mixing_info[0]['measurement_unit']; ?></span>
                           </div>
                        </div>
                    </div>
                    
                    
                   
                </div>-->
                
                
                
               
     
              
<p><b>MATERIALS REQUIRE FOR 01 <span id="m_unit" ><?php echo  $mixing_info[0]['measurement_unit']; ?></span></b></p>   
            <input type="hidden" id="count" value="<?php echo count($mixing_details_info); ?>"/>
            <table class="table table-bordered" id="myTable">
                    <thead>
                     <tr class="">
                         <th>SN</th>
                         <th>Material <sup style='color:red'>*</sup></th>
                         <th>Req. Qnty</th>
                         <th>MU</th>
                         <th>Conversion Factor</th>
                         <th>C. Quantity</th>
                         <th>MU</th>
                         <th style="width:30px;padding:4px;">
                             <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" id="button1" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                         </th>
                        


                      </tr>
                    </thead>
                    <tbody>

                      <?php $i = 0;
                    foreach ($mixing_details_info as $mixing) {  
                        $i++;
                        ?>
                      <tr class="" id="row_<?php echo $i; ?>">
                          <td><?php echo $i; ?></td>
                        
                          <td> <select required style="width:200px;" class="e1" style="width:100px;" id="material_<?php echo $i; ?>" name="m_id[]" onchange="javascript:item_info(<?php echo $i; ?>);" >
                                    <option value="">Select Item</option>
                                    <?php foreach($materials as $material){ ?>
                                        <option <?php if (!empty($mixing['m_id']) && $mixing['m_id'] == $material['id']) echo "selected"; ?> value="<?php echo $material['id'];  ?>"><?php if(!empty($material['item_name'])) echo $material['item_name']; ?></option>
                                    <?php } ?>
                                </select></td>
                        <td><input required  style="width:140px;text-align:right;"  type="text"  name="quantity[]" onkeyup="calculateConvertQnty(<?php echo $i; ?>)" onchange="calculateConvertQnty(<?php echo $i; ?>)" id="quantity_<?php echo $i; ?>" class="issue number" value='<?php echo $mixing['quantity'];  ?>'></td>        
                        <td><input readonly  style="width:140px;"  type="text"  name="meas_unit[]" id="mu_<?php echo $i; ?>" class="issue" value='<?php echo $mixing['meas_unit'];  ?>'></td>                   
                        <td><input required  style="width:140px;text-align:right;"  type="text"  name="conversion_factor[]" onkeyup="calculateConvertQnty(<?php echo $i; ?>)" onchange="calculateConvertQnty(<?php echo $i; ?>)" id="conversion_factor_<?php echo $i; ?>"  class="issue number" value='<?php echo $mixing['conversion_factor'];  ?>'></td>
                        <td><input required  style="width:140px;text-align:right;"  type="text"  name="c_quantity[]" onkeyup="calculateRequireQnty(<?php echo $i; ?>)" onchange="calculateRequireQnty(<?php echo $i; ?>)" id="c_quantity_<?php echo $i; ?>" class="issue number" value='<?php echo $mixing['c_quantity'];  ?>'></td>
                        <td><input readonly  style="width:140px;"  type="text"  name="c_mu[]" id="c_mu_<?php echo $i; ?>" class="issue number" value='<?php echo $mixing['c_mu'];  ?>'></td>
                        <?php if ($i > 1) { ?>
                             <td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow('<?php echo $i; ?>')" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-minus"></span></button></td>
                         <?php } else { ?>
                             <td></td>
                         <?php } ?>
                      </tr>
                    <?php } ?>   
                      </tbody>
                  </table>
                
                   <div class="form-group" style="margin-top: 40px;">
                       
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/products_mixing') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
                                </div>
                       
                                <div class=" col-sm-2">
                                   <button type="submit" class="btn btn-primary button">UPDATE</button>
                                </div>
                                
                            </div>
<!--                        <div class="row">
                          <div class="col-md-1" >
                                <a href="<?php echo site_url('backend/products_mixing') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;" >REGISTER</button> </a>
                          </div>       
                            <div class="col-md-2 ">
                                <button type="submit" class="btn btn-primary button">UPDATE</button>
                            </div>
                            
                 
                </div>-->
                   
                   
                
            </form>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

    <script type="text/javascript">
        
        
        function calculateConvertQnty(id){
            var item=$('#material_'+id).val();
            var item_m_unit=$('#mu_'+id).val();
            var r_qty=$('#quantity_'+id).val();
            var c_factor=$('#conversion_factor_'+id).val();
            var c_qty=$('#c_quantity_'+id).val();
            if(item!=''){
                if(c_factor!='' && r_qty!=''){
                    var c_qty=Number(r_qty)/Number(c_factor);
                    var n_c_qty=c_qty.toFixed(2);
                    $('#c_quantity_'+id).val(n_c_qty);
                    if(Number(c_factor)>1){
                        $('#c_mu_'+id).val('Cft');
                    }else{
                        $('#c_mu_'+id).val(item_m_unit);
                    }
               }else{   
                    $('#c_quantity_'+id).val(''); 
               }
           }else{      
               //alert(id);
               
               alert('Please select item first');
                $('#quantity_'+id).val('');
           }    
        }
        
        function calculateRequireQnty(id){
            var item=$('#material_'+id).val();
            var item_m_unit=$('#mu_'+id).val();
            var r_qty=$('#quantity_'+id).val();
            var c_factor=$('#conversion_factor_'+id).val();
            var c_qty=$('#c_quantity_'+id).val();
            if(item!=''){
                if(c_factor!='' && c_qty!=''){
                    var r_qty=Number(c_qty)*Number(c_factor);
                    var n_r_qty=r_qty.toFixed(2);
                   // alert(n_r_qty);
                    $('#quantity_'+id).val(n_r_qty);
                    if(Number(c_factor)>1){
                        $('#c_mu_'+id).val('Cft');
                    }else{
                        $('#c_mu_'+id).val(item_m_unit);
                    }
                }else{
                    $('#quantity_'+id).val('');
                }
            }else{
                $('#c_quantity_'+id).val('');
                alert('Please select item first');
            }     
        }
        
        
        
        
        $('#product_id').change(function (){
            var product_id=$('#product_id').val();
            if(product_id!=''){
                var data = {'product_id': product_id}
                $.ajax({
                    url: '<?php echo site_url('products_mixing/get_product_info'); ?>',
                    data: data,
                    method: 'POST',
                    dataType: 'json',
                    success: function (msg) {   
                     $('#m_unit').html('Per '+msg.product_info[0].measurement_unit);         
                   }


                })
           }else{
              $('#m_unit').html('');      
           }
      });  
        
         function validation(){
            var product_id=$('#product_id').val();

            var error=false;

            if(product_id==''){
                $('#product_id').css('border','1px solid red');
                $('#product_id_error').html('Please select product');
                error=true;

            }else{
                $('#product_id').css('border','1px solid #ccc');
                $('#product_id_error').html('');

            }


            if(error==true){
                return false;
            }
    }
        
        
        $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr=$('#material_1').html();
        
        var str= '<tr class="" id="row_' + (Number(count) + 1) + '">';
        
        str +='<td>'+(Number(count) + 1)+'</td>';
        str +='<td><select required class="e1" style="width:200px;"  name="m_id[]" onchange="item_info(' + (Number(count)+1) + ')" id="material_'+(Number(count)+1) + '" class="">'+itemstr+'</select></td>';
        str +='<td><input required style="width:140px;text-align:right;"  type="text"  name="quantity[]" onkeyup="calculateConvertQnty('+(Number(count)+1)+')" onchange="calculateConvertQnty('+(Number(count)+1)+')" id="quantity_'+(Number(count)+1)+'" class="issue number"></td>';
        str +='<td><input readonly style="width:140px;"  type="text"  name="mu[]" id="mu_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><input required style="width:140px;text-align:right;"  type="text"  name="conversion_factor[]" onkeyup="calculateConvertQnty('+(Number(count)+1)+')" onchange="calculateConvertQnty('+(Number(count) + 1)+')" id="conversion_factor_'+(Number(count) + 1) + '" class="issue number"></td>';
        str +='<td><input required style="width:140px;text-align:right;"  type="text"  name="c_quantity[]" onkeyup="calculateRequireQnty('+(Number(count)+1)+')" onchange="calculateRequireQnty('+(Number(count) + 1)+')" id="c_quantity_'+(Number(count) + 1) + '" class="issue number"></td>';
        str +='<td><input readonly style="width:140px;"  type="text"  name="c_mu[]" id="c_mu_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>'; 
        
        str +='</tr>';
       
        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
        $('select.e1').select2();
        $('.chzn-container').remove();
        $('.number').on('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);
        });
    });
    
    function removeRow(row) {
        $('#row_' + row).remove();
        var count = $('#count').val();
        $('#count').val(Number(count)-1);
    }
    
    function item_info(id) {
        var itemId = $('#material_'+id).val();
        var data = {'itemId': itemId}
        $.ajax({
            url: '<?php echo site_url('general_store/item_info'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {   
             $('#mu_'+id).val(msg.item_info[0].meas_unit);         
           }
                
            
        })

    }

    </script>
                    
