
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
    <p style=" text-align: center;margin-top:-2px;margin-bottom:5px;">Total Receive</p> 

    
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
          
            <thead>
                <tr></tr>
                                
                                <tr>
                                   <th style="border-left:1px solid;border-top:1px solid;width:10px;">SL</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:300px;">Receive Date</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:300px;">Customer Name</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:80px;">MRR NO.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:80px;">Product Type</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Mode of Payment</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:40px;">Pdc/Lc/Bg No.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Remark</th>
                                   
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:100px;">Value</th>
                                </tr>
                            </thead>
                             <tbody>
                                     
                                                
                                      <?php if(!empty($collections)){
                                                           
                                                     ?>
                                                            <?php 
                                                            $i=0;
                                                            $total=0;
                                                             foreach($collections as $collection){
                                                                $i++;
                                                                $total=$total+$collection['amount'];
                                                                ?> 
                                                                    
                                                                     <tr>
                                                                       <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $i; ?></td>
                                                                        
                                                                       
                                                                       
                                                                       <?php if($collection['collection_method']=="Cash" || $collection['collection_method']=="O.Cash"){ ?>   
                                                                        <td style="border-left:1px solid;border-top:1px solid;">
                                                                            <?php if(!empty($collection['receive_date'])) echo date('d-m-Y',strtotime($collection['receive_date'])); ?>
                                                                        </td>
                                                                      <?php }else{ ?>
                                                                        <td style="border-left:1px solid;border-top:1px solid;">
                                                                            <?php if(!empty($collection['realization_date'])) echo date('d-m-Y',strtotime($collection['realization_date'])); ?>
                                                                        </td>    
                                                                     <?php } ?>   

                                                                        <td style="border-left:1px solid;border-top:1px solid;">
                                                                             <?php if(!empty($collection['c_name'])) echo $collection['c_name']; ?>
                                                                        </td>

                                                                        <td style="border-left:1px solid;border-top:1px solid;">
                                                                             <?php if(!empty($collection['mrr_no'])) echo $collection['mrr_no']; ?>
                                                                        </td>

                                                                        <td style="border-left:1px solid;border-top:1px solid;">
                                                                             <?php if(!empty($collection['category_name'])) echo $collection['category_name']; ?>
                                                                        </td>


                                                                        <td style="border-left:1px solid;border-top:1px solid;">
                                                                            <?php if(!empty($collection['collection_method'])) echo $collection['collection_method']; ?>
                                                                        </td>
                                                                        <?php if($collection['collection_method']=="Cash" || $collection['collection_method']=="O.Cash"){ ?> 
                                                                            <td style="border-left:1px solid;border-top:1px solid;">
                                                                                 <?php //if(!empty($collection['no'])) echo $collection['no']; ?>
                                                                            </td>
                                                                        <?php }else{ ?>
                                                                            <td style="border-left:1px solid;border-top:1px solid;">
                                                                                 <?php if(!empty($collection['no'])) echo $collection['no']; ?>
                                                                            </td>
                                                                        <?php } ?>   


                                                                        <td style="border-left:1px solid;border-top:1px solid;">
                                                                             <?php if(!empty($collection['remark'])) echo $collection['remark']; ?>
                                                                        </td>
                                                                       <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php if(!empty($collection['amount'])) echo number_format($collection['amount'],2); ?></td>


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