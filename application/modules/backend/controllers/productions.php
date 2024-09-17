<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productions extends Site_Controller {

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

    function index(){
        $branch_id = $this->session->userdata('companyId');
       // $user_category =$this->session->userdata('user_category');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'production_schedule';
        $this->titlebackend("Production Schedule");
        $sql = "select s.*,(select GROUP_CONCAT(delivery_no) from tbl_delivery_orders d join tbl_production_schedule_details pd on d.do_id=pd.do_id where pd.schedule_id=s.id) as delivery_no from tbl_production_schedule s WHERE s.date>='2022-02-01' and unit_id=$branch_id and is_active=1 ORDER BY id DESC";
        $data['production_schedules'] = $this->m_common->customeQuery($sql); //$this->m_common->get_row_array('tbl_production_schedule',array('unit_id'=>$branch_id,'is_active'=>1),'*');
        $this->load->view('productions/v_production_schedule', $data);
    }

    function delivery_orders() {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'delivery_orders';
        $this->titlebackend("Delivery Orders");
        // $data['sale_order']=$this->m_common->get_row_array('tbl_sales_sale_order
        // $sql="select d.*,so.order_no,c.c_name from tbl_delivery_orders d left join tbl_sales_orders so on d.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where d.is_active=1";
        // $sql = "select d.*,so.order_no,c.c_name from tbl_delivery_orders d 
        // left join tbl_sales_orders so on d.o_id=so.o_id 
        // left join tbl_sales_quotation q on so.q_id=q.q_id 
        // left join tbl_customers c on so.customer_id=c.id where d.is_active=1 and d.unit_id=" . $branch_id . ' and d.do_status="Approved" order by d.do_id DESC';

        // $data['delivery_orders'] = $this->m_common->customeQuery($sql);
        $this->load->view('productions/v_delivery_order');
    }

    public function delivery_orders_list(){
        $this->setOutputMode(NORMAL);
           // POST data
           $postData = $this->input->post();
           $branch_id = $this->session->userdata('companyId');
           $user_id =$this->session->userdata('user_id');
           // $user_category=$this->session->userdata('user_category');
           $userData =$this->m_common->get_row_array('users',array('id' =>$user_id),'*');
           $this->role =checkUserPermission(13, 62, $userData);
           
           $this->load->library('DataTables');
           $this->datatables->setDatabase($this->db->database);
           $aTable = 'tbl_delivery_orders';
           $aColumns = array('tbl_delivery_orders.do_id','tbl_delivery_orders.delivery_order_date','tbl_delivery_orders.delivery_no','tbl_sales_orders.order_no','tbl_customers.c_name','tbl_delivery_orders.project_name','tbl_delivery_orders.status','tbl_delivery_orders.do_status');
           $joinTable = array('tbl_sales_orders','tbl_sales_quotation','tbl_customers');
           $JoinCriteria = array('tbl_sales_orders.o_id=tbl_delivery_orders.o_id ','tbl_sales_quotation.q_id=tbl_sales_orders.q_id','tbl_customers.id=tbl_sales_orders.customer_id');
           $joinStatus = array('','left','left','left');
           $where['tbl_delivery_orders.unit_id']=$branch_id;  

           //    if($user_category==2){
        //         $where['tbl_delivery_orders.delivery_order_date']=date('Y-m-d');  
        //    }



           $records = $this->datatables->get_json($aTable, $aColumns,$joinTable,$JoinCriteria,$joinStatus,$where);
          //echo $this->db->last_query();exit;
           $data = array();
           foreach($records['data'] as $key=>$record ){
      
               $data[$key] = array( 
                  "delivery_order_date"=>$record->delivery_order_date,
                  "delivery_no"=>$record->delivery_no,
                  "order_no"=>$record->order_no,
                  "c_name"=>$record->c_name,
                  "project_name"=>$record->project_name,
                  "status"=>$record->status,
                  "do_status"=>$record->do_status,
                ); 
                $action='';
                
                    if (in_array(4, $this->role)) {
                        $action.='<a href="'.site_url('productions/details_delivery_order/'.$record->do_id).'"><button class="btn btn-sm btn-success" >View</button></button></a>';
                    }
                    
                
                
                
                
               
                $data[$key]["action"] = $action;
            }
            $response = array(
               "draw" => intval($records['draw']),
               "iTotalRecords" => $records['recordsTotal'],
               "iTotalDisplayRecords" => $records['recordsFiltered'],
               "aaData" => $data
            );
      
           echo json_encode($response);
        }

    function add_production_schedule() {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'production_schedule';
        $this->titlebackend("Quotation Information");
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        $schedule_last_code = $this->m_common->get_row_array('schedule_code', array('branch_id' => $branch_id), '*', '', 1, 'id', 'DESC');
        if (!empty($schedule_last_code)) {
            $schedule_code = $schedule_last_code[0]['schedule_code'] + 1;
            if ($schedule_code > 999) {
                $schedule_sl_no = $schedule_code;
            } else if ($schedule_code > 99) {
                $schedule_sl_no = "0" . $schedule_code;
            } else if ($schedule_code > 9) {
                $schedule_sl_no = "00" . $schedule_code;
            } else {
                $schedule_sl_no = "000" . $schedule_code;
            }
        } else {
            $schedule_code = 1;
            $schedule_sl_no = '0001';
        }

        $data['schedule_code'] = $schedule_code;
        $data['schedule_auto_code'] = $schedule_sl_no;

        //  $sql="select dod.*,do.delivery_no,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_delivery_order_details dod left join tbl_sales_products sp on dod.s_item_id=sp.product_id left join tbl_delivery_orders do on dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join  tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.do_status='Approved' and do.is_active=1 ";
    //    $sql = "select dod.*,do.delivery_no,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_delivery_order_details dod left join tbl_sales_products sp on dod.s_item_id=sp.product_id left join tbl_delivery_orders do on dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join  tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on so.customer_id=c.id where do.do_status='Approved' and do.is_active=1 and (schedule_status='Pending' or schedule_status='Partial Scheduled' )";
      //  $sql = "select dod.*,do.delivery_no,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_delivery_order_details dod left join tbl_sales_products sp on dod.s_item_id=sp.product_id left join tbl_delivery_orders do on dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join  tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on so.customer_id=c.id where do.do_status='Approved' and do.is_active=1 and (schedule_status='Pending' or schedule_status='Partial Scheduled' ) and do.unit_id=".$branch_id." order by do.delivery_order_date";
        $sql = "select dod.*,do.delivery_no,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_delivery_order_details dod left join tbl_sales_products sp on dod.s_item_id=sp.product_id left join tbl_delivery_orders do on dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join  tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on so.customer_id=c.id where do.do_status='Approved' and (do.closing_status is null or do.closing_status!='Closed') and do.is_active=1 and (schedule_status='Pending' or schedule_status='Partial Scheduled' ) and do.unit_id=".$branch_id." order by do.delivery_order_date";
        $data['do_orders'] = $this->m_common->customeQuery($sql);
        foreach ($data['do_orders'] as $key => $schedule_item) {
            $data['do_orders'][$key]['quantity'] = $schedule_item['quantity'] - $schedule_item['schedule_qty'];
        }
        $this->load->view('productions/v_add_production_schedule', $data);
    }

    function add_production_schedule_action() {
        $branch_id = $this->session->userdata('companyId');
        $postData = $this->input->post();
        if (!empty($postData)) {

            $insertData = array();
            if (!empty($postData['date'])) {
                $insertData['date'] = date('Y-m-d', strtotime($postData['date']));
            }

            if (!empty($postData['schedule_no'])) {
                $insertData['schedule_no'] = $postData['schedule_no'];
                $schedule_pre_info=$this->m_common->get_row_array('tbl_production_schedule', array('schedule_no' =>$postData['schedule_no'],'unit_id' => $branch_id,'is_active'=>1),'*');
                if(!empty($schedule_pre_info)){
                    redirect_with_msg('productions/add_production_schedule', 'This schedule already exists');
                }
            }

            if (empty($postData['item_select'])) {
                redirect_with_msg('productions/add_production_schedule', 'Plese Select Item');
            }

            $insertData['unit_id'] = $branch_id;
            $insertData['is_active'] = 1;
            $insertData['status'] = 'Pending';
            $insertData['created_date'] = date('Y-m-d');
            $result = $this->m_common->insert_row('tbl_production_schedule', $insertData);
            if (!empty($result)) {
                $this->m_common->insert_row('schedule_code', array('schedule_code' => $postData['schedule_code'], 'branch_id' => $branch_id));
                //  $this->m_common->update_row('tbl_sales_orders', array('o_id' =>$o_id),array('status'=>"Generated Delivery Order"));

                foreach ($postData['product_id'] as $key => $each) {
                    if (in_array($key, $postData['item_select'])) {
                        $insertData1 = array();
                        $insertData1['schedule_id'] = $result;
                        $insertData1['product_id'] = $each;
                        $insertData1['is_active'] = 1;
                        $insertData1['branch_id'] = $branch_id;
                        $insertData1['production_status'] = "Pending";
                        $insertData1['mixing_status'] = "Pending";
                        if (empty($each)) {
                            continue;
                        }
                        if (!empty($postData['do_details_id'][$key])) {
                            $insertData1['do_details_id'] = $postData['do_details_id'][$key];
                        }

                        if (!empty($postData['do_id'][$key])) {
                            $insertData1['do_id'] = $postData['do_id'][$key];
                        }

                        if (!empty($postData['do_qty'][$key])) {
                            $insertData1['do_qty'] = $postData['do_qty'][$key];
                        }

                        if (!empty($postData['schedule_qty'][$key])) {
                            $insertData1['schedule_qty'] = $postData['schedule_qty'][$key];
                        }


                        $success = $this->m_common->insert_row('tbl_production_schedule_details', $insertData1);
                        if (!empty($success)) {
                            if (!empty($success)) {
                                $pre_s_qty = $this->m_common->get_row_array('tbl_delivery_order_details', array('do_id' => $postData['do_id'][$key], 's_item_id' => $each), '*');
                                $net_s_qty = $postData['schedule_qty'][$key] + $pre_s_qty[0]['schedule_qty'];
                                if ($net_s_qty == $pre_s_qty[0]['quantity']) {
                                    $this->m_common->update_row('tbl_delivery_order_details', array('do_id' => $postData['do_id'][$key], 's_item_id' => $each), array('schedule_status' => "Scheduled", 'schedule_qty' => $net_s_qty));
                                } else {
                                    $this->m_common->update_row('tbl_delivery_order_details', array('do_id' => $postData['do_id'][$key], 's_item_id' => $each), array('schedule_status' => "Partial Scheduled", 'schedule_qty' => $net_s_qty));
                                }
                            }
                        }
                    }
                }
                redirect_with_msg('productions', 'Successfully Inserted');
            }
        } else {
            redirect_with_msg('productions/add_delivery_order', 'Please fill the form and submit');
        }
    }

    function edit_production_schedule($id) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'production_schedule';
        $this->titlebackend("Production Schedule Information");
        $data['schedule_info'] = $this->m_common->get_row_array('tbl_production_schedule', array('id' => $id), '*');
        $sql = "select d.*,do.delivery_no,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_production_schedule_details d left join tbl_delivery_orders do on d.do_id=do.do_id left join tbl_sales_products sp on d.product_id=sp.product_id left join tbl_sales_orders so on do.o_id=so.o_id left join  tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where d.is_active=1 and d.schedule_id=" . $id;
        $data['sd_details'] = $this->m_common->customeQuery($sql);
        $this->load->view('productions/v_edit_production_schedule', $data);
    }

    function edit_production_schedule_action($id) {
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            if (!empty($postData['date'])) {
                $insertData['date'] = date('Y-m-d', strtotime($postData['date']));
            }

            if (!empty($postData['schedule_no'])) {
                $insertData['schedule_no'] = $postData['schedule_no'];
            }

            $result = $this->m_common->update_row('tbl_production_schedule', array('id' => $id), $insertData);
            if ($result >= 0) {
                $this->m_common->delete_row('tbl_production_schedule_details', array('schedule_id' => $id));
                foreach ($postData['product_id'] as $key => $each) {

                    $insertData1 = array();
                    $insertData1['schedule_id'] = $id;
                    $insertData1['product_id'] = $each;
                    $insertData1['is_active'] = 1;
                    $insertData1['production_status'] = "Pending";
                    $insertData1['mixing_status'] = "Pending";
                    if (empty($each)) {
                        continue;
                    }
                    if (!empty($postData['do_details_id'][$key])) {
                        $insertData1['do_details_id'] = $postData['do_details_id'][$key];
                    }

                    if (!empty($postData['do_id'][$key])) {
                        $insertData1['do_id'] = $postData['do_id'][$key];
                    }

                    if (!empty($postData['do_qty'][$key])) {
                        $insertData1['do_qty'] = $postData['do_qty'][$key];
                    }

                    if (!empty($postData['schedule_qty'][$key])) {
                        $insertData1['schedule_qty'] = $postData['schedule_qty'][$key];
                    }



                    $success = $this->m_common->insert_row('tbl_production_schedule_details', $insertData1);
                    if (!empty($success)) {
                        $net_s_qty = '';
                        $pre_s_qty = $this->m_common->get_row_array('tbl_delivery_order_details', array('do_id' => $postData['do_id'][$key], 's_item_id' => $each), '*');
                        // $net_s_qty = $postData['schedule_qty'][$key] - $pre_s_qty[0]['schedule_qty'];
                        // $net_s_qty += $postData['schedule_qty'][$key];
                        $net_s_qty = $pre_s_qty[0]['schedule_qty'] + $postData['schedule_qty'][$key] - $postData['pre_schedule_qty'][$key];
                        if ($net_s_qty == $pre_s_qty[0]['quantity']) {
                            $this->m_common->update_row('tbl_delivery_order_details', array('do_id' => $postData['do_id'][$key], 's_item_id' => $each), array('schedule_status' => "Scheduled", 'schedule_qty' => $net_s_qty));
                        } else {
                            $this->m_common->update_row('tbl_delivery_order_details', array('do_id' => $postData['do_id'][$key], 's_item_id' => $each), array('schedule_status' => "Partial Scheduled", 'schedule_qty' => $net_s_qty));
                        }
                    }
                }

                redirect_with_msg('productions', 'Successfully Updated');
            }
        } else {
            redirect_with_msg('productions', 'Please fill the form and submit');
        }
    }

    function details_delivery_order($id, $print = false) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'delivery_orders';
        $this->titlebackend("Delivery Order Information");
        $sql = "select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and (so.delivery_order_status='Approved' or so.delivery_order_status='Generated Delivery Order') and so.unit_id=" . $branch_id;
        $data['sale_orders'] = $this->m_common->customeQuery($sql);
        //$data['delivery_order_info']=$this->m_common->get_row_array('tbl_delivery_orders',array('do_id'=>$id),'*');
        //  $dc_sql="select do.*,c.c_name,c.c_contact_person,c.c_mobile_no,c.c_contact_address,so.order_no,so.sale_order_date from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where do.do_id=".$id;
        $dc_sql = "select do.*,c.c_name,c.c_contact_person,c.c_mobile_no,c.c_contact_address,so.order_no,so.sale_order_date,tp.project_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_project tp on so.project_id=tp.project_id where do.do_id=" . $id;
        $data['delivery_order_info'] = $this->m_common->customeQuery($dc_sql);
        // $sql="select d.*,item.s_item_name from tbl_delivery_order_details d left join tbl_sales_items item on d.s_item_id=item.s_item_id where d.is_active=1";
        $sql = "select d.*,sd.remark,sp.product_name,sp.performance,sp.measurement_unit from tbl_delivery_order_details d left join tbl_sales_order_details sd on sd.o_details_id=d.o_details_id left join tbl_sales_products sp on d.s_item_id=sp.product_id where d.is_active=1 and do_id=" . $id;
        $data['delivery_order_details_info'] = $this->m_common->customeQuery($sql);


        $sql = "select d.*,sp.product_name,sp.measurement_unit from tbl_sales_order_details d left join tbl_sales_products sp on d.product_id=sp.product_id where d.is_active=1 and d.o_id=" . $data['delivery_order_info'][0]['o_id'];
        $data['sales_order_details_info'] = $this->m_common->customeQuery($sql);


        $data['payment_mode'] = $this->m_common->get_row_array('tbl_sales_order_payment_condition', array('o_id' => $data['delivery_order_info'][0]['o_id']), '*');

        $all_collection_sql = 'select * from tbl_payment_collections where payment_status="Received" and o_id=' . $data['delivery_order_info'][0]['o_id'];
        $data['all_collections'] = $this->m_common->customeQuery($all_collection_sql);

        $cash_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Cash" and payment_status="Received" and o_id=' . $data['delivery_order_info'][0]['o_id'];
        $data['paid_cash_amount'] = $this->m_common->customeQuery($cash_sql);
        $data['total_cash_amount'] = $data['payment_mode'][0]['b_cash_amount'] + $data['payment_mode'][0]['a_cash_amount'];
        $data['due_cash_amount'] = $data['total_cash_amount'] - $data['paid_cash_amount'][0]['total'];

        $pdc_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Pdc" and payment_status="Received" and o_id=' . $data['delivery_order_info'][0]['o_id'];
        $data['paid_pdc_amount'] = $this->m_common->customeQuery($pdc_sql);
        $data['total_pdc_amount'] = $data['payment_mode'][0]['b_pdc_amount'] + $data['payment_mode'][0]['a_pdc_amount'];
        $data['due_pdc_amount'] = $data['total_pdc_amount'] - $data['paid_pdc_amount'][0]['total'];


        $lc_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Lc" and payment_status="Received" and o_id=' . $data['delivery_order_info'][0]['o_id'];
        $data['paid_lc_amount'] = $this->m_common->customeQuery($lc_sql);
        $data['total_lc_amount'] = $data['payment_mode'][0]['b_lc_amount'] + $data['payment_mode'][0]['a_lc_amount'];
        $data['due_lc_amount'] = $data['total_lc_amount'] - $data['paid_lc_amount'][0]['total'];

        $bg_sql = 'select sum(amount) as total from tbl_payment_collections where collection_method="Bg" and payment_status="Received" and o_id=' . $data['delivery_order_info'][0]['o_id'];
        $data['paid_bg_amount'] = $this->m_common->customeQuery($bg_sql);
        $data['total_bg_amount'] = $data['payment_mode'][0]['b_bg_amount'] + $data['payment_mode'][0]['a_bg_amount'];
        $data['due_bg_amount'] = $data['total_bg_amount'] - $data['paid_bg_amount'][0]['total'];


        $data['total_amount'] = $data['total_cash_amount'] + $data['total_pdc_amount'] + $data['total_lc_amount'] + $data['total_bg_amount'];
        $data['total_paid'] = $data['paid_cash_amount'][0]['total'] + $data['paid_pdc_amount'][0]['total'] + $data['paid_lc_amount'][0]['total'] + $data['paid_bg_amount'][0]['total'];
        $data['total_due'] = $data['total_amount'] - $data['total_paid'];

        $cl_sql = 'select sum(amount) as total from tbl_payment_collections where payment_status="Collected" and o_id=' . $data['delivery_order_info'][0]['o_id'];
        $cl_amount = $this->m_common->customeQuery($cl_sql);
        if ($print == false) {
            $this->load->view('productions/v_details_delivery_order', $data);
        } else {
            $html = $this->load->view('productions/print_delivery_order', $data, true);
            echo $html;
            exit;
        }
    }

    function details_production_schedule($id, $print = false) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'production_schedule';
        $this->titlebackend("Production Schedule Information");
        $data['schedule_info'] = $this->m_common->get_row_array('tbl_production_schedule', array('id' => $id), '*');
        $sql = "select d.*,do.delivery_no,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_production_schedule_details d left join tbl_delivery_orders do on d.do_id=do.do_id left join tbl_sales_products sp on d.product_id=sp.product_id left join tbl_sales_orders so on do.o_id=so.o_id left join  tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on so.customer_id=c.id where d.is_active=1 and d.schedule_id=" . $id;
        $data['sd_details'] = $this->m_common->customeQuery($sql);
        $this->load->view('productions/v_details_production_schedule', $data);
    }

    function delete_production_schedule($id) {
        if (!empty($id)) {
            // $o_id=$this->m_common->get_row_array('tbl_production_schedule',array('id' => $id),'*');
            $id = $this->m_common->update_row('tbl_production_schedule', array('id' => $id), array('is_active' => 0));
            if (!empty($id)) {
                $schedule_qty = $this->m_common->get_row_array('tbl_production_schedule_details', array('schedule_id' => $id), '*');
                $this->m_common->update_row('tbl_production_schedule_details', array('schedule_id' => $id), array('is_active' => 0));
                foreach ($schedule_qty as $row) {
                    $sql = "update tbl_delivery_order_details set schedule_qty = schedule_qty-" . $row['schedule_qty'] . ' where do_details_id=' . $row['do_details_id'];
                    $this->m_common->customeUpdate($sql);
                }
                redirect_with_msg('productions/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('productions/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('productions/index', 'Please click on delete button');
        }
    }

    function production_statement() {
        $branch_id = $this->session->userdata('companyId');
        // $user_category =$this->session->userdata('user_category');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'production_statement';
        $this->titlebackend("Production Statement");
        $sql = "select s.*,tps.schedule_no,(select GROUP_CONCAT(DISTINCT delivery_no SEPARATOR ', ') from tbl_delivery_orders d join tbl_production_statement_details pd on d.do_id=pd.do_id where pd.pst_id=s.pst_id) as delivery_no,(select project_name from tbl_delivery_orders d join tbl_production_statement_details pd on d.do_id=pd.do_id where pd.pst_id=s.pst_id LIMIT 1) as project_name,(select c_name from tbl_delivery_orders d join tbl_production_statement_details pd on d.do_id=pd.do_id JOIN tbl_sales_orders tso on tso.o_id=d.o_id JOIN tbl_customers tc on tc.id=tso.customer_id where pd.pst_id=s.pst_id LIMIT 1) as c_name from tbl_production_statement s join tbl_production_schedule tps on s.schedule_id=tps.id WHERE s.date>='2022-01-01' and s.unit_id=$branch_id and s.is_active=1 ORDER BY s.pst_id DESC";
        
        $data['production_statements'] = $this->m_common->customeQuery($sql);
        //echo '<pre>';print_r($data['production_statements']);
        // $data['production_statements']=$this->m_common->get_row_array('tbl_production_statement',array('unit_id'=>$branch_id,'is_active'=>1),'*','','','pst_id','DESC');
        $this->load->view('productions/v_production_statement', $data);
    }

    function add_production_statement() {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'production_statement';
        $this->titlebackend("Quotation Information");
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        $schedule_last_code = $this->m_common->get_row_array('tbl_production_statement_code', array('branch_id' => $branch_id), '*', '', 1, 'id', 'DESC');
        if (!empty($schedule_last_code)) {
            $schedule_code = $schedule_last_code[0]['production_code'] + 1;
            if ($budget_code > 999) {
                $schedule_sl_no = $schedule_code;
            } else if ($budget_code > 99) {
                $schedule_sl_no = "0" . $schedule_code;
            } else if ($budget_code > 9) {
                $schedule_sl_no = "00" . $schedule_code;
            } else {
                $schedule_sl_no = "000" . $schedule_code;
            }
        } else {
            $schedule_code = 1;
            $schedule_sl_no = '0001';
        }


        $data['production_code'] = $schedule_code;
        $data['production_auto_code'] = $schedule_sl_no;
        //  $sql="select dod.*,do.delivery_no,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_delivery_order_details dod left join tbl_sales_products sp on dod.s_item_id=sp.product_id left join tbl_delivery_orders do on dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join  tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 ";
        $sql = "select s.id,s.schedule_no,s.date from tbl_production_schedule_details sd join tbl_production_schedule s on sd.schedule_id=s.id 
where (sd.production_status='Pending' or sd.production_status='Partial Done') and sd.mixing_status='Mixed' and s.is_active=1 and sd.branch_id=".$branch_id." GROUP BY s.id";
        $data['production_schedules'] = $this->m_common->customeQuery($sql);
        //$data['production_schedules']=$this->m_common->get_row_array('tbl_production_schedule',array('unit_id'=>$branch_id,'is_active'=>1),'*');
        $this->load->view('productions/v_add_production_statement', $data);
    }

    function get_schedule_products() {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('schedule_id');
        //  $sql = "select psd.*,dod.delivery_quantity,do.delivery_no,qd.mu_name,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_production_schedule_details psd left join tbl_delivery_order_details dod on dod.do_id=psd.do_id left join tbl_sales_products sp on psd.product_id=sp.product_id left join tbl_delivery_orders do on psd.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join  tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_sales_quotation_details qd on so.q_id=qd.q_id left join  tbl_customers c on so.customer_id=c.id where (psd.production_status='Pending' or psd.production_status='Partial Done') and psd.is_active=1 and psd.schedule_id=" . $id; //shaheen
        $sql = "select psd.*,dod.delivery_quantity,do.delivery_no,qd.mu_name,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_production_schedule_details psd left join tbl_delivery_order_details dod on dod.do_details_id=psd.do_details_id left join tbl_sales_products sp on psd.product_id=sp.product_id left join tbl_delivery_orders do on psd.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join  tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_sales_quotation_details qd on so.q_id=qd.q_id left join  tbl_customers c on so.customer_id=c.id where (psd.production_status='Pending' or psd.production_status='Partial Done') and psd.is_active=1 and psd.schedule_id=" . $id; //added by alauddin
        $data['product_list'] = $this->m_common->customeQuery($sql);
//        foreach($data['product_list'] as $key=>$value){
//        $p_sql="select sum(production_qty) as total_production_qty from tbl_production_statement_details  where product_id=".$value['product_id']." and do_id=".$value['do_id'];
//            $p_statement=$this->m_common->customeQuery($p_sql);
//            if(!empty($p_statement)){
//                $data['product_list'][$key]['production_qty']=$p_statement[0]['total_production_qty'];
//            }else{
//                $data['product_list'][$key]['production_qty']='';
//            }
//        }

        echo json_encode($data);
    }

    function add_production_statement_action() {
        $branch_id = $this->session->userdata('companyId');
        $postData = $this->input->post();
        if (!empty($postData)) {

            $insertData = array();
            if (!empty($postData['date'])) {
                $insertData['date'] = date('Y-m-d', strtotime($postData['date']));
            }

            if(!empty($postData['production_no'])){
                $insertData['production_no'] = $postData['production_no'];
                $pre_production_info=$this->m_common->get_row_array('tbl_production_statement',array('production_no' =>$postData['production_no'],'unit_id'=>$branch_id,'is_active'=>1),'*');
                if(!empty($pre_production_info)){
                    redirect_with_msg('productions/add_production_statement', 'This production already exists');
                }
            }

            if (!empty($postData['schedule_id'])) {
                $insertData['schedule_id'] = $postData['schedule_id'];
            }

            if (empty($postData['select_item'])) {
                redirect_with_msg('productions/add_production_statement_action', 'Plese Select Item');
            }

            $insertData['unit_id'] = $branch_id;
            $insertData['is_active'] = 1;
            $insertData['status'] = 'Pending';
            $insertData['created_date'] = date('Y-m-d');
            $result = $this->m_common->insert_row('tbl_production_statement', $insertData);
            if (!empty($result)) {
                $this->m_common->insert_row('tbl_production_statement_code', array('production_code' => $postData['production_code'], 'branch_id' => $branch_id));
                //  $this->m_common->update_row('tbl_sales_orders', array('o_id' =>$o_id),array('status'=>"Generated Delivery Order"));

                foreach ($postData['product_id'] as $key => $each) {
                    if (in_array($key, $postData['select_item'])) {
                        $insertData1 = array();
                        $insertData1['pst_id'] = $result;
                        $insertData1['product_id'] = $each;
                        $insertData1['is_active'] = 1;
                        $insertData1['status'] = "Pending";
                        if (empty($each)) {
                            continue;
                        }
                        if (!empty($postData['psd_id'][$key])) {
                            $insertData1['psd_id'] = $postData['psd_id'][$key];
                        }

                        if (!empty($postData['do_id'][$key])) {
                            $insertData1['do_id'] = $postData['do_id'][$key];
                        }

                        if (!empty($postData['production_qty'][$key])) {
                            $insertData1['production_qty'] = $postData['production_qty'][$key];
                        }

                        if (!empty($postData['schedule_qty'][$key])) {
                            $insertData1['schedule_qty'] = $postData['schedule_qty'][$key];
                        }

                        $success = $this->m_common->insert_row('tbl_production_statement_details', $insertData1);
                        if (!empty($success)) {
                            $sd_info = $this->m_common->get_row_array('tbl_production_schedule_details', array('id' => $postData['psd_id'][$key]), '*');
                            $net_p_qty = $sd_info[0]['production_qty'] + $postData['production_qty'][$key];
                            if ($net_p_qty == $sd_info[0]['schedule_qty']) {
                                $this->m_common->update_row('tbl_production_schedule_details', array('id' => $postData['psd_id'][$key]), array('production_qty' => $net_p_qty, 'production_status' => 'Done'));
                            } else {
                                $this->m_common->update_row('tbl_production_schedule_details', array('id' => $postData['psd_id'][$key]), array('production_qty' => $net_p_qty, 'production_status' => 'Partial Done'));
                            }
                        }
                    }
                }
                $sql = "select s.id,s.schedule_no from tbl_production_schedule_details sd join tbl_production_schedule s on sd.schedule_id=s.id 
where (sd.production_status='Pending' or sd.production_status='Partial Done') and sd.schedule_id=" . $postData['schedule_id'] . "";
                $exists = $this->m_common->customeQuery($sql);
                if (empty($exists)) {
                    $this->m_common->update_row('tbl_production_schedule', array('id' => $postData['schedule_id']), array('status' => 'Done'));
                } else {
                    $this->m_common->update_row('tbl_production_schedule', array('id' => $postData['schedule_id']), array('status' => 'Partial Done'));
                }
            }
            redirect_with_msg('productions/production_statement', 'Successfully Inserted');
        } else {
            redirect_with_msg('productions/add_delivery_order', 'Please fill the form and submit');
        }
    }

    function edit_production_statement($id) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'production_statement';
        $this->titlebackend("Production Schedule Information");
        $data['production_statement_info'] = $this->m_common->get_row_array('tbl_production_statement', array('pst_id' => $id), '*');
        $sql = "select d.*,do.delivery_no,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_production_statement_details d left join tbl_delivery_orders do on d.do_id=do.do_id left join tbl_sales_products sp on d.product_id=sp.product_id left join tbl_sales_orders so on do.o_id=so.o_id left join  tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on so.customer_id=c.id where d.is_active=1 and d.pst_id=" . $id;
        $data['production_details'] = $this->m_common->customeQuery($sql);
        $data['production_schedules'] = $this->m_common->get_row_array('tbl_production_schedule', array('unit_id' => $branch_id, 'is_active' => 1, 'id' => $data['production_statement_info'][0]['schedule_id']), '*');
        $this->load->view('productions/v_edit_production_statement', $data);
    }

    function edit_production_statement_action($id) {
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            $insertData = array();
            if (!empty($postData['date'])) {
                $insertData['date'] = date('Y-m-d', strtotime($postData['date']));
            }

            if (!empty($postData['production_no'])) {
                $insertData['production_no'] = $postData['production_no'];
            }

            if (!empty($postData['schedule_id'])) {
                $insertData['schedule_id'] = $postData['schedule_id'];
            }


            $result = $this->m_common->update_row('tbl_production_statement', array('pst_id' => $id), $insertData);
            if ($result >= 0) {
                $this->m_common->delete_row('tbl_production_statement_details', array('pst_id' => $id));
                foreach ($postData['product_id'] as $key => $each) {

                    $insertData1 = array();
                    $insertData1['pst_id'] = $id;
                    $insertData1['product_id'] = $each;
                    $insertData1['is_active'] = 1;
                    $insertData1['status'] = "Pending";
                    if (empty($each)) {
                        continue;
                    }
                    if (!empty($postData['psd_id'][$key])) {
                        $insertData1['psd_id'] = $postData['psd_id'][$key];
                    }

                    if (!empty($postData['do_id'][$key])) {
                        $insertData1['do_id'] = $postData['do_id'][$key];
                    }

                    if (!empty($postData['production_qty'][$key])) {
                        $insertData1['production_qty'] = $postData['production_qty'][$key];
                    }

                    if (!empty($postData['schedule_qty'][$key])) {
                        $insertData1['schedule_qty'] = $postData['schedule_qty'][$key];
                    }

                    $success = $this->m_common->insert_row('tbl_production_statement_details', $insertData1);
                    if (!empty($success)) {
                        $sd_info = $this->m_common->get_row_array('tbl_production_schedule_details', array('id' => $postData['psd_id'][$key]), '*');
                        $net_p_qty = $sd_info[0]['production_qty'] + $postData['production_qty'][$key] - $postData['p_production_qty'][$key];
                        if ($net_p_qty == $sd_info[0]['schedule_qty']) {
                            $this->m_common->update_row('tbl_production_schedule_details', array('id' => $postData['psd_id'][$key]), array('production_qty' => $net_p_qty, 'production_status' => 'Done'));
                        } else {
                            $this->m_common->update_row('tbl_production_schedule_details', array('id' => $postData['psd_id'][$key]), array('production_qty' => $net_p_qty, 'production_status' => 'Partial Done'));
                        }
                    }
                }


                redirect_with_msg('productions/production_statement', 'Successfully Updated');
            }
        } else {
            redirect_with_msg('productions/production_statement', 'Please fill the form first');
        }
    }

    function details_production_statement($id, $print = '') {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'production_statement';
        $this->titlebackend("Production Schedule Information");
        $data['production_statement_info'] = $this->m_common->get_row_array('tbl_production_statement', array('pst_id' => $id), '*');
        $sql = "select d.*,do.delivery_no,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_production_statement_details d left join tbl_delivery_orders do on d.do_id=do.do_id left join tbl_sales_products sp on d.product_id=sp.product_id left join tbl_sales_orders so on do.o_id=so.o_id left join  tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on so.customer_id=c.id where d.is_active=1 and d.pst_id=" . $id;
        $data['production_details'] = $this->m_common->customeQuery($sql);
        $data['production_schedules'] = $this->m_common->get_row_array('tbl_production_schedule', array('unit_id' => $branch_id, 'is_active' => 1, 'id' => $data['production_statement_info'][0]['schedule_id']), '*');
        $this->load->view('productions/v_details_production_statement', $data);
    }

    function delete_production_statement($id) {
        if (!empty($id)) {
            // $o_id=$this->m_common->get_row_array('tbl_production_schedule',array('id' => $id),'*');
            $id = $this->m_common->update_row('tbl_production_statement', array('pst_id' => $id), array('is_active' => 0));
            if (!empty($id)) {
                $this->m_common->update_row('tbl_production_statement_details', array('pst_id' => $id), array('is_active' => 0));
                redirect_with_msg('productions/production_statement', 'Successfully Deleted');
            } else {
                redirect_with_msg('productions/production_statement', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('productions/production_statement', 'Please click on delete button');
        }
    }

    function get_sales_order_item() {
        $branch_id = $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $o_id = $this->input->post('o_id');
        // $data['sales_order_info']=$this->m_common->get_row_array('tbl_sales_orders',array('o_id'=>$o_id),'*');
        $order_sql = 'select so.*,c.c_short_name,c.id from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where so.o_id=' . $o_id;
        $data['sales_order_info'] = $this->m_common->customeQuery($order_sql);
        //  $sql="select d.*,i.s_item_name from tbl_sales_order_details d left join tbl_sales_items i on d.s_item_id=i.s_item_id where d.is_active=1 and d.o_id=".$o_id;
        $sql = "select d.*,i.product_name,i.measurement_unit from tbl_sales_order_details d left join tbl_sales_products i on d.product_id=i.product_id where d.is_active=1 and d.o_id=" . $o_id;
        $data['item_list'] = $this->m_common->customeQuery($sql);
        //$data['order_code']=$this->m_common->get_row_array('tbl_delivery_orders_code',array('customer_id'=>$data['sales_order_info'][0]['id']),'*','',1,'id','DESC');
        $data['order_code'] = $this->m_common->get_row_array('tbl_delivery_orders_code', array('customer_id' => $data['sales_order_info'][0]['id'], 'unit_id' => $branch_id), '*', '', 1, 'id', 'DESC');
        echo json_encode($data);
    }

    function addExtra() {
        $branch_id = $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $exists = $this->m_common->get_row_array('tbl_production_schedule_details', array('id' => $id), 'schedule_id');
        $sql = "update tbl_production_schedule set status='Partial Done' where id=" . $exists[0]['schedule_id'];
        $this->m_common->customeUpdate($sql);
        $sql = "update tbl_production_schedule_details set extra_qty = extra_qty+$qty,production_status='Partial Done', mixing_status='Pending',schedule_qty = schedule_qty+$qty where id=" . $id;
        $this->m_common->customeUpdate($sql);

        echo 'success';
    }

}
