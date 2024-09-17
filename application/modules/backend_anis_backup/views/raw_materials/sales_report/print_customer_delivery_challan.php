
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

<?php
    $employee_id = $this->session->userdata('employeeId');
    $user_type = $this->session->userdata('user_type');
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');

?>

 
<div style="padding-top:30px;" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">Karim Asphalt & Ready Mix Ltd.</h>
    <?php if(!empty($branch_info)){ ?>
        <p style=" text-align: center;margin-top:0px;margin-bottom:5px;"><?php echo $branch_info[0]['dep_description']; ?></p>
    <?php }else{ ?>
        <p style=" text-align: center;margin-top:0px;margin-bottom:5px;"><?php echo "All Branch"; ?></p>
    <?php } ?>    
    <p style=" text-align: center;margin-top:-5px;margin-bottom:5px;">Customer Wise Delivery Challan</p> 

    
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
          
            <thead>
                <tr><td colspan="9">FROM &nbsp;<?php echo $f_date; ?>&nbsp; TO &nbsp<?php echo $to_date; ?></td></tr>
                <tr></tr>
                                
                                <tr>
                                   <th style="border-left:1px solid;border-top:1px solid;width:20px;">SL</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">C.Date</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Customer Name</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Project</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">Product Type</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">Product Name</th>

                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">M.U.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Qnty</th>
                                  
                                   <?php if($user_type!=4){ ?>
                                    <th style="border-left:1px solid;border-top:1px solid;width:50px;">CUM Qnty</th>
                                    <th style="border-left:1px solid;border-top:1px solid;width:50px;">Unit Price</th>
                                    <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:50px;">Value</th>
                                   <?php }else{ ?>
                                     <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:50px;">CUM Qnty</th>
                                   <?php } ?> 
                                  
                                </tr>
                            </thead>
                             <tbody>
                                     
                                                
                                      <?php if(!empty($challans)){
                                              
                                                     ?>
                                                            <?php 
                                                            $sl = 1;
                                                            $i=0;
                                                            $total=0;
                                                            $totalcum=0;
                                                            $total_value=0;
                                                            foreach($challans as $key=>$challan){ 
                                                                $i++;
                                                                if($order['product_name']!='Grouting'){
                                                                    $total_value=$total_value+($challan['total_qty']*$challan['unit_price']);
                                                                    $total=$total+$challan['total_qty'];
                                                                    if($challan['measurement_unit']=='CFT')
                                                                    $totalcum=$totalcum+$challan['total_qty']/35.31;
                                                                    else if($challan['measurement_unit']=='MT')
                                                                    $totalcum=$totalcum+$challan['total_qty']/2.41;
                                                                    else
                                                                    $totalcum=$totalcum+$challan['total_qty'];
                                                                }
                                                                ?> 
                                                                    
                                                                     <tr>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $sl; //$challan['dc_id']; ?></td>
                                                                        <?php if($i != 1){ 
                                                if($challan['delivery_challan_date'] != $challans[($key-1)]['delivery_challan_date']){ ?>
                                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['delivery_challan_date'])) echo date('d-m-Y',strtotime($challan['delivery_challan_date'])); ?></td>
                                            <?php }else{ ?>
                                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;">-</td>
                                            <?php }}else{ ?>
                                                <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['delivery_challan_date'])) echo date('d-m-Y',strtotime($challan['delivery_challan_date'])); ?></td>
                                            <?php } ?>
                                                                        
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['c_name'])) echo $challan['c_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['project_name'])) echo $challan['project_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['category_name'])) echo $challan['category_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['product_name'])) echo $challan['product_name']; ?></td>

                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['measurement_unit'])) echo $challan['measurement_unit']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['quantity'])) echo number_format($challan['total_qty'],2); ?></td>
                                                                        
                                                                        <?php if($user_type!=4){ ?>  
                                                                        
                                                                               <?php if($challan['measurement_unit']=='CFT'){ ?>
                                                                                   <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['total_qty'])) echo number_format($challan['total_qty']/35.31,2); ?></td>
                                                                                   <?php }else if($challan['measurement_unit']=='MT'){ ?>
                                                                                   <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['total_qty'])) echo number_format($challan['total_qty']/2.41,2); ?></td>
                                                                               <?php }else{ ?>
                                                                                   <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['total_qty'])) echo number_format($challan['total_qty'],2); ?></td>
                                                                               <?php } ?>
                                                                        <?php }else{ ?>
                                                                                <?php if($challan['measurement_unit']=='CFT'){ ?>
                                                                                   <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:center;"><?php if(!empty($challan['total_qty'])) echo number_format($challan['total_qty']/35.31,2); ?></td>
                                                                                   <?php }else if($challan['measurement_unit']=='MT'){ ?>
                                                                                   <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:center;"><?php if(!empty($challan['total_qty'])) echo number_format($challan['total_qty']/2.41,2); ?></td>
                                                                               <?php }else{ ?>
                                                                                   <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:center;"><?php if(!empty($challan['total_qty'])) echo number_format($challan['total_qty'],2); ?></td>
                                                                               <?php } ?>   
                                                                                   
                                                                        <?php } ?>           
                                            
                                                                        <?php if($user_type!=4){ ?>    
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['unit_price'])) echo number_format($challan['unit_price'],2); ?></td>
                                                                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:center;"><?php if(!empty($challan['unit_price'])) echo number_format($challan['unit_price']*$challan['total_qty'],2); ?></td>
                                                                        <?php } ?>    

                                                                    </tr>
                                                               <?php $sl++; } ?>
                                                                 
                                                                     <tr>
                                                                        <td colspan="7" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td>
                                                                        <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total,2); ?></b></td>
                                                                        <?php if($user_type!=4){ ?>
                                                                            <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($totalcum,2); ?></b></td>
                                                                            <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                                                                            <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;"><b><?php echo number_format($total_value,2); ?></b></td>
                                                                        <?php }else{ ?>
                                                                            <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;"><b><?php echo number_format($totalcum,2); ?></b></td>
                                                                        <?php } ?>    
                                                                        
                                                                    </tr>
                                                                        
                                                                 
                                                                    <!--
                                                                    <tr>
                                                                        <td colspan="8" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td>
                                                                        <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"><?php echo $total; ?></td>
                                                                    </tr>
                                                                    -->
                                               
                                                                <?php }else{ ?>
                                                                       <tr>
                                                                           <td colspan="9" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                                                       </tr>
                                                                <?php } ?>
                            </tbody>
            
                            
                       
                                                                           
                                                    

        </table>
   
    
</div>
<div class="clearfix"></div>