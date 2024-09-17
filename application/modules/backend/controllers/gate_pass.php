<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gate_pass extends Site_Controller {

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
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'gate_pass';
        $this->titlebackend("Gate Pass");
        //$data['gate_pass'] = $this->m_common->get_row_array('tbl_gate_pass', array('is_active' => 1), '*');
        $sql = "select gp.*,e.name,dc.dc_no,t.truck_no from tbl_gate_pass gp
LEFT JOIN employees e ON gp.created_by=e.id
LEFT JOIN tbl_delivery_challans dc on gp.dc_id=dc.dc_id
LEFT JOIN tbl_truck t on gp.truck_id=t.truck_id where gp.is_active=1 ORDER BY gp.id DESC";
        $data['gate_pass'] = $this->m_common->customeQuery($sql);
        $this->load->view('gate_pass/v_gate_pass', $data);
    }

    function add_gate_pass() {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'gate_pass';
        $this->titlebackend("Add Gate Pass");
        $gate_pass_code=$this->m_common->get_row_array('tbl_gate_pass','','*','',1,'id','DESC');
        if(!empty($gate_pass_code)){
            $pass_sl=$gate_pass_code[0]['pass_sl']+1;
            if($pass_sl>999){
                $pass_no=$pass_sl;
            }else if($pass_sl>99){
                $pass_no="0".$pass_sl;
            }else if($pass_sl>9){
                $pass_no="00".$pass_sl;
            }else{
                $pass_no="000".$pass_sl;
            }
        }else{
            $pass_sl=1;
            $pass_no='0001';
        }
        $data['pass_sl']=$pass_sl;
        $data['pass_no']=$pass_no;
        $get_pass = $this->m_common->get_row_array('tbl_gate_pass', '', '');
        if (empty($get_pass)) {
            $sql = "select dc_id,dc_no from tbl_delivery_challans where is_active=1";
        } else {
            $sql = "select dc_id,dc_no from tbl_delivery_challans where is_active=1 and dc_id not in (select group_concat(dc_id) from tbl_gate_pass)";
        }
        // $sql = "select dc_id,dc_no from tbl_delivery_challans where dc_id not in (select group_concat(dc_id) from tbl_gate_pass where dc_id !=0)"; 
        $data['challan'] = $this->m_common->customeQuery($sql);
        $data['truck'] = $this->m_common->get_row_array('tbl_truck', array('is_active' => 1), '*');
        $data['driver'] = $this->m_common->get_row_array('tbl_driver', array('is_active' => 1), '*');
        $this->load->view('gate_pass/v_add_gate_pass', $data);
    }

    function add_gate_pass_action() {
        $branch_id = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $postData = $this->input->post();
        if (!empty($postData)) {

            $insertData = array();


            if (!empty($postData['pass_no'])) {
                $insertData['pass_no'] = $postData['pass_no'];
            }
            if (!empty($postData['pass_sl'])) {
                $insertData['pass_sl'] = $postData['pass_sl'];
            }

            if (!empty($postData['date'])) {
                $insertData['date'] = date('Y-m-d', strtotime($postData['date']));
            }

            if (!empty($postData['dc_id'])) {
                $insertData['dc_id'] = $postData['dc_id'];
            }
            if (!empty($postData['truck_id'])) {
                $insertData['truck_id'] = $postData['truck_id'];
            }
            if (!empty($postData['address'])) {
                $insertData['address'] = $postData['address'];
            }
            if (!empty($postData['driver_id'])) {
                $insertData['driver_id'] = $postData['driver_id'];
            }

            if (!empty($postData['issue'])) {
                $insertData['issue'] = $postData['issue'];
            } else {
                $insertData['issue'] = 0;
            }

            if (!empty($postData['sale'])) {
                $insertData['sale'] = $postData['sale'];
            } else {
                $insertData['sale'] = 0;
            }

            if (!empty($postData['non_return'])) {
                $insertData['non_return'] = $postData['non_return'];
            } else {
                $insertData['non_return'] = 0;
            }

            if (!empty($postData['return'])) {
                $insertData['return'] = $postData['return'];
            } else {
                $insertData['return'] = 0;
            }



            $insertData['is_active'] = 1;
            $insertData['created_by'] = $employee_id;
            $insertData['created_date'] = date("Y-m-d h:i:s");
            $result = $this->m_common->insert_row('tbl_gate_pass', $insertData);

            if (!empty($result)) {

                foreach ($postData['note'] as $key => $row) {
                    $insertDetailsData['gate_pass_id'] = $result;
                    $insertDetailsData['note'] = $row;
                    $this->m_common->insert_row('tbl_gate_pass_details', $insertDetailsData);
                }
                redirect_with_msg('gate_pass', 'Successfully Inserted');
            }
        } else {
            redirect_with_msg('gate_pass/add_gate_pass', 'Please fill the form and submit');
        }
    }

    function edit_gate_pass($id) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'gate_pass';
        $this->titlebackend("Edit Gate Pass");
        $data['gate_pass'] = $this->m_common->get_row_array('tbl_gate_pass', array('id' => $id), '*');
        $data['gate_pass_details'] = $this->m_common->get_row_array('tbl_gate_pass_details', array('gate_pass_id' => $id), '*');

        $sql = "select dc_id,dc_no from tbl_delivery_challans where is_active=1 and dc_id not in (select group_concat(dc_id) from tbl_gate_pass)";

        $data['challan'] = $this->m_common->customeQuery($sql);
        $data['truck'] = $this->m_common->get_row_array('tbl_truck', array('is_active' => 1), '*');
        $data['driver'] = $this->m_common->get_row_array('tbl_driver', array('is_active' => 1), '*');
        $this->load->view('gate_pass/v_edit_gate_pass', $data);
    }

    function edit_gate_pass_action($id) {
        $postData = $this->input->post();
        if (!empty($postData)) {

            $insertData = array();


            if (!empty($postData['pass_no'])) {
                $insertData['pass_no'] = $postData['pass_no'];
            }

            if (!empty($postData['date'])) {
                $insertData['date'] = date('Y-m-d', strtotime($postData['date']));
            }

            if (!empty($postData['dc_id'])) {
                $insertData['dc_id'] = $postData['dc_id'];
            }
            if (!empty($postData['truck_id'])) {
                $insertData['truck_id'] = $postData['truck_id'];
            }

            if (!empty($postData['address'])) {
                $insertData['address'] = $postData['address'];
            }
            if (!empty($postData['driver_id'])) {
                $insertData['driver_id'] = $postData['driver_id'];
            }
            
            if (!empty($postData['issue'])) {
                $insertData['issue'] = $postData['issue'];
            } else {
                $insertData['issue'] = 0;
            }

            if (!empty($postData['sale'])) {
                $insertData['sale'] = $postData['sale'];
            } else {
                $insertData['sale'] = 0;
            }

            if (!empty($postData['non_return'])) {
                $insertData['non_return'] = $postData['non_return'];
            } else {
                $insertData['non_return'] = 0;
            }

            if (!empty($postData['return'])) {
                $insertData['return'] = $postData['return'];
            } else {
                $insertData['return'] = 0;
            }


            $result = $this->m_common->update_row('tbl_gate_pass', array('id' => $id), $insertData);
            if ($result >= 0) {
                $this->m_common->delete_row('tbl_gate_pass_details', array('gate_pass_id' => $id));
                foreach ($postData['note'] as $key => $row) {
                    $insertDetailsData['gate_pass_id'] = $id;
                    $insertDetailsData['note'] = $row;
                    $this->m_common->insert_row('tbl_gate_pass_details', $insertDetailsData);
                }
                redirect_with_msg('gate_pass', 'Successfully Updated');
            }
        } else {
            redirect_with_msg('gate_pass', 'Please fill the form and submit');
        }
    }

    function details_gate_pass($id, $print = false) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'gate_pass';
        $this->titlebackend("Gate Pass Details");
        $sql = "select gp.*,e.name,dc.dc_no,t.truck_no,d.driver_name from tbl_gate_pass gp
LEFT JOIN employees e ON gp.created_by=e.id
LEFT JOIN tbl_delivery_challans dc on gp.dc_id=dc.dc_id
LEFT JOIN tbl_truck t on gp.truck_id=t.truck_id
LEFT JOIN tbl_driver d on gp.driver_id=d.driver_id where gp.is_active=1 and gp.id=$id";
        $data['gate_pass'] = $this->m_common->customeQuery($sql);
        $data['gate_pass_details'] = $this->m_common->get_row_array('tbl_gate_pass_details', array('gate_pass_id' => $id), '*');
        $data['project_id'] = $branch_id;


        if ($print == false) {
            $this->load->view('gate_pass/v_details_gate_pass', $data);
        } else {
            $html = $this->load->view('gate_pass/print_gate_pass', $data, true);
            echo $html;
            exit;
        }
    }

    function delete_gate_pass($id) {
        $employee_id = $this->session->userdata('employeeId');
        $insertData = array();
        $insertData['is_active'] = 0;
        $insertData['deleted_by'] = $employee_id;
        $insertData['deleted_date'] = date("Y-m-d h:i:s");
        if (!empty($id)) {
            $id = $this->m_common->update_row('tbl_gate_pass', array('id' => $id), $insertData);
            if (!empty($id)) {
                redirect_with_msg('gate_pass/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('gate_pass/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('gate_pass/index', 'Please click on delete button');
        }
    }

}
