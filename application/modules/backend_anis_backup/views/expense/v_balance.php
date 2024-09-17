<style>
    .btn-sm{
        padding:5px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(10, 45, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; ">Item  Information List</h2>
    <hr>-->
<div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <ul class="nav nav-tabs upper">
                 <?php 
                  $this->role = checkUserPermission(10, 45, $userData); 
                  if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                     ?>      
                <li class="nav-item">
                    <a class="nav-link <?php if ($this->sub_inner_menu == 'balance') echo 'active'; ?>" href="<?php echo site_url('backend/expense/balance'); ?>">
                        <i class="fa fa-cc"></i><br><span>Balance</span></a>
                </li>
                <?php } ?>
                <?php 
                $this->role = checkUserPermission(10,44, $userData); 
                if(empty($this->role) || !array_key_exists(11,$this->role)){ 
                    ?>
                <li class="nav-item">
                    <a   class="nav-link <?php if ($this->sub_inner_menu == 'expense') echo 'active'; ?>" href="<?php echo site_url('backend/expense'); ?>">
                        <i class="fa fa-info-circle"></i><br><span>Expense  </span>
                    </a>
                </li>
                <?php } ?> 
              </ul>
        </div>
    </div>
<div class="right_content">
     <?php  
     $this->role = checkUserPermission(10, 45, $userData); 
     if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('expense/addBalance'); ?>" class="btn btn-sm btn-primary">ADD BALANCE</a>
     <?php } ?> 
        <a class="pull-right" style="font-size: 20px;margin-bottom: 20px;" href="javascript:">Total Petty cash balance: <?php echo number_format($total_balance[0]['total_amount'],2); ?></a>
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th>SL</th>
                <th>Date</th>
                <th>Amount</th>
                
                <th>Remark</th>
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            <?php if (count($balance)) {
                $i= 1;
                foreach ($balance as $row) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php if(!empty($row['balance_date'])) echo date('d-m-Y',strtotime($row['balance_date'])); ?></td>
                        <td style="text-align: right;"><?php echo number_format($row['amount']); ?></td>
                        
                        <td><?php echo $row['remark']; ?></td>
                        

                        <td>
                            <?php  if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('expense/editBalance/'.$row['balanceID']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php } ?>
                             
                            <?php  if (in_array(5, $this->role)) { ?>    
<!--                                <button onclick="delete_row('<?php echo site_url('general_store/delete_item_information/'.$item['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>-->
                            <?php } ?>    
                        </td>
                    </tr>
    <?php
    $i++;
    
                            }
} ?>
        </tbody>
    </table>
</div>
</div>
