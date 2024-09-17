
<style>
    #content-table{
        line-height: 18px !important;
    }
    .table{
        
    }
    @page {
    size: auto;   /* auto is the initial value */
    margin-top:0px;  /* this affects the margin in the printer settings */
    margin-bottom: 0;
}
</style>



 
<div style="padding-top:30px;" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">Karim Asphalt & Ready Mix Ltd.</h>
    <p style=" text-align: center;margin-top:0px;margin-bottom:5px;"><?php echo $branch_info[0]['dep_description']; ?></p> 
    <p style=" text-align: center;margin-top:-5px;margin-bottom:5px;">All Sales Orders</p> 

    
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
          
            <thead>
                <tr><td colspan="9">FROM &nbsp;<?php echo $f_date; ?>&nbsp; TO &nbsp<?php echo $to_date; ?></td></tr>
                <tr></tr>
                                
                                <tr>
                                   <th style="border-left:1px solid;border-top:1px solid;width:20px;">SL</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">Date</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">Order No.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Customer Name</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Project</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">Product Name</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">M.U.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Qnty</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Unit Price</th>
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:150px;">Value</th>
                                </tr>
                            </thead>
                             <tbody>
                                     
                                                
                                      <?php if(!empty($orders)){
                                                           
                                                     ?>
                                                            <?php 
                                                            $i=0;
                                                            $total=0;
                                                            $total_qty=0;
                                                            foreach($orders as $order){ 
                                                                $i++;
                                                                if($order['product_name']!='Grouting'){
                                                                    $total_qty=$total_qty+$order['quantity'];
                                                                    $total=$total+$order['amount'];
                                                                }
                                                                ?> 
                                                                    
                                                                     <tr>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $i; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($order['sale_order_date'])) echo date('d-m-Y',strtotime($order['sale_order_date'])); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($order['order_no'])) echo $order['order_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($order['c_name'])) echo $order['c_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($order['project_name'])) echo $order['project_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($order['product_name'])) echo $order['product_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($order['measurement_unit'])) echo $order['measurement_unit']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($order['quantity'])) echo number_format($order['quantity'],2); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($order['unit_price'])) echo number_format($order['unit_price'],2); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php if(!empty($order['amount'])) echo number_format($order['amount'],2); ?></td>


                                                                    </tr>
                                                            <?php } ?>
                                                                    <tr>
                                                                        <td colspan="7" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td>
                                                                        <td  style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total_qty,2); ?></b></td>
                                                                         <td  style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"></td>
                                                                         <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total,2); ?></b></td>
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