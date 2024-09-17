<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Landed_cost_head extends Site_Controller {

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
        $this->sub_inner_menu = 'rm_landed_cost_head';
        $this->titlebackend("Landed Cost Head");
        $data['cost_heads']=$this->m_common->get_row_array('import_landed_cost_head',array('is_active'=>1),'*');
        $this->load->view('raw_materials/landed_cost_head/v_landed_cost_head',$data);
    }
    
    function add_landed_cost_head() {
        $this->menu = 'trading';
        $this->sub_menu = 'rm_setup';
        $this->sub_inner_menu = 'rm_landed_cost_head';
        
        $this->titlebackend("Bank Information");
        
        $this->load->view('raw_materials/landed_cost_head/v_add_landed_cost_head',$data);
    }
    
    
    function add_landed_cost_head_action() {
        $branch_id= $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $data = $this->input->post();
        $bank_code= $this->input->post('bank_code');
       
        if (!empty($data)) {
            
            if(!empty($data['name']) && !empty($data['name'])){
                $pre_head=$this->m_common->get_row_array('import_landed_cost_head',array('name'=>$data['name'],'is_active'=>1),'*');
            }else{
                $pre_head='';
            }
            if(!empty($pre_head)){
                redirect_with_msg('raw_materials/landed_cost_head/add_landed_cost_head', 'This head already exists.');
            }
            
            $data['is_active']=1;
            $data['created_date']=date('Y-m-d');
            $data['created_by']=$user_id;
            
            $id = $this->m_common->insert_row('import_landed_cost_head', $data);
            
            if (!empty($id)){                
                redirect_with_msg('raw_materials/landed_cost_head/add_landed_cost_head', 'Successfully Inserted');
            }else{
                redirect_with_msg('raw_materials/landed_cost_head/add_landed_cost_head', 'Data not saved for an unexpected error');
            }
            
        } else {
            redirect_with_msg('raw_materials/landed_cost_head/add_landed_cost_head', 'Please fill the form and submit');
        }
    }
    
    function edit_landed_cost_head($id){
        $this->menu = 'trading';
        $this->sub_menu = 'rm_setup';
        $this->sub_inner_menu = 'rm_landed_cost_head';
        
        $this->titlebackend("Bank Basic Info");
        $data['head_info']=$this->m_common->get_row_array('import_landed_cost_head',array('id'=>$id),'*');
        $this->load->view('raw_materials/landed_cost_head/v_edit_landed_cost_head',$data);
    }
   
    function edit_landed_cost_head_action($id) {
        $branch_id= $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        
        $data = $this->input->post();
        $data['updated_date']=date('Y-m-d');
        $data['updated_by']=$user_id;
        if (!empty($data)) {
            $result=$this->m_common->update_row('import_landed_cost_head', array('id' => $id), $data);
            if (!empty($result)) {
                redirect_with_msg('raw_materials/landed_cost_head/index', 'Successfully Updated');
            } else {
                redirect_with_msg('raw_materials/landed_cost_head/edit_landed_cost_head/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/landed_cost_head/edit_landed_cost_head/'.$id, 'Please fill the form and submit');
        }
    }
    
   
     function delete_landed_cost_head($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('import_landed_cost_head', array('id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                redirect_with_msg('raw_materials/landed_cost_head/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('raw_materials/landed_cost_head/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/landed_cost_head/index', 'Please click on delete button');
        }
    }
   

}



