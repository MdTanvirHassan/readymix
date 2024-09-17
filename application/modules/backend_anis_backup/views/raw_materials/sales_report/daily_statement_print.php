
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
    width:49.5%;
    float: left;
    
}
.col-md-6:first-child{
    margin-right:5px;
}
table, th, td {
  border: 1px solid black;
}
</style>



 
<div style="padding-top:30px;" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">Karim Asphalt & Ready Mix Ltd.</h>
    <p style=" text-align: center;margin-top:0px;margin-bottom:5px;"><?php echo $branch_info[0]['dep_description']; ?></p> 
    <p style=" text-align: center;margin-top:-5px;margin-bottom:5px;">Daily Statement</p> 
    <p style=" text-align: center;margin-top:-5px;margin-bottom:5px;">Date : <?php if($f_date==$to_date) echo date('d-m-Y',strtotime($f_date)); else echo date('d-m-Y',strtotime($f_date)).' to '.date('d-m-Y',strtotime($to_date)) ?></p>                   
    
    
    <div class="col-md-12">
                                <div class="col-md-6">
                                <h3 style="text-align:center;">Production</h3>
                                <table style="width:100%;font-size: 12px;" id="player_table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:30%">Party Name</th>
                                                <th style="width:30%">Product Name</th>
                                                <th style="width:10%">Qty</th>
                                                <th style="width:10%">Rate</th>
                                                <th style="width:25%">Amount</th>
                                            </tr>

                                        </thead>
                                        <tbody style="">
                                            <?php if (!empty($productions)) {
                                                $total = 0;
                                                $total_ch_amount = 0;
                                                $total_inv_amount = 0;
                                                $i = 0;
                                                foreach ($productions as $challan) {
                                                    $i++;
                                                    $total+=$challan['production_qty'] * $challan['unit_price'];
                                            ?>
                                                    <tr>
                                                        <td><?php if (!empty($challan['c_name'])) echo $challan['c_name']; ?></td>
                                                        <td><?php if (!empty($challan['product_name'])) echo $challan['product_name']; ?></td>
                                                        <td>
                                                            <?php if (!empty($challan['production_qty'])) echo number_format($challan['production_qty'], 2); ?>
                                                        </td>
                                                        <td><?php if (!empty($challan['unit_price'])) echo $challan['unit_price']; ?></td>


                                                        <td>
                                                            <?php if (!empty($challan['production_qty'])) echo number_format($challan['production_qty'] * $challan['unit_price'], 2); ?>
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
                                        </tbody>
                                    </table>
                                
                                </div>
                                <div class="col-md-6">
                                <h3 style="text-align:center;">Collection</h3>
                                <table style="width:100%;font-size: 12px;" id="player_table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:30%">Party Name</th>
                                                <th style="width:30%">Check No</th>
                                                <th style="width:20%">Receipt No</th>
                                                <th style="width:20%">Amount</th>
                                            </tr>

                                        </thead>
                                        <tbody style="">
                                            <?php if (!empty($collections)) {
                                                $total = 0;
                                                $total_ch_amount = 0;
                                                $total_inv_amount = 0;
                                                $i = 0;
                                                foreach ($collections as $challan) {
                                                    $i++;
                                                    $total+=$challan['amount'];
                                            ?>
                                                    <tr>
                                                        <td><?php if (!empty($challan['c_name'])) echo $challan['c_name']; ?></td>
                                                        <td><?php if (!empty($challan['check_no'])) echo $challan['check_no']; ?></td>
                                                        <td>
                                                            <?php if (!empty($challan['mrr_no'])) echo $challan['mrr_no']; ?>
                                                        </td>


                                                        <td>
                                                            <?php if (!empty($challan['amount'])) echo number_format($challan['amount'], 2); ?>
                                                        </td>

                                                    </tr>
                                                <?php } ?>

                                                <tr>
                                                    <td colspan="3" style="text-align: right;">Total</td>
                                                    <td style="text-align: right;"><b><?php echo number_format($total, 2); ?></b></td>
                                                </tr>

                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="4" style="text-align: center;">No Data Found</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            
                    </div>
   
    
</div>
<div class="clearfix"></div>

