<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Daily_purchase extends Site_Controller {

    function __construct() {
        parent::__construct();
        ini_set('max_execution_time', 90000);
        set_time_limit(90000);
        ini_set('memory_limit', '-1');
        ini_set('post_max_size', '2048M');
        ini_set('max_input_time', '90000');
        if (!$this->is_logged_in($this->session->userdata('logged_in'))) {
            redirect_with_msg('backend/login', 'Please Login to see this page');
        }
        $this->load->model("m_common");
        $this->setTemplateFile('template');
        $this->user_id = $this->session->userdata('user_id');
        $this->rank = $this->session->userdata('rank');
        $this->company_id = $this->session->userdata('companyId');
        if(empty($this->company_id)){
             redirect_with_msg('backend/dashboard', 'Please click on enter here button to see this page');
        }
    }

    function index() {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'daily_purchase';
        $this->titlebackend("Purchase Orders");
       // $data['purchase_order']=$this->m_common->get_row_array('tbl_sales_purchase_order
       // $sql="select o.*,q.reference_no,c.c_name,c.c_short_name from tbl_sales_orders o left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where o.is_active=1";
       // $sql="select o.*,q.reference_no,d.dep_description,d.short_name as dep_short_name,s.SUP_NAME from tbl_purchase_orders o left join tbl_purchase_quotation q on o.q_id=q.q_id left join department d on q.unit_id=d.d_id left join supplier s on q.supplier_id=s.ID where o.is_active=1 ";
        $sql="select o.*,d.dep_description,d.short_name as dep_short_name,s.SUP_NAME,tit.type_name from tbl_purchase_orders o left join department d on o.unit_id=d.d_id left join supplier s on o.supplier_id=s.ID left join tbl_indent_type tit on o.order_type=tit.id where o.is_active=1 and o.order_from='Money Indent' and o.purchase_type='Direct' order by o_id DESC";
        $data['purchase_orders']=$this->m_common->customeQuery($sql);
        
        $this->load->view('daily_purchase/v_daily_purchase',$data);
    }

   
     function add_purchase_order() {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'daily_purchase';
        $this->titlebackend("Add purchase order ");
       // $data['items']=$this->m_common->get_row_array('tbl_sales_items','','*');
      //  $sql="select q.*,c.c_name,c.c_short_name from tbl_sales_quotation q left join tbl_customers c on q.customer_id=c.id where q.is_active=1 and q.status='Pending' ";
        $sql="select q.*,d.dep_description,s.SUP_NAME from tbl_purchase_quotation q left join department d on q.unit_id=d.d_id left join supplier s on q.supplier_id=s.ID where q.is_active=1 and q.status='Pending' ";
        $data['quotations']=$this->m_common->customeQuery($sql);
       
        $sql='select e.*,d.designation_name,d.designation_short_name from employees e left join designation d on e.designation_id=d.id ';
        $data['employees']=$this->m_common->customeQuery($sql);
        $data['indent_types'] = $this->m_common->get_row_array('tbl_indent_type',array('is_active'=>1), '*');
       // $data['indent_types'] = $this->m_common->get_row_array('tbl_indent_type',array('is_active'=>1), '*');
        $data['projects']=$this->m_common->get_row_array('department','','*');
        $data['payment_modes']=$this->m_common->get_row_array('tbl_payment_mode',array('is_active'=>1),'*');
        $data['payment_securities']=$this->m_common->get_row_array('tbl_payment_security',array('is_active'=>1),'*');
        $data['copy_to']=$this->m_common->get_row_array('tbl_copy_to',array('is_active'=>1),'*');
        $data['purchase_condition']=$this->m_common->get_row_array('tbl_purchase_condition',array('is_active'=>1),'*');
        $this->load->view('daily_purchase/v_add_daily_purchase',$data);
    }
    
    function add_purchase_order_action() {
         $branch_id=$this->session->userdata('companyId');
         $employee_id =$this->session->userdata('employeeId');
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             $insertPaymentCondition=array();
             
             if(empty($postData['select_item'])){
                redirect_with_msg('daily_purchase/add_purchase_order', 'Please Select Item');
             }
             
             if(!empty($postData['order_from'])){
                 $insertData['order_from']=$postData['order_from'];
             }
             
             $insertData['purchase_type']="Direct";
             
             if(!empty($postData['order_type'])){
                 $insertData['order_type']=$postData['order_type'];
             }
             $order_type_info=$this->m_common->get_row_array('tbl_indent_type',array('id'=>$postData['order_type']),'*');
             if(!empty($postData['unit_id'])){
                 $insertData['unit_id']=$postData['unit_id'];
             }
             
             if(!empty($postData['supplier_id'])){
                 $insertData['supplier_id']=$postData['supplier_id'];
             }
             
             if(!empty($postData['order_no'])){
                 $insertData['order_no']=$postData['order_no'];
             }
             if(!empty($postData['purchase_order_date'])){
                 $insertData['purchase_order_date']=date('Y-m-d',strtotime($postData['purchase_order_date']));
             }
             if(!empty($postData['attention'])){
                 $insertData['attention']=$postData['attention'];
             }
             if(!empty($postData['phone'])){
                 $insertData['phone']=$postData['phone'];
             }
            
             if(!empty($postData['billing_address'])){
                 $insertData['billing_address']=$postData['billing_address'];
             }
             if(!empty($postData['billing_email'])){
                 $insertData['billing_email']=$postData['billing_email'];
             }
             if(!empty($postData['shipping_address'])){
                 $insertData['shipping_address']=$postData['shipping_address'];
             }
             if(!empty($postData['shipping_email'])){
                 $insertData['shipping_email']=$postData['shipping_email'];
             }
             if($order_type_info[0]['type_name']=="Material"){ 
                if(!empty($postData['total_amount'])){
                    $insertData['total_amount']=$postData['total_amount'];
                }
             }else if($order_type_info[0]['type_name']=="Sub Contractor Job"){ 
                    if(!empty($postData['s_total_amount'])){
                       $insertData['total_amount']=$postData['s_total_amount'];
                   }
             }
             
//             if(!empty($postData['employee_id'])){
//                 $insertData['employee_id']=$postData['employee_id'];
//             }
             
             $insertData['employee_id']=$employee_id;
             //$insertData['unit_id']=$branch_id;
             //$insertData['unit_id']=$project_info[0]['unit_id'];
             $insertData['is_active']=1;
             $insertData['status']="Pending";
             $insertData['approve_status']="Pending";
             $insertData['created_date']=date('Y-m-d');
             
            
            
             
           //  $insertData['receive_status']='Pending';
             $result=$this->m_common->insert_row('tbl_purchase_orders',$insertData);
             if(!empty($result)){
                 
                 
                 $this->m_common->insert_row('tbl_purchase_order_code',array('o_code'=>$postData['o_code'],'supplier_id'=>$postData['supplier_id']));
                
                 if($order_type_info[0]['type_name']=="Sub Contractor Job"){
                     foreach ($postData['service_id'] as $key => $each) {
                            $insertData1=array();
                            $insertData1['o_id'] = $result;
                            $insertData1['service_id'] = $each;
                            $insertData1['is_active']=1;
                            if(in_array($key,$postData['select_item'])){
                                if(empty($each)){
                                    continue;
                                }
                                if(!empty($postData['indent_d_id'][$key])) {
                                    $insertData1['indent_d_id'] = $postData['indent_d_id'][$key];
                                }
                                if(!empty($postData['s_amount'][$key])) { 
                                    $insertData1['amount'] = $postData['s_amount'][$key];
                                }

                                if(!empty($postData['s_remark'][$key])) { 
                                    $insertData1['remark'] = $postData['s_remark'][$key];
                                }

                                $successs=$this->m_common->insert_row('tbl_purchase_order_details',$insertData1);
                                if(!empty($successs)){
                                    $this->m_common->update_row('ipo_material_indent_details',array('id'=>$postData['indent_d_id'][$key]),array('purchase_order_status'=>"Done"));
                                }
                            }     
                        }
                 }else{
                            foreach ($postData['item_id'] as $key => $each){
                                    $insertData1=array();
                                    $insertData1['o_id'] = $result;
                                    $insertData1['item_id'] = $each;
                                    $insertData1['is_active']=1;
                                    $insertData1['receive_status']="Pending";
                                    //if(in_array($key,$postData['select_item'])){
                                    if(in_array(($key+1),$postData['select_item'])){    
                                            if(empty($each)){
                                                continue;
                                            }

                                           if(!empty($postData['indent_d_id'][$key])) {
                                                 $insertData1['indent_d_id'] = $postData['indent_d_id'][$key];
                                           }

                                           if(!empty($postData['bu_d_id'][$key])) {
                                                 $insertData1['bu_d_id'] = $postData['bu_d_id'][$key];
                                                 
                                           } 
                                           
                                           if(!empty($postData['brand_id'][$key])) {
                                                 $insertData1['brand_id'] = $postData['brand_id'][$key];
                                                 
                                           } 
                                           
                                           
                                           if(!empty($postData['item_size'][$key])) {
                                                 $insertData1['item_size'] = $postData['item_size'][$key];
                                                 
                                           } 

                                          if(!empty($postData['mi_d_id'][$key])) {
                                                 $insertData1['mi_d_id'] = $postData['mi_d_id'][$key];
                                          }  
                                          
                                          if(!empty($postData['indent_qnty'][$key])){
                                                $insertData1['indent_qnty'] = $postData['indent_qnty'][$key];
                                          }
                                          
                                          if(!empty($postData['budget_qnty'][$key])) {
                                                $insertData1['budget_qnty'] = $postData['budget_qnty'][$key];
                                          }
                                          
                                          if(!empty($postData['m_indent_qnty'][$key])) {
                                                $insertData1['m_indent_qnty'] = $postData['m_indent_qnty'][$key];
                                          }
                                          
                                          if(!empty($postData['quantity'][$key])) {
                                                $insertData1['quantity'] = $postData['quantity'][$key];
                                          }

                                         if(!empty($postData['unit_price'][$key])) { 
                                                $insertData1['unit_price'] = $postData['unit_price'][$key];
                                          }

                                         if(!empty($postData['amount'][$key])) { 
                                               $insertData1['amount'] = $postData['amount'][$key];
                                         }

                      //                      if(!empty($postData['description'][$key])) { 
                      //                          $insertData1['description'] = $postData['description'][$key];
                      //                      }

                                        if(!empty($postData['remark'][$key])) { 
                                             $insertData1['remark'] = $postData['remark'][$key];
                                         }

                                          $success=$this->m_common->insert_row('tbl_purchase_order_details',$insertData1);
                                          if(!empty($success)){
                                              
                                                if(!empty($postData['mi_d_id'][$key])) {
                                                   
                                                        $sql="select * from tbl_money_indent_details where mi_d_id=".$postData['mi_d_id'][$key];
                                                        $pre_mi_info=$this->m_common->customeQuery($sql);
                                                        $net_order_qty=$pre_mi_info[0]['purchase_order_qty']+$postData['quantity'][$key];
                                                        if($net_order_qty==$pre_mi_info[0]['quantity']){
                                                            $mi_o_status="Done";
                                                        }else{
                                                            $mi_o_status="Partially Done";
                                                        }
                                                    
                                                         $this->m_common->update_row('tbl_money_indent_details',array('mi_d_id'=>$postData['mi_d_id'][$key]),array('purchase_order_qty'=>$net_order_qty,'purchase_order_status'=>$mi_o_status));
                                                }
                                                
                                                
                                                
                                                
                                                
                                           }
                                    }        
                                }
                 }
                  
                 
                 
                 
                 
               if(isset($_FILES['order_image']['name']) && !empty($_FILES['order_image']['name'])) {
                    $doc = $_FILES['order_image'];
                    foreach ($doc['name'] as $key => $file) {
                         if(!empty($doc['name'][$key])){
                             $filename = generateFileName();
                             $path = $doc['name'][$key];
                             $ext = pathinfo($path, PATHINFO_EXTENSION);
                             if(move_uploaded_file($doc['tmp_name'][$key], 'images/purchase_order_documents/' . $filename . '.' . $ext)) {
                                 $insertDocuData= array();
                                 $insertDocuData['file_name'] = $filename . '.' . $ext;
                                 $insertDocuData['po_id'] = $result;
                                 $this->m_common->insert_row('tbl_purchase_order_documents',$insertDocuData);
                             }
                         }
                     }
                 
               }     
                 
                 
                 
                  
                  
                  
                  
                  
                  
                  
                  
                  
                
                  
                  redirect_with_msg('daily_purchase', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('daily_purchase/add_purchase_order', 'Please fill the form and submit');
         }
         
     }
    
      function edit_purchase_order($id) {
        $branch_id= $this->session->userdata('companyId');   
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'daily_purchase';
        $this->titlebackend("Edit purchase order");
        //$sql="select q.*,c.c_name,c.c_short_name from tbl_sales_quotation q left join tbl_customers c on q.customer_id=c.id where q.is_active=1";
        
        $data['purchase_order_info']=$this->m_common->get_row_array('tbl_purchase_orders',array('o_id'=>$id),'*');
        $data['order_type_info']=$this->m_common->get_row_array('tbl_indent_type',array('id'=>$data['purchase_order_info'][0]['order_type']),'*');
        
       if($data['order_type_info'][0]['type_name']=="Material" || $data['order_type_info'][0]['type_name']=="Asset"){
          $data['suppliers']=$this->m_common->get_row_array('supplier',array('s_type'=>'Supplier'),'*'); 
       }else{
          $data['suppliers']=$this->m_common->get_row_array('supplier',array('s_type'=>'Contractor'),'*');  
       } 
        
        
//        $sql="select q.*,d.dep_description,s.SUP_NAME from tbl_purchase_quotation q left join department d on q.unit_id=d.d_id left join supplier s on q.supplier_id=s.ID where q.q_id=". $data['purchase_order_info'][0]['q_id'];
//        $data['quotations']=$this->m_common->customeQuery($sql);
        $sql='select e.*,d.designation_name,d.designation_short_name from employees e left join designation d on e.designation_id=d.id ';
        $data['employees']=$this->m_common->customeQuery($sql);
//        $data['payment_info']=$this->m_common->get_row_array('tbl_purchase_order_payment_condition',array('o_id'=>$id),'*');
        $data['payment_info']=$this->m_common->get_row_array('tbl_po_payment_condition',array('o_id'=>$id),'*');
        $data['security_info']=$this->m_common->get_row_array('tbl_po_payment_security',array('o_id'=>$id),'*');
        //$sql="select d.*,i.item_name,i.meas_unit from tbl_purchase_order_details d left join items i on d.item_id=i.id where d.is_active=1 and d.o_id=".$id;
        //$sql="select d.*,i.item_name,i.meas_unit,s.service_name from tbl_purchase_order_details d left join items i on d.item_id=i.id left join tbl_services s on d.service_id=s.id where d.is_active=1 and d.o_id=".$id;
       // $sql="select d.*,i.item_name,i.meas_unit,s.service_name,imid.indent_no from tbl_purchase_order_details d left join items i on d.item_id=i.id left join tbl_services s on d.service_id=s.id left join ipo_material_indent_details imid on d.indent_d_id=imid.id left join budget_details bd on d.bu_d_id=bd.bu_d_id left join tbl_money_indent_details mid on d.mi_d_id=mid.mi_d_id  where d.is_active=1 and d.o_id=".$id;
        $sql="select d.*,i.item_name,tmu.meas_unit,s.service_name,imid.indent_no from tbl_purchase_order_details d left join items i on d.item_id=i.id left join tbl_services s on d.service_id=s.id left join ipo_material_indent_details imid on d.indent_d_id=imid.id left join budget_details bd on d.bu_d_id=bd.bu_d_id left join tbl_money_indent_details mid on d.mi_d_id=mid.mi_d_id left join tbl_measurement_unit tmu on i.mu_id=tmu.id  where d.is_active=1 and d.o_id=".$id;
        $data['purchase_order_details_info']=$this->m_common->customeQuery($sql);
        $data['purchase_conditions']=$this->m_common->get_row_array('tbl_purchase_order_conditions',array('o_id'=>$id),'*');
        $data['copy_to']=$this->m_common->get_row_array('tbl_purchase_order_copy_to',array('o_id'=>$id),'*');
        $data['indent_types'] = $this->m_common->get_row_array('tbl_indent_type',array('is_active'=>1), '*');
        $data['projects']=$this->m_common->get_row_array('department','','*');
        $data['payment_modes']=$this->m_common->get_row_array('tbl_payment_mode',array('is_active'=>1),'*');
        $data['payment_securities']=$this->m_common->get_row_array('tbl_payment_security',array('is_active'=>1),'*');
        
        
        
         $data['purchase_order_document']= $this->m_common->get_row_array('tbl_purchase_order_documents', array('po_id'=>$id), '*');
       
        $this->load->view('daily_purchase/v_edit_daily_purchase',$data);
    }
    
    function edit_purchase_order_action($o_id) {
         $postData=$this->input->post();
         $employee_id = $this->session->userdata('employeeId');
         
         if(!empty($postData)){
             $pre_info=$this->m_common->get_row_array('tbl_purchase_orders',array('o_id'=>$o_id),'*');
             $insertData=array();
             $insertPaymentCondition=array();
             
             
             
             if(!empty($postData['order_from'])){
                 $insertData['order_from']=$postData['order_from'];
             }
             
             if(!empty($postData['order_type'])){
                 $insertData['order_type']=$postData['order_type'];
             }
             $order_type_info=$this->m_common->get_row_array('tbl_indent_type',array('id'=>$postData['order_type']),'*');
             if(!empty($postData['unit_id'])){
                 $insertData['unit_id']=$postData['unit_id'];
             }
             
             if(!empty($postData['supplier_id'])){
                 $insertData['supplier_id']=$postData['supplier_id'];
             }
             
             
            if(!empty($postData['order_no'])){
                 $insertData['order_no']=$postData['order_no'];
             }
             if(!empty($postData['purchase_order_date'])){
                 $insertData['purchase_order_date']=date('Y-m-d',strtotime($postData['purchase_order_date']));
             }
             if(!empty($postData['attention'])){
                 $insertData['attention']=$postData['attention'];
             }
             if(!empty($postData['phone'])){
                 $insertData['phone']=$postData['phone'];
             }
            
             if(!empty($postData['billing_address'])){
                 $insertData['billing_address']=$postData['billing_address'];
             }
             if(!empty($postData['billing_email'])){
                 $insertData['billing_email']=$postData['billing_email'];
             }
             if(!empty($postData['shipping_address'])){
                 $insertData['shipping_address']=$postData['shipping_address'];
             }
             if(!empty($postData['shipping_email'])){
                 $insertData['shipping_email']=$postData['shipping_email'];
             }
             
             if($order_type_info[0]['type_name']=="Material"){ 
                if(!empty($postData['total_amount'])){
                    $insertData['total_amount']=$postData['total_amount'];
                }
             }else if($order_type_info[0]['type_name']=="Sub Contractor Job"){ 
                    if(!empty($postData['s_total_amount'])){
                       $insertData['total_amount']=$postData['s_total_amount'];
                   }
             }
             
//             if(!empty($postData['employee_id'])){
//                 $insertData['employee_id']=$postData['employee_id'];
//             }
             
             $insertData['updated_by']=$employee_id;
              
             $result=$this->m_common->update_row('tbl_purchase_orders',array('o_id'=>$o_id),$insertData);
             if($result>=0){
                // $this->m_common->update_row('tbl_po_payment_condition',array('o_id'=>$o_id),array('pm_id'=>$postData['pm_id']));
                // $this->m_common->update_row('tbl_po_payment_security',array('o_id'=>$o_id),array('security_id'=>$postData['security_id']));

                 $this->m_common->delete_row('tbl_purchase_order_details',array('o_id'=>$o_id));
                if($order_type_info[0]['type_name']=="Sub Contractor Job"){
                    foreach ($postData['service_id'] as $key => $each) {
                      $insertData1=array();
                      $insertData1['o_id'] = $o_id;
                      $insertData1['service_id'] = $each;
                      $insertData1['is_active']=1;
                      
                      if(empty($each)){
                          continue;
                      }
                      
                      
                      if(!empty($postData['indent_d_id'][$key])) {
                           $insertData1['indent_d_id'] = $postData['indent_d_id'][$key];
                      }
                     
                      if(!empty($postData['s_amount'][$key])) { 
                          $insertData1['amount'] = $postData['s_amount'][$key];
                      }
                       
                      if(!empty($postData['s_remark'][$key])) { 
                          $insertData1['remark'] = $postData['s_remark'][$key];
                      }
                 
                      $successs=$this->m_common->insert_row('tbl_purchase_order_details',$insertData1);
                      if(!empty($successs)){
                          $this->m_common->update_row('ipo_material_indent_details',array('id'=>$postData['indent_d_id'][$key]),array('purchase_order_status'=>"Done"));
                      }
                  }
                }else{
                            foreach ($postData['item_id'] as $key => $each) {
                              $insertData1=array();
                              $insertData1['o_id'] = $o_id;
                              $insertData1['item_id'] = $each;
                              $insertData1['is_active']=1;
                              $insertData1['receive_status']="Pending";
                              if(empty($each)){
                                  continue;
                              }

                             if(!empty($postData['indent_d_id'][$key])) {
                                  $insertData1['indent_d_id'] = $postData['indent_d_id'][$key];
                              }

                              if(!empty($postData['bu_d_id'][$key])) {
                                   $insertData1['bu_d_id'] = $postData['bu_d_id'][$key];
                              } 
                            
                              if(!empty($postData['brand_id'][$key])) {
                                    $insertData1['brand_id'] = $postData['brand_id'][$key];

                              } 
                              
                              if(!empty($postData['item_size'][$key])) {
                                    $insertData1['item_size'] = $postData['item_size'][$key];

                              } 
                              

                             if(!empty($postData['mi_d_id'][$key])) {
                                   $insertData1['mi_d_id'] = $postData['mi_d_id'][$key];
                             }  

                             if(!empty($postData['indent_qnty'][$key])){
                                   $insertData1['indent_qnty'] = $postData['indent_qnty'][$key];
                             }

                            if(!empty($postData['budget_qnty'][$key])) {
                                  $insertData1['budget_qnty'] = $postData['budget_qnty'][$key];
                             }

                            if(!empty($postData['m_indent_qnty'][$key])) {
                                    $insertData1['m_indent_qnty'] = $postData['m_indent_qnty'][$key];
                            }

                            if(!empty($postData['quantity'][$key])) {
                                 $insertData1['quantity'] = $postData['quantity'][$key];
                            }
                           if(!empty($postData['unit_price'][$key])) { 
                                 $insertData1['unit_price'] = $postData['unit_price'][$key];
                            }
                           if(!empty($postData['amount'][$key])) { 
                                $insertData1['amount'] = $postData['amount'][$key];
                           }


                           if(!empty($postData['remark'][$key])) { 
                               $insertData1['remark'] = $postData['remark'][$key];
                           }

                              $success=$this->m_common->insert_row('tbl_purchase_order_details',$insertData1);
                              if(!empty($success)){
                                   if(!empty($postData['mi_d_id'][$key])) {
                                                   
                                            $sql="select * from tbl_money_indent_details where mi_d_id=".$postData['mi_d_id'][$key];
                                            $pre_mi_info=$this->m_common->customeQuery($sql);
                                            $net_order_qty=$pre_mi_info[0]['purchase_order_qty']+$postData['quantity'][$key]-$postData['pre_quantity'][$key];
                                            if($net_order_qty==$pre_mi_info[0]['quantity']){
                                                $mi_o_status="Done";
                                            }else{
                                                $mi_o_status="Partially Done";
                                            }

                                             $this->m_common->update_row('tbl_money_indent_details',array('mi_d_id'=>$postData['mi_d_id'][$key]),array('purchase_order_qty'=>$net_order_qty,'purchase_order_status'=>$mi_o_status));
                                    }


                                  
                                   
                                    
                              }
                              
                          }
                }  
                  
                
                
                
                if(isset($_FILES['order_image']['name']) && !empty($_FILES['order_image']['name'])) {
                    $doc = $_FILES['order_image'];
                    foreach ($doc['name'] as $key => $file) {
                         if(!empty($doc['name'][$key])){
                             $filename = generateFileName();
                             $path = $doc['name'][$key];
                             $ext = pathinfo($path, PATHINFO_EXTENSION);
                             if(move_uploaded_file($doc['tmp_name'][$key], 'images/purchase_order_documents/' . $filename . '.' . $ext)) {
                                 $insertDocuData= array();
                                 $insertDocuData['file_name'] = $filename . '.' . $ext;
                                 $insertDocuData['po_id'] = $o_id;
                                 $this->m_common->insert_row('tbl_purchase_order_documents',$insertDocuData);
                             }
                         }
                     }
                 
               }     
                
                
                
                
                 
                  
                  
                  redirect_with_msg('daily_purchase', 'Successfully Updated');
             }
         }else{
              redirect_with_msg('daily_purchase/add_purchase_order', 'Please fill the form and submit');
         }
         
     }
     
     
     function delete_iamge(){
        $this->setOutputMode(NORMAL);
        $d_id = $this->input->post('d_id');
        
        $document =  $this->m_common->get_row_array('tbl_purchase_order_documents',array('po_doc_id'=>$d_id),'*');
        $retur  = $this->m_common->delete_row('tbl_purchase_order_documents', array('po_doc_id'=>$d_id));
        if($retur){
          unlink('images/purchase_order_documents'."/".$document[0]['file_name']);   
          echo json_encode(array('mag'=>'success'));
        }else{
            echo json_encode(array('mag'=>'faild'));
        }
    }
     
     
     
    function details_purchase_order($id,$print=false) {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'daily_purchase';
        $this->titlebackend("Details purchase order");
        //$data['purchase_order_info']=$this->m_common->get_row_array('tbl_purchase_orders',array('o_id'=>$id),'*');
        $sql="select tpo.*,s.SUP_NAME,s.ADDRESS from tbl_purchase_orders tpo left join supplier s on tpo.supplier_id=s.ID where tpo.o_id=$id";
        $data['purchase_order_info']=$this->m_common->get_row_array('tbl_purchase_orders',array('o_id'=>$id),'*');
        $data['order_type_info']=$this->m_common->get_row_array('tbl_indent_type',array('id'=>$data['purchase_order_info'][0]['order_type']),'*');
        if($data['order_type_info'][0]['type_name']=="Material"){
          $data['suppliers']=$this->m_common->get_row_array('supplier',array('s_type'=>'Supplier'),'*'); 
       }else{
          $data['suppliers']=$this->m_common->get_row_array('supplier',array('s_type'=>'Contractor'),'*');  
       } 
//        $sql="select q.*,d.dep_description,s.SUP_NAME from tbl_purchase_quotation q left join department d on q.unit_id=d.d_id left join supplier s on q.supplier_id=s.ID where q.q_id=". $data['purchase_order_info'][0]['q_id'];
//        $data['quotations']=$this->m_common->customeQuery($sql);
        $sql='select e.*,d.designation_name,d.designation_short_name from employees e left join designation d on e.designation_id=d.id ';
        $data['employees']=$this->m_common->customeQuery($sql);
//        $data['payment_info']=$this->m_common->get_row_array('tbl_purchase_order_payment_condition',array('o_id'=>$id),'*');
        $data['payment_info']=$this->m_common->get_row_array('tbl_po_payment_condition',array('o_id'=>$id),'*');
        $data['security_info']=$this->m_common->get_row_array('tbl_po_payment_security',array('o_id'=>$id),'*');
        //$sql="select d.*,i.item_name,i.meas_unit from tbl_purchase_order_details d left join items i on d.item_id=i.id where d.is_active=1 and d.o_id=".$id;
     //   $sql="select d.*,i.item_name,i.meas_unit,s.service_name,imid.indent_no from tbl_purchase_order_details d left join items i on d.item_id=i.id left join tbl_services s on d.service_id=s.id left join ipo_material_indent_details imid on d.indent_d_id=imid.id left join budget_details bd on d.bu_d_id=bd.bu_d_id left join tbl_money_indent_details mid on d.mi_d_id=mid.mi_d_id  where d.is_active=1 and d.o_id=".$id;
     //   $sql="select d.*,i.item_name,tmu.meas_unit,s.service_name,imid.indent_no from tbl_purchase_order_details d left join items i on d.item_id=i.id left join tbl_services s on d.service_id=s.id left join ipo_material_indent_details imid on d.indent_d_id=imid.id left join budget_details bd on d.bu_d_id=bd.bu_d_id left join tbl_money_indent_details mid on d.mi_d_id=mid.mi_d_id left join tbl_measurement_unit tmu on i.mu_id=tmu.id  where d.is_active=1 and d.o_id=".$id;
        $sql="select d.*,i.item_name,tmu.meas_unit,s.service_name,imid.indent_no,tsu.unit_name from tbl_purchase_order_details d left join items i on d.item_id=i.id left join tbl_services s on d.service_id=s.id left join ipo_material_indent_details imid on d.indent_d_id=imid.id left join budget_details bd on d.bu_d_id=bd.bu_d_id left join tbl_money_indent_details mid on d.mi_d_id=mid.mi_d_id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id  where d.is_active=1 and d.o_id=".$id;
        $data['purchase_order_details_info']=$this->m_common->customeQuery($sql);
        $data['purchase_conditions']=$this->m_common->get_row_array('tbl_purchase_order_conditions',array('o_id'=>$id),'*');
        $data['copy_to']=$this->m_common->get_row_array('tbl_purchase_order_copy_to',array('o_id'=>$id),'*');
        $data['indent_types'] = $this->m_common->get_row_array('tbl_indent_type',array('is_active'=>1), '*');
        $data['projects']=$this->m_common->get_row_array('department','','*');
        $data['payment_modes']=$this->m_common->get_row_array('tbl_payment_mode',array('is_active'=>1),'*');
        $data['payment_securities']=$this->m_common->get_row_array('tbl_payment_security',array('is_active'=>1),'*');
        
        $data['purchase_order_document']= $this->m_common->get_row_array('tbl_purchase_order_documents', array('po_id'=>$id), '*');
        
        
        if($print==false){
            $this->load->view('daily_purchase/v_details_daily_purchase',$data);
        }else{
            $html=$this->load->view('daily_purchase/print_daily_purchase',$data,true);
            echo $html;
            exit; 
        }
        
    }
    function purchase_order_letter($id,$print=false) {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'daily_purchase';
        $this->titlebackend("Details purchase order");
        
       // $sql_order="select po.*,e.name,e.mobile,d.designation_name,dp.dep_description from tbl_purchase_orders po left join department dp on po.unit_id=dp.d_id left join employees e on po.employee_id=e.id left join designation d on e.designation_id=d.id where po.o_id=".$id;
        $sql_order="select po.*,e.name,e.mobile,d.designation_name,dp.dep_description,s.SUP_NAME,s.ADDRESS from tbl_purchase_orders po left join department dp on po.unit_id=dp.d_id left join employees e on po.employee_id=e.id left join designation d on e.designation_id=d.id left join supplier s on po.supplier_id=s.ID where po.o_id=".$id;
        $data['purchase_order_info']=$this->m_common->customeQuery($sql_order);
       
        $data['order_type_info']=$this->m_common->get_row_array('tbl_indent_type',array('id'=>$data['purchase_order_info'][0]['order_type']),'*');

//       $data['payment_info']=$this->m_common->get_row_array('tbl_po_payment_condition',array('o_id'=>$id),'*');
        $pm_sql="select tpopc.*,tpm.mode_name from tbl_po_payment_condition tpopc left join tbl_payment_mode tpm on tpopc.pm_id=tpm.id where tpopc.o_id=".$id;
        $data['payment_info']=$this->m_common->customeQuery($pm_sql);
        $ps_sql="select tpops.*,tps.security_name from tbl_po_payment_security tpops left join tbl_payment_security tps on tpops.security_id=tps.id where tpops.o_id=".$id;
        $data['security_info']=$this->m_common->customeQuery($ps_sql);
       // $sql="select d.*,i.item_name,i.meas_unit from tbl_purchase_order_details d left join items i on d.item_id=i.id where d.is_active=1 and d.o_id=".$id;
       // $sql="select d.*,i.item_name,i.meas_unit,s.service_name from tbl_purchase_order_details d left join items i on d.item_id=i.id left join tbl_services s on d.service_id=s.id where d.is_active=1 and d.o_id=".$id;
       // $sql="select d.*,i.item_name,tmu.meas_unit,s.service_name,imid.indent_no from tbl_purchase_order_details d left join items i on d.item_id=i.id left join tbl_services s on d.service_id=s.id left join ipo_material_indent_details imid on d.indent_d_id=imid.id left join budget_details bd on d.bu_d_id=bd.bu_d_id left join tbl_money_indent_details mid on d.mi_d_id=mid.mi_d_id left join tbl_measurement_unit tmu on i.mu_id=tmu.id  where d.is_active=1 and d.o_id=".$id;
        $sql="select d.*,i.item_name,tmu.meas_unit,s.service_name,imid.indent_no,tsu.unit_name from tbl_purchase_order_details d left join items i on d.item_id=i.id left join tbl_services s on d.service_id=s.id left join ipo_material_indent_details imid on d.indent_d_id=imid.id left join budget_details bd on d.bu_d_id=bd.bu_d_id left join tbl_money_indent_details mid on d.mi_d_id=mid.mi_d_id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id  where d.is_active=1 and d.o_id=".$id;
        $data['purchase_order_details_info']=$this->m_common->customeQuery($sql);
        
        $data['purchase_conditions']=$this->m_common->get_row_array('tbl_purchase_order_conditions',array('o_id'=>$id),'*');
        $data['copy_to']=$this->m_common->get_row_array('tbl_purchase_order_copy_to',array('o_id'=>$id),'*');
        $data['indent_types'] = $this->m_common->get_row_array('tbl_indent_type',array('is_active'=>1), '*');
        $data['projects']=$this->m_common->get_row_array('department','','*');
        $data['payment_modes']=$this->m_common->get_row_array('tbl_payment_mode',array('is_active'=>1),'*');
        $data['payment_securities']=$this->m_common->get_row_array('tbl_payment_security',array('is_active'=>1),'*');
        if($print==false){
            $this->load->view('daily_purchase/v_daily_purchase_letter',$data);
        }else{
            $html=$this->load->view('daily_purchase/print_daily_purchase_letter',$data,true);
            echo $html;
            exit; 
        }
        
    }
    function delete_purchase_order($id) {
        if(!empty($id)) {
            $q_id=$this->m_common->get_row_array('tbl_purchase_orders',array('o_id' => $id),'*');
            $id = $this->m_common->update_row('tbl_purchase_orders', array('o_id' => $id),array('is_active'=>0));
            if(!empty($id)) {
                   $this->m_common->update_row('tbl_purchase_order_details', array('o_id' => $id),array('is_active'=>0));
                 
                redirect_with_msg('daily_purchase/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('daily_purchase/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('daily_purchase/index', 'Please click on delete button');
        }
    }
     
     function get_quotation_item(){
        $branch_id= $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $q_id=$this->input->post('q_id');
        //$data['quotation_info']=$this->m_common->get_row_array('tbl_purchase_quotation',array('q_id'=>$q_id),'*');
        $sql="select pq.*,it.type_name from tbl_purchase_quotation pq left join tbl_indent_type it on pq.q_type=it.id where pq.q_id=".$q_id;
        $data['quotation_info']=$this->m_common->customeQuery($sql);
        $data['quotation_payment_info']=$this->m_common->get_row_array('tbl_purchase_quotation_payment_condition',array('q_id'=>$q_id),'*');
       
      //  $sql="select d.*,i.item_name,i.meas_unit from tbl_purchase_quotation_details d left join items i on d.item_id=i.id where d.is_active=1 and d.q_id=".$q_id;
        $sql="select d.*,i.item_name,i.meas_unit,s.service_name,s.id from tbl_purchase_quotation_details d left join items i on d.item_id=i.id left join tbl_services s on d.service_id=s.id where d.is_active=1 and d.q_id=".$q_id;
        $data['item_list']=$this->m_common->customeQuery($sql);
       // $data['order_code']=$this->m_common->get_row_array('tbl_sales_order_code',array('customer_id'=>$data['quotation_info'][0]['customer_id']),'*','',1,'id','DESC');
        $data['order_code']=$this->m_common->get_row_array('tbl_purchase_order_code',array('supplier_id'=>$data['quotation_info'][0]['supplier_id']),'*','',1,'id','DESC');
        $data['supplier_info']=$this->m_common->get_row_array('supplier',array('id'=>$data['quotation_info'][0]['supplier_id']),'*');
        echo json_encode($data);
     }
    
    function get_item_material(){
        $this->setOutputMode(NORMAL);
        $id=$this->input->post('id');
        
        $data['item_info']=$this->m_common->get_row_array('tbl_sales_items',array('s_item_id'=>$id),'*');
        $sql="select tbl_d.*,tbl_m.m_name from tbl_sales_item_details tbl_d left join tbl_materials tbl_m on tbl_d.m_id=tbl_m.m_id where tbl_d.s_item_id=".$id;
        $data['item_list']=$this->m_common->customeQuery($sql);
 
        
        echo json_encode($data);
    }
   
     
   function get_purchase_order_item(){
       $this->setOutputMode(NORMAL);
       $id=$this->input->post('po_id');
     //  $sql="select tbl_d.*,i.item_name,i.meas_unit from tbl_purchase_order_details tbl_d left join items i on tbl_d.item_id=i.id where tbl_d.o_id=".$id;
     //  $sql="select tbl_d.*,i.item_name,tmu.meas_unit from tbl_purchase_order_details tbl_d left join items i on tbl_d.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where tbl_d.o_id=".$id;
     //  $sql="select tbl_d.*,i.item_name,tmu.meas_unit from tbl_purchase_order_details tbl_d left join items i on tbl_d.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where (tbl_d.receive_status='Pending' or tbl_d.receive_status='Partially Received') and tbl_d.o_id=".$id;
       $sql="select tbl_d.*,i.item_name,tmu.meas_unit,tsu.unit_name from tbl_purchase_order_details tbl_d left join items i on tbl_d.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where (tbl_d.receive_status='Pending' or tbl_d.receive_status='Partially Received') and tbl_d.o_id=".$id;
       $data['item_list']=$this->m_common->customeQuery($sql);
       echo json_encode($data);
   }
   
   
   function get_supplier(){
       $this->setOutputMode(NORMAL);
       $order_for=$this->input->post('order_for');
       if($order_for=="Material"){
          $data['suppliers']=$this->m_common->get_row_array('supplier',array('s_type'=>"Supplier"),'*');
       }else{
          $data['suppliers']=$this->m_common->get_row_array('supplier',array('s_type'=>"Contractor"),'*');
       }
       echo json_encode($data);
   }
   
   function get_order_info(){
       $this->setOutputMode(NORMAL);
       $supplier_id=$this->input->post('supplier_id');
       $data['order_code']=$this->m_common->get_row_array('tbl_purchase_order_code',array('supplier_id'=>$supplier_id),'*','',1,'id','DESC');
       $data['supplier_info']=$this->m_common->get_row_array('supplier',array('id'=>$supplier_id),'*');
       echo json_encode($data);
   }
   
   function get_purchase_items(){
       $this->setOutputMode(NORMAL);
       $order_from=$this->input->post('order_from');
       $order_for=$this->input->post('order_for');
       $unit_id=$this->input->post('unit_id');
       $sql="select pq.*,it.type_name from tbl_purchase_quotation pq left join tbl_indent_type it on pq.q_type=it.id where pq.q_id=".$q_id;
       $data['quotation_info']=$this->m_common->get_row_array('tbl_indent_type',array('id'=>$order_for),'*');
       $data['project_info']=$this->m_common->get_row_array('department',array('d_id'=>$unit_id),'*');
       if($data['quotation_info'][0]['type_name']=="Material" || $data['quotation_info'][0]['type_name']=="Asset"){
            if($order_from=='Direct'){
              //  $sql="select imid.*,i.item_name,i.meas_unit,s.service_name,s.id as s_id from ipo_material_indent_details imid left join items i on imid.item_id=i.id left join tbl_services s on imid.service_id=s.id where imid.department_id=".$unit_id;
            //    $sql="select imid.*,i.item_name,tmu.meas_unit,s.service_name,s.id as s_id from ipo_material_indent_details imid left join items i on imid.item_id=i.id left join tbl_services s on imid.service_id=s.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where imid.department_id=".$unit_id;
              if($data['quotation_info'][0]['type_name']=="Material"){
                //  $sql="select imid.*,i.item_name,tmu.meas_unit from ipo_material_indent_details imid left join ipo_material_indent imi on imid.ipo_m_id=imi.ipo_m_id left join tbl_indent_type tip on imi.indent_type=tip.id left join items i on imid.item_id=i.id  left join tbl_measurement_unit tmu on i.mu_id=tmu.id where imi.status='Approved' and tip.type_name='Material' and imid.department_id=".$unit_id;
                  $sql="select imid.*,i.item_name,tmu.meas_unit,tsu.unit_name from ipo_material_indent_details imid left join ipo_material_indent imi on imid.ipo_m_id=imi.ipo_m_id left join tbl_indent_type tip on imi.indent_type=tip.id left join items i on imid.item_id=i.id  left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where imi.status='Approved' and tip.type_name='Material' and imid.department_id=".$unit_id;
              }else{
                  $sql="select imid.*,i.item_name,tmu.meas_unit from ipo_material_indent_details imid left join ipo_material_indent imi on imid.ipo_m_id=imi.ipo_m_id left join tbl_indent_type tip on imi.indent_type=tip.id left join items i on imid.item_id=i.id  left join tbl_measurement_unit tmu on i.mu_id=tmu.id where imi.status='Approved' and tip.type_name='Asset' and imid.department_id=".$unit_id;  
              }
            }else if($order_from=='Budget'){
             //   $sql="select bd.*,i.item_name,i.meas_unit from budget_details bd left join items i on bd.item_id=i.id where bd.department_id=".$unit_id;
             //   $sql="select bd.*,i.item_name,tmu.meas_unit from budget_details bd left join items i on bd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where bd.department_id=".$unit_id;
                $sql="select bd.*,i.item_name,tmu.meas_unit,tsu.unit_name from budget_details bd left join items i on bd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where bd.department_id=".$unit_id;
            }else if($order_from=='Money Indent'){
               // $sql="select mid.*,i.item_name,tmu.meas_unit,bd.indent_no,bd.indent_d_id from tbl_money_indent_details mid left join items i on mid.item_id=i.id left join budget_details bd on mid.bu_d_id=bd.bu_d_id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where bd.department_id=".$unit_id;
               //  $sql="select mid.*,i.item_name,tmu.meas_unit,bd.indent_no,bd.indent_d_id from tbl_money_indent_details mid left join items i on mid.item_id=i.id left join budget_details bd on mid.bu_d_id=bd.bu_d_id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where ( purchase_order_status='Pending' or purchase_order_status='Partially Done' ) and bd.department_id=".$unit_id;
                $sql="select mid.*,i.item_name,tmu.meas_unit,bd.indent_no,bd.indent_d_id,tsu.unit_name from tbl_money_indent_details mid left join items i on mid.item_id=i.id left join budget_details bd on mid.bu_d_id=bd.bu_d_id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where ( purchase_order_status='Pending' or purchase_order_status='Partially Done' ) and bd.department_id=".$unit_id;
            }
       }else{
                $sql="select imid.*,tmu.meas_unit,s.service_name,s.id as s_id from ipo_material_indent_details imid left join ipo_material_indent imi on imid.ipo_m_id=imi.ipo_m_id left join tbl_indent_type tip on imi.indent_type=tip.id  left join tbl_services s on imid.service_id=s.id left join tbl_measurement_unit tmu on s.mu_id=tmu.id where tip.type_name='Sub Contractor Job' and purchase_order_status='Pending' and imi.status='Approved' and imid.department_id=".$unit_id;
       }
       $data['item_list']=$this->m_common->customeQuery($sql);
       echo json_encode($data);
   }
   
   
   
   
   function forward_purchase_order($id) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'purchase_order';
        
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $purchase_order_info = $this->m_common->get_row_array("tbl_purchase_orders", array('o_id' => $id), "*");
       
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $purchase_order_info[0]['applicant_id']), "*");
        $approver_data = fetch_approver(2,41, $approvers_info); //
       
        if ($employee_id == $approver_data[0]) {
            $this->m_common->update_row('tbl_purchase_orders', array('o_id' => $id), array('approve_status' =>'Forward-By-First-Approver', 'approver_id' =>$approver_data[1],'approved_by' =>$employee_id));
            $array = array(
                "employee_id" => $approver_data[1],
                "title" => "Purchase order approval",
                "notice" => "Please approve the purchase order",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "daily_purchase/details_purchase_order/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        if ($employee_id == $approver_data[1]) {
            $this->m_common->update_row('tbl_purchase_orders', array('o_id' => $id), array('approve_status' =>'Forward-By-Second-Approver', 'approver_id' =>$approver_data[2],'approved_by' =>$employee_id));
            $array = array(
                "employee_id" => $approver_data[2],
                "title" => "Purchase order approval",
                "notice" => "Please approve the purchase order",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "daily_purchase/details_purchase_order/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        if($employee_id ==$approver_data[2]) {
            $this->m_common->update_row('tbl_purchase_orders', array('o_id' => $id), array('approve_status' =>'Forward-By-Third-Approver', 'approver_id' =>$approver_data[3],'approved_by' =>$employee_id));
            $array = array(
                "employee_id" => $approver_data[3],
                "title" => "Purchase order approval",
                "notice" => "Please approve the purchase order",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "daily_purchase/details_purchase_order/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        
        redirect_with_msg('daily_purchase', 'Forward Successfull');
    }
     
   function reject_purchase_order($id){
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'purchase_order';
        
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        
        $purchase_order_info=$this->m_common->get_row_array("tbl_purchase_orders", array('o_id' => $id), "*");
        $purchase_order_details_info=$this->m_common->get_row_array("tbl_purchase_order_details", array('o_id' => $id),"*");
       
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $purchase_order_info[0]['applicant_id']), "*");
        $approver_data = fetch_approver(2,41, $approvers_info); //
        if($user_type==1){
            $this->m_common->update_row('tbl_purchase_orders', array('o_id' => $id), array('approve_status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id));
            if($purchase_order_info[0]['']){
                
            }
            
            $array = array(
                "employee_id" =>$purchase_order_info[0]['applicant_id'],
                "title" => "Purchase order approval",
                "notice" => "The purchase order is rejected",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "daily_purchase/details_purchase_order/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }else{
            if ($employee_id == $approver_data[0]) {
                $this->m_common->update_row('tbl_purchase_orders', array('o_id' => $id), array('approve_status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id));
                $array = array(
                    "employee_id" =>$purchase_order_info[0]['applicant_id'],
                    "title" => "Purchase order approval",
                    "notice" => "The purchase order is rejected",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "daily_purchase/details_purchase_order/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[1]) {
               $this->m_common->update_row('tbl_purchase_orders', array('o_id' => $id), array('approve_status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id));
               $array = array(
                "employee_id" =>$purchase_order_info[0]['applicant_id'],
                "title" => "Purchase order approval",
                "notice" => "The purchase order is rejected",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "daily_purchase/details_purchase_order/".$id
            );
            $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[2]) {
                $this->m_common->update_row('tbl_purchase_orders', array('o_id' => $id), array('approve_status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id));
                $array = array(
                    "employee_id" =>$purchase_order_info[0]['applicant_id'],
                    "title" => "Purchase order approval",
                    "notice" => "The purchase order is rejected",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "daily_purchase/details_purchase_order/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            
            if ($employee_id == $approver_data[3]) {
                $this->m_common->update_row('tbl_purchase_orders', array('o_id' => $id), array('approve_status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id));
                $array = array(
                    "employee_id" =>$purchase_order_info[0]['applicant_id'],
                    "title" => "Purchase order approval",
                    "notice" => "The purchase order is rejected",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "daily_purchase/details_purchase_order/".$id
                );
                $this->m_common->insert_row("notice", $array);
           }
        }     
        redirect_with_msg('daily_purchase','Rejected Successfully');
    }
     
   function approve_purchase_order($id) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'purchase_order';
        
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $purchase_order_info = $this->m_common->get_row_array("tbl_purchase_orders", array('o_id' => $id), "*");
       
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' =>$purchase_order_info[0]['applicant_id']), "*");
        $approver_data = fetch_approver(2,41,$approvers_info); //
        if($user_type==1){
            $this->m_common->update_row('tbl_purchase_orders', array('o_id' => $id), array('approve_status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id));
            $array = array(
                "employee_id" =>$purchase_order_info[0]['applicant_id'],
                "title" => "Purchase order approval",
                "notice" => "The purchase order is approved",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "daily_purchase/details_purchase_order/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }else{
//            if ($employee_id == $approver_data[0]) {
//                $this->m_common->update_row('tbl_purchase_orders', array('o_id' => $id), array('approve_status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id));
//                $array = array(
//                    "employee_id" =>$purchase_order_info[0]['applicant_id'],
//                    "title" => "Purchase order approval",
//                    "notice" => "The purchase order is approved",
//                    "create_date" => date('Y-m-d H:i:s'),
//                    "date" => date('Y-m-d'),
//                    "status" => "Unseen",
//                    "url" => "purchase_orders/details_purchase_order/".$id
//                );
//                $this->m_common->insert_row("notice", $array);
//            }
//            if ($employee_id == $approver_data[1]) {
//               $this->m_common->update_row('tbl_purchase_orders', array('o_id' => $id), array('approve_status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id));
//               $array = array(
//                "employee_id" =>$purchase_order_info[0]['applicant_id'],
//                "title" => "Purchase order approval",
//                "notice" => "The purchase order is approved",
//                "create_date" => date('Y-m-d H:i:s'),
//                "date" => date('Y-m-d'),
//                "status" => "Unseen",
//                "url" => "purchase_orders/details_purchase_order/".$id
//            );
//            $this->m_common->insert_row("notice", $array);
//            }
//            if ($employee_id == $approver_data[2]) {
//                $this->m_common->update_row('tbl_purchase_orders', array('o_id' => $id), array('approve_status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id));
//                $array = array(
//                    "employee_id" =>$purchase_order_info[0]['applicant_id'],
//                    "title" => "Purchase order approval",
//                    "notice" => "The purchase order is approved",
//                    "create_date" => date('Y-m-d H:i:s'),
//                    "date" => date('Y-m-d'),
//                    "status" => "Unseen",
//                    "url" => "purchase_orders/details_purchase_order/".$id
//                );
//                $this->m_common->insert_row("notice", $array);
//            }
            
//            if ($employee_id == $approver_data[3]) {
//                $this->m_common->update_row('tbl_purchase_orders', array('o_id' => $id), array('approve_status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id));
//                $array = array(
//                    "employee_id" =>$purchase_order_info[0]['applicant_id'],
//                    "title" => "Purchase order approval",
//                    "notice" => "The purchase order is approved",
//                    "create_date" => date('Y-m-d H:i:s'),
//                    "date" => date('Y-m-d'),
//                    "status" => "Unseen",
//                    "url" => "purchase_orders/details_purchase_order/".$id
//                );
//                $this->m_common->insert_row("notice", $array);
//           }
           
           $this->m_common->update_row('tbl_purchase_orders', array('o_id' => $id), array('approve_status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id));
           $array = array(
                "employee_id" =>$purchase_order_info[0]['applicant_id'],
                "title" => "Purchase order approval",
                "notice" => "The purchase order is approved",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "daily_purchase/details_purchase_order/".$id
           );
           $this->m_common->insert_row("notice", $array);
           
        }     
        redirect_with_msg('daily_purchase','Approved Successfully');
    }
   
    
    
    function addSupplier(){
        $this->setOutputMode(NORMAL);
        $sup_name=$this->input->post('sup_name');
        $mobile=$this->input->post('mobile');
        $address=$this->input->post('address');
        $pre_info=$this->m_common->get_row_array('supplier',array('SUP_NAME'=>$sup_name),'*');
        if(empty($pre_info)){
            
            $supplier_last_code=$this->m_common->get_row_array('supplier_code','','*','',1,'id','DESC');
            if(!empty($supplier_last_code)){

                $supplier_code=$supplier_last_code[0]['supplier_code']+1;
                if($supplier_code>999){
                    $supplier_sl_no="SP".$supplier_code;
                }else if($supplier_code>99){
                    $supplier_sl_no="SP0".$supplier_code;
                }else if($supplier_code>9){
                    $supplier_sl_no="SP00".$supplier_code;
                }else{
                    $supplier_sl_no="SP000".$supplier_code;
                }
            }else{
                $supplier_code=1;
                $supplier_sl_no='SP0001';
            }
            
            $po="PO/".$supplier_sl_no."/".date('Y')."/"."0001";
            $data['o_code']=1;
            $data['order_no']=$po;
            $id=$this->m_common->insert_row('supplier',array('SUP_NAME'=>$sup_name,'MOBILE'=>$mobile,'ADDRESS'=>$address,'s_type'=>'Supplier','CODE'=>$supplier_sl_no));
            if(!empty($id)){
                $this->m_common->insert_row('supplier_code',array('supplier_code'=>$supplier_code));
               // $data['supplier']=$this->m_common->get_row_array('supplier','','*');
                $data['supplier']=$this->m_common->get_row_array('supplier',array('ID'=>$id),'*');
                $data['status']="success";
                $data['current_user']=$id;
            }else{

                $data['status']="fail";
            }
        }else{
            $data['status']="fail";
        }    
        echo json_encode($data);
    }

}




