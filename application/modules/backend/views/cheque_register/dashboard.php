
<!-- page content -->
<style>
    .ui-widget-content{
        background: #337ab7;
        border:none;
    }
    .ui-progressbar-value{
        display: none;
    }
    .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
	
	text-align: center;
	vertical-align: middle;
}
    .table-bordered > tbody > tr > td {
	
	text-align: center !important ;
	vertical-align: middle !important ;
}
</style>
<div class="right_col" role="main" >
    <?php $this->load->view('cheque_register/common');?>
    <div class="">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
<!--                <div class="title_center">
                                        <h3>Dashboard</h3>
                                    </div>-->
                <div class="x_panel">
                    <div class="x_content">


                        <div class="clearfix"></div>

                        <div class="content-panel">
                            <table   class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="10" style="text-align: center;background: #ddd;">Cheque Details</th> 
                                </tr>
                                <tr>
                                    <th rowspan="2">SL</th>
                                    <th rowspan="2">Bank Name.</th>
                                    <th rowspan="2">Account Type</th>
                                    <th rowspan="2">Account No.</th>
                                    <th rowspan="2">Blank LF</th>
                                    <th colspan="2">Un Issue</th>
                                    <th colspan="2">Un Present</th>
                                </tr>
                                <tr>
                                    <th>Qty</th>
                                    <th>Val</th>
                                    <th>Qty</th>
                                    <th>Val</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($bank as $row){
//                                   echo '<pre>';
//                                   print_r($row);exit;
                                    ?>
                                <tr>
                                    <td rowspan="2"><?php echo $i;?></td>
                                    <td rowspan="2"><?php echo $row['b_name']?></td>
                                    <td rowspan="2"><?php echo $row['b_account_type']?></td>
                                    <td rowspan="2"><?php echo $row['b_account_no']?></td>
                                    <td rowspan="2"><?php echo $row['blank']?></td>
                                    
                                </tr> 
                                <tr>
                                    <td <?php if(!empty($row['unissue'])){?> style="cursor: pointer; color:blue;" onclick="issueList('<?php echo $row['id']?>','<?php echo $row['b_account_no']?>')" <?php } ?>><?php echo $row['unissue']?></td>
                                    <td <?php if(!empty($row['unissue'])){?> style="cursor: pointer;color:blue;" onclick="issueList('<?php echo $row['id']?>','<?php echo $row['b_account_no']?>')" <?php } ?>><?php echo number_format($row['unissuevalue'],2) ?></td>
                                    <td  <?php if(!empty($row['unpresent'])){?> style="cursor: pointer;color:blue;" onclick="presentList('<?php echo $row['id']?>','<?php echo $row['b_account_no']?>')" <?php } ?>><?php echo $row['unpresent']?></td>
                                    <td <?php if(!empty($row['unpresent'])){?> style="cursor: pointer;color:blue;" onclick="presentList('<?php echo $row['id']?>','<?php echo $row['b_account_no']?>')" <?php } ?>><?php echo number_format($row['unpresentvalue'],2)?></td>
                                </tr>
                                 <?php $i++; } ?>
                            </tbody>
                        </table>
                            
                            
                        </div>

                        


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Details</h4>
                                </div>
                                <div id="issueDetails" class="modal-body">
                                   
                                   
                                   
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark pull-right" data-dismiss="modal">Close</button>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
<script>
    
    function issueList(bank_id, account_no){
        $('#myModal').modal('show'); 
        
        $.ajax({
            type: "POST",
            url: "backend/cheque_register/unIssueDetails",
            data: {bank_id:bank_id,account_no:account_no},
            dataType: "html",
            success: function (data) {
                $('#issueDetails').html(data);
                
            }
        })
        
    }
    
    function presentList(bank_id, account_no){
        $('#myModal').modal('show'); 
        
        $.ajax({
            type: "POST",
            url: "backend/cheque_register/unPresentDetails",
            data: {bank_id:bank_id,account_no:account_no},
            dataType: "html",
            success: function (data) {
                $('#issueDetails').html(data);
                
            }
        })
        
    }
    


    function calculateMT(type, id) {
        var dens = $('#' + type + '_dens_na' + id).val();
        var qty = $('#' + type + '_qty_na' + id).val();
        dens = dens ? dens : 0;
        qty = qty ? qty : 0;
        var mt = (Number(dens) * Number(qty)) / 1000;
        $('#' + type + '_mt_na' + id).val(mt.toFixed(2))
    }

</script>

<!-- /page content -->