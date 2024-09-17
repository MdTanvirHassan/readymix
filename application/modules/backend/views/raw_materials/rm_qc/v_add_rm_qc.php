 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
               
                <?php //$this->role = checkUserPermission(7, 21, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'rm_receive') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/rm_receive'); ?>">
                        <span>RM Receive</span></a>
                </li>
                <?php //} ?>
               
                
               <?php //$this->role = checkUserPermission(7, 21, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'rm_qc') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/rm_qc'); ?>">
                        <span>RM QC</span></a>
                </li>
                <?php //} ?>
                
                

            </ul>
        </div>
    </div>

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add MRR</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal" action="<?php echo site_url('raw_materials/rm_receive/add_action_rm_receive'); ?>" method="post" onsubmit="javascript: return validation()">
                
                
                
                            <div class="row" style="margin-left:0px;margin-top:5px;">   
                            <div class='form-group' >
                               <label for="title" class="col-sm-2 control-label">
                                    MRR NO.:
                              </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input class="form-control" id="" name="mrr_code" type="hidden" value="<?php if(!empty($mrr_code)) echo $mrr_code; ?>">
                                <input class="form-control" id="" name="mrr_no" type="hidden" value="<?php if(!empty($mrr_auto_code)) echo $branch_info[0]['short_name']."/MRR".$mrr_auto_code; ?>">
                                <input class="form-control" id="" name="qc_no" type="hidden" value="<?php if(!empty($mrr_auto_code)) echo $branch_info[0]['short_name']."/QC".$mrr_auto_code; ?>">
                                <input disabled class="form-control" id="" name="mrr_no1" type="text" value="<?php if(!empty($mrr_auto_code)) echo $branch_info[0]['short_name']."/MRR".$mrr_auto_code; ?>">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            MRR Date :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input required id="mrr_date" class="form-control datepicker"  name="mrr_date" type="text" value="<?php echo date('d-m-Y'); ?>">
                        </div>
                             
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
                            
                            
                          
                            <div class="row" style="margin-left:0px;margin-top:5px;">        
                        <div class='form-group' >
                             <label for="title" class="col-sm-2 control-label">
                                Inv/Challan NO. :
                             </label> 
                              <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input class="form-control" id="mrr_challan" name="mrr_challan" type="text">
                              </div>
                             <label for="title" class="col-sm-2 control-label">
                                Date :
                            </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input required id="mrr_challan_date" class="form-control datepicker"  name="mrr_challan_date" type="text">
                        </div>
                             
                         </div>
                     </div>   
                            
                            
                            
                             
                           
                            
                            <div class="row" style="margin-left:0px;margin-top:5px;">           
                                <div class='form-group' >
                                  <label for="title" class="col-sm-2 control-label">
                                      Remarks :
                                   </label> 
                                    <div class="col-sm-4 input-group">
                                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                               <input class="form-control" name="mrr_remark" type="text">
                                    </div>


                               </div>
                   </div>   
                            
                            
                  <table class="table table-bordered" id="myTable">
                                <thead class="thead-color">
                                    <tr>
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Lot No.</th>
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Code</th>
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Item Name</th>
                                        <th style="vertical-align: middle;text-align: center;">Origin</th>
                                        <th style="vertical-align: middle;text-align: center;">Staple Length</th>
                                        <th style="vertical-align: middle;text-align: center;">Inv.B. Qty<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;text-align: center;">Inv. W.<sup style="color:red;">*</sup></th>

                                        <th style="vertical-align: middle;text-align: center;">L.W.<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;text-align: center;">R B. Qty</th>
                                        <th style="vertical-align: middle;text-align: center;">R.W.</th>
                                        <th style="vertical-align: middle;text-align: center;">Rate</th>
                                        <th style="vertical-align: middle;text-align: center;">Value</th>
                                        <th></th>


                                    </tr>
                                </thead>
                                <tbody id="mytableBody">
                                    <tr id="row_1" style="">
                                         
                                       <td>
                                            <input style="width:100%;" readonly type="text" id="lot_no_1" name="lot_no" class="issue form-control">
                                       </td> 
                                        
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

                                       <td>
                                           <input required style="width:100%;" type="text"  id="rate_1" name="rate[]" class="form-control">
                                       </td>
                                       
                                       <td>
                                           <input required style="width:100%;" type="text"  id="value_1" name="amount[]" class="form-control">
                                       </td>
                                       
                                       <td>
                                           <input required style="width:100%;" type="checkbox"  id="select_item_1" name="select_item[]" class="form-control">
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
                url: '<?php echo site_url('raw_materials/rm_receive/getLcLotDetails'); ?>',
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
                        str +='<input style="width:100%;"  type="hidden" id="lot_d_id_'+i+'" name="lot_d_id[]" class="issue form-control" value="'+v.id+'">';
                        str +='<input style="width:100%;" readonly type="text" id="lot_no_'+i+'" name="lot_no[]" class="issue form-control" value="'+v.lot_number+'">';
                        str +='</td>';
                        
                        str +='<td>';                        
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
                        str +='<input style="width:100%;"  type="text" id="inv_bale_qty_'+i+'" name="inv_bale_qty[]" class="issue form-control" value="'+v.inv_bale_qty+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;"  type="text"  id="inv_weight_'+i+'" name="inv_weight[]" class="issue form-control" value="'+v.inv_weight+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;"  type="text"  id="landed_weight_'+i+'" name="landed_weight[]" class="issue form-control" value="'+v.landed_weight+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;"  type="text" id="accepted_bale_qty_'+i+'" name="accepted_bale_qty[]" class="issue form-control" value="'+v.accepted_bale_qty+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        
                        str +='<input style="width:100%;"  type="text" id="accepted_weight_'+i+'" name="accepted_weight[]" onkeyup="calculateAmount('+i+')" onchange="calculateAmount('+i+')" onblur="calculateAmount('+i+')" class="issue form-control" value="'+v.accepted_weight+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;"  type="text" id="rate_'+i+'" name="unit_price[]" class="issue form-control" value="'+v.rate+'">';
                        
                        str +='</td>';
                        
                        str +='<td>';
                        
                        str +='<input style="width:100%;"  type="text" id="amount_'+i+'" name="amount[]" class="issue form-control" value="'+v.amount+'">';
                        
                        str +='</td>';
                        
                        str +='<td><input style="width:40px;text-align:right;"  type="checkbox" name="item_select[]"    id="select_product_'+i+'" class="select_product_'+i+'" value="'+i+'"></td>'; 
                        
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
                    