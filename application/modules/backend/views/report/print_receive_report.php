
<style>
    #content-table{
        line-height: 18px !important;
    }
    .table{
        
    }
    
</style>



 
<div style="padding:0" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">WAHID CONSTRUCTIONS LTD.</h>
     <p style=" text-align: center;margin-top:-2px;margin-bottom:-5px;">(A Unit of Karim Group)</p> 

    <p style=" text-align: center;margin-top:-2px;">Receive Report</p> 
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
           <?php if($report_format=="general" || $report_format=="project" || $report_format=="assets"){ ?>
                                <?php if(!empty($report_type) && $report_type=="summary" ){   ?>
            <thead>
                <tr><td colspan="16">FROM &nbsp;<?php echo $f_date; ?>&nbsp; TO &nbsp<?php echo $to_date; ?></td></tr>
                                <tr>
                                    
                                    <th style="border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">Item Name</th>
                                    <th style="border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">MU</th>
                                    
                                    <th colspan="2" style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:300px;">Receive</th>
                                    
                                </tr>
                                <tr>
                                    <th style="border-left:1px solid;border-top:1px solid;width:150px;">Qnt</th>
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:150px;">Value</th>
                                </tr>
                            </thead>
                             <tbody>
                                     
                                                
                                      <?php if(!empty($data)){
                                                             $total_receive_qty=0;
                                                            $total_receive_value=0;
                                                     ?>
                                                            <?php 

                                                            foreach($data as $data_info){ 
                                                                $total_receive_qty=$total_receive_qty+$data_info['receive_qty'];
                                                                $total_receive_value=$total_receive_value+$data_info['receive_value'];
                                                                ?> 
                                                                    
                                                                     <tr>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['item_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['meas_unit']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $data_info['receive_qty']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php echo $data_info['receive_value']; ?></td>


                                                                    </tr>
                                                            <?php } ?>
                                                           <tr><td colspan="2" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: center;"><?php echo $total_receive_qty; ?></td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;text-align: right;"><?php echo $total_receive_value; ?></td></tr>         
                                               
                                     <?php }else{ ?>
                                            <tr>
                                                <td colspan="16" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                            </tr>
                                     <?php } ?>
                            </tbody>
            <?php } else{ ?>  
                            
                           <thead>
                               
                                <tr><td colspan="16">FROM &nbsp;<?php echo $f_date; ?>&nbsp; TO &nbsp<?php echo $to_date; ?></td></tr>
                                <tr>
                                     <th style="border-left:1px solid;border-top:1px solid;width:200px;"  rowspan="2">Date</th>
                                    <th style="border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">Item Name</th>
                                    <th style="border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">MU</th>
                                    
                                    <th colspan="2" style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:300px;">Receive</th>
                                    
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
                                                                $total_receive_qty=$total_receive_qty+$data_info['receive_qty'];
                                                                $total_receive_value=$total_receive_value+$data_info['total_cost'];
                                                                ?> 
                                                                    <tr>
                                                                        
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo date('d-m-Y',strtotime($data_info['receive_date'])); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['item_description']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['measurement_unit']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['receive_qty']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align: right;"><?php echo $data_info['total_cost']; ?></td>
                                                                        
                                                                    </tr>
                                                            <?php } ?>
                                                                      <tr><td colspan="3" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: center;"><?php echo $total_receive_qty; ?></td><td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;text-align: right;"><?php echo $total_receive_value; ?></td></tr>         
                                                     
                                                 <?php }else{ ?>
                                            <tr>
                                                <td colspan="16" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                            </tr>
                                     <?php } ?>
                            </tbody>  
                            
            <?php } ?>    
            <?php }else if($report_format=="mrr"){  ?>
                                           <thead>
                                               <tr><td colspan="2">ALL MRR</td><td colspan="6">FROM &nbsp;<?php echo $f_date; ?>&nbsp; TO &nbsp<?php echo $to_date; ?></td><td style="text-align:right;"><?php echo date('d/m/Y H:i A'); ?></td></tr>
                                                                <tr>
                                                                    <th style="border-left:1px solid;border-top:1px solid;">MRR No.</th>
                                                                    <th style="border-left:1px solid;border-top:1px solid;">Date</th>
                                                                    <th style="border-left:1px solid;border-top:1px solid;">Supplier Name</th>
                                                                    <th style="border-left:1px solid;border-top:1px solid;">Item Code</th>
                                                                    <th style="border-left:1px solid;border-top:1px solid;width:300px;">Item Name</th>
                                                                    <th style="border-left:1px solid;border-top:1px solid;">MU</th>
                                                                    <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                                    <th style="border-left:1px solid;border-top:1px solid;">U.Price</th>
                                                                    <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:150px;">Value</th>
                                                                    


                                                                </tr>
                                                               
                                                            </thead>
                                                             <tbody>
                                                                     <?php if(!empty($data)){
                                                                                
                                                                         ?>
                                                                                <?php 
                                                                                $count=count($data);
                                                                                $j=0;

                                                                                foreach($data as $data_info){ $j++;
                                                                                    $total_receive_qty=0;
                                                                                    $total_receive_value=0;
                                                                                    $i=0;
                                                                                    foreach($data_info['mrr_items'] as $mrr_item){ $i++;
                                                                                        $total_receive_value=$total_receive_value+$mrr_item['total_cost'];
                                                                                    ?> 
                                                                                         <?php if($i==1){ ?>
                                                                                                    <?php if($j==$count){ ?>
                                                                                                        <tr>
                                                                                                            <td style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;" ><?php echo $mrr_item['mrr_no']; ?></td>
                                                                                                            <td style="border-top:1px solid;border-bottom:1px solid;" ><?php echo $mrr_item['receive_date']; ?></td>
                                                                                                            <td style="border-top:1px solid;border-bottom:1px solid;text-align:center;" ><?php echo $mrr_item['SUP_NAME']; ?></td>
                                                                                                            <td style="text-align: right;border-top:1px solid;border-bottom:1px solid;"><?php echo $mrr_item['item_code']; ?></td>
                                                                                                            <td style="border-top:1px solid;border-bottom:1px solid;width:300px;"><?php echo $mrr_item['item_description']; ?></td>
                                                                                                            <td style="border-top:1px solid;border-bottom:1px solid;"><?php echo $mrr_item['measurement_unit']; ?></td>
                                                                                                            <td style="text-align: center;border-top:1px solid;border-bottom:1px solid;"><?php echo $mrr_item['receive_qty']; ?></td>
                                                                                                            <td style="text-align: right;border-top:1px solid;border-bottom:1px solid;"><?php echo $mrr_item['unit_price']; ?></td>
                                                                                                            <td style="text-align: right;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;width:150px;"><?php echo $mrr_item['total_cost']; ?></td>


                                                                                                        </tr>
                                                                                                    <?php }else{ ?>  
                                                                                                         <tr>
                                                                                                            <td style="border-top:1px solid;border-left:1px solid;" ><?php echo $mrr_item['mrr_no']; ?></td>
                                                                                                            <td style="border-top:1px solid;" ><?php echo $mrr_item['receive_date']; ?></td>
                                                                                                            <td style="border-top:1px solid;text-align:center;" ><?php echo $mrr_item['SUP_NAME']; ?></td>
                                                                                                            <td style="text-align: right;border-top:1px solid;"><?php echo $mrr_item['item_code']; ?></td>
                                                                                                            <td style="border-top:1px solid;width:300px;"><?php echo $mrr_item['item_description']; ?></td>
                                                                                                            <td style="border-top:1px solid;"><?php echo $mrr_item['measurement_unit']; ?></td>
                                                                                                            <td style="text-align: center;border-top:1px solid;"><?php echo $mrr_item['receive_qty']; ?></td>
                                                                                                            <td style="text-align: right;border-top:1px solid;"><?php echo $mrr_item['unit_price']; ?></td>
                                                                                                            <td style="text-align: right;border-top:1px solid;border-right:1px solid;width:150px;"><?php echo $mrr_item['total_cost']; ?></td>


                                                                                                        </tr>
                                                                                                    <?php } ?>    
                                                                                         <?php }else{ ?>    
                                                                                                 <tr>
                                                                                                    
                                                                                                    <td class="top" colspan="4" style="text-align: right;border-left:1px solid;"><?php echo $mrr_item['item_code']; ?></td>
                                                                                                    <td class="top"  ><?php echo $mrr_item['item_description']; ?></td>
                                                                                                    <td class="top" ><?php echo $mrr_item['measurement_unit']; ?></td>
                                                                                                    <td class="top" style="text-align: center;"><?php echo $mrr_item['receive_qty']; ?></td>
                                                                                                    <td class="top" style="text-align: right;"><?php echo $mrr_item['unit_price']; ?></td>
                                                                                                    <td class="top" style="text-align: right;border-right:1px solid;"><?php echo $mrr_item['total_cost']; ?></td>


                                                                                                </tr>
                                                                                         <?php } ?>
                                                                                  <?php }  ?>
                                                                                               <?php if($i>1){ ?>
                                                                                                      <?php if($j==$count){ ?>
                                                                                                            <tr><td colspan="5" style="text-align: right;border-top:1px solid;border-right:1px solid;border-left:1px solid;border-bottom:1px solid;">Total</td><td style="text-align: right;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;" colspan="4"><?php echo $total_receive_value; ?></td></tr> 
                                                                                                      <?php }else{ ?>
                                                                                                             <tr><td colspan="5" style="text-align: right;border-top:1px solid;border-right:1px solid;border-left:1px solid;">Total</td><td style="text-align: right;border-top:1px solid;border-right:1px solid;" colspan="4"><?php echo $total_receive_value; ?></td></tr> 
                                                                                                      <?php } ?>
                                                                                                <?php } ?>  
                                                                                 <?php } ?>      
                                                                     <?php }else{ ?>
                                                                            <tr>
                                                                                <td colspan="9" style="text-align:center;">No Data Found</td>
                                                                            </tr>
                                                                     <?php } ?>
                                                            </tbody>                  
                            <?php }else{ ?>
                                    <thead>
                                                                <tr><td colspan="2">ALL SUPPLIER</td><td colspan="5">FROM &nbsp;<?php echo $f_date; ?>&nbsp; TO &nbsp<?php echo $to_date; ?></td><td style="text-align:right;"><?php echo date('d/m/Y H:i A'); ?></td></tr>
                                                                <tr>
                                                                   
                                                                    <th style="border-left:1px solid;border-top:1px solid;">Date</th>
                                                                    <th style="border-left:1px solid;border-top:1px solid;">Supplier Name</th>
                                                                    <th style="border-left:1px solid;border-top:1px solid;">Item Code</th>
                                                                    <th style="border-left:1px solid;border-top:1px solid;width:300px;">Item Name</th>
                                                                    <th style="border-left:1px solid;border-top:1px solid;">MU</th>
                                                                    <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                                    <th style="border-left:1px solid;border-top:1px solid;">U.Price</th>
                                                                    <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:150px;">Value</th>
                                                                    


                                                                </tr>
                                                               
                                                            </thead>
                                                             <tbody>
                                                                     <?php if(!empty($data)){
                                                                                
                                                                         ?>
                                                                                <?php 
                                                                                $count=count($data);
                                                                                $j=0;
                                                                                foreach($data as $data_info){ $j++;
                                                                                    $total_receive_qty=0;
                                                                                    $total_receive_value=0;
                                                                                    $i=0;
                                                                                    
                                                                                    foreach($data_info['mrr_items'] as $mrr_item){ $i++;
                                                                                        $total_receive_value=$total_receive_value+$mrr_item['total_cost'];
                                                                                    ?> 
                                                                                         <?php if($i==1){ ?>
                                                                                                <?php if($j==$count){ ?>
                                                                                                        <tr>
                                                                                                            
                                                                                                            <td style="border-top:1px solid;border-bottom:1px solid;border-left:1px solid;" ><?php echo $mrr_item['receive_date']; ?></td>
                                                                                                            <td style="border-top:1px solid;border-bottom:1px solid;text-align:center;" ><?php echo $mrr_item['SUP_NAME']; ?></td>
                                                                                                            <td style="text-align: right;border-top:1px solid;border-bottom:1px solid;"><?php echo $mrr_item['item_code']; ?></td>
                                                                                                            <td style="border-top:1px solid;border-bottom:1px solid;width:300px;"><?php echo $mrr_item['item_description']; ?></td>
                                                                                                            <td style="border-top:1px solid;border-bottom:1px solid;"><?php echo $mrr_item['measurement_unit']; ?></td>
                                                                                                            <td style="text-align: center;border-top:1px solid;border-bottom:1px solid;"><?php echo $mrr_item['receive_qty']; ?></td>
                                                                                                            <td style="text-align: right;border-top:1px solid;border-bottom:1px solid;"><?php echo $mrr_item['unit_price']; ?></td>
                                                                                                            <td style="text-align: right;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;width:15px;"><?php echo $mrr_item['total_cost']; ?></td>


                                                                                                        </tr>
                                                                                                    <?php }else{ ?>  
                                                                                                         <tr>
                                                                                                            
                                                                                                            <td style="border-top:1px solid;border-left:1px solid;" ><?php echo $mrr_item['receive_date']; ?></td>
                                                                                                            <td style="border-top:1px solid;text-align:center;" ><?php echo $mrr_item['SUP_NAME']; ?></td>
                                                                                                            <td style="text-align: right;border-top:1px solid;"><?php echo $mrr_item['item_code']; ?></td>
                                                                                                            <td style="border-top:1px solid;width:300px;"><?php echo $mrr_item['item_description']; ?></td>
                                                                                                            <td style="border-top:1px solid;"><?php echo $mrr_item['measurement_unit']; ?></td>
                                                                                                            <td style="text-align: center;border-top:1px solid;"><?php echo $mrr_item['receive_qty']; ?></td>
                                                                                                            <td style="text-align: right;border-top:1px solid;"><?php echo $mrr_item['unit_price']; ?></td>
                                                                                                            <td style="text-align: right;border-top:1px solid;border-right:1px solid;width:150px;"><?php echo $mrr_item['total_cost']; ?></td>


                                                                                                        </tr>
                                                                                                    <?php } ?>    
                                                                                               
                                                                                         <?php }else{ ?>    
                                                                                                 <tr>
                                                                                                    
                                                                                                   <td class="top" colspan="3" style="text-align: right;border-left:1px solid;"><?php echo $mrr_item['item_code']; ?></td>
                                                                                                    <td class="top"  ><?php echo $mrr_item['item_description']; ?></td>
                                                                                                    <td class="top" ><?php echo $mrr_item['measurement_unit']; ?></td>
                                                                                                    <td class="top" style="text-align: center;"><?php echo $mrr_item['receive_qty']; ?></td>
                                                                                                    <td class="top" style="text-align: right;"><?php echo $mrr_item['unit_price']; ?></td>
                                                                                                    <td class="top" style="text-align: right;border-right:1px solid;width:150px;"><?php echo $mrr_item['total_cost']; ?></td>


                                                                                                </tr>
                                                                                         <?php } ?>
                                                                                  <?php }  ?>
                                                                                                <?php if($i>1){ ?>
                                                                                                      <?php if($j==$count){ ?>
                                                                                                            <tr><td colspan="4" style="text-align: right;border-top:1px solid;border-right:1px solid;border-left:1px solid;border-bottom:1px solid;">Total</td><td style="text-align: right;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;" colspan="4"><?php echo $total_receive_value; ?></td></tr> 
                                                                                                      <?php }else{ ?>
                                                                                                             <tr><td colspan="4" style="text-align: right;border-top:1px solid;border-right:1px solid;border-left:1px solid;">Total</td><td style="text-align: right;border-top:1px solid;border-right:1px solid;" colspan="4"><?php echo $total_receive_value; ?></td></tr> 
                                                                                                      <?php } ?>
                                                                                                <?php } ?>  
                                                                                 <?php } ?>      
                                                                     <?php }else{ ?>
                                                                            <tr>
                                                                                <td colspan="8" style="text-align:center;">No Data Found</td>
                                                                            </tr>
                                                                     <?php } ?>
                                                            </tbody>                                           
                            <?php } ?>                                              

        </table>
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
        
    </table>
        
    
</div>
<div class="clearfix"></div>