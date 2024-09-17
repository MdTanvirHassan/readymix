<style>
  @page {

    margin-top: 0px;

  }

  #content-table {
    line-height: 18px !important;
    font-size: 13px;
  }

  table {
    border-collapse: collapse;

  }

  table tr th {
    background: #eee;

  }

  #maintable tr th,
  #maintable tr td {

    font-size: 12px;
  }

  table tr td,
  table tr th {
    padding: 1px 5px;
  }

  .x_content td,th{
    border:1px solid;
}

  /*@page:left{
  @bottom-left {
    counter-increment: page;
    content: "Page " counter(pageNumber) " of " counter(pageNumber);
  }
}*/


  @media print {

    /* #header,
    .header-space {
      height: 250px;
    }

    .footer,
    .footer-space {
      height: 100px;
    }

    #header {
      position: fixed;
      top: 0;
      width: 100%;
      /*  text-align: center;*/
    }

    .footer {
      position: fixed;
      bottom: -60px;
      ;
    } */




  }


  .pageNumber {
    position: relative;
    height: auto;
    min-height: 10px;
    width: 590px;
    display: block;
    background: rgba(60, 60, 60, 0.28) !important;
    margin: 0 auto 5px;
    page-break-before: always;
    /*This style rule makes every page element start at the top of a new page:*/
    counter-increment: pages;
  }

  /*page numbers*/
  div.pageNumber:after {
    content: " PAGE - "counter(pages);
    position: absolute;
    bottom: 0px;
    right: 15px;
    z-index: 999;
    padding: 2px 12px;
    border-right: 2px solid #23b8e7;
    font-size: 12px;
  }

  @media print {
    a[href]:after {
      content: none !important;
    }
  }
</style>
<div id="header">
  <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;"><img style="width: 120px;margin-top: -12px;position: absolute;margin-left: -160px;" src="<?php echo site_url('images/kmix.jpg') ?>"> <span>KARIM ASPHALT & READY MIX LTD.</span> </h2>
  <p style="text-align: center;margin-top: -3;font-weight: bold;font-size: 20px;">(A Unit of Karim Group)</p>
  <hr>
  <div style="">
    <h1 style="text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size:18px;">SALES COMMISSION INVOICE</h1>

  </div>
  <div style="clear: both;"></div>
  
</div>

<table style="width:100%;">
  <thead>
    <tr>
      <td>
        <div class="header-space">&nbsp;</div>
      </td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <div class="x_content">
          <table class="table table-bordered" id="myTable" style="width:100%">

            <tr>
              <th style="width:12%;">Invoice Number:</th>
              <td>
                <?php echo $sale_commission[0]['commission_no']; ?>
              </td>
              <th style="width:12%;">Date:</th>
              <td>
                <?php if (!empty($sale_commission[0]['date'])) echo $sale_commission[0]['date']; ?>
              </td>
            </tr>
            <tr>
              <th style="width:12%;">Client Name:</th>
              <td>
                <?php echo $sale_commission[0]['c_name']; ?>
              </td>
              <th style="width:12%;">Beneficiary:</th>
              <td>
                <?php if (!empty($sale_commission[0]['beneficiary'])) echo $sale_commission[0]['beneficiary']; ?>
              </td>
            </tr>
            <tr>
              <th style="width:12%;">Project Name:</th>
              <td>
                <?php echo $sale_commission[0]['project']; ?>
              </td>
              <th style="width:12%;">Designation:</th>
              <td>
                <?php if (!empty($sale_commission[0]['designation'])) echo $sale_commission[0]['designation']; ?>
              </td>
            </tr>
            <tr>
              <th style="width:12%;">KMIX R.M.:</th>
              <td>
                <?php echo $sale_commission[0]['name']; ?>
              </td>

            </tr>


          </table>

        </div>
<br>

        <div class="x_content">

        <table id="maintable" class="table table-bordered table-hover table-striped"  style="width:100%;text-align: center;margin-bottom: 10px;">
            <thead class="thead-color">
              <tr>
                <th style="text-align:center;vertical-align: middle;">S/N</th>
                <th style="text-align:center;vertical-align: middle;">Invoice NO</th>
                <th style="text-align:center;vertical-align: middle;">Invoice Qty</th>
                <th style="text-align:center;vertical-align: middle;">Invoice Value</th>

                <th style="text-align:right;vertical-align: middle;">Commission Rate</th>
                <th style="text-align:right;vertical-align: middle;">Commission Value</th>
                <th style="text-align:right;vertical-align: middle;">Remarks</th>


              </tr>
            </thead>
            <tbody id="sale_items">
              <?php
              $i = 0;
              $totalqty = 0;
              foreach ($sale_commission_details as $sale_invoice_details) {
                $totalqty += $sale_invoice_details['comm_value'];
                $i++;
              ?>
                <tr class="" id="row_<?php echo $i; ?>">
                  <td style="text-align:center;vertical-align: middle;"><?php echo ($i + 1); ?></td>
                  <td style="text-align:center;vertical-align: middle;"><?php echo $sale_invoice_details['inv_no'] ?></td>
                  <td style="text-align:center;vertical-align: middle;"><?php echo $sale_invoice_details['inv_qty'] ?></td>
                  <td style="text-align:right;"><?php echo $sale_invoice_details['inv_value'] ?></td>
                  <td style="text-align:right;"><?php echo $sale_invoice_details['comm_qty'] ?></td>
                  <td style="text-align:right;"><?php echo $sale_invoice_details['comm_value'] ?></td>
                  <td style="text-align:right;"><?php echo $sale_invoice_details['remarks'] ?></td>


                </tr>
              <?php } ?>

            </tbody>
            <tfoot>
              <tr>
                <td colspan="5" style="text-align:right;"><b>Total</b></td>
                <td style="text-align:right"><?php echo $totalqty; ?> <br> </td>
              </tr>

            </tfoot>
          </table>




        </div>
      </td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <td>
        <div class="footer-space">&nbsp;</div>
      </td>
    </tr>
  </tfoot>
</table>



















<div style="clear: both;"></div>
<div class="footer">
  <table class="table table-bordered table-hover table-striped" style="width:100%;margin:0 auto;text-align:center;margin-top:50px;">
    <tr>
      <td style="width:20%;margin-left:20%;font-size:15px;"><span style="border-top:1px solid;">Prepeard BY</span></td>
      <td style="width:20%;margin-left:20%;font-size:15px;"><span style="border-top:1px solid;">Checked BY</span></td>
      <td style="width:20%;margin-left:20%;font-size:15px;"><span style="border-top:1px solid;">Approved BY</span></td>
      <td style="width:20%;margin-left:20%;font-size:15px;"><span style="border-top:1px solid;">Received BY</span></td>

    </tr>
  </table>

  <!--<div class="pageNumber"></div>-->
</div>