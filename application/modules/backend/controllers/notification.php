<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification extends Site_Controller {

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
        $test=$this->session->userdata('companyId');
        $this->company_id = $this->session->userdata('companyId');
        if(empty($this->company_id)){
             redirect_with_msg('backend/dashboard', 'Please click on enter here button to see this page');
        }
    }

    function notifications() {
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $this->setOutputMode(NORMAL);
        $this->data['all'] = array();
        $this->data['alert'] = array();
        $notices = $this->m_common->get_row_array('notice', array('employee_id' =>$employee_id,'status' =>"Unseen"), '*');
        $i = 0;
        $data1 = array();
        if (count($notices) > 0) {
            foreach ($notices as $key => $notice) {
                $employee_id = $this->session->userdata('employeeId');
                $pdate = date("Y-m-d H:i:s");
                $dafstdate = $notice['create_date'];
                $first_date = new DateTime($dafstdate);
                $second_date = new DateTime($pdate);
                $difference = $first_date->diff($second_date);
                $time = '';
                if ($difference->y >= 1) {
                    $format = 'Y-m-d H:i:s';
                    $date = DateTime::createFromFormat($format, $dafstdate);
                    $time = $date->format('M d Y');
                } elseif ($difference->m == 1 && $difference->m != 0) {
                    $time = $difference->m . " month";
                } elseif ($difference->m <= 12 && $difference->m != 0) {
                    $time = $difference->m . " months";
                } elseif ($difference->d == 1 && $difference->d != 0) {
                    $time = "Yesterday";
                } elseif ($difference->d <= 31 && $difference->d != 0) {
                    $time = $difference->d . " days";
                } else if ($difference->h == 1 && $difference->h != 0) {
                    $time = $difference->h . " hr";
                } else if ($difference->h <= 24 && $difference->h != 0) {
                    $time = $difference->h . " hrs";
                } elseif ($difference->i <= 60 && $difference->i != 0) {
                    $time = $difference->i . " mins ago";
                } elseif ($difference->s <= 10) {
                    $time = "Just Now";
                } elseif ($difference->s <= 60 && $difference->s != 0) {
                    $time = $difference->s . " sec";
                }

                $notice['time'] = $time;
               
                $this->data['alert'][] = $notice;

                $i++;
            }
        }
        $data1 = $this->data['alert'];
        echo json_encode($data1);
    }
    
    function notice_update($id) {
        $result = $this->m_common->get_row_array("notice", array('id' => $id), "*");
//        if ($result[0]['employee_id'] == null) {
//            $array = array(
//                "noticeId" => $id,
//                "employee_id" => $this->session->userdata('employeeId'),
//                "usertype" => $user_type = $this->session->userdata('user_type')
//            );
//        } else {
//            $array = array(
//                "noticeId" => $id,
//                "employee_id" => $result[0]['employee_id'],
//                "usertype" => $user_type = $this->session->userdata('user_type')
//            );
//        }
//        $this->m_common->insert_row("alert", $array);
        $this->m_common->update_row("notice", array('id' => $id), array('status' => 'Seen'));
        
        redirect_with_msg($result[0]['url']);
    }
   

}



