
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
    <p style=" text-align: center;margin-top:-2px;margin-bottom:5px;">Customer Balance Report</p> 

    
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
          
            <thead>
                <tr></tr>
                                
                                <tr>
                                   <th style="border-left:1px solid;border-top:1px solid;width:10px;">SL</th>                      
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Customer Name</th> 
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Adjustment</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Vat</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Ait</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Payment Received</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Total Deposit</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Total Bill</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Pending Bill</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Due</th>
                                   
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:150px;">Surplus</th>
                                </tr>
                            </thead>
                             <tbody>
                                     
                                                
                                      <?php if(!empty($customers)){ 
                                        $total=0;
                                        $net_bill=0;
                                        $net_due=0;
                                        $net_balance=0;
                                        
                                        $total_adj=0;
                                        $total_vat=0;
                                        $total_ait=0;
                                        $total_payment_received=0;
                                        $net_total_pending_bill=0;
                                        
                                        $i=0;
                                        foreach($customers as $cust){
                                            $i++;
                                            
                                            $total_adj=$total_adj+$cust['adjustment'];
                                            $total_vat=$total_vat+$cust['vat'];
                                            $total_ait=$total_ait+$cust['ait'];
                                            $total_payment_received=$total_payment_received+$cust['payment_received'];
                                            
                                            $total=$total+$cust['deposit'];
                                            $net_bill=$net_bill+$cust['total_bill'];
                                            $net_total_pending_bill=$net_total_pending_bill+$cust['total_pending_bill'];
                                            $due=($cust['total_bill']+$cust['total_pending_bill'])-$cust['deposit'];
                                            if($due>0){
                                                $net_due=$net_due+$due;
                                            }else{
                                              $net_balance=$net_balance+($cust['deposit']-($cust['total_bill']+$cust['total_pending_bill']));  
                                            }
                                                                
                                                                ?> 
                                                                    
                                                <tr>
                                                  <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $i; ?></td>


                                                  <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($cust['c_name'])) echo $cust['c_name']; ?></td>
                                                  <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($cust['adjustment'])) echo number_format($cust['adjustment'],2); ?></td>
                                                  <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($cust['vat'])) echo number_format($cust['vat'],2); ?></td>
                                                  <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($cust['ait'])) echo number_format($cust['ait'],2); ?></td>
                                                  <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($cust['payment_received'])) echo number_format($cust['payment_received'],2); ?></td>
                                                  
                                                  <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($cust['deposit'])) echo number_format($cust['deposit'],2); ?></td>
                                                  <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($cust['total_bill'])) echo number_format($cust['total_bill'],2); ?></td>
                                                  <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($cust['total_pending_bill'])) echo number_format($cust['total_pending_bill'],2); ?></td>

                                                  <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if($due>0) echo number_format($due,2); ?></td>
                                                <?php if($due<0){ ?>  
                                                  <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php echo number_format(($cust['deposit']-$cust['total_bill']),2); ?></td>
                                                <?php }else{ ?>  
                                                  <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"></td>
                                                <?php } ?>

                                               </tr>
                                       <?php } ?>
                                               <tr>
                                                   <td colspan="2" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td>
                                                   <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total_adj,2); ?></b></td>
                                                   <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total_vat,2); ?></b></td>
                                                   <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total_ait,2); ?></b></td>
                                                   <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total_payment_received,2); ?></b></td>
                                                   
                                                   <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total,2); ?></b></td>
                                                   <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($net_bill,2); ?></b></td>
                                                   <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($net_total_pending_bill,2); ?></b></td>
                                                   <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($net_due,2); ?></b></td>
                                                   <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"><b><?php echo number_format($net_balance,2); ?></b></td>
                                               </tr>

                                     <?php }else{ ?>
                                            <tr>
                                                <td colspan="10" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                            </tr>
                                     <?php } ?>
                            </tbody>
            
                            
                       
                                                                           
                                                    

        </table>
   
    
</div>
<div class="clearfix"></div>