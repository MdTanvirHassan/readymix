<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase_invoices extends Site_Controller {

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
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $this->menu = 'procurement';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'bill_reconcilation';
        $this->titlebackend("Purchase Invoices");
        if($user_type==1){
            //$sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join tbl_purchase_quotation q on o.q_id=q.q_id left join supplier s on q.supplier_id=s.ID left join department d on o.unit_id=d.d_id where v.is_active=1";
            //$sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on o.supplier_id=s.ID left join department d on o.unit_id=d.d_id where v.is_active=1";
            $sql="select v.*,s.SUP_NAME,tbr.supplier_bill_no from tbl_purchase_invoices v left join tbl_bill_register tbr on v.bill_id=tbr.id left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on tbr.supplier_id=s.ID where v.is_active=1";
        }else{
            //$sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join tbl_purchase_quotation q on o.q_id=q.q_id left join supplier s on q.supplier_id=s.ID left join department d on o.unit_id=d.d_id where v.is_active=1 and (applicant=".$employee_id." or approver_id=".$employee_id.")";
             $sql="select v.*,o.order_no,s.SUP_NAME,tbr.supplier_bill_no from tbl_purchase_invoices v left join tbl_bill_register tbr on v.bill_id=tbr.id left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on tbr.supplier_id=s.ID left join department d on o.unit_id=d.d_id where v.is_active=1 and (v.applicant_id=".$employee_id." or v.approver_id=".$employee_id.")";
        }
        $data['invoices']=$this->m_common->customeQuery($sql);
        $this->load->view('purchase_invoices/v_reconcilation_bills',$data);
    }
    
    function auditedBill(){
        $branch_id= $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $this->menu = 'accounts';
        $this->sub_menu = 'account';
        $this->sub_inner_menu = 'audited_bill';
        $this->titlebackend("Purchase Invoices");
        
        $sql="select v.*,s.SUP_NAME,tbr.supplier_bill_no from tbl_purchase_invoices v left join tbl_bill_register tbr on v.bill_id=tbr.id left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on tbr.supplier_id=s.ID where v.is_active=1 and v.audit_status='Approved' ";
       
        $data['invoices']=$this->m_common->customeQuery($sql);
        $this->load->view('purchase_invoices/v_audited_bill',$data);
    }
    
     function auditedBillDetails($id,$print=false) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'accounts';
        $this->sub_menu = 'account';
        $this->sub_inner_menu = 'audited_bill';
        
        $this->titlebackend("Invoice Information");
        $sql="select o.*,s.SUP_NAME,d.dep_description,d.short_name from tbl_purchase_orders o left join  tbl_purchase_quotation q on o.q_id=q.q_id left join department d on o.unit_id=d.d_id left join supplier s on q.supplier_id=s.ID where o.is_active=1 and (o.status='Received' or o.status='Partially Received')";
        $data['orders']=$this->m_common->customeQuery($sql);
        $data['purchase_invoice_info']=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id'=>$id),'*');
       // $sql="select d.*,i.item_name,i.meas_unit,mrr.mrr_challan from tbl_purchase_invoice_details d left join material_receive_requisition mrr on d.mrr_id=mrr.mrr_id left join items i on d.item_id=i.id where d.is_active=1 and inv_id=".$id;
        $sql="select d.*,i.item_name,tmu.meas_unit,mrr.mrr_challan,mrr_no,tpo.order_no from tbl_purchase_invoice_details d left join material_receive_requisition mrr on d.mrr_id=mrr.mrr_id left join tbl_purchase_orders tpo on mrr.po_id=tpo.o_id left join items i on d.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where d.is_active=1 and inv_id=".$id;
        $data['invoice_details_info']=$this->m_common->customeQuery($sql);
        if($print==false){
             $this->load->view('purchase_invoices/v_audited_bill_details',$data);
        }else{
            $html=$this->load->view('purchase_invoices/print_purchase_invoice',$data,true);
            echo $html;
            exit; 
        }
       
    }
    
    
    
    function audit() {
        $branch_id= $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $this->menu = 'general_store';
        $this->sub_menu = 'audit';
        $this->sub_inner_menu = 'purchase_invoice';
        $this->titlebackend("Purchase Invoices");
        if($user_type==1 || $user_type==3){
            //$sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join tbl_purchase_quotation q on o.q_id=q.q_id left join supplier s on q.supplier_id=s.ID left join department d on o.unit_id=d.d_id where v.is_active=1";
            //$sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on o.supplier_id=s.ID left join department d on o.unit_id=d.d_id where v.is_active=1";
            $sql="select v.*,s.SUP_NAME,tbr.supplier_bill_no from tbl_purchase_invoices v left join tbl_bill_register tbr on v.bill_id=tbr.id left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on tbr.supplier_id=s.ID where v.is_active=1";
        }else{
            //$sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join tbl_purchase_quotation q on o.q_id=q.q_id left join supplier s on q.supplier_id=s.ID left join department d on o.unit_id=d.d_id where v.is_active=1 and (applicant=".$employee_id." or approver_id=".$employee_id.")";
             $sql="select v.*,o.order_no,s.SUP_NAME,tbr.supplier_bill_no from tbl_purchase_invoices v left join tbl_bill_register tbr on v.bill_id=tbr.id left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on tbr.supplier_id=s.ID left join department d on o.unit_id=d.d_id where v.is_active=1 and (v.applicant_id=".$employee_id." or v.approver_id=".$employee_id.")";
        }
        $data['invoices']=$this->m_common->customeQuery($sql);
        $this->load->view('purchase_invoices/v_purchase_invoice',$data);
    }
    
    
    function auditBillDetails($id,$print=false) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'audit';
        $this->sub_menu = 'audit';
        $this->sub_inner_menu = 'purchase_invoice';
        
        $this->titlebackend("Invoice Information");
        $sql="select o.*,s.SUP_NAME,d.dep_description,d.short_name from tbl_purchase_orders o left join  tbl_purchase_quotation q on o.q_id=q.q_id left join department d on o.unit_id=d.d_id left join supplier s on q.supplier_id=s.ID where o.is_active=1 and (o.status='Received' or o.status='Partially Received')";
        $data['orders']=$this->m_common->customeQuery($sql);
        $data['purchase_invoice_info']=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id'=>$id),'*');
       // $sql="select d.*,i.item_name,i.meas_unit,mrr.mrr_challan from tbl_purchase_invoice_details d left join material_receive_requisition mrr on d.mrr_id=mrr.mrr_id left join items i on d.item_id=i.id where d.is_active=1 and inv_id=".$id;
        $sql="select d.*,i.item_name,tmu.meas_unit,mrr.mrr_challan,mrr_no,tpo.order_no from tbl_purchase_invoice_details d left join material_receive_requisition mrr on d.mrr_id=mrr.mrr_id left join tbl_purchase_orders tpo on mrr.po_id=tpo.o_id left join items i on d.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where d.is_active=1 and inv_id=".$id;
        $data['invoice_details_info']=$this->m_common->customeQuery($sql);
        if($print==false){
             $this->load->view('purchase_invoices/v_audit_details',$data);
        }else{
            $html=$this->load->view('purchase_invoices/print_purchase_invoice',$data,true);
            echo $html;
            exit; 
        }
       
    }
    
     function unpaid_invoice() {
        $branch_id= $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $this->menu = 'general_store';
        $this->sub_menu = 'accounts';
        $this->sub_inner_menu = 'unpaid_invoice';
        $this->titlebackend("Purchase Invoices");
        $sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join tbl_purchase_quotation q on o.q_id=q.q_id left join supplier s on q.supplier_id=s.ID left join department d on o.unit_id=d.d_id where v.is_active=1";      
        $data['invoices']=$this->m_common->customeQuery($sql);
        $this->load->view('purchase_invoices/v_pending_invoice',$data);
    }

   
     function add_purchase_invoice() {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'procurement';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'purchase_invoice';
        
        $this->titlebackend("Invoice Information");
        
        $sql="select tbp.*,s.SUP_NAME from tbl_bill_register tbp left join supplier s on tbp.supplier_id=s.ID where tbp.is_active=1 and tbp.verify_status='Pending'";
        $data['bills']=$this->m_common->customeQuery($sql);
       // $sql="select o.*,s.SUP_NAME,d.dep_description,d.short_name from tbl_purchase_orders o left join  tbl_purchase_quotation q on o.q_id=q.q_id left join department d on o.unit_id=d.d_id left join supplier s on q.supplier_id=s.ID where o.is_active=1 and (o.status='Received' or o.status='Partially Received')";
        $sql="select o.*,s.SUP_NAME,d.dep_description,d.short_name from tbl_purchase_orders o left join department d on o.unit_id=d.d_id left join supplier s on o.supplier_id=s.ID where o.is_active=1 and (o.status='Received' or o.status='Partially Received')";
        $data['orders']=$this->m_common->customeQuery($sql);
        $this->load->view('purchase_invoices/v_add_purchase_invoice',$data);
    }
     function add_purchase_invoice_action() {
         $branch_id= $this->session->userdata('companyId');
         $user_id = $this->session->userdata('user_id');
         $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
         $approver = fetch_approver(2, 7, $userData);
         
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
            if(empty($postData['select_product'])){
                 redirect_with_msg('purchase_invoices/add_purchase_invoice', 'Please Select Item');
            }
             if(!empty($postData['po_id'])){
                 $insertData['po_id']=$postData['po_id'];
                 $o_id=$postData['po_id'];
             }
             $unit_info=$this->m_common->get_row_array('tbl_purchase_orders',array('o_id'=>$o_id),'*');
            
            if(!empty($postData['supplier_id'])){
                $insertData['supplier_id']=$postData['supplier_id'];               
            }
             
             if(!empty($postData['inv_no'])){
                 $insertData['inv_no']=$postData['inv_no'];
             }
             
             
             if(!empty($postData['bill_id'])){
                 $insertData['bill_id']=$postData['bill_id'];
             }
             
             if(!empty($postData['supplier_bill_no'])){
                 $insertData['supplier_bill_no']=$postData['supplier_bill_no'];
             }
             
             if(!empty($postData['invoice_date'])){
                 $insertData['invoice_date']=date('Y-m-d',strtotime($postData['invoice_date']));
             }
            
             if(!empty($postData['billing_address'])){
                 $insertData['billing_address']=$postData['billing_address'];
             }
             if(!empty($postData['billing_email'])){
                 $insertData['billing_email']=$postData['billing_email'];
             }
            
             if(!empty($postData['total_amount'])){
                 $insertData['total_amount']=$postData['total_amount'];
             }
             
             if(!empty($postData['discount'])){
                 $insertData['discount']=$postData['discount'];
             }
             
             if(!empty($postData['vat'])){
                 $insertData['vat']=$postData['vat'];
             }
             
             if(!empty($postData['tax'])){
                 $insertData['tax']=$postData['tax'];
             }
             
             if(!empty($postData['ait'])){
                 $insertData['ait']=$postData['ait'];
             }
             
             if(!empty($postData['net_payable_amount'])){
                 $insertData['net_payable_amount']=$postData['net_payable_amount'];
             }
             
         //    $insertData['unit_id']=$unit_info[0]['unit_id'];
            
             $insertData['branch_id']=$branch_id;
             $insertData['is_active']=1;
             $insertData['approver_id']=$approver[0];
             $insertData['applicant_id'] = $userData[0]['employeeId'];
             $insertData['status']='Pending';
             $insertData['audit_status']='Pending';
             $insertData['payment_status']='Pending';
             $insertData['created_date']=date('Y-m-d');
             $result=$this->m_common->insert_row('tbl_purchase_invoices',$insertData);
             if(!empty($result)){
                 
                $this->m_common->update_row('tbl_bill_register',array('id'=>$postData['bill_id']),array('verify_status'=>"Verified")); 
                
                  $this->m_common->insert_row('tbl_purchase_invoice_code',array('inv_code'=>$postData['inv_code'],'supplier_id'=>$postData['supplier_id']));  
                  foreach ($postData['item_id'] as $key => $each) {
                      if(in_array($key,$postData['select_product'])){
                            $insertData1=array();
                            $insertData1['inv_id'] = $result;
                            $insertData1['item_id'] = $each;
                            $insertData1['is_active']=1;
                            $insertData1['status']='Pending';
                            if(empty($each)){
                                continue;
                            }
                            if(!empty($postData['mrr_id'][$key])) {
                                 $insertData1['mrr_id'] = $postData['mrr_id'][$key];
                            }
                            
                            if(!empty($postData['mrrd_id'][$key])) {
                                 $insertData1['mrrd_id'] = $postData['mrrd_id'][$key];
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

                           $s=$this->m_common->insert_row('tbl_purchase_invoice_details',$insertData1);
                           if(!empty($s)){
                               $this->m_common->update_row('tbl_material_receive_requisition_details',array('mrrd_id'=>$postData['mrrd_id'][$key]),array('bill_status'=>'Generated'));
                           }
                      }
                  }
                  
                  $this->m_common->update_row('tbl_bill_register',array('id'=>$postData['bill_id']),array('verify_status'=>'Verified'));
                  redirect_with_msg('purchase_invoices', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('purchase_invoices/add_purchase_invoice', 'Please fill the form and submit');
         }
         
     }
    
    function edit_purchase_invoice($id) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'procurement';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'purchase_invoice';
        
        $this->titlebackend("Invoice Information");
        
        $sql="select tbp.*,s.SUP_NAME from tbl_bill_register tbp left join supplier s on tbp.supplier_id=s.ID where tbp.is_active=1";
        $data['bills']=$this->m_common->customeQuery($sql);
        
        $sql="select o.*,s.SUP_NAME,d.dep_description,d.short_name from tbl_purchase_orders o left join  tbl_purchase_quotation q on o.q_id=q.q_id left join department d on o.unit_id=d.d_id left join supplier s on q.supplier_id=s.ID where o.is_active=1 and (o.status='Received' or o.status='Partially Received')";
        $data['orders']=$this->m_common->customeQuery($sql);
        $data['purchase_invoice_info']=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id'=>$id),'*');
    //    $sql="select d.*,i.item_name,i.meas_unit,mrr.mrr_challan from tbl_purchase_invoice_details d left join material_receive_requisition mrr on d.mrr_id=mrr.mrr_id left join items i on d.item_id=i.id where d.is_active=1 and inv_id=".$id;
        $sql="select d.*,i.item_name,tmu.meas_unit,mrr.mrr_challan,mrr_no,tpo.order_no from tbl_purchase_invoice_details d left join material_receive_requisition mrr on d.mrr_id=mrr.mrr_id left join tbl_purchase_orders tpo on mrr.po_id=tpo.o_id left join items i on d.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where d.is_active=1 and inv_id=".$id;
        $data['invoice_details_info']=$this->m_common->customeQuery($sql);
        $this->load->view('purchase_invoices/v_edit_purchase_invoice',$data);
    }
    
    function edit_purchase_invoice_action($inv_id) {
         $user_id = $this->session->userdata('user_id');
         $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             if(!empty($postData['po_id'])){
                 $insertData['po_id']=$postData['po_id'];
                 $o_id=$postData['po_id'];
             }
             //$unit_info=$this->m_common->get_row_array('tbl_purchase_orders',array('o_id'=>$o_id),'*');
//             if(!empty($postData['inv_no'])){
//                 $insertData['inv_no']=$postData['inv_no'];
//             }
             
             if(!empty($postData['bill_id'])){
                 $insertData['bill_id']=$postData['bill_id'];
             }
             
             if(!empty($postData['supplier_bill_no'])){
                 $insertData['supplier_bill_no']=$postData['supplier_bill_no'];
             }
             
             if(!empty($postData['purchase_invoice_date'])){
                 $insertData['purchase_invoice_date']=date('Y-m-d',strtotime($postData['purchase_invoice_date']));
             }
            
             if(!empty($postData['billing_address'])){
                 $insertData['billing_address']=$postData['billing_address'];
             }
             if(!empty($postData['billing_email'])){
                 $insertData['billing_email']=$postData['billing_email'];
             }
            
             if(!empty($postData['total_amount'])){
                 $insertData['total_amount']=$postData['total_amount'];
             }
             
             if(!empty($postData['discount'])){
                 $insertData['discount']=$postData['discount'];
             }
             
             if(!empty($postData['vat'])){
                 $insertData['vat']=$postData['vat'];
             }
             
             if(!empty($postData['tax'])){
                 $insertData['tax']=$postData['tax'];
             }
             
             if(!empty($postData['ait'])){
                 $insertData['ait']=$postData['ait'];
             }
             
             if(!empty($postData['net_payable_amount'])){
                 $insertData['net_payable_amount']=$postData['net_payable_amount'];
             }
             
             $insertData['updated_by'] = $userData[0]['employeeId'];
             $insertData['updated_date']=date('Y-m-d');
             
             $result=$this->m_common->update_row('tbl_purchase_invoices',array('inv_id'=>$inv_id),$insertData);
             if($result>=0){
                 $this->m_common->delete_row('tbl_purchase_invoice_details',array('inv_id'=>$inv_id));
                 foreach ($postData['item_id'] as $key => $each) {
                      $insertData1=array();
                      $insertData1['inv_id'] = $inv_id;
                      $insertData1['item_id'] = $each;
                      $insertData1['is_active']=1;
                      $insertData1['status']='Pending';
                      if(empty($each)){
                          continue;
                      }
                      if(!empty($postData['mrr_id'][$key])) {
                        $insertData1['mrr_id'] = $postData['mrr_id'][$key];
                      }
                      
                      if(!empty($postData['mrrd_id'][$key])){
                        $insertData1['mrrd_id'] = $postData['mrrd_id'][$key];
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
                 
                      $this->m_common->insert_row('tbl_purchase_invoice_details',$insertData1);
                  }
                  redirect_with_msg('purchase_invoices', 'Successfully Updated');
             }
         }else{
              redirect_with_msg('purchase_invoices/add_purchase_invoice', 'Please fill the form and submit');
         }
         
     }
     
     
    function details_purchase_invoice($id,$print=false) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'procurement';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'purchase_invoice';
        
        $this->titlebackend("Invoice Information");
        $sql="select o.*,s.SUP_NAME,d.dep_description,d.short_name from tbl_purchase_orders o left join  tbl_purchase_quotation q on o.q_id=q.q_id left join department d on o.unit_id=d.d_id left join supplier s on q.supplier_id=s.ID where o.is_active=1 and (o.status='Received' or o.status='Partially Received')";
        $data['orders']=$this->m_common->customeQuery($sql);
        $data['purchase_invoice_info']=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id'=>$id),'*');
       // $sql="select d.*,i.item_name,i.meas_unit,mrr.mrr_challan from tbl_purchase_invoice_details d left join material_receive_requisition mrr on d.mrr_id=mrr.mrr_id left join items i on d.item_id=i.id where d.is_active=1 and inv_id=".$id;
       // $sql="select d.*,i.item_name,tmu.meas_unit,mrr.mrr_challan,mrr_no,tpo.order_no from tbl_purchase_invoice_details d left join material_receive_requisition mrr on d.mrr_id=mrr.mrr_id left join tbl_purchase_orders tpo on mrr.po_id=tpo.o_id left join items i on d.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where d.is_active=1 and inv_id=".$id;
        $sql="select d.*,i.item_name,tmu.meas_unit,mrr.mrr_challan,mrr_no,tpo.order_no from tbl_purchase_invoice_details d left join material_receive_requisition mrr on d.mrr_id=mrr.mrr_id left join tbl_purchase_orders tpo on mrr.po_id=tpo.o_id left join items i on d.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where d.is_active=1 and inv_id=".$id;
        $data['invoice_details_info']=$this->m_common->customeQuery($sql);
        if($print==false){
             $this->load->view('purchase_invoices/v_details_purchase_invoice',$data);
        }else{
            $html=$this->load->view('purchase_invoices/print_purchase_invoice',$data,true);
            echo $html;
            exit; 
        }
       
    }
     
    function delete_purchase_invoice($id){
        if(!empty($id)){
            $invoice_info=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id' => $id),'*');
            $invoice_details=$this->m_common->get_row_array('tbl_purchase_invoice_details',array('inv_id' => $id),'*');
            $result=$this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id),array('is_active'=>0));
            if(!empty($result)){
                $this->m_common->update_row('tbl_bill_register',array('id'=>$invoice_info[0]['bill_id']),array('verify_status'=>'Pending'));
                $this->m_common->update_row('tbl_purchase_invoice_details', array('inv_id' => $id),array('is_active'=>0));
                foreach($invoice_details as $invd){
                    $this->m_common->update_row('tbl_material_receive_requisition_details',array('mrrd_id'=>$invd['mrrd_id']),array('bill_status'=>'Pending'));
                }
                redirect_with_msg('purchase_invoices/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('purchase_invoices/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('purchase_invoices/index', 'Please click on delete button');
        }
    }
    
   
    function add_direct_purchase_invoice(){
        $branch_id=$this->session->userdata('companyId');
        $this->menu = 'General Store';
        $this->sub_menu = 'account';
        $this->sub_inner_menu = 'purchase_invoice';
        $this->titlebackend("Quotation Information");
        $sql="select tbp.*,s.SUP_NAME from tbl_bill_register tbp left join supplier s on tbp.supplier_id=s.ID where tbp.is_active=1 and tbp.verify_status='Pending'";
        $data['bills']=$this->m_common->customeQuery($sql);
        $data['suppliers']=$this->m_common->get_row_array('supplier','','*'); 
        $data['departments']=$this->m_common->get_row_array('department','','*'); 
       // $sql="select tios.*,i.item_name,i.item_type,i.item_code,ig.item_group as item_category,ic.c_name,tmu.meas_unit,tib.brand_name from tbl_item_opening_stock tios left join items i on tios.item_id=i.id left join item_groups ig on i.item_group=ig.id left join item_category ic on i.item_category=ic.c_id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_item_brand tib on tios.brand_id=tib.id where tios.unit_id=".$branch_id;
       // $data['items']=$this->m_common->customeQuery($sql);
        
        $i_sql="select i.*,tmu.meas_unit from items i left join tbl_measurement_unit tmu on i.mu_id=tmu.id";
        $data['items']=$this->m_common->customeQuery($i_sql);  
//        echo '<pre>';
//        print_r($data['items']);
//        exit;
        
        $this->load->view('purchase_invoices/v_add_direct_purchase_invoice',$data);
     
    }
    
    function add_direct_purchase_invoice_action(){
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            
            
            if(!empty($postData['supplier_id'])){
                $insertData['supplier_id']=$postData['supplier_id'];               
            }   
            
            if(!empty($postData['bill_id'])){
                 $insertData['bill_id']=$postData['bill_id'];
            }
                                       
            if(!empty($postData['inv_no'])){
                $insertData['inv_no'] = $postData['inv_no'];                
                $pre_invoice_info=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_no'=>$postData['inv_no']),'*');
                if(!empty($pre_invoice_info)){
                    redirect_with_msg('purchase_invoices', 'This invoice already exists');
                }
            }
            if (!empty($postData['invoice_date'])) {
                $insertData['invoice_date'] = date('Y-m-d', strtotime($postData['invoice_date']));
            }
            
            
            
           
           
           
            if (!empty($postData['total_amount'])){
                $insertData['total_amount'] = $postData['total_amount'];
            }
            
          
            if(!empty($postData['discount'])){
                 $insertData['discount']=$postData['discount'];
             }
             
             if(!empty($postData['vat'])){
                 $insertData['vat']=$postData['vat'];
             }
             
             if(!empty($postData['tax'])){
                 $insertData['tax']=$postData['tax'];
             }
             
             if(!empty($postData['ait'])){
                 $insertData['ait']=$postData['ait'];
             }
             
             if(!empty($postData['net_payable_amount'])){
                 $insertData['net_payable_amount']=$postData['net_payable_amount'];
             }
            
           
             
            $insertData['applicant_id'] = $userData[0]['employeeId']; 
            $insertData['audit_status']='Approved';
            $insertData['payment_status']='Pending';
            
            $insertData['branch_id'] = $branch_id;
            $insertData['is_active']=1;
            $insertData['invoice_type'] ="Direct";
            $insertData['status'] ="Pending";
            $insertData['created_date'] = date('Y-m-d');
            $result = $this->m_common->insert_row('tbl_purchase_invoices', $insertData);
            if(!empty($result)){
                $this->m_common->update_row('tbl_bill_register',array('id'=>$postData['bill_id']),array('verify_status'=>"Verified")); 
                $this->m_common->insert_row('tbl_purchase_invoice_code',array('inv_code'=>$postData['inv_code'],'supplier_id'=>$postData['supplier_id']));              
                foreach ($postData['item_id'] as $key => $each) {
                    
                        $insertData1 = array();
                        $insertData1['inv_id'] =$result;
                        $insertData1['item_id'] = $each;
                        $insertData1['is_active'] = 1;
                        $insertData1['received_status'] = 'Pending';


                        if (empty($each)) {
                            continue;
                        }                      

                        if (!empty($postData['quantity'][$key])) {
                            $insertData1['quantity'] = $postData['quantity'][$key];
                        }
                        if (!empty($postData['unit_price'][$key])) {
                            $insertData1['unit_price'] = $postData['unit_price'][$key];
                        }

                       

                        if (!empty($postData['amount'][$key])) {
                            $insertData1['amount'] = $postData['amount'][$key];
                        }
                        
                        if (!empty($postData['remark'][$key])) {
                            $insertData1['remark'] = $postData['remark'][$key];
                        }
                        
                        
                        $r = $this->m_common->insert_row('tbl_purchase_invoice_details', $insertData1);
                        
                    }
                
                redirect_with_msg('purchase_invoices', 'Successfully Inserted');
            }
        } else {
            redirect_with_msg('purchase_invoices/add_purchase_invoice', 'Please fill the form and submit');
        }
    }
    
    
     function edit_direct_purchase_invoice($id) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'procurement';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'purchase_invoice';
        
        $this->titlebackend("Invoice Information");
        
        $sql="select tbp.*,s.SUP_NAME from tbl_bill_register tbp left join supplier s on tbp.supplier_id=s.ID where tbp.is_active=1";
        $data['bills']=$this->m_common->customeQuery($sql);
        
        $sql="select o.*,s.SUP_NAME,d.dep_description,d.short_name from tbl_purchase_orders o left join  tbl_purchase_quotation q on o.q_id=q.q_id left join department d on o.unit_id=d.d_id left join supplier s on q.supplier_id=s.ID where o.is_active=1 and (o.status='Received' or o.status='Partially Received')";
        $data['orders']=$this->m_common->customeQuery($sql);
        $data['purchase_invoice_info']=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id'=>$id),'*');
    //    $sql="select d.*,i.item_name,i.meas_unit,mrr.mrr_challan from tbl_purchase_invoice_details d left join material_receive_requisition mrr on d.mrr_id=mrr.mrr_id left join items i on d.item_id=i.id where d.is_active=1 and inv_id=".$id;
        $sql="select d.*,i.item_name,tmu.meas_unit,mrr.mrr_challan,mrr_no,tpo.order_no from tbl_purchase_invoice_details d left join material_receive_requisition mrr on d.mrr_id=mrr.mrr_id left join tbl_purchase_orders tpo on mrr.po_id=tpo.o_id left join items i on d.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where d.is_active=1 and inv_id=".$id;
        $data['invoice_details_info']=$this->m_common->customeQuery($sql);
        
        $i_sql="select i.*,tmu.meas_unit from items i left join tbl_measurement_unit tmu on i.mu_id=tmu.id";
        $data['items']=$this->m_common->customeQuery($i_sql);
        
        
        $this->load->view('purchase_invoices/v_edit_direct_purchase_invoice',$data);
    }
    
    
     function details_direct_purchase_invoice($id) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'procurement';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'purchase_invoice';
        
        $this->titlebackend("Invoice Information");
        
        $sql="select tbp.*,s.SUP_NAME from tbl_bill_register tbp left join supplier s on tbp.supplier_id=s.ID where tbp.is_active=1";
        $data['bills']=$this->m_common->customeQuery($sql);
        
        $sql="select o.*,s.SUP_NAME,d.dep_description,d.short_name from tbl_purchase_orders o left join  tbl_purchase_quotation q on o.q_id=q.q_id left join department d on o.unit_id=d.d_id left join supplier s on q.supplier_id=s.ID where o.is_active=1 and (o.status='Received' or o.status='Partially Received')";
        $data['orders']=$this->m_common->customeQuery($sql);
        $data['purchase_invoice_info']=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id'=>$id),'*');
    //    $sql="select d.*,i.item_name,i.meas_unit,mrr.mrr_challan from tbl_purchase_invoice_details d left join material_receive_requisition mrr on d.mrr_id=mrr.mrr_id left join items i on d.item_id=i.id where d.is_active=1 and inv_id=".$id;
        $sql="select d.*,i.item_name,tmu.meas_unit,mrr.mrr_challan,mrr_no,tpo.order_no from tbl_purchase_invoice_details d left join material_receive_requisition mrr on d.mrr_id=mrr.mrr_id left join tbl_purchase_orders tpo on mrr.po_id=tpo.o_id left join items i on d.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where d.is_active=1 and inv_id=".$id;
        $data['invoice_details_info']=$this->m_common->customeQuery($sql);
        
        $i_sql="select i.*,tmu.meas_unit from items i left join tbl_measurement_unit tmu on i.mu_id=tmu.id";
        $data['items']=$this->m_common->customeQuery($i_sql);
        
        
        $this->load->view('purchase_invoices/v_details_direct_purchase_invoice',$data);
    }
    
    function edit_direct_purchase_invoice_action($inv_id){
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users',array('id'=>$user_id),'*');
        
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            
            
//            if(!empty($postData['supplier_id'])){
//                $insertData['supplier_id']=$postData['supplier_id'];               
//            }   
            
            if(!empty($postData['bill_id'])){
                 $insertData['bill_id']=$postData['bill_id'];
            }
                                               
            if (!empty($postData['invoice_date'])) {
                $insertData['invoice_date'] = date('Y-m-d', strtotime($postData['invoice_date']));
            }
            
            
            
           
           
           
            if (!empty($postData['total_amount'])){
                $insertData['total_amount'] = $postData['total_amount'];
            }
            
          
            if(!empty($postData['discount'])){
                 $insertData['discount']=$postData['discount'];
             }
             
             if(!empty($postData['vat'])){
                 $insertData['vat']=$postData['vat'];
             }
             
             if(!empty($postData['tax'])){
                 $insertData['tax']=$postData['tax'];
             }
             
             if(!empty($postData['ait'])){
                 $insertData['ait']=$postData['ait'];
             }
             
             if(!empty($postData['net_payable_amount'])){
                 $insertData['net_payable_amount']=$postData['net_payable_amount'];
             }
            
           
           // $insertData['unit_id'] = $branch_id;
            $insertData['is_active']=1;
            $insertData['invoice_type'] ="Direct";
            $insertData['updated_by'] = $userData[0]['employeeId'];
            $insertData['updated_date']=date('Y-m-d');
           
            $result = $this->m_common->update_row('tbl_purchase_invoices',array('inv_id'=>$inv_id),$insertData);
            if($result>=0){
                 $this->m_common->delete_row('tbl_purchase_invoice_details',array('inv_id'=>$inv_id));
            //    $this->m_common->insert_row('tbl_invoice_code', array('inv_code' =>$postData['inv_code'], 'customer_id' =>$postData['customer_id'], 'unit_id' =>$branch_id));

                foreach ($postData['item_id'] as $key => $each){
                    
                        $insertData1 = array();
                        $insertData1['inv_id'] =$inv_id;
                        $insertData1['item_id'] =$each;
                        $insertData1['is_active'] =1;
                        $insertData1['received_status'] ='Pending';


                        if (empty($each)) {
                            continue;
                        }                      

                        if (!empty($postData['quantity'][$key])) {
                            $insertData1['quantity'] = $postData['quantity'][$key];
                        }
                        if (!empty($postData['unit_price'][$key])) {
                            $insertData1['unit_price'] = $postData['unit_price'][$key];
                        }

                       

                        if (!empty($postData['amount'][$key])) {
                            $insertData1['amount'] = $postData['amount'][$key];
                        }
                        
                        if(!empty($postData['remark'][$key])){
                            $insertData1['remark'] = $postData['remark'][$key];
                        }
                        
                        

                        $r = $this->m_common->insert_row('tbl_purchase_invoice_details', $insertData1);
                        
                    }
                
                redirect_with_msg('purchase_invoices', 'Successfully Inserted');
            }
        } else {
            redirect_with_msg('purchase_invoices/add_purchase_invoice', 'Please fill the form and submit');
        }
    }
    
    
     function delete_direct_purchase_invoice($id){
        if(!empty($id)) {
            $invoice_info=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id' => $id),'*');
            $result=$this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id),array('is_active'=>0));
            if(!empty($result)){
                $this->m_common->update_row('tbl_purchase_invoice_details', array('inv_id' => $id),array('is_active'=>0));
                $this->m_common->update_row('tbl_bill_register',array('id'=>$invoice_info[0]['bill_id']),array('verify_status'=>'Pending'));
                redirect_with_msg('purchase_invoices/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('purchase_invoices/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('purchase_invoices/index', 'Please click on delete button');
        }
    }
    
    
    
     function get_order_item(){
        $branch_id= $this->session->userdata('companyId');   
        $this->setOutputMode(NORMAL);
        $po_id=$this->input->post('po_id');
        //$d_sql="select po.*,s.ID,s.SUP_NAME from tbl_purchase_orders po  join tbl_purchase_quotation pq on po.q_id=pq.q_id left join supplier s on pq.supplier_id=s.ID where po.o_id=".$po_id;
        $d_sql="select po.*,s.ID,s.SUP_NAME from tbl_purchase_orders po  left join supplier s on po.supplier_id=s.ID where po.o_id=".$po_id;
        $data['order_info']=$this->m_common->customeQuery($d_sql);
        $data['invoice_code']=$this->m_common->get_row_array('tbl_purchase_invoice_code',array('supplier_id'=>$data['order_info'][0]['ID'],'unit_id'=>$data['order_info'][0]['unit_id']),'*','',1,'id','DESC');
        $sql="select mrrd.*,i.item_name,tmu.meas_unit,mrr.mrr_challan from tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join  items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where mrrd.bill_status='Pending' and mrr.po_id=".$po_id;
        $data['item_list']=$this->m_common->customeQuery($sql);
        echo json_encode($data);
     }
     
     
     function get_challan_item(){
        $branch_id= $this->session->userdata('companyId');   
        $this->setOutputMode(NORMAL);
        $bill_id=$this->input->post('bill_id');
        $bill_info=$this->m_common->get_row_array('tbl_bill_register',array('id'=>$bill_id),'*');
        $d_sql="select * from supplier where ID=".$bill_info[0]['supplier_id'] ;
        $data['supplier_info']=$this->m_common->customeQuery($d_sql);
        $data['invoice_code']=$this->m_common->get_row_array('tbl_purchase_invoice_code',array('supplier_id'=>$data['supplier_info'][0]['ID']),'*','',1,'id','DESC');
      
        $sql="select mrrd.*,i.item_name,tmu.meas_unit,mrr.mrr_challan,mrr.mrr_no,tpo.order_no from tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders tpo on mrr.po_id=tpo.o_id left join  items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where mrrd.bill_status='Pending' and tpo.supplier_id=".$bill_info[0]['supplier_id'];
        $data['item_list']=$this->m_common->customeQuery($sql);
        
        $data['bill_date']=date('d-m-Y',strtotime($bill_info[0]['date']));
        $b_date=date('d-m-Y',strtotime($bill_info[0]['date']));
        
        echo json_encode($data);
     }
     
     
    
   
   function forward_invoice($id) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'general_store';
        $this->sub_menu = 'invoice';
        $this->sub_inner_menu = 'purchase_invoice';
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $invoice_info = $this->m_common->get_row_array("tbl_purchase_invoices", array('inv_id' => $id), "*");
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $invoice_info[0]['applicant_id']), "*");
        $approver_data = fetch_approver(2, 7, $approvers_info); //
       
        if ($employee_id == $approver_data[0]) {
            $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('audit_status' =>'Forward-By-First-Approver', 'approver_id' =>$approver_data[1],'approved_by' =>$employee_id,'approver_name' =>$approver_name));
            $array = array(
                "employee_id" => $approver_data[1],
                "title" => "Invoice approval",
                "notice" => "Please approve the invoice",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "purchase_invoices/details_purchase_invoice/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        if ($employee_id == $approver_data[1]) {
            $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('audit_status' => 'Forward-By-Second-Approver', 'approver_id' =>$approver_data[2],'approved_by' =>$employee_id,'approver_name' =>$approver_name));
            $array = array(
                "employee_id" =>$approver_data[2],
                "title" => "Invoice approval",
                "notice" => "Please approve the invoice",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "purchase_invoices/details_purchase_invoice/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        if ($employee_id == $approver_data[2]) {
            $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('audit_status' => 'Forward-By-First-Approver', 'approver_id' =>$approver_data[3],'approved_by' =>$employee_id,'approver_name' =>$approver_name));
            $array = array(
                "employee_id" => $approver_data[3],
                "title" => "Invoice approval",
                "notice" => "Please approve the invoice",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "purchase_invoices/details_purchase_invoice/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        
        redirect_with_msg('purchase_invoices', 'Forward Successfull');
    }
     
   function reject_invoice($id) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'general_store';
        $this->sub_menu = 'invoice';
        $this->sub_inner_menu = 'purchase_invoice';
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $invoice_info = $this->m_common->get_row_array("tbl_purchase_invoices", array('inv_id' => $id), "*");
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $invoice_info[0]['applicant_id']), "*");
        $approver_data = fetch_approver(2, 7, $approvers_info); //
        if($user_type==1){
            $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('audit_status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$invoice_info[0]['applicant_id'],
                    "title" => "Invoice approval",
                    "notice" => "The invoice is rejected by admin",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "purchase_invoices/details_purchase_invoice/".$id
                );
                $this->m_common->insert_row("notice", $array);
        }else{
            if ($employee_id == $approver_data[0]) {
                $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('audit_status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$invoice_info[0]['applicant_id'],
                    "title" => "Invoice approval",
                    "notice" => "The invoice is rejected by first approver",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "purchase_invoices/details_purchase_invoice/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[1]) {
                $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('audit_status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$invoice_info[0]['applicant_id'],
                    "title" => "Invoice approval",
                    "notice" => "The invoice is rejected by second approver",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "purchase_invoices/details_purchase_invoice/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[2]) {
                $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('audit_status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$invoice_info[0]['applicant_id'],
                    "title" => "Invoice approval",
                    "notice" => "The invoice is rejected by third approver",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "purchase_invoices/details_purchase_invoice/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[3]) {
                $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('audit_status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$invoice_info[0]['applicant_id'],
                    "title" => "Invoice approval",
                    "notice" => "The invoice is rejected by forth approver",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "purchase_invoices/details_purchase_invoice/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
        }     
        redirect_with_msg('purchase_invoices', 'Rejected Successfully');
    }
     
   function approve_invoice($id) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'general_store';
        $this->sub_menu = 'invoice';
        $this->sub_inner_menu = 'purchase_invoice';
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $invoice_info = $this->m_common->get_row_array("tbl_purchase_invoices", array('inv_id' => $id), "*");
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $invoice_info[0]['applicant_id']), "*");
        $approver_data = fetch_approver(2, 7, $approvers_info); //
        if($user_type==1){
            $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('audit_status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
            $array = array(
                "employee_id" =>$invoice_info[0]['applicant_id'],
                "title" => "Invoice approval",
                "notice" => "The invoice is approved",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "purchase_invoices/details_purchase_invoice/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }else{
            if ($employee_id == $approver_data[0]) {
                $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('audit_status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$invoice_info[0]['applicant_id'],
                    "title" => "Invoice approval",
                    "notice" => "The invoice is approved",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "purchase_invoices/details_purchase_invoice/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[1]) {
                $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('audit_status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$invoice_info[0]['applicant_id'],
                    "title" => "Invoice approval",
                    "notice" => "The invoice is approved",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "purchase_invoices/details_purchase_invoice/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[2]) {
                $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('audit_status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$invoice_info[0]['applicant_id'],
                    "title" => "Invoice approval",
                    "notice" => "The invoice is approved",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "purchase_invoices/details_purchase_invoice/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[3]) {
                $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('audit_status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$invoice_info[0]['applicant_id'],
                    "title" => "Invoice approval",
                    "notice" => "The invoice is approved",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "purchase_invoices/details_purchase_invoice/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
        }     
        redirect_with_msg('purchase_invoices', 'Approved Successfully');
    }
    
    function addRemark(){
        $this->setOutputMode(NORMAL);
        $inv_id=$this->input->post('inv_id');
        $remark=$this->input->post('remark');
        $result=$this->m_common->update_row('tbl_purchase_invoices',array('inv_id'=>$inv_id),array('remark'=>$remark));
        if($result>=0){
            $data['status']="success";    
            //redirect_with_msg('purchase_invoices/details_purchase_invoice/'.$inv_id,"Sucessfully remark added");
        }else{
            $data['status']="fail";
        }
        echo json_encode($data);
    }
    
    
    function get_supplier_balance(){
        $this->setOutputMode(NORMAL);
        $id=$this->input->post('supplier_id');
        $supplier_info=$this->m_common->get_row_array('supplier',array('ID'=>$id),'*');
        
        $sql="select sum(ac.amount) as total_amount from assigned_cheque ac LEFT JOIN supplier s on ac.p_id= s.ID where ac.status='Completed' and ac.p_id=".$id;
        $total_checkpayment=$this->m_common->customeQuery($sql);
        
        $cash_sql="select sum(amount) as total_cash_payment from tbl_bills_payment where supplier_id=$id";
        $total_cashpayment=$this->m_common->customeQuery($cash_sql);
        
        $net_total_paid=$total_cashpayment[0]['total_cash_payment']+$total_checkpayment[0]['total_amount']+$supplier_info[0]['opening_balance']; 
        
        $tb_sql="select sum(paid_amount) as total_paid from tbl_purchase_invoices v where (v.payment_status='Paid' or v.payment_status='Partial Paid') and v.is_active=1 and v.supplier_id=".$id;
        $total_bill_payment=$this->m_common->customeQuery($tb_sql);
        $net_balance=$net_total_paid-$total_bill_payment[0]['total_paid']; 
        if($net_balance>0){
            $data['supplier_balance']=round($net_balance,2);
        }else{
            $data['supplier_balance']=0;
        }
        echo json_encode($data);
    }
    
    
    
    function confirm_payment(){
        try {
            $this->db->trans_start();
            $branch_id=$this->session->userdata('companyId');
            $this->setOutputMode(NORMAL);
            $id = $this->input->post('id');
            $amt = $this->input->post('amt');
            $inv_type = $this->input->post('inv_type');
            
            $invoice_info = $this->m_common->get_row_array('tbl_purchase_invoices', array('inv_id' => $id), '*');
            $sql = "select * from tbl_purchase_invoice_details where (received_status='Pending' or received_status='Partial Paid') and inv_id=" . $id;
            $invoice_details_info = $this->m_common->customeQuery($sql);
            $collection_amount = $amt;
            foreach($invoice_details_info as $key => $inv_detail){
                if($collection_amount <= 0){
                    break;
                }
                $r_amount = $inv_detail['amount'] - $inv_detail['paid_amount'];
                if ($collection_amount<$r_amount){
                    $r_amount=$collection_amount;
                }

                $net_r_amount=$inv_detail['paid_amount']+$r_amount;

                if ($net_r_amount == $inv_detail['amount']){
                    $r_status = "Paid";
                } else {
                    $r_status = "Partial Paid";
                }
                // $this->m_common->update_row('tbl_sales_invoice_details',array('inv_id'=>$collection_info[0]['invoice_id'],'s_item_id'=>$inv_detail['s_item_id']),array('received_amount'=>$net_r_amount,'received_status'=>$r_status));
                $this->m_common->update_row('tbl_purchase_invoice_details', array('inv_d_id' => $inv_detail['inv_d_id']), array('paid_amount' => $net_r_amount, 'received_status' => $r_status));
                $collection_amount = $collection_amount - $r_amount;
            }
            $paid_amount=$amt+$invoice_info[0]['paid_amount'];
            if($paid_amount >= $invoice_info[0]['net_payable_amount']){
                $status = 'Paid';
            }else{
                $status = 'Partial Paid';
            }
            if($inv_type=="Direct"){
                $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('paid_amount' =>$paid_amount,'payment_status' =>$status));               
              
            }else{
                $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('paid_amount' =>$paid_amount,'payment_status'=>$status));                                          
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_complete();
            }
            echo 'success';
        } catch (UserException $error) {
            $this->db->trans_rollback();
            echo '<pre>';
            print_r($error);
            exit;
            redirect_with_msg('payment_collections/add_collection', 'Something went wrong');
        }
    }
    
    
    
    
}





