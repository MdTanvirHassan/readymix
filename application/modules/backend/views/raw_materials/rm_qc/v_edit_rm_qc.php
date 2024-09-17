 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <div class="os-tabs-w menu-shad">
                 <?php       
                    require_once(__DIR__ .'/../../rm_receive_header.php');
                 ?>
            </div>

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit MRR</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal" action="<?php echo site_url('raw_materials/rm_qc/edit_action_rm_qc/'.$mrr[0]['mrr_id']); ?>" method="post" onsubmit="javascript: return validation()">
                
                
                
                            <div class="row" style="margin-left:0px;margin-top:5px;">   
                            <div class='form-group' >
                               <label for="title" class="col-sm-2 control-label">
                                    MRR NO.:
                              </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                 
                                  <input disabled class="form-control" id="" name="mrr_no1" type="text" value="<?php echo $mrr[0]['mrr_no']; ?>">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            MRR Date :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                 <input readonly id="mrr_date" class="form-control datepicker"  name="mrr_date" type="text" value="<?php if(!empty($mrr[0]['mrr_date'])) echo date('d-m-Y',strtotime($mrr[0]['mrr_date'])); ?>">
                        </div>
                             
                         </div>
                        </div> 
                          
                        
                          
                   
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    LC<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select disabled id="lc_id" class="form-control e1" name="lc_id" onchange="javascript:getLcDetails();">
                                        <option class="form-control" value="">Select LC</option>
                                        <?php foreach($lcs as $lc){ ?>
                                            <option <?php if($mrr[0]['lc_id']==$lc['lc_id']) echo "selected"; ?> class="form-control" value="<?php echo $lc['lc_id']; ?>"><?php echo $lc['SUP_NAME'].'('.$lc['lc_no'].')'; ?></option>
                                        <?php } ?>    


                                   </select>
                                    <span id="category_id_error" style="color:red"></span>
                                </div>
                                
                                
                               <label for="title" class="col-sm-2 control-label">
                                    LC Date<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   
                                     <input readonly id="lc_date" class="form-control date-picker"  name="lc_date" type="text" value="<?php if(!empty($mrr[0]['date'])) echo date('d-m-Y',strtotime($mrr[0]['date'])); ?>">
                                    
                                </div> 
                                
                                
                                

                            </div>
                            
                            
                          
                            <div class="row" style="margin-left:0px;margin-top:5px;">        
                        <div class='form-group' >
                             <label for="title" class="col-sm-2 control-label">
                                Inv/Challan NO. :
                             </label> 
                              <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input readonly class="form-control" id="mrr_challan" name="mrr_challan" type="text" value="<?php if(!empty($mrr[0]['mrr_challan'])) echo $mrr[0]['mrr_challan']; ?>">
                              </div>
                             <label for="title" class="col-sm-2 control-label">
                                Date :
                            </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input readonly id="mrr_challan_date" class="form-control datepicker"  name="mrr_challan_date" type="text" value="<?php if(!empty($mrr[0]['mrr_challan_date'])) echo date('d-m-Y',strtotime($mrr[0]['mrr_challan_date'])); ?>">
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
                                        <input readonly class="form-control" name="mrr_remark" type="text" value="<?php if(!empty($mrr[0]['mrr_remark'])) echo $mrr[0]['mrr_remark']; ?>">
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
                                        


                                    </tr>
                                </thead>
                                <tbody id="mytableBody">
                                 <?php 
                                 $i=0;
                                 foreach($receive_items as $receive){ 
                                     $i++;
                                     ?>   
                                    <tr id="row_" style="">
                                         
                                       <td>
                                           <input style="width:100%;"  type="hidden" id="lot_id_<?php echo $i; ?>" name="lot_id[]" class="issue form-control" value="<?php echo $receive['lot_id']; ?>">
                                           <input style="width:100%;"  type="hidden" id="lot_d_id_<?php echo $i; ?>" name="lot_d_id[]" class="issue form-control" value="<?php echo $receive['lot_d_id']; ?>">
                                           <input style="width:100%;" readonly type="text" id="lot_no_1" name="lot_no" class="issue form-control" value="<?php echo $receive['lot_number']; ?>">
                                       </td> 
                                        
                                       <td>
                                           <input style="width:100%;"  type="hidden" id="item_id_<?php echo $i; ?>" name="item_id[]" class="issue form-control" value="<?php echo $receive['item_id']; ?>">
                                            <input style="width:100%;" readonly type="text" id="code_<?php echo $i; ?>" name="code" class="issue form-control" value="<?php echo $receive['item_code']; ?>">
                                       </td>
                                        
                                       <td>
                                            <input style="width:100%;" readonly type="text" id="item_name_<?php echo $i; ?>" name="item_name" class="issue form-control" value="<?php echo $receive['item_name']; ?>">
                                       </td>
                                       
                                       <td>
                                            <input style="width:100%;" readonly type="text" id="origin_<?php echo $i; ?>" name="origin" class="issue form-control" value="<?php echo $receive['origin']; ?>">
                                       </td>
                                        
                                       <td>
                                            <input style="width:100%;" readonly type="text" id="staple_length_<?php echo $i; ?>" name="staple_length" class="issue form-control" value="<?php echo $receive['staple_length']; ?>">
                                       </td>
                                       
                                       
                                       <td>
                                            <input readonly style="width:100%;"  type="text" id="inv_bale_qty_<?php echo $i; ?>" name="inv_bale_qty[]" class="issue form-control" value="<?php echo $receive['inv_bale_qty']; ?>">
                                       </td>
                                       
                                       <td>
                                            <input readonly style="width:100%;" type="text"  id="inv_weight_<?php echo $i; ?>" name="inv_weight[]" class="issue form-control" value="<?php echo $receive['inv_weight']; ?>">
                                       </td>
                                       
                                       <td>
                                           <input readonly style="width:100%;" type="text"  id="landed_weight_<?php echo $i; ?>" name="landed_weight[]" class="form-control" value="<?php echo $receive['landed_weight']; ?>">
                                       </td>
                                       
                                       <td>
                                           <input required style="width:100%;" type="text"  id="accepted_bale_qty_<?php echo $i; ?>" name="accepted_bale_qty[]" class="form-control" value="<?php echo $receive['accepted_bale_qty']; ?>">
                                       </td>
                                       
                                       <td>
                                           <input required style="width:100%;" type="text"  id="accepted_weight_<?php echo $i; ?>" name="accepted_weight[]" class="form-control" onkeyup="calculateAmount(<?php echo $i; ?>)" onchange="calculateAmount(<?php echo $i; ?>)" onblur="calculateAmount(<?php echo $i; ?>)" value="<?php echo $receive['receive_qty']; ?>">
                                       </td>

                                       <td>
                                           <input readonly style="width:100%;" type="text"  id="rate_<?php echo $i; ?>" name="unit_price[]" class="form-control" value="<?php echo $receive['unit_price']; ?>">
                                       </td>
                                       
                                       <td>
                                           <input readonly style="width:100%;" type="text"  id="amount_<?php echo $i; ?>" name="amount[]" class="form-control" value="<?php echo $receive['amount']; ?>">
                                       </td>
                                       
                                       
                                       
                                    </tr>
                                <?php } ?>       
                                    
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>

                            </table>



           
                             
                            

              
                
                <div class="form-group" style="margin-top: 40px;">
                        <div class="col-sm-2">
                            <a href="<?php echo site_url('backend/raw_materials/rm_qc') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
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
    //alert(id);
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
                    