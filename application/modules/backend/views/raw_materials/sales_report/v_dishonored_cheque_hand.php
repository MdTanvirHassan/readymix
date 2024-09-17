<div class="right_col" role="main" style="padding: 0px;" >
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title clearfix">
                  Dishonored Cheque/PO/BG
                </h4>
            </div>

            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <style>
                    th{text-align: center;}
                    .datatable-scroll {
                        overflow-x: auto;
                        overflow-y: visible;
                    }
                    .usetwentyfour{
                        z-index:10000;
                    }
                    .absent{
                        float: right;
                        height: 38px;
                        line-height: 4;
                        margin: -5px 0 0;
                        position: relative;
                        text-align: center;
                        width: 100%;
                    }
                    .present{
                        float: right;
                        height: 38px;
                        line-height: 4;
                        margin: -5px 0 0;
                        position: relative;
                        text-align: center;
                        width: 100%;
                    }
                    #test {
                        position:relative;
                    }
                    .address_bar{
                        background-color: #c7caca;
                        border: 2px solid #000000;
                        border-radius: 5px;
                        margin: 10px 0;
                        padding: 10px;
                        text-align: center;
                    }
                    @media print {
                        .non-printable, .fancybox-outer { display: none; }
                        .printable, #printDiv { 
                            display: block; 
                            font-size: 26pt;
                        }
                    }
                    th,td{text-align: center;}
                    .right{
                        border-right:0px !important;
                    }
                    .left{
                        border-left:0px !important;
                    }
                    .top{
                        border-top:0px !important;
                    }
                    
                    
                    /*   For table header fixed  */ 
                    .tableFixHead{ overflow-y: auto; height: 100px; }
                    .tableFixHead thead th { position: sticky; top: 0; }

                    /* Just common table stuff. Really. */
                    table  { border-collapse: collapse; width: 100%; }
                    th, td { padding: 8px 16px; }
                    th     { background:#eee; }
                    
                    
                </style>


                <div class="panel-body">
                    <a href="<?php echo site_url('backend/sales_report'); ?>" class="btn btn-sm btn-primary">GO BACK</a>
                    <!--
                    <a style="float:right;" href="<?php echo site_url('backend/sales_report/realizedChequeExcel/true'); ?>" class="btn btn-sm btn-info">EXCEL</a>
                    <a style="float:right;" href="<?php echo site_url('backend/sales_report/realizedCheque/true'); ?>" class="btn btn-sm btn-primary">PRINT</a>
                    -->
                  
                     <div class="row">
                            <div id="remover" class="col-md-6 col-md-offset-3">
                                <form id="item-form" action="<?php site_url('backend/sales_report/dishonoredChequeAtHand'); ?>" method="post">
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
                                       <!-- <option <?php if($collection_method=="O.Cash") echo "Selected"; ?> value="O.Cash" >O.Cash</option>-->
                                         

                                     </select>

                                 </div>
                            </div><!--End Row-->        
                                


                              <div class="row">  

                                    <div style="margin-top: 15px;" class="col-md-5 col-md-offset-1">
                                        <input  type="text" name="from_date" class="form-control datepicker" value="<?php if(!empty($f_date)) echo $f_date; ?>" placeholder="From Date"/>
                                    </div>

                                     <div style="margin-top: 15px;" class="col-md-5 ">
                                        <input  type="text" name="to_date" class="form-control datepicker" value="<?php if(!empty($to_date)) echo $to_date; ?>" placeholder="To Date"/>
                                    </div>
                              </div><!--End Row-->    



                                <div class="clearfix"></div>
                                <div style="margin-top: 15px;" class="col-md-12">

                                    <div class="col-md-8 col-md-offset-3">
                <!--                                    <input style="padding: 6px 40px;" type="submit" class="btn btn-primary" value="SEARCH"/>
                                        <input style="padding: 6px 40px;" type="button" id="print_div" class="btn btn-primary" value="PRINT"/>-->
                                         <input id="form-submit" style="padding: 6px 40px;background-color:#337ab7 !important;" type="submit"  class="btn btn-primary" value="SEARCH"/>
                                         <a  href="javascript:" class="btn btn-info" onclick="submitForm('excel')">EXCEL</a>
                                         <a  href="javascript:" class="btn btn-primary" onclick="submitForm('print')">PRINT</a>

                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                   
                        <div id="header_div" style="margin-top: 15px;text-align: center;" class="col-md-10 col-md-offset-1">
                            <h3>Karim Asphalt & Ready Mix Ltd.</h3>
                            <h4>Dishonored Cheque/PO/BG At Hand</h4>
                             

                        </div>
                   
                      
                        
             

                 
                    <div class="tableFixHead" id="removeRow" style="width: 100%;height:500px;overflow-x: scroll;margin-bottom: 20px;">
                        <!--                <div class="pull-right"><button class="btn btn-danger" id="delete">Delete Selected</button></div>-->
                        <table style="width:100%;font-size: 14px;" id="player_table" class="table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                               <thead>

                                        <tr>  
                                            <th>SL</th>                             
                                            <th>Customer Name</th>
                                            <th>Product Type</th>
                                            <th>Collection Method</th>
                                            <th>Pdc/Lc/Bg No.</th>
                                            <th>Disonor Date 1</th>
                                            <th>Disonor Date 2</th>
                                            <th>Dishonor Date 3</th>
                                            <th>Value</th>
                                           
                                            

                                        </tr>
                                                               
                                </thead> 
                                <tbody>
                                    <?php if(!empty($orders)){ 
                                        $total=0;
                                        $i=0;
                                        foreach($orders as $order){
                                            $i++;
                                            $total=$total+$order['amount'];
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td> 
                                           
                                            <td><?php if(!empty($order['c_name'])) echo $order['c_name']; ?></td>                                          
                                            <td><?php if(!empty($order['category_name'])) echo $order['category_name']; ?></td>
                                            <td><?php if(!empty($order['collection_method'])) echo $order['collection_method']; ?></td>
                                            <td><?php if(!empty($order['no'])) echo $order['no']; ?></td> 
                                            <td><?php if(!empty($order['dishonored1'])) echo date('d-m-Y',strtotime($order['dishonored1'])); ?></td>
                                            <td><?php if(!empty($order['dishonored2'])) echo date('d-m-Y',strtotime($order['dishonored2'])); ?></td>
                                            <td><?php if(!empty($order['dishonored3'])) echo date('d-m-Y',strtotime($order['dishonored3'])); ?></td>
                                          
                                            <td style="text-align: right;"><?php if(!empty($order['amount'])) echo number_format($order['amount'],2); ?></td>
                                           
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="8" style="text-align: right;">Total</td>
                                            <td style="text-align: right;"><?php echo number_format($total,2); ?></td>
                                        </tr>
                                    <?php }else{ ?>  
                                         <tr>
                                            <td colspan="11" style="text-align: center;">No Data Found</td>
                                        </tr>
                                    <?php } ?>    
                                </tbody>
                        </table>
                    </div>
                </div>   
                    <style type="text/css" media="print">

                        

                        @media print {
                            .non-printable, .fancybox-outer { display: none; }
                            .printable, #printDiv { 
                                display: block; 
                                font-size: 26pt;
                            }
                            #player_table {page-break-after: avoid;}
                        }

                        @media print {
                            #player_table {page-break-after: avoid;display:block;visibility:visible; height:100%;}
                            body, html, #wrapper {
                                margin-top:0%;
                                display:block;
                                height:100%;
                                visibility:visible;
                            }
                        }
                    </style>
                </div>
            </div>
        </div>
   
    <script>
        function submitForm(type){
            if(type=='print')
                var url ='<?php echo site_url(); ?>backend/sales_report/dishonoredChequeAtHand/true';
            else
                var url = '<?php echo site_url(); ?>backend/sales_report/dishonoredChequeAtHandExcel';
                $('#item-form').attr('action', url);
                $('#form-submit').click();
                $('#item-form').attr('action', '<?php echo site_url('backend/sales_report/dishonoredChequeAtHand'); ?>');
       } 
    </script>       