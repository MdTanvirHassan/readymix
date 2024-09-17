
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
    <p style=" text-align: center;margin-top:-2px;margin-bottom:5px;">Supplier Balance Report</p> 

    
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
          
            <thead>
                <tr></tr>
                                
                                <tr>
                                   <th style="border-left:1px solid;border-top:1px solid;width:10px;">SL</th>                      
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Supplier Name</th> 
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Paid Amount</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Total Bill</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Due</th>
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:150px;">Surplus</th>
                                </tr>
                            </thead>
                             <tbody>
                                     
                                                
                                      <?php if(!empty($suppliers)){ 
                                        $total=0;
                                        $net_bill=0;
                                        $net_due=0;
                                        $net_balance=0;
                                        
                                        $total_paid=0;
                                        $i=0;
                                        foreach($suppliers as $cust){
                                          $total_paid=$total_paid+$cust['total_paid'];
                                          $net_bill=$net_bill+$cust['total_bill'];
                                          $due=$cust['total_bill']-$cust['total_paid'];
                                          if($due>0){
                                              $net_due=$net_due+$due;
                                          }else{
                                            $net_balance=$net_balance+($cust['total_paid']-$cust['total_bill']);  
                                          }
                                          $i++;
                                                                
                                                                ?> 
                                                                    
                                                <tr>
                                                  <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $i; ?></td>


                                                  <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($cust['SUP_NAME'])) echo $cust['SUP_NAME']; ?></td>
                                                  <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($cust['total_paid'])) echo number_format($cust['total_paid'],2); ?></td>
                                                  <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($cust['total_bill'])) echo number_format($cust['total_bill'],2); ?></td>
                                                  <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if($due>0) echo number_format($due,2); ?></td>
                                                  <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if($due<0) echo number_format(($cust['total_paid']-$cust['total_bill']),2); ?></td>
                                                  
                                               </tr>
                                       <?php } ?>
                                               <tr>
                                                   <td colspan="2" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td>
                                                   <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total_paid,2); ?></b></td>
                                                   <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($net_bill,2); ?></b></td>
                                                   <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($net_due,2); ?></b></td>
                                                   <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"><b><?php echo number_format($net_balance,2); ?></b></td>
                                               </tr>

                                     <?php }else{ ?>
                                            <tr>
                                                <td colspan="9" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                            </tr>
                                     <?php } ?>
                            </tbody>
            
                            
                       
                                                                           
                                                    

        </table>
   
    
</div>
<div class="clearfix"></div>