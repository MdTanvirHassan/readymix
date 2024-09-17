 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--            <h2 style="text-align:center; ">Edit Cost Center</h2>
            <hr>-->
<div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Cost Center</h3>
            </div>
        </div>
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
            <form class="form-horizontal" action="<?php echo site_url('general_store/edit_action_cost_center/'.$cost_center[0]['c_c_id']); ?>" method="post">
               
                
                <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                           Name:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <input required class="form-control" id="inputdefault" name="c_c_name" type="text" value="<?php if(!empty($cost_center[0]['c_c_name'])) echo $cost_center[0]['c_c_name']; ?>">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Description :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input  class="form-control" id="inputdefault" name="c_c_description" type="text" value="<?php if(!empty($cost_center[0]['c_c_description'])) echo $cost_center[0]['c_c_description']; ?>">
                        </div>
                             
                         </div>
                
<!--                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div style="text-align:right" class="col-sm-4 col-md-3 col-md-offset-3  labeltext"><label for="inputdefault"> Name:</label></div>
                             <div class="col-sm-8 col-md-5 ">
                                 
                                 <input requird class="form-control" id="inputdefault" name="c_c_name" type="text" value="<?php if(!empty($cost_center[0]['c_c_name'])) echo $cost_center[0]['c_c_name']; ?>">
                             </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div style="text-align:right" class="col-sm-4 col-md-3  labeltext"><label for="inputdefault"> Description :</label></div>
                            <div class="col-sm-8 col-md-5 "><input  class="form-control" id="inputdefault" name="c_c_description" type="text" value="<?php if(!empty($cost_center[0]['c_c_description'])) echo $cost_center[0]['c_c_description']; ?>"></div>
                        </div>
                    </div>
                </div>-->
                
              
            

                 

                
                <br>
                
   
                    <div class="row">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary button">UPDATE</button>
                        </div>
                        <div class="col-md-2">
                            <a href="<?php echo site_url('backend/general_store/cost_center') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                        </div>         
                            
                   
                </div>
                  
                
            </form>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>



