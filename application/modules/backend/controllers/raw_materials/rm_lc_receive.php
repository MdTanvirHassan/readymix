<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rm_lc_receive extends Site_Controller {

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
        $this->menu = 'trading';
        $this->sub_menu = 'rm_receive';
        $this->sub_inner_menu = 'rm_lc_receive';
        $this->titlebackend("Material Receive Register");

        $sql = "select * from rm_lc_receive ORDER BY mrr_id DESC ";
        $data['mrrs'] = $this->m_common->customeQuery($sql);
        $this->load->view('raw_materials/rm_lc_receive/v_rm_lc_receive', $data);
    }

    // Start Material Receive Requisition(MRR)  





    function add_rm_lc_receive() {
        $this->menu = 'trading';
        $this->sub_menu = 'rm_receive';
        $this->sub_inner_menu = 'rm_lc_receive';
        $user_type = $this->session->userdata('user_type');
        $this->titlebackend("Add Material Receive Requisition");
        $branch_id = $this->session->userdata('companyId');

        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $sql = "select sl.*,c.SUP_NAME as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from import_lc sl  left join supplier as c on c.ID=sl.sup_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank where sl.received_status='Pending' order by lc_id DESC";
        $data['lcs'] = $this->m_common->customeQuery($sql);

        $mrr_last_code = $this->m_common->get_row_array('rm_lc_receive', '', '*');
        if (!empty($mrr_last_code)) {

            $mrr_code = count($mrr_last_code) + 1;
            if ($mrr_code > 999) {
                $mrr_sl_no = $mrr_code;
            } else if ($dep_code > 99) {
                $mrr_sl_no = "0" . $mrr_code;
            } else if ($mrr_code > 9) {
                $mrr_sl_no = "00" . $mrr_code;
            } else {
                $mrr_sl_no = "000" . $mrr_code;
            }
        } else {
            $mrr_code = 1;
            $mrr_sl_no = '0001';
        }

        $data['mrr_code'] = $mrr_code;
        $data['mrr_auto_code'] = $mrr_sl_no;

        $this->load->view('raw_materials/rm_lc_receive/v_add_rm_lc_receive', $data);
    }

    function add_action_rm_lc_receive() {
        $this->menu = 'general_store';
        $this->sub_menu = 'rm_lc_receive';
        $this->titlebackend("Add Material Receive Requisition");
        $branch_id = $this->session->userdata('companyId');
        $postData = $this->input->post();
        $mrr_code = $this->input->post('mrr_code');
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');

            if (!empty($postData['lc_id'])) {
                $insertData['lc_id'] = $postData['lc_id'];
                $purchase_id = $postData['lc_id'];
            }

            $branch_info = $this->m_common->get_row_array('import_lc', array('lc_id' => $postData['lc_id']), '*');

            if (!empty($postData['mrr_no'])) {
                $insertData['mrr_no'] = $postData['mrr_no'];
            }


            if (!empty($postData['qc_no'])) {
                $insertData['qc_no'] = $postData['qc_no'];
            }

            if (!empty($postData['mrr_date'])) {
                $insertData['mrr_date'] = date('Y-m-d', strtotime($postData['mrr_date']));
                $receive_date = date('Y-m-d', strtotime($postData['mrr_date']));
            }

            if (!empty($postData['mrr_challan'])) {
                $insertData['mrr_challan'] = $postData['mrr_challan'];
            }

            if (!empty($postData['mrr_challan_date'])) {
                $insertData['mrr_challan_date'] = date('Y-m-d', strtotime($postData['mrr_challan_date']));
            }

            if (!empty($postData['mrr_remark'])) {
                $insertData['mrr_remark'] = $postData['mrr_remark'];
            }



            if (!empty($postData['mother_vessel_name'])) {
                $insertData['mother_vessel_name'] = $postData['mother_vessel_name'];
            }

            if (!empty($postData['lighter_vessel_name'])) {
                $insertData['lighter_vessel_name'] = $postData['lighter_vessel_name'];
            }
            if (!empty($postData['location'])) {
                $insertData['location'] = $postData['location'];
            }



            $insertData['mrr_type'] = "Lc";

            // $insertData['unit_id'] =$branch_id;
            $insertData['unit_id'] = $branch_info[0]['branch_id'];
            if (empty($postData['item_select'])) {
                redirect_with_msg('raw_materials/rm_lc_receive/add_rm_lc_receive', 'Please Select Item');
            }

            $id = $this->m_common->insert_row('rm_lc_receive', $insertData);
            if (!empty($id)) {
                //  $this->m_common->insert_row('material_receive_code', array('mrr_code'=>$mrr_code));
                // $this->m_common->insert_row('material_receive_code',array('mrr_code'=>$mrr_code,'branch_id'=>$branch_id));
                foreach ($postData['item_id'] as $key => $each) {
                    if (in_array($key + 1, $postData['item_select'])) {
                        $insertData1 = array();
                        $insertData1['item_id'] = $each;
                        $insertData1['mrr_id'] = $id;
                        $insertData1['receive_date'] = $receive_date;
                        $insertData1['bill_status'] = 'Pending';
                        $insertData1['payment_status'] = 'Pending';


                        if (!empty($postData['lc_details_id'][$key])) {
                            $insertData1['lc_details_id'] = $postData['lc_details_id'][$key];
                        }

                        if (!empty($postData['receive_qty'][$key])) {
                            $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                            $insertData1['survey_qty'] = $postData['receive_qty'][$key];
                        }

                        if (!empty($postData['unit_price'][$key])) {
                            $insertData1['unit_price'] = $postData['unit_price'][$key];
                        }

                        if (!empty($postData['amount'][$key])) {
                            $insertData1['amount'] = $postData['amount'][$key];
                        }
                        if (!empty($postData['remark'][$key])) {
                            $insertData1['remark'] = $postData['remark'][$key];
                        }
                        $this->m_common->insert_row('rm_lc_receive_details', $insertData1);
                    }
                }
                redirect_with_msg('raw_materials/rm_lc_receive/rm_lc_receive', 'Successfully  Added Material Receive Requistion');
            } else {
                redirect_with_msg('raw_materials/rm_lc_receive/add_rm_lc_receive', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/rm_lc_receive/add_rm_lc_receive', 'Please fill the form and submit');
        }
    }

    function edit_rm_lc_receive($id) {
        $this->menu = 'trading';
        $this->sub_menu = 'rm_receive';
        $this->sub_inner_menu = 'rm_lc_receive';

        $user_type = $this->session->userdata('user_type');
        $branch_id = $this->session->userdata('companyId');

        $this->titlebackend("Edit Material Receive Requisition");
        $data['suppliers'] = $this->m_common->get_row_array('supplier', '', '*');
        $r_sql = "select rmr.*,ilc.date from rm_lc_receive rmr left join import_lc ilc on rmr.lc_id=ilc.lc_id where rmr.mrr_id=" . $id;
        $data['mrr'] = $this->m_common->customeQuery($r_sql);

        $sql = "select sl.*,c.SUP_NAME as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from import_lc sl  left join supplier as c on c.ID=sl.sup_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank where sl.branch_id=$branch_id order by lc_id DESC";
        $data['lcs'] = $this->m_common->customeQuery($sql);


        $sql = "select rmrd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.item_grade,tmu.meas_unit from rm_lc_receive_details rmrd left join rm_lc_receive rmr on rmrd.mrr_id=rmr.mrr_id left join rm_items rmi on rmrd.item_id=rmi.id left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id  where rmrd.mrr_id=" . $id;
        $data['receive_items'] = $this->m_common->customeQuery($sql);

        $this->load->view('raw_materials/rm_lc_receive/v_edit_rm_lc_receive', $data);
    }

    function details_rm_lc_receive($id, $print = false) {
        $this->menu = 'trading';
        $this->sub_menu = 'rm_receive';
        $this->sub_inner_menu = 'rm_lc_receive';

        $user_type = $this->session->userdata('user_type');
        $branch_id = $this->session->userdata('companyId');


        $this->titlebackend("Details Material Receive Requisition");
        $r_sql = "select rmr.*,ilc.date from rm_lc_receive rmr left join import_lc ilc on rmr.lc_id=ilc.lc_id where rmr.mrr_id=" . $id;
        $data['mrr'] = $this->m_common->customeQuery($r_sql);
        $sql = "select sl.*,c.SUP_NAME as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from import_lc sl  left join supplier as c on c.ID=sl.sup_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank where sl.branch_id=$branch_id order by lc_id DESC";
        $data['lcs'] = $this->m_common->customeQuery($sql);


        $sql = "select rmrd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.item_grade,tmu.meas_unit from rm_lc_receive_details rmrd left join rm_lc_receive rmr on rmrd.mrr_id=rmr.mrr_id left join rm_items rmi on rmrd.item_id=rmi.id left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id  where rmrd.mrr_id=" . $id;
        $data['receive_items'] = $this->m_common->customeQuery($sql);

        if ($print == false) {
            $this->load->view('raw_materials/rm_lc_receive/v_details_rm_lc_receive', $data);
        } else {
            $html = $this->load->view('raw_materials/rm_lc_receive/print_mrr', $data, true);
            echo $html;
            exit;
        }
    }

    function edit_action_rm_lc_receive($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'rm_lc_receive';
        $this->titlebackend("Edit Material Receive Requisition");
        $branch_id = $this->session->userdata('companyId');
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
            if (!empty($postData['lc_id'])) {
                $insertData['lc_id'] = $postData['lc_id'];
            }


            if (!empty($postData['mrr_no'])) {
                $insertData['mrr_no'] = $postData['mrr_no'];
            }

            if (!empty($postData['mrr_date'])) {
                $insertData['mrr_date'] = date('Y-m-d', strtotime($postData['mrr_date']));
                $receive_date = date('Y-m-d', strtotime($postData['mrr_date']));
            }

            if (!empty($postData['mrr_challan'])) {
                $insertData['mrr_challan'] = $postData['mrr_challan'];
            }

            if (!empty($postData['mrr_challan_date'])) {
                $insertData['mrr_challan_date'] = date('Y-m-d', strtotime($postData['mrr_challan_date']));
            }

            if (!empty($postData['mrr_remark'])) {
                $insertData['mrr_remark'] = $postData['mrr_remark'];
            }


            if (!empty($postData['mother_vessel_name'])) {
                $insertData['mother_vessel_name'] = $postData['mother_vessel_name'];
            }

            if (!empty($postData['lighter_vessel_name'])) {
                $insertData['lighter_vessel_name'] = $postData['lighter_vessel_name'];
            }
            if (!empty($postData['location'])) {
                $insertData['location'] = $postData['location'];
            }

            // $insertData['unit_id'] =$branch_info[0]['unit_id'];
            $s_id = $this->m_common->update_row('rm_lc_receive', array('mrr_id' => $id), $insertData);
            $delete_details = $this->m_common->delete_row('rm_lc_receive_details', array('mrr_id' => $id));
            if ($s_id >= 0) {
                foreach ($postData['item_id'] as $key => $each) {
                    $insertData1 = array();
                    $insertData1['item_id'] = $each;
                    $insertData1['mrr_id'] = $id;
                    $insertData1['receive_date'] = $receive_date;





                    if (!empty($postData['lc_details_id'][$key])) {
                        $insertData1['lc_details_id'] = $postData['lc_details_id'][$key];
                    }


                    if (!empty($postData['receive_qty'][$key])) {
                        $insertData1['receive_qty'] = $postData['receive_qty'][$key];
                        $insertData1['survey_qty'] = $postData['receive_qty'][$key];
                    }


                    if (!empty($postData['unit_price'][$key])) {
                        $insertData1['unit_price'] = $postData['unit_price'][$key];
                    }

                    if (!empty($postData['amount'][$key])) {
                        $insertData1['amount'] = $postData['amount'][$key];
                    }
                    if (!empty($postData['remark'][$key])) {
                        $insertData1['remark'] = $postData['remark'][$key];
                    }

                    $this->m_common->insert_row('rm_lc_receive_details', $insertData1);
                }

                redirect_with_msg('raw_materials/rm_lc_receive/details_rm_lc_receive/' . $id, 'Successfully Updated Material Receive Requisition');
            }
        } else {
            redirect_with_msg('raw_materials/rm_lc_receive/edit_rm_lc_receive/' . $id, 'Please fill the form and submit');
        }
    }

    function delete_rm_lc_receive($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'rm_lc_receive';
        $this->titlebackend("Material Receive Requisition");
        if (!empty($id)) {
            $ids = $this->m_common->delete_row('rm_lc_receive', array('mrr_id' => $id));
            if (!empty($ids)) {
                $this->m_common->delete_row('rm_lc_receive_details', array('mrr_id' => $id));
                redirect_with_msg('raw_materials/rm_lc_receive', 'Successfully Deleted');
            } else {
                redirect_with_msg('raw_materials/rm_lc_receive', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/rm_lc_receive', 'Please click on delete button');
        }
    }

//End Material Receive Requisition(MRR)   

    function getLcLotDetails() {
        $this->setOutputMode(NORMAL);
        $lc_id = $this->input->post('lc_id');
        $data['lc_info'] = $this->m_common->get_row_array('import_lc', array('lc_id' => $lc_id), '*');
        $sql = "select iscd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,rmi.item_grade,tmu.meas_unit from import_lc_details iscd
        left join rm_items rmi on iscd.item_id=rmi.id 
        left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id        
        where iscd.lc_id=" . $lc_id;
        $data['lc_details'] = $this->m_common->customeQuery($sql);
        echo json_encode($data);
    }

    function confirmReceive($id) {
        $branch_id = $this->session->userdata('companyId');
        $material_receive_info = $this->m_common->get_row_array('rm_lc_receive', array('mrr_id' => $id), '*');
        //$receive_items=$this->m_common->get_row_array('rm_lc_receive_details',array('mrr_id'=>$id),'*');

        $result = $this->m_common->update_row('rm_lc_receive', array('mrr_id' => $id), array('mrr_status' => "Received"));
        if (!empty($result)) {
            $this->m_common->update_row('import_lc', array('lc_id' => $material_receive_info[0]['lc_id']), array('received_status' => "Received"));
        }



        redirect_with_msg('raw_materials/rm_lc_receive', 'Successfully Received Items');
    }

}
