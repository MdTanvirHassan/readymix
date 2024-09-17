<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
         <?php       
            require_once(__DIR__ .'/../../rm_setup_header.php');
        ?>
    </div>

    <div class="right_content">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Cost Head</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <form class="form-horizontal" action="<?php echo site_url('raw_materials/landed_cost_head/edit_landed_cost_head_action/'.$head_info[0]['id']); ?>" method="post" onsubmit="javascript: return validation()">
       
        
        <div class='form-group' >
                <label for="title" class="col-sm-2 control-label">
                    Name<sup class="required">*</sup>  :
                </label> 
                <div class="col-sm-4 input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input  class="form-control" id="name" name="name" type="text" placeholder="Short Name"  value="<?php if(!empty($head_info[0]['name'])) echo $head_info[0]['name']  ?>">
        <span id="name_error" style="color:red"></span>
                </div>
                <label for="title" class="col-sm-2 control-label">
                  Description :
                </label>
                <div class="col-sm-4 input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input   class="form-control" id="description" name="description" type="text" placeholder="Description"  value="<?php if(!empty($head_info[0]['description'])) echo $head_info[0]['description'];  ?>">
                    <span id="description_error" style="color:red"></span>
                </div>

       </div>
        
        
        
        
        
        

        <div class="form-group" style="margin-top: 40px;">
            
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/raw_materials/landed_cost_head') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
                                </div>
            
                                <div class=" col-sm-2">
                                    <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">UPDATE</button>
                                </div>
                               
                            </div>

            
        
    </form>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
     function validation(){
       
        var name=$('#name').val();        
        var error=false;
                           
        if(name==''){
            $('#name').css('border','1px solid red');
            $('#name_error').html('Please fill name field');
            error=true;

        }else{
            $('#name').css('border','1px solid #ccc');
            $('#name_error').html('');

        }
            
               
        if(error==true){
            return false;
        }
    }

</script>    