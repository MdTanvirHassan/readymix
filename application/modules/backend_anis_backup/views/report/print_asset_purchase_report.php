
<style>
    #content-table{
        line-height: 18px !important;
    }
    .table{
        
    }
    
</style>



 
<div style="padding:0" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">KARIM ASPHALT & READY MIX LTD.</h>
    <p style=" text-align: center;margin-top:-3px;">(A Unit Of Karim Group)</p>
    <p style=" text-align: center;margin-top:-15px;">Asset Purchase Report 
        <?php
         if($report_format=='general') {
             if($item_check=='all'){
                 echo "Of  All Item";
             }else{
                 echo "Of ".$items[0]['item_name']." Item";
             }
         }else if($report_format=='group'){
             if($item_check=='all'){
                 echo "Of  All Item Group";
             }else{
                 echo "Of ".$group_info[0]['item_group']." Item Group";
             }
         }
       ?>
    </p>
   
     <?php  if(empty($report_format) || ($report_format=='general' && $item_check=="all") || $report_format=='group' ){ ?>
                                <?php if($report_format=='group' && $item_check=="all"){ ?>
                                                    <table id="workprogram" style="width:100%;font-size: 11px;" id="player_table" class="fixed_headers table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                                                          <thead>
                                                               
                                                              <tr>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">SL</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Project Name</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">SN</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Name Of Assets</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Specification</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Origin</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Supplier Details</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">User Deptt.</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Type of Assets</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Dop</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Rate </th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;margin-right:1px solid;">Value</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Tag No.</th>
                                                                  
                                                              </tr>
                                                              
                                                          </thead>
                                                      <tbody>
                                                              <?php if(!empty($group)){ 
                                                                     $count=count($group);
                                                                     $j=0;
                                                                  ?>
                                                                         <?php foreach($group as $key1=>$grp){ 
                                                                             $j++;
                                                                             if(empty($grp['group_items'])){
                                                                                continue; 
                                                                             }
                                                                             
                                                                             ?>
                                                                                            <tr><td colspan="14" style="text-align:left;border-left:1px solid;border-top:1px solid;border-right:1px solid;"><?php echo $grp['item_group'] ?></td></tr>
                                                                                <?php 
                                                                                        $total_value=0;
                                                                                      $i=0;
                                                                                        foreach($grp['group_items'] as $key=>$data_info){ 
                                                                                            $i++;
                                                                                            $value=$data_info['unit_price']*$data_info['receive_qty'];
                                                                                            $total_value=$total_value+$value;
                                                                                            
                                                                                            
                                                                                            
                                                                                    ?>
                                                                                            <tr>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $i; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['dep_description']; ?></td>

                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['group_short_name']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['item_name']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['item_description']; ?></td>

                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['origin']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['SUP_NAME'].",".$data_info['ADDRESS']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['c_c_name']; ?></td>

                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['c_name']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo date('d-m-Y',strtotime($data_info['receive_date'])); ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['receive_qty']; ?></td>

                                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['unit_price']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align: right;"><?php echo $value; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;"><?php echo "WCL-".$data_info['item_code']; ?></td>

                                                                                            </tr>
                                                                                <?php } ?>
                                                                                            <?php if(!empty($grp['group_items'])){ ?>
                                                                                               <?php if($j !=$count){ ?>
                                                                                                        <tr>
                                                                                                            <td colspan="12" style="text-align: right;border-left:1px solid;border-top:1px solid;">Total</td><td style="text-align:right;border-left:1px solid;border-top:1px solid;"><?php if(!empty($total_value)) echo (int) $total_value;else echo "-";  ?></td><td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;"></td>

                                                                                                       </tr>
                                                                                               <?php }else{ ?>
                                                                                                        <tr>
                                                                                                            <td colspan="12" style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td><td style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($total_value)) echo (int) $total_value;else echo "-";  ?></td><td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"></td>

                                                                                                       </tr>
                                                                                               <?php } ?>        
                                                                                            <?php } ?>
                                                                         <?php } ?>
                                                              <?php }else{ ?>
                                                                     <tr>
                                                                         <td colspan="14" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                                                     </tr>
                                                              <?php } ?>
                                                     </tbody>


                                          </table>
                                <?php }else{ ?>
                                                <table id="workprogram" style="width:100%;font-size: 11px;" id="player_table" class="table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                                                          <thead>

                                                            <tr>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">SL</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Project Name</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">SN</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Name Of Assets</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Specification</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Origin</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Supplier Details</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">User Deptt.</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Type of Assets</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Dop</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Rate </th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Value</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Tag No.</th>
                                                                  
                                                              </tr>
                                                          </thead>
                                                      <tbody>
                                                              <?php if(!empty($items)){ 
                                                                    $total_value=0;
                                                                     $i=0;
                                                                   
                                                                  
                                                                  ?>
                                                                       
                                                                         <?php foreach($items as $data_info){ 
                                                                             $i++;
                                                                            $value=$data_info['unit_price']*$data_info['receive_qty'];
                                                                            $total_value=$total_value+$value;
                                                                          
                                                                             
                                                                             ?> 
                                                                                 <tr>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $i; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['dep_description']; ?></td>

                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['group_short_name']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['item_name']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['item_description']; ?></td>

                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['origin']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['SUP_NAME'].",".$data_info['ADDRESS']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['c_c_name']; ?></td>

                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['c_name']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;"><?php echo date('d-m-Y',strtotime($data_info['receive_date'])); ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['receive_qty']; ?></td>

                                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['unit_price']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align: right;"><?php echo $value; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;"><?php echo "WCL-".$data_info['item_code']; ?></td>

                                                                                 </tr>
                                                                         <?php } ?>
                                                                                  <tr>
                                                                                        <td colspan="12" style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td><td style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($total_value)) echo (int) $total_value;else echo "-";  ?></td><td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"></td>

                                                                                   </tr>
                                                              <?php }else{ ?>
                                                                     <tr>
                                                                         <td colspan="14" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                                                     </tr>
                                                              <?php } ?>
                                                     </tbody>


                                          </table>
                                <?php } ?>
                       <?php }else{ ?>
                                    <table id="workprogram" style="width:100%;font-size: 11px;" id="player_table" class="table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                                        <thead>
                                               <tr>
                                                    <th style="border-left:1px solid;border-top:1px solid;">SL</th>
                                                    <th style="border-left:1px solid;border-top:1px solid;">Project Name</th>
                                                    <th style="border-left:1px solid;border-top:1px solid;">SN</th>
                                                    <th style="border-left:1px solid;border-top:1px solid;">Name Of Assets</th>
                                                    <th style="border-left:1px solid;border-top:1px solid;">Specification</th>
                                                    <th style="border-left:1px solid;border-top:1px solid;">Origin</th>
                                                    <th style="border-left:1px solid;border-top:1px solid;">Supplier Details</th>
                                                    <th style="border-left:1px solid;border-top:1px solid;">User Deptt.</th>
                                                    <th style="border-left:1px solid;border-top:1px solid;">Type of Assets</th>
                                                    <th style="border-left:1px solid;border-top:1px solid;">Dop</th>
                                                    <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                    <th style="border-left:1px solid;border-top:1px solid;">Rate </th>
                                                    <th style="border-left:1px solid;border-top:1px solid;">Value</th>
                                                    <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Tag No.</th>

                                                </tr>
                                       
                                        </thead>
                                    <tbody>
                                            <?php if(!empty($items)){ 
                                                $total_value=0;
                                                $i=0;
                                                ?>
                                                       <?php foreach($items as $data_info){ 
                                                           $value=$data_info['unit_price']*$data_info['receive_qty'];
                                                           $total_value=$total_value+$value;
                                                           $i++;
                                                           ?> 
                                                               <tr>
                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $i; ?></td>
                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['dep_description']; ?></td>

                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['group_short_name']; ?></td>
                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['item_name']; ?></td>
                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['item_description']; ?></td>

                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['origin']; ?></td>
                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['SUP_NAME'].",".$data_info['ADDRESS']; ?></td>
                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['c_c_name']; ?></td>

                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['c_name']; ?></td>
                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo date('d-m-Y',strtotime($data_info['receive_date'])); ?></td>
                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['receive_qty']; ?></td>

                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['unit_price']; ?></td>
                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align: right;"><?php echo $value; ?></td>
                                                                    <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;"><?php echo "WCL-".$data_info['item_code']; ?></td>

                                                               </tr>
                                                       <?php } ?>
                                                        <tr>
                                                            <td colspan="12" style="text-align: right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">Total</td><td style="text-align:right;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php if(!empty($total_value)) echo (int) $total_value;else echo "-";  ?></td><td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"></td>

                                                       </tr> 
                                            <?php }else{ ?>
                                                   <tr>
                                                       <td colspan="14" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                                   </tr>
                                            <?php } ?>
                                   </tbody>


                        </table>
                       <?php } ?>
                  
    
</div>
<div class="clearfix"></div>