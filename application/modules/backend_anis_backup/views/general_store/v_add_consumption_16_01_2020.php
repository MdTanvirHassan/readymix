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
                <h3>Add Consumption</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" action="<?php echo site_url('general_store/add_consumption'); ?>" method="post" enctype="multipart/form-data">
                                                    <div class='form-group' >
                                                         <label for="title" class="col-sm-2 col-md-2 control-label">
                                                                Consumption Date <span class="required">*</span> :
                                                         </label>
                                                         <div class="col-sm-4 col-md-4 input-group">
                                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                <input required  class="form-control datepicker" name="consumption_date" type="text" value="">

                                                          </div>
                                                        
                                                        
                                                        <label for="title" class="col-sm-2 col-md-2 control-label">
                                                                Received By <span class="required"></span> :
                                                        </label>
                                                         <div class="col-sm-4 col-md-4 input-group">
                                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                <select id="received_by" class="form-control select2 item_name"  name="received_by" >
                                                                    <option class="form-control">Select Employee</option>
                                                                    <?php foreach($employees as $employee){?>
                                                                        <option  value="<?php echo $employee['id'];?>"><?php echo $employee['name'];?></option>
                                                                    <?php }?>
                                                                </select>   
                                                          </div>
                                                   
                                                    </div>    

                            <table id="create_new_row" class="table table-bordered">
                                <tr>
                                 <!--   <th onclick="createrow()"  style="color:red;text-align: center;font-size: 23px;cursor: pointer;"><i class=" fa fa-plus"></i><input type="hidden" id="current_row" value="1"></th>-->
                                    <th style="width:20%">Item</th>
                                    <th style="width:20%">Brand</th>
                                    <th style="width:20%">Department</th>
                                    <th style="width:20%">Cost Center</th>
                                    <th>Consumption Quantity</th>
                                  <!--  <th>Total Quantity</th>-->
                                     <th style="width:10%">Current Stock</th>
                                    <th style="width:20%">Remarks</th>
                                </tr>
                                <tr id="remove_1">
                                  <!--  <td></td>-->
                                    <td>
                                        <select onchange="currentquantity(1)" id="itemID_1" class="form-control select2 item_name"  name="item_id[1]" >
                                                        <option class="form-control">Select Item</option>
                                                        <?php foreach($items as $row){?>
                                                        <option  value="<?php echo $row['id'];?>"><?php echo $row['item_name'];?></option>
                                                        <?php }?>
                                                    </select>   
                                    </td>
                                    <td>
                                        <select id="brand_id_1" class="form-control select2 item_name"  name="brand_id[1]" >
                                            <option class="form-control">Select Brand</option>
                                                 
                                        </select>   
                                    </td>
                                    
                                    
                                    <td>
                                        <select id="dept_id" class="form-control select2 item_name"  name="dept_id[1]" >
                                                        <option>Select Department</option>
                                                        <?php foreach($departments as $dp){?>
                                                        <option  value="<?php echo $dp['id'];?>"><?php echo $dp['dept_name'];?></option>
                                                        <?php }?>
                                                    </select>   
                                    </td>
                                    
                                    <td>
                                        <select id="c_c_id_1" class="form-control select2 item_name"  name="c_c_id[1]" >
                                                        <option>Select Cost Center</option>
                                                        <?php foreach($cost_centers as $row){?>
                                                        <option  value="<?php echo $row['c_c_id'];?>"><?php echo $row['c_c_name'];?></option>
                                                        <?php }?>
                                                    </select>   
                                    </td>
                                    <td>
                                        <input onblur="currentqueantityminus(1)" id="quantity_1" class="form-control" name="consumption_quantity[1]" type="text" value="">
                                        <input  id="rate" class="form-control" name="rate[1]" type="hidden" value="">
                                    </td>
                                    
                                    
                                    
                                    
                                    <td>
                                        <input readonly="" class="form-control" id="total_quantity_1" name="total_quantity[1]" type="text" value=""> 
                                        <input disabled class="form-control" id="total_quantity_hidden_1" name="total_quantity_hidden" type="hidden" value=""> 
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="remarks[1]"></textarea>  
                                    </td>
                                </tr>
                            </table>













                            <div class="form-group" style="margin-top: 40px;">
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/general_store/consumption') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                                </div>
                                <div class=" col-sm-2">
                                    <button type="submit" class="btn btn-primary button">SAVE</button>
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
    str += '<td><select id="brand_id_'+next_row+'" class="form-control select2 item_name"  name="brand_id['+next_row+']" ><option>Select Brand</option>';            
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
    str += '<td><input type="text"  required id="quantity_'+next_row+'" class="form-control" name="consumption_quantity['+next_row+']" onblur="currentqueantityminus('+next_row+')" onkeyup="currentqueantityminus('+next_row+')" onchange="currentqueantityminus('+next_row+')"   value=""></td>';
    str += '<td><input readonly="" class="form-control" id="total_quantity_'+next_row+'" name="total_quantity['+next_row+']" type="text" value=""><input readonly class="form-control" id="total_quantity_hidden_'+next_row+'" name="total_quantity_hidden" type="hidden" value="">  </td>';
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
      $('#rate').val('');
     var data = {'item_id': item_id}
     
        $.ajax({
            url: '<?php echo site_url('general_store/item_stock'); ?>',
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function (msg) {
                
                

                if(msg.mag == 'success'){   
                
                var br='';
                br+='<option value="">Select</option>';
                $.each( msg.data.brands, function( key,v ){
                    br+='<option value="'+v.id+'">'+v.brand_name+'</option>';
                });
                
                $('#brand_id_'+row).html(br); //by jubayer
                
                
            //    $('#total_quantity_'+row).val(msg.data.item_info[0].quantity); //by jubayer
            //    $('#total_quantity_hidden_'+row).val(msg.data.item_info[0].quantity);
                
                $('#total_quantity_'+row).val(msg.data.quantity); 
                $('#total_quantity_hidden_'+row).val(msg.data.quantity);  
                
                
                $('#rate').val(msg.data.current_rate);
                //$('#total_quantity_'+row).val(msg.data.item_info[0].stock_amount); //by alauddin
                //$('#total_quantity_hidden_'+row).val(msg.data.item_info[0].stock_amount);
                }else{
                    $('#rate').val('');
                    $('#total_quantity_'+row).val('');
                    $('#total_quantity_hidden_'+row).val('');   
                }
          
            }
        })
        }
        
        function currentqueantityminus(row){
       
                var conquantity = Number($("#quantity_"+row).val());
                var totalquantity = Number($("#total_quantity_"+row).val());
                var totalquantityhide = Number($("#total_quantity_hidden_"+row).val());

                if(conquantity > 0){

                    if(conquantity > totalquantityhide){
                      // alert('Must be less than from total stock');
                      alert('Must be less than from current stock');
                       $("#quantity_"+row).val('');
                       return;
                   }
                }else{
                    alert('please input positive value and greater than 0');
                    $('#amount').val('');
                    $("#quantity_"+row).val('');

                  return false;

                }
        
        
       
                var finalquantity = totalquantityhide - conquantity;
               // $("#total_quantity_"+row).val(finalquantity); //added by jubayer
        
        
        
        
    
        
        }
        
        
    //})
</script>
