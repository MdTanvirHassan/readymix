
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
<style>
/* The container */
.check_container {
/*  display: block;*/
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  margin-left: 10px;
  cursor: pointer;
  font-size: 17px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.check_container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #dadada;
}

/* On mouse-over, add a grey background color */
.check_container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.check_container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.check_container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.check_container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<div class="os-tabs-w menu-shad">
        <?php require_once(__DIR__ .'/../production_header.php'); ?>
    </div>

<div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Gate Pass</h3>
            </div>
        </div>
<!--            <div class="row">
                 <button style="margin-left:5px" id="button1" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
            </div>-->
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
          
            <form class="form-horizontal" method="post" action="<?php echo site_url('gate_pass/add_gate_pass_action') ?>">
                
                   
                
                        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Gate pass No.<sup style="color:red;">*</sup>:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <input type="hidden" name="pass_sl" value="<?php echo $pass_sl;?>">
                                         <input required="" readonly="" class="form-control" id="pass_no" name="pass_no" type="text" value="<?php echo 'G-'.$pass_no?>">
                                          <span id="pass_no_error" style="color:red"></span>

                               </div>
                               <label for="title" class="col-sm-2 control-label">
                                   Pass Date<sup style="color:red;">*</sup>:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <input class="form-control datepicker" id="date" name="date" type="text" value="<?php echo date('d-m-Y')?>">
                                         <span id="contact_no_error" style="color:red"></span>

                               </div>
                             
                         </div>
                
                        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                   Delivery Challan No.
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <select class="form-control select2" id="dc_id" name="dc_id">
                                             <option value="">Select Delivery Challan</option>
                                           <?php foreach ($challan as $row){?> 
                                           <option value="<?php echo $row['dc_id']?>"><?php echo $row['dc_no'];?></option>
                                              <?php }?>
                                         </select>

                               </div>
                               <label for="title" class="col-sm-2 control-label">
                                   Address<sup style="color:red;">*</sup>:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <input required="" type="text" name="address" class="form-control">

                               </div>
                             
                        </div>
                        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                   Driver Name.
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <select class="form-control select2" id="driver_id" name="driver_id">
                                             <option value="">Select Driver</option>
                                           <?php foreach ($driver as $row){?> 
                                           <option value="<?php echo $row['driver_id']?>"><?php echo $row['driver_name'];?></option>
                                              <?php }?>
                                         </select>

                               </div>
                               <label for="title" class="col-sm-2 control-label">
                                   Truck No<sup style="color:red;">*</sup>:
                               </label> 
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                         <select required="" class="form-control select2" id="truck_id" name="truck_id">
                                             <option value="">Select Truck</option>
                                           <?php foreach ($truck as $row){?> 
                                           <option value="<?php echo $row['truck_id']?>"><?php echo $row['truck_no'];?></option>
                                              <?php }?>
                                         </select>

                               </div>
                             
                        </div>
                
                <div class="form-group">
                   <label class="check_container">Kind of issue
                       <input type="checkbox" name="issue" value="1">
  <span class="checkmark"></span>
</label>
 <label class="check_container">Sales
     <input type="checkbox" name="sale" value="1">
  <span class="checkmark"></span>
</label>                 
 <label class="check_container">No-Returnable
     <input type="checkbox" name="non_return" value="1">
  <span class="checkmark"></span>
</label>                 
 <label class="check_container">Returnable
  <input type="checkbox" name="return" value="1">
  <span class="checkmark"></span>
</label>                 
                </div>
                
                <div class="separator-shadow"></div> 
                
          <table id="create_new_row" class="table table-bordered">
                                <tr>
                                    <th onclick="createrow()"  style="color:red;text-align: center;font-size: 23px;cursor: pointer;width:5%;"><i class=" fa fa-plus"></i><input type="hidden" id="current_row" value="1"></th>
                                    <th style="width:5%;">SL</th>
                                    <th>Note</th>
                                    
                                </tr>
                                <tr id="remove_1">
                                    <td></td>
                                    <td>1</td>
                                    
                                    <td>
                                        <textarea required="" style=" height:40px;" class="form-control" name="note[1]"></textarea>  
                                    </td>
                                </tr>
                            </table>              
                         
             
                
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/helpers/') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
                    
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary button">SAVE</button>
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
    $('.select2').select2();  
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
    
    
    function createrow(){
    var row = parseInt($('#current_row').val());
    var next_row = row + 1;
    
    $('#current_row').val(next_row);
    var str = '';
    str += '<td onclick="remove('+next_row+')" style="color:red;text-align: center;font-size: 23px;cursor: pointer;"><i class="fa fa-minus"></i></td>';
    str += '<td>'+next_row+'</td>';
    
    str += '<td><textarea required="" class="form-control" name="note['+next_row+']"></textarea></td>';
    
    //str+='</tr>'
    
    $('#create_new_row').append('<tr id="remove_' + next_row + '">' + str + '</tr>');
    }
    
    function remove(row){
         if (confirm('Are you sure to delete ?') == true) {
       $('#remove_'+row).remove();
         }
    }
    
</script>