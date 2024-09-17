
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
                            
                            <th style="width:5%;text-align: center;">SL No</th>
                            <th style="width:10%;text-align: center;">Chq. No</th>
                            <th style="width:10%;text-align: center;">Create date</th>
                            <th style="width:10%;text-align: center;">Chq. date</th>
                            <th style="width:10%;text-align: center;">pay to</th>
                            
                            <th style="width:15%;text-align: center;">bank Name</th>
                            <th style="width:10%;text-align: center;">Branch Name</th>
                            <th style="width:10%;text-align: center;">Account No</th>
                            <th style="width:10%;text-align: center;">Amount</th>


                            <th style="text-align: center;width:10%;" class="noExport">Actions</th>
                            </thead>
                            <tbody>
                               <?php foreach ($assing_chk as $key => $row) { ?>
                                    <tr>
                                        
                                        <td><?php echo ($key + 1); ?></td>
                                        <td><?php if (!empty($row['chk_no'])) echo $row['chk_no']; ?></td>
                                        <td><?php if (!empty($row['created'])) echo date('d-m-Y',strtotime($row['created'])); ?></td>
                                        <td><?php if (!empty($row['chk_date'])) echo date('d-m-Y',strtotime($row['chk_date'])); ?></td>
                                        
                                        <?php if($row['showpayto'] == 'YES'){ ?>
                                        <td><?php if (!empty($row['SUP_NAME'])) echo $row['SUP_NAME']; ?></td>
                                        <?php }else{?>
                                            <td>Cash</td>
                                        <?php }?>
                                        <td ><?php if (!empty($row['b_name'])) echo $row['b_name']; ?></td>
                                        <td ><?php if (!empty($row['bank_branch'])) echo $row['bank_branch']; ?></td>
                                        <td ><?php if (!empty($row['bank_account'])) echo $row['bank_account']; ?></td>
<!--                                        <td style="width:15%;text-align: center;"><?php if (!empty($row['chk_date'])) echo $row['chk_date']; ?></td>-->
                                        <td ><?php if (!empty($row['amount'])) echo number_format ($row['amount'],2) ; ?></td>

                                        <td style="text-align: center; font-size:12px;" class="noExport">
<!--                                            <a href='<?php echo site_url('backend/ongoing/edit_cheque/' . $row['chk_id']); ?>'>Edit</a>/-->
                                           
                                            <a class="btn btn-primary" onclick="showIssued(<?php echo $row['id'] ?>)" id="issued_cheque"  href='javascript:'>Issued</a>
<!--                                            <a class="btn btn-danger" href='<?php echo site_url('backend/setup/canceled_cheque/' . $row['id']); ?>'>Cancel</a>
                                            <a class="btn btn-info" target="_blank" href='<?php echo site_url('backend/setup/chequePrint/' . $row['id']); ?>'>Print</a>-->
                                        </td>

                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>


                    </div>
                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form action="<?php echo site_url('setup/insertAssign_cheque') ?>" method="post">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Create Cheque</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12 M-row">
                                        <div class="col-md-6">
                                            <label>Select Company Name</label><span style="color:red">*</span>
                                            <select name="company" id="company" onchange="changecompany()"class="form-control" required="">
                                                <option value="">Select Company</option>
                                                <?php foreach ($company as $c) { ?>
                                            <option class="form-control" value="<?php echo $c['c_id']; ?>"><?php echo $c['c_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Select Bank Name</label><span style="color:red">*</span>
<!--                                    <select name="bank" id="bank" onchange="changeBank()" class="form-control">
                                        <option>Select Bank</option>
                                        <?php foreach ($bank as $b) { ?>
                                            <option data-branch="<?php echo $b['bank_branch']; ?>" data-current_chk="<?php echo $b['current_chk']; ?>" data-account_no="<?php echo $b['account_no']; ?>" class="form-control" value="<?php echo $b['bank_id']; ?>"><?php echo $b['bank_name']; ?></option>
                                        <?php } ?>
                                    </select>-->
                                            <select name="bank" id="bank" class="form-control" onchange="changebank()" required="">
                                        <option value="">Select Bank</option>
                                        
                                        
                                    </select>
                                        </div>
                                    </div>
                                    
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <div class="col-md-6">
                                            <label>Bank Branch</label><span style="color:red">*</span>
<!--                                    <input type="text" name="bank_branch" value="<?php echo $bank[0]['bank_branch']; ?>" id="bank_branch" class="form-control" placeholder="Bank Branch"/>-->
                                            <select name="bank_branch" id="bank_branch" class="form-control" onchange="changebranch()" required="">
                                        <option value="Select Bank">Select Bank</option>
                                        
                                        
                                    </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Account No</label><span style="color:red">*</span>
<!--                                    <input type="text" name="account_no" value="<?php echo $bank[0]['account_no']; ?>" id="account_no" class="form-control" placeholder="Account No"/>-->
                                            <select name="bank_account" id="bank_account" class="form-control" onchange="changeaccount()" required="">
                                        <option value="Select Bank">Select Bank</option>
                                        
                                        
                                    </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <div class="col-md-6">
                                            <label>Current Cheque Number</label><span style="color:red">*</span>
                                            <input type="text" name="current_chk" id="current_chk"  value="" class="form-control" readonly="" placeholder="Current Cheque Number" required="" />
                                        </div>
                                        <div class="col-md-6">
                                            <label>Cheque Date</label><span style="color:red">*</span>
                                            <input type="text" id="ch_date"name="cheque_date" class="form-control datepicker" required="" placeholder="Cheque Dates"/>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <div class="col-md-6">
                                            <label>Cheque Type</label><span style="color:red">*</span>
                                            <select name="chk_type" id="chk_type" class="form-control" required="">
                                        
                                            <option class="form-control" value="">Select a type</option>
                                            <option class="form-control" value="Account Payee">Account Payee</option>
                                            <option class="form-control" value="Cash">Cash</option>
<!--                                            <option class="form-control" value="Cancelled">Cancelled</option>
                                            <option class="form-control" value="Security">Security</option>
                                            <option class="form-control" value="Others">Others</option>-->
                                       
                                    </select>
                                        </div>
                                        <div class="col-md-6"><label>Amount</label><span style="color:red">*</span>
                                            <input type="text" name="amount" class="form-control" required="" placeholder="Amount"/>
                                        </div>
                                        
                                    </div>
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <div class="col-md-6">
                                            <label>Pay To / Head Of Account</label><span style="color:red">*</span>
                                            <input type="text" name="pay_to" class="form-control" required="" placeholder="Pay To"/>
                                        </div>
                                        <div class="col-md-6">
                                            <input id="payto_check" style="margin-top: 33px;" type="checkbox" name="showpayto" value="YES"> Do you want to show this name in cheque ?
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    
                                   
                                   
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div id="issuedCmodal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form action="<?php echo site_url('cheque_register/issued_cheque') ?>" method="post"/>
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Issued Cheque</h4>
                                </div>
                                <div class="modal-body">
                                   <div class="col-md-12 M-row">
                                       
                                            <label>Issued Date</label>
                                            <input readonly required="" type="text" id="issueDate" name="issued_date" class="form-control datepicker1" placeholder="Issued date"/>
                                        
                                        
                                    </div>
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <label>Received By</label>
                                        <input required="" type="text" name="receive_by" class="form-control" placeholder="Receive By"/>
                                    </div>
                                    
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <label>Remarks</label>
                                    <input type="text" name="remarks" class="form-control" placeholder="Remarks"/>
                                    </div>
                                   
                                    <div class="clearfix"></div>
                                    <input type="hidden" id="issue_id" name="issue_id">
                                   
                                   
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button id="issuesubmit" type="submit" class="btn btn-primary pull-right">Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    
                    
                </div>
            

<script>
    
 
var date = new Date();
    $('#ch_date').datepicker({ 
    minDate: date
    });
    
    
    $(".datepicker1").datepicker({
        dateFormat: 'dd-mm-yy',
       
        beforeShow: function (input, inst) {
            setTimeout(function () {
                inst.dpDiv.css({
                    top: 150,
                    left: 420
                });
            }, 0);
        }
    });
    
    $('#issuesubmit').click(function(){
        var issueDate = $('#issueDate').val()
        if(issueDate == ''){
            alert('Please entry the issue date');
            return false;
        }
    })
   // $('#issueDate').datepicker();
    
    $('#chk_type').change(function(){
        var cheque_type = $(this).val();
        if(cheque_type == 'Account Payee'){
             $("#payto_check").prop("checked", true);
        }else{
           $("#payto_check").prop("checked", false); 
        }
        
    })



    
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
    
    function changecompany(){
        var c_id = $('#company').val();
        $.ajax({
           type: "POST",
            url: "backend/setup/getbank",
            data: {c_id:c_id},
            dataType: "json",
            
            success: function (data) {
                
                if (data.msg == 'success') {
                    var str = '';
                    str+='<option value="">Select bank name</option>';
                    $('#bank').html(str);
                    $(data.value).each(function(row,val){
                       str+='<option value="'+val.bank_name+'">'+val.bank_name+'</option>';
                       $('#bank').html(str);
                    })
                    
                    
                    
                    
                    
                    
                }
            }
        })
    }
    
    function changebank(){
        var b_name = $('#bank').val();
        $.ajax({
           type: "POST",
            url: "backend/setup/getBranch",
            data: {b_name:b_name},
            dataType: "json",
            
            success: function (data) {
                
                if (data.msg == 'success') {
                    var str = '';
                     str+='<option value="">Select bank branch</option>';
                    $('#bank_branch').html(str);
                    $(data.value).each(function(row,val){
                       str+='<option value="'+val.bank_branch+'">'+val.bank_branch+'</option>';
                       $('#bank_branch').html(str);
                    })
                    
                    
                    
                    
                    
                    
                }
            }
        })
    }
    function changebranch(){
        var b_branch = $('#bank_branch').val();
        $.ajax({
           type: "POST",
            url: "backend/setup/getAccountNo",
            data: {b_branch:b_branch},
            dataType: "json",
            
            success: function (data) {
                
                if (data.msg == 'success') {
                    var str = '';
                    str+='<option value="">Select bank account</option>';
                    $('#bank_account').html(str);
                    $(data.value).each(function(row,val){
                       str+='<option value="'+val.account_no+'">'+val.account_no+' ('+val.account_type+')'+'</option>';
                       $('#bank_account').html(str);
                    })
                    
                    
                    
                    
                    
                    
                }
            }
        })
    }
    function changeaccount(){
        var c_id = $('#company').val();
        var b_id = $('#bank').val();
        var b_branch = $('#bank_branch').val();
        var b_account = $('#bank_account').val();
        $.ajax({
           type: "POST",
            url: "backend/setup/getchequeno",
            data: {'c_id':c_id,'b_id':b_id,'b_branch':b_branch,'b_account':b_account},
            dataType: "json",
            
            success: function (data) {
                
                if (data.msg == 'success') {
                    alert(data.value);
                  $('#current_chk').val(data.value);
                   }
            }
        })
    }
    
    
</script>
<!-- /page content -->