<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Suppliers extends Site_Controller {

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
        $this->sub_menu = 'set_up';
        $this->sub_inner_menu = 'rm_supplier';
        $this->titlebackend("Supplier Information");
        $data['suppliers'] = $this->m_common->get_row_array('supplier',array('LOCAL'=>"Foreign"), '*');
        $this->load->view('raw_materials/suppliers/v_supplier', $data);
    }

    function add_supplier() {
        $this->menu = 'trading';
        $this->sub_menu = 'trading';
        $this->sub_inner_menu = 'rm_supplier';
        $this->titlebackend("Supplier Information");
        $data['services']=$this->m_common->get_row_array('tbl_services',array('is_active'=>1),'*');
        //$data['supplier_code']=$this->getRendVerCode(4);
        $supplier_last_code=$this->m_common->get_row_array('supplier_code','','*','',1,'id','DESC');
        if(!empty($supplier_last_code)){
           
            $supplier_code=$supplier_last_code[0]['supplier_code']+1;
            if($supplier_code>999){
                $supplier_sl_no=$supplier_code;
            }else if($supplier_code>99){
                $supplier_sl_no="0".$supplier_code;
            }else if($supplier_code>9){
                $supplier_sl_no="00".$supplier_code;
            }else{
                $supplier_sl_no="000".$supplier_code;
            }
        }else{
            $supplier_code=1;
            $supplier_sl_no='0001';
        }
        $data['supplier_code']=$supplier_code;
        $data['supplier_auto_code']=$supplier_sl_no;
        $this->load->view('raw_materials/suppliers/v_supplier_info',$data);
    }

    function edit_supplier($id) {
        $this->menu = 'trading';
        $this->sub_menu = 'trading';
        $this->sub_inner_menu = 'rm_supplier';
        $this->titlebackend("Supplier Information");
        $data['services']=$this->m_common->get_row_array('tbl_services',array('is_active'=>1),'*');
        $data['supplier'] = $this->m_common->get_row_array('supplier', array('ID' => $id), '*');
        $this->load->view('raw_materials/suppliers/edit_supplier_info', $data);
    }
    
    function details_supplier($id) {
        $this->menu = 'trading';
        $this->sub_menu = 'trading';
        $this->sub_inner_menu = 'rm_supplier';
        $this->titlebackend("Supplier Information");
        $data['services']=$this->m_common->get_row_array('tbl_services',array('is_active'=>1),'*');
        $data['supplier'] = $this->m_common->get_row_array('supplier', array('ID' => $id), '*');
        $sql="select po.*,pq.reference_no from tbl_purchase_orders po left join tbl_purchase_quotation pq on po.q_id=pq.q_id where pq.supplier_id=".$id;
        $data['purchase_orders'] =$this->m_common->customeQuery($sql);
       // $this->load->view('raw_materials/suppliers/details_supplier_info', $data); 
        
        
       
        
        $branch_id = $this->session->userdata('companyId');
       
        $sql="select o.*,d.dep_description,d.short_name as dep_short_name,s.SUP_NAME,tit.type_name from tbl_purchase_orders o left join department d on o.unit_id=d.d_id left join supplier s on o.supplier_id=s.ID left join tbl_indent_type tit on o.order_type=tit.id where o.supplier_id=$id and o.is_active=1 and o.purchase_type='By Order' order by o_id DESC";
        $data['purchase_orders']=$this->m_common->customeQuery($sql);
        
        $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr_challan,mrr.mrr_challan_date,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where mrr.mrr_status='received' and po.supplier_id=$id";
        $data['material_receives']=$this->m_common->customeQuery($sql);
      
        
       
        
        $sql="select v.*,s.SUP_NAME,tbr.supplier_bill_no from tbl_purchase_invoices v left join tbl_bill_register tbr on v.bill_id=tbr.id left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on tbr.supplier_id=s.ID where v.is_active=1 and tbr.supplier_id=$id";
        $data['invoices']=$this->m_common->customeQuery($sql);
        
       
        
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
        
       
        
        
        
        
        
        
        $this->load->view('raw_materials/suppliers/v_supplier_details', $data);
    }

    function add_supplier_action() {
        $data = $this->input->post();
        $supplier_code= $this->input->post('supplier_code');
        if (!empty($data)) {
            unset($data['supplier_code']);
            $data['services'] = serialize($data['services']);
            $data['CREATED'] = date('Y-m-d');
            $data['LOCAL'] ="Foreign";
            $id = $this->m_common->insert_row('supplier', $data);
            if(!empty($id)){
                $this->m_common->insert_row('supplier_code',array('supplier_code'=>$supplier_code));
                redirect_with_msg('raw_materials/suppliers/add_supplier', 'Successfully Added this supplier');
            } else {
                redirect_with_msg('raw_materials/suppliers/add_supplier', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/suppliers/add_supplier', 'Please fill the form and submit');
        }
    }

    function edit_supplier_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $test= serialize($data['services']);
            $data['services'] = serialize($data['services']);
            $id = $this->m_common->update_row('supplier', array('ID' => $id), $data);
            if (!empty($id)) {
                redirect_with_msg('raw_materials/suppliers/index', 'Successfully Updated this supplier');
            } else {
                redirect_with_msg('raw_materials/suppliers/add_supplier', 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/suppliers/add_supplier', 'Please fill the form and submit');
        }
    }

    function delete_supplier($id) {
        if (!empty($id)) {
            $data['CREATED'] = date('Y-m-d');
            $id = $this->m_common->delete_row('supplier', array('ID' => $id));
            if (!empty($id)) {
                redirect_with_msg('raw_materials/suppliers/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('raw_materials/suppliers/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/suppliers/index', 'Please click on delete button');
        }
    }
   

}



