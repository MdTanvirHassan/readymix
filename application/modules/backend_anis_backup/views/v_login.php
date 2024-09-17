<style type="text/css">
    .error{
        color: #ffffff;
        background-color: rgba(236, 94, 90,0.6);
        border-color: rgba(238, 77, 99,1);
        padding: 4px;
        width: 100%;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 2px;
    }
    .well{
        margin-bottom: 0px !important;
        margin-top: 135px;
        background-color: #FBFAFA !important;
        opacity: .90;
    }
    .login-bg{
     /*   background: url('images/bg/rx.jpg'); */
         background: url('images/kmix__.jpg'); 
        background-size: cover;
        min-height: 657px;
        width: 100%;

    }
    fieldset h3{ text-align: center; color:#626262;font-weight: bold; padding-bottom: 28px;border-bottom: 1px solid #D9D9D9}
    fieldset h3{ text-align: center; color:#626262;font-weight: bold; padding-bottom: 28px;border-bottom: 1px solid #D9D9D9}
    fieldset h4{ text-align: center; color:#616161; margin-top: 28px;margin-bottom: 20px}
    fieldset{margin-bottom: 20px}
</style>

<div class="container-fluid login-bg">

    <div class="row">
        <div class="well col-md-5 col-sm-8 col-xs-10 center login-box">
            <?php if (isset($message)) { ?>
                <div class="alert alert-danger"><?php echo @$message; ?></div>
            <?php } else { ?>
                
            <?php } ?>
            <form class="form-horizontal" accept-charset="UTF-8" role="form" method="post" action="backend/login/loginAction">
                <fieldset>
                    <div class='col-md-12 col-sm-12 col-xs-12'>
                        
                     <!--   <h2><img src='<?php echo site_url('images/logo.png'); ?>' style='width:20%;margin-right: 20px;'/></h2>-->
                    </div>
                    <h2 style='color: #43C3BA;font-weight: bold;padding-bottom: 28px;border-bottom: 1px solid #D9D9D9'>KARIM ASPHALT & READY MIX LTD.</h2>
<!--                    <h4>CREDENTIALS</h4>-->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                            <div  class="clearfix">
                                <input style='width: 100%' class="form-control" placeholder="Username" name="user_name" type="text" required>
                            </div>
                            <br>
                            <div class="clearfix">
                                <input style='width: 100%' class="form-control" placeholder="Password" name="user_pass" type="password" value="" required>
                            </div>
                        </div>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                            <div style='width: 100%' class="input-prepend">
        <!--                        <label for="remember" class="remember"><input name="remember" type="checkbox" value="RememberMe"> Remember Me</label>-->
                            </div>
                            <p class="center col-md-12 col-sm-12">
                                <input style='background: #43C3BA;margin-top: 25px' class="btn btn-primary" type="submit" value="SIGN IN">
                            </p>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>  
<script type="text/javascript">
    $('input#sendemail').live('click', function (e) {
        var error = 1;
        if ($('input#email').val() != '') {
            e.preventDefault();
            var error = 0;
        }
        if (!error) {
            $.ajax({
                type: "POST",
                url: "dashboard/ForgotPassword",
                data: "email=" + $('input#email').val(),
                dataType: "json",
                success: function (result) {
                    if (result.success) {
                        bootbox.alert(result.success, function () {
                            $('#myModal').modal('hide');
                        });
                    } else {
                        bootbox.alert(result.error, function () {
                        });
                    }
                }
            });
        }
    })

    $('a#showsignup').live('click', function () {
        if (('div#myModalRegistration div.panel-body p.mszsuccess').length) {
            $('div#myModalRegistration div.panel-body p.mszsuccess').hide();
            $('div#myModalRegistration div.panel-body form#signup').show();
        }
    })




    $('input#signup').live('click', function (e) {
        var error = 1;
        if (($('input#user_email').val() != '') && ($('input#user_name').val() != '') && ($('input#user_pass').val() != '')) {
            e.preventDefault();
            var error = 0;
        }
        if (!error) {
            $.ajax({
                type: "POST",
                url: "dashboard/registration",
                data: "user_email=" + $('input#user_email').val() + '&user_name=' + $('input#user_name').val() + '&user_pass=' + $('input#user_pass').val(),
                dataType: "json",
                success: function (result) {
                    if (result.success) {
                        $('div#myModalRegistration div.panel-body form#signup').hide();
                        $('div#myModalRegistration div.panel-body p.mszsuccess').show();
                        $('input#user_email').val('');
                        $('input#user_name').val('');
                        $('input#user_pass').val('');
                        $('input#re_pass').val('');
                        //  $('div#myModalRegistration div.panel-body p.mszsuccess').text('You will get an Confirmation email after approval from Admin.');
                    } else {
                        bootbox.alert(result.error, function () {
                        });
                        $('input#user_email').val('');
                        $('input#user_name').val('');
                        $('input#user_pass').val('');
                        $('input#re_pass').val('');
                    }
                }
            });
        }

    })

    function checkEmail(inputvalue) {
        var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
        if (pattern.test(inputvalue) == false) {
            return false;
        } else
            return true;
    }

    $(document).ready(function () {

        $('input[type=email]').blur(function () {
            if (checkEmail($(this).val()) == false) {
                $(this).closest('.form-group').addClass('has-error');
                $('.error').show();
                return false;
            }
        });

        $('#user_pass').blur(function () {
            if (($(this).val()) == false || $(this).val().length < 6) {
                $(this).closest('.form-group').addClass('has-error');
                $('#pass_error').show();
                return false;
            }
        });

        $('#re_pass').blur(function () {
            if ($(this).val() != $('#user_pass').val()) {
                $(this).closest('.form-group').addClass('has-error');
                $('#re_pass_error').show();
                return false;
            }
        });

    });

    $('#show_modal').live('click', function () {
        $('input[type=email]').closest('.form-group').removeClass('has-error');
        $('input[type=email]').val('');
        $('.error').hide();
    });

    $('#showsignup').live('click', function () {
        $('input[type=email]').closest('.form-group').removeClass('has-error');
        $('input[type=password]').closest('.form-group').removeClass('has-error');
        $('input[type=email]').val('');
        $('input[type=password]').val('');
        $('.error').hide();
    });

</script>