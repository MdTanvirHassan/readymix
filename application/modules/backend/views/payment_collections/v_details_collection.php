<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Payment Collection Details</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                     <div class="row">     
                        <table class="table table-bordered" id="myTable">
            <tr>
                <th  style="width:12%;">Sales Order: </th>
                <td>
                    <?php foreach($sale_orders as $order){ ?>
                                <?php if($order['o_id']==$collection_info[0]['o_id']) echo $order['order_no']; ?>
                            <?php } ?>
                </td>
                <!--
                <th  style="width:12%;">Delivery Order:</th>
                <td>
                    
                </td>
                -->
                <th  style="width:12%;">C. Name:</th>
                <td>
                    <?php if(!empty($collection_info[0]['c_name'])) echo $collection_info[0]['c_name']; ?>
                </td>
                
                <th>Project Name:</th>
                <td>
                    <?php if(!empty($collection_info[0]['project_name'])) echo $collection_info[0]['project_name']; ?>
                </td>
                
            
            </tr>
            
            <tr>
                
               <th>Attention:</th>
                <td>
                    <?php if(!empty($collection_info[0]['attention'])) echo $collection_info[0]['attention']; ?>
                </td>
                <th>Phone:</th>
                <td>
                    <?php if(!empty($collection_info[0]['phone'])) echo $collection_info[0]['phone']; ?>
                </td> 
                
                
                <th>REC.Date</th>
                <td>
                    <?php if(!empty($collection_info[0]['receive_date'])) echo date('d-m-Y',strtotime($collection_info[0]['receive_date'])); ?>
                </td>
                
            
            </tr>
            
            <tr>
                
                
                <!--
                <th>Contact Person:</th>
                <td>
                    <?php if(!empty($delivery_challan_info[0]['contact_person'])) echo $delivery_challan_info[0]['contact_person']; ?>
               
            </td>
                -->
            </tr>
            
            
            
            
            <tr>
               <!-- 
                 <th>Contact No:</th>
                 <td>
                    <?php if(!empty($delivery_challan_info[0]['contact_no'])) echo $delivery_challan_info[0]['contact_no']; ?>               
                </td>
               -->
               
                <th>B. Address:</th>
                <td>
                    <?php if(!empty($collection_info[0]['billing_address'])) echo $collection_info[0]['billing_address']; ?>
                </td>
                    
              <th>B. Email:</th>
                <td>
                    <?php if(!empty($collection_info[0]['billing_email'])) echo $collection_info[0]['billing_email']; ?>
                </td>
            
            </tr>
            <!--
             <tr>
                  
            
                <th>D. Address:</th>
                <td>
                    <?php if(!empty($delivery_challan_info[0]['shipping_address'])) echo $delivery_challan_info[0]['shipping_address']; ?>
                    
                </td>
                <th>Delivery Date</th>
                <td>
                    <?php if(!empty($delivery_challan_info[0]['challan_date'])) echo date('d-m-Y',strtotime($delivery_challan_info[0]['challan_date'])); ?>
                </td>
                 <th>DC. Time:</th>
                <td>
                  <?php if(!empty($delivery_challan_info[0]['challan_time'])) echo $delivery_challan_info[0]['challan_time']; ?>
                </td>
               
               
               
            
            </tr>
            -->
             <tr>
                  
            
                <th>Payment Mode:</th>
                <!--
                <td>
                    <?php if($payment_mode[0]['b_cash']=="Cash" || $payment_mode[0]['a_cash']=="Cash"){ ?>
                               <?php if($collection_info[0]['collection_method']=="Cash") echo 'Cash'; ?>
                           <?php } ?>
                          <?php if($payment_mode[0]['b_pdc']=="Pdc" || $payment_mode[0]['a_pdc']=="Pdc"){ ?>   
                             <?php if($collection_info[0]['collection_method']=="Pdc") echo 'Cheque'; ?>
                          <?php } ?>  
                           <?php if($payment_mode[0]['b_bg']=="Bg" || $payment_mode[0]['a_bg']=="Bg"){ ?>      
                              <?php if($collection_info[0]['collection_method']=="Bg") echo 'Bg'; ?>
                           <?php } ?>
                           <?php if($payment_mode[0]['b_lc']=="Lc" || $payment_mode[0]['a_lc']=="Lc"){ ?>
                                <?php if($collection_info[0]['collection_method']=="Lc") echo 'Lc'; ?> 
                           <?php } ?> 
                    
                </td>
                -->
                 <td>
                    
                               <?php echo $collection_info[0]['collection_method']; ?>
                          
                    
                </td>
                
                
                <th>Amount </th>
                <td>
                   <?php if(!empty($collection_info[0]['amount'])) echo number_format($collection_info[0]['amount'],2); ?>  
                </td>
                
                <?php if(!empty($collection_info[0]['check_no'])){ ?>
                <th>Cheque No </th>
                <td>
                    <?php if(!empty($collection_info[0]['check_no'])) echo $collection_info[0]['check_no']; ?>
                </td>
                
                
                    
                <?php }else if(!empty($collection_info[0]['po_no'])){ ?>
                
                <th>Po No :</th>
                <td>
                   <?php if(!empty($collection_info[0]['po_no'])) echo $collection_info[0]['po_no']; ?>
                </td>
                    
              <?php }else if(!empty($collection_info[0]['bg_no'])){ ?>  
                <th>Bg. No  :</th>
                <td>
                   <?php if(!empty($collection_info[0]['bg_no'])) echo $collection_info[0]['bg_no']; ?>
                </td>
                
               <?php }else if(!empty($collection_info[0]['lc_no'])){ ?> 
                
                <th>Lc No :</th>
                <td>
                   <?php if(!empty($collection_info[0]['lc_no'])) echo $collection_info[0]['lc_no']; ?>
                </td>
                
               <?php } ?>
                
                
                
                
                
                
                
                
               
               
               
            
            </tr>
            
             <tr>
              
                <?php if(!empty($collection_info[0]['check_date'])){ ?>
                <th>Cheque Date </th>
                <td>
                    <?php if(!empty($collection_info[0]['check_date'])) echo date('d-m-Y',strtotime($collection_info[0]['check_date'])) ?>
                </td>
                
                
                    
                <?php }else if(!empty($collection_info[0]['po_date'])){ ?>
                
                <th>Po Date :</th>
                <td>
                   <?php if(!empty($collection_info[0]['po_date'])) echo date('d-m-Y',strtotime($collection_info[0]['po_date'])) ?>
                </td>
                    
              <?php }else if(!empty($collection_info[0]['bg_issue_date'])){ ?>  
                <th>Bg. Date  :</th>
                <td>
                   <?php if(!empty($collection_info[0]['bg_issue_date'])) echo date('d-m-Y',strtotime($collection_info[0]['bg_issue_date'])) ?>
                </td>
                
               <?php }else if(!empty($collection_info[0]['lc_date'])){ ?> 
                
                <th>Lc Date :</th>
                <td>
                   <?php if(!empty($collection_info[0]['lc_date'])) echo date('d-m-Y',strtotime($collection_info[0]['lc_date'])) ?>
                </td>
                
               <?php } ?>
                
                <th>Bank: </th>
                <td>
                   <?php foreach($banks as $bank){ ?>
                                <?php if($collection_info[0]['bank_id']==$bank['id']) echo $bank['b_short_name'].'('.$bank['branch_name'].')' ?>
                            <?php } ?>
                </td>
                <th>Remark : </th>
                <td>
                   <?php if(!empty($collection_info[0]['remark'])) echo $collection_info[0]['remark']; ?>
                </td>
                
                
                
                
                
                
                
               
               
               
            
            </tr>
            
                      
                  </table>
    
                    </div>    
        
<!--        <div class="row">
            <div class="col-md-6">
                    <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Sales Order :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        
                            <?php foreach($sale_orders as $order){ ?>
                                <?php if($order['o_id']==$collection_info[0]['o_id']) echo $order['c_short_name'].'('.$order['project_name'].')' ?>
                            <?php } ?>
                       </select>
                    </div>
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Rec. Date :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                         <?php if(!empty($collection_info[0]['receive_date'])) echo date('d-m-Y',strtotime($collection_info[0]['receive_date'])) ?>
                    </div>
                </div>
            </div>
            
        </div>
          
         <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Payment Mode :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        
                           <?php if($payment_mode[0]['b_cash']=="Cash" || $payment_mode[0]['a_cash']=="Cash"){ ?>
                               <?php if($collection_info[0]['collection_method']=="Cash") echo 'Cash'; ?>
                           <?php } ?>
                          <?php if($payment_mode[0]['b_pdc']=="Pdc" || $payment_mode[0]['a_pdc']=="Pdc"){ ?>   
                             <?php if($collection_info[0]['collection_method']=="Pdc") echo 'Cheque'; ?>
                          <?php } ?>  
                           <?php if($payment_mode[0]['b_bg']=="Bg" || $payment_mode[0]['a_bg']=="Bg"){ ?>      
                              <?php if($collection_info[0]['collection_method']=="Bg") echo 'Bg'; ?>
                           <?php } ?>
                           <?php if($payment_mode[0]['b_lc']=="Lc" || $payment_mode[0]['a_lc']=="Lc"){ ?>
                                <?php if($collection_info[0]['collection_method']=="Lc") echo 'Lc'; ?> 
                           <?php } ?> 
                     
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Amount :</label></div>
                    <div class="col-sm-8 col-md-5 "><?php if(!empty($collection_info[0]['amount'])) echo $collection_info[0]['amount']; ?></div>
                </div>
            </div>
            
        </div>
        
          <div class="row">
            <div class="col-md-6" id="no">
                <?php if(!empty($collection_info[0]['check_no'])){ ?>
                    <div class="form-group check_no row "  style="">
                        <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Cheque No :</label></div>
                        <div class="col-sm-8 col-md-5 ">
                            <?php if(!empty($collection_info[0]['check_no'])) echo $collection_info[0]['check_no']; ?>
                        </div>
                    </div>
                <?php }else if(!empty($collection_info[0]['po_no'])){ ?>
                    <div class="form-group po_no row "  style="">
                        <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Po No :</label></div>
                        <div class="col-sm-8 col-md-5 ">
                            <?php if(!empty($collection_info[0]['po_no'])) echo $collection_info[0]['po_no']; ?>
                        </div>
                    </div>
              <?php }else if(!empty($collection_info[0]['bg_no'])){ ?>  
                <div class="form-group bg_no row" style="">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Bg. No :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <?php if(!empty($collection_info[0]['bg_no'])) echo $collection_info[0]['bg_no']; ?>
                    </div>
                </div>
               <?php }else if(!empty($collection_info[0]['lc_no'])){ ?> 
                <div class="form-group lc_no row"  style="">
                    <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Lc No :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                        <?php if(!empty($collection_info[0]['lc_no'])) echo $collection_info[0]['lc_no']; ?>
                    </div>
                </div>
               <?php } ?> 
            </div>End Col-md-6
            <div class="col-md-6" id="date">
                <?php if(!empty($collection_info[0]['check_date'])){ ?>
                    <div class="form-group check_date row" style="">
                        <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Cheque Date :</label></div>
                        <div class="col-sm-8 col-md-5 "><?php if(!empty($collection_info[0]['check_date'])) echo date('d-m-Y',strtotime($collection_info[0]['check_date'])) ?></div>
                    </div>
                <?php }else if(!empty($collection_info[0]['po_date'])){ ?>
                    <div class="form-group po_date row"  style="">
                        <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Po. Date :</label></div>
                        <div class="col-sm-8 col-md-5 "><?php if(!empty($collection_info[0]['po_date'])) echo date('d-m-Y',strtotime($collection_info[0]['po_date'])) ?></div>
                    </div>
                <?php }else if(!empty($collection_info[0]['bg_issue_date'])){ ?>
                    <div class="form-group bg_issue_date row"  style="">
                        <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Bg. Issue Date:</label></div>
                        <div class="col-sm-8 col-md-5 "><?php if(!empty($collection_info[0]['bg_issue_date'])) echo date('d-m-Y',strtotime($collection_info[0]['bg_issue_date'])) ?></div>
                    </div>
                <?php }else if(!empty($collection_info[0]['lc_date'])){ ?>
                    <div class="form-group lc_date row"  style="">
                        <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Lc Date :</label></div>
                        <div class="col-sm-8 col-md-5 "><?php if(!empty($collection_info[0]['lc_date'])) echo date('d-m-Y',strtotime($collection_info[0]['lc_date'])) ?></div>
                    </div>
                <?php } ?>
            </div>End Col-md-6
            
        </div>
        
        <div class="row">
            <div class="col-md-6" id="bg_lc_tenor">
                <?php if(!empty($collection_info[0]['tenor'])){ ?>
                    <div class="form-group tenor row"  style="">
                        <div class="col-sm-4 col-md-3 col-md-offset-3 labeltext" style="text-align: right;"><label for="inputdefault">Tenor :</label></div>
                        <div class="col-sm-8 col-md-5 ">
                            <?php if(!empty($collection_info[0]['tenor'])) echo $collection_info[0]['tenor']; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-6" id="expire_date">
                 <?php if(!empty($collection_info[0]['bg_expire_date'])){ ?>
                    <div class="form-group bg_expire_date row"  style="">
                        <div class="col-sm-4 col-md-3   labeltext" style="text-align: right;"><label for="inputdefault">Exp. Date :</label></div>
                        <div class="col-sm-8 col-md-5 "><?php if(!empty($collection_info[0]['bg_expire_date'])) echo date('d-m-Y',strtotime($collection_info[0]['bg_expire_date'])) ?></div>
                    </div>
                 <?php } ?>
            </div>
        </div>
        
        
         <div class="row">
            <div class="col-md-6">
                    <div class="form-group row" style="display:<?php if($collection_info[0]['collection_method']=="Cash") echo 'none'; ?>">
                    <div class="col-sm-4 col-md-3 col-md-offset-3  labeltext" style="text-align: right;"><label for="inputdefault">Bank :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                       
                            <?php foreach($banks as $bank){ ?>
                                <?php if($collection_info[0]['bank_id']==$bank['id']) echo $bank['b_short_name'].'('.$bank['branch_name'].')' ?>
                            <?php } ?>
                      
                    </div>
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-4 col-md-3 labeltext" style="text-align: right;"><label for="inputdefault">Remark :</label></div>
                    <div class="col-sm-8 col-md-5 ">
                         <?php if(!empty($collection_info[0]['remark'])) echo $collection_info[0]['remark']; ?>
                    </div>
                </div>
            </div>
            
        </div>-->
       
<!--<div class="separator-shadow"></div>-->
        
        


       
        
        <div class="row">
         <div class="col-md-2">
                <a href="<?php echo site_url('backend/payment_collections') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

            </div>
        </div> 
            
        
    
</div>
</div>
</div>
</div>
</div>
</div>



