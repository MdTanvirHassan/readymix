
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
                <h3>Edit Driver</h3>
            </div>
        </div>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
          
            <form class="form-horizontal" method="post" action="<?php echo site_url('raw_materials/helpers/edit_helper_action/'.$helper_info[0]['helper_id']) ?>" onsubmit="javascript: return validation()">
                
                   
                
                        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Name.<sup style="color:red;">*</sup>:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <input class="form-control" id="helper_name" name="helper_name" type="text" value="<?php if(!empty($helper_info[0]['helper_name'])) echo $helper_info[0]['helper_name']; ?>">
                                          <span id="helper_name_error" style="color:red"></span>

                               </div>
                               <label for="title" class="col-sm-2 control-label">
                                   Contact No.<sup style="color:red;">*</sup>:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <input class="form-control" id="contact_no" name="contact_no" type="text" value="<?php if(!empty($helper_info[0]['contact_no'])) echo $helper_info[0]['contact_no']; ?>">
                                         <span id="contact_no_error" style="color:red"></span>

                               </div>
                             
                         </div>
                
                        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                   E. Contact No.:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <input class="form-control" id="emergency_contact_no" name="emergency_contact_no" type="text" value="<?php if(!empty($helper_info[0]['emergency_contact_no'])) echo $helper_info[0]['emergency_contact_no']; ?>">

                               </div>
                               <label for="title" class="col-sm-2 control-label">
                                   Present Address:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <input class="form-control" id="present_address" name="present_address" type="text" value="<?php if(!empty($helper_info[0]['present_address'])) echo $helper_info[0]['present_address']; ?>">

                               </div>
                             
                        </div>
                
                        <div class='form-group' >
                               
                               <label for="title" class="col-sm-2 control-label">
                                   Permanent Address:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <input class="form-control" id="permanent_address" name="permanent_address" type="text" value="<?php if(!empty($helper_info[0]['permanent_address'])) echo $helper_info[0]['permanent_address']; ?>">

                               </div>
                            
                             <label for="title" class="col-sm-2 control-label">
                                  License No.:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <input class="form-control" id="license_no" name="license_no" type="text" value="<?php if(!empty($helper_info[0]['license_no'])) echo $helper_info[0]['license_no']; ?>">

                               </div>
                             
                        </div>
                        
                         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                   Blood Group<sup style="color:red;">*</sup>:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                       
                                         <select class="form-control" id="blood_group" name="blood_group">
                                             <option value="">Select Group</option>
                                             <option <?php if($helper_info[0]['blood_group']=="A+") echo 'selected'; ?> value="A+">A+</option>
                                             <option <?php if($helper_info[0]['blood_group']=="A-") echo 'selected'; ?> value="A-">A-</option>
                                             <option <?php if($helper_info[0]['blood_group']=="B+") echo 'selected'; ?> value="B+">B+</option>
                                             <option <?php if($helper_info[0]['blood_group']=="B-") echo 'selected'; ?> value="B-">B-</option>
                                             <option <?php if($helper_info[0]['blood_group']=="AB+") echo 'selected'; ?> value="AB+">AB+</option>
                                             <option <?php if($helper_info[0]['blood_group']=="AB-") echo 'selected'; ?> value="AB-">AB-</option>
                                             <option <?php if($helper_info[0]['blood_group']=="O+") echo 'selected'; ?> value="O+">O+</option>
                                             <option <?php if($helper_info[0]['blood_group']=="O-") echo 'selected'; ?> value="O-">O-</option>
                                         </select>

                               </div>
                               
                             
                        </div>
             
                
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/raw_materials/helpers/') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
                    
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">UPDATE</button>
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