
<style>
    #content-table{
        line-height: 18px !important;
    }
    table{
        border-collapse: collapse;
    }
    .table th{
      border: 1px solid;  
    }
    @page {
    size: auto;   /* auto is the initial value */
    margin-top: 10px;  /* this affects the margin in the printer settings */
    margin-bottom: 0;
    margin-left: 10px;
    margin-right: 10px;
}
</style>



 
<div style="padding:0" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">Karim Asphalt & Ready Mix Ltd.</h>
    <p style=" text-align: center;margin-top:-2px;margin-bottom:50px;">Receivable Summary Report</p> 

    
    
    <table style="width:100%;font-size: 15px;"  id="player_table" class="table table-striped responsive">
                               <thead>

                                <tr>  
                                        <th style="vertical-align: middle;">Product</th>
                                        <th style="vertical-align: middle;">Qnty.</th>
                                        <th style="vertical-align: middle;">Rate</th>
                                        <th style="vertical-align: middle;">Value</th>
                                        <th style="vertical-align: middle;">Total</th>                                                                                
                                </tr>
                                       
                                                               
                                </thead> 
                                <tbody>
                                    
                                    <tr>
                                        <td style="border:none;text-align:left;"><b>Opening Balance</b></td>
                                            <td style="border:none;"><?php //echo $employee['name']; ?></td>
                                            <td style="border:none;"></td>
                                            <td style="border:none;"></td>
                                            <td style="border:none;"></td>                                           
                                    </tr>
                                    <?php if(!empty($categories)){ 
                                        
                                            
                                           
                                        ?>
                                       
                                        
                                        <?php 
                                        
                                        $total_amount=0;
                                        $c=count($categories);
                                        $j=0;
                                        foreach($categories as $pro){
                                            $j++;
                                            $total_amount=$total_amount+$pro['opening_amount'];
                                            
                                            if($j==$c){
                                            ?>
                                                <tr>
                                                
                                                <td style="border:none;text-align:left;"><?php echo $pro['category_name']; ?></td>
                                                <td style="border:none;text-align:right;"><?php echo $pro['opening_qty']; ?></td>
                                                <td style="border:none;text-align:right;"><?php echo 
                                                (!empty($pro['opening_amount'])) ? round($pro['opening_amount']/$pro['opening_qty'],2) : '0.00';
                                                 ?></td>
                                                <td style="border:none;text-align:right;"><?php echo number_format($pro['opening_amount'],2); ?></td>
                                                
                                                <td style="text-align: right;border:none;"><b><?php echo number_format($total_amount,2); ?></b></td>
                                               

                                            </tr>
                                            <?php }else{ ?>
                                                <tr>
                                                    
                                                     <td style="border:none;text-align:left;"><?php echo $pro['category_name']; ?></td>
                                                     <td style="border:none;text-align:right;"><?php echo $pro['opening_qty']; ?></td>
                                                     <td style="border:none;text-align:right;"><?php echo 
                                                (!empty($pro['opening_amount'])) ? round($pro['opening_amount']/$pro['opening_qty'],2) : '0.00';
                                                 ?></td>
                                                     <td style="border:none;text-align:right;"><?php echo number_format($pro['opening_amount'],2); ?></td>
                                                     <td style="border:none;text-align:right;"><?php //echo $i; ?></td>
                                                    
                                                  

                                                </tr>
                                            <?php } ?>
                                            
                                            
                                        <?php } ?>
                                      <tr>
                                            <td style="border:none;text-align:left;"><b>Sales during the period</b></td>
                                            <td style="border:none;"><?php //echo $employee['name']; ?></td>
                                            <td style="border:none;"></td>
                                            <td style="border:none;"></td>
                                            <td style="border:none;"></td>                                           
                                      </tr>
                                        
                                       
                                      
                                      <?php 
                                        
                                        $total_amount=0;
                                        $c=count($categories);
                                        $j=0;
                                        foreach($categories as $pro){
                                            $j++;
                                            $total_amount=$total_amount+$pro['sale_amount'];
                                            
                                            if($j==$c){
                                            ?>
                                                <tr>
                                                
                                                <td style="border:none;text-align:left;"><?php echo $pro['category_name']; ?></td>
                                                <td style="border:none;text-align:right;"><?php echo $pro['sale_qty']; ?></td>
                                                <td style="border:none;text-align:right;"><?php 
                                                $sales_rate_j = !empty($pro['sale_amount']) ? number_format($pro['sale_amount']/$pro['sale_qty'],2) : '';
                                                echo $sales_rate_j; ?></td>
                                                <td style="border:none;text-align:right;"><?php echo number_format($pro['sale_amount'],2); ?></td>
                                                
                                                <td style="text-align: right;border:none;"><b><?php echo number_format($total_amount,2); ?></b></td>
                                               

                                            </tr>
                                            <?php }else{ ?>
                                                <tr>
                                                    
                                                      <td style="border:none;text-align:left;"><?php echo $pro['category_name']; ?></td>
                                                      <td style="border:none;text-align:right;"><?php echo $pro['sale_qty']; ?></td>
                                                      <td style="border:none;text-align:right;"><?php 
                                                      $sales_rate = !empty($pro['sale_amount']) ? round($pro['sale_amount']/$pro['sale_qty'],2) : '';
                                                      echo $sales_rate; ?></td>
                                                      <td style="border:none;text-align:right;"><?php echo number_format($pro['sale_amount'],2); ?></td>
                                                     <td style="border:none;text-align:right;"><?php //echo $i; ?></td>
                                                    
                                                  

                                                </tr>
                                            <?php } ?>
                                            
                                            
                                        <?php } ?>
                                      
                                      
                                      
                                                
                                     <tr>
                                         <td style="border:none;text-align:left;"><b>Total Receivable</b></td>
                                            <td style="border:none;"><?php //echo $employee['name']; ?></td>
                                            <td style="border:none;"></td>
                                            <td style="border:none;"></td>
                                            <td style="border:none;"></td>                                           
                                      </tr>
                                        
                                       
                                      
                                      <?php 
                                        
                                        $total_amount=0;
                                        $c=count($categories);
                                        $j=0;
                                        foreach($categories as $pro){
                                            $j++;
                                            $total_amount=$total_amount+$pro['receivable_amount'];
                                            
                                            if($j==$c){
                                            ?>
                                                <tr>
                                                
                                                <td style="border:none;text-align:left;"><?php echo $pro['category_name']; ?></td>
                                                <td style="border:none;text-align:right;"><?php echo $pro['receivable_qty']; ?></td>
                                                <td style="border:none;text-align:right;"><?php echo round($pro['receivable_amount']/$pro['receivable_qty'],2); ?></td>
                                                <td style="border:none;text-align:right;"><?php echo number_format($pro['receivable_amount'],2); ?></td>
                                                
                                                <td style="text-align: right;border:none;"><b><?php echo number_format($total_amount,2); ?></b></td>
                                               

                                            </tr>
                                            <?php }else{ ?>
                                                <tr>
                                                    
                                                    <td style="border:none;text-align:left;"><?php echo $pro['category_name']; ?></td>
                                                    <td style="border:none;text-align:right;"><?php echo $pro['receivable_qty']; ?></td>
                                                    <td style="border:none;text-align:right;"><?php echo round($pro['receivable_amount']/$pro['receivable_qty'],2); ?></td>
                                                    <td style="border:none;text-align:right;"><?php echo number_format($pro['receivable_amount'],2); ?></td>
                                                    <td style="border:none;text-align:right;"><?php //echo $i; ?></td>
                                                    
                                                  

                                                </tr>
                                            <?php } ?>
                                            
                                            
                                        <?php } ?>           
                                                
                                      
                                       <tr>
                                           <td style="border:none;text-align:left;"><b>Collections</b></td>
                                            <td style="border:none;"><?php //echo $employee['name']; ?></td>
                                            <td style="border:none;"></td>
                                            <td style="border:none;"></td>
                                            <td style="border:none;"></td>                                           
                                      </tr>
                                        
                                       
                                      
                                      <?php 
                                        
                                        $total_amount=0;
                                        $c=count($categories);
                                        $j=0;
                                        foreach($categories as $pro){
                                            $j++;
                                            $total_amount=$total_amount+$pro['collection_amount'];
                                            
                                            if($j==$c){
                                            ?>
                                                <tr>
                                                
                                                <td style="border:none;text-align:left;"><?php echo $pro['category_name']; ?></td>
                                                <td style="border:none;text-align:right;"><?php echo number_format($pro['collection_amount']/$sales_rate_j,2); ?></td>
                                                <td style="border:none;text-align:right;"><?php echo number_format($sales_rate_j,2); ?></td>
                                                <td style="border:none;text-align:right;"><?php echo number_format($pro['collection_amount'],2); ?></td>
                                                
                                                <td style="text-align: right;border:none;"><b><?php echo number_format($total_amount,2); ?></b></td>
                                               

                                            </tr>
                                            <?php }else{ ?>
                                                <tr>
                                                    
                                                      <td style="border:none;text-align:left;"><?php echo $pro['category_name']; ?></td>
                                                      <td style="border:none;text-align:right;"><?php echo $pro['collection_qty']; ?></td>
                                                      <td style="border:none;text-align:right;"><?php echo round($pro['collection_amount']/$pro['collection_qty'],2); ?></td>
                                                      <td style="border:none;text-align:right;"><?php echo number_format($pro['collection_amount'],2); ?></td>
                                                      <td style="border:none;text-align:right;"><?php //echo $i; ?></td>
                                                    
                                                  

                                                </tr>
                                            <?php } ?>
                                            
                                            
                                        <?php } ?>         
                                                
                                      
                                      
                                       <tr>
                                            <td style="border:none;text-align:left;"><b>Closing Balance</b></td>
                                            <td style="border:none;"><?php //echo $employee['name']; ?></td>
                                            <td style="border:none;"></td>
                                            <td style="border:none;"></td>
                                            <td style="border:none;"></td>                                           
                                      </tr>
                                        
                                       
                                      
                                      <?php 
                                        
                                        $total_amount=0;
                                        $c=count($categories);
                                        $j=0;
                                        foreach($categories as $pro){
                                            $j++;
                                            $total_amount=$total_amount+$pro['closing_amount'];
                                            
                                            if($j==$c){
                                            ?>
                                                <tr>
                                                
                                                <td style="border:none;text-align:left;"><?php echo $pro['category_name']; ?></td>
                                                <td style="border:none;text-align:right;"><?php echo number_format($pro['closing_amount']/$sales_rate_j,2); ?></td>
                                                <td style="border:none;text-align:right;"><?php echo number_format($sales_rate_j,2); ?></td>
                                                <td style="border:none;text-align:right;"><?php echo number_format($pro['closing_amount'],2); ?></td>
                                                
                                                <td style="text-align: right;border:none;"><b><?php echo number_format($total_amount,2); ?></b></td>
                                               

                                            </tr>
                                            <?php }else{ ?>
                                                <tr>
                                                    
                                                      <td style="border:none;text-align:left;"><?php echo $pro['category_name']; ?></td>
                                                      <td style="border:none;text-align:right;"><?php echo $pro['closing_qty']; ?></td>
                                                      <td style="border:none;text-align:right;"><?php echo round($pro['closing_amount']/$pro['closing_qty'],2); ?></td>
                                                      <td style="border:none;text-align:right;"><?php echo number_format($pro['closing_amount'],2); ?></td>
                                                      <td style="border:none;text-align:right;"><?php //echo $i; ?></td>
                                                    
                                                  

                                                </tr>
                                            <?php } ?>
                                            
                                            
                                        <?php } ?>         
                                                
                                                
                                       
                                    <?php }else{ ?>  
                                         <tr>
                                            <td colspan="5" style="text-align: center;">No Data Found</td>
                                        </tr>
                                    <?php } ?>    
                                </tbody>
                        </table>
   
    
</div>
<div class="clearfix"></div>