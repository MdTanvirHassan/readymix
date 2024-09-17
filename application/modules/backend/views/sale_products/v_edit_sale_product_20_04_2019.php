 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; ">Edit Product Information </h2>
            <hr>
            <form action="<?php echo site_url('sale_products/edit_sale_product_action/'.$sale_product_info[0]['product_id']); ?>" method="post">
                
                
                <div class="row">
                
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Name <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="product_name" type="text" value="<?php if(!empty($sale_product_info[0]['product_name'])) echo $sale_product_info[0]['product_name']; ?>"></div>
                        </div>
                    </div>
                    
                     <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Category<sup style="color:red;">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 ">
                                <select required id="payment_condition" class="form-control" name="category_id">
                                    <option class="form-control" value="">Select Category</option>
                                    <?php foreach($categories as $category){ ?>
                                        <option <?php if($sale_product_info[0]['category_id']==$category['category_id']) echo 'selected'; ?> class="form-control" value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                                    <?php } ?>    
                                    
                                    
                               </select>
                            </div>
                        </div>
                   </div>
                   
                </div>
                 <div class="row">      
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Code <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 "><input readonly required class="form-control" id="inputdefault" name="p_code" type="text" value="<?php if(!empty($sale_product_info[0]['p_code'])) echo $sale_product_info[0]['p_code']; ?>"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3   labeltext" style="text-align: right"><label for="inputdefault">PSI <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="p_psi" type="text" value="<?php if(!empty($sale_product_info[0]['p_psi'])) echo $sale_product_info[0]['p_psi']; ?>"></div>
                        </div>
                    </div>
                   
                </div>
                
                 <div class="row">      
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">M. Unit <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="measurement_unit" type="text" value="<?php if(!empty($sale_product_info[0]['measurement_unit'])) echo $sale_product_info[0]['measurement_unit']; ?>"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3   labeltext" style="text-align: right"><label for="inputdefault">Specification <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="specification" type="text" value="<?php if(!empty($sale_product_info[0]['specification'])) echo $sale_product_info[0]['specification']; ?>"></div>
                        </div>
                    </div>
                    
                   
                </div>
                <div class="row">      
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Performance: <sup style="color:red">*</sup> :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="performance" type="text" value="<?php if(!empty($sale_product_info[0]['performance'])) echo $sale_product_info[0]['performance']; ?>"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3   labeltext" style="text-align: right"><label for="inputdefault">Remarks  :</label></div>
                            <div class="col-sm-8 col-md-5 "><input  class="form-control" id="inputdefault" name="remark" type="text" value="<?php if(!empty($sale_product_info[0]['remark'])) echo $sale_product_info[0]['remark']; ?>"></div>
                        </div>
                    </div>
                    
                     
                   
                </div>
                
                <hr>
               
     
              
                
                
                <div class="row">
                   
                        <div class="row">
                            <div class="col-md-2 col-md-offset-3">
                                <button type="submit" class="btn btn-primary button">UPDATE</button>
                            </div>
                            <div class="col-md-2">
                                <a href="<?php echo site_url('backend/sale_products') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                          </div>       
                 
                </div>
                   
                    <div class="col-md-2">
                        <div class="row">
                  <!--          
                    <div class="col-md-12">
                        <button type="button" class="btn btn-default button">SIMILAR LIST</button>
                    </div>-->
                        </div>
                    </div>
                </div>
                
            </form>
        </div>

    <script type="text/javascript">
      

    </script>
                    
