<?php
    $user_id = $this->session->userdata('user_id');
    $user_type = $this->session->userdata('user_type');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(1, 4, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
       <?php require_once(__DIR__ .'/../logistics_ware_house_header.php'); ?>   
    
    </div>
    
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Opening Stock</h3>
            </div>
        </div>
    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 <div class="x_content">
                     <form class="form-horizontal" action="<?php echo site_url('general_store/editOpeningStockAction/'.$opening_stock_info[0]['id']); ?>" method="post" enctype="multipart/form-data">
                         
                                              
                         <div class='form-group' >
                                 <label for="title" class="col-sm-2 control-label">
                                    Material Name<sup style="color:red;">*</sup> :
                                </label>
                                     <div class="col-sm-4 input-group">
                                      <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                      <select required  id="item_id" class="form-control e1" name="item_id" onchange="javascript:brand_info();">
                                           <option class="form-control" value="">Select Item</option>
                                           <?php foreach($items as $item){ ?>
                                                <option <?php if($item['id']==$opening_stock_info[0]['item_id']) echo "selected"; ?> class="form-control" value="<?php echo $item['id']; ?>"><?php echo $item['item_name']; ?></option>
                                           <?php } ?>     
                                       </select>
                                </div>
                             
                                
                                <label for="title" class="col-sm-2 control-label">
                                    Brand<sup style="color:red;">*</sup> :
                                </label>
                                     <div class="col-sm-4 input-group">
                                         <span class="input-group-addon"><i class="fa fa-weibo"></i></span>
                                         <select   id="brand_id" class="form-control e1" name="brand_id" >
                                            <option class="form-control" value="">Select brand</option>
                                            <?php foreach($item_brands as $brd){ ?>
                                                <option <?php if($brd['id']==$opening_stock_info[0]['brand_id']) echo "selected"; ?> class="form-control" value="<?php echo $brd['id']; ?>"><?php echo $brd['brand_name']; ?></option>
                                            <?php } ?>    
                                        </select>
                                </div>
                             
                               
                         </div>
                         
                       
                      
                         
                         
                         
                        <div class='form-group' >
                            
                        <label for="title" class="col-sm-2 control-label">
                            Quantity :
                        </label>
                        <div class="col-sm-4 input-group">
                            <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                            <input required class="form-control" id="inputdefault" name="opening_stock" type="text" value="<?php echo $opening_stock_info[0]['opening_stock'] ?>">
                        </div>
                            
                        <label for="title" class="col-sm-2 control-label">
                            Amount :
                        </label>
                        <div class="col-sm-4 input-group">
                            <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                            <input class="form-control" id="inputdefault" name="opening_amount" type="text" value="<?php echo $opening_stock_info[0]['opening_amount'] ?>">
                        </div>    
                            
                            
                         </div>
                         
                         
                         
                         
                         
                    
                         
                         
                         
                     
                         
                         
                         <div class="form-group" style="margin-top: 40px;">
                              <div class="col-sm-2">
                                <a href="<?php echo site_url('backend/general_store/openingStock') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
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
    $('.select2').select2(); 
    function brand_info(){

         var item_id=$('#item_id').val();
         
         $.ajax({
             type: "POST",
             url: "backend/general_store/getBrandInfo",
             data: "item_id="+item_id,
             dataType: "json",
             success: function (data) {
               
                var str ='';
                str +='<option class="form-controll" value="">Select Brand</option>';
                $(data.item_brands).each(function (row,v){
                  
                   str += '<option class="form-controll" value="'+v.id+'">'+v.brand_name+'</option>';
                })
                $('#brand_id').html(str);
             }         
         })
     }
                    
                    
                   
                
</script>