<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Deposit_realization extends Site_Controller {

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
        $this->sub_menu = 'deposit_realization';
        $this->titlebackend("Deposit Realization");
        
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories','','*');
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');       
        $postData = $this->input->post();
        $where = '';
       // $where = "dr.unit_id=$branch_id";
        $where = "dr.is_active=1";
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
               
              //  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where $where and dr.deposit_date>='" . $f_date . "' and dr.deposit_date<='" . $to_date . "' and dr.is_active=1 and dr.realization_status='Deposited' order by dr.deposit_date DESC";
                if($user_category==2){ 
                    $sql = "select dr.*,pc.check_date,pc.bg_issue_date,pc.po_date,
                    pc.lc_date,pc.mrr_no,pc.remark as c_remark,
                    pc.collection_method,pc.collection_method,pc.amount,
                    pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,
                    c_short_name,tpc.category_name 
                    from tbl_deposit_realization dr 
                    left join tbl_payment_collections pc on dr.collection_id=pc.id 
                    left join tbl_banks b on dr.bank_id=b.id 
                    left join tbl_sales_orders tso on pc.o_id=tso.o_id 
                    left join tbl_customers tc on pc.customer_id=tc.id 
                    left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                    where $where and dr.deposit_date>='" . $prev_date . "' and dr.deposit_date<='" . $currentDate . "' and dr.realization_status='Deposited' order by dr.deposit_date DESC";
                }else{
                    $sql = "select dr.*,pc.check_date,pc.bg_issue_date,pc.po_date,pc.lc_date,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.deposit_date>='" . $f_date . "' and dr.deposit_date<='" . $to_date . "' and dr.realization_status='Deposited' order by dr.deposit_date DESC";
                }   
             }else if (!empty($f_date)) {
              //  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where $where and dr.deposit_date>='".$f_date."' and dr.is_active=1 and dr.realization_status='Deposited' order by dr.deposit_date DESC";
                $sql = "select dr.*,pc.check_date,pc.bg_issue_date,pc.po_date,pc.lc_date,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.deposit_date='".$f_date."' and dr.realization_status='Deposited' order by dr.deposit_date DESC";
             }else if (!empty($to_date)) {
               // $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where $where and dr.deposit_date<='" . $to_date . "' and dr.is_active=1 and dr.realization_status='Deposited' order by dr.deposit_date DESC";
                $sql = "select dr.*,pc.check_date,pc.bg_issue_date,pc.po_date,pc.lc_date,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.deposit_date='" . $to_date . "' and dr.realization_status='Deposited' order by dr.deposit_date DESC";
             }else{
                // $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where $where and dr.is_active=1 and dr.realization_status='Deposited' order by dr.deposit_date DESC";
                if($user_category==2){ 
                    $sql = "select dr.*,pc.check_date,pc.bg_issue_date,pc.po_date,
                    pc.lc_date,pc.mrr_no,pc.remark as c_remark,pc.collection_method,
                    pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,
                    b.branch_name,tc.c_name,c_short_name,tpc.category_name 
                    from tbl_deposit_realization dr 
                    left join tbl_payment_collections pc on dr.collection_id=pc.id 
                    left join tbl_banks b on dr.bank_id=b.id 
                    left join tbl_sales_orders tso on pc.o_id=tso.o_id 
                    left join tbl_customers tc on pc.customer_id=tc.id 
                    left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                    where (dr.deposit_date>='$prev_date' and dr.deposit_date<='$currentDate') and $where and dr.realization_status='Deposited' order by dr.deposit_date DESC";
                }else{
                    $sql = "select dr.*,pc.check_date,pc.bg_issue_date,pc.po_date,pc.lc_date,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_status='Deposited' order by dr.deposit_date DESC";
                } 
             }   
        }else{
          //  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where dr.is_active=1 and dr.realization_status='Deposited' and dr.unit_id=" . $branch_id." order by dr.deposit_date DESC";
            if($user_category==2){ 
                $sql = "select dr.*,pc.check_date,pc.bg_issue_date,
                pc.po_date,pc.lc_date,pc.mrr_no,pc.remark as c_remark,
                pc.collection_method,pc.collection_method,pc.amount,
                pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,
                c_short_name,tpc.category_name from tbl_deposit_realization dr 
                left join tbl_payment_collections pc on dr.collection_id=pc.id 
                left join tbl_banks b on dr.bank_id=b.id 
                left join tbl_sales_orders tso on pc.o_id=tso.o_id 
                left join tbl_customers tc on pc.customer_id=tc.id 
                left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                where (dr.deposit_date>='$prev_date' and dr.deposit_date<='$currentDate') and dr.is_active=1 and dr.realization_status='Deposited' order by dr.deposit_date DESC";
            }else{
                $sql = "select dr.*,pc.check_date,pc.bg_issue_date,pc.po_date,pc.lc_date,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where dr.is_active=1 and dr.realization_status='Deposited' order by dr.deposit_date DESC";                
            } 
             
            $data['f_date'] = $from_date = '';
            $data['to_date'] = $too_date = '';
        }
        
        $data['deposits'] = $this->m_common->customeQuery($sql);
        $this->load->view('deposit_realization/v_deposit_realization', $data);
    }

    function add_deposit() {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'deposit_realization';
        $this->titlebackend("Deposit");
        $data['bank_branches']=$this->m_common->get_row_array('tbl_bank_branch',array('is_active'=>1),'*');
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
        $data['banks'] = $this->m_common->get_row_array('tbl_banks', array('is_active' => 1,'b_identification'=>"Self"), '*');

//        $data['banks'] = $this->m_common->get_row_array('tbl_banks', array('is_active' =>1), '*');
//        $bank_sql="select * from tbl_banks where b_identification!='Customer' and is_active=1";
//        $data['banks'] = $this->m_common->customeQuery($bank_sql);
        //  $data['collections']=$this->m_common->get_row_array('tbl_payment_collections',array('is_active'=>1,'payment_status'=>"Pending",'collection_method !='=>"Cash"),'*'); 
        //  $data['collections']=$this->m_common->get_row_array('tbl_payment_collections',array('is_active'=>1,'payment_status'=>"Collected",'collection_method !='=>"Cash",'unit_id'=>$branch_id),'*'); 
    //    $sql = "select tpc.*,tc.c_name,c_short_name from tbl_payment_collections tpc left join tbl_sales_orders tso on tpc.o_id=tso.o_id left join tbl_customers tc on tso.customer_id=tc.id where tpc.is_active=1 and tpc.collection_method!='Cash' and tpc.payment_status='Collected' and tpc.unit_id=" . $branch_id;
        $sql = "select tpc.*,tc.c_name,c_short_name from tbl_payment_collections tpc left join tbl_sales_orders tso on tpc.o_id=tso.o_id left join tbl_customers tc on tso.customer_id=tc.id where tpc.is_active=1 and tpc.collection_method!='Cash' and tpc.payment_status='Collected'";
        $data['collections'] = $this->m_common->customeQuery($sql);
        
        foreach ($data['customers'] as $key => $value){
            $collection_info = array();
        //    $collection_sql = "select tpc.*,tc.c_name,c_short_name from tbl_payment_collections tpc left join tbl_sales_orders tso on tpc.o_id=tso.o_id left join tbl_customers tc on tso.customer_id=tc.id where tpc.is_active=1 and tpc.collection_method!='Cash' and tpc.payment_status='Collected' and tpc.unit_id=" . $branch_id." and tso.customer_id=". $value['id'];
        //    $collection_sql = "select tpc.*,tc.c_name,c_short_name from tbl_payment_collections tpc left join tbl_sales_orders tso on tpc.o_id=tso.o_id left join tbl_customers tc on tso.customer_id=tc.id where tpc.is_active=1 and tpc.collection_method!='Cash' and tpc.payment_status='Collected' and tpc.unit_id=" . $branch_id." and tpc.customer_id=". $value['id'];
        //    $collection_sql = "select tpc.*,tc.c_name,c_short_name from tbl_payment_collections tpc left join tbl_sales_orders tso on tpc.o_id=tso.o_id left join tbl_customers tc on tso.customer_id=tc.id where tpc.is_active=1 and (tpc.collection_method!='Cash') and tpc.payment_status='Collected' and tpc.customer_id=". $value['id']; //22-09-2020
             $collection_sql = "select tpc.*,tc.c_name,c_short_name from tbl_payment_collections tpc left join tbl_sales_orders tso on tpc.o_id=tso.o_id left join tbl_customers tc on tso.customer_id=tc.id where tpc.is_active=1 and (tpc.collection_method!='Cash') and (tpc.payment_status='Collected' || tpc.payment_status='Dishonored') and tpc.customer_id=". $value['id'];
        
            $collection_info = $this->m_common->customeQuery($collection_sql);
            if (empty($collection_info)){
                unset($data['customers'][$key]);
            } 
        }
        
        $this->load->view('deposit_realization/v_add_deposit', $data);
    }

     function collection_info() {
        $this->setOutputMode(NORMAL);
        $customer_id = $this->input->post('customer_id');
     // $sql = "select tpc.*,tc.c_name,c_short_name from tbl_payment_collections tpc left join tbl_sales_orders tso on tpc.o_id=tso.o_id left join tbl_customers tc on tso.customer_id=tc.id where tpc.is_active=1 and tpc.collection_method!='Cash' and tpc.payment_status='Collected' and tso.customer_id=".$customer_id;
        $sql = "select tpc.*,tc.c_name,c_short_name from tbl_payment_collections tpc left join tbl_sales_orders tso on tpc.o_id=tso.o_id left join tbl_customers tc on tpc.customer_id=tc.id where tpc.is_active=1 and (tpc.collection_method='Pdc' || tpc.collection_method='Bg' || tpc.collection_method='Lc' || tpc.collection_method='Po') and (tpc.payment_status='Collected' || tpc.payment_status='Dishonored') and tpc.customer_id=".$customer_id;
        $data['collections'] = $this->m_common->customeQuery($sql);
        
        
        
        foreach($data['collections'] as $key=>$value){
            if($data['collections'][$key]['collection_method'] == "Pdc"){
                if($data['collections'][$key]['check_date']!=null){
                    $data['collections'][$key]['check_date']=date('d-m-Y',strtotime($data['collections'][$key]['check_date']));
                }

                if($data['collections'][$key]['bank_deposit_date']!=null){
                    $data['collections'][$key]['bank_deposit_date']=date('d-m-Y',strtotime($data['collections'][$key]['bank_deposit_date']));
                }
                
            }else if($data['collections'][$key]['collection_method'] == "Po"){
                if($data['collections'][$key]['po_date']!=null){
                    $data['collections'][$key]['po_date'] =date('d-m-Y',strtotime($data['collections'][$key]['po_date']));
                }
            }else if($data['collections'][$key]['collection_method'] == "Bg"){
                if($data['collections'][$key]['bg_expire_date']!=null){
                    $data['collections'][$key]['bg_expire_date'] =date('d-m-Y',strtotime($data['collections'][$key]['bg_expire_date']));
                }
            }else if($data['collections'][$key]['collection_method'] == "Lc"){
                if($data['collections'][$key]['lc_date']!=null){
                    $data['collections'][$key]['lc_date'] =date('d-m-Y',strtotime($data['collections'][$key]['lc_date']));
                }
            }
            
        }
        echo json_encode($data);
    }
    
    function add_deposit_action(){
        $branch_id=$this->session->userdata('companyId');
        $postData =$this->input->post();
        if(!empty($postData)){
            if(empty($postData['collection_id'])){
                redirect_with_msg('deposit_realization/add_deposit', 'Please select at least one pdc/Bg/Lc');
            }
                     
            foreach($postData['collection_id'] as $key=>$value){
                $insertData = array();
                $pre_deposit='';
                $pre_deposit=$this->m_common->get_row_array('tbl_deposit_realization', array('collection_id' =>$value,'realization_status' =>"Deposited", 'is_active' => 1), '*');
                if(!empty($pre_deposit)){
                    continue;
                }
                if(!empty($postData['deposit_date'])){
                    $insertData['deposit_date'] = date('Y-m-d', strtotime($postData['deposit_date']));
                }
                if(!empty($postData['remark'])){
                    $insertData['remark'] = $postData['remark'];
                }
                if (!empty($postData['bank_id'])) {
                    $insertData['bank_id'] = $postData['bank_id'];
                }
                $insertData['collection_id']=$value;
                $insertData['unit_id']=$branch_id;
                $insertData['is_active']=1;
                $insertData['realization_status']='Deposited';

                $insertData['priority']=$postData['priority'][$key];



                $result=$this->m_common->insert_row('tbl_deposit_realization',$insertData);
                if(!empty($result)){
                    $res=$this->m_common->update_row('tbl_payment_collections', array('id' =>$value),array('payment_status'=>"Deposited"));
                }
            }
            if (!empty($result)) {
                redirect_with_msg('deposit_realization', 'Successfully Inserted');
            }
        } else {
            redirect_with_msg('deposit_realization/add_deposit', 'Please fill the form and submit');
        }
    }
    
    
    function add_deposit_action_() {
        $branch_id = $this->session->userdata('companyId');
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            if (!empty($postData['collection_id'])) {
                $insertData['collection_id'] = $postData['collection_id'];
                $pre_deposit = $this->m_common->get_row_array('tbl_deposit_realization', array('collection_id' => $postData['collection_id'], 'realization_status' =>"Deposited", 'is_active' => 1), '*');
                if (!empty($pre_deposit)) {
                    redirect_with_msg('deposit_realization/add_deposit', 'This collection already exists');
                } else {
                    $pre_deposit_info = $this->m_common->get_row_array('tbl_deposit_realization', array('collection_id' => $postData['collection_id'], 'realization_status' => "Dishonored", 'is_active' => 1), '*');
                    if (count($pre_deposit_info) == 3) {
                        redirect_with_msg('deposit_realization/add_deposit', 'You are not able to deposit more than three times');
                    }
                }
            }
            if (!empty($postData['deposit_date'])) {
                $insertData['deposit_date'] = date('Y-m-d', strtotime($postData['deposit_date']));
            }

            if (!empty($postData['remark'])) {
                $insertData['remark'] = $postData['remark'];
            }
            if (!empty($postData['bank_id'])) {
                $insertData['bank_id'] = $postData['bank_id'];
            }
            
            if (!empty($postData['bank_branch_id'])) {
                $insertData['bank_branch_id'] = $postData['bank_branch_id'];
            }
            
            $insertData['unit_id'] = $branch_id;
            $insertData['is_active'] = 1;
            // $insertData['realization_status']='Pending';
            $insertData['realization_status'] = 'Deposited';
            $result = $this->m_common->insert_row('tbl_deposit_realization', $insertData);
            if (!empty($result)) {
                redirect_with_msg('deposit_realization', 'Successfully Inserted');
            }
        } else {
            redirect_with_msg('deposit_realization/add_deposit', 'Please fill the form and submit');
        }
    }

    function edit_deposit($id) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'deposit_realization';
        $this->titlebackend("Deposit");
        $data['bank_branches']=$this->m_common->get_row_array('tbl_bank_branch',array('is_active'=>1),'*');
        //$data['banks'] = $this->m_common->get_row_array('tbl_banks', array('is_active' => 1), '*');
        $data['banks'] = $this->m_common->get_row_array('tbl_banks', array('is_active' => 1,'b_identification'=>"Self"), '*');
        $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id where dr.is_active=1 and dr.id=" . $id;
        $data['deposit_info'] = $this->m_common->customeQuery($sql);
        // $data['collections']=$this->m_common->get_row_array('tbl_payment_collections',array('is_active'=>1,'unit_id'=>$branch_id),'*');
        $sql1 = "select tpc.*,tc.c_name,c_short_name from tbl_payment_collections tpc left join tbl_sales_orders tso on tpc.o_id=tso.o_id left join tbl_customers tc on tso.customer_id=tc.id where tpc.is_active=1 and tpc.collection_method!='Cash' and tpc.payment_status!='Returned'";
        $data['collections'] = $this->m_common->customeQuery($sql1);
        $this->load->view('deposit_realization/v_edit_deposit', $data);
    }

    function edit_deposit_action($id) {
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            if (!empty($postData['collection_id'])) {
                $insertData['collection_id'] = $postData['collection_id'];
            }
            if (!empty($postData['deposit_date'])) {
                $insertData['deposit_date'] = date('Y-m-d', strtotime($postData['deposit_date']));
            }

            if (!empty($postData['remark'])) {
                $insertData['remark'] = $postData['remark'];
            }


            if (!empty($postData['priority'])) {
                $insertData['priority'] = $postData['priority'];
            }


            if (!empty($postData['bank_id'])) {
                $insertData['bank_id'] = $postData['bank_id'];
            }
            
            if(!empty($postData['bank_branch_id'])){
                $insertData['bank_branch_id'] = $postData['bank_branch_id'];
            }
            
            $result = $this->m_common->update_row('tbl_deposit_realization', array('id' => $id), $insertData);
            if ($result >= 0) {
                redirect_with_msg('deposit_realization', 'Successfully Updated');
            }
        } else {
            redirect_with_msg('deposit_realization/edit_deposit/' . $id, 'Please fill the form and submit');
        }
    }

    function delete_deposit($id){
        if(!empty($id)){
            $deposit_info=$this->m_common->get_row_array('tbl_deposit_realization',array('id'=>$id),'*');
            $col_info=$this->m_common->get_row_array('tbl_payment_collections',array('id'=>$deposit_info[0]['collection_id']),'*');
            $dishonor_info=$this->m_common->get_row_array('tbl_deposit_realization',array('collection_id'=>$deposit_info[0]['collection_id'],'realization_status'=>"Dishonored"));
            $count=count($dishonor_info);
            $id=$this->m_common->update_row('tbl_deposit_realization',array('id' =>$id),array('is_active'=>0));
            if(!empty($id)){
                if($count>0){
                    $this->m_common->update_row('tbl_payment_collections',array('id'=>$deposit_info[0]['collection_id']),array('payment_status'=>'Dishonored'));
                }else{
                    $this->m_common->update_row('tbl_payment_collections',array('id'=>$deposit_info[0]['collection_id']),array('payment_status'=>'Collected'));
                }
                redirect_with_msg('deposit_realization/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('deposit_realization/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('deposit_realization/index', 'Please click on delete button');
        }
    }

    function get_collection_info() {
        $this->setOutputMode(NORMAL);
        $id =$this->input->post('id');
        $sql ="select pc.*,b.b_name,b.branch_name,b.b_short_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id where  pc.id=".$id;
        $data['collection_info']= $this->m_common->customeQuery($sql);
        
        if($data['collection_info'][0]['collection_method'] == "Pdc"){
            $data['collection_info'][0]['check_date'] = date('d-m-Y',strtotime($data['collection_info'][0]['check_date']));
        } else if ($data['collection_info'][0]['collection_method'] == "Po") {
            $data['collection_info'][0]['po_date'] = date('d-m-Y',strtotime($data['collection_info'][0]['po_date']));
        }else if($data['collection_info'][0]['collection_method'] == "Bg") {
            $data['collection_info'][0]['bg_expire_date'] = date('d-m-Y',strtotime($data['collection_info'][0]['bg_expire_date']));
        }else if($data['collection_info'][0]['collection_method'] == "Lc") {
            $data['collection_info'][0]['lc_date'] = date('d-m-Y',strtotime($data['collection_info'][0]['lc_date']));
        }
        
        
        
        echo json_encode($data);
    }

    function realization() {
        $this->setOutputMode(NORMAL);
        $honor_status=$this->input->post('honor_status');
        $deposit_id=$this->input->post('deposit_id');
        $realization_date=$this->input->post('realization_date');
        if($honor_status=='honor'){
            $result=$this->m_common->update_row('tbl_deposit_realization', array('id' => $deposit_id), array('realization_status' => "Honored", 'realization_date' => date('Y-m-d', strtotime($realization_date))));
            if($result>=0){
                $deposit_info = $this->m_common->get_row_array('tbl_deposit_realization', array('id' => $deposit_id), '*');
                $collection_info = $this->m_common->get_row_array('tbl_payment_collections', array('id' => $deposit_info[0]['collection_id']), '*');
                $customer_info = $this->m_common->get_row_array('tbl_customers', array('id' => $collection_info[0]['customer_id']), '*');
                $res = $this->m_common->update_row('tbl_payment_collections', array('id' => $deposit_info[0]['collection_id']), array('payment_status' =>"Received"));
                if($customer_info[0]['deposit']==NULL){
                    $sql="update tbl_customers set deposit=".$collection_info[0]['amount']. " where id=" . $collection_info[0]['customer_id'];
                }else{
                    $sql="update tbl_customers set deposit=deposit+".$collection_info[0]['amount']. " where id=" . $collection_info[0]['customer_id'];
                }
                $this->m_common->customeUpdate($sql);
                $data['status'] = 'success';
            }
        }else{
            $deposit_info = $this->m_common->get_row_array('tbl_deposit_realization', array('id' => $deposit_id), '*');
            $result=$this->m_common->update_row('tbl_deposit_realization',array('id' =>$deposit_id),array('realization_status' =>"Dishonored",'realization_date' =>date('Y-m-d',strtotime($realization_date))));
            $res = $this->m_common->update_row('tbl_payment_collections', array('id' => $deposit_info[0]['collection_id']), array('payment_status'=>"Dishonored",'dishonor_date'=>date('Y-m-d',strtotime($realization_date))));
            if ($result >= 0){
                $data['status'] = 'success';
            }
        }
        echo json_encode($data);
    }

    function realization_05_08_2019() {
        $this->setOutputMode(NORMAL);
        $honor_status = $this->input->post('honor_status');
        $deposit_id = $this->input->post('deposit_id');
        $realization_date = $this->input->post('realization_date');
        if ($honor_status == 'honor') {
            $result = $this->m_common->update_row('tbl_deposit_realization', array('id' => $deposit_id), array('realization_status' => "Honored", 'realization_date' => date('Y-m-d', strtotime($realization_date))));
            if ($result >= 0) {
                $deposit_info = $this->m_common->get_row_array('tbl_deposit_realization', array('id' => $deposit_id), '*');
                $collection_info = $this->m_common->get_row_array('tbl_payment_collections', array('id' => $deposit_info[0]['collection_id']), '*');
                $order_info = $this->m_common->get_row_array('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), '*');
                $payment_condition = $this->m_common->get_row_array('tbl_sales_order_payment_condition', array('o_id' => $collection_info[0]['o_id']), '*');

                $this->m_common->update_row('tbl_payment_collections', array('id' => $deposit_info[0]['collection_id']), array('payment_status' => "Received"));

                $approve = 'Approved';
                if ($payment_condition[0]['b_cash'] == "Cash") {
                    $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Cash' and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                    $total_cash_collection = $this->m_common->customeQuery($sql);
                    if ($total_cash_collection[0]['total'] >= $payment_condition[0]['b_cash_amount']) {
                        
                    } else {
                        $approve = 'Pending';
                    }
                }

                if ($payment_condition[0]['b_bg'] == "Bg") {
                    $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Bg' and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                    $total_bg_collection = $this->m_common->customeQuery($sql);
                    if ($total_bg_collection[0]['total'] >= $payment_condition[0]['b_bg_amount']) {
                        
                    } else {
                        $approve = 'Pending';
                    }
                }

                if ($payment_condition[0]['b_pdc'] == "Pdc") {
                    if ($payment_condition[0]['b_pdc_condition'] == "Collection") {
                        $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Pdc' and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                    } else {
                        $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Pdc' and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                    }
                    $total_pdc_collection = $this->m_common->customeQuery($sql);
                    if ($total_pdc_collection[0]['total'] >= $payment_condition[0]['b_pdc_amount']) {
                        
                    } else {
                        $approve = 'Pending';
                    }
                }

                if ($payment_condition[0]['b_lc'] == "Lc") {
                    if ($payment_condition[0]['b_lc_condition'] == "Collection") {
                        $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Lc' and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                    } else {
                        $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Lc' and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                    }
                    $total_lc_collection = $this->m_common->customeQuery($sql);
                    if ($total_lc_collection[0]['total'] >= $payment_condition[0]['b_lc_amount']) {
                        
                    } else {
                        $approve = 'Pending';
                    }
                }

                $this->m_common->update_row('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), array('status' => $approve));

                $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                $total_collection = $this->m_common->customeQuery($sql);

                if ($total_collection[0]['total'] == $order_info[0]['total_amount']) {
                    $this->m_common->update_row('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), array('receive_status' => "Received"));
                } else {
                    $this->m_common->update_row('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), array('receive_status' => "Partial Received"));
                }

                $data['status'] = 'success';
            }
        } else {
            $result = $this->m_common->update_row('tbl_deposit_realization', array('id' => $deposit_id), array('realization_status' => "Dishonored", 'realization_date' => date('Y-m-d', strtotime($realization_date))));
            if ($result >= 0) {
                $data['status'] = 'success';
            }
        }
        echo json_encode($data);
    }

    function realization_pre() {
        $this->setOutputMode(NORMAL);
        $honor_status = $this->input->post('honor_status');
        $deposit_id = $this->input->post('deposit_id');
        $realization_date = $this->input->post('realization_date');
        if ($honor_status == 'honor') {
            $result = $this->m_common->update_row('tbl_deposit_realization', array('id' => $deposit_id), array('realization_status' => "Honored", 'realization_date' => date('Y-m-d', strtotime($realization_date))));
            if ($result >= 0) {
                $deposit_info = $this->m_common->get_row_array('tbl_deposit_realization', array('id' => $deposit_id), '*');
                $collection_info = $this->m_common->get_row_array('tbl_payment_collections', array('id' => $deposit_info[0]['collection_id']), '*');
                $order_info = $this->m_common->get_row_array('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), '*');
                $sales_payment_condition = $this->m_common->get_row_array('tbl_sales_order_payment_condition', array('o_id' => $collection_info[0]['o_id']), '*');
                $total_condition_amount = $sales_payment_condition[0]['b_cash_amount'] + $sales_payment_condition[0]['b_bg_amount'] + $sales_payment_condition[0]['b_lc_amount'];
                $this->m_common->update_row('tbl_payment_collections', array('id' => $deposit_info[0]['collection_id']), array('payment_status' => "Received"));
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

                $data['status'] = 'success';
            }
        } else {
            $result = $this->m_common->update_row('tbl_deposit_realization', array('id' => $deposit_id), array('realization_status' => "Dishonored", 'realization_date' => date('Y-m-d', strtotime($realization_date))));
            if ($result >= 0) {
                $data['status'] = 'success';
            }
        }
        echo json_encode($data);
    }

    function realized_cheque_bg_lc() {
        $branch_id = $this->session->userdata('companyId');
        $user_category= $this->session->userdata('user_category');
        $show_data_info=$this->m_common->get_row_array('tbl_show_data_setting','','*');
        $currentDate=date('Y-m-d');
        $prev_date = date('Y-m-d', strtotime($currentDate .' -'.$show_data_info['0']['day'].' days'));
        $this->menu = 'sales';
        $this->sub_menu = 'realized_cheque_bg_lc';
        $this->titlebackend("Realized Cheque List");
        
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories','','*');
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');       
        $postData = $this->input->post();
        $where = '';
       // $where = "dr.unit_id=$branch_id";
        $where = "dr.is_active=1";
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
               // $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where $where and dr.deposit_date>='" . $f_date . "' and dr.deposit_date<='" . $to_date . "' and dr.is_active=1 and dr.realization_status='Honored' order by dr.deposit_date DESC";
               if($user_category==2){ 
                    $sql = "select dr.*,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.deposit_date>='" . $prev_date . "' and dr.deposit_date<='" . $currentDate . "' and dr.realization_status='Honored' order by dr.deposit_date DESC";
               }else{
                    $sql = "select dr.*,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.deposit_date>='" . $f_date . "' and dr.deposit_date<='" . $to_date . "' and dr.realization_status='Honored' order by dr.deposit_date DESC";
               } 
             }else if (!empty($f_date)) {
              //  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where $where and dr.deposit_date>='".$f_date."' and dr.is_active=1 and dr.realization_status='Honored' order by dr.deposit_date DESC";
                 $sql = "select dr.*,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.deposit_date='".$f_date."' and dr.realization_status='Honored' order by dr.deposit_date DESC";
             }else if (!empty($to_date)) {
              //  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where $where and dr.deposit_date<='" . $to_date . "' and dr.is_active=1 and dr.realization_status='Honored' order by dr.deposit_date DESC";
                $sql = "select dr.*,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.deposit_date='" . $to_date . "' and dr.realization_status='Honored' order by dr.deposit_date DESC";
             }else{
               //  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where $where and dr.is_active=1 and dr.realization_status='Honored' order by dr.deposit_date DESC";
               if($user_category==2){ 
                    $sql = "select dr.*,pc.mrr_no,pc.remark as c_remark,
                    pc.collection_method,pc.collection_method,pc.amount,
                    pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,
                    c_short_name,tpc.category_name from tbl_deposit_realization dr 
                    left join tbl_payment_collections pc on dr.collection_id=pc.id 
                    left join tbl_banks b on dr.bank_id=b.id 
                    left join tbl_sales_orders tso on pc.o_id=tso.o_id 
                    left join tbl_customers tc on pc.customer_id=tc.id 
                    left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                    where (dr.deposit_date>='$prev_date' and dr.deposit_date<='$currentDate') and $where and dr.realization_status='Honored' order by dr.deposit_date DESC";
               }else{
                    $sql = "select dr.*,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_status='Honored' order by dr.deposit_date DESC";
               } 
             }   
        }else{
        //    $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id where dr.is_active=1 and dr.realization_status='Honored' and dr.unit_id=" . $branch_id." order by dr.deposit_date DESC";
            if($user_category==2){ 
                $sql = "select dr.*,pc.mrr_no,pc.remark as c_remark,pc.collection_method,
                pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,
                tc.c_name,c_short_name,tpc.category_name 
                from tbl_deposit_realization dr 
                left join tbl_payment_collections pc on dr.collection_id=pc.id 
                left join tbl_banks b on dr.bank_id=b.id 
                left join tbl_sales_orders tso on pc.o_id=tso.o_id 
                left join tbl_customers tc on pc.customer_id=tc.id 
                left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id 
                where (dr.deposit_date>='$prev_date' and dr.deposit_date<='$currentDate') and dr.is_active=1 and dr.realization_status='Honored' order by dr.deposit_date DESC";
            }else{
                $sql = "select dr.*,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where dr.is_active=1 and dr.realization_status='Honored' order by dr.deposit_date DESC";
            }
            $data['f_date'] = $from_date = '';
            $data['to_date'] = $too_date = '';
        }
        
        $data['deposits'] = $this->m_common->customeQuery($sql);
        $this->load->view('deposit_realization/v_realized_cheque', $data);
    }

    function return_deposit_action(){
        $branch_id = $this->session->userdata('companyId');
       $diposit_id = $this->input->post('diposit_id');
        $deposit_amount = $this->input->post('deposit_amount');
        $return_date = $this->input->post('return_date');
        $remarks = $this->input->post('remarks');
        $deporit_row = $this->m_common->get_row_array('tbl_deposit_realization',array('id'=>$diposit_id),'collection_id');
        $collection_id = $deporit_row[0]['collection_id'];
        //echo $deposit_amount;exit;
        $insertData = array();
        
            $insertData['collection_id'] = $collection_id;
            $insertData['deposit_id'] = $diposit_id;
            $insertData['return_amount'] = $deposit_amount;
            $insertData['return_date'] = date('Y-m-d',strtotime($return_date));
            $insertData['remark'] = $remarks;
            $insertData['branch_id'] = $branch_id;
            $insertData['created_date'] = date('Y-m-d');
            $id = $this->m_common->insert_row('tbl_payment_return', $insertData);
            if(!empty($id)){
                $this->m_common->update_row('tbl_deposit_realization',array('id'=>$diposit_id),array('realization_status'=>'Returned'));
                $res=$this->m_common->update_row('tbl_payment_collections',array('id'=>$collection_id),array('payment_status'=>"Collected"));  
            }
        redirect_with_msg('deposit_realization/index', 'Deposit Amount Returned successfully'); 
    }

}
