<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Copy_to extends Site_Controller {

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
        $this->sub_inner_menu = 'copy_to';
        $this->titlebackend("Copy To");
        $data['copy_to']=$this->m_common->get_row_array('tbl_copy_to',array('is_active'=>1),'*');
        $this->load->view('copy_to/v_copy_to',$data);
    }
    
    function add_copy_to() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'copy_to';
        $this->titlebackend("Copy To");    
        
        $this->load->view('copy_to/v_add_copy_to');
    }
    
    
    function add_copy_to_action() {
        $data = $this->input->post();
       
        if(!empty($data)) {
            $pre_copy_to=$this->m_common->get_row_array('tbl_copy_to',array('name'=>$data['name'],'is_active'=>1),'*');
            if(!empty($pre_copy_to)){
                redirect_with_msg('copy_to/add_copy_to', 'Already exists.');
            }
            $data['is_active']=1;
            $id = $this->m_common->insert_row('tbl_copy_to', $data);
            if (!empty($id)) {
                redirect_with_msg('copy_to/add_copy_to', 'Successfully Inserted');
            } else {
                redirect_with_msg('copy_to/add_copy_to', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('copy_to/add_copy_to', 'Please fill the form and submit');
        }
    }
    
    function edit_copy_to($id){
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'copy_to';
        $this->titlebackend("Copy To");
        $data['copy_to_info']=$this->m_common->get_row_array('tbl_copy_to',array('id'=>$id),'*');
        $this->load->view('copy_to/v_edit_copy_to',$data);
    }
   
    function edit_copy_to_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $result=$this->m_common->update_row('tbl_copy_to', array('id' => $id), $data);
            if ($result>=0) {
                redirect_with_msg('copy_to/index', 'Successfully Updated');
            } else {
                redirect_with_msg('copy_to/edit_copy_to/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('copy_to/edit_copy_to/'.$id, 'Please fill the form and submit');
        }
    }
    
   
     function delete_copy_to($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('tbl_copy_to', array('id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                redirect_with_msg('copy_to/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('copy_to/index', 'Data not deleted for an unexpected error');
            }
        } else {
               redirect_with_msg('copy_to/index', 'Please click on delete button');
        }
    }
   

}



