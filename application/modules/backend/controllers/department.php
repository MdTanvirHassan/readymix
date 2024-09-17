<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department extends Site_Controller {

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
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'dept_info';
        $this->titlebackend("Indent Type");
        $data['departments']=$this->m_common->get_row_array('tbl_departments',array('is_active'=>1),'*');
        $this->load->view('department/v_department',$data);
    }
    
    function add_department() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'dept_info';
        $this->titlebackend("Department");    
        $this->load->view('department/v_add_department');
    }
    
    
    function add_department_action() {
        $data = $this->input->post();
       
        if(!empty($data)) {
            $pre_department=$this->m_common->get_row_array('tbl_departments',array('dept_name'=>$data['dept_name'],'is_active'=>1),'*');
            if(!empty($pre_department)){
                redirect_with_msg('department/add_department', 'This type already exists.');
            }
            $data['is_active']=1;
            $id = $this->m_common->insert_row('tbl_departments', $data);
            if (!empty($id)) {
                redirect_with_msg('department/add_department', 'Successfully Inserted');
            } else {
                redirect_with_msg('department/add_department', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('department/add_department', 'Please fill the form and submit');
        }
    }
    
    function edit_department($id){
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'dept_info';
        $this->titlebackend("Indent Type");
        $data['department_info']=$this->m_common->get_row_array('tbl_departments',array('id'=>$id),'*');
        $this->load->view('department/v_edit_department',$data);
    }
   
    function edit_department_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $result=$this->m_common->update_row('tbl_departments', array('id' => $id), $data);
            if (!empty($result)) {
                redirect_with_msg('department/index', 'Successfully Updated');
            } else {
                redirect_with_msg('department/edit_department/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('department/edit_department/'.$id, 'Please fill the form and submit');
        }
    }
    
   
     function delete_department($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('tbl_departments', array('id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                redirect_with_msg('department/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('department/index', 'Data not deleted for an unexpected error');
            }
        } else {
               redirect_with_msg('department/index', 'Please click on delete button');
        }
    }
   

}



