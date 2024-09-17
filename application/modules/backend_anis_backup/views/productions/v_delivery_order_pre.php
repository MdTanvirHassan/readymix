<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(7, 29, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; ">Delivery Order  List</h2>
    <hr>-->
<div class="os-tabs-w menu-shad">
       <?php require_once(__DIR__ .'/../production_header.php'); ?>
    </div>
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Delivery Order  List
                <select id="search_by" style="width: 200px" class="form-control pull-right">
                            <option value="">Search by Status</option>
                            <option>Pending</option>
                            <option>Partially Delivered</option>
                            <option>Delivered.</option>
                            <option value=''>All</option>
                        </select>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <?php  
    $this->role = checkUserPermission(13, 62, $userData);
    if (in_array(2, $this->role)) { ?>
        <!--<a href="<?php echo site_url('delivery_orders/add_delivery_order'); ?>" class="btn btn-sm btn-primary">ADD ORDER</a>-->
    <?php } ?>
                                 
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Delivery No.</th>
                <th class="col-lg-1">Order No.</th>
                <th class="col-lg-1">Customer Name</th>
                <th class="col-lg-1">Project Name</th>
            <!--    <th class="col-lg-1">Amount</th>-->
                <th class="col-lg-1">Challan Status</th>
                <th class="col-lg-1">Do Status</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($delivery_orders)) {
                
                foreach ($delivery_orders as $order) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($order['delivery_order_date'])) echo date('d-m-Y',strtotime($order['delivery_order_date'])); ?>
                        </td>
                        <td>
                            <?php if(!empty($order['delivery_no'])) echo $order['delivery_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($order['order_no'])) echo $order['order_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($order['c_name'])) echo $order['c_name']; ?>
                        </td>
                        <td>
                            <?php if(!empty($order['project_name'])) echo $order['project_name']; ?>
                        </td>
                         <!-- 
                        <td>
                         <?php //if(!empty($order['total_amount'])) echo $order['total_amount']; ?>
                        </td>
                         -->
                        <td>
                                <?php if(!empty($order['status'])) echo ($order['status']=='Delivered') ? $order['status'].'.' : $order['status']; ?>
                        </td>
                        
                        <td>
                                <?php if(!empty($order['do_status'])) echo $order['do_status']; ?>
                        </td>
                       

                        <td>
                            <?php  if (in_array(3, $this->role)) { ?>
                               <?php if($order['do_status']=="Pending"){ ?>
<!--                                    <a href="<?php echo site_url('delivery_orders/approve_delivery_order/'.$order['do_id']); ?>"><button class="btn btn-sm btn-primary">Approve</button></a>
                                    <a href="<?php echo site_url('delivery_orders/reject_delivery_order/'.$order['do_id']); ?>"><button class="btn btn-sm btn-warning">Reject</button></a>-->
                                    <!--<a href="<?php echo site_url('delivery_orders/edit_delivery_order/'.$order['do_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>-->
                                    
                               <?php }else{ ?> 
                                    <?php if($order['do_status']=="Approved"){ ?>        
                                            <!--<a href="<?php echo site_url('delivery_orders/reject_delivery_order/'.$order['do_id']); ?>"><button class="btn btn-sm btn-warning">Reject</button></a>-->
                                     <?php }else if($order['do_status']=="Rejected"){ ?>
                                            <!--<a href="<?php echo site_url('delivery_orders/approve_delivery_order/'.$order['do_id']); ?>"><button class="btn btn-sm btn-primary">Approve</button></a>-->
                                     <?php } ?>    
                                    <!--<button class="btn btn-sm btn-info">Edit</button>-->
                                        
                               <?php } ?>     
                            <?php } ?>
                            <?php  if (in_array(4, $this->role)) { ?>    
                                <a href="<?php echo site_url('productions/details_delivery_order/'.$order['do_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                            <?php } ?>
                           <?php  if (in_array(5, $this->role)) { ?>     
                                <!--<button onclick="delete_row('<?php echo site_url('delivery_orders/delete_delivery_order/'.$order['do_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>-->
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
<script>
$('#search_by').change(function(){
    $('#datatable_filter :input').focus().val($(this).val()).keyup();
})
</script>