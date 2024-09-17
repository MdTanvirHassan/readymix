<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sale_target extends Site_Controller
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

        //        $this->role = checkUserPermission(7, 26, $userData);
        //        if ($this->role == false || $this->role == 6) {
        //            redirect_with_msg('dashboard/', 'You dont Have permission to access this page');
        //        }

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
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_target';
        $this->titlebackend("Sale Target");
        // $data['sale_order']=$this->m_common->get_row_array('tbl_sales_sale_order
        // $sql="select o.*,q.reference_no,c.c_name,c.c_short_name from tbl_sales_orders o left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where o.is_active=1";
        $sql = "select tst.*,e.name from tbl_sales_target tst left join employees e on tst.employee_id=e.id where tst.is_active=1";
        $data['sale_targets'] = $this->m_common->customeQuery($sql);
        $this->load->view('sale_target/v_sale_target', $data);
    }
    function sales_commission()
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_commission';
        $this->titlebackend("Sale Commission");
        // $data['sale_order']=$this->m_common->get_row_array('tbl_sales_sale_order
        // $sql="select o.*,q.reference_no,c.c_name,c.c_short_name from tbl_sales_orders o left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where o.is_active=1";
        $sql = "select sc.*,p.project_name as project,e.name,c.c_name from sales_commission as sc 
        left join tbl_project as p on p.project_id=sc.project_id
        left join tbl_customers as c on c.id=sc.customer_id
        left join employees as e on sc.employee_id=e.id where sc.is_active=1";
        $data['sale_commission'] = $this->m_common->customeQuery($sql);
        $this->load->view('sale_target/v_sale_commission', $data);
    }
    function details_sale_commission($id, $is_print = false)
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_commission';
        $this->titlebackend("Sale Commission");
        // $data['sale_order']=$this->m_common->get_row_array('tbl_sales_sale_order
        // $sql="select o.*,q.reference_no,c.c_name,c.c_short_name from tbl_sales_orders o left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where o.is_active=1";
        $sql = "select sc.*,p.project_name as project,e.name,c.c_name from sales_commission as sc 
        left join tbl_project as p on p.project_id=sc.project_id
        left join tbl_customers as c on c.id=sc.customer_id
        left join employees as e on sc.employee_id=e.id where sc.is_active=1 and sc.id=" . $id;
        $data['sale_commission'] = $this->m_common->customeQuery($sql);
        $data['sale_commission_details'] = $this->m_common->customeQuery('SELECT sc.*,s.inv_no FROM sales_commission_details sc join tbl_sales_invoices s on sc.inv_id=s.inv_id where sc.comm_id=' . $id);
        if ($is_print) {
            $this->setOutputMode(NORMAL);
            $this->load->view('sale_target/v_details_sale_commission_print', $data);
        } else
            $this->load->view('sale_target/v_details_sale_commission', $data);
    }
    function edit_sale_commission($id)
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_commission';
        $this->titlebackend("Sale Commission");
        // $data['sale_order']=$this->m_common->get_row_array('tbl_sales_sale_order
        // $sql="select o.*,q.reference_no,c.c_name,c.c_short_name from tbl_sales_orders o left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where o.is_active=1";
        $sql = "select sc.*,p.project_name as project,e.name,c.c_name from sales_commission as sc 
        left join tbl_project as p on p.project_id=sc.project_id
        left join tbl_customers as c on c.id=sc.customer_id
        left join employees as e on sc.employee_id=e.id where sc.is_active=1 and sc.id=" . $id;
        $data['sale_commission'] = $this->m_common->customeQuery($sql);
        $data['sale_commission_details'] = $this->m_common->customeQuery('SELECT sc.*,s.inv_no FROM sales_commission_details sc join tbl_sales_invoices s on sc.inv_id=s.inv_id where sc.comm_id=' . $id);
        $data['employees'] = $this->m_common->get_row_array('employees', '', '*');
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1), '*', '', '', 'project_name');

        foreach ($data['customers'] as $key => $value) {
            $challan_info = array();
            $challan_sql = "select dcd.*,tso.customer_id from tbl_sales_invoice_details dcd left join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id left join tbl_delivery_orders do on dc.do_id=do.do_id left join tbl_sales_orders tso on do.o_id=tso.o_id where dc.status='Approved' and dcd.bill_status='Pending' and tso.customer_id=" . $value['id'];
            $challan_info = $this->m_common->customeQuery($challan_sql);
            if (empty($challan_info)) {
                unset($data['customers'][$key]);
            }
        }
        $this->load->view('sale_target/v_edit_sale_commission', $data);
    }
    function add_sale_commission()
    {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_commission';
        $this->titlebackend("Sale Commission");
        $comm = $this->m_common->get_row_array('sales_commission', '', 'commission_no', '', '1', 'id', 'desc');
        if (empty($comm)) {
            $data['commission_no'] = 'comm-0001';
        } else {
            $aa = $comm[0]['commission_no'];
            $aa++;
            $data['commission_no'] = $aa;
        }
        $data['employees'] = $this->m_common->get_row_array('employees', '', '*');
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');

        // foreach ($data['customers'] as $key => $value) {
        //     $challan_info = array();
        //     $challan_sql = "select dcd.*,tso.customer_id from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on dc.do_id=do.do_id left join tbl_sales_orders tso on do.o_id=tso.o_id where dc.status='Approved' and dcd.bill_status='Pending' and tso.customer_id=" . $value['id'];
        //     $challan_info = $this->m_common->customeQuery($challan_sql);
        //     if (empty($challan_info)) {
        //         unset($data['customers'][$key]);
        //     }
        // }

        //$data['product_categories'] = $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');

        $this->load->view('sale_target/v_add_sale_commission', $data);
    }
    function add_sale_target()
    {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_target';
        $this->titlebackend("Target Information");

        $data['categories'] = $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*');
        $em_sql = "select e.*,d.designation_name from employees e left join designation d on e.designation_id=d.id";
        $data['employees'] = $this->m_common->customeQuery($em_sql);
        foreach ($data['employees'] as $key => $value) {
            $data['employees'][$key]['products'] = $data['categories'];
        }
        $this->load->view('sale_target/v_add_sale_target', $data);
    }

    function add_sale_target_action()
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            $insertPaymentCondition = array();

            if (isset($postData['category_id'])) {
                if (empty($postData['category_id'])) {
                    redirect_with_msg('sale_target/add_sale_target', 'Please select Product');
                }
            } else {
                redirect_with_msg('sale_target/add_sale_target', 'Please select Product');
            }

            if (!empty($postData['employee_id'])) {
                $insertData['employee_id'] = $postData['employee_id'];
            }

            if (!empty($postData['month'])) {
                $insertData['month'] = $postData['month'];
            }
            $p_result = $this->m_common->get_row_array('tbl_sales_target', array('employee_id' => $postData['employee_id'], 'month' => $postData['month']), '*');

            if (!empty($p_result)) {
                redirect_with_msg('sale_target/add_sale_target', 'Already target has been set for this sales person');
            }

            if (!empty($postData['total_amount'])) {
                $insertData['total_amount'] = $postData['total_amount'];
            }
            if (!empty($postData['bep_sub_total'])) {
                $insertData['bep_total'] = $postData['bep_sub_total'];
            }

            // $insertData['unit_id'] = $branch_id;
            $insertData['is_active'] = 1;
            $insertData['created_by'] = $user_id;
            $insertData['created_date'] = date('Y-m-d');



            $result = $this->m_common->insert_row('tbl_sales_target', $insertData);
            if (!empty($result)) {


                foreach ($postData['category_id'] as $key => $each) {
                    $insertData1 = array();
                    $insertData1['st_id'] = $result;
                    $insertData1['category_id'] = $each;

                    $insertData1['is_active'] = 1;
                    if (empty($each)) {
                        continue;
                    }
                    if (!empty($postData['quantity'][$key])) {
                        $insertData1['quantity'] = $postData['quantity'][$key];
                    }
                    if (!empty($postData['bep_qty'][$key])) {
                        $insertData1['bep_qty'] = $postData['bep_qty'][$key];
                    }
                    if (!empty($postData['unit_price'][$key])) {
                        $insertData1['unit_price'] = $postData['unit_price'][$key];
                    }

                    if (!empty($postData['mu_name'][$key])) {
                        $insertData1['mu_name'] = strtoupper($postData['mu_name'][$key]);
                    }

                    if (!empty($postData['amount'][$key])) {
                        $insertData1['amount'] = $postData['amount'][$key];
                    }
                    if (!empty($postData['bep_amount'][$key])) {
                        $insertData1['bep_amount'] = $postData['bep_amount'][$key];
                    }

                    if (!empty($postData['remark'][$key])) {
                        $insertData1['remark'] = $postData['remark'][$key];
                    }

                    $this->m_common->insert_row('tbl_sales_target_details', $insertData1);
                }



                redirect_with_msg('sale_target', 'Successfully Inserted');
            }
        } else {
            redirect_with_msg('sale_target/add_sale_target', 'Please fill the form and submit');
        }
    }
    function add_sale_commission_action()
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            $insertPaymentCondition = array();

            if (isset($postData['project_id'])) {
                $insertData['project_id'] = $postData['project_id'];
                if (empty($postData['project_id'])) {
                    redirect_with_msg('sale_target/add_sale_commission', 'Please select Project');
                }
            } else {
                redirect_with_msg('sale_target/add_sale_commission', 'Please select Project');
            }

            if (!empty($postData['customer_id'])) {
                $insertData['customer_id'] = $postData['customer_id'];
            }

            if (!empty($postData['inv_no'])) {
                $insertData['commission_no'] = $postData['inv_no'];
            }
            if (!empty($postData['sale_invoice_date'])) {
                $insertData['date'] = date('Y-m-d', strtotime($postData['sale_invoice_date']));
            }
            if (!empty($postData['beneficiary'])) {
                $insertData['beneficiary'] = $postData['beneficiary'];
            }
            if (!empty($postData['designation'])) {
                $insertData['designation'] = $postData['designation'];
            }
            if (!empty($postData['employee_id'])) {
                $insertData['employee_id'] = $postData['employee_id'];
            }


            if (!empty($postData['sub_total_amount'])) {
                $insertData['total_amount'] = $postData['sub_total_amount'];
            }

            // $insertData['unit_id'] = $branch_id;
            $insertData['is_active'] = 1;
            $insertData['created_by'] = $user_id;
            $insertData['created_date'] = date('Y-m-d');


            if (!empty($postData['comm_id'])) {
                $this->m_common->update_row('sales_commission', array('id' => $postData['comm_id']), $insertData);
                $result = $postData['comm_id'];
                $this->m_common->delete_row('sales_commission_details', array('comm_id' => $result));
            } else
                $result = $this->m_common->insert_row('sales_commission', $insertData);
            if (!empty($result)) {


                foreach ($postData['select_product'] as $key => $each) {
                    $insertData1 = array();

                    if (!empty($postData['total_qty'][$key])) {
                        $insertData1['inv_qty'] = $postData['total_qty'][$key];
                    }
                    if (!empty($postData['total_amount'][$key])) {
                        $insertData1['inv_value'] = $postData['total_amount'][$key];
                    }
                    if (!empty($postData['invoice_rate'][$key])) {
                        $insertData1['comm_qty'] = $postData['invoice_rate'][$key];
                    }

                    if (!empty($postData['invoice_value'][$key])) {
                        $insertData1['comm_value'] = $postData['invoice_value'][$key];
                    }

                    if (!empty($postData['remarks'][$key])) {
                        $insertData1['remarks'] = $postData['remarks'][$key];
                    }
                    if (!empty($postData['inv_id'][$key])) {
                        $insertData1['inv_id'] = $postData['inv_id'][$key];
                    }
                    $insertData1['comm_id'] = $result;

                    $this->m_common->insert_row('sales_commission_details', $insertData1);
                }



                redirect_with_msg('sale_target/sales_commission', 'Successfully Inserted');
            }
        } else {
            redirect_with_msg('sale_target/add_sale_commission', 'Please fill the form and submit');
        }
    }

    function edit_sale_target($id)
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_target';
        $this->titlebackend("Order Information");
        //$sql="select q.*,c.c_name,c.c_short_name from tbl_sales_quotation q left join tbl_customers c on q.customer_id=c.id where q.is_active=1";

        $data['sale_target_info'] = $this->m_common->get_row_array('tbl_sales_target', array('st_id' => $id), '*');

        $sql = "select d.*,sp.category_name,sp.measurement_unit from tbl_sales_target_details d left join tbl_product_categories sp on d.category_id=sp.category_id where d.is_active=1 and d.st_id=" . $id;
        $data['sale_order_details_info'] = $this->m_common->customeQuery($sql);
        $data['categories'] = $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*');
        $data['employees'] = $this->m_common->get_row_array('employees', '', '*');
        $sql = "select sp.* from tbl_mixing_products mp join tbl_sales_products sp on mp.product_id=sp.product_id where mp.is_active=1";
        $data['products'] = $this->m_common->customeQuery($sql);

        $this->load->view('sale_target/v_edit_sale_target', $data);
    }

    function edit_sale_target_action($st_id)
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $postData = $this->input->post();

        if (!empty($postData)) {

            $insertData = array();

            if (isset($postData['category_id'])) {
                if (empty($postData['category_id'])) {
                    redirect_with_msg('sale_target/add_sale_target', 'Please select Product');
                }
            } else {
                redirect_with_msg('sale_target/add_sale_target', 'Please select Product');
            }

            if (!empty($postData['employee_id'])) {
                $insertData['employee_id'] = $postData['employee_id'];
            }

            if (!empty($postData['month'])) {
                $insertData['month'] = $postData['month'];
            }



            if (!empty($postData['total_amount'])) {
                $insertData['total_amount'] = $postData['total_amount'];
            }
            if (!empty($postData['bep_sub_total'])) {
                $insertData['bep_total'] = $postData['bep_sub_total'];
            }


            $insertData['updated_by'] = $user_id;
            $insertData['updated_date'] = date('Y-m-d');
            $result = $this->m_common->update_row('tbl_sales_target', array('st_id' => $st_id), $insertData);
            if ($result >= 0) {

                $this->m_common->delete_row('tbl_sales_target_details', array('st_id' => $st_id));

                foreach ($postData['category_id'] as $key => $each) {
                    $insertData1 = array();
                    $insertData1['st_id'] = $st_id;
                    $insertData1['category_id'] = $each;
                    $insertData1['is_active'] = 1;
                    if (empty($each)) {
                        continue;
                    }
                    if (!empty($postData['quantity'][$key])) {
                        $insertData1['quantity'] = $postData['quantity'][$key];
                    }
                    if (!empty($postData['bep_qty'][$key])) {
                        $insertData1['bep_qty'] = $postData['bep_qty'][$key];
                    }
                    if (!empty($postData['unit_price'][$key])) {
                        $insertData1['unit_price'] = $postData['unit_price'][$key];
                    }

                    if (!empty($postData['mu_name'][$key])) {
                        $insertData1['mu_name'] = strtoupper($postData['mu_name'][$key]);
                    }

                    if (!empty($postData['amount'][$key])) {
                        $insertData1['amount'] = $postData['amount'][$key];
                    }
                    if (!empty($postData['bep_amount'][$key])) {
                        $insertData1['bep_amount'] = $postData['bep_amount'][$key];
                    }


                    if (!empty($postData['remark'][$key])) {
                        $insertData1['remark'] = $postData['remark'][$key];
                    }

                    $this->m_common->insert_row('tbl_sales_target_details', $insertData1);
                }


                redirect_with_msg('sale_target', 'Successfully Updated');
            }
        } else {
            redirect_with_msg('sale_target/add_sale_target', 'Please fill the form and submit');
        }
    }

    function details_sale_target($id, $print = false)
    {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sale_target';
        $this->titlebackend("Order Information");

        $data['sale_target_info'] = $this->m_common->get_row_array('tbl_sales_target', array('st_id' => $id), '*');

        $sql = "select d.*,sp.category_name,sp.measurement_unit from tbl_sales_target_details d left join tbl_product_categories sp on d.category_id=sp.category_id where d.is_active=1 and d.st_id=" . $id;
        $data['sale_order_details_info'] = $this->m_common->customeQuery($sql);
        $data['categories'] = $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*');
        $data['employees'] = $this->m_common->get_row_array('employees', '', '*');
        $sql = "select sp.* from tbl_mixing_products mp join tbl_sales_products sp on mp.product_id=sp.product_id where mp.is_active=1";
        $data['products'] = $this->m_common->customeQuery($sql);
        if ($print == false) {
            $this->load->view('sale_target/v_details_sale_target', $data);
        } else {
            $html = $this->load->view('sale_target/print_sales_target', $data, true);
            echo $html;
            exit;
        }
    }

    function make_archive($id)
    {
        try {
            if (!empty($id)) {
                $id = $this->m_common->update_row('tbl_sales_orders', array('o_id' => $id), array('is_active' => 2));
                redirect_with_msg('sale_orders/index', 'Successfully Archived');
            } else {
                redirect_with_msg('sale_orders/index', 'There have an error during archiving');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function delete_sale_target($id)
    {
        if (!empty($id)) {

            $id = $this->m_common->update_row('tbl_sales_target', array('st_id' => $id), array('is_active' => 0));
            if (!empty($id)) {

                $this->m_common->update_row('tbl_sales_target_details', array('st_id' => $id), array('is_active' => 0));

                redirect_with_msg('sale_target/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('sale_target/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('sale_target/index', 'Please click on delete button');
        }
    }
    function delete_sale_commission($id)
    {
        if (!empty($id)) {

            $id = $this->m_common->update_row('sales_commission', array('id' => $id), array('is_active' => 0));
            if (!empty($id)) {

                $this->m_common->update_row('sales_commission_details', array('comm_id' => $id), array('is_active' => 0));

                redirect_with_msg('sale_target/sales_commission', 'Successfully Deleted');
            } else {
                redirect_with_msg('sale_target/sales_commission', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('sale_target/sales_commission', 'Please click on delete button');
        }
    }
    function delete_sale_team($id)
    {
        if (!empty($id)) {

            $id = $this->m_common->delete_row('sales_team', array('id' => $id));
            if (!empty($id)) {
                redirect_with_msg($_SERVER['HTTP_REFERER'], 'Successfully Deleted');
            } else {
                redirect_with_msg($_SERVER['HTTP_REFERER'], 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg($_SERVER['HTTP_REFERER'], 'Please click on delete button');
        }
    }
    function delete_sale_team_member($id)
    {
        if (!empty($id)) {

            $id = $this->m_common->delete_row('sales_team_user', array('id' => $id));
            if (!empty($id)) {
                redirect_with_msg($_SERVER['HTTP_REFERER'], 'Successfully Deleted');
            } else {
                redirect_with_msg($_SERVER['HTTP_REFERER'], 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg($_SERVER['HTTP_REFERER'], 'Please click on delete button');
        }
    }
    function delete_sale_incentive($id)
    {
        if (!empty($id)) {

            $id = $this->m_common->delete_row('sales_incentive', array('id' => $id));
            if (!empty($id)) {
                redirect_with_msg($_SERVER['HTTP_REFERER'], 'Successfully Deleted');
            } else {
                redirect_with_msg($_SERVER['HTTP_REFERER'], 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg($_SERVER['HTTP_REFERER'], 'Please click on delete button');
        }
    }



    function get_customer_details()
    {
        $branch_id = $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');
        $data['projects'] = $this->m_common->get_row_array('tbl_project', array('customer_id' => $id), '*', '', '', 'project_id', 'DESC');
        $data['order_code'] = $this->m_common->get_row_array('tbl_sales_order_code', array('customer_id' => $id, 'unit_id' => $branch_id), '*', '', 1, 'id', 'DESC');
        $data['customer_info'] = $this->m_common->get_row_array('tbl_customers', array('id' => $id, 'is_active' => 1), '*');
        echo json_encode($data);
    }

    function sales_team()
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_team';
        $this->titlebackend("Sale Team");
        $sql = "select * from sales_team";
        $data['sale_teams'] = $this->m_common->customeQuery($sql);
        $this->load->view('sale_target/v_sale_team', $data);
    }
    function sales_incentive()
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_incentive';
        $this->titlebackend("Sale Incentive Program");
        $sql = "select si.*,pc.category_name from sales_incentive si left join tbl_product_categories pc on si.product_id=pc.category_id";
        $data['sale_incentive'] = $this->m_common->customeQuery($sql);
        $sql = "select * from tbl_product_categories";
        $data['categories'] = $this->m_common->customeQuery($sql);
        $this->load->view('sale_target/v_sale_incentive', $data);
    }
    function distribution()
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'distribution';
        $this->titlebackend("Sale Distribution");
        $postData = $this->input->post();
        if (!empty($postData['month'])) {
            $month = $postData['month'];
        } else {
            $month = date("Y-m", strtotime("first day of previous month"));
        }
        $data['month'] = $month;
        $data['targets'] = $this->m_common->get_row_array('tbl_sales_target', array('month' => $month), '*');
        if (!empty($data['targets']))
            $data['target_details'] = $this->m_common->customeQuery('select s.*,c.short_name from tbl_sales_target_details s join tbl_product_categories c on s.category_id=c.category_id where s.st_id=' . $data['targets'][0]['st_id']);

        $data['all_salary'] = $this->m_common->customeQuery("select sum(e.salary) as salary from sales_team_user stu join sales_team s on s.id=stu.team_id join employees e on stu.employee_id=e.id");
        $teams = $this->m_common->customeQuery("select s.*,sum(e.salary) as salary from sales_team_user stu join sales_team s on s.id=stu.team_id join employees e on stu.employee_id=e.id group by stu.team_id");
        foreach ($teams as $key => $team) {
            $teams[$key]['existing'] = $this->m_common->get_row_array('team_target', array('team_id' => $team['id'], 'month' => $month), '*');
            $sql = "select st.team_name,st.id as team_id,stu.employee_id as team_member_id,stu.contribution,e.*,d.designation_name from sales_team st join sales_team_user stu on st.id=stu.team_id join employees as e on e.id=stu.employee_id left join designation d on e.designation_id=d.id where stu.team_id=" . $team['id'];
            $team_member = $this->m_common->customeQuery($sql);
            $teams[$key]['members'] = $team_member;
            foreach ($teams[$key]['members'] as $k => $mem) {
                $teams[$key]['members'][$k]['existing'] = $this->m_common->get_row_array('member_target', array('employee_id' => $mem['team_member_id'], 'month' => $month), '*');
                foreach ($data['target_details'] as $c => $cat) {
                    $teams[$key]['members'][$k]['cat'][$cat['category_id']] = $this->m_common->get_row_array('member_target_category', array('employee_id' => $mem['team_member_id'], 'category_id' => $cat['category_id'], 'month' => $month), '*');
                }
            }
        }

        $data['teams'] = $teams;
        $this->load->view('sale_target/v_sale_distribution', $data);
    }

    function reset_distribution($month)
    {
        $this->m_common->delete_row('team_target', array('month' => $month));
        $this->m_common->delete_row('member_target', array('month' => $month));
        $this->m_common->delete_row('member_target_category', array('month' => $month));
        redirect('sale_target/distribution');
    }
    function achivement()
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'achivement';
        $this->titlebackend("Sale Achivement");
        $postData = $this->input->post();
        if (!empty($postData['month'])) {
            $month = $postData['month'];
        } else {
            $month = date("Y-m", strtotime("first day of previous month"));
        }
        $data['month'] = $month;
        $start_date = $month . '-01';
        $end_date = date('Y-m-t', strtotime($start_date));


        $sql = "select sum(dcd.amount) as total, sum(dcd.quantity) as quantity from tbl_sales_invoice_details dcd join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id where dc.sale_invoice_date between '" . $start_date . "' and '" . $end_date . "'";
        $data['company_achive'] = $this->m_common->customeQuery($sql);
        $data['company_target'] = $this->m_common->get_row_array('tbl_sales_target', array('month' => $month), '*');

        $cat = $this->m_common->get_row_array('tbl_product_categories', '', '*');
        $array = array();
        $teams = $this->m_common->get_row_array('sales_team', '', '*');
        foreach ($teams as $key => $team) {
            $aciv = $this->m_common->get_row_array('target_achive', array('month' => $month, 'team_id' => $team['id']), '*');
            $sql = "select mtc.*,e.name,d.designation_name from member_target_category mtc left join employees as e on e.id=mtc.employee_id left join designation d on e.designation_id=d.id where month='" . $month . "' and mtc.team_id='" . $team['id'] . "' group by e.id order by mtc.team_id";
            $target = $this->m_common->customeQuery($sql);
            $array[$team['id']] = $team;
            $array[$team['id']]['exists_acive'] = (!empty($aciv)) ? 1 : 0;
            $array[$team['id']]['target'] = 0;
            $array[$team['id']]['achive'] = 0;
            foreach ($target as $t => $each) {
                $array[$team['id']]['employee'][$each['employee_id']] = $each;
                foreach ($cat as $c) {
                    //$sql = "select sum(sd.amount) as total,sd.quantity from tbl_sales_orders s left join tbl_sales_order_details sd on s.o_id=sd.o_id  where sd.product_id=" . $c['category_id'] . " and sale_person_id=" . $each['employee_id'] . " and sale_order_date between '" . $start_date . "' and '" . $end_date . "'";
                    $sql = "select sum(dcd.amount) as total, sum(dcd.quantity) as quantity from tbl_sales_invoice_details dcd join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id join tbl_delivery_orders as do on dc.do_id=do.do_id join tbl_sales_orders as so on do.o_id=so.o_id
                    where dcd.s_item_id=" . $c['category_id'] . " and so.sale_person_id=" . $each['employee_id'] . " and dc.sale_invoice_date between '" . $start_date . "' and '" . $end_date . "'";
                    $aciv = $this->m_common->customeQuery($sql);

                    $sql = "select mtc.*,e.name,d.designation_name from member_target_category mtc left join employees as e on e.id=mtc.employee_id left join designation d on e.designation_id=d.id where month='" . $month . "' and mtc.employee_id='" . $each['employee_id'] . "' and mtc.category_id='" . $c['category_id'] . "' order by mtc.team_id";
                    $tgt = $this->m_common->customeQuery($sql);
                    $array[$team['id']]['employee'][$each['employee_id']]['achive'][$c['category_id']]['target_qty'] = $tgt[0]['target_qty'];
                    $array[$team['id']]['employee'][$each['employee_id']]['achive'][$c['category_id']]['target_value'] = $tgt[0]['target_value'];
                    $array[$team['id']]['employee'][$each['employee_id']]['achive'][$c['category_id']]['total'] = !empty($aciv[0]['total']) ? $aciv[0]['total'] : 0;
                    $array[$team['id']]['employee'][$each['employee_id']]['achive'][$c['category_id']]['quantity'] = !empty($aciv[0]['quantity']) ? $aciv[0]['quantity'] : 0;
                    $array[$team['id']]['target'] += $tgt[0]['target_value'];
                    $array[$team['id']]['achive'] += $aciv[0]['total'];
                }
            }
        }
        $data['cat'] = $cat;
        $data['targets'] = $array;
        $this->load->view('sale_target/v_sale_achivement', $data);
    }
    function achivement_print($month)
    {
        $this->setOutputMode(NORMAL);
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'achivement';
        $this->titlebackend("Sale Achivement");

        $data['month'] = $month;
        $start_date = $month . '-01';
        $end_date = date('Y-m-t', strtotime($start_date));


        $sql = "select sum(dcd.amount) as total, sum(dcd.quantity) as quantity from tbl_sales_invoice_details dcd join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id where dc.sale_invoice_date between '" . $start_date . "' and '" . $end_date . "'";
        $data['company_achive'] = $this->m_common->customeQuery($sql);
        $data['company_target'] = $this->m_common->get_row_array('tbl_sales_target', array('month' => $month), '*');

        $cat = $this->m_common->get_row_array('tbl_product_categories', '', '*');
        $array = array();
        $teams = $this->m_common->get_row_array('sales_team', '', '*');
        foreach ($teams as $key => $team) {
            $aciv = $this->m_common->get_row_array('target_achive', array('month' => $month, 'team_id' => $team['id']), '*');
            $sql = "select mtc.*,e.name,d.designation_name from member_target_category mtc left join employees as e on e.id=mtc.employee_id left join designation d on e.designation_id=d.id where month='" . $month . "' and mtc.team_id='" . $team['id'] . "' group by e.id order by mtc.team_id";
            $target = $this->m_common->customeQuery($sql);
            $array[$team['id']] = $team;
            $array[$team['id']]['exists_acive'] = (!empty($aciv)) ? 1 : 0;
            $array[$team['id']]['target'] = 0;
            $array[$team['id']]['achive'] = 0;
            foreach ($target as $t => $each) {
                $array[$team['id']]['employee'][$each['employee_id']] = $each;
                foreach ($cat as $c) {
                    //$sql = "select sum(sd.amount) as total,sd.quantity from tbl_sales_orders s left join tbl_sales_order_details sd on s.o_id=sd.o_id  where sd.product_id=" . $c['category_id'] . " and sale_person_id=" . $each['employee_id'] . " and sale_order_date between '" . $start_date . "' and '" . $end_date . "'";
                    $sql = "select sum(dcd.amount) as total, sum(dcd.quantity) as quantity from tbl_sales_invoice_details dcd join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id join tbl_delivery_orders as do on dc.do_id=do.do_id join tbl_sales_orders as so on do.o_id=so.o_id
                    where dcd.s_item_id=" . $c['category_id'] . " and so.sale_person_id=" . $each['employee_id'] . " and dc.sale_invoice_date between '" . $start_date . "' and '" . $end_date . "'";
                    $aciv = $this->m_common->customeQuery($sql);

                    $sql = "select mtc.*,e.name,d.designation_name from member_target_category mtc left join employees as e on e.id=mtc.employee_id left join designation d on e.designation_id=d.id where month='" . $month . "' and mtc.employee_id='" . $each['employee_id'] . "' and mtc.category_id='" . $c['category_id'] . "' order by mtc.team_id";
                    $tgt = $this->m_common->customeQuery($sql);
                    $array[$team['id']]['employee'][$each['employee_id']]['achive'][$c['category_id']]['target_qty'] = $tgt[0]['target_qty'];
                    $array[$team['id']]['employee'][$each['employee_id']]['achive'][$c['category_id']]['target_value'] = $tgt[0]['target_value'];
                    $array[$team['id']]['employee'][$each['employee_id']]['achive'][$c['category_id']]['total'] = !empty($aciv[0]['total']) ? $aciv[0]['total'] : 0;
                    $array[$team['id']]['employee'][$each['employee_id']]['achive'][$c['category_id']]['quantity'] = !empty($aciv[0]['quantity']) ? $aciv[0]['quantity'] : 0;
                    $array[$team['id']]['target'] += $tgt[0]['target_value'];
                    $array[$team['id']]['achive'] += $aciv[0]['total'];
                }
            }
        }
        $data['cat'] = $cat;
        $data['targets'] = $array;
        $this->load->view('sale_target/v_sale_achivement_print', $data);
    }
    function provide_incentive()
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'provide_incentive';
        $this->titlebackend("Provide Sale Incentive");
        $postData = $this->input->post();
        if (!empty($postData['month'])) {
            $month = $postData['month'];
        } else {
            $month = date("Y-m", strtotime("first day of previous month"));
        }
        $data['month'] = $month;
        $start_date = $month . '-01';
        $end_date = date('Y-m-t', strtotime($start_date));


        $sql = "select sum(dcd.amount) as total, sum(dcd.quantity) as quantity from tbl_sales_invoice_details dcd 
                    join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id where dc.sale_invoice_date between '" . $start_date . "' and '" . $end_date . "'";
        $data['company_achive'] = $this->m_common->customeQuery($sql);
        $data['company_target'] = $this->m_common->get_row_array('tbl_sales_target', array('month' => $month), '*');

        $cat = $this->m_common->get_row_array('tbl_product_categories', '', '*');
        $sql = "SELECT ta.*,st.team_name FROM `target_achive` ta join sales_team st on ta.team_id=st.id where ta.month='" . $month . "'";
        $sales_team = $this->m_common->customeQuery($sql);
        foreach ($sales_team as $key => $team) {
            $sql = "select sum(target) as total from team_target where month='" . $month . "' and team_id='" . $team['team_id'] . "' group by team_id";
            $target = $this->m_common->customeQuery($sql);
            $sql = "SELECT group_concat(employee_id) as sales_person FROM `sales_team_user` where team_id=" . $team['team_id'] . " group by team_id";
            $sales_persons = $this->m_common->customeQuery($sql);
            $sql = "select sum(dcd.amount) as total, sum(dcd.quantity) as quantity,group_concat(DISTINCT so.customer_id) as customer_id from tbl_sales_invoice_details dcd 
                    join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id
                    join tbl_delivery_orders as do on dc.do_id=do.do_id
                    join tbl_sales_orders as so on do.o_id=so.o_id
                    where so.sale_person_id in(" . $sales_persons[0]['sales_person'] . ") and dc.sale_invoice_date between '" . $start_date . "' and '" . $end_date . "'";
            $aciv = $this->m_common->customeQuery($sql);
            if (empty($aciv[0]['customer_id'])) {
                $collection[0]['total'] = 0;
            } else {
                $sql = "select sum(amount) as total from tbl_payment_collections where customer_id in (" . $aciv[0]['customer_id'] . ") and payment_status='Received'  and receive_date between '" . $start_date . "' and '" . $end_date . "'";
                $collection = $this->m_common->customeQuery($sql);
            }
            $incentiable_amount = $aciv[0]['total'] - $target[0]['total'];
            $sql = "select * from sales_incentive where start_amount<='" . $incentiable_amount . "' and end_amount>='" . $incentiable_amount . "' ";
            $aa = $this->m_common->customeQuery($sql);
            $sales_team[$key]['target'] = $target;
            $sales_team[$key]['achive'] = $aciv;
            $sales_team[$key]['incentive_percent'] = !empty($aa) ? $aa[0]['incentive'] : '0.00';
            $sales_team[$key]['collection'] = $collection;
        }
        $data['sales_team'] = $sales_team;
        $this->load->view('sale_target/v_provide_incentive', $data);
    }
    function provide_incentive_employee($team_id = 0)
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'provide_incentive';
        $this->titlebackend("Provide Sale Incentive");
        $postData = $this->input->post();
        if (!empty($postData['month'])) {
            $month = $postData['month'];
        } else {
            $month = date("Y-m", strtotime("first day of previous month"));
        }
        $data['month'] = $month;
        $start_date = $month . '-01';
        $end_date = date('Y-m-t', strtotime($start_date));

        if (!empty($team_id)) {
            $sql = "SELECT group_concat(employee_id) as sales_person FROM `sales_team_user` where team_id=" . $team_id . " group by team_id";
            $sales_persons = $this->m_common->customeQuery($sql);
            $sql = "select sum(dcd.amount) as total, sum(dcd.quantity) as quantity,group_concat(DISTINCT so.customer_id) as customer_id from tbl_sales_invoice_details dcd 
                    join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id
                    join tbl_delivery_orders as do on dc.do_id=do.do_id
                    join tbl_sales_orders as so on do.o_id=so.o_id
                    where so.sale_person_id in(" . $sales_persons[0]['sales_person'] . ") and dc.sale_invoice_date between '" . $start_date . "' and '" . $end_date . "'";
            $data['company_achive'] = $this->m_common->customeQuery($sql);
            $data['company_target'] = $this->m_common->get_row_array('team_target', array('month' => $month), '*');
            $sql = "SELECT ta.*,st.team_name,stu.employee_id,e.name FROM `target_achive` ta join sales_team st on ta.team_id=st.id join sales_team_user stu on st.id=stu.team_id join employees as e on e.id=stu.employee_id where ta.month='" . $month . "' and ta.team_id=$team_id  order by ta.team_id";
            $sales_team = $this->m_common->customeQuery($sql);
        } else {
            $sql = "select sum(dcd.amount) as total, sum(dcd.quantity) as quantity from tbl_sales_invoice_details dcd 
            join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id where dc.sale_invoice_date between '" . $start_date . "' and '" . $end_date . "'";
            $data['company_achive'] = $this->m_common->customeQuery($sql);
            $data['company_target'] = $this->m_common->get_row_array('tbl_sales_target', array('month' => $month), '*');
            $sql = "SELECT ta.*,st.team_name,stu.employee_id,e.name FROM `target_achive` ta join sales_team st on ta.team_id=st.id join sales_team_user stu on st.id=stu.team_id join employees as e on e.id=stu.employee_id where ta.month='" . $month . "' order by ta.team_id";
            $sales_team = $this->m_common->customeQuery($sql);
        }

        foreach ($sales_team as $key => $team) {
            $paid = $this->m_common->get_row_array('sales_incentive_provided', array('employee_id' => $team['employee_id'], 'month' => $month), 'sum(amount) as total');
            $sql = "select sum(target) as total from team_target where month='" . $month . "' and team_id='" . $team['team_id'] . "' group by team_id";
            $target = $this->m_common->customeQuery($sql);
            $sql = "SELECT group_concat(employee_id) as sales_person FROM `sales_team_user` where team_id=" . $team['team_id'] . " group by team_id";
            $sales_persons = $this->m_common->customeQuery($sql);
            $sql = "select sum(dcd.amount) as total, sum(dcd.quantity) as quantity,group_concat(DISTINCT so.customer_id) as customer_id from tbl_sales_invoice_details dcd 
                join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id
                join tbl_delivery_orders as do on dc.do_id=do.do_id
                join tbl_sales_orders as so on do.o_id=so.o_id
                where so.sale_person_id in(" . $sales_persons[0]['sales_person'] . ") and dc.sale_invoice_date between '" . $start_date . "' and '" . $end_date . "'";
            $aciv = $this->m_common->customeQuery($sql);
            $incentiable_amount = $aciv[0]['total'] - $target[0]['total'];
            if ($incentiable_amount < 0) {
                $incentiable_amount = 0;
            }
            $sql = "select * from sales_incentive where start_amount<='" . $incentiable_amount . "' and end_amount>='" . $incentiable_amount . "' ";
            $aa = $this->m_common->customeQuery($sql);



            $sql = "select sum(target) as total from member_target where month='" . $month . "' and employee_id='" . $team['employee_id'] . "' group by employee_id";
            $target = $this->m_common->customeQuery($sql);
            // $sql = "SELECT group_concat(employee_id) as sales_person FROM `sales_team_user` where team_id=" . $team['id'] . " group by team_id";
            // $sales_persons = $this->m_common->customeQuery($sql);
            $sql = "select sum(dcd.amount) as total, sum(dcd.quantity) as quantity,group_concat(DISTINCT so.customer_id) as customer_id from tbl_sales_invoice_details dcd 
                    join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id
                    join tbl_delivery_orders as do on dc.do_id=do.do_id
                    join tbl_sales_orders as so on do.o_id=so.o_id
                    where so.sale_person_id in(" . $team['employee_id'] . ") and dc.sale_invoice_date between '" . $start_date . "' and '" . $end_date . "'";
            $aciv = $this->m_common->customeQuery($sql);
            if (!empty($aciv[0]['customer_id'])) {
                $sql = "select sum(amount) as total from tbl_payment_collections where customer_id in (" . $aciv[0]['customer_id'] . ") and payment_status='Received'  and receive_date between '" . $start_date . "' and '" . $end_date . "'";
                $collection = $this->m_common->customeQuery($sql);
            } else {
                $collection[0]['total'] = 0;
            }

            $incentiable_amount = $aciv[0]['total'] - $target[0]['total'];
            if ($incentiable_amount < 0) {
                $incentiable_amount = 0;
            }


            $sales_team[$key]['target'] = $target;
            $sales_team[$key]['achive'] = $aciv;
            $sales_team[$key]['paid'] = !empty($paid) ? $paid[0]['total'] : '0.00';;
            $sales_team[$key]['incentive_percent'] = !empty($aa) ? $aa[0]['incentive'] : '0.00';
            $sales_team[$key]['incentiable_amount'] = $incentiable_amount;
            $sales_team[$key]['collection'] = $collection;
        }
        $data['sales_team'] = $sales_team;
        $data['team_id'] = $team_id;
        $this->load->view('sale_target/v_provide_incentive_employee', $data);
    }

    function employee_taarget_report($month)
    {
        $this->setOutputMode(NORMAL);
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'achivement';
        $this->titlebackend("Sale Achivement");
        $postData = $this->input->post();
        if (!empty($postData['month'])) {
            $month = $postData['month'];
        } else {
            $month = date("Y-m", strtotime("first day of previous month"));
        }
        $data['month'] = $month;
        $start_date = $month . '-01';
        $end_date = date('Y-m-t', strtotime($start_date));
        //$cat = $this->m_common->get_row_array('tbl_product_categories', '', '*');
        $sql = "select mtc.*,e.name,d.designation_name,pc.category_name,pc.measurement_unit from member_target_category mtc left join employees as e on e.id=mtc.employee_id left join designation d on e.designation_id=d.id left join tbl_product_categories pc on pc.category_id=mtc.category_id where month='" . $month . "' order by mtc.id";
        $data['targets'] = $this->m_common->customeQuery($sql);
        $this->load->view('sale_target/v_employee_target_print', $data);
    }
    function employee_achievement($month, $employee_id = false)
    {
        $this->setOutputMode(NORMAL);
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'achivement';
        $this->titlebackend("Sale Achivement Report");
        // $postData = $this->input->post();
        // if (!empty($postData['month'])) {
        //     $month = $postData['month'];
        // } else {
        //     $month = date("Y-m", strtotime("first day of previous month"));
        // }
        $data['month'] = $month;
        $start_date = $month . '-01';
        $end_date = date('Y-m-t', strtotime($start_date));

        $sql = "select dc.inv_id,dc.inv_no,dc.sale_invoice_date,dcd.*,do.delivery_no,so.order_no,sp.product_name,c.c_short_name 
            from tbl_sales_invoice_details dcd 
                        join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id
            join tbl_delivery_orders as do on dc.do_id=do.do_id
            join tbl_sales_orders as so on do.o_id=so.o_id
            join tbl_sales_products as sp on sp.product_id=dcd.s_item_id
            left join tbl_customers c on dc.customer_id=c.id
            where so.sale_person_id in(" . $employee_id . ") and dc.sale_invoice_date between '" . $start_date . "' and '" . $end_date . "'";
        $data['achievement'] = $this->m_common->customeQuery($sql);
        // echo '<pre>';print_r($data['achievement']);
        // exit;
        $this->load->view('sale_target/v_employee_achivement', $data);
    }
    function employee_taarget_achivement_report($month)
    {
        //$this->setOutputMode(NORMAL);
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'achivement';
        $this->titlebackend("Sale Achivement Report");
        // $postData = $this->input->post();
        // if (!empty($postData['month'])) {
        //     $month = $postData['month'];
        // } else {
        //     $month = date("Y-m", strtotime("first day of previous month"));
        // }
        $data['month'] = $month;
        $start_date = $month . '-01';
        $end_date = date('Y-m-t', strtotime($start_date));
        //$cat = $this->m_common->get_row_array('tbl_product_categories', '', '*');
        $sql = "select mtc.*,e.name,d.designation_name,pc.category_name,pc.measurement_unit from member_target_category mtc left join employees as e on e.id=mtc.employee_id left join designation d on e.designation_id=d.id left join tbl_product_categories pc on pc.category_id=mtc.category_id where month='" . $month . "' order by e.id";
        $data['targets'] = $this->m_common->customeQuery($sql);
        foreach ($data['targets'] as $key => $tgt) {
            $sql = "select sum(dcd.amount) as total, sum(dcd.quantity) as quantity,
            group_concat(DISTINCT so.customer_id) as customer_id 
            from tbl_sales_invoice_details dcd 
                        join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id
            join tbl_delivery_orders as do on dc.do_id=do.do_id
            join tbl_sales_orders as so on do.o_id=so.o_id
            join tbl_sales_products as sp on sp.product_id=dcd.s_item_id
            where so.sale_person_id in(" . $tgt['employee_id'] . ") and dc.sale_invoice_date between '" . $start_date . "' and '" . $end_date . "' and sp.category_id=" . $tgt['category_id'];
            $aciv = $this->m_common->customeQuery($sql);
            $data['targets'][$key]['achive_total'] = !empty($aciv) ? $aciv[0]['total'] : 0;
            $data['targets'][$key]['achive_quantity'] = !empty($aciv) ? $aciv[0]['quantity'] : 0;
        }
        $this->load->view('sale_target/v_provide_incentive_new', $data);
    }
    function employee_taarget_achivement_report_print($month)
    {
        $this->setOutputMode(NORMAL);
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'achivement';
        $this->titlebackend("Sale Achivement Report");
        // $postData = $this->input->post();
        // if (!empty($postData['month'])) {
        //     $month = $postData['month'];
        // } else {
        //     $month = date("Y-m", strtotime("first day of previous month"));
        // }
        $data['month'] = $month;
        $start_date = $month . '-01';
        $end_date = date('Y-m-t', strtotime($start_date));
        //$cat = $this->m_common->get_row_array('tbl_product_categories', '', '*');
        $sql = "select mtc.*,e.name,d.designation_name,pc.category_name,pc.measurement_unit from member_target_category mtc left join employees as e on e.id=mtc.employee_id left join designation d on e.designation_id=d.id left join tbl_product_categories pc on pc.category_id=mtc.category_id where month='" . $month . "' order by e.id";
        $data['targets'] = $this->m_common->customeQuery($sql);
        foreach ($data['targets'] as $key => $tgt) {
            $sql = "select sum(dcd.amount) as total, sum(dcd.quantity) as quantity,
            group_concat(DISTINCT so.customer_id) as customer_id 
            from tbl_sales_invoice_details dcd 
                        join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id
            join tbl_delivery_orders as do on dc.do_id=do.do_id
            join tbl_sales_orders as so on do.o_id=so.o_id
            join tbl_sales_products as sp on sp.product_id=dcd.s_item_id
            where so.sale_person_id in(" . $tgt['employee_id'] . ") and dc.sale_invoice_date between '" . $start_date . "' and '" . $end_date . "' and sp.category_id=" . $tgt['category_id'];
            $aciv = $this->m_common->customeQuery($sql);
            $data['targets'][$key]['achive_total'] = !empty($aciv) ? $aciv[0]['total'] : 0;
            $data['targets'][$key]['achive_quantity'] = !empty($aciv) ? $aciv[0]['quantity'] : 0;
        }
        $this->load->view('sale_target/v_provide_incentive_new_print', $data);
    }

    function save_distribution()
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $postData = $this->input->post();
        // echo '<pre>';
        // print_r($postData);
        // exit;
        if (!empty($postData['team_id'])) {
            $this->m_common->delete_row('team_target', array('month' => $postData['sales_month']));
            $this->m_common->delete_row('member_target', array('month' => $postData['sales_month']));
            $this->m_common->delete_row('member_target_category', array('month' => $postData['sales_month']));
            foreach ($postData['team_id'] as $k => $team) {
                if (empty($team))
                    continue;
                $team_target = array();
                $team_target['team_id'] = $team;
                $team_target['target'] = $postData['group_total'][$team];
                $team_target['contribution'] = $postData['team_contribution'][$k];
                $team_target['month'] = $postData['sales_month'];
                $ref_id = $this->m_common->insert_row('team_target', $team_target);
                foreach ($postData['employee'][$team] as $j => $employee) {
                    $employee_target = array();
                    $employee_target['team_id'] = $team;
                    $employee_target['target'] = $postData['total'][$employee];
                    $employee_target['contribution'] = $postData['contribution'][$team][$j];
                    $employee_target['month'] = $postData['sales_month'];
                    $employee_target['employee_id'] = $employee;
                    $employee_target['ref_id'] = $ref_id;
                    $e_ref_id = $this->m_common->insert_row('member_target', $employee_target);

                    foreach ($postData['qty'][$team][$employee] as $t => $qty) {
                        $team_target_cat = array();
                        $team_target_cat['team_id'] = $team;
                        $team_target_cat['employee_id'] = $employee;
                        $team_target_cat['category_id'] = $t;
                        $team_target_cat['target_qty'] = $qty;
                        $team_target_cat['month'] = $postData['sales_month'];
                        $team_target_cat['target_value'] = $postData['value'][$team][$employee][$t];
                        $team_target_cat['ref_id'] = $e_ref_id;
                        $this->m_common->insert_row('member_target_category', $team_target_cat);
                    }
                }
            }


            redirect_with_msg('sale_target/distribution', 'Sales distribution Added Successfully');
        }
    }
    function add_sales_team()
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $postData = $this->input->post();
        if (!empty($postData['team_name'])) {
            $insertData = array();
            $insertData['team_name'] = $postData['team_name'];
            $insertData['created_by'] = $user_id;
            $this->m_common->insert_row('sales_team', $insertData);
            redirect_with_msg('sale_target/sales_team', 'Sales Team Added Successfully');
        }
    }
    function edit_sales_team()
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $postData = $this->input->post();
        if (!empty($postData['team_name'])) {
            $insertData = array();
            $insertData['team_name'] = $postData['team_name'];
            $this->m_common->update_row('sales_team', array('id' => $postData['edit_id']), $insertData);
            redirect_with_msg('sale_target/sales_team', 'Sales Team Added Successfully');
        }
    }


    function add_sales_incentive()
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $postData = $this->input->post();
        if (!empty($postData['title'])) {
            $insertData = array();
            $insertData['title'] = $postData['title'];
            $insertData['start_date'] = date('Y-m-d', strtotime($postData['start_date']));
            $insertData['end_date'] = date('Y-m-d', strtotime($postData['end_date']));
            $insertData['start_amount'] = $postData['start_amount'];
            $insertData['end_amount'] = $postData['end_amount'];
            $insertData['incentive'] = $postData['incentive'];
            $insertData['type'] = $postData['type'];
            $insertData['product_id'] = $postData['product_id'];
            $insertData['created_by'] = $user_id;
            $this->m_common->insert_row('sales_incentive', $insertData);
            redirect_with_msg('sale_target/sales_incentive', 'Sales Incentive Added Successfully');
        }
    }
    function update_sales_incentive()
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $postData = $this->input->post();
        if (!empty($postData['incentive_id'])) {
            $insertData = array();
            $insertData['title'] = $postData['title'];
            $insertData['start_date'] = date('Y-m-d', strtotime($postData['start_date']));
            $insertData['end_date'] = date('Y-m-d', strtotime($postData['end_date']));
            $insertData['start_amount'] = $postData['start_amount'];
            $insertData['end_amount'] = $postData['end_amount'];
            $insertData['incentive'] = $postData['incentive'];
            $insertData['product_id'] = $postData['product_id'];
            $insertData['type'] = $postData['type'];
            $this->m_common->update_row('sales_incentive', array('id' => $postData['incentive_id']), $insertData);
            redirect_with_msg('sale_target/sales_incentive', 'Sales Incentive Added Successfully');
        }
    }
    function add_sales_team_member()
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $postData = $this->input->post();
        //   print_r($postData);exit;
        if (!empty($postData['team_id'])) {
            foreach ($postData['employee_id'] as $employee_id => $row) {
                $insertData = array();
                $insertData['team_id'] = $postData['team_id'];
                $insertData['employee_id'] = $employee_id;
                $this->m_common->insert_row('sales_team_user', $insertData);
            }

            redirect_with_msg('sale_target/team_member/' . $postData['team_id'], 'Sales Team Member Added Successfully');
        }
    }
    function team_member($id)
    {
        $branch_id = $this->session->userdata('companyId');
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_team';
        $this->titlebackend("Sale Team Member");
        $sql = "select * from sales_team where id=" . $id;
        $data['sale_team'] = $this->m_common->customeQuery($sql);
        $sql = "select st.team_name,stu.employee_id,stu.id as team_member_id,stu.contribution,e.*,d.designation_name from sales_team st join sales_team_user stu on st.id=stu.team_id join employees as e on e.id=stu.employee_id left join designation d on e.designation_id=d.id where stu.team_id=" . $id;
        $data['team_members'] = $this->m_common->customeQuery($sql);
        $sql = "select sum(e.salary) as total from sales_team st join sales_team_user stu on st.id=stu.team_id join employees as e on e.id=stu.employee_id left join designation d on e.designation_id=d.id where stu.team_id=" . $id;
        $data['total_salary'] = $this->m_common->customeQuery($sql);

        $data['designations'] = $this->m_common->get_row_array('designation', '', '*');
        $data['team_id'] = $id;
        $this->load->view('sale_target/v_sale_team_members', $data);
    }

    function get_employee_list()
    {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');
        $team_id = $this->input->post('team_id');
        if (empty($id))
            $sql = "select * from employees where id not in (select employee_id from sales_team_user)";
        else
            $sql = "select * from employees where designation_id=$id and id not in (select employee_id from sales_team_user)";
        $data['employees'] = $this->m_common->customeQuery($sql);
        if (!empty($data['employees'])) {
            $data['msg'] = 'success';
            echo json_encode($data);
        } else
            echo json_encode(array('msg' => 'failed'));
    }
    function add_contribution()
    {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');
        $contribution = $this->input->post('contribution');
        $this->m_common->update_row('sales_team_user', array('id' => $id), array('contribution' => $contribution));

        echo json_encode(array('msg' => 'success'));
    }
    function confirm_incentive()
    {
        $this->setOutputMode(NORMAL);
        $ids = $this->input->post('ids');
        $month = $this->input->post('month');
        $this->m_common->delete_row('target_achive', array('month' => $month));
        foreach ($ids as $id) {
            $this->m_common->insert_row('target_achive', array('team_id' => $id, 'month' => $month));
        }

        echo 'success';
    }

    function confim_payment()
    {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('id');
        $month = $this->input->post('month');
        $amount = $this->input->post('amount');
        $this->m_common->insert_row('sales_incentive_provided', array('employee_id' => $id, 'month' => $month, 'amount' => $amount, 'date' => date('Y-m-d')));
        echo 'success';
    }


    function paidInvoice()
    {
        $this->setOutputMode(NORMAL);
        $id = $this->input->post('project_id');
        $branch_id = $this->session->userdata('companyId');
        $sql = "select v.*,o.order_no,do.delivery_no,c.c_name,c.c_short_name,c.deposit,c.id as customer_id,tpc.category_name,tp.project_name as tp_project_name,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name from tbl_sales_invoices v left join tbl_sales_invoice_details tsid on v.inv_id=tsid.inv_id left join tbl_delivery_orders do on v.do_id=do.do_id left join tbl_sales_orders o on do.o_id=o.o_id left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on v.customer_id=c.id left join tbl_product_categories tpc on v.category_id=tpc.category_id left join tbl_project tp on v.project_id=tp.project_id where v.status='Received'  and v.is_active=1 and v.unit_id=" . $branch_id . " and v.project_id=" . $id . ' group by v.inv_id order by v.sale_invoice_date desc';
        $data['invoices'] = $this->m_common->customeQuery($sql);
        if (!empty($data['invoices']))
            $data['msg'] = 'success';
        else
            $data['msg'] = 'failed';

        echo json_encode($data);
    }
}
