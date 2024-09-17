
<!-- page content -->

<div class="right_col" role="main" >
    <div id="collapseOne"class="">
        <div class="page-title">
<!--            <div class="title_center">
                <h3>CHEQUE LIST</h3>
            </div>-->


        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel m_panel">
                    <div class="x_content">
                        <div class="col-md-12  col-sm-12 col-xs-12"style="margin-top: -6px; margin-bottom: 3px;">
                            <div class="col-md-6 col-sm-6 ">
                                <div class="themat_title">
                                    <!--                                    <h4>TRIP LIST</h4> -->
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">

<!--                                <button class="addth-button pull-right" id="create_new_cheque"><span class="fa fa-plus"></span>  Create New Cheque</button>-->
                                <a href="" id="print" class="addth-button pull-right">Print</a>
                            </div>

                        </div>
                        
                        <div class="clearfix"></div>
                        <div class="row mline"></div>
<div class="row">
                            <h3 style="text-align:center;"><?php echo $issuedCheque[0]['c_name'];?></h3>
                            <h4 style="text-align:center;">RECEIVED VOUCHER</h4>
                            <div class="col-md-6">
                                <p>NO. :IBBL 0001</p>
                                <p>Date. : <?php echo date('d-m-Y',  strtotime($collections_info[0]['receive_date']));?></p>
                            </div>
                            <div class="col-md-6 pull-right" style="text-align:right;">
<!--                               <p>Cheque No: <?php echo $issuedCheque[0]['chk_no'];?></p>
                                <p>Account No: <?php echo $issuedCheque[0]['bank_account'];?></p> 
                                <p><?php echo $issuedCheque[0]['bank_name'];?></p> 
                                <p><?php echo $issuedCheque[0]['bank_branch'];?></p> -->
                            </div>
                        </div>
                        <table border="1"  class="table" style="width: 100%;">
                            <thead>
                            
                            <th style="width:10%;text-align: center;">SN</th>
                            <th style="width:10%;text-align: center;">Received From</th>
                            <th style="width:15%;text-align: center;">Received For</th>
                            <th style="text-align: center;width:20%;" class="noExport">Amount</th>
                            </thead>
                            <tbody>
                               
                                    <tr>
                                       
                                        <td style="width:5%;text-align: center;">1</td>
                                        <td style="width:5%;text-align: center;"><?php echo $collections_info[0]['c_name'];?></td>
                                        <td style="width:5%;text-align: center;"></td>
                                        <td style="width:5%;text-align: center;"><?php echo number_format($collections_info[0]['amount'],2);?></td>
                                        
                                        

                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align:center;"><strong>Total Amount</strong></td>
                                        <td style="text-align:center;"><?php echo number_format($collections_info[0]['amount'],2);?></td>
                                    </tr>
                               

                            </tbody>
                        </table>

                        <p>In word : <?php echo convert_number_to_words($collections_info[0]['amount']) ;?></p>
                        <br>
                        <br>
                        <p>Recived By _ _ _ _ _ _ _ _ _ _
                            <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $issuedCheque[0]['receive_by'];?>
                            <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $issuedCheque[0]['p_phone'];?>
                        </p>
                        <p></p>
                        <p></p>
                    </div>
                    <!-- Modal -->
                    
                </div>
            </div>
        </div>


    </div>
</div>


<script type="text/javascript">
//$('#print').click(function(){
//  $('#cheque_no').hide();
//  $('#print').hide();
//  $('.date').css('margin-top','66px');
//  window.print();
//  $('#cheque_no').show();
//  $('#print').show();
//  $('.date').css('margin-top','23px');
//});

$('#print').click(function () {
               // $('#remover').hide();
               var heada = document.getElementsByTagName('head')[0].innerHTML;
                document.getElementsByTagName('head')[0].remove();
                var headstr = "<html><head><title></title></head><body>";
                var footstr = "</body></html>";
                var newstr = $('#collapseOne').html();
                var oldstr = document.body.innerHTML;
                document.body.innerHTML = headstr + newstr + footstr;
                window.print();
                // document.body.innerHTML = heada + oldstr;
                
            });
</script>

<!-- /page content -->