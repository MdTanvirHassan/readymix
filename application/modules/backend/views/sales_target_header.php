<div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                  <?php $this->role = checkUserPermission(7, 97, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'sale_target') echo 'active'; ?>" href="<?php echo site_url('backend/sale_target'); ?>">
                        <i class="fa fa-cubes"></i><br><span>Sales Target</span></a>
                </li>
                <?php }?>
                  <?php $this->role = checkUserPermission(7, 97, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'sales_team') echo 'active'; ?>" href="<?php echo site_url('backend/sale_target/sales_team'); ?>">
                        <i class="fa fa-users"></i><br><span>Sales Team</span></a>
                </li>
                <?php }?>
                  <?php $this->role = checkUserPermission(7, 97, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'distribution') echo 'active'; ?>" href="<?php echo site_url('backend/sale_target/distribution'); ?>">
                        <i class="fa fa-exchange"></i><br><span>Distribution</span></a>
                </li>
                <?php }?>
                  <?php $this->role = checkUserPermission(7, 97, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'achivement') echo 'active'; ?>" href="<?php echo site_url('backend/sale_target/achivement'); ?>">
                        <i class="fa fa-bar-chart"></i><br><span>Achievement</span></a>
                </li>
                <?php }?>
                  <?php $this->role = checkUserPermission(7, 97, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'provide_incentive') echo 'active'; ?>" href="<?php echo site_url('backend/sale_target/provide_incentive'); ?>">
                        <i class="fa fa-list"></i><br><span>Provide Incentive</span></a>
                </li>
                <?php }?>
               
                  <?php $this->role = checkUserPermission(7, 97, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'sales_incentive') echo 'active'; ?>" href="<?php echo site_url('backend/sale_target/sales_incentive'); ?>">
                        <i class="fa fa-university"></i><br><span>Incentive Program</span></a>
                </li>
                <?php }?>

                <?php $this->role = checkUserPermission(7, 97, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <!-- <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'sales_commission') echo 'active'; ?>" href="<?php echo site_url('backend/sale_target/sales_commission'); ?>">
                        <i class="fa fa-list"></i><br><span>Sales Commission</span></a>
                </li> -->
                <?php }?>
              
            </ul>
        </div>