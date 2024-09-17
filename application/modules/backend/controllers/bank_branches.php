<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bank_branches extends Site_Controller {

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
        $this->menu = 'sales';
        $this->sub_menu = 's_setup';
        $this->sub_inner_menu = 'bank_branch';
        $this->titlebackend("Bank Branch");
        $data['bank_branches']=$this->m_common->get_row_array('tbl_bank_branch',array('is_active'=>1),'*');
        $this->load->view('bank_branches/v_bank_branch',$data);
    }
    
    function add_bank_branch() {
        $this->menu = 'sales';
        $this->sub_menu = 's_setup';
        $this->sub_inner_menu = 'bank_branch';
        $this->titlebackend("Bank Branch");
        $this->load->view('bank_branches/v_add_bank_branch');
    }

     function add_bank_branch_action() {
       $postData = $this->input->post();
        if(!empty($postData)) {
            $insertData = array();
            if(!empty($postData['branch_name'])){
                $insertData['branch_name']=$postData['branch_name'];
            }
            
            $insertData['is_active']=1;
            $pre_bank_branch=$this->m_common->get_row_array('tbl_bank_branch',array('branch_name'=>$postData['branch_name'],'is_active'=>1),'*');
            if(!empty($pre_bank_branch)){
                redirect_with_msg('bank_branches/add_bank_branch', 'This branch already exists.');
            }
            $id = $this->m_common->insert_row('tbl_bank_branch', $insertData);
            if(!empty($id)){
                redirect_with_msg('bank_branches/add_bank_branch', 'Successfully Inserted');
            }else{
                redirect_with_msg('bank_branches/add_bank_branch', 'Data not saved for an unexpected error');
            }
            
        } else {
            redirect_with_msg('bank_branches/add_bank_branch', 'Please fill the form and submit');
        }
    }

    function edit_bank_branch($id){
        $this->menu = 'sales';
        $this->sub_menu = 's_setup';
        $this->sub_inner_menu = 'bank_branch';
        $this->titlebackend("Category Info");
        $data['bank_branch_info']=$this->m_common->get_row_array('tbl_bank_branch',array('id'=>$id),'*');
        $this->load->view('bank_branches/v_edit_bank_branch',$data);
    }
    
    function edit_bank_branch_action($id) {
       $postData = $this->input->post();
        if(!empty($postData)) {
            $insertData = array();
            if(!empty($postData['branch_name'])){
                $insertData['branch_name']=$postData['branch_name'];
            }
            
            
            $id=$this->m_common->update_row('tbl_bank_branch', array('id' =>$id),$insertData);
            if($id==0 || $id>0) {
                redirect_with_msg('bank_branches/index', 'Successfully Updated');
            } else {
                redirect_with_msg('bank_branches/edit_bank_branch/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('bank_branch/edit_bank_branch/'.$id, 'Please fill the form and submit');
        }
    }
    
     function details_bank_branch($id){
        $this->menu = 'sales';
        $this->sub_menu = 's_setup';
        $this->sub_inner_menu = 'bank_branch';
        $this->titlebackend("Item Info");
      
        
        $data['bank_branch_info']=$this->m_common->get_row_array('tbl_bank_branchs',array('s_item_id'=>$id),'*');
      
        $this->load->view('bank_branch/v_details_bank_branch',$data);
    }
    
     function delete_bank_branch($id) {
        if(!empty($id)) {
            $id=$this->m_common->update_row('tbl_bank_branch', array('id' =>$id),array('is_active'=>0));
            if (!empty($id)) {   
                redirect_with_msg('bank_branches/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('bank_branches/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('bank_branches/index', 'Please click on delete button');
        }
    }
    
}

