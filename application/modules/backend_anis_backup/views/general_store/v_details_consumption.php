<style>
    th{
        vertical-align: middle;
        text-align: center;
    }
</style>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Detials Consumption</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('general_store/details_consumption/' . $consumption_info[0]['consumption_id'] . '/true'); ?>" class="btn btn-sm btn-warning">PRINT</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class='form-group'>
                                 <label for="title" class="col-sm-2 col-md-2 control-label">
                                            Issue No :
                                 </label>
                                 <div class="col-sm-4 col-md-4 input-group">
                                     
                                    <?php echo "000".$consumption_info[0]['consumption_id'];?>

                                 </div>
                                
                                <label for="title" class="col-sm-2 col-md-2 control-label">
                                            Issue Date :
                                 </label>
                                 <div class="col-sm-4 col-md-4 input-group">
                                     
                                    <?php echo date('d-m-Y',strtotime($consumption_info[0]['consumption_date']))?>

                                 </div>
                                
                                
                            </div>
                        </div>    
                        
                        
                        <div class="row">
                            <div class='form-group'>
                                 <label for="title" class="col-sm-2 col-md-2 control-label">
                                            Cost Center:
                                 </label>
                                 <div class="col-sm-4 col-md-4 input-group">
                                     
                                    <?php echo $consumption_info[0]['c_c_name'];?>

                                 </div>
                                
                                <label for="title" class="col-sm-2 col-md-2 control-label">
                                       Department:
                                </label>
                                <div class="col-sm-4 col-md-4 input-group">
                                     
                                    <?php echo $consumption_info[0]['dept_name'];?>

                                </div>
                                
                                
                            </div>
                                
                        </div>
                        
                        
                        
                        
                       <div class="row">
                            <div class='form-group'>
                                 <label for="title" class="col-sm-2 col-md-2 control-label">
                                            Received By:
                                 </label>
                                 <div class="col-sm-4 col-md-4 input-group">
                                     
                                    <?php echo $consumption_info[0]['name'];?>

                                 </div>
                                
                                
                                
                                
                            </div>
                                
                        </div> 
                        
                        
                        
                        
                        <br/>

                            <table id="create_new_row" class="table table-bordered">
                                <tr>
                                    
                                    <th style="width:20%">Item</th>
                                   <th style="width:20%">Brand Name</th>
                                    <th style="width:5%">Quantity</th>
                                  
                                    <th style="width:20%">Remarks</th>
                                </tr>
                                
                                
                                <tr>
                                    
                                    <td>
                                        <?php echo $consumption_info[0]['item_name']; ?>
                                    </td>
                                    
                                    <td>
                                        <?php echo $consumption_info[0]['brand_name']; ?>
                                    </td>
                                    
                                    <td style="text-align: right;">
                                        <?php echo $consumption[0]['consumption_quantity']?>
                                    </td>
                                    
                                   
                                    <td>
                                        <?php echo $consumption[0]['remarks']?>  
                                    </td>
                                </tr>
                            </table>













                            <div class="form-group" style="margin-top: 40px;">
                                
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/general_store/consumption') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                                </div>
                            </div>
                        </form>     
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $('.select2').select2();
    
    
   
    
    function createrow(){
    var row = parseInt($('#current_row').val());
    var next_row = row + 1;
    
    $('#current_row').val(next_row);
    var str = '';
    str += '<td onclick="remove('+next_row+')" style="color:red;text-align: center;font-size: 23px;cursor: pointer;"><i class="fa fa-minus"></i></td>';
    str += '<td><select onchange="currentquantity('+next_row+')" id="itemID_'+next_row+'" class="form-control select2 item_name"  name="item_id['+next_row+']" ><option>Select Item</option>';
    
    <?php
if ($items) {
    foreach ($items as $row) {
        ?>
                                            str += '<option value = "<?php echo $row['id']; ?>" ><?php echo str_replace("'", "", $row['item_name']); ?> </option>';
        <?php
    }
}
?>
    str +='</select></td>';
    
    str += '<td><select id="c_c_id_'+next_row+'" class="form-control select2 item_name"  name="c_c_id['+next_row+']" ><option>Select Cost Center</option>';
    
    <?php
if ($cost_centers) {
    foreach ($cost_centers as $row) {
        ?>
                                            str += '<option value = "<?php echo $row['c_c_id']; ?>" ><?php echo $row['c_c_name']; ?> </option>';
        <?php
    }
}
?>
    str +='</select></td>';
    str += '<td><input onblur="currentqueantityminus('+next_row+')" id="quantity_'+next_row+'" class="form-control" name="consumption_quantity['+next_row+']" type="text" value=""></td>';
    str += '<td><input readonly="" class="form-control" id="total_quantity_'+next_row+'" name="total_quantity['+next_row+']" type="text" value=""><input disabled class="form-control" id="total_quantity_hidden_'+next_row+'" name="total_quantity_hidden" type="hidden" value="">  </td>';
    str += '<td><textarea class="form-control" name="remarks['+next_row+']"></textarea></td>';
    
    //str+='</tr>'
    
    $('#create_new_row').append('<tr id="remove_' + next_row + '">' + str + '</tr>');
    }
    
    function remove(row){
         if (confirm('Are you sure to delete ?') == true) {
       $('#remove_'+row).remove();
         }
    }
    
    
    // $('.item_name').change(function(){
    function currentquantity(row){
        
      var item_id  = $('#itemID_'+row).val();
      
     var data = {'item_id': item_id}
        $.ajax({
            url: '<?php echo site_url('general_store/item_stock'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
                
                
//                $('#item_des_'+id).val(msg.item_info[0].item_name);
//                $('#unit_'+id).val(msg.item_info[0].meas_unit);
//                $('#stock_qty_'+id).val(msg.item_info[0].stock_amount);
                if(msg.mag == 'success'){   
                
                $('#total_quantity_'+row).val(msg.data.item_info[0].quantity);
                $('#total_quantity_hidden_'+row).val(msg.data.item_info[0].quantity);
                }else{
                 $('#total_quantity_'+row).val('');
                $('#total_quantity_hidden_'+row).val('');   
                }
          //      $('#stock_qty_'+id).val(msg[0].stock_amount);
            }
        })
        }
        
        function currentqueantityminus(row){
        var conquantity = Number($("#quantity_"+row).val());
        var totalquantity = Number($("#total_quantity_"+row).val());
        var totalquantityhide = Number($("#total_quantity_hidden_"+row).val());
        
        if(conquantity > 0){
         
         if(conquantity > totalquantityhide){
            alert('Must be less than from total stock');
            $("#quantity_"+row).val('');
            return;
        }
     }else{
         alert('please input positive value and greater than 0');
         $('#amount').val('');
         $("#quantity_"+row).val('');
         
       return false;
       
     }
        
        
       
//           var finalquantity = totalquantityhide - conquantity;
//        $("#total_quantity_"+row).val(finalquantity); 
        
        
        
        
    
        
        }
        
        
    //})
</script>
