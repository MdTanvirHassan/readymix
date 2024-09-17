<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <p style=" text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 30px;margin-bottom: 4px;">Gate Pass</p>
    
    <div style="width:70%;float:left">
        <b>Number: <?php echo $gate_pass[0]['pass_no'];?></b><br>
        <br>
        <b>Security Incharge</b>
        
    
    </div>
     <div style="float:right;width:30%;">
         <b style="position: absolute;right: 13px;">Date: <?php  echo date('d-m-Y',strtotime($gate_pass[0]['date'])); ?></b><br><br>
     
     </div>
    <div style="clear: both;"></div>
    <p>Please allow to take out the following materials from <b>KMIX-<?php if($project_id == 2) echo 1; else  echo 2;?></b> to  <?php echo $gate_pass[0]['address']?></p>
    <p>Vide challan no. <?php if(!empty($gate_pass[0]['dc_no'])) echo $gate_pass[0]['dc_no']; ?> Through : <?php if(!empty($gate_pass[0]['truck_no'])) echo $gate_pass[0]['truck_no'].'( ' .$gate_pass[0]['driver_name']. ' )' ?> </p>
     
    <div style="width:100%">
        <div style="width:27%;border: 1px solid;float: left;text-align: center;height: 40px;"><span style="line-height:35px;">Kind Of Issue</span><?php if($gate_pass[0]['issue']== 1){?> <i style="font-size:30px;"class="fa fa-check"></i><?php }?></div>
        <div style="width:22%;border: 1px solid;float: left;margin-left: 10px;text-align: center;height: 40px;"><span style="line-height:35px;">Sales</span><?php if($gate_pass[0]['sale']== 1){?> <i style="font-size:30px;"class="fa fa-check"></i><?php }?></div>
        <div style="width:22%;border: 1px solid;float: left;margin-left: 10px;text-align: center;height: 40px;"><span style="line-height:35px;">Non-Returnable</span> <?php if($gate_pass[0]['non-return']== 1){?><i style="font-size:30px;"class="fa fa-check"></i><?php }?></div>
        <div style="width:22%;border: 1px solid;float: left;margin-left: 10px;text-align: center;height: 40px;"><span style="line-height:35px;">Returnable</span> <?php if($gate_pass[0]['return']== 1){?><i style="font-size:30px;"class="fa fa-check"></i><?php }?></div>
    </div>
    <div style="clear: both;"></div>
    <div style="margin-top:30px;">
       <?php $i=1; foreach ($gate_pass_details as $row){?>
    <p> <b><?php echo $i;?> :</b> <?php echo $row['note'];?>   </p>
     <?php $i++; }?> 
    </div> 
     
     
    <div style="clear: both;"></div>
    <div style="position: fixed;bottom: 30px;text-align: center;width:100%">
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
       <tr>
           <td style="width:20%;font-size:15px;"><span style="border-top:1px solid;">ISSUED BY</span></td>
           
           <td style="width:20%;text-align: center;"><span style="border-top:1px solid;">CHECKED BY</span></td>
           
           <td  style="width:20%;text-align: right;"><span style="border-top:1px solid;">APPROVED BY</span></td></tr>
    </table>
        
         
    </div>
    <div style="clear: both;"></div>
   
    
</div>

 