 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; ">Edit Material </h2>
            <hr>
            <form action="<?php echo site_url('materials/edit_material_action/'.$material_info[0]['m_id']); ?>" method="post">
                
                
                <div class="row">
                
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right"><label for="inputdefault">Name<sup style="color:red;">*</sup>  :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="m_name" type="text" value="<?php if(!empty($material_info[0]['m_name'])) echo $material_info[0]['m_name']; ?>"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3   labeltext" style="text-align: right"><label for="inputdefault">Description :</label></div>
                            <div class="col-sm-8 col-md-5 "><input class="form-control" id="inputdefault" name="m_description" type="text" value="<?php if(!empty($material_info[0]['m_description'])) echo $material_info[0]['m_description']; ?>"></div>
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
                                <a href="<?php echo site_url('backend/materials') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

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
                    