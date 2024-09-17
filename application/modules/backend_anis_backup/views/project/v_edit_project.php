 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(7, 18, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) { ?> 
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'customers') echo 'active'; ?>" href="<?php echo site_url('backend/customers'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Customers</span>
                        </a>
                    </li>
                <?php } ?> 
<?php $this->role = checkUserPermission(7, 19, $userData);
if (empty($this->role) || !in_array(11, $this->role)) { ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'bank') echo 'active'; ?>" href="<?php echo site_url('backend/bank'); ?>">
                            <i class="fa fa-university"></i><br><span>Bank</span></a>
                    </li>
<?php } ?>
<?php $this->role = checkUserPermission(7, 20, $userData);
if (empty($this->role) || !in_array(11, $this->role)) { ?>          
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'product_category') echo 'active'; ?>" href="<?php echo site_url('backend/product_categories'); ?>">
                            <i class="fa fa-object-group"></i><br><span>Categories</span></a>
                    </li>
<?php } ?>
<?php $this->role = checkUserPermission(7, 21, $userData);
if (empty($this->role) || !in_array(11, $this->role)) { ?>    
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'sales_product') echo 'active'; ?>" href="<?php echo site_url('backend/sale_products'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Products</span></a>
                    </li>
<?php } ?>
                <?php $this->role = checkUserPermission(7, 22, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) { ?>       
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'product_mixing') echo 'active'; ?>" href="<?php echo site_url('backend/products_mixing'); ?>">
                            <i class="fa fa-cubes"></i><br><span>Products Mixing</span></a>
                    </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(7, 23, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) { ?>          
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'project') echo 'active'; ?>" href="<?php echo site_url('backend/projects'); ?>">
                            <i class="fa fa-home"></i><br><span>Projects</span></a>
                    </li>
<?php } ?>

            </ul>
        </div>
    </div>

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Project</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal" action="<?php echo site_url('projects/edit_project_action/'.$project_info[0]['project_id']); ?>" method="post" onsubmit="javascript: return validation()">
                
                
                
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Customer<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select  class="e1 form-control"  id="customer_id" name="customer_id" >
                                    <option value="">Select Customer</option>
                                    <?php foreach($customers as $customer){ ?>
                                        <option <?php if($project_info[0]['customer_id']==$customer['id']){ echo "selected";} ?> value="<?php echo $customer['id'];  ?>"><?php if(!empty($customer['c_name'])) echo $customer['c_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <span id="customer_id_error" style="color:red;"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                  Project Name<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                   <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <input  class="form-control" id="project_name" name="project_name" type="text" value="<?php if(!empty($project_info[0]['project_name'])) echo $project_info[0]['project_name']; ?>">
                                <span id="project_name_error" style="color:red"></span>
                                </div>

                            </div>
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Contact Person<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control"  id="contact_person" name="contact_person" type="text" value="<?php if(!empty($project_info[0]['contact_person'])) echo $project_info[0]['contact_person']; ?>">
                                <span id="contact_person_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                  Contact No.<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="contact_no" name="contact_no" type="text" value="<?php if(!empty($project_info[0]['contact_no'])) echo $project_info[0]['contact_no']; ?>">
                                <span id="contact_no_error" style="color:red"></span>
                                </div>

                            </div>
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Address<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-10 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <textarea rows="3" class="form-control"  id="address" name="address"><?php if(!empty($project_info[0]['address'])) echo $project_info[0]['address']; ?></textarea>
                                <span id="address_error" style="color:red"></span>
                                </div>
                                

                            </div>
                            
                            
<!--                            <div class="row">
                
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Customer <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                               <select  style="width:200px;" class="e1"  id="customer_id" name="customer_id" >
                                    <option value="">Select Customer</option>
                                    <?php foreach($customers as $customer){ ?>
                                        <option <?php if($project_info[0]['customer_id']==$customer['id']){ echo "selected";} ?> value="<?php echo $customer['id'];  ?>"><?php if(!empty($customer['c_name'])) echo $customer['c_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <span id="customer_id_error" style="color:red;"></span>
                            </div>
                        </div>
                    </div>
                    
                   <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Project Name <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                <input  class="form-control" id="project_name" name="project_name" type="text" value="<?php if(!empty($project_info[0]['project_name'])) echo $project_info[0]['project_name']; ?>">
                                <span id="project_name_error" style="color:red"></span>
                            </div>
                        </div>
                    </div>
                   
                </div>-->
                
                
<!--                 <div class="row">
                
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Contact Person <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                <input  class="form-control"  id="contact_person" name="contact_person" type="text" value="<?php if(!empty($project_info[0]['contact_person'])) echo $project_info[0]['contact_person']; ?>">
                                <span id="contact_person_error" style="color:red"></span>
                            </div>
                        </div>
                    </div>
                    
                   <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Contact No.<sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                <input  class="form-control" id="contact_no" name="contact_no" type="text" value="<?php if(!empty($project_info[0]['contact_no'])) echo $project_info[0]['contact_no']; ?>">
                                <span id="contact_no_error" style="color:red"></span>
                            </div>
                        </div>
                    </div>
                   
                </div>-->
               
<!--                <div class="row">
                
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Address <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                               
                                <textarea rows="3" class="form-control"  id="address" name="address"><?php if(!empty($project_info[0]['address'])) echo $project_info[0]['address']; ?></textarea>
                                <span id="address_error" style="color:red"></span>
                            </div>
                        </div>
                    </div>
                    
                
                   
                </div>-->
              
                <div class="form-group" style="margin-top: 40px;">
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/projects') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
                                </div>
                    
                                <div class=" col-sm-2">
                                    <button type="submit" class="btn btn-primary button" onclick="javascript:validation()">UPDATE</button>
                                </div>
                               
                            </div>
             
<!--                <div class="row">
                        <div class="col-md-1 col-md-offset-3 ">
                                <a href="<?php echo site_url('backend/projects') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">REGISTER</button> </a>
                         </div>      
                        <div class="row">
                            <div class="col-md-2 ">
                                <button type="submit" class="btn btn-primary button" onclick="javascript:validation()">UPDATE</button>
                            </div>   
                        </div>
                   
                    
                </div>-->
                
            </form>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

    <script type="text/javascript">
    function validation(){
        var customer_id=$('#customer_id').val();
        var project_name=$('#project_name').val();
        var contact_person=$('#contact_person').val();
        var contact_no=$('#contact_no').val();
        var address=$('#address').val();
         
        var error=false;    
        if(customer_id==''){
            $('#customer_id').css('border','1px solid red');
            $('#customer_id_error').html('Please select customer');
            error=true;
           
        }else{
            $('#customer_id').css('border','1px solid #ccc');
            $('#customer_id_error').html('');
            
        }
        if(project_name==''){
            $('#project_name').css('border','1px solid red');
            $('#project_name_error').html('Please fill project name field');
            error=true;
           
        }else{
            $('#project_name').css('border','1px solid #ccc');
            $('#project_name_error').html('');
            
        }
        if(contact_person==''){
            $('#contact_person').css('border','1px solid red');
            $('#contact_person_error').html('Please fill contact person field');
            error=true;
           
        }else{
            $('#contact_person').css('border','1px solid #ccc');
            $('#contact_person_error').html('');
            
        }
        if(contact_no==''){
            $('#contact_no_error').html('Please fill contact no field');
            $('#contact_no').css('border','1px solid red');
             error=true;
        }else{
            $('#contact_no_error').html('');
            $('#contact_no').css('border','1px solid #ccc');   
            
        }
        
         if(address==''){
             alert('test');
            $('#address_error').html('Please fill address field');
            $('#address').css('border','1px solid red');
             error=true;
        }else{
            
            $('#address_error').html('');
            $('#address').css('border','1px solid #ccc');   
            
        }
             
        if(error==true){
            return false;
        }
    }

</script>    
                    
