<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; ">Edit User</h2>
    <hr>-->

<div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit User</h3>
            </div>
        </div>
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <form class="form-horizontal" action="<?php echo site_url('general_store/edit_action_employee/'.$employee[0]['id']); ?>" method="post">
        
        <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                                Name<span class="required">*</span>:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input required class="form-control" name="name" type="text" value='<?php if(!empty($employee[0]['name'])) echo $employee[0]['name'];  ?>'>
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Email :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input  class="form-control" name="email" type="text" value='<?php if(!empty($employee[0]['email'])) echo $employee[0]['email'];  ?>'>
                        </div>
                             
                         </div>
        
        <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                                Designation:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <select required class="form-control e1" name="designation_id">
                               <option class="form-control" value=''>Select Designation</option>
                              <?php foreach($designations as $designation){ ?>
                                    <option <?php if($employee[0]['designation_id']==$designation['id']) echo "selected"; ?> class="form-control" value="<?php if(!empty($designation['id'])) echo $designation['id']; ?>"><?php if(!empty($designation['designation_name'])) echo $designation['designation_name']; ?></option>
                               <?php } ?>
                                
                            </select>
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Project<span class="required">*</span> :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <select class="form-control e1" name="companyId">
                                <option class="form-control" value=''>Select Project</option>
                                <?php foreach($projects as $project){ ?>
                                    <option <?php if($employee[0]['companyId']==$project['d_id']) echo "selected"; ?> class="form-control" value="<?php if(!empty($project['d_id'])) echo $project['d_id']; ?>"><?php if(!empty($project['dep_description'])) echo $project['dep_description']; ?></option>
                                <?php } ?>
                               
                            </select>
                        </div>
                             
                         </div>
        
        <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                                MObile:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input required class="form-control" name="mobile" type="text" value='<?php if(!empty($employee[0]['mobile'])) echo $employee[0]['mobile'];  ?>'>
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Contact Address :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input  class="form-control" name="address" type="text" value='<?php if(!empty($employee[0]['address'])) echo $employee[0]['address'];  ?>'>
                        </div>
                           
                             
                         </div>
                         <div class='form-group' >
                             <label for="title" class="col-sm-2 control-label">
                            Salary :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input  class="form-control" name="salary" type="text" value='<?php if(!empty($employee[0]['salary'])) echo $employee[0]['salary'];  ?>'>
                        </div>
                             
                         </div>
        
        
<!--        <div class="row">
            
           <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault"> Name <sup>*</sup>  :</label></div>
                        <div class="col-sm-8 col-md-5 "><input required class="form-control" name="name" type="text" value='<?php if(!empty($employee[0]['name'])) echo $employee[0]['name'];  ?>'></div>
                    </div>
          </div> 
            
         <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Email :</label></div>
                    <div class="col-sm-8 col-md-5 "><input  class="form-control" name="email" type="text" value='<?php if(!empty($employee[0]['email'])) echo $employee[0]['email'];  ?>'></div>
                </div>
          </div>
          
        </div>-->
            
<!--          <div class="row">
              
                  <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Designation <sup>*</sup> :</label></div>
                        <div class="col-sm-8 col-md-5 ">
                            <select required class="form-control" name="designation_id">
                               <option class="form-control" value=''>Select Designation</option>
                              <?php foreach($designations as $designation){ ?>
                                    <option <?php if($employee[0]['designation_id']==$designation['id']) echo "selected"; ?> class="form-control" value="<?php if(!empty($designation['id'])) echo $designation['id']; ?>"><?php if(!empty($designation['designation_name'])) echo $designation['designation_name']; ?></option>
                               <?php } ?>
                                
                            </select>
                        </div>
                    </div>
                </div>
              
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4 col-md-3  labeltext" style="text-align: right;"><label for="inputdefault">Project <sup>*</sup> :</label></div>
                        <div class="col-sm-8 col-md-5 ">
                            <select class="form-control" name="companyId">
                                <option class="form-control" value=''>Select Project</option>
                                <?php foreach($projects as $project){ ?>
                                    <option <?php if($employee[0]['companyId']==$project['d_id']) echo "selected"; ?> class="form-control" value="<?php if(!empty($project['d_id'])) echo $project['d_id']; ?>"><?php if(!empty($project['dep_description'])) echo $project['dep_description']; ?></option>
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div>
            </div>
          </div>     -->

<!--        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Mobile  :</label></div>
                    <div class="col-sm-8 col-md-5 "><input required class="form-control" name="mobile" type="text" value='<?php if(!empty($employee[0]['mobile'])) echo $employee[0]['mobile'];  ?>'></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Contact Address :</label></div>
                    <div class="col-sm-8 col-md-5 "><input  class="form-control" name="address" type="text" value='<?php if(!empty($employee[0]['address'])) echo $employee[0]['address'];  ?>'></div>
                </div>
            </div>
        </div>-->

       
        <br>
        <div class="row">
           
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary button">SAVE</button>
            </div>
             <div class="col-md-2">
                <a href="<?php echo site_url('backend/general_store/employee') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

            </div>
        </div> 
            <!--
            <div class="col-md-2">
                <button type="button" class="btn btn-primary button">FIND</button>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-success button">VIEW</button>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-info button">CLEAR</button>
            </div>
            
            <div class="col-md-2">
                <button type="button" class="btn btn-warning button">SAVE</button>
            </div>
            
            <div class="col-md-2">
                <button type="button" class="btn  btn-danger button">EXIT</button>
            </div>-->
        
    </form>
</div>
</div>
</div>
</div>
</div>
</div>


