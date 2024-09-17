
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
    <p style=" text-align: center;margin-top:-5px;margin-bottom:5px;">Challan and Invoice Comparison</p> 

    
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
          
            <thead>
                <tr><td colspan="9">FROM &nbsp;<?php echo $f_date; ?>&nbsp; TO &nbsp<?php echo $to_date; ?></td></tr>
                <tr></tr>
                                
                                <tr>
                                   <th style="border-left:1px solid;border-top:1px solid;width:20px;">SL</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">C.Date</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">C.No.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">D.O.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">S.O.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Customer Name</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Project</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">P. Type</th>  
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">P. Name</th>       
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">M.U.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Unit Price</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Challan Qty</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Invoice Qty</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Invoice Due Qty</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Challan Amount</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Invoice Amount</th>
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:50px;">Invoice Due Amount</th>
                                  
                                  
                                </tr>
                            </thead>
                             <tbody>
                                     
                                                
                                      <?php if(!empty($challans)){
                                              
                                                     ?>
                                                            <?php 
                                                            $i=0;
                                                            $total=0;
                                                            $total_ch_amount=0;
                                                            $total_inv_amount=0;
                                                            foreach($challans as $challan){ 
                                                                $i++;
                                                               
                                                                ?> 
                                                                    
                                                                     <tr>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $i; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['delivery_challan_date'])) echo date('d-m-Y',strtotime($challan['delivery_challan_date'])); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['dc_no'])) echo $challan['dc_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['delivery_no'])) echo $challan['delivery_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['order_no'])) echo $challan['order_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['c_name'])) echo $challan['c_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['project_name'])) echo $challan['project_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['category_name'])) echo $challan['category_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['product_name'])) echo $challan['product_name']; ?></td>
                                                                       
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['measurement_unit'])) echo $challan['measurement_unit']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['unit_price'])) echo $challan['unit_price']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;">
                                                                            <?php if(!empty($challan['quantity'])) echo number_format($challan['quantity'],2); ?>
                                                                        </td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;">
                                                                            <?php if(!empty($challan['total_invoie_qty'])) echo number_format($challan['total_invoie_qty'],2); ?>
                                                                        </td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;">
                                                                            <?php 
                                                                            $in_due_qty=$challan['quantity']-$challan['total_invoie_qty'];
                                                                            echo number_format($in_due_qty,2); 
                                                                            ?>
                                                                        </td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;">
                                                                            <?php if(!empty($challan['quantity'])) echo number_format($challan['quantity']*$challan['unit_price'],2); ?>
                                                                        </td>

                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;">
                                                                            <?php if(!empty($challan['total_invoie_qty'])) echo number_format($challan['total_invoie_qty']*$challan['unit_price'],2); ?>
                                                                        </td>

                                                                        <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:center;">
                                                                            <?php 

                                                                            if(!empty($challan['quantity'])){ 
                                                                                $ch_amount=$challan['quantity']*$challan['unit_price'];

                                                                            }else{
                                                                               $ch_amount=''; 
                                                                            }   
                                                                            
                                                                            $total_ch_amount=$total_ch_amount+$ch_amount;

                                                                            if(!empty($challan['total_invoie_qty'])){ 
                                                                                $in_amount=$challan['total_invoie_qty']*$challan['unit_price'];

                                                                            }else{
                                                                               $in_amount=''; 
                                                                            }
                                                                            $total_inv_amount=$total_inv_amount+$in_amount;

                                                                            $due_in_amount=$ch_amount-$in_amount;
                                                                            echo number_format($due_in_amount,2);
                                                                            if($order['product_name']!='Grouting'){
                                                                                $total=$total+$due_in_amount;
                                                                            }

                                                                            ?>
                                                                        </td>

                                                                    </tr>
                                                            <?php } ?>
                                                                 
                                                                     <tr>
                                                                        <td colspan="14" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td>
                                                                        <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;"><b><?php echo number_format($total_ch_amount,2); ?></b></td>
                                                                        <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;"><b><?php echo number_format($total_inv_amount,2); ?></b></td>
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
                                                <td colspan="17" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                            </tr>
                                     <?php } ?>
                            </tbody>
            
                            
                       
                                                                           
                                                    

        </table>
   
    
</div>
<div class="clearfix"></div>