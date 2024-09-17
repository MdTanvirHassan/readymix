<style>
    #content-table{
        line-height: 18px !important;
    }
    .table{
        
    }
    
</style>



 
<div style="padding:0" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">WAHID CONSTRUCTION LTD.</h>
    <p style="text-align: center;margin-top:-3px;">(A Unit Of Karim Group)</p>
    <p style="text-align: center;text-decoration: underline;margin-top:-15px;">Issue Return Receive</p>
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
           <tr><td colspan="6" style="text-decoration:"><?php echo ucfirst($issue_info[0]['issue_no']); ?> &nbsp;</td><td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:100px;"><?php echo $issue_return[0]['ir_no']; ?></td></tr>
           <tr><td colspan="6"><?php echo ucfirst($indent_info[0]['dep_description']); ?></td><td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:100px;">Date.<br><?php echo date('d-m-Y',strtotime($issue_return[0]['ir_date'])); ?></td></tr>
                <tr id="row_1">
                     
                        <th style="border-left:1px solid;border-top:1px solid;">Item Code</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:200px;">Item name </th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">MU</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">Issued Qnt</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">Receive Qnt</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">Rate</th>
                        <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Value</th>
                        
                   
                </tr>
                <?php $count=count($issue_details); $total_value=0; ?>
               <?php $i=0; foreach($issue_return_details as $issue_return_detail){ $i++;
                        $total_value=$total_value+$issue_return_detail['return_value'];
                     ?>
                    
                           <tr id="row_1">
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($issue_return_detail['item_code'])) echo $issue_return_detail['item_code'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($issue_return_detail['item_description'])) echo $issue_return_detail['item_description'];  ?></td>
                         
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($issue_return_detail['measurement_unit'])) echo $issue_return_detail['measurement_unit'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($issue_return_detail['issued_qty'])) echo $issue_return_detail['issued_qty'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($issue_return_detail['return_qty'])) echo $issue_return_detail['return_qty'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($issue_return_detail['unit_price'])) echo $issue_return_detail['unit_price'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php if(!empty($issue_return_detail['return_value'])) echo $issue_return_detail['return_value'];  ?></td>
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
 