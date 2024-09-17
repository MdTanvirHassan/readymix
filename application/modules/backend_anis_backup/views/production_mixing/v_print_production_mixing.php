

<style>
    
     @page {
        size: auto;   /* auto is the initial value */
        margin-top: 20px;  /* this affects the margin in the printer settings */
        margin-bottom: 0;
    }
    .table-bordered {
        border: 0px;
    }
    td{
        padding:3px !important;
    }
    input{
        margin:0px !important;
    }
 table { table-layout: fixed; margin-top: 20px}
 table th, table td { overflow: hidden; }
 .table > thead > tr > th {
    padding: 3px;
   
}
 .table > tbody > tr > td{
    padding: 7px;
   
}
.form-control {
	display: block;
	width: 100%;
	height: 34px;
	padding: 6px 5px;
	
}
</style>
<div class="right_col" style="padding-bottom:20px;">
<div class="os-tabs-w menu-shad">
   
    </div>

<div class="">
        
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="row" style="padding:30">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
          
                               <div class="row">
                                    <div class="col-md-4 col-md-offset-4">
                                        <h2 style="text-align:center">Karim Asphalt & Ready Mix Ltd.</h2>
                                        <h2 style="text-align:center">Product Mixing Sheet</h2>

                                    </div>
                                </div>
                   
                
                      
                        
                        
             <input type="hidden" id="count" value="1"/>
               <table class="table table-bordered" id="myTable" style="margin:0 auto;">
                    <thead class="thead-color">
                        <tr >
                                        <th colspan="5" style="border:none;text-align: left;"> Mixing Number: <b> <?php if(!empty($mixing_info[0]['pm_no'])) echo $mixing_info[0]['pm_no']; ?></b></th>
                                       
                                        <th colspan="4" style="border:none;;text-align: left;"> Casting Size(In Cum): <?php if(!empty($mixing_info[0]['casting_size'])) echo $mixing_info[0]['casting_size']; ?></th>
                                    </tr>
                                     <tr >
                                       
                                        <th colspan="5" style="border:none;text-align: left;">Product:  <?php //if(!empty($details_schedule)){ ?>
                                         <?php 
                                     echo $mixing_info[0]['delivery_no'].'('.$mixing_info[0]['product_name'].")";
                                     ?>
<!--                                                    <?php// foreach($details_schedule as $schedule){ ?>
                                       <b> <?php //if($mixing_info[0]['schedule_d_id']==$schedule['id']) echo $schedule['delivery_no'].'('.$schedule['product_name'].")"; ?></b>
                                                    <?php// } ?>
                                           <?php //} ?>         -->
                                        </th>
                                        <th colspan="4" style="border:none;text-align: left;"> Casting Size(In <?php echo $mixing_info[0]['measurement_unit']; ?>): <b>  <?php if(!empty($mixing_info[0]['casting_size_cft'])) echo $mixing_info[0]['casting_size_cft']; ?></b> </th>
                                    </tr>
                     <tr>
                         
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;">Material </th>
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;">Brand</th>
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;">Req. Qnty(For Per Cum)</th> 
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;">T. Req. Qnty</th>
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;">MU</th>   
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;">C. Factor</th>
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;">C. Qnty(Per Cum)</th>
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;">T. C. Qnty</th>                         
                         <th style="text-align: center;border-left:1px solid;border-top:1px solid;border-right:1px solid;">MU</th>


                      </tr>
                    </thead>
                    <tbody id="material_body">
                        <?php if(!empty($mixing_details_info)){ 
                                $i=0;
                                foreach($mixing_details_info as $key=>$m_details){
                                    $i++;
                            ?>
                            <tr id="row_<?php echo $i; ?>">
                                <td style="text-align:left;border-left:1px solid;border-top:1px solid;">                        
                                    <b><?php echo $m_details['item_name']; ?></b>             
                                </td>
                                <td style="text-align:left;border-left:1px solid;border-top:1px solid;">                        
                                    <b><?php echo $m_details['brand']; ?></b>             
                                </td>
                                
                               <td style="text-align:right;border-left:1px solid;border-top:1px solid;">                        
                                    <b><?php echo $m_details['qty']; ?></b>             
                                </td>
                                
                                <td style="text-align:right;border-left:1px solid;border-top:1px solid;">                        
                                    <b><?php echo $m_details['total_qty']; ?></b>             
                                </td>
                                
                                <td style="text-align:left;border-left:1px solid;border-top:1px solid;">                        
                                    <b><?php echo $m_details['mu']; ?></b>             
                                </td>
                                <td style="text-align:right;border-left:1px solid;border-top:1px solid;">                        
                                    <b><?php echo $m_details['conversion_factor']; ?></b>             
                                </td>
                                 <td style="text-align:right;border-left:1px solid;border-top:1px solid;">                        
                                    <b><?php echo $m_details['converted_qty']; ?></b>             
                                </td>
                                 <td style="text-align:right;border-left:1px solid;border-top:1px solid;">                        
                                    <b><?php echo $m_details['total_converted_qty']; ?></b>             
                                </td>
                                 <td style="text-align:left;border-left:1px solid;border-top:1px solid;border-right:1px solid;">                        
                                    <b><?php echo $m_details['converted_mu']; ?></b>             
                                </td>
                                
                            </tr>
                                <?php } ?>
                            <tr>
                                <td style="border-top:1px solid"></td>
                                 <td style="border-top:1px solid"></td>
                                 <td style="border-top:1px solid"></td>
                                 <td style="border-top:1px solid"></td>
                                 <td style="border-top:1px solid"></td>
                                 <td style="border-top:1px solid"></td>
                                 <td style="border-top:1px solid"></td>
                                 <td style="border-top:1px solid"></td>
                                 <td style="border-top:1px solid"></td>
                              
                            </tr>
                            <?php  }else{ ?>
                            <tr>
                                <td colspan="9" style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;">No Data Found</td>
                            </tr>
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
                      </tbody>
                      <tfoot id="foot" style="display:none;">
                   
                        
                      </tfoot>
                  </table>
             
                  <div style="position: fixed;bottom: 80px;text-align: center;width: 100%;">
                        <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                           <tr><td style="width:190px;font-size:15px;margin-left:0px;"><span style="border-top:1px solid;">PREPARED BY</span></td><td style="width:0px;"></td><td style="width:190px;text-align: center;"><span style="border-top:1px solid;">CHECKED BY</span></td><td style="width:30px;"></td><td  style="width:200px;text-align: center;"><span style="border-top:1px solid;">AUTHORIZED BY</span></td></tr>
                        </table>
                  </div>
        
              
                
               
            
                <div class="row">
               
                    
                </div>
            
         
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

