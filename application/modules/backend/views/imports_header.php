<div class="os-tabs-controls">
          
    <ul class="nav nav-tabs upper">

                        <?php $this->role = checkUserPermission(18,108, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->sub_inner_menu == 'sales_contact') echo 'active'; ?>" href="<?php echo site_url('backend/imports/sales_contact'); ?>">
                                <span>Sales Contract</span></a>
                        </li>
                        <?php } ?>

                        
                        <?php $this->role = checkUserPermission(18,109, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->sub_inner_menu == 'pi') echo 'active'; ?>" href="<?php echo site_url('backend/imports/pi'); ?>">
                                <span>Profoma Invoice</span></a>
                        </li>
                        <?php } ?>
                        
                        
                        <?php $this->role = checkUserPermission(18,110, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->sub_inner_menu == 'lc') echo 'active'; ?>" href="<?php echo site_url('backend/imports/lc'); ?>">
                                <span>Letter Of Credit</span></a>
                        </li>
                        <?php } ?>
                        
                        
                        <?php $this->role = checkUserPermission(18,110, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->sub_inner_menu == 'landed_cost') echo 'active'; ?>" href="<?php echo site_url('backend/imports/landed_cost'); ?>">
                                <span>Landed Cost</span></a>
                        </li>
                        <?php } ?>
                        
                        

                        <?php $this->role = checkUserPermission(18,111, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->sub_inner_menu == 'shipment') echo 'active'; ?>" href="<?php echo site_url('backend/imports/shipment'); ?>">
                                <span>Shipment</span></a>
                        </li>
                        <?php } ?>

                         <?php $this->role = checkUserPermission(18,112, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->sub_inner_menu == 'documents') echo 'active'; ?>" href="<?php echo site_url('backend/imports/documents'); ?>">
                                <span>Documents</span></a>
                        </li>
                        <?php } ?>  

                        <?php $this->role = checkUserPermission(18,113, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->sub_inner_menu == 'bill_entry') echo 'active'; ?>" href="<?php echo site_url('backend/imports/bill_entry'); ?>">
                                <span>Bill Entry</span></a>
                        </li>
                        <?php } ?> 

                        <?php $this->role = checkUserPermission(18,114, $userData); if(empty($this->role) || !in_array(11,$this->role)){ ?>    
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->sub_inner_menu == 'depot') echo 'active'; ?>" href="<?php echo site_url('backend/imports/depot'); ?>">
                                <span>Depot</span></a>
                        </li>
                        <?php } ?>   



            </ul>
       
</div>