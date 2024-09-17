<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
     <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3> Edit Payment Collection</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <form class="form-horizontal"action="<?php echo site_url('payment_collections/edit_collection_action/'.$collection_info[0]['id']); ?>" method="post" onsubmit="javascript: return validation()">
        
       <div class='form-group' style="margin-bottom:30px;" >
                                <label for="title" class="col-sm-2 control-label">
                                    Sales Order<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select  id="o_id" class="form-control e1" name="o_id">
                            <option class="form-control" value="">Select Order</option>
                            <?php foreach($sale_orders as $order){ ?>
                                <option <?php if($order['o_id']==$collection_info[0]['o_id']) echo 'selected'; ?> class="form-control" value="<?php echo $order['o_id'] ?>"><?php echo $order['c_short_name'].'('.$order['project_name'].')'.'('.$order['order_no'].')' ?></option>
                            <?php } ?>
                       </select>
                         <span id="o_id_error" style="color:red"></span>
                                </div>
                                

                            </div> 
        
                        <div class='form-group' style="display:<?php if($collection_info[0]['receive_type']!="Invoice") echo "none"; ?>;" id="invoice_section" >
                                <label for="title" class="col-sm-2 control-label">
                                    Invoice<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select  id="invoice_id" class="form-control e1" name="invoice_id">
                                        <option class="form-control" value="">Select Invoice</option>
                                        <?php if(!empty($invoices)){ ?>
                                            <?php foreach($invoices as $invoice){ ?>
                                                    <option <?php if($invoice['inv_id']==$collection_info[0]['invoice_id']) echo 'selected'; ?> class="form-control" value="<?php echo $invoice['inv_id']  ?>"><?php echo $invoice['inv_no']."(".$invoice['total_value'].")";  ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                   </select>
                                <span id="invoice_id_error" style="color:red"></span>
                                </div>
                                

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                   Receive Type<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select id="receive_type" class="form-control" name="receive_type">
                            <option class="form-control" value="">Select Type</option>
                            <option <?php if($collection_info[0]['receive_type']=="Advance") echo 'selected'; ?> class="form-control" value="Advance">Advance</option>
                            <option <?php if($collection_info[0]['receive_type']=="Invoice") echo 'selected'; ?> class="form-control" value="Invoice">Invoice</option>    
                           
                       </select>
                       <span id="collection_time_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Receive Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                   <input  class="form-control datepicker" name="receive_date" type="text" value="<?php if(!empty($collection_info[0]['receive_date'])) echo date('d-m-Y',strtotime($collection_info[0]['receive_date'])) ?>">
                         <span id="receive_date_error" style="color:red"></span>
                                </div>

                            </div>
        
        <div class='form-group' >
                                <label for="title" class="col-sm-2 control-label">
                                   Payment Mode<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select  id="collection_method" class="form-control" name="collection_method">
                           <option class="form-control" value="">Select Mode</option>
                           <?php if($payment_mode[0]['b_cash']=="Cash" || $payment_mode[0]['a_cash']=="Cash"){ ?>
                                <option <?php if($collection_info[0]['collection_method']=="Cash") echo 'selected'; ?> class="form-control" value="Cash">Cash</option>
                           <?php } ?>
                          <?php if($payment_mode[0]['b_pdc']=="Pdc" || $payment_mode[0]['a_pdc']=="Pdc"){ ?>   
                              <option <?php if($collection_info[0]['collection_method']=="Pdc") echo 'selected'; ?> class="form-control" value="Pdc">Cheque</option>
                          <?php } ?>  
                           <?php if($payment_mode[0]['b_bg']=="Bg" || $payment_mode[0]['a_bg']=="Bg"){ ?>      
                               <option <?php if($collection_info[0]['collection_method']=="Bg") echo 'selected'; ?> class="form-control" value="Bg">Bg</option>
                           <?php } ?>
                           <?php if($payment_mode[0]['b_lc']=="Lc" || $payment_mode[0]['a_lc']=="Lc"){ ?>
                                <option <?php if($collection_info[0]['collection_method']=="Lc") echo 'selected'; ?> class="form-control" value="Lc">Lc</option>
                           <?php } ?> 
                       </select>
                        <span id="collection_method_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Amount<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  onkeyup="checkCollectAmount()" onchange="checkCollectAmount()"  id="amount" class="number form-control" name="amount" type="text" value="<?php if(!empty($collection_info[0]['amount'])) echo $collection_info[0]['amount']; ?>">
                        <span id="amount_error" style="color:red"></span>
                                </div>

                            </div>
        
        
        <div class="form-group">
            
                <?php if(!empty($collection_info[0]['check_no'])){ ?>
            
            <label for="title" class="col-sm-2 control-label">
                                    Cheque No<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input required id="check_no" class="number form-control" name="check_no" type="text" value="<?php if(!empty($collection_info[0]['check_no'])) echo $collection_info[0]['check_no']; ?>">
                                </div>
                    
                <?php }else if(!empty($collection_info[0]['po_no'])){ ?>
            <label for="title" class="col-sm-2 control-label">
                                   Po No<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input required id="po_no" class="number form-control" name="po_no" type="text" value="<?php if(!empty($collection_info[0]['po_no'])) echo $collection_info[0]['po_no']; ?>">
                                </div>
            
              <?php }else if(!empty($collection_info[0]['bg_no'])){ ?>  
                
            <label for="title" class="col-sm-2 control-label">
                                   Bg. No<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input required id="bg_no" class="number form-control" name="bg_no" type="text" value="<?php if(!empty($collection_info[0]['bg_no'])) echo $collection_info[0]['bg_no']; ?>">
                                </div>
            
            
               <?php }else if(!empty($collection_info[0]['lc_no'])){ ?> 
            <label for="title" class="col-sm-2 control-label">
                                   Lc. No<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input required id="lc_no" class="number form-control" name="lc_no" type="text" value="<?php if(!empty($collection_info[0]['lc_no'])) echo $collection_info[0]['lc_no']; ?>">
                                </div>
            
            
            
               
               <?php } ?> 
           
            
                <?php if(!empty($collection_info[0]['check_date'])){ ?>
            
            <label for="title" class="col-sm-2 control-label">
                                   Cheque Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input required id="check_date" class="form-control datepicker" name="check_date" type="text" value="<?php if(!empty($collection_info[0]['check_date'])) echo date('d-m-Y',strtotime($collection_info[0]['check_date'])) ?>">
                                </div>
            
                <?php }else if(!empty($collection_info[0]['po_date'])){ ?>
            <label for="title" class="col-sm-2 control-label">
                                   PO. Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input required id="po_date" class="form-control datepicker" name="po_date" type="text" value="<?php if(!empty($collection_info[0]['po_date'])) echo date('d-m-Y',strtotime($collection_info[0]['po_date'])) ?>">
                                </div>
            
            
                    
                <?php }else if(!empty($collection_info[0]['bg_issue_date'])){ ?>
            <label for="title" class="col-sm-2 control-label">
                                   Bg. Issue Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input required id="bg_issue_date" class="form-control datepicker" name="bg_issue_date" type="text" value="<?php if(!empty($collection_info[0]['bg_issue_date'])) echo date('d-m-Y',strtotime($collection_info[0]['bg_issue_date'])) ?>">
                                </div>
            
                    
                <?php }else if(!empty($collection_info[0]['lc_date'])){ ?>
            <label for="title" class="col-sm-2 control-label">
                                   Lc Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input required id="lc_date" class="form-control datepicker" name="lc_date" type="text" value="<?php if(!empty($collection_info[0]['lc_date'])) echo date('d-m-Y',strtotime($collection_info[0]['lc_date'])) ?>">
                                </div>
            
                    
                <?php } ?>
            
            
        </div>
        
        
         <div class="form-group">
            
           <?php if(!empty($collection_info[0]['tenor'])){ ?>
            
            <label for="title" class="col-sm-2 control-label">
                                   Tenor<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input required id="tenor" class="number form-control" name="tenor" type="text" value="<?php if(!empty($collection_info[0]['tenor'])) echo $collection_info[0]['tenor']; ?>">
                                </div>
           <?php }?>
                <?php if(!empty($collection_info[0]['bg_expire_date'])){ ?>
            <label for="title" class="col-sm-2 control-label">
                                   Exp. Date<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input required id="bg_expire_date" class="form-control datepicker" name="bg_expire_date" type="text" value="<?php if(!empty($collection_info[0]['bg_expire_date'])) echo date('d-m-Y',strtotime($collection_info[0]['bg_expire_date'])) ?>">
                                </div>
            
            
                    
                <?php } ?>
            
            
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <div class='form-group' >
             <div id="bank" style="display:<?php if($collection_info[0]['collection_method']=="Cash") echo 'none'; ?>">
                                <label for="title" class="col-sm-2 control-label">
                                  Bank<sup class="required">*</sup>  :
                                </label> 
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select id="o_id" class="form-control" name="bank_id">
                            <option class="form-control" value="">Select Bank</option>
                            <?php foreach($banks as $bank){ ?>
                                <option <?php if($collection_info[0]['bank_id']==$bank['id']) echo 'selected'; ?>  class="form-control" value="<?php echo $bank['id'] ?>"><?php echo $bank['b_short_name'].'('.$bank['branch_name'].')' ?></option>
                            <?php } ?>
                       </select>
                                </div>
                </div>
                                <label for="title" class="col-sm-2 control-label">
                                    Remark<sup class="required">*</sup> :
                                </label>
                                <div class="col-sm-4 input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                    <input  class="form-control " name="remark" type="text" value="<?php if(!empty($collection_info[0]['remark'])) echo $collection_info[0]['remark']; ?>">
                                </div>

                            </div>
        
        
<!--        <div class="row" style="margin-left:-75px;">
            <div class="col-md-7">
                    <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Sales Order<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-6 ">
                        <select  id="o_id" class="form-control e1" name="o_id">
                            <option class="form-control" value="">Select Order</option>
                            <?php foreach($sale_orders as $order){ ?>
                                <option <?php if($order['o_id']==$collection_info[0]['o_id']) echo 'selected'; ?> class="form-control" value="<?php echo $order['o_id'] ?>"><?php echo $order['c_short_name'].'('.$order['project_name'].')'.'('.$order['order_no'].')' ?></option>
                            <?php } ?>
                       </select>
                         <span id="o_id_error" style="color:red"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                    
            </div>
            
        </div>-->
        
        
<!--        <div class="row">
            
            <div class="col-md-6" >
                    
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;">
                        <label for="inputdefault">Receive Time<sup style="color:red;">*</sup>:</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <select id="collection_time" class="form-control" name="collection_time">
                            <option class="form-control" value="">Select Time</option>
                            <option <?php if($collection_info[0]['collection_time']=="Before Delivery") echo 'selected'; ?> class="form-control" value="Before Delivery">Before Delivery</option>
                            <option <?php if($collection_info[0]['collection_time']=="After Delivery") echo 'selected'; ?> class="form-control" value="After Delivery">After Delivery</option>    
                           
                       </select>
                       <span id="collection_time_error" style="color:red"></span>
                    </div>
                
            </div>
            
             <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Rec. Date<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                         <input  class="form-control datepicker" name="receive_date" type="text" value="<?php if(!empty($collection_info[0]['receive_date'])) echo date('d-m-Y',strtotime($collection_info[0]['receive_date'])) ?>">
                         <span id="receive_date_error" style="color:red"></span>
                    </div>
                </div>
            </div>
            
        </div>-->
          
<!--         <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Payment Mode<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <select  id="collection_method" class="form-control" name="collection_method">
                           <option class="form-control" value="">Select Mode</option>
                           <?php if($payment_mode[0]['b_cash']=="Cash" || $payment_mode[0]['a_cash']=="Cash"){ ?>
                                <option <?php if($collection_info[0]['collection_method']=="Cash") echo 'selected'; ?> class="form-control" value="Cash">Cash</option>
                           <?php } ?>
                          <?php if($payment_mode[0]['b_pdc']=="Pdc" || $payment_mode[0]['a_pdc']=="Pdc"){ ?>   
                              <option <?php if($collection_info[0]['collection_method']=="Pdc") echo 'selected'; ?> class="form-control" value="Pdc">Cheque</option>
                          <?php } ?>  
                           <?php if($payment_mode[0]['b_bg']=="Bg" || $payment_mode[0]['a_bg']=="Bg"){ ?>      
                               <option <?php if($collection_info[0]['collection_method']=="Bg") echo 'selected'; ?> class="form-control" value="Bg">Bg</option>
                           <?php } ?>
                           <?php if($payment_mode[0]['b_lc']=="Lc" || $payment_mode[0]['a_lc']=="Lc"){ ?>
                                <option <?php if($collection_info[0]['collection_method']=="Lc") echo 'selected'; ?> class="form-control" value="Lc">Lc</option>
                           <?php } ?> 
                       </select>
                        <span id="collection_method_error" style="color:red"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Amount<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <input  onkeyup="checkCollectAmount()" onchange="checkCollectAmount()"  id="amount" class="number form-control" name="amount" type="text" value="<?php if(!empty($collection_info[0]['amount'])) echo $collection_info[0]['amount']; ?>">
                        <span id="amount_error" style="color:red"></span>
                    </div>
                </div>
            </div>
            
        </div>-->
        
<!--          <div class="row">
            <div class="col-md-6" id="no">
                <?php if(!empty($collection_info[0]['check_no'])){ ?>
                    <div class="form-group check_no row "  style="">
                        <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Cheque No<sup style="color:red;">*</sup> :</label></div>
                        <div class="col-sm-8 col-md-5 ">
                            <input required id="check_no" class="number form-control" name="check_no" type="text" value="<?php if(!empty($collection_info[0]['check_no'])) echo $collection_info[0]['check_no']; ?>">
                        </div>
                    </div>
                <?php }else if(!empty($collection_info[0]['po_no'])){ ?>
                    <div class="form-group po_no row "  style="">
                        <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Po No<sup style="color:red;">*</sup> :</label></div>
                        <div class="col-sm-8 col-md-5 ">
                            <input required id="po_no" class="number form-control" name="po_no" type="text" value="<?php if(!empty($collection_info[0]['po_no'])) echo $collection_info[0]['po_no']; ?>">
                        </div>
                    </div>
              <?php }else if(!empty($collection_info[0]['bg_no'])){ ?>  
                <div class="form-group bg_no row" style="">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Bg. No<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <input required id="bg_no" class="number form-control" name="bg_no" type="text" value="<?php if(!empty($collection_info[0]['bg_no'])) echo $collection_info[0]['bg_no']; ?>">
                    </div>
                </div>
               <?php }else if(!empty($collection_info[0]['lc_no'])){ ?> 
                <div class="form-group lc_no row"  style="">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Lc No<sup style="color:red;">*</sup> :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <input required id="lc_no" class="number form-control" name="lc_no" type="text" value="<?php if(!empty($collection_info[0]['lc_no'])) echo $collection_info[0]['lc_no']; ?>">
                    </div>
                </div>
               <?php } ?> 
            </div>End Col-md-6
            <div class="col-md-6" id="date">
                <?php if(!empty($collection_info[0]['check_date'])){ ?>
                    <div class="form-group check_date row" style="">
                        <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Cheque Date<sup style="color:red;">*</sup> :</label></div>
                        <div class="col-sm-8 col-md-5 "><input required id="check_date" class="form-control datepicker" name="check_date" type="text" value="<?php if(!empty($collection_info[0]['check_date'])) echo date('d-m-Y',strtotime($collection_info[0]['check_date'])) ?>"></div>
                    </div>
                <?php }else if(!empty($collection_info[0]['po_date'])){ ?>
                    <div class="form-group po_date row"  style="">
                        <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Po. Date<sup style="color:red;">*</sup> :</label></div>
                        <div class="col-sm-8 col-md-5 "><input required id="po_date" class="form-control datepicker" name="po_date" type="text" value="<?php if(!empty($collection_info[0]['po_date'])) echo date('d-m-Y',strtotime($collection_info[0]['po_date'])) ?>"></div>
                    </div>
                <?php }else if(!empty($collection_info[0]['bg_issue_date'])){ ?>
                    <div class="form-group bg_issue_date row"  style="">
                        <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Bg. Issue Date<sup style="color:red;">*</sup> :</label></div>
                        <div class="col-sm-8 col-md-5 "><input required id="bg_issue_date" class="form-control datepicker" name="bg_issue_date" type="text" value="<?php if(!empty($collection_info[0]['bg_issue_date'])) echo date('d-m-Y',strtotime($collection_info[0]['bg_issue_date'])) ?>"></div>
                    </div>
                <?php }else if(!empty($collection_info[0]['lc_date'])){ ?>
                    <div class="form-group lc_date row"  style="">
                        <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Lc Date :</label></div>
                        <div class="col-sm-8 col-md-5 "><input required id="lc_date" class="form-control datepicker" name="lc_date" type="text" value="<?php if(!empty($collection_info[0]['lc_date'])) echo date('d-m-Y',strtotime($collection_info[0]['lc_date'])) ?>"></div>
                    </div>
                <?php } ?>
            </div>End Col-md-6
            
        </div>-->
        
<!--        <div class="row">
            <div class="col-md-6" id="bg_lc_tenor">
                <?php if(!empty($collection_info[0]['tenor'])){ ?>
                    <div class="form-group tenor row"  style="">
                        <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Tenor<sup style="color:red;">*</sup> :</label></div>
                        <div class="col-sm-8 col-md-5 ">
                            <input required id="tenor" class="number form-control" name="tenor" type="text" value="<?php if(!empty($collection_info[0]['tenor'])) echo $collection_info[0]['tenor']; ?>">
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-6" id="expire_date">
                 <?php if(!empty($collection_info[0]['bg_expire_date'])){ ?>
                    <div class="form-group bg_expire_date row"  style="">
                        <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Exp. Date<sup style="color:red;">*</sup> :</label></div>
                        <div class="col-sm-8 col-md-5 ">
                            <input required id="bg_expire_date" class="form-control datepicker" name="bg_expire_date" type="text" value="<?php if(!empty($collection_info[0]['bg_expire_date'])) echo date('d-m-Y',strtotime($collection_info[0]['bg_expire_date'])) ?>">
                        </div>
                    </div>
                 <?php } ?>
            </div>
        </div>-->
        
        
<!--         <div class="row">
            <div class="col-md-6">
                   <div class="form-group row" id="bank" style="display:<?php if($collection_info[0]['collection_method']=="Cash") echo 'none'; ?>">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Bank :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <select id="o_id" class="form-control" name="bank_id">
                            <option class="form-control" value="">Select Bank</option>
                            <?php foreach($banks as $bank){ ?>
                                <option <?php if($collection_info[0]['bank_id']==$bank['id']) echo 'selected'; ?>  class="form-control" value="<?php echo $bank['id'] ?>"><?php echo $bank['b_short_name'].'('.$bank['branch_name'].')' ?></option>
                            <?php } ?>
                       </select>
                    </div>
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Remark :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                         <input  class="form-control " name="remark" type="text" value="<?php if(!empty($collection_info[0]['remark'])) echo $collection_info[0]['remark']; ?>">
                    </div>
                </div>
            </div>
            
        </div>-->
       
        <hr>
        <h2 style="text-align: center;">Payment condition and status</h2>
        <button type="button" style="padding-left:6px;padding-right:6px;font-size:8px;" id="payment_hide_button"  class="btn btn-primary "><span class="glyphicon glyphicon-minus"></span></button>
        <button  type="button" style="display:none;padding-left:6px;padding-right:6px;font-size:8px;" id="payment_show_button"  class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span></button>
        <div id="payment_condition">
           <div class="row">
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
                        <?php if(!empty($payment_mode[0]['b_cash']) || !empty($payment_mode[0]['a_cash'])){ ?>
                                <tr>
                                    <td><?php echo $payment_mode[0]['b_cash'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_cash_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_cash_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_cash_amount'];  ?></td>
                                    <td><?php echo $payment_mode[0]['a_cash'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_cash_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_cash_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_cash_amount'];  ?></td>
                                </tr>
                        <?php } ?>
                        <?php if(!empty($payment_mode[0]['b_bg']) || !empty($payment_mode[0]['a_bg'])){ ?>
                                <tr>
                                    <td><?php echo $payment_mode[0]['b_bg'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_bg_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_bg_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_bg_amount'];  ?></td>
                                    <td><?php echo $payment_mode[0]['a_bg'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_bg_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_bg_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_bg_amount'];  ?></td>
                                </tr>
                        <?php } ?> 
                         
                        <?php if(!empty($payment_mode[0]['b_lc']) || !empty($payment_mode[0]['a_lc'])){ ?>
                                <tr>
                                    <td><?php echo $payment_mode[0]['b_lc'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_lc_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_lc_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_lc_amount'];  ?></td>
                                    <td><?php echo $payment_mode[0]['a_lc'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_lc_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_lc_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_lc_amount'];  ?></td>
                                </tr>
                        <?php } ?> 
                       <?php if(!empty($payment_mode[0]['b_pdc']) || !empty($payment_mode[0]['a_pdc'])){ ?>
                                <tr>
                                    <td><?php echo $payment_mode[0]['b_pdc'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_pdc_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_pdc_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['b_pdc_amount'];  ?></td>
                                    <td><?php echo $payment_mode[0]['a_pdc'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_pdc_tenor'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_pdc_percent'];  ?></td>
                                    <td style="text-align: right;"><?php echo $payment_mode[0]['a_pdc_amount'];  ?></td>
                                </tr>
                     <?php } ?>          
                                
                                
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
                        <tr>
                            <td style="text-align: right;"><?php if(!empty($total_amount)) echo $total_amount; ?></td>
                            <td style="text-align: right;"><?php if(!empty($total_paid)) echo $total_paid; ?></td>
                            <td style="text-align: right;"><input type="hidden" id="due_amount" value="<?php if(!empty($total_due)) echo $total_due; ?>"><?php if(!empty($total_due)) echo $total_due; ?></td>
                        </tr>
                    </tbody>
                 </table>
               
                  <table class="table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                     <thead>
                          
                        <tr>
                            <th>Payment Mode</th>
                            <th>Amount</th>
                            <th>Receive</th>
                            <th>Due</th>

                       </tr>
                    </thead> 
                    <tbody id="paymentBalanceBody">
                        <?php if(!empty($payment_mode[0]['b_cash']) || !empty($payment_mode[0]['a_cash'])){ ?>
                            <tr>
                               <td>Cash</td>
                               <td style="text-align: right;"><?php if(!empty($total_cash_amount)) echo $total_cash_amount; ?></td>
                               <td style="text-align: right;"><?php if(!empty($paid_cash_amount[0]['total'])) echo $paid_cash_amount[0]['total']; ?></td>
                               <td style="text-align: right;"><input  id="cash_due" class="form-control" name="cash_due" type="hidden" style="text-align: right;" value="<?php if(!empty($due_cash_amount)) echo $due_cash_amount; ?>"><?php if(!empty($due_cash_amount)) echo $due_cash_amount; ?></td>
                           </tr>
                        <?php } ?>
                        <?php if(!empty($payment_mode[0]['b_pdc']) || !empty($payment_mode[0]['a_pdc'])){ ?>
                            <tr>
                               <td>Pdc</td>
                               <td style="text-align: right;"><?php if(!empty($total_pdc_amount)) echo $total_pdc_amount; ?></td>
                               <td style="text-align: right;"><?php if(!empty($paid_pdc_amount[0]['total'])) echo $paid_pdc_amount[0]['total']; ?></td>
                               <td style="text-align: right;"><input  id="pdc_due" class="form-control" name="pdc_due" type="hidden" style="text-align: right;" value="<?php if(!empty($due_pdc_amount)) echo $due_pdc_amount; ?>"><?php if(!empty($due_pdc_amount)) echo $due_pdc_amount; ?></td>
                           </tr>
                        <?php } ?>
                       <?php if(!empty($payment_mode[0]['b_lc']) || !empty($payment_mode[0]['a_lc'])){ ?>
                            <tr>
                               <td>Lc</td>
                               <td style="text-align: right;"><?php if(!empty($total_lc_amount)) echo $total_lc_amount; ?></td>
                               <td style="text-align: right;"><?php if(!empty($paid_lc_amount[0]['total'])) echo $paid_lc_amount[0]['total']; ?></td>
                               <td style="text-align: right;"><input  id="lc_due" class="form-control" name="lc_due" type="hidden" style="text-align: right;" value="<?php if(!empty($due_lc_amount)) echo $due_lc_amount; ?>"><?php if(!empty($due_lc_amount)) echo $due_lc_amount; ?></td>
                           </tr>
                        <?php } ?> 
                        <?php if(!empty($payment_mode[0]['b_bg']) || !empty($payment_mode[0]['a_bg'])){ ?>
                            <tr>
                               <td>Bg</td>
                               <td style="text-align: right;"><?php if(!empty($total_bg_amount)) echo $total_bg_amount; ?></td>
                               <td style="text-align: right;"><?php if(!empty($paid_bg_amount[0]['total'])) echo $paid_bg_amount[0]['total']; ?></td>
                               <td style="text-align: right;"><input  id="bg_due" class="form-control" name="bg_due" type="hidden" style="text-align: right;" value="<?php if(!empty($due_bg_amount)) echo $due_bg_amount; ?>"><?php if(!empty($due_bg_amount)) echo $due_bg_amount; ?></td>
                           </tr>
                        <?php } ?>   
                    </tbody>
                 </table>  
               
               
                    

          </div>
        
        
       
        
       
       
           
        
        </div><!--End Condition And Status-->      
        
        <hr> 

       
        
        <div class="row">
           <div class="col-md-2">
                <a href="<?php echo site_url('backend/payment_collections') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
            </div>
            <div class="col-md-2 ">
                <button type="submit" class="btn btn-primary button" onclick="javascript:validation();">UPDATE</button>
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
     $('#payment_hide_button').click(function (){
        $('#payment_condition').hide();
        $('#payment_show_button').show();
        $('#payment_hide_button').hide();
    });
    
    $('#payment_show_button').click(function (){
        $('#payment_condition').show();
        $('#payment_hide_button').show();
        $('#payment_show_button').hide();
        
    });
    
     function validation(){
          
        var receive_date=$('#receive_date').val();
        var collection_time=$('#collection_time').val();
        var o_id=$('#o_id').val(); 
        var amount=$('#amount').val(); 
        var collection_method=$('#collection_method').val(); 
        var error=false;
        
        if(o_id==''){
            $('#o_id_error').html('Please select order');
            $('#o_id').css('border','1px solid red');
            error=true;
            $('#o_id').focus();
        }else{
            $('#o_id_error').html('');
            $('#o_id').css('border','1px solid #ccc');   
            
        }
        
        if(receive_date==''){
            $('#receive_date').css('border','1px solid red');
            $('#receive_date_error').html('Please fill receive date field');
            error=true;
           $('#receive_date').focus();
           
        }else{
            $('#receive_date').css('border','1px solid #ccc');
            $('#receive_date_error').html('');
            
        }
       if(collection_time==''){
            $('#collection_time').css('border','1px solid red');
            $('#collection_time_error').html('Please select receive time');
            error=true;
            $('#collection_time').focus();
           
        }else{
            $('#collection_time').css('border','1px solid #ccc');
            $('#collection_time_error').html('');
            
        }
        
       
        
        if(collection_method==''){
            $('#collection_method_error').html('Please select collection method');
            $('#collection_method').css('border','1px solid red');
            error=true;
            $('#collection_method').focus();
        }else{
            $('#collection_method_error').html('');
            $('#collection_method').css('border','1px solid #ccc');   
            if(collection_method=="Pdc"){
                var check_no=$('#check_no').val();
                var check_date=$('#check_date').val();
                 if(check_no==''){
                    $('#check_no_error').html('Please fill pdc number field');
                    $('#check_no').css('border','1px solid red');
                    error=true;  
                    $('#check_no').focus();
                }else{
                   $('#check_no_error').html('');
                   $('#check_no').css('border','1px solid #ccc');    
                }
                
                if(check_date==''){
                    $('#check_date_error').html('Please fill chque date field');
                    $('#check_date').css('border','1px solid red');
                    error=true;  
                    $('#check_date').focus();
                }else{
                   $('#check_date_error').html('');
                   $('#check_date').css('border','1px solid #ccc');    
                }
            }else if(collection_method=="Bg"){
                var bg_no=$('#bg_no').val();
                var bg_issue_date=$('#bg_issue_date').val();
                var bg_expire_date=$('#bg_expire_date').val();
                var tenor=$('#tenor').val();
                
                if(bg_no==''){
                    $('#bg_no_error').html('Please fill bg number field');
                    $('#bg_no').css('border','1px solid red');
                    error=true;
                    $('#bg_no').focus();
                }else{
                   $('#bg_no_error').html('');
                   $('#bg_no').css('border','1px solid #ccc');    
                }
                if(bg_issue_date==''){
                    $('#bg_issue_date_error').html('Please fill bg issue date field');
                    $('#bg_issue_date').css('border','1px solid red');
                    error=true;  
                    $('#bg_issue_date').focus();
                }else{
                   $('#bg_issue_date_error').html('');
                   $('#bg_issue_date').css('border','1px solid #ccc');    
                }
                if(bg_expire_date==''){
                    $('#bg_expire_date_error').html('Please fill bg expire date field');
                    $('#bg_expire_date').css('border','1px solid red');
                    error=true;
                    $('#bg_expire_date').focus();
                }else{
                   $('#bg_expire_date_error').html('');
                   $('#bg_expire_date').css('border','1px solid #ccc');    
                }
                 if(tenor==''){
                    $('#tenor_error').html('Please fill tenor field');
                    $('#tenor').css('border','1px solid red');
                    error=true;  
                    $('#tenor').focus();
                }else{
                   $('#tenor_error').html('');
                   $('#tenor').css('border','1px solid #ccc');    
                }
            }else if(collection_method=="Lc"){
                var lc_no=$('#lc_no').val();
                var lc_date=$('#lc_date').val();
                var tenor=$('#tenor').val();
                
                if(lc_no==''){
                    $('#lc_no_error').html('Please fill lc number field');
                    $('#lc_no').css('border','1px solid red');
                    error=true;  
                    $('#lc_no').focus();
                }else{
                   $('#lc_no_error').html('');
                   $('#lc_no').css('border','1px solid #ccc');    
                }
                if(lc_date==''){
                    $('#lc_date_error').html('Please fill lc  date field');
                    $('#lc_date').css('border','1px solid red');
                    error=true;  
                    $('#lc_date').focus();
                }else{
                   $('#lc_date_error').html('');
                   $('#lc_date').css('border','1px solid #ccc');    
                }
               
                 if(tenor==''){
                    $('#tenor_error').html('Please fill tenor field');
                    $('#tenor').css('border','1px solid red');
                    error=true;  
                    $('#tenor').focus();
                }else{
                   $('#tenor_error').html('');
                   $('#tenor').css('border','1px solid #ccc');    
                }
            }     
            
        }
        if(amount==''){
            $('#amount_error').html('Please fill amount field');
            $('#amount').css('border','1px solid red');
            error=true;
        }else{
            $('#amount_error').html('');
            $('#amount').css('border','1px solid #ccc');   
            
        }
        
        if(error==true){
            return false;
        }
    }
    
    
    function checkCollectAmount(){   
        var c_method=$('#collection_method').val();
        var amount=Number($('#amount').val());
        var due_amount=Number($('#due_amount').val());
        if(c_method!=''){
            if(amount>due_amount){
                $('#amount').val('');
                alert('Collection amount should not be more than due amount');   
            }
        }else{
            $('#amount').val('');
            alert('Please select payment mode');
        }     
            
        
    } 
    
    function checkCollectAmount_pre(){
       
        var c_method=$('#collection_method').val();
        var amount=Number($('#amount').val());
        if(c_method!=''){
            if(c_method=="Cash"){
                var cash_due=Number($('#cash_due').val());
                if(amount>cash_due){
                     $('#amount').val('');
                     alert('Collection amount should not be more than due amount');   
                }
            }else if(c_method=="Pdc"){
                var pdc_due=Number($('#pdc_due').val());
                if(amount>pdc_due){
                     $('#amount').val('');
                     alert('Collection amount should not be more than due amount');   
                }
            }else if(c_method=="Lc"){
                var lc_due=Number($('#lc_due').val());
                if(amount>lc_due){
                     $('#amount').val('');
                     alert('Collection amount should not be more than due amount');   
                }
            }else if(c_method=="Bg"){
                var bg_due=Number($('#bg_due').val());
                if(amount>bg_due){
                     $('#amount').val('');
                     alert('Collection amount should not be more than due amount');   
                }
            }
        }else{
            $('#amount').val('');
            alert('Please select payment mode');
        }     
            
        
    }
    
    $('#receive_type').change(function(){
        alert('test');
         var r_type=$('#receive_type').val();
         if(r_type=="Invoice"){
             $('#invoice_section').show();
             $('#receive_type').attr('required',true);
         }else{
             $('#invoice_section').hide();
             $('#receive_type').attr('required',false);
         }
    });
    
    
    $('#o_id').change(function(){
        
        var o_id=$('#o_id').val();
        if(o_id!=''){
            $('#paymentConditionBody').html('');
            $('#paymentCollectionBody').html(''); 
            $('#paymentBalanceBody').html('');
           
             $.ajax({
                    url: '<?php echo site_url('payment_collections/get_payment_mode'); ?>',
                    data:{'o_id':o_id},
                    method: 'POST',
                    dataType: 'json',
                    success: function (msg) { 
                        var option='<option class="form-control" value="">Select Mode</option>';
                        if(msg.payment_mode!=''){
                            if(msg.payment_mode[0].b_cash=="Cash" || msg.payment_mode[0].a_cash=="Cash" ){
                                option+='<option class="form-control" value="Cash">Cash</option>';
                            } 
                            if(msg.payment_mode[0].b_bg=="Bg" || msg.payment_mode[0].a_bg=="Bg" ){
                                option+='<option class="form-control" value="Bg">BG</option>';
                            } 
                            if(msg.payment_mode[0].b_lc=="Lc" || msg.payment_mode[0].a_lc=="Lc" ){
                                option+='<option class="form-control" value="Lc">LC</option>';
                            } 
                            if(msg.payment_mode[0].b_pdc=="Pdc" || msg.payment_mode[0].a_pdc=="Pdc" ){
                                option+='<option class="form-control" value="Pdc">Pdc</option>';
                            } 
                        }    
                        $('#collection_method').html(option);
                        
                     
                       var tbl_row='';
                       if(msg.payment_mode[0].b_cash_percent>0 || msg.payment_mode[0].a_cash_percent>0){
                           tbl_row +='<tr>';
                           tbl_row +='<td>'+msg.payment_mode[0].b_cash+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_cash_tenor+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_cash_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_cash_amount+'</td>';
                           tbl_row +='<td>'+msg.payment_mode[0].a_cash+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_cash_tenor+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_cash_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_cash_amount+'</td>';
                           tbl_row +='</tr>';
                       }
                       if(msg.payment_mode[0].b_bg_percent>0 || msg.payment_mode[0].a_bg_percent>0){
                           tbl_row +='<tr>';
                           tbl_row +='<td>'+msg.payment_mode[0].b_bg+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_bg_tenor+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_bg_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_bg_amount+'</td>';
                           tbl_row +='<td>'+msg.payment_mode[0].a_bg+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_bg_tenor+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_bg_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_bg_amount+'</td>';
                           tbl_row +='</tr>';
                       }
                       
                       if(msg.payment_mode[0].b_lc_percent>0 || msg.payment_mode[0].a_lc_percent>0){
                           tbl_row +='<tr>';
                           tbl_row +='<td>'+msg.payment_mode[0].b_lc+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_lc_tenor+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_lc_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_lc_amount+'</td>';
                           tbl_row +='<td>'+msg.payment_mode[0].a_lc+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_lc_tenor+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_lc_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_lc_amount+'</td>';
                           tbl_row +='</tr>';
                      }
                      
                      if(msg.payment_mode[0].b_pdc_percent>0 || msg.payment_mode[0].a_pdc_percent>0){
                           tbl_row +='<tr>';
                           tbl_row +='<td>'+msg.payment_mode[0].b_pdc+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_pdc_tenor+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_pdc_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].b_pdc_amount+'</td>';
                           tbl_row +='<td>'+msg.payment_mode[0].a_pdc+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_pdc_tenor+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_pdc_percent+'</td>'+'<td style="text-align:right;">'+msg.payment_mode[0].a_pdc_amount+'</td>';
                           tbl_row +='</tr>';
                      }  
                      
                      $('#paymentConditionBody').html(tbl_row);
                           
        
       
                     var tbl_row1='';  
                     tbl_row1 +='<tr>';
                     tbl_row1 +='<td style="text-align:right;">'+msg.total_amount+'</td>';
                     tbl_row1 +='<td style="text-align:right;">'+msg.total_paid+'</td>';
                     tbl_row1 +='<td style="text-align:right;"><input type="hidden" id="due_amount" value="'+msg.total_due+'" />'+msg.total_due+'</td>';
                     tbl_row1 +='</tr>';
                      
                     $('#paymentCollectionBody').html(tbl_row1);    
                        
                        var tbl_row2='';  
                        if(msg.payment_mode[0].b_cash_percent>0 || msg.payment_mode[0].a_cash_percent>0){
                            tbl_row2 +='<tr>';
                            tbl_row2 +='<td style="">Cash</td>';
                            tbl_row2 +='<td style="text-align:right;">'+msg.total_cash_amount+'</td>';
                            tbl_row2 +='<td style="text-align:right;">'+msg.paid_cash_amount[0].total+'</td>';
                            tbl_row2 +='<td style="text-align:right;"><input  id="cash_due" class="form-control" name="cash_due" type="hidden" style="text-align: right;" value="'+msg.due_cash_amount+'">'+msg.due_cash_amount+'</td>';
                            tbl_row2 +='</tr>';
                           
                        }
                        
                        if(msg.payment_mode[0].b_pdc_percent>0 || msg.payment_mode[0].a_pdc_percent>0){
                            tbl_row2 +='<tr>';
                            tbl_row2 +='<td style="">Pdc</td>';
                            tbl_row2 +='<td style="text-align:right;">'+msg.total_pdc_amount+'</td>';
                            tbl_row2 +='<td style="text-align:right;">'+msg.paid_pdc_amount[0].total+'</td>';
                            tbl_row2 +='<td style="text-align:right;"><input  id="pdc_due" class="form-control" name="pdc_due" type="hidden" style="text-align: right;" value="'+msg.due_pdc_amount+'">'+msg.due_pdc_amount+'</td>';
                            tbl_row2 +='</tr>';
                            
                        }
                       
                        if(msg.payment_mode[0].b_lc_percent>0 || msg.payment_mode[0].a_lc_percent>0){
                            tbl_row2 +='<tr>';
                            tbl_row2 +='<td style="">Lc</td>';
                            tbl_row2 +='<td style="text-align:right;">'+msg.total_lc_amount+'</td>';
                            tbl_row2 +='<td style="text-align:right;">'+msg.paid_lc_amount[0].total+'</td>';
                            tbl_row2 +='<td style="text-align:right;"><input  id="lc_due" class="form-control" name="lc_due" type="hidden" style="text-align: right;" value="'+msg.due_lc_amount+'">'+msg.due_lc_amount+'</td>';
                            tbl_row2 +='</tr>';
                            
                        }
                        
                        if(msg.payment_mode[0].b_bg_percent>0 || msg.payment_mode[0].a_bg_percent>0){
                            tbl_row2 +='<tr>';
                            tbl_row2 +='<td style="">Bg</td>';
                            tbl_row2 +='<td style="text-align:right;">'+msg.total_bg_amount+'</td>';
                            tbl_row2 +='<td style="text-align:right;">'+msg.paid_bg_amount[0].total+'</td>';
                            tbl_row2 +='<td style="text-align:right;"><input  id="bg_due" class="form-control" name="bg_due" type="hidden" style="text-align: right;" value="'+msg.due_bg_amount+'">'+msg.due_bg_amount+'</td>';
                            tbl_row2 +='</tr>';
                            
                        }
                        $('#paymentBalanceBody').html(tbl_row2); 
                        
                    }

                })
        }else{
            $('#paymentConditionBody').html('');
            $('#paymentCollectionBody').html(''); 
            $('#paymentBalanceBody').html('');
            
            
        }
       
    });
    
    
    
    
    
    
    
  $('#collection_method').change(function(){
        
        var method=$('#collection_method').val();
        if(method=="Cash"){
           $('#bank').hide();
           $('#no').html('');
           $('#date').html('');
           $('#expire_date').html('');
           $('#bg_lc_tenor').html('');
            
        }else if(method=="Pdc"){
           $('#bank_id').val('');
           $('#bank').show(); 
           $('#no').html('');
           $('#date').html('');
           $('#expire_date').html('');
           $('#bg_lc_tenor').html('');
           var pdc_no='<div class="form-group check_no row "  style=";">';
                 pdc_no +='<div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Cheque No<sup style="color:red;">*</sup> :</label></div>';
                 pdc_no +='<div class="col-sm-8 col-md-5 ">';
                 pdc_no +='<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();"  id="check_no" class="form-control number" name="check_no" type="text">';
                 pdc_no +='<span id="check_no_error" style="color:red"></span>';
                 pdc_no +='</div></div>';  
           var pdc_date=' <div class="form-group check_date row" style="">';
                pdc_date +='<div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Cheque Date<sup style="color:red;">*</sup> :</label></div>';
                pdc_date +='<div class="col-sm-8 col-md-5 "><input  id="check_date" class="form-control datepicker" name="check_date" type="text"></div>';
                pdc_date +='<span id="check_date_error" style="color:red"></span>';
                pdc_date +='</div>';
                
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
           
           
        }else if(method=="Po"){
           $('#bank_id').val('');
           $('#bank').show();
           $('#no').html('');
           $('#date').html('');
           $('#expire_date').html('');
           $('#bg_lc_tenor').html('');
           var po_no='';
                 po_no +='<div class="form-group check_no row "  style=";">';
                 po_no +='<div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Po No<sup style="color:red;">*</sup> :</label></div>';
                 po_no +='<div class="col-sm-8 col-md-5 ">';
                 po_no +='<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();" required id="po_no" class="number form-control" name="po_no" type="text">';
                 po_no +='<span id="po_no_error"></span>';
                 po_no +='</div></div>';  
          var po_date='';    
                 
                po_date +=' <div class="form-group check_date row" style="">';
                po_date +='<div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Po Date<sup style="color:red;">*</sup> :</label></div>';
                po_date +='<div class="col-sm-8 col-md-5 "><input required id="po_date" class="form-control datepicker" name="po_date" type="text"></div>';
                po_date +='</div>';
                
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
        }else if(method=="Bg"){
           $('#bank_id').val('');
           $('#bank').show();
           $('#no').html('');
           $('#date').html('');
           $('#expire_date').html('');
           $('#bg_lc_tenor').html('');
           var bg_no='';
                 bg_no +='<div class="form-group check_no row "  style=";">';
                 bg_no +='<div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Bg No<sup style="color:red;">*</sup> :</label></div>';
                 bg_no +='<div class="col-sm-8 col-md-5 ">';
                 bg_no +='<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();" id="bg_no" class="form-control number" name="bg_no" type="text">';
                 bg_no +='<span id="bg_no_error" style="color:red"></span>';
                 bg_no +='</div></div>';  
                 
           var bg_date='';      
                bg_date +=' <div class="form-group check_date row" style="">';
                bg_date +='<div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Bg Date<sup style="color:red;">*</sup> :</label></div>';
                bg_date +='<div class="col-sm-8 col-md-5 "><input  id="bg_issue_date" class="form-control datepicker" name="bg_issue_date" type="text"></div>';
                bg_date +='<span id="bg_issue_date_error" style="color:red"></span>';
                bg_date +='</div>';
           var exp_date='';  
                exp_date +=' <div class="form-group check_date row" style="">';
                exp_date +='<div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Exp. Date<sup style="color:red;">*</sup> :</label></div>';
                exp_date +='<div class="col-sm-8 col-md-5 "><input  id="bg_expire_date" class="form-control datepicker" name="bg_expire_date" type="text"></div>';
                exp_date +='<span id="bg_expire_date_error" style="color:red"></span>';
                exp_date +='</div>';
           var tenor='';
                 tenor +='<div class="form-group check_no row "  style=";">';
                 tenor +='<div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Tenor<sup style="color:red;">*</sup> :</label></div>';
                 tenor +='<div class="col-sm-8 col-md-5 ">';
                 tenor +='<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();"  id="tenor" class="form-control number" name="tenor" type="text">';
                 tenor +='<span id="tenor_error" style="color:red"></span>';
                 tenor +='</div></div>';  
               
                
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
        }else if(method=="Lc"){
           $('#bank_id').val('');
           $('#bank').show();
           $('#no').html('');
           $('#date').html('');
           $('#expire_date').html('');
           $('#bg_lc_tenor').html('');
           var lc_no='';
                 lc_no +='<div class="form-group check_no row "  style=";">';
                 lc_no +='<div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Lc No<sup style="color:red;">*</sup> :</label></div>';
                 lc_no +='<div class="col-sm-8 col-md-5 ">';
                 lc_no +='<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();" id="lc_no" class="number form-control" name="lc_no" type="text">';
                 lc_no +='<span id="lc_no_error" style="color:red"></span>';
                 lc_no +='</div></div>';  
                 
           var lc_date='';      
                lc_date +=' <div class="form-group check_date row" style="">';
                lc_date +='<div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Lc Date<sup style="color:red;">*</sup> :</label></div>';
                lc_date +='<div class="col-sm-8 col-md-5 "><input  id="lc_date" class="form-control datepicker" name="lc_date" type="text"></div>';
                lc_date +='<span id="lc_date_error" style="color:red"></span>';
                lc_date +='</div>';
          
           var tenor='';
                 tenor +='<div class="form-group check_no row "  style=";">';
                 tenor +='<div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Tenor<sup style="color:red;">*</sup> :</label></div>';
                 tenor +='<div class="col-sm-8 col-md-5 ">';
                 tenor +='<input onkeyup="javascript:checkNumeric();" onchange="javascript:checkNumeric();" onblur="javascript:checkNumeric();"  id="tenor" class="number form-control" name="tenor" type="text">';
                 tenor +='<span id="tenor_error" style="color:red"></span>';
                 tenor +='</div></div>';  
               
                
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
        }else{
           $('#bank_id').val('');
           $('#bank').hide();
           $('#no').html('');
           $('#date').html('');
           $('#expire_date').html('');
           $('#bg_lc_tenor').html('');
        }
        
    });
    
 
 function checkNumeric(){
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
 
    
    
    
    
    
   
</script>

