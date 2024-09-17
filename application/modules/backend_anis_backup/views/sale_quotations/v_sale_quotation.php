<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(7, 25, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
   
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Sale Quotation  List</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
     <?php  if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('sale_quotations/add_quotation'); ?>" class="btn btn-sm btn-primary">ADD QUOTATION</a>
     <?php } ?>
        <select id="search_by" style="width: 200px;margin:0 auto;margin-top: -30px" class="form-control">
                            <option value="">Search by Status</option>
                            <option>Pending</option>
                            <option>Generated Sales Order</option>
                            <option value=''>All</option>
                        </select>
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
                            <?php  if (in_array(4, $this->role)) { ?>
                                <a href="<?php echo site_url('sale_quotations/details_quotation/'.$quotation['q_id']); ?>"><button class="btn btn-sm btn-success">View</button></a>
                                <a href="<?php echo site_url('sale_quotations/offer_quotation/'.$quotation['q_id'].'/print'); ?>"><button class="btn btn-sm btn-primary">Offer Letter</button></a>
                            <?php } ?>
                            <?php if($quotation['status']=="Pending"){ ?>
                                <?php  if (in_array(3, $this->role)) { ?>
                                    <a href="<?php echo site_url('sale_quotations/edit_quotation/'.$quotation['q_id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                                <?php } ?>
                                <?php  if (in_array(5, $this->role)) { ?>    
                                    <button onclick="delete_row('<?php echo site_url('sale_quotations/delete_quotation/'.$quotation['q_id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                                <?php } ?>
                            <?php }else{ ?>
                                <?php  if (in_array(3, $this->role)) { ?>    
                                    <button class="btn btn-sm btn-info">Edit</button>
                                <?php } ?>
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
$('#search_by').change(function(){
    $('#datatable_filter :input').focus().val($(this).val()).keyup();
})
</script>