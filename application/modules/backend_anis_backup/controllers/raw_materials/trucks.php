<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trucks extends Site_Controller {

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
        $this->menu = 'trading';
        $this->sub_menu = 'rm_challan';
        $this->sub_inner_menu = 'truck';
        $this->titlebackend("Trucks");
        $data['trucks']=$this->m_common->get_row_array('tbl_truck',array('is_active'=>1,'transport_type'=>'Truck'),'*');
        $this->load->view('raw_materials/truck/v_truck',$data);
    }

   
    function add_truck() {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'trading';
        $this->sub_menu = 'rm_challan';
        $this->sub_inner_menu = 'truck';
        $this->titlebackend("Add Truck");   
        $this->load->view('raw_materials/truck/v_add_truck');
    }
    function add_truck_action() {
         $branch_id= $this->session->userdata('companyId');
         $employee_id = $this->session->userdata('employeeId');
         $postData=$this->input->post();
         if(!empty($postData)){
           
            $insertData = array();   
            
             if(!empty($postData['truck_no'])){
                 $insertData['truck_no'] =$postData['truck_no'];   
             }

             if(!empty($postData['license_no'])){
                 $insertData['license_no'] =$postData['license_no'];   
             }


            if(!empty($postData['insurance_no'])){
                 $insertData['insurance_no'] =$postData['insurance_no'];   
            }

            if(!empty($postData['road_permit'])){
                 $insertData['road_permit'] =$postData['road_permit'];   
            }

            if(!empty($postData['tax_token'])){
                 $insertData['tax_token'] =$postData['tax_token'];   
            }
            
             $insertData['transport_type']='Truck';
             $insertData['is_active']=1;
             $insertData['created_by']=$employee_id;
             $insertData['created_date']=date('Y-m-d');
             $insertData['created_date_time']=date("Y-m-d H:i:s");
             $result=$this->m_common->insert_row('tbl_truck',$insertData);
             if(!empty($result)){
                
                  redirect_with_msg('raw_materials/trucks', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('raw_materials/trucks/add_truck', 'Please fill the form and submit');
         }
         
     }
    
    function edit_truck($id) {
        $branch_id= $this->session->userdata('companyId');   
        $this->menu = 'trading';
        $this->sub_menu = 'rm_challan';
        $this->sub_inner_menu = 'truck';
        $this->titlebackend("Edit Truck");
        $data['truck_info']=$this->m_common->get_row_array('tbl_truck',array('truck_id'=>$id),'*');           
        $this->load->view('raw_materials/truck/v_edit_truck',$data);
    }
    
    function edit_truck_action($id) {
        $employee_id = $this->session->userdata('employeeId');
         $postData=$this->input->post();
         if(!empty($postData)){
             
             $insertData = array();   

             if(!empty($postData['truck_no'])){
                 $insertData['truck_no'] =$postData['truck_no'];   
             }
                         
             if(!empty($postData['license_no'])){
                 $insertData['license_no'] =$postData['license_no'];   
             }

            if(!empty($postData['insurance_no'])){
                 $insertData['insurance_no'] =$postData['insurance_no'];   
            }

            if(!empty($postData['road_permit'])){
                 $insertData['road_permit'] =$postData['road_permit'];   
            }

            if(!empty($postData['tax_token'])){
                 $insertData['tax_token'] =$postData['tax_token'];   
            }
                       
             $insertData['updated_by']=$employee_id;
             $insertData['updated_date']=date('Y-m-d');
             $insertData['updated_date_time']=date("Y-m-d H:i:s");
             
             $result=$this->m_common->update_row('tbl_truck',array('truck_id'=>$id),$insertData);
             if($result>=0){              
                  redirect_with_msg('raw_materials/trucks', 'Successfully Updated');
             }
         }else{
              redirect_with_msg('raw_materials/trucks', 'Please fill the form and submit');
         }
         
     }
     
    function details_truck($id,$print=false) {
        $branch_id= $this->session->userdata('companyId');   
        $this->menu = 'trading';
        $this->sub_menu = 'rm_challan';
        $this->sub_inner_menu = 'truck';
        $this->titlebackend("Details Truck");
        $data['truck_info']=$this->m_common->get_row_array('tbl_truck',array('truck_id'=>$id),'*');      
        $this->load->view('raw_materials/truck/v_details_truck',$data);
       
    }
      
    function delete_truck($id) {
        $employee_id = $this->session->userdata('employeeId');
        $insertData=array();
        $insertData['is_active']=0;
        $insertData['deleted_by']=$employee_id;
        $insertData['deleted_date']=date('Y-m-d');
        $insertData['deleted_date_time']=date("Y-m-d H:i:s");
        if(!empty($id)) {
            $id =$this->m_common->update_row('tbl_truck',array('truck_id'=>$id),$insertData);
            if(!empty($id)) {
                redirect_with_msg('raw_materials/trucks/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('raw_materials/trucks/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/trucks/index', 'Please click on delete button');
        }
    }
    
  

}






