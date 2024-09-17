 <div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
            <h2 style="text-align:center; ">Add Item Information </h2>
            <hr>
            <form action="<?php echo site_url('sales_item/add_sales_item_action'); ?>" method="post">
                
                
                <div class="row">
                
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-4 col-md-3  labeltext" style="text-align: right"><label for="inputdefault">Item Name  :</label></div>
                            <div class="col-sm-8 col-md-5 "><input required class="form-control" id="inputdefault" name="s_item_name" type="text"></div>
                        </div>
                    </div>
                    
                    
                   
                </div>
                
                
                
               
     
              
                
                <input type="hidden" id="count" value="1"/>
            <table class="table table-bordered" id="myTable">
                    <thead>
                     <tr class="row">
                         <th style="width:30px;padding:4px;">
                             <button style="margin-left:5px;padding-left:6px;padding-right:6px;font-size:8px;" id="button1" type="button" class="btn btn-primary pull-left"><span class='glyphicon glyphicon-plus'></span></button>   
                         </th>
                         <th>Material <sup style='color:red'>*</sup></th>
                         <th>Quantity(Kg)</th>
                         <th>Price</th>
                        


                      </tr>
                    </thead>
                    <tbody>

                      <tr class="row" id="row_1">
                          <td></td>
                          <td> <select required style="width:200px;" class="e1" style="width:100px;" id="item_c_1" name="m_id[]" >
                                    <option value="">Select Item</option>
                                    <?php foreach($materials as $material){ ?>
                                        <option value="<?php echo $material['m_id'];  ?>"><?php if(!empty($material['m_name'])) echo $material['m_name']; ?></option>
                                    <?php } ?>
                                </select></td>
                        <td><input  style="width:140px;"  type="text"  name="quantity[]" id="item_des_c1_1" class="issue"></td>
                         <td><input  style="width:140px;"  type="text"  name="price[]" id="item_des_c1_1" class="issue"></td>
                        
                      </tr>
                      </tbody>
                  </table>
                <div class="row">
                   
                        <div class="row">
                            <div class="col-md-2 ">
                                <button type="submit" class="btn btn-primary button">SAVE</button>
                            </div>
                            <div class="col-md-2">
                                <a href="<?php echo site_url('backend/sales_item') ?>" > <button type="button" class="btn btn-success button">GO BACK</button> </a>

                          </div>       
                 
                </div>
                   
                    <div class="col-md-2">
                        <div class="row">
                  <!--          
                    <div class="col-md-12">
                        <button type="button" class="btn btn-default button">SIMILAR LIST</button>
                    </div>-->
                        </div>
                    </div>
                </div>
                
            </form>
        </div>

    <script type="text/javascript">
        $('#button1').click(function () {
        var count = $('#count').val();
        var itemstr=$('#item_c_1').html();
        
        var str= '<tr class="row" id="row_' + (Number(count) + 1) + '">';
        str +='<td><button style="padding-left:6px;padding-right:6px;font-size:8px;" id="button2" onclick="removeRow(' + (Number(count) + 1) + ')" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-minus"></span></button></td>'; 
        str +='<td><select required class="e1" style="width:200px;"  name="m_id[]" id="item_c_'+(Number(count) + 1) + '" class="">'+itemstr+'</select></td>';
        str +='<td><input  style="width:140px;"  type="text"  name="quantity[]" id="item_des_c1_'+(Number(count) + 1) + '" class="issue"></td>';
        str +='<td><input  style="width:140px;"  type="text"  name="price[]" id="item_price_'+(Number(count) + 1) + '" class="issue"></td>';
       
        str +='</tr>';
       
        $('#count').val(Number(count) + 1);
        $('#myTable').append(str);
        $('select.e1').select2();
        $('.chzn-container').remove();
    });
    
    function removeRow(row) {
        $('#row_' + row).remove();
    }

    </script>
                    