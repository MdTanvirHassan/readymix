<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(7, 21, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
        <?php       
            require_once(__DIR__ .'/../../rm_receive_header.php');
        ?>
    </div>
    <div class="right_content">
    <?php  //if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('raw_materials/return_receive/add_return_receive'); ?>" class="btn btn-sm btn-primary">ADD RETURN RECEIVE</a>
    <?php //} ?>    
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Return No</th>
                <th class="col-lg-1">Receive Date</th>
                <th class="col-lg-1">Memo No</th>
                <th class="col-lg-1">Memo Date</th>
                <th class="col-lg-1">Receive Status</th>
               
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($mrrs)) {
                foreach ($mrrs as $mrr) { ?>
                    <tr>
                        <td>
                            <?php echo $mrr['return_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($mrr['mrr_date'])) echo date('d-m-Y',strtotime($mrr['mrr_date'])); ?>
                        </td>
                     
                       
                        <td>
                            <?php echo $mrr['memo_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($mrr['memo_date'])) echo date('d-m-Y',strtotime($mrr['memo_date'])); ?>
                        </td>
                        
                          <td>
                              <?php if($mrr['mrr_status']=="Pending"){ ?>
                                    <span style="color:#CE9208;"> <?php echo $mrr['mrr_status']; ?></span>
                              <?php }else{ ?>
                                    <span style=""> <?php echo $mrr['mrr_status']; ?></span>
                              <?php } ?>
                        </td>

                        <td>
                            
                                <?php if($mrr['mrr_status']=="Pending" ){ ?>
                                    <a href="<?php echo site_url('raw_materials/return_receive/edit_return_receive/'.$mrr['mrr_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php }else{ ?>  
                                       
                                <?php } ?>
                           
                                      
                                <a href="<?php echo site_url('raw_materials/return_receive/details_return_receive/'.$mrr['mrr_id']); ?>"><button class="btn btn-sm btn-primary">Details</button></a>
                         
                            
                                <?php if($mrr['mrr_status']=="Pending" ){ ?>
                                     <button onclick="delete_row('<?php echo site_url('raw_materials/return_receive/delete_return_receive/'.$mrr['mrr_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                 <?php }else{ ?>  
                                     <!--   <button class="btn btn-sm btn-danger">Delete</button>-->
                                <?php } ?>
                              
                                
                               
                                  <?php if($mrr['mrr_status']=="Pending" ){ ?>
                                    <a href="<?php echo site_url('raw_materials/return_receive/confirmReceive/'.$mrr['mrr_id']); ?>"><button class="btn btn-sm btn-success">Receive</button></a>
                                  <?php } ?> 
                               
                                
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
</div>

