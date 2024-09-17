<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase_quotations extends Site_Controller {

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
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'purchase_quotation';
        $this->titlebackend("Quotations");
       // $data['quotations']=$this->m_common->get_row_array('tbl_sales_quotation
      //  $sql="select q.*,c.c_name from tbl_sales_quotation q left join tbl_customers c on q.customer_id=c.id where q.is_active=1";
        $sql="select q.*,s.SUP_NAME,d.dep_description from tbl_purchase_quotation q left join supplier s on q.supplier_id=s.ID left join department d on q.unit_id=d.d_id where q.is_active=1";
        $data['quotations']=$this->m_common->customeQuery($sql);
        $this->load->view('purchase_quotations/v_purchase_quotation',$data);
    }

   
     function add_quotation() {
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'purchase_quotation';
        $this->titlebackend("Quotation Information");
        $data['services'] = $this->m_common->get_row_array('tbl_services',array('is_active'=>1), '*');
        $data['indent_types'] = $this->m_common->get_row_array('tbl_indent_type',array('is_active'=>1), '*');
        $data['items']=$this->m_common->get_row_array('items','','*');
        $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
        $sql='select e.*,d.designation_name,d.designation_short_name from employees e left join designation d on e.designation_id=d.id ';
        $data['employees']=$this->m_common->customeQuery($sql);
        $data['projects']=$this->m_common->get_row_array('department','','*');
        $this->load->view('purchase_quotations/v_add_purchase_quotation',$data);
    }
     function add_quotation_action() {
         $branch_id= $this->session->userdata('companyId');
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             $insertPaymentCondition=array();   
             if(!empty($postData['q_type'])){
                 $insertData['q_type']=$postData['q_type'];
             }
             
             $quotation_type_info=$this->m_common->get_row_array('tbl_indent_type',array('id'=> $insertData['q_type']),'*');
             if(!empty($postData['quotation_no'])){
                 $insertData['quotation_no']=$postData['quotation_no'];
             }
             
             if(!empty($postData['supplier_id'])){
                 $insertData['supplier_id']=$postData['supplier_id'];
             }
             if(!empty($postData['reference_no'])){
                 $insertData['reference_no']=$postData['reference_no'];
             }
             if(!empty($postData['quotation_date'])){
                 $insertData['quotation_date']=date('Y-m-d',strtotime($postData['quotation_date']));
             }
             if(!empty($postData['attention'])){
                 $insertData['attention']=$postData['attention'];
             }
             if(!empty($postData['phone'])){
                 $insertData['phone']=$postData['phone'];
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
             if(!empty($postData['unit_id'])){
                 $insertData['unit_id']=$postData['unit_id'];
             }
            if($quotation_type_info[0]['type_name']=="Material"){
                if(!empty($postData['total_amount'])){
                    $insertData['total_amount']=$postData['total_amount'];
                }
            }else if($quotation_type_info[0]['type_name']=="Service"){
                 if(!empty($postData['s_total_amount'])){
                    $insertData['total_amount']=$postData['s_total_amount'];
                }
            }
             //$insertData['unit_id']=$branch_id;
             $insertData['is_active']=1;
             $insertData['status']='Pending';
             $insertData['created_date']=date('Y-m-d');
             
             if(empty($postData['b_cash']) && empty($postData['a_cash']) && empty($postData['b_bg']) && empty($postData['a_bg']) && empty($postData['b_lc']) && empty($postData['a_lc']) && empty($postData['b_pdc']) && empty($postData['a_pdc']) ){
                 redirect_with_msg('purchase_quotations/add_quotation', 'Please fill payment conditions');
             }
              if(empty($postData['b_cash_percent']) && empty($postData['a_cash_percent']) && empty($postData['b_bg_percent']) && empty($postData['a_bg_percent']) && empty($postData['b_lc_percent']) && empty($postData['a_lc_percent']) && empty($postData['b_pdc_percent']) && empty($postData['a_pdc_percent']) ){
                 redirect_with_msg('purchase_quotations/add_quotation', 'Please fill payment conditions');
             }
             $total_percent=$postData['b_cash_percent']+$postData['a_cash_percent']+$postData['b_bg_percent']+$postData['a_bg_percent']+$postData['b_lc_percent']+$postData['a_lc_percent']+$postData['b_pdc_percent']+$postData['a_pdc_percent'];
             if($total_percent<100){
                 redirect_with_msg('purchase_quotations/add_quotation', 'Please fulfil payment conditions');
             }else if($total_percent>100){
                 redirect_with_msg('purchase_quotations/add_quotation', 'Percentage of payment condition should not more than 100');
             }
             
             if(!empty($postData['b_cash'])){
                 $insertPaymentCondition['b_cash']=$postData['b_cash'];
                 if(!empty($postData['b_cash_tenor'])){
                     $insertPaymentCondition['b_cash_tenor']=$postData['b_cash_tenor'];
                 }
                 if(!empty($postData['b_cash_percent'])){
                     $insertPaymentCondition['b_cash_percent']=$postData['b_cash_percent'];
                 }
                 if(!empty($postData['b_cash_amount'])){
                     $insertPaymentCondition['b_cash_amount']=$postData['b_cash_amount'];
                 }
                
             }
             
             
            if(!empty($postData['a_cash'])){
                 $insertPaymentCondition['a_cash']=$postData['a_cash'];
                  if(!empty($postData['a_cash_tenor'])){
                     $insertPaymentCondition['a_cash_tenor']=$postData['a_cash_tenor'];
                 }
                 if(!empty($postData['a_cash_percent'])){
                     $insertPaymentCondition['a_cash_percent']=$postData['a_cash_percent'];
                 }
                 if(!empty($postData['a_cash_amount'])){
                     $insertPaymentCondition['a_cash_amount']=$postData['a_cash_amount'];
                 }
             }
             
             
             
             if(!empty($postData['b_bg'])){
                 $insertPaymentCondition['b_bg']=$postData['b_bg'];
                 if(!empty($postData['b_bg_tenor'])){
                     $insertPaymentCondition['b_bg_tenor']=$postData['b_bg_tenor'];
                 }
                 if(!empty($postData['b_bg_percent'])){
                     $insertPaymentCondition['b_bg_percent']=$postData['b_bg_percent'];
                 }
                 if(!empty($postData['b_bg_amount'])){
                     $insertPaymentCondition['b_bg_amount']=$postData['b_bg_amount'];
                 }
                 
             }
            
              if(!empty($postData['a_bg'])){
                 $insertPaymentCondition['a_bg']=$postData['a_bg'];
                 if(!empty($postData['a_bg_tenor'])){
                     $insertPaymentCondition['a_bg_tenor']=$postData['a_bg_tenor'];
                 }
                 if(!empty($postData['a_bg_percent'])){
                     $insertPaymentCondition['a_bg_percent']=$postData['a_bg_percent'];
                 }
                 if(!empty($postData['a_bg_amount'])){
                     $insertPaymentCondition['a_bg_amount']=$postData['a_bg_amount'];
                 }
             }
             
            
              if(!empty($postData['b_lc'])){
                 $insertPaymentCondition['b_lc']=$postData['b_lc'];
                 if(!empty($postData['b_lc_tenor'])){
                     $insertPaymentCondition['b_lc_tenor']=$postData['b_lc_tenor'];
                 }
                 if(!empty($postData['b_lc_percent'])){
                     $insertPaymentCondition['b_lc_percent']=$postData['b_lc_percent'];
                 }
                 if(!empty($postData['b_lc_amount'])){
                     $insertPaymentCondition['b_lc_amount']=$postData['b_lc_amount'];
                 }
                
             }
             
             
              if(!empty($postData['a_lc'])){
                 $insertPaymentCondition['a_lc']=$postData['a_lc'];
                 if(!empty($postData['a_lc_tenor'])){
                     $insertPaymentCondition['a_lc_tenor']=$postData['a_lc_tenor'];
                 }
                 if(!empty($postData['a_lc_percent'])){
                     $insertPaymentCondition['a_lc_percent']=$postData['a_lc_percent'];
                 }
                 if(!empty($postData['a_lc_amount'])){
                     $insertPaymentCondition['a_lc_amount']=$postData['a_lc_amount'];
                 }
             }
             
              if(!empty($postData['b_pdc'])){
                 $insertPaymentCondition['b_pdc']=$postData['b_pdc'];
                 if(!empty($postData['b_pdc_check'])){
                     $insertPaymentCondition['b_pdc_check']=$postData['b_pdc_check'];
                 }
                 if(!empty($postData['b_pdc_percent'])){
                     $insertPaymentCondition['b_pdc_percent']=$postData['b_pdc_percent'];
                 }
                 if(!empty($postData['b_pdc_amount'])){
                     $insertPaymentCondition['b_pdc_amount']=$postData['b_pdc_amount'];
                 }
                 
             }
             
             
             
              
              if(!empty($postData['a_pdc'])){
                 $insertPaymentCondition['a_pdc']=$postData['a_pdc'];
                 if(!empty($postData['a_pdc_check'])){
                     $insertPaymentCondition['a_pdc_check']=$postData['a_pdc_check'];
                 }
                 if(!empty($postData['a_pdc_percent'])){
                     $insertPaymentCondition['a_pdc_percent']=$postData['a_pdc_percent'];
                 }
                 if(!empty($postData['a_pdc_amount'])){
                     $insertPaymentCondition['a_pdc_amount']=$postData['a_pdc_amount'];
                 }
             }
             
             
             $result=$this->m_common->insert_row('tbl_purchase_quotation',$insertData);
             if(!empty($result)){
                 $insertPaymentCondition['is_active'] =1;
                 $insertPaymentCondition['q_id'] = $result;
                 $this->m_common->insert_row('tbl_purchase_quotation_code',array('q_code'=>$postData['q_code'],'unit_id'=>$branch_id));
                 $this->m_common->insert_row('tbl_purchase_quotation_payment_condition',$insertPaymentCondition);
                 if($quotation_type_info[0]['type_name']=="Material"){
                    foreach ($postData['item_id'] as $key => $each) {
                    
                            $insertData1=array();
                            $insertData1['q_id'] = $result;
                            $insertData1['item_id'] = $each;
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

                           

                            if(!empty($postData['remark'][$key])) { 
                                $insertData1['remark'] = $postData['remark'][$key];
                            }

                            $success=$this->m_common->insert_row('tbl_purchase_quotation_details',$insertData1);
                            
                         
                  }
                 }else if($quotation_type_info[0]['type_name']=="Service"){
                     foreach ($postData['service_id'] as $key => $each) {
                    
                            $insertData1=array();
                            $insertData1['q_id'] = $result;
                            $insertData1['service_id'] = $each;
                            $insertData1['is_active']=1;
                            if(empty($each)){
                                continue;
                            }
                              
                           if(!empty($postData['s_amount'][$key])) { 
                               $insertData1['amount'] = $postData['s_amount'][$key];
                           }

                            if(!empty($postData['s_remark'][$key])) { 
                                $insertData1['remark'] = $postData['s_remark'][$key];
                            }

                            $success=$this->m_common->insert_row('tbl_purchase_quotation_details',$insertData1);
                            
                         
                     }
                 } 
                  
                
                  redirect_with_msg('purchase_quotations', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('purchase_quotations/add_quotation', 'Please fill the form and submit');
         }
         
     }
    
     function edit_quotation($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'purchase_quotation';
        $this->titlebackend("Quotation Information");
        $data['services'] = $this->m_common->get_row_array('tbl_services',array('is_active'=>1), '*');
        $data['indent_types'] = $this->m_common->get_row_array('tbl_indent_type',array('is_active'=>1), '*');
        
        $sql='select e.*,d.designation_name,d.designation_short_name from employees e left join designation d on e.designation_id=d.id ';
        $data['employees']=$this->m_common->customeQuery($sql);
        $data['projects']=$this->m_common->get_row_array('department','','*');
        $data['items']=$this->m_common->get_row_array('items','','*');
        $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
        //$data['quotation_info']=$this->m_common->get_row_array('tbl_purchase_quotation',array('q_id'=>$id),'*');
        $sql="select pq.*,it.type_name from tbl_purchase_quotation pq left join tbl_indent_type it on pq.q_type=it.id where pq.q_id=".$id;
        $data['quotation_info']=$this->m_common->customeQuery($sql);
        $data['payment_info']=$this->m_common->get_row_array('tbl_purchase_quotation_payment_condition',array('q_id'=>$id),'*');
        $sql="select d.*,i.meas_unit from tbl_purchase_quotation_details d left join items i on d.item_id=i.id where d.is_active=1 and q_id=".$id;
       //  $sql="select d.*,i.meas_unit,s.service_name,s.id from tbl_purchase_quotation_details d left join items i on d.item_id=i.id left join tbl_services s on d.service_id=s.id where d.is_active=1 and q_id=".$id;
        $data['quotation_details_info']=$this->m_common->customeQuery($sql);
      
        $this->load->view('purchase_quotations/v_edit_purchase_quotation',$data);
    }
    
    
    function details_quotation($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'purchase_quotation';
        $this->titlebackend("Quotation Information");
        $data['services'] = $this->m_common->get_row_array('tbl_services',array('is_active'=>1), '*');
        $data['indent_types'] = $this->m_common->get_row_array('tbl_indent_type',array('is_active'=>1), '*');
        $sql='select e.*,d.designation_name,d.designation_short_name from employees e left join designation d on e.designation_id=d.id ';
        $data['employees']=$this->m_common->customeQuery($sql);
        $data['projects']=$this->m_common->get_row_array('department','','*');
        $data['items']=$this->m_common->get_row_array('items','','*');
        $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
        //$data['quotation_info']=$this->m_common->get_row_array('tbl_purchase_quotation',array('q_id'=>$id),'*');
        $sql="select pq.*,it.type_name from tbl_purchase_quotation pq left join tbl_indent_type it on pq.q_type=it.id where pq.q_id=".$id;
        $data['quotation_info']=$this->m_common->customeQuery($sql);
        $data['payment_info']=$this->m_common->get_row_array('tbl_purchase_quotation_payment_condition',array('q_id'=>$id),'*');
        $sql="select d.*,i.meas_unit from tbl_purchase_quotation_details d left join items i on d.item_id=i.id where d.is_active=1 and q_id=".$id;
        $data['quotation_details_info']=$this->m_common->customeQuery($sql);
      
        $this->load->view('purchase_quotations/v_details_purchase_quotation',$data);
    }
    
    function offer_quotation($id,$print='') {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'quotations';
        $this->titlebackend("Offer Letter");
        $data['services'] = $this->m_common->get_row_array('tbl_services',array('is_active'=>1), '*');
        $data['indent_types'] = $this->m_common->get_row_array('tbl_indent_type',array('is_active'=>1), '*');
        $sql='select e.*,d.designation_name,d.designation_short_name from employees e left join designation d on e.designation_id=d.id ';
        $data['employees']=$this->m_common->customeQuery($sql);
        $data['categories']=$this->m_common->get_row_array('tbl_product_categories',array('is_active'=>1),'*');
        $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        $q_sql='select sq.*,c.c_name,c.c_contact_address,pc.category_name,pc.short_name,e.name,e.mobile,dg.designation_name from tbl_sales_quotation sq left join tbl_customers c on sq.customer_id=c.id left join tbl_product_categories pc on sq.category_id=pc.category_id left join employees e on sq.thanks_employee_id=e.id left join designation dg on e.designation_id=dg.id where sq.q_id='.$id;
        $data['quotation_info']=$this->m_common->customeQuery($q_sql);
        $data['payment_info']=$this->m_common->get_row_array('tbl_sales_quotation_payment_condition',array('q_id'=>$id),'*');
        $sql="select d.*,p.product_name,p.performance,p.measurement_unit,pqp.cost_number from tbl_sales_quotation_details d left join tbl_sales_products p on d.product_id=p.product_id left join tbl_product_quote_price pqp on d.product_cost_id=pqp.product_cost_id where d.is_active=1 and q_id=".$id;
        $data['quotation_details_info']=$this->m_common->customeQuery($sql);
        $data['raw_material_specification']=$this->m_common->get_row_array('tbl_sales_quotation_material_specification',array('q_id'=>$id,'is_active'=>1),'*');
        if(empty($print)){
            $this->load->view('sale_quotations/v_offer_letter',$data);
        }else{
            $html =$this->load->view('sale_quotations/print_offer_letter',$data,true);
            echo $html;exit;
        }
    }
    
    function edit_quotation_action($q_id) {
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             $insertPaymentCondition=array();
            
             if(!empty($postData['q_type'])){
                 $insertData['q_type']=$postData['q_type'];
             }
             $quotation_type_info=$this->m_common->get_row_array('tbl_indent_type',array('id'=> $insertData['q_type']),'*');
             if(!empty($postData['quotation_no'])){
                 $insertData['quotation_no']=$postData['quotation_no'];
             }
             
             if(!empty($postData['supplier_id'])){
                 $insertData['supplier_id']=$postData['supplier_id'];
             }
             
             if(!empty($postData['quotation_date'])){
                 $insertData['quotation_date']=date('Y-m-d',strtotime($postData['quotation_date']));
             }
             if(!empty($postData['attention'])){
                 $insertData['attention']=$postData['attention'];
             }
             if(!empty($postData['phone'])){
                 $insertData['phone']=$postData['phone'];
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
             if(!empty($postData['unit_id'])){
                 $insertData['unit_id']=$postData['unit_id'];
             }
            
           if($quotation_type_info[0]['type_name']=="Material"){
                if(!empty($postData['total_amount'])){
                    $insertData['total_amount']=$postData['total_amount'];
                }
            }else if($quotation_type_info[0]['type_name']=="Service"){
                 if(!empty($postData['s_total_amount'])){
                    $insertData['total_amount']=$postData['s_total_amount'];
                }
            }
             
             if(empty($postData['b_cash']) && empty($postData['a_cash']) && empty($postData['b_bg']) && empty($postData['a_bg']) && empty($postData['b_lc']) && empty($postData['a_lc']) && empty($postData['b_pdc']) && empty($postData['a_pdc']) ){
                 redirect_with_msg('sale_quotations/edit_quotation/'.$q_id, 'Please fill payment conditions');
             }
             
             if(empty($postData['b_cash_percent']) && empty($postData['a_cash_percent']) && empty($postData['b_bg_percent']) && empty($postData['a_bg_percent']) && empty($postData['b_lc_percent']) && empty($postData['a_lc_percent']) && empty($postData['b_pdc_percent']) && empty($postData['a_pdc_percent']) ){
                 redirect_with_msg('sale_quotations/edit_quotation/'.$q_id, 'Please fill payment conditions');
             }
             
             $total_percent=$postData['b_cash_percent']+$postData['a_cash_percent']+$postData['b_bg_percent']+$postData['a_bg_percent']+$postData['b_lc_percent']+$postData['a_lc_percent']+$postData['b_pdc_percent']+$postData['a_pdc_percent'];
             if($total_percent<100){
                  redirect_with_msg('sale_quotations/edit_quotation/'.$q_id, 'Please fill payment conditions');
             }else if($total_percent>100){
                  redirect_with_msg('sale_quotations/edit_quotation/'.$q_id, 'Percentage of payment condition should not more than 100');
             }
             
              if(!empty($postData['b_cash'])){
                 $insertPaymentCondition['b_cash']=$postData['b_cash'];
                 if(!empty($postData['b_cash_tenor'])){
                     $insertPaymentCondition['b_cash_tenor']=$postData['b_cash_tenor'];
                 }
                 if(!empty($postData['b_cash_percent'])){
                     $insertPaymentCondition['b_cash_percent']=$postData['b_cash_percent'];
                 }
                 if(!empty($postData['b_cash_amount'])){
                     $insertPaymentCondition['b_cash_amount']=$postData['b_cash_amount'];
                 }
                
             }else{
                 $insertPaymentCondition['b_cash']='';
                 $insertPaymentCondition['b_cash_tenor']='';
                 $insertPaymentCondition['b_cash_percent']='';
                 $insertPaymentCondition['b_cash_amount']='';
                 
             }
            
             
            if(!empty($postData['a_cash'])){
                 $insertPaymentCondition['a_cash']=$postData['a_cash'];
                 if(!empty($postData['a_cash_tenor'])){
                     $insertPaymentCondition['a_cash_tenor']=$postData['a_cash_tenor'];
                 }
                 if(!empty($postData['a_cash_percent'])){
                     $insertPaymentCondition['a_cash_percent']=$postData['a_cash_percent'];
                 }
                 if(!empty($postData['a_cash_amount'])){
                     $insertPaymentCondition['a_cash_amount']=$postData['a_cash_amount'];
                 }
             }else{
                 $insertPaymentCondition['a_cash']='';
                 $insertPaymentCondition['a_cash_tenor']='';
                 $insertPaymentCondition['a_cash_percent']='';
                 $insertPaymentCondition['a_cash_amount']='';
             }
             
             
             if(!empty($postData['b_bg'])){
                 $insertPaymentCondition['b_bg']=$postData['b_bg'];
                 if(!empty($postData['b_bg_tenor'])){
                     $insertPaymentCondition['b_bg_tenor']=$postData['b_bg_tenor'];
                 }
                 if(!empty($postData['b_bg_percent'])){
                     $insertPaymentCondition['b_bg_percent']=$postData['b_bg_percent'];
                 }
                 if(!empty($postData['b_bg_amount'])){
                     $insertPaymentCondition['b_bg_amount']=$postData['b_bg_amount'];
                 }
                
             }else{
                 $insertPaymentCondition['b_bg']='';
                 $insertPaymentCondition['b_bg_tenor']='';
                 $insertPaymentCondition['b_bg_percent']='';
                 $insertPaymentCondition['b_bg_amount']='';
                 
             }
             
             
             
              if(!empty($postData['a_bg'])){
                 $insertPaymentCondition['a_bg']=$postData['a_bg'];
                 if(!empty($postData['a_bg_tenor'])){
                     $insertPaymentCondition['a_bg_tenor']=$postData['a_bg_tenor'];
                 }
                 if(!empty($postData['a_bg_percent'])){
                     $insertPaymentCondition['a_bg_percent']=$postData['a_bg_percent'];
                 }
                 if(!empty($postData['a_bg_amount'])){
                     $insertPaymentCondition['a_bg_amount']=$postData['a_bg_amount'];
                 }
             }else{
                 $insertPaymentCondition['a_bg']='';
                 $insertPaymentCondition['a_bg_tenor']='';
                 $insertPaymentCondition['a_bg_percent']='';
                 $insertPaymentCondition['a_bg_amount']='';
             }
             
              if(!empty($postData['b_lc'])){
                 $insertPaymentCondition['b_lc']=$postData['b_lc'];
                 if(!empty($postData['b_lc_tenor'])){
                     $insertPaymentCondition['b_lc_tenor']=$postData['b_lc_tenor'];
                 }
                 if(!empty($postData['b_lc_percent'])){
                     $insertPaymentCondition['b_lc_percent']=$postData['b_lc_percent'];
                 }
                 if(!empty($postData['b_lc_amount'])){
                     $insertPaymentCondition['b_lc_amount']=$postData['b_lc_amount'];
                 }
                 
             }else{
                 $insertPaymentCondition['b_lc']='';
                 $insertPaymentCondition['b_lc_tenor']='';
                 $insertPaymentCondition['b_lc_percent']='';
                 $insertPaymentCondition['b_lc_amount']='';
                 
             }
             
             
             
              if(!empty($postData['a_lc'])){
                 $insertPaymentCondition['a_lc']=$postData['a_lc'];
                 if(!empty($postData['a_lc_tenor'])){
                     $insertPaymentCondition['a_lc_tenor']=$postData['a_lc_tenor'];
                 }
                 if(!empty($postData['a_lc_percent'])){
                     $insertPaymentCondition['a_lc_percent']=$postData['a_lc_percent'];
                 }
                 if(!empty($postData['a_lc_amount'])){
                     $insertPaymentCondition['a_lc_amount']=$postData['a_lc_amount'];
                 }
             }else{
                 $insertPaymentCondition['a_lc']='';
                 $insertPaymentCondition['a_lc_tenor']='';
                 $insertPaymentCondition['a_lc_percent']='';
                 $insertPaymentCondition['a_lc_amount']='';
             }
             
              if(!empty($postData['b_pdc'])){
                 $insertPaymentCondition['b_pdc']=$postData['b_pdc'];
                 if(!empty($postData['b_pdc_check'])){
                     $insertPaymentCondition['b_pdc_check']=$postData['b_pdc_check'];
                 }
                 if(!empty($postData['b_pdc_percent'])){
                     $insertPaymentCondition['b_pdc_percent']=$postData['b_pdc_percent'];
                 }
                 if(!empty($postData['b_pdc_amount'])){
                     $insertPaymentCondition['b_pdc_amount']=$postData['b_pdc_amount'];
                 }
                 
             }else{
                 $insertPaymentCondition['b_pdc']='';
                 $insertPaymentCondition['b_pdc_check']='';
                 $insertPaymentCondition['b_pdc_percent']='';
                 $insertPaymentCondition['b_pdc_amount']='';
                 
             }
             
             
            if(!empty($postData['a_pdc'])){
                 $insertPaymentCondition['a_pdc']=$postData['a_pdc'];
                 if(!empty($postData['a_pdc_check'])){
                     $insertPaymentCondition['a_pdc_check']=$postData['a_pdc_check'];
                 }
                 if(!empty($postData['a_pdc_percent'])){
                     $insertPaymentCondition['a_pdc_percent']=$postData['a_pdc_percent'];
                 }
                 if(!empty($postData['a_pdc_amount'])){
                     $insertPaymentCondition['a_pdc_amount']=$postData['a_pdc_amount'];
                 }
             }else{
                 $insertPaymentCondition['a_pdc']='';
                 $insertPaymentCondition['a_pdc_check']='';
                 $insertPaymentCondition['a_pdc_percent']='';
                 $insertPaymentCondition['a_pdc_amount']='';
             }
             
             
             
             $result=$this->m_common->update_row('tbl_purchase_quotation',array('q_id'=>$q_id),$insertData);
             if($result>=0){
                 $this->m_common->update_row('tbl_purchase_quotation_payment_condition',array('q_id'=>$q_id),$insertPaymentCondition);
                 $this->m_common->delete_row('tbl_purchase_quotation_details',array('q_id'=>$q_id));
                 if($quotation_type_info[0]['type_name']=="Material"){
                     foreach ($postData['item_id'] as $key => $each) {
                     
                      $insertData1=array();
                      $insertData1['q_id'] = $q_id;
                      $insertData1['item_id'] = $each;
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
                       
                      
                       
                       if(!empty($postData['remark'][$key])) { 
                          $insertData1['remark'] = $postData['remark'][$key];
                       }
                 
                      $this->m_common->insert_row('tbl_purchase_quotation_details',$insertData1);
                  }
                 }else if($quotation_type_info[0]['type_name']=="Service"){
                      foreach ($postData['service_id'] as $key => $each) {
                     
                      $insertData1=array();
                      $insertData1['q_id'] = $q_id;
                      $insertData1['service_id'] = $each;
                      $insertData1['is_active']=1;
                      if(empty($each)){
                          continue;
                      }
                        
                       if(!empty($postData['s_amount'][$key])) { 
                          $insertData1['amount'] = $postData['s_amount'][$key];
                       }
                       
                       if(!empty($postData['s_remark'][$key])) { 
                          $insertData1['remark'] = $postData['s_remark'][$key];
                       }
                 
                      $this->m_common->insert_row('tbl_purchase_quotation_details',$insertData1);
                  }
                 }  
                  redirect_with_msg('purchase_quotations', 'Successfully Updated');
             }
         }else{
              redirect_with_msg('purchase_quotations/add_quotation', 'Please fill the form and submit');
         }
         
     }
     
     function delete_quotation($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('tbl_purchase_quotation', array('q_id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                $this->m_common->update_row('tbl_purchase_quotation_payment_condition', array('q_id' => $id),array('is_active'=>0));
                $this->m_common->update_row('tbl_purchase_quotation_details', array('q_id' => $id),array('is_active'=>0));
                redirect_with_msg('purchase_quotations/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('purchase_quotations/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('purchase_quotations/index', 'Please click on delete button');
        }
    }
     
  
   
  function item_info(){
      $this->setOutputMode(NORMAL);
      $item_id=$this->input->post('itemId');
      //$data['item_info']=$this->m_common->get_row_array('items',array('id'=>$item_id),'*');
      //$data=$this->m_common->get_row_array('items',array('id'=>$item_id),'*');
      $data['item_info']=$this->m_common->get_row_array('items',array('id'=>$item_id),'*');
       
      //$data['item_previous_info']=$this->m_common->get_row_array('v_material_receive_requistion_details',array('item_id'=>$item_id),'*','',1,'mrrd_id','DESC');
    
      echo json_encode($data);
    }
    
    function supplier_info(){
        $this->setOutputMode(NORMAL);
        $branch_id= $this->session->userdata('companyId');
        $id=$this->input->post('id');
        $supplier=$this->m_common->get_row_array('supplier',array('ID'=>$id),'*');
        if(!empty($supplier)){
            $data['suppplier_info']=$supplier;
            $suppplier_services = unserialize($supplier[0]['services']);
            $id='';
            if(!empty($suppplier_services)){
                foreach($suppplier_services as $s_service){
                    if(empty($id)){
                        $id="id=".$s_service;
                    }else{
                        $id.=" or id=".$s_service;
                    }
                }
                $sql="select * from tbl_services where ".$id;
                $data['services']=$this->m_common->customeQuery($sql); 
            }else{
                $data['services']='';
            }
        }else{
            $data['suppplier_info']='';
        }
        echo json_encode($data);
    } 
    
   function unit_info(){
        $this->setOutputMode(NORMAL);
        $branch_id= $this->session->userdata('companyId');
        $id=$this->input->post('id');
        
        
        $data['quotaion']=$this->m_common->get_row_array('tbl_purchase_quotation_code',array('unit_id'=>$branch_id),'*','',1,'id','DESC');
        $unit=$this->m_common->get_row_array('department',array('d_id'=>$id),'*');
        if(!empty($unit)){
            $data['unit_info']=$unit;
        }else{
            $data['unit_info']='';
        }
        echo json_encode($data);
    }  
    
  
    
   
   

}




