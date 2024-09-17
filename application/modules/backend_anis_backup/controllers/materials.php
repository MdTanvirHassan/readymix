<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Materials extends Site_Controller {

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
    }

    function index() {
        $this->menu = 'sales';
        $this->sub_menu = 'material';
        $this->titlebackend("Material");
        $data['materials']=$this->m_common->get_row_array('tbl_materials',array('is_active'=>1),'*');
        $this->load->view('material/v_materials',$data);
    }
    
    function add_material() {
        $this->menu = 'sales';
        $this->sub_menu = 'material';
        $this->titlebackend("Material Information");
        $this->load->view('material/v_add_material');
    }

     function add_material_action() {
        $data = $this->input->post();
        $data['is_active']=1;
        if (!empty($data)) {
            
            $pre_material=$this->m_common->get_row_array('tbl_materials',array('m_name'=>$data['m_name'],'is_active'=>1),'*');
            if(!empty($pre_material)){
                redirect_with_msg('materials/add_material', 'This material already exists.');
            }
            $id = $this->m_common->insert_row('tbl_materials', $data);
            if (!empty($id)) {
                redirect_with_msg('materials/add_material', 'Successfully Inserted');
            } else {
                redirect_with_msg('materials/add_material', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('materials/add_material', 'Please fill the form and submit');
        }
    }

     function edit_material($id){
        $this->menu = 'sales';
        $this->sub_menu = 'material';
        $this->titlebackend("Materials Basic Info");
        $data['material_info']=$this->m_common->get_row_array('tbl_materials',array('m_id'=>$id),'*');
        $this->load->view('material/v_edit_material',$data);
    }
    
    function edit_material_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $id=$this->m_common->update_row('tbl_materials', array('m_id' => $id), $data);
            if (!empty($id)) {
                redirect_with_msg('materials/index', 'Successfully Updated');
            } else {
                redirect_with_msg('materials/edit_material/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('materials/edit_material/'.$id, 'Please fill the form and submit');
        }
    }
    
     function delete_material($id) {
        if(!empty($id)) {
            $id=$this->m_common->update_row('tbl_materials', array('m_id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                redirect_with_msg('materials/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('materials/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('materials/index', 'Please click on delete button');
        }
    }
    
}

