<style>
     @page {
        size: auto;   /* auto is the initial value */
        margin-top: 20px;  /* this affects the margin in the printer settings */
        margin-bottom: 0;
    }
    #content-table{
        line-height: 18px !important;
    }
    .table{
        
    }
    
</style>



 
<div style="padding:50" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">KARIM ASPHALT & READY MIX LTD.</h>
    <p style=" text-align: center;margin-top:-3px;">(A Unit Of Karim Group)</p>
    <p style=" text-align: center;text-decoration: underline;margin-top:-7px;">DELIVERY ORDER</p>
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
           <tr>
               <td colspan="5" style="text-align:left;">D.O. No.: <?php echo ucfirst($delivery_order_info[0]['delivery_no']); ?></td>
               <td colspan="2" style="text-align:left;">Date: <?php  echo date('d-m-Y',strtotime($delivery_order_info[0]['delivery_order_date'])); ?></td>
           </tr>
           <tr>
               <td colspan="5" style="text-align:left;">S.O. No.: <?php echo ucfirst($delivery_order_info[0]['order_no']); ?></td>
               <td colspan="2" style="text-align:left;">Date: <?php  echo date('d-m-Y',strtotime($delivery_order_info[0]['sale_order_date'])); ?></td>
           </tr>
           <tr>
               <td colspan="5" style="text-align:left;">Customer Name: <?php echo ucfirst($delivery_order_info[0]['c_name']); ?></td>
               <td colspan="2" style="text-align:left;">Project Name: <?php  echo $delivery_order_info[0]['project_name']; ?></td>
           </tr>
           <tr>
               <td colspan="5" style="text-align:left;">Customer Address: <?php echo ucfirst($delivery_order_info[0]['billing_address']); ?></td>
               <td colspan="2" style="text-align:left;">Project Address: <?php  echo $delivery_order_info[0]['shipping_address']; ?></td>
           </tr>
           <tr>
               <td colspan="5" style="text-align:left;">Contact Person: <?php echo ucfirst($delivery_order_info[0]['attention']); ?></td>
               <td colspan="2" style="text-align:left;">Contact No.: <?php  echo $delivery_order_info[0]['phone']; ?></td>
           </tr>
         
          
          
           <tr><td colspan="7"></td></tr>
           <tr><td colspan="7"></td></tr>
                <tr id="row_1">
                       
                        <th style="border-left:1px solid;border-top:1px solid;width:200px;">PRODUCT NAME</th>
                        <th style="border-left:1px solid;border-top:1px solid;">PERFORMANCE</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">MU</th>
                        <th style="border-left:1px solid;border-top:1px solid;">QNT</th>
                        <th style="border-left:1px solid;border-top:1px solid;">RATE</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:150px;">VALUE</th>
                        <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:200px;">REMARK</th>
                        
                   
                </tr>
                <?php $count=count($delivery_order_details_info); $total_value=0; ?>
               <?php $i=0; foreach($delivery_order_details_info as $delivery_order_details){ $i++;
                        $total_value=$total_value+$delivery_order_details['amount'];
                     ?>
                    
                           <tr id="row_1">
                            
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($delivery_order_details['product_name'])) echo $delivery_order_details['product_name'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($delivery_order_details['performance'])) echo $delivery_order_details['performance'];  ?></td>
                         
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($delivery_order_details['measurement_unit'])) echo $delivery_order_details['measurement_unit'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($delivery_order_details['quantity'])) echo $delivery_order_details['quantity'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($delivery_order_details['unit_price'])) echo $delivery_order_details['unit_price'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($delivery_order_details['amount'])) echo $delivery_order_details['amount'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php if(!empty($delivery_order_details['remark'])) echo $delivery_order_details['remark'];  ?></td>
                        </tr>  
                  <?php // } ?>      
                               
               <?php } ?>
                        <tr id="row_1">
                            
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"><b>Total Taka=</b></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_value)) echo $total_value;  ?></b></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;text-align:right;"></td>
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
       <tr><td style="width:190px;font-size:15px;margin-left:0px;"><span style="border-top:1px solid;">PREPARED BY</span></td><td style="width:0px;"></td><td style="width:190px;text-align: center;"><span style="border-top:1px solid;">CHECKED BY</span></td><td style="width:30px;"></td><td  style="width:200px;text-align: center;"><span style="border-top:1px solid;">AUTHORIZED BY</span></td></tr>
    </table>
    </div>
        
    
</div>
<div class="clearfix"></div>
 