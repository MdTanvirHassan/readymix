
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
<div class="os-tabs-w menu-shad">
        <?php require_once(__DIR__ .'/../../trading_challan_header.php'); ?>
    </div>

<div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Details Ship</h3>
            </div>
        </div>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
          
            <form class="form-horizontal" method="post" action="<?php echo site_url('ships/edit_truck_action/'.$truck_info[0]['truck_id']) ?>">
                
                   
                
                        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                   Ship No.:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                        
                                         <b> <?php if(!empty($truck_info[0]['truck_no'])) echo $truck_info[0]['truck_no']; ?></b>

                               </div>
                               <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                   License No.:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                       
                                         <b> <?php if(!empty($truck_info[0]['license_no'])) echo $truck_info[0]['license_no']; ?></b>

                               </div>
                             
                         </div>
                
                        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                   Insurance No.:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         
                                         <b><?php if(!empty($truck_info[0]['insurance_no'])) echo $truck_info[0]['insurance_no']; ?></b>

                               </div>
                               <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                   Tax Token No.:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                        
                                         <b> <?php if(!empty($truck_info[0]['tax_token'])) echo $truck_info[0]['tax_token']; ?></b>

                               </div>
                             
                        </div>
                        
                         <div class='form-group' >
                               <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                   Road Permit:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         <b><?php if($truck_info[0]['road_permit']) echo $truck_info[0]['road_permit']; ?> </b>
                                            
                                       

                               </div>
                               
                             
                        </div>
             
                
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-2">
                         <a href="<?php echo site_url('backend/raw_materials/ships/') ?>" ><button type="button" class="btn btn-success button">GO BACK</button> </a>          
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

<script>
    
    
</script>