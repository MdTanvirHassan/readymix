<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Money_indent extends Site_Controller {

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
        $this->sub_inner_menu = 'money_indent';
        $this->titlebackend("Money Indent");
       
     //   $data['money_indents']=$this->m_common->get_row_array('tbl_money_indent',array('is_active'=>1),'*');
        $sql="select * from tbl_money_indent where is_active=1 and status!='Rejected' order by mi_id DESC";
        $data['money_indents']=$this->m_common->customeQuery($sql);
        $this->load->view('money_indents/v_money_indent',$data);
    }

   
     function add_money_indent() {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'money_indent';
        $this->titlebackend("Add Money Indent");
        $indent_last_code=$this->m_common->get_row_array('tbl_money_indent_code','','*','',1,'id','DESC');
        if(!empty($indent_last_code)){ 
            $indent_code=$indent_last_code[0]['indent_code']+1;
            if($indent_code>999){
                $indent_sl_no=$indent_code;
            }else if($indent_code>99){
                $indent_sl_no="0".$indent_code;
            }else if($budget_code>9){
                $indent_sl_no="00".$indent_code;
            }else{
                $indent_sl_no="000".$indent_code;
            }
        }else{
            $indent_code=1;
            $indent_sl_no='0001';
        }
        $data['indent_code']=$indent_code;
        $data['indent_auto_code']=$indent_sl_no;
        //$sql="select bd.*,d.dep_description,imi.ipo_number,pm.mode_name from budget_details bd left join budget b on bd.b_id=b.b_id left join department d on bd.department_id=d.d_id left join ipo_material_indent imi on bd.indent_id=imi.ipo_m_id left join tbl_payment_mode pm on bd.payment_mode=pm.id where b.b_approve_status='Approved'";
      //  $sql="select bd.*,d.dep_description,imi.ipo_number,pm.mode_name from budget_details bd left join budget b on bd.b_id=b.b_id left join department d on bd.department_id=d.d_id left join ipo_material_indent imi on bd.indent_id=imi.ipo_m_id left join tbl_payment_mode pm on bd.payment_mode=pm.id where (b.b_approve_status='Approved') and (bd.mon_indent_status='Pending' or mon_indent_status='Partially Indented') ";
      //  $sql="select bd.*,d.dep_description,imi.ipo_number,pm.mode_name,tsu.unit_name,i.item_name from budget_details bd left join budget b on bd.b_id=b.b_id left join items i on bd.item_id=i.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id left join department d on bd.department_id=d.d_id left join ipo_material_indent imi on bd.indent_id=imi.ipo_m_id left join tbl_payment_mode pm on bd.payment_mode=pm.id where (b.b_approve_status='Approved') and (bd.mon_indent_status='Pending' or mon_indent_status='Partially Indented') order by bd.bu_d_id DESC";
      //  $sql="select bd.*,d.dep_description,imi.ipo_number,pm.mode_name,tsu.unit_name,i.item_name from budget_details bd left join budget b on bd.b_id=b.b_id left join items i on bd.item_id=i.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id left join department d on bd.department_id=d.d_id left join ipo_material_indent imi on bd.indent_id=imi.ipo_m_id left join tbl_payment_mode pm on bd.payment_mode=pm.id where (b.b_approve_status='Approved') and (bd.mon_indent_status='Pending' or mon_indent_status='Partially Indented') and b.branch_id=".$branch_id." order by bd.bu_d_id DESC";//27-12-2020
        $sql="select bd.*,d.dep_description,imi.ipo_number,pm.mode_name,tsu.unit_name,i.item_name from budget_details bd left join budget b on bd.b_id=b.b_id left join items i on bd.item_id=i.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id left join department d on bd.department_id=d.d_id left join ipo_material_indent imi on bd.indent_id=imi.ipo_m_id left join tbl_payment_mode pm on bd.payment_mode=pm.id where (b.b_approve_status='Approved') and (bd.mon_indent_status='Pending' or mon_indent_status='Partially Indented') and b.branch_id=".$branch_id." and b.b_type='Cash' order by bd.indent_no DESC";
        $data['budget_items']=$this->m_common->customeQuery($sql);
        foreach($data['budget_items'] as $key=>$value){
            $total='';
            $sql='';
         //   $sql="select sum(mid.quantity) as total_quantity from tbl_money_indent_details mid left join tbl_money_indent mi on mid.mi_id=mi.mi_id where bu_d_id=".$value['bu_d_id']." and item_id=".$value['item_id']. " and (mi.status!='Approved' or mi.status!='Rejected')";
            $sql="select sum(mid.quantity) as total_quantity from tbl_money_indent_details mid left join tbl_money_indent mi on mid.mi_id=mi.mi_id where mid.is_active=1 and bu_d_id=".$value['bu_d_id']." and item_id=".$value['item_id']. " and (mi.status='Approved' or mi.status!='Rejected')";
            $total=$this->m_common->customeQuery($sql);
         //   $data['budget_items'][$key]['budget_qty']=$data['budget_items'][$key]['budget_qty']-($data['budget_items'][$key]['mon_indent_qnt']+$total[0]['total_quantity']);
          //  $data['budget_items'][$key]['budget_qty']=$data['budget_items'][$key]['budget_qty']-($total[0]['total_quantity']);
            $data['budget_items'][$key]['budget_qty']=$data['budget_items'][$key]['budget_qty']-($total[0]['total_quantity']+$data['budget_items'][$key]['direct_p_order_qty']);
            if($data['budget_items'][$key]['budget_qty']<=0){
                unset($data['budget_items'][$key]);
            }
        }
        $data['suppliers']=$this->m_common->get_row_array('supplier',array('s_type'=>"Supplier"),'*');
       
        $this->load->view('money_indents/v_add_money_indent',$data);
    }
     function add_money_indent_action(){
        $branch_id= $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' =>$user_id), '*');
        $insertData['applicant_id'] = $userData[0]['employeeId'];
        $approver =fetch_approver(2, 39, $userData);
        $postData=$this->input->post();
        if(!empty($postData)){
             $insertData=array();
         
             if(!empty($postData['mo_indent_no'])){
                $insertData['mo_indent_no'] = $postData['mo_indent_no']; 
                
             }
             
             if(!empty($postData['date'])){
                $insertData['date'] =date('Y-m-d',strtotime($postData['date'])); 
            }
            
             if(empty($postData['item_select'])){
                 redirect_with_msg('money_indent/add_money_indent', 'Plese Select Item');
             }
             
             $insertData['branch_id'] =$branch_id;
             $insertData['applicant_id'] =$employee_id;
             $insertData['approver_id'] =$approver[0];
             $insertData['is_active']=1;
             $insertData['status']="Pending";
             $insertData['created_date']=date('Y-m-d');  
             $id = $this->m_common->insert_row('tbl_money_indent', $insertData);
             if(!empty($id)){
                 $this->m_common->insert_row('tbl_money_indent_code', array('indent_code'=>$postData['indent_code']));
                 foreach ($postData['item_id'] as $key => $each) {
                  
                     if(in_array($key,$postData['item_select'])){
                    
                                $insertData1=array();
                                $insertData1['item_id'] = $each;
                                $insertData1['mi_id'] = $id; 
                                $insertData1['purchase_order_status']="Pending";
                                if(!empty($postData['budget_id'][$key])) {
                                    $insertData1['budget_id'] = $postData['budget_id'][$key];                                    
                                }
                                
                                if(!empty($postData['bu_d_id'][$key])){
                                    $insertData1['bu_d_id'] = $postData['bu_d_id'][$key];                                  
                                }
                                
                                if(!empty($postData['item_size'][$key])){
                                    $insertData1['item_size'] = $postData['item_size'][$key];                                  
                                }
                                
                                if(!empty($postData['brand_id'][$key])){
                                    $insertData1['brand_id'] = $postData['brand_id'][$key];                                  
                                }
                                
                                if (!empty($postData['quantity'][$key])) {
                                    $insertData1['quantity'] = $postData['quantity'][$key];             
                                }
                                if (!empty($postData['unit_price'][$key])) {
                                    $insertData1['unit_price'] = $postData['unit_price'][$key];
                                }
                                if (!empty($postData['value'][$key])) {
                                    $insertData1['value'] = $postData['value'][$key];
                                }
                                
                                if(!empty($postData['payment_mode'][$key])) {
                                    $insertData1['payment_mode'] = $postData['payment_mode'][$key];
                                }
                                
                                if(!empty($postData['supplier_id'][$key])){
                                    $insertData1['supplier_id'] = $postData['supplier_id'][$key];                                  
                                }
                                
                               $insertData1['is_active']=1;                    
                               $b=$this->m_common->insert_row('tbl_money_indent_details', $insertData1); 
                               if(!empty($b)){
                                   
                               }
                              
                     }
                     
                 }
                 
                $array = array(
                     "employee_id" =>$approver[0],
                     "title" => "Budget approval",
                     "notice" => "Please approve the budget",
                     "create_date" => date('Y-m-d H:i:s'),
                     "date" => date('Y-m-d'),
                     "status" => "Unseen",
                     "url" =>"money_indent/details_money_indent/".$id
                );
                $this->m_common->insert_row("notice", $array); 
                 
                redirect_with_msg('money_indent/add_money_indent', 'Successfully  Added Material Budget ');
             }else{
                  redirect_with_msg('money_indent/add_money_indent', 'Data not saved for an unexpected error');
             }
           
         }else{
              redirect_with_msg('money_indent/add_money_indent', 'Please fill the form and submit');
         }
         
     }
    
      function edit_money_indent($id) {
        $branch_id= $this->session->userdata('companyId');   
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'money_indent';
        $this->titlebackend("Edit Money Indent");      
        $data['money_indent_info']=$this->m_common->get_row_array('tbl_money_indent',array('mi_id'=>$id),'*');
      //  $sql='select mid.*,b.b_no,bd.measurement_unit,bd.indent_no,bd.item_description,bd.budget_qty,d.dep_description,pm.mode_name from tbl_money_indent_details mid left join budget_details bd on mid.bu_d_id=bd.bu_d_id left join budget b on bd.b_id=b.b_id left join department d on bd.department_id=d.d_id left join tbl_payment_mode pm on bd.payment_mode=pm.id  where mid.mi_id='.$id;
        $sql='select mid.*,b.b_no,bd.measurement_unit,bd.indent_no,bd.item_description,bd.budget_qty,d.dep_description,pm.mode_name,tsu.unit_name,i.item_name from tbl_money_indent_details mid left join items i on mid.item_id=i.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id left join budget_details bd on mid.bu_d_id=bd.bu_d_id left join budget b on bd.b_id=b.b_id left join department d on bd.department_id=d.d_id left join tbl_payment_mode pm on bd.payment_mode=pm.id  where mid.mi_id='.$id;
        $data['budget_items']=$this->m_common->customeQuery($sql);
        $data['suppliers']=$this->m_common->get_row_array('supplier',array('s_type'=>"Supplier"),'*');
        $this->load->view('money_indents/v_edit_money_indent',$data);
    }
    
    function edit_money_indent_action($indent_id) {
         $postData=$this->input->post();
         
         if(!empty($postData)){
             $pre_info=$this->m_common->get_row_array('tbl_money_indent',array('mi_id'=>$indent_id),'*');
             $insertData=array();
             if(!empty($postData['mo_indent_no'])){
                $insertData['mo_indent_no'] = $postData['mo_indent_no'];                
             }
             
            if(!empty($postData['date'])){
                $insertData['date'] =date('Y-m-d',strtotime($postData['date'])); 
            }
            
//             if(empty($postData['item_select'])){
//                 redirect_with_msg('money_indent/add_money_indent', 'Plese Select Item');
//             }
            
            $u_id = $this->m_common->update_row('tbl_money_indent',array('mi_id'=>$indent_id),$insertData);
            if($u_id>=0){
                $delete_details=$this->m_common->delete_row('tbl_money_indent_details',array('mi_id'=>$indent_id));
                foreach ($postData['item_id'] as $key => $each) {
                  
                    // if(in_array($key,$postData['item_select'])){
                    
                            $insertData1=array();
                            $insertData1['item_id'] =$each;
                            $insertData1['mi_id'] =$indent_id;      
                            $insertData1['purchase_order_status']="Pending";
                            if(!empty($postData['budget_id'][$key])) {
                                $insertData1['budget_id'] = $postData['budget_id'][$key];
                            }
                            
                           if(!empty($postData['bu_d_id'][$key])){
                                $insertData1['bu_d_id'] = $postData['bu_d_id'][$key];                                  
                           }
                           
                            if(!empty($postData['item_size'][$key])){
                                    $insertData1['item_size'] = $postData['item_size'][$key];                                  
                            }

                            if(!empty($postData['brand_id'][$key])){
                                    $insertData1['brand_id'] = $postData['brand_id'][$key];                                  
                            }
                            
                            
                            if(!empty($postData['quantity'][$key])) {
                                $insertData1['quantity'] = $postData['quantity'][$key];             
                            }
                            if(!empty($postData['unit_price'][$key])) {
                                $insertData1['unit_price'] = $postData['unit_price'][$key];
                            }
                            if(!empty($postData['value'][$key])) {
                                $insertData1['value'] = $postData['value'][$key];
                            }

                            if(!empty($postData['payment_mode'][$key])) {
                                $insertData1['payment_mode'] = $postData['payment_mode'][$key];
                            }
                            
                            if(!empty($postData['supplier_id'][$key])){
                                $insertData1['supplier_id'] = $postData['supplier_id'][$key];                                  
                            }
                            
                           $insertData1['is_active']=1;                    
                           $b=$this->m_common->insert_row('tbl_money_indent_details', $insertData1); 
                              
                    // }
                     
                 }
                redirect_with_msg('money_indent/details_money_indent/'.$indent_id, 'Updated Successfully'); 
            }
            
         }else{
              redirect_with_msg('money_indent/add_money_indent', 'Please fill the form and submit');
         }
         
     }
    function details_money_indent($id,$print=false) {
        $branch_id= $this->session->userdata('companyId');   
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'money_indent';
        $this->titlebackend("Edit Money Indent");      
        //$data['money_indent_info']=$this->m_common->get_row_array('tbl_money_indent',array('mi_id'=>$id),'*');
        $sql="select * from tbl_money_indent tmi left join department on tmi.branch_id=department.d_id where tmi.mi_id=".$id;
        $data['money_indent_info']=$this->m_common->customeQuery($sql);
     //   $sql='select mid.*,b.b_no,bd.measurement_unit,bd.indent_no,bd.item_description,bd.budget_qty,d.dep_description,pm.mode_name from tbl_money_indent_details mid left join budget_details bd on mid.bu_d_id=bd.bu_d_id left join budget b on bd.b_id=b.b_id left join department d on bd.department_id=d.d_id left join tbl_payment_mode pm on bd.payment_mode=pm.id  where mid.mi_id='.$id;
     //   $sql='select mid.*,b.b_no,b.b_date,bd.measurement_unit,bd.indent_no,bd.item_description,bd.budget_qty,bd.indent_date,d.dep_description,pm.mode_name,tsu.unit_name,i.item_name from tbl_money_indent_details mid left join items i on mid.item_id=i.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id left join budget_details bd on mid.bu_d_id=bd.bu_d_id left join budget b on bd.b_id=b.b_id left join department d on bd.department_id=d.d_id left join tbl_payment_mode pm on bd.payment_mode=pm.id  where mid.mi_id='.$id; //03-11-2020
          $sql='select mid.*,b.b_no,b.b_date,bd.measurement_unit,bd.indent_no,bd.item_description,bd.budget_qty,bd.indent_date,d.dep_description,pm.mode_name,tsu.unit_name,i.item_name,s.SUP_NAME from tbl_money_indent_details mid left join items i on mid.item_id=i.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id left join budget_details bd on mid.bu_d_id=bd.bu_d_id left join budget b on bd.b_id=b.b_id left join department d on bd.department_id=d.d_id left join tbl_payment_mode pm on bd.payment_mode=pm.id left join supplier s on mid.supplier_id=s.ID  where mid.mi_id='.$id;
        $data['budget_items']=$this->m_common->customeQuery($sql);
        
        if($print==false){
             $this->load->view('money_indents/v_details_money_indent',$data);
        }else{
            $html=$this->load->view('money_indents/print_money_indent',$data,true);
            echo $html;
            exit; 
        }
        
    }
   
   function delete_money_indent($id) {
        if(!empty($id)) {
            $q_id=$this->m_common->get_row_array('tbl_money_indent',array('mi_id' => $id),'*');
            $result_id = $this->m_common->update_row('tbl_money_indent', array('mi_id' => $id),array('is_active'=>0));
            if(!empty($result_id)) {
              //  $this->m_common->update_row('tbl_money_indent_details', array('mi_id' =>$id),array('is_active'=>"1")); 
                $this->m_common->update_row('tbl_money_indent_details', array('mi_id' =>$id),array('is_active'=>0));  
                redirect_with_msg('money_indent/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('money_indent/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('money_indent/index', 'Please click on delete button');
        }
    }
     
   
    
   function forward_money_indent($id) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'money_indent';
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $money_indent_info = $this->m_common->get_row_array("tbl_money_indent", array('mi_id' => $id), "*");
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $money_indent_info[0]['applicant_id']), "*");
        $approver_data = fetch_approver(2, 39, $approvers_info); //
       
        if ($employee_id == $approver_data[0]) {
            $this->m_common->update_row('tbl_money_indent', array('mi_id' => $id), array('status' =>'Forward-By-First-Approver', 'approver_id' =>$approver_data[1],'approved_by' =>$employee_id,'approver_name' =>$approver_name));
            $array = array(
                "employee_id" => $approver_data[1],
                "title" => "Money indent approval",
                "notice" => "Please approve the money_indent",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "money_indent/details_money_indent/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        if ($employee_id == $approver_data[1]) {
            $this->m_common->update_row('tbl_money_indent', array('mi_id' => $id), array('status' => 'Forward-By-Second-Approver', 'approver_id' =>$approver_data[2],'approved_by' =>$employee_id,'approver_name' =>$approver_name));
            $array = array(
                "employee_id" =>$approver_data[2],
                "title" => "Money indent approval",
                "notice" => "Please approve the money_indent",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "money_indent/details_money_indent/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        if($employee_id ==$approver_data[2]) {
            $this->m_common->update_row('tbl_money_indent', array('mi_id' => $id), array('status' => 'Forward-By-First-Approver', 'approver_id' =>$approver_data[3],'approved_by' =>$employee_id,'approver_name' =>$approver_name));
            $array = array(
                "employee_id" => $approver_data[3],
                "title" => "Money indent approval",
                "notice" => "Please approve the money_indent",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "money_indent/details_money_indent/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        
        redirect_with_msg('money_indent', 'Forward Successfull');
    }
     
   function reject_money_indent($id) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'money_indent';
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $money_indent_info = $this->m_common->get_row_array("tbl_money_indent", array('mi_id' => $id), "*");
        $money_indent_details_info = $this->m_common->get_row_array("tbl_money_indent_details", array('mi_id' => $id), "*");
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $money_indent_info[0]['applicant_id']), "*");
        $approver_data = fetch_approver(2, 39, $approvers_info); //
        if($user_type==1){
            $this->m_common->update_row('tbl_money_indent', array('mi_id' => $id), array('status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
            if($money_indent_info[0]['approve_count']==1){
                foreach($money_indent_details_info as $mi_details){
                    $budget_info = $this->m_common->get_row_array("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']), "*");
                    $net_money_indent_qnt=$budget_info[0]['mon_indent_qnt']-$mi_details['quantity'];
                    if($net_money_indent_qnt==$budget_info[0]['budget_qty']){
                        $indent_status="Indented";
                        $this->m_common->update_row("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']),array('mon_indent_status'=>$indent_status,'mon_indent_qnt'=>$net_money_indent_qnt));
                    }else if($net_money_indent_qnt>0 && $net_money_indent_qnt<$budget_info[0]['budget_qty']){
                        $indent_status="Partially Indented";
                        $this->m_common->update_row("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']),array('mon_indent_status'=>$indent_status,'mon_indent_qnt'=>$net_money_indent_qnt));
                    }else if($net_money_indent_qnt==0){
                        $indent_status="Pending";
                        $this->m_common->update_row("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']),array('mon_indent_status'=>$indent_status,'mon_indent_qnt'=>$net_money_indent_qnt));
                    }

                }
                
            }
            $array = array(
                "employee_id" =>$money_indent_info[0]['applicant_id'],
                "title" => "Money indent approval",
                "notice" => "The money_indent is rejected by admin",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "money_indent/details_money_indent/".$id
            );
           $this->m_common->insert_row("notice", $array);
           
            
        }else{
            if ($employee_id == $approver_data[0]) {
                $this->m_common->update_row('tbl_money_indent', array('mi_id' => $id), array('status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$money_indent_info[0]['applicant_id'],
                    "title" => "Money indent approval",
                    "notice" => "The money_indent is rejected by first approver",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "money_indent/details_money_indent/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[1]) {
                $this->m_common->update_row('tbl_money_indent', array('mi_id' => $id), array('status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$money_indent_info[0]['applicant_id'],
                    "title" => "Money indent approval",
                    "notice" => "The money_indent is rejected by second approver",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "money_indent/details_money_indent/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[2]) {
                $this->m_common->update_row('tbl_money_indent', array('mi_id' => $id), array('status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$money_indent_info[0]['applicant_id'],
                    "title" => "Money indent approval",
                    "notice" => "The money_indent is rejected by third approver",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "money_indent/details_money_indent/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[3]) {
                $this->m_common->update_row('tbl_money_indent', array('mi_id' => $id), array('status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$money_indent_info[0]['applicant_id'],
                    "title" => "Money indent approval",
                    "notice" => "The money_indent is rejected by forth approver",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "money_indent/details_money_indent/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
        }     
        redirect_with_msg('money_indent', 'Rejected Successfully');
    }
     
   function approve_money_indent($id) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'money_indent';
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $money_indent_info = $this->m_common->get_row_array("tbl_money_indent", array('mi_id' => $id), "*");
        $money_indent_details_info = $this->m_common->get_row_array("tbl_money_indent_details", array('mi_id' => $id), "*");
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $money_indent_info[0]['applicant_id']), "*");
        $approver_data = fetch_approver(2, 39, $approvers_info); //
        if($user_type==1){
            $this->m_common->update_row('tbl_money_indent', array('mi_id' => $id), array('status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name,'approve_count'=>1));
            foreach($money_indent_details_info as $mi_details){
               $budget_info = $this->m_common->get_row_array("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']), "*");
               $net_money_indent_qnt=$budget_info[0]['mon_indent_qnt']+$mi_details['quantity'];
               if($net_money_indent_qnt==$budget_info[0]['budget_qty']){
                   $indent_status="Indented";
                   $this->m_common->update_row("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']),array('mon_indent_status'=>$indent_status,'mon_indent_qnt'=>$net_money_indent_qnt));
               }else if($net_money_indent_qnt<$budget_info[0]['budget_qty']){
                   $indent_status="Partially Indented";
                   $this->m_common->update_row("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']),array('mon_indent_status'=>$indent_status,'mon_indent_qnt'=>$net_money_indent_qnt));
               }
               
            }
            $array = array(
                "employee_id" =>$money_indent_info[0]['applicant_id'],
                "title" => "Money indent approval",
                "notice" => "The money_indent is approved",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "money_indent/details_money_indent/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }else{
            if ($employee_id == $approver_data[0]) {
                $this->m_common->update_row('tbl_money_indent', array('mi_id' => $id), array('status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name,'approve_count'=>1));
                foreach($money_indent_details_info as $mi_details){
                    $budget_info = $this->m_common->get_row_array("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']), "*");
                    $net_money_indent_qnt=$budget_info[0]['mon_indent_qnt']+$mi_details['quantity'];
                     if($net_money_indent_qnt==$budget_info[0]['budget_qty']){
                        $indent_status="Indented";
                        $this->m_common->update_row("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']),array('mon_indent_status'=>$indent_status,'mon_indent_qnt'=>$net_money_indent_qnt));
                    }else if($net_money_indent_qnt<$budget_info[0]['budget_qty']){
                        $indent_status="Partially Indented";
                        $this->m_common->update_row("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']),array('mon_indent_status'=>$indent_status,'mon_indent_qnt'=>$net_money_indent_qnt));
                    }
                    
               }
                $array = array(
                    "employee_id" =>$money_indent_info[0]['applicant_id'],
                    "title" => "Money indent approval",
                    "notice" => "The money_indent is approved",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "money_indent/details_money_indent/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[1]) {
                $this->m_common->update_row('tbl_money_indent', array('mi_id' => $id), array('status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name,'approve_count'=>1));
                foreach($money_indent_details_info as $mi_details){
                    $budget_info = $this->m_common->get_row_array("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']), "*");
                    $net_money_indent_qnt=$budget_info[0]['mon_indent_qnt']+$mi_details['quantity'];
                    if($net_money_indent_qnt==$budget_info[0]['budget_qty']){
                        $indent_status="Indented";
                        $this->m_common->update_row("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']),array('mon_indent_status'=>$indent_status,'mon_indent_qnt'=>$net_money_indent_qnt));
                    }else if($net_money_indent_qnt<$budget_info[0]['budget_qty']){
                        $indent_status="Partially Indented";
                        $this->m_common->update_row("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']),array('mon_indent_status'=>$indent_status,'mon_indent_qnt'=>$net_money_indent_qnt));
                    }
               }
                $array = array(
                    "employee_id" =>$money_indent_info[0]['applicant_id'],
                    "title" => "Money indent approval",
                    "notice" => "The money_indent is approved",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "money_indent/details_money_indent/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[2]) {
                $this->m_common->update_row('tbl_money_indent', array('mi_id' => $id), array('status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name,'approve_count'=>1));
                foreach($money_indent_details_info as $mi_details){
                    $budget_info = $this->m_common->get_row_array("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']), "*");
                    $net_money_indent_qnt=$budget_info[0]['mon_indent_qnt']+$mi_details['quantity'];
                    if($net_money_indent_qnt==$budget_info[0]['budget_qty']){
                        $indent_status="Indented";
                        $this->m_common->update_row("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']),array('mon_indent_status'=>$indent_status,'mon_indent_qnt'=>$net_money_indent_qnt));
                    }else if($net_money_indent_qnt<$budget_info[0]['budget_qty']){
                        $indent_status="Partially Indented";
                        $this->m_common->update_row("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']),array('mon_indent_status'=>$indent_status,'mon_indent_qnt'=>$net_money_indent_qnt));
                    }
               }
               $array = array(
                    "employee_id" =>$money_indent_info[0]['applicant_id'],
                    "title" => "Money indent approval",
                    "notice" => "The money_indent is approved",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "money_indent/details_money_indent/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[3]) {
               $this->m_common->update_row('tbl_money_indent', array('mi_id' => $id), array('status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name,'approve_count'=>1));
                foreach($money_indent_details_info as $mi_details){
                    $budget_info = $this->m_common->get_row_array("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']), "*");
                    $net_money_indent_qnt=$budget_info[0]['mon_indent_qnt']+$mi_details['quantity'];
                    if($net_money_indent_qnt==$budget_info[0]['budget_qty']){
                        $indent_status="Indented";
                        $this->m_common->update_row("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']),array('mon_indent_status'=>$indent_status,'mon_indent_qnt'=>$net_money_indent_qnt));
                    }else if($net_money_indent_qnt<$budget_info[0]['budget_qty']){
                        $indent_status="Partially Indented";
                        $this->m_common->update_row("budget_details", array('bu_d_id' =>$mi_details['bu_d_id']),array('mon_indent_status'=>$indent_status,'mon_indent_qnt'=>$net_money_indent_qnt));
                    }
               }
                $array = array(
                    "employee_id" =>$money_indent_info[0]['applicant_id'],
                    "title" => "Money indent approval",
                    "notice" => "The money_indent is approved",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "money_indent/details_money_indent/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
        }     
        redirect_with_msg('money_indent', 'Approved Successfully');
    }
    
    
    
    
    function get_item_material(){
        $this->setOutputMode(NORMAL);
        $id=$this->input->post('id');
        
        $data['item_info']=$this->m_common->get_row_array('tbl_sales_items',array('s_item_id'=>$id),'*');
        $sql="select tbl_d.*,tbl_m.m_name from tbl_sales_item_details tbl_d left join tbl_materials tbl_m on tbl_d.m_id=tbl_m.m_id where tbl_d.s_item_id=".$id;
        $data['item_list']=$this->m_common->customeQuery($sql);
 
        
        echo json_encode($data);
    }
   
     
   function get_money_indent_item(){
       $this->setOutputMode(NORMAL);
       $id=$this->input->post('po_id');
       $sql="select tbl_d.*,i.item_name,i.meas_unit from tbl_money_indent_details tbl_d left join items i on tbl_d.item_id=i.id where tbl_d.o_id=".$id;
       $data['item_list']=$this->m_common->customeQuery($sql);
       echo json_encode($data);
   }

}




