<script type="text/javascript" src="js/common/jquery-ui.js"></script>
<style>
    .datatable-scroll {
        overflow-x: auto;
        overflow-y: visible;
    }
</style>
<div class="right_col" role="main" >
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Report Module</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title clearfix">
                                        All reports
                                    </h4>
                                </div>

                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

                                    <div class="panel-body">
                                        <!--                <div class="pull-right"><button class="btn btn-danger" id="delete">Delete Selected</button></div>-->
                                        <table id="player_table" class=" table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                                            <thead>

                                                <tr>
                                                    <th style="width:90px;">Report No</th>
                                                    <th>Report Name</th>
                                                    <th>Get Excel</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>1</td>
                                                    <td><a href="<?php echo site_url(); ?>report/evaluationReport">Evaluation Report</a></td> 
                                                    <td><a  href="<?php echo site_url(); ?>report/evaluationReportExcell"><img style="width:40px;cursor:pointer;" src="<?php echo site_url('images/excel.png'); ?>"/></a></td>
                                                </tr> 

                                                 <tr>
                                                    <td>2</td>
                                                    <td><a href="<?php echo site_url(); ?>report/doctorReport">Doctor Territory Report</a></td>
                                                    <td><a  href="<?php echo site_url(); ?>report/doctorReportExcell"><img style="width:40px;cursor:pointer;" src="<?php echo site_url('images/excel.png'); ?>"/></a></td>
                                                </tr> 
                                                
                                                 <tr>
                                                    <td>3</td>
                                                    <td><a href="<?php echo site_url(); ?>report/instituteReport">Institution Report</a></td>
                                                    <td><a  href="<?php echo site_url(); ?>report/instituteReportExcell"><img style="width:40px;cursor:pointer;" src="<?php echo site_url('images/excel.png'); ?>"/></a></td>
                                                </tr> 
                                                
                                                <tr>
                                                    <td>4</td>
                                                    <td><a href="<?php echo site_url(); ?>report/rawdataExport">Precessed Data</a></td>
                                                    <td><a  href="<?php echo site_url(); ?>report/instituteReportExcell"><img style="width:40px;cursor:pointer;" src="<?php echo site_url('images/excel.png'); ?>"/></a></td>
                                                </tr> 
                                          <!--      
                                                 <tr>
                                                    <td>5</td>
                                                    <td><a href="<?php echo site_url(); ?>report/unprocessedRawdataExport">Unprocessed Raw Data</a></td>
                                                    <td><a  href="<?php echo site_url(); ?>report/instituteReportExcell"><img style="width:40px;cursor:pointer;" src="<?php echo site_url('images/excel.png'); ?>"/></a></td>
                                                </tr> 

                                             -->   
                                            </tbody>


                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

