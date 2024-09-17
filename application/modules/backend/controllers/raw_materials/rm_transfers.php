<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rm_transfers extends Site_Controller {

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
        $this->menu = 'general_store';
        $this->sub_menu = 'production_receive';
        $this->sub_inner_menu = 'rm_transfers';
        $this->titlebackend("RM Transfers");
       
        $branch_id= $this->session->userdata('companyId');

     
        $sql="select tic.*,tc.tr_no,tc.tr_date,tc.issue_no,tc.issue_date,i.item_name,i.item_code,c.c_name from rm_issue_details tic 
left join rm_issue tc on tic.issue_id=tc.id             
left join rm_items i on i.id = tic.item_id
left join tbl_customers c on tc.customer_id=c.id where tc.issue_type='Transfer' and tc.branch_id=".$branch_id ." order by tic.id DESC";
         
        $data['transfers']=$this->m_common->customeQuery($sql);
        $this->load->view('raw_materials/rm_transfers/v_transfer',$data);
    }
    
    
    
    
    function add_rm_transfer() {
        $this->menu = 'general_store';
        $this->sub_menu = 'consumption';
        $this->sub_inner_menu = 'rm_transfers';
        
        $this->titlebackend("RM Transfer");
        $branch_id= $this->session->userdata('companyId');
        $employee_id= $this->session->userdata('employeeId');
        
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        
        $sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length from rm_lots_details iscd left join rm_lots rml on iscd.lot_id=rml.id left join rm_items rmi on iscd.item_id=rmi.id  where rml.is_active=1 and rml.branch_id=".$branch_id;        
        $data['lots']=$this->m_common->customeQuery($sql);    
           
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        $data['employees']=$this->m_common->get_row_array('employees','','*');
        
        $all_issue=$this->m_common->get_row_array('rm_issue',array('branch_id'=>$branch_id,'issue_type'=>"Transfer",'is_active'=>1),'*'); 
        if(!empty($all_issue)){
           
            $r_code=count($all_issue)+1;
            if($r_code>999){
                $issue_no=$data['branch_info'][0]['short_name']."/I".$r_code;
            }else if($r_code>99){
                $issue_no=$data['branch_info'][0]['short_name']."/I0".$r_code;
            }else if($r_code>9){
                $issue_no=$data['branch_info'][0]['short_name']."/I00".$r_code;
            }else{
                $issue_no=$data['branch_info'][0]['short_name']."/I000".$r_code;
            }
        }else{
           
            $issue_no=$data['branch_info'][0]['short_name'].'/I0001';
        }
        
        $data['issue_no'] =$issue_no;
        
        
        
         
        if(!empty($_POST)){
            
           $postData = $this->input->post();
           $consumptionInfo=array();
           
           $consumptionInfo['issue_no']= $postData['issue_no'];   
           $consumptionInfo['issue_date']= date('Y-m-d',  strtotime($postData['issue_date']));
           $consumptionInfo['tr_date']= date('Y-m-d',  strtotime($postData['tr_date']));
           $consumptionInfo['tr_no']= $postData['tr_no'];           
          // $consumptionInfo['customer_id']= $postData['customer_id'];
           $consumptionInfo['created_date']=date('Y-m-d');
           $consumptionInfo['created_by']=$employee_id;
           $consumptionInfo['issue_type']="Transfer";
           $consumptionInfo['branch_id']=$branch_id;
           $consumptionInfo['issue_remark']= $postData['issue_remark'];
           $c_info_id=$this->m_common->insert_row('rm_issue',$consumptionInfo);
           
           $consuptionInsert = array();
           foreach ($postData['item_id'] as $key=>$row){
               
             $consuptionInsert['issue_id']=$c_info_id; 
             $consuptionInsert['item_id']= $postData['item_id'][$key]; 
             $consuptionInsert['lot_d_id']= $postData['lot_d_id'][$key];  
             $consuptionInsert['lot_id']= $postData['lot_id'][$key];
             $consuptionInsert['stock_qty']= $postData['stock_qty'][$key];
             $consuptionInsert['bale_qty']= $postData['bale_qty'][$key];
             $consuptionInsert['primary_issue_qty']= $postData['issue_qty'][$key];
             $consuptionInsert['issue_qty']= $postData['issue_qty'][$key];
             $consuptionInsert['rate']= $postData['rate'][$key];
             $consuptionInsert['amount']= round($postData['rate'][$key]*$postData['issue_qty'][$key],2);
             $consuptionInsert['remarks']= $postData['remarks'][$key];
             $consuptionInsert['package_id']=3;
             $consumption_id = $this->m_common->insert_row('rm_issue_details',$consuptionInsert);
            
             
             
            
           }
         redirect_with_msg('raw_materials/rm_transfers', 'Consumption  Successfully Inserted');  
        }else{
            
         
            
            
         $this->load->view('raw_materials/rm_transfers/v_add_transfer',$data);   
        }
        
    }
    
    function edit_rm_transfer($issue_id){
        $this->menu = 'general_store';
        $this->sub_menu = 'consumption';
        $this->sub_inner_menu = 'rm_transfers';
        $this->titlebackend("RM Transfer");
        $branch_id= $this->session->userdata('companyId');
        $employee_id= $this->session->userdata('employeeId');
        
        $sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length from rm_lots_details iscd left join rm_lots rml on iscd.lot_id=rml.id left join rm_items rmi on iscd.item_id=rmi.id  where rml.is_active=1 and rml.branch_id=".$branch_id;        
        $data['lots']=$this->m_common->customeQuery($sql);
        
        $data['employees']=$this->m_common->get_row_array('employees','','*');
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
       
        $data['issue_info'] =$this->m_common->get_row_array('rm_issue', array('id'=>$issue_id), '*');
        
        $sql ="select tic.*,tc.do_no,tc.do_date,tc.issue_no,tc.issue_date,i.item_name,i.item_code,i.origin,i.staple_length,tmu.meas_unit,d.dept_name from rm_issue_details tic 
left join rm_issue tc on tic.issue_id=tc.id             
left join rm_items i on i.id = tic.item_id
left join tbl_measurement_unit tmu on i.mu_id=tmu.id
left join tbl_departments d on tc.dept_id=d.id  where tic.issue_id=".$issue_id;
        
        $data['issue_details']=$this->m_common->customeQuery($sql);
        
        
       

        if(!empty($_POST)){
           $postData = $this->input->post();
           $consumptionInfo=array();
           
              
           $consumptionInfo['issue_no']= $postData['issue_no'];
           $consumptionInfo['issue_date']= date('Y-m-d',  strtotime($postData['issue_date']));
           $consumptionInfo['tr_date']= date('Y-m-d',  strtotime($postData['tr_date']));
           $consumptionInfo['tr_no']= $postData['tr_no'];        
          // $consumptionInfo['customer_id']= $postData['customer_id'];
           $consumptionInfo['updated_date']=date('Y-m-d');
           $consumptionInfo['updated_by']=$employee_id;
           $consumptionInfo['issue_remark']= $postData['issue_remark'];
           
           $result=$this->m_common->update_row('rm_issue',array('id'=>$issue_id),$consumptionInfo);
           if($result>=0){
                $this->m_common->delete_row('rm_issue_details', array('issue_id' =>$issue_id));
                
                foreach ($postData['item_id'] as $key=>$row){
                  $consuptionInsert = array();  
                  $consuptionInsert['issue_id']=$issue_id; 
                  $consuptionInsert['lot_d_id']= $postData['lot_d_id'][$key];  
                  $consuptionInsert['lot_id']= $postData['lot_id'][$key];                 
                  $consuptionInsert['item_id']= $postData['item_id'][$key];   
                  $consuptionInsert['stock_qty']= $postData['stock_qty'][$key];
                  $consuptionInsert['bale_qty']= $postData['bale_qty'][$key];
                  $consuptionInsert['primary_issue_qty']= $postData['issue_qty'][$key];
                  $consuptionInsert['issue_qty']= $postData['issue_qty'][$key];
                  $consuptionInsert['rate']= $postData['rate'][$key];
                  $consuptionInsert['amount']= round($postData['rate'][$key]*$postData['issue_qty'][$key],2);
                  $consuptionInsert['remarks']= $postData['remarks'][$key];
                  $consuptionInsert['package_id']=3;
                  $this->m_common->insert_row('rm_issue_details',$consuptionInsert);

                }
           }
         redirect_with_msg('raw_materials/rm_transfers/details_rm_transfer/'.$issue_id, 'Successfully Updated');  
        }else{                        
           $this->load->view('raw_materials/rm_transfers/v_edit_transfer',$data);   
        }
        
    }
    
    function details_rm_transfer($issue_id,$print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'consumption';
        $this->sub_inner_menu = 'rm_transfers';
        $this->titlebackend("RM Transfer");
        $branch_id= $this->session->userdata('companyId');
        
        $sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length from rm_lots_details iscd left join rm_lots rml on iscd.lot_id=rml.id left join rm_items rmi on iscd.item_id=rmi.id  where rml.is_active=1 and rml.branch_id=".$branch_id;        
        $data['lots']=$this->m_common->customeQuery($sql);
        
        $data['employees']=$this->m_common->get_row_array('employees','','*');
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
       
        $data['issue_info'] =$this->m_common->get_row_array('rm_issue', array('id'=>$issue_id), '*');
        
        $sql ="select tic.*,tc.sr_no,tc.sr_date,tc.issue_no,tc.issue_date,i.item_name,i.item_code,i.origin,i.staple_length,tmu.meas_unit,d.dept_name from rm_issue_details tic 
left join rm_issue tc on tic.issue_id=tc.id             
left join rm_items i on i.id = tic.item_id
left join tbl_measurement_unit tmu on i.mu_id=tmu.id
left join tbl_departments d on tc.dept_id=d.id  where tic.issue_id=".$issue_id;
        $data['issue_details']=$this->m_common->customeQuery($sql);
               
        if($print==false){
            $this->load->view('raw_materials/rm_transfers/v_details_transfer',$data);   
        }else{
           $html=$this->load->view('raw_materials/rm_transfers/print_transfer',$data,true);
           echo $html;exit; 
        }
      
        
    }
    
    function delete_rm_transfer($consumption_id){
        if (!empty($consumption_id)){
            $id=$this->m_common->delete_row('rm_issue',array('id'=>$consumption_id));       
            if (!empty($id)) {
                $this->m_common->delete_row('rm_issue_details', array('issue_id' => $consumption_id));
                redirect_with_msg('raw_materials/rm_transfers', 'Successfully Deleted');
            } else {
                redirect_with_msg('raw_materials/rm_transfers', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/rm_transfers', 'Please click on delete button');
        }
    }
    
    
    function approved_transfer($issue_id){
        $unit_id= $this->session->userdata('companyId');
        if(!empty($consumption_id)){
            $consumption=$this->m_common->get_row_array('rm_issue_details',array('issue_id'=>$issue_id),'*');           
            if(!empty($consumption)){
                       
                $this->m_common->update_row('rm_issue_details',array('issue_id'=>$issue_id),array('status'=>'Approved'));
               
               redirect_with_msg('raw_materials/rm_transfers', 'Successfully Approved');
            } else {
                redirect_with_msg('raw_materials/rm_transfers', 'Data not Approved for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/rm_transfers', 'Please click on Approved button');
        }
    }
    
    
    function materialInfo(){
        $this->setOutputMode(NORMAL);
        $lot_d_id=$this->input->post('lot_d_id');
        
        $sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_lots_details iscd left join rm_lots rml on iscd.lot_id=rml.id left join rm_items rmi on iscd.item_id=rmi.id left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id where rml.is_active=1 and iscd.id=".$lot_d_id;
        $data['materialinfo']=$this->m_common->customeQuery($sql);
        if(!empty($data['materialinfo'])){
            $r_sql="select sum(receive_qty) as total_receive from rm_receive_details where lot_d_id=".$lot_d_id;
            $receive=$this->m_common->customeQuery($r_sql);
            
            $is_sql="select sum(issue_qty) as total_issue from rm_issue_details where lot_d_id=".$lot_d_id;
            $issue=$this->m_common->customeQuery($is_sql);
            $stock=$receive[0]['total_receive']-$issue[0]['total_issue'];
            
            $data['materialinfo'][0]['stock_qty']=$stock;
        }
        echo json_encode($data);
    }
    
    
    
    
}

