<!DOCTYPE html>
<html>
  <head>
<title>Print MRR</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<style>
   @page {
  
  size: A4;
  margin-top:10px;
  margin-bottom:10px;
  margin-left:10px;
  margin-right:10px;
  
}
.table thead {display: table-header-group;}
    .empty-header {
       height:150px;

}
.empty-footer{
    height:80px;

}
.header{
position: fixed;
height:150px;
top: 0;
width:100%
}

.footer {
    height:80px;
    position: fixed;
     bottom:1px;
     width:100%
}

.table-bordereds>tbody>tr>td, .table-bordereds>tbody>tr>th, .table-bordereds>tfoot>tr>td, .table-bordereds>tfoot>tr>th, .table-bordereds>thead>tr>td, .table-bordereds>thead>tr>th {
    border: 1px solid #000;
}
.table>thead:first-child>tr:first-child>th{
  border-top: 1px solid;
}
</style>
  </head>
  <body>
  <div id="content" class="container-fluid">
    <table style="width:100%;">
<thead><th><td><div class="empty-header"></div></td></th></thead>
<tbody><tr><td><div class="content">
<div style="width:100%;">
    <div style="width:50%;float:left;font-size:14px;">
    <b>TO</b><br>
    <p style="margin:0;font-size:14px;"><b>The</b> <b style="border-bottom:1px solid;display: inline-block;width: 90%;text-align:center;"><?php echo $receive_items[0]['dept_name']?></b></p>
     

     <p style="margin:0;font-size:14px;"><b>Dept./ Section:</b> <b style="border-bottom:1px solid;display: inline-block;width: 70%;text-align:center;"><?php echo $receive_items[0]['dept_name']?> </b></p>
    
    </div>
    <div style="width:25%;float:right;">
    <p style="margin:0;font-size:14px;"><b style="width:15%;">Q.C.No.</b>  <b style="border-bottom:1px solid;display: inline-block;width: 60%;text-align:center;"><?php echo $mrr[0]['qc_no']?></b></p>
    
    <p style="margin:0;font-size:14px;"><b style="width:15%;">DATE </b> <b style="border-bottom:1px solid;display: inline-block;width: 60%;text-align:center;"><?php echo date('d-m-Y',strtotime($mrr[0]['mrr_date'])); ?> </b></p>
    
    </div>
    </div>
    <p style="width:100%;float:left;font-size:14px;margin-top:10px;">
    please check the Quality,Size,Origing,Suitability etc. of the following materials received in the Genaral Store on : <b style="width: 250px;border-bottom:1px dotted;display: inline-block;text-align: center;"></b>
    from the Supplier:<b style="width: 350px;border-bottom:1px dotted;display: inline-block;text-align: center;"><?php echo $mrr[0]['SUP_NAME']; ?></b>  Address: <b style="width: 400px;border-bottom:1px dotted;display: inline-block;text-align: center;"><?php echo $mrr[0]['ADDRESS']; ?></b> Aganist <b style="width: 200px;border-bottom:1px dotted;display: inline-block;text-align: center;"></b>
     Date: <b style="width: 100px;border-bottom:1px dotted;display: inline-block;text-align: center;"><?php echo date('d-m-Y',strtotime($mrr[0]['mrr_date'])); ?></b> Via Challan/Invoice <b style="width: 200px;border-bottom:1px dotted;display: inline-block;text-align: center;"><?php echo $mrr[0]['mrr_challan']; ?></b> Date: <b style="width: 200px;border-bottom:1px dotted;display: inline-block;text-align: center;"><?php echo $mrr[0]['mrr_challan_date']; ?></b>, Let me have your
    report regarding its/their correctness and acceptability or otherwise, so that the same can be received
formally through a material receiving report

    </p>
    
     
     
     <div style="clear: both;"></div>
     <b style="float:right;border-top:1px solid;margin-top:40px;margin-bottom:30px;">Store In-charge</b>
    <br/>
<table class="table table-bordereds" style="margin:3px; width:100%;font-size:13px;">
            <!-- <tr style="position:fixed;">  -->
            <thead><tr>    
                    <th>SL</th>
                   <th>Code</th>
                  
                   <th>Name & Description</th> 
                   <th>Part No.</th> 
                   <th>Unit </th>
                   <th style="width:5%;">IPO. Qty</th>
                   <th>Received Qnt</th>
                   <th>IPO No.</th>
                   
                   <th>Remark</th> 
                    </tr><thead>
                    <?php $count=count($receive_items); $total_value=0; ?>
                              <?php $i=0; foreach($receive_items as $receive_item){ $i++;
                                       
                                    ?>

                                        <tr id="">
                                          
                                           <td><?php echo $i;  ?></td>
                                           <td style="text-align:left;"><?php if(!empty($receive_item['item_code'])) echo substr($receive_item['item_code'],3);  ?></td>   
                                           <td style="text-align:left;"><?php if(!empty($receive_item['item_description'])) echo $receive_item['item_description'];  ?></td>   
                                           <td style="text-align:left;"></td> 
                                           <td><?php if(!empty($receive_item['meas_unit'])) echo $receive_item['meas_unit'];  ?></td>  
                                           
                                           <td style="text-align:left;"><?php if(!empty($receive_item['indent_qty'])) echo $receive_item['indent_qty'];  ?></td>
                                           
                                           <td style="text-align:right;"><?php if(!empty($receive_item['receive_qty'])) echo number_format($receive_item['receive_qty'],2);  ?></td>
                                           <td style="text-align:left;"><?php if(!empty($receive_item['ipo_number'])) echo $receive_item['ipo_number'];  ?></td> 
                                           <td><?php if (!empty($receive_item['remark'])) echo $receive_item['remark']; ?></td>
                                       </tr>  
                                         
                                         
                                        
                                         
                                        


                              <?php } ?>
                               
                            
                </table>
</div></td></tr></tbody>
<tfoot><th><td><div class="empty-footer"></div></td></th></tfoot>
</table>
<div class="header">
<h2 style="font-size:25px; text-align: center; margin-bottom: 5px;margin-top:5px;"><img style="width: 120px;margin-top: -12px;position: absolute;margin-left: -140px;" src="<?php echo site_url('images/kmix_logo.png')?>"> <span>KARIM TEX LTD.</span> </h2>
    <p style="text-align: center;margin-bottom:0;font-weight: bold;font-size:15px;">Kalampur, Dhamrai, Dhaka</p>
    <p style="text-align: center;margin-bottom:5px;font-weight: bold;font-size: 15px;">(A Unit of Karim Group)</p>
    <!-- <hr style="margin-top: 5px;margin-bottom:5px;"> -->
    <p style="text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 15px;margin-bottom: 4px;">Quality Certificate</p>
    
    
</div>
<div class="footer">

<div style="width:100%">
                        <div style="font-size:12px;width:33%; text-align: left; float: left;">
                        <p style="margin-bottom: 0px;">A) Checked & Found Correct, May be Received </p>
                        <p style="margin-bottom: 0px;">b) All not found in order, may be received as per my remarks column above.</p>
                        <p style="margin-bottom: 0px;">c) Not found in order and rejected</p>
                        </div>   
                        <div style="font-size:15px;width:33%; text-align: center; font-size:15px;float: left;margin-top:30px;"><span style="border-top:1px solid;">Head of lndenting DePt.</span></div>   
                        <div style="font-size:15px;width:33%; text-align: center; float: left;margin-top:30px;"><span style="border-top:1px solid;">Plant Head</span></div>   
                                           
                       
                    </div>
                
</div>
                    </div>
  </body>
  <script type="text/javascript">
          window.onload = addPageNumbers;

          function addPageNumbers() {
            var totalPages = Math.ceil(document.body.scrollHeight / 1123);  //842px A4 pageheight for 72dpi, 1123px A4 pageheight for 96dpi,
            var j = 0;
            for (var i = 1; i <= totalPages; i++) {
              var pageNumberDiv = document.createElement("div");
              var pageNumber = document.createTextNode("Page " + i + " of " + totalPages);
              pageNumberDiv.style.position = "absolute";
              pageNumberDiv.style.top = "calc((" + j + " * (297mm - 0.5px)) + 10px)"; //297mm A4 pageheight; 0,5px unknown needed necessary correction value; additional wanted 40px margin from bottom(own element height included)
              pageNumberDiv.style.height = "16px";
              pageNumberDiv.appendChild(pageNumber);
              document.body.insertBefore(pageNumberDiv, document.getElementById("content"));
              pageNumberDiv.style.left = "calc(100% - (" + pageNumberDiv.offsetWidth + "px + 20px))";
              j++;
            }
          }
        </script>
</html>