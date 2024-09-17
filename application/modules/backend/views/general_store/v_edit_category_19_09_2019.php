 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--            <h2 style="text-align:center; ">Edit Category</h2>
            <hr>-->
<div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Category</h3>
            </div>
        </div>
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
            <form class="form-horizontal" action="<?php echo site_url('general_store/edit_action_item_category/'.$category[0]['c_id']); ?>" method="post">
               
              <div class='form-group' >
                       <label for="title" class="col-sm-2 control-label">
                           Category Name:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <input required  class="form-control" id="inputdefault" name="c_name" type="text" value="<?php if(!empty($category[0]['c_name'])) echo $category[0]['c_name']; ?>">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Short Name :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                              <input  class="form-control" id="inputdefault" name="c_description" type="text" value="<?php if(!empty($category[0]['c_description'])) echo $category[0]['c_description']; ?>">
                        </div>
                             
                 </div> 
                
                 <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                                Group:
                            </label> 
                             <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select id="item_type" class="form-control" name="group_id">        
                                        <?php if(!empty($groups)){ ?>
                                                      <option class="form-control" value="">Select group</option>
                                                <?php foreach($groups as $group){ ?>
                                                      <option <?php if($category[0]['group_id']==$group['id']) echo 'selected'; ?> class="form-control" value="<?php echo $group['id'] ?>"><?php echo $group['item_group'] ?></option>
                                                <?php } ?>   
                                        <?php } ?>      

                                  </select>
                           </div>
                             
                         </div>
                
                
                <!--
                <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                           Category Type:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <select id="group_type" class="form-control" name="c_type">
                                   
                                    
                                           <option <?php if(!empty($category[0]['c_type']) && $category[0]['c_type']=="Consumable" ) echo "selected"; ?> class="form-control" value="Consumable">Consumable</option>
                                           <option <?php if(!empty($category[0]['c_type']) && $category[0]['c_type']=="Asset" ) echo "selected"; ?> class="form-control" value="Asset">Asset</option>
                                  
                                </select>
                        </div>
                </div>
                -->
                
<!--                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext"><label for="inputdefault">Category Name:</label></div>
                             <div class="col-sm-8 col-md-5 ">
                                 
                                 <input required  class="form-control" id="inputdefault" name="c_name" type="text" value="<?php if(!empty($category[0]['c_name'])) echo $category[0]['c_name']; ?>">
                             </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext"><label for="inputdefault">Short Name :</label></div>
                            <div class="col-sm-8 col-md-5 "><input  class="form-control" id="inputdefault" name="c_description" type="text" value="<?php if(!empty($category[0]['c_description'])) echo $category[0]['c_description']; ?>"></div>
                        </div>
                    </div>
                </div>-->
                
              
            

<!--                  <div class="row">
                        <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext"><label for="inputdefault"> Category Type :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                <select id="group_type" class="form-control" name="c_type">
                                   
                                    
                                           <option <?php if(!empty($category[0]['c_type']) && $category[0]['c_type']=="Consumable" ) echo "selected"; ?> class="form-control" value="Consumable">Consumable</option>
                                           <option <?php if(!empty($category[0]['c_type']) && $category[0]['c_type']=="Asset" ) echo "selected"; ?> class="form-control" value="Asset">Asset</option>
                                  
                                </select>
                            </div>
                        </div>
                    </div>
                </div>-->


                
                <br>
                <div class="row">
   
                    
                    <div class="col-md-2">
                            <a href="<?php echo site_url('backend/general_store/item_category') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                    </div> 
                    
                    <div class="col-md-2">
                            <button type="submit" class="btn btn-primary button">Update</button>
                    </div>
                                 
                        
                            
                   
                </div>
                   
                    <div class="col-md-2">
                        <div class="row">
                            <!--
                    <div class="col-md-12">
                        <button type="button" class="btn btn-default button">SIMILAR LIST</button>
                    </div> -->
                        </div>
                    </div>
                
                
            </form>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>


