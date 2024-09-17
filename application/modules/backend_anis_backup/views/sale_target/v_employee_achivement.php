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

  .x_content td,
  th {
    border: 1px solid;
  }


  /*@page:left{
  @bottom-left {
    counter-increment: page;
    content: "Page " counter(pageNumber) " of " counter(pageNumber);
  }
}*/


  @media print {

    #header,
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
    }




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
    <h1 style="text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size:18px;">Sales Achievement report for the Month of - <?php echo date('F Y', strtotime($month)); ?></h1>

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
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_content">

                <table class="table table-striped table-bordered" style="width:100%">

                  <tr>
                    <th>SN</th>
                    <th>DO No</th>
                    <th>Inv No</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>MOU</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Amount</th>
                  </tr>

                  <?php
                  $total = 0;
                  $achive_total = 0;
                  $qty_total = 0;
                  $dtotal = 0;
                  $i = 0;
                  foreach ($achievement as $key => $target) {
                    if ($target['amount']==0)
                      continue;
                    $i++;
                    $total += $target['amount'];
                    $qty_total += $target['quantity'];
                  ?>

                    <tr>
                      <td><?php echo ($key + 1); ?></td>
                      <td><?php echo $target['delivery_no']; ?></td>
                      <td><?php echo $target['inv_no']; ?></td>
                      <td><?php echo $target['sale_invoice_date']; ?></td>
                      <td><?php echo $target['c_short_name']; ?></td>
                      <td><?php echo $target['product_name']; ?></td>
                      <td><?php echo $target['mu_name']; ?></td>
                      <td style="text-align:right;"><?php echo number_format($target['quantity'], 2); ?></td>
                      <td style="text-align:right;"><?php echo number_format($target['unit_price'], 2); ?></td>
                      <td style="text-align:right;"><?php echo number_format($target['amount'], 2); ?></td>
                    </tr>

                  <?php
                  } ?>
                  <tr>
                    <td style="text-align:right;" colspan="7">Total</td>
                    <td style="text-align:right;"><?php echo number_format($qty_total, 2); ?></td>
                    <td></td>
                    <td style="text-align:right;"><?php echo number_format($total, 2); ?></td>

                  </tr>
                </table>


              </div>
            </div>
          </div>
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