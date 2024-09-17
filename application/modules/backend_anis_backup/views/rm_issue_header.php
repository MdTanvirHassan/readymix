<div class="os-tabs-controls">
          
    <ul class="nav nav-tabs upper">
                <?php 
                $this->role = checkUserPermission(3, 9, $userData); 
               // if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>   
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'rm_issue') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/rm_issue'); ?>">
                        <span><nobr>MATERIAL ISSUE</nobr></span>
                    </a>
                </li>
                <?php //} ?> 
                
                
                <?php 
                $this->role = checkUserPermission(3, 9, $userData); 
                //if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>   
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'rm_sales') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/rm_sales'); ?>">
                        <span><nobr>SALES</nobr></span>
                    </a>
                </li>
                
                <?php 
                $this->role = checkUserPermission(3, 9, $userData); 
                //if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>   
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'rm_transfers') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/rm_transfers'); ?>">
                        <span><nobr>TRANSFER</nobr></span>
                    </a>
                </li>
              
                
               
                        
               
    </ul>
       
</div>