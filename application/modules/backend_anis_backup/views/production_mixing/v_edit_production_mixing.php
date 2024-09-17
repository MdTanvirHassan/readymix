
<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(2, 8, $userData);
              
?>
<style>
 table { table-layout: fixed; margin-top: 20px}
 table th, table td { overflow: hidden; }
 .table > thead > tr > th {
    padding: 3px;
   
}
 .table > tbody > tr > td{
    padding: 7px;
   
}
.form-control {
	display: block;
	width: 100%;
	height: 34px;
	padding: 6px 5px;
	
}
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<div class="os-tabs-w menu-shad">
        <?php require_once(__DIR__ .'/../production_header.php'); ?>
    </div>

<div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Mixing</h3>
            </div>
        </div>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
          
            <form class="form-horizontal" method="post" action="<?php echo site_url('production_mixing/edit_production_mixing_action/'.$mixing_info[0]['pm_id']) ?>">
                
                   
                
                        <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label">
                                       Mixing Number:
                                   </label> 
                                         <div class="col-sm-4 input-group">
                                             <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            
                                            <input disabled class="form-control" id="schedule_no1" name="pm_no1" type="text" value="<?php if(!empty($mixing_info[0]['pm_no'])) echo $mixing_info[0]['pm_no']; ?>">
                                   </div>
                                   <label for="title" class="col-sm-2 control-label">
                                       Select Product:
                                   </label> 
                                   <div class="col-sm-4 input-group">
                                       <select class="form-control e1" name="schedule_d_id" id="schedule_details_id">
                                           <?php if(!empty($details_schedule)){ ?>
                                           <option value="">Select Product</option>
                                                    <?php foreach($details_schedule as $schedule){ ?>
                                           <option disabled="" <?php if($mixing_info[0]['schedule_d_id']==$schedule['id']) echo 'selected'; ?> value="<?php echo $schedule['id'] ?>"><?php echo $schedule['delivery_no'].'('.$schedule['product_name'].")"; ?></option>
                                                    <?php } ?>
                                           <?php } ?>         
                                       </select> 
                                   </div>
                             
                         </div>
                
                         <div class='form-group' >
                                    
                                  
                                   <label for="title" class="col-sm-2 control-label">
                                         Casting Size(In Cum) <sup class="required">*</sup>
                                  </label>
                                  <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                         <input readonly class="form-control "  name="casting_size" id="casting_size" type="text" value="<?php if(!empty($mixing_info[0]['casting_size'])) echo $mixing_info[0]['casting_size']; ?>">
                                </div>  
                             
                                 <label for="title" class="col-sm-2 control-label">
                                         Casting Size(In <?php echo $mixing_info[0]['measurement_unit']; ?>) <sup class="required">*</sup>
                                  </label>
                                  <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                         <input readonly class="form-control "  name="casting_size_cft" id="casting_size_cft" type="text" value="<?php if(!empty($mixing_info[0]['casting_size_cft'])) echo $mixing_info[0]['casting_size_cft']; ?>">
                                </div>  
                             
                         </div>
                        
                        
             <input type="hidden" id="count" value="1"/>
               <table class="table table-bordered" id="myTable">
                    <thead class="thead-color">
                     <tr>
                         
                         <th>Material <sup style='color:red'>*</sup></th>
                         <th>Brand</th>
                         <th>Req. Qnty(For Per Cum)</th> 
                         <th>T. Req. Qnty</th>
                         <th>MU</th>   
                         <th>C. Factor</th>
                         <th>C. Qnty(Per Cum)</th>
                         <th>T. C. Qnty</th>                         
                         <th>MU</th>


                      </tr>
                    </thead>
                    <tbody id="material_body">
                        <?php if(!empty($mixing_details_info)){ 
                                $i=0;
                                foreach($mixing_details_info as $key=>$m_details){
                                    $i++;
                            ?>
                            <tr id="row_<?php echo $i; ?>">
                                <td>
                                    <input read type="hidden" id="item_id_<?php echo $i; ?>" name="item_id[]" value="<?php echo $m_details['item_id']; ?>" />
                                    <input read type="text" id="item_name_<?php echo $i; ?>" value="<?php echo $m_details['item_name']; ?>" />                 
                                </td>
                                <td>
                                    <input read type="text" style="width:120px;" id="brand_<?php echo $i; ?>" name="brand[]"  value="<?php echo $m_details['brand']; ?>" />        
                                </td>
                                
                                <td>
                                    <input read type="text" style="width:80;" onkeyup="calculateConvertQnty(<?php echo $i; ?>)" onchange="calculateConvertQnty(<?php echo $i; ?>)" id="quantity_<?php echo $i; ?>" name="qty[]"  value="<?php echo $m_details['qty']; ?>" />        
                                </td>
                                
                                <td>
                                    <input read type="text" style="width:120px;" id="total_qty_<?php echo $i; ?>" name="total_qty[]"  value="<?php echo $m_details['total_qty']; ?>" />        
                                </td>
                                <td>
                                    <input read type="text" style="width:80px;" id=mu_<?php echo $i; ?>" name="mu[]"  value="<?php echo $m_details['mu']; ?>" />        
                                </td>
                                <td>
                                    <input read type="text" style="width:80px;" onkeyup="calculateConvertQnty(<?php echo $i; ?>)" onchange="calculateConvertQnty(<?php echo $i; ?>)" id="conversion_factor_<?php echo $i; ?>" name="conversion_factor[]"  value="<?php echo $m_details['conversion_factor']; ?>" />        
                                </td>
                                <td>
                                    <input read type="text" style="width:80px;" onkeyup="calculateRequireQnty(<?php echo $i; ?>)" onchange="calculateRequireQnty(<?php echo $i; ?>)" id="converted_qty_<?php echo $i; ?>" name="converted_qty[]"  value="<?php echo $m_details['converted_qty']; ?>" />        
                                </td>
                                <td>
                                    <input read type="text" style="width:120px;" id="total_converted_qty_<?php echo $i; ?>" name="total_converted_qty[]"  value="<?php echo $m_details['total_converted_qty']; ?>" />        
                                </td>
                                <td>
                                    <input read type="text" style="width:80px;" id="converted_mu_<?php echo $i; ?>" name="converted_mu[]"  value="<?php echo $m_details['converted_mu']; ?>" />        
                                </td>
                                
                            </tr>
                                <?php } }else{ ?>
                            <tr>
                                <td colspan="9">No Data Found</td>
                            </tr>
                        <?php } ?>    
                      </tbody>
                      <tfoot id="foot" style="display:none;">
                   
                        
                      </tfoot>
                  </table>
             
              
                
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/production_mixing/') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
                    
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">SAVE</button>
                    </div>
                    
                    
                </div>
            
                <div class="row">
               
                    
                </div>
            
            </form>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

<script type="text/javascript">
        
        
   function calculateCft(){
         //   alert('test');
            var cum=Number($('#casting_size_cum').val());
           //  alert(cum);
            var cft=cum*35.31;
                  cft=cft.toFixed(2);
              //    alert(cft);
            $('#casting_size_cft').val(cft);      
     }
        
        
      function calculateCum(){
           var cft=Number($('#casting_size_cft').val());
           var cum=cft/35.31;
                 cum=cum.toFixed(2);
           $('#casting_size_cum').val(cum);      
        }
        
       function calculateConvertQnty(id){
          // alert('test');
           // var item=$('#material_'+id).val();
            var item_m_unit=$('#mu_'+id).val();
            var r_qty=$('#quantity_'+id).val();
            var c_factor=$('#conversion_factor_'+id).val();
            var c_qty=$('#converted_qty_'+id).val();
            var casting_size=Number($('#casting_size').val());
    
                if(c_factor!='' && r_qty!=''){
                    var c_qty=Number(r_qty)/Number(c_factor);
                    var n_c_qty=c_qty.toFixed(2);
                    
                    var total_r_qty=casting_size*r_qty;
                    total_r_qty=total_r_qty.toFixed(2);
                    $('#total_qty_'+id).val(total_r_qty);
                    
                   var total_converted_qty=c_qty*casting_size;
                   var total_converted_qty=total_converted_qty.toFixed(2);
                    $('#total_converted_qty_'+id).val(total_converted_qty);
                    
                    $('#converted_qty_'+id).val(n_c_qty);
                    if(Number(c_factor)>1){
                        $('#c_mu_'+id).val('Cft');
                    }else{
                        $('#c_mu_'+id).val(item_m_unit);
                    }
               }else{   
                    $('#total_qty_'+id).val('');
                    $('#converted_qty_'+id).val(''); 
                    $('#total_converted_qty_'+id).val('');
               }
            
        }
        
        function calculateRequireQnty(id){
          //  var item=$('#material_'+id).val();
            var item_m_unit=$('#mu_'+id).val();
            var r_qty=$('#quantity_'+id).val();
            var c_factor=$('#conversion_factor_'+id).val();
            var c_qty=$('#converted_qty_'+id).val();
            
            var casting_size=Number($('#casting_size').val());
         
                if(c_factor!='' && c_qty!=''){
                    var r_qty=Number(c_qty)*Number(c_factor);
                    var n_r_qty=r_qty.toFixed(2);
                    
                    var total_r_qty=casting_size*r_qty;
                    total_r_qty=total_r_qty.toFixed(2);
                    $('#total_qty_'+id).val(total_r_qty);
                    
                    var total_converted_qty=c_qty*casting_size;
                    var total_converted_qty=total_converted_qty.toFixed(2);
                    $('#total_converted_qty_'+id).val(total_converted_qty);
                    
                    
                   // alert(n_r_qty);
                    $('#quantity_'+id).val(n_r_qty);
                    if(Number(c_factor)>1){
                        $('#c_mu_'+id).val('Cft');
                    }else{
                        $('#c_mu_'+id).val(item_m_unit);
                    }
                }else{
                    $('#quantity_'+id).val('');
                    $('#total_qty_'+id).val('');
                    $('#converted_qty_'+id).val('');
                    $('#total_converted_qty_'+id).val('');
                }
                
                var price=$('#rate_id').val();
               
          
        } 
        
        
     
    $('#schedule_details_id').change(function () {
         
       var schedule_details_id=  $('#schedule_details_id').val();
       var data = {'schedule_details_id': schedule_details_id}
        if(schedule_details_id!=''){
            $.ajax({
                url: '<?php echo site_url('production_mixing/get_item_material'); ?>',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (msg) {   
                 
                  var str='';
                  if(msg.mixing_info!=''){
                      
                      var casting_size=Number(msg.casting_info[0].do_qty);
                      $('#casting_size_cft').val(casting_size);
                      var cum=casting_size/35.31;
                      cum=cum.toFixed(2);
                      $('#casting_size').val(cum);
                      
                      var total=0;
                           
                        $(msg.mixing_info).each(function(i,v){
                            var total_required_qty='';
                            var total_c_qty='';
                            total=total+Number(v.quantity);
                           // total_required_qty=casting_size*v.quantity;
                            total_required_qty=cum*v.quantity;
                            total_required_qty=total_required_qty.toFixed(2);
                            
                           // total_c_qty=casting_size*v.c_quantity;
                            total_c_qty=cum*v.c_quantity;
                            total_c_qty=total_c_qty.toFixed(2);
                         
                            if(v.brand==null){
                                 var brand='';
                            }else{
                                 var brand=v.brand;
                            }    
                            
                            str+= '<tr  id="row_' + (Number(i) + 1) + '">';  
                            str +='<td><input type="hidden"  style="width:140px;"  name="item_id[]" id="m_id_'+(Number(i) + 1) + '" class="issue" value="'+v.m_id+'"><input  style="width:200px;"  type="text"  name="item[]" id="item_'+(Number(i) + 1) + '" class="issue" value="'+v.item_name+'"></td>';
                            str +='<td><input  style="width:120px;"  type="text"  name="brand[]" id="brand_'+(Number(i) + 1) + '" class="issue" value="'+brand+'"></td>';
                            str +='<td><input required class="number" onkeyup="calculateConvertQnty('+(Number(i) + 1)+')" onchange="calculateConvertQnty('+(Number(i) + 1)+')"   style="width:120px;text-align:right;"  type="text"  name="qty[]" id="quantity_'+(Number(i) + 1) + '"  value="'+v.quantity+'"></td>';
                            str +='<td><input readonly class="number"  style="width:120px;text-align:right;"  type="text"  name="total_qty[]" id="total_qty_'+(Number(i) + 1) + '"  value="'+total_required_qty+'"></td>';
                            str +='<td><input  style="width:80px;"  type="text"  name="mu[]" id="mu_'+(Number(i) + 1) + '" class="issue" value="'+v.mu+'"></td>';
                            str +='<td><input required class="number" onkeyup="calculateConvertQnty('+(Number(i) + 1)+')" onchange="calculateConvertQnty('+(Number(i) + 1)+')"   style="width:80px;text-align:right;"  type="text"  name="conversion_factor[]" id="conversion_factor_'+(Number(i) + 1) + '"  value="'+v.conversion_factor+'"></td>';
                            str +='<td><input  style="width:80px;text-align:right;"  type="text"  name="converted_qty[]" id="converted_qty_'+(Number(i) + 1) + '" onkeyup="calculateRequireQnty('+(Number(i) + 1)+')" onchange="calculateRequireQnty('+(Number(i) + 1)+')" class="issue" value="'+v.c_quantity+'"></td>';
                            str +='<td><input readonly class="number"   style="width:120px;text-align:right"  type="text"  name="total_converted_qty[]" id="total_converted_qty_'+(Number(i) + 1) + '" value="'+total_c_qty+'" ></td>';
                            str +='<td><input readonly style="width:800px;text-align:left;"  type="text"  name="converted_mu[]" id="value_'+(Number(i) + 1) + '" class="issue" value="'+v.c_mu+'"></td>';
                            str +='</tr>';
                                                     
                          });    
                        
//                        $('#total_quantity').val(total);
//                        $('#total_material_quantity').html(total);
                      
                                           
                    }else{
                       $('#foot').hide(); 
                    }
                   $('#material_body').html(str);
                   
                }


            })
        }else{
            $('#material_body').html('');
            $('#foot').hide();
           // $('#m_unit').html('');
        }
    });
    
   

    </script>