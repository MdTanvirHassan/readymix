<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Indent_type extends Site_Controller {

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
        $this->sub_inner_menu = 'indent_type';
        $this->titlebackend("Indent Type");
        $data['indent_types']=$this->m_common->get_row_array('tbl_indent_type',array('is_active'=>1),'*');
        $this->load->view('indent_type/v_indent_type',$data);
    }
    
    function add_indent_type() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'indent_type';
        $this->titlebackend("Indent Type");    
        $this->load->view('indent_type/v_add_indent_type');
    }
    
    
    function add_indent_type_action() {
        $data = $this->input->post();
       
        if(!empty($data)) {
            $pre_indent_type=$this->m_common->get_row_array('tbl_indent_type',array('type_name'=>$data['type_name'],'is_active'=>1),'*');
            if(!empty($pre_indent_type)){
                redirect_with_msg('indent_type/add_indent_type', 'This type already exists.');
            }
            $data['is_active']=1;
            $id = $this->m_common->insert_row('tbl_indent_type', $data);
            if (!empty($id)) {
                redirect_with_msg('indent_type/add_indent_type', 'Successfully Inserted');
            } else {
                redirect_with_msg('indent_type/add_indent_type', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('indent_type/add_indent_type', 'Please fill the form and submit');
        }
    }
    
    function edit_indent_type($id){
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'indent_type';
        $this->titlebackend("Indent Type");
        $data['indent_type_info']=$this->m_common->get_row_array('tbl_indent_type',array('id'=>$id),'*');
        $this->load->view('indent_type/v_edit_indent_type',$data);
    }
   
    function edit_indent_type_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $result=$this->m_common->update_row('tbl_indent_type', array('id' => $id), $data);
            if (!empty($result)) {
                redirect_with_msg('indent_type/index', 'Successfully Updated');
            } else {
                redirect_with_msg('indent_type/edit_indent_type/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('indent_type/edit_indent_type/'.$id, 'Please fill the form and submit');
        }
    }
    
   
     function delete_indent_type($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('tbl_indent_type', array('id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                redirect_with_msg('indent_type/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('indent_type/index', 'Data not deleted for an unexpected error');
            }
        } else {
               redirect_with_msg('indent_type/index', 'Please click on delete button');
        }
    }
   

}



