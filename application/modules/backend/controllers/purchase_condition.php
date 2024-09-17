<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase_condition extends Site_Controller {

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
        $this->sub_inner_menu = 'purchase_condition';
        $this->titlebackend("Purchase Condition");
        $data['conditions']=$this->m_common->get_row_array('tbl_purchase_condition',array('is_active'=>1),'*');
        $this->load->view('purchase_condition/v_purchase_condition',$data);
    }
    
    function add_purchase_condition() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'purchase_condition';
        $this->titlebackend("Purchase Condition");   
        
        $this->load->view('purchase_condition/v_add_purchase_condition');
    }
    
    
    function add_purchase_condition_action() {
        $data = $this->input->post();
       
        if(!empty($data)) {
            $pre_purchase_condition=$this->m_common->get_row_array('tbl_purchase_condition',array('name'=>$data['name'],'is_active'=>1),'*');
            if(!empty($pre_purchase_condition)){
                redirect_with_msg('purchase_condition/add_purchase_condition', 'Already exists.');
            }
            $data['is_active']=1;
            $id = $this->m_common->insert_row('tbl_purchase_condition', $data);
            if (!empty($id)) {
                redirect_with_msg('purchase_condition/add_purchase_condition', 'Successfully Inserted');
            } else {
                redirect_with_msg('purchase_condition/add_purchase_condition', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('purchase_condition/add_purchase_condition', 'Please fill the form and submit');
        }
    }
    
    function edit_purchase_condition($id){
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'purchase_condition';
        $this->titlebackend("Purchase Condition");
        $data['purchase_condition_info']=$this->m_common->get_row_array('tbl_purchase_condition',array('id'=>$id),'*');
        $this->load->view('purchase_condition/v_edit_purchase_condition',$data);
    }
   
    function edit_purchase_condition_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $result=$this->m_common->update_row('tbl_purchase_condition', array('id' => $id), $data);
            if ($result>=0) {
                redirect_with_msg('purchase_condition/index', 'Successfully Updated');
            } else {
                redirect_with_msg('purchase_condition/edit_purchase_condition/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('purchase_condition/edit_purchase_condition/'.$id, 'Please fill the form and submit');
        }
    }
    
   
     function delete_purchase_condition($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('tbl_purchase_condition', array('id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                redirect_with_msg('purchase_condition/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('purchase_condition/index', 'Data not deleted for an unexpected error');
            }
        } else {
               redirect_with_msg('purchase_condition/index', 'Please click on delete button');
        }
    }
   

}



