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



 
<div style="padding:30" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">KARIM ASPHALT & READY MIX LTD.</h>
    <p style=" text-align: center;margin-top:-3px;">(A Unit Of Karim Group)</p>
    <p style=" text-align: center;text-decoration: underline;margin-top:-7px;">SALES INVOICE</p>
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
            <tr>
               <td colspan="4" style="text-align:left;">Inv. No.: <?php echo ucfirst($sale_invoice_info[0]['inv_no']); ?></td>
               <td colspan="3" style="text-align:left;width:200px;"><span style="text-decoration:underline;">Project Name:</span> <?php  echo $sale_invoice_info[0]['project_name']; ?></td>
           </tr>
             <tr>
               <td colspan="4" style="text-align:left;">Date: <?php  echo date('d-m-Y',strtotime($sale_invoice_info[0]['sale_invoice_date'])); ?></td>
               <td colspan="3" style="text-align:left;width:200px;"><span style="text-decoration:underline;">Project Address:</span> <?php  echo $sale_invoice_info[0]['shipping_address']; ?></td>
           </tr>
           <tr>
               <td colspan="4" style="text-align:left;">S.O. No.: <?php echo ucfirst($sale_invoice_info[0]['order_no']); ?></td>
               <td colspan="3" style="text-align:left;width:200px;"></td>
           </tr>
           
          
           <tr>
               <td colspan="4" style="text-align:left;">Date: <?php  echo date('d-m-Y',strtotime($sale_invoice_info[0]['sale_order_date'])); ?></td>
               <td colspan="3" style="text-align:left;width:200px;"></td>
           </tr>
           
           
           <tr>
               <td colspan="4" style="text-align:left;"><span style="text-decoration:underline;">Customer Name:</span> <?php echo ucfirst($sale_invoice_info[0]['c_name']); ?></td>
               <td colspan="3" style="text-align:left;width:200px;"></td>
           </tr>
           <tr>
               <td colspan="4" style="text-align:left;"><span style="text-decoration:underline;">Customer Address:</span> <?php echo ucfirst($sale_invoice_info[0]['billing_address']); ?></td>
               <td colspan="3" style="text-align:left;width:200px;"></td>
           </tr>
           <!--
            <tr><td colspan="6" style="text-decoration:">Inv. No.<span style="text-decoration:underline;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($sale_invoice_info[0]['inv_no']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td><td  >Date:<span style="text-decoration:underline;text-align: center;">&nbsp;&nbsp;<?php  echo date('d-m-Y',strtotime($sale_invoice_info[0]['sale_invoice_date'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
            <tr><td colspan="7" style="text-decoration:">S.O. No.<span style="text-decoration:underline;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($sale_invoice_info[0]['order_no']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
            <tr><td colspan="7" style="text-decoration:">Customer's Name<span style="text-decoration:underline;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($sale_invoice_info[0]['c_name']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
            <tr><td colspan="7" style="text-decoration:">Customer's Address<span style="text-decoration:underline;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($sale_invoice_info[0]['billing_address']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
            <tr><td colspan="7" style="text-decoration:">Project's Name<span style="text-decoration:underline;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($sale_invoice_info[0]['project_name']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
            <tr><td colspan="7" style="text-decoration:">Project's Address<span style="text-decoration:underline;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($sale_invoice_info[0]['shipping_address']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
          
          -->
          
           <tr><td colspan="7"></td></tr>
           <tr><td colspan="7"></td></tr>
           <tr><td colspan="7"></td></tr>
           <tr><td colspan="7"></td></tr>
                <tr id="row_1">
                        <th style="border-left:1px solid;border-top:1px solid;" rowspan="2">CHALLAN NO</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:200px;" rowspan="2">PRODUCT NAME</th>
                        <th style="border-left:1px solid;border-top:1px solid;" rowspan="2">PERFORMANCE</th>
                      
                        <th style="border-left:1px solid;border-top:1px solid;" colspan="2" style="width:300px;">QNTY</th>
                        <th style="border-left:1px solid;border-top:1px solid;"rowspan="2" style="width:200px;">RATE<br>(Per Cft)</th>
                        <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:200px;" rowspan="2" style="width:100px;">VALUE(BDT)</th>
                            
                </tr>
                <tr>
                    <th style="border-left:1px solid;border-top:1px solid;" >CU. M.</th>
                    <th style="border-left:1px solid;border-top:1px solid;" >CFT</th>
                </tr>
                <?php $count=count($sale_invoice_details_info); $total_value=0; ?>
               <?php $i=0; foreach($sale_invoice_details_info as $sale_invoice_details){ $i++;
                        $cub_m=0;
                        $cub_m=round($sale_invoice_details['quantity']/35.31,2);
                        $total_value=$total_value+$sale_invoice_details['amount'];
                     ?>
                    
                           <tr id="row_1">
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($sale_invoice_details['dc_no'])) echo $sale_invoice_details['dc_no'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($sale_invoice_details['product_name'])) echo $sale_invoice_details['product_name'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($sale_invoice_details['performance'])) echo $sale_invoice_details['performance'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($sale_invoice_details['quantity'])) echo $sale_invoice_details['quantity'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($sale_invoice_details['quantity'])) echo round(($sale_invoice_details['quantity']*35.31),2);  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($sale_invoice_details['unit_price'])) echo round(($sale_invoice_details['unit_price']/35.31),2);  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php if(!empty($sale_invoice_details['amount'])) echo $sale_invoice_details['amount'];  ?></td>
                            
                        </tr>  
                  <?php // } ?>      
                               
               <?php } ?>
                        <tr id="row_1">
                            
                           
                            <td style="border-top:1px solid;text-align:right;" colspan="6"><b>Total:</b></td>     
                            <td style="border-top:1px solid;text-align:right;"><b><?php if (!empty($sale_invoice_info[0]['total_amount'])) echo $sale_invoice_info[0]['total_amount']; ?></b></td>
                        </tr>  
                        
                        <tr id="row_1">    
                            <td style="text-align:right;" colspan="6"><b>Paid:</b></td>     
                            <td style="text-align:right;"><b><?php if (!empty($sale_invoice_info[0]['received_amount'])) echo $sale_invoice_info[0]['received_amount']; ?></b></td>
                        </tr>  
                        
                         <tr id="row_1">    
                            <td style="text-align:right;" colspan="6"><b>Due:</b></td>     
                            <td style="text-align:right;"><b><?php echo ($sale_invoice_info[0]['total_amount']-$sale_invoice_info[0]['received_amount']); ?></b></td>
                        </tr>  
                        
                        
                        <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td colspan="7"><b>Taka In Words=&nbsp;&nbsp;<?php $taka_in_word=convert_number_to_words($total_value); echo ucwords($taka_in_word);  ?>&nbsp; Only</b></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         
                         <tr><td colspan="7"> </td></tr>
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
 