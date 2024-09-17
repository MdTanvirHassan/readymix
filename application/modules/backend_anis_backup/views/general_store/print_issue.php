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
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
           <tr><td colspan="6" style="text-decoration:">Indent No:<span style="text-decoration:underline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($indent_info[0]['ipo_number']); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td><td >Issue No:<span style="text-decoration: underline;text-align: center;">&nbsp;&nbsp;<?php echo $issue[0]['issue_no']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
           <tr><td colspan="6">Project:<span style="text-decoration:underline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($indent_info[0]['dep_description']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td><td >Date:<span style="text-decoration: underline;text-align: center;">&nbsp;&nbsp;&nbsp;<?php echo date('d-m-Y',strtotime($issue[0]['issue_date'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
           <tr><td></td></tr>
           <tr><td></td></tr>
                <tr id="row_1">
                     
                    <th style="border-left:1px solid;border-top:1px solid;">Item Code</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:200px;">Item name </th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">MU</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">Indent Qnt</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">Issue Qnt</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">Rate</th>
                        <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:150px;">Value</th>
                        
                   
                </tr>
                <?php $count=count($issue_details); $total_value=0; ?>
               <?php $i=0; foreach($issue_details as $issue_detail){ $i++;
                        $total_value=$total_value+$issue_detail['issue_value'];
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
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($issue_detail['item_code'])) echo $issue_detail['item_code'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($issue_detail['item_name_des'])) echo $issue_detail['item_name_des'];  ?></td>
                         
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($issue_detail['issue_m_unit'])) echo $issue_detail['issue_m_unit'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($issue_detail['indent_qty'])) echo $issue_detail['indent_qty'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($issue_detail['issue_quality'])) echo $issue_detail['issue_quality'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($issue_detail['issue_unit_price'])) echo $issue_detail['issue_unit_price'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php if(!empty($issue_detail['issue_value'])) echo $issue_detail['issue_value'];  ?></td>
                        </tr>  
                  <?php // } ?>      
                               
               <?php } ?>
                        <tr id="row_1">
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: center;"><b>Total Taka=</b></td>
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
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
        <tr><td style="width:100px;font-size:15px;">MANAGER</td><td style="width:80px;">DGM(A&F)</td><td style="width:100px;text-align: center;">CFO</td><td style="width:100px;text-align: center;">SR E.D</td><td style="width:100px;text-align: center;">DIRECTOR</td><td  style="width:200px;text-align: center;">M. DIRECTOR</td></tr>
    </table>
        
    
</div>
<div class="clearfix"></div>
 