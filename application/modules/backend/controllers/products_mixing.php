<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products_mixing extends Site_Controller {

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
        $this->sub_inner_menu = 'product_mixing';
        $this->titlebackend("Product Mixing");
       // $data['quotations']=$this->m_common->get_row_array('tbl_sales_quotation
        $sql="select mp.*,p.product_name,p.p_psi,p.measurement_unit,p.performance from tbl_mixing_products mp left join tbl_sales_products p on mp.product_id=p.product_id where mp.is_active=1";
        $data['mixings']=$this->m_common->customeQuery($sql);
        $this->load->view('products_mixing/v_product_mixing',$data);
    }

   
    function add_product_mixing() {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'product_mixing';
        
        $this->titlebackend("Mixing Material Information");
        $mixing_products=$this->m_common->get_row_array('tbl_mixing_products',array('is_active'=>1),'*');
        foreach($mixing_products as $m_p){
            $m_products[]=$m_p['product_id'];
        }
        $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
        foreach($data['products'] as $key=>$value){
            if(in_array($value['product_id'],$m_products)){
                unset($data['products'][$key]);
            }
        }
        $data['materials']=$this->m_common->get_row_array('items',array('is_active'=>1),'*');
        $data['measurement_units']=$this->m_common->get_row_array('tbl_measurement_unit','','*');
        $this->load->view('products_mixing/v_add_product_mixing',$data);
    }
    function add_product_mixing_action() {
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             if(!empty($postData['product_id'])){
                 $insertData['product_id']=$postData['product_id'];
                 $pre_mixing=$this->m_common->get_row_array('tbl_mixing_products',array('product_id'=>$postData['product_id'],'is_active'=>1),'*');
                 if(!empty($pre_mixing)){
                     redirect_with_msg('products_mixing/add_product_mixing', 'Already mixed this product');
                 }
                 
             }
             
             $insertData['is_active']=1;
             $insertData['created_date']=date('Y-m-d');
             $result=$this->m_common->insert_row('tbl_mixing_products',$insertData);
             if(!empty($result)){
                  foreach ($postData['m_id'] as $key => $each) {
                      $insertData1=array();
                      $insertData1['mixing_id'] = $result;
                      $insertData1['m_id'] = $each;
                      $insertData1['is_active']=1;
                      if(empty($each)){
                          continue;
                      }
                      if(!empty($postData['quantity'][$key])) {
                           $insertData1['quantity'] = $postData['quantity'][$key];
                       }
                       if(!empty($postData['conversion_factor'][$key])) {
                           $insertData1['conversion_factor'] = $postData['conversion_factor'][$key];
                       }
                       
                       if(!empty($postData['conversion_factor'][$key])) {
                           $insertData1['conversion_factor'] = $postData['conversion_factor'][$key];
                       }
                       
                       if(!empty($postData['c_quantity'][$key])) {
                           $insertData1['c_quantity'] = $postData['c_quantity'][$key];
                       }
                       
                       if(!empty($postData['mu_id'][$key])) {
                           $insertData1['mu_id'] = $postData['mu_id'][$key];
                       }
                       
                       if(!empty($postData['c_mu'][$key])) {
                           $insertData1['c_mu'] = $postData['c_mu'][$key];
                       }
                 
                      $this->m_common->insert_row('tbl_mixing_product_materials',$insertData1);
                  }
                  redirect_with_msg('products_mixing', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('products_mixing/add_product_mixing', 'Please fill the form and submit');
         }
         
     }
    
      function edit_product_mixing($id) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'product_mixing';
        
        $this->titlebackend("Mixing Material Information");
        $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
        $data['materials']=$this->m_common->get_row_array('items',array('is_active'=>1),'*');
       // $data['mixing_info']=$this->m_common->get_row_array('tbl_mixing_products',array('mixing_id'=>$id),'*');
        $m_sql="select mp.*,sp.measurement_unit from tbl_mixing_products mp left join tbl_sales_products sp on mp.product_id=sp.product_id where mixing_id=".$id;
        $data['mixing_info']=$this->m_common->customeQuery($m_sql);
        $sql="select d.*,item.meas_unit from tbl_mixing_product_materials d left join items item on d.m_id=item.id where d.is_active=1 and mixing_id=".$id;
        $data['mixing_details_info']=$this->m_common->customeQuery($sql);
        $data['measurement_units']=$this->m_common->get_row_array('tbl_measurement_unit','','*');
        $this->load->view('products_mixing/v_edit_product_mixing',$data);
    }
    
    function edit_product_mixing_action($m_id) {
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();    
             if(!empty($postData['product_id'])){
                 $insertData['product_id']=$postData['product_id'];
             }
             $result=$this->m_common->update_row('tbl_mixing_products',array('mixing_id'=>$m_id),$insertData);
             if($result>=0){
                 $this->m_common->delete_row('tbl_mixing_product_materials',array('mixing_id'=>$m_id));
                 foreach ($postData['m_id'] as $key => $each) {
                      $insertData1=array();
                      $insertData1['mixing_id'] = $m_id;
                      $insertData1['m_id'] = $each;
                      $insertData1['is_active']=1;
                      if(empty($each)){
                          continue;
                      }
                      if(!empty($postData['quantity'][$key])) {
                           $insertData1['quantity'] = $postData['quantity'][$key];
                       }
                       
                       if(!empty($postData['conversion_factor'][$key])) {
                           $insertData1['conversion_factor'] = $postData['conversion_factor'][$key];
                       }
                       
                       if(!empty($postData['c_quantity'][$key])) {
                           $insertData1['c_quantity'] = $postData['c_quantity'][$key];
                       }
                       
                       if(!empty($postData['mu_id'][$key])) {
                           $insertData1['mu_id'] = $postData['mu_id'][$key];
                       }
                       
                       if(!empty($postData['c_mu'][$key])) {
                           $insertData1['c_mu'] = $postData['c_mu'][$key];
                       }
                      
                      $this->m_common->insert_row('tbl_mixing_product_materials',$insertData1);
                  }
                  redirect_with_msg('products_mixing', 'Successfully Updated');
             }
         }else{
              redirect_with_msg('products_mixing/edit_product_mixing/'.$m_id, 'Please fill the form and submit');
         }
         
     }
     
     function delete_product_mixing($m_id) {
        if(!empty($m_id)) {
            $id = $this->m_common->update_row('tbl_mixing_products', array('mixing_id' =>$m_id),array('is_active'=>0));
            if (!empty($id)) {
                $this->m_common->update_row('tbl_mixing_product_materials', array('mixing_id' => $m_id),array('is_active'=>0));
                redirect_with_msg('products_mixing/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('products_mixing/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('products_mixing/index', 'Please click on delete button');
        }
    }
    
     function get_product_info(){
        $this->setOutputMode(NORMAL);
        $id=$this->input->post('product_id');
        
        $data['product_info']=$this->m_common->get_row_array('tbl_sales_products',array('product_id'=>$id),'*');
       
        echo json_encode($data);
    }
     
    function get_item_material(){
        $this->setOutputMode(NORMAL);
        $id=$this->input->post('id');
        
        $data['item_info']=$this->m_common->get_row_array('tbl_sales_items',array('s_item_id'=>$id),'*');
        //$sql="select tbl_d.*,tbl_m.m_name from tbl_sales_item_details tbl_d left join tbl_materials tbl_m on tbl_d.m_id=tbl_m.m_id where tbl_d.s_item_id=".$id;
        $sql="select tbl_d.*,items.item_name from tbl_sales_item_details tbl_d left join items  on tbl_d.m_id=items.id where tbl_d.s_item_id=".$id;
        $data['item_list']=$this->m_common->customeQuery($sql);
  //       $data['item_list']=$this->m_common->get_row_array('items','','*');
        
        echo json_encode($data);
    }
   
     
   

}





