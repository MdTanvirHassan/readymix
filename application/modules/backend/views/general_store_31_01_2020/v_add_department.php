 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Unit</h3>
            </div>
        </div>
    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 <div class="x_content">
                     <form class="form-horizontal" action="<?php echo site_url('general_store/add_action_department'); ?>" method="post">
                         
                         
                         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Unit Code   :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control" id="inputdefault" name="dep_c" type="hidden" value="<?php if(!empty($dep_code)) echo $dep_code; ?>">
                                    <input class="form-control" id="inputdefault" name="dep_code" type="hidden" value="<?php if(!empty($dep_auto_code)) echo "PR".$dep_auto_code; ?>">
                                    <input disabled class="form-control" id="inputdefault" name="dep_code1" type="text" value="<?php if(!empty($dep_auto_code)) echo "PR".$dep_auto_code; ?>">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Unit Name :
                               </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                   <input required class="form-control" id="inputdefault" name="dep_description" type="text">
                               </div>
                             
                         </div>
                         
                         
                         
                        
                         
                         
                         
                         
                         
                         
                         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Short Name :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input required class="form-control" id="inputdefault" name="short_name" type="text">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Email :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input required class="form-control" id="email" name="email" type="text">
                                </div>
                         </div>
                         
                         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Mobile No. :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input required class="form-control" id="inputdefault" name="mobile_no" type="text">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Phone :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input required class="form-control" id="inputdefault" name="phone" type="text">
                                </div>
                         </div>
                         
                         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Address :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input required class="form-control" id="inputdefault" name="address" type="text">
                                </div>
                                
                         </div>
                         
                         <div class="form-group" style="margin-top: 40px;">
                        <div class=" col-sm-2">
                            <button type="submit" class="btn btn-primary button">SAVE</button>
                        </div>
                        <div class="col-sm-2">
                            <a href="<?php echo site_url('backend/general_store/department') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
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

$('#email').blur(function(){
   var email = $(this).val();
   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;  
   if(!emailReg.test(email)) {  
        alert("Please enter valid email id");
        $(this).val('');
   } 
})

</script>


