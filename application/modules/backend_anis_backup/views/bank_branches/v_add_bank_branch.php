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
                    
<?php $this->role = checkUserPermission(7, 19, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'bank_branch') echo 'active'; ?>" href="<?php echo site_url('backend/bank_branches'); ?>">
                        <i class="fa fa-university"></i><br><span>Bank Branch</span></a>
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
                <h3>Add Branch</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
            <form class="form-horizontal" action="<?php echo site_url('bank_branches/add_bank_branch_action'); ?>" method="post" onsubmit="javascript: return validation()">
               <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Name<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input required class="form-control"  id="category_name" name="branch_name" type="text">
                                <span id="category_name_error" style="color:red"></span>
                                </div>
                              
                            </div> 
                
<!--                <div class="row">
                
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right">
                                <label for="inputdefault">Name <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                <input  class="form-control"  id="category_name" name="category_name" type="text">
                                <span id="category_name_error" style="color:red"></span>
                            </div>
                        </div>
                    </div>
                    
                   <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Short Name <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                <input  class="form-control" id="short_name" name="short_name" type="text">
                                <span id="short_name_error" style="color:red"></span>
                            </div>
                        </div>
                    </div>
                   
                </div>-->
                
                
                
               
     
              
                
             
                <div class="form-group" style="margin-top: 40px;">
                                 <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/bank_branches') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
                                </div>
                                <div class=" col-sm-2">
                                    <button type="submit" class="btn btn-primary button" onclick="javascript:validation()">SAVE</button>
                                </div>
                               
                            </div>
                   
<!--                        <div class="row">
                            <div class="col-md-1 col-md-offset-3 ">
                                <a href="<?php echo site_url('backend/product_categories') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">REGISTER</button> </a>

                            </div>       
                            <div class="col-md-2 ">
                                <button type="submit" class="btn btn-primary button" onclick="javascript:validation()">SAVE</button>
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
//        var category_name=$('#category_name').val();
//        var short_name=$('#short_name').val();        
        var error=false;    
//        if(category_name==''){
//            $('#category_name').css('border','1px solid red');
//            $('#category_name_error').html('Please fill category name field');
//            error=true;
//           
//        }else{
//            $('#category_name').css('border','1px solid #ccc');
//            $('#category_name_error').html('');
//            
//        }
//        if(short_name==''){
//            $('#short_name_error').html('Please fill short name field');
//            $('#short_name').css('border','1px solid red');
//             error=true;
//        }else{
//            $('#short_name_error').html('');
//            $('#short_name').css('border','1px solid #ccc');   
//            
//        }
             
        if(error==true){
            return false;
        }
    }

</script>    
                    
