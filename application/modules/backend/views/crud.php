


<?php foreach ($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach ($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<!-- page content -->
<style>
    .dataTables_paginate,.paging_full_numbers{
        width: 45% !important;
    }
</style>
<div class="right_col" role="main" >
    <div class="">
<!--        <div class="page-title">
            <div class="title_center">
                <h3><?php echo $title; ?>
               
                </h3>

            </div>


        </div>-->

        <div class="row">
            <div class="x_panel m_panel">
    
                <div class="clearfix"></div>
                <?php echo $output; ?>

            </div>

        </div>


    </div>
</div>
<script>
    $('#field-bg_duration').blur(function () {
        var d = $('#field-t_date').val().split('/');
        var date = new Date(d[2],(d[1]-1),d[0]);
        date.setDate(date.getDate() + Number($(this).val()));
        var dateMsg = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
        $('#field-bg_expire').val(dateMsg)
    })
    $('#field-t_duration').blur(function () {
        var d = $('#field-t_date').val().split('/');
        var date = new Date(d[2],(d[1]-1),d[0]);
        date.setDate(date.getDate() + Number($(this).val()));
        var dateMsg = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
        $('#field-t_last_submission').val(dateMsg)
    })
    
    $('#field-s_duration').blur(function () {
        var d = $('#field-s_date').val().split('/');
        var date = new Date(d[2],(d[1]-1),d[0]);
        date.setDate(date.getDate() + Number($(this).val()));
        var dateMsg = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
        $('#field-s_expire').val(dateMsg)
    })
    $('#field-ag_duration').blur(function () {
        var d = $('#field-ag_date').val().split('/');
        var date = new Date(d[2],(d[1]-1),d[0]);
        date.setDate(date.getDate() + Number($(this).val()));
        var dateMsg = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
        $('#field-ag_completion_date').val(dateMsg)
    })
    $('#field-w_duration').blur(function () {
        var d = $('#field-w_date').val().split('/');
        var date = new Date(d[2],(d[1]-1),d[0]);
        date.setDate(date.getDate() + Number($(this).val()));
        var dateMsg = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
        $('#field-w_competion_date').val(dateMsg)
    })
    $('#field-noa_id').change(function () {
        $.ajax({
            type: "POST",
            url: "backend/ongoing/get_noa_value",
            data: 'id=' + $(this).val(),
            dataType: "json",
            success: function (data) {
                if (data.msg == 'success') {
                    var module = '<?php echo $this->sub_menu ?>';
                    if (module == 'security_details') {
                        $('#field-s_value').val(data.value);
                    }
                    if (module == 'agreement_details') {
                        $('#field-ag_value').val(data.value);
                    }
                    if (module == 'work_order') {
                        $('#field-w_value').val(data.value);
                    }
                    if (module == 'assigned_bank') {
                        $('#field-ab_value').val(data.value);
                    }
                    if (module == 'loan_details') {
                        $('#field-l_value').val(data.value);
                    }
                }
            }
        })
    })



$('#field-bank_id').change(function () {
        $.ajax({
            type: "POST",
            url: "backend/ongoing/get_ab_account",
            data: 'id=' + $(this).val(),
            dataType: "json",
            success: function (data) {
                if (data.msg == 'success') {
                    $('#field-ab_ac_no').val(data.value);
                    }
            }
        })
    })
</script>

<!-- /page content -->



