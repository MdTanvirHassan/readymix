<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Helpers extends Site_Controller {

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
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'helper';
        $this->titlebackend("Helpers");
        $data['helpers']=$this->m_common->get_row_array('tbl_helper',array('is_active'=>1),'*');
        $this->load->view('helper/v_helper',$data);
    }

   
    function add_helper() {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'helper';
        $this->titlebackend("Add Helper");   
        $this->load->view('helper/v_add_helper');
    }
    function add_helper_action() {
         $branch_id= $this->session->userdata('companyId');
         $employee_id = $this->session->userdata('employeeId');
         $postData=$this->input->post();
         if(!empty($postData)){
           
            $insertData = array();   

            
            if(!empty($postData['helper_name'])){
                 $insertData['helper_name'] =$postData['helper_name'];   
            }

            if(!empty($postData['contact_no'])){
                 $insertData['contact_no'] =$postData['contact_no'];   
            }

            if(!empty($postData['emergency_contact_no'])){
                 $insertData['emergency_contact_no'] =$postData['emergency_contact_no'];   
            }
            
            if(!empty($postData['present_address'])){
                 $insertData['present_address'] =$postData['present_address'];   
            }
            
            if(!empty($postData['permanent_address'])){
                 $insertData['permanent_address'] =$postData['permanent_address'];   
            }
            
            if(!empty($postData['blood_group'])){
                 $insertData['blood_group'] =$postData['blood_group'];   
            }
            
             if(!empty($postData['license_no'])){
                 $insertData['license_no'] =$postData['license_no'];   
             }


            
             $insertData['is_active']=1;
             $insertData['created_by']=$employee_id;
             $insertData['created_date']=date('Y-m-d');
             $insertData['created_date_time']=date("Y-m-d H:i:s");
             $result=$this->m_common->insert_row('tbl_helper',$insertData);
             if(!empty($result)){
                
                  redirect_with_msg('helpers', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('helpers/add_helper', 'Please fill the form and submit');
         }
         
     }
    
    function edit_helper($id) {
        $branch_id= $this->session->userdata('companyId');   
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'helper';
        $this->titlebackend("Edit Helper");
        $data['helper_info']=$this->m_common->get_row_array('tbl_helper',array('helper_id'=>$id),'*');           
        $this->load->view('helper/v_edit_helper',$data);
    }
    
    function edit_helper_action($id) {
         $postData=$this->input->post();
         if(!empty($postData)){
             
             $insertData = array();   

             if(!empty($postData['helper_name'])){
                 $insertData['helper_name'] =$postData['helper_name'];   
            }

            if(!empty($postData['contact_no'])){
                 $insertData['contact_no'] =$postData['contact_no'];   
            }

            if(!empty($postData['emergency_contact_no'])){
                 $insertData['emergency_contact_no'] =$postData['emergency_contact_no'];   
            }
            
            if(!empty($postData['present_address'])){
                 $insertData['present_address'] =$postData['present_address'];   
            }
            
            if(!empty($postData['permanent_address'])){
                 $insertData['permanent_address'] =$postData['permanent_address'];   
            }
            
           // if(!empty($postData['blood_group'])){
                 $insertData['blood_group'] =$postData['blood_group'];   
           // }
            
             if(!empty($postData['license_no'])){
                 $insertData['license_no'] =$postData['license_no'];   
             }

            
            
             $insertData['updated_by']=$employee_id;
             $insertData['updated_date']=date('Y-m-d');
             $insertData['updated_date_time']=date("Y-m-d H:i:s");
             
             $result=$this->m_common->update_row('tbl_helper',array('helper_id'=>$id),$insertData);
             if($result>=0){              
                  redirect_with_msg('helpers', 'Successfully Updated');
             }
         }else{
              redirect_with_msg('helpers', 'Please fill the form and submit');
         }
         
     }
     
    function details_helper($id,$print=false) {
        $branch_id= $this->session->userdata('companyId');   
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'helper';
        $this->titlebackend("Helper Details");
        $data['helper_info']=$this->m_common->get_row_array('tbl_helper',array('helper_id'=>$id),'*');      
        $this->load->view('helper/v_details_helper',$data);
       
    }
      
    function delete_helper($id) {
        $employee_id = $this->session->userdata('employeeId');
        $insertData=array();
        $insertData['is_active']=0;
        $insertData['deleted_by']=$employee_id;
        $insertData['deleted_date']=date('Y-m-d');
        $insertData['deleted_date_time']=date("Y-m-d H:i:s");
        if(!empty($id)) {
              $id =$this->m_common->update_row('tbl_helper',array('helper_id'=>$id),$insertData);
            if(!empty($id)) {
                redirect_with_msg('helpers/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('helpers/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('helpers/index', 'Please click on delete button');
        }
    }
    
  

}






