<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">

    <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
            <?php $this->role = checkUserPermission(1, 2, $userData);
 if(empty($this->role) || !array_key_exists(11,$this->role)){ 
    ?>      
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'balance') echo 'active'; ?>" href="<?php echo site_url('backend/expense/balance'); ?>">
                            <i class="fa fa-cc"></i><br><span>Balance</span></a>
                    </li>
<?php } ?>
                <?php $this->role = checkUserPermission(1, 1, $userData);
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
                <h3>Add Balance</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 col-md-2 control-label">
                                    Amount <span class="required">*</span> :
                                </label>
                                <div class="col-sm-4 col-md-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                    <input class="form-control" type="text" name="amount" id="amount">

                                </div>
                                <label for="title" class="col-sm-2 col-md-2 control-label">
                                    Date <span class="required">*</span> :
                                </label>
                                <div class="col-sm-4 col-md-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                    
                                    <input required=""  class="form-control datepicker" name="balance_date" type="text" value="<?php echo date('d-m-Y') ?>">
                                </div>
                            </div>

                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Remark :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                    <textarea class="form-control" name="remark" id="remark"></textarea>
                                </div>
                                

                            </div>













                            <div class="form-group" style="margin-top: 40px;">
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/expense/balance'); ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                                </div>
                                
                                <div class=" col-sm-2">
                                    <button id="submitCheck" type="submit" class="btn btn-primary button ">SAVE</button>
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
    $('#submitCheck').click(function(){
     var amount  = $('#amount').val();  
    
     if(amount > 0){
        
         return true;
     }else{
         alert('please input positive value and greater than 0');
         $('#amount').val('');
       return false;
       
     }
    })
</script>
