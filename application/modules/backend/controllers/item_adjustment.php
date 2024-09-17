<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Item_adjustment extends Site_Controller {

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
      //  $this->sub_menu = 'item_information';
      //  $this->sub_menu = 'set_up';
        $this->sub_inner_menu = 'item_adjustment';
        $this->titlebackend("Item Adjustment");
        $branch_id= $this->session->userdata('companyId'); 
    
        $sql="select tios.*,i.item_name,i.item_type,i.item_code,ig.item_group as item_category,ic.c_name,tmu.meas_unit,tib.brand_name from tbl_item_adjustment tios left join items i on tios.item_id=i.id left join item_groups ig on i.item_group=ig.id left join item_category ic on i.item_category=ic.c_id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_item_brand tib on tios.brand_id=tib.id where tios.is_active=1 and tios.unit_id=".$branch_id;
        $data['items']=$this->m_common->customeQuery($sql); 
       
        $this->load->view('adjustment/v_item_adjustment',$data);
    }

   
    function addAdjustment() {
        $branch_id= $this->session->userdata('companyId');
        $this->sub_inner_menu = 'item_adjustment';
        $this->titlebackend("Item Adjustment");
        $branch_id= $this->session->userdata('companyId'); 
    
        $sql="select * from items";
        $data['items']=$this->m_common->customeQuery($sql);  
        
        $this->load->view('adjustment/v_add_adjustment',$data);
    }
     
     
   function getBrandInfo(){
        $this->setOutputMode(NORMAL);
        $brands= $this->m_common->get_row_array('tbl_item_brand',array('is_active'=>1),'*');
        $item_id=$this->input->post('item_id');
        $item_info=$this->m_common->get_row_array('items',array('id'=>$item_id),"*");
        $item_brands=  unserialize($item_info[0]['brand_id']);   
        $brands1=array();
        foreach($brands as $key1=>$brand){
            
            if(!empty($item_brands)){  
                if(in_array($brand['id'],$item_brands)){
                   //unset($brands[$key1]);
                    $brands1[]=$brands[$key1];
                }
            }else{
                unset($brands[$key1]);
            }
        }
        $data['item_brands']=$brands1;
        echo json_encode($data);
    }
    
    function addAdjustmentAction() {
        $this->menu = 'general_store';
      
        $this->sub_inner_menu = 'item_adjustment';
        $this->titlebackend("Item Adjustment");
        $branch_id= $this->session->userdata('companyId');
        $employee_id= $this->session->userdata('employeeId');
        $postData=array();
        $postData['added_by']=$employee_id;
        $postData['added_date']=date('Y-m-d H:i:s');
        $postData['date']=date('Y-m-d',strtotime($this->input->post('date')));
        $postData['unit_id']=$branch_id;
        $postData['item_id']=$this->input->post('item_id');
        $postData['brand_id']=$this->input->post('brand_id');
        $postData['qty']=$this->input->post('qty'); 
        $postData['amount']=$this->input->post('amount'); 
        $postData['challan_no']=$this->input->post('challan_no'); 
        $postData['status']="Pending";
        $postData['remark']=$this->input->post('remark');
        $this->m_common->insert_row('tbl_item_adjustment',$postData);   
        redirect('item_adjustment','Sucessfully Inserted');
       
    }
    
   function editAdjustment($id) {
        $this->menu = 'general_store';
      
        $this->sub_inner_menu = 'opening_stock';
        $this->titlebackend("Item Opening Stock");
        $branch_id= $this->session->userdata('companyId'); 
        $brands= $this->m_common->get_row_array('tbl_item_brand',array('is_active'=>1),'*');
        $sql="select * from items";
        $data['items']=$this->m_common->customeQuery($sql); 
        $data['adjustment_info']=$this->m_common->get_row_array('tbl_item_adjustment',array('id'=>$id),"*");
        $item_info=$this->m_common->get_row_array('items',array('id'=>$data['adjustment_info'][0]['item_id']),"*");
        $item_brands= unserialize($item_info[0]['brand_id']);   
        $brands1=array();
        foreach($brands as $key1=>$brand){
            
            if(!empty($item_brands)){  
                if(in_array($brand['id'],$item_brands)){
                   //unset($brands[$key1]);
                    $brands1[]=$brands[$key1];
                }
            }else{
                unset($brands[$key1]);
            }
        }
        $data['item_brands']=$brands1;
       
        $this->load->view('adjustment/v_edit_adjustment',$data);
    } 
    
    
    function editAdjustmentAction($id) {
        $this->menu = 'general_store';
      
        $this->sub_inner_menu = 'item_adjustment';
        $this->titlebackend("Item Adjustment");
        $branch_id= $this->session->userdata('companyId');
        $employee_id= $this->session->userdata('employeeId');
        $postData=array();
        $postData['updated_by']=$employee_id;
        $postData['updated_date']=date('Y-m-d H:i:s');   
        $postData['date']=date('Y-m-d',strtotime($this->input->post('date')));
        $postData['item_id']=$this->input->post('item_id');
        $postData['brand_id']=$this->input->post('brand_id');
        $postData['qty']=$this->input->post('qty'); 
        $postData['amount']=$this->input->post('amount'); 
        $postData['challan_no']=$this->input->post('challan_no'); 
        $postData['remark']=$this->input->post('remark');
        $this->m_common->update_row('tbl_item_adjustment',array('id'=>$id),$postData);   
        redirect('item_adjustment','Sucessfully Updated');
       
    }
   
   
    
    function confirmAdjustment($adj_id){
        $unit_id= $this->session->userdata('companyId');        
        $this->m_common->update_row('tbl_item_adjustment',array('id'=>$adj_id),array('status'=>'Confirmed'));               
        redirect_with_msg('item_adjustment', 'Successfully Confirmed');
           
    }
    
   
   function deleteAdjustment($adj_id) {
        if (!empty($adj_id)) {
                        
            $id = $this->m_common->delete_row('tbl_item_adjustment', array('id' =>$adj_id));
            if (!empty($id)) {
                redirect_with_msg('item_adjustment', 'Successfully Deleted');
            } else {
                redirect_with_msg('item_adjustment', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('item_adjustment', 'Please click on delete button');
        }
    }

     
   
     
  

}




