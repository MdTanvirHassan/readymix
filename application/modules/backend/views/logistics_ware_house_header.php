<div class="os-tabs-controls">
          
    <ul class="nav nav-tabs upper">
                <?php 
                $this->role = checkUserPermission(3, 9, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>   
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'material_receive_requisition') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/material_receive_requisition'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>MATERIAL RECEIVE  </span>
                    </a>
                </li>
                <?php } ?> 
                
                <?php $this->role = checkUserPermission(3, 10, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>     
                <!--
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'issue_return') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/issue_return'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>MATERIAL RECEIVE  </span>
                    </a>
                </li>
                -->
                <?php } ?> 
                
                <?php 
                $this->role = checkUserPermission(3, 13, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>        
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'store_return') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/store_return'); ?>">
                            <i class="fa fa-cc"></i><br><span>RETURN</span></a>
                    </li>
                <?php } ?>
                
                <?php 
                $this->role = checkUserPermission(3, 11, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>     
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'mrr_return_receive') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/mrr_return_receive'); ?>">
                        <i class="fa fa-cc"></i><br><span>MRR RETURN RECEIVE</span></a>
                </li>
                <?php } ?>
                
                <?php 
                $this->role = checkUserPermission(3,43, $userData);
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>     
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->sub_inner_menu == 'consumption') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/consumption'); ?>">
                                <i class="fa fa-cc"></i><br><span>Consumption</span></a>
                        </li>
                <?php } ?>
                        
               <?php 
               $this->role = checkUserPermission(3,47, $userData); 
               if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                   ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'transfer') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/transfer'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Transfer</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'from_transfer') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/fromTransfer'); ?>">
                        <i class="fa fa-cc"></i><br><span>Received Transfer Item </span></a>
                </li>
                <?php } ?> 
                
               <?php 
               $this->role = checkUserPermission(3, 9, $userData);
               if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                   ?>   
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'current_stock') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/currentStock'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Current Stock</span>
                    </a>
                </li>
             <?php } ?>   
                
            <?php 
               $this->role = checkUserPermission(3, 9, $userData);
               if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                   ?>   
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'opening_stock') echo 'active'; ?>" href="<?php echo site_url('backend/general_store/openingStock'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Opening Stock</span>
                    </a>
                </li>
             <?php } ?>   
                
            <?php 
               $this->role = checkUserPermission(3, 9, $userData);
               if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                   ?>   
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu=='item_adjustment') echo 'active'; ?>" href="<?php echo site_url('backend/item_adjustment'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Item Adjustment</span>
                    </a>
                </li>
             <?php } ?>    
                
               
                        
               
    </ul>
       
</div>