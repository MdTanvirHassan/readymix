
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
   
    <p style=" text-align: center;margin-top:-5px;margin-bottom:5px;">LC Balance Report</p> 

    
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
          
            <thead>
               <!-- <tr><td colspan="9">FROM &nbsp;<?php  echo date('d-m-Y',strtotime($f_date)); ?>&nbsp; TO &nbsp<?php echo date('d-m-Y',strtotime($to_date)); ?></td></tr> -->
                <tr></tr>
                                
                                <tr>
                                   <th style="border-left:1px solid;border-top:1px solid;width:20px;">SL</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">LC.Date</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">LC.No.</th>
                                   
                                   
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Mother vessel Name</th>
                                                                    
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">Item Name</th>                                 
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">M.U.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Receive Qty</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">Y. Challan Qty</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">H. Challan Qty</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:50px;">T. Challan Qty</th>
                                 
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:50px;">Stock Qty</th>
                                 
                                   
                                  
                                </tr>
                            </thead>
                             <tbody>
                                     
                                                
                                      <?php if(!empty($lc_details)){
                                              
                                                     ?>
                                                            <?php 
                                                            $i=0;
                                                            $total=0;
                                                            $total_value=0;
                                                            foreach($lc_details as $lc_d){ 
                                                                $i++;
                                                                
                                                                $total_lr=$total_lr+$lc_d['survey_qty'];
                                                                $net_total_yard_challan=$net_total_yard_challan+$lc_d['total_yard_challan_qty'];
                                                                $net_total_hook_challan=$net_total_hook_challan+$lc_d['total_hook_challan_qty'];
                                                                $total_challan=$total_challan+$lc_d['total_challan_qty'];
                                                                $total_remaining=$total_remaining+($lc_d['survey_qty']-$lc_d['total_challan_qty']);
                                                               
                                                                
                                                                ?> 
                                                                    
                                                                     <tr>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $i; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($lc_d['date'])) echo date('d-m-Y',strtotime($lc_d['date'])); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($lc_d['lc_no'])) echo $lc_d['lc_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($lc_d['mother_vessel_name'])) echo $lc_d['mother_vessel_name']; ?></td>
                                                                        
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($lc_d['item_name'])) echo $lc_d['item_name']; ?></td>
                                                                       
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($lc_d['meas_unit'])) echo $lc_d['meas_unit']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($lc_d['survey_qty'])) echo $lc_d['survey_qty']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($lc_d['total_yard_challan_qty'])) echo number_format($lc_d['total_yard_challan_qty'],2); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($lc_d['total_hook_challan_qty'])) echo number_format($lc_d['total_hook_challan_qty'],2); ?></td>
                                                                        
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:right;"><?php if(!empty($lc_d['total_challan_qty'])) echo $lc_d['total_challan_qty']; ?></td>
                                                                        
                                                                        
                                                                       
                                                                      <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:right;"><?php $remaining_qty=$lc_d['survey_qty']-$lc_d['total_challan_qty'];echo number_format($remaining_qty,2); ?></td>
                                                                        
                                                                        
                                                                        


                                                                    </tr>
                                                            <?php } ?>
                                                                 
                                                                        <tr>
                                                                           <td colspan="6" style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td>
                                                                           <td style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total_lr,2); ?></b></td>
                                                                           <td style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($net_total_yard_challan,2); ?></b></td>
                                                                           <td style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($net_total_hook_challan,2); ?></b></td>
                                                                           <td style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b><?php echo number_format($total_challan,2); ?></b></td>
                                                                           
                                                                           <td style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;"><b><?php echo number_format($total_remaining,2); ?></b></td>

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