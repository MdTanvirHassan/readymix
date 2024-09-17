<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Payment Mode</h3>
            </div>
        </div>
    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 <div class="x_content">
                     <form class="form-horizontal" action="<?php echo site_url('payment_mode/edit_payment_mode_action/'.$payment_mode_info[0]['id']); ?>" method="post">
                         
                         
                         <div class='form-group' >
                            <label for="title" class="col-sm-2 control-label">
                                Payment Mode <sup style="color:red">*</sup>:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <input required  class="form-control" id="inputdefault" name="mode_name" type="text" value="<?php if(!empty($payment_mode_info[0]['mode_name'])) echo $payment_mode_info[0]['mode_name'];  ?>">
                        </div>
                             
                       <label for="title" class="col-sm-2 control-label">
                                    Payment Security :
                               </label>
                               <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select id="item_type" class="form-control" name="security_id">
                                        
                                        <?php if(!empty($payment_securities)){ ?>
                                                <option class="form-control" value="">Select security</option>
                                                <?php foreach($payment_securities as $security){ ?>
                                                      <option <?php if($payment_security_info[0]['id']==$security['id']) echo 'selected'; ?> class="form-control" value="<?php echo $security['id'] ?>"><?php echo $security['security_name'] ?></option>
                                                <?php } ?>   
                                        <?php } ?>      

                                  </select>
                           </div>      
                          
                             
                         </div>
                         
                           <div class='form-group' >
                               
                                 <label for="title" class="col-sm-2 control-label">
                                    Description :
                                </label>
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                         <input  class="form-control" id="inputdefault" name="description" type="text" value="<?php if(!empty($payment_mode_info[0]['description'])) echo $payment_mode_info[0]['description'];  ?>">
                                </div>
                               
                               
                                <label for="title" class="col-sm-2 control-label">
                                    Remark <sup style="color:red">*</sup>:
                                </label> 
                                  <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input required  class="form-control" id="inputdefault" name="remark" type="text" value="<?php if(!empty($payment_mode_info[0]['remark'])) echo $payment_mode_info[0]['remark'];  ?>">
                                  </div>
                            
                             
                         </div>
                       
                         
                         
                         <div class="form-group" style="margin-top: 40px;">
                             <div class="col-sm-2">
                                <a href="<?php echo site_url('backend/payment_mode') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
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
