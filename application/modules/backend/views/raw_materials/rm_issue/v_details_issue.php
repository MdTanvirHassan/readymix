 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <div class="os-tabs-w menu-shad">
                <?php       
                    require_once(__DIR__ .'/../../rm_issue_header.php');
                ?>
            </div>

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Details Issue</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal" action="<?php echo site_url('raw_materials/rm_issue/edit_rm_issue/'.$issue_info[0]['id']); ?>" method="post" onsubmit="javascript: return validation()">
                
                
                
                            <div class="row" style="margin-left:0px;margin-top:5px;">  
                                
                        <div class='form-group' >
                           <label for="title" class="col-sm-2 control-label">
                                Issue NO.:
                          </label> 
                          <div class="col-sm-4 input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input readonly class="form-control" id="" name="issue_no" type="text" value="<?php if(!empty($issue_info[0]['issue_no'])) echo $issue_info[0]['issue_no']; ?>">
                        </div>
                            
                                
                        <label for="title" class="col-sm-2 control-label">
                            Issue Date :
                        </label>
                             <div class="col-sm-4 input-group">
                                <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                <input readonly id="issue_date" class="form-control datepicker"  name="issue_date" type="text" value="<?php if(!empty($issue_info[0]['issue_date'])) echo date('d-m-Y',strtotime($issue_info[0]['issue_date'])); ?>">
                        </div>
                             
                         </div>
                        </div> 
                          
                        
                          
                   
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Department<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select disabled id="dept_id" class="form-control e1" name="dept_id" onchange="javascript:getLcDetails();">
                                        <option class="form-control" value="">Select Department</option>
                                        <?php foreach($departments as $dep){ ?>
                                            <option <?php if($issue_info[0]['dept_id']==$dep['id']) echo "selected"; ?> class="form-control" value="<?php echo $dep['id']; ?>"><?php echo $dep['dept_name']; ?></option>
                                        <?php } ?>    


                                   </select>
                                    <span id="category_id_error" style="color:red"></span>
                                </div>
                                
                                
                               
                                
                                

                            </div>
                            
                            
                          
                            <div class="row" style="margin-left:0px;margin-top:5px;">        
                        <div class='form-group' >
                             <label for="title" class="col-sm-2 control-label">
                               SR. NO. :
                             </label> 
                              <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input readonly class="form-control" id="sr_no" name="sr_no" type="text" value="<?php if(!empty($issue_info[0]['sr_no'])) echo $issue_info[0]['sr_no']; ?>">
                              </div>
                             <label for="title" class="col-sm-2 control-label">
                               SR. Date :
                            </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input readonly type="text"  id="sr_date" class="form-control datepicker"  name="sr_date" value="<?php if(!empty($issue_info[0]['sr_date'])) echo date('d-m-Y',strtotime($issue_info[0]['sr_date'])); ?>">
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
                                              <input readonly class="form-control" name="issue_remark" type="text" value="<?php if(!empty($issue_info[0]['issue_remark'])) echo $issue_info[0]['issue_remark']; ?>">
                                    </div>


                               </div>
                   </div>   
                            
                       <input type="hidden" id="count"  value="<?php echo count($issue_details); ?>"  />   
                  <table class="table table-bordered" id="myTable">
                                <thead class="thead-color">
                                    <tr>
                                        
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Lot No.</th>
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Code</th>
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Item Name</th>
                                        <th style="vertical-align: middle;text-align: center;">Origin</th>
                                        <th style="vertical-align: middle;text-align: center;">Staple Length</th>
                                        <th style="vertical-align: middle;text-align: center;">M.U.</th>
                                        <th style="vertical-align: middle;text-align: center;">Stock Qty</th>
                                        <th style="vertical-align: middle;text-align: center;">B.Qty</th>
                                        <th style="vertical-align: middle;text-align: center;">Issue Qty</th>
                                        
                                        <th style="vertical-align: middle;text-align: center;">Remark</th>


                                    </tr>
                                </thead>
                                <tbody id="mytableBody">
                                    
                                    <?php 
                                    $i=0;
                                    foreach($issue_details as $r_item){ 
                                        $i++;
                                        ?>  
                                    <tr id="row_1" style="">
                                         
                                     

                                      <td>
                                        <!--  <input style="width:100%;"  id="lot_1"  type="text"  name="lot_id[]" class="issue  form-control item_code_ajax">-->
                                          <select disabled style="width:100%;" required class="form-control" id="lot_d_id_<?php echo $i; ?>" name="lot_d_id[]" onchange="javascript:materialInfo(1)">
                                              <option value="">Select Lot</option>
                                              <?php foreach ($lots as $lot) { ?>
                                                  <option <?php if($r_item['lot_d_id']==$lot['id']) echo "selected"; ?> value="<?php echo $lot['id']; ?>"><?php if (!empty($lot['lot_number'])) echo $lot['lot_number']; ?></option>
                                              <?php } ?>
                                          </select>
                                     </td>
                                        
                                        
                                       
                                        
                                       <td>
                                           <input style="width:100%;"  type="hidden" id="lot_id_<?php echo $i; ?>" name="lot_id[]" class="issue form-control" value="<?php echo $r_item['lot_id']; ?>">
                                            <input style="width:100%;" readonly type="text" id="code_<?php echo $i; ?>" name="code" class="issue form-control" value="<?php echo $r_item['item_code']; ?>">
                                       </td>
                                        
                                       <td>
                                           <input style="width:100%;" readonly type="hidden" id="item_id_<?php echo $i; ?>" name="item_id[]" class="issue form-control" value="<?php echo $r_item['item_id']; ?>">
                                            <input style="width:100%;" readonly type="text" id="item_name_<?php echo $i; ?>" name="item_name" class="issue form-control" value="<?php echo $r_item['item_name']; ?>">
                                       </td>
                                       
                                       <td>
                                            <input readonly style="width:100%;" readonly type="text" id="origin_<?php echo $i; ?>" name="origin" class="issue form-control" value="<?php echo $r_item['origin']; ?>">
                                       </td>
                                        
                                       <td>
                                            <input readonly style="width:100%;" readonly type="text" id="staple_length_<?php echo $i; ?>" name="staple_length" class="issue form-control" value="<?php echo $r_item['staple_length']; ?>">
                                       </td>
                                       
                                       <td>
                                            <input readonly style="width:100%;" readonly type="text" id="mu_id_<?php echo $i; ?>" name="mu[]" class="issue form-control" value="<?php echo $r_item['meas_unit']; ?>">
                                       </td>
                                      
                                       
                                       <td>
                                           
                                           <input readonly style="width:100%;" type="text"  id="stock_qty_<?php echo $i; ?>" name="stock_qty[]" class="form-control" value="<?php echo $r_item['stock_qty']; ?>">
                                       </td>
                                       
                                                      
                                       <td>
                                           <input readonly style="width:100%;" type="text"  id="accepted_bale_qty_<?php echo $i; ?>" name="bale_qty[]" class="form-control" value="<?php echo $r_item['bale_qty']; ?>">
                                       </td>
                                       
                                       <td>
                                           <input readonly style="width:100%;" type="text"  id="accepted_weight_<?php echo $i; ?>" name="issue_qty[]" onkeyup="calculateAmount(1)" onchange="calculateAmount(1)" onblur="calculateAmount(1)" class="form-control" value="<?php echo $r_item['issue_qty']; ?>">
                                           <input readonly style="width:100%;" type="hidden"  id="rate_<?php echo $i; ?>" name="rate[]" class="form-control" value="<?php echo $r_item['rate']; ?>">
                                           <input readonly style="width:100%;" type="hidden"  id="amount_<?php echo $i; ?>" name="amount[]" class="form-control" value="<?php echo $r_item['amount']; ?>">
                                       </td>

                                      
                                       
                                      
                                       
                                      <td>
                                           <input readonly  style="width:100%;" type="text"  id="remark_<?php echo $i; ?>" name="remarks[]" class="form-control" value="<?php echo $r_item['remarks']; ?>">
                                      </td>
                                       
                                    </tr>
                                    
                                 <?php } ?> 
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>

                            </table>



           
                             
                            

              
                
                <div class="form-group" style="margin-top: 40px;">
                        <div class="col-sm-2">
                            <a href="<?php echo site_url('backend/raw_materials/rm_issue') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
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
      
    
    $('#button1').click(function () {
        var count = $('#count').val();
        alert(count)
        var lots = $('#lot_d_id_1').html();
        
        
        var i=(Number(count) + 1); 

        var str = '<tr id="row_'+i+'">';
        str += '<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
        
                
        str += '<td>';
        str +='<select style="width:100%;" required class="form-control" id="lot_d_id_'+i+'" name="lot_d_id[]" onchange="javascript:materialInfo('+(Number(count)+1)+')">';
        str +=lots;
        str +='</select>';
        str +='</td>';
    
    
        str +='<td>';
        str +='<input style="width:100%;"  type="hidden" id="lot_id_'+i+'" name="lot_id[]" class="issue form-control" value="">';
        str +='<input style="width:100%;" readonly type="text" id="code_'+i+'" name="code[]" class="issue form-control" value="">';
        str +='</td>';

        str +='<td>';
        str +='<input style="width:100%;"  type="hidden" id="item_id_'+i+'" name="item_id[]" class="issue form-control" value="">';
        str +='<input style="width:100%;" readonly type="text" id="item_name_'+i+'" name="item_name[]" class="issue form-control" value="">';
        str +='</td>';

        str +='<td>';
        str +='<input style="width:100%;" readonly type="text" id="origin_'+i+'" name="origin[]" class="issue form-control" value="">';
        str +='</td>';

        str +='<td>';
        str +='<input style="width:100%;" readonly type="text" id="staple_length_'+i+'" name="staple_length[]" class="issue form-control" value="">';
        str +='</td>';
        
        str +='<td>';
        str +='<input style="width:100%;" readonly type="text" id="mu_id_'+i+'" name="mu[]" class="issue form-control" value="">';
        str +='</td>';

        str +='<td>';
        str +='<input style="width:100%;" required  type="text" id="accepted_bale_qty_'+i+'" name="bale_qty[]" class="issue form-control" value="">';
        str +='</td>';

        str +='<td>';

        str +='<input style="width:100%;" required  type="text" id="accepted_weight_'+i+'" name="issue_qty[]" onkeyup="calculateAmount('+i+')" onchange="calculateAmount('+i+')" onblur="calculateAmount('+i+')" class="issue form-control" value="">';
        str +='<input style="width:100%;"   type="hidden" id="rate_'+i+'" name="rate[]" class="issue form-control" value="">';
        str +='<input style="width:100%;"   type="hidden" id="amount_'+i+'" name="amount[]" class="issue form-control" value="">';
        str +='</td>';
        
        str +='<td>';

        str +='<input style="width:100%;"   type="text" id="remark_'+i+'" name="remark[]" class="issue form-control" value="">';

        str +='</td>';

        
        str +='</tr>';



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
        
        
        
      function materialInfo(id){
                     var lot_d_id= $('#lot_d_id_'+id).val();
                    //   alert(group_id);
                     if(lot_d_id!=''){
                        var data = {'lot_d_id': lot_d_id}
                        
                        $('#lot_id_'+id).val('');
                        $('#code_'+id).val('');
                        $('#item_id_'+id).val('');
                        $('#item_name_'+id).val('');
                        $('#origin_'+id).val('');
                        $('#staple_length_'+id).val('');
                        $('#mu_id_'+id).val('');
                        $('#rate_'+id).val('');
                        
                         $.ajax({
                             url: '<?php echo site_url('raw_materials/return_receive/materialInfo'); ?>',
                             data: data,
                             method: 'POST',
                             dataType: 'json',
                             success: function (msg) {
                                 $('#lot_id_'+id).val(msg.materialinfo[0].lot_id);
                                 $('#code_'+id).val(msg.materialinfo[0].item_code);
                                 $('#item_id_'+id).val(msg.materialinfo[0].item_id);
                                 $('#item_name_'+id).val(msg.materialinfo[0].item_name);
                                 $('#origin_'+id).val(msg.materialinfo[0].origin);
                                 $('#staple_length_'+id).val(msg.materialinfo[0].staple_lenght);
                                 $('#mu_id_'+id).val(msg.materialinfo[0].meas_unit);
                                 $('#rate_'+id).val(msg.materialinfo[0].rate);

                             }

                        })
                      }else{
                            $('#lot_id_'+id).val('');
                            $('#code_'+id).val('');
                            $('#item_id_'+id).val('');
                            $('#item_name_'+id).val('');
                            $('#origin_'+id).val('');
                            $('#staple_length_'+id).val('');  
                            $('#mu_id_'+id).val('');
                            $('#rate_'+id).val('');
                            
                      }
                    }
      
    </script>
                    