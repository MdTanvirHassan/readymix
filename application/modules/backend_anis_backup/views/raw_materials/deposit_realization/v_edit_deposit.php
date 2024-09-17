<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Deposit</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal"action="<?php echo site_url('raw_materials/deposit_realization/edit_deposit_action/'.$deposit_info[0]['id']); ?>" method="post">
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                   Instrument<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select required id="collection_id" class="form-control" name="collection_id">
                                                <option class="form-control" value="">Select Collection</option>
                                                <?php foreach ($collections as $collection) { ?>
                                                    <option <?php if ($deposit_info[0]['collection_id'] == $collection['id']) echo 'selected'; ?> class="form-control" value="<?php echo $collection['id'] ?>"><?php echo $collection['collection_method'] . '(' . $collection['no'] . ')'.'('.$collection['c_name'].')' ?></option>
                                                <?php } ?>
                                            </select>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Deposit. Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input id="deposit_date" required class="form-control datepicker1" name="deposit_date" type="text" value="<?php if (!empty($deposit_info[0]['deposit_date'])) echo date('d-m-Y', strtotime($deposit_info[0]['deposit_date'])); ?>">
                                </div>

                            </div>
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                   Bank<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select required id="o_id" class="form-control e1" name="bank_id">
                                                <option class="form-control" value="">Select Bank</option>
                                                <?php foreach ($banks as $bank) { ?>
                                                    <option <?php if ($bank['id'] == $deposit_info[0]['bank_id']) echo 'selected'; ?> class="form-control" value="<?php echo $bank['id'] ?>"><?php echo $bank['b_short_name'] . '(' . $bank['branch_name'].')'.'('.$bank['b_account_no'].')'; ?></option>
                                                <?php } ?>
                                            </select>
                                </div>
                               
                              
                            </div>
                            
                            
                             <div class='form-group' >
                               
                                 <label for="title" class="col-sm-2 control-label">
                                    Remark<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control " name="remark" type="text" value="<?php if (!empty($deposit_info[0]['remark'])) echo $deposit_info[0]['remark']; ?>">
                                </div>

                            </div>
                            
                            
                            
<!--                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Instrmnt<sup style="color:red;">*</sup> :</label></div>
                                        <div class="col-sm-8 col-md-5 ">
                                            <select required id="collection_id" class="form-control" name="collection_id">
                                                <option class="form-control" value="">Select Collection</option>
                                                <?php foreach ($collections as $collection) { ?>
                                                    <option <?php if ($deposit_info[0]['collection_id'] == $collection['id']) echo 'selected'; ?> class="form-control" value="<?php echo $collection['id'] ?>"><?php echo $collection['collection_method'] . '(' . $collection['no'] . ')' ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-sm-4 col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Deposit. Date<sup style="color:red;">*</sup> :</label></div>
                                        <div class="col-sm-8 col-md-5 ">
                                            <input id="deposit_date" required class="form-control datepicker" name="deposit_date" type="text" value="<?php if (!empty($deposit_info[0]['deposit_date'])) echo date('d-m-Y', strtotime($deposit_info[0]['deposit_date'])); ?>">
                                        </div>
                                    </div>
                                </div>

                            </div>-->

<!--                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Bank :</label></div>
                                        <div class="col-sm-8 col-md-5 ">
                                            <select required id="o_id" class="form-control" name="bank_id">
                                                <option class="form-control" value="">Select Bank</option>
                                                <?php foreach ($banks as $bank) { ?>
                                                    <option <?php if ($bank['id'] == $deposit_info[0]['bank_id']) echo 'selected'; ?> class="form-control" value="<?php echo $bank['id'] ?>"><?php echo $bank['b_short_name'] . '(' . $bank['branch_name'] . ')' ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-sm-4 col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Remark :</label></div>
                                        <div class="col-sm-8 col-md-5 ">
                                            <input  class="form-control " name="remark" type="text" value="<?php if (!empty($deposit_info[0]['remark'])) echo $deposit_info[0]['remark']; ?>">
                                        </div>
                                    </div>
                                </div>

                            </div>-->




                            <hr>




                            <div class="row">
                                
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/raw_materials/deposit_realization') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary button">UPDATE</button>
                                </div>
                                
                            </div> 


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(".datepicker1").datepicker({
        dateFormat: 'dd-mm-yy'
    
    });


    $('#collection_id').change(function () {
        var id = $('#collection_id').val();
        if (id != '') {
            $.ajax({
                url: '<?php echo site_url('deposit_realization/get_collection_info'); ?>',
                data: {'id': id},
                method: 'POST',
                dataType: 'json',
                success: function (msg) {
                    if (msg.collection_info != '') {
                        if (msg.collection_info[0].collection_method == "Pdc") {
                            $('#deposit_date').val(msg.collection_info[0].check_date);
                        } else if (msg.collection_info[0].collection_method == "Po") {
                            $('#deposit_date').val(msg.collection_info[0].po_date);
                        } else if (msg.collection_info[0].collection_method == "Bg") {
                            $('#deposit_date').val(msg.collection_info[0].bg_expire_date);
                        } else if (msg.collection_info[0].collection_method == "Lc") {
                            $('#deposit_date').val(msg.collection_info[0].lc_date);
                        }
//                                $('#bank').val(msg.collection_info[0].b_short_name);
//                                $('#branch').val(msg.collection_info[0].branch_name);
                    }
                }

            })
        } else {
            $('#deposit_date').val('');
//            $('#bank').val('');
//            $('#branch').val('');
        }

    });








</script>



