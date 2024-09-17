<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Change Password</h3>
            </div>
        </div>
    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            <?php if(isset($message)){ ?>
                <div class="alert alert-danger"><?php echo @$message; ?></div>
            <?php } else { ?>
                
            <?php } ?>
                <div class="x_panel">
                 <div class="x_content">
                     <form class="form-horizontal" action="<?php echo site_url('login/changePasswordAction'); ?>" method="post">
                         
                         
                         <div class='form-group' >
                             
                            <label for="title" class="col-sm-2 control-label">
                                Old Password<sup style="color:red;">*</sup>:
                            </label> 
                                  <div class="col-sm-4 input-group">
                                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                       <input type="password" required class="form-control" name="old_pass" type="text">
                            </div>
                             
                            <label for="title" class="col-sm-2 control-label">
                                New Password<sup style="color:red;">*</sup>:
                            </label>
                            <div class="col-sm-4 input-group">
                                <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                <input type="password" required class="form-control" name="new_pass" type="text">
                            </div>
                             
                            <label for="title" class="col-sm-2 control-label">
                                Confirm Password<sup style="color:red;">*</sup>:
                            </label>
                            <div class="col-sm-4 input-group">
                                <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                <input type="password" required class="form-control" name="confirm_pass" type="text">
                            </div>

                         </div>
                         
                         
                        
                         
                       
                         
                         
                         
                        
                         
                         
                         
                         
                         
                         
                         
                         
                         
                         <div class="form-group" style="margin-top: 40px;">
                        <div class=" col-sm-2">
                            <button type="submit" class="btn btn-primary button">SAVE</button>
                        </div>
                        <div class="col-sm-2">
                            
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












