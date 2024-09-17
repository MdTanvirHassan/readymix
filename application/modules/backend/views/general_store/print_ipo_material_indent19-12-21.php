<style>
@page {
    size: auto;
    /* auto is the initial value */
    margin-top: 20px;
    /* this affects the margin in the printer settings */
    margin-bottom: 0;
}

#content-table {
    line-height: 18px !important;
}

table {
    border-collapse: collapse;

}

table tr th {
    background: #eee;
    height: 10px !important;
}

table tr td,
table tr th {
    padding: 1px 5px;
    vertical-align: initial;
}

@media print {
    .footer {
        width: 100%;
        position: absolute;
        bottom: 20px; // this sets the footer -20px from the top of the next 
        //header/page ... 20px above the bottom of target page
        //so make sure it is more negative than your footer's height.
    }
}
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<!--<div style="padding:50px; width:60%; margin: 0 auto">-->
<div class="container-fluid">
    <!--<div class="row">-->
    <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;"><img
            style="width: 120px;margin-top: -12px;position: absolute;margin-left: -165px;"
            src="<?php echo site_url('images/kmix_logo.png')?>"> <span>KARIM ASPHALT & READY MIX LTD.</span> </h2>
    <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">(A Unit of Karim Group)</p>
    <hr>
    <p
        style=" text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 24px;margin-bottom: 4px;">
        MATERIAL REQUISITION</p>

    <p style="width:50%;float:left">
        Indent No.: <?php echo $ipo_material_indent[0]['ipo_number']; ?><br>
        Project Name: <b><?php echo strtoupper($ipo_material_indent[0]['dep_description']); ?></b><br>
    </p>
    <div style="float:right;">
        <?php if(!empty($sale_order_info[0]['quotation_date'])){ ?>
        <b style="position: absolute;right: 13px;">Date:
            <?php  echo !empty($sale_order_info[0]['quotation_date']) ? date('d-m-Y',strtotime($sale_order_info[0]['quotation_date'])) : ''; ?></b><br><br>
        <?php } ?>
        <div style="padding: 10px">
            <b>Date: <?php echo date('d-m-Y',strtotime($ipo_material_indent[0]['date'])); ?></b><br>
            <b>Department:
                <?php if(!empty($ipo_material_indent[0]['dept_name'])) echo $ipo_material_indent[0]['dept_name']; ?></b><br>
        </div>
    </div>
    <div style="clear: both;"></div>
    <!-- style="border:1px solid black; height:720px" -->
    <div>
        <table class="table table-bordered" style="margin:3px; width:99%;">
            <!-- <tr style="position:fixed;">  -->
            <tr>
                <th>SN.</th>
                <th>Item name and description </th>
                <th style="widht:5%">M.Unit</th>
                <!--  <th>Brand</th>-->
                <th>Current Stock</th>
                <th>Indent quantity</th>
                <th>Expected Date</th>
                <th style="widht:20%">Remark </th>
            </tr>
            <?php 
                                        $count=count($ipo_material_indent_details);
                                        $i=0; foreach($ipo_material_indent_details as $ipo_material_indent_detail){ $i++;
                                        //  $total_value=$total_value+$budgeted_item['budget_value'];
                                        ?>
            <tr>
                <td>
                    <?php echo $i; ?>
                </td>
                <td style="text-align: left;">
                    <?php 
                                                    if(!empty($ipo_material_indent_detail['item_name'])){ 
                                                        if(!empty($ipo_material_indent_detail['brand_name'])){
                                                            echo $ipo_material_indent_detail['item_name'].','.$ipo_material_indent_detail['brand_name'];
                                                        }else{
                                                            echo $ipo_material_indent_detail['item_name']; 
                                                        }
                                                    }
                                                    ?>
                </td>
                <td><?php if(!empty($ipo_material_indent_detail['unit'])) echo $ipo_material_indent_detail['unit'];  ?>
                </td>
                <!--    
                                                <td >  
                                                    <?php foreach ($ipo_material_indent_detail['item_brands'] as $brand) { ?>
                                                            <?php if (!empty($brand['id']) && $ipo_material_indent_detail['brand_id'] == $brand['id'])  echo $brand['brand_name']; ?></option>
                                                    <?php } ?>
                                                </td>
                                            -->
                <td><?php if(!empty($ipo_material_indent_detail['stock_qty'])) echo $ipo_material_indent_detail['stock_qty'];  ?>
                </td>
                <td><?php if(!empty($ipo_material_indent_detail['indent_qty'])) echo $ipo_material_indent_detail['indent_qty'];  ?>
                </td>

                <td><?php if(!empty($ipo_material_indent_detail['expected_date'])) echo date('d-m-Y',strtotime($ipo_material_indent_detail['expected_date']));  ?>
                </td>
                <td><?php if(!empty($ipo_material_indent_detail['remark'])) echo $ipo_material_indent_detail['remark'];  ?>
                </td>
            </tr>

            <?php } ?>


        </table>

    </div>

    <div class="row footer">
        <div class="col-md-12" style="width:100%">
            <div class="col-md-3" style="font-size:15px;width:25%; text-align: left; float: left;"><span
                    style="border-top:1px solid;">Prepared By</span></div>
            <div class="col-md-3" style="font-size:15px;width:25%; text-align: center; font-size:15px;float: left;">
                <span style="border-top:1px solid;">Recommended By</span></div>
            <div class="col-md-3" style="font-size:15px;width:25%; text-align: center; float: left;"><span
                    style="border-top:1px solid;">Authorized By</span></div>
            <div class="col-md-3" style="font-size:15px;width:25%; text-align: right; float: left;"><span
                    style="border-top:1px solid;">Approved By</span></div>
            <div style="clear: both;"></div>
        </div>
    </div>
    <div style="clear: both;"></div>

    <!-- <div style="position: fixed; bottom: 30px; overflow: hidden; text-align: center;  width:100%" id="spacer">
            <table class="" >
            <tr>
                <td style="width:200px;font-size:15px;"><span style="border-top:1px solid;">Prepared By</span></td>
                <td style="width:115px;font-size:15px;"><span style="border-top:1px solid;"></span></td>
                <td style="width:200px;font-size:15px;"><span style="border-top:1px solid;">Recommended By</span></td>
                <td style="width:115px;font-size:15px;"><span style="border-top:1px solid;"></span></td>
                <td style="width:200px;text-align: left;"><span style="border-top:1px solid;">Authorized By</span></td>
                <td style="width:130px;font-size:15px;"><span style="border-top:1px solid;"></span></td>
                <td style="width:200px;text-align: left;"><span style="border-top:1px solid;">Approved By</span></td>
                </tr>
            </table>
        </div>
    
        <div style="clear: both;"></div> -->

    <!--</div>-->
</div>