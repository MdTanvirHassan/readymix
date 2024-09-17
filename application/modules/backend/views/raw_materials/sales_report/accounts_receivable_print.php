<style>
    #content-table {
        line-height: 18px !important;
    }

    .table {
        border-collapse: collapse;
    }

    @page {
        size: auto;
        /* auto is the initial value */
        margin-top: 0px;
        /* this affects the margin in the printer settings */
        margin-bottom: 0;
    }

    .col-md-12 {
        width: 100%;
    }

    .col-md-6 {
        width: 50%;
        float: left;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }
</style>




<div style="padding-top:30px;" class="col-md-10 col-md-offset-1">


    <h2 style=" font-size:18px;text-align: center;">Karim Asphalt & Ready Mix Ltd.</h>
        <p style=" text-align: center;margin-top:0px;margin-bottom:5px;"><?php echo $branch_info[0]['dep_description']; ?></p>
        <p style=" text-align: center;margin-top:-5px;margin-bottom:5px;">Accounts Receivable</p>
        <p style=" text-align: center;margin-top:-5px;margin-bottom:5px;">Group Summary</p>
        <p style=" text-align: center;margin-top:-5px;margin-bottom:5px;">Date : <?php if ($f_date == $to_date) echo date('d-m-Y', strtotime($f_date));
                                                                                    else echo date('d-m-Y', strtotime($f_date)) . ' to ' . date('d-m-Y', strtotime($to_date)) ?></p>



        <table style="width:100%;font-size: 12px;" id="player_table" class="table table-bordered">
            <thead>
                <tr>
                    <th style="vertical-align: middle;">Particulars</th>
                    <th style="vertical-align: middle;">Opening Balance</th>
                    <th style="vertical-align: middle;">Debit</th>
                    <th style="vertical-align: middle;">Credit</th>
                    <th style="vertical-align: middle;">Closing Balance</th>
                </tr>

            </thead>
            <tbody>
                <?php if (!empty($categories)) {
                    $opening = 0;
                    $debit = 0;
                    $credit = 0;
                    $closing = 0;
                    $i = 0;
                    foreach ($categories as $pro) {
                        $j++;
                        $opening = $opening + $pro['opening_amount'];
                        $debit = $debit + $pro['sale_amount'];
                        $credit = $credit + $pro['collection_amount'];
                        $closing = $closing + $pro['closing_amount'];
                ?>
                        <tr>
                            <td><?php echo $pro['category_name']; ?></td>
                            <td style="text-align: right;"><?php echo number_format($pro['opening_amount'], 2); ?></td>
                            <td style="text-align: right;"><?php echo number_format($pro['sale_amount'], 2); ?></td>
                            <td style="text-align: right;">
                                <?php echo number_format($pro['collection_amount'], 2); ?>
                            </td>


                            <td style="text-align:right">
                                <?php echo number_format($pro['closing_amount'], 2); ?>
                            </td>

                        </tr>
                    <?php } ?>

                    <tr>
                        <td style="text-align: right;">Grand Total</td>
                        <td style="text-align: right;"><b><?php echo number_format($opening, 2); ?></b></td>
                        <td style="text-align: right;"><b><?php echo number_format($debit, 2); ?></b></td>
                        <td style="text-align: right;"><b><?php echo number_format($credit, 2); ?></b></td>
                        <td style="text-align: right;"><b><?php echo number_format($closing, 2); ?></b></td>
                    </tr>

                <?php } else { ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">No Data Found</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

</div>

</div>


</div>
<div class="clearfix"></div>