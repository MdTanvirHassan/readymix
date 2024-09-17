<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sale_products extends Site_Controller {

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
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_product';
        $this->titlebackend("Products");
        $data['sale_products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
        $this->load->view('sale_products/v_sale_product',$data);
    }
    
    function add_sale_product() {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_product';
        
        $this->titlebackend("Item Information");
        $data['categories']=$this->m_common->get_row_array('tbl_product_categories',array('is_active'=>1),'*');
        $this->load->view('sale_products/v_add_sale_product',$data);
    }

     function add_sale_product_action() {
       $postData = $this->input->post();
       $item_code=$this->input->post('item_c');
       $category_id=$this->input->post('category_id');
        if(!empty($postData)) {
            $insertData = array();
            if(!empty($postData['product_name'])){
                $insertData['product_name']=$postData['product_name'];
            }
            if(!empty($postData['category_id'])){
                $insertData['category_id']=$postData['category_id'];
            }
           
            if(!empty($postData['p_code'])){
                $insertData['p_code']=$postData['p_code'];
            }
            if(!empty($postData['specification'])){
                $insertData['specification']=$postData['specification'];
            }
            if(!empty($postData['p_psi'])){
                $insertData['p_psi']=$postData['p_psi'];
            }
            
           if(!empty($postData['mpa'])){
                $insertData['mpa']=$postData['mpa'];
            }
            
            if(!empty($postData['measurement_unit'])){
                $insertData['measurement_unit']=$postData['measurement_unit'];
            }
            if(!empty($postData['performance'])){
                $insertData['performance']=$postData['performance'];
            }
            if(!empty($postData['remark'])){
                $insertData['remark']=$postData['remark'];
            }
            $insertData['is_active']=1;
            $pre_sale_products=$this->m_common->get_row_array('tbl_sales_products',array('product_name'=>$postData['product_name'],'is_active'=>1),'*');
            if(!empty($pre_sale_products)){
                redirect_with_msg('sale_products/add_sale_product', 'This product already exists.');
            }
            $id = $this->m_common->insert_row('tbl_sales_products', $insertData);
            if(!empty($id)) {
                $this->m_common->insert_row('tbl_sales_product_code', array('product_code'=>$item_code,'category_id'=>$category_id));
                redirect_with_msg('sale_products/add_sale_product', 'Successfully Inserted');
            } else {
                redirect_with_msg('sale_products/add_sale_product', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('sale_products/add_sale_product', 'Please fill the form and submit');
        }
    }

    function edit_sale_product($id){
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_product';
        
        $this->titlebackend("Item Info");
     
        $data['categories']=$this->m_common->get_row_array('tbl_product_categories',array('is_active'=>1),'*');
        $data['sale_product_info']=$this->m_common->get_row_array('tbl_sales_products',array('product_id'=>$id),'*');
        
        $this->load->view('sale_products/v_edit_sale_product',$data);
    }
    
    function edit_sale_product_action($product_id) {
       $postData = $this->input->post();
        if(!empty($postData)) {
            $insertData = array();
            if(!empty($postData['product_name'])){
                $insertData['product_name']=$postData['product_name'];
            }
            if(!empty($postData['category_id'])){
                $insertData['category_id']=$postData['category_id'];
            }
           
            if(!empty($postData['p_code'])){
                $insertData['p_code']=$postData['p_code'];
            }
            if(!empty($postData['specification'])){
                $insertData['specification']=$postData['specification'];
            }
            if(!empty($postData['p_psi'])){
                $insertData['p_psi']=$postData['p_psi'];
            }
            
            if(!empty($postData['mpa'])){
                $insertData['mpa']=$postData['mpa'];
            }
            
            if(!empty($postData['measurement_unit'])){
                $insertData['measurement_unit']=$postData['measurement_unit'];
            }
            if(!empty($postData['performance'])){
                $insertData['performance']=$postData['performance'];
            }
            if(!empty($postData['remark'])){
                $insertData['remark']=$postData['remark'];
            }    
            $id=$this->m_common->update_row('tbl_sales_products', array('product_id' =>$product_id),$insertData);
            if($id==0 || $id>0) {        
                redirect_with_msg('sale_products/index', 'Successfully Updated');
            } else {
                redirect_with_msg('sale_products/edit_sale_product/'.$product_id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('sale_products/edit_sale_product/'.$product_id, 'Please fill the form and submit');
        }
    }
    
     function details_sale_product($id){
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_product';
        
        $this->titlebackend("Item Info");
        $data['categories']=$this->m_common->get_row_array('tbl_product_categories','','*');
        $data['sale_product_info']=$this->m_common->get_row_array('tbl_sales_products',array('product_id'=>$id),'*');
        
        $this->load->view('sale_products/v_details_sale_product',$data);
    }
    
     function delete_sale_product($product_id) {
        if(!empty($product_id)) {
            $id=$this->m_common->update_row('tbl_sales_products', array('product_id' =>$product_id),array('is_active'=>0));
            if (!empty($id)) {
              
                redirect_with_msg('sale_products/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('sale_products/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('sale_products/index', 'Please click on delete button');
        }
    }
    
     function group_item_id(){
        $this->setOutputMode(NORMAL);
        $category_id=$this->input->post('category_id');
        $data['category_id']=$this->m_common->get_row_array('tbl_sales_product_code',array('category_id'=>$category_id),'*','',1,'id','DESC');
        $data['category_info']=$this->m_common->get_row_array('tbl_product_categories',array('category_id'=>$category_id),'*');
        echo json_encode($data);
     }
    
}

