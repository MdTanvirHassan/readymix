<style>
 .navbar-nav .open .dropdown-menu.dropdown-created {
	position: absolute;
/*	background: rgba(2, 12, 20, 0.8);*/
	background:#233953;
	margin-top: 0;
	border: 1px solid #233953;
	-webkit-box-shadow: none;
	right: 0;
	left: auto;
	width: 400px !important;
}
.dropdown-created li a {
	color: #ffffff !important;
}
.top_nav .dropdown-menu.dropdown-created li {
	width: 50%;
        float:left;
}
.dropdown-menu.dropdown-created  > li > a:focus, .dropdown-menu.dropdown-created > li > a:hover {
	color: #262626;
	text-decoration: none;
	background-color: #3D3D3D !important;
        padding-left:25px;
}
.dropdown-menu > li > a {
	color: #5A738E !important;
}
.addLink > li > a {
	color: #ffffff !important;
}
.projectChange > li > a {
	color: #ffffff !important;
}
.dropdown-menu > li .text-center > a {
	color: #5A738E !important;
}
.nav .projectChange{
    max-width:100%;
}


.nav .projectChange li {
	height: auto;
	margin: 0;
	background: #0E66B7;
	border: none;
	color: #fff;
	padding: 7px 0px;
	border-top: 1px solid #004D9E;
}
.nav .user-menu li {
	text-align: center;
}
.projectChange > li > a:hover {
	background-color: #004D9E;
	color: #fff !important;
}
</style>
<?php
         $companyName = $this->session->userdata('companyName');
         $companyId = $this->session->userdata('companyId');
?>
<!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
               
              </div>
               <!-- <p style="text-align: center;color:#ffffff;margin-top:20px;">WAHID CONSTRUCTION LTD.</p>-->
              <ul class="nav navbar-nav navbar-right">
                  <li style="float:left;height: 61px;padding-right:10px;margin-left:-80px;"><p style="text-align: center;color:#81878C;margin-top:20px;font-size:19px;">KARIM ASPHALT & READY MIX LTD.</p></li>
                 
                       
<!--                  <li style="float:left;margin-left:100px;"><i class="fa fa-plus-circle" style="font-size: 27px;color: #0D47A1;margin-top: 17px;"></i></li>-->
                <!--  
                  <li class="top-search" style="float:left;border-right:1px solid #ddd;border-left:1px solid #ddd;margin-left:10px;height: 61px;">
                      <form method="post" action="<?php echo site_url('general_store/search_result'); ?>" role="search">  
                    <div id="imaginary_container"> 
                        <div class="input-group stylish-input-group">
                            <input name="keyword" type="text" class="form-control"  placeholder="Search By supplier" required="">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>  
                            </span>
                        </div>
                    </div>
                 </form> 
                  </li>
                -->
                  
                  <li class="dropdown user user-menu hidden-xs menu-dropdown" style="float:left;border-right:1px solid #ddd;border-left:1px solid #ddd;margin-left:-10px;height: 61px;text-align: center;">
                    <b>Branch</b><br>
                    <div class="btn-group">
                        <button id="city" style="background: transparent;padding:2px 10px;min-width:120px;" class="btn">
                             <?php
                             foreach ($this->companies as $com) {
                                 
                                if($companyId == $com['d_id']) {
                                            echo strtoupper($com['dep_description']);
                                        }
                                
                                
                                ?>
                            
                            <?php }?>
                        </button><br>
                        <button style="background: transparent;padding:0px;width:100%;margin-top: -7px;"  class="btn" data-toggle="dropdown">
        <span class="fa fa-angle-down"></span>
    </button>
                        <ul  class="dropdown-menu projectChange" role="menu" aria-labelledby="dropdownMenu">
                            <!--
       <li><a tabindex="-1" href="#">Dhaka</a></li>
       <li><a tabindex="-1" href="#">Savar</a></li>
       -->                     
        
       <?php foreach ($this->companies as $com) { ?>
       <li><a style="white-space: normal;" tabindex="-1" href="<?php echo site_url('dashboard/enterByComapany/'.$com['d_id'])?>"><?php echo $com['dep_description']; ?></a></li>
       
       <?php } ?>
       
    </ul>
</div>
                </li>
              
       
                  <li style="float:left;border-right:1px solid #ddd;border-left:1px solid #ddd;margin-left:10px;height: 61px;" class="">
                    <a  href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" title="Create">
                    
                    <i class="fa fa-plus-circle" style="font-size: 27px;color: #0D47A1;"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-created addLink">
                      <p style="padding:13px 0px 0px 11px;color: #fff;font-weight: bold;font-size: 14px;">All Create  Links</p>
                      <?php $this->role = checkUserPermission(1, 1, $userData); if (in_array(2, $this->role)) { ?>
                      <li><a href="<?php echo site_url('general_store/add_supplier'); ?>"><i class="fa fa-plus-circle"></i> Add Supplier</a></li>
                      <?php } ?>
                      <?php $this->role = checkUserPermission(1, 2, $userData); if (in_array(2, $this->role)) { ?>
                      <li><a href="<?php echo site_url('general_store/add_item_category'); ?>"><i class="fa fa-plus-circle"></i> Add Category</a></li>
                      <?php }?>
                      <?php $this->role = checkUserPermission(1, 3, $userData); if (in_array(2, $this->role)) { ?>
                      <li><a href="<?php echo site_url('general_store/add_item_group_information'); ?>"><i class="fa fa-plus-circle"></i> Add Item Group</a></li>
                      <?php }?>
                      <?php $this->role = checkUserPermission(1, 4, $userData); if (in_array(2, $this->role)) { ?>
                      <li><a href="<?php echo site_url('general_store/add_item_information'); ?>"><i class="fa fa-plus-circle"></i> Add Item</a></li>
                      <?php }?>
                      <?php $this->role = checkUserPermission(1, 5, $userData); if (in_array(2, $this->role)) { ?>
                      <li><a href="<?php echo site_url('general_store/add_department'); ?>"><i class="fa fa-plus-circle"></i> Add Unit</a></li>
                      <?php }?>
                      <?php $this->role = checkUserPermission(1, 6, $userData); if (in_array(2, $this->role)) { ?>
                      <li><a href="<?php echo site_url('general_store/add_cost_center'); ?>"><i class="fa fa-plus-circle"></i> Add Cost Center</a></li>
                      <?php }?>
                      <?php $this->role = checkUserPermission(1, 36, $userData); if (in_array(2, $this->role)) { ?>
                      <li><a href="<?php echo site_url('general_store/add_designation'); ?>"><i class="fa fa-plus-circle"></i> Add Designation</a></li>
                      <?php }?>
                      <?php $this->role = checkUserPermission(1, 37, $userData); if (in_array(2, $this->role)) { ?>
                      <li><a href="<?php echo site_url('general_store/add_employee'); ?>"><i class="fa fa-plus-circle"></i> Add User</a></li>
                      <?php }?>
                      <?php $this->role = checkUserPermission(1, 38, $userData); if (in_array(2, $this->role)) { ?>
                      <li><a href="<?php echo site_url('general_store/add_acl'); ?>"><i class="fa fa-plus-circle"></i> Add ACL</a></li>
                      <?php }?>
                  </ul>
                </li>
                <li style="float:left;border-right:1px solid #ddd;border-left:1px solid #ddd;margin-left:10px;height: 61px;" role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                      <i style="font-size:30px;"class="fa fa-bell-o"></i>
                    <span class="badge bg-green"></span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu" >
                  
                  </ul>
                </li>
                <li class="">
                  <a  href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/logo_admin.png" alt=""><?php echo $this->session->userdata('user_name'); ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
<!--                    <li><a href="javascript:;"> Profile</a></li>-->
<!--                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>-->
<!--                    <li><a href="javascript:;">Help</a></li>-->
                    <li><a href="<?php echo site_url('backend/login/profile'); ?>"><i class="fa fa-sign-out pull-right"></i> Profile</a></li>
                    <li><a href="<?php echo site_url('backend/login/changePassword'); ?>"><i class="fa fa-sign-out pull-right"></i> Change Password</a></li>
                    <li><a href="<?php echo site_url('backend/login/logOut'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->