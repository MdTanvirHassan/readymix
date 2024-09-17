<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Asset Issue Return Receive  List</h2>
    <hr>
    <a href="<?php echo site_url('general_store/add_asset_issue_receive'); ?>" class="btn btn-sm btn-primary">ADD ISSUE RECEIVE</a>
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Issue Receive No</th>
                <th class="col-lg-1">Receive Date</th>
                <th class="col-lg-1">Status</th>
               
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($issue_receives)) {
                foreach ($issue_receives as $issue_receive) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($issue_receive['a_ir_no'])) echo $issue_receive['a_ir_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($issue_receive['a_ir_date'])) echo date('d-m-Y',strtotime($issue_receive['a_ir_date'])); ?>
                        </td>
                        <td>
                            <?php if(!empty($issue_receive['a_ir_status'])) echo $issue_receive['a_ir_status']; ?>
                        </td>
                      
                        

                        <td>
                            <?php if($issue_receive['a_ir_status']=="pending"){ ?>
                                <a href="<?php echo site_url('general_store/edit_asset_issue_receive/'.$issue_receive['a_ir_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php }else{ ?> 
                                <button class="btn btn-sm btn-info">Edit</button>
                            <?php } ?>     
                            <a href="<?php echo site_url('general_store/details_asset_issue_receive/'.$issue_receive['a_ir_id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                            <?php if($issue_receive['a_ir_status']=="pending"){ ?>
                                <button onclick="delete_row('<?php echo site_url('general_store/delete_asset_issue_receive/'.$issue_receive['a_ir_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                            <?php }else { ?>
                                <button  class="btn btn-sm btn-danger">Delete</button>
                            <?php } ?>    
                             <?php if($issue_receive['a_ir_status']=="pending" ){ ?>
                                <a href="<?php echo site_url('general_store/receive_asset_issue_receive/'.$issue_receive['a_ir_id']); ?>"><button class="btn btn-sm btn-success">Receive</button></a>
                            <?php } ?>
                                 
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>

