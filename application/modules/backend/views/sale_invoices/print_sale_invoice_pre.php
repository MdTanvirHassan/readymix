<style>
/*     @page {
        size: auto;    auto is the initial value 
        margin-top: 20px;   this affects the margin in the printer settings 
        margin-bottom: 0;
    }*/

    #content-table{
        line-height: 18px !important;
    }
    table{
  border-collapse: collapse;
  
}
table tr th{
    background: #eee;
}
table tr td, table tr th{
    padding: 1px 5px;
}
/*@page { 
    size: 100%;
    margin-top:20mm;
}*/
 @media print {
    #page_header {
    position: fixed; 
  width: 100%; 
  top:0; 
  left: 0; 
  right: 0;
  

    }
   
    
#page_content table { page-break-after:avoid; }
#page_content tr    { page-break-inside:avoid; page-break-after:auto }
#page_content thead { display:table-header-group }
#page_content tfoot { display:table-footer-group }
    
}
    
</style>




<!--<div style="padding:50px; width:60%; margin: 0 auto">-->

   
    <div id="page_header">
       <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;"><img style="width: 120px;margin-top: -12px;position: absolute;margin-left: -160px;" src="<?php echo site_url('images/kmix.jpg')?>"> <span>KARIM ASPHALT & READY MIX LTD.</span> </h2>
    <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">(A Unit Of Karim Group)</p> 
    <hr>
    </div>       
    
<div id="page_content">
    <p style=" text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 30px;">SALES INVOICE</p>
    
    <p style="width:70%;float:left"><b>Inv. No.: <?php echo ucfirst($sale_invoice_info[0]['inv_no']); ?></b><br><br>
    S.O. No.: <?php echo ucfirst($sale_invoice_info[0]['order_no']); ?><br>
Date: <?php  echo date('d-m-Y',strtotime($sale_invoice_info[0]['sale_order_date'])); ?>
    </p>
     <div style="float:right;width:30%;">
         <b style="position: absolute;right: 13px;">Date: <?php  echo date('d-m-Y',strtotime($sale_invoice_info[0]['sale_invoice_date'])); ?></b><br><br>
     <div style="border:1px solid;padding: 10px">
         <b>Project Name: <?php echo $sale_invoice_info[0]['project_name']; ?></b><br>
         <b></b>
     </div>
     </div>
   <div style="clear: both;"></div>  
   <div style="margin-bottom:30px;">
       To<br>
Managing Director<br>
<?php echo ucfirst($sale_invoice_info[0]['c_name']); ?><br>
<?php echo $sale_invoice_info[0]['billing_address']; ?><br><br>
<b>Attention: <?php echo $sale_invoice_info[0]['attention']; ?></b><br><br>
<b>Subject: Sales Invoice for Supplied Readymix Concrete</b><br><br>
Dear Sir,<br>
We are very much pleased to submit our sales invoice for RM which are detailed below:
   </div>
    
     
      <div style="clear: both;"></div>
      
      
    <table class="table table-bordered table-hover table-striped" border="1" style="width:100%;text-align: center;margin-bottom: 20px;">
           
           
         
          
          
           
               <tr>
                      <th>CHALLAN NO.</th> 
                    <th>PRODUCT NAME</th>
                    <th>PERFORMANCE</th>
                    <th>MU</th>
                    <th >QUANTITY</th>
                    <th >RATE</th>
                    <th>VALUE (BDT)</th>
                   
                        
                        
                        
                        
                   
                </tr>
             <?php $count=count($sale_invoice_details_info); $total_value=0; ?>
                <?php $i=0; foreach($sale_invoice_details_info as $sale_invoice_details){ $i++;
                        $cub_m=0;
                        $cub_m=round($sale_invoice_details['quantity']*35.31,2);
                        $total_value=$total_value+$sale_invoice_details['amount'];
                     ?>
                <tr>
                   <td> 
                        <?php echo $sale_invoice_details['dc_no']; ?>
                   </td>
                   <td> 
                        <?php echo $sale_invoice_details['product_name']; ?>
                   </td>
                   <td>
                        <?php if(!empty($sale_invoice_details['performance'])) echo $sale_invoice_details['performance']; ?>
                   </td>
                   <td>
                        <?php if(!empty($sale_invoice_details['measurement_unit'])) echo $sale_invoice_details['measurement_unit']; ?>
                   </td>
                 
                   <td style="text-align:right;">
                        <?php if(!empty($sale_invoice_details['quantity'])) echo $sale_invoice_details['quantity']; ?>
                   </td>
                   
                   <td style="text-align:right;">
                        <?php if(!empty($sale_invoice_details['unit_price'])) echo $sale_invoice_details['unit_price']; ?>
                   </td>
                   
                   <td style="text-align:right;">
                        <?php if(!empty($sale_invoice_details['amount'])) echo $sale_invoice_details['amount']; ?>
                   </td>
                   
                   
                   
                        
                 </tr>
          <?php } ?>
               <tr>
                    <td colspan="6" style="text-align:right">Sub Total <br> (-) Discount </td>
                    <td style="text-align:right"><?php if (!empty($sale_invoice_info[0]['total_amount'])) echo $sale_invoice_info[0]['total_amount']; ?> <br> </td>
                   
                        
                 </tr>
                <tr>
                    <td colspan="6" style="text-align:right"><b>Total Amount:</b> </td>
                    <td style="text-align:right"><b><?php if (!empty($sale_invoice_info[0]['total_amount'])) echo $sale_invoice_info[0]['total_amount']; ?></b></td>
                   
                        
                 </tr>
                <tr>
                    <td colspan="8" style="text-align:left"><b>Taka In Words=<?php $taka_in_word=convert_number_to_words($total_value); echo ucwords($taka_in_word);  ?>&nbsp; Taka Only 
                           </b></td>
                    
                   
                        
                 </tr>
                        
     </table>     
      
        
     
    
    
     
    <div style="clear: both;"></div>
    <div style="position: fixed;bottom: 30px;text-align: center;width:100%">
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
       <tr>
           <td style="width:20%;font-size:15px;"><span style="border-top:1px solid;">PREPARED BY</span></td>
           
           <td style="width:20%;text-align: center;"><span style="border-top:1px solid;">CHECKED BY</span></td>
           
           <td  style="width:20%;text-align: right;"><span style="border-top:1px solid;">STORE IN-CHARGE</span></td></tr>
    </table>
        
         
    </div>
    <div style="clear: both;"></div>
   
    
</div>

 