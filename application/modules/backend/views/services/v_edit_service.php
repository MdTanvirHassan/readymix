<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Service</h3>
            </div>
        </div>
    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 <div class="x_content">
                     <form class="form-horizontal" action="<?php echo site_url('services/edit_service_action/'.$service_info[0]['id']); ?>" method="post">
                         
                         
                         <div class='form-group' >
                             
                            <label for="title" class="col-sm-2 control-label">
                                    Service ID <sup style="color:red">*</sup>:
                                 </label> 

                                 <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    
                                    <input class="form-control" id="inputdefault" disabled name="service_id" type="text" value="<?php if(!empty($service_info[0]['service_id'])) echo $service_info[0]['service_id'];  ?>">
                                    
                                </div> 
                             
                             
                            <label for="title" class="col-sm-2 control-label">
                                Service Name <sup style="color:red">*</sup>:
                            </label> 
                             <div class="col-sm-4 input-group">
                             <span class="input-group-addon"><i class="fa fa-user"></i></span>
                             <input required  class="form-control" id="inputdefault" name="service_name" type="text" value="<?php if(!empty($service_info[0]['service_name'])) echo $service_info[0]['service_name'];  ?>">
                            </div>
                            
                             
                         </div>
                         
                         
                         <div class='form-group' >
                             
                           <label for="title" class="col-sm-2 control-label">
                                Service Type<sup style="color:red">*</sup>:
                           </label> 
                             <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select required id="item_type" class="form-control" name="group_id">
                                        
                                        <?php if(!empty($groups)){ ?>
                                                <option class="form-control" value="">Select type</option>
                                                <?php foreach($groups as $group){ ?>
                                                      <option <?php if($service_info[0]['group_id']==$group['id']) echo 'selected'; ?> class="form-control" value="<?php echo $group['id'] ?>"><?php echo $group['group_name'] ?></option>
                                                <?php } ?>   
                                        <?php } ?>      

                                  </select>
                           </div>   
                             
                            <label for="title" class="col-sm-2 control-label">
                                    Service Unit :
                              </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                 <input  class="form-control" id="inputdefault" name="service_unit" type="text" value="<?php if(!empty($service_info[0]['service_unit'])) echo $service_info[0]['service_unit'];  ?>">
                             </div>  
                          
                         </div> 
                         
                         <div class='form-group' >
                               <label for="title" class="col-sm-2 control-label">
                                    Description :
                             </label>
                             <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control" id="inputdefault" name="description" type="text" value="<?php if(!empty($service_info[0]['description'])) echo $service_info[0]['description'];  ?>">
                             </div>

                           
                               <label for="title" class="col-sm-2 control-label">
                                    Remark :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control" id="inputdefault" name="remark" type="text" value="<?php if(!empty($service_info[0]['remark'])) echo $service_info[0]['remark'];  ?>">
                                </div>

                           
                         </div>
                         
                         
                         <div class="form-group" style="margin-top: 40px;">
                             <div class="col-sm-2">
                                <a href="<?php echo site_url('backend/services') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                            </div>
                            <div class=" col-sm-2">
                                <button type="submit" class="btn btn-primary button">UPDATE</button>
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
