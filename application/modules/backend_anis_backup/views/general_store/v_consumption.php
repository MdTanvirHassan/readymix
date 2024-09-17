<?php
$user_id = $this->session->userdata('user_id');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
$this->role = checkUserPermission(3, 43, $userData);
?>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">

 <div class="os-tabs-w menu-shad">
       <?php require_once(__DIR__ .'/../logistics_ware_house_header.php'); ?>   
 </div>   
    
    

<div class="right_content" style="margin-top:65px;">
    
     <div class="row">
            <div id="remover" class="col-md-6 col-md-offset-3">
                <form id="item-form" action="<?php site_url('backend/general_store/consumption'); ?>" method="post" autocomplete="off">
                
                

              <div class="row">  

                    <div style="margin-top: 15px;" class="col-md-5 col-md-offset-1">
                        <input  type="text" name="from_date" class="form-control datepicker" value="<?php if(!empty($f_date)) echo date('d-m-Y',strtotime($f_date)); ?>" placeholder="From Date"/>
                    </div>

                     <div style="margin-top: 15px;" class="col-md-5 ">
                        <input  type="text" name="to_date" class="form-control datepicker" value="<?php if(!empty($to_date)) echo date('d-m-Y',strtotime($to_date)); ?>" placeholder="To Date"/>
                    </div>
              </div><!--End Row-->    



                <div class="clearfix"></div>
                <div style="margin-top: 15px;" class="col-md-12">

                    <div class="col-md-8 col-md-offset-3">
                                  
                         <input id="form-submit" style="padding: 6px 40px;background-color:#337ab7 !important;" type="submit" class="btn btn-primary" value="SEARCH"/>
                      

                    </div>
                </div>
                <div class="clearfix"></div>
                </form>
            </div>
        </div>
    
        <!--         <h2 style="text-align:center; ">Supplier/Customer's Information List</h2>
            <hr>-->
        <?php if (in_array(2, $this->role)) { ?>
            <a href="<?php echo site_url('general_store/add_consumption'); ?>" class="btn btn-sm btn-primary">ADD CONSUMPTION</a>
        <?php } ?>    
        <table id="datatable" class="table table-striped table-bordered table-hover no-footer">
            <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Consumption date</th>
                    <th>Item Name</th>
                    <th>Brand Name</th>
                    <th>Department</th>
                    <th>Cost Center</th>
                    <th>Consumption Quantity</th>
                    <th>Remarks</th>
                    
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($item_consumption)) {
                    $i=1;
                    foreach ($item_consumption as $row) {
                        ?>
                        <tr>
                            <td>
        <?php echo $i; ?>
                            </td>
                            
                             <td>
        <?php if (!empty($row['consumption_date']))echo date('d-m-Y',strtotime($row['consumption_date'])); ?>
                            </td>
                            
                            <td>
        <?php if (!empty($row['item_name'])) echo $row['item_name']; ?>
                            </td>
                            
                             <td>
                                <?php if (!empty($row['brand_name'])) echo $row['brand_name']; ?>
                            </td>
                            
                            
                            <td>
                                <?php if (!empty($row['dept_name'])) echo $row['dept_name']; ?>
                            </td>
                            
                            
                            <td>
                                <?php if (!empty($row['c_c_name'])) echo $row['c_c_name']; ?>
                            </td>
                            <td>
        <?php if (!empty($row['consumption_quantity'])) echo $row['consumption_quantity']; ?>
                            </td>
                           
                            <td>
        <?php if (!empty($row['remarks'])) echo $row['remarks']; ?>
                            </td>
                    
                           

                            <td>
                                <?php if($row['status'] == 'Pending'){ ?>
                                <?php if (in_array(3, $this->role)) { ?>
                                <a href="<?php echo site_url('general_store/edit_consumption/' . $row['consumption_id']); ?>"><button class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></button></a>
                                <?php } ?>
                                
                                <?php if (in_array(4, $this->role)) { ?>
                                    <a href="<?php echo site_url('general_store/details_consumption/' . $row['consumption_id']); ?>"><button class="btn btn-sm btn-info" title="Details"><i class="fa fa-eye"></i></button></a>
                                <?php } ?>
                                
                                <?php if (in_array(5, $this->role)) { ?>   
                                <button onclick="delete_row('<?php echo site_url('general_store/delete_consumption/' . $row['consumption_id']); ?>')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
        <?php } ?>              <a href="<?php echo site_url('general_store/approved_consumption/' . $row['consumption_id']); ?>"><button class="btn btn-sm btn-info" title="Edit">Approve</button></a>
                                <?php }else{?>
                                    <a href="<?php echo site_url('general_store/details_consumption/' . $row['consumption_id']); ?>"><button class="btn btn-sm btn-info" title="Details"><i class="fa fa-eye"></i></button></a>
                                <?php } ?>
                            </td>
                        </tr>
                        
                    <?php  $i++; }
                    
                }
                ?>
            </tbody>
        </table>   
    </div>
</div>
