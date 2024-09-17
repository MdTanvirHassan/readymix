<style>
    .btn-sm{
        padding:3px 3px !important;
    }
    #empTable_wrapper{
        
    padding: 10px;
    box-shadow: 0px 0px 7px 4px #ddd;

    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $user_type = $this->session->userdata('user_type');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(18,103, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    
 <div class="os-tabs-w menu-shad">
        <?php       
            require_once(__DIR__ .'/../../rm_setup_header.php');
        ?>
</div>
    
<div class="right_content">
     <?php $this->role = checkUserPermission(18, 103, $userData);  if (in_array(2, $this->role)) { ?>
      
        <a href="<?php echo site_url('raw_materials/rm_setup/add_rm'); ?>" class="btn btn-sm btn-primary">ADD ITEM</a>
        
     <?php } ?>    
   <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th>Item Code</th>
                <th>Item Name</th>
                
                <th>Group</th>
               
                
                <th>Unit of Measurement</th> 
                <th>Store Location</th>
                <th class="col-md-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($items)) {
                foreach ($items as $item) { ?>
                    <tr>
                         <td>
                               <?php if(!empty($item['item_code'])) echo $item['item_code']; ?>
                        </td>
                        
                        <td>
                               <?php if(!empty($item['item_name'])) echo $item['item_name']; ?>
                        </td>
                        
                       
                        <td>
                                <?php if(!empty($item['item_category'])) echo $item['item_category']; ?>
                        </td>
                                           
                       
                        
                         
                        <td>
                                 <?php if(!empty($item['meas_unit'])) echo $item['meas_unit']; ?>
                        </td>
                        
                        <td>
                                 <?php if(!empty($item['store_location'])) echo $item['store_location']; ?>
                        </td>
                       

                        <td>
                            <?php  if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('raw_materials/rm_setup/edit_rm/'.$item['id']); ?>"><button class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></button></a>
                            <?php } ?>
                            <?php  if (in_array(4, $this->role)) { ?>    
                                <a href="<?php echo site_url('raw_materials/rm_setup/details_rm/'.$item['id']); ?>"><button class="btn btn-sm btn-success" title="Details"><i class="fa fa-eye"></i></button></a>
                            <?php } ?> 
                            <?php  if (in_array(5, $this->role)) { ?>    
                                <button onclick="delete_row('<?php echo site_url('raw_materials/rm_setup/delete_rm/'.$item['id']); ?>')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
                            <?php } ?>    
                        </td>
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>

    
</div>
</div>

<script type="text/javascript">
     $(document).ready(function(){
        $('#empTable').DataTable({
         "order": [[ 0, "asc" ]],
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'ajax': {
             'url':'<?=base_url()?>backend/general_store/empList'
          },
          'columns': [
             { data: 'id' },
             { data: 'item_code' },
             { data: 'item_name' },
             { data: 'groups' },
             { data: 'c_name' },
             { data: 'item_type' },
             { data: 'mu_id' },
             { data: 'store_location' },
             { data: 'action' },
          ]
        });
     });
     </script>
