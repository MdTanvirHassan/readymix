
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
   
     <?php  if(empty($report_format) || ($report_format=='general' && $item_check=="all") || $report_format=='group' ){ ?>
                        <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
            <thead>
                <tr><td colspan="3" style="text-align: left;"> <?php  if(empty($report_format) || ($report_format=='general' && $item_check=="all") || $report_format=='group' ) echo '[Store Ledger]';else echo $items[0]['item_name'].'('.$items[0]['meas_unit'].')'  ?></td><td colspan="27">From&nbsp;<?php echo $f_date; ?>&nbsp; To &nbsp<?php echo $to_date; ?></td><td colspan="2" style="text-align:right;"><?php echo date('d/m/Y H:i A'); ?></td></tr>
                                <tr>
                                    <th style="border-left:1px solid;border-top:1px solid;" rowspan="2">Item Name</th>
                                    <th style="border-left:1px solid;border-top:1px solid;" rowspan="2">MU</th>
                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Opening Balance</th>
                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">MRR Receive</th>
                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Return Replace </th>
                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">General Return </th>
                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Available Stock</th>
                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">General</th>
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
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Value</th>
                                </tr>
                            </thead>
                             <tbody>
                                     <?php if(!empty($data)){ ?>
                                                <?php $count=count($data); $i=0; foreach($data as $data_info){$i++; ?> 
                                                        <?php if($count==$i){ ?>
                                                            <tr>
                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['item_name']; ?></td>
                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['meas_unit']; ?></td>
                                                                
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

                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['total_issue_qty']; ?></td>
                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['total_issue_rate']; ?></td>
                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['total_issue_value']; ?></td>

                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['closing_balance']; ?></td>
                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><?php echo $data_info['closing_rate']; ?></td>
                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;text-align:right;"><?php echo $data_info['closing_value']; ?></td>

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
                                     <?php }else{ ?>
                                            <tr>
                                                <td colspan="32" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                            </tr>
                                     <?php } ?>
                            </tbody>

        </table>
     <?php }else{ ?>
                 <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                            <thead>
                                <tr><td colspan="3" style="text-align: left;"> <?php  if(empty($report_format) || ($report_format=='general' && $item_check=="all") || $report_format=='group' ) echo '[Store Ledger]';else echo $items[0]['item_name'].'('.$items[0]['meas_unit'].')'  ?></td><td colspan="27">From&nbsp;<?php echo $f_date; ?>&nbsp; To &nbsp<?php echo $to_date; ?></td><td colspan="2" style="text-align:right;"><?php echo date('d/m/Y H:i A'); ?></td></tr>
                                                <tr>
                                                    <th style="border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">Date</th>
                                                 
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Opening Balance</th>
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">MRR Receive</th>
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Return Replace </th>
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">General Return </th>
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">Available Stock</th>
                                                    <th colspan="3" style="border-left:1px solid;border-top:1px solid;">General</th>
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
                                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Value</th>
                                                </tr>
                                            </thead>
                                             <tbody>
                                                     <?php if(!empty($data)){ ?>
                                                                <?php $count=count($data); $i=0; foreach($data as $data_info){$i++; ?> 
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
