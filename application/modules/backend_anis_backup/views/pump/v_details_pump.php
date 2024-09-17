
<?php
$employee_id = $this->session->userdata('employeeId');
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(2, 8, $userData);
?>
<style>
    table { table-layout: fixed; margin-top: 20px}
    table th, table td { overflow: hidden; }
    .table > thead > tr > th {
        padding: 3px;

    }
    .table > tbody > tr > td{
        padding: 7px;

    }
    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 5px;

    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">


    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Details Pump</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal" method="post" action="<?php echo site_url('pump/edit_pump_action/' . $pumps[0]['pump_id']) ?>">               
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                    Pump No:
                                </label> 
                                <div class="col-sm-2 input-group">
                                    <b> <?php if (!empty($pumps[0]['pump_no'])) echo $pumps[0]['pump_no']; ?></b>
                                </div>
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                    Customer Name:
                                </label> 
                                <div class="col-sm-2 input-group">
                                    <b> <?php if (!empty($pumps[0]['c_short_name'])) echo $pumps[0]['c_short_name']; ?></b>
                                </div>
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                    Project Name:
                                </label> 
                                <div class="col-sm-2 input-group">
                                    <b> <?php if (!empty($pumps[0]['project_name'])) echo $pumps[0]['project_name']; ?></b>
                                </div>
                            </div>
                             <div class='form-group' >                                
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                    Person:
                                </label> 
                                <div class="col-sm-2 input-group">
                                    <b> <?php if (!empty($pumps[0]['person'])) echo $pumps[0]['person']; ?></b>
                                </div>
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                    Person Bill:
                                </label> 
                                <div class="col-sm-2 input-group">
                                    <b> <?php if (!empty($pumps[0]['per_person_bill'])) echo $pumps[0]['per_person_bill']; ?></b>
                                </div>
                                 <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                    Total Bill:
                                </label> 
                                <div class="col-sm-2 input-group">
                                    <b> <?php if (!empty($pumps[0]['total_bill'])) echo $pumps[0]['total_bill']; ?></b>
                                </div>
                            </div>
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                    Date:
                                </label> 
                                <div class="col-sm-2 input-group">
                                    <b> <?php if (!empty($pumps[0]['date'])) echo $pumps[0]['date']; ?></b>
                                </div>
                                
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                    From Time:
                                </label> 
                                <div class="col-sm-2 input-group">
                                    <b> <?php if (!empty($pumps[0]['from_time'])) echo $pumps[0]['from_time']; ?></b>
                                </div>
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                    To Time:
                                </label> 
                                <div class="col-sm-2 input-group">
                                    <b> <?php if (!empty($pumps[0]['to_time'])) echo $pumps[0]['to_time']; ?></b>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 20px">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/pump/') ?>" ><button type="button" class="btn btn-success button">GO BACK</button> </a>          
                                </div>
                            </div>

                            <div class="row">


                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
