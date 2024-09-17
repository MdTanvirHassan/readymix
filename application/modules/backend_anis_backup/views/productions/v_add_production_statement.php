
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
                <h3>Add Production</h3>
            </div>
        </div>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
          
            <form class="form-horizontal" method="post" action="<?php echo site_url('productions/add_production_statement_action') ?>">
                
                   
                
                        <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                              Production No.:
                           </label> 
                                 <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control" id="budget_code" name="production_code" type="hidden" value="<?php if(!empty($production_code)) echo $production_code;  ?>">
                                    <input class="form-control" id="schedule_no" name="production_no" type="hidden" value="<?php if(!empty($production_auto_code)) echo $branch_info[0]['short_name']."/PD/".$production_auto_code;  ?>">
                                    <input disabled class="form-control" id="schedule_no1" name="production_no1" type="text" value="<?php if(!empty($production_auto_code)) echo $branch_info[0]['short_name']."/PD/".$production_auto_code;  ?>">
                           </div>
                           <label for="title" class="col-sm-2 control-label">
                                 Date <sup class="required">*</sup>
                          </label>
                          <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                 <input required class="form-control datepicker"  name="date" type="text" value="<?php echo date('d-m-Y') ?>">
                        </div>  
                             
                         </div>
                
                <div class='form-group' >
                           
                           <label for="title" class="col-sm-2 control-label">
                                 Schedule <sup class="required">*</sup>
                          </label>
                          <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                <select required  id="schedule_id" class="form-control e1" name="schedule_id">
                                        <option  value="">Select</option>
                                       <?php foreach ($production_schedules as $production_schedule) { ?>
                                                <option value="<?php echo $production_schedule['id']; ?>"><?php if (!empty($production_schedule['schedule_no'])) echo $production_schedule['schedule_no'].'('.date('d-m-Y',strtotime($production_schedule['date'])).')'; ?></option>
                                        <?php } ?>
                                                    
                               </select>
                          </div>  
                             
            </div>
                        
                        
             <input type="hidden" id="count" value="1"/>
             <table class="table table-bordered" id="myTable" style="margin-top:20px;">
                 <thead class="thead-color">
                     <tr>
                       
                        <th style="vertical-align: middle;width: 10%;text-align: center;">Do. No.</th>
                        <th style="vertical-align: middle;width: 10%;text-align: center;">Customer</th>
                        <th style="vertical-align: middle;width: 10%;text-align: center;">Project</th>
                        <th style="vertical-align: middle;width: 10%;text-align: center;">Item name & Description</th>
                        <th style="vertical-align: middle;width: 5%;text-align: center;">MU</th>      
                        <th style="vertical-align: middle;width: 5%;text-align: center;">S. Qty</th>
                        <th style="vertical-align: middle;width: 5%;text-align: center;">P. Qty</th>
                        <th style="vertical-align: middle;width: 5%;text-align: center;">P. Qty(CUM)</th>
                    <!--    <th style="vertical-align: middle;width: 5%;text-align: center;">Stock. Qty(CUM)</th> -->
                        <th style="vertical-align: middle;width: 5%;text-align: center;">Select</th>
                      
                      </tr>
                    </thead>
                    <tbody id="product_list">
                        <tr><td colspan="8">No Data Found</td></tr>
                        <!--
                    <?php $i=0; foreach($do_orders as $do_order){ $i++;?>

                      <tr id="row_1">      
                            <td><input type="text" readonly id="do_id" name="schedule_id" value="<?php echo $do_order['delivery_order_date']; ?>" /></td>
                            <td><input type="hidden" name="do_details_id[]" value="<?php echo $do_order['do_details_id']; ?>" /><input type="hidden" name="do_id[]" value="<?php echo $do_order['do_id']; ?>" /><input type="text" readonly id="do_id" value="<?php echo $do_order['delivery_no']; ?>" /></td>
                            <td><input type="text" readonly id="customer_id" value="<?php echo $do_order['c_name']; ?>" /></td>
                            <td><input type="text" readonly id="do_id" value="<?php echo $do_order['project_name']; ?>" /></td>
                            <td><input type="hidden" name="product_id[]" value="<?php echo $do_order['s_item_id']; ?>" /><input type="text" readonly id="do_id" value="<?php echo $do_order['product_name']; ?>" /></td>
                            <td><input type="text" readonly id="do_id" value="<?php echo $do_order['measurement_unit']; ?>" /></td>
                            <td><input type="text" readonly id="do_qty" name="do_qty[]" value="<?php echo $do_order['quantity']; ?>" /></td>
                            <td><input type="text" readonly  id="schedule_qty" name="schedule_qty[]" value="<?php echo $do_order['quantity']; ?>" /></td>
                            <td style="text-align: center;"><input type="checkbox" class="form-control"  id="item_select_<?php echo $i; ?>" name="item_select[]" value="<?php echo $i-1; ?>" ></td>                  
                      </tr>
                  <?php } ?>  
                        -->
                      </tbody>
                  </table>
             
              
                
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/productions/production_statement') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>                
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

<script>
    
  $('#schedule_id').change(function(){
        var schedule_id=$('#schedule_id').val();
      
       // alert(schedule_id);
        if(schedule_id!=''){
            $('#product_list').html('');
            $.ajax({
                url:'<?php echo site_url('productions/get_schedule_products') ?>',
                data:{'schedule_id':schedule_id},
                method:'POST',
                dataType:'JSON',
                success:function(msg){
                        var str='';
                        $(msg.product_list).each(function (i, v){ 
                            if(!v.mu_name)
                                v.mu_name = v.measurement_unit;
                           var net_schedule=''  
                                if(v.production_qty>0){
                                    net_schedule=v.schedule_qty-v.production_qty;
                                }else{
                                    net_schedule=v.schedule_qty;
                                }
//                                var stock_qty='';
//                                 if (v.delivery_quantity != null) {
//                            stock_qty = Number(v.production_qty) - Number(v.delivery_quantity);
//                        } else {
//                            stock_qty = Number(v.production_qty) - Number(v.delivery_quantity);
//                        }
                                
                           str +='<tr>';
                           str+=' <td>'; 
                           str +='<input type="hidden" name="psd_id[]"  id="schedule_no_' +(Number(i) +1)+ '" value="'+v.id+'" />';
                           str +='<input type="hidden" name="do_id[]"  id="do_id_' +(Number(i) +1)+ '" value="'+v.do_id+'" />';
                           str +='<input type="text" readonly id="do_no_' +(Number(i) +1)+ '" value="'+v.delivery_no+'" />';
                           str +='</td>';
                           str+=' <td><input type="text" readonly id="c_name_' +(Number(i) +1)+ '" value="'+v.c_name+'" /></td>' ;
                           str+=' <td><input type="text" readonly id="project_name_' +(Number(i) +1)+ '" value="'+v.project_name+'" /></td>' ;
                           str+=' <td><input type="hidden" name="product_id[]"  id="product_id" value="'+v.product_id+'" /><input type="text" readonly id="do_no" value="'+v.product_name+'" /></td>' ;
                           str+=' <td><input type="text" readonly id="mu_' +(Number(i) +1)+ '"  value="'+v.mu_name+'" /></td>' ;
                           str+=' <td><input type="text" readonly id="schedule_qty_' +(Number(i) +1)+ '"  name="schedule_qty[]" value="'+net_schedule+'" /></td>' ;
                           str+=' <td><input type="text" readonly onkeyup="productionQtyValidation('+(Number(i) +1)+')" onchange="productionQtyValidation('+(Number(i) +1)+')" id="production_qty_'+(Number(i) +1)+'" class="number"  name="production_qty[]" value="'+net_schedule+'" /></td>' ;
                           if(v.mu_name=='CFT'){
                                str+=' <td><input type="text" readonly onkeyup="productionCumQtyValidation('+(Number(i) +1)+')" onchange="productionCumQtyValidation('+(Number(i) +1)+')" id="production_qty_cum_'+(Number(i) +1)+'" class="number"  name="production_qty_cum[]" value="'+(net_schedule/35.31).toFixed(2)+'" /></td>' ;
                             //   str+=' <td><input type="text" readonly id="stock_qty_cum_'+(Number(i) +1)+'" class="number"  name="production_qty_cum[]" value="'+(stock_qty/35.31).toFixed(2)+'" /></td>' ;
                           }else if(v.mu_name=='MT'){
                                str+=' <td><input type="text" readonly onkeyup="productionCumQtyValidation('+(Number(i) +1)+')" onchange="productionCumQtyValidation('+(Number(i) +1)+')" id="production_qty_cum_'+(Number(i) +1)+'" class="number"  name="production_qty_cum[]" value="'+(net_schedule/2.41).toFixed(2)+'" /></td>' ;
                             //   str+=' <td><input type="text" readonly id="stock_qty_cum_'+(Number(i) +1)+'" class="number"  name="stock_qty_cum[]" value="'+(stock_qty/2.41).toFixed(2)+'" /></td>' ;
                           }else{
                                str+=' <td><input type="text" readonly onkeyup="productionCumQtyValidation('+(Number(i) +1)+')" onchange="productionCumQtyValidation('+(Number(i) +1)+')" id="production_qty_cum_'+(Number(i) +1)+'" class="number"  name="production_qty_cum[]" value="'+(net_schedule)+'" /></td>' ;
                             //   str+=' <td><input type="text" readonly  id="stock_qty_cum_'+(Number(i) +1)+'" class="number"  name="stock_qty_cum[]" value="'+(stock_qty)+'" /></td>' ;
                           }
                           
                           
                           str +='<td style="text-align: center;"><input type="checkbox" name="select_item[]" onclick="addRequired('+(Number(i) +1)+')"   id="select_item_'+(Number(i) +1)+ '" class="select_item_' +(Number(i) + 1)+'" value="'+Number(i)+'" ></td>';
                           str +="</tr>";
                        });    
                        $('#product_list').html(str);
                        
                }    
            });
        }else{  
            $('#product_list').html('');
        }
    });
  
    function productionQtyValidation(id){
    $('.number').on('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);
    });
    
    
        var sd_qty=Number($('#schedule_qty_'+id).val());
        var p_qty=Number($('#production_qty_'+id).val());
        if(p_qty>sd_qty){
            $('#production_qty_'+id).val(sd_qty);
        }
        
         var sd_qty=Number($('#production_qty_'+id).val());
        if($('#mu_'+id).val()=='CFT'){
            $('#production_qty_cum_'+id).val((sd_qty/35.31).toFixed(2));
        }else if($('#mu_'+id).val()=='MT'){
            $('#production_qty_cum_'+id).val((sd_qty/2.41).toFixed(2));
        }else{
            $('#production_qty_cum_'+id).val((sd_qty).toFixed(2));
        }
        
    }
    function productionCumQtyValidation(id){
    $('.number').on('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);
    });
    
    
        
        
         var sd_qty=Number($('#production_qty_cum_'+id).val());
        if($('#mu_'+id).val()=='CFT'){
            $('#production_qty_'+id).val((sd_qty*35.31).toFixed(2));
        }else if($('#mu_'+id).val()=='MT'){
            $('#production_qty_'+id).val((sd_qty*2.41).toFixed(2));
        }else{
            $('#production_qty_'+id).val((sd_qty).toFixed(2));
        }
        
        var sd_qty=Number($('#schedule_qty_'+id).val());
        var p_qty=Number($('#production_qty_'+id).val());
        if(p_qty>sd_qty){
            $('#production_qty_'+id).val(sd_qty);
            $('#production_qty_cum_'+id).val($('#production_qty_cum_'+id).val());
        }
        
    }
    
    
    function addRequired(id){

        
        if($('#select_item_'+id).prop('checked')){    
            $('#production_qty_'+id).prop('readonly',false);
            $('#production_qty_cum_'+id).prop('readonly',false);
            $('#production_qty_'+id).prop('required',true);       
        }else{      
            $('#production_qty_'+id).prop('readonly',true); 
            $('#production_qty_cum_'+id).prop('readonly',true); 
            $('#production_qty_'+id).prop('required',false); 
            var sd_qty=Number($('#schedule_qty_'+id).val());
            $('#production_qty_'+id).val(sd_qty);
        }
            
        
    }
    
    
   

    function removeRow(row) {
        $('#row_' + row).remove();
    }

    $(document).ready(function () {

    //    $('select.e1').select2();
    });

</script>