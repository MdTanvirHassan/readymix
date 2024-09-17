<head>     
    <title><?php echo $this->data['title']; ?></title>
    <base href="<?php echo base_url(); ?>" />
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--    outside css-->


<!--     <script type="text/javascript" src="js/common/FormValidation.js"></script>-->

    <script type="text/javascript">
        var site_url = "<?php echo site_url(); ?>";

    </script>

    <link href="<?php echo site_url(); ?>css/datatable/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo site_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo site_url(); ?>vendors/bootstrap/dist/css/bootstrap-select.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo site_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo site_url(); ?>vendors/bootstrap-datepikar/css/bootstrap-datetimepicker.css" rel="stylesheet">
    
 

    <!-- Custom Theme Style -->
<!--    <link href="<?php echo site_url(); ?>css/style_new.css" rel="stylesheet"> -->
    <link href="<?php echo site_url(); ?>css/custom.min.css" rel="stylesheet"> 
    <link href="<?php echo site_url(); ?>css/custom-style.css" rel="stylesheet"> 
    
    <!-- Added by Alauddin-->
     <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>css/select2.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>css/select2-bootstrap.css"/>
     <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>css/chosen.css"/>
    <!-- End Added by alauddin-->
    
    <!-- custom uploader add by jubayer-->
<link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>css/select2-bootstrap.css"/>

<!-- custom uploader add by jubayer-->
<link href="<?php echo site_url('assets/custom_uploader/knockout-file-bindings.css'); ?>" rel="stylesheet">
<!-- custom uploader add by jubayer-->

        <link href="<?php echo site_url('assets/custom-scrollbar/jquery.mCustomScrollbar.css'); ?>" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo site_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo site_url(); ?>js/common/jquery-ui.js"></script>
    <script src="<?php echo site_url(); ?>js/jquery_migrate.js"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo site_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo site_url(); ?>vendors/bootstrap/bootbox.min.js"></script>
    <script src="<?php echo site_url(); ?>vendors/bootstrap/dist/js/bootstrap-select.js"></script>
    <script src="<?php echo site_url(); ?>vendors/bootstrap-datepikar/js/moment.js"></script>
    <script src="<?php echo site_url(); ?>vendors/bootstrap-datepikar/js/bootstrap-datetimepicker.min.js"></script>

    <!-- FastClick -->
    <script src="<?php echo site_url(); ?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo site_url(); ?>vendors/nprogress/nprogress.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>js/bootbox.js"></script>
<!-- custom uploader add by jubayer-->

<script src='http://cdnjs.cloudflare.com/ajax/libs/knockout/3.1.0/knockout-min.js'></script>
<script type="text/javascript" src="<?php echo site_url('assets/custom_uploader/knockout-file-bindings.js'); ?>"></script>
<!-- custom uploader add by jubayer-->
    <!-- Datatables -->
<!--    <script src="<?php echo site_url(); ?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo site_url(); ?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo site_url(); ?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo site_url(); ?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo site_url(); ?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo site_url(); ?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo site_url(); ?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo site_url(); ?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo site_url(); ?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo site_url(); ?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo site_url(); ?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo site_url(); ?>vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>-->


    <script type="text/javascript" src="<?php echo site_url(); ?>vendors/select2/moment.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>vendors/select2/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>vendors/select2/jquery.chosen.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>vendors/select2/jquery.chosen.config.js"></script>
    
    <!-- Added by alauddin -->
        <link href="css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
    <!-- Added by alauddin -->
    
    
    
      <script type="text/javascript">
       

        var config = {
            '.chosen-select': {},
            '.chosen-select-deselect': {allow_single_deselect: true},
            '.chosen-select-no-single': {disable_search_threshold: 10},
            '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
            '.chosen-select-width': {width: "95%"}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }

    </script>
  

</head>
<style>
    .flash_message {
        background-color: #fff;
        border-bottom: 2px solid #62a60a;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        color: green;
        display: none;
        font-size: 20px;
        height: 35px;
        left: 0;
        line-height: 35px;
        position: fixed;
        text-align: center;
        top: 0;
        width: 100%;
        z-index: 9999;
    }
    
 
    hr {
        border-style:solid;
        border-color:#000000;
    }
    
    .button{
width:100%;
}

.form-group{
    margin-bottom:10px;
}

.dt-buttons{
    margin-right:30px;
}
input.btn-primary{
    background-color:#337ab7 !important;
}

</style>
<div class="flash_message"></div>
<?php
$msg = $this->session->flashdata("msg");
if (!empty($msg)) {
    ?>
    <script type="text/javascript">
            msg = "<?php echo $msg; ?>";
            $('.flash_message').html(msg);
            $('.flash_message').show();
            setTimeout(function () {
                $('.flash_message').hide();
            },10000);
    </script>
<?php } ?>
  