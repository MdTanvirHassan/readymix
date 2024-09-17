 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <div class="os-tabs-w menu-shad">
                <?php 
      
                    require_once(__DIR__ .'/../../imports_header.php');
                ?>
            </div>

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>DETAILS SALES CONTRACT</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal" action="<?php echo site_url('imports/sales_contact/edit_sales_contact_action/'.$contact_info[0]['id']); ?>" method="post" onsubmit="javascript: return validation()">
                
                
                
                             <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Supplier<sup class="required">*</sup>  :
                                </label> 
                                 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   
                                     <select disabled id="sup_id" name="sup_id" class="form-control e1">
                                        <option value="">Select Supplier</option>
                                        <?php foreach($suppliers as $sup){ ?>
                                            <option <?php if($sup['ID']==$contact_info[0]['sup_id']) echo "selected"; ?> value="<?php echo $sup['ID'];  ?> "><?php echo $sup['SUP_NAME'];  ?></option>
                                        <?php } ?>    
                                    </select>
                                    
                                </div>
                                
                                
                                

                            </div>
                            
                
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Contract Number<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   
                                    
                                    
                                     <input readonly id="contact_no" class="form-control"  name="contact_no" type="text" value="<?php if(!empty($contact_info[0]['contact_no'])) echo $contact_info[0]['contact_no']; ?>">
                                    
                                </div>
                                
                                
                                <label for="title" class="col-sm-2 control-label">
                                    Contract Date<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   
                                     <input disabled id="contact_date" class="form-control datepicker"  name="contact_date" type="text" value="<?php if(!empty($contact_info[0]['contact_date'])) echo date('d-m-Y',strtotime($contact_info[0]['contact_date'])); ?>">
                                    
                                </div>

                            </div>
                            
                           <div class='form-group' >
                               
                               <label for="title" class="col-sm-2 control-label">
                                    LC Deadline<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   
                                     <input disabled id="lc_deadline" class="form-control datepicker"  name="lc_deadline" type="text" value="<?php if(!empty($contact_info[0]['lc_deadline'])) echo date('d-m-Y',strtotime($contact_info[0]['lc_deadline'])); ?>">
                                    
                                </div>
                                
                                
                                <label for="title" class="col-sm-2 control-label">
                                    Shipment Deadline<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   
                                     <input disabled id="shipment_deadline" class="form-control datepicker"  name="shipment_deadline" type="text" value="<?php if(!empty($contact_info[0]['shipment_deadline'])) echo date('d-m-Y',strtotime($contact_info[0]['shipment_deadline'])); ?>">
                                    
                                </div>

                            </div>
                            
                            
                            
                           <div class='form-group' >
                               
                              
                                
                                
                                <label for="title" class="col-sm-2 control-label">
                                   Local Agent<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   
                                     <input readonly id="local_agent" class="form-control "  name="local_agent" type="text" value="<?php if(!empty($contact_info[0]['local_agent'])) echo $contact_info[0]['local_agent']; ?>">
                                    
                                </div>
                               
                                <label for="title" class="col-sm-2 control-label">
                                   Agent Contact<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   
                                     <input readonly id="agent_contact" class="form-control "  name="agent_contact" type="text" value="<?php if(!empty($contact_info[0]['agent_contact'])) echo $contact_info[0]['agent_contact']; ?>">
                                    
                                </div>
                               

                            </div> 
                            
                            
                            
                            <div class='form-group' >
                                
                                
                                <label for="title" class="col-sm-2 control-label">
                                    Shipment Port<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   
                                     <input readonly id="shipment_port" class="form-control"  name="shipment_port" type="text" value="<?php if(!empty($contact_info[0]['shipment_port'])) echo $contact_info[0]['shipment_port']; ?>">
                                    
                                </div>
                                
                               <label for="title" class="col-sm-2 control-label">
                                    Discharge Rate<sup class="required">*</sup>  :
                                </label> 
                                
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>                                   
                                    <input readonly  id="discharge_rate" class="form-control"  name="discharge_rate" type="text" value="<?php if(!empty($contact_info[0]['discharge_rate'])) echo $contact_info[0]['discharge_rate']; ?>">
                                    
                                </div> 
                                
              
                            </div>
                            <div class='form-group' >
                                
                                <label for="title" class="col-sm-2 control-label">
                                   Currency<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   
                                     <select disabled id="currency_id" name="currency_id" class="form-control e1">
                                        <option value="">Select Currency</option>
                                        <?php foreach($currencies as $currency){ ?>
                                            <option <?php if($currency['currencies_id']==$contact_info[0]['currency_id']) echo "selected"; ?> value="<?php echo $currency['currencies_id'];  ?> "><?php echo $currency['title'].'('.$currency['symbol_left'].')';  ?></option>
                                        <?php } ?>    
                                    </select>
                                </div>
                                
                               
                                
                                
                                

                            </div>    
                                
                                
                            
                            <input type="hidden" id="count" value="<?php echo count($contact_details); ?>"/>
                            <table class="table table-bordered" id="myTable">
                                <thead class="thead-color">
                                    <tr>
                                        
                                        <th style="vertical-align: middle;width: 15%;text-align: center;">Item<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Origin</th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Grade</th>
                                     <!--   <th style="vertical-align: middle;width:6%;text-align: center;">Staple Length</th>  -->  
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">MU.</th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Qty<sup style="color:red;"></sup></th>                                        
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Rate<sup style="color:red;"></sup></th>
                                        <th style="vertical-align: middle;width: 10%;text-align: center;">Value<sup style="color:red;"></sup></th>
                                       



                                    </tr>
                                </thead>
                                <tbody id="mytableBody">
                                    <?php $i=0; foreach($contact_details as $c_details){
                                        $i++;
                                        ?>
                                       <tr id="row_1">
                                            <td>
                                              <!--  <input style="width:100%;"  id="lot_1"  type="text"  name="lot_id[]" class="issue  form-control item_code_ajax">-->
                                                <select disabled style="width:100%;" required class="form-control" id="item_id_<?php echo $i; ?>" name="item_id[]" onchange="javascript:itemInfo(<?php echo $i; ?>)">
                                                    <option disabled value="">Select item</option>
                                                    <?php foreach ($items as $item) { ?>
                                                        <option <?php if($c_details['item_id']==$item['id']) echo "selected"; ?> value="<?php echo $item['id']; ?>"><?php if (!empty($item['item_name'])) echo $item['item_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            
                                            <td><input readonly style="width:100%;"  id="origin_<?php echo $i; ?>"  type="text"  name="process[]" class="issue  form-control " value="<?php echo $c_details['origin']; ?>"></td>
                                            <td><input readonly style="width:100%;"  id="grade_<?php echo $i; ?>"  type="text"  name="grade[]"  class="issue  form-control " value="<?php echo $c_details['item_grade']; ?>"></td>
                                        <!--    <td><input readonly style="width:100%;"  id="staple_length_<?php echo $i; ?>"  type="text"  name="composition[]" class="issue  form-control " value="<?php echo $c_details['staple_length']; ?>"></td> -->
                                            <td><input readonly style="width:100%;"  id="mu_<?php echo $i; ?>"  type="text"  name="mu[]"  class="issue  form-control " value="<?php echo $c_details['meas_unit']; ?>"></td>
                                            <td><input readonly style="width:100%;"  id="total_qty_<?php echo $i; ?>"  type="text"  name="qty[]" onchange="calculateLb(<?php echo $i; ?>);" onkeyup="calculateLb(<?php echo $i; ?>);" onblur="calculateLb(<?php echo $i; ?>);" class="issue  form-control " value="<?php echo $c_details['qty']; ?>"></td>
                                            
                                            <td><input readonly style="width:100%;"  id="rate_<?php echo $i; ?>"  type="text"  name="rate[]" onchange="calculateValue(<?php echo $i; ?>);" onkeyup="calculateValue(<?php echo $i; ?>);" onblur="calculateValue(<?php echo $i; ?>);" class="issue  form-control " value="<?php echo $c_details['rate']; ?>"></td>
                                            <td><input readonly style="width:100%;"  id="value_<?php echo $i; ?>"  type="text"  name="value[]" class="issue  form-control " value="<?php echo $c_details['value']; ?>"></td>
                                           
                                       </tr>
                                    <?php } ?>   
                                </tbody>
                                
                            </table>
                            
                            
                
                            <div class="form-group" style="margin-top: 40px;">
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/imports/sales_contact') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
                                </div>
                    
                               
                                
                            </div>
                
                   
<!--                        <div class="row">
                            <div class="col-md-1 col-md-offset-3">
                                <a href="<?php echo site_url('backend/sale_products') ?>" > <button type="button" class="btn btn-success buttonl" style="padding:6px 4px;">REGISTER</button> </a>

                           </div>       
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary button" onclick="javascript:validation();" >SAVE</button>
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
        
        function calculateLb(id){
          var total_qty=Number($('#total_qty_'+id).val()); 
          var total_lbs=total_qty*2.20;
          var net_lbs=total_lbs.toFixed(2);
          $('#lbs_'+id).val(net_lbs);
          
          var rate=Number($('#rate_'+id).val()); 
          var total_value=total_qty*rate;
          var total_value=total_value.toFixed(2);
          $('#value_'+id).val(total_value);
          
        }
        
        function calculateKg(id){
            var total_lbs=Number($('#lbs_'+id).val()); 
            var total_kg=total_lbs/2.20;
            var net_kg=total_kg.toFixed(2);
            $('#total_qty_'+id).val(net_kg);
            
            var rate=Number($('#rate_'+id).val()); 
            var total_value=net_kg*rate;
            var total_value=total_value.toFixed(2);
            $('#value_'+id).val(total_value);
            
           
        }
        
        
        function calculateValue(id){
            var total_qty=Number($('#total_qty_'+id).val()); 
            var rate=Number($('#rate_'+id).val()); 
            var total_value=total_qty*rate;
            var total_value=total_value.toFixed(2);
            $('#value_'+id).val(total_value);
           
        }
        
        
        function itemInfo(id){
            //alert(id);
            var item_id=$('#item_id_'+id).val();
            if(item_id!=''){
                $('#origin_'+id).val('');
                $('#staple_length_'+id).val('');
                $('#grade_'+id).val('');
                $('#mu_'+id).val('');
                
                $.ajax({
                    url: '<?php echo site_url('imports/sales_contact/rm_info'); ?>',
                    data: {'item_id':item_id},
                    method: 'POST',
                    dataType: 'json',
                    success: function (msg) {
                        
                        $('#origin_'+id).val(msg.item_info[0].origin);
                        $('#grade_'+id).val(msg.item_info[0].item_grade);
                        $('#mu_'+id).val(msg.item_info[0].meas_unit);
                        $('#staple_length_'+id).val(msg.item_info[0].staple_length);
                       
                    }

               })
           }else{
                $('#origin_'+id).val('');
                $('#staple_length_'+id).val('');
                $('#grade_'+id).val('');
                $('#mu_'+id).val('');
           }
        }
        
        
        
       $('#button1').click(function () {
            var count =$('#count').val();
            var itemstr =$('#item_id_1').html();
            

            var str ='<tr id="row_'+(Number(count)+1)+'">';
            str +='<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';

            str += '<td>';
            str +='<select style="width:100%;" required class="form-control" id="item_id_'+(Number(count)+1)+'" name="item_id[]" onchange="javascript:itemInfo('+(Number(count)+1)+')">';
            str +=itemstr;
            str +='</select>';
            str +='</td>';
            
            str += '<td>';
            str +='<input  style="width:100%;" class="form-control" style="width:300px;" type="text"  name="origin[]" id="origin_' + (Number(count) + 1) + '" class="issue">';
            str +='</td>';
            
            
            str += '<td>';
            str +='<input required style="width:100%;" class="form-control" style="width:300px;" type="text"  name="grade[]" id="grade_' + (Number(count) + 1) + '"  class="issue">';
            str +='</td>';
            
            str += '<td>';
            str +='<input  style="width:100%;" class="form-control" style="width:300px;" type="text"  name="staple_length[]" id="staple_length_' + (Number(count) + 1) + '" class="issue">';
            str +='</td>';
            
            str += '<td>';
            str +='<input required style="width:100%;" class="form-control" style="width:300px;" type="text"  name="mu[]" id="mu_' + (Number(count) + 1) + '"  class="issue">';
            str +='</td>';
            
            
            str += '<td>';
            str +='<input required style="width:100%;" class="form-control" style="width:300px;" type="text"  name="qty[]" id="total_qty_' + (Number(count) + 1) + '" onchange="calculateValue(' + (Number(count) + 1) + ');" onkeyup="calculateValue(' + (Number(count) + 1) + ');" onblur="calculateValue(' + (Number(count) + 1) + ');" class="issue">';
            str +='</td>';
                        
            str += '<td>';
            str +='<input required style="width:100%;" class="form-control" style="width:300px;" type="text"  name="rate[]" id="rate_' + (Number(count) + 1) + '" onchange="calculateValue(' + (Number(count) + 1) + ');" onkeyup="calculateValue(' + (Number(count) + 1) + ');" onblur="calculateValue(' + (Number(count) + 1) + ');" class="issue">';
            str +='</td>';
            
            
            str += '<td>';
            str +='<input required style="width:100%;" class="form-control" style="width:300px;" type="text"  name="value[]" id="value_' + (Number(count) + 1) + '" class="issue">';
            str +='</td>';
            
            
            str += '</tr>';



            $('#count').val(Number(count) + 1);
            $('#myTable').append(str);
            $('.datepicker1').datepicker({
                // format: 'DD-MM-YYYY'
                dateFormat: 'dd-mm-yy',
                //  maxDate: new Date
            });
    
    
    
            $('select.e1').select2();
            $('.chzn-container').remove();
    }); 
        
        
        
        
    function removeRow(row) {
        $('#row_' + row).remove();
    } 
       
       
       
        
    function validation(){
        var product_name=$('#product_name').val();
        var category_id=$('#category_id').val();
        var measurement_unit=$('#measurement_unit').val();
         
        var error=false;
        
        if(product_name==''){
            $('#product_name').css('border','1px solid red');
            $('#product_name_error').html('Please fill name field');
            error=true;
           
        }else{
            $('#product_name').css('border','1px solid #ccc');
            $('#product_name_error').html('');
            
        }
        if(category_id==''){
            $('#category_id_error').html('Please fill category field');
            $('#category_id').css('border','1px solid red');
            error=true;
        }else{
            $('#category_id_error').html('');
            $('#category_id').css('border','1px solid #ccc');   
            
        }
        
         if(measurement_unit==''){
            $('#measurement_unit_error').html('Please fill measurement unit field');
            $('#measurement_unit').css('border','1px solid red');
            error=true;
        }else{
            $('#measurement_unit_error').html('');
            $('#measurement_unit').css('border','1px solid #ccc');  
             
        }
        
        
        if(error==true){
            return false;
        }
    }
        
        
        
      function yearnInfo(){
                       var fg_id= $('#fg_id').val();
                    //   alert(group_id);
                     if(fg_id!=''){
                        var data = {'fg_id': fg_id}
                         $.ajax({
                             url: '<?php echo site_url('fg_lot/yearnInfo'); ?>',
                             data: data,
                             method: 'POST',
                             dataType: 'json',
                             success: function (msg) {


                                 $('#process').val(msg.yearninfo[0].process_name);
                                 $('#count').val(msg.yearninfo[0].count_name);

                             }

                        })
                      }else{
                            $('#process').val('');
                            $('#count').val('');
                      }
                    }
      
    </script>
                    