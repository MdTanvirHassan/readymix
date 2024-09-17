<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_categories extends Site_Controller {

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
        $this->sub_inner_menu = 'product_category';
        $this->titlebackend("Product Categories");
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories',array('is_active'=>1),'*');
        $this->load->view('product_categories/v_product_category',$data);
    }
    
    function add_product_category() {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'product_category';
        $this->titlebackend("Category Information");
        $this->load->view('product_categories/v_add_product_category');
    }

     function add_product_category_action() {
       $postData = $this->input->post();
        if(!empty($postData)) {
            $insertData = array();
            if(!empty($postData['category_name'])){
                $insertData['category_name']=$postData['category_name'];
            }
            if(!empty($postData['short_name'])){
                $insertData['short_name']=$postData['short_name'];
            }
            if(!empty($postData['description'])){
                $insertData['description']=$postData['description'];
            }
            $insertData['is_active']=1;
            $pre_product_category=$this->m_common->get_row_array('tbl_product_categories',array('category_name'=>$postData['category_name'],'is_active'=>1),'*');
            if(!empty($pre_product_category)){
                redirect_with_msg('product_categories/add_product_category', 'This Category already exists.');
            }
            $id = $this->m_common->insert_row('tbl_product_categories', $insertData);
            if(!empty($id)){
                redirect_with_msg('product_categories/add_product_category', 'Successfully Inserted');
            }else{
                redirect_with_msg('product_categories/add_product_category', 'Data not saved for an unexpected error');
            }
            
        } else {
            redirect_with_msg('product_categories/add_product_category', 'Please fill the form and submit');
        }
    }

    function edit_product_category($id){
        $this->menu = 'sales';
        $this->sub_menu = 's_setup';
        $this->sub_inner_menu = 'product_category';
        $this->titlebackend("Category Info");
        $data['product_category_info']=$this->m_common->get_row_array('tbl_product_categories',array('category_id'=>$id),'*');
        $this->load->view('product_categories/v_edit_product_category',$data);
    }
    
    function edit_product_category_action($category_id) {
       $postData = $this->input->post();
        if(!empty($postData)) {
            $insertData = array();
            if(!empty($postData['category_name'])){
                $insertData['category_name']=$postData['category_name'];
            }
            if(!empty($postData['short_name'])){
                $insertData['short_name']=$postData['short_name'];
            }
            if(!empty($postData['description'])){
                $insertData['description']=$postData['description'];
            }
            
            $id=$this->m_common->update_row('tbl_product_categories', array('category_id' =>$category_id),$insertData);
            if($id==0 || $id>0) {
                redirect_with_msg('product_categories/index', 'Successfully Updated');
            } else {
                redirect_with_msg('product_categories/edit_product_category/'.$category_id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('product_category/edit_product_category/'.$category_id, 'Please fill the form and submit');
        }
    }
    
     function details_product_category($id){
        $this->menu = 'sales';
        $this->sub_menu = 'product_category';
        $this->titlebackend("Item Info");
      //  $data['materials']=$this->m_common->get_row_array('tbl_materials',array('is_active'=>1),'*');
        $data['materials']=$this->m_common->get_row_array('items','','*');
        $data['product_category_info']=$this->m_common->get_row_array('tbl_product_categorys',array('s_item_id'=>$id),'*');
        $data['product_category_materials']=$this->m_common->get_row_array('tbl_product_category_details',array('s_item_id'=>$id),'*');
        $this->load->view('product_category/v_details_product_category',$data);
    }
    
     function delete_product_category($category_id) {
        if(!empty($category_id)) {
            $id=$this->m_common->update_row('tbl_product_categories', array('category_id' =>$category_id),array('is_active'=>0));
            if (!empty($id)) {   
                redirect_with_msg('product_categories/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('product_categories/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('product_categories/index', 'Please click on delete button');
        }
    }
    
}

