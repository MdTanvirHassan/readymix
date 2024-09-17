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
    <h1 style="text-align: center;text-decoration: underline;margin-top:-2px;text-transform: uppercase;font-weight: bold;font-size:18px;">SALES TARGET ACHIEVEMENT FOR THE MONTH OF - <?php echo date("F Y", strtotime($month)); ?></h1>

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
                                <th rowspan="2">SN</th>
                                <th style="width:80px;" rowspan="2">TEAM</th>
                                <th rowspan="2">EMPLOYEE</th>
                                <th rowspan="2">DESIGNATION</th>
                                <th rowspan="2">PRODUCT</th>
                                <th rowspan="2">MU</th>
                                <th colspan="2">TARGET</th>
                                <th colspan="3">ACHIVE</th>
                                <th colspan="3">VARIANCE</th>
                            </tr>
                            <tr>
                                <th>QNTY</th>
                                <th>VALUE</th>
                                <th>QNTY</th>
                                <th>VALUE</th>
                                <th>%</th>
                                <th>QNTY</th>
                                <th>VALUE</th>
                                <th>%</th>
                            </tr>
                            <?php
                            $total = 0;
                            $achive_total = 0;
                            $dtotal = 0;
                            $i = 0;
                            $j = 0;
                            foreach ($teams as $k => $targets) {
                              $j++;
                                foreach ($targets as $key => $target) {
                                    $i++;
                                    
                                    $total += $target['target_value'];
                                    if ($target['achive_quantity'] == 0)
                                        $percent = 0;
                                    elseif ($target['target_value'] == 0)
                                        $percent = $target['achive_quantity'];
                                    else
                                        $percent = ($target['achive_quantity'] * 100) / $target['target_qty'];

                                    $diff_total = $target['achive_total'] - $target['target_value'];
                                    $diff_qty = $target['achive_quantity'] - $target['target_qty'];
                                    $v_percent = $percent - 100;
                                    $achive_total += $target['achive_total'];
                                    $dtotal += $diff_total;
                                    if ($i == 1) {
                            ?>

                                        <tr>
                                            
                                            <?php if ($key == 0) { ?>
                                              <td style="vertical-align: middle;" rowspan="<?php echo count($targets); ?>"><?php echo ($j); ?></td>
                                            <td style="vertical-align: middle;" rowspan="<?php echo count($targets); ?>"><?php echo $target['team_name']; ?></td>
                                            <?php } ?>
                                            <td rowspan="2"><?php echo $target['name']; ?></td>
                                            <td rowspan="2"><?php echo $target['designation_name']; ?></td>
                                            <td><?php echo $target['category_name']; ?></td>
                                            <td><?php echo $target['measurement_unit']; ?></td>
                                            <td style="text-align:right;"><?php echo number_format($target['target_qty'], 2); ?></td>
                                            <td style="text-align:right;"><?php echo number_format($target['target_value'], 2); ?></td>
                                            <td style="text-align:right;"><?php echo number_format($target['achive_quantity'], 2); ?></td>
                                            <td style="text-align:right;"><?php echo number_format($target['achive_total'], 2); ?></td>
                                            <td style="text-align:right;"><?php echo number_format(($target['target_qty'] > 0) ? $percent : '0', 2); ?></td>
                                            <td style="text-align:right;"><?php echo number_format(($target['target_qty'] > 0) ? $diff_qty : 0, 2); ?></td>
                                            <td style="text-align:right;"><?php echo number_format(($target['target_qty'] > 0) ? $diff_total : 0, 2); ?></td>
                                            <?php if ($v_percent > 0) { ?>
                                                <td style="text-align:right;"><?php echo number_format(($target['target_qty'] > 0) ? $v_percent : 0, 2); ?></td>
                                            <?php } else { ?>
                                                <td style="text-align:right;">(<?php echo number_format(($target['target_qty'] > 0) ? abs($v_percent) : 0, 2); ?>)</td>
                                            <?php } ?>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <td><?php echo $target['category_name']; ?></td>
                                            <td><?php echo $target['measurement_unit']; ?></td>
                                            <td style="text-align:right;"><?php echo number_format($target['target_qty'], 2); ?></td>
                                            <td style="text-align:right;"><?php echo number_format($target['target_value'], 2); ?></td>
                                            <td style="text-align:right;"><?php echo number_format($target['achive_quantity'], 2); ?></td>
                                            <td style="text-align:right;"><?php echo number_format($target['achive_total'], 2); ?></td>
                                            <td style="text-align:right;"><?php echo number_format(($target['target_qty'] > 0) ? $percent : 0, 2); ?></td>
                                            <td style="text-align:right;"><?php echo number_format(($target['target_qty'] > 0) ? $diff_qty : 0, 2); ?></td>
                                            <td style="text-align:right;"><?php echo number_format(($target['target_qty'] > 0) ? $diff_total : 0, 2); ?></td>
                                            <?php if ($v_percent > 0) { ?>
                                                <td style="text-align:right;"><?php echo number_format(($target['target_qty'] > 0) ? $v_percent : 0, 2); ?></td>
                                            <?php } else { ?>
                                                <td style="text-align:right;">(<?php echo number_format(($target['target_qty'] > 0) ? abs($v_percent) : 0, 2); ?>)</td>
                                            <?php } ?>
                                        </tr>
                                    <?php $i = 0;
                                    } ?>
                            <?php
                                }
                            }
                            ?>
                            <tr>
                                <td style="text-align:right;" colspan="7">Total</td>
                                <td style="text-align:right;"><?php echo number_format($total, 2); ?></td>
                                <td></td>
                                <td style="text-align:right;"><?php echo number_format($achive_total, 2); ?></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:right;"><?php echo number_format($dtotal, 2); ?></td>

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