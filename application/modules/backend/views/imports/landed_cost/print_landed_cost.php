<!DOCTYPE html>
<html>

<head>
    <title>Landed Cost</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
    @page {

        margin: 10px;
        
    }

    html,
    body {
        width: 100%;
    }

    .table thead {
        display: table-header-group;
    }

    .empty-header {
        height: 170px;

    }

    .empty-footer {
        height: 80px;

    }

    .header {
        position: fixed;
        top: 0;
        width: 100%;
    }

    .footer {
        position: fixed;
        bottom: 5px;
        width: 100%
    }

    .table-bordereds>tbody>tr>td,
    .table-bordereds>tbody>tr>th,
    .table-bordereds>tfoot>tr>td,
    .table-bordereds>tfoot>tr>th,
    .table-bordereds>thead>tr>td,
    .table-bordereds>thead>tr>th {
        border: 1px solid #000;
    }

    .table>thead:first-child>tr:first-child>th {
        border-top: 1px solid;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <table style="width:100%;">
            <thead>
                <th>
                <td>
                    <div class="empty-header"></div>
                </td>
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="content">

                            <table class="table table-bordereds"
                                style="margin:3px; margin-top:10px; width:100%;font-size:13px;">
                                <!-- <tr style="position:fixed;">  -->
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Cost Head</th>
                                        <th>Cash Amount(TK.)</th>
                                        <th>Bank Loan Amount(TK.) </th>                                        
                                        <th>Total Amount(TK.)</th>
                                    </tr>
                                </thead>
                               <?php 
                                   $i=0;
                                   foreach($cost_heads as $c_h){ 
                                       $i++;
                                       ?>

                                <tr id="">
                                   
                                    <td><?php echo $i;  ?></td>
                                    <td style="text-align: left;">
                                        <?php echo $c_h['name']; ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <?php if(!empty($c_h['cash_amount'])) echo number_format($c_h['cash_amount'],2); ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <?php if(!empty($c_h['bank_loan_amount'])) echo number_format($c_h['bank_loan_amount'],2); ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <?php if(!empty($c_h['total_amount'])) echo number_format($c_h['total_amount'],2); ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <tr id="row_1">
                                    <td style="text-align:right" colspan="4"><b>Total Taka</b></td>
                                    <td style="height:10px;text-align: right;">
                                        <b><?php if(!empty($cost_info[0]['grand_total_amount'])) echo number_format($cost_info[0]['grand_total_amount']);  ?></b>
                                    </td>
                                    <td style="height:10px;"></td>
                                </tr>
                            </table>
                            <br>
                            <p><b>Taka In Words =
                                    <?php $taka_in_word=convert_number_to_words($cost_info[0]['grand_total_amount']); echo ucwords($taka_in_word);  ?>&nbsp;Taka
                                    Only</b></p>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <th>
                <td>
                    <div class="empty-footer"></div>
                </td>
                </th>
            </tfoot>
        </table>

        <div class="header">
            <h2 style="font-size:25px; text-align: center; margin-left:-90px; margin-top:-8px">
                <img style="width: 120px;" src="<?php echo site_url('images/kmix_logo.png')?>"> <span>KARIM ASPHALT &
                    READY MIX LTD.</span>
            </h2>
            <h2 style="font-size:20px; text-align: center; margin-top:-18px;">
                <span>(A Unit of Karim Group).</span><br>
            </h2>
           
            <div style="width:33%;float:left;padding:5px;">
                <p style="width:50%;float:left">
                   Vessel Name: <b><?php echo $cost_info[0]['mother_vessel_name']; ?></b><br>
                   Cost Number: <b><?php echo $cost_info[0]['cost_number']; ?></b><br>
                   Unit Price($): <b><?php echo $cost_info[0]['unit_price']; ?></b>
                   Under Head($): <b><?php echo $cost_info[0]['uh_unit_price']; ?></b><br>
                </p>
            </div>
            <div style="width:33%;float:left;padding:5px;">

            </div>
            <div style="float:right;margin-right:30px;width: 32%;text-align: right;">
                Lc NO: <b><?php echo $cost_info[0]['lc_no']; ?></b><br>
                Lc Qty: <b><?php echo $cost_info[0]['lc_qty']; ?></b><br>
                Hook Rate(TK.): <b><?php echo round($cost_info[0]['hook_total_amount']/$cost_info[0]['lc_qty'],2); ?></b><br>
                Yard Rate(TK.): <b><?php echo round($cost_info[0]['yard_total_amount']/$cost_info[0]['lc_qty'],2); ?></b><br>
                BDT Rate: <b><?php echo $cost_info[0]['bdt_rate']; ?></b><br>
                <!--
                Print Date: <b><?php echo date("d-m-Y"); ?></b><br>
                Time: <b><?php echo date("h:i a"); ?></b>
                -->
            </div>
        </div>
        <div class="footer">
            <!--
            <div style="width:100%">
                <div style="font-size:15px;width:24%; text-align: center; float: left;"><span
                        style="border-top:1px solid;">Prepared By</span></div>
                <div style="font-size:15px;width:24%; text-align: center; font-size:15px;float: left;"><span
                        style="border-top:1px solid;">Recommended By</span></div>
                <div style="font-size:15px;width:24%; text-align: center; float: left;"><span
                        style="border-top:1px solid;">Authorized By</span></div>
                <div style="font-size:15px;width:24%; text-align: center; float: left;"><span
                        style="border-top:1px solid;">Approved By</span></div>
                <div style="clear: both;"></div>
            </div>
            

        </div>
    </div>
</body>
<script type="text/javascript">
window.onload = addPageNumbers;

function addPageNumbers() {
    var totalPages = Math.ceil(document.body.scrollHeight /
        904); //842px A4 pageheight for 72dpi, 1123px A4 pageheight for 96dpi,
    var j = 0;
    for (var i = 1; i <= totalPages; i++) {
        var pageNumberDiv = document.createElement("div");
        var pageNumber = document.createTextNode("Page " + i + " of " + totalPages);
        pageNumberDiv.style.position = "absolute";
        pageNumberDiv.style.top = "calc((" + j +
            " * (204mm - 0.5px)) + 10px)"; //297mm A4 pageheight; 0,5px unknown needed necessary correction value; additional wanted 40px margin from bottom(own element height included)
        pageNumberDiv.style.height = "16px";
        pageNumberDiv.appendChild(pageNumber);
        document.body.insertBefore(pageNumberDiv, document.getElementById("content"));
        pageNumberDiv.style.left = "calc(100% - (" + pageNumberDiv.offsetWidth + "px + 20px))";
        j++;
    }
}
</script>

</html>