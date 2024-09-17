 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--            <h2 style="text-align:center; ">Edit Unit</h2>
            <hr>-->

<div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Unit</h3>
            </div>
        </div>
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
            <form class="form-horizontal" action="<?php echo site_url('general_store/edit_action_department/'.$department[0]['d_id']); ?>" method="post">
               
                
                <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                           Unit Code:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input disabled class="form-control" id="inputdefault" name="dep_code" value="<?php if(!empty($department[0]['dep_code'])) echo $department[0]['dep_code']; ?>" type="text">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Unit Name :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input required class="form-control" id="inputdefault" name="dep_description" value="<?php if(!empty($department[0]['dep_description'])) echo $department[0]['dep_description']; ?>" type="text">
                        </div>
                             
                         </div>
                
                            <div class='form-group' >
                            
                                <label for="title" class="col-sm-2 control-label">
                                    Short Name :
                                </label>
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                      <input required class="form-control" id="inputdefault" name="short_name" type="text" value="<?php if(!empty($department[0]['short_name'])) echo $department[0]['short_name']; ?>">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Email :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input required class="form-control" id="inputdefault" name="email" type="text" value="<?php if(!empty($department[0]['email'])) echo $department[0]['email']; ?>">
                                </div>
                             
                         </div>
                
                         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Mobile No. :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input required class="form-control" id="inputdefault" name="mobile_no" type="text" value="<?php if(!empty($department[0]['mobile_no'])) echo $department[0]['mobile_no']; ?>">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                   Phone :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input required class="form-control" id="inputdefault" name="phone" type="text" value="<?php if(!empty($department[0]['phone'])) echo $department[0]['phone']; ?>">
                                </div>
                         </div>
                         
                         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Address :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                    <input required class="form-control" id="inputdefault" name="address" type="text" value="<?php if(!empty($department[0]['address'])) echo $department[0]['address']; ?>">
                                </div>
                                
                         </div>
                
<!--                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext"><label for="inputdefault">Unit Code:</label></div>
                            <div class="col-sm-8 col-md-5 "><input disabled class="form-control" id="inputdefault" name="dep_code" value="<?php if(!empty($department[0]['dep_code'])) echo $department[0]['dep_code']; ?>" type="text"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-4  labeltext"><label for="inputdefault">Unit Name :</label></div>
                             <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="dep_description" value="<?php if(!empty($department[0]['dep_description'])) echo $department[0]['dep_description']; ?>" type="text"></div>
                        </div>
                    </div>
                </div>-->
                
<!--                  <div class="row">
                        <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext"><label for="inputdefault"> Short Name :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="short_name" type="text" value="<?php if(!empty($department[0]['short_name'])) echo $department[0]['short_name']; ?>"></div>
                        </div>
                    </div>
                </div>-->
                
                
                <br>
                
                   
                        <div class="row">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary button">Update</button>
                            </div>
                              <div class="col-md-2">
                                <a href="<?php echo site_url('backend/general_store/department') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                            </div>         
                                    <!--
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary button">SEARCH</button>
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
                    </div>
                   <div class="col-md-2">
                        <button type="button" class="btn  btn-danger button">SIMILAR LIST</button>
                    </div>
                            -->
                </div>
                  
                    
                
            </form>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

