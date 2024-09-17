
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
input:read-only {
  background-color: #efefef !important;
}
input:-moz-read-only { /* For Firefox */
  background-color: #efefef !important;
}
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<div class="os-tabs-w menu-shad">
        <?php require_once(__DIR__ .'/../production_header.php'); ?>
    </div>

<div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Schedule</h3>
            </div>
        </div>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
          
            <form class="form-horizontal" method="post" action="<?php echo site_url('productions/add_production_schedule_action') ?>">
                
                   
                
                        <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                               Schedule Number:
                           </label> 
                                 <div class="col-sm-4 input-group">
                                     <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <input class="form-control" id="budget_code" name="schedule_code" type="hidden" value="<?php if(!empty($schedule_code)) echo $schedule_code;  ?>">
                                     <input class="form-control" id="schedule_no" name="schedule_no" type="hidden" value="<?php if(!empty($schedule_auto_code)) echo $branch_info[0]['short_name']."/SD/".$schedule_auto_code;  ?>">
                                    <input readonly class="form-control" id="schedule_no1" name="schedule_no1" type="text" value="<?php if(!empty($schedule_auto_code)) echo $branch_info[0]['short_name']."/SD/".$schedule_auto_code;  ?>">
                           </div>
                           <label for="title" class="col-sm-2 control-label">
                                 Date <sup class="required">*</sup>
                          </label>
                          <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                 <input required class="form-control datepicker"  name="date" type="text" value="<?php echo date('d-m-Y') ?>">
                        </div>  
                             
                         </div>
                        
                        
             <input type="hidden" id="count" value="1"/>
             <table class="table table-bordered" id="myTable" style="margin-top:20px;">
                 
                      <tr>
                            <th style="width:10%;"><input type="text" placeholder="Search by Date" id="row0" onkeyup="mySearch(0, 0)"></th>
                            <th style="width:10%"><input type="text" placeholder="Search by DO No" id="row1" onkeyup="mySearch(1, 0)"></th>
                            <th style="width:10%"><input type="text" placeholder="Search by Customer" id="row2" onkeyup="mySearch(2, 0)"></th>
                            <th style="width:10%"><input type="text" placeholder="Search by Project" id="row3" onkeyup="mySearch(3, 0)"></th>
                            <th style="width:10%"><input type="text" placeholder="Search by Item" id="row4" onkeyup="mySearch(4, 0)"></th>
                            <th style="width:5%"><input type="text" placeholder="Search by MU" id="row5" onkeyup="mySearch(5, 0)"></th>
                            <th style="width:5%"><input type="text" placeholder="Search by DO QTY" id="row6" onkeyup="mySearch(6, 0)"></th>
                            <th style="width:5%">#</th>
                            <th style="width:5%">#</th>
                            <th style="width:5%">#</th>
                        </tr>
                     <tr  class="thead-color">
                        <th style="vertical-align: middle;width: 10%;text-align: center;">Do. Date</th>
                        <th style="vertical-align: middle;width: 10%;text-align: center;">Do. No.</th>
                        <th style="vertical-align: middle;width: 10%;text-align: center;">Customer</th>
                        <th style="vertical-align: middle;width: 10%;text-align: center;">Project</th>
                        <th style="vertical-align: middle;width: 10%;text-align: center;">Item name & Description</th>
                        <th style="vertical-align: middle;width: 5%;text-align: center;">MU</th>
                        <th style="vertical-align: middle;width: 5%;text-align: center;">Do. Qty</th>
                        <th style="vertical-align: middle;width: 5%;text-align: center;">Schedule Qty</th>
                        <th style="vertical-align: middle;width: 5%;text-align: center;">Schedule Qty (CUM)</th>
                        <th style="vertical-align: middle;width: 5%;text-align: center;">Select</th>
                      
                      </tr>
                    
                    <tbody>
                    <?php $i=0; foreach($do_orders as $do_order){ $i++;?>

                      <tr id="row_1">      
                            <td><input type="text" readonly id="do_id" value="<?php echo $do_order['delivery_order_date']; ?>" /></td>
                            <td>
                               
                                <input type="text" readonly id="do_id_<?php echo $i; ?>" value="<?php echo $do_order['delivery_no']; ?>" />
                            </td>
                            <td><input type="text" readonly id="customer_id" value="<?php echo $do_order['c_name']; ?>" /></td>
                            <td><input type="text" readonly id="project_name_<?php echo $i; ?>" value="<?php echo $do_order['project_name']; ?>" /></td>
                            <td>
                               
                                <input type="text" readonly id="product_name_<?php echo $i; ?>" value="<?php echo $do_order['product_name']; ?>" />
                            </td>
                            <td><input type="text" readonly id="do_unit_<?php echo $i; ?>" value="<?php echo $do_order['mu_name']; ?>" /></td>
                            <td><input type="text" readonly id="do_qty_<?php echo $i; ?>" name="do_qty[]" value="<?php echo $do_order['quantity']; ?>" /></td>
                            <td><input type="text" readonly onkeyup="productionQtyValidation(<?php echo $i; ?>)" onchange="productionQtyValidation(<?php echo $i; ?>)"   id="schedule_qty_<?php echo $i; ?>" name="schedule_qty[]" class="number" value="<?php echo $do_order['quantity']; ?>" /></td>
                            <td><input type="text" readonly onkeyup="productionCumQtyValidation(<?php echo $i; ?>)"  id="schedule_qty_cum_<?php echo $i; ?>" name="schedule_qty_cum[]" class="number" value="<?php if($do_order['mu_name']=='CFT') echo round($do_order['quantity']/35.31,2); else if($do_order['mu_name']=='MT') echo round($do_order['quantity']/2.41,2); else echo round($do_order['quantity'],2); ?>" /></td>
                            <td style="text-align: center;">
                                 <input type="hidden" name="product_id[]" value="<?php echo $do_order['s_item_id']; ?>" />
                                 <input type="hidden" name="do_details_id[]" value="<?php echo $do_order['do_details_id']; ?>" />
                                <input type="hidden" name="do_id[]" value="<?php echo $do_order['do_id']; ?>" />
                                <input type="checkbox" onclick="addRequired(<?php echo $i; ?>)" class="form-control"  id="select_item_<?php echo $i; ?>" name="item_select[]" value="<?php echo $i-1; ?>" >
                            </td>                  
                      </tr>
                  <?php } ?>  
                      </tbody>
                  </table>
             
              
                
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/productions/') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
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
    function mySearch(col = 0, strict = 0) {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("row" + col);
        if (strict)
            filter = input.value;
        else
            filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        var rr = 0;
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[col];
            
            if (td) {
                td = td.getElementsByTagName("input")[0];
                txtValue = td.value;
                if (!strict)
                    txtValue = txtValue.toUpperCase();
                if (txtValue.indexOf(filter) > -1) {
                    rr++;
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

    }
    
    var datePickerOptions = {
                dateFormat: 'dd-mm-yy',
                firstDay: 1,
                changeMonth: true,
                changeYear: true,
                // ...
            }
    $('.datepicker').datepicker(datePickerOptions);
    
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
    
    
        var do_unit=$('#do_unit_'+id).val();
        var sd_qty=Number($('#schedule_qty_'+id).val());
        var do_qty=Number($('#do_qty_'+id).val());
        if(sd_qty>do_qty){
            $('#schedule_qty_'+id).val(do_qty);
        }
        var sd_qty=Number($('#schedule_qty_'+id).val());
        if(do_unit=='CFT'){
            $('#schedule_qty_cum_'+id).val((sd_qty/35.31).toFixed(2));
        }else if(do_unit=='MT'){
            $('#schedule_qty_cum_'+id).val((sd_qty/2.41).toFixed(2));
        }else{
            $('#schedule_qty_cum_'+id).val((sd_qty).toFixed(2));
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
     var do_unit=$('#do_unit_'+id).val();
        var sd_qty=Number($('#schedule_qty_cum_'+id).val());
        if(do_unit=='CFT'){
            $('#schedule_qty_'+id).val((sd_qty*35.31).toFixed(2));
        }else if(do_unit=='MT'){
            $('#schedule_qty_'+id).val((sd_qty*2.41).toFixed(2));
        }else{
            $('#schedule_qty_'+id).val((sd_qty).toFixed(2));
        }
        
       
        var sd_qty=Number($('#schedule_qty_'+id).val());
        var do_qty=Number($('#do_qty_'+id).val());
        if(sd_qty>do_qty){
            $('#schedule_qty_'+id).val(do_qty);
             if(do_unit=='CFT'){
            $('#schedule_qty_cum_'+id).val((do_qty/35.31).toFixed(2));
        }else if(do_unit=='MT'){
            $('#schedule_qty_cum_'+id).val((do_qty/2.41).toFixed(2));
        }else{
            $('#schedule_qty_cum_'+id).val((do_qty).toFixed(2));
        }
        }
    }
    
    
    function addRequired(id){
        
        if($('#select_item_'+id).prop('checked')){    
            $('#schedule_qty_'+id).prop('readonly',false);
            $('#schedule_qty_cum_'+id).prop('readonly',false);
            $('#schedule_qty_'+id).prop('required',true);       
        }else{      
            $('#schedule_qty_'+id).prop('readonly',true); 
            $('#schedule_qty_cum_'+id).prop('readonly',true); 
            $('#schedule_qty_'+id).prop('required',false); 
            var do_qty=Number($('#do_qty_'+id).val());
            $('#schedule_qty_'+id).val(do_qty);
        }
            
        
    }
   
   
    
    
    
    
   
  

    function removeRow(row) {
        $('#row_' + row).remove();
    }

    $(document).ready(function () {

    //    $('select.e1').select2();
    });

</script>