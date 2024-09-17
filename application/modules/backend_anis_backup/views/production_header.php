 <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                <?php $this->role = checkUserPermission(13, 62, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'delivery_orders') echo 'active'; ?>" href="<?php echo site_url('backend/productions/delivery_orders'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>DELIVERY ORDER  </span>
                        </a>
                    </li>
                <?php } ?> 
                <?php $this->role = checkUserPermission(13, 57, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'production_schedule') echo 'active'; ?>" href="<?php echo site_url('backend/productions'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>PRODUCTION SCHEDULE  </span>
                        </a>
                    </li>
                <?php } ?> 
                
                
                <?php $this->role = checkUserPermission(13, 58, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'production_mixing') echo 'active'; ?>" href="<?php echo site_url('backend/production_mixing'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>PRODUCTION MIXING  </span>
                        </a>
                    </li>
                <?php } ?>  
                
                
                
                
                <?php $this->role = checkUserPermission(13, 59, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'production_statement') echo 'active'; ?>" href="<?php echo site_url('backend/productions/production_statement'); ?>">
                        <i class="fa fa-cc"></i><br><span>PRODUCTION</span></a>
                </li>
                <?php } ?>
                
                
                 <?php 
                 $this->role = checkUserPermission(13, 57, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>
                    <li class="nav-item">
                        <a   class="nav-link <?php if ($this->sub_inner_menu == 'delivery_challan') echo 'active'; ?>" href="<?php echo site_url('backend/delivery_challans'); ?>">
                            <i class="fa fa-info-circle"></i><br><span>DELIVERY CHALLAN  </span>
                        </a>
                    </li>
                <?php } ?> 
                
                
                
                <?php $this->role = checkUserPermission(13, 61, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'driver') echo 'active'; ?>" href="<?php echo site_url('backend/drivers'); ?>">
                            <i class="fa fa-cc"></i><br><span>Driver</span></a>
                    </li>
                <?php } ?>
                
                    <?php $this->role = checkUserPermission(13, 63, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'helper') echo 'active'; ?>" href="<?php echo site_url('backend/helpers'); ?>">
                            <i class="fa fa-cc"></i><br><span>HELPER</span></a>
                    </li>
                <?php } ?>
                    
                <?php $this->role = checkUserPermission(13, 60, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'truck') echo 'active'; ?>" href="<?php echo site_url('backend/trucks'); ?>">
                            <i class="fa fa-cc"></i><br><span>Truck</span></a>
                    </li>
                <?php } ?>
                <?php $this->role = checkUserPermission(13, 64, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'gate_pass') echo 'active'; ?>" href="<?php echo site_url('backend/gate_pass'); ?>">
                            <i class="fa fa-cc"></i><br><span>GATE PASS</span></a>
                    </li>
                <?php } ?>
              
                    
               
            </ul>
        </div>