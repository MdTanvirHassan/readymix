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
<div id="header">
    <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;"><img style="width: 120px;margin-top: -12px;position: absolute;margin-left: -160px;" src="<?php echo site_url('images/kmix.jpg') ?>"> <span>KARIM ASPHALT & READY MIX LTD.</span> </h2>
    <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">(A Unit of Karim Group)</p>
    <hr>
    <div style="">
        <h1 style="text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size:18px;">SALES COMMISSION INVOICE</h1>

    </div>
    <div style="clear: both;"></div>

</div>


</div>
<br>

<div class="x_content">

    <table id="maintable" class="table table-bordered table-hover table-striped" style="width:100%;text-align: center;margin-bottom: 10px;">
        <thead>

            <tr>
                <th>SL</th>
                <th>Invoice. Date.</th>
                <th>Invoice. No.</th>
                <th>So. No.</th>
                <th>C.Name</th>
                <th>Project</th>
                <!--    <th>Product Type</th> -->
                <th>Product Name</th>
                <th>M.U.</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Amount</th>
                <th>Paid Amount</th>
                <th>Due Amount</th>
                <th>Comm.</th>
                <th>Sales Person</th>

            </tr>

        </thead>
        <tbody>
            <?php if (!empty($invoices)) {
                $total = 0;
                $total_qty = 0;
                $total_received = 0;
                $total_due = 0;
                $total_commission = 0;
                $total_com_paid = 0;
                $total_com_due = 0;
                $i = 0;
                foreach ($invoices as $invoice) {
                    $due = 0;
                    $due = $invoice['total_amount'] - $invoice['received_amount'];
                    $due_qty = $due/$invoice['unit_price'];
                    $total_qty = $total_qty + $invoice['total_qty'];
                    $total = $total + $invoice['total_amount'];
                    $total_received = $total_received + $invoice['received_amount'];
                    $total_commission += abs($invoice['commission']*($invoice['total_qty']-$due_qty));
                    $total_com_paid += $invoice['com_paid'];
                    $total_com_due += abs($invoice['commission']*($invoice['total_qty']-$due_qty))-$invoice['com_paid'];
                    $i++;

            ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td style="white-space:nowrap"><?php if (!empty($invoice['sale_invoice_date'])) echo date('d-m-Y', strtotime($invoice['sale_invoice_date'])); ?></td>
                        <td><?php echo $invoice['inv_no']; ?></td>
                        <td><?php echo $invoice['order_no']; ?></td>
                        <td><?php echo $invoice['c_name']; ?></td>
                        <td><?php echo $invoice['project_name']; ?></td>
                        <!--    <td><?php echo $invoice['category_name']; ?></td>-->
                        <td><?php echo $invoice['product_name']; ?></td>
                        <td><?php echo $invoice['mu_name']; ?></td>
                        <td style="text-align: right;"><?php echo $invoice['total_qty']; ?></td>
                        <td style="text-align: right;"><?php echo $invoice['unit_price']; ?></td>
                        <td style="text-align: right;"><?php echo number_format($invoice['total_amount'], 2); ?></td>
                        <td style="text-align: right;"><?php if (!empty($invoice['received_amount'])) echo number_format($invoice['received_amount'], 2); ?></td>
                        <td style="text-align: right;"><?php
                                                        $due = $invoice['total_amount'] - $invoice['received_amount'];
                                                        $total_due = $total_due + $due;
                                                        echo number_format($due, 2);
                                                        ?></td>
                        <td style="text-align: right;"><?php echo round(abs($invoice['commission']*($invoice['total_qty']-$due_qty)), 2); ?></td>
                        <td style="text-align: right;"><?php echo round($invoice['com_paid'],2); ?></td>
                                            <td style="text-align: right;"><?php echo round(abs($invoice['commission']*($invoice['total_qty']-$due_qty))-$invoice['com_paid'],2); ?></td>
                        <td style="text-align: right;"><?php echo $invoice['name']; ?></td>

                    </tr>
                <?php } ?>

                <tr>
                    <td colspan="8" style="text-align: right;">Total</td>
                    <td style="text-align: right;"><b><?php echo number_format($total_qty, 2); ?></b></td>
                    <td style="text-align: right;"></td>
                    <td style="text-align: right;"><b><?php echo number_format($total, 2); ?></b></td>
                    <td style="text-align: right;"><b><?php echo number_format($total_received, 2); ?></b></td>
                    <td style="text-align: right;"><b><?php echo number_format($total_due, 2); ?></b></td>
                    <td style="text-align: right;"><b><?php echo number_format($total_commission, 2); ?></b></td>
                    <td style="text-align: right;"><b><?php echo number_format($total_com_paid, 2); ?></b></td>
                                        <td style="text-align: right;"><b><?php echo number_format($total_com_due, 2); ?></b></td>
                    <td></td>
                </tr>

            <?php } else { ?>
                <tr>
                    <td colspan="16" style="text-align: center;">No Data Found</td>
                </tr>
            <?php } ?>
        </tbody>
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
    <table class="table table-bordered table-hover table-striped" style="width:100%;margin:0 auto;text-align:center;margin-top:50px;">
        <tr>
            <td style="width:20%;margin-left:20%;font-size:15px;"><span style="border-top:1px solid;">Prepeard BY</span></td>
            <td style="width:20%;margin-left:20%;font-size:15px;"><span style="border-top:1px solid;">Checked BY</span></td>
            <td style="width:20%;margin-left:20%;font-size:15px;"><span style="border-top:1px solid;">Approved BY</span></td>
            <td style="width:20%;margin-left:20%;font-size:15px;"><span style="border-top:1px solid;">Received BY</span></td>

        </tr>
    </table>

    <!--<div class="pageNumber"></div>-->
</div>