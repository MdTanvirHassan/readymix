<div class="right_col" role="main" >
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Export Unprocessed Raw Data</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <style>
                            th{text-align: center;}
                            .datatable-scroll {
                                overflow-x: auto;
                                overflow-y: visible;
                            }
                            .usetwentyfour{
                                z-index:10000;
                            }
                            .absent{
                                float: right;
                                height: 38px;
                                line-height: 4;
                                margin: -5px 0 0;
                                position: relative;
                                text-align: center;
                                width: 100%;
                            }
                            .present{
                                float: right;
                                height: 38px;
                                line-height: 4;
                                margin: -5px 0 0;
                                position: relative;
                                text-align: center;
                                width: 100%;
                            }
                            #test {
                                position:relative;
                            }
                            .address_bar{
                                background-color: #c7caca;
                                border: 2px solid #000000;
                                border-radius: 5px;
                                margin: 10px 0;
                                padding: 10px;
                                text-align: center;
                            }
                            @media print {
                                .non-printable, .fancybox-outer { display: none; }
                                .printable, #printDiv { 
                                    display: block; 
                                    font-size: 26pt;
                                }
                            }
                            /*                            .transform th{
                                                            transform: rotate(90deg);
                                                            transform-origin: left top 0;
                                                        }*/

                        </style>

                        <div class="row">
                            <div id="remover" class="col-md-6 col-md-offset-3">
                                <form action="<?php site_url('report/unprocessedRawdataExport'); ?>" method="post"/>
                                <div class="col-md-12">
                                  
                                    <div class="col-md-4"><lable>Molecule</label></div>
                                    <div class="col-md-8">

                                        <select required class="form-control" name="molecule">
                                            <option class="form-control" value="0">Select Molecule</option>
                                            <?php foreach ($molecules as $molecule) { ?>
                                                <option class="form-control" <?php if ($mole_cule == $molecule) echo 'selected="selected"'; ?> value="<?php echo $molecule['mol_name']; ?>"><?php echo $molecule['mol_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                   
                                </div>
                                <div style="margin-top: 10px;" class="col-md-12">
                                    <div class="col-md-4"><lable>Report Type</label></div>
                                    <div class="col-md-8">

                                        <select required class="form-control" id="changeType" onchange="changeType()" name="rType">
                                            <option class="form-control" <?php if ($rType == 'general') echo 'selected="selected"'; ?> value="general">Cycle</option>
                                            <option class="form-control" <?php if ($rType == 'monthly') echo 'selected="selected"'; ?> value="monthly">Monthly</option>
                                            <option class="form-control" <?php if ($rType == 'quarterly') echo 'selected="selected"'; ?> value="quarterly">Quarterly</option>
                                            <option class="form-control" <?php if ($rType == 'yearly') echo 'selected="selected"'; ?> value="yearly">Yearly</option>
                                            <option class="form-control" <?php if ($rType == 'range') echo 'selected="selected"'; ?> value="range">Range</option>


                                        </select>
                                    </div>
                                </div>
                                <div style="margin-top: 10px; display: none;" id="typeHtml" class="col-md-12">
                                    <div class="col-md-4"><lable id="typeLabel">Month</label></div>
                                    <div class="col-md-8">
                                        <input style="display: none" type="text" id="year" name="year" class="form-control yearpicker" placeholder="Select Year"/>
                                        <input style="display: none" type="text" id="month" name="month" class="form-control monthpicker" placeholder="Select Month"/>
                                        <input style="display: none" type="text" id="fromDate" name="fromDate" class="form-control monthpicker" placeholder="Select Start Month"/><br>
                                        <input style="display: none" type="text" id="toDate" name="toDate" class="form-control monthpicker" placeholder="Select End Month"/>
                                        <select style="display: none" required id="quarter" class="form-control" name="quarter">
                                         <option class="form-control" value="0">Select Quarter</option>
                                            <option class="form-control" <?php if ($quarter == 'q1') echo 'selected="selected"'; ?> value="q1">Quarter 1</option>
                                            <option class="form-control" <?php if ($quarter == 'q2') echo 'selected="selected"'; ?> value="q2">Quarter 2</option>
                                            <option class="form-control" <?php if ($quarter == 'q3') echo 'selected="selected"'; ?> value="q3">Quarter 3</option>
                                            <option class="form-control" <?php if ($quarter == 'q4') echo 'selected="selected"'; ?> value="q4">Quarter 4</option>

                                        </select>
                                    </div>
                                </div>
                                <div style="margin-top: 10px;" class="col-md-12" id="cycle">
                                    <div class="col-md-4"><lable>Cycle</label></div>
                                    <div class="col-md-8">

                                        <select required class="form-control" name="cycle">
                                          <option class="form-control" <?php if ($cycle == '0') echo 'selected="selected"'; ?> value="0">Select Cycle</option>
                                            <option class="form-control" <?php if ($cycle == 'C1') echo 'selected="selected"'; ?> value="C1">Cycle 1</option>
                                            <option class="form-control" <?php if ($cycle == 'C2') echo 'selected="selected"'; ?> value="C2">Cycle 2</option>
                                            <option class="form-control" <?php if ($cycle == 'C3') echo 'selected="selected"'; ?> value="C3">Cycle 3</option>
                                            <option class="form-control" <?php if ($cycle == 'C4') echo 'selected="selected"'; ?> value="C4">Cycle 4</option>

                                        </select>
                                    </div>
                                </div>
                                <div style="margin-top: 10px;" class="col-md-12" id="mainDate">
                                    <div class="col-md-4"><lable>Month</label></div>
                                    <div class="col-md-8">
                                        <input type="text" required class="form-control monthpicker" value="<?php echo $month; ?>" name="monthh" placeholder="Select any month">
                                    </div>
                                </div>

                            </div>

                            <div class="clearfix"></div>
                            <div style="margin-top: 15px;" class="col-md-12">

                                <div class="col-md-8 col-md-offset-5">
                                    
                                    <input style="padding: 6px 40px;" type="submit" name="submit" class="btn btn-primary" value="Excel"/>
                                    <input style="padding: 6px 40px;" type="button" id="print_div" class="btn btn-primary" value="Print"/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>


                    <!--                <div class="pull-right"><button class="btn btn-danger" id="delete">Delete Selected</button></div>-->
                   
                    <style type="text/css" media="print">

                        @media print {
                            .non-printable, .fancybox-outer { display: none; }
                            .printable, #printDiv { 
                                display: block; 
                                font-size: 26pt;
                            }
                            #player_table {page-break-after: avoid;}
                        }

                        @media print {
                            #player_table {page-break-after: avoid;display:block;visibility:visible; height:100%;}
                            body, html, #wrapper {
                                margin-top:0%;
                                display:block;
                                height:100%;
                                visibility:visible;
                            }
                        }
                    </style>
                </div>
            </div>


        </div>
        <script type="text/javascript">
            // function changeType() {
            $('#changeType').change(function () {
                var type = $('#changeType').val();
                switch (type) {
                    default :
                    case 'general' :
                        $('#mainDate').show();
                        $('#typeHtml').hide();
                        $('#cycle').show(); //added by alauddin
                        break;
                    case 'range' :
                        $('#typeLabel').html('Select Range');
                        $('#year').hide();
                        $('#quarter').hide();
                        $('#mainDate').hide();
                        $('#fromDate').show();
                        $('#toDate').show();
                        $('#typeHtml').show();
                        $('#cycle').hide(); //added by alauddin
                        break;
                    case 'monthly' :
                        $('#typeLabel').html('Select Month');
                        $('#year').hide();
                        $('#mainDate').hide();
                        $('#quarter').hide();
                        $('#month').show();
                         $('#fromDate').hide();
                        $('#toDate').hide();
                        $('#typeHtml').show();
                        $('#cycle').show(); //added by alauddin
                        break;
                    case 'quarterly' :
                        $('#mainDate').hide();
                        $('#typeLabel').html('Select quarter');
                        $('#year').hide();
                        $('#quarter').show();
                        $('#month').hide();
                        $('#fromDate').hide();
                        $('#toDate').hide();
                        $('#typeHtml').show();
                        $('#cycle').hide(); //added by alauddin
                        break;
                    case 'yearly' :
                        $('#mainDate').hide();
                        $('#typeLabel').html('Select Year');
                        $('#year').show();
                        $('#quarter').hide();
                        $('#month').hide();
                         $('#fromDate').hide();
                        $('#toDate').hide();
                        $('#typeHtml').show();
                        $('#cycle').hide(); //added by alauddin
                        break;
                }
            })

            //   }
            $(document).ready(function () {
                $('select.e1').select2();
            });
            $('#print_div').click(function () {
                $('#remover').hide();
                var heada = document.getElementsByTagName('head')[0].innerHTML;
                document.getElementsByTagName('head')[0].remove();
                $('#header_div').attr('style', 'text-align:center;');
                $('#header_div').find('h4').attr('style', 'padding-left:15%');
                var headstr = "<html><head><title></title></head><body>";
                var footstr = "</body></html>";
                $('body').css('font-size', '12px');
                var newstr = $('#collapseOne').html();
                var oldstr = document.body.innerHTML;
                document.body.innerHTML = headstr + newstr + footstr;
                window.print();
                document.body.innerHTML = heada + oldstr;
                $('#header_div').find('h4').attr('style', 'padding-left:0%');
                $('#remover').show();
            });
            function submitForm() {
                var col_number = $('#test ul  input').map(function () {
                    if (this.checked) {
                        return this.id;
                    }
                }).get().join();
                $('#index').val(col_number);
                var url = '<?php echo site_url(); ?>report/attendanceReport/allAttendance/true';
                $('#empoyee-form').attr('action', url);
                $('#form-submit').click();
                $('#empoyee-form').attr('action', '<?php echo site_url('report/attendanceReport/allAttendance'); ?>');
            }

            function submitExcelForm() {
                var col_number = $('#test ul  input').map(function () {
                    if (this.checked) {
                        return this.id;
                    }
                }).get().join();
                $('#index').val(col_number);
                var url = '<?php echo site_url(); ?>report/attendanceReport/allattendanceExcell';
                $('#empoyee-form').attr('action', url);
                $('#form-submit').click();
                $('#empoyee-form').attr('action', '<?php echo site_url('report/attendanceReport/allAttendance'); ?>');
            }

            $('#test ul li').click(function () {

                var showHeaders = $('#test ul  input').map(function () {
                    return this.checked;
                });

                $.each(showHeaders, function (i, show) {
                    var cssIndex = i + 1;
                    var tags = $('#player_table th:nth-child(' + cssIndex + '), #player_table td:nth-child(' + cssIndex + ')');
                    if (show)
                        tags.show();
                    else
                        tags.hide();
                });
                $('#test').find('.dropdown-menu').attr('style', 'display:block;margin-top:13px;margin-left:0px');

            });

            $('#test button').click(function () {
                if ($('#test').attr('class') == 'asd') {
                    $('#test').find('.dropdown-menu').attr('style', 'display:none;margin-top:13px;margin-left:0px');
                    $('#test').removeClass('asd');
                } else {
                    $('#test').find('.dropdown-menu').attr('style', 'display:block;margin-top:13px;margin-left:0px');
                    $('#test').addClass('asd');
                }
            })

        </script>