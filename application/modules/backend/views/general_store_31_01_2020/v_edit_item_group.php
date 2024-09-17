 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--            <h2 style="text-align:center; ">Edit Item Group</h2>
            <hr>-->
<div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Item Category</h3>
            </div>
        </div>
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
            <form class="form-horizontal" action="<?php echo site_url('general_store/edit_action_item_group_information/'.$item_group[0]['id']) ?>" method="post">
                
               <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                           Category Name :
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input required class="form-control" id="inputdefault" name="item_group" type="text" value="<?php if(!empty($item_group[0]['item_group'])) echo $item_group[0]['item_group'] ?>">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Category Short Name :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input required class="form-control" id="inputdefault" name="group_short_name" type="text" value="<?php if(!empty($item_group[0]['group_short_name'])) echo $item_group[0]['group_short_name'] ?>">
                        </div>
                             
                         </div> 
                
                
                <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                           Category Type :
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <select id="group_type" class="form-control" name="group_type">
                                   
                                    
                                           <option <?php if(!empty($item_group[0]['group_type']) && $item_group[0]['group_type']=="Consumable" ) echo "selected"; ?> class="form-control" value="Consumable">Consumable</option>
                                           <option <?php if(!empty($item_group[0]['group_type']) && $item_group[0]['group_type']=="Asset" ) echo "selected"; ?> class="form-control" value="Asset">Asset</option>
                                  
                                </select>
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Description :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input class="form-control" id="inputdefault" name="item_group_description" type="text" value="<?php if(!empty($item_group[0]['item_group_description'])) echo $item_group[0]['item_group_description'] ?>">
                        </div>
                             
                         </div>
                
                
<!--                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-4 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Item Group :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="item_group" type="text" value="<?php if(!empty($item_group[0]['item_group'])) echo $item_group[0]['item_group'] ?>"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-4  labeltext"><label for="inputdefault">Item Group Short Name :</label></div>
                             <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="group_short_name" type="text" value="<?php if(!empty($item_group[0]['group_short_name'])) echo $item_group[0]['group_short_name'] ?>"></div>
                        </div>
                    </div>
                </div>-->
                
<!--                <div class="row">
                    
                     <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-4 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Group Type :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                <select id="group_type" class="form-control" name="group_type">
                                   
                                    
                                           <option <?php if(!empty($item_group[0]['group_type']) && $item_group[0]['group_type']=="Consumable" ) echo "selected"; ?> class="form-control" value="Consumable">Consumable</option>
                                           <option <?php if(!empty($item_group[0]['group_type']) && $item_group[0]['group_type']=="Asset" ) echo "selected"; ?> class="form-control" value="Asset">Asset</option>
                                  
                                </select>
                            </div>
                        </div>
                    </div>
                  
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-4  labeltext" style="text-align: right;"><label for="inputdefault">Item Group Description :</label></div>
                             <div class="col-sm-8 col-md-5 "><input class="form-control" id="inputdefault" name="item_group_description" type="text" value="<?php if(!empty($item_group[0]['item_group_description'])) echo $item_group[0]['item_group_description'] ?>"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">Start Code  :</label></div>
                            <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="start_code" type="text" value="<?php if(!empty($item_group[0]['start_code'])) echo $item_group[0]['start_code'] ?>"></div>
                        </div>
                    </div>
                    
                </div>-->
                <div class="row">
                    <!--
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-5  labeltext"><label for="inputdefault">End Code. :</label></div>
                             <div class="col-sm-8 col-md-7 "><input class="form-control" id="inputdefault" name="end_code" type="text" value="<?php if(!empty($item_group[0]['end_code'])) echo $item_group[0]['end_code'] ?>" ></div>
                        </div>
                    </div>
                    -->
                </div>
                
              
                <br>
                <div class="row">
                   
                        <div class="row">
                            <div class="col-md-2">
                                <a href="<?php echo site_url('backend/general_store/item_group_information') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                            </div>       
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary button">UPDATE</button>
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
                            -->
                </div>
                   
                    <div class="col-md-2">
                        <div class="row">
                    <div class="col-md-12">
                   <!--     <button type="button" class="btn btn-default button">SIMILAR LIST</button> -->
                    </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
