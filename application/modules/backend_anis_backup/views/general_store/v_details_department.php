 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--            <h2 style="text-align:center; ">Edit Unit</h2>
            <hr>-->

<div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Details Project</h3>
            </div>
        </div>
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
            <form class="form-horizontal" action="<?php echo site_url('general_store/edit_action_department/'.$department[0]['d_id']); ?>" method="post">
               
                
                <div class='form-group' >
                        <label for="title" class="col-sm-2 control-label">
                           Project ID:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input disabled class="form-control" id="inputdefault" name="dep_code" value="<?php if(!empty($department[0]['dep_code'])) echo $department[0]['dep_code']; ?>" type="text">
                        </div>
                        <label for="title" class="col-sm-2 control-label">
                            Project Type :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                 <input disabled class="form-control" id="inputdefault" name="project_type" value="<?php if(!empty($department[0]['project_type'])) echo $department[0]['project_type']; ?>" type="text">
                        </div>
                             
                         </div>
                
                            <div class='form-group' >
                                
                                <label for="title" class="col-sm-2 control-label">
                                    Project Name :
                                </label>
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                      <input disabled class="form-control" id="inputdefault" name="dep_description" value="<?php if(!empty($department[0]['dep_description'])) echo $department[0]['dep_description']; ?>" type="text">
                                </div>
                            
                                <label for="title" class="col-sm-2 control-label">
                                    Short Name :
                                </label>
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                      <input disabled class="form-control" id="inputdefault" name="short_name" type="text" value="<?php if(!empty($department[0]['short_name'])) echo $department[0]['short_name']; ?>">
                                </div>
                                
                             
                         </div>
                
                         <div class='form-group' >
                             <label for="title" class="col-sm-2 control-label">
                                   Email :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input disabled class="form-control" id="inputdefault" name="email" type="text" value="<?php if(!empty($department[0]['email'])) echo $department[0]['email']; ?>">
                                </div>
                             
                                <label for="title" class="col-sm-2 control-label">
                                    Mobile No. :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input disabled class="form-control" id="inputdefault" name="mobile_no" type="text" value="<?php if(!empty($department[0]['mobile_no'])) echo $department[0]['mobile_no']; ?>">
                                </div>
                                
                         </div>
                         
                         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                   Phone :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input disabled class="form-control" id="inputdefault" name="phone" type="text" value="<?php if(!empty($department[0]['phone'])) echo $department[0]['phone']; ?>">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Address :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input disabled class="form-control" id="inputdefault" name="address" type="text" value="<?php if(!empty($department[0]['address'])) echo $department[0]['address']; ?>">
                                </div>
                                
                         </div>
                
                     <div class='form-group' >
                             
                               <label for="title" class="col-sm-2 control-label">
                                   Project Manager :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <select disabled id="project_manager" class="form-control e1" name="project_manager">
                                        
                                        <?php if(!empty($employees)){ ?>
                                                <option class="form-control" value="">Select project manager</option>
                                                <?php foreach($employees as $employee){ ?>
                                                      <option <?php if($department[0]['project_manager']==$employee['id']) echo 'selected'; ?> class="form-control" value="<?php echo $employee['id'] ?>"><?php echo $employee['name'].'('.$employee['designation_name'].')' ?></option>
                                                <?php } ?>   
                                        <?php } ?>      

                                  </select>
                                </div>
                             
                                <label for="title" class="col-sm-2 control-label">
                                    Purchase Authority :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <select disabled id="purchase_manager" class="form-control e1" name="purchase_manager">
                                        
                                         <?php if(!empty($employees)){ ?>
                                                <option class="form-control" value="">Select purchase authority</option>
                                                <?php foreach($employees as $employee){ ?>
                                                      <option <?php if($department[0]['purchase_manager']==$employee['id']) echo 'selected'; ?> class="form-control" value="<?php echo $employee['id'] ?>"><?php echo $employee['name'].'('.$employee['designation_name'].')' ?></option>
                                                <?php } ?>   
                                        <?php } ?>     

                                  </select>
                                </div>
                                
                         </div>
                         
                         
                         <div class='form-group' >
                             
                               <label for="title" class="col-sm-2 control-label">
                                   Project Authority :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <select disabled id="project_authority" class="form-control e1" name="project_authority">
                                        
                                         <?php if(!empty($employees)){ ?>
                                                <option class="form-control" value="">Select project authority</option>
                                                <?php foreach($employees as $employee){ ?>
                                                      <option <?php if($department[0]['project_authority']==$employee['id']) echo 'selected'; ?> class="form-control" value="<?php echo $employee['id'] ?>"><?php echo $employee['name'].'('.$employee['designation_name'].')' ?></option>
                                                <?php } ?>   
                                        <?php } ?>     

                                  </select>
                                </div>
                             
                                <label for="title" class="col-sm-2 control-label">
                                    Initial Contract Value :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input disabled  class="form-control" id="inputdefault" name="initial_contract_value" type="text" value="<?php if(!empty($department[0]['initial_contract_value'])) echo $department[0]['initial_contract_value']; ?>">
                                </div>
                                
                         </div>
                         
                         
                         <div class='form-group' >
                             
                               <label for="title" class="col-sm-2 control-label">
                                   Commencement Date :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input disabled  class="form-control datepicker" id="commencement_date" name="commencement_date" type="text" value="<?php if(!empty($department[0]['commencement_date'])) echo date('d-m-Y',strtotime($department[0]['commencement_date'])); ?>">
                                </div>
                             
                                <label for="title" class="col-sm-2 control-label">
                                    Completion Date :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input disabled class="form-control datepicker" id="completion_date" name="completion_date" type="text" value="<?php if(!empty($department[0]['completion_date'])) echo date('d-m-Y',strtotime($department[0]['completion_date'])); ?>">
                                </div>
                                
                         </div>
                         
                         <div class='form-group' >
                             
                               <label for="title" class="col-sm-2 control-label">
                                  Remark :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input disabled  class="form-control" id="inputdefault" name="remarks" type="text" value="<?php if(!empty($department[0]['remarks'])) echo $department[0]['remarks']; ?>">
                                </div>
                             
                                
                         </div>
                
                
                <br>
                
                   
                        <div class="row">
                            
                            <div class="col-md-2">
                                <a href="<?php echo site_url('backend/general_store/department') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                            </div>         
                            
                          
                                   
                </div>
                  
                    
                
            </form>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

