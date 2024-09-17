<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(2, 7, $userData);
       
?>
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
                <h3 style="float:left;">Details Money Indent</h3>
                <?php if($money_indent_info[0]['status']=="Approved"){ ?>
                    <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('money_indent/details_money_indent/' . $money_indent_info[0]['mi_id'] . '/true'); ?>" class="btn btn-sm btn-warning">PRINT</a>
                <?php } ?>    
            </div>
        </div>

<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        
                        <?php if($user_type==1){ ?>
                                    <?php if($money_indent_info[0]['status']=="Approved"){ ?>                             
                                        <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                  <?php }else if($money_indent_info[0]['status']=="Rejected"){ ?>
                                        <button onclick="approve('<?php echo site_url('money_indent/approve_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                   <?php }else{ ?>
                                        <button onclick="approve('<?php echo site_url('money_indent/approve_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-sm btn-primary">Approve</button>
                                        <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-sm btn-warning">Reject</button>
                                   <?php } ?>
                            
                        <?php }else{ ?>
                             <?php if ($employee_id == $approvers_info[0]) { ?>
                                    <?php  if(!empty($approvers_info[1])){ ?>
                                            <?php if($money_indent_info[0]['status']=="Pending"){ ?>
                                                    <button onclick="approve('<?php echo site_url('money_indent/forward_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-success">Forward</button>&nbsp;&nbsp;
                                                     <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-warning">Reject</button>
                                            <?php } ?>

                                     <?php }else{ ?>
                                               <?php if($money_indent_info[0]['status']=="Pending"){ ?>
                                                     <button onclick="approve('<?php echo site_url('money_indent/approve_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-primary">Approve</button>&nbsp;&nbsp;
                                                      <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-warning">Reject</button>
                                               <?php } ?>
                                     <?php } ?>           
                            <?php } ?>

                           <?php if ($employee_id == $approvers_info[1]) { ?>
                                    <?php  if(!empty($approvers_info[2])){ ?>
                                            <?php if($money_indent_info[0]['status']=="Forward-By-First-Approver"){ ?>
                                                    <button onclick="approve('<?php echo site_url('money_indent/forward_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-success">Forward</button>&nbsp;&nbsp;
                                                    <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-warning">Reject</button>
                                            <?php } ?>

                                     <?php }else{ ?>
                                               <?php if($money_indent_info[0]['status']=="Forward-By-First-Approver"){ ?>
                                                     <button onclick="approve('<?php echo site_url('money_indent/approve_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-primary">Approve</button>&nbsp;&nbsp;
                                                     <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-warning">Reject</button>
                                               <?php } ?>
                                     <?php } ?>           
                            <?php } ?>


                            <?php if ($employee_id == $approvers_info[2]) { ?>
                                    <?php  if(!empty($approvers_info[3])){ ?>
                                            <?php if($money_indent_info[0]['status']=="Forward-By-Second-Approver"){ ?>  
                                                     <button onclick="approve('<?php echo site_url('money_indent/forward_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-success">Forward</button>&nbsp;&nbsp;
                                                     <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-warning">Reject</button>
                                            <?php } ?>

                                     <?php }else{ ?>
                                               <?php if($money_indent_info[0]['status']=="Forward-By-Second-Approver"){ ?>
                                                     <button onclick="approve('<?php echo site_url('money_indent/approve_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-primary">Approve</button>&nbsp;&nbsp;
                                                     <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-warning">Reject</button>
                                               <?php } ?>
                                     <?php } ?>           
                            <?php } ?>


                           <?php if ($employee_id == $approvers_info[3]) { ?>

                                         <?php if($money_indent_info[0]['status']=="Forward-By-Third-Approver"){ ?>       
                                                <button onclick="approve('<?php echo site_url('money_indent/approve_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-primary">Approve</button>&nbsp;&nbsp;
                                                <button onclick="reject('<?php echo site_url('money_indent/reject_money_indent/'.$money_indent_info[0]['mi_id']); ?>')" class="btn btn-warning">Reject</button>
                                         <?php } ?>      

                            <?php } ?>                        



                    <?php } ?>      
                        
          
            <form class="form-horizontal" method="post" action="<?php echo site_url('money_indent/edit_money_indent_action/'.$money_indent_info[0]['mi_id']) ?>">
                
                    
                        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                    Indent Number<sup style="color:red"></sup>:
                               </label> 
                               <div class="col-sm-4 input-group">
                                      
                                       
                                   <b>  <?php if(!empty($money_indent_info[0]['mo_indent_no'])) echo $money_indent_info[0]['mo_indent_no'];  ?><b>
                               </div>
                               <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                     Date<sup class="required"></sup>
                              </label>
                              <div class="col-sm-4 input-group">        
                                  <b> <?php echo date('d-m-Y',strtotime($money_indent_info[0]['date'])) ?></b>
                            </div>  
                             
                         </div>
                      
                        
                         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                   Project<sup style="color:red"></sup>:
                               </label> 
                               <div class="col-sm-4 input-group">
                                      
                                       
                                   <b>  <?php if(!empty($money_indent_info[0]['dep_description'])) echo $money_indent_info[0]['dep_description'];  ?><b>
                               </div>
                              
                             
                         </div>
                      

               
             
             <input type="hidden" id="count" value="1"/>
             <table class="table table-bordered" id="myTable" style="margin-top: 20px;">
                <thead class="thead-color">
                     <tr class="row">
                        <th>Budget Date</th>
                        <th>Budget No.</th>
                        <th>Indent Date</th>
                        <th>Material Indent No.</th>
                        
                        <th>Item name & Description</th>
                        <th>Unit</th>
                        <th>Size</th>
                        <th>Size Unit</th>
                        <th>Budget Qnt</th>
                        <th>Indent Qnt</th>
                        <th>Unit Price</th>
                        <th>Value</th>
                        <th>Payment Mode</th>
                        <th>Supplier</th>
                       <!-- <th>Select</th> -->
                      

                      


                      </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach($budget_items as $budget_item){ $i++;?>

                      <tr class="row" id="row_1">
                        
                        <td>     
                           <?php if(!empty($budget_item['b_date'])) echo date('d-m-Y',strtotime($budget_item['b_date']));  ?>
                        </td>
                        <td>     
                           <?php if(!empty($budget_item['b_no'])) echo $budget_item['b_no'];  ?>
                        </td>
                        
                        <td>     
                           <?php if(!empty($budget_item['indent_date'])) echo date('d-m-Y',strtotime($budget_item['indent_date']));  ?>
                        </td>
                        
                        <td>      
                             <?php if(!empty($budget_item['indent_no'])) echo $budget_item['indent_no'];  ?>
                        </td>
                        
                        
                        
                        <td>         
                             <?php if(!empty($budget_item['item_description'])) echo $budget_item['item_description'];  ?>
                        </td>
                        <td>
                            <?php if(!empty($budget_item['measurement_unit'])) echo $budget_item['measurement_unit'];  ?>
                        </td>   
                        <td>
                            <?php if(!empty($budget_item['item_size'])) echo $budget_item['item_size'];  ?>
                        </td>   
                         <td>
                            <?php if(!empty($budget_item['unit_name'])) echo $budget_item['unit_name'];  ?>
                        </td>  
                         <td style="text-align: right;">
                             <b>   <?php if(!empty($budget_item['budget_qty'])) echo $budget_item['budget_qty'];  ?></b>
                        </td>
                        <td style="text-align: right;">
                            <b> <?php if(!empty($budget_item['quantity'])) echo number_format($budget_item['quantity']);  ?></b>
                        </td>
                       
                        <td style="text-align: right;">
                            <b><?php if(!empty($budget_item['unit_price'])) echo number_format($budget_item['unit_price'],2);  ?></b>
                        </td>
                        <td style="text-align: right;">
                            <b> <?php if(!empty($budget_item['value'])) echo number_format($budget_item['value'],2);  ?></b>
                        </td>
                        <td>
                            <b>   <?php if(!empty($budget_item['mode_name'])) echo $budget_item['mode_name'];  ?></b>
                        </td>
                        
                        <td>
                            <b>   <?php if(!empty($budget_item['SUP_NAME'])) echo $budget_item['SUP_NAME'];  ?></b>
                        </td>
                    
                        
                   
                      </tr>
                  <?php } ?>  
                      </tbody>
                  </table>
             
              
                
                <div class="row" style="margin-bottom: 20px">
                    <!--
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">UPDATE</button>
                    </div>
                    -->
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/money_indent') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
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