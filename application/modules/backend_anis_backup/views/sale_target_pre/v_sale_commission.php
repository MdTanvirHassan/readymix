<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(7, 97, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
            <?php require_once(__DIR__ .'/../sales_target_header.php'); ?>
        </div>
    </div>
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <?php  if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('sale_target/add_sale_commission'); ?>" class="btn btn-sm btn-primary">Add Commission</a>
    <?php } ?> 
    <!-- <a href="<?php echo site_url('sales_report/targetAchievementReport'); ?>" class="btn btn-sm btn-success">REPORT</a>    -->
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
               
                <th class="col-lg-2">Date</th>
                <th class="col-lg-2">Commission Id</th>
                <th class="col-lg-2">Client</th>
                <th class="col-lg-2">Benificiary</th>
                <th class="col-lg-2">Amount</th>
               
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($sale_commission)) {
                foreach ($sale_commission as $order) { ?>
                    <tr>
                       
                        <td>
                            <?php if(!empty($order['date'])) echo date("F-Y", strtotime($order['date'])); ?>
                        </td>
                        <td>
                            <?php if(!empty($order['commisson_no'])) echo $order['commisson_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($order['name'])) echo $order['name']; ?>
                        </td>
                        <td>
                            <?php if(!empty($order['benificiary'])) echo $order['benificiary']; ?>
                        </td>
                        <td>
                            <?php if(!empty($order['amount'])) echo $order['amount']; ?>
                        </td>

                        <td>
                           
                                <?php  if (in_array(3, $this->role)) { ?>
                                    <a href="<?php echo site_url('sale_target/edit_sale_commission/'.$order['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php } ?>    
                           
                           
                           <?php  if (in_array(4, $this->role)) { ?>         
                                <a href="<?php echo site_url('sale_target/details_sale_commission/'.$order['id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                           <?php } ?>
                            
                                <?php  if (in_array(5, $this->role)) { ?>
                                    <button onclick="delete_row('<?php echo site_url('sale_target/delete_sale_commission/'.$order['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                <?php } ?>    
                             
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
</div>
</div>
