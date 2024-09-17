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
    <p style=" text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 30px;margin-bottom: 4px;">MONEY INDENT</p>
     <p style="width:70%;float:left;margin-bottom:-10px;">
         Project: <b><?php echo strtoupper($money_indent_info[0]['dep_description']); ?></b><br>  
   

    </p>
    <p style="width:70%;float:left">
        Money Indent No.: <?php if(!empty($money_indent_info[0]['mo_indent_no'])) echo $money_indent_info[0]['mo_indent_no'];  ?><br>  
   

    </p>
     <div style="float:right;width:30%;">
                
     <div style="padding: 10px;text-align: right;">
         <b>Date: <?php echo date('d-m-Y',strtotime($money_indent_info[0]['date'])) ?></b><br>
        
     </div>
     </div>
     <div style="clear: both;"></div>
    
     
     <table class="table table-bordered table-hover table-striped" border="1" style="width:100%;text-align: center;margin-bottom: 20px;height:700px;">
           
           
         
          
          
           
               <tr>
                       
                   
                    <th>SL</th>  
                    
                    <th>Indent No.</th>
                    <th>Budget No.</th>          
                   
                    <th>Item name & Description</th>
                    <th>Unit</th>
                    
                    <th>Budget Qnt</th>
                    <th>Indent Qnt</th>
                    <th>Unit Price</th>
                    <th>Value</th>
                    <th>Payment Mode</th>
                    <th>Supplier</th>
                   
                        
                        
                   
                </tr>
               
                  <?php 
                  $total_value=0;
                  $i=0; foreach($budget_items as $budget_item){ $i++;
                  $total_value=$total_value+$budget_item['value'];
                  ?>

                   <tr class="row" id="row_1" style="border-top:0px;border-bottom:0px;" >   
                       <td>
                           <?php echo $i; ?>
                       </td>
                        
                       <td>     
                           <?php if(!empty($budget_item['indent_no'])) echo $budget_item['indent_no'];  ?>
                        </td>
                       
                        <td>     
                           <?php if(!empty($budget_item['b_no'])) echo $budget_item['b_no'];  ?>
                        </td>
                        
                       
                       
                        <td style="text-align: left;">         
                             <?php if(!empty($budget_item['item_description'])) echo $budget_item['item_description'];  ?>
                        </td>
                        <td>
                            <?php if(!empty($budget_item['measurement_unit'])) echo $budget_item['measurement_unit'];  ?>
                        </td>   
                       
                         <td style="text-align: right;">
                             <b>   <?php if(!empty($budget_item['budget_qty'])) echo $budget_item['budget_qty'];  ?></b>
                        </td>
                        <td style="text-align: right;">
                            <b> <?php if(!empty($budget_item['quantity'])) echo number_format($budget_item['quantity']);  ?></b>
                        </td>
                       
                        <td style="text-align: right;">
                            <b><?php if(!empty($budget_item['unit_price'])) echo number_format($budget_item['unit_price'],2);  ?></b>
                        </td>
                        <td style="text-align: right;">
                            <b> <?php if(!empty($budget_item['value'])) echo number_format($budget_item['value'],2);  ?></b>
                        </td>
                        
                        <td style="text-align: left;">
                             <b>   <?php if(!empty($budget_item['mode_name'])) echo $budget_item['mode_name'];  ?></b>
                        </td>
                        
                        <td style="text-align: left;">
                             <b>   <?php if(!empty($budget_item['SUP_NAME'])) echo $budget_item['SUP_NAME'];  ?></b>
                        </td>
                       
                        
                    </tr>       
                     
                  <?php } ?>
                 
                  <tr id="row_1">
                            
                            <td style="height:10px;"></td>
                            <td style="height:10px;"></td>
                            <td style="height:10px;"></td>
                            
                            <td style="height:10px;"><b>Total Taka=</b></td>
                            <td style="height:10px;"></td>
                            <td style="height:10px;"></td>
                            <td style="height:10px;"></td>
                            <td style="height:10px;"></td>
                            <td style="height:10px;text-align: right;"><b><?php if(!empty($total_value)) echo number_format($total_value);  ?></b></td>
                            <td style="height:10px;"></td>
                            <td style="height:10px;"></td>
                        </tr>        
                        
           </table>
    
    
    
    <p><b>In Word:&nbsp;<?php $taka_in_word=convert_number_to_words($total_value); echo ucwords($taka_in_word);  ?>&nbsp;Taka Only</b></p>
    
    <div style="clear: both;"></div>
    
    
   
    <div style="position: fixed;bottom:30px;text-align: center;width:100%;">
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

 