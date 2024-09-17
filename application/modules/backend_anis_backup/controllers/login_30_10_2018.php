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
        $table = 'admin';
        //$user_type=1;
        if (!empty($postArray)) {
            $result = $this->m_common->login_with_password_string($postArray['user_name'], md5($postArray['user_pass']), $table);
            if (!empty($result->ID) && isset($result->ID)) {
                $this->session->set_userdata('user_id', $result->ID);
                $this->session->set_userdata('user_name', $result->uname);
                $this->session->set_userdata('theme', $result->theme);
                $this->session->set_userdata('logged_in', 1);
                $this->session->set_userdata('rank', $result->rank);
                $this->session->set_userdata('logged_in', 1);

                redirect(site_url(ADMIN . '/dashboard'));
//                echo 'Hello';
            } else {

                $data['message'] = "Incorrect Username or Password";
                $this->titlebackend("");
                $this->load->view('v_login', $data);
            }
        }
    }

    public function logOut() {
        $this->session->unset_userdata('ID');
        $this->session->unset_userdata('uname');
        $this->session->unset_userdata('logged_in');
        redirect_with_msg("admin", "Successfully log out");
    }

}
