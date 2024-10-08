
<style type="text/css">
    .form-control{
        height:30px;
    }
</style>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
   
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Bill</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <form class="form-horizontal"  action="<?php echo site_url('accounts/edit_bill_action/'.$bill_info[0]['id']); ?>" method="post" onsubmit="javascript: return validation()">
       
        <div class='form-group' style="margin-bottom:30px;" >
                                <label for="title" class="col-sm-2 control-label">
                                    Suppliers<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select  id="supplier_id" class="form-control e1" name="supplier_id">
                                        <option class="form-control" value="">Select supplier</option>
                                        <?php foreach($suppliers as $supplier){ ?>
                                        <option <?php if($supplier['ID']==$bill_info[0]['supplier_id'])echo "selected";  ?> class="form-control" value="<?php echo $supplier['ID'] ?>"><?php echo $supplier['SUP_NAME']; ?></option>
                                        <?php } ?>

                                   </select>
                        <span id="supplier_id_error" style="color:red"></span>
                                </div>
            
            <label for="title" class="col-sm-2 control-label">
                                    Receive Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control datepicker" id="date" name="date" type="text" value="<?php if(!empty($bill_info[0]['date'])) echo date('d-m-Y',strtotime($bill_info[0]['date'])); ?>">
                          <span id="date_error" style="color:red"></span>
                                </div>
 
            
                                

        </div> 
        
     
        
        <div class='form-group' >
            
            
                <label for="title" class="col-sm-2 control-label">
                    Bill No.<sup class="required">*</sup> :
                </label>
                <div class="col-sm-4 input-group">
                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                    <input    id="supplier_bill_no" class="form-control " name="supplier_bill_no" type="text" value="<?php echo $bill_info[0]['supplier_bill_no'] ?>">
                    <span id="supplier_bill_error" style="color:red"></span>
                </div>
                               
                <label for="title" class="col-sm-2 control-label">
                    Bill Amount<sup class="required">*</sup> :
                </label>
                <div class="col-sm-4 input-group">
                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                    <input    id="amount" class="form-control number" name="amount" type="text" value="<?php echo $bill_info[0]['amount'] ?>">
                    <span id="amount_error" style="color:red"></span>
                </div>
        </div>
        
        
      
        
         <div class='form-group' >
             
             
             
                               

             
                                <label for="title" class="col-sm-2 control-label">
                                    Remark<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control " name="remark" type="text" value="<?php echo $bill_info[0]['remark'] ?>">
                                </div>

       </div>
        
        




        
          <div class="row">
            <div class="col-md-6" id="no">
                
                
                
               
                
            </div>
            <div class="col-md-6" id="date">
                
               
                
                
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-6" id="bg_lc_tenor">
               
            </div>
            <div class="col-md-6" id="expire_date">
                
            </div>
        </div>
        
        

        
        
    
       
        <div class="form-group" style="margin-top: 40px;">
            <div class="col-sm-2">
                <a href="<?php echo site_url('backend/accounts') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
            </div>

            <div class=" col-sm-2">
                <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">SAVE</button>
            </div>

        </div>

            
       
    </form>
</div>
</div>
</div>
</div>
</div>
</div>


<script type="text/javascript">
    
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
    
    
    
    function validation(){
          
        var payment_date=$('#date').val();
        
        var supplier_id=$('#supplier_id').val(); 
        var amount=$('#amount').val(); 
      
        var error=false;
        
        if(supplier_id==''){
            $('#supplier_id_error').html('Please select supplier');
            $('#supplier_id').css('border','1px solid red');
            error=true;
            $('#supplier_id').focus();
        }else{
            $('#supplier_id_error').html('');
            $('#supplier_id').css('border','1px solid #ccc');   
            
        }
        
        if(date==''){
            $('#date').css('border','1px solid red');
            $('#date_error').html('Please fill payment date field');
            error=true;
           $('#date').focus();
           
        }else{
            $('#date').css('border','1px solid #ccc');
            $('#date_error').html('');
            
        }
      
        
       
        
       
        if(amount==''){
            $('#amount_error').html('Please fill amount field');
            $('#amount').css('border','1px solid red');
            error=true;
        }else{
            $('#amount_error').html('');
            $('#amount').css('border','1px solid #ccc');   
            
        }
        
        if(error==true){
            return false;
        }
    }
    
   
    
    
    
    function paymentCondition(){
        
        $('#myModal').modal('show');
    }
    
    
   
    
    
    
 
 function checkNumeric(){
         $('.number').on('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);  
        });
 }
    
    
    
    
    
   
</script>

