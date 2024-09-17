<style>
    .btn-sm{
        padding:5px 5px !important;
    }
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(1, 4, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
<div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Search result</h3>
            </div>
        </div>
    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 <div class="x_content">
         
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Item Group</th>
                <th class="col-lg-1">Item Code</th>
                <th class="col-lg-1">Item Name</th>
                <th class="col-lg-1">Item Type</th>
                 <th class="col-lg-1">Current Stock </th>
                <th class="col-lg-1">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($data)) {
                foreach ($items as $item) { ?>
                    <tr>
                        <td>
        <?php echo $item['item_group']; ?>
                        </td>
                        <td>
        <?php echo $item['item_code']; ?>
                        </td>
                        <td>
        <?php echo $item['item_name']; ?>
                        </td>
                        <td>
        <?php echo $item['item_type']; ?>
                        </td>
                        <td>
                            <?php echo $item['stock_amount']; ?>
                        </td>

                       
                    </tr>
    <?php } ?>
                    <tr>
                        <td style="text-align: center;font-weight: bold;  " colspan="6">NO DATA FOUND</td>
                    </tr>            
<?php } ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
</div>
</div>

