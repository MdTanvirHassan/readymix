<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bulk_import extends Site_Controller {

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
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $this->menu = 'general_store';
        $this->sub_menu = 'item_information';
        $this->sub_inner_menu = 'item_information';
        $this->titlebackend("Bulk Import Rawmaterial Or Asset");
       
        $this->load->view('bulk_import/v_add_material_import',$data);
    }
    
    
    
     
    function materialOrAssetImport() {
        $test='test';
        if($_POST['submit']=='Export'){
            $this->exportAction();
        }else{
            if(isset($_FILES['material'])){
                $file = fopen($_FILES['material']['tmp_name'], "r");
                $i = 0;
                while (!feof($file)){
                    $i++;
                    $row = fgetcsv($file);
                    if($i >1){
                        if(empty($row[0])){
                            continue;
                        }
                        if(empty($row[1])){
                            continue;
                        }
                        if(empty($row[2])){
                            continue;
                        }
                        if(empty($row[3])){
                            continue;
                        }
                        if(empty($row[4])){
                            continue;
                        }
                        if(empty($row[5])){
                            continue;
                        }
//                        if(empty($row[6])){
//                            continue;
//                        }
                        
                        $material = array();
                        $material['item_name']=trim($row[0]);
                        $pre_item=$this->m_common->get_row_array('items',array('item_name'=>trim($row[0])),'*');
                        if(isset($pre_item[0]['item_name'])&& !empty($pre_item)){
                            continue;
                        }
                        
                        $material['item_type']=trim($row[1]);
                        $pre_group_info=$this->m_common->get_row_array('item_groups',array('item_group'=>trim($row[2])),'*');
                        if(empty($pre_group_info)){
                            $g_id=$this->m_common->insert_row('item_groups',array('item_group'=>trim($row[2]),'group_short_name'=>trim($row[3])));
                            $material['item_group']=$g_id;
                            
                            $item_last_code=$this->m_common->get_row_array('item_code',array('group_id'=>$g_id),'*','',1,'id','DESC');
                            if(!empty($item_last_code)){
                                $item_code=$item_last_code[0]['item_code']+1;
                                if($item_code>999){
                                    $item_sl_no=$item_code;
                                }else if($item_code>99){
                                    $item_sl_no="0".$item_code;
                                }else if($item_code>9){
                                    $item_sl_no="00".$item_code;
                                }else{
                                    $item_sl_no="000".$item_code;
                                }
                               
                            }else{
                                $item_code=1;
                                $item_sl_no='0001';
                            }
                            
                             $material['item_code']=trim($row[3]).$item_sl_no;
                             $this->m_common->insert_row('item_code',array('item_code'=>$item_code,'group_id'=>$g_id));
                            
                        }else{
                           $g_id=$pre_group_info[0]['id']; 
                           $material['item_group']=$pre_group_info[0]['id']; 
                           $item_last_code=$this->m_common->get_row_array('item_code',array('group_id'=>$g_id),'*','',1,'id','DESC');
                            if(!empty($item_last_code)){
                                $item_code=$item_last_code[0]['item_code']+1;
                                if($item_code>999){
                                    $item_sl_no=$item_code;
                                }else if($item_code>99){
                                    $item_sl_no="0".$item_code;
                                }else if($item_code>9){
                                    $item_sl_no="00".$item_code;
                                }else{
                                    $item_sl_no="000".$item_code;
                                }
                               
                            }else{
                                $item_code=1;
                                $item_sl_no='0001';
                            }
                            $material['item_code']=$pre_group_info[0]['group_short_name'].$item_sl_no;
                            $this->m_common->insert_row('item_code',array('item_code'=>$item_code,'group_id'=>$pre_group_info[0]['id']));
                        }
                        $pre_category_info=$this->m_common->get_row_array('item_category',array('c_name'=>trim($row[4]),'group_id'=>$g_id),'*');
                        if(empty($pre_category_info)){
                            $c_id=$this->m_common->insert_row('item_category',array('c_name'=>trim($row[4]),'group_id'=>$g_id));
                            $material['item_category']=$c_id;
                        }else{
                           $material['item_category']=$pre_category_info[0]['c_id']; 
                        }
                        
                       $pre_mu_info=$this->m_common->get_row_array('tbl_measurement_unit',array('meas_unit'=>trim($row[5])),'*');
                        if(empty($pre_mu_info)){
                            $mu_id=$this->m_common->insert_row('tbl_measurement_unit',array('meas_unit'=>trim($row[5]),'is_active'=>1));
                            $material['mu_id']=$mu_id;
                        }else{
                           $material['mu_id']=$pre_mu_info[0]['id']; 
                        } 
                        
//                        $pre_size_mu_info=$this->m_common->get_row_array('tbl_size_unit',array('unit_name'=>trim($row[6])),'*');
//                        if(empty($pre_size_mu_info)){
//                            $size_mu_id=$this->m_common->insert_row('tbl_size_unit',array('unit_name'=>trim($row[6]),'is_active'=>1));
//                            $material['size_unit_id']=$size_mu_id;
//                        }else{
//                           $material['size_unit_id']=$pre_size_mu_info[0]['size_unit_id']; 
//                        } 
                        
                        
                      
                        
                        $material['item_status']='Active';
                        $material['created']=date('Y-m-d');
                        $this->m_common->insert_row('items',$material);
                    }
                }
                redirect_with_msg('bulk_import/index', 'Successfully Imported ' . ($i - 2) . ' Material');
            } else {
                redirect_with_msg('bulk_import/index', 'Please Import csv file');
            }
        }
    }
    
     function subConJob() {
        $branch_id= $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $this->menu = 'general_store';
        $this->sub_menu = 'set_up';
        $this->sub_inner_menu = 'service_info';
        $this->titlebackend("Bulk Import Sub Contractor Job");
       
        $this->load->view('bulk_import/v_add_subcon_job_import',$data);
    }
    
     function subConJobImport() {
        $test='test';
        if($_POST['submit']=='Export'){
            $this->exportAction();
        }else{
            if(isset($_FILES['services'])){
                $file = fopen($_FILES['services']['tmp_name'], "r");
                $i = 0;
                while (!feof($file)){
                    $i++;
                    $row = fgetcsv($file);
                    if($i >1){
                        if(empty($row[0])){
                            continue;
                        }
                        if(empty($row[1])){
                            continue;
                        }
                        if(empty($row[2])){
                            continue;
                        }
                        if(empty($row[3])){
                            continue;
                        }
                        if(empty($row[4])){
                            continue;
                        }
                        if(empty($row[5])){
                            continue;
                        }
                       
                        
                        $material = array();
                        $material['service_name']=trim($row[0]);
                       
                        $pre_category_info=$this->m_common->get_row_array('tbl_service_category',array('category_name'=>trim($row[1])),'*');
                        if(empty($pre_category_info)){
                            $c_id=$this->m_common->insert_row('tbl_service_category',array('category_name'=>trim($row[1]),'short_name'=>trim($row[2])));
                            $material['category_id']=$c_id;
                            
                            $item_last_code=$this->m_common->get_row_array('tbl_service_code',array('category_id'=>$c_id),'*','',1,'id','DESC');
                            if(!empty($item_last_code)){
                                $item_code=$item_last_code[0]['service_code']+1;
                                if($item_code>999){
                                    $item_sl_no=$item_code;
                                }else if($item_code>99){
                                    $item_sl_no="0".$item_code;
                                }else if($item_code>9){
                                    $item_sl_no="00".$item_code;
                                }else{
                                    $item_sl_no="000".$item_code;
                                }
                               
                            }else{
                                $item_code=1;
                                $item_sl_no='0001';
                            }
                            
                             $material['service_id_no']=trim($row[2]).$item_sl_no;
                             $this->m_common->insert_row('tbl_service_code',array('service_code'=>$item_code,'category_id'=>$c_id));
                            
                        }else{
                           $c_id=$pre_category_info[0]['s_c_id']; 
                           $material['category_id']=$pre_category_info[0]['s_c_id']; 
                           $item_last_code=$this->m_common->get_row_array('tbl_service_code',array('category_id'=>$c_id),'*','',1,'id','DESC');
                            if(!empty($item_last_code)){
                                $item_code=$item_last_code[0]['service_code']+1;
                                if($item_code>999){
                                    $item_sl_no=$item_code;
                                }else if($item_code>99){
                                    $item_sl_no="0".$item_code;
                                }else if($item_code>9){
                                    $item_sl_no="00".$item_code;
                                }else{
                                    $item_sl_no="000".$item_code;
                                }
                               
                            }else{
                                $item_code=1;
                                $item_sl_no='0001';
                            }
                            $material['service_id_no']=$pre_category_info[0]['short_name'].$item_sl_no;
                            $this->m_common->insert_row('tbl_service_code',array('service_code'=>$item_code,'category_id'=>$pre_category_info[0]['s_c_id']));
                        }
                        $pre_group_info=$this->m_common->get_row_array('tbl_service_group',array('group_name'=>trim($row[3]),'category_id'=>$c_id),'*');
                        if(empty($pre_group_info)){
                            $g_id=$this->m_common->insert_row('tbl_service_group',array('group_name'=>trim($row[3]),'category_id'=>$c_id));
                            $material['group_id']=$g_id;
                        }else{
                           $material['group_id']=$pre_group_info[0]['id']; 
                        }
                        
                       $pre_mu_info=$this->m_common->get_row_array('tbl_measurement_unit',array('meas_unit'=>trim($row[4])),'*');
                        if(empty($pre_mu_info)){
                            $mu_id=$this->m_common->insert_row('tbl_measurement_unit',array('meas_unit'=>trim($row[4]),'is_active'=>1));
                            $material['mu_id']=$mu_id;
                        }else{
                           $material['mu_id']=$pre_mu_info[0]['id']; 
                        } 
                        
                        $pre_size_mu_info=$this->m_common->get_row_array('tbl_size_unit',array('unit_name'=>trim($row[5])),'*');
                        if(empty($pre_size_mu_info)){
                            $size_mu_id=$this->m_common->insert_row('tbl_size_unit',array('unit_name'=>trim($row[5]),'is_active'=>1));
                            $material['size_unit_id']=$size_mu_id;
                        }else{
                           $material['size_unit_id']=$pre_size_mu_info[0]['size_unit_id']; 
                        } 
                                      
                        $this->m_common->insert_row('tbl_services',$material);
                    }
                }
                redirect_with_msg('services', 'Successfully Imported ' . ($i - 2) . ' Material');
            } else {
                redirect_with_msg('bulk_import/subConJob', 'Please Import csv file');
            }
        }
    }
    
    
     function supplierOrContractor() {
        $branch_id= $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $this->menu = 'general_store';
        $this->sub_menu = 'supplier_information';
        $this->sub_inner_menu = 'supplier_information';
        $this->titlebackend("Bulk Import Supplier Or Contractor");
       
        $this->load->view('bulk_import/v_add_supplier_import',$data);
    }
    
    function supplierOrContractortImport() {
        $test='test';
        if($_POST['submit']=='Export'){
            $this->exportAction();
        }else{
            if(isset($_FILES['supplier'])){
                $file = fopen($_FILES['supplier']['tmp_name'], "r");
                $i = 0;
                while (!feof($file)){
                    $i++;
                    $row = fgetcsv($file);
                    if($i >1){
                        if(empty($row[0])){
                            continue;
                        }
                        if(empty($row[1])){
                            continue;
                        }
                       
                        
                        $material = array();
                        $material['SUP_NAME']=trim($row[0]);
                        $material['s_type']=trim($row[1]);
                        $material['key_person']=trim($row[2]);
                        $material['NAME']=trim($row[3]);
                        $material['MOBILE']=trim($row[4]);
                        $material['job']=trim($row[5]);
                       
                            
                            $item_last_code=$this->m_common->get_row_array('supplier_code',array('sp_or_sc'=>trim($row[1])),'*','',1,'id','DESC');
                            if(!empty($item_last_code)){
                                $item_code=$item_last_code[0]['supplier_code']+1;
                                if($item_code>999){
                                    $item_sl_no=$item_code;
                                }else if($item_code>99){
                                    $item_sl_no="0".$item_code;
                                }else if($item_code>9){
                                    $item_sl_no="00".$item_code;
                                }else{
                                    $item_sl_no="000".$item_code;
                                }
                               
                            }else{
                                $item_code=1;
                                $item_sl_no='0001';
                            }
                            
                            if(trim($row[1])=="Supplier"){
                                $material['CODE']='SP'.$item_sl_no;
                            }else{
                                $material['CODE']='SC'.$item_sl_no;
                            }
                             $this->m_common->insert_row('supplier_code',array('supplier_code'=>$item_code,'sp_or_sc'=>trim($row[1])));                
                        $material['CREATED']=date('Y-m-d');
                        $this->m_common->insert_row('supplier',$material);
                    }
                }
                redirect_with_msg('general_store', 'Successfully Imported ' . ($i - 2) . ' Supplier Or Contractor');
            } else {
                redirect_with_msg('bulk_import/index', 'Please Import csv file');
            }
        }
    }
    
    
    function project() {
        $branch_id= $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $this->menu = 'general_store';
        $this->sub_menu = 'supplier_information';
        $this->sub_inner_menu = 'department';
        $this->titlebackend("Bulk Import Project");
       
        $this->load->view('bulk_import/v_add_project_import',$data);
    }
     
    function projectImport() {
        $test='test';
        if($_POST['submit']=='Export'){
            $this->exportAction();
        }else{
            if(isset($_FILES['project'])){
                $file = fopen($_FILES['project']['tmp_name'], "r");
                $i = 0;
                while (!feof($file)){
                    $i++;
                    $row = fgetcsv($file);
                    if($i >1){
                        if(empty($row[0])){
                            continue;
                        }
                        if(empty($row[1])){
                            continue;
                        }
                       
                        
                        $material = array();
                        $dep_last_code=array();
                        $material['dep_description']=trim($row[0]);
                        $material['short_name']=trim($row[1]);
                        $material['project_type']=trim($row[2]);
                        $material['district_or_division']=trim($row[3]);
                        $material['project_authority']=trim($row[4]);
                        $material['name_of_pd']=trim($row[5]);
                        $material['address']=trim($row[6]);
                        $material['project_manager']=trim($row[7]);
                        $material['mobile_no']=trim($row[8]);
                        $material['remarks']=trim($row[9]);
                        $material['created'] = date('Y-m-d');
                                                  
                        $dep_last_code=$this->m_common->get_row_array('department_code','','*','',1,'id','DESC');
                        if(!empty($dep_last_code)){

                            $dep_code=$dep_last_code[0]['dep_code']+1;
                            if($dep_code>999){
                                $dep_sl_no=$dep_code;
                            }else if($dep_code>99){
                                $dep_sl_no="0".$dep_code;
                            }else if($dep_code>9){
                                $dep_sl_no="00".$dep_code;
                            }else{
                                $dep_sl_no="000".$dep_code;
                            }
                        }else{
                            $dep_code=1;
                            $dep_sl_no='0001';
                        }
                        $material['dep_code']=trim($row[1]).$dep_sl_no;
                        $this->m_common->insert_row('department_code',array('dep_code'=>$dep_code));                
                      
                        $this->m_common->insert_row('department',$material);
                    }
                }
                redirect_with_msg('general_store/department', 'Successfully Imported ' . ($i - 2) . ' Supplier Or Contractor');
            } else {
                redirect_with_msg('bulk_import/project', 'Please Import csv file');
            }
        }
    } 
    
     
}





