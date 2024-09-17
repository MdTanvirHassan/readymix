
<style>
    #content-table{
        line-height: 18px !important;
    }
    .table{
        
    }
    
</style>



 
<div style="padding:0" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">KARIM ASPHALT & READY MIX LTD.</h>
    <h3 style=" font-size:18px;text-align: center;"><?php echo $branch_info[0]['dep_description']; ?></h3>
    <p style=" text-align: center;text-decoration: underline;">Consumption Report</p>
    <?php if(!empty($cost_center_info)){ ?>
        <p style=" text-align: center;text-decoration: underline;"><?php echo $cost_center_info[0]['c_c_name']; ?></p>
    <?php } ?>
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
            <?php if(!empty($report_type) && $report_type=="summary" ){   ?>
            <thead>
                <tr><td colspan="16"><?php echo $f_date; ?>&nbsp; To &nbsp<?php echo $to_date; ?></td></tr>
                                <tr>
                                    
                                    <th style="border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">Item Name</th>
                                    <th style="border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">Category Name</th>
                                    <th style="border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">Cost Center</th>
                                    <th style="border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">MU</th>
                                    
                                    <th colspan="2" style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:300px;">Issue</th>
                                    
                                </tr>
                                <tr>
                                    <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Value</th>
                                </tr>
                            </thead>
                             <tbody>
                                     
                                                
                                      <?php if(!empty($data)){
                                                            $total_receive_qty=0;
                                                            $total_receive_value=0;
                                                     ?>
                                                            <?php 

                                                            foreach($data as $data_info){ 
                                                                $total_receive_qty=$total_receive_qty+$data_info['issue_qty'];
                                                                $total_receive_value=$total_receive_value+$data_info['issue_value'];
                                                                ?> 
                                                                    <tr>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['item_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['group_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['c_c_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['meas_unit']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:right;;"><?php echo $data_info['issue_qty']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align: right;"><?php echo $data_info['issue_value']; ?></td>


                                                                    </tr>
                                                            <?php } ?>
                                                                    <tr><td colspan="4" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;"><b><?php echo number_format($total_receive_qty,2); ?></b></td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;text-align: right;"><b><?php echo number_format($total_receive_value,2); ?></b></td></tr>         
                                               
                                     <?php }else{ ?>
                                            <tr>
                                                <td colspan="16" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                            </tr>
                                     <?php } ?>
                            </tbody>
            <?php } else{ ?>  
                            
                           <thead>
                                <tr><td colspan="16"><?php echo $f_date; ?>&nbsp; To &nbsp<?php echo $to_date; ?></td></tr>
                                <tr>
                                    <th style="border-left:1px solid;border-top:1px solid;width:200px;"  rowspan="2">Date</th>
                                    <th style="border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">Item Name</th>
                                    <th style="border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">Category Name</th>
                                    <th style="border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">Cost Center</th>
                                    <th style="border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">MU</th>
                                    
                                    <th colspan="2" style="border-left:1px solid;border-top:1px solid;width:300px;">Issue</th>
                                    <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:200px;" rowspan="2">Remarks</th>
                                </tr>
                                <tr>
                                    <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Value</th>
                                </tr>
                            </thead>
                             <tbody>
                                     
                                                
                                      <?php if(!empty($data)){
                                                            $total_receive_qty=0;
                                                            $total_receive_value=0;
                                                     ?>
                                                            <?php 

                                                            foreach($data as $data_info){ 
                                                                $total_receive_qty=$total_receive_qty+$data_info['consumption_quantity'];
                                                                $total_receive_value=$total_receive_value+$data_info['amount'];
                                                                ?> 
                                                                    <tr>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo date('d-m-Y',strtotime($data_info['consumption_date'])); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['item_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['group_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['c_c_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['meas_unit']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: right;"><?php echo number_format($data_info['consumption_quantity'],2); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: right;"><?php echo number_format($data_info['amount'],2); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: center;border-right:1px solid;"><?php if(isset($data_info['remarks'])) echo $data_info['remarks']; ?></td>


                                                                    </tr>
                                                            <?php } ?>
                                                                    <tr><td colspan="5" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;"><b><?php echo number_format($total_receive_qty,2); ?></b></td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total_receive_value,2); ?></b></td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;"></td></tr>         
                                                     
                                                 <?php }else{ ?>
                                            <tr>
                                                <td colspan="16" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                            </tr>
                                     <?php } ?>
                            </tbody>  
                            
            <?php } ?>                

        </table>
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
        
    </table>
        
    
</div>
<div class="clearfix"></div>