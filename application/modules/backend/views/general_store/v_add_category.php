<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Group</h3>
            </div>
        </div>
    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 <div class="x_content">
                     <form class="form-horizontal" action="<?php echo site_url('general_store/add_action_item_category'); ?>" method="post">
                         
                         
                         <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                            Group Name:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <input required  class="form-control" id="inputdefault" name="c_name" type="text" value="">
                        </div>
                             <label for="title" class="col-sm-2 control-label">
                            Short Name :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                             <input  class="form-control" id="inputdefault" name="c_description" type="text">
                        </div>
                             
                         </div>
                         
                         <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                                Category:
                            </label> 
                             <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select id="item_type" class="form-control" name="group_id">
                                        
                                        <?php if(!empty($groups)){ ?>
                                                <option class="form-control" value="">Select category</option>
                                                <?php foreach($groups as $group){ ?>
                                                      <option class="form-control" value="<?php echo $group['id'] ?>"><?php echo $group['item_group'] ?></option>
                                                <?php } ?>   
                                        <?php } ?>      

                                  </select>
                           </div>
                             
                         </div>
                         
                        
                         
                         
                         
                         
                         
                     <!--    
                       <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                                Category Type :
                            </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                   <select id="group_type" class="form-control" name="c_type">
                                               <option class="form-control" value="Consumable">Consumable</option>
                                               <option class="form-control" value="Asset">Asset</option>
                                 </select>
                               </div>
                         </div>
                         -->
                         
                         <div class="form-group" style="margin-top: 40px;">
                              <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/general_store/item_category') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                               </div>
                               <div class=" col-sm-2">
                                    <button type="submit" class="btn btn-primary button">SAVE</button>
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
</script>
