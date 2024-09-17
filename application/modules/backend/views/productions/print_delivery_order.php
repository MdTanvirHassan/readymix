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
    <hr>
    <p style=" text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 30px;margin-bottom: 4px;">Delivery order</p>
    
    <p style="width:70%;float:left"><b>D.O. No.: <?php echo ucfirst($delivery_order_info[0]['delivery_no']); ?></b><br><br>
    S.O. No.: <?php echo ucfirst($delivery_order_info[0]['order_no']); ?><br>
Date: <?php  echo date('d-m-Y',strtotime($delivery_order_info[0]['sale_order_date'])); ?>
    </p>
     <div style="float:right;width:30%;">
         <b style="position: absolute;right: 13px;"> Date: <?php echo date('Y-m-d'); ?></b><br><br>
     <div style="border:1px solid;padding: 10px">
         <b>Delivery Date : <?php  echo date('d-m-Y',strtotime($delivery_order_info[0]['delivery_order_date'])); ?></b><br>
         <b>Delivery Time :  <?php if(!empty($delivery_order_info[0]['delivery_time'])) echo $delivery_order_info[0]['delivery_time']; ?></b>
     </div>
     </div>
     <div style="clear: both;"></div>
     <div style="float: left;width: 48%;border:1px solid;">
       
        <h3 style="background:#eee; border-bottom: 1px solid;text-align: center;margin: 0;">CUSTOMER INFORMATION</h3>
        <table class="table table-bordered table-hover table-striped" style="width:100%">
            
            <tr>
                <td style="width:50%;"><b>Name</b></td>
                <td>: <b><?php echo ucfirst($delivery_order_info[0]['c_name']); ?></b></td>
            </tr>
            <tr>
                <td style="width:50%;"><b>Address</b> </td>
                <td>: <?php echo ucfirst($delivery_order_info[0]['c_contact_address']); ?></td>
            </tr>
            <tr>
                <td style="width:50%;"><b>Contact Person</b></td>
                <td>: <?php echo ucfirst($delivery_order_info[0]['attention']); ?></td>
            </tr>
            <tr>
                <td style="width:50%;"><b>Contact Number</b></td>
                <td>: <?php echo ucfirst($delivery_order_info[0]['phone']); ?></td>
            </tr>
            
        </table>  
    </div>
    
    <div style="float: right;width: 48%;border:1px solid; margin-bottom: 30px;">
        
        <h3 style="background:#eee; border-bottom: 1px solid;text-align: center;margin: 0;">PROJECT INFORMATION</h3>
        <table class="table table-bordered table-hover table-striped" style="width:100%">
            
            <tr>
                <td style="width:50%;"><b>Name</b></td>
                <td>: <b><?php  echo $delivery_order_info[0]['project_name']; ?></b></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Address</b> </td>
                <td>: <?php  echo $delivery_order_info[0]['shipping_address']; ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Contact Person</b></td>
                <td>: <?php  echo $delivery_order_info[0]['contact_person']; ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Contact Number</b></td>
                <td>: <?php  echo $delivery_order_info[0]['contact_no']; ?></td>
            </tr>
            
        </table>  
    </div>
      <div style="clear: both;"></div>
     <div style="margin-bottom:20px;margin-top:20px;">
    
     Production Department <br>
Karim Asphalt & Ready Mix Ltd.<br>
Goranchat Bari, Mirpur, Dhaka<br><br>
<b>Attention:</b> Mr. Delawer Hossain & Mr. Shamim<br><br>
Dear concern,<br>
We are pleased to issue the Delivery Order for the following items as per the terms and condition below:
     </div>   
     <table class="table table-bordered table-hover table-striped" border="1" style="width:100%;text-align: center;margin-bottom: 20px;">
           
           
         
          
          
           
                <tr>
                       
                    <th style="vertical-align: middle;" rowspan="2" >PRODUCT NAME</th>
                    <th style="vertical-align: middle;" colspan="2">QUANTITY</th>                 
                    <th style="vertical-align: middle;" rowspan="2">REMARK</th>                   
                </tr>
                <tr>
                   <th>CUM</th>
                   <th>CFT</th>
                        
                 </tr>
                <?php $i=0; foreach($delivery_order_details_info as $delivery_order_details){ $i++;
                        $total_value=$total_value+$delivery_order_details['amount'];
                     ?>    
                <tr>
                   <td>
                         <?php if(!empty($delivery_order_details['product_name'])) echo $delivery_order_details['product_name'];  ?>
                   </td>
                   <td>
                       
                          <?php 
                                if($delivery_order_details['mu_name']=="CFT"){ 
                                     if(!empty($delivery_order_details['quantity'])) echo round(($delivery_order_details['quantity']/35.31),2); 
                                }else{
                                    if(!empty($delivery_order_details['quantity'])) echo $delivery_order_details['quantity']; 
                                }
                          
                          ?>
                   </td>
                   <td>
                        <?php 
                           if($delivery_order_details['mu_name']=="CFT"){ 
                                if(!empty($delivery_order_details['quantity'])) echo $delivery_order_details['quantity']; 
                                
                           }else{
                              if(!empty($delivery_order_details['quantity'])) echo round(($delivery_order_details['quantity']*35.31),2); 
                           }
                        ?>
                       
                   </td>
                   
                 
                   <td>
                         <?php if(!empty($delivery_order_details['remark'])) echo $delivery_order_details['remark']; ?>
                   </td>
                        
                 </tr>
             <?php } ?>   
                     
           </table>
    
    
     
    <div style="clear: both;"></div>
    <div style="position: fixed;bottom: 30px;text-align: center;width:100%">
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
       <tr>
           <td style="width:20%;font-size:15px;"><span style="border-top:1px solid;">PREPARED BY</span></td>
           
           <td style="width:20%;text-align: center;"><span style="border-top:1px solid;">CHECKED BY</span></td>
           
           <td  style="width:20%;text-align: right;"><span style="border-top:1px solid;">STORE IN-CHARGE</span></td></tr>
    </table>
        
         
    </div>
    <div style="clear: both;"></div>
   
    
</div>

 