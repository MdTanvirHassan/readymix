<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accounts extends Site_Controller {

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
       // $this->menu = 'general_store';
        $this->menu = 'procurement';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'bill_receive';
        $this->titlebackend("Purchase Invoices");
      //  $sql="select tbp.*,tpi.inv_no,s.SUP_NAME from tbl_bills_payment tbp left join tbl_purchase_invoices tpi on tbp.inv_id=tpi.inv_id left join tbl_purchase_orders tpo on tpi.po_id=tpo.o_id left join supplier s on tpo.supplier_id=s.ID  where tbp.is_active=1";
      //  $sql="select tbp.*,tpi.inv_no,s.SUP_NAME,tpm.mode_name from tbl_bills_payment tbp left join tbl_purchase_invoices tpi on tbp.inv_id=tpi.inv_id left join tbl_purchase_orders tpo on tpi.po_id=tpo.o_id left join supplier s on tpo.supplier_id=s.ID left join tbl_payment_mode tpm on tbp.payment_method=tpm.id where tbp.is_active=1";
        $sql="select tbp.*,s.SUP_NAME from tbl_bill_register tbp left join supplier s on tbp.supplier_id=s.ID where tbp.is_active=1";
        $data['bills']=$this->m_common->customeQuery($sql);
        $this->load->view('accounts/v_bills',$data);
        
        
        
    }
    
     function paid_invoice() {
        $branch_id= $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $this->menu = 'general_store';
        $this->sub_menu = 'accounts';
        $this->sub_inner_menu = 'paid_invoice';
        $this->titlebackend("Purchase Invoices");
      //  $sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join tbl_purchase_quotation q on o.q_id=q.q_id left join supplier s on q.supplier_id=s.ID left join department d on o.unit_id=d.d_id where v.payment_status='Paid' and v.is_active=1";      
        $sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on o.supplier_id=s.ID left join department d on o.unit_id=d.d_id where v.payment_status='Paid' and v.is_active=1";      
        $data['invoices']=$this->m_common->customeQuery($sql);
        $this->load->view('accounts/v_paid_invoice',$data);
    }
    
    
     function unpaidBill(){
        $branch_id= $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
       // $this->menu = 'general_store';
        $this->menu = 'accounts';
        $this->sub_menu = 'accounts';
        $this->sub_inner_menu = 'unpaid_invoice';
        $this->titlebackend("Purchase Invoices");
        //$sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join tbl_purchase_quotation q on o.q_id=q.q_id left join supplier s on q.supplier_id=s.ID left join department d on o.unit_id=d.d_id where (v.payment_status='Pending' or v.payment_status='Partially Paid') and v.is_active=1";    
        $sql="select v.*,o.order_no,o.supplier_id,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on o.supplier_id=s.ID left join department d on o.unit_id=d.d_id where (v.payment_status='Pending' or v.payment_status='Partially Paid') and v.is_active=1";      
        $data['invoices']=$this->m_common->customeQuery($sql);
        $this->load->view('accounts/v_pending_invoice',$data);
    }
    
    function add_bill() {
        $branch_id= $this->session->userdata('companyId');
       // $this->menu = 'general_store';
        $this->menu = 'procurement';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'bill_receive';
        $this->titlebackend("Add Payment");
        $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
        $data['banks']=$this->m_common->get_row_array('tbl_banks',array('is_active'=>1),'*');
       
      
        $this->load->view('accounts/v_add_bill',$data);
    }
    
    
    
     function add_bill_action() {
         $branch_id= $this->session->userdata('companyId');
         $employee_id = $this->session->userdata('employeeId');
         $user_type = $this->session->userdata('user_type');
         $user_id = $this->session->userdata('user_id');
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             
             if(!empty($postData['supplier_id'])){
                 $insertData['supplier_id']=$postData['supplier_id'];
             }
             
             if(!empty($postData['supplier_bill_no'])){
                 $insertData['supplier_bill_no']=$postData['supplier_bill_no'];

             }
             
             if(!empty($postData['amount'])){
                 $insertData['amount']=$postData['amount'];

             }
             if(!empty($postData['date'])){
                 $insertData['date']=date('Y-m-d',strtotime($postData['date']));
             }
             
             if(!empty($postData['remark'])){
                 $insertData['remark']=$postData['remark'];
             }
             
             $insertData['is_active']=1;
   
          
            $insertData['created_by']=$employee_id;
             
             $insertData['created_date']=date('Y-m-d');
             
             $result=$this->m_common->insert_row('tbl_bill_register',$insertData);
             if(!empty($result)){


                redirect_with_msg('accounts', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('accounts/add_bill', 'Please fill the form and submit');
         }
         
     }
    
     function edit_bill($id) {
        $branch_id= $this->session->userdata('companyId');   
        $this->menu = 'procurement';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'bill_receive';
        $this->titlebackend("Quotation Information");
        $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
        
        $data['bill_info']=$this->m_common->get_row_array('tbl_bill_register',array('id'=>$id),'*');
        
       
        $this->load->view('accounts/v_edit_bill',$data);
    }
     
    function edit_bill_action($id) {
         $branch_id= $this->session->userdata('companyId');
         $employee_id = $this->session->userdata('employeeId');
         $user_type = $this->session->userdata('user_type');
         $user_id = $this->session->userdata('user_id');
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             
             if(!empty($postData['supplier_id'])){
                 $insertData['supplier_id']=$postData['supplier_id'];
             }
             
             if(!empty($postData['supplier_bill_no'])){
                 $insertData['supplier_bill_no']=$postData['supplier_bill_no'];

             }
             
             if(!empty($postData['amount'])){
                 $insertData['amount']=$postData['amount'];

             }
             if(!empty($postData['date'])){
                 $insertData['date']=date('Y-m-d',strtotime($postData['date']));
             }
             
             if(!empty($postData['remark'])){
                 $insertData['remark']=$postData['remark'];
             }
                                   
             $insertData['updated_by']=$employee_id;
             
             $insertData['updated_date']=date('Y-m-d');
             
             $result=$result=$this->m_common->update_row('tbl_bill_register',array('id'=>$id),$insertData);
             if($result>=0){


                redirect_with_msg('accounts', 'Successfully Updated');
             }
         }else{
               redirect_with_msg('accounts/edit_bill/'.$id, 'Please fill the form and submit');
         }
         
     }
    
     function delete_bill($id) {
        if(!empty($id)) {
         //   $do_id=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id' => $id),'*');
            $id = $this->m_common->update_row('tbl_bill_register', array('id' => $id),array('is_active'=>0));
            if (!empty($id)) {
               
                redirect_with_msg('accounts', 'Successfully Deleted');
            } else {
                redirect_with_msg('accounts', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('accounts', 'Please click on delete button');
        }
    }
     
      function details_bill($id) {
        $branch_id= $this->session->userdata('companyId');   
        $this->menu = 'procurement';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'bill_receive';
        $this->titlebackend("Bill Information");
        $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
        
        $data['bill_info']=$this->m_common->get_row_array('tbl_bill_register',array('id'=>$id),'*');
      
        $this->load->view('accounts/v_details_bill',$data);
    }
     
     
     function payment() {
        $branch_id= $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $this->menu = 'general_store';
        $this->sub_menu = 'accounts';
        $this->sub_inner_menu = 'payment';
        $this->titlebackend("Purchase Invoices");
      //  $sql="select tbp.*,tpi.inv_no,s.SUP_NAME from tbl_bills_payment tbp left join tbl_purchase_invoices tpi on tbp.inv_id=tpi.inv_id left join tbl_purchase_orders tpo on tpi.po_id=tpo.o_id left join supplier s on tpo.supplier_id=s.ID  where tbp.is_active=1";
      //  $sql="select tbp.*,tpi.inv_no,s.SUP_NAME,tpm.mode_name from tbl_bills_payment tbp left join tbl_purchase_invoices tpi on tbp.inv_id=tpi.inv_id left join tbl_purchase_orders tpo on tpi.po_id=tpo.o_id left join supplier s on tpo.supplier_id=s.ID left join tbl_payment_mode tpm on tbp.payment_method=tpm.id where tbp.is_active=1";
        $sql="select tbp.*,s.SUP_NAME from tbl_bills_payment tbp left join supplier s on tbp.supplier_id=s.ID left join tbl_payment_mode tpm on tbp.payment_method=tpm.id where tbp.is_active=1";
        $data['payments']=$this->m_common->customeQuery($sql);
        $this->load->view('accounts/v_bills_payment',$data);
    }
    
    function add_payment() {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'general_store';
        $this->sub_menu = 'accounts';
        $this->sub_inner_menu = 'payment';
        $this->titlebackend("Add Payment");
        $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
        $data['banks']=$this->m_common->get_row_array('tbl_banks',array('is_active'=>1),'*');
        $data['payment_modes']=$this->m_common->get_row_array('tbl_payment_mode',array('is_active'=>1),'*');
      //  $sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join tbl_purchase_quotation q on o.q_id=q.q_id left join supplier s on q.supplier_id=s.ID left join department d on o.unit_id=d.d_id where (v.payment_status='Pending' or v.payment_status='Partially Paid') and v.is_active=1";   
        $sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on o.supplier_id=s.ID left join department d on o.unit_id=d.d_id where (v.payment_status='Pending' or v.payment_status='Partially Paid') and v.is_active=1";      
        $data['invoices']=$this->m_common->customeQuery($sql);
        $this->load->view('accounts/v_add_payment',$data);
    }
    
    
    function add_payment_action() {
         $branch_id= $this->session->userdata('companyId');
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             
             if(!empty($postData['supplier_id'])){
                 $insertData['supplier_id']=$postData['supplier_id'];
             }
             
             
             
             if(!empty($postData['amount'])){
                 $insertData['amount']=$postData['amount'];

             }
             if(!empty($postData['payment_date'])){
                 $insertData['payment_date']=date('Y-m-d',strtotime($postData['payment_date']));
             }
             
             if(!empty($postData['remark'])){
                 $insertData['remark']=$postData['remark'];
             }
             
             $insertData['is_active']=1;
   
          
             $insertData['payment_status']='Pending'; 
             
             $insertData['created_date']=date('Y-m-d');
             
             $result=$this->m_common->insert_row('tbl_bills_payment',$insertData);
             if(!empty($result)){


                redirect_with_msg('accounts/payment', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('accounts/add_payment', 'Please fill the form and submit');
         }
         
     }

     
      function edit_payment($id) {
        $branch_id= $this->session->userdata('companyId');   
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_collection';
        $this->titlebackend("Quotation Information");
        $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
        $sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join tbl_purchase_quotation q on o.q_id=q.q_id left join supplier s on q.supplier_id=s.ID left join department d on o.unit_id=d.d_id where (v.payment_status='Pending' or v.payment_status='Partially Paid') and v.is_active=1";      
        $data['invoices']=$this->m_common->customeQuery($sql);
        $data['payment_info']=$this->m_common->get_row_array('tbl_bills_payment',array('id'=>$id),'*');
        $data['invoice_info']=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id'=>$data['payment_info'][0]['inv_id']),'*');   
       // $data['payment_mode']=$this->m_common->get_row_array('tbl_purchase_order_payment_condition',array('o_id'=>$data['invoice_info'][0]['po_id']),'*');
        $data['payment_modes']=$this->m_common->get_row_array('tbl_payment_mode',array('is_active'=>1),'*');
        $data['banks']=$this->m_common->get_row_array('tbl_banks',array('is_active'=>1),'*');
      
        $this->load->view('accounts/v_edit_payment',$data);
    }
   
   function edit_payment_action($id) {
         $branch_id= $this->session->userdata('companyId');
         $postData=$this->input->post();
         $existCollection=$this->m_common->get_row_array('tbl_bills_payment',array('id'=>$id),'*');
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             if(!empty($postData['supplier_id'])){
                 $insertData['supplier_id']=$postData['supplier_id'];
             }
                                       
             if(!empty($postData['amount'])){
                 $insertData['amount']=$postData['amount'];

             }
             if(!empty($postData['payment_date'])){
                 $insertData['payment_date']=date('Y-m-d',strtotime($postData['payment_date']));
             }
            
             if(!empty($postData['remark'])){
                 $insertData['remark']=$postData['remark'];
             }
             $result=$this->m_common->update_row('tbl_bills_payment',array('id'=>$id),$insertData);
             if($result>=0){                 
                redirect_with_msg('accounts/payment', 'Successfully Updated');
             }else{
                  redirect_with_msg('accounts/edit_payment/'.$id, 'Not Updated');
             }
             
         }else{
              redirect_with_msg('accounts/edit_payment/'.$id, 'Please fill the form and submit');
         }
         
     }
     
   function details_payment($id) {
        $branch_id= $this->session->userdata('companyId');   
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_collection';
        $this->titlebackend("Quotation Information");
        $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
        $sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join tbl_purchase_quotation q on o.q_id=q.q_id left join supplier s on q.supplier_id=s.ID left join department d on o.unit_id=d.d_id where (v.payment_status='Pending' or v.payment_status='Partially Paid') and v.is_active=1";      
        $data['invoices']=$this->m_common->customeQuery($sql);
        $data['payment_info']=$this->m_common->get_row_array('tbl_bills_payment',array('id'=>$id),'*');
        $data['invoice_info']=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id'=>$data['payment_info'][0]['inv_id']),'*');   
        $data['payment_modes']=$this->m_common->get_row_array('tbl_payment_mode',array('is_active'=>1),'*');
        $data['banks']=$this->m_common->get_row_array('tbl_banks',array('is_active'=>1),'*');
      
        $this->load->view('accounts/v_details_payment',$data);
    }
    
    
    function payment_voucher($id){
        $branch_id= $this->session->userdata('companyId');   
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_collection';
        $this->titlebackend("Quotation Information");
        $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
        $sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join tbl_purchase_quotation q on o.q_id=q.q_id left join supplier s on q.supplier_id=s.ID left join department d on o.unit_id=d.d_id where (v.payment_status='Pending' or v.payment_status='Partially Paid') and v.is_active=1";      
        $data['invoices']=$this->m_common->customeQuery($sql);
        $sql1=$sql="select tbp.*,s.SUP_NAME from tbl_bills_payment tbp left join supplier s on tbp.supplier_id=s.ID left join tbl_payment_mode tpm on tbp.payment_method=tpm.id where tbp.id=$id and tbp.is_active=1";
        $data['payment_info']=$this->m_common->customeQuery($sql1);
        $data['invoice_info']=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id'=>$data['payment_info'][0]['inv_id']),'*');   
        $data['payment_modes']=$this->m_common->get_row_array('tbl_payment_mode',array('is_active'=>1),'*');
        $data['banks']=$this->m_common->get_row_array('tbl_banks',array('is_active'=>1),'*');
      
        $this->load->view('accounts/invoice',$data);
    }
    
   
    function delete_payment($id) {
        if(!empty($id)) {
         //   $do_id=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id' => $id),'*');
            $id = $this->m_common->update_row('tbl_bills_payment', array('id' => $id),array('is_active'=>0));
            if (!empty($id)) {
               
                redirect_with_msg('accounts/payment', 'Successfully Deleted');
            } else {
                redirect_with_msg('accounts/payment', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('accounts/payment', 'Please click on delete button');
        }
    }
    
   function get_payment_mode(){
        $this->setOutputMode(NORMAL);
        $branch_id= $this->session->userdata('companyId');
        $inv_id=$this->input->post('inv_id');
        $data['invoice_info']=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id'=>$inv_id),'*');   
      //  $data['payment_mode']=$this->m_common->get_row_array('tbl_purchase_order_payment_condition',array('o_id'=>$data['invoice_info'][0]['po_id']),'*');   
        echo json_encode($data);
    }
    
     function billPayment($c_id){
         $payment_info=$this->m_common->get_row_array('tbl_bills_payment',array('id'=>$c_id),'*');
         
         $result=$this->m_common->update_row('tbl_bills_payment',array('id'=>$c_id),array('payment_status'=>"Paid"));
         if(!empty($result)){
        
           
            if(!empty($payment_info[0]['inv_id'])){
                $invoice_info=$this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id'=>$payment_info[0]['inv_id']),'*');             
                $paid_amount=$payment_info[0]['amount'];
                $net_paid_amount=$paid_amount+$invoice_info[0]['paid_amount'];  
                if($net_paid_amount==$invoice_info[0]['total_amount']){
                    $status="Paid";
                }else{
                    $status="Partially Paid";
                }
              
                $this->m_common->update_row('tbl_purchase_invoices',array('inv_id'=>$payment_info[0]['inv_id']),array('paid_amount'=>$net_paid_amount,'payment_status'=>$status));
            }
            
           
           
            redirect_with_msg('accounts/payment', 'Successfully Paid');
         }
     }
     
     
    function get_supplier_balance(){
        $this->setOutputMode(NORMAL);
        $id=$this->input->post('supplier_id');
        
        $supplier_info=$this->m_common->get_row_array('supplier',array('ID'=>$id),'*');
        
        
        $sql = "select sum(ac.amount) as total_amount from assigned_cheque ac LEFT JOIN supplier s on ac.p_id= s.ID where ac.status='Completed' and ac.p_id=".$id;
        $total_payment=$this->m_common->customeQuery($sql);
        
            
        $total_payment=$total_payment[0]['total_amount']+$supplier_info[0]['opening_balance']; 
        
        $tb_sql="select sum(paid_amount) as total_paid from tbl_purchase_invoices v left join tbl_purchase_orders tpo on v.po_id=tpo.o_id left join supplier s on tpo.supplier_id=s.ID where  v.is_active=1 and tpo.supplier_id=".$id;
        $total_bill_payment=$this->m_common->customeQuery($tb_sql);
        $net_balance=$total_payment-$total_bill_payment[0]['total_paid']; 
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
            
            $invoice_info = $this->m_common->get_row_array('tbl_purchase_invoices',array('inv_id' =>$id),'*');
            $sql = "select * from tbl_purchase_invoice_details where (status='Pending' or status='Partially Paid') and inv_id=" . $id;
            $invoice_details_info = $this->m_common->customeQuery($sql);
            $paid_amount = $amt;
            foreach($invoice_details_info as $key => $inv_detail){
                if($paid_amount <= 0){
                    break;
                }
                $p_amount =$inv_detail['amount']-$inv_detail['paid_amount'];
                if($paid_amount<$p_amount){
                    $p_amount = $paid_amount;
                }

                $net_p_amount=$inv_detail['paid_amount']+$p_amount;

                if ($net_p_amount == $inv_detail['amount']){
                    $p_status = "Paid";
                } else {
                    $p_status = "Partially Paid";
                }
                // $this->m_common->update_row('tbl_sales_invoice_details',array('inv_id'=>$collection_info[0]['invoice_id'],'s_item_id'=>$inv_detail['s_item_id']),array('received_amount'=>$net_r_amount,'received_status'=>$r_status));
                $this->m_common->update_row('tbl_purchase_invoice_details', array('inv_d_id' => $inv_detail['inv_d_id']), array('paid_amount' => $net_p_amount, 'status' =>$p_status));
                $paid_amount =$paid_amount-$r_amount;
            }
            $total_paid_amount = $amt + $invoice_info[0]['paid_amount'];
            if($total_paid_amount >= $invoice_info[0]['total_amount']){
                $status = 'Paid';
            } else {
                $status = 'Partially Paid';
            }
            
            $this->m_common->update_row('tbl_purchase_invoices', array('inv_id' => $id), array('paid_amount' =>$total_paid_amount,'payment_status' =>$status));               
                
            

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





