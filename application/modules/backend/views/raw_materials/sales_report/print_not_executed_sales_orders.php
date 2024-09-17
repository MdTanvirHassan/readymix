
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
    <p style=" text-align: center;margin-top:-2px;margin-bottom:5px;">Not Executed Sales Orders</p> 

    
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
          
            <thead>
                <tr></tr>
                                
                                <tr>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">SL</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Date</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Sales Order No.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Customer Name</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Project</th>
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:150px;">Value</th>
                                </tr>
                            </thead>
                             <tbody>
                                     
                                                
                                      <?php if(!empty($orders)){
                                                           
                                                     ?>
                                                            <?php 
                                                            $i=0;
                                                            $total=0;
                                                            foreach($orders as $order){ 
                                                                $i++;
                                                                $total=$total+$order['total_amount'];
                                                                ?> 
                                                                    
                                                                     <tr>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $i; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($order['sale_order_date'])) echo date('d-m-Y',strtotime($order['sale_order_date'])); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($order['order_no'])) echo $order['order_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($order['c_name'])) echo $order['c_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($order['project_name'])) echo $order['project_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php if(!empty($order['total_amount'])) echo number_format($order['total_amount'],2); ?></td>


                                                                    </tr>
                                                            <?php } ?>
                                                                    <tr>
                                                                        <td colspan="5" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td>
                                                                        <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total,2); ?></b></td>
                                                                    </tr>
                                               
                                     <?php }else{ ?>
                                            <tr>
                                                <td colspan="6" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                            </tr>
                                     <?php } ?>
                            </tbody>
            
                            
                       
                                                                           
                                                    

        </table>
   
    
</div>
<div class="clearfix"></div>