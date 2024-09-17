<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_return extends Site_Controller {

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
        if (empty($this->company_id)) {
            redirect_with_msg('backend/dashboard', 'Please click on enter here button to see this page');
        }
    }

    function index() {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'trading';
        $this->sub_menu = 'rm_payment_return';
        $this->titlebackend("Deposit Realization");
        
       
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1,'customer_category'=>'Raw Material'), '*', '', '', 'c_name');       
        $postData = $this->input->post();
        $where = '';
       // $where = "dr.unit_id=$branch_id";
        $where = "dr.is_active=1";
        if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = '';
                $data['to_date'] = '';
                $f_date = '';
                $to_date = '';
            }
            
            
             if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['collection_method'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }

             if(!empty($f_date) & !empty($to_date)){
               
              //  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from rm_deposit_realization dr left join rm_payment_collections pc on dr.collection_id=pc.id left join rm_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where $where and dr.deposit_date>='" . $f_date . "' and dr.deposit_date<='" . $to_date . "' and dr.is_active=1 and dr.realization_status='Deposited' order by dr.deposit_date DESC";
                 $sql = "select dr.*,pc.check_date,pc.bg_issue_date,pc.po_date,pc.lc_date,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from rm_deposit_realization dr left join rm_payment_collections pc on dr.collection_id=pc.id left join rm_banks b on dr.bank_id=b.id left join tbl_customers tc on pc.customer_id=tc.id where $where and dr.deposit_date>='" . $f_date . "' and dr.deposit_date<='" . $to_date . "' and dr.realization_status='Returned' order by dr.deposit_date DESC";
             }else if (!empty($f_date)) {
              //  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from rm_deposit_realization dr left join rm_payment_collections pc on dr.collection_id=pc.id left join rm_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where $where and dr.deposit_date>='".$f_date."' and dr.is_active=1 and dr.realization_status='Deposited' order by dr.deposit_date DESC";
                $sql = "select dr.*,pc.check_date,pc.bg_issue_date,pc.po_date,pc.lc_date,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from rm_deposit_realization dr left join rm_payment_collections pc on dr.collection_id=pc.id left join rm_banks b on dr.bank_id=b.id left join tbl_customers tc on pc.customer_id=tc.id  where $where and dr.deposit_date>='".$f_date."' and dr.realization_status='Returned' order by dr.deposit_date DESC";
             }else if (!empty($to_date)) {
               // $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from rm_deposit_realization dr left join rm_payment_collections pc on dr.collection_id=pc.id left join rm_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where $where and dr.deposit_date<='" . $to_date . "' and dr.is_active=1 and dr.realization_status='Deposited' order by dr.deposit_date DESC";
                $sql = "select dr.*,pc.check_date,pc.bg_issue_date,pc.po_date,pc.lc_date,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from rm_deposit_realization dr left join rm_payment_collections pc on dr.collection_id=pc.id left join rm_banks b on dr.bank_id=b.id left join tbl_customers tc on pc.customer_id=tc.id where $where and dr.deposit_date<='" . $to_date . "' and dr.realization_status='Returned' order by dr.deposit_date DESC";
             }else{
                // $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from rm_deposit_realization dr left join rm_payment_collections pc on dr.collection_id=pc.id left join rm_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where $where and dr.is_active=1 and dr.realization_status='Deposited' order by dr.deposit_date DESC";
                 $sql = "select dr.*,pc.check_date,pc.bg_issue_date,pc.po_date,pc.lc_date,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from rm_deposit_realization dr left join rm_payment_collections pc on dr.collection_id=pc.id left join rm_banks b on dr.bank_id=b.id left join tbl_customers tc on pc.customer_id=tc.id where $where and dr.realization_status='Returned' order by dr.deposit_date DESC";
             }   
        }else{
          //  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from rm_deposit_realization dr left join rm_payment_collections pc on dr.collection_id=pc.id left join rm_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where dr.is_active=1 and dr.realization_status='Deposited' and dr.unit_id=" . $branch_id." order by dr.deposit_date DESC";
            $sql = "select dr.*,pc.check_date,pc.bg_issue_date,pc.po_date,pc.lc_date,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from rm_deposit_realization dr left join rm_payment_collections pc on dr.collection_id=pc.id left join rm_banks b on dr.bank_id=b.id left join tbl_customers tc on pc.customer_id=tc.id where dr.is_active=1 and dr.realization_status='Returned' order by dr.deposit_date DESC";
            $data['f_date'] = $from_date = '';
            $data['to_date'] = $too_date = '';
        }
        
        $data['deposits'] = $this->m_common->customeQuery($sql);
        $this->load->view('raw_materials/payment_return/v_payment_return', $data);
    }
    // function index() {
    //     $branch_id = $this->session->userdata('companyId');
    //     $this->menu = 'sales';
    //     $this->sub_menu = 'payment_return';
    //     $this->titlebackend("Payment Return");        
    //     $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,tc.c_name,c_short_name from tbl_payment_return dr left join rm_payment_collections pc on dr.collection_id=pc.id  left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where dr.is_active=1";
    //     $data['returns'] = $this->m_common->customeQuery($sql);
    //     $this->load->view('raw_materials/payment_return/v_payment_return', $data);
    // }

    function add_payment_return() {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'payment_return';
        $this->titlebackend("Deposit");
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name'); 
        $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name from rm_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where pc.is_active=1 and (pc.collection_method='Pdc' || pc.collection_method='Bg' || pc.collection_method='Lc' || pc.collection_method='Po') and pc.payment_status='Collected' order by pc.receive_date desc";  
        
        $data['collections'] = $this->m_common->customeQuery($sql);
        $this->load->view('raw_materials/payment_return/v_add_payment_return',$data);
    }

     function collection_info() {
        $this->setOutputMode(NORMAL);
        $customer_id = $this->input->post('customer_id');
        $sql = "select tpc.*,tc.c_name,c_short_name from rm_payment_collections tpc left join tbl_sales_orders tso on tpc.o_id=tso.o_id left join tbl_customers tc on tso.customer_id=tc.id where tpc.is_active=1 and tso.customer_id=".$customer_id;
        $data['collections'] = $this->m_common->customeQuery($sql);
        echo json_encode($data);
    }
    
    function add_payment_return_action() {
        $branch_id = $this->session->userdata('companyId');
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            if (!empty($postData['collection_id'])) {
                $insertData['collection_id'] = $postData['collection_id'];
                $pre_deposit = $this->m_common->get_row_array('tbl_payment_return', array('collection_id' => $postData['collection_id'], 'is_active' => 1), '*');
                if(!empty($pre_deposit)){
                   redirect_with_msg('raw_materials/payment_return/add_return_collection', 'This collection already returned');
                } 
            }
            
//            if(!empty($postData['customer_id'])){
//                $insertData['customer_id'] = $postData['customer_id'];
//            }
            
            if (!empty($postData['return_date'])) {
                $insertData['return_date'] = date('Y-m-d', strtotime($postData['return_date']));
            }

            if (!empty($postData['remark'])) {
                $insertData['remark'] = $postData['remark'];
            }
            
            if (!empty($postData['return_amount'])) {
                $insertData['return_amount'] = $postData['return_amount'];
            }
           
            $insertData['branch_id'] = $branch_id;
            $insertData['is_active'] = 1;
           
            $result = $this->m_common->insert_row('tbl_payment_return', $insertData);
            if (!empty($result)) {
                redirect_with_msg('payment_return', 'Successfully Inserted');
            }
        } else {
            redirect_with_msg('raw_materials/payment_return/add_payment_return', 'Please fill the form and submit');
        }
    }

    function edit_payment_return($id) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'deposit_realization';
        $this->titlebackend("Deposit");
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');    
        $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.collection_method,pc.amount,pc.no from tbl_payment_return dr left join rm_payment_collections pc on dr.collection_id=pc.id  where dr.is_active=1 and dr.id=" . $id;
        $data['return_info'] = $this->m_common->customeQuery($sql);
      
        $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name from rm_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where pc.is_active=1 and (pc.collection_method='Pdc' || pc.collection_method='Bg' || pc.collection_method='Lc' || pc.collection_method='Po') and pc.payment_status='Collected' order by pc.receive_date desc";        
        $data['collections'] = $this->m_common->customeQuery($sql);
        
        $this->load->view('raw_materials/payment_return/v_edit_payment_return', $data);
    }

    function edit_payment_return_action($id) {
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
             if(!empty($postData['collection_id'])){
                $insertData['collection_id'] = $postData['collection_id'];       
            }
            
//            if(!empty($postData['customer_id'])){
//                $insertData['customer_id'] = $postData['customer_id'];
//            }
            
            if (!empty($postData['return_date'])) {
                $insertData['return_date'] = date('Y-m-d', strtotime($postData['return_date']));
            }

            if (!empty($postData['remark'])) {
                $insertData['remark'] = $postData['remark'];
            }
            
            if (!empty($postData['return_amount'])) {
                $insertData['return_amount'] = $postData['return_amount'];
            }
            
            $result = $this->m_common->update_row('tbl_payment_return', array('id' => $id), $insertData);
            if ($result >= 0) {
                redirect_with_msg('payment_return', 'Successfully Updated');
            }
        } else {
            redirect_with_msg('raw_materials/payment_return/edit_raw_materials/payment_return/' . $id, 'Please fill the form and submit');
        }
    }

    function delete_payment_return($id) {
        if(!empty($id)){
            $id=$this->m_common->update_row('tbl_payment_return', array('id' =>$id),array('is_active' => 0));
            if(!empty($id)){
                redirect_with_msg('raw_materials/payment_return/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('raw_materials/payment_return/index', 'Data not deleted for an unexpected error');
            }
        }else{
            redirect_with_msg('raw_materials/payment_return/index', 'Please click on delete button');
        }
    }

    function get_collection_info() {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');
        $sql = "select pc.*,b.b_name,b.branch_name,b.b_short_name from rm_payment_collections pc left join rm_banks b on pc.bank_id=b.id where pc.id=" . $id;
        $data['collection_info'] = $this->m_common->customeQuery($sql);
        if ($data['collection_info'][0]['collection_method'] == "Pdc") {
            $data['collection_info'][0]['check_date'] = date('d-m-Y', strtotime($data['collection_info'][0]['check_date']));
        } else if ($data['collection_info'][0]['collection_method'] == "Po") {
            $data['collection_info'][0]['po_date'] = date('d-m-Y', strtotime($data['collection_info'][0]['po_date']));
        } else if ($data['collection_info'][0]['collection_method'] == "Bg") {
            $data['collection_info'][0]['bg_expire_date'] = date('d-m-Y', strtotime($data['collection_info'][0]['bg_expire_date']));
        } else if ($data['collection_info'][0]['collection_method'] == "Lc") {
            $data['collection_info'][0]['lc_date'] = date('d-m-Y', strtotime($data['collection_info'][0]['lc_date']));
        }
        echo json_encode($data);
    }

  

}
