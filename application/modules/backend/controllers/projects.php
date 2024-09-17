<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Projects extends Site_Controller {

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
        $this->sub_inner_menu = 'project';
        $this->titlebackend("Projects");
        $sql="select p.*,c.c_name,c.c_short_name from tbl_project p left join tbl_customers c on p.customer_id=c.id where p.is_active=1";
        $data['projects']=$this->m_common->customeQuery($sql);
        $this->load->view('project/v_project',$data);
    }
    
    function add_project() {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'project';
        $this->titlebackend("Project Information");
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        $this->load->view('project/v_add_project',$data);
    }

     function add_project_action() {
       $postData = $this->input->post();
        if(!empty($postData)) {
            $insertData = array();
            if(!empty($postData['project_name'])){
                $insertData['project_name']=$postData['project_name'];
            }
            if(!empty($postData['contact_person'])){
                $insertData['contact_person']=$postData['contact_person'];
            }
            if(!empty($postData['contact_no'])){
                $insertData['contact_no']=$postData['contact_no'];
            }
            if(!empty($postData['customer_id'])){
                $insertData['customer_id']=$postData['customer_id'];
            }
            if(!empty($postData['address'])){
                $insertData['address']=$postData['address'];
            }
            
            $insertData['is_active']=1;
            $insertData['created_date']=date('Y-m-d');
            $pre_project=$this->m_common->get_row_array('tbl_project',array('project_name'=>$postData['project_name'],'customer_id'=>$postData['customer_id'],'is_active'=>1),'*');
            if(!empty($pre_project)){
                redirect_with_msg('projects/add_project', 'This project already exists.');
            }
            $id = $this->m_common->insert_row('tbl_project', $insertData);
            if(!empty($id)){
                redirect_with_msg('projects/add_project', 'Successfully Inserted');
            }else{
                redirect_with_msg('projects/add_project', 'Data not saved for an unexpected error');
            }
            
        } else {
            redirect_with_msg('projects/add_project', 'Please fill the form and submit');
        }
    }

    function edit_project($id){
        $this->menu = 'sales';
        $this->sub_menu = 'project';
        $this->sub_inner_menu = 'project';
        $this->titlebackend("Project Info");
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        $data['project_info']=$this->m_common->get_row_array('tbl_project',array('project_id'=>$id),'*');
        $this->load->view('project/v_edit_project',$data);
    }
    
    function edit_project_action($project_id) {
       $postData = $this->input->post();
        if(!empty($postData)) {
           $insertData = array();
           if(!empty($postData['project_name'])){
                $insertData['project_name']=$postData['project_name'];
            }
            if(!empty($postData['contact_person'])){
                $insertData['contact_person']=$postData['contact_person'];
            }
            if(!empty($postData['contact_no'])){
                $insertData['contact_no']=$postData['contact_no'];
            }
            if(!empty($postData['customer_id'])){
                $insertData['customer_id']=$postData['customer_id'];
            }
            if(!empty($postData['address'])){
                $insertData['address']=$postData['address'];
            }
            $insertData['updated_date']=date('Y-m-d');
            $id=$this->m_common->update_row('tbl_project', array('project_id' =>$project_id),$insertData);
            if($id==0 || $id>0) {
                redirect_with_msg('projects/index', 'Successfully Updated');
            } else {
                redirect_with_msg('projects/edit_project/'.$project_id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('projects/edit_project/'.$project_id, 'Please fill the form and submit');
        }
    }
    
    function details_project($id){
        $this->menu = 'sales';
        $this->sub_menu = 'project';
        $this->titlebackend("Project Info");
        $data['project_info']=$this->m_common->get_row_array('tbl_project',array('project_id'=>$id),'*');
        
        $so_sql="select o.*,q.reference_no,c.c_name,c.c_short_name from tbl_sales_orders o left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where o.is_active=1 and q.customer_id=".$id;
        $data['sale_orders']=$this->m_common->customeQuery($so_sql);
        
        $sql="select v.*,do.delivery_no,c.c_name,c.c_short_name from tbl_sales_invoices v left join tbl_delivery_orders do on v.do_id=do.do_id left join tbl_sales_orders o on do.o_id=o.o_id left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where v.is_active=1 and q.customer_id=".$id;
        $data['invoices']=$this->m_common->customeQuery($sql);
        
        $sql="select p.*,c.c_name,c.c_short_name from tbl_project p left join tbl_customers c on p.customer_id=c.id where p.is_active=1 and p.customer_id=".$id;
        $data['projects']=$this->m_common->customeQuery($sql);
        
       
        $this->load->view('project/v_details_project',$data);
    }
    
     function delete_project($project_id) {
        if(!empty($project_id)) {
            $id=$this->m_common->update_row('tbl_project', array('project_id' =>$project_id),array('is_active'=>0));
            if (!empty($id)) {   
                redirect_with_msg('projects/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('projects/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('projects/index', 'Please click on delete button');
        }
    }
    
}

