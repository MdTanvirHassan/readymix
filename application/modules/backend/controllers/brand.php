<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Brand extends Site_Controller {

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
        $this->sub_inner_menu = 'brand';
        $this->titlebackend("Brand");
        $data['brands']=$this->m_common->get_row_array('tbl_item_brand',array('is_active'=>1),'*');
        $this->load->view('brand/v_brand',$data);
    }
    
    function add_brand() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'brand';
        $this->titlebackend("Brand");    
        $data['groups']=$this->m_common->get_row_array('tbl_item_brand',array('is_active'=>1),'*');
        $this->load->view('brand/v_add_brand',$data);
    }
    
    
    function add_brand_action() {
        $data = $this->input->post();
       
        if(!empty($data)) {
            $pre_brand=$this->m_common->get_row_array('tbl_item_brand',array('brand_name'=>$data['brand_name'],'is_active'=>1),'*');
            if(!empty($pre_brand)){
                redirect_with_msg('brand/add_brand', 'This measurement unit already exists.');
            }
            $data['is_active']=1;
            $id = $this->m_common->insert_row('tbl_item_brand', $data);
            if (!empty($id)) {
                redirect_with_msg('brand/add_brand', 'Successfully Inserted');
            } else {
                redirect_with_msg('brand/add_brand', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('brand/add_brand', 'Please fill the form and submit');
        }
    }
    
    function edit_brand($id){
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'brand';
        $this->titlebackend("Brand");
        $data['brand_info']=$this->m_common->get_row_array('tbl_item_brand',array('id'=>$id),'*');
        $this->load->view('brand/v_edit_brand',$data);
    }
   
    function edit_brand_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $result=$this->m_common->update_row('tbl_item_brand', array('id' => $id), $data);
            if ($result>=0) {
                redirect_with_msg('brand/index', 'Successfully Updated');
            } else {
                redirect_with_msg('brand/edit_brand/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('brand/edit_brand/'.$id, 'Please fill the form and submit');
        }
    }
    
   
     function delete_brand($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('tbl_item_brand', array('id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                redirect_with_msg('brand/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('brand/index', 'Data not deleted for an unexpected error');
            }
        } else {
               redirect_with_msg('brand/index', 'Please click on delete button');
        }
    }
   

}



