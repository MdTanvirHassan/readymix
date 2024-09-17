<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rm_setup extends Site_Controller {

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
        $this->menu = 'trading';
        $this->sub_menu = 'rm_setup';
        $this->sub_inner_menu = 'rm_setup';
        $this->titlebackend("Raw Materials");  
       
        $sql="select i.*,ig.item_group as item_category,ic.c_name,tmu.meas_unit,tzu.unit_name,tib.brand_name from rm_items i left join item_groups ig on i.item_group=ig.id left join item_category ic on i.item_category=ic.c_id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tzu on i.size_unit_id=tzu.size_unit_id left join tbl_item_brand tib on i.brand_id=tib.id where i.is_active=1";
        $data['items']=$this->m_common->customeQuery($sql); 
        $this->load->view('raw_materials/items/v_item',$data);
    }
    
    function add_rm(){
       $this->menu = 'trading';
       $this->sub_menu = 'rm_setup';
       $this->sub_inner_menu = 'rm_setup';
       $this->titlebackend("Raw Materials");  
       
       $data['item_types'] = $this->m_common->get_row_array('artclass','', '*');
       //$data['categories'] = $this->m_common->get_row_array('item_category','', '*');
       $c_sql="select ic.* from item_category ic left join item_groups ig on ic.group_id=ig.id where ig.group_short_name='RM'";
       $data['categories']=$this->m_common->customeQuery($c_sql);
          
       $data['size_units'] = $this->m_common->get_row_array('tbl_size_unit',array('is_active'=>1), '*');
       $data['brands'] = $this->m_common->get_row_array('tbl_item_brand',array('is_active'=>1), '*');
       $data['measurement_units'] = $this->m_common->get_row_array('tbl_measurement_unit',array('is_active'=>1), '*');
     
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
       
        $this->load->view('raw_materials/items/v_add_item',$data);
    }

     function add_rm_action(){
         
        $this->menu = 'trading';
        $this->sub_menu = 'rm_setup';
        $this->sub_inner_menu = 'rm_setup';
        $this->titlebackend("Raw Materials");  
         
         
        $user_id=$this->session->userdata('user_id');
        $employee_id =$this->session->userdata('employeeId');
        $branch_id = $this->session->userdata('companyId');
         
        
        
       
        $data = $this->input->post();
        $item_code=$this->input->post('item_c');
        $group_id=$this->input->post('item_group');
        
        $category_id=$this->input->post('item_category');
        
        $group_info=$this->m_common->get_row_array('item_category',array('c_id'=>$category_id),'*');
        
        
        
        $item_name=$this->input->post('item_name');
        $item_type=$this->input->post('item_type');
        $brand=$this->input->post('brand');
        $origin=$this->input->post('origin');
        $parts_no=$this->input->post('port_no');
      //  $exist_info=$this->m_common->get_row_array('items',array('item_group'=>$group_id,'item_type'=>$item_type,'item_name'=>$item_name,'brand'=>$brand,'origin'=>$origin,'port_no'=>$parts_no),'*');
        $exist_info=$this->m_common->get_row_array('rm_items',array('item_name'=>$item_name,'is_active'=>1),'*');
        if(!empty($exist_info)){
            redirect_with_msg('raw_materials/rm_setup/add_rm', 'This item already exists.');
        }
        if (!empty($data)) {
            
            $data['item_group'] =$group_info[0]['group_id'];            
            $data['item_type']='CONSUMABLE';
            $data['is_active']=1;            
            $data['created'] = date('Y-m-d');
            
            unset($data['item_c']);
           
           
            $id=$this->m_common->insert_row('rm_items', $data);
            
            if(!empty($id)){
               $this->m_common->insert_row('rm_item_code', array('item_code'=>$item_code,'group_id'=>$group_id));
               redirect_with_msg('raw_materials/rm_setup/add_rm', 'Successfully Added this Item');
            }else{
                redirect_with_msg('raw_materials/rm_setup/add_rm', 'Data not saved for an unexpected error');
            }
        }else{
            redirect_with_msg('raw_materials/rm_setup/add_rm', 'Please submit the form first');
        }
    }

    
    function edit_rm($id=false){
        $this->menu = 'trading';
        $this->sub_menu = 'rm_setup';
        $this->sub_inner_menu = 'rm_setup';
        $this->titlebackend("Raw Materials");  
      
        $branch_id= $this->session->userdata('companyId'); 
        $opening_stock=$this->m_common->get_row_array('tbl_item_opening_stock',array('item_id'=>$id,'unit_id'=>$branch_id), '*');
        $data['brands'] = $this->m_common->get_row_array('tbl_item_brand',array('is_active'=>1), '*');
        $data['measurement_units'] = $this->m_common->get_row_array('tbl_measurement_unit',array('is_active'=>1), '*');
        $data['size_units'] = $this->m_common->get_row_array('tbl_size_unit',array('is_active'=>1), '*');
        $data['item'] = $this->m_common->get_row_array('items',array('id'=>$id), '*');
        $data['item_document'] = $this->m_common->get_row_array('item_document',array('item_id'=>$id), '*');
        $data['item_types'] = $this->m_common->get_row_array('artclass','', '*');
       
        $data['item_groups'] = $this->m_common->get_row_array('item_groups','', '*');
       // $data['categories'] = $this->m_common->get_row_array('item_category','', '*');
       $c_sql="select ic.* from item_category ic left join item_groups ig on ic.group_id=ig.id where ig.group_short_name='RM'";
       $data['categories']=$this->m_common->customeQuery($c_sql);
       
        $sql="select rm_items.*,tmu.meas_unit from rm_items left join tbl_measurement_unit tmu on rm_items.mu_id=tmu.id where rm_items.id=".$id;
        $data['item'] = $this->m_common->customeQuery($sql);
       
       
        
        $this->load->view('raw_materials/items/v_edit_item',$data);
    }
   
    function edit_rm_item_action($id=false) {
        $this->menu = 'trading';
        $this->sub_menu = 'rm_setup';
        $this->sub_inner_menu = 'rm_setup';
        $this->titlebackend("Raw Materials");  
        
        
        $branch_id= $this->session->userdata('companyId'); 
        $employeeId=$this->session->userdata('employeeId');
        $data = $this->input->post();
        if (!empty($data)) {
            $group_id=$this->input->post('item_group');
            $item_name=$this->input->post('item_name');
            $item_type=$this->input->post('item_type');
            $brand=$this->input->post('brand');
            $origin=$this->input->post('origin');
            $parts_no=$this->input->post('port_no');
            
            $category_id=$this->input->post('item_category');
            $group_info=$this->m_common->get_row_array('item_category',array('c_id'=>$category_id),'*');
            
            unset($data['item_c']);
            
            $data['item_group'] =$group_info[0]['group_id'];
            
                                 
            $ids = $this->m_common->update_row('rm_items', array('id' => $id), $data);            
            redirect_with_msg('raw_materials/rm_setup/details_rm/'.$id, 'Successfully Updated');
            
        } else {
            redirect_with_msg('raw_materials/rm_setup/edit_rm/'.$id, 'Please fill the form and submit');
        }
    }
  
    
    
    function details_rm($id=false){
        $this->menu = 'trading';
        $this->sub_menu = 'rm_setup';
        $this->sub_inner_menu = 'rm_setup';
        $this->titlebackend("Raw Materials");  
      
        $branch_id= $this->session->userdata('companyId'); 
        $opening_stock=$this->m_common->get_row_array('tbl_item_opening_stock',array('item_id'=>$id,'unit_id'=>$branch_id), '*');
        $data['brands'] = $this->m_common->get_row_array('tbl_item_brand',array('is_active'=>1), '*');
        $data['measurement_units'] = $this->m_common->get_row_array('tbl_measurement_unit',array('is_active'=>1), '*');
        $data['size_units'] = $this->m_common->get_row_array('tbl_size_unit',array('is_active'=>1), '*');
        $data['item'] = $this->m_common->get_row_array('items',array('id'=>$id), '*');
        $data['item_document'] = $this->m_common->get_row_array('item_document',array('item_id'=>$id), '*');
        $data['item_types'] = $this->m_common->get_row_array('artclass','', '*');
       
         
        $data['item_groups'] = $this->m_common->get_row_array('item_groups','', '*');
        
        
        $c_sql="select ic.* from item_category ic left join item_groups ig on ic.group_id=ig.id where ig.group_short_name='RM'";
        $data['categories']=$this->m_common->customeQuery($c_sql);
        
        $sql="select rm_items.*,tmu.meas_unit from rm_items left join tbl_measurement_unit tmu on rm_items.mu_id=tmu.id where rm_items.id=".$id;
        $data['item'] = $this->m_common->customeQuery($sql);
        
        $this->load->view('raw_materials/items/v_details_item',$data);
    }
    
    
    
     function delete_rm($r_id) {
        if(!empty($r_id)) {
            $id=$this->m_common->update_row('rm_items', array('id' =>$r_id),array('is_active'=>0));
            if(!empty($id)){          
                redirect_with_msg('raw_materials/rm_setup/index', 'Successfully Deleted');
            }else{
                redirect_with_msg('raw_materials/rm_setup/index', 'Data not deleted for an unexpected error');
            }
        }else{
            redirect_with_msg('raw_materials/rm_setup/index', 'Please click on delete button');
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
    
    
     
    
     
    
}

