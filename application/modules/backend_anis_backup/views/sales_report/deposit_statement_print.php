
<style>
    #content-table{
        line-height: 18px !important;
    }
    .table{
        border-collapse: collapse; 
    }
    @page {
    size: auto;   /* auto is the initial value */
    margin-top:0px;  /* this affects the margin in the printer settings */
    margin-bottom: 0;
}
.col-md-12{
    width:100%;
}
.col-md-6{
    width:50%;
    float: left;
}
table, th, td {
  border: 1px solid black;
}
</style>



 
<div style="padding-top:30px;" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">Karim Asphalt & Ready Mix Ltd.</h>
    <p style=" text-align: center;margin-top:0px;margin-bottom:5px;"><?php echo $branch_info[0]['dep_description']; ?></p> 
    <p style=" text-align: center;margin-top:-5px;margin-bottom:5px;">Deposit Statement</p> 
                        <?php if(!empty($bank_info)){ ?>
                        <h4 style=" text-align: center;margin-top:-5px;margin-bottom:5px;"><b><?php echo $bank_info[0]['b_name']; ?></b></h4>
                        <h5 style=" text-align: center;margin-top:-5px;margin-bottom:5px;"><b><?php echo $bank_info[0]['b_address']; ?></b></h5>
                        <p style="text-align:right;font-weight:bold">Date : <?php echo date('d-m-Y'); ?></p>
                        <p style="text-align:right;font-weight:bold">A/C No : <?php echo $bank_info[0]['b_account_no']; ?></p>
                        <?php } ?>

    
    
                                <table style="width:100%;font-size: 12px;" id="player_table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                            <th style="width:5%">SL</th>
                                                <th style="width:30%">Name of the Bank</th>
                                                <th style="width:30%">Cheque No</th>
                                                <th style="width:10%">Cheque Date</th>
                                                <th style="width:25%">Amount</th>
                                            </tr>

                                        </thead>
                                        <?php if (!empty($deposits)) {
                                                $total = 0;
                                                $total_ch_amount = 0;
                                                $total_inv_amount = 0;
                                                $i = 0;
                                                foreach ($deposits as $challan) {
                                                    $i++;
                                                    $total+=$challan['amount'];
                                            ?>
                                                    <tr>
                                                        <td><?php echo ($i); ?></td>
                                                        <td><?php if (!empty($challan['b_name'])) echo $challan['b_name']; ?></td>
                                                        <td><?php if (!empty($challan['no'])) echo $challan['no']; ?></td>
                                                        <td>
                                                            <?php if (!empty($challan['check_date'])) echo $challan['check_date']; ?>
                                                        </td>
                                                       

                                                        <td style="text-align:right">
                                                            <?php if (!empty($challan['amount'])) echo number_format($challan['amount'], 2); ?>
                                                        </td>

                                                    </tr>
                                                <?php } ?>

                                                <tr>
                                                    <td colspan="4" style="text-align: right;">Total</td>
                                                    <td style="text-align: right;"><b><?php echo number_format($total, 2); ?></b></td>
                                                </tr>

                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="5" style="text-align: center;">No Data Found</td>
                                                </tr>
                                            <?php } ?>
                                    </table>
                                
                                </div>
                            
                    </div>
   
    
</div>
<div class="clearfix"></div>

