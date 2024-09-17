<style type="text/css">
    * {box-sizing: border-box}

/* Style the tab */
.tab {
  float: left;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  width: 30%;
  height: 300px;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 22px 16px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 0px 12px;
 /* border: 1px solid #ccc; */
  width: 70%;
  border-left: none;
  
}
</style>

<div class="right_col" style="background-color: #f1f1f1;padding-bottom:20px;">
    <div class="os-tabs-w menu-shad">
             <?php       
                 require_once(__DIR__ .'/../../rm_setup_header.php');
             ?>
    </div>

    <div class="">
      
        <div class="page-title">
            <div class="title_center">
                <h3>Details Customer</h3>
            </div>
        </div>
      
        <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  
                <div class="x_panel">
                    <div class="x_content">
                        
                        
                        <div class="tab">
                            <button id="defaultOpen" class="tablinks" onclick="openCity(event, 'Profile')">Profile</button>
                            <button class="tablinks" onclick="openCity(event, 'Sales Orders')">Sales Order</button>
                            <button class="tablinks" onclick="openCity(event, 'Bills')">Bills</button>
                            <button class="tablinks" onclick="openCity(event, 'Projects')">Projects</button>
                       </div>

                        <div id="Profile" class="tabcontent">
                                  <div class="row">
                                <h2><b>Company Info</b></h2>
                                    <div class='form-group' >
                                    <label for="title" class="col-sm-2 control-label">
                                        C. ID<sup class="required">*</sup>  :
                                    </label> 
                                    <div class="col-sm-4 input-group" style="margin-top:7px;">    
                                        <b><?php if (!empty($customer_info[0]['c_code'])) echo $customer_info[0]['c_code']; ?></b>
                                    </div>
                                    <label for="title" class="col-sm-2 control-label">
                                        Company Name<sup class="required">*</sup> :
                                    </label>
                                    <div class="col-sm-4 input-group" style="margin-top:7px;"> 
                                        <b><?php if (!empty($customer_info[0]['c_name'])) echo $customer_info[0]['c_name']; ?></b>
                                    </div>

                                </div>
                            </div> 
                            
                            <div class="row">
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            S. Name<sup class="required">*</sup>  :
                                        </label> 
                                        <div class="col-sm-4 input-group" style="margin-top:7px;">
                                            
                                            <b><?php if (!empty($customer_info[0]['c_short_name'])) echo $customer_info[0]['c_short_name']; ?></b>
                                            
                                        </div>
                                         <label for="title" class="col-sm-2 control-label">
                                            Address<sup class="required">*</sup>  :
                                        </label> 
                                        <div class="col-sm-4 input-group" style="margin-top:7px;">
                                            
                                            <b><?php if (!empty($customer_info[0]['c_contact_address'])) echo $customer_info[0]['c_contact_address']; ?></b>
                                           
                                        </div>
                                        

                                    </div>

                            </div>
                            
                            <div class="row">
                                    <div class='form-group' >
                                     <label for="title" class="col-sm-2 control-label">
                                         H. O. Mobile No.<sup class="required">*</sup>  :
                                     </label> 
                                     <div class="col-sm-4 input-group" style="margin-top:7px;">
                                         
                                         <b><?php if (!empty($customer_info[0]['head_office_mobile_no'])) echo $customer_info[0]['head_office_mobile_no']; ?></b>
                                         
                                     </div>
                                     
                                      <label for="title" class="col-sm-2 control-label">
                                         H. O. Phone<sup class="required">*</sup>  :
                                     </label> 
                                     <div class="col-sm-4 input-group" style="margin-top:7px;">
                                         
                                         <b><?php if (!empty($customer_info[0]['head_office_phone_no'])) echo $customer_info[0]['head_office_phone_no']; ?></b>
                                         
                                     </div>
                                        
                                 </div> 
                            </div>
                            
                            
                            <div class="row">
                                <div class='form-group' >
                                    
                                    <label for="title" class="col-sm-2 control-label">
                                         H.O. Email<sup class="required"></sup> :
                                     </label>
                                     <div class="col-sm-4 input-group" style="margin-top:7px;">
                                        
                                         <b><?php if (!empty($customer_info[0]['head_office_email'])) echo $customer_info[0]['head_office_email']; ?></b>
                                       
                                     </div>
                                    
                                    <label for="title" class="col-sm-2 control-label">
                                       Tin No.<sup class="required"></sup>  :
                                    </label> 
                                    <div class="col-sm-4 input-group" style="margin-top:7px;">
                                        
                                        <b><?php if (!empty($customer_info[0]['tin_no'])) echo $customer_info[0]['tin_no']; ?></b>
                                        
                                    </div>
                                   

                                </div>
                            </div>     
                            
                             <div class="row">
                                <div class='form-group' >
                                   
                                    <label for="title" class="col-sm-2 control-label">
                                        Vat Reg.<sup class="required"></sup> :
                                    </label>
                                    <div class="col-sm-4 input-group" style="margin-top:7px;">
                                       
                                        <b><?php if (!empty($customer_info[0]['vat_reg'])) echo $customer_info[0]['vat_reg']; ?></b>
                                        
                                    </div>

                                </div>
                            </div>     
                            
                            <div class="row">
                                
                                <h2><b>Key Person Info</b></h2>
                                <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            Key. P<sup class="required"></sup> :
                                        </label>
                                        <div class="col-sm-4 input-group" style="margin-top:7px;">
                                            
                                            <b><?php if (!empty($customer_info[0]['key_person'])) echo $customer_info[0]['key_person']; ?></b>
                                            
                                       </div>
                                        <label for="title" class="col-sm-2 control-label">
                                            Phone<sup class="required"></sup> :
                                        </label>
                                        <div class="col-sm-4 input-group" style="margin-top:7px;">
                                            <b><?php if (!empty($customer_info[0]['key_person_phone'])) echo $customer_info[0]['key_person_phone']; ?></b>       
                                       </div>
                                      
                                    </div>
                                
                               </div> 
                            
                            
                            <div class="row">
                                
                               <div class='form-group' >  
                                   
                                    <label for="title" class="col-sm-2 control-label">
                                            Email<sup class="required"></sup>  :
                                        </label> 
                                        <div class="col-sm-4 input-group" style="margin-top:7px;">
                                            
                                            <b><?php if (!empty($customer_info[0]['key_person_email'])) echo $customer_info[0]['key_person_email']; ?></b>
                                            
                                        </div> 
                                 
                               </div>  
                                
                            </div>  
                            
                            <div class="row">
                                    <h2><b>Contact Person Info</b></h2>
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            C. person<sup class="required">*</sup> :
                                        </label>
                                        <div class="col-sm-4 input-group" style="margin-top:7px;">
                                            
                                            <b><?php if (!empty($customer_info[0]['c_contact_person'])) echo $customer_info[0]['c_contact_person']; ?></b>
                                            
                                        </div>
                                        
                                        <label for="title" class="col-sm-2 control-label">
                                            Phone<sup class="required">*</sup>  :
                                        </label> 
                                        <div class="col-sm-4 input-group" style="margin-top:7px;">
                                           
                                            <b><?php if (!empty($customer_info[0]['c_mobile_no'])) echo $customer_info[0]['c_mobile_no']; ?></b>
                                           
                                        </div>

                                        
                                        

                                    </div>
                            </div> 
                            <div class="row">
                                    <div class='form-group' >
                                        <label for="title" class="col-sm-2 control-label">
                                            Email<sup class="required">*</sup> :
                                        </label>
                                        <div class="col-sm-4 input-group" style="margin-top:7px;">
                                            
                                            <b><?php if (!empty($customer_info[0]['c_email'])) echo $customer_info[0]['c_email']; ?></b>
                                            
                                        </div>
                                        
                                    </div>
                            </div>     
                        </div>

                        <div id="Sales Orders" class="tabcontent">
                                 <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-1">Date</th>
                                                <th class="col-lg-1">Order No.</th>
                                                <th class="col-lg-1">Quotation No.</th>
                                               
                                                <th class="col-lg-1">Project Name</th>
                                                <th class="col-lg-1">Amount</th>
                                                <th class="col-lg-1">Do.Status</th>

                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php if (count($sale_orders)) {
                                            foreach ($sale_orders as $order) { ?>
                                                <tr>
                                                    <td>
                                                        <?php if(!empty($order['sale_order_date'])) echo date('d-m-Y',strtotime($order['sale_order_date'])); ?>
                                                    </td>
                                                    <td>
                                                        <?php if(!empty($order['order_no'])) echo $order['order_no']; ?>
                                                    </td>
                                                    <td>
                                                        <?php if(!empty($order['reference_no'])) echo $order['reference_no']; ?>
                                                    </td>
                                                  
                                                    <td>
                                                        <?php if(!empty($order['project_name'])) echo $order['project_name']; ?>
                                                    </td>
                                                    <td>
                                    <?php if(!empty($order['total_amount'])) echo $order['total_amount']; ?>
                                                    </td>
                                                    <td>
                                                            <?php
                                                            //if(!empty($order['status'])) echo $order['status']; 
                                                             if(!empty($order['delivery_order_status'])) echo $order['delivery_order_status']; 
                                                            ?>

                                                    </td>



                                                </tr>
                                <?php }
                            } ?>
                                    </tbody>
                                </table>
                        </div>

                        <div id="Bills" class="tabcontent">
                                      <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                <th class="col-lg-1">Date</th>
                <th class="col-lg-1"> Invoice No.</th>
                <th class="col-lg-1"> Delivery No.</th>
              
                <th class="col-lg-1">Project Name</th>
                <th class="col-lg-1">Amount</th>
                <th class="col-lg-1">Status</th>
              
            </tr>
        </thead>
        <tbody>
            <?php if (count($invoices)) {
                foreach ($invoices as $invoice) { ?>
                    <tr>
                        <td>
                            <?php if(!empty($invoice['sale_invoice_date'])) echo date('d-m-Y',strtotime($invoice['sale_invoice_date'])); ?>
                        </td>
                        <td>
                            <?php if(!empty($invoice['inv_no'])) echo $invoice['inv_no']; ?>
                        </td>
                        <td>
                            <?php if(!empty($invoice['delivery_no'])) echo $invoice['delivery_no']; ?>
                        </td>
                        <td>
        <?php if(!empty($invoice['c_name'])) echo $invoice['c_name']; ?>
                        </td>
                        
                        <td>
        <?php if(!empty($invoice['total_amount'])) echo $invoice['total_amount']; ?>
                        </td>
                        <td>
        <?php if(!empty($invoice['status'])) echo $invoice['status']; ?>
                        </td>
                       

                       
                    </tr>
    <?php }
} ?>
        </tbody>
    </table>
                        </div> 
                        
                       <div id="Projects" class="tabcontent">
                                            <table id="datatable" class="table table-striped table-bordered table-hover dataTable no-footer">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-lg-2">Project Name</th>

                                                            <th class="col-lg-2">Contact Person</th>
                                                            <th class="col-lg-2">Contact Number</th>
                                                            <th class="col-lg-2">Address</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (count($projects)) {
                                                            foreach ($projects as $project) { ?>
                                                                <tr>

                                                                    <td>
                                                                        <?php if(!empty($project['project_name'])) echo $project['project_name']; ?>
                                                                    </td>

                                                                    <td>
                                                                        <?php if(!empty($project['contact_person'])) echo $project['contact_person']; ?>
                                                                    </td>

                                                                    <td>
                                                                        <?php if(!empty($project['contact_no'])) echo $project['contact_no']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if(!empty($project['address'])) echo $project['address']; ?>
                                                                    </td>


                                                                </tr>
                                                <?php }
                                            } ?>
                                                    </tbody>
                                             </table>
                        </div>   

                      
                          
                            

                            

                        
                            

                    

                      
                    </div>
                </div>
               </div>
                <div class="form-group" style="margin-top: 40px;">
                        <div class="col-sm-2">
                            <a href="<?php echo site_url('backend/raw_materials/customers') ?>" > <button type="button" class="btn btn-success button" style="padding:6px 4px;">GO BACK</button> </a>
                        </div>



                  </div>
        </div>
    </div>
</div>


<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>


<script type="text/javascript">
    function validation() {
        var name = $('#customer_name').val();
        var c_short_name = $('#c_short_name').val();
        var c_contact_address = $('#c_contact_address').val();
        var head_office_mobile_no = $('#head_office_mobile_no').val();
        var head_office_email = $('#head_office_email').val();
        var tin_no = $('#tin_no').val();
        var vat_reg = $('#vat_reg').val();
        
        var key_person = $('#key_person').val();
        var key_person_email = $('#key_person_email').val();
        
       
        var c_contact_person = $('#c_contact_person').val();
        var c_mobile_no = $('#c_mobile_no').val();
        var c_email = $('#c_email').val();
        
        var error = false;

        if (name == '') {
            $('#customer_name').css('border', '1px solid red');
            $('#customer_name_error').html('Please fill name field');
            error = true;

        } else {
            $('#customer_name').css('border', '1px solid #ccc');
            $('#customer_name_error').html('');

        }
        if (c_short_name == '') {
            $('#c_short_name_error').html('Please fill short name field');
            $('#c_short_name').css('border', '1px solid red');
            error = true;
        } else {
            $('#c_short_name_error').html('');
            $('#c_short_name').css('border', '1px solid #ccc');

        }
        
        if (c_contact_address == '') {
            $('#c_contact_address_error').html('Please fill address field');
            $('#c_contact_address').css('border', '1px solid red');
            error = true;
        } else {
            $('#c_contact_address_error').html('');
            $('#c_contact_address').css('border', '1px solid #ccc');

        }
        
        
        if (head_office_mobile_no == '') {
            $('#head_office_mobile_no_error').html('Please fill head office phone field');
            $('#head_office_mobile_no').css('border', '1px solid red');
            error = true;
        } else {
            $('#head_office_mobile_no_error').html('');
            $('#head_office_mobile_no').css('border', '1px solid #ccc');

        }

        
        
        
        if (head_office_email == '') {
//            $('#head_office_email_error').html('Please fill head office email field');
//            $('#head_office_email').css('border', '1px solid red');
//            error = true;
        } else {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(head_office_email)) {
                $('#head_office_email_error').html('Invalid email address');
                $('#head_office_email').css('border', '1px solid red');
                error = true;
            } else {
                $('#head_office_email_error').html('');
                $('#head_office_email').css('border', '1px solid #ccc');
            }


        }
        
//         if (tin_no == '') {
//            $('#tin_no_error').html('Please fill tin number field');
//            $('#tin_no').css('border', '1px solid red');
//            error = true;
//        } else {
//            $('#tin_no_error').html('');
//            $('#tin_no').css('border', '1px solid #ccc');
//
//        }
//        
//        
//        if (vat_reg == '') {
//            $('#vat_reg_error').html('Please fill  vat registration number field');
//            $('#vat_reg').css('border', '1px solid red');
//            error = true;
//        } else {
//            $('#vat_reg_error').html('');
//            $('#vat_reg').css('border', '1px solid #ccc');
//
//        }

//        if (key_person == '') {
//            $('#key_person_error').html('Please fill key person field');
//            $('#key_person').css('border', '1px solid red');
//            error = true;
//        } else {
//            $('#key_person_error').html('');
//            $('#key_person').css('border', '1px solid #ccc');
//
//        }

        if (key_person_email == '') {
//            $('#c_email_error').html('Please fill email field');
//            $('#c_email').css('border', '1px solid red');
//            error = true;
        } else {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(key_person_email)) {
                $('#key_person_email_error').html('Invalid email address');
                $('#key_person_email').css('border', '1px solid red');
                error = true;
            } else {
                $('#key_person_email_error').html('');
                $('#key_person_email').css('border', '1px solid #ccc');
            }


        }

       
       if(c_contact_person == '') {
            $('#c_contact_person_error').html('Please fill contact person field');
            $('#c_contact_person').css('border', '1px solid red');
            error = true;
        } else {
            $('#c_contact_person_error').html('');
            $('#c_contact_person').css('border', '1px solid #ccc');

        }

       
       
        if (c_mobile_no == '') {
            $('#c_mobile_no_error').html('Please fill mobile number field');
            $('#c_mobile_no').css('border', '1px solid red');
            error = true;
        } else {

            $('#c_mobile_no_error').html('');
            $('#c_mobile_no').css('border', '1px solid #ccc');


        }

        if (c_email == '') {
            $('#c_email_error').html('Please fill email field');
            $('#c_email').css('border', '1px solid red');
            error = true;
        } else {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(c_email)) {
                $('#c_email_error').html('Invalid email address');
                $('#c_email').css('border', '1px solid red');
                error = true;
            } else {
                $('#c_email_error').html('');
                $('#c_email').css('border', '1px solid #ccc');
            }


        }

        if (error == true) {
            return false;
        }
    }

//    $('#save').onClick(function(){
//          alert('test');
//        var name=$('#customer_name').val();
//        if(name==''){
//            $('#customer_name_error').html('Please fill name field');
//            return false;
//        }
////        $('#task_name').css('border','1px solid #ccc');
//    }
</script>    