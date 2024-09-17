 <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(18,121, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'delivery_orders') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/delivery_challans/deliveryOrder/Yard'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>YARD DO  </span>
                        </a>
                    </li>
                <?php } ?> 
               
                
                
                 <?php 
                 $this->role = checkUserPermission(18,122, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'delivery_challan') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/delivery_challans'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>YARD CHALLAN  </span>
                        </a>
                    </li>
                <?php } ?> 
                
                <?php $this->role = checkUserPermission(18,123, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'hook_delivery_orders') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/delivery_challans/deliveryOrder/Hook'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>HOOK DO  </span>
                        </a>
                    </li>
                <?php } ?> 
                    
               <?php 
                 $this->role = checkUserPermission(18,124, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'hook_delivery_challan') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/delivery_challans/hook_challans'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>HOOK CHALLAN  </span>
                        </a>
                    </li>
                <?php } ?>      
                    
                
                <?php $this->role = checkUserPermission(18,125, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'driver') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/drivers'); ?>">
                            <i class="fa fa-cc"></i><br><span>Driver</span></a>
                    </li>
                <?php } ?>
                    
                <?php $this->role = checkUserPermission(18,125, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'master') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/masters'); ?>">
                            <i class="fa fa-cc"></i><br><span>Master</span></a>
                    </li>
                <?php } ?>    
                
                    <?php $this->role = checkUserPermission(18,126, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'helper') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/helpers'); ?>">
                            <i class="fa fa-cc"></i><br><span>HELPER</span></a>
                    </li>
                <?php } ?>
                    
                <?php $this->role = checkUserPermission(18,127,$userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'truck') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/trucks'); ?>">
                            <i class="fa fa-cc"></i><br><span>Truck</span></a>
                    </li>
                <?php } ?>
               
                <?php $this->role = checkUserPermission(18,127,$userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'ship') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/ships'); ?>">
                            <i class="fa fa-cc"></i><br><span>Ship</span></a>
                    </li>
                <?php } ?>
                    
               
            </ul>
        </div>