<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service_group extends Site_Controller {

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
        $this->sub_inner_menu = 'service_group';
        $this->titlebackend("Service Ggroup");
        $data['service_groups']=$this->m_common->get_row_array('tbl_service_group',array('is_active'=>1),'*');
        $this->load->view('service_group/v_service_group',$data);
    }
    
    function add_service_group() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'service_group';
        $this->titlebackend("Service Group");    
        $this->load->view('service_group/v_add_service_group');
    }
    
    
    function add_service_group_action() {
        $data = $this->input->post();
       
        if(!empty($data)) {
            $pre_service_group=$this->m_common->get_row_array('tbl_service_group',array('group_name'=>$data['group_name'],'is_active'=>1),'*');
            if(!empty($pre_service_group)){
                redirect_with_msg('service_group/add_service_group', 'This group already exists.');
            }
            $data['is_active']=1;
            $id = $this->m_common->insert_row('tbl_service_group', $data);
            if (!empty($id)) {
                redirect_with_msg('service_group/add_service_group', 'Successfully Inserted');
            } else {
                redirect_with_msg('service_group/add_service_group', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('service_group/add_service_group', 'Please fill the form and submit');
        }
    }
    
    function edit_service_group($id){
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'service_group';
        $this->titlebackend("Service Group");
        $data['service_group_info']=$this->m_common->get_row_array('tbl_service_group',array('id'=>$id),'*');
        $this->load->view('service_group/v_edit_service_group',$data);
    }
   
    function edit_service_group_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $result=$this->m_common->update_row('tbl_service_group', array('id' => $id), $data);
            if (!empty($result)) {
                redirect_with_msg('service_group/index', 'Successfully Updated');
            } else {
                redirect_with_msg('service_group/edit_service_group/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('service_group/edit_service_group/'.$id, 'Please fill the form and submit');
        }
    }
    
   
     function delete_service_group($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('tbl_service_group', array('id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                redirect_with_msg('service_group/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('service_group/index', 'Data not deleted for an unexpected error');
            }
        } else {
               redirect_with_msg('service_group/index', 'Please click on delete button');
        }
    }
   

}



