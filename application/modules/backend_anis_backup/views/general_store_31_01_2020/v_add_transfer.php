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
                <h3>Add Transfer</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" action="<?php echo site_url('general_store/add_transfer'); ?>" method="post" enctype="multipart/form-data">
                            
                            
                            <div class="row">  
                                <div class="col-md-6">
                                    <div class='form-group row' >
                                                         <label for="title" class="col-sm-4 col-md-4 control-label">
                                                             Transfer Item <span class="required">*</span> :
                                                    </label>
                                                         <div class="col-sm-8 col-md-8 input-group">
                                                             <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                                            <select onchange="currentquantity(1)" id="itemID" class="form-control select2 item_name"  name="item_id" >
                                                        <option class="form-control">Select Item</option>
                                                        <?php foreach($items as $row){?>
                                                        <option  value="<?php echo $row['id'];?>"><?php echo $row['item_name'];?></option>
                                                        <?php }?>
                                                    </select>  
                                                            
                                                    </div>
                                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class='form-group row' >
                                                         <label for="title" class="col-sm-4 col-md-4 control-label">
                                                             Transfer Date <span class="required">*</span> :
                                                    </label>
                                                         <div class="col-sm-8 col-md-8 input-group">
                                                             <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                         <input class="form-control datepicker" name="transfer_date" type="text" value="<?php echo date('d-m-Y')?>">
                                                            
                                                    </div>
                                                    </div>
                                </div>
                                </div>
                            
                            
                            <div class="row">  
                                <div class="col-md-6">
                                    <div class='form-group row' >
                                                         <label for="title" class="col-sm-4 col-md-4 control-label">
                                                             
                                                             Transfer Quantity<span class="required">*</span> :
                                                    </label>
                                                         <div class="col-sm-8 col-md-8 input-group">
                                                             <span class="input-group-addon"><i class="fa fa-recycle"></i></span>
                                                            <input onblur="currentqueantityminus(1)" id="quantity" class="form-control" name="transfer_quantity" type="text" value="">  
                                                            
                                                    </div>
                                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class='form-group row' >
                                                         <label for="title" class="col-sm-4 col-md-4 control-label">
                                                            Total Quantity <span class="required">*</span> :
                                                    </label>
                                                         <div class="col-sm-8 col-md-8 input-group">
                                                             <span class="input-group-addon"><i class="fa fa-recycle"></i></span>
                                                             <input readonly="" class="form-control" id="total_quantity" name="total_quantity" type="text" value=""> 
                                                             <input disabled class="form-control" id="total_quantity_hidden" name="total_quantity_hidden" type="hidden" value="">
                                        
                                                            
                                                    </div>
                                                    </div>
                                </div>
                                </div>
                            
                            
                            <div class="row">  
                                <div class="col-md-6">
                                    <div class='form-group row' >
                                                         <label for="title" class="col-sm-4 col-md-4 control-label">
                                                             
                                                             From Project<span class="required">*</span> :
                                                    </label>
                                                         <div class="col-sm-8 col-md-8 input-group">
                                                             <span class="input-group-addon"><i class="fa fa-recycle"></i></span>
                                                            <select id="from_unit_id" class="form-control select2 from_unit_id"  name="from_unit_id" >
                                                        
                                                        <?php foreach($departments as $row){?>
                                                                <?php if($row['d_id'] != $d_id){ continue;}?>
                                                        <option   value="<?php echo $d_id;?>"><?php echo $row['short_name'];?></option>
                                                        <?php }?>
                                                    </select> 
                                                            
                                                    </div>
                                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class='form-group row' >
                                                         <label for="title" class="col-sm-4 col-md-4 control-label">
                                                            To Project <span class="required">*</span> :
                                                    </label>
                                                         <div class="col-sm-8 col-md-8 input-group">
                                                             <span class="input-group-addon"><i class="fa fa-recycle"></i></span>
                                                         <select id="to_unit_id" class="form-control select2 to_unit_id"  name="to_unit_id" >
                                                        <option class="form-control">Select Project</option>
                                                        <?php foreach($departments as $row){?>
                                                        <?php if($row['d_id'] == $d_id){ continue;}?>
                                                        <option  value="<?php echo $row['d_id'];?>"><?php echo $row['short_name'];?></option>
                                                        <?php }?>
                                                    </select> 
                                        
                                                            
                                                    </div>
                                                    </div>
                                </div>
                                </div>
                            
                            <div class="row">  
                                <div class="col-md-6">
                                    <div class='form-group row' >
                                                         <label for="title" class="col-sm-4 col-md-4 control-label">
                                                             
                                                             Price<span class="required">*</span> :
                                                    </label>
                                                         <div class="col-sm-8 col-md-8 input-group">
                                                             <span class="input-group-addon"><i class="fa fa-recycle"></i></span>
                                                            <input id="price" class="form-control" name="price" type="text" value="">  
                                                            
                                                    </div>
                                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class='form-group row' >
                                                         <label for="title" class="col-sm-4 col-md-4 control-label">
                                                            Remark <span class="required">*</span> :
                                                    </label>
                                                         <div class="col-sm-8 col-md-8 input-group">
                                                             <span class="input-group-addon"><i class="fa fa-recycle"></i></span>
                                                        <textarea class="form-control" name="remarks"></textarea> 
                                                            
                                                    </div>
                                                    </div>
                                </div>
                                </div>
                            
                            
                            













                            <div class="form-group" style="margin-top: 40px;">
                                <div class=" col-sm-2">
                                    <button type="submit" class="btn btn-primary button">SAVE</button>
                                </div>
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/general_store/transfer') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
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
                                            str += '<option value = "<?php echo $row['id']; ?>" ><?php echo $row['item_name']; ?> </option>';
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
     var item_id  = $('#itemID').val();
     
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
                
                $('#total_quantity').val(msg.data.item_info[0].quantity);
                $('#total_quantity_hidden').val(msg.data.item_info[0].quantity);
                }else{
                 $('#total_quantity').val('');
                $('#total_quantity_hidden').val('');   
                }
          //      $('#stock_qty_'+id).val(msg[0].stock_amount);
            }
        })
        }
        
        function currentqueantityminus(row){
        var conquantity = Number($("#quantity").val());
        var totalquantity = Number($("#total_quantity").val());
        var totalquantityhide = Number($("#total_quantity_hidden").val());
        
        if(conquantity > 0){
         
         if(conquantity > totalquantityhide){
            alert('Must be less than from total stock');
            $("#quantity").val('');
            return;
        }
     }else{
         alert('please input positive value and greater than 0');
         $('#amount').val('');
         $("#quantity").val('');
         
       return false;
       
     }
        
        
       
           var finalquantity = totalquantityhide - conquantity;
        $("#total_quantity").val(finalquantity); 
        
        
        
        
    
        
        }
        
        
    //})
</script>
