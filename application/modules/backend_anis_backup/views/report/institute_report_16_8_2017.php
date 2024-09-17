<div class="right_col" role="main" >
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Institution Report</h3>
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
                                <form action="<?php site_url('report/instituteReport'); ?>" method="post"/>
                                <div class="col-md-12">
                                    <div class="col-md-4"><lable>Sales Line</label></div>
                                    <div class="col-md-8">

                                        <select required class="form-control" name="salesline" id="salesline">
                                            <?php foreach ($sales_line as $line) { ?>
                                                <option class="form-control" <?php if ($line['sl_id'] == $salesline) echo 'selected="selected"'; ?> value="<?php echo $line['sl_id']; ?>"><?php echo $line['sl_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <div class="col-md-4"><lable>Select Institution</label></div>
                                    <div class="col-md-8">

                                        <select required class="form-control" name="institute" id="salesline">
                                            <option <?php if(!empty($inst_info) && $inst_info=='all')echo 'selected'; ?> value="all">All</option>
                                            <option <?php if(!empty($inst_info) && $inst_info=='major')echo 'selected'; ?> value="major">Major</option>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                
                                 <div class="col-md-12" style="margin-top: 10px;">
                                    <div class="col-md-4"><lable>Region</label></div>
                                    <div class="col-md-8">

                                        <select  class="form-control selectpicker" name="region" id="region">
                                            <option class="form-controll" value="">Select Region</option>
                                            <?php foreach ($regions as $line) { ?>
                                            
                                                <option class="form-control" <?php if ($line['t_region'] == $region) echo 'selected="selected"'; ?> value="<?php echo $line['t_region']; ?>"><?php echo $line['t_region']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                 <div class="col-md-12" style="margin-top: 10px;" >
                                    <div class="col-md-4"><lable>Team</label></div>
                                    <div class="col-md-8">

                                        <select  class="form-control selectpicker" name="team" id="team">
                                            <option class="form-controll" value="">Select Team</option>
                                             <?php foreach ($teams as $line) { ?>
                                            
                                                <option class="form-control" <?php if ($line['t_team'] == $team) echo 'selected="selected"'; ?> value="<?php echo $line['t_team']; ?>"><?php echo $line['t_team']; ?></option>
                                            <?php } ?>
                                           
                                        </select>
                                    </div>
                                </div>
                                
                                
                                
                                 <div class="col-md-12" style="margin-top: 10px;">
                                    <div class="col-md-4"><lable>Territory</label></div>
                                    <div class="col-md-8">

                                        <select  class="form-control selectpicker" name="territory" id="territory">
                                       
                                            <option class="form-controll" value="">Select Territory</option>
                                             <?php foreach ($territories as $line) { ?>
                                            
                                                <option class="form-control" <?php if ($line['t_territory'] == $territory) echo 'selected="selected"'; ?> value="<?php echo $line['t_territory']; ?>"><?php echo $line['t_territory']; ?></option>
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
                                <div style="margin-top: 10px; display: <?php if (!in_array($rType, array('quarterly', 'monthly', 'yearly', 'range'))) echo 'none'; ?>" id="typeHtml" class="col-md-12">
                                    <div class="col-md-4"><lable id="typeLabel"><?php
                                            if ($rType == 'yearly')
                                                echo "Year";else if ($rType == 'quarterly')
                                                echo "Select Year";else if ($rType == 'monthly')
                                                echo "Month";else if ($rType == 'range')
                                                echo "Range";
                                            else
                                                echo "Month"
                                                ?></label></div>
                                    <div class="col-md-8">
                                        <input style="display: <?php if (!in_array($rType, array('quarterly', 'yearly'))) echo 'none'; ?>" type="text" id="year" name="year" class="form-control yearpicker" value="<?php if (!empty($year)) echo $year; ?>" placeholder="Select Year"/>
                                        <input style="display: <?php if ($rType != 'monthly') echo 'none'; ?>" type="text" id="month" name="month" class="form-control monthpicker" value="<?php if (!empty($month)) echo $month; ?>" placeholder="Select Month"/>
                                        <input style="display: none" type="text" id="fromDate" name="fromDate" class="form-control monthpicker" placeholder="Select Start Month"/><br>
                                        <input style="display: none" type="text" id="toDate" name="toDate" class="form-control monthpicker" placeholder="Select End Month"/>
                                        <select style="display: <?php if ($rType != 'quarterly') echo 'none'; ?>"  id="quarter" class="form-control" name="quarter">
                                            <option class="form-control" value="0">Select  Quarter</option>
                                            <option class="form-control" <?php if ($quarter == 'q1') echo 'selected="selected"'; ?> value="q1">Quarter 1</option>
                                            <option class="form-control" <?php if ($quarter == 'q2') echo 'selected="selected"'; ?> value="q2">Quarter 2</option>
                                            <option class="form-control" <?php if ($quarter == 'q3') echo 'selected="selected"'; ?> value="q3">Quarter 3</option>
                                            <option class="form-control" <?php if ($quarter == 'q4') echo 'selected="selected"'; ?> value="q4">Quarter 4</option>

                                        </select>
                                    </div>
                                </div>
                                <div style="margin-top: 10px;display:<?php if (in_array($rType, array('quarterly', 'monthly', 'yearly', 'range'))) echo 'none'; ?>" class="col-md-12" id="cycle">
                                    <div class="col-md-4"><lable>Cycle</label></div>
                                    <div class="col-md-8">

                                        <select  class="form-control" name="cycle">
                                            <option class="form-control"  value="0">Select Cycle</option>
                                            <option class="form-control" <?php if ($cycle == 'C1') echo 'selected="selected"'; ?> value="C1">Cycle 1</option>
                                            <option class="form-control" <?php if ($cycle == 'C2') echo 'selected="selected"'; ?> value="C2">Cycle 2</option>
                                            <option class="form-control" <?php if ($cycle == 'C3') echo 'selected="selected"'; ?> value="C3">Cycle 3</option>
                                            <option class="form-control" <?php if ($cycle == 'C4') echo 'selected="selected"'; ?> value="C4">Cycle 4</option>

                                        </select>
                                    </div>
                                </div>
                                <div style="margin-top: 10px;display:<?php if (in_array($rType, array('quarterly', 'monthly', 'yearly', 'range'))) echo 'none'; ?>" class="col-md-12" id="mainDate">
                                    <div class="col-md-4"><lable>Month</label></div>
                                    <div class="col-md-8">
                                        <input type="text"  class="form-control monthpicker" value="<?php echo $month; ?>" name="monthh" placeholder="Select any month">
                                    </div>
                                </div>

                            </div>

                            <div class="clearfix"></div>
                            <div style="margin-top: 15px;" class="col-md-12">

                                <div class="col-md-8 col-md-offset-5">
                                    <input style="padding: 6px 40px;" type="submit" class="btn btn-primary" name="submit" value="Search"/>
                                    <input style="padding: 6px 40px;" type="submit" name="submit" class="btn btn-primary" value="Excel"/>
                                    <input style="padding: 6px 40px;" type="button" id="print_div" class="btn btn-primary" value="Print"/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>


                    <!--                <div class="pull-right"><button class="btn btn-danger" id="delete">Delete Selected</button></div>-->
                    <?php if(!empty($institutes)){ ?>
                    <table id="player_table" class=" table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                        <thead>

                            <tr>
                                <th style="background: #95B3D7;vertical-align:middle" rowspan="2">Institute Name</th>
                                 <th style="background: #95B3D7;vertical-align:middle" rowspan="2">Address</th>
                                 <th style="background: #95B3D7;vertical-align:middle" rowspan="2">Region</th>
                                 <th style="background: #95B3D7;vertical-align:middle" rowspan="2">Team</th>
                                 <th style="background: #95B3D7;vertical-align:middle" rowspan="2">Territory</th>
                                 <th style="background: #95B3D7;vertical-align:middle" rowspan="2">Brick</th>
                                 <?php foreach ($month_array as $c=>$month_a) { ?>
                                    <th style="background: #95B3D7;" colspan="3"><?php echo $month_a; ?></th>
                                <?php } ?>
                                
                            </tr>
                            <tr class="transform">
                               <?php foreach ($month_array as $c=>$month_a) { ?>
                                    
                                    <th style="background: #95B3D7;" >SANOFI</th>
                                    <th style="background: #95B3D7;" >TOTAL</th>
                                    <th style="background: #95B3D7;" >Rx Share</th>
                                <?php } ?>

                            </tr>
                        </thead>
                        <tbody>
                           <?php $alltotal=array();
                               foreach($month_array as $p=>$month){
                                   $alltotal[$month]['sanofi_total']=0;
                                   $alltotal[$month]['total_total']=0;
                                   $alltotal[$month]['share_total']=0;
                                   
                               }
                           
                           foreach($institutes as $institute){ 
                               ?>
                            <tr>
                                    <td><?php echo $institute['inst_shop_name']  ?></td>
                                     <td><?php echo $institute['inst_address']  ?></td>
                                     <td><?php echo $institute['int_region']  ?></td>
                                     <td><?php echo $institute['int_team']  ?></td>
                                     <td><?php echo $institute['t_territory']  ?></td>
                                     <td><?php echo $institute['inst_brick']  ?></td>
                                     <?php foreach ($month_array as $c=>$month_a) {
                                         $alltotal[$month_a]['sanofi_total']=$alltotal[$month_a]['sanofi_total']+$institute[$month_a]['sanofi'];
                                         $alltotal[$month_a]['total_total']=$alltotal[$month_a]['total_total']+$institute[$month_a]['total'];
                                         $alltotal[$month_a]['share_total']=$alltotal[$month_a]['share_total']+$institute[$month_a]['share'];
                                         ?>
                                     <td><?php echo $institute[$month_a]['sanofi']; ?></td>
                                     <td><?php echo $institute[$month_a]['total']; ?></td>
                                     <td><?php echo round($institute[$month_a]['share'],2); ?>%</td>
                                     <?php } ?>
                            <tr>
                           <?php } ?>
                            <tr>
                                <td colspan="6">Total</td>
                                <?php foreach ($month_array as $c=>$month_a) { ?>
                                <td><?php echo $alltotal[$month_a]['sanofi_total'];  ?></td>
                                <td><?php echo $alltotal[$month_a]['total_total'];  ?></td>
                                <td><?php echo round($alltotal[$month_a]['share_total'],2);  ?>%</td>
                                <?php } ?>
                            </tr>
                        </tbody>


                    </table>
                    <?php } ?>
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
            
            
            
            $('#salesline').change(function(){
                var salesline = $('#salesline').val();
                  if(salesline!=""){
                    $.ajax({
                     type: "POST",
                     url: "backend/report/get_salesline_info",
                     data: "salesline=" + salesline,
                     dataType: "json",
                     success: function (data) {
                     
                        var str = '<option value="0">Select Region</option>';
                         $(data.regions).each(function (i, v) {   
                             str += '<option value="' + v.t_region + '">' + v.t_region + '</option>';   
                         });
                         $('#region').html(str);
                         
                         
//                         var strt = '<option value="0">Select Team</option>';
//                         $(data.teams).each(function (i, v) {
//                             strt += '<option value="' + v.t_team + '">' + v.t_team + '</option>';   
//                         });
//                         $('#team').html(strt);
                         
//                         var strtt = '<option value="0">Select Territory</option>';
//                         $(data.territories).each(function (i, v) {
//                             strtt += '<option value="' + v.t_territory + '">' + v.t_territory + '</option>';   
//                         });
//                         $('#territory').html(strtt);
                         
                        
                         $('.selectpicker').selectpicker('refresh');
                         
                         
                     }
                 })
               }
            });
            
            
            
            
            $('#region').change(function(){
                var region=$('#region').val();
                if(region!=""){
                    $.ajax({
                        type:"POST",
                        url:"backend/report/get_team_info",
                        data:"region="+region,
                        dataType:"json",
                        success:function(data){
                            var strt = '<option value="0">Select Team</option>';
                            $(data.teams).each(function (i, v) {
                                strt += '<option value="' + v.t_team + '">' + v.t_team + '</option>';   
                            });
                            $('#team').html(strt);
                            $('.selectpicker').selectpicker('refresh');
                       }
                    })
                }
            });
            
            
            
            
             $('#team').change(function(){
                var team=$('#team').val();
                if(team!=""){
                    $.ajax({
                        type:"POST",
                        url:"backend/report/get_territory_info",
                        data:"team="+team,
                        dataType:"json",
                        success:function(data){
                            var strtt = '<option value="0">Select Territory</option>';
                            $(data.territories).each(function (i, v) {
                                strtt += '<option value="' + v.t_territory + '">' + v.t_territory + '</option>';   
                            });
                           $('#territory').html(strtt);
                            $('.selectpicker').selectpicker('refresh');
                       }
                    })
                }
            }); 
            
            
            
            
            
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
                        $('#cycle').hide(); //added by alauddin
                        break;
                    case 'quarterly' :
                        $('#mainDate').hide();
//                        $('#typeLabel').html('Select quarter');
//                        $('#year').hide();
                        $('#typeLabel').html('Select Year'); //added by alauddin
                        $('#year').show();
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

