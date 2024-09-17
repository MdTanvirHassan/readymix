<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(7, 27, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>All Collection and Realization List</h3>
            </div>
        </div>
        <div class="row">
                        <div id="remover" class="col-md-6 col-md-offset-3">
                            <form id="item-form" action="<?php site_url('backend/payment_collections/allCollectionAndRealization'); ?>" method="post" autocomplete="off">
                            <div class="row">
                                    <div style="margin-top: 15px;" class="col-md-10 col-md-offset-1">
                                      <select  class="form-control e1" placeholder="Select Customer" id="customer_id" name="customer_id" onchange="javascript:project_info();" >
                                          <option value="" >Select customer</option>
                                        <?php foreach($customers as $customer){ ?>
                                           <option <?php if($customer_id==$customer['id']) echo 'selected'; ?>  value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option> 
                                        <?php } ?>    
                                         

                                     </select>

                                 </div>
                            </div><!--End Row-->  
                            
                            
                           
                            
                            
                            
                        <div class="row">
                                    <div style="margin-top: 15px;" class="col-md-10 col-md-offset-1">
                                      <select  class="form-control e1" placeholder="Select Type" id="collection_method" name="collection_method" >
                                        <option value="" >Select Mode</option>
                                        <option <?php if($collection_method=="Pdc") echo "Selected"; ?> value="Pdc">Cheque/Pdc</option>
                                        <option <?php if($collection_method=="Bg") echo "Selected"; ?> value="Bg">Bg</option> 
                                        <option <?php if($collection_method=="Lc") echo "Selected"; ?> value="Lc">Lc</option> 
                                        <option <?php if($collection_method=="Po") echo "Selected"; ?> value="Po" >Po</option> 
                                        <option <?php if($collection_method=="O.Cash") echo "Selected"; ?> value="O.Cash" >O.Cash</option>
                                        <option <?php if($collection_method=="Cash") echo "Selected"; ?> value="Cash" >Cash</option> 

                                     </select>

                                 </div>
                         </div><!--End Row-->    
                            
                            
                           
                          <div class="row">  
                            
                                <div style="margin-top: 15px;" class="col-md-5 col-md-offset-1">
                                    <input  type="text" name="from_date" class="form-control datepicker" value="<?php if(!empty($f_date)) echo $f_date; ?>" placeholder="From Date"/>
                                </div>

                                 <div style="margin-top: 15px;" class="col-md-5 ">
                                    <input  type="text" name="to_date" class="form-control datepicker" value="<?php if(!empty($to_date)) echo $to_date; ?>" placeholder="To Date"/>
                                </div>
                          </div><!--End Row-->    

                           
                          
                            <div class="clearfix"></div>
                            <div style="margin-top: 15px;" class="col-md-12">

                                <div class="col-md-8 col-md-offset-3">
<!--                                    <input style="padding: 6px 40px;" type="submit" class="btn btn-primary" value="SEARCH"/>
                                    <input style="padding: 6px 40px;" type="button" id="print_div" class="btn btn-primary" value="PRINT"/>-->
                                     <input id="form-submit" style="padding: 6px 40px;" type="submit" class="btn btn-primary" value="SEARCH"/>
                                   <!--  <a  href="javascript:" class="btn btn-info" onclick="submitForm('excel')">EXCEL</a>-->
                                    
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
          
          
        
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
       
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="">Receive Date</th>
                <!--<th class="col-lg-1">Order No.</th>-->
                <th class="">Customer Name</th>
                <th class="">MRR. NO.</th>
               
                <th class="">Mode of Payment</th>
                <th class="">Pdc/Lc/Bg No</th>
                 <th class="">Pdc/Lc/Bg Date</th>
                <th class="">Amount</th> 
                <th class="">R. Status</th>
                <th class="">Deposit Date</th>
                <th class="">Honor Date</th>
                <th class="">Honor Status</th>
                <th class="">Remark</th>
                <th class="">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($collections)) {
                foreach ($collections as $collection) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($collection['receive_date'])) echo date('d-m-Y',strtotime($collection['receive_date'])); ?>
                        </td>
<!--                        <td>
                            <?php if(!empty($collection['order_no'])) echo $collection['order_no']; ?>
                        </td>-->
                         <td>
                             <?php if(!empty($collection['c_name'])) echo $collection['c_name']; ?>
                        </td>
                        
                        <td>
                             <?php if(!empty($collection['mrr_no'])) echo $collection['mrr_no']; ?>
                        </td>
                        
                        
                        
                        <td>
                            <?php if(!empty($collection['collection_method'])) echo $collection['collection_method']; ?>
                        </td>
                        
                       <td>
                            <?php if(!empty($collection['no'])) echo $collection['no']; ?>
                       </td>
                       
                       
                       
                    <?php if(!empty($collection['bg_issue_date'])){ ?>    
                        <td>
                            <?php if(!empty($collection['bg_issue_date'])) echo date('d-m-Y',strtotime($collection['bg_issue_date'])); ?>
                        </td>
                    <?php }else if(!empty($collection['check_date'])){ ?>    
                        <td>
                            <?php if(!empty($collection['check_date'])) echo date('d-m-Y',strtotime($collection['check_date'])); ?>
                        </td>
                    <?php }else if(!empty($collection['po_date'])){ ?>    
                        <td>
                            <?php if(!empty($collection['po_date'])) echo date('d-m-Y',strtotime($collection['po_date'])); ?>
                        </td>
                    <?php }else if(!empty($collection['lc_date'])){ ?>    
                        <td>
                            <?php if(!empty($collection['lc_date'])) echo date('d-m-Y',strtotime($collection['lc_date'])); ?>
                        </td>
                    <?php }else{ ?>
                        <td>
                            
                        </td>
                    <?php } ?>    
                        
                        
                        
                        
                        <td style="text-align: right;">
                            <?php if(!empty($collection['amount'])) echo number_format($collection['amount'],2); ?>
                        </td>
                       
                        <td>
                            <?php if(!empty($collection['payment_status'])) echo $collection['payment_status']; ?>
                        </td>

                        <td>
                           <?php if(!empty($collection['deposit_date'])) echo date('d-m-Y',strtotime($collection['deposit_date'])); ?> 
                        </td>
                        <td>
                           <?php if(!empty($collection['realization_date'])) echo date('d-m-Y',strtotime($collection['realization_date'])); ?> 
                        </td>
                        <td>
                            <?php echo $collection['realization_status']; ?>
                       </td>
                       <td>
                             <?php if(!empty($collection['remark'])) echo $collection['remark']; ?>
                        </td>
                        <td>
                                <?php if($collection['payment_status']=="Returned"){ ?>

                                       <button onclick="activateCollection('<?php echo $collection['id']; ?>')" class="btn btn-sm btn-warning">Activate</button>

                                <?php } ?> 
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
          <h4 class="modal-title" id="h__status">Payment Activation</h4>
        </div>
        <div class="modal-body">
            
             <input type="hidden" id="collection_id" class="form-control " value="" />            
             <input style="position:relative;"  type="text" id="cheque_date" class="form-control datepicker1" value="<?php //echo date('d-m-Y'); ?>" placeholder="Reason" autocomplete="off"  />
            
            <span id="return_reason_error" style="color:red;"></span>
        </div>
        <div class="modal-footer">
            <button onclick="activeCollectionAction()" class="btn btn-sm btn-primary">Submit</button>
          <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>



<script type="text/javascript">
    
    
 $(".datepicker1").datepicker({
    dateFormat: 'dd-mm-yy',
    beforeShow: function (input, inst) {
        setTimeout(function () {
            inst.dpDiv.css({
                top: 150,
                left: 420
            });
        }, 0);
    }
});
    
   function activateCollection(id){        
      $('#collection_id').val(id);
      $('#myModal').modal('show');
   }
    
    
     function activeCollectionAction(){
        
        var collection_id=$('#collection_id').val();       
        var cheque_date=$('#cheque_date').val();
        
       
         $.ajax({
                url: '<?php echo site_url('payment_collections/active_collection'); ?>',
                data:{'collection_id':collection_id,'cheque_date':cheque_date},
                method:'POST',
                dataType:'json',
                success: function (msg) { 
                    if(msg.status=='success'){
                        $('#collection_id').val('');
                        $('#cheque_date').val('');
                        $('#myModal').modal('hide');
                        location.reload(true);
                    }    
                }

        })
    } 
    
    
    
    
   function active_account(url){
        bootbox.confirm({
            message: "<div class='boot-header'>ARE YOU SURE TO ACTIVE THE CHEQUE ?</div>",
            buttons: {
                confirm: {
                    label: 'YES, ACTIVE',
                    className: 'boot-confirm'
                },
                cancel: {
                    label: 'CANCEL',
                    className: 'boot-no'
                }
            },
            callback: function (result) {
                if (result == true)
                    location.href = url;

            }
        });
    } 
    
</script>