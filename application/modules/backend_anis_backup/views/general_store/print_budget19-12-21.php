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
    <p style=" text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 30px;margin-bottom: 4px;"><?php echo $budget_info[0]['b_type']; ?>&nbsp;&nbsp;BUDGET</p>
    
    <p style="width:70%;float:left;margin-bottom:-10px;">
        Project: <b><?php echo strtoupper($budget_info[0]['dep_description']); ?></b><br>  
   

    </p>
    <p style="width:70%;float:left">
        Budget No.: <?php echo $budget_info[0]['b_no']; ?><br>  
   

    </p>
     <div style="float:right;">
                
     <div style="padding: 10px">
         <b>Date: <?php echo date('d-m-Y',strtotime($budget_info[0]['b_date'])); ?></b><br>
        
     </div>
     </div>
     <div style="clear: both;"></div>
    
     
     <table class="table table-bordered table-hover table-striped" border="1" style="width:100%;text-align: center;margin-bottom: 20px;height:700px;">
           
           
         
          
          
         <thead>
               <tr >
                       
                   
                        
                  <!-- <th >Project</th> -->
                   <th>SL</th>
                  
                   <th>Date</th>  
                   <th>Indent No.</th>
                   <th>Item Description </th>
                   <th style="width:5%;">MU</th>
                   <th>Qnt</th>
                   <th>Rate</th>
                   <th>Value</th>
                   <th>Remark</th>     
                        
                   
                </tr>
         </thead>   
                <tbody>
                   
                            <?php $count=count($budgeted_items); $total_value=0; ?>
                              <?php $i=0; foreach($budgeted_items as $budgeted_item){ $i++;
                                       $total_value=$total_value+$budgeted_item['budget_value'];
                                    ?>

                                        <tr id="">
                                          <!-- <td ><?php if(!empty($budgeted_item['department_name'])) echo $budgeted_item['department_name'];  ?></td>-->
                                           <td><?php echo $i;  ?></td>
                                           <td style="text-align: left;"><?php if(!empty($budgeted_item['indent_date'])) echo date('d-m-Y',strtotime($budgeted_item['indent_date']));  ?></td> 
                                           <td style="text-align: left;"><?php if(!empty($budgeted_item['indent_no'])) echo $budgeted_item['indent_no'];  ?></td>
                                           <td style="text-align: left;"><?php if(!empty($budgeted_item['item_description'])) echo $budgeted_item['item_description'];  ?></td>
                                           <td><?php if(!empty($budgeted_item['measurement_unit'])) echo $budgeted_item['measurement_unit'];  ?></td>
                                           <td style="text-align:right;"><?php if(!empty($budgeted_item['budget_qty'])) echo number_format($budgeted_item['budget_qty']);  ?></td>
                                           <td style="text-align:right;"><?php if(!empty($budgeted_item['unit_price'])) echo number_format($budgeted_item['unit_price']);  ?></td>
                                           <td style="text-align:right;"><?php if(!empty($budgeted_item['budget_value'])) echo number_format($budgeted_item['budget_value']);  ?></td>
                                           <td><?php if (!empty($budgeted_item['mode_name'])) echo $budgeted_item['mode_name']; ?></td>
                                       </tr>  


                              <?php } ?>
                         
                </tbody>               
                    <tfoot>    
                            <tr id="row_1">
                                <td style="height:10px;"></td>
                                <td style="height:10px;"></td>
                                <td style="height:10px;"></td>
                                <td style="height:10px;"><b>Total Taka=</b></td>
                                <td style="height:10px;"></td>
                                <td style="height:10px;"></td>
                                <td style="height:10px;text-align: right;"><b><?php if(!empty($total_value)) echo number_format($total_value);  ?></b></td>
                                <td style="height:10px;"></td>


                            </tr> 
                    </tfoot>        
                        
                        
                
                        
           </table>
     <p><b>Taka In Words = <?php $taka_in_word=convert_number_to_words($total_value); echo ucwords($taka_in_word);  ?>&nbsp;Taka Only</p>
    
    
    <div style="clear: both;"></div>
    
   
    <div style="position: fixed;bottom:60px;text-align: center;width:100%;">
    <!--    
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
       <tr>
           <td style="width:20%;font-size:15px;"><span style="border-top:1px solid;">PREPARED BY</span></td>
           <td style="width:20%;font-size:15px;"><span style="border-top:1px solid;">Recommended By</span></td>
           <td style="width:20%;text-align: left;"><span style="border-top:1px solid;">Authorized By</span></td>
           <td style="width:20%;text-align: left;"><span style="border-top:1px solid;">Approved By</span></td>
       </tr>
    </table>
    -->
    
    <table class="table table-bordered table-hover table-striped" style="">
       <tr>
           <td style="width:200px;font-size:15px;"><span style="border-top:1px solid;">Prepared By</span></td>
           <td style="width:115px;font-size:15px;"><span style="border-top:1px solid;"></span></td>
           <td style="width:200px;font-size:15px;"><span style="border-top:1px solid;">Recommended By</span></td>
           <td style="width:115px;font-size:15px;"><span style="border-top:1px solid;"></span></td>
           <td style="width:200px;text-align: left;"><span style="border-top:1px solid;">Authorized By</span></td>
           <td style="width:130px;font-size:15px;"><span style="border-top:1px solid;"></span></td>
           <td style="width:200px;text-align: left;"><span style="border-top:1px solid;">Approved By</span></td>
           </tr>
    </table>
        
         
    </div>
   
    
</div>

 