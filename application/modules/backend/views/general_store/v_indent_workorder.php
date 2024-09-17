<style>
                    .form-control{
                      height:auto;  
                    }
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
                    label {
	            font-weight: bold;
                    }             
                    @media print {
                        .non-printable, .fancybox-outer { display: none; }
                        .printable, #printDiv { 
                            display: block; 
                            font-size: 26pt;
                        }
                    }
                    th,td{text-align: center;}
                </style>


<div class="right_col" role="main" style="padding: 0px;" >
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title clearfix">
                  Indent Details
                </h4>
                <a style="margin-top: -21px;"  href="<?php echo site_url('backend/general_store/indentList'); ?>" class="btn btn-sm btn-primary pull-right">GO BACK</a>
            </div>

            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                
                <?php
                    $current_month_year=date('m-Y');
                    $first_date=date('d-m-Y',strtotime(date('Y-m-01')));
                    $last_date=date('d-m-Y',strtotime(date('Y-m-t')));
                ?>

                <div class="panel-body">
                    
                    
                            <form id="item-form" action="<?php site_url('backend/report/mateialWorkOrderReport'); ?>" method="post">
                           
                            
                            </form>
                      <div class="clearfix"></div> 
                      
                      
                      
                     <div class="row" id="printablediv">
                   
                        <div id="header_div" style="margin-top: 15px;text-align: center;" class="col-md-10 col-md-offset-1">
                            
                            <h4>Budget</h4>
                            

                        </div>

                 
                    
                        
                         <table style="width:100%;" id="player_table" class="table table-striped  table-bordered   responsive">
                           
                                        <thead>
                                            
                                            <tr>
                                                <th>Total Indent Qty</th>
                                                <th colspan="10" style="text-align: left;"><?php echo $indent_info[0]['indent_qty']; ?></th>
                                            </tr>
                                            
                                            <tr>
                                                <th>SL.</th>
                                                <th>Budget Date</th>
                                                <th>Indent No.</th> 
                                                <th>Budget No.</th> 
                                                <th>Budget Type</th>
                                                <th>Material Name</th>
                                              <!--  <th>Brand Name</th>-->
                                                <th>MU.</th>
                                                
                                                <th>Budget Qnty</th>                                                
                                                <th>Recive Qnty</th>
                                                <th>Remaining Qnty</th>
                                                
                                                <th>Budget Value</th>                                                
                                                <th>Recive Value</th>
                                                <th>Remaining Value</th>
                                              
                                                


                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i=0;
                                            $test=$i;
                                              if(!empty($indents)){
                                                  $net_total_value=0;
                                                foreach($indents as $req){ 
                                                    $net_total_value=$net_total_value+$req['budget_value'];
                                                    $net_receive_value=$net_receive_value+$req['receive_value'];
                                                    $net_remaining_value=$net_remaining_value+$req['remaining_value'];
                                                $i++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo date('d-m-Y',strtotime($req['b_date'])); ?></td>
                                                        <td><?php echo $req['indent_no']; ?></td>
                                                        <td><?php echo $req['b_no']; ?></td>
                                                        <td><?php echo $req['b_type']; ?></td>
                                                        
                                                        <td><?php echo $req['item_name']; ?></td>
                                                <!--        <td><?php echo $req['brand_name']; ?></td>-->
                                                        <td><?php echo $req['meas_unit']; ?></td>
                                                       
                                                        <td style="text-align:right;"><?php echo number_format($req['budget_qty']); ?></td>
                                                       
                                                        <td style="text-align:right;"><?php 
                                                           if($req['receive_quantity']>0){
                                                                echo number_format($req['receive_quantity']);
                                                           }else{
                                                               echo "-";
                                                           }
                                                        
                                                        ?>
                                                        </td>
                                                        <td style="text-align:right;"><?php 
                                                        if($req['remaining_quantity']>0){
                                                            echo number_format($req['remaining_quantity']);
                                                        }else{
                                                            echo "-";
                                                        }
                                                       
                                                        ?>
                                                        </td>
                                                        
                                                        
                                                        
                                                        <td style="text-align:right;"><?php echo number_format($req['budget_value']); ?></td>
                                                        <td style="text-align:right;"><?php 
                                                           if($req['receive_value']>0){
                                                                echo number_format($req['receive_value']);
                                                           }else{
                                                               echo "-";
                                                           }
                                                        
                                                        ?>
                                                        </td>
                                                        <td style="text-align:right;"><?php 
                                                        //if($req['remaining_value']>0){
                                                            echo number_format($req['remaining_value']);
                                                      //  }else{
                                                      //      echo "-";
                                                       // }
                                                       
                                                        ?>
                                                        </td>
                                                       

                                                    </tr>
                                                    
                                        <?php    }  ?> 
                                                    <tr>
                                                        <td colspan="9" style="text-align: right;"><b>Total</b></td>
                                                        <td style="text-align: right;"><b><?php echo number_format($net_total_value,2); ?></b></td>
                                                        <td style="text-align: right;"><b><?php echo number_format($net_receive_value,2); ?></b></td>
                                                        <td style="text-align: right;"><b><?php echo number_format($net_remaining_value,2); ?></b></td>
                                                    </tr>
                                                        
                                       <?php     
                                             }else{
                                       
                                            
                                            ?> 
                                                    <tr>
                                                        <td colspan="12">
                                                            No Data Found
                                                        </td>
                                                    </tr>   
                                             <?php } ?>        
                                        </tbody>

                                 
                        </table>
                        
                    </div>  
                      
                      
                      
                      
                      
                     <div class="row" id="printablediv">
                   
                        <div id="header_div" style="margin-top: 15px;text-align: center;" class="col-md-10 col-md-offset-1">
                            
                            <h4>Purchase Order</h4>
                            

                        </div>

                 
                    
                        
                        <table style="width:100%;" id="player_table" class="table table-striped  table-bordered   responsive">
                           
                                        <thead>
                                            <tr>
                                                <th>Total Indent Qty</th>
                                                <th colspan="10" style="text-align: left;"><?php echo $indent_info[0]['indent_qty']; ?></th>
                                            </tr>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Date</th>
                                                <th>Requisition No.</th>
                                                <th>Order No.</th>
                                                <th>Order Type</th>
                                                <th>Project Name</th>
                                                <th>Supplier Name</th>
                                                <th>Material Name</th>
                                                <th>MU.</th>
                                                <!--
                                                <th>Size</th>
                                                <th>Size Unit</th>
                                                -->
                                                <th>Order Qnty</th>
                                                
                                                <th>Recive Qnty</th>
                                                <th>Remaining Qnty</th>
                                              
                                                


                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i=0;
                                            $net_receive_qty=0;
                                            $net_remaining_qty=0;
                                            $net_order_qty=0;
                                              if(!empty($purchase_orders)){
                                                foreach($purchase_orders as $req){ 
                                                   $net_order_qty=$net_order_qty+$req['quantity']; 
                                                   $net_receive_qty=$net_receive_qty+$req['receive_quantity']; 
                                                   $net_remaining_qty=$net_remaining_qty+$req['remaining_quantity']; 
                                                $i++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo date('d-m-Y',strtotime($req['purchase_order_date'])); ?></td>
                                                        <td><?php echo $req['indent_no']; ?></td>
                                                        <td><?php echo $req['order_no']; ?></td>
                                                        <?php if($req['order_from']=="Moneny Indent"){ ?>
                                                          <td><?php echo "Cash"; ?></td>
                                                        <?php } else{ ?>
                                                          <td><?php echo "Credit"; ?></td>
                                                        <?php } ?> 
                                                        <td style="text-align:left;"><?php echo $req['dep_description']; ?></td>
                                                        <td style="text-align:left;"><?php echo $req['SUP_NAME']; ?></td>
                                                        <td><?php echo $req['item_name']; ?></td>
                                                        <td><?php echo $req['meas_unit']; ?></td>
                                                        <!--
                                                            <td><?php echo $req['item_size']; ?></td>
                                                            <td><?php echo $req['unit_name']; ?></td>
                                                        -->
                                                        <td style="text-align:right;"><?php echo number_format($req['quantity']); ?></td>
                                                       
                                                        <td style="text-align:right;"><?php 
                                                           if($req['receive_quantity']>0){
                                                                echo number_format($req['receive_quantity']);
                                                           }else{
                                                               echo "-";
                                                           }
                                                        //if(!empty($req['unit_price'])) echo $req['unit_price']; 
                                                        ?>
                                                        </td>
                                                        <td style="text-align:right;"><?php 
                                                        if($req['remaining_quantity']>0){
                                                            echo number_format($req['remaining_quantity']);
                                                        }else{
                                                            echo "-";
                                                        }
                                                        //if(!empty($req['amount'])) echo $req['amount']; 
                                                        ?>
                                                        </td>
                                                       

                                                    </tr> 
                                                <?php } ?>
                                                    
                                               <?php if(!empty($item_id)) ?>    
                                                    <tr>
                                                        <td colspan="8"><b>Total</b></td>
                                                        <td style="text-align:right;"><b><?php echo number_format($net_order_qty,2) ?></b></td>
                                                        <td style="text-align:right;"><b><?php echo number_format($net_receive_qty,2) ?></b></td>
                                                        <td style="text-align:right;"><b><?php echo number_format($net_remaining_qty,2) ?></b></td>
                                                    </tr>  
                                                <?php ?>    
                                       <?php     
                                             }else{
                                       
                                            
                                            ?> 
                                                    <tr>
                                                        <td colspan="12">
                                                            No Data Found
                                                        </td>
                                                    </tr>   
                                             <?php } ?>        
                                        </tbody>

                                 
                        </table>
                        
                    </div>  
                      
                      
                   
                      
                   <div class="row" id="printablediv">
                   
                        <div id="header_div" style="margin-top: 15px;text-align: center;" class="col-md-10 col-md-offset-1">
                            
                            <h4>Spot Purchase</h4>
                            

                        </div>

                 
                    
                        
                        <table style="width:100%;" id="player_table" class="table table-striped  table-bordered   responsive">
                           
                                        <thead>
                                            <tr>
                                                <th>Total Indent Qty</th>
                                                <th colspan="10" style="text-align: left;"><?php echo $indent_info[0]['indent_qty']; ?></th>
                                            </tr>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Date</th>
                                                <th>Requisition No.</th>
                                                <th>Purchase No.</th>
                                                <th>Project Name</th>
                                                <th>Supplier Name</th>
                                                <th>Material Name</th>
                                                <th>MU.</th>
                                                <!--
                                                <th>Size</th>
                                                <th>Size Unit</th>
                                                -->
                                                <th>Order Qnty</th>
                                                
                                                <th>Recive Qnty</th>
                                                <th>Remaining Qnty</th>
                                              
                                                


                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i=0;
                                            $net_receive_qty=0;
                                            $net_remaining_qty=0;
                                            $net_order_qty=0;
                                              if(!empty($spot_purchases)){
                                                foreach($spot_purchases as $req){ 
                                                   $net_order_qty=$net_order_qty+$req['quantity']; 
                                                   $net_receive_qty=$net_receive_qty+$req['receive_quantity']; 
                                                   $net_remaining_qty=$net_remaining_qty+$req['remaining_quantity']; 
                                                $i++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo date('d-m-Y',strtotime($req['purchase_order_date'])); ?></td>
                                                        <td><?php echo $req['indent_no']; ?></td>
                                                        <td><?php echo $req['order_no']; ?></td>
                                                        <td style="text-align:left;"><?php echo $req['dep_description']; ?></td>
                                                        <td style="text-align:left;"><?php echo $req['SUP_NAME']; ?></td>
                                                        <td><?php echo $req['item_name']; ?></td>
                                                        <td><?php echo $req['meas_unit']; ?></td>
                                                        <!--
                                                            <td><?php echo $req['item_size']; ?></td>
                                                            <td><?php echo $req['unit_name']; ?></td>
                                                        -->
                                                        <td style="text-align:right;"><?php echo number_format($req['quantity']); ?></td>
                                                       
                                                        <td style="text-align:right;"><?php 
                                                           if($req['receive_quantity']>0){
                                                                echo number_format($req['receive_quantity']);
                                                           }else{
                                                               echo "-";
                                                           }
                                                        //if(!empty($req['unit_price'])) echo $req['unit_price']; 
                                                        ?>
                                                        </td>
                                                        <td style="text-align:right;"><?php 
                                                        if($req['remaining_quantity']>0){
                                                            echo number_format($req['remaining_quantity']);
                                                        }else{
                                                            echo "-";
                                                        }
                                                        //if(!empty($req['amount'])) echo $req['amount']; 
                                                        ?>
                                                        </td>
                                                       

                                                    </tr> 
                                                <?php } ?>
                                                    
                                               <?php if(!empty($item_id)) ?>    
                                                    <tr>
                                                        <td colspan="8"><b>Total</b></td>
                                                        <td style="text-align:right;"><b><?php echo number_format($net_order_qty,2) ?></b></td>
                                                        <td style="text-align:right;"><b><?php echo number_format($net_receive_qty,2) ?></b></td>
                                                        <td style="text-align:right;"><b><?php echo number_format($net_remaining_qty,2) ?></b></td>
                                                    </tr>  
                                                <?php ?>    
                                       <?php     
                                             }else{
                                       
                                            
                                            ?> 
                                                    <tr>
                                                        <td colspan="12">
                                                            No Data Found
                                                        </td>
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
                
        <script type="text/javascript">
             function submitForm() {
                var url = '<?php echo site_url(); ?>backend/report/returnReport/true';
                $('#item-form').attr('action', url);
                $('#form-submit').click();
                $('#empoyee-form').attr('action', '<?php echo site_url('backend/report/returnReport'); ?>');
            }
            
            function printDiv(divID) {
        //Get the HTML of div
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;

        //Reset the page's HTML with div's HTML only
        document.body.innerHTML =
                "<html><head><title></title></head><body>" +
                divElements + "</body>";

        //Print Page
        window.print();

        //Restore orignal HTML
        document.body.innerHTML = oldPage;
    }
            
            
//            $('#company').change(function () {
//                $.ajax({
//                    type: "POST",
//                    url: "backend/report/changeCompany",
//                    data: "id=" + $(this).val(),
//                    dataType: "json",
//                    success: function (data) {
//                        if (data.msg == 'success') {
//                            var str = '';
//                            $(data.data).each(function (row, val) {
//                                str += '<option class="form-controll" value="' + val.t_id + '">' + val.t_name + '</option>';
//                            })
//                            $('#tanker').html(str);
//                        } else {
//                            $('#tanker').html('');
//                        }
//                    }
//                })
//            })
        </script>