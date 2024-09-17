
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
   <!-- <p style=" text-align: center;margin-top:0px;margin-bottom:5px;"><?php echo $branch_info[0]['dep_description']; ?></p> -->
    <p style=" text-align: center;margin-top:-5px;margin-bottom:5px;">Deposit Statement</p> 
                        <?php if(!empty($bank_info)){ ?>
                        <h4 style=" text-align: center;margin-top:-5px;margin-bottom:5px;"><b><?php echo $bank_info[0]['b_name']; ?></b></h4>
                        <h5 style=" text-align: center;margin-top:-5px;margin-bottom:5px;"><b><?php echo $bank_info[0]['b_address']; ?></b></h5>
                        <p style="text-align:right;font-weight:bold">Date : <?php echo date('d-m-Y'); ?></p>
                        <p style="text-align:right;font-weight:bold">A/C No : <?php echo $bank_info[0]['b_account_no']; ?></p>
                        <?php } ?>

    
    
                                <table style="width:100%;" id="player_table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="13" style="text-align:left;">From:&nbsp;<?php echo date('d-m-Y',strtotime($from_date));  ?>&nbsp;&nbsp;&nbsp;To:&nbsp;<?php echo date('d-m-Y',strtotime($to_date));  ?></th>
                                            </tr>    
                                            <tr>
                                            <th style="width:5%">SL</th>
                                            <th style="width:10%">Received Date</th>
                                            <th style="width:5%">Purpose</th>
                                            <th style="width:15%">Party Name</th>
                                            <th style="width:10%">Concern Employee</th>
                                            <th style="width:5%">MRR No.</th>
                                            <th style="width:20%">Cheque Bank</th>                                            
                                            <th style="width:10%">Cheque No</th>
                                            <th style="width:10%">Cheque Date</th>
                                            <th style="width:10%">Honor Date</th>
                                            <th style="width:5%">Priority</th>
                                            <th style="width:5%">Status</th>
                                            <th style="width:15%">Amount</th>    
                                            </tr>

                                        </thead>
                                        <?php if(!empty($deposit_banks)){ 
                                              $g_total=0; 
                                            ?>

                                                <?php foreach($deposit_banks as $dep_bank){ 
                                                       
                                                        if(empty($dep_bank['deposits'])){
                                                            continue;
                                                        }

                                                    ?>
                                                    <tr>
                                                        <td colspan="13">
                                                            <b><?php echo $dep_bank['b_name'].'('.$dep_bank['b_account_no'].')'; ?></b>
                                                        </td>

                                                    </tr>    

                                                    <?php 
                                                        $total = 0;
                                                        
                                                        $i = 0;
                                                        foreach ($dep_bank['deposits'] as $depo) {
                                                            $i++;
                                                            $total+=$depo['amount'];
                                                            $g_total+=$depo['amount'];
                                                    ?>
                                                            <tr>
                                                                <td><?php echo ($i); ?></td>

                                                                <td>
                                                                    <?php if (!empty($depo['receive_date'])){ 
                                                                        echo date('d-m-Y',strtotime($depo['receive_date'])); 
                                                                    }

                                                                    ?>
                                                                </td>

                                                                
                                                                <td><?php if (!empty($depo['category_name'])) echo $depo['category_name']; ?></td>
                                                                <td><?php if (!empty($depo['c_name'])) echo $depo['c_name']; ?></td>
                                                                
                                                                <td><?php if (!empty($depo['sales_person'])) echo $depo['sales_person']; ?></td>
                                                                <td><?php if (!empty($depo['mrr_no'])) echo $depo['mrr_no']; ?></td>


                                                                <td><?php if (!empty($depo['b_name'])) echo $depo['b_name']; ?></td>
                                                                
                                                                <td><?php if (!empty($depo['no'])) echo $depo['no']; ?></td>

                                                                <td>
                                                                    <?php if (!empty($depo['check_date'])){ 
                                                                        echo date('d-m-Y',strtotime($depo['check_date'])); 
                                                                    }

                                                                    ?>
                                                                </td>

                                                                <td>
                                                                    <?php if (!empty($depo['realization_date'])){ 
                                                                        echo date('d-m-Y',strtotime($depo['realization_date'])); 
                                                                    }

                                                                    ?>
                                                                </td>

                                                                <td><?php if (!empty($depo['priority'])) echo $depo['priority']; ?></td>
                                                                <td><?php if (!empty($depo['realization_status'])) echo $depo['realization_status']; ?></td>

                                                                <td style="text-align:right">
                                                                    <?php if (!empty($depo['amount'])) echo number_format($depo['amount'], 2); ?>
                                                                </td>

                                                                

                                                            </tr>
                                                        <?php } ?>

                                                        <tr>
                                                            <td colspan="12" style="text-align: right;">Total</td>
                                                            <td style="text-align: right;"><b><?php echo number_format($total, 2); ?></b></td>
                                                        </tr>

                                                   
                                                <?php } ?>  
                                                
                                                <tr>
                                                            <td colspan="12" style="text-align: right;">Grand Total</td>
                                                            <td style="text-align: right;"><b><?php echo number_format($g_total, 2); ?></b></td>
                                                </tr>

                                        <?php } else { ?>
                                                <tr>
                                                    <td colspan="13" style="text-align: center;">No Data Found</td>
                                                </tr>
                                        <?php } ?>   
                                    </table>
                                               
                                </div>
                            
                    </div>
   
    
</div>


