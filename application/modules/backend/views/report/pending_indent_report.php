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
               Pending Indent Report
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
                    
                    
                            <form id="item-form" action="<?php site_url('backend/report/pendingIndentReport'); ?>" method="post">
                            
                            <div class="row">
                            
                                
                              
                                
                                
                               <div style="margin-top: 15px;" class="col-md-4">
                                    <label>Items :</label>
                                    
                                    <select  class="form-control e1" placeholder="Select Item" id="item_id" name="item_id">
                                            <option class="form-control" value="">Select Item</option>
                                       <?php foreach ($products as $item) { ?>
                                            <option class="form-control" <?php if ($item['id']==$item_id) echo 'selected="selected"'; ?> value="<?php echo $item['id'] ?>"><?php echo $item['item_name']; ?></option>
                                       <?php } ?>  

                                                        
                                    </select>
                                </div>     
                                
                            </div><!--End Row-->
                            
                            <div class="row">
                                <div style="margin-top: 15px;" class="col-md-4">
                                    <label>From Date :</label>
                                    <input  type="text" name="from_date" class="form-control datepicker" value="<?php if(!empty($f_date)) echo $f_date;else echo $first_date; ?>" placeholder="Select Date"/>
                                </div>

                                 <div style="margin-top: 15px;" class="col-md-4">
                                     <label>To Date :</label>
                                    <input  type="text" name="to_date" class="form-control datepicker" value="<?php if(!empty($to_date)) echo $to_date;else echo $last_date; ?>" placeholder="Select Date"/>
                                </div>
                            </div>
                            
                            
                            <div style="margin-top: 15px;" class="col-md-12">

                                <div class="col-md-4 col-md-offset-4">

                                     <Button id="form-submit" style="padding: 6px 40px;background-color:#286090;" type="submit" class="btn btn-primary" value="SEARCH">SEARCH</Button>
                                     <a style="padding: 6px 50px;"  href="javascript:" class="btn btn-success" onclick="javascript:printDiv('printablediv')">PRINT</a>
                                </div>
                            </div>
                            
                            </form>
                      <div class="clearfix"></div> 
                    <div class="row" id="printablediv">
                   
                        <div id="header_div" style="margin-top: 15px;text-align: center;" class="col-md-10 col-md-offset-1">
                            <h3>KARIM ASPHALT & READY MIX LTD.</h3>
                            <h4>Pending Indent Report</h4>
                            

                        </div>

                 
                    
                        
                        <table style="width:100%;" id="player_table" class="table table-striped  table-bordered   responsive">
                           
                                        <thead>

                                            <tr>
                                                <th>SL.</th>
                                                <th>Date</th>
                                                <th>Indent No.</th>                                                                                               
                                                <th>Material Name</th>
                                                <th>Remark</th>
                                                <th>MU.</th>
                                                
                                                <th>Indent Qnty</th>
                                                
                                                <th>Recive Qnty</th>
                                                <th>Remaining Qnty</th>
                                                
                                                


                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i=0;
                                              if(!empty($indents)){
                                                foreach($indents as $req){ 
                                                $i++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo date('d-m-Y',strtotime($req['indent_date'])); ?></td>
                                                        <td><?php echo $req['indent_no']; ?></td>
                                                       
                                                       
                                                        
                                                        <td><?php echo $req['item_name']; ?></td>
                                                        <td><?php echo $req['remark']; ?></td>
                                                        
                                                        <td><?php echo $req['meas_unit']; ?></td>
                                                       
                                                        
                                                        
                                                        
                                                        <td style="text-align:right;"><?php echo number_format($req['indent_qty']); ?></td>
                                                       
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
                                       <?php    } 
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