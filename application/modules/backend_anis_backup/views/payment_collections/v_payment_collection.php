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
                <h3>Payment Collection List</h3>
            </div>
        </div>
        <div class="row">
                        <div id="remover" class="col-md-6 col-md-offset-3">
                            <form id="item-form" action="<?php site_url('backend/payment_collections'); ?>" method="post">
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
                                      <select  class="form-control e1" placeholder="Select Type" id="product_id" name="category_id" >
                                        <option value="" >Product Type</option>
                                        <?php foreach($product_categories as $product_category){ ?>
                                           <option <?php if($category_id==$product_category['category_id']) echo 'selected'; ?>  value="<?php echo $product_category['category_id'] ?>"><?php echo $product_category['category_name'] ?></option> 
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
    <?php  if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('payment_collections/add_collection'); ?>" class="btn btn-sm btn-primary">ADD COLLECTION</a>
    <?php } ?>     
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                
                <th class="col-lg-1">Receive Date</th>
                
                <!--<th class="col-lg-1">Order No.</th>-->
                <th class="col-lg-1">Customer Name</th>
                <th class="col-lg-1">MRR. No</th>
                <th class="col-lg-1">Product Type</th>
                <th class="col-lg-1">Mode of Payment</th>
                <th class="col-lg-1">Pdc/Lc/Bg No</th>
                 <th class="col-lg-1">Pdc/Lc/Bg Date</th>
                <th class="col-lg-1">Amount</th> 
                <th class="col-lg-1">R. Status</th>
                <th class="col-lg-1">Remark</th>
                <th class="col-lg-2">Action</th>
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
                             <?php if(!empty($collection['category_name'])) echo $collection['category_name']; ?>
                        </td>
                        
                        <td>
                            <?php if(!empty($collection['collection_method'])) echo $collection['collection_method']; ?>
                        </td>
                    <?php if($collection['collection_method']=="Cash" || $collection['collection_method']=="O.Cash"){ ?>    
                       <td>
                            <?php //if(!empty($collection['no'])) echo $collection['no']; ?>
                       </td>
                    <?php }else{ ?>  
                       <td>
                            <?php if(!empty($collection['no'])) echo $collection['no']; ?>
                       </td>
                    <?php } ?>   
                       
                       
                       <?php if($collection['collection_method']=="Cash" || $collection['collection_method']=="O.Cash"){ ?>
                           
                                <td>

                                </td>
                             
                        
                       <?php }else{ ?>
                            <?php if($collection['collection_method']=="Pdc"){ ?>    
                                <td>
                                    <?php if(!empty($collection['check_date']) && $collection['check_date']!='0000-00-00' ) echo date('d-m-Y',strtotime($collection['check_date'])); ?>
                                </td>
                            <?php }else if($collection['collection_method']=="Bg"){ ?>    
                                <td>
                                    <?php if(!empty($collection['bg_expire_date'])) echo date('d-m-Y',strtotime($collection['bg_expire_date'])); ?>
                                </td>
                            <?php }else if($collection['collection_method']=="Po"){ ?>    
                                <td>
                                    <?php if(!empty($collection['po_date'])) echo date('d-m-Y',strtotime($collection['po_date'])); ?>
                                </td>
                            <?php }else if($collection['collection_method']=="Lc"){ ?>    
                                <td>
                                    <?php if(!empty($collection['lc_date'])) echo date('d-m-Y',strtotime($collection['lc_date'])); ?>
                                </td>
                            <?php }else{ ?>
                                <td>

                                </td>
                            <?php } ?> 
                                
                       <?php } ?>         
                        
                        
                        <td style="text-align: right;">
                            <?php if(!empty($collection['amount'])) echo number_format($collection['amount'],2); ?>
                        </td>
                       
                        <td>
                            <?php if(!empty($collection['payment_status'])) echo $collection['payment_status']; ?>
                        </td>
                        
                         <td>
                            <?php if(!empty($collection['remark'])) echo $collection['remark']; ?>
                        </td>

                        <td>
                            <?php  if (in_array(4, $this->role)) { ?>
                                <a href="<?php echo site_url('payment_collections/view_collection/'.$collection['id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                            <?php } ?>    
                            <?php if(($collection['collection_method']=="Cash" || $collection['collection_method']=="O.Cash" || $collection['collection_method']=="Adjustment" || $collection['collection_method']=="Vat" || $collection['collection_method']=="Ait") && $collection['payment_status']!="Received" ){ ?>
                                <?php  if (in_array(2, $this->role)) { ?>    
                                    <a href="<?php echo site_url('payment_collections/receive_collection/'.$collection['id']); ?>"><button class="btn btn-sm btn-primary">Received</button></a>
                                <?php } ?>    
                            <?php }else{ ?>
                                <?php  if (in_array(2, $this->role)) { ?>        
                                    <button onclick="returnCollection('<?php echo $collection['id']; ?>')" class="btn btn-sm btn-warning">Return</button>
                                <?php } ?>    
                            <?php } ?>        
                                    
                                    
                                    
                            <?php if($collection['payment_status']!="Received"){ ?>
                               <?php  if (in_array(3, $this->role)) { ?>     
                                    <a href="<?php echo site_url('payment_collections/edit_collection/'.$collection['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                               <?php } ?>    
                            <?php }else{ ?>
                                <?php  if (in_array(3, $this->role)) { ?>    
                                    <button class="btn btn-sm btn-info">Edit</button>
                                <?php } ?>
                            <?php } ?>    
                            <?php if($collection['payment_status']!="Received"){ ?>
                                <?php  if (in_array(5, $this->role)) { ?>    
                                    <button onclick="delete_row('<?php echo site_url('payment_collections/delete_collection/'.$collection['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                <?php } ?>    
                            <?php } ?> 
                                    
                                     <?php if($collection['collection_method']=="Cash" && $collection['payment_status']!="Received" ){ ?>
                                <?php  if (in_array(2, $this->role)) { ?>    
                                    <a href="<?php echo site_url('payment_collections/collection_voucher/'.$collection['id']); ?>"><button class="btn btn-sm btn-primary">Voucher </button></a>
                                <?php } ?>    
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
          <h4 class="modal-title" id="h__status">Return Reason</h4>
        </div>
        <div class="modal-body">
            
             <input type="hidden" id="collection_id" class="form-control " value="" />
            
             <input style="position:relative;" required type="text" id="return_reason" class="form-control " value="<?php //echo date('d-m-Y'); ?>" placeholder="Reason" autocomplete="off"  />
            
            <span id="return_reason_error" style="color:red;"></span>
        </div>
        <div class="modal-footer">
            <button onclick="returnCollectionAction()" class="btn btn-sm btn-primary">Submit</button>
          <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>




<script>
    
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
    
    function returnCollection(id){        
        $('#collection_id').val(id);
        $('#myModal').modal('show');
    }
    
    
     function returnCollectionAction(){
        
        var collection_id=$('#collection_id').val();
       // var return_date=$('#return_date').val();
        var return_reason=$('#return_reason').val();
        if(return_reason==''){
            $('#return_reason_error').html('Please fill the reason field');
            return false;
        }
       
         $.ajax({
                url: '<?php echo site_url('payment_collections/returnPayment'); ?>',
                data:{'collection_id':collection_id,'return_reason':return_reason},
                method:'POST',
                dataType:'json',
                success: function (msg) { 
                    if(msg.status=='success'){
                        $('#collection_id').val('');
                        $('#return_date').val('');
                        $('#myModal').modal('hide');
                        location.reload(true);
                    }    
                }

        })
    }
    
    
</script>