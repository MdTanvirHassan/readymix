<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3 style="float:left;">Details Issue Info</h3>
                <a target="_blank" style="float:right;margin-top:10px;" href="<?php echo site_url('general_store/details_issue_session/'.$issue[0]['issue_id'].'/true'); ?>" class="btn btn-sm btn-warning">PRINT</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content"> 
    
    
    
             
<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Issue NO</th>
                                    <th>SR/Indent</th>
                                    <th>Date</th>
                                    <th>Project </th>
                                    <th>Date</th>
                                    <th>Issue Type:</th>
                                    <th>Remarks </th>
                                    <th>Action</th>

                                </tr>   
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php if(!empty($issue[0]['issue_no'])) echo $issue[0]['issue_no']; ?></td>
                                    <td>
                                        <?php foreach($indents as $indent){ ?>
                                        <?php if(!empty($issue[0]['issue_ipo_no']) && $issue[0]['issue_ipo_no']==$indent['ipo_m_id'] )  echo $indent['dep_description'].'('.$indent['ipo_number'].')'; ?>
                                    <?php } ?>
                                    </td>
                                    <td><?php if(!empty($issue[0]['issue_date'])) echo date('d-m-Y',strtotime($issue[0]['issue_date'])); ?></td>
                                    <td><?php if(!empty($issue[0]['dep_name'])) echo $issue[0]['dep_name']; ?></td>
                                    <td><?php if(!empty($issue[0]['issue_ipo_date'])) echo date('d-m-Y',strtotime($issue[0]['issue_ipo_date'])); ?></td>
                                    <td><?php echo $issue[0]['issue_type'];?></td>
                                    <td><?php if(!empty($issue[0]['isssue_remark'])) echo $issue[0]['isssue_remark']; ?></td>
                                    


                                    <td>
                                      <a href="<?php echo site_url('general_store/add_issue_session'); ?>" class="btn btn-sm btn-primary">ADD ISSUE</a>
             <a href="<?php echo site_url('general_store/edit_issue_session/'.$issue[0]['issue_id']); ?>" class="btn btn-sm btn-info">EDIT ISSUE</a>
             
                                    </td>
                                </tr>
                            </tbody>
                        </table>
    
    
    
            
            
          
            
               
             
                
                 
                
                
                   
                
                
            <h2 style="text-align:center; ">Item List & information</h2>
             <hr>
      <?php if (!empty($issue_details)) { ?> 
            <input type="hidden" id="count" value="<?php echo count($issue_details); ?>"/>
             <table class="table table-bordered" id="myTable">
            <thead>
              <tr class="row">
               
                <th>Item Code</th>
                <th>Item Description</th>
                <th>MU</th>
                <th>Indent Qnt</th>
                <th>Stock Qnt</th>
                <th>MRR Qnt</th>
                <th>Issue Qnt</th>
                <th>Unit Price</th>
                <th>Issue value</th>
             
                <th>Remark</th>
              </tr>
            </thead>
            <tbody>
            <?php $i = 0;
              foreach ($issue_details as $issue_detail) {
                  $i++; ?> 
              <tr class="row" id="row_<?php echo $i; ?>">
                 
                   <td> 
                       
                       <?php if(!empty($issue_detail['item_code'])) echo $issue_detail['item_code']; ?>
                   </td>
                <td><?php if (!empty($issue_detail['item_name_des'])) echo $issue_detail['item_name_des']; ?></td>
                <td><?php if (!empty($issue_detail['issue_m_unit'])) echo $issue_detail['issue_m_unit']; ?>"</td>
                <td><?php if (!empty($issue_detail['indent_qty'])) echo $issue_detail['indent_qty']; ?></td>
                <td><?php if (!empty($issue_detail['stock_qty'])) echo $issue_detail['stock_qty']; ?></td>
                <td><?php if (!empty($issue_detail['mrr_qty'])) echo $issue_detail['mrr_qty']; ?></td>
                <td><?php if (!empty($issue_detail['issue_quality'])) echo $issue_detail['issue_quality']; ?></td>
                <td><?php if (!empty($issue_detail['issue_unit_price'])) echo $issue_detail['issue_unit_price']; ?></td>
                <td><?php if (!empty($issue_detail['issue_value'])) echo $issue_detail['issue_value']; ?>"</td>
               
                <td><?php if (!empty($issue_detail['issue_d_remark'])) echo $issue_detail['issue_d_remark']; ?></td>

              </tr>
              </tbody>
         <?php } ?>          
          </table>
  <?php } else{ ?>
              
              
               <input type="hidden" id="count" value="1"/>
             <table class="table table-bordered" id="myTable">
            <thead>
              <tr class="row">
               
                <th>Item Code</th>
                <th>Item Description</th>
                <th>M.unit</th>
                <th>Issue Quality</th>
                <th>Unit Price</th>
                <th>Issue value</th>
              
                <th>Remark</th>
              </tr>
            </thead>
            <tbody>
               <tr class="row" id="row_1">
                  
                   <td> <select disabled id="item_1" name="item_id[]">
                            <option value="">Select Item</option>
                            <?php foreach($items as $item){ ?>
                                 <option value="<?php echo $item['id'];  ?>"><?php if(!empty($item['item_code'])) echo $item['item_name']."(". $item['item_code'].")"; ?></option>
                            <?php } ?>
                        </select></td>
                <td><input disabled type="text" name="item_name_des[]" class="issue"></td>
                <td><input disabled type="text" name="issue_m_unit[]" class="issue"></td>
                <td><input disabled type="text" name="issue_quality[]" class="issue"></td>
                <td><input disabled type="text" name="issue_unit_price[]" class="issue"></td>
                <td><input disabled type="text" name="issue_value[]" class="issue"></td>
              
                <td><input disabled type="text" name="issue_d_remark[]" class="issue"></td>

              </tr>
              </tbody>
          </table>
              
  <?php } ?>            
 
            
             <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                    
                           
                    <div class="col-md-2">
                        <a href="<?php echo site_url('backend/general_store/issue_session') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>
                   
                    </div>
                        
                </div>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                    <div class="col-md-12">
                   <!--     <button type="button" class="btn btn-default button">SIMILAR LIST</button>-->
                    </div>
                        </div>
                    </div>
                </div>
            
            
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

<script>
   

    $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr=$('#item_1').html();

        
        
        var str= '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str +='<td><button id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>';
         str +='<td><select name="item_id[]" id="item_'+(Number(count) + 1) + '" class="form-control">'+itemstr+'</select></td><td><input type="text" name="item_name_des[]" class="issue"></td> <td><input type="text" name="issue_m_unit[]" class="issue"></td><td><input type="text" name="issue_quality[]" class="issue"></td> <td><input type="text" name="issue_unit_price[]" class="issue"></td> <td><input type="text" name="issue_value[]" class="issue"></td><td> <td><input type="text" name="issue_d_remark[]" class="issue"></td></tr>';
        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
        $('.datepicker').datepicker({
            format: 'DD-MM-YYYY'
        });    
//        $('.time').datetimepicker();
//        $('.datepicker').datetimepicker({
//            format: 'DD-MM-YYYY'
//        });                                     
//        $('.monthpicker').datetimepicker({
//            format: 'YYYY-MM'
//        });
      //  $('select.e1').select2();
        $('.chzn-container').remove();
    });

    function removeRow(row) {
        $('#row_' + row).remove();
    }

    $(document).ready(function () {

    //    $('select.e1').select2();
    });

</script>

