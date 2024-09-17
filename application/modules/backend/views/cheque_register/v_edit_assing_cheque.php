

<!-- page content -->

<div class="right_col" role="main" >
    <?php $this->load->view('cheque_register/common');?>
    <div class="">
<!--        <div class="page-title">
            <div class="title_center">
                <h3> Assigned CHEQUE LIST</h3>
            </div>


        </div>-->

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel m_panel">
                    <div class="x_content">
                        <div class="col-md-12  col-sm-12 col-xs-12"style="margin-top: -6px; margin-bottom: 3px;">
                            <div class="col-md-6 col-sm-6 ">
                                <div class="themat_title">
                                    <!--                                    <h4>TRIP LIST</h4> -->
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">

<!--                                <button class="addth-button pull-right" id="create_new_cheque"><span class="fa fa-plus"></span>  Write New Cheque</button>-->
                            </div>
                            
                            <form action="<?php echo site_url('cheque_register/edit_cheque_assing_action/'.$che_id) ?>" method="post">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Cheque</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12 M-row">
                                        <div class="col-md-6">
                                            <label>Select Company Name</label><span style="color:red">*</span>
                                            <select name="company" id="company" onchange="changecompany()"class="form-control" required="">
                                                <option value="">Select Company</option>
                                                <?php foreach ($company as $c) { ?>
                                            <option <?php if($currentdata[0]['c_id'] == $c['c_id']) echo 'selected'?> class="form-control" value="<?php echo $c['c_id']; ?>"><?php echo $c['c_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Select Bank Name</label><span style="color:red">*</span>
                                       <select name="bank" id="bank" class="form-control" onchange="changebank()" required="">
                                        <option value="">Select Bank</option>
                                        <?php foreach ($bank as $b) { 
                                            if($currentdata[0]['bank_id'] != $b['id']){
                                                continue;    
                                            }
                                            ?>
                                        
                                            <option <?php if($currentdata[0]['bank_id'] == $b['id']) echo 'selected'?>  value="<?php echo $b['id']; ?>"><?php echo $b['b_name']; ?></option>
                                        <?php } ?>
                                        
                                    </select>
                                        </div>
                                    </div>
                                    
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <div class="col-md-6">
                                            <label>Bank Branch</label><span style="color:red">*</span>
<!--                                    <input type="text" name="bank_branch" value="<?php echo $bank[0]['bank_branch']; ?>" id="bank_branch" class="form-control" placeholder="Bank Branch"/>-->
                                            <select name="bank_branch" id="bank_branch" class="form-control" onchange="changebranch()" required="">
                                        <option value="<?php echo $currentdata[0]['bank_branch']?>"><?php echo $currentdata[0]['bank_branch']?></option>
                                        
                                        
                                    </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Account No</label><span style="color:red">*</span>
<!--                                    <input type="text" name="account_no" value="<?php echo $bank[0]['account_no']; ?>" id="account_no" class="form-control" placeholder="Account No"/>-->
                                            <select name="bank_account" id="bank_account" class="form-control" onchange="changeaccount()" required="">
                                        <option value="<?php echo $currentdata[0]['bank_account']?>"><?php echo $currentdata[0]['bank_account']?></option>
                                        
                                        
                                    </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <div class="col-md-6">
                                            <label>Current Cheque Number</label><span style="color:red">*</span>
                                    <input type="text" name="current_chk" id="current_chk"  value="<?php echo $currentdata[0]['chk_no']?>" class="form-control"  required="" placeholder="Current Cheque Number"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Cheque Date</label><span style="color:red">*</span>
                                            <input type="text" id="ch_date"name="cheque_date" class="form-control datepicker" value="<?php echo date('m/d/Y',strtotime($currentdata[0]['chk_date']))?>" required="" placeholder="Cheque Dates"/>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-12 M-row">
                                        <div class="col-md-6">
                                            <label>Cheque Type</label><span style="color:red">*</span>
                                    <select name="chk_type" id="chk_type" class="form-control" required="">
                                        <option class="form-control" value="">Select a type</option>

                                            <option <?php if($currentdata[0]['chk_type']=='Account Payee') echo 'selected'; ?> class="form-control" value="Account Payee">Account Payee</option>
                                            <option <?php if($currentdata[0]['chk_type']=='Cash') echo 'selected'; ?> class="form-control" value="Cash">Cash</option>

                                       
                                    </select>
                                        </div>
                                         <div class="col-md-6"><label>Amount</label><span style="color:red">*</span>
                                             <input type="text" name="amount" class="form-control" required="" value="<?php echo $currentdata[0]['amount']?>" placeholder="Amount"/>
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
                                   </div>
                                        <div class="col-md-6">
                                            <input <?php if($currentdata[0]['chk_type']=='Account Payee') echo 'checked'; ?> id="payto_check" style="margin-top: 33px;" type="checkbox" name="showpayto" value="YES"> Write Party Name
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
                        <div class="clearfix"></div>
                        <div class="row mline"></div>

                        


                    </div>
                    <!-- Modal -->
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>


    </div>
</div>

<script>
    
 
var date = new Date();
    $('#ch_date').datepicker({ 
    minDate: date
    });

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
            url: "backend/setup/partyaddbyajax",
            data: {party_name:party_name,party_phone:party_phone,party_address:party_address},
            dataType: "json",
            
            success: function (data) {
                
                if (data.msg == 'success') {
                    var str = '';
                  
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
         window.location.href = '<?php echo site_url('setup/printedCheque/')?>/'+chk_id;
       
    }
    }
    
    
</script>
<!-- /page content -->