<style>
    .btn-sm{
        padding:2px 5px !important;
    }
</style>
<?php
    $user_id =$this->session->userdata('user_id');
    $userData =$this->m_common->get_row_array('users',array('id' =>$user_id),'*');
   // $this->role = checkUserPermission(7, 30, $userData);
    
 ?>




<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<!--    <h2 style="text-align:center; "> Budget List</h2>
    <hr>-->
<div class="os-tabs-w menu-shad">
        <?php require_once(__DIR__ .'/../production_header.php'); ?>
</div>
<div class="right_content">
     <?php  
     $this->role =checkUserPermission(13, 62, $userData);
     
     if (in_array(2, $this->role)) { ?>
        <a href="<?php echo site_url('delivery_challans/add_delivery_challan'); ?>" class="btn btn-sm btn-primary">ADD CHALLAN</a>
     <?php } ?>       
     <table id='empTable' class='display'>
        <thead>
            <tr>
                <th>SL</th>
                <th style="width:100px;">Date</th>
                <th>Challan No.</th>
                <th>Manual Challan No.</th>
                <th>Delivery Order No.</th>
                <th>Customer Name</th>
                <th>Project Name</th>
                <th>Status</th>
                <th style="width:150px;">Action</th>
                
            </tr>
            
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>
</div>



 

<div class="modal fade" id="challan_cancel"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="leave_form" action="<?php echo site_url('delivery_challans/cancel_delivery_challan'); ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Return Challan</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">

                        <fieldset>
                            <div style="border:1px solid #cccccc;padding:13px 7px 1px 7px;margin-bottom:5px;">
                           
                                                                                                                    
                                <div class="form-group" id="casual_leave_assign" >
                                    <label style="float:left;width:150px;">Remark: </label>
                                    <input type="hidden" style="width:300px;" class="form-control " placeholder="" id="challan_id" name="challan_id" type="text" value="">
                                  <!--  <input required style="width:300px;" class="form-control " placeholder="" id="remark" name="remark" type="text" value=""> -->
                                    <textarea required class="form-controll" rows="5" cols="5" id="remark" name="remark"></textarea>
                                </div>
                                
                                
                               

                            </div>

                    </div>

                    </fieldset>

                </div>  
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="submit" class="btn btn-primary">
                </div>
        </div>

        </form>
    </div>
</div>  


<script type="text/javascript">
    function canCel(id){
        $('#challan_id').val(id);  
        $('#challan_cancel').modal('show');
    }
</script>


<script type="text/javascript">
     $(document).ready(function(){
        $('#empTable').DataTable({
         "order": [[ 0, "DESC" ]],
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'ajax': {
             'url':'<?=base_url()?>backend/delivery_challans/delv_challan_list'
          },
          'columns': [
             { data: 'dc_id' },
             { data: 'delivery_challan_date' },
             { data: 'dc_no' },
             { data: 'manual_dc_no' },
             { data: 'delivery_no' },
             { data: 'c_name' },
             { data: 'project_name' },
             { data: 'status' },
             { data: 'action' },
          ]
        });
     });
     </script>