<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">

    <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php
                $this->role = checkUserPermission(1, 2, $userData);
                 if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>      
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'blance') echo 'active'; ?>" href="<?php echo site_url('backend/expense/balance'); ?>">
                            <i class="fa fa-cc"></i><br><span>Balance</span></a>
                    </li>
                <?php } ?>
                <?php
                $this->role = checkUserPermission(1, 1, $userData);
                 if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'expense') echo 'active'; ?>" href="<?php echo site_url('backend/expense'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Expense  </span>
                        </a>
                    </li>
<?php } ?> 
            </ul>
        </div>
    </div>

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Expense</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-4 control-label">
                                            Balance <span class="required"></span> :
                                        </label> 
                                        <div class="col-sm-8 input-group" style="margin-top:5px;">
                                           
                                            <b>  <?php echo number_format($total_balance[0]['total_amount'],2); ?></b>
                                            <input  class="form-control" type="hidden" id="total_balance" name="total_balance" value="<?php echo $total_balance[0]['total_amount']; ?>" >
                                        </div>



                                    </div>
                                </div>
                               
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-4 control-label">
                                            Expense Name <span class="required">*</span> :
                                        </label> 
                                        <div class="col-sm-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-university"></i></span>
                                            <input required class="form-control" type="text"  id="expense" name="expense" value="" >
                                        </div>



                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class='form-group' >

                                        <label for="title" class="col-sm-4 col-md-4 control-label">
                                            Expense Type :
                                        </label>
                                        <div class="col-sm-8 col-md-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-file-code-o"></i></span>
                                            <!--
                                            <select onchange="extype()" id="type" name="type" class="form-control">

                                                <option value="Normal">Normal</option>
                                                <option value="Service"> Service</option>
                                                <option value="Product">Product</option>
                                            </select>
                                            -->
                                             <select  id="type" name="type" class="form-control">

                                                <option value="Petty Cash">Petty Cash</option>
                                               
                                            </select>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-4 control-label">
                                            Amount :
                                        </label> 
                                        <div class="col-sm-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input required class="form-control number" id="amount" name="amount" type="text" onkeyup="javascript:balanceCheck();" onchange="javascript:balanceCheck();" onblur="javascript:balanceCheck();" >
                                        </div>



                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class='form-group' >

                                        <label for="title" class="col-sm-4 col-md-4 control-label">
                                            Date :
                                        </label>
                                        <div class="col-sm-8 col-md-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-file-code-o"></i></span>


                                            <input required=""  class="form-control datepicker" name="expense_date" type="text" value="<?php echo date('d-m-Y') ?>">
                                        </div>


                                    </div>
                                </div>
                            </div>


                            <div class="row" id="exproduct" style="display:none">
                                <div class="col-md-6">
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-4 control-label">
                                            Quantity :
                                        </label> 
                                        <div class="col-sm-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                            <input  class="form-control" name="qty" type="text" >
                                        </div>



                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class='form-group' >

                                        <label for="title" class="col-sm-4 col-md-4 control-label">
                                            Requisition :
                                        </label>
                                        <div class="col-sm-8 col-md-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                            <select  name="ipo_m_id" class="form-control">

                                                <option value="">Select</option>
                                                <?php foreach ($material_indent as $row){?>
                                                <option value="<?php echo $row['ipo_m_id']?>"> <?php echo $row['ipo_number'] ?></option>
                                                <?php }?> 
                                            </select>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6" id="service_id" style="display:none;">
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-4 control-label">
                                            Service :
                                        </label> 
                                        <div class="col-sm-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                            <select  name="service_id" class="form-control">

                                                <option value="">Select</option>
                                                <?php foreach($services as $row){?>
                                                 <option value="<?php echo $row['id'];?>"><?php echo $row['service_name'];?></option>
                                                <?php }?>
                                            </select>
                                        </div>



                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class='form-group' >

                                        <label for="title" class="col-sm-4 col-md-4 control-label">
                                            Remark :
                                        </label>
                                        <div class="col-sm-8 col-md-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                            <input  class="form-control" name="remark" type="text" >
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Image Upload :
                                </label>
                                <div class="col-sm-10 input-group">

                                    <div class="well" data-bind="fileDrag: multiFileData">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <!-- ko foreach: {data: multiFileData().dataURLArray, as: 'dataURL'} -->
                                                <img style="height: 100px; margin: 5px;" class="img-rounded  thumb" data-bind="attr: { src: dataURL }, visible: dataURL">
                                                <!-- /ko -->
                                                <div data-bind="ifnot: fileData().dataURL">
                                                    <label class="drag-label">Drag files here</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input name="e_image[]" type="file" multiple data-bind="fileInput: multiFileData, customFileInput: {
	              buttonClass: 'btn btn-success',
	              fileNameClass: 'disabled form-control',
	              onClear: onClear,
	              onInvalidFileDrop: onInvalidFileDrop
	            }" accept="image/*">
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>













                            <div class="form-group" style="margin-top: 40px;">
                                 <div class="col-sm-2">
                                    <a href="<?php echo site_url('expense') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                                </div>
                                <div class=" col-sm-2">
                                    <button id="submitCheck" type="submit" class="btn btn-primary button">SAVE</button>
                                </div>
                               
                            </div>
                        </form>     
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $('.select2').select2();
    
    
    function balanceCheck(){
        $('.number').on('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);  
        });
        var balance=Number($('#total_balance').val());
        var amount=Number($('#amount').val());
        if(amount>balance){
            $('#amount').val('');
        }
    }
    
    
    

    $('#submitCheck').click(function () {
        var amount = $('#amount').val();

        if (amount > 0) {

            return true;
        } else {
            alert('please input positive value and greater than 0');
            $('#amount').val('');
            return false;

        }
    })
    
    function extype(){
    var type = $('#type').val();
    if(type == 'Product'){
     $('#exproduct').css("display","block"); 
     $('#service_id').css("display","none");
    }else if(type == 'Service'){
     $('#exproduct').css("display","none");    
     $('#service_id').css("display","block");    
    }else{
      $('#exproduct').css("display","none"); 
      $('#service_id').css("display","none"); 
    }
   
    }
</script>
<script>
    var viewModel = {};
    viewModel.fileData = ko.observable({
        dataURL: ko.observable(),
        // can add "fileTypes" observable here, and it will override the "accept" attribute on the file input
        // fileTypes: ko.observable('.xlsx,image/png,audio/*')
    });
    viewModel.multiFileData = ko.observable({dataURLArray: ko.observableArray()});
    viewModel.onClear = function (fileData) {
        if (confirm('Are you sure?')) {
            fileData.clear && fileData.clear();
        }
    };
    viewModel.debug = function () {
        window.viewModel = viewModel;
        console.log(ko.toJSON(viewModel));
        debugger;
    };
    viewModel.onInvalidFileDrop = function (failedFiles) {
        var fileNames = [];
        for (var i = 0; i < failedFiles.length; i++) {
            fileNames.push(failedFiles[i].name);
        }
        var message = 'Invalid file type: ' + fileNames.join(', ');
        alert(message)
        console.error(message);
    };
    ko.applyBindings(viewModel);
</script>
