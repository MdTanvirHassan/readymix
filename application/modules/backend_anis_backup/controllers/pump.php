<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pump extends Site_Controller {

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
        $this->menu = 'pump_fooding';
        $this->sub_menu = 'pump';
        $this->sub_inner_menu = 'pump';
        $this->titlebackend("pump");
        $sql = "select p.*,c.c_name,c.c_short_name,pro.project_name from tbl_pump p left join tbl_customers c on p.customer_id=c.id left join tbl_project pro on p.project_id=pro.project_id where p.is_active=1";
        $data['pumps'] = $this->m_common->customeQuery($sql);
        $this->load->view('pump/v_pump', $data);
    }

    function add_pump() {
        $this->menu = 'pump_fooding';
        $this->sub_menu = 'pump';
        $this->sub_inner_menu = 'pump';
        $this->titlebackend("Pump Information");
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*');
        $pmump = $this->m_common->get_row_array('tbl_pump', '', 'pump_no', '', '1', 'pump_no', 'desc');
        if (empty($pmump)) {
            $sl = 'pump-0001';
        } else {
            $sl = $pmump[0]['pump_no'];
            $sl++;
        }
        $data['pump_no'] = $sl;
        $this->load->view('pump/v_add_pump', $data);
    }

    function get_customer_details() {
        $branch_id = $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');
        $data['projects'] = $this->m_common->get_row_array('tbl_project', array('customer_id' => $id), '*', '', '', 'project_id', 'DESC');
        $data['customer_info'] = $this->m_common->get_row_array('tbl_customers', array('id' => $id, 'is_active' => 1), '*');
        echo json_encode($data);
    }

    function add_pump_action() {
        $user_id=$this->session->userdata('user_id');
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();           
            if (!empty($postData['customer_id'])) {
                $insertData['customer_id'] = $postData['customer_id'];
            }
            if (!empty($postData['project_id'])) {
                $insertData['project_id'] = $postData['project_id'];
            }
            if (!empty($postData['pump_no'])) {
                $insertData['pump_no'] = $postData['pump_no'];
            }
            if (!empty($postData['group_name'])) {
                $insertData['group_name'] = $postData['group_name'];
            }
            if (!empty($postData['person'])) {
                $insertData['person'] = $postData['person'];
            }
            if (!empty($postData['casting_qty'])) {
                $insertData['casting_qty'] = $postData['casting_qty'];
            }
            if (!empty($postData['per_person_bill'])) {
                $insertData['per_person_bill'] = $postData['per_person_bill'];
            }
            if (!empty($postData['total_bill'])) {
                
                $insertData['total_bill'] = $postData['total_bill'];
            }
            if (!empty($postData['to_time'])) {
                $insertData['to_time'] = $postData['to_time'];
            }
            if (!empty($postData['from_time'])) {
                $insertData['from_time'] = $postData['from_time'];
            }
            if (!empty($postData['remarks'])) {
                $insertData['remarks'] = $postData['remarks'];
            }
            if (!empty($postData['date'])) {
                $insertData['date'] = date('Y-m-d', strtotime($postData['date']));
            }
            $insertData['is_active']=1;
            $insertData['created_date'] = date('Y-m-d');
            $insertData['created_by']=$user_id;
            $result=$this->m_common->insert_row('tbl_pump',$insertData);
             if(!empty($result)){
                
                  redirect_with_msg('pump', 'Successfully Inserted');
             }
             }else{
              redirect_with_msg('pump/add_pump', 'Please fill the form and submit');
         }
    }
    
    function details_pump($pump_id){
        $this->titlebackend("Pump Info");
        $sql = "select p.*,c.c_name,c.c_short_name,pro.project_name from tbl_pump p left join tbl_customers c on p.customer_id=c.id left join tbl_project pro on p.project_id=pro.project_id where pump_id=".$pump_id;
        $data['pumps'] = $this->m_common->customeQuery($sql);
        $this->load->view('pump/v_details_pump', $data);
    }

    function edit_pump($id){
        $this->titlebackend("Pump Info");
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        $data['project_info']=$this->m_common->get_row_array('tbl_project',array('is_active'=>1),'*');
        $sql = "select p.*,c.c_name,c.c_short_name,pro.project_name from tbl_pump p left join tbl_customers c on p.customer_id=c.id left join tbl_project pro on p.project_id=pro.project_id where pump_id=".$id;
        $data['pumps'] = $this->m_common->customeQuery($sql);
        $this->load->view('pump/v_edit_pump',$data);
    }
    
    function edit_pump_action($pump_id) {
       $user_id=$this->session->userdata('user_id');
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();           
            if (!empty($postData['customer_id'])) {
                $insertData['customer_id'] = $postData['customer_id'];
            }
            if (!empty($postData['project_id'])) {
                $insertData['project_id'] = $postData['project_id'];
            }
            if (!empty($postData['pump_no'])) {
                $insertData['pump_no'] = $postData['pump_no'];
            }
            if (!empty($postData['group_name'])) {
                $insertData['group_name'] = $postData['group_name'];
            }
            if (!empty($postData['person'])) {
                $insertData['person'] = $postData['person'];
            }
            if (!empty($postData['casting_qty'])) {
                $insertData['casting_qty'] = $postData['casting_qty'];
            }
            if (!empty($postData['per_person_bill'])) {
                $insertData['per_person_bill'] = $postData['per_person_bill'];
            }
            if (!empty($postData['total_bill'])) {
                
                $insertData['total_bill'] = $postData['total_bill'];
            }
            if (!empty($postData['to_time'])) {
                $insertData['to_time'] = $postData['to_time'];
            }
            if (!empty($postData['from_time'])) {
                $insertData['from_time'] = $postData['from_time'];
            }
            if (!empty($postData['remarks'])) {
                $insertData['remarks'] = $postData['remarks'];
            }
            if (!empty($postData['date'])) {
                $insertData['date'] = date('Y-m-d', strtotime($postData['date']));
            }
            $id=$this->m_common->update_row('tbl_pump', array('pump_id' =>$pump_id),$insertData);
            if($id==0 || $id>0) {
                redirect_with_msg('pump/index', 'Successfully Updated');
            } else {
                redirect_with_msg('pump/edit_pump/'.$pump_id, 'Data not updated for an unexpected error');
            }
        } else {
            redirect_with_msg('pump/edit_pump/'.$pump_id, 'Please fill the form and submit');
        }
    }
    
    function delete_pump($pump_id) {
        if(!empty($pump_id)) {
            $id=$this->m_common->update_row('tbl_pump', array('pump_id' =>$pump_id),array('is_active'=>0));
            if (!empty($id)) {   
                redirect_with_msg('pump/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('pump/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('pump/index', 'Please click on delete button');
        }
    }

    function allPump($print = false) {
       $this->menu = 'pump_fooding';
        $this->sub_menu = 'pump';
        $this->sub_inner_menu = 'pump';
        $this->titlebackend("Report");
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');         
        $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1), '*', '', '', 'project_name');         
        $where = '';
        $postData = $this->input->post();
        if (!empty($postData)) {
            $f_time = $this->input->post('from_time');
            $t_time = $this->input->post('to_time');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "p.customer_id=$customer_id";
                } else {
                    $where .= " and p.customer_id=$customer_id";
                }
            }else {
                $data['customer_id'] = '';
            }

            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    $where .= "p.project_id=$project_id";
                } else {
                    $where .= " and p.project_id=$project_id";
                }
            } 
            else {
                $data['project_id'] = '';
            }
            if (!empty($f_time) & !empty($t_time)) {
                $data['from_time'] = $f_time;
                $data['to_time'] = $t_time;
            }
            

            if (!empty($f_time) & !empty($t_time)) {
                if(!empty($where))
                $sql = "select p.*,c.c_name,c.c_short_name,pro.project_name from tbl_pump p left join tbl_customers c on p.customer_id=c.id left join tbl_project pro on p.project_id=pro.project_id  where $where and p.is_active=1 and p.from_time>='" . $f_time . "' and p.to_time<='" . $t_time."'";        
                else
                $sql = "select p.*,c.c_name,c.c_short_name,pro.project_name from tbl_pump p left join tbl_customers c on p.customer_id=c.id left join tbl_project pro on p.project_id=pro.project_id  where p.is_active=1 and p.from_time>='" . $f_time . "' and p.to_time<='" . $t_time."'";        
             }
             else {
                $sql = "select p.*,c.c_name,c.c_short_name,pro.project_name from tbl_pump p left join tbl_customers c on p.customer_id=c.id left join tbl_project pro on p.project_id=pro.project_id where $where and p.is_active=1 ";        
             }
            $data['pumps'] = $this->m_common->customeQuery($sql);
        } 
        else {
            $sql = "select p.*,c.c_name,c.c_short_name,pro.project_name from tbl_pump p left join tbl_customers c on p.customer_id=c.id left join tbl_project pro on p.project_id=pro.project_id where p.is_active=1";        
            $data['pumps'] = $this->m_common->customeQuery($sql);
        }

        if ($print == false) {
            $this->load->view('pump/v_pump_report', $data);
        } else {
            $html = $this->load->view('pump/print_all_pump', $data, true);
            echo $html;
            exit;
        }
    }
}
