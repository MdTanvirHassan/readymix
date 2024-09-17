<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customers extends Site_Controller {

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
        $test=$this->session->userdata('companyId');
        $this->company_id = $this->session->userdata('companyId');
        if(empty($this->company_id)){
             redirect_with_msg('backend/dashboard', 'Please click on enter here button to see this page');
        }
    }

    function index() {
        $this->menu = 'trading';
        $this->sub_menu = 'trading';
        $this->sub_inner_menu = 'rm_customer';
        $this->titlebackend("Customers Basic Info");
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1,'customer_category'=>'Raw Material'),'*');
        $this->load->view('raw_materials/customers/v_customers',$data);
    }
    function opening_balance() {
        $this->menu = 'trading';
        $this->sub_menu = 'trading';
        $this->sub_inner_menu = 'opening_balance';
        $this->titlebackend("Customers Basic Info");
        $customer_id=$this->input->post('customer_id');
        $data['customer_id']=$customer_id;
        if(!empty($customer_id)){
            $postData = $this->input->post();
            if(!empty($postData)){
                foreach($postData['customer'] as $customer =>$each){
                    if(!empty($each)){
                        $sql = "update tbl_customers set opening_balance = ".$each.' where id='.$customer;
                    }else{
                        continue;
                    }
                    //$this->m_common->update_row('tbl_customers',array('id'=>$customer), array('opening_balance'=>$each));
                    $this->m_common->customeUpdate($sql);
                }
            }
        }else{
            $postData = $this->input->post();
            if(!empty($postData)){
                foreach($postData['customer'] as $customer =>$each){
                    if(!empty($each)){
                        $sql = "update tbl_customers set opening_balance = ".$each.' where id='.$customer;
                    }else{
                        continue;
                    }
                    //$this->m_common->update_row('tbl_customers',array('id'=>$customer), array('opening_balance'=>$each));
                    $this->m_common->customeUpdate($sql);
                }
            }
        }  
        if(!empty($customer_id)){
            $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1,'id'=>$customer_id),'*');
        }else{
            $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        }
        $data['all_customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        $this->load->view('raw_materials/customers/v_opening_balance',$data);
    }
    
    
    
    function customer_search() {
        $this->menu = 'trading';
        $this->sub_menu = 'trading';
        $this->sub_inner_menu = 'opening_balance';
        $this->titlebackend("Customers Basic Info");
        $customer_id=$this->input->post('customer_id');           
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1,'id'=>$customer_id),'*');
        $this->load->view('raw_materials/customers/v_opening_balance',$data);
    }
    
    
    function add_customer() {
        $this->menu='trading';
        $this->sub_menu='trading';
        $this->sub_inner_menu='rm_customer';
        $this->titlebackend("Customer Information");
        $customer_last_code=$this->m_common->get_row_array('tbl_customer_code','','*','',1,'id','DESC');
        if(!empty($customer_last_code)){
            $customer_code=$customer_last_code[0]['customer_code']+1;
            if($customer_code>999){
                $customer_sl_no=$customer_code;
            }else if($customer_code>99){
                $customer_sl_no="0".$customer_code;
            }else if($customer_code>9){
                $customer_sl_no="00".$customer_code;
            }else{
                $customer_sl_no="000".$customer_code;
            }
        }else{
            $customer_code=1;
            $customer_sl_no='0001';
        }
        $data['customer_code']=$customer_code;
        $data['customer_auto_code']=$customer_sl_no;
        $data['employees']=$this->m_common->get_row_array('employees','','*');
        $this->load->view('raw_materials/customers/v_add_customer',$data);
    }
    
    
    function add_customer_action() {
        $data = $this->input->post();
        $customer_code= $this->input->post('customer_code');
        if (!empty($data)) {
            unset($data['customer_code']); 
            $pre_customer=$this->m_common->get_row_array('tbl_customers',array('c_name'=>$data['c_name'],'is_active'=>1),'*');
            if(!empty($pre_customer)){
                redirect_with_msg('raw_materials/customers/add_customer', 'This customer already exists.');
            }
            $data['is_active']=1;
            $data['customer_category']="Raw Material";
            $id = $this->m_common->insert_row('tbl_customers', $data);
            
            if (!empty($id)) {
                $this->m_common->insert_row('tbl_customer_code', array('customer_code'=>$customer_code));
                redirect_with_msg('raw_materials/customers/add_customer', 'Successfully Inserted');
            } else {
                redirect_with_msg('raw_materials/customers/add_customer', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/customers/add_customer', 'Please fill the form and submit');
        }
    }
    
    function edit_customer($id){
        $this->menu = 'trading';
        $this->sub_menu = 'trading';
        $this->sub_inner_menu = 'rm_customer';
        $this->titlebackend("Customers Basic Info");
        $data['employees']=$this->m_common->get_row_array('employees','','*');
        $data['customer_info']=$this->m_common->get_row_array('tbl_customers',array('id'=>$id,'customer_category'=>'Raw Material'),'*');
        $this->load->view('raw_materials/customers/v_edit_customer',$data);
    }
   
    function edit_customer_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $id=$this->m_common->update_row('tbl_customers', array('id' => $id), $data);
            if (!empty($id)) {
                redirect_with_msg('raw_materials/customers/index', 'Successfully Updated');
            } else {
                redirect_with_msg('raw_materials/customers/edit_customer/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/customers/edit_customer/'.$id, 'Please fill the form and submit');
        }
    }
    
    function details_customer($id){
        $this->menu = 'trading';
        $this->sub_menu = 'trading';
        $this->sub_inner_menu = 'rm_customer';
        
        $this->titlebackend("Customers Basic Info");
        $branch_id = $this->session->userdata('companyId');
        $data['customer_info']=$this->m_common->get_row_array('tbl_customers',array('id'=>$id,'customer_category'=>'Raw Material'),'*');
        $data['sales_quotation']=$this->m_common->get_row_array('tbl_sales_quotation',array('customer_id'=>$id),'*');
      //  $so_sql="select so.* from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id where sq.customer_id=".$id;
        $pc_sql="select tpc.*, p.project_name as p_name, prod.product_name from tbl_product_quote_price tpc 
JOIN tbl_project  p on tpc.product_id=p.project_id 
JOIN tbl_sales_products  prod on tpc.product_id = prod.product_id where tpc.customer_id=".$id;
        $data['product_cost']=$this->m_common->customeQuery($pc_sql);
        
        $so_sql="select o.*,q.reference_no,c.c_name,c.c_short_name from tbl_sales_orders o left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where o.is_active=1 and o.customer_id=".$id;
        $data['sale_orders']=$this->m_common->customeQuery($so_sql);
        
        $do_sql="SELECT deo.*,seo.order_no,seo.q_id,seo.customer_id 
from tbl_delivery_orders as deo 
JOIN tbl_sales_orders as seo ON deo.o_id=seo.o_id 
WHERE seo.customer_id=".$id;
        $data['delivery_orders']=$this->m_common->customeQuery($do_sql);
        
        $dc_sql="select dc.*,deo.delivery_no,deo.o_id,so.customer_id as cust_id,dcd.quantity,dcd.unit_price,dcd.mu_name,dcd.receive_status from tbl_delivery_challans dc 
JOIN tbl_delivery_challan_details dcd on dc.dc_id=dcd.dc_id
JOIN tbl_delivery_orders deo on dc.do_id=deo.do_id
JOIN tbl_sales_orders so on deo.o_id=so.o_id
where so.customer_id=".$id;
        $data['delivery_challan']=$this->m_common->customeQuery($dc_sql);
        
        $inv_sql="select v.*,do.delivery_no,c.c_name,c.c_short_name from tbl_sales_invoices v left join tbl_delivery_orders do on v.do_id=do.do_id left join tbl_customers c on v.customer_id=c.id where v.status!='Canceled' and v.is_active=1 and v.customer_id=".$id." order by v.sale_invoice_date DESC";
        $data['invoices']=$this->m_common->customeQuery($inv_sql);
        
       // $pc_sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.is_active=1 and pc.payment_status='Collected' order by pc.id desc";
        $pc_sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.is_active=1 and (pc.payment_status='Collected' || pc.payment_status='Deposited' || pc.payment_status='Dishonored') order by pc.id desc";
        $data['payment_collections'] = $this->m_common->customeQuery($pc_sql);
        
        $pr_sql = "select pc.* from tbl_payment_collections pc  where pc.is_active=1 and pc.payment_status='Received' and pc.customer_id=".$id." order by pc.id desc";
        $data['payment_receive'] = $this->m_common->customeQuery($pr_sql);
        
        
        $t_re ="select sum(amount) as total_amount from tbl_payment_collections pc  where pc.is_active=1 and pc.payment_status='Received' and pc.customer_id=".$id;
        $total_received= $this->m_common->customeQuery($t_re);
            
        $data['total_deposit']=$total_received[0]['total_amount']+$data['customer_info'][0]['opening_balance']; 
        
        $tb_sql="select sum(total_amount) as total_bill from tbl_sales_invoices v where v.status!='Canceled' and v.is_active=1 and v.customer_id=".$id;
        $total_bill=$this->m_common->customeQuery($tb_sql);
        $data['total_bill']=$total_bill[0]['total_bill']; 
        
        $hand_sql = "select sum(pc.amount) as total_amount from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.is_active=1 and (pc.payment_status='Collected' || pc.payment_status='Deposited' || pc.payment_status='Dishonored') and pc.customer_id=".$id;
        $in_hand = $this->m_common->customeQuery($hand_sql);
        $data['in_hand'] = $in_hand[0]['total_amount'];
        
        $sql="select p.*,c.c_name,c.c_short_name from tbl_project p left join tbl_customers c on p.customer_id=c.id where p.is_active=1 and p.customer_id=".$id;
        $data['projects']=$this->m_common->customeQuery($sql);
        
        //$this->load->view('raw_materials/customers/v_details_customer',$data);
        $this->load->view('raw_materials/customers/v_details_customer_new',$data);
    }
    
     function delete_customer($id) {
        if (!empty($id)) {
            $id = $this->m_common->update_row('tbl_customers',array('id'=>$id),array('is_active'=>0));
            if (!empty($id)) {
                redirect_with_msg('raw_materials/customers/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('raw_materials/customers/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/customers/index', 'Please click on delete button');
        }
    }
   

}



