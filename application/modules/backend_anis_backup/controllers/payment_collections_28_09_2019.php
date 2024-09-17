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
        if(empty($this->company_id)){
             redirect_with_msg('backend/dashboard', 'Please click on enter here button to see this page');
        }
    }

    function index() {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_collection';
        $this->titlebackend("Payment Collections");
       // $data['quotations']=$this->m_common->get_row_array('tbl_sales_quotation
       // $sql="select pc.*,so.order_no,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_sales_orders so on pc.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where pc.is_active=1";
        $sql="select pc.*,so.order_no,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_sales_orders so on pc.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where pc.is_active=1 and pc.payment_status='Collected' and pc.unit_id=".$branch_id;
        $data['collections']=$this->m_common->customeQuery($sql);
        $this->load->view('payment_collections/v_payment_collection',$data);
    }

   
     function add_collection() {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_collection';
        $this->titlebackend("Payment Collections");
        $data['banks']=$this->m_common->get_row_array('tbl_banks',array('is_active'=>1),'*');
       // $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.receive_status!='Received' ";
        $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.receive_status!='Received' and so.unit_id=".$branch_id;
        $data['sale_orders']=$this->m_common->customeQuery($sql);
        $this->load->view('payment_collections/v_add_collection',$data);
    }
     function add_collection_action() {
         $branch_id= $this->session->userdata('companyId');
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             
             if(!empty($postData['o_id'])){
                 $insertData['o_id']=$postData['o_id'];
             }else{
                 redirect_with_msg('payment_collections/add_collection', 'Please select sales order');
             }
             
             $payment_condition=$this->m_common->get_row_array('tbl_sales_order_payment_condition',array('o_id'=>$postData['o_id']),'*');
             
             if(!empty($postData['amount'])){
                 $insertData['amount']=$postData['amount'];
                 $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and is_active=1 and o_id=".$postData['o_id'];
//                 $total_collection=$this->m_common->customeQuery($sql); 
//                 if($postData['amount']>=$total_collection[0]['total']){
//                    redirect_with_msg('payment_collections/add_collection', 'Already payment collected for this order');  
//                 }
             }
             if(!empty($postData['receive_date'])){
                 $insertData['receive_date']=date('Y-m-d',strtotime($postData['receive_date']));
             }
             
             if(!empty($postData['collection_method'])){
                 $insertData['collection_method']=$postData['collection_method'];
             }
             if($postData['collection_method']=="Cash"){
                  $insertData['collection_condition']="Collection";
             }else if($postData['collection_method']=="Pdc"){
                
                 if($payment_condition[0]['b_pdc_condition']=="Collection"){
                     $insertData['collection_condition']="Collection";
                 }else{
                     $insertData['collection_condition']="Realization";
                 }
                 $insertData['collection_condition']="Collection";
                 if(!empty($postData['check_no'])){
                       $insertData['check_no']=$postData['check_no'];
                       $insertData['no']=$postData['check_no'];
                  }
                  if(!empty($postData['check_date'])){
                    $insertData['check_date']=date('Y-m-d',strtotime($postData['check_date']));
                  }
                  
                  $pre_collection=$this->m_common->get_row_array('tbl_payment_collections',array('no'=>$postData['check_no']),'*');
                  if(!empty($pre_collection)){
                    redirect_with_msg('payment_collections/add_collection', 'Already This cheque  collected');
                  }
                  
             }else if($postData['collection_method']=="Po"){
                 if(!empty($postData['po_no'])){
                       $insertData['po_no']=$postData['po_no'];
                       $insertData['no']=$postData['po_no'];
                  }
                  if(!empty($postData['po_date'])){
                       $insertData['po_date']=date('Y-m-d',strtotime($postData['po_date']));
                  }
                  $pre_collection=$this->m_common->get_row_array('tbl_payment_collections',array('no'=>$postData['po_no']),'*');
                  if(!empty($pre_collection)){
                    redirect_with_msg('payment_collections/add_collection', 'Already This pay order  collected');
                  }
             }else if($postData['collection_method']=="Bg"){
                 $insertData['collection_condition']="Collection";
                 if(!empty($postData['bg_no'])){
                       $insertData['bg_no']=$postData['bg_no'];
                       $insertData['no']=$postData['bg_no'];
                 }
                 if(!empty($postData['tenor'])){
                       $insertData['tenor']=$postData['tenor'];
                 }
                  if(!empty($postData['bg_issue_date'])){
                       $insertData['bg_issue_date']=date('Y-m-d',strtotime($postData['bg_issue_date']));
                  }
                  if(!empty($postData['bg_expire_date'])){
                       $insertData['bg_expire_date']=date('Y-m-d',strtotime($postData['bg_expire_date']));
                  }
                  $pre_collection=$this->m_common->get_row_array('tbl_payment_collections',array('no'=>$postData['bg_no']),'*');
                  if(!empty($pre_collection)){
                    redirect_with_msg('payment_collections/add_collection', 'Already This Bg  collected');
                  }
             }else if($postData['collection_method']=="Lc"){
                 if($payment_condition[0]['b_lc_condition']=="Collection"){
                     $insertData['collection_condition']="Collection";
                 }else{
                     $insertData['collection_condition']="Realization";
                 }
                 if(!empty($postData['lc_no'])){
                       $insertData['lc_no']=$postData['lc_no'];
                       $insertData['no']=$postData['lc_no'];
                 }
                 if(!empty($postData['tenor'])){
                       $insertData['tenor']=$postData['tenor'];
                 }
                 if(!empty($postData['lc_date'])){
                       $insertData['lc_date']=date('Y-m-d',strtotime($postData['lc_date']));
                 }
                 $pre_collection=$this->m_common->get_row_array('tbl_payment_collections',array('no'=>$postData['lc_no']),'*');
                  if(!empty($pre_collection)){
                    redirect_with_msg('payment_collections/add_collection', 'Already This Lc collected');
                  }
                 
             }
            
             if(!empty($postData['bank_id'])){
                 $insertData['bank_id']=$postData['bank_id'];
             }
             if(!empty($postData['remark'])){
                 $insertData['remark']=$postData['remark'];
             }
             
             if(!empty($postData['collection_time'])){
                 $insertData['collection_time']=$postData['collection_time'];
             }
             
             if(!empty($postData['receive_type'])){
                 $insertData['receive_type']=$postData['receive_type'];
             }
             
             if(!empty($postData['invoice_id'])){
                 $insertData['invoice_id']=$postData['invoice_id'];
             }
             
             $insertData['unit_id']=$branch_id;
             $insertData['is_active']=1;
   
           //  $insertData['payment_status']='Pending'; 
             $insertData['payment_status']='Collected'; 
             
             $insertData['created_date']=date('Y-m-d');
             
             $result=$this->m_common->insert_row('tbl_payment_collections',$insertData);
             if(!empty($result)){
                $approve='Approved';
                if($payment_condition[0]['b_cash']=="Cash"){
                    $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Cash' and is_active=1 and o_id=".$postData['o_id'];
                    $total_cash_collection=$this->m_common->customeQuery($sql); 
                    if($total_cash_collection[0]['total']>=$payment_condition[0]['b_cash_amount']){
                        
                    }else{
                        $approve='Pending';
                    }
                }
                
                if($payment_condition[0]['b_bg']=="Bg"){
                    $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Bg' and is_active=1 and o_id=".$postData['o_id'];
                    $total_bg_collection=$this->m_common->customeQuery($sql);
                    if($total_bg_collection[0]['total']>=$payment_condition[0]['b_bg_amount']){
                        
                    }else{
                        $approve='Pending';
                    }
                }
                
               if($payment_condition[0]['b_pdc']=="Pdc"){
                    if($payment_condition[0]['b_pdc_condition']=="Collection"){
                        $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Pdc' and is_active=1 and o_id=".$postData['o_id'];
                    }else{
                        $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Pdc' and is_active=1 and o_id=".$postData['o_id'];
                    }
                    $total_pdc_collection=$this->m_common->customeQuery($sql);
                    if($total_pdc_collection[0]['total']>=$payment_condition[0]['b_pdc_amount']){
                      
                    }else{
                        $approve='Pending';
                    }
                }
                
                if($payment_condition[0]['b_lc']=="Lc"){
                    if($payment_condition[0]['b_lc_condition']=="Collection"){
                        $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Lc' and is_active=1 and o_id=".$postData['o_id'];
                    }else{
                        $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Lc' and is_active=1 and o_id=".$postData['o_id'];
                    }
                    $total_lc_collection=$this->m_common->customeQuery($sql);
                    if($total_lc_collection[0]['total']>=$payment_condition[0]['b_lc_amount']){
                      
                    }else{
                        $approve='Pending';
                    }
                }
                
                $this->m_common->update_row('tbl_sales_orders',array('o_id'=>$postData['o_id']),array('status'=>$approve));
//                if($total_collection[0]['total']>=$total_condition_amount){
//                    $this->m_common->update_row('tbl_sales_orders',array('o_id'=>$postData['o_id']),array('status'=>"Approved"));
//                }  
                redirect_with_msg('payment_collections', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('payment_collections/add_collection', 'Please fill the form and submit');
         }
         
     }
    
     function edit_collection($id) {
        $branch_id= $this->session->userdata('companyId');   
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_collection';
        $this->titlebackend("Quotation Information");
        
        $data['collection_info']=$this->m_common->get_row_array('tbl_payment_collections',array('id'=>$id),'*');
        $data['payment_mode']=$this->m_common->get_row_array('tbl_sales_order_payment_condition',array('o_id'=>$data['collection_info'][0]['o_id']),'*');
        $data['banks']=$this->m_common->get_row_array('tbl_banks',array('is_active'=>1),'*');
      //  $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1";
        $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.unit_id=".$branch_id;
        $data['sale_orders']=$this->m_common->customeQuery($sql);
        
        $cash_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Cash" and payment_status="Received" and o_id='.$data['collection_info'][0]['o_id'];
        $data['paid_cash_amount']=$this->m_common->customeQuery($cash_sql);
        $data['total_cash_amount']=$data['payment_mode'][0]['b_cash_amount']+$data['payment_mode'][0]['a_cash_amount'];
        $data['due_cash_amount']=$data['total_cash_amount']-$data['paid_cash_amount'][0]['total'];
        
        $pdc_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Pdc" and payment_status="Received" and o_id='.$data['collection_info'][0]['o_id'];
        $data['paid_pdc_amount']=$this->m_common->customeQuery($pdc_sql);
        $data['total_pdc_amount']=$data['payment_mode'][0]['b_pdc_amount']+$data['payment_mode'][0]['a_pdc_amount'];
        $data['due_pdc_amount']=$data['total_pdc_amount']-$data['paid_pdc_amount'][0]['total'];
        
        
        $lc_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Lc" and payment_status="Received" and o_id='.$data['collection_info'][0]['o_id'];
        $data['paid_lc_amount']=$this->m_common->customeQuery($lc_sql);
        $data['total_lc_amount']=$data['payment_mode'][0]['b_lc_amount']+$data['payment_mode'][0]['a_lc_amount'];
        $data['due_lc_amount']=$data['total_lc_amount']-$data['paid_lc_amount'][0]['total'];
        
        $bg_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Bg" and payment_status="Received" and o_id='.$data['collection_info'][0]['o_id'];
        $data['paid_bg_amount']=$this->m_common->customeQuery($bg_sql);
        $data['total_bg_amount']=$data['payment_mode'][0]['b_bg_amount']+$data['payment_mode'][0]['a_bg_amount'];
        $data['due_bg_amount']=$data['total_bg_amount']-$data['paid_bg_amount'][0]['total'];
        
        
        $data['total_amount']=$data['total_cash_amount']+$data['total_pdc_amount']+$data['total_lc_amount']+$data['total_bg_amount'];
        $data['total_paid']=$data['paid_cash_amount'][0]['total']+$data['paid_pdc_amount'][0]['total']+$data['paid_lc_amount'][0]['total']+$data['paid_bg_amount'][0]['total'];
        $data['total_due']=$data['total_amount']-$data['total_paid']; 
        
        
        $sql="select si.* from tbl_sales_invoices si left join tbl_delivery_orders do on si.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id where si.is_active=1 and do.o_id=".$data['collection_info'][0]['o_id'];
        $data['invoices']=$this->m_common->customeQuery($sql); 
        
        $this->load->view('payment_collections/v_edit_collection',$data);
    }
    
    function edit_collection_action($q_id) {
         $existCollection=$this->m_common->get_row_array('tbl_payment_collections',array('id'=>$q_id),'*');
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             if(!empty($postData['o_id'])){
                 $insertData['o_id']=$postData['o_id'];
             }
             
             $payment_condition=$this->m_common->get_row_array('tbl_sales_order_payment_condition',array('o_id'=>$postData['o_id']),'*');
             
             if(!empty($postData['amount'])){
                 $insertData['amount']=$postData['amount'];
             }
             if(!empty($postData['receive_date'])){
                 $insertData['receive_date']=date('Y-m-d',strtotime($postData['receive_date']));
             }
             
             if(!empty($postData['collection_method'])){
                 $insertData['collection_method']=$postData['collection_method'];
             }
             if($postData['collection_method']=="Cash"){
                  $insertData['collection_condition']="Collection";
                  $insertData['check_no']='';
                  $insertData['check_date']='';
                  $insertData['po_no']='';
                  $insertData['po_date']='';
                  $insertData['bg_no']='';
                  $insertData['bg_issue_date']='';
                  $insertData['bg_expire_date']='';
                  $insertData['tenor']='';
                  $insertData['lc_no']='';
                  $insertData['lc_date']=''; 
             }else if($postData['collection_method']=="Pdc"){
                 if($payment_condition[0]['b_pdc_condition']=="Collection"){
                     $insertData['collection_condition']="Collection";
                 }else{
                     $insertData['collection_condition']="Realization";
                 }
                 if(!empty($postData['check_no'])){
                       $insertData['check_no']=$postData['check_no'];
                       $insertData['no']=$postData['check_no'];
                  }
                  if(!empty($postData['check_date'])){
                    $insertData['check_date']=date('Y-m-d',strtotime($postData['check_date']));
                  }
                  $insertData['po_no']='';
                  $insertData['po_date']='';
                  $insertData['bg_no']='';
                  $insertData['bg_issue_date']='';
                  $insertData['bg_expire_date']='';
                  $insertData['tenor']='';
                  $insertData['lc_no']='';
                  $insertData['lc_date']='';
             }else if($postData['collection_method']=="Po"){
                 if(!empty($postData['po_no'])){
                       $insertData['po_no']=$postData['po_no'];
                       $insertData['no']=$postData['po_no'];
                  }
                  if(!empty($postData['po_date'])){
                       $insertData['po_date']=date('Y-m-d',strtotime($postData['po_date']));
                  }
                  $insertData['check_no']='';
                  $insertData['check_date']='';
                  $insertData['bg_no']='';
                  $insertData['bg_issue_date']='';
                  $insertData['bg_expire_date']='';
                  $insertData['tenor']='';
                  $insertData['lc_no']='';
                  $insertData['lc_date']=''; 
             }else if($postData['collection_method']=="Bg"){
                 $insertData['collection_condition']="Collection";
                 if(!empty($postData['bg_no'])){
                       $insertData['bg_no']=$postData['bg_no'];
                       $insertData['no']=$postData['bg_no'];
                 }
                 if(!empty($postData['tenor'])){
                       $insertData['tenor']=$postData['tenor'];
                 }
                  if(!empty($postData['bg_issue_date'])){
                       $insertData['bg_issue_date']=date('Y-m-d',strtotime($postData['bg_issue_date']));
                  }
                  if(!empty($postData['bg_expire_date'])){
                       $insertData['bg_expire_date']=date('Y-m-d',strtotime($postData['bg_expire_date']));
                  }
                  $insertData['check_no']='';
                  $insertData['check_date']='';
                  $insertData['po_no']='';
                  $insertData['po_date']='';
                  $insertData['lc_no']='';
                  $insertData['lc_date']=''; 
             }else if($postData['collection_method']=="Lc"){
                 if($payment_condition[0]['b_lc_condition']=="Collection"){
                     $insertData['collection_condition']="Collection";
                 }else{
                     $insertData['collection_condition']="Realization";
                 }
                 if(!empty($postData['lc_no'])){
                       $insertData['lc_no']=$postData['lc_no'];
                       $insertData['no']=$postData['lc_no'];
                 }
                 if(!empty($postData['tenor'])){
                       $insertData['tenor']=$postData['tenor'];
                 }
                 if(!empty($postData['lc_date'])){
                       $insertData['lc_date']=date('Y-m-d',strtotime($postData['lc_date']));
                 }
                  $insertData['check_no']='';
                  $insertData['check_date']='';
                  $insertData['po_no']='';
                  $insertData['po_date']='';
                  $insertData['bg_no']='';
                  $insertData['bg_issue_date']='';
                  $insertData['bg_expire_date']='';
                  
             }
            
             if(!empty($postData['bank_id'])){
                 $insertData['bank_id']=$postData['bank_id'];
             }
             if(!empty($postData['collection_time'])){
                 $insertData['collection_time']=$postData['collection_time'];
             }
             if(!empty($postData['receive_type'])){
                 $insertData['receive_type']=$postData['receive_type'];
             }   
             if(!empty($postData['invoice_id'])){
                 $insertData['invoice_id']=$postData['invoice_id'];
             }
             if(!empty($postData['remark'])){
                 $insertData['remark']=$postData['remark'];
             }
             $result=$this->m_common->update_row('tbl_payment_collections',array('id'=>$q_id),$insertData);
             if($result>=0){ 
//                $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and is_active=1 and o_id=".$postData['o_id'];
//                $total_collection=$this->m_common->customeQuery($sql); 
//                if($total_collection[0]['total']>=$total_condition_amount){
//                    $this->m_common->update_row('tbl_sales_orders',array('o_id'=>$postData['o_id']),array('status'=>"Approved"));
//                } 
                if($existCollection[0]['o_id']==$postData['o_id']){
              
                    $approve='Approved';
                    if($payment_condition[0]['b_cash']=="Cash"){
                        $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Cash' and is_active=1 and o_id=".$postData['o_id'];
                        $total_cash_collection=$this->m_common->customeQuery($sql); 
                        if($total_cash_collection[0]['total']>=$payment_condition[0]['b_cash_amount']){

                        }else{
                            $approve='Pending';
                        }
                    }

                    if($payment_condition[0]['b_bg']=="Bg"){
                        $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Bg' and is_active=1 and o_id=".$postData['o_id'];
                        $total_bg_collection=$this->m_common->customeQuery($sql);
                        if($total_bg_collection[0]['total']>=$payment_condition[0]['b_bg_amount']){

                        }else{
                            $approve='Pending';
                        }
                    }

                   if($payment_condition[0]['b_pdc']=="Pdc"){
                        if($payment_condition[0]['b_pdc_condition']=="Collection"){
                            $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Pdc' and is_active=1 and o_id=".$postData['o_id'];
                        }else{
                            $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Pdc' and is_active=1 and o_id=".$postData['o_id'];
                        }
                        $total_pdc_collection=$this->m_common->customeQuery($sql);
                        if($total_pdc_collection[0]['total']>=$payment_condition[0]['b_pdc_amount']){

                        }else{
                            $approve='Pending';
                        }
                    }

                    if($payment_condition[0]['b_lc']=="Lc"){
                        if($payment_condition[0]['b_lc_condition']=="Collection"){
                            $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Lc' and is_active=1 and o_id=".$postData['o_id'];
                        }else{
                            $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Lc' and is_active=1 and o_id=".$postData['o_id'];
                        }
                        $total_lc_collection=$this->m_common->customeQuery($sql);
                        if($total_lc_collection[0]['total']>=$payment_condition[0]['b_lc_amount']){

                        }else{
                            $approve='Pending';
                        }
                    }

                    $this->m_common->update_row('tbl_sales_orders',array('o_id'=>$postData['o_id']),array('status'=>$approve));  
                }else{
                    $approve='Approved';
                    if($payment_condition[0]['b_cash']=="Cash"){
                        $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Cash' and is_active=1 and o_id=".$postData['o_id'];
                        $total_cash_collection=$this->m_common->customeQuery($sql); 
                        if($total_cash_collection[0]['total']>=$payment_condition[0]['b_cash_amount']){

                        }else{
                            $approve='Pending';
                        }
                    }

                    if($payment_condition[0]['b_bg']=="Bg"){
                        $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Bg' and is_active=1 and o_id=".$postData['o_id'];
                        $total_bg_collection=$this->m_common->customeQuery($sql);
                        if($total_bg_collection[0]['total']>=$payment_condition[0]['b_bg_amount']){

                        }else{
                            $approve='Pending';
                        }
                    }

                    if($payment_condition[0]['b_pdc']=="Pdc"){
                        if($payment_condition[0]['b_pdc_condition']=="Collection"){
                            $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Pdc' and is_active=1 and o_id=".$postData['o_id'];
                        }else{
                            $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Pdc' and is_active=1 and o_id=".$postData['o_id'];
                        }
                        $total_pdc_collection=$this->m_common->customeQuery($sql);
                        if($total_pdc_collection[0]['total']>=$payment_condition[0]['b_pdc_amount']){

                        }else{
                            $approve='Pending';
                        }
                    }

                    if($payment_condition[0]['b_lc']=="Lc"){
                        if($payment_condition[0]['b_lc_condition']=="Collection"){
                            $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Lc' and is_active=1 and o_id=".$postData['o_id'];
                        }else{
                            $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Lc' and is_active=1 and o_id=".$postData['o_id'];
                        }
                        $total_lc_collection=$this->m_common->customeQuery($sql);
                        if($total_lc_collection[0]['total']>=$payment_condition[0]['b_lc_amount']){

                        }else{
                            $approve='Pending';
                        }
                    }

                    $this->m_common->update_row('tbl_sales_orders',array('o_id'=>$postData['o_id']),array('status'=>$approve));  
                          
                   $pre_order_payment_condition=$this->m_common->get_row_array('tbl_sales_order_payment_condition',array('o_id'=>$existCollection[0]['o_id']),'*'); 
                    
                   $approve1='Approved';
                    if($pre_order_payment_condition[0]['b_cash']=="Cash"){
                        $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Cash' and is_active=1 and o_id=".$existCollection[0]['o_id'];
                        $total_cash_collection=$this->m_common->customeQuery($sql); 
                        if($total_cash_collection[0]['total']>=$pre_order_payment_condition[0]['b_cash_amount']){

                        }else{
                            $approve1='Pending';
                        }
                    }

                    if($pre_order_payment_condition[0]['b_bg']=="Bg"){
                        $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Bg' and is_active=1 and o_id=".$existCollection[0]['o_id'];
                        $total_bg_collection=$this->m_common->customeQuery($sql);
                        if($total_bg_collection[0]['total']>=$pre_order_payment_condition[0]['b_bg_amount']){

                        }else{
                            $approve1='Pending';
                        }
                    }

                   if($pre_order_payment_condition[0]['b_pdc']=="Pdc"){
                        if($pre_order_payment_condition[0]['b_pdc_condition']=="Collection"){
                            $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Pdc' and is_active=1 and o_id=".$existCollection[0]['o_id'];
                        }else{
                            $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Pdc' and is_active=1 and o_id=".$existCollection[0]['o_id'];
                        }
                        $total_pdc_collection=$this->m_common->customeQuery($sql);
                        if($total_pdc_collection[0]['total']>=$pre_order_payment_condition[0]['b_pdc_amount']){

                        }else{
                            $approve1='Pending';
                        }
                    }

                    if($pre_order_payment_condition[0]['b_lc']=="Lc"){
                        if($pre_order_payment_condition[0]['b_lc_condition']=="Collection"){
                            $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Lc' and is_active=1 and o_id=".$existCollection[0]['o_id'];
                        }else{
                            $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Lc' and is_active=1 and o_id=".$existCollection[0]['o_id'];
                        }
                        $total_lc_collection=$this->m_common->customeQuery($sql);
                        if($total_lc_collection[0]['total']>=$pre_order_payment_condition[0]['b_lc_amount']){

                        }else{
                            $approve1='Pending';
                        }
                    }

                    $this->m_common->update_row('tbl_sales_orders',array('o_id'=>$existCollection[0]['o_id']),array('status'=>$approve1));  
                    
                    
                    
                    
                }
                 
                redirect_with_msg('payment_collections', 'Successfully Updated');
             }else{
                  redirect_with_msg('payment_collections/edit_collection/'.$q_id, 'Not Updated');
             }
             
         }else{
              redirect_with_msg('payment_collections/edit_collection/'.$q_id, 'Please fill the form and submit');
         }
         
     }
    function view_collection($id) {
        $branch_id= $this->session->userdata('companyId');   
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_collection';
        $this->titlebackend("Quotation Information");
        
        $data['collection_info']=$this->m_common->get_row_array('tbl_payment_collections',array('id'=>$id),'*');
        $data['payment_mode']=$this->m_common->get_row_array('tbl_sales_order_payment_condition',array('o_id'=>$data['collection_info'][0]['o_id']),'*');
        $data['banks']=$this->m_common->get_row_array('tbl_banks',array('is_active'=>1),'*');
       // $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1";
        $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.unit_id=".$branch_id;
        $data['sale_orders']=$this->m_common->customeQuery($sql);
        
        $cash_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Cash" and payment_status="Received" and o_id='.$data['collection_info'][0]['o_id'];
        $data['paid_cash_amount']=$this->m_common->customeQuery($cash_sql);
        $data['total_cash_amount']=$data['payment_mode'][0]['b_cash_amount']+$data['payment_mode'][0]['a_cash_amount'];
        $data['due_cash_amount']=$data['total_cash_amount']-$data['paid_cash_amount'][0]['total'];
        
        $pdc_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Pdc" and payment_status="Received" and o_id='.$data['collection_info'][0]['o_id'];
        $data['paid_pdc_amount']=$this->m_common->customeQuery($pdc_sql);
        $data['total_pdc_amount']=$data['payment_mode'][0]['b_pdc_amount']+$data['payment_mode'][0]['a_pdc_amount'];
        $data['due_pdc_amount']=$data['total_pdc_amount']-$data['paid_pdc_amount'][0]['total'];
        
        
        $lc_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Lc" and payment_status="Received" and o_id='.$data['collection_info'][0]['o_id'];
        $data['paid_lc_amount']=$this->m_common->customeQuery($lc_sql);
        $data['total_lc_amount']=$data['payment_mode'][0]['b_lc_amount']+$data['payment_mode'][0]['a_lc_amount'];
        $data['due_lc_amount']=$data['total_lc_amount']-$data['paid_lc_amount'][0]['total'];
        
        $bg_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Bg" and payment_status="Received" and o_id='.$data['collection_info'][0]['o_id'];
        $data['paid_bg_amount']=$this->m_common->customeQuery($bg_sql);
        $data['total_bg_amount']=$data['payment_mode'][0]['b_bg_amount']+$data['payment_mode'][0]['a_bg_amount'];
        $data['due_bg_amount']=$data['total_bg_amount']-$data['paid_bg_amount'][0]['total'];
        
        
        $data['total_amount']=$data['total_cash_amount']+$data['total_pdc_amount']+$data['total_lc_amount']+$data['total_bg_amount'];
        $data['total_paid']=$data['paid_cash_amount'][0]['total']+$data['paid_pdc_amount'][0]['total']+$data['paid_lc_amount'][0]['total']+$data['paid_bg_amount'][0]['total'];
        $data['total_due']=$data['total_amount']-$data['total_paid']; 
        
        
        
        
        $this->load->view('payment_collections/v_details_collection',$data);
    }
    function receive_collection($c_id){
         $collection_info=$this->m_common->get_row_array('tbl_payment_collections',array('id'=>$c_id),'*');
         $order_info=$this->m_common->get_row_array('tbl_sales_orders',array('o_id'=>$collection_info[0]['o_id']),'*');
         $result=$this->m_common->update_row('tbl_payment_collections',array('id'=>$c_id),array('payment_status'=>"Received"));
         if(!empty($result)){
            $payment_condition=$this->m_common->get_row_array('tbl_sales_order_payment_condition',array('o_id'=>$collection_info[0]['o_id']),'*');
            if(!empty($collection_info[0]['invoice_id'])){
                $invoice_info=$this->m_common->get_row_array('tbl_sales_invoices',array('inv_id'=>$collection_info[0]['invoice_id']),'*');
                $sql="select * from tbl_sales_invoice_details where (received_status='Pending' or received_status='Partial Received') and inv_id=".$collection_info[0]['invoice_id'];
                $invoice_details_info=$this->m_common->customeQuery($sql);
                $collection_amount=$collection_info[0]['amount'];
                foreach($invoice_details_info as $key=>$inv_detail){
                    if($collection_amount<=0){
                        break;
                    }
                    $r_amount=$inv_detail['amount']-$inv_detail['received_amount'];
                    if($r_amount<$collection_amount){
                        $r_amount=$collection_amount;
                    }
                    $net_r_amount=$inv_detail['received_amount']+$r_amount;
                    if($net_r_amount==$inv_detail['amount']){
                        $r_status="Received";
                    }else{
                        $r_status="Partial Received";
                    }
                   // $this->m_common->update_row('tbl_sales_invoice_details',array('inv_id'=>$collection_info[0]['invoice_id'],'s_item_id'=>$inv_detail['s_item_id']),array('received_amount'=>$net_r_amount,'received_status'=>$r_status));
                    $this->m_common->update_row('tbl_sales_invoice_details',array('inv_details_id'=>$inv_detail['inv_details_id']),array('received_amount'=>$net_r_amount,'received_status'=>$r_status));
                    $collection_amount=$collection_amount-$r_amount;
                }
                $receive_amount=$collection_info[0]['amount']+$invoice_info[0]['received_amount'];
                if($receive_amount==$invoice_info[0]['total_amount']){
                    $status='Received';
                }else{
                    $status='Partial Received';
                }
                $this->m_common->update_row('tbl_sales_invoices',array('inv_id'=>$collection_info[0]['invoice_id']),array('received_amount'=>$receive_amount,'status'=>$status));
            }
           
            //$this->m_common->update_row('tbl_sales_orders',array('o_id'=>$collection_info[0]['o_id']),array('status'=>$approve))     
            $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and is_active=1 and o_id=".$collection_info[0]['o_id'];
            $total_collection=$this->m_common->customeQuery($sql);    
            
            if($total_collection[0]['total']==$order_info[0]['total_amount']){
                $this->m_common->update_row('tbl_sales_orders',array('o_id'=>$collection_info[0]['o_id']),array('receive_status'=>"Received"));
            }else{
                $this->m_common->update_row('tbl_sales_orders',array('o_id'=>$collection_info[0]['o_id']),array('receive_status'=>"Partial Received"));
            }
            redirect_with_msg('payment_collections', 'Successfully Received');
         }
     }
     
   function receive_collection_pre($c_id){
         $collection_info=$this->m_common->get_row_array('tbl_payment_collections',array('id'=>$c_id),'*');
         $order_info=$this->m_common->get_row_array('tbl_sales_orders',array('o_id'=>$collection_info[0]['o_id']),'*');
         $result=$this->m_common->update_row('tbl_payment_collections',array('id'=>$c_id),array('payment_status'=>"Received"));
         if(!empty($result)){
            $sales_payment_condition=$this->m_common->get_row_array('tbl_sales_order_payment_condition',array('o_id'=>$collection_info[0]['o_id']),'*');
            $total_condition_amount=$sales_payment_condition[0]['b_cash_amount']+$sales_payment_condition[0]['b_bg_amount']+$sales_payment_condition[0]['b_lc_amount'];
           // $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and o_id=".$collection_info[0]['o_id'];
            $sql="select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and is_active=1 and o_id=".$collection_info[0]['o_id'];
            $total_collection=$this->m_common->customeQuery($sql); 
            if($total_collection[0]['total']>=$total_condition_amount){
                $this->m_common->update_row('tbl_sales_orders',array('o_id'=>$collection_info[0]['o_id']),array('status'=>"Approved"));
            }  
            if($total_collection[0]['total']==$order_info[0]['total_amount']){
                $this->m_common->update_row('tbl_sales_orders',array('o_id'=>$collection_info[0]['o_id']),array('receive_status'=>"Received"));
            }else{
                $this->m_common->update_row('tbl_sales_orders',array('o_id'=>$collection_info[0]['o_id']),array('receive_status'=>"Partial Received"));
            }
            redirect_with_msg('payment_collections', 'Successfully Received');
         }
     }   
     
     
    function delete_collection($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('tbl_payment_collections', array('id' => $id),array('is_active'=>0));
            if(!empty($id)){    
                redirect_with_msg('payment_collections/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('payment_collections/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('payment_collections/index', 'Please click on delete button');
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
        $id=$this->input->post('id');
        $data['quotaion']=$this->m_common->get_row_array('tbl_sales_quotation_code',array('customer_id'=>$id),'*','',1,'id','DESC');
        $customer=$this->m_common->get_row_array('tbl_customers',array('id'=>$id,'is_active'=>1),'*');
        if(!empty($customer)){
            $data['customer_info']=$customer;
        }else{
            $data['customer_info']='';
        }
        echo json_encode($data);
    } 
    
    
    function get_payment_mode(){
        $this->setOutputMode(NORMAL);
        $branch_id= $this->session->userdata('companyId');
        $o_id=$this->input->post('o_id');
        $data['payment_mode']=$this->m_common->get_row_array('tbl_sales_order_payment_condition',array('o_id'=>$o_id),'*');
        
        $cash_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Cash" and payment_status="Received" and o_id='.$o_id;
        $data['paid_cash_amount']=$this->m_common->customeQuery($cash_sql);
        $data['total_cash_amount']=$data['payment_mode'][0]['b_cash_amount']+$data['payment_mode'][0]['a_cash_amount'];
        $data['due_cash_amount']=$data['total_cash_amount']-$data['paid_cash_amount'][0]['total'];
        
        $pdc_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Pdc" and payment_status="Received" and o_id='.$o_id;
        $data['paid_pdc_amount']=$this->m_common->customeQuery($pdc_sql);
        $data['total_pdc_amount']=$data['payment_mode'][0]['b_pdc_amount']+$data['payment_mode'][0]['a_pdc_amount'];
        $data['due_pdc_amount']=$data['total_pdc_amount']-$data['paid_pdc_amount'][0]['total'];
        
        
        $lc_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Lc" and payment_status="Received" and o_id='.$o_id;
        $data['paid_lc_amount']=$this->m_common->customeQuery($lc_sql);
        $data['total_lc_amount']=$data['payment_mode'][0]['b_lc_amount']+$data['payment_mode'][0]['a_lc_amount'];
        $data['due_lc_amount']=$data['total_lc_amount']-$data['paid_lc_amount'][0]['total'];
        
        $bg_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Bg" and payment_status="Received" and o_id='.$o_id;
        $data['paid_bg_amount']=$this->m_common->customeQuery($bg_sql);
        $data['total_bg_amount']=$data['payment_mode'][0]['b_bg_amount']+$data['payment_mode'][0]['a_bg_amount'];
        $data['due_bg_amount']=$data['total_bg_amount']-$data['paid_bg_amount'][0]['total'];
        
        
        $data['total_amount']=$data['total_cash_amount']+$data['total_pdc_amount']+$data['total_lc_amount']+$data['total_bg_amount'];
        $data['total_paid']=$data['paid_cash_amount'][0]['total']+$data['paid_pdc_amount'][0]['total']+$data['paid_lc_amount'][0]['total']+$data['paid_bg_amount'][0]['total'];
        $data['total_due']=$data['total_amount']-$data['total_paid'];
        
        $sql="select si.* from tbl_sales_invoices si left join tbl_delivery_orders do on si.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id where si.is_active=1 and do.o_id=$o_id";
        $data['invoices']=$this->m_common->customeQuery($sql);
        echo json_encode($data);
    }
    
    
    
    
     function payment_received() {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'payment_received';
        $this->titlebackend("Payment Received");
       // $data['quotations']=$this->m_common->get_row_array('tbl_sales_quotation
       // $sql="select pc.*,so.order_no,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_sales_orders so on pc.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where pc.is_active=1";
        $sql="select pc.*,so.order_no,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_sales_orders so on pc.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where pc.is_active=1 and pc.payment_status='Received' and pc.unit_id=".$branch_id;
        $data['collections']=$this->m_common->customeQuery($sql);
        $this->load->view('payment_collections/v_payment_received',$data);
    }
   

}




