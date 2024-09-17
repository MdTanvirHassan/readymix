<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expense extends Site_Controller {

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
        $this->menu = 'general_store';
        $this->sub_menu = 'expense';
        $this->sub_inner_menu = 'expense';
        $this->titlebackend("Supplier Information");
        $branch_id= $this->session->userdata('companyId');
        $data['expense'] = $expense = $this->m_common->get_row_array('tbl_expense', array('unit_id'=>$branch_id), '*');
        foreach($expense as $key=>$row){
            $data['expense'][$key]['file_name'] = $this->m_common->get_row_array('tbl_expense_document', array('expenseID'=>$row['expenseID']), '*');
            
        }
        //$data['expense'] = $data['expense'][$key]['file_name'];
        $data['total_balance'] = $this->m_common->get_row_array('tbl_balance_total', array('unit_id'=>$branch_id),'*');
        $this->load->view('expense/v_expense', $data);
    }
    function addExpense() {
        $this->menu = 'general_store';
        $this->sub_menu = 'expense';
        $this->sub_inner_menu = 'expense';
        $this->titlebackend("Supplier Information");
        $postData = $this->input->post();
        $branch_id= $this->session->userdata('companyId');
        $data['suppliers'] = $this->m_common->get_row_array('supplier', '', '*');
        $data['material_indent'] = $this->m_common->get_row_array('ipo_material_indent', array('status'=>'Approved'), '*');
        $sql ="select s.*, p.amount from tbl_services s JOIN tbl_purchase_order_details p on s.id=p.service_id WHERE p.branch_id =$branch_id";
        $data['services'] = $this->m_common->customeQuery($sql);
        if($_POST){
            $insertData= array();
            $insertData['expense']=$postData['expense'];
            $insertData['unit_id']=$branch_id;
            $insertData['create_date']=date('Y-m-d');
            $insertData['expense_date']=date('Y-m-d', strtotime($postData['expense_date']));
            $insertData['amount']=$postData['amount'];
            $insertData['qty']=$postData['qty'];
            $insertData['ipo_m_id']=$postData['ipo_m_id'];
            $insertData['remark']=$postData['remark'];
            $insertData['type']=$postData['type'];
            $insertData['service_id']=$postData['service_id'];
            
           $expenseID = $this->m_common->insert_row('tbl_expense',$insertData);
           if($expenseID){
               
               
               if (isset($_FILES['e_image']['name']) && !empty($_FILES['e_image']['name'])) {
               $doc = $_FILES['e_image'];
               foreach ($doc['name'] as $key => $file) {
                    if (!empty($doc['name'][$key])) {
                        $filename = generateFileName();
                        $path = $doc['name'][$key];
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        if (move_uploaded_file($doc['tmp_name'][$key], 'images/expense/' . $filename . '.' . $ext)) {
                            $insertDocuData= array();
                            $insertDocuData['file_name'] = $filename . '.' . $ext;
                            $insertDocuData['expenseID'] = $expenseID;
                            $this->m_common->insert_row('tbl_expense_document',$insertDocuData);
                        }
                    }
                }
             }
               $balance_total = $this->m_common->get_row_array('tbl_balance_total',array('unit_id'=>$branch_id),'*');
                 if(!empty($balance_total)){
                    $totalBalance = $balance_total[0]['total_amount'] - $postData['amount'];
                    $this->m_common->update_row('tbl_balance_total',array('unit_id'=>$branch_id),array('total_amount'=>$totalBalance));
                 }
           }
           redirect_with_msg('expense', 'Blanace  Successfully Inserted'); 
        }
        $data['total_balance'] = $this->m_common->get_row_array('tbl_balance_total', array('unit_id'=>$branch_id),'*');
        $this->load->view('expense/add_expense', $data);
    }
    
    function editExpense($expenseID) {
        $this->menu = 'general_store';
        $this->sub_menu = 'expense';
        $this->sub_inner_menu = 'expense';
        $this->titlebackend("Supplier Information");
        $postData=$this->input->post();
        $branch_id=$this->session->userdata('companyId');
       
        $data['suppliers'] = $this->m_common->get_row_array('supplier', '', '*');
        $data['expense'] = $prevexpense = $this->m_common->get_row_array('tbl_expense', array('expenseID'=>$expenseID), '*');
        $data['expense_document']=$prevexpense_doc = $this->m_common->get_row_array('tbl_expense_document', array('expenseID'=>$expenseID), '*');
        if($_POST){
            
            
            $insertData= array();
            $insertData['expense']=$postData['expense'];
            $insertData['expense_date']=date('Y-m-d', strtotime($postData['expense_date']));
            $insertData['amount']=$postData['amount'];
            $insertData['qty']=$postData['qty'];
            $insertData['remark']=$postData['remark'];
            $insertData['type']=$postData['type'];
           
          $this->m_common->update_row('tbl_expense',array('expenseID'=>$expenseID),$insertData);
          if(isset($_FILES['e_image']['name']) && !empty($_FILES['e_image']['name'])) {
               $doc = $_FILES['e_image'];
               foreach ($doc['name'] as $key => $file) {
                if (!empty($doc['name'][$key])) {
                    $filename = generateFileName();
                    $path = $doc['name'][$key];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if(move_uploaded_file($doc['tmp_name'][$key],'images/expense/' . $filename . '.' . $ext)){
                        $insertDocuData= array();
                        $insertDocuData['file_name'] = $filename . '.' . $ext;
                        $insertDocuData['expenseID'] = $expenseID;
                        $this->m_common->insert_row('tbl_expense_document',$insertDocuData);
                    }
                }
            }
             }
          //$this->m_common->insert_row('tbl_expense',array('expenseID'=>$expenseID),$insertData);
           if($expenseID){
               $balance_total = $this->m_common->get_row_array('tbl_balance_total',array('unit_id'=>$branch_id),'*');
                 if(!empty($balance_total)){
                    $currentbalance = $balance_total[0]['total_amount']+$prevexpense[0]['amount'];
                    $totalBalance = $currentbalance-$postData['amount'];
                    $this->m_common->update_row('tbl_balance_total',array('unit_id'=>$branch_id),array('total_amount'=>$totalBalance));
                 }
           }
           redirect_with_msg('expense', 'Blanace  Successfully Inserted'); 
        }
        
        $data['total_balance'] = $this->m_common->get_row_array('tbl_balance_total', array('unit_id'=>$branch_id), '*');
        $this->load->view('expense/edit_expense', $data);
    }
    
    function balance(){
      $this->menu = 'general_store';
        $this->sub_menu = 'expense';
        $this->sub_inner_menu = 'balance';
        $this->titlebackend("Supplier Information");
        $branch_id= $this->session->userdata('companyId');
        $data['balance'] = $this->m_common->get_row_array('tbl_balance', array('unit_id'=>$branch_id), '*');
        $data['total_balance'] = $this->m_common->get_row_array('tbl_balance_total', array('unit_id'=>$branch_id), '*');
        $this->load->view('expense/v_balance', $data);  
    }
    function addBalance(){
      $this->menu = 'general_store';
        $this->sub_menu = 'expense';
        $this->sub_inner_menu = 'balance';
        $this->titlebackend("Supplier Information");
        $postData = $this->input->post();
        $branch_id= $this->session->userdata('companyId');
        if($_POST){
            $inseartdata = array();
            $inseartdata['amount']=$postData['amount'];
            $inseartdata['balance_date']= date('Y-m-d', strtotime($postData['balance_date']));
            $inseartdata['remark']= $postData['remark'];
            $inseartdata['unit_id']= $branch_id;
            $inseartdata['create_date']= date('Y-m-d');
            $balanceID = $this->m_common->insert_row('tbl_balance',$inseartdata);
            if(!empty($balanceID)){
                 $balance_total_check = $this->m_common->get_row_array('tbl_balance_total',array('unit_id'=>$branch_id),'*');
                 if(!empty($balance_total_check)){
                    $totalBalance = $balance_total_check[0]['total_amount']+$postData['amount'];
                    $this->m_common->update_row('tbl_balance_total',array('unit_id'=>$branch_id),array('total_amount'=>$totalBalance));
                 }else{
                   $this->m_common->insert_row('tbl_balance_total',array('unit_id'=>$branch_id,'total_amount'=>$postData['amount']));  
                 }
            }
            redirect_with_msg('expense/balance', 'Blanace  Successfully Inserted'); 
            
        }
        $this->load->view('expense/v_add_balance', $data);  
    }
    function editBalance($balanceID){
      $this->menu = 'general_store';
        $this->sub_menu = 'expense';
        $this->sub_inner_menu = 'balance';
        $this->titlebackend("Supplier Information");
        $postData = $this->input->post();
        $branch_id= $this->session->userdata('companyId');
        $data['balance'] = $preblance = $this->m_common->get_row_array('tbl_balance',array('balanceID'=>$balanceID),'*');
        if($_POST){
            $inseartdata = array();
            $inseartdata['amount']=$postData['amount'];
            $inseartdata['balance_date']= date('Y-m-d', strtotime($postData['balance_date']));
            $inseartdata['remark']= $postData['remark'];
            
          $this->m_common->update_row('tbl_balance',array('balanceID'=>$balanceID),$inseartdata);
            if(!empty($balanceID)){
                
                 $balance_total_check = $this->m_common->get_row_array('tbl_balance_total',array('unit_id'=>$branch_id),'*');
                 if(!empty($balance_total_check)){
                    $current_balance = $balance_total_check[0]['total_amount'] - $preblance[0]['amount'];
                    $totalBalance = $current_balance + $postData['amount'];
                    $this->m_common->update_row('tbl_balance_total',array('unit_id'=>$branch_id),array('total_amount'=>$totalBalance));
                 }else{
                   $this->m_common->insert_row('tbl_balance_total',array('unit_id'=>$branch_id,'total_amount'=>$postData['amount']));  
                 }
            }
            redirect_with_msg('expense/balance', 'Blanace  Successfully Inserted'); 
            
        }
        $this->load->view('expense/edit_balance', $data);  
    }

 
    
    function delete_iamge(){
        $this->setOutputMode(NORMAL);
        $d_id = $this->input->post('d_id');
        
      $document =  $this->m_common->get_row_array('tbl_expense_document',array('expense_document_id'=>$d_id),'*');
      $retur  = $this->m_common->delete_row('tbl_expense_document', array('expense_document_id'=>$d_id));
        if($retur){
          unlink('images/expense' . "/" . $document[0]['file_name']);   
        echo json_encode(array('mag'=>'success'));
    }else{
        echo json_encode(array('mag'=>'faild'));
    }
    }

}
