<?php
$employee_id = $this->session->userdata('employeeId');
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
?>
<style>
    table {
        table-layout: fixed;
    }

    table th,
    table td {
        overflow: hidden;
    }

    #s2id_group {
        width: 100%;
        height: 50px;
    }
</style>
<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">

    <div class="os-tabs-w menu-shad">
        <?php 
      
            require_once(__DIR__ .'/../../imports_header.php');
        ?>
    </div>

    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3 style="float:left;">Details Landed Cost</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('imports/landed_cost/detailsLandedCost/' . $cost_info[0]['id'] . '/true'); ?>" class="btn btn-sm btn-warning">PRINT</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" method="post" action="<?php echo site_url('imports/landed_cost/edit_action_landed_cost') ?>">
                            <div class="row">
                                <div class='form-group'>
                                    <label for="title" class="col-sm-2 control-label">
                                        Cost Number:
                                    </label>

                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input readonly class="form-control" id="inputdefault" name="cost_number" type="text" value="<?php echo $cost_info[0]['cost_number']; ?>">
                                    </div>

                                    <label for="title" class="col-sm-2 control-label">
                                        Lc<sup class="required">*</sup>:
                                    </label>
                                    <div class="col-sm-4 input-group">

                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <select required class="form-control e1" id="lc_id" name="lc_id" >
                                            <option value=''>Select lc</option>
                                            <?php foreach ($lcs as $lc) { ?>
                                                <option <?php if($lc['lc_id']==$cost_info[0]['lc_id']) ?> value="<?php echo $lc['lc_id']; ?>"><?php if (!empty($lc['lc_no'])) echo $lc['lc_no'].'('.$lc['mother_vessel_name'].')'; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>


                                </div>
                            </div>
                           
                            
                            <div class="row">
                                <div class='form-group'>
                                    <label for="title" class="col-sm-2 control-label">
                                       Unit Price($):
                                    </label>

                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input readonly class="form-control" id="unit_price" name="unit_price" type="text" value="<?php echo $cost_info[0]['unit_price']; ?>">
                                    </div>

                                    <label for="title" class="col-sm-2 control-label">
                                        Under Head($):
                                    </label>

                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input readonly class="form-control" id="uh_unit_price" name="uh_unit_price" type="text" value="<?php echo $cost_info[0]['uh_unit_price']; ?>">
                                    </div>


                                </div>
                            </div>
                            
                            <div class="row">
                                <div class='form-group'>
                                    <label for="title" class="col-sm-2 control-label">
                                        BDT Rate:
                                    </label>

                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input readonly class="form-control" id="bdt_rate" name="bdt_rate" type="text" value="<?php echo $cost_info[0]['bdt_rate']; ?>">
                                    </div>

                                    <label for="title" class="col-sm-2 control-label">
                                        LC Qty:
                                    </label>

                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input readonly  class="form-control" id="lc_qty" name="lc_qty" type="text" value="<?php echo $cost_info[0]['lc_qty']; ?>">
                                    </div>


                                </div>
                            </div>


                            <div class="row">
                                
                            </div>
                            <input type="hidden" id="count" value="1" />
                            <table class="table table-bordered" id="myTable">
                                <thead class="thead-color">
                                    <tr>
                                       
                                        <th style="vertical-align: middle;text-align: center;width:250px;">Cost Head</th>
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Cash Amount</th>
                                        <th style="vertical-align: middle;text-align: center;">Bank Loan Amount</th>
                                        <th style="vertical-align: middle;text-align: center;">Total Amount</th>




                                    </tr>
                                </thead>
                                <tbody id="mytableBody">
                                   <?php 
                                   $i=0;
                                   foreach($cost_heads as $c_h){ 
                                       $i++;
                                       ?>
                                        <tr id="row_1" style="">

                                           <td>
                                                <input style="width:100%;" readonly type="hidden" id="c_h_id_<?php echo $i; ?>" name="c_h_id[]" class="issue form-control" value="<?php echo $c_h['c_h_id']; ?>">
                                                <input style="width:100%;" readonly type="text" id="name_<?php echo $i; ?>" name="code" class="issue form-control" value="<?php echo $c_h['name']; ?>">
                                           </td>

                                           <td>
                                                <input style="width:100%;" readonly  type="text" id="cash_amount_<?php echo $i; ?>" name="cash_amount[]" onkeyup="javascipt:calculateTotal();" onchange="javascipt:calculateTotal()" onblur="javascipt:calculateTotal();" class="issue form-control" value="<?php echo $c_h['cash_amount']; ?>">
                                           </td>

                                           <td>
                                                <input style="width:100%;" readonly  type="text" id="bank_loan_amount_<?php echo $i; ?>" name="bank_loan_amount[]" class="issue form-control" onkeyup="javascipt:calculateTotal();" onchange="javascipt:calculateTotal()" onblur="javascipt:calculateTotal();" value="<?php echo $c_h['bank_loan_amount']; ?>" >
                                           </td>

                                           <td>
                                                <input style="width:100%;" readonly  type="text" id="total_amount_<?php echo $i; ?>" name="total_amount[]" class="issue form-control" value="<?php echo $c_h['total_amount']; ?>">
                                           </td>




                                        </tr>
                                    
                                <?php } ?>    
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="text-align:right" colspan='3'>Total
                                            <input type="hidden" id="grand_total_amount" name="grand_total_amount">
                                        </th>
                                        <th style="text-align:right" id="grand_total"><?php echo $cost_info[0]['grand_total_amount']; ?>

                                        </th>
                                        
                                    </tr>
                                </tfoot>

                            </table>





                            





                            <div class="separator-shadow"></div>
                            <div class="row" style="margin-bottom: 20px">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/imports/landed_cost') ?>"> <button type="button" class="btn btn-success button">GO BACK</button> </a>
                                </div>

                               
                                
                                <!--
                                <div class=" col-sm-2">
                                    <button type="reset" class="btn btn-success button">CLEAR</button>
                                </div>
                                -->


                            </div>

                            <div class="row">


                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>






<script>
    

   function calculateTotal() {
        var total = 0;
        
        $('#mytableBody').find('tr').each(function(i, v) {                       
            var cash = Number($(this).find('td').eq('1').find('input').val());           
            var bank = Number($(this).find('td').eq('2').find('input').val());            
            var tot = cash+bank;
            $(this).find('td').eq('3').find('input').val(tot.toFixed(2));
            total += tot;
           
        })
        $('#grand_total').html(total.toFixed(2))
        $('#grand_total_amount').val(total.toFixed(2))
    }
    
    
    
    function calculateTotalValue(id){
        //alert('test');
        var unit_price=$('#price_'+id).val();
        var quantity=$('#qty_'+id).val();
        var amount=Number(unit_price)*Number(quantity);
        $('#amount_'+id).val(amount);
        
        
        var sub_total=0;
        var rowCount = $('#myTable tr').length;
         var table_row=Number(rowCount)-2;
        // var table_row=Number($('#count').val());
         for(var i=1;i<=table_row;i++){
             if($('.select_item_'+i).prop('checked')){
                var amt=$('#amount_'+i).val();
                sub_total=sub_total+Number(amt);
            }
             
         }    
         $('#grand_total').html(sub_total);
         $('#total_amount').val(sub_total);
    }
    
    

    function removeRow(row) {
        if (confirm('Are you sure to remove row ? ') == true)
            $('#row_' + row).remove();
    }

    $(document).ready(function() {
        $('.datepicker1').datepicker({
            // format: 'DD-MM-YYYY'
            dateFormat: 'dd-mm-yy',
            //  maxDate: new Date
        });
        //    $('select.e1').select2();
    });
</script>






