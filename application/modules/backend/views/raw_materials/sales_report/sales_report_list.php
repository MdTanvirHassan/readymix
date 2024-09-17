<script type="text/javascript" src="js/common/jquery-ui.js"></script>
<style>
    .datatable-scroll {
        overflow-x: auto;
        overflow-y: visible;
    }
</style>
<?php
$employee_id = $this->session->userdata('employeeId');
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');

?>
<div class="right_col" role="main">
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
                                        <table id="player_table" class=" table table-striped datatable-scroll table-bordered  responsive">
                                            <thead>

                                                <tr>
                                                    <th style="width:90px;">Report No</th>
                                                    <th>Report Name</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                

                                                


                                                


                                                <?php
                                                //$this->role = checkUserPermission(16, 84, $userData);
                                                //if (!in_array(11, $this->role)) {
                                                ?>

                                                    <tr>
                                                        <td>1</td>
                                                        <td><a href="<?php echo site_url(); ?>raw_materials/sales_report/doBalanceReport">Delivery Orders (Balance) Report</a></td>
                                                    </tr>
                                                <?php //} ?>


                                               

                                                <?php
                                                //$this->role = checkUserPermission(16, 86, $userData);
                                               // if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>2</td>
                                                        <td><a href="<?php echo site_url(); ?>raw_materials/sales_report/allDeliveryChallan">Delivery Challans</a></td>
                                                    </tr>

                                                <?php //} ?>

                                               <?php
                                                //$this->role = checkUserPermission(16, 86, $userData);
                                               // if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>3</td>
                                                        <td><a href="<?php echo site_url(); ?>raw_materials/sales_report/lcBalanceReport">Lc Balance Report</a></td>
                                                    </tr>

                                                <?php //} ?>     
                                                  
                                                 <?php
                                                //$this->role = checkUserPermission(16, 86, $userData);
                                               // if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>4</td>
                                                        <td><a href="<?php echo site_url(); ?>raw_materials/sales_report/salesMisReport">Sales Mis Report</a></td>
                                                    </tr>

                                                <?php //} ?>       
                                                    
                                                    
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