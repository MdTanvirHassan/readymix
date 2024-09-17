<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends Site_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model("m_common");
        $this->setTemplateFile('template_login');
    }

    function index() {

        if (!$this->is_logged_in($this->session->userdata('logged_in'))) {
            $this->login();
        } else {
            redirect('backend/dashboard');
        }
    }

    public function login() {
        $this->titlebackend("Login");
        $table = 'admin';
        $select = 'theme';
        $where['ID'] = $this->session->userdata('ID');
        $data['theme'] = $this->m_common->get_row($table, $where, $select);
        $this->load->view('v_login', $data);
    }

    public function loginAction() {
       $postArray = $this->input->post();
       // $table = 'admin';
       $table = 'users';
        //$user_type=1;
        if (!empty($postArray)) {
            $result = $this->m_common->login_with_password_string($postArray['user_name'], md5($postArray['user_pass']), $table);
            if (!empty($result->id) && isset($result->id)) {
                $this->session->set_userdata('user_id', $result->id);
                $this->session->set_userdata('user_type', $result->user_type);
                $this->session->set_userdata('user_name', $result->username);
                $this->session->set_userdata('employeeId', $result->employeeId);
             //   $this->session->set_userdata('theme', $result->theme);
                $this->session->set_userdata('logged_in', 1);
                
//                if ($result->user_type != 1) {
//                    $company = $this->m_common->get_row_array('department', array('d_id' => $result->company), '*');
//                    $this->session->set_userdata('companyId', $company[0]['d_id']);
//                    $this->session->set_userdata('companyName', $company[0]['dep_description']);
//                    
//                }
                
                if($result->user_type ==2 || $result->user_type ==4){
                    $company = $this->m_common->get_row_array('department', array('d_id' => $result->company), '*');
                    $this->session->set_userdata('companyId', $company[0]['d_id']);
                    $this->session->set_userdata('companyName', $company[0]['dep_description']);
                    
                }
             

                redirect(site_url(ADMIN . '/dashboard'));

            } else {

                $data['message'] = "Incorrect Username or Password";
                $this->titlebackend("");
                $this->load->view('v_login', $data);
            }
        }
    }
    
   
    

    public function logOut() {
      //  $this->session->unset_userdata('ID');
     //   $this->session->unset_userdata('uname');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('companyId');
        redirect_with_msg("admin", "Successfully log out");
    }
    
     public function profile() {
        $this->titlebackend("Profile");
        $this->setTemplateFile('template');
        $table ='admin';
        $select= 'theme';
        $where['ID'] = $this->session->userdata('ID');
        $data['theme'] = $this->m_common->get_row($table, $where, $select);
        $this->load->view('v_profile', $data);
    }
    
    public function changePassword() {
        $this->titlebackend("Profile");
        $this->setTemplateFile('template');
        $table ='admin';
        $select= 'theme';
        $where['ID'] = $this->session->userdata('ID');
        $data['theme'] = $this->m_common->get_row($table, $where, $select);
        $this->load->view('v_change_password', $data);
    }
    
    
    public function changePasswordAction(){
        $this->titlebackend("Profile");
        $this->setTemplateFile('template');
        
        $user_id=$this->session->userdata('user_id');
        $postArray = $this->input->post();
       // $table = 'admin';
        $table = 'users';
        //$user_type=1;
        if(!empty($postArray)){
            $this->db->where('id',$this->session->userdata('user_id'));
            $res = $this->db->get("users");
            $res = $res->row();
            if($res->password != md5($postArray['old_pass'])){
                $data['message'] = "Invalid Password";
            }else{
                if($postArray['new_pass'] != $postArray['confirm_pass']){                   
                    $data['message'] = "Passwords not match";
                }else{
                    if(strlen($postArray['confirm_pass']) < 6 || strlen($postArray['confirm_pass']) > 20){
                        $data['message']="Passwords length must be between 6 to 20 charecters";
                    }else{

                        $r=$this->m_common->update_row("users",array('id'=>$user_id), array("password" => md5($postArray['confirm_pass'])));
                        if($r>0)
                            $data['message']="Successfully password changed";
                        else
                            $data['message']="Cannot change password";
                    }
               }
            }
        }else{
            $data['message'] = "Invalid Password";
        }
        $this->load->view('v_change_password', $data);
    }

}
