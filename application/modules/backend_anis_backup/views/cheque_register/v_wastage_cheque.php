
<!-- page content -->

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
                            
                            <th style="width:10%;text-align: center;">SL No</th>
                            <th style="width:10%;text-align: center;">Cheque No</th>
                            <th style="width:10%;text-align: center;">Create Date</th>
                          
                            <th style="width:15%;text-align: center;">bank Name</th>
                            <th style="width:10%;text-align: center;">Branch Name</th>
                            <th style="width:10%;text-align: center;">Account No</th>
                            
                            


                            <th style="text-align: center;width:30%;" class="noExport">Actions</th>
                            </thead>
                            <tbody>
                               <?php foreach ($assing_chk as $key => $row) { ?>
                                    <tr>
                                        
                                        <td style="width:5%;text-align: center;"><?php echo ($key + 1); ?></td>
                                        <td style="width:10%;text-align: center;"><?php if (!empty($row['chk_no'])) echo $row['chk_no']; ?></td>
                                        <td style="width:15%;text-align: center;"><?php if (!empty($row['created'])) echo date('d-m-Y',strtotime($row['created'])); ?></td>
                                        
                                        <td style="width:10%;text-align: center;"><?php if (!empty($row['b_name'])) echo $row['b_name']; ?></td>
                                        <td style="width:15%;text-align: center;"><?php if (!empty($row['bank_branch'])) echo $row['bank_branch']; ?></td>
                                        <td style="width:10%;text-align: center;"><?php if (!empty($row['account_no'])) echo $row['account_no']; ?></td>
                                        

                                        <td style="text-align: center;width:30%; font-size:12px;" class="noExport">
                                            
                                            <a class="btn btn-primary" onclick="returnChequeList('<?php echo $row['chk_id']; ?>')" href='javascript:'>Return</a>
                                        </td>

                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>


                    </div>
                    <!-- Modal -->
                    
                    
                    
                    
                </div>
            </div>
        </div>


    </div>
</div>

<script>
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
    
    function returnChequeList(chk_id){
       if(confirm('Are you suer you want to wastage this cheque ?')==true){
         window.location.href = '<?php echo site_url('cheque_register/returnChequeList/')?>/'+chk_id;
       
    }
    }
</script>
<!-- /page content -->