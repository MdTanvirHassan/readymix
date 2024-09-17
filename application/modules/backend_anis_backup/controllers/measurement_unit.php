<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Measurement_unit extends Site_Controller {

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
        $this->sub_inner_menu = 'measurement_unit';
        $this->titlebackend("Measurement Unit");
        $data['measurement_units']=$this->m_common->get_row_array('tbl_measurement_unit',array('is_active'=>1),'*');
        $this->load->view('measurement_unit/v_measurement_unit',$data);
    }
    
    function add_measurement_unit() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'measurement_unit';
        $this->titlebackend("Measurement Unit");    
        $data['groups']=$this->m_common->get_row_array('tbl_measurement_unit',array('is_active'=>1),'*');
        $this->load->view('measurement_unit/v_add_measurement_unit',$data);
    }
    
    
    function add_measurement_unit_action() {
        $data = $this->input->post();
       
        if(!empty($data)) {
            $pre_measurement_unit=$this->m_common->get_row_array('tbl_measurement_unit',array('meas_unit'=>$data['meas_unit'],'is_active'=>1),'*');
            if(!empty($pre_measurement_unit)){
                redirect_with_msg('measurement_unit/add_measurement_unit', 'This measurement unit already exists.');
            }
            $data['is_active']=1;
            $id = $this->m_common->insert_row('tbl_measurement_unit', $data);
            if (!empty($id)) {
                redirect_with_msg('measurement_unit/add_measurement_unit', 'Successfully Inserted');
            } else {
                redirect_with_msg('measurement_unit/add_measurement_unit', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('measurement_unit/add_measurement_unit', 'Please fill the form and submit');
        }
    }
    
    function edit_measurement_unit($id){
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'measurement_unit';
        $this->titlebackend("Measurement Unit");
        $data['measurement_unit_info']=$this->m_common->get_row_array('tbl_measurement_unit',array('id'=>$id),'*');
        $this->load->view('measurement_unit/v_edit_measurement_unit',$data);
    }
   
    function edit_measurement_unit_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $result=$this->m_common->update_row('tbl_measurement_unit', array('id' => $id), $data);
            if ($result>=0) {
                redirect_with_msg('measurement_unit/index', 'Successfully Updated');
            } else {
                redirect_with_msg('measurement_unit/edit_measurement_unit/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('measurement_unit/edit_measurement_unit/'.$id, 'Please fill the form and submit');
        }
    }
    
   
     function delete_measurement_unit($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('tbl_measurement_unit', array('id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                redirect_with_msg('measurement_unit/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('measurement_unit/index', 'Data not deleted for an unexpected error');
            }
        } else {
               redirect_with_msg('measurement_unit/index', 'Please click on delete button');
        }
    }
   

}



