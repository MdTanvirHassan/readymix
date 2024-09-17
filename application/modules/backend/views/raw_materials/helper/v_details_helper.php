
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
                <h3>Details Driver</h3>
            </div>
        </div>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
          
            <form class="form-horizontal" method="post" action="<?php echo site_url('helpers/edit_helper_action/'.$helper_info[0]['helper_id']) ?>" onsubmit="javascript: return validation()">
                
                   
                
                        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                    Name.<sup style="color:red;">*</sup>:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         
                                         <b>   <?php if(!empty($helper_info[0]['helper_name'])) echo $helper_info[0]['helper_name']; ?></b>
                                          

                               </div>
                               <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                   Contact No.<sup style="color:red;">*</sup>:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                        
                                         <b><?php if(!empty($helper_info[0]['contact_no'])) echo $helper_info[0]['contact_no']; ?></b>
                                        

                               </div>
                             
                         </div>
                
                        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                   E. Contact No.:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                        
                                         <b> <?php if(!empty($helper_info[0]['emergency_contact_no'])) echo $helper_info[0]['emergency_contact_no']; ?></b>

                               </div>
                               <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                   Present Address:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         
                                         <b> <?php if(!empty($helper_info[0]['present_address'])) echo $helper_info[0]['present_address']; ?></b>

                               </div>
                             
                        </div>
                
                        <div class='form-group' >
                               
                               <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                   Permanent Address:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                        
                                         <b> <?php if(!empty($helper_info[0]['permanent_address'])) echo $helper_info[0]['permanent_address']; ?></b>

                               </div>
                            
                             <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                  License No.:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         
                                         <b>  <?php if(!empty($helper_info[0]['license_no'])) echo $helper_info[0]['license_no']; ?></b>

                               </div>
                             
                        </div>
                        
                         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label" style="margin-top:-7px;">
                                   Blood Group<sup style="color:red;">*</sup>:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                               
                                         <b><?php if($helper_info[0]['blood_group']) echo $helper_info[0]['blood_group'] ?> </b>
                                            

                               </div>
                               
                             
                        </div>
             
                
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/raw_materials/helpers/') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
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
    function validation(){
        var helper_name=$('#helper_name').val();
        var contact_no=$('#contact_no').val();
        
        var error=false;
        
        if(helper_name==''){
            $('#helper_name').css('border','1px solid red');
            $('#helper_name_error').html('Please fill truck no field');
            error=true;
           
        }else{
            $('#helper_name').css('border','1px solid #ccc');
            $('#helper_name_error').html('');
            
        }
        if(contact_no==''){
            $('#contact_no_error').html('Please fill short name field');
            $('#contact_no').css('border','1px solid red');
             error=true;
        }else{
            $('#contact_no_error').html('');
            $('#contact_no').css('border','1px solid #ccc');   
            
        }
        
        if(error==true){
            return false;
        }
        
    }
    
</script>