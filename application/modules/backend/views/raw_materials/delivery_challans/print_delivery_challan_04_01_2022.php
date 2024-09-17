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
}
table tr td, table tr th{
    padding: 1px 5px;
     vertical-align: initial;
     
}
    
</style>




<!--<div style="padding:50px; width:60%; margin: 0 auto">-->
<div>
   
           
    <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;"><img style="width: 120px;margin-top: -12px;position: absolute;margin-left: -140px;" src="<?php echo site_url('images/kmix.jpg')?>"> <span>KARIM ASPHALT & READY MIX LTD.</span> </h2>
    <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">(A Unit Of Karim Group)</p>
    <p style="text-align: right;">SL-<?php echo $delivery_challan_info[0]['dc_id']; ?></p>
    <hr>
    <p style=" text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 30px;margin-bottom: 4px;">DELIVERY CHALLAN</p>
    
    <p style="width:70%;float:left"><b>CH.No.: <?php echo ucfirst($delivery_challan_info[0]['dc_no']); ?></b><br><br>
   
    </p>
     <div style="float:right;width:30%;">
         <b style="position: absolute;right: 13px;">Date: <?php  echo date('d-m-Y',strtotime($delivery_challan_info[0]['delivery_challan_date'])); ?></b><br><br>
<!--     <div style="border:1px solid;padding: 10px">
         <b>Delivery Date : <?php  //echo date('d-m-Y',strtotime($delivery_challan_info[0]['delivery_order_date'])); ?></b><br>
         <b>Delivery Time : </b>
     </div>-->
     </div>
     <div style="clear: both;"></div>
     
     <div style="float: left;width: 48%;border:1px solid;border-top:none;">
       
        <h3 style="background:#eee; border-bottom: 1px solid;border-top:1px solid;border-right:1px solid;text-align: center;margin: 0;padding:10px 0px">CUSTOMER INFORMATION</h3>
        <table class="table table-bordered table-hover table-striped" style="width:100%">
            
            <tr>
                <td style="width:33%;"><b>Name</b></td>
                <td>: <b><?php echo ucfirst($delivery_challan_info[0]['c_name']); ?></b></td>
            </tr>
            <tr>
                <td style="width:33%;"><b>Address</b> </td>
                <td>: <?php echo ucfirst($delivery_challan_info[0]['c_contact_address']); ?></td>
            </tr>

            
        </table>
        <div style=" border-top: 1px solid;">
          <table class="table table-bordered table-hover table-striped" style="width:100%">
            
            <tr>
                <td style="width:33%;"><b>Driver Name</b></td>
                <td>: <?php  echo $delivery_challan_info[0]['driver_name']; ?></td>
            </tr>
            
            <tr>
                <td><b>Helper Name</b></td>
                <td>: <?php  echo $delivery_challan_info[0]['helper_name']; ?></td>
            </tr>
            
            
            
        </table>  
        </div>
    </div>
    
    <div style="float: right;width: 48%;border:1px solid;border-top:none; margin-bottom: 30px;">
        
        <h3 style="background:#eee; border-bottom: 1px solid;border-top:1px solid;border-left:1px solid;text-align: center;margin: 0;padding: 10px 0px">CONTACT INFORMATION</h3>
        <table class="table table-bordered table-hover table-striped" style="width:100%">
            
            
            <tr>
                <td style="width:30%;"><b>Address</b> </td>
                <td>: <?php  echo $delivery_challan_info[0]['shipping_address']; ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Contact Person</b></td>
                <td>: <?php  echo $delivery_challan_info[0]['contact_person']; ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Contact Number</b></td>
                <td>: <?php  echo $delivery_challan_info[0]['contact_no']; ?></td>
            </tr>
            
        </table>  
        <div style=" border-top: 1px solid;">
          <table  class="table table-bordered table-hover table-striped" style="width:100%">
            
            <tr>
                <td style="width:40%;"><b>Passing Time </b></td>
                <td>: <?php  echo $delivery_challan_info[0]['challan_time']; ?></td>
            </tr>
            <tr>
                <td style="width:40%;"><b>Truck Number</b> </td>
                <td>: <?php  echo $delivery_challan_info[0]['truck_no']; ?></td>
            </tr>
           
            
            
        </table>  
        </div>
    </div>
      <div style="clear: both;"></div>
     <table class="table table-bordered table-hover table-striped" border="1" style="width:100%;text-align: center;margin-bottom: 20px;">
           
           
         
          
          
           
                <tr>
                       
                    <th style="vertical-align: middle;" >PRODUCT NAME</th>
                    <th style="vertical-align: middle;" >Origin</th>
                    <th style="vertical-align: middle;" >MU.</th>     
                    <th style="vertical-align: middle;" >Quantity</th>      
                        
                        
                   
                </tr>
                
                 <?php $i=0; foreach($delivery_challan_details_info as $delivery_challan_details){ $i++;
                        $total_value=$total_value+$delivery_challan_details['amount'];
                     ?>    
                <tr>
                   <td style="height:50px;vertical-align: middle;">
                         <?php if(!empty($delivery_challan_details['item_name'])) echo $delivery_challan_details['item_name'];  ?>
                   </td>
                   <td style="height:50px;vertical-align: middle;">
                         <?php if(!empty($delivery_challan_details['origin'])) echo $delivery_challan_details['origin'];  ?>
                   </td>
                   
                   <td style="height:50px;vertical-align: middle;">
                         <?php if(!empty($delivery_challan_details['meas_unit'])) echo $delivery_challan_details['meas_unit'];  ?>
                   </td>
                   <td style="height:50px;vertical-align: middle;">
                       
                          <?php 
                               
                                    if(!empty($delivery_challan_details['quantity'])) echo $delivery_challan_details['quantity']; 
                                
                          
                          ?>
                   </td>
                   
                 
                 
                  
                        
                 </tr>
             <?php } ?>   
                     
           </table>
    
    
     
    <div style="clear: both;"></div>
    
    <div style="position: fixed;bottom: 50px;text-align: center;width:100%">
    <table class="table table-bordered table-hover table-striped" style="width:98%">
       <tr>
           <td style="font-size:15px;"><span style="border-top:1px solid;">PREPARED BY</span></td>
           
           <td style="text-align: right;"><span style="border-top:1px solid;">RECEIVED BY</span></td>
           
<!--           <td  style="text-align: right;"><span style="border-top:1px solid;">CHECKED BY</span></td>
           
            <td  style="text-align: right;"><span style="border-top:1px solid;">AUTHORIZED BY</span></td></tr>-->
    </table>
        
         
    </div>
    <div style="clear: both;"></div>
   
    
</div>

 