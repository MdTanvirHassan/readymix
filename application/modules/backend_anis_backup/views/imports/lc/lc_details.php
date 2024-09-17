<!DOCTYPE html>
<html>

<head>
  <title>Proforma Invoice-<?php echo $pi[0]['pi_no']; ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <style>
    @page {
      size: A4;
      margin: 10px;

    }

    @media print {

      html,
      body {
        width: 210mm;
        height: 297mm;
      }

      /* ... the rest of the rules ... */
    }

    .table thead {
      display: table-header-group;
    }

    .empty-header {
      height: 135px;

    }

    .empty-footer {
      height: 50px;

    }

    .header {
      position: fixed;
      top: 10px;
      width: 100%
    }

    .footer {
      height: 50px;
      position: fixed;
      bottom: 5px;
      width: 100%
    }

    .table-bordereds>tbody>tr>td,
    .table-bordereds>tbody>tr>th,
    .table-bordereds>tfoot>tr>td,
    .table-bordereds>tfoot>tr>th,
    .table-bordereds>thead>tr>td,
    .table-bordereds>thead>tr>th {
      border: 1px solid #000;
      padding:2px;
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{padding:0px;}

    .table>thead:first-child>tr:first-child>th {
      border-top: 1px solid;
    }
    p{margin:0px;}
  </style>
</head>

<body>
  <div id="content" class="container-fluid">
    <table style="width:100%;">
      <thead>
        <th>
        <td>
          <div class="empty-header"></div>
        </td>
        </th>
      </thead>
      <tbody>
        <tr>
          <td>
            <div class="content">
              <p style=" width:100%;float:left;text-align: center;text-decoration: underline;text-transform: uppercase;font-weight: bold;font-size: 20px;margin-bottom: 4px;">PROFORMA INVOICE</p>

              <p style="width:50%float:left"><b> PI No.: <?php echo $pi[0]['pi_no']; ?></b></p>
              <p style="width:50%;float:right;text-align:right"><b>Date: <?php echo date('d-m-Y', strtotime($pi[0]['date'])); ?></b><br>
              <p style="width:100%;"><b>Buyer Name: <?php echo $pi[0]['buyer_name']; ?></b></p>
              <p style="width:100%;"> <b>Factory Address : <?php echo $pi[0]['address']; ?></b></p>
              <p style="width:100%;"> <b>Contact Person: <?php echo $mrr[0]['contact_person']; ?></b></p>

              
              <table class="table table-bordereds" style="margin:3px; width:100%;font-size:13px;">
                <!-- <tr style="position:fixed;">  -->
                <thead>
                  <tr>
                    <th style="text-align:center;">SL. No</th>
                    <th style="text-align:center;">Description of Goods</th>
                    <th style="text-align:center;">Quantity(Kgs)</th>
                    <th style="text-align:center;">Unit Price ($/Kg)</th>
                    <th style="text-align:center;">Total Amount($)</th>
                  </tr>
                </thead>


                <?php $count = count($pi_details);
                $total_value = 0;
                $total_qty = 0;
                $i = 0;
                foreach ($pi_details as $receive_item) {
                  $i++;
                  $total_value += $receive_item['qty'] * $receive_item['price'];
                  $total_qty += $receive_item['qty'];
                ?>
                  <tr>

                    <td><?php echo $i;  ?></td>
                    <td style="text-align:left;"><?php if (!empty($receive_item['count_name'])) echo $receive_item['count_name'];  ?><?php if (!empty($receive_item['process_name'])) echo ', ' . $receive_item['process_name'];  ?><?php if (!empty($receive_item['comp'])) echo ', ' . $receive_item['comp'];  ?><?php if (!empty($receive_item['cert'])) echo ', ' . $receive_item['cert'];  ?></td>
                    <td style="text-align:right;"><?php if (!empty($receive_item['qty'])) echo number_format($receive_item['qty'],2);  ?></td>
                    <td style="text-align:right;"><?php if (!empty($receive_item['price'])) echo number_format($receive_item['price'],2);  ?></td>

                    <td  style="text-align:right;"><?php if (!empty($receive_item['price'])) echo number_format($receive_item['qty'] * $receive_item['price'],2); ?></td>
                  </tr>


                <?php } ?>
                <tr>

                  <td colspan="2"  style="text-align:right;">Total</td>
                  <td style="text-align:right;"><?php if (!empty($total_qty)) echo number_format($total_qty,2);  ?></td>
                  <td></td>
                  <td style="text-align:right;"><?php if (!empty($total_value)) echo number_format($total_value,2);  ?></td>
                </tr>


              </table>
              <b>Total Value In Words(US Dollar) : &nbsp;<?php $taka_in_word = convert_number_to_words($total_value,2);
                                                          echo ucwords($taka_in_word);  ?>&nbsp;Only </b>
              <h4 style="text-decoration: underline;">Terms & Conditions : </h4>
              <table class="table" style="margin:3px; width:100%;font-size:13px;">
                <?php foreach ($pi_terms as $term) { ?>
                  <tr>
                    <th style="width:20px;border:none">*</th>
                    <th style="width:15%;border:none"><?php echo $term['term_name']; ?></th>
                    <th style="width:20px;border:none">:</th>
                    <th style="border:none"><?php echo $term['term_details']; ?></th>
                  </tr>
                <?php } ?>
              </table>
              <h4 style="margin-top:30px;font-weight:bold">Accepet By : KARIM TEX LTD.</h4>
            </div>
          </td>
        </tr>
      </tbody>
      <tfoot>
        <th>
        <td>
          <div class="empty-footer"></div>
        </td>
        </th>
      </tfoot>
    </table>
    <div class="header">
      <h2 style="font-size:25px; text-align: center; margin-bottom: 5px;margin-top:0px;"><img style="width: 120px;position: absolute;margin-left: -140px;" src="<?php echo site_url('images/kmix_logo.png') ?>"> <span>KARIM TEX LTD.</span> </h2>
      <p style="text-align: center;margin-bottom: 0;font-weight: bold;font-size: 15px;">(A Unit of Karim Group)</p>
      <p style="text-align: center;margin-bottom: 0;"><b>Head Office : </b>CHANDRASHILA SUVASTU TOWER,GREEN ROAD,PANTHA PATH, DHAKA-1205</p>
      <p style="text-align: center;margin-bottom: 0;"><b>Factory : </b>BAROYPARA , ASHULIA , DHAKA </p>
      <p style="text-align: center;margin-bottom: 0;"><b>Email : karimgroup@gmail.com</b>, <b>Telephone : 880-2-8629391-3</b></p>
      <hr style="margin-top: 1px;margin-bottom:1px;border-bottom:1px;border-style:dashed">

    </div>
  </div>
  <div class="footer">

    <div style="width:100%">
      <div style="font-size:15px;width:33%; text-align: left; float: left;margin-left:5%"><span style="border-top:1px solid;">Buyer</span></div>
      <div style="font-size:15px;width:25%; text-align: center; font-size:15px;float: left;"><span style="border-top:1px solid;"></span>&nbsp;</div>
      <div style="font-size:15px;width:31%; text-align: right; float: left;margin-right:5%"><span style="border-top:1px solid;">Authorised Signature</span></div>

      <div style="clear: both;"></div>

    </div>

  </div>
  </div>
</body>
<script type="text/javascript">
  window.onload = addPageNumbers;

  function addPageNumbers() {
    var totalPages = Math.ceil(document.body.scrollHeight / 1123); //842px A4 pageheight for 72dpi, 1123px A4 pageheight for 96dpi,
    var j = 0;
    for (var i = 1; i <= totalPages; i++) {
      var pageNumberDiv = document.createElement("div");
      var pageNumber = document.createTextNode("Page " + i + " of " + totalPages);
      pageNumberDiv.style.position = "absolute";
      pageNumberDiv.style.top = "calc((" + j + " * (297mm - 0.5px)) + 10px)"; //297mm A4 pageheight; 0,5px unknown needed necessary correction value; additional wanted 40px margin from bottom(own element height included)
      pageNumberDiv.style.height = "16px";
      pageNumberDiv.appendChild(pageNumber);
      document.body.insertBefore(pageNumberDiv, document.getElementById("content"));
      pageNumberDiv.style.left = "calc(100% - (" + pageNumberDiv.offsetWidth + "px + 20px))";
      j++;
    }
  }
</script>

</html>