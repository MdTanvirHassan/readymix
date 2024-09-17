<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Finished_goods extends Site_Controller {

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
    }

    function index() {
        $this->menu = 'finished_goods';
        $this->sub_menu = 'finished_goods_current_stock';
        $this->titlebackend("Finished Goods Current Stock");

        $this->load->view('finished_goods/v_fg_current_stock');
    }

    function finished_goods_delivery_session(){
        $this->menu = 'finished_goods';
        $this->sub_menu = 'finished_goods_delivery_session';
        $this->titlebackend("Finished Goods Delivery Session");

        $this->load->view('finished_goods/v_fg_delivery_session');
    }
    
    function finished_goods_receive_session(){
        $this->menu = 'finished_goods';
        $this->sub_menu = 'finished_goods_receive_session';
        $this->titlebackend("Finished Goods Receive Session");

        $this->load->view('finished_goods/v_fg_receive_session');
    }
    
      function finished_goods_receiving_report(){
        $this->menu = 'finished_goods';
        $this->sub_menu = 'finished_goods_receiving_report';
        $this->titlebackend("Finished Goods Receiving Report");

        $this->load->view('finished_goods/v_fg_receiving_report');
    }
    
    function finished_goods_sale_return_session(){
        $this->menu = 'finished_goods';
        $this->sub_menu = 'finished_goods_sale_return_session';
        $this->titlebackend("Finished Goods Sale Return Session");

        $this->load->view('finished_goods/v_fg_sale_return_session');
    }
    
     function finished_goods_lot_information(){
        $this->menu = 'finished_goods';
        $this->sub_menu = 'finished_goods_lot_information';
        $this->titlebackend("Finished Goods Lot Information");

        $this->load->view('finished_goods/v_fg_lot_info');
    }
   

}

