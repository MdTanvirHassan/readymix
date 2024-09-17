<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(2, 7, $userData);
       
?>
<style>
    .form-control {
	display: block;
	width: 100%;
	height: 34px;
	padding: 6px 5px;
	
    }
    table{
        margin-top: 20px;
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
                
                
                <?php $this->role =checkUserPermission(2, 39, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu=='comparative_statement') echo 'active'; ?>" href="<?php echo site_url('backend/comparative_statement'); ?>">
                            <i class="fa fa-cc"></i><br><span>COMPARATIVE STATEMENT</span></a>
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
                <h3>Edit Comparative Statement</h3>
            </div>
        </div>

<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
          
            <form class="form-horizontal" method="post" action="<?php echo site_url('comparative_statement/edit_comparative_statement_action/'.$comparative_statement_info[0]['id']) ?>">
                
                    
                        <div class='form-group' >
                                
                              <label for="title" class="col-sm-2 control-label">
                                     Date<sup class="required">*</sup>
                              </label>
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                  <input required class="form-control datepicker"  name="date" type="text" value="<?php echo date('d-m-Y',strtotime($comparative_statement_info[0]['date'])) ?>">
                             </div>  
                            
                             <label for="title" class="col-sm-2 control-label">
                                     Items<sup class="required">*</sup>
                              </label>
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                  <select required class="form-control e1"  id="item_id" name="item_id" >
                                    <option value=''>Select Item</option>
                                    <?php foreach($items as $item){ ?>
                                        <option <?php if($comparative_statement_info[0]['item_id']==$item['id']) echo "selected"; ?> value="<?php echo $item['id'] ?>" ><?php echo $item['item_name']; ?></option>
                                    <?php } ?>
                                 </select>
                            </div> 
                         </div>
                     
                        
                      <div class='form-group' >
                                
                             
                           
                            <label for="title" class="col-sm-2 control-label">
                                     Payment Mode<sup class="required">*</sup>
                              </label>
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                  <select required class="form-control e1"  id="payment_mode_<?php echo $i; ?>" name="payment_mode" >
                                    <option value=''>Select Mode</option>
                                    <?php foreach($payment_modes as $modes){ ?>
                                        <option <?php if($comparative_statement_info[0]['payment_mode']==$modes['id']) echo "selected"; ?>  value="<?php echo $modes['id']; ?>" ><?php echo $modes['mode_name']; ?></option>
                                    <?php } ?>
                                 </select>
                            </div> 
                          
                           <label for="title" class="col-sm-2 control-label">
                                   Measurement Unit<sup class="required">*</sup>
                              </label>
                              <div class="col-sm-4 input-group">
                                 
                                  <b>  <span style="margin-top:5px;" id="meas_unit"><?php echo $comparative_statement_info[0]['meas_unit']; ?></span></b>
                              </div> 
                           
                           
                             
                         </div>

           
             
             <input type="hidden" id="count" value="<?php echo count($comparative_statement_details); ?>"/>
             <table class="table table-bordered" id="myTable" style="margin-top:20px;">
                 <thead class="thead-color">
                     <tr>
                        <th style="">Supplier</th>
                        <th style="vertical-align: middle;text-align: center;">Rate</th>
                        
                       
                        <th style="padding:4px;">
                             <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" id="button1" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                        </th>

                      </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach($comparative_statement_details as $comparative_statement){ $i++;?>

                      <tr id="row_1">
                        
                        
                      
                          
                       <td>
                            <select required class="form-control e1"  id="supplier_<?php echo $i; ?>" name="supplier_id[]" >
                                <option value=''>Select Supplier</option>
                                <?php foreach($suppliers as $sup){ ?>
                                    <option <?php if($comparative_statement['supplier_id']==$sup['ID']) echo "selected"; ?> value="<?php echo $sup['ID'] ?>" ><?php echo $sup['SUP_NAME'] ?></option>
                                <?php } ?>
                            </select>
                       </td>   
                          
                            
                       
                       <td style="">
                            <input  required type="text" style="width:100%;text-align:right;"  name="rate[]" id="rate_<?php echo $i; ?>" class="issue form-control"   value="<?php if(!empty($comparative_statement['rate'])) echo $comparative_statement['rate'];  ?>" >
                       </td>
                       
                       <td>
                          <button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(<?php echo $i; ?>)" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button>
                       </td>  
                        
                    
                      </tr>
                  <?php } ?>  
                      </tbody>
                  </table>
             
              
                
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/comparative_statement') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">UPDATE</button>
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
    
    $('#item_id').change(function(){
       var item_id=$('#item_id').val();
       if(item_id!=''){
            var data={'item_id':item_id};
            $.ajax({
                     url: '<?php echo site_url('comparative_statement/item_info'); ?>',
                     data: data,
                     method: 'POST',
                     dataType: 'json',
                     success: function (msg) {

                       
                         $('#meas_unit').html(msg.item_info[0].meas_unit);



                     }

            })
        }
       
   });
    
    
     $('#button1').click(function () {
        var count = $('#count').val();
        var supplier=$('#supplier_1').html();
       
        
        var str= '<tr class="" id="row_' + (Number(count) + 1) + '">';
        
     
        str +='<td><select class="e1 form-control" style=""  name="supplier_id[]" id="supplier_'+(Number(count) + 1) + '" class="">'+supplier+'</select></td>';
        
        str +='<td><input required style="width:100%" type="text"  name="rate[]" id="rate_'+(Number(count) + 1) + '"  class="issue"></td>';
        str +='<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
       
        str +='</tr>';
        
         
      
        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
       
        $('select.e1').select2();
        $('.chzn-container').remove();
    });
    
    
    
     function removeRow(row) {
        $('#row_' + row).remove();
    }
   
</script>