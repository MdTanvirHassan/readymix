<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Company_dashboard extends Site_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->is_logged_in($this->session->userdata('logged_in'))) {
            redirect_with_msg('backend/login', 'Please Login to see this page');
        }
          $this->load->model("m_common");
          $this->setTemplateFile('template');
          $this->user_id = $this->session->userdata('user_id');
          $this->rank = $this->session->userdata('rank');
    }

    function index() {
        if(!$this->is_logged_in($this->session->userdata('logged_in'))){
            redirect_with_msg('backend/login', 'Please Login to see this page');
        } else {
           // redirect('backend/general_store');
                $user_name = $this->session->userdata('user_name');
            
                $data['projects'] = $this->m_common->get_row_array('department', '', '*');  
                $this->load->view('v_companydashboard', $data);
             

        }
    }

    function s_dashboard($year=false) {
        $this->setTemplateFile('template');
        $this->titlebackend("Sales Dashboard");
        if (!$this->is_logged_in($this->session->userdata('logged_in'))) {
            redirect_with_msg('backend/login', 'Please Login to see this page');
        } else {
            if(empty($year))
                $data['year'] = $year = date('Y');
            else
                $data['year'] = $year;
            // redirect('backend/general_store');
            $user_name = $this->session->userdata('user_name');
            if ($user_name == "admin") {
                $months = array(
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July ',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December',
                );
                $arr = array();
                $arr1 = array();
                $pecent = 0;
                $pecent1 = 0;
                $costing = array();
                $quotation = array();
                $so = array();
                $si = array();
                $do = array();
                foreach ($months as $month) {
                    $timestamp = strtotime($month . ' ' . $year);
                    $first_date = date('Y-m-01', $timestamp);
                    $last_date = date('Y-m-t', $timestamp); // A leap year!
                    $sql = "select sum(total_amount) as total,sum(received_amount) as rcv from tbl_sales_invoices i where i.sale_invoice_date BETWEEN '" . $first_date . "' and '" . $last_date . "'";
                    $res = $this->m_common->customeQuery($sql);
                    $arr[] = $pecent+=!empty($res[0]['rcv']) ? round($res[0]['rcv'], 2) : 0;
                    $arr1[] = $pecent1+= round($res[0]['total'] - $res[0]['rcv'], 2);

                    $sql = "select count(*) as total from tbl_product_quote_price i where i.created_date BETWEEN '" . $first_date . "' and '" . $last_date . "'";
                    $res = $this->m_common->customeQuery($sql);
                    $costing[] = !empty($res[0]['total']) ? (int)$res[0]['total'] : 0;
                    $sql = "select count(*) as total from tbl_sales_quotation i where i.quotation_date BETWEEN '" . $first_date . "' and '" . $last_date . "'";
                    $res = $this->m_common->customeQuery($sql);
                    $quotation[] = !empty($res[0]['total']) ? (int)$res[0]['total'] : 0;
                    $sql = "select count(*) as total from tbl_sales_orders i where i.sale_order_date BETWEEN '" . $first_date . "' and '" . $last_date . "'";
                    $res = $this->m_common->customeQuery($sql);
                    $so[] = !empty($res[0]['total']) ? (int)$res[0]['total'] : 0;
                    $sql = "select count(*) as total from tbl_delivery_orders i where i.delivery_order_date BETWEEN '" . $first_date . "' and '" . $last_date . "'";
                    $res = $this->m_common->customeQuery($sql);
                    $do[] = !empty($res[0]['total']) ? (int)$res[0]['total'] : 0;
                    $sql = "select count(*) as total from tbl_sales_invoices i where i.sale_invoice_date BETWEEN '" . $first_date . "' and '" . $last_date . "'";
                    $res = $this->m_common->customeQuery($sql);
                    $si[] = !empty($res[0]['total']) ? (int)$res[0]['total'] : 0;
                }
                $data['paid'] = json_encode($arr);
                $data['unpaid'] = json_encode($arr1);
                $data['costing'] = json_encode($costing);
                $data['quotation'] = json_encode($quotation);
                $data['so'] = json_encode($so);
                $data['do'] = json_encode($do);
                $data['si'] = json_encode($si);
                $data['percent'] = $pecent;
                $data['percent1'] = $pecent1;
               // echo '<pre>';print_r($data);exit;
                $this->load->view('v_s_dashboard', $data);
            } else {
                redirect('backend/customers');
            }
        }
    }

    function enterByComapany_pre($id) {
        if ($this->session->userdata('logged_in')) {
            //$url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            //$url = 'dashboard';
            $url = $_SERVER['HTTP_REFERER'];
            if ($id == 0) {
                $this->session->unset_userdata('companyId');
                $this->session->unset_userdata('companyName');
                //  redirect_with_msg($url, ' You are login from supper admin to see all.');
                redirect_with_msg('backend/dashboard', ' You are login from supper admin to see all.');
                //   redirect_with_msg('backend/general_store', ' You are login from super admin to see all.');
            } else {
                $company = $this->m_common->get_row_array('department', array('d_id' => $id), '*');
                $this->session->set_userdata('companyId', $company[0]['d_id']);
                $this->session->set_userdata('companyName', $company[0]['dep_description']);
                //  redirect_with_msg($url, ' You are login from ' . $company[0]['dep_description']);
                redirect_with_msg('backend/general_store', ' You are login from ' . $company[0]['dep_description']);
            }
        } else {
            // redirect_with_msg('login/index', 'Please login to see this page');
            redirect_with_msg('login/index', 'Please click on enter here button  to see this page');
        }
    }
    
    function enterByComapany($id) {
        if ($this->session->userdata('logged_in')) {
            //$url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            //$url = 'dashboard';
            $url = $_SERVER['HTTP_REFERER'];
            if($id == 0){
                $this->session->unset_userdata('companyId');
                $this->session->unset_userdata('companyName');
              //  redirect_with_msg($url, ' You are login from supper admin to see all.');
              redirect_with_msg('backend/dashboard', ' You are login from supper admin to see all.');
             //   redirect_with_msg('backend/general_store', ' You are login from super admin to see all.');
            } else {
                $company = $this->m_common->get_row_array('department', array('d_id' => $id), '*');
                $this->session->set_userdata('companyId', $company[0]['d_id']);
                $this->session->set_userdata('companyName', $company[0]['dep_description']);
              //  redirect_with_msg($url, ' You are login from ' . $company[0]['dep_description']);
                //redirect_with_msg('backend/general_store', ' You are login from ' . $company[0]['dep_description']);
                redirect_with_msg('backend/company_dashboard', ' You are login from ' . $company[0]['dep_description']);
            }
        } else {
           // redirect_with_msg('login/index', 'Please login to see this page');
            redirect_with_msg('login/index', 'Please click on enter here button  to see this page');
        }
    }

  

}
