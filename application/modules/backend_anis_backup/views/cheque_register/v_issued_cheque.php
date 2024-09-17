
<!-- page content -->

<style>
  

  table.dataTable tbody th, table.dataTable tbody td {
    padding: 8px 1px !important;
}
</style>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <?php $this->load->view('cheque_register/common');?>


    <div class="right_content">
   
                        <div class="col-md-12  col-sm-12 col-xs-12"style="margin-top: -6px; margin-bottom: 3px;">
                            <div class="col-md-6 col-sm-6 ">
                                <div class="themat_title">
                                    <!--                                    <h4>TRIP LIST</h4> -->
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">

                                
                            </div>

                        </div>
                        

                        <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                            
                            <th style="width:5%;text-align: center;">SL No</th>
                            <th style="width:5%;text-align: center;">Chq. No</th>
                            <th style="width:10%;text-align: center;">Create Date</th>
                            <th style="width:10%;text-align: center;">Issued Date</th>
                            <th style="width:10%;text-align: center;">Pay To</th>
                            <th style="width:10%;text-align: center;">bank Name</th>
                            <th style="width:10%;text-align: center;">Branch Name</th>
                            <th style="width:10%;text-align: center;">Account No</th>
                            
                            <th style="width:5%;text-align: center;">Amount</th>
                            <th style="width:10%;text-align: center;">Honor Date</th>

                            <th style="text-align: center;width:25%;" class="noExport">Actions</th>
                            </thead>
                            <tbody>
                               <?php foreach ($assing_chk as $key => $row) { ?>
                                    <tr>
                                        
                                        <td style="width:5%;text-align: center;"><?php echo ($key + 1); ?></td>
                                        <td style="width:5%;text-align: center;"><?php if (!empty($row['chk_no'])) echo $row['chk_no']; ?></td>
                                        <td style="width:10%;text-align: center;"><?php if (!empty($row['created'])) echo date('d-m-Y',strtotime($row['created'])); ?></td>
                                        <td style="width:10%;text-align: center;"><?php if (!empty($row['issued_date'])) echo date('d-m-Y',strtotime($row['issued_date'])); ?></td>
                                        <?php if($row['showpayto'] == 'YES'){ ?>
                                        <td><?php if (!empty($row['SUP_NAME'])) echo $row['SUP_NAME']; ?></td>
                                        <?php }else{?>
                                            <td>Cash</td>
                                        <?php }?>
                                        <td style="width:10%;text-align: center;"><?php if (!empty($row['bank_name'])) echo $row['bank_name']; ?></td>
                                        <td style="width:10%;text-align: center;"><?php if (!empty($row['bank_branch'])) echo $row['bank_branch']; ?></td>
                                        <td style="width:10%;text-align: center;"><?php if (!empty($row['bank_account'])) echo $row['bank_account']; ?></td>
                                        
                                        <td style="width:5%;text-align: center;"><?php if (!empty($row['amount'])) echo $row['amount']; ?></td>
                                        <td style="width:10%;text-align: center;"><?php if (!empty($row['honor_date'])) echo date('d-m-Y',strtotime($row['honor_date'])); ?></td>
<!--                                        <td style="text-align: center;width:20%; font-size:12px;" class="noExport">
                                            <a href='<?php echo site_url('backend/ongoing/edit_cheque/' . $row['chk_id']); ?>'>Edit</a>/
                                           
                                            <a class="btn btn-primary" onclick="showIssued(<?php echo $row['id'] ?>)" id="issued_cheque"  href='javascript:'>Issued</a>
                                            <a class="btn btn-danger" href='<?php echo site_url('backend/ongoing/canceled_cheque/' . $row['id']); ?>'>Cancel</a>
                                        </td>-->
                                        <td style="width:25%;text-align: center;">
                                            <a class="btn btn-xs btn-info" target="_blank" href="<?php echo site_url('cheque_register/acknowledge/'. $row['id'])?>">Voucher View</a>
                                            <a class="btn btn-xs btn-primary"  onclick="honorData(<?php echo $row['id'] ?>)" >Honor Date</a>
                                        </td>

                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>


                    </div>
                    <!-- Modal -->
                    <div id="honorData" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form action="<?php echo site_url('cheque_register/honorData') ?>" method="post">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Issued Cheque</h4>
                                </div>
                                <div class="modal-body">
                                   <div class="col-md-12 M-row">
                                       
                                            <label>Honor Date</label>
                                            <input required="" type="text" name="honor_date" class="form-control datepicker1" placeholder="Honor date"/>
                                        
                                        
                                    </div>
                                    <br>
                                    
                                    
                                    <br>
                                    
                                   
                                    <div class="clearfix"></div>
                                    <input type="hidden" id="assign_id" name="assign_id">
                                   
                                   
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
        </div>


    </div>
</div>

<script>

$(".datepicker1").datepicker({
    dateFormat: 'dd-mm-yy',
    maxDate: new Date,
    beforeShow: function (input, inst) {
        setTimeout(function () {
            inst.dpDiv.css({
                top: 150,
                left: 420
            });
        }, 0);
    }
});


    function changeBank() {
        var bank_id = $('#bank').val();
        var account_no = $('#bank option:selected').data('account_no');
        var branch = $('#bank option:selected').data('branch');
        var current_chk = $('#bank option:selected').data('current_chk');
        $('#account_no').val(account_no)
        $('#bank_branch').val(branch)
        $('#current_chk').val(current_chk)
    }

    $('#create_new_cheque').click(function () {

        $('#myModal').modal('show');

    })
    function showIssued(id){
        $('#issue_id').val(id)
     $('#issuedCmodal').modal('show');

    }
    function honorData(chk_id){
        $('#honorData').modal('show');
        $('#assign_id').val(chk_id);
    }
</script>
<!-- /page content -->