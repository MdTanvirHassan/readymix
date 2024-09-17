<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Delivery_challans extends Site_Controller {

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
        $this->menu = 'sales';
        $this->sub_menu = 'delivery_challan';
        $this->titlebackend("Delivery Challan");
       // $data['sale_challan']=$this->m_common->get_row_array('tbl_sales_sale_challan
        $sql="select dc.*,do.delivery_no,c.c_name from tbl_delivery_challans dc left join tbl_delivery_orders do on dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where dc.is_active=1";
        $data['delivery_challans']=$this->m_common->customeQuery($sql);
        $this->load->view('delivery_challans/v_delivery_challan',$data);
    }

   
     function add_delivery_challan() {
        $this->menu = 'sales';
        $this->sub_menu = 'delivery_challan';
        $this->titlebackend("Quotation Information");
       // $data['items']=$this->m_common->get_row_array('tbl_sales_items','','*');
        $sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and do.status='Pending' ";
        $data['delivery_orders']=$this->m_common->customeQuery($sql);
        $this->load->view('delivery_challans/v_add_delivery_challan',$data);
    }
     function add_delivery_challan_action() {
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             if(!empty($postData['do_id'])){
                 $insertData['do_id']=$postData['do_id'];
                 $do_id=$postData['do_id'];
             }
             if(!empty($postData['dc_no'])){
                 $insertData['dc_no']=$postData['dc_no'];
             }
             if(!empty($postData['delivery_challan_date'])){
                 $insertData['delivery_challan_date']=date('Y-m-d',strtotime($postData['delivery_challan_date']));
             }
             if(!empty($postData['attention'])){
                 $insertData['attention']=$postData['attention'];
             }
             if(!empty($postData['phone'])){
                 $insertData['phone']=$postData['phone'];
             }
             if(!empty($postData['project_name'])){
                 $insertData['project_name']=$postData['project_name'];
             }
             if(!empty($postData['billing_address'])){
                 $insertData['billing_address']=$postData['billing_address'];
             }
             if(!empty($postData['billing_email'])){
                 $insertData['billing_email']=$postData['billing_email'];
             }
             if(!empty($postData['shipping_address'])){
                 $insertData['shipping_address']=$postData['shipping_address'];
             }
             if(!empty($postData['shipping_email'])){
                 $insertData['shipping_email']=$postData['shipping_email'];
             }
             
             if(!empty($postData['total_amount'])){
                 $insertData['total_amount']=$postData['total_amount'];
             }
             $insertData['is_active']=1;
             $insertData['status']='Pending';
             $insertData['created_date']=date('Y-m-d');
             $result=$this->m_common->insert_row('tbl_delivery_challans',$insertData);
             if(!empty($result)){
                 $this->m_common->insert_row('tbl_delivery_challan_code',array('challan_code'=>$postData['challan_code'],'customer_id'=>$postData['customer_id']));
                 $this->m_common->update_row('tbl_delivery_orders', array('do_id' =>$do_id),array('status'=>"Delivered"));
                  foreach ($postData['s_item_id'] as $key => $each) {
                      $insertData1=array();
                      $insertData1['dc_id'] = $result;
                      $insertData1['s_item_id'] = $each;
                      $insertData1['is_active']=1;
                      if(empty($each)){
                          continue;
                      }
                      if(!empty($postData['quantity'][$key])) {
                           $insertData1['quantity'] = $postData['quantity'][$key];
                       }
                       if(!empty($postData['unit_price'][$key])) { 
                          $insertData1['unit_price'] = $postData['unit_price'][$key];
                       }
                       if(!empty($postData['amount'][$key])) { 
                          $insertData1['amount'] = $postData['amount'][$key];
                       }
                 
                      $this->m_common->insert_row('tbl_delivery_challan_details',$insertData1);
                  }
                  redirect_with_msg('delivery_challans', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('delivery_challans/add_delivery_challan', 'Please fill the form and submit');
         }
         
     }
    
      function edit_delivery_challan($id) {
        $this->menu = 'sales';
        $this->sub_menu = 'delivery_challan';
        $this->titlebackend("Delivery Challan Information");
        $sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Pending' or do.status='Delivered') ";
        $data['delivery_orders']=$this->m_common->customeQuery($sql);
        $data['delivery_challan_info']=$this->m_common->get_row_array('tbl_delivery_challans',array('dc_id'=>$id),'*');
       // $sql="select d.*,item.s_item_name from tbl_delivery_challan_details d left join tbl_sales_items item on d.s_item_id=item.s_item_id where d.is_active=1";
        $sql="select d.*,sp.product_name from tbl_delivery_challan_details d left join tbl_sales_products sp on d.s_item_id=sp.product_id where d.is_active=1 and dc_id=".$id;
        $data['delivery_challan_details_info']=$this->m_common->customeQuery($sql);
        $this->load->view('delivery_challans/v_edit_delivery_challan',$data);
    }
    
    function edit_delivery_challan_action($dc_id) {
         $postData=$this->input->post();
         if(!empty($postData)){
             $pre_info=$this->m_common->get_row_array('tbl_delivery_challans',array('do_id'=>$do_id),'*');
             $insertData=array();
             if(!empty($postData['do_id'])){
                 $insertData['do_id']=$postData['do_id'];
                 $do_id=$postData['do_id'];
             }
             
             if(!empty($postData['delivery_challan_date'])){
                 $insertData['delivery_challan_date']=date('Y-m-d',strtotime($postData['delivery_challan_date']));
             }
             if(!empty($postData['attention'])){
                 $insertData['attention']=$postData['attention'];
             }
             if(!empty($postData['phone'])){
                 $insertData['phone']=$postData['phone'];
             }
             if(!empty($postData['project_name'])){
                 $insertData['project_name']=$postData['project_name'];
             }
             if(!empty($postData['billing_address'])){
                 $insertData['billing_address']=$postData['billing_address'];
             }
             if(!empty($postData['billing_email'])){
                 $insertData['billing_email']=$postData['billing_email'];
             }
             if(!empty($postData['shipping_address'])){
                 $insertData['shipping_address']=$postData['shipping_address'];
             }
             if(!empty($postData['shipping_email'])){
                 $insertData['shipping_email']=$postData['shipping_email'];
             }
             
             if(!empty($postData['total_amount'])){
                 $insertData['total_amount']=$postData['total_amount'];
             }
             
             $result=$this->m_common->update_row('tbl_delivery_challans',array('dc_id'=>$dc_id),$insertData);
             if($result>=0){
                 if($pre_info[0]['do_id']!=$do_id){
                     $this->m_common->update_row('tbl_delivery_orders', array('do_id' =>$do_id),array('status'=>"Delivered"));
                     $this->m_common->update_row('tbl_delivery_orders', array('do_id' =>$pre_info[0]['do_id']),array('status'=>"Pending"));
                 }
                 $this->m_common->delete_row('tbl_delivery_challan_details',array('dc_id'=>$dc_id));
                 foreach ($postData['s_item_id'] as $key => $each) {
                      $insertData1=array();
                      $insertData1['dc_id'] = $dc_id;
                      $insertData1['s_item_id'] = $each;
                      $insertData1['is_active']=1;
                      if(empty($each)){
                          continue;
                      }
                      if(!empty($postData['quantity'][$key])) {
                           $insertData1['quantity'] = $postData['quantity'][$key];
                       }
                       if(!empty($postData['unit_price'][$key])) { 
                          $insertData1['unit_price'] = $postData['unit_price'][$key];
                       }
                       if(!empty($postData['amount'][$key])) { 
                          $insertData1['amount'] = $postData['amount'][$key];
                       }
                 
                      $this->m_common->insert_row('tbl_delivery_challan_details',$insertData1);
                  }
                  redirect_with_msg('delivery_challans', 'Successfully Updated');
             }
         }else{
              redirect_with_msg('delivery_challans/add_delivery_challan', 'Please fill the form and submit');
         }
         
     }
     
     function delete_delivery_challan($id) {
        if(!empty($id)) {
            $do_id=$this->m_common->get_row_array('tbl_delivery_challans',array('dc_id' => $id),'*');
            $id =$this->m_common->update_row('tbl_delivery_challans', array('dc_id' => $id),array('is_active'=>0));
            if(!empty($id)) {
                $this->m_common->update_row('tbl_delivery_orders', array('do_id' => $do_id[0]['do_id']),array('status'=>"Pending"));
                $this->m_common->update_row('tbl_delivery_challan_details', array('dc_id' => $id),array('is_active'=>0));
                redirect_with_msg('delivery_challans/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('delivery_challans/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('delivery_challans/index', 'Please click on delete button');
        }
    }
     
     function get_delivery_order_item(){
        $this->setOutputMode(NORMAL);
        $do_id=$this->input->post('do_id');
       // $data['delivery_info']=$this->m_common->get_row_array('tbl_delivery_orders',array('do_id'=>$do_id),'*');
        $do_sql='select do.*,c.c_short_name,c.id from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where do.do_id='.$do_id;
        $data['delivery_info']=$this->m_common->customeQuery($do_sql);
        //$sql="select d.*,i.s_item_name from tbl_delivery_order_details d left join tbl_sales_items i on d.s_item_id=i.s_item_id where d.is_active=1 and d.do_id=".$do_id;
        $sql="select d.*,i.product_name from tbl_delivery_order_details d left join tbl_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and d.do_id=".$do_id;
        $data['item_list']=$this->m_common->customeQuery($sql);
        $data['order_code']=$this->m_common->get_row_array('tbl_delivery_challan_code',array('customer_id'=>$data['delivery_info'][0]['id']),'*','',1,'id','DESC');
        echo json_encode($data);
     }
    
   
   
     
   

}






