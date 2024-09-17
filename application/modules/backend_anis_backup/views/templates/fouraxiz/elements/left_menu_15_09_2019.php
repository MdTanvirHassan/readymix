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
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    // $this->role = checkUserPermission(10, '', $userData);
 ?>



<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col" style="background: darkcyan none repeat scroll 0 0;">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="<?php echo site_url('backend/dashboard'); ?>" class="site_title"><img id="logo_img" src='<?php echo site_url('images/wcl_logo.png'); ?>' style='width:20%;margin-top:-10px;font-size:20px;'/><span>&nbsp; KMIX</span></span></a>
                </div>

                <div class="clearfix"></div>


                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">

                            
                          <li <?php if ($this->menu == 'general_store') echo 'class="active"'; ?>><a><i class="fa fa-list"></i><span class="main_menu_text"> GENERAL STORE</span><span class="fa fa-chevron-down"></span></a>
                                <ul  style="<?php if ($this->menu == 'general_store') echo 'display:block'; ?>" class="nav child_menu">
                                   <?php $this->menu = checkMenuPermission(1, $userData);
                                        if (1 == $this->menu) {
                                    ?>
                                    <li class="set"  <?php if ($this->sub_menu == 'set_up') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store'); ?>" ><i class="fa fa-save"></i><span class="main_menu_text" > SETUP</span></span></a>
<!--                                            <ul style="padding-left:0px;" class="setting"  >
                                                
                                              <?php $this->role = checkUserPermission(1, 1, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                                                    <li <?php if ($this->sub_inner_menu == 'supplier_information') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">SUPPLIER INFORMATION</span></a></li>
                                              <?php } ?>  
                                                
                                               <?php $this->role = checkUserPermission(1, 2, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>      
                                                    <li <?php if ($this->sub_inner_menu == 'item_category') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/item_category'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ITEM CATEGORY</span></a></li>
                                               <?php } ?>
                                               
                                               <?php $this->role = checkUserPermission(1, 3, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                                                    <li <?php if ($this->sub_inner_menu == 'item_group_information') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/item_group_information'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ITEM GROUP</span></a></li>
                                               <?php } ?>     
                                                 
                                              <?php $this->role = checkUserPermission(1, 4, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>           
                                                    <li <?php if ($this->sub_inner_menu == 'item_information') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/item_information'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ITEM INFORMATION</span></a></li>
                                               <?php } ?>
                                                    
                                               <?php $this->role = checkUserPermission(1, 5, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                                                    <li <?php if ($this->sub_inner_menu == 'department') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/department'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">UNIT</span></a></li>
                                               <?php } ?>     
                                                   
                                              <?php $this->role = checkUserPermission(1, 6, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                                                    <li <?php if ($this->sub_inner_menu == 'cost_center') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/cost_center'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">COST CENTER</span></a></li>
                                              <?php } ?>
                                                    
                                               <?php $this->role = checkUserPermission(1, 6, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                                                    <li <?php if ($this->sub_inner_menu == 'designation') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/designation'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">DESIGNATION</span></a></li>
                                               <?php } ?>
                                                
                                               <?php $this->role = checkUserPermission(1, 6, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                                                    <li <?php if ($this->sub_inner_menu == 'employee') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/employee'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">USERS</span></a></li>
                                               <?php } ?>
                                                 
                                               <?php $this->role = checkUserPermission(1, 6, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                                                    <li <?php if ($this->sub_inner_menu == 'acl') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/acl'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ACL ROLE</span></a></li>
                                               <?php } ?>
                                                    
                                            </ul>-->
                                        </li>
                                   <?php } ?>  
                                        
                                        
                                        
                                    <?php $this->menu = checkMenuPermission(2, $userData);
                                        if (2 == $this->menu) {
                                    ?>
                                            <li <?php if ($this->sub_menu == 'procurement') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/ipo_material_indent'); ?>"><i class="fa fa-list fa-file"></i><span class="main_menu_text"> PROCUREMENT</span></a>
<!--                                               <ul style="padding-left:0px;" class="receive">
                                                   <?php $this->role = checkUserPermission(2, 7, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                                                        <li <?php if ($this->sub_inner_menu == 'ipo_material_indent') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/ipo_material_indent'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text"> MATERIAL INDENT</span></a></li>
                                                   <?php } ?>
                                                    
                                                        
                                                   <?php $this->role = checkUserPermission(2, 8, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                                                        <li <?php if ($this->sub_inner_menu == 'budget') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/budget'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text"> BUDGET</span></a></li>
                                                   <?php } ?>

                                               </ul>-->
                                           </li>
                                   <?php } ?>
                                           
                                           
                                    <?php $this->menu = checkMenuPermission(3, $userData);
                                        if (3 == $this->menu) {
                                    ?>
                                            <li <?php if ($this->sub_menu == 'receive') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/material_receive_requisition'); ?>" ><i class="fa fa-list fa-shopping-basket"></i><span class="main_menu_text"> RECEIVE</span></a>
<!--                                               <ul style="padding-left:0px;" class="receive">
                                                   <?php $this->role = checkUserPermission(3, 9, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>   
                                                        <li <?php if ($this->sub_inner_menu == 'material_receive_requisition') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/material_receive_requisition'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MATERIAL RECEIVE </span></a></li> 
                                                   <?php } ?>
                                                        
                                                   <?php $this->role = checkUserPermission(3, 10, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                                                        <li <?php if ($this->sub_inner_menu == 'issue_return') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/issue_return'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">RETURN RECEIVE</span></a></li>
                                                   <?php } ?>    
                                                        
                                                   <?php $this->role = checkUserPermission(3, 11, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                                                        <li <?php if ($this->sub_inner_menu == 'mrr_return_receive') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/mrr_return_receive'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MRR RETURN RECEIVE</span></a></li>
                                                   <?php } ?>  
                                                        
                                               </ul>-->
                                           </li>
                                    <?php } ?>
                                    
                                    
                                           
                                   <?php $this->menu = checkMenuPermission(4, $userData);
                                        if (4 == $this->menu) {
                                    ?>        
                                            <li <?php if ($this->sub_menu == 'issue') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/store_return'); ?>" ><i class="fa fa-check-circle"></i><span class="main_menu_text">ISSUE</span></a>
<!--                                              <ul style="padding-left:0px;" class="receive">
                                                  <?php $this->role = checkUserPermission(4, 12, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>  
                                                        <li <?php if ($this->sub_inner_menu == 'issue_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/issue_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MATERIAL ISSUE</span></a></li>
                                                  <?php } ?>     
                                                        
                                                 <?php $this->role = checkUserPermission(4, 13, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>        
                                                        <li <?php if ($this->sub_inner_menu == 'store_return') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/store_return'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">RETURN</span></a></li> 
                                                 <?php } ?>    
                                                        
                                              </ul>-->
                                          </li>
                                    <?php } ?> 
                                          
                                          
                                   <?php $this->menu = checkMenuPermission(8, $userData);
                                        if (8 == $this->menu) {
                                    ?>        
                                            <li <?php if ($this->sub_menu == 'invoice') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/purchase_invoices'); ?>" ><i class="fa fa-check-circle"></i><span class="main_menu_text">INVOICES</span></a>
                                       
                                          </li>
                                <?php } ?>        
                                          
                                          
                                   <!--       
                                
                                   <?php $this->menu = checkMenuPermission(5, $userData);
                                        if (5 == $this->menu) {
                                    ?>    
                                            <li <?php if ($this->sub_menu == 'asset') echo 'class="active"'; ?>><a><i class="fa fa-cart-plus"></i><span class="main_menu_text">ASSET MOVEMENT</span><span class="main_menu_text"></span></a>
                                                <ul style="padding-left:0px;" class="receive">
                                                    
                                                    <?php $this->role = checkUserPermission(5, 14, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                                                            <li <?php if ($this->sub_inner_menu == 'asset_requisition') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/asset_requisition'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ASSET REQUISITION</span></a></li>
                                                    <?php } ?>
                                                            
                                                    <?php $this->role = checkUserPermission(5, 15, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>       
                                                            <li <?php if ($this->sub_inner_menu == 'asset_issue') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/asset_issue'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ASSET ISSUE</span></a></li> 
                                                    <?php } ?>
                                                     
                                                    <?php $this->role = checkUserPermission(5, 16, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>        
                                                            <li <?php if ($this->sub_inner_menu == 'asset_issue_receive') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/asset_issue_receive'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ASSET RETURN RECEIVE </span></a></li> 
                                                    <?php } ?>    
                                                            
                                                </ul>
                                            </li>
                                    <?php } ?>
                                   -->
                                    
                               <!--           
                               
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">PURCHASE INDENT</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MATERIAL RECEIVE FOR QUALITY</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">QUALITY CONTROL</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MATERIAL RECEIVE FINALLY</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MATERIAL RETURN TO SUPPLIER</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ISSUE/SELL</span></a></li> 
                              -->
                                      
                                         <?php $this->menu = checkMenuPermission(6, $userData);
                                                if (6== $this->menu) {
                                         ?>
                                                <li <?php if ($this->sub_menu == 'report') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/report') ?>"><i class="fa fa-file"></i><span class="main_menu_text">REPORT</span></a></li> 
                                         <?php } ?>
                                                
                                         <?php $this->menu = checkMenuPermission(9, $userData);
                                                if (9== $this->menu) {
                                         ?>
                                                <li  <?php if ($this->sub_menu == 'consumption') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/consumption') ?>"><i class="fa fa-minus-circle"></i><span class="main_menu_text">CONSUMPTION</span></a></li> 
                                         <?php } ?>
                                                
                                          <?php $this->menu = checkMenuPermission(10, $userData);
                                                if (10== $this->menu) {
                                         ?>
                                                <li  <?php if ($this->sub_menu == 'expense') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/expense/balance') ?>"><i class="fa fa-delicious"></i><span class="main_menu_text">EXPENSE</span></a></li> 
                                            <?php } ?>  
                                                
                                          <?php $this->menu = checkMenuPermission(11, $userData);
                                                if (11== $this->menu){
                                         ?>       
                                                <li  <?php if ($this->sub_menu == 'transfer') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/transfer') ?>"><i class="fa fa-cab"></i><span class="main_menu_text">TRANSFER</span></a></li> 
                                         
                                          <?php } ?>
                                </ul>
                            </li> 
                           
                          
                         <?php $this->menu = checkMenuPermission(7, $userData);
                                if (7== $this->menu) {
                         ?>   
                           <li <?php if ($this->menu == 'sales') echo 'class="active"'; ?>><a><i class="fa fa-list-alt"></i><span class="main_menu_text">SALES</span><span class="fa fa-chevron-down"></span></a>
                               <ul  style="<?php if ($this->sub_menu == 'sale') echo 'display:block'; ?>" class="nav child_menu">
                                    
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
                                   <?php $this->role = checkUserPermission(7, 30, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>      
                                      <li <?php if ($this->sub_inner_menu == 'delivery_challan') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/delivery_challans'); ?>"><i class="fa fa-file"></i><span class="main_menu_text">Delivery Challans</span></a></li>
                                   <?php } ?> 
                                  <?php $this->role = checkUserPermission(7, 31, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                                        <li <?php if ($this->sub_inner_menu == 'sale_invoice') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/sale_invoices'); ?>"><i class="fa fa-indent"></i><span class="main_menu_text">Sales Invoices</span></a></li>
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
                                        
                                  <?php $this->role = checkUserPermission(7, 32, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                                     <li <?php if ($this->sub_inner_menu == 'sales_report') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/sales_report'); ?>"><i class="fa fa-file"></i><span class="main_menu_text">Report</span></a></li>
                                  <?php } ?>    
                                               
                                </ul>
               
                            </li>
                       <?php } ?>  
                       <?php $this->menu = checkMenuPermission(12, $userData);
                                if (12== $this->menu) {
                         ?>       
                            <li <?php if ($this->menu == 'cheque_register') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/cheque_register/cheque_list')?>"><i class="fa fa-chrome"></i><span class="main_menu_text">CHEQUE REGISTER</span></a></li>    
                     <?php } ?>     
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
