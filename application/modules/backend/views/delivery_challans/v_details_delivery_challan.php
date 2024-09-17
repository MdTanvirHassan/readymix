<style>
   .common-table table tr td, .common-table table tr th{
        text-align: center;
        vertical-align: middle;
    }
</style>
<?php 
    $user_type=$this->session->userdata('user_type');
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
        <?php require_once(__DIR__ .'/../production_header.php'); ?>
    </div>
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3 style="float:left;">Details Delivery Challan</h3>
                <?php if($delivery_challan_info[0]['status']=="Approved"){ ?>
                    <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('delivery_challans/details_delivery_challan/'.$delivery_challan_info[0]['dc_id'].'/true'); ?>" class="btn btn-sm btn-warning">PRINT</a>
                    <?php if($user_type==1 || $user_type==3){ ?>
                        <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('delivery_challans/details_delivery_challan/'.$delivery_challan_info[0]['dc_id'].'/true/half'); ?>" class="btn btn-sm btn-warning">HALF PRINT</a>
                    <?php } ?>    
                <?php } ?>    
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content"> 
                        
                <div class="row">     
                        <table class="table table-bordered" id="myTable">
            <tr>
                <th  style="width:12%;">Delivery Order:</th>
                <td>
                    <?php foreach($delivery_orders as $order){ ?>
                         <?php if($order['do_id']==$delivery_challan_info[0]['do_id']) echo $order['c_short_name'].'('.$order['project_name'].')'.'('.$order['delivery_no'].')'  ?>
                            <?php } ?>
                </td>
                <th  style="width:12%;">Sales Order:</th>
                <td>
                    <?php if(!empty($delivery_challan_info[0]['c_order_no'])) echo $delivery_challan_info[0]['c_order_no'];else echo $delivery_challan_info[0]['order_no'];  ?>
                </td>
                <th  style="width:12%;">C. Name:</th>
                <td>
                    <?php echo $delivery_challan_info[0]['c_name']; ?>
                </td>
                
            
            </tr>
            <tr>
                <th>DC. Number:</th>
                <td>
                 <?php if(!empty($delivery_challan_info[0]['dc_no'])) echo $delivery_challan_info[0]['dc_no']; ?>
                </td>
                <th>Date</th>
                <td>
                    <?php if(!empty($delivery_challan_info[0]['delivery_challan_date'])) echo date('d-m-Y',strtotime($delivery_challan_info[0]['delivery_challan_date'])); ?>
                </td>
                <th>Project Name:</th>
                <td>
                    <?php if(!empty($delivery_challan_info[0]['project_name'])) echo $delivery_challan_info[0]['project_name']; ?>
                </td>
            
            </tr>
            <tr>
                
                <th>Attention:</th>
                <td>
                    <?php if(!empty($delivery_challan_info[0]['attention'])) echo $delivery_challan_info[0]['attention']; ?>
                </td>
                <th>Phone:</th>
                <td>
                    <?php if(!empty($delivery_challan_info[0]['phone'])) echo $delivery_challan_info[0]['phone']; ?>
                </td>
                <th>Contact Person:</th>
                <td>
                    <?php if(!empty($delivery_challan_info[0]['contact_person'])) echo $delivery_challan_info[0]['contact_person']; ?>
               
            </td>
            </tr>
            
            
            
            
            <tr>
                
                 <th>Contact No:</th>
                 <td>
                    <?php if(!empty($delivery_challan_info[0]['contact_no'])) echo $delivery_challan_info[0]['contact_no']; ?>               
                </td>
               
                <th>B. Address:</th>
                <td>
                    <?php if(!empty($delivery_challan_info[0]['billing_address'])) echo $delivery_challan_info[0]['billing_address']; ?>
                </td>
                    
              <th>B. Email:</th>
                <td>
                    <?php if(!empty($delivery_challan_info[0]['billing_email'])) echo $delivery_challan_info[0]['billing_email']; ?>
                </td>
            
            </tr>
            
             <tr>
                  
            
                <th>D. Address:</th>
                <td>
                    <?php if(!empty($delivery_challan_info[0]['shipping_address'])) echo $delivery_challan_info[0]['shipping_address']; ?>
                    
                </td>
                <th>Delivery Date</th>
                <td>
                    <?php if(!empty($delivery_challan_info[0]['challan_date'])) echo date('d-m-Y',strtotime($delivery_challan_info[0]['challan_date'])); ?>
                </td>
                 <th>DC. Time:</th>
                <td>
                  <?php if(!empty($delivery_challan_info[0]['challan_time'])) echo $delivery_challan_info[0]['challan_time']; ?>
                </td>
                 
               
               
               
            
            </tr>
             <tr>
                  
            
                <th>Driver:</th>
                <td>
                    <?php foreach ($drivers as $driver) { ?>
                               <?php if($driver['driver_id']==$delivery_challan_info[0]['driver_id']) echo $driver['driver_name']; ?>
                            <?php } ?>
                    
                </td>
                <th>Helper:</th>
                <td>
                    <?php foreach ($helpers as $driver) { ?>
                               <?php if($driver['helper_id']==$delivery_challan_info[0]['helper_id']) echo $driver['helper_name']; ?>
                            <?php } ?>
                    
                </td>
                <th>Truck</th>
                <td>
                     <?php foreach ($trucks as $truck) { ?>
                               <?php if($truck['truck_id']==$delivery_challan_info[0]['truck_id']) echo $truck['truck_no']; ?>
                            <?php } ?>
                </td>
                
               
               
               
            
            </tr>
            <tr>
                <th>Slump:</th>
                <td>
                  <?php if(!empty($delivery_challan_info[0]['distance'])) echo $delivery_challan_info[0]['distance']; ?>
                </td>
                
                <th>Remark:</th>
                <td>
                  <?php if(!empty($delivery_challan_info[0]['remark'])) echo $delivery_challan_info[0]['remark']; ?>
                </td>
                
                <th>Status:</th>
                <td>
                  <?php if(!empty($delivery_challan_info[0]['status'])) echo $delivery_challan_info[0]['status']; ?>
                </td>
                
            </tr>
            
            <tr>
                <th>Manual Challan No.:</th>
                <td>
                  <?php if(!empty($delivery_challan_info[0]['manual_dc_no'])) echo $delivery_challan_info[0]['manual_dc_no']; ?>
                </td>
                
                <th></th>
                <td>
                  <?php //if(!empty($delivery_challan_info[0]['remark'])) echo $delivery_challan_info[0]['remark']; ?>
                </td>
                
                <th></th>
                <td>
                  <?php //if(!empty($delivery_challan_info[0]['status'])) echo $delivery_challan_info[0]['status']; ?>
                </td>
                
            </tr>
            
                      
                  </table>
    
                    </div>        
                        
                        
                        
                        
                        
    <form action="<?php echo site_url('delivery_challans/edit_delivery_challan_action/'.$delivery_challan_info[0]['dc_id']); ?>" method="post" onsubmit="javascript: return validation()" >
        
        
        
          
       
        <div class="row common-table">
           
                <table class="table table-bordered" id="myTable" >
                    <thead class="thead-color">
                     <tr>
                         <th rowspan="2">Product Name <sup style='color:red'>*</sup></th> 
                          <th colspan="2">Challan Qnty</th>
                          <th colspan="2">Received Qnty</th>             
                         <th rowspan="2">Remarks</th>
                        

                      </tr>
                      <tr>
                         <th>Quantity - <?php echo $delivery_challan_details_info[0]['measurement_unit']; ?></th>              
                         <th>Quantity - CUM</th>  
                         <th>Quantity - <?php echo $delivery_challan_details_info[0]['measurement_unit']; ?></th>              
                         <th>Quantity - CUM</th> 
                      </tr>
                    </thead>
                    <tbody id="challan_items">
                          <?php $i=0; foreach($delivery_challan_details_info as $delivery_challan_details){ 
                            $i++;
                            ?>
                         <tr class="" id="row_">
                             <td><?php echo $delivery_challan_details['product_name'] ?></td>
                          
                             <td><?php echo $delivery_challan_details['quantity'] ?></td>
                             <?php 
                            if($delivery_challan_details['measurement_unit']=='CFT'){
                                if(!empty($delivery_challan_details['challan_qty'])){
                                    $cval=round($delivery_challan_details['challan_qty']/35.31,2);
                                }else{
                                    $cval=round($delivery_challan_details['quantity']/35.31,2);
                                }
                            }else{  
                                if(!empty($delivery_challan_details['challan_qty'])){
                                    $cval=round($delivery_challan_details['challan_qty']/2.41,2);
                                }else{
                                    $cval=round($delivery_challan_details['quantity']/2.41,2);
                                }
                            }?>
                             <td><?php echo $cval; ?></td>
                             
                           <td><?php echo $delivery_challan_details['quantity'] ?></td>
                                 <?php 
                            if($delivery_challan_details['measurement_unit']=='CFT'){
                            $val = round($delivery_challan_details['quantity']/35.31,2);
                            }else{  
                                $val = round($delivery_challan_details['quantity']/2.41,2);
                            }?>
                             <td><?php echo $val; ?></td>
                             <td><?php echo $delivery_challan_details['remarks'] ?></td>
                          
                          </tr>
                        <?php } ?>
                      
                      </tbody>
                       <tfoot>
                           <!--
                            <tr>
                                <td colspan="3" style="text-align:right;"><b>Total</b></td>

                                <td style="text-align: right;"><b><?php if(!empty($delivery_challan_info[0]['total_amount'])) echo $delivery_challan_info[0]['total_amount']; ?></b></td>
                            </tr>
                           -->
                        </tfoot>
                  </table>
           
            
            
            
        </div>
        
       
       
       
        
        <div class="row">
           
           
             <div class="col-md-2">
                <a href="<?php echo site_url('backend/delivery_challans') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

            </div>
            
        </div> 
            
       
    </form>
</div>
</div>
</div>
</div>
</div>
</div>



