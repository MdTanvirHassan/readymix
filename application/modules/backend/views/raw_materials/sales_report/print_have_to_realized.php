
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
    <p style=" text-align: center;margin-top:-2px;margin-bottom:5px;">Cheque/PO/BG  In Hand To Be Realized</p> 

    
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
          
            <thead>
                <tr></tr>
                                
                                <tr>
                                   <th style="border-left:1px solid;border-top:1px solid;width:10px;">SL</th>
                                  
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Customer Name</th>
                                 
                                   <th style="border-left:1px solid;border-top:1px solid;width:40px;">Pdc/Lc/Bg No.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Pdc/Lc/Bg Date</th>
                                  
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Bank</th>
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
                                                                       
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($order['no'])) echo $order['no']; ?></td>
                                                                        <?php if($order['collection_method']="Pdc"){ ?>
                                                                           <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($order['check_date'])) echo date('d-m-Y',strtotime($order['check_date'])); ?></td>
                                                                         
                                                                       <?php }else if($order['collection_method']="Po"){ ?>
                                                                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($order['po_date'])) echo date('d-m-Y',strtotime($order['po_date'])); ?></td>
                                                                         
                                                                       <?php }else if($order['collection_method']="Lc"){ ?>
                                                                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($order['lc_date'])) echo date('d-m-Y',strtotime($order['lc_date'])); ?></td>
                                                                            <td style="border-left:1px solid;border-top:1px solid;"><?php //if(!empty($order['lc_date'])) echo date('d-m-Y',strtotime($order['lc_date'])); ?></td>
                                                                       <?php }else if($order['collection_method']="Bg"){ ?>
                                                                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($order['bg_issue_date'])) echo date('d-m-Y',strtotime($order['bg_issue_date'])); ?></td>
                                                                            <td style="border-left:1px solid;border-top:1px solid;"><?php //if(!empty($order['bg_issue_date'])) echo date('d-m-Y',strtotime($order['bg_issue_date'])); ?></td>
                                                                       <?php } ?>       
                                                                       <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($order['b_name'])) echo $order['b_name'].'('.$order['branch_name'].')'; ?></td>
                                                                       <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php if(!empty($order['amount'])) echo number_format($order['amount'],2); ?></td>


                                                                    </tr>
                                                            <?php } ?>
                                                                    <tr>
                                                                        <td colspan="5" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td>
                                                                        <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"><?php echo number_format($total,2); ?></td>
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