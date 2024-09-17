<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; "> Asset Requisition List</h2>
    <hr>
    <a href="<?php echo site_url('general_store/add_asset_requisition'); ?>" class="btn btn-sm btn-primary">ADD REQUISITION</a>
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Requisition Number</th>
               
                <th class="col-lg-1">Department</th>
               
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1">Status</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($asset_requisitions)) {
                foreach ($asset_requisitions as $asset_requisition) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($asset_requisition['requisition_no'])) echo $asset_requisition['requisition_no']; ?>
                        </td>
                       
                        <td>
                            <?php  if(!empty($asset_requisition['dep_description'])) echo $asset_requisition['dep_description']; ?>
                        </td>
                       
                         
                        <td>
                            <?php  if(!empty($asset_requisition['requisition_date'])) echo date('d-m-Y',strtotime($asset_requisition['requisition_date'])); ?>
                        </td>
                        <td>
                             <?php if($asset_requisition['status']=="pending"){ ?>
                                    <span style="color:#CE9208;"> <?php echo $asset_requisition['status']; ?></span>
                              <?php }else{ ?>
                                    <span style=""> <?php echo $asset_requisition['status']; ?></span>
                              <?php } ?>
                            <?php 
                            //echo $ipo_material['indent_process_status'];
                            //echo $ipo_material['budgeted_status'];
                            ?>
                        </td>

                        <td>
                            <?php if($asset_requisition['status']=="pending"){ ?>
                                <a href="<?php echo site_url('general_store/edit_asset_requisition/'.$asset_requisition['requisition_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php }else{?>
                                <button class="btn btn-sm btn-info">Edit</button>
                            <?php } ?>     
                            <a href="<?php echo site_url('general_store/details_asset_requisition/'.$asset_requisition['requisition_id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                             <?php if($asset_requisition['status']=="pending"){ ?>
                                    <button onclick="delete_row('<?php echo site_url('general_store/delete_asset_requisition/'.$asset_requisition['requisition_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                             <?php }else{ ?>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                             <?php } ?>
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
