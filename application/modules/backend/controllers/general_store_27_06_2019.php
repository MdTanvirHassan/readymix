<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class General_store extends Site_Controller {

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
        $this->menu = 'general_store';
        //$this->sub_menu = 'supplier_information';
        $this->sub_inner_menu = 'supplier_information';
        $this->titlebackend("Supplier Information");
        $data['suppliers'] = $this->m_common->get_row_array('supplier', '', '*');
        $this->load->view('general_store/v_supplier', $data);
    }

    function add_supplier() {
        $this->menu = 'general_store';
        $this->sub_menu = 'supplier_information';
        $this->titlebackend("Supplier Information");
        //$data['supplier_code']=$this->getRendVerCode(4);
        $supplier_last_code=$this->m_common->get_row_array('supplier_code','','*','',1,'id','DESC');
        if(!empty($supplier_last_code)){
           
            $supplier_code=$supplier_last_code[0]['supplier_code']+1;
            if($supplier_code>999){
                $supplier_sl_no=$supplier_code;
            }else if($supplier_code>99){
                $supplier_sl_no="0".$supplier_code;
            }else if($supplier_code>9){
                $supplier_sl_no="00".$supplier_code;
            }else{
                $supplier_sl_no="000".$supplier_code;
            }
        }else{
            $supplier_code=1;
            $supplier_sl_no='0001';
        }
        $data['supplier_code']=$supplier_code;
        $data['supplier_auto_code']=$supplier_sl_no;
        $this->load->view('general_store/v_supplier_info',$data);
    }

    function edit_supplier($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'supplier_information';
        $this->titlebackend("Supplier Information");
        $data['supplier'] = $this->m_common->get_row_array('supplier', array('ID' => $id), '*');
        $this->load->view('general_store/edit_supplier_info', $data);
    }

    function add_supplier_action() {
        $data = $this->input->post();
        $supplier_code= $this->input->post('supplier_code');
        if (!empty($data)) {
            unset($data['supplier_code']);
            $data['CREATED'] = date('Y-m-d');
            $id = $this->m_common->insert_row('supplier', $data);
            if (!empty($id)) {
                $this->m_common->insert_row('supplier_code', array('supplier_code'=>$supplier_code));
                redirect_with_msg('general_store/add_supplier', 'Successfully Added this supplier');
            } else {
                redirect_with_msg('general_store/add_supplier', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_supplier', 'Please fill the form and submit');
        }
    }

    function edit_supplier_action($id) {
        $data = $this->input->post();
        if (!empty($data)) {
            $id = $this->m_common->update_row('supplier', array('ID' => $id), $data);
            if (!empty($id)) {
                redirect_with_msg('general_store/index', 'Successfully Updated this supplier');
            } else {
                redirect_with_msg('general_store/add_supplier', 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_supplier', 'Please fill the form and submit');
        }
    }

    function delete_supplier($id) {
        if (!empty($id)) {
            $data['CREATED'] = date('Y-m-d');
            $id = $this->m_common->delete_row('supplier', array('ID' => $id));
            if (!empty($id)) {
                redirect_with_msg('general_store/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/index', 'Please click on delete button');
        }
    }

    function article_information() {
        $this->menu = 'general_store';
        $this->sub_menu = 'article_information';
        $this->titlebackend("Article Information");

        $this->load->view('general_store/v_article_info');
    }
    
    //Start Item Information
    
     function item_information() {
        $this->menu = 'general_store';
      //  $this->sub_menu = 'item_information';
        $this->sub_menu = 'set_up';
        $this->sub_inner_menu = 'item_information';
        $this->titlebackend("Item Information");
        $data['items'] = $this->m_common->get_row_array('v_items', '', '*');
        $this->load->view('general_store/v_item',$data);
    }
    
    function add_item_information() {
        $this->menu = 'general_store';
        $this->sub_menu = 'item_information';
        $this->titlebackend("Item Information");
     //   $data['item_groups'] = $this->m_common->get_row_array('item_groups','', '*');
        $data['item_groups'] = $this->m_common->get_row_array('item_groups',array('group_type'=>"Consumable"), '*');
        $data['categories'] = $this->m_common->get_row_array('item_category',array('c_type'=>"Consumable"), '*');
      //  $data['item_code'] =$this->getRendVerCode(4);
        $item_last_code=$this->m_common->get_row_array('item_code','','*','',1,'id','DESC');
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
        $data['item_code']=$item_code;
        $data['item_auto_code']=$item_sl_no;
       
        $this->load->view('general_store/v_add_item',$data);
    }
    
    function add_action_item_information() {
        $this->menu = 'general_store';
        $this->sub_menu = 'item_information';
        $this->titlebackend("Item Information");
        $data = $this->input->post();
        $item_code=$this->input->post('item_c');
        $group_id=$this->input->post('item_group');
        $item_name=$this->input->post('item_name');
        $item_type=$this->input->post('item_type');
        $brand=$this->input->post('brand');
        $origin=$this->input->post('origin');
        $parts_no=$this->input->post('port_no');
        $exist_info=$this->m_common->get_row_array('items',array('item_group'=>$group_id,'item_type'=>$item_type,'item_name'=>$item_name,'brand'=>$brand,'origin'=>$origin,'port_no'=>$parts_no),'*');
        if(!empty($exist_info)){
            redirect_with_msg('general_store/add_item_information', 'This item already exists.');
        }
        if (!empty($data)) {
            $data['stock_amount'] = $this->input->post('opening_stock');
            $data['created'] = date('Y-m-d');
            $data['purchase_date'] = date('Y-m-d',strtotime($this->input->post('purchase_date')));
            unset($data['item_c']);
           
            $id = $this->m_common->insert_row('items', $data);
            if (!empty($id)) {
                $this->m_common->insert_row('item_code', array('item_code'=>$item_code,'group_id'=>$group_id));
                redirect_with_msg('general_store/add_item_information', 'Successfully Added this Item');
            } else {
                redirect_with_msg('general_store/add_item_information', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_item_information', 'Please fill the form and submit');
        }
        
    }
    
    function edit_item_information($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'item_information';
        $this->titlebackend("Edit Item Information");
       // $data['item_groups'] = $this->m_common->get_row_array('item_groups', '', '*');
        
        $data['item'] = $this->m_common->get_row_array('items',array('id'=>$id), '*');
        $data['item_groups'] = $this->m_common->get_row_array('item_groups',array('group_type'=>$data['item'][0]['item_type']), '*');
        $data['categories'] = $this->m_common->get_row_array('item_category',array('c_type'=>$data['item'][0]['item_type']), '*');
        $this->load->view('general_store/v_edit_item',$data);
    }
    
     function details_item_information($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'item_information';
        $this->titlebackend("Details Item Information");
       // $data['item_groups'] = $this->m_common->get_row_array('item_groups', '', '*');
        $data['item'] = $this->m_common->get_row_array('items',array('id'=>$id), '*');
        $data['item_groups'] = $this->m_common->get_row_array('item_groups',array('group_type'=>$data['item'][0]['item_type']), '*');
        $data['categories'] = $this->m_common->get_row_array('item_category',array('c_type'=>$data['item'][0]['item_type']), '*');
        $this->load->view('general_store/v_details_item',$data);
    }
    
    function edit_action_item_information($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'item_information';
        $this->titlebackend("Edit Item Information");
           $data = $this->input->post();
        if (!empty($data)) {
            $group_id=$this->input->post('item_group');
            $item_name=$this->input->post('item_name');
            $item_type=$this->input->post('item_type');
            $brand=$this->input->post('brand');
            $origin=$this->input->post('origin');
            $parts_no=$this->input->post('port_no');
//            $exist_info=$this->m_common->get_row_array('items',array('item_group'=>$group_id,'item_type'=>$item_type,'item_name'=>$item_name,'brand'=>$brand,'origin'=>$origin,'port_no'=>$parts_no),'*');
//            if(!empty($exist_info)){
//                redirect_with_msg('general_store/edit_item_information/'.$id, 'This item already exists.');
//            }
           // $data['stock_amount'] = $this->input->post('opening_value');
            $pre_info = $this->m_common->get_row_array('items',array('id'=>$id), '*');
            $opeining_value=$this->input->post('opening_stock');
            $data['stock_amount'] =$pre_info[0]['stock_amount']+$opeining_value;
            $data['purchase_date'] = date('Y-m-d',strtotime($this->input->post('purchase_date')));
            $ids = $this->m_common->update_row('items', array('id' => $id), $data);
            if (!empty($ids)) {
                redirect_with_msg('general_store/details_item_information/'.$id, 'Successfully Updated this item group');
            } else {
                redirect_with_msg('general_store/edit_item_information/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/edit_item_information/'.$id, 'Please fill the form and submit');
        }
    }
    
    function delete_item_information($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'item_information';
        $this->titlebackend("Item Information");
         if (!empty($id)) {  
            $id = $this->m_common->delete_row('items', array('id' => $id));
            if (!empty($id)) {
                redirect_with_msg('general_store/item_information', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/item_information', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/item_information', 'Please click on delete button');
        }
    }
    
 //End Item Information   
    
// Start  Department or Project
    
    function department() {
        $this->menu = 'general_store';
       // $this->sub_menu = 'department';
         $this->sub_inner_menu = 'department';
        $this->titlebackend("Department");
        $data['departments'] = $this->m_common->get_row_array('department', '', '*');
        $this->load->view('general_store/v_department',$data);
    }
    
    function add_department() {
        $this->menu = 'general_store';
         $this->sub_inner_menu = 'department';
      //  $this->sub_menu = 'department';
        $this->titlebackend("Add Department");
       // $data['dep_code']=$this->getRendVerCode(4);
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
        $data['dep_code']=$dep_code;
        $data['dep_auto_code']=$dep_sl_no;
       
        $this->load->view('general_store/v_add_department',$data);
    }
    
    function add_action_department() {
        $this->menu = 'general_store';
        $this->sub_menu = 'department';
        $this->titlebackend("Add Department");
        $data = $this->input->post();
        $dep_c=$this->input->post('dep_c');
        if (!empty($data)) {
            $data['created'] = date('Y-m-d');
            unset($data['dep_c']);
            $id = $this->m_common->insert_row('department', $data);
            if (!empty($id)) {
                $this->m_common->insert_row('department_code', array('dep_code'=>$dep_c));
                redirect_with_msg('general_store/add_department', 'Successfully Added this Department');
            } else {
                redirect_with_msg('general_store/add_department', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_department', 'Please fill the form and submit');
        }
        
    }
    
    function edit_department($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'department';
        $this->titlebackend("Edit Department");
       
        $data['department'] = $this->m_common->get_row_array('department',array('d_id'=>$id), '*');
        $this->load->view('general_store/v_edit_department',$data);
    }
    
     function details_department($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'department';
        $this->titlebackend("Details Department");
      
        $data['department'] = $this->m_common->get_row_array('department',array('d_id'=>$id), '*');
        $this->load->view('general_store/v_details_department',$data);
    }
    
    function edit_action_department($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'department';
        $this->titlebackend("Edit Department");
           $data = $this->input->post();
        if (!empty($data)) {
            $ids = $this->m_common->update_row('department', array('d_id' => $id), $data);
            if (!empty($ids)) {
                redirect_with_msg('general_store/department', 'Successfully Updated this item group');
            } else {
                redirect_with_msg('general_store/edit_department/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/edit_department/'.$id, 'Please fill the form and submit');
        }
    }
    
    function delete_department($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'department';
        $this->titlebackend("Department");
         if (!empty($id)) {  
            $id = $this->m_common->delete_row('department', array('d_id' => $id));
            if (!empty($id)) {
                redirect_with_msg('general_store/department', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/department', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/department', 'Please click on delete button');
        }
    }
    
    
// End  Department or Project    
    
// Start  Designation 
    
    function designation() {
        $this->menu = 'general_store';
       // $this->sub_menu = 'department';
         $this->sub_inner_menu = 'designation';
        $this->titlebackend("Designation");
        $data['designations'] = $this->m_common->get_row_array('designation', '', '*');
        $this->load->view('general_store/v_designation',$data);
    }
    
    function add_designation() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'designation';
      //  $this->sub_menu = 'department';
        $this->titlebackend("Add Designation");
       
        $this->load->view('general_store/v_add_designation');
    }
    
    function add_action_designation() {
        $this->menu = 'general_store';
        $this->sub_menu = 'designation';
        $this->titlebackend("Add Designation");
        $data = $this->input->post();  
        if (!empty($data)) {    
            $id = $this->m_common->insert_row('designation', $data);
            if (!empty($id)) {    
                redirect_with_msg('general_store/add_designation', 'Successfully Added this Department');
            } else {
                redirect_with_msg('general_store/add_designation', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_designation', 'Please fill the form and submit');
        }
        
    }
    
    function edit_designation($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'designation';
        $this->titlebackend("Edit Designation");
       
        $data['designation'] = $this->m_common->get_row_array('designation',array('id'=>$id), '*');
        $this->load->view('general_store/v_edit_designation',$data);
    }
    
     function details_designation($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'designation';
        $this->titlebackend("Details Designation");
        $data['department'] = $this->m_common->get_row_array('designation',array('id'=>$id), '*');
        $this->load->view('general_store/v_details_designation',$data);
    }
    
    function edit_action_designation($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'designation';
        $this->titlebackend("Edit Designation");
        $data = $this->input->post();
        if (!empty($data)) {
            $ids = $this->m_common->update_row('designation', array('id' => $id), $data);
            if (!empty($ids)) {
                redirect_with_msg('general_store/designation', 'Successfully Updated this item group');
            } else {
                redirect_with_msg('general_store/edit_designation/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/edit_designation/'.$id, 'Please fill the form and submit');
        }
    }
    
    function delete_designation($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'designation';
        $this->titlebackend("Designation");
         if (!empty($id)) {  
            $id = $this->m_common->delete_row('designation', array('id' => $id));
            if (!empty($id)) {
                redirect_with_msg('general_store/designation', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/designation', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/designation', 'Please click on delete button');
        }
    }
    
    
// End Designation
    
// Start Empoloyee
    
    function employee() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'employee';
        $this->titlebackend("Users");
        $data['employees'] = $this->m_common->get_row_array('v_employees', '', '*');
        $this->load->view('general_store/v_employee',$data);
    }
    
    function add_employee() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'employee';
        $this->titlebackend("Add User");   
        $data['projects'] = $this->m_common->get_row_array('department', '', '*');  
        $data['designations'] = $this->m_common->get_row_array('designation', '', '*');  
        $this->load->view('general_store/v_add_employee',$data);
    }
    
    function add_action_employee() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'employee';
        $this->titlebackend("Add User");
        $data = $this->input->post();  
        if (!empty($data)) {    
            $id = $this->m_common->insert_row('employees', $data);
            if (!empty($id)) {    
                redirect_with_msg('general_store/employee', 'Successfully Inserted');
            } else {
                redirect_with_msg('general_store/add_employee', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_employee', 'Please fill the form and submit');
        }
        
    }
    
    function edit_employee($id) {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'employee';
        $this->titlebackend("Edit User");
        $data['projects'] = $this->m_common->get_row_array('department', '', '*');  
        $data['designations'] = $this->m_common->get_row_array('designation', '', '*');  
        $data['employee'] = $this->m_common->get_row_array('employees',array('id'=>$id), '*');
        $this->load->view('general_store/v_edit_employee',$data);
    }
    
     function details_employee($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'employee';
        $this->titlebackend("Details User");
        $data['employee'] = $this->m_common->get_row_array('employees',array('id'=>$id), '*');
        $this->load->view('general_store/v_details_employee',$data);
    }
    
    function edit_action_employee($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'employee';
        $this->titlebackend("Edit Employee");
        $data = $this->input->post();
        if (!empty($data)) {
            $ids = $this->m_common->update_row('employees', array('id' => $id), $data);
            if (!empty($ids)) {
                redirect_with_msg('general_store/employee', 'Successfully Updated');
            } else {
                redirect_with_msg('general_store/edit_employee/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/edit_employee/'.$id, 'Please fill the form and submit');
        }
    }
    
    function delete_employee($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'employee';
        $this->titlebackend("Employees");
         if (!empty($id)) {  
            $id = $this->m_common->delete_row('employees', array('id' => $id));
            if (!empty($id)) {
                redirect_with_msg('general_store/employee', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/employee', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/employee', 'Please click on delete button');
        }
    }
    
    
// End  Employee  
    
// Start Acl
    
    function acl() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'acl';
        $this->titlebackend("Acl");
        $data['users'] = $this->m_common->get_row_array('v_users', '', '*');
        $this->load->view('general_store/v_acl',$data);
    }
    
    function add_acl() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'acl';
      //  $this->sub_menu = 'department';
        $this->titlebackend("Add Acl");   
        $data['allemployees'] = $this->m_common->get_row_array('v_employees', '', '*');
        $menu = $this->m_common->get_row_array('acl_root_item', '', '*');
        $data['access_type'] = $this->m_common->get_row_array('acl_access_type', '', '*');
        $menuData = array();
        foreach ($menu as $key => $me) {
            $menuData[$key]['value'] = $me;
            $menuData[$key]['subMenu'] = $this->m_common->get_row_array('acl_item_list', array('root_id' => $me['id']), '*');
        }
        $data['menu'] = $menuData;
        $this->load->view('general_store/v_add_acl',$data);
    }
    
    function add_acl_insert() {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'user';
        $this->titlebackend("Add User");
        $data = $this->input->post();  
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            $insertData['employeeId'] = $this->input->post('employeeId');
            $company = $this->m_common->get_row_array('employees', array('id' =>$insertData['employeeId']), 'companyId');
          //  $insertData['email'] = $this->input->post('email');
            $insertData['username'] = $this->input->post('username');
           // $insertData['password'] = $this->pw_encrypt_password($this->input->post('password'));
            $insertData['password'] = md5($this->input->post('password'));
            $insertData['user_type'] = $this->input->post('userType');
            
            $insertData['status'] = 1;
            $insertData['company'] = $company[0]['companyId'];
            $insertData['userRole'] = serialize($postData['role']);
            $insertData['userMenu'] = serialize($postData['menu']);
            if ($this->m_common->insert_row('users', $insertData)) {
                redirect_with_msg('general_store/acl', 'Successfully Inserted');
            } else {
                redirect_with_msg('general_store/add_acl', 'Not Inserted');
            }
        } else {
            redirect_with_msg('general_store/add_acl', 'Please Submit the form');
        }
        
    }
    
    function edit_acl($id) {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'acl';
        $this->titlebackend("Edit Acl");
       
        $$data = array();
        $data['user'] = $this->m_common->get_row_array('v_users', array('id' => $id), '*');
        $data['allemployees'] = $this->m_common->get_row_array('v_employees', '', '*');
        $menu = $this->m_common->get_row_array('acl_root_item', '', '*');
        $data['access_type'] = $this->m_common->get_row_array('acl_access_type', '', '*');
        $menuData = array();
        foreach ($menu as $key => $me) {
            $menuData[$key]['value'] = $me;
            $menuData[$key]['subMenu'] = $this->m_common->get_row_array('acl_item_list', array('root_id' => $me['id']), '*');
        }
        $data['menu'] = $menuData;
        $data['id'] = $id;
        $this->load->view('general_store/v_edit_acl', $data);
    }
    
     function details_aclr($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'acl';
        $this->titlebackend("Details User");
        $data['user'] = $this->m_common->get_row_array('users',array('id'=>$id), '*');
        $this->load->view('general_store/v_details_user',$data);
    }
    
    function edit_action_acl($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'acl';
        $this->titlebackend("Edit Acl");
        $postData = $this->input->post();
        if (!empty($postData)) {
            $updateData = array();
            $updateData['employeeId'] = $this->input->post('employeeId');
            $company = $this->m_common->get_row_array('employees', array('id' => $updateData['employeeId']), 'companyId');
           // $updateData['email'] = $this->input->post('email');
            $updateData['username'] = $this->input->post('username');   
            $updateData['status'] = 1;
            $updateData['company'] = $company[0]['companyId'];
            $updateData['userRole'] = serialize($postData['role']);
            $updateData['userMenu'] = serialize($postData['menu']);
            if ($this->m_common->update_row('users', array('id' => $id), $updateData)) {
                redirect_with_msg('general_store/acl', 'User Edited Successfully');
            } else {
                redirect_with_msg('general_store/edit_acl/' . $id, 'User can not edited');
            }
        } else {
            redirect_with_msg('general_store/add_acl', 'Please Submit the form');
        }
    }
    
    function delete_acl($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'user';
        $this->titlebackend("Users");
         if (!empty($id)) {  
            $id = $this->m_common->delete_row('users', array('id' => $id));
            if (!empty($id)) {
                redirect_with_msg('general_store/acl', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/acl', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/acl', 'Please click on delete button');
        }
    }
    
    
     function pw_encrypt_password($plain) {
        $password = '';
        for ($i = 0; $i < 10; $i++) {
            $password .= rand();
        }
        $salt = substr(md5($password), 0, 2);
        $password = md5($salt . $plain) . ':' . $salt;
        return $password;
    }
    
// End  Acl         
    
 
    
    
    
    
    
 //Start Asset Movement
    
    function asset_requisition(){
        $this->menu = 'general_store';
        $this->sub_menu = 'asset';
        $this->sub_inner_menu = 'asset_requisition';
        $this->titlebackend("Asset Requisition");
        $sql="select * from v_asset_requisition where status='pending' or status='partial_issued' ";
        $data['asset_requisitions']=$this->m_common->customeQuery($sql);
        $this->load->view('general_store/v_asset_requisition',$data);
    }
    
    
    function add_asset_requisition(){
        $this->menu = 'general_store';
        $this->sub_menu = 'asset';
        $this->sub_inner_menu = 'asset_requisition';
        $this->titlebackend("Add Asset Requisition");
        $data['departments'] = $this->m_common->get_row_array('department', '', '*');
        $data['items'] = $this->m_common->get_row_array('items',array('item_type'=>"Asset"), '*');
        $data['suppliers'] = $this->m_common->get_row_array('supplier', '', '*');
        $data['assets'] = $this->m_common->get_row_array('items',array('item_type'=>"Asset"), '*');
        $data['cost_centers'] = $this->m_common->get_row_array('cost_center','', '*');
        $requisition_last_code=$this->m_common->get_row_array('asset_requisition_code','','*','',1,'id','DESC');
        if(!empty($requisition_last_code)){
           
            $requisition_code=$requisition_last_code[0]['requisition_code']+1;
            if($requisition_code>999){
                $requisition_sl_no=$requisition_code;
            }else if($requisition_code>99){
                $requisition_sl_no="0".$requisition_code;
            }else if($requisition_code>9){
                $requisition_sl_no="00".$requisition_code;
            }else{
                $requisition_sl_no="000".$requisition_code;
            }
        }else{
            $requisition_code=1;
            $requisition_sl_no='0001';
        }
        $data['requisition_number']=$requisition_code;
        $data['requisition_auto_number']=$requisition_sl_no;
        $this->load->view('general_store/v_add_asset_requisition',$data);
    }
    
    
    
    function add_action_asset_requisition() {
        $this->menu = 'general_store';
        $this->sub_menu = 'asset';
        $this->sub_inner_menu = 'asset_requisition';
        $this->titlebackend("Add Asset Requisition");
        $postData = $this->input->post();
        $requisition_code=$this->input->post('requisition_code');
        if (!empty($postData)) {
            $insertData = array();
          //  $insertData['created'] = date('Y-m-d');
            if(!empty($postData['requisition_no'])){
                $insertData['requisition_no'] = $postData['requisition_no'];
                $requisition_no=$postData['requisition_no'];
            }
            
          
            if(!empty($postData['date'])){
                $insertData['requisition_date'] =date('Y-m-d',strtotime($postData['date'])); 
                $indent_date=date('Y-m-d',strtotime($postData['date'])); 
            }
             if(!empty($postData['department_id'])){
                $insertData['department_id'] = $postData['department_id'];
                $depart_ment=$postData['department_id'];
            }
           
            
            if(!empty($postData['remarks'])){
                $insertData['remarks'] = $postData['remarks']; 
            }
            
           $insertData['status'] = "pending";
            
            $id = $this->m_common->insert_row('asset_requisition', $insertData);
            if (!empty($id)) {
                $this->m_common->insert_row('asset_requisition_code', array('requisition_code'=>$indent_code));
              
                    foreach ($postData['item_id'] as $key => $each) {
                        $insertData1=array();
                        $insertData1['item_id'] = $each;
                        $insertData1['requisition_id'] = $id;
                        if(!empty($depart_ment)){
                            $insertData1['department_id'] = $depart_ment;
                        } 
                        if(!empty($requisition_no)){
                            $insertData1['requisition_no'] = $requisition_no;
                        }
                        if(!empty($indent_date)){
                            $insertData1['requisition_date'] = $indent_date;
                        } 
                    
                         $insertData1['status'] = "pending";
                       
                        if (!empty($postData['item_name_description'][$key])) {
                            $insertData1['item_name_description'] = $postData['item_name_description'][$key];
                        }
                        if (!empty($postData['unit'][$key])) {
                            $insertData1['m_unit'] = $postData['unit'][$key];
                        }

                     
                       if (!empty($postData['stock_qty'][$key])) {
                            $insertData1['stock_qty'] = $postData['stock_qty'][$key];
                       }
                       if (!empty($postData['indent_qty'][$key])) {
                           $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                       }
                        
                      
                      if(!empty($postData['c_c_id'][$key])) {
                            $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                      }
                     if(!empty($postData['expected_date'][$key])) {
                            $insertData1['expected_date'] = date('Y-m-d',strtotime($postData['expected_date'][$key]));
                     }
                    $this->m_common->insert_row('asset_requisition_details', $insertData1); 
                 }
                
                redirect_with_msg('general_store/add_asset_requisition', 'Successfully Added this Asset Requisition');
            } else {
                redirect_with_msg('general_store/add_asset_requisition', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_asset_requisition', 'Please fill the form and submit');
        }
        
    }
    
    
     function edit_asset_requisition($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'asset';
        $this->sub_inner_menu = 'asset_requisition';
        $this->titlebackend("Edit Asset Requisition");
        $data['departments'] = $this->m_common->get_row_array('department', '', '*');
        $data['items'] = $this->m_common->get_row_array('items',array('item_type'=>"Asset"), '*');
        $data['suppliers'] = $this->m_common->get_row_array('supplier', '', '*');
        $data['assets'] = $this->m_common->get_row_array('items',array('item_type'=>"Asset"), '*');
        $data['cost_centers'] = $this->m_common->get_row_array('cost_center','', '*');
        $data['asset_requisition'] = $this->m_common->get_row_array('asset_requisition',array('requisition_id'=>$id), '*');
        $data['asset_requisition_details'] = $this->m_common->get_row_array('asset_requisition_details', array('requisition_id' => $id), '*');
        $this->load->view('general_store/v_edit_asset_requisition',$data);
    }
    
     function edit_action_asset_requisition($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'asset';
        $this->sub_inner_menu = 'asset_requisition';
        $this->titlebackend("Edit Asset Requisition");
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            
           if(!empty($postData['date'])){
                $insertData['requisition_date'] =date('Y-m-d',strtotime($postData['date'])); 
                $indent_date=date('Y-m-d',strtotime($postData['date'])); 
            }
            
            if(!empty($postData['department_id'])){
                $insertData['department_id'] = $postData['department_id'];
                $depart_ment=$postData['department_id'];
            }
           
            
            if(!empty($postData['remarks'])){
                $insertData['remarks'] = $postData['remarks']; 
            }
            $requisition_id=$this->m_common->update_row('asset_requisition',array('requisition_id'=>$id),$insertData);
            $delete_details=$this->m_common->delete_row('asset_requisition_details',array('requisition_id'=>$id));
            if (!empty($requisition_id)) {
                
                    foreach ($postData['item_id'] as $key => $each) {
                     $insertData1=array();
                        $insertData1['item_id'] = $each;
                        $insertData1['requisition_id'] = $id;
                        if(!empty($depart_ment)){
                            $insertData1['department_id'] = $depart_ment;
                        } 
                        if(!empty($requisition_no)){
                            $insertData1['requisition_no'] = $requisition_no;
                        }
                        if(!empty($indent_date)){
                            $insertData1['requisition_date'] = $indent_date;
                        } 
                    
                         $insertData1['status'] = "pending";
                       
                        if (!empty($postData['item_name_description'][$key])) {
                            $insertData1['item_name_description'] = $postData['item_name_description'][$key];
                        }
                        if (!empty($postData['unit'][$key])) {
                            $insertData1['m_unit'] = $postData['unit'][$key];
                        }

                     
                       if (!empty($postData['stock_qty'][$key])) {
                            $insertData1['stock_qty'] = $postData['stock_qty'][$key];
                       }
                       if (!empty($postData['indent_qty'][$key])) {
                           $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                       }
                        
                      
                       if (!empty($postData['c_c_id'][$key])) {
                             $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                      }
                     if (!empty($postData['expected_date'][$key])) {
                            $insertData1['expected_date'] = date('Y-m-d',strtotime($postData['expected_date'][$key]));
                     }
                    $this->m_common->insert_row('asset_requisition_details', $insertData1); 
                 }
                
                
                    redirect_with_msg('general_store/details_asset_requisition/'.$id, 'Successfully Updated this Ipo material Indent');
              
            }else{
                
                    foreach ($postData['item_id'] as $key => $each) {
                    $insertData1=array();
                        $insertData1['item_id'] = $each;
                        $insertData1['requisition_id'] = $id;
                        if(!empty($depart_ment)){
                            $insertData1['department_id'] = $depart_ment;
                        } 
                        if(!empty($requisition_no)){
                            $insertData1['requisition_no'] = $requisition_no;
                        }
                        if(!empty($indent_date)){
                            $insertData1['requisition_date'] = $indent_date;
                        } 
                    
                         $insertData1['status'] = "pending";
                       
                        if (!empty($postData['item_name_description'][$key])) {
                            $insertData1['item_name_description'] = $postData['item_name_description'][$key];
                        }
                        if (!empty($postData['unit'][$key])) {
                            $insertData1['m_unit'] = $postData['unit'][$key];
                        }

                     
                       if (!empty($postData['stock_qty'][$key])) {
                            $insertData1['stock_qty'] = $postData['stock_qty'][$key];
                       }
                       if (!empty($postData['indent_qty'][$key])) {
                           $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                       }
                        
                      
                       if (!empty($postData['c_c_id'][$key])) {
                             $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                      }
                     if (!empty($postData['expected_date'][$key])) {
                            $insertData1['expected_date'] = date('Y-m-d',strtotime($postData['expected_date'][$key]));
                     }
                    $this->m_common->insert_row('asset_requisition_details', $insertData1); 
                 }
                
                 redirect_with_msg('general_store/details_asset_requisition/'.$id, 'Successfully Updated this Ipo material Indent');
            }
        } else {
            redirect_with_msg('general_store/details_asset_requisition/'.$id, 'Please fill the form and submit');
        }
    }
    
       function details_asset_requisition($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'asset';
        $this->sub_inner_menu = 'asset_requisition';
        $this->titlebackend("Edit Asset Requisition");
        $data['departments'] = $this->m_common->get_row_array('department', '', '*');
        $data['items'] = $this->m_common->get_row_array('items',array('item_type'=>"Asset"), '*');
        $data['suppliers'] = $this->m_common->get_row_array('supplier', '', '*');
        $data['assets'] = $this->m_common->get_row_array('items',array('item_type'=>"Asset"), '*');
        $data['cost_centers'] = $this->m_common->get_row_array('cost_center','', '*');
        $data['asset_requisition'] = $this->m_common->get_row_array('asset_requisition',array('requisition_id'=>$id), '*');
        $data['asset_requisition_details'] = $this->m_common->get_row_array('asset_requisition_details', array('requisition_id' => $id), '*');
        $this->load->view('general_store/v_details_asset_requisition',$data);
    }
    
    function delete_asset_requisition($id) {
       $this->menu = 'general_store';
       $this->sub_menu = 'asset';
       $this->sub_inner_menu = 'asset_requisition';
        $this->titlebackend("Asset Requisition");
         if (!empty($id)) {  
            $ids = $this->m_common->delete_row('asset_requisition', array('requisition_id' => $id));
            if (!empty($ids)) {
                $this->m_common->delete_row('asset_requisition_details', array('requisition_id' => $id));
                redirect_with_msg('general_store/asset_requisition', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/asset_requisition', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/asset_requisition', 'Please click on delete button');
        }
    } 
    
    
    
    

    
   function asset_issue() {
       $this->menu = 'general_store';
       $this->sub_menu = 'asset';
       $this->sub_inner_menu = 'asset_issue';
       $this->titlebackend("Asset Issue");
       $data['asset_issues'] = $this->m_common->get_row_array('asset_issue', '', '*');
       $sql="select * from asset_issue where a_issue_status='issued' or a_issue_status='issued' ";
      // $data['asset_issues'] =$this->m_common->customeQuery($sql);
       $this->load->view('general_store/v_asset_issue',$data);
    }
    
   function add_asset_issue() {
        $this->menu = 'general_store';
      //  $this->sub_menu = 'issue_session';
        $this->sub_inner_menu = 'asset_issue';
        $this->titlebackend("Add Asset Issue Session");
        $data['departments'] = $this->m_common->get_row_array('department', '', '*');
        $data['items'] = $this->m_common->get_row_array('items', '', '*');
      
        //$data['requisitions'] = $this->m_common->get_row_array('v_asset_requisition',array('status'=>"pending"), '*');
        $sql="select * from v_asset_requisition where status='pending' or status='partial_issued' ";
        $data['requisitions'] =$this->m_common->customeQuery($sql);
        
        $issue_last_code=$this->m_common->get_row_array('asset_issue_code','','*','',1,'id','DESC');
        if(!empty($issue_last_code)){
           
            $issue_code=$issue_last_code[0]['issue_code']+1;
            if($issue_code>999){
                $issue_sl_no=$issue_code;
            }else if($issue_code>99){
                $issue_sl_no="0".$issue_code;
            }else if($issue_code>9){
                $issue_sl_no="00".$issue_code;
            }else{
                $issue_sl_no="000".$issue_code;
            }
        }else{
            $issue_code=1;
            $issue_sl_no='0001';
        }
        $data['issue_code']=$issue_code;
        $data['issue_auto_code']=$issue_sl_no;
        
        $this->load->view('general_store/v_add_asset_issue',$data);
    }
    
   function add_action_asset_issue() {
        $this->menu = 'general_store';
       // $this->sub_menu = 'issue_session';
        $this->sub_inner_menu = 'asset_issue';
        $this->titlebackend("Add Asset Issue ");
        $postData = $this->input->post();
        if (!empty($postData)) {
            $issue_code=$postData['issue_code']; 
            $insertData = array();
         //   $insertData['created'] = date('Y-m-d');
            if(!empty($postData['a_issue_no'])){
                $insertData['a_issue_no'] = $postData['a_issue_no']; 
            }
            
            if(!empty($postData['a_issue_date'])){
                $insertData['a_issue_date'] =date('Y-m-d',strtotime($postData['a_issue_date'])); 
                $issue_date=date('Y-m-d',strtotime($postData['a_issue_date'])); 
            }
            if(!empty($postData['requisition_id'])){
                $insertData['requisition_id'] = $postData['requisition_id']; 
                $requisition_id=$postData['requisition_id']; 
           }
                
            if(!empty($postData['a_isssue_remark'])){
                $insertData['a_isssue_remark'] = $postData['a_isssue_remark']; 
            }
            $insertData['a_issue_status'] ="issued";  
            $id = $this->m_common->insert_row('asset_issue', $insertData);
            if (!empty($id)) {
                $this->m_common->insert_row('asset_issue_code',array('issue_code'=>$issue_code));
                $i=0;
                 foreach ($postData['item_id'] as $key => $each) {
                     $item_info=$this->m_common->get_row_array('items',array('id'=>$each),'*');
                     $indent_item_info=$this->m_common->get_row_array('asset_requisition_details',array('item_id'=>$each,'requisition_id'=>$requisition_id),'*');
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['a_issue_id'] = $id;
                     $insertData1['requisition_id'] =$requisition_id;
                     $insertData1['issue_date'] = $issue_date;
                    // $insertData1['issue_status'] = 'applied';
                     $insertData1['issue_status'] = 'issued';
                    
                    
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if(!empty($postData['c_c_id'][$key])) {
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_name_des'][$key])) {
                         $insertData1['item_name_des'] = $postData['item_name_des'][$key];
                     }
                     if(!empty($postData['m_unit'][$key])) {
                         $insertData1['m_unit'] = $postData['m_unit'][$key];
                     }
                     if(!empty($postData['indent_qty'][$key])) {
                         $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                         $indent_qty=$postData['indent_qty'][$key];
                     }
                     if (!empty($postData['stock_qty'][$key])) {
                         $insertData1['stock_qty'] = $postData['stock_qty'][$key];
                     }
                     if (!empty($postData['issue_qty'][$key])) {
                         $insertData1['issue_qty'] = $postData['issue_qty'][$key];
                         $issue_qty=$postData['issue_qty'][$key];
                     }
                    
                  
                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                     
                   
                         if($issue_qty==$indent_qty){
                              $status='issued';
                         }else{
                             $status='partial_issued';
                             $i=1;
                         }
                         
                    
                     $current_stock=$item_info[0]['stock_amount']-$issue_qty;
                    
                     $issued=$indent_item_info[0]['issue_qty']+$issue_qty;            
                     $this->m_common->insert_row('asset_issue_details', $insertData1); 
                     $this->m_common->update_row('items',array('id'=>$each),array('stock_amount'=>$current_stock));
                     $this->m_common->update_row('asset_requisition_details',array('item_id'=>$each,'requisition_id'=>$requisition_id),array('issue_qty'=>$issued,'status'=>$status));
                 }
                  if(!empty($i)){
                     if($i==1){ 
                         $this->m_common->update_row('asset_requisition',array('requisition_id'=>$requisition_id),array('status'=>'partial_issued'));
                     }else{
                        // $this->m_common->update_row('asset_requisition',array('requisition_id'=>$requisition_id),array('status'=>'processed'));
                     }
                 }else{
                    $this->m_common->update_row('asset_requisition',array('requisition_id'=>$requisition_id),array('status'=>'issued')); 
                 }
                redirect_with_msg('general_store/add_asset_issue', 'Successfully  Added Issue Info');
            } else {
                redirect_with_msg('general_store/add_asset_issue', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_asset_issue', 'Please fill the form and submit');
        }
        
    }
    
   function edit_asset_issue($id) {
        $this->menu = 'general_store';
     //   $this->sub_menu = 'issue_session';
        $this->sub_inner_menu = 'asset_issue';
        $this->titlebackend("Edit Asset Issue");
        $data['departments'] = $this->m_common->get_row_array('department', '', '*');
        $sql="select * from v_asset_requisition ";
        $data['requisitions'] =$this->m_common->customeQuery($sql);
        $data['asset_issue'] = $this->m_common->get_row_array('asset_issue',array('a_issue_id'=>$id), '*');
        $data['asset_issue_details'] = $this->m_common->get_row_array('asset_issue_details', array('a_issue_id' => $id), '*');
        $this->load->view('general_store/v_edit_asset_issue',$data);
    }
   function edit_action_asset_issue($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'material_receive_requisition';
        $this->titlebackend("Edit Material Issue");
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
              if(!empty($postData['a_issue_date'])){
                $insertData['a_issue_date'] =date('Y-m-d',strtotime($postData['a_issue_date'])); 
                $issue_date=date('Y-m-d',strtotime($postData['a_issue_date'])); 
            }
            if(!empty($postData['requisition_id'])){
                $insertData['requisition_id'] = $postData['requisition_id']; 
                $requisition_id=$postData['requisition_id']; 
           }
                
            if(!empty($postData['a_isssue_remark'])){
                $insertData['a_isssue_remark'] = $postData['a_isssue_remark']; 
            }
            
            $s_id=$this->m_common->update_row('asset_issue',array('a_issue_id'=>$id),$insertData);
            $delete_details=$this->m_common->delete_row('asset_issue_details',array('a_issue_id'=>$id));
            if (!empty($s_id)) {
                  $i=0;
                  foreach ($postData['item_id'] as $key => $each) {
                     $item_info=$this->m_common->get_row_array('items',array('id'=>$each),'*');
                     $indent_item_info=$this->m_common->get_row_array('asset_requisition_details',array('item_id'=>$each,'requisition_id'=>$requisition_id),'*');
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['requisition_id'] = $requisition_id;
                     $insertData1['a_issue_id'] = $id;
                     $insertData1['issue_date'] = $issue_date;
                     if(!empty($issue_status)){
                         $insertData1['issue_status'] = $issue_status;
                     }
                    
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if (!empty($postData['c_c_id'][$key])){
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     } 
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_name_des'][$key])) {
                         $insertData1['item_name_des'] = $postData['item_name_des'][$key];
                     }
                     if (!empty($postData['m_unit'][$key])) {
                         $insertData1['m_unit'] = $postData['m_unit'][$key];
                     }
                     if (!empty($postData['indent_qty'][$key])) {
                         $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                         $indent_qty=$postData['indent_qty'][$key];
                     }
                     if (!empty($postData['stock_qty'][$key])) {
                         $insertData1['stock_qty'] = $postData['stock_qty'][$key];
                     }
                 
                    if (!empty($postData['pre_issue_qty'][$key])) {
                         $pre_issue_qty = $postData['pre_issue_qty'][$key];
                    }
                    if (!empty($postData['issue_qty'][$key])) {
                        $insertData1['issue_qty'] = $postData['issue_qty'][$key];
                         $issue_qty=$postData['issue_qty'][$key];
                    }
                   
                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    if($issue_qty==$indent_qty){
                           $status='issued';
                      }else{
                          $status='partial_issued';
                          $i=1;
                      }
                     $current_stock=$item_info[0]['stock_amount']-$issue_qty+$pre_issue_qty;
              
                     $issued=$indent_item_info[0]['issued_qty']+$issue_qty-$pre_issue_qty;            
                     $this->m_common->insert_row('asset_issue_details', $insertData1); 
                     $this->m_common->update_row('items',array('id'=>$each),array('stock_amount'=>$current_stock));
                     $this->m_common->update_row('asset_requisition_details',array('item_id'=>$each,'requisition_id'=>$requisition_id),array('issue_qty'=>$issued,'status'=>$status));
                 }
                 
//                  if(!empty($i)){
//                     if($i==1){ 
//                         $this->m_common->update_row('asset_requisition',array('requisition_id'=>$requisition_id),array('status'=>'partial_issued'));
//                     }else{
//                        // $this->m_common->update_row('asset_requisition',array('requisition_id'=>$requisition_id),array('status'=>'processed'));
//                     }
//                 }else{
//                    $this->m_common->update_row('asset_requisition',array('requisition_id'=>$requisition_id),array('status'=>'issued')); 
//                 }
                 
                 
                  $sql="select * from asset_requisition_details where requisition_id=".$requisition_id." and (status='pending' or status='partial_issued')";
                  $requisition_items=$this->m_common->customeQuery($sql);
                  if(!empty($requisition_items)){
                      $this->m_common->update_row('asset_requisition',array('requisition_id'=>$requisition_id),array('status'=>'partial_issued'));
                  }else{
                       $this->m_common->update_row('asset_requisition',array('requisition_id'=>$requisition_id),array('status'=>'issued')); 
                  }
                
                 redirect_with_msg('general_store/details_asset_issue/'.$id, 'Successfully Updated Issue');
              
            }else{
                  $i=0;
                 foreach ($postData['item_id'] as $key => $each) {
                     $item_info=$this->m_common->get_row_array('items',array('id'=>$each),'*');
                     $indent_item_info=$this->m_common->get_row_array('asset_requisition_details',array('item_id'=>$each,'requisition_id'=>$requisition_id),'*');
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['requisition_id'] = $requisition_id;
                     $insertData1['a_issue_id'] = $id;
                     $insertData1['issue_date'] = $issue_date;
                     if(!empty($issue_status)){
                         $insertData1['issue_status'] = $issue_status;
                     }
                    
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if (!empty($postData['c_c_id'][$key])){
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     } 
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_name_des'][$key])) {
                         $insertData1['item_name_des'] = $postData['item_name_des'][$key];
                     }
                     if (!empty($postData['m_unit'][$key])) {
                         $insertData1['m_unit'] = $postData['m_unit'][$key];
                     }
                     if (!empty($postData['indent_qty'][$key])) {
                         $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                         $indent_qty=$postData['indent_qty'][$key];
                     }
                     if (!empty($postData['stock_qty'][$key])) {
                         $insertData1['stock_qty'] = $postData['stock_qty'][$key];
                     }
                 
                    if (!empty($postData['pre_issue_qty'][$key])) {
                         $pre_issue_qty = $postData['pre_issue_qty'][$key];
                    }
                    if (!empty($postData['issue_qty'][$key])) {
                        $insertData1['issue_qty'] = $postData['issue_qty'][$key];
                         $issue_qty=$postData['issue_qty'][$key];
                    }
                   
                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    if($issue_qty==$indent_qty){
                           $status='issued';
                      }else{
                          $status='partial_issued';
                          $i=1;
                      }
                     $current_stock=$item_info[0]['stock_amount']-$issue_qty+$pre_issue_qty;
              
                     $issued=$indent_item_info[0]['issued_qty']+$issue_qty-$pre_issue_qty;            
                     $this->m_common->insert_row('asset_issue_details', $insertData1); 
                     $this->m_common->update_row('items',array('id'=>$each),array('stock_amount'=>$current_stock));
                     $this->m_common->update_row('asset_requisition_details',array('item_id'=>$each,'requisition_id'=>$requisition_id),array('issue_qty'=>$issued,'status'=>$status));
                 }
                 
                  $sql="select * from asset_requisition_details where requisition_id=".$requisition_id." and (status='pending' or status='partial_issued')";
                  $requisition_items=$this->m_common->customeQuery($sql);
                  if(!empty($requisition_items)){
                      $this->m_common->update_row('asset_requisition',array('requisition_id'=>$requisition_id),array('status'=>'partial_issued'));
                  }else{
                       $this->m_common->update_row('asset_requisition',array('requisition_id'=>$requisition_id),array('status'=>'issued')); 
                  }
                
                 redirect_with_msg('general_store/details_asset_issue/'.$id, 'Successfully Updated Issue');
            }
        } else {
            redirect_with_msg('general_store/edit_asset_issue/'.$id, 'Please fill the form and submit');
        }
    }
    
    function details_asset_issue($id,$print=false) {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'asset_issue';
        $this->titlebackend("Details Material Receive Requisition ");
        $data['departments'] = $this->m_common->get_row_array('department', '', '*');
        $sql="select * from v_asset_requisition ";
        $data['requisitions'] =$this->m_common->customeQuery($sql);
        $data['asset_issue'] = $this->m_common->get_row_array('asset_issue',array('a_issue_id'=>$id), '*');
        $data['asset_issue_details'] = $this->m_common->get_row_array('asset_issue_details', array('a_issue_id' => $id), '*');
        if($print==false){
            $this->load->view('general_store/v_details_asset_issue',$data);
        }else{
           $html=$this->load->view('general_store/print_issue', $data,true);
           echo $html;exit; 
        }
    }
    
  
    
    function delete_asset_issue($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'asset_issue';
        $this->titlebackend("Material Receive Requisition");
         if (!empty($id)) {  
            $ids = $this->m_common->delete_row('asset_issue', array('a_issue_id' => $id));
            if (!empty($ids)) {
                $this->m_common->delete_row('asset_issue_details', array('a_issue_id' => $id));
                redirect_with_msg('general_store/asset_issue', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/asset_issue', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/asset_issue', 'Please click on delete button');
        }
    }
   
   
    
    
    // start asset issue receive
    
      function asset_issue_receive() {
        $this->menu = 'general_store';
     //   $this->sub_menu = 'issue_return';
        $this->sub_inner_menu = 'asset_issue_receive';
        $this->titlebackend("Asset Issue Receive");
        $data['issue_receives'] = $this->m_common->get_row_array('asset_issue_receive', '', '*');
        $this->load->view('general_store/v_asset_issue_receive',$data);
    }
    
    function add_asset_issue_receive() {
        $this->menu = 'general_store';
       // $this->sub_menu = 'issue_return';
        $this->sub_inner_menu = 'asset_issue_receive';
        $this->titlebackend("Add Asset Issue Receive");    
        //$data['issue_numbers'] = $this->m_common->get_row_array('issue_session', '', '*');
       $sql="select * from asset_issue where a_issue_status='issued' or a_issue_status='partial_received' ";
       $data['issue_numbers'] =$this->m_common->customeQuery($sql);
        $ir_last_code=$this->m_common->get_row_array('asset_issue_receive_code','','*','',1,'id','DESC');
        if(!empty($ir_last_code)){
           
            $ir_code=$ir_last_code[0]['a_ir_code']+1;
            if($ir_code>999){
                $ir_sl_no=$ir_code;
            }else if($ir_code>99){
                $ir_sl_no="0".$ir_code;
            }else if($ir_code>9){
                $ir_sl_no="00".$ir_code;
            }else{
                $ir_sl_no="000".$ir_code;
            }
        }else{
            $ir_code=1;
            $ir_sl_no='0001';
        }
        $data['a_ir_code']=$ir_code;
        $data['air_auto_code']=$ir_sl_no;
        
        $this->load->view('general_store/v_add_asset_issue_receive',$data);
    }
    
    function add_action_asset_issue_receive() {
        $this->menu = 'general_store';
     //   $this->sub_menu = 'issue_return';
        $this->sub_inner_menu = 'asset_issue_receive';
        $this->titlebackend("Add Issue Receive");
        $postData = $this->input->post();
        $ir_code=$this->input->post('a_ir_code');
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
            if(!empty($postData['a_ir_no'])){
                $insertData['a_ir_no'] = $postData['a_ir_no']; 
            }
            
            if(!empty($postData['a_ir_date'])){
                $insertData['a_ir_date'] =date('Y-m-d',strtotime($postData['a_ir_date']));
                $issue_return_date=date('Y-m-d',strtotime($postData['a_ir_date']));
            }
            if(!empty($postData['a_issue_date'])){
                $insertData['a_issue_date'] =date('Y-m-d',strtotime($postData['a_issue_date'])); 
            }
             if(!empty($postData['a_issue_id'])){
                $insertData['a_issue_id'] = $postData['a_issue_id']; 
            }
            
            if(!empty($postData['remarks'])){
                $insertData['remarks'] = $postData['remarks']; 
            }
           
            $insertData['a_ir_status'] ='pending';
            
            
            $id = $this->m_common->insert_row('asset_issue_receive', $insertData);
            if (!empty($id)) {
                $this->m_common->insert_row('asset_issue_receive_code', array('a_ir_code'=>$ir_code));
                 foreach ($postData['item_id'] as $key => $each) {
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['a_ir_id'] = $id;
                     $insertData1['status'] ="pending";
                     $insertData1['a_ir_date'] = $issue_return_date;
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if (!empty($postData['c_c_id'][$key])) {
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_name_des'][$key])) {
                         $insertData1['item_name_des'] = $postData['item_name_des'][$key];
                     }
                     if (!empty($postData['m_unit'][$key])) {
                         $insertData1['m_unit'] = $postData['m_unit'][$key];
                     }
                     if (!empty($postData['issued_qty'][$key])) {
                         $insertData1['issued_qty'] = $postData['issued_qty'][$key];
                     }
                    if(!empty($postData['receive_qty'][$key])) {
                        $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                    }
                    
                     if(!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('asset_issue_receive_details', $insertData1); 
                 }
                redirect_with_msg('general_store/add_asset_issue_receive', 'Successfully  Issue Received');
            } else {
                redirect_with_msg('general_store/add_asset_issue_receive', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_asset_issue_receive', 'Please fill the form and submit');
        }
        
    }
    
    function edit_asset_issue_receive($id) {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'asset_issue_receive';
      //  $this->sub_menu = 'store_return';
        $this->titlebackend("Edit Asset  Issue Receive");
        $data['issue_numbers'] = $this->m_common->get_row_array('asset_issue', '', '*');
        
        $data['issue_return'] = $this->m_common->get_row_array('asset_issue_receive',array('a_ir_id'=>$id), '*');
        $data['items'] = $this->m_common->get_row_array('asset_issue_details',array('a_issue_id'=>$data['issue_return'][0]['a_issue_id']), '*');
        $data['issue_return_details'] = $this->m_common->get_row_array('asset_issue_receive_details', array('a_ir_id' => $id), '*');
        $this->load->view('general_store/v_edit_asset_issue_receive',$data);
    }
    
     function details_asset_issue_receive($id,$print=false) {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'asset_issue_receive';
        $this->titlebackend("Edit Asset  Issue Receive");
        $data['issue_numbers'] = $this->m_common->get_row_array('asset_issue', '', '*');
        
        $data['issue_return'] = $this->m_common->get_row_array('asset_issue_receive',array('a_ir_id'=>$id), '*');
        $data['items'] = $this->m_common->get_row_array('asset_issue_details',array('a_issue_id'=>$data['issue_return'][0]['a_issue_id']), '*');
        $data['issue_return_details'] = $this->m_common->get_row_array('asset_issue_receive_details', array('a_ir_id' => $id), '*');
      
          if($print==false){
            $this->load->view('general_store/v_details_asset_issue_receive',$data);
        }else{
           $html=$this->load->view('general_store/print_issue_return', $data,true);
           echo $html;exit; 
        }
    }
    
    function edit_action_asset_issue_receive($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'asset_issue_receive';
        $this->titlebackend("Edit Asset Issue Receive");
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
           if(!empty($postData['a_ir_no'])){
                $insertData['a_ir_no'] = $postData['a_ir_no']; 
            }
            
            if(!empty($postData['a_ir_date'])){
                $insertData['a_ir_date'] =date('Y-m-d',strtotime($postData['a_ir_date']));
                $issue_return_date=date('Y-m-d',strtotime($postData['a_ir_date']));
            }
            if(!empty($postData['a_issue_date'])){
                $insertData['a_issue_date'] =date('Y-m-d',strtotime($postData['a_issue_date'])); 
            }
             if(!empty($postData['a_issue_id'])){
                $insertData['a_issue_id'] = $postData['a_issue_id']; 
            }
            
            if(!empty($postData['remarks'])){
                $insertData['remarks'] = $postData['remarks']; 
            }
           
            $s_id=$this->m_common->update_row('asset_issue_receive',array('a_ir_id'=>$id),$insertData);
            $delete_details=$this->m_common->delete_row('asset_issue_receive_details',array('a_ir_id'=>$id));
            if (!empty($s_id)) {
                  foreach ($postData['item_id'] as $key => $each) {
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['a_ir_id'] = $id;
                     $insertData1['status'] ="pending";
                     $insertData1['a_ir_date'] = $issue_return_date;
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if (!empty($postData['c_c_id'][$key])) {
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_name_des'][$key])) {
                         $insertData1['item_name_des'] = $postData['item_name_des'][$key];
                     }
                     if (!empty($postData['m_unit'][$key])) {
                         $insertData1['m_unit'] = $postData['m_unit'][$key];
                     }
                     if (!empty($postData['issued_qty'][$key])) {
                         $insertData1['issued_qty'] = $postData['issued_qty'][$key];
                     }
                    if(!empty($postData['receive_qty'][$key])) {
                        $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                    }
                    
                     if(!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('asset_issue_receive_details', $insertData1);
                 }
                
                    redirect_with_msg('general_store/details_asset_issue_receive/'.$id, 'Successfully Updated Issue Return Info');
              
            }else{
                  foreach ($postData['item_id'] as $key => $each) {
                      $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['a_ir_id'] = $id;
                     $insertData1['status'] ="pending";
                     $insertData1['a_ir_date'] = $issue_return_date;
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if (!empty($postData['c_c_id'][$key])) {
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_name_des'][$key])) {
                         $insertData1['item_name_des'] = $postData['item_name_des'][$key];
                     }
                     if (!empty($postData['m_unit'][$key])) {
                         $insertData1['m_unit'] = $postData['m_unit'][$key];
                     }
                     if (!empty($postData['issued_qty'][$key])) {
                         $insertData1['issued_qty'] = $postData['issued_qty'][$key];
                     }
                    if(!empty($postData['receive_qty'][$key])) {
                        $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                    }
                    
                     if(!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('asset_issue_receive_details', $insertData1);
                 }
                 redirect_with_msg('general_store/details_asset_issue_receive/'.$id, 'Successfully Updated Issue Return Info');
            }
        } else {
            redirect_with_msg('general_store/edit_asset_issue_receive/'.$id, 'Please fill the form and submit');
        }
    }
    
    function delete_asset_issue_receive($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'asset_issue_receive';
        $this->titlebackend("Aset Issue Receive");
         if (!empty($id)) {  
            $ids = $this->m_common->delete_row('asset_issue_receive', array('a_ir_id' => $id));
            if (!empty($ids)) {
                $this->m_common->delete_row('asset_issue_receive_details', array('a_ir_id' => $id));
                redirect_with_msg('general_store/asset_issue_receive', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/asset_issue_receive', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/asset_issue_receive', 'Please click on delete button');
        }
    }
    
    
    
      function receive_asset_issue_receive($id) {
         $receive_info=$this->m_common->get_row_array('asset_issue_receive',array('a_ir_id'=>$id),'*');
         $return_items=$this->m_common->get_row_array('asset_issue_receive_details',array('a_ir_id'=>$id),'item_id,receive_qty');
         foreach($return_items as $return_item){
             $item_info=$this->m_common->get_row_array('items',array('id'=>$return_item['item_id']),'stock_amount');
             $issue_item_info=$this->m_common->get_row_array('asset_issue_details',array('item_id'=>$return_item['item_id'],'a_issue_id'=>$receive_info[0]['a_issue_id']),'*');
             $issue_item_receive=$issue_item_info[0]['receive_qty']+$return_item['receive_qty'];
             $current_stock=$item_info[0]['stock_amount']+$return_item['receive_qty'];
             if($issue_item_receive==$issue_item_info[0]['issue_qty']){
                 $this->m_common->update_row('asset_issue_details',array('item_id'=>$return_item['item_id'],'a_issue_id'=>$receive_info[0]['a_issue_id']),array('receive_qty'=>$issue_item_receive,'issue_status'=>"received"));
             }else{
                 $this->m_common->update_row('asset_issue_details',array('item_id'=>$return_item['item_id'],'a_issue_id'=>$receive_info[0]['a_issue_id']),array('receive_qty'=>$issue_item_receive,'issue_status'=>"partial_received"));
             }
             $this->m_common->update_row('items',array('id'=>$return_item['item_id']),array('stock_amount'=>$current_stock));
         }
         $ids=$this->m_common->update_row('asset_issue_receive',array('a_ir_id'=>$id),array('a_ir_status'=>"received"));
         if(!empty($ids)){
             $this->m_common->update_row('asset_issue_receive_details',array('a_ir_id'=>$id),array('status'=>"received"));
             $sql="select * from asset_issue_details where a_issue_id=".$receive_info[0]['a_issue_id']." and (issue_status='issued' or issue_status='partial_received')";
             $result=$this->m_common->customeQuery($sql);
             if(!empty($result)){
                  $this->m_common->update_row('asset_issue',array('a_issue_id'=>$receive_info[0]['a_issue_id']),array('a_issue_status'=>"partial_received"));
             }else{
                  $this->m_common->update_row('asset_issue',array('a_issue_id'=>$receive_info[0]['a_issue_id']),array('a_issue_status'=>"received"));
             }
                 
             
             redirect_with_msg('general_store/asset_issue_receive', 'Successfully Received ');
         }else{
             redirect_with_msg('general_store/asset_issue_receive', 'Not Received');
         }
     }
    
    
    
    //end asset issue receive
    
    
    
    
    
//End Asset Movement    
    
    
    
    
//Start IPO Material Indent   
    
     function ipo_material_indent() {
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'ipo_material_indent';
        $companyId = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        
        
        $this->titlebackend("Ipo Material Indent");
        //$data['ipo_materials'] = $this->m_common->get_row_array('v_ipo_material_indent','', '*','','','indent_process_status','ASC');
     //   $sql="select * from v_ipo_material_indent where (indent_process_status='applied' or indent_process_status='processed')  " ;
       // $sql="select * from v_ipo_material_indent where (budgeted_status='pending' or budgeted_status='partial_budgeted')  " ;
        if($user_type==1){
            $sql="select * from v_ipo_material_indent where department_id=".$companyId;
        }else{
             $sql="select * from v_ipo_material_indent where employeeId=".$employee_id." or approver_id=".$employee_id;
        }
        $data['ipo_materials']=$this->m_common->customeQuery($sql);
        $this->load->view('general_store/v_ipo_material_indent',$data);
    }
    
    function add_ipo_material_indent() {
        $this->menu = 'general_store';
        $this->sub_menu = 'ipo_material_indent';
        $companyId = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        
        
        $this->titlebackend("Add Ipo Material Indent");
        if($user_type==1){
            $data['departments'] = $this->m_common->get_row_array('department', '', '*');
        }else{
            $data['departments'] = $this->m_common->get_row_array('department',array('d_id'=>$companyId), '*'); 
        }
        $data['items'] = $this->m_common->get_row_array('items',array('item_type'=>"Consumable"), '*');
        $data['suppliers'] = $this->m_common->get_row_array('supplier', '', '*');
      //  $data['assets'] = $this->m_common->get_row_array('assets', '', '*');
       $data['assets'] = $this->m_common->get_row_array('items',array('item_type'=>"Asset"), '*');
       $data['cost_centers'] = $this->m_common->get_row_array('cost_center','', '*');
       // $data['indent_number']=$this->getRendVerCode(4);
        $indent_last_code=$this->m_common->get_row_array('indent_code','','*','',1,'id','DESC');
        if(!empty($indent_last_code)){
           
            $indent_code=$indent_last_code[0]['indent_code']+1;
            if($indent_code>999){
                $indent_sl_no=$indent_code;
            }else if($indent_code>99){
                $indent_sl_no="0".$indent_code;
            }else if($indent_code>9){
                $indent_sl_no="00".$indent_code;
            }else{
                $indent_sl_no="000".$indent_code;
            }
        }else{
            $indent_code=1;
            $indent_sl_no='0001';
        }
        $data['indent_number']=$indent_code;
        $data['indent_auto_number']=$indent_sl_no;
        $this->load->view('general_store/v_add_ipo_material_indent',$data);
    }
    
    function add_action_ipo_material_indent() {
        $this->menu = 'general_store';
        $this->sub_menu = 'ipo_material_indent';
        $this->titlebackend("Add Ipo Material Indent");
        $postData = $this->input->post();
        $indent_code=$this->input->post('indent_code');
        if(!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
            if(!empty($postData['ipo_number'])){
                $insertData['ipo_number'] = $postData['ipo_number'];
                $indent_no=$postData['ipo_number'];
            }
            
            if(!empty($postData['ipo_number'])){
                $insertData['ipo_number'] = $postData['ipo_number']; 
            }
            if(!empty($postData['ipo_item_type'])){
                $insertData['ipo_item_type'] = $postData['ipo_item_type']; 
            }
            if(!empty($postData['date'])){
                $insertData['date'] =date('Y-m-d',strtotime($postData['date'])); 
                $indent_date=date('Y-m-d',strtotime($postData['date'])); 
            }
             if(!empty($postData['department_id'])){
                $insertData['department_id'] = $postData['department_id'];
                $depart_ment=$postData['department_id'];
            }
            if(!empty($postData['indent_memo'])){
                $insertData['indent_memo'] = $postData['indent_memo']; 
            }
            if(!empty($postData['status'])){
                $insertData['status'] = $postData['status']; 
            }
             if(!empty($postData['suplier_id'])){
                $insertData['suplier_id'] = $postData['suplier_id']; 
            }
             if(!empty($postData['inv_chalan'])){
                $insertData['inv_chalan'] = $postData['inv_chalan']; 
            }
             if(!empty($postData['procurement'])){
                $insertData['procurement'] = $postData['procurement']; 
            }
            
            if(!empty($postData['remarks'])){
                $insertData['remarks'] = $postData['remarks']; 
            }
            
            if(!empty($postData['indent_process_status'])){
                $insertData['indent_process_status'] = $postData['indent_process_status']; 
                $indent_process_status=$postData['indent_process_status']; 
            }
            
            $insertData['status'] ="Pending";
            
            $user_id = $this->session->userdata('user_id');
            $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
            $insertData['employeeId'] = $userData[0]['employeeId'];
            $approver = fetch_approver(2, 7, $userData);
            if(empty($approver[0])){
                redirect_with_msg('general_store/ipo_material_indent', 'Please contact with administratior to set approver');
            }
            $insertData['approver_id'] = $approver[0];
        
            $id = $this->m_common->insert_row('ipo_material_indent', $insertData);
            if (!empty($id)) {
                $this->m_common->insert_row('indent_code', array('indent_code'=>$indent_code));
                if($postData['ipo_item_type']=="Consumable"){
                    foreach ($postData['item_id'] as $key => $each) {
                        $insertData1=array();
                        $insertData1['item_id'] = $each;
                        $insertData1['ipo_m_id'] = $id;
                        if(!empty($depart_ment)){
                            $insertData1['department_id'] = $depart_ment;
                        }
                        if(!empty($depart_ment)){
                            $insertData1['department_id'] = $depart_ment;
                        } 
                        if(!empty($indent_no)){
                            $insertData1['indent_no'] = $indent_no;
                        }
                        if(!empty($indent_date)){
                            $insertData1['indent_date'] = $indent_date;
                        } 
                        if($indent_process_status=="processed"){
                            $insertData1['status'] = "received";
                        }
                        if (!empty($postData['item_name_description'][$key])) {
                            $insertData1['item_name_description'] = $postData['item_name_description'][$key];
                        }
                        if (!empty($postData['unit'][$key])) {
                            $insertData1['unit'] = $postData['unit'][$key];
                        }

                        if (!empty($postData['last_unit_price'][$key])) {
                            $insertData1['last_unit_price'] = $postData['last_unit_price'][$key];
                        } 

                        if (!empty($postData['last_supplier'][$key])) {
                            $insertData1['last_supplier'] = $postData['last_supplier'][$key];
                        }

                       if(!empty($postData['stock_qty'][$key])) {
                            $insertData1['stock_qty'] = $postData['stock_qty'][$key];
                        }
                        
                        if(!empty($postData['indent_qty'][$key])) {
                            $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                        }
                        if(!empty($postData['net_received'][$key])) {
                            $insertData1['net_received'] = $postData['net_received'][$key];
                        }
                       if(!empty($postData['unit_price'][$key])) {
                            $insertData1['unit_price'] = $postData['unit_price'][$key];
                        }
                       if(!empty($postData['receive_qty'][$key])) {
                            $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                        }
                       if(!empty($postData['ipo'][$key])) {
                           $insertData1['ipo'] = $postData['ipo'][$key];
                        }
                       if(!empty($postData['asset_id'][$key])) {
                           $insertData1['asset_id'] = $postData['asset_id'][$key];
                       }
                       if(!empty($postData['c_c_id'][$key])) {
                              $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                       }
                     if(!empty($postData['expected_date'][$key])) {
                            $insertData1['expected_date'] = date('Y-m-d',strtotime($postData['expected_date'][$key]));
                     }
                    $this->m_common->insert_row('ipo_material_indent_details', $insertData1); 
                 }
                }else{
                       foreach ($postData['item_id_a'] as $key => $each) {
                            $insertData1=array();
                            $insertData1['item_id'] = $each;
                            $insertData1['ipo_m_id'] = $id;
                            if(!empty($depart_ment)){
                               $insertData1['department_id'] = $depart_ment;
                            } 
                            if(!empty($indent_no)){
                                $insertData1['indent_no'] = $indent_no;
                            }     
                            if(!empty($indent_date)){
                                $insertData1['indent_date'] = $indent_date;
                            }    
                            if($indent_process_status=="processed"){
                                $insertData1['status'] = "received";
                            }
                             if (!empty($postData['item_name_description_a'][$key])) {
                                 $insertData1['item_name_description'] = $postData['item_name_description_a'][$key];
                             }
                             if (!empty($postData['unit_a'][$key])) {
                                 $insertData1['unit'] = $postData['unit_a'][$key];
                             }

                            if (!empty($postData['last_unit_price_a'][$key])) {
                                $insertData1['last_unit_price'] = $postData['last_unit_price_a'][$key];
                            } 

                           if (!empty($postData['last_supllier_a'][$key])) {
                             $insertData1['last_supplier'] = $postData['last_supllier_a'][$key];
                           }
                         
                         if (!empty($postData['stock_qty_a'][$key])) {
                             $insertData1['stock_qty'] = $postData['stock_qty_a'][$key];
                         }
                           if (!empty($postData['indent_qty_a'][$key])) {
                             $insertData1['indent_qty'] = $postData['indent_qty_a'][$key];
                         }
                           if (!empty($postData['net_received'][$key])) {
                             $insertData1['net_received'] = $postData['net_received'][$key];
                         }
                           if (!empty($postData['unit_price_a'][$key])) {
                             $insertData1['unit_price'] = $postData['unit_price_a'][$key];
                         }
                         if (!empty($postData['receive_qty'][$key])) {
                             $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                         }
//                         if (!empty($postData['asset_id'][$key])) {
//                             $insertData1['asset_id'] = $postData['asset_id'][$key];
//                         }
                          if (!empty($postData['c_c_id'][$key])) {
                              $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                           }
                           if (!empty($postData['expected_date_a'][$key])) {
                             $insertData1['expected_date'] = date('Y-m-d',strtotime($postData['expected_date_a'][$key]));
                         }
                        $this->m_common->insert_row('ipo_material_indent_details', $insertData1); 
                     }
                }
                
                
                $array = array(
                // "employee_id" => $userData[0]['approver1'],
                 "employee_id" =>$approver[0],
                 "title" => "Requisition approval",
                 "notice" => "Please approve the requisition",
                 "create_date" => date('Y-m-d H:i:s'),
                 "date" => date('Y-m-d'),
                 "status" => "Unseen",
                 "url" =>"general_store/details_ipo_material_indent/".$id
               );
               $this->m_common->insert_row("notice", $array);
                
                redirect_with_msg('general_store/add_ipo_material_indent', 'Successfully Added this Material Indent');
            } else {
                redirect_with_msg('general_store/add_ipo_material_indent', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_ipo_material_indent', 'Please fill the form and submit');
        }
        
    }
    
    function edit_ipo_material_indent($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'ipo_material_indent';
        $companyId = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $this->titlebackend("Edit Ipo Material Indent");
        
        if($user_type==1){
            $data['departments'] = $this->m_common->get_row_array('department', '', '*');
        }else{
            $data['departments'] = $this->m_common->get_row_array('department',array('d_id'=>$companyId), '*'); 
        }
        $data['items'] = $this->m_common->get_row_array('items', '', '*');
        $data['suppliers'] = $this->m_common->get_row_array('supplier', '', '*');
      //  $data['assets'] = $this->m_common->get_row_array('assets', '', '*');
        $data['assets'] = $this->m_common->get_row_array('items',array('item_type'=>"Asset"), '*');
        $data['cost_centers'] = $this->m_common->get_row_array('cost_center','', '*');
        $data['ipo_material_indent'] = $this->m_common->get_row_array('ipo_material_indent',array('ipo_m_id'=>$id), '*');
        if(!empty($data['ipo_material_indent'][0]['ipo_item_type'])){
            $data['items'] = $this->m_common->get_row_array('items',array('item_type'=>$data['ipo_material_indent'][0]['ipo_item_type']), '*');
        }
        $data['ipo_material_indent_details'] = $this->m_common->get_row_array('ipo_material_indent_details', array('ipo_m_id' => $id), '*');
        $this->load->view('general_store/v_edit_ipo_material_indent',$data);
    }
    
     function details_ipo_material_indent($id,$print=false) {
        $this->menu = 'general_store';
        $this->sub_menu = 'ipo_material_indent';
        $this->titlebackend("Details Ipo Material Indent ");
        
        $companyId = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        
        if($user_type==1){
            $data['departments'] = $this->m_common->get_row_array('department', '', '*');
        }else{
            $data['departments'] = $this->m_common->get_row_array('department',array('d_id'=>$companyId), '*'); 
        }
        $data['items'] = $this->m_common->get_row_array('items', '', '*');
        $data['suppliers'] = $this->m_common->get_row_array('supplier', '', '*');
       // $data['assets'] = $this->m_common->get_row_array('assets', '', '*');
        $data['assets'] = $this->m_common->get_row_array('items',array('item_type'=>"Asset"), '*');
        $data['cost_centers'] = $this->m_common->get_row_array('cost_center','', '*');
      //  $data['ipo_material_indent'] = $this->m_common->get_row_array('ipo_material_indent',array('ipo_m_id'=>$id), '*');
        $data['ipo_material_indent'] = $this->m_common->get_row_array('v_ipo_material_indent',array('ipo_m_id'=>$id), '*');
        if(!empty($data['ipo_material_indent'][0]['employeeId'])){
            $approver = $this->m_common->get_row_array('users', array('employeeId' => $data['ipo_material_indent'][0]['employeeId']), '*');
            $data['approvers_info'] = fetch_approver(2, 7, $approver); //
            $data['ipo_material_indent_details'] = $this->m_common->get_row_array('v_ipo_material_indent_details', array('ipo_m_id' => $id), '*');

            if($print==false){
                $this->load->view('general_store/v_details_ipo_material_indent',$data);
            }else{
               foreach($data['ipo_material_indent_details'] as $key=>$indent_details){
                   $item_info=$this->m_common->get_row_array('items',array('id'=>$indent_details['item_id']), '*');
                   $data['ipo_material_indent_details'][$key]['item_name_description']=$item_info[0]['item_name'].",".$item_info[0]['port_no'].",".$item_info[0]['brand'];
               } 
               $html=$this->load->view('general_store/print_ipo_material_indent', $data,true);
               echo $html;exit; 
            }
        }else{
             redirect_with_msg('general_store/ipo_material_indent');
        }     
    }
    
    function edit_action_ipo_material_indent($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'ipo_material_indent';
        $this->titlebackend("Edit Ipo Material Indent");
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
            if(!empty($postData['ipo_number'])){
                $insertData['ipo_number'] = $postData['ipo_number']; 
            }
            
            if(!empty($postData['ipo_number'])){
                $insertData['ipo_number'] = $postData['ipo_number']; 
                $indent_no=$postData['ipo_number'];
            }
            if(!empty($postData['ipo_item_type'])){
                $insertData['ipo_item_type'] = $postData['ipo_item_type']; 
            }
            if(!empty($postData['date'])){
                $insertData['date'] =date('Y-m-d',strtotime($postData['date'])); 
                $indent_date=date('Y-m-d',strtotime($postData['date'])); 
            }
            if(!empty($postData['department_id'])){
                $insertData['department_id'] = $postData['department_id'];
                $depart_ment=$postData['department_id'];
            }
            if(!empty($postData['indent_memo'])){
                $insertData['indent_memo'] = $postData['indent_memo']; 
            }
            
            if(!empty($postData['status'])){
                $insertData['status'] = $postData['status']; 
            }
            
            if(!empty($postData['suplier_id'])){
                $insertData['suplier_id'] = $postData['suplier_id']; 
            }
            
            if(!empty($postData['inv_chalan'])){
                $insertData['inv_chalan'] = $postData['inv_chalan']; 
            }
            
            if(!empty($postData['procurement'])){
                $insertData['procurement'] = $postData['procurement']; 
            }
            
            if(!empty($postData['remarks'])){
                $insertData['remarks'] = $postData['remarks']; 
            }
            
            if(!empty($postData['indent_process_status'])){
                $insertData['indent_process_status'] = $postData['indent_process_status']; 
                $indent_process_status=$postData['indent_process_status']; 
            }
            $ipo_material_id=$this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$id),$insertData);
            $delete_details=$this->m_common->delete_row('ipo_material_indent_details',array('ipo_m_id'=>$id));
            if (!empty($ipo_material_id)) {
                 if($postData['ipo_item_type']=="Consumable"){
                    foreach ($postData['item_id'] as $key => $each) {
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['ipo_m_id'] = $id;
                     if(!empty($depart_ment)){
                        $insertData1['department_id'] = $depart_ment;
                     } 
                    if(!empty($indent_no)){
                        $insertData1['indent_no'] = $indent_no;
                    }
                    if(!empty($indent_date)){
                        $insertData1['indent_date'] = $indent_date;
                    } 
                    if($indent_process_status=="processed"){
                        $insertData1['status'] = "received";
                    }
                     if (!empty($postData['item_name_description'][$key])) {
                         $insertData1['item_name_description'] = $postData['item_name_description'][$key];
                     }
                     if (!empty($postData['unit'][$key])) {
                         $insertData1['unit'] = $postData['unit'][$key];
                     }
                     
                     if (!empty($postData['last_supplier'][$key])) {
                          $insertData1['last_supplier'] = $postData['last_supplier'][$key];
                     }
                        
                    if (!empty($postData['last_unit_price'][$key])) {
                         $insertData1['last_unit_price'] = $postData['last_unit_price'][$key];
                     } 
                   
                     
                    if (!empty($postData['stock_qty'][$key])) {
                         $insertData1['stock_qty'] = $postData['stock_qty'][$key];
                     }
                     if (!empty($postData['indent_qty'][$key])) {
                         $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                     }
                     if (!empty($postData['net_received'][$key])) {
                         $insertData1['net_received'] = $postData['net_received'][$key];
                     }
                     if (!empty($postData['unit_price'][$key])) {
                         $insertData1['unit_price'] = $postData['unit_price'][$key];
                     }
                     if (!empty($postData['receive_qty'][$key])) {
                         $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                     }
                     if (!empty($postData['ipo'][$key])) {
                         $insertData1['ipo'] = $postData['ipo'][$key];
                     }
                      if (!empty($postData['asset_id'][$key])) {
                              $insertData1['asset_id'] = $postData['asset_id'][$key];
                      }
                      if (!empty($postData['c_c_id'][$key])) {
                              $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                      }
                     
                     if (!empty($postData['expected_date'][$key])) {
                         $insertData1['expected_date'] = date('Y-m-d',strtotime($postData['expected_date'][$key]));
                     }
                    $this->m_common->insert_row('ipo_material_indent_details', $insertData1); 
                 }
                }else{
                        foreach ($postData['item_id_a'] as $key => $each) {
                         $insertData1=array();
                         $insertData1['item_id'] = $each;
                         $insertData1['ipo_m_id'] = $id;
                         if(!empty($depart_ment)){
                            $insertData1['department_id'] = $depart_ment;
                         } 
                        if(!empty($indent_no)){
                            $insertData1['indent_no'] = $indent_no;
                        }
                        if(!empty($indent_date)){
                            $insertData1['indent_date'] = $indent_date;
                        } 
                         if($indent_process_status=="processed"){
                            $insertData1['status'] = "received";
                         }
                         if (!empty($postData['item_name_description_a'][$key])) {
                             $insertData1['item_name_description'] = $postData['item_name_description_a'][$key];
                         }
                         if (!empty($postData['unit_a'][$key])) {
                             $insertData1['unit'] = $postData['unit_a'][$key];
                         }
                         
                        if (!empty($postData['last_supllier_a'][$key])) {
                            $insertData1['last_supplier'] = $postData['last_supllier_a'][$key];
                        }
                        
                       if (!empty($postData['last_unit_price_a'][$key])) {
                            $insertData1['last_unit_price'] = $postData['last_unit_price_a'][$key];
                        } 
                         
                           if (!empty($postData['stock_qty_a'][$key])) {
                             $insertData1['stock_qty'] = $postData['stock_qty_a'][$key];
                         }
                           if (!empty($postData['indent_qty_a'][$key])) {
                             $insertData1['indent_qty'] = $postData['indent_qty_a'][$key];
                         }
                           if (!empty($postData['net_received'][$key])) {
                             $insertData1['net_received'] = $postData['net_received'][$key];
                         }
                         if(!empty($postData['unit_price_a'][$key])) {
                             $insertData1['unit_price'] = $postData['unit_price_a'][$key];
                         }
                         
                         if(!empty($postData['receive_qty'][$key])) {
                             $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                         }
                         
                         if(!empty($postData['asset_id'][$key])) {
                             $insertData1['asset_id'] = $postData['asset_id'][$key];
                         }
                         
                         if(!empty($postData['c_c_id'][$key])) {
                              $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                         }
                         
                         if(!empty($postData['expected_date_a'][$key])) {
                             $insertData1['expected_date'] = date('Y-m-d',strtotime($postData['expected_date_a'][$key]));
                         }
                        $this->m_common->insert_row('ipo_material_indent_details', $insertData1); 
                     }
                }
                
                    redirect_with_msg('general_store/details_ipo_material_indent/'.$id, 'Successfully Updated this Ipo material Indent');
              
            }else{
                 if($postData['ipo_item_type']=="Consumable"){
                    foreach ($postData['item_id'] as $key => $each) {
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['ipo_m_id'] = $id;
                    if(!empty($depart_ment)){
                          $insertData1['department_id'] = $depart_ment;
                      } 
                      if(!empty($indent_no)){
                          $insertData1['indent_no'] = $indent_no;
                      }
                      if(!empty($indent_date)){
                          $insertData1['indent_date'] = $indent_date;
                      } 
                     if($indent_process_status=="processed"){
                        $insertData1['status'] = "received";
                    }
                    if(!empty($postData['item_name_description'][$key])) {
                         $insertData1['item_name_description'] = $postData['item_name_description'][$key];
                    }
                    
                    if(!empty($postData['unit'][$key])) {
                        $insertData1['unit'] = $postData['unit'][$key];
                    }
                     
                     if(!empty($postData['last_supplier'][$key])) {
                         $insertData1['last_supplier'] = $postData['last_supplier'][$key];
                     }
                        
                    if(!empty($postData['last_unit_price'][$key])) {
                         $insertData1['last_unit_price'] = $postData['last_unit_price'][$key];
                     } 
                     
                     if(!empty($postData['stock_qty'][$key])) {
                         $insertData1['stock_qty'] = $postData['stock_qty'][$key];
                     }
                     
                     if(!empty($postData['indent_qty'][$key])) {
                         $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                     }
                     
                     if(!empty($postData['net_received'][$key])) {
                         $insertData1['net_received'] = $postData['net_received'][$key];
                     }
                     
                     if(!empty($postData['unit_price'][$key])) {
                         $insertData1['unit_price'] = $postData['unit_price'][$key];
                     }
                       if (!empty($postData['receive_qty'][$key])) {
                         $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                     }
                     if (!empty($postData['ipo'][$key])) {
                         $insertData1['ipo'] = $postData['ipo'][$key];
                     }
                     
                     if (!empty($postData['asset_id'][$key])) {
                              $insertData1['asset_id'] = $postData['asset_id'][$key];
                      }
                       if (!empty($postData['c_c_id'][$key])) {
                              $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                       }
                     if (!empty($postData['expected_date'][$key])) {
                         $insertData1['expected_date'] = date('Y-m-d',strtotime($postData['expected_date'][$key]));
                     }
                    $this->m_common->insert_row('ipo_material_indent_details', $insertData1); 
                 }
                }else{
                        foreach ($postData['item_id_a'] as $key => $each) {
                         $insertData1=array();
                         $insertData1['item_id'] = $each;
                         $insertData1['ipo_m_id'] = $id;
                        if(!empty($depart_ment)){
                            $insertData1['department_id'] = $depart_ment;
                        } 
                        if(!empty($indent_no)){
                            $insertData1['indent_no'] = $indent_no;
                        }
                        if(!empty($indent_date)){
                            $insertData1['indent_date'] = $indent_date;
                        } 
                         if($indent_process_status=="processed"){
                            $insertData1['status'] = "received";
                         }
                         if(!empty($postData['item_name_description_a'][$key])) {
                             $insertData1['item_name_description'] = $postData['item_name_description_a'][$key];
                         }
                         
                         if(!empty($postData['unit_a'][$key])) {
                             $insertData1['unit'] = $postData['unit_a'][$key];
                         }
                         
                        if(!empty($postData['last_supllier_a'][$key])) {
                            $insertData1['last_supplier'] = $postData['last_supllier_a'][$key];
                        }
                        
                       if(!empty($postData['last_unit_price_a'][$key])) {
                            $insertData1['last_unit_price'] = $postData['last_unit_price_a'][$key];
                        } 
                         
                        if(!empty($postData['stock_qty_a'][$key])) {
                             $insertData1['stock_qty'] = $postData['stock_qty_a'][$key];
                        }
                        
                        if(!empty($postData['indent_qty_a'][$key])) {
                             $insertData1['indent_qty'] = $postData['indent_qty_a'][$key];
                        }
                           if (!empty($postData['net_received'][$key])) {
                             $insertData1['net_received'] = $postData['net_received'][$key];
                         }
                           if (!empty($postData['unit_price_a'][$key])) {
                             $insertData1['unit_price'] = $postData['unit_price_a'][$key];
                         }
                         if (!empty($postData['receive_qty'][$key])) {
                             $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                         }
                         if (!empty($postData['asset_id'][$key])) {
                             $insertData1['asset_id'] = $postData['asset_id'][$key];
                         }
                         if (!empty($postData['c_c_id'][$key])) {
                              $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                         }
                           if (!empty($postData['expected_date_a'][$key])) {
                             $insertData1['expected_date'] = date('Y-m-d',strtotime($postData['expected_date_a'][$key]));
                         }
                        $this->m_common->insert_row('ipo_material_indent_details', $insertData1); 
                     }
                }
                 redirect_with_msg('general_store/details_ipo_material_indent/'.$id, 'Successfully Updated this Ipo material Indent');
            }
        } else {
            redirect_with_msg('general_store/edit_ipo_material_indent/'.$id, 'Please fill the form and submit');
        }
    }
    
    function delete_ipo_material_indent($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'ipo_material_indent';
        $this->titlebackend("Ipo Material Indent");
         if (!empty($id)) {  
            $ids = $this->m_common->delete_row('ipo_material_indent', array('ipo_m_id' => $id));
            if (!empty($ids)) {
                $this->m_common->delete_row('ipo_material_indent_details', array('ipo_m_id' => $id));
                redirect_with_msg('general_store/ipo_material_indent', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/ipo_material_indent', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/ipo_material_indent', 'Please click on delete button');
        }
    }
    
    function forward_ipo_material_indent($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'ipo_material_indent';
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $indent_info = $this->m_common->get_row_array("ipo_material_indent", array('ipo_m_id' => $id), "*");
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $indent_info[0]['employeeId']), "*");
        $approver_data = fetch_approver(2, 7, $approvers_info); //
       
        if ($employee_id == $approver_data[0]) {
            //$this->m_common->update_row('leaves', array('id' => $id), array('status' => 'Forward-By-First-Approver', 'approver_id' => $approvers_info[0]['approver2'], 'approver_name' => $approver_name));
            $this->m_common->update_row('ipo_material_indent', array('ipo_m_id' => $id), array('status' => 'Forward-By-First-Approver', 'approver_id' => $approver_data[1], 'approver_name' => $approver_name));
            $array = array(
                "employee_id" => $approver_data[1],
                "title" => "Indent approval",
                "notice" => "Please approve the indent",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "general_store/details_ipo_material_indent/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        if ($employee_id == $approver_data[1]) {
            $this->m_common->update_row('ipo_material_indent', array('ipo_m_id' => $id), array('status' => 'Forward-By-Second-Approver', 'approver_id' => $approver_data[2], 'approver_name' => $approver_name));
            $array = array(
                "employee_id" => $approver_data[2],
                "title" => "Indent approval",
                "notice" => "Please approve the indent",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "general_store/details_ipo_material_indent/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        if ($employee_id == $approver_data[2]) {
            $this->m_common->update_row('ipo_material_indent', array('ipo_m_id' => $id), array('status' => 'Forward-By-Third-Approver', 'approver_id' => $approver_data[3], 'approver_name' => $approver_name));
            $array = array(
                "employee_id" => $approver_data[3],
                "title" => "Indent approval",
                "notice" => "Please approve the indent",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "general_store/details_ipo_material_indent/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        
        
        redirect_with_msg('general_store/ipo_material_indent', 'Forward Successfull');
    }
    
    function reject_ipo_material_indent($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'ipo_material_indent';
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $indent_info = $this->m_common->get_row_array("ipo_material_indent", array('ipo_m_id' => $id), "*");
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $indent_info[0]['employeeId']), "*");
        $approver_data = fetch_approver(2, 7, $approvers_info); //
        
         if($user_type ==1){
              
                    $this->m_common->update_row('ipo_material_indent', array('ipo_m_id' => $id), array('status' => 'Rejected', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" =>$indent_info[0]['employeeId'],
                        "title" => "Indent approval",
                        "notice" => "The indent is rejected by admin",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_ipo_material_indent/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
         }else{
             if ($employee_id == $approver_data[0]) {
         
                   
                    $this->m_common->update_row('ipo_material_indent', array('ipo_m_id' => $id), array('status' => 'Rejected', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" => $indent_info[0]['employeeId'],
                        "title" => "Indent approval",
                        "notice" => "The indent is rejected by first approver",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_ipo_material_indent/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
                }
                if ($employee_id == $approver_data[1]) {
                    $this->m_common->update_row('ipo_material_indent', array('ipo_m_id' => $id), array('status' => 'Rejected', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" => $indent_info[0]['employeeId'],
                        "title" => "Indent approval",
                        "notice" => "The indent is rejected by second approver",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_ipo_material_indent/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
                }
                if ($employee_id == $approver_data[2]) {
                    $this->m_common->update_row('ipo_material_indent', array('ipo_m_id' => $id), array('status' => 'Rejected', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" => $indent_info[0]['employeeId'],
                        "title" => "Indent approval",
                        "notice" => "The indent is rejected by third approver",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_ipo_material_indent/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
                }
         }       
        redirect_with_msg('general_store/ipo_material_indent', 'Successfully Rejected');
    }
    function approve_ipo_material_indent($id) {
        $test=$id;
        $this->menu = 'general_store';
        $this->sub_menu = 'ipo_material_indent';
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $indent_info = $this->m_common->get_row_array("ipo_material_indent", array('ipo_m_id' => $id), "*");
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $indent_info[0]['employeeId']), "*");
        $approver_data = fetch_approver(2, 7, $approvers_info); //
        
         if($user_type ==1){
              
                    $this->m_common->update_row('ipo_material_indent', array('ipo_m_id' => $id), array('status' => 'Approved', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" =>$indent_info[0]['employeeId'],
                        "title" => "Indent approval",
                        "notice" => "The indent is approved",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_ipo_material_indent/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
         }else{
             if ($employee_id == $approver_data[0]) {
         
                   
                    $this->m_common->update_row('ipo_material_indent', array('ipo_m_id' => $id), array('status' => 'Approved', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" =>$indent_info[0]['employeeId'],
                        "title" => "Indent approval",
                        "notice" => "The indent is approved",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_ipo_material_indent/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
                }
                if ($employee_id == $approver_data[1]) {
                    $this->m_common->update_row('ipo_material_indent', array('ipo_m_id' => $id), array('status' => 'Approved', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" =>$indent_info[0]['employeeId'],
                        "title" => "Indent approval",
                        "notice" => "The indent is approved",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_ipo_material_indent/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
                }
                if ($employee_id == $approver_data[2]) {
                    $this->m_common->update_row('ipo_material_indent', array('ipo_m_id' => $id), array('status' => 'Approved', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" =>$indent_info[0]['employeeId'],
                        "title" => "Indent approval",
                        "notice" => "The indent is approved",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" =>"general_store/details_ipo_material_indent/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
                }
                
                if ($employee_id == $approver_data[3]) {
                    $this->m_common->update_row('ipo_material_indent', array('ipo_m_id' => $id), array('status' => 'Approved', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" =>$indent_info[0]['employeeId'],
                        "title" => "Indent approval",
                        "notice" => "The indent is approved",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" =>"general_store/details_ipo_material_indent/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
                }
                
                
         }       
        redirect_with_msg('general_store/ipo_material_indent', 'Successfully  Approved');
    }
    
    
    
 //End IPO Material Indent     
    
 // Start Budget  
    
    function budget(){
        $this->menu = 'general_store';
      //  $this->sub_menu = 'budget';
        $this->sub_inner_menu = 'budget';
        $this->titlebackend("Budget");
      //  $data['budgets'] = $this->m_common->get_row_array('budget', '', '*');
        $sql="select * from budget where (b_status='pending' or b_status='partial_received'  )";
        $data['budgets'] = $this->m_common->customeQuery($sql);
        $this->load->view('general_store/v_budget',$data);
    }
    
    
    function add_budget(){
        $this->menu = 'general_store';
        $this->sub_menu = 'budget';
        $this->titlebackend("Budget");
        //$data['budget_items'] = $this->m_common->get_row_array('ipo_material_indent_details',array('status'=>'pending'), '*');
       // $sql="select * from ipo_material_indent_details where (budgeted_status='pending' or budgeted_status='partial_budgeted'  )";
       // $sql="select * from v_ipo_material_indent_details where (budgeted_status='pending' or budgeted_status='partial_budgeted'  )";
         $sql="select * from v_ipo_material_indent_details where indent_approve_status='Approved' and (budgeted_status='pending' or budgeted_status='partial_budgeted'  )";
        $data['budget_items'] = $this->m_common->customeQuery($sql);
        foreach( $data['budget_items'] as $key=>$budget_item){
            $data['budget_items'][$key]['indent_qty']=$budget_item['indent_qty']-$budget_item['net_budgeted_qty'];
            $item_code = $this->m_common->get_row_array('items',array('id'=>$budget_item['item_id']),'*');
            $data['budget_items'][$key]['item_code']=$item_code[0]['item_code'];
        }
        $budget_last_code=$this->m_common->get_row_array('budget_code',array('budget_type'=>"cash"),'*','',1,'id','DESC');
        if(!empty($budget_last_code)){
           
            $budget_code=$budget_last_code[0]['budget_code']+1;
            if($budget_code>999){
                $budget_sl_no=$budget_code;
            }else if($budget_code>99){
                $budget_sl_no="0".$budget_code;
            }else if($budget_code>9){
                $budget_sl_no="00".$budget_code;
            }else{
                $budget_sl_no="000".$budget_code;
            }
        }else{
            $budget_code=1;
            $budget_sl_no='0001';
        }
        $data['budget_code']=$budget_code;
        $data['budget_auto_code']=$budget_sl_no;
        $this->load->view('general_store/v_add_budget',$data);
    }
    
    
    
    function add_action_budget(){
        $this->menu = 'general_store';
        $this->sub_menu = 'budget';
        $this->titlebackend("Add Budget");
        $companyId = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
        $insertData['employeeId'] = $userData[0]['employeeId'];
        $approver =fetch_approver(2, 8, $userData);
        
        $postData = $this->input->post();
        $budget_code=$this->input->post('budget_code');
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
          
            
            if(!empty($postData['b_date'])){
                $insertData['b_date'] =date('Y-m-d',strtotime($postData['b_date'])); 
                $receive_date=date('Y-m-d',strtotime($postData['b_date'])); 
            }
          
            if(!empty($postData['b_type'])){
                $insertData['b_type'] = $postData['b_type']; 
                $b_type=$postData['b_type']; 
            }
            
            if(!empty($postData['b_no'])){
                $insertData['b_no'] = $postData['b_no']; 
                $b_no=$postData['b_no']; 
            }
            
            if(empty($postData['item_select'])){
                 redirect_with_msg('general_store/add_budget', 'Plese Select Item');
            }
            $insertData['approver_id'] = $approver[0];
            $insertData['b_approve_status'] ="Pending";
            $id = $this->m_common->insert_row('budget', $insertData);
            if (!empty($id)) {
                 $this->m_common->insert_row('budget_code', array('budget_code'=>$budget_code,'budget_type'=>$b_type));
                 foreach ($postData['item_id'] as $key => $each) {
                  
                     if(in_array($key,$postData['item_select'])){
                    
                                $insertData1=array();
                                $insertData1['item_id'] = $each;
                                $insertData1['b_id'] = $id;
                                $insertData1['b_no'] = $b_no;
                                $insertData1['b_date'] = $receive_date;
                                $insertData1['b_type'] =$b_type;
                                if (!empty($postData['asset_id'][$key])) {
                                    $insertData1['asset_id'] = $postData['asset_id'][$key];
                                }
                                if (!empty($postData['c_c_id'][$key])) {
                                    $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                                }
                                if (!empty($postData['department_id'][$key])) {
                                    $insertData1['department_id'] = $postData['department_id'][$key];
                                }
                                if (!empty($postData['department_name'][$key])) {
                                    $insertData1['department_name'] = $postData['department_name'][$key];
                                }
                                if(!empty($postData['indent_id'][$key])) {
                                    $insertData1['indent_id'] = $postData['indent_id'][$key];
                                    $indent_id= $postData['indent_id'][$key];
                                }
                                if(!empty($postData['indent_date'][$key])) {
                                    $insertData1['indent_date'] = $postData['indent_date'][$key];
                                }
                                if (!empty($postData['indent_d_id'][$key])) {
                                    $insertData1['indent_d_id'] = $postData['indent_d_id'][$key];
                                }
                                
                                if (!empty($postData['indent_no'][$key])) {
                                    $insertData1['indent_no'] = $postData['indent_no'][$key];
                                }

                               if (!empty($postData['item_code'][$key])) {
                                    $insertData1['item_code'] = $postData['item_code'][$key];
                                }
                                if (!empty($postData['item_name_description'][$key])) {
                                    $insertData1['item_description'] = $postData['item_name_description'][$key];
                                }
                                if (!empty($postData['unit'][$key])) {
                                    $insertData1['measurement_unit'] = $postData['unit'][$key];
                                }
                                if (!empty($postData['indent_qty'][$key])) {
                                    $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                                    $indent_qty=$postData['indent_qty'][$key];
                                }
                                if (!empty($postData['budget_qty'][$key])) {
                                    $insertData1['budget_qty'] = $postData['budget_qty'][$key];
                                    $budgeted_qty=$postData['budget_qty'][$key];
                                }
                                if (!empty($postData['unit_price'][$key])) {
                                    $insertData1['unit_price'] = $postData['unit_price'][$key];
                                }
                                if (!empty($postData['budget_value'][$key])) {
                                    $insertData1['budget_value'] = $postData['budget_value'][$key];
                                }
                                if (!empty($postData['net_budgeted_qty'][$key])) {
                                    $pre_net_budget_qty= $postData['net_budgeted_qty'][$key];
                                }else{
                                    $pre_net_budget_qty='';
                                }


                               $b=$this->m_common->insert_row('budget_details', $insertData1); 
                               if(!empty($b)){
                                   if($indent_qty==$budgeted_qty){
                                        $budget_status='budgeted';
                                        $net_budget_qty=$pre_net_budget_qty+$budgeted_qty;
                                        $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_id),array('budgeted_status'=>$budget_status,'net_budgeted_qty'=>$net_budget_qty));
                                        $sql="select * from v_ipo_material_indent_details where ipo_m_id=".$indent_id ." and (budgeted_status='pending' or budgeted_status='partial_budgeted'  )";
                                        $indent_items = $this->m_common->customeQuery($sql);
                                        if(empty($indent_items)){
                                            $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>$budget_status));
                                        }else{
                                             $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>"partial_budgeted"));
                                        }     
                                   }else{
                                       $budget_status='partial_budgeted'; 
                                       $net_budget_qty=$pre_net_budget_qty+$budgeted_qty;
                                       $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_id),array('budgeted_status'=>$budget_status,'net_budgeted_qty'=>$net_budget_qty));
                                       $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>$budget_status));
                                   }
                                 //  $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_id),array('status'=>$budget_status));
                               }
                     }
                     
                 }
                 
                $array = array(
                    // "employee_id" => $userData[0]['approver1'],
                     "employee_id" =>$approver[0],
                     "title" => "Budget approval",
                     "notice" => "Please approve the budget",
                     "create_date" => date('Y-m-d H:i:s'),
                     "date" => date('Y-m-d'),
                     "status" => "Unseen",
                     "url" =>"general_store/details_ipo_material_indent/".$id
                );
                $this->m_common->insert_row("notice", $array); 
                 
                redirect_with_msg('general_store/add_budget', 'Successfully  Added Material Budget ');
            } else {
                redirect_with_msg('general_store/add_budget', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_budget', 'Please fill the form and submit');
        }
    }
    
    
    function edit_budget($id){
        $this->menu = 'general_store';
        $this->sub_menu = 'budget';
        $this->titlebackend("Budget");
//        $data['budget_items'] = $this->m_common->get_row_array('ipo_material_indent_details',array('status'=>'pending'), '*');
//        foreach( $data['budget_items'] as $key=>$budget_item){
//            $item_code=$this->m_common->get_row_array('items',array('id'=>$budget_item['item_id']));
//            $data['budget_items'][$key]['item_code']=$item_code[0]['item_code'];
//        }
        $data['budgeted_items'] = $this->m_common->get_row_array('budget_details',array('b_id'=>$id), '*');
     
//        foreach( $data['budgeted_items'] as $bd){
//            $budgeted_items[]=$bd['indent_d_id'];
//        }
//        foreach($data['budget_items'] as $key=>$item){
//            if(in_array($item['id'],$budgeted_items)){
//                unset($data['budget_items'][$key]);
//            }
//            
//        }

        $data['budget_info'] = $this->m_common->get_row_array('budget',array('b_id'=>$id), '*');
        $this->load->view('general_store/v_edit_budget',$data);
    }
    
    
    
    
    
    function edit_action_budget($id){
        $this->menu = 'general_store';
        $this->sub_menu = 'budget';
        $this->titlebackend("Add Budget");
        $postData = $this->input->post();
       
        if (!empty($postData)) {
            $insertData = array();
              if(!empty($postData['b_no'])){
                $insertData['b_no'] = $postData['b_no']; 
                $b_no=$postData['b_no']; 
            }
            if(!empty($postData['b_date'])){
                $insertData['b_date'] =date('Y-m-d',strtotime($postData['b_date'])); 
                $receive_date=date('Y-m-d',strtotime($postData['b_date'])); 
            }
          
            if(!empty($postData['b_type'])){
                $insertData['b_type'] = $postData['b_type']; 
                $b_type=$postData['b_type']; 
            }
            
           
            
            if(empty($postData['item_select'])){
                 redirect_with_msg('general_store/add_budget', 'Plese Select Item');
            }
       
            $u_id = $this->m_common->update_row('budget',array('b_id'=>$id),$insertData);
            $delete_details=$this->m_common->delete_row('budget_details',array('b_id'=>$id));
            if (!empty($u_id)) {
                
                foreach ($postData['item_id'] as $key => $each) {
                  
                     if(in_array($key,$postData['item_select'])){
                    
                                $insertData1=array();
                                $insertData1['item_id'] = $each;
                                $insertData1['b_id'] = $id;
                                $insertData1['b_no'] = $b_no;
                                $insertData1['b_date'] = $receive_date;
                                $insertData1['b_type'] =$b_type;
                                if (!empty($postData['asset_id'][$key])) {
                                    $insertData1['asset_id'] = $postData['asset_id'][$key];
                                }
                               if (!empty($postData['c_c_id'][$key])) {
                                    $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                                }
                                if (!empty($postData['department_id'][$key])) {
                                    $insertData1['department_id'] = $postData['department_id'][$key];
                                }
                                if (!empty($postData['department_name'][$key])) {
                                    $insertData1['department_name'] = $postData['department_name'][$key];
                                }
                                
                                if(!empty($postData['indent_id'][$key])) {
                                    $insertData1['indent_id'] = $postData['indent_id'][$key];
                                    $indent_id= $postData['indent_id'][$key];
                                }
                                if(!empty($postData['indent_date'][$key])) {
                                    $insertData1['indent_date'] = $postData['indent_date'][$key];
                                }
                                if (!empty($postData['indent_d_id'][$key])) {
                                    $insertData1['indent_d_id'] = $postData['indent_d_id'][$key];
                                }

                               if (!empty($postData['item_code'][$key])) {
                                    $insertData1['item_code'] = $postData['item_code'][$key];
                                }
                                if (!empty($postData['item_name_description'][$key])) {
                                    $insertData1['item_description'] = $postData['item_name_description'][$key];
                                }
                                if (!empty($postData['unit'][$key])) {
                                    $insertData1['measurement_unit'] = $postData['unit'][$key];
                                }
                                if (!empty($postData['indent_qty'][$key])) {
                                    $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                                    $indent_qty=$postData['indent_qty'][$key];
                                }
                                if (!empty($postData['pre_budgeted_qty'][$key])) {
                                    
                                    $pre_budgeted_qty=$postData['pre_budgeted_qty'][$key];
                                }
                                if (!empty($postData['budget_qty'][$key])) {
                                    $insertData1['budget_qty'] = $postData['budget_qty'][$key];
                                    $budgeted_qty=$postData['budget_qty'][$key];
                                }
                                if (!empty($postData['unit_price'][$key])) {
                                    $insertData1['unit_price'] = $postData['unit_price'][$key];
                                }
                                if (!empty($postData['budget_value'][$key])) {
                                    $insertData1['budget_value'] = $postData['budget_value'][$key];
                                }
                             


                               $b=$this->m_common->insert_row('budget_details', $insertData1); 
                                if(!empty($b)){
                                   if($indent_qty==$budgeted_qty){
                                       $pre_net_budget_qty=$this->m_common->get_row_array('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_id),'*');
                                       $budget_status='budgeted';
                                       $net_budget_qty=$pre_net_budget_qty[0]['net_budgeted_qty']+$budgeted_qty-$pre_budgeted_qty;
                                       $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_id),array('budgeted_status'=>$budget_status,'net_budgeted_qty'=>$net_budget_qty));
                                        $sql="select * from v_ipo_material_indent_details where ipo_m_id=".$indent_id ." and (budgeted_status='pending' or budgeted_status='partial_budgeted'  )";
                                        $indent_items = $this->m_common->customeQuery($sql);
                                        if(empty($indent_items)){
                                            $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>$budget_status));
                                        }     
                                   }else{
                                       $pre_net_budget_qty=$this->m_common->get_row_array('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_id),'*');
                                       $budget_status='partial_budgeted'; 
                                       $net_budget_qty=$pre_net_budget_qty[0]['net_budgeted_qty']+$budgeted_qty-$pre_budgeted_qty;
                                       $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_id),array('budgeted_status'=>$budget_status,'net_budgeted_qty'=>$net_budget_qty));
                                       $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>$budget_status));
                                   }
                                 //  $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_id),array('status'=>$budget_status));
                               }
                     }else{
                          $item_id = $each;
                          $indent_id= $postData['indent_id'][$key];
                          $budgeted_qty=$postData['budget_qty'][$key];
                          $pre_net_budget_qty=$this->m_common->get_row_array('ipo_material_indent_details',array('item_id'=>$item_id,'ipo_m_id'=>$indent_id),'*');
                          $net_budgeted_qty=$pre_net_budget_qty[0]['net_budgeted_qty']-$budgeted_qty;
                          if($net_budgeted_qty>0){
                              $budget_status='partial_budgeted'; 
                          }else{
                              $budget_status='pending'; 
                          }
                          $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$item_id,'ipo_m_id'=>$indent_id),array('budgeted_status'=>$budget_status,'net_budgeted_qty'=>$net_budgeted_qty));
                          $sql="select * from v_ipo_material_indent_details where ipo_m_id=".$indent_id ." and  budgeted_status='partial_budgeted' ";
                          $partial_b_indent_items = $this->m_common->customeQuery($sql);
                          $sql="select * from v_ipo_material_indent_details where ipo_m_id=".$indent_id ." and  budgeted_status='budgeted' ";
                          $b_indent_items = $this->m_common->customeQuery($sql);
                          $sql="select * from v_ipo_material_indent_details where ipo_m_id=".$indent_id ." and  budgeted_status='pending' ";
                          $peding_indent_items = $this->m_common->customeQuery($sql);
                          if(!empty($partial_b_indent_items) && !empty($b_indent_items)){
                              $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>'partial_budgeted'));
                          }else if(!empty($peding_indent_items) && !empty($b_indent_items)){
                              $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>'partial_budgeted'));
                          }else if(!empty($partial_b_indent_items)){
                            $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>'partial_budgeted'));
                          }else{
                              $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>'pending'));
                          }
                        
                         
                         
                     }
                     
                 }
                redirect_with_msg('general_store/details_budget/'.$id, 'Successfully  Updated  Budget ');
            } else {
                  foreach ($postData['item_id'] as $key => $each) {
                  
                     if(in_array($key,$postData['item_select'])){
                    
                                $insertData1=array();
                                $insertData1['item_id'] = $each;
                                $insertData1['b_id'] = $id;
                                $insertData1['b_no'] =$b_no;
                                $insertData1['b_date'] = $receive_date;
                                $insertData1['b_type'] =$b_type;
                                if (!empty($postData['asset_id'][$key])) {
                                    $insertData1['asset_id'] = $postData['asset_id'][$key];
                                }
                                if (!empty($postData['c_c_id'][$key])) {
                                    $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                                }
                                if(!empty($postData['department_id'][$key])) {
                                    $insertData1['department_id'] = $postData['department_id'][$key];
                                }
                                if(!empty($postData['department_name'][$key])) {
                                    $insertData1['department_name'] = $postData['department_name'][$key];
                                }
                                if(!empty($postData['indent_id'][$key])) {
                                    $insertData1['indent_id'] = $postData['indent_id'][$key];
                                    $indent_id= $postData['indent_id'][$key];
                                }
                               if(!empty($postData['indent_date'][$key])) {
                                    $insertData1['indent_date'] = $postData['indent_date'][$key];
                                }
                                if (!empty($postData['indent_d_id'][$key])) {
                                    $insertData1['indent_d_id'] = $postData['indent_d_id'][$key];
                                }
                                if (!empty($postData['indent_no'][$key])) {
                                    $insertData1['indent_no'] = $postData['indent_no'][$key];
                                }

                               if (!empty($postData['item_code'][$key])) {
                                    $insertData1['item_code'] = $postData['item_code'][$key];
                                }
                                if (!empty($postData['item_name_description'][$key])) {
                                    $insertData1['item_description'] = $postData['item_name_description'][$key];
                                }
                                if (!empty($postData['unit'][$key])) {
                                    $insertData1['measurement_unit'] = $postData['unit'][$key];
                                }
                                if (!empty($postData['indent_qty'][$key])) {
                                    $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                                    $indent_qty=$postData['indent_qty'][$key];
                                }
                                if (!empty($postData['pre_budgeted_qty'][$key])) {   
                                    $pre_budgeted_qty=$postData['pre_budgeted_qty'][$key];
                                }
                                if (!empty($postData['budget_qty'][$key])) {
                                    $insertData1['budget_qty'] = $postData['budget_qty'][$key];
                                    $budgeted_qty=$postData['budget_qty'][$key];
                                }
                                if (!empty($postData['unit_price'][$key])) {
                                    $insertData1['unit_price'] = $postData['unit_price'][$key];
                                }
                                if (!empty($postData['budget_value'][$key])) {
                                    $insertData1['budget_value'] = $postData['budget_value'][$key];
                                }
                               

                               $b=$this->m_common->insert_row('budget_details', $insertData1); 
                                if(!empty($b)){
                                    if($indent_qty==$budgeted_qty){
                                       $pre_net_budget_qty=$this->m_common->get_row_array('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_id),'*');
                                       $budget_status='budgeted';
                                       $net_budget_qty=$pre_net_budget_qty[0]['net_budgeted_qty']+$budgeted_qty-$pre_budgeted_qty;
                                       $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_id),array('budgeted_status'=>$budget_status,'net_budgeted_qty'=>$net_budget_qty));
                                       $sql="select * from v_ipo_material_indent_details where ipo_m_id=".$indent_id ." and (budgeted_status='pending' or budgeted_status='partial_budgeted'  )";
                                       $indent_items = $this->m_common->customeQuery($sql);
                                       if(empty($indent_items)){
                                           $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>$budget_status));
                                       }     
                                   }else{
                                       $pre_net_budget_qty=$this->m_common->get_row_array('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_id),'*');
                                       $budget_status='partial_budgeted'; 
                                       $net_budget_qty=$pre_net_budget_qty[0]['net_budgeted_qty']+$budgeted_qty-$pre_budgeted_qty;
                                       $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_id),array('budgeted_status'=>$budget_status,'net_budgeted_qty'=>$net_budget_qty));
                                       $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>$budget_status));
                                   }
                                 //  $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_id),array('status'=>$budget_status));
                               }
                     }else{
                          $item_id = $each;
                          $indent_id= $postData['indent_id'][$key];
                          $budgeted_qty=$postData['budget_qty'][$key];
                          $pre_net_budget_qty=$this->m_common->get_row_array('ipo_material_indent_details',array('item_id'=>$item_id,'ipo_m_id'=>$indent_id),'*');
                          $net_budgeted_qty=$pre_net_budget_qty[0]['net_budgeted_qty']-$budgeted_qty;
                          if($net_budgeted_qty>0){
                              $budget_status='partial_budgeted'; 
                          }else{
                              $budget_status='pending'; 
                          }
                          $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$item_id,'ipo_m_id'=>$indent_id),array('budgeted_status'=>$budget_status,'net_budgeted_qty'=>$net_budgeted_qty));
                          $sql="select * from v_ipo_material_indent_details where ipo_m_id=".$indent_id ." and  budgeted_status='partial_budgeted' ";
                          $partial_b_indent_items = $this->m_common->customeQuery($sql);
                          $sql="select * from v_ipo_material_indent_details where ipo_m_id=".$indent_id ." and  budgeted_status='budgeted' ";
                          $b_indent_items = $this->m_common->customeQuery($sql);
                          $sql="select * from v_ipo_material_indent_details where ipo_m_id=".$indent_id ." and  budgeted_status='pending' ";
                          $peding_indent_items = $this->m_common->customeQuery($sql);
                          if(!empty($partial_b_indent_items) && !empty($b_indent_items)){
                             $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>'partial_budgeted'));
                          }else if(!empty($peding_indent_items) && !empty($b_indent_items)){
                             $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>'partial_budgeted'));
                          }else if(!empty($partial_b_indent_items)){
                             $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>'partial_budgeted'));
                        }else{
                             $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>'pending'));
                        }
                        
                         
                         
                     }
                     
                 }
                redirect_with_msg('general_store/details_budget/'.$id, 'Successfully  Updated  Budget ');
            }
        } else {
            redirect_with_msg('general_store/edit_budget/'.$id, 'Please fill the form and submit');
        }
    }
    
    
    
    function details_budget($id,$print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'budget';
        $this->titlebackend("Budget");
       
        $data['budgeted_items'] = $this->m_common->get_row_array('budget_details',array('b_id'=>$id), '*');
     
        $data['budget_info'] = $this->m_common->get_row_array('budget',array('b_id'=>$id), '*');
      //  $this->load->view('general_store/v_details_budget',$data);
          if($print==false){
                $this->load->view('general_store/v_details_budget',$data);
            }else{
               $html=$this->load->view('general_store/print_budget', $data,true);
               echo $html;exit; 
            }
    }
    
    function delete_budget($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'budget';
        $this->titlebackend("Budget");
         if (!empty($id)) {  
            $ids = $this->m_common->delete_row('budget', array('b_id' => $id));
            if (!empty($ids)) {
                $budget_items=$this->m_common->get_row_array('budget_details',array('b_id'=>$id),'item_id,indent_id,budget_qty');
                $this->m_common->delete_row('budget_details', array('b_id' => $id));
                foreach($budget_items as $b_item){
                       $item_id=$b_item['item_id'];
                       $indent_id=$b_item['indent_id'];
                       $pre_net_budget_qty=$this->m_common->get_row_array('ipo_material_indent_details',array('item_id'=>$b_item['item_id'],'ipo_m_id'=>$b_item['indent_id']),'*');
                       $net_budgeted_qty=$pre_net_budget_qty[0]['net_budgeted_qty']-$b_item['budget_qty'];
                        if($net_budgeted_qty>0){
                            $budget_status='partial_budgeted'; 
                        }else{
                            $budget_status='pending'; 
                        }
                        $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$item_id,'ipo_m_id'=>$indent_id),array('budgeted_status'=>$budget_status,'net_budgeted_qty'=>$net_budgeted_qty));
                        $sql="select * from v_ipo_material_indent_details where ipo_m_id=".$indent_id ." and  budgeted_status='partial_budgeted' ";
                        $partial_b_indent_items = $this->m_common->customeQuery($sql);
                        $sql="select * from v_ipo_material_indent_details where ipo_m_id=".$indent_id ." and  budgeted_status='budgeted' ";
                        $b_indent_items = $this->m_common->customeQuery($sql);
                        $sql="select * from v_ipo_material_indent_details where ipo_m_id=".$indent_id ." and  budgeted_status='pending' ";
                        $peding_indent_items = $this->m_common->customeQuery($sql);
                        if(!empty($partial_b_indent_items) && !empty($b_indent_items)){
                            $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>'partial_budgeted'));
                        }else if(!empty($peding_indent_items) && !empty($b_indent_items)){
                            $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>'partial_budgeted'));
                        }else if(!empty($partial_b_indent_items)){
                            $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>'partial_budgeted'));
                        }else{
                            $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_id),array('budgeted_status'=>'pending'));
                        }
                }       
                redirect_with_msg('general_store/budget', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/budget', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/budget', 'Please click on delete button');
        }
    }
    
    
    function forward_budget($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'ipo_material_indent';
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $budget_info = $this->m_common->get_row_array("budget", array('b_id' => $id), "*");
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $budget_info[0]['employeeId']), "*");
        $approver_data = fetch_approver(2, 8, $approvers_info); //
       
        if ($employee_id == $approver_data[0]) {
            //$this->m_common->update_row('leaves', array('id' => $id), array('status' => 'Forward-By-First-Approver', 'approver_id' => $approvers_info[0]['approver2'], 'approver_name' => $approver_name));
            $this->m_common->update_row('budget', array('b_id' => $id), array('b_approve_status' => 'Forward-By-First-Approver', 'approver_id' => $approver_data[1], 'approver_name' => $approver_name));
            $array = array(
                "employee_id" => $approver_data[1],
                "title" => "Budget approval",
                "notice" => "Please approve the budget",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "general_store/details_budget/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        if ($employee_id == $approver_data[1]) {
            $this->m_common->update_row('budget', array('b_id' => $id), array('b_approve_status' => 'Forward-By-Second-Approver', 'approver_id' => $approver_data[1], 'approver_name' => $approver_name));
            $array = array(
                "employee_id" => $approver_data[2],
                "title" => "Budget approval",
                "notice" => "Please approve the budget",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "general_store/details_budget/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        if ($employee_id == $approver_data[2]) {
            $this->m_common->update_row('budget', array('b_id' => $id), array('b_approve_status' => 'Forward-By-Third-Approver', 'approver_id' => $approver_data[1], 'approver_name' => $approver_name));
            $array = array(
                "employee_id" => $approver_data[3],
                "title" => "Budget approval",
                "notice" => "Please approve the budget",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "general_store/details_budget/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        
        
        redirect_with_msg('general_store/budget', 'Forward Successfull');
    }
    
    function reject_budget($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'ipo_material_indent';
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $budget_info = $this->m_common->get_row_array("budget", array('b_id' => $id), "*");
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $budget_info[0]['employeeId']), "*");
        $approver_data = fetch_approver(2, 8, $approvers_info); //
        
         if($user_type ==1){
              
                    $this->m_common->update_row('budget', array('b_id' => $id), array('b_approve_status' => 'Rejected', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" =>$budget_info[0]['employeeId'],
                        "title" => "Budget approval",
                        "notice" => "The budget is rejected by admin",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_budget/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
         }else{
             if ($employee_id == $approver_data[0]) {
         
                   
                    $this->m_common->update_row('budget', array('b_id' => $id), array('b_approve_status' => 'Rejected', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" =>$budget_info[0]['employeeId'],
                        "title" => "Budget approval",
                        "notice" => "The budget is rejected by admin",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_budget/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
                }
                if ($employee_id == $approver_data[1]) {
                    $this->m_common->update_row('budget', array('b_id' => $id), array('b_approve_status' => 'Rejected', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" =>$budget_info[0]['employeeId'],
                        "title" => "Budget approval",
                        "notice" => "The budget is rejected by admin",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_budget/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
                }
                if ($employee_id == $approver_data[2]) {
                    $this->m_common->update_row('budget', array('b_id' => $id), array('b_approve_status' => 'Rejected', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" =>$budget_info[0]['employeeId'],
                        "title" => "Budget approval",
                        "notice" => "The budget is rejected by admin",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_budget/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
                }
         }       
        redirect_with_msg('general_store/budget', 'Successfully Rejected');
    }
    function approve_budget($id) {
        $test=$id;
        $this->menu = 'general_store';
        $this->sub_menu = 'ipo_material_indent';
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $budget_info = $this->m_common->get_row_array("budget", array('b_id' => $id), "*");
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $budget_info[0]['employeeId']), "*");
        $approver_data = fetch_approver(2, 8, $approvers_info); //
        
         if($user_type ==1){
              
                    $this->m_common->update_row('budget', array('b_id' => $id), array('b_approve_status' => 'Approved', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" =>$budget_info[0]['employeeId'],
                        "title" => "Budget approval",
                        "notice" => "The budget is approved",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_budget/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
         }else{
             if ($employee_id == $approver_data[0]) {
         
                   
                    $this->m_common->update_row('budget', array('b_id' => $id), array('b_approve_status' => 'Approved', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" =>$budget_info[0]['employeeId'],
                        "title" => "Budget approval",
                        "notice" => "The budget is approved",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_budget/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
                }
                if ($employee_id == $approver_data[1]) {
                    $this->m_common->update_row('budget', array('b_id' => $id), array('b_approve_status' => 'Approved', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" =>$budget_info[0]['employeeId'],
                        "title" => "Budget approval",
                        "notice" => "The budget is approved",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_budget/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
                }
                if ($employee_id == $approver_data[2]) {
                    $this->m_common->update_row('budget', array('b_id' => $id), array('b_approve_status' => 'Approved', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" =>$budget_info[0]['employeeId'],
                        "title" => "Budget approval",
                        "notice" => "The budget is approved",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_budget/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
                }
                
                if ($employee_id == $approver_data[3]) {
                    $this->m_common->update_row('budget', array('b_id' => $id), array('b_approve_status' => 'Approved', 'approver_id' =>'', 'approver_name' => $approver_name));
                    $array = array(
                        "employee_id" =>$budget_info[0]['employeeId'],
                        "title" => "Budget approval",
                        "notice" => "The budget is approved",
                        "create_date" => date('Y-m-d H:i:s'),
                        "date" => date('Y-m-d'),
                        "status" => "Unseen",
                        "url" => "general_store/details_budget/".$id
                    );
                    $this->m_common->insert_row("notice", $array);
                }
                
                
         }       
        redirect_with_msg('general_store/budget', 'Successfully  Approved');
    }
    
    
 // End Budget
    
    
    
    
// Start Material Receive Requisition(MRR)  
     function material_receive_requisition() {
        $this->menu = 'general_store';
    //    $this->sub_menu = 'material_receive_requisition';
         $this->sub_inner_menu = 'material_receive_requisition';
        $this->titlebackend("Material Receive Requistion");
    //    $data['mrrs'] = $this->m_common->get_row_array('material_receive_requisition','','*','','','mrr_status','ASC');
        $sql="select * from material_receive_requisition ORDER BY mrr_status ASC ";
        $data['mrrs'] = $this->m_common->customeQuery($sql);
        $this->load->view('general_store/v_mrr',$data);
    }
    
    function add_material_receive_requisition() {
        $this->menu = 'general_store';
    //    $this->sub_menu = 'material_receive_requisition';
        $this->sub_inner_menu = 'material_receive_requisition';
        $this->titlebackend("Add Material Receive Requisition");
        $data['suppliers'] = $this->m_common->get_row_array('supplier', '', '*');
        $data['items'] = $this->m_common->get_row_array('items', '', '*');
       // $data['indents'] = $this->m_common->get_row_array('ipo_material_indent', '', '*');
      // $data['indents'] = $this->m_common->get_row_array('ipo_material_indent',array('indent_process_status'=>'applied'), '*');
       $data['budget_items'] = $this->m_common->get_row_array('budget_details',array('bu_d_status'=>'pending','b_type'=>'cash'), '*'); 
      //  $data['mrr_no']=$this->getRendVerCode(4);
        $mrr_last_code=$this->m_common->get_row_array('material_receive_code','','*','',1,'id','DESC');
        if(!empty($mrr_last_code)){
           
            $mrr_code=$mrr_last_code[0]['mrr_code']+1;
            if($mrr_code>999){
                $mrr_sl_no=$mrr_code;
            }else if($dep_code>99){
                $mrr_sl_no="0".$mrr_code;
            }else if($mrr_code>9){
                $mrr_sl_no="00".$mrr_code;
            }else{
                $mrr_sl_no="000".$mrr_code;
            }
        }else{
            $mrr_code=1;
            $mrr_sl_no='0001';
        }
        $data['mrr_code']=$mrr_code;
        $data['mrr_auto_code']=$mrr_sl_no;
       
        
        $this->load->view('general_store/v_add_mrr',$data);
    }
    
    function add_action_material_receive_requisition() {
        $this->menu = 'general_store';
        $this->sub_menu = 'material_receive_requisition';
        $this->titlebackend("Add Material Receive Requisition");
        $postData = $this->input->post();
        $mrr_code=$this->input->post('mrr_code');
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
            if(!empty($postData['mrr_no'])){
                $insertData['mrr_no'] = $postData['mrr_no']; 
            }
            
            if(!empty($postData['mrr_date'])){
                $insertData['mrr_date'] =date('Y-m-d',strtotime($postData['mrr_date'])); 
                $receive_date=date('Y-m-d',strtotime($postData['mrr_date'])); 
            }
            if(!empty($postData['memo_no'])){
                $insertData['memo_no'] = $postData['memo_no']; 
            }
            if(!empty($postData['memo_date'])){
                $insertData['memo_date'] =date('Y-m-d',strtotime($postData['memo_date'])); 
            }
            if(!empty($postData['mrr_type'])){
                $insertData['mrr_type'] = $postData['mrr_type']; 
            }
           if(!empty($postData['mrr_challan'])){
                $insertData['mrr_challan'] = $postData['mrr_challan']; 
            }
            if(!empty($postData['mrr_invoice'])){
                $insertData['mrr_invoice'] = $postData['mrr_invoice']; 
            }
            if(!empty($postData['mrr_challan_date'])){
                $insertData['mrr_challan_date'] =date('Y-m-d',strtotime($postData['mrr_challan_date'])); 
            }
           if(!empty($postData['mrr_procurement'])){
                $insertData['mrr_procurement'] = $postData['mrr_procurement']; 
            }
            if(!empty($postData['mrr_cash'])){
                $insertData['mrr_cash'] = $postData['mrr_cash']; 
            }
            if(!empty($postData['mrr_lc'])){
                $insertData['mrr_lc'] = $postData['mrr_lc']; 
            }
            if(!empty($postData['mrr_credit'])){
                $insertData['mrr_credit'] = $postData['mrr_credit']; 
            }
            if(!empty($postData['mrr_procurement_date'])){
                $insertData['mrr_procurement_date'] =date('Y-m-d',strtotime($postData['mrr_procurement_date'])); 
            }
            if(!empty($postData['mrr_qc_no'])){
                $insertData['mrr_qc_no'] = $postData['mrr_qc_no']; 
            }
            if(!empty($postData['mrr_qc_date'])){
                $insertData['mrr_qc_date'] =date('Y-m-d',strtotime($postData['mrr_qc_date'])); 
            }
            if(!empty($postData['mrr_ipo_no'])){
                $insertData['mrr_ipo_no'] = $postData['mrr_ipo_no']; 
            }
            if(!empty($postData['mrr_ipo_date'])){
                $insertData['mrr_ipo_date'] =date('Y-m-d',strtotime($postData['mrr_ipo_date'])); 
            }
            
            if(!empty($postData['mrr_remark'])){
                $insertData['mrr_remark'] = $postData['mrr_remark']; 
            }
           
            if(!empty($postData['mrr_supplier_id'])){
                $insertData['mrr_supplier_id'] = $postData['mrr_supplier_id']; 
                $supplier_id=$postData['mrr_supplier_id']; 
            }
            
            if(empty($postData['item_select'])){
                 redirect_with_msg('general_store/add_material_receive_requisition', 'Please Select Item');
            }
            
            $id = $this->m_common->insert_row('material_receive_requisition', $insertData);
            if (!empty($id)) {
                 $this->m_common->insert_row('material_receive_code', array('mrr_code'=>$mrr_code));
                 foreach ($postData['item_id'] as $key => $each) {
                      if(in_array($key,$postData['item_select'])){
                                $insertData1=array();
                                $insertData1['item_id'] = $each;
                                $insertData1['mrr_id'] = $id;
                                $insertData1['receive_date'] = $receive_date;
                                $insertData1['mrr_d_status'] = "applied";
                                if(!empty($supplier_id)){
                                     $insertData1['supplier_id'] = $supplier_id;
                                }
                                if (!empty($postData['department_id'][$key])) {
                                    $insertData1['department_id'] = $postData['department_id'][$key];
                                }
                                if (!empty($postData['asset_id'][$key])) {
                                    $insertData1['asset_id'] = $postData['asset_id'][$key];
                                }
                                if(!empty($postData['c_c_id'][$key])) {
                                    $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                                }
                                if (!empty($postData['indent_no'][$key])) {
                                    $insertData1['indent_no'] = $postData['indent_no'][$key];
                                }
                                if (!empty($postData['indent_id'][$key])) {
                                    $insertData1['indent_id'] = $postData['indent_id'][$key];
                                    $indent_id=$postData['indent_id'][$key];
                                }
                                
                               if (!empty($postData['b_no'][$key])) {
                                    $insertData1['b_no'] = $postData['b_no'][$key];
                               }
                                
                               if (!empty($postData['b_id'][$key])) {
                                    $insertData1['b_id'] = $postData['b_id'][$key];
                                    $b_id=$postData['b_id'][$key];
                                }   
                                if (!empty($postData['item_code'][$key])) {
                                    $insertData1['item_code'] = $postData['item_code'][$key];
                                }
                                if (!empty($postData['item_description'][$key])) {
                                    $insertData1['item_description'] = $postData['item_description'][$key];
                                }
                                if (!empty($postData['measurement_unit'][$key])) {
                                    $insertData1['measurement_unit'] = $postData['measurement_unit'][$key];
                                }
                                if (!empty($postData['indent_qty'][$key])) {
                                    $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                                }
                                if (!empty($postData['budget_qty'][$key])) {
                                    $insertData1['budget_qty'] = $postData['budget_qty'][$key];
                                }
                                if (!empty($postData['receive_qty'][$key])) {
                                    $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                                }
                                if (!empty($postData['unit_price'][$key])) {
                                    $insertData1['unit_price'] = $postData['unit_price'][$key];
                                }
                                if (!empty($postData['cf_cost'][$key])) {
                                    $insertData1['cf_cost'] = $postData['cf_cost'][$key];
                                }
                                if (!empty($postData['total_cost'][$key])) {
                                    $insertData1['total_cost'] = $postData['total_cost'][$key];
                                }
                                if (!empty($postData['remark'][$key])) {
                                    $insertData1['remark'] = $postData['remark'][$key];
                                }
                               $this->m_common->insert_row('material_receive_requisition_details', $insertData1); 
                               $this->m_common->update_row('budget_details',array('item_id'=>$each,'indent_id'=>$indent_id,'b_id'=>$b_id),array('bu_d_status'=>"received"));
                      }
                   
                 }
                redirect_with_msg('general_store/add_material_receive_requisition', 'Successfully  Added Material Receive Requistion');
            } else {
                redirect_with_msg('general_store/add_material_receive_requisition', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_material_receive_requisition', 'Please fill the form and submit');
        }
        
    }
    
    function edit_material_receive_requisition($id) {
        $this->menu = 'general_store';
         $this->sub_inner_menu = 'material_receive_requisition';
     
        $this->titlebackend("Edit Material Receive Requisition");
        $data['suppliers'] = $this->m_common->get_row_array('supplier', '', '*');
    
        $data['mrr'] = $this->m_common->get_row_array('material_receive_requisition',array('mrr_id'=>$id), '*');
        $data['budgeted_items'] = $this->m_common->get_row_array('material_receive_requisition_details',array('mrr_id'=>$id), '*');

        $this->load->view('general_store/v_edit_mrr',$data);
    }
    
    
     function details_material_receive_requisition($id,$print=false) {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'material_receive_requisition';
    //    $this->sub_menu = 'material_receive_requisition';
        $this->titlebackend("Details Material Receive Requisition ");
        $data['suppliers'] = $this->m_common->get_row_array('supplier', '', '*');
      
      //  $data['mrr'] = $this->m_common->get_row_array('material_receive_requisition',array('mrr_id'=>$id), '*');
        $data['mrr'] = $this->m_common->get_row_array('v_material_receive_requisition',array('mrr_id'=>$id), '*');
        $data['budgeted_items'] = $this->m_common->get_row_array('material_receive_requisition_details',array('mrr_id'=>$id), '*');
        if($print==false){
            $this->load->view('general_store/v_details_mrr',$data);
        }else{
            $html=$this->load->view('general_store/print_mrr',$data,true);
            echo $html;
            exit; 
        }
    }
    

    
     function receive_material_receive_requisition($id) {
       //  $material_receive_info=$this->m_common->get_row_array('material_receive_requisition',array('mrr_id'=>$id),'*');
        // $requisition_items=$this->m_common->get_row_array('material_receive_requisition_details',array('mrr_id'=>$id),'item_id,receive_qty');
         $requisition_items=$this->m_common->get_row_array('material_receive_requisition_details',array('mrr_id'=>$id),'*');
         foreach($requisition_items as $requisition_item){
             $item_info=$this->m_common->get_row_array('items',array('id'=>$requisition_item['item_id']),'stock_amount');
             $indent_info=$this->m_common->get_row_array('ipo_material_indent_details',array('item_id'=>$requisition_item['item_id'],'ipo_m_id'=>$requisition_item['indent_id']),'*');
             $received=$indent_info[0]['receive_qty']+$requisition_item['receive_qty'];
             $current_stock=$item_info[0]['stock_amount']+$requisition_item['receive_qty'];
             $this->m_common->update_row('items',array('id'=>$requisition_item['item_id']),array('stock_amount'=>$current_stock));
             $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$requisition_item['item_id'],'ipo_m_id'=>$requisition_item['indent_id']),array('receive_qty'=>$received,'status'=>"received"));
             $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$requisition_item['indent_id']),array('indent_process_status'=>"processed"));
             $this->m_common->update_row('budget_details',array('item_id'=>$requisition_item['item_id'],'indent_id'=>$requisition_item['indent_id'],'b_id'=>$requisition_item['b_id']),array('bu_d_status'=>"received"));
             $budget_details_item=$this->m_common->get_row_array('budget_details',array('b_id'=>$requisition_item['b_id'],'bu_d_status'=>"pending"),'*');
             if(!empty($budget_details_item)){
                 $this->m_common->update_row('budget',array('b_id'=>$requisition_item['b_id']),array('b_status'=>'partial_received'));
             }else{
                 $this->m_common->update_row('budget',array('b_id'=>$requisition_item['b_id']),array('b_status'=>'received'));
             }
         }
         $ids=$this->m_common->update_row('material_receive_requisition',array('mrr_id'=>$id),array('mrr_status'=>"received"));
         if(!empty($ids)){
            // $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$material_receive_info[0]['mrr_ipo_no']),array('indent_process_status'=>"processed"));
//             $this->m_common->update_row('ipo_material_indent_details',array('ipo_m_id'=>$material_receive_info[0]['mrr_ipo_no']),array('status'=>"received"));
//             
             $this->m_common->update_row('material_receive_requisition_details',array('mrr_id'=>$id),array('mrr_d_status'=>"received"));
             redirect_with_msg('general_store/material_receive_requisition', 'Successfully Received Material Receive Requisition');
         }else{
             redirect_with_msg('general_store/material_receive_requisition', 'Not Received Material Receive Requisition');
         }
     }
     
      function reject_material_receive_requisition($id) {
      //   $material_receive_info=$this->m_common->get_row_array('material_receive_requisition',array('mrr_id'=>$id),'*');
         $requisition_items=$this->m_common->get_row_array('material_receive_requisition_details',array('mrr_id'=>$id),'*');
         foreach($requisition_items as $requisition_item){
             $item_info=$this->m_common->get_row_array('items',array('id'=>$requisition_item['item_id']),'stock_amount');
             $indent_info=$this->m_common->get_row_array('ipo_material_indent_details',array('item_id'=>$requisition_item['item_id'],'ipo_m_id'=>$requisition_item['indent_id']),'*');
             $received=$indent_info[0]['receive_qty']-$requisition_item['receive_qty'];
             if($received>0){
                 $status="received";
             }else{
                 $status="pending";
                 
             }
             $current_stock=$item_info[0]['stock_amount']-$requisition_item['receive_qty'];
             $this->m_common->update_row('items',array('id'=>$requisition_item['item_id']),array('stock_amount'=>$current_stock));
             $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$requisition_item['item_id'],'ipo_m_id'=>$requisition_item['indent_id']),array('receive_qty'=>$received,'status'=>$status));
             $this->m_common->update_row('budget_details',array('item_id'=>$requisition_item['item_id'],'indent_id'=>$requisition_item['indent_id'],'b_id'=>$requisition_item['b_id']),array('bu_d_status'=>"pending"));
         }
         $ids=$this->m_common->update_row('material_receive_requisition',array('mrr_id'=>$id),array('mrr_status'=>"applied"));
         if(!empty($ids)){ 
             $this->m_common->update_row('material_receive_requisition_details',array('mrr_id'=>$id),array('mrr_d_status'=>"applied"));
             redirect_with_msg('general_store/material_receive_requisition', ' Rejected Material Receive Requisition');
         }else{
             redirect_with_msg('general_store/material_receive_requisition', 'Not Rejected Material Receive Requisition');
         }
     }
    
    function edit_action_material_receive_requisition($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'material_receive_requisition';
        $this->titlebackend("Edit Material Receive Requisition");
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
            if(!empty($postData['mrr_no'])){
                $insertData['mrr_no'] = $postData['mrr_no']; 
            }
           if(!empty($postData['mrr_status'])){
                $status = $postData['mrr_status']; 
            }
            
            if(!empty($postData['mrr_date'])){
                 $insertData['mrr_date'] =date('Y-m-d',strtotime($postData['mrr_date'])); 
                 $receive_date=date('Y-m-d',strtotime($postData['mrr_date'])); 
            }
            if(!empty($postData['memo_no'])){
                $insertData['memo_no'] = $postData['memo_no']; 
            }
            if(!empty($postData['memo_date'])){
                $insertData['memo_date'] =date('Y-m-d',strtotime($postData['memo_date'])); 
            }
           if(!empty($postData['mrr_type'])){
                $insertData['mrr_type'] = $postData['mrr_type']; 
            }
           if(!empty($postData['mrr_challan'])){
                $insertData['mrr_challan'] = $postData['mrr_challan']; 
            }
            if(!empty($postData['mrr_invoice'])){
                $insertData['mrr_invoice'] = $postData['mrr_invoice']; 
            }
            if(!empty($postData['mrr_challan_date'])){
                $insertData['mrr_challan_date'] =date('Y-m-d',strtotime($postData['mrr_challan_date'])); 
            }
           if(!empty($postData['mrr_procurement'])){
                $insertData['mrr_procurement'] = $postData['mrr_procurement']; 
            }
            if(!empty($postData['mrr_procurement_date'])){
                $insertData['mrr_procurement_date'] =date('Y-m-d',strtotime($postData['mrr_procurement_date'])); 
            }
             if(!empty($postData['mrr_cash'])){
                $insertData['mrr_cash'] = $postData['mrr_cash']; 
            }
            if(!empty($postData['mrr_lc'])){
                $insertData['mrr_lc'] = $postData['mrr_lc']; 
            }
            if(!empty($postData['mrr_credit'])){
                $insertData['mrr_credit'] = $postData['mrr_credit']; 
            }
            if(!empty($postData['mrr_qc_no'])){
                $insertData['mrr_qc_no'] = $postData['mrr_qc_no']; 
            }
            if(!empty($postData['mrr_qc_date'])){
                $insertData['mrr_qc_date'] =date('Y-m-d',strtotime($postData['mrr_qc_date'])); 
            }
            if(!empty($postData['mrr_ipo_no'])){
                $insertData['mrr_ipo_no'] = $postData['mrr_ipo_no']; 
            }
            if(!empty($postData['mrr_ipo_date'])){
                $insertData['mrr_ipo_date'] =date('Y-m-d',strtotime($postData['mrr_ipo_date'])); 
            }
            
            if(!empty($postData['mrr_remark'])){
                $insertData['mrr_remark'] = $postData['mrr_remark']; 
            }
           
            if(!empty($postData['mrr_supplier_id'])){
                $insertData['mrr_supplier_id'] = $postData['mrr_supplier_id']; 
                $supplier_id=$postData['mrr_supplier_id'];
            }
            
            if(empty($postData['item_select'])){
                 redirect_with_msg('general_store/edit_material_receive_requisition/'.$id, 'Plese Select Item');
            }
            
            $s_id=$this->m_common->update_row('material_receive_requisition',array('mrr_id'=>$id),$insertData);
            $delete_details=$this->m_common->delete_row('material_receive_requisition_details',array('mrr_id'=>$id));
            if (!empty($s_id)) {
                  foreach ($postData['item_id'] as $key => $each) {
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['mrr_id'] = $id;
                     $insertData1['receive_date'] = $receive_date;
                     if(!empty($status)){
                          $insertData1['mrr_d_status'] = $status;
                     }
                     if(!empty($supplier_id)){
                          $insertData1['supplier_id'] = $supplier_id;
                     }
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if (!empty($postData['asset_id'][$key])) {
                         $insertData1['asset_id'] = $postData['asset_id'][$key];
                     }
                     if(!empty($postData['c_c_id'][$key])) {
                        $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                    }
                    if (!empty($postData['indent_no'][$key])) {
                        $insertData1['indent_no'] = $postData['indent_no'][$key];
                    }
                    if (!empty($postData['indent_id'][$key])) {
                        $insertData1['indent_id'] = $postData['indent_id'][$key];
                    }
                    if (!empty($postData['b_no'][$key])) {
                        $insertData1['b_no'] = $postData['b_no'][$key];
                    }

                    if (!empty($postData['b_id'][$key])) {
                        $insertData1['b_id'] = $postData['b_id'][$key];
                    }   
                    if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_description'][$key])) {
                         $insertData1['item_description'] = $postData['item_description'][$key];
                     }
                     if (!empty($postData['measurement_unit'][$key])) {
                         $insertData1['measurement_unit'] = $postData['measurement_unit'][$key];
                     }
                     if (!empty($postData['indent_qty'][$key])) {
                         $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                     }
                    if (!empty($postData['budget_qty'][$key])) {
                        $insertData1['budget_qty'] = $postData['budget_qty'][$key];
                    }
                     if (!empty($postData['receive_qty'][$key])) {
                         $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                     }
                     if (!empty($postData['unit_price'][$key])) {
                         $insertData1['unit_price'] = $postData['unit_price'][$key];
                     }
                     if (!empty($postData['cf_cost'][$key])) {
                         $insertData1['cf_cost'] = $postData['cf_cost'][$key];
                     }
                     if (!empty($postData['total_cost'][$key])) {
                         $insertData1['total_cost'] = $postData['total_cost'][$key];
                     }
                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('material_receive_requisition_details', $insertData1);
                   
                 }
                
                    redirect_with_msg('general_store/details_material_receive_requisition/'.$id, 'Successfully Updated Material Receive Requisition');
              
            }else{
                  foreach ($postData['item_id'] as $key => $each) {
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['mrr_id'] = $id;
                     $insertData1['receive_date'] = $receive_date;
                     if(!empty($status)){
                          $insertData1['mrr_d_status'] = $status;
                     }
                     if(!empty($supplier_id)){
                         $insertData1['supplier_id'] = $supplier_id;
                     }
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if(!empty($postData['c_c_id'][$key])) {
                        $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                    }
                     if (!empty($postData['asset_id'][$key])) {
                         $insertData1['asset_id'] = $postData['asset_id'][$key];
                     }
                     if (!empty($postData['indent_no'][$key])) {
                        $insertData1['indent_no'] = $postData['indent_no'][$key];
                    }
                    if (!empty($postData['indent_id'][$key])) {
                        $insertData1['indent_id'] = $postData['indent_id'][$key];
                    }
                    if (!empty($postData['b_no'][$key])) {
                        $insertData1['b_no'] = $postData['b_no'][$key];
                    }

                    if (!empty($postData['b_id'][$key])) {
                        $insertData1['b_id'] = $postData['b_id'][$key];
                    }   
                     if (!empty($postData['item_description'][$key])) {
                         $insertData1['item_description'] = $postData['item_description'][$key];
                     }
                     if (!empty($postData['measurement_unit'][$key])) {
                         $insertData1['measurement_unit'] = $postData['measurement_unit'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['indent_qty'][$key])) {
                         $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                     }
                    if (!empty($postData['budget_qty'][$key])) {
                        $insertData1['budget_qty'] = $postData['budget_qty'][$key];
                    }
                     if (!empty($postData['receive_qty'][$key])) {
                         $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                     }
                     if (!empty($postData['unit_price'][$key])) {
                         $insertData1['unit_price'] = $postData['unit_price'][$key];
                     }
                     if (!empty($postData['cf_cost'][$key])) {
                         $insertData1['cf_cost'] = $postData['cf_cost'][$key];
                     }
                     if (!empty($postData['total_cost'][$key])) {
                         $insertData1['total_cost'] = $postData['total_cost'][$key];
                     }
                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('material_receive_requisition_details', $insertData1);
                  
                 }
                 redirect_with_msg('general_store/details_material_receive_requisition/'.$id, 'Successfully Updated Material Receive Requisition Info');
            }
        } else {
            redirect_with_msg('general_store/edit_material_receive_requisition/'.$id, 'Please fill the form and submit');
        }
    }
    
    function delete_material_receive_requisition($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'material_receive_requisition';
        $this->titlebackend("Material Receive Requisition");
         if (!empty($id)) {  
            $ids = $this->m_common->delete_row('material_receive_requisition', array('mrr_id' => $id));
            if(!empty($ids)) {
                $mrr_item_info=$this->m_common->get_row_array('material_receive_requisition_details', array('mrr_id' => $id),'*');
                $this->m_common->delete_row('material_receive_requisition_details', array('mrr_id' => $id));
                foreach($mrr_item_info as $mrr_item){
                    $item_id=$mrr_item['item_id'];
                    $indent_id=$mrr_item['indent_id'];
                    $b_id=$mrr_item['b_id'];        
                    $this->m_common->update_row('budget_details',array('item_id'=>$item_id,'indent_id'=>$indent_id,'b_id'=>$b_id),array('bu_d_status'=>"pending"));
                }
                redirect_with_msg('general_store/material_receive_requisition', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/material_receive_requisition', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/material_receive_requisition', 'Please click on delete button');
        }
    }
    
//End Material Receive Requisition(MRR)   
    
    
 //MR Return Receive Start
    function mrr_return_receive(){
        $this->menu = 'general_store';
     //   $this->sub_menu = 'mrr_return_receive';
        $this->sub_inner_menu = 'mrr_return_receive';
        $this->titlebackend("MRR Return Receive");
        $data['mrr_return_receives'] = $this->m_common->get_row_array('mrr_return_receive', '', '*');
        $this->load->view('general_store/v_mrr_return_receive',$data);
    }
    
      function add_mrr_return_receive(){
        $this->menu = 'general_store';
        //$this->sub_menu = 'material';
        $this->sub_inner_menu = 'mrr_return_receive';
        $this->titlebackend("MRR Return Receive");
        $data['mrr_return_numbers'] = $this->m_common->get_row_array('return_receive', '', '*');
        $mrr_last_code=$this->m_common->get_row_array('mrr_return_receive_code','','*','',1,'id','DESC');
        if(!empty($mrr_last_code)){
           
            $mrr_code=$mrr_last_code[0]['mrr_rr_code']+1;
            if($mrr_code>999){
                $mrr_sl_no=$mrr_code;
            }else if($mrr_code>99){
                $mrr_sl_no="0".$mrr_code;
            }else if($mrr_code>9){
                $mrr_sl_no="00".$mrr_code;
            }else{
                $mrr_sl_no="000".$mrr_code;
            }
        }else{
            $mrr_code=1;
            $mrr_sl_no='0001';
        }
        $data['mrr_rr_code']=$mrr_code;
        $data['mrr_rr_auto_code']=$mrr_sl_no;
        $this->load->view('general_store/v_add_mrr_return_receive',$data);
    }
    
     function add_action_mrr_return_receive(){
        $this->menu = 'general_store';
        $this->sub_menu = 'material';
        $this->titlebackend("MRR Return Receive");
        $postData = $this->input->post();
        $mrr_rr_code= $this->input->post('mrr_rr_code');
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
             if(!empty($postData['mrr_rr_no'])){
                $insertData['mrr_rr_no'] = $postData['mrr_rr_no']; 
            }
            if(!empty($postData['rr_date'])){
                $insertData['rr_date'] =date('Y-m-d',strtotime($postData['rr_date'])); 
               
            }
            if(!empty($postData['rr_id'])){
                $insertData['rr_id'] = $postData['rr_id']; 
            }
            
            if(!empty($postData['receive_date'])){
                $insertData['receive_date'] =date('Y-m-d',strtotime($postData['receive_date'])); 
                $receive_date=date('Y-m-d',strtotime($postData['receive_date'])); 
            }
          
            if(!empty($postData['remarks'])){
                $insertData['remarks'] = $postData['remarks']; 
            }
           
             $insertData['mrr_rr_status'] ='applied';
            
            
            
            $id = $this->m_common->insert_row('mrr_return_receive', $insertData);
            if (!empty($id)) {
                $this->m_common->insert_row('mrr_return_receive_code',array('mrr_rr_code'=>$mrr_rr_code));
                 foreach ($postData['item_id'] as $key => $each) {
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['mrr_rr_id'] = $id;
                     $insertData1['receive_date'] = $receive_date;
                     $insertData1['mrr_rr_d_status'] = 'applied';
                      if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if(!empty($postData['c_c_id'][$key])){
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     if (!empty($postData['asset_id'][$key])) {
                         $insertData1['asset_id'] = $postData['asset_id'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_description'][$key])) {
                         $insertData1['item_description'] = $postData['item_description'][$key];
                     }
                     if (!empty($postData['measurement_unit'][$key])) {
                         $insertData1['measurement_unit'] = $postData['measurement_unit'][$key];
                     }
                     if (!empty($postData['receive_qty'][$key])) {
                         $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                     }
                     if (!empty($postData['return_qty'][$key])) {
                         $insertData1['return_qty'] = $postData['return_qty'][$key];
                     }
                     if (!empty($postData['unit_price'][$key])) {
                         $insertData1['unit_price'] = $postData['unit_price'][$key];
                     }
                     if (!empty($postData['receive_value'][$key])) {
                         $insertData1['receive_value'] = $postData['receive_value'][$key];
                     }

                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('mrr_return_receive_details', $insertData1); 
                 }
                redirect_with_msg('general_store/add_mrr_return_receive', 'Successfully  Store Return');
            } else {
                redirect_with_msg('general_store/add_mrr_return_receive', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_mrr_return_receive', 'Please fill the form and submit');
        }
        
    }
    
    function edit_mrr_return_receive($id){
        $this->menu = 'general_store';
      //  $this->sub_menu = 'material';
        $this->sub_inner_menu = 'mrr_return_receive';
        $this->titlebackend("MRR Return Receive");
        $data['mrr_return_numbers'] = $this->m_common->get_row_array('return_receive', '', '*');
        $data['mrr_return_receive'] = $this->m_common->get_row_array('mrr_return_receive',array('mrr_rr_id'=>$id), '*');
        $data['items'] = $this->m_common->get_row_array('return_receive_details',array('rr_id'=>$data['mrr_return_receive'][0]['rr_id']), '*');
        $data['mrr_return_receive_details'] = $this->m_common->get_row_array('mrr_return_receive_details',array('mrr_rr_id'=>$id), '*');
        $this->load->view('general_store/v_edit_mrr_return_receive',$data);
    }
    
    function edit_action_mrr_return_receive($id){
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
            if(!empty($postData['mrr_rr_no'])){
                $insertData['mrr_rr_no'] = $postData['mrr_rr_no']; 
            }
            if(!empty($postData['mrr_rr_status'])){
                $mrr_status = $postData['mrr_rr_status']; 
            }
            
            if(!empty($postData['rr_date'])){
                $insertData['rr_date'] =date('Y-m-d',strtotime($postData['rr_date'])); 
               
            }
            if(!empty($postData['rr_id'])){
                $insertData['rr_id'] = $postData['rr_id']; 
            }
            
            if(!empty($postData['receive_date'])){
                $insertData['receive_date'] =date('Y-m-d',strtotime($postData['receive_date'])); 
                $receive_date=date('Y-m-d',strtotime($postData['receive_date'])); 
            }
          
            if(!empty($postData['remarks'])){
                $insertData['remarks'] = $postData['remarks']; 
            }
            
            $s_id=$this->m_common->update_row('mrr_return_receive',array('mrr_rr_id'=>$id),$insertData);
            $delete_details=$this->m_common->delete_row('mrr_return_receive_details',array('mrr_rr_id'=>$id));
            if (!empty($s_id)) {
                  foreach ($postData['item_id'] as $key => $each) {
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['mrr_rr_id'] = $id;
                     $insertData1['receive_date'] = $receive_date;
                     if (!empty($mrr_status)) {
                         $insertData1['mrr_rr_d_status'] =$mrr_status;
                     }
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if(!empty($postData['c_c_id'][$key])){
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     if (!empty($postData['asset_id'][$key])) {
                         $insertData1['asset_id'] = $postData['asset_id'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_description'][$key])) {
                         $insertData1['item_description'] = $postData['item_description'][$key];
                     }
                     if (!empty($postData['measurement_unit'][$key])) {
                         $insertData1['measurement_unit'] = $postData['measurement_unit'][$key];
                     }
                     if (!empty($postData['receive_qty'][$key])) {
                         $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                     }
                     if (!empty($postData['return_qty'][$key])) {
                         $insertData1['return_qty'] = $postData['return_qty'][$key];
                     }
                     if (!empty($postData['unit_price'][$key])) {
                         $insertData1['unit_price'] = $postData['unit_price'][$key];
                     }
                     if (!empty($postData['receive_value'][$key])) {
                         $insertData1['receive_value'] = $postData['receive_value'][$key];
                     }

                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('mrr_return_receive_details', $insertData1);
                 }
                
                    redirect_with_msg('general_store/details_mrr_return_receive/'.$id, 'Successfully Updated Material Receive Requisition');
              
            }else{
                  foreach ($postData['item_id'] as $key => $each) {
                  $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['mrr_rr_id'] = $id;
                     $insertData1['receive_date'] = $receive_date;
                     if (!empty($mrr_status)) {
                         $insertData1['mrr_rr_d_status'] =$mrr_status;
                     }
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if(!empty($postData['c_c_id'][$key])){
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     if (!empty($postData['asset_id'][$key])) {
                         $insertData1['asset_id'] = $postData['asset_id'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_description'][$key])) {
                         $insertData1['item_description'] = $postData['item_description'][$key];
                     }
                     if (!empty($postData['measurement_unit'][$key])) {
                         $insertData1['measurement_unit'] = $postData['measurement_unit'][$key];
                     }
                     if (!empty($postData['receive_qty'][$key])) {
                         $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                     }
                     if (!empty($postData['return_qty'][$key])) {
                         $insertData1['return_qty'] = $postData['return_qty'][$key];
                     }
                     if (!empty($postData['unit_price'][$key])) {
                         $insertData1['unit_price'] = $postData['unit_price'][$key];
                     }
                     if (!empty($postData['receive_value'][$key])) {
                         $insertData1['receive_value'] = $postData['receive_value'][$key];
                     }

                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('mrr_return_receive_details', $insertData1);
                 }
                 redirect_with_msg('general_store/details_mrr_return_receive/'.$id, 'Successfully Updated Material Receive Requisition Info');
            }
        } else {
            redirect_with_msg('general_store/edit_mrr_return_receive/'.$id, 'Please fill the form and submit');
        }
    }
    
    function details_mrr_return_receive($id,$print=false){
        $this->menu = 'general_store';
     //   $this->sub_menu = 'material';
        $this->sub_inner_menu = 'mrr_return_receive';
        $this->titlebackend("MRR Return Receive");
        $data['mrr_return_numbers'] = $this->m_common->get_row_array('return_receive', '', '*');
        $data['mrr_return_receive'] = $this->m_common->get_row_array('mrr_return_receive',array('mrr_rr_id'=>$id), '*');
        
//        $mrr_return_info= $this->m_common->get_row_array('return_receive',array('rr_id'=>$data['mrr_return_receive'][0]['mrr_rr_id']), '*');
//        $data['mrr_return_info']=$mrr_return_info;
//        $data['indent_info'] = $this->m_common->get_row_array('v_ipo_material_indent',array('ipo_m_id'=>$mrr_return_info[0]['issue_ipo_no']), '*');
        
        $data['items'] = $this->m_common->get_row_array('return_receive_details',array('rr_id'=>$data['mrr_return_receive'][0]['rr_id']), '*');
        $data['mrr_return_receive_details'] = $this->m_common->get_row_array('mrr_return_receive_details',array('mrr_rr_id'=>$id), '*');
      //  $this->load->view('general_store/v_details_mrr_return_receive',$data);
         if($print==false){
            $this->load->view('general_store/v_details_mrr_return_receive',$data);
        }else{
           $html=$this->load->view('general_store/print_mrr_return_receive', $data,true);
           echo $html;exit; 
        }
    }
    
     function delete_mrr_return_receive($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'material_receive_requisition';
       
         if (!empty($id)) {  
            $ids = $this->m_common->delete_row('mrr_return_receive', array('mrr_rr_id' => $id));
            if (!empty($ids)) {
                $this->m_common->delete_row('mrr_return_receive_details', array('mrr_rr_id' => $id));
                redirect_with_msg('general_store/mrr_return_receive', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/mrr_return_receive', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/mrr_return_receive', 'Please click on delete button');
        }
    }
    
    
   function receive_mrr_return_receive($id) {
         $issue_items=$this->m_common->get_row_array('mrr_return_receive_details',array('mrr_rr_id'=>$id),'item_id,receive_qty');
         foreach($issue_items as $issue_item){
             $item_info=$this->m_common->get_row_array('items',array('id'=>$issue_item['item_id']),'stock_amount');
             $current_stock=$item_info[0]['stock_amount']+$issue_item['receive_qty'];
             $this->m_common->update_row('items',array('id'=>$issue_item['item_id']),array('stock_amount'=>$current_stock));
         }
         $ids=$this->m_common->update_row('mrr_return_receive',array('mrr_rr_id'=>$id),array('mrr_rr_status'=>"received"));
         if(!empty($ids)){
             $this->m_common->update_row('mrr_return_receive_details',array('mrr_rr_id'=>$id),array('mrr_rr_d_status'=>"received"));
             redirect_with_msg('general_store/mrr_return_receive', 'Successfully MRR Receive');
         }else{
             redirect_with_msg('general_store/mrr_return_receive', 'Not Received MRR');
         }
     }
     
      function reject_mrr_return_receive($id) {
        $issue_items=$this->m_common->get_row_array('mrr_return_receive_details',array('mrr_rr_id'=>$id),'item_id,receive_qty');
         foreach($issue_items as $issue_item){
             $item_info=$this->m_common->get_row_array('items',array('id'=>$issue_item['item_id']),'stock_amount');
             $current_stock=$item_info[0]['stock_amount']-$issue_item['receive_qty'];
             $this->m_common->update_row('items',array('id'=>$issue_item['item_id']),array('stock_amount'=>$current_stock));
         }
         $ids=$this->m_common->update_row('mrr_return_receive',array('mrr_rr_id'=>$id),array('mrr_rr_status'=>"not received"));
         if(!empty($ids)){
             $this->m_common->update_row('mrr_return_receive_details',array('mrr_rr_id'=>$id),array('mrr_rr_d_status'=>"not received"));
             redirect_with_msg('general_store/mrr_return_receive', ' MRR Not Received');
         }else{
             redirect_with_msg('general_store/mrr_return_receive', 'Not Received MRR');
         }
     }
     
    
    
    
    
    //MR Return Receive End
    
    
    
  
    // Start Delivery Session  
     function issue_session() {
        $this->menu = 'general_store';
        //$this->sub_menu = 'issue_session';
        $this->sub_inner_menu = 'issue_session';
        $this->titlebackend("Issue Session");
        $data['issue_sessions'] = $this->m_common->get_row_array('issue_session', '', '*');
//        $sql="Select * from issue_session order by issue_status DESC ";
//        $data['issue_sessions'] = $this->m_common->customeQuery($sql);
        $this->load->view('general_store/v_issue',$data);
    }
    
    function add_issue_session() {
        $this->menu = 'general_store';
      //  $this->sub_menu = 'issue_session';
        $this->sub_inner_menu = 'issue_session';
        $this->titlebackend("Add Issue Session");
        $data['departments'] = $this->m_common->get_row_array('department', '', '*');
        $data['items'] = $this->m_common->get_row_array('items', '', '*');
       // $data['issue_no']=$this->getRendVerCode(4);
     //   $data['indents'] = $this->m_common->get_row_array('ipo_material_indent', '', '*');
       // $data['indents'] = $this->m_common->get_row_array('ipo_material_indent',array('indent_process_status'=>"processed"), '*');
      //  $data['indents'] = $this->m_common->get_row_array('v_ipo_material_indent',array('indent_process_status'=>"processed"), '*');
        $data['indents'] = $this->m_common->get_row_array('v_ipo_material_indent',array('indent_process_status'=>"processed",'ipo_item_type'=>'Consumable'), '*');
        $issue_last_code=$this->m_common->get_row_array('issue_code','','*','',1,'id','DESC');
        if(!empty($issue_last_code)){
           
            $issue_code=$issue_last_code[0]['issue_code']+1;
            if($issue_code>999){
                $issue_sl_no=$issue_code;
            }else if($issue_code>99){
                $issue_sl_no="0".$issue_code;
            }else if($issue_code>9){
                $issue_sl_no="00".$issue_code;
            }else{
                $issue_sl_no="000".$issue_code;
            }
        }else{
            $issue_code=1;
            $issue_sl_no='0001';
        }
        $data['issue_code']=$issue_code;
        $data['issue_auto_code']=$issue_sl_no;
        
        $this->load->view('general_store/v_add_issue',$data);
    }
    
    function add_action_issue_session() {
        $this->menu = 'general_store';
       // $this->sub_menu = 'issue_session';
        $this->sub_inner_menu = 'issue_session';
        $this->titlebackend("Add Issue Session");
        $postData = $this->input->post();
        if (!empty($postData)) {
            $issue_code=$postData['issue_code']; 
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
            if(!empty($postData['issue_no'])){
                $insertData['issue_no'] = $postData['issue_no']; 
            }
            
            if(!empty($postData['issue_date'])){
                $insertData['issue_date'] =date('Y-m-d',strtotime($postData['issue_date'])); 
                $issue_date=date('Y-m-d',strtotime($postData['issue_date'])); 
            }
            if(!empty($postData['issue_ipo_no'])){
                $insertData['issue_ipo_no'] = $postData['issue_ipo_no']; 
                $indent_no=$postData['issue_ipo_no']; 
            }
            if(!empty($postData['issue_ipo_date'])){
                $insertData['issue_ipo_date'] =date('Y-m-d',strtotime($postData['issue_ipo_date'])); 
            }
            
           if(!empty($postData['dep_name'])){
                $insertData['dep_name'] = $postData['dep_name']; 
            }
          
//           if(!empty($postData['cur_strock'])){
//                $insertData['cur_strock'] = $postData['cur_strock']; 
//            }
//           
//             if(!empty($postData['cur_value'])){
//                $insertData['cur_value'] = $postData['cur_value']; 
//            }
            
            if(!empty($postData['isssue_remark'])){
                $insertData['isssue_remark'] = $postData['isssue_remark']; 
            }
            
            if(!empty($postData['issue_type'])){
                $insertData['issue_type'] = $postData['issue_type']; 
                $issue_type=$postData['issue_type']; 
            }
            
            if(!empty($postData['delivery_no'])){
                $insertData['delivery_no'] = $postData['delivery_no'];
                $delivery_no=$postData['delivery_no']; 
            }
           
           
            
            $id = $this->m_common->insert_row('issue_session', $insertData);
            if (!empty($id)) {
                $this->m_common->insert_row('issue_code',array('issue_code'=>$issue_code));
                $i=0;
                 foreach ($postData['item_id'] as $key => $each) {
                     $item_info=$this->m_common->get_row_array('items',array('id'=>$each),'*');
                     $indent_item_info=$this->m_common->get_row_array('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_no),'*');
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['indent_id'] = $indent_no;
                     $insertData1['issue_id'] = $id;
                     $insertData1['issue_date'] = $issue_date;
                    // $insertData1['issue_status'] = 'applied';
                     $insertData1['issue_status'] = 'issued';
                     if(!empty($issue_type)){
                         $insertData1['issue_type'] = $issue_type;
                     }
                     
                     if(!empty($delivery_no)){
                         $insertData1['delivery_no'] = $delivery_no;
                     }
                     
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if(!empty($postData['c_c_id'][$key])) {
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     if (!empty($postData['asset_id'][$key])) {
                         $insertData1['asset_id'] = $postData['asset_id'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_name_des'][$key])) {
                         $insertData1['item_name_des'] = $postData['item_name_des'][$key];
                     }
                     if(!empty($postData['issue_m_unit'][$key])) {
                         $insertData1['issue_m_unit'] = $postData['issue_m_unit'][$key];
                     }
                     if(!empty($postData['indent_qty'][$key])) {
                         $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                         $indent_qty=$postData['indent_qty'][$key];
                     }
                     if (!empty($postData['stock_qty'][$key])) {
                         $insertData1['stock_qty'] = $postData['stock_qty'][$key];
                     }
                     if (!empty($postData['issue_qty'][$key])) {
                         $insertData1['issue_quality'] = $postData['issue_qty'][$key];
                         $issue_qty=$postData['issue_qty'][$key];
                     }
                    
                    if(!empty($postData['mrr_qty'][$key])) {
                         $insertData1['mrr_qty'] = $postData['mrr_qty'][$key];
                         $mrr_qty=$postData['mrr_qty'][$key];
                    }
                     
                     if (!empty($postData['issue_unit_price'][$key])) {
                         $insertData1['issue_unit_price'] = $postData['issue_unit_price'][$key];
                     }
                     if (!empty($postData['issue_value'][$key])) {
                         $insertData1['issue_value'] = $postData['issue_value'][$key];
                     }
                     if (!empty($postData['issue_t_code'][$key])) {
                         $insertData1['issue_t_code'] = $postData['issue_t_code'][$key];
                     }
                     if (!empty($postData['issue_d_remark'][$key])) {
                         $insertData1['issue_d_remark'] = $postData['issue_d_remark'][$key];
                     }
                     
                     if($mrr_qty==$issue_qty){
                         if($issue_qty==$indent_qty){
                              $status='issued';
                         }else{
                             $status='pending';
                             $i=1;
                         }
                         
                     }else{
                         $status='received';
                         $i=2;
                     }
                     $current_stock=$item_info[0]['stock_amount']-$issue_qty;
                     $receive=$indent_item_info[0]['receive_qty']-$issue_qty;
                     $issued=$indent_item_info[0]['issued_qty']+$issue_qty;            
                     $this->m_common->insert_row('issue_session_details', $insertData1); 
                     $this->m_common->update_row('items',array('id'=>$each),array('stock_amount'=>$current_stock));
                     $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_no),array('receive_qty'=>$receive,'issued_qty'=>$issued));
                 }
                  if(!empty($i)){
                     if($i==1){ 
                         $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_no),array('indent_process_status'=>'partial_issued'));
                     }else{
                         $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_no),array('indent_process_status'=>'processed'));
                     }
                 }else{
                    $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_no),array('indent_process_status'=>'issued')); 
                 }
                redirect_with_msg('general_store/add_issue_session', 'Successfully  Added Issue Info');
            } else {
                redirect_with_msg('general_store/add_issue_session', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_issue_session', 'Please fill the form and submit');
        }
        
    }
    
    function edit_issue_session($id) {
        $this->menu = 'general_store';
     //   $this->sub_menu = 'issue_session';
        $this->sub_inner_menu = 'issue_session';
        $this->titlebackend("Edit Material Receive Requisition");
        $data['departments'] = $this->m_common->get_row_array('department', '', '*');
      //  $data['items'] = $this->m_common->get_row_array('items', '', '*');
       // $data['indents'] = $this->m_common->get_row_array('ipo_material_indent', '', '*');
      //  $data['indents'] = $this->m_common->get_row_array('v_ipo_material_indent','', '*');
    //    $data['indents'] = $this->m_common->get_row_array('v_ipo_material_indent',array('indent_process_status'=>"processed",'ipo_item_type'=>'Consumable'), '*');
        $sql="select * from v_ipo_material_indent where (indent_process_status='processed' or indent_process_status='issued' or indent_process_status='partial_issued') and ipo_item_type='Consumable'  ";
        $data['indents'] =$this->m_common->customeQuery($sql);
        $data['issue'] = $this->m_common->get_row_array('issue_session',array('issue_id'=>$id), '*');
        $data['items'] = $this->m_common->get_row_array('v_ipo_material_indent_details',array('ipo_m_id'=>$data['issue'][0]['issue_ipo_no']), '*');
        $data['issue_details'] = $this->m_common->get_row_array('issue_session_details', array('issue_id' => $id), '*');
        $this->load->view('general_store/v_edit_issue',$data);
    }
    
    function details_issue_session($id,$print=false) {
        $this->menu = 'general_store';
      //  $this->sub_menu = 'issue_session';
         $this->sub_inner_menu = 'issue_session';
        $this->titlebackend("Details Material Receive Requisition ");
       // $data['departments'] = $this->m_common->get_row_array('department', '', '*');
       // $data['indents'] = $this->m_common->get_row_array('ipo_material_indent', '', '*');
        $data['indents'] = $this->m_common->get_row_array('v_ipo_material_indent','', '*');
        $data['issue'] = $this->m_common->get_row_array('issue_session',array('issue_id'=>$id), '*');
        $data['indent_info'] = $this->m_common->get_row_array('v_ipo_material_indent',array('ipo_m_id'=>$data['issue'][0]['issue_ipo_no']), '*');
        $data['items'] = $this->m_common->get_row_array('v_ipo_material_indent_details',array('ipo_m_id'=>$data['issue'][0]['issue_ipo_no']), '*');
        $data['issue_details'] = $this->m_common->get_row_array('issue_session_details', array('issue_id' => $id), '*');
      // $this->load->view('general_store/v_details_issue',$data);
        if($print==false){
            $this->load->view('general_store/v_details_issue',$data);
        }else{
           $html=$this->load->view('general_store/print_issue', $data,true);
           echo $html;exit; 
        }
    }
    
    function edit_action_issue_session($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'material_receive_requisition';
        $this->titlebackend("Edit Material Issue");
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
            if(!empty($postData['issue_status'])){
                $issue_status = $postData['issue_status']; 
            }
            if(!empty($postData['issue_no'])){
                $insertData['issue_no'] = $postData['issue_no']; 
            }
            
            if(!empty($postData['issue_date'])){
                $insertData['issue_date'] =date('Y-m-d',strtotime($postData['issue_date'])); 
                $issue_date=date('Y-m-d',strtotime($postData['issue_date'])); 
            }
            if(!empty($postData['issue_ipo_no'])){
                $insertData['issue_ipo_no'] = $postData['issue_ipo_no']; 
                $indent_no=$postData['issue_ipo_no']; 
            }
            if(!empty($postData['issue_ipo_date'])){
                $insertData['issue_ipo_date'] =date('Y-m-d',strtotime($postData['issue_ipo_date'])); 
            }
            
            if(!empty($postData['dep_name'])){
                $insertData['dep_name'] = $postData['dep_name']; 
            }
                 
            if(!empty($postData['isssue_remark'])){
                $insertData['isssue_remark'] = $postData['isssue_remark']; 
            }
            
            if(!empty($postData['issue_type'])){
                $insertData['issue_type'] = $postData['issue_type']; 
                $issue_type=$postData['issue_type']; 
            }
            
            if(!empty($postData['delivery_no'])){
                $insertData['delivery_no'] = $postData['delivery_no'];
                $delivery_no=$postData['delivery_no']; 
            }
            
            $s_id=$this->m_common->update_row('issue_session',array('issue_id'=>$id),$insertData);
            $delete_details=$this->m_common->delete_row('issue_session_details',array('issue_id'=>$id));
            if (!empty($s_id)) {
                  $i=0;
                  foreach ($postData['item_id'] as $key => $each) {
                     $item_info=$this->m_common->get_row_array('items',array('id'=>$each),'*');
                     $indent_item_info=$this->m_common->get_row_array('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_no),'*');
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['indent_id'] = $indent_no;
                     $insertData1['issue_id'] = $id;
                     $insertData1['issue_date'] = $issue_date;
                     if(!empty($issue_status)){
                         $insertData1['issue_status'] = $issue_status;
                     }
                      if(!empty($issue_type)){
                         $insertData1['issue_type'] = $issue_type;
                     }
                     
                     if(!empty($delivery_no)){
                         $insertData1['delivery_no'] = $delivery_no;
                     }
                      if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                      if(!empty($postData['c_c_id'][$key])) {
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     if (!empty($postData['asset_id'][$key])) {
                         $insertData1['asset_id'] = $postData['asset_id'][$key];
                     } 
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_name_des'][$key])) {
                         $insertData1['item_name_des'] = $postData['item_name_des'][$key];
                     }
                     if (!empty($postData['issue_m_unit'][$key])) {
                         $insertData1['issue_m_unit'] = $postData['issue_m_unit'][$key];
                     }
                     if (!empty($postData['indent_qty'][$key])) {
                         $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                         $indent_qty=$postData['indent_qty'][$key];
                     }
                     if (!empty($postData['stock_qty'][$key])) {
                         $insertData1['stock_qty'] = $postData['stock_qty'][$key];
                     }
                    if (!empty($postData['mrr_qty'][$key])) {
                         $insertData1['mrr_qty'] = $postData['mrr_qty'][$key];
                         $mrr_qty=$postData['mrr_qty'][$key];
                    }
                    if (!empty($postData['pre_issue_qty'][$key])) {
                         $pre_issue_qty = $postData['pre_issue_qty'][$key];
                    }
                    if (!empty($postData['issue_qty'][$key])) {
                         $insertData1['issue_quality'] = $postData['issue_qty'][$key];
                         $issue_qty=$postData['issue_qty'][$key];
                    }
                     if (!empty($postData['issue_unit_price'][$key])) {
                         $insertData1['issue_unit_price'] = $postData['issue_unit_price'][$key];
                     }
                     if (!empty($postData['issue_value'][$key])) {
                         $insertData1['issue_value'] = $postData['issue_value'][$key];
                     }
                     if (!empty($postData['issue_t_code'][$key])) {
                         $insertData1['issue_t_code'] = $postData['issue_t_code'][$key];
                     }
                     if (!empty($postData['issue_d_remark'][$key])) {
                         $insertData1['issue_d_remark'] = $postData['issue_d_remark'][$key];
                     }
                      
                       if($mrr_qty==$issue_qty){
                         if($issue_qty==$indent_qty){
                              $status='issued';
                         }else{
                             $status='pending';
                             $i=1;
                         }
                         
                     }else{
                         $status='received';
                         $i=2;
                     } 
                     $current_stock=$item_info[0]['stock_amount']-$issue_qty+$pre_issue_qty;
                     $receive=$indent_item_info[0]['receive_qty']-$issue_qty+$pre_issue_qty;
                     $issued=$indent_item_info[0]['issued_qty']+$issue_qty-$pre_issue_qty;            
                     $this->m_common->insert_row('issue_session_details', $insertData1); 
                     $this->m_common->update_row('items',array('id'=>$each),array('stock_amount'=>$current_stock));
                     $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_no),array('receive_qty'=>$receive,'issued_qty'=>$issued));
                 }
                 
                  if(!empty($i)){
                     if($i==1){ 
                         $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_no),array('indent_process_status'=>'partial_issued'));
                     }else{
                         $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_no),array('indent_process_status'=>'processed'));
                     }
                 }else{
                    $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_no),array('indent_process_status'=>'issued')); 
                 }
                
                 redirect_with_msg('general_store/details_issue_session/'.$id, 'Successfully Updated Issue');
              
            }else{
                  $i=0;
                  foreach ($postData['item_id'] as $key => $each) {
                     $item_info=$this->m_common->get_row_array('items',array('id'=>$each),'*');
                     $indent_item_info=$this->m_common->get_row_array('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_no),'*');
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['indent_id'] = $indent_no;
                     $insertData1['issue_id'] = $id;
                     $insertData1['issue_date'] = $issue_date;
                     if(!empty($issue_status)){
                         $insertData1['issue_status'] = $issue_status;
                     }
                     if(!empty($issue_type)){
                         $insertData1['issue_type'] = $issue_type;
                     }
                     
                     if(!empty($delivery_no)){
                         $insertData1['delivery_no'] = $delivery_no;
                     }
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if(!empty($postData['c_c_id'][$key])) {
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     if (!empty($postData['asset_id'][$key])) {
                         $insertData1['asset_id'] = $postData['asset_id'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_name_des'][$key])) {
                         $insertData1['item_name_des'] = $postData['item_name_des'][$key];
                     }
                     if (!empty($postData['issue_m_unit'][$key])) {
                         $insertData1['issue_m_unit'] = $postData['issue_m_unit'][$key];
                     }
                     if (!empty($postData['indent_qty'][$key])) {
                         $insertData1['indent_qty'] = $postData['indent_qty'][$key];
                         $indent_qty=$postData['indent_qty'][$key];
                     }
                     if (!empty($postData['stock_qty'][$key])) {
                         $insertData1['stock_qty'] = $postData['stock_qty'][$key];
                     }
                     if (!empty($postData['mrr_qty'][$key])) {
                         $insertData1['mrr_qty'] = $postData['mrr_qty'][$key];
                         $mrr_qty=$postData['mrr_qty'][$key];
                     }
                     if(!empty($postData['pre_issue_qty'][$key])) {
                         $pre_issue_qty = $postData['pre_issue_qty'][$key];
                    }
                     if (!empty($postData['issue_qty'][$key])) {
                         $insertData1['issue_quality'] = $postData['issue_qty'][$key];
                         $issue_qty=$postData['issue_qty'][$key];
                     }
                     if (!empty($postData['issue_unit_price'][$key])) {
                         $insertData1['issue_unit_price'] = $postData['issue_unit_price'][$key];
                     }
                     if (!empty($postData['issue_value'][$key])) {
                         $insertData1['issue_value'] = $postData['issue_value'][$key];
                     }
                     if (!empty($postData['issue_t_code'][$key])) {
                         $insertData1['issue_t_code'] = $postData['issue_t_code'][$key];
                     }
                     if (!empty($postData['issue_d_remark'][$key])) {
                         $insertData1['issue_d_remark'] = $postData['issue_d_remark'][$key];
                     }
                     
                    if($mrr_qty==$issue_qty){
                         if($issue_qty==$indent_qty){
                              $status='issued';
                         }else{
                             $status='pending';
                             $i=1;
                         }
                         
                     }else{
                         $status='received';
                         $i=2;
                     }
                     $current_stock=$item_info[0]['stock_amount']-$issue_qty+$pre_issue_qty;
                     $receive=$indent_item_info[0]['receive_qty']-$issue_qty+$pre_issue_qty;
                     $issued=$indent_item_info[0]['issued_qty']+$issue_qty-$pre_issue_qty;            
                     $this->m_common->insert_row('issue_session_details', $insertData1); 
                     $this->m_common->update_row('items',array('id'=>$each),array('stock_amount'=>$current_stock));
                     $this->m_common->update_row('ipo_material_indent_details',array('item_id'=>$each,'ipo_m_id'=>$indent_no),array('receive_qty'=>$receive,'issued_qty'=>$issued));
                 }
                 if(!empty($i)){
                     if($i==1){ 
                         $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_no),array('indent_process_status'=>'partial_issued'));
                     }else{
                         $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_no),array('indent_process_status'=>'processed'));
                     }
                 }else{
                    $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$indent_no),array('indent_process_status'=>'issued')); 
                 }
                 redirect_with_msg('general_store/details_issue_session/'.$id, 'Successfully Updated Issue Info');
            }
        } else {
            redirect_with_msg('general_store/edit_issue_session/'.$id, 'Please fill the form and submit');
        }
    }
    
    function delete_issue_session($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'issue_session';
        $this->titlebackend("Material Receive Requisition");
         if (!empty($id)) {  
            $ids = $this->m_common->delete_row('issue_session', array('issue_id' => $id));
            if (!empty($ids)) {
                $this->m_common->delete_row('issue_session_details', array('issue_id' => $id));
                redirect_with_msg('general_store/issue_session', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/issue_session', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/issue_session', 'Please click on delete button');
        }
    }
    
    
    
      function issued_material_indent($id) {
         $issue_info=$this->m_common->get_row_array('issue_session',array('issue_id'=>$id),'*');
         
         $issue_items=$this->m_common->get_row_array('issue_session_details',array('issue_id'=>$id),'item_id,issue_quality');
         foreach($issue_items as $issue_item){
             $item_info=$this->m_common->get_row_array('items',array('id'=>$issue_item['item_id']),'stock_amount');
             $current_stock=$item_info[0]['stock_amount']-$issue_item['issue_quality'];
             $this->m_common->update_row('items',array('id'=>$issue_item['item_id']),array('stock_amount'=>$current_stock));
         }
         $ids=$this->m_common->update_row('issue_session',array('issue_id'=>$id),array('issue_status'=>"issued"));
         if(!empty($ids)){
             $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$issue_info[0]['issue_ipo_no']),array('indent_process_status'=>"issued"));
             
             $this->m_common->update_row('issue_session_details',array('issue_id'=>$id),array('issue_status'=>"issued"));
             redirect_with_msg('general_store/issue_session', 'Successfully Issued Material Indent');
         }else{
             redirect_with_msg('general_store/issue_session', 'Not Issued Material Indent');
         }
     }
     
      function reject_material_indent($id) {
       
        $issue_info=$this->m_common->get_row_array('issue_session',array('issue_id'=>$id),'*');
          
        $issue_items=$this->m_common->get_row_array('issue_session_details',array('issue_id'=>$id),'item_id,issue_quality');
         foreach($issue_items as $issue_item){
             $item_info=$this->m_common->get_row_array('items',array('id'=>$issue_item['item_id']),'stock_amount');
             $current_stock=$item_info[0]['stock_amount']+$issue_item['issue_quality'];
             $this->m_common->update_row('items',array('id'=>$issue_item['item_id']),array('stock_amount'=>$current_stock));
         }
         $ids=$this->m_common->update_row('issue_session',array('issue_id'=>$id),array('issue_status'=>"rejected"));
         if(!empty($ids)){
              $this->m_common->update_row('ipo_material_indent',array('ipo_m_id'=>$issue_info[0]['issue_ipo_no']),array('indent_process_status'=>"processed"));
              
              $this->m_common->update_row('issue_session_details',array('issue_id'=>$id),array('issue_status'=>"rejected"));
             redirect_with_msg('general_store/issue_session', 'Successfully Rejected Material Indent');
         }else{
             redirect_with_msg('general_store/issue_session', 'Not Rejected Material Indent');
         }
     }
    
    
    
    
    
    
//End Delivery Session    
    
    
    
    
    
 //Start Store Return
    
    function store_return() {
        $this->menu = 'general_store';
       // $this->sub_menu = 'store_return';
        $this->sub_inner_menu = 'store_return';
        $this->titlebackend("Store Return");
        $data['store_returns'] = $this->m_common->get_row_array('return_receive', '', '*');
        $this->load->view('general_store/v_store_return',$data);
    }
    
    function add_store_return() {
        $this->menu = 'general_store';
      //  $this->sub_menu = 'store_return';
        $this->sub_inner_menu = 'store_return';
        $this->titlebackend("Add Return Receive");
        $data['receive_numbers'] = $this->m_common->get_row_array('material_receive_requisition','','*');
        $rr_last_code=$this->m_common->get_row_array('return_receive_code','','*','',1,'id','DESC');
        if(!empty($rr_last_code)){
           
            $rr_code=$rr_last_code[0]['rr_code']+1;
            if($rr_code>999){
                $rr_sl_no=$rr_code;
            }else if($ir_code>99){
                $rr_sl_no="0".$rr_code;
            }else if($ir_code>9){
                $rr_sl_no="00".$rr_code;
            }else{
                $rr_sl_no="000".$rr_code;
            }
        }else{
            $rr_code=1;
            $rr_sl_no='0001';
        }
        $data['rr_code']=$rr_code;
        $data['rr_auto_code']=$rr_sl_no;
        
        $this->load->view('general_store/v_add_store_return',$data);
    }
    
    function add_action_store_return() {
        $this->menu = 'general_store';
    //    $this->sub_menu = 'store_return';
         $this->sub_inner_menu = 'store_return';
        $this->titlebackend("Add Store Return");
        $postData = $this->input->post();
        $rr_code= $this->input->post('rr_code');
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
             if(!empty($postData['rr_no'])){
                $insertData['rr_no'] = $postData['rr_no']; 
            }
            if(!empty($postData['rr_date'])){
                $insertData['rr_date'] =date('Y-m-d',strtotime($postData['rr_date'])); 
                $return_date=date('Y-m-d',strtotime($postData['rr_date'])); 
            }
            if(!empty($postData['receive_no'])){
                $insertData['receive_no'] = $postData['receive_no']; 
            }
            
            if(!empty($postData['receive_date'])){
                $insertData['receive_date'] =date('Y-m-d',strtotime($postData['receive_date'])); 
            }
          
            if(!empty($postData['remarks'])){
                $insertData['remarks'] = $postData['remarks']; 
            }
           
            
            
            
            $id = $this->m_common->insert_row('return_receive', $insertData);
            if (!empty($id)) {
                $this->m_common->insert_row('return_receive_code',array('rr_code'=>$rr_code));
                 foreach ($postData['item_id'] as $key => $each) {
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['rr_id'] = $id;
                     $insertData1['rr_date'] = $return_date;
                     $insertData1['rr_d_status'] = 'applied';
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if(!empty($postData['c_c_id'][$key])) {
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     if(!empty($postData['asset_id'][$key])) {
                         $insertData1['asset_id'] = $postData['asset_id'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_description'][$key])) {
                         $insertData1['item_description'] = $postData['item_description'][$key];
                     }
                     if (!empty($postData['measurement_unit'][$key])) {
                         $insertData1['measurement_unit'] = $postData['measurement_unit'][$key];
                     }
                     if (!empty($postData['receive_qty'][$key])) {
                         $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                     }
                     if (!empty($postData['return_qty'][$key])) {
                         $insertData1['return_qty'] = $postData['return_qty'][$key];
                     }
                     if (!empty($postData['unit_price'][$key])) {
                         $insertData1['unit_price'] = $postData['unit_price'][$key];
                     }
                     if (!empty($postData['return_value'][$key])) {
                         $insertData1['return_value'] = $postData['return_value'][$key];
                     }
//                     if (!empty($postData['cf_cost'][$key])) {
//                         $insertData1['cf_cost'] = $postData['cf_cost'][$key];
//                     }
//                     if (!empty($postData['total_cost'][$key])) {
//                         $insertData1['total_cost'] = $postData['total_cost'][$key];
//                     }
                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('return_receive_details', $insertData1); 
                 }
                redirect_with_msg('general_store/store_return', 'Successfully  Store Return');
            } else {
                redirect_with_msg('general_store/add_store_return', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_store_return', 'Please fill the form and submit');
        }
        
    }
    
    function edit_store_return($id) {
        $this->menu = 'general_store';
     //   $this->sub_menu = 'store_return';
         $this->sub_inner_menu = 'store_return';
        $this->titlebackend("Edit Store Return");
        
        $data['receive_numbers'] = $this->m_common->get_row_array('material_receive_requisition','','*');
        $data['return_receive'] = $this->m_common->get_row_array('return_receive',array('rr_id'=>$id), '*');
        $data['items'] = $this->m_common->get_row_array('material_receive_requisition_details',array('mrr_id'=>$data['return_receive'][0]['receive_no']), '*');
        $data['return_receive_details'] = $this->m_common->get_row_array('return_receive_details', array('rr_id' => $id), '*');
        $this->load->view('general_store/v_edit_store_return',$data);
    }
    
     function details_store_return($id) {
        $this->menu = 'general_store';
       // $this->sub_menu = 'store_return';
        $this->sub_inner_menu = 'store_return';
        $this->titlebackend("Details Store Return ");
        $data['receive_numbers'] = $this->m_common->get_row_array('material_receive_requisition','','*');
        $data['return_receive'] = $this->m_common->get_row_array('return_receive',array('rr_id'=>$id), '*');
        $data['items'] = $this->m_common->get_row_array('material_receive_requisition_details',array('mrr_id'=>$data['return_receive'][0]['receive_no']), '*');
        $data['return_receive_details'] = $this->m_common->get_row_array('return_receive_details', array('rr_id' => $id), '*');
        $this->load->view('general_store/v_details_store_return',$data);
    }
    
    function edit_action_store_return($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'store_return';
        $this->titlebackend("Edit Store Return");
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
             if(!empty($postData['rr_no'])){
                $insertData['rr_no'] = $postData['rr_no']; 
            }
            if(!empty($postData['rr_date'])){
                $insertData['rr_date'] =date('Y-m-d',strtotime($postData['rr_date'])); 
                $return_date=date('Y-m-d',strtotime($postData['rr_date'])); 
            }
            if(!empty($postData['rr_status'])){
                $rr_status = $postData['rr_status']; 
            }
            
            if(!empty($postData['receive_no'])){
                $insertData['receive_no'] = $postData['receive_no']; 
            }
            
            if(!empty($postData['receive_date'])){
                $insertData['receive_date'] =date('Y-m-d',strtotime($postData['receive_date'])); 
            }
          
            if(!empty($postData['remarks'])){
                $insertData['remarks'] = $postData['remarks']; 
            }
            $s_id=$this->m_common->update_row('return_receive',array('rr_id'=>$id),$insertData);
            $delete_details=$this->m_common->delete_row('return_receive_details',array('rr_id'=>$id));
            if (!empty($s_id)) {
                  foreach ($postData['item_id'] as $key => $each) {
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['rr_id'] = $id;
                     $insertData1['rr_date'] = $return_date;
                     if(!empty($rr_status)) {
                         $insertData1['rr_d_status'] =$rr_status;
                     }
                     if(!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if(!empty($postData['c_c_id'][$key])) {
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     if(!empty($postData['asset_id'][$key])) {
                         $insertData1['asset_id'] = $postData['asset_id'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_description'][$key])) {
                         $insertData1['item_description'] = $postData['item_description'][$key];
                     }
                     if (!empty($postData['measurement_unit'][$key])) {
                         $insertData1['measurement_unit'] = $postData['measurement_unit'][$key];
                     }
                     if (!empty($postData['receive_qty'][$key])) {
                         $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                     }
                     if (!empty($postData['return_qty'][$key])) {
                         $insertData1['return_qty'] = $postData['return_qty'][$key];
                     }
                     if (!empty($postData['unit_price'][$key])) {
                         $insertData1['unit_price'] = $postData['unit_price'][$key];
                     }
                     if (!empty($postData['return_value'][$key])) {
                         $insertData1['return_value'] = $postData['return_value'][$key];
                     }
//                     if (!empty($postData['cf_cost'][$key])) {
//                         $insertData1['cf_cost'] = $postData['cf_cost'][$key];
//                     }
//                     if (!empty($postData['total_cost'][$key])) {
//                         $insertData1['total_cost'] = $postData['total_cost'][$key];
//                     }
                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('return_receive_details', $insertData1);
                 }
                
                    redirect_with_msg('general_store/details_store_return/'.$id, 'Successfully Updated Store Return Info');
              
            }else{
                  foreach ($postData['item_id'] as $key => $each) {
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['rr_id'] = $id;
                     $insertData1['rr_date'] = $return_date;
                     if (!empty($rr_status)) {
                         $insertData1['rr_d_status'] =$rr_status;
                     }
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if(!empty($postData['c_c_id'][$key])) {
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     
                     if (!empty($postData['asset_id'][$key])) {
                         $insertData1['asset_id'] = $postData['asset_id'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_description'][$key])) {
                         $insertData1['item_description'] = $postData['item_description'][$key];
                     }
                     if (!empty($postData['measurement_unit'][$key])) {
                         $insertData1['measurement_unit'] = $postData['measurement_unit'][$key];
                     }
                     if (!empty($postData['receive_qty'][$key])) {
                         $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                     }
                     if (!empty($postData['return_qty'][$key])) {
                         $insertData1['return_qty'] = $postData['return_qty'][$key];
                     }
                     if (!empty($postData['unit_price'][$key])) {
                         $insertData1['unit_price'] = $postData['unit_price'][$key];
                     }
                     if (!empty($postData['return_value'][$key])) {
                         $insertData1['return_value'] = $postData['return_value'][$key];
                     }
//                     if (!empty($postData['cf_cost'][$key])) {
//                         $insertData1['cf_cost'] = $postData['cf_cost'][$key];
//                     }
//                     if (!empty($postData['total_cost'][$key])) {
//                         $insertData1['total_cost'] = $postData['total_cost'][$key];
//                     }
                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('return_receive_details', $insertData1);
                 }
                 redirect_with_msg('general_store/details_store_return/'.$id, 'Successfully Updated  Return Receive Info');
            }
        } else {
            redirect_with_msg('general_store/edit_store_return/'.$id, 'Please fill the form and submit');
        }
    }
    
    function delete_store_return($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'store_return';
        $this->titlebackend("Store Return");
         if (!empty($id)) {  
            $ids = $this->m_common->delete_row('return_receive', array('rr_id' => $id));
            if (!empty($ids)) {
                $this->m_common->delete_row('return_receive_details', array('rr_id' => $id));
                redirect_with_msg('general_store/store_return', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/store_return', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/store_return', 'Please click on delete button');
        }
    }
    
    
      function receive_return_receive($id) {
         $return_items=$this->m_common->get_row_array('return_receive_details',array('rr_id'=>$id),'item_id,return_qty');
         foreach($return_items as $return_item){
             $item_info=$this->m_common->get_row_array('items',array('id'=>$return_item['item_id']),'stock_amount');
             $current_stock=$item_info[0]['stock_amount']-$return_item['return_qty'];
             $this->m_common->update_row('items',array('id'=>$return_item['item_id']),array('stock_amount'=>$current_stock));
         }
         $ids=$this->m_common->update_row('return_receive',array('rr_id'=>$id),array('rr_status'=>"returned"));
         if(!empty($ids)){
             $this->m_common->update_row('return_receive_details',array('rr_id'=>$id),array('rr_d_status'=>"returned"));
             redirect_with_msg('general_store/store_return', 'Successfully Returned Material Receive');
         }else{
             redirect_with_msg('general_store/store_return', 'Not Returned Material Receive Requisition');
         }
     }
     
      function reject_return_receive($id) {
        $return_items=$this->m_common->get_row_array('return_receive_details',array('rr_id'=>$id),'item_id,return_qty');
         foreach($return_items as $return_item){
             $item_info=$this->m_common->get_row_array('items',array('id'=>$return_item['item_id']),'stock_amount');
             $current_stock=$item_info[0]['stock_amount']+$return_item['return_qty'];
             $this->m_common->update_row('items',array('id'=>$return_item['item_id']),array('stock_amount'=>$current_stock));
         }
         $ids=$this->m_common->update_row('return_receive',array('rr_id'=>$id),array('rr_status'=>"not returned"));
         if(!empty($ids)){
             $this->m_common->update_row('return_receive_details',array('rr_id'=>$id),array('rr_d_status'=>"not returned"));
             redirect_with_msg('general_store/store_return', 'Successfully Rejected Returned Material Receive');
         }else{
             redirect_with_msg('general_store/store_return', 'Not Returned Material Receive Requisition');
         }
     }
    
    
    
 //End Store Return  
    
    
    
    //Start Issue Return
    
    function issue_return() {
        $this->menu = 'general_store';
     //   $this->sub_menu = 'issue_return';
        $this->sub_inner_menu = 'issue_return';
        $this->titlebackend("Issue Return");
        $data['issue_returns'] = $this->m_common->get_row_array('issue_return', '', '*');
        $this->load->view('general_store/v_issue_return',$data);
    }
    
    function add_issue_return() {
        $this->menu = 'general_store';
       // $this->sub_menu = 'issue_return';
        $this->sub_inner_menu = 'issue_return';
        $this->titlebackend("Add Issue Return");    
        //$data['issue_numbers'] = $this->m_common->get_row_array('issue_session', '', '*');
        $data['issue_numbers'] = $this->m_common->get_row_array('issue_session',array('issue_type'=>'general'), '*');
        $ir_last_code=$this->m_common->get_row_array('issue_return_code','','*','',1,'id','DESC');
        if(!empty($ir_last_code)){
           
            $ir_code=$ir_last_code[0]['ir_code']+1;
            if($ir_code>999){
                $ir_sl_no=$ir_code;
            }else if($ir_code>99){
                $ir_sl_no="0".$ir_code;
            }else if($ir_code>9){
                $ir_sl_no="00".$ir_code;
            }else{
                $ir_sl_no="000".$ir_code;
            }
        }else{
            $ir_code=1;
            $ir_sl_no='0001';
        }
        $data['ir_code']=$ir_code;
        $data['ir_auto_code']=$ir_sl_no;
        
        $this->load->view('general_store/v_add_issue_return',$data);
    }
    
    function add_action_issue_return() {
        $this->menu = 'general_store';
     //   $this->sub_menu = 'issue_return';
        $this->sub_inner_menu = 'issue_return';
        $this->titlebackend("Add Issue Return");
        $postData = $this->input->post();
        $ir_code=$this->input->post('ir_code');
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
            if(!empty($postData['ir_no'])){
                $insertData['ir_no'] = $postData['ir_no']; 
            }
            
            if(!empty($postData['ir_date'])){
                $insertData['ir_date'] =date('Y-m-d',strtotime($postData['ir_date']));
                $issue_return_date=date('Y-m-d',strtotime($postData['ir_date']));
            }
            if(!empty($postData['issue_date'])){
                $insertData['issue_date'] =date('Y-m-d',strtotime($postData['issue_date'])); 
            }
             if(!empty($postData['issue_no'])){
                $insertData['issue_no'] = $postData['issue_no']; 
            }
            
            if(!empty($postData['remarks'])){
                $insertData['remarks'] = $postData['remarks']; 
            }
           
            
            
            
            $id = $this->m_common->insert_row('issue_return', $insertData);
            if (!empty($id)) {
                $this->m_common->insert_row('issue_return_code', array('ir_code'=>$ir_code));
                 foreach ($postData['item_id'] as $key => $each) {
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['ir_id'] = $id;
                     $insertData1['ir_d_status'] ="applied";
                     $insertData1['ir_date'] = $issue_return_date;
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if (!empty($postData['c_c_id'][$key])) {
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     if (!empty($postData['asset_id'][$key])) {
                         $insertData1['asset_id'] = $postData['asset_id'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_description'][$key])) {
                         $insertData1['item_description'] = $postData['item_description'][$key];
                     }
                     if (!empty($postData['measurement_unit'][$key])) {
                         $insertData1['measurement_unit'] = $postData['measurement_unit'][$key];
                     }
                     if (!empty($postData['issued_qty'][$key])) {
                         $insertData1['issued_qty'] = $postData['issued_qty'][$key];
                     }
                    if (!empty($postData['return_qty'][$key])) {
                         $insertData1['return_qty'] = $postData['return_qty'][$key];
                     }
                     if (!empty($postData['unit_price'][$key])) {
                         $insertData1['unit_price'] = $postData['unit_price'][$key];
                     }
                  
                     if (!empty($postData['return_value'][$key])) {
                         $insertData1['return_value'] = $postData['return_value'][$key];
                     }
                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('issue_return_details', $insertData1); 
                 }
                redirect_with_msg('general_store/add_issue_return', 'Successfully  Issue Return');
            } else {
                redirect_with_msg('general_store/add_issue_return', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_issue_return', 'Please fill the form and submit');
        }
        
    }
    
    function edit_issue_return($id) {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'issue_return';
      //  $this->sub_menu = 'store_return';
        $this->titlebackend("Edit Issue Return");
        $data['issue_numbers'] = $this->m_common->get_row_array('issue_session', '', '*');
        
        $data['issue_return'] = $this->m_common->get_row_array('issue_return',array('ir_id'=>$id), '*');
        $data['items'] = $this->m_common->get_row_array('issue_session_details',array('issue_id'=>$data['issue_return'][0]['issue_no']), '*');
        $data['issue_return_details'] = $this->m_common->get_row_array('issue_return_details', array('ir_id' => $id), '*');
        $this->load->view('general_store/v_edit_issue_return',$data);
    }
    
     function details_issue_return($id,$print=false) {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'issue_return';
       // $this->sub_menu = 'issue_return';
        $this->titlebackend("Details Issue Return ");
        $data['issue_numbers'] = $this->m_common->get_row_array('issue_session', '', '*');
        
        $data['issue_return'] = $this->m_common->get_row_array('issue_return',array('ir_id'=>$id), '*');
        $issue_info= $this->m_common->get_row_array('issue_session',array('issue_id'=>$data['issue_return'][0]['issue_no']), '*');
        $data['issue_info']=$issue_info;
        $data['indent_info'] = $this->m_common->get_row_array('v_ipo_material_indent',array('ipo_m_id'=>$issue_info[0]['issue_ipo_no']), '*');
        $data['issue_return_details'] = $this->m_common->get_row_array('issue_return_details', array('ir_id' => $id), '*');
       // $this->load->view('general_store/v_details_issue_return',$data);
          if($print==false){
            $this->load->view('general_store/v_details_issue_return',$data);
        }else{
           $html=$this->load->view('general_store/print_issue_return', $data,true);
           echo $html;exit; 
        }
    }
    
    function edit_action_issue_return($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'issue_return';
        $this->titlebackend("Edit Issue Return");
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
            if(!empty($postData['ir_no'])){
                $insertData['ir_no'] = $postData['ir_no']; 
            }
            
            if(!empty($postData['ir_date'])){
                $insertData['ir_date'] =date('Y-m-d',strtotime($postData['ir_date']));
                $issue_return_date=date('Y-m-d',strtotime($postData['ir_date']));
            }
            if(!empty($postData['issue_date'])){
                $insertData['issue_date'] =date('Y-m-d',strtotime($postData['issue_date'])); 
            }
            if(!empty($postData['ir_status'])){
                $issue_status=$postData['ir_status']; 
            }
            if(!empty($postData['issue_no'])){
                $insertData['issue_no'] = $postData['issue_no']; 
            }
            
            if(!empty($postData['remarks'])){
                $insertData['remarks'] = $postData['remarks']; 
            }
           
            $s_id=$this->m_common->update_row('issue_return',array('ir_id'=>$id),$insertData);
            $delete_details=$this->m_common->delete_row('issue_return_details',array('ir_id'=>$id));
            if (!empty($s_id)) {
                  foreach ($postData['item_id'] as $key => $each) {
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['ir_id'] = $id;
                     $insertData1['ir_date'] = $issue_return_date;
                     if (!empty($issue_status)) {
                         $insertData1['ir_d_status'] =$issue_status;
                     }
                     if (!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if (!empty($postData['c_c_id'][$key])) {
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     if (!empty($postData['asset_id'][$key])) {
                         $insertData1['asset_id'] = $postData['asset_id'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                    
                     if (!empty($postData['item_description'][$key])) {
                         $insertData1['item_description'] = $postData['item_description'][$key];
                     }
                     if (!empty($postData['measurement_unit'][$key])) {
                         $insertData1['measurement_unit'] = $postData['measurement_unit'][$key];
                     }
                     if (!empty($postData['issued_qty'][$key])) {
                         $insertData1['issued_qty'] = $postData['issued_qty'][$key];
                     }
                    if (!empty($postData['return_qty'][$key])) {
                         $insertData1['return_qty'] = $postData['return_qty'][$key];
                     }
                     if (!empty($postData['unit_price'][$key])) {
                         $insertData1['unit_price'] = $postData['unit_price'][$key];
                     }
                  
                     if (!empty($postData['return_value'][$key])) {
                         $insertData1['return_value'] = $postData['return_value'][$key];
                     }
                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('issue_return_details', $insertData1);
                 }
                
                    redirect_with_msg('general_store/details_issue_return/'.$id, 'Successfully Updated Issue Return Info');
              
            }else{
                  foreach ($postData['item_id'] as $key => $each) {
                     $insertData1=array();
                     $insertData1['item_id'] = $each;
                     $insertData1['ir_id'] = $id;
                     $insertData1['ir_date'] = $issue_return_date;
                     if(!empty($issue_status)) {
                         $insertData1['ir_d_status'] =$issue_status;
                     }
                     if(!empty($postData['department_id'][$key])) {
                         $insertData1['department_id'] = $postData['department_id'][$key];
                     }
                     if(!empty($postData['c_c_id'][$key])) {
                         $insertData1['c_c_id'] = $postData['c_c_id'][$key];
                     }
                     if (!empty($postData['asset_id'][$key])) {
                         $insertData1['asset_id'] = $postData['asset_id'][$key];
                     }
                     if (!empty($postData['item_code'][$key])) {
                         $insertData1['item_code'] = $postData['item_code'][$key];
                     }
                     if (!empty($postData['item_description'][$key])) {
                         $insertData1['item_description'] = $postData['item_description'][$key];
                     }
                     if (!empty($postData['measurement_unit'][$key])) {
                         $insertData1['measurement_unit'] = $postData['measurement_unit'][$key];
                     }
                     if (!empty($postData['issued_qty'][$key])) {
                         $insertData1['issued_qty'] = $postData['issued_qty'][$key];
                     }
                    if (!empty($postData['return_qty'][$key])) {
                         $insertData1['return_qty'] = $postData['return_qty'][$key];
                     }
                     if (!empty($postData['unit_price'][$key])) {
                         $insertData1['unit_price'] = $postData['unit_price'][$key];
                     }
                  
                     if (!empty($postData['return_value'][$key])) {
                         $insertData1['return_value'] = $postData['return_value'][$key];
                     }
                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('issue_return_details', $insertData1);
                 }
                 redirect_with_msg('general_store/details_issue_return/'.$id, 'Successfully Updated Issue Return Info');
            }
        } else {
            redirect_with_msg('general_store/edit_issue_return/'.$id, 'Please fill the form and submit');
        }
    }
    
    function delete_issue_return($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'issue_return';
        $this->titlebackend("Issue Return");
         if (!empty($id)) {  
            $ids = $this->m_common->delete_row('issue_return', array('ir_id' => $id));
            if (!empty($ids)) {
                $this->m_common->delete_row('issue_return_details', array('ir_id' => $id));
                redirect_with_msg('general_store/issue_return', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/issue_return', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/issue_return', 'Please click on delete button');
        }
    }
    
    
    
      function receive_issue_return($id) {
         $return_items=$this->m_common->get_row_array('issue_return_details',array('ir_id'=>$id),'item_id,return_qty');
         foreach($return_items as $return_item){
             $item_info=$this->m_common->get_row_array('items',array('id'=>$return_item['item_id']),'stock_amount');
             $current_stock=$item_info[0]['stock_amount']+$return_item['return_qty'];
             $this->m_common->update_row('items',array('id'=>$return_item['item_id']),array('stock_amount'=>$current_stock));
         }
         $ids=$this->m_common->update_row('issue_return',array('ir_id'=>$id),array('ir_status'=>"received"));
         if(!empty($ids)){
             $this->m_common->update_row('issue_return_details',array('ir_id'=>$id),array('ir_d_status'=>"received"));
             redirect_with_msg('general_store/issue_return', 'Successfully Received Material Receive Requisition');
         }else{
             redirect_with_msg('general_store/issue_return', 'Not Received Material Receive Requisition');
         }
     }
     
      function reject_issue_return($id) {
         $return_items=$this->m_common->get_row_array('issue_return_details',array('ir_id'=>$id),'item_id,return_qty');
         foreach($return_items as $return_item){
             $item_info=$this->m_common->get_row_array('items',array('id'=>$return_item['item_id']),'stock_amount');
             $current_stock=$item_info[0]['stock_amount']-$return_item['return_qty'];
             $this->m_common->update_row('items',array('id'=>$return_item['item_id']),array('stock_amount'=>$current_stock));
         }
         $ids=$this->m_common->update_row('issue_return',array('ir_id'=>$id),array('ir_status'=>"not received"));
         if(!empty($ids)){
             $this->m_common->update_row('issue_return_details',array('ir_id'=>$id),array('ir_d_status'=>"not received"));
             redirect_with_msg('general_store/issue_return', 'Successfully Received Material Receive Requisition');
         }else{
             redirect_with_msg('general_store/issue_return', 'Not Received Material Receive Requisition');
         }
     }
    
    
    
    
 //End Issue Return   
    
    

    function article_group_information() {
        $this->menu = 'general_store';
        $this->sub_menu = 'article_group_information';
        $this->titlebackend("Article Group Information");

        $this->load->view('general_store/v_article_group_info');
    }
    
    
  //Start Item Category Information Start     
    
    

    
    function cost_center() {
        $this->menu = 'general_store';
    //    $this->sub_menu = 'item_group_information';
        $this->sub_inner_menu = 'cost_center';
        $this->titlebackend("Cost Center");
        $data['cost_centers'] = $this->m_common->get_row_array('cost_center', '', '*');
        $this->load->view('general_store/v_cost_center',$data);
    }
    
       function add_cost_center() {
            $this->menu = 'general_store';
          //  $this->sub_menu = 'item_group_information';
            $this->sub_inner_menu = 'cost_center';
            $this->titlebackend("Add Cost Center");

            $this->load->view('general_store/v_add_cost_center');
        }
        
         function add_action_cost_center() {
                $this->menu = 'general_store';
                $this->sub_inner_menu = 'cost_center';
                $this->titlebackend("Cost Center");
                $data = $this->input->post();
                if (!empty($data)) {
                   // $data['created'] = date('Y-m-d');
                    $id = $this->m_common->insert_row('cost_center', $data);
                    if (!empty($id)) {
                        redirect_with_msg('general_store/add_cost_center', 'Successfully Added this Item Category');
                    } else {
                        redirect_with_msg('general_store/add_cost_center', 'Data not saved for an unexpected error');
                    }
                } else {
                    redirect_with_msg('general_store/add_cost_center', 'Please fill the form and submit');
                }

        
        } 
        
        
        
        function edit_cost_center($id) {
            $this->menu = 'general_store';
            $this->sub_inner_menu = 'cost_center';
            $this->titlebackend("Edit Cost Center");
            $data['cost_center'] = $this->m_common->get_row_array('cost_center', array('c_c_id' => $id), '*');
            $this->load->view('general_store/v_edit_cost_center',$data);
        }
    
     function edit_action_cost_center($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'cost_center';
        $this->titlebackend("Edit Cost Center");

         $data = $this->input->post();
        if (!empty($data)) {
            $ids =$this->m_common->update_row('cost_center',array('c_c_id' =>$id),$data);
            if (!empty($ids)) {
                redirect_with_msg('general_store/cost_center', 'Successfully Updated this  Cost Center');
            } else {
                redirect_with_msg('general_store/edit_cost_center/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/edit_cost_center/'.$id, 'Please fill the form and submit');
        }
    }
        
    
   function delete_cost_center($id) {
        if (!empty($id)) {
           
            $id = $this->m_common->delete_row('cost_center', array('c_c_id' => $id));
            if (!empty($id)) {
                redirect_with_msg('general_store/cost_center', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/cost_center', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/cost_center', 'Please click on delete button');
        }
    } 
    
        
       
 //End Cost Center  Information            
    
    
    
    
//Start Item Category Information Start     
    
    

    
    function item_category() {
        $this->menu = 'general_store';
    //    $this->sub_menu = 'item_group_information';
        $this->sub_inner_menu = 'item_category';
        $this->titlebackend("Item Category");
        $data['categories'] = $this->m_common->get_row_array('item_category', '', '*');
        $this->load->view('general_store/v_category',$data);
    }
    
       function add_item_category() {
            $this->menu = 'general_store';
          //  $this->sub_menu = 'item_group_information';
            $this->sub_inner_menu = 'item_category';
            $this->titlebackend("Add Item Category");

            $this->load->view('general_store/v_add_category');
        }
        
         function add_action_item_category() {
                $this->menu = 'general_store';
                $this->sub_menu = 'item_category';
                $this->titlebackend("Item Category");
                $data = $this->input->post();
                if (!empty($data)) {
                   // $data['created'] = date('Y-m-d');
                    $id = $this->m_common->insert_row('item_category', $data);
                    if (!empty($id)) {
                        redirect_with_msg('general_store/add_item_category', 'Successfully Added this Item Category');
                    } else {
                        redirect_with_msg('general_store/add_item_category', 'Data not saved for an unexpected error');
                    }
                } else {
                    redirect_with_msg('general_store/add_item_category', 'Please fill the form and submit');
                }

        
        } 
        
        
        
        function edit_item_category($id) {
            $this->menu = 'general_store';
            $this->sub_menu = 'item_category';
            $this->titlebackend("Edit Item  Category");
            $data['category'] = $this->m_common->get_row_array('item_category', array('c_id' => $id), '*');
            $this->load->view('general_store/v_edit_category',$data);
        }
    
     function edit_action_item_category($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'item_category';
        $this->titlebackend("Edit Item Category");

         $data = $this->input->post();
        if (!empty($data)) {
            $ids =$this->m_common->update_row('item_category',array('c_id' =>$id),$data);
            if (!empty($ids)) {
                redirect_with_msg('general_store/item_category', 'Successfully Updated this item Category');
            } else {
                redirect_with_msg('general_store/edit_item_category/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/edit_item_category/'.$id, 'Please fill the form and submit');
        }
    }
        
    
   function delete_item_category($id) {
        if (!empty($id)) {
           
            $id = $this->m_common->delete_row('item_category', array('c_id' => $id));
            if (!empty($id)) {
                redirect_with_msg('general_store/item_category', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/item_category', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/item_category', 'Please click on delete button');
        }
    } 
    
        
       
 //End Item Category Information Start         
    
        
    
 //Start Item Group Information Start   
    
    
     function item_group_information() {
        $this->menu = 'general_store';
    //    $this->sub_menu = 'item_group_information';
        $this->sub_inner_menu = 'item_group_information';
        $this->titlebackend("Item Group Information");
        $data['item_groups'] = $this->m_common->get_row_array('item_groups', '', '*');
        $this->load->view('general_store/v_item_group',$data);
    }
    
     function add_item_group_information() {
        $this->menu = 'general_store';
      //  $this->sub_menu = 'item_group_information';
        $this->sub_inner_menu = 'item_group_information';
        $this->titlebackend("Add Item Group Information");

        $this->load->view('general_store/v_add_item_group');
    }
    
     function add_action_item_group_information() {
        $this->menu = 'general_store';
        $this->sub_menu = 'item_group_information';
        $this->titlebackend("Item Group Information");
        $data = $this->input->post();
        if (!empty($data)) {
            $data['created'] = date('Y-m-d');
            $id = $this->m_common->insert_row('item_groups', $data);
            if (!empty($id)) {
                redirect_with_msg('general_store/add_item_group_information', 'Successfully Added this Item Group');
            } else {
                redirect_with_msg('general_store/add_item_group_information', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/add_item_group_information', 'Please fill the form and submit');
        }

        
    }
    
   
 
    
    function edit_item_group_information($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'item_group_information';
        $this->titlebackend("Edit Item Group Information");
        $data['item_group'] = $this->m_common->get_row_array('item_groups', array('id' => $id), '*');
        $this->load->view('general_store/v_edit_item_group',$data);
    }
    
     function edit_action_item_group_information($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'item_group_information';
        $this->titlebackend("Edit Item Group Information");

         $data = $this->input->post();
        if (!empty($data)) {
            $ids = $this->m_common->update_row('item_groups', array('id' => $id), $data);
            if (!empty($ids)) {
                redirect_with_msg('general_store/item_group_information', 'Successfully Updated this item group');
            } else {
                redirect_with_msg('general_store/edit_item_group_information/'.$id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/edit_item_group_information/'.$id, 'Please fill the form and submit');
        }
    }
    
      function delete_item_group_information($id) {
        if (!empty($id)) {
           
            $id = $this->m_common->delete_row('item_groups', array('id' => $id));
            if (!empty($id)) {
                redirect_with_msg('general_store/item_group_information', 'Successfully Deleted');
            } else {
                redirect_with_msg('general_store/item_group_information', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('general_store/item_group_information', 'Please click on delete button');
        }
    }

    
    
    
//End Item Group Information Start       
    
    function sample_delivery_session() {
        $this->menu = 'general_store';
        $this->sub_menu = 'sample_delivery_session';
        $this->titlebackend("Sample Delivery Session");

        $this->load->view('general_store/v_sample_delivery_session');
    }

    function yarn_basic_information() {
        $this->menu = 'general_store';
        $this->sub_menu = 'yarn_basic_information';
        $this->titlebackend("Yarn Basic Information");

        $this->load->view('general_store/v_yarn_basic_info');
    }

    function machinary_spares_issue_session() {
        $this->menu = 'general_store';
        $this->sub_menu = 'machinary_spares_issue';
        $this->titlebackend("Machinary Spares Issue");

        $this->load->view('general_store/v_machinary_spares_issue');
    }

    function machinary_spares_sell_session() {
        $this->menu = 'general_store';
        $this->sub_menu = 'machinary_spares_sell_session';
        $this->titlebackend("Machinary Spares Sell Session");

        $this->load->view('general_store/v_machinary_spares_sell_session');
    }

    function miscelleneoure_reporting_session() {
        $this->menu = 'general_store';
        $this->sub_menu = 'miscelleneoure_reporting_session';
        $this->titlebackend("Miscelleneoure reporting Session");

        $this->load->view('general_store/v_miscelleneour_reporting_session');
    }

    function monthly_valuation() {
        $this->menu = 'general_store';
        $this->sub_menu = 'monthly_valuation';
        $this->titlebackend("Monthly Valuation");

        $this->load->view('general_store/v_monthly_valuation');
    }

    function current_transaction_year_setting() {
        $this->menu = 'general_store';
        $this->sub_menu = 'current_transaction_year_setting';
        $this->titlebackend("Current Transaction Year Setting");

        $this->load->view('general_store/v_current_transaction_year_setting');
    }

    function ipo_reminder_dmr_report() {
        $this->menu = 'general_store';
        $this->sub_menu = 'ipo_reminder_dmr_report';
        $this->titlebackend("Ipo Reminder Dmr Report");

        $this->load->view('general_store/v_ipo_reminder_dmr_report');
    }

    function ipo_receive_session() {
        $this->menu = 'general_store';
        $this->sub_menu = 'ipo_receive_session';
        $this->titlebackend("Ipo Receive Session");

        $this->load->view('general_store/v_ipo_receive_session');
    }

    function issue_report() {
        $this->menu = 'general_store';
        $this->sub_menu = 'issue_report';
        $this->titlebackend("Issue Report");

        $this->load->view('general_store/v_issue_report');
    }

    function do_report_session() {
        $this->menu = 'general_store';
        $this->sub_menu = 'do_report_session';
        $this->titlebackend("Do Report Session");

        $this->load->view('general_store/v_do_report_session');
    }

    function do_session() {
        $this->menu = 'general_store';
        $this->sub_menu = 'do_session';
        $this->titlebackend("Do  Session");

        $this->load->view('general_store/v_do_session');
    }

    function ic_basic_information() {
        $this->menu = 'general_store';
        $this->sub_menu = 'ic_basic_information';
        $this->titlebackend("Ic Basic Information");

        $this->load->view('general_store/v_ic_basic_information');
    }

    function proforma_invoice() {
        $this->menu = 'general_store';
        $this->sub_menu = 'proforma_invoice';
        $this->titlebackend("Proforma Invoice");

        $this->load->view('general_store/v_proforma_invoice');
    }
    
    function consumption() {
        $this->menu = 'general_store';
        $this->sub_menu = 'consumption';
        $this->titlebackend("Item Consumption");
//$data['cost_centers'] = $this->m_common->get_row_array('tbl_item_comsumption', '', '*');
        $sql ="select tic.*,i.item_name,cc.c_c_name from tbl_item_comsumption tic 
JOIN items i on i.id = tic.item_id
join cost_center cc on cc.c_c_id = tic.c_c_id";
        $data['item_consumption']=$this->m_common->customeQuery($sql);
        $this->load->view('general_store/v_consumption',$data);
    }
    
    function add_consumption() {
        $this->menu = 'general_store';
        $this->sub_menu = 'consumption';
        $this->titlebackend("Add Consumption");
        $data['items'] = $this->m_common->get_row_array('v_items', array('item_type'=>'Consumable'), '*');
        $data['cost_centers'] = $this->m_common->get_row_array('cost_center', '', '*');
        $branch_id= $this->session->userdata('companyId');
        if(!empty($_POST)){
           $postData = $this->input->post();
           $consuptionInsert = array();
           foreach ($postData['item_id'] as $key=>$row){
             $consuptionInsert['unit_id']= $branch_id;
             $consuptionInsert['item_id']= $postData['item_id'][$key];
             $consuptionInsert['c_c_id']= $postData['c_c_id'][$key];
             $consuptionInsert['consumption_quantity']= $postData['consumption_quantity'][$key];
             $consuptionInsert['created_date']= date('Y-m-d');
             $consuptionInsert['consumption_date']= date('Y-m-d',  strtotime($postData['consumption_date']));
             $consuptionInsert['total_quantity']= $postData['total_quantity'][$key];
             $consuptionInsert['remarks']= $postData['remarks'][$key];
           $consumption_id = $this->m_common->insert_row('tbl_item_comsumption',$consuptionInsert);
           if($consumption_id){
               $this->m_common->update_row('tbl_item_stock',array('unit_id'=>$branch_id,'item_id'=>$postData['item_id'][$key]),array('quantity'=>$postData['total_quantity'][$key]));
           }
           }
         redirect_with_msg('general_store/add_consumption', 'Consumption  Successfully Inserted');  
        }else{
         $this->load->view('general_store/v_add_consumption',$data);   
        }
        
    }
    
    
    
    
     function getRendVerCode($j) {
        $start = 0;
        $end = 9;
        $a = rand($start, $end);

        for ($i = 1; $i < $j; $i++) {
            $a.= rand($start, $end);
        }
        return $a;
    }
    
    
    function item_stock(){
      $this->setOutputMode(NORMAL);
      $branch_id= $this->session->userdata('companyId');
      $item_id=$this->input->post('item_id');
      //$data['item_info']=$this->m_common->get_row_array('items',array('id'=>$item_id),'*');
      //$data=$this->m_common->get_row_array('items',array('id'=>$item_id),'*');
      //$data['item_info']= $this->m_common->get_row_array('items',array('id'=>$item_id),'*');
      $data['item_info']= $this->m_common->get_row_array('tbl_item_stock',array('unit_id'=>$branch_id,'item_id'=>$item_id),'*');
      
     
      
      //$data['item_previous_info']=$this->m_common->get_row_array('v_material_receive_requistion_details',array('item_id'=>$item_id),'*','',1,'mrrd_id','DESC');
    if($data['item_info']){
      echo json_encode(array('mag'=>'success','data'=>$data));
    }else{
        echo json_encode(array('mag'=>'faild'));
    }
    }
    
    function item_info(){
      $this->setOutputMode(NORMAL);
      $item_id=$this->input->post('itemId');
      //$data['item_info']=$this->m_common->get_row_array('items',array('id'=>$item_id),'*');
      //$data=$this->m_common->get_row_array('items',array('id'=>$item_id),'*');
      $data['item_info']=$this->m_common->get_row_array('items',array('id'=>$item_id),'*');
       
      $data['item_previous_info']=$this->m_common->get_row_array('v_material_receive_requistion_details',array('item_id'=>$item_id),'*','',1,'mrrd_id','DESC');
    
      echo json_encode($data);
    }
    
    function item_list(){
      $this->setOutputMode(NORMAL);
      $item_type=$this->input->post('item_type');
      $data['item_list']=$this->m_common->get_row_array('items',array('item_type'=>$item_type),'*');
      echo json_encode($data);
    }
    
     function indent_info_details(){
         $this->setOutputMode(NORMAL);
         $mrr_indent_no=$this->input->post('mrr_indent_no');
         $data['indent']=$this->m_common->get_row_array('ipo_material_indent',array('ipo_m_id'=>$mrr_indent_no),'*');
         $formate_date=date('d-m-Y',strtotime($data['indent'][0]['date']));
         $data['indent'][0]['date']=$formate_date;
         $data['indent_details']=$this->m_common->get_row_array('v_ipo_material_indent_details',array('ipo_m_id'=>$mrr_indent_no),'*'); 
         foreach($data['indent_details'] as $key=>$indent_details){
             $current_stock=$this->m_common->get_row_array('items',array('id'=>$indent_details['item_id']),'*');
             $data['indent_details'][$key]['stock_qty']=$current_stock[0]['stock_amount'];
         }
          echo json_encode($data);
     }
     
     function issue_indent_info_details(){
         $this->setOutputMode(NORMAL);
         $mrr_indent_no=$this->input->post('mrr_indent_no');
         //$data['indent']=$this->m_common->get_row_array('ipo_material_indent',array('ipo_m_id'=>$mrr_indent_no),'*');
         $data['indent']=$this->m_common->get_row_array('v_ipo_material_indent',array('ipo_m_id'=>$mrr_indent_no),'*');
         $formate_date=date('d-m-Y',strtotime($data['indent'][0]['date']));
         $data['indent'][0]['date']=$formate_date;
         $data['indent_details']=$this->m_common->get_row_array('v_ipo_material_indent_details',array('ipo_m_id'=>$mrr_indent_no,'status'=>"received"),'*'); 
         foreach($data['indent_details'] as $key=>$indent_details){
             $current_stock=$this->m_common->get_row_array('items',array('id'=>$indent_details['item_id']),'*');
             $data['indent_details'][$key]['stock_qty']=$current_stock[0]['stock_amount'];
             
             $sql='Select sum(receive_qty) as re_qty,sum(total_cost) as re_value from material_receive_requisition_details where item_id='.$indent_details['item_id'].' and mrr_d_status="received" ';
             $receive_qty=$this->m_common->customeQuery($sql);
             
             $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where item_id='.$indent_details['item_id'].' and ir_d_status="received" ';
             $issue_return_qty=$this->m_common->customeQuery($sql);
             
             $sql='Select sum(receive_qty) as mrr_receive_qty,sum(receive_value) as mrr_receive_value from mrr_return_receive_details where item_id='.$indent_details['item_id'].' and mrr_rr_d_status="received" ';
             $mrr_return_receive=$this->m_common->customeQuery($sql);
             
             $total_receive_qty=$receive_qty[0]['re_qty']+$issue_return_qty[0]['is_ret_qty']+$mrr_return_receive[0]['mrr_receive_qty'];
             $total_receive_value=$receive_qty[0]['re_value']+$issue_return_qty[0]['is_ret_value']+$mrr_return_receive[0]['mrr_receive_value'];
             
            $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where item_id='.$indent_details['item_id'].' and issue_status="issued" ';
            $issue_qty=$this->m_common->customeQuery($sql);
            
            $sql='Select sum(return_qty) as ret_qty,sum(return_value) as ret_value from return_receive_details where item_id='.$indent_details['item_id'].' and rr_d_status="returned" ';
            $return_qty=$this->m_common->customeQuery($sql);
            
            $total_issue_qty=$issue_qty[0]['issue_qty']+$return_qty[0]['ret_qty'];
            $total_issue_value=$issue_qty[0]['issue_value']+$return_qty[0]['ret_value'];
            
            $available_qty=$total_receive_qty+$current_stock[0]['opening_stock']-$total_issue_qty;
            $available_value=$total_receive_value+$current_stock[0]['opening_value']-$total_issue_value;
            $current_rate=round($available_value/$available_qty,2);
            $data['indent_details'][$key]['current_rate']=$current_rate;
         }
          echo json_encode($data);
     }
     function requisition_info_details(){
         $this->setOutputMode(NORMAL);
         $requisition_id=$this->input->post('requisition_id');
         //$data['indent']=$this->m_common->get_row_array('ipo_material_indent',array('ipo_m_id'=>$mrr_indent_no),'*');
         $data['indent']=$this->m_common->get_row_array('asset_requisition',array('requisition_id'=>$requisition_id),'*');
         $formate_date=date('d-m-Y',strtotime($data['indent'][0]['date']));
         $data['indent'][0]['date']=$formate_date;
         $sql="select * from v_asset_requisition_details where requisition_id=".$requisition_id." and (status='partial_issued' or status='pending') ";
         $data['indent_details']=$this->m_common->customeQuery($sql);
          foreach($data['indent_details'] as $key=>$indent_details){
             $current_stock=$this->m_common->get_row_array('items',array('id'=>$indent_details['item_id']),'*');
             $data['indent_details'][$key]['stock_qty']=$current_stock[0]['stock_amount'];
              
         }
       
          echo json_encode($data);
     }
     function budget_info_details(){
         $this->setOutputMode(NORMAL);
         $procurement=$this->input->post('procurement');
         $data['budget_details']=$this->m_common->get_row_array('budget_details',array('bu_d_status'=>'pending','b_type'=>$procurement), '*'); 
        
          echo json_encode($data);
     }
     
     function group_item_id(){
        $this->setOutputMode(NORMAL);
        $group_id=$this->input->post('group_id');
        $data['group_id']=$this->m_common->get_row_array('item_code',array('group_id'=>$group_id),'*','',1,'id','DESC');
        $data['group_info']=$this->m_common->get_row_array('item_groups',array('id'=>$group_id),'*');
        echo json_encode($data);
     }
     
      function budget_no(){
        $this->setOutputMode(NORMAL);
        $budget_type=$this->input->post('budget_type');
        $data['budget_no']=$this->m_common->get_row_array('budget_code',array('budget_type'=>$budget_type),'*','',1,'id','DESC');
        
        echo json_encode($data);
     }
     
     function issue_info_details(){
         $this->setOutputMode(NORMAL);
         $issue_no=$this->input->post('issue_no');
         $data['issue']=$this->m_common->get_row_array('issue_session',array('issue_id'=>$issue_no),'*');
         $formate_date=date('d-m-Y',strtotime($data['issue'][0]['issue_date']));
         $data['indent'][0]['date']=$formate_date;
         $data['issue_details']=$this->m_common->get_row_array('issue_session_details',array('issue_id'=>$issue_no),'*'); 
          echo json_encode($data);
     }
     
       function asset_issue_info_details(){
         $this->setOutputMode(NORMAL);
         $issue_no=$this->input->post('a_issue_id');
         $data['indent']=$this->m_common->get_row_array('asset_issue',array('a_issue_id'=>$issue_no),'*');
         $formate_date=date('d-m-Y',strtotime($data['indent'][0]['a_issue_date']));
         $data['indent'][0]['date']=$formate_date;
        // $data['issue_details']=$this->m_common->get_row_array('asset_issue_details',array('a_issue_id'=>$issue_no),'*'); 
         $sql="select * from asset_issue_details where a_issue_id=".$issue_no." and (issue_status='issued' or issue_status='partial_received')";
         $data['issue_details']=$this->m_common->customeQuery($sql);
         echo json_encode($data);
     }
     
      function receive_info_details(){
         $this->setOutputMode(NORMAL);
         $receive_no=$this->input->post('receive_no');
         $data['receive']=$this->m_common->get_row_array('material_receive_requisition',array('mrr_id'=>$receive_no),'*');
         $formate_date=date('d-m-Y',strtotime($data['receive'][0]['mrr_date']));
         $data['receive'][0]['date']=$formate_date;
         $data['receive_details']=$this->m_common->get_row_array('material_receive_requisition_details',array('mrr_id'=>$receive_no),'*'); 
          echo json_encode($data);
     }
     
      function return_info_details(){
         $this->setOutputMode(NORMAL);
         $return_no=$this->input->post('return_no');
         $data['return']=$this->m_common->get_row_array('return_receive',array('rr_id'=>$return_no),'*');
         $formate_date=date('d-m-Y',strtotime($data['return'][0]['rr_date']));
         $data['return'][0]['date']=$formate_date;
         $data['return_details']=$this->m_common->get_row_array('return_receive_details',array('rr_id'=>$return_no),'*'); 
          echo json_encode($data);
     }
     
     function search_result(){
         $this->menu = 'general_store';
//        $this->sub_menu = 'consumption';
//        $this->titlebackend("Add Consumption");  
         $data['data']='';
         $this->load->view('general_store/v_search_result',$data);
     }

}
