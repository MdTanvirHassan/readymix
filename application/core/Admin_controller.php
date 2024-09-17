<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

abstract class Admin_controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->model('front/m_common');
        //$this->_set_common_data();
        //$this->addCss(array('admin/screen','jquery.fancybox-1.3.4'));
     //   $this->addJs("jquery-1.6.2");
      //  $this->addJs(array( 'admin/ui.core', 'admin/jquery.selectbox-0.5_style_2', 'admin/jquery.filestyle', 'admin/jquery.tooltip', 'admin/jquery.pngFix.pack','jquery.fancybox-1.3.4'));
     //   $this->_addCkEditor();
        $this->getTemplatePath(true);
        if(isset($_SESSION['user_id'])){
                    $this->retval=$this->get_msg_count(40);
                }
    }

    function _set_common_data() {
        //$this->data['countries'] = $this->countries = $this->m_common->get_countries();
        $this->data['site_name'] = $this->config->item("site_name");
        //$this->_prepareMenuSelector();
        //$this->load->library("front/dropdowns");
        //$this->data['categories'] = $this->dropdowns->get_item_categories('all');
    }

    function _prepareMenuSelector() {

        $_menu = $this->m_common->get_menu();
        foreach ($_menu as $k => $v) {
            $_menu[$k]['link'] = $v['id'];
        }

        $this->load->helper("dynamic_menu");
        $this->data['parent_selector_menu'] = list_menu($_menu, 'class = topnav');
    }

    function _security() {
        if (!$this->_is_logged_in()) {
            redirect_with_msg(ADMIN, "Please login to see the page");
            exit;
        }
    }

    function _is_logged_in() {
        $id = $this->session->userdata("admin_id");
        if (!empty($id))
            return TRUE;
        else
            return FALSE;
    }

    function _invalid_link() {
        $this->_setTitle("Invalid link");
        $data['site_name'] = $this->config->item("site_name");
        $data['heading'] = "Invalid link";
        $data['message'] = "Sorry, the link you are following is invalid or already expired.";
        $this->parser->parse("error_pages/error", $data);
    }
    
        function get_msg_count($user_id){
       
                $this->load->library('mahana_messaging');
                $this->load->model("mahana_model");
        //$user_id='1';
        //$status_id='0';
       return $this->mahana_messaging->get_msg_count($user_id);
    }

}