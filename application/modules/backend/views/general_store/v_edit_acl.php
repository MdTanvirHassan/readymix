<style>

    table.table {
        clear: both;
        margin-bottom: 20px !important;
        max-width: none !important;
    }
    
    
    .nav li a.tab_text {
        color: #000000 !important;
    }

</style>

<!--form area1-->
<!--form area2-->
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
     
   <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit ACL</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content"> 
    <form action="<?php echo site_url('general_store/edit_action_acl/' . $id); ?>" onsubmit="javascript: return validateAcl()" method="post">


    <!--form area3-->
    <!--form area4-->
    <div class="container sec_3">

        <table class="table table-bordered">

            <tr> <td>Employee Id</td>
                <td><select  id="employee_id" class="e1 form-control" name="employeeId">
                        <option value="0" class="form-control">Select Employee</option>
                        <?php foreach ($allemployees as $employee) { ?>
                            <option <?php if ($employee['id'] == $user[0]['employeeId']) echo 'selected="selected"'; ?>  value="<?php echo $employee['id']; ?>"><?php echo $employee['name']."(".$employee['designation_name'].")"; ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td class="form_section1t">Email :</td>
                <td class="form_n"> <input type="email" value="<?php echo $user[0]['email']; ?>" class="form-control" name="email" id="email" value=""></td>

            </tr>
            <tr>
                <td>User Name :</td>
                <td><input class="form-control" value="<?php echo $user[0]['username']; ?>" type="text" id="username" name="username"/></td>
                <td>User Type :</td>
                <td>
                    <select class="form-control e1" id="userType" name="userType">
                        <option class="form-control" value="0">Select User Type</option>
                        <option <?php if ($user[0]['user_type'] == '1') echo 'selected="selected"'; ?> class="form-control" value="1">Super Admin</option>
                        <option <?php if ($user[0]['user_type'] == '3') echo 'selected="selected"'; ?> class="form-control" value="3">Admin</option>
                        <option <?php if ($user[0]['user_type'] == '2') echo 'selected="selected"'; ?> class="form-control" value="2">Corporate</option>
                        <option <?php if ($user[0]['user_type'] == '4') echo 'selected="selected"'; ?> class="form-control" value="4">Factory</option>
                        
                    </select>
                </td>
            </tr>
           
           
        </table>

        <div class="col-md-12">
            <table class="table table-bordered text-center">          
                <tr class="active">
                    <td><strong>Setup Role for This User</strong></td>

                </tr>	

            </table>
            <ul class="nav nav-tabs">
                <?php foreach ($menu as $key => $me) { ?>
                    <?php if ($key == 0) { ?>
                        <li class="active"><a class='tab_text' data-toggle="tab" href="#<?php echo clean($me['value']['root_item']); ?>"><?php echo $me['value']['root_item']; ?></a></li>
                    <?php } else { ?>
                        <li><a class="tab_text" data-toggle="tab" href="#<?php echo clean($me['value']['root_item']); ?>"><?php echo $me['value']['root_item']; ?></a></li>
                        <?php
                    }
                }
                ?>
            </ul>
            <div class="row">
                <div class="tab-content">
                    <?php
                    $role = unserialize($user[0]['userRole']);
                    $menus = unserialize($user[0]['userMenu']);
                    ?>
                    <?php 
                    foreach ($menu as $key => $me) { 
                        ?>
                        <?php if ($key == 0) { ?>
                            <div id="<?php echo clean($me['value']['root_item']); ?>" class="tab-pane fade in active">
                                <div class='col-md-12 row'><div class="col-md-6"><h3>Show This Menu ? : <input type='checkbox' <?php if(in_array($me['value']['id'],$menus)) echo 'checked="checked"'; ?> value='<?php echo $me['value']['id']; ?>' name='menu[]'/></h3>
                                    </div>
                                </div>
                                <?php if (count($me['subMenu']) > 0) { ?>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Sub Menu</th><?php foreach ($access_type as $type) { ?>

                                                <th> <?php echo $type['access_name']; ?></th>
                                            <?php } ?>
                                        </tr>
                                        <?php foreach ($me['subMenu'] as $sub) { ?>
                                            <tr>
                                                <td><?php echo $sub['item_name']; ?></td>
                                                <?php foreach ($access_type as $type) { ?>

                                                    <td><input class="check_<?php echo $type['type']; ?>" value="<?php echo $type['type']; ?>" type="checkbox" <?php if (isset($role[$me['value']['id']][$sub['id']][$type['type']]) && $role[$me['value']['id']][$sub['id']][$type['type']] == $type['type']) echo 'checked="checked"'; ?> name="role[<?php echo $me['value']['id']; ?>][<?php echo $sub['id']; ?>][<?php echo $type['type']; ?>]"></td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                <?php } ?>
                            </div>
                            <?php } else {
                            ?>
                            <div id="<?php echo clean($me['value']['root_item']); ?>" class="tab-pane">  
                                <div class='col-md-12 row'><div class="col-md-6"><h3>Show This Menu ? : <input <?php if(in_array($me['value']['id'],$menus)) echo 'checked="checked"'; ?> type='checkbox' value='<?php echo $me['value']['id']; ?>' name='menu[]'/></h3>
                                    </div>
                                </div>
                                <?php if (count($me['subMenu']) > 0) { ?>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Sub Menu</th><?php foreach ($access_type as $type) { ?>

                                                <th> <?php echo $type['access_name']; ?></th>
                                            <?php } ?>
                                        </tr>
                                        <?php foreach ($me['subMenu'] as $sub) { ?>
                                            <tr>
                                                <td><?php echo $sub['item_name']; ?></td>
                                                <?php 
                                                
                                                foreach ($access_type as $type) 
                                                    { 
                                                    ?>
                                                            <?php if($type['type']==7|| $type['type']==8 || $type['type']==9 || $type['type']==10){ ?>
                                                                                        <td>
                                                                                                <select id="approver2" class="form-control" name="role[<?php echo $me['value']['id']; ?>][<?php echo $sub['id']; ?>][<?php echo $type['type']; ?>]">
                                                                                                    <option value="0" class="form-control">Select  Approver</option>
                                                                                                    <?php foreach ($allemployees as $employee) { ?>
                                                                                                        <option <?php if (isset($role[$me['value']['id']][$sub['id']][$type['type']]) && $role[$me['value']['id']][$sub['id']][$type['type']] == $employee['id']) echo 'selected'; ?>   value="<?php echo $employee['id']; ?>"><?php echo $employee['name']."(".$employee['designation_name'].")"; ?></option>
                                                                                                    <?php } ?>
                                                                                                </select>
                                                                                        </td>
                                                           <?php }else{ ?>
                                                                     <td><input class="check_<?php echo $type['type']; ?>" value="<?php echo $type['type']; ?>" type="checkbox" <?php if (isset($role[$me['value']['id']][$sub['id']][$type['type']]) && $role[$me['value']['id']][$sub['id']][$type['type']] == $type['type']) echo 'checked="checked"'; ?> name="role[<?php echo $me['value']['id']; ?>][<?php echo $sub['id']; ?>][<?php echo $type['type']; ?>]"></td>
                                                           <?php } ?>  
                                                             
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                <?php } ?>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>    
            </div>

        </div>

    </div>
    <div class="form-group">
                                <div class=" col-sm-2">
                                    <button type="submit" class="btn btn-primary button">Update</button>
                                </div>
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/general_store/acl') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
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
    function validateAcl() {
        if ($('#employee_id').val() == 0) {
            alert('Select any user');
            $('#employee_id').focus();
            return false;
        }
//        if ($('#email').val() == '') {
//            alert('Enter user email');
//            $('#username').focus();
//            return false;
//        }
        if ($('#username').val() == '') {
            alert('Enter user name');
            $('#username').focus();
            return false;
        }
        if ($('#userType').val() == 0) {
            alert('Select user type');
            $('#userType').focus();
            return false;
        }
        if ($('#password').val() == '') {
            alert('Enter password');
            $('#password').focus();
            return false;
        }
        if ($('#reType').val() != $('#password').val()) {
            alert('Password & re type password is not same');
            $('#reType').focus();
            return false;
        }

        if ($('#reType').val() == 0) {
            alert('Enter Retype password');
            $('#reType').focus();
            return false;
        }

//        if ($('#approver1').val() == 0) {
//            alert('Select any approver1');
//            $('#approver1').focus();
//            return false;
//        }
//        if ($('#approver2').val() == 0) {
//            alert('Select any approver2');
//            $('#approver1').focus();
//            return false;
//        }
    }
    $(document).ready(function () {
        $('#employee_id').change(function () {
            $.ajax({
                url: '<?php echo site_url('dashboard/leave/getEmDetails'); ?>',
                data: 'emId=' + $(this).val(),
                method: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data.msg == 'success') {
                        $('#email').val(data.employee.email);
                    } else {
                        alert('Not Found Employee Details');
                    }
                }
            });
        });

    });
    $("input[class*='check_']").click(function () {
        if ($(this).is(':checked') == true){
            if ($(this).val() == 6) {
//                $(this).parents('tr').find('.check_1').prop('checked', false)
//                $(this).parents('tr').find('.check_2').prop('checked', false)
//                $(this).parents('tr').find('.check_3').prop('checked', false)
//                $(this).parents('tr').find('.check_4').prop('checked', false)
//                $(this).parents('tr').find('.check_5').prop('checked', false)
//                $(this).parents('tr').find('.check_7').prop('checked', false)
//                $(this).parents('tr').find('.check_8').prop('checked', false)
            }else if ($(this).val() == 1 || $(this).val() == 7 || $(this).val() == 8){
                $(this).parents('tr').find('.check_2').prop('checked', true)
                $(this).parents('tr').find('.check_3').prop('checked', true)
                $(this).parents('tr').find('.check_4').prop('checked', true)
                $(this).parents('tr').find('.check_5').prop('checked', true)
            }
        }

    })
</script>
