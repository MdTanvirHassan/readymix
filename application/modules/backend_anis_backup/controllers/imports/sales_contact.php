<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_contact extends Site_Controller {

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
        $this->menu = 'procurement';
        $this->sub_menu = 'sales_contact';
        $this->sub_inner_menu = 'sales_contact';
        $this->titlebackend("Sales Contact");  
       
        $data['sales_contact']=$this->m_common->get_row_array('import_sales_contact',array('is_active'=>1), '*');
        $this->load->view('imports/sales_contact/v_sales_contact',$data);
    }
    
    function add_sales_contact(){
       $this->menu ='procurement';
       $this->sub_menu ='import';
       $this->sub_inner_menu ='sales_contact';
       $this->titlebackend("Sales Contact");  
       
       $data['suppliers']=$this->m_common->get_row_array('supplier',array('s_type'=>'Supplier','LOCAL'=>"Foreign"),'*'); 
       $data['items']=$this->m_common->get_row_array('rm_items',array('is_active'=>1), '*'); 
       $data['currencies']=$this->m_common->get_row_array('currencies',array('is_active'=>1), '*');
       $this->load->view('imports/sales_contact/v_add_sales_contact',$data);
    }

     function add_sales_contact_action(){
         
        $this->menu = 'procurement';
        $this->sub_menu = 'import';
        $this->sub_inner_menu = 'sales_contact';
        $this->titlebackend("Sales Contact");          
        $postData=$this->input->post();
        
        $branch_id=$this->session->userdata('companyId');
        $employee_id =$this->session->userdata('employeeId');
        
        if(!empty($postData)){
            $insertData['currency_id']=$postData['currency_id'];
            $insertData['sup_id']=$postData['sup_id'];
            $insertData['contact_no'] =$postData['contact_no'];
            $insertData['contact_date'] =date('Y-m-d',strtotime($postData['contact_date'])); 
            $insertData['lc_deadline'] =date('Y-m-d',strtotime($postData['lc_deadline'])); 
            $insertData['crops_year'] =$postData['crops_year'];
            $insertData['shipment_port'] =$postData['shipment_port'];
            $insertData['shipment_deadline'] =date('Y-m-d',strtotime($postData['shipment_deadline'])); 
            $insertData['local_agent'] =$postData['local_agent'];
            $insertData['agent_contact'] =$postData['agent_contact'];
            $insertData['discharge_rate'] =$postData['discharge_rate'];
            $insertData['created_by'] =$employee_id;
            $insertData['created_date'] =date('Y-m-d');
            $insertData['branch_id']=$branch_id;
            $insertData['is_active']=1;  
            $insertData['status']="Pending"; 
            
            $id=$this->m_common->insert_row('import_sales_contact', $insertData);
            
            if(!empty($id)){
               foreach ($postData['item_id'] as $key => $each){
                    $insertData1=array();
                    $insertData1['sales_contact_id'] = $id;
                    $insertData1['item_id'] = $each;
                    
                    if(!empty($postData['lbs_qty'][$key])) {
                        $insertData1['lbs_qty'] = $postData['lbs_qty'][$key];
                    }
                    
                    
                    if(!empty($postData['qty'][$key])) {
                        $insertData1['qty'] = $postData['qty'][$key];
                    }
                    
                    if(!empty($postData['rate'][$key])) {
                        $insertData1['rate'] = $postData['rate'][$key];
                    }
                    
                    $insertData1['value'] =$postData['qty'][$key]*$postData['rate'][$key];
                    $this->m_common->insert_row('import_sales_contact_details', $insertData1);
                         
                } 
               redirect_with_msg('imports/sales_contact/add_sales_contact', 'Successfully Inserted');
            }else{
                redirect_with_msg('imports/sales_contact/add_sales_contact', 'Data not saved for an unexpected error');
            }
        }else{
            redirect_with_msg('imports/sales_contact/add_sales_contact', 'Please submit the form first');
        }
    }

    
    function edit_sales_contact($id=false){
        $this->menu = 'procurement';
        $this->sub_menu = 'import';
        $this->sub_inner_menu = 'sales_contact';
        $this->titlebackend("Sales Contact");    
      
        $branch_id= $this->session->userdata('companyId'); 
        $data['contact_info']=$this->m_common->get_row_array('import_sales_contact',array('id'=>$id),'*');
        
        $sc_sql="select iscd.*,rmi.origin,rmi.staple_length,rmi.item_grade,tmu.meas_unit from import_sales_contact_details iscd
        left join import_sales_contact isc on iscd.sales_contact_id=isc.id 
        left join rm_items rmi on iscd.item_id=rmi.id 
        left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id
        where iscd.sales_contact_id=".$id;
        $data['contact_details']=$this->m_common->customeQuery($sc_sql);
        
        $data['suppliers']=$this->m_common->get_row_array('supplier',array('s_type'=>'Supplier','LOCAL'=>"Foreign"),'*'); 
        $data['items']=$this->m_common->get_row_array('rm_items',array('is_active'=>1), '*'); 
        $data['currencies']=$this->m_common->get_row_array('currencies',array('is_active'=>1), '*');
       
        
        $this->load->view('imports/sales_contact/v_edit_sales_contact',$data);
    }
   
    function edit_sales_contact_action($c_id=false) {
       
        $this->menu = 'procurement';
        $this->sub_menu = 'import';
        $this->sub_inner_menu = 'sales_contact';
        $this->titlebackend("Sales Contact"); 
        
        
        $branch_id= $this->session->userdata('companyId'); 
        $employeeId=$this->session->userdata('employeeId');
        
        $postData=$this->input->post();
        
        if(!empty($postData)){
            $insertData['currency_id']=$postData['currency_id'];
            $insertData['sup_id']=$postData['sup_id'];
            $insertData['contact_no'] =$postData['contact_no'];
            $insertData['contact_date'] =date('Y-m-d',strtotime($postData['contact_date'])); 
            $insertData['lc_deadline'] =date('Y-m-d',strtotime($postData['lc_deadline'])); 
            $insertData['crops_year'] =$postData['crops_year'];
            $insertData['shipment_port'] =$postData['shipment_port'];
            $insertData['shipment_deadline'] =date('Y-m-d',strtotime($postData['shipment_deadline'])); 
            $insertData['local_agent'] =$postData['local_agent'];
            $insertData['agent_contact'] =$postData['agent_contact'];
            $insertData['discharge_rate'] =$postData['discharge_rate'];
            $insertData['created_by'] =$employee_id;
            $insertData['created_date'] =date('Y-m-d');
            $insertData['branch_id']=$branch_id;
            $insertData['is_active']=1;                       
            $id=$this->m_common->update_row('import_sales_contact',array('id'=>$c_id),$insertData);
            
            if($id>=0){
               $this->m_common->delete_row('import_sales_contact_details',array('sales_contact_id'=>$c_id));
               foreach ($postData['item_id'] as $key=>$each){
                    $insertData1=array();
                    $insertData1['sales_contact_id']=$c_id;
                    $insertData1['item_id'] = $each;
                    
                    if(!empty($postData['lbs_qty'][$key])) {
                        $insertData1['lbs_qty'] = $postData['lbs_qty'][$key];
                    }
                    
                    if(!empty($postData['qty'][$key])) {
                        $insertData1['qty'] = $postData['qty'][$key];
                    }
                    
                    if(!empty($postData['rate'][$key])) {
                        $insertData1['rate'] = $postData['rate'][$key];
                    }
                    
                    $insertData1['value'] =$postData['qty'][$key]*$postData['rate'][$key];
                    $this->m_common->insert_row('import_sales_contact_details', $insertData1);
                         
               } 
               redirect_with_msg('imports/sales_contact/details_sales_contact/'.$c_id, 'Successfully Updated');
            }else{
                redirect_with_msg('imports/sales_contact/edit_sales_contact/'.$c_id, 'Data not saved for an unexpected error');
            }
        }else{
            redirect_with_msg('imports/sales_contact/edit_sales_contact/'.$c_id, 'Please submit the form first');
        }
        
        
    }
  
    
    
    function details_sales_contact($id=false){
        
        $this->menu = 'procurement';
        $this->sub_menu = 'import';
        $this->sub_inner_menu = 'sales_contact';
        $this->titlebackend("Sales Contact"); 
        
        
        $branch_id= $this->session->userdata('companyId'); 
        $data['contact_info']=$this->m_common->get_row_array('import_sales_contact',array('id'=>$id),'*');
        
        $sc_sql="select iscd.*,rmi.origin,rmi.staple_length,rmi.item_grade,tmu.meas_unit from import_sales_contact_details iscd
        left join import_sales_contact isc on iscd.sales_contact_id=isc.id 
        left join rm_items rmi on iscd.item_id=rmi.id 
        left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id
        where iscd.sales_contact_id=".$id;
        $data['contact_details']=$this->m_common->customeQuery($sc_sql);
        
        $data['suppliers']=$this->m_common->get_row_array('supplier',array('s_type'=>'Supplier','LOCAL'=>"Foreign"),'*'); 
        $data['items']=$this->m_common->get_row_array('rm_items',array('is_active'=>1), '*'); 
        
        $data['currencies']=$this->m_common->get_row_array('currencies',array('is_active'=>1), '*');
               
        $this->load->view('imports/sales_contact/v_details_sales_contact',$data);
        
        
    }
    
    
    
     function delete_sales_contact($r_id) {
        if(!empty($r_id)) {
            $id=$this->m_common->update_row('import_sales_contact', array('id' =>$r_id),array('is_active'=>0));
            if(!empty($id)){          
                redirect_with_msg('imports/sales_contact/index', 'Successfully Deleted');
            }else{
                redirect_with_msg('imports/sales_contact/index', 'Data not deleted for an unexpected error');
            }
        }else{
            redirect_with_msg('imports/sales_contact/index', 'Please click on delete button');
        }
    }
    
    
    function subgroup_item_id(){
        $this->setOutputMode(NORMAL);
        $group_id=$this->input->post('group_id');
        $subgroup=$this->input->post('subgroup');
      //  $data['item']=$this->m_common->get_row_array('items',array('item_group'=>$group_id,'item_category'=>$subgroup),'*','',1,'item_number','DESC');
        $data['group_id']=$this->m_common->get_row_array('item_code',array('group_id'=>$group_id),'*','',1,'id','DESC');
       // $data['group_info']=$this->m_common->get_row_array('item_groups',array('id'=>$group_id),'*');
        
        
        
        $data['item']=$this->m_common->get_row_array('rm_items',array('item_category'=>$subgroup),'*','',1,'item_number','DESC');
        $data['groups']=$this->m_common->get_row_array('item_category',array('c_id'=>$subgroup),'*');
        $data['group_info']=$this->m_common->get_row_array('item_groups',array('id'=>$data['groups'][0]['group_id']),'*');
        
        echo json_encode($data);
     }
    
     
     function rm_info(){
        $this->setOutputMode(NORMAL);
        $item_id=$this->input->post('item_id'); 
        $sql="select i.*,tmu.meas_unit from rm_items i left join tbl_measurement_unit tmu on i.mu_id=tmu.id where i.id=".$item_id;
        $data['item_info']=$this->m_common->customeQuery($sql);
        
        echo json_encode($data);
     }
    
    
     
    
}

