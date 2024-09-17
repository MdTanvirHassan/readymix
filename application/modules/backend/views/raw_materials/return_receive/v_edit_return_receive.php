 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <div class="os-tabs-w menu-shad">
                <?php       
                    require_once(__DIR__ .'/../../rm_receive_header.php');
                ?>
            </div>

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Return Receive</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal" action="<?php echo site_url('raw_materials/return_receive/edit_action_return_receive/'.$mrr[0]['mrr_id']); ?>" method="post" onsubmit="javascript: return validation()">
                
                
                
                            <div class="row" style="margin-left:0px;margin-top:5px;">  
                                
                        <div class='form-group' >
                           <label for="title" class="col-sm-2 control-label">
                                Return NO.:
                          </label> 
                          <div class="col-sm-4 input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input readonly class="form-control" id="" name="return_no" type="text" value="<?php if(!empty($mrr[0]['return_no'])) echo $mrr[0]['return_no']; ?>">
                        </div>
                            
                                
                        <label for="title" class="col-sm-2 control-label">
                            Return Date :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input required id="mrr_date" class="form-control datepicker"  name="mrr_date" type="text" value="<?php if(!empty($mrr[0]['mrr_date'])) echo date('d-m-Y',strtotime($mrr[0]['mrr_date'])); ?>">
                        </div>
                             
                         </div>
                        </div> 
                          
                        
                          
                   
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Department<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select required id="dept_id" class="form-control e1" name="dept_id" onchange="javascript:getLcDetails();">
                                        <option class="form-control" value="">Select Department</option>
                                        <?php foreach($departments as $dep){ ?>
                                        <option <?php if($mrr[0]['dept_id']==$dep['id']) echo 'selected'; ?> class="form-control" value="<?php echo $dep['id']; ?>"><?php echo $dep['dept_name']; ?></option>
                                        <?php } ?>    


                                   </select>
                                    <span id="dept_id_error" style="color:red"></span>
                                </div>
                                
                                
                               
                                
                                

                            </div>
                            
                            
                          
                            <div class="row" style="margin-left:0px;margin-top:5px;">        
                        <div class='form-group' >
                             <label for="title" class="col-sm-2 control-label">
                               Memo NO. :
                             </label> 
                              <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input required class="form-control" id="mrr_challan" name="memo_no" type="text" value="<?php if(!empty($mrr[0]['memo_no'])) echo $mrr[0]['memo_no'] ?>">
                              </div>
                             <label for="title" class="col-sm-2 control-label">
                               Memo Date :
                            </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input required type="text"  id="memo_date" class="form-control datepicker"  name="memo_date" value="<?php if(!empty($mrr[0]['memo_date'])) echo date('d-m-Y',strtotime($mrr[0]['memo_date'])); ?>">
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
                                               <input class="form-control" name="mrr_remark" type="text" value="<?php if(!empty($mrr[0]['mrr_remark'])) echo $mrr[0]['mrr_remark'] ?>">
                                    </div>


                               </div>
                   </div>   
                            
                  <input type="hidden" id="count"  value="<?php echo count($receive_items); ?>"  />       
                  <table class="table table-bordered" id="myTable">
                                <thead class="thead-color">
                                    <tr>
                                        <th style="width:5%;padding:4px;">
                                          <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" id="button1" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                                        </th>
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Lot No.</th>
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Code</th>
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Item Name</th>
                                        <th style="vertical-align: middle;text-align: center;">Origin</th>
                                        <th style="vertical-align: middle;text-align: center;">Staple Length</th>
                                        <th style="vertical-align: middle;text-align: center;">M.U.</th>
                                        <th style="vertical-align: middle;text-align: center;">R B. Qty</th>
                                        <th style="vertical-align: middle;text-align: center;">R.W.</th>
                                        <th style="vertical-align: middle;text-align: center;">Rate</th>
                                        <th style="vertical-align: middle;text-align: center;">Value</th>
                                        <th style="vertical-align: middle;text-align: center;">Remark</th>


                                    </tr>
                                </thead>
                                <tbody id="mytableBody">
                                  <?php 
                                  $i=0;
                                  foreach($receive_items as $r_item){ 
                                      $i++;
                                      ?>  
                                    <tr id="row_1" style="">
                                         
                                      <td>
                                          <button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(1)" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button>
                                      </td>

                                      <td>
                                        <!--  <input style="width:100%;"  id="lot_1"  type="text"  name="lot_id[]" class="issue  form-control item_code_ajax">-->
                                          <select style="width:100%;" required class="form-control" id="lot_d_id_<?php echo $i; ?>" name="lot_d_id[]" onchange="javascript:materialInfo(1)">
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
                                            <input style="width:100%;" readonly type="text" id="origin_<?php echo $i; ?>" name="origin" class="issue form-control" value="<?php echo $r_item['origin']; ?>">
                                       </td>
                                        
                                       <td>
                                            <input style="width:100%;" readonly type="text" id="staple_length_<?php echo $i; ?>" name="staple_length" class="issue form-control" value="<?php echo $r_item['staple_length']; ?>">
                                       </td>
                                       
                                       <td>
                                            <input style="width:100%;" readonly type="text" id="mu_id_<?php echo $i; ?>" name="mu[]" class="issue form-control" value="<?php echo $r_item['meas_unit']; ?>">
                                       </td>
                                      
                                       
                                       <td>
                                           <input required style="width:100%;" type="text"  id="accepted_bale_qty_<?php echo $i; ?>" name="accepted_bale_qty[]" class="form-control" value="<?php echo $r_item['accepted_bale_qty']; ?>">
                                       </td>
                                       
                                       <td>
                                           <input required style="width:100%;" type="text"  id="accepted_weight_<?php echo $i; ?>" name="receive_qty[]" onkeyup="calculateAmount(1)" onchange="calculateAmount(1)" onblur="calculateAmount(1)" class="form-control" value="<?php echo $r_item['receive_qty']; ?>">
                                       </td>

                                       <td>
                                           <input required style="width:100%;" type="text"  id="rate_<?php echo $i; ?>" name="unit_price[]" class="form-control" value="<?php echo $r_item['unit_price']; ?>">
                                       </td>
                                       
                                       <td>
                                           <input required style="width:100%;" type="text"  id="amount_<?php echo $i; ?>" name="amount[]" class="form-control" value="<?php echo $r_item['amount']; ?>">
                                       </td>
                                       
                                      <td>
                                           <input  style="width:100%;" type="text"  id="remark_<?php echo $i; ?>" name="remark[]" class="form-control" value="<?php echo $r_item['remark']; ?>">
                                      </td>
                                       
                                    </tr>
                                    
                                 <?php } ?> 
                                    
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>

                            </table>



           
                             
                            

              
                
                <div class="form-group" style="margin-top: 40px;">
                        <div class="col-sm-2">
                            <a href="<?php echo site_url('backend/raw_materials/return_receive') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
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
      
    
    $('#button1').click(function () {
        var count = $('#count').val();
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
        str +='<input style="width:100%;" required  type="text" id="accepted_bale_qty_'+i+'" name="accepted_bale_qty[]" class="issue form-control" value="">';
        str +='</td>';

        str +='<td>';

        str +='<input style="width:100%;" required  type="text" id="accepted_weight_'+i+'" name="receive_qty[]" onkeyup="calculateAmount('+i+')" onchange="calculateAmount('+i+')" onblur="calculateAmount('+i+')" class="issue form-control" value="">';
        str +='</td>';

        str +='<td>';
        str +='<input style="width:100%;" required  type="text" id="rate_'+i+'" name="unit_price[]" class="issue form-control" value="">';

        str +='</td>';

        str +='<td>';

        str +='<input style="width:100%;" required  type="text" id="amount_'+i+'" name="amount[]" class="issue form-control" value="">';

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
                        str +='<input style="width:100%;"  type="hidden" id="lot_id_'+i+'" name="lot_id[]" class="issue form-control" value="'+v.lot_id+'">';
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
                        str +='<input style="width:100%;" required  type="text" id="inv_bale_qty_'+i+'" name="inv_bale_qty[]" class="issue form-control" value="'+v.inv_bale_qty+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" required  type="text"  id="inv_weight_'+i+'" name="inv_weight[]" class="issue form-control" value="'+v.inv_weight+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" required  type="text"  id="landed_weight_'+i+'" name="landed_weight[]" class="issue form-control" value="'+v.landed_weight+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" required  type="text" id="accepted_bale_qty_'+i+'" name="accepted_bale_qty[]" class="issue form-control" value="'+v.accepted_bale_qty+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        
                        str +='<input style="width:100%;" required  type="text" id="accepted_weight_'+i+'" name="accepted_weight[]" onkeyup="calculateAmount('+i+')" onchange="calculateAmount('+i+')" onblur="calculateAmount('+i+')" class="issue form-control" value="'+v.accepted_weight+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" required  type="text" id="rate_'+i+'" name="unit_price[]" class="issue form-control" value="'+v.rate+'">';
                        
                        str +='</td>';
                        
                        str +='<td>';
                        
                        str +='<input style="width:100%;" required  type="text" id="amount_'+i+'" name="amount[]" class="issue form-control" value="'+v.amount+'">';
                        
                        str +='</td>';
                        
                        str +='<td><input  style="width:40px;text-align:right;"  type="checkbox" name="item_select[]"    id="select_product_'+i+'" class="select_product_'+i+'" value="'+i+'"></td>'; 
                        
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
                    