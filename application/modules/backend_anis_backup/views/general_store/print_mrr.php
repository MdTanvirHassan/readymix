<style>
@media print{
    .footer{
       position:relative;
       top:-80px; // this sets the footer -20px from the top of the next 
                  //header/page ... 20px above the bottom of target page
                  //so make sure it is more negative than your footer's height.

    }}
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
    height:10px !important;
}
table tr td, table tr th{
    padding: 1px 5px;  
    vertical-align: initial;
}

tr{ 
    overflow: hidden;
    height: 14px;
    white-space: nowrap;
}

</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<!--<div style="padding:50px; width:60%; margin: 0 auto">-->
<div class="container-fluid">
   
    <!-- <div class="row">        -->
    <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;"><img style="width: 120px;margin-top: -12px;position: absolute;margin-left: -140px;" src="<?php echo site_url('images/kmix_logo.png')?>"> <span>KARIM ASPHALT & READY MIX LTD.</span> </h2>
    <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">(A Unit of Karim Group)</p>
    <hr>
    <p style=" text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 24px;margin-bottom: 4px;">MATERIAL RECEIVE REGISTER</p>
    
    <p style="width:50%;float:left;margin-bottom:-10px;">
        <b> MRR No.: <?php echo $mrr[0]['mrr_no']; ?></b><br>  
        <b>MRR Date: <?php echo date('d-m-Y',strtotime($mrr[0]['mrr_date'])); ?></b><br>
        <b>Order No.: <?php echo $mrr[0]['order_no']; ?></b><br>
        <b>Purchase Type: <?php if($mrr[0]['order_no']=="Money Indent") echo "Cash ";else echo 'Credit'; ?></b><br>

    </p>
    
     <div style="float:right;">
      
    
         
     <div style="padding: 10px">
         
         <b>Supplier: <?php echo $mrr[0]['SUP_NAME']; ?></b><br>
         <b>Challan No.: <?php echo $mrr[0]['mrr_challan']; ?></b><br>  
        <b>Challan Date: <?php echo date('d-m-Y',strtotime($mrr[0]['mrr_challan_date'])); ?></b><br>  
        
        
     </div>
     </div>
     <div style="clear: both;"></div>
    <br/>
    <!-- <div style="page-break-after: always; "> -->
    <!-- <div class="row"> -->
     <div style="border:0px solid black; height:620px">
     <table class="table table-bordered table-hover table-striped" style="margin:3px; width:99%">
         <thead>
               <tr >     
                  <!-- <th >Project</th> -->
                   <th>SL</th>
                  
                   <th>Department</th> 
                   <th>Indent No.</th> 
                   <th>Item Description </th>
                   <th style="width:5%;">MU</th>
                   <th>Qnt</th>
                   
                   <th>Remark</th>     
                        
                   
                </tr>
         </thead>   
                <tbody>
                   
                            <?php $count=count($receive_items); $total_value=0; ?>
                              <?php $i=0; foreach($receive_items as $receive_item){ $i++;
                                       
                                    ?>

                                        <tr id="">
                                          
                                           <td><?php echo $i;  ?></td>
                                           <td style="text-align:left;"><?php if(!empty($receive_item['dept_name'])) echo $receive_item['dept_name'];  ?></td>   
                                           <td style="text-align:left;"><?php if(!empty($receive_item['ipo_number'])) echo $receive_item['ipo_number'];  ?></td> 
                                           <td style="text-align:left;"><?php if(!empty($receive_item['item_name'])) echo $receive_item['item_name'];  ?></td>
                                           <td><?php if(!empty($receive_item['meas_unit'])) echo $receive_item['meas_unit'];  ?></td>
                                           <td style="text-align:right;"><?php if(!empty($receive_item['receive_qty'])) echo number_format($receive_item['receive_qty'],2);  ?></td>
                                          
                                           <td><?php if (!empty($receive_item['remark'])) echo $receive_item['remark']; ?></td>
                                       </tr>  


                              <?php } ?>
                         
                </tbody>               
                    <tfoot>    
                            
                    </tfoot>        
                        
           </table>
           <!-- </div> -->
           
           <!-- <div style="position: fixed;bottom:60px;text-align: center;">
    <table class="" style="width:100%;">
        <tr>
            <td style="width:20%;text-align: left;"><span style="border-top:1px solid;">PREPARED BY</span></td>
            <td style="width:20%;text-align: center;"><span style="border-top:1px solid;">Head of Supply Chain</span></td>
            <td style="width:20%;text-align: center;"><span style="border-top:1px solid;">G.M.(A&F)</span></td>
            <td style="width:20%;text-align: center;"><span style="border-top:1px solid;">Director</span></td>
            <td style="width:20%;text-align: right; margin-right:-25px"><span style="border-top:1px solid;">Managing Director</span></td>
        </tr>
    </table>
        
    </div> -->

                              </div>

                <div style="position: fixed;bottom:60px;text-align: center; width:98%">
                    <div style="width:100%">
                        <!--
                        <div style="font-size:15px;width:18%; text-align: left; float: left;"><span style="border-top:1px solid;">Prepared By</span></div>   
                        <div style="font-size:15px;width:22%; text-align: center; font-size:15px;float: left;"><span style="border-top:1px solid;">Head of Supply Chain</span></div>   
                        <div style="font-size:15px;width:20%; text-align: center; float: left;"><span style="border-top:1px solid;">G.M.(A&F)</span></div>   
                        <div style="font-size:15px;width:18%; text-align: center; float: left;"><span style="border-top:1px solid;">Director</span></div>                    
                        <div style="font-size:15px;width:20%; text-align: right; float: left;"><span style="border-top:1px solid;">Managing Director</span></div>                    
                        <div style="clear: both;"></div>
                        -->
                        <div class="col-md-3" style="font-size:15px;width:25%; text-align: left; float: left;"><span style="border-top:1px solid;">Prepared By</span></div>   
                        <div class="col-md-3" style="font-size:15px;width:25%; text-align: center; font-size:15px;float: left;"><span style="border-top:1px solid;">Recommended By</span></div>   
                        <div class="col-md-3" style="font-size:15px;width:25%; text-align: center; float: left;"><span style="border-top:1px solid;">Authorized By</span></div>   
                        <div class="col-md-3" style="font-size:15px;width:25%; text-align: right; float: left;"><span style="border-top:1px solid;">Approved By</span></div>                    
                        <div style="clear: both;"></div>
                        
                    </div>
                </div>

    <div style="clear: both;"></div>
    
   
    
   
    
</div>

 