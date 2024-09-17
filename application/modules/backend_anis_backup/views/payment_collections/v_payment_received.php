<style>
    .btn-sm{
        padding:2px 5px !important;
    }
    
    
    
    /*   For table header fixed  */ 
        .tableFixHead{ overflow-y: auto; height: 100px; }
        .tableFixHead thead th { position: sticky; top: 0; }

        /* Just common table stuff. Really. */
        table  { border-collapse: collapse; width: 100%; }
        th, td { padding: 8px 16px; }
        th     { background:#eee; }
    
    
</style>
<?php
    $user_id = $this->session->userdata('user_id');
    $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
    $this->role = checkUserPermission(7, 27, $userData);
 ?>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Payment Received List</h3>
            </div>
        </div>
        
         <div class="row">
                        <div id="remover" class="col-md-6 col-md-offset-3">
                            <form id="item-form" action="<?php site_url('backend/payment_received'); ?>" method="post" autocomplete="off">
                            <div class="row">
                                    <div style="margin-top: 15px;" class="col-md-10 col-md-offset-1">
                                      <select  class="form-control e1" placeholder="Select Customer" id="customer_id" name="customer_id" onchange="javascript:project_info();" >
                                          <option value="" >Select customer</option>
                                        <?php foreach($customers as $customer){ ?>
                                           <option <?php if($customer_id==$customer['id']) echo 'selected'; ?>  value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option> 
                                        <?php } ?>    
                                         

                                     </select>

                                 </div>
                         </div><!--End Row-->  
                            
                           
                         <div class="row">
                                    <div style="margin-top: 15px;" class="col-md-10 col-md-offset-1">
                                      <select  class="form-control e1" placeholder="Select Type" id="product_id" name="category_id" >
                                        <option value="" >Product Type</option>
                                        <?php foreach($product_categories as $product_category){ ?>
                                           <option <?php if($category_id==$product_category['category_id']) echo 'selected'; ?>  value="<?php echo $product_category['category_id'] ?>"><?php echo $product_category['category_name'] ?></option> 
                                        <?php } ?>    
                                         

                                     </select>

                                 </div>
                        </div><!--End Row-->    
                            
                            
                            
                        <div class="row">
                                    <div style="margin-top: 15px;" class="col-md-10 col-md-offset-1">
                                      <select  class="form-control e1" placeholder="Select Type" id="collection_method" name="collection_method" >
                                        <option value="" >Select Mode</option>
                                        <option <?php if($collection_method=="Pdc") echo "Selected"; ?> value="Pdc">Cheque/Pdc</option>
                                        <option <?php if($collection_method=="Bg") echo "Selected"; ?> value="Bg">Bg</option> 
                                        <option <?php if($collection_method=="Lc") echo "Selected"; ?> value="Lc">Lc</option> 
                                        <option <?php if($collection_method=="Po") echo "Selected"; ?> value="Po" >Po</option> 
                                        <option <?php if($collection_method=="O.Cash") echo "Selected"; ?> value="O.Cash" >O.Cash</option>
                                        <option <?php if($collection_method=="Cash") echo "Selected"; ?> value="Cash" >Cash</option> 

                                     </select>

                                 </div>
                         </div><!--End Row-->        
                            
                            
                            
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
<!--                                    <input style="padding: 6px 40px;" type="submit" class="btn btn-primary" value="SEARCH"/>
                                    <input style="padding: 6px 40px;" type="button" id="print_div" class="btn btn-primary" value="PRINT"/>-->
                                     <input id="form-submit" style="padding: 6px 40px;" type="submit" class="btn btn-primary" value="SEARCH"/>
                                   <!--  <a  href="javascript:" class="btn btn-info" onclick="submitForm('excel')">EXCEL</a>-->
                                    
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
        
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
  <div class="tableFixHead" id="removeRow" style="width: 100%;height:500px;overflow-x: scroll;margin-bottom: 20px;"> 
    <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Honor Date</th>
                <!--<th class="col-lg-1">Order No.</th>-->
                <th class="col-lg-1">Customer Name</th>
                <th class="col-lg-1">MRR. No.</th>
                <th class="col-lg-1">Product Type</th>
                <th class="col-lg-1">Mode of Payment</th>
                <th class="col-lg-1">Pdc/Lc/Bg No</th>
                <th class="col-lg-1">Amount</th> 
                
                <th class="col-lg-1">R. Status</th>
                <th class="col-lg-1">Remark</th>
               
            </tr>
        </thead>
        <tbody>
            <?php if (count($collections)) {
                foreach ($collections as $collection) { ?>
                    <tr>
                     <?php if($collection['collection_method']=="Cash" || $collection['collection_method']=="O.Cash"){ ?>   
                        <td>
                            <?php if(!empty($collection['receive_date'])) echo date('d-m-Y',strtotime($collection['receive_date'])); ?>
                        </td>
                     <?php }else{ ?>
                        <td>
                            <?php if(!empty($collection['realization_date'])) echo date('d-m-Y',strtotime($collection['realization_date'])); ?>
                        </td>    
                     <?php } ?>   
<!--                        <td>
                            <?php if(!empty($collection['order_no'])) echo $collection['order_no']; ?>
                        </td>-->
                         <td>
                             <?php if(!empty($collection['c_name'])) echo $collection['c_name']; ?>
                        </td>
                        
                        <td>
                             <?php if(!empty($collection['mrr_no'])) echo $collection['mrr_no']; ?>
                        </td>
                        
                        <td>
                             <?php if(!empty($collection['category_name'])) echo $collection['category_name']; ?>
                        </td>
                        
                        
                        <td>
                            <?php if(!empty($collection['collection_method'])) echo $collection['collection_method']; ?>
                        </td>
                        <?php if($collection['collection_method']=="Cash" || $collection['collection_method']=="O.Cash"){ ?> 
                            <td>
                                 <?php //if(!empty($collection['no'])) echo $collection['no']; ?>
                            </td>
                        <?php }else{ ?>
                            <td>
                                 <?php if(!empty($collection['no'])) echo $collection['no']; ?>
                            </td>
                        <?php } ?>   
                        
                        <td style="text-align: right;">
                            <?php if(!empty($collection['amount'])) echo number_format($collection['amount'],2); ?>
                        </td>
                       
                        <td>
                            <?php if(!empty($collection['payment_status'])) echo $collection['payment_status']; ?>
                        </td>
                        <td>
                             <?php if(!empty($collection['remark'])) echo $collection['remark']; ?>
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
</div>
