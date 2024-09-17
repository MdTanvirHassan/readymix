<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Termcondition_template extends Site_Controller {

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
        $this->sub_inner_menu = 'term_condition';
        $this->titlebackend("Term Condition");
        $data['terms']=$this->m_common->get_row_array('tbl_term_condition_template',array('is_active'=>1),'*');
        $this->load->view('term_condition/v_term_condition',$data);
    }
    
    function add_term_condition() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'term_condition';
        $this->titlebackend("Term & Condition");    
        
        $this->load->view('term_condition/v_add_term_condition');
    }
    
    
    function add_term_condition_action() {
        $postData = $this->input->post();
       
        if(!empty($postData)) {
            $pre_term_condition=$this->m_common->get_row_array('tbl_term_condition_template',array('template_name'=>$postData['template_name'],'is_active'=>1),'*');
            if(!empty($pre_term_condition)){
                redirect_with_msg('term_condition/add_term_condition', 'Already exists.');
            }
            $insertData['template_name']=$postData['template_name'];
            $insertData['is_active']=1;
            $id = $this->m_common->insert_row('tbl_term_condition_template',$insertData);
            if (!empty($id)) {
                foreach ($postData['title'] as $key => $each) {
                      $insertData2=array();
                      $insertData2['tem_id'] = $id;
                      if(empty($each)){
                          continue;
                      }
                      if(!empty($postData['title'][$key])) {
                           $insertData2['title'] = $postData['title'][$key];
                      }
                      
                      if(!empty($postData['description'][$key])) { 
                          $insertData2['description'] = $postData['description'][$key];
                      }    
                      $this->m_common->insert_row('tbl_term_condition_details',$insertData2);
                 }
                redirect_with_msg('termcondition_template/add_term_condition', 'Successfully Inserted');
            } else {
                redirect_with_msg('termcondition_template/add_term_condition', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('termcondition_template/add_term_condition', 'Please fill the form and submit');
        }
    }
    
    function edit_term_condition($id){
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'term_condition';
        $this->titlebackend("Term Condition Template");
        $data['term_condition_info']=$this->m_common->get_row_array('tbl_term_condition_template',array('id'=>$id),'*');
        $data['term_condition_details']=$this->m_common->get_row_array('tbl_term_condition_details',array('tem_id'=>$id),'*');
        $this->load->view('term_condition/v_edit_term_condition',$data);
    }
   
    function edit_term_condition_action($id) {
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData['template_name']=$postData['template_name'];
            $result=$this->m_common->update_row('tbl_term_condition_template',array('id' =>$id),$insertData);
            if ($result>=0) {
                $this->m_common->delete_row('tbl_term_condition_details',array('tem_id'=>$id));
                foreach ($postData['title'] as $key => $each) {
                      $insertData2=array();
                      $insertData2['tem_id'] = $id;
                      if(empty($each)){
                          continue;
                      }
                      if(!empty($postData['title'][$key])) {
                           $insertData2['title'] = $postData['title'][$key];
                      }
                      
                      if(!empty($postData['description'][$key])) { 
                          $insertData2['description'] = $postData['description'][$key];
                      }    
                      $this->m_common->insert_row('tbl_term_condition_details',$insertData2);
                 }
                redirect_with_msg('termcondition_template/index', 'Successfully Updated');
            } else {
                redirect_with_msg('termcondition_template/edit_term_condition/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('termcondition_template/edit_term_condition/'.$id, 'Please fill the form and submit');
        }
    }
    
   
     function delete_term_condition($id) {
        if(!empty($id)){
            $id=$this->m_common->update_row('tbl_term_condition_template',array('id'=>$id),array('is_active'=>0));
            if(!empty($id)){
                $this->m_common->update_row('tbl_term_condition_details',array('tem_id'=>$id),array('is_active'=>0));
                redirect_with_msg('termcondition_template/index', 'Successfully Deleted');
            }else{
                redirect_with_msg('termcondition_template/index', 'Data not deleted for an unexpected error');
            }
        }else{
               redirect_with_msg('termcondition_template/index', 'Please click on delete button');
        }
    }
   

}



