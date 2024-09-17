 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Term Condition</h3>
            </div>
        </div>
    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 <div class="x_content">
                     <form class="form-horizontal" action="<?php echo site_url('termcondition_template/edit_term_condition_action/'.$term_condition_info[0]['id']) ?>" method="post">
                         
                         
                         <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                  Item Name<sup style="color:red">*</sup> :
                                 </label> 
                                 <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input required class="form-control" id="inputdefault" name="template_name" type="text" value="<?php echo $term_condition_info[0]['template_name'] ?>">
                                 </div>
                                

                           </div>
                         
                    
                         <div class="separator-shadow"></div>
        
        
        <h2 style="text-align:center; ">Terms & Conditions</h2>
       
        <button  type="button" style="display:none;padding-left:6px;padding-right:6px;font-size:8px;" id="specification_show_button"  class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span></button>
        <div id="specification_raw_material">
            <div class="">
                  <?php 
                    $total_condition=count($term_condition_details);
                ?>
            <input type="hidden" value="<?php echo $total_condition; ?>" id="material_count">
                <table class="table table-bordered" id="specificationTable">
                    <thead>
                     <tr >
                        
                         <th>Term or Condition Name</th>
                         <th>Description</th>
                         <th><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="m_specification"  class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span></button></th>
                      </tr>
                    </thead>
                    <tbody id="material_specification">
                          <?php
                      if($total_condition>0){ 
                            $j=0;
                           foreach($term_condition_details as $con){
                               $j++;
                          ?>  
                        
                            <tr  id="term_row_<?php echo $j; ?>">
                                <td><input required style="width:200px"   type="text"  name="title[]"  class="issue form-control" value="<?php echo $con['title']; ?>"></td>
                                <td>
                                   
                                    <textarea required style="width:700px"  name="description[]" class="issue form-control"><?php echo $con['description']; ?></textarea>
                                </td>
                                <td><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="c_button" onclick="removeTerms(<?php echo $j; ?>)" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td> 
                            </tr> 
                           <?php } } ?>   
                      
                    </tbody>
                     
                  </table>
             
        </div> 
        </div> 
                         
                         
                      <div class="form-group" style="margin-top: 40px;">
                          
                        <div class="col-sm-2">
                            <a href="<?php echo site_url('backend/termcondition_template') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
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


<script type="text/javascript">

 
   //Hide Show Start  
       
    $('#specification_hide_button').click(function(){
        $('#specification_raw_material').hide();
        $('#specification_show_button').show();
        $('#specification_hide_button').hide();
    });
    
    $('#specification_show_button').click(function (){
        $('#specification_raw_material').show();
        $('#specification_hide_button').show();
        $('#specification_show_button').hide();
        
    });
        
  //HIde Show End  
        
    $('#m_specification').click(function () {
        var count = $('#material_count').val();
        var str= '<tr  id="term_row_' + (Number(count) + 1) + '">';
        
        str +='<td><input required  style="width:200px"  type="text"  name="title[]"  class="issue form-control"></td>';
        str +='<td><textarea required  style="width:700px" name="description[]"  class="issue form-control"></textarea></td>';
        str +='<td><button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeTerms(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>'; 
        str +='</tr>';      
        $('#material_count').val(Number(count) + 1);
        $('#specificationTable').append(str);
        
    });
    
     function removeTerms(row) {
        var count = $('#material_count').val();
        $('#material_count').val(Number(count)-1);
        $('#term_row_' + row).remove();
       
    }
    
    
    

   
</script>



<script>
$('.select2').select2();
</script>

