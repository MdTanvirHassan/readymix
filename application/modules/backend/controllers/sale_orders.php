<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sale_orders extends Site_Controller {

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
        
//        $this->role = checkUserPermission(7, 26, $userData);
//        if ($this->role == false || $this->role == 6) {
//            redirect_with_msg('dashboard/', 'You dont Have permission to access this page');
//        }
        
        $this->load->model("m_common");
        $this->setTemplateFile('template');
        $this->user_id = $this->session->userdata('user_id');
        $this->rank = $this->session->userdata('rank');
        $this->company_id = $this->session->userdata('companyId');
        if (empty($this->company_id)) {
            redirect_with_msg('backend/dashboard', 'Please click on enter here button to see this page');
        }
    }

    function index() {

        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        $user_category= $this->session->userdata('user_category');
        
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_order';
        $this->titlebackend("Sale Orders");
        
//        if($user_type==4){
//            $sql = "select o.*,q.reference_no,c.c_name,c.c_short_name,p.project_name as p_name from tbl_sales_orders o left join tbl_project p on p.project_id=o.project_id  left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on o.customer_id=c.id where o.is_active=1 and o.unit_id=" . $branch_id . ' and created_by='.$user_id.' order by o.sale_order_date desc';
//        }else{
//            $sql = "select o.*,q.reference_no,c.c_name,c.c_short_name,p.project_name as p_name from tbl_sales_orders o left join tbl_project p on p.project_id=o.project_id  left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on o.customer_id=c.id where o.is_active=1 and o.unit_id=" . $branch_id . ' order by o.sale_order_date desc';
//        }
        
//        if($user_type==4){
//            $sql = "select o.*,q.reference_no,c.c_name,c.c_short_name,p.project_name as p_name,tsod.mu_name,tsod.quantity,tsod.unit_price,tpc.category_name from tbl_sales_orders o left join tbl_project p on p.project_id=o.project_id  left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on o.customer_id=c.id left join tbl_sales_order_details tsod on o.o_id=tsod.o_id left join tbl_sales_products tsp on tsod.product_id=tsp.product_id left join tbl_product_categories tpc on tsp.category_id=tpc.category_id  where o.is_active=1 and o.unit_id=" . $branch_id . ' and created_by='.$user_id.' group by o.o_id order by o.sale_order_date desc';
//        }else{
//            $sql = "select o.*,q.reference_no,c.c_name,c.c_short_name,p.project_name as p_name,tsod.mu_name,tsod.quantity,tsod.unit_price,tpc.category_name from tbl_sales_orders o left join tbl_project p on p.project_id=o.project_id  left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on o.customer_id=c.id left join tbl_sales_order_details tsod on o.o_id=tsod.o_id left join tbl_sales_products tsp on tsod.product_id=tsp.product_id left join tbl_product_categories tpc on tsp.category_id=tpc.category_id where o.is_active=1 and o.unit_id=" . $branch_id . ' group by o.o_id order by o.sale_order_date desc';
//        }

        $show_data_info=$this->m_common->get_row_array('tbl_show_data_setting','','*');
        $currentDate=date('Y-m-d');
        $prev_date = date('Y-m-d', strtotime($currentDate .' -'.$show_data_info['0']['day'].' days'));

        
        if($user_category==2){
            $sql = "select o.*,q.reference_no,c.c_name,c.c_short_name,p.project_name as p_name,tsod.mu_name,tsod.quantity,tsod.unit_price,tpc.category_name from tbl_sales_orders o 
            left join tbl_project p on p.project_id=o.project_id  
            left join tbl_sales_quotation q on o.q_id=q.q_id 
            left join tbl_customers c on o.customer_id=c.id 
            left join tbl_sales_order_details tsod on o.o_id=tsod.o_id 
            left join tbl_sales_products tsp on tsod.product_id=tsp.product_id 
            left join tbl_product_categories tpc on tsp.category_id=tpc.category_id 
            where (o.sale_order_date>='$prev_date' and o.sale_order_date<='$currentDate') and  o.is_active=1 and o.unit_id=" . $branch_id . ' and receive_status!="Received" group by o.o_id order by o.sale_order_date desc';
           
        }else{
            if($user_type==4){
                $sql = "select o.*,q.reference_no,c.c_name,c.c_short_name,p.project_name as p_name,tsod.mu_name,tsod.quantity,tsod.unit_price,tpc.category_name from tbl_sales_orders o left join tbl_project p on p.project_id=o.project_id  left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on o.customer_id=c.id left join tbl_sales_order_details tsod on o.o_id=tsod.o_id left join tbl_sales_products tsp on tsod.product_id=tsp.product_id left join tbl_product_categories tpc on tsp.category_id=tpc.category_id  where o.is_active=1 and o.unit_id=" . $branch_id . ' and created_by='.$user_id.' and receive_status!="Received" group by o.o_id order by o.sale_order_date desc';
            }else{
                $sql = "select o.*,q.reference_no,c.c_name,c.c_short_name,p.project_name as p_name,tsod.mu_name,tsod.quantity,tsod.unit_price,tpc.category_name from tbl_sales_orders o left join tbl_project p on p.project_id=o.project_id  left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on o.customer_id=c.id left join tbl_sales_order_details tsod on o.o_id=tsod.o_id left join tbl_sales_products tsp on tsod.product_id=tsp.product_id left join tbl_product_categories tpc on tsp.category_id=tpc.category_id where o.is_active=1 and o.unit_id=" . $branch_id . ' and receive_status!="Received" group by o.o_id order by o.sale_order_date desc';
            }
        }    
        
        
        $data['sale_orders'] = $this->m_common->customeQuery($sql);
        $this->load->view('sale_orders/v_sale_order', $data);
    }
    
    function sales_commission() {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_commission';
        $this->titlebackend("Sale Commission");
        
        
            $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,
            tsid.unit_price,tsid.mu_name,tsp.product_name,sod.o_details_id,sod.commission,sod.com_paid,sod.com_status from tbl_sales_invoice_details as tsid 
            left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id 
            left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id 
            left join tbl_delivery_orders do on  tsi.do_id=do.do_id 
            left join tbl_sales_orders so on do.o_id=so.o_id 
            left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id 
            left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id 
            left join tbl_customers tc on so.customer_id=tc.id where so.unit_id=" . $branch_id . " and tsid.is_active=1 and tsid.amount>0 and sod.commission>0
            group by tsid.inv_id,tsid.s_item_id 
            order by tsi.sale_invoice_date ASC";
    
        
        
        $data['sale_commission'] = $this->m_common->customeQuery($sql);
        $this->load->view('sale_orders/v_sale_commission', $data);
    }
    function commission_payment_hostory($id) {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_commission';
        $this->titlebackend("Sale Commission payment");
        
        $sql = "select * from commission_payment where o_details_id=$id";
        $data['sale_commission'] = $this->m_common->customeQuery($sql);
        $this->load->view('sale_orders/v_sale_commission_payment', $data);
    }
function confirm_commission_payment(){
    $this->setOutputMode(NORMAL);
    $id = $this->input->post('id');
    $amt = $this->input->post('amt');
    $date = date('Y-m-d',strtotime($this->input->post('payment_date')));
    $commission_amount = $this->input->post('commission_amount');
    $this->m_common->insert_row('commission_payment',array('o_details_id'=>$id,'date'=>$date,'amount'=>$amt));
    $this->m_common->customeUpdate("update tbl_sales_order_details set com_paid = com_paid+$amt where o_details_id = $id");
    $paid = $this->m_common->get_row_array('tbl_sales_order_details',array('o_details_id'=>$id),'com_paid');
    if($paid[0]['com_paid']>=$commission_amount){
        $status = 'paid';
    }else{
        $status = 'partial';
    }
    $this->m_common->customeUpdate("update tbl_sales_order_details set com_status = '".$status."' where o_details_id = $id");
    echo 'success';

}
function update_confirm_commission_payment(){
    $this->setOutputMode(NORMAL);
    $id = $this->input->post('id');
    $amt = $this->input->post('amt');
    $date = date('Y-m-d',strtotime($this->input->post('payment_date')));
    $exists = $this->m_common->get_row_array('commission_payment', array('id' => $id), '*');
    $this->m_common->update_row('commission_payment',array('id'=>$id),array('date'=>$date,'amount'=>$amt));
    $diff_amt = $exists[0]['amount']-$amt;
    $this->m_common->customeUpdate("update tbl_sales_order_details set com_paid = com_paid+$diff_amt where o_details_id =".$exists[0]['o_details_id']);
    redirect_with_msg('sale_orders/commission_payment_hostory/'.$exists[0]['o_details_id'], 'Successfully Updated');

}


function delete_commission_payment_hostory($id) {
    if (!empty($id)) {
        $exists = $this->m_common->get_row_array('commission_payment', array('id' => $id), '*');
        $this->m_common->customeUpdate("update tbl_sales_order_details set com_paid = com_paid-".$exists[0]['amount']." where o_details_id = ".$exists[0]['o_details_id']."");
         $this->m_common->delete_row('commission_payment', array('id' => $id));
         $paid = $this->m_common->get_row_array('tbl_sales_order_details',array('o_details_id'=>$id),'com_paid');
         if($paid[0]['com_paid']>=$exists[0]['amount']){
             $status = 'paid';
         }else{
             $status = 'partial';
         }
         $this->m_common->customeUpdate("update tbl_sales_order_details set com_status = '".$status."' where o_details_id = ".$exists[0]['o_details_id']);
         redirect_with_msg('sale_orders/commission_payment_hostory/'.$exists[0]['o_details_id'], 'Successfully Deleted');
    } else {
        redirect_with_msg('sale_orders/sales_commission', 'Please click on delete button');
    }
}
function view_commission_payment_hostory($id) {
    $this->setOutputMode(NORMAL);
    if (!empty($id)) {
        $sql = "select cp.id,cp.date,sod.*,cp.amount,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,so.created_date as sale_order_date
        from commission_payment cp
        left join tbl_sales_order_details sod on sod.o_details_id=cp.o_details_id
        left join tbl_sales_orders so on sod.o_id=so.o_id

        left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id 
        left join tbl_customers tc on so.customer_id=tc.id where cp.id=$id
        group by so.o_id,sod.product_id 
        order by cp.date ASC";

        $data['sale_commission'] = $this->m_common->customeQuery($sql);
       // echo '<pre>';print_r($data['sale_commission']);exit;
        $this->load->view('sale_orders/print_sales_commission_payment', $data);
    } else {
        redirect_with_msg('sale_orders/sales_commission', 'Please click on delete button');
    }
}

    function add_sale_order(){
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_order';
        $this->titlebackend("Quotation Information");
        // $data['items']=$this->m_common->get_row_array('tbl_sales_items','','*');
        $sql = "select q.*,c.c_name,c.c_short_name from tbl_sales_quotation q left join tbl_customers c on q.customer_id=c.id where q.is_active=1 and q.status='Pending' and q.unit_id=" . $branch_id;
        //$sql="select q.*,c.c_name,c.c_short_name from tbl_sales_quotation q left join tbl_customers c on q.customer_id=c.id where q.is_active=1 and q.unit_id=".$branch_id;
        $data['quotations'] = $this->m_common->customeQuery($sql);
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*');
        $data['employees'] = $this->m_common->get_row_array('employees','', '*');
        $sql = "select sp.* from tbl_mixing_products mp join tbl_sales_products sp on mp.product_id=sp.product_id where mp.is_active=1";
        $data['products'] = $this->m_common->customeQuery($sql);
        $this->load->view('sale_orders/v_add_sale_order', $data);
    }

    function add_sale_order_action() {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        $postData = $this->input->post();
        if (!empty($postData)){
            $insertData = array();
            $insertPaymentCondition = array();
            if (!empty($postData['q_id'])) {
                $insertData['q_id'] = $postData['q_id'];
                $q_id = $postData['q_id'];
            }

            if (!empty($postData['c_order_no'])) {
                $insertData['c_order_no'] = $postData['c_order_no'];
            }

            if(!empty($postData['order_no'])){
                if($user_type==4){
                    $insertData['order_no'] ="Factory/".$postData['order_no'];                 
                }else{
                   $insertData['order_no'] = $postData['order_no']; 
                }
                
                $pre_order_info=$this->m_common->get_row_array('tbl_sales_orders',array('order_no'=>$postData['order_no'],'is_active'=>1),'*');
                if(!empty($pre_order_info)){
                    redirect_with_msg('sale_orders', 'This order already exists');
                }
            }
            if (!empty($postData['sale_order_date'])) {
                $insertData['sale_order_date'] = date('Y-m-d', strtotime($postData['sale_order_date']));
            }

            if (!empty($postData['delivery_date'])) {
                $insertData['delivery_date'] = date('Y-m-d', strtotime($postData['delivery_date']));
            }

            if (!empty($postData['delivery_time'])) {
                $insertData['delivery_time'] = $postData['delivery_time'];
            }

            if (!empty($postData['attention'])) {
                $insertData['attention'] = $postData['attention'];
            }
            if (!empty($postData['phone'])) {
                $insertData['phone'] = $postData['phone'];
            }

            if (!empty($postData['contact_person'])) {
                $insertData['contact_person'] = $postData['contact_person'];
            }
            if (!empty($postData['contact_no'])) {
                $insertData['contact_no'] = $postData['contact_no'];
            }

//             if(!empty($postData['project_name'])){
//                // $insertData['project_id']=$postData['project_id'];
//                 $insertData['project_id']=$postData['project_name'];
//             }
            if (!empty($postData['project_name'])) {
                $insertData['project_id'] = $postData['project_name'];
                $p = $this->m_common->get_row_array('tbl_project', array('project_id' => $insertData['project_id']), 'project_name');
                $insertData['project_name'] = !empty($p) ? $p[0]['project_name'] : '';
            }
            if (!empty($postData['billing_address'])) {
                $insertData['billing_address'] = $postData['billing_address'];
            }
            if (!empty($postData['billing_email'])) {
                $insertData['billing_email'] = $postData['billing_email'];
            }
            if (!empty($postData['shipping_address'])) {
                $insertData['shipping_address'] = $postData['shipping_address'];
            }
            if (!empty($postData['shipping_email'])) {
                $insertData['shipping_email'] = $postData['shipping_email'];
            }

            if (!empty($postData['special_note'])) {
                $insertData['special_note'] = $postData['special_note'];
            }

            if (!empty($postData['total_amount'])) {
                $insertData['total_amount'] = $postData['total_amount'];
            }else{
                $insertData['total_amount'] =0;
            }
            if (!empty($postData['pump'])) {
                $insertData['pump'] = $postData['pump'];
            }
            

            if (empty($postData['b_cash']) && empty($postData['a_cash']) && empty($postData['b_bg']) && empty($postData['a_bg']) && empty($postData['b_lc']) && empty($postData['a_lc']) && empty($postData['b_pdc']) && empty($postData['a_pdc'])) {
                redirect_with_msg('sale_orders/add_sale_order', 'Please fill payment conditions');
            }
            if (empty($postData['b_cash_percent']) && empty($postData['a_cash_percent']) && empty($postData['b_bg_percent']) && empty($postData['a_bg_percent']) && empty($postData['b_lc_percent']) && empty($postData['a_lc_percent']) && empty($postData['b_pdc_percent']) && empty($postData['a_pdc_percent'])) {
                redirect_with_msg('sale_orders/add_sale_order', 'Please fill payment conditions');
            }
            $total_percent = $postData['b_cash_percent'] + $postData['a_cash_percent'] + $postData['b_bg_percent'] + $postData['a_bg_percent'] + $postData['b_lc_percent'] + $postData['a_lc_percent'] + $postData['b_pdc_percent'] + $postData['a_pdc_percent'];
            $total_amount = $postData['b_cash_amount'] + $postData['a_cash_amount'] + $postData['b_bg_amount'] + $postData['a_bg_amount'] + $postData['b_lc_amount'] + $postData['a_lc_amount'] + $postData['b_pdc_amount'] + $postData['a_pdc_amount'];
            if ($total_percent < 100) {
                if ($total_amount != $postData['total_amount']) {
                    redirect_with_msg('sale_orders/add_sale_order', 'Please fulfil payment conditions');
                }
            } else if ($total_percent > 100) {
                redirect_with_msg('sale_orders/add_sale_order', 'Percentage of payment condition should not more than 100');
            }
            if (!empty($postData['b_cash'])) {
                $insertPaymentCondition['b_cash'] = $postData['b_cash'];
                if (!empty($postData['b_cash_tenor'])) {
                    $insertPaymentCondition['b_cash_tenor'] = $postData['b_cash_tenor'];
                }
                if (!empty($postData['b_cash_percent'])) {
                    $insertPaymentCondition['b_cash_percent'] = $postData['b_cash_percent'];
                }
                if (!empty($postData['b_cash_amount'])) {
                    $insertPaymentCondition['b_cash_amount'] = $postData['b_cash_amount'];
                }
                if (!empty($postData['b_cash_condition'])) {
                    $insertPaymentCondition['b_cash_condition'] = $postData['b_cash_condition'];
                }
            }



            if (!empty($postData['a_cash'])) {
                $insertPaymentCondition['a_cash'] = $postData['a_cash'];
                if (!empty($postData['a_cash_tenor'])) {
                    $insertPaymentCondition['a_cash_tenor'] = $postData['a_cash_tenor'];
                }
                if (!empty($postData['a_cash_percent'])) {
                    $insertPaymentCondition['a_cash_percent'] = $postData['a_cash_percent'];
                }
                if (!empty($postData['a_cash_amount'])) {
                    $insertPaymentCondition['a_cash_amount'] = $postData['a_cash_amount'];
                }
            }


            if (!empty($postData['b_bg'])) {
                $insertPaymentCondition['b_bg'] = $postData['b_bg'];
                if (!empty($postData['b_bg_tenor'])) {
                    $insertPaymentCondition['b_bg_tenor'] = $postData['b_bg_tenor'];
                }
                if (!empty($postData['b_bg_percent'])) {
                    $insertPaymentCondition['b_bg_percent'] = $postData['b_bg_percent'];
                }
                if (!empty($postData['b_bg_amount'])) {
                    $insertPaymentCondition['b_bg_amount'] = $postData['b_bg_amount'];
                }
                if (!empty($postData['b_bg_condition'])) {
                    $insertPaymentCondition['b_bg_condition'] = $postData['b_bg_condition'];
                }
            }

            if (!empty($postData['a_bg'])) {
                $insertPaymentCondition['a_bg'] = $postData['a_bg'];
                if (!empty($postData['a_bg_tenor'])) {
                    $insertPaymentCondition['a_bg_tenor'] = $postData['a_bg_tenor'];
                }
                if (!empty($postData['a_bg_percent'])) {
                    $insertPaymentCondition['a_bg_percent'] = $postData['a_bg_percent'];
                }
                if (!empty($postData['a_bg_amount'])) {
                    $insertPaymentCondition['a_bg_amount'] = $postData['a_bg_amount'];
                }
            }

            if (!empty($postData['b_lc'])) {
                $insertPaymentCondition['b_lc'] = $postData['b_lc'];
                if (!empty($postData['b_lc_tenor'])) {
                    $insertPaymentCondition['b_lc_tenor'] = $postData['b_lc_tenor'];
                }
                if (!empty($postData['b_lc_percent'])) {
                    $insertPaymentCondition['b_lc_percent'] = $postData['b_lc_percent'];
                }
                if (!empty($postData['b_lc_amount'])) {
                    $insertPaymentCondition['b_lc_amount'] = $postData['b_lc_amount'];
                }
                if (!empty($postData['b_lc_condition'])) {
                    $insertPaymentCondition['b_lc_condition'] = $postData['b_lc_condition'];
                }
            }


            if (!empty($postData['a_lc'])) {
                $insertPaymentCondition['a_lc'] = $postData['a_lc'];
                if (!empty($postData['a_lc_tenor'])) {
                    $insertPaymentCondition['a_lc_tenor'] = $postData['a_lc_tenor'];
                }
                if (!empty($postData['a_lc_percent'])) {
                    $insertPaymentCondition['a_lc_percent'] = $postData['a_lc_percent'];
                }
                if (!empty($postData['a_lc_amount'])) {
                    $insertPaymentCondition['a_lc_amount'] = $postData['a_lc_amount'];
                }
            }

            if (!empty($postData['b_pdc'])) {
                $insertPaymentCondition['b_pdc'] = $postData['b_pdc'];
                if (!empty($postData['b_pdc_check'])) {
                    $insertPaymentCondition['b_pdc_check'] = $postData['b_pdc_check'];
                }
                if (!empty($postData['b_pdc_percent'])) {
                    $insertPaymentCondition['b_pdc_percent'] = $postData['b_pdc_percent'];
                }
                if (!empty($postData['b_pdc_amount'])) {
                    $insertPaymentCondition['b_pdc_amount'] = $postData['b_pdc_amount'];
                }
                if (!empty($postData['b_pdc_condition'])) {
                    $insertPaymentCondition['b_pdc_condition'] = $postData['b_pdc_condition'];
                }
            }


            if (!empty($postData['a_pdc'])) {
                $insertPaymentCondition['a_pdc'] = $postData['a_pdc'];
                if (!empty($postData['a_pdc_check'])) {
                    $insertPaymentCondition['a_pdc_check'] = $postData['a_pdc_check'];
                }
                if (!empty($postData['a_pdc_percent'])) {
                    $insertPaymentCondition['a_pdc_percent'] = $postData['a_pdc_percent'];
                }
                if (!empty($postData['a_pdc_amount'])) {
                    $insertPaymentCondition['a_pdc_amount'] = $postData['a_pdc_amount'];
                }
            }

            $before_amount = $postData['b_cash_amount'] + $postData['b_lc_amount'] + $postData['b_pdc_amount'] + $postData['b_bg_amount'];
            if (empty($before_amount)) {
                $insertData['status'] = 'Approved';
            } else {
                $insertData['status'] = 'Pending';
            }
            
            if (!empty($postData['sale_person_id'])) {
                $insertData['sale_person_id'] = $postData['sale_person_id'];
            }
            
            $insertData['unit_id'] = $branch_id;
            $insertData['is_active'] = 1;
            $insertData['created_by'] = $user_id;
            $insertData['created_date'] = date('Y-m-d');
            $insertData['customer_id'] = $postData['c_id'];
            $insertData['receive_status'] ='Pending';
            $insertData['delivery_order_status'] ='Pending';
            if($user_type==4){
              $insertData['created_from']="Factory";  
            }else{
              $insertData['created_from']="Head Office";   
            }
            $result = $this->m_common->insert_row('tbl_sales_orders', $insertData);
            if (!empty($result)) {
                $insertPaymentCondition['is_active'] = 1;
                $insertPaymentCondition['o_id'] = $result;
                $this->m_common->insert_row('tbl_sales_order_code', array('o_code' => $postData['o_code'], 'customer_id' => $postData['customer_id'], 'unit_id' => $branch_id));
                $this->m_common->insert_row('tbl_sales_order_payment_condition', $insertPaymentCondition);
                if (!empty($q_id))
                    $this->m_common->update_row('tbl_sales_quotation', array('q_id' => $q_id), array('status' => "Generated Sales Order"));
                foreach ($postData['product_id'] as $key => $each) {
                    $insertData1 = array();
                    $insertData1['o_id'] = $result;
                    $insertData1['product_id'] = $each;
                    $insertData1['do_status'] = "Pending";
                    $insertData1['is_active'] = 1;
                    if (empty($each)) {
                        continue;
                    }
                    if (!empty($postData['quantity'][$key])) {
                        $insertData1['quantity'] = $postData['quantity'][$key];
                    }
                    if (!empty($postData['commission'][$key])) {
                        $insertData1['commission'] = $postData['commission'][$key];
                    }
                    
                    if(isset($postData['base_price'][$key]) && !empty($postData['base_price'][$key])) { 
                        $insertData1['base_price'] = $postData['base_price'][$key];
                    }
                    if(isset($postData['vat'][$key]) && !empty($postData['vat'][$key])) { 
                        $insertData1['vat'] = $postData['vat'][$key];
                    }
                    
                    if (!empty($postData['unit_price'][$key])) {
                        $insertData1['unit_price'] = $postData['unit_price'][$key];
                    }

                    if (!empty($postData['mu_name'][$key])) {
                        $insertData1['mu_name'] = strtoupper($postData['mu_name'][$key]);
                    }

                    if (!empty($postData['amount'][$key])) {
                        $insertData1['amount'] = $postData['amount'][$key];
                    }
                    if (!empty($postData['description'][$key])) {
                        $insertData1['description'] = $postData['description'][$key];
                    }

                    if (!empty($postData['remark'][$key])) {
                        $insertData1['remark'] = $postData['remark'][$key];
                    }

                    $this->m_common->insert_row('tbl_sales_order_details', $insertData1);
                }

                foreach ($postData['material_name'] as $key => $each) {
                    $insertData2 = array();
                    $insertData2['o_id'] = $result;

                    $insertData2['is_active'] = 1;
                    if (empty($each)) {
                        continue;
                    }
                    if (!empty($postData['material_name'][$key])) {
                        $insertData2['material_name'] = $postData['material_name'][$key];
                    }
                    if (!empty($postData['m_description'][$key])) {
                        $insertData2['m_description'] = $postData['m_description'][$key];
                    }
                    $this->m_common->insert_row('tbl_sales_order_material_specification', $insertData2);
                }

                redirect_with_msg('sale_orders', 'Successfully Inserted');
            }
        } else {
            redirect_with_msg('sale_orders/add_sale_order', 'Please fill the form and submit');
        }
    }

    function edit_sale_order($id) {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_order';
        $this->titlebackend("Order Information");
        //$sql="select q.*,c.c_name,c.c_short_name from tbl_sales_quotation q left join tbl_customers c on q.customer_id=c.id where q.is_active=1";

        $data['sale_order_info'] = $this->m_common->get_row_array('tbl_sales_orders', array('o_id' => $id), '*');
        $data['payment_info'] = $this->m_common->get_row_array('tbl_sales_order_payment_condition', array('o_id' => $id), '*');
        $sql = "select d.*,sp.product_name,sp.measurement_unit from tbl_sales_order_details d left join tbl_sales_products sp on d.product_id=sp.product_id where d.is_active=1 and d.o_id=" . $id;
        $data['sale_order_details_info'] = $this->m_common->customeQuery($sql);
        $data['raw_material_specification'] = $this->m_common->get_row_array('tbl_sales_order_material_specification', array('o_id' => $id, 'is_active' => 1), '*');
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*');
        $data['employees'] = $this->m_common->get_row_array('employees','', '*');
        $sql = "select sp.* from tbl_mixing_products mp join tbl_sales_products sp on mp.product_id=sp.product_id where mp.is_active=1";
        $data['products'] = $this->m_common->customeQuery($sql);
        $data['projects'] = $this->m_common->get_row_array('tbl_project', array('customer_id' => $data['sale_order_info'][0]['customer_id']), '*', '', '', 'project_id', 'DESC');
        $sql = "select q.*,c.c_name,c.c_short_name from tbl_sales_quotation q left join tbl_customers c on q.customer_id=c.id where q.is_active=1 and q.customer_id='" . $data['sale_order_info'][0]['customer_id'] . "' and q.unit_id=" . $branch_id;
        $data['quotations'] = $this->m_common->customeQuery($sql);
        $this->load->view('sale_orders/v_edit_sale_order', $data);
    }

    function edit_sale_order_action($o_id) {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        $postData = $this->input->post();

        if (!empty($postData)) {
            $pre_info = $this->m_common->get_row_array('tbl_sales_orders', array('o_id' => $o_id), '*');
            $insertData = array();
            $insertPaymentCondition = array();
            if (!empty($postData['q_id'])) {
                $insertData['q_id'] = $postData['q_id'];
                $q_id = $postData['q_id'];
            }

            if (!empty($postData['c_order_no'])) {
                $insertData['c_order_no'] = $postData['c_order_no'];
            }
            
            if (!empty($postData['sale_order_date'])) {
                $insertData['sale_order_date'] = date('Y-m-d', strtotime($postData['sale_order_date']));
            }

            if (!empty($postData['delivery_date'])) {
                $insertData['delivery_date'] = date('Y-m-d', strtotime($postData['delivery_date']));
            }

            if (!empty($postData['delivery_time'])) {
                $insertData['delivery_time'] = $postData['delivery_time'];
            }

            if (!empty($postData['attention'])) {
                $insertData['attention'] = $postData['attention'];
            }
            if (!empty($postData['phone'])) {
                $insertData['phone'] = $postData['phone'];
            }

            if (!empty($postData['contact_person'])) {
                $insertData['contact_person'] = $postData['contact_person'];
            }
            if (!empty($postData['contact_no'])) {
                $insertData['contact_no'] = $postData['contact_no'];
            }


//             if(!empty($postData['project_name'])){
//                 $insertData['project_name']=$postData['project_name'];
//             }
            if (!empty($postData['project_name'])) {
                $insertData['project_id'] = $postData['project_name'];
                $p = $this->m_common->get_row_array('tbl_project', array('project_id' => $insertData['project_id']), 'project_name');
                $insertData['project_name'] = !empty($p) ? $p[0]['project_name'] : '';
            }
            if (!empty($postData['billing_address'])) {
                $insertData['billing_address'] = $postData['billing_address'];
            }
            if (!empty($postData['billing_email'])) {
                $insertData['billing_email'] = $postData['billing_email'];
            }
            if (!empty($postData['shipping_address'])) {
                $insertData['shipping_address'] = $postData['shipping_address'];
            }
            if (!empty($postData['shipping_email'])) {
                $insertData['shipping_email'] = $postData['shipping_email'];
            }


            if (!empty($postData['special_note'])) {
                $insertData['special_note'] = $postData['special_note'];
            }

            if (!empty($postData['total_amount'])) {
                $insertData['total_amount'] = $postData['total_amount'];
            }
            if (!empty($postData['pump'])) {
                $insertData['pump'] = $postData['pump'];
            }
            
            if (empty($postData['b_cash']) && empty($postData['a_cash']) && empty($postData['b_bg']) && empty($postData['a_bg']) && empty($postData['b_lc']) && empty($postData['a_lc']) && empty($postData['b_pdc']) && empty($postData['a_pdc'])) {
                redirect_with_msg('sale_orders/edit_sale_order/' . $o_id, 'Please fill payment conditions');
            }
            if (empty($postData['b_cash_percent']) && empty($postData['a_cash_percent']) && empty($postData['b_bg_percent']) && empty($postData['a_bg_percent']) && empty($postData['b_lc_percent']) && empty($postData['a_lc_percent']) && empty($postData['b_pdc_percent']) && empty($postData['a_pdc_percent'])) {
                redirect_with_msg('sale_orders/edit_sale_order/' . $o_id, 'Please fill payment conditions');
            }

            $total_percent = $postData['b_cash_percent'] + $postData['a_cash_percent'] + $postData['b_bg_percent'] + $postData['a_bg_percent'] + $postData['b_lc_percent'] + $postData['a_lc_percent'] + $postData['b_pdc_percent'] + $postData['a_pdc_percent'];
            $total_amount = $postData['b_cash_amount'] + $postData['a_cash_amount'] + $postData['b_bg_amount'] + $postData['a_bg_amount'] + $postData['b_lc_amount'] + $postData['a_lc_amount'] + $postData['b_pdc_amount'] + $postData['a_pdc_amount'];
            if ($total_percent < 100) {
                if ($total_amount != $postData['total_amount']) {
                    redirect_with_msg('sale_orders/edit_sale_order/' . $o_id, 'Please fulfil payment conditions');
                }
            } else if ($total_percent > 100) {
                redirect_with_msg('sale_orders/edit_sale_order/' . $o_id, 'Percentage of payment condition should not more than 100');
            }

            if (!empty($postData['b_cash'])) {
                $insertPaymentCondition['b_cash'] = $postData['b_cash'];
                if (!empty($postData['b_cash_tenor'])) {
                    $insertPaymentCondition['b_cash_tenor'] = $postData['b_cash_tenor'];
                }
                if (!empty($postData['b_cash_percent'])) {
                    $insertPaymentCondition['b_cash_percent'] = $postData['b_cash_percent'];
                }
                if (!empty($postData['b_cash_amount'])) {
                    $insertPaymentCondition['b_cash_amount'] = $postData['b_cash_amount'];
                }
                if (!empty($postData['b_cash_condition'])) {
                    $insertPaymentCondition['b_cash_condition'] = $postData['b_cash_condition'];
                }
            } else {
                $insertPaymentCondition['b_cash'] = '';
                $insertPaymentCondition['b_cash_tenor'] = '';
                $insertPaymentCondition['b_cash_percent'] = '';
                $insertPaymentCondition['b_cash_amount'] = '';
                $insertPaymentCondition['b_cash_condition'] = '';
            }

            if (!empty($postData['a_cash'])) {
                $insertPaymentCondition['a_cash'] = $postData['a_cash'];
                if (!empty($postData['a_cash_tenor'])) {
                    $insertPaymentCondition['a_cash_tenor'] = $postData['a_cash_tenor'];
                }
                if (!empty($postData['a_cash_percent'])) {
                    $insertPaymentCondition['a_cash_percent'] = $postData['a_cash_percent'];
                }
                if (!empty($postData['a_cash_amount'])) {
                    $insertPaymentCondition['a_cash_amount'] = $postData['a_cash_amount'];
                }
            } else {
                $insertPaymentCondition['a_cash'] = '';
                $insertPaymentCondition['a_cash_tenor'] = '';
                $insertPaymentCondition['a_cash_percent'] = '';
                $insertPaymentCondition['a_cash_amount'] = '';
            }


            if (!empty($postData['b_bg'])) {
                $insertPaymentCondition['b_bg'] = $postData['b_bg'];
                if (!empty($postData['b_bg_tenor'])) {
                    $insertPaymentCondition['b_bg_tenor'] = $postData['b_bg_tenor'];
                }
                if (!empty($postData['b_bg_percent'])) {
                    $insertPaymentCondition['b_bg_percent'] = $postData['b_bg_percent'];
                }
                if (!empty($postData['b_bg_amount'])) {
                    $insertPaymentCondition['b_bg_amount'] = $postData['b_bg_amount'];
                }
                if (!empty($postData['b_bg_condition'])) {
                    $insertPaymentCondition['b_bg_condition'] = $postData['b_bg_condition'];
                }
            } else {
                $insertPaymentCondition['b_bg'] = '';
                $insertPaymentCondition['b_bg_tenor'] = '';
                $insertPaymentCondition['b_bg_percent'] = '';
                $insertPaymentCondition['b_bg_amount'] = '';
                $insertPaymentCondition['b_bg_condition'] = '';
            }

            if (!empty($postData['a_bg'])) {
                $insertPaymentCondition['a_bg'] = $postData['a_bg'];
                if (!empty($postData['a_bg_tenor'])) {
                    $insertPaymentCondition['a_bg_tenor'] = $postData['a_bg_tenor'];
                }
                if (!empty($postData['a_bg_percent'])) {
                    $insertPaymentCondition['a_bg_percent'] = $postData['a_bg_percent'];
                }
                if (!empty($postData['a_bg_amount'])) {
                    $insertPaymentCondition['a_bg_amount'] = $postData['a_bg_amount'];
                }
            } else {
                $insertPaymentCondition['a_bg'] = '';
                $insertPaymentCondition['a_bg_tenor'] = '';
                $insertPaymentCondition['a_bg_percent'] = '';
                $insertPaymentCondition['a_bg_amount'] = '';
            }

            if (!empty($postData['b_lc'])) {
                $insertPaymentCondition['b_lc'] = $postData['b_lc'];
                if (!empty($postData['b_lc_tenor'])) {
                    $insertPaymentCondition['b_lc_tenor'] = $postData['b_lc_tenor'];
                }
                if (!empty($postData['b_lc_percent'])) {
                    $insertPaymentCondition['b_lc_percent'] = $postData['b_lc_percent'];
                }
                if (!empty($postData['b_lc_amount'])) {
                    $insertPaymentCondition['b_lc_amount'] = $postData['b_lc_amount'];
                }
                if (!empty($postData['b_lc_condition'])) {
                    $insertPaymentCondition['b_lc_condition'] = $postData['b_lc_condition'];
                }
            } else {
                $insertPaymentCondition['b_lc'] = '';
                $insertPaymentCondition['b_lc_tenor'] = '';
                $insertPaymentCondition['b_lc_percent'] = '';
                $insertPaymentCondition['b_lc_amount'] = '';
                $insertPaymentCondition['b_lc_condition'] = '';
            }

            if (!empty($postData['a_lc'])) {
                $insertPaymentCondition['a_lc'] = $postData['a_lc'];
                if (!empty($postData['a_lc_tenor'])) {
                    $insertPaymentCondition['a_lc_tenor'] = $postData['a_lc_tenor'];
                }
                if (!empty($postData['a_lc_percent'])) {
                    $insertPaymentCondition['a_lc_percent'] = $postData['a_lc_percent'];
                }
                if (!empty($postData['a_lc_amount'])) {
                    $insertPaymentCondition['a_lc_amount'] = $postData['a_lc_amount'];
                }
            } else {
                $insertPaymentCondition['a_lc'] = '';
                $insertPaymentCondition['a_lc_tenor'] = '';
                $insertPaymentCondition['a_lc_percent'] = '';
                $insertPaymentCondition['a_lc_amount'] = '';
            }

            if (!empty($postData['b_pdc'])) {
                $insertPaymentCondition['b_pdc'] = $postData['b_pdc'];
                if (!empty($postData['b_pdc_check'])) {
                    $insertPaymentCondition['b_pdc_check'] = $postData['b_pdc_check'];
                }
                if (!empty($postData['b_pdc_percent'])) {
                    $insertPaymentCondition['b_pdc_percent'] = $postData['b_pdc_percent'];
                }
                if (!empty($postData['b_pdc_amount'])) {
                    $insertPaymentCondition['b_pdc_amount'] = $postData['b_pdc_amount'];
                }
                if (!empty($postData['b_pdc_condition'])) {
                    $insertPaymentCondition['b_pdc_condition'] = $postData['b_pdc_condition'];
                }
            } else {
                $insertPaymentCondition['b_pdc'] = '';
                $insertPaymentCondition['b_pdc_check'] = '';
                $insertPaymentCondition['b_pdc_percent'] = '';
                $insertPaymentCondition['b_pdc_amount'] = '';
                $insertPaymentCondition['b_pdc_condition'] = '';
            }

            if (!empty($postData['a_pdc'])) {
                $insertPaymentCondition['a_pdc'] = $postData['a_pdc'];
                if (!empty($postData['a_pdc_check'])) {
                    $insertPaymentCondition['a_pdc_check'] = $postData['a_pdc_check'];
                }
                if (!empty($postData['a_pdc_percent'])) {
                    $insertPaymentCondition['a_pdc_percent'] = $postData['a_pdc_percent'];
                }
                if (!empty($postData['a_pdc_amount'])) {
                    $insertPaymentCondition['a_pdc_amount'] = $postData['a_pdc_amount'];
                }
            } else {
                $insertPaymentCondition['a_pdc'] = '';
                $insertPaymentCondition['a_pdc_check'] = '';
                $insertPaymentCondition['a_pdc_percent'] = '';
                $insertPaymentCondition['a_pdc_amount'] = '';
            }
            
            if(!empty($postData['sale_person_id'])){
                $insertData['sale_person_id'] = $postData['sale_person_id'];
            }
            
            $insertData['customer_id']=$postData['c_id'];
            $insertData['updated_by'] =$user_id;
            $insertData['updated_date'] =date('Y-m-d H:i:s');
            $result = $this->m_common->update_row('tbl_sales_orders', array('o_id' => $o_id), $insertData);
            if ($result >= 0) {
                $this->m_common->update_row('tbl_sales_order_payment_condition', array('o_id' => $o_id), $insertPaymentCondition);
                if ($pre_info[0]['q_id'] != $q_id) {
                    $this->m_common->update_row('tbl_sales_quotation', array('q_id' => $q_id), array('status' => "Generated Sales Order"));
                    $this->m_common->update_row('tbl_sales_quotation', array('q_id' => $pre_info[0]['q_id']), array('status' => "Pending"));
                }
                $this->m_common->delete_row('tbl_sales_order_details', array('o_id' => $o_id));
                $this->m_common->delete_row('tbl_sales_order_material_specification', array('o_id' => $o_id));
                foreach ($postData['product_id'] as $key => $each) {
                    $insertData1 = array();
                    $insertData1['o_id'] = $o_id;
                    $insertData1['product_id'] = $each;
                    $insertData1['is_active'] = 1;
                    if (empty($each)) {
                        continue;
                    }
                    if (!empty($postData['quantity'][$key])) {
                        $insertData1['quantity'] = $postData['quantity'][$key];
                    }
                    if (!empty($postData['commission'][$key])) {
                        $insertData1['commission'] = $postData['commission'][$key];
                    }
                    
                    if(isset($postData['base_price'][$key]) && !empty($postData['base_price'][$key])) { 
                        $insertData1['base_price'] = $postData['base_price'][$key];
                    }
                    if(isset($postData['vat'][$key]) && !empty($postData['vat'][$key])) { 
                        $insertData1['vat'] = $postData['vat'][$key];
                    }
                    
                    
                    if (!empty($postData['unit_price'][$key])) {
                        $insertData1['unit_price'] = $postData['unit_price'][$key];
                    }

                    if (!empty($postData['mu_name'][$key])) {
                        $insertData1['mu_name'] = strtoupper($postData['mu_name'][$key]);
                    }

                    if (!empty($postData['amount'][$key])) {
                        $insertData1['amount'] = $postData['amount'][$key];
                    }
                    if (!empty($postData['description'][$key])) {
                        $insertData1['description'] = $postData['description'][$key];
                    }

                    if (!empty($postData['remark'][$key])) {
                        $insertData1['remark'] = $postData['remark'][$key];
                    }

                    $this->m_common->insert_row('tbl_sales_order_details', $insertData1);
                }

                foreach ($postData['material_name'] as $key => $each) {
                    $insertData2 = array();
                    $insertData2['o_id'] = $o_id;

                    $insertData2['is_active'] = 1;
                    if (empty($each)) {
                        continue;
                    }
                    if (!empty($postData['material_name'][$key])) {
                        $insertData2['material_name'] = $postData['material_name'][$key];
                    }
                    if (!empty($postData['m_description'][$key])) {
                        $insertData2['m_description'] = $postData['m_description'][$key];
                    }
                    $this->m_common->insert_row('tbl_sales_order_material_specification', $insertData2);
                }
                redirect_with_msg('sale_orders', 'Successfully Updated');
            }
        } else {
            redirect_with_msg('sale_orders/add_sale_order', 'Please fill the form and submit');
        }
    }

    function details_sale_order($id, $print = false) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_order';
        $this->titlebackend("Order Information");
        //$sql="select q.*,c.c_name,c.c_short_name from tbl_sales_quotation q left join tbl_customers c on q.customer_id=c.id where q.is_active=1";
        $sql = "select q.*,c.c_name,c.c_short_name from tbl_sales_quotation q left join tbl_customers c on q.customer_id=c.id where q.is_active=1 and q.unit_id=" . $branch_id;
        $data['quotations'] = $this->m_common->customeQuery($sql);
        //$data['sale_order_info']=$this->m_common->get_row_array('tbl_sales_orders',array('o_id'=>$id),'*');
        $so_sql = "select so.*,c.c_name,c.c_short_name,c.c_contact_person,c.c_mobile_no,q.reference_no,q.quotation_date from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on so.customer_id=c.id where so.o_id=" . $id;
        $data['sale_order_info'] = $this->m_common->customeQuery($so_sql);
        $data['payment_mode'] = $this->m_common->get_row_array('tbl_sales_order_payment_condition', array('o_id' => $id), '*');
        $sql = "select d.*,sp.product_name,sp.measurement_unit,sp.performance from tbl_sales_order_details d left join tbl_sales_products sp on d.product_id=sp.product_id where d.is_active=1 and d.o_id=" . $id;
        $data['sale_order_details_info'] = $this->m_common->customeQuery($sql);
        $data['raw_material_specification'] = $this->m_common->get_row_array('tbl_sales_order_material_specification', array('o_id' => $id, 'is_active' => 1), '*');
        $data['collections'] = $this->m_common->get_row_array('tbl_payment_collections', array('o_id' => $id, 'is_active' => 1), '*');
        $data['employees'] = $this->m_common->get_row_array('employees','', '*');
        if ($print == false) {
            $this->load->view('sale_orders/v_details_sale_order', $data);
        } else {
            $html = $this->load->view('sale_orders/print_sales_order', $data, true);
            echo $html;
            exit;
        }
    }

    function make_archive($id) {
        try {
            if (!empty($id)) {
                $id = $this->m_common->update_row('tbl_sales_orders', array('o_id' => $id), array('is_active' => 2));
                redirect_with_msg('sale_orders/index', 'Successfully Archived');
            } else {
                redirect_with_msg('sale_orders/index', 'There have an error during archiving');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function delete_sale_order($id) {
        if (!empty($id)) {
            $q_id = $this->m_common->get_row_array('tbl_sales_orders', array('o_id' => $id), '*');
            $id = $this->m_common->update_row('tbl_sales_orders', array('o_id' => $id), array('is_active' => 0));
            if (!empty($id)) {
                $this->m_common->update_row('tbl_sales_quotation', array('q_id' => $q_id[0]['q_id']), array('status' => "Pending"));
                $this->m_common->update_row('tbl_sales_quotation_details', array('q_id' => $q_id[0]['q_id']), array('is_active' => "1"));
                $this->m_common->update_row('tbl_sales_order_details', array('o_id' => $id), array('is_active' => 0));
                $this->m_common->update_row('tbl_sales_order_payment_condition', array('o_id' => $id), array('is_active' => 0));
                $this->m_common->update_row('tbl_sales_order_material_specification', array('o_id' => $id), array('is_active' => 0));
                redirect_with_msg('sale_orders/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('sale_orders/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('sale_orders/index', 'Please click on delete button');
        }
    }

    function get_quotation_item() {
        $branch_id = $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $q_id = $this->input->post('q_id');
        $data['quotation_info'] = $this->m_common->get_row_array('tbl_sales_quotation', array('q_id' => $q_id), '*');
        $data['quotation_payment_info'] = $this->m_common->get_row_array('tbl_sales_quotation_payment_condition', array('q_id' => $q_id), '*');
        $data['material_specification'] = $this->m_common->get_row_array('tbl_sales_quotation_material_specification', array('q_id' => $q_id), '*');
        // $sql="select d.*,i.s_item_name from tbl_sales_quotation_details d left join tbl_sales_items i on d.s_item_id=i.s_item_id where d.is_active=1 and d.q_id=".$q_id;
        $sql = "select d.*,sp.product_name,sp.measurement_unit from tbl_sales_quotation_details d left join tbl_sales_products sp on d.product_id=sp.product_id where d.is_active=1 and d.q_id=" . $q_id;
        $data['item_list'] = $this->m_common->customeQuery($sql);
        // $data['order_code']=$this->m_common->get_row_array('tbl_sales_order_code',array('customer_id'=>$data['quotation_info'][0]['customer_id']),'*','',1,'id','DESC');
        $data['order_code'] = $this->m_common->get_row_array('tbl_sales_order_code', array('customer_id' => $data['quotation_info'][0]['customer_id'], 'unit_id' => $branch_id), '*', '', 1, 'id', 'DESC');
        $data['customer_info'] = $this->m_common->get_row_array('tbl_customers', array('id' => $data['quotation_info'][0]['customer_id'], 'is_active' => 1), '*');
        $data['projects'] = $this->m_common->get_row_array('tbl_project', array('customer_id' => $data['quotation_info'][0]['customer_id']), '*', '', '', 'project_id', 'DESC');
        echo json_encode($data);
    }

    function get_customer_details() {
        $branch_id = $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');
        $data['projects'] = $this->m_common->get_row_array('tbl_project', array('customer_id' => $id), '*', '', '', 'project_id', 'DESC');
        $data['order_code'] = $this->m_common->get_row_array('tbl_sales_order_code', array('customer_id' => $id, 'unit_id' => $branch_id), '*', '', 1, 'id', 'DESC');
        $data['customer_info'] = $this->m_common->get_row_array('tbl_customers', array('id' => $id, 'is_active' => 1), '*');
        $data['branch_info'] = $this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        echo json_encode($data);
    }

    function get_item_material() {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');

        $data['item_info'] = $this->m_common->get_row_array('tbl_sales_items', array('s_item_id' => $id), '*');
        $sql = "select tbl_d.*,tbl_m.m_name from tbl_sales_item_details tbl_d left join tbl_materials tbl_m on tbl_d.m_id=tbl_m.m_id where tbl_d.s_item_id=" . $id;
        $data['item_list'] = $this->m_common->customeQuery($sql);


        echo json_encode($data);
    }

    function get_quotation() {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');
        $branch_id = $this->session->userdata('companyId');
        $sql = "select q.*,c.c_name,c.c_short_name from tbl_sales_quotation q left join tbl_customers c on q.customer_id=c.id where q.is_active=1 and q.status='Pending' and c.id=" . $id . " and q.unit_id=" . $branch_id;
        $data = $this->m_common->customeQuery($sql);
        echo '<option class="form-control" value="">Select Quotation</option>';
        foreach ($data as $r) {
            echo '<option value="' . $r['q_id'] . '">(' . $r['project_name'] . ')' . '(' . $r['reference_no'] . ')</option>';
        }
    }

    function get_project_info() {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');
        $branch_id = $this->session->userdata('companyId');
        $sql = "select * from tbl_project where project_id=" . $id;
        $data = $this->m_common->customeQuery($sql);
        echo json_encode(array('project' => $data[0]));
    }

}
