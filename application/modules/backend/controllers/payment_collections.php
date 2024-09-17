<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_collections extends Site_Controller {

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
        if (empty($this->company_id)) {
            redirect_with_msg('backend/dashboard', 'Please click on enter here button to see this page');
        }
    }

    function index() {
        $branch_id = $this->session->userdata('companyId');
        $user_category= $this->session->userdata('user_category');

        $show_data_info=$this->m_common->get_row_array('tbl_show_data_setting','','*');
        $currentDate=date('Y-m-d');
        $prev_date = date('Y-m-d', strtotime($currentDate .' -'.$show_data_info['0']['day'].' days'));

        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_collection';
        $this->titlebackend("Payment Collections");


        $data['bank_branches']=$this->m_common->get_row_array('tbl_bank_branch',array('is_active'=>1),'*');
        $data['banks'] = $this->m_common->get_row_array('tbl_banks', array('is_active' => 1,'b_identification'=>"Self"), '*');


        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories','','*');
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        // $data['quotations']=$this->m_common->get_row_array('tbl_sales_quotation
        // $sql="select pc.*,so.order_no,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_sales_orders so on pc.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where pc.is_active=1";
        $postData = $this->input->post();
        $where = '';
      //  $where = "pc.unit_id=$branch_id";
        $where = "pc.is_active=1";
        if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            $data['date_type']=$date_type=$this->input->post('date_type');
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = '';
                $data['to_date'] = '';
                $f_date = '';
                $to_date = '';
            }
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['collection_method'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }

            if($date_type=="Bank Deposit Date"){    
                if(!empty($f_date) & !empty($to_date)){
                //  $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and pc.is_active=1 and pc.payment_status='Collected' order by pc.id desc";
                   
                    if( $user_category==2){
                        $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                        tpc.category_name,e.name as sales_person 
                        from tbl_payment_collections pc 
                        left join tbl_banks tb on pc.bank_id=tb.id 
                        left join tbl_customers c on pc.customer_id=c.id 
                        left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                        left join employees e on c.sales_person_id=e.id
                        where (pc.bank_deposit_date>='$prev_date' and pc.bank_deposit_date<='$currentDate') and $where and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.bank_deposit_date desc";
                    }else{
                        $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                        tpc.category_name,e.name as sales_person 
                        from tbl_payment_collections pc 
                        left join tbl_banks tb on pc.bank_id=tb.id 
                        left join tbl_customers c on pc.customer_id=c.id 
                        left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                        left join employees e on c.sales_person_id=e.id
                        where $where and pc.bank_deposit_date>='" . $f_date . "' and pc.bank_deposit_date<='" . $to_date . "' and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.bank_deposit_date desc";
                    }

                }else if (!empty($f_date)) {
                //  $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.receive_date>='" . $f_date .  "' and pc.is_active=1 and pc.payment_status='Collected' order by pc.id desc"; 
                    $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                    tpc.category_name,e.name as sales_person 
                    from tbl_payment_collections pc 
                    left join tbl_banks tb on pc.bank_id=tb.id 
                    left join tbl_customers c on pc.customer_id=c.id 
                    left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                    left join employees e on c.sales_person_id=e.id
                    where $where and pc.bank_deposit_date='" . $f_date .  "' and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.bank_deposit_date desc"; 
                }else if (!empty($to_date)) {
                // $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.receive_date<='" . $to_date .  "' and pc.is_active=1 and pc.payment_status='Collected' order by pc.id desc";  
                    $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                    tpc.category_name,e.name as sales_person 
                    from tbl_payment_collections pc 
                    left join tbl_banks tb on pc.bank_id=tb.id 
                    left join tbl_customers c on pc.customer_id=c.id 
                    left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                    left join employees e on c.sales_person_id=e.id
                    where $where and pc.bank_deposit_date='" . $to_date .  "' and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.bank_deposit_date desc";  
                }else{
                // $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.is_active=1 and pc.payment_status='Collected' order by pc.id desc";   
                    if($user_category==2){
                        $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                        tpc.category_name,e.name as sales_person 
                        from tbl_payment_collections pc 
                        left join tbl_banks tb on pc.bank_id=tb.id left join tbl_customers c on pc.customer_id=c.id 
                        left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                        left join employees e on c.sales_person_id=e.id
                        where (pc.bank_deposit_date>='$prev_date' and pc.bank_deposit_date<='$currentDate') and $where and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.bank_deposit_date desc";
                    }else{
                        $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                        tpc.category_name,e.name as sales_person 
                        from tbl_payment_collections pc 
                        left join tbl_banks tb on pc.bank_id=tb.id left join tbl_customers c on pc.customer_id=c.id 
                        left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                        left join employees e on c.sales_person_id=e.id
                        where $where and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.bank_deposit_date desc";
                    }       
                }
            }else if($date_type=="Cheque Date"){    
                    if(!empty($f_date) & !empty($to_date)){
                    //  $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and pc.is_active=1 and pc.payment_status='Collected' order by pc.id desc";
                        if( $user_category==2){    
                            $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                            tpc.category_name,e.name as sales_person 
                            from tbl_payment_collections pc 
                            left join tbl_banks tb on pc.bank_id=tb.id 
                            left join tbl_customers c on pc.customer_id=c.id 
                            left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                            left join employees e on c.sales_person_id=e.id
                            where (pc.check_date>='$prev_date' and pc.check_date<='$currentDate') and $where and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.bank_deposit_date desc";
                        }else{
                            $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                            tpc.category_name,e.name as sales_person 
                            from tbl_payment_collections pc 
                            left join tbl_banks tb on pc.bank_id=tb.id 
                            left join tbl_customers c on pc.customer_id=c.id 
                            left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                            left join employees e on c.sales_person_id=e.id
                            where $where and pc.check_date>='" . $f_date . "' and pc.check_date<='" . $to_date . "' and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.bank_deposit_date desc";
                        }    

                    }else if (!empty($f_date)) {
                    //  $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.receive_date>='" . $f_date .  "' and pc.is_active=1 and pc.payment_status='Collected' order by pc.id desc"; 
                        $sql = "select pc.*,c.c_name,c_short_name,
                        tpc.category_name,e.name as sales_person 
                        from tbl_payment_collections pc 
                        left join tbl_banks tb on pc.bank_id=tb.id 
                        left join tbl_customers c on pc.customer_id=c.id 
                        left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                        left join employees e on c.sales_person_id=e.id
                        where $where and pc.check_date='" . $f_date .  "' and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.bank_deposit_date desc"; 
                    }else if (!empty($to_date)) {
                    // $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.receive_date<='" . $to_date .  "' and pc.is_active=1 and pc.payment_status='Collected' order by pc.id desc";  
                        $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                        tpc.category_name,e.name as sales_person 
                        from tbl_payment_collections pc 
                        left join tbl_banks tb on pc.bank_id=tb.id 
                        left join tbl_customers c on pc.customer_id=c.id 
                        left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                        left join employees e on c.sales_person_id=e.id
                        where $where and pc.check_date='" . $to_date .  "' and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.bank_deposit_date desc";  
                    }else{
                    // $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.is_active=1 and pc.payment_status='Collected' order by pc.id desc";  
                        if( $user_category==2){  
                            $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                            tpc.category_name,e.name as sales_person 
                            from tbl_payment_collections pc 
                            left join tbl_banks tb on pc.bank_id=tb.id 
                            left join tbl_customers c on pc.customer_id=c.id 
                            left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id
                            left join employees e on c.sales_person_id=e.id 
                            where (pc.check_date>='$prev_date' and pc.check_date<='$currentDate') and $where and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.bank_deposit_date desc";   
                        }else{
                            $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                            tpc.category_name,e.name as sales_person 
                            from tbl_payment_collections pc 
                            left join tbl_banks tb on pc.bank_id=tb.id 
                            left join tbl_customers c on pc.customer_id=c.id 
                            left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id
                            left join employees e on c.sales_person_id=e.id 
                            where $where and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.bank_deposit_date desc";
                        }
                    }
            }else{
                if(!empty($f_date) & !empty($to_date)){
                    //  $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and pc.is_active=1 and pc.payment_status='Collected' order by pc.id desc";
                        if( $user_category==2){ 
                            $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                            tpc.category_name,e.name as sales_person 
                            from tbl_payment_collections pc 
                            left join tbl_banks tb on pc.bank_id=tb.id 
                            left join tbl_customers c on pc.customer_id=c.id 
                            left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                            left join employees e on c.sales_person_id=e.id
                            where (pc.receive_date>='$prev_date' and pc.receive_date<='$currentDate') and $where and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.receive_date desc";
                        }else{
                            $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                            tpc.category_name,e.name as sales_person 
                            from tbl_payment_collections pc 
                            left join tbl_banks tb on pc.bank_id=tb.id 
                            left join tbl_customers c on pc.customer_id=c.id 
                            left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                            left join employees e on c.sales_person_id=e.id
                            where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.receive_date desc";

                        }
                    }else if (!empty($f_date)) {
                    //  $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.receive_date>='" . $f_date .  "' and pc.is_active=1 and pc.payment_status='Collected' order by pc.id desc"; 
                        $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                        tpc.category_name,e.name as sales_person 
                        from tbl_payment_collections pc 
                        left join tbl_banks tb on pc.bank_id=tb.id 
                        left join tbl_customers c on pc.customer_id=c.id 
                        left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                        left join employees e on c.sales_person_id=e.id
                        where $where and pc.receive_date='" . $f_date .  "' and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.receive_date desc"; 
                    }else if (!empty($to_date)) {
                    // $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.receive_date<='" . $to_date .  "' and pc.is_active=1 and pc.payment_status='Collected' order by pc.id desc";  
                        $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                        tpc.category_name,e.name as sales_person 
                        from tbl_payment_collections pc 
                        left join tbl_banks tb on pc.bank_id=tb.id 
                        left join tbl_customers c on pc.customer_id=c.id 
                        left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id
                        left join employees e on c.sales_person_id=e.id 
                        where $where and pc.receive_date='" . $to_date .  "' and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.receive_date desc";  
                    }else{
                    // $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.is_active=1 and pc.payment_status='Collected' order by pc.id desc";   
                        if( $user_category==2){ 
                            $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                            tpc.category_name,e.name as sales_person 
                            from tbl_payment_collections pc 
                            left join tbl_banks tb on pc.bank_id=tb.id 
                            left join tbl_customers c on pc.customer_id=c.id 
                            left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                            left join employees e on c.sales_person_id=e.id
                            where (pc.receive_date>='$prev_date' and pc.receive_date<='$currentDate') and $where and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.receive_date desc";
                        }else{
                            $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                            tpc.category_name,e.name as sales_person 
                            from tbl_payment_collections pc 
                            left join tbl_banks tb on pc.bank_id=tb.id 
                            left join tbl_customers c on pc.customer_id=c.id 
                            left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                            left join employees e on c.sales_person_id=e.id
                            where $where and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.receive_date desc";

                        }   
                    }
            }       
        }else{
         //   $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.is_active=1 and pc.payment_status='Collected' and pc.unit_id=" . $branch_id . ' order by pc.id desc';
            if( $user_category==2){
                $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                tpc.category_name,e.name as sales_person 
                from tbl_payment_collections pc 
                left join tbl_banks tb on pc.bank_id=tb.id 
                left join tbl_customers c on pc.customer_id=c.id 
                left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                left join employees e on c.sales_person_id=e.id
                where (pc.receive_date>='$prev_date' and pc.receive_date<='$currentDate') and pc.is_active=1 and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.receive_date desc";
            }else{
                $sql = "select pc.*,tb.b_name,c.c_name,c_short_name,
                tpc.category_name,e.name as sales_person 
                from tbl_payment_collections pc 
                left join tbl_banks tb on pc.bank_id=tb.id 
                left join tbl_customers c on pc.customer_id=c.id 
                left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                left join employees e on c.sales_person_id=e.id
                where pc.is_active=1 and (pc.payment_status='Collected' || pc.payment_status='Dishonored') order by pc.receive_date desc";
            }
            $data['f_date'] = $from_date = '';
            $data['to_date'] = $too_date = '';
            $data['date_type']="Receive Date";
        }
        $data['collections'] = $this->m_common->customeQuery($sql);
        $this->load->view('payment_collections/v_payment_collection', $data);
    }

    function add_collection() {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_collection';
        $this->titlebackend("Payment Collections");
        $data['banks'] = $this->m_common->get_row_array('tbl_banks', array('is_active' => 1,'b_identification'=>"Customer"), '*');
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*','','','c_name','asc');
        $data['bank_branches']=$this->m_common->get_row_array('tbl_bank_branch',array('is_active'=>1),'*');
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories',array('is_active'=>1),'*');
        // $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.receive_status!='Received' ";
        $sql = "select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.receive_status!='Received' and so.unit_id=" . $branch_id;
        $data['sale_orders'] = $this->m_common->customeQuery($sql);
        // $this->load->view('payment_collections/v_add_collection',$data);
        $this->load->view('payment_collections/v_add_collection_new', $data);
    }

    function new_add_collection() {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_collection';
        $this->titlebackend("Payment Collections");
        $data['banks'] = $this->m_common->get_row_array('tbl_banks', array('is_active' => 1,'b_identification'=>"Customer"), '*');
        // $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.receive_status!='Received' ";
        $sql = "select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.receive_status!='Received' and so.unit_id=" . $branch_id;
        $data['sale_orders'] = $this->m_common->customeQuery($sql);
        $this->load->view('payment_collections/v_add_collection_new', $data);
    }

    function add_collection_action() {
        try {
            $this->db->trans_start();
            $branch_id = $this->session->userdata('companyId');
            $postData = $this->input->post();
            if (!empty($postData)) {
                if (!empty($postData['from_deposit'])) {
                    $customer = $this->m_common->get_row_array('tbl_customers', array('id' => $postData['c_id']), '*');
                    $this->m_common->update_row('tbl_customers', array('id' => $postData['c_id']), array('deposit' => 0));
                    $balance = $postData['amount'] + $customer[0]['deposit'];
                } else
                    $balance = $postData['amount'];
                $main_id = $this->m_common->insert_row('tbl_payment_collection_main', array('customer_id' => $postData['c_id'], 'amount' => $balance, 'date' => date('Y-m-d', strtotime($postData['receive_date']))));
                //  foreach ($postData['o_id'] as $o_id){
                if ($balance <= 0) {
                    redirect_with_msg('payment_collections/add_collection', 'Please Fill the form');
                }
                $insertData = array();

                if (!empty($main_id)) {
                    $insertData['main_id'] = $main_id;
                } else {
                    redirect_with_msg('payment_collections/add_collection', 'Please Fill the form');
                }

                $insertData['amount'] = $balance;

                if (!empty($postData['receive_date'])) {
                    $insertData['receive_date'] = date('Y-m-d', strtotime($postData['receive_date']));
                }

                if (!empty($postData['collection_method'])) {
                    $insertData['collection_method'] = $postData['collection_method'];
                }
                if($postData['collection_method'] == "Cash"){
                    $pre_collection = $this->m_common->get_row_array('tbl_payment_collections', array('mrr_no' => $postData['mrr_no'],'is_active'=>1), '*');
                    if (!empty($pre_collection)) {
                        redirect_with_msg('payment_collections/add_collection', 'Already This payment collected');
                    }
                    $insertData['collection_condition'] = "Collection";
                }else if ($postData['collection_method'] == "O.Cash"){
                    $pre_collection = $this->m_common->get_row_array('tbl_payment_collections', array('mrr_no' => $postData['mrr_no'],'is_active'=>1), '*');
                    if (!empty($pre_collection)) {
                        redirect_with_msg('payment_collections/add_collection', 'Already This payment collected');
                    }
                    $insertData['collection_condition'] = "Collection";
                    $insertData['ac_no'] = $postData['ac_no'];
                   // $insertData['no'] = $postData['ac_no'];
                    
                }else if ($postData['collection_method'] == "Pdc") {

                    $insertData['collection_condition'] = "Collection";
                    if (!empty($postData['check_no'])) {
                        $insertData['check_no'] = $postData['check_no'];
                        $insertData['no'] = $postData['check_no'];
                    }
                    if (!empty($postData['check_date'])) {
                        $insertData['check_date'] = date('Y-m-d', strtotime($postData['check_date']));
                        $insertData['bank_deposit_date'] = date('Y-m-d', strtotime($postData['check_date']));
                    }

                    $pre_collection = $this->m_common->get_row_array('tbl_payment_collections', array('no' => $postData['check_no'],'is_active'=>1), '*');
                    if (!empty($pre_collection)) {
                        redirect_with_msg('payment_collections/add_collection', 'Already This cheque  collected');
                    }
                } else if ($postData['collection_method'] == "Po") {
                    if (!empty($postData['po_no'])) {
                        $insertData['po_no'] = $postData['po_no'];
                        $insertData['no'] = $postData['po_no'];
                    }
                    if (!empty($postData['po_date'])) {
                        $insertData['po_date'] = date('Y-m-d', strtotime($postData['po_date']));
                    }
                    $pre_collection = $this->m_common->get_row_array('tbl_payment_collections', array('no' => $postData['po_no'],'is_active'=>1), '*');
                    if (!empty($pre_collection)) {
                        redirect_with_msg('payment_collections/add_collection', 'Already This pay order  collected');
                    }
                } else if ($postData['collection_method'] == "Bg") {
                    $insertData['collection_condition'] = "Collection";
                    if (!empty($postData['bg_no'])) {
                        $insertData['bg_no'] = $postData['bg_no'];
                        $insertData['no'] = $postData['bg_no'];
                    }
                    if (!empty($postData['tenor'])) {
                        $insertData['tenor'] = $postData['tenor'];
                    }
                    if (!empty($postData['bg_issue_date'])) {
                        $insertData['bg_issue_date'] = date('Y-m-d', strtotime($postData['bg_issue_date']));
                    }
                    if (!empty($postData['bg_expire_date'])) {
                        $insertData['bg_expire_date'] = date('Y-m-d', strtotime($postData['bg_expire_date']));
                    }
                   // $pre_collection = $this->m_common->get_row_array('tbl_payment_collections', array('no' => $postData['bg_no']), '*');
                    $pre_collection = $this->m_common->get_row_array('tbl_payment_collections', array('no' => $postData['bg_no'],'is_active'=>1), '*');
                    if (!empty($pre_collection)) {
                        // continue;
                        redirect_with_msg('payment_collections/add_collection', 'Already This Bg  collected');
                    }
                } else if ($postData['collection_method'] == "Lc") {
                    $insertData['collection_condition'] = "Collection";
                    if (!empty($postData['lc_no'])) {
                        $insertData['lc_no'] = $postData['lc_no'];
                        $insertData['no'] = $postData['lc_no'];
                    }
                    if (!empty($postData['tenor'])) {
                        $insertData['tenor'] = $postData['tenor'];
                    }
                    if (!empty($postData['lc_date'])) {
                        $insertData['lc_date'] = date('Y-m-d', strtotime($postData['lc_date']));
                    }
                    $pre_collection = $this->m_common->get_row_array('tbl_payment_collections', array('no' => $postData['lc_no'],'is_active'=>1), '*');
                    if (!empty($pre_collection)) {
                        redirect_with_msg('payment_collections/add_collection', 'Already This Lc collected');
                    }
                }

                if (!empty($postData['bank_id'])) {
                    $insertData['bank_id'] = $postData['bank_id'];
                }
                
                if(!empty($postData['bank_branch_id'])){
                    $insertData['bank_branch_id'] = $postData['bank_branch_id'];
                }
                
                if(!empty($postData['payment_for_id'])){
                    $insertData['payment_for_id'] = $postData['payment_for_id'];
                }
                
                
                if (!empty($postData['remark'])) {
                    $insertData['remark'] = $postData['remark'];
                }

                if (!empty($postData['collection_time'])) {
                    $insertData['collection_time'] = $postData['collection_time'];
                }

                if (!empty($postData['receive_type'])) {
                    $insertData['receive_type'] = $postData['receive_type'];
                }
                
                if (!empty($postData['mrr_no'])) {
                    $insertData['mrr_no'] = $postData['mrr_no'];
                }
//
//                    if (!empty($postData['invoice_id'])) {
//                        $insertData['invoice_id'] = $postData['invoice_id'];
//                    }

                $insertData['customer_id'] = $postData['c_id'];
                $insertData['unit_id'] = $branch_id;
                $insertData['is_active'] = 1;

                //  $insertData['payment_status']='Pending'; 
                $insertData['payment_status'] = 'Collected';

                $insertData['created_date'] = date('Y-m-d');

                $result = $this->m_common->insert_row('tbl_payment_collections', $insertData);


//                    $sql = "update tbl_customers set deposit=deposit+" . $balance . " where id=" . $postData['c_id'];
//                    $this->m_common->customeUpdate($sql);

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_complete();
                }
                redirect_with_msg('payment_collections', 'Successfully Inserted');
            } else {
                redirect_with_msg('payment_collections/add_collection', 'Please fill the form and submit');
            }
        } catch (UserException $error) {
            $this->db->trans_rollback();
            echo '<pre>';
            print_r($error);
            exit;
            redirect_with_msg('payment_collections/add_collection', 'Something went wrong');
        }
    }

    function edit_collection($id) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_collection';
        $this->titlebackend("Quotation Information");
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*');
        $data['bank_branches']=$this->m_common->get_row_array('tbl_bank_branch',array('is_active'=>1),'*');
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories',array('is_active'=>1),'*');
        $data['collection_info'] = $this->m_common->get_row_array('tbl_payment_collections', array('id' => $id), '*');
       // $data['payment_mode'] = $this->m_common->get_row_array('tbl_sales_order_payment_condition', array('o_id' => $data['collection_info'][0]['o_id']), '*');
        $data['banks'] = $this->m_common->get_row_array('tbl_banks', array('is_active' => 1), '*');
//          $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1";
//        $sql = "select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.unit_id=" . $branch_id;
//        $data['sale_orders'] = $this->m_common->customeQuery($sql);


        $all_collection_sql = 'select * from tbl_payment_collections where payment_status="Received" and customer_id=' . $data['collection_info'][0]['customer_id'];
        $data['all_collections'] = $this->m_common->customeQuery($all_collection_sql);

//        $cash_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Cash" and payment_status="Received" and customer_id=' . $data['collection_info'][0]['customer_id'];
//        $data['paid_cash_amount'] = $this->m_common->customeQuery($cash_sql);
//        $data['total_cash_amount'] = $data['payment_mode'][0]['b_cash_amount'] + $data['payment_mode'][0]['a_cash_amount'];
//        $data['due_cash_amount'] = $data['total_cash_amount'] - $data['paid_cash_amount'][0]['total'];
//
//        $pdc_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Pdc" and payment_status="Received" and customer_id=' . $data['collection_info'][0]['customer_id'];
//        $data['paid_pdc_amount'] = $this->m_common->customeQuery($pdc_sql);
//        $data['total_pdc_amount'] = $data['payment_mode'][0]['b_pdc_amount'] + $data['payment_mode'][0]['a_pdc_amount'];
//        $data['due_pdc_amount'] = $data['total_pdc_amount'] - $data['paid_pdc_amount'][0]['total'];
//
//
//        $lc_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Lc" and payment_status="Received" and customer_id=' . $data['collection_info'][0]['customer_id'];
//        $data['paid_lc_amount'] = $this->m_common->customeQuery($lc_sql);
//        $data['total_lc_amount'] = $data['payment_mode'][0]['b_lc_amount'] + $data['payment_mode'][0]['a_lc_amount'];
//        $data['due_lc_amount'] = $data['total_lc_amount'] - $data['paid_lc_amount'][0]['total'];
//
//        $bg_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Bg" and payment_status="Received" and customer_id=' . $data['collection_info'][0]['customer_id'];
//        $data['paid_bg_amount'] = $this->m_common->customeQuery($bg_sql);
//        $data['total_bg_amount'] = $data['payment_mode'][0]['b_bg_amount'] + $data['payment_mode'][0]['a_bg_amount'];
//        $data['due_bg_amount'] = $data['total_bg_amount'] - $data['paid_bg_amount'][0]['total'];
//
//
//        $data['total_amount'] = $data['total_cash_amount'] + $data['total_pdc_amount'] + $data['total_lc_amount'] + $data['total_bg_amount'];
//        $data['total_paid'] = $data['paid_cash_amount'][0]['total'] + $data['paid_pdc_amount'][0]['total'] + $data['paid_lc_amount'][0]['total'] + $data['paid_bg_amount'][0]['total'];
//        $data['total_due'] = $data['total_amount'] - $data['total_paid'];
//
//
//        $sql = "select si.* from tbl_sales_invoices si left join tbl_delivery_orders do on si.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id where si.is_active=1 and do.customer_id=". $data['collection_info'][0]['customer_id'];
//        $data['invoices'] = $this->m_common->customeQuery($sql);

        
        
        $sql = "select sum(so.total_amount) as total,sum(so.receive_amount) as rcv from tbl_sales_orders so 
join tbl_project p on p.project_id=so.project_id
where so.customer_id=".$data['collection_info'][0]['customer_id']." and (receive_status='Pending' or receive_status='Partial Received')";
        $so = $this->m_common->customeQuery($sql);
        $total = !empty($so) ? $so[0]['total'] : '0';
        $rcv = !empty($so) ? $so[0]['rcv'] : '0';
        $data['total_due'] = $total-$rcv;
        // $this->load->view('payment_collections/v_edit_collection',$data);
        $this->load->view('payment_collections/v_edit_collection_new', $data);
    }

    function new_edit_collection($id) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_collection';
        $this->titlebackend("Quotation Information");

        $data['collection_info'] = $this->m_common->get_row_array('tbl_payment_collections', array('id' => $id), '*');
        $data['payment_mode'] = $this->m_common->get_row_array('tbl_sales_order_payment_condition', array('o_id' => $data['collection_info'][0]['o_id']), '*');
        $data['banks'] = $this->m_common->get_row_array('tbl_banks', array('is_active' => 1), '*');
        //  $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1";
        $sql = "select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.unit_id=" . $branch_id;
        $data['sale_orders'] = $this->m_common->customeQuery($sql);

        $cash_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Cash" and payment_status="Received" and o_id=' . $data['collection_info'][0]['o_id'];
        $data['paid_cash_amount'] = $this->m_common->customeQuery($cash_sql);
        $data['total_cash_amount'] = $data['payment_mode'][0]['b_cash_amount'] + $data['payment_mode'][0]['a_cash_amount'];
        $data['due_cash_amount'] = $data['total_cash_amount'] - $data['paid_cash_amount'][0]['total'];

        $pdc_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Pdc" and payment_status="Received" and o_id=' . $data['collection_info'][0]['o_id'];
        $data['paid_pdc_amount'] = $this->m_common->customeQuery($pdc_sql);
        $data['total_pdc_amount'] = $data['payment_mode'][0]['b_pdc_amount'] + $data['payment_mode'][0]['a_pdc_amount'];
        $data['due_pdc_amount'] = $data['total_pdc_amount'] - $data['paid_pdc_amount'][0]['total'];


        $lc_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Lc" and payment_status="Received" and o_id=' . $data['collection_info'][0]['o_id'];
        $data['paid_lc_amount'] = $this->m_common->customeQuery($lc_sql);
        $data['total_lc_amount'] = $data['payment_mode'][0]['b_lc_amount'] + $data['payment_mode'][0]['a_lc_amount'];
        $data['due_lc_amount'] = $data['total_lc_amount'] - $data['paid_lc_amount'][0]['total'];

        $bg_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Bg" and payment_status="Received" and o_id=' . $data['collection_info'][0]['o_id'];
        $data['paid_bg_amount'] = $this->m_common->customeQuery($bg_sql);
        $data['total_bg_amount'] = $data['payment_mode'][0]['b_bg_amount'] + $data['payment_mode'][0]['a_bg_amount'];
        $data['due_bg_amount'] = $data['total_bg_amount'] - $data['paid_bg_amount'][0]['total'];


        $data['total_amount'] = $data['total_cash_amount'] + $data['total_pdc_amount'] + $data['total_lc_amount'] + $data['total_bg_amount'];
        $data['total_paid'] = $data['paid_cash_amount'][0]['total'] + $data['paid_pdc_amount'][0]['total'] + $data['paid_lc_amount'][0]['total'] + $data['paid_bg_amount'][0]['total'];
        $data['total_due'] = $data['total_amount'] - $data['total_paid'];


        $sql = "select si.* from tbl_sales_invoices si left join tbl_delivery_orders do on si.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id where si.is_active=1 and do.o_id=" . $data['collection_info'][0]['o_id'];
        $data['invoices'] = $this->m_common->customeQuery($sql);

        $this->load->view('payment_collections/v_edit_collection_new', $data);
    }

    function edit_collection_action($q_id) {
        $existCollection = $this->m_common->get_row_array('tbl_payment_collections', array('id' => $q_id), '*');
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            if (!empty($postData['c_id'])) {
                $insertData['customer_id'] = $postData['c_id'];
            }

           // $payment_condition = $this->m_common->get_row_array('tbl_sales_order_payment_condition', array('o_id' => $postData['o_id']), '*');

            if (!empty($postData['amount'])) {
                $insertData['amount'] = $postData['amount'];
            }
            if (!empty($postData['receive_date'])) {
                $insertData['receive_date'] = date('Y-m-d', strtotime($postData['receive_date']));
            }

            if (!empty($postData['collection_method'])) {
                $insertData['collection_method'] = $postData['collection_method'];
            }
            if ($postData['collection_method'] == "Cash") {
                $insertData['collection_condition'] = "Collection";
                $insertData['ac_no'] ='';
                $insertData['check_no'] = '';
                $insertData['check_date'] = '';
                $insertData['po_no'] = '';
                $insertData['po_date'] = '';
                $insertData['bg_no'] = '';
                $insertData['bg_issue_date'] = '';
                $insertData['bg_expire_date'] = '';
                $insertData['tenor'] = '';
                $insertData['lc_no'] = '';
                $insertData['lc_date'] = '';
            }else if ($postData['collection_method'] == "O.Cash"){
                $insertData['collection_condition'] = "Collection";
                $insertData['check_no'] = '';
                $insertData['check_date'] = '';
                $insertData['po_no'] = '';
                $insertData['po_date'] = '';
                $insertData['bg_no'] = '';
                $insertData['bg_issue_date'] = '';
                $insertData['bg_expire_date'] = '';
                $insertData['tenor'] = '';
                $insertData['lc_no'] = '';
                $insertData['lc_date'] = '';
                $insertData['ac_no'] = $postData['ac_no'];
               // $insertData['no'] = $postData['ac_no'];
                    
            }else if ($postData['collection_method'] == "Pdc") {
                if ($payment_condition[0]['b_pdc_condition'] == "Collection") {
                    $insertData['collection_condition'] = "Collection";
                } else {
                    $insertData['collection_condition'] = "Realization";
                }
                if (!empty($postData['check_no'])) {
                    $insertData['check_no'] = $postData['check_no'];
                    $insertData['no'] = $postData['check_no'];
                }
                if (!empty($postData['check_date'])) {
                    $insertData['check_date'] = date('Y-m-d', strtotime($postData['check_date']));
                    $insertData['bank_deposit_date'] = date('Y-m-d', strtotime($postData['check_date']));
                }else{
                    $insertData['check_date'] ='';
                }
                $insertData['po_no'] = '';
                $insertData['po_date'] = '';
                $insertData['bg_no'] = '';
                $insertData['bg_issue_date'] = '';
                $insertData['bg_expire_date'] = '';
                $insertData['tenor'] = '';
                $insertData['lc_no'] = '';
                $insertData['lc_date'] = '';
            } else if ($postData['collection_method'] == "Po") {
                if (!empty($postData['po_no'])) {
                    $insertData['po_no'] = $postData['po_no'];
                    $insertData['no'] = $postData['po_no'];
                }
                if (!empty($postData['po_date'])) {
                    $insertData['po_date'] = date('Y-m-d', strtotime($postData['po_date']));
                    //$insertData['bank_deposit_date'] = date('Y-m-d', strtotime($postData['po_date']));
                }
                $insertData['check_no'] = '';
                $insertData['check_date'] = '';
                $insertData['bg_no'] = '';
                $insertData['bg_issue_date'] = '';
                $insertData['bg_expire_date'] = '';
                $insertData['tenor'] = '';
                $insertData['lc_no'] = '';
                $insertData['lc_date'] = '';
            } else if ($postData['collection_method'] == "Bg") {
                $insertData['collection_condition'] = "Collection";
                if (!empty($postData['bg_no'])) {
                    $insertData['bg_no'] = $postData['bg_no'];
                    $insertData['no'] = $postData['bg_no'];
                }
                if (!empty($postData['tenor'])) {
                    $insertData['tenor'] = $postData['tenor'];
                }
                if (!empty($postData['bg_issue_date'])) {
                    $insertData['bg_issue_date'] = date('Y-m-d', strtotime($postData['bg_issue_date']));
                }
                if (!empty($postData['bg_expire_date'])) {
                    $insertData['bg_expire_date'] = date('Y-m-d', strtotime($postData['bg_expire_date']));
                }
                $insertData['check_no'] ='';
                $insertData['check_date'] ='';
                $insertData['po_no'] = '';
                $insertData['po_date'] = '';
                $insertData['lc_no'] = '';
                $insertData['lc_date'] = '';
            } else if ($postData['collection_method'] == "Lc") {
//                if ($payment_condition[0]['b_lc_condition'] == "Collection") {
//                    $insertData['collection_condition'] = "Collection";
//                } else {
                    $insertData['collection_condition'] = "Realization";
                //}
                if (!empty($postData['lc_no'])) {
                    $insertData['lc_no'] = $postData['lc_no'];
                    $insertData['no'] = $postData['lc_no'];
                }
                if (!empty($postData['tenor'])) {
                    $insertData['tenor'] = $postData['tenor'];
                }
                if (!empty($postData['lc_date'])) {
                    $insertData['lc_date'] = date('Y-m-d', strtotime($postData['lc_date']));
                }
                $insertData['check_no'] = '';
                $insertData['check_date'] = '';
                $insertData['po_no'] = '';
                $insertData['po_date'] = '';
                $insertData['bg_no'] = '';
                $insertData['bg_issue_date'] = '';
                $insertData['bg_expire_date'] = '';
            }

            if (!empty($postData['bank_id'])) {
                $insertData['bank_id'] = $postData['bank_id'];
            }
            
            if(!empty($postData['bank_branch_id'])){
                $insertData['bank_branch_id'] = $postData['bank_branch_id'];
            }

            if(!empty($postData['payment_for_id'])){
                $insertData['payment_for_id'] = $postData['payment_for_id'];
            }
            
            
            if (!empty($postData['collection_time'])) {
                $insertData['collection_time'] = $postData['collection_time'];
            }
//            if (!empty($postData['receive_type'])) {
//                $insertData['receive_type'] = $postData['receive_type'];
//            }
            
            if(!empty($postData['mrr_no'])){
                $insertData['mrr_no'] = $postData['mrr_no'];
            }
            
            if (!empty($postData['invoice_id'])) {
                $insertData['invoice_id'] = $postData['invoice_id'];
            }
            if (!empty($postData['remark'])) {
                $insertData['remark'] = $postData['remark'];
            }
            $result = $this->m_common->update_row('tbl_payment_collections', array('id' => $q_id), $insertData);
//            if ($result >= 0) {
////                $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and is_active=1 and o_id=".$postData['o_id'];
////                $total_collection=$this->m_common->customeQuery($sql); 
////                if($total_collection[0]['total']>=$total_condition_amount){
////                    $this->m_common->update_row('tbl_sales_orders',array('o_id'=>$postData['o_id']),array('status'=>"Approved"));
////                } 
//                if ($existCollection[0]['o_id'] == $postData['o_id']) {
//
//                    $approve = 'Approved';
//                    if ($payment_condition[0]['b_cash'] == "Cash") {
//                        $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Cash' and is_active=1 and o_id=" . $postData['o_id'];
//                        $total_cash_collection = $this->m_common->customeQuery($sql);
//                        if ($total_cash_collection[0]['total'] >= $payment_condition[0]['b_cash_amount']) {
//                            
//                        } else {
//                            $approve = 'Pending';
//                        }
//                    }
//
//                    if ($payment_condition[0]['b_bg'] == "Bg") {
//                        $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Bg' and is_active=1 and o_id=" . $postData['o_id'];
//                        $total_bg_collection = $this->m_common->customeQuery($sql);
//                        if ($total_bg_collection[0]['total'] >= $payment_condition[0]['b_bg_amount']) {
//                            
//                        } else {
//                            $approve = 'Pending';
//                        }
//                    }
//
//                    if ($payment_condition[0]['b_pdc'] == "Pdc") {
//                        if ($payment_condition[0]['b_pdc_condition'] == "Collection") {
//                            $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Pdc' and is_active=1 and o_id=" . $postData['o_id'];
//                        } else {
//                            $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Pdc' and is_active=1 and o_id=" . $postData['o_id'];
//                        }
//                        $total_pdc_collection = $this->m_common->customeQuery($sql);
//                        if ($total_pdc_collection[0]['total'] >= $payment_condition[0]['b_pdc_amount']) {
//                            
//                        } else {
//                            $approve = 'Pending';
//                        }
//                    }
//
//                    if ($payment_condition[0]['b_lc'] == "Lc") {
//                        if ($payment_condition[0]['b_lc_condition'] == "Collection") {
//                            $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Lc' and is_active=1 and o_id=" . $postData['o_id'];
//                        } else {
//                            $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Lc' and is_active=1 and o_id=" . $postData['o_id'];
//                        }
//                        $total_lc_collection = $this->m_common->customeQuery($sql);
//                        if ($total_lc_collection[0]['total'] >= $payment_condition[0]['b_lc_amount']) {
//                            
//                        } else {
//                            $approve = 'Pending';
//                        }
//                    }
//
//                    $this->m_common->update_row('tbl_sales_orders', array('o_id' => $postData['o_id']), array('status' => $approve));
//                } else {
//                    $approve = 'Approved';
//                    if ($payment_condition[0]['b_cash'] == "Cash") {
//                        $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Cash' and is_active=1 and o_id=" . $postData['o_id'];
//                        $total_cash_collection = $this->m_common->customeQuery($sql);
//                        if ($total_cash_collection[0]['total'] >= $payment_condition[0]['b_cash_amount']) {
//                            
//                        } else {
//                            $approve = 'Pending';
//                        }
//                    }
//
//                    if ($payment_condition[0]['b_bg'] == "Bg") {
//                        $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Bg' and is_active=1 and o_id=" . $postData['o_id'];
//                        $total_bg_collection = $this->m_common->customeQuery($sql);
//                        if ($total_bg_collection[0]['total'] >= $payment_condition[0]['b_bg_amount']) {
//                            
//                        } else {
//                            $approve = 'Pending';
//                        }
//                    }
//
//                    if ($payment_condition[0]['b_pdc'] == "Pdc") {
//                        if ($payment_condition[0]['b_pdc_condition'] == "Collection") {
//                            $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Pdc' and is_active=1 and o_id=" . $postData['o_id'];
//                        } else {
//                            $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Pdc' and is_active=1 and o_id=" . $postData['o_id'];
//                        }
//                        $total_pdc_collection = $this->m_common->customeQuery($sql);
//                        if ($total_pdc_collection[0]['total'] >= $payment_condition[0]['b_pdc_amount']) {
//                            
//                        } else {
//                            $approve = 'Pending';
//                        }
//                    }
//
//                    if ($payment_condition[0]['b_lc'] == "Lc") {
//                        if ($payment_condition[0]['b_lc_condition'] == "Collection") {
//                            $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Lc' and is_active=1 and o_id=" . $postData['o_id'];
//                        } else {
//                            $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Lc' and is_active=1 and o_id=" . $postData['o_id'];
//                        }
//                        $total_lc_collection = $this->m_common->customeQuery($sql);
//                        if ($total_lc_collection[0]['total'] >= $payment_condition[0]['b_lc_amount']) {
//                            
//                        } else {
//                            $approve = 'Pending';
//                        }
//                    }
//
//                    $this->m_common->update_row('tbl_sales_orders', array('o_id' => $postData['o_id']), array('status' => $approve));
//
//                    $pre_order_payment_condition = $this->m_common->get_row_array('tbl_sales_order_payment_condition', array('o_id' => $existCollection[0]['o_id']), '*');
//
//                    $approve1 = 'Approved';
//                    if ($pre_order_payment_condition[0]['b_cash'] == "Cash") {
//                        $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Cash' and is_active=1 and o_id=" . $existCollection[0]['o_id'];
//                        $total_cash_collection = $this->m_common->customeQuery($sql);
//                        if ($total_cash_collection[0]['total'] >= $pre_order_payment_condition[0]['b_cash_amount']) {
//                            
//                        } else {
//                            $approve1 = 'Pending';
//                        }
//                    }
//
//                    if ($pre_order_payment_condition[0]['b_bg'] == "Bg") {
//                        $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Bg' and is_active=1 and o_id=" . $existCollection[0]['o_id'];
//                        $total_bg_collection = $this->m_common->customeQuery($sql);
//                        if ($total_bg_collection[0]['total'] >= $pre_order_payment_condition[0]['b_bg_amount']) {
//                            
//                        } else {
//                            $approve1 = 'Pending';
//                        }
//                    }
//
//                    if ($pre_order_payment_condition[0]['b_pdc'] == "Pdc") {
//                        if ($pre_order_payment_condition[0]['b_pdc_condition'] == "Collection") {
//                            $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Pdc' and is_active=1 and o_id=" . $existCollection[0]['o_id'];
//                        } else {
//                            $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Pdc' and is_active=1 and o_id=" . $existCollection[0]['o_id'];
//                        }
//                        $total_pdc_collection = $this->m_common->customeQuery($sql);
//                        if ($total_pdc_collection[0]['total'] >= $pre_order_payment_condition[0]['b_pdc_amount']) {
//                            
//                        } else {
//                            $approve1 = 'Pending';
//                        }
//                    }
//
//                    if ($pre_order_payment_condition[0]['b_lc'] == "Lc") {
//                        if ($pre_order_payment_condition[0]['b_lc_condition'] == "Collection") {
//                            $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Lc' and is_active=1 and o_id=" . $existCollection[0]['o_id'];
//                        } else {
//                            $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Lc' and is_active=1 and o_id=" . $existCollection[0]['o_id'];
//                        }
//                        $total_lc_collection = $this->m_common->customeQuery($sql);
//                        if ($total_lc_collection[0]['total'] >= $pre_order_payment_condition[0]['b_lc_amount']) {
//                            
//                        } else {
//                            $approve1 = 'Pending';
//                        }
//                    }
//
//                    $this->m_common->update_row('tbl_sales_orders', array('o_id' => $existCollection[0]['o_id']), array('status' => $approve1));
//                }

                redirect_with_msg('payment_collections', 'Successfully Updated');
//            } else {
//                redirect_with_msg('payment_collections/edit_collection/' . $q_id, 'Not Updated');
//            }
        } else {
            redirect_with_msg('payment_collections/edit_collection/' . $q_id, 'Please fill the form and submit');
        }
    }

    function view_collection($id) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_collection';
        $this->titlebackend("Quotation Information");

        // $data['collection_info']=$this->m_common->get_row_array('tbl_payment_collections',array('id'=>$id),'*');
    //    $c_sql = "select tpc.*,tc.c_name,tp.project_name,so.order_no,so.billing_address,so.billing_email,so.attention,so.phone from tbl_payment_collections tpc left join tbl_sales_orders so on tpc.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where tpc.id=$id";
        $c_sql = "select tpc.*,tc.c_name,tp.project_name,so.order_no,so.billing_address,so.billing_email,so.attention,so.phone from tbl_payment_collections tpc left join tbl_sales_orders so on tpc.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on tpc.customer_id=tc.id where tpc.id=$id";
        $data['collection_info'] = $this->m_common->customeQuery($c_sql);
//        print_r($data['collection_info']);
//        exit;
        $data['payment_mode'] = $this->m_common->get_row_array('tbl_sales_order_payment_condition', array('o_id' => $data['collection_info'][0]['o_id']), '*');
//        print_r($data['payment_mode']);
//        exit;
        $data['banks'] = $this->m_common->get_row_array('tbl_banks', array('is_active' => 1), '*');
        // $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1";
        $sql = "select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.unit_id=" . $branch_id;
        $data['sale_orders'] = $this->m_common->customeQuery($sql);

//        $cash_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Cash" and payment_status="Received" and o_id=' . $data['collection_info'][0]['o_id'];
//        $data['paid_cash_amount'] = $this->m_common->customeQuery($cash_sql);
//        $data['total_cash_amount'] = $data['payment_mode'][0]['b_cash_amount'] + $data['payment_mode'][0]['a_cash_amount'];
//        $data['due_cash_amount'] = $data['total_cash_amount'] - $data['paid_cash_amount'][0]['total'];
//
//        $pdc_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Pdc" and payment_status="Received" and o_id=' . $data['collection_info'][0]['o_id'];
//        $data['paid_pdc_amount'] = $this->m_common->customeQuery($pdc_sql);
//        $data['total_pdc_amount'] = $data['payment_mode'][0]['b_pdc_amount'] + $data['payment_mode'][0]['a_pdc_amount'];
//        $data['due_pdc_amount'] = $data['total_pdc_amount'] - $data['paid_pdc_amount'][0]['total'];
//
//
//        $lc_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Lc" and payment_status="Received" and o_id=' . $data['collection_info'][0]['o_id'];
//        $data['paid_lc_amount'] = $this->m_common->customeQuery($lc_sql);
//        $data['total_lc_amount'] = $data['payment_mode'][0]['b_lc_amount'] + $data['payment_mode'][0]['a_lc_amount'];
//        $data['due_lc_amount'] = $data['total_lc_amount'] - $data['paid_lc_amount'][0]['total'];
//
//        $bg_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Bg" and payment_status="Received" and o_id=' . $data['collection_info'][0]['o_id'];
//        $data['paid_bg_amount'] = $this->m_common->customeQuery($bg_sql);
//        $data['total_bg_amount'] = $data['payment_mode'][0]['b_bg_amount'] + $data['payment_mode'][0]['a_bg_amount'];
//        $data['due_bg_amount'] = $data['total_bg_amount'] - $data['paid_bg_amount'][0]['total'];
//
//
//        $data['total_amount'] = $data['total_cash_amount'] + $data['total_pdc_amount'] + $data['total_lc_amount'] + $data['total_bg_amount'];
//        $data['total_paid'] = $data['paid_cash_amount'][0]['total'] + $data['paid_pdc_amount'][0]['total'] + $data['paid_lc_amount'][0]['total'] + $data['paid_bg_amount'][0]['total'];
//        $data['total_due'] = $data['total_amount'] - $data['total_paid'];




        $this->load->view('payment_collections/v_details_collection', $data);
    }

    function receive_collection($c_id) {
        $collection_info = $this->m_common->get_row_array('tbl_payment_collections', array('id' => $c_id), '*');
        $order_info = $this->m_common->get_row_array('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), '*');
        $customer_info = $this->m_common->get_row_array('tbl_customers', array('id' => $collection_info[0]['customer_id']), '*');
        $result = $this->m_common->update_row('tbl_payment_collections', array('id' => $c_id), array('payment_status' => "Received"));
    //    $d=$customer_info[0]['deposit'];
        if($customer_info[0]['deposit']==NULL){
        //    $test=1;
            $sql = "update tbl_customers set deposit=".$collection_info[0]['amount']. " where id=" . $collection_info[0]['customer_id'];
        }else{
        //    $test=2;
            $sql = "update tbl_customers set deposit=deposit+".$collection_info[0]['amount']. " where id=" . $collection_info[0]['customer_id'];
        }
        $this->m_common->customeUpdate($sql);
        redirect_with_msg('payment_collections', 'Successfully Received');
        
    }

    function receive_collection_pre($c_id) {
        $collection_info = $this->m_common->get_row_array('tbl_payment_collections', array('id' => $c_id), '*');
        $order_info = $this->m_common->get_row_array('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), '*');
        $result = $this->m_common->update_row('tbl_payment_collections', array('id' => $c_id), array('payment_status' => "Received"));
        if (!empty($result)) {
            $sales_payment_condition = $this->m_common->get_row_array('tbl_sales_order_payment_condition', array('o_id' => $collection_info[0]['o_id']), '*');
            $total_condition_amount = $sales_payment_condition[0]['b_cash_amount'] + $sales_payment_condition[0]['b_bg_amount'] + $sales_payment_condition[0]['b_lc_amount'];
            // $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and o_id=".$collection_info[0]['o_id'];
            $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and is_active=1 and o_id=" . $collection_info[0]['o_id'];
            $total_collection = $this->m_common->customeQuery($sql);
            if ($total_collection[0]['total'] >= $total_condition_amount) {
                $this->m_common->update_row('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), array('status' => "Approved"));
            }
            if ($total_collection[0]['total'] == $order_info[0]['total_amount']) {
                $this->m_common->update_row('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), array('receive_status' => "Received"));
            } else {
                $this->m_common->update_row('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), array('receive_status' => "Partial Received"));
            }
            redirect_with_msg('payment_collections', 'Successfully Received');
        }
    }

    function delete_collection($id) {
        if (!empty($id)) {
            $id = $this->m_common->update_row('tbl_payment_collections', array('id' => $id), array('is_active' => 0));
            if (!empty($id)) {
                redirect_with_msg('payment_collections/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('payment_collections/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('payment_collections/index', 'Please click on delete button');
        }
    }
    
    function active_collection(){
        $this->setOutputMode(NORMAL);        
        $collection_id = $this->input->post('collection_id');
        
        $cheque_date = $this->input->post('cheque_date');  
        
        if(!empty($cheque_date)){
            $cheque_date=date('Y-m-d',strtotime($cheque_date));
            $res = $this->m_common->update_row('tbl_payment_collections', array('id' =>$collection_id), array('payment_status' =>"Collected",'check_date'=>$cheque_date));
        }else{
            $res = $this->m_common->update_row('tbl_payment_collections',array('id'=>$collection_id),array('payment_status' =>"Collected"));
        } 
        
        $data['status']='success';       
        echo json_encode($data);
    }
    
    

    function get_item_material() {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');

        $data['item_info'] = $this->m_common->get_row_array('tbl_sales_items', array('s_item_id' => $id), '*');
        //$sql="select tbl_d.*,tbl_m.m_name from tbl_sales_item_details tbl_d left join tbl_materials tbl_m on tbl_d.m_id=tbl_m.m_id where tbl_d.s_item_id=".$id;
        $sql = "select tbl_d.*,items.item_name from tbl_sales_item_details tbl_d left join items  on tbl_d.m_id=items.id where tbl_d.s_item_id=" . $id;
        $data['item_list'] = $this->m_common->customeQuery($sql);
        //       $data['item_list']=$this->m_common->get_row_array('items','','*');

        echo json_encode($data);
    }

    function item_info() {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('product_id');
        $product = $this->m_common->get_row_array('tbl_product_quote_price', array('product_id' => $id, 'is_active' => 1), '*');
        if (!empty($product)) {
            $data['product_info'] = $product;
        } else {
            $data['product_info'] = '';
        }
        echo json_encode($data);
    }

    function get_customer_sales_order() {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('c_id');
        $sql = "select so.*,p.project_name from tbl_sales_orders so 
join tbl_project p on p.project_id=so.project_id
where so.customer_id=$id and (receive_status='Pending' or receive_status='Partial Received')";
        $so = $this->m_common->customeQuery($sql);
        $customer = $this->m_common->get_row_array('tbl_customers', array('id' => $id), '*');
        $all_collection_sql = 'select * from tbl_payment_collections where payment_status="Received" and customer_id=' . $id;
        $data['all_collections'] = $this->m_common->customeQuery($all_collection_sql);
        if (!empty($so)) {
            $data['sales_order'] = $so;
           // $data['customer'] = $customer[0];
        } else {
            $data['sales_order'] = '';
            //$data['customer'] = $customer[0];
        }
        
        
        $hand_sql = "select * from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.is_active=1 and pc.payment_status='Dishonored' and pc.customer_id=".$id;
        $data['dishonored']= $this->m_common->customeQuery($hand_sql);
        $hand_sql = "select * from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.is_active=1 and (pc.payment_status='Collected' || pc.payment_status='Deposited') and pc.customer_id=".$id;
        $data['in_hand']= $this->m_common->customeQuery($hand_sql);
        //$data['in_hand'] = $in_hand[0]['total_amount'];
       // $data['in_hand']=$in_hand;
        
        
        $data['customer'] = $customer[0];
        $t_re ="select sum(amount) as total_amount from tbl_payment_collections pc  where pc.is_active=1 and pc.payment_status='Received' and pc.customer_id=".$id;
        $total_received= $this->m_common->customeQuery($t_re);
            
        $data['total_deposit']=$total_received[0]['total_amount']+$customer[0]['opening_balance']; 
        
        $tb_sql="select sum(total_amount) as total_bill from tbl_sales_invoices v where v.status!='Canceled' and v.is_active=1 and v.customer_id=".$id;
        $total_bill=$this->m_common->customeQuery($tb_sql);
        $data['total_bill']=$total_bill[0]['total_bill']; 
        $due=$total_bill[0]['total_bill']-$data['total_deposit'];
        $surplus=$data['total_deposit']-$total_bill[0]['total_bill'];
        if($due>0){
            $data['due']=$due;
        }else{
            $data['due']=0;
        }
        
        if($surplus>0){
            $data['surplus']=$surplus;
        }else{
            $data['surplus']=0;
        }
        
        
        
        echo json_encode($data);
    }

    function customer_info() {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');
        $data['quotaion'] = $this->m_common->get_row_array('tbl_sales_quotation_code', array('customer_id' => $id), '*', '', 1, 'id', 'DESC');
        $customer = $this->m_common->get_row_array('tbl_customers', array('id' => $id, 'is_active' => 1), '*');
        if (!empty($customer)) {
            $data['customer_info'] = $customer;
        } else {
            $data['customer_info'] = '';
        }
        echo json_encode($data);
    }

    function get_payment_mode() {
        $this->setOutputMode(NORMAL);
        $branch_id = $this->session->userdata('companyId');
        $o_id = $this->input->post('o_id');
        $data['payment_mode'] = $this->m_common->get_row_array('tbl_sales_order_payment_condition', array('o_id' => $o_id), '*');

        $all_collection_sql = 'select * from tbl_payment_collections where payment_status="Received" and o_id=' . $o_id;
        $data['all_collections'] = $this->m_common->customeQuery($all_collection_sql);

        $cash_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Cash" and payment_status="Received" and o_id=' . $o_id;
        $data['paid_cash_amount'] = $this->m_common->customeQuery($cash_sql);
        $data['total_cash_amount'] = $data['payment_mode'][0]['b_cash_amount'] + $data['payment_mode'][0]['a_cash_amount'];
        $data['due_cash_amount'] = $data['total_cash_amount'] - $data['paid_cash_amount'][0]['total'];

        $pdc_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Pdc" and payment_status="Received" and o_id=' . $o_id;
        $data['paid_pdc_amount'] = $this->m_common->customeQuery($pdc_sql);
        $data['total_pdc_amount'] = $data['payment_mode'][0]['b_pdc_amount'] + $data['payment_mode'][0]['a_pdc_amount'];
        $data['due_pdc_amount'] = $data['total_pdc_amount'] - $data['paid_pdc_amount'][0]['total'];


        $lc_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Lc" and payment_status="Received" and o_id=' . $o_id;
        $data['paid_lc_amount'] = $this->m_common->customeQuery($lc_sql);
        $data['total_lc_amount'] = $data['payment_mode'][0]['b_lc_amount'] + $data['payment_mode'][0]['a_lc_amount'];
        $data['due_lc_amount'] = $data['total_lc_amount'] - $data['paid_lc_amount'][0]['total'];

        $bg_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Bg" and payment_status="Received" and o_id=' . $o_id;
        $data['paid_bg_amount'] = $this->m_common->customeQuery($bg_sql);
        $data['total_bg_amount'] = $data['payment_mode'][0]['b_bg_amount'] + $data['payment_mode'][0]['a_bg_amount'];
        $data['due_bg_amount'] = $data['total_bg_amount'] - $data['paid_bg_amount'][0]['total'];


        $data['total_amount'] = $data['total_cash_amount'] + $data['total_pdc_amount'] + $data['total_lc_amount'] + $data['total_bg_amount'];
        $data['total_paid'] = $data['paid_cash_amount'][0]['total'] + $data['paid_pdc_amount'][0]['total'] + $data['paid_lc_amount'][0]['total'] + $data['paid_bg_amount'][0]['total'];
        $data['total_due'] = $data['total_amount'] - $data['total_paid'];

        // $sql="select si.* from tbl_sales_invoices si left join tbl_delivery_orders do on si.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id where si.is_active=1 and do.o_id=$o_id";
        $sql = "select si.* from tbl_sales_invoices si left join tbl_delivery_orders do on si.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id where (si.status='Pending' or si.status='Partial Received') and si.is_active=1 and do.o_id=$o_id";
        $data['invoices'] = $this->m_common->customeQuery($sql);
        echo json_encode($data);
    }

    function get_customer_balance_info(){
        $this->setOutputMode(NORMAL);
        $customer_id=$this->input->post('customer_id');
        $data['customer_balance_info']=$this->m_common->get_row_array('tbl_customers',array('id'=>$customer_id),'*');
        $where = "pc.is_active=1";
        $where .= " and pc.customer_id=$customer_id";
        $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and (pc.payment_status='Collected' || pc.payment_status='Deposited' || pc.payment_status='Dishonored') order by pc.id desc";
        $data['collections']=$this->m_common->customeQuery($sql);
        
        
//        $pr_sql = "select pc.* from tbl_payment_collections pc  where pc.is_active=1 and pc.payment_status='Received' and pc.customer_id=".$customer_id." order by pc.id desc";
//        $data['payment_receive'] = $this->m_common->customeQuery($pr_sql);
        
        
        $t_re ="select sum(amount) as total_amount from tbl_payment_collections pc  where pc.is_active=1 and pc.payment_status='Received' and pc.customer_id=".$customer_id;
        $total_received= $this->m_common->customeQuery($t_re);
        
        $data['total_deposit']=number_format($total_received[0]['total_amount']+$data['customer_balance_info'][0]['opening_balance'])." BDT";  
        
        $tb_sql="select sum(v.total_amount) as total_bill from tbl_sales_invoices v where v.status!='Canceled' and v.is_active=1 and v.customer_id=".$customer_id;
        $total_bill=$this->m_common->customeQuery($tb_sql);
        $data['total_bill']=number_format($total_bill[0]['total_bill'],2)." BDT"; 
        $remain=$total_bill[0]['total_bill']-$total_received[0]['total_amount'];
        if($remain>0){
            $data['due']=number_format($remain,2)." BDT";
        }else{
            $data['balance']=number_format($total_bill[0]['total_amount']-$total_received[0]['total_bill'])." BDT"; 
        }
        
        $hand_sql = "select sum(pc.amount) as total_amount from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.is_active=1 and pc.payment_status!='Received' and pc.customer_id=".$customer_id;
        $in_hand = $this->m_common->customeQuery($hand_sql);
        $data['in_hand'] = number_format($in_hand[0]['total_amount'],2)." BDT"; 
        
        
        
        echo json_encode($data);
    }
    
    function payment_received() {
        $branch_id = $this->session->userdata('companyId');
        $user_category= $this->session->userdata('user_category');
        $show_data_info=$this->m_common->get_row_array('tbl_show_data_setting','','*');
        $currentDate=date('Y-m-d');
        $prev_date = date('Y-m-d', strtotime($currentDate .' -'.$show_data_info['0']['day'].' days'));



        $this->menu ='sales';
        $this->sub_menu ='sale';
        $this->sub_inner_menu ='payment_received';
        $this->titlebackend("Payment Received");
        // $data['quotations']=$this->m_common->get_row_array('tbl_sales_quotation
        // $sql="select pc.*,so.order_no,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_sales_orders so on pc.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where pc.is_active=1";
//        $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.is_active=1 and pc.payment_status='Received' and pc.unit_id=" . $branch_id." order by pc.receive_date DESC";
//        $data['collections'] = $this->m_common->customeQuery($sql);
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories','','*');
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
       
        $postData = $this->input->post();
        $where = '';
    //    $where = "pc.unit_id=$branch_id";
        $where = "pc.is_active=1";
        if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = '';
                $data['to_date'] = '';
                $f_date = '';
                $to_date = '';
            }
            
            
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['collection_method'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }

             if(!empty($f_date) & !empty($to_date)){      
                // $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $from_date . "' and pc.receive_date<='" . $to_date . "' and pc.payment_status='Received' order by pc.receive_date desc";
                // $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and  pc.payment_status='Received' and ((pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "') or (tdr.realization_date>='" . $f_date . "' and tdr.realization_date<='" . $to_date . "')) order by pc.receive_date desc";
                // $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and  pc.payment_status='Received' and (((pc.collection_method='Cash' or pc.collection_method='O.Cash') and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "') or (tdr.realization_date>='" . $f_date . "' and tdr.realization_date<='" . $to_date . "')) order by pc.receive_date desc";//17-10-2020
                //   $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and  pc.payment_status='Received' and (((pc.collection_method='Cash' or pc.collection_method='O.Cash') and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "') or (tdr.realization_date>='" . $f_date . "' and tdr.realization_date<='" . $to_date . "')) group by pc.id order by pc.receive_date desc,tdr.id desc";//18-10-2020
                if($user_category==2){ 

                    $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,
                    (select realization_date from tbl_deposit_realization  where collection_id=pc.id and realization_status='Honored' limit 1) 
                    realization_date from tbl_payment_collections pc 
                    left join tbl_deposit_realization tdr on pc.id=tdr.collection_id 
                    left join tbl_customers c on pc.customer_id=c.id 
                    left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                    where $where and  pc.payment_status='Received' and (((pc.collection_method='Cash' or pc.collection_method='O.Cash') and pc.receive_date>='" . $prev_date . "' and pc.receive_date<='" . $currentDate . "') or ((pc.collection_method='Pdc' or pc.collection_method='Lc' or pc.collection_method='Bg') and tdr.realization_status='Honored' and (tdr.realization_date>='" . $prev_date . "' and tdr.realization_date<='" . $currentDate . "'))) group by pc.id order by pc.receive_date desc,tdr.id desc";
                }else{
                    $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,(select realization_date from tbl_deposit_realization  where collection_id=pc.id and realization_status='Honored' limit 1) realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and  pc.payment_status='Received' and (((pc.collection_method='Cash' or pc.collection_method='O.Cash') and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "') or ((pc.collection_method='Pdc' or pc.collection_method='Lc' or pc.collection_method='Bg') and tdr.realization_status='Honored' and (tdr.realization_date>='" . $f_date . "' and tdr.realization_date<='" . $to_date . "'))) group by pc.id order by pc.receive_date desc,tdr.id desc"; 

                } 
                
             }else if (!empty($f_date)) {
              //  $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.receive_date>='" . $from_date .  "' and pc.is_active=1 and pc.payment_status='Received' order by pc.id desc"; 
                 $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date='" . $f_date .  "' and pc.payment_status='Received' group by pc.id order by pc.receive_date desc,tdr.id desc"; 
             }else if (!empty($to_date)) {
              //  $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.receive_date<='" . $to_date .  "' and pc.is_active=1 and pc.payment_status='Received' order by pc.id desc";  
                 $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date='" . $to_date .  "' and pc.payment_status='Received' group by pc.id order by pc.receive_date desc,tdr.id desc";  
             }else{
              //  $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.is_active=1 and pc.payment_status='Received' order by pc.id desc";   
              //$sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Received' order by pc.receive_date desc";      //17-10-2020
              //   $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Received' group by pc.id order by pc.receive_date desc,tdr.id desc";//18-10-2020
                if($user_category==2){ 
                    $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,
                    (select realization_date from tbl_deposit_realization  where collection_id=pc.id and realization_status='Honored' limit 1)
                    realization_date from tbl_payment_collections pc 
                    left join tbl_customers c on pc.customer_id=c.id 
                    left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                    where (pc.receive_date>='$prev_date' and pc.receive_date<='$currentDate') and $where and pc.payment_status='Received' group by pc.id order by pc.receive_date desc";
                }else{
                    $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,
                    (select realization_date from tbl_deposit_realization  where collection_id=pc.id and realization_status='Honored' limit 1)
                    realization_date from tbl_payment_collections pc 
                    left join tbl_customers c on pc.customer_id=c.id 
                    left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                    where $where and pc.payment_status='Received' group by pc.id order by pc.receive_date desc";
                }   
             }   
        }else{
           // $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.is_active=1 and pc.payment_status='Received' and pc.unit_id=" . $branch_id . ' order by pc.id desc';
           // $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where pc.is_active=1 and pc.payment_status='Received' group by pc.id order by pc.receive_date desc,tdr.id desc";//18-10-2020
            if($user_category==2){ 
                $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name,
                (select realization_date 
                from tbl_deposit_realization  where collection_id=pc.id and realization_status='Honored' limit 1) 
                realization_date from tbl_payment_collections pc 
                left join tbl_customers c on pc.customer_id=c.id 
                left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                where (pc.receive_date>='$prev_date' and pc.receive_date<='$currentDate') and pc.is_active=1 and pc.payment_status='Received' 
                group by pc.id order by pc.receive_date desc";
            }else{
                $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name,
                (select realization_date from tbl_deposit_realization  where collection_id=pc.id and realization_status='Honored' limit 1) 
                realization_date from tbl_payment_collections pc 
                left join tbl_customers c on pc.customer_id=c.id 
                left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                where pc.is_active=1 and pc.payment_status='Received' group by pc.id order by pc.receive_date desc"; 

            }
            $data['f_date'] = $f_date = '';
            $data['to_date'] = $to_date = '';
        }
        $data['collections'] = $this->m_common->customeQuery($sql);
        
        
        $this->load->view('payment_collections/v_payment_received', $data);
    }
    
    
    function allCollectionAndRealization(){
        $branch_id = $this->session->userdata('companyId');
        $user_category= $this->session->userdata('user_category');
        $show_data_info=$this->m_common->get_row_array('tbl_show_data_setting','','*');
        $currentDate=date('Y-m-d');
        $prev_date = date('Y-m-d', strtotime($currentDate .' -'.$show_data_info['0']['day'].' days'));
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_collection_deposit_realization';
        $this->titlebackend("Payment Collections And Deposit and Realization");
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories','','*');
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        // $data['quotations']=$this->m_common->get_row_array('tbl_sales_quotation
        // $sql="select pc.*,so.order_no,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_sales_orders so on pc.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where pc.is_active=1";
        $postData = $this->input->post();
        $where = '';
      //  $where = "pc.unit_id=$branch_id";
      //  $where = "pc.is_active=1 and dr.is_active=1";
        $where = "pc.is_active=1";
        if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = '';
                $data['to_date'] = '';
                $f_date = '';
                $to_date = '';
            }
            
            
             if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['collection_method'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }

             if(!empty($f_date) & !empty($to_date)){
              //  $sql = "select pc.*,c.c_name,c_short_name,dr.deposit_date,dr.realization_status,dr.realization_date from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and pc.is_active=1 order by pc.id desc";
              //   $sql = "select pc.*,c.c_name,c_short_name,dr.deposit_date,dr.realization_status,dr.realization_date,tpc.category_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' group by pc.id order by pc.receive_date desc,dr.realization_date";//18-10-2020
                if($user_category==2){ 
                    $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name,(select realization_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_date,(select deposit_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)deposit_date,(select realization_status from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_status from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $prev_date . "' and pc.receive_date<='" . $currentDate . "' group by pc.id order by pc.receive_date desc,dr.realization_date"; 
                }else{
                    $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name,(select realization_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_date,(select deposit_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)deposit_date,(select realization_status from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_status from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' group by pc.id order by pc.receive_date desc,dr.realization_date";
                }  
             }else if (!empty($f_date)) {
               // $sql = "select pc.*,c.c_name,c_short_name,dr.deposit_date,dr.realization_status,dr.realization_date from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id where $where and pc.receive_date>='" . $f_date .  "' and pc.is_active=1 order by pc.id desc"; 
                $sql = "select pc.*,c.c_name,c_short_name,dr.deposit_date,dr.realization_status,dr.realization_date,tpc.category_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date='" . $f_date .  "' group by pc.id order by pc.receive_date desc,dr.realization_date";
             }else if (!empty($to_date)) {
              //  $sql = "select pc.*,c.c_name,c_short_name,dr.deposit_date,dr.realization_status,dr.realization_date from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id where $where and pc.receive_date<='" . $to_date .  "' and pc.is_active=1 order by pc.id desc";  
                $sql = "select pc.*,c.c_name,c_short_name,dr.deposit_date,dr.realization_status,dr.realization_date,tpc.category_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date='" . $to_date .  "' group by pc.id order by pc.receive_date desc,dr.realization_date"; 
             }else{
              //  $sql = "select pc.*,c.c_name,c_short_name,dr.deposit_date,dr.realization_status,dr.realization_date from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id where $where and pc.is_active=1 order by pc.id desc";  
                // $sql = "select pc.*,c.c_name,c_short_name,dr.deposit_date,dr.realization_status,dr.realization_date,tpc.category_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where group by pc.id order by pc.receive_date desc,dr.realization_date"; 
                if($user_category==2){ 
                    $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name,
                    (select realization_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_date,
                    (select deposit_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)deposit_date,
                    (select realization_status from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_status 
                    from tbl_payment_collections pc 
                    left join tbl_customers c on pc.customer_id=c.id 
                    left join tbl_deposit_realization dr on pc.id=dr.collection_id 
                    left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                    where (pc.receive_date>='$prev_date' and pc.receive_date<='$currentDate') and $where group by pc.id order by pc.receive_date desc,dr.realization_date"; 
                }else{
                    $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name,(select realization_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_date,(select deposit_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)deposit_date,(select realization_status from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_status from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where group by pc.id order by pc.receive_date desc,dr.realization_date";
                }  
                 
             }   
        }else{
          //  $sql = "select pc.*,c.c_name,c_short_name,dr.deposit_date,dr.realization_status,dr.realization_date from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id where pc.is_active=1  and pc.unit_id=" . $branch_id . ' order by pc.id desc';
          //  $sql = "select pc.*,c.c_name,c_short_name,dr.deposit_date,dr.realization_status,dr.realization_date,tpc.category_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where pc.is_active=1 group by pc.id order by pc.receive_date desc,dr.realization_date";//18-10-2020
            if($user_category==2){ 
                $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name,
                (select realization_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_date,
                (select deposit_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)deposit_date,
                (select realization_status from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_status 
                from tbl_payment_collections pc 
                left join tbl_customers c on pc.customer_id=c.id 
                left join tbl_deposit_realization dr on pc.id=dr.collection_id 
                left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                where (pc.receive_date>='$prev_date' and pc.receive_date<='$currentDate') and pc.is_active=1 group by pc.id order by pc.receive_date desc,dr.realization_date";
            }else{
                $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name,(select realization_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_date,(select deposit_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)deposit_date,(select realization_status from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_status from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where pc.is_active=1 group by pc.id order by pc.receive_date desc,dr.realization_date";
            }  
            $data['f_date'] = $from_date = '';
            $data['to_date'] = $too_date = '';
        }
        $data['collections'] = $this->m_common->customeQuery($sql);
        $this->load->view('payment_collections/v_payment_collection_realization', $data); 
    }

    function collection_voucher($c_id) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_collection';
        $this->titlebackend("Payment Collections");
        // $data['quotations']=$this->m_common->get_row_array('tbl_sales_quotation
        // $sql="select pc.*,so.order_no,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_sales_orders so on pc.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where pc.is_active=1";
        $sql = "select pc.*,so.order_no,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_sales_orders so on pc.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where pc.is_active=1 and pc.payment_status='Received' and pc.unit_id=" . $branch_id;
        $data['collections'] = $this->m_common->customeQuery($sql);
        $data['collections_info'] = $this->m_common->get_row_array('tbl_payment_collections', array('id' => $c_id), '*');

        $this->load->view('payment_collections/v_collection_voucher', $data);
    }
    
    
    function returnPayment() {
        $this->setOutputMode(NORMAL);        
        $collection_id = $this->input->post('collection_id');
        $return_reason = $this->input->post('return_reason');            
        $res = $this->m_common->update_row('tbl_payment_collections', array('id' =>$collection_id), array('payment_status' =>"Returned",'return_reason'=>$return_reason,'return_date'=>date('Y-m-d')));
        $data['status'] = 'success';       
        echo json_encode($data);
    }
    
    function updateBankDate(){
        $this->setOutputMode(NORMAL);        
        $collection_id = $this->input->post('collection_id');
        $bank_date=$this->input->post('bank_deposit_date');
        $bank_deposit_date =date('Y-m-d',strtotime( $bank_date));            
        $res = $this->m_common->update_row('tbl_payment_collections',array('id' =>$collection_id), array('bank_deposit_date' =>$bank_deposit_date));
        $data['status'] = 'success';       
        echo json_encode($data);
    }

    function confirmDeposit(){
        $this->setOutputMode(NORMAL);        
        $collection_id = $this->input->post('collection_id');
        $bank_id=$this->input->post('bank_id');   
        $priority=$this->input->post('priority'); 


        $pre_deposit=$this->m_common->get_row_array('tbl_deposit_realization', array('collection_id' =>$collection_id,'realization_status' =>"Deposited", 'is_active' => 1), '*');
        if(!empty($pre_deposit)){
            $data['status'] = 'failed';       
            echo json_encode($data);
        }


        $collection_info=$this->m_common->get_row_array('tbl_payment_collections',array('id' =>$collection_id),'*');
        
        $insertData = array();


        if(!empty($collection_info[0]['bank_deposit_date'])){
            $insertData['deposit_date'] =$collection_info[0]['bank_deposit_date'];
        }else{
            $insertData['deposit_date'] =$collection_info[0]['check_date']; 
        }


        $insertData['collection_id']=$collection_id;
        $insertData['bank_id'] =$bank_id;
        $insertData['priority'] =$priority;
        $insertData['is_active'] =1;
        $insertData['realization_status'] ="Deposited";

        $result=$this->m_common->insert_row('tbl_deposit_realization',$insertData);
        if(!empty($result)){
            $res=$this->m_common->update_row('tbl_payment_collections',array('id'=>$collection_id),array('payment_status'=>"Deposited"));
        }


        $data['status'] = 'success';       
        echo json_encode($data);
    }

    

}
