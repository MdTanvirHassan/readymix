<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Department</h3>
            </div>
        </div>
    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 <div class="x_content">
                     <form class="form-horizontal" action="<?php echo site_url('department/edit_department_action/'.$department_info[0]['id']); ?>" method="post">
                         
                         
                         <div class='form-group' >
                        <label for="title" class="col-sm-2 control-label">
                            Name <sup style="color:red">*</sup>:
                        </label> 
                              <div class="col-sm-4 input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <input required  class="form-control" id="inputdefault" name="dept_name" type="text" value="<?php if(!empty($department_info[0]['dept_name'])) echo $department_info[0]['dept_name'];  ?>">
                        </div>
                            <label for="title" class="col-sm-2 control-label">
                            Description :
                        </label>
                             <div class="col-sm-4 input-group">
                                 <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                 <input  class="form-control" id="inputdefault" name="description" type="text" value="<?php if(!empty($department_info[0]['description'])) echo $department_info[0]['description'];  ?>">
                        </div>
                             
                         </div>
                         
                         
                       
                         
                         
                         <div class="form-group" style="margin-top: 40px;">
                             <div class="col-sm-2">
                                <a href="<?php echo site_url('backend/department') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
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
