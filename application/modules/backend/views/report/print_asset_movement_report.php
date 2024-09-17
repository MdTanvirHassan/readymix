
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
    <p style=" text-align: center;margin-top:-15px;">Asset Movement Report 
        <?php

             if($item_check=='all'){
                 echo "Of  All Project";
             }else{
                 echo "Of ".$group_info[0]['dep_description']." Project";
             }
         
       ?>
    </p>
   
     
                               <?php if($item_check=="all"){ ?>
                                                    <table id="workprogram" style="width:100%;font-size: 11px;" id="player_table" class="fixed_headers table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                                                          <thead>
                                                               
                                                              <tr>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">SL</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Name Of Assets</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Origin</th>
                                                                 <th style="border-left:1px solid;border-top:1px solid;">User Deptt.</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Tag No.</th>
                                                                  
                                                              </tr>
                                                              
                                                          </thead>
                                                      <tbody>
                                                              <?php if(!empty($project)){ ?>
                                                                           $count=0;
                                                                           $j=0;
                                                                         <?php foreach($project as $key1=>$grp){ 
                                                                             $count=$count+count($grp['project_items']);
                                                                             if(empty($grp['project_items'])){
                                                                                continue; 
                                                                             }
                                                                             
                                                                             ?>
                                                                                            <tr><td colspan="6" style="text-align:left;border-left:1px solid;border-top:1px solid;border-right:1px solid;"><?php echo $grp['dep_description'] ?></td></tr>
                                                                                <?php 
                                                                                   
                                                                                      $i=0;
                                                                                        foreach($grp['project_items'] as $key=>$data_info){ 
                                                                                            $i++;
                                                                                            $j++;
                                                                                           
                                                                                    ?>
                                                                                         <?php if($j==$count){ ?>   
                                                                                            <tr>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $i; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['item_name']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['origin']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['c_c_name']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align: center;border-bottom:1px solid;"><?php echo $data_info['total']; ?></td>
                                                                                                 
                                                                                                <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"><?php echo "WCL-".$data_info['item_code']; ?></td>

                                                                                            </tr>
                                                                                         <?php }else{ ?> 
                                                                                                 <tr>
                                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $i; ?></td>
                                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['item_name']; ?></td>
                                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['origin']; ?></td>
                                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['c_c_name']; ?></td>
                                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['total']; ?></td>

                                                                                                    <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;"><?php echo "WCL-".$data_info['item_code']; ?></td>

                                                                                                </tr>
                                                                                         <?php } ?>   
                                                                                <?php } ?>
                                                                                            
                                                                         <?php } ?>
                                                              <?php }else{ ?>
                                                                     <tr>
                                                                         <td colspan="6" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                                                     </tr>
                                                              <?php } ?>
                                                     </tbody>


                                          </table>
                                <?php }else{ ?>
                                                <table id="workprogram" style="width:100%;font-size: 11px;" id="player_table" class="table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                                                          <thead>

                                                            <tr>
                                                                   <th style="border-left:1px solid;border-top:1px solid;">SL</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Name Of Assets</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Origin</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">User Deptt.</th> 
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Tag No.</th>
                                                                  
                                                              </tr>
                                                          </thead>
                                                      <tbody>
                                                              <?php if(!empty($items)){ 
                                                                    $total_value=0;
                                                                     $i=0;
                                                                   $count=count($items);
                                                                  
                                                                  ?>
                                                                       
                                                                         <?php foreach($items as $data_info){ 
                                                                             $i++;
                                                                             $j++;
                                                                          
                                                                             
                                                                             ?> 
                                                                                  <?php if($j==$count){ ?>   
                                                                                            <tr>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $i; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['item_name']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['origin']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['c_c_name']; ?></td>
                                                                                                <td style="border-left:1px solid;border-top:1px solid;text-align: center;border-bottom:1px solid;"><?php echo $data_info['total']; ?></td>
                                                                                                 
                                                                                                <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;"><?php echo "WCL-".$data_info['item_code']; ?></td>

                                                                                            </tr>
                                                                                         <?php }else{ ?> 
                                                                                                 <tr>
                                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $i; ?></td>
                                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['item_name']; ?></td>
                                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['origin']; ?></td>
                                                                                                    <td style="border-left:1px solid;border-top:1px solid;"><?php echo $data_info['c_c_name']; ?></td>
                                                                                                    <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['total']; ?></td>

                                                                                                    <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;"><?php echo "WCL-".$data_info['item_code']; ?></td>

                                                                                                </tr>
                                                                                         <?php } ?>   
                                                                         <?php } ?>
                                                                                
                                                              <?php }else{ ?>
                                                                     <tr>
                                                                         <td colspan="6" style="text-align:center;border-left:1px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;">No Data Found</td>
                                                                     </tr>
                                                              <?php } ?>
                                                     </tbody>


                                          </table>
                                <?php } ?>
                       
                  
    
</div>
<div class="clearfix"></div>