<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Deposit</h2>
    <hr>
    <form action="<?php echo site_url('deposit_realization/edit_deposit_action/'.$deposit_info[0]['id']); ?>" method="post">
        <div class="row">
            <div class="col-md-6">
                    <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Instrmnt<sup style="color:red;">*</sup> :</label></div>
                <div class="col-sm-8 col-md-5 ">
                        <select id="collection_id" class="form-control" name="collection_id">
                            <option class="form-control" value="">Select Collection</option>
                            <?php foreach($collections as $collection){ ?>
                                <option <?php if($deposit_info[0]['collection_id']==$collection['id']) echo 'selected'; ?> class="form-control" value="<?php echo $collection['id'] ?>"><?php echo $collection['collection_method'].'('.$collection['no'].')' ?></option>
                            <?php } ?>
                       </select>
                    </div>
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Deposit. Date<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                         <input id="deposit_date" required class="form-control datepicker" name="deposit_date" type="text" value="<?php if(!empty($deposit_info[0]['deposit_date'])) echo date('d-m-Y',strtotime($deposit_info[0]['deposit_date'])); ?>">
                    </div>
                </div>
            </div>
            
        </div>
          
        <div class="row">
            <div class="col-md-6">
                <div class="form-group tenor row"  >
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Bank :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <input readonly id="bank" class="form-control" name="tenor" type="text" value="<?php if(!empty($deposit_info[0]['b_short_name'])) echo $deposit_info[0]['b_short_name']; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group bg_expire_date row"  >
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Branch :</label></div>
                    <div class="col-sm-8 col-md-5 "><input readonly id="branch" class="form-control " name="bg_expire_date" type="text" value="<?php if(!empty($deposit_info[0]['branch_name'])) echo $deposit_info[0]['branch_name']; ?>"></div>
                </div>
            </div>
        </div>
        
        
        
       
        <hr>
       
        
       
        
        <div class="row">
           
            <div class="col-md-2 col-md-offset-3">
                <button type="submit" class="btn btn-primary button">UPDATE</button>
            </div>
             <div class="col-md-2">
                <a href="<?php echo site_url('backend/deposit_realization') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

            </div>
        </div> 
            
        </div>
    </form>
</div>

<script type="text/javascript">
    
    $('#collection_id').change(function(){
        var id= $('#collection_id').val();
        if(id!=''){
            $.ajax({
                        url: '<?php echo site_url('deposit_realization/get_collection_info'); ?>',
                        data:{'id':id},
                        method: 'POST',
                        dataType: 'json',
                        success: function (msg) { 
                            if(msg.collection_info!=''){
                                if(msg.collection_info[0].collection_method=="Pdc"){
                                    $('#deposit_date').val(msg.collection_info[0].check_date);
                                }else if(msg.collection_info[0].collection_method=="Po"){
                                    $('#deposit_date').val(msg.collection_info[0].po_date);
                                }else if(msg.collection_info[0].collection_method=="Bg"){
                                    $('#deposit_date').val(msg.collection_info[0].bg_expire_date);
                                }else if(msg.collection_info[0].collection_method=="Lc"){
                                    $('#deposit_date').val(msg.collection_info[0].lc_date);
                                }
                                $('#bank').val(msg.collection_info[0].b_short_name);
                                $('#branch').val(msg.collection_info[0].branch_name);
                            }    
                        }

             })
         }else{
            $('#deposit_date').val('');
            $('#bank').val('');
            $('#branch').val('');
         }
        
    });
    
 
   
    
    
    
    
   
</script>



