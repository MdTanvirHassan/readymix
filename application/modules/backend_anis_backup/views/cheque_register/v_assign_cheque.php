<style>
    .btn {
		padding: 6px 5px;
	
}

table.dataTable thead th, table.dataTable thead td {
    padding: 2px 0px !important;
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

                                <button class="addth-button pull-right" id="create_new_cheque"><span class="fa fa-plus"></span>  Write New Cheque</button>
                            </div>

                        </div>
                        

                        <table style="width:100%;" id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                            
                            <th style="width:5%;text-align: center;">SL No</th>
                            <th style="width:5%;text-align: center;">Chq. No</th>
                            <th style="width:10%;text-align: center;">Create Date</th>
                            <th style="width:10%;text-align: center;">Chq. Date</th>
                            <th style="width:10%;text-align: center;">Pay To</th>
                            <th style="width:5%;text-align: center;">Type</th>
                            
                            <th style="width:10%;text-align: center;">bank Name</th>
                            <th style="width:10%;text-align: center;">Branch Name</th>
                            <th style="width:10%;text-align: center;">Account No</th>

                            <th style="width:5%;text-align: center;">Amount</th>


                            <th style="text-align: center;width:20%;" class="noExport">Actions</th>
                            </thead>
                            <tbody>
                               <?php foreach ($assing_chk as $key => $row) { ?>
                                   
                                        <td style="text-align: center;"><?php echo ($key + 1); ?></td>
                                        <td style="text-align: center;"><?php if (!empty($row['chk_no'])) echo $row['chk_no']; ?></td>
                                        <td style="text-align: center;"><?php if (!empty($row['created'])) echo date('d-m-Y',strtotime($row['created'])); ?></td>
                                        <td style="text-align: center;"><?php if (!empty($row['created'])) echo date('d-m-Y',strtotime($row['chk_date'])); ?></td>
                                        <?php if($row['showpayto'] == 'YES'){ ?>
                                        <td style="text-align: center;"><?php if (!empty($row['SUP_NAME'])) echo $row['SUP_NAME']; ?></td>
                                        <?php }else{?>
                                            <td style="text-align: center;">Cash</td>
                                        <?php }?>
                                        <td style="text-align: center;"><?php if (!empty($row['chk_type'])) echo $row['chk_type']; ?></td>
                                        
                                        <td style="text-align: center;"><?php if (!empty($row['bank_name'])) echo $row['bank_name']; ?></td>
                                        <td style="text-align: center;"><?php if (!empty($row['bank_branch'])) echo $row['bank_branch']; ?></td>
                                        <td style="text-align: center;"><?php if (!empty($row['bank_account'])) echo $row['bank_account']; ?></td>

                                        <td style="text-align: right;"><?php if (!empty($row['amount'])) echo number_format ($row['amount'],2); ?></td>

                                        <td style="text-align: center;font-size:12px;" class="noExport">
<!--                                            <a href='<?php echo site_url('backend/ongoing/edit_cheque/' . $row['chk_id']); ?>'>Edit</a>/-->
                                           
                                            <a class="btn btn-info" title="View" target="_blank" href='<?php echo site_url('backend/cheque_register/chequePrint/' . $row['id']); ?>'><i class="	fa fa-eye"></i></a>
                                            <a class="btn btn-danger" title="Cancel" href='<?php echo site_url('backend/cheque_register/canceled_cheque/' . $row['id']); ?>'><i class="fa fa-trash-o"></i></a>
                                            
                                            <?php if($row['print_status'] == 'YES'){?>
                                            <a class="btn btn-primary" title="Done" onclick="printedCheque(<?php echo $row['id'] ?>)" id="issued_cheque"  href='javascript:'><i class="fa fa-check-square-o"></i></a>
                                            <?php }else{?>
                                            <a class="btn btn-info" title="Confirm" onclick="confriPrintChe(<?php echo $row['id'] ?>)"><i class="fa fa-check-square-o"></i></a>
                                            <a class="btn btn-primary" title="Edit" href='<?php echo site_url('backend/cheque_register/edit_cheque_assing/' . $row['id']); ?>'><i class="fa fa-edit"></i></a>
                                            <?php }?>
                                        </td>

                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>


                   
                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form action="<?php echo site_url('cheque_register/insertAssign_cheque') ?>" method="post">
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
                                            <select required="" name="company" id="company" onchange="changecompany()"class="form-control" required="">
                                                <!--<option value="">Select Company</option>-->
                                                <?php foreach ($company as $c) { ?>
                                            <option class="form-control" value="<?php echo $c['c_id']; ?>"><?php echo $c['c_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Select Bank Name</label><span style="color:red">*</span>
                                            <select required="" name="bank" id="bank" class="form-control" onchange="changebank()" required="">
                                        <option>Select Bank</option>
                                        <?php foreach ($bank as $b) { ?>
                                            <option    class="form-control" value="<?php echo $b['id']; ?>"><?php echo $b['b_name']. '('.$b['b_account_no'].')'; ?></option>
                                        <?php } ?>
                                    </select>
                                            <!-- <select required="" name="bank" id="bank" class="form-control" onchange="changebank()" required="">
                                        <option value="Select Bank">Select Bank</option>
                                        
                                        
                                    </select> -->
                                        </div>
                                    </div>
                                    
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <div class="col-md-6">
                                            <label>Bank Branch</label><span style="color:red">*</span>
<!--                                    <input type="text" name="bank_branch" value="<?php echo $bank[0]['bank_branch']; ?>" id="bank_branch" class="form-control" placeholder="Bank Branch"/>-->
                                            <select required="" name="bank_branch" id="bank_branch" class="form-control" onchange="changebranch()" required="">
                                        <option value="">Select Bank</option>
                                        
                                        
                                    </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Account No</label><span style="color:red">*</span>
<!--                                    <input type="text" name="account_no" value="<?php echo $bank[0]['account_no']; ?>" id="account_no" class="form-control" placeholder="Account No"/>-->
                                            <select required="" name="bank_account" id="bank_account" class="form-control" onchange="changeaccount()" required="">
                                        <option value="">Select Bank</option>
                                        
                                        
                                    </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <div class="col-md-6">
                                            <label>Current Cheque Number</label><span style="color:red">*</span>
                                    <input type="text" name="current_chk" id="current_chk"  value="" class="form-control"  required="" placeholder="Current Cheque Number">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Cheque Date</label>
                                            <input type="text" id="ch_date"name="cheque_date" class="form-control"  placeholder="Cheque Dates">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <div class="col-md-6">
                                            <label>Cheque Type</label><span style="color:red">*</span>
                                    <select name="chk_type" id="chk_type" class="form-control" required="">
                                        <option class="form-control" value="">Select a type</option>
<!--                                            <option class="form-control" value="A">A</option>-->
                                            <option class="form-control" value="Account Payee">Account Payee</option>
                                            <option class="form-control" value="Cash">Cash</option>
<!--                                            <option class="form-control" value="Cancelled">Cancelled</option>
                                            <option class="form-control" value="Security">Security</option>
                                            <option class="form-control" value="Others">Others</option>-->
                                       
                                    </select>
                                        </div>
                                         <div class="col-md-6"><label>Amount</label><span style="color:red">*</span>
                                   <input type="text" name="amount" class="form-control" required="" placeholder="Amount">
                                   </div>
                                        
                                    </div>
                                    <br>
                                    <div class="col-md-12 M-row">
                                       <div class="col-md-6"><label>Pay To / Head Of Account</label><span style="color:red">*</span>
<!--                                   <input type="text" name="pay_to" class="form-control" required="" placeholder="Pay To"/>-->
                                           <select name="party" id="party" class="form-control select2" >
                                                <option value="">Select Company</option>
                                                <?php foreach ($party as $p) { ?>
                                            <option class="form-control" value="<?php echo $p['ID']; ?>"><?php echo $p['SUP_NAME']; ?></option>
                                        <?php } ?>
                                    </select>
<!--                                    <a style="margin-top:10px;" class="btn btn-primary" id="AddParty"><i class="fa fa-plus"></i> Add party</a>-->
                                           <a href="<?php echo site_url('general_store/add_supplier')?>" style="margin-top:10px;" class="btn btn-primary" ><i class="fa fa-plus"></i> Add party</a>
                                   </div>
                                        <div class="col-md-6">
                                            <input id="payto_check" style="margin-top: 33px;" type="checkbox" name="showpayto" value="YES"> Write Party Name
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
                            <form action="<?php echo site_url('setup/issued_cheque') ?>" method="post">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Issued Cheque</h4>
                                </div>
                                <div class="modal-body">
                                   <div class="col-md-12 M-row">
                                       
                                            <label>Issued Date</label>
                                    <input type="text" name="issued_date" class="form-control datepicker" placeholder="Issued date">
                                        
                                        
                                    </div>
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <label>Received By</label>
                                    <input type="text" name="receive_by" class="form-control" placeholder="Receive By">
                                    </div>
                                    
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <label>Remarks</label>
                                    <input type="text" name="remarks" class="form-control" placeholder="Remarks">
                                    </div>
                                   
                                    <div class="clearfix"></div>
                                    <input type="hidden" id="issue_id" name="issue_id">
                                   
                                   
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    
                    <div id="confrimmodal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form action="<?php echo site_url('cheque_register/assCheconfirm') ?>" method="post">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Printed Date</h4>
                                </div>
                                
                                <div class="modal-body">
                                   <div class="col-md-12 M-row">
                                        <input type="hidden" name="cheque_id" id="cheque_id" value="">
                                            <label>Printed Date</label>
                                            <input required readonly="" type="text" id="pch_date" name="print_date" class="form-control" value="<?php echo date('d-m-Y');?>" placeholder="Printed date" >
                                           
                                        
                                    </div>
                                   
                                   <div class="clearfix"></div> 
                                   
                                   
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    
                    <div id="partyAdd" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">party Add</h4>
                                </div>
                                <div class="modal-body">
                                   <div class="col-md-12 M-row">
                                       
                                            <label>Party Name</label>
                                            <input type="text" id="party_name" name="party_name" class="form-control" placeholder="Party Name">
                                        
                                        
                                    </div>
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <label>party Phone </label>
                                        <input type="text" id="party_phone" name="party_phone" class="form-control" placeholder="Party Phone">
                                    </div>
                                    
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <label>Party Address</label>
                                        <input type="text" id="party_address" name="party_address" class="form-control" placeholder="Party Address">
                                    </div>
                                   
                                    <div class="clearfix"></div>
                                    <input type="hidden" id="issue_id" name="issue_id">
                                   
                                   
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="submit" onclick="partyadd()" class="btn btn-primary pull-right">Submit</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    
                   </div>  
                    
                    
                </div>
           





<script>

$("#pch_date").datepicker({
    dateFormat: 'dd-mm-yy',
    //maxDate: new Date,
    beforeShow: function (input, inst) {
        setTimeout(function () {
            inst.dpDiv.css({
                top: 150,
                left: 420
            });
        }, 0);
    }
});

$("#ch_date").datepicker({
    dateFormat: 'dd-mm-yy',
    beforeShow: function (input, inst) {
        setTimeout(function () {
            inst.dpDiv.css({
                top: 272,
                left: 690
            });
        }, 0);
    }
});

//$('#pch_date').datepicker();
    //$('#ch_date').datepicker();


  $('.select2').select2();  
 




$('#chk_type').change(function(){
        var cheque_type = $(this).val();
        if(cheque_type == 'Account Payee'){
             $("#payto_check").prop("checked", true);
             $('#party').prop('required',true); 
             
        }else{
           $("#payto_check").prop("checked", false);
           
           
           
        }
        
    })
$('#payto_check').click(function(){
        var cheque_type = $('#chk_type').val();
        if(cheque_type == 'Account Payee'){
             $("#payto_check").prop("checked", true);
        }else{
        if($(this).prop("checked") == true){
          
                $('#party').prop('required',true); 

            }else{
               $('#party').prop('required',false);  
            }
          
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
    
    
    $('#AddParty').click(function(){
        $('#partyAdd').modal('show');
    })
    
    function partyadd(){
        
        var party_name = $('#party_name').val();
        var party_phone = $('#party_phone').val();
        var party_address = $('#party_address').val();
       
        if(party_name == '' ){
            alert('Please enter the party name')
            return false;
        }
        if(party_phone == '' ){
            alert('Please enter the party Phone')
            return false;
        }
        
         if(party_address == '' ){
            alert('Please enter the party address')
            return false;
        }
        
         
        $.ajax({
           type: "POST",
            url: "backend/cheque_register/partyaddbyajax",
            data: {party_name:party_name,party_phone:party_phone,party_address:party_address},
            dataType: "json",
            
            success: function (data) {
                
                if (data.msg == 'success') {
                    var str = '';
                  alert(data.msg);
                    $(data.value).each(function(row,val){
                       
        str+='<option selected value="'+val.p_id+'">'+val.p_name+'</option>';
                       $('#party').append(str).trigger('change');
                    })
                    
                   $('#partyAdd').modal('hide'); 
                    
                    
                    
                    
                }
            }
        })
    }
    
    function showIssued(id){
        $('#issue_id').val(id)
     $('#issuedCmodal').modal('show');

    }
    
    function changecompany(){
        var c_id = $('#company').val();
        $.ajax({
           type: "POST",
            url: "backend/cheque_register/getbank",
            data: {c_id:c_id},
            dataType: "json",
            
            success: function (data) {
                
                if (data.msg == 'success') {
                    var str = '';
                    str+='<option value="">Select bank name</option>';
                    $('#bank').html(str);
                    $(data.value).each(function(row,val){
                       str+='<option value="'+val.id+'">'+val.b_name+'('+val.b_account_no+')</option>';
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
            url: "backend/cheque_register/getBranch",
            data: {b_name:b_name},
            dataType: "json",
            
            success: function (data) {
                
                if (data.msg == 'success') {
                    var str = '';
                     str+='<option value="">Select bank branch</option>';
                    $('#bank_branch').html(str);
                    $(data.value).each(function(row,val){
                       str+='<option value="'+val.branch_name+'">'+val.branch_name+'</option>';
                       $('#bank_branch').html(str);
                    })
                    
                    
                    
                    
                    
                    
                }
            }
        })
    }
    function changebranch(){
        var b_branch = $('#bank_branch').val();
        var c_id= $('#company').val();
        var b_name = $('#bank').val();
        $.ajax({
           type: "POST",
            url: "backend/cheque_register/getAccountNo",
            data: {b_branch:b_branch,c_id:c_id, b_name: b_name},
            dataType: "json",
            
            success: function (data) {
                
                if (data.msg == 'success') {
                    var str = '';
                    str+='<option value="">Select bank account</option>';
                    $('#bank_account').html(str);
                    $(data.value).each(function(row,val){
                       str+='<option value="'+val.b_account_no+'">'+val.b_account_no+' ('+val.b_account_type+')'+'</option>';
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
            url: "backend/cheque_register/getchequeno",
            data: {'c_id':c_id,'b_id':b_id,'b_branch':b_branch,'b_account':b_account},
            dataType: "json",
            
            success: function (data) {
                
                if (data.msg == 'success') {
               
            $('#current_chk').val(data.value);
                   }
            }
        })
    }
    
    $('#current_chk').blur(function(){
        
      var c_id = $('#company').val();
        var b_id = $('#bank').val();
        var b_branch = $('#bank_branch').val();
        var b_account = $('#bank_account').val();
        var current_chk = $('#current_chk').val();
        $.ajax({
           type: "POST",
            url: "backend/cheque_register/cheque_no_check",
            data: {'c_id':c_id,'b_id':b_id,'b_branch':b_branch,'b_account':b_account,'current_chk':current_chk},
            dataType: "json",
            
            success: function (data) {
                
                if (data.msg == 'success') {
                    alert('This cheque no. is already exist')
                  $('#current_chk').val('');
                   }
            }
        })  
    })
    
    
    
     function printedCheque(chk_id){
         
        
        if(confirm('Are you suer ?')==true){
         window.location.href = '<?php echo site_url('cheque_register/printedCheque/')?>/'+chk_id;
       
    }
    }
   
   function confriPrintChe(chk_id){
    
    $('#confrimmodal').modal('show');
    $('#cheque_id').val(chk_id);
    } 
    
</script>
<!-- /page content -->