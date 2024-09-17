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
                Total Material Received Report
                </h4>
                <a style="margin-top: -21px;"  href="<?php echo site_url('backend/report'); ?>" class="btn btn-sm btn-primary pull-right">GO BACK</a>
            </div>

            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                
                <?php
                    $current_month_year=date('m-Y');
                    $first_date=date('d-m-Y',strtotime(date('Y-m-01')));
                    $last_date=date('d-m-Y',strtotime(date('Y-m-t')));
                ?>

                <div class="panel-body">
                    
                    
                            <form id="item-form" action="<?php site_url('backend/report/returnReport'); ?>" method="post">
                            
                            <div class="row">
                            
                                
                                
                                
                                <div style="margin-top: 15px;" class="col-md-4">
                                     <label>Suppliers :</label>
                                    <select required class="form-control select2" placeholder="Select Item" id="item_id" name="item_id">
                                  <?php foreach ($suppliers as $item) { ?>
                                                        <option class="form-control" <?php if ($item['ID'] == $item_id) echo 'selected="selected"'; ?> value="<?php echo $item['ID'] ?>"><?php echo $item['NAME']."(".$item['CODE'].")"; ?></option>
                                                    <?php } ?>  
                                             
                                                        
                                       </select>
                                </div>
<!--                                <div style="margin-top: 15px;" class="col-md-4">
                                     <label>Select Status :</label>
                                    <select required class="form-control" placeholder="Select Item" id="status" name="status">
                                        <option value="">Please Select Status</option> 
                                        <option value="Done">Done</option> 
                                        <option value="Received">Received</option> 
                                         
                                             
                                                        
                                       </select>
                                </div>-->
                                <div style="margin-top: 15px;" class="col-md-4">
                                    <label>From Date :</label>
                                    <input required type="text" name="from_date" class="form-control datepicker" value="<?php if(!empty($f_date)) echo $f_date;else echo $first_date; ?>" placeholder="Select Date"/>
                                </div>

                                 <div style="margin-top: 15px;" class="col-md-4">
                                     <label>To Date :</label>
                                    <input required type="text" name="to_date" class="form-control datepicker" value="<?php if(!empty($to_date)) echo $to_date;else echo $last_date; ?>" placeholder="Select Date"/>
                                </div>
                            </div><!--End Row-->
                            
                            <div style="margin-top: 15px;" class="col-md-12">

                                <div class="col-md-4 col-md-offset-4">

                                     <input id="form-submit" style="padding: 6px 50px;" type="submit" class="btn btn-primary" value="SEARCH"/>
                                     <a style="padding: 6px 50px;"  href="javascript:" class="btn btn-success" onclick="javascript:printDiv('printablediv')">PRINT</a>
                                </div>
                            </div>
                            
                            </form>
                      <div class="clearfix"></div> 
                    <div class="row" id="printablediv">
                   
                        <div id="header_div" style="margin-top: 15px;text-align: center;" class="col-md-10 col-md-offset-1">
                            <h3>Wahid Construction Ltd.</h3>
                            <h4>Total Material Received Report</h4>
                            

                        </div>

                 
                    
                        
                        <table style="width:100%;" id="player_table" class="table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                           
                                        <thead>

                                            <tr>
                                                <th>SL.</th>
                                                
                                                <th>Item Name</th>
                                                <th>Item Code</th>
                                               
                                                <th>Value</th>
                                                


                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i=0;
                                              if(!empty($purchase_orders)){
                                                foreach($purchase_orders as $req){ 
                                                $i++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                       
                                                        <td><?php echo $req['item_name']; ?></td>
                                                        <td><?php echo $req['meas_unit']; ?></td>                                                    
                                                        <td><?php  echo $req['total']/$req['total_qty']; ?></td>
                                                       

                                                    </tr>  
                                       <?php    } 
                                             }else{
                                       
                                            
                                            ?> 
                                                    <tr>
                                                        <td colspan="3">
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
        </script><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

