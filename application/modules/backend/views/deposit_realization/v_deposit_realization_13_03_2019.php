<style>
    .btn-sm{
        padding:5px 5px !important;
    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <h2 style="text-align:center; ">Deposit List</h2>
    <hr>
    <a href="<?php echo site_url('deposit_realization/add_deposit'); ?>" class="btn btn-sm btn-primary">ADD DEPOSIT</a>
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Instrmnt</th>
                <th class="col-lg-1">No.</th>
                <th class="col-lg-1">Deposit Date</th>
                <th class="col-lg-1">Bank</th>
                <th class="col-lg-1">Branch</th>
                <th class="col-lg-1">Amount</th>
                <th class="col-lg-1">Status</th>
                <th class="col-lg-1">Realization Date</th>
                <th class="col-lg-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($deposits)) {
                foreach ($deposits as $deposit) { ?>
                    <tr>
                       <td>
                            <?php if(!empty($deposit['collection_method'])) echo $deposit['collection_method']; ?>
                        </td>
                        
                        <td>
                            <?php if(!empty($deposit['no'])) echo $deposit['no']; ?>
                        </td>
                        
                         <td>
                            <?php if(!empty($deposit['deposit_date'])) echo date('d-m-Y',strtotime($deposit['deposit_date'])); ?>
                        </td>
                        
                         <td>
                           <?php if(!empty($deposit['b_short_name'])) echo $deposit['b_short_name']; ?>
                        </td>
                       <td>
                           <?php if(!empty($deposit['branch_name'])) echo $deposit['branch_name']; ?>
                        </td>
                        <td>
                            <?php if(!empty($deposit['amount'])) echo $deposit['amount']; ?>
                        </td>
                         <td>
                            <?php if(!empty($deposit['realization_status'])) echo $deposit['realization_status']; ?>
                        </td>
                        <td>
                            <?php if(!empty($deposit['realization_date'])) echo date('d-m-Y',strtotime($deposit['realization_date'])); ?>
                        </td>
                       

                        <td>
                            <a href="<?php echo site_url('deposit_realization/edit_deposit/'.$deposit['id']); ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                            <button onclick="realization('<?php echo $deposit['id']; ?>')" class="btn btn-sm btn-primary">Realization</button>
                            <button onclick="delete_row('<?php echo site_url('deposit_realization/delete_deposit/'.$deposit['id']); ?>')" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button id="close1" type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Realization Date</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" id="deposit_id" class="form-control datepicker" value="" />
            <input type="text" id="realization_date" class="form-control datepicker" placeholder="Date" />
        </div>
        <div class="modal-footer">
            <button onclick="realizationAction()" class="btn btn-sm btn-primary">Submit</button>
          <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<script type="text/javascript">
    function realization(id){
        $('#deposit_id').val(id);
        $('#myModal').modal('show');
    }
    $('#close').click(function(){
        $('#deposit_id').val('');
        $('#realization_date').val('');
    });
    $('#close1').click(function(){
        $('#deposit_id').val('');
        $('#realization_date').val('');
    });
    function realizationAction(){
        var deposit_id=$('#deposit_id').val();
        var realization_date=$('#realization_date').val();
       
         $.ajax({
                url: '<?php echo site_url('deposit_realization/realization'); ?>',
                data:{'deposit_id':deposit_id,'realization_date':realization_date},
                method: 'POST',
                dataType: 'json',
                success: function (msg) { 
                    if(msg.status=='success'){
                        $('#deposit_id').val('');
                        $('#realization_date').val('');
                        $('#myModal').modal('hide');
                        location.reload(true);
                    }    
                }

        })
    }
</script>