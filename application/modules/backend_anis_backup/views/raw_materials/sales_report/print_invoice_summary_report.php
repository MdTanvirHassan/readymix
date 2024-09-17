
<style>
    #content-table{
        line-height: 18px !important;
    }
    .table{
        
    }
    @page {
    size: auto;   /* auto is the initial value */
    margin-top: 10px;  /* this affects the margin in the printer settings */
    margin-bottom: 0;
}
</style>



 
<div style="padding:0" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">Karim Asphalt & Ready Mix Ltd.</h>
    <p style=" text-align: center;margin-top:-2px;margin-bottom:5px;"><?php echo $branch_info[0]['dep_description']; ?></p>
    <p style=" text-align: center;margin-top:-2px;margin-bottom:5px;">Sale Invoice Report</p> 

    
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
          
            <thead>
                <tr></tr>
                                
                                <tr>
                                   
                                   
                                            <th style="border-left:1px solid;border-top:1px solid;width:10px;">SL</th>
                                            <th style="border-left:1px solid;border-top:1px solid;width:150px;">Invoice. Date.</th>
                                            <th style="border-left:1px solid;border-top:1px solid;width:150px;">Invoice. No.</th>                                           
                                            <th style="border-left:1px solid;border-top:1px solid;width:150px;">So. No.</th>
                                            <th style="border-left:1px solid;border-top:1px solid;width:150px;">C.Name</th>
                                            <th style="border-left:1px solid;border-top:1px solid;width:150px;">Project</th> 
                                        <!--    <th>Product Type</th> -->
                                            <th style="border-left:1px solid;border-top:1px solid;width:150px;">Product Name</th> 
                                            <th style="border-left:1px solid;border-top:1px solid;width:10px;">M.U.</th>
                                            <th style="border-left:1px solid;border-top:1px solid;width:100px;">Quantity</th>  
                                            <th style="border-left:1px solid;border-top:1px solid;width:10px;">Rate</th>  
                                            <th style="border-left:1px solid;border-top:1px solid;width:100px;">Amount</th>
                                            <th style="border-left:1px solid;border-top:1px solid;width:100px;">Paid Amount</th>
                                            <th style="border-left:1px solid;border-top:1px solid;width:100px;">Due Amount</th>
                                            <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:150px;">Sales Person</th>
                                   
                                   
                                </tr>
                            </thead>
                            
            
                        <tbody>
                                    <?php if(!empty($invoices)){ 
                                        $total=0;
                                        $total_qty=0;
                                        $total_received=0;
                                        $total_due=0;
                                        $i=0;
                                        foreach($invoices as $invoice){
                                            $due=0;
                                            $total_qty=$total_qty+$invoice['total_qty'];
                                            $total=$total+$invoice['total_amount'];
                                            $total_received=$total_received+$invoice['received_amount'];
                                            $i++;
                                            
                                        ?>
                                        <tr>
                                            <td style="border-left:1px solid;border-top:1px solid;"><?php echo $i; ?></td>
                                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($invoice['sale_invoice_date'])) echo date('d-m-Y',strtotime($invoice['sale_invoice_date'])); ?></td>
                                            <td style="border-left:1px solid;border-top:1px solid;"><?php echo $invoice['inv_no']; ?></td>
                                            <td style="border-left:1px solid;border-top:1px solid;"><?php echo $invoice['order_no']; ?></td>
                                            <td style="border-left:1px solid;border-top:1px solid;"><?php echo $invoice['c_name']; ?></td>
                                            <td style="border-left:1px solid;border-top:1px solid;"><?php echo $invoice['project_name']; ?></td>
                                        <!--    <td><?php echo $invoice['category_name']; ?></td>-->
                                            <td style="border-left:1px solid;border-top:1px solid;"><?php echo $invoice['product_name']; ?></td>
                                            <td style="border-left:1px solid;border-top:1px solid;"><?php echo $invoice['mu_name']; ?></td>
                                            <td style="border-left:1px solid;border-top:1px solid;text-align: right;"><?php echo $invoice['total_qty']; ?></td>
                                            <td style="border-left:1px solid;border-top:1px solid;text-align: right;"><?php echo $invoice['unit_price']; ?></td>
                                            <td style="border-left:1px solid;border-top:1px solid;text-align: right;"><?php echo number_format($invoice['total_amount'],2); ?></td>
                                            <td style="border-left:1px solid;border-top:1px solid;text-align: right;"><?php if(!empty($invoice['received_amount'])) echo number_format($invoice['received_amount'],2); ?></td>
                                            <td style="border-left:1px solid;border-top:1px solid;text-align: right;"><?php 
                                            $due=$invoice['total_amount']-$invoice['received_amount'];
                                            $total_due=$total_due+$due;
                                            echo number_format($due,2); 
                                            ?></td>
                                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align: right;"><?php echo $invoice['name']; ?></td>
                                            
                                        </tr>
                                        <?php } ?>
                                       
                                        <tr>
                                            <td colspan="8" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;">Total</td>
                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;"><b><?php echo number_format($total_qty,2); ?></b></td>
                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;"></td>
                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;"><b><?php echo number_format($total,2); ?></b></td>
                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;"><b><?php echo number_format($total_received,2); ?></b></td>
                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: right;"><b><?php echo number_format($total_due,2); ?></b></td>
                                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;"></td>
                                        </tr>
                                      
                                    <?php }else{ ?>  
                                        <tr>
                                            <td colspan="15" style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;text-align: center;">No Data Found</td>
                                        </tr>
                                    <?php } ?>    
                                </tbody>    
                       
                                                                           
                                                    

        </table>
   
    
</div>
<div class="clearfix"></div>