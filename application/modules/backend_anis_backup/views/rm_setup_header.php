 <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
               
               <?php $this->role = checkUserPermission(18,103, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'rm_setup') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/rm_setup'); ?>">
                        <span>Items</span></a>
                </li>
                <?php } ?>
               
                
               <?php $this->role = checkUserPermission(18,104, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'rm_customer') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/customers'); ?>">
                        <span>Customers</span></a>
                </li>
                <?php } ?>
                
                
                <?php $this->role = checkUserPermission(18,105, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'rm_supplier') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/suppliers'); ?>">
                        <span>Suppliers</span></a>
                </li>
                <?php } ?>
                
                
                <?php $this->role = checkUserPermission(18,106, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'rm_transport_company') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/transport_companies'); ?>">
                            <span>Transport Company</span></a>
                    </li>
                <?php } ?>
                
               <?php $this->role = checkUserPermission(18,136, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'rm_bank') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/bank'); ?>">
                            <span>Bank</span></a>
                    </li>
                <?php } ?>     
                    
                
            </ul>
        </div>