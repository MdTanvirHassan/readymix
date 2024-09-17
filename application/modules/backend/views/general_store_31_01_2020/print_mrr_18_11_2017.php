<style>
    #content-table{
        line-height: 18px !important;
    }
    .table{
        
    }
    
</style>



 
<div style="padding:0" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">Wahid Construction Ltd.</h>

    <p style=" text-align: center;text-decoration: underline;">Material Receive Section</p>
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
           <tr><td colspan="8" style="text-decoration:"><?php echo ucfirst($mrr[0]['mrr_type']); ?> &nbsp;</td><td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:100px;"><?php echo $mrr[0]['mrr_no']; ?></td></tr>
           <tr><td colspan="8"><?php if($mrr[0]['mrr_type']=="challan") echo $mrr[0]['mrr_challan'];else echo $mrr[0]['mrr_invoice'];  ?></td><td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:150px;">Date.<br><?php echo date('d-m-Y',strtotime($mrr[0]['mrr_date'])); ?></td></tr>
                <tr id="row_1">
                        <th style="border-left:1px solid;border-top:1px solid;">Budget No</th>
                        <th style="border-left:1px solid;border-top:1px solid;">Indent No</th>
                        <th style="border-left:1px solid;border-top:1px solid;">Item Code</th>
                        <th style="border-left:1px solid;border-top:1px solid;">Item name </th>
                        <th style="border-left:1px solid;border-top:1px solid;">MU</th>
                        <th style="border-left:1px solid;border-top:1px solid;">Receive Qnt</th>
                        <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                        <th style="border-left:1px solid;border-top:1px solid;">Others Cost</th>
                        <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Total Cost</th>
                        
                   
                </tr>
                <?php $count=count($budgeted_items); $total_value=0; ?>
               <?php $i=0; foreach($budgeted_items as $budgeted_item){ $i++;
                        $total_value=$total_value+$budgeted_item['total_cost'];
                     ?>
                      <?php // if($count==$i){ ?>
                       <!--
                         <tr id="row_1">
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($budgeted_item['department_name'])) echo $budgeted_item['department_name'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($budgeted_item['indent_no'])) echo $budgeted_item['indent_no'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($budgeted_item['indent_date'])) echo date('d-m-Y',strtotime($budgeted_item['indent_date']));  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($budgeted_item['item_description'])) echo $budgeted_item['item_description'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($budgeted_item['measurement_unit'])) echo $budgeted_item['measurement_unit'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"><?php if(!empty($budgeted_item['budget_qty'])) echo $budgeted_item['budget_qty'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($budgeted_item['unit_price'])) echo $budgeted_item['unit_price'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($budgeted_item['budget_value'])) echo $budgeted_item['budget_value'];  ?></td>
                        </tr>  
                       -->
                      
                  <?php // }else{ ?>   
                           <tr id="row_1">
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($budgeted_item['b_no'])) echo $budgeted_item['b_no'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($budgeted_item['indent_no'])) echo $budgeted_item['indent_no'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($budgeted_item['item_code'])) echo $budgeted_item['item_code'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($budgeted_item['item_description'])) echo $budgeted_item['item_description'];  ?></td>
                         
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($budgeted_item['measurement_unit'])) echo $budgeted_item['measurement_unit'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($budgeted_item['receive_qty'])) echo $budgeted_item['receive_qty'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($budgeted_item['unit_price'])) echo $budgeted_item['unit_price'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($budgeted_item['cf_cost'])) echo $budgeted_item['cf_cost'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php if(!empty($budgeted_item['total_cost'])) echo $budgeted_item['total_cost'];  ?></td>
                        </tr>  
                  <?php // } ?>      
                               
               <?php } ?>
                        <tr id="row_1">
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b>Total Taka=</b></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_value)) echo $total_value;  ?></b></td>
                        </tr>  
                        <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td colspan="9"><b>Taka In Words=&nbsp;&nbsp;<?php $taka_in_word=convert_number_to_words($total_value); echo ucwords($taka_in_word);  ?>&nbsp; Only</b></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                          <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td style="width:100px;font-size:15px;">MANAGER</td><td style="width:80px;">DGM(A&F)</td><td style="width:100px;text-align: center;">CFO</td><td style="width:100px;text-align: center;">SR E.D</td><td style="width:100px;text-align: center;">DIRECTOR</td><td  style="width:200px;text-align: center;">M. DIRECTOR</td></tr>
              
        </table>
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
        
    </table>
        
    
</div>
<div class="clearfix"></div>
 