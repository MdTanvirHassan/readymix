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
        $this->company_id = $this->session->userdata('companyId');
        if(empty($this->company_id)){
             redirect_with_msg('backend/dashboard', 'Please click on enter here button to see this page');
        }
    }

    function index() {
        $branch_id= $this->session->userdata('companyId');
//        $this->menu = 'sales';
//        $this->sub_menu = 'sale';
//        $this->sub_inner_menu = 'delivery_challan';
        
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'delivery_challan';
        
        $this->titlebackend("Delivery Challan");
       // $data['sale_challan']=$this->m_common->get_row_array('tbl_sales_sale_challan
       // $sql="select dc.*,do.delivery_no,c.c_name,c.c_short_name from tbl_delivery_challans dc left join tbl_delivery_orders do on dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where dc.is_active=1 order by dc_id DESC";
        $sql="select dc.*,do.delivery_no,c.c_name,c.c_short_name from tbl_delivery_challans dc left join tbl_delivery_orders do on dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on so.customer_id=c.id where dc.is_active=1 and dc.unit_id=".$branch_id." order by dc_id DESC";
        $data['delivery_challans']=$this->m_common->customeQuery($sql);
        $this->load->view('delivery_challans/v_delivery_challan',$data);
    }

   
     function add_delivery_challan() {
        $branch_id= $this->session->userdata('companyId'); 
//        $this->menu = 'sales';
//        $this->sub_menu = 'sale';
//        $this->sub_inner_menu = 'delivery_challan';
        
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'delivery_challan';
        
        
        $this->titlebackend("Quotation Information");
       $sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and do.status!='Delivered' and do.unit_id=".$branch_id;
       //$sql="select do.*,c.id as c_id,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and do.status!='Delivered' and do.unit_id=".$branch_id." group by c.id";
        $data['delivery_orders']=$this->m_common->customeQuery($sql);
        //$data['customers']=$this->m_common->customeQuery($sql);
        $data['drivers']=$this->m_common->get_row_array('tbl_driver',array('is_active'=>1),'*');
        $data['helpers']=$this->m_common->get_row_array('tbl_helper',array('is_active'=>1),'*');
        $data['trucks']=$this->m_common->get_row_array('tbl_truck',array('is_active'=>1),'*');
        $this->load->view('delivery_challans/v_add_delivery_challan_do',$data);
    }
     function add_delivery_challan_customer() {
        $branch_id= $this->session->userdata('companyId'); 
//        $this->menu = 'sales';
//        $this->sub_menu = 'sale';
//        $this->sub_inner_menu = 'delivery_challan';
        
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'delivery_challan';
        
        
        $this->titlebackend("Quotation Information");
       //$sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and do.status!='Delivered' and do.unit_id=".$branch_id;
       $sql="select do.*,c.id as c_id,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and do.status!='Delivered' and do.unit_id=".$branch_id." group by c.id";
       // $data['delivery_orders']=$this->m_common->customeQuery($sql);
        $data['customers']=$this->m_common->customeQuery($sql);
        $data['drivers']=$this->m_common->get_row_array('tbl_driver',array('is_active'=>1),'*');
        $data['helpers']=$this->m_common->get_row_array('tbl_helper',array('is_active'=>1),'*');
        $data['trucks']=$this->m_common->get_row_array('tbl_truck',array('is_active'=>1),'*');
        $this->load->view('delivery_challans/v_add_delivery_challan',$data);
    }
     function add_delivery_challan_action() {
         $branch_id= $this->session->userdata('companyId');
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             $customer_id=$postData['customer_id'];
            if(empty($postData['select_product'])){
                 redirect_with_msg('delivery_challans/add_delivery_challan', 'Please Select Product');
            }
             
             if(!empty($postData['do_id'])){
                 $insertData['do_id']=$postData['do_id'];
                 $do_id=$postData['do_id'];
             }
             
             if(!empty($postData['challan_time'])){
                 $insertData['challan_time']=$postData['challan_time'];
             }
             if(!empty($postData['distance'])){
                 $insertData['distance']=$postData['distance'];
             }
             
//             $pre_challan=$this->m_common->get_row_array('tbl_delivery_challans',array('do_id'=>$do_id,'status'=>"Pending"),'*');
//             if(!empty($pre_challan)){
//                redirect_with_msg('delivery_challans/add_delivery_challan', 'Already The challan for this order in pending');  
//             }
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
             
             if(!empty($postData['contact_person'])){
                 $insertData['contact_person']=$postData['contact_person'];
             }
             if(!empty($postData['contact_no'])){
                 $insertData['contact_no']=$postData['contact_no'];
             }
             
             if(!empty($postData['project_name'])){
                 $insertData['project_name']=$postData['project_name'];
             }
             if(!empty($postData['project_id'])){
                 $insertData['project_id']=$postData['project_id'];
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
             
             if(!empty($postData['driver_id'])){
                 $insertData['driver_id']=$postData['driver_id'];
             }
             if(!empty($postData['helper_id'])){
                 $insertData['helper_id']=$postData['helper_id'];
             }
             
             if(!empty($postData['truck_id'])){
                 $insertData['truck_id']=$postData['truck_id'];
             }
             
             $insertData['unit_id']=$branch_id;
             $insertData['is_active']=1;
             $insertData['status']='Pending';
             $insertData['created_date']=date('Y-m-d');
             $result=$this->m_common->insert_row('tbl_delivery_challans',$insertData);
             if(!empty($result)){
                 $this->m_common->insert_row('tbl_delivery_challan_code',array('challan_code'=>$postData['challan_code'],'customer_id'=>$postData['customer_id'],'unit_id'=>$branch_id));
                // $this->m_common->update_row('tbl_delivery_orders', array('do_id' =>$do_id),array('status'=>"Delivered"));
                  foreach ($postData['s_item_id'] as $key => $each) {
                      if(in_array($each,$postData['select_product'])){
                            $insertData1=array();
                            $insertData1['dc_id'] = $result;
                            $insertData1['s_item_id'] = $each;
                            $insertData1['is_active']=1;
                            $insertData1['bill_status']='Pending';
                            $insertData1['receive_status']='Pending';
                            if(empty($each)){
                                continue;
                            }
                            if(!empty($postData['quantity'][$key])) {
                                 $insertData1['quantity'] = $postData['quantity'][$key];
                             }
                             
                            if(!empty($postData['mu_name'][$key])) { 
                                $insertData1['mu_name'] = strtoupper($postData['mu_name'][$key]);
                            } 
                             
                             if(!empty($postData['unit_price'][$key])) { 
                                $insertData1['unit_price'] = $postData['unit_price'][$key];
                             }
                             if(!empty($postData['amount'][$key])) { 
                                $insertData1['amount'] = $postData['amount'][$key];
                             }

                            $this->m_common->insert_row('tbl_delivery_challan_details',$insertData1);
                      }
                  }
                  redirect_with_msg('delivery_challans', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('delivery_challans/add_delivery_challan', 'Please fill the form and submit');
         }
         
     }
    
      function edit_delivery_challan($id) {
        $branch_id= $this->session->userdata('companyId');  
//        $this->menu = 'sales';
//        $this->sub_menu = 'sale';
//        $this->sub_inner_menu = 'delivery_challan';
        
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'delivery_challan';
        
        
        $this->titlebackend("Delivery Challan Information");
       // $sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Pending' or do.status='Partially Delivered' or do.status='Delivered') ";
        $sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Pending' or do.status='Partially Delivered' or do.status='Delivered') and do.unit_id=".$branch_id;
        $data['delivery_orders']=$this->m_common->customeQuery($sql);
        $data['delivery_challan_info']=$this->m_common->get_row_array('tbl_delivery_challans',array('dc_id'=>$id),'*');
       // $sql="select d.*,item.s_item_name from tbl_delivery_challan_details d left join tbl_sales_items item on d.s_item_id=item.s_item_id where d.is_active=1";
        $sql="select d.*,dc.do_id,sod.remark,sp.product_name,sp.measurement_unit from tbl_delivery_challan_details d 
left join tbl_delivery_challans as dc on dc.dc_id=d.dc_id
left JOIN tbl_delivery_orders doo on doo.do_id=dc.do_id
LEFT JOIN tbl_sales_orders so on so.o_id=doo.o_id
LEFT JOIN tbl_sales_order_details sod on so.o_id=sod.o_id
left join tbl_sales_products sp on d.s_item_id=sp.product_id where d.is_active=1 and d.dc_id=".$id." GROUP BY d.s_item_id";
        $data['delivery_challan_details_info']=$this->m_common->customeQuery($sql);
        
        $sql="select d.*,i.product_name,i.measurement_unit from tbl_delivery_order_details d left join tbl_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and d.do_id=".$data['delivery_challan_info'][0]['do_id'];
        $data['order_products']=$this->m_common->customeQuery($sql);
        
         foreach($data['order_products'] as $key=>$value){
            $p_statement=array();
            $p_sql="select sum(production_qty) as total_production_qty from tbl_production_statement_details tpsd where tpsd.product_id=".$value['s_item_id']." and tpsd.do_id=".$data['delivery_challan_info'][0]['do_id'];
            $p_statement=$this->m_common->customeQuery($p_sql);
            if(!empty($p_statement)){
                $data['order_products'][$key]['production_qty']=$p_statement[0]['total_production_qty'];
            }else{
                $data['order_products'][$key]['production_qty']='';
            }
       }
        $data['drivers']=$this->m_common->get_row_array('tbl_driver',array('is_active'=>1),'*');
        $data['helpers']=$this->m_common->get_row_array('tbl_helper',array('is_active'=>1),'*');
        $data['trucks']=$this->m_common->get_row_array('tbl_truck',array('is_active'=>1),'*');
        
        $this->load->view('delivery_challans/v_edit_delivery_challan',$data);
    }
    
    function edit_delivery_challan_action($dc_id) {
         $postData=$this->input->post();
         if(!empty($postData)){
             $pre_info=$this->m_common->get_row_array('tbl_delivery_challans',array('do_id'=>$do_id),'*');
             $insertData=array();
             
             if(empty($postData['select_product'])){
                 redirect_with_msg('delivery_challans/edit_delivery_challan_action/'.$dc_id, 'Please Select Product');
             }
            
             if(!empty($postData['do_id'])){
                 $insertData['do_id']=$postData['do_id'];
                 $do_id=$postData['do_id'];
             }
             
             if(!empty($postData['delivery_challan_date'])){
                 $insertData['delivery_challan_date']=date('Y-m-d',strtotime($postData['delivery_challan_date']));
             }
             
             if(!empty($postData['challan_time'])){
                 $insertData['challan_time']=$postData['challan_time'];
             }
            // if(!empty($postData['challan_time'])){
                 $insertData['distance']=$postData['distance'];
            // }
             
             if(!empty($postData['attention'])){
                 $insertData['attention']=$postData['attention'];
             }
             if(!empty($postData['phone'])){
                 $insertData['phone']=$postData['phone'];
             }
            
             if(!empty($postData['contact_person'])){
                 $insertData['contact_person']=$postData['contact_person'];
             }
             if(!empty($postData['contact_no'])){
                 $insertData['contact_no']=$postData['contact_no'];
             }
             
             if(!empty($postData['project_name'])){
                 $insertData['project_name']=$postData['project_name'];
             }
             if(!empty($postData['project_id'])){
                 $insertData['project_id']=$postData['project_id'];
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
             
             if(!empty($postData['driver_id'])){
                 $insertData['driver_id']=$postData['driver_id'];
             }
             if(!empty($postData['helper_id'])){
                 $insertData['helper_id']=$postData['helper_id'];
             }
             
             if(!empty($postData['truck_id'])){
                 $insertData['truck_id']=$postData['truck_id'];
             }
             
             $result=$this->m_common->update_row('tbl_delivery_challans',array('dc_id'=>$dc_id),$insertData);
             if($result>=0){
                 if($pre_info[0]['do_id']!=$do_id){
                    // $this->m_common->update_row('tbl_delivery_orders', array('do_id' =>$do_id),array('status'=>"Delivered"));
                    // $this->m_common->update_row('tbl_delivery_orders', array('do_id' =>$pre_info[0]['do_id']),array('status'=>"Pending"));
                 }
                 $exists = $this->m_common->get_row_array('tbl_delivery_challan_details',array('dc_id'=>$dc_id),'*');
                 $this->m_common->delete_row('tbl_delivery_challan_details',array('dc_id'=>$dc_id));
                 foreach ($postData['s_item_id'] as $key => $each) {
                     if(in_array($each,$postData['select_product'])){
                            $insertData1=array();
                            $insertData1['dc_id'] = $dc_id;
                            $insertData1['s_item_id'] = $each;
                            $insertData1['is_active']=1;
                            $insertData1['bill_status']='Pending';
                            $insertData1['receive_status']='Pending';
                            if(empty($each)){
                                continue;
                            }
                            if(!empty($postData['quantity'][$key])) {
                                 $insertData1['quantity'] = $postData['quantity'][$key];
                             }
                             
                            if(!empty($postData['mu_name'][$key])) { 
                                $insertData1['mu_name'] = strtoupper($postData['mu_name'][$key]);
                            } 
                             
                             if(!empty($postData['unit_price'][$key])) { 
                                $insertData1['unit_price'] = $postData['unit_price'][$key];
                             }
                             if(!empty($postData['amount'][$key])) { 
                                $insertData1['amount'] = $postData['amount'][$key];
                             }

                            $this->m_common->insert_row('tbl_delivery_challan_details',$insertData1);
                            
                            $sql = " select d.*,i.product_name,i.measurement_unit 
from tbl_delivery_order_details d left join tbl_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and d.s_item_id=$each and d.do_id=".$do_id;
                            $d = $this->m_common->customeQuery($sql);
                            $qty = $d[0]['delivery_quantity']-$exists[0]['quantity'];
                            $qty = $qty+$postData['quantity'][$key];
                            $this->m_common->update_row('tbl_delivery_order_details',array('do_details_id'=>$d[0]['do_details_id']),array('delivery_quantity'=>$qty));
                     }
                  }
                  redirect_with_msg('delivery_challans', 'Successfully Updated');
             }
         }else{
             
                 redirect_with_msg('delivery_challans/edit_delivery_challan_action/'.$dc_id, 'Please fill the form first');
             
         }
         
     }
    function details_delivery_challan($id,$print=false) {
        $branch_id= $this->session->userdata('companyId');  
//        $this->menu = 'sales';
//        $this->sub_menu = 'sale';
//        $this->sub_inner_menu = 'delivery_challan';
        
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'delivery_challan';
        
        
        
        $this->titlebackend("Delivery Challan Information");
        //$sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Pending' or do.status='Partially Delivered' or do.status='Delivered') ";
        $sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Pending' or do.status='Partially Delivered' or do.status='Delivered') and do.unit_id=".$branch_id;
        $data['delivery_orders']=$this->m_common->customeQuery($sql);
     //   $dc_sql="select dc.*,so.order_no,so.sale_order_date,c.c_name from tbl_delivery_challans dc left join tbl_delivery_orders do on dc.do_id=dc.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where dc.dc_id=".$id;
        $dc_sql="select dc.*,so.order_no,so.sale_order_date,c.c_name,c.c_contact_person,c.c_mobile_no,c.c_contact_address,td.driver_name,td.contact_no as d_contact_no,th.helper_name,th.contact_no as h_contact_no,tt.truck_no,do.delivery_order_date from tbl_delivery_challans dc left join tbl_delivery_orders do on dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_driver td on dc.driver_id=td.driver_id left join tbl_helper th on dc.helper_id=th.helper_id left join tbl_truck tt on dc.truck_id=tt.truck_id where dc.dc_id=".$id;
        $data['delivery_challan_info']=$this->m_common->customeQuery($dc_sql);
//        print_r($data['delivery_challan_info']);
//        exit;
       // $sql="select d.*,item.s_item_name from tbl_delivery_challan_details d left join tbl_sales_items item on d.s_item_id=item.s_item_id where d.is_active=1";
        $sql="select d.*,dc.do_id,sod.remark,sp.product_name,sp.measurement_unit from tbl_delivery_challan_details d 
left join tbl_delivery_challans as dc on dc.dc_id=d.dc_id
left JOIN tbl_delivery_orders doo on doo.do_id=dc.do_id
LEFT JOIN tbl_sales_orders so on so.o_id=doo.o_id
LEFT JOIN tbl_sales_order_details sod on so.o_id=sod.o_id
left join tbl_sales_products sp on d.s_item_id=sp.product_id where d.is_active=1 and d.dc_id=".$id." GROUP BY d.s_item_id";
        $data['delivery_challan_details_info']=$this->m_common->customeQuery($sql);
        
        $sql="select d.*,i.product_name,i.measurement_unit from tbl_delivery_order_details d left join tbl_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and d.do_id=".$data['delivery_challan_info'][0]['do_id'];
        $data['order_products']=$this->m_common->customeQuery($sql);
        
        $data['drivers']=$this->m_common->get_row_array('tbl_driver',array('is_active'=>1),'*');
        $data['helpers']=$this->m_common->get_row_array('tbl_helper',array('is_active'=>1),'*');
        $data['trucks']=$this->m_common->get_row_array('tbl_truck',array('is_active'=>1),'*');
        
        if($print==false){
             $this->load->view('delivery_challans/v_details_delivery_challan',$data);
        }else{
            $html=$this->load->view('delivery_challans/print_delivery_challan',$data,true);
            echo $html;
            exit; 
        }
        
    }
     
    function approve_delivery_challan($id) {
        $this->menu = 'sales';
        $this->sub_menu = 'delivery_challan';
        $this->titlebackend("Delivery Challan Information");
        $delivery_challan_info=$this->m_common->get_row_array('tbl_delivery_challans',array('dc_id'=>$id),'*');
        $delivery_challan_products=$this->m_common->get_row_array('tbl_delivery_challan_details',array('dc_id'=>$id),'*');
        $result=$this->m_common->update_row('tbl_delivery_challans',array('dc_id'=>$id),array('status'=>"Approved"));
        if(!empty($result)){
            foreach($delivery_challan_products as $c_product){
                $delivery_order_products=array();
                $delivery_order_product=$this->m_common->get_row_array('tbl_delivery_order_details',array('do_id'=>$delivery_challan_info[0]['do_id'],'s_item_id'=>$c_product['s_item_id']),'*');
                $delivery_quanity=$delivery_order_product[0]['delivery_quantity']+$c_product['quantity'];
                if($delivery_quanity==$delivery_order_product[0]['quantity']){
                    $status="Delivered";
                }else{
                     $status="Partially Delivered";
                }
                $this->m_common->update_row('tbl_delivery_order_details',array('do_id'=>$delivery_challan_info[0]['do_id'],'s_item_id'=>$c_product['s_item_id']),array('delivery_quantity'=>$delivery_quanity,'delivery_status'=>$status));
            }
        }
        $delivery_order_products=$this->m_common->get_row_array('tbl_delivery_order_details',array('do_id'=>$delivery_challan_info[0]['do_id']),'*');
        $j=0;
        foreach($delivery_order_products as $delivery_product){
             if($delivery_product['delivery_status']!="Delivered"){
                 $j=1;
             }
        }
       
        if($j==1){
            $this->m_common->update_row('tbl_delivery_orders',array('do_id'=>$delivery_challan_info[0]['do_id']),array('status'=>"Partially Delivered"));
        }else{
            $this->m_common->update_row('tbl_delivery_orders',array('do_id'=>$delivery_challan_info[0]['do_id']),array('status'=>"Delivered"));
        }
        redirect_with_msg('delivery_challans/index', 'Successfully Approved');
    }
     
     
     function delete_delivery_challan($id) {
        if(!empty($id)) {
            $do_id=$this->m_common->get_row_array('tbl_delivery_challans',array('dc_id' => $id),'*');
            $id =$this->m_common->update_row('tbl_delivery_challans', array('dc_id' => $id),array('is_active'=>0));
            if(!empty($id)) {
             //   $this->m_common->update_row('tbl_delivery_orders', array('do_id' => $do_id[0]['do_id']),array('status'=>"Pending"));
                $this->m_common->update_row('tbl_delivery_challan_details', array('dc_id' => $id),array('is_active'=>0));
                redirect_with_msg('delivery_challans/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('delivery_challans/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('delivery_challans/index', 'Please click on delete button');
        }
    }
     
     function get_delivery_order_item_(){
        $branch_id= $this->session->userdata('companyId');   
        $this->setOutputMode(NORMAL);
        $do_id=$this->input->post('do_id');
       // $data['delivery_info']=$this->m_common->get_row_array('tbl_delivery_orders',array('do_id'=>$do_id),'*');
        $do_sql='select do.*,c.c_short_name,c.id from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id where  do.do_id='.$do_id;
        $data['delivery_info']=$this->m_common->customeQuery($do_sql);
        
        $sql="select d.*,i.product_name,i.measurement_unit from tbl_delivery_order_details d left join tbl_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and d.do_id=".$do_id;
        $data['order_products']=$this->m_common->customeQuery($sql);
        
        foreach($data['order_products'] as $key=>$value){
            $p_statement=array();
            $p_sql="select sum(production_qty) as total_production_qty from tbl_production_statement_details  where product_id=".$value['s_item_id']." and do_id=".$do_id;
            $p_statement=$this->m_common->customeQuery($p_sql);
            if(!empty($p_statement)){
                $data['order_products'][$key]['production_qty']=$p_statement[0]['total_production_qty'];
            }else{
                $data['order_products'][$key]['production_qty']='';
            }
       }
        
        $sql="select d.*,sod.remark,i.product_name,i.measurement_unit from tbl_delivery_order_details d 
left join tbl_sales_products i on d.s_item_id=i.product_id
left JOIN tbl_delivery_orders doo on doo.do_id=d.do_id
LEFT JOIN tbl_sales_orders so on so.o_id=doo.o_id
LEFT JOIN tbl_sales_order_details sod on so.o_id=sod.o_id 
where (d.delivery_status='Pending' or d.delivery_status='Partially Delivered') and d.is_active=1 and d.do_id=".$do_id."  group by d.do_details_id";
        $data['item_list']=$this->m_common->customeQuery($sql);
        //$data['order_code']=$this->m_common->get_row_array('tbl_delivery_challan_code',array('customer_id'=>$data['delivery_info'][0]['id']),'*','',1,'id','DESC');
        $data['order_code']=$this->m_common->get_row_array('tbl_delivery_challan_code',array('customer_id'=>$data['delivery_info'][0]['id'],'unit_id'=>$branch_id),'*','',1,'id','DESC');
        echo json_encode($data);
     }
     function get_delivery_order_item(){
        $branch_id= $this->session->userdata('companyId');   
        $this->setOutputMode(NORMAL);
        $c_id=$this->input->post('c_id');
       // $data['delivery_info']=$this->m_common->get_row_array('tbl_delivery_orders',array('do_id'=>$do_id),'*');
        $do_sql='select do.*,c.c_short_name,c.id from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id where c.id='.$c_id;
        $data['delivery_info']=$this->m_common->customeQuery($do_sql);
        
        $sql="select d.*,do.delivery_no,i.product_name,i.measurement_unit from tbl_delivery_order_details d join tbl_delivery_orders do on d.do_id=do.do_id join tbl_sales_orders so on so.o_id=do.o_id left join tbl_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and so.customer_id=".$c_id;
        $data['order_products']=$this->m_common->customeQuery($sql);
        
        foreach($data['order_products'] as $key=>$value){
            $p_statement=array();
            $p_sql="select sum(production_qty) as total_production_qty from tbl_production_statement_details  where product_id=".$value['s_item_id']." and do_id=".$value['do_id'];
            $p_statement=$this->m_common->customeQuery($p_sql);
            if(!empty($p_statement)){
                $data['order_products'][$key]['production_qty']=$p_statement[0]['total_production_qty'];
            }else{
                $data['order_products'][$key]['production_qty']='';
            }
       }
        
        $sql="select d.*,doo.delivery_no,sod.remark,i.product_name,i.measurement_unit from tbl_delivery_order_details d 
left join tbl_sales_products i on d.s_item_id=i.product_id
left JOIN tbl_delivery_orders doo on doo.do_id=d.do_id
LEFT JOIN tbl_sales_orders so on so.o_id=doo.o_id
LEFT JOIN tbl_sales_order_details sod on so.o_id=sod.o_id 
where (d.delivery_status='Pending' or d.delivery_status='Partially Delivered') and d.is_active=1 and so.customer_id=".$c_id."  group by d.do_details_id";
        $data['item_list']=$this->m_common->customeQuery($sql);
        //$data['order_code']=$this->m_common->get_row_array('tbl_delivery_challan_code',array('customer_id'=>$data['delivery_info'][0]['id']),'*','',1,'id','DESC');
        $data['order_code']=$this->m_common->get_row_array('tbl_delivery_challan_code',array('customer_id'=>$data['delivery_info'][0]['id'],'unit_id'=>$branch_id),'*','',1,'id','DESC');
        echo json_encode($data);
     }
    
   
   
     
   

}






