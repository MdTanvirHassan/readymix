<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asset_category extends Site_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->is_logged_in($this->session->userdata('logged_in'))) {
            redirect_with_msg('backend/login', 'Please Login to see this page');
        }
        $this->load->model("m_common");
        $this->setTemplateFile('template');
        $this->user_id = $this->session->userdata('user_id');
    }

    function index() {
        $this->menu = 'general_store';
        $this->sub_menu = 'asset';
        $this->sub_inner_menu = 'asset_category';
        $this->titlebackend("Asset Categories");
        $data['asset_categories'] = $this->m_common->get_row_array('asset_category', '', '*');
        $this->load->view('asset_category/v_asset_category', $data);
    }

    function add_asset_category() {
        $this->menu = 'general_store';
        $this->sub_menu = 'asset';
        $this->sub_inner_menu = 'asset_category';
        $this->titlebackend("Add Asset Category");
        $this->load->view('asset_category/v_add_asset_category');
    }

    function add_asset_category_action() {
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            $insertData['category_name'] = $postData['category_name'];
            $insertData['description'] = $postData['description'];
            $insertData['created'] = date('Y-m-d');
            

            if ($this->m_common->insert_row('asset_category', $insertData)) {
                redirect_with_msg('backend/asset_category', 'Inserted Successfully');
            } else {
                redirect_with_msg('backend/asset_category/add_asset_category', 'Insertion Error');
            }
        } else {
            redirect_with_msg('backend/asset_category/add_asset_category', 'Please Post the form first');
        }
    }

    function edit_asset_category($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'asset';
        $this->sub_inner_menu = 'asset_category';
        $this->titlebackend("Edit Asset Category");
        $data['category'] = $this->m_common->get_row_array('asset_category', array('category_id' => $id), '*');
        $this->load->view('asset_category/v_edit_asset_category', $data);
    }

    function show_asset_category($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'asset';
        $this->sub_inner_menu = 'asset_category';
        $this->titlebackend("Edit Asset Category");
        $data['category'] = $this->m_common->get_row_array('asset_category', array('category_id' => $id), '*');
        $this->load->view('asset_category/v_show_asset_category', $data);
    }

    function edit_asset_category_action($id) {
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
             $insertData['category_name'] = $postData['category_name'];
             $insertData['description'] = $postData['description'];
             $insertData['created'] = date('Y-m-d');
            if ($this->m_common->update_row('asset_category', array('category_id' => $id), $insertData)) {
                redirect_with_msg('backend/asset_category', 'Update Successfully');
            } else {
                redirect_with_msg('backend/asset_category/edit_asset_category/'.$id, 'Update Error');
            }
        } else {
            redirect_with_msg('backend/asset_category/edit_asset_category/'.$id, 'Please Post the form first');
        }
    }

    function delete_asset_category() {
        $ids = explode(',', $this->input->post('ids'));
        foreach ($ids as $id) {   
            $result=$this->m_common->delete_row('asset_category', array('category_id' => $id));
            
        }
        echo 'success';
    }

    function delete_single_asset_category($id) {
        
        if ($this->m_common->delete_row('asset_category', array('category_id' => $id))){  
            redirect_with_msg('backend/asset_category', 'successfully deleted');
        }else
            redirect_with_msg('backend/asset_category', 'Not deleted');
       }

}



