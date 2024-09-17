<style>
   .common-from table tr td, .common-from table tr th{
        text-align: center;
        vertical-align: middle;
    }
</style>
<?php
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $this->role = checkUserPermission(2, 8, $userData);
              
?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<div class="os-tabs-w menu-shad">
        <?php require_once(__DIR__ .'/../production_header.php'); ?>
    </div>
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3 style="float:left;">Details Gate Pass</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('gate_pass/details_gate_pass/'.$gate_pass[0]['id'].'/true'); ?>" class="btn btn-sm btn-warning">PRINT</a>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        
                        <div class="row">     
                        <table class="table table-bordered" id="myTable">
            <tr>
                <th>Gate Pass No.:</th>
                <td>
                    
                    <?php if(!empty($gate_pass[0]['pass_no'])) echo $gate_pass[0]['pass_no']; ?>
                </td>
                <th>Gate Pass Date</th>
                <td>
                    <?php if(!empty($gate_pass[0]['dc_no'])) echo $gate_pass[0]['dc_no']; ?>
                </td>
                <th>Gate Pass Date</th>
                <td>
                    <?php if(!empty($gate_pass[0]['date'])) echo date('d-m-Y',strtotime($gate_pass[0]['date'])); ?>
                </td>
                
            
            </tr>
            <tr>
                <th style="width:12%;">Address:</th>
                <td>
                 <?php if(!empty($gate_pass[0]['address'])) echo $gate_pass[0]['address']; ?>
                </td>
                <th style="width:12%;">Truck No:</th>
                <td>
                 <?php if(!empty($gate_pass[0]['truck_no'])) echo $gate_pass[0]['truck_no']; ?>
                </td>
                <th style="width:12%;">Driver Name:</th>
                <td>
                 <?php if(!empty($gate_pass[0]['driver_name'])) echo $gate_pass[0]['driver_name']; ?>
                </td>
                
            
            </tr>
            
            <tr>
                <th style="width:12%;">Issue:</th>
                <td>
                    <?php if($gate_pass[0]['issue'] == 1) echo 'YES' ; ?>
                </td>
                <th style="width:12%;">Sale:</th>
                <td>
                    <?php if($gate_pass[0]['sale'] == 1) echo 'YES' ; ?>
                </td>
                <th>No-Return:</th>
                <td>
                    <?php if($gate_pass[0]['non_return'] == 1) echo 'YES' ; ?>
                </td>
                
                
            </tr>
            <tr>
                <th>Return:</th>
                <td>
                    <?php if($gate_pass[0]['return'] == 1) echo 'YES' ; ?>
                </td>
            </tr>
            
            </table>
    <div class="separator-shadow"></div>
    <h2 style="margin-top:40px;" >Details Note</h2>
    <table class="table table-bordered">
        <?php $i=1; foreach ($gate_pass_details as $row){?>
        <tr>
            <th style="width:5%"><?php echo $i; ?></th>
            <td><?php echo $row['note'] ?></td>
        </tr>
        <?php $i++; }?>
    </table>
        
    
                    </div>
     <div class="row">
           
            <div class="col-md-2">
                <a href="<?php echo site_url('backend/gate_pass') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
            </div>
            
           
            
             
        </div> 
            
        
    
</div>
</div>
</div>
</div>
</div>
</div>





