
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

                            
                         
                            
                            
                            <li <?php if ($this->menu == 'materials') echo 'class="active"'; ?>><a><i class="fa fa-list-alt"></i><span class="main_menu_text">Raw Materials</span><span class="fa fa-chevron-down"></span></a>
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
                            
                            
                            
                                    
                            
                            
                           <li <?php if ($this->menu == 'finished_goods') echo 'class="active"'; ?>><a><i class="fa fa-list"></i><span class="main_menu_text"> Finished Goods</span><span class="fa fa-chevron-down"></span></a>
                                <ul  style="<?php if ($this->menu == 'finished_goods') echo 'display:block'; ?>" class="nav child_menu">
                                        <li <?php if ($this->sub_menu == 'finished_goods_current_stock') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Current Stock Position</span></a></li>
                                        <li <?php if ($this->sub_menu == 'finished_goods_delivery_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods/finished_goods_delivery_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Delivery Session</span></a></li>
                                         <li <?php if ($this->sub_menu == 'finished_goods_receive_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods/finished_goods_receive_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Receive Session</span></a></li>
                                        <li <?php if ($this->sub_menu == 'finished_goods_receiving_report') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods/finished_goods_receiving_report'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Receiving Report</span></a></li> 
                                        <li <?php if ($this->sub_menu == 'finished_goods_sale_return_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods/finished_goods_sale_return_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Sale Return Session</span></a></li>
                                        <li <?php if ($this->sub_menu == 'finished_goods_lot_information') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/finished_goods/finished_goods_lot_information'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">FG Lot Information</span></a></li> 
                                        

                                </ul>
                            </li> 
                            
                            
                            
                           <li <?php if ($this->menu == 'customers') echo 'class="active"'; ?>><a><i class="fa fa-list"></i><span class="main_menu_text"> Customers Info</span><span class="fa fa-chevron-down"></span></a>
                                <ul  style="<?php if ($this->menu == 'customers') echo 'display:block'; ?>" class="nav child_menu">
                                        <li <?php if ($this->sub_menu == 'customers_basic_info') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/customers'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Customer's Basic Info</span></a></li>
                                          <li <?php if ($this->sub_menu == 'customers_supplier') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/customers/customers_supplier'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Customer's Supplier Info</span></a></li>
                                        
                                </ul>
                           </li>  
                            
                            
                            
                              <li <?php if ($this->menu == 'general_store') echo 'class="active"'; ?>><a><i class="fa fa-list"></i><span class="main_menu_text"> General Stores</span><span class="fa fa-chevron-down"></span></a>
                                <ul  style="<?php if ($this->menu == 'general_store') echo 'display:block'; ?>" class="nav child_menu">
                                        <li <?php if ($this->sub_menu == 'store_return_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Store Return Session</span></a></li>
                                         <li <?php if ($this->sub_menu == 'sample_delivery_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/sample_delivery_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Sample Delivery Session</span></a></li>
                                         <li <?php if ($this->sub_menu == 'yarn_basic_information') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/yarn_basic_information'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Yarn Basic Information</span></a></li> 
                                         <li <?php if ($this->sub_menu == 'machinary_spares_issue') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/machinary_spares_issue_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Machinary Spares Issue Session</span></a></li>
                                         <li <?php if ($this->sub_menu == 'machinary_spares_sell_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/machinary_spares_sell_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Machinary Spares Sell Session</span></a></li>
                                         <li <?php if ($this->sub_menu == 'miscelleneoure_reporting_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/miscelleneoure_reporting_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Miscelleneour Reporting Session</span></a></li>
                                         <li <?php if ($this->sub_menu == 'monthly_valuation') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/monthly_valuation'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Monthly Valuation</span></a></li>
                                         <li <?php if ($this->sub_menu == 'current_transaction_year_setting') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/current_transaction_year_setting'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Current Transaction Year Setting</span></a></li> 
                                         <li <?php if ($this->sub_menu == 'ipo_reminder_dmr_report') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/ipo_reminder_dmr_report'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Ipo Reminder And Dmr Report</span></a></li> 
                                         <li <?php if ($this->sub_menu == 'ipo_receive_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/ipo_receive_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Ipo Receive Session</span></a></li>
                                         <li <?php if ($this->sub_menu == 'issue_report') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/issue_report'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Issue Report</span></a></li> 
                                         <li <?php if ($this->sub_menu == 'do_report_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/do_report_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Do Report Session</span></a></li>
                                         <li <?php if ($this->sub_menu == 'do_session') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/do_session'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Do  Session</span></a></li>
                                         <li <?php if ($this->sub_menu == 'ic_basic_information') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/ic_basic_information'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Ic Basic Information </span></a></li>
                                         <li <?php if ($this->sub_menu == 'proforma_invoice') echo 'class="active"'; ?>><a href="<?php echo site_url('backend/general_store/proforma_invoice'); ?>"><i class="fa fa-location-arrow"></i><span class="main_menu_text">Proforma Invoice </span></a></li>  
                                        
                                </ul>
                            </li> 
                            
                          
                             <li <?php if ($this->menu == 'territory') echo 'class="active"'; ?>><a><i class="fa fa-list"></i><span class="main_menu_text"> Wastage Scrapes</span><span class="fa fa-chevron-down"></span></a>
                                <ul  style="<?php if ($this->menu == 'territory') echo 'display:block'; ?>" class="nav child_menu">
                                      
                                        
                                </ul>
                            </li> 
                            
                             <li <?php if ($this->menu == 'territory') echo 'class="active"'; ?>><a><i class="fa fa-list"></i><span class="main_menu_text">Backup</span><span class="fa fa-chevron-down"></span></a>
                                <ul  style="<?php if ($this->menu == 'territory') echo 'display:block'; ?>" class="nav child_menu">
                                       
                                        
                                </ul>
                            </li> 
                            
                            
                           
                           




                        </ul>
                    </div>


                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <!--                <div class="sidebar-footer hidden-small">
                                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                    </a>
                                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                                    </a>
                                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                                    </a>
                                    <a href="<?php echo site_url('backend/login/logOut'); ?>" data-toggle="tooltip" data-placement="top" title="Logout">
                                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                                    </a>
                                </div>-->
                <!-- /menu footer buttons -->
            </div>
        </div>
