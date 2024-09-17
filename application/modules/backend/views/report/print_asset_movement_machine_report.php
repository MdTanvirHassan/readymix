
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
    <p style=" text-align: center;margin-top:-15px;">Asset Movement Report (Machinewise)
        
    </p>
   
     
                                                    <table id="workprogram" style="width:100%;font-size: 11px;" id="player_table" class="fixed_headers table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                                                          <thead>
                                                               
                                                              <tr>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">SL</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Project Name</th>
                                                                 <th style="border-left:1px solid;border-top:1px solid;">User Deptt.</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;">Qnt</th>
                                                                  <th style="border-left:1px solid;border-top:1px solid;border-right:1px solid;">Remarks</th>
                                                                  
                                                              </tr>
                                                              
                                                          </thead>
                                                      <tbody>
                                                     <?php 
                                                       $i = 0;
                                                      foreach ($project_items as $key => $data_info) {
                                                $i++;
                                            ?>
                                                <tr>
                                                    <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $i; ?></td>
                                                    <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['dep_description']; ?></td>
                                                    <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;"><?php echo $data_info['c_c_name']; ?></td>
                                                    <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: center;"><?php echo $data_info['total']; ?></td>
                                                    <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;"></td>

                                                </tr>
                                            <?php }  ?>
                                                     </tbody>


                                          </table>
                              
                       
                  
    
</div>
<div class="clearfix"></div>