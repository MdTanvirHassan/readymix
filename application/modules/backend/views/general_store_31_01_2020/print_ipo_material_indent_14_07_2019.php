<style>
    #content-table{
        line-height: 18px !important;
    }
    .table{
        
    }
    
</style>



 
<div style="padding:0" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">WAHID CONSTRUCTION LTD.</h>
    <p style=" text-align: center;margin-top:-3px;">(A Unit Of Karim Group)</p>

    
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
           <tr><td colspan="5" >Project:<span style="text-decoration:underline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($ipo_material_indent[0]['dep_description']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td><td >Indent No:<span style="text-decoration: underline;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ipo_material_indent[0]['ipo_number']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
           <tr><td colspan="4"></td><td colspan="2" style="text-align: right;">Date:<span style="text-decoration: underline;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('d-m-Y',strtotime($ipo_material_indent[0]['date'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr>
                <tr id="row_1">
                     
                      
                        <th style="border-left:1px solid;border-top:1px solid;">Item Code </th>
                        <th style="border-left:1px solid;border-top:1px solid;width:250px;">Item name </th>
                        <th style="border-left:1px solid;border-top:1px solid;width:60px;">MU</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:40px;">Stock Qnt</th>
                        <th style="border-left:1px solid;border-top:1px solid;width:40px;">Indent Qnt</th>
                     
                        <th style="border-left:1px solid;border-top:1px solid;border-right: 1px solid;width:80px;">Expected Date</th>
                        
                   
                </tr>
               
               <?php 
                     $count=count($ipo_material_indent_details);
                    $i=0; foreach($ipo_material_indent_details as $ipo_material_indent_detail){ $i++;
                      //  $total_value=$total_value+$budgeted_item['budget_value'];
                     ?>
                      <?php  if($count==$i){ ?>
                
                         <tr id="row_1">
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($ipo_material_indent_detail['item_code'])) echo $ipo_material_indent_detail['item_code'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($ipo_material_indent_detail['item_name_description'])) echo $ipo_material_indent_detail['item_name_description'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($ipo_material_indent_detail['unit'])) echo $ipo_material_indent_detail['unit'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"><?php if(!empty($ipo_material_indent_detail['stock_qty'])) echo $ipo_material_indent_detail['stock_qty'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"><?php if(!empty($ipo_material_indent_detail['indent_qty'])) echo $ipo_material_indent_detail['indent_qty'];  ?></td>
                           
                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;text-align:center;width:80px;"><?php if(!empty($ipo_material_indent_detail['expected_date'])) echo date('d-m-Y',strtotime($ipo_material_indent_detail['expected_date']));  ?></td>
                        </tr>  
                    
                      
                  <?php  }else{ ?>   
                           <tr id="row_1">
                             <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($ipo_material_indent_detail['item_code'])) echo $ipo_material_indent_detail['item_code'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($ipo_material_indent_detail['item_name_description'])) echo $ipo_material_indent_detail['item_name_description'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($ipo_material_indent_detail['unit'])) echo $ipo_material_indent_detail['unit'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($ipo_material_indent_detail['stock_qty'])) echo $ipo_material_indent_detail['stock_qty'];  ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($ipo_material_indent_detail['indent_qty'])) echo $ipo_material_indent_detail['indent_qty'];  ?></td>
                            
                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:center;width:80px;"><?php if(!empty($ipo_material_indent_detail['expected_date'])) echo date('d-m-Y',strtotime($ipo_material_indent_detail['expected_date']));  ?></td>
                        </tr>  
            
                               
               <?php } ?>
            <?php } ?>             
                        <!--
                        <tr id="row_1">
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><b>Total Taka=</b></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:right;"></td>
                            <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;text-align:right;"><b><?php if(!empty($total_value)) echo $total_value;  ?></b></td>
                        </tr>  
                        -->
                        <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                        
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                          <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         <tr><td></td></tr>
                         
              
        </table>
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
        <tr><td style="width:180px;font-size:15px;"><span style="border-top:1px solid;">PREP. BY</span></td><td style="width:200px;text-align: center;"><span style="border-top:1px solid;">STORE IN-CHARGE</span></td><td style="width:40px;"></td><td  style="width:200px;text-align: center;"><span style="border-top:1px solid;">GENERAL  MANAGER</span></td></tr>
    </table>
        
    
</div>
<div class="clearfix"></div>
 

