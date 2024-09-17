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
}

table tr td,
table tr th {
    padding: 1px 5px;
    vertical-align: initial;
}
</style>




<!--<div style="padding:50px; width:60%; margin: 0 auto">-->
<div>


    <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;"><img
            style="width: 120px;margin-top: -12px;position: absolute;margin-left: -140px;"
            src="<?php echo site_url('images/kmix.jpg')?>"> <span>KARIM ASPHALT & READY MIX LTD.</span> </h2>
    <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">(A Unit Of Karim Group)</p>
    <hr>
    <p
        style=" text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size: 30px;margin-bottom: 4px;">
        Delivery order</p>

    <p style="width:70%;float:left"><b>D.O. No.:
            <?php echo ucfirst($delivery_order_info[0]['delivery_no']); ?></b><br><br>
            <b>Lc. No.:</b> <?php echo ucfirst($delivery_order_info[0]['lc_no']); ?><br>
            <b>Mother Vessel Name:</b> <?php echo ucfirst($delivery_order_info[0]['mother_vessel_name']); ?><br>
        
    </p>
    <div style="float:right;width:30%;">
        <b style="position: absolute;right: 13px;"> Date: <?php echo date('Y-m-d'); ?></b><br><br>
        <div style="border:1px solid;padding: 10px">
            <b>Delivery Date :
                <?php  echo date('d-m-Y',strtotime($delivery_order_info[0]['delivery_order_date'])); ?></b><br>
            
        </div>
    </div>
    <div style="clear: both;"></div>
    <div style="float: left;width: 48%;border:1px solid;">

        <h3 style="background:#eee; border-bottom: 1px solid;text-align: center;margin: 0;">DELIVERY INFORMATION</h3>
        <table class="table table-bordered table-hover table-striped" style="width:100%">

            <tr>
                <td style="width:50%;"><b>Customer Name</b></td>
                <td>: <?php echo $delivery_order_info[0]['c_name']; ?>
                </td>
            </tr>
            <tr>
                <td style="width:50%;"><b>Address</b> </td>
                <td>: <?php echo ucfirst($delivery_order_info[0]['shipping_address']); ?></td>
            </tr>
            <tr>
                <td style="width:50%;"><b>Contact Person</b></td>
                <td>:<?php if(!empty($delivery_order_info[0]['contact_person'])) echo $delivery_order_info[0]['contact_person']; ?></td>
            </tr>
            <tr>
                <td style="width:50%;"><b>Contact Number</b></td>
                <td>: <?php echo ucfirst($delivery_order_info[0]['contact_no']); ?></td>
            </tr>

        </table>
    </div>

    
    <div style="clear: both;"></div>
    <div style="margin-bottom:20px;margin-top:20px;">

        Store Department <br>
        Karim Asphalt & Ready Mix Ltd.<br>
       
        <b>Attention:</b> Store Department<br><br>
        Dear concern,<br>
        We are pleased to issue the Delivery Order for the following items as per the terms and condition below:
    </div>
    <table class="table  table-hover table-striped" border="1"
        style="width:100%;text-align: center;margin-bottom: 20px;">
        <thead class="thead-color">
            <tr>
                <th style="vertical-align: middle;text-align: center;width:150px;">Item Name
                </th>
                <th style="vertical-align: middle;text-align: center;">Origin</th>
                

                <th style="vertical-align: middle;text-align: center;">MU.</th>
               
                <th style="vertical-align: middle;text-align: center;">Do. Qty<sup style="color:red;">*</sup></th>

                <th style="vertical-align: middle;text-align: center;">B.Price<sup style="color:red;">*</sup></th>
                <th style="vertical-align: middle;text-align: center;">Commission<sup style="color:red;"></sup></th>
                <th style="vertical-align: middle;text-align: center;">T.Cost<sup style="color:red;">*</sup></th>

                <th style="vertical-align: middle;text-align: center;">Price<sup style="color:red;">*</sup></th>
                <th style="vertical-align: middle;text-align: center;">Total</th>

            </tr>
        </thead>
        <tbody id="mytableBody">
            <?php $i=0; 
            foreach($delivery_order_details_info as $delivery_order_details){ 
                            $i++;
                            ?>
            <tr class="" id="row_<?php echo $quotation_details['s_item_id'] ?>">
                <td><?php echo $delivery_order_details['item_name'] ?>
                </td>

                <td><?php echo $delivery_order_details['origin'] ?></td>
               
                <td><?php echo $delivery_order_details['meas_unit'] ?></td>

                


                <td><?php echo $delivery_order_details['quantity'] ?>
                </td>

                <td><?php echo $delivery_order_details['base_price'] ?>
                </td>

                <td><?php echo $delivery_order_details['commission'] ?>
                </td>

                <td><?php echo $delivery_order_details['transport_cost'] ?>
                </td>




                <td><?php echo $delivery_order_details['unit_price'] ?>
                </td>
                <td><?php echo $delivery_order_details['amount'] ?>


                </td>
            </tr>
            <?php } ?>

        </tbody>
    </table>



    <div style="clear: both;"></div>
    <div style="position: fixed;bottom: 30px;text-align: center;width:100%">
        <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
            <tr>
                <td style="width:20%;font-size:15px;"><span style="border-top:1px solid;">PREPARED BY</span></td>

                <td style="width:20%;text-align: center;"><span style="border-top:1px solid;"></span></td>

                <td style="width:10%;text-align: right;"><span style="border-top:1px solid;">VETTED BY</span></td>
            </tr>
        </table>


    </div>
    <div style="clear: both;"></div>


</div>