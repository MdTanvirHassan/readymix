<style>
    
    
    .nav.child_menu li.active ul li.active a {
        color: #00ffff !important;
        font-weight: bold;
    }
   
    .setting li{
        padding-left:10px !important;
       
        background:none !important;
        list-style:none !important;
    }
    .setting li::before{
       
        background:none !important;
        border-radius: 0px !important;
        width:0px !important;
    }
    .setting li a{
        font-size:11px !important;
    }
    
    .receive li{
        padding-left:10px !important;
       
        background:none !important;
        list-style:none !important;
    }
    .receive li::before{
       
        background:none !important;
    }
     .receive li a{
        font-size:11px !important;
    }
    
    .issue li{
        padding-left:10px !important;
       
        background:none !important;
        list-style:none !important;
    }
    .issue li::before{
       
        background:none !important;
    }
     .issue li a{
        font-size:11px !important;
    } 
    
    
    .nav.child_menu > li > a {
    
    padding: 4px;
}


.nav.child_menu li {
/*    padding-left: 16px;*/
padding: 5px 17px;
}

.nav-md ul.nav.child_menu li::after {
    border-left: 0px solid #425668;
    bottom: 0;
    content: "";
    left: 27px;
    position: absolute;
    top: 0;
}

.nav-md ul.nav.child_menu li::before {
    background: #425668;
    bottom: auto;
    content: "";
    height: 8px;
    left: 23px;
    margin-top: 15px;
    position: absolute;
    right: auto;
    width: 0px;
    z-index: 1;
    border-radius: 0%;
}
.nav li.current-page {
	background: #2B2B40;
}
.main_menu .fa {
	
	font-size: 15px;
	
}
.nav-sm ul.nav.child_menu li a {
	text-align:center !important;
}
.nav-sm .side-menu li a .main_menu_text {
	display: block;
}
 
.nav.side-menu > li > a {
    font-size: 17px;
}


</style>

<?php
    $user_id = $this->session->userdata('user_id');
    $user_type = $this->session->userdata('user_type');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    // $this->role = checkUserPermission(10, '', $userData);
 ?>



<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col" style="background: darkcyan none repeat scroll 0 0;">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                 <!--   <a href="<?php echo site_url('backend/dashboard'); ?>" class="site_title"><img id="logo_img" src='<?php echo site_url('images/wcl_logo.png'); ?>' style='width:20%;margin-top:-10px;font-size:20px;'/><span>&nbsp; KMIX</span></span></a>-->
                     <a style="padding:0px;" href="<?php echo site_url('backend/dashboard'); ?>" class="site_title"><img id="logo_img" src='<?php echo site_url('images/logoo.webp'); ?>' style='width:100%;margin-top:-39px;;'/></span></a>
                </div>

                <div class="clearfix"></div>


                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">

                         <?php $this->menu = checkMenuPermission(1,$userData);
                                        if (1 == $this->menu) {
                                    ?>    
                          <li <?php if ($this->menu =='general_store') echo 'class="active"'; ?>><a><i class="fa fa-list"></i><span class="main_menu_text">GENERAL STORE</span><span class="fa fa-chevron-down"></span></a>
                       <?php } ?>     
                                <ul  style="<?php if ($this->menu == 'general_store') echo 'display:block'; ?>" class="nav child_menu">
                                   <?php 
                                   $this->menu = checkMenuPermission(1, $userData);
                                 $this->role = checkUserPermission(1,69, $userData); 
                              //          if (1 == $this->menu) {
                                   if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                                    ?>
                                    <li   <?php if ($this->sub_menu == 'set_up') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store'); ?>" ><i class="fa fa-save"></i><span class="main_menu_text" > SETUP</span></span></a>
                                           
                                        </li>
                                   <?php } ?>  
                                        
                                        
                                        
                                   
                                    
                                    <?php $this->menu = checkMenuPermission(17,$userData);
                                        if (17 == $this->menu) {
                                    ?>
                                           <li <?php if ($this->sub_menu=='material_indent') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/ipo_material_indent'); ?>" ><i class="fa fa-list fa-shopping-basket"></i><span class="main_menu_text">MATERIAL INDENT</span></a>
                                              
                                           </li>
                                    <?php } ?>     
                                        
                                        
                                        
                                        
                                           
                                    <?php $this->menu = checkMenuPermission(3, $userData);
                                        if (3 == $this->menu) {
                                    ?>
                                            <li <?php if ($this->sub_menu == 'receive') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/material_receive_requisition'); ?>" ><i class="fa fa-list fa-shopping-basket"></i><span class="main_menu_text"> LOGISTICS & WAREHOUSE</span></a>

                                           </li>
                                    <?php } ?>
                                    
                                    
                                           
                                   <?php $this->menu = checkMenuPermission(4, $userData);
                                        if (4 == $this->menu) {
                                    ?>       
                                    <?php } ?> 
                                          
                                       
                                          
                                   <?php $this->menu = checkMenuPermission(6, $userData);
                                                if (6== $this->menu) {
                                         ?>
                                                <li <?php if ($this->sub_menu == 'report') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/report') ?>"><i class="fa fa-file"></i><span class="main_menu_text">REPORT</span></a></li> 
                                   <?php } ?>        
                                 
                                    
                            
                                      
                                         
                                       
                                </ul>
                            </li> 
                           
                         
                        
                            
                     <?php $this->menu = checkMenuPermission(2, $userData);
                                        if (2 == $this->menu) {
                                    ?>
                                            <li <?php if ($this->sub_menu == 'procurement') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/indentList'); ?>"><i class="fa fa-list fa-file"></i><span class="main_menu_text"> PROCUREMENT</span></a>
                                              
                                           </li>
                     <?php } ?>        
                            
                            
                            
                        
                            
                            
                            
                            
                      <?php $this->role = checkMenuPermission(8,$userData);
                                if (8== $this->role) {
                         ?>   
                              
                             <li <?php if ($this->sub_menu == 'audit') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/purchase_invoices/audit'); ?>" ><i class="fa fa-check-circle"></i><span class="main_menu_text">AUDIT</span></a>
                                       
                             </li>
                                        
                         
                     <?php } ?>       
                            
                            
                            
                            
                            
                        <?php $this->menu = checkMenuPermission(14, $userData);
                                if (14== $this->menu) {
                         ?>       
                            <li <?php if ($this->menu == 'accounts') echo 'class="active"'; ?>><a><i class="fa fa-list-alt"></i><span class="main_menu_text">ACCOUNTS</span><span class="fa fa-chevron-down"></span></a>
                            <ul  style="<?php if ($this->sub_menu == 'account') echo 'display:block'; ?>" class="nav child_menu">
                                         
                                
                                    
                                       <?php $this->role = checkUserPermission(14,65, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?> 
                                         <li <?php if ($this->sub_menu=='account') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/purchase_invoices/auditedBill'); ?>" ><i class="fa fa-check-circle"></i><span class="main_menu_text">Bills</span></a>
                                       
                                         </li>
                                       <?php } ?>  
                                         
                                       
                                            
                                       <?php $this->role = checkUserPermission(10, 44, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                                          <li  <?php if ($this->sub_menu == 'expense') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/expense/balance') ?>"><i class="fa fa-delicious"></i><span class="main_menu_text">EXPENSE</span></a></li> 
                                       <?php } ?>  
                                </ul>
                            </li>    
                     <?php } ?>     
                            
                            
                            
                    
                       
                            
                       
                      
                            
                            
                            
                            
                            
                            
                            
                            
                            
                         <?php $this->menu = checkMenuPermission(7, $userData);
                                if (7== $this->menu) {
                         ?>   
                           <li <?php if ($this->menu == 'sales') echo 'class="active"'; ?>><a><i class="fa fa-list-alt"></i><span class="main_menu_text">SALES</span><span class="fa fa-chevron-down"></span></a>
                               <ul  style="<?php if ($this->sub_menu == 'sale') echo 'display:block'; ?>" class="nav child_menu">
                                    
                                   <?php $this->role = checkUserPermission(7, 18, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?> 
                                     <li class="set"  <?php if ($this->sub_menu == 's_dashboard') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/dashboard/s_dashboard'); ?>" ><i class="fa fa-save"></i><span class="main_menu_text" > DASHBOARD</span></span></a>   
<!--                                   <li <?php if ($this->sub_inner_menu == 'customers') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/customers'); ?>" style=""><i class="fa fa-dashboard"></i><span class="main_menu_text">Customers</span></a></li>-->
                                    <?php } ?> 
                                   <?php $this->role = checkUserPermission(7, 18, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?> 
                                     <li class="set"  <?php if ($this->sub_menu == 's_setup') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/customers'); ?>" ><i class="fa fa-save"></i><span class="main_menu_text" > SETUP</span></span></a>   
<!--                                   <li <?php if ($this->sub_inner_menu == 'customers') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/customers'); ?>" style=""><i class="fa fa-dashboard"></i><span class="main_menu_text">Customers</span></a></li>-->
                                    <?php } ?> 
                                    <?php $this->role = checkUserPermission(7, 19, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
<!--                                        <li <?php if ($this->sub_inner_menu == 'bank') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/bank'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">Bank</span></a></li>-->
                                   <?php } ?> 
                                        
                                    <?php $this->role = checkUserPermission(7, 20, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>          
<!--                                        <li <?php if ($this->sub_inner_menu == 'product_category') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/product_categories'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">Categories</span></a></li>-->
                                      <?php } ?>
                                    <?php $this->role = checkUserPermission(7, 21, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
<!--                                        <li <?php if ($this->sub_inner_menu == 'sales_product') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/sale_products'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">Products</span></a></li>-->
                                     <?php } ?> 
                                  <?php $this->role = checkUserPermission(7, 22, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
<!--                                        <li <?php if ($this->sub_inner_menu == 'product_mixing') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/products_mixing'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">Products Mixing</span></a></li>-->
                                   <?php } ?>  
                                  <?php $this->role = checkUserPermission(7, 23, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>          
<!--                                        <li <?php if ($this->sub_inner_menu == 'project') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/projects'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">Projects</span></a></li>-->
                                   <?php } ?> 
                                    <?php $this->role = checkUserPermission(7, 97, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                                        <li <?php if ($this->sub_inner_menu == 'sale_target') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/sale_target'); ?>"><i class="fa fa-cart-plus"></i><span class="main_menu_text">Sales Targes</span></a></li>
                                     <?php } ?>     
                                    <?php $this->role = checkUserPermission(7, 24, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                                        <li <?php if ($this->sub_inner_menu == 'product_cost') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/products_cost'); ?>"><i class="fa fa-product-hunt"></i><span class="main_menu_text">Products Cost</span></a></li>
                                    <?php } ?>  
                                    <?php $this->role = checkUserPermission(7, 25, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                                        <li <?php if ($this->sub_inner_menu == 'quotations') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/sale_quotations'); ?>"><i class="fa fa-question"></i><span class="main_menu_text">Sales Quotations</span></a></li>
                                     <?php } ?>  
                                     <?php $this->role = checkUserPermission(7, 26, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                                        <li <?php if ($this->sub_inner_menu == 'sale_order') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/sale_orders'); ?>"><i class="fa fa-cart-plus"></i><span class="main_menu_text">Sales Orders</span></a></li>
                                     <?php } ?>
                                   
                                   <?php $this->role = checkUserPermission(7, 29, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>         
                                        <li <?php if ($this->sub_inner_menu == 'delivery_order') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/delivery_orders'); ?>"><i class="fa fa-delicious"></i><span class="main_menu_text">Delivery Orders</span></a></li>
                                   <?php } ?> 
                                   <!--     
                                   <?php $this->role = checkUserPermission(7, 29, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>         
                                        <li <?php if ($this->sub_inner_menu == 'production') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/productions'); ?>"><i class="fa fa-delicious"></i><span class="main_menu_text">Productions</span></a></li>
                                   <?php } ?>     
                                   -->
                                  <!--      
                                   <?php $this->role = checkUserPermission(7, 30, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>      
                                      <li <?php if ($this->sub_inner_menu == 'delivery_challan') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/delivery_challans'); ?>"><i class="fa fa-file"></i><span class="main_menu_text">Delivery Challans</span></a></li>
                                   <?php } ?> 
                                   -->
                                  <?php $this->role = checkUserPermission(7, 31, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                                        <li <?php if ($this->sub_inner_menu == 'sale_invoice') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/sale_invoices'); ?>"><i class="fa fa-indent"></i><span class="main_menu_text">Sales Invoices</span></a></li>
                                  <?php } ?> 
                                  

                                  <?php $this->role = checkUserPermission(7, 31, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                                        <li <?php if ($this->sub_inner_menu == 'sale_invoice_top_sheet') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/sale_invoices_top_sheet'); ?>"><i class="fa fa-indent"></i><span class="main_menu_text">Sales Invoices Top Sheet</span></a></li>
                                  <?php } ?> 

                                  
                                  <?php $this->role = checkUserPermission(7, 31, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                                        <li <?php if ($this->sub_inner_menu == 'paid_sales_invoice') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/sale_invoices/paidInvoice'); ?>"><i class="fa fa-indent"></i><span class="main_menu_text">Paid Sales Invoices</span></a></li>
                                  <?php } ?>  

                                  <?php $this->role = checkUserPermission(7, 98, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                                        <li <?php if ($this->sub_inner_menu == 'sales_commission') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/sale_orders/sales_commission'); ?>"><i class="fa fa-indent"></i><span class="main_menu_text">Sales Commission</span></a></li>
                                  <?php } ?>   
                                  
                                  
                                        
                                   <?php $this->role = checkUserPermission(7, 27, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                                        <li <?php if ($this->sub_inner_menu == 'payment_collection') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/payment_collections'); ?>"><i class="fa fa-paypal"></i><span class="main_menu_text">Payment Collections</span></a></li>
                                   <?php } ?>  
                                        
                                  <?php $this->role = checkUserPermission(7, 27, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                                        <li <?php if ($this->sub_inner_menu == 'payment_received') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/payment_collections/payment_received'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">Payment Received</span></a></li>
                                  <?php } ?>           
                                        
                                    <?php $this->role = checkUserPermission(7, 28, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                                        <li <?php if ($this->sub_inner_menu == 'deposit_realization') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/deposit_realization'); ?>"><i class="fa fa-dedent"></i><span class="main_menu_text">Deposit & Realization</span></a></li>
                                    <?php } ?>  
                                        
                                   <?php $this->role = checkUserPermission(7, 28, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                                        <li <?php if ($this->sub_inner_menu == 'realized_cheque_bg_lc') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/deposit_realization/realized_cheque_bg_lc'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">Realized Cheque/Bg/Lc</span></a></li>
                                   <?php } ?> 
                                        
                                   <?php $this->role = checkUserPermission(7, 27, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                                        <li <?php if ($this->sub_inner_menu == 'payment_collection_deposit_realization') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/payment_collections/allCollectionAndRealization'); ?>"><i class="fa fa-paypal"></i><span class="main_menu_text">All Collections & Realization </span></a></li>
                                   <?php } ?>       
                                        
                                   <?php $this->role = checkUserPermission(7, 28, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                                        <li <?php if ($this->sub_inner_menu == 'payment_return') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/payment_return'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">Payment Return</span></a></li>
                                   <?php } ?>           
                                        
                                  <?php $this->role = checkUserPermission(7, 32, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                                     <li <?php if ($this->sub_inner_menu == 'sales_report') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/sales_report'); ?>"><i class="fa fa-file"></i><span class="main_menu_text">Report</span></a></li>
                                  <?php } ?>    
                                               
                                </ul>
               
                            </li>
                       <?php } ?>  
                            
                            
                      <?php $this->role = checkMenuPermission(13, $userData);
                                if (13== $this->role) {
                         ?>       
                            <li <?php if ($this->menu == 'production') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/productions/delivery_orders')?>"><i class="fa fa-chrome"></i><span class="main_menu_text">PRODUCTIONS</span></a></li>    
                     <?php } ?>            
                            
                            
                       <?php $this->menu = checkMenuPermission(12, $userData);
                                if (12== $this->menu) {
                         ?>       
                            <li <?php if ($this->menu == 'cheque_register') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/cheque_register/cheque_list')?>"><i class="fa fa-chrome"></i><span class="main_menu_text">CHEQUE REGISTER</span></a></li>    
                     <?php } ?>     
                       <?php $this->menu = checkMenuPermission(15, $userData);
                                if (15== $this->menu) {
                         ?>       
                            <li <?php if ($this->menu == 'pump_fooding') echo 'class="active"'; ?>><a><i class="fa fa-list-alt"></i><span class="main_menu_text">PUMP FOODING</span><span class="fa fa-chevron-down"></span></a>
                            <ul  style="<?php if ($this->menu == 'pump_fooding') echo 'display:block'; ?>" class="nav child_menu">
                                        <li <?php if ($this->sub_menu == 'pump') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/pump/index'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Pump Fooding</span></a></li>
                                        <li <?php if ($this->sub_menu == 'pump_report') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/pump/allPump'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Report</span></a></li>
                                       
                                        

                                </ul>
                            </li>    
                     <?php } ?>
                
                <!--            
                            
                    <?php $this->menu = checkMenuPermission(18, $userData);
                                if (18== $this->menu) {
                                    
                         ?>       
                            <li <?php if ($this->menu == 'trading') echo 'class="active"'; ?>><a><i class="fa fa-list-alt"></i><span class="main_menu_text">Trading</span><span class="fa fa-chevron-down"></span></a>
                            <ul  style="<?php if ($this->menu == 'trading') echo 'display:block'; ?>" class="nav child_menu">
                                <?php $this->role = checkUserPermission(18,102, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>  
                                       <li <?php if ($this->sub_menu == 'rm_setup') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/raw_materials/rm_setup'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Setup</span></a></li>
                                <?php } ?>  
                                       
                                       
                                <?php $this->role = checkUserPermission(18,102, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                                       <li <?php if ($this->sub_menu == 'rm_import') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/imports/sales_contact'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Import</span></a></li>
                                <?php } ?>
                                <?php $this->role = checkUserPermission(18,115, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                                       <li <?php if ($this->sub_menu == 'rm_receive') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/raw_materials/rm_lc_receive'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Receive</span></a></li>
                                <?php } ?>
                                <?php $this->role = checkUserPermission(18,119, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                                       <li <?php if ($this->sub_menu == 'rm_delivery_order') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/raw_materials/rm_sales'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Delivery Order</span></a></li>
                                <?php } ?>
                                <?php $this->role = checkUserPermission(18,120, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                                       <li <?php if ($this->sub_menu == 'rm_challan') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/raw_materials/delivery_challans'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Delivery Or Challan</span></a></li>
                                <?php } ?>
                                       
                               
                                
                                
                                <?php $this->role = checkUserPermission(18,128, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                                       <li <?php if ($this->sub_menu == 'rm_invoice') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/raw_materials/sale_invoices'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Sale Invoices</span></a></li>
                                <?php } ?>
                                       
                               <?php $this->role = checkUserPermission(18,129, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                                       <li <?php if ($this->sub_menu == 'payment_collection') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/raw_materials/payment_collections'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Payment Collection</span></a></li>
                                <?php } ?>        
                                  
                                       
                                       
                               <?php $this->role = checkUserPermission(18,130, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                                        <li <?php if ($this->sub_menu == 'rm_payment_received') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/raw_materials/payment_collections/payment_received'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">Payment Received</span></a></li>
                                <?php } ?>           
                                        
                                    <?php $this->role = checkUserPermission(18,131, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                                        <li <?php if ($this->sub_menu == 'rm_deposit_realization') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/raw_materials/deposit_realization'); ?>"><i class="fa fa-dedent"></i><span class="main_menu_text">Deposit & Realization</span></a></li>
                                    <?php } ?>  
                                        
                                   <?php $this->role = checkUserPermission(18,132, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                                        <li <?php if ($this->sub_menu == 'rm_realized_cheque_bg_lc') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/raw_materials/deposit_realization/realized_cheque_bg_lc'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">Realized Cheque/Bg/Lc</span></a></li>
                                   <?php } ?> 
                                        
                                   <?php $this->role = checkUserPermission(18,133, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                                        <li <?php if ($this->sub_menu == 'rm_payment_collection_deposit_realization') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/raw_materials/payment_collections/allCollectionAndRealization'); ?>"><i class="fa fa-paypal"></i><span class="main_menu_text">All Collections & Realization </span></a></li>
                                   <?php } ?>       
                                        
                                   <?php $this->role = checkUserPermission(18,134, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                                        <li <?php if ($this->sub_menu == 'rm_payment_return') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/raw_materials/payment_return'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">Payment Return</span></a></li>
                                   <?php } ?>   
                                
                                       
                                <?php $this->role = checkUserPermission(18,135, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                                       <li <?php if ($this->sub_menu == 'report') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/raw_materials/sales_report'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Reports</span></a></li>
                                <?php } ?>       
                                        

                                </ul>
                            </li>    
                                    <?php }  ?>    
                        -->
                            
                            
                       <!--       
                                    
                            
                            
                           <li <?php if ($this->menu == 'finished_goods') echo 'class="active"'; ?>><a><i class="fa fa-list"></i><span class="main_menu_text"> FINISHED GOODS</span><span class="fa fa-chevron-down"></span></a>
                        
                                <ul  style="<?php if ($this->menu == 'finished_goods') echo 'display:block'; ?>" class="nav child_menu">
                                        <li <?php if ($this->sub_menu == 'finished_goods_current_stock') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Current Stock Position</span></a></li>
                                        <li <?php if ($this->sub_menu == 'finished_goods_delivery_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods/finished_goods_delivery_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Delivery Session</span></a></li>
                                         <li <?php if ($this->sub_menu == 'finished_goods_receive_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods/finished_goods_receive_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Receive Session</span></a></li>
                                        <li <?php if ($this->sub_menu == 'finished_goods_receiving_report') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods/finished_goods_receiving_report'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Receiving Report</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'finished_goods_sale_return_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods/finished_goods_sale_return_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Sale Return Session</span></a></li>
                                        <li <?php if ($this->sub_menu == 'finished_goods_lot_information') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods/finished_goods_lot_information'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Lot Information</span></a></li> 
                                        

                                </ul>
                         
                            </li> 
                            
                            
                             <li <?php if ($this->menu == 'territory') echo 'class="active"'; ?>><a><i class="fa fa-list"></i><span class="main_menu_text"> WASTAGE</span><span class="fa fa-chevron-down"></span></a>
                                <ul  style="<?php if ($this->menu == 'territory') echo 'display:block'; ?>" class="nav child_menu">
                                      
                                        
                                </ul>
                            </li> 
                            
                            
                            -->
                            
                             
                            
                          
                           
                            
                            
                           
                           




                        </ul>
                    </div>


                </div>
              
            </div>
        </div>
