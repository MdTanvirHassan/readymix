
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
    <p style=" text-align: center;margin-top:0px;margin-bottom:5px;"><?php echo $branch_info[0]['dep_description']; ?></p> 
    <p style=" text-align: center;margin-top:-5px;margin-bottom:5px;">Vat Report</p> 

    
    
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

                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">Product Type</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">Product Name</th>                                 
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">M.U.</th>
                                  
                                  <?php if($user_type!=4){ ?>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Qnty</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Base Price</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Vat</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Unit Price</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Value</th>
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:50px;">Bill Status</th>
                                  <?php }else{ ?>
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:50px;">Qnty</th>
                                  <?php } ?>
                                   
                                  
                                </tr>
                            </thead>
                             <tbody>
                                     
                                                
                                      <?php if(!empty($challans)){
                                              
                                                     ?>
                                                            <?php 
                                                            $i=0;
                                                            $total=0;
                                                            $total_value=0;
                                                            $total_base_price=0;
                                                            $total_vat=0;
                                                            foreach($challans as $challan){ 
                                                                $i++;
                                                                if($order['product_name']!='Grouting'){
                                                                    $total=$total+$challan['quantity'];
                                                                    $total_value=$total_value+round($challan['quantity']*$challan['unit_price'],2);
                                                                    $total_base_price=$total_base_price+$challan['base_price'];
                                                                    $total_vat=$total_vat+$challan['vat'];
                                                                }
                                                                
                                                                ?> 
                                                                    
                                                                     <tr>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $challan['dc_id']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['delivery_challan_date'])) echo date('d-m-Y',strtotime($challan['delivery_challan_date'])); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['dc_no'])) echo $challan['dc_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['delivery_no'])) echo $challan['delivery_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['order_no'])) echo $challan['order_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['c_name'])) echo $challan['c_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['project_name'])) echo $challan['project_name']; ?></td>
                                                                        
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['category_name'])) echo $challan['category_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['product_name'])) echo $challan['product_name']; ?></td>
                                                                        
                                                                        
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['measurement_unit'])) echo $challan['measurement_unit']; ?></td>
                                                                        <?php if($user_type!=4){ ?>
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['quantity'])) echo number_format($challan['quantity'],2); ?></td>
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['base_price'])) echo number_format($challan['base_price'],2); ?></td>
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['vat'])) echo number_format($challan['vat'],2); ?></td>
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['unit_price'])) echo number_format($challan['unit_price'],2); ?></td>
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['quantity'])) echo number_format($challan['quantity']*$challan['unit_price'],2); ?></td>
                                                                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:center;"><?php if(!empty($challan['bill_status'])) echo $challan['bill_status']; ?></td>
                                                                        <?php }else{ ?>
                                                                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:center;"><?php if(!empty($challan['quantity'])) echo number_format($challan['quantity'],2); ?></td>
                                                                        <?php } ?>    
                                                                        
                                                                        


                                                                    </tr>
                                                            <?php } ?>
                                                                  <?php if($user_type!=4){ ?>
                                                                        <tr>
                                                                           <td colspan="10" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td>
                                                                           <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total,2); ?></b></td>
                                                                           <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php //echo number_format($total,2); ?></b></td>
                                                                           <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total_vat,2); ?></b></td>
                                                                           <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php //echo number_format($total,2); ?></b></td>
                                                                           <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total_value,2); ?></b></td>
                                                                           <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;"><b><?php //echo number_format($total,2); ?></b></td>

                                                                       </tr>
                                                                  <?php }else{ ?>
                                                                        <tr>
                                                                           <td colspan="12" style="text-align:right;border-top:1px solid;"></td>
                                                                           
                                                                           <td style="text-align:center;border-top:1px solid;border-right:1px solid;"><b><?php //echo number_format($total,2); ?></b></td>

                                                                       </tr>
                                                                  <?php } ?>     
                                                                        
                                                                 
                                                                    <!--
                                                                    <tr>
                                                                        <td colspan="8" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td>
                                                                        <td  style="text-align:right;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"><?php echo $total; ?></td>
                                                                    </tr>
                                                                    -->
                                               
                                     <?php }else{ ?>
                                            <tr>
                                                <td colspan="16" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                            </tr>
                                     <?php } ?>
                            </tbody>
            
                            
                       
                                                                           
                                                    

        </table>
   
    
</div>
<div class="clearfix"></div>