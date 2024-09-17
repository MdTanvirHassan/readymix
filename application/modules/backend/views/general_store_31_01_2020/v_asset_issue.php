<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Asset Issue Info List</h2>
    <hr>
    <a href="<?php echo site_url('general_store/add_asset_issue'); ?>" class="btn btn-sm btn-primary">ADD ISSUE</a>
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-2">Issue No</th>
                <th class="col-lg-2">Issue Date</th>
                <th class="col-lg-2">Status</th>
                
               
               
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($asset_issues)) {
                foreach ($asset_issues as $asset_issue) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($asset_issue['a_issue_no'])) echo $asset_issue['a_issue_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($asset_issue['a_issue_date'])) echo date('d-m-Y',strtotime($asset_issue['a_issue_date'])); ?>
                        </td>
                        <td>
                            <?php if(!empty($asset_issue['a_issue_status'])) echo $asset_issue['a_issue_status']; ?>
                        </td>
                       
                        
                        

                        <td>
                            <?php if($asset_issue['a_issue_status']=="issued"){ ?>
                                <a href="<?php echo site_url('general_store/edit_asset_issue/'.$asset_issue['a_issue_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <?php }else{ ?>
                                <button class="btn btn-sm btn-info">Edit</button>
                            <?php } ?>   
                            <a href="<?php echo site_url('general_store/details_asset_issue/'.$asset_issue['a_issue_id']); ?>"><button class="btn btn-sm btn-success">Details</button></a>
                            <?php if($asset_issue['a_issue_status']=="issued"){ ?>
                                <button onclick="delete_row('<?php echo site_url('general_store/delete_asset_issue/'.$asset_issue['a_issue_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                            <?php }else{ ?>
                                <button  class="btn btn-sm btn-danger">Delete</button>
                            <?php } ?>       
                            <!--
                            <?php if($asset_issue['issue_status']=="applied" || $asset_issue['issue_status']=="rejected" ){ ?>
                                <a href="<?php echo site_url('general_store/issued_material_indent/'.$asset_issue['a_issue_id']); ?>"><button class="btn btn-sm btn-success">Issue</button></a>
                            <?php }else{ ?>
                                 <a href="<?php echo site_url('general_store/reject_material_indent/'.$asset_issue['a_issue_id']); ?>"><button class="btn btn-sm btn-warning">Reject</button></a>
                            <?php } ?>
                            -->
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>


