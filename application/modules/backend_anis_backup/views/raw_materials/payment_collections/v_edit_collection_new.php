
<style type="text/css">
    .form-control{
        height:30px;
    }
    .clickable{
        cursor: pointer;   
    }

    .panel-heading span {
        margin-top: -20px;
        font-size: 15px;
    }

    #radioBtn .notActive{
        color: #3276b1;
        background-color: #fff;
    }
    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        padding: 3px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
</style>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Payment Collection</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal"  action="<?php echo site_url('raw_materials/payment_collections/edit_collection_action/'.$collection_info[0]['id']); ?>" method="post" onsubmit="javascript: return validation()">
                            <div class="row"> 
                                <div class="col-md-8">
                                    <div class='form-group' style="margin-bottom:30px;" >
                                              <label for="title" class="col-sm-2 control-label">
                                    Customers <sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-8 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select  id="c_id" class="form-control e1" name="c_id" required onchange="javascript:changeCustomer();">
                            <option class="form-control" value="">Select Customer</option>
                            <?php foreach($customers as $customer){ ?>
                                <option <?php if($collection_info[0]['customer_id']==$customer['id']) echo 'selected'; ?> value="<?php echo $customer['id']; ?>"><?php echo $customer['c_name']; ?></option>
                            <?php } ?>
                           
                       </select>
                                            <span id="o_id_error" style="color:red"></span>
                                        </div>


                                    </div> 

                                
                                  <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label">
                                     MRR. NO.<sup class="required">*</sup> :
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                        <input  class="form-control " id="mrr_no" name="mrr_no" type="text" value="<?php if(!empty($collection_info[0]['mrr_no'])) echo $collection_info[0]['mrr_no']; ?>">
                                        <span id="mrr_no_error" style="color:red"></span>
                                    </div> 
                                    
                                 </div>          
                                    

                                    <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            Receive Date<sup class="required">*</sup> :
                                        </label>
                                        <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                            <input  class="form-control datepicker" id="receive_date" name="receive_date" type="text" value="<?php if(!empty($collection_info[0]['receive_date'])) echo date('d-m-Y',strtotime($collection_info[0]['receive_date'])) ?>">
                                            <span id="receive_date_error" style="color:red"></span>
                                        </div>
 <label for="title" class="col-sm-2 control-label">
                                            Remark<sup class="required">*</sup> :
                                        </label>
                                        <div class="col-sm-4 input-group">
                                            <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                            <input  class="form-control " name="remark" type="text" value="<?php if(!empty($collection_info[0]['remark'])) echo $collection_info[0]['remark']; ?>">
                                        </div>
                                    </div>


                                   <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Payment Mode Details</h3>
                                            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row" style="margin-bottom:20px;">
                                                <div class="col-md-11 col-md-offset-1">
                                                    <div class="input-group">
                                                        <div id="radioBtn" class="btn-group">

                                                            <a class="btn btn-primary btn-lg <?php if($collection_info[0]['collection_method']=="Cash") echo 'active';else echo 'notActive;' ?>" data-toggle="c_methhod" data-title="Cash">Cash</a>
                                                            <a class="btn btn-primary btn-lg <?php if($collection_info[0]['collection_method']=="O.Cash") echo 'active';else echo 'notActive;' ?>" data-toggle="c_methhod" data-title="O.Cash">O.Cash</a>
                                                            <a class="btn btn-primary btn-lg <?php if($collection_info[0]['collection_method']=="Bg") echo 'active';else echo 'notActive;' ?>" data-toggle="c_methhod" data-title="Bg">BG</a>
                                                            <a class="btn btn-primary btn-lg <?php if($collection_info[0]['collection_method']=="Lc") echo 'active';else echo 'notActive;' ?>" data-toggle="c_methhod" data-title="Lc">LC</a>
                                                            <a class="btn btn-primary btn-lg <?php if($collection_info[0]['collection_method']=="Pdc") echo 'active';else echo 'notActive;' ?>" data-toggle="c_methhod" data-title="Pdc">PDC</a>
                                                            <a class="btn btn-primary btn-lg <?php if($collection_info[0]['collection_method']=="Adjustment") echo 'active';else echo 'notActive;' ?>" data-toggle="c_methhod" data-title="Adjustment">Adjustment</a>
                                                            <a class="btn btn-primary btn-lg <?php if($collection_info[0]['collection_method']=="Vat") echo 'active';else echo 'notActive;' ?>" data-toggle="c_methhod" data-title="Vat">Vat</a>
                                                            <a class="btn btn-primary btn-lg <?php if($collection_info[0]['collection_method']=="Ait") echo 'active';else echo 'notActive;' ?>" data-toggle="c_methhod" data-title="Ait">Ait</a>
                                                        </div>
                                                        <input type="hidden" name="collection_method" id="collection_method" value="<?php echo $collection_info[0]['collection_method']; ?>">
                                                    </div> 
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                 <div class="col-md-8">
                                                    <div id="bank" style="display:<?php if($collection_info[0]['collection_method']=="Cash" || $collection_info[0]['collection_method']=="Adjustment" || $collection_info[0]['collection_method']=="Vat" || $collection_info[0]['collection_method']=="Ait") echo 'none'; ?>">
                                                        <label for="title" class="col-sm-3 control-label">
                                                            Bank<sup class="required">*</sup>  :
                                                        </label> 
                                                        <div class="col-sm-9 input-group">
                                                            <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                                                            <select id="bank_id" class="form-control e1" name="bank_id">
                                                                <option class="form-control" value="">Select Bank</option>
                                                                <?php foreach ($banks as $bank) { ?>
                                                                   
                                                                    <?php foreach($banks as $bank){ ?>
                                                                        <option <?php if($collection_info[0]['bank_id']==$bank['id']) echo 'selected'; ?>  class="form-control" value="<?php echo $bank['id'] ?>"><?php echo $bank['b_short_name'].'('.$bank['branch_name'].')' ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                            <span id="bank_id_error" style="color:red;"></span>
                                                            
                                                        </div>
                                                    </div>
                                                 </div>
                                                
                                                 
                                                
                                                
                                            </div>
                                            
                                            
                                            <div class="row">
                                                 
                                                <div class="col-md-6">
                                                        <div class='form-group' >

                                                            <label for="title" class="col-sm-4 control-label">
                                                                Amount<sup class="required">*</sup> :
                                                            </label>
                                                            <div class="col-sm-8 input-group">
                                                                <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                                                <input  onkeyup="checkCollectAmount()" onchange="checkCollectAmount()"  id="amount" class="form-control number" name="amount" type="text" value="<?php echo $collection_info[0]['amount']; ?>">
                                                                <span id="amount_error" style="color:red"></span>
                                                            </div>

                                                        </div>
                                                </div> 
                                               
                                                
                                            </div>
                                            
                                                <div class="row">
                                                        <div class="col-md-6" id="no">
                                                                <?php if(!empty($collection_info[0]['check_no'])){ ?>
                                                                    <div class="form-group check_no  "  style=";">
                                                                             <label for="title" class="col-sm-4 control-label">Cheque No<sup style="color:red;">*</sup> :</label>
                                                                           <div class="col-sm-8 col-md-8 input-group">
                                                                               <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                                                             <input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();"  id="check_no" class="form-control number" name="check_no" type="text" value="<?php echo $collection_info[0]['check_no']; ?>">
                                                                             <span id="check_no_error" style="color:red"></span>
                                                                            </div>
                                                                      </div>
                                                               <?php }else if(!empty($collection_info[0]['ac_no'])){ ?> 
                                                                      <div class="form-group check_no  "  style=";">
                                                                             <label for="title" class="col-sm-4 control-label">Account No<sup style="color:red;">*</sup> :</label>
                                                                           <div class="col-sm-8 col-md-8 input-group">
                                                                               <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                                                             <input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();"  id="check_no" class="form-control number" name="ac_no" type="text" value="<?php echo $collection_info[0]['ac_no']; ?>">
                                                                             <span id="check_no_error" style="color:red"></span>
                                                                            </div>
                                                                      </div>
                                                               <?php }else if(!empty($collection_info[0]['bg_no'])){ ?>  
                                                                     <div class="form-group check_no"  style=";">
                                                                            <label for="title" class="col-sm-4 control-label">Bg. No<sup class="required">*</sup> :</label>
                                                                            <div class="col-sm-8 col-md-8 input-group "> 
                                                                                <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                                                                <input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();" id="bg_no" class="form-control" name="bg_no" type="text" value="<?php echo $collection_info[0]['bg_no']; ?>">
                                                                                <span id="bg_no_error" style="color:red"></span>
                                                                            </div>    
                                                                      </div>
                                                            
                                                     <?php }else if(!empty($collection_info[0]['lc_no'])){ ?>     
                                                                       <div class="form-group check_no  "  style=";">
                                                                            <label for="title" class="col-sm-4 control-label">Lc No<sup style="color:red;">*</sup> :</label>
                                                                            <div class="col-sm-8 col-md-8 input-group">
                                                                                <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                                                                <input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();" id="lc_no" class="number form-control" name="lc_no" type="text" value="<?php echo $collection_info[0]['lc_no']; ?>">
                                                                              <span id="lc_no_error" style="color:red"></span>
                                                                              </div>
                                                                       </div>
                                                     <?php } ?>    
                                                            
                                                            
                                                                  



                                                        </div>
                                                        <div class="col-md-6" id="date">
                                                             <?php if($collection_info[0]['collection_method']=="Pdc"){ ?>
                                                                <div class="form-group check_date " style="">
                                                                        <label for="title" class="col-sm-4 control-label">Cheque Date<sup style="color:red;">*</sup> :</label>
                                                                        <div class="col-sm-8 col-md-8 input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                                                            <input  id="check_date" class="form-control datepicker" name="check_date" type="text" value="<?php if(!empty($collection_info[0]['check_date'])) echo date('d-m-Y',strtotime($collection_info[0]['check_date'])); ?>">
                                                                        </div>
                                                                       <span id="check_date_error" style="color:red"></span>
                                                                </div>
                                                          <?php }else if($collection_info[0]['collection_method']=="Bg"){ ?>      
                                                                    <div class="form-group check_date" style="">
                                                                        <label for="title" class="col-sm-4 control-label">Bg Date<sup style="color:red;">*</sup> :</label>
                                                                       <div class="col-sm-8 col-md-8 input-group ">
                                                                           <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                                                           <input  id="bg_issue_date" class="form-control datepicker1" name="bg_issue_date" type="text" value="<?php if(!empty($collection_info[0]['bg_issue_date'])) echo date('d-m-Y',strtotime($collection_info[0]['bg_issue_date'])); ?>">
                                                                       </div>
                                                                        <span id="bg_issue_date_error" style="color:red"></span>
                                                                    </div>
                                                            
                                                         <?php }else if($collection_info[0]['collection_method']=="Lc"){ ?>    
                                                                  <div class="form-group check_date " style="">
                                                                    <label for="title" class="col-sm-4 control-label">Lc Date<sup style="color:red;">*</sup> :</label>
                                                                    <div class="col-sm-8 col-md-8 input-group"><span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                                                        <input  id="lc_date" class="form-control datepicker" name="lc_date" type="text" value="<?php if(!empty($collection_info[0]['lc_date'])) echo date('d-m-Y',strtotime($collection_info[0]['lc_date'])); ?>">
                                                                    </div>
                                                                     <span id="lc_date_error" style="color:red"></span>
                                                                    </div>
                                                            
                                                         <?php } ?>      
                                                                        


                                                     </div>

                                             </div>

                                            <div class="row">
                                                
                                                <div class="col-md-6" id="bg_lc_tenor">
                                                    
                                                    
                                                  <?php if(!empty($collection_info[0]['tenor'])){ ?>
                                                       <div class="form-group check_no  "  style=";">
                                                            <label for="title" class="col-sm-4 control-label">Tenor<sup style="color:red;">*</sup> :</label>
                                                            <div class="col-sm-8 col-md-8 input-group">
                                                                  <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                                                  <input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();"  id="tenor" class="form-control number" name="tenor" type="text" value="<?php echo $collection_info[0]['tenor']; ?>">
                                                                  <span id="tenor_error" style="color:red"></span>
                                                         </div>
                                                       </div>
                                                  <?php } ?>  
                                                    
                                                        
                                                    
                                                    
                                                </div>
                                                <div class="col-md-6" id="expire_date">
                                                     <?php if(!empty($collection_info[0]['bg_expire_date'])){ ?>
                                                            <div class="form-group check_date" style="">
                                                                    <label for="title" class="col-sm-4 control-label">Exp. Date<sup style="color:red;">*</sup> :</label>
                                                                    <div class="col-sm-8 col-md-8 input-group">
                                                                        <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                                                        <input  id="bg_expire_date" class="form-control datepicker1" name="bg_expire_date" type="text" value="<?php if(!empty($collection_info[0]['bg_expire_date'])) echo date('d-m-Y',strtotime($collection_info[0]['bg_expire_date'])); ?>">
                                                                    </div>
                                                                   <span id="bg_expire_date_error" style="color:red"></span>
                                                            </div>
                                                     <?php } ?>
                                                </div>
                                                
                                            </div>

                                        </div>
                                    </div>
                                    <div class="separator-shadow"></div>   



                                </div>   

                                </div>

                                <div class="col-md-4" style="border-left: 1px solid #ddd;min-height: 250px;">
                                    <h4 style="font-size: 20px;text-align: center;margin-top: 0;">History</h4>
                                    <b style="font-size: 18px; color:#286090;">Deposit : <span id="total"><?php echo $customers[0]['deposit']; ?></span> </b> <br>
                                    <!--<b style="font-size: 18px; color:#286090;">Receive : <span id="receive"><?php echo $total_paid; ?></span> </b> <br>-->
                                    <b style="font-size: 18px; color:#286090;">Due  : <span id="due"><input type="hidden" id="due_amount" value="<?php echo $total_due; ?>" /><?php echo $total_due; ?></span></b> <br><br>
                                    <b>Previous Collections :</b> <br>
                                    <table class="table" style="width:100%;text-align: center;" border="1" bordercolor="#ddd">
                                        <thead class="thead-color">
                                           <tr>
                                                <th style="width:20%;text-align: center;">Date</th>
                                                <th style="width:30%;text-align: center;">Payment Mode</th>
                                                <th style="width:50%;text-align: center;">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id="c_history_body">
                                            <?php if(!empty($all_collections)){ 
                                                
                                                foreach($all_collections as $collections){
                                                
                                                ?>
                                                    <tr>
                                                        <td style="text-align: left;"><?php echo $collections['receive_date'] ?></td>
                                                        <td style="text-align: left;"><?php echo $collections['collection_method'] ?></td>
                                                        <td style="text-align: right;"><?php echo $collections['amount'] ?></td>
                                                    </tr>
                                                <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>







                            <div class="clearfix"></div> 
                            <div class="separator-shadow"></div>

                            <div class="row">
                                

                            </div>


                            <!--        <h2 style="text-align: center;">Payment condition and status</h2>-->


<!--        <button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="payment_hide_button"  class="btn btn-primary "><span class="glyphicon glyphicon-minus"></span></button>
<button  type="button" style="display:none;padding-left:6px;padding-right:6px;font-size:8px;" id="payment_show_button"  class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span></button>-->
                            <div id="payment_condition">

                                <!--             <div class="row">
                                                 <table class="table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                                                     <thead>
                                                           <tr>
                                                               <th colspan="4" style="text-align: center;">Before Delivery</th>
                                                               <th colspan="4" style="text-align: center;">After Delivery</th>
                                                           </tr>
                                                           <tr>
                                                               <th>Payment Mode</th>
                                                               <th>Tenor Day</th>
                                                               <th>Percent</th>
                                                               <th>Amount</th>
                                                               <th>Payment Mode</th>
                                                               <th>Tenor Day</th>
                                                               <th>Percent</th>
                                                               <th>Amount</th>
                                                           </tr>
                                                    </thead> 
                                                    <tbody id="paymentConditionBody">
                                                        
                                                    </tbody>
                                                 </table>
                                                 
                                                  
                                                 <table class="table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                                                     <thead>
                                                          
                                                        <tr>
                                                            <th>Total</th>
                                                            <th>Receive</th>
                                                            <th>Due</th>
                                
                                                       </tr>
                                                    </thead> 
                                                    <tbody id="paymentCollectionBody">
                                                        
                                                    </tbody>
                                                 </table>
                                                 
                                                 <table class="table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                                                     <thead>
                                                          
                                                        <tr>
                                                            <th style="text-align: center;">Payment Mode</th>
                                                            <th>Amount</th>
                                                            <th style="text-align: center;">Receive Amount</th>
                                                            <th>Due</th> 
                                
                                                       </tr>
                                                    </thead> 
                                                    <tbody id="paymentBalanceBody">
                                                        
                                                    </tbody>
                                                 </table>
                                                 
                                                    
                                
                                                </div>-->





                            </div><!--End Condition And Status-->     




                            <div class="form-group" style="margin-top: 40px;">
                                
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/raw_materials/payment_collections') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
                                </div>
                                
                                <div class=" col-sm-2">
                                    <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">SAVE</button>
                                </div>
                                
                            </div>

                            <!--        <div class="row">
                                         <div class="col-md-1 col-md-offset-3">
                                            <a href="<?php echo site_url('backend/payment_collections') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">REGISTER</button> </a>
                            
                                        </div>
                                        <div class="col-md-2 ">
                                            <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">SAVE</button>
                                        </div>
                                       
                                    </div> -->


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


    $('#payment_hide_button').click(function () {
        $('#payment_condition').hide();
        $('#payment_show_button').show();
        $('#payment_hide_button').hide();
    });

    $('#payment_show_button').click(function () {
        $('#payment_condition').show();
        $('#payment_hide_button').show();
        $('#payment_show_button').hide();

    });



   function validation() {

        var receive_date = $('#receive_date').val();
        var collection_time = $('#collection_time').val();
        var o_id = $('#o_id').val();
        var amount = $('#amount').val();
        var collection_method = $('#collection_method').val();
        var error = false;
        
        var receive_type = $('#receive_type').val();
        
        var mrr_no = $('#mrr_no').val();
        if (mrr_no == '') {
            $('#mrr_no_error').html('Please fill MRR. No. field');
            $('#mrr_no').css('border', '1px solid red');
            error = true;
        } else {
            $('#mrr_no_error').html('');
            $('#mrr_no').css('border', '1px solid #ccc');

        }
        
        if(receive_type ==''){
            $('#receive_type').css('border', '1px solid red');
            $('#receive_type_error').html('Please select receive type field');
            error = true;
            $('#receive_type').focus();

        }else{
            $('#receive_type').css('border', '1px solid #ccc');
            $('#receive_type_error').html('');

        }
        
        
        
        if (o_id == '') {
            $('#o_id_error').html('Please select order');
            $('#o_id').css('border', '1px solid red');
            error = true;
            $('#o_id').focus();
        } else {
            $('#o_id_error').html('');
            $('#o_id').css('border', '1px solid #ccc');

        }

        if (receive_date == '') {
            $('#receive_date').css('border', '1px solid red');
            $('#receive_date_error').html('Please fill receive date field');
            error = true;
            $('#receive_date').focus();

        } else {
            $('#receive_date').css('border', '1px solid #ccc');
            $('#receive_date_error').html('');

        }
        if (collection_time == '') {
            $('#collection_time').css('border', '1px solid red');
            $('#collection_time_error').html('Please select receive time');
            error = true;
            $('#collection_time').focus();

        } else {
            $('#collection_time').css('border', '1px solid #ccc');
            $('#collection_time_error').html('');

        }



        if (collection_method == '') {
            $('#collection_method_error').html('Please select collection method');
            $('#collection_method').css('border', '1px solid red');
            error = true;
            $('#collection_method').focus();
        } else {
            $('#collection_method_error').html('');
            $('#collection_method').css('border', '1px solid #ccc');
            if (collection_method == "Pdc") {
                var check_no = $('#check_no').val();
                var check_date = $('#check_date').val();
                
                var bank= $('#bank_id').val();
                
                 if (bank == '') {
                    $('#bank_id_error').html('Please select a bank');
                    $('#bank_id').css('border', '1px solid red');
                    error = true;
                    $('#bank_id').focus();
                } else {
                    $('#bank_id_error').html('');
                    $('#bank_id').css('border', '1px solid #ccc');
                }
                
                if (check_no == '') {
                    $('#check_no_error').html('Please fill pdc number field');
                    $('#check_no').css('border', '1px solid red');
                    error = true;
                    $('#check_no').focus();
                } else {
                    $('#check_no_error').html('');
                    $('#check_no').css('border', '1px solid #ccc');
                }

//                if (check_date == '') {
//                    $('#check_date_error').html('Please fill chque date field');
//                    $('#check_date').css('border', '1px solid red');
//                    error = true;
//                    $('#check_date').focus();
//                } else {
//                    $('#check_date_error').html('');
//                    $('#check_date').css('border', '1px solid #ccc');
//                }
            } else if (collection_method == "Bg") {
                var bg_no = $('#bg_no').val();
                var bg_issue_date = $('#bg_issue_date').val();
                var bg_expire_date = $('#bg_expire_date').val();
                var tenor = $('#tenor').val();
                
                 var bank= $('#bank_id').val();
                
                 if (bank == '') {
                    $('#bank_id_error').html('Please select a bank');
                    $('#bank_id').css('border', '1px solid red');
                    error = true;
                    $('#bank_id').focus();
                } else {
                    $('#bank_id_error').html('');
                    $('#bank_id').css('border', '1px solid #ccc');
                }

                if (bg_no == '') {
                    $('#bg_no_error').html('Please fill bg number field');
                    $('#bg_no').css('border', '1px solid red');
                    error = true;
                    $('#bg_no').focus();
                } else {
                    $('#bg_no_error').html('');
                    $('#bg_no').css('border', '1px solid #ccc');
                }
                if (bg_issue_date == '') {
                    $('#bg_issue_date_error').html('Please fill bg issue date field');
                    $('#bg_issue_date').css('border', '1px solid red');
                    error = true;
                    $('#bg_issue_date').focus();
                } else {
                    $('#bg_issue_date_error').html('');
                    $('#bg_issue_date').css('border', '1px solid #ccc');
                }
                if (bg_expire_date == '') {
                    $('#bg_expire_date_error').html('Please fill bg expire date field');
                    $('#bg_expire_date').css('border', '1px solid red');
                    error = true;
                    $('#bg_expire_date').focus();
                } else {
                    $('#bg_expire_date_error').html('');
                    $('#bg_expire_date').css('border', '1px solid #ccc');
                }
                if (tenor == '') {
                    $('#tenor_error').html('Please fill tenor field');
                    $('#tenor').css('border', '1px solid red');
                    error = true;
                    $('#tenor').focus();
                } else {
                    $('#tenor_error').html('');
                    $('#tenor').css('border', '1px solid #ccc');
                }
            } else if (collection_method == "Lc") {
                var lc_no = $('#lc_no').val();
                var lc_date = $('#lc_date').val();
                var tenor = $('#tenor').val();
                var bank= $('#bank_id').val();
                
                if (bank == '') {
                    $('#bank_id_error').html('Please select a bank');
                    $('#bank_id').css('border', '1px solid red');
                    error = true;
                    $('#bank_id').focus();
                } else {
                    $('#bank_id_error').html('');
                    $('#bank_id').css('border', '1px solid #ccc');
                }

                if (lc_no == '') {
                    $('#lc_no_error').html('Please fill lc number field');
                    $('#lc_no').css('border', '1px solid red');
                    error = true;
                    $('#lc_no').focus();
                } else {
                    $('#lc_no_error').html('');
                    $('#lc_no').css('border', '1px solid #ccc');
                }
                if (lc_date == '') {
                    $('#lc_date_error').html('Please fill lc  date field');
                    $('#lc_date').css('border', '1px solid red');
                    error = true;
                    $('#lc_date').focus();
                } else {
                    $('#lc_date_error').html('');
                    $('#lc_date').css('border', '1px solid #ccc');
                }

                if (tenor == '') {
                    $('#tenor_error').html('Please fill tenor field');
                    $('#tenor').css('border', '1px solid red');
                    error = true;
                    $('#tenor').focus();
                } else {
                    $('#tenor_error').html('');
                    $('#tenor').css('border', '1px solid #ccc');
                }
            }

        }
        if (amount == '') {
            $('#amount_error').html('Please fill amount field');
            $('#amount').css('border', '1px solid red');
            error = true;
        } else {
            $('#amount_error').html('');
            $('#amount').css('border', '1px solid #ccc');

        }

        if (error == true) {
            return false;
        }
    }

    function checkCollectAmount() {

        var c_method = $('#collection_method').val();
        var amount = Number($('#amount').val());
        var due_amount = Number($('#due_amount').val());
        if (c_method != '') {
            if (amount > due_amount) {
                //$('#amount').val('');
                //alert('Collection amount should not be more than due amount');
            }
        } else {
            $('#amount').val('');
            alert('Please select payment mode');
        }


    }

    function checkCollectAmount_pre() {

        var c_method = $('#collection_method').val();
        var amount = Number($('#amount').val());
        if (c_method != '') {
            if (c_method == "Cash") {
                var cash_due = Number($('#cash_due').val());
                if (amount > cash_due) {
                    $('#amount').val('');
                    alert('Collection amount should not be more than due amount');
                }
            } else if (c_method == "Pdc") {
                var pdc_due = Number($('#pdc_due').val());
                if (amount > pdc_due) {
                    $('#amount').val('');
                    alert('Collection amount should not be more than due amount');
                }
            } else if (c_method == "Lc") {
                var lc_due = Number($('#lc_due').val());
                if (amount > lc_due) {
                    $('#amount').val('');
                    alert('Collection amount should not be more than due amount');
                }
            } else if (c_method == "Bg") {
                var bg_due = Number($('#bg_due').val());
                if (amount > bg_due) {
                    $('#amount').val('');
                    alert('Collection amount should not be more than due amount');
                }
            }
        } else {
            $('#amount').val('');
            alert('Please select payment mode');
        }


    }

    function paymentCondition() {

        $('#myModal').modal('show');
    }


    $('#receive_type').change(function () {
        var r_type = $('#receive_type').val();
        if (r_type == "Invoice") {
            $('#invoice_section').show();
            $('#receive_type').attr('required', true);
        } else {
            $('#invoice_section').hide();
            $('#receive_type').attr('required', false);
        }
    });


    $('#o_id').change(function () {
         $('.main-details').show();
        var o_id = $('#o_id').val();
        if (o_id != '') {
            $('#paymentConditionBody').html('');
            $('#paymentCollectionBody').html('');
            $('#paymentBalanceBody').html('');

            $.ajax({
                url: '<?php echo site_url('payment_collections/get_payment_mode'); ?>',
                data: {'o_id': o_id},
                method: 'POST',
                dataType: 'json',
                success: function (msg) {
                    var option = '<option class="form-control" value="">Select Mode</option>';
                    if (msg.payment_mode != '') {
                        if (msg.payment_mode[0].b_cash == "Cash" || msg.payment_mode[0].a_cash == "Cash") {
                            option += '<option class="form-control" value="Cash">Cash</option>';
                        }
                        if (msg.payment_mode[0].b_bg == "Bg" || msg.payment_mode[0].a_bg == "Bg") {
                            option += '<option class="form-control" value="Bg">BG</option>';
                        }
                        if (msg.payment_mode[0].b_lc == "Lc" || msg.payment_mode[0].a_lc == "Lc") {
                            option += '<option class="form-control" value="Lc">LC</option>';
                        }
                        if (msg.payment_mode[0].b_pdc == "Pdc" || msg.payment_mode[0].a_pdc == "Pdc") {
                            option += '<option class="form-control" value="Pdc">Pdc</option>';
                        }
                    }
                    $('#collection_method').html(option);


                    var option1 = '<option class="form-control" value="">Select Invoice</option>';
                    if (msg.invoices != '') {
                        $(msg.invoices).each(function (i, v) {
                            option1 += '<option class="form-control" value="' + v.inv_id + '">' + v.inv_no + '(' + v.total_amount + ')' + '</option>';
                        });
                    }
                    $('#invoice_id').html(option1);


                    var tbl_row = '';
                    if (msg.payment_mode[0].b_cash_percent > 0 || msg.payment_mode[0].a_cash_percent > 0) {
                        tbl_row += '<tr>';
                        tbl_row += '<td>' + msg.payment_mode[0].b_cash + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].b_cash_tenor + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].b_cash_percent + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].b_cash_amount + '</td>';
                        tbl_row += '<td>' + msg.payment_mode[0].a_cash + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].a_cash_tenor + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].a_cash_percent + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].a_cash_amount + '</td>';
                        tbl_row += '</tr>';
                    }
                    if (msg.payment_mode[0].b_bg_percent > 0 || msg.payment_mode[0].a_bg_percent > 0) {
                        tbl_row += '<tr>';
                        tbl_row += '<td>' + msg.payment_mode[0].b_bg + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].b_bg_tenor + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].b_bg_percent + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].b_bg_amount + '</td>';
                        tbl_row += '<td>' + msg.payment_mode[0].a_bg + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].a_bg_tenor + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].a_bg_percent + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].a_bg_amount + '</td>';
                        tbl_row += '</tr>';
                    }

                    if (msg.payment_mode[0].b_lc_percent > 0 || msg.payment_mode[0].a_lc_percent > 0) {
                        tbl_row += '<tr>';
                        tbl_row += '<td>' + msg.payment_mode[0].b_lc + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].b_lc_tenor + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].b_lc_percent + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].b_lc_amount + '</td>';
                        tbl_row += '<td>' + msg.payment_mode[0].a_lc + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].a_lc_tenor + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].a_lc_percent + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].a_lc_amount + '</td>';
                        tbl_row += '</tr>';
                    }

                    if (msg.payment_mode[0].b_pdc_percent > 0 || msg.payment_mode[0].a_pdc_percent > 0) {
                        tbl_row += '<tr>';
                        tbl_row += '<td>' + msg.payment_mode[0].b_pdc + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].b_pdc_check + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].b_pdc_percent + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].b_pdc_amount + '</td>';
                        tbl_row += '<td>' + msg.payment_mode[0].a_pdc + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].a_pdc_check + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].a_pdc_percent + '</td>' + '<td style="text-align:right;">' + msg.payment_mode[0].a_pdc_amount + '</td>';
                        tbl_row += '</tr>';
                    }

                    $('#paymentConditionBody').html(tbl_row);



                    
                    var tbl_row1 = '';
                    tbl_row1 += '<tr>';
                    tbl_row1 += '<td style="text-align:right;">' + msg.total_amount + '</td>';
                    tbl_row1 += '<td style="text-align:right;">' + msg.total_paid + '</td>';
                    tbl_row1 += '<td style="text-align:right;"><input type="hidden" id="due_amount" value="' + msg.total_due + '" /> ' + msg.total_due + '</td>';
                    tbl_row1 += '</tr>';
                    $('#paymentCollectionBody').html(tbl_row1);
                    
//                    add by jubayer for collection history
var tbl_rowdue = '';
                   $('#total').html(msg.total_amount);
                   $('#receive').html(msg.total_paid);
                   var tbl_rowdue = '';
                   tbl_rowdue += '<input type="hidden" id="due_amount" value="' + msg.total_due + '" /> ' + msg.total_due;
                   $('#due').html(tbl_rowdue);
//                end add by jubayer for collection history

                if(msg.all_collections!=''){
                    var tbl_hrow1 = '';
                    $(msg.all_collections).each(function(i,v){
                         tbl_hrow1 += '<tr>';
                         tbl_hrow1 += '<td style="text-align:right;">' + v.receive_date + '</td>';
                         tbl_hrow1 += '<td style="text-align:right;">' + v.collection_method + '</td>';
                         tbl_hrow1 += '<td style="text-align:right;">' +v.amount+ '</td>';
                         tbl_hrow1 += '</tr>';
                    }) ; 
                }
                
                $('#c_history_body').html(tbl_hrow1);

                    var tbl_row2 = '';
                        //Cash Start
                        tbl_row2 += '<tr>';
                        tbl_row2 += '<td style="">Cash</td>';
                        if (msg.paid_cash_amount[0].total == null || msg.paid_cash_amount[0].total == '') {
                            tbl_row2 += '<td style="text-align:right;">' + '' + '</td>';
                        } else {
                            tbl_row2 += '<td style="text-align:right;">' + msg.paid_cash_amount[0].total + '</td>';
                        }     
                        tbl_row2 += '</tr>';

                    //Pdc Start               
                        tbl_row2 += '<tr>';
                        tbl_row2 += '<td style="">Pdc</td>';
                        if (msg.paid_pdc_amount[0].total == null || msg.paid_pdc_amount[0].total == '') {
                            tbl_row2 += '<td style="text-align:right;">' + '' + '</td>';
                        } else {
                            tbl_row2 += '<td style="text-align:right;">' + msg.paid_pdc_amount[0].total + '</td>';
                        }                
                        tbl_row2 += '</tr>';

              

                        //Lc Start
                        
                        tbl_row2 += '<tr>';
                        tbl_row2 += '<td style="">Lc</td>';
                        if (msg.paid_lc_amount[0].total == null || msg.paid_lc_amount[0].total == '') {
                            tbl_row2 += '<td style="text-align:right;">' + '' + '</td>';
                        } else {
                            tbl_row2 += '<td style="text-align:right;">' + msg.paid_lc_amount[0].total + '</td>';
                        }                      
                        tbl_row2 += '</tr>';

                        //Bg Start
                   
                        tbl_row2 += '<tr>';
                        tbl_row2 += '<td style="">Bg</td>';
                        if (msg.paid_bg_amount[0].total == null || msg.paid_bg_amount[0].total == '') {
                            tbl_row2 += '<td style="text-align:right;">' + '' + '</td>';
                        } else {
                            tbl_row2 += '<td style="text-align:right;">' + msg.paid_bg_amount[0].total + '</td>';
                        }
                        tbl_row2 += '</tr>';

                  
                    $('#paymentBalanceBody').html(tbl_row2);

                }

            })
        } else {
            $('#paymentConditionBody').html('');
            $('#paymentCollectionBody').html('');
            $('#paymentBalanceBody').html('');
            $('#c_history_body').html('');
            $('#total').html('');
            $('#receive').html('');
            $('#due').html('');



        }

    });



    


    function checkNumeric() {
        $('.number').on('input', function (event) {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);
        });
    }


    $('#radioBtn a').on('click', function () {
        var sel = $(this).data('title');
        var tog = $(this).data('toggle');
        $('#' + tog).prop('value', sel);

        $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
        $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
        
        $('#collection_method').val(sel);
        
        
        var method = sel;
        if (method == "Cash") {
            $('#bank_id').val('');
            $('#bank').hide();
            $('#bank_branch_id').val('');
            $('#bank_branch').hide();
            $('#no').html('');
            $('#date').html('');
            $('#expire_date').html('');
            $('#bg_lc_tenor').html('');

        }else if (method == "O.Cash") { 
            $('#bank_id').val('');
            $('#bank').show();
            $('#bank_branch_id').val('');
            $('#bank_branch').show();
            $('#no').html('');
            $('#date').html('');
            $('#expire_date').html('');
            $('#bg_lc_tenor').html(''); 
        }else if (method == "Pdc"){
            
            $('#bank_id').val('');
            $('#bank').show();
            $('#bank_branch_id').val('');
            $('#bank_branch').show();
            $('#no').html('');
            $('#date').html('');
            $('#expire_date').html('');
            $('#bg_lc_tenor').html('');
            var pdc_no = '';
//                pdc_no+='<div class="form-group check_no row "  style=";">';
//                 pdc_no +='<div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Cheque No<sup style="color:red;">*</sup> :</label></div>';
//                 pdc_no +='<div class="col-sm-8 col-md-5 ">';
//                 pdc_no +='<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();"  id="check_no" class="form-control number" name="check_no" type="text">';
//                 pdc_no +='<span id="check_no_error" style="color:red"></span>';
//                 pdc_no +='</div></div>';  

            pdc_no = '<div class="form-group check_no  "  style=";">';
            pdc_no += '<label for="title" class="col-sm-4 control-label">Cheque No<sup style="color:red;">*</sup> :</label>';
            pdc_no += '<div class="col-sm-8 col-md-8 input-group"><span class="input-group-addon"><i class="fa fa-check-square"></i></span>';
            pdc_no += '<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();"  id="check_no" class="form-control number" name="check_no" type="text">';
            pdc_no += '<span id="check_no_error" style="color:red"></span>';
            pdc_no += '</div></div>';
            var pdc_date = ' <div class="form-group check_date " style="">';
            pdc_date += '<label for="title" class="col-sm-4 control-label">Cheque Date<sup style="color:red;">*</sup> :</label>';
            pdc_date += '<div class="col-sm-8 col-md-8 input-group"><span class="input-group-addon"><i class="fa fa-check-square"></i></span><input  id="check_date" class="form-control datepicker" name="check_date" type="text"></div>';
            pdc_date += '<span id="check_date_error" style="color:red"></span>';
            pdc_date += '</div>';

            $('#date').html(pdc_date);
            $('#no').html(pdc_no);
            var datePickerOptions = {
                dateFormat: 'dd-mm-yy',
                firstDay: 1,
                changeMonth: true,
                changeYear: true,
                // ...
            }
            $('.datepicker').datepicker(datePickerOptions);


        } else if (method == "Po") {
            $('#bank_id').val('');
            $('#bank').show();
            $('#bank_branch_id').val('');
            $('#bank_branch').show();
            
            $('#no').html('');
            $('#date').html('');
            $('#expire_date').html('');
            $('#bg_lc_tenor').html('');
            var po_no = '';
//                 po_no +='<div class="form-group check_no row "  style=";">';
//                 po_no +='<div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Po No<sup style="color:red;">*</sup> :</label></div>';
//                 po_no +='<div class="col-sm-8 col-md-5 ">';
//                 po_no +='<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();" required id="po_no" class="number form-control" name="po_no" type="text">';
//                 po_no +='<span id="po_no_error"></span>';
//                 po_no +='</div></div>';  
            po_no += '<div class="form-group check_no  "  style=";">';
            po_no += '<label for="title" class="col-sm-4 control-label">Po No<sup style="color:red;">*</sup> :</label></div>';
            po_no += '<div class="col-sm-8 col-md-8 input-group"> <span class="input-group-addon"><i class="fa fa-check-square"></i></span>';
            po_no += '<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();" required id="po_no" class="number form-control" name="po_no" type="text">';
            po_no += '<span id="po_no_error"></span>';
            po_no += '</div></div>';
            var po_date = '';

//                po_date +=' <div class="form-group check_date row" style="">';
//                po_date +='<div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Po Date<sup style="color:red;">*</sup> :</label></div>';
//                po_date +='<div class="col-sm-8 col-md-5 "><input required id="po_date" class="form-control datepicker" name="po_date" type="text"></div>';
//                po_date +='</div>';
            po_date += ' <div class="form-group check_date " style="">';
            po_date += '<label for="title" class="col-sm-4 control-label">Po Date<sup style="color:red;">*</sup> :</label>';
            po_date += '<div class="col-sm-8 col-md-8 input-group"><span class="input-group-addon"><i class="fa fa-check-square"></i></span><input required id="po_date" class="form-control datepicker" name="po_date" type="text"></div>';
            po_date += '</div>';

            $('#date').html(po_date);
            $('#no').html(po_no);
            var datePickerOptions = {
                dateFormat: 'dd-mm-yy',
                firstDay: 1,
                changeMonth: true,
                changeYear: true,
                // ...
            }
            $('.datepicker').datepicker(datePickerOptions);
        } else if (method == "Bg") {
            $('#bank_id').val('');
            $('#bank').show();
            $('#bank_branch_id').val('');
            $('#bank_branch').show();
            $('#no').html('');
            $('#date').html('');
            $('#expire_date').html('');
            $('#bg_lc_tenor').html('');
            var bg_no = '';
//                 bg_no +='<div class="form-group check_no row "  style=";">';
//                 bg_no +='<div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Bg No<sup style="color:red;">*</sup> :</label></div>';
//                 bg_no +='<div class="col-sm-8 col-md-5 ">';
//                 bg_no +='<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();" id="bg_no" class="form-control number" name="bg_no" type="text">';
//                 bg_no +='<span id="bg_no_error" style="color:red"></span>';
//                 bg_no +='</div></div>';  

            bg_no += '<div class="form-group check_no"  style=";">';
            bg_no += '<label for="title" class="col-sm-4 control-label">Bg. No<sup class="required">*</sup> :</label>';
            bg_no += '<div class="col-sm-8 col-md-8 input-group "> <span class="input-group-addon"><i class="fa fa-check-square"></i></span>';
            bg_no += '<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();" id="bg_no" class="form-control " name="bg_no" type="text">';
            bg_no += '<span id="bg_no_error" style="color:red"></span>';
            bg_no += '</div>';

          

            var bg_date = '';
//                bg_date +=' <div class="form-group check_date row" style="">';
//                bg_date +='<div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Bg Date<sup style="color:red;">*</sup> :</label></div>';
//                bg_date +='<div class="col-sm-8 col-md-5 "><input  id="bg_issue_date" class="form-control datepicker" name="bg_issue_date" type="text"></div>';
//                bg_date +='<span id="bg_issue_date_error" style="color:red"></span>';
//                bg_date +='</div>';
            bg_date += ' <div class="form-group check_date" style="">';
            bg_date += '<label for="title" class="col-sm-4 control-label">Bg Date<sup style="color:red;">*</sup> :</label>';
            bg_date += '<div class="col-sm-8 col-md-8 input-group "><span class="input-group-addon"><i class="fa fa-check-square"></i></span><input  id="bg_issue_date" class="form-control datepicker" name="bg_issue_date" type="text"></div>';
            bg_date += '<span id="bg_issue_date_error" style="color:red"></span>';
            bg_date += '</div>';
            var exp_date = '';
//                exp_date +=' <div class="form-group check_date row" style="">';
//                exp_date +='<div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Exp. Date<sup style="color:red;">*</sup> :</label></div>';
//                exp_date +='<div class="col-sm-8 col-md-5 "><input  id="bg_expire_date" class="form-control datepicker" name="bg_expire_date" type="text"></div>';
//                exp_date +='<span id="bg_expire_date_error" style="color:red"></span>';
//                exp_date +='</div>';
            exp_date += ' <div class="form-group check_date" style="">';
            exp_date += '<label for="title" class="col-sm-4 control-label">Exp. Date<sup style="color:red;">*</sup> :</label>';
            exp_date += '<div class="col-sm-8 col-md-8 input-group"><span class="input-group-addon"><i class="fa fa-check-square"></i></span><input  id="bg_expire_date" class="form-control datepicker" name="bg_expire_date" type="text"></div>';
            exp_date += '<span id="bg_expire_date_error" style="color:red"></span>';
            exp_date += '</div>';
            var tenor = '';
//                 tenor +='<div class="form-group check_no row "  style=";">';
//                 tenor +='<div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Tenor<sup style="color:red;">*</sup> :</label></div>';
//                 tenor +='<div class="col-sm-8 col-md-5 ">';
//                 tenor +='<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();"  id="tenor" class="form-control number" name="tenor" type="text">';
//                 tenor +='<span id="tenor_error" style="color:red"></span>';
//                 tenor +='</div></div>';  
            tenor += '<div class="form-group check_no  "  style=";">';
            tenor += '<label for="title" class="col-sm-4 control-label">Tenor<sup style="color:red;">*</sup> :</label>';
            tenor += '<div class="col-sm-8 col-md-8 input-group"><span class="input-group-addon"><i class="fa fa-check-square"></i></span>';
            tenor += '<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();"  id="tenor" class="form-control number" name="tenor" type="text">';
            tenor += '<span id="tenor_error" style="color:red"></span>';
            tenor += '</div></div>';


            $('#date').html(bg_date);
            $('#expire_date').html(exp_date);
            $('#bg_lc_tenor').html(tenor);
            $('#no').html(bg_no);
            var datePickerOptions = {
                dateFormat: 'dd-mm-yy',
                firstDay: 1,
                changeMonth: true,
                changeYear: true,
                // ...
            }
            $('.datepicker').datepicker(datePickerOptions);
        } else if (method == "Lc") {
            $('#bank_id').val('');
            $('#bank').show();
            $('#bank_branch_id').val('');
            $('#bank_branch').show();
            $('#no').html('');
            $('#date').html('');
            $('#expire_date').html('');
            $('#bg_lc_tenor').html('');
            var lc_no = '';
            lc_no += '<div class="form-group check_no  "  style=";">';
            lc_no += '<label for="title" class="col-sm-4 control-label">Lc No<sup style="color:red;">*</sup> :</label>';
            lc_no += '<div class="col-sm-8 col-md-8 input-group"><span class="input-group-addon"><i class="fa fa-check-square"></i></span>';
            lc_no += '<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();" id="lc_no" class="number form-control" name="lc_no" type="text">';
            lc_no += '<span id="lc_no_error" style="color:red"></span>';
            lc_no += '</div></div>';

            var lc_date = '';
            lc_date += ' <div class="form-group check_date " style="">';
            lc_date += '<label for="title" class="col-sm-4 control-label">Lc Date<sup style="color:red;">*</sup> :</label>';
            lc_date += '<div class="col-sm-8 col-md-8 input-group"><span class="input-group-addon"><i class="fa fa-check-square"></i></span><input  id="lc_date" class="form-control datepicker" name="lc_date" type="text"></div>';
            lc_date += '<span id="lc_date_error" style="color:red"></span>';
            lc_date += '</div>';

            var tenor = '';
            tenor += '<div class="form-group check_no  "  style=";">';
            tenor += '<label for="title" class="col-sm-4 control-label">Tenor<sup style="color:red;">*</sup> :</label>';
            tenor += '<div class="col-sm-8 col-md-8 input-group"> <span class="input-group-addon"><i class="fa fa-check-square"></i></span>';
            tenor += '<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();"  id="tenor" class="number form-control" name="tenor" type="text">';
            tenor += '<span id="tenor_error" style="color:red"></span>';
            tenor += '</div></div>';


            $('#date').html(lc_date);
            $('#bg_lc_tenor').html(tenor);
            $('#no').html(lc_no);
            var datePickerOptions = {
                dateFormat: 'dd-mm-yy',
                firstDay: 1,
                changeMonth: true,
                changeYear: true,
                // ...
            }
            $('.datepicker').datepicker(datePickerOptions);
        } else if (method == "Adjustment") {
            $('#bank_id').val('');
            $('#bank').hide();
            $('#bank_branch_id').val('');
            $('#bank_branch').hide();
            $('#no').html('');
            $('#date').html('');
            $('#expire_date').html('');
            $('#bg_lc_tenor').html('');

        }else if (method == "Vat") {
            $('#bank_id').val('');
            $('#bank').hide();
            $('#bank_branch_id').val('');
            $('#bank_branch').hide();
            $('#no').html('');
            $('#date').html('');
            $('#expire_date').html('');
            $('#bg_lc_tenor').html('');

        }else if (method == "Ait") {
            $('#bank_id').val('');
            $('#bank').hide();
            $('#bank_branch_id').val('');
            $('#bank_branch').hide();
            $('#no').html('');
            $('#date').html('');
            $('#expire_date').html('');
            $('#bg_lc_tenor').html('');

        }else {
            $('#bank_id').val('');
            $('#bank').hide();
            $('#bank_branch_id').val('');
            $('#bank_branch').hide();
            $('#no').html('');
            $('#date').html('');
            $('#expire_date').html('');
            $('#bg_lc_tenor').html('');
        }
        
    })

    $(document).on('click', '.panel-heading span.clickable', function (e) {
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        } else {
            $this.parents('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        }
    })

</script>

