<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_mode extends Site_Controller {

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
        $this->sub_inner_menu = 'payment_mode';
        $this->titlebackend("Payment Mode");
        $sql="select tpm.*,tps.security_name from tbl_payment_mode tpm left join tbl_payment_security tps on tpm.security_id=tps.id where tpm.is_active=1";
        $data['payment_modes']=$this->m_common->customeQuery($sql);
        $this->load->view('payment_mode/v_payment_mode',$data);
    }
    
    function add_payment_mode() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'payment_mode';
        $this->titlebackend("Payment Mode");    
        $data['payment_securities']=$this->m_common->get_row_array('tbl_payment_security',array('is_active'=>1),'*');
        $this->load->view('payment_mode/v_add_payment_mode',$data);
    }
    
    
    function add_payment_mode_action() {
        $data = $this->input->post();
       
        if(!empty($data)) {
            $pre_payment_mode=$this->m_common->get_row_array('tbl_payment_mode',array('mode_name'=>$data['mode_name'],'is_active'=>1),'*');
            if(!empty($pre_payment_mode)){
                redirect_with_msg('payment_mode/add_payment_mode', 'This Payment mode already exists.');
            }
            $data['is_active']=1;
            $id = $this->m_common->insert_row('tbl_payment_mode', $data);
            if (!empty($id)) {
                redirect_with_msg('payment_mode/add_payment_mode', 'Successfully Inserted');
            } else {
                redirect_with_msg('payment_mode/add_payment_mode', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('payment_mode/add_payment_mode', 'Please fill the form and submit');
        }
    }
    
    function edit_payment_mode($id){
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'payment_mode';
        $this->titlebackend("Payment Mode");
        $data['payment_securities']=$this->m_common->get_row_array('tbl_payment_security',array('is_active'=>1),'*');
        $data['payment_mode_info']=$this->m_common->get_row_array('tbl_payment_mode',array('id'=>$id),'*');
        $this->load->view('payment_mode/v_edit_payment_mode',$data);
    }
   
    function edit_payment_mode_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $result=$this->m_common->update_row('tbl_payment_mode', array('id' => $id), $data);
            if (!empty($result)) {
                redirect_with_msg('payment_mode/index', 'Successfully Updated');
            } else {
                redirect_with_msg('payment_mode/edit_payment_mode/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('payment_mode/edit_payment_mode/'.$id, 'Please fill the form and submit');
        }
    }
    
   
     function delete_payment_mode($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('tbl_payment_mode', array('id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                redirect_with_msg('payment_mode/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('payment_mode/index', 'Data not deleted for an unexpected error');
            }
        } else {
               redirect_with_msg('payment_mode/index', 'Please click on delete button');
        }
    }
   

}



