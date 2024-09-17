<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Closing extends Site_Controller {

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
    
    
    function salesClosing(){
      // $sql="TRUNCATE TABLE tbl_payable";
      // $this->m_common->customeQuery($sql);
       echo 'test';
       
       
       $years=array();
       for($i=2019;$i<=date('Y');$i++){
          $years[]=$i; 
       }
       $customers=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1,'customer_category'=>'Finish Good'),'*');
       $categories= $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*', '', '', 'category_id');
       foreach($years as $value){
           
           $year_fisrt_date=$value.'-01-01';
           $year_last_date=$value.'-12-31';
           foreach($categories as $cat_value){
               foreach($customers as $cust_value){
                   $in_sql="select sum(sid.amount) as total_amount,sum(sid.received_amount) as total_received_amount from tbl_sales_invoice_details sid left join tbl_sales_invoices si on sid.inv_id=si.inv_id where si.category_id=".$cat_value['category_id']." and si.customer_id=".$cust_value['id']." and si.is_active=1 and si.status!='Canceled'";
                   $in_info=$this->m_common->customeQuery($in_sql);
                   $insertData=array();
                   if(isset($in_info[0]['total_amount'])){
                        if($cust_value['customer_type']=='in_house'){
                             $insertData['year']=$value;
                             $insertData['category_id']=$cat_value['category_id'];
                             $insertData['customer_id']=$cust_value['id'];
                             if(!empty($in_info[0]['total_amount'])){
                                $insertData['inhouse']=$in_info[0]['total_amount'];
                                $insertData['private']=0;
                                $insertData['total_amount']=$in_info[0]['total_amount'];
                             }else{
                                $insertData['inhouse']=0;
                                $insertData['private']=0;
                                $insertData['total_amount']=0; 
                             }
                             $insertData['inhouse_receive']=$in_info[0]['total_received_amount'];
                             $insertData['private_receive']=0;
                             $insertData['total_receive']=$in_info[0]['total_received_amount'];
                        }else{
                             $insertData['year']=$value;
                             $insertData['category_id']=$cat_value['category_id'];
                             $insertData['customer_id']=$cust_value['id'];
                             if(!empty($in_info[0]['total_amount'])){
                                $insertData['inhouse']=0;             
                                $insertData['private']=$in_info[0]['total_amount'];
                                $insertData['total_amount']=$in_info[0]['total_amount'];
                             }else{
                                $insertData['inhouse']=0;             
                                $insertData['private']=0;
                                $insertData['total_amount']=0; 
                             }
                             
                             $insertData['inhouse_receive']=0;
                             $insertData['private_receive']=$in_info[0]['total_received_amount'];
                             $insertData['total_receive']=$in_info[0]['total_received_amount'];
                        }
                   }else{
                             $insertData['year']=$value;
                             $insertData['category_id']=$cat_value['category_id'];
                             $insertData['customer_id']=$cust_value['id'];
                             $insertData['inhouse']=0;
                             $insertData['private']=0;
                             $insertData['total_amount']=0;
                             $insertData['inhouse_receive']=0;
                             $insertData['private_receive']=0;
                             $insertData['total_receive']=0;
                   }    
                   $this->m_common->insert_row('tbl_sales_closing',$insertData);
               }
           }
       }
       
    }

    function billsClosing(){
//       $sql="TRUNCATE TABLE tbl_payable";
//       $this->m_common->customeQuery($sql);
//       echo 'test';
       
       
       $years=array();
       for($i=2022;$i<=date('Y');$i++){
          $years[]=$i; 
       }
       $customers=$this->m_common->get_row_array('supplier',array('STATUS'=>'ACTIVE','s_type'=>'Supplier'),'*');
       $this->m_common->get_row_array('item_category', array('group_id' =>5), '*', '', '', 'c_id');
       foreach($years as $value){
           
           $year_fisrt_date=$value.'-01-01';
           $year_last_date=$value.'-12-31';
           foreach($categories as $cat_value){
               foreach($customers as $cust_value){
                   $in_sql="select sum(pid.amount) as total_amount,sum(pid.paid_amount) as total_paid_amount from tbl_purchase_invoice_details pid left join tbl_purchase_invoices pi on pid.inv_id=pi.inv_id left join items i on pid.item_id=i.id where i.item_group=".$cat_value['c_id']." and pi.supplier_id=".$cust_value['ID']." and pi.is_active=1";
                   $in_info=$this->m_common->customeQuery($in_sql);
                   $insertData=array();
                   if(isset($in_info[0]['total_amount'])){
                        
                             $insertData['year']=$value;
                             $insertData['category_id']=$cat_value['c_id'];
                             $insertData['supplier_id']=$cust_value['id'];
                             if(!empty($in_info[0]['total_amount'])){
                                $insertData['bill_amount']=$in_info[0]['total_amount'];
                             }else{
                                $insertData['bill_amount']=0; 
                             }
                             
                             if(!empty($in_info[0]['total_paid_amount'])){
                                $insertData['paid_amount']=$in_info[0]['total_paid_amount'];
                             }else{
                                $insertData['paid_amount']=0; 
                             }
                             
                       
                   }else{
                             $insertData['year']=$value;
                             $insertData['category_id']=$cat_value['c_id'];
                             $insertData['customer_id']=$cust_value['id'];
                             $insertData['bill_amount']=0;
                             $insertData['paid_amount']=0;
                   }    
                   $this->m_common->insert_row('tbl_payable',$insertData);
               }
           }
       }
    }
    
    function stockClosing(){
        
    }
}
