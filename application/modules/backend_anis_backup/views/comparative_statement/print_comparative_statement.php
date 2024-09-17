<style>
@page{
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
    
</style>




<!--<div style="padding:50px; width:60%; margin: 0 auto">-->
<div>
   
           
    <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;"><img style="width: 120px;margin-top: -12px;position: absolute;margin-left: -140px;" src="<?php echo site_url('images/kmix_logo.png')?>"> <span>KARIM ASPHALT & READY MIX LTD.</span> </h2>
    <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">(A Unit of Karim Group)</p>
    <hr>
    <p style=" text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 30px;margin-bottom: 4px;">COMPARATIVE STATEMENT</p>
     <p style="width:70%;float:left;margin-bottom:-10px;">
        Project: <?php echo $comparative_statement_info[0]['dep_description']; ?><br>  
   

    </p>
   
     <div style="float:right;width:30%;">
                
     <div style="padding: 10px;text-align: right;">
         <b>Date: <?php echo date('d-m-Y',strtotime($comparative_statement_info[0]['date'])) ?></b><br>
        
     </div>
     </div>
     <div style="clear: both;"></div>
    
     
     <table class="table table-bordered table-hover table-striped" border="1" style="width:100%;text-align: center;margin-bottom: 20px;height:550px;">
           
           
         
          
          
           
               <tr>
                       
                   
                    <th>SL</th>    
                   
                    <th>Item name & Description</th>
                    <th>Unit</th>
                   <?php foreach($comparative_statement_details as $csd){ ?> 
                        <th><?php echo $csd['SUP_NAME']; ?></th>
                   <?php } ?>  
                   
                        
                        
                   
                </tr>
               
                  <?php 
                  $total_value=0;
                  $i=0;
                  ?>

                   <tr class="row" id="row_1" style="border-top:0px;border-bottom:0px;" >   
                       <td>
                           <?php echo '1'; ?>
                       </td>
                        
                      
                        <td style="text-align:left;">         
                             <?php echo $comparative_statement_info[0]['item_name']; ?>
                        </td>
                        <td>
                            <?php echo $comparative_statement_info[0]['meas_unit']; ?>
                        </td> 
                    <?php foreach($comparative_statement_details as $csd){ ?>     
                        <td >
                            <?php echo $csd['rate']; ?>
                        </td>
                    <?php } ?>    
                    </tr>       
                     
              
                 
                
                        
           </table>
    
    
    
   
    <div style="clear: both;"></div>
    
    
   
    <div style="position: fixed;bottom:60px;text-align: center;width:100%;">
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
        <tr>
            <td style="height:10px;text-align: center;"><span style="border-top:1px solid;">PREPARED BY</span></td>
            <td style="height:10px;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="height:10px;text-align: center;"><span style="border-top:1px solid;">Head of Supply Chain</span></td>           
            <td style="height:10px;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="height:10px;text-align: center;"><span style="border-top:1px solid;">G.M.(A&F)</span></td>
            <td style="height:10px;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="height:10px;text-align: center;"><span style="border-top:1px solid;">Director</span></td>
            <td style="height:10px;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="height:10px;text-align: center;"><span style="border-top:1px solid;">Managing Director</span></td>
        </tr>
    </table>
        
         
    </div>
   
    
</div>

 