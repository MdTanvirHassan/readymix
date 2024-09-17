<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Size_unit extends Site_Controller {

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
        $this->sub_inner_menu = 'size_unit';
        $this->titlebackend("Size Unit");
        $data['size_units']=$this->m_common->get_row_array('tbl_size_unit',array('is_active'=>1),'*');
        $this->load->view('size_unit/v_size_unit',$data);
    }
    
    function add_size_unit() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'size_unit';
        $this->titlebackend("Size Unit");    
        $data['groups']=$this->m_common->get_row_array('tbl_size_unit',array('is_active'=>1),'*');
        $this->load->view('size_unit/v_add_size_unit',$data);
    }
    
    
    function add_size_unit_action() {
        $data = $this->input->post();
        if(!empty($data)) {
            $pre_size_unit=$this->m_common->get_row_array('tbl_size_unit',array('unit_name'=>$data['unit_name'],'is_active'=>1),'*');
            if(!empty($pre_size_unit)){
                redirect_with_msg('size_unit/add_size_unit', 'This size unit already exists.');
            }
            
            $data['created_date']=date('Y-m-d');
            $data['is_active']=1;
            $id = $this->m_common->insert_row('tbl_size_unit', $data);
            if (!empty($id)) {
                redirect_with_msg('size_unit/add_size_unit', 'Successfully Inserted');
            } else {
                redirect_with_msg('size_unit/add_size_unit', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('size_unit/add_size_unit', 'Please fill the form and submit');
        }
    }
    
    function edit_size_unit($id){
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'size_unit';
        $this->titlebackend("Size Unit");
        $data['size_unit_info']=$this->m_common->get_row_array('tbl_size_unit',array('size_unit_id'=>$id),'*');
        $this->load->view('size_unit/v_edit_size_unit',$data);
    }
   
    function edit_size_unit_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $result=$this->m_common->update_row('tbl_size_unit', array('size_unit_id' => $id), $data);
            if ($result>=0) {
                redirect_with_msg('size_unit/index', 'Successfully Updated');
            } else {
                redirect_with_msg('size_unit/edit_size_unit/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('size_unit/edit_size_unit/'.$id, 'Please fill the form and submit');
        }
    }
    
   
     function delete_size_unit($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('tbl_size_unit', array('size_unit_id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                redirect_with_msg('size_unit/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('size_unit/index', 'Data not deleted for an unexpected error');
            }
        } else {
               redirect_with_msg('size_unit/index', 'Please click on delete button');
        }
    }
   

}



