<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Return_receive extends Site_Controller {

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
        $this->menu = 'general_store';    
        $this->sub_inner_menu = 'return_receive';
        $this->titlebackend("Return Receive Register");
    
        $sql="select * from rm_receive where mrr_type='Return Receive' and unit_id=".$branch_id." ORDER BY mrr_id DESC ";
        $data['mrrs'] = $this->m_common->customeQuery($sql);
        $this->load->view('raw_materials/return_receive/v_return_receive',$data);
    }
    
    // Start Material Receive Requisition(MRR)  
    
    
    
    
    
    function add_return_receive() {
        $this->menu = 'general_store';   
        
        $this->sub_inner_menu = 'rm_receive';
        
        $this->titlebackend("Add Material Receive Requisition");
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $branch_id= $this->session->userdata('companyId');
       
        
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        $data['departments'] = $this->m_common->get_row_array('tbl_departments',array('is_active'=>1), '*');
     
        $sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length from rm_lots_details iscd left join rm_lots rml on iscd.lot_id=rml.id left join rm_items rmi on iscd.item_id=rmi.id  where rml.is_active=1 and rml.branch_id=".$branch_id;        
        $data['lots']=$this->m_common->customeQuery($sql);    
        
        
        $all_return=$this->m_common->get_row_array('rm_receive',array('unit_id'=>$branch_id,'mrr_type'=>"Return Receive",'is_active'=>1),'*'); 
        if(!empty($all_return)){
           
            $r_code=count($all_return)+1;
            if($r_code>999){
                $return_no=$data['branch_info'][0]['short_name']."/R".$r_code;
            }else if($r_code>99){
                $return_no=$data['branch_info'][0]['short_name']."/R0".$r_code;
            }else if($r_code>9){
                $return_no=$data['branch_info'][0]['short_name']."/R00".$r_code;
            }else{
                $return_no=$data['branch_info'][0]['short_name']."/R000".$r_code;
            }
        }else{
           
            $return_no=$data['branch_info'][0]['short_name'].'/R0001';
        }
        
        $data['return_no'] =$return_no;
        $this->load->view('raw_materials/return_receive/v_add_return_receive',$data);
    }
    
    function add_action_return_receive(){
        $this->menu = 'general_store';
        $this->sub_menu = 'return_receive';
        $this->titlebackend("Add Return Receive");
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $branch_id= $this->session->userdata('companyId');
        $postData = $this->input->post();
        
        if (!empty($postData)) {
            $insertData = array();
            
            if(!empty($postData['dept_id'])){
                $insertData['dept_id'] = $postData['dept_id']; 
            }
            
            if(!empty($postData['return_no'])){
                $insertData['return_no'] = $postData['return_no']; 
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
           
            if(!empty($postData['mrr_remark'])){
                $insertData['mrr_remark'] = $postData['mrr_remark']; 
            }
            
            
            $insertData['mrr_type'] ="Return Receive";
            
            $insertData['unit_id'] =$branch_id;
            
            $insertData['created'] = date('Y-m-d');
            $insertData['created_by'] =$employee_id;
          
            
             
           
            
            
            $id = $this->m_common->insert_row('rm_receive', $insertData);
            if (!empty($id)) {
                foreach ($postData['item_id'] as $key => $each) {
                      
                                $insertData1=array();
                                $insertData1['item_id'] = $each;
                                $insertData1['mrr_id'] = $id;
                                $insertData1['receive_date'] = $receive_date;
                                $insertData1['bill_status'] ='Pending';
                                $insertData1['payment_status'] ='Pending';
                                
                                
                                $insertData1['package_id']=3;
                                
                                if(!empty($postData['lot_d_id'][$key])) {
                                    $insertData1['lot_d_id'] =$postData['lot_d_id'][$key];
                                }
                               
                                if(!empty($postData['lot_id'][$key])) {
                                    $insertData1['lot_id'] =$postData['lot_id'][$key];
                                }
                                
                                
                                
                    
                                
                                $insertData1['accepted_bale_qty'] = $postData['accepted_bale_qty'][$key];
                                
                               
                               
                                if(!empty($postData['receive_qty'][$key])){
                                    $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                                }
                                
                               
                                
                                if(!empty($postData['unit_price'][$key])){
                                    $insertData1['unit_price'] = $postData['unit_price'][$key];
                                }
                               
                                if (!empty($postData['amount'][$key])){
                                    $insertData1['amount'] = $postData['amount'][$key];
                                }
                                if(!empty($postData['remark'][$key])){
                                    $insertData1['remark'] = $postData['remark'][$key];
                                }
                                $this->m_common->insert_row('rm_receive_details', $insertData1); 
                             
                      
                   
                 }
                redirect_with_msg('raw_materials/return_receive/', 'Successfully Inserted');
            } else {
                redirect_with_msg('raw_materials/return_receive/add_return_receive', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/return_receive/add_return_receive', 'Please fill the form and submit');
        }
        
    }
    
function edit_return_receive($id) {
    $this->menu = 'general_store';
    $this->sub_inner_menu = 'return_receive';
    $employee_id = $this->session->userdata('employeeId');
    $user_type = $this->session->userdata('user_type');
    $user_id = $this->session->userdata('user_id');
    $branch_id= $this->session->userdata('companyId');

    $this->titlebackend("Edit Material Receive Requisition");
    
    $data['departments'] = $this->m_common->get_row_array('tbl_departments',array('is_active'=>1), '*');
     
    $sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length from rm_lots_details iscd left join rm_lots rml on iscd.lot_id=rml.id left join rm_items rmi on iscd.item_id=rmi.id  where rml.is_active=1 and rml.branch_id=".$branch_id;        
    $data['lots']=$this->m_common->customeQuery($sql);    
    
    
    $r_sql="select * from rm_receive where mrr_id=".$id;
    $data['mrr'] = $this->m_common->customeQuery($r_sql);

    

    
    $sql="select rmrd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,rl.lot_number,tmu.meas_unit from rm_receive_details rmrd left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id left join rm_items rmi on rmrd.item_id=rmi.id left join rm_lots_details rld on rmrd.lot_d_id=rld.id left join rm_lots rl on rld.lot_id=rl.id left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id where rmrd.mrr_id=".$id;
    $data['receive_items']=$this->m_common->customeQuery($sql);

    $this->load->view('raw_materials/return_receive/v_edit_return_receive',$data);
}
    
    
function details_return_receive($id,$print=false) {
    $this->menu = 'general_store';
    $this->sub_inner_menu = 'return_receive';

    $employee_id = $this->session->userdata('employeeId');
    $user_type = $this->session->userdata('user_type');
    $user_id = $this->session->userdata('user_id');
    $branch_id= $this->session->userdata('companyId');


    $this->titlebackend("Details Material Receive Requisition");
    $data['departments'] = $this->m_common->get_row_array('tbl_departments',array('is_active'=>1), '*');
     
    $sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length from rm_lots_details iscd left join rm_lots rml on iscd.lot_id=rml.id left join rm_items rmi on iscd.item_id=rmi.id  where rml.is_active=1 and rml.branch_id=".$branch_id;        
    $data['lots']=$this->m_common->customeQuery($sql);    
    
    
    $r_sql="select * from rm_receive where mrr_id=".$id;
    $data['mrr'] = $this->m_common->customeQuery($r_sql);

   
    $sql="select rmrd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,rl.lot_number,tmu.meas_unit from rm_receive_details rmrd left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id left join rm_items rmi on rmrd.item_id=rmi.id left join rm_lots_details rld on rmrd.lot_d_id=rld.id left join rm_lots rl on rld.lot_id=rl.id left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id where rmrd.mrr_id=".$id;
    $data['receive_items']=$this->m_common->customeQuery($sql);
        
    if($print==false){
        $this->load->view('raw_materials/return_receive/v_details_return_receive',$data);
    }else{
        $html=$this->load->view('raw_materials/return_receive/print_return_receive',$data,true);
        echo $html;
        exit; 
    }
}
    

    


function edit_action_return_receive($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'rm_receive';
        $this->titlebackend("Edit Material Receive Requisition");
        
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $branch_id= $this->session->userdata('companyId');
        
        $postData = $this->input->post();
        if(!empty($postData)){
            $insertData = array();
            
            
            
            if(!empty($postData['dept_id'])){
                $insertData['dept_id'] = $postData['dept_id']; 
            }
            
            if(!empty($postData['return_no'])){
                $insertData['return_no'] = $postData['return_no']; 
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
            
            
           
            if(!empty($postData['mrr_remark'])){
                $insertData['mrr_remark'] = $postData['mrr_remark']; 
            }
            
            $insertData['updated_date'] = date('Y-m-d');
            $insertData['updated_by'] =$employee_id;
            
           
            $s_id=$this->m_common->update_row('rm_receive',array('mrr_id'=>$id),$insertData);
            $delete_details=$this->m_common->delete_row('rm_receive_details',array('mrr_id'=>$id));
            if (!empty($s_id)) {
                  foreach ($postData['item_id'] as $key => $each) {
                    $insertData1=array();
                    $insertData1['item_id'] = $each;
                    $insertData1['mrr_id'] = $id;
                    $insertData1['receive_date'] = $receive_date;

                    $insertData1['package_id']=3;



                     if(!empty($postData['lot_d_id'][$key])) {
                         $insertData1['lot_d_id'] =$postData['lot_d_id'][$key];
                     }

                     if(!empty($postData['lot_id'][$key])) {
                         $insertData1['lot_id'] =$postData['lot_id'][$key];
                     }


                     $insertData1['accepted_bale_qty'] = $postData['accepted_bale_qty'][$key];


                     if(!empty($postData['receive_qty'][$key])){
                         $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                     }


                     if (!empty($postData['unit_price'][$key])) {
                         $insertData1['unit_price'] = $postData['unit_price'][$key];
                     }

                     if (!empty($postData['amount'][$key])) {
                         $insertData1['amount'] = $postData['amount'][$key];
                     }
                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('rm_receive_details', $insertData1);
                   
                 }
                
                    redirect_with_msg('raw_materials/return_receive/details_return_receive/'.$id, 'Successfully Updated Material Receive Requisition');
              
            }else{
                  foreach ($postData['item_id'] as $key => $each) {
                    $insertData1=array();
                    $insertData1['item_id'] = $each;
                    $insertData1['mrr_id'] = $id;
                    $insertData1['receive_date'] = $receive_date;
                    $insertData1['package_id']=3;

                    if(!empty($postData['lot_d_id'][$key])) {
                        $insertData1['lot_d_id'] =$postData['lot_d_id'][$key];
                    }

                    if(!empty($postData['lot_id'][$key])) {
                        $insertData1['lot_id'] =$postData['lot_id'][$key];
                    }


                    $insertData1['accepted_bale_qty'] = $postData['accepted_bale_qty'][$key];


                    if(!empty($postData['receive_qty'][$key])){
                        $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                    }


                    if (!empty($postData['unit_price'][$key])) {
                        $insertData1['unit_price'] = $postData['unit_price'][$key];
                    }

                    if (!empty($postData['amount'][$key])) {
                        $insertData1['amount'] = $postData['amount'][$key];
                    }
                    if (!empty($postData['remark'][$key])) {
                        $insertData1['remark'] = $postData['remark'][$key];
                    }

                    $this->m_common->insert_row('rm_receive_details', $insertData1);
                  
                 }
                 redirect_with_msg('raw_materials/return_receive/details_return_receive/'.$id, 'Successfully Updated');
            }
        } else {
            redirect_with_msg('raw_materials/return_receive/edit_return_receive/'.$id, 'Please fill the form and submit');
        }
    }
    
    function delete_return_receive($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'rm_receive';
        $this->titlebackend("Material Receive Requisition");
         if (!empty($id)) {  
            $ids = $this->m_common->delete_row('rm_receive', array('mrr_id' => $id));
            if(!empty($ids)){             
                $this->m_common->delete_row('rm_receive_details', array('mrr_id' => $id));              
                redirect_with_msg('raw_materials/return_receive', 'Successfully Deleted');
            } else {
                redirect_with_msg('raw_materials/return_receive', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/return_receive', 'Please click on delete button');
        }
    }
    
//End Material Receive Requisition(MRR)   
    
    function getLcLotDetails(){
        $this->setOutputMode(NORMAL);
        $lc_id=$this->input->post('lc_id');
        $data['lot_info']=$this->m_common->get_row_array('import_lc',array('lc_id'=>$lc_id),'*');
        if(!empty($data['lot_info'])){
            $data['lot_info'][0]['date']=date('d-m-Y',strtotime($data['lot_info'][0]['date']));
        }
        $sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length from rm_lots_details iscd left join rm_lots rml on iscd.lot_id=rml.id left join rm_items rmi on iscd.item_id=rmi.id where (iscd.receive_status='Pending' or iscd.receive_status='Partially Received') and  rml.is_active=1 and rml.lc_id=".$lc_id;
        $data['lc_details']=$this->m_common->customeQuery($sql);
        echo json_encode($data);
        
    } 
    
    
    function confirmReceive($id){
        $branch_id= $this->session->userdata('companyId');        
        $material_receive_info=$this->m_common->get_row_array('rm_receive',array('mrr_id'=>$id),'*');
        $receive_items=$this->m_common->get_row_array('rm_receive_details',array('mrr_id'=>$id),'*');
        
        $result=$this->m_common->update_row('rm_receive',array('mrr_id'=>$id),array('mrr_status'=>"received"));
        
        redirect_with_msg('raw_materials/return_receive', 'Successfully Received');
    }
    
    
    function materialInfo(){
        $this->setOutputMode(NORMAL);
        $lot_d_id=$this->input->post('lot_d_id');
        
        $sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_lots_details iscd left join rm_lots rml on iscd.lot_id=rml.id left join rm_items rmi on iscd.item_id=rmi.id left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id where (iscd.receive_status='Pending' or iscd.receive_status='Partially Received') and  rml.is_active=1 and iscd.id=".$lot_d_id;
        $data['materialinfo']=$this->m_common->customeQuery($sql);
        echo json_encode($data);
    }
    
    
}

