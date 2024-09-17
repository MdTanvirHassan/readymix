<style>
@page {
         
       margin-top:0px;   
        
    }

    #content-table{
        line-height: 18px !important;
        font-size: 13px;
    }
    table{
  border-collapse: collapse;
  
}
table tr th{
    background: #eee;
    
}
#maintable tr th,#maintable tr td{
    
    font-size: 12px;
}
table tr td, table tr th{
    padding: 1px 5px;
}



/*@page:left{
  @bottom-left {
    counter-increment: page;
    content: "Page " counter(pageNumber) " of " counter(pageNumber);
  }
}*/


 @media print {
   /* #header, .header-space{
  height: 250px;
}

.footer, .footer-space {
  height: 100px;
}
#header {
  position: fixed;
  top: 0;
  width:100%;
/*  text-align: center;*/
}
.footer {
  position: fixed;
  bottom: -60px;;
} */



 
 }
 

  .pageNumber {
     position: relative;
     height: auto;
     min-height:10px;
     width: 590px;
     display: block;
     background: rgba(60, 60, 60, 0.28) !important;
     margin: 0 auto 5px;
     page-break-before: always; /*This style rule makes every page element start at the top of a new page:*/
     counter-increment:pages;
    }
   /*page numbers*/
   div.pageNumber:after {
     content: " PAGE - " counter(pages);
     position: absolute;
     bottom: 0px;
     right: 15px;
     z-index: 999;
     padding: 2px 12px;
     border-right: 2px solid #23b8e7;
     font-size: 12px;
    } 
   @media print {
    a[href]:after {
        content: none !important;
    }
}

</style>
<div id="header">
       <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;"><img style="width: 120px;margin-top: -12px;position: absolute;margin-left: -160px;" src="<?php echo site_url('images/kmix.jpg')?>"> <span>KARIM ASPHALT & READY MIX LTD.</span> </h2>
    <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">(A Unit of Karim Group)</p> 
    <hr>
    <div style="">
                  <h1 style="text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size:18px;">SALES INVOICE</h1> 
                  <b style="text-decoration: underline;position: absolute;right:15px;top: 109px;">SL : <?php echo !empty($sl) ? $sl[0]['sl'] : $sale_invoice_info[0]['inv_id']; ?></b>
              </div>
    <div style="clear: both;"></div> 
    <div style="width:100%;">
                   <div style="width:56%;float:left"><b>INV. NO : <?php echo ucfirst($sale_invoice_info[0]['inv_no']); ?></b><br><br>
    S.O. No.: <?php echo ucfirst($sale_invoice_info[0]['order_no']); ?><br>

Date: <?php  echo date('d-m-Y',strtotime($sale_invoice_info[0]['sale_order_date'])); ?>
    </div>
     <div style="float:right;width:40%;text-align:right;margin-right:10px;">
         <b style="position: right;">
             
             Date: <?php  echo date('d-m-Y',strtotime($sale_invoice_info[0]['sale_invoice_date'])); ?></b><br><br>
     <div style="border:1px solid;padding: 10px;">
         <b>Project Name: <?php echo $sale_invoice_info[0]['project_name']; ?></b>
         
     </div>
     </div>   
                  </div>
    </div>

<table style="width:100%;">
  <thead><tr><td>
    <div class="header-space">&nbsp;</div>
  </td></tr></thead>
  <tbody><tr><td>
              <div class="page-content">
                  
                  
    
   <div style="clear: both;"></div>  
   <div style="margin-bottom:15px;">
       To<br>
Managing Director<br>
<?php echo ucfirst($sale_invoice_info[0]['c_name']); ?><br>
    <?php echo $sale_invoice_info[0]['billing_address']; ?><br><br>
    <b>Attention: <?php echo $sale_invoice_info[0]['attention']; ?></b><br><br>
  <!--  <b>Subject: Sales Invoice for Supplied Readymix Concrete</b><br><br> -->
  <b>Subject: Sales Invoice for Supplied Pump</b><br><br>
Dear Sir,<br>
We are very much pleased to submit our sales invoice for <?php echo $sale_invoice_details_info[0]['short_name']; ?> which are detailed below:
   </div>
    
     
      <div style="clear: both;"></div>
      <table id="maintable" class="table table-bordered table-hover table-striped"  style="width:100%;text-align: center;margin-bottom: 10px;">
           
           
         
          
          
           
               <tr style="border-bottom:2px solid#000">
                    <th>Service Name <sup style='color:red'>*</sup></th>
                    <th>M. Unit</th>
                    <th>Quantity</th>              
                    <th>Unit Price</th>
                    <th>Amount</th>
                   
                        
                        
                        
                        
                   
                </tr>
             <?php $count=count($sale_invoice_details_info); $total_value=0; ?>
                
                   
                   
                   <?php $i=0; foreach($sale_invoice_details_info as $sale_order_details){ 
                        $i++;
                        ?>
                        <tr class="" id="row_<?php echo $i; ?>">
                           <td><?php echo $sale_order_details['service_name'] ?></td>
                           <td><?php echo $sale_order_details['mu_name'] ?></td>
                           <td style="text-align:right;"><?php echo $sale_order_details['quantity'] ?></td>
                           <td style="text-align:right;"><?php echo $sale_order_details['unit_price'] ?></td>    
                           <td style="text-align:right;"><?php echo $sale_order_details['amount'] ?></td>
                          

                        </tr>
                   <?php } ?>

                   
                   
                   
                        
                
               <tr style="border-top:2px solid#000">
                    <td colspan="4" style="text-align:right">Sub Total </td>
                    
                    <td style="text-align:right"><?php if (!empty($sale_invoice_info[0]['total_amount'])) echo number_format($sale_invoice_info[0]['total_amount'],2); ?> <br> </td>
                   
                        
                 </tr>
              
                 <tr>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                 </tr>
                <tr style="">
                    <td colspan="2" style="text-align:left;margin-top: 20px"><b>Taka In Words = <?php  $taka_in_word=convert_number_to_words(round($sale_invoice_info[0]['total_amount'],2)); echo ucwords($taka_in_word);  ?>&nbsp;Taka Only 
                           </b></td>
                    <td colspan="2" style="text-align:right;margin-top: 20px"><b>Total Amount:</b> </td>
                    <td style="text-align:right;margin-top: 20px"><b><?php if (!empty($sale_invoice_info[0]['total_amount'])) echo number_format($sale_invoice_info[0]['total_amount'],2); ?></b></td>
                   
                        
                 </tr>

                        
     </table>  
              </div>
  </td></tr></tbody>
  <tfoot><tr><td>
    <div class="footer-space">&nbsp;</div>
  </td></tr></tfoot>
</table>





   
           
    

    
      
      
        
      
        
     
    
    
     
    <div style="clear: both;"></div>
    <div class="footer">
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
       <tr>
           <td style="width:20%;font-size:15px;"><span style="border-top:1px solid;">PREPARED BY</span></td>
           
           <td style="width:20%;text-align: center;"><span style="border-top:1px solid;"></span></td>
           
           <td  style="width:10%;text-align: right;"><span style="border-top:1px solid;">VETTED BY</span></td></tr>
    </table>
        
        <!--<div class="pageNumber"></div>-->
    </div>
    
    
   
    


 