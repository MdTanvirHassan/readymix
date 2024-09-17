<style>
    @page {

        margin-top: 0px;

    }

    #content-table {
        line-height: 18px !important;
        font-size: 13px;
    }

    table {
        border-collapse: collapse;

    }

    table tr th {
        background: #eee;

    }

    #maintable tr th,
    #maintable tr td {

        font-size: 12px;
    }

    table tr td,
    table tr th {
        padding: 1px 5px;
    }

    .x_content td,
    th {
        border: 1px solid;
    }

    /*@page:left{
  @bottom-left {
    counter-increment: page;
    content: "Page " counter(pageNumber) " of " counter(pageNumber);
  }
}*/


    @media print {

        /* #header,
        .header-space {
            height: 250px;
        }

        .footer,
        .footer-space {
            height: 100px;
        }

        #header {
            position: fixed;
            top: 0;
            width: 100%;
            /*  text-align: center;*/
        /* }

        .footer {
            position: fixed;
            bottom: -60px;
            ;
        } */




    }


    .pageNumber {
        position: relative;
        height: auto;
        min-height: 10px;
        width: 590px;
        display: block;
        background: rgba(60, 60, 60, 0.28) !important;
        margin: 0 auto 5px;
        page-break-before: always;
        /*This style rule makes every page element start at the top of a new page:*/
        counter-increment: pages;
    }

    /*page numbers*/
    div.pageNumber:after {
        content: " PAGE - "counter(pages);
        position: absolute;
        bottom: 0px;
        right: 15px;
        z-index: 999;
        padding: 2px 12px;
        border-right: 2px solid #23b8e7;
        font-size: 12px;
    }

    @media print {
        a[href]:after {
            content: none !important;
        }
    }
</style>
<?php
$ename = 'All';
foreach ($employees as $employee) { ?>
    <?php if ($sale_person_id == $employee['id']) {
        $ename = $employee['name'];
    } ?>
<?php } ?>
<div id="header">
    <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;"><img style="width: 120px;margin-top: -12px;position: absolute;margin-left: -160px;" src="<?php echo site_url('images/kmix.jpg') ?>"> <span>KARIM ASPHALT & READY MIX LTD.</span> </h2>
    <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">(A Unit of Karim Group)</p>
    <hr>
    <div style="">
        <h1 style="text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size:18px;">SALES ACHIEVEMENT REPORT FOR <?php echo $ename; ?></h1>
        <h3 style="text-align: center;margin-top:-2px">Period : <?php echo $f_date ?> TO <?php echo $to_date ?></h3>

    </div>
    <div style="clear: both;"></div>

</div>


</div>
<br>

<div class="x_content">

    <table id="maintable" class="table table-bordered table-hover table-striped" style="width:100%;text-align: center;margin-bottom: 10px;">


        <tr>
            <th rowspan="2">SN</th>
            <th rowspan="2">Sales Person</th>
            <?php foreach ($product_categories as $c) { ?>
                <th style="text-align:center;" colspan="4"> <?php echo $c['category_name']; ?></th>
            <?php } ?>
            <th rowspan="2">Total</th>
            <th rowspan="2">Paid</th>
            <th rowspan="2">Variance</th>
        </tr>
        <tr style="background:#e5e5e5">
            <?php foreach ($product_categories as $c) { ?>
                <th style="text-align:center;">Qty</th>
                <th style="text-align:center;">Avg</th>
                <th style="text-align:center;">Amount</th>
                <th style="text-align:center;">Paid</th>
            <?php } ?>
        </tr>

        <?php
        $total = 0;
        $achive_total = 0;
        $qty_total = 0;
        $dtotal = 0;
        $dpaid = 0;
        $i = 0;
        foreach ($achievement as $key => $employee) {
            $i++;
            $total = 0;
            $qty_total = 0;
            $paidtotal = 0;
        ?>
            <tr>
                <td><?php echo ($i); ?></td>
                <td style="text-align:left"><?php echo $employee['name']; ?></td>
                <?php foreach ($product_categories as $key => $c) {
                    $total += $employee[$c['category_name']]['amount'];
                    $qty_total += $employee[$c['category_name']]['quantity'];
                    $paidtotal += $employee[$c['category_name']]['paid'];
                    $product_categories[$key]['amt'] += $employee[$c['category_name']]['amount'];
                    $product_categories[$key]['qty'] += $employee[$c['category_name']]['quantity'];
                    $product_categories[$key]['paid'] += $employee[$c['category_name']]['paid'];
                    $dtotal += $employee[$c['category_name']]['amount'];
                    $dpaid += $employee[$c['category_name']]['paid'];
                    $avg = $employee[$c['category_name']]['amount'] / $employee[$c['category_name']]['quantity'];
                    if (is_nan($avg))
                        $avg = 0;
                ?>
                    <td style="text-align:right;"> <?php echo !empty($employee[$c['category_name']]['quantity']) ? number_format($employee[$c['category_name']]['quantity'], 2) : '0.00'; ?></td>
                    <td style="text-align:right;"> <?php echo number_format($avg, 2); ?></td>
                    <td style="text-align:right;"> <?php echo !empty($employee[$c['category_name']]['amount']) ? number_format($employee[$c['category_name']]['amount'], 2) : '0.00'; ?></td>
                    <td style="text-align:right;"> <?php echo number_format($employee[$c['category_name']]['paid'], 2); ?></td>
                <?php } 
                 $variance = (($paidtotal*100)/$total)-100;
                ?>
                <td style="text-align:right;"><?php echo number_format($total, 2); ?></td>
                <td style="text-align:right;"><?php echo number_format($paidtotal, 2); ?></td>
                <td style="text-align:right;"><?php
            if($variance>0) 
            echo number_format($variance, 2); 
            else
            echo '('.number_format(abs($variance), 2).')'; 
            ?></td>
            </tr>

        <?php
        }
        ?>
        <tr>
            <td style="text-align:right;" colspan="2">Total</td>
            <?php foreach ($product_categories as $key => $c) { ?>
                <td style="text-align:right;"><?php echo number_format($c['qty'], 2); ?></td>
                <td></td>
                <td style="text-align:right;"><?php echo number_format($c['amt'], 2); ?></td>
                <td style="text-align:right;"><?php echo number_format($c['paid'], 2); ?></td>

            <?php } 
            $variance = (($dpaid*100)/$dtotal)-100;
            ?>
            <td style="text-align:right;"><?php echo number_format($dtotal, 2); ?></td>
            <td style="text-align:right;"><?php echo number_format($dpaid, 2); ?></td>
            <td style="text-align:right;"><?php
            if($variance>0) 
            echo number_format($variance, 2); 
            else
            echo '('.number_format(abs($variance), 2).')'; 
            ?></td>

        </tr>
    </table>




</div>
</td>
</tr>
</tbody>
<tfoot>
    <tr>
        <td>
            <div class="footer-space">&nbsp;</div>
        </td>
    </tr>
</tfoot>
</table>



















<div style="clear: both;"></div>
<div class="footer">
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;width:100%;text-align:center;">
        <tr>
            <td style="width:20%;margin-left:25%;font-size:15px;"><span style="border-top:1px solid;">Prepeard BY</span></td>
            <td style="width:20%;margin-left:25%;font-size:15px;"><span style="border-top:1px solid;">Checked BY</span></td>
            <td style="width:20%;margin-left:25%;font-size:15px;"><span style="border-top:1px solid;">Approved BY</span></td>
            <td style="width:20%;margin-left:25%;font-size:15px;"><span style="border-top:1px solid;">Received BY</span></td>

        </tr>
    </table>

    <!--<div class="pageNumber"></div>-->
</div>