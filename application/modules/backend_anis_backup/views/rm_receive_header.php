<div class="os-tabs-controls">
          
    <ul class="nav nav-tabs upper">
                
                 <?php 
                $this->role = checkUserPermission(18,115, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>   
               
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'rm_lc_receive') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/rm_lc_receive'); ?>">
                        <span><nobr>LC RECEIVE</nobr></span>
                    </a>
                </li>
                <?php } ?> 
            
        
                <?php 
                $this->role = checkUserPermission(18,116, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>   
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'rm_receive') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/rm_receive'); ?>">
                        <span><nobr>MATERIAL RECEIVE</nobr></span>
                    </a>
                </li>
                <?php } ?> 
                
                
                <?php 
                $this->role = checkUserPermission(18,117, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>   
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'rm_qc') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/rm_qc'); ?>">
                        <span><nobr>QUALITY CONTROL</nobr></span>
                    </a>
                </li>
                <?php } ?>
                
                
                 <?php 
                $this->role = checkUserPermission(18,118,$userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>   
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'return_receive') echo 'active'; ?>" href="<?php echo site_url('backend/raw_materials/return_receive'); ?>">
                        <span><nobr>STORE RETURN RECEIVE</nobr></span>
                    </a>
                </li>
                <?php } ?> 
                
              
                
               
                        
               
    </ul>
       
</div>