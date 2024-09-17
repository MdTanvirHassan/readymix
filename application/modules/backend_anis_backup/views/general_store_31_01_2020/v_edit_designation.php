 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--            <h2 style="text-align:center; ">Edit Designation</h2>
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
            <form class="form-horizontal" action="<?php echo site_url('general_store/edit_action_designation/'.$designation[0]['id']); ?>" method="post">
               
                <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                           Name:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input required class="form-control" id="inputdefault" name="designation_name" type="text" value="<?php if(!empty($designation[0]['designation_name'])) echo $designation[0]['designation_name']; ?>">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Short Name :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input  class="form-control" id="inputdefault" name="designation_short_name" value="<?php if(!empty($designation[0]['designation_short_name'])) echo $designation[0]['designation_short_name']; ?>" type="text">
                        </div>
                             
                         </div>
                
                
<!--                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext"><label for="inputdefault">  Name <sup>*</sup>:</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="designation_name" type="text" value="<?php if(!empty($designation[0]['designation_name'])) echo $designation[0]['designation_name']; ?>"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-4  labeltext"><label for="inputdefault">Short  Name :</label></div>
                             <div class="col-sm-8 col-md-5 "><input  class="form-control" id="inputdefault" name="designation_short_name" value="<?php if(!empty($designation[0]['designation_short_name'])) echo $designation[0]['designation_short_name']; ?>" type="text"></div>
                        </div>
                    </div>
                </div>-->
                    
                
                
                <br>
                
                   
                        <div class="row">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary button">Update</button>
                            </div>
                              <div class="col-md-2">
                                <a href="<?php echo site_url('backend/general_store/designation') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                            </div>         
                                    
                </div>
                 
                
            </form>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

