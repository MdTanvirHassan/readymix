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
                            <form id="item-form" action="<?php site_url('backend/delivery_orders/index'); ?>" method="post">
                            <div class="row">
                                    <div style="margin-top: 15px;" class="col-md-10 col-md-offset-1">
                                      <select  class="form-control e1" placeholder="Select Customer" id="customer_id" name="customer_id" onchange="javascript:project_info();" >
                                            <option value="" >Select customer</option>
                                          
                                            <?php foreach($customers as $customer){ ?>
                                               <option <?php if($customer_id===$customer['id']) echo 'selected'; ?>  value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option> 
                                            <?php } ?>    
                                         

                                     </select>

                                 </div>
                            </div><!--End Row-->  
                            
                            
                            <div class="row">
                                    <div style="margin-top: 15px;" class="col-md-10 col-md-offset-1">
                                      <select  class="form-control e1" placeholder="Select Status" id="collection_method" name="closing_status" >
                                        <option value="" >Closing Status</option>
                                        <option <?php if($closing_status=="Open") echo "Selected"; ?> value="Open">Open</option>
                                        <option <?php if($closing_status=="Closed") echo "Selected"; ?> value="Closed">Closed</option> 
                                        
                                         

                                     </select>

                                 </div>
                         </div><!--End Row-->      
                            
                          <div class="row">  
                            
                                <div style="margin-top: 15px;" class="col-md-5 col-md-offset-1">
                                    <input  type="text" name="from_date" class="form-control datepicker" value="<?php if(!empty($f_date)) echo $f_date; ?>" placeholder="From Date"/>
                                </div>

                                 <div style="margin-top: 15px;" class="col-md-5 ">
                                    <input  type="text" name="to_date" class="form-control datepicker" value="<?php if(!empty($to_date)) echo $to_date; ?>" placeholder="To Date"/>
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
                        
                        
                        
    <?php  if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('delivery_orders/add_delivery_order'); ?>" class="btn btn-sm btn-primary">ADD ORDER</a>
    <?php } ?>   
    <a href="<?php echo site_url('sales_report/allDeliveryOrder'); ?>" class="btn btn-sm btn-success">REPORT</a>
    <div style="text-align:center;">
        <label style="margin-right:10px" for="readymix"><input type="radio" onchange="changeProduct()" name="prod" id="readymix" value="Readymix">Readymix</label>
        <label style="margin-right:10px" for="asphalt"><input type="radio" onchange="changeProduct()" name="prod" id="asphalt" value="Asphalt">Asphalt</label>
        <label for="all"><input type="radio" onchange="changeProduct()" name="prod" id="all" value="all">All</label>
    </div>       
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <!--
                <th class="col-lg-1">Created Date</th>
                -->
                <th class="col-lg-1">Delivery Date</th>
                <th class="col-lg-1">Delivery No.</th>
                <th class="col-lg-1">Sales Order No.</th>
                <th class="col-lg-1">Customer Name</th>
                <th class="col-lg-1">Project Name</th>
                
                <th class="col-lg-1">Product Type</th>
                <th class="col-lg-1">Unit</th>
                <th class="col-lg-1">Quantity</th>
                <!--
                <th class="col-lg-1">Rate</th>
                <th class="col-lg-1">Amount</th>
                -->
               <!-- <th class="col-lg-1">Challan Status</th>-->
                <th class="col-lg-1">Do Status</th>
                <th class="col-lg-1">Force Closing Status</th>
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
                            <?php if(!empty($order['order_no'])) echo $order['order_no']; ?>
                        </td>
                        <td style="text-align: left">
                            <?php if(!empty($order['c_name'])) echo $order['c_name']; ?>
                        </td>
                        <td style="text-align: left">
                            <?php if(!empty($order['project_name'])) echo $order['project_name']; ?>
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
                        <!--
                        <td style="text-align:right;">
                            <?php if(!empty($order['unit_price'])) echo $order['unit_price']; ?>
                        </td>
                        
                        <td style="text-align:right;">
                            <?php if(!empty($order['total_amount'])) echo number_format($order['total_amount'],2); ?>
                        </td>
                        -->
                      <!--  
                        <td style="text-align: left">
                                <?php if(!empty($order['status'])) echo $order['status']; ?>
                        </td>
                      -->
                        
                        <td style="text-align: left">
                                <?php if(!empty($order['do_status'])) echo $order['do_status']; ?>
                        </td>
                        
                        <td style="text-align: left">
                                <?php if(!empty($order['closing_status'])) echo $order['closing_status']; ?>
                        </td>
                       

                        <td class="col-lg-2" >
                            <?php  if (in_array(3, $this->role)) { ?>
                               <?php if($order['do_status']=="Pending"){ ?>
                                    <a href="<?php echo site_url('delivery_orders/approve_delivery_order/'.$order['do_id']); ?>"><button class="btn btn-sm btn-primary">Approve</button></a>
                                 <!--   <a href="<?php echo site_url('delivery_orders/reject_delivery_order/'.$order['do_id']); ?>"><button class="btn btn-sm btn-warning">Reject</button></a>-->
                                    <a href="<?php echo site_url('delivery_orders/edit_delivery_order/'.$order['do_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                    
                               <?php }else{ ?> 
                                    <?php if($order['do_status']=="Approved"){ ?>        
                                         <!--   <a href="<?php echo site_url('delivery_orders/reject_delivery_order/'.$order['do_id']); ?>"><button class="btn btn-sm btn-warning">Reject</button></a>-->
                                     <?php }else if($order['do_status']=="Rejected"){ ?>
                                            <a href="<?php echo site_url('delivery_orders/approve_delivery_order/'.$order['do_id']); ?>"><button class="btn btn-sm btn-primary">Approve</button></a>
                                     <?php } ?>   
                                       <?php if($user_id==3){ ?>      
                                            <a href="<?php echo site_url('delivery_orders/edit_delivery_order/'.$order['do_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                       <?php }else{ ?>                                      
                                           <!-- <button class="btn btn-sm btn-info">Edit</button> -->
                                       <?php } ?>     
                                        
                               <?php } ?>     
                            <?php } ?>
                            <?php  if (in_array(4, $this->role)) { ?>    
                                <a href="<?php echo site_url('delivery_orders/details_delivery_order/'.$order['do_id']); ?>"><button class="btn btn-sm btn-primary">View</button></a>
                            <?php } ?>
                           <?php if (in_array(5, $this->role)){ ?>   
                                
                                <button onclick="delete_row('<?php echo site_url('delivery_orders/delete_delivery_order/'.$order['do_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                           <?php } ?>   
                                
                          <?php if(in_array(6,$this->role)){?>   
                               <?php if($order['closing_status']!="Closed"){ ?>       
                                    <button onclick="close_do('<?php echo site_url('delivery_orders/close_delivery_order/'.$order['do_id']."/".$customer_id); ?>')" class="btn btn-sm btn-danger" style="background-color: yellow;color:black;">Close</button>
                               <?php }else if($order['closing_status']=="Closed"){ ?>  
                                    <button onclick="open_do('<?php echo site_url('delivery_orders/open_delivery_order/'.$order['do_id']); ?>')" class="btn btn-sm btn-success">Open</button>
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