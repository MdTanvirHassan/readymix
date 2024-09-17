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

table tr td, table tr th{
    padding: 1px 5px;
}
    
</style>




<!--<div style="padding:50px; width:60%; margin: 0 auto">-->
<div>
   
           
    <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;"><img style="width: 120px;margin-top: -12px;position: absolute;margin-left: -160px;" src="<?php echo site_url('images/kmix.jpg')?>"> <span>KARIM ASPHALT & READY MIX LTD.</span> </h2>
    <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">(A Unit Of Karim Group)</p>
    <hr>
    <p style=" text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 30px;">PRODUCT MIXING SHEET</p>
    
    <p style="width:70%;float:left"><b>So. No.: <?php echo $mixing_info[0]['order_no']; ?> &nbsp;&nbsp;Date: <?php echo date('d-m-Y',strtotime($mixing_info[0]['sale_order_date'])); ?></b><br>
    <b> Do. No.: <?php echo $mixing_info[0]['delivery_no']; ?> &nbsp;&nbsp;Date: <?php echo date('d-m-Y',strtotime($mixing_info[0]['delivery_order_date'])); ?></b><br>

    </p>
     <div style="float:right;width:30%;">
     <b style="position: absolute;right: 13px;">Mixing Date: <?php echo date('d-m-Y',strtotime($mixing_info[0]['created_date'])); ?></b><br><br>
     <!--
     <div style="border:1px solid;padding: 10px">
         <b>Delivery Date : </b><br>
         <b>Delivery Time : </b>
     </div>
     -->
     </div>
     <div style="clear: both;"></div>
     <div style="float: left;width: 48%;border:1px solid;">
       
        <h3 style="background:#eee; border-bottom: 1px solid;text-align: center;margin: 0;">CUSTOMER INFORMATION</h3>
        <table class="table table-bordered table-hover table-striped" style="width:100%">
            
            <tr>
                <td style="width:30%;"><b>Name</b></td>
                <td>:<?php echo $mixing_info[0]['c_name']; ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Address</b> </td>
                <td>:<?php echo $mixing_info[0]['c_contact_address']; ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Contact Person</b></td>
                <td>:<?php echo $mixing_info[0]['c_contact_person']; ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Contact Number</b></td>
                <td>:<?php echo $mixing_info[0]['c_mobile_no']; ?></td>
            </tr>
            
        </table>  
    </div>
    
    <div style="float: right;width: 48%;border:1px solid; margin-bottom: 30px;margin-top:5px;">
        
        <h3 style="background:#eee; border-bottom: 1px solid;text-align: center;margin: 0;">PROJECT INFORMATION</h3>
        <table class="table table-bordered table-hover table-striped" style="width:100%">
            
            <tr>
                <td style="width:30%;"><b>Name</b></td>
                <td>:<?php echo $mixing_info[0]['project_name']; ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Address</b> </td>
                <td>:<?php echo $mixing_info[0]['shipping_address']; ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Contact Person</b></td>
                <td>:<?php echo $mixing_info[0]['contact_person']; ?></td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Contact Number</b></td>
                <td>:<?php echo $mixing_info[0]['contact_number']; ?></td>
            </tr>
            
        </table>  
    </div>
      <div style="clear: both;"></div>
      
      <p style="width:75%;float:left"><b>Product Name :  <?php 
                                     echo $mixing_info[0]['delivery_no'].'('.$mixing_info[0]['product_name'].")";
                                     ?></b></p>
    <p style="float:right;width:25%;text-align: right;">
    <table class="table table-bordered table-hover table-striped" border="1">
        <tr>
            <th rowspan="2">Casting Size</th>
            <th >CUM</th>
            <th >CFT</th>
        </tr>
        <tr>
            
            <th><?php if(!empty($mixing_info[0]['casting_size'])) echo $mixing_info[0]['casting_size']; ?></th>
            <th><?php if(!empty($mixing_info[0]['casting_size_cft'])) echo $mixing_info[0]['casting_size_cft']; ?></th>
        </tr>
    </table>
    </p>
      
      
        
     <table class="table table-bordered table-hover table-striped" border="1" style="width:100%;text-align: center;margin-bottom: 20px;">
           
         <tr>
             <th>Material</th>
             <th>Brand</th>
             <th>Req.Qnty(For per cum)</th>
             <th>T.Reg.Qnty</th>
             <th>MU</th>
             <th>C.Factor</th>
             <th>C.Qnty(For per cum)</th>
             <th>T.C.Qnty</th>
             <th>MU</th>
         </tr>
         <?php if(!empty($mixing_details_info)){ 
            $i=0;
            foreach($mixing_details_info as $key=>$m_details){
                $i++;
        ?>
            <tr>
                <td><?php echo $m_details['item_name']; ?></td>
                <td><?php echo $m_details['brand']; ?></td>
                <td><?php echo $m_details['qty']; ?></td>
                <td><?php echo $m_details['total_qty']; ?></td>
                <td><?php echo $m_details['mu']; ?></td>
                <td><?php echo $m_details['conversion_factor']; ?></td>
                <td><?php echo $m_details['converted_qty']; ?></td>
                <td><?php echo $m_details['total_converted_qty']; ?></td>
                <td><?php echo $m_details['converted_mu']; ?></td>
            </tr>
         
          <?php } } ?>        
                     
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

 