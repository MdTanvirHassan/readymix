<style>
     @page {
        size: auto;   /* auto is the initial value */
        margin-top: 20px;  /* this affects the margin in the printer settings */
        margin-bottom: 0;
    }
    #content-table{
        line-height: 18px !important;
    }
    table{
  border-collapse: collapse;
  
}
table tr th{
    background: #eee;
    height:10px !important;
}
table tr td, table tr th{
    padding: 1px 5px;  
    vertical-align: initial;
}

tr{ 
    overflow: hidden;
    height: 14px;
    white-space: nowrap;
}
</style>




<!--<div style="padding:50px; width:60%; margin: 0 auto">-->
<div>
   
           
    <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;"><img style="width: 120px;margin-top: -12px;position: absolute;margin-left: -140px;" src="<?php echo site_url('images/kmix_logo.png')?>"> <span>KARIM ASPHALT & READY MIX LTD.</span> </h2>
    <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">(A Unit of Karim Group)</p>
    <hr>
    <p style=" text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 30px;margin-bottom: 4px;">ISSUE NOTE</p>
    
    <p style="width:50%;float:left;margin-bottom:-10px;">
        <b> Issue No.: <?php echo "000".$consumption_info[0]['consumption_id'];?></b><br>  
        <b>Date: <?php echo date('d-m-Y',strtotime($consumption_info[0]['consumption_date']))?></b><br>  

    </p>
    
     <div style="float:right;">
      
    
         
     <div style="padding: 10px">
         <b>Cost Center: <?php echo $consumption_info[0]['c_c_name'];?></b><br>
         <b>Department: <?php echo $consumption_info[0]['dept_name'];?></b><br>
         <b>Received By: <?php echo $consumption_info[0]['name'];?></b><br>
        
     </div>
     </div>
     <div style="clear: both;"></div>
    
     
     <table class="table table-bordered table-hover table-striped" border="1" style="width:100%;text-align: center;margin-bottom: 20px;height:650px;">
           
           
         
          
          
         <thead>
               <tr >
                       
                   
                        
                  <tr>
                                    
                                    <th style="width:20%">Item</th>
                                    <th style="width:5%">Brand Name</th>
                                    <th style="width:5%">Quantity</th>
                                  
                                    <th style="width:20%">Remarks</th>
                 </tr>
                        
                   
                </tr>
         </thead>   
                <tbody>
                   
                           
                            
                            <tr>
                                    
                                    <td>
                                        <?php echo $consumption_info[0]['item_name']; ?>
                                    </td>
                                    
                                    <td>
                                        <?php echo $consumption_info[0]['brand_name']; ?>
                                    </td>
                                    
                                    <td style="text-align: right;">
                                        <?php echo $consumption[0]['consumption_quantity']?>
                                    </td>
                                    
                                   
                                    <td>
                                        <?php echo $consumption[0]['remarks']?>  
                                    </td>
                            </tr>
                         
                </tbody>               
                    <tfoot>    
                            
                    </tfoot>        
                        
                        
                
                        
           </table>
    
    <div style="clear: both;"></div>
    
   
    <div style="position: fixed;bottom:60px;text-align: center;width:100%;">
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
        <tr>
            <td style="height:10px;text-align: center;"><span style="border-top:1px solid;">PREPARED BY</span></td>
            <td style="height:10px;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="height:10px;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>           
            <td style="height:10px;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="height:10px;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</span></td>
            <td style="height:10px;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="height:10px;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="height:10px;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="height:10px;text-align: center;"><span style="border-top:1px solid;">RECEIVED BY</span></td>
        </tr>
    </table>
        
         
    </div>
   
    
</div>

 