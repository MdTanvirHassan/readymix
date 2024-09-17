<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rm_sales extends Site_Controller {

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

    function index($customer_id=false) {
        
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        $this->menu = 'trading';
        $this->sub_menu = 'trading';
        $this->sub_inner_menu = 'delivery_order';
        $this->titlebackend("Delivery Orders");
        $customer_id=$this->input->post('customer_id');
        $cl_status=$this->input->post('closing_status');
        
        if(!empty($cl_status)){
          $closing_status=$cl_status;  
        }else{
          $closing_status='Open';  
        }
        if(!empty($customer_id)){
            if($customer_id=="all"){
                $cust_id='';
            }else{
                $cust_id=$customer_id;
            }
        }
       
        $where='';
        $where .="rdo.closing_status='$closing_status'";
        
        if(!empty($cust_id)){
            $sql="select rdod.*,c.c_name,rdo.do_status,rdo.closing_status,rdo.delivery_no,rdo.delivery_order_date,rdo.do_location,ri.item_name,tmu.meas_unit from rm_delivery_orders_details rdod left join rm_delivery_orders rdo on rdod.do_id=rdo.do_id left join tbl_customers c on rdo.customer_id=c.id left join rm_items ri on rdod.s_item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id where $where and (rdo.status='Pending' or rdo.status='Partially Delivered') and rdod.is_active=1 and rdo.customer_id=".$cust_id." order by rdo.delivery_order_date DESC";            
        }else{
            $sql="select rdod.*,c.c_name,rdo.do_status,rdo.closing_status,rdo.delivery_no,rdo.delivery_order_date,rdo.do_location,ri.item_name,tmu.meas_unit from rm_delivery_orders_details rdod left join rm_delivery_orders rdo on rdod.do_id=rdo.do_id left join tbl_customers c on rdo.customer_id=c.id left join rm_items ri on rdod.s_item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id where $where and (rdo.status='Pending' or rdo.status='Partially Delivered') and rdod.is_active=1 order by rdo.delivery_order_date DESC";
        }
        
        //$sql="select rdod.*,c.c_name,rdo.do_status,rdo.closing_status,rdo.delivery_no,rdo.delivery_order_date,ri.item_name,tmu.meas_unit from rm_delivery_orders_details rdod left join rm_delivery_orders rdo on rdod.do_id=rdo.do_id left join tbl_customers c on rdo.customer_id=c.id left join rm_items ri on rdod.s_item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id where rdod.is_active=1";
        $data['customer_id']=$cust_id;
        $data['closing_status']=$closing_status;
        $data['delivery_orders']=$this->m_common->customeQuery($sql);
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1,'customer_category'=>'Raw Material'),'*','','','c_name'); 
        $this->load->view('raw_materials/rm_sales/v_delivery_order',$data);
       
    }

    function completed_delivery_order($customer_id=false) {
        
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        $this->menu = 'trading';
        $this->sub_menu = 'trading';
        $this->sub_inner_menu = 'delivery_order';
        $this->titlebackend("Delivery Orders");
        $customer_id=$this->input->post('customer_id');
        //$cl_status=$this->input->post('closing_status');
        
        if(!empty($cl_status)){
          $closing_status=$cl_status;  
        }else{
          $closing_status='Open';  
        }
        if(!empty($customer_id)){
            if($customer_id=="all"){
                $cust_id='';
            }else{
                $cust_id=$customer_id;
            }
        }
       
        $where='';
        //$where .="rdo.closing_status='$closing_status'";
        
        if(!empty($cust_id)){
            $sql="select rdod.*,c.c_name,rdo.do_status,rdo.status,rdo.closing_status,rdo.delivery_no,rdo.delivery_order_date,ri.item_name,tmu.meas_unit from rm_delivery_orders_details rdod left join rm_delivery_orders rdo on rdod.do_id=rdo.do_id left join tbl_customers c on rdo.customer_id=c.id left join rm_items ri on rdod.s_item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id where rdo.status='Delivered' and rdod.is_active=1 and rdo.customer_id=".$cust_id." order by rdo.delivery_order_date DESC";            
        }else{
            $sql="select rdod.*,c.c_name,rdo.do_status,rdo.status,rdo.closing_status,rdo.delivery_no,rdo.delivery_order_date,ri.item_name,tmu.meas_unit from rm_delivery_orders_details rdod left join rm_delivery_orders rdo on rdod.do_id=rdo.do_id left join tbl_customers c on rdo.customer_id=c.id left join rm_items ri on rdod.s_item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id where rdo.status='Delivered' and rdod.is_active=1 order by rdo.delivery_order_date DESC";
        }
        //echo $sql; exit;
        //$sql="select rdod.*,c.c_name,rdo.do_status,rdo.closing_status,rdo.delivery_no,rdo.delivery_order_date,ri.item_name,tmu.meas_unit from rm_delivery_orders_details rdod left join rm_delivery_orders rdo on rdod.do_id=rdo.do_id left join tbl_customers c on rdo.customer_id=c.id left join rm_items ri on rdod.s_item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id where rdod.is_active=1";
        $data['customer_id']=$cust_id;
        $data['closing_status']=$closing_status;
        $data['delivery_orders']=$this->m_common->customeQuery($sql);
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1,'customer_category'=>'Raw Material'),'*','','','c_name'); 
        $this->load->view('raw_materials/rm_sales/v_delivery_completed_order',$data);
       
    }
    function print_completed_delivery_order($customer_id=false) {
        
        $this->titlebackend("Delivery Orders");
        $customer_id=$this->input->post('customer_id');
        //$cl_status=$this->input->post('closing_status');
        
        if(!empty($cl_status)){
          $closing_status=$cl_status;  
        }else{
          $closing_status='Open';  
        }
        if(!empty($customer_id)){
            if($customer_id=="all"){
                $cust_id='';
            }else{
                $cust_id=$customer_id;
            }
        }
       
        $where='';
        //$where .="rdo.closing_status='$closing_status'";
        
        if(!empty($cust_id)){
            $sql="select rdod.*,c.c_name,rdo.do_status,rdo.status,rdo.closing_status,rdo.delivery_no,rdo.delivery_order_date,ri.item_name,tmu.meas_unit from rm_delivery_orders_details rdod left join rm_delivery_orders rdo on rdod.do_id=rdo.do_id left join tbl_customers c on rdo.customer_id=c.id left join rm_items ri on rdod.s_item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id where rdo.status='Delivered' and rdod.is_active=1 and rdo.customer_id=".$cust_id." order by rdo.delivery_order_date DESC";            
        }else{
            $sql="select rdod.*,c.c_name,rdo.do_status,rdo.status,rdo.closing_status,rdo.delivery_no,rdo.delivery_order_date,ri.item_name,tmu.meas_unit from rm_delivery_orders_details rdod left join rm_delivery_orders rdo on rdod.do_id=rdo.do_id left join tbl_customers c on rdo.customer_id=c.id left join rm_items ri on rdod.s_item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id where rdo.status='Delivered' and rdod.is_active=1 order by rdo.delivery_order_date DESC";
        }
        //echo $sql; exit;
        //$sql="select rdod.*,c.c_name,rdo.do_status,rdo.closing_status,rdo.delivery_no,rdo.delivery_order_date,ri.item_name,tmu.meas_unit from rm_delivery_orders_details rdod left join rm_delivery_orders rdo on rdod.do_id=rdo.do_id left join tbl_customers c on rdo.customer_id=c.id left join rm_items ri on rdod.s_item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id where rdod.is_active=1";
        $data['customer_id']=$cust_id;
        $data['closing_status']=$closing_status;
        $data['delivery_orders']=$this->m_common->customeQuery($sql);
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1,'customer_category'=>'Raw Material'),'*','','','c_name'); 
        $this->load->view('raw_materials/rm_sales/print_completed_delivery_order',$data);
       
    }
    
    
    
    function add_delivery_order() {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'trading';
        $this->sub_menu = 'trading';
        $this->sub_inner_menu = 'delivery_order';
        $this->titlebackend("Quotation Information");
       // $data['items']=$this->m_common->get_row_array('tbl_sales_items','','*');
       // $sql="select so.*,c.c_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.status='Pending' ";
      //  $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.status='Approved' ";
      //  $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.status='Pending' and so.unit_id=".$branch_id;
      //  $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.delivery_order_status='Pending' and so.unit_id=".$branch_id;
        $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on so.customer_id=c.id where so.is_active=1 and (so.delivery_order_status='Pending' or so.delivery_order_status='Partially Generated Delivery Order') and so.unit_id=".$branch_id;
        $data['sale_orders']=$this->m_common->customeQuery($sql);
        
       // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');//16-09-2020
        $sql = "select sl.*,c.SUP_NAME as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from import_lc sl  left join supplier as c on c.ID=sl.sup_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank order by lc_id DESC";
        $data['lcs'] = $this->m_common->customeQuery($sql);
        
        $c_sql="select c.* from tbl_customers c where c.customer_category='Raw Material' ";
        $data['customers']=$this->m_common->customeQuery($c_sql);
        $this->load->view('raw_materials/rm_sales/v_add_delivery_order',$data);
        
        
    }
    
    
    
    
    
    
    
    function add_delivery_order_action() {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        
        $postData=$this->input->post();
        if(!empty($postData)){
            try{ 
                $this->db->trans_start();
                $insertData=array();

                if(!empty($postData['customer_id'])){
                    $insertData['customer_id']=$postData['customer_id'];

                }

                if(!empty($postData['lc_id'])){
                    $insertData['lc_id']=$postData['lc_id'];

                }


                $customer_info=$this->m_common->get_row_array('tbl_customers',array('id'=>$postData['customer_id']),'*');
                $d_serial=$this->m_common->get_row_array('rm_delivery_orders',array('customer_id'=>$postData['customer_id']),'*');
                $c_total_do=count($d_serial);
                if($c_total_do<=9){
                    if($c_total_do==0){
                        $do_no="DO/".$customer_info[0]['c_short_name'].'/'.date('Y').'/01';
                    }else{
                        $do_no="DO/".$customer_info[0]['c_short_name'].'/'.date('Y').'/0'.($c_total_do+1);
                    }
                }else{
                    $do_no="DO/".$customer_info[0]['c_short_name'].'/'.date('Y').'/'.($c_total_do+1);
                }

                $insertData['delivery_no']=$do_no; 

                $pre_delivery_info=$this->m_common->get_row_array('rm_delivery_orders',array('delivery_no'=>$do_no),'*');
                if(!empty($pre_delivery_info)){
                   redirect_with_msg('raw_materials/rm_sales', 'This Delivery order already exists'); 
                }



                if(!empty($postData['delivery_order_date'])){
                    $insertData['delivery_order_date']=date('Y-m-d',strtotime($postData['delivery_order_date']));
                }

                if(!empty($postData['delivery_time'])){
                    $insertData['delivery_time']=$postData['delivery_time'];
                }

                if(!empty($postData['attention'])){
                    $insertData['attention']=$postData['attention'];
                }

                if(!empty($postData['phone'])){
                    $insertData['phone_no']=$postData['phone'];
                }

                if(!empty($postData['contact_person'])){
                    $insertData['contact_person']=$postData['contact_person'];
                }
                if(!empty($postData['contact_no'])){
                    $insertData['contact_no']=$postData['contact_no'];
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

                if(!empty($postData['special_note'])){
                    $insertData['special_note']=$postData['special_note'];
                }

                if(!empty($postData['do_remark'])){
                    $insertData['remark']=$postData['do_remark'];
                }

                if(!empty($postData['do_location'])){
                    $insertData['do_location']=$postData['do_location'];
                }
                
                $insertData['sales_person_id']=$customer_info[0]['sales_person_id'];
                
                $insertData['branch_id']=$branch_id;
                $insertData['is_active']=1;
                $insertData['closing_status']='Open';
                $insertData['status']='Pending';
                $insertData['do_status']='Pending';
                $insertData['created_by'] = $user_id;
                $insertData['created_date'] = date('Y-m-d');

                $result=$this->m_common->insert_row('rm_delivery_orders',$insertData);

                if(!empty($result)){

                    $r=$this->m_common->insert_row('rm_delivery_orders_code',array('customer_id'=>$postData['customer_id'],'branch_id'=>$branch_id));

                     foreach ($postData['s_item_id'] as $key => $each) {
                         $insertData1=array();
                         $insertData1['do_id'] = $result;
                         $insertData1['s_item_id'] = $each;
                         $insertData1['is_active']=1;
                         $insertData1['delivery_status']="Pending";

                         if(empty($each)){
                             continue;
                         }

                         if(!empty($postData['lc_details_id'][$key])) {
                              $insertData1['lc_details_id'] = $postData['lc_details_id'][$key];
                         }


                        if(!empty($postData['stock_qty'][$key])) {
                              $insertData1['stock_qty'] = $postData['stock_qty'][$key];
                        }


                        if(!empty($postData['quantity'][$key])) {
                            $insertData1['quantity'] = $postData['quantity'][$key];
                        }else{
                            continue;
                        }

                        if(!empty($postData['base_price'][$key])) { 
                           $insertData1['base_price'] = $postData['base_price'][$key];
                        }
                        
                        if(!empty($postData['commission'][$key])) { 
                           $insertData1['commission'] = $postData['commission'][$key];
                        }
                        
                        if(!empty($postData['transport_cost'][$key])) { 
                           $insertData1['transport_cost'] = $postData['transport_cost'][$key];
                        }

                        if(!empty($postData['unit_price'][$key])) { 
                           $insertData1['unit_price'] = $postData['unit_price'][$key];
                        }

                        if(!empty($postData['amount'][$key])) { 
                           $insertData1['amount'] = $postData['amount'][$key];
                        }

                         $success=$this->m_common->insert_row('rm_delivery_orders_details',$insertData1);

                     }


                    foreach ($postData['name'] as $key => $each) {
                        $insertData2=array();
                        $insertData2['do_id'] = $result;
                        if(empty($each)){
                            continue;
                        }
                        if(!empty($postData['name'][$key])) {
                             $insertData2['name'] = $postData['name'][$key];
                        }
                        
                        if(!empty($postData['description'][$key])) { 
                            $insertData2['description'] = $postData['description'][$key];
                        }    
                        $this->m_common->insert_row('rm_delivery_orders_terms_conditions',$insertData2);
                    }

               }

               $this->db->trans_complete();                
               if($this->db->trans_status() === FALSE){
                   $this->db->trans_rollback();
               }else{
                   $this->db->trans_commit();
               }   

                       redirect_with_msg('raw_materials/rm_sales','Successfully Inserted');
            }catch(UserException $error){
                $this->db->trans_rollback();                
                redirect_with_msg('raw_materials/rm_sales','Something went wrong');
            }        
             
         }else{
              redirect_with_msg('rm_sales/add_delivery_order','Please fill the form and submit');
         }
         
     }
    
   
    function edit_delivery_order($id) {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        
        $this->menu = 'trading';
        $this->sub_menu = 'rm_delivery_order';
        $this->sub_inner_menu = 'delivery_order';
        $this->titlebackend("Delivery Order Information");
        
        $sql = "select sl.*,c.SUP_NAME as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from import_lc sl  left join supplier as c on c.ID=sl.sup_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank order by lc_id DESC";
        $data['lcs'] = $this->m_common->customeQuery($sql);
        
        $c_sql="select c.* from tbl_customers c where c.customer_category='Raw Material' ";
        $data['customers']=$this->m_common->customeQuery($c_sql);
        
        $data['delivery_order_info']=$this->m_common->get_row_array('rm_delivery_orders',array('do_id'=>$id),'*');
       
        $sql="select d.*,sp.item_name,sp.item_grade,sp.origin,tmu.meas_unit from rm_delivery_orders_details d left join rm_items sp on d.s_item_id=sp.id left join tbl_measurement_unit tmu on sp.mu_id=tmu.id where d.is_active=1 and do_id=".$data['delivery_order_info'][0]['do_id'];
        $data['delivery_order_details_info']=$this->m_common->customeQuery($sql);
             
        $data['purchase_conditions']=$this->m_common->get_row_array('rm_delivery_orders_terms_conditions',array('do_id'=>$id),'*');
        
        $this->load->view('raw_materials/rm_sales/v_edit_delivery_order',$data);
    } 
     
    
    function edit_delivery_order_action($do_id) {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        
        $postData=$this->input->post();
        if(!empty($postData)){
            try{ 
                
                
                $this->db->trans_start();
                $insertData=array();

                if(!empty($postData['customer_id'])){
                    $insertData['customer_id']=$postData['customer_id'];

                }

                if(!empty($postData['lc_id'])){
                    $insertData['lc_id']=$postData['lc_id'];

                }


                if(!empty($postData['delivery_no'])){
                    $insertData['delivery_no']=$postData['delivery_no'];

                }

                

                


                if(!empty($postData['delivery_order_date'])){
                    $insertData['delivery_order_date']=date('Y-m-d',strtotime($postData['delivery_order_date']));
                }

                

                if(!empty($postData['attention'])){
                    $insertData['attention']=$postData['attention'];
                }

                if(!empty($postData['phone'])){
                    $insertData['phone_no']=$postData['phone'];
                }

                if(!empty($postData['contact_person'])){
                    $insertData['contact_person']=$postData['contact_person'];
                }
                if(!empty($postData['contact_no'])){
                    $insertData['contact_no']=$postData['contact_no'];
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

                if(!empty($postData['special_note'])){
                    $insertData['special_note']=$postData['special_note'];
                }

                if(!empty($postData['do_remark'])){
                    $insertData['remark']=$postData['do_remark'];
                }

                if(!empty($postData['do_location'])){
                    $insertData['do_location']=$postData['do_location'];
                }
                
                $insertData['updated_by'] = $user_id;
                $insertData['updated_date'] = date('Y-m-d');

                $result=$this->m_common->update_row('rm_delivery_orders',array('do_id'=>$do_id),$insertData);

                if($result>=0){

                    $this->m_common->delete_row('rm_delivery_orders_details',array('do_id'=>$do_id));

                     foreach ($postData['s_item_id'] as $key => $each) {
                         $insertData1=array();
                         $insertData1['do_id'] = $do_id;
                         $insertData1['s_item_id'] = $each;
                         $insertData1['is_active']=1;
                         $insertData1['delivery_status']="Pending";

                         if(empty($each)){
                             continue;
                         }

                         if(!empty($postData['lc_details_id'][$key])) {
                              $insertData1['lc_details_id'] = $postData['lc_details_id'][$key];
                         }


                        if(!empty($postData['stock_qty'][$key])) {
                              $insertData1['stock_qty'] = $postData['stock_qty'][$key];
                        }


                        if(!empty($postData['quantity'][$key])) {
                            $insertData1['quantity'] = $postData['quantity'][$key];
                        }else{
                            continue;
                        }

                        
                        if(!empty($postData['base_price'][$key])) { 
                           $insertData1['base_price'] = $postData['base_price'][$key];
                        }
                        
                        if(!empty($postData['commission'][$key])) { 
                           $insertData1['commission'] = $postData['commission'][$key];
                        }
                        
                        if(!empty($postData['transport_cost'][$key])) { 
                           $insertData1['transport_cost'] = $postData['transport_cost'][$key];
                        }
                        

                        if(!empty($postData['unit_price'][$key])) { 
                           $insertData1['unit_price'] = $postData['unit_price'][$key];
                        }

                        if(!empty($postData['amount'][$key])) { 
                           $insertData1['amount'] = $postData['amount'][$key];
                        }

                         $success=$this->m_common->insert_row('rm_delivery_orders_details',$insertData1);

                     }
                     
                     $this->m_common->delete_row('rm_delivery_orders_terms_conditions',array('do_id'=>$do_id));
                     
                     foreach ($postData['name'] as $key => $each) {
                        $insertData2=array();
                        $insertData2['do_id'] =$do_id;
                        if(empty($each)){
                            continue;
                        }
                        if(!empty($postData['name'][$key])) {
                             $insertData2['name'] = $postData['name'][$key];
                         }
                        if(!empty($postData['description'][$key])) { 
                            $insertData2['description'] = $postData['description'][$key];
                        }    
                        $this->m_common->insert_row('rm_delivery_orders_terms_conditions',$insertData2);
                    }


               }

               $this->db->trans_complete();                
               if($this->db->trans_status() === FALSE){
                   $this->db->trans_rollback();
               }else{
                   $this->db->trans_commit();
               }   

                       redirect_with_msg('raw_materials/rm_sales','Successfully Inserted');
            }catch(UserException $error){
                $this->db->trans_rollback();                
                redirect_with_msg('raw_materials/rm_sales','Something went wrong');
            }        
             
         }else{
              redirect_with_msg('rm_sales/add_delivery_order','Please fill the form and submit');
         }
         
     }
   
    function details_delivery_order($id,$print=false) {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'delivery_order';
        $this->titlebackend("Delivery Order Information");
        
        $sql = "select sl.*,c.SUP_NAME as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from import_lc sl  left join supplier as c on c.ID=sl.sup_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank where sl.branch_id=$branch_id order by lc_id DESC";
        $data['lcs'] = $this->m_common->customeQuery($sql);
        
        $c_sql="select c.* from tbl_customers c where c.customer_category='Raw Material' ";
        $data['customers']=$this->m_common->customeQuery($c_sql);
        $do_sql="select rdo.*,rlr.mother_vessel_name,ilc.lc_no,tc.c_name from rm_delivery_orders rdo left join rm_lc_receive rlr on rdo.lc_id=rlr.lc_id left join import_lc ilc on rdo.lc_id=ilc.lc_id left join tbl_customers tc on rdo.customer_id=tc.id   where rdo.do_id=".$id;
        $data['delivery_order_info']=$this->m_common->customeQuery($do_sql);
       // $data['delivery_order_info']=$this->m_common->get_row_array('rm_delivery_orders',array('do_id'=>$id),'*');
       
        $sql="select d.*,sp.item_name,sp.item_grade,sp.origin,tmu.meas_unit from rm_delivery_orders_details d left join rm_items sp on d.s_item_id=sp.id left join tbl_measurement_unit tmu on sp.mu_id=tmu.id where d.is_active=1 and do_id=".$data['delivery_order_info'][0]['do_id'];
        $data['delivery_order_details_info']=$this->m_common->customeQuery($sql);
         
        $data['purchase_conditions']=$this->m_common->get_row_array('rm_delivery_orders_terms_conditions',array('do_id'=>$id),'*');
        
        if($print==false){
            $this->load->view('raw_materials/rm_sales/v_details_delivery_order',$data);
        }else{
            $html=$this->load->view('raw_materials/rm_sales/print_completed_delivery_order', $data,true);
               echo $html;exit; 
        }
    }  
     
     
    function delete_delivery_order($id) {
        if(!empty($id)) {
           
            $result=$this->m_common->update_row('rm_delivery_orders', array('do_id' => $id),array('is_active'=>0));
            if(!empty($result)){
                
                $this->m_common->update_row('rm_delivery_orders_details', array('do_id' => $id),array('is_active'=>0));
                redirect_with_msg('raw_materials/rm_sales/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('raw_materials/rm_sales/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/rm_sales/index', 'Please click on delete button');
        }
    }
    
    function approve_delivery_order($id){
         $result=$this->m_common->update_row('rm_delivery_orders',array('do_id'=>$id),array('do_status'=>'Approved'));
         if(!empty($result)){
             redirect_with_msg('raw_materials/rm_sales', 'Successfully Approved');
         }else{
             redirect_with_msg('raw_materials/rm_sales', 'Not Approved');
         }
     }
     
     function close_delivery_order($id,$cust_id=false){
         $user_id=$this->session->userdata('user_id');
         $result=$this->m_common->update_row('rm_delivery_orders',array('do_id'=>$id),array('closing_status'=>'Closed','updated_by'=>$user_id));
         if(!empty($result)){
             if(!empty($cust_id)){
                redirect_with_msg('raw_materials/rm_sales/'.$cust_id, 'Successfully Closed');
             }else{
                redirect_with_msg('raw_materials/rm_sales', 'Successfully Closed'); 
             }
         }else{
             if(!empty($cust_id)){
                redirect_with_msg('raw_materials/rm_sales/'.$cust_id, 'Not Closed');
             }else{
                redirect_with_msg('raw_materials/rm_sales', 'Not Closed'); 
             }
         }
     }
     
     function open_delivery_order($id){
         $user_id=$this->session->userdata('user_id');
         $result=$this->m_common->update_row('rm_delivery_orders',array('do_id'=>$id),array('closing_status'=>'Open','updated_by'=>$user_id));
         if(!empty($result)){
             redirect_with_msg('raw_materials/rm_sales', 'Successfully Open');
         }else{
             redirect_with_msg('raw_materials/rm_sales', 'Not Open');
         }
     }
     
     
     function reject_delivery_order($id){
         $result=$this->m_common->update_row('rm_delivery_orders',array('do_id'=>$id),array('do_status'=>'Rejected'));
         if(!empty($result)){
             redirect_with_msg('raw_materials/rm_sales', 'Successfully Rejected');
         }else{
             redirect_with_msg('raw_materials/rm_sales', 'Not Rejected');
         }
     }
     
     
     
     
     
    
    function add_rm_sale() {
        $this->menu = 'general_store';
        $this->sub_menu = 'consumption';
        $this->sub_inner_menu = 'rm_sales';
        $this->titlebackend("RM Sales");
        $branch_id= $this->session->userdata('companyId');
        $employee_id= $this->session->userdata('employeeId');
        
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        
        $sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length from rm_lots_details iscd left join rm_lots rml on iscd.lot_id=rml.id left join rm_items rmi on iscd.item_id=rmi.id  where rml.is_active=1 and rml.branch_id=".$branch_id;        
        $data['lots']=$this->m_common->customeQuery($sql);    
           
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        $data['employees']=$this->m_common->get_row_array('employees','','*');
        
        $all_issue=$this->m_common->get_row_array('rm_issue',array('branch_id'=>$branch_id,'issue_type'=>"Sales",'is_active'=>1),'*'); 
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
           $consumptionInfo['do_date']= date('Y-m-d',  strtotime($postData['do_date']));
           $consumptionInfo['do_no']= $postData['do_no'];           
           $consumptionInfo['customer_id']= $postData['customer_id'];
           $consumptionInfo['created_date']=date('Y-m-d');
           $consumptionInfo['created_by']=$employee_id;
           $consumptionInfo['issue_type']="Sales";
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
         redirect_with_msg('raw_materials/rm_sales', 'Consumption  Successfully Inserted');  
        }else{
            
         
            
            
         $this->load->view('raw_materials/rm_sales/v_add_sale',$data);   
        }
        
    }
    
    function edit_rm_sale($issue_id){
        $this->menu = 'general_store';
        $this->sub_menu = 'consumption';
        $this->sub_inner_menu = 'rm_sales';
        $this->titlebackend("RM Sales");
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
           $consumptionInfo['do_date']= date('Y-m-d',  strtotime($postData['do_date']));
           $consumptionInfo['do_no']= $postData['do_no'];           
           $consumptionInfo['customer_id']= $postData['customer_id'];
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
         redirect_with_msg('raw_materials/rm_sales/details_rm_sale/'.$issue_id, 'Successfully Updated');  
        }else{                        
           $this->load->view('raw_materials/rm_sales/v_edit_sale',$data);   
        }
        
    }
    
    function details_rm_sale($issue_id,$print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'consumption';
        $this->sub_inner_menu = 'rm_sales';
        $this->titlebackend("RM Sales");
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
            $this->load->view('raw_materials/rm_sales/v_details_sale',$data);   
        }else{
           $html=$this->load->view('raw_materials/rm_sales/print_sale',$data,true);
           echo $html;exit; 
        }
      
        
    }
    
    function delete_rm_sale($consumption_id){
        if (!empty($consumption_id)){
            $id=$this->m_common->delete_row('rm_issue',array('id'=>$consumption_id));       
            if (!empty($id)) {
                $this->m_common->delete_row('rm_issue_details', array('issue_id' => $consumption_id));
                redirect_with_msg('raw_materials/rm_sales', 'Successfully Deleted');
            } else {
                redirect_with_msg('raw_materials/rm_sales', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/rm_sales', 'Please click on delete button');
        }
    }
    
    
    function approved_sale($issue_id){
        $unit_id= $this->session->userdata('companyId');
        if(!empty($consumption_id)){
            $consumption=$this->m_common->get_row_array('rm_issue_details',array('issue_id'=>$issue_id),'*');           
            if(!empty($consumption)){
                       
                $this->m_common->update_row('rm_issue_details',array('issue_id'=>$issue_id),array('status'=>'Approved'));
               
               redirect_with_msg('raw_materials/rm_sales', 'Successfully Approved');
            } else {
                redirect_with_msg('raw_materials/rm_sales', 'Data not Approved for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/rm_sales', 'Please click on Approved button');
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
    
    
    
    function getLcLotDetails(){
        $this->setOutputMode(NORMAL);
        $lc_id=$this->input->post('lc_id');
        $sql="select iscd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,rmi.item_grade,tmu.meas_unit from import_lc_details iscd
        left join rm_items rmi on iscd.item_id=rmi.id 
        left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id        
        where iscd.lc_id=".$lc_id;
        $data['lc_details']=$this->m_common->customeQuery($sql);
        foreach($data['lc_details'] as $key=>$value){
            $do_sql="select sum(quantity) as total_qty from rm_delivery_orders_details where s_item_id=".$value['item_id']." and lc_details_id=".$value['id'];
            $do_qty=$this->m_common->customeQuery($do_sql);
            if(!empty($do_qty)){
               $remaining_qty=$value['qty']-$do_qty[0]['total_qty']; 
            }
            $data['lc_details'][$key]['remaining_qty']=$remaining_qty;
        }
        echo json_encode($data);
        
    } 
    
    
    function get_customer_info(){
        $this->setOutputMode(NORMAL);
        $customer_id=$this->input->post('customer_id');
        
        $data['customer_info']=$this->m_common->get_row_array('tbl_customers',array('id'=>$customer_id),'*');
        echo json_encode($data);
    }
    
}

