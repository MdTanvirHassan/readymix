<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sale_invoices extends Site_Controller {

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
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_invoice';
        $this->titlebackend("Sale Invoices");
       // $data['sale_invoice']=$this->m_common->get_row_array('tbl_sales_sale_invoice
       // $sql="select v.*,do.delivery_no,c.c_name,c.c_short_name from tbl_sales_invoices v left join tbl_delivery_orders do on v.do_id=do.do_id left join tbl_sales_orders o on do.o_id=o.o_id left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where v.is_active=1";
        $sql="select v.*,do.delivery_no,c.c_name,c.c_short_name from tbl_sales_invoices v left join tbl_delivery_orders do on v.do_id=do.do_id left join tbl_sales_orders o on do.o_id=o.o_id left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where v.is_active=1 and v.unit_id=".$branch_id;
        $data['invoices']=$this->m_common->customeQuery($sql);
        $this->load->view('sale_invoices/v_sale_invoice',$data);
    }

   
     function add_sale_invoice() {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_invoice';
        
        $this->titlebackend("Quotation Information");
       // $data['items']=$this->m_common->get_row_array('tbl_sales_items','','*');
       // $sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Delivered' or do.status='Partially Delivered') ";
        $sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Delivered' or do.status='Partially Delivered') and do.unit_id=".$branch_id;
        $data['orders']=$this->m_common->customeQuery($sql);
        $this->load->view('sale_invoices/v_add_sale_invoice',$data);
    }
     function add_sale_invoice_action() {
         $branch_id= $this->session->userdata('companyId');
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
            if(empty($postData['select_product'])){
                 redirect_with_msg('sale_invoices/add_sale_invoice', 'Please Select Product');
            }
             if(!empty($postData['do_id'])){
                 $insertData['do_id']=$postData['do_id'];
                 $o_id=$postData['do_id'];
             }
             if(!empty($postData['inv_no'])){
                 $insertData['inv_no']=$postData['inv_no'];
             }
             if(!empty($postData['sale_invoice_date'])){
                 $insertData['sale_invoice_date']=date('Y-m-d',strtotime($postData['sale_invoice_date']));
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
             if(!empty($postData['payment_condition'])){
                 $insertData['payment_condition']=$postData['payment_condition'];
             }
             if(!empty($postData['payment_method'])){
                 $insertData['payment_method']=$postData['payment_method'];
             }
             if(!empty($postData['payment_advance'])){
                 $insertData['payment_advance']=$postData['payment_advance'];
             }
             if(!empty($postData['payment_due'])){
                 $insertData['payment_due']=$postData['payment_due'];
             }
             if(!empty($postData['total_amount'])){
                 $insertData['total_amount']=$postData['total_amount'];
             }
             
            if(!empty($postData['advance_received_amount'])){
                 $insertData['advance_received_amount']=$postData['advance_received_amount'];
            }
            
            if(!empty($postData['advance_adjusted_amount'])){
                 $insertData['advance_adjusted_amount']=$postData['advance_adjusted_amount'];
            }
            
            
             
             $insertData['unit_id']=$branch_id;
             $insertData['is_active']=1;
             $insertData['status']='Pending';
             $insertData['created_date']=date('Y-m-d');
             $result=$this->m_common->insert_row('tbl_sales_invoices',$insertData);
             if(!empty($result)){
                 $this->m_common->insert_row('tbl_invoice_code',array('inv_code'=>$postData['inv_code'],'customer_id'=>$postData['customer_id'],'unit_id'=>$branch_id));
                 
                  foreach ($postData['s_item_id'] as $key => $each) {
                      if(in_array($key,$postData['select_product'])){
                            $insertData1=array();
                            $insertData1['inv_id'] = $result;
                            $insertData1['s_item_id'] = $each;
                            $insertData1['is_active']=1;
                            $insertData1['received_status']='Pending';
                            if(empty($each)){
                                continue;
                            }
                            if(!empty($postData['dc_id'][$key])) {
                                 $insertData1['dc_id'] = $postData['dc_id'][$key];
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

                            $r=$this->m_common->insert_row('tbl_sales_invoice_details',$insertData1);
                            if(!empty($r)){
                                $this->m_common->update_row('tbl_delivery_challan_details',array('dc_details_id'=>$postData['dc_details_id'][$key]),array('bill_status'=>"Generated"));
                            }
                      }
                  }
                  redirect_with_msg('sale_invoices', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('sale_invoices/add_sale_invoice', 'Please fill the form and submit');
         }
         
     }
    
      function edit_sale_invoice($id) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_invoice';
        
        $this->titlebackend("Invoice Information");
      //  $sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Delivered' or do.status='Partially Delivered') ";
        $sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Delivered' or do.status='Partially Delivered') and do.unit_id=".$branch_id;
        $data['orders']=$this->m_common->customeQuery($sql);
        $data['sale_invoice_info']=$this->m_common->get_row_array('tbl_sales_invoices',array('inv_id'=>$id),'*');
      //  $data['sale_invoice_details_info']=$this->m_common->get_row_array('tbl_sales_sale_invoice_details',array('q_id'=>$id),'*');
        $sql="select d.*,p.product_name,dc.dc_no,dc.delivery_challan_date from tbl_sales_invoice_details d left join tbl_sales_products p on d.s_item_id=p.product_id left join tbl_delivery_challans dc on d.dc_id=dc.dc_id where d.is_active=1 and inv_id=".$id;
        $data['sale_invoice_details_info']=$this->m_common->customeQuery($sql);
        $this->load->view('sale_invoices/v_edit_sale_invoice',$data);
    }
    
    function edit_sale_invoice_action($inv_id) {
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
              if(!empty($postData['do_id'])){
                 $insertData['do_id']=$postData['do_id'];
                 $o_id=$postData['do_id'];
             }
             
             if(!empty($postData['sale_invoice_date'])){
                 $insertData['sale_invoice_date']=date('Y-m-d',strtotime($postData['sale_invoice_date']));
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
             if(!empty($postData['payment_condition'])){
                 $insertData['payment_condition']=$postData['payment_condition'];
             }
             if(!empty($postData['payment_method'])){
                 $insertData['payment_method']=$postData['payment_method'];
             }
             if(!empty($postData['payment_advance'])){
                 $insertData['payment_advance']=$postData['payment_advance'];
             }
             if(!empty($postData['payment_due'])){
                 $insertData['payment_due']=$postData['payment_due'];
             }
             if(!empty($postData['total_amount'])){
                 $insertData['total_amount']=$postData['total_amount'];
             }
             
            if(!empty($postData['advance_received_amount'])){
                 $insertData['advance_received_amount']=$postData['advance_received_amount'];
            }
            
            if(!empty($postData['advance_adjusted_amount'])){
                 $insertData['advance_adjusted_amount']=$postData['advance_adjusted_amount'];
            }
             
             $result=$this->m_common->update_row('tbl_sales_invoices',array('inv_id'=>$inv_id),$insertData);
             if($result>=0){
                 $this->m_common->delete_row('tbl_sales_invoice_details',array('inv_id'=>$inv_id));
                 foreach ($postData['s_item_id'] as $key => $each) {
                   
                            $insertData1=array();
                            $insertData1['inv_id'] = $inv_id;
                            $insertData1['s_item_id'] = $each;
                            $insertData1['is_active']=1;
                            $insertData1['received_status']='Pending';
                            if(empty($each)){
                                continue;
                            }
                            if(!empty($postData['dc_id'][$key])) {
                                 $insertData1['dc_id'] = $postData['dc_id'][$key];
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

                            $result=$this->m_common->insert_row('tbl_sales_invoice_details',$insertData1);
                            if(!empty($result)){
                                  $this->m_common->update_row('tbl_delivery_challan_details',array('dc_details_id'=>$postData['dc_details_id'][$key]),array('bill_status'=>"Generated"));
                             }
                            
                  }
                  redirect_with_msg('sale_invoices', 'Successfully Updated');
             }
         }else{
              redirect_with_msg('sale_invoices/add_sale_invoice', 'Please fill the form and submit');
         }
         
     }
     
     
     function details_sale_invoice($id,$print=false) {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_invoice';
        $this->titlebackend("Invoice Information");
       // $sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Delivered' or do.status='Partially Delivered') ";
        $sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Delivered' or do.status='Partially Delivered') and do.unit_id=".$branch_id;
        $data['orders']=$this->m_common->customeQuery($sql);
        $inv_sql="select si.*,so.order_no,so.sale_order_date,c.c_name from tbl_sales_invoices si left join tbl_delivery_orders do on si.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where si.inv_id=".$id;
        //$data['sale_invoice_info']=$this->m_common->get_row_array('tbl_sales_invoices',array('inv_id'=>$id),'*');
        $data['sale_invoice_info']=$this->m_common->customeQuery($inv_sql);
      //  $data['sale_invoice_details_info']=$this->m_common->get_row_array('tbl_sales_sale_invoice_details',array('q_id'=>$id),'*');
        $sql="select d.*,p.product_name,p.measurement_unit,dc.dc_no,dc.delivery_challan_date from tbl_sales_invoice_details d left join tbl_sales_products p on d.s_item_id=p.product_id left join tbl_delivery_challans dc on d.dc_id=dc.dc_id where d.is_active=1 and inv_id=".$id;
        $data['sale_invoice_details_info']=$this->m_common->customeQuery($sql);
        if($print==false){
             $this->load->view('sale_invoices/v_details_sale_invoice',$data);
        }else{
            $html=$this->load->view('sale_invoices/print_sale_invoice',$data,true);
            echo $html;
            exit; 
        }
       
    }
     
     function delete_sale_invoice($id) {
        if(!empty($id)) {
            $do_id=$this->m_common->get_row_array('tbl_sales_invoices',array('inv_id' => $id),'*');
            $res = $this->m_common->update_row('tbl_sales_invoices', array('inv_id' => $id),array('is_active'=>0));
            if (!empty($res)) {
                $this->m_common->update_row('tbl_sales_invoice_details', array('inv_id' => $id),array('is_active'=>0));
                redirect_with_msg('sale_invoices/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('sale_invoices/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('sale_invoices/index', 'Please click on delete button');
        }
    }
     
     function get_order_item(){
        $branch_id= $this->session->userdata('companyId');   
        $this->setOutputMode(NORMAL);
        $do_id=$this->input->post('do_id');
        $d_sql="select do.*,c.id,c.c_short_name,so.advance_received from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where do.do_id=".$do_id;
        $data['order_info']=$this->m_common->customeQuery($d_sql);
        //$data['invoice_code']=$this->m_common->get_row_array('tbl_invoice_code',array('customer_id'=>$data['order_info'][0]['id']),'*','',1,'id','DESC');
        $data['invoice_code']=$this->m_common->get_row_array('tbl_invoice_code',array('customer_id'=>$data['order_info'][0]['id'],'unit_id'=>$branch_id),'*','',1,'id','DESC');
        //$sql="select d.*,i.s_item_name from tbl_sales_order_details d left join tbl_sales_items i on d.s_item_id=i.s_item_id where d.is_active=1 and d.o_id=".$o_id;
      //  $sql="select dcd.*,p.product_name,p.measurement_unit,dc.dc_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join  tbl_sales_products p on dcd.s_item_id=p.product_id where dcd.is_active=1 and dc.do_id=".$do_id;
        $sql="select dcd.*,p.product_name,p.measurement_unit,dc.dc_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join  tbl_sales_products p on dcd.s_item_id=p.product_id where dcd.bill_status='Pending' and dcd.is_active=1 and dc.do_id=".$do_id;
        $data['item_list']=$this->m_common->customeQuery($sql);
        echo json_encode($data);
     }
    
   
   
     
   

}





