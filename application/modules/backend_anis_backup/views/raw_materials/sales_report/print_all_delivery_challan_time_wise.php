
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
    <p style=" text-align: center;margin-top:-5px;margin-bottom:5px;">Delivery Challan</p> 

    
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
          
            <thead>
                <tr><td colspan="9">Date &nbsp;<?php if(!empty($date)) echo $date; ?></td></tr>
                <tr><td colspan="9">FROM &nbsp;<?php if(!empty($f_time)) echo date('h:i A',strtotime($f_time)); ?>&nbsp; TO &nbsp<?php if(!empty($to_time)) echo date('h:i A',strtotime($to_time)); ?></td></tr>
                <tr></tr>
                                
                                <tr>
                                   <th style="border-left:1px solid;border-top:1px solid;width:20px;">SL</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">C.Date</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">C.Time</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">C.No.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">D.O.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">S.O.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Customer Name</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Project</th>
                                   
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Truck No</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">D.Name</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">Product Type</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">Product Name</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">M.U.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:50px;">Qnty</th>
                                   
                                  
                                </tr>
                            </thead>
                             <tbody>
                                     
                                                
                                      <?php if(!empty($challans)){
                                              
                                                     ?>
                                                            <?php 
                                                            $i=0;
                                                            $total=0;
                                                            foreach($challans as $challan){ 
                                                                $i++;
                                                                if($order['product_name']!='Grouting'){
                                                                    $total=$total+$challan['quantity'];
                                                                }
                                                                ?> 
                                                                    
                                                                     <tr>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $challan['dc_id']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['delivery_challan_date'])) echo date('d-m-Y',strtotime($challan['delivery_challan_date'])); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['challan_date_time'])) echo date('h:i A',strtotime($challan['challan_date_time'])); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['dc_no'])) echo $challan['dc_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['delivery_no'])) echo $challan['delivery_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['order_no'])) echo $challan['order_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['c_name'])) echo $challan['c_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['project_name'])) echo $challan['project_name']; ?></td>
                                                                       
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['truck_no'])) echo $challan['truck_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['driver_name'])) echo $challan['driver_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['category_name'])) echo $challan['category_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['product_name'])) echo $challan['product_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['measurement_unit'])) echo $challan['measurement_unit']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:center;"><?php if(!empty($challan['quantity'])) echo number_format($challan['quantity'],2); ?></td>
                                                                        
                                                                        


                                                                    </tr>
                                                            <?php } ?>
                                                                 
                                                                     <tr>
                                                                        <td colspan="13" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td>
                                                                        <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;"><b><?php echo number_format($total,2); ?></b></td>
                                                                        
                                                                    </tr>
                                                                        
                                                                 
                                                                    <!--
                                                                    <tr>
                                                                        <td colspan="8" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td>
                                                                        <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"><?php echo $total; ?></td>
                                                                    </tr>
                                                                    -->
                                               
                                     <?php }else{ ?>
                                            <tr>
                                                <td colspan="14" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                            </tr>
                                     <?php } ?>
                            </tbody>
            
                            
                       
                                                                           
                                                    

        </table>
   
    
</div>
<div class="clearfix"></div>