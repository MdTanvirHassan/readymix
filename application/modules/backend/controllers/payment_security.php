<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_security extends Site_Controller {

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
        $this->sub_inner_menu = 'payment_security';
        $this->titlebackend("Payment Mode");
        $data['payment_securities']=$this->m_common->get_row_array('tbl_payment_security',array('is_active'=>1),'*');
        $this->load->view('payment_security/v_payment_security',$data);
    }
    
    function add_payment_security() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'payment_security';
        $this->titlebackend("Payment Mode");    
        $this->load->view('payment_security/v_add_payment_security');
    }
    
    
    function add_payment_security_action() {
        $data = $this->input->post();
       
        if(!empty($data)) {
            $pre_payment_security=$this->m_common->get_row_array('tbl_payment_security',array('security_name'=>$data['security_name'],'is_active'=>1),'*');
            if(!empty($pre_payment_security)){
                redirect_with_msg('payment_security/add_payment_security', 'This Payment security already exists.');
            }
            $data['is_active']=1;
            $id = $this->m_common->insert_row('tbl_payment_security', $data);
            if (!empty($id)) {
                redirect_with_msg('payment_security/add_payment_security', 'Successfully Inserted');
            } else {
                redirect_with_msg('payment_security/add_payment_security', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('payment_security/add_payment_security', 'Please fill the form and submit');
        }
    }
    
    function edit_payment_security($id){
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'payment_security';
        $this->titlebackend("Payment Mode");
        $data['payment_security_info']=$this->m_common->get_row_array('tbl_payment_security',array('id'=>$id),'*');
        $this->load->view('payment_security/v_edit_payment_security',$data);
    }
   
    function edit_payment_security_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $result=$this->m_common->update_row('tbl_payment_security', array('id' => $id), $data);
            if (!empty($result)) {
                redirect_with_msg('payment_security/index', 'Successfully Updated');
            } else {
                redirect_with_msg('payment_security/edit_payment_security/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('payment_security/edit_payment_security/'.$id, 'Please fill the form and submit');
        }
    }
    
   
     function delete_payment_security($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('tbl_payment_security', array('id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                redirect_with_msg('payment_security/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('payment_security/index', 'Data not deleted for an unexpected error');
            }
        } else {
               redirect_with_msg('payment_security/index', 'Please click on delete button');
        }
    }
   

}



