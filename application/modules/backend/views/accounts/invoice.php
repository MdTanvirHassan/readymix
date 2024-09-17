<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    

    <div class="">
        <div class="page-title">
            <a  href="javascript:" class="btn btn-primary" onclick="printDiv('printableArea')">PRINT</a>
        </div>
        
        <div class="row">
            <div style="max-width:800px;margin:auto;">
                <div class="x_panel">
                    <div id="printableArea">    
                        <div class="x_content">

                            <p style="text-align:center;"><b>KARIM ASPHALT & READY MIX LTD.</b></p>
                            <p style="text-align:center;"><b>(A Unit of Karim Group)</b></p>
                            <p style="text-align:center;"><b>PAYMENT VOUCHER</b></p>
                            
                        <!--    <p style="text-align:center;"><span style="padding:8px;background-color:#000000;">বিদ্যুৎ বিল</span></p>-->
                            <table>
                                <tr>
                                    <td style="width:500px;padding:3px;">
                                        <p style="border-bottom-style: dotted;"><b> Pv. No.&nbsp;&nbsp;&nbsp;<?php $invoic="000".$payment_info[0]['id']; echo $invoic; ?></b></p>
                                    </td>
                                    <td style="width:400px;padding:3px;">
                                        <p style="border-bottom-style: dotted"><b>Dated.&nbsp;&nbsp;&nbsp;<?php echo date('d-m-Y'); ?></b></p>
                                    </td>
                                </tr>
                                <br />
                                <tr>
                                   <td style="width:400px;padding:3px;" colspan="2">
                                       <p style="border-bottom-style: dotted"><b> Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($payment_info[0]['amount']); ?></b></p>
                                    </td>
                                   
                                </tr>
                                
                                <tr>
                                    <td style="width:400px;padding:3px;" colspan="2">
                                        <p style="border-bottom-style: dotted"><b> In Words &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $taka_in_word=convert_number_to_words($payment_info[0]['amount']); echo ucwords($taka_in_word); ?></b></p>
                                    </td>
									
									
                                    
                                </tr>
								
								
				<tr>
                                    <td style="width:400px;padding:3px;" colspan="2">
                                        <p style="border-bottom-style: dotted"><b>Paid To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $payment_info[0]['SUP_NAME']; ?></b></p>
                                    </td>
									
									
                                    
                                </tr>				
								
								
				<tr>
                                    <td style="width:400px;padding:3px;" colspan="2">
                                        <p style="border-bottom-style: dotted"><b>On Account Of&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $payment_info[0]['remark']; ?></b></p>
                                    </td>
									
									
                                    
                                </tr>						
								
                            </table>
                            <br />
                            <br />
			    <table>
                                <tr>
                                    <td style="width:500px;padding:3px;">
                                        <p style="border-top:1px solid;text-align: center;width:300px;"><b> Prepared By</b></p>
                                    </td>
                                    <td style="width:400px;padding:3px;">
                                        <p style="border-top:1px solid;text-align: center;width:300px;"><b>Received By</b></p>
                                    </td>
                                </tr>
                                <br />
                               				
								
                            </table>				
							 
							
							<br/>
							
							
						
							
						
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
   }


</script>    

