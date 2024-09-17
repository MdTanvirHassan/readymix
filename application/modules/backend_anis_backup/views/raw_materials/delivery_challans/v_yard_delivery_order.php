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
    
<div class="os-tabs-w menu-shad">
        <?php require_once(__DIR__ .'/../../trading_challan_header.php'); ?>
</div>
    
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Delivery Order  List</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                       
                      <div class="row">
                        <div id="remover" class="col-md-6 col-md-offset-3">
                            <form id="item-form" action="<?php site_url('backend/raw_materials/delivery_challans/deliveryOrder/Yard'); ?>" method="post">
                            <div class="row">
                                    <div style="margin-top: 15px;" class="col-md-10 col-md-offset-1">
                                      <select  class="form-control e1" placeholder="Select Customer" id="customer_id" name="customer_id" onchange="javascript:project_info();" >
                                          <option value="all" >Select customer</option>
                                          
                                        <?php foreach($customers as $customer){ ?>
                                           <option <?php if($customer_id==$customer['id']) echo 'selected'; ?>  value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option> 
                                        <?php } ?>    
                                         

                                     </select>

                                 </div>
                            </div><!--End Row-->  
                                                    
                          
                            <div class="clearfix"></div>
                            <div style="margin-top: 15px;" class="col-md-12">

                                <div class="col-md-8 col-md-offset-3">
<!--                                    <input style="padding: 6px 40px;" type="submit" class="btn btn-primary" value="SEARCH"/>
                                    <input style="padding: 6px 40px;" type="button" id="print_div" class="btn btn-primary" value="PRINT"/>-->
                                    <input id="form-submit" style="padding: 6px 40px;backgroud-color:#337ab7 !important;" type="submit" class="btn btn-primary" value="SEARCH"/>
                                   <!--  <a  href="javascript:" class="btn btn-info" onclick="submitForm('excel')">EXCEL</a>-->
                                    
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                        
                        
                        
    
  <!--  <a href="<?php echo site_url('sales_report/allDeliveryOrder'); ?>" class="btn btn-sm btn-success">REPORT</a>-->
    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <!--
                <th class="col-lg-1">Created Date</th>
                -->
                <th class="col-lg-1">Delivery Date</th>
                <th class="col-lg-1">Delivery No.</th>
                
                <th class="col-lg-1">Customer Name</th>
               
                
                <th class="col-lg-1">Product Name</th>
                <th class="col-lg-1">M.Unit</th>
                <th class="col-lg-1">Quantity</th>
               
                <th class="col-lg-1">Do Status</th>
                <th class="col-lg-1">Transport</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($delivery_orders)) {
                foreach ($delivery_orders as $order) { ?>
                    <tr>
                        <!--
                        <td >
                            <?php if(!empty($order['created_date'])) echo date('d-m-Y',strtotime($order['created_date'])); ?>
                        </td>
                        -->
                        
                        <td>
                            <?php if(!empty($order['delivery_order_date'])) echo date('d-m-Y',strtotime($order['delivery_order_date'])); ?>
                        </td>
                        <td style="text-align: left">
                            <?php if(!empty($order['delivery_no'])) echo $order['delivery_no']; ?>
                        </td>
                       
                        <td style="text-align: left">
                            <?php if(!empty($order['c_name'])) echo $order['c_name']; ?>
                        </td>
                        
                        <td style="text-align: left">
                            <?php if(!empty($order['item_name'])) echo $order['item_name']; ?>
                        </td>
                        
                        <td>
                            <?php if(!empty($order['meas_unit'])) echo $order['meas_unit']; ?>
                        </td>
                        
                        <td style="text-align:right;">
                            <?php if(!empty($order['quantity'])) echo number_format($order['quantity'],2); ?>
                        </td>
                        
                        
                        
                        <td style="text-align: left">
                                <?php if(!empty($order['do_status'])) echo $order['do_status']; ?>
                        </td>
                        
                        <td style="text-align: left">
                                <?php 
                                if(!empty($order['transport_cost'])){ 
                                    echo "Kmix Transport"; 
                                }else{
                                    echo "Customer"; 
                                }
                                ?>
                        </td>
                       

                        <td class="col-lg-2" >
                            
                            <?php  if (in_array(4, $this->role)) { ?>    
                                <a href="<?php echo site_url('raw_materials/delivery_challans/details_yard_delivery_order/'.$order['do_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
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
<script type="text/javascript">
    function close_do(url){
    bootbox.confirm({
        message: "<div class='boot-header'>YOU ARE ABOUT TO CLOSE A DELIVERY ODER ! ARE YOU SURE ?</div><div class='boot-text'></div>",
        buttons: {
            confirm: {
                label: 'YES',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'CANCEL',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true)
                location.href = url;

        }
    });
}


function open_do(url){
    bootbox.confirm({
        message: "<div class='boot-header'>YOU ARE ABOUT TO OPEN A CLOSED DELIVERY ODER ! ARE YOU SURE ?</div><div class='boot-text'></div>",
        buttons: {
            confirm: {
                label: 'YES',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'CANCEL',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true)
                location.href = url;

        }
    });
}
</script>
<script>
function changeProduct(){
    var prod = $("input[name='prod']:checked").val();
    if(prod!='all')
        $('#datatable_filter').find('input').val(prod).keyup()
        else    
        $('#datatable_filter').find('input').val('').keyup();    
}
</script>