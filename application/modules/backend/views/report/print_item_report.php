
<style>
    #content-table{
        line-height: 18px !important;
    }
    .table{
        
    }
    
</style>



 
<div style="padding:0" class="col-md-10 col-md-offset-1">
   
            
    <h2 style=" font-size:18px;text-align: center;">Wahid Construction Ltd.</h>

    <p style=" text-align: center;text-decoration: underline;">Item Report</p>
    
       <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
            <thead>
               
                                <tr>
                                    <th style="border-left:1px solid;border-top:1px solid;width:100px;" >Item Group</th>
                                    <th style="border-left:1px solid;border-top:1px solid;width:100px;" >Item Code</th>
                                    <th  style="border-left:1px solid;border-top:1px solid;width:200px;">Item Name</th>
                                    <th  style="border-left:1px solid;border-top:1px solid;width:100px;">Item Type </th>
                                    <th  style="border-left:1px solid;border-top:1px solid;border-right: 1px solid;width:100px;">Current Stock </th>
                                    
                                </tr>
                              
                            </thead>
                             <tbody>
                                     <?php if(!empty($data)){ ?>
                                                <?php $count=count($data); $i=0; foreach($data as $data_info){$i++; ?> 
                                                        <?php if($count==$i){ ?>
                                                            <tr>
                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: center;"><?php echo $data_info['item_group']; ?></td>
                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: center;"><?php echo $data_info['item_code']; ?></td>
                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: center;"><?php echo $data_info['item_name']; ?></td>
                                                                <td style="border-left:1px solid;border-top:1px solid;border-bottom:1px solid;text-align: center;"><?php echo $data_info['item_type']; ?></td>
                                                                
                                                                <td style="border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;text-align: right;"><?php echo $data_info['stock_amount']; ?></td>

                                                            </tr>
                                                    <?php }else{ ?>
                                                              <tr>
                                                                <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['item_group']; ?></td>
                                                                <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['item_code']; ?></td>
                                                                <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['item_name']; ?></td>
                                                                <td style="border-left:1px solid;border-top:1px solid;text-align: center;"><?php echo $data_info['item_type']; ?></td>
                                                                <td style="border-left:1px solid;border-top:1px solid;border-right: 1px solid;text-align: right;"><?php echo $data_info['stock_amount']; ?></td>

                                                            </tr>
                                                    <?php } ?>        
                                                <?php } ?>
                                     <?php }else{ ?>
                                            <tr>
                                                <td colspan="16" style="text-align:center;border-left:1px solid;border-top:1px solid;border-right:1px solid;border-bottom:1px solid;">No Data Found</td>
                                            </tr>
                                     <?php } ?>
                            </tbody>

        </table>
    <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
        
    </table>
        
    
</div>
<div class="clearfix"></div>