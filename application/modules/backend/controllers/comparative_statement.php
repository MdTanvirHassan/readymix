<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comparative_statement extends Site_Controller {

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
        $branch_id=$this->session->userdata('companyId');
        $this->menu ='general_store';
        $this->sub_menu ='procurement';
        $this->sub_inner_menu ='comparative_statement';
        $this->titlebackend("Comparative Statement");  
        
        $sql="select tcs.*,i.item_name,tpm.mode_name from tbl_comparative_statement tcs left join items i on tcs.item_id=i.id left join tbl_payment_mode tpm on tcs.payment_mode=tpm.id  where tcs.is_active=1 order by tcs.id DESC";
        $data['comparative_statements']=$this->m_common->customeQuery($sql);
        $this->load->view('comparative_statement/v_comparative_statement',$data);
    }

   
     function add_comparative_statement() {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'comparative_statement';
        $this->titlebackend("Add Comparative Statement");
        
       
        $data['suppliers']=$this->m_common->get_row_array('supplier',array('s_type'=>"Supplier"),'*');
        $data['items']=$this->m_common->get_row_array('items','','*');
        $data['payment_modes']=$this->m_common->get_row_array('tbl_payment_mode',array('is_active'=>1),'*');
       
        $this->load->view('comparative_statement/v_add_comparative_statement',$data);
    }
     function add_comparative_statement_action(){
        $branch_id= $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' =>$user_id), '*');
        
        $postData=$this->input->post();
        if(!empty($postData)){
             $insertData=array();
                      
             if(!empty($postData['date'])){
                $insertData['date'] =date('Y-m-d',strtotime($postData['date'])); 
             }
            
             if(!empty($postData['payment_mode'])){
                $insertData['payment_mode']=$postData['payment_mode'];
             }
             
             
             if(!empty($postData['item_id'])){
                $insertData['item_id']=$postData['item_id'];
             }
             
             
             $insertData['branch_id']=$branch_id;   
             $insertData['created_by']=$employee_id; 
             $insertData['is_active']=1;
             
             $insertData['create_date']=date('Y-m-d');  
             $id = $this->m_common->insert_row('tbl_comparative_statement', $insertData);
             if(!empty($id)){
                 
                 foreach ($postData['supplier_id'] as $key =>$each){
                  
                     
                    
                                $insertData1=array();
                                
                                $insertData1['cs_id'] = $id; 
                                
                                
                                if (!empty($postData['rate'][$key])) {
                                    $insertData1['rate'] = $postData['rate'][$key];
                                }
                                
                                if (!empty($postData['remark'][$key])){
                                    $insertData1['remark'] = $postData['remark'][$key];
                                }
                                
                                                                
                                if(!empty($postData['supplier_id'][$key])){
                                    $insertData1['supplier_id'] = $postData['supplier_id'][$key];                                  
                                }
                                
                                                
                               $b=$this->m_common->insert_row('tbl_comparative_statement_details', $insertData1); 
                               
                              
                     
                     
                 }
                 
                
                 
                  redirect_with_msg('comparative_statement', 'Successfully Added Comparative Statement');
             }else{
                  redirect_with_msg('comparative_statement/add_comparative_statement', 'Data not saved for an unexpected error');
             }
           
         }else{
              redirect_with_msg('comparative_statement/add_comparative_statement', 'Please fill the form and submit');
         }
         
     }
    
      function edit_comparative_statement($id) {
        $branch_id= $this->session->userdata('companyId');   
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'comparative_statement';
        $this->titlebackend("Edit Comparative Statement");    
        $data['items']=$this->m_common->get_row_array('items','','*');
        $data['comparative_statement_info']=$this->m_common->get_row_array('tbl_comparative_statement',array('id'=>$id),'*');
      
        $sql='select csd.*,s.SUP_NAME from tbl_comparative_statement_details csd  left join supplier s on csd.supplier_id=s.ID  where csd.cs_id='.$id;
        $data['comparative_statement_details']=$this->m_common->customeQuery($sql);
        $data['suppliers']=$this->m_common->get_row_array('supplier',array('s_type'=>"Supplier"),'*');
        $data['payment_modes']=$this->m_common->get_row_array('tbl_payment_mode',array('is_active'=>1),'*');
        $this->load->view('comparative_statement/v_edit_comparative_statement',$data);
    }
    
    function edit_comparative_statement_action($cs_id){
        
        $branch_id=$this->session->userdata('companyId');
        $employee_id=$this->session->userdata('employeeId');
        $user_type=$this->session->userdata('user_type');
        $user_id=$this->session->userdata('user_id');
        $userData=$this->m_common->get_row_array('users', array('id' =>$user_id), '*');
        
        
        $postData=$this->input->post();
         
        if(!empty($postData)){
            $pre_info=$this->m_common->get_row_array('tbl_comparative_statement',array('id'=>$cs_id),'*');
            $insertData=array();
            
             
            if(!empty($postData['date'])){
                $insertData['date'] =date('Y-m-d',strtotime($postData['date'])); 
            }
            
            if(!empty($postData['payment_mode'])){
                $insertData['payment_mode']=$postData['payment_mode'];
            }
             
             
            if(!empty($postData['item_id'])){
                $insertData['item_id']=$postData['item_id'];
            }
                             
            $insertData['updated_by']=$employee_id;              
            $insertData['update_date']=date('Y-m-d');         
            $u_id = $this->m_common->update_row('tbl_comparative_statement',array('id'=>$cs_id),$insertData);
            if($u_id>=0){
                $delete_details=$this->m_common->delete_row('tbl_comparative_statement_details',array('cs_id'=>$cs_id));
                foreach ($postData['supplier_id'] as $key => $each) {
                                  
                    $insertData1=array();
                    
                    $insertData1['cs_id'] =$cs_id;      
                    
                    if (!empty($postData['rate'][$key])) {
                         $insertData1['rate'] = $postData['rate'][$key];
                    }

                    if(!empty($postData['remark'][$key])){
                         $insertData1['remark'] = $postData['remark'][$key];
                    }


                    if(!empty($postData['supplier_id'][$key])){
                         $insertData1['supplier_id'] = $postData['supplier_id'][$key];                                  
                    }


                    $b=$this->m_common->insert_row('tbl_comparative_statement_details', $insertData1); 
                              
                    
                     
                 }
                redirect_with_msg('comparative_statement/details_comparative_statement/'.$cs_id, 'Updated Successfully'); 
            }
            
         }else{
              redirect_with_msg('comparative_statement/add_comparative_statement', 'Please fill the form and submit');
         }
         
     }
    function details_comparative_statement($id,$print=false) {
        $branch_id= $this->session->userdata('companyId');   
        $this->menu='general_store';
        $this->sub_menu='procurement';
        $this->sub_inner_menu='comparative_statement';
        $this->titlebackend("Edit Comparative Statement");      
        $data['items']=$this->m_common->get_row_array('items','','*');
        $data['suppliers']=$this->m_common->get_row_array('supplier',array('s_type'=>"Supplier"),'*');
        
        $data['payment_modes']=$this->m_common->get_row_array('tbl_payment_mode',array('is_active'=>1),'*');
        
        $sql="select tcs.*,i.item_name,d.dep_description,tmu.meas_unit from tbl_comparative_statement tcs left join department d on tcs.branch_id=d.d_id left join items i on tcs.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where tcs.id=".$id;
        $data['comparative_statement_info']=$this->m_common->customeQuery($sql);
     
        $sql='select csd.*,s.SUP_NAME from tbl_comparative_statement_details csd  left join supplier s on csd.supplier_id=s.ID  where csd.cs_id='.$id;
        $data['comparative_statement_details']=$this->m_common->customeQuery($sql);
        
        if($print==false){
            $this->load->view('comparative_statement/v_details_comparative_statement',$data);
        }else{
            $html=$this->load->view('comparative_statement/print_comparative_statement',$data,true);
            echo $html;
            exit; 
        }
        
    }
   
   function delete_comparative_statement($id){
        if(!empty($id)){            
            $result=$this->m_common->update_row('tbl_comparative_statement',array('id'=>$id),array('is_active'=>0));
            if(!empty($result)){                
                redirect_with_msg('comparative_statement/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('comparative_statement/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('comparative_statement/index', 'Please click on delete button');
        }
    }
     
   
    
   

}




