
<style>
    #content-table{
        line-height: 18px !important;
    }
    table,
      th,
      td {
        border: 1px solid black;
        border-collapse: collapse;
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
    <p style=" text-align: center;margin-top:-5px;margin-bottom:5px;">Casting Wise Material Consumption Report</p> 

    
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
          
            <thead>
                <tr><td colspan="8" style="text-align:center;">FROM &nbsp;<?php echo $f_date; ?>&nbsp; TO &nbsp<?php echo $to_date; ?></td></tr>
                <tr></tr>
                                
                                <tr>
                                   <th style="border-left:1px solid;border-top:1px solid;width:20px;">SL</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">Date</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">Casting No.</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">Casting Size</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:100px;">Casting Size (CFT)</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">Product Name</th>
                                   <th style="border-left:1px solid;border-top:1px solid;width:150px;">M.U</th>
                                   <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;width:150px;">Quantity</th>
                                </tr>
                            </thead>
                             <tbody>
                                     
                                                
                                      <?php if(!empty($casting)){
                                              
                                                     ?>
                                                            <?php 
                                                            $i=0;
                                                            $total=0;
                                                            $total_value=0;
                                                            foreach($casting as $challan){ 
                                                                $i++;
                                                                ?> 
                                                                    
                                                                     <tr>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php echo $i; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['created_date'])) echo date('d-m-Y',strtotime($challan['created_date'])); ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['pm_no'])) echo $challan['pm_no']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['casting_size'])) echo $challan['casting_size']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['casting_size_cft'])) echo $challan['casting_size_cft']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['item_name'])) echo $challan['item_name']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($challan['mu'])) echo $challan['mu']; ?></td>
                                                                        <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;border-right:1px solid;text-align:center;"><?php if(!empty($challan['qty'])) echo $challan['qty']; ?></td>
                                                                        


                                                                    </tr>
                                                            <?php }
                                                        }else{ ?>
                                            <tr>
                                                <td colspan="7" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                            </tr>
                                     <?php } ?>
                            </tbody>
            
                            
                       
                                                                           
                                                    

        </table>
   
    
</div>
<div class="clearfix"></div>