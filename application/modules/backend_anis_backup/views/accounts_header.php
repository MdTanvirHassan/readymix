 <div class="os-tabs-controls">
               <ul class="nav nav-tabs upper">
                   
                 <?php $this->role = checkUserPermission(14,67, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'audited_bill') echo 'active'; ?>" href="<?php echo site_url('backend/accounts'); ?>">
                            <i class="fa fa-cc"></i><br><span>Bill Register</span></a>
                    </li>
                <?php } ?>   
                   
                   
                
                <?php $this->role = checkUserPermission(14,67, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>     
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_inner_menu == 'payment') echo 'active'; ?>" href="<?php echo site_url('backend/accounts/payment'); ?>">
                            <i class="fa fa-cc"></i><br><span>Payment</span></a>
                    </li>
                <?php } ?>
                    
                 <?php $this->role = checkUserPermission(14, 68, $userData); 
                 if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                     ?>
                        <li class="nav-item">
                            <a   class="nav-link <?php if ($this->sub_inner_menu == 'paid_invoice') echo 'active'; ?>" href="<?php echo site_url('backend/accounts/paid_invoice'); ?>">
                                <i class="fa fa-info-circle"></i><br><span>Paid Bill</span>
                            </a>
                        </li>
                <?php } ?> 
                        
                 <?php $this->role = checkUserPermission(14,66, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'unpaid_invoice') echo 'active'; ?>" href="<?php echo site_url('backend/accounts/unpaidBill'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Unpaid Bill</span>
                    </a>
                </li>
                <?php } ?>        
               
            </ul>
        </div>