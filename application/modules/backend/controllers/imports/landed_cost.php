<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Landed_cost extends Site_Controller
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
        $this->sub_inner_menu = 'landed_cost';
        $branch_id = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');


        $this->titlebackend("LC Landed Cost");
       
        $sql = "select illc.*,rlr.mother_vessel_name,il.lc_no from import_lc_landed_cost illc left join rm_lc_receive rlr on illc.lc_id=rlr.lc_id left join import_lc il on illc.lc_id=il.lc_id where illc.is_active=1";
        $data['lcs'] = $this->m_common->customeQuery($sql);
        $this->load->view('imports/landed_cost/v_landed_cost', $data);
    }

    function add_landed_cost()
    {
        $this->menu = 'imports';
        $this->sub_menu = 'import';
        $this->sub_inner_menu = 'landed_cost';
        $branch_id = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        
        $this->titlebackend("Add Landed Cost");
        
        $data['cost_heads'] = $this->m_common->get_row_array('import_landed_cost_head', array('is_active'=>1), '*');
        
        $lc_sql="select il.*,rlr.mother_vessel_name from import_lc il left join rm_lc_receive rlr on il.lc_id=rlr.lc_id";
        $data['lcs']=$this->m_common->customeQuery($lc_sql);
        
        $all_lc = $this->m_common->get_row_array('import_lc_landed_cost', array('is_active'=>1), '*');
       
        if(!empty($all_lc)){           
            $r_code=count($all_lc)+1;
            if($r_code>999){
                $cost_number="L-COST-".$r_code;
            }else if($r_code>99){
                $cost_number="L-COST-0".$r_code;
            }else if($r_code>9){
                $cost_number="L-COST-00".$r_code;
            }else{
                $cost_number="L-COST-000".$r_code;
            }
        }else{
           
            $cost_number='L-COST-0001';
        }
        
        
        $data['cost_number'] =$cost_number;
        
        $this->load->view('imports/landed_cost/add_landed_cost', $data);
    }

    function add_action_landed_cost()
    {
        $this->menu = 'imports';
        $this->sub_menu = 'import';
        $this->sub_inner_menu = 'landed_cost';
        $this->titlebackend("Add Landed Cost");

        $companyId = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');

        $postData = $this->input->post();
        
        if(!empty($postData)){
            $insertData = array();
            $insertData['created_date']=date('Y-m-d');
            
            
           
            if (!empty($postData['lc_id'])) {
                $insertData['lc_id'] = $postData['lc_id'];
            }

            if (!empty($postData['cost_number'])) {
                $insertData['cost_number'] = $postData['cost_number'];
            }
                        
            if (!empty($postData['unit_price'])) {
                $insertData['unit_price'] = $postData['unit_price'];
            }
            if (!empty($postData['uh_unit_price'])) {
                $insertData['uh_unit_price'] = $postData['uh_unit_price'];
            }
            
            
            $insertData['total_unit_price'] = $postData['unit_price']+$postData['uh_unit_price'];
            
            
            if (!empty($postData['bdt_rate'])) {
                $insertData['bdt_rate'] = $postData['bdt_rate'];
            }
            
            if (!empty($postData['lc_qty'])) {
                $insertData['lc_qty'] = $postData['lc_qty'];
            }
            
            
            $insertData['lc_value'] = $postData['unit_price']*$postData['lc_qty'];
           
            
            if (!empty($postData['grand_total_amount'])) {
                $insertData['grand_total_amount'] = $postData['grand_total_amount'];
            }
            $insertData['created_by'] =$user_id;
            $insertData['is_active'] =1;
            $insertData['payment_status'] = "Pending";
            $id = $this->m_common->insert_row('import_lc_landed_cost', $insertData);
            if (!empty($id)) {

              //  foreach ($postData['item_id'] as $key => $each) {
                $hook_total_amount=0;
                $yard_total_amount=0;
                foreach ($postData['c_h_id'] as $key => $each) {
                    
                    $insertData1 = array();
                    
                    $insertData1['cost_id'] = $id;
                    
                    $insertData1['c_h_id'] = $postData['c_h_id'][$key];
                    $insertData1['cash_amount'] = $postData['cash_amount'][$key];
                    
                    $insertData1['bank_loan_amount'] = $postData['bank_loan_amount'][$key];
                    $insertData1['total_amount'] = $postData['total_amount'][$key];
                   
                    $insertData1['payment_status'] = "Pending";
                    $insertData1['is_active'] =1;
                    
                    if($postData['hook_cost'][$key]=='Yes'){
                       $hook_total_amount=$hook_total_amount+$postData['total_amount'][$key]; 
                    }
                    
                    if($postData['yard_cost'][$key]=='Yes'){
                      $yard_total_amount=$yard_total_amount+$postData['total_amount'][$key];   
                    }
                    
                    $this->m_common->insert_row('import_lc_landed_cost_details', $insertData1);
                    
                }
                
                $this->m_common->update_row('import_lc_landed_cost',array('id'=>$id),array('hook_total_amount'=>$hook_total_amount,'yard_total_amount'=>$yard_total_amount));

                redirect_with_msg('imports/landed_cost/add_landed_cost', 'Successfully Added');
            }else{
                redirect_with_msg('imports/landed_cost/add_landed_cost', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('imports/landed_cost/add_landed_cost', 'Please fill the form and submit');
        }
    }
    
    function edit_landed_cost($lc_id){
        $this->menu = 'imports';
        $this->sub_menu = 'import';
        $this->sub_inner_menu = 'landed_cost';
        
        $branch_id = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');

        

        $this->titlebackend("Edit Landed Cost");

        $lc_sql="select il.*,rlr.mother_vessel_name from import_lc il left join rm_lc_receive rlr on il.lc_id=rlr.lc_id";
        $data['lcs']=$this->m_common->customeQuery($lc_sql);
        
        $data['cost_info']=$this->m_common->get_row_array('import_lc_landed_cost',array('id'=>$lc_id),'*');
        $sql="select ilcd.*,ilch.name,ilch.hook_cost,ilch.yard_cost from  import_lc_landed_cost_details ilcd left join import_landed_cost_head ilch on ilcd.c_h_id=ilch.id where ilcd.cost_id=".$lc_id." order by ilcd.id ASC ";
        $data['cost_heads']=$this->m_common->customeQuery($sql);
//        echo '<pre>';
//        print_r($data['cost_heads']);
//        exit;
        
        $this->load->view('imports/landed_cost/edit_landed_cost', $data);
    }
    
    function edit_action_landed_cost($lc_id=false)
    {
        $this->menu = 'imports';
        $this->sub_menu = 'import';
        $this->sub_inner_menu = 'landed_cost';
        $this->titlebackend("Edit Landed Cost");

        $companyId = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');

        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            
            if (!empty($postData['lc_id'])) {
                $insertData['lc_id'] = $postData['lc_id'];
            }

            if (!empty($postData['cost_number'])) {
                $insertData['cost_number'] = $postData['cost_number'];
            }
                        
            if (!empty($postData['unit_price'])) {
                $insertData['unit_price'] = $postData['unit_price'];
            }
            if (!empty($postData['uh_unit_price'])) {
                $insertData['uh_unit_price'] = $postData['uh_unit_price'];
            }else{
                $insertData['uh_unit_price'] =0;
            }
            
            
            $insertData['total_unit_price'] = $postData['unit_price']+$postData['uh_unit_price'];
            
            
            if (!empty($postData['bdt_rate'])) {
                $insertData['bdt_rate'] = $postData['bdt_rate'];
            }else{
                $insertData['bdt_rate'] =0;
            }
            
            if (!empty($postData['lc_qty'])) {
                $insertData['lc_qty'] = $postData['lc_qty'];
            }else{
                $insertData['lc_qty'] =0;
            }
            
            
            $insertData['lc_value'] = $postData['unit_price']*$postData['lc_qty'];
           
            
            if (!empty($postData['grand_total_amount'])) {
                $insertData['grand_total_amount'] = $postData['grand_total_amount'];
            }else{
                $insertData['grand_total_amount']=0;
            }
            
            $insertData['updated_by'] =$user_id;

            $insertData['updated_date'] = date('Y-m-d');
            
            

            $id = $this->m_common->update_row('import_lc_landed_cost',array('id'=>$lc_id),$insertData);
           
            if ($id>=0) {
                $this->m_common->delete_row('import_lc_landed_cost_details',array('cost_id'=>$lc_id));
                    $hook_total_amount=0;
                    $yard_total_amount=0;
                    
                    foreach ($postData['c_h_id'] as $key => $each) {
                    
                        $insertData1 = array();

                        $insertData1['cost_id'] =$lc_id;

                        $insertData1['c_h_id'] = $postData['c_h_id'][$key];
                        $insertData1['cash_amount'] = $postData['cash_amount'][$key];

                        $insertData1['bank_loan_amount'] = $postData['bank_loan_amount'][$key];
                        $insertData1['total_amount'] = $postData['total_amount'][$key];

                        $insertData1['payment_status'] = "Pending";
                        $insertData1['is_active'] =1;
                        $this->m_common->insert_row('import_lc_landed_cost_details', $insertData1);
                        if($postData['hook_cost'][$key]=='Yes'){
                            $hook_total_amount=$hook_total_amount+$postData['total_amount'][$key]; 
                        }

                        if($postData['yard_cost'][$key]=='Yes'){
                           $yard_total_amount=$yard_total_amount+$postData['total_amount'][$key];   
                        }
                    }
                    
                    $this->m_common->update_row('import_lc_landed_cost',array('id'=>$lc_id),array('hook_total_amount'=>$hook_total_amount,'yard_total_amount'=>$yard_total_amount));
                
                



                

                redirect_with_msg('imports/landed_cost', 'Successfully Updated');
            } else {
                redirect_with_msg('imports/landed_cost/edit_landed_cost/'.$lc_id, 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('imports/landed_cost/edit_landed_cost/'.$lc_id, 'Please fill the form and submit');
        }
    }
    
    
    function detailsLandedCost($lc_id,$print=false){
        $this->menu = 'imports';
        $this->sub_menu = 'import';
        $this->sub_inner_menu = 'landed_cost';
        
        $branch_id = $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');

        

        $this->titlebackend("Details Landed Cost");

        $lc_sql="select il.*,rlr.mother_vessel_name from import_lc il left join rm_lc_receive rlr on il.lc_id=rlr.lc_id";
        $data['lcs']=$this->m_common->customeQuery($lc_sql);
        
        //$data['cost_info']=$this->m_common->get_row_array('import_lc_landed_cost',array('id'=>$lc_id),'*');
        $c_sql="select illc.*,rlr.mother_vessel_name,il.lc_no from import_lc_landed_cost illc left join  rm_lc_receive rlr on illc.lc_id=rlr.lc_id left join import_lc il on rlr.lc_id=il.lc_id where illc.id=".$lc_id;
        $data['cost_info']=$this->m_common->customeQuery($c_sql);
        
        $sql="select ilcd.*,ilch.name from  import_lc_landed_cost_details ilcd left join import_landed_cost_head ilch on ilcd.c_h_id=ilch.id where ilcd.cost_id=".$lc_id." order by ilcd.id ASC ";
        $data['cost_heads']=$this->m_common->customeQuery($sql);
        
        if($print==false){
            $this->load->view('imports/landed_cost/details_landed_cost', $data);
        }else{
            $html=$this->load->view('imports/landed_cost/print_landed_cost', $data,true);
            echo $html;exit; 
        }
    }
    
    
    function delete($id)
    {
        if ($this->m_common->update_row('import_lc_landed_cost', array('id'=>$id),array('is_active'=>0))) {
            $this->m_common->update_row('import_lc_landed_cost_details', array('cost_id'=>$id),array('is_active'=>0));
            redirect_with_msg($_SERVER['HTTP_REFERER'], 'Successfully Delete');
        } else
            redirect_with_msg($_SERVER['HTTP_REFERER'], 'Failed to Delete');
    }
   
    
    
    function lcInfo(){
        $this->setOutputMode(NORMAL);
        $lc_id=$this->input->post('lc_id');
        $l_sql="select sum(qty) as total_qty,price from import_lc_details where lc_id=".$lc_id;
        $data['lc_info']=$this->m_common->customeQuery($l_sql);        
        echo json_encode($data);
    }

    
    
    
    
    
    
}
