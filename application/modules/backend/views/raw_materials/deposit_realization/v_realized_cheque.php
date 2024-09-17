<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id),'*');
    $this->role = checkUserPermission(7, 28, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; ">Deposit List</h2>
    <hr>-->
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Realized Cheque/Lc/Bg List</h3>
            </div>
        </div>
        
         <div class="row">
            <div id="remover" class="col-md-6 col-md-offset-3">
                <form id="item-form" action="<?php site_url('backend/raw_materials/deposit_realization/realized_cheque_bg_lc'); ?>" method="post" autocomplete="off">
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
                            <!--
                            <option <?php if($collection_method=="O.Cash") echo "Selected"; ?> value="O.Cash" >O.Cash</option>
                            <option <?php if($collection_method=="Cash") echo "Selected"; ?> value="Cash" >Cash</option>
                            -->

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
                <th class="col-lg-1">Instrument</th>
                <th class="col-lg-1">No.</th>
                <th class="col-lg-1">Customer Name</th>
                <th class="col-lg-1">MRR. NO.</th>
                
                <th class="col-lg-1">Deposit Date</th>
                <th class="col-lg-1">Bank</th>
                <th class="col-lg-1">Branch</th>
                <th class="col-lg-1">Amount</th>
                <th class="col-lg-1">Status</th>
                <th class="col-lg-1">Realization Date</th>
                <th class="col-lg-1">Remark</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($deposits)) {
                foreach ($deposits as $deposit) { ?>
                    <tr>
                       <td>
                            <?php if(!empty($deposit['collection_method'])) echo $deposit['collection_method']; ?>
                        </td>
                        
                        <td>
                            <?php if(!empty($deposit['no'])) echo $deposit['no']; ?>
                        </td>
                        
                        <td>
                            <?php if(!empty($deposit['c_name'])) echo $deposit['c_name']; ?>
                        </td>
                        
                        <td>
                            <?php if(!empty($deposit['mrr_no'])) echo $deposit['mrr_no']; ?>
                        </td>
                        
                       
                        
                        
                        <td>
                            <?php if(!empty($deposit['deposit_date'])) echo date('d-m-Y',strtotime($deposit['deposit_date'])); ?>
                        </td>
                        
                         <td>
                           <?php if(!empty($deposit['b_short_name'])) echo $deposit['b_short_name']; ?>
                        </td>
                       <td>
                           <?php if(!empty($deposit['branch_name'])) echo $deposit['branch_name']; ?>
                        </td>
                        <td>
                            <?php if(!empty($deposit['amount'])) echo number_format($deposit['amount'],2); ?>
                        </td>
                         <td>
                            <?php if(!empty($deposit['realization_status'])) echo $deposit['realization_status']; ?>
                        </td>
                        <td>
                            <?php if(!empty($deposit['realization_date'])) echo date('d-m-Y',strtotime($deposit['realization_date'])); ?>
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
      <div class="modal-content">
        <div class="modal-header">
          <button id="close1" type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="h__status">Realization Date</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" id="honor_status" class="form-control datepicker" value="" />
            <input type="hidden" id="deposit_id" class="form-control datepicker" value="" />
            <input required type="text" id="realization_date" class="form-control datepicker" placeholder="Date" />
            <span id="realization_date_error" style="color:red;"></span>
        </div>
        <div class="modal-footer">
            <button onclick="realizationAction()" class="btn btn-sm btn-primary">Submit</button>
          <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<script type="text/javascript">
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
                url: '<?php echo site_url('raw_materials/deposit_realization/realization'); ?>',
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
</script>