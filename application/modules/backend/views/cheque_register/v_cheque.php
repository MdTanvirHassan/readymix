<style type="text/css">
    /*    .bootstrap-select {
            width:100px !important;
        }
        .btn{
            box-shadow: none !important;
        }
        .dataTables_filter label input{
            position: absolute;
            top: 4px !important;
            left: 384px !important;
            width: 20% !important;
            padding-left: 30px !important;
        }
        .dataTables_wrapper .dataTables_filter{
            margin-bottom:30px !important;
        }
        .sebox-thematic{
            height: 15px;
        }*/
</style>
<!-- page content -->

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <?php $this->load->view('cheque_register/common');?>


    <div class="right_content">
        <div class="col-md-12  col-sm-12 col-xs-12"style="margin-top: -6px; margin-bottom: 3px;">
            <div class="col-md-5 col-sm-5 ">
                <div class="themat_title">
                    <!--                                    <h4>TRIP LIST</h4> -->
                </div>
            </div>
            <div class="col-md-7 col-sm-7">

                <a href="<?php echo site_url('cheque_register/created_cheque_slot_list') ?>"><button class="addth-button "><span class="fa fa-list"></span>  Cheque Book</button></a>
                <button class="addth-button pull-right " id="create_new_cheque"><span class="fa fa-plus"></span>  Create New Cheque</button>
            </div>

        </div>


        <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
            <thead>

            <th style="width:10%;text-align: center;">SL No</th>
            <th style="width:10%;text-align: center;">Cheque No</th>
            <th style="width:10%;text-align: center;">Date</th>
            <th style="width:15%;text-align: center;">Company Name</th>
            <th style="width:15%;text-align: center;">Bank Name </th>
            <th style="width:10%;text-align: center;">Branch Name</th>
            <th style="width:10%;text-align: center;">Account No</th>


            <th style="text-align: center;width:20%;" class="noExport">Actions</th>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $row) { ?>
                    <tr>

                        <td style="width:5%;text-align: center;"><?php echo ($key + 1); ?></td>
                        <td style="width:15%;text-align: center;"><?php if (!empty($row['chk_no'])) echo $row['chk_no']; ?></td>
                        <td style="width:15%;text-align: center;"><?php if (!empty($row['created'])) echo date('d-m-Y',strtotime($row['created'])); ?></td>
                        <td style="width:20%;text-align: center;"><?php if (!empty($row['c_name'])) echo $row['c_name']; ?></td>
                        <td style="width:20%;text-align: center;"><?php if (!empty($row['bank_name'])) echo $row['bank_name']; ?></td>
                        <td style="width:20%;text-align: center;"><?php if (!empty($row['bank_branch'])) echo $row['bank_branch']; ?></td>
                        <td style="width:20%;text-align: center;"><?php if (!empty($row['account_no'])) echo $row['account_no']; ?></td>

                        <td style="text-align: center;width:20%; font-size:12px;" class="noExport">
                          <!--  <a href='<?php echo site_url('backend/setup/edit_cheque/' . $row['chk_id']); ?>'>Edit</a>/
                            <a onclick='delete_row("<?php echo site_url('backend/setup/delete_cheque/' . $row['chk_id']); ?>")' href='javascript:'>Delete</a> -->
                            <?php if ($row['status'] != 'Wastage') { ?>
                                <a onclick="wastagw('<?php echo $row['chk_id']; ?>')" href='javascript:' title="Wastage"><i style="color:red;font-size: 20px;" class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <?php } ?>
                        </td>

                    </tr>
                <?php } ?>

            </tbody>
        </table>



        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form action="<?php echo site_url('cheque_register/create_cheque') ?>" method="post">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Create Cheque</h4>
                        </div>
                        <div class="modal-body">
                            <label>Select Company Name</label>
                            <select required="" name="company" id="company" class="form-control" onchange="changecompany()">
                                <option value="">Select Company</option>
                                <?php foreach ($company as $c) { ?>
                                    <option class="form-control" value="<?php echo $c['c_id']; ?>"><?php echo $c['c_name']; ?></option>
                                <?php } ?>
                            </select>
                            <br>
                            <br>
                            <label>Select Bank Name</label>
<!--                                    <select name="bank" id="bank" onchange="changeBank()" class="form-control">
                            <?php foreach ($bank as $b) { ?>
                                            <option data-branch="<?php echo $b['bank_branch']; ?>" data-account_no="<?php echo $b['account_no']; ?>" class="form-control" value="<?php echo $b['bank_id']; ?>"><?php echo $b['bank_name']; ?></option>
                            <?php } ?>
                            </select>-->
                            <select required="" name="bank" id="bank" onchange="changebank()" class="form-control select2">
                                <option value="">Select Bank</option>
                            </select>
                            <br>
                            <br>
                            <label>Bank Branch</label>
<!--                                    input type="text" name="bank_branch" value="<?php echo $bank[0]['bank_branch']; ?>" id="bank_branch" class="form-control" placeholder="Bank Branch"/>-->
                            <select required="" name="bank_branch" id="bank_branch" onchange="changebranch()" class="form-control">
                                <option value="">Select Branch</option>
                            </select>
                            <br>
                            <br>
                            <label>Account No</label>
                            <select required="" name="bank_account" id="bank_account" class="form-control">
                                <option value="">Select Account No.</option>
                            </select>
<!--                                    <input type="text" name="account_no" value="<?php echo $bank[0]['account_no']; ?>" id="account_no" class="form-control" placeholder="Account No"/>-->
                            <br>
                            <br>
                            <label>Cheque No Start From</label>
                            <input required="" type="text" name="cheque_no_start" class="form-control" placeholder="Cheque No Start From"/>
                            <br>
                            <br>
                            <label>Cheque No End</label>
                            <input required="" type="text" name="cheque_no_end" class="form-control" placeholder="Cheque No End"/>
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

<script>
    $('.select2').select2();  
//    function changeBank() {
//        var bank_id = $('#bank').val();
//        var account_no = $('#bank option:selected').data('account_no');
//        var branch = $('#bank option:selected').data('branch');
//        $('#account_no').val(account_no)
//        $('#bank_branch').val(branch)
//    }

    $('#create_new_cheque').click(function () {

        $('#myModal').modal('show');

    })



    function changecompany() {
        var c_id = $('#company').val();
        $.ajax({
            type: "POST",
            url: "backend/cheque_register/getbank",
            data: {c_id: c_id},
            dataType: "json",
            success: function (data) {

                if (data.msg == 'success') {
                    var str = '';
                    str += '<option value="">Select Bank</option>';
                    $('#bank').html(str);
                    $(data.value).each(function (row, val) {
                        str += '<option value="' + val.id + '">' + val.b_name + '(' + val.b_account_no + ')</option>';
                        $('#bank').html(str);
                    })






                }
            }
        })
    }

    function changebank() {
        var b_name = $('#bank').val();

        $.ajax({
            type: "POST",
            url: "backend/cheque_register/getBranch",
            data: {b_name: b_name},
            dataType: "json",
            success: function (data) {

                if (data.msg == 'success') {
                    var str = '';
                    str += '<option value="">Select Branch</option>';
                    $('#bank_branch').html(str);
                    $(data.value).each(function (row, val) {
                        str += '<option value="' + val.branch_name + '">' + val.branch_name + '</option>';
                        $('#bank_branch').html(str);
                    })






                }
            }
        })
    }

    function changebranch() {
        var b_branch = $('#bank_branch').val();
        var c_id = $('#company').val();
        var b_name = $('#bank').val();
        $.ajax({
            type: "POST",
            url: "backend/cheque_register/getAccountNo",
            data: {b_branch: b_branch, c_id: c_id, b_name: b_name},
            dataType: "json",
            success: function (data) {

                if (data.msg == 'success') {
                    var str = '';
                    str += '<option value="">Select Account No.</option>';
                    $('#bank_account').html(str);
                    $(data.value).each(function (row, val) {
                        str += '<option value="' + val.b_account_no + '">' + val.b_account_no + '</option>';
                        $('#bank_account').html(str);
                    })






                }
            }
        })
    }

    function wastagw(chk_id) {
        if (confirm('Are you suer you want to wastage this cheque ?') == true) {
            window.location.href = '<?php echo site_url('cheque_register/cheque_wastage/') ?>/' + chk_id;

        }
    }
</script>
<!-- /page content -->