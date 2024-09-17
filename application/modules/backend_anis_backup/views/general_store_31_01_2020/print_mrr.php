<style>
    #content-table{
        line-height: 18px !important;
    }
    .table{
        
    }
    
</style>



 
<div style="padding:0" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">WAHID CONSTRUCTION LTD.</h>
    <p style=" text-align: center;margin-top:-3px;">(A Unit Of Karim Group)</p>
    <p style=" text-align: center;text-decoration: underline;margin-top:-7px;">MATERIAL RECEIVE REPORT:CONSUMABLE</p>
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
           <tr><td colspan="6" style="text-decoration:">M.R.R. No.<span style="text-decoration:underline;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($mrr[0]['mrr_no']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td><td  >Date:<span style="text-decoration:underline;text-align: center;">&nbsp;&nbsp;<?php  echo date('d-m-Y',strtotime($mrr[0]['mrr_date'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
           <tr><td colspan="7" style="text-decoration:">Supplier's Name<span style="text-decoration:underline;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($mrr[0]['SUP_NAME']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
           <tr><td colspan="7" style="text-decoration:">Supplier's Address<span style="text-decoration:underline;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($mrr[0]['ADDRESS']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
           <tr><td colspan="6" style="text-decoration:">Supplier's Challan/Invoice<span style="text-decoration:underline;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($mrr[0]['mrr_type']); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($mrr[0]['mrr_type']=="challan") echo $mrr[0]['mrr_challan'];else echo $mrr[0]['mrr_invoice'];  ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td><td>Date:<span style="text-decoration:underline;text-align: center;">&nbsp;&nbsp;<?php echo date('d-m-Y',strtotime($mrr[0]['mrr_date'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
           <tr><td colspan="6" style="width:500px;">Remarks<span style="text-decoration:underline;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($mrr[0]['mrr_remark']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
           <tr><td colspan="7"></td></tr>
           <tr><td colspan="7"></td></tr>
                <tr id="row_1">
                       
                        <th style="border-left:1px solid;border-top:1px solid;">CODE</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:200px;">ITEM NAME</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">MU</th>
                        <th style="border-left:1px solid;border-top:1px solid;">QNT</th>
                        <th style="border-left:1px solid;border-top:1px solid;">RATE</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">OTHERS COST</th>
                        <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">TOTAL  AMOUNT</th>
                        
                   
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
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"><b>Total Taka=</b></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_value)) echo $total_value;  ?></b></td>
                        </tr>  
                        <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td colspan="7"><b>Taka In Words=&nbsp;&nbsp;<?php $taka_in_word=convert_number_to_words($total_value); echo ucwords($taka_in_word);  ?>&nbsp; Only</b></td></tr>
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
                         
                       
              
        </table>
     <div style="position: fixed;bottom: 80px;text-align: center;width: 100%;">
        <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
           <tr><td style="width:190px;font-size:15px;"><span style="border-top:1px solid;">PREPARED BY</span></td><td style="width:30px;"></td><td style="width:200px;text-align: center;"><span style="border-top:1px solid;">CHECKED BY</span></td><td style="width:30px;"></td><td  style="width:200px;text-align: center;"><span style="border-top:1px solid;">AUTHORIZED BY</span></td></tr>
        </table>
    </div>   
        
    
</div>
<div class="clearfix"></div>
 