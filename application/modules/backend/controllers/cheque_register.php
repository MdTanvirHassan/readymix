<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cheque_register extends Site_Controller {

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

    function company() {
        $this->session->set_userdata('section', 'Tanker');
        $this->menu = 'company';
        $this->sub_menu = 'company';
        $this->titlebackend("Company List");
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('company');
            $crud->set_subject('Company');
            $crud->display_as('c_name', 'Company Name');
            $crud->display_as('c_address', 'Address');
            $crud->display_as('c_phone', 'Phone');
            $crud->display_as('c_email', 'Email');
            $crud->display_as('c_fax', 'Fax');
            $crud->display_as('remarks', 'Remarks');
            $crud->display_as('c_logo', 'Company Logo');
            $crud->fields('c_name', 'c_address', 'c_phone', 'c_email', 'c_fax', 'remarks', 'c_logo');
            $crud->columns('c_name', 'c_address', 'c_phone', 'c_email', 'c_logo');
            $crud->required_fields('c_name');
            $crud->set_field_upload('c_logo', 'assets/uploads/files');
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function party() {
        $this->session->set_userdata('section', 'Tanker');
        $this->menu = 'party';
        $this->sub_menu = 'party';
        $this->titlebackend("Party List");
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('party');
            $crud->set_subject('party');
            $crud->display_as('p_name', 'Party Name');
            $crud->display_as('p_address', 'Address');
            $crud->display_as('p_phone', 'Phone');
            $crud->display_as('p_email', 'Email');
            $crud->display_as('remarks', 'Remarks');
            $crud->fields('p_name', 'p_address', 'p_phone', 'p_email', 'remarks');
            $crud->columns('p_name', 'p_address', 'p_phone', 'p_email');
            $crud->required_fields('p_name', p_phone);

            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function cheque_list() {
        $this->menu = 'cheque_register';
        $this->sub_menu = 'cheque_list';
        $this->titlebackend("Cheque List");
        try {
//            $data['data'] = $this->m_common->get_row_array('v_cheque', '', '*');
            $data['company'] = $this->m_common->get_row_array('company', '', '*');
//            $data['bank'] = $this->m_common->get_row_array('bank', '', '*');
            $sql = "select cr.*,b.b_name as bank_name,b.branch_name,b.b_account_no,c.c_name from cheque_register cr 
JOIN tbl_banks b on cr.b_id = b.id
JOIN company c on c.c_id = cr.c_id where cr.status!='Wastage'";
            $data['data'] = $this->m_common->customeQuery($sql);
            $this->load->view('cheque_register/v_cheque', $data);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function create_cheque() {
        $postData = $this->input->post();
        if (!empty($postData)) {
            $slotinsertData = array();
            $slotinsertData['slot_date'] = date('Y-m-d');
            $slotinsertData['c_id'] = $postData['company'];
            $slotinsertData['b_id'] = $postData['bank'];
            $slotinsertData['bank_branch'] = $postData['bank_branch'];
            $slotinsertData['bank_account'] = $postData['bank_account'];
            $slotinsertData['cheque_no_start'] = $postData['cheque_no_start'];
            $slotinsertData['cheque_no_end'] = $postData['cheque_no_end'];
            $slot_id = $this->m_common->insert_row('cheque_slot', $slotinsertData);
            if ($slot_id) {
                $chk_start = $postData['cheque_no_start'];
                $chk_end = $postData['cheque_no_end'];
                $diff = $chk_end - $chk_start;
                for ($i = 0; $i <= $diff; $i++) {

//              $che_no_check  = $this->m_common->get_row_array('cheque_register',array('chk_no'=>$chk_start + $i,'c_id'=>$postData['company'],'b_id'=>$postData['bank'],'bank_branch'=>$postData['bank_branch'],'account_no'=>$postData['bank_account']),'*');
//               if(!empty($che_no_check)){
//                   continue;
//               }
                    $insertData = array();
                    $insertData['chk_no'] = ($chk_start + $i);
                    $insertData['b_id'] = $postData['bank'];
                    $insertData['created'] = date('Y-m-d');
                    $insertData['status'] = 'Created';
                    $insertData['c_id'] = $postData['company'];
                    $insertData['bank_branch'] = $postData['bank_branch'];
                    $insertData['account_no'] = $postData['bank_account'];
                    $insertData['slot_id'] = $slot_id;
                    $this->m_common->insert_row('cheque_register', $insertData);
                }
                redirect_with_msg('cheque_register/cheque_list', 'Cheque Created Successfully');
            }
        } else {
            redirect_with_msg('cheque_register/cheque_list', 'Please fill the form properly');
        }
    }

    function canceled_cheque($id) {

        if (!empty($id)) {
            $data['status'] = 'Canceled';
            $this->m_common->update_row('assigned_cheque', array('id' => $id), $data);

            redirect_with_msg('cheque_register/assigned_cheque_list', 'Cheque Canceled Successfully');
        } else {
            redirect_with_msg('cheque_register/cheque_list', 'Please fill the form properly');
        }
    }

    function delete_cheque($chk_id) {

        $this->m_common->delete_row('cheque_register', array('chk_id' => $chk_id));
        redirect_with_msg('setup/cheque_list', 'Delete Successfully');
    }

    function assigned_cheque_list() {
        $this->menu = 'assign_cheque_list';
        $this->sub_menu = 'assign_cheque_list';
        $this->titlebackend("Assigned Cheque List");
        try {
            $sql = "select ac.*,b.b_name as bank_name,c.c_name,s.SUP_NAME from assigned_cheque ac 
JOIN tbl_banks b on ac.bank_id= b.id 
JOIN company c on ac.c_id=c.c_id 
left JOIN supplier s on ac.p_id= s.ID where ac.status='issued'";
            $data['data'] = $this->m_common->customeQuery($sql);

            $sql = "select ac.*,b.b_name as bank_name,c.c_name,s.SUP_NAME from assigned_cheque ac 
JOIN tbl_banks b on ac.bank_id= b.id 
JOIN company c on ac.c_id=c.c_id 
left JOIN supplier s on ac.p_id= s.ID where ac.status='issued' ORDER BY created DESC ";
            $data['assing_chk'] = $this->m_common->customeQuery($sql);
            //$data['assing_chk'] = $this->m_common->get_row_array('v_assignchk', array('status'=>'issued'), '*');
            $data['company'] = $this->m_common->get_row_array('company', '', '*');
            //$data['party'] = $this->m_common->get_row_array('party', '', '*');
            $data['party'] = $this->m_common->get_row_array('supplier', '', '*');
            //$data['bank'] = $this->m_common->get_row_array('bank', '', '*');
//            foreach($data['bank'] as $key=>$bank){
//                $current_chk = $this->m_common->get_row_array('cheque_register', array('b_id'=>$bank['bank_id'],'status'=>'Created'), '*','','1','chk_no','ASC');
//                $data['bank'][$key]['current_chk'] = !empty($current_chk[0]['chk_no']) ? $current_chk[0]['chk_no'] : '';
//            }
$data['bank'] = $this->m_common->get_row_array('tbl_banks', array('c_id' => 1, 'b_identification'=>'Self'), 'b_name , id, b_account_no');
            $this->load->view('cheque_register/v_assign_cheque', $data);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function printed_cheque_list() {
        $this->menu = 'printed_cheque_list';
        $this->sub_menu = 'printed_cheque_list';
        $this->titlebackend("Printed Cheque List");
        try {
            $sql = "select cr.*,b.b_name,b.branch_name,b.b_account_no,c.c_name from cheque_register cr 
JOIN tbl_banks b on cr.b_id = b.id
JOIN company c on c.c_id = cr.c_id";
            $data['data'] = $this->m_common->customeQuery($sql);
            //$data['data'] = $this->m_common->get_row_array('v_cheque','', '*');
            $sql = "select ac.*,b.b_name,c.c_name,s.SUP_NAME from assigned_cheque ac JOIN tbl_banks b on ac.bank_id= b.id
JOIN company c on ac.c_id=c.c_id
left JOIN supplier s on ac.p_id= s.ID where ac.status='Printed' ORDER BY created DESC";
            $data['assing_chk'] = $this->m_common->customeQuery($sql);
            //$data['assing_chk'] = $this->m_common->get_row_array('v_assignchk', array('status'=>'Printed'), '*');
            $data['company'] = $this->m_common->get_row_array('company', '', '*');
            $data['bank'] = $this->m_common->get_row_array('tbl_banks', '', '*');
            foreach ($data['bank'] as $key => $bank) {
                $current_chk = $this->m_common->get_row_array('cheque_register', array('b_id' => $bank['id'], 'status' => 'Created'), '*', '', '1', 'chk_no', 'ASC');
                $data['bank'][$key]['current_chk'] = !empty($current_chk[0]['chk_no']) ? $current_chk[0]['chk_no'] : '';
            }
            $this->load->view('cheque_register/v_printed_cheque', $data);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function printedCheque($chk_id) {
        if ($chk_id) {
//            
//        $data = $this->m_common->get_row_array('assigned_cheque',array('id'=>$chk_id),'*');
//       $c_id = $data[0]['c_id'];
//       $bank_id = $data[0]['bank_id'];
//       $bank_branch = $data[0]['bank_branch'];
//       $bank_account = $data[0]['bank_account'];
//       $chk_no = $data[0]['chk_no'];
//       $chkdata= $this->m_common->get_row_array('cheque_register',array('c_id'=>$c_id,'b_id'=>$bank_id,'bank_branch'=>$bank_branch,'account_no'=>$bank_account,'chk_no'=>$chk_no),'*');
//       $cg_id = $chkdata[0]['chk_id'];
//        $this->m_common->update_row('cheque_register',array('chk_id'=>$cg_id),array('status'=>'Printed'));
            $this->m_common->update_row('assigned_cheque', array('id' => $chk_id), array('status' => 'Printed'));
            redirect_with_msg('cheque_register/assigned_cheque_list', 'Cheque printed Successfully');
        }
    }

    function issued_cheque() {

        $postData = $this->input->post();
        $ass_cheque = $this->m_common->get_row_array('assigned_cheque', array('id' => $postData['issue_id']), '*');
        $bank = $this->m_common->get_row_array('tbl_banks', array('id' => $ass_cheque[0]['bank_id']), '*');
        $vourch_code = $this->m_common->get_row_array('assigned_cheque', '', '*', '', 1, 'vourch_sl', 'DESC');
        if (!empty($vourch_code)) {
            $vourch_sl = $vourch_code[0]['vourch_sl'] + 1;
            if ($vourch_sl > 999) {
                $vourch_no = $bank[0]['b_short_name'] . '-' . $vourch_sl;
            } else if ($vourch_sl > 99) {
                $vourch_no = $bank[0]['b_short_name'] . "-0" . $vourch_sl;
            } else if ($vourch_sl > 9) {
                $vourch_no = $bank[0]['b_short_name'] . "-00" . $vourch_sl;
            } else {
                $vourch_no = $bank[0]['b_short_name'] . "-000" . $vourch_sl;
            }
        } else {
            $$vourch_sl = 1;
            $vourch_no = $bank[0]['b_short_name'] . '-0001';
        }
        $data['vourch_sl'] = $vourch_sl;
        $data['vourch_no'] = $vourch_no;

        if (!empty($postData)) {

            $insertData = array();
            $data['status'] = 'Completed';
            $data['issued_date'] = date('Y-m-d', strtotime($postData['issued_date']));
            $data['receive_by'] = $postData['receive_by'];
            $data['remarks'] = $postData['remarks'];

            $this->m_common->update_row('assigned_cheque', array('id' => $postData['issue_id']), $data);

            redirect_with_msg('cheque_register/acknowledge/' . $postData['issue_id'], 'Cheque Assigned Successfully');
        } else {
            redirect_with_msg('cheque_register/cheque_list', 'Please fill the form properly');
        }
    }

    function issued_cheque_list() {
        $this->menu = 'issued_cheque_list';
        $this->sub_menu = 'issued_cheque_list';
        $this->titlebackend("Issued Cheque List");
        try {
            $sql = "select cr.*,b.b_name as bank_name,b.branch_name,b.b_account_no,c.c_name from cheque_register cr 
JOIN tbl_banks b on cr.b_id = b.id
JOIN company c on c.c_id = cr.c_id";
            $data['data'] = $this->m_common->customeQuery($sql);
            //$data['data'] = $this->m_common->get_row_array('v_cheque','', '*');
            $sql = "select ac.*,b.b_name as bank_name,c.c_name,s.SUP_NAME from assigned_cheque ac JOIN tbl_banks b on ac.bank_id= b.id
LEFT JOIN company c on ac.c_id=c.c_id
LEFT JOIN supplier s on ac.p_id= s.ID where ac.status='Completed' ORDER BY created DESC ";
            $data['assing_chk'] = $this->m_common->customeQuery($sql);
            //$data['assing_chk'] = $this->m_common->get_row_array('v_assignchk', array('status'=>'Completed'), '*');

            $data['company'] = $this->m_common->get_row_array('company', '', '*');
            $data['bank'] = $this->m_common->get_row_array('tbl_banks', '', '*');
            foreach ($data['bank'] as $key => $bank) {
                $current_chk = $this->m_common->get_row_array('cheque_register', array('b_id' => $bank['id'], 'status' => 'Created'), '*', '', '1', 'chk_no', 'ASC');
                $data['bank'][$key]['current_chk'] = !empty($current_chk[0]['chk_no']) ? $current_chk[0]['chk_no'] : '';
            }
            $this->load->view('cheque_register/v_issued_cheque', $data);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function cheque_wastage($chk_id) {
        if ($chk_id) {
            $this->m_common->update_row('cheque_register', array('chk_id' => $chk_id), array('status' => 'Wastage'));
            redirect_with_msg('cheque_register/wastage_cheque_list', 'Cheque Wastage Successfully');
        }
    }

    function wastage_cheque_list() {
        $this->menu = 'wastage_cheque_list';
        $this->sub_menu = 'wastage_cheque_list';
        $this->titlebackend("Wastage Cheque List");
        try {
            $sql = "select cr.*,b.b_name,b.branch_name,b.b_account_no,c.c_name from cheque_register cr 
JOIN tbl_banks b on cr.b_id = b.id
JOIN company c on c.c_id = cr.c_id";
            $data['data'] = $this->m_common->customeQuery($sql);
            //$data['data'] = $this->m_common->get_row_array('v_cheque','', '*');
            //$data['assing_chk'] = $this->m_common->get_row_array('v_assignchk', array('status'=>'Completed'), '*');
            $sql = " select cr.*,b.b_name,c.c_name from cheque_register cr join tbl_banks b on b.id=cr.b_id join company c on c.c_id=cr.c_id where status='Wastage'  ORDER BY created DESC";
            $data['assing_chk'] = $this->m_common->customeQuery($sql);
            $this->load->view('cheque_register/v_wastage_cheque', $data);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function returnChequeList($chk_id) {
        if ($chk_id) {
            $this->m_common->update_row('cheque_register', array('chk_id' => $chk_id), array('status' => 'Created'));
            redirect_with_msg('cheque_register/wastage_cheque_list', 'Cheque Return Successfully');
        }
    }

    function insertAssign_cheque() {
        $postData = $this->input->post();
        $che_no_check = $this->m_common->get_row_array('assigned_cheque', array('chk_no' => $postData['current_chk'], 'c_id' => $postData['company'], 'bank_id' => $postData['bank'], 'bank_branch' => $postData['bank_branch'], 'bank_account' => $postData['bank_account']), '*');
        if (!empty($che_no_check)) {
            redirect_with_msg('cheque_register/assigned_cheque_list', 'This cheque NO. already exist');
        }
        if (empty($postData['showpayto'])) {
            $showpayto = 'NO';
        } else {
            $showpayto = $postData['showpayto'];
        }
        if (!empty($postData)) {

            $insertData = array();

            $insertData['bank_id'] = $postData['bank'];
            $insertData['c_id'] = $postData['company'];
            $insertData['bank_branch'] = $postData['bank_branch'];
            $insertData['bank_account'] = $postData['bank_account'];
            $insertData['chk_no'] = $postData['current_chk'];
            if (!empty($postData['cheque_date'])) {
                $insertData['chk_date'] = date('y-m-d', strtotime($postData['cheque_date']));
            }
            $insertData['chk_type'] = $postData['chk_type'];
            $insertData['p_id'] = $postData['party'];
            $insertData['amount'] = $postData['amount'];
            $insertData['created'] = date('Y-m-d');
            $insertData['showpayto'] = $showpayto;

            $this->m_common->insert_row('assigned_cheque', $insertData);

            $data['status'] = 'Pending';

            $this->m_common->update_row('cheque_register', array('chk_no' => $postData['current_chk']), $data);

            redirect_with_msg('cheque_register/assigned_cheque_list', 'Cheque Assigned Successfully');
        } else {
            redirect_with_msg('cheque_register/cheque_list', 'Please fill the form properly');
        }
    }
    
    function edit_cheque_assing($id){
       $this->menu = 'assign_cheque_list';
        $this->sub_menu = 'assign_cheque_list';
        $this->titlebackend("Assigned Cheque List");
        try {
            $data['che_id'] = $id;
            $data['currentdata'] = $currentdata = $this->m_common->get_row_array('assigned_cheque',array('id'=>$id), '*');
            //$data['data'] = $this->m_common->get_row_array('v_cheque','', '*');
            //$data['assing_chk'] = $this->m_common->get_row_array('v_assignchk', array('status'=>'issued'), '*');
            $data['company'] = $this->m_common->get_row_array('company', '', '*');
            $data['party'] = $this->m_common->get_row_array('supplier', '', '*');
           $data['bank'] = $this->m_common->get_row_array('tbl_banks', '', '*');
            foreach($data['bank'] as $key=>$bank){
                $current_chk = $this->m_common->get_row_array('cheque_register', array('b_id'=>$bank['bank_id'],'status'=>'Created'), '*','','1','chk_no','ASC');
                $data['bank'][$key]['current_chk'] = !empty($current_chk[0]['chk_no']) ? $current_chk[0]['chk_no'] : '';
            }
            
            
            $this->load->view('cheque_register/v_edit_assing_cheque',$data);  
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        } 
    }
    
    function edit_cheque_assing_action($id) {
        $postData = $this->input->post();
        $che_no_check  = $this->m_common->get_row_array('assigned_cheque',array('chk_no'=>$postData['current_chk'],'c_id'=>$postData['company'],'bank_id'=>$postData['bank'],'bank_branch'=>$postData['bank_branch'],'bank_account'=>$postData['bank_account']),'*');
              // if(!empty($che_no_check)){
               //  redirect_with_msg('cheque_register/assigned_cheque_list', 'This cheque NO. already exist');  
              // }
        if(empty($postData['showpayto'])){
            $showpayto = 'NO';
        }else{
            $showpayto = $postData['showpayto'];
        }
        if (!empty($postData)) {
            
                $insertData = array();
                
                $insertData['bank_id'] = $postData['bank'];
                $insertData['c_id'] = $postData['company'];
                $insertData['bank_branch'] = $postData['bank_branch'];
                $insertData['bank_account'] = $postData['bank_account'];
                $insertData['chk_no'] = $postData['current_chk'];
                $insertData['chk_date'] = date('y-m-d', strtotime( $postData['cheque_date']));
                $insertData['chk_type'] = $postData['chk_type'];
                $insertData['p_id'] = $postData['party'];
                $insertData['amount'] = $postData['amount'];
                $insertData['showpayto'] = $showpayto;
                
                $id =$this->m_common->update_row('assigned_cheque',array('id'=>$id), $insertData);
                
//                $data['status'] = 'Pending';
//                
//                $this->m_common->update_row('cheque_register',array('chk_no'=>$postData['current_chk']),$data);
            
            //redirect_with_msg('setup/assigned_cheque_list', 'Cheque Assigned Successfully');
            redirect_with_msg('cheque_register/assigned_cheque_list/'.$id, 'Assigned Cheque Edit Successfully');
        } else {
            redirect_with_msg('cheque_register/assigned_cheque_list', 'Please fill the form properly');
        }
    }
    function assCheconfirm(){
       $this->setOutputMode(NORMAL);
        $che_id = $this->input->post('cheque_id');
        $print_date = $this->input->post('print_date');
         $updateData = array();
                
                $updateData['print_status'] = 'YES';
                $updateData['print_date'] = date('Y-m-d',strtotime($print_date));
             $this->m_common->update_row('assigned_cheque',array('id'=>$che_id),$updateData); 
           
        redirect_with_msg('cheque_register/assigned_cheque_list', 'This cheque is successfully printed'); 
        
    }

    function honorData() {
        $honordate = date('Y-m-d', strtotime($this->input->post('honor_date')));
        $id = $this->input->post('assign_id');
        //echo $honordate;exit;
        $this->m_common->update_row('assigned_cheque', array('id' => $id), array('honor_date' => $honordate));
        redirect_with_msg('cheque_register/issued_cheque_list', 'Add Honor Date Successfully');
    }

    function deleteAssignChk($chk_no) {

        $this->m_common->delete_row('assigned_cheque', array('chk_no' => $chk_no));

        $data['status'] = 'Created';
        $this->m_common->update_row('cheque_register', array('chk_no' => $chk_no), $data);
        redirect_with_msg('setup/assigned_cheque_list', 'Delete Successfully');
    }

    function chequePrint($chk_no) {
        $this->menu = 'issued_cheque_list';
        $this->sub_menu = 'cheque_list';
        $this->titlebackend("Issued Cheque List");
        $this->setOutputMode(NORMAL);
        try {
            $sql = "select ac.*,b.b_name,c.c_name,s.SUP_NAME from assigned_cheque ac JOIN tbl_banks b on ac.bank_id= b.id
JOIN company c on ac.c_id=c.c_id
left JOIN supplier s on ac.p_id= s.ID where ac.id=$chk_no";
            $data['cheque_info'] = $this->m_common->customeQuery($sql);
            //$data['cheque_info'] = $this->m_common->get_row_array('v_assignchk', array('id'=>$chk_no),'*');
            $data['bank_info'] = $this->m_common->get_row_array('tbl_banks', array('id' => $data['cheque_info'][0]['bank_id']), '*');

          //  if ($data['cheque_info'][0]['print_status'] == 'NO') {
            //    $this->m_common->update_row('assigned_cheque', array('id' => $chk_no), array('print_status' => 'YES'));
          //  }
            $this->load->view('cheque_register/v_cheque_print', $data);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

//        $html = $this->load->view('v_cheque_print', $data, true);
//         $this->load->library("mpdf_lib5");
//         $this->mpdf_lib5->WriteHTML($html);
//         $this->mpdf_lib5->Output();
    }

    function acknowledge($assignCheckID) {
        $this->menu = 'issued_cheque_list';
        $this->sub_menu = 'cheque_list';
        $this->titlebackend("Issued Cheque List");

        try {
            if ($assignCheckID) {
                $sql = "select ac.*,b.b_name,c.c_name,s.SUP_NAME from assigned_cheque ac JOIN tbl_banks b on ac.bank_id= b.id
LEFT JOIN company c on ac.c_id=c.c_id
LEFT JOIN supplier s on ac.p_id= s.ID where ac.id=$assignCheckID";
                $data['issuedCheque'] = $this->m_common->customeQuery($sql);
                //$data['issuedCheque'] = $this->m_common->get_row_array('v_assignchk',array('id'=>$assignCheckID),'*');
                $this->load->view('cheque_register/v_acknowledge', $data);
            }
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

//        $html = $this->load->view('v_cheque_print', $data, true);
//         $this->load->library("mpdf_lib5");
//         $this->mpdf_lib5->WriteHTML($html);
//         $this->mpdf_lib5->Output();
    }

    function get_noa_value() {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');
        $data = $this->m_common->get_row_array('noa_details', array('noa_id' => $id), '*');
        echo json_encode(array('msg' => 'success', 'value' => $data[0]['noa_value']));
    }

    function get_ab_account() {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');
        $data = $this->m_common->get_row_array('bank', array('bank_id' => $id), '*');
        echo json_encode(array('msg' => 'success', 'value' => $data[0]['account_no']));
    }

    function getbank() {
        $this->setOutputMode(NORMAL);
        $user_type = $this->session->userdata('user_type');
        $employeeId = $this->session->userdata('employeeId');
        $c_id = $this->input->post('c_id');
        $data = $this->m_common->get_row_array('tbl_banks', array('c_id' => $c_id, 'b_identification'=>'Self'), 'b_name , id, b_account_no');
//        if($user_type == 1){
//        $data = $this->m_common->get_row_array('tbl_banks',array('c_id'=>$c_id),'b_name , id, b_account_no');
//        }else{
//          $data = $this->m_common->get_row_array('tbl_bank',array('c_id'=>$c_id,'employeeId'=>$employeeId),'bank_name , bank_id, account_no');  
//        }
        echo json_encode(array('msg' => 'success', 'value' => $data));
    }

    function getBranch() {
        $this->setOutputMode(NORMAL);
        $b_name = $this->input->post('b_name');
        $data = $this->m_common->get_row_array('tbl_banks', array('id' => $b_name), 'branch_name', 'branch_name');
        echo json_encode(array('msg' => 'success', 'value' => $data));
    }
    function getBankData() {
        $this->setOutputMode(NORMAL);
        $b_name = $this->input->post('b_name');
        $data = $this->m_common->get_row_array('tbl_banks', array('id' => $b_name), '*');
        echo json_encode(array('msg' => 'success', 'value' => $data));
    }

    function getAccountNo() {
        $this->setOutputMode(NORMAL);
        $b_branch = $this->input->post('b_branch');
        $c_id = $this->input->post('c_id');
        $b_name = $this->input->post('b_name');
        $data = $this->m_common->get_row_array('tbl_banks', array('c_id' => $c_id, 'branch_name' => $b_branch, 'id' => $b_name), 'b_account_no,b_account_type', 'b_account_no');
        //$data = $this->m_common->get_row_array('bank',array('bank_branch'=>$b_branch),'account_no','account_no');
        echo json_encode(array('msg' => 'success', 'value' => $data));
    }

    function getchequeno() {
        $this->setOutputMode(NORMAL);
        $c_id = $this->input->post('c_id');
        $b_id = $this->input->post('b_id');
        $b_branch = $this->input->post('b_branch');
        $b_account = $this->input->post('b_account');
//        $bank = $this->m_common->get_row_array('tbl_banks', array('c_id'=>$c_id,'branch_name'=>$b_branch,'b_account_no'=>$b_account), 'id');
//        $b_id =$bank[0]['id'];
        $data = $this->m_common->get_row_array('cheque_register', array('c_id' => $c_id, 'b_id' => $b_id, 'bank_branch' => $b_branch, 'account_no' => $b_account, 'status' => 'Created'), 'chk_no,', '', '1', 'chk_id', 'ASC');
        echo json_encode(array('msg' => 'success', 'value' => $data[0]['chk_no']));
    }

    function cheque_no_check() {
        $this->setOutputMode(NORMAL);
        $c_id = $this->input->post('c_id');
        $b_id = $this->input->post('b_id');
        $b_branch = $this->input->post('b_branch');
        $b_account = $this->input->post('b_account');
        $current_chk = $this->input->post('current_chk');

        $data = $this->m_common->get_row_array('assigned_cheque', array('chk_no' => $current_chk, 'c_id' => $c_id, 'bank_id' => $b_id, 'bank_branch' => $b_branch, 'bank_account' => $b_account), '*');
        if ($data) {
            echo json_encode(array('msg' => 'success', 'value' => $data[0]['chk_no']));
        } else {
            echo json_encode(array('msg' => 'Failed', 'value' => ''));
        }
    }

    function partyaddbyajax() {
        $this->setOutputMode(NORMAL);
        $party_name = $this->input->post('party_name');
        $party_phone = $this->input->post('party_phone');
        $party_address = $this->input->post('party_address');
        $insertData = array();

        $insertData['p_name'] = $party_name;
        $insertData['p_phone'] = $party_phone;
        $insertData['p_address'] = $party_address;


        $party_id = $this->m_common->insert_row('party', $insertData);

        $data = $this->m_common->get_row_array('party', array('p_id' => $party_id), '*');
        //$data  = $this->m_common->get_row_array('party','','*');
        if ($data) {
            echo json_encode(array('msg' => 'success', 'value' => $data));
        } else {
            echo json_encode(array('msg' => 'Failed', 'value' => ''));
        }
    }

    function created_cheque_slot_list() {
        $this->menu = 'cheque_list';
        $this->sub_menu = 'cheque_list';
        $this->titlebackend("Cheque List");
        try {
            $sql = "SELECT s.*,c.c_name,b.b_name as bank_name,b.branch_name,b.b_account_no from cheque_slot s 
JOIN company c on s.c_id=c.c_id
JOIN tbl_banks b on s.b_id=b.id";
            $data['data'] = $this->m_common->customeQuery($sql);

            $this->load->view('cheque_register/v_created_cheque_slot_list', $data);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function created_cheque_slot_delete($slot_id) {
        if ($slot_id) {
            $this->m_common->delete_row('cheque_register', array('slot_id' => $slot_id));
            $this->m_common->delete_row('cheque_slot', array('slot_id' => $slot_id));
            redirect_with_msg('cheque_register/created_cheque_slot_list', 'Delete Successfully');
        }
        redirect_with_msg('cheque_register/created_cheque_slot_list', 'No date found by this id');
    }

    function noticedetails($noticeID) {
//      $this->menu = 'issued_cheque_list';
//        $this->sub_menu = 'cheque_list';
        $this->titlebackend("Notice Details");
        try {
            if ($noticeID) {
                $data['data'] = $this->m_common->get_row_array('notice', array('noticeID' => $noticeID), '*');
                $this->m_common->update_row('notice', array('noticeID' => $noticeID), array('status' => 'Seen'));
                $this->load->view('v_notice', $data);
            }
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function dailyChk() {
        $this->menu = 'report';
        $this->sub_menu = 'daily_cheque_register';
        $this->titlebackend("DAILY CHEQUE REGISTER");
        $data['companys'] = $this->m_common->get_row_array('company', '', '*');
        $data['suppliers'] = $this->m_common->get_row_array('supplier', '', '*','','','SUP_NAME','ASC');
        //$data['data'] = $this->m_common->get_row_array('v_assignchk','','*');
        $table = 'v_assignchk';
        $postData = $this->input->post();
        if (!empty($postData)) {

            $startDate = date('Y-m-d', strtotime($_POST['startDate']));
            $endDate = date('Y-m-d', strtotime($_POST['endDate']));
            $company = $_POST['company'];
            $party = $_POST['party'];
            $data['startDate'] = $startDate;
            $data['endDate'] = $endDate;
            $data['p_id'] = $party;

//            $where.=" between '" . $startDate . "' and '" . $endDate . "' and t_status='" . ucfirst($menu) . "'";
            if (!empty($party)) {
                $sql = "select cr.*,c.c_name,b.b_name,b.branch_name, s.SUP_NAME from assigned_cheque cr 
JOIN company c on cr.c_id=c.c_id
left JOIN supplier s on cr.p_id=s.ID
JOIN tbl_banks b on cr.bank_id=b.id where p_id= '" . $party . "' and chk_date between '" . $startDate . "' and '" . $endDate . "'";

                //$sql = "select * from $table where c_name= '".$company."' and chk_date between '" . $startDate . "' and '" . $endDate . "'";
            } else {
                $sql = "select cr.*,c.c_name,b.b_name,b.branch_name, s.SUP_NAME from assigned_cheque cr 
JOIN company c on cr.c_id=c.c_id
left JOIN supplier s on cr.p_id=s.ID
JOIN tbl_banks b on cr.bank_id=b.id where  chk_date between '" . $startDate . "' and '" . $endDate . "'";


                // $sql = "select * from $table where chk_date between '" . $startDate . "' and '" . $endDate . "'"; 
            }

            $data['data'] = $this->m_common->customeQuery($sql);

            $this->load->view('cheque_register/daily_chk_reg', $data);
        } else {

            $date = date('Y-m');
            $lastDay = date("t", strtotime($date));
            $startDate = $date . '-' . '01';
            $endDate = $date . '-' . $lastDay;
            $data['startDate'] = $startDate;
            $data['endDate'] = $endDate;
            $this->load->view('cheque_register/daily_chk_reg', $data);
        }
    }

    function allChequeReport() {
        $this->menu = 'finance';
        $this->sub_menu = 'all_cheque_report';
        $this->titlebackend("DAILY CHEQUE REGISTER");
        $data['companys'] = $this->m_common->get_row_array('company', '', '*');

        $table = 'v_assignchk';
        $postData = $this->input->post();
        if (!empty($postData)) {
            $where = "";
            if (!empty($_POST['company'])) {
                $where .= " and cr.c_id=" . $_POST['company'];
                $this->data['company'] = $_POST['company'];
                $this->data['company_name'] = $this->m_common->get_row_array('company', array('c_id' => $_POST['company']), '*');
            }
            if (!empty($_POST['bank'])) {
                if ($_POST['status'] == 'Created' || $_POST['status'] == 'Wastage') {
                    $where .= " and cr.b_id=" . $_POST['bank'];
                } else {
                    $where .= " and cr.bank_id=" . $_POST['bank'];
                }

                $this->data['bank'] = $_POST['bank'];
                $this->data['banks'] = $this->m_common->get_row_array('tbl_banks', array('id' => $_POST['bank']), '*');
            } else {
                $this->data['bank'] = '';
            }

            if (!empty($_POST['bank_branch'])) {
                $where .= " and cr.bank_branch='" . $_POST['bank_branch'] . "'";
                $this->data['bank_branch'] = $_POST['bank_branch'];
                $this->data['banks_branch'] = $this->m_common->get_row_array('tbl_banks', array('id' => $_POST['bank'], 'branch_name' => $_POST['bank']), '*');
            } else {
                $this->data['bank'] = '';
            }

            if (!empty($_POST['status'])) {
                //$where .=" and cr.status='".$_POST['status']."'";
            if($_POST['status'] == 'Honor'){
                $status = 'Completed';
            }else{
              $status = $_POST['status'];  
            }
                $this->data['status'] = $_POST['status'];
            } else {
                $this->data['status'] = '';
            }
            if ($_POST['status'] == 'Created' || $_POST['status'] == 'Wastage') {

                if (!empty($_POST['bank'])) {
                    $where .= " and cr.b_id=" . $_POST['bank'];
                    $this->data['bank'] = $_POST['bank'];
                    $this->data['banks'] = $this->m_common->get_row_array('tbl_banks', array('id' => $_POST['bank']), '*');
                } else {
                    $this->data['bank'] = '';
                }

                if (!empty($_POST['bank_account'])) {
                    $where .= " and cr.account_no='" . $_POST['bank_account'] . "'";
                    $this->data['bank_account'] = $_POST['bank_account'];
                } else {
                    $this->data['bank_account'] = '';
                }
                
                if (!empty($_POST['startDate']) && !empty($_POST['endDate'])) {
                   $startDate = date('Y-m-d',  strtotime($_POST['startDate']));
                   $endDate = date('Y-m-d',  strtotime($_POST['endDate']));
                   $this->data['startDate'] = $startDate;
                    $this->data['endDate'] = $endDate;
                } else {
                    $this->data['startDate'] = '';
                    $this->data['endDate'] = '';
                }


                $sql = "select cr.*,c.c_name,b.b_name,b.branch_name from cheque_register cr 
JOIN company c on cr.c_id=c.c_id
JOIN tbl_banks b on cr.b_id=b.id where  status='" . $_POST['status'] . "'  " . $where;
            } else {

                if (!empty($_POST['bank'])) {
                    $where .= " and cr.bank_id=" . $_POST['bank'];
                    $this->data['bank'] = $_POST['bank'];
                    $this->data['banks'] = $this->m_common->get_row_array('tbl_banks', array('id' => $_POST['bank']), '*');
                } else {
                    $this->data['bank'] = '';
                }

                if (!empty($_POST['bank_account'])) {
                    $where .= " and cr.bank_account='" . $_POST['bank_account'] . "'";
                    $this->data['bank_account'] = $_POST['bank_account'];
                } else {
                    $this->data['bank_account'] = '';
                }
                if (!empty($_POST['chq_type'])) {
                    $where .= " and cr.chk_type='" . $_POST['chq_type'] . "'";
                    $this->data['chq_type'] = $_POST['chq_type'];
                } else {
                    $this->data['chq_type'] = '';
                }
                if (!empty($_POST['startDate']) && !empty($_POST['endDate'])) {
                   $startDate = date('Y-m-d',  strtotime($_POST['startDate']));
                   $endDate = date('Y-m-d',  strtotime($_POST['endDate']));
                    if($_POST['status'] == 'Issued'){
                      $where .= " and cr.chk_date BETWEEN '" . $startDate . "' and '" . $endDate . "'";  
                    }  else if($_POST['status'] == 'Completed'){
                      $where .= " and cr.issued_date BETWEEN '" . $startDate . "' and '" . $endDate . "'";    
                    }else if($_POST['status'] == 'Honor'){
                      $where .= " and honor_date IS NOT NULL and cr.honor_date BETWEEN '" . $startDate . "' and '" . $endDate . "'";    
                    }
                    
                    
                    $this->data['startDate'] = $startDate;
                    $this->data['endDate'] = $endDate;
                } else {
                    $this->data['startDate'] = '';
                    $this->data['endDate'] = '';
                }
                $sql = "select cr.*,c.c_name,b.b_name,b.branch_name,s.NAME,s.SUP_NAME from assigned_cheque cr 
JOIN company c on cr.c_id=c.c_id
JOIN tbl_banks b on cr.bank_id=b.id 
LEFT JOIN  supplier s on cr.p_id=s.id
where  cr.status='" . $status . "'  " . $where;
             
            }
            $data['data'] = $this->m_common->customeQuery($sql);

            $this->load->view('cheque_register/allchequereport', $data);
        } else {
            
            $this->data['status'] = 'Created';
            $date = date('Y-m');
            $lastDay = date("t", strtotime($date));
            $startDate = $date . '-' . '01';
            $endDate = $date . '-' . $lastDay;
            $data['startDate'] = $startDate;
            $data['endDate'] = $endDate;
            
            $sql = "select ca.*,c.c_name,b.b_name,s.NAME,s.SUP_NAME from assigned_cheque ca 
JOIN company c on ca.c_id=c.c_id
JOIN tbl_banks b on ca.bank_id=b.id 
LEFT JOIN  supplier s on ca.p_id=s.id
where chk_date BETWEEN '$startDate' and '$endDate' and ca.status='Issued' ";
            $data['data'] = $this->m_common->customeQuery($sql);
            $this->load->view('cheque_register/allchequereport', $data);
        }
    }
    
    function daily_printed_cheque_report() {
        $this->menu = 'finance';
        $this->sub_menu = 'daily_printed_cheque_report';
        $this->titlebackend("DAILY CHEQUE REGISTER");
        $data['companys'] = $this->m_common->get_row_array('company', '', '*');

        $table = 'v_assignchk';
        $postData = $this->input->post();
        if (!empty($postData)) {
            $where = "";
            if (!empty($_POST['company'])) {
                $where .= " and cr.c_id=" . $_POST['company'];
                $this->data['company'] = $_POST['company'];
                $this->data['company_name'] = $this->m_common->get_row_array('company', array('c_id' => $_POST['company']), '*');
            }
            if (!empty($_POST['bank'])) {
                if ($_POST['status'] == 'Created' || $_POST['status'] == 'Wastage') {
                    $where .= " and cr.b_id=" . $_POST['bank'];
                } else {
                    $where .= " and cr.bank_id=" . $_POST['bank'];
                }

                $this->data['bank'] = $_POST['bank'];
                $this->data['banks'] = $this->m_common->get_row_array('tbl_banks', array('id' => $_POST['bank']), '*');
            } else {
                $this->data['bank'] = '';
            }

            if (!empty($_POST['bank_branch'])) {
                $where .= " and cr.bank_branch='" . $_POST['bank_branch'] . "'";
                $this->data['bank_branch'] = $_POST['bank_branch'];
                $this->data['banks_branch'] = $this->m_common->get_row_array('tbl_banks', array('id' => $_POST['bank'], 'branch_name' => $_POST['bank']), '*');
            } else {
                $this->data['bank'] = '';
            }

           

                if (!empty($_POST['bank_account'])) {
                    $where .= " and cr.bank_account='" . $_POST['bank_account'] . "'";
                    $this->data['bank_account'] = $_POST['bank_account'];
                } else {
                    $this->data['bank_account'] = '';
                }
                
                if (!empty($_POST['current_date'])) {
                   $current_date = date('Y-m-d',  strtotime($_POST['current_date']));
                   
                   $this->data['today'] = $current_date;
                    
                } else {
                    $this->data['today'] = '';
                    
                }


             


                
                if (!empty($_POST['chq_type'])) {
                    $where .= " and cr.chk_type='" . $_POST['chq_type'] . "'";
                    $this->data['chq_type'] = $_POST['chq_type'];
                } else {
                    $this->data['chq_type'] = '';
                }
               
                $sql = "select cr.*,c.c_name,b.b_name,b.branch_name,s.NAME,s.SUP_NAME from assigned_cheque cr 
JOIN company c on cr.c_id=c.c_id
JOIN tbl_banks b on cr.bank_id=b.id 
LEFT JOIN  supplier s on cr.p_id=s.id
where cr.status='Issued' and  cr.print_date='" . $current_date . "'  " . $where;
             
        
            $data['data'] = $this->m_common->customeQuery($sql);

            $this->load->view('cheque_register/daily_printed_cheque', $data);
        } else {
            
            $this->data['status'] = 'Created';
            $today = date('Y-m-d');
            
            $data['today'] = $today;
            
            $sql = "select ca.*,c.c_name,b.b_name,s.NAME,s.SUP_NAME from assigned_cheque ca 
JOIN company c on ca.c_id=c.c_id
JOIN tbl_banks b on ca.bank_id=b.id 
LEFT JOIN  supplier s on ca.p_id=s.id
where print_date='$today' and ca.status='Issued' ";
            $data['data'] = $this->m_common->customeQuery($sql);
            $this->load->view('cheque_register/daily_printed_cheque', $data);
        }
    }

//    Cheque Dashboard Start

    function dashboard() {
        if (!$this->is_logged_in($this->session->userdata('logged_in'))) {
            redirect_with_msg('backend/login', 'Please Login to see this page');
        } else {
            // redirect('backend/setup');
            $this->menu = 'cheque_register';
            $this->sub_menu = 'dashboard';

            $this->titlebackend("Dashboard");


            //$banks = $this->m_common->get_row_array('bank','','*');
            $sql = "select b.*,c.c_name from tbl_banks b join company c on b.c_id=c.c_id where b_identification='Self'";
            $banks = $this->m_common->customeQuery($sql);
            $data['bank'] = $banks;
            foreach ($banks as $key => $row) {
                $totalvalue = 0;
                $totalunprevalue = 0;
                $bank_id = $row['id'];
                $bankwaischeque = $this->m_common->get_row_array('cheque_register', array('b_id' => $bank_id, 'status' => 'Created'), '*');
                $unsql = "select * from assigned_cheque WHERE bank_id=$bank_id and (`status`='Issued' or `status`='Printed')";
                $unissueshk = $this->m_common->customeQuery($unsql);
                //$unissueshk = $this->m_common->get_row_array('assigned_cheque',array('bank_id'=>$row['bank_id'],'status'=>'Issued'),'*');
                $sqlPre = "select * from assigned_cheque WHERE bank_id=$bank_id and `status`='Completed' and honor_date IS NULL";
                $unPresent = $this->m_common->customeQuery($sqlPre);
                $totalcheque = count($bankwaischeque);
                $totalunissche = count($unissueshk);
                $totalunpre = count($unPresent);
                foreach ($unissueshk as $unissuerow) {
                    $totalvalue += $unissuerow['amount'];
                }
                foreach ($unPresent as $unpresentrow) {
                    $totalunprevalue += $unpresentrow['amount'];
                }
                $data['bank'][$key]['blank'] = $totalcheque;
                $data['bank'][$key]['unissue'] = $totalunissche;
                $data['bank'][$key]['unissuevalue'] = $totalvalue;
                $data['bank'][$key]['unpresent'] = $totalunpre;
                $data['bank'][$key]['unpresentvalue'] = $totalunprevalue;
            }
            $total_bank = $data['bank'];
//            echo '<pre>';
//            print_r($total_bank);exit;
            $this->load->view('cheque_register/dashboard', $data);
        }
    }

    function unIssueDetails() {
        $this->setOutputMode(NORMAL);
        $table = 'users';
        $postData = $this->input->post();
        $bank_id = $postData['bank_id'];
        $account_no = $postData['account_no'];
        if ($postData) {
            $unsql = "select ac.*,b.b_name from assigned_cheque ac 
JOIN tbl_banks b on ac.bank_id=b.id
 WHERE ac.bank_id=$bank_id and ac.bank_account=$account_no and (ac.status='Issued' or ac.status='Printed')";
            $unissueshk = $this->m_common->customeQuery($unsql);
            $str = '';
            $str .= '<table class="table table-bordered datatable">';
            $str .= '<thead><tr>';
            $str .= '<th>Bank name</th>';
            $str .= '<th>Account No.</th>';
            $str .= '<th>Cheque No.</th>';
            $str .= '<th>Amount</th>';
            $str .= '</tr></thead>';
            foreach ($unissueshk as $row) {
                $str .= '<tr>';
                $str .= '<td>' . $row['b_name'] . '</td>';
                $str .= '<td>' . $row['bank_account'] . '</td>';
                $str .= '<td>' . $row['chk_no'] . '</td>';
                $str .= '<td>' . $row['amount'] . '</td>';
                $str .= '</tr>';
            }
            $str .= '<table>';
        }

        echo $str;
    }

    function unPresentDetails() {
        $this->setOutputMode(NORMAL);
        $table = 'users';
        $postData = $this->input->post();
        $bank_id = $postData['bank_id'];
        $account_no = $postData['account_no'];
        if ($postData) {
            $unsql = "select ac.*,b.b_name from assigned_cheque ac 
JOIN tbl_banks b on ac.bank_id=b.id
 WHERE ac.bank_id=$bank_id and ac.bank_account=$account_no and ac.status='Completed' and ac.honor_date IS NULL";
            $unissueshk = $this->m_common->customeQuery($unsql);
            $str = '';
            $str .= '<table class="table table-bordered datatable">';
            $str .= '<thead><tr>';
            $str .= '<th>Bank name</th>';
            $str .= '<th>Account No.</th>';
            $str .= '<th>Cheque No.</th>';
            $str .= '<th>Amount</th>';
            $str .= '</tr></thead>';
            foreach ($unissueshk as $row) {
                $str .= '<tr>';
                $str .= '<td>' . $row['b_name'] . '</td>';
                $str .= '<td>' . $row['bank_account'] . '</td>';
                $str .= '<td>' . $row['chk_no'] . '</td>';
                $str .= '<td>' . $row['amount'] . '</td>';
                $str .= '</tr>';
            }
            $str .= '<table>';
        }

        echo $str;
    }

}
