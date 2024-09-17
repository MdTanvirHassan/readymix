<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Deposit_realization extends Site_Controller {

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
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'deposit_realization';
        $this->titlebackend("Deposit Realization");
        // $sql="select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id where dr.is_active=1";
        // $sql="select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id where dr.is_active=1 and dr.realization_status='Deposited' and dr.unit_id=".$branch_id;
        $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on tso.customer_id=tc.id where dr.is_active=1 and dr.realization_status='Deposited' and dr.unit_id=" . $branch_id;
        $data['deposits'] = $this->m_common->customeQuery($sql);
        $this->load->view('deposit_realization/v_deposit_realization', $data);
    }

    function add_deposit() {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'deposit_realization';
        $this->titlebackend("Deposit");
        $data['banks'] = $this->m_common->get_row_array('tbl_banks', array('is_active' => 1), '*');
        //  $data['collections']=$this->m_common->get_row_array('tbl_payment_collections',array('is_active'=>1,'payment_status'=>"Pending",'collection_method !='=>"Cash"),'*'); 
        //  $data['collections']=$this->m_common->get_row_array('tbl_payment_collections',array('is_active'=>1,'payment_status'=>"Collected",'collection_method !='=>"Cash",'unit_id'=>$branch_id),'*'); 
        $sql = "select tpc.*,tc.c_name,c_short_name from tbl_payment_collections tpc left join tbl_sales_orders tso on tpc.o_id=tso.o_id left join tbl_customers tc on tso.customer_id=tc.id where tpc.is_active=1 and tpc.collection_method!='Cash' and tpc.payment_status='Collected' and tpc.unit_id=" . $branch_id;
        $data['collections'] = $this->m_common->customeQuery($sql);
        $this->load->view('deposit_realization/v_add_deposit', $data);
    }

    function add_deposit_action() {
        $branch_id = $this->session->userdata('companyId');
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            if (!empty($postData['collection_id'])) {
                $insertData['collection_id'] = $postData['collection_id'];
                $pre_deposit = $this->m_common->get_row_array('tbl_deposit_realization', array('collection_id' => $postData['collection_id'], 'realization_status' => "Pending", 'is_active' => 1), '*');
                if (!empty($pre_deposit)) {
                    redirect_with_msg('deposit_realization/add_deposit', 'This collection already exists');
                } else {
                    $pre_deposit_info = $this->m_common->get_row_array('tbl_deposit_realization', array('collection_id' => $postData['collection_id'], 'realization_status' => "Dishonored", 'is_active' => 1), '*');
                    if (count($pre_deposit_info) == 3) {
                        redirect_with_msg('deposit_realization/add_deposit', 'You are not able to deposit more than three times');
                    }
                }
            }
            if (!empty($postData['deposit_date'])) {
                $insertData['deposit_date'] = date('Y-m-d', strtotime($postData['deposit_date']));
            }

            if (!empty($postData['remark'])) {
                $insertData['remark'] = $postData['remark'];
            }
            if (!empty($postData['bank_id'])) {
                $insertData['bank_id'] = $postData['bank_id'];
            }
            $insertData['unit_id'] = $branch_id;
            $insertData['is_active'] = 1;
            // $insertData['realization_status']='Pending';
            $insertData['realization_status'] = 'Deposited';
            $result = $this->m_common->insert_row('tbl_deposit_realization', $insertData);
            if (!empty($result)) {
                redirect_with_msg('deposit_realization', 'Successfully Inserted');
            }
        } else {
            redirect_with_msg('deposit_realization/add_deposit', 'Please fill the form and submit');
        }
    }

    function edit_deposit($id) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'deposit_realization';
        $this->titlebackend("Deposit");
        $data['banks'] = $this->m_common->get_row_array('tbl_banks', array('is_active' => 1), '*');
        $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id where dr.is_active=1 and dr.id=" . $id;
        $data['deposit_info'] = $this->m_common->customeQuery($sql);
        // $data['collections']=$this->m_common->get_row_array('tbl_payment_collections',array('is_active'=>1,'unit_id'=>$branch_id),'*');
        $sql1 = "select tpc.*,tc.c_name,c_short_name from tbl_payment_collections tpc left join tbl_sales_orders tso on tpc.o_id=tso.o_id left join tbl_customers tc on tso.customer_id=tc.id where tpc.is_active=1 and tpc.collection_method!='Cash' and tpc.payment_status='Collected' and tpc.unit_id=" . $branch_id;
        $data['collections'] = $this->m_common->customeQuery($sql1);
        $this->load->view('deposit_realization/v_edit_deposit', $data);
    }

    function edit_deposit_action($id) {
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            if (!empty($postData['collection_id'])) {
                $insertData['collection_id'] = $postData['collection_id'];
            }
            if (!empty($postData['deposit_date'])) {
                $insertData['deposit_date'] = date('Y-m-d', strtotime($postData['deposit_date']));
            }

            if (!empty($postData['remark'])) {
                $insertData['remark'] = $postData['remark'];
            }
            if (!empty($postData['bank_id'])) {
                $insertData['bank_id'] = $postData['bank_id'];
            }
            $result = $this->m_common->update_row('tbl_deposit_realization', array('id' => $id), $insertData);
            if ($result >= 0) {
                redirect_with_msg('deposit_realization', 'Successfully Updated');
            }
        } else {
            redirect_with_msg('deposit_realization/edit_deposit/' . $id, 'Please fill the form and submit');
        }
    }

    function delete_deposit($id) {
        if (!empty($id)) {
            $id = $this->m_common->update_row('tbl_deposit_realization', array('id' => $id), array('is_active' => 0));
            if (!empty($id)) {
                redirect_with_msg('deposit_realization/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('deposit_realization/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('deposit_realization/index', 'Please click on delete button');
        }
    }

    function get_collection_info() {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');
        $sql = "select pc.*,b.b_name,b.branch_name,b.b_short_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id where pc.id=" . $id;
        $data['collection_info'] = $this->m_common->customeQuery($sql);
        if ($data['collection_info'][0]['collection_method'] == "Pdc") {
            $data['collection_info'][0]['check_date'] = date('d-m-Y', strtotime($data['collection_info'][0]['check_date']));
        } else if ($data['collection_info'][0]['collection_method'] == "Po") {
            $data['collection_info'][0]['po_date'] = date('d-m-Y', strtotime($data['collection_info'][0]['po_date']));
        } else if ($data['collection_info'][0]['collection_method'] == "Bg") {
            $data['collection_info'][0]['bg_expire_date'] = date('d-m-Y', strtotime($data['collection_info'][0]['bg_expire_date']));
        } else if ($data['collection_info'][0]['collection_method'] == "Lc") {
            $data['collection_info'][0]['lc_date'] = date('d-m-Y', strtotime($data['collection_info'][0]['lc_date']));
        }
        echo json_encode($data);
    }

    function realization() {
        $this->setOutputMode(NORMAL);
        $honor_status = $this->input->post('honor_status');
        $deposit_id = $this->input->post('deposit_id');
        $realization_date = $this->input->post('realization_date');
        if ($honor_status == 'honor') {
            $result = $this->m_common->update_row('tbl_deposit_realization', array('id' => $deposit_id), array('realization_status' => "Honored", 'realization_date' => date('Y-m-d', strtotime($realization_date))));
            if ($result >= 0) {
                $deposit_info = $this->m_common->get_row_array('tbl_deposit_realization', array('id' => $deposit_id), '*');
                $collection_info = $this->m_common->get_row_array('tbl_payment_collections', array('id' => $deposit_info[0]['collection_id']), '*');
                $order_info = $this->m_common->get_row_array('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), '*');
                $payment_condition = $this->m_common->get_row_array('tbl_sales_order_payment_condition', array('o_id' => $collection_info[0]['o_id']), '*');
                $sql = "select si.* from tbl_sales_invoices si 
JOIN tbl_delivery_orders doo on si.do_id=doo.do_id 
JOIN tbl_sales_orders so on so.o_id=doo.o_id
JOIN tbl_payment_collections pc on pc.o_id=so.o_id
where pc.o_id=" . $collection_info[0]['o_id'];
                $invs = $this->m_common->customeQuery($sql);
                $res = $this->m_common->update_row('tbl_payment_collections', array('id' => $deposit_info[0]['collection_id']), array('payment_status' => "Received"));
                if ($res > 0) {
                    //     if(!empty($collection_info[0]['invoice_id'])){
                    foreach ($invs as $inv) {
//                                    $net_receive_amount=$order_info[0]['receive_amount']+$collection_info[0]['amount'];
//                                    $this->m_common->update_row('tbl_sales_orders',array('o_id'=>$collection_info[0]['o_id']),array('receive_amount'=>$net_receive_amount));
//                               
                        $invoice_info = $this->m_common->get_row_array('tbl_sales_invoices', array('inv_id' => $inv['inv_id']), '*');
                        $sql = "select * from tbl_sales_invoice_details where (received_status='Pending' or received_status='Partial Received') and inv_id=" . $inv['inv_id'];
                        $invoice_details_info = $this->m_common->customeQuery($sql);
                        $collection_amount = $collection_info[0]['amount'];
                        foreach ($invoice_details_info as $key => $inv_detail) {
                            if ($collection_amount <= 0) {
                                break;
                            }
                            $r_amount = $inv_detail['amount'] - $inv_detail['received_amount'];
                            if ($r_amount < $collection_amount) {
                                $r_amount = $collection_amount;
                            }
                            $net_r_amount = $inv_detail['received_amount'] + $r_amount;
                            if ($net_r_amount == $inv_detail['amount']) {
                                $r_status = "Received";
                            } else {
                                $r_status = "Partial Received";
                            }
                            // $this->m_common->update_row('tbl_sales_invoice_details',array('inv_id'=>$collection_info[0]['invoice_id'],'s_item_id'=>$inv_detail['s_item_id']),array('received_amount'=>$net_r_amount,'received_status'=>$r_status));
                            $this->m_common->update_row('tbl_sales_invoice_details', array('inv_details_id' => $inv_detail['inv_details_id']), array('received_amount' => $net_r_amount, 'received_status' => $r_status));
                            $collection_amount = $collection_amount - $r_amount;
                        }
                        $receive_amount = $collection_info[0]['amount'] + $invoice_info[0]['received_amount'];
                        if ($receive_amount >= $invoice_info[0]['total_amount']) {
                            $status = 'Received';
                        } else {
                            $status = 'Partial Received';
                        }
                        $this->m_common->update_row('tbl_sales_invoices', array('inv_id' => $inv['inv_id']), array('received_amount' => $receive_amount, 'status' => $status));
                    }
//                           }else{
//                               $net_advance_received=$order_info[0]['advance_received']+$collection_info[0]['amount'];
//                               $net_receive_amount=$order_info[0]['receive_amount']+$collection_info[0]['amount'];
//                               $this->m_common->update_row('tbl_sales_orders',array('o_id'=>$collection_info[0]['o_id']),array('receive_amount'=>$net_receive_amount,'advance_received'=>$net_advance_received));
//                           }

                    $net_advance_received = $order_info[0]['advance_received'] + $collection_info[0]['amount'];
                    $net_receive_amount = $order_info[0]['receive_amount'] + $collection_info[0]['amount'];
                    $this->m_common->update_row('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), array('receive_amount' => $net_receive_amount, 'advance_received' => $net_advance_received));


                    //$this->m_common->update_row('tbl_sales_orders',array('o_id'=>$collection_info[0]['o_id']),array('status'=>$approve))     
                    $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                    $total_collection = $this->m_common->customeQuery($sql);

                    if($total_collection[0]['total']>=$order_info[0]['total_amount']){
                        $this->m_common->update_row('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), array('receive_status' => "Received"));
                    } else {
                        $this->m_common->update_row('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), array('receive_status' => "Partial Received"));
                    }
                }


                $data['status'] = 'success';
            }
        } else {
            $result = $this->m_common->update_row('tbl_deposit_realization', array('id' => $deposit_id), array('realization_status' => "Dishonored", 'realization_date' => date('Y-m-d', strtotime($realization_date))));
            if ($result >= 0) {
                $data['status'] = 'success';
            }
        }
        echo json_encode($data);
    }

    function realization_05_08_2019() {
        $this->setOutputMode(NORMAL);
        $honor_status = $this->input->post('honor_status');
        $deposit_id = $this->input->post('deposit_id');
        $realization_date = $this->input->post('realization_date');
        if ($honor_status == 'honor') {
            $result = $this->m_common->update_row('tbl_deposit_realization', array('id' => $deposit_id), array('realization_status' => "Honored", 'realization_date' => date('Y-m-d', strtotime($realization_date))));
            if ($result >= 0) {
                $deposit_info = $this->m_common->get_row_array('tbl_deposit_realization', array('id' => $deposit_id), '*');
                $collection_info = $this->m_common->get_row_array('tbl_payment_collections', array('id' => $deposit_info[0]['collection_id']), '*');
                $order_info = $this->m_common->get_row_array('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), '*');
                $payment_condition = $this->m_common->get_row_array('tbl_sales_order_payment_condition', array('o_id' => $collection_info[0]['o_id']), '*');

                $this->m_common->update_row('tbl_payment_collections', array('id' => $deposit_info[0]['collection_id']), array('payment_status' => "Received"));

                $approve = 'Approved';
                if ($payment_condition[0]['b_cash'] == "Cash") {
                    $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Cash' and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                    $total_cash_collection = $this->m_common->customeQuery($sql);
                    if ($total_cash_collection[0]['total'] >= $payment_condition[0]['b_cash_amount']) {
                        
                    } else {
                        $approve = 'Pending';
                    }
                }

                if ($payment_condition[0]['b_bg'] == "Bg") {
                    $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Bg' and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                    $total_bg_collection = $this->m_common->customeQuery($sql);
                    if ($total_bg_collection[0]['total'] >= $payment_condition[0]['b_bg_amount']) {
                        
                    } else {
                        $approve = 'Pending';
                    }
                }

                if ($payment_condition[0]['b_pdc'] == "Pdc") {
                    if ($payment_condition[0]['b_pdc_condition'] == "Collection") {
                        $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Pdc' and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                    } else {
                        $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Pdc' and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                    }
                    $total_pdc_collection = $this->m_common->customeQuery($sql);
                    if ($total_pdc_collection[0]['total'] >= $payment_condition[0]['b_pdc_amount']) {
                        
                    } else {
                        $approve = 'Pending';
                    }
                }

                if ($payment_condition[0]['b_lc'] == "Lc") {
                    if ($payment_condition[0]['b_lc_condition'] == "Collection") {
                        $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and collection_method='Lc' and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                    } else {
                        $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and collection_method='Lc' and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                    }
                    $total_lc_collection = $this->m_common->customeQuery($sql);
                    if ($total_lc_collection[0]['total'] >= $payment_condition[0]['b_lc_amount']) {
                        
                    } else {
                        $approve = 'Pending';
                    }
                }

                $this->m_common->update_row('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), array('status' => $approve));

                $sql = "select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                $total_collection = $this->m_common->customeQuery($sql);

                if ($total_collection[0]['total'] == $order_info[0]['total_amount']) {
                    $this->m_common->update_row('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), array('receive_status' => "Received"));
                } else {
                    $this->m_common->update_row('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), array('receive_status' => "Partial Received"));
                }

                $data['status'] = 'success';
            }
        } else {
            $result = $this->m_common->update_row('tbl_deposit_realization', array('id' => $deposit_id), array('realization_status' => "Dishonored", 'realization_date' => date('Y-m-d', strtotime($realization_date))));
            if ($result >= 0) {
                $data['status'] = 'success';
            }
        }
        echo json_encode($data);
    }

    function realization_pre() {
        $this->setOutputMode(NORMAL);
        $honor_status = $this->input->post('honor_status');
        $deposit_id = $this->input->post('deposit_id');
        $realization_date = $this->input->post('realization_date');
        if ($honor_status == 'honor') {
            $result = $this->m_common->update_row('tbl_deposit_realization', array('id' => $deposit_id), array('realization_status' => "Honored", 'realization_date' => date('Y-m-d', strtotime($realization_date))));
            if ($result >= 0) {
                $deposit_info = $this->m_common->get_row_array('tbl_deposit_realization', array('id' => $deposit_id), '*');
                $collection_info = $this->m_common->get_row_array('tbl_payment_collections', array('id' => $deposit_info[0]['collection_id']), '*');
                $order_info = $this->m_common->get_row_array('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), '*');
                $sales_payment_condition = $this->m_common->get_row_array('tbl_sales_order_payment_condition', array('o_id' => $collection_info[0]['o_id']), '*');
                $total_condition_amount = $sales_payment_condition[0]['b_cash_amount'] + $sales_payment_condition[0]['b_bg_amount'] + $sales_payment_condition[0]['b_lc_amount'];
                $this->m_common->update_row('tbl_payment_collections', array('id' => $deposit_info[0]['collection_id']), array('payment_status' => "Received"));
                // $sql="select sum(amount) as total from  tbl_payment_collections  where payment_status='Received' and o_id=".$collection_info[0]['o_id'];
                $sql = "select sum(amount) as total from  tbl_payment_collections  where (payment_status='Received' or collection_condition='Collection') and is_active=1 and o_id=" . $collection_info[0]['o_id'];
                $total_collection = $this->m_common->customeQuery($sql);
                if ($total_collection[0]['total'] >= $total_condition_amount) {
                    $this->m_common->update_row('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), array('status' => "Approved"));
                }

                if ($total_collection[0]['total'] == $order_info[0]['total_amount']) {
                    $this->m_common->update_row('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), array('receive_status' => "Received"));
                } else {
                    $this->m_common->update_row('tbl_sales_orders', array('o_id' => $collection_info[0]['o_id']), array('receive_status' => "Partial Received"));
                }

                $data['status'] = 'success';
            }
        } else {
            $result = $this->m_common->update_row('tbl_deposit_realization', array('id' => $deposit_id), array('realization_status' => "Dishonored", 'realization_date' => date('Y-m-d', strtotime($realization_date))));
            if ($result >= 0) {
                $data['status'] = 'success';
            }
        }
        echo json_encode($data);
    }

    function realized_cheque_bg_lc() {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'realized_cheque_bg_lc';
        $this->titlebackend("Realized Cheque List");
        // $sql="select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id where dr.is_active=1";
        $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id where dr.is_active=1 and dr.realization_status='Honored' and dr.unit_id=" . $branch_id;
        $data['deposits'] = $this->m_common->customeQuery($sql);
        $this->load->view('deposit_realization/v_realized_cheque', $data);
    }

}
