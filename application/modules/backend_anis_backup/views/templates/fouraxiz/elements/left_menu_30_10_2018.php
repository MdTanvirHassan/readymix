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
    padding-left: 16px;
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
    
</style>





<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col" style="background: darkcyan none repeat scroll 0 0;">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="<?php echo site_url('backend/dashboard'); ?>" class="site_title"><img id="logo_img" src='<?php echo site_url('images/wcl_logo.png'); ?>' style='width:20%;margin-top:-10px;;'/><span>&nbsp; WCL</span></span></a>
                </div>

                <div class="clearfix"></div>


                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">

                            
                          <li <?php if ($this->menu == 'general_store') echo 'class="active"'; ?>><a><i class="fa fa-list"></i><span class="main_menu_text"> GENERAL STORE</span><span class="fa fa-chevron-down"></span></a>
                                <ul  style="<?php if ($this->menu == 'general_store') echo 'display:block'; ?>" class="nav child_menu">
                                    <li class="set"  <?php if ($this->sub_menu == 'set_up') echo 'class="active"'; ?>><a style="font-size:17px;"><i class="fa fa-list fa-spinner"></i><span class="main_menu_text" > SETUP</span></span></a>
                                        <ul style="padding-left:0px;" class="setting"  >
                                           <li <?php if ($this->sub_inner_menu == 'supplier_information') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">SUPPLIER INFORMATION</span></a></li>
                                           <li <?php if ($this->sub_inner_menu == 'item_category') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/item_category'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ITEM CATEGORY</span></a></li>
                                           <li <?php if ($this->sub_inner_menu == 'item_group_information') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/item_group_information'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ITEM GROUP</span></a></li>
                                           <li <?php if ($this->sub_inner_menu == 'item_information') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/item_information'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ITEM INFORMATION</span></a></li>
                                           <li <?php if ($this->sub_inner_menu == 'department') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/department'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">PROJECT</span></a></li>
                                           <li <?php if ($this->sub_inner_menu == 'cost_center') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/cost_center'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">COST CENTER</span></a></li>
                                           <li <?php if ($this->sub_inner_menu == 'designation') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/designation'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">DESIGNATION</span></a></li>
                                           <li <?php if ($this->sub_inner_menu == 'employee') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/employee'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">USERS</span></a></li>
                                           <li <?php if ($this->sub_inner_menu == 'acl') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/acl'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ACL ROLE</span></a></li>
                                        </ul>
                                    </li>
                                    
                                    
                                     <li <?php if ($this->sub_menu == 'procurement') echo 'class="active"'; ?>><a style="font-size:17px;"><i class="fa fa-list fa-bank"></i><span class="main_menu_text"> PROCUREMENT</span></a>
                                        <ul style="padding-left:0px;" class="receive">
                                            <li <?php if ($this->sub_inner_menu == 'ipo_material_indent') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/ipo_material_indent'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text"> MATERIAL INDENT</span></a></li>
                                            <li <?php if ($this->sub_inner_menu == 'budget') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/budget'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text"> BUDGET</span></a></li>
                                           
                                        </ul>
                                    </li>
                                    
                                     <li <?php if ($this->sub_menu == 'receive') echo 'class="active"'; ?>><a style="font-size:17px;"><i class="fa fa-list fa-bank"></i><span class="main_menu_text"> RECEIVE</span></a>
                                        <ul style="padding-left:0px;" class="receive">
                                            <!--
                                            <li <?php if ($this->sub_inner_menu == 'ipo_material_indent') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/ipo_material_indent'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text"> MATERIAL INDENT</span></a></li>
                                             <li <?php if ($this->sub_inner_menu == 'budget') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/budget'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text"> BUDGET</span></a></li>
                                            -->
                                            <li <?php if ($this->sub_inner_menu == 'material_receive_requisition') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/material_receive_requisition'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MATERIAL RECEIVE </span></a></li> 
                                            <li <?php if ($this->sub_inner_menu == 'issue_return') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/issue_return'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">RETURN RECEIVE</span></a></li>
                                            <li <?php if ($this->sub_inner_menu == 'mrr_return_receive') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/mrr_return_receive'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MRR RETURN RECEIVE</span></a></li>
                                        </ul>
                                    </li>
                                    
                                      <li <?php if ($this->sub_menu == 'issue') echo 'class="active"'; ?>><a style="font-size:17px;"><i class="fa fa-list"></i><span class="main_menu_text">ISSUE</span></a>
                                        <ul style="padding-left:0px;" class="receive">
                                            <li <?php if ($this->sub_inner_menu == 'issue_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/issue_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MATERIAL ISSUE</span></a></li>
                                            <li <?php if ($this->sub_inner_menu == 'store_return') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/store_return'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">RETURN</span></a></li> 
                                        </ul>
                                    </li>
                                    
                                
                                        
                                    <li <?php if ($this->sub_menu == 'asset') echo 'class="active"'; ?>><a><i class="fa fa-cart-plus"></i><span class="main_menu_text">ASSET MOVEMENT</span><span class="main_menu_text"></span></a>
                                        <ul style="padding-left:0px;" class="receive">
                                            <li <?php if ($this->sub_inner_menu == 'asset_requisition') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/asset_requisition'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ASSET REQUISITION</span></a></li>
                                            <li <?php if ($this->sub_inner_menu == 'asset_issue') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/asset_issue'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ASSET ISSUE</span></a></li> 
                                            <li <?php if ($this->sub_inner_menu == 'asset_issue_receive') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/asset_issue_receive'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ASSET RETURN RECEIVE </span></a></li> 
                                        </ul>
                                    </li>
                                    
                                    
                               <!--           
                               
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">PURCHASE INDENT</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MATERIAL RECEIVE FOR QUALITY</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">QUALITY CONTROL</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MATERIAL RECEIVE FINALLY</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MATERIAL RETURN TO SUPPLIER</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ISSUE/SELL</span></a></li> 
                              -->
                                        <li <?php if ($this->sub_menu == 'report') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/report') ?>"><i class="fa fa-file"></i><span class="main_menu_text">REPORT</span></a>
                                                
                                        </li> 
                                         
                                        
                                </ul>
                            </li> 
                           
                            <!--
                            
                            <li <?php if ($this->menu == 'materials') echo 'class="active"'; ?>><a><i class="fa fa-list-alt"></i><span class="main_menu_text">RAW MATERIALS</span><span class="fa fa-chevron-down"></span></a>
                               <ul  style="<?php if ($this->menu == 'materials') echo 'display:block'; ?>" class="nav child_menu">
                                    <li <?php if ($this->sub_menu == 'material_primary') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/materials'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">Primary Information</span></a></li>
                                    <li <?php if ($this->sub_menu == 'material_issue') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/materials/materials_issue'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">RM Issue Session</span></a></li>
                                    <li <?php if ($this->sub_menu == 'material_mrr_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/materials/materials_mr_session'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">RM Mrr Session</span></a></li>
                                    <li <?php if ($this->sub_menu == 'material_primary_receive_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/materials/materials_primary_receive_session'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">RM Primary Rececive Session</span></a></li>
                                    <li <?php if ($this->sub_menu == 'material_purchase_receive_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/materials/materials_purchase_receive_session'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">RM Purchase Rececive Session</span></a></li>
                                    <li <?php if ($this->sub_menu == 'material_return_receive_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/materials/materials_return_receive_session'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">RM Return Rececive Session</span></a></li>
                                    <li <?php if ($this->sub_menu == 'materials_sales_transfer_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/materials/materials_sales_transfer_session'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">RM Sales Transfer Session</span></a></li> 
                                    <li <?php if ($this->sub_menu == 'materials_special_reporting_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/materials/materials_special_reporting_session'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">RM Special Reporting Session</span></a></li> 
                                    <li <?php if ($this->sub_menu == 'materials_status_changin_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/materials/materials_status_changin_session'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">RM Status Changing Session</span></a></li> 
                                    <li <?php if ($this->sub_menu == 'daily_material_receive_quality_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/materials/daily_material_receive_quality_session'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">Daily Material Receive Quality Session</span></a></li> 
                                    <li <?php if ($this->sub_menu == 'materials_lot_information') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/materials/materials_lot_information'); ?>"><i class="fa fa-dashboard"></i><span class="main_menu_text">RM Lot Information</span></a></li>   
                                   
                                </ul>
               
                            </li>
                            
                            
                            
                                    
                            
                            
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
