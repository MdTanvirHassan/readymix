 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <div class="os-tabs-w menu-shad">
                <?php       
                    require_once(__DIR__ .'/../../rm_wastage_header.php');
                ?>
            </div>

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Receive</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal" action="<?php echo site_url('raw_materials/rm_wastage/add_rm_wastage'); ?>" method="post" onsubmit="javascript: return validation()">
                
                
                
                            <div class="row" style="margin-left:0px;margin-top:5px;">  
                                
                        <div class='form-group' >
                           <label for="title" class="col-sm-2 control-label">
                                Receive NO.:
                          </label> 
                          <div class="col-sm-4 input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input readonly class="form-control" id="" name="receive_no" type="text" value="<?php if(!empty($receive_no)) echo $receive_no; ?>">
                        </div>
                            
                                
                        <label for="title" class="col-sm-2 control-label">
                            Receive Date :
                        </label>
                             <div class="col-sm-4 input-group">
                                <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                <input required id="receive_date" class="form-control datepicker"  name="receive_date" type="text" value="<?php echo date('d-m-Y'); ?>">
                        </div>
                             
                         </div>
                        </div> 
                          
                        
                          
                   
                            
                            
                            
                            
                          
                            <div class="row" style="margin-left:0px;margin-top:5px;">        
                        <div class='form-group' >
                             <label for="title" class="col-sm-2 control-label">
                              Memo NO. :
                             </label> 
                              <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input required class="form-control" id="memo_no" name="memo_no" type="text">
                              </div>
                             <label for="title" class="col-sm-2 control-label">
                              Memo Date :
                            </label>
                             <div class="col-sm-4 input-group">
                               <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                               <input required type="text"  id="memo_date" class="form-control datepicker"  name="memo_date" value="<?php echo date('d-m-Y'); ?>">
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
                                               <input class="form-control" name="remarks" type="text">
                                    </div>


                               </div>
                   </div>   
                            
                   <input type="hidden" id="count"  value="1"  />          
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
                                        <th style="vertical-align: middle;text-align: center;">Stock Qty</th>
                                        <th style="vertical-align: middle;text-align: center;">B.Qty</th>
                                        <th style="vertical-align: middle;text-align: center;">Issue Qty</th>
                                        
                                        <th style="vertical-align: middle;text-align: center;">Remark</th>


                                    </tr>
                                </thead>
                                <tbody id="mytableBody">
                                    <tr id="row_1" style="">
                                         
                                      <td>
                                          <button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(1)" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button>
                                      </td>

                                      <td>
                                        <!--  <input style="width:100%;"  id="lot_1"  type="text"  name="lot_id[]" class="issue  form-control item_code_ajax">-->
                                          <select style="width:100%;" required class="form-control" id="lot_d_id_1" name="lot_d_id[]" onchange="javascript:materialInfo(1)">
                                              <option value="">Select Lot</option>
                                              <?php foreach ($lots as $lot) { ?>
                                                  <option value="<?php echo $lot['id']; ?>"><?php if (!empty($lot['lot_number'])) echo $lot['lot_number']; ?></option>
                                              <?php } ?>
                                          </select>
                                     </td>
                                        
                                        
                                       
                                        
                                       <td>
                                           <input style="width:100%;"  type="hidden" id="lot_id_1" name="lot_id[]" class="issue form-control">
                                            <input style="width:100%;" readonly type="text" id="code_1" name="code" class="issue form-control">
                                       </td>
                                        
                                       <td>
                                            <input style="width:100%;"  type="hidden" id="item_id_1" name="item_id[]" class="issue form-control" value="">
                                            <input style="width:100%;" readonly type="text" id="item_name_1" name="item_name" class="issue form-control">
                                       </td>
                                       
                                       <td>
                                            <input style="width:100%;" readonly type="text" id="origin_1" name="origin" class="issue form-control">
                                       </td>
                                        
                                       <td>
                                            <input style="width:100%;" readonly type="text" id="staple_length_1" name="staple_length" class="issue form-control">
                                       </td>
                                       
                                       <td>
                                            <input style="width:100%;" readonly type="text" id="mu_id_1" name="mu[]" class="issue form-control">
                                       </td>
                                      
                                       <td>
                                           
                                           <input readonly style="width:100%;" type="text"  id="stock_qty_1" name="stock_qty[]" class="form-control">
                                       </td>
                                       
                                       
                                       <td>
                                           <input required style="width:100%;" type="text"  id="accepted_bale_qty_1" name="bale_qty[]" class="form-control">
                                       </td>
                                       
                                       <td>
                                           <input required style="width:100%;" type="text"  id="accepted_weight_1" name="issue_qty[]" onkeyup="calculateAmount(1)" onchange="calculateAmount(1)" onblur="calculateAmount(1)" class="form-control">
                                           <input  style="width:100%;" type="hidden"  id="rate_1" name="rate[]" class="form-control">
                                           <input  style="width:100%;" type="hidden"  id="amount_1" name="amount[]" class="form-control">
                                       </td>

                                       
                                       
                                      
                                       
                                      <td>
                                           <input  style="width:100%;" type="text"  id="remark_1" name="remarks[]" class="form-control">
                                      </td>
                                       
                                    </tr>
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>

                            </table>



           
                             
                            

              
                
                <div class="form-group" style="margin-top: 40px;">
                        <div class="col-sm-2">
                            <a href="<?php echo site_url('backend/raw_materials/rm_transfers') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
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
        
        str +='<input readonly style="width:100%;"   type="text" id="stock_qty_'+i+'" name="stock_qty[]" class="issue form-control" value="">';
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

        str +='<input style="width:100%;"   type="text" id="remark_'+i+'" name="remarks[]" class="issue form-control" value="">';

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
        var stock_qty=Number($("#stock_qty_"+id).val());
        if(a_weigth<=stock_qty){
            var amount=rate*a_weigth;
        }else{
            alert("Issue quantity should not be more than stock qty");
            $("#accepted_weight_"+id).val('');
            amount=0;
        }    
        
        
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
               
               $('#stock_qty_'+id).val('');
               $('#show_stock_qty_'+id).val('');

                $.ajax({
                    url: '<?php echo site_url('raw_materials/rm_issue/materialInfo'); ?>',
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
                        
                        $('#stock_qty_'+id).val(msg.materialinfo[0].stock_qty);
                        $('#show_stock_qty_'+id).val(msg.materialinfo[0].stock_qty);

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
                   
                   $('#stock_qty_'+id).val('');
                   $('#show_stock_qty_'+id).val('');

             }
    }
      
    </script>
                    