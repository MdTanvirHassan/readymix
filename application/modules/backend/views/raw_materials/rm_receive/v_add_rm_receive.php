 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <div class="os-tabs-w menu-shad">
                <?php       
                    require_once(__DIR__ .'/../../rm_receive_header.php');
                ?>
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
                                       LC<sup class="required">*</sup>  :
                                   </label> 
                                   <div class="col-sm-8 input-group">
                                       <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                       <select required id="lc_id" class="form-control e1" name="lc_id" onchange="javascript:getLcDetails();">
                                           <option class="form-control" value="">Select LC</option>
                                           <?php foreach($lcs as $lc){ ?>
                                               <option class="form-control" value="<?php echo $lc['lc_id']; ?>"><?php echo $lc['mother_vessel_name'].'('.$lc['lc_no'].')'; ?></option>
                                           <?php } ?>    


                                      </select>
                                       <span id="category_id_error" style="color:red"></span>
                                   </div>

                           </div>   
                        </div>    
                
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
                          
                        
                          
                   
                            
                            
                            
                            
                          
                            
                            
                            
                            <div class="row" style="margin-left:0px;margin-top:5px;">   
                                    <div class='form-group' >
                                        
                                    <!--    
                                      <label for="title" class="col-sm-2 control-label">
                                          Mother Vessel Name :
                                       </label> 
                                        <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input  class="form-control" name="mother_vessel_name" type="text">
                                        </div>

                                    -->
                                   
                                    <label for="title" class="col-sm-2 control-label">
                                        Transport Company<sup class="required">*</sup>  :
                                    </label> 

                                    <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <select  id="t_company_id" class="form-control e1" name="t_company_id">
                                             <option class="form-control" value="">Select</option>
                                             <?php foreach ($transport_companies as $company) { ?>
                                                 <option class="form-control" value="<?php echo $company['id'] ?>"><?php echo $company['c_name']; ?></option>
                                             <?php } ?>
                                         </select>
                                         <span id="t_company_id_error" style="color:red"></span>
                                     </div>   
                                   
                                    
                                    
                                    <label for="title" class="col-sm-2 control-label">
                                      Lighter Vessel Name<sup class="required">*</sup> :
                                    </label> 
                                    <div class="col-sm-4 input-group">
                                             <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                             <input required class="form-control" name="lighter_vessel_name" type="text">
                                    </div>


                                   </div>
                       </div>  
                             
                           
                            
                            <div class="row" style="margin-left:0px;margin-top:5px;">   
                                    <div class='form-group' >
                                        
                                        
                                    <!--    
                                      <label for="title" class="col-sm-2 control-label">
                                          Location<sup style="color:red">*</sup> :
                                       </label> 
                                        <div class="col-sm-4 input-group">
                                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                  <select required  id="location" class="form-control" name="location">
                                                      <option value="">Select</option>
                                                      <option value="Yard">Yard</option>
                                                      <option value="Hook">Hook</option>
                                                  </select>
                                        </div>
                                    -->

                                  
                                
                                    
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
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Item Name</th>
                                        <th style="vertical-align: middle;text-align: center;">Origin</th>
                                        <th style="vertical-align: middle;text-align: center;">Grade</th>
                                       
                                        <th style="vertical-align: middle;text-align: center;">MU.</th>
                                      <!--  <th style="vertical-align: middle;text-align: center;">Inv. Qty<sup style="color:red;">*</sup></th>-->
                                        <th style="vertical-align: middle;text-align: center;">R. Qty<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;text-align: center;">Price<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;text-align: center;">Total</th>
                                        <th>Select</th>


                                    </tr>
                                </thead>
                                <tbody id="mytableBody">
                                    
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>

                            </table>



           
                             
                            

              
                
                <div class="form-group" style="margin-top: 40px;">
                        <div class="col-sm-2">
                            <a href="<?php echo site_url('backend/raw_materials/rm_receive') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
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
                   // $('#lc_date').val(msg.lot_info[0].date);
                    var str='';
                   
                    $(msg.lc_details).each(function(i, v) {
                       
                        var amount=v.price*v.qty;
                       
                        i++;
                        str +='<tr>';
                        
                        
                        
                        str +='<td>';
                        str +='<input style="width:100%;"  type="hidden" id="lc_details_id_'+i+'" name="lc_details_id[]" class="issue form-control" value="'+v.id+'">';
                        str +='<input style="width:100%;" readonly type="hidden" id="item_id_'+i+'" name="item_id[]" class="issue form-control" value="'+v.item_id+'">';
                        str +='<input style="width:100%;" readonly type="text" id="item_name_'+i+'" name="item_name[]" class="issue form-control" value="'+v.item_name+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="text" id="origin_'+i+'" name="origin[]" class="issue form-control" value="'+v.origin+'">';
                        str +='</td>';
                        
                        
                        str +='<td>';                
                        str +='<input style="width:100%;" readonly type="text" id="grade_'+i+'" name="grade[]" class="issue form-control" value="'+v.item_grade+'">';
                        str +='</td>';
                        
                        
                        
                        
                        
                        str +='<td>';                
                        str +='<input style="width:100%;" readonly type="text" id="mu_'+i+'" name="mu[]" class="issue form-control" value="'+v.meas_unit+'">';
                        str +='</td>';
                        
//                        str +='<td>';
//                        str +='<input style="width:100%;"  type="text" id="inv_qty_'+i+'" name="inv_qty[]" class="issue form-control" value="'+v.qty+'">';
//                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;"  type="text" onchange="calculateTotal()" onkeyup="calculateTotal()" id="receive_qty_'+i+'" name="receive_qty[]" class="issue form-control" value="'+v.qty+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="text" onchange="calculateTotal()" onkeyup="calculateTotal()" id="price_'+i+'" name="unit_price[]" class="issue form-control" value="'+v.price+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="text" id="amount_'+i+'" name="amount[]" class="issue form-control" value="'+amount+'">';
                        str +='</td>';
                        
                        str +='<td><input style="width:40px;text-align:right;"  type="checkbox" name="item_select[]"    id="select_product_'+v.item_id+'" class="select_product_'+i+'" value="'+i+'"></td>'; 
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
        
        
   function calculateTotal() {
        var total = 0;
        $('#mytableBody').find('tr').each(function(i, v) {
            
            //if(i>0){
            var qty = Number($(this).find('td').eq('4').find('input').val());
           // alert(qty);
            var price = Number($(this).find('td').eq('5').find('input').val());
            
            var tot = qty * price;
            $(this).find('td').eq('6').find('input').val(tot.toFixed(2));
            total += tot;
           // }
        })
        
       // $('#amount').val(total.toFixed(2))
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
                    