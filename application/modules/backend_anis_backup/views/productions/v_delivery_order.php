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
                            <option>Delivered</option>
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

    <table id='empTable' class='display'>
        <thead>
            <tr>
                
                <th style="width:100px;">Date</th>
                <th>Delivery No.</th>
                <th>Order No.</th>
                <th>Customer Name</th>
                <th>Project Name</th>
                <th>Challan Status</th>
                <th>Do Status</th>
                <th style="width:150px;">Action</th>
                
            </tr>
            
        </thead>
        <tbody>
            
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
    
    $('#empTable_filter :input').focus().val($(this).val()).keyup();
})
</script>

<script type="text/javascript">
     $(document).ready(function(){
        $('#empTable').DataTable({
         "order": [[ 0, "DESC" ]],
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'ajax': {
             'url':'<?=base_url()?>backend/productions/delivery_orders_list'
          },
          'columns': [
             { data: 'delivery_order_date' },
             { data: 'delivery_no' },
             { data: 'order_no' },
             { data: 'c_name' },
             { data: 'project_name' },
             { data: 'status' },
             { data: 'do_status' },
             { data: 'action' },
          ]
        });
     });
     </script>