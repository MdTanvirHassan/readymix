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
                <h3>Add L/C</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" method="post" action="<?php echo site_url('imports/lc/edit_action_lc/'.$lc_info[0]['lc_id']) ?>">
                            <div class="row">
                                <div class='form-group'>
                                    <label for="title" class="col-sm-2 control-label">
                                        L/C Number:
                                    </label>

                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input readonly class="form-control" id="inputdefault" name="lc_no" type="text" value="<?php echo $lc_info[0]['lc_no']; ?>">
                                    </div>

                                    <label for="title" class="col-sm-2 control-label">
                                        Sales Contact<sup class="required">*</sup>:
                                    </label>
                                    <div class="col-sm-4 input-group">

                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <select required class="form-control" id="sales_contact_id" name="sales_contact_id" onchange="javascript:getContactDetails();">
                                            <option value=''>Select Sales Contact</option>
                                            <?php foreach ($contacts as $contact) { ?>
                                                <option <?php if($contact['id']==$lc_info[0]['sales_contact_id']) echo "selected"; ?> value="<?php echo $contact['id']; ?>"><?php if (!empty($contact['contact_no'])) echo $contact['contact_no']; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>


                                </div>
                            </div>
                            <div class="row">
                                <div class='form-group'>

                                    <label for="title" class="col-sm-2 control-label">
                                        Party Bank <sup class="required">*</sup>:
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                        <select required class="form-control" name="party_bank">
                                            <option value=''>Select Bank</option>
                                            <?php foreach ($party_bank as $bnk) { ?>
                                                <option <?php if($bnk['id']==$lc_info[0]['party_bank']) echo "selected"; ?> value="<?php echo $bnk['id']; ?>"><?php if (!empty($bnk['b_name'])) echo $bnk['b_name']; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>


                                    <label for="title" class="col-sm-2 control-label">
                                        Our Bank <sup class="required">*</sup>:
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                        <select required class="form-control" name="our_bank">
                                            <option value=''>Select Bank</option>
                                            <?php foreach ($self_bank as $bnk) { ?>
                                                <option <?php if($bnk['id']==$lc_info[0]['our_bank']) echo "selected"; ?> value="<?php echo $bnk['id']; ?>"><?php if (!empty($bnk['b_name'])) echo $bnk['b_name'] . ' (' . $bnk['b_account_no'] . ')'; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>





                                </div>

                            </div>



                            <div class="row">
                                <div class='form-group'>


                                    <label for="title" class="col-sm-2 control-label">
                                        L/C Date <sup class="required">*</sup>
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                        <input required class="form-control datepicker" name="date" type="text" value="<?php echo date('d-m-Y',strtotime($lc_info[0]['date'])); ?>">
                                    </div>
                                    <label for="title" class="col-sm-2 control-label">
                                        Shipment Date <sup class="required">*</sup>
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                                        <input required class="form-control datepicker" name="shipment_date" type="text" value="<?php echo date('d-m-Y',strtotime($lc_info[0]['shipment_date'])); ?>">
                                    </div>


                                </div>
                            </div>
                            <div class="row">
                                <div class='form-group'>


                                    <label for="title" class="col-sm-2 control-label">
                                        Tanor :
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" id="tanor" name="tanor" type="text" value="<?php echo $lc_info[0]['tanor']; ?>">

                                    </div>

                                    <label for="title" class="col-sm-2 control-label">
                                        Validity(Days) :
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" id="validity" name="validity" type="text" value="<?php echo $lc_info[0]['validity']; ?>">


                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class='form-group'>


                                    <label for="title" class="col-sm-2 control-label">
                                        Master L/C :
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" id="master_lc" name="master_lc" type="text" value="<?php echo $lc_info[0]['master_lc']; ?>" >

                                    </div>
                                    <label for="title" class="col-sm-2 control-label">
                                        Garments Qty :
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" id="garments_qty" name="garments_qty" type="text" value="<?php echo $lc_info[0]['garments_qty']; ?>" >

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class='form-group'>


                                    <label for="title" class="col-sm-2 control-label">
                                        Trade Term :
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" id="trade_term" name="trade_term" type="text" value="<?php echo $lc_info[0]['trade_term']; ?>" >

                                    </div>
                                    <label for="title" class="col-sm-2 control-label">
                                        Issue Bank TIN :
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" id="issue_bank_tin" name="issue_bank_tin" type="text" value="<?php echo $lc_info[0]['issue_bank_tin']; ?>" >

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class='form-group'>



                                    <label for="title" class="col-sm-2 control-label">
                                        Issue Bank BIN :
                                    </label>
                                    <div class="col-sm-4 input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" id="issue_bank_bin" name="issue_bank_bin" type="text" value="<?php echo $lc_info[0]['issue_bank_bin']; ?>">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                
                            </div>
                            <input type="hidden" id="count" value="1" />
                            <table class="table table-bordered" id="myTable">
                                <thead class="thead-color">
                                    <tr>
                                       
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Code</th>
                                        <th style="vertical-align: middle;text-align: center;width:150px;">Item Name</th>
                                        <th style="vertical-align: middle;text-align: center;">Origin</th>
                                        <th style="vertical-align: middle;text-align: center;">Staple Length</th>
                                        <th style="vertical-align: middle;text-align: center;">Contact Qty<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;text-align: center;">LC Qty<sup style="color:red;">*</sup></th>

                                        <th style="vertical-align: middle;text-align: center;">Price<sup style="color:red;">*</sup></th>
                                        <th style="vertical-align: middle;text-align: center;">Total</th>





                                    </tr>
                                </thead>
                                <tbody id="mytableBody">
                                <?php 
                                $i=0;
                                foreach($lc_details as $details){ 
                                    $i++;
                                    ?>    
                                        <tr id="row_<?php echo $i; ?>" style="">

                                           <td>
                                                <input style="width:100%;"  type="hidden" id="item_name_<?php echo $i; ?>" name="sc_d_id[]" class="issue form-control" value="<?php echo $details['sc_d_id']; ?>">
                                                <input style="width:100%;" readonly type="text" id="code_<?php echo $i; ?>" name="code[]" class="issue form-control" value="<?php echo $details['item_code']; ?>">
                                           </td>

                                           <td>
                                               <input style="width:100%;"  type="hidden" id="item_name_<?php echo $i; ?>" name="item_id[]" class="issue form-control" value="<?php echo $details['item_id']; ?>">
                                                <input style="width:100%;" readonly type="text" id="item_name_<?php echo $i; ?>" name="item_name[]" class="issue form-control" value="<?php echo $details['item_name']; ?>">
                                           </td>

                                           <td>
                                                <input style="width:100%;" readonly type="text" id="origin_<?php echo $i; ?>" name="origin[]" class="issue form-control" value="<?php echo $details['origin']; ?>">
                                           </td>

                                           <td>
                                                <input style="width:100%;" readonly type="text" id="staple_length_<?php echo $i; ?>" name="staple_length[]" class="issue form-control" value="<?php echo $details['staple_length']; ?>">
                                           </td>


                                           <td>
                                                <input style="width:100%;" readonly type="text" id="contact_qty_<?php echo $i; ?>" name="sc_qty[]" class="issue form-control" value="<?php echo $details['sc_qty']; ?>">
                                           </td>

                                           <td>
                                                <input style="width:100%;" type="text" onchange="calculateTotal()" id="qty_<?php echo $i; ?>" name="qty[]" class="issue form-control" value="<?php echo $details['qty']; ?>">
                                           </td>

                                           <td><input style="width:100%;" type="text" onchange="calculateTotal()" id="price_<?php echo $i; ?>" name="price[]" class="form-control" value="<?php echo $details['price']; ?>"></td>
                                           <td><input style="width:100%;" type="text" readonly id="total_<?php echo $i; ?>" class="form-control" name="amount[]" value="<?php echo $details['amount']; ?>"></td>



                                        </tr>
                                  <?php } ?>  
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="text-align:right" colspan='7'>Total
                                            <input type="hidden" id="amount" name="amount" value="<?php echo $lc_info[0]['amount'] ?>">
                                        </th>
                                        <th style="text-align:right" id="grand_total"><?php echo $lc_info[0]['amount'] ?>

                                        </th>
                                    </tr>
                                </tfoot>

                            </table>





                            <!--    <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:12px;" id="addItem" type="button" class="btn btn-primary pull-left">Add Material Or Asset</button>-->

                            <!--  <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:12px;display:none" id="addService" type="button" class="btn btn-primary pull-left">Add Subcon Job</button>    -->






                            <div class="separator-shadow"></div>
                            <div class="row" style="margin-bottom: 20px">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('backend/imports/lc') ?>"> <button type="button" class="btn btn-success button">GO BACK</button> </a>
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary button">SAVE</button>
                                </div>
                                <div class=" col-sm-2">
                                    <button type="reset" class="btn btn-success button">CLEAR</button>
                                </div>


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
    // add by jubayer
    $('#customer_id').select2();



     function getContactDetails() {
        var con_id=$('#sales_contact_id').val();
        if (con_id != '') {
            $.ajax({
                url: '<?php echo site_url('imports/lc/get_contact_details'); ?>',
                data: {
                    'con_id': con_id
                },
                method: 'POST',
                dataType: 'json',
                success: function(msg) {
                    var str='';
                    var amount='';
                    $(msg.con_details).each(function(i, v) {
                        amount=v.rate*v.qty;
                        i++;
                        str +='<tr>';
                        str +='<td>';
                        str +='<input style="width:100%;"  type="hidden" id="sc_d_id_'+i+'" name="sc_d_id[]" class="issue form-control" value="'+v.id+'">';
                        str +='<input style="width:100%;" readonly type="text" id="code_'+i+'" name="code[]" class="issue form-control" value="'+v.item_code+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="text" id="item_name_'+i+'" name="item_name[]" class="issue form-control" value="'+v.item_name+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="text" id="origin_'+i+'" name="origin[]" class="issue form-control" value="'+v.origin+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="text" id="staple_length_'+i+'" name="staple_length[]" class="issue form-control" value="'+v.staple_lenth+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="text" id="contact_qy_'+i+'" name="contact_qty[]" class="issue form-control" value="'+v.qty+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;"  type="text" onchange="calculateTotal()" id="qty_'+i+'" name="qty[]" class="issue form-control" value="'+v.qty+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="text" onchange="calculateTotal()" id="price_'+i+'" name="price[]" class="issue form-control" value="'+v.rate+'">';
                        str +='</td>';
                        
                        str +='<td>';
                        str +='<input style="width:100%;" readonly type="text" id="amount_'+i+'" name="amount[]" class="issue form-control" value="'+amount+'">';
                        str +='</td>';
                        
                        str +='</tr>';
                       
                      //  calculateTotal();
                        
                    })
                    
                    $('#mytableBody').html(str);
                }
            })
        } else {
            $('#mytableBody').html('');
        }
    }
  

    function addRow() {
        var pistr = $('#pi_1').html();
        var productstr = $('#product_id_1').html();
        var count = $('#count').val();
        var countstr = $('#count_1').html();
        var processstr = $('#process_1').html();
        var compositionstr = $('#composition_1').html();
        var certificationstr = $('#certification_1').html();

        var str = '<tr id="row_' + (Number(count) + 1) + '">';
        str += '<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';

        str += '<td><select required class="form-control" id="pi_' + (Number(count) + 1) + '" name="pi[]">' + pistr + '</select></td>';
        str += '<td><select required class="form-control" id="product_id_' + (Number(count) + 1) + '" name="product_id[]">' + productstr + '</select></td>';
        str += '<td><select required class="form-control" id="count_' + (Number(count) + 1) + '" name="count[]">' + countstr + '</select></td>';
        str += '<td><select required class="form-control" id="process_' + (Number(count) + 1) + '" name="process[]">' + processstr + '</select></td>';
        str += '<td><select required class="form-control" id="composition_' + (Number(count) + 1) + '" name="composition[]">' + compositionstr + '</select></td>';
        str += '<td><select required class="form-control" id="certification_' + (Number(count) + 1) + '" name="certification[]">' + certificationstr + '</select></td>';
        str += '<td><input class="form-control" type="text"  name="pi_qty[]" readonly id="pi_qty_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input class="form-control" type="text"  name="qty[]" onchange="calculateTotal()" id="qty_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input class="form-control" type="text" onchange="calculateTotal()" name="price[]" id="price_' + (Number(count) + 1) + '" class="issue"></td>';
        str += '<td><input class="form-control" type="text" readonly name="total[]" id="total_' + (Number(count) + 1) + '" class="issue"></td>';


        str += '</tr>';
        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
    }

    function calculateTotal() {
        var total = 0;
        $('#mytableBody').find('tr').each(function(i, v) {
            if(i>0){
            var qty = Number($(this).find('td').eq('7').find('input').val());
            var price = Number($(this).find('td').eq('8').find('input').val());
            var tot = qty * price;
            $(this).find('td').eq('9').find('input').val(tot.toFixed(2));
            total += tot;
            }
        })
        $('#grand_total').html(total.toFixed(2))
        $('#amount').val(total.toFixed(2))
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



<script>
    $('body').on('keydown', 'input, select', function(e) {
        if (e.which === 13) {
            var self = $(this),
                form = self.parents('form:eq(0)'),
                focusable, next;
            focusable = form.find('input').filter(':visible');
            next = focusable.eq(focusable.index(this) + 1);
            if (next.length) {
                next.focus();
                //$(this).next('input').focus();
            }
            return false;
        }
    });
</script>


<script>
    //    $(document).on("keypress", "input", function(e){
    //        if(e.which == 13){
    //            var inputVal = $(this).val();
    //            alert("You've entered: " + inputVal);
    //        }
    //    });
</script>