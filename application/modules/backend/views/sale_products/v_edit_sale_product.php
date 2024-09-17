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
                <h3>Edit Product</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal" action="<?php echo site_url('sale_products/edit_sale_product_action/'.$sale_product_info[0]['product_id']); ?>" method="post" onsubmit="javascript: return validation()">
                
                
               
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Code<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input readonly required class="form-control" id="inputdefault" name="p_code" type="text" value="<?php if(!empty($sale_product_info[0]['p_code'])) echo $sale_product_info[0]['p_code']; ?>">
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Name<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="product_name" name="product_name" type="text" placeholder="Product Name" value="<?php if(!empty($sale_product_info[0]['product_name'])) echo $sale_product_info[0]['product_name']; ?>">
                                    <span id="product_name_error" style="color:red"></span>
                                </div>

                            </div>
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    S. Name<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select  id="category_id" class="form-control" name="category_id" onchange="javascript:group_item_id();">
                                    <option class="form-control" value="">Select Category</option>
                                    <?php foreach($categories as $category){ ?>
                                        <option <?php if($sale_product_info[0]['category_id']==$category['category_id']) echo 'selected'; ?> class="form-control" value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                                    <?php } ?>    
                                    
                                    
                               </select>
                                    <span id="category_id_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Measurement Unit<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="measurement_unit" name="measurement_unit" type="text" placeholder="Measurement Unit" value="<?php if(!empty($sale_product_info[0]['measurement_unit'])) echo $sale_product_info[0]['measurement_unit']; ?>">
                                    <span id="measurement_unit_error" style="color:red"></span>
                                </div>

                            </div>
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    PSI<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="p_psi" onkeyup="javascript:convertToMpa();" onchange="javascript:convertToMpa();" name="p_psi" type="text" placeholder="PSI" value="<?php if(!empty($sale_product_info[0]['p_psi'])) echo $sale_product_info[0]['p_psi']; ?>">
                                    <span id="p_psi_error" ></span>
                                </div>
                                
                                
                                <label for="title" class="col-sm-2 control-label">
                                    Mpa<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="mpa" onkeyup="javascript:convertToPsi();" onchange="javascript:convertToPsi();" name="mpa" type="text" placeholder="MPA" value="<?php if(!empty($sale_product_info[0]['mpa'])) echo $sale_product_info[0]['mpa']; ?>">
                                    <span id="p_psi_error"></span>
                                </div>
                                

                            </div>
                            
                            <label for="title" class="col-sm-2 control-label">
                                    Performance<sup class="required"></sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <input  class="form-control" id="performance" name="performance" type="text" placeholder="Performance" value="<?php if(!empty($sale_product_info[0]['performance'])) echo $sale_product_info[0]['performance']; ?>">
                                   <span id="performance_error" style="color:red"></span>
                                </div>
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Specification<sup class="required"></sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="specification" name="specification" type="text" placeholder="Specification" value="<?php if(!empty($sale_product_info[0]['specification'])) echo $sale_product_info[0]['specification']; ?>">
                                   <span id="specification_error" style="color:red"></span>
                                </div>
                                

                            </div>
                            
                            
                            <div class='form-group' >
                               
                                <label for="title" class="col-sm-2 control-label">
                                    Remark<sup class="required"></sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <textarea rows="3" class="form-control" id="remark" name="remark" placeholder="Remark"><?php if(!empty($sale_product_info[0]['remark'])) echo $sale_product_info[0]['remark']; ?></textarea>
                                 
                                   <span id="remark_error" style="color:red"></span>
                                </div>

                            </div>
                            

                
               
                   <div class="form-group" style="margin-top: 40px;">
                                 <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/sale_products') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
                                </div>
                       
                                <div class=" col-sm-2">
                                    <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">UPDATE</button>
                                </div>
                               
                            </div>


<!--                        <div class="row">
                           <div class="col-md-1 col-md-offset-3">
                                <a href="<?php echo site_url('backend/sale_products') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">REGISTER</button> </a>
                          </div>      
                           <div class="col-md-2 ">
                                <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">UPDATE</button>
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
        
       function convertToMpa(){
             var psi=$('#p_psi').val();
             var mpa=psi/145;
             var net_mpa=mpa.toFixed(0);
             $('#mpa').val(net_mpa);
            
        }
        
        
        function convertToPsi(){
      
             var mpa=$('#mpa').val();
             var net_psi=mpa*145;
             $('#p_psi').val(net_psi);
            
        }  
        
        
      function validation(){
        var product_name=$('#product_name').val();
        var category_id=$('#category_id').val();
        var measurement_unit=$('#measurement_unit').val();
         
        var error=false;
        
        if(product_name==''){
            $('#product_name').css('border','1px solid red');
            $('#product_name_error').html('Please fill name field');
            error=true;
           
        }else{
            $('#product_name').css('border','1px solid #ccc');
            $('#product_name_error').html('');
            
        }
        if(category_id==''){
            $('#category_id_error').html('Please fill category field');
            $('#category_id').css('border','1px solid red');
            error=true;
        }else{
            $('#category_id_error').html('');
            $('#category_id').css('border','1px solid #ccc');   
            
        }
        
         if(measurement_unit==''){
            $('#measurement_unit_error').html('Please fill measurement unit field');
            $('#measurement_unit').css('border','1px solid red');
            error=true;
        }else{
            $('#measurement_unit_error').html('');
            $('#measurement_unit').css('border','1px solid #ccc');  
             
        }
        
        
        if(error==true){
            return false;
        }
    }

    </script>
                    
