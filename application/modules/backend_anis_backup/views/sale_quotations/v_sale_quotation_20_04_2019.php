<style>
    .btn-sm{
        padding:5px 5px !important;
    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Quotation  List</h2>
    <hr>
    <a href="<?php echo site_url('sale_quotations/add_quotation'); ?>" class="btn btn-sm btn-primary">ADD QUOTATION</a>
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1"> Quotation No.</th>
                <th class="col-lg-1">Customer Name</th>
                <th class="col-lg-1">Project Name</th>
                <th class="col-lg-1">Amount</th>
                <th class="col-lg-1">Status</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($quotations)) {
                foreach ($quotations as $quotation) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($quotation['quotation_date'])) echo date('d-m-Y',strtotime($quotation['quotation_date'])); ?>
                        </td>
                        <td>
        <?php if(!empty($quotation['reference_no'])) echo $quotation['reference_no']; ?>
                        </td>
                        <td>
                             <?php if(!empty($quotation['c_name'])) echo $quotation['c_name']; ?>
                        </td>
                        <td>
                             <?php if(!empty($quotation['project_name'])) echo $quotation['project_name']; ?>
                        </td>
                        <td>
        <?php if(!empty($quotation['total_amount'])) echo $quotation['total_amount']; ?>
                        </td>
                        <td>
        <?php if(!empty($quotation['status'])) echo $quotation['status']; ?>
                        </td>
                       

                        <td>
                            <a href="<?php echo site_url('sale_quotations/details_quotation/'.$quotation['q_id']); ?>"><button class="btn btn-sm btn-success">View</button></a>
                            <a href="<?php echo site_url('sale_quotations/offer_quotation/'.$quotation['q_id']); ?>"><button class="btn btn-sm btn-primary">Offer Letter</button></a>
                            <?php if($quotation['status']=="Pending"){ ?>
                                <a href="<?php echo site_url('sale_quotations/edit_quotation/'.$quotation['q_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <button onclick="delete_row('<?php echo site_url('sale_quotations/delete_quotation/'.$quotation['q_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                            <?php }else{ ?>
                                <button class="btn btn-sm btn-info">Edit</button>
                                <button  class="btn btn-sm btn-danger">Delete</button>
                            <?php } ?>    
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
