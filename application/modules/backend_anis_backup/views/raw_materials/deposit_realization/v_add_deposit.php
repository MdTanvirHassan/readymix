<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    
     <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Add Deposit</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal" action="<?php echo site_url('raw_materials/deposit_realization/add_deposit_action'); ?>" method="post">
        
                            
                            
                            <div class='form-group' style="margin-bottom:15px;" >
                                <label for="title" class="col-sm-2 control-label">
                                     Select customer<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                     <select  class="form-control e1" placeholder="Select Customer" id="customer_id" name="customer_id" onchange="javascript:collection_info();" >
                                          <option value="" >Select customer</option>
                                        <?php foreach($customers as $customer){ ?>
                                           <option <?php if($customer_id==$customer['id']) echo 'selected'; ?>  value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option> 
                                        <?php } ?>    
                                         

                                     </select> 
                                    <span id="do_id_error" style="color:red"></span>
                                </div>


                            </div> 
                            
                            
                            <div class='form-group' >
                                
                                <label for="title" class="col-sm-2 control-label">
                                    Deposit. Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input id="deposit_date" required class="form-control datepicker1" name="deposit_date" type="text" value="<?php echo date('d-m-Y'); ?>">
                                </div>

                            </div>
                            
                            <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                   Bank<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-6 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select required id="o_id" class="form-control e1" name="bank_id">
                                    <option class="form-control" value="">Select Bank</option>
                                    <?php foreach($banks as $bank){ ?>
                                        <option class="form-control" value="<?php echo $bank['id'] ?>"><?php echo $bank['b_short_name'].'('.$bank['branch_name'].')'.'('.$bank['b_account_no'].')'; ?></option>
                                    <?php } ?>
                               </select>
                                </div>
                               

                            </div>
                            
                        <!--    
                             <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                    Remark<sup class="required"></sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control " name="remark" type="text" value="">
                                </div>
                                

                            </div>
                            
                        -->
        
        
       
                    <div class="row">
                                <input type="hidden" value="1" id="count" />
                                <table class="table table-bordered" id="myTable" >
                                    <thead class="thead-color">
                                        <tr >
                                            <th>Payment Collection Mode</th>
                                            <th>MRR. NO.</th>
                                            <th>Pdc/Bg/Lc NO.</th>
                                            
                                            <th>Pdc/Bg/Lc Date</th>
                                            <th>Amount</th> 
                                            <th>Status</th> 
                                            <th><input type="checkbox" id="allselect" ></th>

                                        </tr>
                                    </thead>
                                    <tbody id="collections">


                                    </tbody>
                                    <tfoot>
                                       
                                    </tfoot>
                                </table>




        </div>                 
                        
                        
        
       
        <div class="form-group" style="margin-top: 40px;">
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/raw_materials/deposit_realization') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
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

<script type="text/javascript">
    
    
    $(".datepicker1").datepicker({
        dateFormat: 'dd-mm-yy',
    
    });
    
    
    
    $('#allselect').click(function(){
        if($(this).is(':checked')==true){
            $('.each_select').prop('checked',true);           
        }else{            
            $('.each_select').prop('checked',false);            
        }
    })
    
    
    
    
     function collection_info(){
            
            var customer_id=$('#customer_id').val();
            if(customer_id!=''){
                $.ajax({
                    type: "POST",
                    url: "backend/raw_materials/deposit_realization/collection_info",
                    data: "customer_id="+customer_id,
                    dataType: "json",
                    success: function (data) {                                                       
                        var str = '';
                            var total = 0;
                            if(data.collections!=''){
                                $(data.collections).each(function (i,v) {
                                    

                                    str += '<tr>';
                                    str += '<td>'+v.collection_method+'</td>';
                                    if(v.mrr_no!=null){
                                        str += '<td>'+v.mrr_no+'</td>';
                                    }else{
                                        str += '<td></td>';
                                    }
                                    str += '<td>'+v.no+'</td>';
                                    if(v.collection_method=='Pdc'){
                                        if(v.check_date!=null){
                                            str += '<td>'+v.check_date+'</td>';
                                        }else{
                                            str += '<td></td>';
                                        }    
                                    }else if(v.collection_method=='Bg'){
                                        if(v.bg_expire_date!=null){
                                            str += '<td>'+v.bg_expire_date+'</td>';
                                        }else{
                                            str += '<td></td>';
                                        }
                                    }else if(v.collection_method=='Po'){
                                        if(v.po_date!=null){
                                            str += '<td>'+v.po_date+'</td>';
                                        }else{
                                            str += '<td></td>';
                                        }
                                    }else if(v.collection_method=='Lc'){
                                        if(v.lc_date!=null){
                                            str += '<td>'+v.lc_date+'</td>';
                                        }else{
                                            str += '<td></td>';
                                        }
                                    }else{
                                        str += '<td></td>';
                                    }    
                                    str += '<td style="text-align:right;">'+v.amount+'</td>';
                                    str += '<td>'+v.payment_status+'</td>';
                                    
                                    str += '<td><input   style="width:40px;"  type="checkbox"  name="collection_id[]" id="select_product_' + (Number(i) + 1) + '" class="each_select select_product_' + (Number(i) + 1) + '" value="'+v.id+'"></td>';
                                    str += '</tr>';
                                });
                            }else{
        
                            }

                                  
                            $('#collections').html(str);
                    }         
                })
          }else{
              
           $('#collections').html(''); 
          
          }  
      }
    
    
    
    $('#collection_id').change(function(){
        var id= $('#collection_id').val();
        if(id!=''){
            $.ajax({
                        url: '<?php echo site_url('raw_materials/deposit_realization/get_collection_info'); ?>',
                        data:{'id':id},
                        method: 'POST',
                        dataType: 'json',
                        success: function (msg) { 
                            if(msg.collection_info!=''){
//                                if(msg.collection_info[0].collection_method=="Pdc"){
//                                    $('#deposit_date').val(msg.collection_info[0].check_date);
//                                }else if(msg.collection_info[0].collection_method=="Po"){
//                                    $('#deposit_date').val(msg.collection_info[0].po_date);
//                                }else if(msg.collection_info[0].collection_method=="Bg"){
//                                    $('#deposit_date').val(msg.collection_info[0].bg_expire_date);
//                                }else if(msg.collection_info[0].collection_method=="Lc"){
//                                    $('#deposit_date').val(msg.collection_info[0].lc_date);
//                                }
//                                $('#bank').val(msg.collection_info[0].b_short_name);
//                                $('#branch').val(msg.collection_info[0].branch_name);
                            }    
                        }

             })
         }else{
            $('#deposit_date').val('');
//            $('#bank').val('');
//            $('#branch').val('');
         }
        
    });
    
 
   
    
    
    
    
   
</script>



