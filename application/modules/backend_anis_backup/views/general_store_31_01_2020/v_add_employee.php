<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add User</h3>
            </div>
        </div>
    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 <div class="x_content">
                     <form class="form-horizontal" action="<?php echo site_url('general_store/add_action_employee'); ?>" method="post">
                         
                         
                         <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                            Name   :
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input required class="form-control" name="name" type="text">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Email :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                 <input  class="form-control" id="email" name="email" type="text">
                        </div>
                             
                         </div>
                         
                         
                         <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                            Designation   :
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <select required class="form-control" name="designation_id">
                               <option class="form-control" value=''>Select Designation</option>
                              <?php foreach($designations as $designation){ ?>
                                    <option class="form-control" value="<?php if(!empty($designation['id'])) echo $designation['id']; ?>"><?php if(!empty($designation['designation_name'])) echo $designation['designation_name']; ?></option>
                               <?php } ?>
                                
                            </select>
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Projects :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <select class="form-control" name="companyId">
                                <option class="form-control" value=''>Select Project</option>
                                <?php foreach($projects as $project){ ?>
                                    <option class="form-control" value="<?php if(!empty($project['d_id'])) echo $project['d_id']; ?>"><?php if(!empty($project['dep_description'])) echo $project['dep_description']; ?></option>
                                <?php } ?>
                               
                            </select>
                        </div>
                             
                         </div>
                         
                         <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                            Mobile   :
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input required class="form-control" name="mobile" type="text">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Address :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input  class="form-control" name="address" type="text">
                        </div>
                             
                         </div>
                         
                         
                         
                        
                         
                         
                         
                         
                         
                         
                         
                         
                         
                         <div class="form-group" style="margin-top: 40px;">
                        <div class=" col-sm-2">
                            <button type="submit" class="btn btn-primary button">SAVE</button>
                        </div>
                        <div class="col-sm-2">
                            <a href="<?php echo site_url('backend/general_store/employee') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                        </div>
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
$('#email').blur(function(){
   var email = $(this).val();
   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;  
   if(!emailReg.test(email)) {  
        alert("Please enter valid email id");
        $(this).val('');
   } 
})
</script>












