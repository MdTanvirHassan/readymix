
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
    <p style=" text-align: center;margin-top:0px;margin-bottom:5px;"><?php if(!empty($lc_info))  echo $lc_info[0]['mother_vessel_name'].'-'.$lc_info[0]['lc_no']; ?></p> 
    <p style=" text-align: center;margin-top:0px;margin-bottom:5px;"><?php if(!empty($delivery_location)) echo $delivery_location; ?></p> 
    <p style=" text-align: center;margin-top:-5px;margin-bottom:5px;">Delivery Challan</p> 

    
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
          
            <thead>
                <tr><td colspan="9">FROM &nbsp;<?php  echo date('d-m-Y',strtotime($f_date)); ?>&nbsp; TO &nbsp<?php echo date('d-m-Y',strtotime($to_date)); ?></td></tr>
                <tr></tr>
                                
                                <tr>
                                   <th style="border-left:1px solid;border-top:1px solid;width:20px;">SL</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">V. Name</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">C.Date</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">C.Time</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">C.No.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">M.C.No.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">D.O.</th>
                                   
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Customer Name</th>
                                  
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Truck No</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">D.Name</th>
                                  
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">Product Name</th>                                 
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">M.U.</th>
                                  
                                  <?php if($user_type!=4){ ?>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Qnty</th>
                                   
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Base Price</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Stone Value</th>
                                   
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Commission Rate</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Commission Value</th>
                                   
                                   
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Transport Rate</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Transport Amount</th>
                                   
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Total Unit Price</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Total Value</th>
                                   
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:50px;">Bill Status</th>
                                   
                                  <?php }else{ ?>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Qnty</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Transport Rate</th>
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:50px;">Transport Amount</th>
                                  <?php } ?>
                                   
                                  
                                </tr>
                            </thead>
                             <tbody>
                                     
                                                
                                      <?php if(!empty($challans)){
                                              
                                                     ?>
                                                            <?php 
                                                            $i=0;
                                                            $total=0;
                                                            $total_stone_amount=0;
                                                            $total_commission=0;
                                                            $total_value=0;
                                                            $total_transport_value=0;
                                                            foreach($challans as $challan){ 
                                                                $i++;
                                                                
                                                                $total=$total+$challan['quantity'];
                                                                
                                                                $total_stone_amount=$total_stone_amount+round($challan['quantity']*$challan['base_price'],2);
                                                                $total_commission=$total_commission+round($challan['quantity']*$challan['commission'],2);
                                                                
                                                                $total_value=$total_value+round($challan['quantity']*$challan['unit_price'],2);
                                                                $total_transport_value=$total_transport_value+round($challan['quantity']*$challan['transport_cost'],2);
                                                                
                                                                ?> 
                                                                    
                                                                     <tr>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $i; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['mother_vessel_name'])) echo $challan['mother_vessel_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['delivery_challan_date'])) echo date('d-m-Y',strtotime($challan['delivery_challan_date'])); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['print_date_time'])) echo date('d-m-Y h:i a',strtotime($challan['print_date_time'])); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['dc_no'])) echo $challan['dc_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['manual_dc_no'])) echo $challan['manual_dc_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['delivery_no'])) echo $challan['delivery_no']; ?></td>
                                                                        
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['c_name'])) echo $challan['c_name']; ?></td>
                                                                       
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['truck_no'])) echo $challan['truck_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['driver_name'])) echo $challan['driver_name']; ?></td>
                                                                        
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['item_name'])) echo $challan['item_name']; ?></td>
                                                                        
                                                                        
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['meas_unit'])) echo $challan['meas_unit']; ?></td>
                                                                        <?php if($user_type!=4){ ?>
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['quantity'])) echo number_format($challan['quantity'],2); ?></td>
                                                                            
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['base_price'])) echo number_format($challan['base_price'],2); ?></td>
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($challan['quantity'])) echo number_format($challan['quantity']*$challan['base_price'],2); ?></td>
                                                                            
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['commission'])) echo number_format($challan['commission'],2); ?></td>
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($challan['quantity'])) echo number_format($challan['quantity']*$challan['commission'],2); ?></td>
                                                                            
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['transport_cost'])) echo number_format($challan['transport_cost'],2); ?></td>
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($challan['transport_cost'])) echo number_format($challan['quantity']*$challan['transport_cost'],2); ?></td>
                                                                            
                                                                            
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['unit_price'])) echo number_format($challan['unit_price'],2); ?></td>
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($challan['quantity'])) echo number_format($challan['quantity']*$challan['unit_price'],2); ?></td>
                                                                            
                                                                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:center;"><?php if(!empty($challan['bill_status'])) echo $challan['bill_status']; ?></td>
                                                                            
                                                                        <?php }else{ ?>
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['quantity'])) echo number_format($challan['quantity'],2); ?></td>
                                                                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['transport_cost'])) echo number_format($challan['transport_cost'],2); ?></td>
                                                                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php if(!empty($challan['transport_cost'])) echo number_format($challan['quantity']*$challan['transport_cost'],2); ?></td>
                                                                        <?php } ?>    
                                                                        
                                                                        


                                                                    </tr>
                                                            <?php } ?>
                                                                  <?php if($user_type!=4){ ?>
                                                                        <tr>
                                                                           <td colspan="12" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td>
                                                                           <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total,2); ?></b></td>
                                                                           
                                                                           <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php //echo number_format($total,2); ?></b></td>
                                                                           <td style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total_stone_amount,2); ?></b></td>
                                                                           
                                                                           <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php //echo number_format($total,2); ?></b></td>
                                                                           <td style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total_commission,2); ?></b></td>
                                                                           
                                                                           <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php //echo number_format($total,2); ?></b></td>
                                                                           <td style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total_transport_value,2); ?></b></td>
                                                                           
                                                                           
                                                                           <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php //echo number_format($total,2); ?></b></td>
                                                                           <td style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total_value,2); ?></b></td>
                                                                           
                                                                           <td style="text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;"><b><?php //echo number_format($total,2); ?></b></td>
                                                                           

                                                                       </tr>
                                                                  <?php }else{ ?>
                                                                        <tr>
                                                                           <td colspan="12" style="text-align:right;border-top:1px solid;">Total</td>
                                                                           
                                                                           <td style="text-align:center;border-top:1px solid;"><b><?php //echo number_format($total,2); ?></b></td>
                                                                           <td style="text-align:center;border-top:1px solid;"><b><?php //echo number_format($total,2); ?></b></td>
                                                                           <td style="text-align:center;border-top:1px solid;border-right:1px solid;"><b><?php echo number_format($total_transport_value,2); ?></b></td>

                                                                       </tr>
                                                                  <?php } ?>     
                                                                        
                                                                 
                                                                   
                                               
                                     <?php }else{ ?>
                                            <tr>
                                                <td colspan="19" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                            </tr>
                                     <?php } ?>
                            </tbody>
            
                            
                       
                                                                           
                                                    

        </table>
   
    
</div>
<div class="clearfix"></div>