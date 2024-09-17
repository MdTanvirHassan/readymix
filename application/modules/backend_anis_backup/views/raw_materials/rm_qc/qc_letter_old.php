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
        margin-left: 20px;
        margin-right: 20px;
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
    <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;"><img style="width: 120px;margin-top: -12px;position: absolute;margin-left: -140px;" src="<?php echo site_url('images/kmix_logo.png')?>"> <span>KARIM TEX LTD.</span> </h2>
    <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">Kalampur, Dhamrai, Dhaka</p>
    <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">(A Unit of Karim Group)</p>
    <hr>
    <p style="text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 18px;margin-bottom: 4px;">Quality Certificate</p>
    
    <div style="width:100%;">
    <div style="width:50%;float:left;">
    TO<br>
    <p style="margin:0;">The <b style="border-bottom:1px dotted;display: inline-block;width: 90%;text-align:center;"><?php echo $receive_items[0]['dept_name']?></b></p>
     

     <p style="margin:0;">Dept./ Section: <b style="border-bottom:1px dotted;display: inline-block;width: 70%;text-align:center;"><?php echo $receive_items[0]['dept_name']?> </b></p>
    
    </div>
    <div style="width:40%;float:right;">
    <p style="margin:0;">Q.C.No.  <b style="border-bottom:1px dotted;display: inline-block;width: 90%;text-align:center;"><?php echo $mrr[0]['qc_no']?></b></p>
    
    <p style="margin:0;">DATE  <b style="border-bottom:1px dotted;display: inline-block;width: 70%;text-align:center;"><?php echo date('d-m-Y',strtotime($mrr[0]['mrr_date'])); ?> </b></p>
    
    </div>
    </div>
    <p style="width:100%;float:left;margin-bottom:-10px;">
    please check the Quality,Size,Origing,Suitability etc. of the following materials received in the Genaral Store on : <b style="width: 200px;border-bottom:1px dotted;display: inline-block;text-align: center;"></b>
    from the Supplier:<b style="width: 400px;border-bottom:1px dotted;display: inline-block;text-align: center;"><?php echo $mrr[0]['SUP_NAME']; ?></b>  Address: <b style="width: 200px;border-bottom:1px dotted;display: inline-block;text-align: center;"><?php echo $mrr[0]['ADDRESS']; ?></b> Aganist <b style="width: 200px;border-bottom:1px dotted;display: inline-block;text-align: center;"></b>
     Date: <b style="width: 100px;border-bottom:1px dotted;display: inline-block;text-align: center;"><?php echo date('d-m-Y',strtotime($mrr[0]['mrr_date'])); ?></b> Via Challan/Invoice <b style="width: 200px;border-bottom:1px dotted;display: inline-block;text-align: center;"><?php echo $mrr[0]['mrr_challan']; ?></b> Date: <b style="width: 200px;border-bottom:1px dotted;display: inline-block;text-align: center;"><?php echo $mrr[0]['mrr_challan_date']; ?></b>, Let me have your
    report regarding its/their correctness and acceptability or otherwise, so that the same can be received
formally through a material receiving report

    </p>
    
     
     
     <div style="clear: both;"></div>
     <b style="float:right;border-top:1px solid;margin-top:40px;margin-bottom:30px;">Store In-charge</b>
    <br/>
    <!-- <div style="page-break-after: always; "> -->
    <!-- <div class="row"> -->
     <div style="border:0px solid black; height:620px">
     <table class="table table-bordered table-hover table-striped" style="margin:3px; width:99%">
         <thead>
               <tr >     
                   
                   <th>SL</th>
                   <th>Code</th>
                  
                   <th>Name & Description</th> 
                   <th>Part No.</th> 
                   <th>Unit </th>
                   <th style="width:5%;">IPO. Qty</th>
                   <th>Recived Qnt</th>
                   <th>IPO No.</th>
                   
                   <th>Remark</th>     
                        
                   
                </tr>
         </thead>   
                <tbody>
                   
                            <?php $count=count($receive_items); $total_value=0; ?>
                              <?php $i=0; foreach($receive_items as $receive_item){ $i++;
                                       
                                    ?>

                                        <tr id="">
                                          
                                           <td><?php echo $i;  ?></td>
                                           <td style="text-align:left;"><?php if(!empty($receive_item['item_code'])) echo $receive_item['item_code'];  ?></td>   
                                           <td style="text-align:left;"><?php if(!empty($receive_item['item_name'])) echo $receive_item['item_name'];  ?></td>   
                                           <td style="text-align:left;"></td> 
                                           <td><?php if(!empty($receive_item['meas_unit'])) echo $receive_item['meas_unit'];  ?></td>  
                                           
                                           <td style="text-align:left;"><?php if(!empty($receive_item['indent_qty'])) echo $receive_item['indent_qty'];  ?></td>
                                           
                                           <td style="text-align:right;"><?php if(!empty($receive_item['receive_qty'])) echo number_format($receive_item['receive_qty'],2);  ?></td>
                                           <td style="text-align:left;"><?php if(!empty($receive_item['ipo_number'])) echo $receive_item['ipo_number'];  ?></td> 
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

                

                              <div class="row footer">
                    <div class="col-md-12" style="width:100%">
                        <div class="col-md-3" style="font-size:15px;width:33%; text-align: left; float: left;">
                        <p>A) Checked & Found Corrent, May be Received </p>
                        <p>b) Checked & Found Corrent, May be Received </p>
                        <p>c) Checked & Found Corrent, May be Received </p>
                        </div>   
                        <div class="col-md-3" style="font-size:15px;width:33%; text-align: center; font-size:15px;float: left;"><span style="border-top:1px solid;">Head of lndenting DePt.</span></div>   
                        <div class="col-md-3" style="font-size:15px;width:33%; text-align: center; float: left;"><span style="border-top:1px solid;">Plant Head</span></div>   
                                           
                        <div style="clear: both;"></div>
                    </div>
                </div>
                <div style="clear: both;"></div>
    
   
    
   
    
</div>

 