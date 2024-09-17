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
                <?php $this->role = checkUserPermission(7, 18, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) { ?> 
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'customers') echo 'active'; ?>" href="<?php echo site_url('backend/customers'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Customers</span>
                        </a>
                    </li>
                <?php } ?> 
<?php $this->role = checkUserPermission(7, 19, $userData);
if (empty($this->role) || !in_array(11, $this->role)) { ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'bank') echo 'active'; ?>" href="<?php echo site_url('backend/bank'); ?>">
                            <i class="fa fa-university"></i><br><span>Bank</span></a>
                    </li>
<?php } ?>
<?php $this->role = checkUserPermission(7, 20, $userData);
if (empty($this->role) || !in_array(11, $this->role)) { ?>          
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'product_category') echo 'active'; ?>" href="<?php echo site_url('backend/product_categories'); ?>">
                            <i class="fa fa-object-group"></i><br><span>Categories</span></a>
                    </li>
<?php } ?>
<?php $this->role = checkUserPermission(7, 21, $userData);
if (empty($this->role) || !in_array(11, $this->role)) { ?>    
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'sales_product') echo 'active'; ?>" href="<?php echo site_url('backend/sale_products'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>Products</span></a>
                    </li>
<?php } ?>
                <?php $this->role = checkUserPermission(7, 22, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) { ?>       
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'product_mixing') echo 'active'; ?>" href="<?php echo site_url('backend/products_mixing'); ?>">
                            <i class="fa fa-cubes"></i><br><span>Products Mixing</span></a>
                    </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(7, 23, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) { ?>          
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'project') echo 'active'; ?>" href="<?php echo site_url('backend/projects'); ?>">
                            <i class="fa fa-home"></i><br><span>Projects</span></a>
                    </li>
<?php } ?>

            </ul>
        </div>
    </div>

    <div class="">
      
        <div class="page-title">
            <div class="title_center">
                <h3>Customer Details Info</h3>
            </div>
        </div>
      
        <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        
                        <div class="row">
                            <div class="col-md-3 box-primary">
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo site_url('images/defualt.jpg')?>" alt="User profile picture">
                                   
                                    <b>Name :  <span><?php echo $customer_info[0]['c_name']?></span> </b>  <br>
                                    <b>Phone : <span><?php echo $customer_info[0]['head_office_mobile_no']?></span> </b> <br>
                                    <b>Email : <span><?php echo $customer_info[0]['head_office_email']?></span> </b> <br>
                                    <hr>
                                    <b style="font-size: 18px; color:#286090;">Deposit : <span id="deposit"><?php echo number_format($total_deposit,2)." BDT"; ?></span> </b> <br>
                                    <b style="font-size: 18px; color:#286090;">Bill : <span id="total"><?php echo number_format($total_bill,2)." BDT"; ?></span> </b> <br>
                                    <?php 
                                        $remain=$total_bill-$total_deposit;
                                    ?>
                                    
                                    <b style="font-size: 18px; color:#286090;">Due : <span id="due"><?php if($remain>0) echo number_format($remain,2)." BDT"; ?></span></b> <br>  
                                    <b style="font-size: 18px; color:#286090;">Balance : <span id="due"><?php if($remain<0) echo number_format(($total_deposit - $total_bill),2)." BDT"; ?></span></b> <br> 
                                    <b style="font-size: 18px; color:#286090;">Cheque at Hand : <span id="due"><?php  echo number_format($in_hand,2)." BDT"; ?></span></b> <br><br> 
                                   

                              
                            </div>
        <div class="col-md-9">
            <div class="tab" role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#personal" aria-controls="home" role="tab" data-toggle="tab">Personal Info</a></li>
                    <li role="presentation"><a href="#production_cost" aria-controls="profile" role="tab" data-toggle="tab">P.Cost</a></li>
                    <li role="presentation"><a href="#sales_quotation" aria-controls="profile" role="tab" data-toggle="tab">S.Quotation</a></li>
                    <li role="presentation"><a href="#sales_order" aria-controls="profile" role="tab" data-toggle="tab">S.Order</a></li>
                    <li role="presentation"><a href="#delivery_order" aria-controls="profile" role="tab" data-toggle="tab">D.Order</a></li>
                    <li role="presentation"><a href="#delivery_challan" aria-controls="profile" role="tab" data-toggle="tab">D.Challan</a></li>
                    <li role="presentation"><a href="#bills" aria-controls="messages" role="tab" data-toggle="tab">Bills</a></li>
                    <li role="presentation"><a href="#payment_collection" aria-controls="messages" role="tab" data-toggle="tab">P.collection</a></li>
                    <li role="presentation"><a href="#payment_receive" aria-controls="messages" role="tab" data-toggle="tab">P.receive</a></li>
                    <li role="presentation"><a href="#Projects" aria-controls="messages" role="tab" data-toggle="tab">Projects</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabs">
                    <div role="tabpanel" class="tab-pane fade in active" id="personal">
                        <h3>Company Info :</h3>
                        <table class="custom_table">
                            <tr>
                                <th>Customer ID</th>
                                <td><?php echo $customer_info[0]['c_code']?></td>
                                <th>Company Name</th>
                                <td><?php echo $customer_info[0]['c_name']?></td>
                            </tr>
                            <tr>
                                <th>C.Short Name</th>
                                <td><?php echo $customer_info[0]['c_short_name']?></td> 
                                <th>Address</th>
                                <td><?php echo $customer_info[0]['c_contact_address']?></td>
                            </tr>
                            <tr>
                                <th>H.O Phone</th>
                                <td><?php echo $customer_info[0]['head_office_phone_no']?></td>
                                <th>H.O Email</th>
                                <td><?php echo $customer_info[0]['head_office_email']?></td>
                            </tr>
                            <tr>
                               <th>Vat Reg.</th>
                                <td><?php echo $customer_info[0]['vat_reg']?></td> 
                               <th>Tin No.</th>
                                <td><?php echo $customer_info[0]['tin_no']?></td> 
                            </tr>
                            
                        </table>
                        
                        
                        <h3 style="margin-top:30px;">Key Person Info :</h3>
                        <table class="custom_table">
                            <tr>
                                <th>Key Person</th>
                                <td><?php echo $customer_info[0]['key_person']?></td>
                                <th>Phone </th>
                                <td><?php echo $customer_info[0]['key_person_phone']?></td>
                            </tr>
                            <tr>
                                <th>Email </th>
                                <td colspan="3"><?php echo $customer_info[0]['key_person_email']?></td> 
                                
                            </tr>
                            
                            
                        </table>
                        
                         <h3 style="margin-top:30px;">Contact Person Info :</h3>
                        <table class="custom_table">
                            <tr>
                                <th>Contact Person</th>
                                <td><?php echo $customer_info[0]['c_contact_person']?></td>
                                <th>Phone </th>
                                <td><?php echo $customer_info[0]['c_mobile_no']?></td>
                            </tr>
                            <tr>
                                <th>Email </th>
                                <td colspan="3"><?php echo $customer_info[0]['c_email']?></td> 
                                
                            </tr>
                            
                            
                        </table>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="production_cost">
                        <table class="table datatable table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-1">Date</th>
                                                <th class="col-lg-1">Costing NO.</th>
                                                <th class="col-lg-1">Product Name</th>
                                                <th class="col-lg-1">Project Name</th>
                                                <th class="col-lg-1">Casting Size(CUM)</th>
                                                <th class="col-lg-1">Casting Size(CFT)</th>
                                                <th class="col-lg-1">Price(CFT)</th>
                                                <th class="col-lg-1">Do.Status</th>
                                                

                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php if (count($product_cost)) {
                                            foreach ($product_cost as $order) { ?>
                                                <tr>
                                                    <td>
                                                        <?php if(!empty($order['created_date'])) echo date('d-m-Y',strtotime($order['created_date'])); ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo site_url('products_cost/details_product_cost/'.$order['product_cost_id'])?>"><?php if(!empty($order['cost_number'])) echo $order['cost_number']; ?></a>
                                                    </td>
                                                    <td>
                                                        <?php if(!empty($order['product_name'])) echo $order['product_name']; ?>
                                                    </td>
                                                  
                                                    <td>
                                                        <?php if(!empty($order['p_name'])) echo $order['p_name']; ?>
                                                    </td>
                                                    
                                                    <td>
                                                       <?php if(!empty($order['casting_size_cum'])) echo $order['casting_size_cum']; ?>
                                                    </td>
                                                    <td>
                                                       <?php if(!empty($order['casting_size_cft'])) echo $order['casting_size_cft']; ?>
                                                    </td>
                                                    <td>
                                                       <?php if(!empty($order['price_in_cft'])) echo $order['price_in_cft']; ?>
                                                    </td>
                                                    <td>
                                                            <?php
                                                            //if(!empty($order['status'])) echo $order['status']; 
                                                             if(!empty($order['status'])) echo $order['status']; 
                                                            ?>

                                                    </td>



                                                </tr>
                                <?php }
                            } ?>
                                    </tbody>
                                </table>
                        
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="sales_quotation">
                        <table class="table datatable table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Reference No</th>
                                                
                                                 <th>Project Name</th>
                                                <th>Amount</th>
                                                <th>Status</th>

                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php if (count($sales_quotation)) {
                                            foreach ($sales_quotation as $order) { ?>
                                                <tr>
                                                    <td>
                                                        <?php if(!empty($order['quotation_date'])) echo date('d-m-Y',strtotime($order['quotation_date'])); ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo site_url('sale_quotations/details_quotation/'.$order['q_id'])?>"><?php if(!empty($order['reference_no'])) echo $order['reference_no']; ?></a>
                                                    </td>
                                                    
                                                  
                                                    <td>
                                                        <?php if(!empty($order['project_name'])) echo $order['project_name']; ?>
                                                    </td>
                                                    <td>
                                    <?php if(!empty($order['total_amount'])) echo $order['total_amount']; ?>
                                                    </td>
                                                    <td>
                                                            <?php
                                                            //if(!empty($order['status'])) echo $order['status']; 
                                                             if(!empty($order['status'])) echo $order['status']; 
                                                            ?>

                                                    </td>



                                                </tr>
                                <?php }
                            } ?>
                                    </tbody>
                                </table>
                        
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="sales_order">
                        <table class="table datatable table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-1">Date</th>
                                                <th class="col-lg-1">Order No.</th>
                                                <th class="col-lg-1">Quotation No.</th>
                                               
                                                <th class="col-lg-1">Project Name</th>
                                                <th class="col-lg-1">Amount</th>
                                                <th class="col-lg-1">Do.Status</th>

                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php if (count($sale_orders)) {
                                            foreach ($sale_orders as $order) { 
                                                $total+=$order['total_amount'];
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php if(!empty($order['sale_order_date'])) echo date('d-m-Y',strtotime($order['sale_order_date'])); ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo site_url('sale_orders/details_sale_order/'.$order['o_id'])?>"><?php if(!empty($order['order_no'])) echo $order['order_no']; ?></a>
                                                    </td>
                                                    <td>
                                                        <?php if(!empty($order['reference_no'])) echo $order['reference_no']; ?>
                                                    </td>
                                                  
                                                    <td>
                                                        <?php if(!empty($order['project_name'])) echo $order['project_name']; ?>
                                                    </td>
                                                    <td>
                                    <?php if(!empty($order['total_amount'])) echo $order['total_amount']; ?>
                                                    </td>
                                                    <td>
                                                            <?php
                                                            //if(!empty($order['status'])) echo $order['status']; 
                                                             if(!empty($order['delivery_order_status'])) echo $order['delivery_order_status']; 
                                                            ?>

                                                    </td>



                                                </tr>
                                <?php }
                            } ?>
                                    </tbody>
                                </table>
                        
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="delivery_order">
                        <table  class="table datatable table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Order No.</th>
                                                <th>sales order No.</th>
                                                 <th>Project Name</th>
                                                <th>Amount</th>
                                                <th>Do.Status</th>

                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php if (count($delivery_orders)) {
                                            foreach ($delivery_orders as $order) { ?>
                                                <tr>
                                                    <td>
                                                        <?php if(!empty($order['delivery_order_date'])) echo date('d-m-Y',strtotime($order['delivery_order_date'])); ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo site_url('delivery_orders/details_delivery_order/'.$order['do_id'])?>"><?php if(!empty($order['delivery_no'])) echo $order['delivery_no']; ?></a>
                                                    </td>
                                                    <td>
                                                        <?php if(!empty($order['order_no'])) echo $order['order_no']; ?>
                                                    </td>
                                                  
                                                    <td>
                                                        <?php if(!empty($order['project_name'])) echo $order['project_name']; ?>
                                                    </td>
                                                    <td>
                                    <?php if(!empty($order['total_amount'])) echo $order['total_amount']; ?>
                                                    </td>
                                                    <td>
                                                            <?php
                                                            //if(!empty($order['status'])) echo $order['status']; 
                                                             if(!empty($order['do_status'])) echo $order['do_status']; 
                                                            ?>

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
                                                <th>Date</th>
                                                <th>Challan No.</th>
                                                <th>Delivery order No.</th>
                                                 <th>Project Name</th>
                                                 <th>Quantity</th>
                                                 <th>Unit Price</th>
                                                <th>Amount</th>
                                                <th>Mu Name</th>
                                                <th>Status</th>
                                                <th>Receive Status</th>

                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php if (count($delivery_challan)) {
                                            foreach ($delivery_challan as $order) { ?>
                                                <tr>
                                                    <td>
                                                        <?php if(!empty($order['delivery_challan_date'])) echo date('d-m-Y',strtotime($order['delivery_challan_date'])); ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo site_url('delivery_challans/details_delivery_challan/'.$order['dc_id'])?>"><?php if(!empty($order['dc_no'])) echo $order['dc_no']; ?></a>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo site_url('delivery_orders/details_delivery_order/'.$order['do_id'])?>"><?php if(!empty($order['delivery_no'])) echo $order['delivery_no']; ?></a>
                                                    </td>
                                                    <td>
                                                        <?php if(!empty($order['project_name'])) echo $order['project_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php if(!empty($order['quantity'])) echo $order['quantity']; ?>
                                                    </td>
                                                    <td>
                                                        <?php if(!empty($order['unit_price'])) echo $order['unit_price']; ?>
                                                    </td>
                                                    <td>
                                                   <?php if(!empty($order['total_amount'])) echo $order['total_amount']; ?>
                                                    </td>
                                                    <td>
                                                   <?php if(!empty($order['mu_name'])) echo $order['mu_name']; ?>
                                                    </td>
                                                    
                                                    <td>
                                                            <?php
                                                            //if(!empty($order['status'])) echo $order['status']; 
                                                             if(!empty($order['status'])) echo $order['status']; 
                                                            ?>

                                                    </td>
                                                     <td>
                                                   <?php if(!empty($order['receive_status'])) echo $order['receive_status']; ?>
                                                    </td>


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
                <th class="col-lg-1"> Invoice No.</th>
                <th class="col-lg-1"> Delivery No.</th>      
                <th class="col-lg-1">Project Name</th>
                <th class="col-lg-1">Amount</th>
                <th class="col-lg-1">Status</th>
              
            </tr>
        </thead>
        <tbody>
            <?php if (count($invoices)) {
                foreach ($invoices as $invoice) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($invoice['sale_invoice_date'])) echo date('d-m-Y',strtotime($invoice['sale_invoice_date'])); ?>
                        </td>
                        <td>
                            <a href="<?php echo site_url('sale_invoices/details_sale_invoice/'.$invoice['inv_id'])?>"><?php if(!empty($invoice['inv_no'])) echo $invoice['inv_no']; ?></a>
                        </td>
                        <td>
                            <?php if(!empty($invoice['delivery_no'])) echo $invoice['delivery_no']; ?>
                        </td>
                        <td>
        <?php if(!empty($invoice['project_name'])) echo $invoice['project_name']; ?>
                        </td>
                        
                        <td>
        <?php if(!empty($invoice['total_amount'])) echo $invoice['total_amount']; ?>
                        </td>
                        <td>
        <?php if(!empty($invoice['status'])) echo $invoice['status']; ?>
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
                    <div role="tabpanel" class="tab-pane fade" id="Projects">
                        <table class="custom_table">
                                                    <thead>
                                                        <tr>
                                                            <th>Project Name</th>

                                                            <th>Contact Person</th>
                                                            <th>Contact Number</th>
                                                            <th style="width:45%;">Address</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (count($projects)) {
                                                            foreach ($projects as $project) { ?>
                                                                <tr>

                                                                    <td>
                                                                        <?php if(!empty($project['project_name'])) echo $project['project_name']; ?>
                                                                    </td>

                                                                    <td>
                                                                        <?php if(!empty($project['contact_person'])) echo $project['contact_person']; ?>
                                                                    </td>

                                                                    <td>
                                                                        <?php if(!empty($project['contact_no'])) echo $project['contact_no']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if(!empty($project['address'])) echo $project['address']; ?>
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
                            <a href="<?php echo site_url('backend/customers') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
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