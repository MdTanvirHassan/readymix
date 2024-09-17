<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pi extends Site_Controller
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
        $this->menu = 'imports';
        $this->sub_menu = 'imports';
        $this->sub_inner_menu = 'pi';
        $branch_id = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');


        $this->titlebackend("Profoma Invoice");
    //    $sql = "select sl.*,c.SUP_NAME,b.b_name as buyer_bank from import_pi sl left join import_sales_contact isc on sl.s_contact_id=isc.id  left join supplier as c on c.ID=isc.sup_id left join tbl_banks b on b.id=sl.benificiary_b_id where sl.branch_id=$branch_id order by sl.id DESC";
        $sql = "select sl.*,c.SUP_NAME,b.b_name as buyer_bank from import_pi sl left join import_sales_contact isc on sl.s_contact_id=isc.id  left join supplier as c on c.ID=isc.sup_id left join tbl_banks b on b.id=sl.benificiary_b_id order by sl.id DESC";
        $data['pis'] = $this->m_common->customeQuery($sql);
        $this->load->view('imports/pi/v_pi', $data);
    }

    function add_pi()
    {
        $this->menu = 'procurement';
        $this->sub_menu = 'import';
        $this->sub_inner_menu = 'pi';
        $branch_id = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');

        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $data['categories'] = $this->m_common->customeQuery('select ic.* from item_category ic join item_groups ig on ic.group_id=ig.id');
        $data['groups'] = $this->m_common->get_row_array('item_category', '', '*');

        $this->titlebackend("Add Profoma Invoice");

        $data['items'] = $this->m_common->get_row_array('rm_items','','*');
        $sql="select isc.*,s.SUP_NAME from import_sales_contact isc left join supplier s on isc.sup_id=s.ID where isc.status='Pending' and isc.is_active=1";
        $data['contacts'] = $this->m_common->customeQuery($sql);
       
        $data['customers'] = $this->m_common->get_row_array('supplier',array('LOCAL'=>"Foreign"), '*');
        $data['self_bank'] = $this->m_common->get_row_array('tbl_banks', array('b_identification' => 'self'), '*');
        $data['party_bank'] = $this->m_common->get_row_array('tbl_banks', array('b_identification' => 'customer'), '*');
        $all_pi = $this->m_common->get_row_array('import_pi', array('branch_id' => $branch_id,'is_active'=>1), '*');
        
        
        if(!empty($all_pi)){
           
            $r_code=count($all_pi)+1;
            if($r_code>999){
                $pi_no=$data['branch_info'][0]['short_name']."/PI".$r_code;
            }else if($r_code>99){
                $pi_no=$data['branch_info'][0]['short_name']."/PI0".$r_code;
            }else if($r_code>9){
                $pi_no=$data['branch_info'][0]['short_name']."/PI00".$r_code;
            }else{
                $pi_no=$data['branch_info'][0]['short_name']."/PI000".$r_code;
            }
        }else{
           
            $pi_no=$data['branch_info'][0]['short_name'].'/P0001';
        }
        $data['pi_no'] =$pi_no;
        
        $this->load->view('imports/pi/add_pi', $data);
    }

    function add_action_pi()
    {
        $this->menu = 'imports';
        $this->sub_menu = 'pi';
        $this->titlebackend("Add Profoma Invoice");

        $companyId = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');

        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created_date'] = date('Y-m-d');
            if (!empty($postData['pi_no'])) {
                $insertData['pi_no'] = $postData['pi_no'];
                $pi_no = $postData['pi_no'];
            }

            if (!empty($postData['s_contact_id'])) {
                $insertData['s_contact_id'] = $postData['s_contact_id'];
            }

            
            if(!empty($postData['sup_id'])){
                $insertData['sup_id'] = $postData['sup_id'];
            }
            
            
            if (!empty($postData['benificiary_b_id'])) {
                $insertData['benificiary_b_id'] = $postData['benificiary_b_id'];
            }
            


            if (!empty($postData['pi_date'])) {
                $insertData['pi_date'] = date('Y-m-d', strtotime($postData['pi_date']));
                
            }
            
            if (!empty($postData['amount'])) {
                $insertData['amount'] = $postData['amount'];
            }
           
            
            if (!empty($postData['lc_type'])) {
                $insertData['lc_type'] = $postData['lc_type'];
            }
          
            if (!empty($postData['discharge_rate'])) {
                $insertData['discharge_rate'] = $postData['discharge_rate'];
            }
            
            
            $insertData['status'] = "Pending";
            $insertData['branch_id'] = $companyId;

           
            $insertData['created_by'] =$employee_id;
           
            $id = $this->m_common->insert_row('import_pi', $insertData);
            if (!empty($id)) {

                foreach ($postData['item_id'] as $key => $each) {
                    $insertData1 = array();
                    
                    $insertData1['pi_id'] = $id;
                    
                    $insertData1['item_id'] = $postData['item_id'][$key];
                    $insertData1['sc_d_id'] = $postData['sc_d_id'][$key];
                    
                    $insertData1['sc_qty'] = $postData['sc_qty'][$key];
                    $insertData1['qty'] = $postData['qty'][$key];
                    $insertData1['rate'] = $postData['rate'][$key];
                    $insertData1['value'] = $postData['qty'][$key] * $postData['rate'][$key];
                    $insertData1['lc_status'] = "Pending";
                    $this->m_common->insert_row('import_pi_details', $insertData1);
                    $this->m_common->update_row('import_sales_contact',array('id'=>$postData['s_contact_id']),array('status'=>'PI Created'));
                }
                
                
                redirect_with_msg('imports/pi/add_pi', 'Successfully Inserted');
            } else {
                redirect_with_msg('imports/pi/add_pi', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('imports/pi/add_pi', 'Please fill the form and submit');
        }
    }
    
    function edit_pi($pi_id){
        $this->menu = 'procurement';
        $this->sub_menu = 'import';
        $this->sub_inner_menu = 'pi';
        $branch_id = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');

        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $data['categories'] = $this->m_common->customeQuery('select ic.* from item_category ic join item_groups ig on ic.group_id=ig.id');
        $data['groups'] = $this->m_common->get_row_array('item_category', '', '*');

        $this->titlebackend("Add L/C");

        $data['items'] = $this->m_common->get_row_array('rm_items','','*');
        
        
        $sql="select isc.*,s.SUP_NAME from import_sales_contact isc left join supplier s on isc.sup_id=s.ID where isc.is_active=1";
        $data['contacts'] = $this->m_common->customeQuery($sql);
        
        
        $data['customers'] = $this->m_common->get_row_array('supplier',array('LOCAL'=>"Foreign"), '*');
        $data['self_bank'] = $this->m_common->get_row_array('tbl_banks', array('b_identification' => 'self'), '*');
        $data['party_bank'] = $this->m_common->get_row_array('tbl_banks', array('b_identification' => 'customer'), '*');
        
        $data['pi_info']=$this->m_common->get_row_array('import_pi',array('id'=>$pi_id),'*');
        
        $sql="select iscd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,rmi.item_grade,tmu.meas_unit from import_pi_details iscd
        left join rm_items rmi on iscd.item_id=rmi.id
        left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id
        where iscd.pi_id=".$pi_id;
        $data['pi_details']=$this->m_common->customeQuery($sql);
        
        
        $this->load->view('imports/pi/edit_pi', $data);
    }
    
    function edit_action_pi($pi_id=false)
    {
        $this->menu = 'imports';
        $this->sub_menu = 'pi';
        $this->titlebackend("Add LC");

        $companyId = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');

        $postData = $this->input->post();
        if(!empty($postData)){
            $insertData = array();
            $insertData['updated_date'] = date('Y-m-d');
            if (!empty($postData['pi_no'])) {
                $insertData['pi_no'] = $postData['pi_no'];
                $pi_no = $postData['pi_no'];
            }

            if (!empty($postData['s_contact_id'])) {
                $insertData['s_contact_id'] = $postData['s_contact_id'];
            }

            
            if(!empty($postData['sup_id'])){
                $insertData['sup_id'] = $postData['sup_id'];
            }
            
            
            if (!empty($postData['benificiary_b_id'])) {
                $insertData['benificiary_b_id'] = $postData['benificiary_b_id'];
            }
            


            if (!empty($postData['pi_date'])) {
                $insertData['pi_date'] = date('Y-m-d', strtotime($postData['pi_date']));
                
            }
            
            if (!empty($postData['amount'])) {
                $insertData['amount'] = $postData['amount'];
            }
           
            
            if (!empty($postData['lc_type'])) {
                $insertData['lc_type'] = $postData['lc_type'];
            }
              
            if (!empty($postData['discharge_rate'])) {
                $insertData['discharge_rate'] = $postData['discharge_rate'];
            }
            
            
            $insertData['updated_by'] =$employee_id;
            

            $id = $this->m_common->update_row('import_pi',array('id'=>$pi_id),$insertData);
           
            if ($id>=0) {
                $this->m_common->delete_row('import_pi_details',array('pi_id'=>$pi_id));
                foreach ($postData['item_id'] as $key => $each) {
                    $insertData1 = array();
                    
                    $insertData1['pi_id'] =$pi_id;
                    
                    $insertData1['item_id'] = $postData['item_id'][$key];
                    $insertData1['sc_d_id'] = $postData['sc_d_id'][$key];
                    
                    $insertData1['sc_qty'] = $postData['sc_qty'][$key];
                    $insertData1['qty'] = $postData['qty'][$key];
                    $insertData1['rate'] = $postData['rate'][$key];
                    $insertData1['value'] = $postData['qty'][$key] * $postData['rate'][$key];
                    $insertData1['lc_status'] = "Pending";
                    $this->m_common->insert_row('import_pi_details', $insertData1);
                    $this->m_common->update_row('import_sales_contact',array('id'=>$postData['s_contact_id']),array('status'=>'PI Created'));
                }
                                

                redirect_with_msg('imports/pi', 'Successfully Updated');
            } else {
                redirect_with_msg('imports/pi/edit_pi/'.$pi_id, 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('imports/pi/edit_pi'.$pi_id, 'Please fill the form and submit');
        }
    }
    
    
    function delete($id)
    {
        if ($this->m_common->delete_row('import_pi', array('id'=>$id))) {
            $this->m_common->delete_row('import_pi_details', array('pi_id'=> $id));
            redirect_with_msg($_SERVER['HTTP_REFERER'], 'Successfully Delete');
        } else
            redirect_with_msg($_SERVER['HTTP_REFERER'], 'Failed to Delete');
    }
    function detailspi($pi_id)
    {
        $this->menu = 'procurement';
        $this->sub_menu = 'import';
        $this->sub_inner_menu = 'pi';
        $branch_id = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');

        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $data['categories'] = $this->m_common->customeQuery('select ic.* from item_category ic join item_groups ig on ic.group_id=ig.id');
        $data['groups'] = $this->m_common->get_row_array('item_category', '', '*');

        $this->titlebackend("Add L/C");

        $data['items'] = $this->m_common->get_row_array('rm_items','','*');
        
        
        $sql="select isc.*,s.SUP_NAME from import_sales_contact isc left join supplier s on isc.sup_id=s.ID where isc.is_active=1";
        $data['contacts'] = $this->m_common->customeQuery($sql);
        
        
        $data['customers'] = $this->m_common->get_row_array('supplier',array('LOCAL'=>"Foreign"), '*');
        $data['self_bank'] = $this->m_common->get_row_array('tbl_banks', array('b_identification' => 'self'), '*');
        $data['party_bank'] = $this->m_common->get_row_array('tbl_banks', array('b_identification' => 'customer'), '*');
        
        $data['pi_info']=$this->m_common->get_row_array('import_pi',array('id'=>$pi_id),'*');
        
        $sql="select iscd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,rmi.item_grade,tmu.meas_unit from import_pi_details iscd
        left join rm_items rmi on iscd.item_id=rmi.id
        left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id
        where iscd.pi_id=".$pi_id;
        $data['pi_details']=$this->m_common->customeQuery($sql);
        
        
        $this->load->view('imports/pi/details_pi', $data);
    }

    function get_pi_details()
    {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('pi_id');
        $sql = "select sl.*,c.c_name as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from imports_pi sl join tbl_customers as c on c.id=sl.customer_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank where pi_id=$id and status!='Rejected' order by pi_id DESC";
        $data['pi'] = $this->m_common->customeQuery($sql);
        $sql = "select spd.*,sp.pi_no,tsp.product_name,pi.pi_no,c.c_name,c.c_contact_address from imports_pi_details spd 
                join imports_pi sp on spd.pi_id=sp.pi_id 
				join imports_pi pi on spd.pi_id=pi.pi_id 
				join tbl_imports_products tsp on spd.product_id=tsp.product_id
				join tbl_customers c on sp.customer_id=c.id
        where sp.pi_id=".$id;
        $data['pi_details'] = $this->m_common->customeQuery($sql);
        echo json_encode($data); 
    }
    function get_pi()
    {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('cust_id');
        $type = $this->input->post('type');
        if($type=='pi')
        $sql = "select pi_id,pi_no from imports_pi  where customer_id=$id and status ='Pending' order by pi_id DESC";
        else
        $sql = "select pi_id,pi_no from imports_pi  where customer_id=$id and status ='Pending' order by pi_id DESC";
        $data['pi'] = $this->m_common->customeQuery($sql);
        echo json_encode($data); 
    }
    
    function get_contact_details(){
        $this->setOutputMode(NORMAL);
        $contact_id=$this->input->post('con_id');
        $sql="select iscd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,rmi.item_grade,tmu.meas_unit from import_sales_contact_details iscd
        left join rm_items rmi on iscd.item_id=rmi.id 
        left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id        
        where iscd.sales_contact_id=".$contact_id;
        $data['con_details']=$this->m_common->customeQuery($sql);
        echo json_encode($data);
        
    }
}
