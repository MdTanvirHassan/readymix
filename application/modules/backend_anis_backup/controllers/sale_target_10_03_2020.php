<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sale_target extends Site_Controller {

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
        
//        $this->role = checkUserPermission(7, 26, $userData);
//        if ($this->role == false || $this->role == 6) {
//            redirect_with_msg('dashboard/', 'You dont Have permission to access this page');
//        }
        
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
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_target';
        $this->titlebackend("Sale Orders");
        // $data['sale_order']=$this->m_common->get_row_array('tbl_sales_sale_order
        // $sql="select o.*,q.reference_no,c.c_name,c.c_short_name from tbl_sales_orders o left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where o.is_active=1";
        $sql="select tst.*,e.name from tbl_sales_target tst left join employees e on tst.employee_id=e.id where tst.is_active=1";
        $data['sale_targets'] = $this->m_common->customeQuery($sql);
        $this->load->view('sale_target/v_sale_target', $data);
    }

    function add_sale_target() {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_target';
        $this->titlebackend("Target Information");
       
        $data['categories'] = $this->m_common->get_row_array('tbl_product_categories',array('is_active' => 1), '*');
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*');
        $data['employees'] = $this->m_common->get_row_array('employees','', '*');
        $sql = "select sp.* from tbl_mixing_products mp join tbl_sales_products sp on mp.product_id=sp.product_id where mp.is_active=1";
        $data['products'] = $this->m_common->customeQuery($sql);
        $this->load->view('sale_target/v_add_sale_target', $data);
    }

    function add_sale_target_action() {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        $postData = $this->input->post();
        if (!empty($postData)){
            $insertData = array();
            $insertPaymentCondition = array();
            
             if(isset($postData['category_id'])){
                if(empty($postData['category_id'])){
                    redirect_with_msg('sale_target/add_sale_target', 'Please select Product');
                }
            
           }else{
               redirect_with_msg('sale_target/add_sale_target', 'Please select Product');
           }    
            
            if(!empty($postData['employee_id'])){
                $insertData['employee_id'] =$postData['employee_id'];
            }
           
            if(!empty($postData['month'])){
                $insertData['month'] =$postData['month'];
            }
            $p_result = $this->m_common->get_row_array('tbl_sales_target',array('employee_id'=>$postData['employee_id'],'month'=>$postData['month']));
            
            if(!empty($p_result)){
                redirect_with_msg('sale_target/add_sale_target', 'Already target has been set for this sales person');
            }

            if (!empty($postData['total_amount'])){
                $insertData['total_amount'] = $postData['total_amount'];
            }
           
           // $insertData['unit_id'] = $branch_id;
            $insertData['is_active'] = 1;
            $insertData['created_by'] = $user_id;
            $insertData['created_date'] = date('Y-m-d');
           
           
           
            $result = $this->m_common->insert_row('tbl_sales_target', $insertData);
            if (!empty($result)) {
               
                             
                foreach ($postData['category_id'] as $key => $each) {
                    $insertData1 = array();
                    $insertData1['st_id'] = $result;
                    $insertData1['category_id'] = $each;
                    
                    $insertData1['is_active'] = 1;
                    if (empty($each)) {
                        continue;
                    }
                    if (!empty($postData['quantity'][$key])) {
                        $insertData1['quantity'] = $postData['quantity'][$key];
                    }
                    if (!empty($postData['unit_price'][$key])) {
                        $insertData1['unit_price'] = $postData['unit_price'][$key];
                    }

                    if (!empty($postData['mu_name'][$key])) {
                        $insertData1['mu_name'] = strtoupper($postData['mu_name'][$key]);
                    }

                    if (!empty($postData['amount'][$key])) {
                        $insertData1['amount'] = $postData['amount'][$key];
                    }
                   
                    if (!empty($postData['remark'][$key])) {
                        $insertData1['remark'] = $postData['remark'][$key];
                    }

                    $this->m_common->insert_row('tbl_sales_target_details', $insertData1);
                }

              

                redirect_with_msg('sale_target', 'Successfully Inserted');
            }
        } else {
            redirect_with_msg('sale_target/add_sale_target', 'Please fill the form and submit');
        }
    }

    function edit_sale_target($id) {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_target';
        $this->titlebackend("Order Information");
        //$sql="select q.*,c.c_name,c.c_short_name from tbl_sales_quotation q left join tbl_customers c on q.customer_id=c.id where q.is_active=1";

        $data['sale_target_info'] = $this->m_common->get_row_array('tbl_sales_target', array('st_id' => $id), '*');
       
        $sql = "select d.*,sp.category_name,sp.measurement_unit from tbl_sales_target_details d left join tbl_product_categories sp on d.category_id=sp.category_id where d.is_active=1 and d.st_id=" . $id;
        $data['sale_order_details_info'] = $this->m_common->customeQuery($sql);
        $data['categories'] = $this->m_common->get_row_array('tbl_product_categories',array('is_active' => 1), '*');
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*');
        $data['employees'] = $this->m_common->get_row_array('employees','', '*');
        $sql = "select sp.* from tbl_mixing_products mp join tbl_sales_products sp on mp.product_id=sp.product_id where mp.is_active=1";
        $data['products'] = $this->m_common->customeQuery($sql);
       
        $this->load->view('sale_target/v_edit_sale_target', $data);
    }

    function edit_sale_target_action($st_id) {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        $postData = $this->input->post();

        if (!empty($postData)) {
            
            $insertData = array();
           
           if(isset($postData['category_id'])){
                if(empty($postData['category_id'])){
                    redirect_with_msg('sale_target/add_sale_target', 'Please select Product');
                }
            
           }else{
               redirect_with_msg('sale_target/add_sale_target', 'Please select Product');
           }    
           
            if(!empty($postData['employee_id'])){
                $insertData['employee_id'] =$postData['employee_id'];
            }
            
            if(!empty($postData['month'])){
                $insertData['month'] =$postData['month'];
            }
            
            

            if(!empty($postData['total_amount'])){
                $insertData['total_amount'] = $postData['total_amount'];
            }
                     
            
            $insertData['updated_by'] =$user_id;
            $insertData['updated_date'] =date('Y-m-d');
            $result = $this->m_common->update_row('tbl_sales_target', array('st_id' => $st_id), $insertData);
            if ($result >= 0) {
                
                $this->m_common->delete_row('tbl_sales_target_details', array('st_id' => $st_id));
               
                foreach ($postData['category_id'] as $key => $each) {
                    $insertData1 = array();
                    $insertData1['st_id'] = $st_id;
                    $insertData1['category_id'] = $each;
                    $insertData1['is_active'] = 1;
                    if (empty($each)) {
                        continue;
                    }
                    if (!empty($postData['quantity'][$key])) {
                        $insertData1['quantity'] = $postData['quantity'][$key];
                    }
                    if (!empty($postData['unit_price'][$key])) {
                        $insertData1['unit_price'] = $postData['unit_price'][$key];
                    }

                    if (!empty($postData['mu_name'][$key])) {
                        $insertData1['mu_name'] = strtoupper($postData['mu_name'][$key]);
                    }

                    if (!empty($postData['amount'][$key])) {
                        $insertData1['amount'] = $postData['amount'][$key];
                    }
                   

                    if (!empty($postData['remark'][$key])) {
                        $insertData1['remark'] = $postData['remark'][$key];
                    }

                    $this->m_common->insert_row('tbl_sales_target_details', $insertData1);
                }

               
                redirect_with_msg('sale_target', 'Successfully Updated');
            }
        } else {
            redirect_with_msg('sale_target/add_sale_target', 'Please fill the form and submit');
        }
    }

    function details_sale_target($id, $print = false) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_target';
        $this->titlebackend("Order Information");
        
        $data['sale_target_info'] = $this->m_common->get_row_array('tbl_sales_target', array('st_id' => $id), '*');
       
        $sql = "select d.*,sp.category_name,sp.measurement_unit from tbl_sales_target_details d left join tbl_product_categories sp on d.category_id=sp.category_id where d.is_active=1 and d.st_id=" . $id;
        $data['sale_order_details_info'] = $this->m_common->customeQuery($sql);
        $data['categories'] = $this->m_common->get_row_array('tbl_product_categories',array('is_active' => 1), '*');
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*');
        $data['employees'] = $this->m_common->get_row_array('employees','', '*');
        $sql = "select sp.* from tbl_mixing_products mp join tbl_sales_products sp on mp.product_id=sp.product_id where mp.is_active=1";
        $data['products'] = $this->m_common->customeQuery($sql);
        if ($print == false) {
            $this->load->view('sale_target/v_details_sale_target', $data);
        } else {
            $html = $this->load->view('sale_target/print_sales_target', $data, true);
            echo $html;
            exit;
        }
    }

    function make_archive($id) {
        try {
            if (!empty($id)) {
                $id = $this->m_common->update_row('tbl_sales_orders', array('o_id' => $id), array('is_active' => 2));
                redirect_with_msg('sale_orders/index', 'Successfully Archived');
            } else {
                redirect_with_msg('sale_orders/index', 'There have an error during archiving');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function delete_sale_target($id) {
        if (!empty($id)) {
          
            $id = $this->m_common->update_row('tbl_sales_target', array('st_id' => $id), array('is_active' => 0));
            if (!empty($id)) {
                
                $this->m_common->update_row('tbl_sales_target_details', array('st_id' => $id), array('is_active' => 0));
                
                redirect_with_msg('sale_target/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('sale_target/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('sale_target/index', 'Please click on delete button');
        }
    }

   

    function get_customer_details() {
        $branch_id = $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');
        $data['projects'] = $this->m_common->get_row_array('tbl_project', array('customer_id' => $id), '*', '', '', 'project_id', 'DESC');
        $data['order_code'] = $this->m_common->get_row_array('tbl_sales_order_code', array('customer_id' => $id, 'unit_id' => $branch_id), '*', '', 1, 'id', 'DESC');
        $data['customer_info'] = $this->m_common->get_row_array('tbl_customers', array('id' => $id, 'is_active' => 1), '*');
        echo json_encode($data);
    }

   
   

}
