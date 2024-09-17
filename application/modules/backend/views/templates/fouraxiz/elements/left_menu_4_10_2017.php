
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col" style="background: darkcyan none repeat scroll 0 0;">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="<?php echo site_url('backend/dashboard'); ?>" class="site_title"><img id="logo_img" src='<?php echo site_url('images/logo.png'); ?>' style='width:20%;'/><span>&nbsp; IMS</span></span></a>
                </div>

                <div class="clearfix"></div>


                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">

                            
                          <li <?php if ($this->menu == 'general_store') echo 'class="active"'; ?>><a><i class="fa fa-list"></i><span class="main_menu_text"> GENERAL STORE</span><span class="fa fa-chevron-down"></span></a>
                                <ul  style="<?php if ($this->menu == 'general_store') echo 'display:block'; ?>" class="nav child_menu">
                                        <li <?php if ($this->sub_menu == 'supplier_information') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">SUPPLIER INFORMATION</span></a></li>
                                        <li <?php if ($this->sub_menu == 'item_information') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/item_information'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ITEM INFORMATION</span></a></li>
                                        <li <?php if ($this->sub_menu == 'item_group_information') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/item_group_information'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ITEM GROUP</span></a></li>
                                        <li <?php if ($this->sub_menu == 'department') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/department'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">DEPARTMENT/PROJECT</span></a></li>
                                        <li <?php if ($this->sub_menu == 'ipo_material_indent') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/ipo_material_indent'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text"> MATERIAL INDENT</span></a></li>
                                        <li <?php if ($this->sub_menu == 'store_return') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/store_return'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">STORE RETURN</span></a></li>
                                        <li <?php if ($this->sub_menu == 'material_receive_requisition') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/material_receive_requisition'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MATERIAL RECEIVE REQUISITION</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'issue_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/issue_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ISSUE SESSION</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">PURCHASE INDENT</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MATERIAL RECEIVE FOR QUALITY</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">QUALITY CONTROL</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MATERIAL RECEIVE FINALLY</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">MATERIAL RETURN TO SUPPLIER</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">ISSUE/SELL</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'article_group_information') echo 'class="active"'; ?>><a href="#"><i class="fa fa-location-arrow"></i><span class="main_menu_text">REPORT</span></a></li> 
                                         
                                        
                                </ul>
                            </li> 
                            
                            
                            <li <?php if ($this->menu == 'materials') echo 'class="active"'; ?>><a><i class="fa fa-list-alt"></i><span class="main_menu_text">RAW MATERIALS</span><span class="fa fa-chevron-down"></span></a>
                         <!--       <ul  style="<?php if ($this->menu == 'materials') echo 'display:block'; ?>" class="nav child_menu">
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
                         -->
                            </li>
                            
                            
                            
                                    
                            
                            
                           <li <?php if ($this->menu == 'finished_goods') echo 'class="active"'; ?>><a><i class="fa fa-list"></i><span class="main_menu_text"> FINISHED GOODS</span><span class="fa fa-chevron-down"></span></a>
                               <!--
                                <ul  style="<?php if ($this->menu == 'finished_goods') echo 'display:block'; ?>" class="nav child_menu">
                                        <li <?php if ($this->sub_menu == 'finished_goods_current_stock') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Current Stock Position</span></a></li>
                                        <li <?php if ($this->sub_menu == 'finished_goods_delivery_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods/finished_goods_delivery_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Delivery Session</span></a></li>
                                         <li <?php if ($this->sub_menu == 'finished_goods_receive_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods/finished_goods_receive_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Receive Session</span></a></li>
                                        <li <?php if ($this->sub_menu == 'finished_goods_receiving_report') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods/finished_goods_receiving_report'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Receiving Report</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'finished_goods_sale_return_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods/finished_goods_sale_return_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Sale Return Session</span></a></li>
                                        <li <?php if ($this->sub_menu == 'finished_goods_lot_information') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods/finished_goods_lot_information'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Lot Information</span></a></li> 
                                        

                                </ul>
                               -->
                            </li> 
                            
                            
                             <li <?php if ($this->menu == 'territory') echo 'class="active"'; ?>><a><i class="fa fa-list"></i><span class="main_menu_text"> WASTAGE</span><span class="fa fa-chevron-down"></span></a>
                                <ul  style="<?php if ($this->menu == 'territory') echo 'display:block'; ?>" class="nav child_menu">
                                      
                                        
                                </ul>
                            </li> 
                            
                            
                            
                            
                             
                            
                          
                           
                            
                            
                           
                           




                        </ul>
                    </div>


                </div>
              
            </div>
        </div>
