<?php
$user_id = $this->session->userdata('user_id');
$user_type = $this->session->userdata('user_type');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(1, 2, $userData);
?>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<div class="os-tabs-w menu-shad">
  <?php require_once(__DIR__ .'/../logistics_ware_house_header.php'); ?>       
</div>

<div class="right_content">
    <?php if($user_type == 1){?>
    <div class="col-md-4 col-md-offset-4">
        <!--    
            <select id="project" class="form-control">
            <option value="All">All</option>
            <?php foreach($projects as $row){?>
            <option <?php if($row['d_id']== $branch_id) echo 'selected';?> value="<?php echo $row['d_id']?>"><?php echo $row['short_name']?></option>
            <?php }?>
        </select> 
        -->
    </div>
    <?php }?>
        <table id="datatable" class="table table-striped table-bordered table-hover no-footer">
            <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Create Date</th>
                    <th>Transfer date</th>
                    
                    <th>From Project</th>
                    <th>Item Name</th>
                    <th>Transfer Qty.</th>
                    <th>Receive Qty.</th>
                    
                    <th>Status</th>
                    
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($transfer)) {
                    $i=1;
                    foreach ($transfer as $row) {
                        ?>
                        <tr>
                            <td>
        <?php echo $i; ?>
                            </td>
                            
                             <td>
                                <?php if (!empty($row['create_date'])) echo date('d-m-Y',strtotime($row['create_date'])); ?>
                            </td>
                            <td>
                                <?php if (!empty($row['transfer_date']))echo date('d-m-Y',strtotime($row['transfer_date'])); ?>
                            </td>
                            <td>
        <?php if (!empty($row['short_name'])) echo $row['short_name']; ?>
        
                            </td>
                            <td>
        <?php if (!empty($row['item_name'])) echo $row['item_name']; ?>
                            </td>
                            <td id="tq_<?php echo $row['transfer_id'];?>">
        <?php if (!empty($row['transfer_quantity'])) echo $row['transfer_quantity']; ?>
                            </td>
                            
                            <td id="tq_<?php echo $row['transfer_id'];?>">
        <?php if (!empty($row['received_quantity'])) echo $row['received_quantity']; ?>
                            </td>
                            
                            
                            <td>
                                <?php 
                                    echo $row['receive_status'];

                                ?>
                            </td>
                            
                    <!--        
                            <td>
        <?php //if (!empty($department[0]['short_name'])) echo $department[0]['short_name']; ?>
                            </td>
                    -->
                           

                            <td>
                                <?php if($user_type == 1){
                                   if ($row['receive_status']== 'Pending') {  
                                    ?>
                                        <a href="Javascrip:"><button onclick="showReceived('<?php echo $row['transfer_id'] ?>')" class="btn btn-sm btn-info" title="Receive" >Receive</button></a>
                                   <?php } ?>
                                    
                              <?php }else{?>
                                    <?php  if ($row['receive_status']== 'Pending') {   ?>
                                          <a href="Javascrip:"><button onclick="showReceived('<?php echo $row['transfer_id'] ?>')" class="btn btn-sm btn-info" title="Receive" >Receive</button></a>
                                    <?php } ?>
                             <?php } ?>      
                               
                            </td>
                        </tr>
                        
                    <?php  $i++; }
                    
                }
                ?>
            </tbody>
        </table> 
        
         <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="<?php echo site_url('general_store/receivedTransferItem/')?>" method="post">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Received</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class='form-group row' >
       <label for="title" class="control-label" style="margin-left: 10px;">
       Received Quantity<span class="required">*</span> :
        </label>
        <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-recycle"></i></span>
        <input required="" onkeyup="currentqueantityminus()"  id="received_quantity" class="form-control" name="received_quantity" type="text" value="">  
        <input type="hidden" id="transferID" name="transferID">
        <input type="hidden" id="total_quantity_hidden" name="total_quantity_hidden">
    </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div> 

    </div>
</div>
<script>
$('#project').change(function(){
    
    var branchID = $(this).val();
    
    var data = {'branchID': branchID}
    $.ajax({
            url: '<?php echo site_url('backend/general_store/fromTransferSearch'); ?>',
            data: data,
            method: 'POST',
            dataType: 'html',
              success: function(data) {
                    
                    window.location.href = data;
                }
            });
})


function showReceived(id){
     var tq = Number($('#tq_'+id).text());
    $('#transferID').val(id);
    $('#total_quantity_hidden').val(tq);
$('#exampleModal').modal();
}

function currentqueantityminus(){
        var conquantity = Number($("#received_quantity").val());
        var totalquantity = Number($("#total_quantity").val());
        var totalquantityhide = Number($("#total_quantity_hidden").val());
        
        if(conquantity > 0){
         
         if(conquantity > totalquantityhide){
            alert('Must be less than from total stock');
            $("#received_quantity").val('');
            return;
        }
     }else{
         alert('please input positive value and greater than 0');
         $('#amount').val('');
         $("#received_quantity").val('');
         
       return false;
       
     }
    }

</script>