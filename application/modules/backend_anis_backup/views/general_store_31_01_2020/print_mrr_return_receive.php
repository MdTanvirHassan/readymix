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
    <p style=" text-align: center;text-decoration: underline;margin-top:-15px;">Issue Section</p>
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
           <tr><td colspan="6" style="text-decoration:"><?php echo ucfirst($indent_info[0]['ipo_number']); ?> &nbsp;</td><td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:100px;"><?php echo $mrr_return_receive[0]['mrr_rr_no']; ?></td></tr>
           <tr><td colspan="6"><?php echo ucfirst($indent_info[0]['dep_description']); ?></td><td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:100px;">Date.<br><?php echo date('d-m-Y',strtotime($mrr_return_receive[0]['receive_date'])); ?></td></tr>
                <tr id="row_1">
                     
                    <th style="border-left:1px solid;border-top:1px solid;">Item Code</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:200px;">Item name </th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">MU</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">Returned Qnt</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">Receive Qnt</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">Rate</th>
                        <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Value</th>
                        
                   
                </tr>
                <?php $count=count($issue_details); $total_value=0; ?>
               <?php $i=0; foreach($mrr_return_receive_details as $mrr_return_receive_detail){ $i++;
                        $total_value=$total_value+$mrr_return_receive_detail['issue_value'];
                     ?>
                     
                      
             
                           <tr id="row_1">
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($mrr_return_receive_detail['item_code'])) echo $mrr_return_receive_detail['item_code'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($mrr_return_receive_detail['item_description'])) echo $mrr_return_receive_detail['item_description'];  ?></td>
                         
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($mrr_return_receive_detail['measurement_unit'])) echo $mrr_return_receive_detail['measurement_unit'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($mrr_return_receive_detail['return_qty'])) echo $mrr_return_receive_detail['return_qty'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($mrr_return_receive_detail['receive_qty'])) echo $mrr_return_receive_detail['receive_qty'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($mrr_return_receive_detail['unit_price'])) echo $mrr_return_receive_detail['unit_price'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php if(!empty($mrr_return_receive_detail['receive_value'])) echo $mrr_return_receive_detail['receive_value'];  ?></td>
                        </tr>  
                 
                               
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
 