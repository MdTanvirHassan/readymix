<style type="text/css">
    * {box-sizing: border-box}

/* Style the tab */
a:hover,a:focus{
    outline: none;
    text-decoration: none;
}
.tab .nav-tabs{ border-bottom: 2px solid #e8e8e8; }
.tab .nav-tabs li a{
    display: block;
    padding: 10px 7px;
    margin: 0 5px 1px 0;
    background: #fff;
    font-size: 13px;
    font-weight: 600;
    color: #112529 !important;
    text-align: center;
    border: none;
    border-radius: 0;
    z-index: 2;
    position: relative;
    transition:all 0.3s ease 0s;
}
.tab .nav-tabs li a:hover,
.tab .nav-tabs li.active a{
    color: #198df8 !important;
    border: none;
}
/*.tab .nav-tabs li.active a:before{
    content: "\f107";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: 25px;
    font-weight: 700;
    color: #198df8;
    margin: 0 auto;
    position: absolute;
    bottom: -30px;
    left: 0;
    right: 0;
}*/
.tab .nav-tabs li.active a:after{
    content: "";
    width: 100%;
    height: 3px;
    background: #198df8;
    position: absolute;
    bottom: -1px;
    left: 0;
    z-index: -1;
    transition: all 0.3s ease 0s;
}
.tab .tab-content{
    padding: 30px 20px 20px;
    margin-top: 0;
    background: #fff;
    font-size: 13px;
    line-height: 30px;
    border-radius: 0 0 5px 5px;
}
.tab .tab-content h3{
    font-size: 24px;
    margin-top: 0;
}
@media only screen and (max-width: 479px){
    .tab .nav-tabs li{
        width: 100%;
        text-align: center;
    }
    .tab .nav-tabs li.active a:before{
        content: "\f105";
        bottom: 15%;
        left: 0;
        right: auto;
    }
}

/********END TABS*********/
.box-primary {
	/* border-top-color: #faa21c; */
	box-shadow: 0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);
}
.profile-user-img {
	margin: 0 auto;
	width: 120px;
	padding: 3px;
	border: 3px solid #d2d6de;
	height: 120px;
}

/**********Normar Table style Srart***************/
.custom_table {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.custom_table td, .custom_table th {
  border: 1px solid #ddd;
  padding: 8px;
}

.custom_table tr:nth-child(even){background-color: #f2f2f2;}

.custom_table tr:hover {background-color: #ddd;}
.custom_table th{
    width: 20%;
}

/*.custom_table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #f2f2f2;
  color: white;
}*/
/**********Normar Table style END***************/
</style>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(1, 1, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'supplier_information') echo 'active'; ?>" href="<?php echo site_url('backend/general_store'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Supplier Info</span>
                    </a>
                </li>
                <?php } ?> 
                
                <?php $this->role = checkUserPermission(1, 1, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'service_group') echo 'active'; ?>" href="<?php echo site_url('backend/service_group'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Service Group</span>
                        </a>
                    </li>
                <?php } ?> 
                    
                <?php $this->role = checkUserPermission(1, 1, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'measurement_unit') echo 'active'; ?>" href="<?php echo site_url('backend/measurement_unit'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Measurement Unit</span>
                        </a>
                    </li>
                <?php } ?>      
                
                <?php $this->role = checkUserPermission(1, 33, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'service_info') echo 'active'; ?>" href="<?php echo site_url('backend/services'); ?>">
                        <i class="fa fa-wrench"></i><br><span>Service Info  </span>
                    </a>
                </li>
                <?php } ?> 
                
                 <?php $this->role = checkUserPermission(1, 34, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'indent_type') echo 'active'; ?>" href="<?php echo site_url('backend/indent_type'); ?>">
                            <i class="fa fa-align-justify"></i><br><span>Indent Type  </span>
                        </a>
                    </li>
                <?php } ?> 
                    
               <?php $this->role = checkUserPermission(1, 35, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'payment_mode') echo 'active'; ?>" href="<?php echo site_url('backend/payment_mode'); ?>">
                           <i class="fa fa-align-justify"></i><br><span>Payment Mode  </span>
                        </a>
                    </li>
                <?php } ?>      
                
                <?php $this->role = checkUserPermission(1, 2, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>      
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'item_category') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/item_category'); ?>">
                        <i class="fa fa-cc"></i><br><span>ITEM CATEGORY</span></a>
                </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(1, 3, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'item_group_information') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/item_group_information'); ?>">
                        <i class="fa fa-object-group"></i><br><span>ITEM GROUP</span></a>
                </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(1, 4, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>           
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'item_information') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/item_information'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>ITEM Info</span></a>
                </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(1, 5, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'department') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/department'); ?>">
                        <i class="fa fa-cubes"></i><br><span>UNIT</span></a>
                </li>
                <?php }?>
                <?php $this->role = checkUserPermission(1, 6, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'cost_center') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/cost_center'); ?>">
                        <i class="fa fa-home"></i><br><span>COST CENTER</span></a>
                </li>
                <?php }?>
                <?php $this->role = checkUserPermission(1, 36, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'designation') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/designation'); ?>">
                        <i class="fa fa-certificate"></i><br><span>DESIGNATION</span></a>
                </li>
                <?php }?>
                <?php $this->role = checkUserPermission(1, 37, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'employee') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/employee'); ?>">
                        <i class="fa fa-user"></i><br><span>USERS</span></a>
                </li>
                <?php } ?>
                <?php //$this->role = checkUserPermission(1, 38, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>   
                <?php if($user_type==1){ ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->sub_inner_menu == 'acl') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/acl'); ?>">
                                <i class="fa fa-user-times"></i><br><span>ACL ROLE</span></a>
                        </li>
                <?php } ?>    
                <?php //}?>
            </ul>
        </div>
    </div>

    <div class="">
      
        <div class="page-title">
            <div class="title_center">
                <h3>Supplier Details Info</h3>
            </div>
        </div>
      
        <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        
                        <div class="row">
                            <div class="col-md-3 box-primary">
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo site_url('images/defualt.jpg')?>" alt="User profile picture">
                                   
                                    <b>Name :  <span><?php echo $supplier[0]['SUP_NAME']?></span> </b>  <br>
                                    <b>Phone : <span><?php echo $supplier[0]['MOBILE']?></span> </b> <br>
                                    <b>Email : <span><?php echo $supplier[0]['EMAIL']?></span> </b> <br>
                                    <hr>
                                    <b style="font-size: 18px; color:#286090;">Paid : <span id="deposit"><?php //echo number_format($total_deposit,2)." BDT"; ?></span> </b> <br>
                                    <b style="font-size: 18px; color:#286090;">Bill : <span id="total"><?php //echo number_format($total_bill,2)." BDT"; ?></span> </b> <br>
                                    <?php 
                                        $remain=$total_bill-$total_deposit;
                                    ?>
                                    
                                    <b style="font-size: 18px; color:#286090;">Due : <span id="due"><?php if($remain>0) //echo number_format($remain,2)." BDT"; ?></span></b> <br>  
                                    <b style="font-size: 18px; color:#286090;">Balance : <span id="due"><?php if($remain<0) //echo number_format(($total_deposit - $total_bill),2)." BDT"; ?></span></b> <br> 
                                  <!--  <b style="font-size: 18px; color:#286090;">Cheque at Hand : <span id="due"><?php  echo number_format($in_hand,2)." BDT"; ?></span></b> <br><br> -->
                                   

                              
                            </div>
        <div class="col-md-9">
            <div class="tab" role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#personal" aria-controls="home" role="tab" data-toggle="tab">Personal Info</a></li>
                   
                  
                    <li role="presentation"><a href="#sales_order" aria-controls="profile" role="tab" data-toggle="tab">P.Order</a></li>
                 
                    <li role="presentation"><a href="#delivery_challan" aria-controls="profile" role="tab" data-toggle="tab">MRR</a></li>
                    <li role="presentation"><a href="#bills" aria-controls="messages" role="tab" data-toggle="tab">Bills</a></li>
                   <!--
                    <li role="presentation"><a href="#payment_collection" aria-controls="messages" role="tab" data-toggle="tab">P.collection</a></li>
                    <li role="presentation"><a href="#payment_receive" aria-controls="messages" role="tab" data-toggle="tab">P.receive</a></li>
                   -->
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabs">
                    <div role="tabpanel" class="tab-pane fade in active" id="personal">
                        <h3>Company Info :</h3>
                        <table class="custom_table">
                            <tr>
                                <th>Customer ID</th>
                                <td><?php echo $supplier[0]['CODE']?></td>
                                <th>Company Name</th>
                                <td><?php echo $supplier[0]['SUP_NAME']?></td>
                            </tr>
                            <tr>
                                <th>C.Short Name</th>
                                <td><?php //echo $supplier[0]['c_short_name']?></td> 
                                <th>Address</th>
                                <td><?php echo $supplier[0]['ADDRESS']?></td>
                            </tr>
                            <tr>
                                <th>H.O Phone</th>
                                <td><?php echo $supplier[0]['MOBILE']?></td>
                                <th>H.O Email</th>
                                <td><?php echo $supplier[0]['EMAIL']?></td>
                            </tr>
                            <tr>
                               <th>Vat Reg.</th>
                                <td><?php //echo $supplier[0]['vat_reg']?></td> 
                               <th>Tin No.</th>
                                <td><?php //echo $supplier[0]['tin_no']?></td> 
                            </tr>
                            
                        </table>
                        
                        
                        <h3 style="margin-top:30px;">Key Person Info :</h3>
                        <table class="custom_table">
                            <tr>
                                <th>Key Person</th>
                                <td><?php echo $supplier[0]['key_person']?></td>
                                <th>Phone </th>
                                <td><?php //echo $supplier[0]['key_person_phone']?></td>
                            </tr>
                            <tr>
                                <th>Email </th>
                                <td colspan="3"><?php //echo $supplier[0]['key_person_email']?></td> 
                                
                            </tr>
                            
                            
                        </table>
                        
                         <h3 style="margin-top:30px;">Contact Person Info :</h3>
                        <table class="custom_table">
                            <tr>
                                <th>Contact Person</th>
                                <td><?php echo $supplier[0]['NAME']?></td>
                                <th>Phone </th>
                                <td><?php //echo $supplier[0]['c_mobile_no']?></td>
                            </tr>
                            <tr>
                                <th>Email </th>
                                <td colspan="3"><?php echo $supplier[0]['c_email']?></td> 
                                
                            </tr>
                            
                            
                        </table>
                    </div>
                    
                    
                    
                    
                    <div role="tabpanel" class="tab-pane fade" id="sales_order">
                        <table class="table datatable table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-1">Date</th>
                                                <th class="col-lg-1">Purchase Order No.</th>
                                                <th class="col-lg-1">Purchase Type</th>
                                               
                                                <th class="col-lg-1">Project Name</th>
                                                <th class="col-lg-1">Amount</th>
                                                <th class="col-lg-1">MRR Status</th>

                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php if (count($purchase_orders)) {
                                            foreach ($purchase_orders as $purchase_order) { 
                                               // $total+=$order['total_amount'];
                                                ?>
                                    
                                                <tr>
                                                   

                                                    
                                                    
                                                     <td>
                                                       <a href="<?php echo site_url('purchase_orders/details_purchase_order/'.$purchase_order['o_id'])?>"><?php if(!empty($purchase_order['purchase_order_date'])) echo date('d-m-Y',strtotime($purchase_order['purchase_order_date'])); ?>                                    </a>        

                                                      </td>
                                                      <td>
                                                          <a href="<?php echo site_url('purchase_orders/details_purchase_order/'.$purchase_order['o_id'])?>">   <?php if(!empty($purchase_order['order_no'])) echo $purchase_order['order_no']; ?></a>
                                                      </td>
                                                      <td>
                                                           <a href="<?php echo site_url('purchase_orders/details_purchase_order/'.$purchase_order['o_id'])?>">
                                                             <?php 
                                                             if(!empty($purchase_order['order_from'])){
                                                                 if($purchase_order['order_from']=="Money Indent"){
                                                                      echo 'Cash'; 
                                                                 }else{
                                                                     echo 'Credit'; 
                                                                 }
                                                             }
                                                             ?>
                                                           </a>    
                                                      </td>
                                                     
                                                      <td>
                                                          <a href="<?php echo site_url('purchase_orders/details_purchase_order/'.$purchase_order['o_id'])?>"> <?php if(!empty($purchase_order['dep_description'])) echo $purchase_order['dep_description']; ?></a>
                                                      </td>
                                                      <td>
                                                          <a href="<?php echo site_url('purchase_orders/details_purchase_order/'.$purchase_order['o_id'])?>"><?php if(!empty($purchase_order['total_amount'])) echo number_format($purchase_order['total_amount']); ?></a>
                                                      </td>
                                                      <td>
                                                          <a href="<?php echo site_url('purchase_orders/details_purchase_order/'.$purchase_order['o_id'])?>"><?php if(!empty($purchase_order['status'])) echo $purchase_order['status']; ?></a>

                                                      </td>
                                                    
                                                    
                                                    
                                                    
                                                    

                                                </tr>
                                <?php }
                            } ?>
                                    </tbody>
                                </table>
                        
                    </div>
                  
                    <div role="tabpanel" class="tab-pane fade" id="delivery_challan">
                        <table  class="table datatable table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th>Mrr. Date</th>
                                                <th>Mrr No.</th>
                                                <th>Challan Date</th>
                                                <th>Challan No.</th>
                                                <th>Purchase Order No.</th>
                                               
                                                <th>Project Name</th>
                                                <th>Material Name</th>
                                                <th>MU.</th>
                                               
                                                <th>R.Qty</th>
                                                
                                                <th>Unit Price</th>
                                                <th>Value</th>

                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php if (count($material_receives)) {
                                            foreach ($material_receives as $req) { ?>
                                                <tr>
                                                   
                                                        <td><?php echo $req['mrr_date']; ?></td>
                                                        <td><?php echo $req['mrr_no']; ?></td>
                                                        <td><?php echo $req['mrr_challan_date']; ?></td>
                                                        <td><?php echo $req['mrr_challan']; ?></td>
                                                        <td><?php echo $req['order_no']; ?></td>
                                                        
                                                        <td style="text-align:left;"><?php echo $req['dep_description']; ?></td>
                                                        <td><?php echo $req['item_name']; ?></td>
                                                        <td><?php echo $req['meas_unit']; ?></td>
                                                        
                                                        <td><?php echo $req['receive_qty']; ?></td>
                                                       
                                                        <td><?php if(!empty($req['unit_price'])) echo $req['unit_price']; ?></td>
                                                        <td><?php if(!empty($req['amount'])) echo $req['amount']; ?></td>
                                                       

                                                </tr>
                                <?php }
                            } ?>
                                    </tbody>
                                </table>
                        
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="bills">
                        
                        <table  class="table datatable table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Invoice No.</th>
                <th class="col-lg-1">Supplier Bill No.</th>
                
                
                <th class="col-lg-1">Amount</th>
                <th class="col-lg-1">Audit Status</th>
              
            </tr>
        </thead>
        <tbody>
            <?php if (count($invoices)) {
                foreach ($invoices as $invoice) { ?>
                    <tr>
                      
                        <td>
                            <?php if(!empty($invoice['invoice_date'])) echo date('d-m-Y',strtotime($invoice['invoice_date'])); ?>
                        </td>
                        <td>
                            <?php if(!empty($invoice['inv_no'])) echo $invoice['inv_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($invoice['supplier_bill_no'])) echo $invoice['supplier_bill_no']; ?>
                        </td>
                       
                         
                        <td>
                             <?php if(!empty($invoice['total_amount'])) echo $invoice['total_amount']; ?>
                        </td>
                        <td>
                             <?php if(!empty($invoice['audit_status'])) echo $invoice['audit_status']; ?>
                        </td>

                       
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="payment_collection">
                        
                        <table  class="table datatable table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Receive Date</th>
               
                <th class="col-lg-1">Mode of Payment</th>
                <th class="col-lg-1">Pdc/Lc/Bg No</th>
                <th class="col-lg-1">Pdc/Lc/Bg Date</th>
                <th class="col-lg-1">Amount</th> 
                <th class="col-lg-1">R. Status</th>
               
              
            </tr>
        </thead>
        <tbody>
            <?php if (count($payment_collections)) {
                foreach ($payment_collections as $collection) { ?>
                    <tr>
                       
                        <td>
                            <?php if(!empty($collection['receive_date'])) echo date('d-m-Y',strtotime($collection['receive_date'])); ?>
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
                        
                        
                                                
                        <td>
                            <?php if(!empty($collection['amount'])) echo number_format($collection['amount'],2); ?>
                        </td>

                        
                        <td>
                            <?php if(!empty($collection['payment_status'])) echo $collection['payment_status']; ?>
                        </td>
                       
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="payment_receive">
                        
                        <table  class="table datatable table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Receive Date</th>
               
                <th class="col-lg-1">Mode of Payment</th>
                <th class="col-lg-1">Pdc/Lc/Bg No</th>
                <th class="col-lg-1">Amount</th> 
                
              
            </tr>
        </thead>
        <tbody>
            <?php if (count($payment_receive)) {
                foreach ($payment_receive as $collection) { ?>
                    <tr>
                        
                       <td>
                            <?php if(!empty($collection['receive_date'])) echo date('d-m-Y',strtotime($collection['receive_date'])); ?>
                        </td>

                         
                        <td>
                            <?php if(!empty($collection['collection_method'])) echo $collection['collection_method']; ?>
                        </td>
                       <td>
                            <?php if(!empty($collection['no'])) echo $collection['no']; ?>
                        </td>
                        
                        <td>
                            <?php if(!empty($collection['amount'])) echo number_format($collection['amount'],2); ?>
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
                </div>
               </div>
            
                <div class="form-group" style="margin-top: 40px;">
                        <div class="col-sm-2">
                            <a href="<?php echo site_url('backend/general_store') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
                        </div>



                  </div>
            
        </div>
    </div>
</div>


<script>
//function openCity(evt, cityName) {
//  var i, tabcontent, tablinks;
//  tabcontent = document.getElementsByClassName("tabcontent");
//  for (i = 0; i < tabcontent.length; i++) {
//    tabcontent[i].style.display = "none";
//  }
//  tablinks = document.getElementsByClassName("tablinks");
//  for (i = 0; i < tablinks.length; i++) {
//    tablinks[i].className = tablinks[i].className.replace(" active", "");
//  }
//  document.getElementById(cityName).style.display = "block";
//  evt.currentTarget.className += " active";
//}
//
//// Get the element with id="defaultOpen" and click on it
//document.getElementById("defaultOpen").click();
</script>


<script type="text/javascript">
    function validation() {
        var name = $('#customer_name').val();
        var c_short_name = $('#c_short_name').val();
        var c_contact_address = $('#c_contact_address').val();
        var head_office_mobile_no = $('#head_office_mobile_no').val();
        var head_office_email = $('#head_office_email').val();
        var tin_no = $('#tin_no').val();
        var vat_reg = $('#vat_reg').val();
        
        var key_person = $('#key_person').val();
        var key_person_email = $('#key_person_email').val();
        
       
        var c_contact_person = $('#c_contact_person').val();
        var c_mobile_no = $('#c_mobile_no').val();
        var c_email = $('#c_email').val();
        
        var error = false;

        if (name == '') {
            $('#customer_name').css('border', '1px solid red');
            $('#customer_name_error').html('Please fill name field');
            error = true;

        } else {
            $('#customer_name').css('border', '1px solid #ccc');
            $('#customer_name_error').html('');

        }
        if (c_short_name == '') {
            $('#c_short_name_error').html('Please fill short name field');
            $('#c_short_name').css('border', '1px solid red');
            error = true;
        } else {
            $('#c_short_name_error').html('');
            $('#c_short_name').css('border', '1px solid #ccc');

        }
        
        if (c_contact_address == '') {
            $('#c_contact_address_error').html('Please fill address field');
            $('#c_contact_address').css('border', '1px solid red');
            error = true;
        } else {
            $('#c_contact_address_error').html('');
            $('#c_contact_address').css('border', '1px solid #ccc');

        }
        
        
        if (head_office_mobile_no == '') {
            $('#head_office_mobile_no_error').html('Please fill head office phone field');
            $('#head_office_mobile_no').css('border', '1px solid red');
            error = true;
        } else {
            $('#head_office_mobile_no_error').html('');
            $('#head_office_mobile_no').css('border', '1px solid #ccc');

        }

        
        
        
        if (head_office_email == '') {
//            $('#head_office_email_error').html('Please fill head office email field');
//            $('#head_office_email').css('border', '1px solid red');
//            error = true;
        } else {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(head_office_email)) {
                $('#head_office_email_error').html('Invalid email address');
                $('#head_office_email').css('border', '1px solid red');
                error = true;
            } else {
                $('#head_office_email_error').html('');
                $('#head_office_email').css('border', '1px solid #ccc');
            }


        }
        
//         if (tin_no == '') {
//            $('#tin_no_error').html('Please fill tin number field');
//            $('#tin_no').css('border', '1px solid red');
//            error = true;
//        } else {
//            $('#tin_no_error').html('');
//            $('#tin_no').css('border', '1px solid #ccc');
//
//        }
//        
//        
//        if (vat_reg == '') {
//            $('#vat_reg_error').html('Please fill  vat registration number field');
//            $('#vat_reg').css('border', '1px solid red');
//            error = true;
//        } else {
//            $('#vat_reg_error').html('');
//            $('#vat_reg').css('border', '1px solid #ccc');
//
//        }

//        if (key_person == '') {
//            $('#key_person_error').html('Please fill key person field');
//            $('#key_person').css('border', '1px solid red');
//            error = true;
//        } else {
//            $('#key_person_error').html('');
//            $('#key_person').css('border', '1px solid #ccc');
//
//        }

        if (key_person_email == '') {
//            $('#c_email_error').html('Please fill email field');
//            $('#c_email').css('border', '1px solid red');
//            error = true;
        } else {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(key_person_email)) {
                $('#key_person_email_error').html('Invalid email address');
                $('#key_person_email').css('border', '1px solid red');
                error = true;
            } else {
                $('#key_person_email_error').html('');
                $('#key_person_email').css('border', '1px solid #ccc');
            }


        }

       
       if(c_contact_person == '') {
            $('#c_contact_person_error').html('Please fill contact person field');
            $('#c_contact_person').css('border', '1px solid red');
            error = true;
        } else {
            $('#c_contact_person_error').html('');
            $('#c_contact_person').css('border', '1px solid #ccc');

        }

       
       
        if (c_mobile_no == '') {
            $('#c_mobile_no_error').html('Please fill mobile number field');
            $('#c_mobile_no').css('border', '1px solid red');
            error = true;
        } else {

            $('#c_mobile_no_error').html('');
            $('#c_mobile_no').css('border', '1px solid #ccc');


        }

        if (c_email == '') {
            $('#c_email_error').html('Please fill email field');
            $('#c_email').css('border', '1px solid red');
            error = true;
        } else {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(c_email)) {
                $('#c_email_error').html('Invalid email address');
                $('#c_email').css('border', '1px solid red');
                error = true;
            } else {
                $('#c_email_error').html('');
                $('#c_email').css('border', '1px solid #ccc');
            }


        }

        if (error == true) {
            return false;
        }
    }

//    $('#save').onClick(function(){
//          alert('test');
//        var name=$('#customer_name').val();
//        if(name==''){
//            $('#customer_name_error').html('Please fill name field');
//            return false;
//        }
////        $('#task_name').css('border','1px solid #ccc');
//    }




</script>    