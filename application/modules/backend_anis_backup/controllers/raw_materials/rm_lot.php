<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rm_lot extends Site_Controller {

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
        $this->menu = 'rm';
        $this->sub_menu = 'rm_lot';
        $this->sub_inner_menu = 'rm_lot';
        $this->titlebackend("Raw Materials");  
       
        $sql="select rml.*,tlt.lot_type,ilc.date,ilc.lc_no from rm_lots rml left join tbl_lot_type tlt on rml.lot_type_id=tlt.id left join import_lc ilc on rml.lc_id=ilc.lc_id where rml.is_active=1";
        $data['rm_lots']=$this->m_common->customeQuery($sql); 
        $this->load->view('raw_materials/lots/v_rm_lot',$data);
    }
    
    function add_rm_lot(){
       $this->menu = 'rm';
       $this->sub_menu = 'rm_lot';
       $this->sub_inner_menu = 'rm_lot';
       $this->titlebackend("Raw Materials");  
       
       $branch_id = $this->session->userdata('companyId');
       $employee_id = $this->session->userdata('employeeId');
       $user_type = $this->session->userdata('user_type');
       $user_id = $this->session->userdata('user_id');
       
       
       $sql = "select sl.*,c.SUP_NAME as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from import_lc sl  left join supplier as c on c.ID=sl.sup_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank where sl.branch_id=$branch_id order by lc_id DESC";
       $data['lcs'] = $this->m_common->customeQuery($sql);       
       $data['lottypes']=$this->m_common->get_row_array('tbl_lot_type',array('art_group'=>'RM'),'*');              
       $this->load->view('raw_materials/lots/v_add_rm_lot',$data);
    }

     function add_rm_lot_action(){
         
        $this->menu = 'rm';
        $this->sub_menu = 'rm_lot';
        $this->sub_inner_menu = 'rm_lot';
        $this->titlebackend("Raw Materials");  
         
        $companyId = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');

        $postData = $this->input->post();
        if (!empty($postData)) {
            
            $insertData = array();
            
            if(!empty($postData['lc_id'])){
                $insertData['lc_id'] = $postData['lc_id'];                
            }

            if(!empty($postData['lot_number'])){
                $insertData['lot_number'] = $postData['lot_number'];
            }
            
            $pre_lot=$this->m_common->get_row_array('rm_lots',array('lot_number'=>$postData['lot_number']),'*');
            
            if(!empty($pre_lot)){
                redirect_with_msg('raw_materials/rm_lot/add_rm_lot','Already exits this lot number');
            }
            
            if(!empty($postData['inv_no'])){
                $insertData['inv_no'] = $postData['inv_no'];
            }
            if (!empty($postData['lot_type_id'])) {
                $insertData['lot_type_id'] = $postData['lot_type_id'];
            }
                        
            $insertData['created_by'] =$employee_id;
            $insertData['created_date'] = date('Y-m-d');
            $insertData['branch_id'] = $companyId;
            $insertData['status'] ="Pending";
            

            $id = $this->m_common->insert_row('rm_lots', $insertData);
            if (!empty($id)) {

                foreach ($postData['item_id'] as $key => $each) {
                    $insertData1 = array();
                    $insertData1['receive_status'] ="Pending";
                    $insertData1['lot_id']=$id;
                    
                    $insertData1['item_id']=$postData['item_id'][$key];
                    $insertData1['inv_bale_qty']=$postData['inv_bale_qty'][$key];
                    
                    $insertData1['inv_weight']=$postData['inv_weight'][$key];
                    $insertData1['landed_weight']=$postData['landed_weight'][$key];
                    $insertData1['accepted_bale_qty']=$postData['accepted_bale_qty'][$key];
                    $insertData1['accepted_weight']=$postData['accepted_weight'][$key];
                    $insertData1['rate']=$postData['rate'][$key];
                    $insertData1['amount']=$postData['amount'][$key];
                   
                    $this->m_common->insert_row('rm_lots_details', $insertData1);
                    
                }
                
                redirect_with_msg('raw_materials/rm_lot/add_rm_lot','Successfully Inserted');
            } else {
                redirect_with_msg('raw_materials/rm_lot/add_rm_lot', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/rm_lot/add_rm_lot', 'Please fill the form and submit');
        } 
        
    }

    
    function edit_rm_lot($id=false){
       $this->menu = 'rm';
       $this->sub_menu = 'rm_lot';
       $this->sub_inner_menu = 'rm_lot';
       $this->titlebackend("Raw Materials");  
      
       $branch_id = $this->session->userdata('companyId');
       $employee_id = $this->session->userdata('employeeId');
       $user_type = $this->session->userdata('user_type');
       $user_id = $this->session->userdata('user_id');
       
       
       $sql = "select sl.*,c.SUP_NAME as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from import_lc sl  left join supplier as c on c.ID=sl.sup_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank where sl.branch_id=$branch_id order by lc_id DESC";
       $data['lcs'] = $this->m_common->customeQuery($sql);       
       $data['lottypes']=$this->m_common->get_row_array('tbl_lot_type',array('art_group'=>'RM'),'*');   
       
       $lot_sql="select rml.*,ilc.date from rm_lots rml left join import_lc ilc on rml.lc_id=ilc.lc_id where rml.id=".$id;
       $data['lot_info']=$this->m_common->customeQuery($lot_sql);
       
       $sql="select iscd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length from rm_lots_details iscd left join rm_items rmi on iscd.item_id=rmi.id where iscd.lot_id=".$id;
       $data['lot_details']=$this->m_common->customeQuery($sql);
       
       
       $this->load->view('raw_materials/lots/v_edit_rm_lot',$data);
       
    }
   
    function edit_rm_lot_action($lot_id=false) {
        $this->menu = 'rm';
        $this->sub_menu = 'rm_lot';
        $this->sub_inner_menu = 'rm_lot';
        $this->titlebackend("Raw Materials");  
        
        $branch_id = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        
        $postData = $this->input->post();
        if (!empty($postData)) {
            
            $insertData = array();
            
            if(!empty($postData['lc_id'])){
                $insertData['lc_id'] = $postData['lc_id'];                
            }

            if(!empty($postData['lot_number'])){
                $insertData['lot_number'] = $postData['lot_number'];
            }

            if(!empty($postData['inv_no'])){
                $insertData['inv_no'] = $postData['inv_no'];
            }
            
            if(!empty($postData['lot_type_id'])){
                $insertData['lot_type_id']=$postData['lot_type_id'];
            }
                        
            $insertData['updated_by'] =$employee_id;
            $insertData['updated_date'] = date('Y-m-d');
            
            $id = $this->m_common->update_row('rm_lots',array('id'=>$lot_id),$insertData);
            if ($id>=0) {

                $this->m_common->delete_row('rm_lots_details',array('lot_id'=>$lot_id));
                foreach ($postData['item_id'] as $key => $each) {
                    $insertData1 = array();
                    $insertData1['receive_status'] ="Pending";
                    $insertData1['lot_id'] =$lot_id;
                    
                    $insertData1['item_id'] = $postData['item_id'][$key];
                    $insertData1['inv_bale_qty'] = $postData['inv_bale_qty'][$key];
                    
                    $insertData1['inv_weight'] = $postData['inv_weight'][$key];
                    $insertData1['landed_weight'] = $postData['landed_weight'][$key];
                    $insertData1['accepted_bale_qty'] = $postData['accepted_bale_qty'][$key];
                    $insertData1['accepted_weight'] = $postData['accepted_weight'][$key];
                    
                    $insertData1['rate'] = $postData['rate'][$key];
                    $insertData1['amount'] = $postData['amount'][$key];
                   
                    $this->m_common->insert_row('rm_lots_details', $insertData1);
                    
                }
                
                redirect_with_msg('raw_materials/rm_lot','Successfully Updated');
            }else{
                redirect_with_msg('raw_materials/rm_lot/edit_rm_lot/'.$lc_id,'Data not saved for an unexpected error');
            }
        } else {
               redirect_with_msg('raw_materials/rm_lot/edit_rm_lot/'.$lc_id,'Please fill the form and submit');
        } 
        
    }
  
    
    
    function details_rm_lot($id=false){
       $this->menu = 'rm';
       $this->sub_menu = 'rm_lot';
       $this->sub_inner_menu = 'rm_lot';
       $this->titlebackend("Raw Materials");  
      
       $branch_id = $this->session->userdata('companyId');
       $employee_id = $this->session->userdata('employeeId');
       $user_type = $this->session->userdata('user_type');
       $user_id = $this->session->userdata('user_id');       
       
       $sql = "select sl.*,c.SUP_NAME as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from import_lc sl  left join supplier as c on c.ID=sl.sup_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank where sl.branch_id=$branch_id order by lc_id DESC";
       $data['lcs'] = $this->m_common->customeQuery($sql);       
       $data['lottypes']=$this->m_common->get_row_array('tbl_lot_type',array('art_group'=>'RM'),'*');   
       
       $lot_sql="select rml.*,ilc.date from rm_lots rml left join import_lc ilc on rml.lc_id=ilc.lc_id where rml.id=".$id;
       $data['lot_info']=$this->m_common->customeQuery($lot_sql);
       
       $sql="select iscd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length from rm_lots_details iscd left join rm_items rmi on iscd.item_id=rmi.id where iscd.lot_id=".$id;
       $data['lot_details']=$this->m_common->customeQuery($sql);
       
       
       $this->load->view('raw_materials/lots/v_details_rm_lot',$data);
    }
    
    
    
     function delete_rm_lot($r_id) {
        if(!empty($r_id)) {
            $id=$this->m_common->update_row('rm_lots', array('id' =>$r_id),array('is_active'=>0));
            if(!empty($id)){          
                redirect_with_msg('raw_materials/rm_lot/index', 'Successfully Deleted');
            }else{
                redirect_with_msg('raw_materials/rm_lot/index', 'Data not deleted for an unexpected error');
            }
        }else{
            redirect_with_msg('raw_materials/rm_lot/index', 'Please click on delete button');
        }
    }
    
    
    function subgroup_item_id(){
        $this->setOutputMode(NORMAL);
        $group_id=$this->input->post('group_id');
        $subgroup=$this->input->post('subgroup');
      //  $data['item']=$this->m_common->get_row_array('items',array('item_group'=>$group_id,'item_category'=>$subgroup),'*','',1,'item_number','DESC');
        $data['group_id']=$this->m_common->get_row_array('item_code',array('group_id'=>$group_id),'*','',1,'id','DESC');
       // $data['group_info']=$this->m_common->get_row_array('item_groups',array('id'=>$group_id),'*');
        
        
        
        $data['item']=$this->m_common->get_row_array('rm_lots',array('item_category'=>$subgroup),'*','',1,'item_number','DESC');
        $data['groups']=$this->m_common->get_row_array('item_category',array('c_id'=>$subgroup),'*');
        $data['group_info']=$this->m_common->get_row_array('item_groups',array('id'=>$data['groups'][0]['group_id']),'*');
        
        echo json_encode($data);
     }
    
    
     
    function getLcDetails(){
        $this->setOutputMode(NORMAL);
        $lc_id=$this->input->post('lc_id');
        $data['lot_info']=$this->m_common->get_row_array('import_lc',array('lc_id'=>$lc_id),'*');
        if(!empty($data['lot_info'])){
            $data['lot_info'][0]['date']=date('d-m-Y',strtotime($data['lot_info'][0]['date']));
        }
        $sql="select iscd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length from import_lc_details iscd left join rm_items rmi on iscd.item_id=rmi.id where iscd.lc_id=".$lc_id;
        $data['lc_details']=$this->m_common->customeQuery($sql);
        echo json_encode($data);
        
    } 
     
    
     
    
}

