<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(7, 26, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Sale Order List</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
    <?php  if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('sale_orders/add_sale_order'); ?>" class="btn btn-sm btn-primary">ADD ORDER</a>
    <?php } ?> 
    <a href="<?php echo site_url('sales_report/allSalesOrder'); ?>" class="btn btn-sm btn-success">REPORT</a>   
    <div style="text-align:center;">
        <label style="margin-right:10px" for="readymix"><input type="radio" onchange="changeProduct()" name="prod" id="readymix" value="Readymix">Readymix</label>
        <label style="margin-right:10px" for="asphalt"><input type="radio" onchange="changeProduct()" name="prod" id="asphalt" value="Asphalt">Asphalt</label>
        <label for="all"><input type="radio" onchange="changeProduct()" name="prod" id="all" value="all">All</label>
    </div>
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Order No.</th>
              <!--  <th class="col-lg-1">Quotation No.</th>-->
                <th class="col-lg-1">Customer Name</th>
                <th class="col-lg-1">Project Name</th>
                <th class="col-lg-1">Product Type</th>
                <th class="col-lg-1">Unit</th>
                <th class="col-lg-1">Quantity</th>
                <th class="col-lg-1">Rate</th>
                <th class="col-lg-1">Amount</th>
                <th class="col-lg-1">Do.Status</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($sale_orders)) {
                foreach ($sale_orders as $order) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($order['sale_order_date'])) echo date('d-m-Y',strtotime($order['sale_order_date'])); ?>
                        </td>
                        <td>
                            <?php if(!empty($order['order_no'])) echo $order['order_no']; ?>
                        </td>
                        <!--
                        <td>
                            <?php if(!empty($order['reference_no'])) echo $order['reference_no']; ?>
                        </td>
                        -->
                        <td>
                            <?php if(!empty($order['c_name'])) echo $order['c_name']; ?>
                        </td>
                        <td>
                            <?php if(!empty($order['p_name'])) echo $order['p_name']; else echo $order['project_name']; ?>
                        </td>
                        <td>
                            <?php if(!empty($order['category_name'])) echo $order['category_name']; ?>
                        </td>
                        <td>
                            <?php if(!empty($order['mu_name'])) echo $order['mu_name']; ?>
                        </td>
                        
                        <td style="text-align:right;">
                            <?php if(!empty($order['quantity'])) echo number_format($order['quantity'],2); ?>
                        </td>
                        <td style="text-align:right;">
                            <?php if(!empty($order['unit_price'])) echo $order['unit_price']; ?>
                        </td>
                        
                        <td style="text-align:right;">
        <?php if(!empty($order['total_amount'])) echo number_format($order['total_amount'],2); ?>
                        </td>
                        <td>
                                <?php
                                //if(!empty($order['status'])) echo $order['status']; 
                                 if(!empty($order['delivery_order_status'])) echo $order['delivery_order_status']; 
                                ?>
                            
                        </td>
                       

                        <td>
                            <?php if($order['delivery_order_status']=="Pending"){ ?>
                                <?php  if (in_array(3, $this->role)) { ?>
                                    <a href="<?php echo site_url('sale_orders/edit_sale_order/'.$order['o_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php } ?>    
                            <?php }else{ ?>
                                <?php  if (in_array(3, $this->role)) { ?>  
                                     <?php if($user_id==3){ ?>
                                        <a href="<?php echo site_url('sale_orders/edit_sale_order/'.$order['o_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                        
                                     <?php }else{ ?> 
                                        <button class="btn btn-sm btn-info">Edit</button>
                                     <?php } ?>   
                                <?php } ?>    
                            <?php } ?> 
                           <?php  if (in_array(4, $this->role)) { ?>         
                                <a href="<?php echo site_url('sale_orders/details_sale_order/'.$order['o_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                           <?php } ?>
                            <?php if($order['delivery_order_status']=="Pending"){ ?>
                                <?php  if (in_array(5, $this->role)) { ?>
                                    <button onclick="delete_row('<?php echo site_url('sale_orders/delete_sale_order/'.$order['o_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                <?php } ?>    
                             <?php }else{ ?> 
                                    <?php  if (in_array(5, $this->role)) { ?>
                                        <button  class="btn btn-sm btn-danger">Delete</button>
                                    <?php } ?> 
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
function changeProduct(){
    var prod = $("input[name='prod']:checked").val();
    if(prod!='all')
        $('#datatable_filter').find('input').val(prod).keyup()
        else    
        $('#datatable_filter').find('input').val('').keyup();    
}
</script>