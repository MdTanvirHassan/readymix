<div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">


                  <?php
                $this->role = checkUserPermission(1, 1, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_menu == 'dashboard') echo 'active'; ?>" href="<?php echo site_url('backend/cheque_register/dashboard'); ?>">
                            <i class="fa fa-home"></i><br><span>Dashbord</span>
                        </a>
                    </li>     
                <?php } ?>
                
                <?php
                $this->role = checkUserPermission(1, 1, $userData);
                if (empty($this->role) || !in_array(11, $this->role)) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_menu == 'cheque_list') echo 'active'; ?>" href="<?php echo site_url('backend/cheque_register/cheque_list'); ?>">
                            <i class="fa fa-object-group"></i><br><span>Book Entry</span>
                        </a>
                    </li>     
                <?php } ?>

                    
                    <?php
               $this->role = checkUserPermission(1, 2, $userData); 
                                if(empty($this->role) || !in_array(11,$this->role)){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->menu == 'assign_cheque_list') echo 'active'; ?>" href="<?php echo site_url('backend/cheque_register/assigned_cheque_list'); ?>">
                            <i class="fa fa-wrench"></i><br><span>Cheque Write</span>
                        </a>
                    </li>     
                <?php } ?>
                    
                    <?php
               $this->role = checkUserPermission(1, 2, $userData); 
                                if(empty($this->role) || !in_array(11,$this->role)){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->menu == 'printed_cheque_list') echo 'active'; ?>" href="<?php echo site_url('backend/cheque_register/printed_cheque_list'); ?>">
                            <i class="fa fa-print"></i><br><span>Printed Chq.</span>
                        </a>
                    </li>     
                <?php } ?>
                    
                    <?php
               $this->role = checkUserPermission(1, 2, $userData); 
                                if(empty($this->role) || !in_array(11,$this->role)){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->menu == 'issued_cheque_list') echo 'active'; ?>" href="<?php echo site_url('backend/cheque_register/issued_cheque_list'); ?>">
                            <i class="fa fa-bookmark"></i><br><span>Issued Chq.</span>
                        </a>
                    </li>     
                <?php } ?>
                    
                    <?php
               $this->role = checkUserPermission(1, 2, $userData); 
                                if(empty($this->role) || !in_array(11,$this->role)){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->menu == 'wastage_cheque_list') echo 'active'; ?>" href="<?php echo site_url('backend/cheque_register/wastage_cheque_list'); ?>">
                            <i class="fa fa-trash-o"></i><br><span>Wastage Chq.</span>
                        </a>
                    </li>     
                <?php } ?>
                    <?php
               $this->role = checkUserPermission(1, 2, $userData); 
                                if(empty($this->role) || !in_array(11,$this->role)){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_menu == 'daily_cheque_register') echo 'active'; ?>" href="<?php echo site_url('backend/cheque_register/dailyChk'); ?>">
                            <i class="fa fa-file"></i><br><span> Daily Register Chq.</span>
                        </a>
                    </li>     
                <?php } ?>
                
                 <?php
               $this->role = checkUserPermission(1, 2, $userData); 
                                if(empty($this->role) || !in_array(11,$this->role)){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_menu == 'daily_printed_cheque_report') echo 'active'; ?>" href="<?php echo site_url('backend/cheque_register/daily_printed_cheque_report'); ?>">
                            <i class="fa fa-file"></i><br><span> Daily Printed Chq. </span>
                        </a>
                    </li>     
                <?php } ?>
                    
                    <?php
               $this->role = checkUserPermission(1, 2, $userData); 
                                if(empty($this->role) || !in_array(11,$this->role)){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->sub_menu == 'all_cheque_report') echo 'active'; ?>" href="<?php echo site_url('backend/cheque_register/allChequeReport'); ?>">
                            <i class="fa fa-file"></i><br><span>All Chq. Report</span>
                        </a>
                    </li>     
                <?php } ?>
            </ul>
        </div>
    </div>