<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sale_quotations extends Site_Controller {

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
        $user_category= $this->session->userdata('user_category');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'quotations';
        $this->titlebackend("Quotations");
       // $data['quotations']=$this->m_common->get_row_array('tbl_sales_quotation
      //  $sql="select q.*,c.c_name from tbl_sales_quotation q left join tbl_customers c on q.customer_id=c.id where q.is_active=1";
       
        $show_data_info=$this->m_common->get_row_array('tbl_show_data_setting','','*');
        $currentDate=date('Y-m-d');
        $prev_date = date('Y-m-d', strtotime($currentDate .' -'.$show_data_info['0']['day'].' days'));
        
        if($user_category==2){
            $sql="select q.*,c.c_name from tbl_sales_quotation q 
            left join tbl_customers c on q.customer_id=c.id 
            where (q.quotation_date>='$prev_date' and q.quotation_date<='$currentDate') and q.is_active=1 and q.unit_id=".$branch_id.' 
            order by q.quotation_date desc';
        }else{
            $sql="select q.*,c.c_name from tbl_sales_quotation q 
            left join tbl_customers c on q.customer_id=c.id 
            where q.is_active=1 and q.unit_id=".$branch_id.' 
            order by q.quotation_date desc';
        }

        $data['quotations']=$this->m_common->customeQuery($sql);
        $this->load->view('sale_quotations/v_sale_quotation',$data);
    }

   
     function add_quotation() {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'quotations';
        $this->titlebackend("Quotation Information");
        $branch_id= $this->session->userdata('companyId');
        $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        foreach($data['customers'] as $key=>$value){
            $costing_info=array();
            $costing_info=$this->m_common->get_row_array('tbl_product_quote_price',array('status'=>"Pending",'customer_id'=>$data['customers'][$key]['id'],'unit_id'=>$branch_id),'*');
            if(empty($costing_info)){
                unset($data['customers'][$key]);
            }
        }
        $sql='select e.*,d.designation_name,d.designation_short_name from employees e left join designation d on e.designation_id=d.id ';
        $data['employees']=$this->m_common->customeQuery($sql);
        $data['categories']=$this->m_common->get_row_array('tbl_product_categories',array('is_active'=>1),'*');
        $data['banks']=$this->m_common->get_row_array('tbl_banks',array('is_active'=>1),'*');
        $this->load->view('sale_quotations/v_add_sale_quotation',$data);
    }
     function add_quotation_action() {
         $branch_id= $this->session->userdata('companyId');
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             $insertPaymentCondition=array();
             if(empty($postData['select_product'])){
                 redirect_with_msg('sale_quotations/add_quotation', 'Please Select Product');
             }
             if(!empty($postData['customer_id'])){
                 $insertData['customer_id']=$postData['customer_id'];
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
             if(!empty($postData['project_id'])){
                 $insertData['project_id']=$postData['project_id'];
             }
             if(!empty($postData['project_name'])){
                 $insertData['project_name']=$postData['project_name'];
             }
             if(!empty($postData['employee_id'])){
                 $insertData['employee_id']=$postData['employee_id'];
             }
             if(!empty($postData['thanks_employee_id'])){
                 $insertData['thanks_employee_id']=$postData['thanks_employee_id'];
             }
             if(!empty($postData['followup_employee_id'])){
                 $insertData['followup_employee_id']=$postData['followup_employee_id'];
             }
             if(!empty($postData['special_note'])){
                 $insertData['special_note']=$postData['special_note'];
             }
             if(!empty($postData['category_id'])){
                 $insertData['category_id']=$postData['category_id'];
             }
             
             if(!empty($postData['bank_id'])){
                 $insertData['bank_id']=$postData['bank_id'];
             }
             
             if(!empty($postData['bank_show'])){
                 $insertData['bank_show']=$postData['bank_show'];
             }
             
             if(!empty($postData['total_amount'])){
                 $insertData['total_amount']=$postData['total_amount'];
             }
             $insertData['unit_id']=$branch_id;
             $insertData['is_active']=1;
             $insertData['status']='Pending';
             $insertData['created_date']=date('Y-m-d');
             
             if(empty($postData['b_cash']) && empty($postData['a_cash']) && empty($postData['b_bg']) && empty($postData['a_bg']) && empty($postData['b_lc']) && empty($postData['a_lc']) && empty($postData['b_pdc']) && empty($postData['a_pdc']) ){
                 redirect_with_msg('sale_quotations/add_quotation', 'Please fill payment conditions');
             }
              if(empty($postData['b_cash_percent']) && empty($postData['a_cash_percent']) && empty($postData['b_bg_percent']) && empty($postData['a_bg_percent']) && empty($postData['b_lc_percent']) && empty($postData['a_lc_percent']) && empty($postData['b_pdc_percent']) && empty($postData['a_pdc_percent']) ){
                 redirect_with_msg('sale_quotations/add_quotation', 'Please fill payment conditions');
             }
             $total_percent=$postData['b_cash_percent']+$postData['a_cash_percent']+$postData['b_bg_percent']+$postData['a_bg_percent']+$postData['b_lc_percent']+$postData['a_lc_percent']+$postData['b_pdc_percent']+$postData['a_pdc_percent'];
             $total_amount=$postData['b_cash_amount']+$postData['a_cash_amount']+$postData['b_bg_amount']+$postData['a_bg_amount']+$postData['b_lc_amount']+$postData['a_lc_amount']+$postData['b_pdc_amount']+$postData['a_pdc_amount'];
             
             if($total_percent<100){
                 if($total_amount!=$postData['total_amount']){
                     redirect_with_msg('sale_quotations/add_quotation', 'Please fulfil payment conditions');
                 }
             }else if($total_percent>100){
                 redirect_with_msg('sale_quotations/add_quotation', 'Percentage of payment condition should not more than 100');
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
                 if(!empty($postData['b_cash_condition'])){
                    $insertPaymentCondition['b_cash_condition']=$postData['b_cash_condition'];
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
                 if(!empty($postData['b_bg_condition'])){
                    $insertPaymentCondition['b_bg_condition']=$postData['b_bg_condition'];
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
                 if(!empty($postData['b_lc_condition'])){
                    $insertPaymentCondition['b_lc_condition']=$postData['b_lc_condition'];
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
                 if(!empty($postData['b_pdc_condition'])){
                    $insertPaymentCondition['b_pdc_condition']=$postData['b_pdc_condition'];
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
             
             
             $result=$this->m_common->insert_row('tbl_sales_quotation',$insertData);
             if(!empty($result)){
                 $insertPaymentCondition['is_active'] =1;
                 $insertPaymentCondition['q_id'] = $result;
                 $this->m_common->insert_row('tbl_sales_quotation_code',array('customer_id'=>$postData['customer_id'],'q_code'=>$postData['q_code'],'unit_id'=>$branch_id));
                 $this->m_common->insert_row('tbl_sales_quotation_payment_condition',$insertPaymentCondition);
                 foreach ($postData['product_id'] as $key => $each) {
                     if(in_array($key,$postData['select_product'])){
                            $insertData1=array();
                            $insertData1['q_id'] = $result;
                            $insertData1['product_id'] = $each;
                            $insertData1['is_active']=1;
                            if(empty($each)){
                                continue;
                            }
                            if(!empty($postData['product_cost_id'][$key])) {
                                 $insertData1['product_cost_id'] = $postData['product_cost_id'][$key];

                            }
                            if(!empty($postData['quantity'][$key])) {
                                 $insertData1['quantity'] = $postData['quantity'][$key];
                             }
                             
                             if(!empty($postData['mu_name'][$key])) {
                                 $insertData1['mu_name'] = strtoupper($postData['mu_name'][$key]);
                             }
                             
                             if(isset($postData['base_price'][$key]) && !empty($postData['base_price'][$key])) { 
                                $insertData1['base_price'] = $postData['base_price'][$key];
                             }
                             if(isset($postData['vat'][$key]) && !empty($postData['vat'][$key])) { 
                                $insertData1['vat'] = $postData['vat'][$key];
                             }
                             
                             if(!empty($postData['unit_price'][$key])) { 
                                $insertData1['unit_price'] = $postData['unit_price'][$key];
                             }
                             if(!empty($postData['amount'][$key])) { 
                                $insertData1['amount'] = $postData['amount'][$key];
                             }

                            if(!empty($postData['description'][$key])) { 
                                $insertData1['description'] = $postData['description'][$key];
                            }

                            if(!empty($postData['remark'][$key])) { 
                                $insertData1['remark'] = $postData['remark'][$key];
                            }

                            $success=$this->m_common->insert_row('tbl_sales_quotation_details',$insertData1);
                            if(!empty($success)){
                                $this->m_common->update_row('tbl_product_quote_price',array('product_cost_id'=>$postData['product_cost_id'][$key]),array('status'=>"Approved"));
                            }
                     }    
                  }
                  
                  foreach ($postData['material_name'] as $key => $each) {
                      $insertData2=array();
                      $insertData2['q_id'] = $result;
                      
                      $insertData2['is_active']=1;
                      if(empty($each)){
                          continue;
                      }
                      if(!empty($postData['material_name'][$key])) {
                           $insertData2['material_name'] = $postData['material_name'][$key];
                       }
                      if(!empty($postData['m_description'][$key])) { 
                          $insertData2['m_description'] = $postData['m_description'][$key];
                      }    
                      $this->m_common->insert_row('tbl_sales_quotation_material_specification',$insertData2);
                  }
                  redirect_with_msg('sale_quotations', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('sale_quotations/add_quotation', 'Please fill the form and submit');
         }
         
     }
    
     function edit_quotation($id) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'quotations';
        $this->titlebackend("Quotation Information");
        $data['banks']=$this->m_common->get_row_array('tbl_banks',array('is_active'=>1),'*');
        $sql='select e.*,d.designation_name,d.designation_short_name from employees e left join designation d on e.designation_id=d.id ';
        $data['employees']=$this->m_common->customeQuery($sql);
        $data['categories']=$this->m_common->get_row_array('tbl_product_categories',array('is_active'=>1),'*');
        $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        $data['quotation_info']=$this->m_common->get_row_array('tbl_sales_quotation',array('q_id'=>$id),'*');
        $data['payment_info']=$this->m_common->get_row_array('tbl_sales_quotation_payment_condition',array('q_id'=>$id),'*');
        $sql="select d.*,p.product_name,pqp.cost_number,pqp.project_name from tbl_sales_quotation_details d left join tbl_sales_products p on d.product_id=p.product_id left join tbl_product_quote_price pqp on d.product_cost_id=pqp.product_cost_id where d.is_active=1 and q_id=".$id;
        $data['quotation_details_info']=$this->m_common->customeQuery($sql);
        $data['raw_material_specification']=$this->m_common->get_row_array('tbl_sales_quotation_material_specification',array('q_id'=>$id,'is_active'=>1),'*');
        $this->load->view('sale_quotations/v_edit_sale_quotation',$data);
    }
    
    
    function details_quotation($id) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'quotations';
        $this->titlebackend("Quotation Information");
        $data['banks']=$this->m_common->get_row_array('tbl_banks',array('is_active'=>1),'*');
        $sql='select e.*,d.designation_name,d.designation_short_name from employees e left join designation d on e.designation_id=d.id ';
        $data['employees']=$this->m_common->customeQuery($sql);
        $data['categories']=$this->m_common->get_row_array('tbl_product_categories',array('is_active'=>1),'*');
        $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        $data['quotation_info']=$this->m_common->get_row_array('tbl_sales_quotation',array('q_id'=>$id),'*');
        $data['payment_mode']=$this->m_common->get_row_array('tbl_sales_quotation_payment_condition',array('q_id'=>$id),'*');
        $sql="select d.*,p.product_name,pqp.cost_number,pqp.project_name from tbl_sales_quotation_details d left join tbl_sales_products p on d.product_id=p.product_id left join tbl_product_quote_price pqp on d.product_cost_id=pqp.product_cost_id where d.is_active=1 and q_id=".$id;
        $data['quotation_details_info']=$this->m_common->customeQuery($sql);
        $data['raw_material_specification']=$this->m_common->get_row_array('tbl_sales_quotation_material_specification',array('q_id'=>$id,'is_active'=>1),'*');
        $this->load->view('sale_quotations/v_details_sale_quotation',$data);
    }
    
     function offer_quotation($id,$print='') {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'quotations';
        $this->titlebackend("Offer Letter");
        $sql='select e.*,d.designation_name,d.designation_short_name from employees e left join designation d on e.designation_id=d.id ';
        $data['employees']=$this->m_common->customeQuery($sql);
        $data['categories']=$this->m_common->get_row_array('tbl_product_categories',array('is_active'=>1),'*');
        $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
       // $q_sql='select sq.*,c.c_name,c.c_contact_address,pc.category_name,pc.short_name,e.name,e.mobile,dg.designation_name from tbl_sales_quotation sq left join tbl_customers c on sq.customer_id=c.id left join tbl_product_categories pc on sq.category_id=pc.category_id left join employees e on sq.thanks_employee_id=e.id left join designation dg on e.designation_id=dg.id where sq.q_id='.$id;
        $q_sql='select tb.b_name,tb.branch_name,tb.b_account_no,tb.b_rounting_no,sq.*,c.c_name,c.c_contact_address,pc.category_name,pc.short_name,e.name,e.mobile,dg.designation_name from tbl_sales_quotation sq left join tbl_customers c on sq.customer_id=c.id left join tbl_product_categories pc on sq.category_id=pc.category_id left join employees e on sq.thanks_employee_id=e.id left join designation dg on e.designation_id=dg.id left join tbl_banks tb on sq.bank_id=tb.id where sq.q_id='.$id;
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
             if(!empty($postData['customer_id'])){
                 $insertData['customer_id']=$postData['customer_id'];
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
             if(!empty($postData['project_id'])){
                 $insertData['project_id']=$postData['project_id'];
             }
             if(!empty($postData['project_name'])){
                 $insertData['project_name']=$postData['project_name'];
             }
             if(!empty($postData['employee_id'])){
                 $insertData['employee_id']=$postData['employee_id'];
             }
             if(!empty($postData['thanks_employee_id'])){
                 $insertData['thanks_employee_id']=$postData['thanks_employee_id'];
             }
             if(!empty($postData['followup_employee_id'])){
                 $insertData['followup_employee_id']=$postData['followup_employee_id'];
             }
             if(!empty($postData['special_note'])){
                 $insertData['special_note']=$postData['special_note'];
             }
             if(!empty($postData['category_id'])){
                 $insertData['category_id']=$postData['category_id'];
             }
             
             if(!empty($postData['bank_id'])){
                 $insertData['bank_id']=$postData['bank_id'];
             }
             
             if(!empty($postData['bank_show'])){
                 $insertData['bank_show']=$postData['bank_show'];
             }
            
             if(!empty($postData['total_amount'])){
                 $insertData['total_amount']=$postData['total_amount'];
             }
             
             
             if(empty($postData['b_cash']) && empty($postData['a_cash']) && empty($postData['b_bg']) && empty($postData['a_bg']) && empty($postData['b_lc']) && empty($postData['a_lc']) && empty($postData['b_pdc']) && empty($postData['a_pdc']) ){
                 redirect_with_msg('sale_quotations/edit_quotation/'.$q_id, 'Please fill payment conditions');
             }
             
             if(empty($postData['b_cash_percent']) && empty($postData['a_cash_percent']) && empty($postData['b_bg_percent']) && empty($postData['a_bg_percent']) && empty($postData['b_lc_percent']) && empty($postData['a_lc_percent']) && empty($postData['b_pdc_percent']) && empty($postData['a_pdc_percent']) ){
                 redirect_with_msg('sale_quotations/edit_quotation/'.$q_id, 'Please fill payment conditions');
             }
             
             $total_percent=$postData['b_cash_percent']+$postData['a_cash_percent']+$postData['b_bg_percent']+$postData['a_bg_percent']+$postData['b_lc_percent']+$postData['a_lc_percent']+$postData['b_pdc_percent']+$postData['a_pdc_percent'];
             $total_amount=$postData['b_cash_amount']+$postData['a_cash_amount']+$postData['b_bg_amount']+$postData['a_bg_amount']+$postData['b_lc_amount']+$postData['a_lc_amount']+$postData['b_pdc_amount']+$postData['a_pdc_amount'];
             if($total_percent<100){
                 if($total_amount!=$postData['total_amount']){
                    redirect_with_msg('sale_quotations/edit_quotation/'.$q_id, 'Please fill payment conditions');
                 }
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
                 if(!empty($postData['b_cash_condition'])){
                    $insertPaymentCondition['b_cash_condition']=$postData['b_cash_condition'];
                }
             }else{
                 $insertPaymentCondition['b_cash']='';
                 $insertPaymentCondition['b_cash_tenor']='';
                 $insertPaymentCondition['b_cash_percent']='';
                 $insertPaymentCondition['b_cash_amount']='';
                 $insertPaymentCondition['b_cash_condition']='';
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
                 if(!empty($postData['b_bg_condition'])){
                        $insertPaymentCondition['b_bg_condition']=$postData['b_bg_condition'];
                }
             }else{
                 $insertPaymentCondition['b_bg']='';
                 $insertPaymentCondition['b_bg_tenor']='';
                 $insertPaymentCondition['b_bg_percent']='';
                 $insertPaymentCondition['b_bg_amount']='';
                 $insertPaymentCondition['b_bg_condition']='';
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
                 if(!empty($postData['b_lc_condition'])){
                        $insertPaymentCondition['b_lc_condition']=$postData['b_lc_condition'];
                  }
             }else{
                 $insertPaymentCondition['b_lc']='';
                 $insertPaymentCondition['b_lc_tenor']='';
                 $insertPaymentCondition['b_lc_percent']='';
                 $insertPaymentCondition['b_lc_amount']='';
                 $insertPaymentCondition['b_lc_condition']='';
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
                 if(!empty($postData['b_pdc_condition'])){
                        $insertPaymentCondition['b_pdc_condition']=$postData['b_pdc_condition'];
                 }
             }else{
                 $insertPaymentCondition['b_pdc']='';
                 $insertPaymentCondition['b_pdc_check']='';
                 $insertPaymentCondition['b_pdc_percent']='';
                 $insertPaymentCondition['b_pdc_amount']='';
                 $insertPaymentCondition['b_pdc_condition']='';
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
             
             
             
             $result=$this->m_common->update_row('tbl_sales_quotation',array('q_id'=>$q_id),$insertData);
             if($result>=0){
                 $this->m_common->update_row('tbl_sales_quotation_payment_condition',array('q_id'=>$q_id),$insertPaymentCondition);
                 $this->m_common->delete_row('tbl_sales_quotation_details',array('q_id'=>$q_id));
                 $this->m_common->delete_row('tbl_sales_quotation_material_specification',array('q_id'=>$q_id));
                 foreach ($postData['product_id'] as $key => $each) {
                     
                      $insertData1=array();
                      $insertData1['q_id'] = $q_id;
                      $insertData1['product_id'] = $each;
                      $insertData1['is_active']=1;
                      if(empty($each)){
                          continue;
                      }
                      if(!empty($postData['product_cost_id'][$key])) {
                           $insertData1['product_cost_id'] = $postData['product_cost_id'][$key];
                      }
                      if(!empty($postData['quantity'][$key])) {
                           $insertData1['quantity'] = $postData['quantity'][$key];
                       }
                       
                      if(!empty($postData['mu_name'][$key])) {
                           $insertData1['mu_name'] = strtoupper($postData['mu_name'][$key]);
                       }
                       
                       if(isset($postData['base_price'][$key]) && !empty($postData['base_price'][$key])) { 
                            $insertData1['base_price'] = $postData['base_price'][$key];
                       }
                       if(isset($postData['vat'][$key]) && !empty($postData['vat'][$key])) { 
                            $insertData1['vat'] = $postData['vat'][$key];
                       }
                       
                       if(!empty($postData['unit_price'][$key])) { 
                          $insertData1['unit_price'] = $postData['unit_price'][$key];
                       }
                       if(!empty($postData['amount'][$key])) { 
                          $insertData1['amount'] = $postData['amount'][$key];
                       }
                       
                      if(!empty($postData['description'][$key])) { 
                                $insertData1['description'] = $postData['description'][$key];
                     }
                       
                       if(!empty($postData['remark'][$key])) { 
                          $insertData1['remark'] = $postData['remark'][$key];
                       }
                 
                      $this->m_common->insert_row('tbl_sales_quotation_details',$insertData1);
                  }
                   foreach ($postData['material_name'] as $key => $each) {
                      $insertData2=array();
                      $insertData2['q_id'] = $q_id;
                      
                      $insertData2['is_active']=1;
                      if(empty($each)){
                          continue;
                      }
                      if(!empty($postData['material_name'][$key])) {
                           $insertData2['material_name'] = $postData['material_name'][$key];
                       }
                      if(!empty($postData['m_description'][$key])) { 
                          $insertData2['m_description'] = $postData['m_description'][$key];
                      }    
                      $this->m_common->insert_row('tbl_sales_quotation_material_specification',$insertData2);
                  }
                  redirect_with_msg('sale_quotations', 'Successfully Updated');
             }
         }else{
              redirect_with_msg('sale_quotations/add_quotation', 'Please fill the form and submit');
         }
         
     }
     
     function delete_quotation($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('tbl_sales_quotation', array('q_id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                $this->m_common->update_row('tbl_sales_quotation_payment_condition', array('q_id' => $id),array('is_active'=>0));
                $this->m_common->update_row('tbl_sales_quotation_details', array('q_id' => $id),array('is_active'=>0));
                redirect_with_msg('sale_quotations/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('sale_quotations/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('sale_quotations/index', 'Please click on delete button');
        }
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
   
     function item_info(){
        $this->setOutputMode(NORMAL);
        $id=$this->input->post('product_id');
        $product=$this->m_common->get_row_array('tbl_product_quote_price',array('product_id'=>$id,'is_active'=>1),'*');
        if(!empty($product)){
            $data['product_info']=$product;
        }else{
            $data['product_info']='';
        }
        echo json_encode($data);
    } 
    
    function customer_info(){
        $this->setOutputMode(NORMAL);
        $branch_id= $this->session->userdata('companyId');
        $id=$this->input->post('id');
        $category_id=$this->input->post('category_id');
       // $sql='select p.*,sp.product_name,sp.measurement_unit from tbl_product_quote_price p left join tbl_sales_products sp on p.product_id=sp.product_id where p.is_active=1 and p.status="Pending" and  p.customer_id='.$id.' and sp.category_id='.$category_id;
      //  $sql='select p.*,sp.product_name,sp.measurement_unit,pr.project_name,pr.address,pr.contact_person,pr.contact_no from tbl_product_quote_price p left join tbl_sales_products sp on p.product_id=sp.product_id left join tbl_project pr on p.project_id=pr.project_id where p.is_active=1 and p.status="Pending" and  p.customer_id='.$id.' and sp.category_id='.$category_id;
        $sql='select p.*,sp.product_name,sp.measurement_unit,pr.project_name,pr.address,pr.contact_person,pr.contact_no,tspoc.vat from tbl_product_quote_price p
         left join tbl_sales_products sp on p.product_id=sp.product_id 
         left join tbl_project pr on p.project_id=pr.project_id 
         left join tbl_sales_product_other_cost tspoc on p.product_cost_id=tspoc.product_cost_id
         where p.is_active=1 and p.status="Pending" and  p.customer_id='.$id.' and sp.category_id='.$category_id.' and p.unit_id='.$branch_id; //added 29-06-2022
        $data['products']=$this->m_common->customeQuery($sql);
        $data['category']=$this->m_common->get_row_array('tbl_product_categories',array('category_id'=>$category_id,'is_active'=>1),'*');
        $data['quotaion']=$this->m_common->get_row_array('tbl_sales_quotation_code',array('customer_id'=>$id,'unit_id'=>$branch_id),'*','',1,'id','DESC');
        $customer=$this->m_common->get_row_array('tbl_customers',array('id'=>$id,'is_active'=>1),'*');
        if(!empty($customer)){
            $data['customer_info']=$customer;
        }else{
            $data['customer_info']='';
        }
        echo json_encode($data);
    } 
    
    function product_specification(){
        $this->setOutputMode(NORMAL);
        $product_cost_id=$this->input->post('product_cost_id');
        $sql='select spmc.*,i.item_name from tbl_sales_product_material_cost spmc left join items i on spmc.m_id=i.id where spmc.product_cost_id='.$product_cost_id;
        $data['product_specifications']=$this->m_common->customeQuery($sql);
        echo json_encode($data);
    }
   

}




