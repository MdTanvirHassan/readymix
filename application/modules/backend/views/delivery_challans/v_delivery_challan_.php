<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(7, 30, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; ">Delivery Challan List</h2>
    <hr>-->
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Delivery Challan List</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
     <?php  if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('delivery_challans/add_delivery_challan'); ?>" class="btn btn-sm btn-primary">ADD CHALLAN</a>
     <?php } ?>    
    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Challan No.</th>
                <th class="col-lg-1">Delivery Order No.</th>
                <th class="col-lg-1">Customer Name</th>
                <th class="col-lg-1">Project Name</th>
                <th class="col-lg-1">Amount</th>
                <th class="col-lg-1">Status</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($delivery_challans)) {
                foreach ($delivery_challans as $challan) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($challan['delivery_challan_date'])) echo date('d-m-Y',strtotime($challan['delivery_challan_date'])); ?>
                        </td>
                        <td>
                            <?php if(!empty($challan['dc_no'])) echo $challan['dc_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($challan['delivery_no'])) echo $challan['delivery_no']; ?>
                        </td>
                        <td>
                              <?php if(!empty($challan['c_name'])) echo $challan['c_name']; ?>
                        </td>
                        <td>
                              <?php if(!empty($challan['project_name'])) echo $challan['project_name']; ?>
                        </td>
                        <td>
                              <?php if(!empty($challan['total_amount'])) echo $challan['total_amount']; ?>
                        </td>
                        <td>
                            <?php if(!empty($challan['status'])) echo $challan['status']; ?>
                        </td>
                       

                        <td>
                            <?php if($challan['status']=="Pending"){ ?>
                                     <?php  if (in_array(4, $this->role)) { ?>
                                        <a href="<?php echo site_url('delivery_challans/details_delivery_challan/'.$challan['dc_id']); ?>"><button class="btn btn-sm btn-success">View</button></a>
                                     <?php } ?>
                                     <?php  if (in_array(3, $this->role)) { ?>
                                        <a href="<?php echo site_url('delivery_challans/edit_delivery_challan/'.$challan['dc_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                     <?php } ?>
                                     <?php  if (in_array(2, $this->role)) { ?>   
                                        <a href="<?php echo site_url('delivery_challans/approve_delivery_challan/'.$challan['dc_id']); ?>"><button class="btn btn-sm btn-primary">Approve</button></a>
                                     <?php } ?>
                                     <?php  if (in_array(5, $this->role)) { ?>
                                        <button onclick="delete_row('<?php echo site_url('delivery_challans/delete_delivery_challan/'.$challan['dc_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                     <?php } ?>   
                            <?php }else{ ?>
                                         <?php  if (in_array(4, $this->role)) { ?>
                                            <a href="<?php echo site_url('delivery_challans/details_delivery_challan/'.$challan['dc_id']); ?>"><button class="btn btn-sm btn-success">View</button></a>
                                         <?php } ?>  
                                         <?php  if (in_array(3, $this->role)) { ?>    
                                                <button class="btn btn-sm btn-info">Edit</button>
                                         <?php } ?>
                                        <?php  if (in_array(5, $this->role)) { ?>       
                                            <button class="btn btn-sm btn-danger">Delete</button>
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

