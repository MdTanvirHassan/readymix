<style>
    .btn-sm{
        padding:2px 5px !important;
    }
    #datepicker { position: relative; z-index: 10000; }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(7, 28, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; ">Deposit List</h2>
    <hr>-->
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Deposit Return List</h3>
            </div>
        </div>
         <div class="row">
            <div id="remover" class="col-md-12">
                <form id="item-form" action="<?php site_url('backend/deposit_realization'); ?>" method="post" autocomplete="off">
                <div class="row">
                        <div style="margin-top: 15px;" class="col-md-4">
                          <select  class="form-control e1" placeholder="Select Customer" id="customer_id" name="customer_id" onchange="javascript:project_info();" >
                              <option value="" >Select customer</option>
                            <?php foreach($customers as $customer){ ?>
                               <option <?php if($customer_id==$customer['id']) echo 'selected'; ?>  value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option> 
                            <?php } ?>    


                         </select>

                     </div>

                     <div style="margin-top: 15px;" class="col-md-4">
                              <select  class="form-control e1" placeholder="Select Type" id="product_id" name="category_id" >
                                <option value="" >Product Type</option>
                                <?php foreach($product_categories as $product_category){ ?>
                                   <option <?php if($category_id==$product_category['category_id']) echo 'selected'; ?>  value="<?php echo $product_category['category_id'] ?>"><?php echo $product_category['category_name'] ?></option> 
                                <?php } ?>    


                             </select>

                         </div>
                         <div style="margin-top: 15px;" class="col-md-4">
                          <select  class="form-control e1" placeholder="Select Type" id="collection_method" name="collection_method" >
                            <option value="" >Select Mode</option>
                            <option <?php if($collection_method=="Pdc") echo "Selected"; ?> value="Pdc">Cheque/Pdc</option>
                            <option <?php if($collection_method=="Bg") echo "Selected"; ?> value="Bg">Bg</option> 
                            <option <?php if($collection_method=="Lc") echo "Selected"; ?> value="Lc">Lc</option> 
                            <option <?php if($collection_method=="Po") echo "Selected"; ?> value="Po" >Po</option> 
                            <!--
                            <option <?php if($collection_method=="O.Cash") echo "Selected"; ?> value="O.Cash" >O.Cash</option>
                            <option <?php if($collection_method=="Cash") echo "Selected"; ?> value="Cash" >Cash</option>
                            -->

                         </select>

                     </div>
                </div><!--End Row-->  

                
               <div class="row">
                            
                 </div><!--End Row-->    
                            
                            
                            
                <div class="row">
                        
                </div><!--End Row-->      
                
                

              <div class="row">  

                    <div style="margin-top: 15px;" class="col-md-4">
                        <input  type="text" name="from_date" class="form-control datepicker" value="<?php if(!empty($f_date)) echo $f_date; ?>" placeholder="From Date"/>
                    </div>

                     <div style="margin-top: 15px;" class="col-md-4 ">
                        <input  type="text" name="to_date" class="form-control datepicker" value="<?php if(!empty($to_date)) echo $to_date; ?>" placeholder="To Date"/>
                    </div>
                    <div style="margin-top: 15px;" class="col-md-8 col-md-4">
<!--                                    <input style="padding: 6px 40px;" type="submit" class="btn btn-primary" value="SEARCH"/>
                        <input style="padding: 6px 40px;" type="button" id="print_div" class="btn btn-primary" value="PRINT"/>-->
                         <input id="form-submit" style="padding: 6px 40px;" type="submit" class="btn btn-primary" value="SEARCH"/>
                       

                    </div>
              </div><!--End Row-->    



                
                </form>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <?php  if (in_array(2, $this->role)) { ?>
        <!-- <a href="<?php echo site_url('deposit_realization/add_deposit'); ?>" class="btn btn-sm btn-primary">ADD DEPOSIT</a> -->
    <?php } ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Deposit Date</th>
                
               
                <th class="col-lg-2">Customer Name</th>
               
                <th class="">MRR. No.</th> 
               
                <th class="">Product Type</th>
                <th class="">Mode of Payment</th>
                <th class="col-lg-1">Pdc/Bg/Lc No.</th>
                <th class="col-lg-1">Pdc/Bg/Lc Date</th>
                <th class="col-lg-1">Bank</th>
                <th class="col-lg-1">Branch</th>
                <th class="">Amount</th>
                <th class="">Remark</th>
                
                
                
            </tr>
        </thead>
        <tbody>
            <?php if (count($deposits)) {
                foreach ($deposits as $deposit) { ?>
                    <tr>
                       <td>
                            <?php if(!empty($deposit['deposit_date'])) echo date('d-m-Y',strtotime($deposit['deposit_date'])); ?>
                        </td>
                      
                        
                        
                        
                        <td>
                            <?php if(!empty($deposit['c_name'])) echo $deposit['c_name']; ?>
                        </td>
                       
                        <td>
                            <?php if(!empty($deposit['mrr_no'])) echo $deposit['mrr_no']; ?>
                        </td>
                       
                         <td>
                            <?php if(!empty($deposit['category_name'])) echo $deposit['category_name']; ?>
                        </td>
                        
                        <td>
                            <?php if(!empty($deposit['collection_method'])) echo $deposit['collection_method']; ?>
                        </td>
                        
                       <td>
                            <?php if(!empty($deposit['no'])) echo $deposit['no']; ?>
                       </td>
                       
                       
                       <?php if(!empty($deposit['check_date'])){ ?>    
                                <td>
                                    <?php if(!empty($deposit['check_date'])) echo date('d-m-Y',strtotime($deposit['check_date'])); ?>
                                </td>
                            <?php }else if(!empty($deposit['bg_issue_date'])){ ?>    
                                <td>
                                    <?php if(!empty($deposit['bg_issue_date'])) echo date('d-m-Y',strtotime($deposit['bg_issue_date'])); ?>
                                </td>
                            <?php }else if(!empty($deposit['po_date'])){ ?>    
                                <td>
                                    <?php if(!empty($deposit['po_date'])) echo date('d-m-Y',strtotime($deposit['po_date'])); ?>
                                </td>
                            <?php }else if(!empty($deposit['lc_date'])){ ?>    
                                <td>
                                    <?php if(!empty($deposit['lc_date'])) echo date('d-m-Y',strtotime($deposit['lc_date'])); ?>
                                </td>
                            <?php }else{ ?>
                                <td>

                                </td>
                            <?php } ?> 
                        
                        
                       <td>
                           <?php if(!empty($deposit['b_short_name'])) echo $deposit['b_short_name']; ?>
                       
                       </td>
                        
                       <td>
                           <?php if(!empty($deposit['branch_name'])) echo $deposit['branch_name']; ?>
                        </td>
                        <td id="damount_<?php echo $deposit['id'] ?>" style="text-align: right;">
                            <?php if(!empty($deposit['amount'])) echo number_format($deposit['amount'],2); ?>
                        </td>
                        
                        
                       
                        <td>
                            <?php if(!empty($deposit['c_remark'])) echo $deposit['c_remark']; ?>
                        </td>
                    

                        
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-header">
          <button id="close1" type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="h__status">Realization Date</h4>
        </div>
        <div class="modal-body">
             <input type="hidden" id="honor_status" class="form-control" value="" />
             <input type="hidden" id="deposit_id" class="form-control " value="" />
            
             <input style="position:relative;" required type="text" id="realization_date" class="form-control datepicker1" placeholder="Date" autocomplete="off"  />
            
            <span id="realization_date_error" style="color:red;"></span>
        </div>
        <div class="modal-footer">
            <button onclick="realizationAction()" class="btn btn-sm btn-primary">Submit</button>
          <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<div class="modal fade" id="return_modal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <form action="<?php echo site_url('deposit_realization/return_deposit_action')?>" method="post">
      <div class="modal-content" >
          
          <div class="modal-header">
            <button id="close1" type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="">Return Deposit</h4>
          </div>
          <div class="modal-body">
               
              <label for="title" class="control-label">
                                     Deposit Amount<sup class="required">*</sup>  :
                                </label> 
                                <input type="hidden" id="diposit_id" name="diposit_id">
                               <input readonly type="text" id="deposit_amount" name="deposit_amount" class="form-control">
                               <label for="title" class="control-label">
                                     Return Date<sup class="required">*</sup>  :
                                </label>
                              <input readonly  required='required' type="text" id="return_date" name="return_date" class="form-control datepicker2" placeholder="Date" autocomplete="off" value="<?php echo date('d-m-Y')?>">
                               <label for="title" class="control-label">Remarks  :</label> 
                          <textarea class="form-control" id="remarks" name="remarks" ></textarea>
                            
          </div>
          <div class="modal-footer">
              <button id="return_submit" type="submit" class="btn btn-sm btn-primary">Submit</button>
            <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
      
      
    </div>
  </div>
   
   
<script type="text/javascript">
   
//    $(function () {
//              $('.datepicker').datepicker({
//                  container:'#myModalId'
//              });
//    });

$(".datepicker1").datepicker({
    dateFormat: 'dd-mm-yy',
    maxDate: new Date,
    beforeShow: function (input, inst) {
        setTimeout(function () {
            inst.dpDiv.css({
                top: 150,
                left: 420
            });
        }, 0);
    }
});
$(".datepicker2").datepicker({
    dateFormat: 'dd-mm-yy',
    maxDate: new Date,
    beforeShow: function (input, inst) {
        setTimeout(function () {
            inst.dpDiv.css({
                top: 220,
                left: 420
            });
        }, 0);
    }
});
    
    function realization(id,h){
        if(h=='dhonor'){
            $('#h__status').html("Dishonor Date");
        }else{
            $('#h__status').html("Honor Date");
        }
        $('#honor_status').val(h);
        $('#deposit_id').val(id);
        $('#myModal').modal('show');
    }
    $('#close').click(function(){
        $('#honor_status').val('');
        $('#deposit_id').val('');
        $('#realization_date').val('');
        $('#realization_date_error').html('');
    });
    $('#close1').click(function(){
        $('#honor_status').val('');
        $('#deposit_id').val('');
        $('#realization_date').val('');
        $('#realization_date_error').html('');
    });
    function realizationAction(){
        var honor_status=$('#honor_status').val();
        var deposit_id=$('#deposit_id').val();
        var realization_date=$('#realization_date').val();
        if(realization_date==''){
            $('#realization_date_error').html('Please fill the date field');
            return false;
        }
       
         $.ajax({
                url: '<?php echo site_url('deposit_realization/realization'); ?>',
                data:{'deposit_id':deposit_id,'realization_date':realization_date,'honor_status':honor_status},
                method: 'POST',
                dataType: 'json',
                success: function (msg) { 
                    if(msg.status=='success'){
                        $('#deposit_id').val('');
                        $('#realization_date').val('');
                        $('#myModal').modal('hide');
                        location.reload(true);
                    }    
                }

        })
    }

    function return_row(id){
      var damount = $('#damount_'+id).text();
      var trimStr = $.trim(damount);
      myStr = trimStr.replace(/,/g, "");
      //alert(myStr);
      $('#deposit_amount').val(myStr);
      $('#diposit_id').val(id);
    $('#return_modal').modal();
    }

    $('#return_submit').click(function(){
        var amount = $('#deposit_amount').val(); 
        var date = $('#return_date').val(); 
        if(amount == ''){
            alert('Please enter the amount');
            return false
        }
        if(date == ''){
            alert('Please enter the date');
            return false
        }
    })
</script>