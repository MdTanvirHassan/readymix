
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
table  { border-collapse: collapse; width: 100%; }
                    th, td { padding: 1px; }
                    th     { background:#eee; }
                    table, th, td {
                        border: 1px solid black;
                        font-size: 12px;
                    }
</style>



 
<div style="padding:0" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">Karim Asphalt & Ready Mix Ltd.</h>
    <p style=" text-align: center;margin-top:-2px;margin-bottom:5px;">Honored Cheque/PO/BG</p> 

    
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
          
            <thead>
                <tr></tr>
                                
                                <tr>
                                   <th style="border-left:1px solid;border-top:1px solid;width:10px;">SL</th>                      
                                   <th style="border-left:1px solid;border-top:1px solid;width:300px;">Customer Name</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:80px;">Product Type</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Collection Method</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:40px;">Pdc/Lc/Bg No.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Deposit Date</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Disonor Date 1</th>
                                            <th style="border-left:1px solid;border-top:1px solid;width:150px;">Disonor Date 2</th>
                                            <th style="border-left:1px solid;border-top:1px solid;width:150px;">Disonor Times</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Realization Date</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:230px;">Bank</th>
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:100px;">Value</th>
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
                                                                $total=$total+$order['amount'];
                                                                ?> 
                                                                    
                                                                     <tr>
                                                                       <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $i; ?></td>
                                                                        
                                                                       
                                                                       <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($order['c_name'])) echo $order['c_name']; ?></td>
                                                                       <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($order['category_name'])) echo $order['category_name']; ?></td>
                                                                       <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($order['collection_method'])) echo $order['collection_method']; ?></td>
                                                                       
                                                                       <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($order['no'])) echo $order['no']; ?></td>
                                                                       <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($order['deposit_date'])) echo date('d-m-Y',strtotime($order['deposit_date'])); ?></td>
                                                                       <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($order['dishonored1'])) echo date('d-m-Y',strtotime($order['dishonored1'])); ?></td>
                                                                       <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($order['dishonored2'])) echo date('d-m-Y',strtotime($order['dishonored2'])); ?></td>
                                                                       <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($order['dishonored_times'])) echo $order['dishonored_times']; ?></td>
                                                                       <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($order['realization_date'])) echo date('d-m-Y',strtotime($order['realization_date'])); ?></td>      
                                                                       <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($order['b_name'])) echo $order['b_name'].'('.$order['branch_name'].')'; ?></td>
                                                                       <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php if(!empty($order['amount'])) echo number_format($order['amount'],2); ?></td>


                                                                    </tr>
                                                            <?php } ?>
                                                                    <tr>
                                                                        <td colspan="8" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td>
                                                                        <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"><?php echo number_format($total,2); ?></td>
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