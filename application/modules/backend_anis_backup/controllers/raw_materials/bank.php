<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bank extends Site_Controller {

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
        $this->menu = 'trading';
        $this->sub_menu = 'rm_setup';
        $this->sub_inner_menu = 'rm_bank';
        $this->titlebackend("Banks Basic Info");
        $data['banks']=$this->m_common->get_row_array('rm_banks',array('is_active'=>1),'*');
        $this->load->view('raw_materials/bank/v_banks',$data);
    }
    
    function add_bank() {
        $this->menu = 'trading';
        $this->sub_menu = 'rm_setup';
        $this->sub_inner_menu = 'rm_bank';
        
        $this->titlebackend("Bank Information");
        $bank_last_code=$this->m_common->get_row_array('rm_banks','','*');
        if(!empty($bank_last_code)){
            $bank_code=count($bank_last_code)+1;
            if($bank_code>999){
                $bank_sl_no=$bank_code;
            }else if($bank_code>99){
                $bank_sl_no="0".$bank_code;
            }else if($bank_code>9){
                $bank_sl_no="00".$bank_code;
            }else{
                $bank_sl_no="000".$bank_code;
            }
        }else{
            $bank_code=1;
            $bank_sl_no='0001';
        }
        $data['bank_code']=$bank_code;
        $data['bank_auto_code']=$bank_sl_no;
        $this->load->view('raw_materials/bank/v_add_bank',$data);
    }
    
    
    function add_bank_action() {
        $branch_id= $this->session->userdata('companyId');
        $data = $this->input->post();
        $bank_code= $this->input->post('bank_code');
        $data['c_id']=1;
        if (!empty($data)) {
            unset($data['bank_code']); 
            if(!empty($data['b_account_no']) && !empty($data['b_account_type'])){
                $pre_bank=$this->m_common->get_row_array('rm_banks',array('b_account_no'=>$data['b_account_no'],'b_account_type'=>$data['b_account_type'],'is_active'=>1),'*');
            }else{
                $pre_bank='';
            }
            if(!empty($pre_bank)){
                redirect_with_msg('raw_materials/bank/add_bank', 'This bank already exists.');
            }
             $data['is_active']=1;
            $id = $this->m_common->insert_row('rm_banks', $data);
            if (!empty($id)) {
                //$this->m_common->insert_row('rm_bank_code', array('bank_code'=>$bank_code));
                redirect_with_msg('raw_materials/bank/add_bank', 'Successfully Inserted');
            } else {
                redirect_with_msg('raw_materials/bank/add_bank', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/bank/add_bank', 'Please fill the form and submit');
        }
    }
    
    function edit_bank($id){
        $this->menu = 'trading';
        $this->sub_menu = 'rm_setup';
        $this->sub_inner_menu = 'rm_bank';
        
        $this->titlebackend("Bank Basic Info");
        $data['bank_info']=$this->m_common->get_row_array('rm_banks',array('id'=>$id),'*');
        $this->load->view('raw_materials/bank/v_edit_bank',$data);
    }
   
    function edit_bank_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $result=$this->m_common->update_row('rm_banks', array('id' => $id), $data);
            if (!empty($result)) {
                redirect_with_msg('raw_materials/bank/index', 'Successfully Updated');
            } else {
                redirect_with_msg('raw_materials/bank/edit_bank/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/bank/edit_bank/'.$id, 'Please fill the form and submit');
        }
    }
    
   
     function delete_bank($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('rm_banks', array('id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                redirect_with_msg('raw_materials/bank/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('raw_materials/bank/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/bank/index', 'Please click on delete button');
        }
    }
   

}



