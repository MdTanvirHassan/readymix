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
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(2, 7, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'ipo_material_indent') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/ipo_material_indent'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>MATERIAL INDENT  </span>
                    </a>
                </li>
                <?php } ?> 
                <?php $this->role = checkUserPermission(2, 8, $userData); 
                
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                
                ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'budget') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/budget'); ?>">
                        <i class="fa fa-cc"></i><br><span>BUDGET</span></a>
                </li>
                 <?php } ?>
                
                 <?php $this->role = checkUserPermission(2, 39, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ ?>
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'money_indent') echo 'active'; ?>" href="<?php echo site_url('backend/money_indent'); ?>">
                        <i class="fa fa-cc"></i><br><span>MONEY INDENT</span></a>
                </li>
                <?php } ?>
                
               
                <!--
                 <?php $this->role = checkUserPermission(2, 40, $userData); 
                 if(empty($this->role) || !array_key_exists(11,$this->role)){ ?>
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'purchase_quotation') echo 'active'; ?>" href="<?php echo site_url('backend/purchase_quotations'); ?>">
                        <i class="fa fa-cc"></i><br><span>PURCHASE QUOTATION</span></a>
                </li>
                <?php } ?>
                -->
                
               
                
                 <?php $this->role = checkUserPermission(2, 41, $userData); 
                 if(empty($this->role) || !array_key_exists(11,$this->role)){ ?> 
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'purchase_order') echo 'active'; ?>" href="<?php echo site_url('backend/purchase_orders'); ?>">
                            <i class="fa fa-cc"></i><br><span>PURCHASE ORDER</span></a>
                    </li>
                <?php } ?>
               
            </ul>
        </div>
    </div>

<div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Money Indent</h3>
            </div>
        </div>

<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
          
            <form class="form-horizontal" method="post" action="<?php echo site_url('money_indent/add_money_indent_action') ?>">
                
                    
                        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                   Indent Number:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                       <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                       <input class="form-control" id="indent_code" name="indent_code" type="hidden" value="<?php if(!empty($indent_code)) echo $indent_code;  ?>">
                                       <input class="form-control" id="mo_indent_no" name="mo_indent_no" type="hidden" value="<?php if(!empty($indent_auto_code)) echo "MI".$indent_auto_code;  ?>">
                                       <input disabled class="form-control" id="b_no1" name="b_no1" type="text" value="<?php if(!empty($indent_auto_code)) echo "MI".$indent_auto_code;  ?>">
                               </div>
                               <label for="title" class="col-sm-2 control-label">
                                     Date <sup class="required">*</sup>
                              </label>
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                  <input class="form-control datepicker"  name="date" type="text" value="<?php echo date('d-m-Y') ?>">
                            </div>  
                             
                         </div>
                      <!--  
                        <div class='form-group' >
                            
                           <label for="title" class="col-sm-2 control-label">
                                 Total Amount <sup class="required">*</sup>
                          </label>
                          <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input readonly class="form-control " id="total_amount"  name="total_amount" type="text" value="">
                        </div>  
                             
                         </div>
                       
                     -->   
                        
                      

               
             
             <input type="hidden" id="count" value="1"/>
             <table class="table table-bordered" id="myTable" style="margin-top:20px;">
                <thead class="thead-color">
                     <tr class="">
                        <th style="width:5%">Budget No.</th>
                        <th style="width:5%">Material Indent No.</th>
                        <th style="width:15%">Project</th>
                        <th style="width:15%">Item name & Description</th>
                        <th style="width:5%">Unit</th>
                        <th style="width:8%">Size</th>
                        <th style="width:8%">Size Unit</th>
                        <th style="width:8%">Budget Qnt</th>
                        <th style="width:8%">Indent Qnt</th>
                        <th style="width:5%">Unit Price</th>
                        <th style="width:10%">Value</th>
                        <th style="width:5%">Payment Mode</th>
                        <th style="width:3%">Select</th>
                      

                      


                      </tr>
                    </thead>
                    <tbody>
                       <?php if(!empty($budget_items)){ ?>
                            <?php $i=0; foreach($budget_items as $budget_item){ $i++;?>

                      <tr class="" id="row_1">
                        
                        
                        <td style="width:8%">
                            <input type="hidden"  name="bu_d_id[]" id="indent_id_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['bu_d_id'])) echo $budget_item['bu_d_id'];  ?>" >   
                            <input type="hidden"  name="budget_id[]" id="indent_id_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['b_id'])) echo $budget_item['b_id'];  ?>" >   
                            <input readonly style="width:100%" type="text"  name="budged_no[]" id="indent_id_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['b_no'])) echo $budget_item['b_no'];  ?>" >
                        </td>
                        
                        <td style="width:7%">      
                             <input style="width:100%;" disabled type="text"  name="indent_no1[]" id="indent_no1_<?php echo $i; ?>"  class="issue" value="<?php if(!empty($budget_item['indent_no'])) echo $budget_item['indent_no'];  ?>">
                        </td>
                        
                        <td style="width:20%">  
                            
                            <input style="width:100%;" disabled type="text"  name="department_name1[]" id="department_name1_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['dep_description'])) echo $budget_item['dep_description'];  ?>">
                        </td>
                        
                        <td style="width:17%">
                             <input type="hidden"  name="item_id[]" id="item_id_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['item_id'])) echo $budget_item['item_id'];  ?>">
                             <input disabled style="width:100%" type="text"  name="item_name_description[]" id="item_des_c1_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['item_description'])) echo $budget_item['item_description'];  ?>">
                        </td>
                        <td style="width:5%">
                            <input style="width:100%;" disabled type="text"  name="unit[]" id="unit_c1_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['measurement_unit'])) echo $budget_item['measurement_unit'];  ?>">
                        </td>    
                        
                       <td style="width:8%">
                            <input style="width:100%" readonly type="text"  name="item_size[]" id="unit_c1_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['item_size'])) echo $budget_item['item_size'];  ?>">
                        </td>     
                        
                         <td style="width:8%">
                            <input style="width:100%" readonly type="text"  name="unit_name[]" id="unit_c1_<?php echo $i; ?>" class="issue" value="<?php if(!empty($budget_item['unit_name'])) echo $budget_item['unit_name'];  ?>">
                        </td>     
                        
                       <td style="width:8%">
                           <input style="width:100%;text-align: right;" readonly  type="text"  name="budget_quantity[]" id="budget_qty_<?php echo $i; ?>"  class="issue" value="<?php if(!empty($budget_item['budget_qty'])) echo $budget_item['budget_qty'];  ?>">
                        </td>
                      <td style="width:8%">
                           <input style="width:100%;text-align: right;"   type="text"  name="quantity[]" onkeyup="calculateMoneyIndentAmount(<?php echo $i; ?>)" onchange="calculateMoneyIndentAmount(<?php echo $i; ?>)" onblur="calculateMoneyIndentAmount(<?php echo $i; ?>)"  id="mon_indent_qty_<?php echo $i; ?>"  class="issue" value="<?php if(!empty($budget_item['budget_qty'])) echo $budget_item['budget_qty'];  ?>">
                        </td>
                       
                       <td style="width:8%">
                            <input style="width:100%;text-align: right;"  type="text"  name="unit_price[]" id="unit_price_<?php echo $i; ?>" class="issue" onkeyup="calculateMoneyIndentAmount(<?php echo $i; ?>)" onchange="calculateMoneyIndentAmount(<?php echo $i; ?>)" onblur="calculateMoneyIndentAmount(<?php echo $i; ?>)" value="<?php if(!empty($budget_item['unit_price'])) echo $budget_item['unit_price'];  ?>" >
                        </td>
                        <td style="width:10%">
                            <input style="width:100%;text-align: right;" readonly type="text"  name="value[]" id="mon_indent_value_<?php echo $i; ?>"  class="issue" value="<?php if(!empty($budget_item['budget_value'])) echo $budget_item['budget_value'];  ?>" >
                        </td>
                      <td style="width:8%">
                           <input style="width:100%;" readonly type="text"  name="mode_name[]" id="payment_mode_<?php echo $i; ?>"  class="issue" value="<?php if(!empty($budget_item['mode_name'])) echo $budget_item['mode_name'];  ?>" >
                        </td>
                        <td style="width:3%;text-align: center;">
                            <input type="checkbox" name="item_select[]" value="<?php echo $i-1; ?>" >
                        </td>
                        
                   
                      </tr>
                   <?php } ?>  
                  <?php }else{ ?>
                      <tr>
                          <td colspan="11" style="text-aign:center;">No Data Found</td>
                      </tr>
                  <?php } ?>
                   </tbody>
                 </table>
             
              
                
                <div class="row" style="margin-bottom: 20px">
                      <div class="col-md-2">
                        <a href="<?php echo site_url('backend/money_indent') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
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
    function calculateMoneyIndentAmount(id){
        var unit_price = Number($('#unit_price_'+id).val());
        var budget_quantity = Number($('#budget_qty_'+id).val());
        var indent_quantity = Number($('#mon_indent_qty_'+id).val());
        if(unit_price<0){   
            $('#unit_price_'+id).val('');
        }else if(indent_quantity<0){
            $('#mon_indent_qty_'+id).val('');
        }else{
        
            if(indent_quantity>budget_quantity){
                $('#mon_indent_qty_'+id).val('');
            }else{
                var est_value=unit_price*indent_quantity;
                $('#mon_indent_value_'+id).val(est_value);
                $('#budget_value_c1_'+id).val(est_value);
            }
        }   
              
        
    }
    
   
</script>