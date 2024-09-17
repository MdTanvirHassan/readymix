<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Edit Pump</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" action="<?php echo site_url('pump/edit_pump_action/'.$pumps[0]['pump_id']); ?>" method="post" onsubmit="javascript: return validation()">                
                            <div class='form-group' >
                                <label for="title" class="col-sm-1 control-label">
                                    Customer:<sup class="required">*</sup>
                                </label> 
                                <div class="col-sm-3 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select  class="e1 form-control"  id="customer_id" name="customer_id" >
                                        <option value="">Select Customer</option>
                                            <?php foreach ($customers as $customer) { ?>
                                            <option <?php if($pumps[0]['customer_id']==$customer['id']){ echo "selected";} ?> value="<?php echo $customer['id']; ?>"><?php if (!empty($customer['c_name'])) echo $customer['c_name']; ?></option>
                                            <?php } ?>
                                    </select>
                                    <span id="customer_id_error" style="color:red;"></span>
                                </div>
                                <label for="title" class="col-sm-1 control-label">
                                    Project:<sup class="required">*</sup>
                                </label>
                                <div class="col-sm-3 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select  class="e1 form-control"  id="project_id" name="project_id" >
                                        <option value="">Select project</option>
                                            <?php foreach ($project_info as $project) { ?>
                                            <option <?php if($pumps[0]['project_id']==$project['project_id']){ echo "selected";} ?> value="<?php echo $project['project_id']; ?>"><?php if (!empty($project['project_name'])) echo $project['project_name']; ?></option>
                                            <?php } ?>
                                    </select>
                                    <span id="project_id_error" style="color:red"></span>                             
                                </div>
                                <label for="title" class="col-sm-1 control-label">
                                    Pump No:
                                </label>
                                <div class="col-sm-3 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>                                   
                                    <input  required class="form-control" readonly id="pump_no" name="pump_no" type="text" value="<?php if(!empty($pumps[0]['pump_no'])) echo $pumps[0]['pump_no']; ?>"></div>

                            </div>

                            <div class='form-group' >
                                <label for="title" class="col-sm-1 control-label">
                                    Group:
                                </label>
                                <div class="col-sm-3 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="group_name" name="group_name" type="text" value="<?php if(!empty($pumps[0]['group_name'])) echo $pumps[0]['group_name']; ?>">

                                </div>
                                <label for="title" class="col-sm-1 control-label">
                                    C. Qty:<sup class="required">*</sup>
                                </label> 
                                <div class="col-sm-3 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control"  id="casting_qty" name="casting_qty" type="text" value="<?php if(!empty($pumps[0]['casting_qty'])) echo $pumps[0]['casting_qty']; ?>">
                                    <span id="casting_qty_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-1 control-label">
                                    Date:
                                </label>
                                <div class="col-sm-3 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control datepicker" id="date" name="date" type="text" value="<?php if(!empty($pumps[0]['date'])) echo $pumps[0]['date']; ?>">
                                </div>                                                             
                            </div>
                            <div class='form-group' >
                                <label for="title" class="col-sm-1 control-label">
                                    Person:<sup class="required">*</sup>
                                </label>
                                <div class="col-sm-3 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="person" name="person" type="text" value="<?php if(!empty($pumps[0]['person'])) echo $pumps[0]['person']; ?>">
                                    <span id="person_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-1 control-label">
                                    Per P.Bill:<sup class="required">*</sup>
                                </label> 
                                <div class="col-sm-3 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control"  id="per_person_bill" name="per_person_bill" type="text" value="<?php if(!empty($pumps[0]['per_person_bill'])) echo $pumps[0]['per_person_bill']; ?>">
                                    <span id="per_person_bill_error" style="color:red"></span>
                                </div>
                                <label for="title" class="col-sm-1 control-label">
                                    Total Bill:
                                </label>
                                <div class="col-sm-3 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="total_bill" name="total_bill" value="<?php if(!empty($pumps[0]['total_bill'])) echo $pumps[0]['total_bill']; ?>" readonly>

                                </div>                               
                            </div>

                            <div class='form-group' >
                                
                                <label for="title" class="col-sm-1 control-label">
                                    F. Time:<sup class="required">*</sup>
                                </label>
                                <div class="col-sm-3 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="from_time" name="from_time" type="time" value="<?php if(!empty($pumps[0]['from_time'])) echo $pumps[0]['from_time']; ?>">
                                    <span id="from_time_error" style="color:red"></span>
                                </div> 
                                <label for="title" class="col-sm-1 control-label">
                                    T. Time:<sup class="required">*</sup>
                                </label>
                                <div class="col-sm-3 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input  class="form-control" id="to_time" name="to_time" type="time" value="<?php if(!empty($pumps[0]['to_time'])) echo $pumps[0]['to_time']; ?>">
                                    <span id="to_time_error" style="color:red"></span>
                                </div> 
                                <label for="title" class="col-sm-1 control-label">
                                    Remarks:
                                </label> 
                                <div class="col-sm-3 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <textarea rows="2" class="form-control"  id="remarks" name="remarks"><?php if(!empty($pumps[0]['remarks'])) echo $pumps[0]['remarks']; ?></textarea>
                                </div>                               
                            </div>

                            <div class="form-group" style="margin-top: 40px;">
                                <div class="col-sm-2">
                                    <a href="<?php echo site_url('backend/pump') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
                                </div>
                                <div class=" col-sm-2">
                                    <button type="submit" class="btn btn-primary button">UPDATE</button>
                                </div>                               
                            </div>            

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#customer_id').change(function(){
        var c_id=$('#customer_id').val();
         var data = {'id': c_id}
            $.ajax({
                    url: '<?php echo site_url('pump/get_customer_details'); ?>',
                    data: data,
                    method: 'POST',
                    dataType: 'json',
                    success: function (msg) { 
                        
                       $('#customer_id').val(msg.customer_info[0].id);
                       $('#project_id').html('');
                       $('#project_id').append('<option value="">Select Project</option>');
                       $(msg.projects).each(function(r,v){
                           $('#project_id').append('<option value="'+v.project_id+'">'+v.project_name+'</option>');
                       })
                       
                    }
        })
    });
    
    
    function validation() {
        var customer_id = $('#customer_id').val();
        var project_id = $('#project_id').val();
        var casting_qty = $('#casting_qty').val();
        var per_person_bill = $('#per_person_bill').val();
        var person = $('#person').val();
        var to_time = $('#to_time').val();
        var from_time = $('#from_time').val();

        var error = false;
        if (customer_id == '') {
            $('#customer_id').css('border', '1px solid red');
            $('#customer_id_error').html('Please select customer');
            error = true;

        } else {
            $('#customer_id').css('border', '1px solid #ccc');
            $('#customer_id_error').html('');

        }
        if (project_id == '') {
            $('#project_id').css('border', '1px solid red');
            $('#project_id_error').html('Please fill project name field');
            error = true;

        } else {
            $('#project_id').css('border', '1px solid #ccc');
            $('#project_id_error').html('');

        }
        if (casting_qty == '') {
            $('#casting_qty').css('border', '1px solid red');
            $('#casting_qty_error').html('Please fill contact person field');
            error = true;

        } else {
            $('#casting_qty').css('border', '1px solid #ccc');
            $('#casting_qty_error').html('');

        }
        if (per_person_bill == '') {
            $('#per_person_bill_error').html('Please fill contact no field');
            $('#per_person_bill').css('border', '1px solid red');
            error = true;
        } else {
            $('#per_person_bill_error').html('');
            $('#per_person_bill').css('border', '1px solid #ccc');

        }
        if (to_time == '') {
            $('#to_time').css('border', '1px solid red');
            $('#to_time_error').html('Please fill contact person field');
            error = true;

        } else {
            $('#to_time').css('border', '1px solid #ccc');
            $('#to_time_error').html('');

        }
        if (from_time == '') {
            $('#from_time').css('border', '1px solid red');
            $('#from_time_error').html('Please fill contact person field');
            error = true;

        } else {
            $('#from_time').css('border', '1px solid #ccc');
            $('#from_time_error').html('');

        }
        if (person == '') {
            $('#person').css('border', '1px solid red');
            $('#person_error').html('Please fill contact person field');
            error = true;

        } else {
            $('#person').css('border', '1px solid #ccc');
            $('#person_error').html('');

        }
        if (error == true) {
            return false;
        }
    }

$('#per_person_bill').keyup(function(){
    var bill=$(this).val();
    var person=$('#person').val();
    var total=bill*person;
    $('#total_bill').val(total);
    
})



</script>    

