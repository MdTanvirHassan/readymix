<style>
     @page {
        size: auto;   /* auto is the initial value */
        margin-top: 0px;  /* this affects the margin in the printer settings */
        margin-bottom: 0;
    }
    #content-table{
        line-height: 18px !important;
    }
    .table{
        
    }
    
</style>



 
<div style="padding-top:30px;" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">WAHID CONSTRUCTION LTD.</h>
    <p style=" text-align: center;margin-top:-3px;">(A Unit Of Karim Group)</p>

    
     <?php if($ipo_material_indent[0]['type_name'] == "Material"){ ?>
                    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                         <tr>
                            <td colspan="4" style="text-align:left;">Indent No.: <?php echo $ipo_material_indent[0]['ipo_number']; ?></td>
                            <td colspan="2" style="text-align:left;">Date: <?php echo date('d-m-Y',strtotime($ipo_material_indent[0]['date'])); ?></td>
                        </tr>
                          <tr>
                            <td colspan="4" style="text-align:left;">Project: <?php echo strtoupper($ipo_material_indent[0]['dep_description']); ?></td>
                            <td colspan="2" style="text-align:left;"></td>
                        </tr>  
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
                                         <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">
                                             <?php foreach ($items as $item) { ?>
                                                 <?php if (!empty($ipo_material_indent_detail['item_id']) && $ipo_material_indent_detail['item_id'] == $item['id']) echo $item['item_code'] . "(" . $item['item_name'] . ")"; ?>
                                              <?php } ?>
                                         </td>
                                         <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($ipo_material_indent_detail['item_name_description'])) echo $ipo_material_indent_detail['item_name_description'];  ?></td>
                                         <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($ipo_material_indent_detail['unit'])) echo $ipo_material_indent_detail['unit'];  ?></td>
                                         <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"><?php if(!empty($ipo_material_indent_detail['stock_qty'])) echo $ipo_material_indent_detail['stock_qty'];  ?></td>
                                         <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"><?php if(!empty($ipo_material_indent_detail['indent_qty'])) echo $ipo_material_indent_detail['indent_qty'];  ?></td>

                                         <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;text-align:center;width:80px;"><?php if(!empty($ipo_material_indent_detail['expected_date'])) echo date('d-m-Y',strtotime($ipo_material_indent_detail['expected_date']));  ?></td>
                                     </tr>  


                               <?php  }else{ ?>   
                                        <tr id="row_1">
                                          <td style="border-left:1px solid;border-top:1px solid;">
                                               <?php foreach ($items as $item) { ?>
                                                 <?php if (!empty($ipo_material_indent_detail['item_id']) && $ipo_material_indent_detail['item_id'] == $item['id']) echo $item['item_code'] . "(" . $item['item_name'] . ")"; ?>
                                              <?php } ?>
                                          </td>
                                         <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($ipo_material_indent_detail['item_name_description'])) echo $ipo_material_indent_detail['item_name_description'];  ?></td>
                                         <td style="border-left:1px solid;border-top:1px solid;"><?php if(!empty($ipo_material_indent_detail['unit'])) echo $ipo_material_indent_detail['unit'];  ?></td>
                                         <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($ipo_material_indent_detail['stock_qty'])) echo $ipo_material_indent_detail['stock_qty'];  ?></td>
                                         <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($ipo_material_indent_detail['indent_qty'])) echo $ipo_material_indent_detail['indent_qty'];  ?></td>

                                         <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;text-align:center;width:80px;"><?php if(!empty($ipo_material_indent_detail['expected_date'])) echo date('d-m-Y',strtotime($ipo_material_indent_detail['expected_date']));  ?></td>
                                     </tr>  


                            <?php } ?>
                         <?php } ?>             

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
                 <div style="position: fixed;bottom: 80px;text-align: center;width: 100%;">
                        <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                           <tr><td style="width:190px;font-size:15px;"><span style="border-top:1px solid;">PREPARED BY</span></td><td style="width:30px;"></td><td style="width:200px;text-align: center;"><span style="border-top:1px solid;">CHECKED BY</span></td><td style="width:30px;"></td><td  style="width:200px;text-align: center;"><span style="border-top:1px solid;">AUTHORIZED BY</span></td></tr>
                        </table>
                 </div>   
     <?php }else{ ?>
        
           <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                         <tr>
                            <td colspan="2" style="text-align:left;">Indent No.: <?php echo $ipo_material_indent[0]['ipo_number']; ?></td>
                            <td  style="text-align:right;">Date: <?php echo date('d-m-Y',strtotime($ipo_material_indent[0]['date'])); ?></td>
                        </tr>
                          <tr>
                            <td colspan="2" style="text-align:left;">Project: <?php echo strtoupper($ipo_material_indent[0]['dep_description']); ?></td>
                            <td  style="text-align:right;"></td>
                        </tr>  
                        <tr id="row_1">
                            
                                     <th style="border-left:1px solid;border-top:1px solid;width:250px;">Service name </th> 
                                     <th style="border-left:1px solid;border-top:1px solid;">Expected Date</th>
                                     <th style="border-left:1px solid;border-top:1px solid;border-right: 1px solid;width:80px;width:250px;">Remark </th> 

                             </tr>

                            <?php 
                                  $count=count($ipo_material_indent_details);
                                 $i=0; foreach($ipo_material_indent_details as $ipo_material_indent_detail){ $i++;
                                   //  $total_value=$total_value+$budgeted_item['budget_value'];
                                  ?>
                                   <?php  if($count==$i){ ?>

                                      <tr id="row_1">
                                         <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">
                                                <?php foreach ($services as $service) { ?>
                                                    <?php if($service['id']==$ipo_material_indent_detail['service_id']) echo $service['service_name']; ?>
                                                <?php } ?>
                                         </td>
                                        

                                         <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align:center;"><?php if(!empty($ipo_material_indent_detail['expected_date'])) echo date('d-m-Y',strtotime($ipo_material_indent_detail['expected_date']));  ?></td>
                                         <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"><?php if(!empty($ipo_material_indent_detail['remark'])) echo $ipo_material_indent_detail['remark'];  ?></td>
                                     </tr>  


                               <?php  }else{ ?>   
                                        <tr id="row_1">
                                          <td style="border-left:1px solid;border-top:1px solid;">
                                               <?php foreach ($services as $service) { ?>
                                                    <?php if($service['id']==$ipo_material_indent_detail['service_id']) echo $service['service_name']; ?>
                                                <?php } ?>
                                          </td>
                                         
                                         <td style="border-left:1px solid;border-top:1px solid;text-align:center;"><?php if(!empty($ipo_material_indent_detail['expected_date'])) echo date('d-m-Y',strtotime($ipo_material_indent_detail['expected_date']));  ?></td>
                                         <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;"><?php if(!empty($ipo_material_indent_detail['remark'])) echo $ipo_material_indent_detail['remark'];  ?></td>
                                     </tr>  


                            <?php } ?>
                         <?php } ?>             

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
                  <div style="position: fixed;bottom: 80px;text-align: center;width: 100%;">
                        <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                           <tr><td style="width:190px;font-size:15px;"><span style="border-top:1px solid;">PREPARED BY</span></td><td style="width:30px;"></td><td style="width:200px;text-align: center;"><span style="border-top:1px solid;">CHECKED BY</span></td><td style="width:30px;"></td><td  style="width:200px;text-align: center;"><span style="border-top:1px solid;">AUTHORIZED BY</span></td></tr>
                        </table>
                  </div>   
    
     <?php }  ?>
        
    
</div>
<div class="clearfix"></div>
 

