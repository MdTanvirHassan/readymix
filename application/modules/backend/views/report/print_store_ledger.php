
<style>
    #content-table{
        line-height: 18px !important;
    }
    .table{
        
    }
    
</style>



 
<div style="padding:0" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">KARIM ASPHALT & READY MIX LTD.</h2>
    <p style=" text-align: center;margin-top:-3px;">(A Unit Of Karim Group)</p>
    <p style=" text-align: center;margin-top:-15px;">Store Ledger
        <?php
         if($report_format=='general') {
             if($item_check=='all'){
                 echo "Of  All Item";
             }else{
                 echo "Of ".$items[0]['item_name'];
             }
         }else if($report_format=='group'){
             if($item_check=='all'){
                 echo "Of  All Item Group";
             }else{
                 echo "Of ".$group_info[0]['item_group'];
             }
         }
       ?>
    </p>
   
     <?php  if(empty($report_format) || ($report_format=='general' && $item_check=="all") || $report_format=='group' ){ ?>
                  <?php if($report_format=='group' && $item_check=="all"){ ?>
                            <table class="table table-bordered table-hover table-striped" style="margin:0 auto;font-size: 12px;">
                                <thead>
                                    <tr><td colspan="33">From&nbsp;<?php echo $f_date; ?>&nbsp; To &nbsp<?php echo $to_date; ?></td><td colspan="2" style="text-align:right;"><?php echo date('d/m/Y H:i A'); ?></td></tr>
                                                    <tr>
                                                        <th style="border-left:1px solid;border-top:1px solid;" rowspan="2">Item Name</th>
                                                        <th style="border-left:1px solid;border-top:1px solid;" rowspan="2">MU</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Opening Balance</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">MRR Receive</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Return Replace </th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">General Return </th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Adjustment </th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Available Stock</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Gen. Issue</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Return</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Delivery</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Total Issue</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Closing Balance</th>

                                                    </tr>
                                                    <tr>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>
                                                       
                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>
                                                       

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th> 

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Value</th>
                                                    </tr>
                                                </thead>
                                                 <tbody>
                                                         <?php if(!empty($group)){ ?>
                                                                    <?php $count=count($group); $i=0; $j=0; foreach($group as $key1=>$grp){
                                                                        $i++;
                                                                        $j++;  
                                                                        if(empty($grp['group_items'])){
                                                                           continue; 
                                                                        }
                                                                        ?> 
                                                                                <?php if($count==$j && empty($grp['group_items']) ){ ?>
                                                                                    <tr><td colspan="32" style="text-align:left;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"><?php echo $grp['item_group'] ?></td></tr>
                                                                                <?php }else{ ?>
                                                                                      <tr><td colspan="32" style="text-align:left;border-left:1px solid;border-top:1px solid;border-right:1px solid;"><?php echo $grp['item_group'] ?></td></tr>
                                                                                <?php } ?>            
                                                                              <?php 
                                                                                $total_opening_value=0;
                                                                                $total_mrr_value=0;
                                                                                $total_return_replace_value=0;
                                                                                $total_general_return_value=0;
                                                                                $total_adjust_value=0;
                                                                                $total_availabe_value=0;
                                                                                $total_general_issue_value=0;
                                                                                $total_return_value=0;
                                                                                $total_delivery_value=0;
                                                                                $total_total_issue_value=0;
                                                                                $total_closing_value=0;
                                                                                foreach($grp['group_items'] as $key=>$data_info){  
                                                                                        $total_opening_value=$total_opening_value+$data_info['opening_value'];
                                                                                        $total_mrr_value=$total_mrr_value+$data_info['receive_value'];
                                                                                        $total_return_replace_value=$total_return_replace_value+$data_info['mrr_receive_value'];
                                                                                        $total_general_return_value=$total_general_return_value+$data_info['issue_return_value'];
                                                                                        $total_adjust_value=$total_adjust_value+$data_info['adjust_value'];
                                                                                        $total_availabe_value=$total_availabe_value+$data_info['total_rec_ret_value'];
                                                                                        $total_general_issue_value=$total_general_issue_value+$data_info['issue_value'];
                                                                                        $total_return_value=$total_return_value+$data_info['return_value'];
                                                                                        $total_delivery_value=$total_delivery_value+$data_info['delivery_value'];
                                                                                        $total_total_issue_value=$total_total_issue_value+$data_info['total_issue_value'];
                                                                                        $total_closing_value=$total_closing_value+$data_info['closing_value'];    
                                                                                    ?>
                                                                                      
                                                                                    <?php if($count==$i){ ?>
                                                                                <tr>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['item_name']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['meas_unit']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['opening_balance']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['opening_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['opening_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['receive_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['receive_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['receive_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['mrr_receive_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['mrr_receive_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['mrr_receive_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['issue_return_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_return_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_return_value']; ?></td>
                                                                                    
                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['adjust_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['adjust_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['adjust_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['total_rec_ret_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_rec_ret_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_rec_ret_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['issue_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['delivery_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['delivery_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['delivery_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['return_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['return_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['return_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['total_issue_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_issue_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_issue_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['closing_balance']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['closing_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php echo $data_info['closing_value']; ?></td>

                                                                                </tr>
                                                                        <?php }else{ ?>
                                                                                  <tr>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['item_name']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['meas_unit']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['opening_balance']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['opening_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['opening_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['receive_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['receive_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['receive_value']; ?></td>

                                                                                   <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['mrr_receive_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['mrr_receive_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['mrr_receive_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['issue_return_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_return_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_return_value']; ?></td>
                                                                                    
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['adjust_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['adjust_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['adjust_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['total_rec_ret_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_rec_ret_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_rec_ret_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['issue_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['delivery_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['delivery_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['delivery_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['return_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['return_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['return_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['total_issue_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_issue_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_issue_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['closing_balance']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['closing_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php echo $data_info['closing_value']; ?></td>

                                                                                </tr>
                                                                        <?php } ?> 
                                                                              <?php } //End Inner foreach ?>
                                                                                
                                                                                    <tr>
                                                                                       <td colspan="4" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_opening_value)) echo number_format($total_opening_value,2);else echo "-";  ?></td>
                                                                                       <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_mrr_value)) echo number_format($total_mrr_value,2);else echo "-";  ?></td>
                                                                                       <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_return_replace_value)) echo number_format($total_return_replace_value,2);else echo "-";  ?></td>
                                                                                       <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_general_return_value)) echo number_format($total_general_return_value,2);else echo "-";  ?></td>
                                                                                       <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_adjust_value)) echo number_format($total_adjust_value,2);else echo "-";  ?></td>
                                                                                       <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_availabe_value)) echo number_format($total_availabe_value,2);else echo "-";  ?></td>
                                                                                       <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_general_issue_value)) echo number_format($total_general_issue_value,2);else echo "-";  ?></td>
                                                                                       <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_delivery_value)) echo number_format($total_delivery_value,2);else echo "-";  ?></td>
                                                                                       <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_return_value)) echo number_format($total_return_value,2);else echo "-";  ?></td>
                                                                                       <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_total_issue_value)) echo number_format($total_total_issue_value,2);else echo "-";  ?></td>
                                                                                       <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;text-align:right;"><?php echo number_format(($total_availabe_value-$total_total_issue_value),2); //if(!empty($total_closing_value)) echo number_format($total_closing_value,2);else echo "-";  ?></td>
                                                                                   </tr>
                                                                              
                                                                    <?php } //End Outer foreach ?>
                                                         <?php }else{ ?>
                                                                <tr>
                                                                    <td colspan="32" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                                                </tr>
                                                         <?php } ?>
                                                </tbody>

                            </table>
                  <?php }else{ ?>
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;font-size: 12px;">
                                <thead>
                                    <tr><td colspan="30">From&nbsp;<?php echo $f_date; ?>&nbsp; To &nbsp<?php echo $to_date; ?></td><td colspan="2" style="text-align:right;"><?php echo date('d/m/Y H:i A'); ?></td></tr>
                                                    <tr>
                                                        <th style="border-left:1px solid;border-top:1px solid;" rowspan="2">Item Name</th>
                                                        <th style="border-left:1px solid;border-top:1px solid;" rowspan="2">MU</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Opening Balance</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">MRR Receive</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Return Replace </th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">General Return </th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Adjustment</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Available Stock</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Gen. Issue</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Return</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Delivery</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Total Issue</th>
                                                        <th colspan="3" style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Closing Balance</th>

                                                    </tr>
                                                    <tr>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>
                                                       
                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th> 

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                       <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                       <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Value</th>
                                                    </tr>
                                                </thead>
                                                 <tbody>
                                                         <?php if(!empty($data)){ ?>
                                                                    <?php $count=count($data); $i=0; 
                                                                    $total_opening_value=0;
                                                                    $total_mrr_value=0;
                                                                    $total_return_replace_value=0;
                                                                    $total_general_return_value=0;
                                                                    $total_adjust_value=0;
                                                                    $total_availabe_value=0;
                                                                    $total_general_issue_value=0;
                                                                    $total_return_value=0;
                                                                    $total_delivery_value=0;
                                                                    $total_total_issue_value=0;
                                                                    $total_closing_value=0;
                                                                    foreach($data as $data_info){$i++; 
                                                                            $total_opening_value=$total_opening_value+$data_info['opening_value'];
                                                                            $total_mrr_value=$total_mrr_value+$data_info['receive_value'];
                                                                            $total_return_replace_value=$total_return_replace_value+$data_info['mrr_receive_value'];
                                                                            $total_general_return_value=$total_general_return_value+$data_info['issue_return_value'];
                                                                            $total_adjust_value=$total_adjust_value+$data_info['adjust_value'];
                                                                            $total_availabe_value=$total_availabe_value+$data_info['total_rec_ret_value'];
                                                                            $total_general_issue_value=$total_general_issue_value+$data_info['issue_value'];
                                                                            $total_return_value=$total_return_value+$data_info['return_value'];
                                                                            $total_delivery_value=$total_delivery_value+$data_info['delivery_value'];
                                                                            $total_total_issue_value=$total_total_issue_value+$data_info['total_issue_value'];
                                                                            $total_closing_value=$total_closing_value+$data_info['closing_value'];
                                                                    ?> 
                                                                            <?php if($count==$i){ ?>
                                                                                <tr>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['item_name']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['meas_unit']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['opening_balance']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['opening_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['opening_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['receive_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['receive_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['receive_value']; ?></td>

                                                                                   <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['mrr_receive_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['mrr_receive_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['mrr_receive_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['issue_return_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_return_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_return_value']; ?></td>
                                                                                    
                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['adjust_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['adjust_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['adjust_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['total_rec_ret_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_rec_ret_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_rec_ret_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['issue_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['delivery_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['delivery_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['delivery_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['return_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['return_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['return_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['total_issue_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_issue_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_issue_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['closing_balance']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['closing_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php echo $data_info['closing_value']; ?></td>

                                                                                </tr>
                                                                        <?php }else{ ?>
                                                                                  <tr>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['item_name']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['meas_unit']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['opening_balance']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['opening_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['opening_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['receive_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['receive_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['receive_value']; ?></td>

                                                                                   <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['mrr_receive_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['mrr_receive_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['mrr_receive_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['issue_return_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_return_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_return_value']; ?></td>
                                                                                    
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['adjust_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['adjust_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['adjust_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['total_rec_ret_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_rec_ret_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_rec_ret_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['issue_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['delivery_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['delivery_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['delivery_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['return_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['return_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['return_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['total_issue_qty']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_issue_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_issue_value']; ?></td>

                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['closing_balance']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['closing_rate']; ?></td>
                                                                                    <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php echo $data_info['closing_value']; ?></td>

                                                                                </tr>
                                                                        <?php } ?>        
                                                                    <?php } ?>
                                                                      <tr>
                                                                            <td colspan="4" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_opening_value)) echo number_format($total_opening_value,2);else echo "-";  ?></td>
                                                                            <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_mrr_value)) echo number_format($total_mrr_value,2);else echo "-";  ?></td>
                                                                            <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_return_replace_value)) echo number_format($total_return_replace_value,2);else echo "-";  ?></td>
                                                                            <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_general_return_value)) echo number_format($total_general_return_value,2);else echo "-";  ?></td>
                                                                            <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_adjust_value)) echo number_format($total_adjust_value,2);else echo "-";  ?></td>
                                                                            <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_availabe_value)) echo number_format($total_availabe_value,2);else echo "-";  ?></td>
                                                                            <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_general_issue_value)) echo number_format($total_general_issue_value,2);else echo "-";  ?></td>
                                                                            <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_delivery_value)) echo number_format($total_delivery_value,2);else echo "-";  ?></td>
                                                                            <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_return_value)) echo number_format($total_return_value,2);else echo "-";  ?></td>
                                                                            <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php if(!empty($total_total_issue_value)) echo number_format($total_total_issue_value,2);else echo "-";  ?></td>
                                                                            <td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;text-align:right;"><?php echo number_format(($total_availabe_value-$total_total_issue_value),2); //if(!empty($total_closing_value)) echo number_format($total_closing_value,2);else echo "-";  ?></td>
                                                                    </tr>          
                                                                                
                                                         <?php }else{ ?>
                                                                <tr>
                                                                    <td colspan="32" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                                                </tr>
                                                         <?php } ?>
                                                </tbody>

                            </table>
                  <?php } ?>
     <?php }else{ ?>
                 <table class="table table-bordered table-hover table-striped" style="margin:0 auto;font-size: 12px;">
                            <thead>
                                <tr><td colspan="30">From&nbsp;<?php echo $f_date; ?>&nbsp; To &nbsp<?php echo $to_date; ?></td><td colspan="2" style="text-align:right;"><?php echo date('d/m/Y H:i A'); ?></td></tr>
                                                <tr>
                                                    <th style="border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">Date</th>
                                                 
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Opening Balance</th>
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">MRR Receive</th>
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Return Replace </th>
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">General Return </th>
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Adjustment</th>
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Available Stock</th>
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Gen. Issue</th>
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Return</th>
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Delivery</th>
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Total Issue</th>
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Closing Balance</th>

                                                </tr>
                                                <tr>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                   <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Value</th>
                                                   
                                                   <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                   <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                   <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Value</th> 

                                                   <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                   <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                   <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                   <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                   <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Value</th>

                                                   <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;">Rate</th>
                                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Value</th>
                                                </tr>
                                            </thead>
                                             <tbody>
                                                     <?php if(!empty($data)){ 
                                                         
                                                        $total_opening_value=0;
                                                        $total_mrr_value=0;
                                                        $total_return_replace_value=0;
                                                        $total_general_return_value=0;
                                                        $total_availabe_value=0;
                                                        $total_general_issue_value=0;
                                                        $total_adjust_value=0;
                                                        $total_return_value=0;
                                                        $total_delivery_value=0;
                                                        $total_total_issue_value=0;
                                                        $total_closing_value=0;
                                                        
                                                        
                                                        $total_mrr_qty=0;
                                                        $total_return_replace_qty=0;
                                                        $total_general_return_qty=0;
                                                        $total_adjust_qty=0;
                                                        
                                                        
                                                        $total_availabe_qty=0;
                                                        
                                                        $total_general_issue_qty=0;
                                                        $total_return_qty=0;
                                                        $total_delivery_qty=0;
                                                        
                                                        $total_total_issue_qty=0;
                                                         
                                                         ?>
                                                                <?php 
                                                                $count=count($data); $i=0; 
                                                                foreach($data as $data_info){
                                                                    $i++; 
                                                                
                                                                
                                                                $total_opening_value=$total_opening_value+$data_info['opening_value'];
                                                           
                                                                $total_mrr_qty=$total_mrr_qty+$data_info['receive_qty'];
                                                                $total_mrr_value=$total_mrr_value+$data_info['receive_value'];

                                                                $total_return_replace_qty=$total_return_replace_qty+$data_info['mrr_receive_qty'];
                                                                $total_return_replace_value=$total_return_replace_value+$data_info['mrr_receive_value'];

                                                                $total_general_return_qty=$total_general_return_qty+$data_info['issue_return_qty'];
                                                                $total_general_return_value=$total_general_return_value+$data_info['issue_return_value'];

                                                                $total_adjustment_qty=$total_adjustment_qty+$data_info['adjust_qty'];
                                                                $total_adjustment_value=$total_adjustment_value+$data_info['adjust_value'];

                                                                $total_availabe_qty=$total_availabe_qty+$data_info['total_rec_ret_qty'];
                                                                $total_availabe_value=$total_availabe_value+$data_info['total_rec_ret_value'];

                                                                $total_general_issue_qty=$total_general_issue_qty+$data_info['issue_qty'];
                                                                $total_general_issue_value=$total_general_issue_value+$data_info['issue_value'];

                                                                $total_return_qty=$total_return_qty+$data_info['return_qty'];
                                                                $total_return_value=$total_return_value+$data_info['return_value'];


                                                                $total_delivery_qty=$total_delivery_qty+$data_info['delivery_qty'];
                                                                $total_delivery_value=$total_delivery_value+$data_info['delivery_value'];


                                                                $total_total_issue_qty=$total_total_issue_qty+$data_info['total_issue_qty'];
                                                                $total_total_issue_value=$total_total_issue_value+$data_info['total_issue_value'];

                                                                $total_closing_value=$total_closing_value+$data_info['closing_value'];
                                                                
                                                                
                                                                
                                                                ?> 
                                                                        <?php if($count==$i){ ?>
                                                                            <tr>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;width:200px;"><?php echo $data_info['date']; ?></td>
                                                                               

                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['opening_balance']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['opening_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['opening_value']; ?></td>

                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['receive_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['receive_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['receive_value']; ?></td>

                                                                               <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['mrr_receive_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['mrr_receive_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['mrr_receive_value']; ?></td>

                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['issue_return_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['issue_return_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['issue_return_value']; ?></td>
                                                                                
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['adjust_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['adjust_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['adjust_value']; ?></td>

                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['total_rec_ret_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['total_rec_ret_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['total_rec_ret_value']; ?></td>

                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['issue_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['issue_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['issue_value']; ?></td>

                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['delivery_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['delivery_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['delivery_value']; ?></td>

                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['return_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['return_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['return_value']; ?></td>

                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"><?php echo $data_info['total_issue_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['total_issue_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['total_issue_value']; ?></td>

                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['closing_balance']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['closing_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;text-align:right;"><?php echo $data_info['closing_value']; ?></td>

                                                                            </tr>
                                                                    <?php }else{ ?>
                                                                              <tr>
                                                                                <td style="border-left:1px solid;border-top:1px solid;width:200px;"><?php echo $data_info['date']; ?></td>
                                                                               

                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['opening_balance']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['opening_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['opening_value']; ?></td>

                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['receive_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['receive_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['receive_value']; ?></td>

                                                                               <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['mrr_receive_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['mrr_receive_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['mrr_receive_value']; ?></td>

                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['issue_return_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_return_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_return_value']; ?></td>
                                                                                
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['adjust_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['adjust_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['adjust_value']; ?></td>
                                                                                

                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['total_rec_ret_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_rec_ret_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_rec_ret_value']; ?></td>

                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['issue_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['issue_value']; ?></td>

                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['delivery_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['delivery_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['delivery_value']; ?></td>

                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['return_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['return_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['return_value']; ?></td>

                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['total_issue_qty']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_issue_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['total_issue_value']; ?></td>

                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['closing_balance']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php echo $data_info['closing_rate']; ?></td>
                                                                                <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php echo $data_info['closing_value']; ?></td>

                                                                            </tr>
                                                                    <?php } ?>        
                                                                <?php } ?>
                                                                <tr>
                                                           <td colspan="4" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;"><b>Total</b></td>
                                                            <!--
                                                            <td style="text-align:right;"><b><?php if(!empty($total_opening_value)) //echo  number_format($total_opening_value,2);else echo "-";  ?></b></td>
                                                            <td style="text-align:right;"><b><?php if(!empty($total_opening_value)) //echo  number_format($total_opening_value,2);else echo "-";  ?></b></td>
                                                            <td style="text-align:right;"><b><?php if(!empty($total_opening_value)) echo  number_format($total_opening_value,2);else echo "-";  ?></b></td>
                                                            -->
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_mrr_qty)) echo number_format($total_mrr_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_mrr_qty)) echo number_format($total_mrr_value/$total_mrr_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_mrr_value)) echo number_format($total_mrr_value,2);else echo "-";  ?></b></td>
                                                              
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_return_replace_qty)) echo number_format($total_return_replace_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_return_replace_qty)) echo number_format($total_return_replace_value/$total_return_replace_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_return_replace_value)) echo number_format($total_return_replace_value,2);else echo "-";  ?></b></td>
                                                            
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_general_return_qty)) echo number_format($total_general_return_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_general_return_qty)) echo number_format($total_general_return_value/$total_general_return_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_general_return_value)) echo number_format($total_general_return_value,2);else echo "-";  ?></b></td>
                                                            
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_adjustment_qty)) echo number_format($total_adjustment_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_adjustment_qty)) echo number_format($total_adjustment_value/$total_adjustment_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_adjustment_value)) echo number_format($total_adjustment_value,2);else echo "-";  ?></b></td>
                                                            
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_availabe_qty)) echo number_format($total_availabe_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_availabe_qty)) echo number_format($total_availabe_value/$total_availabe_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_availabe_value)) echo number_format($total_availabe_value,2);else echo "-";  ?></b></td>
                                                            
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_general_issue_qty)) echo number_format($total_general_issue_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_general_issue_qty)) echo number_format($total_general_issue_value/$total_general_issue_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_general_issue_value)) echo number_format($total_general_issue_value,2);else echo "-";  ?></b></td>
                                                            
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_delivery_qty)) echo number_format($total_delivery_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_delivery_qty)) echo number_format($total_delivery_value/$total_delivery_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_delivery_value)) echo number_format($total_delivery_value,2);else echo "-";  ?></b></td>
                                                            
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_return_qty)) echo number_format($total_return_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_return_qty)) echo number_format($total_return_value/$total_return_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_return_value)) echo number_format($total_return_value,2);else echo "-";  ?></b></td>
                                                            
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_total_issue_qty)) echo number_format($total_total_issue_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_total_issue_qty)) echo number_format($total_total_issue_value/$total_total_issue_qty,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_total_issue_value)) echo number_format($total_total_issue_value,2);else echo "-";  ?></b></td>
                                                            
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_closing_value)) //echo number_format($total_closing_value,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_closing_value)) //echo number_format($total_closing_value,2);else echo "-";  ?></b></td>
                                                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_closing_value)) //echo number_format($total_closing_value,2);else echo "-";  ?></b></td>
                                                        </tr>              
                                                                            
                                                                            
                                                     <?php }else{ ?>
                                                            <tr>
                                                                <td colspan="32" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                                            </tr>
                                                     <?php } ?>
                                            </tbody>

                        </table>
     <?php } ?>
  
        
    
</div>
<div class="clearfix"></div>