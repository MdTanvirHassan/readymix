 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; ">Edit Mixing Item </h2>
            <hr>
            <form action="<?php echo site_url('products_mixing/edit_product_mixing_action/'.$mixing_info[0]['mixing_id']); ?>" method="post">
                
                
                <div class="row">
                
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Product  :</label></div>
                            <div class="col-sm-8 col-md-5 "><select required style="width:200px;" class="e1" style="width:100px;" id="item_c_1" name="product_id" >
                                    <option value="">Select Product</option>
                                    <?php foreach($products as $product){ ?>
                                        <option <?php if($mixing_info[0]['product_id']==$product['product_id']) echo 'selected'; ?> value="<?php echo $product['product_id'];  ?>"><?php if(!empty($product['product_name'])) echo $product['product_name']; ?></option>
                                    <?php } ?>
                                </select></div>
                        </div>
                    </div>
                    
                    
                   
                </div>
                
                
                
               
     
              
                
            <input type="hidden" id="count" value="<?php echo count($mixing_details_info); ?>"/>
            <table class="table table-bordered" id="myTable">
                    <thead>
                     <tr class="row">
                         <th style="width:30px;padding:4px;">
                             <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" id="button1" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                         </th>
                         <th>Material <sup style='color:red'>*</sup></th>
                         <th>MU</th>
                         <th>Quantity</th>
                         
                        


                      </tr>
                    </thead>
                    <tbody>

                      <?php $i = 0;
                    foreach ($mixing_details_info as $mixing) {  
                        $i++;
                        ?>
                      <tr class="row" id="row_<?php echo $i; ?>">
                           <?php if ($i > 1) { ?>
                                <td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow('<?php echo $i; ?>')" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-minus"></span></button></td>
                            <?php } else { ?>
                                <td></td>
                            <?php } ?>
                          <td> <select required style="width:200px;" class="e1" style="width:100px;" id="material_<?php echo $i; ?>" name="m_id[]" onchange="javascript:item_info(<?php echo $i; ?>);" >
                                    <option value="">Select Item</option>
                                    <?php foreach($materials as $material){ ?>
                                        <option <?php if (!empty($mixing['m_id']) && $mixing['m_id'] == $material['id']) echo "selected"; ?> value="<?php echo $material['id'];  ?>"><?php if(!empty($material['item_name'])) echo $material['item_name']; ?></option>
                                    <?php } ?>
                                </select></td>
                        <td><input  style="width:140px;"  type="text"  name="meas_unit[]" id="mu_<?php echo $i; ?>" class="issue" value='<?php echo $mixing['meas_unit'];  ?>'></td>
                        <td><input required  style="width:140px;"  type="text"  name="quantity[]" id="item_des_" class="issue" value='<?php echo $mixing['quantity'];  ?>'></td>
                        
                      </tr>
                    <?php } ?>   
                      </tbody>
                  </table>
                <div class="row">
                   
                        <div class="row">
                            <div class="col-md-2 ">
                                <button type="submit" class="btn btn-primary button">UPDATE</button>
                            </div>
                            <div class="col-md-2">
                                <a href="<?php echo site_url('backend/products_mixing') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                          </div>       
                 
                </div>
                   
                    <div class="col-md-2">
                        <div class="row">
                  <!--          
                    <div class="col-md-12">
                        <button type="button" class="btn btn-default button">SIMILAR LIST</button>
                    </div>-->
                        </div>
                    </div>
                </div>
                
            </form>
        </div>

    <script type="text/javascript">
        $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr=$('#material_1').html();
        
        var str= '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str +='<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>'; 
        str +='<td><select required class="e1" style="width:200px;"  name="m_id[]" onchange="item_info(' + (Number(count) + 1) + ')" id="material_'+(Number(count) + 1) + '" class="">'+itemstr+'</select></td>';
        str +='<td><input  style="width:140px;"  type="text"  name="mu[]" id="mu_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><input required  style="width:140px;"  type="text"  name="quantity[]" id="quantity_'+(Number(count) + 1) + '" class="issue"></td>';
        
        str +='</tr>';
       
        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
        $('select.e1').select2();
        $('.chzn-container').remove();
    });
    
    function removeRow(row) {
        $('#row_' + row).remove();
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
                    
