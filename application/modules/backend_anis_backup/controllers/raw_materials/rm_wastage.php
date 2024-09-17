<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class rm_wastage extends Site_Controller
{

    function __construct()
    {
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

    function index()
    {
        $this->menu = 'rms';
        $this->sub_menu = 'rms';
        $this->sub_inner_menu = 'rm_wastage';
        $branch_id = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');


        $this->titlebackend("L/C Entry");
        $sql="select tic.*,tc.receive_no,tc.receive_date,tc.memo_no,tc.memo_date,tc.status,i.item_name,i.item_code from rm_wastage_details tic 
        left join rm_wastage tc on tic.w_id=tc.id             
        left join rm_items i on i.id = tic.item_id
        where tc.branch_id=".$branch_id ." order by tic.id DESC";
        $data['wastages'] = $this->m_common->customeQuery($sql);
        $this->load->view('raw_materials/rm_wastage/v_rm_wastage', $data);
    }

    function add_rm_wastage()
    {
        $this->menu = 'procurement';
        $this->sub_menu = 'rm';
        $this->sub_inner_menu = 'rm_wastage';
        $branch_id = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');

        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $data['categories'] = $this->m_common->customeQuery('select ic.* from item_category ic join item_groups ig on ic.group_id=ig.id');
        $data['groups'] = $this->m_common->get_row_array('item_category', '', '*');

        $this->titlebackend("Add L/C");

        $data['items'] = $this->m_common->get_row_array('rm_items','','*');
          $all_rm_wastage = $this->m_common->get_row_array('rm_wastage', array('branch_id' => $branch_id,'is_active'=>1), '*');
        if(!empty($all_rm_wastage)){
           
            $r_code=count($all_rm_wastage)+1;
            if($r_code>999){
                $rm_wastage_no=$data['branch_info'][0]['short_name']."/WR".$r_code;
            }else if($r_code>99){
                $rm_wastage_no=$data['branch_info'][0]['short_name']."/WR0".$r_code;
            }else if($r_code>9){
                $rm_wastage_no=$data['branch_info'][0]['short_name']."/WR00".$r_code;
            }else{
                $rm_wastage_no=$data['branch_info'][0]['short_name']."/WR000".$r_code;
            }
        }else{
           
            $rm_wastage_no=$data['branch_info'][0]['short_name'].'/WR0001';
        }
        $data['receive_no'] =$rm_wastage_no;
        
        $this->load->view('raw_materials/rm_wastage/v_add_rm_wastage', $data);
    }

    function add_action_rm_wastage()
    {
        $this->menu = 'rms';
        $this->sub_menu = 'rm_wastage';
        $this->titlebackend("Add Wastage");

        $companyId = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');

        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created_at'] = date('Y-m-d');
            if (!empty($postData['rm_wastage_no'])) {
                $insertData['rm_wastage_no'] = $postData['rm_wastage_no'];
                $rm_wastage_no = $postData['rm_wastage_no'];
            }

            if (!empty($postData['rm_wastage_type'])) {
                $insertData['rm_wastage_type'] = $postData['rm_wastage_type'];
            }
            
            if (!empty($postData['sup_id'])) {
                $insertData['sup_id'] = $postData['sup_id'];
            }

            if (!empty($postData['party_bank'])) {
                $insertData['party_bank'] = $postData['party_bank'];
            }
            if (!empty($postData['tanor'])) {
                $insertData['tanor'] = $postData['tanor'];
            }
           
            if (!empty($postData['date'])) {
                $insertData['date'] = date('Y-m-d', strtotime($postData['date']));
                $indent_date = date('Y-m-d', strtotime($postData['date']));
            }
            
            if (!empty($postData['shipment_date'])) {
                $insertData['shipment_date'] = date('Y-m-d', strtotime($postData['shipment_date']));
            }
            
            if (!empty($postData['shipment_exp_date'])) {
                $insertData['shipment_exp_date'] = date('Y-m-d', strtotime($postData['shipment_exp_date']));
            }

            if (!empty($postData['shipment_port'])) {
                $insertData['shipment_port'] = $postData['shipment_port'];
            }
            
            if (!empty($postData['our_bank'])) {
                $insertData['our_bank'] = $postData['our_bank'];
            }
            if (!empty($postData['amount'])) {
                $insertData['amount'] = $postData['amount'];
            }
           


            $insertData['status'] = "Pending";
            $insertData['branch_id'] = $companyId;

            $user_id = $this->session->userdata('user_id');
            $userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');
            $insertData['created_by'] =$employee_id;
            $approver = fetch_approver(2, 7, $userData);
            if (empty($approver[0])) {
                redirect_with_msg('rms/rm_wastage', 'Please contact with administratior to set approver');
            }
            $insertData['approver_id'] = $approver[0];

            $id = $this->m_common->insert_row('rm_wastage', $insertData);
            if (!empty($id)) {

                foreach ($postData['item_id'] as $key => $each) {
                    $insertData1 = array();
                    
                    $insertData1['rm_wastage_id'] = $id;
                    
                    $insertData1['item_id'] = $postData['item_id'][$key];
                    $insertData1['pi_d_id'] = $postData['pi_d_id'][$key];
                    
                    $insertData1['pi_qty'] = $postData['pi_qty'][$key];
                    $insertData1['qty'] = $postData['qty'][$key];
                    $insertData1['price'] = $postData['price'][$key];
                    $insertData1['amount'] = $postData['qty'][$key] * $postData['price'][$key];
                    $insertData1['status'] = "Pending";
                    $this->m_common->insert_row('rm_wastage_details', $insertData1);
                    
                }
                



                $array = array(
                    "employee_id" => $approver[0],
                    "title" => "LC approval",
                    "notice" => "Please approve the LC",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "rms/rm_wastage/detailsLc/" . $id
                );
                $this->m_common->insert_row("notice", $array);

                redirect_with_msg('rms/rm_wastage/add_rm_wastage', 'Successfully Added this LC');
            } else {
                redirect_with_msg('rms/rm_wastage/add_rm_wastage', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('rms/rm_wastage/add_rm_wastage', 'Please fill the form and submit');
        }
    }
    
    function edit_rm_wastage($rm_wastage_id){
        $this->menu = 'procurement';
        $this->sub_menu = 'rm';
        $this->sub_inner_menu = 'rm_wastage';
        $branch_id = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');

        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $data['categories'] = $this->m_common->customeQuery('select ic.* from item_category ic join item_groups ig on ic.group_id=ig.id');
        $data['groups'] = $this->m_common->get_row_array('item_category', '', '*');

        $this->titlebackend("Edit L/C");

        $data['items'] = $this->m_common->get_row_array('rm_items','','*');
        $data['contacts'] = $this->m_common->get_row_array('rm_sales_contact',array('is_active'=>1),'*');
       
       // $data['suppliers'] = $this->m_common->get_row_array('supplier',array('LOCAL'=>"Foreign"), '*');
        $data['suppliers'] = $this->m_common->get_row_array('supplier','', '*');
        $data['self_bank'] = $this->m_common->get_row_array('tbl_banks', array('b_identification' => 'self'), '*');
        $data['party_bank'] = $this->m_common->get_row_array('tbl_banks', array('b_identification' => 'customer'), '*');
        
        $data['rm_wastage_info']=$this->m_common->get_row_array('rm_rm_wastage',array('rm_wastage_id'=>$rm_wastage_id),'*');
        
        $sql="select iscd.*,ipi.pi_no,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_rm_wastage_details iscd
        left join rm_pi_details ipid on iscd.pi_d_id=ipid.id
        left join rm_pi ipi on ipi.id=ipid.pi_id 
        left join rm_items rmi on iscd.item_id=rmi.id
        left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id
        where iscd.rm_wastage_id=".$rm_wastage_id;
        $data['rm_wastage_details']=$this->m_common->customeQuery($sql);
        
        
        $this->load->view('rms/rm_wastage/edit_rm_wastage', $data);
    }
    
    function edit_action_rm_wastage($rm_wastage_id=false)
    {
        $this->menu = 'rms';
        $this->sub_menu = 'rm_wastage';
        $this->titlebackend("Add LC");

        $companyId = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');

        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            
            if (!empty($postData['rm_wastage_no'])) {
                $insertData['rm_wastage_no'] = $postData['rm_wastage_no'];
                $rm_wastage_no = $postData['rm_wastage_no'];
            }

            if (!empty($postData['rm_wastage_type'])) {
                $insertData['rm_wastage_type'] = $postData['rm_wastage_type'];
            }
            
            if (!empty($postData['sup_id'])) {
                $insertData['sup_id'] = $postData['sup_id'];
            }

            if (!empty($postData['party_bank'])) {
                $insertData['party_bank'] = $postData['party_bank'];
            }
            if (!empty($postData['tanor'])) {
                $insertData['tanor'] = $postData['tanor'];
            }
           
            if (!empty($postData['date'])) {
                $insertData['date'] = date('Y-m-d', strtotime($postData['date']));
                $indent_date = date('Y-m-d', strtotime($postData['date']));
            }
            
            if (!empty($postData['shipment_date'])) {
                $insertData['shipment_date'] = date('Y-m-d', strtotime($postData['shipment_date']));
            }
            
            if (!empty($postData['shipment_exp_date'])) {
                $insertData['shipment_exp_date'] = date('Y-m-d', strtotime($postData['shipment_exp_date']));
            }

            if (!empty($postData['shipment_port'])) {
                $insertData['shipment_port'] = $postData['shipment_port'];
            }
            
            if (!empty($postData['our_bank'])) {
                $insertData['our_bank'] = $postData['our_bank'];
            }
            if (!empty($postData['amount'])) {
                $insertData['amount'] = $postData['amount'];
            }

            $insertData['updated_date'] = date('Y-m-d');
            $insertData['updated_by']=$employee_id;
            

            $id = $this->m_common->update_row('rm_rm_wastage',array('rm_wastage_id'=>$rm_wastage_id),$insertData);
           
            if ($id>=0) {
                $this->m_common->delete_row('rm_rm_wastage_details',array('rm_wastage_id'=>$rm_wastage_id));
                foreach ($postData['item_id'] as $key => $each) {
                    $insertData1 = array();
                    
                    $insertData1['rm_wastage_id'] =$rm_wastage_id;
                    
                    $insertData1['item_id'] = $postData['item_id'][$key];
                    $insertData1['pi_d_id'] = $postData['pi_d_id'][$key];
                    
                    $insertData1['pi_qty'] = $postData['pi_qty'][$key];
                    $insertData1['qty'] = $postData['qty'][$key];
                    $insertData1['price'] = $postData['price'][$key];
                    $insertData1['amount'] = $postData['qty'][$key] * $postData['price'][$key];
                    $insertData1['status'] = "Pending";
                    $this->m_common->insert_row('rm_rm_wastage_details', $insertData1);
                    //$this->m_common->update_row('rm_sales_contact',array('id'=>$postData['sales_contact_id']),array('status'=>'LC Created'));
                    $this->m_common->update_row('rm_pi_details',array('id'=>$postData['pi_d_id'][$key]),array('rm_wastage_status'=>'LC Created'));
                }
                



                

                redirect_with_msg('rms/rm_wastage', 'Successfully Updated');
            } else {
                redirect_with_msg('rms/rm_wastage/edit_rm_wastage/'.$rm_wastage_id, 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('rms/rm_wastage/edit_rm_wastage'.$rm_wastage_id, 'Please fill the form and submit');
        }
    }
    
    
    function delete($id)
    {
        if ($this->m_common->delete_row('rm_rm_wastage', array('id'=>$id))) {
            $this->m_common->delete_row('rm_rm_wastage_details', array('w_id'=> $id));
            redirect_with_msg($_SERVER['HTTP_REFERER'], 'Successfully Delete');
        } else
            redirect_with_msg($_SERVER['HTTP_REFERER'], 'Failed to Delete');
    }
    function detailsLc($rm_wastage_id)
    {
        $this->menu = 'rms';
        $this->sub_menu = 'rm_wastage';
        $this->titlebackend("L/C Details");

        $branch_id = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');

        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $data['categories'] = $this->m_common->customeQuery('select ic.* from item_category ic join item_groups ig on ic.group_id=ig.id');
        $data['groups'] = $this->m_common->get_row_array('item_category', '', '*');

        $this->titlebackend("Edit L/C");

        $data['items'] = $this->m_common->get_row_array('rm_items','','*');
        $data['contacts'] = $this->m_common->get_row_array('rm_sales_contact',array('is_active'=>1),'*');
       
       // $data['suppliers'] = $this->m_common->get_row_array('supplier',array('LOCAL'=>"Foreign"), '*');
        $data['suppliers'] = $this->m_common->get_row_array('supplier','', '*');
        $data['self_bank'] = $this->m_common->get_row_array('tbl_banks', array('b_identification' => 'self'), '*');
        $data['party_bank'] = $this->m_common->get_row_array('tbl_banks', array('b_identification' => 'customer'), '*');
        
        $data['rm_wastage_info']=$this->m_common->get_row_array('rm_rm_wastage',array('rm_wastage_id'=>$rm_wastage_id),'*');
        
        $sql="select iscd.*,ipi.pi_no,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_rm_wastage_details iscd
        left join rm_pi_details ipid on iscd.pi_d_id=ipid.id
        left join rm_pi ipi on ipi.id=ipid.pi_id 
        left join rm_items rmi on iscd.item_id=rmi.id
        left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id
        where iscd.rm_wastage_id=".$rm_wastage_id;
        $data['rm_wastage_details']=$this->m_common->customeQuery($sql);
        $html=$this->load->view('rms/rm_wastage/details_rm_wastage',$data,true);
//        echo $html;
//        exit;   
    }

    function get_rm_wastage_details()
    {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('rm_wastage_id');
        $sql = "select sl.*,c.c_name as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from rms_rm_wastage sl join tbl_customers as c on c.id=sl.customer_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank where rm_wastage_id=$id and status!='Rejected' order by rm_wastage_id DESC";
        $data['rm_wastage'] = $this->m_common->customeQuery($sql);
        $sql = "select spd.*,sp.rm_wastage_no,tsp.product_name,pi.pi_no,c.c_name,c.c_contact_address from rms_rm_wastage_details spd 
                join rms_rm_wastage sp on spd.rm_wastage_id=sp.rm_wastage_id 
				join rms_pi pi on spd.pi_id=pi.pi_id 
				join tbl_rms_products tsp on spd.product_id=tsp.product_id
				join tbl_customers c on sp.customer_id=c.id
        where sp.rm_wastage_id=".$id;
        $data['rm_wastage_details'] = $this->m_common->customeQuery($sql);
        echo json_encode($data); 
    }
    function get_rm_wastage()
    {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('cust_id');
        $type = $this->input->post('type');
        if($type=='rm_wastage')
        $sql = "select rm_wastage_id,rm_wastage_no from rms_rm_wastage  where customer_id=$id and status ='Pending' order by rm_wastage_id DESC";
        else
        $sql = "select pi_id,pi_no from rms_pi  where customer_id=$id and status ='Pending' order by pi_id DESC";
        $data['rm_wastage'] = $this->m_common->customeQuery($sql);
        echo json_encode($data); 
    }
    
    function get_contact_details(){
        $this->setOutputMode(NORMAL);
        $contact_id=$this->input->post('con_id');
        $sql="select iscd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length from rm_sales_contact_details iscd left join rm_items rmi on iscd.item_id=rmi.id where iscd.sales_contact_id=".$contact_id;
        $data['con_details']=$this->m_common->customeQuery($sql);
        echo json_encode($data);
        
    }
    
    function get_pi_details(){
        $this->setOutputMode(NORMAL);
        $sup_id=$this->input->post('sup_id');
        $sql="select iscd.*,ipi.pi_no,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_pi_details iscd
        left join rm_pi ipi on iscd.pi_id=ipi.id    
        left join rm_items rmi on iscd.item_id=rmi.id 
        left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id
        where iscd.rm_wastage_status='Pending'";
        $data['pi_details']=$this->m_common->customeQuery($sql);
        echo json_encode($data);
        
    }
    
    
}
