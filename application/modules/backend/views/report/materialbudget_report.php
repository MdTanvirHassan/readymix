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
                    Material Budget Report
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
                    
                    
                        <form id="item-form" action="<?php site_url('backend/report/materialBudgetReport'); ?>" method="post">
                            
                            <div class="row">
                            
                                
                                <div style="margin-top: 15px;" class="col-md-4 ">
                                    <label>Select Project :</label>
                                       <select  class="form-control select2" placeholder="Select Item" id="d_id" name="d_id">
                                           <option class="form-control" value="">Select Project</option>
                                        <?php foreach ($projects as $project) { ?>
                                            <option class="form-control" <?php if ($project['d_id']==$project_id) echo 'selected="selected"'; ?> value="<?php echo $project['d_id'] ?>"><?php echo $project['dep_description']."(".$project['dep_code'].")"; ?></option>
                                        <?php } ?>  
                                                                                     
                                       </select>
                                   </div>
                                
                                <div style="margin-top: 15px;" class="col-md-4">
                                     <label>Select Material :</label>
                                    <select  class="form-control select2" placeholder="Select Item" id="item_id" name="item_id">
                                         <option class="form-control" value="">Select Item</option>
                                    <?php foreach ($products as $item) { ?>
                                        <option class="form-control" <?php if ($item['id'] == $item_id) echo 'selected="selected"'; ?> value="<?php echo $item['id'] ?>"><?php echo $item['item_name']."(".$item['item_code'].")"; ?></option>
                                    <?php } ?>  
                                             
                                                        
                                       </select>
                                </div>
                                <div style="margin-top: 15px;" class="col-md-4">
                                    <label>Budget Status :</label>
                                    <select  class="form-control" placeholder="Select Item" id="status" name="status">
                                        <option value="">Please Select Status</option> 
                                        <option <?php if(isset($status) && $status=="Approved") echo 'selected'; ?> value="Approved">Approved</option> 
                                        <option <?php if(isset($status) && $status=="Pending") echo 'selected'; ?> value="Pending">Pending</option> 
                                                                                                                                              
                                    </select>
                                </div>
                                <div style="margin-top: 15px;" class="col-md-4">
                                    <label>From Date :</label>
                                    <input  type="text" name="from_date" class="form-control datepicker" value="<?php if(!empty($f_date)) echo $f_date;else echo $first_date; ?>" placeholder="Select Date"/>
                                </div>

                                 <div style="margin-top: 15px;" class="col-md-4">
                                     <label>To Date :</label>
                                    <input  type="text" name="to_date" class="form-control datepicker" value="<?php if(!empty($to_date)) echo $to_date;else echo $last_date; ?>" placeholder="Select Date"/>
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
                            <h4>Material Budget Report</h4>
                            
                        </div>

                 
                    
                        
                        <table style="width:100%;" id="player_table" class="table table-striped datatable-scroll table-bordered bootstrap-datatable datatable responsive">
                           
                                        <thead>

                                            <tr>
                                                <th>SL.</th>
                                                <th>Date</th>
                                                <th>Requisition No.</th>
                                                <th>Project Name</th>
                                                <th>Material Name</th>
                                                <th>MU.</th>
                                                <th>Size</th>
                                                <th>Size Unit</th>
                                                <th>I.Qty</th>
                                                <th>B.Qty</th>
                                                <th>Unit Price</th>
                                                <th>Value</th>
                                                <th>Status</th>
                                                


                                            </tr>
                                            
                                        </thead>
                                         <tbody>
                                            <?php 
                                            $i=0;
                                              if(!empty($budgets)){
                                                foreach($budgets as $req){ 
                                                $i++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $req['b_date']; ?></td>
                                                        <td><?php echo $req['indent_no']; ?></td>
                                                        <td style="text-align:left;"><?php echo $req['department_name']; ?></td>
                                                        <td><?php echo $req['item_name']; ?></td>
                                                        <td><?php echo $req['meas_unit']; ?></td>
                                                        <td><?php echo $req['item_size']; ?></td>
                                                        <td><?php echo $req['unit_name']; ?></td>
                                                        <td><?php echo $req['indent_qty']; ?></td>
                                                        <td><?php if(!empty($req['budget_qty'])) echo $req['budget_qty']; ?></td>
                                                        <td><?php if(!empty($req['unit_price'])) echo $req['unit_price']; ?></td>
                                                        <td><?php if(!empty($req['budget_value'])) echo $req['budget_value']; ?></td>
                                                        <td><?php echo $req['b_approve_status']; ?></td>

                                                    </tr>  
                                       <?php    } 
                                             }else{
                                       
                                            
                                            ?> 
                                                    <tr>
                                                        <td colspan="10">
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