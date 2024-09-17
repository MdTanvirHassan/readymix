<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Services extends Site_Controller {

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
        $this->sub_menu = 'set_up';
        $this->sub_inner_menu = 'service_info';
        $this->titlebackend("Service Information");
        $sql="select ts.*,tsg.group_name from tbl_services ts left join tbl_service_group tsg on ts.group_id=tsg.id where ts.is_active=1";
        $data['services']=$this->m_common->customeQuery($sql);
        $this->load->view('services/v_services',$data);
    }
    
    function add_service() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'service_info';
        $this->titlebackend("Service Information");
        $service_last_code=$this->m_common->get_row_array('tbl_service_code','','*','',1,'id','DESC');
        if(!empty($service_last_code)){
           
            $service_code=$service_last_code[0]['service_code']+1;
            if($service_code>999){
                $service_sl_no=$service_code;
            }else if($service_code>99){
                $service_sl_no="0".$service_code;
            }else if($service_code>9){
                $service_sl_no="00".$service_code;
            }else{
                $service_sl_no="000".$service_code;
            }
        }else{
            $service_code=1;
            $service_sl_no='0001';
        }
        $data['service_code']=$service_code;
        $data['service_auto_code']=$service_sl_no;
        $data['groups']=$this->m_common->get_row_array('tbl_service_group',array('is_active'=>1),'*');
        $this->load->view('services/v_add_service',$data);
    }
    
    
    function add_service_action() {
        $data = $this->input->post();
        $service_c=$this->input->post('service_code');
        if(!empty($data)) {
            $pre_service=$this->m_common->get_row_array('tbl_services',array('service_name'=>$data['service_name'],'is_active'=>1),'*');
            if(!empty($pre_service)){
                redirect_with_msg('services/add_service', 'This service already exists.');
            }
            $data['is_active']=1;
            unset($data['service_code']);
            $id = $this->m_common->insert_row('tbl_services', $data);
            if (!empty($id)) {
                $this->m_common->insert_row('tbl_service_code', array('service_code'=>$service_c));
                redirect_with_msg('services/add_service', 'Successfully Inserted');
            } else {
                redirect_with_msg('services/add_service', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('services/add_service', 'Please fill the form and submit');
        }
    }
    
    function edit_service($id){
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'service_info';
        $this->titlebackend("Service Info");
        $data['groups']=$this->m_common->get_row_array('tbl_service_group',array('is_active'=>1),'*');
        $data['service_info']=$this->m_common->get_row_array('tbl_services',array('id'=>$id),'*');
        $this->load->view('services/v_edit_service',$data);
    }
   
    function edit_service_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $result=$this->m_common->update_row('tbl_services', array('id' => $id), $data);
            if (!empty($result)) {
                redirect_with_msg('services/index', 'Successfully Updated');
            } else {
                redirect_with_msg('services/edit_service/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('services/edit_service/'.$id, 'Please fill the form and submit');
        }
    }
    
   
     function delete_service($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('tbl_services', array('id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                redirect_with_msg('services/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('services/index', 'Data not deleted for an unexpected error');
            }
        } else {
               redirect_with_msg('services/index', 'Please click on delete button');
        }
    }
   

}



