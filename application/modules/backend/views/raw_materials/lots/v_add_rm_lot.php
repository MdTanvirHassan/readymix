 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
       <?php       
            require_once(__DIR__ .'/../../rm_setup_header.php');
        ?>
    </div>

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Lot</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal" action="<?php echo site_url('raw_materials/rm_lot/add_rm_lot_action'); ?>" method="post" onsubmit="javascript: return validation()">
                
                
                
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Lot Number<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   
                                     <input required id="item_code" class="form-control"  name="lot_number" type="text" value="">
                                    
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Lot Type<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select required id="category_id" class="form-control e1" name="lot_type_id" >
                                    <option class="form-control" value="">Select Lot Type</option>
                                    <?php foreach($lottypes as $lottype){ ?>
                                        <option class="form-control" value="<?php echo $lottype['id']; ?>"><?php echo $lottype['lot_type']; ?></option>
                                    <?php } ?>    
                                    
                                    
                               </select>
                                    <span id="category_id_error" style="color:red"></span>
                                </div>

                            </div>
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    LC<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select required id="lc_id" class="form-control e1" name="lc_id" onchange="javascript:getLcDetails();">
                                        <option class="form-control" value="">Select LC</option>
                                        <?php foreach($lcs as $lc){ ?>
                                            <option class="form-control" value="<?php echo $lc['lc_id']; ?>"><?php echo $lc['SUP_NAME'].'('.$lc['lc_no'].')'; ?></option>
                                        <?php } ?>    


                                   </select>
                                    <span id="category_id_error" style="color:red"></span>
                                </div>
                                
                                
                               <label for="title" class="col-sm-2 control-label">
                                    LC Date<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   
                                     <input readonly id="lc_date" class="form-control date-picker"  name="lc_date" type="text" value="">
                                    
                                </div> 
                                
                                
                                

                            </div>
                            
                            
                          
                            
                            
                             <div class='form-group' >
                               
                                
                                
                               <label for="title" class="col-sm-2 control-label">
                                    Invoice No.<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   
                                     <input required  id="inv_no" class="form-control"  name="inv_no" type="text" value="">
                                    
                                </div> 
                                
                                
                                

                            </div>
                           
                            
                            
                  <table class="table table-bordered" id="myTable">
                                <thead class="thead-color">
                                    <tr>
                                       
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Code</th>
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Item Name</th>
                                        <th style="vertical-align: middle;text-align: center;">Origin</th>
                                        <th style="vertical-align: middle;text-align: center;">Staple Length</th>
                                        <th style="vertical-align: middle;text-align: center;">Inv.B. Qty<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;text-align: center;">Inv. W.<sup style="color:red;">*</sup></th>

                                        <th style="vertical-align: middle;text-align: center;">L.W.<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;text-align: center;">A. B. Qty<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;text-align: center;">A.W.<sup style="color:red;">*</sup></th>




                                    </tr>
                                </thead>
                                <tbody id="mytableBody">
                                    <tr id="row_1" style="">
                                          
                                       <td>
                                            <input style="width:100%;" readonly type="text" id="code_1" name="code" class="issue form-control">
                                       </td>
                                        
                                       <td>
                                            <input style="width:100%;" readonly type="text" id="item_name_1" name="item_name" class="issue form-control">
                                       </td>
                                       
                                       <td>
                                            <input style="width:100%;" readonly type="text" id="origin_1" name="origin" class="issue form-control">
                                       </td>
                                        
                                       <td>
                                            <input style="width:100%;" readonly type="text" id="staple_length_1" name="staple_length" class="issue form-control">
                                       </td>
                                       
                                       
                                       <td>
                                            <input required style="width:100%;"  type="text" id="inv_bale_qty_1" name="inv_bale_qty[]" class="issue form-control">
                                       </td>
                                       
                                       <td>
                                            <input required style="width:100%;" type="text"  id="inv_weight_1" name="inv_weight[]" class="issue form-control">
                                       </td>
                                       
                                       <td>
                                           <input required style="width:100%;" type="text"  id="landed_weight_" name="landed_weight[]" class="form-control">
                                       </td>
                                       
                                       <td>
                                           <input required style="width:100%;" type="text"  id="accepted_bale_qty_1" name="accepted_bale_qty[]" class="form-control">
                                       </td>
                                       
                                       <td>
                                           <input required style="width:100%;" type="text"  id="accepted_weight_1" name="accepted_weight[]" class="form-control">
                                       </td>

                                        
                                    </tr>
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>

                            </table>



           
                             
                            

              
                
                <div class="form-group" style="margin-top: 40px;">
                        <div class="col-sm-2">
                            <a href="<?php echo site_url('backend/raw_materials/rm_lot') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
                        </div>

                        <div class=" col-sm-2">
                            <button type="submit" class="btn btn-primary button" onclick="javascript:validation();" >SAVE</button>
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
      function getLcDetails() {
        var lc_id=$('#lc_id').val();
        if(lc_id != ''){
            $.ajax({
                url: '<?php echo site_url('raw_materials/rm_lot/getLcDetails'); ?>',
                data: {
                    'lc_id': lc_id
                },
                method: 'POST',
                dataType: 'json',
                success: function(msg) {
                    $('#lc_date').val(msg.lot_info[0].date);
                    var str='';
                   
                    $(msg.lc_details).each(function(i, v) {
                       
                        i++;
                        str +='<tr>';
                        str +='<td>';
                        str +='<input style="width:100%;"  type="hidden" id="sc_d_id_'+i+'" name="sc_d_id[]" class="issue form-control" value="'+v.id+'">';
                        str +='<input style="width:100%;" readonly type="text" id="code_'+i+'" name="code[]" class="issue form-control" value="'+v.item_code+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="hidden" id="item_id_'+i+'" name="item_id[]" class="issue form-control" value="'+v.item_id+'">';
                        str +='<input style="width:100%;" readonly type="text" id="item_name_'+i+'" name="item_name[]" class="issue form-control" value="'+v.item_name+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="text" id="origin_'+i+'" name="origin[]" class="issue form-control" value="'+v.origin+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="text" id="staple_length_'+i+'" name="staple_length[]" class="issue form-control" value="'+v.staple_lenth+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input required style="width:100%;"  type="text" id="inv_bale_qty_'+i+'" name="inv_bale_qty[]" class="issue form-control" value="">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input required style="width:100%;"  type="text"  id="inv_weight_'+i+'" name="inv_weight[]" class="issue form-control" value="">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input required style="width:100%;"  type="text"  id="landed_weight_'+i+'" name="landed_weight[]" class="issue form-control" value="">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input required style="width:100%;"  type="text" id="accepted_bale_qty_'+i+'" name="accepted_bale_qty[]" class="issue form-control" value="">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;"  type="hidden" id="rate_'+i+'" name="rate[]" class="issue form-control" value="'+v.price+'">';
                        str +='<input style="width:100%;"  type="hidden" id="amount_'+i+'" name="amount[]" class="issue form-control" value="">';
                        str +='<input required style="width:100%;"  type="text" id="accepted_weight_'+i+'" name="accepted_weight[]" onkeyup="calculateAmount('+i+')" onchange="calculateAmount('+i+')" onblur="calculateAmount('+i+')" class="issue form-control" value="">';
                        str +='</td>';
                        
                        str +='</tr>';
                       
                      //  calculateTotal();
                        
                    })
                    
                    $('#mytableBody').html(str);
                    
                }
            })
        } else {
            $('#mytableBody').html('');
            $('#lc_date').val('');
        }
    }  
        
        
    function calculateAmount(id) {
        var rate=Number($("#rate_"+id).val());
        var a_weigth=Number($("#accepted_weight_"+id).val());
        var amount=rate*a_weigth;
        
        $("#amount_"+id).val(amount);
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
            $('#category_id_error').html('Please select lot type field');
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
                             url: '<?php echo site_url('rm_lot/yearnInfo'); ?>',
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
                    